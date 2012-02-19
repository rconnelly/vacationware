<?php session_start(); ?>
<?php
/*
Plugin Name: ClickDesk Live-Chat & Live-Call
Plugin URI: http://www.clickdesk.com
Description: Add the fastest livechat and call service to your website.
Version: 3.2
Author: ClickDesk
Author URI: http://www.clickdesk.com
License: GPL2
*/

// Constants 
define('LIVILY_SERVER_URL', "https://contactuswidget.appspot.com/");
define('LIVILY_DASHBOARD_URL', LIVILY_SERVER_URL.'widgets-wp.jsp?cdplugin=wordpress&wpurl=');
define('LIVILY_ICON_URL', "https://contactuswidget.appspot.com/images/getfavicon.png");

// Wordpress DB
define( 'LIVILY_DB_OPTION_NAME', 'livily_livechat_option' );



// Save widgetid
function livily_livechat_save_options( $widgetid ) {
	
	return update_option( LIVILY_DB_OPTION_NAME, $widgetid );
}

//  Get widgetid
function livily_livechat_get_options() {
	
	$widgetid = get_option( LIVILY_DB_OPTION_NAME );
	
	
	return $widgetid;
}

// Remove dbs while Uninstalling 
function livily_livechat_uninstall() {
	// Delete all options for db
	delete_option( LIVILY_DB_OPTION_NAME );
}


function lastIndexOf($string,$item){
    $index=strpos(strrev($string),strrev($item));
    if ($index){
        $index=strlen($string)-strlen($item)-$index;
        return $index;
    }
        else
        return -1;
}

function clickdesk_widget_add_scripts() {
	
	$cdwidgetid = livily_livechat_get_options();
	
	// If null   
    if(strlen($cdwidgetid) == 0)
		return;
	
	
   
    wp_enqueue_script('push2call_script_client', plugins_url('/js/widget.js', __FILE__), array('jquery'), '1.0.1',true);

	?>
	<!-- Start of InVox.com Widget -->
	<script  type="text/javascript">
	
	var _glc =_glc || [];
	_glc.push('<?php echo $cdwidgetid ?>');
	</script>
	<!-- End of InVox.com Widget -->
  
<?php
	

	
}


/******************* ClickDesk Live-Chat Widget Install *******************************************/
if ( ! is_admin() )
	add_action("wp_print_scripts", "clickdesk_widget_add_scripts");

    register_deactivation_hook(__FILE__, 'livily_livechat_uninstall');

/******************* End of ClickDesk Live-Chat Widget Install ************************************/


/********************* Start of Menu Options ***********/				

// create custom plugin menu
add_action('admin_menu', 'livily_create_menu');   

//create admin menu
function livily_create_menu() {
  
   //create new top-level menu
   add_menu_page('Account Configuration', 'ClickDesk Live-Chat', 'administrator', 'livily_dashboard', 'livily_dashboard',LIVILY_ICON_URL);
    
  $page_ref = add_submenu_page('livily_account_config', 'ClickDesk Live-Chat', 'ClickDesk Live-Chat', 'administrator', 'livily_dashboard', 'livily_dashboard');


   
  
}


// Dashboard
function livily_dashboard() {
  
   $cdwidgetid = $_GET["cdwidgetid"];
 
   $blogURL = get_bloginfo('url');

   $lastindex = lastIndexOf($blogURL,"/");

   $requestURI = $_SERVER['REQUEST_URI'];

   if($lastindex > 8){
      $blogURL = substr($blogURL,0,$lastindex);

   }

   $Path = $blogURL.$requestURI;
  
   $Path = urlencode($Path);

   $cdURL= LIVILY_DASHBOARD_URL.$Path;

   if(strlen($cdwidgetid) != 0){
          
      $result = livily_livechat_save_options( $cdwidgetid );

	  $mssg = urlencode("Plugin has been installed successfully.");

	  $cdURL = $cdURL."&mssg=".$mssg;
	
	  echo '<div id="dashboarddiv"><iframe id="dashboardiframe" src='.$cdURL.''.' height=2000 width=100% scrolling="yes"></iframe></div>';
   
     
   }
   
   else{
        echo '<div id="dashboarddiv"><iframe id="dashboardiframe" src='.$cdURL.''.' height=2000 width=100% scrolling="yes"></iframe></div>';
   }
   
 
}


?>
