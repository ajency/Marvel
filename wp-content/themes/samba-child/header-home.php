<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
  <?php
    $count = wp_count_posts('post');
    if ($count->publish > 0)
    {
      echo "\n\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"". get_bloginfo('name') ." Feed\" href=\"". home_url() ."/feed/\">\n";
    }
  global $prk_samba_frontend_options;
  global $retina_device;
  global $prk_translations;
  $prk_samba_frontend_options=get_option('samba_theme_options');
  prk_samba_header();
  global $resp_class;
  $resp_class="";
  if ($prk_samba_frontend_options['responsive']=="true") {
    echo '<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />';
    $resp_class=" samba_responsive";
  }
   ?>
    <link rel="shortcut icon" href="<?php echo $prk_samba_frontend_options['favicon']; ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('samba_theme'.$resp_class); ?>>

<!--home search popup-->
<div class="home_search popup" style="display: none;">
  <div class="searc_head">
    Find your home
    <i class="close-btn"></i>
  </div>
  <!-- <div class="hme_dd lo">
    <select id="home_status2"  class="home_status">
      <option value="" >Status</option>
    </select>
  </div> -->
  <div class="hme_dd wc">
    <select id="home_city2"  class="home_city">
      <option value="" >City</option>
    </select>
  </div>
  <div class="hme_dd lo">
    <select id="home_location2"  class="home_location">
      <option value="">Locality</option>
    </select>
  </div>
  <div class="hme_dd ty">
    <select id="home_type2"  class='home_type'>
      <option value="Type">Type</option>
    </select>
  </div>
  <div class="hme_dd lo">
    <button class="home_btn_sea2 home_btn_search_properties" type="submit">
      <i class="fa fa-search"></i>
    </button>
  </div>
</div>
<!--ends home search popup-->


  <?php
      global $prk_back_css;
      echo $prk_back_css;
    ?>
    <div id="dump"></div>
    <div id="prk_pint" data-media="" data-desc=""></div>
    <div class="ultra_wrapper">
    <div id="wrap" class="container columns extra_pad boxed_lay centered" role="document">
      <div id="prk_responsive_menu">
        <div id="nav-collapsed-icon" data-effect="st-effect-14">
          <div class="prk_menu_block"></div>
          <div class="prk_menu_block"></div>
          <div class="prk_menu_block"></div>
        </div>
        <a href="<?php echo home_url('/'); ?>" class="fade_anchor">
        <div id="responsive_logo_holder">
          <?php
            echo prk_output_small_logo($retina_device);
          ?>
        </div>
        </a>
        <div id="alt_logo_holder" data-effect="st-effect-14">
          <?php
            echo prk_output_alt_logo($retina_device);
          ?>
        </div>

        <a href="#" class="head_enq_ico popmake-give-details" id="">Enquiry</a>

        <div id="back_to_top-collapsed">
          <div class="navicon-arrow-up-2"></div>
        </div>
      </div>
      <div id="body_hider"></div>
    <div id="st-container" class="st-container<?php if ($prk_samba_frontend_options['3d_menu']=="false"){echo ' no-csstransforms3d'; }?>">

    <!-- content push wrapper -->

    <div class="st-pusher">
      <div id="menu_section">
        <div id="logo_holder" class="columns twelve fade_anchor">
                <a href="<?php echo home_url('/'); ?>">
                  <?php
                    echo prk_output_logo($retina_device);
                  ?>
                </a>
            </div>
            <div class="clearfix"></div>
        <div class="opened_menu twelve">
            <nav id="nav-main" class="nav-collapse collapse" role="navigation">
                <div class="nav-wrap">
                      <?php
                          if ( has_nav_menu( 'top_right_navigation' ) )
                          {
                            wp_nav_menu(array('theme_location' => 'top_right_navigation', 'menu_class' => 'sf-menu sf-vertical','link_after' => '','walker' => new rc_scm_walker));
                          }
                      ?>
               </div>
            </nav>
        </div>
        <div class="clearfix"></div>
        <div id="samba_collapse_menu" class="close_flagger">
            <div class="navicon-arrow-left-2"></div>
        </div>
        <div id="height_helper"></div>
          <div class="footer">
            <footer id="content-info" role="contentinfo">
                <div id="footer_bk">
                  <?php
                    if ($prk_samba_frontend_options['bottom_sidebar']=="yes")
                    {
                        ?>
                          <div id="footer_in" style="display: none">
                              <?php
                                  if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-footer')) :
                                  endif;
                              ?>
                              <div class="clearfix"></div>
                          </div>
                        <?php
                    }
                    if ($prk_samba_frontend_options['footer_text']!="" && is_front_page())
                    {
                      ?>
                      <div id="after_widgets">
                        <div id="copy" class="showab769 twelve columns">
                            <?php echo $prk_samba_frontend_options['footer_text']; ?>
                        </div>
                        <div id="back_to_top">
                            <div class="navicon-arrow-up-2">
                            </div>
                        </div>
                          <div class="clearfix"></div>
                      </div>
                      <?php
                    }
                  ?>
                </div>
            </footer>
        </div>
  </div>
   <div class="st-content"><!-- this is the wrapper for the content -->
            <div class="st-content-inner"><!-- extra div for emulating position:fixed of the menu -->
                <!-- the content -->
            </div><!-- /st-content-inner -->
        </div><!-- /st-content -->
</div>
</div>


  <div id="top_bar_wrapper" class="on_blog">
      <div class="fifty_button left_floated">
          <div id="samba_close" class="site_background_colored" title="<?php echo($prk_translations['to_blog']); ?>">
            <div class="navicon-close"></div>
          </div>
      </div>
      <div class="fifty_button left_floated fade_anchor">
          <div id="samba_left" class="left_floated site_background_colored">
            <div class="mover">
              <div id="prk_left_1" class="left_floated navicon-arrow-left-3"></div>
              <div id="prk_left_2" class="left_floated navicon-arrow-left-3 second"></div>
            </div>
          </div>
      </div>
      <div class="fifty_button left_floated fade_anchor">
          <div id="samba_right" class="left_floated site_background_colored">
            <div class="mover">
              <div id="prk_right_1" class="left_floated navicon-arrow-right-3"></div>
              <div id="prk_right_2" class="left_floated navicon-arrow-right-3 second"></div>
            </div>
          </div>
      </div>
  </div>
  <!-- <div id="prk_ajax_container" data-ajax_path="<?php echo get_template_directory_uri() ?>/inc/ajax-handler.php" data-retina="<?php echo $retina_device; ?>"> -->
