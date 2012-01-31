<?php
/**
 * Plugin Name: Twitter Profile Field
 * Plugin URI: http://jayj.dk/template/plugins/twitter-profile-field/
 * Description: Adds an additional field to the user profile page where they can enter their Twitter username.
 * Author: Jesper J
 * Author URI: http://jayj.dk
 * Version: 1.4

	Usage:
	  * If you use it inside the loop just add <?php the_author_meta( 'twitter' ); ?> to show the username.
	  * If it's outside the loop use <?php the_author_meta( 'twitter', 1 ); ?>, where 1 is the User ID

	Shortcode usage:
	You can use shortcodes to display your Twitter username in posts, pages and text widgets. 
	  * [twitter-user] will display the username without any markup
	  * [twitter-user link="yes"] will display the username with a link to your Twitter Profile (<a href="http://twitter.com/%username%">%Username%</a>)
	  * [twitter-user link="yes" title="Title tag content here"] will add the text to links title tag 
	  * [twitter-user userid="5"] will display the username for the user with an ID of 5
*/

/**
 * Add field to the profile
 */
function tpf_twitter_field( $contactmethods ) {
	$contactmethods['twitter'] = 'Twitter username';
	return $contactmethods;
}

add_filter( 'user_contactmethods', 'tpf_twitter_field' );

/*
 * Create shortcode
 */
function tpf_twitter_field_shortcode( $atts ) {  
	extract( shortcode_atts( array(   
		'link' => '', // Any value will display the link
		'title' => '',
		'userid' => ''
	), $atts) );
	
	if ( ! empty( $link ) )
		return '<a href="http://twitter.com/' . get_the_author_meta( 'twitter', $userid ) . '" title="' . esc_attr( $title ) . '" class="twitter-profile">' . get_the_author_meta( 'twitter', $userid ) . '</a>'; 
	else
		return get_the_author_meta( 'twitter', $userid );  
} 

add_shortcode( 'twitter-user', 'tpf_twitter_field_shortcode' );
add_filter( 'widget_text', 'do_shortcode' ); // Allows you to use the shortcode in text widgets 
add_filter( 'widget_text', 'shortcode_unautop' ); // Don't wrap shortcode in <p> tags

/*
 * Dashboard widget
 */
function tpf_twitter_field_dashwidget() { ?>
	<style type="text/css" media="screen">
		.twitter_field  {
			border-bottom: 1px solid #dfdfdf;
			margin-bottom: 15px;
			padding-bottom: 5px;
		}
    </style>
    
    <div class="twitter_field">
        <strong>How to use Twitter Profile Field in Posts, Pages and Text Widgets:</strong>
        <p>If you want to display your Twitter Username using shortcodes in Posts, Pages and Text Widgets use the following code:
        <code>[twitter-user]</code></p>
        <p>If you want to display it with a link to your profile, use <code>[twitter-user link="yes"]</code></p>
        <p>If you want to add a title tag to the link, use <code>[twitter-user link="yes" title="Title tag content here"]</code></p>
        <p>If you want to change the which user you display the name for, use <code>[twitter-user userid="2"]</code> where 2 is the user ID</p>
    </div>  
    
    <div> 
        <strong>How to use Twitter Profile Field in Template files:</strong>
        <p>If you want to display your Twitter Username in your Template files use the following code:
        <code>&#8249;?php the_author_meta( 'twitter' ); ?></code></p>
        <p>If you want to display it outside the loop, use: <code>&#8249;?php the_author_meta( 'twitter', 1 ); ?></code> where 1 is the user ID</p>
    </div>
<?php }

function tpf_twitter_field_dashboard_widget() {
	wp_add_dashboard_widget( 'tpf_twitter_field_dashwidget', 'Twitter Profile Field', 'tpf_twitter_field_dashwidget' );
}

add_action( 'wp_dashboard_setup', 'tpf_twitter_field_dashboard_widget' );

?>