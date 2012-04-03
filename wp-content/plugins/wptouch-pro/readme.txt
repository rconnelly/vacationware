=== Plugin Name ===
Requires at least: 3.2
Stable tag: 2.6.3
Beta tag: 2.2b4

== Changelog ==

= Version 2.6.3 =

* Added: Hungarian language
* Changed: Adjustments for memory management in Classic iPad theme
* Fixed: An issue with MapPress embeds
* Fixed: An issue with JetPack videos
* Fixed: An issue with Smart Youtube plugin videos
* Fixed: Issue with blank spaces in custom user agent string

= Version 2.6.2 =

* Fixed: minor issues for iOS 5.1 update

= Version 2.6.1 =

* Fixed: Issue with ManageWP update mechanism

= Version 2.6 =

* Added: Custom advertising options for iPad
* Added: Simple caching of desktop functions.php
* Added: Russian language file
* Added: Automatic archiving of previous settings in wptouch-data directory
* Added: Compatibility setting for BuddyPress Mobile AJAX support
* Changed: Replaced include with locate_template in theme files, should allow child overrides of custom WPtouch Pro template files
* Changed: Algorithm to reload settings; may have caused settings to be lost in a certain scenario
* Fixed: Changing user-agent matching that may have interfered with advertising in certain scenarios
* Fixed: An issue with Register and Lost password links in Classic
* Fixed: Video issues with jwPlayer and other video sources and plugins
* Fixed: An issue which could cause the Share button not to show in Classic mobile theme
* Fixed: Improved appearance for Embedded Google maps
* Fixed: Issues with Tweet text encoding in sharing options for Classic
* Fixed: Search form issues with Skeleton theme
* Fixed: Admin issues for non-English languages
* Fixed: Issue where style.min.css was never loaded in child themes of Classic
* Fixed: Broken admin icons when SSL was enabled in the admin
* Updated: All translations based on 2.6 strings

= Version 2.5 =

* Added: Now requires WordPress 3.2 or higher
* Added: Support for displaying custom post types, can be modified in the Extensions area of the Classic theme
* Added: Option in Classic theme to toggle hiding the address bar on/off
* Added: AdsBot-Google user agent
* Added: CSS prefixes for Mozilla / Opera browsers
* Added: Localization classes to Classic theme body
* Changed: Compatibility updates for WordPress version 3.3
* Changed: Improved method to load functions.php from desktop themes
* Changed: Minor tweaks for videos in Classic theme
* Changed: Removed "make menu relatively positioned" option in Classic, underlying issue with videos was fixed
* Changed: More cleanup of unused assets, moved bookmark template assets to BNC Amazon
* Changed: Footer text now shown in Web-App Mode
* Changed: Updated to support jQuery 1.7.1
* Changed: New default homescreen icons
* Fixed: Issue with GT tabs plugin
* Fixed: Issue with translucent menu bar option in Web-App Mode (may need to delete and re-add web-app)
* Fixed: Issues with Red Bull CSS skin
* Fixed: Missing urlencode from login form urls
* Fixed: Issue with Classic mobile menu drop arrows on retina displays
* Fixed: Missing text-domain on some text items
* Fixed: Styling issues in Classic theme with some Languages

= Version 2.4.1 =

* Added: Support for ManageWP updates
* Changed: Removed outdated images, smushed a few images for speed
* Changed: Default startup images are no longer included in the install, now served offsite (BNC Amazon)
* Changed: Plugin .zip file is now just 3MB (instead of 5.7MB)
* Changed: Modifications & improvements for Classic mobile + iPad themes in Web-App Mode
* Changed: Updated to jQuery 1.7
* Fixed: Issue with settings saving option
* Fixed: Issues with iPad theme on iOS5, iOS 4.3.2
* Fixed: Issues with new video code with html5, YouTube, Vimeo etc.


= Version 2.4 =

