<?php /* 
Plugin Name: Checkfront
Plugin URI: http://www.checkfront.com/extend/wordpress
Description: Connects Wordpress to the Checkfront Online Booking, Reservation and Availability System.
Version: 1.4.5
Author: Checkfront Inc.
Author URI: http://www.checkfront.com/
Copyright: 2008 - 2010 Checkfront Inc 
*/

if ( ! defined( 'WP_PLUGIN_URL' ) ) define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) ) define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

class Checkfront {

	public $api_version = '1.2.5';
	public  $host= NULL; 
	public $mode='inline';
	private $session_id;
	public $widget = false;
	public $book_url = '';
	public $embed = false;

	function __construct($host=NULL) {
		$this->set_host($host);
		if($mode = get_option('checkfront_mode')) {
			$this->mode = $mode;
		}
	}

	function set_host($host) {
		$this->host = $host;
		$this->url = "//{$this->host}";
		$this->api_url = "{$this->url}/api/" . $this->api_version;
	}

	function valid_host($value) {
		if(!preg_match('~^http://|https://~',$value)) $value = 'https://' . $value;
		if($uri = parse_url($value)) {
			if($uri['host']) {
				$host= $uri['host'];
			}
		}
		return $host;
	}

	function booking($data=array()) {
		if($_GET['CF_slip']) {
			foreach($_GET['CF_slip'] as $id=> $slip) {
				setcookie('CF_slip[' . $id . ']',$slip,0,'/');
			}
		}
    }

	function error_config() {
		if(is_admin()) {
			return '<p style="padding: .5em; border: solid 1px red;">' . __('Please configure the Checkfront plugin in the Wordpress Admin.') . '</p>';
		} else {
			return '<p style="padding: .5em; border: solid 1px red;">' . __('Bookings not yet available here.') .'</p>';
		}
	}

	function embed_booking($atts) {

		$set = array();
		if($atts['item_id'] >0) {
			$set[] = "item_id: '{$atts['item_id']}'";
		}

		if($atts['category_id'] >0) {
			$set[] = "category_id: '{$atts['category_id']}'";
		}

	
		if(empty($this->host)) return $this->error_config();
		if($this->mode == 'framed') {
			$html .= '<iframe src="//' . $this->host . '/www/client/?wp" style="border: 0; width: 100%; height: 800px"></iframe>';
		} else {
			$html .= $this->CF_id($set);
		}
		return $html;
	}

	function CF_set($set=array()) {
		if(count($set)) {
			$CF_set = '<input type="hidden" id="CF_set" value="{' . implode(',',$set) . '}" />';
		}
		if($this->book_url) {
			$CF_set .= '<input type="hidden" id="CF_src" value="' . $this->book_url .'" />';
		}

		return $CF_set;
	}
	function CF_id($set) {
		$id = '<div id="CF" class="' . $this->host . '"><p id="CF_load" class="CF_load">' . __('Searching availability...') . $this->CF_set($set) . '</div>';
		return $id;
	}
}

//Shortcode [clean-conract parameter="value"]
function checkfront_func($atts, $content=null) {
	$atts=shortcode_atts(array(
		'category_id' => '0',
		'item_id' => '0',
		'limit' => '0',
	), $atts);
	return checkfront($atts);
}

// {{{ checkfront()
/* 
 * 
 * @param void
 * @return void
*/
function checkfront($atts) {
	global $Checkfront;
	if(is_page() or is_single()) {
		return $Checkfront->embed_booking($atts);
	}
}

// {{{ checkfront_conf()
/* 
 * Add to admin
 * @param void
 * @return void
*/
function checkfront_conf() {
	global $Checkfront;
	$icon = WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)) . '/icon.png';
	add_menu_page('Setup', 'Checkfront', 'read', __FILE__, 'checkfront_setup',$icon);

	if ( function_exists('add_submenu_page') ) {
		add_submenu_page('plugins.php', __('Checkfront'), __('Checkfront'), 'manage_options', 'checkfront', 'checkfront_setup');
	}

	add_filter('plugin_row_meta', 'checkfront_plugin_meta', 10, 2 );
}

// {{{ checkfront_conf_page()
/* 
 * Display admin
 * @param void
 * @return void
*/
function checkfront_setup() {
	global $Checkfront;
	wp_enqueue_script('jquery'); 
	wp_enqueue_script(WP_PLUGIN_URL . '/setup.js'); 
	include(dirname(__FILE__).'/setup.php');
}

// {{{ checkfront_head()
/* 
 * Init Checkfront, include any required js / css only when required
 * @param void
 * @return void
*/
function checkfront_head() { 
	global $post, $Checkfront;
	if(!isset($Checkfront->host)) return;
	if($pos = stripos($post->post_content,'[checkfront') or $pos === 0) $Checkfront->embed = 1;
	if($Checkfront->widget) {
		$checkfront_widget_post = get_option("checkfront_widget_post");
		$checkfront_widget_page = get_option("checkfront_widget_page");
		$checkfront_widget_booking  = get_option("checkfront_widget_booking");

		if($Checkfront->embed and !$checkfront_widget_booking) { 
			$Checkfront->widget = 0;
		} else {
			if(is_page() and !$checkfront_widget_page) $Checkfront->widget = 0;
			if(is_single() and !$checkfront_widget_post) $Checkfront->widget = 0;

		}
	}
	if ($Checkfront->widget  or $Checkfront->embed) {
		$Checkfront->book_url = get_option("checkfront_book_url");
		print ' <script src="//' . $Checkfront->host . '/www/client.js?wp" type="text/javascript"></script>' ."\n";
		print ' <link rel="stylesheet" href="//' . $Checkfront->host . '/www/client.css?wp" type="text/css" media="all" />' . "\n";
		if($Checkfront->embed) {
			// Disable Comments
			add_filter('comments_open', 'checkfront_comments_open_filter', 10, 2);
			add_filter('comments_template', 'checkfront_comments_template_filter', 10, 1);
		}
	}
}

