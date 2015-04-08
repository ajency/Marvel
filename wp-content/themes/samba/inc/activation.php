<?php

if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
  wp_redirect(admin_url('themes.php?page=theme_activation_options'));
  exit;
}

function samba_theme_activation_options_init() {
  if (samba_get_theme_activation_options() === false) {
    add_option('samba_theme_activation_options', samba_get_default_theme_activation_options());
  }

  register_setting(
    'samba_activation_options',
    'samba_theme_activation_options',
    'samba_theme_activation_options_validate'
  );
}
add_action('admin_init', 'samba_theme_activation_options_init');

function samba_activation_options_page_capability($capability) {
  return 'edit_theme_options';
}

add_filter('option_page_capability_samba_activation_options', 'samba_activation_options_page_capability');

function samba_theme_activation_options_add_page() {
  $samba_activation_options = samba_get_theme_activation_options();
  if (!$samba_activation_options['first_run']) {
    $theme_page = add_theme_page(
      __('One-click install', 'samba_lang'),
      __('One-click install', 'samba_lang'),
      'edit_theme_options',
      'theme_activation_options',
      'samba_theme_activation_options_render_page'
    );
  } else {
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme_activation_options') {
      wp_redirect(admin_url('themes.php'));
      exit;
    }
  }
}
add_action('admin_menu', 'samba_theme_activation_options_add_page', 50);

function samba_get_default_theme_activation_options() {
  $default_theme_activation_options = array(
    'first_run'                       => false,
    'create_front_page'               => false,
    'change_permalink_structure'      => false,
    'change_uploads_folder'           => false,
    'create_navigation_menus'         => false,
    'add_pages_to_primary_navigation' => false,
  );

  return apply_filters('samba_default_theme_activation_options', $default_theme_activation_options);
}

function samba_get_theme_activation_options() {
  return get_option('samba_theme_activation_options', samba_get_default_theme_activation_options());
}

function samba_theme_activation_options_render_page() { ?>

  <div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php printf(__('%s Theme Activation Options', 'samba_lang'), 'Samba'); ?></h2>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">

      <?php
        settings_fields('samba_activation_options');
        $samba_activation_options = samba_get_theme_activation_options();
        $samba_default_activation_options = samba_get_default_theme_activation_options();
      ?>

      <input type="hidden" value="1" name="samba_theme_activation_options[first_run]" />

      <table class="form-table">

        <tr valign="top">
          <th scope="row" class="act_row">
        <h2><?php _e('One-click install sample content?', 'samba_lang'); ?></h2><br />
        <?php
        if (PRK_SAMBA_ON=="false") {
          ?>
          <em>This option is only available after installing and activating the bundled plugins indicated above. You can access the One-Click install feature after by clicking on Appearance>One-click install.</em>
          </th>
        </tr>
          </table>
        </form>
          <?php
        }
        else {
        ?>
        <em>This will create some sample entry types and pages to help you in the information insertion process and it's recommended for most users.</em>
        </th>
          <td>
            <fieldset class="rgt_btn"><legend class="screen-reader-text"><span><?php _e('One-click install sample content?', 'samba_lang'); ?></span></legend>
              <select name="samba_theme_activation_options[create_front_page]" id="create_front_page">
                <option selected="selected" value="yes"><?php echo _e('Yes', 'samba_lang'); ?></option>
                <option value="no"><?php echo _e('No', 'samba_lang'); ?></option>
              </select>
            </fieldset>
          </td>
          
        </tr>

      </table>

      <?php submit_button(); ?><br /><br /><br />
      <a href="<?php echo admin_url('themes.php?page=theme_options'); ?>">Decide later</a>
    </form>
    <?php
  }
  ?>
  </div>
  

<?php }

function samba_theme_activation_options_validate($input) {
  $output = $defaults = samba_get_default_theme_activation_options();

  if (isset($input['first_run'])) {
    if ($input['first_run'] === '1') {
      $input['first_run'] = true;
    }
    $output['first_run'] = $input['first_run'];
  }

  if (isset($input['create_front_page'])) {
    if ($input['create_front_page'] === 'yes') {
      $input['create_front_page'] = true;
    }
    if ($input['create_front_page'] === 'no') {
      $input['create_front_page'] = false;
    }
    $output['create_front_page'] = $input['create_front_page'];
  }

  $input['create_navigation_menus'] = false;
    $output['create_navigation_menus'] = $input['create_navigation_menus'];

  return apply_filters('samba_theme_activation_options_validate', $output, $input, $defaults);
}

