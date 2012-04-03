<?php global $wptouch_pro; $current_scheme = get_user_option('admin_color'); $settings = wptouch_get_settings(); ?>

<form method="post" action="" id="bnc-form" class="<?php if ( $wptouch_pro->locale ) echo 'locale-' . strtolower( $wptouch_pro->locale ); ?>">
	<div id="bnc" class="<?php echo $current_scheme; ?> <?php if ( WPTOUCH_PRO_BETA ) { echo 'beta'; } else { echo 'normal'; } ?> wrap">
		<?php if ( $settings->developer_mode != 'off' ) { ?>
			<div id="dev-notice"><?php _e( "WPtouch Pro Developer Mode: ON", "wptouch-pro" ); ?></div>
		<?php } ?>
		<div id="wptouch-api-server-check"></div>
		<div id="wptouch-admin-top">
			<h2>
				<?php echo WPTOUCH_PRODUCT_NAME . ' <span class="version">' . WPTOUCH_VERSION; ?></span>
				<?php if ( wptouch_is_upgrade_available() ) { ?>
					<a id="upgrade-link" href="<?php echo admin_url(); ?>plugins.php?plugin_status=upgrade"><?php _e( "Upgrade Available", "wptouch-pro" ); ?> &raquo;</a></li>
				<?php } ?>
			</h2>
			<?php wptouch_save_reset_notice(); ?>
		</div>		
			
		<div id="wptouch-admin-form">		
			<ul id="wptouch-top-menu">
			
				<?php do_action( 'wptouch_pre_menu' ); ?>
				
				<?php $pane = 1; ?>
				<?php foreach( $wptouch_pro->tabs as $name => $value ) { ?>
					<li><a id="pane-<?php echo $pane; ?>" class="pane-<?php echo wptouch_string_to_class( $name ); ?>" href="#"><?php echo $name; ?></a></li>
					<?php $pane++; ?>
				<?php } ?>
		
				<?php do_action( 'wptouch_post_menu' ); ?>
				
				<li>
					<div class="wptouch-ajax-results blue-text" id="ajax-loading" style="display:none"><?php _e( "Loading...", "wptouch-pro" ); ?></div>
					<div class="wptouch-ajax-results blue-text" id="ajax-saving" style="display:none"><?php _e( "Saving...", "wptouch-pro" ); ?></div>
					<div class="wptouch-ajax-results green-text" id="ajax-saved" style="display:none"><?php _e( "Done", "wptouch-pro" ); ?></div>
					<div class="wptouch-ajax-results red-text" id="ajax-fail" style="display:none"><?php _e( "Oops! Try saving again.", "wptouch-pro" ); ?></div>
					<br class="clearer" />
				</li>
			</ul>
					
			<div id="wptouch-tabbed-area"  class="round-3 <?php if ( wptouch_get_bloginfo( 'support_licenses_total' ) >= 5 ){ echo 'developer'; } if ( $settings->admin_client_mode_hide_tools ) { echo ' client-mode'; } ?>">
				<?php wptouch_show_tab_settings(); ?>
			</div>
			
			<br class="clearer" />
			
			<input type="hidden" name="wptouch-admin-tab" id="wptouch-admin-tab" value="" />
			<input type="hidden" name="wptouch-admin-menu" id="wptouch-admin-menu" value="" />
		</div>
		<input type="hidden" name="wptouch-admin-nonce" value="<?php echo wp_create_nonce( 'wptouch-post-nonce' ); ?>" />

		<p class="submit" id="bnc-submit">
			<input class="button-primary" type="submit" name="wptouch-submit" tabindex="1" value="<?php _e( "Save Changes", "wptouch-pro" ); ?>" />
		</p>
		
		<p class="submit" id="bnc-submit-reset">
			<input class="button" type="submit" name="wptouch-submit-reset" tabindex="2" value="<?php _e( "Reset Settings", "wptouch-pro" ); ?>" />
			<span id="saving-ajax">
				<?php _e( "Saving", "wptouch-pro" ); ?>&hellip; <img src="<?php echo WPTOUCH_URL . '/admin/images/ajax-loader.gif'; ?>" alt="ajax image" />
			</span>
		</p>

		<ul id="bnc-help-menu">
			<li><a href="http://www.bravenewcode.com/support/" target="_blank"><?php _e( "Support Forums", "wptouch-pro" ); ?></a></li>
			<li><a href="http://www.bravenewcode.com/docs/" target="_blank"><?php _e( "Documentation", "wptouch-pro" ); ?></a></li>
			<li><a href="http://www.bravenewcode.com/support/profile/" target="_blank"><?php _e( "Account & Downloads", "wptouch-pro" ); ?></a></li>
			<li><a href="http://www.bravenewcode.com/general/terms/" target="_blank"><?php _e( "Licensing", "wptouch-pro" ); ?></a></li>
			<li><a href="http://twitter.com/bravenewcode" target="_blank">Twitter</a></li>
			<li><a href="http://facebook.com/bravenewcode" target="_blank">Facebook</a></li>
		</ul>		

		<p id="bnc-trademark"><?php echo sprintf( __( "%sWPtouch Pro%s is a trademark of BraveNewCode Inc.", "wptouch-pro" ), '<em>', '</em>' ); ?></p>
		<div class="poof">&nbsp;</div>
	</div> <!-- wptouch-admin-area -->
</form>