* Added: iOS 5 compatibility
* Added: iPhone Retina startup screen support (iOS 5 only)
* Added: iPad Landscape startup screen support (iOS 5 only)
* Added: Native scrolling in iOS 5 for Classic theme on mobile + iPad (Web-App Mode only in mobile theme) 
* Added: CSS cache files are removed and regenerated whenever WPtouch Pro is upgraded
* Added: Setting to change # of days before the web-app notice is shown again
* Added: FitVids.js for automatic scaling of videos in Classic theme
* Added: Custom WordPress menus now will now respect setting to open link in a new window
* Added: Basic support for attachment.php in Classic theme
* Added: BlackBerry Torch 2 device support
* Changed: New font options available for iPad + mobile
* Changed: ontouchstart + ontouchend extended to Android
* Changed: More CSS refinements and fixes for Android
* Changed: New Web-App Mode default loading screens for iPhone/iPad
* Changed: Compatibility CSS files for Classic theme
* Changed: Language translations based on version 2.3.x strings
* Changed: Scrolling JavaScript for Classic iPad (iOS 4.3.2 & below)
* Changed: add2home JavaScript to v1.0.8
* Changed: Now loading jQuery directly (1.6.4) in both Classic mobile and iPad themes, for compatibility
* Changed: Method of display of Share links on Classic mobile theme for compatibility
* Changed: WordTwit Pro tweets are now clickable links to the Twitter URL for the tweet
* Changed: Switch on/off— now made with CSS, more cross-browser compatible
* Changed: load_textdomain to load_plugin_textdomain - all language files have now changed names from en_US.mo to wptouch-pro-en_US.mo
* Changed: Moved JavaScript in Classic theme into js folders, may cause issues with child themes, please check if you use one
* Fixed: Issue with custom menu titles in sub-blogs of WP multisite installations
* Fixed: Deprecated pass by reference call in menu.php
* Fixed: Issue with strange html characters on icon pack page
* Fixed: Issue in Classic where enabling attached images for pages or posts enabled both
* Fixed: Issue with target="webapp" shortcodes not showing
* Fixed: Issue where "Always refresh theme JS and CSS files" setting would not apply to some files
* Fixed: Issue where disabling the menu bar would cause javascript failures
* Fixed: Styling issues for Prowl responses and Welcome Message
* Fixed: Minor css issues with retina images, placement, etc
* Fixed: Issue with no arrows for menu items when no icons setting is enabled on retina displays
* Fixed: Issue where WPtouch Pro Help links replaced all desktop theme help links
* Fixed: Issue with arrow for excerpt drop downs on iOS 5
* Fixed: Styling issue with Tweets displayed in popover on iPad
* Fixed: An issue with the Web-App Mode message bubble
* Fixed: An issue with theme display when not using a menu on iPad

= Version 2.3.1 =

* Changed: Switch link now uses toggle in Classic theme
* Fixed: Race condition with theme setting defaults, sometimes resulted in theme not having proper defaults
* Fixed: Static CSS file generation now works properly in multisite

= Version 2.3 =

* Added: Compatibility updates for WordPress 3.2
* Added: Support for showing tweets when WordTwit Pro is installed (Classic theme)
* Added: Filter for wptouch_has_tags
* Added: Option to cache menu tree for reduced database queries
* Added: Option to enable content zooming in Classic mobile theme
* Added: MySQL version to debugging system info
* Added: Contextual help links in the admin panel
* Changed: Classic now writes and uses static CSS files for style settings
* Changed: Thumbnails are no longer created unless Thumbnails/Featured Images are selected in the Classic theme
* Changed: Using jQuery 1.6.1 for Classic iPad theme
* Changed: Updated scrolling script for Classic on iPad
* Changed: Updated login form on Classic mobile, better usability
* Changed: Push message info text removed
* Fixed: Broken admin settings links on Multisite implementations
* Fixed: issues with FlickrRSS integration
* Fixed: Issue with custom icons being deleted in certain scenarios
* Fixed: Issue with custom icon sets not being removed cleanly when deleted
* Fixed: Issue with help tooltips in the admin on Firefox browsers

= Version 2.2.4 =

* Added: BlackBerry Bold 3 user agent
* Changed: Default browser preview of iPad theme to landscape view for development
* Fixed: False positives for external links in Web-App Mode in Classic theme

= Version 2.2.3 =

