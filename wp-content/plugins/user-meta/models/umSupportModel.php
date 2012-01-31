<?php

if( !class_exists( 'umSupportModel' ) ) :
class umSupportModel {
    
    function umFields(){                
        $fieldsList = array(
        
            //WP default fields
            'user_login' => array(
                'title'         => 'Username',
                'field_group'     => 'wp_default',  
                'is_free'       => true, 
            ),
            'user_email' => array(
                'title'         => 'Email',
                'field_group'     => 'wp_default',
                'is_free'       => true,
            ),   
            'user_pass' => array(
                'title'         => 'Password',
                'field_group'     => 'wp_default',
                'is_free'       => true,
            ),   
            /*'user_nicename' => array(
                'title'         => 'Nicename',
                'field_group'     => 'wp_default', 
            ), */            
            'user_url' => array(
                'title'         => 'Website',
                'field_group'     => 'wp_default',
                'is_free'       => true,
            ),   
            'display_name' => array(
                'title'         => 'Display Name',
                'field_group'     => 'wp_default',  
                'is_free'       => true, 
            ),   
            'nickname' => array(
                'title'         => 'Nickname',
                'field_group'     => 'wp_default',   
                'is_free'       => true,
            ),   
            'first_name' => array(
                'title'         => 'First Name',
                'field_group'     => 'wp_default',  
                'is_free'       => true,
            ),   
            'last_name' => array(
                'title'         => 'Last Name',
                'field_group'     => 'wp_default',   
                'is_free'       => true,
            ),   
            'description' => array(
                'title'         => 'Biographical Info',
                'field_group'     => 'wp_default',  
                'is_free'       => true, 
            ),   
            'user_registered' => array(
                'title'         => 'Registration Date',
                'field_group'     => 'wp_default',  
                'is_free'       => true,
            ),   
            'role' => array(
                'title'         => 'Role',
                'field_group'     => 'wp_default',  
                'is_free'       => true,
            ),   
            'jabber' => array(
                'title'         => 'Jabber',
                'field_group'     => 'wp_default',  
                'is_free'       => true,
            ),   
            'aim' => array(
                'title'         => 'Aim',
                'field_group'     => 'wp_default', 
                'is_free'       => true, 
            ),   
            'yim' => array(
                'title'         => 'Yim',
                'field_group'     => 'wp_default',
                'is_free'       => true,
            ),   
            'user_avatar' => array(
                'title'         => 'Avatar',
                'field_group'     => 'wp_default',  
                'is_free'       => true,
            ),             
            
         
            //Standard Fields
            'text' => array(
                'title'         => 'Textbox',
                'field_group'     => 'standard',
                'is_free'       => true,   
            ),   
            'textarea' => array(
                'title'         => 'Paragraph',
                'field_group'     => 'standard',
                'is_free'       => true,   
            ),   
            'rich_text' => array(
                'title'         => 'Rich Text',
                'field_group'     => 'standard',
                'is_free'       => true,   
            ),  
            'hidden' => array(
                'title'         => 'Hidden Field',
                'field_group'     => 'standard',
                'is_free'       => true,   
            ),                       
            'select' => array(
                'title'         => 'Drop Down',
                'field_group'     => 'standard',
                'is_free'       => true,   
            ),   
            'checkbox' => array(
                'title'         => 'Checkbox',
                'field_group'     => 'standard',
                'is_free'       => true,  
            ),   
            'radio' => array(
                'title'         => 'Select One (radio)',
                'field_group'     => 'standard',
                'is_free'       => true,  
            ),     
            'datetime' => array(
                'title'         => 'Date / Time',
                'field_group'     => 'standard',
                'is_free'       => false,
            ),                      
            'password' => array(
                'title'         => 'Password',
                'field_group'     => 'standard', 
                'is_free'       => false,
            ),    
            'email' => array(
                'title'         => 'Email',
                'field_group'     => 'standard',
                'is_free'       => false,
            ),             
            'file' => array(
                'title'         => 'File Upload',
                'field_group'     => 'standard',
                'is_free'       => false,
            ), 
            'image_url' => array(
                'title'         => 'Image URL',
                'field_group'     => 'standard',  
                'is_free'       => false,
            ),                   
            'phone' => array(
                'title'         => 'Phone Number',
                'field_group'     => 'standard',  
                'is_free'       => false,
            ), 
            'number' => array(
                'title'         => 'Number',
                'field_group'     => 'standard', 
                'is_free'       => false, 
            ), 
            'url' => array(
                'title'         => 'Website',
                'field_group'     => 'standard', 
                'is_free'       => false,
            ),                          
            'country' => array(
                'title'         => 'Country',
                'field_group'     => 'standard', 
                'is_free'       => false,
            ),      
            /*'scale' => array(
                'title'         => 'Scale',
                'field_group'     => 'standard',  
            ),*/           
            
            
            //Formating Fields
            'page_heading' => array(
                'title'         => 'Page Heading',
                'field_group'     => 'formatting',  
                'is_free'       => false,
            ),                                     
            'section_heading' => array(
                'title'         => 'Section Heading',
                'field_group'     => 'formatting',  
                'is_free'       => false,
            ),                                                                        
            'html' => array(
                'title'         => 'HTML',
                'field_group'     => 'formatting',  
                'is_free'       => false,
            ),                                     
            'captcha' => array(
                'title'         => 'Captcha',
                'field_group'     => 'formatting',  
                'is_free'       => false,
            ),                                                         
        );        
        return $fieldsList;                    
    }
    
