<?php

add_filter( 'wptouch_default_settings', 'classic_default_settings' );
add_filter( 'wptouch_theme_menu', 'classic_admin_menu' );

/* Default Settings */

// All default settings must be added to the $settings object here
// All settings should be properly namespaced in a copied theme, i.e. theme_name_my_setting instead of just my_setting or classic_
function classic_default_settings( $settings ) {
	// General Settings
	$settings->classic_latest_posts_page = 'none';
	$settings->classic_ajax_mode_enabled = true;
	$settings->classic_mobile_enable_zoom = false;
	$settings->classic_hide_addressbar = true;
	$settings->classic_use_compat_css = true;
	$settings->classic_excluded_categories = '';
	$settings->classic_excluded_tags = '';
	
	// Style and Appearance
	$settings->classic_header_img_location = '';
	$settings->classic_retina_header_img_location = '';
	$settings->classic_header_shading_style = 'glossy';
	$settings->classic_header_font = 'Helvetica-Bold';
	$settings->classic_header_title_font_size = '19px';
	$settings->classic_header_color_style = 'classic-black';
	$settings->classic_show_header_icon = true;

	$settings->classic_general_font = 'Helvetica';
	$settings->classic_general_font_size = '13px';
	$settings->classic_general_font_color = '333333';

	$settings->classic_post_title_font = 'Helvetica-Bold';
	$settings->classic_post_title_font_size = '15px';
	$settings->classic_post_title_font_color = '333333';

	$settings->classic_post_body_font = 'Helvetica';
	$settings->classic_post_body_font_size = '14px';
	
	$settings->classic_text_justification = 'left-justify';

	$settings->classic_link_color = '006bb3';
	$settings->classic_context_headers_color = '475d79';
	$settings->classic_footer_text_color = '666666';
	$settings->classic_text_shade_color = 'light';

	$settings->classic_background_image = 'ipad-thatch-light';
	$settings->classic_background_repeat	 = 'repeat';
	$settings->classic_background_color = 'CCCCCC';
	$settings->classic_custom_background_image = '';

	// Post Icon Settings
	$settings->classic_icon_type = 'calendar';
	$settings->classic_calendar_icon_bg = 'cal-colors';
	$settings->classic_custom_cal_icon_color = '';
	$settings->classic_custom_field_thumbnail_name = 'thumbnail';
	$settings->classic_thumbs_on_single = false;
	$settings->classic_thumbs_on_pages = false;

	// Menu Settings
	$settings->classic_use_menu_icon = true;
	$settings->make_menu_relative = true;
	$settings->classic_show_categories = true;
	$settings->classic_show_tags = true;
	$settings->classic_show_account = false;
	$settings->classic_show_admin_menu_link = true;
	$settings->classic_show_profile_menu_link = true;
	$settings->classic_show_archives = false;
	$settings->classic_show_links = false;
	$settings->classic_show_flickr_rss = false;
	$settings->classic_show_search = true;

	// Post Settings
	$settings->classic_show_post_author = true;
	$settings->classic_show_post_categories = true;
	$settings->classic_show_post_tags = true;
	$settings->classic_show_post_date = true;
	$settings->classic_show_excerpts = 'excerpts-hidden';
	
	// Single Post Settings
	$settings->classic_show_post_author_single = true;
	$settings->classic_show_post_date_single = true;
	$settings->classic_show_post_cats_single = true;
	$settings->classic_show_post_cats_single = true;
	$settings->classic_show_post_tags_single = true;
	$settings->classic_show_share_save = true;
	$settings->classic_hide_responses = false;
	$settings->classic_show_attached_image = false;
	$settings->classic_show_attached_image_location = 'above';

	// Page Options
	$settings->classic_show_attached_image_on_page = false;
	$settings->classic_show_comments_on_pages = false;

	// UA Settings
	$settings->classic_custom_user_agents = '';

	// Web App Settings
	$settings->classic_webapp_enabled = true;
	$settings->classic_webapp_use_ajax = true;
	$settings->classic_webapp_use_loading_img = false;
	$settings->classic_webapp_status_bar_color = 'default';
	$settings->classic_enable_persistent = true;
	$settings->classic_show_webapp_notice = false;
	$settings->classic_webapp_notice_expiry_days = '30';
	$settings->classic_webapp_loading_img_location = '';
	$settings->classic_webapp_retina_loading_img_location = '';
	$settings->classic_ipad_webapp_loading_img_location = '';
	$settings->classic_ipad_webapp_landscape_loading_img_location = '';
	$settings->classic_add2home_msg = __( 'Install this Web-App on your [device]: tap [icon] then "Add to Home Screen"', 'wptouch-pro' );

	// iPad Settings
	$settings->classic_ipad_theme_color = 'grey';
	$settings->classic_ipad_logo_image = '';
	$settings->classic_ipad_content_bg = 'ipad-content-default';
	$settings->classic_ipad_content_bg_custom = '';
	$settings->classic_ipad_background_repeat	 = 'repeat';
	$settings->classic_ipad_sidebar_bg = 'ipad-sidebar-default';
	$settings->classic_ipad_sidebar_bg_custom = '';

	$settings->classic_ipad_general_font = $settings->classic_general_font;
	$settings->classic_ipad_general_font_size = '15px';
	$settings->classic_ipad_general_font_color = $settings->classic_general_font_color;
	
	$settings->classic_ipad_post_title_font = $settings->classic_post_title_font;
	$settings->classic_ipad_post_title_font_size = '22px';
	$settings->classic_ipad_post_title_font_color = '333333';

	$settings->classic_ipad_post_body_font = $settings->classic_post_body_font;
	$settings->classic_ipad_post_body_font_size = '15px';
	
	$settings->classic_ipad_text_justification = 'left-justify';

	$settings->classic_ipad_link_color = $settings->classic_link_color;
	$settings->classic_ipad_active_link_color = '000';
	$settings->classic_ipad_context_headers_color = $settings->classic_context_headers_color;
	$settings->classic_ipad_footer_text_color = $settings->classic_footer_text_color;
	$settings->classic_ipad_text_shade_color = $settings->classic_text_shade_color;

	// General
	$settings->classic_ipad_home_button = true;
	$settings->classic_ipad_blog_button = true;
	$settings->classic_ipad_recent_posts = true;
	$settings->classic_ipad_popular_posts = true;
	$settings->classic_ipad_popover_tags = true;
	$settings->classic_ipad_popover_cats = true;
	$settings->classic_ipad_account_button = false;
	$settings->classic_ipad_search_button = true;

	// Extensions //

	// WordTwit Pro
	$settings->classic_show_wordtwit = false;
	$settings->classic_ipad_show_wordtwit = false;

	// FlickrRSS
	$settings->classic_show_flickr_rss = false;
	$settings->classic_ipad_show_flickr_button = false;
	
	return $settings;
}

