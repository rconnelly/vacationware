=== ThreeWP Broadcast ===
Tags: network, wpms, wpmu, broadcast, multipost, blogs, posting, simultaneously, child, parent, permalink, post type, custom post type, threewp
Requires at least: 3.3.1
Tested up to: 3.3.1
Stable tag: trunk
Donate link: http://mindreantre.se/donate/
Contributors: edward mindreantre

Network plugin to broadcast posts to other blogs. Custom post types, custom taxonomies, post meta and attachments are supported. 

== Description ==

Network plugin to broadcast posts to other blogs. Custom post types, custom taxonomies, post meta and attachments are supported. A blog whitelist and blacklist exist.

Broadcasted posts can be linked to their parents: updated parent posts also update the child posts. Child post permalinks can be overriden with a link to the parent post.

Last used settings are remembered between uses. Broadcasted categories keep their parents, as long as the parents already exist on the child blog of if the parent is broadcasted and created simultaneously as the child category.

Has options for whitelisting (required blogs), blacklisting, user role access granularity, custom post and custom taxonomy support and an uninstall to completely remove itself. No traces of the plugin are left (assuming the created tables are successfully removed).

Available in the following languages:

* Dutch
* English
* French
* Swedish

Did I miss anything?

== Installation ==

1. Unzip and copy the zip contents (including directory) into the `/wp-content/plugins/` directory
1. Activate the plugin sitewide through the 'Plugins' menu in WordPress.

== Screenshots ==

1. Broadcast box during post editing.
2. Post / page overview with unlink options
3. Admin: General settings
4. User: Help page
5. User: Group settings page
6. Admin: Post types settings page
7. Admin: Required blog list
8. Admin: Blacklist
9. Admin: Uninstall page
10. Admin: Settings for logging to Activity Monitor

== Frequently Asked Questions ==

= Why can I not see the Broadcast meta box? =

Make sure that:

1. The plugin is network enabled
2. Your user level has broadcast access (Broadcast access role)
3. Your user has write access to more than this blog
4. The correct post type(s) have been selected

= Orphans? =

If you have already created posts on other blogs that are supposed to be children of a specific post, you can use the "find orphans" function to find and link them.

Find the post in the post overview and use the row action "find orphans". You will then be presented with a table of possible orphans on each blog. Select the blog and then choose "link orphans" to create the links.

To be considered an orphan the orphaned posts must have the exact same title (name) as the soon-to-be parent.

= WPAlchemy =

If you have custom post meta boxes via WPAlchemy, you'll probably need to add the following to the custom field exceptions in the settings:

_bcc_

== Changelog ==

= 1.8 2012-02-10 =
* Old broadcasted images are properly deleted from child blogs.
* Settings can now be saved again. Sigh.

= 1.7 2012-02-08 =
* Featured Images work again.

= 1.6 2012-02-05 =
* Find orphans
* Bugs fixed that prevented proper broadcasting

= 1.5 2012-02-04 =
* Custom post and custom taxonomy support
* Multiple custom field values with the same key can be broadcasted
* Will not try to attach files that were deleted from disk
* Broadcasted images retain their ALT, TITLE and caption. 
* New link icon
* New base php
* Better linking to child posts
* Post meta fields are maybe unserialized
* Fixed Activity Monitor support

= 1.4 =
* Works with WP 3.1
* Added a shrink / expand control in the broadcast meta box

= 1.3 =
* Category syncing works with unparented categories.
* Activity Monitor activities have types.
* $threewp_broadcast->is_broadcasting() is now available.
* Now even more links can be overrided. 

= 1.2.1 =
* Custom field exceptions added
* Priority can now be 10 characters
* Category broadcast role is back again. :)

= 1.2 =
* Settings are kept when activating the plugin.
* Child posts are given link info.
* Child post permalinks can be overriden.
* Last used settings are remembered.
* Broadcasted children cannot be rebroadcasted.
* Page templates are broadcasted.
* Broadcasted categories are synchronized with the children.
* Broadcasted custom fields aren't duplicated anymore.
* Sticky status is broadcasted.
* Page parents are kept. The parent page must be broadcasted first.
* Drafts and future posts can also be broadcasted.

= 1.1 =
* Galleries are now broadcastable.

= 1.0 =
* Custom fields can be broadcast.
* Attached images can be broadcast.
* Broadcasted posts are now linked to the parent post.
* Pages can be broadcast.

= 0.3 =
* Dutch translation added, courtesy of Johan Daems.
* Superadmins have access to all blogs, even though they don't.

= 0.2 =
* WP3 compatability

= 0.0.1 =
* Initial public release
