<?php
$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'Single Member Custom Options',
	'types' => array('pirenko_team_member'),
	'template' => dirname( __FILE__ ) . '/members-meta.php',
));
/* eof */