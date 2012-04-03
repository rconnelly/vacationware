<div id="manage-sets">	
	<div id="manage-upload-area">
		<div id="manage-upload-button">	
			<a href="#"><?php _e( "Upload Icon / Set", "wptouch-pro" ); ?></a>
		</div>
		<div id="manage-status-area">			
			<div id="manage-set-upload">	
				<div id="manage-set-upload-name"></div>		
			</div>		
			<div id="manage-status">
				<img id="manage-spinner" src="<?php echo WPTOUCH_URL . '/admin/images/spinner.gif'; ?>" style="display:none;" alt="" />
				<h6><?php _e( "Ready for upload...", "wptouch-pro" ); ?></h6>
				<p class="info"></p>
				
				<div id="wptouch-set-input-area" style="display:none;">
					<label for="wptouch-set-name"><?php _e( "Set name", "wptouch-pro" ); ?></label>
					<input type="text" class="text" name="wptouch-set-name" />
					
					<label for="wptouch-set-description"><?php _e( "Set description", "wptouch-pro" ); ?></label>
					<input type="text" class="text" name="wptouch-set-description" />
					
					<input type="submit" class="button" name="wptouch-set-info-submit" value="<?php _e( "Save", "wptouch-pro" ); ?>" />
				</div>
			</div>
		</div>
	</div>
	
	<div id="manage-info-area">
		<h4><?php _e( "Information + Help", "wptouch-pro" ); ?></h4>
		<h5><?php _e( "Uploading Icons", "wptouch-pro" ); ?>:</h5>
		<p><?php echo sprintf( __( "Single images and those in .ZIP packages <em>must</em> be in .PNG format. When you upload a .ZIP you <em>must</em> name the set. The .ZIP size limit on your server is %dMB.", "wptouch-pro" ), wptouch_get_bloginfo( 'max_upload_size' ) ); ?></p>
		<h5><?php _e( "Homescreen Icons", "wptouch-pro" ); ?>:</h5>
		<p><?php _e( "For images that will used as a Homescreen (Bookmark) icon, they should be 59x60 pixels or higher for best results on iPhone 2G, 3G and 3GS, and 113x114 pixels for iPhone 4.", "wptouch-pro" ); ?></p>
		<h5><?php _e( "Resources", "wptouch-pro" ); ?>:</h5>
		<p>
			<?php echo sprintf( __( '%sOnline Icon Generator%s', 'wptouch-pro' ), '<a href="http://www.midnightmobility.com/iphone-icon/" target="_blank">', '</a>' ); ?><br />
			<?php echo sprintf( __( '%sDownload WPtouch Pro Icon Template%s (PSD)', 'wptouch-pro' ), '<a href="http://wptouch-pro.s3.amazonaws.com/resources/bookmark_icon_template.zip">', '</a>' ); ?><br />
			<?php echo sprintf( __( '%sDownload WPtouch Pro iPhone 4 & iPad Icon Template%s (PSD)', 'wptouch-pro' ), '<a href="http://wptouch-pro.s3.amazonaws.com/resources/retina_bookmark_icon_template.zip">', '</a>' ); ?>
		</p>
	</div>
	<div class="clearer"></div>
	
	<div id="manage-icon-area">
		<h4><?php _e( "Manage Installed Icons + Sets", "wptouch-pro" ); ?></h4>
		<div id="pool-color-switch">
			<?php _e( "Pool Background Color", "wptouch-pro" ); ?>: <a href="#" class="light"><?php _e( "Light", "wptouch-pro" ); ?></a> | <a href="#" class="dark"><?php _e( "Dark", "wptouch-pro" ); ?></a>
		</div>
		<div class="clearer"></div>
		
		<div id="manage-icon-set-area" class="round-3">
			<ul id="icon-set-list">
				<?php while ( wptouch_have_icon_packs() ) { ?>
					<?php wptouch_the_icon_pack(); ?>
					<li class="<?php if ( wptouch_get_icon_pack_dark_bg() ) echo 'dark'; else echo 'light'; ?>"><a href="#" title="<?php wptouch_the_icon_pack_name(); ?>"><?php wptouch_the_icon_pack_name(); ?></a></li>
				<?php } ?>
			</ul>
			
			<div id="manage-icon-ajax"></div>
		</div>
	</div>
</div>