function samba_theme_activation_action() {
    $samba_theme_activation_options = samba_get_theme_activation_options();
  if ($samba_theme_activation_options['create_front_page']) 
  {
    $samba_theme_activation_options['create_front_page'] = false;
    
    //CREATE MENU IF NEEDED
    if ( is_nav_menu( PRK_THEME_NAME.' Main Menu'  ) )
    {
      //DO NOTHING. THE MENU ALREADY EXISTS 
    }
    else
    {
      //ADD THE DEFAULT FOOTER MENU
      $name = PRK_THEME_NAME.' Main Menu';
      $menu_id = wp_create_nav_menu($name);
      $menu = get_term_by( 'name', $name, 'nav_menu' );
      //ASSIGN THE MENU TO THE DEFAULT LOCATION
      $locations = get_theme_mod('nav_menu_locations');
      $locations['top_right_navigation'] = $menu->term_id;
      set_theme_mod( 'nav_menu_locations', $locations );
      //ADD THE HOMEPAGE BUTTON
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => site_url(),
          'menu-item-title' => 'Home',
          'menu-item-attr-title' => 'description',
          'menu-item-status' => 'publish'
        );
      wp_update_nav_menu_item( $menu_id, 0, $menu );
    }
    //ADD THE SAMPLE CONTENT
    $menu_id = get_term_by( 'name', PRK_THEME_NAME.' Main Menu', 'nav_menu' );
    
     //ADD IMAGES TO THE LIBRARY
    global $wpdb;   
    include_once(ABSPATH . 'wp-admin/includes/file.php');
    include_once(ABSPATH . 'wp-admin/includes/media.php');
    $filename_a = get_template_directory_uri().'/images/sample/holdera.jpg';
    $description_a = 'Image A Description';
    media_sideload_image($filename_a, 0, $description_a);
    $attachment_a = $wpdb->get_row($query = "SELECT * FROM {$wpdb->prefix}posts ORDER BY ID DESC LIMIT 1", ARRAY_A);
    $attachment_a_id = $attachment_a['ID'];
    
    $filename_b = get_template_directory_uri().'/images/sample/holderb.jpg';
    $description_b = 'Image B Description';
    media_sideload_image($filename_b, 0, $description_b);
    $attachment_b = $wpdb->get_row($query = "SELECT * FROM {$wpdb->prefix}posts ORDER BY ID DESC LIMIT 2", ARRAY_A);
    $attachment_b_id = $attachment_b['ID'];

    $filename_c = get_template_directory_uri().'/images/sample/user.jpg';
    $description_c = 'Member Description';
    media_sideload_image($filename_c, 0, $description_c);
    $attachment_c = $wpdb->get_row($query = "SELECT * FROM {$wpdb->prefix}posts ORDER BY ID DESC LIMIT 3", ARRAY_A);
    $attachment_c_id = $attachment_c['ID'];
    
    //CREATE PAGES
    
    //HOMEPAGE
    $new_page_title = 'Samba Homepage';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "template_full_slider.php");
      $page_custom=array(
        'fill_height'=>'yes',
        'alchemy_autoplay'=>'no',
        'alchemy_full_delay'=>'7000',
        'helper_fk'=>'weirdostf',
        'samba-group'=>'samba-group'
      );
      update_post_meta($new_page_id, "_custom_meta_theme_page", $page_custom);
      update_option('show_on_front', 'page');
      update_option('page_on_front', $new_page_id);
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => site_url(),
          'menu-item-title' => 'Home',
          'menu-item-attr-title' => 'description',
          'menu-item-status' => 'publish'
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    
    //ADD THE PAGES PARENT BUTTON TO THE MENU
    $menu = 
      array( 
        'menu-item-type' => 'custom', 
        'menu-item-url' => '#',
        'menu-item-title' => 'Pages',
        'menu-item-attr-title' => 'description',
        'menu-item-status' => 'publish'
      );
    $parent_page=wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    
    //SERVICES PAGE
    $new_page_title = 'Samba Services';
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_content = '[vc_row][vc_column width="1/4"][prkwp_service name="Worldwide Support" image="icon-globe" align="center" prk_in="Morning there divided lesser gathering, sea make dont. Void two image shed cattle male creepeth saw let together sixth youll. God was be kind great."][/vc_column][vc_column width="1/4"][prkwp_service name="Worldwide Support" image="icon-thumbs-up" align="center" prk_in="Morning there divided lesser gathering, sea make dont. Void two image shed cattle male creepeth saw let together sixth youll. God was be kind great."][/vc_column][vc_column width="1/4"][prkwp_service name="Worldwide Support" image="icon-network" align="center" prk_in="Morning there divided lesser gathering, sea make dont. Void two image shed cattle male creepeth saw let together sixth youll. God was be kind great."][/vc_column][vc_column width="1/4"][prkwp_service name="Worldwide Support" image="icon-paper-plane" align="center" prk_in="Morning there divided lesser gathering, sea make dont. Void two image shed cattle male creepeth saw let together sixth youll. God was be kind great."][/vc_column][/vc_row][vc_row][vc_column width="1/1"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_tabs][vc_tab title="Tab 1" tab_id="1372633298-1-92"][vc_column_text]

