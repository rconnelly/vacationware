<?php

//-- Theme Filters --//

add_action( 'wptouch_theme_init', 'wptouch_theme_init' );
add_action( 'wptouch_theme_language', 'wptouch_theme_language' );
add_filter( 'wptouch_body_classes', 'wptouch_theme_body_classes' );
add_action( 'wptouch_post_head', 'wptouch_theme_compat_css' );
add_action( 'wptouch_post_head', 'wptouch_theme_iphone_meta' );

//--Device Theme Functions for Skeleton --//

function wptouch_theme_init() {
	wp_enqueue_script( 'wptouch_theme-js', wptouch_get_bloginfo('template_directory') . '/theme.js', array('jquery'), wptouch_refreshed_files() );
}

function wptouch_theme_compat_css() {
	$settings = wptouch_get_settings();
	if ( $settings->wptouch_theme_use_compat_css ) {
		echo "<link rel='stylesheet' type='text/css' href='" .WPTOUCH_URL . "/include/css/compat.css?ver=" . wptouch_refreshed_files() . "' /> \n";		
	}
}

function wptouch_theme_language( $locale ) {
	// In a normal theme a language file would be loaded here
	// for text translation
}

// This spits out all the meta tags fopr iPhone/iPod touch/iPad stuff 
// (web-app, startup img, device width, status bar style)
function wptouch_theme_iphone_meta() {
	$settings = wptouch_get_settings();
	$status_type = $settings->wptouch_theme_webapp_status_bar_color;

	echo "<meta name='apple-mobile-web-app-capable' content='yes' /> \n";
	echo "<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' /> \n";
	echo "<meta name='apple-mobile-web-app-status-bar-style' content='" . $status_type . "' /> \n";	

	if ( $settings->wptouch_theme_webapp_use_loading_img ) {
		echo "<link rel='apple-touch-startup-image' href='" . wptouch_get_bloginfo('template_directory') . "/images/startup.png' /> \n";
	} 
}

// Add background image name and post icon type for styling diffs
function wptouch_theme_body_classes( $body_classes ) {
	$settings = wptouch_get_settings();
	$is_idevice = strstr( $_SERVER['HTTP_USER_AGENT'],'iPad') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod' );
	
	// Add the wptouch_theme background image as a body class
	$body_classes[] = $settings->wptouch_theme_background_image;
	$body_classes[] = $settings->wptouch_theme_icon_type;
	if ( $settings->wptouch_theme_webapp_status_bar_color == 'black-translucent' ) {
		$body_classes[] = $settings->wptouch_theme_webapp_status_bar_color;
	}

	if ( $is_idevice ) {
		$body_classes[] = 'idevice';
	}		
	
	return $body_classes;
}

// Previous + Next Post Functions For Single Post Pages
function wptouch_theme_get_previous_post_link() {
	$prev_post = get_previous_post(); 
	if ( $prev_post ) {
		$prev_post = get_previous_post( false ); 
		$prev_url = get_permalink( $prev_post->ID ); 
//		echo '<a href="#" rel="' . $prev_url . '" class="nav-back ajax-link">' . __( "Back", "wptouch-pro" ) . '</a>'; <- playing with ajax
		echo '<a href="' . $prev_url . '" class="nav-back ajax-link">' . __( "Back", "wptouch-pro" ) . '</a>';
	}
}

function wptouch_theme_get_next_post_link() {
	$next_post = get_next_post(); 
	if ( $next_post ) {
		$next_post = get_next_post( false );
		$next_url = get_permalink( $next_post->ID ); 
//		echo '<a href="#" rel="' . $next_url . '" class="nav-fwd ajax-link">'. __( "Next", "wptouch-pro" ) . '</a>'; <- playing with ajax
		echo '<a href="' . $next_url . '" class="nav-fwd ajax-link">'. __( "Next", "wptouch-pro" ) . '</a>';
	}
}

