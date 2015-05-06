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
        'rewrite'            => array( 'slug' => 'Residential-Property' ),
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
            'name'              => _x( 'Amenity', 'taxonomy general name' ),
            'singular_name'     => _x( 'Amenity', 'taxonomy singular name' ),
            'search_items'      => __( 'Search Amenity'  ),
            'all_items'         => __( 'All Amenities'  ),
            'parent_item'       => __( 'Parent Amenity'  ),
            'parent_item_colon' => __( 'Parent Amenity : '  ),
            'edit_item'         => __( 'Edit Amenity' ),
            'update_item'       => __( 'Update Amenity' ),
            'add_new_item'      => __( 'Add New Amenity' ),
            'new_item_name'     => __( 'New Amenity' ),
            'menu_name'         => __( 'Amenity' ),
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

	    	$custom_fields[] = array('field'=>'property-type',
	    							  'metabox_title'=> 'Property Type',
	    							  'multiple_values' => false,
	    							   'element_type'	=> 'select'
	    							);
	    	$custom_fields[] = array('field'=>'property-status',
	    							  'metabox_title'=>'Status',
	    							  'multiple_values' => false,
	    							  'element_type'	=> 'select'
	    							);
	    	$custom_fields[] = array('field'=>'property-locality',
	    							  'metabox_title'=>'Locality',
	    							  'multiple_values' => false,
	    							  'element_type'	=> 'select'
	    							);
	    	$custom_fields[] = array('field'=>'property-city',
	    							  'metabox_title'=>'City',
	    							  'multiple_values' => false,
	    							  'element_type'	=> 'select'
	    							);
	    	$custom_fields[] = array('field'=>'property-neighbourhood',
	    							  'metabox_title'=>'Neighbourhood',
	    							  'multiple_values' => true,
	    							  'element_type'	=> 'text'
	     							);

            $custom_fields[] = array('field'            => 'property-address-details',
                                    'metabox_title'     => 'Property Address',
                                    'multiple_values'   => true,
                                    'element_type'	    => 'custom_address_details_text'
                                    );

        if($screen=="residential-property") {

	    		$custom_fields[] = array ( 'field'=>'property-no_of_bedrooms',
	    							  	   'metabox_title'=>'No Of Bedrooms',
	    							  	   'multiple_values' => false,
	    							  	   'element_type'	=> 'select'
	    								 );

	    		 $custom_fields[] = array ( 'field'=>'property-sellable_area',
	    							  	   'metabox_title'=>'Sellable Area',
	    							  	   'multiple_values' => false,
	    							  	   'element_type'	=> 'text'
	    								 );
	    	}
	    	 
	    	foreach($custom_fields as $custom_field){

					add_meta_box (
					            	$custom_field['field'].'_box_id',             // Unique ID
					            	$custom_field['metabox_title'],               // Box title
					            	'myplugin_inner_custom_box',   // Content callback
					            	$screen ,                       // post type
					            	'normal',
					            	'default',
					            	array( 'custom_field_type'=>$custom_field['field'], 
					            	   		'multiple_values'=>$custom_field['multiple_values'],
                                            'element_type'=>$custom_field['element_type'],
                                            )
					        );
	    	}
    	 
        
    }
}

add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );


