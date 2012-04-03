<?php

/*!		\brief Called inside a template file inside the HEAD tag
 *
 *		This method should be called inside the HEAD area of a WPtouch theme template file.
 *		This method ultimately intercepts the main WordPress wp_head action.
 *
 *		The WordPress action \em wptouch_pre_head is executed at the start of the header block, and the action \em wptouch_post_head is executed at the end
 *		of the header block.
 *
 *		\par Typical Usage:
 *		\include wptouch-head.php
 *
 *		\ingroup templatetags
 */	 
function wptouch_head() {
	do_action( 'wptouch_pre_head' );	
	
	wp_head();		
	
	do_action( 'wptouch_post_head' );
}

/*!		\brief Called inside a template file prior to the closing BODY tag.
 *
 *		This method should be called just prior to the closing BODY tag inside of a WPtouch theme template file.
 *		This method ultimately intercepts the main WordPress \em wp_footer action.  
 *
 *		The WordPress action \em wptouch_pre_footer is executed at the start of the footer block, and the action \em wptouch_post_footer is executed at the end
 *		of the footer block.
 *
 *		\par Typical Usage:
 *		The following is the typical usage of this method and proper placement in the HTML structure:
 *
 *		\include wptouch-footer.php
 *
 *		\ingroup templatetags 
 */	 
function wptouch_footer() {
	do_action( 'wptouch_pre_footer' );
	
	wp_footer();	
	
	do_action( 'wptouch_post_footer' );
}

/*!		\brief Echos the title for the WordPress site
 *
 *		This method echos the title for the WordPress site, and looks for the edited version in the WPtouch Pro settings first.  
 *		It adds the title of the page when viewing a page or a post.  This method is meant to be used
 *		for the HTML TITLE tag.
 *
 *		\par Typical Usage:
 *		The following is how this method is typically used:
 *		\include wptouch-title.php
 *
 *		\ingroup templatetags 
 */
function wptouch_title() {
	if ( is_home() ) {
		echo wptouch_bloginfo( 'site_title' );
	} else {
		echo wptouch_bloginfo( 'site_title' ) . wp_title( ' &raquo; ', 0 );	
	}
}

/*!		\brief Echos the short title for the WordPress site
 *
 *		This method echos the result of the wptouch_get_site_title() method.
 *
 *		\ingroup templatetags 
 */
function wptouch_site_title() {
	echo wptouch_get_site_title();
}

/*!		\brief Returns the short title for the WordPress site
 *
 *		This method returns the short title for the WordPress site.  If a short title hasn't been set, it returns the long title as defined
 *		in the WordPress admin panel.
 *
 *		This method can be filtered using the WordPress filter \em wptouch_site_title.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_site_title() {
	global $wptouch_pro;	
	$settings = $wptouch_pro->get_settings();
	
	return apply_filters( 'wptouch_site_title', $settings->site_title );
}

/*!		\brief Returns true when there are posts available for the loop.
 *
 *		This method returns true when there are posts available for the loop.  This method is a wrapper for the normal
 *		WordPress have_posts method.
 *
 *		\par Typical Usage:
 *		The following is an example of a WPtouch theme loop:
 *		\include theme-loop.php
 *
 *		\ingroup templatetags 
 */
function wptouch_have_posts() {
	return have_posts();
}

/*!		\brief Populates the post data in a WPtouch theme loop.
 *
 *		This method will populate the post data structure and is meant to be used in conjunction with wptouch_have_posts().
 *
 *		\par Typical Usage:
 *		The following is an example of a WPtouch theme loop:
 *		\include theme-loop.php 
 *
 *		\ingroup templatetags 
 */
function wptouch_the_post() {
	the_post();
}

/*!		\brief Echos the post content returned from wptouch_get_content()
 *
 *		This method echos the post content returned from wptouch_get_content.  This is a wrapper for the WordPress
 *		method \em get_the_content.
 *
 *		\par Typical Usage:
 *		The following is an example of a WPtouch theme loop:
 *		\include theme-loop.php  
 *
 *		\ingroup templatetags 
 */
function wptouch_the_content() {
	echo apply_filters( 'the_content', wptouch_get_content() );
}

/*!		\brief Return the post content associated with a post.
 *
 *		This is a wrapper for the WordPress method \em get_the_content.
 *		This method can be filtered by using the WordPress filter \em wptouch_the_content.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_content() {
	return apply_filters( 'wptouch_the_content', get_the_content() );
}

/*!		\brief Echos the post excerpt associated with a post.
 *
 *		This method echos the output from wptouch_get_excerpt().
 *
 *		\ingroup templatetags 
 */
function wptouch_the_excerpt() {
	echo wptouch_get_excerpt();	
}

