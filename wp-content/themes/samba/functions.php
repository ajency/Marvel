<?php

	if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

	include_once locate_template('/inc/activation.php');            // Activations functions
	include_once locate_template('/inc/config.php');          // Configuration and constants
	include_once locate_template('/inc/cleanup.php');         // Cleanup
	include_once locate_template('/inc/helper.php');  	// Various functions
	include_once locate_template('/inc/modules/vt_resize.php');
	include_once locate_template('/inc/widgets.php');         // Sidebars and widgets
	include_once locate_template('/inc/custom.php');          // Custom functions
	include_once locate_template('/inc/theme_options.php');  	// Admin functions
	include_once locate_template('/inc/modules/sweet-custom-menu/sweet-custom-menu.php');  	// Shortcodes

	//ADD METABOXES SUPPORT
	include_once 'inc/modules/wpalchemy/metaboxes/setup.php';
	//ADD METABOXES FOR SPECIAL ELEMENTS
	include_once 'inc/modules/wpalchemy/metaboxes/page-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/portfolio-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/slides-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/members-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/template-portfolio-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/template-portfolio-spec-titled.php';
	include_once 'inc/modules/wpalchemy/metaboxes/template-portfolio-spec-grid.php';
	include_once 'inc/modules/wpalchemy/metaboxes/template-portfolio-acc-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/template-blog-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/template-blog-spec-masonry.php';
	include_once 'inc/modules/wpalchemy/metaboxes/template-full_slider-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/reg-page-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/post-spec.php';
	include_once 'inc/modules/wpalchemy/metaboxes/contact-page-spec.php';

	include_once 'inc/custom_tables.php';

	add_action('wp_enqueue_scripts', 'samba_scripts', 100);
	add_action('admin_print_scripts', 'samba_admin_scripts');
	add_action('after_setup_theme', 'samba_setup');
	add_action('wp_footer','jquery_sender');

	//ENABLE SHORTCODES ON SIDEBARS
	add_filter('widget_text', 'do_shortcode');

	//SEND EMAIL FUNCTION
	add_action('wp_ajax_mail_before_submit', 'prk_mail_before_submit');
	add_action('wp_ajax_nopriv_mail_before_submit', 'prk_mail_before_submit');

	//BETTER QTRANSLATE SUPPORT
	function qtranslate_edit_taxonomies(){
	   $args=array(
	      'public' => true ,
	      '_builtin' => false
	   );
	   $output = 'object'; // or objects
	   $operator = 'and'; // 'and' or 'or'

	   $taxonomies = get_taxonomies($args,$output,$operator);

	   if  ($taxonomies) {
	     foreach ($taxonomies  as $taxonomy ) {
	         add_action( $taxonomy->name.'_add_form', 'qtrans_modifyTermFormFor');
	         add_action( $taxonomy->name.'_edit_form', 'qtrans_modifyTermFormFor');

	     }
	   }

	}
	add_action('admin_init', 'qtranslate_edit_taxonomies');

	//WOOCOMMERCE STUFF
    if (PRK_WOO=="true")
    {
    	add_theme_support( 'woocommerce' );
		// Change number or products per row to 3
		add_filter('loop_shop_columns', 'loop_columns');
		if (!function_exists('loop_columns')) {
			function loop_columns() {
				return 3; // 3 products per row
			}
		}
    	$prk_woo_options=get_option('samba_theme_options');
    	if (isset($prk_woo_options['woo_cart_display']) && $prk_woo_options['woo_cart_display']!="no")
        	add_filter( 'wp_nav_menu_items', 'prk_cart_menu_item', 10, 2 );
		function prk_cart_menu_item ( $items, $args ) {
			//CHANGE ONLY THE MAIN MENU
			if( $args->theme_location == 'top_right_navigation' ) {
				global $woocommerce;
				$cart_url = $woocommerce->cart->get_cart_url();
				if ($cart_url=="")
					$cart_url="#";
				$cart_contents_count = $woocommerce->cart->cart_contents_count;
				$cart_contents = sprintf(_n('%d ITEM', '%d ITEMS', $cart_contents_count, 'samba_lang'), $cart_contents_count);
				$cart_total = $woocommerce->cart->get_cart_total();
				$prk_woo_options=get_option('samba_theme_options');
				if ($cart_contents_count > 0 || (isset($prk_woo_options['woo_cart_always_display']) && $prk_woo_options['woo_cart_always_display']=="yes"))
				{
				    $items .= '<li id="prk_hidden_cart"><a href="#">';
				    $woo_classes="";
				    $items .= '<div class="prk_cart_label '.$woo_classes.'">';
				    if (isset($prk_woo_options['woo_cart_info']) && $prk_woo_options['woo_cart_info']=="items")
						$items .= $cart_contents;
					if (isset($prk_woo_options['woo_cart_info']) && $prk_woo_options['woo_cart_info']=="price")
						$items .= $cart_total;
					if (isset($prk_woo_options['woo_cart_info']) && $prk_woo_options['woo_cart_info']=="both")
						$items .= $cart_contents.' - '. $cart_total;
				    $items .='</div></a></li>';
			    }
			    return $items;
			}
			else
			{
				//RETURN THE DEFAULT MENU
				return $items;
			}
		}
    }
	/**
	 * Include the TGM_Plugin_Activation class.
	 */
	require_once dirname( __FILE__ ) . '/inc/modules/tgm-plugin-activation/class-tgm-plugin-activation.php';

	add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
	/* Register the required plugins for this theme. */
	function my_theme_register_required_plugins() {

		$plugins = array(
			array(
				'name'     				=> 'Samba Framework',
				'slug'     				=> 'samba_framework',
				'source'   				=> get_template_directory_uri() . '/external_plugins/samba_framework.zip',
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '4.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
			    'name'                  => 'WPBakery Visual Composer',
			    'slug'                  => 'js_composer',
			    'source'                => get_template_directory_uri() . '/external_plugins/js_composer.zip',
			    'required'              => true, // If false, the plugin is only 'recommended' instead of required
			    'version'               => '4.3.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			    'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Envato toolkit - Useful to keep the theme updated',
				'slug'     				=> 'envato-wordpress-toolkit',
				'source'   				=> get_template_directory_uri() . '/external_plugins/envato-wordpress-toolkit.zip',
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '1.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
		);
		$config = array(
			'domain'       		=> 'samba_lang',         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> 'Hello',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', 'samba_lang' ),
				'menu_title'                       			=> __( 'Install Plugins', 'samba_lang' ),
				'installing'                       			=> __( 'Installing Plugin: %s', 'samba_lang' ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', 'samba_lang' ),
				'notice_can_install_required'     			=> _n_noop( 'IMPORTANT NOTE FOR UPDATES FROM THEME VERSIONS UNDER 4.0:<br>Before installing the new plugin "WPBakery Visual Composer" you must erase the following plugin: WPBakery Visual Composer (Samba)<br><br>This theme requires the following plugin (self-hosted): %1$s.', 'IMPORTANT NOTE FOR UPDATES FROM THEME VERSIONS UNDER 4.0:<br>Before installing the new plugin "WPBakery Visual Composer" you must erase the following plugin: WPBakery Visual Composer (Samba)<br><br>This theme requires the following plugins (self-hosted): %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin (self-hosted): %1$s.', 'This theme recommends the following plugins (self-hosted): %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.<br>The update is located on the theme root folder inside the external_plugins folder.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.<br>The updates are located on the theme root folder inside the external_plugins folder.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', 'samba_lang' ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'samba_lang' ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'samba_lang' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
		tgmpa( $plugins, $config );
	}
	//VISUAL COMPOSER STUFF
	if (PRK_COMPOSER=="true") {
		add_filter('wpb_widget_title', 'override_widget_title', 10, 2);
		function override_widget_title($output = '', $params = array('')) {
		  $extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
		  return '<div class="prk_shortcode-title"><div class="header_font sizer_small bd_headings_text_shadow zero_color '.$extraclass.'">'.$params['title'].'</div></div>';
		}
	    function samba_vcSetAsTheme() {
	        vc_set_as_theme();
	        vc_set_default_editor_post_types(array('page','post','pirenko_team_member','pirenko_slides','pirenko_portfolios'));
	    }
	    add_action('vc_before_init','samba_vcSetAsTheme');

	    //ENQUEUE THE THEME TWEAKED JS AND CSS FILES
	    function samba_vc_scripts() {
	        if ( defined('WPB_VC_VERSION') ) {
	            wp_deregister_style('js_composer_custom_css');
	            wp_deregister_style('js_composer_front');
	            wp_deregister_style('flexslider');

	            wp_deregister_script('waypoints');
	            wp_deregister_script('wpb_composer_front_js');
	            wp_deregister_script('isotope');
	            wp_deregister_script('flexslider');
	            wp_register_script('wpb_composer_front_js',get_template_directory_uri().'/js/js_composer_front-min.js', array('jquery'), WPB_VC_VERSION, true );
	            wp_enqueue_script('wpb_composer_front_js');
	        }
	    }
	    add_action('wp_enqueue_scripts', 'samba_vc_scripts', 10);//WAS 100
	}




















/**
 * Register a residential-property post type.
 *
 */
function codex_residential_property_init() {
    $labels = array(
        'name'               => _x( 'Residential Properties', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Residential Properties', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Residential Properties', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Residential Properties', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'Residential Property', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Residential Property', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Residential Property', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Residential Property', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Residential Property', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Residential Properties', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Residential Properties', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Residential Properties:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No Residential Properties found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No Residential Properties found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'ResidentialProperties' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'Residential-Property', $args );
}
add_action( 'init', 'codex_residential_property_init' );





/**
 * Register a residential-property post type.
 *
 */
function codex_commercial_property_init() {
    $labels = array(
        'name'               => _x( 'Commercial Properties', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Commercial Properties', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Commercial Properties', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Commercial Properties', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'Commercial Property', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Commercial Property', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Commercial Property', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Commercial Property', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Commercial Property', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Commercial Properties', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Commercial Properties', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Commercial Properties:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No Commercial Properties found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No Commercial Properties found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'Commercial-Property' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'Commercial-Property', $args );
}
add_action( 'init', 'codex_commercial_property_init' );















function add_custom_tax_property_amenities(){



        $labels = array(
            'name'              => _x( 'Amenities', 'taxonomy general name' ),
            'singular_name'     => _x( 'Amenity', 'taxonomy singular name' ),
            'search_items'      => __( 'Search Amenity'  ),
            'all_items'         => __( 'All Amenities'  ),
            'parent_item'       => __( 'Parent Amenity'  ),
            'parent_item_colon' => __( 'Parent Amenity : '  ),
            'edit_item'         => __( 'Edit Amenity' ),
            'update_item'       => __( 'Update Amenity' ),
            'add_new_item'      => __( 'Add New Amenity' ),
            'new_item_name'     => __( 'New Amenity' ),
            'menu_name'         => __( 'Amenities' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'stage_of_business' ),
        );

        register_taxonomy( 'property_amenity', array( 'residential-property','commercial-property' ), $args );

}

add_action( 'init', 'add_custom_tax_property_amenities', 0 );








/**
 * Add Custom Fields for the properties
 *
 */

/* Adds a meta box to the post edit screen */
function myplugin_add_custom_box() {
    $screens = array( 'residential-property', 'commercial-property' );
    foreach ( $screens as $screen ) {

	    	$custom_fields[] = array('field'				=> 'property-type',
	    							  'metabox_title'		=> 'Property Type',
	    							  'multiple_values' 	=> true,
	    							  'element_type'		=> 'select',
	    							  'option_value_prefix' => '',
	    							  'option_value_postfix'=> '',
	    							  'class'				=>'',
	    							  'priority'			=> 'default'
	    							);



	    	$custom_fields[] = array('field'				=> 'property-status',
	    							  'metabox_title'		=> 'Status',
	    							  'multiple_values' 	=> false,
	    							  'element_type'		=> 'select',
	    							  'option_value_prefix' => '',
	    							  'option_value_postfix'=> '',
	    							  'class'				=>'',
	    							  'priority'			=> 'default'
	    							);

	    	$custom_fields[] = array('field'				=> 'property-city',
	    							  'metabox_title'		=> 'City',
	    							  'multiple_values' 	=> false,
	    							  'element_type'		=> 'select',
	    							  'option_value_prefix' => '',
	    							  'option_value_postfix'=> '',
	    							  'class'				=>'',
	    							  'priority'			=> 'default'
	    							);

	    	$custom_fields[] = array('field'				=> 'property-locality',
	    							  'metabox_title'		=> 'Locality',
	    							  'multiple_values' 	=> false,
	    							  'element_type'		=> 'select',
	    							  'option_value_prefix' => '',
	    							  'option_value_postfix'=> '',
	    							  'class'				=>'',
	    							  'priority'			=> 'default'
	    							);



	    	$custom_fields[] = array ( 'field'				 => 'property-price',
    							  	   'metabox_title'		 => 'Price',
    							  	   'multiple_values' 	 => false,
    							  	   'element_type'		 => 'text',
    							  	   'option_value_prefix' => ' INR',
    							  	   'option_value_postfix'=> '',
    							  	   'class'				 => '',
    							  	   'priority'			=> 'default'
    								 );

        if($screen=="residential-property") {

	    	$custom_fields[] = array ( 'field'				 => 'property-no_of_bedrooms',
	    							   'metabox_title'		 => 'No Of Bedrooms',
	    							   'multiple_values' 	 => false,
	    							   'element_type'		 => 'select',
	    							   'option_value_prefix' => '',
	    							   'option_value_postfix'=> '',
	    							   'class'				 => '',
	    							   'priority'			=> 'default'
	    								 );





    		$custom_fields[] = array ( 'field'				 => 'property-sellable_area',
    							  	   'metabox_title'		 => 'Sellable Area',
    							  	   'multiple_values' 	 => true,
    							  	   'element_type'		 => 'text',
    							  	   'option_value_prefix' => '',
    							  	   'option_value_postfix'=> 'Sq ft',
    							  	   'class'				 => 'allownumericwithdecimal',
    							  	   'priority'			=> 'default'
    								 );

	    	}

	    	$custom_fields[] = array('field'				=> 'property-neighbourhood',
	    							  'metabox_title'		=> 'Neighbourhood',
	    							  'multiple_values' 	=> true,
	    							  'element_type'		=> 'text',
	    							  'option_value_prefix' => '',
	    							  'option_value_postfix'=> ' Kms',
	    							  'class'				=> 'allownumericwithdecimal',
	    							  'priority'			=> 'default'
	     							);

	    	$custom_fields[] = array('field'				=> 'property-siteplan',
	    							  'metabox_title'		=> 'Site Plan',
	    							  'multiple_values' 	=> false,
	    							  'element_type'		=> 'file',
	    							  'option_value_prefix' => '',
	    							  'option_value_postfix'=> '',
	    							  'class'				=> '',
	    							  'priority'			=> 'default'
	     							);




	    	/*foreach($custom_fields as $custom_field){

					add_meta_box (
					            	$custom_field['field'].'_box_id',             // Unique ID
					            	$custom_field['metabox_title'],               // Box title
					            	'myplugin_inner_custom_box',   // Content callback
					            	$screen ,                       // post type
					            	'normal',
					            	$custom_field['priority'],
					            	array( 'custom_field_type'=>$custom_field['field'],
					            	   		'multiple_values'=>$custom_field['multiple_values'],
                                            'element_type'=>$custom_field['element_type'],
                                            'custom_field_args'=>$custom_field
                                            )
					        );
	    	}*/



	    	 $custom_field_address[] = array('field'            	=> 'property-address-details',
                                    'metabox_title'     	=> 'Property Address',
                                    'multiple_values'   	=> true,
                                    'element_type'	    	=> 'custom_address_details_text',
                                    'option_value_prefix' 	=> '',
	    							'option_value_postfix' 	=> '',
	    							'class'					=>'',
	    							'priority'			=> 'default'
                                    );





	    	add_meta_box (
					            	'additional_properties_details_box_id',             // Unique ID
					            	'Additional Property Details',               // Box title
					            	'myplugin_inner_custom_box',   // Content callback
					            	$screen ,                       // post type
					            	'normal',
					            	'default',
					            	array(
                                            'custom_field_args'=>$custom_fields
                                            )
					        );

	    	add_meta_box (
					            	$custom_field_address[0]['field'].'_box_id',             // Unique ID
					            	$custom_field_address[0]['metabox_title'],               // Box title
					            	'myplugin_inner_custom_box',   // Content callback
					            	$screen ,                       // post type
					            	'normal',
					            	'default',
					            	array( 'custom_field_type'=>$custom_field_address[0]['field'],
					            	   		'multiple_values'=>$custom_field_address[0]['multiple_values'],
                                            'element_type'=>$custom_field_address[0]['element_type'],
                                            'custom_field_args'=>$custom_field_address
                                            )
					        );







    }
}

add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );


/* Prints the box content */
function myplugin_inner_custom_box( $post , $metabox) {

    $current_post_type = $post->post_type;

   /* $custom_field_type = $metabox['args']['custom_field_type'];

 	$multiple_values   =  $metabox['args']['multiple_values'];

    $element_type = $metabox['args']['element_type'];

    $element_custom_field_args = $metabox['args']['custom_field_args'];*/

    wp_nonce_field(basename(__FILE__), "meta-box-nonce");






$custom_fields = $metabox['args']['custom_field_args'];

foreach($custom_fields as $custom_field_key => $custom_field_val)
{


    $custom_field_type = $custom_field_val['field'];

 	$multiple_values   =  $custom_field_val['multiple_values'];

    $element_type = $custom_field_val['element_type'];

    $element_custom_field_args = $custom_field_val;








?>

<div class="row">
<input type="hidden" name="current_post_type" value="<?php echo $current_post_type; ?>" id="current_post_type" />
<?php

    switch($custom_field_type){

    	case 'property-type' :
    							if($current_post_type=="residential-property"){
							        $property_types = maybe_unserialize(get_option('residential-property-type'));
							        $current_property_meta_value =    get_post_meta($post->ID, "residential-property-type", true);
							    }
							    else{
							        $property_types = maybe_unserialize(get_option('commercial-property-type'));
							        $current_property_meta_value =    get_post_meta($post->ID, "residential-property-type", true);
							    }

							    $edit_options_values = false ;


								 generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_types, $current_property_meta_value, $element_custom_field_args,$edit_options_values);

    						    break;

    	case 'property-status'			:
    							$property_status = maybe_unserialize(get_option('property-status'));
    							$current_property_meta_value =    get_post_meta($post->ID, "property-status", true);

    							$edit_options_values = true ;

								generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_status, $current_property_meta_value, $element_custom_field_args,$edit_options_values);

    						    break;

    	case 'property-city'	:
    							$property_city_locality = maybe_unserialize(get_option('property-citylocality'));
    							$current_property_meta_value =    get_post_meta($post->ID, "property-city", true);

								$property_city= array();
    							if($property_city_locality!=false){
    								$property_city = array_keys($property_city_locality);
    							}


    							$edit_options_values = true ;

								generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_city, $current_property_meta_value, $element_custom_field_args,$edit_options_values);

    						    break;

    	case 'property-locality'			:
    							$property_city_locality = maybe_unserialize(get_option('property-citylocality'));

    							$current_property_meta_value =    get_post_meta($post->ID, "property-locality", true);

    							$current_property_meta_city =    get_post_meta($post->ID, "property-city", true);

    							$property_locality = array();

    							if($property_city_locality!==false){

    								foreach($property_city_locality as $property_city_locality_k => $property_city_locality_v ){
	    								if($property_city_locality_k == $current_property_meta_city ){

	    									$property_locality = $property_city_locality_v;
	    								}

    								}
    							}

								$edit_options_values = true;

								generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_locality, $current_property_meta_value, $element_custom_field_args,$edit_options_values);

    						    break;

    	case 'property-neighbourhood'			:


    							$property_neighbourhood = maybe_unserialize(get_option('property-neighbourhood'));
							    $current_property_meta_value =    maybe_unserialize(get_post_meta($post->ID, "property-neighbourhood", true)) ;
								$edit_options_values = true;


								generate_custom_field_element($post, 'text', $multiple_values, 'custom_'.$custom_field_type,  $property_neighbourhood, $current_property_meta_value, $element_custom_field_args,$edit_options_values);


							    $property_field_options = maybe_unserialize(get_option($metabox['field']));

    						    break;

        case 'property-no_of_bedrooms'			:
                                $property_no_of_bedrooms = maybe_unserialize(get_option('property-no_of_bedrooms'));
                                $current_property_meta_value =    get_post_meta($post->ID, "property-no_of_bedrooms", true);

                                $edit_options_values = true;
                                generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_no_of_bedrooms, $current_property_meta_value, $element_custom_field_args,$edit_options_values);

                                break;

		 case 'property-price':
                                $property_price = array();
                                $current_property_meta_value =    maybe_unserialize(get_post_meta($post->ID, "property-price", true));

                                $edit_options_values = false;
                                generate_custom_field_element($post, 'text', $multiple_values, 'custom_'.$custom_field_type,  $property_price, $current_property_meta_value, $element_custom_field_args,$edit_options_values);

                                break;

        case 'property-sellable_area':
                                $property_sellable_area = array('min-area' ,'max-area' );
                                $current_property_meta_value =    maybe_unserialize(get_post_meta($post->ID, "property-sellable_area", true));
                                if( ($current_property_meta_value==false) || (!is_array($current_property_meta_value)) ){
                                	$current_property_meta_value = array('min-area'=>'','max-area'=>'');
                                }
                                $edit_options_values = false;

                                generate_custom_field_element($post, 'text', $multiple_values, 'custom_'.$custom_field_type,  $property_sellable_area, $current_property_meta_value, $element_custom_field_args,$edit_options_values);

                                break;


        case 'property-address-details':

					            $address_field_data = get_custom_address_fields_by_id($post->ID);
														get_custom_address_elements_html($address_field_data);

					            /* $property_address_details = array();
					            $current_property_meta_value =    get_post_meta($post->ID, "property-sellable_area", true);

					            generate_custom_field_element($post, 'text', $multiple_values, 'custom_'.$custom_field_type,  $property_sellable_area, $current_property_meta_value);
								*/
					            break;


        case 'property-siteplan':
                                $property_price = array();
                                $current_property_meta_value =    get_post_meta($post->ID, "property-price", true);
                                $edit_options_values = false ;

                                generate_custom_field_element($post, 'file', $multiple_values, 'custom_'.$custom_field_type,  $property_price, $current_property_meta_value, $element_custom_field_args,$edit_options_values);

                                break;




    }



    ?>
    </div>
<?php

	}
}



function get_custom_address_fields_by_id($id){

    global $wpdb;
    $qry_get_address = "SELECT * FROM {$wpdb->prefix}addresses WHERE addressable_id = ".$id;

    $address_fields_data = $wpdb->get_results($qry_get_address,ARRAY_A);
    return $address_fields_data;

}





function get_custom_address_elements_html($address_field_data){

    ?>
    <div class="set_admin_input marg_b_15">
    		<div class="admin_field">
        		<input id="address" name="address" type="textbox" value="<?php if(isset($address_field_data[0]['address'])){ echo $address_field_data[0]['address']; } else { echo 'pune, India' ; } ?>">
        	</div>
        	<div class="admin_button">
        		<input type="button" value="Geocode" class="button button-primary button-large" onclick="codeAddress()">
        	</div>
        </div>
    </div>

    <div class="set_admin_input">
    	<div class="admin_label">
    		<label for="custom-address_city">City</label>
        </div>
        <div class="admin_input">
    		<input id="custom-address_city" name="custom-address_city" type="textbox" value="<?php if(isset($address_field_data[0]['city'])){ echo $address_field_data[0]['city']; } ?>">
        </div>
	</div>

	 <div class="set_admin_input">
    	<div class="admin_label">
    		<label for="custom-address_region">Region</label>
        </div>
        <div class="admin_input">
          <input id="custom-address_region" name="custom-address_region" type="textbox" value="<?php if(isset($address_field_data[0]['region'])){ echo $address_field_data[0]['region']; } ?>">
        </div>
	</div>



    <div class="set_admin_input">
    	<div class="admin_label">
    		<label for="custom-address_country">Country</label>
        </div>
        <div class="admin_input">
    		<input id="custom-address_country" name="custom-address_country" type="textbox" value="<?php if(isset($address_field_data[0]['country'])){ echo $address_field_data[0]['country']; } ?>">
    	</div>
	</div>


    <div class="set_admin_input marg_b_15">
    	<div class="admin_label">
    		<label for="custom-address_postcode">Pincode</label>
        </div>
        <div class="admin_input">
            <input id="custom-address_postcode" name="custom-address_postcode" type="textbox" value="<?php if(isset($address_field_data[0]['postcode'])){ echo $address_field_data[0]['postcode']; } ?>">
        </div>
	</div>

    <div class="set_admin_input">
    	<div class="admin_label">
    		<label for="custom-address_lat">Lattitude</label>
        </div>
        <div class="admin_input">
            <input id="custom-address_lat" name="custom-address_lat" type="textbox" value="<?php if(isset($address_field_data[0]['lat'])){ echo $address_field_data[0]['lat']; } ?>">
        </div>
    </div>
    <div class="set_admin_input">
    	<div class="admin_label">
    		<label for="custom-address_lng">Longitude</label>
        </div>
        <div class="admin_input">
            <input id="custom-address_lng" name="custom-address_lng" type="textbox" value="<?php if(isset($address_field_data[0]['lng'])){ echo $address_field_data[0]['lng']; } ?>">
        </div>
    </div>
<!--

    <div class="row">
    	<div class="col-md-12">
    		   Lat :
    		   &nbsp; Long :

    	</div>
	</div>
-->





     		<div id="map_canvas" style="height:400px;: width:550px; top:30px; position:relative; display:block; margin-bottom: 10px;"></div>



    <?php

}

function generate_custom_field_element($post, $element_type, $multiple_values, $element_id,  $element_values, $current_property_meta_value, $element_custom_field_args,$edit_options_values){


	$element_prefix_label   = $element_custom_field_args['option_value_prefix'];
	$element_postfix_label  = $element_custom_field_args['option_value_postfix'];
	$element_class 			= $element_custom_field_args['class'];
	$element_title 			= $element_custom_field_args['metabox_title'];
	$custom_field_type		= $element_custom_field_args['field'];

	echo '<div class="set_admin_input row"> ';
	if($multiple_values==false || ( ($multiple_values==true) && $element_type=='select'))
		echo '	<div class="admin_label">
		    		<label for="">'.$element_title.'</label>
			    </div>
		    	<div class="admin_input">';
	else
		echo '	<div class="admin_label">
		    		<label for="">'.$element_title.'</label>
			    </div>
		      ';

	if($custom_field_type=='property-type'){
?>
		<div class="admin_new_add_c">
<?php
	}
	else{
?>		<div class="admin_new_add_c">
<?php
	}
?>

<?php
	switch($element_type){
		case 'select' :


						if($custom_field_type=='property-type'){
							echo '<span class="prefix_te">'.$element_prefix_label.'</span>';

							echo '<span class="cust-prop-type-table">';



							$current_selected_types = maybe_unserialize($current_property_meta_value);
							$custom_field_options_values = maybe_unserialize($element_values);

							foreach ($current_selected_types as $key_selected_type => $value_selected_type) {


								    echo '<span class="adm_property_type_row">
								    		 <span class="adm_property_type_span_first">
								    		 	<select name="cust_prop_type_select[]" class="cust-prop-type-select">
								          			<option value="" >Select</option>';
								          			foreach ($custom_field_options_values['property_types'] as $k_cust_type_option_values => $v__cust_type_option_values) {

								          				$is_current_type_selected ='';
								          				if($value_selected_type['type'] == $v__cust_type_option_values['ID']){
								          					$is_current_type_selected =' selected ';
								          				}

								          				echo '<option value="'.$v__cust_type_option_values['ID'].'"   '.$is_current_type_selected.'>'.$v__cust_type_option_values['property_type'].'</option>';
								          			}


								    echo '		</select>
								    		 </span>
								             <span class="cust-prop-type-layout adm_property_type_span" >';

										    $cur_prop_layout_img_url ="";
										    $cur_prop_layout_img_filename ="";

										    if($value_selected_type['layout_image']!='' ){

										    	$layout_image = wp_get_attachment_image_src($value_selected_type['layout_image']);
										    	$cur_prop_layout_img_url = $layout_image[0];
										    	$cur_prop_layout_img_filename =basename( get_attached_file( $value_selected_type['layout_image'] ) );


										    }
										    if($cur_prop_layout_img_url!='' && $cur_prop_layout_img_url != false){
										    	echo '<span class="layout_pdf_link_span" type-id="'.$value_selected_type['type'].'" >
										    			<a href="'.$cur_prop_layout_img_url.'"  target="_blank" >'.$cur_prop_layout_img_filename.'</a>
										    			<span class="del_prop_type_layout_img"  file-id="'.$value_selected_type['layout_image'].'" property-id="'.$post->ID.'"    type-id="'.$value_selected_type['type'].'" > X </span>
										    		  </span>
										    		 ';
										    }
										    else{
										    	echo '<input type="file"  class="cust-prop-type-layout-file"
										    			name = "cust-prop-type-layout-file_'.$value_selected_type['type'].'"
										    			id ="cust-prop-type-layout-file_'.$value_selected_type['type'].'"  />';
										    }




								    echo '  </span>
								             <span class="cust-prop-type-pdf adm_property_type_span" > ';




								      		$cur_prop_layout_pdf_url ="";
										    $cur_prop_layout_pdf_filename ="";
//echo 'pdf id : '.$value_selected_type['layout_pdf'];
										    if($value_selected_type['layout_pdf']!='' ){

										    	// $layout_pdf = wp_get_attachment_image_src($value_selected_type['layout_pdf']);

										    	//var_dump($layout_pdf);
										    	//$cur_prop_layout_pdf_url = $layout_pdf[0];



										    	$parsed_pdf_file = parse_url( wp_get_attachment_url( $value_selected_type['layout_pdf'] ) );
												$cur_prop_layout_pdf_url    = dirname( $parsed_pdf_file [ 'path' ] ) . '/' . rawurlencode( basename( $parsed_pdf_file[ 'path' ] ) );
										    	$cur_prop_layout_pdf_filename =basename( get_attached_file( $value_selected_type['layout_pdf'] ) );

										    }
										    if($cur_prop_layout_pdf_url!='' && $cur_prop_layout_pdf_url != false){
										    	echo '<span class="layout_img_link_span" type-id="'.$value_selected_type['type'].'" >
										    			<a href="'.$cur_prop_layout_pdf_url.'" target="_blank" >'.$cur_prop_layout_pdf_filename.'</a>
										    		    <span class="del_prop_type_layout_pdf"  file-id="'.$value_selected_type['layout_pdf'].'"  property-id="'.$post->ID.'"  type-id="'.$value_selected_type['type'].'" >X</span>
										    		  </span>';
										    }
										    else{
										    	echo '<input type="file"  class="cust-prop-type-layout-pdf"
										    				name="cust-prop-type-layout-pdf_'.$value_selected_type['type'].'"
										    				id="cust-prop-type-layout-pdf_'.$value_selected_type['type'].'"
										    			/>';
										    }




								    echo'	</span>
								    		<span class="cust-prop-type-pdf adm_property_type_span" > <input type="button" value="Delete" class="del_property_type_row"   file-id="'.$value_selected_type['layout_pdf'].'"  property-id="'.$post->ID.'"  type-id="'.$value_selected_type['type'].'"  /> </span>
								          </span>' ;

							}

							echo '</span>';
							echo '<span class="get_property_type button button-primary button-large">+</span>';
							// echo "<style type='text/css'>

							// 		.adm_property_type_row{

							// 			display:inline-block;
							// 		}


							// 		.adm_property_type_row .adm_property_type_span{
							// 		    display:inline-block;
							// 		    float:left;
							// 		    padding:5px;
							// 		     border-left:0px solid #147084;
							// 		    border-top:1px solid #147084;
							// 		    border-bottom:1px solid #147084;
							// 		    border-right:1px solid #147084;
							// 		    background-color: #e3e3e3;
							// 		}


							// 		.adm_property_type_row .adm_property_type_span_first{
							// 		    display:inline-block;
							// 		    float:left;
							// 		    padding:5px;
							// 		    border-left:1px solid #147084;
							// 		    border-top:1px solid #147084;
							// 		    border-bottom:1px solid #147084;
							// 		    border-right:1px solid #147084;
							// 		    background-color: #e3e3e3;
							// 		}
							// </style>";


						}
						else{

							echo '<span class="prefix_te">'.$element_prefix_label.'</span>'; ?>
									<select name="<?php echo $element_id; ?>" id="<?php echo $element_id; ?>" class="postbox custom_input_field <?php echo $element_class ; ?>"  <?php if($multiple_values==true) { echo ' multiple="multiple" ';  } ?> >
										<option value="">Select</option>
										<?php if($element_values!=false) {

													foreach($element_values as $type){ ?>
														<option value="<?php echo $type; ?>" <?php if($current_property_meta_value==$type) echo " selected ";?>><?php echo ucfirst($type); ?></option>

										<?php 		}

												}
										?>
									</select>
									<?php
							echo '<span class="kms_handle">'.$element_postfix_label.'</span>';

						}













						break;

		case 'text' :

//$current_property_meta_value_arr = maybe_unserialize($current_property_meta_value);
//var_dump($current_property_meta_value_arr);

						if($multiple_values==true) {

							if($element_values!=false){
								foreach($element_values as $type){

									 $new_current_val = '';
									 if(is_array($current_property_meta_value)){


										 foreach($current_property_meta_value as $cur_field_value_k=>$cur_field_value_v){

											//echo "<br/>type : ".$type." cur_field_value_k:".$cur_field_value_k;
											if($type==$cur_field_value_k){
												$new_current_val = $cur_field_value_v;

											}
										}
									 }
//var_dump(array_search($type, $current_property_meta_value));
									 echo '<div class="admin_new_add">';
									 echo '<span class="prefix_te">'.$element_prefix_label.'</span>';
									?>

								<!-- <div class="admin_new_add"> -->
									<div class="admin_label adm_small">
							    		<label for=""><?php echo ucfirst($type); ?></label>
								    </div>
							    	<div class="admin_input adm_small">
		    							<span attr-field-val ="<?php echo $type; ?>" class="row" >
		    								<input type="text" value="<?php echo $new_current_val ; ?>" attr-name="<?php echo $element_id; ?>"  attr-value="<?php echo $type; ?>"   name="<?php echo $element_id; ?>[<?php echo $type; ?>]"   class="postbox custom_input_field  <?php echo $element_class ; ?>"  />  <?php echo '<span class="kms_handle">'.$element_postfix_label.'</span>';?>
		    							</span>
		    						</div>
		    					</div>
						<?php
								}

							}
                            else {
                                echo "No options values added yet";
                            }



                        }
                        else{
                        	echo '<div class="admin_new_add">';
                        	echo '<span class="prefix_te">'.$element_prefix_label.'</span>';

                            ?>
                            <div class="clearfix"></div>
                            <span attr-field-val ="<?php echo $element_id; ?>" >  <input type="text" value="<?php echo $current_property_meta_value ; ?>" attr-name="<?php echo $element_id; ?>"  attr-value="<?php echo $element_id; ?>"   name="<?php echo $element_id; ?>"   class="postbox custom_input_field  <?php echo $element_class ; ?>"  /> </span>
                        <?php
                        	echo '<span class="kms_handle">'.$element_postfix_label.'</span>';
                        	echo '</div>';

                        }


						 break;

		case 'checkbox': $current_property_meta_value_arr = maybe_unserialize($current_property_meta_value);

						 if($multiple_values==true) {

						 	if($element_values!=false){
								foreach($element_values as $type){


									 $property_type_layout_image = '';
									 $property_type_match = false;

									if(is_array($current_property_meta_value_arr)){

										foreach ($current_property_meta_value_arr as $cur_prop_type_key => $cur_prop_type_value) {
											if($type==$cur_prop_type_value['type']){
												$img_id  = $cur_prop_type_value['layout'];
												$prop_type_layout_img = wp_get_attachment_image_src( $img_id,'thumbnail' );
												$property_type_layout_image = $prop_type_layout_img[0];
												$property_type_match = true;
											}
										}

									}





									echo '<div class="admin_new_add">';
									echo '<span class="prefix_te">'.$element_prefix_label.'</span>';
									?><div class="clearfix"></div>

								<!-- <div class="admin_new_add"> -->
							    	<div class="admin_input adm_small" style="margin-bottom: 5px;">
		    							<span attr-field-val ="<?php echo $type; ?>" class="row" >
		    								<input type="checkbox" <?php if($property_type_match==true){ echo " checked='checked' "; } ?>value="<?php echo $type; ?>" attr-name="<?php echo $element_id; ?>"  attr-value="<?php echo $type; ?>"   name="<?php echo $element_id; ?>[]"   class="postbox custom_input_field  <?php echo $element_class ; ?>"  />  <?php echo '<span  >'.$element_postfix_label.'</span>';?>
		    								<label class="inline" for=""><?php echo $type; ?></label>
		    								<input type="file" value="<?php echo $current_property_meta_value ; ?>" attr-name="<?php echo $element_id; ?>"  attr-value="<?php echo $element_id; ?>"   name="<?php echo $element_id; ?>_<?php echo str_replace(' ', '_', $type); ?>"   class="postbox custom_input_field  <?php echo $element_class ; ?>"  />
				                        		<?php if( $property_type_layout_image!='') { ?>
				                        			<img src="<?php echo $property_type_layout_image ?>" width="80" height="80" />
				                        			<a href='javascript:void(0)' class='delete_property_type_layout'  property-type-value = '<?php echo $type; ?>' property-id='<?php echo get_the_ID(); ?>' >Delete</a>
				                        		<?php
				                        			}
				                        		?>
		    							</span>








		    						<!-- </div>
									<div class="admin_label adm_small"> -->

								    </div>
						<?php		echo "</div>";


								}
							}



						 }
						break;



		case 'file' :

						$img_id = get_post_meta(get_the_ID(), 'custom_property-siteplan', true);

						if($img_id!=false){
							$site_plan_img = wp_get_attachment_image_src( $img_id,'thumbnail' );

							$current_property_meta_value_arr = maybe_unserialize($current_property_meta_value);

						}


                    	echo '<div class="admin_new_add">';
                    	echo '<span class="prefix_te">'.$element_prefix_label.'</span>';

                        ?>
                        <div class="clearfix"></div>
                        <span attr-field-val ="<?php echo $element_id; ?>" >  <input type="file" value="" attr-name="<?php echo $element_id; ?>"  attr-value="<?php echo $element_id; ?>"   name="<?php echo $element_id; ?>"   class="postbox custom_input_field  <?php echo $element_class ; ?>"  />
                        <?php if($site_plan_img!=false && $img_id!=false) { ?>
                        			<img src="<?php echo $site_plan_img[0] ?>" width="80" height="80"  />
								<a href='javascript:void(0)'  custom-field='custom_property-siteplan'
									class='delete_property_siteplan'  attr-value = '<?php echo $img_id; ?>'
									property-id='<?php echo get_the_ID(); ?>' >Delete</a>


                        <?php } ?>
                         </span>
                    	<?php
                    	echo '<span class="kms_handle">'.$element_postfix_label.'</span>';
                    	echo '</div>';




						 break;





	}
?>

<?php

	//if(  ($multiple_values==true && $element_type=='text') ||( ($element_type!='checkbox')  && ($element_type!='file') && ($element_type!='text') && ($element_type!='custom_address_details_text') )   ) {
	if($edit_options_values==true){

    ?>
    	<br/><br/>
        <a href="javascript:void(0)" field-type="<?php echo $custom_field_type; ?>"  class="add_custom_postmeta_options">Add New Value</a> &nbsp;
        <a href="javascript:void(0)" field-type="<?php echo $custom_field_type; ?>"  class="edit_custom_postmeta_options">Edit</a>
        <div class="edit_options_area"></div>
        <!-- <input type="button" field-type="property-type" name="add_type" class="add_custom_postmeta_options" value="Add Types" /> -->
    <?php
    }

    if($multiple_values==false || ( ($multiple_values==true) && $element_type=='select')){
    	echo '	</div>
    			</div>
			</div>';
    }
    else{
    	echo "	</div>
    		</div>";
    }



}

function myplugin_save_postdata( $post_id ) {
    if ( array_key_exists('myplugin_field', $_POST ) ) {
        update_post_meta( $post_id,
            '_my_meta_value_key',
            $_POST['myplugin_field']
        );
    }
}
add_action( 'save_post', 'myplugin_save_postdata' );


function my_enqueue($hook) {


	//if( 'edit.php' == $hook  )
		wp_enqueue_script( 'custom-admin-script',site_url().'/wp-content/themes/samba/js/custom_admin_script.js',array('jquery'));



    if( 'post.php' != $hook && 'post-new.php' != $hook ) return;
    /* commented on 7june2015
    wp_enqueue_script( 'undescore','https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js',
        array('jquery') ); */

wp_enqueue_script( 'undescore',site_url().'/wp-content/themes/samba-child/dev/js/lib/underscore.min.js',
        array('jquery') );

	$load_map_script = false;
    if ( $hook == 'post-new.php' ){
		if($_REQUEST[post_type]=='residential-property')
			$load_map_script = true;
    }
    if($hook == 'post.php' ) {
    	if($_REQUEST['action']=='edit'){
    		if(get_post_type( $_REQUEST['post']) == 'residential-property')
    			$load_map_script = true;

    	}
    }


       wp_localize_script( 'ajax-script', 'ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ));


    if ( $load_map_script == true ) {

    	//wp_enqueue_style('bootstrap-min', site_url() . '/wp-content/themes/samba/css/bootstrap.min.css', array(), null);

    	wp_enqueue_style('custom', site_url() . '/wp-content/themes/samba-child/custom.css', array(), null);
    	wp_enqueue_script( 'geolocation_gmap','https://maps.googleapis.com/maps/api/js?sensor=false' );

    	wp_enqueue_script('mygeolocation_js',get_template_directory_uri().'/js/mygeolocation.js', array('jquery')  );
		wp_enqueue_script( 'custom-script',site_url().'/wp-content/themes/samba/js/myjquery.js?ver=4.1.1',
        array('jquery'));

    }







}
add_action('admin_enqueue_scripts', 'my_enqueue');



function my_change() {
    $data = get_option( 'myplugin_data' );
    echo array_key_exists( $_POST['selection'], $data ) ?
        $data[ $_POST['selection']] : 'Please Select Something!';
    die(); // all ajax handlers must die when finished
}
add_action( 'wp_ajax_change', 'my_change' );



function add_new_custom_field_option() {


    $custom_field_option_val    = $_REQUEST['data']['field_val'];
    $custom_field_option_name   = $_REQUEST['data']['field_type'];
    $post_type                  = $_REQUEST['data']['post_type'];
    if(isset($_REQUEST['data']['property_city']))
    	$post_city              = $_REQUEST['data']['property_city'];


    //var_dump($_REQUEST);

    if($custom_field_option_name == "property-city" || $custom_field_option_name == "property-locality"){

		$property_types_data = get_properties_type_option_by_post_type(array( "field_name"=>'property-citylocality', 'post_type'=>$post_type   )) ;

    }
    else{

    	$property_types_data = get_properties_type_option_by_post_type(array( "field_name"=>$custom_field_option_name, 'post_type'=>$post_type   )) ;
    }



    $property_types                = $property_types_data['property_types'];
    $real_custom_field_option_name = $property_types_data['real_property_type_option_name'];

    $add_new_value = false;

    if($property_types==false)
        $add_new_value = true;
    else{

		if($custom_field_option_name == "property-city"){
			$property_types_data = array_keys($property_types );

			if(array_search($custom_field_option_val,$property_types_data)===false){
            	$add_new_value = true;
			}
        //property_city

		}
		else if($custom_field_option_name == "property-locality"){

			$property_types_data = isset($property_types[$post_city])? $property_types[$post_city]:array();

			if(array_search($custom_field_option_val,$property_types_data)===false){
            	$add_new_value = true;
			}
		}
		else if(array_search($custom_field_option_val,$property_types)===false){
            $add_new_value = true;
        }
    }

    $return_result = false ;

    if($add_new_value == true){

        if($custom_field_option_name == "property-city"){

        	$property_types[$custom_field_option_val] = array();

        	$return_result = update_option('property-citylocality',maybe_serialize($property_types));

        }
        if($custom_field_option_name == "property-locality"){

        	$property_types_data[] = $custom_field_option_val;

        	foreach ($property_types as $k_property_type => $v_property_type) {
        		 if($k_property_type==$post_city){
        		 	$v_property_type[] = $custom_field_option_val;
        		 }

        		 $new_property_types[$k_property_type] = $v_property_type;

        	}

        	$return_result = update_option('property-citylocality',maybe_serialize($new_property_types));
        }
        else{

        	 $property_types[] = $custom_field_option_val;

        	 $return_result = update_option($real_custom_field_option_name,maybe_serialize($property_types));
        }


    }


	wp_send_json($return_result);

}
add_action( 'wp_ajax_save_custom_field_option', 'add_new_custom_field_option' );



function get_properties_type_option_by_post_type($custom_field_option){


    $post_type                  = $custom_field_option['post_type'];
    $custom_field_option_name   = $custom_field_option['field_name'];

    if($custom_field_option_name=="property-type"){
        if($post_type=="residential-property" )
            $real_custom_field_option_name = "residential-property-type";
        else if ($post_type=="commercial-property")
            $real_custom_field_option_name = "commercial-property-type";
    }
    else if($custom_field_option_name=="property-locality" || $custom_field_option_name=="property-city" ){
    		$real_custom_field_option_name = 'property-citylocality';
    }
    else {
    	$real_custom_field_option_name = $custom_field_option_name;
    }

    $property_types = maybe_unserialize(get_option($real_custom_field_option_name));



    $property_types_arr = $property_types===false? array(): $property_types;

    $custom_fields_details = array( 'real_property_type_option_name' => $real_custom_field_option_name,
    							    'property_types' 			     => $property_types_arr  )  ;

    return  $custom_fields_details;

}

function get_custom_field_options() {

    $custom_field_option_name   = $_REQUEST['data']['field_type'];
    $post_type                  = $_REQUEST['data']['post_type'];

    $custom_field_data = array('post_type'  => $post_type,
                               'field_name' => ($custom_field_option_name=='property-city'||$custom_field_option_name=='property-locality')?'property-citylocality':$custom_field_option_name
                               );

    $property_types_data = get_properties_type_option_by_post_type($custom_field_data);

    wp_send_json($property_types_data['property_types']);


}
add_action( 'wp_ajax_get_custom_field_options', 'get_custom_field_options' );




function delete_custom_field_option() {



    $custom_field_option_name   = $_REQUEST['data']['field_name'];
    $custom_field_option_value  = $_REQUEST['data']['field_value'];
    $post_type                  = $_REQUEST['data']['post_type'];

    if(isset($_REQUEST['data']['property_city']))
    	$property_city = $_REQUEST['data']['property_city'];


    $custom_field_data = array('post_type'  => $post_type,
                               'field_name' => $custom_field_option_name
                               );


    if($custom_field_option_name=="property-city" || $custom_field_option_name == "property-locality"){

		 $custom_fields = get_properties_type_option_by_post_type(array('post_type'  => $post_type,
                               'field_name' => 'property-citylocality'
                               ));
    }
    else{
    	$custom_fields = get_properties_type_option_by_post_type($custom_field_data);
    }



    $existing_fields_values =   $custom_fields['property_types'];
    $real_property_type_option_name =  $custom_fields['real_property_type_option_name'];

    $new_field_data = array();

    $delete_success = false;

    foreach($existing_fields_values as $f_k => $f_v){

    	if($custom_field_option_name=="property-city"){

    		 if($custom_field_option_value!=$f_k){
	            $new_field_data[$f_k] = $f_v ;
	            $delete_success = true;
	        }

    	}
    	else if($custom_field_option_name=="property-locality"){

    		if($property_city==$f_k){

    			if($key = array_search($custom_field_option_value, $f_v) !== false){
	        		unset($f_v[$key])	;
	        	}

	            $new_field_data[$f_k] = $f_v ;
	            $delete_success = true;
	        }
	        else{

	        	$new_field_data[$f_k] = $f_v ;
	            $delete_success = true;

	        }

    	}
    	else {


	        if($custom_field_option_value!=$f_v){
	            $new_field_data[] = $f_v ;
	            $delete_success = true;
	        }

    	}

    }

    update_option($real_property_type_option_name,$new_field_data);

    wp_send_json($delete_success);


}
add_action( 'wp_ajax_delete_custom_field_option', 'delete_custom_field_option' );


















function save_custom_meta_box($post_id, $post, $update)
{
	global $wpdb;

    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    /* $slug = "post";
    if($slug != $post->post_type)
        return $post_id;
	*/

	if( ($post->post_type=="residential-property") || ($post->post_type=="commercial-property") ){

		$sel_property_type = $_REQUEST["cust_prop_type_select"];
		$sel_property_city = $_REQUEST["custom_property-city"];
		$sel_property_status = $_REQUEST["custom_property-status"];
		$sel_property_locality = $_REQUEST["custom_property-locality"];
		$sel_property_neighbourhood = maybe_serialize($_REQUEST["custom_property-neighbourhood"]);
        $sel_property_no_of_bedrooms = $_REQUEST['custom_property-no_of_bedrooms'];
        $sel_property_sellable_area = $_REQUEST['custom_property-sellable_area'];
        $sel_property_price = $_REQUEST['custom_property-price'];



        $sel_property_address_city = $_REQUEST['custom-address_city'];
        $sel_property_address_region = $_REQUEST['custom-address_region'];
        $sel_property_address_country = $_REQUEST['custom-address_country'];
        $sel_property_address_postcode = $_REQUEST['custom-address_postcode'];
        $sel_property_address_lat = $_REQUEST['custom-address_lat'];
        $sel_property_address_lng = $_REQUEST['custom-address_lng'];
        $sel_property_address = $_REQUEST['address'];



/* foreach ($variable as $key => $value) {
	# code...
} */


       $exist_address = $wpdb->get_var("select count(*) FROM {$wpdb->prefix}addresses WHERE addressable_id = ".$post_id);
        if($exist_address>0){
            $qry_address = "update {$wpdb->prefix}addresses SET city ='".$sel_property_address_city."',
                                                address ='".$sel_property_address."',
                                                region ='".$sel_property_address_region."',
                                                postcode ='".$sel_property_address_postcode."',
                                                country ='".$sel_property_address_country."',
                                                lat ='".$sel_property_address_lat."',
                                                lng ='".$sel_property_address_lng."'
                                                 WHERE addressable_id = ".$post_id."
                                                ";
        }
        else{
            $qry_address = "insert into  {$wpdb->prefix}addresses (address,city, region, postcode, country, lat, lng, addressable_id)
              value ('".$sel_property_address."','".$sel_property_address_city."', '".$sel_property_address_region."',
               '".$sel_property_address_postcode."', '".$sel_property_address_country."', '".$sel_property_address_lat."', '".$sel_property_address_lng."',
                                                  ".$post_id.")
                                                ";
        }

        $wpdb->query($qry_address);





// Make sure the file array isn't empty
/*    if(!empty($_FILES['custom_property-siteplan']['name'])) {

        // Setup the array of supported file types. In this case, it's just PDF.
        $supported_types = array('application/pdf');

        // Get the file type of the upload
        $arr_file_type = wp_check_filetype(basename($_FILES['custom_property-siteplan']['name']));
        $uploaded_type = $arr_file_type['type'];

        // Check if the type is supported. If not, throw an error.
       // if(in_array($uploaded_type, $supported_types)) {

            // Use the WordPress API to upload the file
            $upload = wp_upload_bits($_FILES['custom_property-siteplan']['name'], null, file_get_contents($_FILES['custom_property-siteplan']['tmp_name']));


            if(isset($upload['error']) && $upload['error'] != 0) {
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
            } else {
                add_post_meta($post_id, 'custom_property-siteplan', $upload);
                update_post_meta($post_id, 'custom_property-siteplan', $upload);
            } // end if/else

       / * } else {
            wp_die("The file type that you've uploaded is not a PDF.");
        } // end if/else * /

    } // end if */





    if(!empty($_FILES['custom_property-siteplan']['name'])) {

			$uploadStatus = wp_handle_upload( $_FILES['custom_property-siteplan'], array( 'test_form' => false ) );   // Let WordPress handle the upload

            // Make sure that the file was uploaded correctly, without error
            if( isset( $uploadStatus['file'] ) ) {
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');

                // Let's add the image to our media library so we get access to metadata
                $imageID = wp_insert_attachment( array(
                        'post_mime_type'    => $uploadStatus['type'],
                        'post_title'        => preg_replace( '/\.[^.]+$/', '', basename( $uploadStatus['file'] ) ),
                        'post_content'      => '',
                        'post_status'       => 'publish'
                    ),
                    $uploadStatus['file']
                );

                // Generate our attachment metadata then update the file.
                $attachmentData = wp_generate_attachment_metadata( $imageID, $uploadStatus['file'] );
                wp_update_attachment_metadata( $imageID,  $attachmentData );


                $existingImage = get_post_meta($post_id,'custom_property-siteplan',true) ;            // IF a file already exists in this option, grab it
                if( ! empty( $existingImage ) && is_numeric( $existingImage ) ) {       // IF the option does exist, delete it.
                    wp_delete_attachment( $existingImage );
                }

				update_post_meta($post_id, 'custom_property-siteplan', $imageID);

			}


	}



		$property_types_data_value = array();

		$current_property_type = maybe_unserialize(get_post_meta($post_id,'residential-property-type',true));

		if($post->post_type=="residential-property"){

			if(!empty($sel_property_type) && is_array($sel_property_type)){


			foreach ($sel_property_type as $proptype_key => $prop_value) {

				$prop_type_match_found = false ;

				$prop_type_match = array();

				$imageID 	 = '';

				$pdf_imageID = '';

				foreach ($current_property_type as $key_currentprop => $value_currentprop) {
					if($value_currentprop['type']==$prop_value){
							$prop_type_match_found = true ;

							$prop_type_match = $value_currentprop ;
					}
				}



				$file_name_field = 'cust-prop-type-layout-file_'.str_replace(' ', '_', $prop_value) ;

				if(!empty($_FILES[$file_name_field])) {

					$uploadStatus = wp_handle_upload( $_FILES[$file_name_field], array( 'test_form' => false ) );   // Let WordPress handle the upload

		            // Make sure that the file was uploaded correctly, without error
		            if( isset( $uploadStatus['file'] ) ) {
		                require_once(ABSPATH . "wp-admin" . '/includes/image.php');

		                // Let's add the image to our media library so we get access to metadata
		                $imageID = wp_insert_attachment( array(
		                        'post_mime_type'    => $uploadStatus['type'],
		                        'post_title'        => preg_replace( '/\.[^.]+$/', '', basename( $uploadStatus['file'] ) ),
		                        'post_content'      => '',
		                        'post_status'       => 'publish'
		                    ),
		                    $uploadStatus['file']
		                );

		                // Generate our attachment metadata then update the file.
		                $attachmentData = wp_generate_attachment_metadata( $imageID, $uploadStatus['file'] );
		                wp_update_attachment_metadata( $imageID,  $attachmentData );


		                $existingImage = $prop_type_match_found['layout_image'] ;            // IF a file already exists in this option, grab it
		                if( ! empty( $existingImage ) && is_numeric( $existingImage ) ) {       // IF the option does exist, delete it.
		                    wp_delete_attachment( $existingImage );
		                }


					}


				}









				$pdf_file_name_field = 'cust-prop-type-layout-pdf_'.str_replace(' ', '_', $prop_value) ;


				if(!empty($_FILES[$pdf_file_name_field])) {

					$pdf_uploadStatus = wp_handle_upload( $_FILES[$pdf_file_name_field], array( 'test_form' => false ) );   // Let WordPress handle the upload

		            // Make sure that the file was uploaded correctly, without error
		            if( isset( $pdf_uploadStatus['file'] ) ) {
		                require_once(ABSPATH . "wp-admin" . '/includes/image.php');

		                // Let's add the image to our media library so we get access to metadata
		                $pdf_imageID = wp_insert_attachment( array(
		                        'post_mime_type'    => $pdf_uploadStatus['type'],
		                        'post_title'        => preg_replace( '/\.[^.]+$/', '', basename( $pdf_uploadStatus['file'] ) ),
		                        'post_content'      => '',
		                        'post_status'       => 'publish'
		                    ),
		                    $pdf_uploadStatus['file']
		                );

		                // Generate our attachment metadata then update the file.
		                $pdf_attachmentData = wp_generate_attachment_metadata( $pdf_imageID, $pdf_uploadStatus['file'] );
		                wp_update_attachment_metadata( $pdf_imageID,  $pdf_attachmentData );


		                $existingPdf = get_post_meta($post_id,'custom_property-siteplan',true) ;            // IF a file already exists in this option, grab it
		                if( ! empty( $existingPdf ) && is_numeric( $existingPdf ) ) {       // IF the option does exist, delete it.
		                    wp_delete_attachment( $existingPdf );
		                }


					}

				}


				if($prop_type_match_found==true){

					if($pdf_imageID!=false && $pdf_imageID!='' )
						$prop_type_match['layout_pdf']    = $pdf_imageID;
					if($imageID!=false && $imageID!='' )
						$prop_type_match['layout_image']  = $imageID;

					$property_types_data_value[] = $prop_type_match;

				}
				else{

					$property_types_data_value[] = array('type'=>$prop_value,'layout_image'=>$imageID,'layout_pdf'=>$pdf_imageID) ;

				}




			}
             update_post_meta($post_id, "residential-property-type", maybe_serialize($property_types_data_value));
            }


            update_post_meta($post_id, "property-no_of_bedrooms", $sel_property_no_of_bedrooms);

        }

		if($post->post_type=="commercial-property"){
            update_post_meta($post_id, "commercial-property-type", $sel_property_type);
        }

//exit();



		update_post_meta($post_id, "property-city", $sel_property_city);
		update_post_meta($post_id, "property-status", $sel_property_status);
		update_post_meta($post_id, "property-locality", $sel_property_locality);
		update_post_meta($post_id, "property-neighbourhood", $sel_property_neighbourhood );
        update_post_meta($post_id, "property-sellable_area", maybe_serialize($sel_property_sellable_area));
        update_post_meta($post_id, "property-price", $sel_property_price);


	}

}

add_action("save_post", "save_custom_meta_box", 10, 3);

function update_edit_form() {
    echo ' enctype="multipart/form-data"';
} // end update_edit_form
add_action('post_edit_form_tag', 'update_edit_form');






function delete_custom_file_field() {

	$property_id   = $_REQUEST['data']['property_id'];
	$custom_field_name = $_REQUEST['data']['custom_field_name'];
	$custom_file_id = $_REQUEST['data']['attachment_id'];

	$delete_success = false;

	  $custom_file_field_value = maybe_unserialize( get_post_meta($property_id,$custom_field_name,true) );


	  if($custom_file_field_value==$custom_file_id){

	  	$result_delete_attachment = wp_delete_attachment($custom_file_field_value);
	  	if($result_delete_attachment!=false){
	  		update_post_meta($property_id ,$custom_field_name,'');
	  		$delete_success = true ;
	  	}

	  }


    wp_send_json($delete_success);


}
add_action( 'wp_ajax_delete_custom_file_field', 'delete_custom_file_field' );









function delete_property_type_layout_image_pdf_file() {

	$property_id   		= $_REQUEST['data']['property_id'];
	$property_type 	= $_REQUEST['data']['property_type'];
	$custom_file_id 	= $_REQUEST['data']['attachment_id'];
	$file_type 			= $_REQUEST['data']['file_type'];

	$delete_success = false;

	  $custom_file_field_value = maybe_unserialize( get_post_meta($property_id,'residential-property-type',true) );


	  if($custom_file_field_value!=false and is_array($custom_file_field_value)){



	  	foreach ($custom_file_field_value as $key => $value) {

	  		$data = maybe_unserialize($value);


	  		if($data['type'] == $property_type){

	  			if($data[$file_type] == $custom_file_id){
	  				$result_delete_attachment = wp_delete_attachment($data[$file_type]);
				  	if($result_delete_attachment!=false){

				  		$delete_success = true ;
				  	}
	  			}

	  			if($delete_success==true){
	  				if($file_type=='layout_image'){
						$data['layout_image'] = '';
	  				}
	  				else if($file_type=='layout_pdf'){
						$data['layout_pdf'] = '';
	  				}

	  			}

	  		}
	  		$updated_data [] = $data;

	  	}



	  }

	  update_post_meta($property_id,'residential-property-type',true);


    wp_send_json($delete_success);


}
add_action( 'wp_ajax_delete_property_type_layout_image_pdf_file', 'delete_property_type_layout_image_pdf_file' );










function my_custom_submenu_page_callback() {





if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class My_Example_List_Table extends WP_List_Table {

   /* var $example_data = array(
            array( 'ID' => 1,'property_type' => '1 BHK', 'number_bedrooms' => '1',
                   'action' => 'Edit' ),
            array( 'ID' => 2, 'property_type' => '2 BHK','number_bedrooms' => '2',
                   'action' => 'Edit' ),
            array( 'ID' => 3, 'property_type' => '3 BHK', 'number_bedrooms' => '3',
                   'action' => 'Edit' ),
            array( 'ID' => 4, 'property_type' => '4 BHK', 'number_bedrooms' => '4',
                   'action' => 'Edit' ),
            array( 'ID' => 5, 'property_type'     => '5 BHK', 'number_bedrooms'    => '5',
                   'action' => 'Edit' ),
            array(' ID' => 6, 'property_type' => '6 BHK', 'number_bedrooms' => '6',
                  'action' => 'Edit' )
        ); */
    function __construct(){
    global $status, $page;

        parent::__construct( array(
            'singular'  => __( 'Property Type', 'mylisttable' ),     //singular name of the listed records
            'plural'    => __( 'Property Types', 'mylisttable' ),   //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
    ) );
    }



  function column_default( $item, $column_name ) {
    switch( $column_name ) {
        case 'property_type':
						$actions = array(
						            'edit'      => sprintf('<a href="javascript:void(0)" class="edit_property_type"  type_id ="'.$item['ID'].'"    type_name="'.$item['property_type'].'"  bedrooms="'.$item['number_bedrooms'].'" >Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
						            'delete'    => sprintf('<a href="javascript:void(0)" class="delete_property_type" type_id ="'.$item['ID'].'" >Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
						        );

						  return sprintf('%1$s %2$s', "<span class='spn_property_type'>".$item['property_type']."</span>", $this->row_actions($actions) );



        case 'number_bedrooms':
        //case 'action':
            return $item[ $column_name ];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

function get_columns(){
        $columns = array(
            'property_type' => __( 'Property Type', 'mylisttable' ),
            'number_bedrooms'    => __( 'No Of Bedrooms', 'mylisttable' )
            //'action'      => __( 'Action', 'mylisttable' )
        );
         return $columns;
    }
function prepare_items() {
  $columns  = $this->get_columns();
  $hidden   = array();
  $sortable = array();
  $this->_column_headers = array( $columns, $hidden, $sortable );
  $this->items = $this->get_data();//$this->example_data;
}

function get_data(){



	global $wpdb;

	$current_property_types = maybe_unserialize(get_option('residential-property-type'));

	if($current_property_types==false){
		return array();
	}
	else{


		if(!isset($current_property_types['max_property_types'])    ||    $current_property_types['max_property_types']<=0 ){
			return array();
		}
		else if($current_property_types['max_property_types']>0){


			return maybe_unserialize($current_property_types['property_types']);
		}


	}



}



function get_sortable_columns() {
  $sortable_columns = array(
    'property_type'  => array('property_type',true),
    'number_bedrooms' => array('number_bedrooms',false),
    // 'action'   => array('actoin',false)
  );
  return $sortable_columns;
}

} //class


/*
function get_property_types(){
	global $wpdb;

	$property_types = maybe_unserialize(get_option('residential-property-type'));

} */


  echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>Residential Properties Settings</h2>';
  echo '</div>';



  $myListTable = new My_Example_List_Table();
  echo '<div class="wrap"><h3>Property Types </h3>';
  $myListTable->prepare_items();
  echo '<div col-container>

  <div class="property_type_message ">

  </div>

  			<div id="col-right">
				<div class="col-wrap">';
  $myListTable->display();

  echo '		</div>
  			</div>
  			<div id="col-left">
				<div class="col-wrap">




					<div class="form-wrap">
						<h3 class="add_edit_type_formtitle"><span class="title">Add New Property Type</span>
							<a href="javascript:void(0)" class="add-new-h2 add_new_type_form">Add New</a>
						</h3>
						<form id="frm_property_type" method="post" action="" class="validate">
							<!-- <input type="hidden" name="action" value="">
							<input type="hidden" name="screen" value="edit-property_amenity">
							<input type="hidden" name="custom_field_name" value="property_amenity">
							<input type="hidden" name="post_type" value="residential-property">
							<input type="hidden" id="_wpnonce_add-tag" name="_wpnonce_add-tag" value="781a607a1b">
							<input type="hidden" name="_wp_http_referer" value="/marvel/wp-admin/edit-tags.php?taxonomy=property_amenity&amp;post_type=residential-property"> -->

							<input type="hidden" name="edit_id" id="edit_id"  value="" />
							<div class="form-field form-required term-name-wrap">
								<label for="tag-name">Type</label>
								<input name="new-property-type" id="new-property-type" type="text" value="" size="40" aria-required="true">
								<p><!-- The name is how it appears on your site. --></p>
							</div>
							<div class="form-field term-slug-wrap">
								<label for="tag-slug">Number Of Bedrooms</label>
								<input name="new-property-bedrooms" id="new-property-bedrooms" class="allownumericwithoutdecimal"  type="text" value="" size="40" >
								<p><!-- The “slug” is the URL-friendly version of the name.
								It is usually all lowercase and contains only letters, numbers, and hyphens. --></p>
							</div>



							<p class="submit">
								<input type="button" name="add_new_property_type" id="add_new_property_type"
								class="button button-primary save_property_type" value="Save">
								<input type="button" name="cancel_edit_property_type" id="cancel_edit_property_type"
								class="button cancel_edit_property_type" value="Cancel" style="display:none">
							</p><br>

						</form>
				</div>







				</div>
			</div>

  		</div>  ';
  echo '<input type="hidden" name="custom_field_name" id="custom_field_name" value="residential-property-type" /> ';
  echo '</div>';

}






function register_my_custom_submenu_page() {
//  add_submenu_page( 'tools.php', 'My Custom Submenu Page', 'My Custom Submenu Page', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' );
  add_submenu_page( 'edit.php?post_type=residential-property', 'Residential Properties Settings', 'Residential Properties Settings', 'manage_options', 'residential-properties-settings', 'my_custom_submenu_page_callback' );
}
add_action('admin_menu', 'register_my_custom_submenu_page');



function save_property_type(){

	$num_bedrooms 		= $_REQUEST['data']['num_bedrooms'];
	$property_type 		= $_REQUEST['data']['property_type'];
	$property_edit_id 	= $_REQUEST['data']['edit_id'];

	$current_property_types = maybe_unserialize(get_option('residential-property-type'));

	$new_property_type['number_bedrooms'] 	= $num_bedrooms;
	$new_property_type['property_type'] 	= $property_type;


	if($property_edit_id!=''){
		$new_property_type['ID'] = $property_edit_id;

		foreach ($current_property_types['property_types'] as $key => $value) {

			if($property_edit_id == $value['ID']){
					$updated_new_property_types[$key] = $new_property_type;
			}
			else{
					$updated_new_property_types[$key] = $value;
			}

		}

		$updated_new_max_property_type = $current_property_types['max_property_types'];

	}
	else{
			if(!isset($current_property_types['max_property_types'])){

				$new_property_type['ID'] = 1;
				$current_property_types ['property_types'] = array();
			}
			else if(count($current_property_types['max_property_types'])<=0 || $current_property_types==false ){

				$new_property_type['ID'] = 1;
				$current_property_types ['property_types'] = array();

			}
			else{

				/*$current_max_property_id = 0;
				foreach ($current_property_types as $key => $value) {
					if($value['ID']>$current_max_property_id){
					 	$current_max_property_id = $value['ID'];
					}
				}
				$new_property_type['ID']  = $current_max_property_id + 1 ;	*/

				$new_property_type['ID'] = $current_property_types['max_property_types'] + 1;
			}

			if(!is_array($current_property_types['property_types'])){
				$current_property_types['property_types'] = array();
			}

			$updated_new_property_types =    $current_property_types['property_types'];
			$updated_new_property_types[] = $new_property_type ;
			$updated_new_max_property_type = $new_property_type['ID'];
	}



	$result = update_option('residential-property-type',maybe_serialize(array('max_property_types' => $updated_new_max_property_type,
																			  'property_types'     => $updated_new_property_types
																		)));

	if($result==false){
		$current_property_types = maybe_unserialize(get_option('residential-property-type'));
	}

	wp_send_json(array('success' => $result, 'ID'=>$new_property_type['ID'], 'data'=>$updated_new_property_types));

}
add_action( 'wp_ajax_save_property_type', 'save_property_type' );




function delete_property_type(){

	$property_type_id = $_REQUEST['data']['type_id'];
	$current_property_types = maybe_unserialize(get_option('residential-property-type'));

	$found_del_type = false ;

	foreach ($current_property_types['property_types'] as $key => $value) {
		 if($value['ID']!=$property_type_id ){

		 	$updated_property_types [] = $value ;
		 }
		 else if($value['ID']==$property_type_id ){
			 $found_del_type = true ;
		 }

	}

	$updated_new_property_types =  array('max_property_types' => $current_property_types['max_property_types'],
									 'property_types'	  => $updated_property_types);

	update_option('residential-property-type',maybe_serialize($updated_new_property_types));

	wp_send_json(array('success'=>true,'types'=>$updated_property_types ));
}
add_action( 'wp_ajax_delete_property_type', 'delete_property_type' );



function get_property_type_option(){

	global $wpdb;

	$current_property_types = maybe_unserialize(get_option('residential-property-type'));

	if(isset($current_property_types['property_types'])){
		wp_send_json(maybe_unserialize($current_property_types['property_types']));
	}
	else{
		wp_send_json(array() );
	}



}
add_action( 'wp_ajax_get_property_type_option', 'get_property_type_option' );

















function delete_property_type_row() {

	$property_id   		= $_REQUEST['data']['property_id'];
	$property_type 		= $_REQUEST['data']['property_type'];


	$delete_success = false;

	  $custom_file_field_value = maybe_unserialize( get_post_meta($property_id,'residential-property-type',true) );


	  if($custom_file_field_value!=false and is_array($custom_file_field_value)){



	  	foreach ($custom_file_field_value as $key => $value) {

	  		$data = maybe_unserialize($value);


	  		if($data['type'] == $property_type){

	  				if($data['layout_image']!='')
	  					$result_delete_attachment = wp_delete_attachment($data['layout_image']);
	  				if($data['layout_pdf']!='')
				  		$result_delete_attachment = wp_delete_attachment($data['layout_pdf']);

	  		}

	  	}
	  	$updated_data [] = $data;

	}


    wp_send_json($delete_success);


}
add_action( 'wp_ajax_delete_property_type_row', 'delete_property_type_row' );