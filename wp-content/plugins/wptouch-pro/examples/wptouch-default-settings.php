add_filter( 'wptouch_default_settings', 'add_my_defaults' );

function add_my_defaults( $settings ) {
	$settings->my_new_setting = 'some_value';
	
	return $settings;
}

$settings = wptouch_get_settings();

echo $settings->my_new_value;	// will echo some_value