/*!		\brief Returns the post excerpt associated with a post.
 *
 *		This function is a wrapper for the WordPress method get_the_excerpt().  The output from this function can be filtered using the 
 *		WordPress filter \em wptouch_excerpt.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_excerpt() {
	return apply_filters( 'wptouch_excerpt', get_the_excerpt() );
}

/*!		\brief Echos a space-separated list of classes to be used for the footer.
 *
 *		This method echos a list of the recommended classes to use within the main footer block in each theme.
 *
 *		\par Typical Usage:
 *		The following is the typical usage of this function:
 *		\include wptouch-footer.php
 *
 *		\ingroup templatetags 
 */
function wptouch_footer_classes() {
	echo wptouch_get_footer_classes();
}

/*!		\brief Returns a space-separated of classes to be used for the footer.
 *
 *		This method returns a list of the recommended classes to use within the main footer block in each theme.
 *		This method can be filtered using the WordPress filter \em wptouch_footer_classes.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_footer_classes() {
	$footer_classes = array( 'footer' );
	
	return implode( ' ', apply_filters( 'wptouch_footer_classes', $footer_classes ) );
}

/*!		\brief Echos a space-separated list of classes to be used for the main body tag.
 *
 *		This method echos a list of the recommended classes to use for the main body tag in each theme.
 *
 *		\par Typical Usage:
 *		\include body-classes.php 
 *
 *		\ingroup templatetags 
 */
function wptouch_body_classes() {
	echo wptouch_get_body_classes();
}

/*!		\brief Returns a space-separated list of classes to be used for the main body tag.
 *
 *		This method echos a list of the recommended classes to use for the main body tag in each theme.
 *		This method can be filtered using the WordPress filter \em wptouch_body_classes.
 *
 *		\par Added Classes
 *		The following classes are added automatically:
 *		\arg \c device-{devicename} - The name of the device, i.e. \em device-blackberry9500
 *		\arg \c device-class-{deviceclass} - The name of the device class, i.e. \em device-class-blackberry
 *		\arg \c skin-{skinname} - The name of the currently active skin, i.e. \em skin-oceanwave
 *		\arg \c theme-{themename} - The name of the currently active theme, i.e. \em theme-skeleton
 *		\arg \c dark-icon - If the current page icon looks best with a dark background
 *		\arg \c post-thumbnails - If post thumbnails are enabled
 *		\arg \c disqus - Added when the Disqus is installed and active
 *		\arg \c int-deb - Added when the Intense Debate plugin is installed and active 
 *
 *		\ingroup templatetags 
 */
function wptouch_get_body_classes() {
	global $wptouch_pro;
	$settings = $wptouch_pro->get_settings();
	
	$body_classes = array( 'wptouch-pro' );
	$mobile_device = $wptouch_pro->get_active_mobile_device();
	if ( $mobile_device ) {
		$body_classes[] = 'device-' . wptouch_make_css_friendly( $mobile_device );	
	}
	
	$active_device_class = $wptouch_pro->get_active_device_class();
	if ( $active_device_class ) {
		$body_classes[] = 'device-class-' . wptouch_make_css_friendly( $active_device_class );	
	}
	
	$current_skin = $wptouch_pro->get_current_theme_skin();
	if ( $current_skin ) {
		$body_classes[] = 'skin-' . wptouch_make_css_friendly( basename( $current_skin, '.css' ) );
	}	
	
	$body_classes[] = 'theme-' . wptouch_make_css_friendly( $wptouch_pro->get_current_theme() );	
	
	if ( is_page() || wptouch_is_custom_page_template() ) {
		global $post;
		
		if ( wptouch_is_custom_page_template() ) {
			$page_id = wptouch_get_custom_page_template_id();
		} else {
			$page_id = $post->ID;
		}
		
		if ( isset( $settings->menu_icons[ $page_id ] ) ) {
			$current_icon = $settings->menu_icons[ $page_id ];
			if ( $current_icon ) {
				$current_icon = WP_CONTENT_DIR . $current_icon;
				$icon_set = $wptouch_pro->get_set_with_icon( $current_icon );
				if ( $icon_set ) {
					if ( $icon_set->dark_background ) {
						$body_classes[] = 'dark-icon';
					}
				}
			}
		}
	}
	
	
	if ( function_exists( 'dsq_comments_template' ) ) {
		$body_classes[] = 'disqus';	
	}
	
	if ( function_exists( 'id_comments_template' ) ) {
		$body_classes[] = 'int-deb';	
	}

	// Add a body class for post thumbnails
	if ( $settings->post_thumbnails_enabled ) {
		$body_classes[] = 'post-thumbnails';
	}	
		
	return implode( ' ', apply_filters( 'wptouch_body_classes', $body_classes ) );	
}

/*!		\brief Converts a string into a representation suitable for a CSS class.
 *
 *		This method converts a string into a format that's suitable for a CSS class.
 *
 *		\ingroup templatetags 
 */
