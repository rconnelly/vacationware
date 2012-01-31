<?php
global $userMeta;
//need to set: $id, $form, $fields
//print_r($form);print_r($fields);

$form_key   = isset($form['form_key'])    ? $form['form_key']     : null;

$html = null;

$html .= $userMeta->createInput( "forms[$id][form_key]", "text", array( 
    "value"     => $form_key,
    "label"     => "Form Name <span class='um_required'>*</span>",
    "id"        => "um_form_$id",
    "class"     => "validate[required]",
    "onkeyup"   => "umChangeFormTitle(this)",
    "after"     => "<br />(Give a name to your form)",
    "enclose"   => "div class='um_left'",
     ) );

//$html .= "<div class='um_left'>";
    //$html .= "<div class='um_left'>";
        //$html .= "<h4>Shortcode</h4>";
        //$html .= "<p>Shortcode</p>";
    //$html .= "<div>";
//$html .= "<div>";

$html .= "<div class='clear'></div>";
$html .= "<br /><br /><br />";

$html .= "<div class='um_left um_block_title'>Fields in your form (Drag from available fields)</div>";
$html .= "<div class='um_right um_block_title'>Available Fields</div>";
$html .= "<div class='clear'></div>";

//Showing selected fields
$html .= "<div class='um_selected_fields um_left um_dropme'>";
if( isset( $form['fields'] ) ) {
    foreach( $form['fields'] as $fieldID ){
        if( isset( $fields[$fieldID] ) ){
            $fieldTitle = isset( $fields[$fieldID]['field_title'] ) ? $fields[$fieldID]['field_title'] : null;
            $html .= "<div class='button'>$fieldTitle ({$fields[$fieldID]['field_type']}) ID:$fieldID<input type='hidden' name='forms[$id][fields][]' value='$fieldID' /></div>";
            unset( $fields[$fieldID] );            
        }
    }    
}
$html .= "</div>";


$html .= "<div class='um_availabele_fields um_right um_dropme'>";
foreach( $fields as $fieldID => $fieldData ){
    $fieldTitle = isset( $fieldData['field_title'] ) ? $fieldData['field_title'] : null;
    $html .= "<div class='button'>$fieldTitle ({$fieldData['field_type']}) ID:$fieldID<input type='hidden' name='forms[$id][fields][]' value='$fieldID' /></div>";    
}
$html .= "</div>";

$html .= "<div class='clear'></div>";

$html .= "<div class='um_block_title'>Drag fields from right block to left block for make them available to your form.</div>";

$html .= "<input type='hidden' name='forms[$id][field_count]' id='field_count_$id' value='' />";


$metaBoxOpen = true;
if( isset($id) )
    if( !($id == 1) ) $metaBoxOpen = false;
    
$metaBoxTitle = ($form_key) ? $form_key : 'New Form';
if( $metaBoxTitle == 'New Form' ) $metaBoxOpen = true;

echo $userMeta->metaBox( $metaBoxTitle, $html, true, $metaBoxOpen );
?>
