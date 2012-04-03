	<!-- The tab Icon Bar -->
	<div id="tab-bar">
		<?php if ( classic_mobile_show_search_button() ) { ?>
			<div id="tab-inner-wrap-right">
				<a id="tab-search" class="no-ajax" href="#"><?php _e( 'Search', 'wptouch-pro' ); ?></a>
			</div>
		<?php } ?>
		<div id="tab-inner-wrap-left">
			<a href="#menu-tab1"  id="tab-pages" class="first-tab no-ajax"><?php _e( "Menu", "wptouch-pro" ); ?></a>
			<?php if ( classic_mobile_show_categories_tab() ) { ?>
				<a href="#menu-tab2" id="tab-categories" class="no-ajax"><?php _e( "Top Categories", "wptouch-pro" ); ?></a>
			<?php } ?>

			<?php if ( classic_mobile_show_tags_tab() ) { ?>
				<a href="#menu-tab3" id="tab-tags" class="no-ajax"><?php _e( "Top Tags", "wptouch-pro" ); ?></a>
			<?php } ?>

			<?php if ( wptouch_prowl_direct_message_enabled() ) { ?>
				<a href="#menu-tab4" id="tab-push" class="no-ajax"><?php _e( "Message", "wptouch-pro" ); ?></a>
			<?php } ?>

			<?php if ( classic_show_account_tab() ) { ?>
				<a href="#menu-tab5" id="tab-login" class="no-ajax <?php if ( is_user_logged_in() ) { echo 'logged-in'; } ?>"><?php if ( is_user_logged_in() ) {  _e( "Account", "wptouch-pro" ); } else { _e( "Login", "wptouch-pro" ); } ?></a>
			<?php } ?>

			<?php if ( classic_mobile_show_wordtwit_button() ) { ?>
				<a href="#menu-tab6" id="tab-twitter" class="no-ajax"><?php _e( "Twitter", "wptouch-pro" ); ?></a>
			<?php } ?>
		</div>
	</div>
	
	<div id="menu-container">
		<div id="menu-tab1">
			<h2><?php _e( "Menu", "wptouch-pro" ); ?></h2>
			<!-- The WPtouch Page Menu -->		
			<?php wptouch_show_menu(); ?>
		</div>

		<?php if ( classic_mobile_show_categories_tab() ) { ?>
			<div id="menu-tab2">
				<h2><?php _e( "Top Categories", "wptouch-pro" ); ?></h2>
				<?php wptouch_ordered_cat_list( 20 ); ?>
			</div>
		<?php } ?>

		<?php if ( classic_mobile_show_tags_tab() ) { ?>
			<div id="menu-tab3">
				<h2><?php _e( "Top Tags", "wptouch-pro" ); ?></h2>
				<?php wptouch_ordered_tag_list( 20 ); ?>
			</div>
		<?php } ?>
		
		<?php if ( wptouch_prowl_direct_message_enabled() ) { ?>
		<div id="menu-tab4">
			 <h4><?php _e( "Send a Message", "wptouch-pro" ); ?></h4>
			 
			 <form id="prowl-direct-message" method="post" action="">
			 	<p>
			 		<input name="prowl-msg-name" id="prowl-msg-name" type="text" tabindex="3" />
			 		<label for="prowl-msg-name"><?php _e( 'Name', 'wptouch-pro' ); ?></label>
			 	</p>
				<p>
					<input name="prowl-msg-email" id="prowl-msg-email" autocapitalize="off" type="text" tabindex="4" />
					<label for="prowl-msg-email"><?php _e( 'E-Mail', 'wptouch-pro' ); ?></label>
				</p>
				<textarea name="prowl-msg-message" tabindex="5"></textarea>
				<input type="submit" name="prowl-submit" value="<?php _e( 'Send Now', 'wptouch-pro' ); ?>" id="prowl-submit" tabindex="6" />
				<input type="hidden" name="wptouch-prowl-nonce" value="<?php echo wp_create_nonce( 'wptouch-prowl' ); ?>" />			
			 </form>
		</div>
		<?php } ?>
		
		<div id="menu-tab5">
			<?php if ( is_user_logged_in() ) { ?>
			 <h2><?php _e( "My Account", "wptouch-pro" ); ?></h2>
					<ul>
						<?php if ( current_user_can( 'edit_posts' && classic_show_admin_menu_link() ) ) { ?>
							<li><a href="<?php wptouch_bloginfo('wpurl'); ?>/wp-admin/" class="no-ajax"><?php _e( "Admin", "wptouch-pro" ); ?></a></li>
						<?php } ?>
						<?php if ( classic_show_profile_menu_link() ) { ?>
							<li><a href="<?php wptouch_bloginfo('wpurl'); ?>/wp-admin/profile.php" class="no-ajax"><?php _e( "Account Profile", "wptouch-pro" ); ?></a></li>
						<?php } ?>
						<li><a href="<?php echo wp_logout_url( wptouch_get_current_page_url() ); ?>"><?php _e( "Logout", "wptouch-pro" ); ?></a>
						</li>
					</ul>

			<?php } else { ?>
			 <h2><?php _e( "Account Login", "wptouch-pro" ); ?></h2>
				<form name="loginform" id="loginform" action="<?php wptouch_bloginfo('wpurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode( wptouch_get_current_page_url() ); ?>" method="post" class="clearfix">
				<ul>
					<li class="inputs">
						<input type="hidden" name="rememberme" checked="yes" value="forever" tabindex="99" />
						<div>
							<label for="pwd" id="pwd-label"><?php _e( 'Username', 'wptouch-pro' ); ?></label>
							<input type="text" autocapitalize="off" name="log" id="log" placeholder="<?php _e( 'Username', 'wptouch-pro' ); ?>" tabindex="7" />
						</div>
						<div>
							<label for="pwd" id="pwd-label"><?php _e( 'Password', 'wptouch-pro' ); ?></label>
							<input autocapitalize="off" type="password" name="pwd"  id="pwd" placeholder="<?php _e( 'Password', 'wptouch-pro' ); ?>" tabindex="8" />
						</div>
						<div>
							<input type="submit" name="submit" id="logsub" tabindex="9" value="<?php _e( 'Login', 'wptouch-pro' ); ?>" />
						</div>
					</li>
					<?php if ( classic_show_account_tab() ) { ?>
						<li><a class="no-ajax" href="<?php wptouch_bloginfo('wpurl'); ?>/wp-register.php"><?php _e( 'Register for an account', 'wptouch-pro' ); ?></a></li>
						<li><a class="no-ajax" href="<?php wptouch_bloginfo('wpurl');?>/wp-login.php?action=lostpassword"><?php _e( 'Reset password', 'wptouch-pro' ); ?></a></li>
					<?php } ?>
				</ul>
				</form>	
			<?php } ?>
		</div>

		<?php if ( classic_mobile_show_wordtwit_button() ) { ?>
			<div id="menu-tab6">
				<h2><?php _e( "Twitter", "wptouch-pro" ); ?></h2>
				<ul id="wordtwit-list">
					<?php if ( wptouch_wordtwit_has_recent_tweets() ) { ?>
						<?php while ( wptouch_wordtwit_has_recent_tweets() ) { ?>
							<?php wptouch_wordtwit_the_recent_tweet(); ?>
							<li>
								<a class="tweet-link no-ajax" target="_blank" href="<?php wptouch_wordtwit_the_recent_tweet_url(); ?>">
								<img src="<?php wptouch_wordtwit_recent_tweet_the_profile_image(); ?>" alt="avatar" />
								<p class="t-name">@<?php wptouch_wordtwit_recent_tweet_the_screen_name(); ?></p>
								<span class="t-time"><?php wptouch_wordtwit_recent_tweet_the_hours_ago(); ?></span>
								<p><?php wptouch_wordtwit_recent_tweet_the_text(); ?></p>
								</a>
							</li>
						<?php } ?>
					<?php } ?>
					
					<?php $accounts = wptouch_wordtwit_get_enabled_accounts(); ?>
					<?php if ( count( $accounts ) ) { ?>
						<?php foreach( $accounts as $name => $account ) { ?>
						<li class="twitter-link"><a href="http://www.twitter.com/<?php echo $name; ?>"><?php echo sprintf( __( 'Follow @%s on Twitter', 'wptouch-pro' ), $name ); ?></a></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	</div><!-- #tab-bar -->