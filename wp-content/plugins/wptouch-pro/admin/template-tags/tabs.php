<?php

global $wptouch_tab_iterator;
global $wptouch_tab;
global $wptouch_tab_id;

global $wptouch_tab_section_iterator;
global $wptouch_tab_section;

global $wptouch_tab_section_settings_iterator;
global $wptouch_tab_section_setting;

global $wptouch_tab_options_iterator;
global $wptouch_tab_option;

$wptouch_tab_iterator = false;

function wptouch_has_tabs() {
	global $wptouch_tab_iterator;
	global $wptouch_pro;
	global $wptouch_tab_id;
	
	if ( !$wptouch_tab_iterator ) {
		$wptouch_tab_iterator = new WPtouchArrayIterator( $wptouch_pro->tabs );
		$wptouch_tab_id = 0;
	}
	
	return $wptouch_tab_iterator->have_items();	
}

function wptouch_rewind_tab_settings() {
	global $wptouch_tab_section_iterator;
	$wptouch_tab_section_iterator = false;
}

function wptouch_the_tab() {
	global $wptouch_tab;
	global $wptouch_tab_iterator;
	global $wptouch_tab_id;
	global $wptouch_tab_section_iterator;
	
	$wptouch_tab = apply_filters( 'wptouch_tab', $wptouch_tab_iterator->the_item() );
	$wptouch_tab_section_iterator = false;
	$wptouch_tab_id++;
}

function wptouch_the_tab_id() {
	echo wptouch_get_tab_id();
}

function wptouch_get_tab_id() {
	global $wptouch_tab_id;
	return apply_filters( 'wptouch_tab_id', $wptouch_tab_id );	
}

function wptouch_has_tab_sections() {
	global $wptouch_tab;	
	global $wptouch_tab_section_iterator;
	
	if ( !$wptouch_tab_section_iterator ) {
		$wptouch_tab_section_iterator = new WPtouchArrayIterator( $wptouch_tab['settings'] );
	}
	
	return $wptouch_tab_section_iterator->have_items();
}

function wptouch_the_tab_section() {
	global $wptouch_tab_section;
	global $wptouch_tab_section_iterator;
	global $wptouch_tab_section_settings_iterator;
		
	$wptouch_tab_section = apply_filters( 'wptouch_tab_section', $wptouch_tab_section_iterator->the_item() );
	$wptouch_tab_section_settings_iterator = false;
}

function wptouch_the_tab_name() {
	echo wptouch_get_tab_name();
}

function wptouch_get_tab_name() {
	global $wptouch_tab_section_iterator;
		
	return apply_filters( 'wptouch_tab_name', $wptouch_tab_section_iterator->the_key() );
}

function wptouch_the_tab_class_name() {
	echo wptouch_get_tab_class_name();
}

function wptouch_get_tab_class_name() {
	return wptouch_string_to_class( wptouch_get_tab_name() );	
}


function wptouch_has_tab_section_settings() {
	global $wptouch_tab_section;
	global $wptouch_tab_section_settings_iterator;
	
	if ( !$wptouch_tab_section_settings_iterator ) {
		$wptouch_tab_section_settings_iterator = new WPtouchArrayIterator( $wptouch_tab_section[1] );
	}
	
	return $wptouch_tab_section_settings_iterator->have_items();
}

function wptouch_the_tab_section_setting() {
	global $wptouch_tab_section_setting;
	global $wptouch_tab_section_settings_iterator;
	global $wptouch_tab_options_iterator;
		
	$wptouch_tab_section_setting = apply_filters( 'wptouch_tab_section_setting', $wptouch_tab_section_settings_iterator->the_item() );
	$wptouch_tab_options_iterator = false;
}

function wptouch_the_tab_section_class_name() {
	echo wptouch_get_tab_section_class_name();
}

function wptouch_get_tab_section_class_name() {
	global $wptouch_tab_section;
	
	return $wptouch_tab_section[0];
}

function wptouch_the_tab_setting_type() {
	echo wptouch_get_tab_setting_type();
}

function wptouch_get_tab_setting_type() {
	global $wptouch_tab_section_setting;
	return apply_filters( 'wptouch_tab_setting_type', $wptouch_tab_section_setting[0] );
}

function wptouch_the_tab_setting_name() {
	echo wptouch_get_tab_setting_name();
}

function wptouch_get_tab_setting_name() {
	global $wptouch_tab_section_setting;
	
	return apply_filters( 'wptouch_tab_setting_name', $wptouch_tab_section_setting[1] );		
}

function wptouch_the_tab_setting_class_name() {
	echo wptouch_get_tab_setting_class_name();
}

