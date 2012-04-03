<?php

// Template Tags For Menu Functions
require_once( 'wordpress-menu.php' );

/*!		\brief Determines whether or not a theme can show a WPtouch menu.
 *
 *		Most WPtouch themes will have as loop meant to display menu items.  This function can be used to determine whether or not
 *		that loop should execute.  An end-user can disable the menu globally be disabling the menu in the WPtouch administration section.
 *
 *		\returns true if a menu can be shown, false if not.
 *
 *		\ingroup templatetags 
 */
function wptouch_has_menu() {
	global $wptouch_pro;
	$settings = $wptouch_pro->get_settings();
	
	if ( !$settings->disable_menu ) {	
		$menu = locate_template( array( 'menu.php' ) );
		if ( $menu ) {
			return ( file_exists( $menu ) );
		}
	} else {
		return false;	
	}
}	

/*!		\brief Executes the template_file that will display the menu to the end user.
 *
 *		If the global menu is enabled, this function will cause a template file to be executed which ultimately is meant to display that menu.
 *		This function is meant to be used in conjunction with wptouch_has_menu().
 *
 *		\param $template_name The name of the template file to execute. The template file is relative to the end-user's active theme directory.
 *
 *		\ingroup templatetags 
 */
function wptouch_show_menu( $template_name = false ) {
	global $wptouch_menu_items;
	global $wptouch_menu_iterator;
	
	$wptouch_menu_items = array();
	
		
	if ( !$template_name ) {
		wptouch_build_menu_tree( 0, 1, $wptouch_menu_items, true );	
		
		$wptouch_menu_items = apply_filters( 'wptouch_menu_items', $wptouch_menu_items );
		$wptouch_menu_iterator = new WPtouchArrayIterator( $wptouch_menu_items );	
			
		wptouch_do_template( 'menu.php' );
	} else {
		wptouch_build_menu_tree( 0, 1, $wptouch_menu_items );	
		
		$wptouch_menu_items = apply_filters( 'wptouch_menu_items', $wptouch_menu_items );
		$wptouch_menu_iterator = new WPtouchArrayIterator( $wptouch_menu_items );
		
		include( $template_name );	
	}
}

/*!		\brief Echos the currently selected site icon.
 *
 *		This function echos the currently selected site icon.  Internally this function calls wptouch_get_site_icon().
 *
 *		\ingroup templatetags 
 */
function wptouch_site_icon() {
	echo wptouch_get_site_icon();
}

/*!		\brief Returns the currently selected site icon.
 *
 *		The currently selected site icon can be determined using this function. The result of this function can be filtered using
 *		the WordPress filter wptouch_site_icon.
 *
 *		\returns The currently selected site icon
 *
 *		\ingroup templatetags 
 */
function wptouch_get_site_icon() {
	global $wptouch_pro;
	$settings = $wptouch_pro->get_settings();
		
	return apply_filters( 'wptouch_site_icon', wptouch_get_site_menu_icon( WPTOUCH_ICON_HOME ) );	
}

/*!		\brief Used to determine whether or not a given page has any children
 *
 *		This function can be used to determine whether or not a given page has any children associated with it.
 *
 *		\param $id The page ID to check
 *
 *		\returns true if the page has children, false if not
 *
 *		\ingroup templatetags 
 */
function wptouch_page_has_children( $id ) {
	global $wpdb;	
	
	$sql = "SELECT * FROM {$wpdb->posts} WHERE post_type = 'page' AND post_parent = $id AND post_status = 'publish' ORDER BY menu_order";
	$pages = $wpdb->get_results( $sql );	
	
	return count( $pages );
}

