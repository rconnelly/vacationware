<?php

function wptouch_admin_menu() {
	$settings = wptouch_get_settings();
	
	if ( $settings->put_wptouch_in_appearance_menu ) {
		add_submenu_page( 
			'themes.php', 
			__( "WPtouch Pro", "wptouch-pro" ), 
			__( "WPtouch Pro", "wptouch-pro" ), 
			'manage_options', 
			__FILE__, 
			'wptouch_admin_panel' 
		);	
	} else {
		// Check to see if another plugin created the BraveNewCode menu
		if ( !defined( 'WPTOUCH_MENU' ) ) {
			define( 'WPTOUCH_MENU', true );
			
			// Add the main plugin menu for WPtouch Pro 
			add_menu_page( 
				'WPtouch Pro', 
				'WPtouch Pro', 
				'manage_options', 
				__FILE__, 
				'', 
				get_wptouch_url() . '/admin/images/wptouch-admin-icon.png' 
			);
		}
		
		add_submenu_page( 
			__FILE__, 
			__( "Settings", "wptouch-pro" ), 
			__( "Settings", "wptouch-pro" ), 
			'manage_options', 
			__FILE__, 
			'wptouch_admin_panel' 
		);	
	}
}

function wptouch_admin_panel() {	
	/* Administration panel bootstrap */
	require_once( 'template-tags/themes.php' );
	require_once( 'template-tags/tabs.php' );
	
	// Setup administration tabs
	wptouch_setup_tabs();
	
	// Generate tabs	
	wptouch_generate_tabs();
}

//! Can be used to add a tab to the settings panel
function wptouch_add_tab( $tab_name, $class_name, $settings, $custom_page = false ) {
	global $wptouch_pro;
	
	$wptouch_pro->tabs[ $tab_name ] = array(
		'page' => $custom_page,
		'settings' => $settings,
		'class_name' => $class_name
	);
}

function wptouch_generate_tabs() {
	include( 'html/admin-form.php' );
}

function wptouch_string_to_class( $string ) {
	return strtolower( str_replace( '--', '-', str_replace( '+', '', str_replace( ' ', '-', $string ) ) ) );
}	

function wptouch_show_tab_settings() {
	include( 'html/tabs.php' );
}

function wptouch_admin_get_languages() {
	$languages = array(
		'auto' => __( 'Auto-detect', 'wptouch-pro' ),
		'en_US' => 'English',
		'fr_FR' => 'Français',
		'it_IT' => 'Italiano',
		'es_ES' => 'Español',
		'de_DE' => 'Deutsch',
		'nb_NO' => 'Norsk',
		'pt_BR' => 'Português',
		'nl_NL' => 'Nederlands',
		'sv_SE' => 'Svenska',
		'ru_RU' => 'русский',
		'ja_JP' => '日本語',
		'zh_CN' => '简体字',
		'hu_HU' => 'Magyar'
	);	
	
	return apply_filters( 'wptouch_admin_languages', $languages );
}

function wptouch_save_reset_notice() {
	if ( isset( $_POST[ 'wptouch-submit' ] ) ) {
		echo( '<div class="saved">' );
		echo __( 'Settings saved!', "wptouch-pro" );
		echo('</div>');
	} elseif ( isset( $_POST[ 'wptouch-submit-reset' ] ) ) {
		echo ( '<div class="reset">' );
		echo __( 'Defaults restored', "wptouch-pro" );
		echo( '</div>' );
	}
}

function wptouch_get_available_theme_variants() {
	$variants = array( 'iphone' => __( 'Mobile', 'wptouch-pro' ) );
	
	global $wptouch_pro;
	$available_classes = $wptouch_pro->get_supported_theme_device_classes();
	foreach( $available_classes as $device_class => $device_info ) {
		if ( !isset( $variants[ $device_class ] ) ) {
			$variants[ $device_class ] = $device_class;	
		}	
	}
	
	if ( isset( $variants[ 'ipad' ] ) ) {
		$variants[ 'ipad' ] = __( 'iPad', 'wptouch-pro' );	
	}
	
	return apply_filters( 'wptouch_developer_mode_theme_variants', $variants );
}

