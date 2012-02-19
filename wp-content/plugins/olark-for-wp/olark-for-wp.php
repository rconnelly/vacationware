<?php
/*
Plugin Name: Olark for WP
Plugin URI: http://www.burningpony.com/blog/portfolio/olark-for-wp/
Description: A plugin that allows website authors to easily place a <a href="http://www.olark.com/?r=frbosmwp">Olark</a> live help widget on their wpwebsite.
Version: 2.4.1
Author: Russell Osborne 
Author URI: http://www.burningpony.com/

=== VERSION HISTORY ===
04.28.09 - v1.0 - The first version
08.28.09 - v2.0 - Updated the plugin to reflect the brand change from Hab.la to Olark
06.03.11 - v2.1 - Forked From Olark for Wordpress/ Upgraded to New Olark Async Code, Added Callout Widget
06.04.11 - v2.2 - Major Rewrite Moving to More Modern Plugin Codex/API
06.05.11 - v2.3 - Added Olark API for logged in Users
06.07.11 - v2.3.1-3 - Fixing Typos
06.07.11 - v2.4 - In plugin Sign Up Beta!!
06.08.11 - v2.4.1 - Bug Fix on Signup (Sessions Will Now persist between page loads) 
09.01.11 - v2.4.2 - Removed iFrame

=== LEGAL INFORMATION ===
Copyright (C) 2011 Russell Osborne <projects@burningpony.com> - www.burningpony.com
Original Work By James Dimick <mail@jamesdimick.com> - www.jamesdimick.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

$plugurldir = get_option('siteurl').'/'.PLUGINDIR.'/olark-for-wp/';
$ofw_domain = 'OlarkForWP';
load_plugin_textdomain($ofw_domain, 'wp-content/plugins/olark-for-wp');
add_action('init', 'ofw_init');
add_action('wp_footer', 'ofw_insert');
add_action('admin_notices', 'ofw_admin_notice');
add_filter('plugin_action_links', 'ofw_plugin_actions', 10, 2);

if (!get_option('ofwDisable'))
	require_once('olark-for-wp-widgets.php');
require_once('olark-for-wp-chattabs.php');

function ofw_init() {
	if(function_exists('current_user_can') && current_user_can('manage_options')) add_action('admin_menu', 'ofw_add_settings_page');	
	if ( !function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$options = get_option('ofwDisable');	
}
function ofw_settings(){
	register_setting( 'olark-for-wp-group', 'ofwID' );
	register_setting( 'olark-for-wp-group', 'ofwDisable' );
	register_setting( 'olark-for-wp-group', 'ofwTabs' );
	register_setting( 'olark-for-wp-group', 'ofwiFrame' );
	add_settings_section( 'olark-for-wp', "Olark for WP","", 'olark-for-wp-group' );

}
function plugin_get_version() {
	if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}
function ofw_insert() {
  global $current_user;	       
  if(get_option('ofwID')) {
    echo("\n\n<!-- begin olark code --><script type='text/javascript'>/*{literal}<![CDATA[*/window.olark||(function(i){var e=window,h=document,a=e.location.protocol==\"https:\"?\"https:\":\"http:\",g=i.name,b=\"load\";(function(){e[g]=function(){(c.s=c.s||[]).push(arguments)};var c=e[g]._={},f=i.methods.length; while(f--){(function(j){e[g][j]=function(){e[g](\"call\",j,arguments)}})(i.methods[f])} c.l=i.loader;c.i=arguments.callee;c.f=setTimeout(function(){if(c.f){(new Image).src=a+\"//\"+c.l.replace(\".js\",\".png\")+\"&\"+escape(e.location.href)}c.f=null},20000);c.p={0:+new Date};c.P=function(j){c.p[j]=new Date-c.p[0]};function d(){c.P(b);e[g](b)}e.addEventListener?e.addEventListener(b,d,false):e.attachEvent(\"on\"+b,d); (function(){function l(j){j=\"head\";return[\"<\",j,\"></\",j,\"><\",z,' onload=\"var d=',B,\";d.getElementsByTagName('head')[0].\",y,\"(d.\",A,\"('script')).\",u,\"='\",a,\"//\",c.l,\"'\",'\"',\"></\",z,\">\"].join(\"\")}var z=\"body\",s=h[z];if(!s){return setTimeout(arguments.callee,100)}c.P(1);var y=\"appendChild\",A=\"createElement\",u=\"src\",r=h[A](\"div\"),G=r[y](h[A](g)),D=h[A](\"iframe\"),B=\"document\",C=\"domain\",q;r.style.display=\"none\";s.insertBefore(r,s.firstChild).id=g;D.frameBorder=\"0\";D.id=g+\"-loader\";if(/MSIE[ ]+6/.test(navigator.userAgent)){D.src=\"javascript:false\"} D.allowTransparency=\"true\";G[y](D);try{D.contentWindow[B].open()}catch(F){i[C]=h[C];q=\"javascript:var d=\"+B+\".open();d.domain='\"+h.domain+\"';\";D[u]=q+\"void(0);\"}try{var H=D.contentWindow[B];H.write(l());H.close()}catch(E){D[u]=q+'d.write(\"'+l().replace(/\"/g,String.fromCharCode(92)+'\"')+'\");d.close();'}c.P(2)})()})()})({loader:(function(a){return \"static.olark.com/jsclient/loader0.js?ts=\"+(a?a[1]:(+new Date))})(document.cookie.match(/olarkld=([0-9]+)/)),name:\"olark\",methods:[\"configure\",\"extend\",\"declare\",\"identify\"]});

    /* custom configuration goes here (http://www.olark.com/?r=frbosmwp) */\n\n");
    echo("olark.identify('".get_option('ofwID')."');/*]]>{/literal}*/\n");
    //Make user info Avaliable in the Dom for the JS API
    if ( 0 != $current_user->ID ) {
      echo("olark('api.chat.updateVisitorNickname', {snippet: '$current_user->display_name'})\n"); //This will be overwritten if you require a name and email 
      echo("olark('api.chat.updateVisitorStatus', {snippet: [
        'Wordpress User Info', 
        'Username: " . $current_user->user_login."', 
        'User email:  $current_user->user_email',
        'User first name: ".$current_user->user_firstname. "',
        'User last name: ". $current_user->user_lastname ."',
        'User display name: " . $current_user->display_name."',
        'User ID: " . $current_user->ID . "'
        ]})
        ");
      // On chat start send basic info to Operator
      echo "olark('api.chat.onBeginConversation', function() {
        olark('api.chat.sendNotificationToOperator', {body: \"Wordpress Information: $current_user->display_name   Email:$current_user->user_email \"});			    
        });";
      }
      echo("\n</script>\n<!-- End Olark Code <http://www.olark.com/?r=frbosmwp> -->\n\n");
    }
  }
	
	function ofw_admin_notice() {
		if(!get_option('ofwID')) echo('<div class="error"><p><strong>'.sprintf(__('Olark for WP is disabled. Please go to the <a href="%s">plugin page</a> and enter a valid account ID to enable it.' ), admin_url('options-general.php?page=olark-for-wp')).'</strong></p></div>');
	}
	function ofw_plugin_actions($links, $file) {
		static $this_plugin;
		if(!$this_plugin) $this_plugin = plugin_basename(__FILE__);
		if($file == $this_plugin && function_exists('admin_url')) {
			$settings_link = '<a href="'.admin_url('options-general.php?page=olark-for-wp').'">'.__('Settings', $ofw_domain).'</a>';
			array_unshift($links, $settings_link);
		}
		return($links);
	}
	function get_data($url)
  {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);

 
  ////// MUST FIND BETTER WAY to get this to work!!!
   # curl_setopt ($ch, CURLOPT_CAINFO, get_curl_certs());
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
  }
  
  function get_curl_certs(){
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch,CURLOPT_URL, "http://curl.haxx.se/ca/cacert.pem");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
  
  function prep_olark_connection(){
	  $olarking_it = get_option('ofwiFrame');
	  if (!$olarking_it["olark_key"] and !$olarking_it["olark_secret"]) {
	     $jsonurl = "https://integration.olark.com/prepare.json";
        $json = get_data($jsonurl);
        $olark_code = json_decode($json);
        $olarking_it['olark_key'] = $olark_code->olark_key;
        $olarking_it['olark_secret'] = $olark_code->olark_secret;
        $olarking_it['olark_html'] = $olark_code->olark_html;
        update_option( 'ofwiFrame', $olarking_it );  
	  }
    return $olarking_it;
  }

  function build_olark_iframe_url(){   
    $olark = prep_olark_connection();
    $key = $olark['olark_key'];
    $secret =  $olark['olark_secret'];
    $olark_iframe_url = "https://integration.olark.com/setup.frame?height=640&olark_key=$key&olark_secret=$secret&width=480&r=frbosmwp";   
    return $olark_iframe_url;
  }
  
  function olark_admin_chat(){
	  $olarking_it = get_option('ofwiFrame');
	  if ($olarking_it["olark_key"] and $olarking_it["olark_secret"]) {
	   return $olarking_it['olark_html'];
    }else
      return nil;
  }
  
	function ofw_add_settings_page() {
		function ofw_settings_page() {
			global $ofw_domain, $plugurldir, $olark_options ?>
			<div class="wrap">
				<?php screen_icon() ?>
				<h2><?php _e('Olark for WP', $ofw_domain) ?> <small><?echo plugin_get_version();?></small></h2>
				<div class="metabox-holder meta-box-sortables ui-sortable pointer">
					<div class="postbox" style="float:left;width:30em;margin-right:20px">
						<h3 class="hndle"><span><?php _e('Olark Account ID', $ofw_domain) ?></span></h3>
						<div class="inside" style="padding: 0 10px">
							<p style="text-align:center"><a href="http://www.olark.com/" title="<?php _e('Chat with your website&rsquo;s visitors using your favorite IM client', $ofw_domain) ?>"><img src="<?php echo($plugurldir) ?>olark.png" height="132" width="244" alt="<?php _e('Olark Logo', $ofw_domain) ?>" /></a></p>
							<form method="post" action="options.php">
								<?php settings_fields('olark-for-wp-group'); ?>
								<p><label for="ofwID"><?php printf(__('Enter your %1$sChat with your website&rsquo;s visitors using your favorite IM client%2$sOlark%3$s account ID below to activate the plugin.', $ofw_domain), '<strong><a href="http://www.olark.com/?r=frbosmwp/" title="', '">', '</a></strong>') ?></label><br />

									<input type="text" name="ofwID" value="<?php echo get_option('ofwID'); ?>" style="width:100%" /></p>
									<p><label for="ofwDisableWidgets"><?php printf(__('Disable the Callout Widget', $ofw_domain), '<strong><a href="http://www.olark.com/?r=frbosmwp" title="', '">', '</a></strong>') ?></label><br />						
										<?php $options = get_option('ofwDisable');
										if($options['widgets']) { $checked = ' checked="checked" '; }
										echo "<input ".$checked." id='ofwDisable_widgets' name='ofwDisable[widgets]' type='checkbox' />";?>

										<p>Olark Chat Tab Settings</p>
										<?php	$options = get_option('ofwTabs');
									$items = array("None", "CSS", "Image");
									foreach($items as $item) {
										$checked = ($options['type']==$item) ? ' checked="checked" ' : '';
										echo "<label><input ".$checked." value='$item' name='ofwTabs[type]' type='radio' /> $item</label><br />";
										}?>
										<p class="submit">
											<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
										</p>
									</form>

									<small class="nonessential"><?php _e('Entering an incorrect ID will result in an error!', $ofw_domain) ?></small></p>
									<p style="font-size:smaller;color:#999239;background-color:#ffffe0;padding:0.4em 0.6em !important;border:1px solid #e6db55;-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px"><?php printf(__('Don&rsquo;t have an account? No problem! %1$sRegister for a free Olark account today!%2$sRegister for a <strong>FREE</strong> Olark account right now!%3$s Start chatting with your site visitors today!', $ofw_domain), '<a href="http://www.olark.com/portal/wizard?r=frbosmwp" title="', '">', '</a>') ?></p>
									</div>
								</div>

                  
                  
									<div class="postbox" style="float:left;width:20%;margin-right:20px">
										<h3 class="hndle"><span><?php _e('Change Notes', $ofw_domain) ?></span></h3>
										<div class="inside" style="padding: 10px">
											<ul>
												<li>04.28.09 - v1.0 - The first version</li>
												<li>08.28.09 - v2.0 - Updated the plugin to reflect the brand change from Hab.la to Olark</li>
												<li>06.03.11 - v2.1 - Forked From Olark for Wordpress/  Upgraded to New Olark Async Code, Added Callout Widget, Added Chat Tabs</li>
												<li>06.04.11 - v2.2 - Major Rewrite Moving to More Modern Plugin Codex/API</li>
												<li>06.05.11 - v2.3 - Added Olark API for logged in Users</li>
												<li>06.07.11 - v2.3.1-3 - Fixing Typos</li>
												<li>06.07.11 - v2.4 - In Plugin Olark Sign up!</li>
												<li>06.08.11 - v2.4.1 - Bug Fix on Signup (Sessions Will Now persist between page loads) </li>
											</ul>
										</div>
									</div>
									
								</div>
							</div>
							<?php }
						add_action('admin_init', 'ofw_settings' );
						add_submenu_page('options-general.php', __('Olark for WP', $ofw_domain), __('Olark for WP', $ofw_domain), 'manage_options', 'olark-for-wp', 'ofw_settings_page');
					}
					?>