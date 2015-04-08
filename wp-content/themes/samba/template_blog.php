<?php 
/*
Template Name: Blog Page - Classic
*/
?>
<?php 
  get_header();
    global $retina_device;
    $retina_flag = $retina_device === "prk_retina" ? true : false;
  //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
  if (INJECT_STYLE) {
    include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');  
  }
  $show_sidebar=$prk_samba_frontend_options['right_sidebar'];
  if ($show_sidebar=="yes")
    $show_sidebar=true;
  else
    $show_sidebar=false;
  $show_title=false;
  $show_avatar=false;
  $data = get_post_meta( $post->ID, '_custom_meta_blog_template', true );
  if (!empty($data))
  {
    if (isset($data['alchemy_show_sidebar']) && $data['alchemy_show_sidebar']=="yes")
    {
      $show_sidebar=true;
    }
    if (isset($data['alchemy_show_sidebar']) && $data['alchemy_show_sidebar']=="no")
    {
      $show_sidebar=false;
    }
    if (isset($data['alchemy_show_title']) && $data['alchemy_show_title']=="yes") {
        $show_title=true;
    }
    if (isset($data['alchemy_show_avatar']) && $data['alchemy_show_avatar']=="yes") {
      $show_avatar=true;
    }
  }
?>    
<div id="centered_block" class="prk_inner_block columns centered main_no_sections">
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
  <?php
   if ($show_title==true)
    {
        prk_output_title($data);
    }
  ?>
  <div id="content">
        <div id="main" class="main_no_sections row">
          <div class="<?php if ($show_sidebar) {echo "twelve columns sidebarized no_title_page";}else{echo "berlo twelve columns unsidebarized no_title_page";} ?>">
      <?php 
      wp_reset_query();
        while (have_posts()) : the_post();
          the_content();//OF THE MAIN PAGE
        endwhile; /* End main page loop */ 
            wp_reset_query();
            $my_query = new WP_Query();
            if(is_front_page())
            {
              $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }
            else
            { 
              $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            }
            $inside_filter="";
            if (!empty($data))
            {
              $in_flag=false;
              foreach ($data as $childs)
              {
                //ADD THE CATEGORIES TO THE FILTER
                if ($in_flag==true)
                {
                  $inside_filter.=$childs.", ";
                }
                if ($childs=='weirdostf')
                {
                  $in_flag=true;
                }
              }
            }
            $args = array( 
              'post_type' => 'post', 
              'paged'=>$paged,
              'category_name'=>$inside_filter
               );
            $my_query->query($args);
            $posts_per_page = get_query_var('posts_per_page');
            $post_counter=($paged-1)*$posts_per_page;
              $extra_css="";
            if ($paged==$my_query->max_num_pages) {
              $extra_css=' cut_at_bottom';
            }
            echo '<div id="classic_blog_section" class="prk_section'.$extra_css.'">';
            if ($my_query->have_posts()) : 
            $ins=0;
            echo "<ul id=\"blog_entries\">";
              while ($my_query->have_posts()) : $my_query->the_post(); 
              $post_counter++;
              $data = get_post_meta( $post->ID, '_custom_meta', true );
                  if (isset($data['featured_color']) && $data['featured_color']!="")
                  {
                    $featured_color=$data['featured_color'];
                    $featured_class="featured_color ";
                  }
                  else
                  {
                    $featured_color="default";
                    $featured_class="";
                  }
              ?>
            <li id="post-<?php the_ID(); ?>" class="<?php echo $featured_class; ?>blog_entry_li cf<?php if ($post_counter == $my_query->post_count) echo " last_li"; ?>" data-color="<?php echo $featured_color; ?>">
              <?php 
              if (has_post_thumbnail( $post->ID ) ):
                //GET THE FEATURED IMAGE
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                $image[0] = get_image_path($image[0]);
                $p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                
              else :
                //THERE'S NO FEATURED IMAGE
                
              endif; 
              ?>
                                              
               <?php 
                if (has_post_thumbnail( $post->ID ) )
                {
                  ?>
                  <div class="blog_content twelve"> 
                        <a href="<?php the_permalink(); ?>" class="fade_anchor" data-color="<?php echo $featured_color; ?>">
                            <div class="blog_top_image boxed_shadow">
                              <div class="blog_fader_grid">
                                  <div class="navicon-plus titled_link_icon body_bk_color"></div>
                                </div>
                                <?php 
                                    if (!isset($prk_samba_frontend_options['forcesize_news']))
                                        $prk_samba_frontend_options['forcesize_news']='yes';
                                    $height_force=0;
                                    $cropper=false;
                                    if ($prk_samba_frontend_options['forcesize_news']=='yes') {
                                        $height_force=285;
                                        $cropper=true;
                                      }
                                    $vt_image = vt_resize( '', $image[0] , 840, $height_force, $cropper , $retina_flag );
                                    ?>
                                  <img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image boxed_shadow" alt="<?php echo prk_get_img_alt($image[0]); ?>" />
                                  <?php
                                    if ($show_avatar=="yes" && function_exists('get_avatar')) 
                                    { 
                                      echo "<div class='prk_author_avatar'>";
                                      echo get_avatar( get_the_author_meta('email'), '92' );
                                      echo "</div>";
                                    }
                                  ?>     
                            </div>
                        </a>
                    <?php
                }
                else
                {
                  //CHECK IF THERE'S A VIDEO TO SHOW
                  if (isset($data['image_2']) && substr($data['image_2'],0,6)!="http:/" && substr($data['image_2'],0,6)!="")
                  {
                    $el_class='video-container';
                    if (strpos($data['image_2'],'soundcloud.com') !== false) {
                      $el_class= 'soundcloud-container';
                    }
                    echo '<div class="blog_content twelve">';
                    echo "<div class='".$el_class." boxed_shadow'>";
                    echo $data['image_2'];
                    echo "</div>";
                  }
                  else
                  {
                    ?>
                    <div class="blog_content twelve no_top_img">
                    <div class="blog_top_image zero_margin_bottom">&nbsp;</div> 
                    <?php
                  }
                }
                ?>
                                <div class="clearfix"></div>
                                    <div class="classic_blog_meta prk_titlify_father">
                                    <h3 class="header_font bd_headings_text_shadow">
                                      <a href="<?php the_permalink(); ?>" class="fade_anchor zero_color prk_break_word" data-color="<?php echo $featured_color; ?>">
                                        <?php the_title(); ?>
                                      </a>
                                    </h3>
                                  <div class="clearfix"></div>
                                </div>
                        <div class="single_blog_meta_class header_font">
                            <?php
                              if (is_sticky())
                              {
                                  ?>
                                  <div class="single_blog_meta_div">
                                      <div class="navicon-flag left_floated"></div>
                                      <div class="left_floated default_color sticky_text">
                                          <?php echo($prk_translations['sticky_text']); ?>
                                      </div>
                                  </div>
                                  <?php
                              }
                          ?>
                          <div class="single_blog_meta_div">
                              <div class="navicon-clock-2 left_floated not_zero_color"></div>
                              <div class="left_floated">
                                  <?php echo get_the_time(get_option('date_format')); ?>
                              </div>
                          </div>
                            <?php
                                if ($prk_samba_frontend_options['categoriesby_news']=="yes")
                                {
                                    ?>
                                    <div class="single_blog_meta_div">
                                        <div class="<?php echo $data['bl_icon']; ?> not_zero_color left_floated"></div>
                                        <div class="left_floated default_color blog_categories">
                                            <?php the_category(', '); //CATS WITH LINKS ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                                <?php 
                                    if ($prk_samba_frontend_options['postedby_news']=="yes")
                                    {
                                        ?>
                                        <div class="single_blog_meta_div">
                                            <div class="navicon-user-4 left_floated not_zero_color"></div>
                                            <div class="left_floated">
                                                <?php echo($prk_translations['posted_by_text']); ?>
                                                <?php echo " ".get_the_author(); ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <?php
                                    if ( comments_open() ) :
                                        ?>
                                        <div class="single_blog_meta_div right_floated">
                                            <div class="left_floated default_color">
                                                <a href="<?php comments_link(); ?>" class="fade_anchor">        
                                                    <?php 
                                                        comments_number($prk_translations['comments_no_response'], $prk_translations['comments_one_response'], '% '.$prk_translations['comments_oneplus_response']);
                                                    ?> 
                                                </a>
                                            </div>
                                            <div class="navicon-bubbles-4 left_floated not_zero_color"></div>
                                        </div>
                                        
                                      <?php
                                    endif;
                                ?>
                         <div class="clearfix"></div>
                       </div>
                                <div class="on_colored entry_content prk_break_word">
                  <?php 
                                      echo the_excerpt_dynamic(64);
                                  ?>
                                  <div class="clearfix eight_margin"></div>
                  <?php 
                                     if (is_big_excerpt(64))
                                    {
                                        ?>
                                            <div class="theme_button">
                                            <a href="<?php the_permalink() ?>" class="fade_anchor" data-color="<?php echo $featured_color; ?>">
                                                    <?php echo($prk_translations['read_more']); ?>
                                            </a>
                                            </div> 
                                        <?php
                                    }
                                ?>  
                             <div class="clearfix"></div>
                                </div><!-- blog_content -->
                              </div>
              
            </li>
            <?php $ins++; ?>
          <?php 
            endwhile;
            echo "</ul>";
           endif; 
          //SHOW BUTTON TO SHOW MORE POSTS ONLY IF NEEDED
          if ($paged!=$my_query->max_num_pages)
          {
            ?>
            <div class="clearfix"></div>
              <div id="entries_navigation">
                <div class="simple_line blog_divider"></div>
                <div class="navigation twelve"> 
                  <div class="next-posts">
                      <div id="nbr_helper" data-pir_curr="<?php echo $paged; ?>" data-pir_max="<?php echo $my_query->max_num_pages; ?>">
                          <div id="pages_static_nav" class="theme_button">
                              <a href="#">
                                  <?php echo($prk_translations['load_more']); ?> 
                              </a>
                              <div class="clearfix"></div>
                          </div>
                          <div id="pir_loader_wrapper" class="cf">
                              <div class="spinner"><div class="spinner-icon"></div></div>
                          </div>
                          <div class="nx_lnk_wp">
                              <?php next_posts_link('',$my_query->max_num_pages); ?>
                          </div>
                      </div>
                  </div>
                </div><!-- navigation -->
              </div><!-- entries_navigation --> 
              <div class="clearfix"></div>
              <div id="no_more" class="header_font">
                <div class="simple_line blog_divider"></div>
                  <div id="in_no_more"><?php echo($prk_translations['no_more_text']); ?></div>
                  <div class="clearfix"></div>
              </div>
            <?php
          }
        ?>
      </div>
    </div>

    <?php 
          if ($show_sidebar) 
          {
              ?>
              <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
                  <?php get_sidebar(); ?>
              </aside><!-- /#sidebar -->
              <?php
          }
      ?>
      </div>
    </div>
</div>
</div>
<?php get_footer(); ?>