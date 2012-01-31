<?php
/*  Copyright 2010  TEMPLATESQUARE 

    TS Display is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//to block direct access
if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );

//global variable for this plugin
$pathinfo	= pathinfo(__FILE__);


require($pathinfo["dirname"]."/ts-function.php");


class TS_Display{
	
	var $imagesizes;
	var $frames;
	var $arrsmallframe;
	var	$frame;
	var	$longdesc;
	var	$langval;
	var	$version;
	var $paddingimg;
	var $borderwid;
	var $defaultattr;
	
	function TS_Display(){
		$this->__construct();
	}
	
	function __construct(){
		// Register the shortcode to the function ep_shortcode()
		add_shortcode("ts-display", array($this, "ts_display_shortcode"));
		
		//Register the Display Menu
		//add_action('init', array($this, 'ts_display_post_type'));
		add_action('init', array($this, 'ts_display_action_init'));
		add_action('after_setup_theme', array($this, 'ts_display_setup'));
		
		$this->version		= "1.0";
	}
	
	//Get the display Options from Theme Options
	function ts_display_getoption(){
	
		$options = array(
			"widthimg" 		=> get_option('templatesquare_display_widthimg',290),
			"heightimg" 	=> get_option('templatesquare_display_heightimg',180),
			"contentwidth"	=> get_option('templatesquare_display_contentwidth',940),
			"colspacing"	=> get_option('templatesquare_display_colspacing',35),
			"rowspacing"	=> get_option('templatesquare_display_rowspacing',60),
			"readmoretext"	=> get_option('templatesquare_display_readmoretext',"Read More")
		);
		
		return $options;
	}
	
	//Get the version of ts display
	function ts_display_version(){
		$this->version = "1.5.4";
		
		return $this->version;
	}

	//Get the image size for every column
	function ts_display_setsize(){
		//set image size for every column in here.
		
		$options = $this->ts_display_getoption();
		$this->imagesizes = array(
			array(
				"num"		=> 'custom',
				"namesize"	=> 'ts-display-custom-post-thumbnail',
				"width" 	=> $options["widthimg"],
				"height" 	=> $options["heightimg"],
				"width2"	=> $options["widthimg"],
				"height2"	=> $options["heightimg"]
			)
			
		);
		return $this->imagesizes;
	}
	
	function ts_display_smallframe(){
		//Set the frames that have different size.
		$this->arrsmallframe = array("square","rounded");
		return $this->arrsmallframe;
	}
	
	function ts_display_setup(){
		add_theme_support( 'post-thumbnails' );
		$imagesizes = $this->ts_display_setsize();
		foreach($imagesizes as $imgsize){
			add_image_size( $imgsize["namesize"], $imgsize["width"], $imgsize["height"], true ); // Portfolio Thumbnail
		}
	}
	
	function ts_display_getthumbinfo($col){
		$imagesizes = $this->ts_display_setsize();
		foreach($imagesizes as $imgsize){
			if($col==$imgsize["num"]){
				return $imgsize;
			}
		}
		return false;
	}
	
	//Count all posts from post type 'display'.	
	function ts_display_getnumposts($cat){
		global $wpdb;
		$qryString = "
			SELECT	Count(*) as totpost FROM ".$wpdb->posts." a 
			INNER 	JOIN ".$wpdb->term_relationships." b ON a.ID = b.object_id 
			INNER 	JOIN ".$wpdb->term_taxonomy." c ON b.term_taxonomy_id = c.term_taxonomy_id
			INNER	JOIN ".$wpdb->terms."  d ON c.term_id = d.term_id
			WHERE 	a.post_type = 'display'
		";
		if(strlen($cat)>0){
			$qryString .= " AND	d.slug = '".$cat."'";
		}
		$numposts = $wpdb->get_var($wpdb->prepare($qryString));
		return $numposts;
	}
	
	//make the shortcode
	function ts_display_shortcode($atts){
		global $more;
		
		$options = $this->ts_display_getoption();
		$version = $this->ts_display_version();
		
		/*******************SHORTCODE PROPERTIES**********************/
		//Specify default attributes
		$this->defaultattr = array(
			"cat" => '',
			"col" => '3',
			"postperpage" => '8',
			"frame" => 'plain',
			"showdesc" => 'no',
			"showtitle" => 'no',
			"showmore"	=> 'no',
			"fbordercolor" => '#d5d5d5',
			"fbgcolor" => '#e9e9e9',
			"customclass" => '',
			"colspacing" => $options["colspacing"],
			"rowspacing" => $options["rowspacing"],
			"contentwidth" => $options["contentwidth"],
			"widthimg" => $options["widthimg"],
			"heightimg" => $options["heightimg"]
		);
		
		$this->paddingimg = 7;
		$this->borderwid = 1;
		
		//Set all frames that available.
		$this->frames = array("plain","square", "rounded");
		
		//Get the setting option value
		$this->longdesc 	= 150;
		
		$this->langval 		= "ts_display";
		/*******************END SHORTCODE PROPERTIES**********************/
		
		$defattr = $this->defaultattr;

		$readmoretext = $options["readmoretext"];
		//make all shortcode attributes into single variable
		extract(shortcode_atts($defattr, $atts));
		
		$more = 0;
		
		//validate the postperpage, default value is -1.
		$postperpage = (is_numeric($postperpage)&& $postperpage >=-1)? $postperpage : -1;
				
		//validate the frame, default value is 'frame1'.
		$frame = (in_array($frame,$this->frames))? $frame : $defattr["frame"];
		$longdesc = $this->longdesc;
		
		//validates the column
		$col = (!is_numeric($col))? $defattr["col"] : $col;
		
		//validates the frame dimensions.
		$widthimg = (!is_numeric($widthimg))? $defattr["widthimg"] : $widthimg;
		$heightimg = (!is_numeric($heightimg))? $defattr["heightimg"] : $heightimg;
		$contentwidth = (!is_numeric($contentwidth))? $defattr["contentwidth"] : $contentwidth;
		$paddingimg = $this->paddingimg;
		
		//validates column spacing and row spacing
		$colspacing = (!is_numeric($colspacing) || $colspacing < 0)? $defattr["colspacing"] : $colspacing;
		$rowspacing = (!is_numeric($rowspacing) || $rowspacing < 0)? $defattr["rowspacing"] : $rowspacing;
		
		$framewidth = $widthimg;
		$frameheight = $heightimg;
		
		$thumbinfo = $this->ts_display_getthumbinfo("custom");
		if(in_array($frame,$this->ts_display_smallframe())){
			$thumbwidth 	= $framewidth  - ($this->paddingimg*2) - ($this->borderwid*2);
			$thumbheight 	= $frameheight - ($this->paddingimg*2) - ($this->borderwid*2);
			$thumbname		= $thumbinfo["namesize"];
		}else{
			$thumbwidth 	= $framewidth;
			$thumbheight 	= $frameheight;
			$thumbname		= $thumbinfo["namesize"];
		}
		$paged = (get_query_var('paged'))? get_query_var('paged') : 1 ;
		
		//Get total of all posts from post type 'display'.
		$numposts = $this->ts_display_getnumposts($cat);
		
		//Count the total page.
		$num_page = floor($numposts/$postperpage)+1;
		$num_page = ($numposts%$postperpage!=0)? $num_page : $num_page - 1; 

		//Get the post from the query.
		$catinclude = 'post_type=display';
		if(strlen($cat)){
			$catinclude .= '&display-category='.$cat;
		}
		query_posts('&' . $catinclude .' &paged='.$paged.'&posts_per_page='.$postperpage.'&orderby=date');
		global $post;
		//make a appologies content if the posts is zero or null
		if ( ! have_posts() ){
			$error404 =  '<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title">'.__( 'Not Found',$this->langval). '</h1>
				<div class="entry-content">
					<p>'.__( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.',$this->langval).'</p>
					';
			$error404 .= get_search_form();
			$error404 .= '
				</div>
			</div>';
			return $error404;
		}
		
		//generate the display HTML
		$htmldisp = "";
		$htmldisp .= '
			<style type="text/css" media="screen">
			
			/* To Overwrite #content img{width: auto; height:auto;} */
			.ts-display-'.$frame.' .ts-display-img-'.$frame.' a.image img{
				width: 	'.$thumbwidth.'px !important;
				height:	'.$thumbheight.'px !important;
			}
			
			#ts-display-list a.image{
				width:'.$thumbwidth.'px;
				height:'.$thumbheight.'px; 
			}
			#ts-display-list a.image:hover{
				width:'.$thumbwidth.'px;
				height:'.$thumbheight.'px;
			}
			</style>
		';
		$htmldisp .=	'
		<div id="ts-display" class="'.$customclass.'">
			<ul id="ts-display-list" class="ts-display-'.$frame.' ts-display-col-'.$col.'">
			';
			$i=1;
			$addclass = "";
			if (have_posts()){
				while ( have_posts() ){ 
					the_post(); 
					$stylelist = 'width:'.$framewidth.'px;';
					$rowsstyle = $rowspacing;
					$colsstyle = $colspacing;
					if(($i%$col) == 0 && $col){ 
						$colsstyle = 0;
					}
					$stylelist .= 'margin:0px '.$colsstyle.'px '.$rowsstyle.'px 0px;';
					$custom = get_post_custom($post->ID);
					$cf_thumb = $custom["thumb"][0];
					$cf_lightbox = $custom["lightbox"][0];
					$imginfos = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),$thumbname);
					
					if($cf_thumb!=""){
						$cf_thumb = '<img src="'.$cf_thumb.'" alt=""  width="'.$thumbwidth.'" height="'.$thumbheight.'" class="fade"/>';
					}else{
						$cf_thumb = '<img src="'.$imginfos[0].'" alt=""  width="'.$thumbwidth.'" height="'.$thumbheight.'" class="fade"/>';
					}
					$styleframe = "";
					$addancclass = "image";
					$addancclassimgsmall = "";
					if($frame=="square" || $frame=="rounded"){
						$styleframe .= 'border:solid 1px '.$fbordercolor.' !important; background-color:'.$fbgcolor.' !important; padding:'.$paddingimg.'px;';
						if($frame=="rounded"){
							$addancclass .= " ts-display-rounded";
						}
					}
					if($thumbwidth<=150 || $thumbheight<=150){
						$addancclassimgsmall = " imagesmall";
					}
					
					$styleancimg = 'height:'.$thumbheight.'px; width:'.$thumbwidth.'px;';
					
					$htmlancimg = "";
					if($cf_lightbox!=""){ 
						$htmlancimg .= '<a class="'.$addancclass.'" href="'.$cf_lightbox.'" style="'.$styleancimg.$styleframe.'" rel="prettyPhoto[mixed]" title="'.get_the_title($post->ID).'">';
						$htmlancimg .= "<span class='rollover". $addancclassimgsmall. "'></span>";
						$htmlancimg .= "<span class='rounded-frame'></span>";
						$htmlancimg .= $cf_thumb;
						$htmlancimg .= "<span class='afterthumb'></span>";
						$htmlancimg .= '</a>';
					}else{ 
						$htmlancimg .= '<a class="'.$addancclass.'" style="'.$styleancimg.$styleframe.'" href="'.get_permalink($post->ID).'" title="'.__('Permanent Link to ',$this->langval).the_title_attribute('echo=0').'" >';
						$htmlancimg .= "<span class='rollover". $addancclassimgsmall. "''></span>";
						$htmlancimg .= "<span class='rounded-frame'></span>";
						$htmlancimg .= $cf_thumb;
						$htmlancimg .= "<span class='afterthumb'></span>";
						$htmlancimg .= '</a>';
					}
					
					$textdescription = "";
					if($showtitle=="yes"){
						$textdescription .= '<h2>'. get_the_title($post->ID).'</h2>';
					}
					if($showdesc=="yes"){
						$excerpt = get_the_excerpt();
						if($col==99){
							$textdescription .= ts_display_limit_words($excerpt,$longdesc);
						}else{
							$textdescription .='<p>'.ts_display_limit_char($excerpt,$longdesc).'</p>';
						}
						if($showmore=="yes"){
							$textdescription .='<a href="'.get_permalink($post->ID).'" title="'.__( 'Permalink to ',$this->langval).the_title_attribute('echo=0').'" rel="bookmark" class="displaymore">'.__($readmoretext,$this->langval).'</a>';
						}
					}
					if($textdescription!=""){
						$textdescription = '<div class="ts-display-text-content">'.$textdescription.'</div>';
					}
					
					$displayclear = "";
					if($col==1){
						$displayclear .= '<div class="ts-display-clear"></div>';
					}
					
					
					$htmldisp .= '<li class="'.$addclass.'" style="'.$stylelist.'">';
						$htmldisp .= '<div class="ts-display-img-'.$frame.' ts-display-img-container">';
							$htmldisp .= $htmlancimg;
						$htmldisp .= '</div>';
						$htmldisp .= $textdescription;
						$htmldisp .= $displayclear;
					$htmldisp .= '</li>';
					
					$i++;
					$addclass=""; 
				}//---------------end While(have_posts())--------------
			}//----------------end if(have_posts())-----------------
			
			$htmldisp .= '
				</ul>
				<div class="clr"></div>
			</div>';
			if($frame=="rounded"){
				$htmldisp .= '
				<!--[if IE]>
				<script type="text/JavaScript">
				$(document).ready(function() {
				
				 $("#ts-display-list .ts-display-'.$frame.'").cornerz({
					  radius: 6
					  })
				})
				</script>
				<![endif]-->
				';
			}
			
			if (  $num_page > 1 ){
				 if(function_exists('wp_pagenavi')) {
					 ob_start();
					 
					 wp_pagenavi();
					 $htmldisp .= ob_get_contents();
						 
					 ob_end_clean();
				 }else{
					$htmldisp .= '
					<div id="nav-below" class="navigation nav2">
						<div class="nav-previous">'.get_next_posts_link( __( '<span class="prev"><span class="meta-nav">&laquo;</span> Prev</span>', 'templatesquare' ) ).'</div>
						<div class="nav-next">'.get_previous_posts_link( __( '<span class="prev">Next <span class="meta-nav">&raquo;</span></span>', 'templatesquare' ) ).'</div>
					</div><!-- #nav-below -->';
				}
			}
			wp_reset_query();
			
			return $htmldisp;
	}
	
	/* Make a Display Post Type */
	function ts_display_post_type() {
		register_post_type( 'display',
					array( 
					'label' => __('Portfolio'), 
					'public' => true, 
					'show_ui' => true,
					'show_in_nav_menus' => true,
					'rewrite' => true,
					'hierarchical' => true,
					'menu_position' => 5,
					'supports' => array(
										 'title',
										 'editor',
										 'thumbnail',
										 'excerpt',
										 'custom-fields',
										 'revisions')
						) 
					);
		register_taxonomy('display-category', 'display', array('hierarchical' => true, 'label' => __('Portfolio Categories'), 'singular_name' => 'Category'));
	}
	
	function ts_display_action_init(){
		
		$version = $this->ts_display_version();
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit posts and pages
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter('mce_buttons', array($this, 'ts_display_filter_mce_button'));
			add_filter('mce_external_plugins',array($this, 'ts_display_filter_mce_plugin'));
		}
		
		$basedisplayurl = get_template_directory_uri()."/includes/ts-display/";
		
		//Register jQuery and Pretty Photo plugin and use it
		wp_enqueue_script('jquery', $basedisplayurl.'js/jquery-1.4.2.min.js', false, '1.4.2');
		wp_enqueue_script("prettyphoto", $basedisplayurl.'js/jquery.prettyPhoto.js', array('jquery'), "3.0");
		wp_enqueue_script("fade", $basedisplayurl.'js/fade.js', array('jquery'));
		wp_enqueue_script("ts-lightbox", $basedisplayurl.'js/ts-display-lightbox.js', array('jquery'));
		wp_enqueue_script("cornerz", $basedisplayurl.'js/cornerz.js', array('jquery'));
		
		//Register and use this plugin main CSS
		wp_register_style('ts-display-main', $basedisplayurl.'css/ts-display.css', array(), $version . time());
		wp_register_style('ts-display-prettyPhoto', $basedisplayurl.'css/prettyPhoto.css', array(), "2.5.6");
		wp_enqueue_style('ts-display-main');
		wp_enqueue_style('ts-display-prettyPhoto');
	}
	
	function ts_display_filter_mce_button( $buttons ) {
		// add a separation before our button, here our button's id is "mygallery_button"
		array_push( $buttons, '|', 'ts_display_button' );
		return $buttons;
	}
	
	function ts_display_filter_mce_plugin( $plugins ) {
		
		// set ts-display folder url
		$basedisplayurl = get_template_directory_uri()."/includes/ts-display/";
		
		// this plugin file will work the magic of our button
		$plugins['ts_display'] = $basedisplayurl . 'js/ts-display-plugin.js';
		return $plugins;
	}
	
}
$ts_display = new TS_Display();
?>