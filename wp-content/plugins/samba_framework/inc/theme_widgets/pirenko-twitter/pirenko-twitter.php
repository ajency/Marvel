<?php

/*
Plugin Name: Recent Tweets Widget
Plugin URI: http://wordpress.org/extend/plugins/recent-tweets-widget/
Description: Recent Tweets Widget plugin for Twitter API v1.1 with Cache. It uses the new Twitter API v1.1 and stores tweets in the cache. It means that it will read status messages from your database and it doesn't query Twitter.com for every page load so you won't be rate limited. You can set how often you want to update the cache.
Version: 1.0
Author: Theme Prince
Author URI: http://themeprince.com
*/



// make sure we don't expose any info if called directly
	if ( !function_exists( 'add_action' ) ) {
		echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
		exit;
	}
	// include widget function
	include_once('widget.php');
	
?>