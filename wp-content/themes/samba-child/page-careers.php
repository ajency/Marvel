<?php
/*
Template Name: Page - Careers
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
  //NEVER SHOW SIDEBAR
  $show_sidebar=false;
?>
<div id="centered_block" class="row">
<div id="main_block" class="block_with_sections page-<?php echo get_the_ID(); ?>">
    <?php
      echo prk_output_featured_image(get_the_ID());
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
        <div id="main" role="main" class="main_with_sections<?php echo $extra_class; ?>">
            <?php
                if ($show_slider=="yes")
                {
                  echo '<div class="prk_featured_flexslider">'; 
                    echo do_shortcode('[prk_slider id="samba_slider-'.get_the_ID().'" category="'.$inside_filter.'" autoplay="'.$autoplay.'" delay="'.$delay.'" sl_size=""]');
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
                  echo '<div class="twelve sidebarized">';
                }
                else
                {
                  echo '<div class="twelve">'; 
                }
                while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
                
                
                <!--Careers Bottom content-->
                <!--Careers Bottom content-->
                
                <div class="prk_inner_block vc_row-fluid centered columns lisofwork">
                    <div class="row">
                        <div class="vc_col-sm-4 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <h3 class="small zero_color header_font">Projects</h3>
                                    <div class="clearfix"></div>
                                    <div class="work_inner_desc">
                                        <p style="text-align: center;">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </p>
                                        <a href="#" class="openings_link">5 Positions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vc_col-sm-4 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <h3 class="small zero_color header_font">Contract &amp; Billing</h3>
                                    <div class="clearfix"></div>
                                    <div class="work_inner_desc">
                                        <p style="text-align: center;">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </p>
                                        <a href="#" class="openings_link">5 Positions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vc_col-sm-4 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <h3 class="small zero_color header_font">Planning</h3>
                                    <div class="clearfix"></div>
                                    <div class="work_inner_desc">
                                        <p style="text-align: center;">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </p>
                                        <a href="#" class="openings_link">5 Positions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vc_col-sm-4 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <h3 class="small zero_color header_font">Design &amp; Development</h3>
                                    <div class="clearfix"></div>
                                    <div class="work_inner_desc">
                                        <p style="text-align: center;">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </p>
                                        <a href="#" class="openings_link">5 Positions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vc_col-sm-4 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <h3 class="small zero_color header_font">Quality</h3>
                                    <div class="clearfix"></div>
                                    <div class="work_inner_desc">
                                        <p style="text-align: center;">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </p>
                                        <a href="#" class="openings_link">5 Positions</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vc_col-sm-4 wpb_column vc_column_container">
                        <div class="wpb_wrapper">
                            <div class="clearfix"></div>
                            <div class="work_cont">
                                <h3 class="small zero_color header_font">Purchase</h3>
                                <div class="clearfix"></div>
                                <div class="work_inner_desc">
                                    <p style="text-align: center;">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </p>
                                    <a href="#" class="openings_link">5 Positions</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="reg_wdt">
                    <div class="prk_inner_block wpb_row vc_row-fluid prk_section centered columns samba_align_left">
                        <div class="row">
                            <div class="vc_col-sm-12 wpb_column vc_column_container">
                                <div class="wpb_wrapper">
                                    <div class="vc_separator wpb_content_element vc_separator_align_center vc_el_width_100 vc_sep_dashed vc_sep_color_white">
                                        <span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span>
                                        <h4>Design &amp; Development</h4>
                                        <span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                                    </div>

                                    <div class="reg_wdt inner_row_father tablejob">
                                        <div class="prk_inner_block wpb_row vc_row-fluid prk_section centered columns samba_align_left">
                                            <!--Jobs are sepearated by rows-->
                                            <div class="row">
                                                <div class="vc_col-sm-2 wpb_column vc_column_container">
                                                    <div class="wpb_wrapper">
                                                        <p class="job_title">Architect</p>
                                                    </div>
                                                </div>
                                                <div class="vc_col-sm-8 wpb_column vc_column_container">
                                                    <div class="wpb_wrapper">
                                                        <p class="job_desc">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                    </div>
                                                </div>
                                                <div class="vc_col-sm-2 wpb_column vc_column_container">
                                                    <div class="wpb_wrapper">
                                                        <a href="#" class="wpb_button_a">
                                                            <span class="wpb_button wpb_btn-inverse wpb_regularsize">
                                                                Apply Now
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="reg_wdt inner_row_father tablejob">
                                        <div class="prk_inner_block wpb_row vc_row-fluid prk_section centered columns samba_align_left">
                                            <!--Jobs are sepearated by rows-->
                                            <div class="row">
                                                <div class="vc_col-sm-2 wpb_column vc_column_container">
                                                    <div class="wpb_wrapper">
                                                        <p class="job_title">Architect</p>
                                                    </div>
                                                </div>
                                                <div class="vc_col-sm-8 wpb_column vc_column_container">
                                                    <div class="wpb_wrapper">
                                                        <p class="job_desc">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                    </div>
                                                </div>
                                                <div class="vc_col-sm-2 wpb_column vc_column_container">
                                                    <div class="wpb_wrapper">
                                                        <a href="#" class="wpb_button_a">
                                                            <span class="wpb_button wpb_btn-inverse wpb_regularsize">
                                                                Apply Now
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
                
                <!--Careers Bottom content-->
                <!--Careers Bottom content-->
                
                
                <div class="clearfix"></div>
                </div>
              <?php endwhile; /* End loop */ ?>
            <?php 
              if ($show_sidebar) 
              {
                  ?>
                <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?> inside right_floated top_15" role="complementary">
                    <?php get_sidebar(); ?>
                </aside><!-- /#sidebar -->
                </div>
                <?php
              }
            ?>
            <div class="clearfix"></div>
        </div><!-- /#main -->
    </div><!-- /#content -->
</div><!-- #main_block -->
</div>
<?php get_footer(); ?>