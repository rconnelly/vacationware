	<!-- The tab Icon Bar -->
	<div id="tab-bar">
		<div id="tab-inner-wrap-right">
			<a id="tab-search" class="no-ajax" href="#"><?php _e( 'Search', 'wptouch-pro' ); ?></a>
		</div>
		<div id="tab-inner-wrap-left">
			<a href="#menu-tab1" class="first-tab no-ajax" id="tab-pages"><?php _e( "Menu", "wptouch-pro" ); ?></a>
			<?php if ( wptouch_theme_show_categories_tab() ) { ?>
				<a href="#menu-tab2" id="tab-categories" class="no-ajax"><?php _e( "Categories", "wptouch-pro" ); ?></a>
			<?php } ?>
			<?php if ( wptouch_theme_show_tags_tab() ) { ?>
				<a href="#menu-tab3" id="tab-tags" class="no-ajax"><?php _e( "Tags", "wptouch-pro" ); ?></a>
			<?php } ?>
			<?php if ( wptouch_prowl_direct_message_enabled() ) { ?>
			<a href="#menu-tab4" id="tab-push" class="no-ajax"><?php _e( "Message", "wptouch-pro" ); ?></a>
			<?php } ?>
			<a href="#menu-tab5" id="tab-login" class="no-ajax <?php if ( is_user_logged_in() ) { echo 'logged-in'; } ?>"><?php if ( is_user_logged_in() ) {  _e( "Account", "wptouch-pro" ); } else { _e( "Login", "wptouch-pro" ); } ?></a>
		</div>
	</div>
	
	<div id="menu-container">
		<div id="menu-tab1">
			<!-- The WPtouch Page Menu -->		
			<?php wptouch_show_menu(); ?>
		</div>

		<?php if ( wptouch_theme_show_categories_tab() ) { ?>
			<div id="menu-tab2">
				<?php wptouch_ordered_cat_list( 25 ); ?>
			</div>
		<?php } ?>

		<?php if ( wptouch_theme_show_tags_tab() ) { ?>
			<div id="menu-tab3">
				<?php wptouch_ordered_tag_list( 25 ); ?>
			</div>
		<?php } ?>
		
		<?php if ( wptouch_prowl_direct_message_enabled() ) { ?>
		<div id="menu-tab4">
			 <h4><?php _e( "Send a Message", "wptouch-pro" ); ?></h4>
			 
			 <form id="prowl-direct-message" method="post" action="">
			 	<p>
			 		<input name="prowl-msg-name"  id="prowl-msg-name" type="text" tabindex="3" />
			 		<label for="prowl-msg-name"><?php _e( 'Name', 'wptouch-pro' ); ?></label>
			 	</p>
		
				<p>
					<input name="prowl-msg-email" id="prowl-msg-email" autocapitalize="off" type="text" tabindex="4" />
					<label for="prowl-msg-email"><?php _e( 'E-Mail', 'wptouch-pro' ); ?></label>
				</p>
		
				<textarea name="prowl-msg-message"  tabindex="5"></textarea>

				<input type="hidden" name="wptouch-prowl-nonce" value="<?php echo wp_create_nonce( 'wptouch-prowl' ); ?>" />			
				<input type="submit" name="prowl-submit" value="<?php _e( 'Send Now', 'wptouch-pro' ); ?>" id="prowl-submit"  tabindex="6" />
			 </form>
		</div>
		<?php } ?>
		
		<div id="menu-tab5">
			<?php if ( is_user_logged_in() ) { ?>
					<ul>
						<?php if ( current_user_can( 'edit_posts' ) ) { ?>
							<li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/" class="no-ajax"><?php _e( "Admin", "wptouch-pro" ); ?></a></li>
						<?php } ?>
						<li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/profile.php" class="no-ajax"><?php _e( "Account Profile", "wptouch-pro" ); ?></a></li>
						<li><a href="<?php echo wp_logout_url( wptouch_get_current_page_url() ); ?>" class="no-ajax"><?php _e( "Logout", "wptouch-pro" ); ?></a></li>
					</ul>
				
			<?php } else { ?>

				<form name="loginform" id="loginform" action="<?php bloginfo('wpurl'); ?>/wp-login.php" method="post" class="clearfix">
					<div>
						<label for="log" id="log-label"><?php _e( 'Username', 'wptouch-pro' ); ?></label>
						<input type="text" autocapitalize="off" name="log" id="log" value="" tabindex="7" />
					</div>
					<div>
						<label for="pwd" id="pwd-label"><?php _e( 'Password', 'wptouch-pro' ); ?></label>
						<input autocapitalize="off" type="password" name="pwd"  id="pwd" value="" tabindex="8" />
						<input name="rememberme" type="hidden" checked="yes" id="rememberme" value="forever"/>
						<input type="hidden" id="logsub" name="submit" value="<?php _e( 'Login', 'wptouch-pro' ); ?>" />
						<input type="hidden" name="redirect_to" value="<?php wptouch_the_current_page_url(); ?>"/>
					</div>
				</form>
				<?php if ( get_option( 'comment_registration' ) || get_option( 'users_can_register' ) ) : ?>
					<p><?php echo sprintf( __( "Not registered yet?<br />You can %ssign-up here%s.", "wptouch-pro" ), '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-register.php" target="_blank" class="no-ajax">','</a>' ); ?>
					</p>
					<p><?php echo sprintf(__( "Lost your password?<br />You can %sreset it here%s.", "wptouch-pro" ), '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-login.php?action=lostpassword" target="_blank" class="no-ajax">','</a>' ); ?>
					</p>					
				<?php endif; ?>
			<?php } ?>
		</div>
	</div><!-- #tab-bar -->