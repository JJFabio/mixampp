=== Genesis login modal box===
Contributors: frankschrijvers, wpstudio
Tags: overlay, genesis, login, modal, Genesis Framework, genesiswp, login form, custom login, wordpress login
Requires at least: 3.6
Tested up to: 5.2.2
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Genesis login modal box creates a modal box with login form. You can add a redirect at login and logout and set title and postion of the login button.

== Description ==

Using this plugin you are able to create a modal box with a login form. On the settings page, you can add a redirect add login and logout, set the title and set the postion of the login/logout button (primary or secondary navigation).

**Please Note:** This plugin only works with the <a href="http://www.studiopress.com/" title="Genesis Framework" rel="nofollow">Genesis Framework</a>

More information, an example and the manual can be found on <a href="https://www.wpstud.io/plugins/">WPStudio</a>.


= Plugin features =
* Plugin settings page
* Set title modal box
* Set login URL
* Set logout URL
* Add login/logout to primary or secondary navigation
* Short code to activate the modal box
* Genesis 2.0

== Installation ==

1. You have a couple of options:
	* Go to Plugins -> Add New and search for "Genesis login modal box". Once found, click "Install".
	* Download the folder from Wordpress.org and unzip the folder. Then upload via Plugins -> Add New -> Upload.
2. Activate the plugin through the 'Plugins' menu in WordPress.

**Please Note:** This plugin is only for Genesis Framework users. Genesis is a premium product by [StudioPress](http://www.studiopress.com). If you do not have Genesis 2.0+ or Wordpress 3.6+, the plugin will not activate.

== Screenshots ==

1. Screenshot Frontpage
2. Screenshot Admin panel


== Changelog ==

=1.3 =
* Update: fix for Genesis 3.0
* Removed genesis_pre function check on activation

=1.2.4 =
* Bug fix: fixed check wich causes a error 500 if switched to an none Genesis theme.
* Tweak: login from 404 directs to homepage
* Tweak: login from homepage does not redirect anymore to another post before lauching pop-up

= 1.2.3 =
* fix: made lost password string translatable.

= 1.2.2 =
* update: fix for genesis 2.6

= 1.2.1 =
* changed text domain to match the slug of th plugin

= 1.2 =
* made the plugin translatable

= 1.1.1 =
* removed vardump

= 1.1 =
* Add redirect to modalbox for login error's
* Add filter to menu item


= 1.0 =
* Initial Release