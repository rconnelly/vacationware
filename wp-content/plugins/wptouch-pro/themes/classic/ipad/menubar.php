<!-- All the iPad menubar code goes here -->
<div id="wptouch-header" class="light-gradient">
	<div class="head-left">
	<?php if ( classic_ipad_show_home_button() ) { ?>
		<div class="button" id="home"><a href="<?php wptouch_bloginfo( 'url' ); ?>"><span class="home-icon">&nbsp;</span></a></div>
<!--	<div class="menubar-button button" id="back"><?php _e( "back", "wptouch-pro" ); ?></div>
		<div class="menubar-button button" id="forward"><?php _e( "forward", "wptouch-pro" ); ?></div>  -->
	<?php } if ( classic_ipad_show_blog_button() ) { ?>
		<div class="menubar-button button" id="blog"><?php _e( "blog", "wptouch-pro" ); ?></div>
	<?php } if ( wptouch_has_menu() ) { ?>
		<div class="menubar-button button" id="menu"><?php _e( "menu", "wptouch-pro" ); ?></div>
	<?php } ?>
	</div>	

	<div class="head-center">
		<h1><?php wptouch_bloginfo( 'site_title' ); ?></h1>
	</div>
	
	<div class="head-right">
	<?php if ( classic_ipad_show_wordtwit_button() ) { ?>
		<div class="menubar-button button" id="wordtwit"><p class="wordtwit-icon"></p></div>
	<?php } if ( classic_ipad_show_flickr_button() ) { ?>
		<div class="menubar-button button" id="flickr"><p class="flickr-icon"></p></div>
	<?php } if ( wptouch_prowl_direct_message_enabled() ) { ?>
		<div class="menubar-button button" id="message"><p class="message-icon"></p></div>
	<?php } if ( classic_ipad_show_account_button() ) { ?>
		<div class="menubar-button button" id="account"><p class="account-icon"></p></div>
	<?php } if ( classic_ipad_show_search_button() ) { ?>
		<div class="menubar-button button" id="search"><p class="search-icon"></p></div>
	<?php } ?>
	</div>
</div>