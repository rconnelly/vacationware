<ul<?php if ( wptouch_get_menu_depth() == 1 ) echo ' style="display: none;"'; ?>>
	<?php while ( wptouch_has_menu_items() ) { ?>
		<?php wptouch_the_menu_item(); ?>
		
		<?php if ( !wptouch_menu_item_duplicate() ) { ?>

		<li class="<?php wptouch_the_menu_item_classes(); ?>">
			<div class="icon-drop-target <?php wptouch_the_menu_item_classes(); ?>" title="<?php wptouch_the_menu_id(); ?>">
				<img src="<?php wptouch_the_menu_icon(); ?>" alt="" />
			</div>
			
			<div class="menu-enable">		
				<input class="checkbox" type="checkbox" title="<?php wptouch_the_menu_id(); ?>" <?php if ( !wptouch_menu_is_disabled() ) echo "checked"; ?> />
			</div>
			
			<span class="title"><?php wptouch_the_menu_item_title(); ?></span>

			<div class="clearer"></div>
			
			<?php if ( wptouch_menu_has_children() ) { ?>
				<?php wptouch_show_children( WPTOUCH_ADMIN_DIR . '/html/icon-menu/submenu.php', true ); ?>
			<?php } ?>			
		</li>
		
		<?php } ?>

	<?php } ?>
</ul>