function wptouch_make_css_friendly( $name ) {
	return strtolower( str_replace( ' ', '-', $name ) );
}

/*!		\brief Echos the title for a post
 *
 *		This method echos the title for a post.  It is a wrapper for the standard WordPress \em the_title() method.
 *
 *		\par Typical Usage:
 *		This function is typically used in the following manner:
 *		\include theme-loop.php 
 *
 *		\ingroup templatetags 
 */
function wptouch_the_title() {
	echo wptouch_get_title();	
}

/*!		\brief Returns the title for a post
 *
 *		This method returns the title for a post.  It is a wrapper for the standard WordPress function \em get_the_title().  
 * 		This method can be filtered using the WordPress filter \em wptouch_the_title.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_title() {
	return apply_filters( 'wptouch_the_title', get_the_title() );	
}

/*!		\brief Echos the permalink for a post
 *
 *		This method echos the permalink for a post.  It is a wrapper for the standard WordPress function \em the_permalink().
 *
 *		\ingroup templatetags 
 */
function wptouch_the_permalink() {
	echo wptouch_get_the_permalink(); 
}

/*!		\brief Returns the permalink for a post
 *
 *		This method returns the permalink for a post.  It is a wrapper for the standard WordPress get_the_permalink() method.
 *		This method can be filtered using the WordPress \em wptouch_the_permalink filter.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_the_permalink() {
	return apply_filters( 'wptouch_the_permalink', get_permalink() );	
}

/*!		\brief Echos a list of space-separated classes to be used for each post
 *
 *		This method returns a list of space-separeated classes to be used for each post.  It echos the results from
 *		wptouch_get_post_classes().
 *
 *		\ingroup templatetags 
 */
function wptouch_post_classes() {
	echo implode( ' ', wptouch_get_post_classes() );	
}

/*!		\brief Returns a list of space-separated classes to be used for each post.
 *
 *		This function returns a list of space-separated classes that can be added to a post.  The output of this function can be filtered
 *		with the WordPress filter \em wptouch_post_classes.
 *
 *		\par Added Classes:
 *		The following classes are added automatically:
 *		\arg \c post-{ID} - The post ID, i.e. \em post-2
 *		\arg \c post-name-{name} - The name of the current post, i.e. \em post-name-some-cool-post
 *		\arg \c post-parent-{paremt} - The ID of the post's parent, i.e. \em post-parent-10
 *		\arg \c post-author-{author} - The post author
 *		\arg \c single - On single post pages
 *		\arg \c not-single - Not on single post pages
 *		\arg \c page - When viewing a page
 *		\arg \c not-page - When not viewing a page
 *		\arg \c ajax - When the post content was generated view Ajax
 *		\arg \c has-thumbnail - When the post has a thumbnail
 *
 *		\par Typical Usage:
 *		The following example shows how this function is typically used:
 *		\include theme-loop.php
 *
 *		\par Adding Custom Classes:
 *		The following examples show how custom post classes can be added dynamically:
 *		\include custom-post-classes.php
 *
 *		\ingroup templatetags
 */
function wptouch_get_post_classes() {
	global $post;
	$post_classes = array( 'post', 'section' );
	
	// Add the post ID as a class
	if ( isset( $post->ID ) ) {
		$post_classes[] = 'post-' . $post->ID;	
	}
	
	// Add the post title
	if ( isset( $post->post_name ) ) {
		$post_classes[] = 'post-name-' . $post->post_name;	
	}	
	
	// Add the post parent
	if ( isset( $post->post_parent ) && $post->post_parent ) {
		$post_classes[] = 'post-parent-' . $post->post_parent;	
	}
	
	// Add the post parent
	if ( isset( $post->post_author ) && $post->post_author ) {
		$post_classes[] = 'post-author-' . $post->post_author;	
	}	
		
	if ( is_single() ) {
		$post_classes[] = 'single';
	} else {
		$post_classes[] = 'not-single';
	}
	
	if ( is_page() ) {
		$post_classes[] = 'page';
	} else {
		$post_classes[] = 'not-page';
	}
	
	if ( wptouch_is_ajax() ) {
		$post_classes[] = 'ajax';
	}
	
	if ( wptouch_has_post_thumbnail() ) {
		$post_classes[] = 'has-thumbnail';
	} else {
		$post_classes[] = 'no-thumbnail';
	}

	return apply_filters( 'wptouch_post_classes', $post_classes );
}

/*!		\brief Used to determine if a post has an associated thumbnail.  
 *
 *		Used to determine if a post has an associated thumbnail image. 
 *
 *		\returns True if the post has a thumbnail, otherwise false
 *
 *		\ingroup templatetags
 */
