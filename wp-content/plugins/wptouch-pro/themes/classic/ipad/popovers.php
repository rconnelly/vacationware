<div id="popovers-container">

<!-- Blog Popover -->
	<div id="pop-blog" class="popover popover-lists">
		<header>
			<ul class="menu-tabs">
			<?php if ( classic_ipad_show_popover_recent() ) { ?>
				<li><a href="#" rel="#classicRecentScroll"><?php _e( "Recent", "wptouch-pro" ); ?></a></li>
			<?php } if ( classic_ipad_show_popover_popular() ) { ?>
				<li><a href="#" rel="#classicPopularScroll"><?php _e( "Popular", "wptouch-pro" ); ?></a></li>
			<?php } if ( classic_ipad_show_popover_tags() ) { ?>
				<li><a href="#" rel="#classicTagsScroll"><?php _e( "Tags", "wptouch-pro" ); ?></a></li>
			<?php } if ( classic_ipad_show_popover_cats() ) { ?>
				<li><a href="#" rel="#classicCatsScroll"><?php _e( "Categories", "wptouch-pro" ); ?></a></li>
			<?php } ?>
			</ul>
		</header>
		<?php if ( classic_ipad_show_popover_recent() ) { ?>
		<div id="classicRecentScroll" class="tabbed pop-inner">
			<div id="recent-wrapper" class="iscroller">
				<div id="recent-iscroll">
					<ul>
						<?php classic_ipad_recent_posts( 12 ); ?>
					</ul>	
				</div>
			</div>
		</div>
		<?php } if ( classic_ipad_show_popover_popular() ) { ?>
		<div id="classicPopularScroll" class="tabbed pop-inner">
			<div id="popular-wrapper" class="iscroller">
				<div id="popular-iscroll">
					<ul>
						<?php classic_ipad_pop_posts( 12 ); ?>
					</ul>	
				</div>
			</div>
		</div>
		<?php } if ( classic_ipad_show_popover_tags() ) { ?>
		<div id="classicTagsScroll" class="tabbed pop-inner">
			<div id="tags-wrapper" class="iscroller">
				<div id="tags-iscroll">
					<?php wptouch_ordered_tag_list( 25 ); ?>
				</div>
			</div>
		</div>
		<?php } if ( classic_ipad_show_popover_cats() ) { ?>
		<div id="classicCatsScroll" class="tabbed pop-inner">
			<div id="cats-wrapper" class="iscroller">
				<div id="cats-iscroll">
					<?php wptouch_ordered_cat_list( 25 ); ?>
				</div>
			</div>
		</div>
	<?php } ?>
		<p class="menu-pointer-arrow">&nbsp;</p>
	</div>

<!-- Page Menu Popover -->
	<?php if ( wptouch_has_menu() ) { ?>
		<div id="pop-menu" class="popover">
			<header>
				<h1><?php _e( "menu navigation", "wptouch-pro" ); ?></h1>
			</header>			
			<div class="pop-inner">
				<div id="pages-wrapper" class="iscroller">
					<div id="pages-iscroll">
						<?php wptouch_show_menu(); ?>
					</div>
				</div>
			</div>
			<p class="menu-pointer-arrow">&nbsp;</p>
		</div>
	<?php } ?>

<!-- Push Message Popover -->
	<?php if ( wptouch_prowl_direct_message_enabled() ) { ?>
		<div id="pop-message" class="popover">
			<header>
				<h1><?php _e( "push messages", "wptouch-pro" ); ?></h1>
			</header>			
			<div class="pop-inner">				 
				 <form id="prowl-direct-message" method="post" action="">
			 		<input placeholder="<?php _e( 'Name', 'wptouch-pro' ); ?>" name="prowl-msg-name" id="prowl-msg-name" type="text" tabindex="1" />
					<input placeholder="<?php _e( 'E-Mail', 'wptouch-pro' ); ?>" name="prowl-msg-email" id="prowl-msg-email" autocapitalize="off" type="email" tabindex="2" />
					<textarea name="prowl-msg-message" tabindex="3"></textarea>
					<input type="submit" name="prowl-submit" value="<?php _e( 'Send Now', 'wptouch-pro' ); ?>" id="prowl-submit" class="button" tabindex="4" />
					<input type="hidden" name="wptouch-prowl-nonce" value="<?php echo wp_create_nonce( 'wptouch-prowl' ); ?>" />			
				 </form>
			</div>
			<p class="menu-pointer-arrow">&nbsp;</p>
		</div>
	<?php } ?>
	
