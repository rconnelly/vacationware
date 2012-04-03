<div id="wptouch-admin-profile">
	
	<?php if ( wptouch_has_site_licenses() ) { ?>
		<p><?php _e( "You have activated these sites for automatic upgrades & support:", "wptouch-pro" ); ?></p>
		<ol class="round-3">
			<?php while ( wptouch_has_site_licenses() ) { ?>
				<?php wptouch_the_site_license(); ?>
				<li <?php if ( wptouch_can_delete_site_license() ) { echo 'class="green-text"'; } ?>>
					<?php wptouch_the_site_license_name(); ?> <?php if ( wptouch_can_delete_site_license() ) { ?><a class="wptouch-remove-license" href="#" rel="<?php wptouch_the_site_license_name(); ?>" title="<?php _e( "Remove license?", "wptouch-pro" ); ?>">(x)</a><?php } ?></li>
			<?php } ?>
		</ol>
	<?php } ?>
	<!-- end site licenses -->
		
	<?php if ( wptouch_get_site_licenses_remaining() != BNC_WPTOUCH_UNLIMITED ) { ?>
		<p><?php echo sprintf( __( "%s%d%s license(s) remaining.", "wptouch-pro" ), '<strong>', wptouch_get_site_licenses_remaining(), '</strong>' ); ?></p>
		
		<?php if ( !wptouch_get_site_licenses_remaining() ) { ?>
		 	<p class="inline-button">
		 	<a href="http://www.bravenewcode.com/store/upgrade/?product=wptouch-pro&utm_source=wptouch_pro&utm_medium=web&utm_campaign=admin-upgrades" id="upgrade-license" class="button round-24" target="_blank"><?php _e( "Purchase More Licenses", "wptouch-pro" ); ?></a>
		 	</p>
		<?php } ?>
	<?php } ?>

	<?php if ( wptouch_get_site_licenses_remaining() ) { ?>
		<?php if ( !wptouch_is_licensed_site() ) { ?>
			<p class="red-text"><?php _e( "You have not activated a license for this WordPress installation.", "wptouch-pro" ); ?></p>
			<p class="inline-button">
				<a class="wptouch-add-license round-24 button" class="button" id="partial-activation" href="#">
					<?php _e( "Activate This WordPress installation &raquo;", "wptouch-pro" ); ?>
				</a>
			</p>
		<?php } ?>
	<?php } ?>

	<?php if ( wptouch_get_site_licenses_in_use() ) { ?>
		<?php if ( wptouch_can_do_license_reset() ) { ?>
			<p class="inline-button">
				<a href="#" id="reset-licenses" class="button"><?php _e( "Reset Licenses Now", "wptouch-pro" ); ?></a>
			</p>
			<br /><br />
			<p>
				<small>
					<?php echo sprintf( __( "You can reset all support and auto-upgrade licenses every %d days.", "wptouch-pro" ), wptouch_get_license_reset_days() ); ?>
				</small>
			</p>
		<?php } else { ?>
			<br /><br />
			<p>
				<small>
					<?php echo sprintf( __( "You will be able to reset all licenses again in %d day(s).", "wptouch-pro" ), wptouch_get_license_reset_days_until() ); ?>
				</small>
			</p>
		<?php } ?>	
	<?php } ?>
</div>

<?php
global $wptouch_pro;
$wptouch_pro->bnc_api->verify_site_license( 'wptouch-pro' );
