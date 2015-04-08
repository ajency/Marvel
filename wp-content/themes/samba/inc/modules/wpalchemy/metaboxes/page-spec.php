<?php

$custom_metabox_temp_port = $simple_mb_temp_port = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta_reg-page_template',
	'title' => 'Page Custom Options',
	'types' => array('page'),
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/page-meta.php',
	'exclude_template' => array('template_full_slider.php',
								'page-contact.php',
								'page-theme.php',
								'page-sections.php',
								'template_portfolio_accordion.php',
								'template_portfolio_masonry.php',
								'template_portfolio_titled.php',
								'template_portfolio_var-grid.php',
								'template_blog.php',
								'template_blog_masonry.php') // use an array for multiple items
));
/* eof */