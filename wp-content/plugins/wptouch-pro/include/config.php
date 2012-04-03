<?php

define( 'WPTOUCH_PRO_INSTALLED', 1 );

function bnc_wptouch_sslize( $ssl_string ) {
	// Hack to fix broken icons due to an old pre 2.6 bug
	$ssl_string = str_replace( WP_CONTENT_URL . 'http', 'http', $ssl_string );
	if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) {
		return str_replace( 'http://', 'https://', $ssl_string );
	} else {
		return $ssl_string;
	}	
}

//! Set this to 'true' to enable debugging
define( 'WPTOUCH_DEBUG', false );

//! Set this to 'true' to enable simulation of all warnings and conflicts
define( 'WPTOUCH_SIMULATE_ALL', false );

// Set up beta variable
if ( strpos( dirname( __FILE__), "/wptouch-pro-beta/" ) !== false ) {
	define( 'WPTOUCH_PRO_BETA', true );	
	define( 'WPTOUCH_ROOT_DIR', 'wptouch-pro-beta' );
} else {
	define( 'WPTOUCH_PRO_BETA', false );	
	define( 'WPTOUCH_ROOT_DIR', 'wptouch-pro' );
}

//! The key in the database for the WPtouch settings
if ( WPTOUCH_PRO_BETA ) {
	define( 'WPTOUCH_SETTING_NAME', 'wptouch-pro-beta' );
	define( 'WPTOUCH_DIR', WP_PLUGIN_DIR . '/wptouch-pro-beta' );	
	define( 'WPTOUCH_URL', bnc_wptouch_sslize( WP_PLUGIN_URL . '/wptouch-pro-beta' ) );
	define( 'WPTOUCH_PRODUCT_NAME', 'WPtouch Pro Beta' );
} else {
	define( 'WPTOUCH_SETTING_NAME', 'wptouch-pro' );
	define( 'WPTOUCH_DIR', WP_PLUGIN_DIR . '/wptouch-pro' );
	define( 'WPTOUCH_URL', bnc_wptouch_sslize( WP_PLUGIN_URL . '/wptouch-pro' ) );
	define( 'WPTOUCH_PRODUCT_NAME', 'WPtouch Pro' );
}

//! The WPtouch Pro user cookie
define( 'WPTOUCH_COOKIE', 'wptouch-pro-view' );
define( 'WPTOUCH_BNCID_CACHE_TIME', 3600 );
define( 'BNC_WPTOUCH_UNLIMITED', 9999 );

define( 'WPTOUCH_IPAD_DIR', WPTOUCH_DIR . '/include/ipad' );
define( 'WPTOUCH_IPAD_URL', WPTOUCH_URL . '/include/ipad' );

define( 'WPTOUCH_ADMIN_DIR', WPTOUCH_DIR . '/admin' );
define( 'WPTOUCH_ADMIN_AJAX_DIR', WPTOUCH_ADMIN_DIR . '/html/ajax' );
define( 'WPTOUCH_BASE_CONTENT_DIR', WP_CONTENT_DIR . '/wptouch-data' );
define( 'WPTOUCH_BASE_CONTENT_URL', bnc_wptouch_sslize( WP_CONTENT_URL . '/wptouch-data' ) );

define( 'WPTOUCH_TEMP_DIRECTORY', WPTOUCH_BASE_CONTENT_DIR . '/temp' );
define( 'WPTOUCH_TEMP_URL', WPTOUCH_BASE_CONTENT_URL . '/temp' );
define( 'WPTOUCH_CUSTOM_SET_DIRECTORY', WPTOUCH_BASE_CONTENT_DIR .'/icons' );		
define( 'WPTOUCH_CUSTOM_ICON_DIRECTORY', WPTOUCH_BASE_CONTENT_DIR . '/icons/custom' );
define( 'WPTOUCH_CUSTOM_THEME_DIRECTORY', WPTOUCH_BASE_CONTENT_DIR .'/themes' );
define( 'WPTOUCH_CUSTOM_LANG_DIRECTORY', WPTOUCH_BASE_CONTENT_DIR . '/lang' );
define( 'WPTOUCH_CUSTOM_SETTINGS_DIRECTORY', WPTOUCH_BASE_CONTENT_DIR . '/settings' );
define( 'WPTOUCH_CHILD_THEME_TEMPLATE_DIRECTORY', WPTOUCH_DIR . '/include/child-templates' );

define( 'WPTOUCH_DEBUG_DIRECTORY', WPTOUCH_BASE_CONTENT_DIR . '/debug' );
define( 'WPTOUCH_CACHE_DIRECTORY', WPTOUCH_BASE_CONTENT_DIR . '/cache' );

define( 'WPTOUCH_CACHE_URL', WPTOUCH_BASE_CONTENT_URL . '/cache' );
define( 'WPTOUCH_CUSTOM_ICON_URL', WPTOUCH_BASE_CONTENT_URL .'/icons/custom' );

define( 'WPTOUCH_PRO_MIN_BACKUP_FILES', 30 );

global $wptouch_menu_items; 		//! the built menu item tree
global $wptouch_menu_iterator; 		//! the iterator for the main menu
global $wptouch_menu_item;			//! the current menu item

global $wptouch_icon_pack;
global $wptouch_icon_packs;
global $wptouch_icon_packs_iterator;

$wptouch_icon_pack = false;
$wptouch_icon_packs = false;
$wptouch_icon_packs_iterator = false;

// These all need to be negative so as not to conflict with real page numbers
define( 'WPTOUCH_ICON_HOME', -1 );
define( 'WPTOUCH_ICON_BOOKMARK', -2 );
define( 'WPTOUCH_ICON_DEFAULT', -3 );
define( 'WPTOUCH_ICON_EMAIL', -4 );
define( 'WPTOUCH_ICON_RSS', -5 );
define( 'WPTOUCH_ICON_TABLET_BOOKMARK', -6 );
define( 'WPTOUCH_ICON_CUSTOM_1', -101 );
define( 'WPTOUCH_ICON_CUSTOM_2', -102 );
define( 'WPTOUCH_ICON_CUSTOM_3', -103 );
define( 'WPTOUCH_ICON_CUSTOM_PAGE_TEMPLATES', -500 );

global $wptouch_device_classes;
$wptouch_device_classes[ 'iphone' ] = array( 
	'iPhone', 					// iPhone
	'iPod', 						// iPod touch
	'incognito', 				// iPhone alt browser
	'webmate', 				// iPhone alt browser
	'Android', 					// Android
	'dream', 					// Android
	'CUPCAKE', 				// Android
	'froyo', 						// Android
	'BlackBerry9500', 		// Storm 1
	'BlackBerry9520', 		// Storm 1
	'BlackBerry9530', 		// Storm 2
	'BlackBerry9550', 		// Storm 2
	'BlackBerry 9800', 	// Torch
	'BlackBerry 9850', 	// Torch 2
	'BlackBerry 9860', 	// Torch 2
	'BlackBerry 9780', 	// Bold 3
	'webOS',					// Palm Pre/Pixi
	's8000',					// Samsung s8000
	'bada',						// Samsung Bada Phone
	"IEMobile/7.0",			// Windows Phone OS 7
	'Googlebot-Mobile',	// Google's mobile Crawler
	'AdsBot-Google'		// Google's Ad Bot Crawler
);

global $wptouch_exclusion_list;
$wptouch_exclusion_list = array(
	'SCH-I800',				// Samsung Galaxy Tab
	'Xoom',						// Motorola Xoom tablet
	'P160U'						// HP TouchPad
);