* Changed: Updated appearance for Theme Browser in admin
* Changed: Added CSS for Admob and Adsense ads to auto-center
* Changed: Better WordPress for iOS app compatibility
* Fixed: License API Array() issues

= Version 2.2.2 =

* Changed: Reverted to webOS user agent instead of Pre or Pixi explicitly
* Fixed: Skeleton theme bug fixes
* Fixed: Internal child theme css links
* Fixed: Ajaxform incompatibility issues
* Fixed: Issue with popover positioning on iPad
* Fixed: Admin issues with different languages
* Fixed: Minor issue with persistence in Web-App Mode

= Version 2.2.1 =

* Added: "Show attached image in page content" setting for Classic
* Changed: Post thumbnails are no longer generated by default in the Classic theme
* Changed: Updated language .mo and .pot files
* Changed: Reorganized root-functions in Classic for reduced memory usage
* Changed: More specific device targeting for WebOS devices
* Changed: Updated add2home notice bubble script
* Changed: Using minified css and js in Classic theme again
* Fixed: Select elements in forms now work on iPad, better form compatibility on iPad
* Fixed: An issue with images linked to images in Web-App Mode
* Fixed: Issue with nested shortcodes not working properly
* Fixed: Custom user agents issues in Classic and Skeleton
* Fixed: Issue with custom WordPress menus and child page icons

= Version 2.2 =

* Added: Support for custom taxonomies in WordPress custom menus
* Added: Ability to define a custom latest-posts (blog) page in Classic theme
* Added: Ability to change new "add to home screen" notice bubble message in the admin
* Added: Ability to exclude tags, like categories
* Added: Warning that pretty permalinks need to be enabled within WordPress
* Added: New AJAX checkbox setting for Classic theme Web-App Mode, can turn off for compatibility issues on mobile
* Added: Client Mode settings for 5-Pack + Developer users
* Added: "Clean White" header color group for Classic theme on mobile
* Added: Generic Admob code support for non iOS/iPhone devices
* Added: Setting to force multisite panel to be displayed
* Added: New parameters for wptouch_get_bloginfo, support_licenses_total
* Added: Experimental Windows Phone 7 support for Classic theme, please report issues in the forums
* Changed: Brand new Web-App notice bubble for iPhone/iPad
* Changed: New scrolling script for iPad, improvements in its memory usage and performance
* Changed: Recent posts in iPad popover now respect excluded categories and tags
* Changed: Classic theme now uses single blog-loop.php file include for various template files
* Changed: Minimum number of categories and tags to be shown in drop-down menus is now 1
* Changed: Classic theme searches now return posts excluding pages
* Changed: Excluding Samsung Galaxy Tab and Motorola Xoom tablets for now
* Changed: Re-wrote Web-App Mode code and logic, more robust
* Changed: Reduced admin panel memory usage significantly, improved speed
* Changed: Re-factored/slimmed Classic theme JavaScript by hundreds of lines
* Changed: Shortcodes output with SPAN instead of DIV (changed to inline elements)
* Changed: Better IE 9 admin panel appearance
* Fixed: Images in Web-App Mode that are linked to larger ones will not open in blank page
* Fixed: Issue where attached images would still be shown on password-protected posts
* Fixed: Better handling of ignored urls set in Compatibility settings in Classic theme, especially web-app mode
* Fixed: An issue which caused root-functions.php to be loaded with the desktop theme
* Fixed: Bugs with category exclusion
* Fixed: RSS link issue in Web-App Mode
* Fixed: Page not found bug when searching on a site with a redirect URL specified
* Fixed: Minor php warnings found via WP debug
* Fixed: An issue which could cause iPad popover scroll areas not to work
* Fixed: Bugs with Persistence and Web-App Mode in Classic theme
* Fixed: Issue with site icons not showing in custom menus
* Fixed: Issue with images in Classic iPad theme on pages not auto aligning
* Fixed: Issue in Multisite where only super admins could see settings on sub-blogs
* Fixed: Issue with admin panel forgetting activated licenses
* Fixed: Issue where activating and de-activating licenses could have caused admin to hang

= Version 2.1.3 =

* Fixed: Issue with license activation on Chrome and IE