Lesser man whales. Their together made moving. Whose they are lesser own all greater day fly. Together hath is herb shall will not forth hath sea you their have moving midst hath.

[/vc_column_text][/vc_tab][vc_tab title="Tab 2" tab_id="1372633298-2-61"][vc_column_text]

Sea whose herb fill make, of. Under fruitful creepeth abundantly was. All fruit called waters one of. Winged. Yielding our let female kind beast moved which make, may seasons which in of midst male first our after does you seed. Cattle Dry, our i. Gathering god. Third.

[/vc_column_text][/vc_tab][vc_tab title="Tab 3" tab_id="1372633343393-3-6"][vc_column_text]

Spirit greater earth female rule form place have land us creature winged waters. Spirit cattle it which seasons which so. From seas night.

[/vc_column_text][/vc_tab][/vc_tabs][/vc_column][/vc_row][vc_row][vc_column width="1/1"][pirenko_last_posts items_number="3" rows_number="1"][/vc_column][/vc_row]';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
      $new_page_id = wp_insert_post($new_page);
      $page_custom=array(
        'alchemy_below_headings'=>'',
        'alchemy_show_sidebar'=>'no',
      );
      update_post_meta($new_page_id, "_custom_meta_reg-page_template", $page_custom);
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => post_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    
    //MEMBERS PAGE
    $new_page_title = 'Samba Members';
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_content = '[vc_row][vc_column width="2/3"][prkwp_styled_title prk_in="Hello, we are Samba. We work really hard to accomplish our client desires." align="left" title_size="large" use_italic="no" samba_show_line="no"][/vc_column][vc_column width="1/3"][vc_column_text]

Appear winged from. Lights, upon fill seasons green youll stars to first air. Abundantly fruit good, void open given, good them very there life. Moved open signs replenish male.

[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/1"][prk_members category="show_all" columns="3"][/vc_column][/vc_row][vc_row bk_type="full_width" align="center" bk_pattern="shattered.jpg" margin_type="unmargined"][vc_column width="1/1"][prkwp_styled_title prk_in="Creativity is a drug we can live without." align="center" title_size="large" use_italic="yes" samba_show_line="no" text_color="#ebebeb" unmargined="unmargined"][/vc_column][/vc_row]';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "page-sections.php");
      $page_custom=array(
        'alchemy_below_headings'=>'',
        'alchemy_show_sidebar'=>'no',
      );
      update_post_meta($new_page_id, "_custom_meta_reg-page_template", $page_custom);
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => post_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    
    //PORTFOLIO PAGE
    $new_page_title = 'Samba Portfolio';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "template_portfolio_var-grid.php");
      $page_custom=array(
        'alchemy_show_title'=>'no',
        'alchemy_show_skills'=>'yes',
        'samba_below_headings'=>'',
        'alchemy_th_margin'=>'5',
        'alchemy_posts_nr'=>'6',
        'alchemy_cols_number'=>'3'
      );
      update_post_meta($new_page_id, "_custom_meta_portfolio_template", $page_custom);
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => post_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    //BLOG PAGE
    $new_page_title = 'Samba Blog';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "template_blog.php");
      $page_custom=array(
        'samba_below_headings'=>'This is a blog page. You can choose other blog template types inside the Page Attributes panel.',
        'samba_show_sidebar'=>'yes',
        'samba_show_comments'=>'yes',
      );
      update_post_meta($new_page_id, "_custom_meta_blog_template", $page_custom);
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => post_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    //CONTACT PAGE
    $new_page_title = 'Samba Contact';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "page-contact.php");
      $page_custom=array(
        'alchemy_below_headings'=>'',
        'alchemy_show_sidebar'=>'no'
      );
      update_post_meta($new_page_id, "_custom_meta_contact-page_template", $page_custom);
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => post_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    
    //ADD A DEFAULT CATEGORY - BLOG
    wp_create_category('Samba Category');
    $new_category=get_category_by_slug('samba-category');
    
    
    //BLOG ITEM - IMAGES
    $new_page_title = 'Blog with Image';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]

