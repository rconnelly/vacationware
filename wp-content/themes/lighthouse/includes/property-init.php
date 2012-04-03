<?php
// Creates property post type
add_action('init', 'ts_post_type_property');

function ts_post_type_property() 
{
		  $labels = array(
			'name' => __('Property','templatesquare'),
			'singular_name' => 'Property',
			'add_new' => __('Add New','templatesquare'),
			'add_new_item' => __('Add New Property','templatesquare'),
			'edit_item' => __( 'Edit Property','templatesquare'),
			'new_item' => __( 'Add New Property','templatesquare'),
			'view_item' => __( 'View Property','templatesquare'),
			'search_items' => __( 'Search Property','templatesquare'),
			'not_found' => __( 'No property found','templatesquare'),
			'not_found_in_trash' => __( 'No property found in trash','templatesquare' )
		  );
		 
		 $args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' =>true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 9,
			'has_archive' => true,
			'exclude_from_search' =>true,
			'supports' => array('title', 'editor', 'author', 'thumbnail')); 
		 
		  register_post_type('property',$args);
		  
		  register_taxonomy('propertytag','property',array(
			'hierarchical' => false,
			'label' => __('Property Tags'),
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'propertytag' ),
		  ));
		  
}

$prefix = 'ts_';


$optpropertytype 	= get_option("templatesquare_property_type");
$optlistingtype 	= get_option("templatesquare_listing_type");
$currencyunit 		= get_option("templatesquare_property_currency");
$areaunit 			= get_option("templatesquare_property_area_unit");
$lotunit 			= get_option("templatesquare_property_lot_unit");

$maxsleeps			= get_option("templatesquare_property_num_sleeps");

$numsleeps = array();
for($i=1;$i<=$maxsleeps;$i++){
	$numsleeps[] = $i;
}

$maxbed				= get_option("templatesquare_property_num_bed");

$numbed = array();
for($i=1;$i<=$maxbed;$i++){
	$numbed[] = $i;
}

$maxbath			= get_option("templatesquare_property_num_bath");
$numbath = array();
for($i=1;$i<=$maxbath;$i++){
	$numbath[] = $i;
}

$options = array(
	"property_type" 	=> explode(",",$optpropertytype),
	"listing_type" 		=> explode(",",$optlistingtype)
);



$meta_boxes=array();


$meta_boxes[] = array(
	'id' => 'property-address-form-meta-box',
	'title' => __('Property Address','templatesquare'),
	'page' => 'property',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Street Address','templatesquare'),
			'desc' => '',
			'id' => $prefix.'address',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('City','templatesquare'),
			'desc' => '',
			'id' => $prefix.'city',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('State','templatesquare'),
			'desc' => '',
			'id' => $prefix.'state',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Zip Code', 'templatesquare'),
			'desc' => '',
			'id' => $prefix.'zipcode',
			'type' => 'text',
			'std' => ''
		),
	)
);



$meta_boxes[] = array(
	'id' => 'property-listing-info-form-meta-box',
	'title' => __('Listing Info','templatesquare'),
	'page' => 'property',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		/*
		array(
			'name' => __('Price','templatesquare'),
			'desc' => 'Input your price with numbers only. The currency is \''.$currencyunit.'\'',
			'id' => $prefix .'price',
			'type' => 'text',
			'class' => 'mini',
			'std' => ''
		),
		array(
			'name' => __('Listing Type','templatesquare'),
			'desc' => '',
			'id' => $prefix.'listingType',
			'type' => 'select',
			'options' => $options["listing_type"],
			'std' => ''
		),
		array(
			'name' => __('Property Type','templatesquare'),
			'desc' => '',
			'id' => $prefix.'propertyType',
			'type' => 'select',
			'options' => $options["property_type"],
			'std' => ''
		),
          		*/
		array(
			'name' => __('Listing Title','templatesquare'),
			'desc' => '',
			'id' => $prefix.'listingTitle',
			'type' => 'select',
			'options' => array('Use default post title','Use address as title'),
			'std' => 'Use default post title'
		),
		array(
            'name' => __('Short Description'),
            'id' => $prefix.'shortDescription',
            'type' => 'textarea',
            'maxlength' => '200',
            'rows' => '2',
            'desc' => 'Short text that will show up in listings (200 character max).',
            'std' => ''
        ),
		array(
			'name' => __('Slider','templatesquare'),
			'desc' => __('Show in slideshow on homepage'),
			'id' => $prefix.'listingSlider',
			'type' => 'checkbox',
			'std' => false
		),
		array(
			'name' => __('Featured','templatesquare'),
			'desc' => __('Show on home page featured section. Will show a max of 10 properties on home page.'),
			'id' => $prefix.'listingFeatured',
			'type' => 'checkbox',
			'std' => true
		),
		array(
			'name' => __('Note','templatesquare'),
			'desc' => '',
			'id' => $prefix.'listingNote',
			'type' => 'textarea',
			'std' => ''
		),
	)
);