function wptouch_has_post_thumbnail() {
	if ( function_exists( 'has_post_thumbnail' ) ) {
		$has_thumbnail = has_post_thumbnail();
		
		return apply_filters( 'wptouch_has_post_thumbnail', $has_thumbnail );
	} else {
		return apply_filters( 'wptouch_has_post_thumbnail', false );
	}
}

/*!		\brief This function echos a post thumbnail.
 *
 *		This function echos a post thumbnail image; it should be used in conjunction with wptouch_has_post_thumbnail().
 *
 *		\param param Currently unused
 *
 *		\ingroup templatetags 
 */
function wptouch_the_post_thumbnail( $param = false ) {
	echo wptouch_get_the_post_thumbnail( $param );
}

/*!		\brief This function returns a post thumbnail.  
 *
 *		This function returns a post thumbnail image; it should be used in conjunction with wptouch_has_post_thumbnail().
 *
 *		This method calls the WordPress function \em get_the_post_thumbnail() internally.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_the_post_thumbnail( $param = false ) {
	global $post;
	
	$thumbnail = false;
	if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail() ) {
	
			$thumbnail = get_the_post_thumbnail( $post->ID, 'wptouch-new-thumbnail' );
			if ( preg_match( '#src=\"(.*)\"#iU', $thumbnail, $matches ) ) {
				$thumbnail = $matches[1];
			}
		}

		return apply_filters( 'wptouch_the_post_thumbnail', $thumbnail, $param );	
}


/*!		\brief Echos a list of space-separated classes to be used for the content of each post.
 *
 *		This method echos a list of space-separeated classes to be used for the content of each post.  It echos the results from
 *		wptouch_get_content_classes().
 *
 *		\ingroup templatetags 
 */
function wptouch_content_classes() { 
	echo implode( ' ', wptouch_get_content_classes() );	
}

/*!		\brief Returns a list of space-separated classes to be used for the content of each post.
 *
 *		This method returns a list of space-separated classes to be used for the content of each post. 
 *		This method can be filtered using the WordPress filter \em wptouch_content_classes. 
 *
 *		\note Currently only the class 'content' is added, but additional classes will be added in future versions
 *
 *		\ingroup templatetags 
 */
function wptouch_get_content_classes() {
	$content_classes = array( 'content' );	
	
	return apply_filters( 'wptouch_content_classes', $content_classes );
}

/*!		\brief Echos a list of space-separated classes to be used for the date field of any post.
 *
 *		This function echos a list of space-separeated classes to be used for the date field of any post.  It echos the results from
 *		wptouch_get_date_classes().
 *
 *		\ingroup templatetags 
 */
function wptouch_date_classes() {
	echo implode( ' ', wptouch_get_date_classes() );
}

/*!		\brief Returns an array of space-separated classes to be used for the date field of each post.
 *
 *		This method returns an array of space-separated classes to be used for the date field of each post. 
 *		This method can be filtered using the WordPress filter \em wptouch_date_classes. 
 *
 *		\par Added Classes:
 *		The following classes are added automatically:
 *		\arg \c date - The word 'date' is added
 *		\arg \c m-{month} - The month number is added, i.e. \em m-2 for February
 *		\arg \c y-{year} - The year is added, i.e. \em y-2010
 *		\arg \c dt-{ampm} - Am or Pm, i.e. \em dt-am or \em dt-pm
 *		\arg \c day-{day} - The day is added, i.e. \em day-12 for the 12th day of the month
 *		\arg \c dow-{dayofweek} - The day of the week is added, i.e. \em dow-0 for Sunday
 *
 *		\par Typical Usage:
 *		The following shows a typical content loop and usage of wptouch_date_classes():
 *		\include theme-loop.php
 *
 *		\ingroup templatetags 
 */
function wptouch_get_date_classes() {
	$date_classes = array();
	$date_classes[] = 'date';
	$date_classes[] = 'm-' . get_the_time( 'n' );
	$date_classes[] = 'y-' . get_the_time( 'Y' );
	$date_classes[] = 'dt-' . get_the_time( 'a' );
	$date_classes[] = 'day-' . get_the_time( 'j' );
	$date_classes[] = 'dow-' . get_the_time( 'w' );
	
	return apply_filters( 'wptouch_date_classes', $date_classes );
}

/*!		\brief Echos the date for a post.   
 *
 *		This function echos the result of wptouch_get_the_time().
 *
 *		\param format Indicates how the date field should be formatted.  Please refer to the documentation for PHP's date() function 
 *		for information about the accepted parameters.
 *
 *		\ingroup templatetags 
 */
function wptouch_the_time( $format ) {
	echo wptouch_get_the_time( $format );	
}

/*!		\brief Returns the date for a post
 *
 *		Interally this method wraps the WordPress function the_time().  
 *
 *		\param format Indicates how the date field should be formatted.  Please refer to the documentation for PHP's date() function.
 *		for information about the accepted parameters.
 *
 *		\returns The formatted date
 *
 *		\ingroup templatetags 
 */