// {{{ checkfront_comments_open_filter()
/* 
 * Disable comments
 * @param void
 * @return void
*/
function checkfront_comments_open_filter($open, $post_id=null) {
	 return $open;
}

// {{{ checkfront_comments_template_filter()
/* 
 * Disable comments
 * @param void
 * @return void
*/
function checkfront_comments_template_filter($file) {
    return dirname(__FILE__).'/xcomments.html';
}

$Checkfront = new Checkfront(get_option('checkfront_host'));
add_shortcode('checkfront', 'checkfront_func');
add_action('admin_menu', 'checkfront_conf');
add_action('init', 'checkfront_init');

// Init pligin
function checkfront_init() {
	global $Checkfront;
	wp_register_sidebar_widget('checkfront_widget', 'Checkfront', 'checkfront_widget',array('description' => __('Availability calendar and search')));
	wp_register_widget_control('checkfront_widget', 'Checkfront', 'checkfront_widget_ctrl');
	add_action('wp_head', 'checkfront_head'); 
	# required includes
	wp_enqueue_script('jquery'); 

	$Checkfront->widget = (is_active_widget('checkfront_widget')) ? 1 : 0;
}

// Set admin meta
function checkfront_plugin_meta($links, $file) {

	// create link
	if (basename($file,'.php') == 'checkfront') {
		return array_merge(
			$links,
			array( '<a href="plugins.php?page=checkfront">' . __('Settings') . '</a>','<a href="http://www.checkfront.com/support/faq">' . __('FAQ') . '</a>') 
		);
	}
	return $links;
}

// Show widget
function checkfront_widget() {
	global $Checkfront;
	if(!$Checkfront->widget) return;
	$checkfront_widget_title = get_option("checkfront_widget_title");
	if(!empty($checkfront_widget_title)) print '<h2 class="widgettitle">' . $checkfront_widget_title . '</h2>';
	print '<div id="CF_cal" class="' . $Checkfront->host . '"></div>';
	print $Checkfront->CF_set();
}

// Widget control
function checkfront_widget_ctrl() {

	if($_POST['checkfront_update']) {
		update_option("checkfront_book_url", $_POST['checkfront_book_url']);
		update_option("checkfront_widget_title", $_POST['checkfront_widget_title']);
		update_option("checkfront_widget_post ", $_POST['checkfront_widget_post']);
		update_option("checkfront_widget_page ", $_POST['checkfront_widget_page']);
		update_option("checkfront_widget_booking", $_POST['checkfront_widget_booking']);
	}

	$checkfront_book_url = get_option("checkfront_book_url");

	// try and find booking page in content 
	if(!$checkfront_book_url) {
		global $wpdb;
		$checkfront_book_url = $wpdb->get_var("select guid FROM `{$wpdb->prefix}posts` where post_content like '%[checkfront%' and post_type = 'page' limit 1");
		update_option("checkfront_widget_url", $checkfront_book_url);
	}

 	$checkfront_widget_title = get_option("checkfront_widget_title");
	$checkfront_widget_post = (get_option("checkfront_widget_post")) ? ' checked="checked"' : '';
 	$checkfront_widget_page = (get_option("checkfront_widget_page")) ? ' checked="checked"' : '';
 	$checkfront_widget_booking  = (get_option("checkfront_widget_booking")) ? ' checked="checked"' : '';

	print '<input type="hidden" name="checkfront_update" value="1" />';	
	print '<ul>';
	print '<li><label for="checkfront_book_url">' . __('Booking Page (URL)') . ': </label><input type="text" id="checkfront_book_url" name="checkfront_book_url" value="' . $checkfront_book_url . '" /> </li>';
	print '<li><label for="checkfront_widget_title">' . __('Title') . ': </label><input type="text" id="checkfront_widget_title" name="checkfront_widget_title" value="' . $checkfront_widget_title . '" /> </li>';
	print '<li><input type="checkbox" id="checkfront_widget_post" name="checkfront_widget_post" value="1"' . $checkfront_widget_post . '/><label for="checkfront_widget_post" />' . __('Show on posts') . '</li>';
	print '<li><input type="checkbox" id="checkfront_widget_page" name="checkfront_widget_page" value="1"' .  $checkfront_widget_page . '/><label for="checkfront_widget_post" />' . __('Show on pages') . '</li>';
	print '<li><input type="checkbox" id="checkfront_widget_booking" name="checkfront_widget_booking" value="1"' . $checkfront_widget_booking . '/><label for="checkfront_widget_booking" />' . __('Show on booking page') . '</li>';
	print '</ul>';
}
?>