$meta_boxes[] = array(
	'id' => 'property-detailed-info-form-meta-box',
	'title' => __('Detailed Info','templatesquare'),
	'page' => 'property',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

        array(
            'name' => __('Rates'),
            'desc' => '',
            'id' => $prefix.'rates',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'name' => __('Maximum Occupancy'),
            'desc' => '',
            'id' => $prefix.'sleeps',
            'options' => $numsleeps,
            'type' => 'select',
            'std' => '8'
        ),
		array(
			'name' => __('Beds','templatesquare'),
			'desc' => '',
			'id' => $prefix.'beds',
			'type' => 'select',
			'options' => $numbed,
			'std' => ''
		),
		array(
			'name' => __('Baths','templatesquare'),
			'desc' => '',
			'id' => $prefix.'baths',
			'options' => $numbath,
			'type' => 'select',
			'std' => ''
		),
        array(
            'name' => __('Policies'),
            'desc' => '',
            'id' => $prefix.'policies',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'name' => __('Virtual Tour Link'),
            'desc' => '',
            'id' => $prefix.'virtualTourLink',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => __('Calendar Link'),
            'desc' => '',
            'id' => $prefix.'calendarLink',
            'type' => 'text',
            'std' => ''
        ),
		/*
		array(
			'name' => __('Fireplace Features','templatesquare'),
			'desc' => '',
			'id' => $prefix.'fireplaceFeatures',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Heating Features','templatesquare'),
			'desc' => '',
			'id' => $prefix.'heatingFeatures',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('External Construction','templatesquare'),
			'desc' => '',
			'id' => $prefix.'externalConstruction',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Roofing','templatesquare'),
			'desc' => '',
			'id' => $prefix.'roofing',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('Interior Features','templatesquare'),
			'desc' => '',
			'id' => $prefix.'interiorFeatures',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => __('Exterior Features','templatesquare'),
			'desc' => '',
			'id' => $prefix.'exteriorFeatures',
			'type' => 'textarea',
			'std' => ''
		),
		*/
	)
);

$meta_boxes[] = array(
	'id' => 'property-images-form-meta-box',
	'title' => __('Property Images','templatesquare'),
	'page' => 'property',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Upload Images','templatesquare'),
			'desc' => '',
			'id' => $prefix.'uploadimg',
			'type' => 'upload',
			'std' => ''
		),
	)
);


add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
	global $meta_boxes;
 
	$i = 1;
	foreach($meta_boxes as $meta_box){
		add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box'.$i, $meta_box['page'], $meta_box['context'], $meta_box['priority']);
		$i++;
	}
}
 
// Callback function to show fields in meta box
function mytheme_show_box1() {
	global $meta_boxes, $post;
 
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo mytheme_create_metabox($meta_boxes[0]);
}

// Callback function to show fields in meta box
function mytheme_show_box2() {
	global $meta_boxes, $post;
 
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo mytheme_create_metabox($meta_boxes[1]);
}

// Callback function to show fields in meta box
function mytheme_show_box3() {
	global $meta_boxes, $post;
 
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo mytheme_create_metabox($meta_boxes[2]);
}

// Callback function to show fields in meta box
function mytheme_show_box4() {
	global $meta_boxes, $post;
 
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo mytheme_create_metabox($meta_boxes[3]);
}


