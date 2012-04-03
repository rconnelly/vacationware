<?php
add_action( 'wptouch_theme_init', 'classic_theme_initialization' );

add_action( 'wptouch_post_head', 'classic_iphone_meta' );
add_action( 'wptouch_ajax_instapaper', 'classic_instapaper' );
add_action( 'wptouch_post_head', 'classic_compat_css' );

add_filter( 'wptouch_custom_templates', 'classic_custom_templates' );

add_filter( 'wptouch_localize_scripts', 'classic_localize_scripts' );
add_filter( 'wptouch_setting_filter_classic_custom_user_agents', 'classic_user_agent_filter' );

add_filter( 'wptouch_has_post_thumbnail', 'classic_has_post_thumbnail' );
add_filter( 'wptouch_the_post_thumbnail', 'classic_the_post_thumbnail' );
add_filter( 'wptouch_the_content', 'classic_show_attached_image_filter' );	

add_filter( 'wptouch_body_classes', 'classic_global_body_classes' );


add_filter( 'wptouch_create_thumbnails', 'classic_should_create_thumbnails' );

/* Global Functions For Classic Mobile + iPad */
function classic_theme_initialization() {

	if ( !is_admin() ) {
		wp_enqueue_script( 'jquery' );
		wptouch_persisitence_mode();
	/* Un-comment and reload to delete all theme cookies */
	//wptouch_classic_delete_cookie();

	}
}

function classic_global_body_classes( $global_body_classes ) {
	global $wptouch_pro;
	if ( $wptouch_pro->locale ) {
		$global_body_classes[] = 'locale-' . strtolower( $wptouch_pro->locale );'';

		if ( $wptouch_pro->locale != 'en_US' ) {
			$global_body_classes[] = 'translated';
		}
	}

	return $global_body_classes;
}

function classic_should_create_thumbnails( $create_thumbnails ) {
        $settings = wptouch_get_settings();     
        
        return ( $settings->classic_icon_type == 'thumbnails' );
}


// Eat all the cookies for lunch
function wptouch_classic_delete_cookie() {
	if ( isset( $_SERVER['HTTP_COOKIE'] ) ) {
	    $cookies = explode( ';', $_SERVER['HTTP_COOKIE'] );
		$url_path = str_replace( array( 'http://' . $_SERVER['SERVER_NAME'] . '','https://' . $_SERVER['SERVER_NAME'] . '' ), '', wptouch_get_bloginfo( 'url' ) . '/' );
	    foreach( $cookies as $cookie ) {
	        $parts = explode( '=', $cookie );
	        $name = trim( $parts[0] );
	        setcookie( $name, '', time()-1000 );
	        setcookie( $name, '', time()-1000, $url_path );
	    }
	}
}

function wptouch_persisitence_mode() {
 if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'iPhone' ) || strpos( $_SERVER['HTTP_USER_AGENT'], 'iPod' ) || strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' ) ) {
	$settings = wptouch_get_settings();
		if ( $settings->classic_enable_persistent && defined( 'WP_USE_THEMES' ) && !is_admin() ) {
			if ( isset( $_COOKIE['wptouch-load-last-url'] ) && !isset( $_COOKIE['web-app-mode'] ) && strpos( $_SERVER['HTTP_USER_AGENT'], 'Safari/' ) === false ) {
				$saved_url = $_COOKIE['wptouch-load-last-url'];
				$time = time()+60*60*24*365;
				$url_path = str_replace( array( 'http://' . $_SERVER['SERVER_NAME'] . '','https://' . $_SERVER['SERVER_NAME'] . '' ), '', get_bloginfo( 'url' ) . '/' );
				setcookie( 'web-app-mode', 'on', 0, $url_path );
				if ( $saved_url && ( $saved_url != $_SERVER['REQUEST_URI'] ) ) {
					header( 'Location: ' . $saved_url );
					die;
				}
			}
		}
	}
}

function classic_is_web_app_mode(){
	if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Safari/' ) === false && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'iPhone' ) || strpos( $_SERVER['HTTP_USER_AGENT'], 'iPod' ) || strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' ) ) ) {
		return true;
	} else {
		return false;
	}
}

function classic_compat_css() {
	$settings = wptouch_get_settings();
	if ( $settings->classic_use_compat_css ) {
		echo "<link rel='stylesheet' type='text/css' href='" .WPTOUCH_URL . "/include/css/compat.css?ver=" . wptouch_refreshed_files() . "' /> \n";		
	}
}

