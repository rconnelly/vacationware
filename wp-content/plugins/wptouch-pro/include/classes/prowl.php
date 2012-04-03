<?php

class Prowl
{
	var $api_key;
	var $application;
	
	function Prowl( $api_key, $application ) {
		$this->api_key = $api_key;
		$this->application = $application;
	}
   
	function add( $priority, $event, $description ) {
		$options = array(
			'apikey' => $this->api_key,
			'priority' => $priority,
			'application' => $this->application,
			'event' => urlencode( $event ),
			'description' => urlencode( $description )
		);
		
		$response = $this->request( 'https://prowl.weks.net/publicapi/add', $options, true );
		
		return ( $this->get_result( $response ) == 200 );
	}
   
	function get_result( $response ) {
		$response = str_replace( "\n", " ", $response );
	
		if( preg_match( "/code=\"200\"/i", $response ) ) {
			return 200;
		} else {
			preg_match( "/<error.*?>(.*?)<\/error>/i", $response, $out );
			return $out[1];
		}
	}
   
	function verify() {
		$options = array( 'apikey' => $this->api_key );
		return $this->get_result( $this->request( 'https://prowl.weks.net/publicapi/verify', $options ) );
	}
   
	function request( $file, $options, $post_request = false ) {		
		$params = array();		
		foreach ( $options as $key => $value ) {
			$params[] = $key . '=' . $value;
		}
				
		if ( $post_request ) {
			$url = $file;
		} else {
			$url = $file . '?' . implode( '&', $params );
		}

		// This needs to be rewritten to not use curl
		$ch = curl_init($url);
		
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		
		if ( $post_request ) {
			curl_setopt( $ch, CURLOPT_POST, 1 );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, implode( '&', $params ) );	
		}
		
		$response = curl_exec( $ch );
		curl_close( $ch );
		
		return $response;
	}
}

function prowl_is_supported() {
	return ( extension_loaded('openssl') && function_exists( 'fsockopen' ) );
}
