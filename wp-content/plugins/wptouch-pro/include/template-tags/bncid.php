<?php

function wptouch_has_license() {
	// Move this internally
	global $wptouch_pro;
	$settings = $wptouch_pro->get_settings();
	
	if ( time() > ( $settings->last_bncid_time + WPTOUCH_BNCID_CACHE_TIME ) ) {
		$result = $wptouch_pro->bnc_api->internal_check_token();	
		if ( $result ) {
			$settings->last_bncid_time = time();
			$settings->last_bncid_result = $wptouch_pro->bnc_api->verify_site_license( 'wptouch-pro' );
			$settings->last_bncid_licenses = $wptouch_pro->bnc_api->get_total_licenses( 'wptouch-pro' );
			
			if ( $settings->last_bncid_result ) {
				$setting->bncid_had_license = true;	
			}
		} else {
			$settings->last_bncid_time = 0;
			$settings->last_bncid_result = false;			
			$settings->last_bncid_licenses = 0;
		}		
			
		$wptouch_pro->save_settings( $settings );		
	}
	
	return $settings->last_bncid_result;
}

function wptouch_was_username_invalid() {
	global $wptouch_pro;
	
	return ( $wptouch_pro->bnc_api->get_response_code() == 408 );
}

function wptouch_user_has_no_license() {
	global $wptouch_pro;
	
	return ( $wptouch_pro->bnc_api->get_response_code() == 412 );	
}

function wptouch_credentials_invalid() {
	global $wptouch_pro;
	return $wptouch_pro->bnc_api->credentials_invalid;
}

function wptouch_api_server_down() {
	global $wptouch_pro;
	
	$wptouch_pro->bnc_api->verify_site_license( 'wptouch-pro' );	
	return $wptouch_pro->bnc_api->server_down;
}

function wptouch_has_proper_auth() {
	wptouch_has_license();
	
	$settings = wptouch_get_settings();
	return $settings->last_bncid_licenses;
}

function wptouch_is_upgrade_available() {
	global $wptouch_pro;
	
	if ( WPTOUCH_PRO_BETA ) {
		$latest_info = $wptouch_pro->bnc_api->get_product_version( 'wptouch-pro', true );
		if ( $latest_info ) {
			return ( $latest_info['version'] != WPTOUCH_VERSION );
		} else {
			return false;	
		}
	} else {
		$latest_info = $wptouch_pro->bnc_api->get_product_version( 'wptouch-pro' );	
		if ( $latest_info && !strpos( WPTOUCH_VERSION, 'b' ) ) {
			return ( $latest_info['version'] != WPTOUCH_VERSION );
		} else {
			return false;	
		}	
	}
}

global $wptouch_site_license;
global $wptouch_site_license_info;
global $wptouch_site_license_iterator;
$wptouch_site_license_iterator = false;

function wptouch_has_site_licenses() {
	global $wptouch_pro;
	global $wptouch_site_license_info;	
	global $wptouch_site_license_iterator;
	
	if ( !$wptouch_site_license_iterator ) {
		$wptouch_site_license_info = $wptouch_pro->bnc_api->user_list_licenses( 'wptouch-pro' );
		$wptouch_site_license_iterator = new WPtouchArrayIterator( $wptouch_site_license_info['licenses'] );
	}	
	
	return $wptouch_site_license_iterator->have_items();
}

function wptouch_the_site_license() {
	global $wptouch_site_license;
	global $wptouch_site_license_iterator;
	
	$wptouch_site_license = $wptouch_site_license_iterator->the_item();
}

function wptouch_the_site_licenses_remaining() {
	echo wptouch_get_site_licenses_remaining();
}

function wptouch_get_site_licenses_remaining() {
	global $wptouch_site_license_info;	
		
	if ( $wptouch_site_license_info && isset( $wptouch_site_license_info['remaining'] ) ) {
		return $wptouch_site_license_info['remaining'];
	}
	
	return 0;
}

function wptouch_get_site_licenses_in_use() {
	global $wptouch_site_license_info;	
	
	if ( $wptouch_site_license_info && isset( $wptouch_site_license_info['licenses'] ) && is_array( $wptouch_site_license_info['licenses'] ) ) {
		return count( $wptouch_site_license_info['remaining'] );
	}
	
	return 0;	
}

function wptouch_the_site_license_name() {
	echo wptouch_get_site_license_name();
}

function wptouch_get_site_license_name() {
	global $wptouch_site_license;
	return $wptouch_site_license;
}

function wptouch_is_licensed_site() {
	global $wptouch_pro;
	return $wptouch_pro->has_site_license();
}

function wptouch_get_site_license_number() {
	global $wptouch_site_license_iterator;
	return $wptouch_site_license_iterator->current_position();
}

function wptouch_can_delete_site_license() {
	return ( wptouch_get_site_license_number() > 1 );	
}

$wptouch_license_reset_info = false;

function wptouch_can_do_license_reset() {
	global $wptouch_license_reset_info;
	global $wptouch_pro;
	
	$wptouch_license_reset_info = $wptouch_pro->bnc_api->get_license_reset_info( 'wptouch-pro' );
	if ( isset( $wptouch_license_reset_info['can_reset_licenses'] ) ) {
		return $wptouch_license_reset_info['can_reset_licenses'];	
	} else {
		return false;	
	}
}

function wptouch_get_license_reset_days() {
	global $wptouch_license_reset_info;
	
	if ( $wptouch_license_reset_info && isset( $wptouch_license_reset_info['reset_duration_days'] ) ) {
		return $wptouch_license_reset_info['reset_duration_days'];
	}	
	
	return 0;
}

function wptouch_get_license_reset_days_until() {
	global $wptouch_license_reset_info;
	
	if ( $wptouch_license_reset_info && isset( $wptouch_license_reset_info['can_reset_in'] ) ) {
		return $wptouch_license_reset_info['can_reset_in'];
	}	
	
	return 0;	
}
