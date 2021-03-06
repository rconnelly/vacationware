<?php
/**
 * The Header for our theme.
 *
 *
 * @package WordPress
 * @subpackage Light House
 * @since Light House 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(''); ?></title>
<?php $bodyclass = ""; ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="alternate" id="templateurl" href="<?php echo get_template_directory_uri(); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php 
$favicon = get_option('templatesquare_favicon');
if($favicon =="" ){
?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
<?php }else{?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php }?>


<!-- Begin FB Sharing for WP by Chad Von Lind. Get the latest code here: http://vonlind.com/?p=539  -->
<?php
$thumb = get_post_meta($post->ID,'_thumbnail_id',false);
$thumb = wp_get_attachment_image_src($thumb[0], false);
$thumb = $thumb[0];
$default_img = get_bloginfo('stylesheet_directory').'/images/default_icon.jpg';

?>

<?php if(is_single() || is_page()) { ?>
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php single_post_title(''); ?>" />
<meta property="og:url" content="<?php the_permalink(); ?>"/>
<meta property="og:image" content="<?php if ( $thumb[0] == null ) { echo $default_img; } else { echo $thumb; } ?>" />
    <?php  } else { ?>
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php bloginfo('name'); ?>" />
<meta property="og:url" content="<?php bloginfo('url'); ?>"/>
<meta property="og:image" content="<?php  if ( $thumb[0] == null ) { echo $default_img; } else { echo $thumb; } ?>" />
    <?php  }  ?>
<!-- End FB Sharing for WP -->


<?php

	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	
	$sliderTimeout = get_option('templatesquare_slider_timeout');
?>
<!-- ////////////////////////////////// -->
<!-- //      Javascript Files        // -->
<!-- ////////////////////////////////// -->

<script type="text/javascript">
var $jts = jQuery.noConflict();

	$jts(document).ready(function(){
	
		/* dropdown menu */	
	   /** $jts("ul.sf-menu").supersubs({
		minWidth		: 9,		// requires em unit.
		maxWidth		: 25,		// requires em unit.
		extraWidth	: 0		// extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values
                               			// due to slight rounding differences and font-family 
        }).superfish();  			// call supersubs first, then superfish, so that subs are 
                         				// not display:none when measuring. Call before initialising 
                         				// containing tabs for same reason. 
		*/
	/* heder slideshow */	
	 $jts('#slideshow').cycle({
		timeout: <?php echo $sliderTimeout; ?>,  // milliseconds between slide transitions (0 to disable auto advance)
		fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
		pager:   '#pager',  // selector for element to use as pager container
		pause:   0,	  // true to enable "pause on hover"
		pauseOnPagerHover: 0 // true to pause when hovering over pager link
	});
	
	/* function for tab */	
	$jts(".tab-content").hide(); //Hide all content
	$jts("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$jts(".tab-content:first").show(); //Show first tab content
	//On Click Event
	$jts("ul.tabs li").click(function() {
		$jts("ul.tabs li").removeClass("active"); //Remove any "active" class
		$jts(this).addClass("active"); //Add "active" class to selected tab
		$jts(".tab-content").hide(); //Hide all tab content
		var activeTab = $jts(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$jts(activeTab).fadeIn(200); //Fade in the active content
		return false;
	});
	
	/* function for toggle */
	$jts(".toggle_container").hide();
	$jts("h2.trigger").click(function(){
		$jts(this).toggleClass("active").next().slideToggle("slow");
	});

	
	
	/* widget slideshow */
	$jts('.boxslideshow').cycle({
		timeout: 6000,  // milliseconds between slide transitions (0 to disable auto advance)
		fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
		pause:   0,	  // true to enable "pause on hover"
		next:".next",  // selector for element to use as click trigger for next slide 
		prev:".prev",  // selector for element to use as click trigger for previous slide 
		cleartypeNoBg:true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides)
		pauseOnPagerHover: 0
	});
	
	$jts('.boxslideshow2').cycle({
		timeout: 6000,  // milliseconds between slide transitions (0 to disable auto advance)
		fx:      'scrollVert', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
		pause:   0,	  // true to enable "pause on hover"
		next:".next",  // selector for element to use as click trigger for next slide 
		prev:".prev",  // selector for element to use as click trigger for previous slide 
		cleartypeNoBg:true, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides)
		pauseOnPagerHover: 0 // true to pause when hovering over pager link
	});
	
	
	/* contact form agent */
	var contactname 		= $jts("#contact-agent #contactName");
	var contactname2 		= $jts("#contact-agent #contactName2");
	var contactemail 		= $jts("#contact-agent #email");
	var contactcomments 	= $jts("#contact-agent #commentsText");
	var contactemailto 		= $jts("#contact-agent #emailto");
	var contactsubmitted 	= $jts("#contact-agent #submitted");
	var contactltitle		= $jts("#contact-agent #ltitle");

	
	$jts("#contact-agent").submit(function(){
		var errortext = $jts("span.error");
		var returnval = false;
		
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		if(contactname.val()==""){
			errortext.text("<?php _e('Please Enter Your First Name','templatesquare'); ?>");
			contactname.focus();
		}else if(contactname2.val()==""){
			errortext.text("<?php _e('Please Enter Your Last Name', 'templatesquare'); ?>");
			contactname2.focus();
		}else if(contactemail.val()=="" || !emailReg.test(contactemail.val())){
			errortext.text("<?php _e('We need your email address to contact you', 'templatesquare'); ?>");
			contactemail.focus();
		}else if(contactcomments.val()==""){
			errortext.text("<?php _e('Please leave message', 'templatesquare'); ?>");
			contactcomments.focus();
		}else{
			var dataString = "contactName="+ contactname.val() +"&contactName2="+ contactname2.val() +"&email="+ contactemail.val() +"&commentsText="+ contactcomments.val() + "emailto=" + contactemailto.val() + "submitted=" + contactsubmitted.val();
			var dataObj = {
				contactName 	: contactname.val(),
				contactName2 	: contactname2.val(),
				email 			: contactemail.val(),
				commentsText 	: contactcomments.val(),
				emailto 		: contactemailto.val(),
				submitted 		: contactsubmitted.val(),
				ltitle			: contactltitle.val()
			};
			jQuery.ajax({
			  type: "GET",
			  url: "<?php echo get_template_directory_uri(); ?>/includes/property/agentform.php",
			  data: dataObj,
			  success: function(data) {
				$jts("#contact-agent").html("<div id='message'></div>");
				$jts('#message').html("<strong>Contact Form Submitted!</strong>")
				.append("<p>We will be in touch soon.</p>")
				.hide()
				.fadeIn(1500, function() {
				  $jts('#message');
				});
			  }
			});
		}
		
		return false;
	});
	
});
</script>
<!-- ////////////////////////////////// -->
<!-- //      Color Styles       // -->
<!-- ////////////////////////////////// -->
<?php
$topcolor = get_option('templatesquare_topcolor');
$headingtitlecolor = get_option('templatesquare_headingtitlecolor');
$headingcontentcolor = get_option('templatesquare_headingcontentcolor');
$linkcolor = get_option('templatesquare_linkcolor');
echo '
<style type="text/css">
#top-container{ border-top:6px solid '.$topcolor.'}
#nav .current_page_item > a, #nav  .current_page_item > a:hover,
#nav .current_page_parent > a, #nav .current_page_parent > a:hover,
#nav .current-menu-parent > a, #nav .current-menu-parent > a:hover,
#nav .current-menu-item > a, #nav .current-menu-item > a:hover, #nav li > a:hover,.sfHover, .sf-menu li ul,
#nav .current_page_ancestor > a, #nav .current-menu-ancestor > a, #advance-search-grid-property  button,
 .edit-link,  #searchsubmit {background:'.$topcolor.'}
