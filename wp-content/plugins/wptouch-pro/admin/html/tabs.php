<?php while ( wptouch_has_tabs() ) { ?>
	<?php wptouch_the_tab(); ?>
	
	<div id="pane-content-pane-<?php wptouch_the_tab_id(); ?>" class="pane-content" style="display: none;">
		<div class="left-area">
			<ul>
				<?php while ( wptouch_has_tab_sections() ) { ?>
					<?php wptouch_the_tab_section(); ?>
					<li><a id="tab-section-<?php wptouch_the_tab_section_class_name(); ?>" rel="<?php wptouch_the_tab_section_class_name(); ?>" href="#"><?php wptouch_the_tab_name(); ?></a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="right-area">
			<?php wptouch_rewind_tab_settings(); ?>
			
			<?php while ( wptouch_has_tab_sections() ) { ?>
				<?php wptouch_the_tab_section(); ?>

				<div style="display: none;" class="setting-right-section" id="setting-<?php wptouch_the_tab_section_class_name(); ?>">
					<?php while ( wptouch_has_tab_section_settings() ) { ?>
						<?php wptouch_the_tab_section_setting(); ?>

						<div class="wptouch-setting type-<?php wptouch_the_tab_setting_type(); ?><?php if ( wptouch_tab_setting_has_tags() ) echo ' ' . wptouch_tab_setting_the_tags(); ?>"<?php if ( wptouch_get_tab_setting_class_name() ) echo ' id="setting_' .  wptouch_get_tab_setting_class_name() . '"'; ?>>
							
							<?php if ( file_exists( dirname( __FILE__ ) . '/settings/' . wptouch_get_tab_setting_type() . '.php' ) ) { ?>
								<?php include( 'settings/' . wptouch_get_tab_setting_type() . '.php' ); ?>
							<?php } else { ?>
								<?php do_action( 'wptouch_show_custom_setting', wptouch_get_tab_setting_type() ); ?>
							<?php } ?>
						</div>
					<?php } ?>
				</div>				
			<?php } ?>	
			
			<br class="clearer" />		
		</div>
		<br class="clearer" />
	</div>
<?php } ?>