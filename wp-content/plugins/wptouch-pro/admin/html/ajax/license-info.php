<?php 
	$settings = wptouch_get_settings();
	if ( wptouch_theme_supports_ipad() ) {
		if ( $settings->ipad_support === 'full' ) {  
			$ipad_support = '(<a href="pane-active-theme" class="wptouch-admin-switch" rel="ipad-settings">' . __( 'iPad theme ON', "wptouch-pro" ) . '<a/>)'; 
		} else { 
			$ipad_support = '(<a href="pane-active-theme" class="wptouch-admin-switch" rel="ipad-settings">' . __( 'iPad Theme OFF', "wptouch-pro" ) . '<a/>)';
		}
	}	
?>
<ul>
	<li><?php _e( "Active Theme", "wptouch-pro" ); ?>: <span><?php wptouch_bloginfo( 'active_theme_friendly_name' ); ?> <?php if ( wptouch_theme_supports_ipad() ) { echo $ipad_support; } ?></span></li>	
	
	<li>
	<?php if ( wptouch_has_proper_auth() && !$settings->admin_client_mode_hide_licenses ) { ?>	
		<?php if ( wptouch_has_license() ) { ?>
			<?php _e( "Status", "wptouch-pro" ); ?>: <span class="green-text"><?php _e( 'LICENSED', 'wptouch-pro' ); ?></span> | <em><?php _e( "Thank you for supporting us!", "wptouch-pro" ); ?></em>
		<?php } else { ?>
			<?php _e( "Status", "wptouch-pro" ); ?>: <span class="status-unl"><?php _e( 'ACTIVATION REQUIRED', 'wptouch-pro' ); ?></span> | <a href="pane-license" id="status-target-pane-5" class="wptouch-admin-switch" rel="account" class="blue-text"><?php _e( 'Activate a Site License', 'wptouch-pro' ); ?></a>
		<?php } ?>
	<?php } elseif ( !$settings->admin_client_mode_hide_licenses && !wptouch_is_multisite_secondary() ) { ?>
			<?php _e( "Status", "wptouch-pro" ); ?>: <span class="status-unl"><?php _e( 'UNLICENSED', 'wptouch-pro' ); ?></span><?php if ( !wptouch_is_multisite_enabled() || ( wptouch_is_multisite_enabled() && wptouch_is_multisite_primary() ) ) { ?> | <a href="https://www.bravenewcode.com/store/plugins/wptouch-pro/?utm_source=wptouch_pro&utm_medium=web&utm_campaign=admin-purchase" class="green-text" target="_blank"><?php _e( 'Purchase a License', 'wptouch-pro' ); ?></a><?php } ?>
	<?php } ?>
	</li>
</ul>