function wptouch_setup_general_tab() {
	global $wptouch_pro;
	$settings = $wptouch_pro->get_settings();
	
	$active_plugins = get_option( 'active_plugins' );
	$new_plugin_list = array();
	foreach( $active_plugins as $plugin ) {
		$dir = explode( '/', $plugin );
		$new_plugin_list[] = $dir[0];
	}

	$plugin_compat_settings = array();
	
	$plugin_compat_settings[] = array( 'section-start', 'warnings-and-conflicts', __( 'Warnings or Conflicts', 'wptouch-pro' ) );
	$plugin_compat_settings[] = array( 'plugin-compat' );
	$plugin_compat_settings[] = array( 'section-end' );	
	$plugin_compat_settings[] = array( 'spacer' );		
	$plugin_compat_settings[] = array( 'section-start', 'plugin-compat-options', __( 'Theme &amp; Page Compatibility', 'wptouch-pro' ) );
	$plugin_compat_settings[] = array( 'checkbox', 'include_functions_from_desktop_theme', __( 'Include functions.php from the active desktop theme', 'wptouch-pro' ), __( 'This option will include and load the functions.php from the active WordPress theme.  This may be required for themes with custom field features like post images, etc. This option will cause hidden files to be written to your desktop theme directory.', 'wptouch-pro' ) );
	$plugin_compat_settings[] = array( 'checkbox', 'convert_menu_links_to_internal', __( 'Convert permalinks into internal URLs', 'wptouch-pro' ), __( 'This option reduces the loading time for pages, but may cause issues with the menu when permalinks are non-standard or on another domain.', 'wptouch-pro' ) );
	$plugin_compat_settings[] = array( 'text', 'remove_shortcodes', __( 'Remove these shortcodes when WPtouch Pro is active', 'wptouch-pro' ), __( 'Enter a comma separated list of shortcodes to remove.', 'wptouch_pro' ) );
	$plugin_compat_settings[] = array( 'spacer' );
	$plugin_compat_settings[] = array( 'textarea', 'ignore_urls', __( 'Do not use WPtouch Pro on these URLs/Pages', 'wptouch-pro' ), __( 'Each permalink URL fragment should be on its own line and relative, e.g. "/about" or "/products/store"', 'wptouch-pro' ) );
	$plugin_compat_settings[] = array( 'checkbox', 'enable_buddypress_mobile_support', __( 'Allow BuddyPress Mobile AJAX to bypass WPtouch Pro', 'wptouch-pro' ), '' );	
	$plugin_compat_settings[] = array( 'section-end' );
	$plugin_compat_settings[] = array( 'spacer' );		
	$plugin_compat_settings[] = array( 'section-start', 'plugin-compatibility', __( 'Plugin Compatibility', 'wptouch-pro' ) );
		
	if ( $wptouch_pro->plugin_hooks && count( $wptouch_pro->plugin_hooks ) ) {
		
		$plugin_compat_settings[] = array( 'copytext', 'plugin-compat-copy', __( "WPtouch will attempt to disable selected plugin hooks when WPtouch and your mobile theme are active. Check plugins to disable:", "wptouch-pro" ) ); 
				
		foreach( $wptouch_pro->plugin_hooks as $plugin_name => $hooks ) {
			if ( in_array( $plugin_name, $new_plugin_list ) ) {
				$proper_name = "plugin_disable_" . str_replace( '-', '_', $plugin_name );
				$plugin_compat_settings[] = array( 'checkbox', $proper_name, $wptouch_pro->get_friendly_plugin_name( $plugin_name ) );
			}
		}
	} else {
		$plugin_compat_settings[] = array( 'copytext', 'plugin-compat-copy-none', __( "There are currently no active plugins to disable.", "wptouch-pro" ) .  "<br />" . __( "If you have recently installed or reset WPtouch Pro, it must gather active plugin information first.", "wptouch-pro" ) ); 
	}
		
	$plugin_compat_settings[] = array( 'copytext', 'plugin-compat-refresh', sprintf( __( "%sRegenerate Plugin List%s", "wptouch-pro" ), '<a href="#" class="regenerate-plugin-list round-24">', ' &raquo;</a>' ) ); 
	$plugin_compat_settings[] = array( 'section-end' );	
	
	$wptouch_advertising_types = array(
		'none' => __( 'No advertising', 'wptouch-pro' ),
		'google' => __( 'Google Adsense', 'wptouch-pro' ),
		'admob' => __( 'Admob Ads', 'wptouch-pro' ),
		'custom' => __( 'Custom', 'wptouch-pro' )
	);
	
	$wptouch_advertising_types = apply_filters( 'wptouch_advertising_types', $wptouch_advertising_types );
	
	wptouch_add_tab( __( 'General', 'wptouch-pro' ), 'general',
		array(
			__( 'Overview', "wptouch-pro" ) => array ( 'overview',
				array(
					array( 'section-start', 'touchboard', __( 'WPtouchboard', "wptouch-pro" ) ),
					array( 'wptouch-board'),
					array( 'section-end' )
				)	
			),
			__( 'Global General', 'wptouch-pro' ) => array ( 'general-options', 
				array(
					array( 'section-start', 'site-branding', __( 'Site Branding', 'wptouch-pro' ) ),
					array( 'text', 'site_title', __( 'WPtouch site title', 'wptouch-pro' ), __( 'If the title of your site is long, you can shorten it for display within WPtouch.', 'wptouch-pro' ) ),		
					array( 'checkbox', 'show_wptouch_in_footer', __( 'Display "Powered by WPtouch Pro" in footer', 'wptouch-pro' ) ),						
					array( 'section-end' ),
					array( 'spacer' ),			
					array( 'section-start', 'language-text', __( 'Regionalization', 'wptouch-pro' ) ),
					array( 
						'list', 
						'force_locale', 
						__( 'WPtouch Pro language', 'wptouch-pro' ), 
						__( 'The WPtouch Pro admin panel / supported themes will be shown in this locale', 'wptouch-pro' ), 
						wptouch_admin_get_languages()
					),
					array( 'section-end' ),
					array( 'spacer' ),			
					array( 'section-start', 'landing-page', __( 'WPtouch Landing Page', 'wptouch-pro' ) ),
					array( 'checkbox', 'enable_home_page_redirect', __( 'Enable landing redirect (overrides default WordPress settings for landing page)', 'wptouch-pro' ), __( 'When checked WPtouch overrides your WordPress homepage settings, and uses another page you select for its homepage.', 'wptouch-pro' ) ),
					array( 'redirect' ),
					array( 'text', 'home_page_redirect_custom', __( 'Custom home page URL', 'wptouch-pro' ), '' ),
					array( 'section-end' ),
					array( 'spacer' ),			
					array( 'section-start', 'switch-link', __( 'Switch Link', 'wptouch-pro' ) ),
					array( 'checkbox', 'show_switch_link', __( 'Show switch link', 'wptouch-pro' ), __( 'When unchecked WPtouch will not show a switch link allowing users to switch between the mobile view and your regular theme view', 'wptouch-pro' ) ),
					array( 
						'list', 
						'home_page_redirect_address', 
						__( 'Switch link destination', 'wptouch-pro' ), 
						__( 'Choose between the same URL from which a user chooses to switch, or your Homepage as the switch link destination.', 'wptouch-pro' ), 
						array(
							'same' => __( 'Same URL', 'wptouch-pro'),
							'homepage' => __( 'Site Homepage', 'wptouch-pro')
						)
					),
					array( 'textarea', 'desktop_switch_css', __( 'Theme switch styling', 'wptouch-pro' ), __( 'Here you can edit the CSS output to style the switch link appearance in the footer of your regular theme.', 'wptouch-pro' ) ),	
					array( 'section-end' ),
					array( 'spacer' ),			
					array( 'section-start', 'welcome-four-footer', __( 'Welcome, 404, Footer', 'wptouch-pro' ) ),
					array( 'textarea', 'welcome_alert', __( 'Welcome message shown on 1st visit (HTML is OK)', 'wptouch-pro' ), __( 'The welcome message shows below the header for visitors until dismissed.', 'wptouch-pro' ) ),
					array( 'textarea', 'fourohfour_message', __( 'Custom 404 message (HTML is OK)', 'wptouch-pro' ), __( 'Change this to whatever you\'d like for your 404 page message.', 'wptouch-pro' ) ),	
					array( 'textarea', 'footer_message', __( 'Custom footer content (HTML is OK)', 'wptouch-pro' ), __( 'Enter additional content to be displayed in the WPtouch footer. Everything here is wrapped in a paragraph tag.', 'wptouch-pro' ) ),	
					array( 'section-end' ),		
					array( 'spacer' ),			
					array( 'section-start', 'misc', __( 'Advanced', 'wptouch-pro' ) ),
					array( 'checkbox', 'desktop_is_first_view', __( '1st time visitors see desktop theme', 'wptouch-pro' ), __( 'Your regular theme will be shown to 1st time mobile visitors first, with the Mobile View switch link available in the footer.', 'wptouch-pro' ) ),		
					array( 'checkbox', 'multisite_force_enable', __( 'Force multisite detection', 'wptouch-pro' ), __( 'This option will force  the WordPress multisite panels to be displayed. This option should only be used on an actual multisite installation.', 'wptouch-pro' ) ),					
					array( 'checkbox', 'make_links_clickable', __( 'Convert all plain-text links in post content to clickable links', 'wptouch-pro' ), __( 'Normally links posted into post content are plain-text and cannot be clicked.  Enabling this option will make these links clickable, similar to the P2 theme.', 'wptouch-pro' ) ),	
					array( 'checkbox', 'respect_wordpress_date_format', __( 'Respect WordPress setting for date format in themes', 'wptouch-pro' ), __( 'When checked WPtouch will use the WordPress date format in themes that support it (set in WordPress -> Settings - > General).', 'wptouch-pro' ) ),
					array( 'text', 'custom_css_file', __( 'URL to a custom CSS file', 'wptouch-pro' ), __( 'Full URL to a custom CSS file to be loaded last in themes. Will override existing styles, preserving updateability of themes.', 'wptouch-pro' ) ),	
					array( 'section-end' )
				)
			),
			__( 'Advertising &amp; Stats', 'wptouch-pro' ) => array ( 'advertising-stats-options', 
				array(
					array( 'section-start', 'advertising', __( 'Mobile Advertising', 'wptouch-pro' ) ),
					array( 
						'list', 
						'advertising_type', 
						__( 'Mobile advertising support', 'wptouch-pro' ), 
						__( 'WPtouch natively supports ads from Google Adsense or Admob. May not show on all devices (limitations of these services).', 'wptouch-pro' ), 
						$wptouch_advertising_types
					),				
					array( 'textarea', 'custom_advertising_code', __( 'Advertising code (HTML or JavaScript)', 'wptouch-pro' ), __( 'You can enter custom advertising code (images, links, scripts, etc.) here', 'wptouch-pro' ) ),				
					array( 'text', 'adsense_id', __( 'Adsense Publisher ID', 'wptouch-pro' ), __( 'Enter your full Publisher ID', 'wptouch-pro' ) ),
					array( 'text', 'adsense_channel', __( 'Adsense Channel ID', 'wptouch-pro' ), __( 'Your Adsense Channel', 'wptouch-pro' ) ),				
					array( 'text', 'admob_publisher_id', __( 'Admob Publisher ID', 'wptouch-pro' ), __( 'Enter your full Admob Publisher ID', 'wptouch-pro' ) ),			
					array( 'section-end' ),
					array( 'section-start', 'ipad_advertising', __( 'iPad Advertising', 'wptouch-pro' ) ),
					array( 
						'list', 
						'ipad_advertising_type', 
						__( 'iPad advertising support', 'wptouch-pro' ), 
						'', 
						array(
							'none' => __( 'No advertising', 'wptouch-pro' ),
							'custom' => __( 'Custom', 'wptouch-pro' )
						)
					),	
					array( 'textarea', 'custom_ipad_advertising_code', __( 'Advertising code (HTML or JavaScript)', 'wptouch-pro' ), __( 'You can enter custom advertising code (images, links, scripts, etc.) here', 'wptouch-pro' ) ),									
					array( 'section-end' ),					
					array( 'section-start', 'ad-display', __( 'Advertising Display', 'wptouch-pro' ) ),
					array( 
						'list', 
						'advertising_location', 
						__( 'Advertising display location', 'wptouch-pro' ), 
						__( 'Choose where you would like your ads positioned.', 'wptouch-pro' ), 
						array(
							'header' => __( 'Below the header', 'wptouch-pro' ),
							'footer' => __( 'In the footer','wptouch-pro' )
							
						)	
					),	
					array( 
						'list', 
						'advertising_pages', 
						__( 'Show ads in these places', 'wptouch-pro' ), 
						__( 'Choose which page views you\'d like ads displayed on', 'wptouch-pro' ),
						array(
							'ads_single' => __( 'Single Post Only', 'wptouch-pro' ),
							'main_single_pages' => __( 'Home, Blog, Single Post, Pages', 'wptouch-pro' ),
							'all_views' => __( 'All Pages (Home, Blog, Single Post, Pages, Search)', 'wptouch-pro' ),
							'home_page_only' => __( 'Home Page Only', 'wptouch-pro' )							
						)	
					),							
					array( 'copytext', 'copytext-ads', sprintf(__( '%sNote: Adsense and Admob ads only show on service supported devices, and do NOT work in Web-App Mode%s', 'wptouch-pro' ), '<small>','</small>' ) ),
					array( 'copytext', 'copytext-ads3', sprintf(__( '%sAlso, ads will not be shown in Developer Mode on desktop browsers unless the user agent is changed in the browser to a supported device.%s', 'wptouch-pro' ), '<small>','</small>' ) ),
					array( 'section-end' ),
					array( 'spacer' ),			
					array( 'section-start', 'site-stats', __( 'Site Statistics', 'wptouch-pro' ) ),
					array( 'textarea', 'custom_stats_code', __( 'Custom statistics code (HTML and/or JavaScript only)', 'wptouch-pro' ), __( 'Enter your custom statistics tracking code snippets (Google Analytics, MINT, etc.)', 'wptouch-pro' ) ),		
					array( 'section-end' )
				)
			),
			__( 'Push Notifications', 'wptouch-pro' ) => array ( 'push-notifications',
				array(
					array( 'section-start', 'prowl-notifications', __( 'Prowl Push Notifications', 'wptouch-pro' ) ),
					array( 'text-array', 'push_prowl_api_keys', __( 'Prowl API keys', 'wptouch-pro' ), __( 'Enter your Prowl API key here to enable push notifications from WPtouch to your iPhone/iPod touch via the Prowl app, or Mac with Growl installed and configured for Prowl. If you have multiple keys, enter and save each one for a new input to appear.', 'wptouch-pro' ) ),	
					array( 'checkbox', 'push_prowl_comments_enabled', __( 'Notify of new comments &amp; pingbacks/trackbacks', 'wptouch-pro' ), __( 'Requires Discussion settings to be enabled in the WordPress settings.', 'wptouch-pro' ) ),
					array( 'checkbox', 'push_prowl_registrations', __( 'Notify of new account registrations', 'wptouch-pro' ), __( 'Requires the "Anyone can register" WordPress setting to be enabled.', 'wptouch-pro' ) ),				
					array( 'checkbox', 'push_prowl_direct_messages', __( 'Allow users to send direct messages', 'wptouch-pro' ), __( 'Adds a push message form in the header to allow visitors to send messages to you.', 'wptouch-pro' ) ),							
					array( 'copytext', 'copytext-info-prowl', '<small>' . __( '(Requires Prowl app on iPhone / iPod touch, or Growl setup with Prowl on a Mac)', 'wptouch-pro' ) . '</small>' ),
					array( 'copytext', 'copytext-info-itunes', '<a href="http://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=320876271" target="_blank">' . __( "Get Prowl (App Store)", "wptouch-pro" ) . '</a> | <a href="http://prowl.weks.net/" target="_blank">' . __( "Prowl Website", "wptouch-pro" ) . '</a> | <a href="http://growl.info/" target="_blank">' . __( "Get Growl", "wptouch-pro" ) . '</a>' ),
					array( 'section-end' )
				)
			),
			__( 'Compatibility', 'wptouch-pro' ) => array( 'compatibility', 
				$plugin_compat_settings
			),
			__( 'Tools and Debug', 'wptouch-pro' ) => array ( 'tools-and-debug',
				array(
					array( 'section-start', 'tools-and-development', __( 'General', 'wptouch-pro' ) ),
					array( 'checkbox', 'show_footer_load_times', __( 'Show load times and query counts in the footer', 'wptouch-pro' ), __( 'WPtouch will show the load time and query count to help you find slow pages/posts on your site.', 'wptouch-pro' ) ),	
					array( 'checkbox', 'always_refresh_css_js_files', __( 'Always refresh theme JS and CSS files', 'wptouch-pro' ), __( 'Useful when developing. Will make sure WPtouch Pro browser cache of Javascript and CSS files is updated on every page refresh.', 'wptouch-pro' ) ),	
					array( 'checkbox', 'put_wptouch_in_appearance_menu', __( 'Move WPtouch admin settings to Appearance menu', 'wptouch-pro' ),  __( 'Moves WPtouch admin settings from the top-level to the WordPress Appearance settings. Refresh your browser after saving.', 'wptouch-pro' ) ),						
					array( 
						'list', 
						'developer_mode', 
						__( 'Developer mode', 'wptouch-pro' ), 
						__( 'Shows WPtouch in ALL browsers when enabled. Please remember to disable this option when finished!', 'wptouch-pro' ),
						array(
							'off' => __( 'Disabled', 'wptouch-pro' ),
							'admins' => __( 'Enabled for admins only', 'wptouch-pro' ),							
							'on' => __( 'Enabled for all users', 'wptouch-pro' )
						)
					),	
					array( 'list', 'developer_mode_device_class', __( '&harr; Developer Mode for', 'wptouch-pro' ), '', wptouch_get_available_theme_variants() ),
					array( 'section-end' ),
					array( 'spacer' ),			
					array( 'section-start', 'clientmode', __( 'Client Mode', 'wptouch-pro' ) ),
					array( 'checkbox', 'admin_client_mode_hide_licenses', __( 'Hide Licenses tab, and other license related content', 'wptouch-pro' ),  __( 'Hides all license settings and references. Allows client to see and upgrade the plugin, adjust active theme and global settings, but not see and/or change license and domain settings.', 'wptouch-pro' ) ),
					array( 'checkbox', 'admin_client_mode_hide_browser', __( 'Hide Theme Browser tab', 'wptouch-pro' ),  __( 'Hides the theme browser tab, and prevents theme switching', 'wptouch-pro' ) ),
					array( 'checkbox', 'admin_client_mode_hide_tools', __( 'Hide Tools and Debug section', 'wptouch-pro' ),  __( 'Hides the Tools and Debug settings completely. Once checked only resetting WPtouch Pro settings will show them again.', 'wptouch-pro' ) ),
					array( 'section-end' ),
					array( 'spacer' ),			
					array( 'section-start', 'debugging', __( 'Debugging', 'wptouch-pro' ) ),
					array( 'sysinfo' ),				
					array( 'checkbox', 'debug_log', __( 'Debug log', 'wptouch-pro' ), __( 'Creates a debug file to help diagnose issues with WPtouch. This file is located in ...wp-content/wptouch-data/debug. ', 'wptouch-pro' ) ),	
					array( 
						'list', 
						'debug_log_level', 
						__( 'Debug log level', 'wptouch-pro' ), 
						__( 'Increasing this above Level 1 (Errors) should only be done when troubleshooting.', 'wptouch-pro' ), 
						array(
							WPTOUCH_ERROR => __( 'Errors (1)', 'wptouch-pro' ),
							WPTOUCH_SECURITY => __( 'Security (2)', 'wptouch-pro' ),
							WPTOUCH_WARNING => __( 'Warnings (3)','wptouch-pro' ),
							WPTOUCH_INFO => __( 'Information (4)','wptouch-pro' ),
							WPTOUCH_VERBOSE => __( 'Verbose (5)','wptouch-pro' ),
						)	
					),				
					array( 'section-end' )
				)
			),
			__( 'Backup/Import', 'wptouch-pro' ) => array( 'backup-restore' ,
				array(
					array( 'section-start', 'site_backup_restore', __( 'Settings Backup and Import', 'wptouch-pro' ) ),
					array( 
						'list', 
						'backup_or_restore', 
						__( '&harr; On this site I want to', 'wptouch-pro' ), 
						'', 
						array(
							'backup' => __( 'Backup Settings', 'wptouch-pro' ),
							'restore' => __( 'Import Settings', 'wptouch-pro' )	
						)
					),
					array( 'section-end' ),
					array( 'spacer' ),			
					array( 'section-start', 'backup', __( 'Backup', 'wptouch-pro' ) ),
					array( 'copytext', 'backup-instructions', __( 'This key represents a backup of all WPtouch Pro settings.<br />You can cut and paste it into another installation, or save the data to restore at a later time.', 'wptouch-pro' ) ),
					array( 'backup' ),
					array( 'copytext', 'backup-copy-all', sprintf( __( '%sCopy Backup Key To Clipboard%s', 'wptouch-pro' ), '<a id="copy-text-button" class="ajax-button">', '</a>' ) ),
					array( 'copytext', 'backup-instructions-2', sprintf( __( '%sNOTE: A settings backup/restore does NOT include saved files, icons or themes inside the "wp-content/wptouch-data/" directory.%s', 'wptouch-pro' ), '<small>', '</small>' ) ),
					array( 'section-end' ),
					array( 'section-start', 'import', __( 'Import', 'wptouch-pro' ) ),
					array( 'restore', 'restore_string', sprintf( __( 'Paste a backup key, then save: %s(Right click in textarea, choose "Paste")%s', 'wptouch-pro' ), '<small>', '</small>') ),
					array( 'section-end' )
				)
			)
		)
	);
}