<!-- WordTwit Popover -->
<?php if ( classic_ipad_show_wordtwit_button() ) { ?>
	<div id="pop-wordtwit" class="popover">
		<header>
			<h1><?php _e( "Latest Tweets", "wptouch-pro" ); ?></h1>
		</header>			
			<div class="pop-inner">
				<div id="wordtwit-wrapper" class="iscroller">
					<div id="wordtwit-iscroll">
						<ul>
						<?php if ( wptouch_wordtwit_has_recent_tweets() ) { ?>
							<?php while ( wptouch_wordtwit_has_recent_tweets() ) { ?>
								<?php wptouch_wordtwit_the_recent_tweet(); ?>						
								<li class="tweet">
									<a class="tweet-link no-ajax" target="_blank" href="<?php wptouch_wordtwit_the_recent_tweet_url(); ?>">
									<img src="<?php wptouch_wordtwit_recent_tweet_the_profile_image(); ?>" alt="avatar" />
									<p class="t-name"><?php wptouch_wordtwit_recent_tweet_the_screen_name(); ?></p>
									<span class="t-time"><?php wptouch_wordtwit_recent_tweet_the_hours_ago(); ?></span>
									<p><?php wptouch_wordtwit_recent_tweet_the_text(); ?></p>
									</a>
								</li>
							<?php } ?>
						<?php } ?>
						<?php $accounts = wptouch_wordtwit_get_enabled_accounts(); ?>
						<?php if ( count( $accounts ) ) { ?>
							<?php foreach( $accounts as $name => $account ) { ?>
								<li><a href="http://www.twitter.com/<?php echo $name; ?>" target="_blank"><?php echo sprintf( __( 'Follow @%s', 'wptouch-pro' ), $name ); ?></a></li>
							<?php } ?>
						<?php } ?>
						</ul> 
					</div>
				</div>
			</div>
		<p class="menu-pointer-arrow">&nbsp;</p>
	</div>
<?php } ?>

<!-- Flickr Popover -->
<?php if ( classic_ipad_show_flickr_button() ) { ?>
	<div id="pop-flickr" class="popover">
		<header>
			<h1><?php _e( "Latest Flickr Photos", "wptouch-pro" ); ?></h1>
		</header>			
			<div class="pop-inner">
				<div id="flickr-wrapper" class="iscroller">
					<div id="flickr-iscroll">
						<ul>
						<?php if ( function_exists( 'get_flickrRSS' ) ) { ?>
							<?php get_flickrRSS( array ( 'num_items' => 10, 'html' => '<li><a href="%flickr_page%" target="_blank" title="%title%"><img src="%image_square%" alt="%title%"/>%title%</a></li>') ); ?>
						<?php } else { ?>
							<li><?php _e( "No Photos To Display", "wptouch-pro" ); ?></li>
						<?php } ?>
						</ul> 
					</div>
				</div>
			</div>
		<p class="menu-pointer-arrow">&nbsp;</p>
	</div>
<?php } ?>

<!-- Account Popover -->
	<?php if ( classic_ipad_show_account_button() ) { ?>
	<div id="pop-account" class="popover">
		<header>
			<h1><?php _e( "accounts", "wptouch-pro" ); ?>: <?php wptouch_bloginfo( 'site_title' ); ?></h1>
		</header>			
		<div class="pop-inner">
			<?php if ( is_user_logged_in() ) { ?>
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
				<form name="loginform" id="loginform" action="<?php wptouch_bloginfo('wpurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode( wptouch_get_current_page_url() ); ?>" method="post">
					<div>
						<input placeholder="<?php _e( 'Username', 'wptouch-pro' ); ?>" type="text" autocapitalize="off" name="log" id="log" value="" tabindex="5" />
					</div>
					<div>
						<input placeholder="<?php _e( 'Password', 'wptouch-pro' ); ?>" autocapitalize="off" autocomplete="off" type="password" name="pwd"  id="pwd" value="" tabindex="6" />
						<input type="hidden" name="rememberme" checked="yes" value="forever"/>
					</div>
					<div>
						<input type="submit" name="login-submit" value="<?php _e( 'Login Now', 'wptouch-pro' ); ?>" id="login-submit" class="button" tabindex="7" />					
					</div>
					<?php if ( classic_ipad_accounts_enabled() ) { ?>
						<div id="account-link-area">
							<p><?php echo sprintf( __( "Not registered yet?<br />You can %ssign-up here%s.", "wptouch-pro" ), '<a class="no-ajax" href="' . wptouch_get_bloginfo( 'wpurl' ) . '/wp-register.php">','</a>' ); ?></p>
							<p><?php echo sprintf(__( "Lost your password?<br />You can %sreset it here%s.", "wptouch-pro" ), '<a class="no-ajax" href="' . wptouch_get_bloginfo( 'wpurl' ) . '/wp-login.php?action=lostpassword">','</a>' ); ?></p>				</div>
					<?php } ?>
			</form>
			<?php } ?>		
		</div>
		<p class="menu-pointer-arrow">&nbsp;</p>
	</div>

<!-- Search Popover -->
	<?php } if ( classic_ipad_show_search_button() ) { ?>
		<div id="pop-search" class="popover">
			<header>
				<h1> <?php _e( "search", "wptouch-pro" ); ?> <?php wptouch_bloginfo( 'site_title' ); ?></h1>
			</header>			
			<div class="pop-inner">
				<div id="search-bar">
					<div id="wptouch-search-inner">
						<form method="get" id="searchform" action="<?php wptouch_bloginfo( 'search_url' ); ?>/">
							<input placeholder="<?php _e( "Search this website", "wptouch-pro" ); ?>&hellip;" type="text" name="s" id="search-input" tabindex="8" />
							<input name="submit" type="hidden" id="search-submit-hidden" class="button" tabindex="9" />
						</form>
					</div>		
				</div>
			</div>
			<p class="menu-pointer-arrow">&nbsp;</p>
		</div>
	<?php } ?>

</div><!-- #popovers-container -->
