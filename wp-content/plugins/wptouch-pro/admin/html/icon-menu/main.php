<?php 
	// Main menu hook for admin panel 
?>
<ul class="icon-menu">
<?php if ( wptouch_has_menu_items() ) { ?>
	<?php while ( wptouch_has_menu_items() ) { ?>
		<?php wptouch_the_menu_item(); ?>
		<li class="<?php wptouch_the_menu_item_classes(); ?>">
			<div class="icon-drop-target <?php wptouch_the_menu_item_classes(); ?>" title="<?php wptouch_the_menu_id(); ?>">
				<img src="<?php wptouch_the_menu_icon(); ?>" alt="" />
			</div>
					
			<div class="menu-enable">		
				<input class="checkbox" type="checkbox" title="<?php wptouch_the_menu_id(); ?>" <?php if ( !wptouch_menu_is_disabled() ) echo "checked"; ?> />
			</div>
			
			<?php if ( wptouch_menu_has_children() ) { ?>
				<a href="#" class="expand title"><?php wptouch_the_menu_item_title(); ?></a>
			<?php } else { ?>
				<span class="title"><?php wptouch_the_menu_item_title(); ?></span>
			<?php } ?>
	
			
			<div class="clearer"></div>
			
			<?php if ( wptouch_menu_has_children() ) { ?>
				<?php wptouch_show_children( WPTOUCH_ADMIN_DIR . '/html/icon-menu/submenu.php', true ); ?>
			<?php } ?>
		</li>
	<?php } ?>
<?php } else { ?>
	<li><span class="title"><?php echo __( "There are no WordPress pages available to configure.", "wptouch-pro" ); ?></span></li>
<?php } ?>
</ul>