// Dynamic archives heading text for archive result pages, and search
function wptouch_theme_archive_text() {
	if ( !is_home() ) {
		echo '<div class="archive-text">';
	}
	if ( is_search() ) {
		echo sprintf( __( "Search results &rsaquo; %s", "wptouch-pro" ), get_search_query() );
	} if ( is_category() ) {
		echo sprintf( __( "Categories &rsaquo; %s", "wptouch-pro" ), single_cat_title( "", false ) );
	} elseif ( is_tag() ) {
		echo sprintf( __( "Tags &rsaquo; %s", "wptouch-pro" ), single_tag_title(" ", false ) );
	} elseif ( is_day() ) {
		echo sprintf( __( "Archives &rsaquo; %s", "wptouch-pro" ),  get_the_time( 'F jS, Y' ) );
	} elseif ( is_month() ) {
		echo sprintf( __( "Archives &rsaquo; %s", "wptouch-pro" ),  get_the_time( 'F, Y' ) );
	} elseif ( is_year() ) {
		echo sprintf( __( "Archives &rsaquo; %s", "wptouch-pro" ),  get_the_time( 'Y' ) );
	} elseif ( is_404() ) {
		echo( __( "404 Not Found", "wptouch-pro" ) );
	}
	if ( !is_home() ) {
		echo '</div>';
	}
}

// If Ajax load more is turned off, this shows
function wptouch_theme_archive_navigation_back() {
	if ( is_search() ) {
		previous_posts_link( __( 'Back in Search', "wptouch-pro" ) );
	} elseif ( is_category() ) {
		previous_posts_link( __( 'Back in Category', "wptouch-pro" ) );
	} elseif ( is_tag() ) {
		previous_posts_link( __( 'Back in Tag', "wptouch-pro" ) );
	} elseif ( is_day() ) {
		previous_posts_link( __( 'Back One Day', "wptouch-pro" ) );
	} elseif ( is_month() ) {
		previous_posts_link( __( 'Back One Month', "wptouch-pro" ) );
	} elseif ( is_year() ) {
		previous_posts_link( __( 'Back One Year', "wptouch-pro" ) );
	}
}

// If Ajax load more is turned off, this shows
function wptouch_theme_archive_navigation_next() {
	if ( is_search() ) {
		next_posts_link( __( 'Next in Search', "wptouch-pro" ) );
	} elseif ( is_category() ) {		  
		next_posts_link( __( 'Next in Category', "wptouch-pro" ) );
	} elseif ( is_tag() ) {
		next_posts_link( __( 'Next in Tag', "wptouch-pro" ) );
	} elseif ( is_day() ) {
		next_posts_link( __( 'Next One Day', "wptouch-pro" ) );
	} elseif ( is_month() ) {
		next_posts_link( __( 'Next One Month', "wptouch-pro" ) );
	} elseif ( is_year() ) {
		next_posts_link( __( 'Next One Year', "wptouch-pro" ) );
	}
}

function wptouch_theme_wp_comments_nav_on() {
	if ( get_option( 'page_comments' ) ) {
		return true;
	} else {
		return false;
	}
}

function wptouch_theme_show_comments_on_pages() {
	$settings = wptouch_get_settings();
	if ( comments_open() ) {
		return $settings->wptouch_theme_show_comments_on_pages;
	} else {
		return false;
	}
}

function wptouch_theme_is_ajax_enabled() {
	$settings = wptouch_get_settings();
	return $settings->wptouch_theme_ajax_mode_enabled;
}

function wptouch_theme_use_calendar_icons() {
	$settings = wptouch_get_settings();
	return $settings->wptouch_theme_icon_type == 'calendar';
}

function wptouch_theme_use_thumbnail_icons() {
	$settings = wptouch_get_settings();
	return $settings->wptouch_theme_icon_type == 'thumbnails';
}

function wptouch_theme_background() {
	$settings = wptouch_get_settings();
	return $settings->wptouch_theme_background_image;
}

function wptouch_theme_show_categories_tab() {
	$settings = wptouch_get_settings();
	return $settings->wptouch_theme_show_categories;
}

function wptouch_theme_show_tags_tab() {
	$settings = wptouch_get_settings();
	return $settings->wptouch_theme_show_tags;
}

// Check what order comments are displayed, governs whether 'load more comments' link uses previous_ or next_ function
function wptouch_theme_comments_newer() {
if ( get_option( 'default_comments_page' ) == 'newest' ) {
		return true;
	} else {
		return false;
	}
}