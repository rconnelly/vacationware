				</div><!-- #content -->
					
				<?php do_action( 'wptouch_body_bottom' ); ?>
						
				<?php if ( wptouch_show_switch_link() && !classic_is_web_app_mode() ) { ?>
					<div id="switch" class="rounded-corners-8px">
						<span class="switch-text">
							<?php _e( "Mobile Theme", "wptouch-pro" ); ?>
						</span>
						<div title="<?php wptouch_the_mobile_switch_link(); ?>">
							<span class="on active"></span>
							<span class="off"></span>
						</div>
					</div>
				<?php } ?>
						
				<div class="<?php wptouch_footer_classes(); ?>">
					<?php wptouch_footer(); ?>
				</div>
	
				<?php do_action( 'wptouch_advertising_bottom' ); ?>
			</div> <!-- #inner-ajax -->
		</div> <!-- #outer-ajax -->
		<?php // include_once('web-app-bubble.php'); ?>
		<!-- <?php echo 'Built with WPtouch Pro ' . WPTOUCH_VERSION; ?> -->
	</body>
</html>