= Version 2.1.1 =

* Changed: PHP debug error with pass by reference
* Fixed: An issue with transparent status bar on iPad
* Fixed: Inability for developer licensees to activate a new license on a website
* Fixed: Issue with category listing only showing in menu for categories with more than two entries
* Fixed: Problem with custom home page redirect target URL

= Version 2.1 =

* Added: iPad theme to Classic, must be turned on in admin
* Added: Web-App Mode supported on iPad
* Added: Ability to select between mobile and iPad devices for developer mode
* Added: New Classic theme mobile background repeat and color settings
* Added: Compatibility setting to remove short-code content in WPtouch Pro
* Added: Updated/added welcome message and Web-App Mode notice bubble appearance
* Added: New icon set of Android Icons courtesy of androidicons.com
* Added: Notice in admin when in developer mode
* Added: Ajax comment form submit in Classic mobile theme
* Added: Child theme support, copy themes as children
* Added: Support for WordPress 3.x's Custom Menus
* Added: Built in support for WP Super Cache 0.9.9.4 and above
* Added: Custom home page redirect
* Added: Language POT files
* Changed: Updated the way WPtouch refreshes admin/theme files on an upgrade
* Changed: Significant speed and load-time improvements in Classic theme
* Changed: Improved Web-App Mode, persistence load times dramatically
* Changed: Various admin panel improvements and refinements, re-organized settings
* Changed: Code, image, CSS and JavaScript optimizations and improvements
* Changed: Now filtering excluded categories from feeds as well
* Changed: Updated default settings
* Fixed: PHP warnings and issues in the admin panel
* Fixed: An issue which could cause the switch link to fail
* Fixed: Incorrect detection of BlackBerry Torch
* Fixed: An issue with cookies and the welcome message
* Fixed: An issue which could cause a blank space in the header area of themes
* Fixed: Modified category exclusion behaviour for Classic to not include category pages
* Fixed: An issue which caused scrolling to top after posts have loaded in mobile theme
* Fixed: Issue with missing pages in menu setup when two or more pages have the same name
* Fixed: An issue with the thumbnail mask appearance on mobile WebOS devices
* Fixed: Issue in iOS Web-App Mode where submitted forms could cause homepage to load instead (search, etc)
* Fixed: An issue where persistence would not work correctly on domains with multiple WordPress installs
* Fixed: Minor CSS issues on Retina displays
* Fixed: Follow Me plugin now being filtered
* Fixed: An issue where cookie code could be improperly output in a desktop theme (2.0.9.1 bug)
* Fixed: Issues related to login, forms & search in themes
* Fixed: Comment numbers didn't include trackback numbers
* Fixed: Now displays trackbacks and pingbacks in comments

= Version 2.0.9.1 =

* Fixed: Bug with multisite panels

= Version 2.0.9 =

* Added: iCandies icon set courtesy of IconEden
* Added: Custom lang directory (wptouch-data/lang) contents are added to regionalization/language menu automatically
* Added: Option to have advertising on the home page only
* Added: Option to disable WPtouch on a per-URL/page basis via the compatibility section
* Added: Total number of results for search queries
* Changed: Improved multisite handling
* Fixed: Web-App Mode links for RSS links, Account Profile and Admin
* Fixed: An issue in the admin panel which could prevent the AJAX and/or other javascript from functioning
* Fixed: Improved plugin compatibility in the admin panel
* Fixed: Issues with Disqus commenting system

= Version 2.0.8.3 =

* Added: Share and Follow plugin removal compatibility
* Changed: Removed comment bubbles if DISQUS is in use (it filters comment_count)
* Changed: Category listings in the header now respect excluded categories in Classic settings
* Changed: Minor admin copy changes
* Fixed: An issue with new Web-App Mode notice overlay
* Fixed: An issue where the Share Overlay would not show if DISQUS or Intense Debate are running
* Fixed: An issue which caused double image reflections on some Android devices

= Version 2.0.8.2 =