function wptouch_setup_theme_browser_tab() {
	global $wptouch_pro;	
	$settings = wptouch_get_settings();
	
	if ( !$settings->admin_client_mode_hide_browser ) {
		wptouch_add_tab( __( 'Theme Browser', 'wptouch-pro' ), 'theme-browser', 
			array(
				__( 'Installed Themes', 'wptouch-pro' ) => array ( 'installed-themes',
					array(
						array( 'section-start', 'installed-themes', '&nbsp;' ),
						array( 'theme-browser' ),
						array( 'section-end' )
					)
				)
			)
		);		
	}
	
	$theme_menu = apply_filters( 'wptouch_theme_menu', array() );
	
	$current_theme = $wptouch_pro->get_current_theme_info();
	
	// Check for skins
	if ( isset( $current_theme->skins ) && count( $current_theme->skins ) ) {
		$skin_options = array( 'none' => __( 'None', 'wptouch-pro' ) );
		foreach( $current_theme->skins as $skin ) {
			$skin_options[ $skin->basename ] = $skin->name;	
		}
		
		$skin_menu =  array(
			__( 'Theme Skins', 'wptouch-pro' ) => array ( 'theme-skins',
				array(
					array( 'section-start', 'available-skins', __( 'Available Skins', 'wptouch-pro' ) ),
					array( 
						'list', 
						'current_theme_skin', 
						__( 'Active skin', 'wptouch-pro' ), 
						__( 'Skins are alternate stylesheets which change the look and feel of a theme.', 'wptouch-pro' ), 
						$skin_options
					),				
					array( 'section-end' )
				)
			)
		);
		
		$theme_menu = array_merge( $theme_menu, $skin_menu );
	}
	
	// Add the skins menu
	if ( $theme_menu ) {		
		$settings = $wptouch_pro->get_settings();
		
		wptouch_add_tab( __( "Active Theme", 'wptouch-pro' ), 'custom_theme', $theme_menu );
	}
}