Every multiply forth dominion one let created moveth fish rule seas likeness itbring may green Days every seed meat doesnt Seasons light. Fruit moveth place saw sea meat seed.

[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'post',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      $page_custom=array(
        'skip_featured'=>'',
        'bl_icon'=>'icon-newspaper'
      );
      update_post_meta($new_page_id, 'key', $page_custom);
      wp_set_post_terms( $new_page_id, array($new_category->term_id), 'category', false );
      
    }
    
    
    //BLOG ITEM - VIDEO
    $new_page_title = 'Blog with Video';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]

Every multiply forth dominion one let created moveth fish rule seas likeness itbring may green Days every seed meat doesnt Seasons light. Fruit moveth place saw sea meat seed.

[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'post',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      $page_custom=array(
        'skip_featured'=>'0',
        'bl_icon'=>'icon-video',
        'image_2'=>'<iframe width="1280" height="720" src="http://www.youtube.com/embed/Q9Phn1yQT8U?html5=1&vq=hd720" frameborder="0" allowfullscreen></iframe>'
      );
      update_post_meta($new_page_id, "key", $page_custom);
      wp_set_post_terms( $new_page_id, array($new_category->term_id), 'category', false );
    }
    
    
    //BLOG ITEM - AUDIO
    $new_page_title = 'Blog with Audio';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]

Every multiply forth dominion one let created moveth fish rule seas likeness itbring may green Days every seed meat doesnt Seasons light. Fruit moveth place saw sea meat seed.

