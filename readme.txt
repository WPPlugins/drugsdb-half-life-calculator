=== Drug Half-Life Calculator ===
Plugin URI: http://shinraholdings.com/plugins/drugsdb-half-life-calc
Contributors: drugsdb, bitacre
Donate link: http://www.drugsdb.com
Tags: half-life, calculator, widget, drugs, prescription, database
Requires at least: 2.8
Tested up to: 3.5
Stable tag: 1.1

A simple calculator to get the known half-life for medications you're taking.

== Description ==
This plugin allows you to add a widget to your sidebar or shortcode to a page or post that displays a simple drug half life calculator.  The calculator outputs the concentration of the drug that will remain in your system over a period of time. The plugin accepts two values: half-life and dosage.  You can find the half life of various drugs and medications at [Drugsdb.com](http://www.drugsdb.com/ "Drugsdb").  

To see a live example, visit: [http://www.drugsdb.com/resources/drug-half-life-calculator/](http://www.drugsdb.com/resources/drug-half-life-calculator/)

Use the shortcode `[halflife]` to display it on posts or pages or add it as a sidebar widget.

== Installation ==
1. Download the latest zip file and extract the `drugsdb-half-life-calc` directory.
2. Upload this directory inside your `/wp-content/plugins/` directory.
3. Activate the 'Drugsdb Half-Life Calculator Widget' on the 'Plugins' menu in WordPress.
4. Add the widget to your sidebar (using the Appearance > Widgets menu).
5. Add to a post or page using the shortcode `[halflife]`.

== Frequently Asked Questions ==
= How do I display in posts or pages? =
Use the shortcode `[halflife]` wherever you want it to appear on your post or page.

= Is there a PHP template tag? =
Yes, use the code `<?php do_shortcode( 'halflife' ); ?>` anywhere in your theme to display the calculator.

= How do I remove the attribution in the Widget? =
Check the "remove attribution" option on the widget admin.

= How do I remove the attribution in the shortcode? =
Add the attribute `remove_attrib="yes"`, so the full shortcode would be '[halflife remove_attrib="yes"]`.

= Can I change the title? =
Yes, using the widget admin. The shortcode does not print a title so you may simple type a title above the shortcode.

== Screenshots ==
1. Description of screenshot.

== Changelog ==
= 1.1 =
* Removes the link attribution.

= 1.0 =
* First release version. 

== Upgrade Notice ==
= 1.1 =
Optional upgrade, removes the link attribution to DrugsDB.com

= 1.0 =
First release version, nothing to upgrade.

== Support ==
* [plugins@shinraholdings.com](mailto:plugins@shinraholdings.com)