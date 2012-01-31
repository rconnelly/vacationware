<?php

/**
 * Import User with meta data
 * -> Use CSV file for importing
 * -> Import user by two steps
 * -> Step1. Upload csv file as wp attachment, and set global variable $csv_file_path by uploaded csv file path
 * -> Step2. Given interface for mearging csv file data with wp data
 */

// always find line endings
//ini_set('auto_detect_line_endings', true);

if( !class_exists( 'umUserImportController' ) ) :
    class umUserImportController {
        
        function __construct(){
            //add_action( 'admin_menu', array( $this, 'admin_menu' ) );        
        }
        
        function admin_menu(){
       	    add_submenu_page( 'usermeta', 'Import User', 'Import User', 'manage_options', 'user-meta-import', array( $this, 'userImport' ) );             
        }
        
        function userImport(){   
            global $userMeta, $message, $csv_file_path, $step;
                 
          	if (!current_user_can('manage_options')) {
            	wp_die( __('You do not have sufficient permissions to access this page.') );
          	}
        
        
            if(isset($_POST)){
                
                if(isset($_POST['stepOne'])){
                    //Try to upload csv file
                    $uploaded_file = $userMeta->fileUpload('csv_file', array('csv' => 'text / csv'));
                    
                    if( !$uploaded_file )
                        $message = new WP_Error( 'error', 'It seems the file was not uploaded correctly.' );
                    elseif( isset( $uploaded_file['error'] ) )   
                        $message = new WP_Error( 'error', $uploaded_file['error'] ); 
                        
                    if( !is_wp_error( $message ) ){
                        $step = 'stepTwo';
                        $csv_file_path = urlencode( $uploaded_file['file'] );
                    }
                        
                                                        
                }elseif(isset($_POST['stepTwo'])){                    
                    $csv_header = $_POST['csv_header'];
                    $selected_field = $_POST['selected_field'];
                    $custom_field = $_POST['custom_field'];
                    $csv_file_path = $_POST['csv_file'];    
                    $step = 'stepTwo';

                    if( $_POST['uniqueField'] == 'email'){
                        if(!in_array('user_email', $selected_field)){
                            $message = new WP_Error( 'error', 'Email field should be selected as any field.' );                                             
                        }                            
                    }elseif( $_POST['uniqueField'] == 'username'){
                        if(!in_array('user_login', $selected_field)){
                            $message = new WP_Error( 'error', 'Username field should be selected as any field.' );
                        }                                                   
                    }elseif( $_POST['uniqueField'] == 'both'){
                        if( !in_array('user_email', $selected_field) OR !in_array('user_login', $selected_field) ){
                            $message = new WP_Error( 'error', 'Email and Username field should be selected as any field.' );
                        }                          
                    }
                    
                    //If error then 
                    if( is_wp_error( $message ) ){
                        $this->inputForm();
                        return;
                    }
                                                
                    if( !file_exists( urldecode($csv_file_path) ) ){
                        echo "<p>File not found!</p>"; 
                        return;      
                    }                        
                                                                          
                    $file = fopen( urldecode($csv_file_path), "r" );
                    $first_row =fgetcsv( $file );
                    set_time_limit(36000);         
                        
                    $n = 0;   $user_added = 0;    $user_updated = 0;  $user_skipped = 0;                    
                    while( !feof($file) ){
                        $rows = fgetcsv( $file );
                        if( !$rows ) continue;
                        $n++;
                        
                        //assign row data to as its header variable
                        foreach( $first_row as $key => $val ){
                            $key_name = trim( $val );
                            $key_value = trim( $rows[$key] );
                            //$key_value = esc_sql($key_value);
                            $$key_name = $key_value;                            
                        }
                    
                        if($_POST['user_role'])
                            $userdata['role'] = $_POST['user_role'];
                        
                        //Populate userdata and metadata array
                        foreach( $selected_field as $key => $val ){
                            if( !( $val == 'none' OR $val == 'custom_field' ) ){
                                $userdata[$val] = $$csv_header[$key];
                            }elseif( $val == 'custom_field' ){
                                if( $custom_field[$key] )
                                    $metadata[$custom_field[$key]] = $$csv_header[$key];
                                else    
                                    $metadata[$csv_header[$key]] = $$csv_header[$key];
                            }
                        }
                                  
                        $userdata['user_email'] = isset( $userdata['user_email'] ) ? sanitize_email($userdata['user_email'])      : null;
                        $userdata['user_login'] = isset( $userdata['user_login'] ) ? sanitize_user($userdata['user_login'], true) : null;
                        
                        if( $_POST['uniqueField'] == 'email' ){
                            if(!$userdata['user_email']) $trigger = 'skip_user';
                            $user_id = email_exists($userdata['user_email']);
                            if(!$user_id){
                                $loginFound = username_exists($userdata['user_login']); 
                                if($loginFound)
                                    $userdata['user_login'] = sanitize_user($userdata['user_email']);
                            }                            
                        }elseif( $_POST['uniqueField'] == 'username' ){
                            if(!$userdata['user_login']) $trigger = 'skip_user';
                            $user_id = username_exists($userdata['user_login']);
                            if(!$user_id){
                                $emailFound = email_exists($userdata['user_email']); 
                                if($emailFound)
                                    $userdata['user_email'] = sanitize_email( $userdata['user_login'] . '@donotreplay.com' );
                            }                                                        
                        }elseif( $_POST['uniqueField'] == 'both' ){
                            if(!$userdata['user_email']) $trigger = 'skip_user';
                            if(!$userdata['user_login']) $trigger = 'skip_user';
                            $user_id = email_exists($userdata['user_email']);
                            if(!$user_id)
                                $user_id = username_exists($userdata['user_login']);                            
                        }                     
                            
                 
                        //assign value to trigger, for makaing decession for next action
                        $overwrite = isset( $_POST['overwrite'] ) ? $_POST['overwrite'] : false;
                        if( ( $overwrite AND $user_id ) )
                            $trigger = 'update_user';
                        elseif(($userdata['user_email'] OR $userdata['user_login']) AND !$user_id)
                            $trigger = 'add_user';
                        else
                            $trigger = 'skip_user';
                                    

                        //Implementation user add/update action
            		    if( $trigger == 'add_user' ){
                            unset($userdata[ 'ID' ]);
                            unset($user_id);                
                            $user_id = wp_insert_user( $userdata );
                            if($user_id){
                                echo "<span style='color:green'>$n. {$userdata['user_login']} <b>(Created)</b></span><br />";
                                $user_added++;
                            }                    
            		    }                            
                        elseif( $trigger == 'update_user' ){
                            $userdata[ 'ID' ] = $user_id;
                            if(wp_update_user( $userdata )){
                                echo "<span style='color:blue'>$n. {$userdata['user_login']} <b>(Updated)</b></span><br />";
                                $user_updated++;
                            }                
                        }else{
                            echo "<span style='color:red'>$n. {$userdata['user_login']} <b>(Skipped)</b></span><br />";
                            $user_skipped++;
                        }
                            
                        //Add/Update user meta   
                        if( isset($metadata) ){
                			foreach ($metadata as $key => $value) {
                			    if( $trigger == 'add_user' )
                                    add_user_meta( $user_id, $key, $value );
                                elseif( $trigger == 'update_user' )
                                    update_user_meta( $user_id, $key, $value );
                            }                            
                        } 
         
                        
                        //Unset all value            
                        foreach($first_row as $key_name){
                            $key_name = trim($key_name);
                            unset($$key_name);
                        }  
                        unset($userdata);
                        unset($metadata);                        

                    }  
                    
                    fclose($file);
                    $message = new WP_Error( "updated", "CSV file have been imported successfully. User added: $user_added, User updated: $user_updated, User skipped: $user_skipped" );
                }
                
                $this->inputForm();
            }
        }
        
        function importTab(){
            global $wp_roles, $step, $csv_file_path, $userMeta;
            $roles = $wp_roles->role_names;             
            
            echo '<form action="" method="post" enctype="multipart/form-data">';           
            if($step == 'stepTwo'):
                if( !file_exists( urldecode($csv_file_path) ) ){
                    echo "<p>File not found!</p>"; 
                    return;      
                }
                              
                                       
                $file = fopen( urldecode($csv_file_path), "r" );
            
                echo $userMeta->createInput( 'stepTwo', 'ok', 'hidden' );
                echo $userMeta->createInput( 'csv_file', $csv_file_path, 'hidden' );                
                
                $default = isset( $_POST['uniqueField'] ) ? $_POST['uniqueField'] : 'email';
                echo $userMeta->createInput( 'uniqueField', $default, 'radio', array( "label"=>"<b>Identify Uniquely</b>", "enclose"=>"p", "after"=>"<br/>" ), array( "email"=>" By Email", "username"=>" By Username", "both"=>" By Both Email and Username") );
                
                $csvHeader = fgetcsv($file);      
                echo "<table><tr><td>CSV Header</td><td>Related Field</td><td>Custom Field Name</td></tr>";                       
                foreach($csvHeader as $key => $header){
                    echo "<input type='hidden' name='csv_header[]' value='$header' />";
                    $field_list  = $userMeta->listDefaultUserFields();
                    $field_added = array('none' => '', 'custom_field' => 'Custom Field');
                    $field_list  = array_merge($field_added, $field_list);
                    $selected_field = isset( $_POST['selected_field'][$key] ) ? $_POST['selected_field'][$key] : 'none';
                    $dropdown = $userMeta->createInput('selected_field[]', $selected_field, 'select', array('have_key' => true), $field_list);  
                    $customFieldValue = isset( $_POST['custom_field'][$key] ) ? $_POST['custom_field'][$key] : '';                 
                    $customField = $userMeta->createInput('custom_field[]', $customFieldValue);
                    echo "<tr><td>$header</td><td>$dropdown</td><td>$customField</td></tr>";
                }
                fclose($file);                    
                $selectedUserRole = isset( $_POST['user_role'] ) ? $_POST['user_role'] : 'subscriber';                            
                echo "</table>";
                echo "<br /><br /><p>User Role : " . $userMeta->createInput('user_role', $selectedUserRole, 'select', array('have_key' => true), $roles) . "</p>";
                
                $checked = isset( $_POST['overwrite'] ) ? true : false;
                echo $userMeta->createInput( 'overwrite', 'Overwrite existing users', 'checkbox', array('enclose'=>'p', 'checked'=>$checked ) );
                echo $userMeta->createInput( '', 'Import ', 'submit', array('enclose'=>'p') );             
            
            else:                                
                echo "<p>Please select the CSV file you want to import below.</p>";
                echo $userMeta->createInput( 'stepOne', 'ok', 'hidden');
                echo $userMeta->createInput( 'csv_file', '', 'file', array('enclose'=>'p') );
                echo $userMeta->createInput( '', ' Next ', 'submit', array('enclose'=>'p') );
            endif;
            
            echo "</form>";                                                                              
        }
        
        
        function inputForm(){
            global $message, $userMeta;
            add_meta_box( "user_meta", "User Import", array( $this, 'importTab' ), "import_tab", 'side', 'high' );
            add_meta_box( "user_meta", "Donations", array( $userMeta, 'donation' ), "donation_tab", 'side', 'high' );
            
            ?>
            <div class="wrap">
                <?php
                    if( is_wp_error($message) )
                        echo "<br /><div class='".$message->get_error_code()."'>" .$message->get_error_message(). "</div>";
                ?>		
            	<div id="icon-users" class="icon32"><br /></div>
            	<h2>User Meta Import</h2>    
                
                <div id="dashboard-widgets-wrap">
                    <div class="metabox-holder">
                        <div style="float:left; width:70%;" class="inner-sidebar1">
                            <?php do_meta_boxes( 'import_tab','side','' ); ?>
                        </div>
                                            
                        <div style="float:right; width:28%;" class="inner-sidebar1">
                            <?php do_meta_boxes( 'donation_tab','side','' ); ?>
                        </div>
                    </div>
                </div>                                   
            </div>                			          
            <?php
        }        
    }
endif;

?>