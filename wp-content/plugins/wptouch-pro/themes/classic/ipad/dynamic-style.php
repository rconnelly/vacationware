<?php 	/* This file generates CSS for Classic on iPad based on style options chosen in the Mobile settings + iPad theme settings */ ?>
<?php 
	$settings = wptouch_get_settings(); 
	$gen_font = 						$settings->classic_ipad_general_font;
	$gen_font_size = 					$settings->classic_ipad_general_font_size;
	$gen_font_color =				$settings->classic_ipad_general_font_color;

	$post_title_font_size = 		$settings->classic_ipad_post_title_font_size;
	$post_title_font = 				$settings->classic_ipad_post_title_font;
	$post_title_color = 				$settings->classic_ipad_post_title_font_color;

	$post_body_font_size = 		$settings->classic_ipad_post_body_font_size;
	$post_body_font = 				$settings->classic_ipad_post_body_font;

	$background_image = 				$settings->classic_ipad_content_bg;
	$custom_background =			$settings->classic_ipad_content_bg_custom;
	$classic_background_repeat =	$settings->classic_ipad_background_repeat;
	$sidebar_bg_image = 				$settings->classic_ipad_sidebar_bg;
	$custom_sidebar_bg = 			$settings->classic_ipad_sidebar_bg_custom;

	$link_color =						$settings->classic_ipad_link_color;
	$active_link_color =				$settings->classic_ipad_active_link_color;
	$context_headers_color = 	$settings->classic_ipad_context_headers_color;
	$footer_text_color = 			$settings->classic_ipad_footer_text_color;
	$text_drop_shade =				$settings->classic_ipad_text_shade_color;
	$custom_cal_color =				$settings->classic_custom_cal_icon_color;
?>

body { 
	font: <?php echo $gen_font_size ?> "<?php echo $gen_font ?>", Helvetica, Geneva, Arial, sans-serif;
	color: #<?php echo $gen_font_color ?>;
<?php if ( $custom_background ) { ?>
	background: url( <?php echo $custom_background; ?> ) <?php echo $classic_background_repeat; ?> 0 0; 
<?php } else { ?>
	background: url( <?php wptouch_bloginfo( 'template_directory' ); ?>/images/backgrounds/<?php echo $background_image; ?>.png ) repeat 0 0; 
<?php } ?>
}

#main-menu {
<?php if ( $custom_sidebar_bg ) { ?>
	background: url( <?php echo $custom_sidebar_bg; ?> ) repeat 0 0; 
<?php } else { ?>
	background: url( <?php wptouch_bloginfo( 'template_directory' ); ?>/images/backgrounds/<?php echo $sidebar_bg_image; ?>.png ) repeat 0 0; 
<?php } ?>
}

input {
	font: <?php echo $gen_font_size ?> "<?php echo $gen_font ?>", Helvetica, Geneva, Arial, sans-serif;
}

a, #switch span.active { color: #<?php echo $link_color ?>; }

.content a.active, #content .title-area a.active, .footer a.active, #switch a.active {
	color: #<?php echo $active_link_color ?>;
}

.post h2, .post a.h2 { 
	color: #<?php echo $post_title_color ?>;
	font: <?php echo $post_title_font_size ?> "<?php echo $post_title_font ?>", Helvetica, Geneva, Arial, sans-serif !important;
}

#content .content, #content .page .content, #content .post.single .content, #content .post.not-single.not-page p {
	font: <?php echo $post_body_font_size ?> "<?php echo $post_body_font ?>", sans-serif;
}

#respond h3,
p.nocomments,
#respond p,
form#commentform p,
.archive-text,
.linkcat h2,
h2.wptouch-archives,
h2.iphone-list,
ul.iphone-list li span, 
.footer {
<?php if ( $settings->classic_ipad_text_shade_color == 'light' ) { ?>
	text-shadow: #fff 0 1px 0;
<?php } else { ?>
	text-shadow: #000 0 -1px 1px;
<?php } ?>
	color: #<?php echo $context_headers_color; ?>;
}

.cal-custom .cal-month { background-color: #<?php echo $custom_cal_color ?>; }

.footer { color: #<?php echo $footer_text_color ?>; }