/* Prints the box content */
function myplugin_inner_custom_box( $post , $metabox) {

    $current_post_type = $post->post_type;

    $custom_field_type = $metabox['args']['custom_field_type'];

 	$multiple_values   =  $metabox['args']['multiple_values'];

    $element_type = $metabox['args']['element_type'];

    wp_nonce_field(basename(__FILE__), "meta-box-nonce"); 
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
								

								generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_types, $current_property_meta_value);
							    
    						    break;
    	case 'property-city'			:
    							$property_city = maybe_unserialize(get_option('property-city'));
    							$current_property_meta_value =    get_post_meta($post->ID, "property-city", true);
							        
								generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_city, $current_property_meta_value);
							    
    						    break;	
    	case 'property-status'			:
    							$property_status = maybe_unserialize(get_option('property-status'));
    							$current_property_meta_value =    get_post_meta($post->ID, "property-status", true);
							        
								generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_status, $current_property_meta_value);
							    
    						    break;	
    	case 'property-locality'			:
    							$property_locality = maybe_unserialize(get_option('property-locality'));
    							$current_property_meta_value =    get_post_meta($post->ID, "property-locality", true);
							        
								generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_locality, $current_property_meta_value);
							    
    						    break;
    	case 'property-neighbourhood'			:


    							$property_neighbourhood = maybe_unserialize(get_option('property-neighbourhood'));
							    $current_property_meta_value =    get_post_meta($post->ID, "property-neighbourhood", true) ;  
								
								generate_custom_field_element($post, 'text', $multiple_values, 'custom_'.$custom_field_type,  $property_neighbourhood, $current_property_meta_value);
							    

							    $property_field_options = maybe_unserialize(get_option($metabox['field']));

    						    break;

        case 'property-no_of_bedrooms'			:
                                $property_no_of_bedrooms = maybe_unserialize(get_option('property-no_of_bedrooms'));
                                $current_property_meta_value =    get_post_meta($post->ID, "property-no_of_bedrooms", true);

                                generate_custom_field_element($post, 'select', $multiple_values, 'custom_'.$custom_field_type,  $property_no_of_bedrooms, $current_property_meta_value);

                                break;

        case 'property-sellable_area':
                                $property_sellable_area = array();
                                $current_property_meta_value =    get_post_meta($post->ID, "property-sellable_area", true);

                                generate_custom_field_element($post, 'text', $multiple_values, 'custom_'.$custom_field_type,  $property_sellable_area, $current_property_meta_value);

                                break;

        case 'property-address-details':

            $address_field_data = get_custom_address_fields_by_id($post->ID);
									get_custom_address_elements_html($address_field_data);

            /* $property_address_details = array();
            $current_property_meta_value =    get_post_meta($post->ID, "property-sellable_area", true);

            generate_custom_field_element($post, 'text', $multiple_values, 'custom_'.$custom_field_type,  $property_sellable_area, $current_property_meta_value);
*/
            break;




    }


    if( ($multiple_values==true && $element_type=='text') || (($element_type!='text') && ($element_type!='custom_address_details_text') )) {


    ?>
    
        <a href="javascript:void(0)" field-type="<?php echo $custom_field_type; ?>"  class="add_custom_postmeta_options">Add New Value</a> &nbsp;
        <a href="javascript:void(0)" field-type="<?php echo $custom_field_type; ?>"  class="edit_custom_postmeta_options">Edit</a>
        <div class="edit_options_area"></div>
        <!-- <input type="button" field-type="property-type" name="add_type" class="add_custom_postmeta_options" value="Add Types" /> -->
    <?php
    }
    ?>
    </div>
<?php
}



function get_custom_address_fields_by_id($id){

    global $wpdb;
    $qry_get_address = "SELECT * FROM {$wpdb->prefix}addresses WHERE addressable_id = ".$id;

    $address_fields_data = $wpdb->get_results($qry_get_address,ARRAY_A);
    return $address_fields_data;

}





function get_custom_address_elements_html($address_field_data){

    ?>
    <div style="display:block; width:100%; margin-bottom: 20px; position:relative">
        <input id="address" name="address" type="textbox" value="<?php if(isset($address_field_data[0]['address'])){ echo $address_field_data[0]['address']; } else { echo 'pune, India' ; } ?>">
        <input type="button" value="Geocode" onclick="codeAddress()"><br/>

       <br/>City :  <input id="custom-address_city" name="custom-address_city" type="textbox" value="<?php if(isset($address_field_data[0]['city'])){ echo $address_field_data[0]['city']; } ?>">
       <br/> Region : <input id="custom-address_region" name="custom-address_region" type="textbox" value="<?php if(isset($address_field_data[0]['region'])){ echo $address_field_data[0]['region']; } ?>">
       <br/> Country : <input id="custom-address_country" name="custom-address_country" type="textbox" value="<?php if(isset($address_field_data[0]['country'])){ echo $address_field_data[0]['country']; } ?>">
       <br/> Postcode :  <input id="custom-address_postcode" name="custom-address_postcode" type="textbox" value="<?php if(isset($address_field_data[0]['postcode'])){ echo $address_field_data[0]['postcode']; } ?>">
       <br/> Lat : <input id="custom-address_lat" name="custom-address_lat" type="textbox" value="<?php if(isset($address_field_data[0]['lat'])){ echo $address_field_data[0]['lat']; } ?>">
       &nbsp; Long : <input id="custom-address_lng" name="custom-address_lng" type="textbox" value="<?php if(isset($address_field_data[0]['lng'])){ echo $address_field_data[0]['lng']; } ?>">
    </div>
    <div id="map_canvas" style="height:400px;: width:600px; top:30px; position:relative; display:block; margin-bottom: 10px;"></div>
    <?php

}

