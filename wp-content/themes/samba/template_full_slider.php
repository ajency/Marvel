<?php
/*
Template Name: Page - Fullscreen Slider
*/
?>
<?php 
  get_header(); 
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
        </div>
    </div>
</div>
</div>
<?php get_footer(); ?>