// This spits out all the meta tags for iPhone/iPod touch/iPad stuff 
// (web-app, startup img, device width, status bar style)
function classic_iphone_meta() {
	global $wptouch_pro;
	$ipad = ( $wptouch_pro->active_device_class == 'ipad' );
	$is_ios5 = strpos( $_SERVER['HTTP_USER_AGENT'],'OS 5_' );
	$settings = wptouch_get_settings();

	if ( $ipad ) {	
		$status_type = 'default';
	} else {
		$status_type = $settings->classic_webapp_status_bar_color;	
	}
	
	// lock the viewport as 1:1, no zooming, unless enabled for mobile
	if ( $ipad || !classic_mobile_enable_zoom() ) {	
		echo "<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' /> \n";
	} else {
		echo "<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes' /> \n";
	}
	
	if ( $settings->classic_webapp_enabled ) {
		echo "<meta name='apple-mobile-web-app-status-bar-style' content='" . $status_type . "' /> \n";	
		echo "<meta name='apple-mobile-web-app-capable' content='yes' /> \n";
	}

	if ( $settings->classic_webapp_use_loading_img ) {
	// iPhone
		if ( !$ipad ) {	
			if ( $settings->classic_webapp_loading_img_location ) {
				echo "<link rel='apple-touch-startup-image' href='" . $settings->classic_webapp_loading_img_location . "' /> \n";
			} else {
				echo "<link rel='apple-touch-startup-image' href='http://wptouch-pro.s3.amazonaws.com/resources/startup/iphone/startup.png' /> \n";	
			}
			if ( $is_ios5 ) {
				if ( $settings->classic_webapp_retina_loading_img_location ) {
					echo "<link rel='apple-touch-startup-image' media='only screen and (-webkit-min-device-pixel-ratio: 2)' href='" . $settings->classic_webapp_retina_loading_img_location . "' /> \n";
				} else {
					echo "<link rel='apple-touch-startup-image' media='only screen and (-webkit-min-device-pixel-ratio: 2)' href='http://wptouch-pro.s3.amazonaws.com/resources/startup/iphone/retina-startup.png' /> \n";		
				}
			}
		}
	// iPad
		if ( $ipad ) {
			if ( $settings->classic_ipad_webapp_loading_img_location ) {
				echo "<link rel='apple-touch-startup-image' media='(orientation: portrait)' href='" . $settings->classic_ipad_webapp_loading_img_location . "' /> \n";
			} else {
				echo "<link rel='apple-touch-startup-image' media='(orientation: portrait)' href='http://wptouch-pro.s3.amazonaws.com/resources/startup/ipad/startup.png' /> \n";
			}
			if ( $is_ios5 ) {
				if ( $settings->classic_ipad_webapp_landscape_loading_img_location ) {
					echo "<link rel='apple-touch-startup-image' media='(orientation: landscape)' href='" . $settings->classic_ipad_webapp_landscape_loading_img_location . "' /> \n";
				} else {
					echo "<link rel='apple-touch-startup-image' media='(orientation: landscape)' href='http://wptouch-pro.s3.amazonaws.com/resources/startup/ipad/startup-landscape.png' /> \n";
				}
			}
		}
	}
}

function classic_show_attached_image_filter( $content ) {
	global $post;
	$settings = wptouch_get_settings();

	if ( post_password_required( $post ) ) {
		return $content;
	}
	
	$should_show_image = false;
	if ( $settings->classic_show_attached_image && is_single() && !is_page() ) {
		$should_show_image = true;
	} else if ( $settings->classic_show_attached_image_on_page && is_page() ) {
		$should_show_image = true;
	}

	if ( $should_show_image ) {
		$photos = get_children( 
			array( 
				'post_parent' => $post->ID, 
				'post_status' => 'inherit', 
				'post_type' => 'attachment', 
				'post_mime_type' => 'image', 
				'order' => 'ASC', 
				'orderby' => 'menu_order ID'
			)
		);
	
		$attachment_html = false;	
		if ( $photos ) {
			// Grab the first photo, may show more than one eventually			
			foreach( $photos as $photo ) {
				$attachment_html = apply_filters( 'wptouch_image_attachment', '<div class="wptouch-image-attachment">' . wp_get_attachment_image( $photo->ID, 'large' ) . '</div>' );
				break;	
			}	
		}
		
		if ( $attachment_html ) {
			$can_show_attachment = true;
			
			// Make sure the image isn't already in the post content
			if ( preg_match( '#src=\"(.*)\"#iU', $attachment_html, $matches ) ) {
				$image_url = str_replace( wptouch_get_bloginfo( 'home' ), '', $matches[1] );
				
				if ( strpos( $content, $image_url ) !== false ) {
					$can_show_attachment = false;	
				}	
			}
			
			if ( $can_show_attachment ) {			
				$settings = wptouch_get_settings();
				switch( $settings->classic_show_attached_image_location ) {
					case 'above':
						$content = $attachment_html . $content;
						break;
					case 'below':
						$content = $content . $attachment_html;
						break;	
				}
			}
		}
	}
	
	return $content;
}