/*!		\brief Creates a menu item from a list of parameters
 *
 *		This function creates the main menu item data-structure.
 *
 *		\param $page_id The page ID for the menu item
 *		\param $depth The depth for the menu item
 *		\param $title The title for the menu item
 *		\param $item_type The type of the menu item (i.e. link, submenu)
 *		\param $has_children Set to true when the menu item has children
 *		\param $post_parent The parent's page ID, or 0 if the item doesn't have a parent
 *		\param $duplicate_link Set to true if the item is a duplicate link, used on submenus that are also clickable
 *		\param $item_link The link to the menu item if $item_type is a link
 *
 *		\returns a data structure representing the menu item
 *
 *		\internal
 */
function wptouch_create_menu_item( 
	$page_id, 
	$depth, 
	$title, 
	$item_type, 
	$has_children, 
	$post_parent, 
	$duplicate_link, 
	$item_link, 
	$item_class = false, 
	$original_id = false 
) {

	global $wptouch_pro;
	
	$menu_item = new stdClass;
	
	$menu_item->page_id = $page_id;
	$menu_item->depth = $depth;
	$menu_item->title = $title;
	$menu_item->item_type = $item_type;
	$menu_item->has_children = $has_children;
	$menu_item->post_parent = $post_parent;
	$menu_item->duplicate_link = $duplicate_link;
	$menu_item->item_link = $wptouch_pro->convert_to_internal_url( $item_link );	
	$menu_item->item_class = $item_class;		
	
	if ( $original_id ) {
		$menu_item->original_id = $original_id;	
	}
	
	return $menu_item;
}

function wptouch_should_cache_menu_items( $parent, $depth ) {
	$settings = wptouch_get_settings();
	if ( !$settings->cache_menu_tree ) {
		return false;	
	} else {
		return ( $parent == 0 && $depth == 1 );	
	}
}

function wptouch_set_menu_cache( $exclude_disabled, $data ) {
	$menu_data = new stdClass;
	$menu_data->data = $data;
	$menu_data->save_time = time();
			
	if ( $exclude_disabled ) {
		update_option( 'wptouch_pro_menu_cache_1', $menu_data );
	} else {
		update_option( 'wptouch_pro_menu_cache_0', $menu_data );
	}
}	

function wptouch_get_menu_cache_data( $exclude_disabled ) {
	if ( $exclude_disabled ) {
		$menu_data = get_option( 'wptouch_pro_menu_cache_1' );
	} else {
		$menu_data = get_option( 'wptouch_pro_menu_cache_0' );
	}
	
	if ( is_object( $menu_data ) ) {
		$cache_expires_time = $menu_data->save_time + wptouch_get_menu_cache_time();
		if ( time() < $cache_expires_time ) {
			return $menu_data->data;
		}
	} 
	
	return false;	
}

function wptouch_menu_cache_flush() {
	update_option( 'wptouch_pro_menu_cache_0', false );
	update_option( 'wptouch_pro_menu_cache_1', false );
}
	
function wptouch_get_menu_cache_time() {
	$settings = wptouch_get_settings();
	
	return apply_filters( 'wptouch_menu_cache_time', $settings->cache_time );	
}

/*!		\brief Builds the entire menu tree.
 *
 *		This function is called recursively to generate the entire menu tree.  
 *
 *		\param $parent The parent for the current depth, or 0 if the root
 *		\param $depth The current depth of the tree, or 1 if it is the root
 *		\param $data The output data for the menu
 *
 *		\internal
 */
