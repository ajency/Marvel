<?php
/*
Template Name: Page - Resi Projects List
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
            
            <!--these are the project list styles-->
            <!--these are the project list styles-->
            <!--these are the project list styles-->
            <div class="proj_list">
                <div class="top-dd-c">
                    <div class="top-dd one">
                        <select id="dd_status">
                            <option>Ongoing</option>
                            <option>Upcoming</option>
                        </select>
                    </div>
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
                            <option>Type</option>
                        </select>
                    </div>
                    <div class="top-sea">
                        <button type="submit" class="btn_norm sea"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="pull-right top-view">
                        <a href="#" class="top_list current"><i class="fa fa-th-large"></i></a>
                        <a href="#" class="top_map"><i class="fa fa-map-marker"></i></a>
                    </div>
                </div>

                <div class="top-compar">
                    <div class="drag_area one">Drag for Comparision</div>
                    <div class="drag_area two">Drag for Comparision</div>
                    <a href="#" class="btn_norm top_btn_co disabled">Compare</a>
                </div>

                <div id="proj_list" class="project-list row">
                    <div class="twelve columns">
                        <h5>Commercial Projects in Pune</h5>
                    </div>
                    <!--single project listing-->
                    <div class="single_p_w six columns">
                        <div class="single_p_img">
                            <img src="http://lorempixel.com/output/city-q-c-1000-1000-10.jpg">
                            <div class="single_p_hov_c">
                                <div class="single_p_likes single_top"><i class="fa fa-heart"></i> 30</div>
                                <div class="clearfix"></div>
                                <div class="single_p_info">
                                    <h6>Office Spaces: 1200 - 50,000 sq. ft.</h6>
                                    <h6>Retail Spaces: 500 - 1,400 sq. ft.</h6>
                                </div>
                                <div class="single_btm">
                                    <div class="pull-left">
                                        <a href="#" class="btn_norm single_enq"><i class="fa fa-envelope-o"></i></a>
                                        <a href="#" class="btn_norm single_share"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn_norm single_know">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_p_cap">
                            <p class="single_p_inf">
                                <a href="#">
                                    <span class="single_p_title">Marvel Edge</span>
                                    <span class="single_p_light">|</span>
                                    <span class="single_p_location">Viman Nagar</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="single_p_w six columns">
                        <div class="single_p_img">
                            <img src="http://lorempixel.com/output/city-q-c-1000-1000-10.jpg">
                            <div class="single_p_hov_c">
                                <div class="single_p_likes single_top"><i class="fa fa-heart"></i> 30</div>
                                <div class="clearfix"></div>
                                <div class="single_p_info">
                                    <h6>Office Spaces: 1200 - 50,000 sq. ft.</h6>
                                    <h6>Retail Spaces: 500 - 1,400 sq. ft.</h6>
                                </div>
                                <div class="single_btm">
                                    <div class="pull-left">
                                        <a href="#" class="btn_norm single_enq"><i class="fa fa-envelope-o"></i></a>
                                        <a href="#" class="btn_norm single_share-alt"><i class="fa fa-share"></i></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn_norm single_know">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single_p_cap">
                            <p class="single_p_inf">
                                <a href="#">
                                    <span class="single_p_title">Marvel Edge</span>
                                    |
                                    <span class="single_p_location">Viman Nagar</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <!--END single project listing-->
                </div>
            </div>
            <!--END project list styles-->
            <!--END project list styles-->
            <!--END project list styles-->
            
            <div class="clearfix"></div>
        </div><!-- /#main -->
    </div><!-- /#content -->
</div><!-- #main_block -->
</div>
<?php get_footer(); ?>