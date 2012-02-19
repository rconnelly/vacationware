<?php
/*  Copyright 2010  TEMPLATESQUARE 

    TS Thinkbox is free software; you can redistribute it and/or modify
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


class TS_Thinkbox{
	
	var $imagesizes;
	var $types;
	var	$type;
	var	$longdesc;
	var $avatar;
	var	$langval;
	var	$version;
	var $defaultattr;
	var $posttypename;
	
	function TS_Thinkbox(){
		$this->__construct();
	}
	
	function __construct(){
		// Register the shortcode to the function ep_shortcode()
		add_shortcode("ts-thinkbox", array($this, "ts_thinkbox_shortcode"));
		add_shortcode("ts-thinkboxslider", array($this, "ts_thinkbox_slider_shortcode"));
		
		// Register hooks for activation.
		$this->ts_thinkbox_activation();
		
		//Register the Thinkbox Menu
		add_action('init', array($this, 'ts_thinkbox_post_type'));
		add_action('init', array($this, 'ts_thinkbox_action_init'));
		add_action('after_setup_theme', array($this, 'ts_thinkbox_setup'));
		
	}
	
	function ts_thinkbox_getlangval(){
		$this->langval = "ts_thinkbox";
		return $this->langval;
	}
	
	//Get the version of ts thinkbox
	function ts_thinkbox_version(){
		$this->version		= "1.1.0";
		
		return $this->version;
	}

	//Get the image size for every column
	function ts_thinkbox_setsize(){
		//set image size for every column in here.
		$this->imagesizes = array(
			array(
				"num"		=> 'custom',
				"namesize"	=> 'ts-thinkbox-custom-post-thumbnail',
				"width" 	=> get_option('ts_thinkbox_widthimg'),
				"height" 	=> get_option('ts_thinkbox_heightimg')
			)
			
		);
		return $this->imagesizes;
	}
	
	function ts_thinkbox_getdefattr($typeattr){
		if(!isset($typeattr)) return false;
		//Specify default attributes
		$this->defaultattr = array();
		$this->defaultattr["plain"] = array(
			"col" => '1',
			"cat" => '',
			"postperpage" => '-1',
			"type" => '1',
			"frame" => 'square',
			"testiid" => '',
			"longtext" => '',
			"showthumb" => 'yes',
			"showtitle" => 'no',
			"showname"	=> 'yes',
			"showinfo"	=> 'yes',
			"customclass" => '',
			"widthimg" => get_option('ts_thinkbox_widthimg'),
			"heightimg" => get_option('ts_thinkbox_heightimg')
		);
		$this->defaultattr["slider"] = array(
			"sliderfx" => 'scrollHorz',
			"cat" => '',
			"postperpage" => '-1',
			"testiid" => '',
			"longtext" => '',
			"showtitle" => 'no',
			"showname"	=> 'yes',
			"showinfo"	=> 'yes',
			"customclass" => '',
			"widthimg" => get_option('ts_thinkbox_widthimg'),
			"heightimg" => get_option('ts_thinkbox_heightimg')
		);
		if(array_key_exists($typeattr,$this->defaultattr)){
			return $this->defaultattr[$typeattr];
		}else{
			return false;
		}
	}
	
	function ts_thinkbox_getposttype(){
		$this->posttypename	= "thinkbox";
		return $this->posttypename;
	}
	
	function ts_thinkbox_gettypes(){
		$this->types = array("1","2");
		return $this->types;
	}
	
	function ts_thinkbox_getframes(){
		$this->frames = array("square","rounded");
		return $this->frames;
	}
	
	function ts_thinkbox_geteffects(){
		$this->effects = array("fade","scrollVert","scrollHorz","zoom","scrollUp","scrollDown","shuffle");
		return $this->effects;
	}
	
	function ts_thinkbox_setup(){
		add_theme_support( 'post-thumbnails' );
		$imagesizes = $this->ts_thinkbox_setsize();
		foreach($imagesizes as $imgsize){
			add_image_size( $imgsize["namesize"], $imgsize["width"], $imgsize["height"], true ); // thinkbox pics thumbnail
		}
	}
	
	function ts_thinkbox_getthumbinfo($col){
		$imagesizes = $this->ts_thinkbox_setsize();
		foreach($imagesizes as $imgsize){
			if($col==$imgsize["num"]){
				return $imgsize;
			}
		}
		return false;
	}
	
	function ts_thinkbox_getavatar(){
		$this->avatar = plugin_dir_url( __FILE__ )."images/avatar.gif";
		return $this->avatar;
	}
	
	//make the shortcode
	function ts_thinkbox_shortcode($atts){
		global $more;
		
		$langval = $this->ts_thinkbox_getlangval();
		$avatar = $this->ts_thinkbox_getavatar();
		$defframes = $this->ts_thinkbox_getframes();
		$deftypes = $this->ts_thinkbox_gettypes();
		$defattr = $this->ts_thinkbox_getdefattr("plain");		
		//make all shortcode attributes into single variable
		extract(shortcode_atts($defattr, $atts));
		
		$more = 0;
		
		//validate the postperpage, default value is -1.
		$postperpage = (is_numeric($postperpage)&& $postperpage >=-1)? $postperpage : -1;
				
		//validate the type, default value is 'plain'.
		$type = (in_array($type,$deftypes))? $type : $defattr["type"];
		$frame = (in_array($frame,$defframes))? $frame : $defattr["frame"];
		$longdesc = (is_numeric($longtext) && $longtext > 0)? $longtext : 0;
		
		//validates the Testimonial ID, default is 0
		$testiid = (strlen($testiid)>0 && $testiid!=0)? $testiid : $defattr["testiid"];
		
		//validates the image dimensions.
		$widthimg = (!is_numeric($widthimg))? $defattr["widthimg"] : $widthimg;
		$heightimg = (!is_numeric($heightimg))? $defattr["heightimg"] : $heightimg;
		
		$picwidth = $widthimg;
		$picheight = $heightimg;
		
		$thumbinfo = $this->ts_thinkbox_getthumbinfo("custom");
		$thumbwidth 	= $picwidth;
		$thumbheight 	= $picheight;
		$thumbname		= $thumbinfo["namesize"];
		$paged = (get_query_var('paged'))? get_query_var('paged') : 1 ;

		//define all used variable for the query.
		$arrinclude = array();
		$arrinclude['post_type'] = $this->ts_thinkbox_getposttype();
		if($postperpage>=0){
			$arrinclude['paged'] = $paged;
		}
		$arrinclude['posts_per_page'] = $postperpage;
		$arrinclude['orderby'] = 'date';
		if(strlen($cat)){
			$arrinclude['thinkbox-category'] = $cat;
		}
		
		if(strlen($testiid)>0 && $testiid!=0){
			$arrinclude['post__in'] = explode(",",$testiid);
		}

		query_posts($arrinclude);
		global $wp_query, $post;
		
		//make a appologies content if the posts is zero or null
		if ( ! have_posts() ){
			$error404 =  '<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title">'.__( 'Not Found',$langval). '</h1>
				<div class="entry-content">
					<p>'.__( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.',$langval).'</p>
					';
			$error404 .= get_search_form();
			$error404 .= '
				</div>
			</div>';
			return $error404;
		}
		
		//generate the thinkbox HTML
		$htmldisp = "";
		
		$htmldisp .=	'
		<div class="ts-thinkbox '.$customclass.'">
			<ul class="ts-thinkbox-list ts-thinkbox-'.$type.'">
			';
			$i=0;
			$addclass = "";
			if($col==1){
				$addclass = "nomargin";
			}
			if (have_posts()){
				while ( have_posts() ){ 
					the_post(); 
					$custom = get_post_custom($post->ID);
					$cf_thumb = $custom["tb-thumb"][0];
					$tb_name = $custom["tb-name"][0];
					$tb_info = $custom["tb-info"][0];
					$imginfos = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),$thumbname);
					
					
					if($i%$col==0 && $col > 1){
						$htmldisp .= '</ul><ul class="ts-thinkbox-list ts-thinkbox-'.$type.'">';
					}
					
					
					$stylelist = '';
					$percentage = intval(100/$col)-2;
					$stylelist = 'width:'.$percentage.'%;';
					
					
					$widthheightimg = 'width:'.$thumbwidth.'px;height:'.$thumbheight.'px;';
					if($cf_thumb!=""){
						$cf_thumb = '<img src="'.$cf_thumb.'" alt="" style="'.$widthheightimg.'"/>';
					}elseif($imginfos!=false){
						$cf_thumb = '<img src="'.$imginfos[0].'" alt="" style="'.$widthheightimg.'"/>';
					}else{
						$cf_thumb = '<img src="'.$avatar.'" alt="" style="'.$widthheightimg.'"/>';
					}
					
					$htmldisp .= '<li class="'.$addclass.'" style="'.$stylelist.'">';
					
					$textquote = "";
					$text = get_the_content();
					if($longdesc>0){
						$text = ts_helper_limit_char($text,$longdesc);
					}
					if($showtitle=="yes"){
						$textquote .= '<a class="header">'.get_the_title($post->ID).'</a>';
					}
					$textquote .='<blockquote>'.$text.'</blockquote>';
					$textinfo = "";
					if($showname=="yes" && $tb_name!=""){
						$textinfo .= '<span class="ts-thinkbox-name">'. $tb_name.'</span>';
					}
					if($showinfo=="yes" && $tb_info!=""){
						$textinfo .= '<span class="ts-thinkbox-info">'. $tb_info.'</span>';
					}
					if($textinfo!=""){
						$textinfo = '<div class="ts-thinkbox-textinfo">'.$textinfo.'</div>';
					}
					
					$marginquote = '';
					if($type=="1"){
						$pointer = "";
						$thinkboxthumb = "";
						if($showthumb=="yes"){
							$thinkboxthumb .= '<div class="ts-thinkbox-thumb" style="'.$widthheightimg.'">'.$cf_thumb.'</div>';
							$pointer .= '<div class="ts-thinkbox-leftpointer"></div>';
							$totalmargin = $thumbwidth + 6 + 2 + 28;
							$marginquote .= 'margin-left:'.$totalmargin.'px;';
						}
						
						$htmldisp .= $thinkboxthumb;
						$htmldisp .= '<div class="ts-thinkbox-quote ts-thinkbox-'.$frame.'" style="'.$marginquote.'">';
						$htmldisp .= $pointer;
						$htmldisp .= $textinfo;
						$htmldisp .= $textquote;
						$htmldisp .= '</div>';
						
					}elseif($type=="2"){
						$pointer = "";
						$thinkboxthumb = "";
						if($showthumb=="yes"){
							$totalmargin = 30;
							$pointer = '<div class="ts-thinkbox-bottompointer"></div>';
							$thinkboxthumb .= '<div class="ts-thinkbox-thumb" style="'.$widthheightimg.'">'.$cf_thumb.'</div>';
							$marginquote = 'margin-bottom:'.$totalmargin.'px;';
						}
						
						$htmldisp .= '<div class="ts-thinkbox-quote ts-thinkbox-'.$frame.'" style="'.$marginquote.'">';
						$htmldisp .= $textquote;
						$htmldisp .= $pointer;
						$htmldisp .= '</div>';
						$htmldisp .= $thinkboxthumb;
						$htmldisp .= $textinfo;
					}
					
					$displayclear = "";
					if($col==1){
						$displayclear .= '<div class="ts-thinkbox-clear"></div>';
					}
					$htmldisp .= $displayclear.'</li>';
					$i++;
					$addclass=""; 
				}//---------------end While(have_posts())--------------
			}//----------------end if(have_posts())-----------------
				
			$htmldisp .= '
				</ul>
				<div class="ts-thinkbox-clr"></div>
			</div>';
			
			if (  $wp_query->max_num_pages > 1 ){
				 if(function_exists('wp_pagenavi')) {
					 ob_start();
					 
					 wp_pagenavi();
					 $htmldisp .= ob_get_contents();
						 
					 ob_end_clean();
				 }else{
					$htmldisp .= '
					<div id="nav-below" class="navigation nav2">
						<div class="nav-previous">'.get_next_posts_link( __( '<span class="prev"><span class="meta-nav">&laquo;</span> Prev</span>', $this->langval ) ).'</div>
						<div class="nav-next">'.get_previous_posts_link( __( '<span class="prev">Next <span class="meta-nav">&raquo;</span></span>', $this->langval ) ).'</div>
					</div><!-- #nav-below -->';
				}
			}
			wp_reset_query();
			
			return $htmldisp;
	}
	
	
	//make the shortcode
	function ts_thinkbox_slider_shortcode($atts){
		global $more;
		
		$langval 		= $this->ts_thinkbox_getlangval();
		$avatar 		= $this->ts_thinkbox_getavatar();
		$defeffects 	= $this->ts_thinkbox_geteffects();
		$defattr = $this->ts_thinkbox_getdefattr("slider");		
		//make all shortcode attributes into single variable
		extract(shortcode_atts($defattr, $atts));
		
		$more = 0;
		
		//validate the postperpage, default value is -1.
		$postperpage = (is_numeric($postperpage)&& $postperpage >=-1)? $postperpage : -1;
				
		//validate the slider effects, default value is 'scrollHorz'.
		$sliderfx = (in_array($sliderfx,$defeffects))? $sliderfx : $defattr["sliderfx"];
		$longdesc = $this->longdesc;
		
		//validates the Testimonial ID, default is 0
		$testiid = (strlen($testiid)>0 && $testiid!=0)? $testiid : $defattr["testiid"];
		
		//validates the image dimensions.
		$widthimg = (!is_numeric($widthimg))? $defattr["widthimg"] : $widthimg;
		$heightimg = (!is_numeric($heightimg))? $defattr["heightimg"] : $heightimg;
		
		$picwidth = $widthimg;
		$picheight = $heightimg;
		
		$thumbinfo = $this->ts_thinkbox_getthumbinfo("custom");
		$thumbwidth 	= $picwidth;
		$thumbheight 	= $picheight;
		$thumbname		= $thumbinfo["namesize"];
		$paged = (get_query_var('paged'))? get_query_var('paged') : 1 ;


		//define all used variable for the query.
		$arrinclude = array();
		$arrinclude['post_type'] = $this->ts_thinkbox_getposttype();
		if($postperpage>=0){
			$arrinclude['paged'] = $paged;
		}
		$arrinclude['posts_per_page'] = $postperpage;
		$arrinclude['orderby'] = 'date';
		if(strlen($cat)){
			$arrinclude['thinkbox-category'] = $cat;
		}
		if(strlen($testiid)>0 && $testiid!=0){
			$arrinclude['post__in'] = explode(",",$testiid);
		}

		query_posts($arrinclude);
		global $wp_query, $post;
		
		//make a appologies content if the posts is zero or null
		if ( ! have_posts() ){
			$error404 =  '<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title">'.__( 'Not Found',$langval). '</h1>
				<div class="entry-content">
					<p>'.__( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.',$langval).'</p>
					';
			$error404 .= get_search_form();
			$error404 .= '
				</div>
			</div>';
			return $error404;
		}
		
		//generate the thinkbox slider HTML
		$htmldisp = "";
		
				$i=1;
				$addclass = "slider";
				$htmlthumb = "";
				$htmlquote = "";
				if (have_posts()){
					while ( have_posts() ){ 
						the_post(); 
						$custom = get_post_custom($post->ID);
						$cf_thumb = $custom["tb-thumb"][0];
						$tb_name = $custom["tb-name"][0];
						$tb_info = $custom["tb-info"][0];
						$imginfos = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),$thumbname);
						
						$widthheightimg = 'width:'.$thumbwidth.'px;height:'.$thumbheight.'px;';
						if($cf_thumb!=""){
							$cf_thumb = '<img src="'.$cf_thumb.'" alt="" style="'.$widthheightimg.'"/>';
						}elseif($imginfos!=false){
							$cf_thumb = '<img src="'.$imginfos[0].'" alt="" style="'.$widthheightimg.'"/>';
						}else{
							$cf_thumb = '<img src="'.$avatar.'" alt="" style="'.$widthheightimg.'"/>';
						}
						
						$htmlthumb .= '<a href="#" id="thumbslide-'.$i.'" title="'.($i-1).'" class="ts-thinkbox-slider-thumbslide" style="'.$widthheightimg.'">'.$cf_thumb.'</a>';
						
						$htmlquote .= '<div class="ts-thinkbox-slider-quotecontent">';
							if($showtitle=="yes"){
								$htmlquote .= '<a class="header">'.get_the_title($post->ID).'</a>';
							}
							
							$text = get_the_content();
							if($longdesc>0){
								$text = ts_helper_limit_char($text,$longdesc);
							}
							$htmlquote .='<div class="ts-thinkbox-slider-quote">'.$text.'</div>';
							
							$textinfo = "";
							if($showname=="yes" && $tb_name!=""){
								$textinfo .= '<span class="ts-thinkbox-slider-name">'. $tb_name.'</span>';
							}
							if($showinfo=="yes" && $tb_info!=""){
								$textinfo .= '<span class="ts-thinkbox-slider-info">'. $tb_info.'</span>';
							}
							if($textinfo!=""){
								$htmlquote .= '<div class="ts-thinkbox-slider-textinfo">'.$textinfo.'</div>';
							}
						$htmlquote .='</div>';
						$i++;
						$addclass=""; 
					}//---------------end While(have_posts())--------------
					$htmldisp .= '<div class="ts-thinkbox-slider">';
						$htmldisp .= '<div class="ts-thinkbox-slider-cont">';
							$htmldisp .= '<div class="ts-thinkbox-slider-quotecontainer ts-thinkbox-slider-'.$sliderfx.'" id="ts-thinkbox-slider-quotecontainer">';
							$htmldisp .= $htmlquote;
							$htmldisp .= '</div>';
							$htmldisp .= '<div class="ts-thinkbox-slider-pointer"></div>';
						$htmldisp .= '</div>';
						$htmldisp .= '<div class="ts-thinkbox-slider-thumbcont">'.$htmlthumb.'</div>';
						$htmldisp .= '<div class="ts-thinkbox-clear"></div>';
					$htmldisp .= '</div>';
					
				}//----------------end if(have_posts())-----------------
			wp_reset_query();
			
			return $htmldisp;
	}
	
	/* Make a Testimonial Post Type */
	function ts_thinkbox_post_type() {
		register_post_type( $this->ts_thinkbox_getposttype(),
			array( 
				'label' => __('Thinkbox'), 
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
					 'custom-fields'
				)
			) 
		);
		register_taxonomy('thinkbox-category', 'thinkbox', array('hierarchical' => true, 'label' => __('Thinkbox Categories'), 'singular_name' => 'Category'));
	}
	
	function ts_thinkbox_activation(){
		add_option("ts_thinkbox_widthimg",60,"","yes");
		add_option("ts_thinkbox_heightimg",60,"","yes");
	}
	
	function ts_thinkbox_deactivation(){
		delete_option("ts_thinkbox_widthimg");
		delete_option("ts_thinkbox_heightimg");
	}
	
	function ts_thinkbox_action_init(){
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit posts and pages
		$version = $this->ts_thinkbox_version();
		
		
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter('mce_buttons', array($this, 'ts_thinkbox_filter_mce_button'));
			add_filter('mce_external_plugins',array($this, 'ts_thinkbox_filter_mce_plugin'));
		}
		
		// set ts-display folder url
		$basethinkboxurl = get_template_directory_uri()."/includes/ts-thinkbox/";
		
		//Register jQuery with all plugins and use it
		wp_enqueue_script('jquery', $basethinkboxurl.'js/jquery-1.4.2.min.js', false, '1.4.2');
		wp_enqueue_script("fade", $basethinkboxurl.'js/fade.js', array('jquery'));
		wp_enqueue_script("cornerz", $basethinkboxurl.'js/cornerz.js', array('jquery'));
		wp_enqueue_script('cycle', $basethinkboxurl.'/js/jquery.cycle.all.min.js', array('jquery'));
		wp_enqueue_script('thinkbox-slider', $basethinkboxurl.'/js/ts-thinkbox-slider.js.php', array('jquery'));
		
		//Register and use this plugin main CSS
		wp_register_style('ts-thinkbox-main', $basethinkboxurl.'css/ts-thinkbox.css', array(), $version . time());
		wp_enqueue_style('ts-thinkbox-main');
	}
	
	function ts_thinkbox_filter_mce_button( $buttons ) {
		// add a separation before our button, here our button's id is "ts_thinkbox_button"
		array_push( $buttons, '|', 'ts_thinkbox_button' );
		array_push( $buttons, '|', 'ts_thinkbox_slider_button' );
		return $buttons;
	}
	
	function ts_thinkbox_filter_mce_plugin( $plugins ) {
	
		// set ts-display folder url
		$basethinkboxurl = get_template_directory_uri()."/includes/ts-thinkbox/";
		
		// this plugin file will work the magic of our button
		$plugins['ts_thinkbox'] = $basethinkboxurl . 'js/ts-thinkbox-plugin.js';
		$plugins['ts_thinkbox_slider'] = $basethinkboxurl . 'js/ts-thinkbox-plugin.js';
		return $plugins;
	}
}
//$ts_thinkbox = new TS_Thinkbox();
?>