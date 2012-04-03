=== Checkfront Booking Plugin ===

Contributors: checkfront
Stable tag: trunk
Tags: Booking, Reservation, Calendar, Availability, Online, Saas, Ajax, CRS, PMS, API, Secure, Cloud, Payments, Bookings
Requires at least: 2.0
Tested up to: 3.0

A plugin that connects your Wordpress site to the Checkfront online booking system.

== Description ==

**Checkfront** is an [Online Booking System](http://www.checkfront.com) that allows businesses to manage their inventories, centralize reservations, and process payments. This plugin connects your Wordpress site to your Checkfront account, and provides a powerful real time booking interface within your site.

Unlike traditional hosted products, Checkfront does not force customers off to an external website to process bookings or view availability, yet it keeps consumer data secure and separate from Wordpress.  The combined CMS features of Wordpress with the power, flexibility and security of the Checkfront back-end make for an industry leading booking management system.

You can configure Checkfront to manage your inventory, packages, accept reservations and process payments.

= Features include =

* Display availability, take reservations, bookings and process payments online within your website.
* Optional sidebar widget.
* Multi-currency, multi-gateway payment processing including Paypal and Authorize.net.

= Installation =
1. Install the Checkfront Booking plugin in your Wordpress admin by going to *'Plugins / Add New'* and  searching for *'Checkfront'*,  **(or)** If doing a manual install, download the plugin and unzip into your `/wp-content/plugins/` directory. 
1. Activate the the plugin through the 'Plugins' menu in WordPress.

= Configuration =
1. Create your [Checkfront account](https://www.checkfront.com/start/ "Checkfront Setup")
1. Setup you inventory and configure your account on Checkfront.
1. Enable the Checkfront booking search widget in Wordpress.
1. Create a Wordpress **Post** and embed the Checkfront booking system by using the shortcode: `[checkfront]`

== Screenshots ==

1. Inventory search
2. Pre-Payment 
3. Admin

== Changelog == 
* *May 11 2010*:
  * Removed "Online Bookings by Checkfront" link
* *Apr 29 2010*:
  * Added the ability to filter booking pages by category or item id.
  * Upgraded to latest API.
* *Mar 21 2010*:
  * Added sidebar widget.
  * Improved calendar navigation.
  * Better theme integration.
* *Feb 28 2010*:
  * Fixed php shortcode issue.
* *Feb 24 2010*:
  * Updated screenshots
  * Removed legacy invoice insert.
* *Feb 18 2010*:
  * Moved to new 0.9 Checkfront API
  * Now supports framed version of booking window should the theme interfere with the plugin
  * Removed search widget: search functionality has been moved to main booking interface  - will reappear in another format.
* *Nov 30 2009*: 
 * Improved compatibility fixes.  
* *Nov 13 2009*: 
 * Made compatible with wordpress 2.5+.  
 * No longer loads remote javascript site wide, only on an embedded booking page.
 * Improved warning messages and admin settings.
 * Moved admin settings to plugin menu.
* *Nov 6 2009*: Updated readme, small IE fix.
* *Nov 5 2009*: Initial public beta.
