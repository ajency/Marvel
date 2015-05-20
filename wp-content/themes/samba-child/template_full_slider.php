<?php
/*
Template Name: Page - Fullscreen Slider
*/
?>
<?php
  if (is_front_page()) {
    get_header('home');
  } else {
    get_header();
  }

  $data = get_post_meta( $post->ID, '_custom_meta_theme_page', true );
  $show_slider=true;
    if (isset($data['alchemy_autoplay']) && $data['alchemy_autoplay']!="")
      $autoplay="true";
    else
      $autoplay="false";
    if (isset($data['alchemy_full_delay']) && $data['alchemy_full_delay']!="")
      $delay=$data['alchemy_full_delay'];
    else
      $delay=$prk_samba_frontend_options['delay_portfolio'];
    if (isset($data['alchemy_hover']) && $data['alchemy_hover']!="")
      $hover_behave="false";
    else
      $hover_behave="true";
  $fill_height="super_height zero_shadow";
  $inside_filter="";
  $in_flag=false;
   if ($data!="") {
    foreach ($data as $childs)
    {
      //ADD THE CATEGORIES TO THE FILTER
      if ($in_flag==true)
      {
        $inside_filter.=$childs.", ";
      }
      if ($childs=='weirdostf')
        $in_flag=true;
    }
  }
?>
<div id="centered_block">
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
    <div id="content">
        <div id="main" role="main" class="main_with_sections">
            <?php
                if ($show_slider=="yes")
                {
                    echo do_shortcode('[prk_slider id="samba_slider-'.get_the_ID().'" category="'.$inside_filter.'" autoplay="'.$autoplay.'" delay="'.$delay.'" sl_size="'.$fill_height.'" hover="'.$hover_behave.'"]');
                }
                ?>
            <div class="clearfix"></div>
            <div id="full_slider_page_content" class="prk_no_composer show_later">
              <?php
                while (have_posts()) : the_post();
                  the_content();
                endwhile;
              ?>
           <div class="clearfix"></div>
            </div>

            <div class="home_search">
              <div class="hme_dd wc">
                <select id="home_city">
                  <option value="Pune">Pune</option>
                  <option value="Bangalore">Bangalore</option>
                </select>
              </div>
              <div class="hme_dd lo">
                <select id="home_location">
                  <option value="Locality">Locality</option>
                  <option value="Locality">Locality</option>
                </select>
              </div>
              <div class="hme_dd ty">
                <select id="home_type">
                  <option value="Type">Type</option>
                  <option value="3_BHK">3 BHK</option>
                </select>
              </div>
              <div class="hme_dd lo">
                <button class="home_btn_sea" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>

        </div>
    </div>
</div>
</div>
<?php
  if (is_front_page()) {
    get_footer('home');
  } else {
    get_footer();
  }
?>