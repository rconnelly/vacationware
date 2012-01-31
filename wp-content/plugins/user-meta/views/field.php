
<?php 
global $userMeta;

$field_type_data    = $userMeta->getFields( 'key', $field_type );
$field_type_title   = $field_type_data['title'];
$field_group          = $field_type_data['field_group'];
$field_types_options = $userMeta->getFields( 'field_group', $field_group, 'title', !$userMeta->isPro );

if( $field_group == 'wp_default' )
    $field_title = isset($field_title) ? $field_title : $field_types_options[$field_type];


$fieldTitle = $userMeta->createInput( "fields[$id][field_title]", "text", array( 
    "value"     => isset($field_title) ? $field_title : null, 
    "label"     => "Field Title", 
    "id"        => "field_title_$id",
    "class"     => "um_input",
    "onkeyup"     => "umChangeFieldTitle(this)",
    //"after"     => "<div>(Title that will be shown on frontend)</div>",
    "enclose"   => "div class='um_segment'",
 ) );

$fieldTypes = $userMeta->createInput( "fields[$id][field_type]", "select", array( 
    "value"     => isset($field_type) ? $field_type : null,
    "label"     => "Field Type", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
    "onchange"  => "umChangeField(this, $id)",
    "by_key"    => true,
 ), $field_types_options ); 

$fieldDescription = $userMeta->createInput( "fields[$id][description]", "textarea", array( 
    "value"     => isset($description) ? $description : null,
    "label"     => "Field Description", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
 ) ); 
 
$fieldMetaKey = $userMeta->createInput( "fields[$id][meta_key]", "text", array( 
    "value"     => isset($meta_key) ? $meta_key : null,
    "label"     => "Meta Key", 
    "class"     => "um_input",
    "after"     => "<div style='margin-right:20px;'><span class='um_required'>Required Field.</span> Field data will save by metakey. Without defining metakey, field data will not be saved. e.g country_name (unique and no space)</div>",
    "enclose"   => "div class='um_segment'",
 ) );  
 
$fieldDefaultValue = $userMeta->createInput( "fields[$id][default_value]", "textarea", array( 
    "value"     => isset($default_value) ? $default_value : null,
    "label"     => "Default Value", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
 ) );
 
$fieldOptions = $userMeta->createInput( "fields[$id][options]", "textarea", array( 
    "value"     => isset($options) ? $options : null,
    "label"     => "Field Options", 
    "class"     => "um_input",
    "after"     => "<div style='margin-right:20px;'><span class='um_required'>Required Field.</span> (e.g itm1, itm2) for Key Value: itm1=Item 1, itm2=Item 2</div>",
    "enclose"   => "div class='um_segment'",
 ) );  
 
$fieldRequired = $userMeta->createInput( "fields[$id][required]", "checkbox", array( 
    "value"     => isset($required) ? $required : null,
    "after"     => " Required <br />",
 ) ); 
  
$fieldAdminOnly = $userMeta->createInput( "fields[$id][admin_only]", "checkbox", array( 
    "value"     => isset($admin_only) ? $admin_only : null,
    "after"     => " Admin Only <br />",
 ) );     
 
$fieldReadOnly = $userMeta->createInput( "fields[$id][read_only]", "checkbox", array( 
    "value"     => isset($read_only) ? $read_only : null,
    "after"     => " Read Only for all user<br />",
 ) ); 
 
$fieldReadOnly .= $userMeta->createInput( "fields[$id][read_only_non_admin]", "checkbox", array( 
    "value"     => isset($read_only_non_admin) ? $read_only_non_admin : null,
    "after"     => " Read Only for non admin <br />",
 ) );   
 
$fieldUnique = $userMeta->createInput( "fields[$id][unique]", "checkbox", array( 
    "value"     => isset($unique) ? $unique : null,
    "after"     => " Unique <br />",
 ) );  
 
$fieldNonAdminOnly = $userMeta->createInput( "fields[$id][non_admin_only]", "checkbox", array( 
    "value"     => isset($non_admin_only) ? $non_admin_only : null,
    "after"     => " Non-Admin Only <br />",
 ) );  
 
$fieldRegistrationOnly = $userMeta->createInput( "fields[$id][registration_only]", "checkbox", array( 
    "value"     => isset($registration_only) ? $registration_only : null,
    "after"     => " Only On Registration Page <br />",
 ) );    
 
