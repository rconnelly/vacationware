<?php

//! The current version of the BNC API
define( 'BNC_API_VERSION', '1.2.2' );

//! The URL used to access the BNC API
define( 'BNC_API_URL', 'http://api.bravenewcode.com/v/' . BNC_API_VERSION );

//! The WordPress setting name for the token information 
define( 'BNC_TOKEN_INFO_SETTING', 'bncid_token' );

define( 'BNC_AUTHENTICATION_ATTEMPTS', 3 );

define( 'BNC_API_TIMEOUT', 20 );

class BNCAPI {
	//! The user's BNCID
	var $bncid;
	
	//! The license key
	var $license_key;
	
	//! The access token for communincating with the BNC API
	var $token;
	
	//! The time variance between this server and the BNC API servers.  Used to generate timestamps to prevent replay attacks.
	var $time_variance;
	
	//! Indicates that the token has been checked against the server at least once
	var $token_checked;
	
	//! Indicates the UNIX time which the BNC access token will expire at
	var $token_expires;
	
	//! The time when the token was last checked
	var $last_token_check;
	
	//! Set to true when the API credentials are invalid
	var $credentials_invalid;
	
	//! Set to true when the server appears to be down or unresponsive
	var $server_down;
	
	//! Set to true when the server attempts to do a silent re-authorization
	var $attempting_retry;
	
	//! Set to the response code from the API request
	var $response_code;
	
	function BNCAPI( $bncid, $license_key ) {
		$this->bncid = $bncid;
		$this->license_key = $license_key;
		$this->token = '';
		$this->token_checked = false;
		$this->token_expires = 0;
		$this->last_token_check = 0;
		$this->credentials_invalid = false;
		$this->server_down = false;
		$this->attempting_retry = false;
		$this->response_code = 0;
		
		$token_info = get_option( BNC_TOKEN_INFO_SETTING, false );
		if ( $token_info ) {
			if ( $token_info['expires'] > time() ) {
				$this->token = md5( $this->license_key . $token_info['token'] );	
				$this->time_variance = $token_info['time-variance'];
				$this->token_expires = $token_info['expires'];
				$this->last_token_check = $token_info['last_check'];
			}
		}
	}	
	
	/*!		\brief Used to perform a BNC API request
	 *		The BNC API is similar to REST in terms of usage, and similar to OAuth in terms of authentication.
	 *		Each API request consists of a method, a command, and a series of parameters for that command.  For example,
	 *		a request to obtain user information uses a method of USER and a command of GET_INFO, and the request is made to the URL at
	 *		http://api.bravenewcode.com/api/v/1.1/user/get_info/
	 *
	 *		\param method the name of the BNC API method to execute
	 *		\param command the name of the BNC API command to execute
	 *		\param params an array of parameters to pass to the BNC API request
	 *		\param do_auth indicates whether or not the request requires authorization using the access token
	 */
	function do_api_request( $method, $command, $params = array(), $do_auth = false ) {
		$url = BNC_API_URL . "/{$method}/{$command}/";
		
		// Always use the PHP serialization method for data
		$params['format'] = 'php';
		
		if ( $do_auth ) {
			// Add the timestamp into the request, offseting it by the difference between this server's time and the BNC server's time
			$params['timestamp'] = time() + $this->time_variance;
			
			// Sort the parameters
			ksort( $params );
			
			// Generate a string to use for authorization
			$auth_string = '';
			foreach( $params as $key => $value ) {
				$auth_string = $auth_string . $key . $value;
			}
			
			// Create the authorization hash using the access token
			$params['auth'] = md5( $auth_string . $this->token );
		}
		
        $body_params = array();
        foreach( $params as $key => $value ) {
        	$body_params[] = $key . '=' . urlencode( $value );
        }
        $body = implode( '&', $body_params );
               
        $options = array( 'method' => 'POST', 'timeout' => BNC_API_TIMEOUT, 'body' => $body );
        $options['headers'] = array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=' . get_option('blog_charset'),
            'Content-Length' => strlen( $body ),
            'User-Agent' => 'WordPress/' . get_bloginfo("version") . '/WPtouch-Pro',
            'Referer' => get_bloginfo("url")
        );

