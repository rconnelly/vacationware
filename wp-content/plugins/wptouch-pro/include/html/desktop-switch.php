<?php global $wptouch_pro; ?>
<?php if ( wptouch_show_switch_link() ) { ?>
	<div id="wptouch-desktop-switch">	
		<?php if ( $wptouch_pro->active_device_class == 'ipad' ) { ?>
		<?php _e( "Desktop Version", "wptouch-pro" ); ?> | <a href="<?php wptouch_the_desktop_switch_link(); ?>"><?php _e( "Switch To iPad Version", "wptouch-pro" ); ?></a>
		<?php } else { ?>
		<?php _e( "Desktop Version", "wptouch-pro" ); ?> | <a href="<?php wptouch_the_desktop_switch_link(); ?>"><?php _e( "Switch To Mobile Version", "wptouch-pro" ); ?></a>
		<?php } ?>
	</div>
<?php } ?>
