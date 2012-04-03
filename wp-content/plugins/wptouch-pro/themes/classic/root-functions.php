<?php

// Add Classic's custom user agents to the list of supported devices
add_filter( 'wptouch_supported_device_classes', 'classic_supported_devices' );

// When the root-functions.php is loaded, load all the Classic functions that should be global
add_filter( 'wptouch_functions_loaded', 'classic_functions_loaded' );

// When the mobile theme is showing, load all the other relevant template functions
add_filter( 'wptouch_mobile_theme_showing', 'classic_mobile_theme_showing' );

add_filter( 'wptouch_create_thumbnails', 'classic_create_thumbnails' );

add_filter( 'wptouch_settings_saved', 'classic_remove_static_css' );

add_action( 'wptouch_pro_upgrade', 'classic_remove_static_css' );

function classic_get_static_css_filename( $device ) {
	if ( wptouch_is_multisite_enabled() ) {
		global $blog_id;
		return apply_filters( 'classic_static_css_filename', WPTOUCH_TEMP_DIRECTORY . '/classic-' . $device . '-' . $blog_id . '.css' );	
	} else {
		return apply_filters( 'classic_static_css_filename', WPTOUCH_TEMP_DIRECTORY . '/classic-' . $device . '.css' );	
	}
	
}

function classic_get_static_css_url( $device ) {
	if ( wptouch_is_multisite_enabled() ) {
		global $blog_id;
		return apply_filters( 'classic_static_css_url', WPTOUCH_TEMP_URL . '/classic-' . $device . '-' . $blog_id . '.css' );
	} else {
		return apply_filters( 'classic_static_css_url', WPTOUCH_TEMP_URL . '/classic-' . $device . '.css' );
	}	
}

function classic_write_data_to_file( $file_name, $data ) {	
	if ( $data ) {
		$f = fopen( $file_name, 'w+t' );
		if ( $f ) {
			fwrite( $f, $data );
			fclose( $f );	
		}
	}	
}

function classic_remove_static_css() {
	$devices = array( 'iphone', 'ipad' );
	foreach( $devices as $device ) {
		$static_file = classic_get_static_css_filename( $device );
		if ( file_exists( $static_file ) ) {	
			@unlink( $static_file );
		}
	}	
}

function classic_generate_static_one_css( $device ) {
	ob_start();
	include( dirname( __FILE__ ) . '/' . $device . '/dynamic-style.php' );
	$contents = ob_get_contents();
	ob_end_clean();
	
	classic_write_data_to_file( classic_get_static_css_filename( $device ), $contents );		
}

function classic_the_static_css_version( $device ) {
	$file_name = classic_get_static_css_filename( $device );
	if ( file_exists( $file_name ) ) {
		echo md5( filemtime( $file_name ) );	
	} else {
		echo 0;	
	}
}

function classic_the_static_css_url( $device ) {
	$file_name = classic_get_static_css_filename( $device );
	if ( !file_exists( $file_name ) ) {
		classic_generate_static_one_css( $device );
	}	
	
	echo classic_get_static_css_url( $device );
}

function classic_supported_devices( $devices ) {
	if ( isset( $devices['iphone'] ) ) {
		$settings = wptouch_get_settings();
		
		$filtered_user_agents = trim( $settings->classic_custom_user_agents );

		if ( strlen( $filtered_user_agents ) ) {	
			// get user agents
			$agents = explode( "\n", str_replace( "\r\n", "\n", $filtered_user_agents ) );
			if ( count( $agents ) ) {	
				// add our custom user agents
				$devices['iphone'] = array_merge( $devices['iphone'], $agents );
			}
		}
	}
	
	return $devices;	
}

// Load the additional global Classic functions
function classic_functions_loaded() {
	require_once( dirname( __FILE__ ) . '/includes/global.php' );
}

// Load the Classic-specific templating functions
function classic_mobile_theme_showing() {
	require_once( dirname( __FILE__ ) . '/includes/theme.php' );
}

function classic_create_thumbnails( $thumbnails_enabled ) {
	$settings = wptouch_get_settings();
	if ( $thumbnails_enabled ) {
		return ( $settings->classic_icon_type == 'thumbnails' );
	}	
	
	return $thumbnails_enabled;
}

// mobile zoom option, needs to be in root functions to work
function classic_mobile_enable_zoom() {
	$settings = wptouch_get_settings();
	return $settings->classic_mobile_enable_zoom;
}

