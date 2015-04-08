<?php
	
	$prk_samba_slug_options=get_option('samba_theme_options');

	//-------------------------
	//CREATE SLIDES CUSTOM TYPE
	//-------------------------
	function slides_register() 
	{
 		$prk_samba_slug_options=get_option('samba_theme_options');
 		if (!isset($prk_samba_slug_options['slides_slug']) || $prk_samba_slug_options['slides_slug']=="")
 			$prk_samba_slug_options['slides_slug']="slides";
		$labels = array(
			'name' => __('Slides', 'samba_lang'),
			'all_items' => __('All Slides', 'samba_lang'),
			'singular_name' => __('Slide',  'samba_lang'),
			'add_new' => __('Add New Slide', 'samba_lang'),
			'add_new_item' => __('Add New Slide', 'samba_lang'),
			'edit_item' => __('Edit Slide', 'samba_lang'),
			'new_item' => __('New Slide', 'samba_lang'),
			'view_item' => __('View Slide', 'samba_lang'),
			'search_items' => __('Search Slides', 'samba_lang'),
			'not_found' =>  __('Nothing found', 'samba_lang'),
			'not_found_in_trash' => __('Nothing found in Trash', 'samba_lang'),
			'parent_item_colon' => ''
		);
 		if ( get_bloginfo('version')>='3.8' ) {
		   $args = array(
		   		'exclude_from_search' => true,
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => '',
				'rewrite' => array('slug' => $prk_samba_slug_options['slides_slug']),
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor','thumbnail')
			);
		}
		else
		{
			$args = array(
				'exclude_from_search' => true,
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => SAMBA_PLUGIN_URL . 'images/admin/menu.png',
				'rewrite' => array('slug' => $prk_samba_slug_options['slides_slug']),
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title','editor','thumbnail')
			);
		}
		register_post_type( 'pirenko_slides' , $args );

		//ADD TAXONOMIES FOR SLIDES
		$labels_pir_categories = array(
			'name' => __('Groups', 'samba_lang'),
			'all_items' => __('All Groups', 'samba_lang'),
			'add_new_item' => __('Add New Group', 'samba_lang'),
			'new_item_name' => __('New Group Name', 'samba_lang'),
			'edit_item' => __("Edit Group", "samba_lang")
		);

		$prk_samba_slug_options=get_option('samba_theme_options');
		if (!isset($prk_samba_slug_options['groups_slug']) || $prk_samba_slug_options['groups_slug']=="")
			$prk_samba_slug_options['groups_slug']="group";
		$args_pir_categories = array(
			'labels' => $labels_pir_categories,
			'rewrite' => array('slug' => $prk_samba_slug_options['groups_slug']),
			'hierarchical' => true
		);
		
		register_taxonomy( 'pirenko_slide_set', 'pirenko_slides', $args_pir_categories );
	}
	
	//ADD MORE COLUMNS FOR THE DASHBOARD VIEW
	
	//ADD HOOKS
	add_filter('manage_pirenko_slides_posts_columns', 'pirenko_columns_head_only_slides', 10);
	add_action('manage_pirenko_slides_posts_custom_column', 'pirenko_columns_content_only_slides', 10, 2);
	//RESORT COLUMNS
	function pirenko_columns_head_only_slides($defaults) 
	{
		unset($defaults['date']);
		$defaults['set']="Group";
		$defaults['featured_image'] = 'Featured Image';
		$defaults['date']="Date";
		return $defaults;
	}
	//FILL SPECIAL COLUMNS
	function pirenko_columns_content_only_slides($column_name, $post_ID) 
	{
		global $post;
		if ($column_name == 'featured_image') 
		{  
			$post_featured_image = pirenko_get_featured_image($post_ID);  
			if ($post_featured_image) {  
				// HAS A FEATURED IMAGE  
				echo '<img class="slides_image_preview" src="' . $post_featured_image . '" />';  
			}  
			else {  
				// NO FEATURED IMAGE, SHOW THE DEFAULT ONE  
				echo ("No image");
			}  
		}
		if ($column_name == 'set') 
		{ 
			{
				$terms = get_the_terms( $post_ID, 'pirenko_slide_set' );
				if ( !empty( $terms ) ) 
				{
					$out = array();
					foreach ( $terms as $term ) 
					{
						$out[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'pirenko_slide_set' => $term->slug ), 'edit.php' ) ),
							esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'pirenko_slide_set', 'display' ) )
						);
					}
					//JOIN THE TERMS SEPARATED BY A COMMA
					echo join( ', ', $out );	
				}
			}
		}
	}

	//CREATE SLIDER ITEMS POST TYPE
	add_action('init', 'slides_register',5);


	//-------------------------
	//CREATE PORTFOLIO CUSTOM TYPE
	//-------------------------
	function portfolio_register() 
	{
		$prk_samba_slug_options=get_option('samba_theme_options');
		if (!isset($prk_samba_slug_options['portfolio_slug']) || $prk_samba_slug_options['portfolio_slug']=="")
			$prk_samba_slug_options['portfolio_slug']="portfolios";
		$labels = array(
			'add_new_item' => __('Add Portfolio Item', 'samba_lang'),
			'edit_item' => __('Edit Portfolio Item', 'samba_lang'),
			'new_item' => __('New Portfolio Item', 'samba_lang'),
			'view_item' => __('Preview Portfolio Item', 'samba_lang'),
			'search_items' => __('Search Portfolio Items', 'samba_lang'),
			'not_found' => __('No Portfolio items found.', 'samba_lang'),
			'not_found_in_trash' => __('No Portfolio items found in Trash.', 'samba_lang')
		);	
		if ( get_bloginfo('version')>='3.8' ) {
		   register_post_type('pirenko_portfolios', array(
				'label' => __('Portfolio Items', 'samba_lang'),
				'labels' => array('all_items' => __('All Portfolios', 'samba_lang')),
				'singular_label' => __('Portfolio Item', 'samba_lang'),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $prk_samba_slug_options['portfolio_slug']),
				'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'comments','custom-fields'), // Let's use custom fields for debugging purposes only
				'menu_icon' => '',
			));
		}
		else
		{
			register_post_type('pirenko_portfolios', array(
				'label' => __('Portfolio Items', 'samba_lang'),
				'labels' => array('all_items' => __('All Portfolios', 'samba_lang')),
				'singular_label' => __('Portfolio Item', 'samba_lang'),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $prk_samba_slug_options['portfolio_slug']),
				'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'comments','custom-fields'), // Let's use custom fields for debugging purposes only
				'menu_icon' => SAMBA_PLUGIN_URL . 'images/admin/portfolio.png',
			));
		}

		//ADD TAXONOMIES SIMILAR TO A CATEGORY
		$labels_pir_categories = array(
			'name' => __('Skills', 'samba_lang'),
			'all_items' => __('All Skills', 'samba_lang'),
			'add_new_item' => __('Add New Skill', 'samba_lang'),
			'new_item_name' => __('New Skill Name', 'samba_lang'),
			'edit_item' => __("Edit Skill", "samba_lang")
		);

		if (!isset($prk_samba_slug_options['skills_slug']) || $prk_samba_slug_options['skills_slug']=="")
			$prk_samba_slug_options['skills_slug']="skills";
		$args_pir_categories = array(
			'labels' => $labels_pir_categories,
			'rewrite' => array('slug' => $prk_samba_slug_options['skills_slug']),
			'hierarchical' => true,
			'query_var' => true,
		);	
		register_taxonomy( 'pirenko_skills', 'pirenko_portfolios', $args_pir_categories );

		//ADD TAXONOMIES SIMILAR TO TAGS
		  $labels = array(
			'name' => __( 'Tags', 'taxonomy general name', 'samba_lang' ),
			'singular_name' => __( 'Tag', 'taxonomy singular name', 'samba_lang' ),
			'search_items' =>  __( 'Search Tags', 'samba_lang' ),
			'popular_items' => __( 'Popular Tags', 'samba_lang' ),
			'all_items' => __( 'All Tags', 'samba_lang' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Tag', 'samba_lang' ), 
			'update_item' => __( 'Update Tag', 'samba_lang' ),
			'add_new_item' => __( 'Add New Tag', 'samba_lang' ),
			'new_item_name' => __( 'New Tag Name', 'samba_lang' ),
			'separate_items_with_commas' => __( 'Separate Tags with commas', 'samba_lang' ),
			'add_or_remove_items' => __( 'Add or remove Tags', 'samba_lang' ),
			'choose_from_most_used' => __( 'Choose from the most used Tags', 'samba_lang' ),
			'menu_name' => __( 'Tags', 'samba_lang' ),
		  ); 
		
		if (!isset($prk_samba_slug_options['folio_tags_slug']) || $prk_samba_slug_options['folio_tags_slug']=="")
		{
			$prk_samba_slug_options['folio_tags_slug']="tagged";
		}
		register_taxonomy('portfolio_tag','pirenko_portfolios',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => $prk_samba_slug_options['folio_tags_slug'] ),
		));
	}
	add_action('init', 'portfolio_register',5);
	//PORTFOLIO ADD MORE COLUMNS FOR THE DASHBOARD VIEW
	//ADD HOOKS
	add_filter('manage_pirenko_portfolios_posts_columns', 'pirenko_columns_head_only_portfolios', 10);
	add_action('manage_pirenko_portfolios_posts_custom_column', 'pirenko_columns_content_only_portfolios', 10, 2);
	//FUNCTION TO RETRIEVE FEATURED IMAGE
	function pirenko_get_featured_image($post_ID) {
		$post_thumbnail_id = get_post_thumbnail_id($post_ID);
		if ($post_thumbnail_id) {
			$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'medium');
			return $post_thumbnail_img[0];
		}
	}
	//RESORT COLUMNS
	function pirenko_columns_head_only_portfolios($defaults) 
	{
		unset($defaults['date']);
		$defaults['set']=__('Skills', 'seven_lang');
		$defaults['featured_image'] = 'Featured Image';
		$defaults['date']="Date";
		return $defaults;
	}
	//FILL SPECIAL COLUMNS
	function pirenko_columns_content_only_portfolios($column_name, $post_ID) 
	{
		global $post;
		if ($column_name == 'featured_image') 
		{  
			$post_featured_image = pirenko_get_featured_image($post_ID);  
			if ($post_featured_image) {  
				// HAS A FEATURED IMAGE  
				echo '<img class="slides_image_preview" src="' . $post_featured_image . '" />';  
			}  
			else {  
				// NO FEATURED IMAGE, SHOW THE DEFAULT ONE  
				echo ("No image");
			}  
		}
		if ($column_name == 'set') 
		{ 
			{
				$terms = get_the_terms( $post_ID, 'pirenko_skills' );
				if ( !empty( $terms ) ) 
				{
					$out = array();
					foreach ( $terms as $term ) 
					{
						$out[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'pirenko_skills' => $term->slug ), 'edit.php' ) ),
							esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'pirenko_skills', 'display' ) )
						);
					}
					//JOIN THE TERMS SEPARATED BY A COMMA
					echo join( ', ', $out );	
				}
			}
		}
	}
	//-------------------------
	//CREATE MEMBERS CUSTOM TYPE
	//-------------------------
	function members_register() 
	{
		$prk_samba_slug_options=get_option('samba_theme_options');
		if (!isset($prk_samba_slug_options['members_slug']) || $prk_samba_slug_options['members_slug']=="")
			$prk_samba_slug_options['members_slug']="member";
		$labels = array(
			'add_new_item' => __('Add Team Member', 'samba_lang'),
			'edit_item' => __('Edit Team Member', 'samba_lang'),
			'new_item' => __('New Team Member', 'samba_lang'),
			'view_item' => __('Preview Team Member', 'samba_lang'),
			'search_items' => __('Search Team Members', 'samba_lang'),
			'not_found' => __('No Team Members found.', 'samba_lang'),
			'not_found_in_trash' => __('No Team Members found in Trash.', 'samba_lang')
		);	
		if ( get_bloginfo('version')>='3.8' ) {
		   register_post_type('pirenko_team_member', array(
				'label' => __('Team Members', 'samba_lang'),
				'labels' => array('all_items' => __('All Members', 'samba_lang')),
				'singular_label' => __('Team Member', 'samba_lang'),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $prk_samba_slug_options['members_slug']),
				'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'comments','custom-fields'), // Let's use custom fields for debugging purposes only
				'menu_icon' => '',
			));
		}
		else
		{
			register_post_type('pirenko_team_member', array(
				'label' => __('Team Members', 'samba_lang'),
				'labels' => array('all_items' => __('All Members', 'samba_lang')),
				'singular_label' => __('Team Member', 'samba_lang'),
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $prk_samba_slug_options['members_slug']),
				'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'comments','custom-fields'), // Let's use custom fields for debugging purposes only
				'menu_icon' => SAMBA_PLUGIN_URL . 'images/admin/user.png',
			));
		}
		//ADD TAXONOMIES SIMILAR TO A CATEGORY
		$labels_pir_categories = array(
			'name' => __('Teams', 'samba_lang'),
			'all_items' => __('All Teams', 'samba_lang'),
			'add_new_item' => __('Add New Team', 'samba_lang'),
			'new_item_name' => __('New Team Name', 'samba_lang'),
			'edit_item' => __("Edit Team", "samba_lang")
		);

		if (!isset($prk_samba_slug_options['team_slug']) || $prk_samba_slug_options['team_slug']=="")
			$prk_samba_slug_options['team_slug']="team";
		$args_pir_categories = array(
			'labels' => $labels_pir_categories,
			'rewrite' => array('slug' => $prk_samba_slug_options['team_slug']),
			'hierarchical' => true
		);
		register_taxonomy('pirenko_member_group', 'pirenko_team_member', $args_pir_categories );
	}
	add_action('init', 'members_register',5);
	

	//EXECUTE THIS ONLY WHEN THE THEME IS ACTIVATED
	function prk_activate_new_post($oldname, $oldtheme=false) {
		portfolio_register();
		slides_register();
		members_register();
		flush_rewrite_rules();

		//TURN OFF CHANGE FLAG
		$options=get_option('samba_theme_options');
		$options['just_saved']="false";
        update_option('samba_theme_options', $options);
	}
	add_action("after_switch_theme", "prk_activate_new_post", 10 ,  2);

	//CHECK IF OPTIONS/SLUGS WERE CHANGED
	if (isset($prk_samba_slug_options['just_saved']) && $prk_samba_slug_options['just_saved']=="true")
	{
		add_action('init', 'prk_activate_new_post');
	}
?>