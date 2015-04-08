<?php

$custom_metabox_temp_port = $simple_mb_temp_port = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_theme_page',
	'title' => 'Page Custom Options',
	'include_template' => array('page-theme.php','page-sections.php'),
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/reg-page-meta.php'
));
/* eof */