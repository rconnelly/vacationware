<?php

// Paginated Comments plugin
remove_action( 'init', 'Paginated_Comments_init' );
remove_action( 'admin_menu', 'Paginated_Comments_menu_add' );
remove_action( 'template_redirect', 'Paginated_Comments_alter_source', 15 );
remove_action( 'wp_head', 'Paginated_Comments_heads' );
remove_filter( 'comment_post_redirect', 'Paginated_Comments_redirect_location', 1, 2 );

// qTranslate
if ( function_exists( 'qtrans_useCurrentLanguageIfNotFoundShowAvailable' ) ) {
	add_filter( 'wptouch_menu_item_title', 'qtrans_useCurrentLanguageIfNotFoundShowAvailable', 0 );	
}

// Facebook Like button
remove_filter('the_content', 'Add_Like_Button');

//Sharebar Plugin
remove_filter('the_content', 'sharebar_auto');
remove_action('wp_head', 'sharebar_header');

// Hyper Cache

if ( function_exists( 'hyper_activate' ) ) {
	global $hyper_cache_stop;
}

// Disqus
remove_filter( 'comments_number', 'dsq_comments_number' );

