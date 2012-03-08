=== BBPress Close Old Posts ===
Author: Raygun Design, LLC
Tags: BBPress
Requires at least: BBPress 2.0
Tested up to: 3.3.1

Close BBPress topics with no activity for X days. BBPRess 2.0 and up.

== Description ==

Move file to plugins directory and activate. There are no settings. Change line 40
			
if ($last_active < strtotime( '-10 days') )

if you'd like to customize the threshold for activity on old posts. 

Based on code found here: 
http://wordpress.org/support/topic/plugin-bbpress-new-topic-notifications-new-reply-notications-too?replies=13



== Changelog ==

= 0.1 =
* First release.