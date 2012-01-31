<?php

if( !class_exists( 'umFormsController' ) ) :
    class umFormsController {
        
        function __construct(){      
            add_action('admin_menu', array( $this, 'menuItem' ) );    
            
            add_action( 'wp_ajax_um_add_form',      array($this, 'ajaxAddForm' ) ); 
            add_action( 'wp_ajax_um_update_forms',  array($this, 'ajaxUpdateForms' ) );                
        }
        
        
        function menuItem(){
            global $userMeta;
 
            $page = add_submenu_page( 'usermeta', 'User Meta Forms Editor', 'Forms Editor', 'manage_options', 'user-meta-form-editor', array( $this, 'init' ));            
            $userMeta->addScript( 'jquery-ui-core',     'admin', $page );
            $userMeta->addScript( 'jquery-ui-widget',   'admin', $page );
            $userMeta->addScript( 'jquery-ui-mouse',    'admin', $page );
            $userMeta->addScript( 'jquery-ui-sortable', 'admin', $page );
            $userMeta->addScript( 'jquery-ui-draggable', 'admin', $page );
            $userMeta->addScript( 'jquery-ui-droppable', 'admin', $page );
            
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
                       
            $forms  = get_option( $userMeta->options['forms'] );
            $fields = get_option( $userMeta->options['fields'] );
            $userMeta->render( 'formsEditorPage', array( 'forms'=>$forms, 'fields'=>$fields ) );
        }
        
        
        function ajaxAddForm(){
            global $userMeta;
            $userMeta->verifyNonce(); 
            
            $fields = get_option( $userMeta->options['fields'] );            
            $userMeta->render( 'form', array( 'id'=>$_POST['id'], 'fields'=>$fields ) );
            die();
        }
        
        
        function ajaxUpdateForms( ){
            global $userMeta;
            $userMeta->verifyNonce();
            
            $error = null;
            $data = array();
            if( isset( $_POST['forms'] ) ){
                foreach( $_POST['forms'] as $formID => $formData ){
                    if( $formData['field_count'] ) {
                        foreach( $formData['fields'] as $fieldID => $fieldKey ){
                            if( $fieldID >= $formData['field_count'] )
                                unset( $formData['fields'][$fieldID] );
                        }
                    }     
                    unset( $formData['field_count'] );
                    
                    if( !$formData['form_key'] )
                        $error[] = "All form keys are required!";
                    if( isset( $data[ $formData['form_key'] ] ) )
                        $error[] = "Form key should be unique. '{$formData['form_key']}' is duplicated!";                   
                        
                    $data[ $formData['form_key'] ] = $formData;               
                }
            }           
            
            if( $error ){
                echo $userMeta->showError( $error );
                die();
            }
            
            update_option( $userMeta->options['forms'], $data );            
            echo $userMeta->showMessage( 'Form Successfully saved.' );
            die();
        }
        
            
    }
    
endif;      
  
?>