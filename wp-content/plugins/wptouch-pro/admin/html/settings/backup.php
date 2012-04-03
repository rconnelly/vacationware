<textarea rows="5" class="textarea" readonly>
<?php
	$settings = wptouch_get_settings();
	
	if ( function_exists( 'gzcompress' ) ) {
		echo wptouch_get_encoded_backup_string( $settings );
	}
?>
</textarea>