function generate_custom_field_element($post, $element_type, $multiple_values, $element_id,  $element_values, $current_property_meta_value){



	switch($element_type){
		case 'select' : ?>
						<select name="<?php echo $element_id; ?>" id="<?php echo $element_id; ?>" class="postbox custom_input_field"  <?php if($multiple_values==true) { echo ' multiple="multiple" ';  } ?> >
							<option value="">Select</option>
							<?php if($element_values!=false) {
						
										foreach($element_values as $type){ ?>
											<option value="<?php echo $type; ?>" <?php if($current_property_meta_value==$type) echo " selected ";?>><?php echo ucfirst($type); ?></option>
						
							<?php 		}
						
									}
							?>
						</select>
						<?php
						break;
		 
		case 'text' :
  
$current_property_meta_value_arr = maybe_unserialize($current_property_meta_value);
//var_dump($current_property_meta_value_arr);

						if($multiple_values==true) {

							if($element_values!=false){
								foreach($element_values as $type){ 
									
									 $new_current_val = '';
									 if(is_array($current_property_meta_value_arr)){


										 foreach($current_property_meta_value_arr as $cur_field_value_k=>$cur_field_value_v){
											
											//echo "<br/>type : ".$type." cur_field_value_k:".$cur_field_value_k;
											if($type==$cur_field_value_k){
												$new_current_val = $cur_field_value_v;

											}
										}
									 }
//var_dump(array_search($type, $current_property_meta_value_arr)); 
									?>
								 
									<span attr-field-val ="<?php echo $type; ?>" >  <br/> &nbsp; <?php echo $type; ?>  <input type="text" value="<?php echo $new_current_val ; ?>" attr-name="<?php echo $element_id; ?>"  attr-value="<?php echo $type; ?>"   name="<?php echo $element_id; ?>[<?php echo $type; ?>]"   class="postbox custom_input_field"  /> </span>
						<?php	}
							
							}
                            else {
                                echo "No options values added yet";
                            }



                        }
                        else{

                            ?>
                            <span attr-field-val ="<?php echo $element_id; ?>" >  <br/><input type="text" value="<?php echo $current_property_meta_value ; ?>" attr-name="<?php echo $element_id; ?>"  attr-value="<?php echo $element_id; ?>"   name="<?php echo $element_id; ?>"   class="postbox custom_input_field"  /> </span>
                        <?php


                        }


						 break;					
			 				
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
    if( 'post.php' != $hook && 'post-new.php' != $hook ) return;

    wp_enqueue_script( 'undescore','https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js',
        array('jquery') );
    wp_enqueue_script( 'geolocation','https://maps.googleapis.com/maps/api/js?sensor=false' );
    

    wp_enqueue_script('mygeolocation_js',get_template_directory_uri().'/js/mygeolocation.js', array('jquery')  );

    wp_localize_script( 'ajax-script', 'ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ));

    wp_enqueue_script( 'custom-script',site_url().'/wp-content/themes/samba/js/myjquery.js?ver=4.1.1',
        array('jquery'));
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

    $property_types_data = get_properties_type_option_by_post_type(array( "field_name"=>$custom_field_option_name, 'post_type'=>$post_type   )) ;

    $property_types                = $property_types_data['property_types'];
    $real_custom_field_option_name = $property_types_data['real_property_type_option_name'];

    $add_new_value = false;

    if($property_types==false)
        $add_new_value = true;
    else{
        if(array_search($custom_field_option_val,$property_types)===false){
            $add_new_value = true;
        }
    }

    $return_result = false ;

    if($add_new_value == true){
        $property_types[] = $custom_field_option_val;
        $return_result = update_option($real_custom_field_option_name,maybe_serialize($property_types));
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
    else{
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
                               'field_name' => $custom_field_option_name
                               );

    $property_types_data = get_properties_type_option_by_post_type($custom_field_data);

    wp_send_json($property_types_data['property_types']);


}
add_action( 'wp_ajax_get_custom_field_options', 'get_custom_field_options' );




function delete_custom_field_option() {

     

    $custom_field_option_name   = $_REQUEST['data']['field_name'];
    $custom_field_option_value  = $_REQUEST['data']['field_value'];
    $post_type                  = $_REQUEST['data']['post_type'];

    $custom_field_data = array('post_type'  => $post_type,
                               'field_name' => $custom_field_option_name
                               );


    $custom_fields = get_properties_type_option_by_post_type($custom_field_data);

    

    $existing_fields_values =   $custom_fields['property_types'];
    $real_property_type_option_name =  $custom_fields['real_property_type_option_name'];

    $new_field_data = array();

    $delete_success = false;

    foreach($existing_fields_values as $f_v){
        if($custom_field_option_value!=$f_v){
            $new_field_data[] = $f_v ;
            $delete_success = true;
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
	 
		$sel_property_type = $_REQUEST["custom_property-type"];
		$sel_property_city = $_REQUEST["custom_property-city"];
		$sel_property_status = $_REQUEST["custom_property-status"];
		$sel_property_locality = $_REQUEST["custom_property-locality"];
		$sel_property_neighbourhood = maybe_serialize($_REQUEST["custom_property-neighbourhood"]);
        $sel_property_no_of_bedrooms = $_REQUEST['custom_property-no_of_bedrooms'];
        $sel_property_sellable_area = $_REQUEST['custom_property-sellable_area'];



        $sel_property_address_city = $_REQUEST['custom-address_city'];
        $sel_property_address_region = $_REQUEST['custom-address_region'];
        $sel_property_address_country = $_REQUEST['custom-address_country'];
        $sel_property_address_postcode = $_REQUEST['custom-address_postcode'];
        $sel_property_address_lat = $_REQUEST['custom-address_lat'];
        $sel_property_address_lng = $_REQUEST['custom-address_lng'];
        $sel_property_address = $_REQUEST['address'];


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


		if($post->post_type=="residential-property"){
            update_post_meta($post_id, "residential-property-type", $sel_property_type);
            update_post_meta($post_id, "property-no_of_bedrooms", $sel_property_no_of_bedrooms);
        }

		if($post->post_type=="commercial-property"){
            update_post_meta($post_id, "commercial-property-type", $sel_property_type);
        }





		update_post_meta($post_id, "property-city", $sel_property_city);
		update_post_meta($post_id, "property-status", $sel_property_status);
		update_post_meta($post_id, "property-locality", $sel_property_locality);
		update_post_meta($post_id, "property-neighbourhood", $sel_property_neighbourhood );
        update_post_meta($post_id, "property-sellable_area", $sel_property_sellable_area);

	}

/*
 
    $meta_box_text_value = "";
    $meta_box_dropdown_value = "";
    $meta_box_checkbox_value = "";
 
    if(isset($_POST["meta-box-text"]))
    {
        $meta_box_text_value = $_POST["meta-box-text"];
    }   
    update_post_meta($post_id, "meta-box-text", $meta_box_text_value);
 
    if(isset($_POST["meta-box-dropdown"]))
    {
        $meta_box_dropdown_value = $_POST["meta-box-dropdown"];
    }   
    update_post_meta($post_id, "meta-box-dropdown", $meta_box_dropdown_value);
 
    if(isset($_POST["meta-box-checkbox"]))
    {
        $meta_box_checkbox_value = $_POST["meta-box-checkbox"];
    }   
    update_post_meta($post_id, "meta-box-checkbox", $meta_box_checkbox_value); */
}
 
add_action("save_post", "save_custom_meta_box", 10, 3);








function get_search_options(){

	$property_cities = maybe_unserialize(get_option('property-city',true));
	$property_status = maybe_unserialize(get_option('property-status',true));
	$property_locality = maybe_unserialize(get_option('property-locality',true));
	$property_neighbourhood = maybe_unserialize(get_option('property-neighbourhood',true));
    $property_bedrooms = maybe_unserialize(get_option('property-no_of_bedrooms',true));

	$search_option_data = array( 'cities'		 => $property_cities,
								 'status'		 => $property_status,
								 'locality'		 => $property_locality,
								 'neighbourhood' => $property_neighbourhood,
                                 'no_of_bedrooms'=> $property_bedrooms
								);

	wp_send_json( $search_option_data);


}
add_action( 'wp_ajax_get_search_options', 'get_search_options' );
add_action( 'wp_ajax_nopriv_get_search_options', 'get_search_options' );


function get_res_property_meta_values($property_id){

    $property_cities = get_post_meta($property_id, 'property-city',true);
    $property_status = get_post_meta($property_id, 'property-status',true);
    $property_locality = get_post_meta($property_id, 'property-locality',true);
    $property_neighbourhood = maybe_unserialize(get_post_meta($property_id, 'property-neighbourhood',true));

    $residential_property_meta_data = array('property_city'          => $property_cities,
                                             'property_status'       => $property_status,
                                             'property_locaity'      => $property_locality,
                                             'poperty_neighbourhood' => $property_neighbourhood
                                            );

    return $residential_property_meta_data;

}





function get_residential_properties_list_ajx() {

    global $wpdb;
    $sel_properties = array();
    $residential_properties = get_posts( array(
        'post_type' => 'residential-property',
        'post_status' => 'publish',
        'posts_per_page' => -1
    ) );

    foreach (  $residential_properties as $res_property ) {

        $property_meta_value =  get_res_property_meta_values($res_property->ID);
        $sel_properties[] =  array_merge($res_property,$property_meta_value) ;

    }



   /*  foreach ( $rooms_list as $room ) {

        $room = new RoomModel( $room );

        $room_data [ ] = $room->get_all_roomdata();
    }*/
    wp_send_json( array(
        'code' => 'OK',
        'data' => $sel_properties
    ) );
}

add_action( 'wp_ajax_get_residential_properties_list_ajx', 'get_residential_properties_list_ajx' );
add_action( 'wp_ajax_nopriv_get_residential_properties_list_ajx', 'get_residential_properties_list_ajx' );





/**
 * [get_parent_template_directory_uri description]
 * @return [type]
 */
function get_parent_template_directory_uri()
{
    return site_url('wp-content/themes/samba');
}





function marvel_scripts_styles(){

   /* if(is_page_template()== 'project_list_new.php'){

        wp_enqueue_script('backbone', get_template_directory_uri() . '/dev/js/lib/backbone.js', array('jquery'), false, true);
        wp_enqueue_script('backbonebabysitter', get_template_directory_uri() . '/dev/js/lib/backbone.babysitter.js', array('jquery'), false, true);
        wp_enqueue_script('backbonewreqr', get_template_directory_uri() . '/dev/js/lib/backbone.wreqr.js', array('jquery'), false, true);
        wp_enqueue_script('underscore', get_template_directory_uri() . '/dev/js/lib/underscore.min', array('jquery'), false, true);
        wp_enqueue_script('marionette', get_template_directory_uri() . '/dev/js/lib/backbone.marionette.js', array('backbone'), false, true);
        wp_enqueue_script('project-list-app', get_template_directory_uri() . '/dev/js/projectlist_app.js', array('marionette'), false, true);




        wp_enqueue_script('residential_property_list_router', get_template_directory_uri() . '/dev/js/routers/PropertyListRouter.js', array('project-list-app'), false, true);
        wp_enqueue_script('residential_property_model', get_template_directory_uri() . '/dev/js/models/residential-property.js', array('project-list-app'), false, true);
        wp_enqueue_script('residential_property_collection', get_template_directory_uri() . '/dev/js/collections/residential-properties.js', array('project-list-app'), false, true);
        wp_enqueue_script('projectlistmainview', get_template_directory_uri() . '/dev/js/views/ProjectListMainView.js',array('marionette'),false,true);
        wp_enqueue_script('search_option_view', get_template_directory_uri() . '/dev/js/views/projectlistSearch_optionView.js',array('marionette'),false,true);




    }*/

}
add_action('wp_enqueue_scripts', 'marvel_scripts_styles', 100);