function wptouch_build_menu_tree( $parent = 0, $depth = 1, &$data, $exclude_disabled = false ) {
	global $wpdb;
	global $wptouch_pro;
	
	if ( wptouch_should_cache_menu_items( $parent, $depth ) ) {
		$menu_data = wptouch_get_menu_cache_data( $exclude_disabled );
		if ( $menu_data ) {
			$data = $menu_data;
			return;	
		}
	}
	
	$settings = $wptouch_pro->get_settings();
	
	if ( $settings->custom_menu_name != 'none' ) {
		@wptouch_build_wordpress_menu_tree( $parent, $depth, $data, $exclude_disabled );
	} else {
		if ( $settings->menu_sort_order == 'alpha' ) {
			$sql = "SELECT * FROM {$wpdb->posts} WHERE post_type = 'page' AND post_parent = $parent AND post_status = 'publish' ORDER BY post_title";
		} else {
			$sql = "SELECT * FROM {$wpdb->posts} WHERE post_type = 'page' AND post_parent = $parent AND post_status = 'publish' ORDER BY menu_order";
		}
		
		$pages = $wpdb->get_results( $sql );
		if ( $pages ) {
			if ( $parent ) {
				$page = get_post( $parent );
				
				$menu_options = new stdClass;
				$menu_options->page_id = $parent;
				$menu_options->depth = $depth;
				$menu_options->title = $page->post_title;
				$menu_options->item_type = 'link';
				$menu_options->has_children = false;
				$menu_options->post_parent = $parent;
				$menu_options->duplicate_link = true;
				$menu_options->item_link = $wptouch_pro->convert_to_internal_url( get_permalink( $parent ) );
				$menu_options->item_class = $wptouch_pro->get_class_for_webapp_ignore( $menu_options->item_link );
				
				$data[ $page->ID ] = $menu_options;	
			}
			
			foreach( $pages as $page ) {
				if ( $exclude_disabled ) {
					if ( isset( $settings->disabled_menu_items[ $page->ID ] ) ) {
						continue;	
					}	
				}
				
				$menu_options = new stdClass;
				$menu_options->title = $page->post_title;
				$menu_options->depth = $depth;
				$menu_options->page_id = $page->ID;
				if ( $parent ) {
					$menu_options->post_parent = $parent;	
				}
				
				if ( wptouch_page_has_children( $page->ID ) ) {
					$menu_options->item_type = 'menu';
					$menu_options->has_children = true;
					$submenu = array();
					
					wptouch_build_menu_tree( $page->ID, $depth + 1, $submenu, $exclude_disabled );
					
					if ( count( $submenu ) == 1 ) {
						$menu_options->item_type = 'link';
						$menu_options->has_children = false;
						$menu_options->item_link = $wptouch_pro->convert_to_internal_url( get_permalink( $page->ID ) );
						$menu_options->item_class = $wptouch_pro->get_class_for_webapp_ignore( $menu_options->item_link );
					} else {
						$menu_options->submenu = $submenu;
					}
				} else {
					$menu_options->item_type = 'link';
					$menu_options->has_children = false;
					$menu_options->item_link = $wptouch_pro->convert_to_internal_url( get_permalink( $page->ID ) );
					$menu_options->item_class = $wptouch_pro->get_class_for_webapp_ignore( $menu_options->item_link );
				}
				
				$data[ $page->ID ] = $menu_options;	
			}	
		}		
	}
	
	if ( wptouch_should_cache_menu_items( $parent, $depth ) ) {
		wptouch_set_menu_cache( $exclude_disabled, $data );
	}
}

/*!		\brief Used to determine if there are menu items to display.
 *
 *		This function can be used to there are menu items that need to be displayed.  This function should be used in a loop
 *		along with wptouch_the_menu_item().
 *
 *		\returns true if there are menu items to show, or false otherwise.
 *
 *		\ingroup templatetags 
 */
function wptouch_has_menu_items() {
	global $wptouch_menu_iterator;
	return $wptouch_menu_iterator->have_items();
}

/*!		\brief Used in the menu loop to populate the menu item data structure.
 *
 *		This function should be called in the main menu loop to populate the menu item data structure on each iteration.  
 *		Failure to call this function will cause an inf.e loop.
 *
 *		\ingroup templatetags 
 */
function wptouch_the_menu_item() {
	global $wptouch_menu_iterator;
	global $wptouch_menu_item;
	
	$wptouch_menu_item = $wptouch_menu_iterator->the_item();	
}

/*!		\brief Used in the menu loop to determine whether a menu item has children
 *
 *		This function should be called in the main menu loop to determine if a menu item has children.  This function is usually used
 *		in conjunction with wptouch_show_children().
 *
 *		\ingroup templatetags 
 */
