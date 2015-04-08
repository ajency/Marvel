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





?>