function wptouch_get_custom_menu_list() {
	$custom_menu = array(
		'none' => __( 'WordPress Pages', 'wptouch-pro' )
	);
	
	global $wpdb;
	$menus = $wpdb->get_results( "SELECT term_taxonomy_id,a.term_id,name FROM " . $wpdb->prefix . "term_taxonomy as a," . $wpdb->prefix . "terms as b WHERE a.taxonomy = 'nav_menu' AND a.term_id = b.term_id" );
	if ( $menus ) {
		foreach( $menus as $menu ) {
			$custom_menu[ $menu->term_taxonomy_id ] = $menu->name;	
		}	
	}
	
	return $custom_menu;
}	

function wptouch_setup_menu_icons_tab() {
	wptouch_add_tab( __( 'Menu + Icons', 'wptouch-pro' ), 'menu_and_icons', 
		array(
			__( 'General Settings', 'wptouch-pro' ) => array( 'general-settings',
				array(
					array( 'section-start', 'general-menu-options', __( 'Drop-Down Menu', 'wptouch-pro' ) ),
					array( 
						'list', 
						'custom_menu_name', 
						__( 'WPtouch Pro Menu', 'wptouch-pro' ), 
						'', 
						wptouch_get_custom_menu_list()
					),
					array( 
						'list', 
						'menu_sort_order', 
						__( 'Menu sort order (WordPress Pages menu only)', 'wptouch-pro' ), 
						__( 'Used to adjust the menu sort order for WPtouch Pro themes ', 'wptouch-pro' ), 
						array(
							'wordpress' => __( 'Sort by admin page order', 'wptouch-pro' ),
							'alpha' => __( 'Sort alphabetically', 'wptouch-pro' )
						) 
					),
					array( 'section-end' )	,
					array( 'spacer' ),
					array( 'section-start', 'additional-menu-items', __( 'Additional Menu Items', 'wptouch-pro' ) ),
					array( 'checkbox', 'menu_show_home', sprintf( __( 'Add a link to %sHome%s in the menu', 'wptouch-pro' ), '<strong>', '</strong>' ), '' ),	
					array( 'checkbox', 'menu_show_rss', sprintf( __( 'Add a link to the site %sRSS%s feed in the menu', 'wptouch-pro' ), '<strong>', '</strong>' ), '' ),	
					array( 'text', 'menu_custom_rss_url', __( '&harr; Use this RSS feed URL', 'wptouch-pro' ), __( 'You can enter a custom RSS URL here, such as a FeedBurner feed. When left blank, the default website RSS Feed is used.', 'wptouch-pro' ), '', 'menu_custom_rss_url', true ),		
					array( 'checkbox', 'menu_show_email', __( 'Add a link for the admin <strong>Email</strong> in the menu', 'wptouch-pro' ), '' ),
					array( 'text', 'menu_custom_email_address', __( '&harr; Use this e-mail address', 'wptouch-pro' ), __( 'You can enter a custom email address here. When left blank the default admin email is used.', 'wptouch-pro' ), '', 'menu_show_email', true ),					
					array( 'section-end' )	,
					array( 'spacer' ),
					array( 'section-start', 'advanced-menu-options', __( 'Advanced', 'wptouch-pro' ) ),
					array( 'checkbox', 'enable_menu_icons', __( 'Use menu icons', 'wptouch-pro' ), __( 'When unchecked no icons will be shown beside menu items, even if configured in Menu + Icons.', 'wptouch-pro' ) ),
					array( 'checkbox', 'glossy_bookmark_icon', __( 'Use glossy bookmark icon', 'wptouch-pro' ), __( 'If unchecked your bookmark icon will be set as "apple-touch-icon-precomposed", and not have the glossy effect applied to it.', 'wptouch-pro' ) ),
					array( 'checkbox', 'menu_disable_parent_as_child', __( 'Disable duplicate parent as 1st child link', 'wptouch-pro' ), __( 'Check this to disable showing each menu parent as a clickable child item. NOTE: Parent link will not be accessible with this option enabled.', 'wptouch-pro' ) ),		
					array( 'checkbox', 'disable_menu', __( 'Disable drop-down menu completely', 'wptouch-pro' ), __( 'Check this to disable the WPtouch menus altogether (useful for custom themes with menus built outside our code that do not use  WPtouch Pro settings).', 'wptouch-pro' ) ),		
					array( 'checkbox', 'cache_menu_tree', __( 'Cache menu items to reduce database queries', 'wptouch-pro' ), '' ),
					array( 'text', 'cache_time', __( 'Number of seconds to cache menu tree items for', 'wptouch-pro' ), '' ),
					array( 'section-end' )		
				)			
			),		
			__( 'Menu and Icon Setup', 'wptouch-pro' ) => array( 'menu-and-icon-setup',
				array(
					array( 'section-start', 'icon-pool', __( 'Icon Pool', 'wptouch-pro' ) ),
					array( 'icon-picker' ),
					array( 'section-end' )	
				)		
			),
			__( 'Manage Icons and Sets', 'wptouch-pro' ) => array ( 'upload_icons_and_sets',
				array(
					array( 'section-start', 'upload-icons', __( 'Upload Icons + Icon Sets', 'wptouch-pro' ) ),
					array( 'manage-sets' ),
					array( 'section-end' )		
				)		
			),
			__( 'Custom Menu Items', 'wptouch-pro' ) => array( 'custom-menu-icons',
				array(
					array( 'section-start', 'custom-menu-items', __( 'Custom Menu Items', 'wptouch-pro' ) ),
					array( 'copytext', 'copytext-menu-items', __( 'You can enter up to 3 custom menu links to be shown in the WPtouch header menu.', 'wptouch-pro' ) ),
					array( 'text', 'custom_menu_text_1', sprintf( __( 'Custom menu title %s', 'wptouch-pro' ), 1 ) ),				
					array( 'text', 'custom_menu_link_1', sprintf( __( 'Custom menu URL %s', 'wptouch-pro' ), 1 ) ),
					array( 
						'list', 
						'custom_menu_position_1', 
						sprintf( __( 'Custom menu position %s', 'wptouch-pro' ), 1 ), 
						__( 'Select whether the link is shown above or below the WP pages in your menu', 'wptouch-pro' ), 
						array( 
							'top' => __( 'Top', 'wptouch-pro' ), 
							'bottom' => __( 'Bottom', 'wptouch-pro' ) 
						) 
					),
					array( 'checkbox', 'custom_menu_force_external_1', __( 'Force URL to leave Web-App Mode', 'wptouch-pro' ), __( 'URL will be opened in Mobile Safari.  This feature is sometimes required for external links.', 'wptouch-pro' ) ),						
					array( 'spacer' ),
					array( 'text', 'custom_menu_text_2', sprintf( __( 'Custom menu title %s', 'wptouch-pro' ), 2 ) ),						
					array( 'text', 'custom_menu_link_2', sprintf( __( 'Custom menu URL %s', 'wptouch-pro' ), 2 ) ),
					array( 
						'list', 
						'custom_menu_position_2', 
						sprintf( __( 'Custom menu position %s', 'wptouch-pro' ), 2 ), 
						'', 
						array( 
							'top' => __( 'Top', 'wptouch-pro' ), 
							'bottom' => __( 'Bottom', 'wptouch-pro' ) 
						) 
					),
					array( 'checkbox', 'custom_menu_force_external_2', __( 'Force URL to leave Web-App Mode', 'wptouch-pro' ) ),						
					array( 'spacer' ),
					array( 'text', 'custom_menu_text_3', sprintf( __( 'Custom menu title %s', 'wptouch-pro' ), 3 ) ),						
					array( 'text', 'custom_menu_link_3', sprintf( __( 'Custom menu URL %s', 'wptouch-pro' ), 3 ) ),
					array( 
						'list', 
						'custom_menu_position_3', 
						sprintf( __( 'Custom menu position %s', 'wptouch-pro' ), 3 ), 
						'', 
						array( 
							'top' => __( 'Top', 'wptouch-pro' ), 
							'bottom' => __( 'Bottom', 'wptouch-pro' ) 
						) 
					),								
					array( 'checkbox', 'custom_menu_force_external_3', __( 'Force URL to leave Web-App Mode', 'wptouch-pro' ) ),						
					array( 'section-end' )		
				)	
			)					
		)
	);		
}

