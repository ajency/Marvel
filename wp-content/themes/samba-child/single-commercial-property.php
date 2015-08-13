
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

   $current_page_title = ''; 
 Global $wp_query;
 $current_page_id = $wp_query->get_queried_object_id();
 $current_page_title= get_the_title($current_page_id);
 $current_property_url = site_url().'/ResidentialProperties/'. $current_page_title;
 $current_property_featured_image_thumbnail  = wp_get_attachment_image_src( get_post_thumbnail_id($current_page_id), 'thumbnail'  );


?>
<div id="centered_block" class="row">
<div id="main_block" class="block_with_sections hideTitle page-<?php echo get_the_ID(); ?>">
<input type="hidden" name="current_property_title" id="current_property_title" value="<?php echo $current_page_title; ?>"  />
<input type="hidden" name="interval_id_auto_popup"  id="interval_id_auto_popup" value="" />

    <div id="full_fi_c">
        <div class="full_fi_title">
            <p class="f_f_t">
                <?php
                $project_locality = get_post_meta(get_the_ID(),'property-locality',true);
                $project_city = get_post_meta(get_the_ID(),'property-city',true);
                $project_type = maybe_unserialize(get_post_meta(get_the_ID(),'residential-property-unit-type',true));

                $location_seperator = '';
                $project_type_seperator='';
                if( ($project_city!=false || $project_locality!=false ) && ($project_city!='' || $project_locality!='') )
                  $location_seperator = ", ";

                if( ($project_type!=false   ) && ($project_type!=''  ) ){
                  $project_type_seperator = ", ";

                $project_type_seperator = " ";

                foreach ($project_type as $ptype_key => $ptype_value) {
                   $project_types_display[]=   ucfirst($ptype_value['type']);
                  }


                 if(is_array($project_types_display))
                   $display_project_types_wt_sep = implode(', ',$project_types_display) ;
                 else
                    $display_project_types_wt_sep = $project_types_display;

                }




                echo $display_project_types_wt_sep.$project_type_seperator.ucfirst(get_the_title()).$location_seperator.ucfirst($project_locality)." ".ucfirst($project_city);
                ?>
            </p>
        </div>
        <a href="#" class="go_d_see"></a>
    <?php
      //echo prk_output_featured_image(get_the_ID());
    echo get_the_post_thumbnail(get_the_ID(), 'large');
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
    </div>
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
                <div class="clearfix"></div>

                <div class="go_to_top_inpage sticky"></div>
                <a class="enquiry_sideways sticky popmake-popup-property-page"><i></i>Enquire Now</a>

                <div class="go_to_top_inpage"></div>
                <!-- <a class="enquiry_sideways">
                  <i></i>
                  Enquire Now
                </a> -->
                <div class="share_indi"></div>

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