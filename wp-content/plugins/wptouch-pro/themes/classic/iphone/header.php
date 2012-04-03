<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php wptouch_bloginfo('html_type'); ?>; charset=<?php wptouch_bloginfo('charset'); ?>" />
	<title><?php wptouch_title(); ?></title>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wptouch_head(); ?>
	<link type="text/css" rel="stylesheet" media="screen" href="<?php classic_the_static_css_url( 'iphone' ); ?>?version=<?php classic_the_static_css_version( 'iphone' ); ?>"></link>
</head>
<?php flush(); ?>
<body class="<?php wptouch_body_classes(); ?>">
<!-- New noscript check, we need js on always folks to do cool stuff -->
<noscript>
	<div id="noscript">
		<h2><?php _e( "Notice", "wptouch-pro" ); ?></h2>
		<p><?php _e( "JavaScript is currently off.", "wptouch-pro" ); ?></p>
		<p><?php _e( "Turn it on in browser settings to view this mobile website.", "wptouch" ); ?></p>
	</div>
</noscript>
	<?php if ( wptouch_has_welcome_message() && !classic_is_web_app_mode() ) { ?>
		<div id="welcome-message">
			<?php wptouch_the_welcome_message(); ?>
			<a href="<?php wptouch_the_welcome_message_dismiss_url(); ?>" id="close-msg"><?php _e( "Close Message", "wptouch-pro" ); ?></a>	
		</div>
	<?php } ?>
	<?php if ( wptouch_prowl_tried_to_send_message() ) { ?>
		<div id="prowl-message" class="rounded-corners-8px">
			<?php if ( wptouch_prowl_message_succeeded() ) { ?>
				<span class="success"><?php _e( "Message sent successfully.", "wptouch-pro" ); ?></span>
			<?php } else { ?>
				<span class="failed"><?php _e( "Your message failed to send. Please try again.", "wptouch-pro" ); ?></span>
			<?php } ?>
		</div>
	<?php } ?>
	<div id="outer-ajax">
		<div id="inner-ajax">
			<div id="header">
				<?php if ( classic_mobile_has_logo() ) { ?>
					<a id="custom-logo-title" href="<?php wptouch_bloginfo( 'url' ); ?>">&nbsp;</a>
						<?php classic_mobile_logo_img(); ?>
				<?php } else { ?>
					<?php if ( classic_mobile_show_site_icon() ) { ?>
						<a href="<?php wptouch_bloginfo( 'url' ); ?>">
							<img id="logo-icon" src="<?php wptouch_the_site_menu_icon( WPTOUCH_ICON_HOME ) ; ?>" alt="" />
						</a>
					<?php } ?>
					<a id="logo-title" href="<?php wptouch_bloginfo( 'url' ); ?>">
						<?php wptouch_bloginfo( 'site_title' ); ?>
					</a>
				<?php } ?>
				<!-- If you disable the menu this menu button won't show, so you'll have to roll your own! -->
				<?php if ( wptouch_has_menu() ) { ?>
					<?php if ( classic_mobile_has_menu_icon() ) { ?>
						<a id="header-menu-toggle" class="no-ajax" href="#">
							<img src="<?php wptouch_bloginfo( 'template_directory' ); ?>/images/menu_toggle_icon.png" alt="menu image" />
						</a>
					<?php } else { ?>
						<a id="header-menu-toggle" class="no-ajax" href="#">
							<?php _e( "Menu", "wptouch-pro" ); ?>
						</a>
					<?php } ?>
				<?php } ?>
			</div>
			
			<!-- This brings in menu.php // remove it and the whole menu won't show at all -->
			<?php if ( wptouch_has_menu() ) { ?>
				<div id="main-menu" class="closed">
					<!-- The Hidden Search Bar -->
					<div id="search-bar">
						<div id="wptouch-search-inner">
							<form method="get" id="searchform" action="<?php wptouch_bloginfo( 'search_url' ); ?>/">
								<input type="text" name="s" id="search-input" tabindex="1" placeholder="<?php _e( 'Search', 'wptouch-pro' ); ?>&hellip;" />
								<input name="submit" type="hidden" id="search-submit-hidden" tabindex="2" />
							</form>
						</div>		
					</div>
					<!-- The WPtouch Tab-Bar // includes Page Menu -->
					<?php include_once( 'tab-bar.php' ); ?>	
				</div>
			<?php } ?>
			
			<?php do_action( 'wptouch_body_top' ); ?>
		
			<div id="content">
				<?php do_action( 'wptouch_advertising_top' ); ?>