function wptouch_setup_bncid_account_tab() {
	$support_panel = array(
		__( 'Account + Key', 'wptouch-pro' ) => array( 'bncid',
			array(	
				array( 'section-start', 'account-information', __( 'Account Information', 'wptouch-pro' ) ),
				array( 'copytext', 'bncid-info1', __( 'Your Account E-Mail + License Key are used to activate licenses for support and auto-upgrades.', 'wptouch-pro' ) ),
				array( 'copytext', 'bncid-info2', __( 'You can find both of these in the purchase receipt we sent to you.', 'wptouch-pro' ) ),
				array( 'ajax-div', 'wptouch-profile-ajax', 'profile' ),		
				array( 'text', 'bncid', __( 'Account E-Mail', 'wptouch-pro' ) ),			
				array( 'text', 'wptouch_license_key', __( 'License Key', 'wptouch-pro' ) ),
				array( 'license-check', 'license-check' ),
				array( 'section-end' )
			)
		)
	);
	
	if ( wptouch_has_proper_auth() ) {
		$support_panel[ __( 'Manage Licenses', 'wptouch-pro' ) ] = array( 'manage-licenses', 
			array(
				array( 'section-start' , 'manage-my-licenses', __( 'Manage Licenses', 'wptouch-pro' ) ),
				array( 'manage-licenses', 'manage-these-licenses' ),
				array( 'section-end' )
			)
		);
	}
		
	global $blog_id;
	$settings = wptouch_get_settings();
	
	if ( $blog_id == 1 && !$settings->admin_client_mode_hide_licenses ) {
		wptouch_add_tab( __( 'License', 'wptouch-pro' ), 'bncid_and_licenses', 
			$support_panel
		);		
	}				
}

