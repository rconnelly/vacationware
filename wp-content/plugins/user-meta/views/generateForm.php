<?php
global $userMeta;
//get veriable by render: $actionType, $fields, $form, $userData


// Counting page
$pageCount = 0;
if( !$form['fields'] )
    return $html = $userMeta->showMessage( 'Form not found.', 'error', false );

foreach( $form['fields'] as $fieldID ){
    if( isset($fields[$fieldID]) ){
        if( $fields[$fieldID]['field_type'] == 'page_heading' )
            $pageCount++;
    }
}

 
$html = null;
$html .= "<form methode='post' action='' id='um_user_form' onsubmit='umInsertUser(this); return false;' >";
    if( $form['fields'] ):
        
        $inPage     = false;
        $inSection  = false;
        $isNext     = false;
        $isPrevious = false;
        $currentPage= 0;
        foreach( $form['fields'] as $fieldID ){
            if( isset($fields[$fieldID]) ){
               
                //Setting Field Group
                $field_type_data   = $userMeta->getFields( 'key', $fields[$fieldID]['field_type'] ); 
                $fieldGroup        = $field_type_data['field_group'];
                
                //Setting Field Name
                $fieldName = null;
                if( $fieldGroup == 'wp_default' ){
                    $fieldName = $fields[$fieldID]['field_type'];
                }else{
                   if( isset($fields[$fieldID]['meta_key']) )
                        $fieldName = $fields[$fieldID]['meta_key'];
                }                
                               
                //Setting Field Value
                $fieldValue = null;
                if( isset( $fields[$fieldID]['default_value'] ) )
                    $fieldValue = $fields[$fieldID]['default_value'];    
                if( $actionType == 'profile' OR $actionType == 'none' ){
                    if( isset( $userData->$fieldName ) )
                        $fieldValue = $userData->$fieldName;
                }            
                

                  
                    
                //IF page is started then set true to $inPage or continue
                //$inPage  = ( $fields[$fieldID]['field_type'] == 'page_heading' )  ? true : $inPage;
                // = ( $fields[$fieldID]['field_type'] == 'group_heading' ) ? true : $inGroup;      
                if( $fields[$fieldID]['field_type'] == 'page_heading' ){
                    $currentPage++;
                    $isNext     = $currentPage >= 2 ? true : false;
                    $isPrevious = $currentPage >  2 ? true : false;      
                }                
                                         
                $fields[$fieldID]['field_id']    = $fieldID;
                $fields[$fieldID]['field_name']  = $fieldName;
                $fields[$fieldID]['field_value'] = $fieldValue;
                $html .= $userMeta->renderPro( 'generateField', array( 
                    'field'         => $fields[$fieldID],
                    'actionType'    => $actionType,
                    'userID'        => $userID,
                    'inPage'        => $inPage,
                    'inSection'     => $inSection,
                    'isNext'        => $isNext,
                    'isPrevious'    => $isPrevious,
                    'currentPage'   => $currentPage,
                ) );
                
                if( $fields[$fieldID]['field_type'] == 'page_heading' ){
                    $inPage    = true;
                    $inSection = false;
                }
                    
                if( $fields[$fieldID]['field_type'] == 'section_heading' )
                    $inSection = true;                    
                //$inPage  = ( $fields[$fieldID]['field_type'] == 'page_heading' )  ? true : $inPage;
                //$inGroup = ( $fields[$fieldID]['field_type'] == 'group_heading' ) ? false : $inGroup;                 
                
            }               
        }
        
        // Similar to generateField: field_type==page_heading
        if( $inSection )
            $html .= "</div>";             
        if( $pageCount >= 2){
            $previousPage = $currentPage - 1 ;
            $html .= "<input type='button' onclick='umPageNavi($previousPage)' value='Previous'>";
            //$html .= "<div id='um_page_heading_$previousPage' onclick='umPageNavi($previousPage)' class='button'>Previuos</div>"; 
        }                           

        // End
                       
        $html .= $userMeta->createInput( "form_key", "hidden", array(
            "value"     => $form['form_key'],
        ) );      
   
       
        if( $actionType == 'profile' )
            $buttonValue = 'Update';
        elseif( $actionType == 'registration' )
            $buttonValue = 'Register';  
                      
        $html .= $userMeta->createInput( "action_type", "hidden", array(
            "value"     => $actionType,
        ) ); 
        $html .= $userMeta->createInput( "user_id", "hidden", array(
            "value"     => $userID,
        ) );     
        $html .= "<script>user_id=$userID</script>";        
        
        if( isset( $buttonValue ) ){
            $html .= $userMeta->createInput( "um_sibmit_button", "submit", array(
                "value"     => $buttonValue,
                "id"        => "insert_user",
            ) );
        }
        
        
        if( $inPage )
            $html .= "</div>";    
            
    endif;
$html .= "</form>";    

    
?>


<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            
            umPageNavi( 1, false );
            
            $(".um_rich_text").wysiwyg({initialContent:""});  
            
            $(".um_datetime").datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:ss' });
            $(".um_date").datepicker({ dateFormat: 'yy-mm-dd' });   
            $(".um_time").timepicker({timeFormat: 'hh:mm:ss'});  
            
            $(".pass_strength").password_strength();    
            
            umFileUploader( '<?php  echo $userMeta->pluginUrl . '/framework/helper/uploader.php' ?>' );    
                      
        });      
    })(jQuery)
</script>