function wptouch_get_the_time( $format ) {
	$settings = wptouch_get_settings();
	if ( $settings->respect_wordpress_date_format ) {
		$format = get_option('date_format');	
	}
	
	return apply_filters( 'wptouch_get_the_time', get_the_time( $format ) );
}

/*!		\brief Can be used to determine if an AJAX request is happening
 *
 *		Can be used to determine if an AJAX request is happening by checking for the HTTP_X_REQUESTED_WITH header.
 *
 *		\returns True if an AJAX request is underway, otherwise false  
 *
 *		\ingroup templatetags
 */
function wptouch_is_ajax() {
	return ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) );
}

/*!		\brief Used to determine whether a post has tags
 *
 *		This function can be used to determine whether or not a post has any tags.
 *
 *		\returns True if the post has tags, false otherwise  
 *
 *		\ingroup templatetags
 */
function wptouch_has_tags() {
	if ( is_page() ) {
		return false;	
	}
	
	$tags = get_the_tags();
	return apply_filters( 'wptouch_has_tags', $tags );
}

/*!		\brief Used to echo a comma-separated list of tags associated with a post. 
 *
 *		This function can be used to echo a comma-separated list of tags associated with the current post.  This method should be used in conjunction with
 *		wptouch_has_tags().
 *
 *		\ingroup templatetags 
 */
function wptouch_the_tags() {
	the_tags( '',', ','' ); 
}

/*!		\brief Used to determine whether a post has categories
 *
 *		This function can be used to determine whether or not a post has any categories associated with it.
 *
 *		\returns True if the post has categories, false otherwise  
 *
 *		\ingroup templatetags
 */
function wptouch_has_categories() {
	if ( is_page() ) {
		return false;
	}
	
	$cats = get_the_category();
	return $cats;
}

/*!		\brief Used to echo a comma-separated list of categories associated with a post. 
 *
 *		This function can be used to echo a comma-separated list of categories associated with the current post.  This method should be used in conjunction with
 *		wptouch_has_categories().
 *
 *		\ingroup templatetags 
 */
function wptouch_the_categories() {
	the_category( ', ' );
}

/*!		\brief Used to determine if a page has additional content or not
 *
 *		This function can be used to determine whether or not a page has additional pages of content available. If can be used to selectively show or hide the
 *		link to additional posts. 
 *
 *		\ingroup templatetags
 */
function wptouch_has_next_posts_link() {
	ob_start();
	next_posts_link();
	$contents = ob_get_contents();
	ob_end_clean();
	
	return $contents;	
}

/*!		\brief Executes a non-standard template file in the current WPtouch theme directory.
 *
 *		This function executes a non-standard template file in the current WPtouch theme directory.  The standard template files 
 *		(index.php, header.php, etc) for WordPress will work with WPtouch.  Non-standard template files can be
 *		included by using this function.  For example, wptouch_do_template( 'gliding-menu.php' ) will execute the gliding-menu.php
 *		PHP script that is located in the current WPtouch theme directory.  
 *
 *		\param template_name the name of the template_file, i.e. \em my-template.php
 *
 *		\returns True if the template was successfully executed, false otherwise
 *
 *		\ingroup templatetags 
 */
function wptouch_do_template( $template_name ) {
	global $wptouch_pro;
	$template_path = $wptouch_pro->get_current_theme_directory() . '/' . $wptouch_pro->get_active_device_class() . '/' . $template_name;
	$directories = array( TEMPLATEPATH );
	if ( $wptouch_pro->is_child_theme() ) { 
		$diretories[] = STYLESHEETPATH;	
	}
	
	foreach( $directories as $dir ) {
		if ( file_exists( $dir . '/' . $template_name ) ) {
			include( $dir . '/' . $template_name );
			return true;	
		}
	}
	
	return false;
}

/*!		\brief Determines whether or not the current page has an icon that should be shown
 *
 *		Determines whether or not the current page has an icon that should be shown.  This is primarily determined by the setting \em enable_menu_icons.
 *
 *		\returns True if there is an icon that should be shown, false otherwise
 *
 *		\ingroup templatetags 
 */
function wptouch_page_has_icon() {
	$settings = wptouch_get_settings();
	return ( $settings->enable_menu_icons );	
}

/*!		\brief Used to determine if the current execution is a custom page template
 *
 *		This function can be used to determine if the current template is a custom page template.
 *
 *		\returns True if a custom page template is currently being executed, false if the template is a standard WordPress template
 *
 *		\ingroup templatetags 
 */
function wptouch_is_custom_page_template() {
	global $wptouch_pro;
	return $wptouch_pro->is_custom_page_template;
}


