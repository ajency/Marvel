<?php
$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'Single Portfolio Custom Options',
	'types' => array('pirenko_portfolios'),
	'template' => dirname( __FILE__ ) . '/portfolio-meta.php',
));
/* eof */