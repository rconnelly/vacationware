<?php global $wptouch_pro; ?>
<?php if ( isset( $wptouch_pro->post['area'] ) && $wptouch_pro->post['area'] == 'manage' ) $manage = true; else $manage = false; ?>

	<?php if ( !$manage ) { ?>
	<div id="icon-help-message">
		<?php _e( "Drag icons from the pool to", "wptouch-pro" ); ?><br />
		<?php _e( "associate them with menu pages.", "wptouch-pro" ); ?><br />
		<?php _e( "Don't forget to save your changes!", "wptouch-pro" ); ?>
	</div>
	<?php } else { ?>
		<?php $pack = $wptouch_pro->get_icon_pack( $wptouch_pro->post['set'] ); ?>
		<div id="manage-set-desc">
			<h5><em><?php echo htmlspecialchars( $pack->name ); ?></em>
			<?php if ( isset( $pack->author ) ) { ?> 
				by <?php echo htmlentities( $pack->author ); ?>
				</h5>
				<div id="manage-set-desc-links">
					<?php if ( isset( $pack->author_url ) ) { ?><a href="<?php echo $pack->author_url; ?>" target="_blank"><?php _e( 'Author Website', 'wptouch-pro' ); ?></a> | <?php } ?><a href="#" class="delete-set"><?php _e( 'Delete Set', 'wptouch-pro' ); ?></a>
				</div>
			<?php } else { ?>
				</h5>
				<?php if ( !( $manage && $wptouch_pro->post['set'] == __( "Custom Icons", "wptouch-pro" ) ) ) { ?>
				<div id="manage-set-desc-links">
					<a href="#" class="delete-set"><?php _e( 'Delete Set', 'wptouch-pro' ); ?></a>
				</div>			
				<?php } ?>
			<?php } ?>
		</div>
	<?php } ?>
	
	<?php if ( wptouch_have_icons( $wptouch_pro->post['set'] ) ) { ?>	
	<?php $pack = $wptouch_pro->get_icon_pack( $wptouch_pro->post['set'] ); ?>
	<ul>
		<?php while ( wptouch_have_icons( $wptouch_pro->post['set'] ) ) { ?>
			<?php wptouch_the_icon(); ?>
			<li class="<?php wptouch_the_icon_class_name(); ?> <?php if ( $pack->dark_background ) echo 'dark'; else echo 'light'; ?>">
				<?php if ( $manage && $wptouch_pro->post['set'] == __( "Custom Icons", "wptouch-pro" ) ) { ?>
					<a href="#" class="delete-icon">X</a>
				<?php } ?>
				<div class="icon-image"><img src="<?php wptouch_the_icon_url(); ?>" alt="" /></div>
				<div class="icon-info">
					<span class="icon-name"><?php wptouch_the_icon_short_name(); ?></span>
					<?php if ( wptouch_icon_has_image_size_info() ) { ?>
					<span class="icon-size"><?php wptouch_icon_the_width(); ?>x<?php wptouch_icon_the_height(); ?></span>
					<?php } ?>
				</div>
			</li>
		<?php } ?>
	</ul>
<?php } else { ?>
	<?php if ( $manage ) { ?>
		<div id="empty-icon-pool"><?php _e( "No Custom Icons to Display", "wptouch-pro" ); ?></div>
	<?php } else { ?>
		<div id="empty-icon-pool"><?php echo __( "No Custom Icons to Display", "wptouch-pro" ) . '<br />' . __( "Add them in the 'Manage Icons + Sets' area", "wptouch-pro" ); ?></div>
	<?php } ?>
<?php } ?>
<div class="clearer"></div>