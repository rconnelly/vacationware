<?php
/*
Plugin Name: WPtouch Pro
Plugin URI: http://bravenewcode.com/wptouch-pro
Version: 2.6.3
Description: WPtouch Pro is a plugin to build a mobile theme for your website tailored for <a href="http://www.apple.com/iphone/">Apple iPhone</a> / <a href="http://www.apple.com/ipodtouch/">iPod touch</a> / <a href="http://www.apple.com/ipad/">iPad</a>, <a href="http://www.android.com/">Google Android</a>, <a href="http://www.blackberry.com/">Blackberry Storm & Torch</a> and other touch mobile devices.
Author: Dale Mugford & Duane Storey (BraveNewCode)
Author URI: http://www.bravenewcode.com
Text Domain: wptouch-pro
Domain Path: /lang
License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html

# All admin and theme(s) Designs / Images / CSS
# are Copyright 2009 - 2011 BraveNewCode Inc.
# 'WPtouch' and 'WPtouch Pro' are unregistered trademarks of BraveNewCode Inc., 
# and cannot be re-used in conjuction with the GPL v2 usage of this software 
# under the license terms of the GPL v2 without permission.
*/

global $wptouch_pro;

// Should not have spaces in it, same as above
define( 'WPTOUCH_VERSION', '2.6.3' );

// Configuration
require_once( 'include/config.php' );

// Load settings
require_once( 'include/settings.php' );

// Load global functions
require_once( 'include/globals.php' );

// Load array iterator, used everywhere
require_once( 'include/classes/array-iterator.php' );

// Main WPtouch Class
require_once( 'include/classes/wptouch-pro.php' );

// Main Debug Class
require_once( 'include/classes/debug.php' );

function wptouch_create_object() {
	global $wptouch_pro;
	
	$wptouch_pro = new WPtouchPro;
	$wptouch_pro->initialize();			
	
	do_action( 'wptouch_pro_loaded' );
}

add_action( 'plugins_loaded', 'wptouch_create_object' );

/*! \mainpage WPtouch Pro 2.3 Documentation
 *
 * \section intro_sec Introduction
 *
 * This documentation is auto-generated from the WPtouch Pro 2.x code-base, and is refreshed periodically throughout the day.  This documentation
 * focuses exclusively on the WPtouch code, detailing the usage of most of the functions as well as the parameters required.
 *
 * \section intro_index Documentation
 *
 * You can browse the available documentation sections using the sidebar on the right.
 *
 */