function wptouch_menu_has_children() {	
	global $wptouch_menu_item;
	return $wptouch_menu_item->has_children;
}

/*!		\brief Used in the menu loop to display a sub-menu template.
 *
 *		This function should be called in the main menu loop to display a sub-menu template. This function is usually used
 *		in conjunction with wptouch_menu_has_children().
 *
 *		\param $template_name The name of the template file that should be used to display the sub-menu
 *		\param $absolute_path Indicates whether or not the $template_name represents an absolute path or not
 *
 *		\ingroup templatetags 
 */
function wptouch_show_children( $template_name, $absolute_path = false ) {
	global $wptouch_menu_item;	
	global $wptouch_menu_items;
	global $wptouch_menu_iterator;
	
	// save old items
	$old_items = $wptouch_menu_items;
	$old_iterator = $wptouch_menu_iterator;
	
	$wptouch_menu_items = $wptouch_menu_item->submenu;
	$wptouch_menu_iterator = new WPtouchArrayIterator( $wptouch_menu_items );
	
	if ( $absolute_path ) {
		include( $template_name );
	} else {
		wptouch_do_template( $template_name );
	}
	
	// restore state of old items
	$wptouch_menu_items = $old_items;
	$wptouch_menu_iterator = $old_iterator;	
}

/*!		\brief Echos the menu title.
 *
 *		This function echos the menu title, and internally calls wptouch_the_menu_item_title().   
 *
 *		\ingroup templatetags 
 */
function wptouch_the_menu_item_title() {
	echo wptouch_get_menu_item_title();
}

/*!		\brief Used to get the menu title.
 *
 *		This function returns the menu title.  To filter the result, implement the WordPress filter \em wptouch_menu_item_title.
 *
 *		\returns The title for the menu item.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_menu_item_title() {
	global $wptouch_menu_item;	
	return apply_filters( 'wptouch_menu_item_title', $wptouch_menu_item->title );
}

/*!		\brief Echos the menu item link.
 *
 *		This function echos the menu item link, and internally calls wptouch_get_menu_item_link().   
 *
 *		\ingroup templatetags 
 */
function wptouch_the_menu_item_link() {
	echo wptouch_get_menu_item_link();
}

/*!		\brief Used to get the menu item link.
 *
 *		This function returns the menu item link.  To filter the result, implement the WordPress filter \em wptouch_menu_item_link.
 *
 *		\returns The title for the menu item link.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_menu_item_link() {
	global $wptouch_menu_item;	
	
	if ( isset( $wptouch_menu_item->item_link ) ) {
		return apply_filters( 'wptouch_menu_item_link', $wptouch_menu_item->item_link );	
	}
}

/*!		\brief Echos the menu item page or post ID.
 *
 *		This function echos the menu item post or page ID, and internally calls wptouch_get_menu_id().   
 *
 *		\ingroup templatetags 
 */
function wptouch_the_menu_id() {
	echo wptouch_get_menu_id();
}

/*!		\brief Used to get the menu item page or post ID.
 *
 *		This function returns the menu item page or post ID.  To filter the result, implement the WordPress filter \em wptouch_menu_id.
 *
 *		\returns The title for the menu item page or post ID.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_menu_id() {
	global $wptouch_menu_item;
	
	return apply_filters( 'wptouch_menu_id', $wptouch_menu_item->page_id );		
}

/*!		\brief Used to determine whether or not icons should be displayed or not.
 *
 *		This function should be used in a theme to determine whether or not menu icons should be displayed.  
 *
 *		\returns true if menu icons should be shown, otherwise false
 *
 *		\ingroup templatetags 
 */
function wptouch_can_show_menu_icons() {
	global $wptouch_pro;
	
	$settings = $wptouch_pro->get_settings();
	return $settings->enable_menu_icons;	
}

function wptouch_the_menu_icon() {
	echo wptouch_get_menu_icon();
}

