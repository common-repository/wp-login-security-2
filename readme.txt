=== WP Login Security 2 ===
Contributors: andersvinther2
Donate link: http://www.wpsecuritychecklist.com/buy-us-a-beer/
Tags: authentication, whitelisting, admin, security, login, two factor, brute force attacks, lockdown, password
Requires at least: 3.0.1
Tested up to: 3.5
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Whitelist User IP addresses. If a user logs in from an unknown IP the plugin sends an email to the user and optionally the admin with a one-time key.

== Description ==

WP Login Security 2 provides enhanced security by requiring users to whitelist their IP address. 
If the IP address is not recognized, the plugin will send an email to the user with a link that contains a one-time key. Optionally the blog administrator can also be notified.

If a user logs in from a known IP address no further action is required.

**What does this Plugin do?**

1. Each time a user logs in, the plugin will compare their existing IP address to the last seen IP address.
1. If the IP does not match or no IP addresses have been whitelisted, an email will be sent to the users registered email address.
1. The user must login to their email and click the included link, which contains the one-time password.
1. The plugin can be configured to also send an email to the blog administrator as well as the user.  

**Updates from the original plugin**

This plugin is based on the original [WP Login Security](http://wordpress.org/extend/plugins/wp-login-security/) plugin developed by joshuascott94.

Since the original plugin is not supported any longer we took over and made a few updates:

1. Fixed: Incorrect number of parameters were passed to mt_rand().
1. Recoded: The plugin notifications on the login screen only worked when Output Buffering was turned on in php.ini.
1. Added buttons to clear whitelist and outstanding activation codes.
1. Added code to clean up data on uninstallation.

== Installation ==

This Plugin works without you having to make any changes. 

1. Search for the plugin using the WordPress Plugin Installer OR download and unzip the directory into your plugins directory.
1. Activate the Plugin through the 'Plugins' menu in WordPress - Upon activation, your current IP will be automatically whitelisted.
1. Optionally enable notifications of Blog Admin.
1. Enjoy the enhanced security!

== Frequently Asked Questions ==

= Can I help you develop this Plugin? =

Yes, I am open to anyone with experience who can provide assistance in making this Plugin better.  Just [send](http://www.wpsecuritychecklist.com/contact-us/) me a message.

= How to ask a question? =

Click [here](http://www.wpsecuritychecklist.com/contact-us/) and ask me a question. Or use the Support Forum here.

== Screenshots ==

1. The admin panel of the plugin showing the default values.

== Changelog ==

= 1.0.2 = 
* Added buttons to clear whitelist and outstanding activation codes.
* Plugin removes data when uninstalled.

= 1.0.1 = 
* Minor bug fix.

= 1.0.0 = 
* Fixed: Call to mt_rand with wrong number of parameters.
* Fixed: Plugin notifications on login screen only worked if Output Buffering was on.