function wptouch_setup_multisite_tab() {
	if ( wptouch_is_multisite_enabled() && wptouch_is_multisite_primary() ) {
		wptouch_add_tab( __( 'Multisite', 'wptouch-pro' ), 'multisite', 
			array(
				__( 'General', 'wptouch-pro' ) => array ( 'multisite-general',
					array(
						array( 'section-start', 'multisite-admin-panel', __( 'Secondary Admin Panels', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_disable_theme_browser_tab', __( 'Disable Theme Browser tab', 'wptouch-pro' ) ), 
						array( 'checkbox', 'multisite_disable_push_notifications_pane', __( 'Disable Push Notifications pane', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_disable_overview_pane', __( 'Disable Overview pane', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_disable_advertising_pane', __( 'Disable Advertising pane', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_disable_statistics_pane', __( 'Disable Statistics pane', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_disable_manage_icons_pane', __( 'Disable Manage Icons pane', 'wptouch-pro' ) ), 
						array( 'checkbox', 'multisite_disable_compat_pane', __( 'Disable Compatability pane', 'wptouch-pro' ) ), 
						array( 'checkbox', 'multisite_disable_debug_pane', __( 'Disable Tools and Debug pane', 'wptouch-pro' ) ), 
						array( 'checkbox', 'multisite_disable_backup_pane', __( 'Disable Backup/Import pane', 'wptouch-pro' ) ), 						
						array( 'section-end' )
					)
				),
				__( 'Inherited Settings', 'wptouch-pro' ) => array( 'multisite-inherited',
					array(
						array( 'section-start', 'multisite-inherit', __( 'Inherited Settings', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_inherit_advertising', __( 'Inherit advertising settings', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_inherit_prowl', __( 'Inherit Prowl settings', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_inherit_statistics', __( 'Inherit Statistics settings', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_inherit_theme', __( 'Inherit active theme', 'wptouch-pro' ) ),
						array( 'checkbox', 'multisite_inherit_compat', __( 'Inherit compatability settings', 'wptouch-pro' ) ),
						array( 'section-end' )
					)
				)
			)
		);	
	}
}

function wptouch_setup_plugins() {
	global $wptouch_pro;	
	$modules = $wptouch_pro->get_modules();
	ksort( $modules );
	
	wptouch_add_tab( __( 'Modules', 'wptouch-pro' ), 'modules', $modules );	
}

function wptouch_setup_tabs() {
	global $wptouch_pro;
	$settings = $wptouch_pro->get_settings();
		
	wptouch_setup_general_tab();	
	
	if ( $wptouch_pro->has_modules() ) {
		wptouch_setup_plugins();
	}	
		
	do_action( 'wptouch_admin_tab' );
	
	wptouch_setup_multisite_tab();	

	wptouch_setup_theme_browser_tab();

	wptouch_setup_menu_icons_tab();

	wptouch_setup_bncid_account_tab();
	
	do_action( 'wptouch_later_admin_tabs' );
}