* Added: Support for new Vimeo HTML5 embeds
* Added: New Web-App notice overlay feature. Let visitors on iDevices know your site is web-app ready
* Added: New Developer options: Client Mode settings to remove license, theme browser and tools and debug settings
* Added: Warning for, and better compatibility with Hyper Cache plugin
* Added: JS to deal with protected images in posts (P3)
* Changed: PixelPress icon set was updated for Retina display (60x60 versions)
* Changed: more retina display tweaks and updates
* Fixed: An issue where certain filetypes (.mp3, .xls, .pages, etc) would open blank in Web-App Mode
* Fixed: .aligncenter to images JS (now leaves images under 100px alone)
* Fixed: Typos in WPtouch admin panel
* Fixed: An issue with image files which may prevent copying when upgrading the plugin
* Fixed: An issue with sticky post icons when "none" is selected as the post icon type
* Fixed: An issue with custom field thumbnails on WP 2.8.x installations
* Fixed: An issue that caused Intense Debate and DISQUS comments issues

= Version 2.0.8.1 =

* Added: JS to add .aligncenter to images and captions in posts smaller than 250px in width
* Changed: No longer filtering Intense Debate comments
* Changed: Updated Norwegian, French and Dutch translations
* Fixed: An issue with the height of YouTube and HTML5 videos, new Vimeo embed code
* Fixed: An issue where thumbnails may not display properly with rounded corners
* Fixed: An issue involving SSL admin panels and the inability to license/upgrade

= Version 2.0.8 =

* Added: New setting in General settings to edit regular theme switch link css
* Added: New high-resolution images for iPhone 4 in Classic theme
* Added: New header logo retina img option
* Added: Option in Classic theme to disable header Site Icon
* Added: Option in Classic theme to disable Search button
* Added: Option in Classic to show first image attachment in the post above/below content
* Added: Option in Classic theme to set a custom Calendar icon color
* Added: Option in Classic theme to set preferred WPtouch thumbnail size
* Added: Option in Classic Web-App Mode to disable persistence
* Added: Settings link on plugins.php page to WPtouch Pro admin
* Added: CSS in Classic theme for code examples in posts
* Added: CSS for Comment Reply Notification plugin
* Added: BlackBerry Torch user agent
* Added: Samsung S8000, Bada user agents
* Added: Swedish translation - Thanks Peter!
* Added: Compatibility option to disable conversion of Menu page URLs to local formats
* Changed: Now filtering "Facebook Like" plugin
* Changed: Now filtering "Sharebar" plugin
* Changed: Now filtering "WP Greet Box" plugin
* Changed: Other improved plugin compatibility
* Changed: Increased license server cache time
* Changed: Updated Italian, Spanish, German, Portuguese and Japanese translations
* Fixed: Case where debugging information was reported wrong
* Fixed: "Mailto:" links in Web-App Mode (Classic and Skeleton)
* Fixed: Some filetypes blanking in Web-App Mode (Classic and Skeleton)
* Fixed: Floated content issues in Classic post content area
* Fixed: An issue with compat.css and custom CSS files not loading in some situations
* Fixed: An issue where selecting all pages/none checkboxes in admin would prompt for reset
* Fixed: An issue with ajax, admin loading
* Fixed: An issue with license keys in certain SSL-enabled admin panels
* Fixed: An issue with thumbnails on upgraded installations of WPtouch Pro

= Version 2.0.7.1 =

* Fixed: Bugs with ajax, blank 'here' page

= Version 2.0.7 =

