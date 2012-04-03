<?php

//-- Admin Panel Filters --//

add_filter( 'wptouch_supported_device_classes', 'wptouch_theme_supported_devices' );
add_filter( 'wptouch_custom_templates', 'wptouch_theme_custom_templates' );
add_filter( 'wptouch_default_settings', 'wptouch_theme_default_settings' );
add_filter( 'wptouch_theme_menu', 'wptouch_theme_admin_menu' );
add_filter( 'wptouch_setting_filter_wptouch_theme_custom_user_agents', 'wptouch_theme_user_agent_filter' );

//-- Global Functions For Skeleton --//

function wptouch_theme_supported_devices( $devices ) {
	if ( isset( $devices['iphone'] ) ) {
		$settings = wptouch_get_settings();

		if ( strlen( $settings->wptouch_theme_custom_user_agents  ) ) {
		
			// get user agents
			$agents = explode( "\n", str_replace( "\r\n", "\n", $settings->wptouch_theme_custom_user_agents ) );
			if ( count( $agents ) ) {	
				// add our custom user agents
				$devices['iphone'] = array_merge( $devices['iphone'], $agents );
			}
		}
	}
	
	return $devices;	
}

function wptouch_theme_user_agent_filter( $agents ) {
	return trim( $agents );	
}

function wptouch_theme_custom_templates( $templates ) {
	$settings = wptouch_get_settings();

	if ( $settings->wptouch_theme_show_archives ) {
		$templates[ __( 'Archives', 'wptouch-pro' ) ] = array( 'wptouch-archives' );
	}

	if ( $settings->wptouch_theme_show_links ) {
		$templates[ __( 'Links', 'wptouch-pro' ) ] = array( 'wptouch-links' );
	}
	
	return $templates;
}


// All default settings must be added to the $settings object here
// All settings should be properly namespaced, i.e. theme_name_my_setting instead of just my_setting
function wptouch_theme_default_settings( $settings ) {
	$settings->wptouch_theme_webapp_use_loading_img = true;
	$settings->wptouch_theme_webapp_status_bar_color = 'default';
	$settings->wptouch_theme_use_compat_css = true;
	$settings->wptouch_theme_show_comments_on_pages = false;
	$settings->wptouch_theme_ajax_mode_enabled = true;
	$settings->wptouch_theme_icon_type = 'calendar';
	$settings->wptouch_theme_background_image = 'thinstripes';
	$settings->wptouch_theme_custom_user_agents = '';
	$settings->wptouch_theme_show_categories = true;
	$settings->wptouch_theme_show_tags = true;
	$settings->wptouch_theme_show_archives = true;
	$settings->wptouch_theme_show_links = true;

	return $settings;
}

function wptouch_theme_thumbnail_options() {
	$thumbnail_options = array();
	$thumbnail_options['calendar'] = __( 'Calendar', 'wptouch-pro' );
	if ( function_exists( 'add_theme_support' ) ) {
		$thumbnail_options['thumbnails'] = __( 'WordPress Thumbnails', 'wptouch-pro' );
	}	
	$thumbnail_options['none'] = __( 'None', 'wptouch-pro' );	
	
	return $thumbnail_options;
}