    function isValidFormType( $type ){
        $data = array(
            'profile', 'registration', 'both', 'none', 'login'
        );
        return in_array( $type , $data ) ? true : false;
    }
    
    function adminPageUrl( $page ){
        if( $page == 'fields_editor' ) :
            $link   = 'usermeta';
            $label  = 'Fields Editor';
        elseif( $page == 'forms_editor' ) :
            $link   = 'user-meta-form-editor';
            $label  = 'Forms Editor';
        elseif( $page == 'settings' ) :    
            $link = 'user-meta-settings';
            $label  = 'Settings';
        endif;
        if( !@$link ) return;
        
        $url = admin_url( "admin.php?page=$link" );
        return "<a href='$url'>$label</a>";
    }
    
    /**
     * Get fields by 
     * @param $by: key, field_group
     * @param $value: 
     */    
    function getFields( $by=null, $param=null, $get=null, $isFree=false ){
        $fieldsList = self::umFields();
        
        if( !$by )
            return $fieldsList;
        
        //$result = array();
        if( $param ){
            if( $by == 'key' ){
                if( key_exists( $param, $fieldsList ) )
                    return $fieldsList[$param];
            }else{
                foreach( $fieldsList as $key => $fieldData ){
                    if( $fieldData[$by] == $param ){
                        if( $isFree ){
                            if( !$fieldData['is_free'] ) continue;
                        }
                                                
                        if( !$get )
                            $result[$key] = $fieldData;
                        else    
                            $result[$key] = $fieldData[$get];
                    }
                }
            }
        }      
        
        return isset( $result ) ? $result : false;
    }    
    
    
    /**
     * Extract fielddata from fieldID
     * @param $fieldID
     * @param $fieldData : if $fieldData not set the it will search for field option for fielddata
     * @return array: field Data
     */
    function getFieldData( $fieldID, $fieldData=null ){
        global $userMeta;       
        
        if( !$fieldData ){
            $fields = get_option( $userMeta->options['fields'] );
            if( !isset($fields[$fieldID]) ) return;
            $fieldData = $fields[$fieldID];
        }
        
        //Setting Field Group
        $field_type_data   = $userMeta->getFields( 'key', $fieldData['field_type'] );
        $field_group        = $field_type_data['field_group'];                
                
        //Setting Field Name
        $fieldName = null;
        if( $field_group == 'wp_default' ){
            $fieldName = $fieldData['field_type'];
        }else{
           if( isset($fields[$fieldID]['meta_key']) )
                $fieldName = $fieldData['meta_key'];
        }              
        
        // Check if field is readonly
        $readOnly = @$fieldData['read_only'];
        if( !@$readOnly AND @$fieldData['read_only_non_admin'] )
            $readOnly = $userMeta->isAdmin() ? false : true;          
        
        $returnData = $fieldData;
        $returnData['field_id']     = $fieldID;
        $returnData['field_group']    = $field_group;
        $returnData['field_name']   = $fieldName;
        $returnData['meta_key']     = isset($fieldData['meta_key']) ? $fieldData['meta_key'] : null;
        $returnData['field_title']  = isset($fieldData['field_title']) ? $fieldData['field_title'] : null;
        $returnData['required']     = isset($fieldData['required']) ? true : false;
        $returnData['unique']       = isset($fieldData['unique']) ? true : false;
        $returnData['read_only']    = @$readOnly;
        
        return $returnData;
    }


