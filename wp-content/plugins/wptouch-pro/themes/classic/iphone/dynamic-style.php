<?php 	/* This file generates CSS for Classic based on style options chosen in the settings */

	$settings = wptouch_get_settings(); 
	$head_bg_shade = 					$settings->classic_header_shading_style;
	$head_font =							$settings->classic_header_font;
	$head_font_size = 					$settings->classic_header_title_font_size;
	$head_color = 							$settings->classic_header_color_style;

	$gen_font = 							$settings->classic_general_font;
	$gen_font_size = 						$settings->classic_general_font_size;
	$gen_font_color =					$settings->classic_general_font_color;

	$post_title_font = 					$settings->classic_post_title_font;
	$post_title_font_size = 			$settings->classic_post_title_font_size;
	$post_title_color = 					$settings->classic_post_title_font_color;

	$post_body_font = 					$settings->classic_post_body_font;
	$post_body_font_size = 			$settings->classic_post_body_font_size;

	$link_color =							$settings->classic_link_color;
	$context_headers_color = 		$settings->classic_context_headers_color;
	$footer_text_color = 				$settings->classic_footer_text_color;
	$background_image = 				$settings->classic_background_image;
	$custom_background =			$settings->classic_custom_background_image;
	$classic_background_repeat =	$settings->classic_background_repeat;
	$classic_background_color =	$settings->classic_background_color;
	$text_drop_shade =					$settings->classic_text_shade_color;
	$custom_cal_color =					$settings->classic_custom_cal_icon_color;
	$calendar = 								$settings->classic_icon_type == 'calendar';
?>

body { 
	font: <?php echo $gen_font_size ?> "<?php echo $gen_font ?>", Helvetica, Geneva, Arial, sans-serif;
	color: #<?php echo $gen_font_color ?>;
	<?php if ( $settings->classic_custom_background_image ) { ?>
		background: #<?php echo $classic_background_color; ?> url( <?php echo $custom_background; ?> ) <?php echo $classic_background_repeat; ?> 0 0;
	<?php } elseif ( $settings->classic_background_image != 'none' ) { ?>
		background: #<?php echo $classic_background_color; ?> url( <?php wptouch_bloginfo( 'template_directory' ); ?>/images/backgrounds/<?php echo $background_image; ?>.png ) repeat 0 0; 
	<?php } else { ?>
		background-color: #<?php echo $classic_background_color; ?>; 
	<?php } ?>
}

#header { 
<?php if ( $settings->classic_header_shading_style != 'none' ) { ?>
	background-image: url(<?php wptouch_bloginfo( 'template_directory' ); ?>/images/<?php echo $head_bg_shade ?>.png); 
<?php } ?>
	font: <?php echo $head_font_size ?> "<?php echo $head_font ?>", Helvetica, Geneva, Arial, sans-serif;
}

a, .off.active, .on.active { color: #<?php echo $link_color ?>; }

.post h2, .post h2 a { color: #<?php echo $post_title_color ?>; font: <?php echo $post_title_font_size ?> "<?php echo $post_title_font ?>", Helvetica, Geneva, Arial, sans-serif; }

#content .content, #content .page .content, #content .post.single { font: <?php echo $post_body_font_size ?> "<?php echo $post_body_font ?>", Helvetica, Geneva, Arial, sans-serif; }

#respond h3,
p.nocomments,
#respond p,
form#commentform p,
#loading p,
form#commentform label,
.archive-text,
.linkcat h2,
h2.wptouch-archives,
h2.iphone-list,
ul.iphone-list li span {
	color: #<?php echo $context_headers_color ?>;
<?php if ( $text_drop_shade = 'light' ) { ?>
	text-shadow: #fff 0 1px 0;
<?php } else { ?>
	text-shadow: #000 0 -1px 0;
<?php } ?>
}

#respond h3,
p.nocomments,
#respond p,
form#commentform p,
#loading p,
form#commentform label,
.archive-text,
.linkcat h2,
h2.wptouch-archives,
h2.iphone-list,
.load-more-link,
ul.iphone-list li span, 
.footer {
<?php if ( $settings->classic_text_shade_color == 'light' ) { ?>
	text-shadow: #fff 0 1px 0;
<?php } else { ?>
	text-shadow: #000 0 -1px 1px;
<?php } ?>
}

<?php if ( $calendar && $settings->classic_calendar_icon_bg == 'cal-colors' ) { ?>

.cal-colors .cal-month.m-1 {
	background-color: #767c8f;
}

.cal-colors .cal-month.m-2 {
	background-color: #345abe;
}

.cal-colors .cal-month.m-3 {
	background-color: #37838d;
}

.cal-colors .cal-month.m-4 {
	background-color: #55b06c;
}

.cal-colors .cal-month.m-5 {
	background-color: #409ad5;
}

.cal-colors .cal-month.m-6 {
	background-color: #be63c5;
}

.cal-colors .cal-month.m-7 {
	background-color: #f79445;
}

.cal-colors .cal-month.m-8 {
	background-color: #4e1e00;
}

.cal-colors .cal-month.m-9 {
	background-color: #a04262;
}

.cal-colors .cal-month.m-10 {
	background-color: #284461;
}

.cal-colors .cal-month.m-11 {
	background-color: #4d1d77;
}

.cal-colors .cal-month.m-12 {
	background-color: #af1919;
}

<?php } elseif ( $calendar && $settings->classic_calendar_icon_bg == 'cal-blue' ) { ?>
.cal-blue .cal-month {
	background-color: #3f7fd8;
}
<?php } elseif ( $calendar && $settings->classic_calendar_icon_bg == 'cal-ltg' ) { ?>
.cal-ltg .cal-month {
	background-color: #888;
}
<?php } elseif ( $calendar && $settings->classic_calendar_icon_bg == 'cal-dkg' ) { ?>
.cal-dkg .cal-month {
	background-color: #444;
}
<?php } elseif ( $calendar && $settings->classic_calendar_icon_bg == 'cal-custom' ) { ?>
.cal-custom .cal-month { background-color: #<?php echo $custom_cal_color ?>; }
<?php } ?>

.footer { color: #<?php echo $footer_text_color ?>; }