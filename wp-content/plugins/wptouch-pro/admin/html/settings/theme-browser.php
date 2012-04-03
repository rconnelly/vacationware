<?php if ( wptouch_has_themes() ) { ?>
	<?php while ( wptouch_has_themes() ) { ?>
		<?php wptouch_the_theme(); ?>
		
		<div class="<?php wptouch_the_theme_classes( 'theme-wrap round-3' ); ?>">

			<input type="hidden" class="theme-location" value="<?php wptouch_the_theme_location(); ?>" />
			<input type="hidden" class="theme-name" value="<?php wptouch_the_theme_title(); ?>" />
					
			<div class="wptouch-theme-left-wrap round-3">
				<img src="<?php wptouch_the_theme_screenshot(); ?>" alt="<?php echo sprintf( __( '%s Theme Image', 'wptouch-pro' ), wptouch_get_theme_title() ); ?>" />
			</div>
			<div class="wptouch-theme-right-wrap">
				<ul class="option-list">
				<?php if ( !wptouch_is_theme_active() ) { ?>					
					<li><a href="#" class="activate-theme ajax-button"><?php _e( 'Activate', 'wptouch-pro' ); ?></a></li>
				<?php } ?>
				<?php if ( !wptouch_is_theme_custom() ) { ?>
				<?php if ( !wptouch_is_theme_child() ) { ?>
					<li><a href="#" class="make-child-theme ajax-button"><?php _e( 'Copy As Child', 'wptouch-pro' ); ?></a></li>
				<?php } ?>
					<li><a href="#" class="copy-theme ajax-button"><?php _e( 'Copy As New', 'wptouch-pro' ); ?></a></li>
				<?php } ?>
				<?php if ( wptouch_is_theme_custom() ) { ?>
					<li><a href="#" class="delete-theme ajax-button"><?php _e( 'Delete', 'wptouch-pro' ); ?></a></li>
				<?php } ?>
				</ul>
				<h4>
					<?php wptouch_the_theme_title(); ?>
					<span><?php echo sprintf( __( '(%s)', 'wptouch-pro' ), wptouch_get_theme_version() ); ?></span>
				</h4>
				<p class="wptouch-theme-author green-text"><?php echo sprintf( __( 'By %s', 'wptouch-pro' ), wptouch_get_theme_author() ); ?></p>
				<p class="wptouch-theme-description"><?php wptouch_the_theme_description(); ?></p>
				<?php if ( wptouch_theme_has_features() ) { ?>
					<p class="wptouch-theme-features"><?php echo sprintf( __( 'Features: %s', 'wptouch-pro' ), implode( wptouch_get_theme_features(), ', ' ) ); ?></p>
				<?php } ?>		
				<?php if ( wptouch_is_theme_custom() ) { ?>
					<p class="location"><?php echo sprintf( __( 'Theme Location (relative to wp-content):<br />%s', 'wptouch-pro' ), wptouch_get_theme_location() ); ?></p>
				<?php } ?>
			</div>
			<br class="clearer" />	
		</div>
	<?php } ?>
<?php } else { ?>
	<?php _e( "There are currently no themes installed.", "wptouch-pro" ); ?>
<?php }