/*!		\brief Used to get the URL for the current menu item icon.
 *
 *		This function returns a URL to the current menu item's icon.  If the user hasn't selected an icon, it will return a URL to the default
 *		icon.  
 *
 *		\returns The title for the menu item page or post ID.
 *
 *		\ingroup templatetags 
 */
function wptouch_get_menu_icon() {
	global $wptouch_pro;
	$settings = $wptouch_pro->get_settings();

	if ( isset( $settings->menu_icons[ wptouch_get_menu_id() ] ) ) {
		return bnc_wptouch_sslize( WP_CONTENT_URL . $settings->menu_icons[ wptouch_get_menu_id() ] );
	} else {
		return wptouch_get_site_menu_icon( wptouch_get_menu_id() );	
	}
}

/*!		\brief Used to determine whether or not a menu item is disabled.
 *
 *		This function can be used to determine whether or not a menu item is disabled or not.  Disabled menu items are usually not shown.
 *
 *		\returns true if a menu item is disabled, otherwise false
 *
 *		\ingroup templatetags 
 */
function wptouch_menu_is_disabled() {
	global $wptouch_menu_item;
	global $wptouch_pro;
	
	$settings = $wptouch_pro->get_settings();
	
	return isset( $settings->disabled_menu_items[ wptouch_get_menu_id() ] );	
}

/*!		\brief Echos the current depth of a menu item
 *
 *		This function can be used to echo the current depth of a menu item.  Internally this function calls wptouch_get_menu_depth().
 *
 *		\ingroup templatetags 
 */	
function wptouch_the_menu_depth() {
	echo wptouch_get_menu_depth();
}
	
/*!		\brief Used to determine the current depth of a menu item
 *
 *		This function can be used to determine the current depth of a menu item.  
 *
 *		\returns The current menu item depth, i.e. 1, 2, 3, etc.
 *
 *		\ingroup templatetags 
 */	
function wptouch_get_menu_depth() {
	global $wptouch_menu_item;
	return $wptouch_menu_item->depth;
}

/*!		\brief Used to determine whether or not a menu item is a duplicate.
 *
 *		This function can be used to determine whether or not a menu item is a duplicate.  A duplicate menu item is one that 
 *		purposefully appears in the menu tree twice.  
 *
 *		\returns true if a menu item is a duplicate, otherwise false
 *
 *		\ingroup templatetags 
 */
function wptouch_menu_item_duplicate() {
	global $wptouch_menu_item;

	if ( isset( $wptouch_menu_item->duplicate_link ) ) {
		return $wptouch_menu_item->duplicate_link;
	} else {
		return false;
	}
}

/*!		\brief Echos a space-separated list of classes for each menu item.
 *
 *		This function echos a space-separated list of classes that is meant to be used for each menu item.  
 * 		Internally this function calls wptouch_get_menu_item_classes().
 *
 *		\ingroup templatetags 
 */
function wptouch_the_menu_item_classes() {
	echo implode( ' ', wptouch_get_menu_item_classes() );	
}

/*!		\brief Used to obtain a list of classes for each menu item.
 *
 *		This function returns an array of classes to be used for each menu item.  The following classes are added:
 *		\arg \c depth-num - Indicates the current depth of the menu tree, for example depth-2 for the second level
 *		\arg \c id-num - Indicates the page ID for the current menu item, for example id-10 for the page with an ID of 10
 *		\arg \c has_children - Indicates that the item has children beneath it
 *		\arg \c submenu - Indicates that the item is a submenu
 *		\arg \c parent-num - Indicates that the item has a parent with ID of \em num
 *		\arg \c default - Indicates that the icon for the current item is the default icon
 *
 *		\returns An array of classes that can be used for each menu item.  
 *
 *		\ingroup templatetags 
 */