$fieldTitlePosition = $userMeta->createInput( "fields[$id][title_position]", "select", array( 
    "value"     => isset($title_position) ? $title_position : null,
    "label"     => "Title Position", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
    "by_key"    => true,
 ), array( 'top'=>'Top', 'hidden'=>'Hidden' ) );

$fieldCssClass = $userMeta->createInput( "fields[$id][css_class]", "text", array( 
    "value"     => isset($css_class) ? $css_class : null,
    "label"     => "CSS Class", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
 ) );
 
$fieldCssStyle = $userMeta->createInput( "fields[$id][css_style]", "textarea", array( 
    "value"     => isset($css_style) ? $css_style : null,
    "label"     => "CSS Style", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
 ) ); 
 
$fieldSize = $userMeta->createInput( "fields[$id][field_size]", "text", array( 
    "value"     => isset($field_size) ? $field_size : null,
    "label"     => "Field Size", 
    "class"     => "um_input",
    "after"     => "<div>(e.g. 200px;)</div>",
    "enclose"   => "div class='um_segment'",
 ) ); 
 
$fieldMaxChar = $userMeta->createInput( "fields[$id][max_char]", "text", array( 
    "value"     => isset($max_char) ? $max_char : null,
    "label"     => "Max Char", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
 ) );   
 

// For wp_default fields
$fieldForceUsername = $userMeta->createInput( "fields[$id][force_username]", "checkbox", array( 
    "value"     => isset($force_username) ? $force_username : null,
    "after"     => " Force to change username <br />",
 ) ); 
$fieldRetypeEmail = $userMeta->createInput( "fields[$id][retype_email]", "checkbox", array( 
    "value"     => isset($retype_email) ? $retype_email : null,
    "after"     => " Retype Email <br />",
 ) ); 
$fieldRetypePassword = $userMeta->createInput( "fields[$id][retype_password]", "checkbox", array( 
    "value"     => isset($retype_password) ? $retype_password : null,
    "after"     => " Retype Password <br />",
 ) );  
$fieldPasswordStrength = $userMeta->createInput( "fields[$id][password_strength]", "checkbox", array( 
    "value"     => isset($password_strength) ? $password_strength : null,
    "after"     => " Show password strength meter <br />",
 ) );   
 
$fieldShowDivider = $userMeta->createInput( "fields[$id][show_divider]", "checkbox", array( 
    "value"     => isset($show_divider) ? $show_divider : null,
    "after"     => " Show Divider <br />",
 ) );     
 
$fieldRichText = $userMeta->createInput( "fields[$id][rich_text]", "checkbox", array( 
    "value"     => isset($rich_text) ? $rich_text : null,
    "after"     => " Use Rich Text <br />", 
 ) ); 
   
 
 $fieldNameFormat = $userMeta->createInput( "fields[$id][name_format]", "select", array( 
    "value"     => isset($name_format) ? $name_format : null,
    "label"     => "Name Format", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
    "by_key"    => true,
 ), array( 'name'=>'Full Name', 'first_last'=>'First and Last Name', 'first_middle_last'=>'First, Middle and Last Name' ) ); 
 
$fieldAllowedExtension = $userMeta->createInput( "fields[$id][allowed_extension]", "text", array( 
    "value"     => isset($allowed_extension) ? $allowed_extension : null,
    "label"     => "Allowed Extension", 
    "class"     => "um_input",
    "after"     => "<div>(default: jpg,png,gif)</div>",
    "enclose"   => "div class='um_segment'",
 ) );   

$fieldDateTimeSelection = $userMeta->createInput( "fields[$id][datetime_selection]", "select", array( 
    "value"     => isset($datetime_selection) ? $datetime_selection : null,
    "label"     => "Type Selection", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
    "by_key"    => true,
 ), array( 'date'=>'Date', 'time'=>'Time', 'datetime'=>'Date and Time' ) ); 
 
$fieldCountrySelectionType = $userMeta->createInput( "fields[$id][country_selection_type]", "select", array( 
    "value"     => isset($country_selection_type) ? $country_selection_type : null,
    "label"     => "Save meta value by", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
    "by_key"    => true,
 ), array( 'by_country_code'=>'Country Code', 'by_country_name'=>'Country Name' ) ); 

