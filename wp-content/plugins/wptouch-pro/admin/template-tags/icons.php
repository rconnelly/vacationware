<?php

global $wptouch_icon_pack;
global $wptouch_icon_packs_iterator;
$wptouch_icon_packs_iterator = false;

global $wptouch_icon;
global $wptouch_icons_iterator;
$wptouch_icons_iterator = false;

global $wptouch_admin_menu_items;
global $wptouch_admin_menu_iterator;
global $wptouch_admin_menu_item;

$wptouch_admin_menu_items = $wptouch_admin_menu_iterator = $wptouch_admin_menu_item = false;

global $wptouch_site_icons;
global $wptouch_site_icon;
global $wptouch_site_icon_iterator;

$wptouch_site_icons = $wptouch_site_icon = $wptouch_site_icon_iterator = false;


function wptouch_have_icon_packs() {
	global $wptouch_pro;
	global $wptouch_icon_packs_iterator;	
	
	if ( !$wptouch_icon_packs_iterator ) {
		$wptouch_icon_packs = $wptouch_pro->get_available_icon_packs();
		$wptouch_icon_packs_iterator = new WPtouchArrayIterator( $wptouch_icon_packs );
	} 
	
	$has_items = $wptouch_icon_packs_iterator->have_items();
	
	return $has_items;
}

function wptouch_the_icon_pack() {
	global $wptouch_icon_pack;	
	global $wptouch_icon_packs_iterator;	
	
	$wptouch_icon_pack = $wptouch_icon_packs_iterator->the_item();
}

function wptouch_the_icon_pack_name() {
	echo wptouch_get_icon_pack_name();	
}

function wptouch_get_icon_pack_name() {
	global $wptouch_icon_pack;	
	
//	print_r( $wptouch_icon_pack );
	
	return apply_filters( 'wptouch_icon_pack_name', $wptouch_icon_pack->name );		
}

function wptouch_get_icon_pack_author_url() {
	global $wptouch_icon_pack;

	if ( isset( $wptouch_icon_pack->author_url ) ) {
		return $wptouch_icon_pack->author_url;	
	} else {
		return false;	
	}
}

function wptouch_the_icon_pack_author_url() {
	$url = wptouch_get_icon_pack_author_url();
	if ( $url ) {
		echo $url;	
	} 
}

function wptouch_get_icon_pack_dark_bg() {
	global $wptouch_icon_pack;	
	return $wptouch_icon_pack->dark_background;
}


function wptouch_the_icon_pack_desc() {
	echo wptouch_get_icon_pack_desc();
}

function wptouch_get_icon_pack_desc() {
	global $wptouch_icon_pack;
	return apply_filters( 'wptouch_icon_pack_desc', $wptouch_icon_pack->description );		
}

function wptouch_is_icon_set_enabled() {
	global $wptouch_pro;
	global $wptouch_icon_pack;
	
	$settings = $wptouch_pro->get_settings();
	if ( isset( $settings->enabled_icon_packs[ $wptouch_icon_pack->name ] ) ) {
		return true;	
	} else {	
		return false;	
	}
}

function wptouch_the_icon_pack_class_name() {
	echo wptouch_get_icon_pack_class_name();
}

function wptouch_get_icon_pack_class_name() {
	global $wptouch_icon_pack;
	return apply_filters( 'wptouch_icon_pack_class_name', $wptouch_icon_pack->class_name );			
}

function wptouch_have_icons( $set_name ) {
	global $wptouch_icons_iterator;	
	global $wptouch_pro;
	
	if ( !$wptouch_icons_iterator ) {
		$icons = $wptouch_pro->get_icons_from_packs( $set_name );	
		$wptouch_icons_iterator = new WPtouchArrayIterator( $icons );
	}
	
	return $wptouch_icons_iterator->have_items();
}

function wptouch_the_icon() {
	global $wptouch_icon;	
	global $wptouch_icons_iterator;		
	
	$wptouch_icon = $wptouch_icons_iterator->the_item();
	return $wptouch_icon;
}

function wptouch_the_icon_name() {
	echo wptouch_get_icon_name();	
}

function wptouch_get_icon_name() {
	global $wptouch_icon;
	return apply_filters( 'wptouch_icon_name', $wptouch_icon->name );	
}

function wptouch_the_icon_short_name() {
	echo wptouch_get_icon_short_name();	
}

function wptouch_get_icon_short_name() {
	global $wptouch_icon;
	return apply_filters( 'wptouch_icon_short_name', $wptouch_icon->short_name );	
}


function wptouch_the_icon_url() {
	echo wptouch_get_icon_url();	
}

function wptouch_get_icon_url() {
	global $wptouch_icon;
	return apply_filters( 'wptouch_icon_url', $wptouch_icon->url );	
}

function wptouch_the_icon_set() {
	echo wptouch_get_icon_set();
}

