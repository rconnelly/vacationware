<?php

global $wptouch_plugin_warning_iterator;
global $wptouch_plugin_warning;

function wptouch_get_plugin_warning_count() {
	global $wptouch_pro;
	$settings = wptouch_get_settings();
	
	$warnings = apply_filters( 'wptouch_plugin_warnings', $wptouch_pro->warnings );
	ksort( $warnings );
	
	$new_warnings = array();
	foreach( $warnings as $key => $value ) {
		if ( !in_array( $key, $settings->dismissed_warnings ) ) {
			$new_warnings[ $key ] = $value;
		}
	}
	
	return count( $new_warnings );
}

function wptouch_has_plugin_warnings() {
	global $wptouch_pro;
	global $wptouch_plugin_warning_iterator;	
	$settings = wptouch_get_settings();
	
	if ( !$wptouch_plugin_warning_iterator ) {
		$warnings = apply_filters( 'wptouch_plugin_warnings', $wptouch_pro->warnings );
		ksort( $warnings );
		
		$new_warnings = array();
		foreach( $warnings as $key => $value ) {
			if ( !in_array( $key, $settings->dismissed_warnings ) ) {
				$new_warnings[ $key ] = $value;
			}
		}
		
		$wptouch_plugin_warning_iterator = new WPtouchArrayIterator( $new_warnings );	
	}
	
	return $wptouch_plugin_warning_iterator->have_items();
}

function wptouch_the_plugin_warning() {
	global $wptouch_plugin_warning_iterator;
	global $wptouch_plugin_warning;	
	
	if ( $wptouch_plugin_warning_iterator ) {
		$wptouch_plugin_warning = apply_filters( 'wptouch_plugin_warning', $wptouch_plugin_warning_iterator->the_item() );	
	}
}

function wptouch_plugin_warning_the_name() {
	echo wptouch_plugin_warning_get_name();	
}

function wptouch_plugin_warning_get_name() {
	global $wptouch_plugin_warning;	
	return apply_filters( 'wptouch_plugin_warning_name', $wptouch_plugin_warning[0] );
}

function wptouch_plugin_warning_the_desc() {
	echo wptouch_plugin_warning_get_desc();
}

function wptouch_plugin_warning_get_desc() {
	global $wptouch_plugin_warning;	
	return apply_filters( 'wptouch_plugin_warning_desc', $wptouch_plugin_warning[1] );
}

function wptouch_plugin_warning_has_link() {
	global $wptouch_plugin_warning;
	
	return ( $wptouch_plugin_warning[2] == true );
}

function wptouch_plugin_warning_get_link() {
	global $wptouch_plugin_warning;
	
	return $wptouch_plugin_warning[2];
}

function wptouch_plugin_warning_the_link() {
	echo wptouch_plugin_warning_get_link();
}