// The administrational page for the classic theme is constructed here:
function classic_admin_menu( $menu ) {
	$menu = array(
		__( "Theme General", "wptouch-pro" ) => array ( 'general', 
			array(
				array( 'section-start', 'misc-options', __( 'Miscellaneous Options', "wptouch-pro" ) ),
				array( 'copytext', 'ipad-copytext-info', __( 'Blue dot settings are shared between both Mobile + iPad.', 'wptouch-pro' ) ),
				array( 'custom-latest', '', '', '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_ajax_mode_enabled', __( 'Enable AJAX "Load More" link for posts and comments', "wptouch-pro" ), __( 'Posts and comments will be appended to existing content with an AJAX "Load More..." link. If unchecked regular post/comment pagination will be used.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'checkbox', 'classic_mobile_enable_zoom', __( 'Allow zooming', "wptouch-pro" ), __( 'Will allow visitors to zoom in/out on content.', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_hide_addressbar', __( 'Hide address bar on page load', "wptouch-pro" ), __( 'Will hide the address bar in compatible browsers on a page load, showing the WPtouch header as the top of the page.', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_use_compat_css', __( 'Use compatibility CSS', "wptouch-pro" ), __( 'Add the compat.css file from the theme folder. Contains various CSS declarations for a variety of plugins.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'text', 'classic_excluded_categories', __( 'Excluded Categories (Comma list of category IDs)', "wptouch-pro" ), __( 'Posts in these categories will not be shown in WPtouch. (e.g. 3,4,5)', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'text', 'classic_excluded_tags', __( 'Excluded Tags (Comma list of tag IDs)', "wptouch-pro" ), __( 'Posts with these tags will not be shown in WPtouch. (e.g. 3,4,5)', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'section-end' )
				) 
			),	
		__( "iOS Web-App Mode", "wptouch-pro" ) => array ( 'web-app-mode', 
			array(
				array( 'section-start', 'web-app-toggle', __( 'Enable/Disable Web-App Mode', "wptouch-pro" ) ),	
				array( 'checkbox', 'classic_webapp_enabled', __( 'Enable Web-App Mode', "wptouch-pro" ), __( 'When checked WPtouch will allow iPhone, iPod touch and iPad visitors to bookmark your site to their home-screens as a web application.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'section-end' ),
				array( 'spacer' ),
				array( 'section-start', 'web-app-settings', __( 'Web-App Mode Settings', "wptouch-pro" ) ),	
				array( 'list', 'classic_webapp_status_bar_color', __( 'Status Bar Color', "wptouch-pro" ), __( 'Choose between grey (default), black or black-translucent.', "wptouch-pro" ), 
					array( 
						'default' => __( 'Default (Grey)', 'wptouch-pro' ), 
						'black' => __( 'Black', 'wptouch-pro' ), 
						'black-translucent' => __( 'Black Translucent', 'wptouch-pro' )
					)
				),
				array( 'checkbox', 'classic_enable_persistent', __( 'Enable persistence', "wptouch-pro" ), __( 'When checked WPtouch will remember and load the last visited page or post for a visitor when entering Web-App Mode.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'checkbox', 'classic_webapp_use_ajax', __( 'Use AJAX to load posts and pages', "wptouch-pro" ), __( 'Speeds up loading of content, but is less compatible with some plugins. Disable if some features of your site are not working in Web-App Mode.', "wptouch-pro" ) ),
				array( 'spacer' ),
				array( 'checkbox', 'classic_show_webapp_notice', __( 'Show a notice bubble for iPhone, iPod touch & iPad visitors about Web-App Mode', "wptouch-pro" ), __( 'When checked WPtouch will show a notice bubble on first visit letting users know about your web-app enabled website on iOS devices.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'textarea', 'classic_add2home_msg', __( 'Message shown in the notice bubble for iPhone, iPod touch & iPad visitors:', "wptouch-pro" ), __( '[device] and [icon] are dynamic and used to determine the device and iOS version. Do not remove these from your message.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'text', 'classic_webapp_notice_expiry_days', __( 'Number of days before the message will be shown again to visitors', "wptouch-pro" ), __( 'Entering 0 will cause the bubble to always be shown, useful for development.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'spacer' ),
				array( 'checkbox', 'classic_webapp_use_loading_img', __( 'Use startup screens', "wptouch-pro" ), __( 'When checked your website will show a startup image in Web-App Mode. If no paths are specified default startup screens will be used.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'text', 'classic_webapp_loading_img_location', __( 'URL to iPhone startup screen (320x460) (.png)', "wptouch-pro" ) ),
				array( 'text', 'classic_webapp_retina_loading_img_location', __( 'URL to iPhone 4 Retina Display startup screen (640x920) (.png) (iOS 5)', "wptouch-pro" ) ),
				array( 'text', 'classic_ipad_webapp_loading_img_location', __( 'URL to iPad Portrait startup screen (768x1004) (.png)', "wptouch-pro" ) ),
				array( 'text', 'classic_ipad_webapp_landscape_loading_img_location', __( 'URL to iPad Landscape startup screen (1024x748) (.png) (iOS 5)', "wptouch-pro" ) ),
				array( 'copytext', 'webapp-copytext-info', sprintf( __( '%sNOTE: Changing the startup screen settings may require you to re-add to the home-screen on pre-iOS 5 devices.%s', "wptouch-pro" ), '<small>', '</small>' ) ),
				array( 'section-end' ) 
				)
			),	

		__( "Menu, Posts and Pages", "wptouch-pro" ) => array ( 'post-theme', 
			array(		
				array( 'section-start', 'menu-options', __( 'Theme Menu', "wptouch-pro" ) ),
//				array( 'checkbox', 'make_menu_relative', __( 'Make menu drop-down relatively positioned', "wptouch-pro" ), __( 'Will make the menu push the content below it down the page. Fixes issues with videos/YouTube overlaying the content of the menu, and may improve menu performance on some devices.', "wptouch-pro"  ) ),
				array( 'checkbox', 'classic_use_menu_icon', __( 'Use menu icon for menu button', "wptouch-pro" ), __( 'If unchecked the word "Menu" will be shown instead of an icon.', "wptouch-pro"  ) ),
				array( 'checkbox', 'classic_show_categories', __( 'Show Categories in tab-bar', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_show_tags', __( 'Show Tags in tab-bar', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_show_account', __( 'Show Account in tab-bar', "wptouch-pro" ), __( 'Will always show account login/links in tab bar, even if registration for your website is not allowed.', "wptouch-pro"  ) ),
				array( 'checkbox', 'classic_show_search', __( 'Show Search in tab-bar', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_show_admin_menu_link', __( 'Show "Admin" in Account tab links', "wptouch-pro" ), __( 'Shows an "Admin" menu link for logged in users that have edit posts capability.', "wptouch-pro"  ), array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_profile_menu_link', __( 'Show "Profile" in Account tab links', "wptouch-pro" ), __( 'Show a "Profile" link for all logged in users.', "wptouch-pro"  ), array( 'ipad' ) ),
				array( 'spacer' ),
				array( 'copytext', 'copytext-info-push', __( 'The push message and account tabs are shown/hidden automatically.', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'section-end' )	,
				array( 'spacer' ),
				array( 'section-start', 'template-options', __( 'Theme Templates', "wptouch-pro" ) ),
				array( 'copytext', 'copytext-info-templates', __( 'These templates are custom to WPtouch. They trigger a new menu item which can be configured in the menu settings once activated here.', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_archives', __( 'Use WPtouch Archives template', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_links', __( 'Use WPtouch Links template', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'section-end' )	,
				array( 'spacer' ),
				array( 'section-start', 'post-options', __( 'Blog Listings', "wptouch-pro" ) ),
				array( 'copytext', 'copytext-info-post-opts', __( 'These settings affect the display of posts on the WPtouch blog, blog archive & search pages.', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_show_post_author', __( 'Show author name', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_post_categories', __( 'Show categories', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_post_tags', __( 'Show tags', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_post_date', __( 'Show date', "wptouch-pro" ), __( 'Will show the date in post listings where thumbnails or none are selected in the post icon settings. Does not affect calendar icons.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'list', 'classic_show_excerpts', __( 'Excerpt/Content Options', "wptouch-pro" ), __( 'Choose how excerpts are handled in the blog. Search and archive templates always use excerpts.', "wptouch-pro" ), 
					array( 
						'excerpts-hidden' => __( 'Excerpts hidden', 'wptouch-pro' ), 
						'excerpts-shown' => __( 'Excerpts shown', 'wptouch-pro' ), 
						'full-hidden' => __( 'Full posts hidden', 'wptouch-pro' ),	
						'full-shown' => __( 'Full posts shown', 'wptouch-pro' ),	
						'first-full-hidden' => __( 'First w/ full post shown, others excerpted and hidden', 'wptouch-pro' ), 
						'first-full-shown' => __( 'First w/ full post shown, others excerpted and shown', 'wptouch-pro' ) 
					) 
				),	
				array( 'section-end' )	,
				array( 'spacer' ),
				array( 'section-start', 'single-post-options', __( 'Single Posts', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_show_post_author_single', __( 'Show author in post header', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_post_date_single', __( 'Show date in post header', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_post_cats_single', __( 'Show categories post footer', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_post_tags_single', __( 'Show tags post footer', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_share_save', __( 'Show "Share/Save" button', "wptouch-pro" ), __('The "Share/Save" button allows visitors to bookmark your site, share on popular services and via e-mail, or save to Instapaper. You may want to disable it if you use another sharing plugin.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'checkbox', 'classic_hide_responses', __( 'Hide Responses', "wptouch-pro" ), __('Hides comments, trackbacks and pingbacks by default, until a visitor clicks to show them. Speeds up load times if hidden.', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_show_attached_image', __( 'Show attached image in post content', 'wptouch-pro' ), __( 'This option can be used to include an attached image in the post content.  The image is only included if it doesn\'t already exist in the post content.', 'wptouch-pro' ), array( 'ipad' ) ),
				array( 'list', 'classic_show_attached_image_location', __( 'Attached image location in post content', 'wptouch-pro' ), '', 
					array(
						'above' => __( 'Above content', 'wptouch-pro' ),
						'below' => __( 'Below content', 'wptouch-pro' )
					), array( 'ipad' )
				),				
				array( 'section-end' )	,
				array( 'spacer' ),
				array( 'section-start', 'page-options', __( 'Pages', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_show_attached_image_on_page', __( 'Show attached image in page content', 'wptouch-pro' ), __( 'This option can be used to include an attached image in the page content.  The image is only included if it doesn\'t already exist in the page content.', 'wptouch-pro' ), array( 'ipad' ) ),
				array( 'checkbox', 'classic_show_comments_on_pages', __( 'Show comments on pages', "wptouch-pro" ), __( 'Enabling this setting will cause comments to be shown on pages, if they are enabled in the WordPress settings.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'section-end' )	
			)
		),
		__( 'Style / Appearance', "wptouch-pro" ) => array( 'style-options',
			array(
				array( 'section-start', 'header-style-settings', __( 'Header Styling', "wptouch-pro" ) ),	
				array( 'text', 'classic_header_img_location', __( 'URL to a custom header logo', "wptouch-pro" ), __( 'Should be 270px (width) by 44px (height). Transparent .PNG is recommended. If no image is specified here the default Site Icon and Site Title will be used.', "wptouch-pro" ) ),
				array( 'text', 'classic_retina_header_img_location', __( 'URL to a custom header logo (Retina Sized @ 2x)', "wptouch-pro" ), __( 'Should be 540px (width) by 88px (height). Transparent .PNG is recommended.', "wptouch-pro" ) ),
				array( 'list', 'classic_header_font', __( 'Header title font', "wptouch-pro" ), '', classic_theme_font_options()	),
				array( 'list', 'classic_header_title_font_size', __( 'Header title font size', "wptouch-pro" ), '', 
					array( 
						'16px' => __( '16px', 'wptouch-pro' ), 
						'17px' => __( '17px', 'wptouch-pro' ), 
						'18px' => __( '18px', 'wptouch-pro' ), 
						'19px' => __( '19px', 'wptouch-pro' ),
						'20px' => __( '20px', 'wptouch-pro' ),
						'21px' => __( '21px', 'wptouch-pro' ),
						'22px' => __( '22px', 'wptouch-pro' ),
						'23px' => __( '23px', 'wptouch-pro' ),
						'24px' => __( '24px', 'wptouch-pro' )
					) 
				),
				array( 'list', 'classic_header_color_style', __( 'Header Color Group', "wptouch-pro" ), __( 'Choose between a variety of color package header styles.', "wptouch-pro" ), 
					array( 
						'classic-black' => __( 'Classic Black (Default)', 'wptouch-pro' ), 
						'clean-white' => __( 'Clean White', 'wptouch-pro' ), 
						'silver-sheen' => __( 'Silver Sheen', 'wptouch-pro' ),
						'blue-ocean' => __( 'Blue Ocean', 'wptouch-pro' ),
						'red-bull' => __( 'Red Bull', 'wptouch-pro' ),
						'green-planet' => __( 'Green Planet', 'wptouch-pro' ),
						'sunkissed-orange' => __( 'Sunkissed Orange', 'wptouch-pro' ),
						'violet-purple' => __( 'Violet Purple', 'wptouch-pro' )
					) 
				),
				array( 'list', 'classic_header_shading_style', __( 'Header Shading Gradient Style', "wptouch-pro" ), __( 'Changes the default glossy look to other styles.', "wptouch-pro" ), 
					array( 
						'glossy' => __( 'Default (Glossy)', 'wptouch-pro' ), 
						'matte' => __( 'Matte', 'wptouch-pro' ),
						'grainy' => __( 'Grainy', 'wptouch-pro' ),
						'none' => __( 'None', 'wptouch-pro' )
					) 
				),
				array( 'checkbox', 'classic_show_header_icon', __( 'Show header icon', "wptouch-pro" ), __( 'Show/hide the header site icon beside your site title. If you use a custom logo image this setting will not apply.', "wptouch-pro" ) ),
				array( 'section-end' ),
				array( 'spacer' ),
				array( 'section-start', 'body-style-settings', __( 'Body and Post Styling', "wptouch-pro" ) ),	
				array( 'list', 'classic_general_font', __( 'General site font', "wptouch-pro" ), '', classic_theme_font_options() ),
				array( 'list', 'classic_general_font_size', __( 'General site font size', "wptouch-pro" ), '', 
					array( 
						'11px' => __( '11px', 'wptouch-pro' ), 
						'12px' => __( '12px', 'wptouch-pro' ),
						'13px' => __( '13px', 'wptouch-pro' ),
						'14px' => __( '14px', 'wptouch-pro' ),
						'15px' => __( '15px', 'wptouch-pro' ),
						'16px' => __( '16px', 'wptouch-pro' )
					) 
				),
				array( 'list', 'classic_post_title_font', __( 'Post title font', "wptouch-pro" ), '', classic_theme_font_options() ),
				array( 'list', 'classic_post_title_font_size', __( 'Post title font size', "wptouch-pro" ), '', 
					array( 
						'14px' => __( '14px', 'wptouch-pro' ), 
						'15px' => __( '15px', 'wptouch-pro' ), 
						'16px' => __( '16px', 'wptouch-pro' ), 
						'17px' => __( '17px', 'wptouch-pro' ), 
						'18px' => __( '18px', 'wptouch-pro' ), 
						'19px' => __( '19px', 'wptouch-pro' ),
						'20px' => __( '20px', 'wptouch-pro' ),
						'21px' => __( '21px', 'wptouch-pro' ),
						'22px' => __( '22px', 'wptouch-pro' )
					) 
				),
				array( 'list', 'classic_post_body_font', __( 'Post body font', "wptouch-pro" ), '', classic_theme_font_options() ),
				array( 'list', 'classic_post_body_font_size', __( 'Post body font size', "wptouch-pro" ), '', 
					array( 
						'11px' => __( '11px', 'wptouch-pro' ), 
						'12px' => __( '12px', 'wptouch-pro' ),
						'13px' => __( '13px', 'wptouch-pro' ),
						'14px' => __( '14px', 'wptouch-pro' ),
						'15px' => __( '15px', 'wptouch-pro' ),
						'16px' => __( '16px', 'wptouch-pro' )
					) 
				),
				array( 'list', 'classic_text_justification', __( 'Text justification in post listings, single posts / comments, and pages', "wptouch-pro" ), '',
					array( 
						'left-justify' => __( 'Left', 'wptouch-pro' ),
						'full-justify' => __( 'Full', 'wptouch-pro' ),
						'right-justify' => __( 'Right RTL (experimental)', 'wptouch-pro' )
					) 
				),	
				array( 'text', 'classic_general_font_color', __( 'Sitewide font color', "wptouch-pro" ), __( 'e.g. FFFFFF, (Hex without #)', "wptouch-pro"  ) ),
				array( 'text', 'classic_post_title_font_color', __( 'Sitewide post title color', "wptouch-pro" ) ),
				array( 'text', 'classic_link_color', __( 'Sitewide link color', "wptouch-pro" ) ),
				array( 'text', 'classic_context_headers_color', __( 'Context and label headings color', "wptouch-pro" ), __( 'The context header shows for results pages (e.g. Search Results, Leave A Reply) and other labels and headings.', "wptouch-pro"  ) ),
				array( 'text', 'classic_footer_text_color', __( 'Footer text color', "wptouch-pro" ), __( 'This will govern the color of all text in the footer, except for links.', "wptouch-pro"  ) ),
				array( 'list', 'classic_text_shade_color', __( 'Text shading for headers, footer text', "wptouch-pro" ), __( 'Use "dark" for dark backgrounds, "light" for light backgrounds', "wptouch-pro" ), 
					array( 
						'light' => __( 'Light', 'wptouch-pro' ), 
						'dark' => __( 'Dark', 'wptouch-pro' )
					) 
				),
				array( 'copytext', 'copytext-colorpicker', sprintf( __( '%sOpen Color Picker Tool%s', "wptouch-pro" ), '<a href="http://www.colorpicker.com/" class="ajax-button" id="color-picker">', '</a>' ) ),
				array( 'section-end' )	,
				array( 'spacer' ),
				array( 'section-start', 'background-options', __( 'Background', "wptouch-pro" ) ),
				array( 'text', 'classic_background_color', __( 'Background hex color (without #)', "wptouch-pro" ), __( 'If background images are used, the background color is still included.', "wptouch-pro" ) ),
				array( 'list', 'classic_background_image', __( 'Background tile', "wptouch-pro" ), __( 'Choose a background tile for your theme. Will be repeated vertically and horizontally.', "wptouch-pro" ), 
					array( 
						'ipad-thatch-light' => __( 'Thatch (default)', 'wptouch-pro' ),
						'ipad-thatch' => __( 'Thatch (dark)', 'wptouch-pro' ), 
						'thinstripes' => __( 'Thin Stripes', 'wptouch-pro' ), 
						'thickstripes' => __( 'Thick Stripes', 'wptouch-pro' ), 
						'pinstripes-blue' => __( 'Pinstripes Vertical (Blue)', 'wptouch-pro' ), 
						'pinstripes-grey' => __( 'Pinstripes Vertical (Grey)', 'wptouch-pro' ), 
						'pinstripes-horizontal' => __( 'Pinstripes Horizontal', 'wptouch-pro' ), 
						'pinstripes-diagonal' => __( 'Pinstripes Diagonal', 'wptouch-pro' ), 
						'skated-concrete' => __( 'Skated Concrete', 'wptouch-pro' ), 
						'grainy' => __( 'Grainy', 'wptouch-pro' ), 
						'cog-canvas' => __( 'Cog Canvas', 'wptouch-pro' ), 
						'dark-grey-thatch' => __( 'Dark Grey Thatch', 'wptouch-pro' ), 
						'none' => __( 'None', 'wptouch-pro' ) 
					)
				),	
				array( 'text', 'classic_custom_background_image', __( 'URL path to a custom background', "wptouch-pro" ) ),
				array( 'list', 'classic_background_repeat', __( 'Custom background image repeat type', "wptouch-pro" ), '', 
					array( 
						'repeat' => __( 'Repeat Both', 'wptouch-pro' ),
						'repeat-x' => __( 'Repeat Horizontally', 'wptouch-pro' ), 
						'repeat-y' => __( 'Repeat Vertically', 'wptouch-pro' ),
						'no-repeat' => __( 'Repeat None', 'wptouch-pro' )
					)
				),	
				array( 'section-end' ),
				array( 'spacer' ),
				array( 'section-start', 'post-icon-options', __( 'Calendar/Thumbnail Icons', "wptouch-pro" ) ),
				array( 'list', 'classic_icon_type', __( 'Post icon type', "wptouch-pro" ), __( 'You can choose between calendar icons, WordPress thumbnails, custom field thumbnails, or if activated, the Simple Post Thumbnails plugin.', "wptouch-pro" ), classic_theme_thumbnail_options(), array( 'ipad' ) ),
				array( 'text', 'classic_custom_field_thumbnail_name', __( 'Custom field name for thumbnails', 'wptouch-pro' ), __( 'Enter the name of the custom field used for your custom post thumbnails.', 'wptouch-pro' ), array( 'ipad' ) ),					
				array( 'section-end' ),
				array( 'section-start', 'thumbnail-icon-options', __( 'Thumbnail Icons', "wptouch-pro" ) ),				
				array( 'checkbox', 'classic_thumbs_on_single', __( 'Show thumbnails on single post pages next to the post title', "wptouch-pro" ), '', array( 'ipad' ) ),
				array( 'checkbox', 'classic_thumbs_on_pages', __( 'Prefer thumbnails on pages over page icons (WordPress thumbs only)', "wptouch-pro" ), __( 'Will show a page thumbnail or featured image instead of the page icon used in the menu. If no thumbnail is specified, the page icon will be used instead.', "wptouch-pro" ), array( 'ipad' ) ),
				array( 'text', 'post_thumbnails_new_image_size', __( 'Size (in px) for Classic thumbnails', 'wptouch-pro' ), __( 'Changing this setting will not affect existing post thumbnails.', 'wptouch-pro' ), array( 'ipad' ) ),
				array( 'copytext', 'regenerate-copytext-info', sprintf( __( '<small>NOTE: You can regenerate your WordPress thumbnails using the %sRegenerate Thumbnails%s plugin.<br />This will tell wordpress to make new thumbnails for WPtouch this size.</small>', "wptouch-pro" ), '<a target="_blank" href="http://wordpress.org/extend/plugins/regenerate-thumbnails/">', '</a>' ) ),
				array( 'section-end' ),
				array( 'section-start', 'calendar-icon-options', __( 'Calendar Icons', "wptouch-pro" ) ),					
				array( 'list', 'classic_calendar_icon_bg', __( 'Calendar icons background color', "wptouch-pro" ), __( 'Choose the appearance of your Calendar icons.', "wptouch-pro" ), 
					array( 
						'cal-blue' => __( 'Classic Blue', 'wptouch-pro' ), 
						'cal-colors' => __( 'Various Colors', 'wptouch-pro' ), 
						'cal-ltg' => __( 'Light Grey', 'wptouch-pro' ),	
						'cal-dkg' => __( 'Dark Grey', 'wptouch-pro' ),
						'cal-custom' => __( 'Custom', 'wptouch-pro' )
					), array( 'ipad' )
				),	
				array( 'text', 'classic_custom_cal_icon_color', __( 'Custom calendar icon color (Hex without #)', 'wptouch-pro' ), '', array( 'ipad' ) ),					
				array( 'section-end' )	
			)
		),
		__( 'iPad Settings', "wptouch-pro" ) => array( 'ipad-theme-settings',
			array(
				array( 'section-start', 'ipad-info', __( 'Enable/Disable iPad Support', "wptouch-pro" ) ),	
				array( 
				'list', 
				'ipad_support', __( 'iPad Support', 'wptouch-pro' ), 
				'', 
				array(
					'none' => __( 'Disabled', 'wptouch-pro' ),
					'full' => __( 'Enabled', 'wptouch-pro' )				
//					'partial' => __( 'Menu bar on desktop theme only', 'wptouch-pro' ),
				)
			),	
				array( 'section-end' ),
				array( 'spacer' ),				
				array( 'section-start', 'ipad-style-settings', __( 'Style and Appearance', "wptouch-pro" ) ),
				array( 'copytext', 'ipad-copytext-info-2', 'Settings below are unique to your iPad theme, and will not affect your mobile theme.', "wptouch-pro" ),
				array( 'list', 'classic_ipad_theme_color', __( 'Header bar, pop-overs and general theme style', "wptouch-pro" ), __( 'Unique to iPad, all colors, gradients & shading are done in CSS, optimized for maximum speed', "wptouch-pro" ),
					array( 
						'grey' => __( 'Default (Grey)', 'wptouch-pro' ), 
						'deep-blue' => __( 'Deep Blue', 'wptouch-pro' ),
						'black' => __( 'Black', 'wptouch-pro' )
					),
				),
				array( 'text', 'classic_ipad_logo_image', __( 'URL for iPad logo Image shown in the landscape menu', "wptouch-pro" ), __( 'If no path is specified no image will be used, and the WPtouch Pro menu will be full height. (300px by 185px transparent .png recommended)', "wptouch-pro" ) ),
				array( 'spacer' ),				
				array( 'list', 'classic_ipad_content_bg', __( 'Content Background', "wptouch-pro" ), '',
					array( 
						'ipad-content-default' => __( 'Subtle Noise (default)', 'wptouch-pro' ),
						'thinstripes' => __( 'Thin Stripes', 'wptouch-pro' ), 
						'thickstripes' => __( 'Thick Stripes', 'wptouch-pro' ), 
						'pinstripes-blue' => __( 'Pinstripes Vertical (Blue)', 'wptouch-pro' ), 
						'pinstripes-grey' => __( 'Pinstripes Vertical (Grey)', 'wptouch-pro' ), 
						'pinstripes-horizontal' => __( 'Pinstripes Horizontal', 'wptouch-pro' ), 
						'pinstripes-diagonal' => __( 'Pinstripes Diagonal', 'wptouch-pro' ), 
						'skated-concrete' => __( 'Skated Concrete', 'wptouch-pro' ), 
						'grainy' => __( 'Grainy', 'wptouch-pro' ), 
						'cog-canvas' => __( 'Cog Canvas', 'wptouch-pro' ),
						'custom' => __( 'Custom Background', 'wptouch-pro' )
					),
				),
				array( 'text', 'classic_ipad_content_bg_custom', __( 'URL to custom content area background', "wptouch-pro" ) ),
				array( 'list', 'classic_ipad_background_repeat', __( 'Custom iPad background repeat type', "wptouch-pro" ), '', 
					array( 
						'repeat' => __( 'Repeat Both', 'wptouch-pro' ),
						'repeat-x' => __( 'Repeat Horizontally', 'wptouch-pro' ), 
						'repeat-y' => __( 'Repeat Vertically', 'wptouch-pro' ),
						'no-repeat' => __( 'Repeat None', 'wptouch-pro' )
					)
				),	
				array( 'spacer' ),				
				array( 'list', 'classic_ipad_sidebar_bg', __( 'Sidebar Background', "wptouch-pro" ), __( 'This background shows in the landscape menu.', "wptouch-pro" ),
					array( 
						'ipad-sidebar-default' => __( 'iPad thatch (default)', 'wptouch-pro' ),
						'ipad-sidebar-blue' => __( 'Deep Blue', 'wptouch-pro' ),
						'ipad-sidebar-circles' => __( 'Dark Grey Circles', 'wptouch-pro' ),
						'ipad-sidebar-canvas' => __( 'Dark Grey Canvas', 'wptouch-pro' ),
						'ipad-sidebar-dots' => __( 'Bevelled Dots', 'wptouch-pro' ),
						'custom' => __( 'Custom Background', 'wptouch-pro' )

					),
				),
				array( 'text', 'classic_ipad_sidebar_bg_custom', __( 'URL to custom sidebar area background (repeated X and Y)', "wptouch-pro" ) ),
				array( 'spacer' ),				
				array( 'list', 'classic_ipad_general_font', __( 'General site font', "wptouch-pro" ), '', classic_theme_font_options() ),
				array( 'list', 'classic_ipad_general_font_size', __( 'General site font size', "wptouch-pro" ), '', 
					array( 
						'13px' => __( '13px', 'wptouch-pro' ),
						'14px' => __( '14px', 'wptouch-pro' ),
						'15px' => __( '15px', 'wptouch-pro' ),
						'16px' => __( '16px', 'wptouch-pro' ),
						'17px' => __( '17px', 'wptouch-pro' ),
						'18px' => __( '18px', 'wptouch-pro' ),
						'19px' => __( '19px', 'wptouch-pro' )
					) 
				),
				array( 'list', 'classic_ipad_post_title_font', __( 'Post title font', "wptouch-pro" ), '', classic_theme_font_options() ),
				array( 'list', 'classic_ipad_post_title_font_size', __( 'Post title font size', "wptouch-pro" ), '', 
					array( 
						'22px' => __( '22px', 'wptouch-pro' ),
						'23px' => __( '23px', 'wptouch-pro' ),
						'24px' => __( '24px', 'wptouch-pro' ),
						'25px' => __( '25px', 'wptouch-pro' ),
						'26px' => __( '26px', 'wptouch-pro' ),
						'27px' => __( '27px', 'wptouch-pro' ),
						'28px' => __( '28px', 'wptouch-pro' ),
						'29px' => __( '29px', 'wptouch-pro' ),
						'30px' => __( '30px', 'wptouch-pro' )
					) 
				),
				array( 'list', 'classic_ipad_post_body_font', __( 'Post body font', "wptouch-pro" ), '', classic_theme_font_options() ),
				array( 'list', 'classic_ipad_post_body_font_size', __( 'Post body font size', "wptouch-pro" ), '', 
					array( 
						'13px' => __( '13px', 'wptouch-pro' ),
						'14px' => __( '14px', 'wptouch-pro' ),
						'15px' => __( '15px', 'wptouch-pro' ),
						'16px' => __( '16px', 'wptouch-pro' ),
						'17px' => __( '17px', 'wptouch-pro' ),
						'18px' => __( '18px', 'wptouch-pro' ),
						'19px' => __( '19px', 'wptouch-pro' )
					) 
				),
				array( 'list', 'classic_ipad_text_justification', __( 'Text justification in post listings, single posts / comments, and pages', "wptouch-pro" ), '',
					array( 
						'left-justify' => __( 'Left', 'wptouch-pro' ),
						'full-justify' => __( 'Full', 'wptouch-pro' ),
						'right-justify' => __( 'Right RTL (experimental)', 'wptouch-pro' )
					) 
				),	
				array( 'spacer' ),				
				array( 'text', 'classic_ipad_general_font_color', __( 'Sitewide font color', "wptouch-pro" ), __( 'e.g. FFFFFF, (Hex without #)', "wptouch-pro"  ) ),
				array( 'text', 'classic_ipad_post_title_font_color', __( 'Sitewide post title color', "wptouch-pro" ) ),
				array( 'text', 'classic_ipad_link_color', __( 'Sitewide link color', "wptouch-pro" ) ),
				array( 'text', 'classic_ipad_active_link_color', __( 'Content area active link color', "wptouch-pro" ) ),
				array( 'text', 'classic_ipad_context_headers_color', __( 'Context and label headings color', "wptouch-pro" ), __( 'The context header shows for results pages (e.g. Search Results, Leave A Reply) and other labels and headings.', "wptouch-pro"  ) ),
				array( 'text', 'classic_ipad_footer_text_color', __( 'Footer text color', "wptouch-pro" ), __( 'This will govern the color of all text in the footer, except for links.', "wptouch-pro"  ) ),
				array( 'list', 'classic_ipad_text_shade_color', __( 'Text shading for headers, footer text', "wptouch-pro" ), __( 'Use "dark" for dark backgrounds, "light" for light backgrounds', "wptouch-pro" ), 
					array( 
						'light' => __( 'Light', 'wptouch-pro' ), 
						'dark' => __( 'Dark', 'wptouch-pro' )
					) 
				),
				array( 'copytext', 'copytext-ipad-colorpicker', sprintf( __( '%sOpen colorpicker.com Color Picker%s', "wptouch-pro" ), '<a href="http://www.colorpicker.com/" class="ajax-button" id="color-picker" target="_blank">', '</a>' ) ),
				array( 'section-end' ),
				array( 'spacer' ),				
				array( 'section-start', 'ipad-menubar-settings', __( 'Header Buttons and Blog Popover', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_ipad_home_button', __( 'Show home	button', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_ipad_blog_button', __( 'Show blog button', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_ipad_recent_posts', __( 'Show recent posts in blog popover', "wptouch-pro" ), __( 'Will include 12 recent posts.', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_ipad_popular_posts', __( 'Show popular posts in blog popover', "wptouch-pro" ), __( 'Will include 12 popular posts, ranked by comments.', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_ipad_popover_tags', __( 'Show tags in blog popover', "wptouch-pro" ), __( 'Will include up to 25 tags, alphabetically.', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_ipad_popover_cats', __( 'Show categories in blog popover', "wptouch-pro" ), __( 'Will include up to 25 categories ranked by post count.', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_ipad_account_button', __( 'Show account button', "wptouch-pro" ), __( 'Will be shown automatically if you require accounts.', "wptouch-pro" ) ),
				array( 'checkbox', 'classic_ipad_search_button', __( 'Show search button', "wptouch-pro" ) ),
				array( 'section-end' )
			)
		),
		__( 'Mobile User Agents', "wptouch-pro" ) => array( 'user-agents',
			array(
				array( 'section-start', 'smartphone-devices', __( 'Default Mobile User Agents', "wptouch-pro" ) ),
				array( 'user-agents'),
				array( 'section-end' ),
				array( 'spacer' ),
//				array( 'section-start', 'tablet-devices', __( 'Default iPad & Tablet User Agents', "wptouch-pro" ) ),
//				array( 'tablet-user-agents'),
//				array( 'section-end' ),
//				array( 'spacer' ),
				array( 'section-start', 'custom-user-agents', __( 'Custom Mobile User Agents', "wptouch-pro" ) ),
				array( 'textarea', 'classic_custom_user_agents', __( 'Enter additional user agents on separate lines, not device names or other information.', 'wptouch-pro' ) . '<br />' . sprintf( str_replace( 'Wikipedia', 'here', __( 'Visit %sWikipedia%s for a list of device user agents', 'wptouch-pro' ) ), '<a href="http://www.zytrax.com/tech/web/mobile_ids.html" target="_blank">', '</a>' ) ),	
				array( 'section-end' )
			)
		),
		__( "Extensions", "wptouch-pro" ) => array( 'extensions', classic_get_extensions_menu() )
	);	
	
	return $menu;
}

function classic_get_extensions_menu() {
	if ( function_exists( 'get_flickrRSS' ) ) {
		$flickr_mobile_rss_option = array( 'checkbox', 'classic_show_flickr_rss', __( 'Use mobile WPtouch FlickrRSS Photos template', "wptouch-pro" ), __( "Shows the latest 20 photos from your Flickr RSS feed on its own page, and adds a link to for it to your drop-down menu.", "wptouch-pro"  ) );
		$flickr_ipad_rss_option = array( 'checkbox', 'classic_ipad_show_flickr_button', __( 'Enable iPad FlickrRSS popover', "wptouch-pro" ), __( "Shows the latest 20 photos from your Flickr RSS feed in its own popover, and adds a button to the menubar.", "wptouch-pro"  ) );	
	} else {
		$flickr_mobile_rss_option = array( 'checkbox-disabled', 'classic_show_flickr_rss', __( 'Use mobile WPtouch Photos template', "wptouch-pro" ), __( "Shows the latest 20 photos from your Flickr RSS feed on its own page, and adds a link to for it to your drop-down menu.", "wptouch-pro"  ) );
		$flickr_ipad_rss_option = array( 'checkbox-disabled', 'classic_ipad_show_flickr_button', __( 'Enable iPad FlickrRSS popover', "wptouch-pro" ), __( "Shows the latest 20 photos from your Flickr RSS feed in its own popover, and adds a button to the menubar.", "wptouch-pro"  ) );	
	}

	if ( defined( 'WORDTWIT_PRO_INSTALLED' ) ) {
		$wordtwit_mobile_option = array( 'checkbox', 'classic_show_wordtwit', __( 'Show Twitter in mobile drop-down menu tab-bar', "wptouch-pro" ), __( "Shows the latest 10 tweets (excluding those tweeted from WordTwit) in your drop-down menu.", "wptouch-pro"  ) );
		$wordtwit_ipad_option = array( 'checkbox', 'classic_ipad_show_wordtwit', __( 'Show Twitter popover on iPad', "wptouch-pro" ), __( "Shows the latest 10 tweets (excluding those tweeted from WordTwit) in its own popover, and adds a button to the menubar.", "wptouch-pro"  ) );	
	} else {
		$wordtwit_mobile_option = array( 'checkbox-disabled', 'classic_show_wordtwit', __( 'Show Twitter in mobile drop-down menu tab-bar', "wptouch-pro" ), __( "Shows the latest 10 tweets (excluding those tweeted from WordTwit) in your drop-down menu.", "wptouch-pro"  ) );
		$wordtwit_ipad_option = array( 'checkbox-disabled', 'classic_ipad_show_wordtwit', __( 'Show Twitter popover on iPad', "wptouch-pro" ), __( "Shows the latest 10 tweets (excluding those tweeted from WordTwit) in its own popover, and adds a button to the menubar.", "wptouch-pro"  ) );	
	}
		
	$top_section = 	array(
		array( 'section-start', 'wordtwit-options', __( 'WordTwit Pro', "wptouch-pro" ) ),
		array( 'copytext', 'copytext-wordtwit', sprintf( __( 'These settings require the %sWordTwit Pro%s plugin to be installed:', "wptouch-pro" ), '<a href="http://www.bravenewcode.com/store/plugins/wordtwit-pro/?utm_source=wptouch_pro&utm_medium=web&utm_campaign=admin_panel" target="_blank">', '</a>' ) ),
		$wordtwit_mobile_option,
		$wordtwit_ipad_option
	);	
	
	if ( defined( 'WORDTWIT_PRO_INSTALLED' ) ) {
		if ( wordtwit_wptouch_has_accounts() ) {
			$middle_section = array(
				array( 'copytext', 'copytext-wordtwit-accounts', __( 'Shared accounts to include in tweet listings:', "wptouch-pro" ) )
			);
			
			$accounts = wordtwit_wptouch_get_accounts();
			foreach( $accounts as $name => $value ) {
				if ( wptouch_wordtwit_current_user_can_use_account( $value ) ) {
					$middle_section[] = array( 'checkbox', 'wordtwit_account_' . $name, '@' . $name );
				}
			}
		} else {
			$middle_section = array( 'copytext', 'copytext-wordtwit-add-accounts', __( 'You must add at least one account in WordTwit Pro.', 'wptouch-pro' ), '' );
		}
	} else {
		$middle_section = array();	
	}
	
	$bottom_section = array(
		array( 'section-end' ),
		array( 'spacer' ),
		array( 'section-start', 'flickr-options', __( 'FlickrRSS', "wptouch-pro" ) ),
		array( 'copytext', 'copytext-flickr', sprintf( __( 'These settings require the %sFlickrRSS%s plugin to be installed:', "wptouch-pro" ), '<a href="http://eightface.com/wordpress/flickrrss/" target="_blank">', '</a>' ) ),
		$flickr_mobile_rss_option,
		$flickr_ipad_rss_option,
		array( 'section-end' )	
	);
		
	return apply_filters( 'classic_extensions_admin', array_merge( $top_section, $middle_section, $bottom_section ) );
}

function classic_theme_thumbnail_options() {
	$thumbnail_options = array();

	// Calendar Icons
	$thumbnail_options['calendar'] = __( 'Calendar', 'wptouch-pro' );

	// WordPress 2.9+ thumbs
	if ( function_exists( 'add_theme_support' ) ) {
		$thumbnail_options['thumbnails'] = __( 'WordPress Thumbnails/Featured Images', 'wptouch-pro' );
	}	

	// 'thumbnail' Custom field thumbnails
	$thumbnail_options['custom_thumbs'] = __( 'Custom Field Thumbnails', 'wptouch-pro' );

	// Simple Post Thumbnails Plugin
	if (function_exists('p75GetThumbnail')) { 
		$thumbnail_options['simple_thumbs'] = __( 'Simple Post Thumbnails Plugin', 'wptouch-pro' );
	}
	
	// Show nothing!
	$thumbnail_options['none'] = __( 'None', 'wptouch-pro' );	
	
	return $thumbnail_options;
}

function classic_theme_font_options() {
	$font_options = array( 
			'sans-serif' => __( '***Some fonts may not be available on all devices***', 'wptouch-pro' ), 		
			'AmericanTypewriter' => __( 'AmericanTypewriter', 'wptouch-pro' ),
			'AmericanTypewriter-Condensed' => __( 'AmericanTypewriter-Condensed', 'wptouch-pro' ),
			'AmericanTypewriter-Bold' => __( 'AmericanTypewriter-Bold', 'wptouch-pro' ),
			'ArialMT' => __( 'ArialMT', 'wptouch-pro' ),
			'Arial-BoldMT' => __( 'Arial-BoldMT', 'wptouch-pro' ),
			'Baskerville' => __( 'Baskerville', 'wptouch-pro' ),
			'Baskerville-Bold' => __( 'Baskerville-Bold', 'wptouch-pro' ),
			'Cochin' => __( 'Cochin', 'wptouch-pro' ),
			'Cochin-Bold' => __( 'Cochin-Bold', 'wptouch-pro' ),
			'Courier' => __( 'Courier', 'wptouch-pro' ),
			'Courier-Bold' => __( 'Courier-Bold', 'wptouch-pro' ),
			'Copperplate' => __( 'Copperplate', 'wptouch-pro' ),
			'Copperplate-Bold' => __( 'Copperplate-Bold', 'wptouch-pro' ),
			'Futura-Medium' => __( 'Futura', 'wptouch-pro' ),
			'GeezaPro' => __( 'GeezaPro', 'wptouch-pro' ),
			'GeezaPro-Bold' => __( 'GeezaPro-Bold', 'wptouch-pro' ),
			'Georgia' => __( 'Georgia', 'wptouch-pro' ),
			'Georgia-Bold' => __( 'Georgia-Bold', 'wptouch-pro' ),
			'GillSans' => __( 'GillSans', 'wptouch-pro' ),
			'GillSans-Light' => __( 'GillSans-Light', 'wptouch-pro' ),
			'GillSans-Bold' => __( 'GillSans-Bold', 'wptouch-pro' ),
			'Helvetica' => __( 'Helvetica', 'wptouch-pro' ), 
			'Helvetica-Bold' => __( 'Helvetica-Bold', 'wptouch-pro' ), 
			'HelveticaNeue' => __( 'HelveticaNeue', 'wptouch-pro' ),
			'HelveticaNeue-Bold' => __( 'HelveticaNeue-Bold', 'wptouch-pro' ),
			'Optima-Regular' => __( 'Optima-Regular', 'wptouch-pro' ),
			'Optima-Bold' => __( 'Optima-Bold', 'wptouch-pro' ),
			'Palatino-Roman' => __( 'Palatino-Roman', 'wptouch-pro' ),
			'Thonburi' => __( 'Thonburi', 'wptouch-pro' ),
			'Thonburi-Bold' => __( 'Thonburi-Bold', 'wptouch-pro' ),
			'TimesNewRomanPSMT' => __( 'TimesNewRomanPSMT', 'wptouch-pro' ),
			'TrebuchetMS' => __( 'TrebuchetMS', 'wptouch-pro' ),
			'TrebuchetMS-Bold' => __( 'TrebuchetMS-Bold', 'wptouch-pro' ),
			'Verdana' => __( 'Verdana', 'wptouch-pro' ),
			'Verdana-Bold' => __( 'Verdana-Bold', 'wptouch-pro' )
		);

	return $font_options;
}
