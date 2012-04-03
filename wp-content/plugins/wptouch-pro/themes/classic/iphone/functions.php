<?php

do_action( 'wptouch_functions_start' );

add_action( 'wptouch_theme_init', 'classic_init' );
add_action( 'wptouch_theme_language', 'classic_language' );
add_action( 'wptouch_post_head', 'wptouch_header_style' );
add_filter( 'wptouch_body_classes', 'classic_body_classes' );

// Functions from root-functions.php, don't want them changing the admin queries
add_filter( 'pre_get_posts', 'classic_exclude_categories' );
add_filter( 'pre_get_posts', 'classic_exclude_tags' );
add_filter( 'pre_get_posts', 'classic_search_filter' );

//--Device Theme Functions for Classic --//

function classic_init() {	

	$output_classic_scripts = apply_filters( 'classic_output_scripts', true );

	if ( $output_classic_scripts && !is_admin() ) {
	
		wp_enqueue_script( 'fitvids', WPTOUCH_URL . '/include/js/fitvids.js', array( 'classic-js' ), wptouch_refreshed_files() );

		$minfile = WPTOUCH_DIR . '/themes/classic/iphone/js/theme.min.js';		
		if ( file_exists( $minfile ) ) {
			wp_enqueue_script( 'classic-js', wptouch_get_bloginfo('template_directory') . '/js/classic.min.js', array( 'jquery-form' ), wptouch_refreshed_files() );
		} else {
			wp_enqueue_script( 'classic-js', wptouch_get_bloginfo('template_directory') . '/js/classic.js', array( 'jquery-form' ), wptouch_refreshed_files() );
		}

	if ( show_webapp_notice() ) {
		$minfile = WPTOUCH_DIR . '/include/js/add2home.min.js';		
		if ( file_exists( $minfile ) ) {
			wp_enqueue_script( 'add2home', WPTOUCH_URL . '/include/js/add2home.min.js', array( 'classic-js' ), wptouch_refreshed_files() );
		} else {
			wp_enqueue_script( 'add2home', WPTOUCH_URL . '/include/js/add2home.js', array( 'classic-js' ), wptouch_refreshed_files() );
		}
	}
}
		
function wptouch_header_style() {
	$settings = wptouch_get_settings();
	$header_style = $settings->classic_header_color_style;
	echo "<link rel='stylesheet' type='text/css' href='" . wptouch_get_bloginfo('template_directory') . "/css/". $header_style .".css?ver=" . wptouch_refreshed_files() . "' /> \n";		
}

} //init

function classic_language( $locale ) {
	// In a normal theme a language file would be loaded here for text translation
}

function classic_body_classes( $body_classes ) {
	$settings = wptouch_get_settings();
	
	$is_idevice = strpos( $_SERVER['HTTP_USER_AGENT'],'iPad' ) || strpos($_SERVER['HTTP_USER_AGENT'],'iPhone' ) || strpos($_SERVER['HTTP_USER_AGENT'],'iPod' );
	
	$is_ios5 = strpos( $_SERVER['HTTP_USER_AGENT'],'OS 5_' );

	$body_classes[] = $settings->classic_icon_type;
	
	$body_classes[] = $settings->classic_header_color_style;

	$body_classes[] = $settings->classic_calendar_icon_bg;

	$body_classes[] = $settings->classic_show_excerpts;
	
	$body_classes[] = $settings->classic_text_justification;

	if ( $settings->classic_webapp_use_ajax ) {
		$body_classes[] = 'ajax-on';
	}

	if ( !$settings->enable_menu_icons ) {
		$body_classes[] = 'no-icons';
	}

	if ( $settings->classic_hide_addressbar ) {
		$body_classes[] = 'hide-addressbar';
	}

//	if ( $settings->make_menu_relative ) {
//		$body_classes[] = 'relative-menu';
//	}
	
	if ( $settings->classic_webapp_status_bar_color == 'black-translucent' ) {
		$body_classes[] = $settings->classic_webapp_status_bar_color;
	}

	if ( $is_idevice ) {
		$body_classes[] = 'idevice';
	} else {
		$body_classes[] = 'generic';
	}

	if ( $is_idevice && $is_ios5 ) {
		$body_classes[] = 'ios5';
	}

	if ( $settings->classic_enable_persistent ) {
		$body_classes[] = 'loadsaved';
	}

	return $body_classes;
}

// New logo code
function classic_mobile_has_logo() {
	$settings = wptouch_get_settings();
		if ( $settings->classic_header_img_location || $settings->classic_retina_header_img_location ) {
			return true;
		} else {
			return false;
		}
}

function classic_has_header_retina_image() {
	$settings = wptouch_get_settings();
	
	return apply_filters( 'classic_has_header_retina_image', ( $settings->classic_retina_header_img_location && strlen( $settings->classic_retina_header_img_location ) ) );
}

function classic_get_header_image_location() {
	$settings = wptouch_get_settings();
	
	if ( classic_has_header_retina_image() ) {
		return apply_filters( 'classic_header_image_location', $settings->classic_retina_header_img_location );
	} else {
		return apply_filters( 'classic_header_image_location', $settings->classic_header_img_location );
	}
}

