<ul>
	<?php while ( wptouch_has_menu_items() ) { ?>
		<?php wptouch_the_menu_item(); ?>	
		
		<?php if ( !wptouch_menu_is_disabled() ) { ?>	
		<li class="<?php wptouch_the_menu_item_classes(); ?>">
			
			<a href="<?php wptouch_the_menu_item_link(); ?>">
				<?php if ( wptouch_can_show_menu_icons() ) { ?>
					<img src="<?php wptouch_the_menu_icon(); ?>" alt="" />
				<?php } ?>
			
				<?php wptouch_the_menu_item_title(); ?>
			</a>
				
			<?php if ( wptouch_menu_has_children() ) { ?>
				<?php wptouch_show_children( 'menu.php' ); ?>
			<?php } ?>
		</li>
		<?php } ?>
	<?php } ?>
</ul>