/*!		\brief Used to echo the current custom page template ID
 *
 *		This function will echo the results from wptouch_get_custom_page_template_id(). 
 *
 *		\ingroup templatetags 
 */
function wptouch_the_custom_page_template_id() {
	echo wptouch_get_custom_page_template_id();
}

/*!		\brief Used to determine the current custom page template ID
 *
 *		This function can be used to determine the current custom page template ID.  This method should be used in conjunction with wptouch_is_custom_page_template().
 *
 *		\note Custom page templates technically do not have page IDs in the WordPress sense, but they are given numerical IDs mainly for the purpose of
 *		assigning icons to them
 *
 *		\returns A number representing the custom page template ID
 *
 *		\ingroup templatetags 
 */
function wptouch_get_custom_page_template_id() {
	global $wptouch_pro;	
	return $wptouch_pro->custom_page_template_id;
}

/*!		\brief Used to retrieve the page icon for the current page
 *
 *		This function can be used to retrieve the page icon for the current page.   
 *
 *		\returns The icon for the current page, or false if icons are disabled
 *
 *		\ingroup templatetags 
 */
function wptouch_page_get_icon() {
	global $wptouch_pro;
	
	if ( wptouch_page_has_icon() ) {
		if ( wptouch_is_custom_page_template() ) {
			$page_id = wptouch_get_custom_page_template_id();
		} else {
			$page_id = get_the_ID();
		}

		// If we're not in the loop yet, let's grab the first post and then rewind
		if ( !$page_id ) {
			if ( have_posts() ) {
				the_post();
				rewind_posts();
				
				$page_id = get_the_ID();	
			}	
		}
		
		$settings = wptouch_get_settings();
		if ( $settings->custom_menu_name != 'none' ) {
			$menu_items = array();
			wptouch_build_wordpress_menu_tree( 0, 1, $menu_items, true );

			$icon = wptouch_recursive_find_page( $page_id, $menu_items );
			if ( $icon ) {
				return $icon;	
			} else {
				return wptouch_get_site_menu_icon( -1000000 );
			}
		} else {
			return wptouch_get_site_menu_icon( $page_id );
		}
	} else {
		return false;	
	}	
}

function wptouch_recursive_find_page( $page_id, $menu_items ) {
	$icon = false;
	
	foreach( $menu_items as $key => $item ) {
		if ( isset( $item->original_id ) && $item->original_id == $page_id ) {
			$icon = wptouch_get_site_menu_icon( $item->page_id );
		} else if ( isset( $item->has_children ) && $item->has_children ) {
			$icon = wptouch_recursive_find_page( $page_id, $item->submenu );
		} 
		
		if ( $icon ) {
			return $icon;	
		}
	}
}


/*!		\brief Echos the page icon for the current page
 *
 *		This function can be used to echo the page icon for the current page
 *
 *		\ingroup templatetags 
 */
function wptouch_page_the_icon() {
	$icon = wptouch_page_get_icon();
	if ( $icon ) {
		echo $icon;	
	}
}

/*!		\brief Echos the mobile/desktop switch link URL for mobile theme
 *
 *		This function echos the mobile/desktop switch link URL.  It echos the result from wptouch_get_mobile_switch_link().
 *
 *		\ingroup templatetags 
 */
function wptouch_the_mobile_switch_link() {
	echo wptouch_get_mobile_switch_link();
}

/*!		\brief Retrieves the mobile/desktop switch link URL for mobile theme
 *
 *		This function can be used to retrieve the mobile/desktop switch link URL.  It can be filtered using the WordPress filter \em wptouch_mobile_switch_link.
 *
 *		\returns The URL for the desktop switch link, and respects the admin setting whether the URL re-direct is the request URI, or homepage.
 *
 *		\note Visiting this URL alters the mobile switch COOKIE and redirects back to the current page.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_mobile_switch_link() {
	$settings = wptouch_get_settings();
	
	if ( $settings->show_switch_link ) {
		if ( $settings->home_page_redirect_address == 'same' ) {
			return apply_filters( 'wptouch_mobile_switch_link', get_bloginfo( 'url' ) . '?wptouch_switch=desktop&amp;redirect=' . urlencode( $_SERVER['REQUEST_URI'] ) );
		} else {
			return apply_filters( 'wptouch_mobile_switch_link', get_bloginfo( 'url' ) . '?wptouch_switch=desktop&amp;redirect=' . get_bloginfo( 'url' ) );
		}
	}
}

/*!		\brief Determines whether or not an unseen welcome message should be displayed.
 *
 *		This function can be used to determine whether or not a welcome message should be shown.  The welcome message can be configured in the WordPress
 *		administration panel for WPtouch, and is stored in the setting \em welcome_alert.
 *
 *		\returns True if a welcome message should be shown, false otherwise
 *
 *		\ingroup templatetags 
 */
