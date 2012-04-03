<?php if ( wptouch_api_server_down() ) { ?>
	<p class="api-warning round-3"><?php _e( "Oops! The license server could not be reached.", "wptouch-pro" ); ?><br /><?php _e( "Don't worry, it's temporary, and doesn't affect WPtouch Pro from working.", "wptouch-pro" ); ?></p>
<?php } ?>