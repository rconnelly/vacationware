<?php

/*
Plugin Name: Comprehensive Twitter Profile Widget
Plugin URI: http://initbinder.com/plugins
Description: A highly configurable and comprehensive Twitter profile plugin that installs as a widget. The widget will display up to 30 profile tweets. Some of the cool widget settings allow you to display tweets in real time or simply in the loop. Widget comes with variety of options that let you style it to fit your blog theme. In order to provide better user experience when configuring the widget, cute colour picker was included for colour selections.
Version: 1.0.1
Author: Alexander Zagniotov
Author URI: http://initbinder.com
License: GPLv2
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

define('CTP_VERSION', '1.0.1');
define('CTP_PLUGIN_URI', plugin_dir_url( __FILE__ ));
define('CTP_PLUGIN_ASSETS_URI', CTP_PLUGIN_URI.'assets');
define('CTP_PLUGIN_CSS', CTP_PLUGIN_ASSETS_URI . '/css');
define('CTP_PLUGIN_JS', CTP_PLUGIN_ASSETS_URI . '/js');

require_once (dirname(__FILE__) . '/widget.php');

function az_twitter_profile_admin_add_style()  {
	wp_enqueue_script('miniColors-script', CTP_PLUGIN_JS. '/miniColors/jquery.miniColors.js', array('jquery'), CTP_VERSION, true);
	wp_enqueue_script('compr-twitter-profile', CTP_PLUGIN_JS. '/comprehensive-twitter-profile-plugin.js', array('miniColors-script'), false, true);

}

function az_twitter_profile_admin_add_script()  {
	wp_enqueue_style('miniColors-style', CTP_PLUGIN_CSS . '/miniColors/jquery.miniColors.css', false, CTP_VERSION, "screen");
}


add_action('admin_init', 'az_twitter_profile_admin_add_style');
add_action('admin_init', 'az_twitter_profile_admin_add_script');
add_action('widgets_init', create_function('', 'return register_widget("ComprehensiveTwitterProfile_Widget");'));

?>