function wptouch_has_welcome_message() {
	$settings = wptouch_get_settings();
	if ( isset( $_COOKIE['wptouch_welcome'] ) && $_COOKIE['wptouch_welcome'] === '1' ) {
		// user has already seen the message
		return false;	
	} else {
		return ( isset( $settings->welcome_alert ) && strlen( $settings->welcome_alert ) );
	}
}

/*!		\brief Echos the welcome message
 *
 *		This function can be used to echo the welcome message retrieved using wptouch_get_welcome_message().
 *
 *		\note The welcome message is currently disabled work in Web-App Mode
 *
 *		\ingroup templatetags 
 */
function wptouch_the_welcome_message() {
	echo wptouch_get_welcome_message();
}

/*!		\brief Retrieves the welcome message that should be displayed upon first viewing
 *
 *		This function can be used to retrieve the welcome message to be displayed the first time the mobile theme is shown.  The output from this method can
 *		be filtered by the WordPress filter \em wptouch_welcome_message. 
 *
 *		\note The welcome message is currently disabled work in Web-App Mode
 *
 *		\returns A string representing the welcome message
 *
 *		\ingroup templatetags 
 */
function wptouch_get_welcome_message() {
	$settings = wptouch_get_settings();
	return apply_filters( 'wptouch_welcome_message', $settings->welcome_alert );
}

/*!		\brief Echos the 404 message
 *
 *		This function can be used to echo the 404 message retrieved using wptouch_get_404_message().
 *
 *		\note The 404 message is currently only shown in English
 *
 *		\ingroup templatetags 
 */
function wptouch_the_404_message() {
	echo wptouch_get_404_message();
}

/*!		\brief Retrieves the 404 message that is displayed on 404 pages
 *
 *		This function can be used to retrieve the 404 message to be displayed on 404 pages.  The output from this method can
 *		be filtered by the WordPress filter \em wptouch_404_message. 
 *
 *		\returns A string representing the 404 message
 *
 *		\ingroup templatetags 
 */
function wptouch_get_404_message() {
	$settings = wptouch_get_settings();
	return apply_filters( 'wptouch_404_message', $settings->fourohfour_message );
}

/*!		\brief Echos the footer message
 *
 *		This function can be used to echo the footer message retrieved using wptouch_get_the_footer_message(). It also wraps paragraph tags
 *		around the footer message.
 * 
 *		\ingroup templatetags 
 */
function wptouch_the_footer_message() {
	echo '<p>';
	echo wptouch_get_the_footer_message();
	echo '</p>';
}

/*!		\brief Retrieves the footer message
 *
 *		This function can be used to retrieve the footer message.  The message is currently stored in the \em footer_message setting.  The output
 *		of this function can be filtered using the WordPress filter \em wptouch_footer_message.
 * 
 *		\returns A string representing the footer message
 *
 *		\ingroup templatetags 
 */
function wptouch_get_the_footer_message() {
	$settings = wptouch_get_settings();
	return apply_filters( 'wptouch_footer_message', $settings->footer_message );
}

/*!		\brief Echos the URL that will dismiss the Welcome message 
 *
 *		This function can be used to echo the URL that will dismiss the Welcome message.   
 *
 *		\ingroup templatetags 
 */
function wptouch_the_welcome_message_dismiss_url() {
	echo wptouch_get_welcome_message_dismiss_url();
}

/*!		\brief Retrieves the URL that will dismiss the Welcome message 
 *
 *		This function can be used to retrieve the URL that will dismiss the footer message.  Visiting this link via Ajax will set a COOKIE that instructs
 *		the browser not to show the Welcome message again.
 * 
 *		\returns A string representing the Welcome message dismissal URL
 *
 *		\ingroup templatetags 
 */
function wptouch_get_welcome_message_dismiss_url() {
	return apply_filters( 'wptouch_welcome_message_dismiss_url', get_bloginfo( 'url' ) . '?wptouch_pro=dismiss_welcome&amp;redirect=' . $_SERVER['REQUEST_URI'] );
}

/*!		\brief Determines whether or not the Prowl direct message tab should be enabled in themes. 
 *
 *		This function can be used to determine whether or not Prowl direct messages should be enabled in themes.  To enable Prowl direct messages, 
 *		the user must have defined at least one Prowl API key and also have the setting \em push_prowl_direct_messages enabled.
 * 
 *		\returns True if Prowl direct messages are enabled, otherwise false
 *
 *		\ingroup templatetags 
 *		\ingroup prowl
 */
function wptouch_prowl_direct_message_enabled() {
	$settings = wptouch_get_settings();
	return( count( $settings->push_prowl_api_keys ) && $settings->push_prowl_direct_messages );	
}

