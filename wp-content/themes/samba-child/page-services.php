<?php
/*
Template Name: Page - Services
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
<div id="main_block" class="block_with_sections service page-<?php echo get_the_ID(); ?>">
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
                <!-- <div class="vc_row-fluid full-width">
                    <div class="vc_col-sm-12">
                        <div class="top-dd-c">
                            <div class="top-dd two">
                                <select id="dd_city">
                                    <option>Pune</option>
                                </select>
                            </div>
                            <div class="top-dd thr">
                                <select id="dd_locality" disabled>
                                    <option>Locality</option>
                                </select>
                            </div>
                            <div class="top-dd fou">
                                <select id="dd_type" disabled>
                                    <option>No. of Bedrooms</option>
                                </select>
                            </div>
                            <div class="top-sea">
                                <button type="submit" class="btn_norm sea"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="top-note">
                                <p>Note: Minimum deposit of 10 months has to be given prior to taking flat for rent.</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="prk_inner_block vc_row-fluid centered columns">
                    <div class="row">
                        <div class="vc_col-sm-12 wpb_column vc_column_container">
                            <h5>Residential Projects on Rent in Pune (3)</h5>
                        </div>
                    </div>
                </div>
                <div class="prk_inner_block vc_row-fluid centered columns forent">
                    <div class="row partintro">
                        <div class="vc_col-sm-12 wpb_column vc_column_container bgrey">
                            <div class="wpb_wrapper img_hold">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <img src="http://loremflickr.com/1000/457/luxury,house">
                                    <div class="forent_cap">Sample Flat</div>
                                </div>
                            </div>
                            <div class="wpb_wrapper introtext">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <a href="#" class="proj_title">
                                        <span class="title">Marvel Diva</span>
                                        <span class="divi">|</span>
                                        <span class="loca">Magarpatta Road</span>
                                    </a>
                                    <p class="excerpt">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row list_forent">
                        <div class="vc_col-sm-12 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="clearfix"></div>
                                <div class="work_cont tab_con">
                                    <div class="top-tab">
                                       <div class="top_inner t_i_head">
                                            <div class="set">
                                                <small class="clr_lt">Building | Floor</small>
                                            </div>
                                            <div class="set">
                                                <small class="clr_lt">Area (SQ.FT.)</small>
                                            </div>
                                            <div class="set">
                                                <small class="clr_lt">No. Of Rooms</small>
                                            </div>
                                            <div class="set rent">
                                                <small class="clr_lt">Rent (Rs./Month)</small>
                                            </div>
                                            <div class="set">

                                            </div>
                                        </div>
                                        <div class="top_inner t_i_body">
                                            <div class="set">
                                                <big>D 10</big>
                                            </div>
                                            <div class="set">
                                                <big>2,155</big>
                                            </div>
                                            <div class="set">
                                                <big>3.5 BHK</big>
                                            </div>
                                            <div class="set rent">
                                                <big>45,000</big><small> - Unfurnished</small>
                                            </div>
                                            <div class="set alrt">
                                                <a href="#" class="wpb_button enq_ico"><span class="wpb_button wpb_btn-inverse wpb_regularsize"></span></a>
                                            </div>
                                        </div>

                                        <div class="top_inner t_i_body">
                                            <div class="set">
                                                <big>D 10</big>
                                            </div>
                                            <div class="set">
                                                <big>2,155</big>
                                            </div>
                                            <div class="set">
                                                <big>3.5 BHK</big>
                                            </div>
                                            <div class="set rent">
                                                <big>45,000</big><small> - Unfurnished</small>
                                            </div>
                                            <div class="set alrt">
                                                <a href="#" class="wpb_button enq_ico"><span class="wpb_button wpb_btn-inverse wpb_regularsize"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="prk_inner_block vc_row-fluid centered columns forent">
                    <div class="row partintro">
                        <div class="vc_col-sm-12 wpb_column vc_column_container bgrey">
                            <div class="wpb_wrapper img_hold">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <img src="http://loremflickr.com/1000/457/luxury,house">
                                    <div class="forent_cap">Sample Flat</div>
                                </div>
                            </div>
                            <div class="wpb_wrapper introtext">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <a href="#" class="proj_title">
                                        <span class="title">Marvel Diva Phase 2</span>
                                        <span class="divi">|</span>
                                        <span class="loca">Magarpatta Road</span>
                                    </a>
                                    <p class="excerpt">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row list_forent">
                        <div class="vc_col-sm-12 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="clearfix"></div>
                                <div class="work_cont tab_con">
                                    <div class="top-tab">
                                       <div class="top_inner t_i_head">
                                            <div class="set">
                                                <small class="clr_lt">Building | Floor</small>
                                            </div>
                                            <div class="set">
                                                <small class="clr_lt">Area (SQ.FT.)</small>
                                            </div>
                                            <div class="set">
                                                <small class="clr_lt">No. Of Rooms</small>
                                            </div>
                                            <div class="set rent">
                                                <small class="clr_lt">Rent (Rs./Month)</small>
                                            </div>
                                            <div class="set">

                                            </div>
                                        </div>
                                        <div class="top_inner t_i_body">
                                            <div class="set">
                                                <big>D 10</big>
                                            </div>
                                            <div class="set">
                                                <big>2,155</big>
                                            </div>
                                            <div class="set">
                                                <big>3.5 BHK</big>
                                            </div>
                                            <div class="set rent">
                                                <big>45,000</big><small> - Unfurnished</small>
                                            </div>
                                            <div class="set alrt">
                                                <a href="#" class="wpb_button enq_ico"><span class="wpb_button wpb_btn-inverse wpb_regularsize"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div> -->
                <div class="spacer-25"></div>
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