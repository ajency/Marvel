<?php
$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'Single Member Custom Options',
	'types' => array('pirenko_team_member'),
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/members-meta.php',
));
/* eof */