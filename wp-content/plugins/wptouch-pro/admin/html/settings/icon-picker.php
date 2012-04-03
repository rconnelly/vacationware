<?php
// The main icon picker for the menu items
?>

<?php require_once( WPTOUCH_ADMIN_DIR . '/template-tags/icons.php' ); ?>
<?php require_once( WPTOUCH_DIR . '/include/template-tags/menu.php' ); ?>

<div id="wptouch-icon-area">
	<div class="pool-wrapper">
		<div class="round-3" id="wptouch-icon-packs">
			<div id="icon-select">
				<label for="active-icon-set"><?php _e( "Active Icon Set: ", "wptouch-pro" ); ?></label>
				<select name="active-icon-set" id="active-icon-set">
				<?php while ( wptouch_have_icon_packs() ) { ?>
					<?php wptouch_the_icon_pack(); ?>
					<option value="<?php wptouch_the_icon_pack_name(); ?>"><?php wptouch_the_icon_pack_name(); ?></option>	
				<?php } ?>
				</select>
			</div>		
			<div id="wptouch-icon-list"></div>		
		</div>
	</div><!-- pool wrapper -->
	
	<h4 id="menu-h4"><?php _e( 'General Icons + Menu Setup', 'wptouch-pro' ); ?></h4>

	<div class="round-3" id="wptouch-icon-menu">	
		<div id="menu-select">
			<ul>
				<li class="tab-left"><a href="#mixed-area"><?php _e( 'Site, Theme &amp; Bookmark', 'wptouch-pro' ); ?></a></li>
				<li class="tab-right"><a href="#pages-area"><?php _e( 'Pages / Custom Menu', 'wptouch-pro' ); ?></a></li>
			</ul>
		</div>

	<div id="page-tab-container">
		<div id="mixed-area" class="menu-tab-div">
			<div class="menu-meta">			
				<a id="reset-menu-all" href="/"><?php _e( 'Reset All Pages & Icons', 'wptouch-pro' ); ?></a>
			</div>	
		
			<ul class="icon-menu">
				<?php while ( wptouch_has_site_icons() ) { ?>
					<?php wptouch_the_site_icon(); ?>
					
					<li class="<?php wptouch_the_site_icon_classes(); ?>">
						<div class="icon-drop-target<?php if ( wptouch_site_icon_has_dark_bg() ) echo ' dark'; ?>" title="<?php wptouch_the_site_icon_id(); ?>">
							<img src="<?php wptouch_the_site_icon_icon(); ?>" alt="" /> 
						</div>
						<span class="title"><?php wptouch_the_site_icon_name(); ?></span>
						<div class="clearer"></div>
					</li>
				<?php } ?>
			</ul>
		</div>
	
		<div id="pages-area" class="menu-tab-div">
			<div class="menu-meta">			
				<?php _e( "Show / Hide", "wptouch-pro" ); ?>: <a href="#checkall" id="pages-check-all"><?php _e( "Check All", "wptouch-pro" ); ?></a> | <a href="#checknone" id="pages-check-none"><?php _e( "None", "wptouch-pro" ); ?></a>
			</div>	
		
			<?php wptouch_show_menu( WPTOUCH_ADMIN_DIR . '/html/icon-menu/main.php' ); ?>
			<input type="hidden" name="hidden-menu-items" id="hidden-menu-items" value="" />
		</div>
	</div>
	
		<div id="remove-icon-area">
			<?php _e( "Trash", "wptouch-pro" ); ?>
			<small><?php _e( "(drag here to reset icon)", "wptouch-pro" ); ?></small>
		</div>	
	</div>
	
	<div class="clearer"></div>
</div>