function wptouch_get_icon_set() {
	global $wptouch_icon;
	return apply_filters( 'wptouch_icon_set', $wptouch_icon->set );		
}


function wptouch_icon_has_image_size_info() {
	global $wptouch_icon;
	return isset( $wptouch_icon->image_size );	
}

function wptouch_icon_the_width() {
	echo wptouch_icon_get_width();	
}

function wptouch_icon_get_width() {
	global $wptouch_icon;
	return $wptouch_icon->image_size[0];	
}


function wptouch_icon_the_height() {
	echo wptouch_icon_get_height();	
}

function wptouch_icon_get_height() {
	global $wptouch_icon;
	return $wptouch_icon->image_size[1];
}

function wptouch_the_icon_class_name() {
	echo wptouch_get_icon_class_name();
}

function wptouch_get_icon_class_name() {
	global $wptouch_icon;
	return apply_filters( 'wptouch_icon_class_name', $wptouch_icon->class_name );			
}

function wptouch_admin_has_menu_items() {
	global $wptouch_admin_menu_items;
	global $wptouch_admin_menu_iterator;
	
	wptouch_build_menu_tree( 0, 1, $wptouch_admin_menu_items );	
	
	$wptouch_admin_menu_iterator = new WPtouchArrayIterator( $wptouch_menu_items );
	
	return $wptouch_admin_menu_iterator->have_items();
}

function wptouch_admin_the_menu_item() {
	global $wptouch_admin_menu_item;
	global $wptouch_admin_menu_iterator;
	
	if ( $wptouch_admin_menu_iterator ) {
		$wptouch_admin_menu_item = $wptouch_admin_menu_iterator->the_item();
	}
}

function wptouch_has_site_icons() {
	global $wptouch_pro;
	global $wptouch_site_icons;
	global $wptouch_site_icon_iterator;
	
	if ( !$wptouch_site_icons ) {
		$wptouch_site_icons = $wptouch_pro->get_site_icons();
		$wptouch_site_icon_iterator = new WPtouchArrayIterator( $wptouch_site_icons );
	}
	
	return $wptouch_site_icon_iterator->have_items();
}

function wptouch_the_site_icon() {
	global $wptouch_site_icon_iterator;	
	global $wptouch_site_icon;
	
	$wptouch_site_icon = apply_filters( 'wptouch_site_icon', $wptouch_site_icon_iterator->the_item() );	
	return $wptouch_site_icon;
}

function wptouch_the_site_icon_name() {
	echo wptouch_get_site_icon_name();	
}

function wptouch_get_site_icon_name() {
	global $wptouch_site_icon;
	return apply_filters( 'wptouch_site_icon_name', $wptouch_site_icon->name );	
}

function wptouch_the_site_icon_id() {
	echo wptouch_get_site_icon_id();
}

function wptouch_get_site_icon_id() {
	global $wptouch_site_icon;
	return $wptouch_site_icon->id;
}

function wptouch_the_site_icon_icon() {
	echo wptouch_get_site_icon_icon();
}

function wptouch_get_site_icon_icon() {
	global $wptouch_site_icon;
	global $wptouch_pro;
	
	$settings = $wptouch_pro->get_settings();
	if ( isset( $settings->menu_icons[ $wptouch_site_icon->id ] ) ) {
		$icon = bnc_wptouch_sslize( WP_CONTENT_URL . $settings->menu_icons[ $wptouch_site_icon->id ] );
	} else {
		$icon = bnc_wptouch_sslize( WP_CONTENT_URL . $wptouch_site_icon->icon );
	}	
	
	return apply_filters( 'wptouch_site_icon_icon', $icon );
}

function wptouch_the_site_icon_location() {
	echo wptouch_get_site_icon_location();
}

function wptouch_get_site_icon_location() {
	global $wptouch_site_icon;
	global $wptouch_pro;
	
	$settings = $wptouch_pro->get_settings();
	if ( isset( $settings->menu_icons[ $wptouch_site_icon->id ] ) ) {
		$icon = WP_CONTENT_DIR . $settings->menu_icons[ $wptouch_site_icon->id ];
	} else {
		$icon = WP_CONTENT_DIR . $wptouch_site_icon->icon;
	}	
	
	return apply_filters( 'wptouch_site_icon_location', $icon );
}

function wptouch_the_site_icon_classes() {
	echo implode( ' ', wptouch_get_site_icon_classes() );	
}

function wptouch_get_site_icon_classes() {
	global $wptouch_site_icon;	
	
	$classes = array( $wptouch_site_icon->class_name );
	
	return apply_filters( 'wptouch_site_icon_classes', $classes );	
}

function wptouch_site_icon_has_dark_bg() {
	global $wptouch_pro;
	
	$set_info = $wptouch_pro->get_set_with_icon( wptouch_get_site_icon_location() );
	if ( $set_info ) {
		return $set_info->dark_background;	
	} else {
		return false;	
	}
}
