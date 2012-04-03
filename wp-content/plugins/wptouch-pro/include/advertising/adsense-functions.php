<?php

function wptouch_read_global( $var ) {
	return isset( $_SERVER[$var] ) ? $_SERVER[$var]: '';
}

function wptouch_google_append_url( &$url, $param, $value ) {
	$url .= '&' . $param . '=' . urlencode($value);
}

function wptouch_google_append_globals( &$url, $param ) {
	wptouch_google_append_url( $url, $param, $GLOBALS['google'][$param] );
}

function wptouch_google_append_color( &$url, $param ) {
	global $google_dt;
	
	$color_array = split(',', $GLOBALS['google'][$param]);
	wptouch_google_append_url($url, $param, $color_array[$google_dt % sizeof($color_array)]);
}

function wptouch_google_set_screen_res() {
	$screen_res = wptouch_read_global( 'HTTP_UA_PIXELS' );
	if ( $screen_res == '' ) {
		$screen_res = wptouch_read_global( 'HTTP_X_UP_DEVCAP_SCREENPIXELS' );
	}
	
	if ( $screen_res == '' ) {
		$screen_res = wptouch_read_global( 'HTTP_X_JPHONE_DISPLAY' );
	}
	
	$res_array = split( '[x,*]', $screen_res );
	if ( sizeof( $res_array ) == 2 ) {
		$GLOBALS['google']['u_w'] = $res_array[0];
		$GLOBALS['google']['u_h'] = $res_array[1];
	}
}

function wptouch_google_set_muid() {
	$muid = wptouch_read_global( 'HTTP_X_DCMGUID' );
	if ( $muid != '' ) {
		$GLOBALS['google']['muid'] = $muid;
	}
	$muid = wptouch_read_global( 'HTTP_X_UP_SUBNO' );
	
	if ( $muid != '' ) {
		$GLOBALS['google']['muid'] = $muid;
	}
	$muid = wptouch_read_global( 'HTTP_X_JPHONE_UID' );
	
	if ( $muid != '' ) {
		$GLOBALS['google']['muid'] = $muid;
	}
	$muid = wptouch_read_global( 'HTTP_X_EM_UID' );
	
	if ( $muid != '' ) {
		$GLOBALS['google']['muid'] = $muid;
	}
}

function wptouch_google_set_via_and_accept() {
	$ua = wptouch_read_global( 'HTTP_USER_AGENT' );
	if ( $ua == '' ) {
		$GLOBALS['google']['via'] = wptouch_read_global( 'HTTP_VIA' );
		$GLOBALS['google']['accept'] = wptouch_read_global( 'HTTP_ACCEPT' );
	}
}

function wptouch_google_get_ad_url() {
	$google_ad_url = 'http://pagead2.googlesyndication.com/pagead/ads?';
	wptouch_google_append_url( $google_ad_url, 'dt', round(1000 * array_sum(explode(' ', microtime()))) );
	
	foreach ( $GLOBALS['google'] as $param => $value ) {
		if ( $param == 'client' ) {
			wptouch_google_append_url( $google_ad_url, $param, 'ca-mb-' . $GLOBALS['google'][$param] );
		} else if ( strpos( $param, 'color_' ) === 0 ) {
			wptouch_google_append_color( $google_ad_url, $param );
		} else if (strpos( $param, 'url' ) === 0) {
			$google_scheme = ( $GLOBALS['google']['https'] == 'on' ) ? 'https://' : 'http://';
			wptouch_google_append_url( $google_ad_url, $param, $google_scheme . $GLOBALS['google'][$param] );
		} else {
			wptouch_google_append_globals( $google_ad_url, $param );
		}
	}
	return $google_ad_url;
}

function wptouch_get_google_ad( $adsense_id, $adsense_channel = false ) {
	$GLOBALS['google']['ad_type'] = 'text';

	$GLOBALS['google']['client'] = $adsense_id;	
	if ( $adsense_channel ) {
		$GLOBALS['google']['channel'] = $adsense_channel;
	}
	
	$GLOBALS['google']['format'] = 'mobile_single';
	$GLOBALS['google']['https'] = wptouch_read_global('HTTPS');
	$GLOBALS['google']['ip'] = wptouch_read_global('REMOTE_ADDR');
	$GLOBALS['google']['markup'] ='chtml';
	$GLOBALS['google']['oe'] ='utf8';
	$GLOBALS['google']['output'] ='chtml';
	$GLOBALS['google']['ref'] = wptouch_read_global('HTTP_REFERER');
	$GLOBALS['google']['url'] = wptouch_read_global('HTTP_HOST') . read_global('REQUEST_URI');
	$GLOBALS['google']['useragent'] = wptouch_read_global('HTTP_USER_AGENT');
	
	$google_dt = time();
	
	wptouch_google_set_screen_res();
	wptouch_google_set_muid();
	wptouch_google_set_via_and_accept();	
		
	$advertisement = '';
	
	$google_ad_handle = @fopen( wptouch_google_get_ad_url(), 'r' );	
	if ( $google_ad_handle ) {
		while ( !feof( $google_ad_handle ) ) {
			$advertisement = $advertisement . fread( $google_ad_handle, 8192 );
		}
		
		fclose( $google_ad_handle );		
	}
	
	return $advertisement;
}