function wptouch_get_tab_setting_class_name() {
	global $wptouch_tab_section_setting;
	
	if ( isset( $wptouch_tab_section_setting[1] ) ) {
		return apply_filters( 'wptouch_tab_setting_class_name', wptouch_string_to_class( $wptouch_tab_section_setting[1] ) );	
	} else {
		return false;	
	}	
}

function wptouch_the_tab_setting_has_tooltip() {
	return ( strlen( wptouch_get_tab_setting_tooltip() ) > 0 );
}

function wptouch_the_tab_setting_tooltip() {
	echo wptouch_get_tab_setting_tooltip();
}

function wptouch_get_tab_setting_tooltip() {
	global $wptouch_tab_section_setting;
	
	if ( isset( $wptouch_tab_section_setting[3] ) ) {
		return htmlspecialchars( apply_filters( 'wptouch_tab_setting_tooltip', $wptouch_tab_section_setting[3] ), ENT_COMPAT, 'UTF-8' );	
	} else {
		return false;	
	}	
}


function wptouch_the_tab_setting_desc() {
	echo wptouch_get_tab_setting_desc();
}

function wptouch_get_tab_setting_desc() {
	global $wptouch_tab_section_setting;
	return apply_filters( 'wptouch_tab_setting_desc', $wptouch_tab_section_setting[2] );		
}

function wptouch_the_tab_setting_value() {
	echo wptouch_get_tab_setting_value();
}

function wptouch_get_tab_setting_value() {
	$settings = wptouch_get_settings();
	$name = wptouch_get_tab_setting_name();
	if ( isset( $settings->$name ) ) {
		return $settings->$name;	
	} else {
		return false;	
	}
}

function wptouch_the_tab_setting_is_checked() {
	return wptouch_get_tab_setting_value();
}

function wptouch_tab_setting_has_options() {
	global $wptouch_tab_options_iterator;
	global $wptouch_tab_section_setting;
	
	if ( isset( $wptouch_tab_section_setting[4] ) ) {			
		if ( !$wptouch_tab_options_iterator ) {
			$wptouch_tab_options_iterator = new WPtouchArrayIterator( $wptouch_tab_section_setting[4] );	
		}
		
		return $wptouch_tab_options_iterator->have_items();
	} else {
		return false;	
	}
}

function wptouch_tab_setting_the_option() {
	global $wptouch_tab_options_iterator;
	global $wptouch_tab_option;	
	
	$wptouch_tab_option = apply_filters( 'wptouch_tab_setting_option', $wptouch_tab_options_iterator->the_item() );
}

function wptouch_tab_setting_has_tags() {
	global $wptouch_tab_section_setting;
	
	$has_tag = false;
	
	switch( wptouch_get_tab_setting_type() ) {
		case 'checkbox':
		case 'text':
		case 'textarea':
			$has_tag =  isset( $wptouch_tab_section_setting[4] );
			break;
		case 'list':
			$has_tag = isset( $wptouch_tab_section_setting[5] );
			break;
		case 'custom-latest':
			$has_tag = isset( $wptouch_tab_section_setting[4] );
			break;
	}
	
	return apply_filters( 'wptouch_tab_setting_tags', $has_tag );
}

function wptouch_tab_setting_get_tags() {
	global $wptouch_tab_section_setting;
	
	$tags = array();
	
	switch( wptouch_get_tab_setting_type() ) {
		case 'checkbox':
		case 'text':
		case 'textarea':
			$tags = $wptouch_tab_section_setting[4];
			break;		
		case 'list':
			$tags = $wptouch_tab_section_setting[5];
			break;
		case 'custom-latest':
			$tags = $wptouch_tab_section_setting[4];
			break;			
	}	
	
	return apply_filters( 'wptouch_tab_setting_tags', $tags );
}

function wptouch_tab_setting_the_tags() {
	return @implode( '', wptouch_tab_setting_get_tags() );	
}

function wptouch_tab_setting_the_option_desc() {
	echo wptouch_tab_setting_get_option_desc();
}	

function wptouch_tab_setting_get_option_desc() {
	global $wptouch_tab_option;		
	return apply_filters( 'wptouch_tab_setting_option_desc', $wptouch_tab_option );
}	

function wptouch_tab_setting_the_option_key() {
	echo wptouch_tab_setting_get_option_key();
}

function wptouch_tab_setting_get_option_key() {
	global $wptouch_tab_options_iterator;
	return apply_filters( 'wptouch_tab_setting_option_key', $wptouch_tab_options_iterator->the_key() );	
}

function wptouch_tab_setting_is_selected() {
	return ( wptouch_tab_setting_get_option_key() == wptouch_get_tab_setting_value() );
}