$fieldMaxNumber = $userMeta->createInput( "fields[$id][max_number]", "text", array( 
    "value"     => isset($max_number) ? $max_number : null,
    "label"     => "Maximum Number", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
 ) );  
 
$fieldMinNumber = $userMeta->createInput( "fields[$id][min_number]", "text", array( 
    "value"     => isset($min_number) ? $min_number : null,
    "label"     => "Minimum Number", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
 ) );  
 
$fieldMaxFileSize = $userMeta->createInput( "fields[$id][max_file_size]", "text", array( 
    "value"     => isset($max_file_size) ? $max_file_size : null, 
    "label"     => "Max File size", 
    "class"     => "um_input",
    "after"     => "<div>(in KB. Default: 1024KB)</div>",
    "enclose"   => "div class='um_segment'",
 ) );
 
$fieldImageWidth = $userMeta->createInput( "fields[$id][image_width]", "text", array( 
    "value"     => isset($image_width) ? $image_width : null, 
    "label"     => "Image Width (px)", 
    "class"     => "um_input",
    "after"     => "<div>(For Image Only. e.g. 640)</div>",
    "enclose"   => "div class='um_segment'",
 ) );
 
$fieldImageHeight = $userMeta->createInput( "fields[$id][image_height]", "text", array( 
    "value"     => isset($image_height) ? $image_height : null, 
    "label"     => "Image Height (px)", 
    "class"     => "um_input",
    "after"     => "<div>(For Image Only. e.g. 480)</div>",
    "enclose"   => "div class='um_segment'",
 ) );  
 
$fieldCaptchaPublicKey = $userMeta->createInput( "fields[$id][captcha_public_key]", "text", array( 
    "value"     => isset($captcha_public_key) ? $captcha_public_key : null, 
    "label"     => "reCaptcha Public Key",
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
 ) );  
 
$fieldCaptchaPrivateKey = $userMeta->createInput( "fields[$id][captcha_private_key]", "text", array( 
    "value"     => isset($captcha_private_key) ? $captcha_private_key : null, 
    "label"     => "reCaptcha Private Key", 
    "class"     => "um_input",
    "enclose"   => "div class='um_segment'",
 ) );
 




$html  = "$fieldTitle $fieldTypes $fieldTitlePosition $fieldDescription";

//Single Field
if( $field_type == 'user_login' ):
    $html .= "$fieldSize";
    $html .= "<div class='um_segment'>$fieldAdminOnly</div>";
    $html .= "$fieldMaxChar $fieldCssClass $fieldCssStyle";  
    $html .= "<div class='um_segment'><p>By default, <b>Required</b> and <b>Unique</b> validation will be set with this field. <b>Read Only</b> will be set conditionaly.</p></div>";   

elseif( $field_type == 'user_email' ):
    $html .= "$fieldSize";
    $html .= "<div class='um_segment'>$fieldRetypeEmail $fieldAdminOnly $fieldReadOnly</div>";
    $html .= "$fieldMaxChar $fieldCssClass $fieldCssStyle";  
    $html .= "<div class='um_segment'><p>By default, <b>Required</b> and <b>Unique</b> validation will be set with this field.</p></div>";   

elseif( $field_type == 'user_pass' ):
    $html .= "$fieldSize";
    $html .= "<div class='um_segment'>$fieldRetypePassword $fieldPasswordStrength $fieldAdminOnly $fieldReadOnly</div>";
    $html .= "$fieldMaxChar $fieldCssClass $fieldCssStyle";  
    $html .= "<div class='um_segment'><p><b>Required</b> validation will be set automatically when password field is being used by registration.</p></div>";   


//elseif( $field_type == 'user_nicename' ):    
//elseif( $field_type == 'user_url' ):
//elseif( $field_type == 'user_registered' ):
//elseif( $field_type == 'display_name' ):
//elseif( $field_type == 'first_name' OR $field_type == 'last_name' ):

elseif( $field_type == 'description' ):
    $html .= "$fieldSize";
    $html .= "<div class='um_segment'>$fieldRichText $fieldRequired $fieldAdminOnly $fieldReadOnly $fieldUnique</div>";
    $html .= "$fieldMaxChar $fieldCssClass $fieldCssStyle"; 
    
