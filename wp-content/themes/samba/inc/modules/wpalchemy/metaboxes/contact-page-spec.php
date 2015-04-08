<?php

$custom_metabox_temp_port = $simple_mb_temp_port = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_contact-page_template',
	'title' => 'Samba Contact Page Custom Options',
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/contact-page-meta.php',
	'include_template' => array('page-contact.php') // use an array for multiple items
));
/* eof */