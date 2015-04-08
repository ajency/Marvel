<?php

$custom_metabox_temp_port = $simple_mb_temp_port = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_portfolio_template',
	'title' => 'Samba Portfolio Template Custom Options',
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/template-portfolio-acc-meta.php',
	'include_template' => array(
		'template_portfolio_accordion.php') // use an array for multiple items
));
/* eof */