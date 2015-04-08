<?php
/*
Template Name: Page - Classic layout
*/
?>
<?php 
  get_header(); 
  $show_sidebar=$prk_samba_frontend_options['right_sidebar'];
  if ($show_sidebar=="yes")
    $show_sidebar=true;
  else
    $show_sidebar=false;
  $data = get_post_meta( $post->ID, '_custom_meta_theme_page', true );
  $show_title=true;
  $show_slider=false;
  if (!empty($data))
  {
    if (isset($data['alchemy_show_sidebar']) && $data['alchemy_show_sidebar']=="yes") {
      $show_sidebar=true;
    }
    if (isset($data['alchemy_show_sidebar']) && $data['alchemy_show_sidebar']=="no") {
      $show_sidebar=false;
    }
    if (isset($data['alchemy_show_title']) && $data['alchemy_show_title']=="yes") {
        $show_title=false;
    }
    if (isset($data['alchemy_featured_slide'])) {
        $show_slider=$data['alchemy_featured_slide'];
    }
    if (isset($data['alchemy_full_slide']) && $data['alchemy_full_slide']!="")
      $autoplay="true";
    else
      $autoplay="false";
    if (isset($data['alchemy_full_delay']) && $data['alchemy_full_delay']!="")
      $delay=$data['alchemy_full_delay'];
    else
      $delay=$prk_samba_frontend_options['delay_portfolio'];
    $inside_filter="";
    $in_flag=false;
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
<div id="centered_block" class="main_no_sections">
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
    <?php
        if ($show_title==true)
        {
            prk_output_title($data);
            $extra_class=" with_title";
        }
        else
        {
          $extra_class="";
        }
    ?>
    <div id="content">
        <div id="main" role="main" class="main_no_sections prk_theme_page<?php echo $extra_class; ?>">
            <?php
                if ($show_slider=="yes")
                {
                  echo '<div class="prk_featured_flexslider">'; 
                    echo do_shortcode('[prk_slider id="samba_slider-'.get_the_ID().'" category="'.$inside_filter.'" autoplay="'.$autoplay.'" delay="'.$delay.'" sl_size="super_width"]');
                  echo '</div>';
                }
                if ($show_slider=="show_revol")
                {
                  echo '<div class="prk_rv">'; 
                    echo do_shortcode('[rev_slider '.$data['alchemy_revslider'].']');
                  echo '</div>';
                }
                if ($show_sidebar)
                {
                  echo '<div class="prk_inner_block twelve columns centered">';
                  echo '<div class="twelve columns sidebarized">';
                }
                else
                {
                  echo '<div class="unsidebarized">';
                }
                echo '<div class="prk_no_composer">'; 
                while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php
                  echo '<div class="clearfix"></div>';
                  echo '</div>';
                echo '</div>';
              endwhile;
              if ($show_sidebar) 
              {
                  ?>
                <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?> inside right_floated zero_right" role="complementary">
                    <?php get_sidebar(); ?>
                </aside><!-- /#sidebar -->
                 </div>
                <?php
              }
            ?>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php get_footer(); ?>