function wptouch_get_menu_item_classes() {
	global $wptouch_menu_item;	
	global $wptouch_pro;
	
	$settings = $wptouch_pro->get_settings();
	
	$menu_classes = array();
	$menu_classes[] = 'depth-' . $wptouch_menu_item->depth;
	
	if ( ((int)$wptouch_menu_item->page_id) < 0 ) {
		$menu_classes[] = 'id-custom-' . -$wptouch_menu_item->page_id;
	} else {
		$menu_classes[] = 'id-' . $wptouch_menu_item->page_id;
	}
	
	if ( $wptouch_menu_item->has_children) {
		$menu_classes[] = 'has_children';
		if ( $wptouch_menu_item->depth > 1 ) {
			$menu_classes[] = 'submenu';	
		}
	}  
	
	if ( isset(  $wptouch_menu_item->post_parent ) && $wptouch_menu_item->post_parent ) {
		$menu_classes[] = 'parent-' . $wptouch_menu_item->post_parent;	
	}
	
	if ( !isset( $settings->menu_icons[ $wptouch_menu_item->page_id ] ) ) {
		$menu_classes[] = 'default';	
	}
	
	$icon_location = wptouch_get_menu_icon();
	$set_info = $wptouch_pro->get_set_with_icon( str_replace( bnc_wptouch_sslize( WP_CONTENT_URL ), WP_CONTENT_DIR, $icon_location ) );
	if ( $set_info && $set_info->dark_background ) {
		$menu_classes[] = 'dark';	
	} 	
	
	if ( isset( $wptouch_menu_item->item_class ) && $wptouch_menu_item->item_class ) {
		$menu_classes[] = $wptouch_menu_item->item_class;	
	}
	
	return apply_filters( 'wptouch_menu_item_classes', $menu_classes );
}


/*!		\brief Echos the URL for one of the static site icons.
 *
 *		Several static icons are pre-defined by WPtouch.  You can use this function to echo the URL for each of them.
 *
 *		\param $icon_type Which icon to retrieve.  Please see wptouch_get_site_menu_icon() for information about this parameter.
 *
 *		\ingroup templatetags 
 */
function wptouch_the_site_menu_icon( $icon_type ) {
	echo wptouch_get_site_menu_icon( $icon_type );
}

/*!		\brief Used to obtain one of the static site icons.
 *
 *		Several static icons are pre-defined by WPtouch.  You can use this function to obtain information about them.
 *
 *		\param $icon_type Which icon to retrieve.  Choices are:
 *		\arg \c WPTOUCH_ICON_HOME - The main site icon
 *		\arg \c WPTOUCH_ICON_BOOKMARK - The main bookmark icon for the homescreen
 *		\arg \c WPTOUCH_ICON_DEFAULT - The default icon to use when the user hasn't selected an icon for a menu item
 *		\arg \c WPTOUCH_ICON_EMAIL - The email icon that is used when email is shown in the menu
 *		\arg \c WPTOUCH_ICON_RSS - The RSS icon that is used when RSS is shown in the menu
 *
 *		\returns The URL for the associated icon
 *
 *		\ingroup templatetags 
 */
function wptouch_get_site_menu_icon( $icon_type ) {
	global $wptouch_pro;
	
	$settings = $wptouch_pro->get_settings();
	if ( isset( $settings->menu_icons[ $icon_type ] ) ) {
		$icon = bnc_wptouch_sslize( WP_CONTENT_URL . $settings->menu_icons[ $icon_type ] );
	} else {
		$site_icons = $wptouch_pro->get_site_icons();
		if ( $site_icons && isset( $site_icons[ $icon_type ] ) ) {	
			$icon = $site_icons[ $icon_type ]->url;
		} else {		
			if ( isset( $settings->menu_icons[ WPTOUCH_ICON_DEFAULT ] ) ) {
				$icon = bnc_wptouch_sslize( WP_CONTENT_URL . $settings->menu_icons[ WPTOUCH_ICON_DEFAULT ] );
			} else {
				$icon = $site_icons[ WPTOUCH_ICON_DEFAULT ]->url;				
			}
		}
	}	
	
	return $icon;
}