function classic_mobile_logo_img() {
	if ( classic_has_header_retina_image() ) {
		echo "<img id='retina-custom-logo' src='" . classic_get_header_image_location() . "' alt='retina-logo-image' /> \n";
	} else {
		echo "<img id='custom-logo' src='" . classic_get_header_image_location() . "' alt='logo-image' /> \n";
	}
}

function classic_background() {
	$settings = wptouch_get_settings();
	return $settings->classic_background_image;
}

function classic_mobile_show_site_icon() {
	$settings = wptouch_get_settings();
		if ( $settings->classic_show_header_icon ) {
			return true;
		} else {
			return false;		
		}
}

function classic_mobile_has_menu_icon() {
	$settings = wptouch_get_settings();
	
	if ( $settings->classic_use_menu_icon ) {
		return true;
	} else {
		return false;
	}
}

function classic_mobile_first_full_post() {
	$settings = wptouch_get_settings();
	if ( $settings->classic_show_excerpts == 'first-full-hidden' || $settings->classic_show_excerpts == 'first-full-shown' ) {
		return true;
	} else {
		return false;
	}
}

function classic_mobile_show_all_full_post() {
	$settings = wptouch_get_settings();
	if ( $settings->classic_show_excerpts == 'full-hidden' || $settings->classic_show_excerpts == 'full-shown' ) {
		return true;
	} else {
		return false;
	}
}

function classic_mobile_excerpts_open() {
	$settings = wptouch_get_settings();
	if ( $settings->classic_show_excerpts == 'excerpts-shown' || $settings->classic_show_excerpts == 'first-full-shown' ) {
		return true;
	} else {
		return false;
	}
}

function classic_mobile_hide_responses() {
	$settings = wptouch_get_settings();
	return $settings->classic_hide_responses;
}

function classic_mobile_show_search_button() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_search;
}

function classic_mobile_show_categories_tab() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_categories;
}

function classic_mobile_show_tags_tab() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_tags;
}

function classic_mobile_show_wordtwit_button() {
	$settings = wptouch_get_settings();
	if ( $settings->classic_show_wordtwit && class_exists( 'WordTwitPro' ) ) {
		return true;
	}
}

function classic_mobile_com_toggle() {
	if ( !function_exists( 'id_activate_hooks' ) || !function_exists( 'dsq_is_installed' ) ) {
		$comment_string1 = __( 'No Comments Yet', "wptouch-pro" );
		$comment_string2 = __( '1 Comment', "wptouch-pro" );
		$comment_string3 = __( '% Comments', "wptouch-pro" );

		echo '<a id="comments-' . get_the_ID() . '" class="post no-ajax rounded-corners-8px com-toggle">';

		if ( classic_mobile_hide_responses() ) {
			echo '<img id="com-arrow" class="com-arrow" src="' . wptouch_get_bloginfo('template_directory') . '/images/com_arrow.png" alt="arrow" />';
		} else {
			echo '<img id="com-arrow" class="com-arrow-down" src="' . wptouch_get_bloginfo('template_directory') . '/images/com_arrow.png" alt="arrow" />';	
		}
		comments_number( $comment_string1, $comment_string2, $comment_string3 );
		echo '</a>';
	}
}

// Custom Comments
// Custom callback to list comments in the your-theme style
function classic_custom_comments( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ] = $comment;
	$GLOBALS[ 'comment_depth' ] = $depth;
  ?>
   <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
    <div class="comment-top">
    	<?php classic_commenter_link() ?>
    	<div class="comment-meta">
	    	<?php printf( __( '%1$s - %2$s <span class="meta-sep"></span>', "wptouch-pro" ),
				get_comment_date( 'M d' ), 
				get_comment_time() ); 
			?>
    	</div>
    	<div class="comment-buttons">
	    	<?php edit_comment_link( __( 'Edit', "wptouch-pro" ), ' <span class="edit-link">', '</span>' ); ?>
		<?php if ( !class_exists( 'wp_thread_comment' ) ) // echo the comment reply link
			if( $args[ 'type' ] == 'all' || get_comment_type() == 'comment' ) : comment_reply_link( 
				array_merge( 
					$args, array(
						'reply_text' => __( 'Reply',"wptouch-pro" ),
						'login_text' => __( 'Reply.',"wptouch-pro" ),
						'depth' => $depth
					)
				) 
			);
			endif; ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) __( "<span class='unapproved'>Your comment is awaiting moderation.</span>", "wptouch-pro" ) ?>
	</div>

	<div class="comment-content">
		<?php comment_text() ?>
	</div>

<?php } // end custom_comments

// Produces an avatar image with the hCard-compliant photo class
function classic_commenter_link() {
	$commenter = get_comment_author_link();
	if ( preg_match( '/<a[^>]* class=[^>]+>/', $commenter ) ) {
		$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
	} else {
		$commenter = preg_replace( '/(<a )/', '\\1class="url "/' , $commenter );
	}

	$avatar_email = get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 68 ) );
	echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link