    /**
     * Validate input field from a form
     * @param $form_key
     * @return array: key=field_name 
     */
    function formValidInputField( $form_key ){
        global $userMeta;
        $forms  = get_option( $userMeta->options['forms'] );        
        if( !isset($forms[$form_key]['fields']) ) return;
        
        foreach( $forms[$form_key]['fields'] as $fieldID ){
            $fieldData  = $this->getFieldData( $fieldID );
            if( $fieldData['field_group'] == 'wp_default' OR $fieldData['field_group'] == 'standard' ){
                if( $fieldData['field_group'] == 'standard' AND !isset($fieldData['meta_key']) ) continue;
                if( @$fieldData['read_only'] ) continue;
                   
                $validField[ $fieldData['field_name'] ]['field_title'] = $fieldData['field_title'];
                $validField[ $fieldData['field_name'] ]['required']    = $fieldData['required'];
                $validField[ $fieldData['field_name'] ]['unique']      = $fieldData['unique'];              
            }        
        }
        
        return isset($validField) ? $validField : null;
    }
    
    function removeCache( $cacheType, $cacheValue, $byKey=true ){
        global $userMeta;
        
        $cache   = get_option( $userMeta->options['cache'] );
        if( isset($cache[$cacheType]) ){            
            if( !is_array( $cacheValue ) )
                $cacheValue = array($cacheValue);
                
            foreach( $cacheValue as $key => $val ){
                $cacheKey = $val;
                if( !$byKey )
                    $cacheKey = array_search( $val, $cache[$cacheType] );   
                unset( $cache[$cacheType][$cacheKey] );             
            }
            update_option( $userMeta->options['cache'], $cache );
        }           
    }
    
    
    function upgradeFrom_1_0_3(){
        global $userMeta;     
        
        $cache = get_option( $userMeta->options['cache'] ); 
        if( isset( $cache['upgrade']['1.0.3']['fields_upgraded'] ) )
            return;        
           
        // Check if upgrade is needed
        $fields = get_option( $userMeta->options['fields'] );
        $exists = false;
        if( $fields ){
            if( is_array($fields) ){
                foreach( $fields as $value ){
                    if( isset($value['field_type']) )
                        $exists = true;
                }
            }
        }
        if($exists) return;
        
        $i = 0;        
        // get Default fields
        $prevDefaultFields  = get_option( 'user_meta_field_checked' );
        if( $prevDefaultFields ){
            foreach( $prevDefaultFields as $fieldName => $noData  ){   
                if( $fieldName == 'avatar' ) $fieldName = 'user_avatar';
                $fieldData = $this->getFields( 'key', $fieldName );
                if( !$fieldData ) continue;
                $i++;
                $newField[$i]['field_title']    = isset($fieldData['title']) ? $fieldData['title'] : null;
                $newField[$i]['field_type']     = $fieldName;
                $newField[$i]['title_position'] = 'top';
            }
        }        
        
        // get meta key
        $prevFields         = get_option( 'user_meta_field' );
        if( $prevDefaultFields ){
            foreach( $prevFields as $fieldData  ){                
                if( !$fieldData ) continue;
                $i++;
                $fieldType = $fieldData['meta_type'] == 'dropdown' ? 'select' : 'text';
                $newField[$i]['field_title']    = isset($fieldData['meta_label']) ? $fieldData['meta_label'] : null;
                $newField[$i]['field_type']     = $fieldType;
                $newField[$i]['title_position'] = 'top';
                $newField[$i]['description']    = isset($fieldData['meta_description']) ? $fieldData['meta_description'] : null;
                $newField[$i]['meta_key']       = isset($fieldData['meta_key']) ? $fieldData['meta_key'] : null;
                $newField[$i]['required']       = $fieldData['meta_required'] == 'yes' ? 'on' : null;
                if( isset($fieldData['meta_option']) ){
                    if( $fieldData['meta_option'] AND is_string($fieldData['meta_option']) ){
                        $options = $userMeta->arrayRemoveEmptyValue( unserialize($fieldData['meta_option'] ) );
                        if( $options )
                            $newField[$i]['options'] = implode( ',', $options );
                    }
                }  
                $newField[$i] = $userMeta->arrayRemoveEmptyValue( $newField[$i] );            
            }
        }       
        
        // Defining Form data
        $newForm['profile']['form_key'] = 'profile';
        $n = 0;
        while( $n < $i ){
            $n++;
            $newForm['profile']['fields'][] = $n;
        }
        
        if( isset($newField) ){
            update_option( $userMeta->options['fields'], $newField );
            update_option( $userMeta->options['forms'], $newForm );
            $cache['upgrade']['1.0.3']['fields_upgraded'] = true; 
            update_option( $userMeta->options['cache'], $cache);                       
        }
        
        return true;       
    }
    
