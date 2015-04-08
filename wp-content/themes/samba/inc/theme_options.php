<?php
	//THESE SCRIPTS CONTROL ALL THE THEME OPTIONS PANEL
	//INITIALIZE OUR OPTIONS
	add_action( 'admin_init', 'theme_options_init' );
	add_action( 'admin_menu', 'theme_options_add_page' );
	function theme_options_init()
	{
		register_setting( 'prk_options','samba_theme_options', 'theme_options_validate' );
	}
	//LOAD THE MENU PAGE
	function theme_options_add_page() 
	{
		add_menu_page( __( PRK_THEME_NAME.' Options', 'samba_lang' ), __( PRK_THEME_NAME.' Options', 'samba_lang' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
		//add_theme_page
	}
	
	//CREATE ARRAYS WITH THE OPTIONS
	
	//HOMEPAGE SKIN OPTIONS
	$skin_options = array(
		'no_display' => array(
			'value' => '0',
			'label' => __( '---', 'samba_lang' )
		),
		'clear' => array(
			'value' => 'clear',
			'label' => __( 'Clear', 'samba_lang' )
		),
		'dark' => array(
			'value' => 'dark',
			'label' => __( 'Dark', 'samba_lang' )
		),
		'gold' => array(
			'value' => 'gold',
			'label' => __( 'Gold', 'samba_lang' )
		)
	);

	//HEADER SHADOW OPTIONS
	$shadow_options = array(
		'no_display' => array(
			'value' => 'never',
			'label' => __( 'No', 'samba_lang' )
		),
		'always' => array(
			'value' => 'always',
			'label' => __( 'Yes', 'samba_lang' )
		)
	);
	
	//YES/NO OPTION
	$yesno_options = array(
		'yes' => array(
			'value' => 'yes',
			'label' => __( 'Yes', 'samba_lang' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'samba_lang' )
		)
	);

	//YES/NO OPTION WOOCOMMERCE
	$yesno_options_woo = array(
		'shop' => array(
			'value' => 'shop',
			'label' => __( 'Yes - add to the Shop Button', 'samba_lang' )
		),
		'cart' => array(
			'value' => 'cart',
			'label' => __( 'Yes - add to the Cart Button', 'samba_lang' )
		),
		'no' => array(
			'value' => 'no',
			'label' => __( 'No', 'samba_lang' )
		)
	);

	//CART OPTION
	$cart_options = array(
		'items' => array(
			'value' => 'items',
			'label' => __( 'Items only', 'samba_lang' )
		),
		'price' => array(
			'value' => 'price',
			'label' => __( 'Price only', 'samba_lang' )
		),
		'both' => array(
			'value' => 'both',
			'label' => __( 'Items and Price', 'samba_lang' )
		)
	);
	//LAYOUT OPTION
	$layout_options = array(
		'items' => array(
			'value' => 'full',
			'label' => __( 'Full Width', 'samba_lang' )
		),
		'price' => array(
			'value' => 'boxed',
			'label' => __( 'Boxed', 'samba_lang' )
		)
	);	
	//ARCHIVES OPTIONS
	$archives_options = array(
		'classic' => array(
			'value' => 'classic',
			'label' => __( 'Classic', 'samba_lang' )
		),
		'masonry' => array(
			'value' => 'masonry',
			'label' => __( 'Masonry', 'samba_lang' )
		)
	);
	$portfolios_options = array(
		'multisize' => array(
			'value' => 'multisize',
			'label' => __( 'Grid', 'samba_lang' )
		),
		'titled' => array(
			'value' => 'titled',
			'label' => __( 'With Titles', 'samba_lang' )
		),
		'masonry' => array(
			'value' => 'masonry',
			'label' => __( 'Masonry', 'samba_lang' )
		)
		
	);
	$menu_options = array(
		'centered' => array(
			'value' => 'centered',
			'label' => __( 'Centered logo', 'samba_lang' )
		),
		'left' => array(
			'value' => 'left',
			'label' => __( 'Logo on left', 'samba_lang' )
		),
		'left_fixed' => array(
			'value' => 'left_fixed',
			'label' => __( 'Logo on left and sticky menu', 'samba_lang' )
		)
	);
	
	//PATTERN BACKGROUNDS
	$pattern_options = array(
		'0' => array(
			'value' =>	'',
			'label' => __( 'None', 'samba_lang' )
		),
		'1' => array(
			'value' =>	'bedge_grunge.png',
			'label' => __( 'Bedge Grunge', 'samba_lang' )
		),
		'2' => array(
			'value' =>	'strange_bullseyes.png',
			'label' => __( 'Bullseyes', 'samba_lang' )
		),
		'63' => array(
			'value' =>	'cream_pixels.png',
			'label' => __( 'Cream Pixels', 'samba_lang' )
		),
		'3' => array(
			'value' =>	'concrete_wall_2.png',
			'label' => __( 'Concrete', 'samba_lang' )
		),
		'4' => array(
			'value' =>	'cross_scratches.png',
			'label' => __( 'Cross Scratches', 'samba_lang' )
		),
		'5' => array(
			'value' =>	'diagonal-noise.png',
			'label' => __( 'Diagonal Noise', 'samba_lang' )
		),
		'6' => array(
			'value' =>	'grey.jpg',
			'label' => __( 'Dotted Grey', 'samba_lang' )
		),
		'7' => array(
			'value' =>	'first_aid_kit.png',
			'label' => __( 'Grey Squares', 'samba_lang' )
		),
		'8' => array(
			'value' =>	'grid_noise.png',
			'label' => __( 'Grid Noise', 'samba_lang' )
		),
		'9' => array(
			'value' =>	'light_honeycomb.png',
			'label' => __( 'Light Honeycomb', 'samba_lang' )
		),
		'10' => array(
			'value' =>	'lghtmesh.png',
			'label' => __( 'Light Mesh', 'samba_lang' )
		),
		'11' => array(
			'value' =>	'noise_lines.png',
			'label' => __( 'Noise Lines', 'samba_lang' )
		),
		'12' => array(
			'value' =>	'lightpaperfibers.png',
			'label' => __( 'Paper Fibers', 'samba_lang' )
		),
		'13' => array(
			'value' =>	'rough_diagonal.png',
			'label' => __( 'Rough Diagonal', 'samba_lang' )
		),
		'14' => array(
			'value' =>	'grid.png',
			'label' => __( 'Seamless Grid', 'samba_lang' )
		),
		'15' => array(
			'value' =>	'chruch.png',
			'label' => __( 'Seamless White', 'samba_lang' )
		),
		'16' => array(
			'value' =>	'whitey.png',
			'label' => __( 'Simple White', 'samba_lang' )
		),
		'17' => array(
			'value' =>	'farmer.png',
			'label' => __( 'Squared Seamless', 'samba_lang' )
		),
		'18' => array(
			'value' =>	'subtle_dots.png',
			'label' => __( 'Subtle Dots', 'samba_lang' )
		),
		'19' => array(
			'value' =>	'stacked_circles.png',
			'label' => __( 'Stacked Circles', 'samba_lang' )
		),
		'20' => array(
			'value' =>	'texturetastic_gray.png',
			'label' => __( 'Textured Grey', 'samba_lang' )
		),
		'21' => array(
			'value' =>	'tiny_grid.png',
			'label' => __( 'Tiny Grid', 'samba_lang' )
		),
		'22' => array(
			'value' =>	'vintage_speckles.png',
			'label' => __( 'Vintage', 'samba_lang' )
		),
		'23' => array(
			'value' =>	'white_leather.png',
			'label' => __( 'White Leather', 'samba_lang' )
		),
		'24' => array(
			'value' =>	'white_texture.png',
			'label' => __( 'White Texture', 'samba_lang' )
		),
		'25' => array(
			'value' =>	'black_leather.png',
			'label' => __( 'Black Leather', 'samba_lang' )
		),
		'26' => array(
			'value' =>	'black-linen.png',
			'label' => __( 'Black Linen', 'samba_lang' )
		),
		'27' => array(
			'value' =>	'black_paper.png',
			'label' => __( 'Black Paper', 'samba_lang' )
		),
		'28' => array(
			'value' =>	'broken_noise.png',
			'label' => __( 'Broken Noise', 'samba_lang' )
		),
		'29' => array(
			'value' =>	'cartographer.png',
			'label' => __( 'Cartographer', 'samba_lang' )
		),
		'30' => array(
			'value' =>	'classy_fabric.png',
			'label' => __( 'Classy Fabric', 'samba_lang' )
		),
		'31' => array(
			'value' =>	'crissXcross.png',
			'label' => __( 'Criss Cross', 'samba_lang' )
		),
		'32' => array(
			'value' =>	'darkdenim.png',
			'label' => __( 'Dark Denim', 'samba_lang' )
		),
		'33' => array(
			'value' =>	'hixs_pattern_evolution.png',
			'label' => __( 'Dark Metal', 'samba_lang' )
		),
		'34' => array(
			'value' =>	'dark_mosaic.png',
			'label' => __( 'Dark Mosaic', 'samba_lang' )
		),
		'35' => array(
			'value' =>	'noisy_net.png',
			'label' => __( 'Dark Noisy Net', 'samba_lang' )
		),
		'36' => array(
			'value' =>	'pinstriped_suit.png',
			'label' => __( 'Dark Pin Stripes', 'samba_lang' )
		),
		'37' => array(
			'value' =>	'dark_stripes.png',
			'label' => __( 'Dark Stripes', 'samba_lang' )
		),
		'39' => array(
			'value' =>	'dark_tire.png',
			'label' => __( 'Dark Tyre', 'samba_lang' )
		),
		'40' => array(
			'value' =>	'debut_dark.png',
			'label' => __( 'Debut Dark', 'samba_lang' )
		),
		'41' => array(
			'value' =>	'fake_brick.png',
			'label' => __( 'Fake Fabric', 'samba_lang' )
		),
		'42' => array(
			'value' =>	'irongrip.png',
			'label' => __( 'Iron Grip', 'samba_lang' )
		),
		'43' => array(
			'value' =>	'navy_blue.png',
			'label' => __( 'Navy Blue', 'samba_lang' )
		),
		'44' => array(
			'value' =>	'outlets.png',
			'label' => __( 'Outlets', 'samba_lang' )
		),
		'45' => array(
			'value' =>	'padded.png',
			'label' => __( 'Padded', 'samba_lang' )
		),
		'60' => array(
			'value' =>	'moulin.png',
			'label' => __( 'Moulin', 'samba_lang' )
		),
		'46' => array(
			'value' =>	'nami.png',
			'label' => __( 'Seamless Dark', 'samba_lang' )
		),
		'61' => array(
			'value' =>	'simple_dashed.png',
			'label' => __( 'Simple Dashed', 'samba_lang' )
		),
		'47' => array(
			'value' =>	'stressed_linen.png',
			'label' => __( 'Stressed Linen', 'samba_lang' )
		),
		'48' => array(
			'value' =>	'px.png',
			'label' => __( 'Tiny Squares', 'samba_lang' )
		),
		'49' => array(
			'value' =>	'type.png',
			'label' => __( 'Typographic', 'samba_lang' )
		),
		'50' => array(
			'value' =>	'vertical_cloth.png',
			'label' => __( 'Vertical Cloth', 'samba_lang' )
		),
		'51' => array(
			'value' =>	'dark_wood.png',
			'label' => __( 'Wood - Dark', 'samba_lang' )
		),
		'62' => array(
			'value' =>	'retina_wood.png',
			'label' => __( 'Wood - Yellowish', 'samba_lang' )
		),
		'52' => array(
			'value' =>	'purty_wood.png',
			'label' => __( 'Wood - Yellow', 'samba_lang' )
		),
		'53' => array(
			'value' =>	'wood_texture.png',
			'label' => __( 'Wood - Textured', 'samba_lang' )
		),
		'54' => array(
			'value' =>	'blu_stripes.png',
			'label' => __( 'Blue', 'samba_lang' )
		),
		'55' => array(
			'value' =>	'random_grey_variations.png',
			'label' => __( 'Blue Variations', 'samba_lang' )
		),
		'56' => array(
			'value' =>	'green_dust_scratch.png',
			'label' => __( 'Green - Vintage', 'samba_lang' )
		),
		'57' => array(
			'value' =>	'shattered.png',
			'label' => __( 'Shattered', 'samba_lang' )
		),
		'58' => array(
			'value' =>	'shattered.jpg',
			'label' => __( 'Shattered Dark', 'samba_lang' )
		),
		'59' => array(
			'value' =>	'gplaypattern.png',
			'label' => __( 'Play Pattern', 'samba_lang' )
		),
		//NEXT 64
	);
	//TRUE/FALSE OPTION
	$truefalse_options = array(
		'true' => array(
			'value' => 'true',
			'label' => __( 'Yes', 'samba_lang' )
		),
		'false' => array(
			'value' => 'false',
			'label' => __( 'No', 'samba_lang' )
		)
	);
	//PORTFOLIO LAYOUT OPTIONS
	$portfolio_layout_options = array(
		'1' => array(
			'value' => 'wide',
			'label' => __( 'Wide', 'samba_lang' )
		),
		'2' => array(
			'value' => 'wideout',
			'label' => __( 'Wide without right info panel', 'samba_lang' )
		),
		'3' => array(
			'value' => 'half',
			'label' => __( 'Half', 'samba_lang' )
		)
	);
	//WIDGETS NR OPTION
	$widgtes_nr_options = array(
		'1' => array(
			'value' => 'twelve',
			'label' => __( 'One', 'samba_lang' )
		),
		'2' => array(
			'value' => 'six',
			'label' => __( 'Two', 'samba_lang' )
		),
		'3' => array(
			'value' => 'four',
			'label' => __( 'Three', 'samba_lang' )
		)
		,
		'4' => array(
			'value' => 'three',
			'label' => __( 'Four', 'samba_lang' )
		)
	);
	
	//SHOW LIGHTBOX BUTTON ON ROLLOVER
	$lightbox_options = array(
		'both' => array(
			'value' => 'both',
			'label' => __( 'Show lightbox and link button', 'samba_lang' )
		),
		'light_only' => array(
			'value' => 'light_only',
			'label' => __( 'Show only lightbox button', 'samba_lang' )
		),
		'link_only' => array(
			'value' => 'link_only',
			'label' => __( 'Show only link button', 'samba_lang' )
		)
	);
	
	//SKINS
	$icon_options = array(
		'0' => array(
			'value' =>	'dark',
			'label' => __( 'Use Dark Icons', 'samba_lang' )
		),
		'1' => array(
			'value' =>	'clear',
			'label' => __( 'Use Clear Icons', 'samba_lang' )
		)
	);
	
	//SKINS CONTACT
	$icon_options_ct = array(
		'0' => array(
			'value' =>	'black_ic',
			'label' => __( 'Black Icons', 'samba_lang' )
		),
		'1' => array(
			'value' =>	'white_ic',
			'label' => __( 'White Icons', 'samba_lang' )
		),
		'2' => array(
			'value' =>	'custom_ic',
			'label' => __( 'Custom Icons (grey)', 'samba_lang' )
		)
	);
	
	//BLOG POST ICONS
	$blog_icon_options = array(
		'0' => array(
			'value' =>	'navicon-link',
			'label' => __( 'Link', 'samba_lang' )
		),
		'2' => array(
			'value' =>	'navicon-pen',
			'label' => __( 'Pen', 'samba_lang' )
		),
		'3' => array(
			'value' =>	'navicon-image-2',
			'label' => __( 'Image', 'samba_lang' )
		),
		'4' => array(
			'value' =>	'navicon-camera',
			'label' => __( 'Video', 'samba_lang' )
		),
		'5' => array(
			'value' =>	'navicon-lab',
			'label' => __( 'Lab', 'samba_lang' )
		),
		'6' => array(
			'value' =>	'navicon-camera-2',
			'label' => __( 'Camera', 'samba_lang' )
		),
		'7' => array(
			'value' =>	'navicon-pushpin',
			'label' => __( 'Pushpin', 'samba_lang' )
		),
		'8' => array(
			'value' =>	'navicon-stats',
			'label' => __( 'Stats', 'samba_lang' )
		),
		'9' => array(
			'value' =>	'navicon-wrench',
			'label' => __( 'Technology', 'samba_lang' )
		),
		'10' => array(
			'value' =>	'navicon-rocket',
			'label' => __( 'Rocket', 'samba_lang' )
		),
		'11' => array(
			'value' =>	'navicon-music',
			'label' => __( 'Music', 'samba_lang' )
		)
	);
	$social_options_pngs=array(
		'1' => array(
			'value' =>	'delicious',
			'label' => 'Delicious'
		),
		'2' => array(
			'value' =>	'deviantart',
			'label' => 	'Deviantart'
		),
		'8' => array(
			'value' =>	'dribbble-2',
			'label' => 	'Dribbble'
		),
		'4' => array(
			'value' =>	'facebook-2',
			'label' => 	'Facebook'
		),
		'5' => array(
			'value' =>	'flickr-2',
			'label' => 	'Flickr'
		),
		'3' => array(
			'value' =>	'google-plus-2',
			'label' => 	'Google Plus'
		),
		'6' => array(
			'value' =>	'instagram',
			'label' => 	'Instagram'
		),
		'7' => array(
			'value' =>	'linkedin',
			'label' => 	'Linkedin'
		),
		'9' => array(
			'value' =>	'pinterest',
			'label' => 	'Pinterest'
		),
		'10' => array(
			'value' =>	'skype',
			'label' => 	'Skype'
		),
		'13' => array(
			'value' =>	'soundcloud',
			'label' => 	'Soundcloud'
		),
		'11' => array(
			'value' =>	'twitter-2',
			'label' => 	'Twitter'
		),
		'12' => array(
			'value' =>	'vimeo2',
			'label' => 	'Vimeo'
		),
		'14' => array(
			'value' =>	'youtube-2',
			'label' => 	'Youtube'
		),
		'15' => array(
			'value' =>	'feed-2',
			'label' => 	'RSS'
		)
	);
	//TEXT OPTION PROTOTYPE
	function prk_output_option($opt_title,$opt_id,$opt_width,$opt_max,$opt_help)
	{
		$options =get_option('samba_theme_options');
		if (!isset($options[$opt_id]))
		{
			//CHECK FOR NEW OPTIONS
			if ($opt_id=='custom_menu_opacity')
			{
				$options[$opt_id]="100";
			}
			else if ($opt_id=='prev_prj_text')
			{
				$options[$opt_id]="Previous Project";
			}
			else if ($opt_id=='carousel_background_opacity')
			{
				$options[$opt_id]="90";
			}   
			else if ($opt_id=='next_prj_text')
			{
				$options[$opt_id]="Next Project";
			}                       	
			else {						
				$options[$opt_id]="Need translation";
			}
		}
		$prk_output='<h4>'.__( $opt_title, 'samba_lang' ).'</h4>';
		$prk_output.='<div class="prk_setting">';
		$prk_output.='<div class="prk_setting_left">';
		$prk_output.='<input id="'.$opt_id.'" size="'.$opt_width.'" maxlength="'.$opt_max.'" type="text" name="samba_theme_options['.$opt_id.']" value="'.esc_textarea($options[$opt_id]).'" />';
	    $prk_output.='</div>';
	    $prk_output.='<div class="prk_setting_right">';
	    $prk_output.='<p><em>'.__( $opt_help, 'samba_lang' ).'</em></p>';
	    $prk_output.='</div>';
	    $prk_output.='<div class="clear"></div>';
	    $prk_output.='</div>';
	    return $prk_output;
	}
	function prk_output_option_color($opt_title,$picker_id,$opt_id,$opt_help) {
		$options =get_option('samba_theme_options');
    	if (!isset($options['carousel_text_color']))
			$options['carousel_text_color']="#FFFFFF";
		if (!isset($options['carousel_nav_color']))
			$options['carousel_nav_color']="#111111";
    	if (!isset($options['carousel_background_color']))
			$options['carousel_background_color']="#000000";
		$prk_output='<h4>'.__( $opt_title, 'samba_lang' ).'</h4>';
		$prk_output.='<div class="prk_setting">';
		$prk_output.='<div class="prk_setting_left">';
		$prk_output.='<div id="'.$picker_id.'" class="color_selector prk_picker" data-color="'.$options["site_background_color"].'">';
		$prk_output.='<div style="background-color:'.$options[$opt_id].'"></div>';
		$prk_output.='</div>';
		$prk_output.='<input id="'.$opt_id.'" class="prk_input_listen" type="text" name="samba_theme_options['.$opt_id.']" value="'.$options[$opt_id].'" />';
	    $prk_output.='</div>';
	    $prk_output.='<div class="prk_setting_right">';
	    $prk_output.='<p><em>'.__( $opt_help, 'samba_lang' ).'</em></p>';
	    $prk_output.='</div>';
	    $prk_output.='<div class="clear"></div>';
	    $prk_output.='</div>';
	    return $prk_output;
	}
	//CREATE THE OPTIONS PAGE
	function theme_options_do_page() 
	{
		global $shadow_options,$overlay_options,$social_options_pngs,$select_font_options,$yesno_options,$yesno_options_woo,$cart_options,$skin_options,$icon_options,$icon_options_ct, $pattern_options, $truefalse_options,$layout_options,$lightbox_options,$blog_icon_options,$menu_options,$archives_options,$portfolios_options,$widgtes_nr_options,$portfolio_layout_options;
		if ( ! isset( $_REQUEST['settings-updated'] ) )
			$_REQUEST['settings-updated'] = false;
			//GET THEME DATA FROM THE STYLESHEET
			$theme_data = wp_get_theme();
		?>
		<div id="admin_dump"></div>
        <div id="prk_save_progress">Saving...</div>
        <div id="prk_options_header">
					<h2><?php echo PRK_THEME_NAME; ?> Theme Admin Panel</h2>
				<div class="clear"></div>
		    </div>
		<div id="prk_options_container" class="wrap" data-directory="<?php echo get_template_directory_uri() ?>">
			
			<div id="pirenko_admin_menu">
				<ul>
					<li class="current"><a href="#" id="samba_general_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/general.png"><?php _e('General','samba_lang'); ?></a></li>
					<li><a href="#" id="samba_branding_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/branding.png"><?php _e('Branding','samba_lang'); ?></a></li>
                    <li><a href="#" id="samba_header_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/header.png"><?php _e('Menu Bar','samba_lang'); ?></a></li>
                    <li><a href="#" id="samba_footer_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/footer.png"><?php _e('Left footer','samba_lang'); ?></a></li>
                    <li><a href="#" id="samba_news_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/blog.png"><?php _e('Blog','samba_lang'); ?></a></li>
                    <li><a href="#" id="samba_portfolio_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/portfolio.png"><?php _e('Portfolio','samba_lang'); ?></a></li>
					<li><a href="#" id="samba_contact_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/contact.png"><?php _e('Contact','samba_lang'); ?></a></li>
                    <li><a href="#" id="samba_translations_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/translations.png"><?php _e('Translations','samba_lang'); ?></a></li>
                    <li><a href="#" id="samba_custom_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/custom.png"><?php _e('Custom Scripts','samba_lang'); ?></a></li>
                    <?php 
                    	if (PRK_WOO=="true") 
    					{
                    		?>
                    		<li><a href="#" id="samba_woo_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/woocommerce.png"><?php _e('WooCommerce','samba_lang'); ?></a></li>
                    		<?php
                    	}
                    ?>
                    <li><a href="#" id="samba_advanced_options_button"><img class="adm_faded" src="<?php echo get_template_directory_uri(); ?>/images/admin/advanced.png"><?php _e('Advanced','samba_lang'); ?></a></li>
					<div class="clear"></div>
				</ul>
				<div class="clear"></div>
			</div>
			<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
				<div class="updated fade"><p><strong><?php _e( 'Options saved', 'samba_lang' ); ?></strong></p></div>
			<?php endif; ?>
			<div id="pirenko_options">
                <form id="prk_main_options" method="post" action="">
                    <input id="set_default" type="hidden" size="1" type="text" name="samba_theme_options[set_default]" value="false" />
                    <div id="prk_fixed_save" class="save_options">
                        <input id="prk_top_save_btn" type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                    	<input id="prk_top_reset_btn" type="button" class="button submit-button reset-button pirenko_reset_button" value="Reset Options" onClick="go_there()" />
                    </div>
                    <?php 
                    	settings_fields( 'prk_options' ); 
                    	$options = get_option('samba_theme_options' ); 
                    	$options['just_saved']="true";
                    	update_option('samba_theme_options', $options);
                    ?>
                    <div id="samba_options">
                        <!--GENERAL OPTIONS-->
                        <div id="pirenko_general_options" class="samba_tab_options">
                                 
                                <div><?php echo "<h2>Main Theme Options</h2>"; ?></div>
                                <?php
                                //RESPONSIVENESS
                                ?>
                                <h4><?php _e( 'Make the theme layout responsive?', 'samba_lang' ); ?></h4>
                                <div class="prk_setting">
	                                <div class="prk_setting_left">
                                <select name="samba_theme_options[responsive]">
                                    <?php    
                                        foreach ( $truefalse_options as $option ) 
                                        {
                                            $label = $option['label'];
                                            
                                            if ( $options['responsive'] == $option['value'] ) // Make default first in list
                                                echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                            else
                                                echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                        }
                                    ?>
                                    </select> 
                                    </div>
	                                <div class="prk_setting_right">
	                                	<p><em><?php _e('Make theme adjust to smaller screens.','samba_lang'); ?></em></p>
	                                </div>
	                                <div class="clear"></div>
	                            </div>
	                            <?php
                               		//RESPONSIVE WIDTH
                                	echo prk_output_option("Minimum content width before collapsing menu","responsive_width",6,5,"The menu collapses at this width. Use a large value (ex: 10000) to have the menu always collapsed.");
                                ?>
                                <?php
                               		//CUSTOM WIDTH
                                	echo prk_output_option("Maximum content width","custom_width",6,5,"The center area width is variable and will stop enlarging at this width.");
                                ?>
                                <h4><?php _e( 'Use Ajax calls to load content?', 'samba_lang' ); ?></h4>
                                <div class="prk_setting">
	                                <div class="prk_setting_left">
                                <select name="samba_theme_options[ajax_calls]">
                                    <?php    
                                        foreach ( $truefalse_options as $option ) 
                                        {
                                            $label = $option['label'];
                                            
                                            if ( $options['ajax_calls'] == $option['value'] ) // Make default first in list
                                                echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                            else
                                                echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                        }
                                    ?>
                                    </select> 
                                    </div>
	                                <div class="prk_setting_right">
	                                	<p><em>If on the theme will attempt to load all content using Ajax calls. This will speed up the website page loading process and allow some elements to have smoother transitions.</em></p>
	                                </div>
	                                <div class="clear"></div>
	                            </div>
                               <?php
                                //LOGO IMAGE
								?> 
                                <h2><?php _e( 'Background', 'samba_lang' ); ?></h2>
                                <?php
                                //BACKGROUND IMAGE
                                if (!isset($options['background_image']))
									$options['background_image']="";
                                ?>
                                    <h4><?php _e( 'Background Image', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                            <img class="pirenko_cms_image left_floated" id="samba_theme_options_background_image" src="<?php echo( $options['background_image'] ); ?>" />
	                                        <div class="clear"></div>
	                                        <input id="samba_theme_options_background" size="1" type="hidden" name="samba_theme_options[background_image]" value="<?php echo( $options['background_image'] ); ?>" />
	                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_background" secret_id="0">Upload Background</a>
	                                        <a href="#" class="button" id="remove_background_button" name="theme_options_background_remove">Remove Background</a>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
                                //BACKGROUND PATTERN
                                ?>
                                <h4><?php _e( 'Background Pattern', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select id="pattern_selector" name="samba_theme_options[pattern]">
                                            <?php    
                                                foreach ( $pattern_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['pattern'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                        <div id="background_preview" class="preview_pattern" <?php if ($options['pattern']!="") {echo 'style="background-image:url('.get_template_directory_uri().'/images/patterns/'. $options['pattern'].')"';} ?>>
                                        </div>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
                                	//BACKGROUND COLOR
                                	echo prk_output_option_color("Background Color","my_picker_0","site_background_color","Will be used only if there's no background pattern.");
                                ?>
                                <?php
                                //FONTS
                                ?>
                                <h2><?php _e( 'Fonts', 'samba_lang' ); ?></h2>
                                <?php
                                //HEADINGS FONT
                                ?>
                                <h4><?php _e( 'Headings Font', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select id="header_font" name="samba_theme_options[header_font]">
                                            <?php
                                            	if (!is_array($options['header_font']))
												{
													foreach ( $select_font_options as $option_header ) 
											        {
											            $label_header = $option_header['label'];
											            if ($options['header_font'] == $option_header['value'])
											            {
											            	$options['header_font']=$option_header;
											            }  
											        }
											        if (is_plugin_active('prk_fonts/prk_fonts.php'))
											        {
												        $prk_font_options = get_option('prk_font_plugin_option');
														foreach ($prk_font_options as $font) {
															if ($font['erased']=="false") {
																if ($options['header_font'] == $font['value'])
													            {
													            	$options['header_font']=$font;
													            } 
											                }
														}
												    }
												    update_option('samba_theme_options', $options);
												}
												if (!is_array($options['body_font']))
												{
													foreach ( $select_font_options as $option_header ) 
											        {
											            $label_header = $option_header['label'];
											            if ($options['body_font'] == $option_header['value'])
											            {
											            	$options['body_font']=$option_header;
											            }  
											        }
											        if (is_plugin_active('prk_fonts/prk_fonts.php'))
											        {
												        $prk_font_options = get_option('prk_font_plugin_option');
														foreach ($prk_font_options as $font) {
															if ($font['erased']=="false") {
																if ($options['body_font'] == $font['value'])
													            {
													            	$options['body_font']=$font;
													            } 
											                }
														}
												    }
												    update_option('samba_theme_options', $options);
												}
                                            	if (is_plugin_active('prk_fonts/prk_fonts.php'))
                                            	{
	                                            	$prk_font_options = get_option('prk_font_plugin_option');
	                                            	//CHECK IF EMPTY
													if (!isset($prk_font_options) || (isset($prk_font_options) && $prk_font_options==""))
													{
														update_option( 'prk_font_plugin_option', array());
													}
													foreach ($prk_font_options as $font) {
														if ($font['erased']=="false") {
															$label_header = $font['label'];
															if ( $options['header_font']['value'] == $font['value'] ) // Make default first in list
		                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $font['value'] ) . "'>$label_header - Extra font</option>";
		                                                    else
		                                                        echo "\n\t<option value='" . esc_attr( $font['value'] ) . "'>$label_header - Extra font</option>";
		                                                }
													}
												}
                                                foreach ( $select_font_options as $option_header ) 
                                                {
                                                    $label_header = $option_header['label'];
                                                    if ( $options['header_font']['value'] == $option_header['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option_header['value'] ) . "'>$label_header</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option_header['value'] ) . "'>$label_header</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
                                //BODY
                                ?>
                                <h4><?php _e( 'Body Font', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">                            
                                        <select id="body_font" name="samba_theme_options[body_font]">
                                            <?php
                                            	if (is_plugin_active('prk_fonts/prk_fonts.php'))
                                            	{
	                                            	$prk_font_options = get_option('prk_font_plugin_option');
													foreach ($prk_font_options as $font) {
														if ($font['erased']=="false") {
															$label_header = $font['label'];
															if ( $options['body_font']['value'] == $font['value'] ) // Make default first in list
		                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $font['value'] ) . "'>$label_header - Extra font</option>";
		                                                    else
		                                                        echo "\n\t<option value='" . esc_attr( $font['value'] ) . "'>$label_header - Extra font</option>";
		                                                }
													}
												} 
                                                foreach ( $select_font_options as $option_body ) 
                                                {
                                                    $label_body = $option_body['label'];
                                                    
                                                    if ( $options['body_font']['value'] == $option_body['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option_body['value'] ) . "'>$label_body</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option_body['value'] ) . "'>$label_body</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
	                             <?php
                                //UPPERCASE 
                                ?>
                                    <h4><?php _e( 'Uppercase titles?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[uppercase_titles]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['uppercase_titles'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'If active some of the theme titles will be uppercased.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
                                //COLORS
                                ?>
                                <h2><?php _e( 'Color Scheme', 'samba_lang' ); ?></h2>
                                 <?php
                                //UPPERCASE 
                                ?>
                                    <h4><?php _e( 'Use special colors for posts and pages?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[use_custom_colors]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['use_custom_colors'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'If on the theme will search for menu buttons that have an assigned color. Selected colors for single posts, portfolio entries and team members will also be applied accordingly (this options is located under each entry content window).', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
                                	//ACTIVE COLOR
                                	echo prk_output_option_color("Body active color","my_picker_1","active_color","");
                                	//BODY TEXT COLOR
                                	echo prk_output_option_color("Body text color","my_picker_6","inactive_color","");
                                	//HEADINGS TEXT COLOR
                                	echo prk_output_option_color("Body headings color","my_picker_7","bd_headings_color","");
                                	//BUTTONS BACKGROUND COLOR
                                	echo prk_output_option_color("Thumbnails rollover color - Portfolio (default value)","my_picker_8","background_color_btns","Posts with a featured color will override this option");
                                	//CUSTOM OPACITY ROLLOVER
                                	echo prk_output_option("Custom Background Opacity - Portfolio rollover effects","custom_opacity_folio",7,6,"Acceptable values: [0,100]");
                                	//BUTTONS BACKGROUND COLOR
                                	echo prk_output_option_color("Thumbnails rollover color - Blog (default value)","my_picker_9","background_color_btns_blog","Posts with a featured color will override this option");
                                	//CUSTOM OPACITY ROLLOVER
                                	echo prk_output_option("Custom Background Opacity - Blog rollover effects","custom_opacity",7,6,"Acceptable values: [0,100]");
                                	//MODULES BACKGROUND COLOR
                                	echo prk_output_option_color("Text modules background color","my_picker_10","background_color","");
                                ?>
                                <h2><?php _e( 'Borders and lines', 'samba_lang' ); ?></h2>
                                 <?php
                                	//LINES COLOR
                                 	echo prk_output_option_color("Lines color","my_picker_16","lines_color","");
                                	//BORDERS COLOR
                                 	echo prk_output_option_color("Shadow color","my_picker_11","shadow_color","");
                                	//BORDER OPACITY
                                	echo prk_output_option("Shadow Opacity","custom_shadow",7,6,"Acceptable values: [0,100] (Use 0 value for no shadowing effect)");
                                ?>
								<h2><?php _e( 'Buttons', 'samba_lang' ); ?></h2>
                                 <?php
                                	//THEME BUTTONS BACKGROUND COLOR
                                 	echo prk_output_option_color("Buttons background color","my_picker_30","theme_buttons_color","The alternative background color will be the theme current active color");
                                	//BUTTONS BACKGROUND COLOR
                                	echo prk_output_option_color("Slider and navigation buttons background color","my_picker_25","buttons_color","The arrows color will be the current active color");
                                ?>
                                <h2><?php _e( 'Portfolio Carousel', 'samba_lang' ); ?></h2>
                                <?php
                                	echo prk_output_option_color("Text color","my_picker_34","carousel_text_color","");
                                	echo prk_output_option_color("Carousel text blocks background color","my_picker_36","carousel_background_color","");
                                	echo prk_output_option("Carousel text blocks background opacity","carousel_background_opacity",7,6,"Acceptable values: [0,100]");  	
                                	echo prk_output_option_color("Navigation bullets color","my_picker_35","carousel_nav_color","The alternative background color will be the theme current active color");
                                //SIDEBARS
                                ?>
                                <h2><?php _e( 'Sidebars', 'samba_lang' ); ?></h2>
                                <?php
                                //RIGHT SIDEBAR
                                ?>
                                    <h4><?php _e( 'Display right sidebar?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[right_sidebar]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['right_sidebar'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
                                //FOOTER SIDEBAR
                                ?>
                                    <h4><?php _e( 'Display left menu footer sidebar?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[bottom_sidebar]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['bottom_sidebar'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                           	<p class="save_options">
                           	<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                           	</p>
                       	</div><!-- GENERAL OPTIONS -->
                       	 <!--BRANDING PAGE OPTIONS-->
                        <div id="pirenko_branding_options" class="samba_tab_options">
                        	<h2><?php _e( 'Logo Images - Normal Screens', 'samba_lang' ); ?></h2>
                                	<h4><?php _e( 'Logo image', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                            <img class="pirenko_cms_image left_floated" id="samba_theme_options_logo_image" src="<?php echo( $options['logo'] ); ?>" style="background-color:<?php echo $options['background_color_header']; ?>;" />
                                        	<div class="clear"></div>
                                        	<input id="samba_theme_options_logo" type="hidden" size="1" type="text" name="samba_theme_options[logo]" value="<?php echo( $options['logo'] ); ?>" />
                                        	<a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_logo" secret_id="0"><?php _e( 'Upload Logo', 'samba_lang' ); ?></a>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'The maximum logo width is 220px.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
                                 <?php
                                //RESPONSIVE LOGO
								if (!isset($options['alt_logo']))
									$options['alt_logo']="";
                                ?>
									<h4><?php _e( 'Logo image - collapsed left bar (optional)', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <img class="pirenko_cms_image left_floated" id="samba_theme_options_alt_logo_image" src="<?php echo( $options['alt_logo'] ); ?>" style="background-color:<?php echo $options['background_color_header']; ?>;"  />
                                        <div class="clear"></div>
                                        <input id="samba_theme_options_alt_logo" type="hidden" size="1" type="text" name="samba_theme_options[alt_logo]" value="<?php echo( $options['alt_logo'] ); ?>" />
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_alt_logo" secret_id="0">Upload collapsed left bar logo</a>
                                        <a href="#" class="button" id="remove_alt_logo_button" name="theme_alt_logo_remove"><?php _e( 'Remove collapsed left bar logo', 'samba_lang' ); ?></a>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'Smaller logo for collapsed left bar. The recommended width is 80px.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
	                            	<?php
	                            	//RESPONSIVE LOGO
									if (!isset($options['small_logo']))
										$options['small_logo']="";
	                                ?>
										<h4><?php _e( 'Logo image - collapsed top bar (optional)', 'samba_lang' ); ?></h4>             
	                                    <div class="prk_setting">
		                                	<div class="prk_setting_left">
	                                        <img class="pirenko_cms_image left_floated" id="samba_theme_options_small_logo_image" src="<?php echo( $options['small_logo'] ); ?>" style="background-color:<?php echo $options['background_color_header']; ?>;"  />
	                                        <div class="clear"></div>
	                                        <input id="samba_theme_options_small_logo" type="hidden" size="1" type="text" name="samba_theme_options[small_logo]" value="<?php echo( $options['small_logo'] ); ?>" />
	                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_small_logo" secret_id="0"><?php _e( 'Upload collapsed top bar logo', 'samba_lang' ); ?></a>
	                                        <a href="#" class="button" id="remove_small_logo_button" name="theme_small_logo_remove"><?php _e( 'Remove collapsed top bar logo', 'samba_lang' ); ?></a>
	                                        </div>
			                                <div class="prk_setting_right">
			                                	<p><em><?php _e( 'Smaller logo for collapsed top bar. The recommended height is 40px.', 'samba_lang' ); ?></em></p>
			                                </div>
		                                	<div class="clear"></div>
		                            	</div>
		                            <h2><?php _e( 'Logo Images - Retina Screens', 'samba_lang' ); ?></h2>
	                            	<?php
	                                //RESPONSIVE LOGO
									if (!isset($options['logo_retina']))
										$options['logo_retina']="";
	                                ?>
	                            	<h4><?php _e( 'Logo image - Retina displays (optional)', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                            <img class="pirenko_cms_image left_floated" id="samba_theme_options_logo_retina_image" src="<?php echo( $options['logo_retina'] ); ?>" style="background-color:<?php echo $options['background_color_header']; ?>;" />
                                        	<div class="clear"></div>
                                        	<input id="samba_theme_options_logo_retina" type="hidden" size="1" type="text" name="samba_theme_options[logo_retina]" value="<?php echo( $options['logo_retina'] ); ?>" />
                                        	<a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_logo_retina" secret_id="0"><?php _e( 'Upload Logo', 'samba_lang' ); ?></a>
                                        	<a href="#" class="button" id="remove_logo_retina_button" name="theme_logo_retina_remove"><?php _e( 'Remove Logo', 'samba_lang' ); ?></a>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'If used should be the double size of the original logo image.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
                                 <?php
                                //RESPONSIVE LOGO
								if (!isset($options['alt_logo_retina']))
									$options['alt_logo_retina']="";
                                ?>
									<h4><?php _e( 'Logo image - Collapsed left bar on retina displays (optional)', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <img class="pirenko_cms_image left_floated" id="samba_theme_options_alt_logo_retina_image" src="<?php echo( $options['alt_logo_retina'] ); ?>" style="background-color:<?php echo $options['background_color_header']; ?>;"  />
                                        <div class="clear"></div>
                                        <input id="samba_theme_options_alt_logo_retina" type="hidden" size="1" type="text" name="samba_theme_options[alt_logo_retina]" value="<?php echo( $options['alt_logo_retina'] ); ?>" />
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_alt_logo_retina" secret_id="0"><?php _e( 'Upload collapsed left bar logo', 'samba_lang' ); ?></a>
                                        <a href="#" class="button" id="remove_alt_logo_retina_button" name="theme_alt_logo_retina_remove"><?php _e( 'Remove collapsed left bar logo', 'samba_lang' ); ?></a>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'Smaller logo for collapsed left bar on retina small screens. If used should be the double size of the orignal alternative logo image.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
	                            	<?php
	                            	//RESPONSIVE LOGO
								if (!isset($options['small_logo_retina']))
									$options['small_logo_retina']="";
                                ?>
									<h4><?php _e( 'Logo image - Collapsed top bar on retina displays (optional)', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <img class="pirenko_cms_image left_floated" id="samba_theme_options_small_logo_retina_image" src="<?php echo( $options['small_logo_retina'] ); ?>" style="background-color:<?php echo $options['background_color_header']; ?>;"  />
                                        <div class="clear"></div>
                                        <input id="samba_theme_options_small_logo_retina" type="hidden" size="1" type="text" name="samba_theme_options[small_logo_retina]" value="<?php echo( $options['small_logo_retina'] ); ?>" />
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_small_logo_retina" secret_id="0"><?php _e( 'Upload collapsed top bar logo', 'samba_lang' ); ?></a>
                                        <a href="#" class="button" id="remove_small_logo_retina_button" name="theme_small_logo_retina_remove"><?php _e( 'Remove collapsed top bar logo', 'samba_lang' ); ?></a>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'Smaller logo for collapsed top bar on retina small screens. If used should be the double size of the orignal alternative logo image.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
                                 <?php
                                //FAVICON IMAGE
								if (!isset($options['favicon']))
									$options['favicon']="". get_template_directory_uri() . "/images/favicon.ico";
                                ?>
                                    <h4><?php _e( 'Favicon Image', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <img class="pirenko_cms_image left_floated" id="samba_theme_options_favicon_image" src="<?php echo( $options['favicon'] ); ?>" />
                                        <div class="clear"></div>
                                        <input id="samba_theme_options_favicon" type="hidden" size="1" type="text" name="samba_theme_options[favicon]" value="<?php echo( $options['favicon'] ); ?>" />
                                        <a href="#" class="pirenko_upload_options button" id="upload_image_button" name="theme_options_favicon" secret_id="0"><?php _e( 'Upload Favicon', 'samba_lang' ); ?></a>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'Should have the .ico extension.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
	                            <?php
                                	//MENU DISPLACEMENT
                                	echo prk_output_option("Logo vertical margin (in pixels)","menu_vertical",2,3,"You can move the logo up or down by changing this value.");
                                ?>                      
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                            </p>
                        </div><!-- samba_tab_options -->

                        <div id="pirenko_header_options" class="samba_tab_options">
                        	<h2><?php _e( 'Menu', 'samba_lang' ); ?></h2>
                        		<h4><?php _e( 'Create 3D effect when the collapsed menu opens and closes?', 'samba_lang' ); ?></h4>
                                <div class="prk_setting">
	                                <div class="prk_setting_left">
                                <select name="samba_theme_options[3d_menu]">
                                    <?php    
                                        foreach ( $truefalse_options as $option ) 
                                        {
                                            $label = $option['label'];
                                            
                                            if ( $options['3d_menu'] == $option['value'] ) // Make default first in list
                                                echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                            else
                                                echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                        }
                                    ?>
                                    </select> 
                                    </div>
	                                <div class="prk_setting_right">
	                                	<p><em><?php _e( 'If on the theme will attempt to create this effect. With the option off or on older browsers, the menu will simply slide in and out.', 'samba_lang' ); ?></em></p>
	                                </div>
	                                <div class="clear"></div>
	                            </div>
                                 <?php
                                	//WRAPPER COLOR
                                	echo prk_output_option_color("Left bar background color","my_picker_12","background_color_header","");
                                	//WRAPPER OPACITY
                                	echo prk_output_option("Left bar Opacity","custom_menu_opacity",7,6,"Acceptable values: [0,100]");
                                	//LINES COLOR
                                	echo prk_output_option_color("Left bar lines color","my_picker_31","menu_lines_color","Divider lines for the whole bar.");
                                	//LINES COLOR
                                	echo prk_output_option_color("Left bar right border color","my_picker_32","menu_border_color","If blank the theme won't apply any border.");
                                	echo prk_output_option_color("Collapsed menu bar right border color","my_picker_33","coll_menu_border_color","If blank the theme won't apply any border.");
                                	//MENU COLOR
                                	echo prk_output_option_color("Menu text color","my_picker_3","menu_up_color","");
                                	//MENU ACTIVE COLOR
                                	echo prk_output_option_color("Menu active text color","my_picker_2","menu_active_color","");
                                	//SUBHEADINGS COLOR
                                	echo prk_output_option_color("Menu active button background color","my_picker_19","menu_subheadings_color","");
                                	//SUBMENU BACKGORUND COLOR
                                	echo prk_output_option_color("Menu background color","my_picker_5","submenu_color","Leave blank if no special color is needed");
                                ?>
                            	<p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                            </p>
                        </div><!-- samba_tab_options -->
                        <div id="pirenko_footer_options" class="samba_tab_options">
                            <h2><?php _e( 'Left footer', 'samba_lang' ); ?></h2>
                                <?php
                                	//FOOTER ACTIVE COLOR
                                	echo prk_output_option_color("Footer titles color","my_picker_13","titles_color_footer","");
                                	//FOOTER BODY COLOR
                                	echo prk_output_option_color("Footer body color","my_picker_14","body_color_footer","");
                                ?>
                                <?php
                                //FOOTER TEXT
                                ?>
                                <h4><?php _e( 'Footer text', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                    <textarea id="samba_theme_options[footer_text]" class="pirenko-large-text" rows="4" name="samba_theme_options[footer_text]"><?php echo esc_textarea( $options['footer_text'] ); ?></textarea>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'HTML supported.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
	                          <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                            </p>
                        </div><!-- samba_tab_options -->  
                        <!--PORTFOLIO PAGE OPTIONS-->
                        <div id="pirenko_portfolio_options" class="samba_tab_options">
                                <h2><?php _e( 'Portfolio Options', 'samba_lang' ); ?></h2>
                                 <?php
									//ARCHIVES PAGE TEMPLATE
									?>
									<h4><?php _e( 'Portfolio skills page template', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[archives_ptype]">
												<?php    
													foreach ( $portfolios_options as $option ) 
													{
														$label = $option['label'];
														if ( $options['archives_ptype'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'This layout will be used for portfolio archives pages.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                	<?php
                                		//POSTS TO LOAD
                                    	echo prk_output_option("Default number of posts to load on each load event","samba_posts_nr",5,5,"This option can be overriden on each portfolio page.");
										//DEFAULT LAYOUT
									?>
									<h4><?php _e( 'Default single posts layout', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[portfolio_layout]">
												<?php    
													foreach ( $portfolio_layout_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['portfolio_layout'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'This option can be overriden on each portfolio page.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
                                    <?php
									//SLIDESHOW AUTOPLAY
									?>
											<h4><?php _e( 'Autoplay slideshow?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[autoplay_portfolio]">
												<?php    
													foreach ( $truefalse_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['autoplay_portfolio'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
									<?php
                                    	//SLIDESHOW DELAY
                                    	echo prk_output_option("Slideshow delay in miliseconds","delay_portfolio",5,5,"");
                                    ?>
                                    <?php
										//ENABLE LIGHTBOX ON SINGLE PAGES
									?>
									<h4><?php _e( 'Enable lightbox on single post pages?', 'samba_lang' ); ?></h4>  
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[folio_enable_lightbox]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['folio_enable_lightbox'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'If yes a small enlarge icon will be shown on single post pages.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
                                    <?php
									 //SHOW DATE ON SINGLE PORTFOLIO POSTS
									?>
									<h4><?php _e( 'Show date?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[dateby_port]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['dateby_port'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
	                            	<?php
									 //SHOW LIKE BUTTON
									?>
									<h4><?php _e( 'Show heart/like button on single pages?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[show_heart_folio]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['show_heart_folio'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'Will be displayed on single pages near the social sharing links.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
									<?php
									 //SHOW CATEGORIES ON SINGLE PORTFOLIO POSTS
									?>
									<h4><?php _e( 'Show portfolio skills?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[categoriesby_port]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['categoriesby_port'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                   <?php
									 //SHOW RELATED POSTS
									 if (!isset($options['related_port']))
										$options['related_port']='yes';
									?>
											<h4><?php _e( 'Show related posts?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[related_port]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['related_port'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'This information will be displayed under the single portfolio page.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
									<?php
									//SOCIAL NETWORKS - PORTFOLIO
									?>
										<h2><?php _e( 'Social sharing', 'samba_lang' ); ?></h2>
										<h4><?php _e( 'Show sharing buttons?', 'samba_lang' ); ?></h4>
										 <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[share_portfolio]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														if ( $options['share_portfolio'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
											<table>
											<?php
										//DELICIOUS
										if (!isset($options['share_portfolio_del']))
											$options['share_portfolio_del']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Delicious</div>
											<input type="checkbox" name="samba_theme_options[share_portfolio_del]" name="samba_theme_options[share_portfolio_del]" value="true" <?php echo ( 'true' == $options['share_portfolio_del'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//FACEBOOK
										if (!isset($options['share_portfolio_fb']))
											$options['share_portfolio_fb']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Facebook</div>
											<input type="checkbox" name="samba_theme_options[share_portfolio_fb]" name="samba_theme_options[share_portfolio_fb]" value="true" <?php echo ( 'true' == $options['share_portfolio_fb'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//GOOGLE+
										if (!isset($options['share_portfolio_goo']))
											$options['share_portfolio_goo']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Google+</div>
											<input type="checkbox" name="samba_theme_options[share_portfolio_goo]" name="samba_theme_options[share_portfolio_goo]" value="true" <?php echo ( 'true' == $options['share_portfolio_goo'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//LINKEDIN
										if (!isset($options['share_portfolio_lnk']))
											$options['share_portfolio_lnk']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">LinkedIn</div>
											<input type="checkbox" name="samba_theme_options[share_portfolio_lnk]" name="samba_theme_options[share_portfolio_lnk]" value="true" <?php echo ( 'true' == $options['share_portfolio_lnk'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//PINTEREST
										if (!isset($options['share_portfolio_pin']))
											$options['share_portfolio_pin']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Pinterest</div>
											<input type="checkbox" name="samba_theme_options[share_portfolio_pin]" name="samba_theme_options[share_portfolio_pin]" value="true" <?php echo ( 'true' == $options['share_portfolio_pin'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//STUMBLEUPON
										if (!isset($options['share_portfolio_stu']))
											$options['share_portfolio_stu']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">StumbleUpon</div>
											<input type="checkbox" name="samba_theme_options[share_portfolio_stu]" name="samba_theme_options[share_portfolio_stu]" value="true" <?php echo ( 'true' == $options['share_portfolio_stu'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//TWITTER
										if (!isset($options['share_portfolio_twt']))
											$options['share_portfolio_twt']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Twitter</div>
											<input type="checkbox" name="samba_theme_options[share_portfolio_twt]" name="samba_theme_options[share_portfolio_twt]" value="true" <?php echo ( 'true' == $options['share_portfolio_twt'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									</table>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                            </p>
                        </div><!-- samba_tab_options -->
                        <!--BLOG PAGE-->
                        <div id="pirenko_blog_options" class="samba_tab_options">
                                <tr><td colspan="2"><h2><?php _e('Blog Options','samba_lang'); ?></h2></td></tr>
                                  <?php
									//ARCHIVES PAGE TEMPLATE
									?>
									<h4><?php _e( 'Blog categories page template?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[archives_type]">
												<?php    
													foreach ( $archives_options as $option ) 
													{
														$label = $option['label'];
														if ( $options['archives_type'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'This layout will be used for blog archives pages.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
								 //FORCE IMAGE RESIZE
                                ?>
                                <h4><?php _e( 'Force images to have the same height?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[forcesize_news]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['forcesize_news'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'Applicable only for Classic Blog pages.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
								 //SHOW POSTED BY ON NEWS
                                ?>
                                    	<h4><?php _e( 'Show "Posted by" text on blog?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[postedby_news]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['postedby_news'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
								 //SHOW CATEGORIES ON BLOG
                                ?>
                                    	<h4><?php _e( 'Show post categories text on blog?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[categoriesby_news]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['categoriesby_news'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                   </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
	                             <?php
									 //SHOW LIKE BUTTON
									?>
									<h4><?php _e( 'Show heart/like button on single pages?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[show_heart_blog]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['show_heart_blog'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'Will be displayed on single pages near the social sharing links.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>                            
	                            <?php
									 //SHOW RELATED POSTS
									?>
									<h4><?php _e( 'Show previous and next posts link?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[related_blog]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['related_blog'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'Will be displayed after the post content.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
	                            <?php
									 //SHOW AUTHOR INFO
									?>
									<h4><?php _e( 'Show author info under post?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[related_author]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														
														if ( $options['related_author'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'Will be displayed between the post content and the comments section. This info is set up under Users>Profile', 'samba_lang' ); ?></em></p>
		                                </div>
	                                	<div class="clear"></div>
	                            	</div>
                                  
                                <?php
									//SOCIAL NETWORKS - BLOG
									?>
										<h2><?php _e( 'Social Sharing', 'samba_lang' ); ?></h2>
											<h4><?php _e( 'Show sharing buttons?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
											<select name="samba_theme_options[share_blog]">
												<?php    
													foreach ( $yesno_options as $option ) 
													{
														$label = $option['label'];
														if ( $options['share_blog'] == $option['value'] ) // Make default first in list
															echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
														else
															echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
													}
												?>
											</select>
											<table>
												<?php
										//DELICIOUS
										if (!isset($options['share_blog_del']))
											$options['share_blog_del']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Delicious</div>
											<input type="checkbox" name="samba_theme_options[share_blog_del]" name="samba_theme_options[share_blog_del]" value="true" <?php echo ( 'true' == $options['share_blog_del'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//FACEBOOK
										if (!isset($options['share_blog_fb']))
											$options['share_blog_fb']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Facebook</div>
											<input type="checkbox" name="samba_theme_options[share_blog_fb]" name="samba_theme_options[share_blog_fb]" value="true" <?php echo ( 'true' == $options['share_blog_fb'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//GOOGLE+
										if (!isset($options['share_blog_goo']))
											$options['share_blog_goo']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Google+</div>
											<input type="checkbox" name="samba_theme_options[share_blog_goo]" name="samba_theme_options[share_blog_goo]" value="true" <?php echo ( 'true' == $options['share_blog_goo'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//LINKEDIN
										if (!isset($options['share_blog_lnk']))
											$options['share_blog_lnk']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">LinkedIn</div>
											<input type="checkbox" name="samba_theme_options[share_blog_lnk]" name="samba_theme_options[share_blog_lnk]" value="true" <?php echo ( 'true' == $options['share_blog_lnk'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//PINTEREST
										if (!isset($options['share_blog_pin']))
											$options['share_blog_pin']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Pinterest</div>
											<input type="checkbox" name="samba_theme_options[share_blog_pin]" name="samba_theme_options[share_blog_pin]" value="true" <?php echo ( 'true' == $options['share_blog_pin'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//STUMBLEUPON
										if (!isset($options['share_blog_stu']))
											$options['share_blog_stu']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">StumbleUpon</div>
											<input type="checkbox" name="samba_theme_options[share_blog_stu]" name="samba_theme_options[share_blog_stu]" value="true" <?php echo ( 'true' == $options['share_blog_stu'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
									<?php
										//TWITTER
										if (!isset($options['share_blog_twt']))
											$options['share_blog_twt']='false';
									?>
									<tr>
										<td>
									    	<div class="social_spans">Twitter</div>
											<input type="checkbox" name="samba_theme_options[share_blog_twt]" name="samba_theme_options[share_blog_twt]" value="true" <?php echo ( 'true' == $options['share_blog_twt'] ) ? 'checked="checked"' : ''; ?> />
										</td>
									</tr>
                            </table>
										</div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                            </p>
                        </div><!-- samba_tab_options -->
                        <!-- CONTACT PAGE OPTIONS -->
                        <div id="pirenko_contact_options" class="samba_tab_options">
                                <h2><?php _e( 'Contact Page Options', 'samba_lang' ); ?></h2>
                                <?php
                                    //EMAIL ADDRESS
                                	echo prk_output_option("Receiving email","email_address",45,250,"");
                                	 //TITLE FOR TEXT
                                	echo prk_output_option("Title for right body text","contact-info_title_body",45,250,"This text will be displayed above the Contact Information text block");
                                	//ADDRESS
									?>
									<h4><?php _e('Right body text block', 'samba_lang'); ?></h4>             
	                                    <div class="prk_setting">
		                                	<div class="prk_setting_left">
	                                            <textarea id="samba_theme_options[contact-body]" class="pirenko-large-text" cols="40" rows="3" name="samba_theme_options[contact-body]"><?php echo esc_textarea( $options['contact-body'] ); ?></textarea>
	                                        </div>
			                                <div class="prk_setting_right">
			                                	<p><em><?php _e( '(optional)', 'samba_lang' ); ?></em></p>
			                                </div>
		                                <div class="clear"></div>
		                            </div>
	                                <?php
                                	//TITLE FOR EMAIL FORM
                                	echo prk_output_option("Title for email form","contact-info_title_form",45,250,"");
                                	echo prk_output_option("Contact form shortcode","contact-shortcode",45,250,"If you want to use a custom contact form place the shortcode here. If you are using the Contact Form 7 plugin the theme will apply custom styles to the textfields");
                                	echo "<h2>Contact Information</h2>";
                                	//TITLE CONTACT INFO
                                	echo prk_output_option("Title for right contact info","contact-info_title",45,250,"Will be displayed above the contact information.");
                                	//CONTACT INFORMATION
                                	echo prk_output_option("Company name text","contact-right_header",45,250,"Will be displayed in bold above the address.");
                                ?>
                                <?php
								//ADDRESS
								?>
								<h4><?php _e( 'Address', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                            <textarea id="samba_theme_options[contact-address]" class="pirenko-large-text" cols="40" rows="3" name="samba_theme_options[contact-address]"><?php echo esc_textarea( $options['contact-address'] ); ?></textarea>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
									//TELEPHONE HEADER
									echo prk_output_option("Telephone text","contact-info_tel_h",45,250,"");
									//TELEPHONE
									echo prk_output_option("Telephone number","contact-info_tel",45,250,"");
									//FAX HEADER
									echo prk_output_option("Fax text","contact-info_fax_h",45,250,"");
									//FAX
									echo prk_output_option("Fax number","contact-info_fax",45,250,"");
									//EMAIL HEADER
									echo prk_output_option("Email text","contact-info_email_h",45,250,"");
									//EMAIL HEADER
									echo prk_output_option("Email address","contact-info_email",45,250,"");
								?>
                                <?php
                                //GOOGLE MAPS CODE
                                ?>
                               <h4><?php _e( 'Google maps HTML code', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                     <input id="samba_theme_options[google-maps]" size="45%" type="pirenko-text" name="samba_theme_options[google-maps]" value="<?php echo esc_textarea( $options['google-maps'] ); ?>" />
                                     </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'To get your custom code visit http://maps.google.com/ and select your location. Click on the hyperlink button and copy/paste the code here. You can also place an image using HTML.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                            </p>
                        </div>
                        <!--TRANSLATIONS-->
                        <div id="pirenko_translations_options" class="samba_tab_options">
                                <h2><?php _e( 'Translation Method', 'samba_lang' ); ?></h2>
                                <?php
                                //RIGHT SIDEBAR DEFAULT DISPLAY
                                ?>
                                <h4><?php _e( 'Translate using .mo files?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[theme_translation]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['theme_translation'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'If yes is selected the values below will be ignored. If WPML plugin is active the values below will be overriden too.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
	                            <h2><?php _e( '404 Page', 'samba_lang' ); ?></h2>
	                            <?php
                                    //TITLE TEXT
                                    echo prk_output_option("Page title text","404_title_text",45,250,"");
                                ?>
                                    <?php
                                    //BODY TEXT
                                    ?>
                                    <h4><?php _e( 'Page body text', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                            <textarea id="samba_theme_options[404_body_text]" class="pirenko-large-text" cols="60" rows="10" name="samba_theme_options[404_body_text]"><?php echo esc_textarea( $options['404_body_text'] ); ?></textarea>
                                        </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( 'HTML supported.', 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
	                            <h2><?php _e( 'General Translations', 'samba_lang' ); ?></h2>
								<?php
                                    //SEARCH TIP TEXT
									echo prk_output_option("Search field tip text","search_tip_text",45,250,"");
									echo prk_output_option("Search results page title text","submit_search_res_title",45,250,"");
									echo prk_output_option("Search results - no results found text","submit_search_no_results",45,250,"");
									echo prk_output_option("Load more posts text","load_more",45,250,"");
									echo prk_output_option("No more entries to show text","no_more_text",45,250,"");
									echo prk_output_option("Required text","required_text",45,250,"Used on mandatory fields.");
									echo prk_output_option("Like post text","like_text",45,250,"Shown on the heart tooltip.");
									echo prk_output_option("Already liked post text","already_liked_text",45,250,"Shown on the heart tooltip.");
									echo prk_output_option("Share text","share_text",45,250,"Used near social network sharing buttons.");
									echo prk_output_option("Get in touch text","in_touch_text",45,250,"Used near team member social network buttons.");
									echo "<h2>Blog</h2>";
									echo prk_output_option("Back to Blog button text","to_blog",45,250,"");
									echo prk_output_option("Read more button text","read_more",45,250,"");
									echo prk_output_option("Sticky post text","sticky_text",45,250,"");
									echo prk_output_option("Posted by text","posted_by_text",45,250,"");
									echo prk_output_option("About text","about_author_text",45,250,"Displayed before post author name.");
									echo "<h2>Portfolio</h2>";
									echo prk_output_option("Back to Portfolio button text","to_portfolio",45,250,"");
									echo prk_output_option("Previous Project","prev_prj_text",45,250,"");
									echo prk_output_option("Next Project","next_prj_text",45,250,"");
									echo prk_output_option("Project link button text","launch_text",45,250,"");
									echo prk_output_option("Category description text","skills_text",45,250,"'Skills' is the usual choice.");
									echo prk_output_option("Tag description text","tags_text",45,250,"'Tags' is the usual choice.");
									echo prk_output_option("Client description text","client_text",45,250,"");
									echo prk_output_option("Date text","date_text",45,250,"");
									echo prk_output_option("Related projects text","related_text",45,250,"");
									echo prk_output_option("All text","all_text",45,250,"Portfolio filter - show all button.");
									echo "<h2>Comments</h2>";
									echo prk_output_option("Comments title text","comments_label",45,250,"");
									echo prk_output_option("Zero comments text","comments_no_response",45,250,"");
									echo prk_output_option("One comment text","comments_one_response",45,250,"");
									echo prk_output_option("Multiple comments text","comments_oneplus_response",45,250,"");
									echo "<h2>Respond Section</h2>";
									echo prk_output_option("Reply text","reply_text",45,250,"Used on buttons.");
									echo prk_output_option("Text to ask the user to leave a reply","comments_leave_reply",45,250,"");
									echo prk_output_option("Name input field text","comments_author_text",45,250,"This text will be displayed inside the author input textfield.");
									echo prk_output_option("Email input field text","comments_email_text",45,250,"This text will be displayed inside the email input textfield.");
									echo prk_output_option("URL input field text","comments_url_text",45,250,"This text will be displayed inside the URL input textfield.");
									echo prk_output_option("Comment input textarea text","comments_comment_text",45,250,"This text will be displayed inside the comment input textarea.");
									echo prk_output_option("Submit comment button text","comments_submit",45,250,"");
									echo prk_output_option("Empty text error message","empty_text_error",45,250,"");
									echo prk_output_option("Invalid email error message","invalid_email_error",45,250,"");
									echo prk_output_option("Comment submitted text","comment_ok_message",45,250,"This text is displayed after the comment is submitted.");
                                ?>
                                <h2><?php _e( 'Contact Page email form translations', 'samba_lang' ); ?></h2>
                                <?php
                                    //HELP TEXT ON SUBJECT
                                    echo prk_output_option("Subject help text","contact_subject_text",45,250,"This text will be displayed inside of the subject input textfield. The name and email fields are the same as defined before for the comments section.");
                                    //HELP TEXT ON MESSAGE
                                    echo prk_output_option("Message help text","contact_message_text",45,250,"This text will be displayed inside of the message input textfield.");
                                    //SUBMIT BUTTON TEXT
                                    echo prk_output_option("Submit button text","contact_submit",45,250,"");
                                    //ERROR MESSAGE FOR EMPTY TEXTFIELDS
                                    echo prk_output_option("Error message for empty field","contact_error_text",45,250,"This text will be displayed when a mandatory input field is empty.");
                                    //ERROR MESSAGE FOR INVALID EMAILS
                                    echo prk_output_option("Error message for invalid email","contact_error_email_text",45,250,"This text will be displayed when the entered email is invalid.");
                                    //FEEDBACK - WAIT MESSAGE
                                    echo prk_output_option("Form submission: Wait message","contact_wait_text",45,250,"This text will be displayed right after the send message button is clicked and only until the email is sent.");
                                    //FEEDBACK - EMAIL SENT MESSAGE
                                    echo prk_output_option("Form submission: Ok message","contact_ok_text",45,250,"This text will be displayed after sending the email.");
                                ?>
                        </div><!-- TRANSLATIONS OPTIONS --> 
                        <!-- CUSTOM SCRIPTS -->         
                     	<div id="pirenko_scripts_options" class="samba_tab_options">
                                <h2><?php _e( 'Custom Scripts', 'samba_lang' ); ?></h2>
                                 <?php
                                //ANALYTICS TEXT
                                ?>
                                    <h4><?php _e( 'Google Analytics code', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                    <textarea id="samba_theme_options[ganalytics_text]" class="pirenko-large-text" rows="4" name="samba_theme_options[ganalytics_text]"><?php echo esc_textarea( $options['ganalytics_text'] ); ?></textarea>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                               <?php
                                //CUSTOM CSS
                                ?>
                                <h4><?php _e( 'Custom CSS', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <textarea id="css_text" class="pirenko-large-text" rows="12" name="samba_theme_options[css_text]" value=""><?php echo $options['css_text']; ?></textarea>
                                     </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div> 
                                <?php
                                //CUSTOM JS
                                ?>
                                    <h4><?php _e( 'Custom Javascript', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <textarea id="js_text" class="pirenko-large-text" rows="9" name="samba_theme_options[js_text]" value=""><?php echo $options['js_text']; ?></textarea>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( "Place here some of your own JAVASCRIPT code.<br />Example: alert ('Hello!');<br /><b>IMPORTANT:</b> For object targeting use 'jQuery' prefix instead of the default '$' notation.<br />Example: alert (jQuery(this));", 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                            </p>
                        </div>
                        <?php 
                    	if (PRK_WOO=="true") 
    					{
                    		?>
                    		<div id="pirenko_woo_options" class="samba_tab_options">
                                <h2><?php _e( 'WooCommerce Options', 'samba_lang' ); ?></h2>
                                <?php
                                //RIGHT SIDEBAR DEFAULT DISPLAY
                                ?>
                                <h4><?php _e( 'Display right sidebar by default?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[woo_sidebar_display]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['woo_sidebar_display'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( "This option will apply only to WooCommerce Core Pages that aren't set up using shortcodes. If you want to display/hide a sidebar on a specific page add ?sidebar=y or ?sidebar=n to your link URL", 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                                <?php
                                //SHOW CART ON MENU
                                ?>
                                <h4><?php _e( 'Add Shopping Cart info to the main menu?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[woo_cart_display]">
                                            <?php    
                                                foreach ( $yesno_options_woo as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['woo_cart_display'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em><?php _e( "Will be shown under the shop button", 'samba_lang' ); ?></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
	                            <?php
                                //ALWAYS SHOW CART ON MENU
                                ?>
                                <h4><?php _e( 'Show Shopping Cart info even when it is empty?', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[woo_cart_always_display]">
                                            <?php    
                                                foreach ( $yesno_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['woo_cart_always_display'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
	                            <?php
                                //CART INFO
                                ?>
                                <h4><?php _e( 'Cart button information', 'samba_lang' ); ?></h4>             
                                    <div class="prk_setting">
	                                	<div class="prk_setting_left">
                                        <select name="samba_theme_options[woo_cart_info]">
                                            <?php    
                                                foreach ( $cart_options as $option ) 
                                                {
                                                    $label = $option['label'];
                                                    
                                                    if ( $options['woo_cart_info'] == $option['value'] ) // Make default first in list
                                                        echo "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                    else
                                                        echo "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
		                                <div class="prk_setting_right">
		                                	<p><em></em></p>
		                                </div>
	                                <div class="clear"></div>
	                            </div>
                            <p class="save_options">
                            <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'samba_lang' ); ?>" />
                            </p>
                        </div>
                    		<?php
                    	}
                    ?>
                    <!--ADVANCED-->
                    <div id="pirenko_advanced_options" class="samba_tab_options">
                        <h2><?php _e( 'Advanced', 'samba_lang' ); ?></h2>
						<?php
							echo prk_output_option("Portfolios slug","portfolio_slug",45,250,"");
							echo prk_output_option("Skill slug","skills_slug",45,250,"Portfolio hierarchical category");
							echo prk_output_option("Portfolio tag slug","folio_tags_slug",45,250,"Portfolio non-hierarchical category");
							echo prk_output_option("Slides slug","slides_slug",45,250,"");
							echo prk_output_option("Group slug","groups_slug",45,250,"Slides hierarchical category");
							echo prk_output_option("Members slug","members_slug",45,250,"");
							echo prk_output_option("Team slug","team_slug",45,250,"Members hierarchical category");
						?>
                    </div><!-- ADVANCED OPTIONS --> 
				</form>
				<form name="pirenko_reset_form" method="post" action="?page=theme_options&reset_samba=true">
					<input type="hidden" name="action" value="reset_samba" />
				</form>
				<script language="JavaScript">
                    function go_there()
                    {
                        var where_to=confirm("Are you sure you want to reset all settings?");
                        if (where_to==true)
                        {
                            document.pirenko_reset_form.submit()
                        }
                        else
                        {
                      
                        }
                    }
				</script>
			</div><!-- pirenko_options -->
		</div>
		<?php
	}
	//FUNCTION TO VALIDATE FIELDS IF NECESSARY
	function theme_options_validate( $input ) 
	{
		global $select_options;
	
		return $input;
	}
	