a, a:visited, .colortext, .wp-pagenavi a, .wp-pagenavi a:visited, .wp-pagenavi a:hover,
.wp-pagenavi .pages, .wp-pagenavi .extend {color:'.$linkcolor.'}
a:hover{color:'.$linkcolor.'}
.button, .slider-button a, a.viewAllProperties{background-color:'.$linkcolor.' !important}
h1, h2, h3, h4, h5, h6, .posttitle a, .posttitle a:visited{color:'.$headingcontentcolor.'}
.pagetitle, .widget-title{color:'.$headingtitlecolor.'}
</style>';
?>

<script type="text/javascript" src="http://use.typekit.com/rpm6hbt.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<!--<script type="text/javascript" src="http://use.typekit.com/mfx6agw.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script> -->

</head>
<body <?php body_class($bodyclass); ?>>

	<div id="top-container">
		<div class="centercolumn">
		<div id="header">
			<?php
			$logotype = get_option('templatesquare_logo_type');
			$logoimage =get_option('templatesquare_logo_image'); 
			$sitename = get_option('templatesquare_site_name');
			$tagline = get_option('templatesquare_tagline');
			if($logoimage == ""){ $logoimage = get_stylesheet_directory_uri() . "/images/logo.png"; }
			?>
			<?php if($logotype == 'textlogo'){ ?>
				<div id="logo">
					<?php if($sitename=="" && $tagline==""){?>
						<h1><a href="<?php echo home_url( '/'); ?>" title="<?php _e('Click for Home','templatesquare'); ?>"><?php bloginfo('name'); ?></a></h1><span class="desc"><?php bloginfo('description'); ?></span>
					<?php }else{ ?>
						<h1><a href="<?php echo home_url( '/'); ?>" title="<?php _e('Click for Home','templatesquare'); ?>"><?php echo $sitename; ?></a></h1><span class="desc"><?php echo $tagline; ?></span>
					<?php }?>
				
				</div><!-- end #logo -->
				<?php } else { ?>
				<div id="logo">
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'templatesquare' ) ); ?>" rel="home">
						<img src="<?php echo $logoimage;?>" alt="" />
					</a>
				</div><!-- end #logo -->
			<?php }?>
			<div id="navigation">
				<?php wp_nav_menu( array(
					  'container'       => 'ul', 
					  'menu_class'      => 'sf-menu',
					  'menu_id'         => 'nav', 
					  'depth'           => 0,
					  'sort_column'    => 'menu_order',
					  'fallback_cb'     => 'nav_page_fallback',
					  'theme_location' => 'mainmenu' 
					  )); 
				?>
				<div class="clear"></div><!-- clear float -->
			</div><!-- end #navigation-->
			<div class="clr"></div>
		</div><!-- end #header -->
		</div><!-- end #centercolumn -->
	</div><!-- end #top-container -->
	
	
	<div class="centercolumn">

			<?php 
			
			if(is_front_page()){

                $disableadvancesearch = get_option("templatesquare_disable_advance_search_property");
                if($disableadvancesearch!=true){
                    get_template_part('/includes/property/gridsearch');
                }


                get_template_part('news');

				get_template_part('slider');
			}
			
			?>
