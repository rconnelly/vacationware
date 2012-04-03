add_filter( 'wptouch_post_classes', 'my_custom_post_classes' );

function my_custom_post_classes( $post_classes ) {
	global $post;
	
	// Add the class 'ten' if the page ID is 10
	if ( $post->ID == 10 ) {
		$post_classes[] = 'ten';	
	}

	return $post_classes;	
}