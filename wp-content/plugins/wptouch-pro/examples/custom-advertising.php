add_filter( 'wptouch_advertising_types', 'my_advertising' );

function my_advertising( $supported_types ) {
	$supported_types[] = 'My New Advertising Type';		
	return $supported_types;
}

add_action( 'wptouch_advertising_my_advertising', 'my_advertising_output' );

function my_advertising_output() {
	echo '<script type="text/javascript" src="http://myads.com/ad.js"></script>';	
}