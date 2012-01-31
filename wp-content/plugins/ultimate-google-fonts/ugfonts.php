<?php
/*
	Plugin Name: Ultimate Google Fonts
	Plugin URI: http://wptom.com/wordpress/plugins/ultimate-google-fonts-with-beautiful-css3-effects/
	Description: Choose and customize Google fonts directly from your Wordpress admin panel! Enable only font you really want to use! Check coding examples direcly in your admin panel. Text that use beautiful Google fonts is selectable.
	Author: Tom
	Version: 1.1
	Author URI: http://wptom.com
 */

class ugfonts {
	
	function ugfonts() {

		add_action('admin_head', array(&$this, 'action_admin_head'));
		add_action('admin_init', array(&$this, 'action_admin_init'));
		add_action('admin_menu', array(&$this, 'action_admin_menu'));

		if(!is_admin() && get_option('ugfonts_fonts')){
			wp_enqueue_script('WebFonts', 'http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js');
			add_action('wp_head', array(&$this, 'action_frontend_head'));
		}
	}

	function action_admin_head(){
		echo '<script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js" type="text/javascript"></script>';
		echo '<script src="'.get_bloginfo('url'). '/wp-content/plugins/ultimate-google-fonts/ugfonts-js.js" type="text/javascript"></script>';
        //css
        echo "<style type='text/css' media='screen'>
        h2.ug-simpleshadow { text-align: center; font-family:'Crushed',serif; text-shadow: 2px 2px 2px #000; }
        h2.ug-fire { text-align: center; background: #000; color: #fff; font-family:'UnifrakturMaguntia',serif; text-shadow: 0 0 4px white, 0 -5px 4px #FFFF33, 2px -10px 6px #FFDD33, -2px -15px 11px #FF8800, 2px -25px 18px #FF2200; }
        h2.ug-white { text-align: center; font-family:'Permanent Marker',serif; text-shadow: 2px 2px 7px #111; color: #f5f5f5; }
        h2.ug-emboss { text-align: center; background: #ccc; color: #ccc; text-shadow: -1px -1px white, 1px 1px #333; }
        h2.ug-blurry { text-align: center; background: #000; font-family:'Fontdiner Swanky',serif; font-size: 30px; color: transparent; text-shadow: #fff 0 0 5px; }
        h2.ug-stroked { text-align: center; font-family:'Luckiest Guy',serif; color:red; font-weight: bold; text-shadow: 1px 1px 0px #000, -1px -1px 0px #000; }
        h2.ug-threedee { font-family:'Slackey',serif; font-size: 30px; text-align: center; color:rgba(255,255,0,.7) ; font-weight: bold; text-shadow: 1px 1px rgba(255,128,0,.7), 2px 2px rgba(255,128,0,.7), 3px 3px rgba(255,128,0,.7), 4px 4px rgba(255,128,0,.7), 5px 5px rgba(255,128,0,.7); }
        </style>";
	}
	
	function action_admin_init() {
		register_setting( 'ugfonts_options', 'ugfonts_fonts'); 
        register_setting( 'ugfonts_options', 'ugfonts_css');       
	}
	
	function action_admin_menu() {
		add_options_page(__('Ultimate Google Fonts','ugfonts'), __('Ultimate Google Fonts','ugfonts'), 'update_plugins', 'ultimate-google-fonts', array(&$this,'display_page'));
	}
	
	function action_init() {
		//load_plugin_textdomain('ugfonts', false , basename(dirname(__FILE__)).'/languages');
	}

	function action_frontend_head(){
		$fonts = get_option('ugfonts_fonts');
        $ugfonts_css = get_option('ugfonts_css');         
		echo "<script type=\"text/javascript\">
			currentFonts = ['".implode('\',\'', $fonts)."'];
			WebFont.load({
				google: {
				  families: currentFonts
				}
			});</script>";
        
        echo "\n<style type='text/css' media='screen'>\n" . stripslashes($ugfonts_css) ."\n</style>";
    
	}

	function display_page() {
		if (!current_user_can('update_plugins'))
		{
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		if($_POST['ugfonts_fonts'] && $_POST['action'] == 'update'){
			update_option('ugfonts_fonts', $_POST['ugfonts_fonts']);
		}
		elseif($_POST['action'] == 'update' && !isset($_POST['ugfonts_fonts'])){
			update_option('ugfonts_fonts', '');
		}
        
        
			update_option('ugfonts_css', $_POST['ugfonts_css']);
		
		

		?>
		<div class="wrap">
			
			<?php if($fonts = get_option('ugfonts_fonts')):	?>
				<script type="text/javascript">
					currentFonts = ['<?php echo implode('\',\'', $fonts); ?>'];
				</script>
			<?php endif;	?>


			<?php screen_icon(); ?>
			<h2><?php _e('Ultimate Google Fonts','ugfonts')?></h2>

				<form method="post" action="">
				<?php settings_fields('ugfonts_options'); ?>               
				
	                <!-- fonts -->
					<table class="widefat" style="width: 56%; float: left !important;">
                    <thead>
                     <tr>
                        <th style="width: 5%;">Enable</th>
                        <th style="width: 55%;">Font Name</th>
                        <th style="width: 40%;">font-family</th>    
                     </tr>
                    </thead>
                    	<tbody id="fonts-bucket">
									
						</tbody>                    
                    <tfoot>
                     <tr>
                        <th style="width: 5%;">Enable</th>
                        <th style="width: 55%;">Font Name</th>
                        <th style="width: 40%;">font-family</th>    
                     </tr>
                    </tfoot>    
					</table>
                    
                    
                    
                    <!-- info -->
                   <table class="widefat" style="font-weight: normal !important; width: 42%; float: right !important; clear:  none !important;"> 
                    <thead>
                     <tr>                       
                        <th>Information</th>                        
                     </tr>
                    </thead>
                    <tbody>
                    <tr><th style=" font-weight: normal;">
                    <p>If you like this plugin, maybe you'll be interested in my other plugins.</p>
                    <p><a href="http://bit.ly/m7bLX0"><img src="http://wptom.com/temp/aio3.jpg" /></a></p>
                  </th></tr>
                  </tbody>
                  <tfoot>
                     <tr>                       
                        <th>Information</th>                        
                     </tr>
                    </tfoot>
                   </table> 
                    
                    <!-- tips -->
                    <table class="widefat" style="width: 42%; float: right !important; margin: 20px 0 0 0; clear:  none !important;">
                    <thead>
                     <tr>
                        <th style="width: 50%;">Effect</th>
                        <th style="width: 50%;">Code</th>                        
                     </tr>
                    </thead>
                    	<tbody>
						<tr><!-- simple -->
                        <th style="width: 50%;"><h2 class="ug-simpleshadow">Simple Shadow</h2></th>
                        <th style="width: 50%;"><code>h2.ug-simpleshadow { 
                            font-family:'Crushed',serif; text-shadow: 2px 2px 2px #000; 
                            }</code></th> 
                        </tr>	
                        <tr><!-- burning -->
                        <th style="width: 50%;"><h2 class="ug-fire">Burning letters...</h2></th>
                        <th style="width: 50%;"><code>h2.ug-fire {
                            background: #000;
                            color: #fff;
                            font-family:'UnifrakturMaguntia',serif;
                            text-shadow: 0 0 4px white, 0 -5px 4px #FFFF33, 2px -10px 6px #FFDD33, -2px -15px 11px #FF8800, 2px -25px 18px #FF2200; 
                            }</code></th>
                          </tr>	
                          <tr><!-- emboss -->
                        <th style="width: 50%;"><h2 class="ug-emboss">Embossed text</h2></th>
                        <th style="width: 50%;"><code>h2.ug-emboss {
                            background: #ccc; color: #ccc; text-shadow: -1px -1px white, 1px 1px #333; 
                            }</code></th>
                          </tr>
                        <tr><!-- white -->
                        <th style="width: 50%;"><h2 class="ug-white">White text</h2></th>
                        <th style="width: 50%;"><code>h2.ug-white { 
                            font-family:'Permanent Marker',serif; text-shadow: 2px 2px 7px #111; color: #f5f5f5; 
                            }</code></th>
                          </tr> 
                        <tr><!-- blurry text -->
                        <th style="width: 50%;"><h2 class="ug-blurry">Blurry text</h2></th>
                        <th style="width: 50%;"><code>h2.ug-blurry { 
                            background: #000; font-size: 20px; font-family:'Permanent Marker',serif; color: transparent; text-shadow: #fff 0 0 10px; 
                            }</code></th>
                        </tr> 
                        <tr><!-- stroked text -->
                        <th style="width: 50%;"><h2 class="ug-stroked">Stroked text</h2></th>
                        <th style="width: 50%;"><code>h2.ug-stroked { 
                            font-family:'Luckiest Guy',serif; color:red; font-weight: bold; text-shadow: 1px 1px 0px #000, -1px -1px 0px #000; 
                            }</code></th>
                        </tr>	
                        <tr><!-- 3d text -->
                        <th style="width: 50%;"><h2 class="ug-threedee">Fancy 3D text</h2></th>
                        <th style="width: 50%;"><code>h2.ug-threedee { 
                            font-family:'Slackey',serif; color:rgba(255,255,0,.7) ; font-weight: bold; text-shadow: 1px 1px rgba(255,128,0,.7), 2px 2px rgba(255,128,0,.7), 3px 3px rgba(255,128,0,.7), 4px 4px rgba(255,128,0,.7), 5px 5px rgba(255,128,0,.7); 
                            }</code></th>
                        </tr>                   
						</tbody>                    
                    <tfoot>
                     <tr>
                        <th style="width: 50%;">Effect</th>
                        <th style="width: 50%;">Code</th>                        
                     </tr>
                    </tfoot>    
					</table>
                    
                    <!-- css -->
                    <table class="widefat" style="width: 42%; margin-top: 2%; float: right !important; clear: none !important;">
                    <thead>
                     <tr>
                        <th>Your CSS</th>                                          
                     </tr>
                    </thead>
                    	<tbody>
						<tr>                       
                        <th> 
                         <textarea name="ugfonts_css" style="width: 99%; height: 400px;"><?php echo stripslashes(get_option('ugfonts_css')); ?></textarea>
                        </th>                        
                     </tr>			
						</tbody>                    
                    <tfoot>
                     <tr>
                        <th>Your CSS</th>                          
                     </tr>
                    </tfoot>    
					</table>
                    
                    
                    <p class="submit"><input type="submit" class="button-primary" style="float: right; margin: 20px 0% 0 0;" value="<?php _e('Save Changes') ?>" /></p>
                    
				<p style=" display: block; clear: both;"></p>
				<p class="submit"><input type="submit" class="button-primary" style="clear: both;"
					value="<?php _e('Save Changes') ?>" /></p>
				</form>

		
		</div>
		<?php
	}
}
/* Initialise outselves */
add_action('plugins_loaded', create_function('','global $ugfonts; $ugfonts = new ugfonts();'));

?>
