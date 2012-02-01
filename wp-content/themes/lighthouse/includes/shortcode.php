<?php
/**
 * Theme Short-code Functions
 */
 
 
	/* Columns */
	add_shortcode('one_fourth', 'ts_one_fourth');
	add_shortcode('one_fourth_last', 'ts_one_fourth_last');
	add_shortcode('one_third', 'ts_one_third');
	add_shortcode('one_third_last', 'ts_one_third_last');
	add_shortcode('two_third', 'ts_two_third');
	add_shortcode('two_third_last', 'ts_two_third_last');
	add_shortcode('three_fourth', 'ts_three_fourth');
	add_shortcode('three_fourth_last', 'ts_three_fourth_last');
	add_shortcode('one_half', 'ts_one_half');
	add_shortcode('one_half_last', 'ts_one_half_last');
 
 	/* Separator */
	add_shortcode('separator', 'ts_separator');
	
	/* Tab */
	add_shortcode('tabs', 'ts_tab');
	
	/* Toggle */
	add_shortcode('toggles', 'ts_toggles');
	add_shortcode('toggle', 'ts_toggle');
	
	/* Dropcap */
	add_shortcode( 'dropcap', 'ts_dropcap' );
	
	/* Pullquote &amp; Blockquote */
	add_shortcode( 'pullquote', 'ts_pullquote' );
	add_shortcode( 'blockquote', 'ts_blockquote' );
	
	/* List Bullets */
	add_shortcode( 'list', 'ts_list' );
	
	/* Buttons */
	add_shortcode('button', 'ts_button');
	
	/* Highlight */
	add_shortcode( 'highlight', 'ts_highlight' );
	
	/* Styled Box */
	add_shortcode('styled_box', 'ts_styled_box');
	
	/* Content Box */
	add_shortcode('content_box', 'ts_content_box');
	
	
	/* Featured Property */
	add_shortcode('featuredproperty', 'ts_featured_property');
	
 
 	/* -----------------------------------------------------------------
		Columns shortcodes
	----------------------------------------------------------------- */

	function ts_one_fourth($atts, $content = null) {
		
		$content = ts_remove_autop($content);
		
		$content = ($content);
		$output = '<div class="one_fourth">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function ts_one_fourth_last($atts, $content = null) {
		
		$content =ts_remove_autop($content);
		
		$content = ($content);
		
		$output = '<div class="one_fourth last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	function ts_one_third($atts, $content = null) {
		
		$content = ts_remove_autop($content);
		
		$content = ($content);
		$output = '<div class="one_third">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function ts_one_third_last($atts, $content = null) {
		
		$content =ts_remove_autop($content);
		
		$content = ($content);
		
		$output = '<div class="one_third last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	function ts_one_half($atts, $content = null) {
		
		$content = ts_remove_autop($content);
		
		$content = ($content);
		$output = '<div class="one_half">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function ts_one_half_last($atts, $content = null) {
		
		$content =ts_remove_autop($content);
		
		$content = ($content);
		
		$output = '<div class="one_half last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	function ts_two_third($atts, $content = null) {
		
		$content = ts_remove_autop($content);
		
		$content = ($content);
		$output = '<div class="two_third">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function ts_two_third_last($atts, $content = null) {
		
		$content =ts_remove_autop($content);
		
		$content = ($content);
		
		$output = '<div class="two_third last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	function ts_three_fourth($atts, $content = null) {
		
		$content = ts_remove_autop($content);
		
		$content = ($content);
		$output = '<div class="three_fourth">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function ts_three_fourth_last($atts, $content = null) {
		
		$content =ts_remove_autop($content);
		
		$content = ($content);
		
		$output = '<div class="three_fourth last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
 	/* -----------------------------------------------------------------
		Dropcaps
	----------------------------------------------------------------- */
	function ts_dropcap($atts, $content = null) {
		extract(shortcode_atts(array(
					"type" => ''
		), $atts));
		$content =ts_remove_autop($content);
		if($type=="circle"){
			$output = '<span class="dropcap2">'.$content.'</span>';
		}elseif($type=="square"){
			$output = '<span class="dropcap3">'.$content.'</span>';
		}else{
			$output = '<span class="dropcap1">'.$content.'</span>';
		}		
		return do_shortcode($output);
	}
	
 	/* -----------------------------------------------------------------
		Highlight
	----------------------------------------------------------------- */
	function ts_highlight($atts, $content = null) {
		extract(shortcode_atts(array(
					"color" => ''
		), $atts));
		$content =ts_remove_autop($content);
		if($color=="" || $color=="grey"){
			$output = '<span class="highlight1">'.$content.'</span>';
		}
		if($color=="black"){
			$output = '<span class="highlight2">'.$content.'</span>';
		}	
		return do_shortcode($output);
	}
	
 	/* -----------------------------------------------------------------
		Pullquote
	----------------------------------------------------------------- */
	function ts_pullquote($atts, $content = null) {
		extract(shortcode_atts(array(
					"position" => 'left'
		), $atts));
		
		$content =ts_remove_autop($content);
		
			$output = '<span class="pullquote-'.$position.'">'.$content.'</span>';
			
		return do_shortcode($output);
	}
	
	
 	/* -----------------------------------------------------------------
		Blockquote
	----------------------------------------------------------------- */
	function ts_blockquote($atts, $content = null) {
		$content =ts_remove_autop($content);
		$output = '<blockquote>'.$content.'</blockquote>';
		return do_shortcode($output);
	}
	
	/* -----------------------------------------------------------------
		Button
	----------------------------------------------------------------- */
	function ts_button($atts, $content){
		
		extract(shortcode_atts(array(
			'color' => 'blue',
			'tooltip' => '',
			'size' => '',
			'link' => '#'
		), $atts));
		
		
		if($tooltip != ''){$tooltip = 'title="'.$tooltip.'"'; }
		
		$output = '<a class="but-color '.$size . ' ' . $color.'" '.$tooltip.' href="'.$link.'">'.$content.'</a>';
		
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
		List Bullets
	----------------------------------------------------------------- */
	function ts_list($atts, $content = null) {
	
		extract(shortcode_atts(array(
			'type' => 'check'
		), $atts));
		
		$output = '<div class="bullet-'.$type.'">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	/* -----------------------------------------------------------------
		Styled Box
	----------------------------------------------------------------- */
	function ts_styled_box($atts, $content = null) {
	
		extract(shortcode_atts(array(
			'title' => '',
			'color' => '',
			'icon' => ''
			
		), $atts));
		
		$content = ts_remove_autop($content);
		
		$output = '<div class="styled-box '.$icon . ' ' . $color.'"><strong>' . $title . ': </strong>' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
		Content Box
	----------------------------------------------------------------- */
	function ts_content_box($atts, $content = null) {
		
		$content = ts_remove_autop($content);
		
		$output = '<div class="bg-box">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
		Toggle
	----------------------------------------------------------------- */
	function ts_toggle($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'title' => 'Unnamed'
		), $atts));
		
		$output = '
				<h2 class="trigger"><span>'.$title.'</span></h2>
				<div class="toggle_container">
					<div class="block">'.ts_remove_wpautop($content).'</div>
				</div>';
			
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
		Toggles container
	----------------------------------------------------------------- */
	function ts_toggles($atts, $content = null) {
		$output = '<div id="toggle">'.ts_remove_wpautop($content).'</div>';
		return do_shortcode($output);
		
	}
	

 	/* -----------------------------------------------------------------
		Tab
	----------------------------------------------------------------- */
	function ts_tab($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'style' => false
		), $atts));
		
		$content =ts_remove_autop($content);
		
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $count)) {
			return do_shortcode($content);
		} else {
			for($i = 0; $i < count($count[0]); $i++) {
				$count[3][$i] = shortcode_parse_atts($count[3][$i]);
			}
			$output = '<ul class="tabs">';
			
			for($i = 0; $i < count($count[0]); $i++) {
				$output .= '<li><a href="#tab'.$i.'">' . $count[3][$i]['title'] . '</a></li>';
			}
			$output .= '</ul>';
			$output .= '<div id="tab-body">';
			for($i = 0; $i < count($count[0]); $i++) {
				$output .= '<div id="tab'.$i.'" class="tab-content">' . do_shortcode(trim($count[5][$i])) . '</div>';
			}
			$output .= '</div>';
			
			return '<div class="tabcontainer">' . $output . '</div>';
		}
	}
	
	
	
 	/* -----------------------------------------------------------------
		Separator
	----------------------------------------------------------------- */
	function ts_separator($atts, $content = null) {
		extract(shortcode_atts(array(
					"line" => ''
		), $atts));
		$content =ts_remove_autop($content);
		if($line==""){
		$output = '<div class="separator"></div>';
		}else{
		$output = '<div class="separator line"></div>';
		}
		
		return do_shortcode($output);
		
	}
	
	
 	/* -----------------------------------------------------------------
		Featured shortcodes
	----------------------------------------------------------------- */

	function ts_featured_property($atts, $content = null) {
		
		$defattr = array(
			"showproperty" 	=> '4',
			"titletext" 	=> 'Featured Home <span class="colortext">For Sale</span>'
			//"pageid"	=> 0
		);
		extract(shortcode_atts($defattr, $atts));
		
		if(!is_numeric($showproperty) || $showproperty < 1){
			$showproperty = $defattr["showproperty"];
		}
		
		$output  = '<div class="title_featured">';
			$output .= '<h2>'.__($titletext,'templatesquare').'</h2>';
			//if($pageid){
				//$getpermalink = get_permalink($pageid);
				//$output .= '<a href="'.$getpermalink.'" class="featured">'.__('all featured home','templatesquare').'</a>';
			//}
		$output .= '</div>';
		$output .= '<div class="clr"></div>';
		$output .= '<ul class="two_column_properties">';
		
		query_posts('post_type=property&post_status=publish');
		global $post;
		
		$i=1; $addclass = ""; $numfeatured = 0;
		
		if (have_posts()){
			while ( have_posts() ){ the_post();
			
				$currencyunit 	= get_option("templatesquare_property_currency");
				$areaunit 		= get_option("templatesquare_property_area_unit");
				$lotunit 			= get_option("templatesquare_property_lot_unit");
				
				$prefix = 'ts_';
				
				$custom = get_post_custom($post->ID);
				$beds = (isset($custom[$prefix."beds"][0]))? $custom[$prefix."beds"][0] : "";
				$baths = (isset($custom[$prefix."baths"][0]))? $custom[$prefix."baths"][0] : "";
				$houseSize = (isset($custom[$prefix."houseSize"][0]))? $custom[$prefix."houseSize"][0] : "";
				$lotSize = (isset($custom[$prefix."lotSize"][0]))? $custom[$prefix."lotSize"][0] : "";
				$listingFeatured = (isset($custom[$prefix."listingFeatured"][0]))? $custom[$prefix."listingFeatured"][0] : "";
				$listingTitle = (isset($custom[$prefix."listingTitle"][0]))? $custom[$prefix."listingTitle"][0] : "";
				
				$address = (isset($custom[$prefix."address"][0]))? $custom[$prefix."address"][0] : "";
				$city = (isset($custom[$prefix."city"][0]))? $custom[$prefix."city"][0] : "";
				$state = (isset($custom[$prefix."state"][0]))? $custom[$prefix."state"][0] : "";
				$zipcode = (isset($custom[$prefix."zipcode"][0]))? $custom[$prefix."zipcode"][0] : "";
				
				if($listingFeatured!=true){
					continue;
				}else{
					$numfeatured++;
				}
				
				if(($i%4) == 0){ $addclass = "last";	}
				
				if(!has_post_thumbnail( $post->ID )){
				
					// lets get the type image and fully RANDOM.
					$attachments = get_children( array(
						'post_parent' => $post->ID,
						'numberposts' => 1,
						'post_type' => 'attachment',
						'order' => 'DESC',
						'post_mime_type' => 'image')
						);            
					$propertyimage = "";
					 foreach ( $attachments as $att_id => $attachment ) {
						
						// put the image in a array
						$getimage = wp_get_attachment_image_src($att_id, 'property-grid', true);
						
						// the [0] position goes for the image URL
						$propertyimage = $getimage[0];
			
					}
					
					if($propertyimage!=""){
						$outputimg =  '<img src="'.$propertyimage.'" alt="" />';
					}else{
						$outputimg =  '<img src="'.get_bloginfo('stylesheet_directory') . "/images/nophoto185x120.jpg".'" alt="" />';
					}
					
				}else{
				
					$outputimg = get_the_post_thumbnail($post->ID, 'property-grid',  array('alt' =>'', 'title' =>''));
				
				}	
				
					$t=$address . ' '. $city . '<br/> '. $state . ' '. $zipcode;
					
					if($listingTitle=="Use address as title"){
						$ltitle=$t;
					}else{
						$ltitle=get_the_title($post->ID );
					}

				
				$output .= '<li class="'.$addclass.'">';
					$output .= $outputimg;
					$output .= '<h6><a href="'.get_permalink().'">'.$ltitle.'</a></h6>';
					$output .= '<ul class="box_text">';
						$output .= '<li><span class="left">'.__('Beds','templatesquare').':</span> ' . $beds .' </li>';
						$output .= '<li><span class="left">'.__('Baths','templatesquare').':</span> ' . $baths .' </li>';
						$output .= '<li><span class="left">'.__('House size','templatesquare').':</span> ' . $houseSize . ' ' . $areaunit .' </li>';
						$output .= '<li><span class="left">'.__('Lot size','templatesquare').':</span> ' . $lotSize . ' ' . $lotunit .' </li>';
					  $output .= '</ul>	';	
				$output .= '</li>';
			
				$addclass = ""; $i++;
				
				if($numfeatured>=$showproperty){
					break;
				}
			}
		}
		$output .= '</ul>';
		
		wp_reset_query();
		return $output;
		
	}
	
	
?>