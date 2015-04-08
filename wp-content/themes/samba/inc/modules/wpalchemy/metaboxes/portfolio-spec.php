<?php
$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'Single Portfolio Custom Options',
	'types' => array('pirenko_portfolios'),
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/portfolio-meta.php',
));
/* eof */