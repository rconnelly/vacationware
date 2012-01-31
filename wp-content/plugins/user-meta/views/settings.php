<?php
global $userMeta;

$html = null;
$html .= '<form id="um_settings_form" action="" method="post" onsubmit="umUpdateSettings(this); return false;" >';   
    $html .= "<h4>$userMeta->name Version: $userMeta->version</h4>";
    $html .= "<div class='pf_divider'></div>";  
     
     
    // Start Profile Page Selection  
    $html .= "<h4>Profile Page Selection</h4>";      
    $html .= wp_dropdown_pages(array(
        'name'      => 'profile_page',
        'selected'  => isset($profile_page)? $profile_page : null,
        'echo'      => 0,
        'show_option_none'=>'Select a Profile Page ',       
    ));
    $html .= $userMeta->createInput( "profile_in_admin", "checkbox", array(
        "value" => isset($profile_in_admin)? $profile_in_admin : null,
        "after" => " Show profile link to User Administration Page",
    ) );             
    $html .= "<p>Profile page should contain shortcode like: [user-meta type='profile' form='profile']</p>";
    $html .= "<div class='pf_divider'></div>";
    // End Profile Page Selection
    
            
    $html .= $userMeta->createInput( "save_field", "submit", array(
        "value" => "Save Changes",
        "id"    => "update_settings",
        "class" => "button-primary",
    ) );
          
$html .= "</form>";

echo $userMeta->metaBox( "Settings", $html );
?>