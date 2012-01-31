<?php

// Theme Setting
	$themename 			= "Lighthouse Theme";
	$shortname 				= "templatesquare";
	
// Options panel
$optLogotype 				= array(
				'imagelogo' 	=> 'Image logo',
				'textlogo' 		=> 'Text-based logo'
				 );
			 
$optSlider					= array(
				'opt1' 			=> 'Use Properties as Slider',
				'opt2' 			=> 'Use Custom Slider as Slider'
				);
				
$optPropertylayout		= array(
				'plist' 			=> 'List View',
				'pgrid' 			=> 'Grid View'
				);
				
$optBloglayout				= array(
				'grid' 			=> 'Grid View',
				'list' 				=> 'List View'
				);		 
			 
// Setting header
$optionstheme = array (

				/**************************GENERAL SETTINGS**********************/
				array(	"name" => "General",
											"type" => "open"),
											
				array(	"name" => __('Header Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('', 'templatesquare')),
									
											
				array(	"name" => __('Logo Type', 'templatesquare'),
											"desc" => __('If text-based logo is activated, enter the sitename and tagline in the fields below.', 'templatesquare'),
											"options" => $optLogotype,
											"id" => $shortname."_logo_type",
											"std" => "imagelogo",
											"type" => "select"),
				
				
				array(	"name" => __('Site name', 'templatesquare'),
											"desc" => '',
											"id" => $shortname."_site_name",
											"std" => "",
											"type" => "text"),												
				
																	
				array(	"name" => __('Tagline', 'templatesquare'),
											"desc" => '',
											"id" => $shortname."_tagline",
											"std" => "",
											"type" => "text"),	
											
											
				array(	"name" => __('Logo Image URL', 'templatesquare'),
											"desc" => __('If image logo is activated, enter the logo image url (http://www.fullurl.com/logo.png).', 'templatesquare'),
											"id" => $shortname."_logo_image",
											"std" => "",
											"type" => "text"),
											
				array(	"name" => __('Favicon URL', 'templatesquare'),
											"desc" => __('Enter the favicon image url (http://www.fullurl.com/favicon.ico).', 'templatesquare'),
											"id" => $shortname."_favicon",
											"std" => "",
											"type" => "text"),
											

				array(	"name" => __('Footer Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('', 'templatesquare')),
											
																	
				array(	"name" => __('Footer Text', 'templatesquare'),
											"desc" => __('You can use html tag in here.', 'templatesquare'),
											"id" => $shortname."_footer",
											"type" => "textarea"),
		
				array(	"name" => __('Tracking Code', 'templatesquare'),
											"desc" => __('Enter your tracking code here.', 'templatesquare'),
											"id" => $shortname."_google",
											"std" => "",
											"type" => "textarea"),
											
											
				array(	"type" 	=> "close"),
				
				
				/**************************COLOR SETTINGS**********************/			
				array(	"name" => "Style",
											"type" => "open"),
											
				array(	"name" => __('Theme Color Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('', 'templatesquare')),
		
				array(	"name" => __('Top color', 'templatesquare'),
											"desc" => '',
											"id" => $shortname."_topcolor",
											"std" => "#14bbea",
											"type" => "colorpicker"),	
											
									
				array(	"name" => __('Heading Title Color', 'templatesquare'),
											"desc" => '',
											"id" => $shortname."_headingtitlecolor",
											"std" => "#272727",
											"type" => "colorpicker"),												
				

				array(	"name" => __('Heading Content Color', 'templatesquare'),
											"desc" => '',
											"id" => $shortname."_headingcontentcolor",
											"std" => "#272727",
											"type" => "colorpicker"),	
											

				array(	"name" => __('Link color', 'templatesquare'),
											"desc" => '',
											"id" => $shortname."_linkcolor",
											"std" => "#14bbea",
											"type" => "colorpicker"),
											
											
				array(	"type" 	=> "close"),

				
				/**************************SLIDER SETTINGS**********************/
				array(	"name" => "Slider",
											"type" => "open"),
									
				array(	"name" => __('Slider Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('', 'templatesquare')),
											
				array(	"name" => __('Slider option', 'templatesquare'),
											"desc" => __('Select option that you would like to have displayed in the homepage slideshow.', 'templatesquare'),
											"options" => $optSlider,
											"id" => $shortname."_slider_option",
											"std" => "opt1",
											"type" => "select"),
											

				array( 	"name" => __('Slider Timeout', 'templatesquare'),
											"desc" => __('Please enter number for default slider timeout(transition time). Default is 6000', 'templatesquare'),
											"id" => $shortname."_slider_timeout",
											"std" => "6000",
											"type" => "text"),

											
				array( 	"name" => __('Button Text', 'templatesquare'),
											"desc" => __('Please enter label for button text slider.', 'templatesquare'),
											"id" => $shortname."_slider_buttontext",
											"std" => "more info",
											"type" => "text"),
											
				array(	"type" 	=> "close"),
				
				/**************************PORTFOLIO SETTINGS**********************/
				array(	"name" => "Portfolio",
											"type" => "open"),
									
				array(	"name" => __('Portfolio Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('', 'templatesquare')),
											
				array( 	"name" => __('Width of Portfolio Item', 'templatesquare'),
											"desc" => __('Define your default width for your portfolio item.', 'templatesquare'),
											"id" => $shortname."_display_widthimg",
											"std" => "290",
											"type" => "text"),
											
				array( 	"name" => __('Height of Portfolio Item', 'templatesquare'),
											"desc" => __('Define your default height for your portfolio item.', 'templatesquare'),
											"id" => $shortname."_display_heightimg",
											"std" => "180",
											"type" => "text"),
											
				array( 	"name" => __('Width of Portfolio\'s Container', 'templatesquare'),
											"desc" => __('Define your default width for portfolio\'s contianer.', 'templatesquare'),
											"id" => $shortname."_display_contentwidth",
											"std" => "940",
											"type" => "text"),

				array( 	"name" => __('Space between Each Column', 'templatesquare'),
											"desc" => __('Define your default space between each column.', 'templatesquare'),
											"id" => $shortname."_display_colspacing",
											"std" => "35",
											"type" => "text"),

				array( 	"name" => __('Space between Each Row', 'templatesquare'),
											"desc" => __('Define your default space between each row.', 'templatesquare'),
											"id" => $shortname."_display_rowspacing",
											"std" => "60",
											"type" => "text"),

				array( 	"name" => __('Read More Text', 'templatesquare'),
											"desc" => __('Define your default read more text.', 'templatesquare'),
											"id" => $shortname."_display_readmoretext",
											"std" => "Read More",
											"type" => "text"),
											
				array(	"type" 	=> "close"),	
				
				/**************************PROPERTY SETTINGS**********************/
				array(	"name" => "Property",
											"type" => "open"),
									
				array(	"name" => __('Property Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('', 'templatesquare')),
											
				array( 	"name" => __('Property Layout', 'templatesquare'),
											"desc" => __('Select property type that you would like to have displayed in the property page.', 'templatesquare'),
											"id" => $shortname."_property_layout",
											"std" => "plist",
											"type" => "select",
											"options" => $optPropertylayout),
											
				array( 	"name" => __('Disable Advance Search', 'templatesquare'),
											"desc" => __('Checked to disable advance search in homepage and  property grid view.', 'templatesquare'),
											"id" => $shortname."_disable_advance_search_property",
											"std" => "",
											"type" => "checkbox"),
											
				array( 	"name" => __('Number of Posts', 'templatesquare'),
											"desc" => __('Please enter number for show property. Default is 10', 'templatesquare'),
											"id" => $shortname."_property_post",
											"std" => "10",
											"type" => "text"),
											
				array( 	"name" => __('Currency', 'templatesquare'),
											"desc" => __('Input your currency', 'templatesquare'),
											"id" => $shortname."_property_currency",
											"std" => "$",
											"type" => "text"),
											
				array( 	"name" => __('Area Unit', 'templatesquare'),
											"desc" => __('Input your area unit', 'templatesquare'),
											"id" => $shortname."_property_area_unit",
											"std" => "sqft",
											"type" => "text"),
											
											
				array( 	"name" => __('Lot Unit', 'templatesquare'),
											"desc" => __('Input your lot unit', 'templatesquare'),
											"id" => $shortname."_property_lot_unit",
											"std" => "aqres",
											"type" => "text"),
                array( 	"name" => __('Maximum Occupancy'),
                                                            "desc" => __('Select the maximum occupancy (sleeps)'),
                                                            "id" => $shortname."_property_num_sleeps",
                                                            "type" => "text",
                                                            "std" => "20",
                                                            "class" => "mini"),
				
				array( 	"name" => __('Maximum Number of Beds', 'templatesquare'),
											"desc" => __('Select the maximum of the bed', 'templatesquare'),
											"id" => $shortname."_property_num_bed",
											"type" => "text",
											"std" => "5",
											"class" => "mini"),
				
				array( 	"name" => __('Maximum Number of Bath', 'templatesquare'),
											"desc" => __('Select the maximum of the bath', 'templatesquare'),
											"id" => $shortname."_property_num_bath",
											"type" => "text",
											"class" => "mini",
											"std" => "5"),								
											
				array( 	"name" => __('Property Type Options', 'templatesquare'),
											"desc" => __('Input your property type using comma separated value.', 'templatesquare'),
											"id" => $shortname."_property_type",
											"std" => "Single Family, Multi Family, Condo or Townhome, Commercial, Lands and Lots",
											"type" => "textarea"),

				array( 	"name" => __('Listing Type Options', 'templatesquare'),
											"desc" => __('Input your listing type using comma separated value.', 'templatesquare'),
											"id" => $shortname."_listing_type",
											"std" => "For Sale, For Rent, For Lease, Auction",
											"type" => "textarea"),

				array(	"type" 	=> "close"),	
				
				/**************************BLOG SETTINGS**********************/
				array(	"name" => "Blog",
											"type" => "open"),
									
				array(	"name" => __('Blog Settings', 'templatesquare'),
											"type" => "heading",
											"desc" => __('', 'templatesquare')),
											
				array( 	"name" => __('Blog Layout', 'templatesquare'),
											"desc" => __('Select blog type that you would like to have displayed in the blog page.', 'templatesquare'),
											"id" => $shortname."_blog_layout",
											"std" => "grid",
											"type" => "select",
											"options" => $optBloglayout),
											
				array(	"type" 	=> "close"),	
											
);


		function mytheme_add_admin() {
	    global $themename, $shortname, $optionstheme;
	    if ( $_GET['page'] == basename(__FILE__) ) {
	      if (isset($_REQUEST['reset']) ) {
		      foreach ($optionstheme as $value) {
		      	update_option( $value['id'],  $value['std'] ); }
		      foreach ($optionstheme as $value) {
		      	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $value['std'] ); } else { delete_option( $value['id'] ); } }
		      header("Location: themes.php?page=admin-options.php&saved=true");
		      die;
	      }
		  if ( 'save' == $_REQUEST['action'] ) {
		      foreach ($optionstheme as $value) {
		      	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
		      foreach ($optionstheme as $value) {
		      	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
		      header("Location: themes.php?page=admin-options.php&saved=true");
		      die;
	      }
	      
	    }
	    add_theme_page($themename." Options", "Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
		}
		
		function mytheme_admin() {
	
	    global $themename, $shortname, $optionstheme;
	
	    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	    
?>

	<div class="wrap">
	<div id="icon-themes" class="icon32"><br></div>
	<h2><?php echo $themename; ?> <?php _e('Options','templatesquare');?></h2>
	<div class="bordertitle"></div>
	<style type="text/css">
	table, td {font-size:13px; border:0px;}
	th {font-weight:normal; width:250px; border:0px;}
	span.setting-description { font-size:11px; line-height:16px; font-style:italic;}
	</style>
	
	<link rel="stylesheet" media="screen" type="text/css" href="<?php echo get_template_directory_uri(); ?>/admin/css/colorpicker.css" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri();  ?>/admin/js/colorpicker.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();  ?>/admin/js/eye.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/admin/js/utils.js"></script>
	<link rel="stylesheet" media="screen" type="text/css" href="<?php echo get_template_directory_uri();  ?>/admin/css/tabs.css" />
	<!-- Javascript for the tabs -->
	<script type="text/javascript">
	var $ = jQuery.noConflict();
		$(document).ready(function(){
			/* For Tab */
			$(".tab_content").hide(); //Hide all content
			$("ul.tabs li:first").addClass("active").show(); //Activate first tab
			$(".tab_content:first").show(); //Show first tab content
			//On Click Event
			$("ul.tabs li").click(function() {
				$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab_content").hide(); //Hide all tab content
				var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
				$(activeTab).fadeIn(900); //Fade in the active content
				return false;
			});
	});	
	</script><br />
	
	<ul class="tabs"> 
		<li><a href="#General"><?php _e('General','templatesquare'); ?></a></li>
		<li><a href="#Style"><?php _e('Style','templatesquare'); ?></a></li>
		<li><a href="#Slider"><?php _e('Slider','templatesquare'); ?></a></li>
		<!-- <li><a href="#Portfolio"><?php _e('Portfolio','templatesquare'); ?></a></li> -->
		<li><a href="#Property"><?php _e('Property','templatesquare'); ?></a></li>
		<li><a href="#Blog"><?php _e('Blog','templatesquare'); ?></a></li>
	</ul> 

		<form method="post">
		<div class="tab_container">
		<?php 
			foreach ($optionstheme as $value) {
			if ($value['type'] == "open") { 
		?>
		 
		 <div id="<?php echo $value['name']; ?>" class="tab_content" >
		<table  border="1" cellpadding="0" cellspacing="12" style="text-align:left">
		<?php
				}
				if ($value['type'] == "close") { 
		?>
		</table></div>
		<?php
				}
				if ($value['type'] == "heading") { 
		?>
		<thead>
		<tr>
        	<td colspan="2"><h3><?php echo $value['name']; ?></h3><span class="setting-description"><?php echo $value['desc']; ?></span></td>
        </tr>
		</thead>
		<?php
				}
				
				if ($value['type'] == "description") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
					<span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}
				
				if ($value['type'] == "info") { 
		?>
		<tr valign="top"> 
		    <th scope="row" colspan="2"><span class="setting-description"><?php echo $value['desc']; ?></span></th>

		</tr>
		<?php
				}
				if ($value['type'] == "line") { 
		?>
		<tr valign="top"> 
		    <th colspan="2" ><div style="padding-top:10px;padding-bottom:10px; vertical-align:middle; padding-left:0px;"><div style="border-bottom: 1px solid #efefef;"></div></div></th>

		</tr>
		
		<?php
				}
				
				
				if ($value['type'] == "text") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
		        <input name="<?php echo $value['id']; ?>" size="60" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /><br />
 
						<span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}
				
				
				if ($value['type'] == "textarea") { 
				
		?>
		
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
			<textarea cols="50" rows="5"  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option($value['id']));; } else { echo $value['std']; } ?></textarea><br /><span class="setting-description"><?php echo $value['desc']; ?></span>

		    </td>
		</tr>
		<?php
				}
			if ($value['type'] == "checkbox") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
			<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                            <br /><span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}
			if ($value['type'] == "checkbox-pages") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:<br /><span class="setting-description"><?php echo $value['desc']; ?></span></th>
		    <td>
			<?php 
			$pages_list = get_pages();

			
			?>
			
<table><?php $i = 0; foreach ($pages_list as $option) { $checked = ""; ?><?php if (get_option( $value['id'])) { if (in_array($option->ID, get_option( $value['id'] ))) $checked = "checked=\"checked\""; } elseif ($value['std'][$i] == "true") { $checked = "checked=\"checked\""; } ?><tr><td><input type="checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $value['id']; ?>-<?php echo $option->ID; ?>" value="<?php echo $option->ID; ?>" <?php echo $checked; ?> /> <label for="<?php echo $value['id']; ?>-<?php echo $option->ID; ?>"><?php echo is_array($value['desc'])?$value['desc'][$i]:$option->post_title; ?></label> </td></tr> <?php $i++; } ?></table>
		    </td>
		</tr>
		<?php
				}

				if ($value['type'] == "select") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
						<select style="width:50%" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $key => $option) { ?><option<?php if ( get_option( $value['id'] ) == $key) { echo ' selected="selected"'; } elseif ($key == $value['std']) { echo ' selected="selected"'; } ?> value="<?php echo $key; ?>"><?php echo $option; ?></option><?php } ?></select> <br /><span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}
				
				
				if ($value['type'] == "colorpicker") { 
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
            <script language="javascript">
            	(function($){
					var initLayout = function() {		
						$('#colorSelector-<?php echo $value['id']; ?>').ColorPicker({
							color: '<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>',
							onShow: function (colpkr) {
								$(colpkr).fadeIn(500);
								return false;
							},
							onHide: function (colpkr) {
								$(colpkr).fadeOut(500);
								return false;
							},
							onChange: function (hsb, hex, rgb) {
								$('#colorSelector-<?php echo $value['id'] ?> div').css('backgroundColor', '#' + hex);
								$("#<?php echo $value['id']; ?>").attr('value', '#' + hex);								
							}
						});
					};	
					EYE.register(initLayout, 'init');
				})(jQuery)
            </script>
			<div id="colorContainer"><div id="colorSelector-<?php echo $value['id']; ?>"><div style="background-color: <?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>"></div></div></div>
            <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />  
			          
		    </td>
		</tr>
		<?php
				}

				if ($value['type'] == "select-categories") { 
				
					$pn_categories_obj = get_categories('hide_empty=0');
					$pn_categories = array();
						
					foreach ($pn_categories_obj as $pn_cat) {
						$pn_categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
					}
					$categories_tmp = array_unshift($pn_categories, "All Categories");
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $value['name']; ?>:</th>
		    <td>
		        <select style="width:140px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
               <?php foreach ($pn_categories as $option) { ?>
               <option <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
               <?php } ?>
           </select><br />
 <span class="setting-description"><?php echo $value['desc']; ?></span>
		    </td>
		</tr>
		<?php
				}	

			}
		?>
		</table>
	</div>
	
	<p class="submit">
	<input name="save" type="submit" class="button-primary" value="Save changes" /> 
	<input name="reset" type="submit" class="button-primary"  value="<?php _e('Restore Defaults', 'templatesquare')?>" onclick="return confirm('<?php _e('Click OK to reset. Any theme settings will be lost!', 'templatesquare')?>');"/>
	<input type="hidden" id="action" name="action" value="save" />
	</p>
	</form>
	
	<?php
	}
	add_action('admin_menu', 'mytheme_add_admin');

?>