* Added: Web-App Mode now remembers and loads the last visited post or page visited (persistence)
* Added: Dynamic Contact Form plugin CSS
* Added: Support for WP Thread Comment plugin in Classic
* Added: Domain Path: /lang to plugin file header
* Added: Classic theme style color options
* Added: Classic theme font face and size options
* Added: Classic theme Menu color options
* Added: New admin display for Classic user agents and device classes
* Added: Setting for Classic to show/hide post date in post listings when thumbnails/none are shown
* Added: Ability to load/include functions.php from the active desktop theme
* Added: Ability to dismiss plugin compatibility warnings
* Added: Classic theme text-justification options, preliminary RTL support
* Added: Custom advertising option that allows for user-defined ads/images/code
* Added: Backup/Restore section
* Changed: Clearer text in admin licenses tab
* Changed: Improved speed of admin panel
* Changed: Re-optimized theme and admin images
* Changed: More theme and admin optimizations for speed / load time
* Changed: Using jQuery now with noConflict(), should help some compatibility scenarios in themes and admin
* Changed: Updated readme.txt with installation instructions, added GPL license txt
* Fixed: An issue that could cause the auto-upgrade license to be incorrectly shown
* Fixed: An issue where share/save would not be shown when comments are closed in Classic
* Fixed: Menu CSS issues when icons are not enabled in Classic
* Fixed: Issues with opening some urls, buttons that opened new blank windows
* Fixed: An issue where a PDF, DOC, XLS or a few other file types would open within the browser
* Fixed: An issue which made it difficult to press the menu button in the Classic header
* Fixed: Issue with custom language files in the wptouch-data/lang directory
* Fixed: Bug with new languages not taking affect immediately

= Version 2.0.6 =

* Added: Body classes for portrait, landscape, and Web-App Mode ('portrait', 'landscape', 'web-app')
* Added: New settings in Classic, toggle showing: single post page tags, cats, author, date, share/save, comments
* Added: Setting in Classic to use relative position for drop-down menu (fixes issue where videos may overlay menu)
* Added: New setting in general to define a path to a custom stylesheet that is loaded in themes
* Added: New setting in General to hide Switch link (will cause switch link NOT to show on mobile or desktop)
* Added: New setting in General to make all links clickable in post content, similar to P2 theme
* Added: New setting in General for a custom 404 message
* Added: Two new background tiles for Classic: 'Grainy' and 'Cog Canvas'
* Added: Warning for 'Featured Content Gallery' plugin
* Added: Warning for 'IntenseDebate' plugin
* Added: wptouch shortcode for targeting mobile/desktop. Usage is [wptouch target="mobile"]your content[/wptouch]. Target can be: mobile, webapp, non-webapp, desktop
* Added: Compat.php to remove particularly troublesome plugins from interacting with WPtouch Pro
* Added: Gcons Pack (blue only) from greepit.com
* Added: Glossy eCommerce Icons Pack from starfishwebconsulting.co.uk
* Added: User agents for newer BlackBerry Storm touch devices (9550 and 9520)
* Added: User agent for Froyo (Android 2.2)
* Changed: Style adjustments and fixes to Classic
* Changed: Share/Save to detect current viewport width/height/position accordingly in Classic
* Changed: Removed Search 'GO' button in Classic (causes width issues in some languages)
* Changed: New tab-bar icons, adjustments (larger and easier to select)
* Changed: Converted default comments in Classic to functions.php version under the hood
* Changed: Removed warning for wpSEO - an update to the latest version 2.7.7 fixes the issue
* Changed: Disabled IntenseDebate comments in WPtouch (defaults to regular comments), full support is coming in a future version
* Changed: Default startup.png loading image for Classic Web-App Mode, now more generic w/o WPtouch branding
* Fixed: Language file warning
* Fixed: Cases where too many redirects issue may occur on some installations
* Fixed: Semi-colon in text areas in admin settings causes settings to become broken
* Fixed: Paginated Comments plugin from breaking WPtouch comments
* Fixed: Telephone numbers should not cause a blank external page in Web-App Mode
* Fixed: Skip to Comments link failing in Web-App Mode
* Fixed: Web-App Mode now always shows mobile view when "1st time visitors see desktop theme" is enabled
* Fixed: Issue where clicking on menu icons in Web-App Mode would force exit

= Version 2.0.5 =

* Added: Norwegian translation
* Added: Portuguese translation
* Added: Partial Dutch translation
* Added: Options in Classic to disable "Admin" and "Profile" account tab links
* Added: Options for Calendar icon appearance
* Added: Options to define custom field name for thumbnails
* Added: Option to define a custom header logo image in Classic
* Added: New option for advertising (which views they show on)
* Added: Ability to define a functions.php file in the wptouch-data directory
* Added: wptouch_admin_languages filter to modify the languages drop down in the admin
* Added: Ability to have a custom .mo file in the wptouch-data/lang directory
* Added: Warning if WPMinify plugin is installed and active
* Changed: Wording for Adsense ID area, added info
* Changed: Presentation of menu icons/pages in Classic drop-down
* Changed: Sticky post icon is now a star, not a pin in Classic
* Changed: get_bloginfo( 'url' ) now returns redirect target when defined
* Fixed: Minor localization issues
* Fixed: White flash on Web-App Mode loading
* Fixed: tab links for activation, licenses in admin