/*!		\brief Determines whether or not a Prowl direct message was recently sent 
 *
 *		This function can be used to determine whether or not a Prowl direct message was recently sent.  It can be used to show the
 *		result of that operation.
 * 
 *		\returns True if Prowl direct messages was recently sent, otherwise false
 *
 *		\ingroup templatetags 
 *		\ingroup prowl
 */
function wptouch_prowl_tried_to_send_message() {
	global $wptouch_pro;
	return $wptouch_pro->prowl_tried_to_send_message;
}

/*!		\brief Determines whether or not the recently sent Prowl direct message was sent successfully 
 *
 *		This function can be used to determine whether or not the recently sent Prowl direct message was sent successfully.
 * 
 *		\returns True if Prowl direct messages was successfully sent, otherwise false
 *
 *		\ingroup templatetags 
 *		\ingroup prowl
 */
function wptouch_prowl_message_succeeded() {
	global $wptouch_pro;
	return $wptouch_pro->prowl_message_succeeded;	
}


/*!		\brief Echos the comment/pingback/trackback count for the current post
 *
 *		This function can be used to echo the comment/pingback/trackback count for the current post.
 *
 *		\ingroup templatetags 
 */
function wptouch_the_comment_count() {
	echo wptouch_get_comment_count();	
}

/*!		\brief Retrieves the comment/pingback/trackback count for the current post
 *
 *		This function can be used to determine the comment/pingback/trackback count for the current post.
 * 
 *		\returns The comment/pingback/trackback count, or 0 if not comments/pingbacks/trackbacks.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_comment_count() {
	global $wpdb;
	global $post;
	
	$sql = $wpdb->prepare( "SELECT count(*) AS c FROM {$wpdb->comments} WHERE comment_approved = 1 AND comment_post_ID = %d", $post->ID );
	$result = $wpdb->get_row( $sql );
	if ( $result ) {
		return $result->c;
	} else {
		return 0;	
	}	
}

/*!		\brief Echos an ordered category list
 *
 *		This function can be used to echo an ordered category list.  This function is used internally in the category listings in the Classic theme header/popover sections. $num passed to the function determines the minimum number of posts a category must have to be shown.
 *
 *		\ingroup templatetags 
 */
function wptouch_ordered_cat_list( $num ) {
	global $wpdb;

	$settings = wptouch_get_settings();

	if (  $settings->classic_excluded_categories != 0 ) {
		$excluded_cats =  $settings->classic_excluded_categories;
	} else {
		$excluded_cats = 0;	
	}

	echo '<ul>';
	$sql = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}term_taxonomy INNER JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id WHERE taxonomy = 'category' AND {$wpdb->prefix}term_taxonomy.term_id NOT IN ($excluded_cats) AND count >= 1 ORDER BY count DESC LIMIT 0, $num");

	if ( $sql ) {
		foreach ( $sql as $result ) {
			if ( $result ) {
				echo "<li><a href=\"" . get_category_link( $result->term_id ) . "\">" . $result->name . " <span>(" . $result->count . ")</span></a></li>";			
			}
		}
	}
	echo '</ul>';
}

/*!		\brief Echos an ordered tag list
 *
 *		This function can be used to echo an ordered tag list.  This function is used internally in the tag listings in the Classic theme header/popover sections. $num passed to the function determines the minimum number of posts a tag must have to be shown.
 *
 *		\ingroup templatetags 
 */
function wptouch_ordered_tag_list( $num ) {
	global $wpdb;

	$settings = wptouch_get_settings();

	if (  $settings->classic_excluded_tags != 0 ) {
		$excluded_tags =  $settings->classic_excluded_tags;
	} else {
		$excluded_tags = 0;	
	}

	echo '<ul>';
		
	$sql = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}term_taxonomy INNER JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id = {$wpdb->prefix}terms.term_id WHERE taxonomy = 'post_tag' AND {$wpdb->prefix}term_taxonomy.term_id NOT IN ($excluded_tags) AND count >= 1 ORDER BY count DESC LIMIT 0, $num");	

	if ( $sql ) {
		foreach ( $sql as $result ) {
			if ( $result ) {
				echo "<li><a href=\"" . get_tag_link( $result->term_id ) . "\">" . $result->name . " <span>(" . $result->count . ")</span></a></li>";			
			}
		}
	}
	echo '</ul>';
}


/*!		\brief Echos the URL for the currently displayed page
 *
 *		This function can be used to echo the URL for the currently displayed page.
 *
 *		\ingroup templatetags 
 */
function wptouch_the_current_page_url() {
	echo wptouch_get_current_page_url();
}

/*!		\brief Retrieves the URL for the currently displayed page
 *
 *		This function can be used to retrieve the URL for the currently displayed page.
 *
 *		\returns The current page URL
 *
 *		\ingroup templatetags 
 */
function wptouch_get_current_page_url() {
	return apply_filters( 'wptouch_current_page_url', $_SERVER['REQUEST_URI'] );	
}