        $raw_response = wp_remote_request( $url, $options );
        if ( !is_wp_error( $raw_response ) ) {
        	
        	if ( $raw_response['response']['code'] == 200 ) {
        		$result = unserialize( $raw_response['body'] );
        		
        		$this->response_code = $result['code'];
        		if ( $result['code'] == 407 && !$this->attempting_retry ) {
        			$this->attempting_retry = true;	
        			$this->authenticate();
        			
        			return $this->do_api_request( $method, $command, $params, $do_auth, true );
        		} else { 		
        			return $result;
        		}
        	} else {
        		WPTOUCH_DEBUG( DEBUG_WARNING, "Unable to connect to server. Response code is " . $raw_response['response']['code'] );
        	}
        } 
        
       	$this->server_down = true;        
        return false;
	}
	
	function get_response_code() {
		return $this->response_code;	
	}
	
	function get_product_list() {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid
			);
			
			$result = $this->do_api_request( 'products', 'get_list', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return $result['result']['products'];
			}	
		}	
	
		return false;		
	}
	
	function get_proper_server_name() {
		$server_name = $_SERVER['HTTP_HOST'];
		if ( strpos( $server_name, ':' ) !== false ) {
			$server_params = explode( ':', $server_name );
			
			return $server_params[0];
		} else {
			return $server_name;
		}
	}
	
	function verify_site_license( $product_name ) {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid,
				'site' => $this->get_proper_server_name(),
				'product_name' => $product_name
			);
			
			$result = $this->do_api_request( 'user', 'verify_license', $params, true );
			
			if ( $result and $result['status'] == 'ok' ) {
				return true;
			}	
		}	
	
		return false;			
	}
	
	function get_total_licenses( $product_name ) {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid,
				'product_name' => $product_name
			);
			
			$result = $this->do_api_request( 'user', 'get_license_count', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return $result['result']['count'];
			}	
		}	
	
		return false;			
	}	
	
	function get_product_version( $product_name, $beta = false ) {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid,
				'site' => $this->get_proper_server_name(),
				'product_name' => $product_name
			);
			
			if ( $beta ) {
				$params['type'] = 'beta';	
			}
			
			$result = $this->do_api_request( 'products', 'get_version', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return $result['result']['product'];
			}	
		}	
	
		return false;		
	}	
	
	function get_support_posts( $limit = 5, $beta = false ) {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid,
				'limit' => $limit,
				'site' => $this->get_proper_server_name(),
				'product_name' => 'wptouch-pro'
			);
			
			if ( $beta ) {
				$params['type'] = 'beta';	
			}
			
			$result = $this->do_api_request( 'user', 'get_support_posts', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return $result['result']['topics'];
			}	
		}	
	
		return false;
	}
	
	function post_support_topic( $title, $tags, $desc, $beta = false ) {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid,
				'title' => $title,
				'tags' => $tags,
				'desc' => $desc
			);
			
			if ( $beta ) {
				$params['type'] = 'beta';	
			}
			
			$result = $this->do_api_request( 'user', 'post_support_topic', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return true;
			}	
		}	
	
		return false;		
	}
	
	/*!		\brief Returns information about user associated with the BNCID
	 *		This method returns information about the user associated with the BNCID.  This information includes
	 *		the user's avatar, registration date, friendly name, and profile link.
	 *
	 *		\returns the user's information if successful, false on failure
	 */
	function get_user_info() {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid
			);
			
			$result = $this->do_api_request( 'user', 'get_info', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return $result['result']['user'];
			}
		}		
	
		return false;		
	}
	
	function get_support_topics( $beta = false ) {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid
			);
			
			$result = $this->do_api_request( 'user', 'get_support_topics', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return $result['result']['topics'];
			}
		}		
	
		return false;		
	}
	
	function user_list_licenses( $product_name ) {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid,
				'product_name' => $product_name
			);
			
			$result = $this->do_api_request( 'user', 'list_licenses', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return $result['result'];
			}	
		}	
	
		return false;			
	}
	
	function user_add_license( $product_name ) {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid,
				'product_name' => $product_name,
				'site' => $this->get_proper_server_name()
			);
			
			$result = $this->do_api_request( 'user', 'add_license', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return true;
			}		
		}
	
		return false;			
	}	
	
	function user_remove_license( $product_name, $site_name ) {
		if ( $this->internal_check_token() ) {
			
			$params = array(
				'bncid' => $this->bncid,
				'product_name' => $product_name,
				'site' => $site_name
			);
			
			$result = $this->do_api_request( 'user', 'remove_license', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				return true;
			}
		}
	
		return false;			
	}		
	
	/*! 	\brief Authenticates the BNCID and password and obtains an access token from the server.
	 *		This method negotiates an access token using the BNCID and password passed into
	 *		this classes' constructor.  The authentication flow is as follows:
	 *
	 *			1. Client => Requests authorization nonce from server 
	 *			2. Server => Returns nonce, associating it with the BNCID supplied
	 *			3. Client => Generates encrypted authentication packet using nonce and credentials
	 *			4. Server => Verifies credentials against BNCID information stored on the server
	 *			5. Server => Returns time-limited access token and time synchronization information to prevent replay attacks
	 *		
	 *		The access token returned from the server is only a partial token -- the full token requires knowledge of the password
	 *		associated with the BNCID.
	 */		
	function authenticate() {
		WPTOUCH_DEBUG( WPTOUCH_ERROR, "Authenticating" );
		
		// Don't try to authenticate any further if we know the credentials aren't valid
		if ( $this->credentials_invalid ) {
			return false;	
		}
		
		$nonce = $this->get_authentication_nonce();
		
		if ( $nonce ) {
			$auth_data = array();
			$auth_data['v'] = 1; 
			$auth_data['i'] = $this->bncid;
			$auth_data['n'] = $nonce;
			$auth_data['u'] = str_replace( 'http://', '', strtolower( get_bloginfo( 'url' ) ) );
			
			$authentication_string = gzdeflate( serialize( $auth_data ) );
			
			$auth_token = base64_encode( $authentication_string );
			
			$params = array();
			$params['auth_token'] = $auth_token;
			$params['auth_string'] = md5( $auth_token . $this->license_key );
			
			$auth_result = $this->do_api_request( 'auth', 'get_access_token', $params );
			if ( $auth_result ) {
				if ( $auth_result['status'] == 'ok' ) {
					$partial_token = $auth_result['result']['partial_token'];
					$real_token = md5( $this->license_key . $partial_token );
					
					$token_info = array();
					$token_info['token'] = $partial_token;
					$token_info['expires'] = $auth_result['result']['expires'] + time();
					$token_info['time-variance'] = $auth_result['time'] - time();
					$token_info['last_check'] = time();
					
					update_option( BNC_TOKEN_INFO_SETTING, $token_info );
					
					$this->token = $real_token;
					$this->token_expires = $token_info['expires'];
					$this->last_token_check = time();
					$this->token_checked = true;
					$this->time_variance = $token_info['time-variance'];
											
					return true;
				} else if ( $auth_result['code'] >= 400 && $auth_result['code'] < 500 ) {
					$this->credentials_invalid = true;
					$this->invalidate_all_tokens();
				} 
			}
			
			$this->attempting_retry = false;
		}
		
		return false;
	}
	
	function invalidate_all_tokens() {
		delete_option( BNC_TOKEN_INFO_SETTING );	
	}
	
	/*! 	\brief Checks to see if the access token is still valid
	 *		The result of a successful authentication against the BNC API is an access token 
	 *		that can be used to authorize future requests.  This method checks to see if the access token is still valid.
	 *		If the token has expires or has been revoked, this method will automatically attempt to obtain a new one.
	 */	
	function check_token() {
		if ( !$this->bncid || !$this->license_key ) {
			return false;	
		}
		
		// If we know the credentials are invalid, don't try any more attemps
		if ( $this->credentials_invalid ) {
			return false;
		}
		
		if ( $this->server_down ) {
			return false;	
		}
		
		// Check if our access token is valid
		if ( $this->token ) {
			$params = array();
			$params['bncid'] = $this->bncid;
			
			WPTOUCH_DEBUG( WPTOUCH_ERROR, "Performing server token check" );
			$result = $this->do_api_request( 'auth', 'check_token', $params, true );
			if ( $result and $result['status'] == 'ok' ) {
				$token_info = get_option( BNC_TOKEN_INFO_SETTING, false );
				if ( $token_info ) {
					$token_info['last_check'] = time();
					$this->last_token_check = time();	
					
					update_option( BNC_TOKEN_INFO_SETTING, $token_info );
				}
				
				return true;
			}
		} 
		
		// Generate a new token
		return $this->try_multiple_authentications();
	}
	
	function try_multiple_authentications() {
		$attempts = 1;
		$success = false;
		
		while ( true ) {
			$success = $this->authenticate();
			
			if ( $success ) {
				break;	
			}
						
			$attempts++;
			
			if ( $attempts > BNC_AUTHENTICATION_ATTEMPTS ) {
				break;	
			}	
		}	
		
		return $success;
	}
	
	
	/* Private Functions Start */
	
	//! Quick check to see if the token is still valid or to initiate a server side check periodically
	function internal_check_token() {
		if ( !$this->bncid || !$this->license_key ) {
			return false;	
		}
		
		if ( $this->credentials_invalid ) {
			return false;	
		}
		
		if ( $this->server_down ) {
			return false;	
		}
				
		$succeeded = true;
		
		if ( time() > ( $this->token_expires - 15 ) ) {
			WPTOUCH_DEBUG( WPTOUCH_INFO, "Authenticating due to expiry" );
			$succeeded = $this->try_multiple_authentications();
		}
		
		if ( $succeeded && !$this->token_checked ) {	
			// Cache tokens for 14 seconds
			if ( ( time() - $this->last_token_check ) > 300 ) {	
				WPTOUCH_DEBUG( WPTOUCH_INFO, 'Forcing token check due to cache expiry' );
				$succeeded = $this->check_token();
			}
			
			$this->token_checked = true;
		}
		
		return $succeeded;
	}
	
	//! Helper function to load a file from disk
	function load_file( $file_name ) {
		$loaded_file = '';
		
		$f = fopen( $file_name, 'rb' );
		if ( $f ) {
			while( !feof( $f ) ) {
				$contents = fread( $f, 8192 );
				$loaded_file = $loaded_file . $contents;
			}	
			
			fclose( $f );
			
			return $loaded_file;
		} else {
			return false;	
		}	
	}
	
	//! Retrieves a one-time authentication nonce from the server. Subsequent calls using this method will invalidate previous nonces.
	function get_authentication_nonce() {
		$params = array();
		$params['bncid'] = $this->bncid;
		
		$result = $this->do_api_request( 'auth', 'get_nonce', $params );
		if ( $result ) {
			if ( $result['status'] == 'ok' ) {
				return $result['result']['nonce'];	
			} else if ( $result['code'] == 408 ) {
				// unknown user
				$this->credentials_invalid = true;	
			}
		}
		
		return false;
	}			
	
	function get_license_reset_info( $product_name ) {
		if ( $this->internal_check_token() ) {		
			$params = array();
			$params['bncid'] = $this->bncid;
			$params['product_name'] = $product_name;
			
			WPTOUCH_DEBUG( WPTOUCH_INFO, "Getting license reset information" );
			
			$result = $this->do_api_request( 'user', 'get_license_reset_info', $params, true );
			if ( $result ) {
				if ( $result['status'] == 'ok' ) {
					return $result['result'];	
				} 
			}
		}
		
		return false;		
	}
	
	function reset_all_licenses( $product_name ) {
		if ( $this->internal_check_token() ) {		
			$params = array();
			$params['bncid'] = $this->bncid;
			$params['product_name'] = $product_name;
			
			$result = $this->do_api_request( 'user', 'reset_all_licenses', $params, true );
			if ( $result ) {
				if ( $result['status'] == 'ok' ) {
					return true;	
				} 
			}
		}
		
		return false;			
	}
	
	/* Private Functions End */
		
}
