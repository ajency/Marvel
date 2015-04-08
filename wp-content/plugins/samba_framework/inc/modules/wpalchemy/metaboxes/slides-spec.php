<?php
$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_slides',
	'title' => 'Samba Slides Custom Options',
	'types' => array('pirenko_slides'),
	'template' => dirname( __FILE__ ) . '/slides-meta.php',
));
/* eof */