function classic_instapaper() {
	if ( !class_exists( 'WP_Http' ) ) {
		include_once( ABSPATH . WPINC. '/class-http.php' );
	}
	
	$url = 'http://www.instapaper.com/api/add?url=' . urlencode( wptouch_get_ajax_param( 'url' ) ) . '&title=' . urlencode( wptouch_get_ajax_param( 'title' ) ) . '&username=' . wptouch_get_ajax_param( 'username' ) . '&password=' . wptouch_get_ajax_param( 'password' );
	
	$request = new WP_Http;
	$response = $request->request( $url );
	
	$success = false;
	if ( !is_wp_error( $response ) ) {
		if ( isset( $response['response']['code'] ) && $response['response']['code'] == 201 ) {
			$success = true;
		}
	}
	if ( $success ) { echo '1'; } else { echo '0'; }
}

// Remove whitespace from beginning and end of user agents
function classic_user_agent_filter( $agents ) {
	return trim( $agents );	
}

function classic_localize_scripts( $localize_info ) {
	$settings = wptouch_get_settings();
	$localize_info['loading_text'] = __( 'Loading...', 'wptouch-pro' );
	$localize_info['external_link_text'] = __( 'This is an external link.', 'wptouch-pro' );
	$localize_info['wptouch_ignored_text'] = __( 'This page is not mobile formatted.', 'wptouch-pro' );
	$localize_info['open_browser_text'] = __( 'Do you want to open it in Safari?', 'wptouch-pro' );
	$localize_info['instapaper_saved'] = __( 'Saved to Instapaper!', 'wptouch-pro' );
	$localize_info['instapaper_try_again'] = __( 'There was an error logging into your account. Please try again', 'wptouch-pro' );
	$localize_info['instapaper_username'] = __( 'Username or E-Mail', 'wptouch-pro' );
	$localize_info['instapaper_password'] = __( 'Password (if you use one)', 'wptouch-pro' );
	$localize_info['classic_post_desc'] = __( 'Enter Description for Post', 'wptouch-pro' );
	$localize_info['leave_a_comment'] = __( 'Leave a comment', 'wptouch-pro' );
	$localize_info['leave_a_reply'] = __( 'Leave a reply to', 'wptouch-pro' );
	$localize_info['comment_failure'] = __( 'Comment publication failed. Please check your comment details and try again.', 'wptouch-pro' );
	$localize_info['comment_success'] = __( 'Your comment was published.', 'wptouch-pro' );
	$localize_info['prowl_failure'] = __( 'Direct messaging failed. Please check your message details and try again.', 'wptouch-pro' );
	$localize_info['validation_message'] = __( 'One or more fields were not completed.', 'wptouch-pro' );
	$localize_info['leave_webapp'] = __( 'Visiting this link will cause you to leave Web-App Mode.  Are you sure?', 'wptouch-pro' );
	$localize_info['add2home_message'] = $settings->classic_add2home_msg;
	$localize_info['toggle_on'] = __( 'ON', 'wptouch-pro' );
	$localize_info['toggle_off'] = __( 'OFF', 'wptouch-pro' );

	return $localize_info;	
}

function classic_custom_templates( $templates ) {
	$settings = wptouch_get_settings();

	if ( $settings->classic_show_archives ) {
		$templates[ __( 'Archives', 'wptouch-pro' ) ] = array( 'wptouch-archives' );
	}

	if ( $settings->classic_show_links ) {
		$templates[ __( 'Links', 'wptouch-pro' ) ] = array( 'wptouch-links' );
	}
	
	if ( $settings->classic_show_flickr_rss && function_exists( 'get_flickrRSS' ) ) {
		$templates[ __( 'Photos', 'wptouch-pro' ) ] = array( 'wptouch-flickr-photos' );
	}

	return $templates;
}

function classic_was_redirect_target() {
	return ( isset( $_GET['wptouch_custom_redirect'] ) );
}

// Previous + Next Post Functions For Single Post Pages
function classic_get_previous_post_link() {	
	$settings = wptouch_get_settings();

	$prev_post = get_adjacent_post( false, $settings->classic_excluded_categories ); 
	if ( $prev_post ) {
		$prev_url = get_permalink( $prev_post->ID ); 
		echo '<a href="' . $prev_url . '" class="nav-back ajax-link">' . __( "Prev", "wptouch-pro" ) . '</a>';
	}
}

