<?php

if( !class_exists( 'umFieldsController' ) ) :
    class umFieldsController {
        
        function __construct(){      
            add_action('admin_menu', array( $this, 'menuItem' ) );    
            
            add_action( 'wp_ajax_um_add_field',    array($this, 'ajaxAddField' ) ); 
            add_action( 'wp_ajax_um_change_field', array($this, 'akaxChangeField' ) ); 
            add_action( 'wp_ajax_um_update_field', array($this, 'ajaxUpdateField' ) );                
        }
        
        function menuItem(){
            global $userMeta;

            $page = add_utility_page( 'User Meta', 'User Meta', 'manage_options', 'usermeta', array( $this, 'init' ), $userMeta->assetsUrl . 'images/user-icon.png' ); 
            $page = add_submenu_page( 'usermeta', 'User Meta Fields Editor', 'Fields Editor', 'manage_options', 'usermeta', array( $this, 'init' ));     
                   
            $userMeta->addScript( 'jquery-ui-core',     'admin', $page );
            $userMeta->addScript( 'jquery-ui-widget',   'admin', $page );
            $userMeta->addScript( 'jquery-ui-mouse',    'admin', $page );
            $userMeta->addScript( 'jquery-ui-sortable', 'admin', $page );
            $userMeta->addScript( 'jquery-ui-draggable','admin', $page );
            $userMeta->addScript( 'jquery-ui-droppable','admin', $page );
            
            $userMeta->addScript( 'plugin-framework.js',  'admin', $page );
            $userMeta->addScript( 'plugin-framework.css', 'admin', $page );
            $userMeta->addScript( 'user-meta.js',         'admin', $page ); 
            $userMeta->addScript( 'user-meta.css',        'admin', $page );      
            
            $userMeta->addScript( 'validationEngine-en.js', 'admin', $page, 'jquery' ); 
            $userMeta->addScript( 'validationEngine.js',    'admin', $page, 'jquery' ); 
            $userMeta->addScript( 'validationEngine.css',   'admin', $page, 'jquery' );           
        }
                  
                              
        function init(){   
            global $userMeta;        
            //do_action( 'um_admin_page_init' );
                    
            $fields = get_option( $userMeta->options['fields'] );
            $userMeta->render( 'fieldsEditorPage', array( 'fields'=>$fields ) );
        }
        
        
        function ajaxAddField(){
            global $userMeta;
            $userMeta->verifyNonce();
                      
            if( isset( $_REQUEST['field_type'] ) ){
                unset( $_REQUEST['action'] );
                $userMeta->render( 'field', $_REQUEST );
            }
            
            die();
        }
        
        
        function akaxChangeField(){
            global $userMeta;
            $userMeta->verifyNonce();
            
            if( !isset( $_POST['fields'] ) ) return;
            
            $data       =  $_POST['fields'] ;
            $fieldID    = key( $data );
                       
            $fieldData       = $data[$fieldID];
            $fieldData['id'] = $fieldID;          
            
            $userMeta->render( 'field', $fieldData );
            
            die();            
        }
        
        
        function ajaxUpdateField( ){
            global $userMeta;                        
            $userMeta->verifyNonce();            
                 
            $data = array();
            if( isset( $_POST['fields'] ) )
                $data = $userMeta->arrayRemoveEmptyValue( $_POST['fields'] );
     
            update_option( $userMeta->options['fields'], $data );
            
            echo $userMeta->showMessage( 'Fields Successfully Saved.' );
            die();
        }
        
            
    }
endif;      
  
?>