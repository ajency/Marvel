<?php
$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'Single Post Custom Options',
	'types' => array('post'),
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/post-meta.php',
));
/* eof */