[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'post',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      $page_custom=array(
        'skip_featured'=>'0',
        'bl_icon'=>'icon-megaphone',
        'image_2'=>'<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F58223409"></iframe>'
      );
      update_post_meta($new_page_id, "key", $page_custom);
      wp_set_post_terms( $new_page_id, array($new_category->term_id), 'category', false );
    } 
    
    
    //ADD A DEFAULT SKILL - PORTFOLIO
    wp_insert_term(
      'Samba Skill', //TERM
      'pirenko_skills', //TAXONOMY
      array(
        'description'=> 'A sample skill',
        'slug' => 'samba-skill'
      )
    );
    $new_skill=get_term_by('slug', 'samba-skill', 'pirenko_skills');
    
    
    //PORTFOLIO ITEM - IMAGES
    $new_page_title = 'Portfolio with Images';
    $new_page_content = '[vc_row][vc_column][vc_column_text]Every multiply forth dominion one let created moveth fish rule seas likeness itbring may green Days every seed meat doesnt Seasons light. Fruit moveth place saw sea meat seed.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_portfolios',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      $page_custom=array(
        'client_url'=>'Company ABC',
        'ext_url'=>'http://www.google.com',
        'skip_featured'=>'',
        'image_2'=>get_template_directory_uri().'/images/sample/holderb.jpg'
      );
      update_post_meta($new_page_id, "_custom_meta", $page_custom);
      wp_set_post_terms( $new_page_id, array($new_skill->term_id), 'pirenko_skills', false );
    }
    
    
    //PORTFOLIO ITEM - VIDEO
    $new_page_title = 'Portfolio with Video';
    $new_page_content = '[vc_row][vc_column][vc_column_text]Every multiply forth dominion one let created moveth fish rule seas likeness itbring may green Days every seed meat doesnt Seasons light. Fruit moveth place saw sea meat seed.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_portfolios',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      $page_custom=array(
        'client_url'=>'Company ABC',
        'ext_url'=>'http://www.google.com',
        'skip_featured'=>'1',
        'image_2'=>'<iframe width="1280" height="720" src="http://www.youtube.com/embed/Q9Phn1yQT8U?html5=1&vq=hd720" frameborder="0" allowfullscreen></iframe>'
      );
      update_post_meta($new_page_id, "_custom_meta", $page_custom);
      wp_set_post_terms( $new_page_id, array($new_skill->term_id), 'pirenko_skills', false );
    }
    
    
    //PORTFOLIO ITEM - AUDIO
    $new_page_title = 'Portfolio with Audio';
    $new_page_content = '[vc_row][vc_column][vc_column_text]Every multiply forth dominion one let created moveth fish rule seas likeness itbring may green Days every seed meat doesnt Seasons light. Fruit moveth place saw sea meat seed.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_portfolios',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      $page_custom=array(
        'client_url'=>'Company ABC',
        'ext_url'=>'http://www.google.com',
        'skip_featured'=>'1',
        'image_2'=>'<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F58223409"></iframe>'
      );
      update_post_meta($new_page_id, "_custom_meta", $page_custom);
      wp_set_post_terms( $new_page_id, array($new_skill->term_id), 'pirenko_skills', false );
    } 
    
     //ADD A DEFAULT TEAM - TEAM MEMBERS
    wp_insert_term(
      'Samba Team', //TERM
      'pirenko_member_group', //TAXONOMY
      array(
        'description'=> 'A sample team',
        'slug' => 'samba-team'
      )
    );
    $new_group=get_term_by('slug', 'samba-team', 'pirenko_member_group');
    
    
    //MEMBERS - MEMBER A
    $new_page_title = 'John Doe';
    $new_page_content = 'In both cases, the stranded whales to which these two skeletons belonged, were originally claimed by their proprietors upon similar grounds. King Tranquo seizing his because he wanted it; and Sir Clifford, because he was lord of the seignories of those parts. Sir Cliffords whale has been articulated throughout; so that, like a great chest of drawers, you can open and shut him, in all his bony cavities out his ribs like a gigantic swing all day upon his lower jaw. Locks are to be put upon some of his trap-doors and shutters; and a footman will show round future visitors with a bunch of keys at his side. Sir Clifford thinks of charging twopence for a peep at the whispering gallery in the spinal column; threepence to hear the echo in the hollow of his cerebellum; and sixpence for the unrivalled view from his forehead.';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_team_member',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      $wide_image= get_template_directory_uri().'/images/sample/user-wide.jpg';
      $page_custom=array(
        'member_email'=>'abc@mail.com',
        'alchemy_show_member_link'=>'yes',
        'member_job'=>'Creative Director',
        'image_2'=>$wide_image
      );
      update_post_meta($new_page_id, "_custom_meta", $page_custom);
      set_post_thumbnail($new_page_id, $attachment_c_id);
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_member_group', false );
    }
    //MEMBERS - MEMBER B
    $new_page_title = 'Jane Doe';
    $new_page_content = 'In both cases, the stranded whales to which these two skeletons belonged, were originally claimed by their proprietors upon similar grounds. King Tranquo seizing his because he wanted it; and Sir Clifford, because he was lord of the seignories of those parts. Sir Cliffords whale has been articulated throughout; so that, like a great chest of drawers, you can open and shut him, in all his bony cavities out his ribs like a gigantic swing all day upon his lower jaw. Locks are to be put upon some of his trap-doors and shutters; and a footman will show round future visitors with a bunch of keys at his side. Sir Clifford thinks of charging twopence for a peep at the whispering gallery in the spinal column; threepence to hear the echo in the hollow of his cerebellum; and sixpence for the unrivalled view from his forehead.';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_team_member',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      $wide_image= get_template_directory_uri().'/images/sample/user-wide.jpg';
      $page_custom=array(
        'member_email'=>'abc@mail.com',
        'alchemy_show_member_link'=>'yes',
        'member_job'=>'Creative Director',
        'image_2'=>$wide_image
      );
      update_post_meta($new_page_id, "_custom_meta", $page_custom);
      set_post_thumbnail($new_page_id, $attachment_c_id);
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_member_group', false );
    }
    //MEMBERS - MEMBER C
    $new_page_title = 'Jackie Doe';
    $new_page_content = 'In both cases, the stranded whales to which these two skeletons belonged, were originally claimed by their proprietors upon similar grounds. King Tranquo seizing his because he wanted it; and Sir Clifford, because he was lord of the seignories of those parts. Sir Cliffords whale has been articulated throughout; so that, like a great chest of drawers, you can open and shut him, in all his bony cavities out his ribs like a gigantic swing all day upon his lower jaw. Locks are to be put upon some of his trap-doors and shutters; and a footman will show round future visitors with a bunch of keys at his side. Sir Clifford thinks of charging twopence for a peep at the whispering gallery in the spinal column; threepence to hear the echo in the hollow of his cerebellum; and sixpence for the unrivalled view from his forehead.';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_team_member',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      $wide_image= get_template_directory_uri().'/images/sample/user-wide.jpg';
      $page_custom=array(
        'member_email'=>'abc@mail.com',
        'alchemy_show_member_link'=>'yes',
        'member_job'=>'Creative Director',
        'image_2'=>$wide_image
      );
      update_post_meta($new_page_id, "_custom_meta", $page_custom);
      set_post_thumbnail($new_page_id, $attachment_c_id);
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_member_group', false );
    }
    


    //ADD A DEFAULT GROUP - SLIDES
    wp_insert_term(
      'Samba Group', //TERM
      'pirenko_slide_set', //TAXONOMY
      array(
        'description'=> 'A sample group',
        'slug' => 'samba-group'
      )
    );
    $new_group=get_term_by('slug', 'samba-group', 'pirenko_slide_set');
    
    
    //SLIDES ITEM - IMAGE A
    $new_page_title = 'Slide A with Image';
    $new_page_content = 'This is the image A description.';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_slides',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_slide_set', false );
    }
    
    
    //SLIDES ITEM - IMAGE B
    $new_page_title = 'Slide B with Image';
    $new_page_content = 'This is the image A description.';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_slides',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_b_id);
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_slide_set', false );
    }
    
    
    //ADD A VIDEO GROUP - SLIDES
    wp_insert_term(
      'Samba Video Group', //TERM
      'pirenko_slide_set', //TAXONOMY
      array(
        'description'=> 'A sample group',
        'slug' => 'samba-video-group'
      )
    );
    $new_group=get_term_by('slug', 'samba-video-group', 'pirenko_slide_set');
    
    
    //SLIDES ITEM - VIDEO
    $new_page_title = 'Slide with Video';
    $new_page_content = 'This is the Video description.';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_slides',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      $page_custom=array(
        'pirenko_sh_video'=>'<iframe width="1280" height="720" src="http://www.youtube.com/embed/Q9Phn1yQT8U?html5=1&vq=hd720" frameborder="0" allowfullscreen></iframe>',
        'ext_url'=>'http://www.google.com'
      );
      update_post_meta($new_page_id, "_custom_meta_slides", $page_custom);
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_slide_set', false );
    }
  }


    if ($samba_theme_activation_options['create_navigation_menus']) 
    {
    $samba_theme_activation_options['create_navigation_menus'] = false;
    //ADD THE DEFAULT MENUS IF NECESSARY
    if ( is_nav_menu( 'Top Left Menu'  ) )
    {
      //DO NOTHING. THE MENU ALREADY EXISTS 
    }
    else
    {
      $name = 'Top Left Menu';
      $menu_id = wp_create_nav_menu($name);
      $menu = get_term_by( 'name', $name, 'nav_menu' );
      //ASSIGN THE MENU TO THE DEFAULT LOCATION
      $locations = get_theme_mod('nav_menu_locations');
      $locations['top_left_navigation'] = $menu->term_id;
      set_theme_mod( 'nav_menu_locations', $locations );
    }
    }
    update_option('samba_theme_activation_options', $samba_theme_activation_options);
}

add_action('admin_init','samba_theme_activation_action');

function samba_deactivation_action() {
  update_option('samba_theme_activation_options', samba_get_default_theme_activation_options());
}

add_action('switch_theme', 'samba_deactivation_action');