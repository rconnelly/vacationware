<?php
if (!class_exists( 'PluginFrameworkWPSupport' )){
    class PluginFrameworkWPSupport {
                
        function verifyNonce( $adminOnly=true ){
            global $pluginFramework;
            $nonce      = $_REQUEST['pf_nonce'];
            $nonceText  = $pluginFramework->settingsArray('nonce');
            if( !wp_verify_nonce( $nonce, $nonceText ) ) die('Security check');     
            
            if( $adminOnly ){
                if( !($this->isAdmin()) )
                    die('Security check');
            }  
                                   
            return true;      
        }
        
        function isAdmin($userID=null){          
            if( $userID )
                return user_can( $userID, 'administrator' );
                
            global $user_ID; 
            return user_can( $user_ID, 'administrator' );               
        }
        
        function getRoleList(){
            global $wp_roles;
            return $wp_roles->role_names;
        }
        
        function getUserRole( $userID ) {
        	$user = get_userdata( $userID );        
        	$user_roles = $user->roles;
        	$user_role = array_shift($user_roles);        
        	return $user_role;
        }        
        
        /**
         * Check field is available or not
         * if no $comparingID is set, $user_ID or $_REQUEST['user_id'] will use for compare
         */
        function isUserFieldAvailable( $fieldName, $fieldValue, $comparingID=null ){
            global $user_ID, $pluginFramework, $wpdb;           
            $unique = true;            
            $wpUserTable = $pluginFramework->wpUserTableFieldsArray();  
       
            // Set $comparingID if not set
            if( !$comparingID ){
                $comparingID = $user_ID;
                $comparingID = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : $comparingID;
            }
              

            if( $fieldName == 'user_login' ) :
                $fieldValue = sanitize_user( $fieldValue, true );
                if( !function_exists( 'username_exists' ) )
                    require_once(ABSPATH . WPINC . '/registration.php');
                $user_id = username_exists( $fieldValue );                
            elseif( $fieldName == 'user_email' ) :
                $fieldValue = sanitize_email( $fieldValue );
                if( !function_exists( 'email_exists' ) )
                    require_once(ABSPATH . WPINC . '/registration.php');
                $user_id = email_exists( $fieldValue );                 
            // Check from wp_users table
            elseif( in_array( $fieldName, $wpUserTable ) ) :
                $user_id = $wpdb->get_var( $wpdb->prepare( 
                	"SELECT ID FROM $wpdb->users WHERE $fieldName = %s", $fieldValue        	
                ) );                 
            // Check by usermeta     
            else :
                $users = get_users( "meta_key=$fieldName&meta_value=$fieldValue&meta_compare='='" ) ;  
                if( count($users) > 0 )
                    $user_id = $users[0]->ID;                           
            endif;
                        
            if( isset($user_id) ){
                if( $user_id ){
                    if( $user_id <> $comparingID )
                        $unique = false;
                }
            }            
            return $unique;
        }
        
        
        /**
         * Add or update user
         * @param array $data: data need to update, both userdata and metadata
         * @param int $userID: if set, user will registered else user update
         */
        function insertUser( $data, $userID=null ){
            global $pluginFramework, $wpdb;
            $error = null;
            
            // Determine Fields
            $wpField = $pluginFramework->defaultUserFieldsArray();
            foreach( $data as $key => $val ){
                $key = is_string($key) ? trim($key) : $key;
                $val = is_string($val) ? trim($val) : $val;
                if( !$key ) continue;
                if( isset($wpField[$key]) )
                    $userdata[$key] = $val;
                else
                    $metadata[$key] = $val;
            }
            
            // sanitize email and user
            if( isset( $userdata['user_email'] ) ) 
                $userdata['user_email'] = sanitize_email( $userdata['user_email'] );                
            if( isset( $userdata['user_login'] ) ) 
                $userdata['user_login'] = sanitize_user( $userdata['user_login'], true );    
             
            // Case of registration
            if( !$userID ){
                if( isset($userdata['user_email']) && !isset( $userdata['user_login'] ) )
                    $userdata['user_login'] = $userdata['user_email'];
                    //$userdata['user_login'] = "user_" . ( (int) $wpdb->get_var( $wpdb->prepare( "SELECT MAX(ID) FROM $wpdb->users;" ) ) + 1 );
                elseif( isset($userdata['user_login']) && !isset( $userdata['user_email'] ) )
                    $userdata['user_email'] = $userdata['user_login'] .'@noreplay.com'; 
                elseif( !isset($userdata['user_login']) && !isset( $userdata['user_email'] ) )    
                    $error = 'Email or Username field should be set';     
                
                if( !isset($userdata['user_pass']) )   
                    $userdata['user_pass'] = wp_generate_password();
                                                
            }else{
                $userdata['ID'] = $userID;
            }      
            
            // Update userdata
            if( !$error ){
                if( $userID )
                    $user_id = wp_update_user( $userdata );
                else
                    $user_id = wp_insert_user( $userdata );
                if( is_wp_error( $user_id ) )
                    $error = $user_id->get_error_message();
            }
            
            // If error found then return
            if( $error )
                return array('error'=>$error);
                
            // send user pass if registration and no pass field is set
            if( !$userID AND !@$data['user_pass'] ){
                $mailSubject = "[" . get_bloginfo('name') . "] Your username and password";
                $mailBody = "
                Username: {$userdata['user_login']} 
                Email: {$userdata['user_email']} 
                Password: {$userdata['user_pass']}            
                ";
                wp_mail( $userdata['user_email'], $mailSubject, $mailBody);
            }
                
                
            // Update metadata   
            if( isset($metadata) ){
    			foreach ($metadata as $key => $value) {
                    if( $userID )
                        update_user_meta( $user_id, $key, $value );
                    else
                        add_user_meta( $user_id, $key, $value );
                }                            
            }  
                       
            return array(
                'ID'=>$user_id,
                'user_login'    => $userdata['user_login'],
                'user_email'    => $userdata['user_email'],
                'user_pass'     => $userdata['user_pass']
            );                              
        }
        
        //sleep    
        /**
         * Register css and js with wp
         * @param string $script: eg: style.css
         * @param boolean $isAdmin : true for admin side and false for frontend (defaullt true)
         * @param $adminPage: adding script only certain admin page
         */
        function registerScript( $script, $isAdmin=true, $adminPage='', $inFramework=false ){
            global $pluginFramework, $tempData;
            $scriptData = explode('.', $script);            
            
            $tempData = new stdClass;
            $tempData->scriptName = $scriptData[0];
            $tempData->scriptType = $scriptData[ count($scriptData) - 1 ];
            $tempData->assetsUrl  = $inFramework ? $pluginFramework->assetsUrl : $pluginFramework->pluginAssetsUrl;
            $tempData->scriptUrl  = $tempData->assetsUrl . $tempData->scriptType . '/' . $script;            
         
            if( $adminPage )  $adminPage = "-" . $adminPage;
            switch ( $tempData->scriptType ){
                case 'css':
                    if($isAdmin):
                        add_action( "admin_print_styles$adminPage", array( __CLASS__,"register" ) );
                    else:
                        add_action( "wp_print_styles", array( __CLASS__,"register" ) );
                    endif;
                break;
                
                case 'js':
                    if($isAdmin):
                        add_action( "admin_print_scripts$adminPage", array( __CLASS__,"register" ) );
                    else:
                        add_action( "wp_print_scripts", array( __CLASS__,"register" ) );
                    endif;         
                break;
            }                     
                                 
        }    
        
        //sleep
        function register(){
            global $tempData;        
            if( $tempData->scriptType == 'css' ) :    
                wp_register_style( $tempData->scriptName, $tempData->scriptUrl );
                wp_enqueue_style( $tempData->scriptName );     
            elseif( $tempData->scriptType == 'js' ) :
                //wp_register_script( $tempData->scriptName, $tempData->scriptUrl  );
                //wp_enqueue_script( $tempData->scriptName );      
                wp_enqueue_script( $tempData->scriptName, $tempData->scriptUrl  );          
            endif;                     
        }  
                
        
          
        /**
         * Upload File, Using wp_handle_upload()
         * return uploaded array(file,url,type,error) on success
         */
        function fileUpload( $name, $mimes=null ){           
            if ( !empty( $_FILES[$name]['name'] ) ){
                if(!$mimes){
        			$mimes = array(
        				'jpg|jpeg|jpe' => 'image/jpeg',
        				'gif' => 'image/gif',
        				'png' => 'image/png',
        				'bmp' => 'image/bmp',
        				'tif|tiff' => 'image/tiff'
        			);                    
                }
    		
    			// front end (theme my profile etc) support
    			if ( ! function_exists( 'wp_handle_upload' ) )
    				require_once( ABSPATH . 'wp-admin/includes/file.php' );
    		
    			return wp_handle_upload( $_FILES[$name], array( 'mimes' => $mimes, 'test_form' => false ) );                      
            }              
        }        
        

        //sleep
        function donation(){
            //return 'Donate Now';
            return "
            <p>If you find this plugins useful, please consider making a donation to keep the coffee brewing.</p>    
            <p><a href='http://khaledsaikat.com/donate-now/'>Donate</a></p>
            <p>Thanks for your support, <a href='http://khaledsaikat.com'>Khaled Saikat</a></p>
            ";
                    
        }         
        
        //sleep
        function runTest(){
            global $pluginFramework;
            echo "Framework Version: " .    $pluginFramework->frameworVersion   ."<br />";
            echo "Framework Url: " .        $pluginFramework->frameworkUrl           ."<br />";
            echo "Framework Path: " .       $pluginFramework->frameworkPath           ."<br />";
            echo "Framework Model Path: " . $pluginFramework->modelsPath ."<br />";
            echo "Framework Assets URL: " . $pluginFramework->assetsUrl ."<br />";
        }
             
        
        
        /**
         * Create meta box 
         * Should be called inside of 'metabox-holder' class div
         */
        function metaBox( $title, $content, $deleteIcon=false, $isOpen=true ){
            global $pluginFramework;
            return $pluginFramework->render( 'metaBox', array( 
                'title'     => $title, 
                'content'   => $content, 
                'deleteIcon'=> $deleteIcon,
                'isOpen'    => $isOpen,
            ) );
            return $html;
        } 
        
        function showError( $error=null, $inAdmin=true ){
            if( !$error ) return false ;           
            $html   = null;
            $single = true;                        
            if( is_array( $error ) ){
                if( count($error) > 1 ){
                    $single = false;
                    foreach( $error as $err )
                        $html .= "<p>$err</p>";
                }else
                    $html .= $error[0];         
            }else
                $html .= $error;
                
            if( $single AND $inAdmin )
                $html = "<p>$html</p>";
            
            return $inAdmin ? "<div class='error'>$html</div>" : "<div class='pf_error'>$html</div>";
        }
        
        function showMessage($message, $type='success', $inAdmin=true ){
            $class = 'pf_' . $type;
            return $inAdmin ? "<div class='updated'><p>$message</p></div>" : "<div class='$class'>$message</div>";
        }        
        
        function userLogin( $user_login=null, $user_pass=null, $remember=false ){
            $creds = array();
            $creds['user_login']    = $user_login ? $user_login : @$_REQUEST['user_login'];
            $creds['user_password'] = $user_pass ? $user_pass : @$_REQUEST['user_pass'];
            $creds['remember']      = isset($remember) ? $remember : @$_REQUEST['remember'];
            
            if( !$creds['user_password'] ) return;           
            return wp_signon( $creds, false );           
        }        
        
                         
                    
    }
}
?>