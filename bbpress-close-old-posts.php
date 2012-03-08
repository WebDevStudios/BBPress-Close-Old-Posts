<?php 

/*
Plugin Name: BBPress Close Old Posts
Description: Close BBPress 2.0+ posts that haven't been updated in X days. 
Author: Raygun
Version: 0.1
Author URI: http://madebyraygun.com

Originally found here: http://wordpress.org/support/topic/plugin-bbpress-new-topic-notifications-new-reply-notications-too?replies=13

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/ 


register_activation_hook(__FILE__, 'bbpress_topic_scheduler');

add_action('bbpress_daily_event', 'bbpress_close_old_topics');

function bbpress_topic_scheduler() {
 wp_schedule_event(time(), 'daily', 'bbpress_daily_event');
}

function bbpress_close_old_topics() {
	// Auto close old topics
	$topics_query = array(
		'author' => 0,
		'show_stickies' => false,
		'parent_forum' => 'any',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);
	if ( bbp_has_topics( $topics_query ) )
		while( bbp_topics() ) {
			bbp_the_topic();
			$topic_id = bbp_get_topic_id();
			$last_active = strtotime( get_post_meta( $topic_id, '_bbp_last_active_time', true ) );
			if ($last_active < strtotime( '-10 days') )
				bbp_close_topic( $topic_id );
		}
}
?>