function classic_get_next_post_link() {
	$settings = wptouch_get_settings();

	$next_post = get_adjacent_post( false, $settings->classic_excluded_categories, 0 ); 
	if ( $next_post ) {
		$next_url = get_permalink( $next_post->ID ); 
		echo '<a href="' . $next_url . '" class="nav-fwd ajax-link">'. __( "Next", "wptouch-pro" ) . '</a>';
	}
}

// Dynamic archives heading text for archive result pages, and search
function classic_archive_text() {
	global $wp_query;
	$total_results = $wp_query->found_posts;

	if ( !is_home() ) {
		echo '<div class="archive-text">';
	}
	if ( is_search() ) {
		echo sprintf( __( "Search results &rsaquo; %s", "wptouch-pro" ), get_search_query() );
		echo '&nbsp;(' . $total_results . ')';
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

// If AJAX load more is turned off, this shows
function classic_archive_navigation_back() {
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

// If AJAX load more is turned off, this shows
function classic_archive_navigation_next() {
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

function classic_wp_comments_nav_on() {
	if ( get_option( 'page_comments' ) ) {
		return true;
	} else {
		return false;
	}
}

function classic_show_comments_on_pages() {
	$settings = wptouch_get_settings();
	if ( comments_open() && $settings->classic_show_comments_on_pages && !post_password_required() ) {
		return true;
	} else {
		return false;
	}
}

//2.2
function wptouch_comment_bubble_size() {
	if ( wptouch_get_comment_count() > 9 && wptouch_get_comment_count() < 99 ) {
		echo 'double'; 
	} else if ( wptouch_get_comment_count() > 99 ) {
		echo 'triple';
	}
}

function show_webapp_notice() {
	$settings = wptouch_get_settings();
	if ( $settings->classic_webapp_enabled && $settings->classic_show_webapp_notice ) {
		return true;
	} else {
		return false;
	}
}

function classic_is_ajax_enabled() {
	$settings = wptouch_get_settings();
	return $settings->classic_ajax_mode_enabled;
}

function classic_use_calendar_icons() {
	$settings = wptouch_get_settings();
	return $settings->classic_icon_type == 'calendar';
}

function classic_use_thumbnail_icons() {
	$settings = wptouch_get_settings();
	return ( $settings->classic_icon_type != 'calendar' && $settings->classic_icon_type != 'none' );
}

function classic_show_admin_menu_link() {
	$settings = wptouch_get_settings();
	if ( classic_show_account_tab() ) {
		if ( $settings->classic_show_admin_menu_link ) {
			return true;
		} else {
			return false;
		}
	}
}

function classic_show_account_tab() {
	$settings = wptouch_get_settings();
	if ( get_option( 'comment_registration' ) || get_option( 'users_can_register' ) || $settings->classic_show_account ) {
		return true;
	} else {
		return false;
	}
}

function classic_show_profile_menu_link() {
	$settings = wptouch_get_settings();
	if ( classic_show_account_tab() ) {
		if ( $settings->classic_show_profile_menu_link ) {
			return true;
		} else {
			return false;
		}
	}
}

function classic_show_author_in_posts() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_post_author;
}

function classic_show_categories_in_posts() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_post_categories;
}

function classic_show_tags_in_posts() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_post_tags;
}

function classic_show_date_in_posts() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_post_date;
}

// 2.2
// filter added in functions.php for mobile + ipad
function classic_exclude_categories( $query ) {
	$settings = wptouch_get_settings();
	$excluded = $settings->classic_excluded_categories;
	
	if ( $excluded ) {
		$cats = explode( ',', $excluded );
		$new_cats = array();
		
		foreach( $cats as $cat ) {
			$new_cats[] = trim( $cat );
		}
	
		if ( !$query->is_single() ) {
			$query->set( 'category__not_in', $new_cats );
		}	
	}
		
	return $query;
}

// 2.2
// filter added in functions.php for mobile + ipad
function classic_exclude_tags( $query ) {
	$settings = wptouch_get_settings();
	$excluded = $settings->classic_excluded_tags;
	
	if ( $excluded ) {
		$tags = explode( ',', $excluded );
		$new_tags = array();
		
		foreach( $tags as $tag ) {
			$new_tags[] = trim( $tag );
		}
	
		if ( !$query->is_single() ) {
			$query->set( 'tag__not_in', $new_tags );
		}	
	}
	
	return $query;
}

// 2.2
// Search results only have posts for now
// filter added in functions.php for mobile + ipad
function classic_search_filter( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', 'post' );
	}
	return $query;
}