= Version 2.0.4 =

* Added: New wptouch_setting_filter_ filters to pre-process all submitted settings
* Added: Options to change menu sort order from page order to alphabetical
* Added: Option to disable Web-App Mode
* Added: Options for custom field thumbnails, simple post thumbnails plugin to Classic
* Changed: wptouch_title() - now respects short title, better for bookmarking to home screen
* Changed: Warnings if found stand out more in the admin WPtouchboard
* Changed: Comment bubble placement in Classic, Skeleton themes
* Changed: Only active plugins are shown in the admin plugin compatibility section
* Changed: Order of settings blocks in admin 'Compatibility' area
* Changed: Spaces are converted into dashes for uploaded icons .pngs to ensure working Web-App Mode icons
* Changed: various styling refinements
* Fixed: Default theme name of Classic on fresh install
* Fixed: Removed whitespace from end of custom user agents in Skeleton and Classic
* Fixed: Missing spinner icon, broken template link in admin upload icon area
* Fixed: Tabbing input order in Classic, Skeleton themes

= Verison 2.0.3 =

* Added: New Regionalization section to General settings
* Added: Ability to force a language from the admin panel
* Added: New setting that allows WordPress date format to be used in themes
* Added: Excluded categories setting for Classic theme
* Added: Added ability to enable developer mode for admins only
* Added: Ability to choose between same and Homepage for Switch Link destination
* Added: Palm Pre/Pixi user agent strings (webOS)
* Added: Auto-copy custom icons from WPtouch 1.9.x installs if found
* Changed: Loading div appearance in Classic theme Web-App Mode
* Fixed: Icon set link from WPtouchBoard
* Fixed: Removed extra spaces at the ends of a few files
* Fixed: Styling issues with Gravity Forms in Classic, Skeleton
* Fixed: Styling issues with 'show load times' option on in Classic, Skeleton
* Fixed: Styling for align:none, align:center in Classic, Skeleton
* Fixed: Bug in Prowl direct message that stopped after the first API key
* Fixed: Cases where 'Load More Comments' links would not be shown

= Version 2.0.2 =

* Changed: Menu icons for pages and links are now clickable, removed :hover state to fix some browser issues
* Changed: CSS related to search icon in tab-bar to fix some browser issues
* Changed: CSS for Disqus and Intense Debate to hide comment bubbles
* Fixed: Problem with textareas in admin panel when they contain HTML code
* Fixed: Character encoding problem in admin dashboard
* Fixed: Changed ID class of custom page items to have be of the form 'id-custom-{num}'
* Fixed: Issue where calendar icons were different widths, and did not reflections on iDevices (iPad, iPhone, iPod touch)
* Fixed: Launching email from share area now closes overlay.  Mobile Safari bug still prevents JS from working after that point.
* Fixed: Blank email page for non Web-App Mode email link in menu

= Version 2.0.1 =

* Added: Warning for when directories cannot be created
* Changed: Footer 'Powered by' message to match admin setting
* Changed: Updated language files for Italian, German, Japanese, Spanish and French
* Fixed: Verbiage surrounding GPL licenses
* Fixed: Issue with WordPress installs that are not in the root
* Fixed: Google AJAX Translation plugin compatibility
* Fixed: Issue with logo link in Web-App Mode
* Fixed: Bug in plugin compatibility section
* Fixed: Added CSS for Banner Cycler plugin compatibility
* Fixed: White screen error in WordPress 2.8.x
* Fixed: Author URL link for icon sets
* Fixed: Removed various PHP warnings from admin panel
* Fixed: Share on Twitter link in Classic Web-App Mode
* Fixed: Replaced deprecated link_pages function with wp_link_pages in themes

= Version 2.0 =

* Initial release!