elseif( $field_type == 'role' ):
    $html .= "$fieldDefaultValue";
    $html .= "<div class='um_segment'>$fieldRequired $fieldAdminOnly $fieldReadOnly $fieldUnique</div>";
    $html .= "$fieldSize $fieldMaxChar $fieldCssClass $fieldCssStyle";     

elseif( $field_type == 'user_avatar' ): 
    $html .= "$fieldAllowedExtension"; 
    $html .= "<div class='um_segment'>$fieldRequired $fieldAdminOnly $fieldReadOnly</div>";  
    $html .= "$fieldMaxFileSize";
    $html .= "$fieldCssClass $fieldCssStyle"; 

    
    
    
elseif( $field_type == 'hidden' ):  
    $html .= "$fieldMetaKey";
    $html .= "<div class='um_segment'>$fieldAdminOnly</div>";  
    $html .= "$fieldDefaultValue";    
        
elseif( $field_type == 'select' OR $field_type == 'checkbox' OR $field_type == 'radio' ):    
    $html .= "$fieldMetaKey";
    $html .= "<div class='um_segment'>$fieldRequired $fieldAdminOnly $fieldReadOnly $fieldUnique</div>";
    $html .= "$fieldDefaultValue $fieldOptions";
    $html .= "$fieldSize $fieldCssClass $fieldCssStyle";
    
// Default property for fields. if no single settings are found
elseif( $field_group == 'wp_default' ):
    $html .= "$fieldSize";
    $html .= "<div class='um_segment'>$fieldRequired $fieldAdminOnly $fieldReadOnly $fieldUnique</div>";
    $html .= "$fieldMaxChar $fieldCssClass $fieldCssStyle"; 

// Rendering Pro field
elseif( ( $field_group == 'standard' && !@$field_type_data['is_free'] ) || ( $field_group == 'formatting' ) ) :
    $html .= $userMeta->renderPro( 'fieldPro', array(
        'field_type'        => $field_type,
        'fieldMetaKey'      => $fieldMetaKey,
        'fieldRequired'     => $fieldRequired,
        'fieldAdminOnly'    => $fieldAdminOnly,
        'fieldReadOnly'     => $fieldReadOnly,
        'fieldUnique'       => $fieldUnique,
        'fieldDefaultValue' => $fieldDefaultValue,
        'fieldSize'         => $fieldSize,
        'fieldMaxChar'      => $fieldMaxChar,
        'fieldCssClass'     => $fieldCssClass,
        'fieldCssStyle'     => $fieldCssStyle,
        'fieldNonAdminOnly' => $fieldNonAdminOnly,
        'fieldRegistrationOnly' => $fieldRegistrationOnly,
        
        'fieldDateTimeSelection'=> $fieldDateTimeSelection,
        'fieldRetypePassword'   => $fieldRetypePassword,
        'fieldPasswordStrength' => $fieldPasswordStrength,
        'fieldRetypeEmail'      => $fieldRetypeEmail,
        'fieldAllowedExtension' => $fieldAllowedExtension,
        'fieldImageWidth'       => $fieldImageWidth,
        'fieldImageHeight'      => $fieldImageHeight,
        'fieldMaxFileSize'      => $fieldMaxFileSize,
        'fieldMinNumber'        => $fieldMinNumber,
        'fieldMaxNumber'        => $fieldMaxNumber,
        'fieldCountrySelectionType' => $fieldCountrySelectionType,
        'fieldShowDivider'      => $fieldShowDivider,
    ) );
     

elseif( $field_group == 'standard' ):
    $html .= "$fieldMetaKey";
    $html .= "<div class='um_segment'>$fieldRequired $fieldAdminOnly $fieldReadOnly $fieldUnique</div>";
    $html .= "$fieldDefaultValue";
    $html .= "$fieldSize $fieldMaxChar $fieldCssClass $fieldCssStyle";     
    
endif;    





$html = "<div id='field_$id'>$html</div>";  

$field_title = isset($field_title) ? $field_title : 'New Field';
$metaBoxTitle = "<span class='um_admin_field_title'>$field_title</span> (<span class='um_admin_field_type'>$field_type_title</span>) ID:$id";

$metaBoxOpen = true;
if( isset($n) )
    if( !($n == 1) ) $metaBoxOpen = false;

echo $userMeta->metaBox( $metaBoxTitle, $html, true, $metaBoxOpen );

?>