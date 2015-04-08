<?php
/*
Plugin Name: Samba Framework
Plugin URI: http://themeforest.net/user/Pirenko/portfolio
Description: Plugin that creates custom post types and shortcodes to work with Samba Wordpress Theme
Version: 4.5
Author: Pirenko
Author URI: http://www.pirenko.com
License: GPLv2
*/


include_once dirname( __FILE__ ) . '/shortcodes.php' ;
include_once dirname( __FILE__ ) . '/custom_post_types.php';
include_once dirname( __FILE__ ) . '/inc/theme_widgets/pirenko-twitter/pirenko-twitter.php';
include_once dirname( __FILE__ ) . '/inc/theme_widgets/pirenko-social-links/social.php';
include_once dirname( __FILE__ ) . '/inc/theme_widgets/pirenko-vcard/vcard.php';
include_once dirname( __FILE__ ) . '/inc/theme_widgets/pirenko-advertising/pirenko-ads.php';
include_once dirname( __FILE__ ) . '/inc/theme_widgets/pirenko-tags/tags.php';
include_once dirname( __FILE__ ) . '/inc/theme_widgets/pirenko-recent_posts/posts.php';
include_once dirname( __FILE__ ) . '/inc/theme_widgets/pirenko-tags_portfolio/tags.php';
include_once dirname( __FILE__ ) . '/inc/theme_widgets/pirenko-video/pirenko-video.php';
include_once dirname( __FILE__ ) . '/inc/theme_widgets/decent-comments/decent-comments.php';

define('SAMBA_PLUGIN_URL', plugin_dir_url( __FILE__ ));

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('js_composer/js_composer.php'))  {
	include_once dirname( __FILE__ ) . '/inc/builder.php';
}
//CHECK IF SAMBA THEME IS ACTIVE
if (function_exists('wp_get_theme'))
	$active_theme = wp_get_theme();
else
{
	$active_theme->name="old_wp_version";
	$active_theme->Version="1";
}
if ('Samba' == $active_theme->name || 'Samba' == $active_theme->parent_theme || "old_wp_version" == $active_theme->name) 
{
    include_once dirname( __FILE__ ) .'/inc/modules/wpalchemy/metaboxes/setup.php';
}
else 
{
	//THEME IS NOT ACTIVE. LET'S ADD SOME ELEMENTS
	//ADD METABOXES SUPPORT
	include_once dirname( __FILE__ ) .'/inc/modules/wpalchemy/metaboxes/setup.php';
	//ADD METABOXES FOR SPECIAL ELEMENTS
	include_once dirname( __FILE__ ) .'/inc/modules/wpalchemy/metaboxes/portfolio-spec.php';
	include_once dirname( __FILE__ ) .'/inc/modules/wpalchemy/metaboxes/slides-spec.php';
	include_once dirname( __FILE__ ) .'/inc/modules/wpalchemy/metaboxes/members-spec.php';
	add_action('admin_print_scripts', 'samba_framework_admin_scripts');
}

//ADD CUSTOM SCRIPTS FOR THE BACKEND
function samba_framework_admin_scripts() 
{
	global $active_theme;
	wp_register_style( 'samba_framework_admin_css', SAMBA_PLUGIN_URL . 'css/admin.css',false,$active_theme->Version );
	wp_enqueue_style('samba_framework_admin_css');
}
?>