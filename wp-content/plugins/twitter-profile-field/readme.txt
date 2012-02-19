=== Twitter Profile Field ===
Contributors: Jayjdk
Tags: twitter, profile, field, username, user, shortcode
Requires at least: 2.8
Tested up to: 3.2.1
Stable tag: 1.4

Adds an additional field to the user profile page where you can enter your Twitter username.

== Description ==

Twitter Profile Field is a simple WordPress plugin that gives you a new box in your profile admin to add in your Twitter username.

It does also provide a shortcode which allows you to display your Twitter username, and a link to your profile, to use in posts, pages and text widgets. 

== Installation ==

Installation Instructions:

1. Install Twitter Profile >Field either via the WordPress.org plugin directory, or by uploading the files to your <code>wp-content/plugins/</code> directory.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to your profile page (Users > Your Profile) and enter your Twitter username under 'Contact Info'
4. You can find usage instructions in a widget in your Dashboard


== Frequently Asked Questions ==

= How do I use the shortcode? =
The shortcode is <code>[twitter-user]</code>. You can use it in posts, page, text widgets and more.

You can add several parameters to the shortcode if you want

* <code>[twitter-user link="yes"]</code> will display your username with a link to your Twitter Profile (&lt;a href="http://twitter.com/%username%">%Username%&lt;/a>)

* <code>[twitter-user link="yes" title="Title tag content here"]</code> allows you to add a custom <code>title</code> tag to the link

* <code>[twitter-user userid="2"]</code> will display the username for the user with an ID of 2

= How to use Twitter Profile Field in template files =
There's two ways you can display your Twitter username in your template files

1. Use <code>&lt;?php echo do_shortcode( '[twitter-user]' ); ?&gt;</code>. You can use all the parameters listed under "How do I use the shortcode?"

2. Use <code>&lt;?php the_author_meta( 'twitter' ); ?&gt;</code>. If you use it outside the loop, you should add an user ID to it by using <code>&lt;?php the_author_meta( 'twitter', 1 ); ?&gt;</code> where 1 is the user ID.

= It don't work - What should I do? =

First of all, make sure that the plugin is activated. If you add the to your theme file(s) when make sure that you use <code>&lt;?php the_author_meta('twitter', 1); ?&gt;</code> if it's OUTSIDE the loop.

== Screenshots ==

1. The Profile page
2. How to use shortcodes in posts, pages and text widgets

== Changelog ==

= 1.4 =
* Tested up to WordPress 3.2.1
* Added the <code>title</code> and <code>userid</code> parameter to the shortcode
= 1.3 =
* Tested with 3.0
* No 2.8 support anymore
* Better code
= 1.2 =
* Uses the new 2.9 user_contactmethods for 2.9 users
= 1.1 =
* Adds a Dashboard widget
= 1.0 =
* Initial Release

== Upgrade Notice ==

= 1.4 =
Tested up to WordPress 3.2.1. 
Added new parameters to the shortcode