<?php 
	global $wptouch_pro; 
	$settings = wptouch_get_settings();
?>

<div class='wptouch-setting' id='touchboard'>
	<div class="box-holder round-3" id="right-now-box">

		<h3>
			<?php _e( "Right Now", "wptouch-pro" ); ?>
			<img src="<?php echo WPTOUCH_URL . '/admin/images/ajax-loader.gif'; ?>" alt="ajax image" class="ajax-loader" />
		</h3>

		<p class="sub"><?php _e( "At a Glance", "wptouch-pro" ); ?></p>

		<table class="fonty">
		<tbody>
			<tr>
				<td class="box-table-number"><a href="#" rel="themes" class="wptouch-admin-switch"><?php wptouch_bloginfo( 'theme_count' ); ?></a></td>
				<td class="box-table-text"><a href="#" rel="themes" class="wptouch-admin-switch"><?php _e( "Themes", "wptouch-pro" ); ?></a></td>
			</tr>
			<tr>
				<td class="box-table-number"><a href="#" rel="icons" class="wptouch-admin-switch"><?php wptouch_bloginfo( 'icon_count' ); ?></a></td>
				<td class="box-table-text"><a href="#" rel="icons" class="wptouch-admin-switch"><?php _e( "Icons", "wptouch-pro" ); ?></a></td>
			</tr>
			<tr>
				<td class="box-table-number"><a href="#" rel="icon-sets" class="wptouch-admin-switch"><?php wptouch_bloginfo( 'icon_set_count' ); ?></a></td>
				<td class="box-table-text"><a href="#" rel="icon-sets" class="wptouch-admin-switch"><?php _e( "Icon Sets", "wptouch-pro" ); ?></a></td>
			</tr>
			<?php if ( wptouch_get_bloginfo( 'warnings' ) ) { ?>
			<tr id="board-warnings">
				<td class="box-table-number"><a href="#" rel="plugin-conflicts" class="wptouch-admin-switch"><?php wptouch_bloginfo( 'warnings' ); ?></a></td>
				<td class="box-table-text"><a href="#" rel="plugin-conflicts" class="wptouch-admin-switch"><?php _e( "Warnings", "wptouch-pro" ); ?></a></td>
			</tr>
			<?php } ?>
			<?php if ( wptouch_has_license() && !$settings->admin_client_mode_hide_licenses	 ) { ?>
			<tr id="wptouch-licenses-remaining">
				<td class="box-table-number">&nbsp;</td>
				<td class="box-table-text">&nbsp;</td>
			</tr>
			<?php } ?>
		</tbody>
		</table>

		<div id="touchboard-ajax"></div>
		
	</div><!-- box-holder -->

	<div class="box-holder round-3" id="blog-news-box">
		<h3>
			<?php _e( "WPtouch News", "wptouch-pro" ); ?>
			<img src="<?php echo WPTOUCH_URL . '/admin/images/ajax-loader.gif'; ?>" alt="ajax image" class="ajax-loader" />
		</h3>

		<p class="sub"><?php _e( "From the BraveNewCode Blog", "wptouch-pro" ); ?></p>

		<div id="blog-news-box-ajax"></div>

	</div><!-- box-holder -->

	<?php if ( wptouch_has_proper_auth()  && !$settings->admin_client_mode_hide_licenses ) { ?>	
		<?php if ( wptouch_has_license() ) { ?>	
			<div class="box-holder round-3" id="support-threads-box">
				<h3>
					<?php _e( "Recent Support Posts", "wptouch-pro" ); ?>
					<img src="<?php echo WPTOUCH_URL . '/admin/images/ajax-loader.gif'; ?>" alt="ajax image" class="ajax-loader" />
				</h3>
		
				<p class="sub"><?php _e( "From the WPtouch Pro Forums", "wptouch-pro" ); ?></p>
				
				<div id="support-threads-box-ajax"></div>
		
			</div><!-- box-holder -->
			
			<div class="box-holder round-3" id="support-form-box">
				<h3><?php _e( "Support QuickPress", "wptouch-pro" ); ?></h3>
				
				<div id="support-form-inside">	
					<p class="sub"><?php _e( "Add a New Topic to the Pro Forums", "wptouch-pro" ); ?></p>
			
					<input autocomplete="off" type="text" class="text" id="forum-post-title" name="forum-post-title" value="" />
					<label class="text" for="forum-post-title">
					<?php _e( "Topic Title", "wptouch-pro" ); ?>
					</label>			
					
					<input autocomplete="off" type="text" class="text" id="forum-post-tag" name="forum-post-tag" value="" />
					<label class="text" for="forum-post-tag">
					<?php _e( "Topic Tags", "wptouch-pro" ); ?>
					</label>			
					
					<textarea rows="5" class="textarea"  id="forum-post-content" name="forum-post-content"></textarea>			
					<a href="#" class="button" id="support-form-submit"><?php _e( 'Publish', 'wptouch-pro' ); ?></a>
				</div>
			</div><!-- box-holder -->

<?php if (false) { ?>
	<div class="box-holder round-3" id="knowledge-base-box">
		<h3><?php _e( "Knowledge Base", "wptouch-pro" ); ?></h3>
		<p class="sub"><?php _e( "Recent Articles", "wptouch-pro" ); ?></p>
		<div id="knowledge-base-box-ajax"></div>
	</div><!-- box-holder -->
<?php } ?>

		<?php } else { ?>
			<br class="clearer" />
			<div id="unlicensed-board" class="partial round-3">
				<strong><?php echo __( "This copy of WPtouch Pro is partially activated.", "wptouch-pro" ); ?></strong>
				<a href="pane-license" class="partial wptouch-admin-switch" rel="licenses"><?php _e( "Add a site license &raquo;", "wptouch-pro" ); ?></a>
			</div>		
		<?php } ?>
	<?php } else if ( !$settings->admin_client_mode_hide_licenses && !wptouch_is_multisite_secondary() ) { ?>	
	<br class="clearer" />
	
	<div id="unlicensed-board" class="round-3">
		<strong><?php echo sprintf( __( "This copy of WPtouch Pro %s is unlicensed.", "wptouch-pro" ), wptouch_get_bloginfo( 'version' ) ); ?></strong>

		<?php if ( !wptouch_is_multisite_enabled() || ( wptouch_is_multisite_enabled() && wptouch_is_multisite_primary() ) ) { ?>
			<a href="#pane-5" class="wptouch-admin-switch" rel="account"><?php _e( "Get started with Activation &raquo;", "wptouch-pro" ); ?></a>
		<?php } ?>
	</div>
	<?php } ?>

</div><!-- wptouch-setting -->