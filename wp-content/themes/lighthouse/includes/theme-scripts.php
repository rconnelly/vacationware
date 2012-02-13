<?php
function my_script() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri().'/js/jquery-1.7.1.min.js', false, '1.7.1');
		wp_enqueue_script('jquery');
		//wp_enqueue_script('cufon-yui', get_template_directory_uri().'/js/cufon-yui.js', array('jquery'));
		//wp_enqueue_script('pt-sans', get_template_directory_uri().'/js/PT_Sans_400.font.js 	', array('jquery'));
		wp_enqueue_script('cycle', get_template_directory_uri().'/js/jquery.cycle.all.min.js', array('jquery'));
        //wp_enqueue_script('jqueryUI', get_template_directory_uri().'/js/jquery-ui-1.8.17.custom.min.js', array('jquery'));

		//wp_enqueue_script('superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'));
		//wp_enqueue_script('supersubs', get_template_directory_uri().'/js/supersubs.js', array('jquery'));
		wp_enqueue_script('hoverIntent', get_template_directory_uri().'/js/hoverIntent.js', array('jquery'));
		
	}
}
add_action('init', 'my_script');
?>