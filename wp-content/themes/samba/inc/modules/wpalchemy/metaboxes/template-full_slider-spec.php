<?php

$custom_metabox_temp_port = $simple_mb_temp_port = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_theme_page',
	'title' => 'Fullscreen Slider Template Custom Options',
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/template-full_slider-meta.php',
	'include_template' => array('template_full_slider.php') // use an array for multiple items
));
/* eof */