// Create Metabox Form Table
function mytheme_create_metabox($meta_box){

	global $post;
	
	$returnstring = "";
	
	$returnstring .= '<table class="form-table">';
 
	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
 
		$returnstring .= '<tr>'.
				'<th style="width:20%"><label for="'. $field['id']. '">'. $field['name']. '</label></th>'.
				'<td>';
		switch ($field['type']) {
 
//If Text		
			case 'text':
				$textvalue = $meta ? $meta : $field['std'];
				$widthinput = "97%";
				$prefixinput = "";
				$postfixinput = "";
				if(isset($field['class'])){
					if($field['class']=="mini"){
						$widthinput = "20%";
					}
				}
				if(isset($field['prefix'])){
					$prefixinput = stripslashes(trim($field['prefix']));
				}
				if(isset($field['postfix'])){
					$postfixinput = stripslashes(trim($field['postfix']));
				}
				$returnstring .= $prefixinput.'<input type="text" name="'. $field['id']. '" id="'. $field['id']. '" value="'. $textvalue .'" size="30" style="width:'.$widthinput.'" /> '.$postfixinput.
					'<br />'. $field['desc'];
				break;
 
 
//If Text Area			
			case 'textarea':
				$textvalue = $meta ? $meta : $field['std'];
				$maxlength = ($field['maxlength']) ? $field['maxlength'] : '';
				$cols = ($field['cols']) ? $field['cols'] : '60';
                $rows = ($field['rows']) ? $field['rows'] : '4';
				$returnstring .= '<textarea name="'. $field['id']. '" id="'. $field['id']. '" maxlength="'.$maxlength.'" cols="'.$cols.'" rows="'.$rows.'" style="width:97%">'. $textvalue .'</textarea>'.
					'<br />'. $field['desc'];
				break;
 
//If Select Combobox			
			case 'select':
				$optvalue = $meta ? $meta : $field['std'];
				$returnstring .= '<select name="'. $field['id']. '" id="'. $field['id']. '">';
				foreach ($field['options'] as $option){
					$selectedstr = ($optvalue==$option)? 'selected="selected"' : '';
					$returnstring .= '<option value="'.$option.'" '.$selectedstr.'>'. $option .'</option>';
				}
				$returnstring .= '</select>';
				$returnstring .= '<br />'. $field['desc'];
				break;

//If Checkbox			
			case 'checkbox':
                //$returnstring .= 'data:' . $meta . 'meta:' . $field['std'];
				$chkvalue = (strcmp($meta,'on') == 0) ? true : $field['std'];
				$checkedstr = ($chkvalue)? 'checked="checked"' : '';
                $returnstring .= '<input type="hidden" name="'. $field['id']. '" value="off" id="'. $field['id'] . '"/>';
                $returnstring .= '<input type="checkbox" name="'. $field['id']. '" id="'. $field['id']. '" '.$checkedstr.' />';
				$returnstring .= '<br />'. $field['desc'];
				break;
				 
//If Button	
 
			case 'button':
				$buttonvalue = $meta ? $meta : $field['std'] ;
				$returnstring .= '<input type="button" name="'. $field['id']. '" id="'. $field['id']. '"value="'. $buttonvalue. '" />';
				$returnstring .= '<br />'. $field['desc'];
				break;

//If Upload	
 
			case 'upload':
				$uploadvalue = $meta ? $meta : $field['std'] ;
				
				$returnstring .= '<input type="hidden" name="'. $field['id']. '" id="'. $field['id']. '"value="'. $uploadvalue. '" />';
				$returnstring .= '<input type="button" name="'. $field['id']. '_button" id="'. $field['id']. '_button" value="'.__("Manage Images","templatesquare").'" />';
				$returnstring .= '<input type="hidden" name="'. $field['id']. '_hidden" id="'. $field['id']. '_hidden" value="'.$post->ID.'" />';
				$returnstring .= '<br />'. $field['desc'];
				
				break;
		}
		$returnstring .= 	'<td>'.
						'</tr>';
	}
 
	$returnstring .= '</table>';
	
	return $returnstring;

}//END : mytheme_create_metabox
 
 
add_action('save_post', 'mytheme_save_data');
 
 
// Save data from meta box
function mytheme_save_data($post_id) {
	global $meta_boxes;
 
	// verify nonce
	if(isset($_POST['mytheme_meta_box_nonce'])){
		if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == isset($_POST['post_type'])) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 	
	foreach($meta_boxes as $meta_box){
		foreach ($meta_box['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = (isset($_POST[$field['id']]))? $_POST[$field['id']] : "";
			if (isset($_POST[$field['id']]) && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} 
		}
	}
}
 
function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_template_directory_uri(). '/js/upload.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}

function my_admin_styles() {
wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');

?>