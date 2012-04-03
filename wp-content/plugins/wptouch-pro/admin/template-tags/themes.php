<?php

global $wptouch_themes;
global $wptouch_cur_theme;

$wptouch_themes = false;
$wptouch_cur_theme = false;

global $wptouch_theme_item;	
global $wptouch_theme_iterator;

$wptouch_theme_item = $wptouch_theme_iterator = false;

function wptouch_rewind_themes() {
	global $wptouch_themes;
	$wptouch_themes = false;
}


function wptouch_has_themes() {
	global $wptouch_pro;
	global $wptouch_theme_iterator;
	
	if ( !$wptouch_theme_iterator ) {	
		$wptouch_themes = $wptouch_pro->get_available_themes();
		$wptouch_theme_iterator = new WPtouchArrayIterator( $wptouch_themes ); 
	} 
	
	return $wptouch_theme_iterator->have_items();
}

function wptouch_the_theme() {
	global $wptouch_theme_iterator;
	global $wptouch_cur_theme;
	
	$wptouch_cur_theme = $wptouch_theme_iterator->the_item();
	
	return apply_filters( 'wptouch_theme', $wptouch_cur_theme );
}

function wptouch_the_theme_classes( $extra_classes = array() ) {
	echo implode( ' ', wptouch_get_theme_classes( $extra_classes ) ) ;	
}

function wptouch_get_theme_classes( $extra_classes = array() ) {
	$classes = explode( ' ', $extra_classes );
		
	if ( wptouch_is_theme_active() ) {
		$classes[] = 'active';
	}
	
	if ( wptouch_is_theme_custom() ) {
		$classes[] = 'custom';	
	}
	
	if ( wptouch_has_theme_tags() ) {
		$tags = wptouch_get_theme_tags();
		foreach( $tags as $tag ) {
			$classes[] = $tag;
		}		
	}
	
	return $classes;
}

function wptouch_has_theme_tags() {
	global $wptouch_cur_theme;
	
	return ( isset( $wptouch_cur_theme->tags ) && count( $wptouch_cur_theme->tags ) );	
}

function wptouch_get_theme_tags() {
	global $wptouch_cur_theme;
	
	return apply_filters( 'wptouch_theme_tags', $wptouch_cur_theme->tags );	
}

function wptouch_is_theme_active() {
	global $wptouch_pro;
	global $wptouch_cur_theme;
	
	$settings = $wptouch_pro->get_settings();
		
	$current_theme_location = $settings->current_theme_location . '/' . $settings->current_theme_name;
	
	return ( $wptouch_cur_theme->location == $current_theme_location );
}

function wptouch_active_theme_has_settings() {
	$menu = apply_filters( 'wptouch_theme_menu', array() );
	return count( $menu );	
}

function wptouch_is_theme_custom() {
	global $wptouch_cur_theme;
	return ( $wptouch_cur_theme->custom_theme );	
}

function wptouch_is_theme_child() {
	global $wptouch_cur_theme;
	return ( isset( $wptouch_cur_theme->parent_theme ) && strlen( $wptouch_cur_theme->parent_theme ) );	
}

function wptouch_the_theme_version() {
	echo wptouch_get_theme_version();
}	

function wptouch_get_theme_version() {
	global $wptouch_cur_theme;
	if ( $wptouch_cur_theme ) {
		return apply_filters( 'wptouch_theme_version', $wptouch_cur_theme->version );
	}
	
	return false;		
}


function wptouch_the_theme_title() {
	echo wptouch_get_theme_title();	
}

function wptouch_get_theme_title() {
	global $wptouch_cur_theme;
	if ( $wptouch_cur_theme ) {
		return apply_filters( 'wptouch_theme_title', $wptouch_cur_theme->name );
	}
	
	return false;		
}

function wptouch_the_theme_location() {
	echo wptouch_get_theme_location();	
}

function wptouch_get_theme_location() {
	global $wptouch_cur_theme;
	if ( $wptouch_cur_theme ) {
		return apply_filters( 'wptouch_theme_location', $wptouch_cur_theme->location );
	}
	
	return false;		
}

function wptouch_the_theme_features() {
	echo implode( wptouch_get_theme_features(), ', ' );	
}

function wptouch_get_theme_features() {
	global $wptouch_cur_theme;
	return apply_filters( 'wptouch_theme_features', $wptouch_cur_theme->features );	
}

function wptouch_theme_has_features() {
	global $wptouch_cur_theme;
	return $wptouch_cur_theme->features;		
}

function wptouch_the_theme_author() {
	echo wptouch_get_theme_author();	
}

function wptouch_get_theme_author() {
	global $wptouch_cur_theme;
	if ( $wptouch_cur_theme ) {
		return apply_filters( 'wptouch_theme_author', $wptouch_cur_theme->author );
	}
	
	return false;		
}

function wptouch_the_theme_description() {
	echo wptouch_get_theme_description();	
}

function wptouch_get_theme_description() {
	global $wptouch_cur_theme;
	if ( $wptouch_cur_theme ) {
		return apply_filters( 'wptouch_theme_description', $wptouch_cur_theme->description );
	}
	
	return false;		
}

function wptouch_the_theme_screenshot() {
	echo wptouch_get_theme_screenshot();
}

function wptouch_get_theme_screenshot() {
	global $wptouch_cur_theme;
	if ( $wptouch_cur_theme ) {
		return apply_filters( 'wptouch_theme_screenshot', $wptouch_cur_theme->screenshot );
	}
	
	return false;	
}
