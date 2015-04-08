<?php
$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_slides',
	'title' => 'Samba Slides Custom Options',
	'types' => array('pirenko_slides'),
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/slides-meta.php',
));
/* eof */