// The administrational page for the wptouch_theme theme is constructed here
function wptouch_theme_admin_menu( $menu ) {	
	$menu = array(
		__( "General", "wptouch-pro" ) => array ( 'general',
			array(
				array( 'section-start', 'misc-options', __( 'Miscellaneous Options', "wptouch-pro" ) ),
				array( 'checkbox', 'wptouch_theme_ajax_mode_enabled', __( 'Enable AJAX "Load More" link', "wptouch-pro" ), __( 'Posts and comments will be appended to existing content with an AJAX "Load More..." link. If unchecked regular post/comment pagination will be used.', "wptouch-pro" ) ),
				array( 'checkbox', 'wptouch_theme_use_compat_css', __( 'Use compatibility CSS', "wptouch-pro" ), __( 'Add the compat.css file from the theme folder. Contains various CSS declarations for a variety of plugins.', "wptouch-pro" ) ),
				array( 'checkbox', 'wptouch_theme_show_comments_on_pages', __( 'Show comments on pages', "wptouch-pro" ), __( 'Enabling this setting will cause comments to be shown on pages, if they are enabled in the WordPress settings.', "wptouch-pro" ) ),
				array( 'list', 'wptouch_theme_background_image', __( 'Theme background image', "wptouch-pro" ), __( 'Choose a background tile for your theme.', "wptouch-pro" ), 
					array( 
						'thinstripes' => __( 'Thin Stripes', 'wptouch-pro' ), 
						'thickstripes' => __( 'Thick Stripes', 'wptouch-pro' ), 
						'pinstripes-blue' => __( 'Pinstripes Vertical (Blue)', 'wptouch-pro' ), 
						'pinstripes-grey' => __( 'Pinstripes Vertical (Grey)', 'wptouch-pro' ), 
						'pinstripes-horizontal' => __( 'Pinstripes Horizontal', 'wptouch-pro' ), 
						'pinstripes-diagonal' => __( 'Pinstripes Diagonal', 'wptouch-pro' ), 
						'skated-concrete' => __( 'Skated Concrete', 'wptouch-pro' ), 
						'none' => __( 'None', 'wptouch-pro' ) 
					) 
				),	
				array( 'list', 'wptouch_theme_icon_type', __( 'Post icon type', "wptouch-pro" ), __( 'You can choose between calendar icons or post thumbnails.', "wptouch-pro" ), wptouch_theme_thumbnail_options() ),	
				array( 'section-end' ),
				array( 'section-start', 'menu-options', __( 'Menu Options', "wptouch-pro" ) ),
				array( 'checkbox', 'wptouch_theme_show_categories', __( 'Show Categories in tab-bar', "wptouch-pro" ) ),
				array( 'checkbox', 'wptouch_theme_show_tags', __( 'Show Tags in tab-bar', "wptouch-pro" ) ),
				array( 'copytext', 'copytext-info-push-message', __( 'The push message and account tabs are shown/hidden automatically.', "wptouch-pro" ) ),
				array( 'checkbox', 'wptouch_theme_show_archives', __( 'Show Archives template in menu', "wptouch-pro" ) ),
				array( 'checkbox', 'wptouch_theme_show_links', __( 'Show Links template in menu', "wptouch-pro" ) ),
				array( 'section-end' )	
			)
		),
		__( 'User Agents', "wptouch-pro" ) => array( 'user-agents',
			array(
				array( 'section-start', 'devices', __( 'Default User Agents', "wptouch-pro" ) ),	
				array( 'user-agents'),
				array( 'section-end' ),
				array( 'spacer' ),				
				array( 'section-start', 'user-agents', __( 'Custom User Agents', "wptouch-pro" ) ),
				array( 'textarea', 'wptouch_theme_custom_user_agents', __( 'Enter additional user agents on separate lines, not device names or other information.', 'wptouch-pro' ) . '<br />' . sprintf( str_replace( 'Wikipedia', 'here', __( 'Visit %sWikipedia%s for a list of device user agents', 'wptouch-pro' ) ), '<a href="http://www.zytrax.com/tech/web/mobile_ids.html" target="_blank">', '</a>' ) ),
				array( 'section-end' )
			)				
		),
		__( 'iOS Web-App Mode', "wptouch-pro" ) => array( 'web-app-mode',
			array(
				array( 'section-start', 'settings', __( 'Settings', "wptouch-pro" ) ),	
				array( 'checkbox', 'wptouch_theme_webapp_use_loading_img', __( 'Use startup splash screen image', "wptouch-pro" ), __( 'When checked WPtouch will show the theme startup image while in web-app mode.', "wptouch-pro" ) ),
				array( 'copytext', 'copytext-info-web-app', __( 'The startup splash screen image is located inside this theme folder at: /iphone/images/startup.png ', "wptouch-pro" ) ),
				array( 'list', 'wptouch_theme_webapp_status_bar_color', __( 'Status Bar Color', "wptouch-pro" ), __( 'Choose between grey (default), black or black-translucent.', "wptouch-pro" ), 
					array( 
						'default' => __( 'Default (Grey)', 'wptouch-pro' ), 
						'black' => __( 'Black', 'wptouch-pro' ), 
						'black-translucent' => __( 'Black Translucent', 'wptouch-pro' )
					) 
				),					array( 'section-end' )
			)
		)					
	);	
	
	return $menu;
}