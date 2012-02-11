<?php
/* filter shortcode for widget */
add_filter( 'widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

add_action( 'after_setup_theme', 'ts_setup' );

if ( ! function_exists( 'ts_setup' ) ):

function ts_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'blog-post-thumbnail', 290, 90, true ); // Blog Thumbnail
		add_image_size( 'property-slider-home', 518, 360, true ); // Property Slider
		add_image_size( 'slider-home', 518, 360, true ); // Slider Homepage
		add_image_size( 'property-grid', 185, 120, true ); // Property Grid
		add_image_size( 'property-grid-2', 248, 160, true ); // Property Grid 2 col
		add_image_size( 'property-list', 130, 85, true ); // Property List
		add_image_size( 'property-gallery', 620, 360, true ); // Property Gallery
		add_image_size( 'property-gallery-thumb', 100, 60, true ); // Property Gallery Thumb
		add_image_size( 'property-agent-listing-widget', 300, 178, true ); // Property Agent Listing Widget

	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'mainmenu' => __( 'Main Menu', 'templatesquare' ),
	) );
	global $themename, $shortname, $optionstheme;
	  foreach ($optionstheme as $value) {
        if(isset($value['std']))
		   add_option( $value['id'],  $value['std'] ); }
}
endif;

/* Slider */
function ts_post_type_slider() {
	register_post_type( 'slider',
                array( 
				'label' => __('Slider'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 5,
				'supports' => array(
				                     'title',
									 'custom-fields',
									 'excerpt',
                                     'thumbnail')
					) 
				);
}

add_action('init', 'ts_post_type_slider');
?>
