<?php

if( !class_exists( 'umSettingsController' ) ) :
    class umSettingsController {
        
        function __construct() {
            add_action('admin_menu', array( $this, 'admin_menu' )); 
            add_action( 'wp_ajax_um_update_settings', array($this, 'ajaxUpdateSettings' ) );
        }

        function admin_menu(){
            global $userMeta;
            
            //$page = add_menu_page( 'User Meta', 'User Meta', 'manage_options', 'usermeta', array( $this, 'init' ), $userMeta->assetsUrl . 'images/user-icon.png', 73 );
            $page = add_submenu_page( 'usermeta', 'User Meta Settings', 'Settings', 'manage_options', 'user-meta-settings', array( $this, 'init' ));            
           
            
            $userMeta->addScript( 'plugin-framework.js',  'admin', $page );
            $userMeta->addScript( 'plugin-framework.css', 'admin', $page );
            $userMeta->addScript( 'user-meta.js',         'admin', $page ); 
            $userMeta->addScript( 'user-meta.css',        'admin', $page );      
//            
//            $userMeta->addScript( 'validationEngine-en.js', 'admin', $page, 'jquery' ); 
//            $userMeta->addScript( 'validationEngine.js',    'admin', $page, 'jquery' );    
//            $userMeta->addScript( 'validationEngine.css',   'admin', $page, 'jquery' );             
        }  
        
        function init(){
            global $userMeta;
            //do_action( 'um_admin_page_init' );
            
            $settings = get_option( $userMeta->options['settings'] );
            $userMeta->render("settingsPage", array('settings'=>$settings));            
            
            // Running avatar upgrade
            if( isset( $_REQUEST['run_upgrade'] ) )
                $userMeta->runningUpgrade();           
        }
        
        function ajaxUpdateSettings(){
            global $userMeta;
            $userMeta->verifyNonce();
            
            unset( $_REQUEST['action'] );
            
            $settings = $userMeta->arrayRemoveEmptyValue( $_REQUEST );                      
            update_option( $userMeta->options['settings'], $settings );
            
            echo $userMeta->showMessage( 'Settings Successfully Saved.' );
            die();
        }
               

        
    }
    
endif;

?>