<?php
	global $wptouch_pro;
	$wptouch_pro->setup_bncapi();
	$wptouch_pro->bnc_api->verify_site_license( 'wptouch-pro' );
	$settings = wptouch_get_settings();
?>

	
<?php if ( wptouch_has_proper_auth() && !$settings->admin_client_mode_hide_licenses ) { ?>
	<?php if ( wptouch_has_license() ) { ?>
	<p class="license-valid round-3"><span><?php _e( 'License accepted, thank you for supporting WPtouch Pro!', 'wptouch-pro' ); ?></span></p>	
	<?php } else { ?>
	<p class="license-partial round-3"><span><?php echo sprintf( __( 'Your Account E-Mail and License Key have been accepted. <br />Next, %sconnect a site license%s to this domain to enable support and automatic upgrades.', 'wptouch-pro' ), '<a href="pane-license" class="wptouch-admin-switch" rel="licenses">', '</a>' ); ?></span></p>
	<?php } ?>
<?php } else { ?>
	<?php if ( wptouch_credentials_invalid() ) { ?>
		<?php if ( wptouch_was_username_invalid() ) { ?>
		<p class="license-invalid bncid-failed round-3"><span><?php echo __( 'The Account E-Mail you have entered is invalid. Please try again.' ); ?></span></p>	
		<?php } else if ( wptouch_user_has_no_license() ) { ?>
		<p class="license-invalid bncid-failed round-3"><span><?php echo __( 'The Account E-Mail you have entered is not associated with a valid license.  Please check your Account E-Mail and try again.' ); ?></span></p>			
		<?php } else { ?>
		<p class="license-invalid bncid-failed round-3"><span><?php echo __( 'This Account E-Mail/License Key combination you have entered was rejected by the BraveNewCode server. Please try again.' ); ?></span></p>	
		<?php } ?>
	<?php } else { ?>
		<p class="license-invalid round-3"><span><?php echo sprintf( __( 'Please enter your Account E-Mail and License Key to begin the license activation process, or %spurchase a license &raquo;%s', 'wptouch-pro' ), '<a href="https://www.bravenewcode.com/store/plugins/wptouch-pro/?utm_source=wptouch_pro&utm_medium=web&utm_campaign=admin-purchase" target="_blank">', '</a>' ); ?></span></p>
	<?php } ?>
<?php } ?>