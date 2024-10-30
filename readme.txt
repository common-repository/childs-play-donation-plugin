=== Childs Play Donation Plugin ===
Contributors: PlexXoniC
Donate link: http://www.childsplaycharity.org/
Tags: charity, donation, donate
Requires at least: 2.0.2
Tested up to: 2.5
Stable tag: 1.0

Adds PayPal Donation Button For The Childs Play Charity

== Description ==

Adds PayPal Donation Button For The Childs Play Charity

== Installation ==

Installation
1. Upload contents of the ZIP file to your wp-content/plugins/childs-play-donation folder.
2. Activate the "Childs Play Donation" plugin.
3. Go to "Childs Play Donation" link on the "Options" submenu.
4. Change The Preferences.

Default Usage
Activate the plugin and insert the following template tag(s) anywhere in your template you want the donation button to show:

For The Larger Button:
'<?php childsplaydonation_sidebar(); ?>'

For The Smaller Button:
'<?php childsplaydonation_content(); ?>'

ex:
<ul>
'<?php childsplaydonation_sidebar(); ?>'
</ul>