// Check what order comments are displayed, governs whether 'load more comments' link uses previous_ or next_ function
function classic_comments_newer() {
	if ( get_option( 'default_comments_page' ) == 'newest' ) {
			return true;
		} else {
			return false;
		}
}

// Thumbnail stuff added in 2.0.4
function classic_has_post_thumbnail() {
	global $post;
	
	$settings = wptouch_get_settings();
	
	$has_post_thumbnail = false;
	
	switch( $settings->classic_icon_type ) {
		case 'thumbnails':
			$has_post_thumbnail = function_exists( 'has_post_thumbnail' ) && has_post_thumbnail();
			break;
		case 'simple_thumbs':
			$has_post_thumbnail = function_exists( 'p75GetThumbnail' ) && p75HasThumbnail( $post->ID );
			break;
		case 'custom_thumbs':
			$has_post_thumbnail = get_post_meta( $post->ID, $settings->classic_custom_field_thumbnail_name, true ) || get_post_meta( $post->ID, 'Thumbnail', true ) || get_post_meta( $post->ID, 'thumbnail', true );
			break;
	}

	return $has_post_thumbnail;
}

function classic_the_post_thumbnail( $thumbnail ) {
	global $post;
	
	$settings = wptouch_get_settings();	
	$custom_field_name = $settings->classic_custom_field_thumbnail_name;
	
	switch( $settings->classic_icon_type ) {
		case 'thumbnails':
			if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail() ) {
				return $thumbnail;	
			}
			break;
		case 'simple_thumbs':
			if ( function_exists( 'p75GetThumbnail' ) && p75HasThumbnail( $post->ID ) ) {
				return p75GetThumbnail( $post->ID );	
			}
			break;
		case 'custom_thumbs':
			if ( get_post_meta( $post->ID, $custom_field_name, true ) ) {
				return get_post_meta( $post->ID, $custom_field_name, true );
			} else if ( get_post_meta( $post->ID, 'Thumbnail', true ) ) {
				return get_post_meta( $post->ID, 'Thumbnail', true );
			} else if ( get_post_meta( $post->ID, 'thumbnail', true ) ) {
				return get_post_meta( $post->ID, 'thumbnail', true );
			}
			
			break;
	}		
	// return default if none of those exist
	return wptouch_get_bloginfo( 'template_directory' ) . '/images/default-thumbnail.png';
}

function classic_thumbs_on_single() {
	$settings = wptouch_get_settings();	
	if ( $settings->classic_thumbs_on_single ) {
		return true;
	} else {
		return false;
	}
}

function classic_thumbs_on_pages() {
	$settings = wptouch_get_settings();	
	if ( $settings->classic_thumbs_on_pages && classic_has_post_thumbnail() ) {
		return true;
	} else {
		return false;
	}
}

//Single Post Page
function classic_show_date_single() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_post_date_single;
}

function classic_show_author_single() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_post_author_single;
}

function classic_show_cats_single() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_post_cats_single;
}

function classic_show_tags_single() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_post_tags_single;
}

function classic_show_share_single() {
	$settings = wptouch_get_settings();
	return $settings->classic_show_share_save;
}

function wptouch_classic_is_custom_latest_posts_page() {
	global $post;
	
	$settings = wptouch_get_settings();	
	
	if ( $settings->classic_latest_posts_page == 'none' ) {
		return false;	
	} else {		
		rewind_posts();
		the_post();
		rewind_posts();
		
		return apply_filters( 'wptouch_classic_is_custom_latest_posts_page', ( $settings->classic_latest_posts_page == $post->ID ) );
	}
}

function wptouch_classic_custom_latest_posts_query() {
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args = array(
		'paged' => $paged,
		'posts_per_page' => intval( get_option( 'posts_per_page') )
	);
	
	query_posts( $args ); 	
}

// Custom Post Types
function classic_should_show_taxonomy() {
	global $post;
	
	$should_show_taxonomy = ( $post->post_type == 'post' );
	
	return apply_filters( 'wptouch_classic_should_show_taxonomy', $should_show_taxonomy );
}

function classic_has_custom_taxonomy() {
	global $post;
	
	$custom_taxonomy = ( $post->post_type != 'post' );
	
	return apply_filters( 'wptouch_classic_has_custom_taxonomy', $custom_taxonomy );
}

function classic_get_custom_taxonomy() {
	$custom_tax = array();
	return apply_filters( 'wptouch_classic_get_custom_taxonomy', $custom_tax );
}

function classic_url_encode( $string ) {
    $entities = array( '%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D', '%C2' );
    $replacements = array( '!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]", "-" );
    return str_replace( $entities, $replacements, urlencode( $string ) );
}