    function upgradeAvatarFrom_1_0_3(){
        global $userMeta;
        
        $cache = get_option( $userMeta->options['cache'] ); 
        if( isset( $cache['upgrade']['1.0.3']['avatar_upgraded'] ) )
            return;
        
        $users = get_users( array(
            'meta_key' => 'user_meta_avatar',
        ) );       
        if( !$users ) return;
        
        $uploads = wp_upload_dir();
        foreach( $users as $user ){
            $oldUrl = get_user_meta( $user->ID, 'user_meta_avatar', true );
            if( $oldUrl ){
                $newPath = str_replace( $uploads['baseurl'], '', $oldUrl );
                update_user_meta( $user->ID, 'user_avatar', $newPath );
            }
        }
                     
        $cache['upgrade']['1.0.3']['avatar_upgraded'] = true; 
        update_option( $userMeta->options['cache'], $cache);
    
        return true;        
    }
    
    function runningUpgrade(){
        $this->upgradeFrom_1_0_3();
        $this->upgradeAvatarFrom_1_0_3();
    }
    
    function isUpgradationNeeded(){
        global $userMeta;
        
        // check upgrade flug
        $cache = get_option( $userMeta->options['cache'] );
        if( isset( $cache['upgrade']['1.0.3']['fields_upgraded'] ) )
            return false;        
           
        // Check data exists in new version
        $fields = get_option( $userMeta->options['fields'] );
        $exists = false;
        if( $fields ){
            if( is_array($fields) ){
                foreach( $fields as $value ){
                    if( isset($value['field_type']) )
                        $exists = true;
                }
            }
        }
        if($exists) return false;   
        
        $prevDefaultFields  = get_option( 'user_meta_field_checked' ); 
        $prevFields         = get_option( 'user_meta_field' );
        if( $prevDefaultFields or $prevFields )
            return true;             
    }
    
    function onPluginActivation(){
        global $userMeta;
        
        $userMeta->upgradeFrom_1_0_3();
        
        $cache = get_option( $userMeta->options['cache'] ); 
        $cache['version']       = $userMeta->version; 
        $cache['version_type']  = 'free';  
        update_option( $userMeta->options['cache'], $cache );     
        
        wp_schedule_single_event(time()+10, 'user_meta_running_upgrade');     
    }
    
    function onPluginDeactivation(){
         
    }
    
    function boxHowToUse(){
        $html = null;
        $html .= "<p><strong>Step 1.</strong> Create Field from User Meta " . $this->adminPageUrl('fields_editor') . " page.</p>";
        $html .= "<p><strong>Step 2.</strong> Go to User Meta " . $this->adminPageUrl('forms_editor') . " page. Choose a Form Name, drag and drop fields from right to left and save the form.</p>";
        $html .= "<p><strong>Step 3.</strong> write shortcode to your page or post. Shortcode (e.g.): [user-meta type='profile' form='your_form_name']</p>";
        $html .= "<div><center><a class='button-primary' href='http://wordpress-extend.com' target='_blank'>Visit Plugin Site</a></center></div>";
        return $html;
    }
    
    function boxGetPro(){
        $html = null;
        $html .= "<div style='padding-left: 10px'>";
        $html .= "<p>Get <strong>User Meta Pro</strong> for : </p>";
        $html .= "<li>To activate all fields.</li>";
        $html .= "<li>Frontend Registration.</li>";
        $html .= "<li>Frontend Login.</li>";
        $html .= "<br />";
        $html .= "<center><a class='button-primary' href='http://wordpress-extend.com'>Get User Meta Pro</a></center>";
        $html .= "</div>";
        return $html;
    }    
    
    function boxShortcodesDocs(){
        $html = null;
        $html .= "<div style='padding-left: 10px'>";
        $html .= "<p><strong>[user-meta type='type_name' form='your_form_name']</strong></p>";
        $html .= "<li><strong>type='profile'</strong> for showing profile page.</li>";
        $html .= "<li><strong>type='none'</strong> for hiding update button.</li>";
        $html .= "<li><strong>type='registration'</strong> for showing registration page.</li>";
        $html .= "<li><strong>type='both'</strong> for showing profile page if user loged in, or showing registration page, if not user loged in.</li>";
        $html .= "<li><strong>type='login'</strong> for showing login page.</li>";
        $html .= "<p></p>";
        $html .= "<p>N.B. 'registration', 'both' and 'login' is only supported in pro version.</p>";
        $html .= "<p>Admin user can see all others frontend profile from User Administration screen. To enable this feature, go to User Meta >> Settings, select profile page from Profile Page Selection and enable right sided checkbox.</p>";
        $html .= "<p>In Case of extra field, you need to define unique meta_key. That meta_key will be use to save extra data in usermeta table. Without defining meta_key, extra data won't save.</p>";
        $html .= "<center><a class='button-primary' href='http://wordpress-extend.com/documentation/' target='_blank'>Read Moe</a></center>";
        $html .= "</div>";
        return $html;        
    }
    
    function getProLink( $label=null ){
        $label = $label ? $label : "http://wordpress-extend.com";
        return "<a href='http://wordpress-extend.com' target='_blank'>$label</a>";
    }
    
    
    function showNotice(){
        global $userMeta;

        if( $this->isUpgradationNeeded() ){
            echo $userMeta->showError( "We found that, you have previous data which you may need to import. <span class='button' onclick='umUpgradeFromPrevious(this)'>Click Here</span> to import"  );            
        }
    }
    
    function ajaxUmCommonRequest(){
        global $userMeta;
        $userMeta->verifyNonce();        
        $this->runningUpgrade();
        die();
    }    
    
    function getProfileLink( $pre=null ){
        global $userMeta;
        $settings = get_option( $userMeta->options['settings'] );
        if( @$settings['profile_page'] ){
            $link = get_permalink( @$settings['profile_page'] );
            return "$pre <a href='$link'>Profile</a>";
        }
    }
    
    function loadControllers(){
        global $userMeta;
                                 
        $classes = array();
        foreach( scandir( $userMeta->controllersPath ) as $file ) {
            if( preg_match( "/.php$/i" , $file ) )
                $classes[ str_replace( ".php", "", $file ) ] = $userMeta->controllersPath . $file;            
        }          
        
        $userMeta->isPro = false;
        if( @$userMeta->isPro ){
            $proDir = $userMeta->controllersPath . 'pro/';
            if( file_exists( $proDir ) ){
                foreach( scandir( $proDir ) as $file ) {
                    if( preg_match( "/.php$/i" , $file ) )
                        $classes[ str_replace( ".php", "", $file ) ] = $proDir . $file; 
                }                  
            }          
        }
        
        foreach( $classes as $className => $classPath ){
            require_once( $classPath );
            $instance[] = new $className;
        }
        
        return $instance;        
    }     

    function renderPro( $viewName, $parameter = array() ){
        global $userMeta;        
        
        if( @$userMeta->isPro AND file_exists( $userMeta->viewsPath . 'pro/' . $viewName . '.php' ) )
            $viewPath = $userMeta->viewsPath . 'pro/' . $viewName . '.php';
        else{
            $viewPath = $userMeta->viewsPath . $viewName . '.php';
            if( !file_exists( $viewPath ) ) return;
        }
        
        if( $parameter ) extract($parameter);            
        $pageReturn = include $viewPath;
        if( $pageReturn AND $pageReturn <> 1 )
            return $pageReturn;
        if( @$html ) return $html;        
    }       

}
endif;
?>