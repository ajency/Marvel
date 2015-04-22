<?php 
    get_header();
    global $retina_device;
    $retina_flag = $retina_device === "prk_retina" ? true : false;
    $show_sidebar=$prk_samba_frontend_options['right_sidebar'];
    if ($show_sidebar=="yes")
    { 
        $show_sidebar=true;
        $single_max_width=$prk_samba_frontend_options['custom_width']-320;
    }
    else
    {
        $show_sidebar=false;
        $single_max_width=$prk_samba_frontend_options['custom_width']-80;
    }
    $site_background_color = $prk_samba_frontend_options['site_background_color'];
    //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
    if (INJECT_STYLE)
    {
        include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');  
    }
    $darker_inactive_color=alter_brightness($prk_samba_frontend_options['inactive_color'],-80);
    $inactive_color=$prk_samba_frontend_options['inactive_color'];
    while (have_posts()) : the_post();
        //GET THEME CUSTOM FIELDS INFO
        $data = get_post_meta( $post->ID, '_custom_meta', true );
        $sl_id="single_slider";
        $sl_class="flexslider boxed_shadow";
        $slides_class="";
        if (!empty($data))
        {
            if (isset($data['no_slider']) && $data['no_slider']=="1")
            {
                $sl_id="not_slider";
                $sl_class="";
                $slides_class="boxed_shadow";
            }
        }
        if (isset($data['featured_color']) && $data['featured_color']!="")
        {
            $featured_color=$data['featured_color'];
            $featured_class='class="featured_color" ';
        }
        else
        {
            $featured_color="default";
            $featured_class="";
        }
        ?>
        <div id="centered_block" class="prk_inner_block columns centered prk_no_change">
        <div id="main_block" class="twelve row page-<?php echo get_the_ID(); ?>">
            <div id="content" class="row has_top_bar" data-parent="<?php echo get_page_link(prk_get_parent_blog()); ?>">
                <div id="main" role="main" class="main_no_sections">
                    <div class="twelve centered blog_sgl_pst">
                        <div class="<?php if ($show_sidebar) {echo "twelve columns sidebarized no_title_page"; }else{echo "twelve columns unsidebarized no_title_page";} ?>">
                            <div id="single_blog_content" <?php echo $featured_class; ?>data-color="<?php echo $featured_color; ?>">
                                <article <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
                                        <div class="single_post_wp">
                                            <h1 id="blog_ttl" class="header_font bd_headings_text_shadow zero_color prk_break_word">
                                                <?php the_title(); ?>
                                            </h1>
                                            <div id="single_blog_meta" class="header_font">
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
                                        <div id="samba_single_date" class="single_blog_meta_div">
                                            <div class="navicon-clock-2 left_floated not_zero_color"></div>
                                            <div class="left_floated">
                                                <?php echo the_date(); ?>
                                            </div>
                                        </div>
                            <?php
                                if ($prk_samba_frontend_options['categoriesby_news']=="yes")
                                {
                                    if (!isset($data['bl_icon'])) {
                                        $data['bl_icon']='icon-link';
                                      }
                                    ?>
                                    <div class="single_blog_meta_div">
                                        <div class="<?php echo $data['bl_icon']; ?> not_zero_color left_floated"></div>
                                        <div class="left_floated default_color">
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
                                                <a href="<?php comments_link(); ?>">        
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
                                            <div id="<?php echo $sl_id; ?>" class="<?php echo $sl_class; ?>"  data-color="<?php echo $featured_color; ?>">
                                            <ul class="slides" data-autoplay="<?php echo $prk_samba_frontend_options['autoplay_portfolio']; ?>">
                                                <?php
                                                    $ext_count=0;
                                                    if (!isset($data['skip_featured']))
                                                        $data['skip_featured']=0;
                                                    if ($data['skip_featured']==0)
                                                    {
                                                        if (has_post_thumbnail( $post->ID ) )
                                                        {
                                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                                                            $image[0] = get_image_path($image[0]);
                                                            $ext_count=1;
                                                            echo "<li id=slide_".$ext_count." class='".$slides_class."'>";
                                                            $vt_image = vt_resize( '', $image[0] , $single_max_width, 0, false , $retina_flag );
                                                            echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($image[0]).'" />';
                                                            echo"</li>";
                                                        }
                                                    }
                                                    $flagger=true;//VARIABLE TO CHECK IF THERE'S ONLY ONE IMAGE
                                                    //PLACE THE OTHER NINE IMAGES
                                                    for ($count=2;$count<11;$count++)
                                                    {
                                                        if (isset($data['image_'.$count]))
                                                        {
                                                            if ($data['image_'.$count]!="")
                                                            {
                                                                $ext_count++;
                                                                if ($ext_count>1):
                                                                    $flagger=false;
                                                                endif;
                                                                echo "<li id=slide_".$ext_count." class='".$slides_class."'>";
                                                                    if (substr($data['image_'.$count],0,6)=="http:/" || substr($data['image_'.$count],0,7)=="https:/")
                                                                    {
                                                                        $image_alt=$data['image_'.$count];
                                                                        $vt_image = vt_resize( '', $data['image_'.$count] , $single_max_width, 0, false , $retina_flag );
                                                                        echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($image_alt).'" />';
                                                                    }
                                                                    else
                                                                    {
                                                                        $el_class='prk-video-container';
                                                                        if (strpos($data['image_'.$count],'soundcloud.com') !== false) {
                                                                            $el_class= 'soundcloud-container';
                                                                        }
                                                                        echo "<div class='".$el_class."'>";
                                                                        echo $data['image_'.$count];
                                                                        echo "</div>";
                                                                    }
                                                                echo "</li>";
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </ul><!-- slides -->
                                        </div><!-- flexslider -->
                                    <?php
                                        //ADJUST CONTENTS IF THERE ARE NO IMAGES TO SHOW
                                        if ($ext_count==0)
                                        {
                                            ?>
                                            <div class="clearfix" style="margin-top:-20px;"></div> 
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <div class="clearfix"></div> 
                                            <?php
                                        }
                                    ?>     
                                    <div id="single_post_content" class="on_colored prk_no_composer prk_break_word">
                                        <?php the_content(); ?>
                                    </div>
                                    <?php wp_link_pages('before=<p class="fade_anchor">&after=</p>'); ?>
                                    <div class="clearfix"></div>
                                    <?php
                                        if (get_the_tags()!="")
                                        {
                                            echo '<div class="single_meta_footer">';
                                            echo '<div class="simple_line thick"></div>';
                                            ?>
                                            <div class="single_blog_meta_div header_font">
                                            <div class="navicon-tags left_floated not_zero_color"></div>
                                            <div class="left_floated default_color header_font"><h6 class="big"><?php the_tags(''); ?></h6></div>
                                            </div>
                                             <div class="single_blog_meta_div header_font right_floated">
                                            
                                            <div class="left_floated">
                                                <a href="<?php echo get_page_link(prk_get_parent_blog()); ?>" class="default_color"><?php echo($prk_translations['to_blog']); ?></a>
                                            </div>
                                            <div class="navicon-pencil left_floated not_zero_color"></div>
                                        </div>
                                            <?php
                                            echo '<div class="clearfix"></div>';
                                            echo '</div>';
                                        } 
                                    ?>            
                                    </div><!-- single_post_wp -->
                                    <?php 
                                        if ($prk_samba_frontend_options['related_author']=="yes")
                                        {
                                            ?>
                                            <div id="author_area" class="prk_blockquote colored_background">
                                                <div class="in_quote">
                                                <?php 
                                                    if (function_exists('get_avatar')) { 
                                                        echo "<div class='prk_author_avatar'>";
                                                        echo get_avatar( get_the_author_meta('email'), '84' );
                                                        echo "</div>";
                                                    }
                                                ?>
                                                <div class="author_info default_color">
                                                    <h4 class="header_font zero_color">
                                                        <?php echo $prk_translations['about_author_text']." ";the_author_posts_link(); ?>
                                                    </h4> 
                                                    <?php 
                                                        $auth_array = get_user_by('slug', get_the_author_meta('user_nicename'));
                                                        echo nl2br($auth_array->description); 
                                                    ?>
                                                </div>
                                                <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    <div id="c_wrap_single">
                                        <?php comments_template(); ?>
                                  </div>
                                </article>
                                </div>
                                </div>
                            <?php 
                                if ($show_sidebar) 
                                {
                                    ?>
                                    <aside id="sidebar" class="columns on_single" role="complementary">
                                       <?php get_sidebar(); ?>
                                    </aside><!-- /#sidebar -->
                                    <?php
                               }
                            ?>
                            </div>
                            <div class="clearfix"></div>
                            
            <div id="prk_nav_close">
                <a href="<?php echo get_page_link(prk_get_parent_blog()); ?>" data-pir_title="<?php echo($prk_translations['to_blog']); ?>">Blog</a>
            </div>
            <?php
                next_post_link_plus( array(
                        'in_same_cat' => true,
                        'before' => '<div id="prk_nav_left">',
                        'after' => '</div>',
                        'format' => '%link'
                        ));
                previous_post_link_plus( array(
                        'in_same_cat' => true,
                        'before' => '<div id="prk_nav_right">',
                        'after' => '</div>',
                        'format' => '%link'
                        ));
                if ($prk_samba_frontend_options['show_heart_blog']=="yes" || $prk_samba_frontend_options['share_blog']=="yes")
                {
                    echo '<div class="prk_right_panel blogged">';
                }
                if ($prk_samba_frontend_options['show_heart_blog']=="yes")
                {
                    echo '<div class="fifty_button">';
                    echo get_blog_like(get_the_ID(),true);
                    echo '</div>';
                }
                if ($prk_samba_frontend_options['share_blog']=="yes")
                {
                    ?>
                    <div class="prk_sharrre_wrapper left_floated">
                        <div class="prk_sharre_btns">
                            <?php if (isset($prk_samba_frontend_options['share_blog_del']) && $prk_samba_frontend_options['share_blog_del']=="true") { ?>
                            <div class="prk_sharrre_delicious fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php get_the_title(); ?>" data-title="share">
                            </div>
                            <?php } ?>
                            <?php if (isset($prk_samba_frontend_options['share_blog_fb']) && $prk_samba_frontend_options['share_blog_fb']=="true")  { ?>
                            <div class="prk_sharrre_facebook fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                            </div>
                            <?php } ?>
                            <?php if (isset($prk_samba_frontend_options['share_blog_goo']) && $prk_samba_frontend_options['share_blog_goo']=="true")  { ?>
                            <div class="prk_sharrre_google fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                            </div>
                            <?php } ?>
                            <?php if (isset($prk_samba_frontend_options['share_blog_lnk']) && $prk_samba_frontend_options['share_blog_lnk']=="true")  { ?>
                            <div class="prk_sharrre_linkedin fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                            </div>
                            <?php } ?>
                            <?php 
                                if (isset($prk_samba_frontend_options['share_blog_pin']) && $prk_samba_frontend_options['share_blog_pin']=="true") 
                                { 
                                    if (has_post_thumbnail( $post->ID ) )
                                    {
                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                                    }
                                    else
                                    {
                                        $image[0]="";
                                    }
                                    ?>
                                    <div class="prk_sharrre_pinterest fifty_button site_background_colored" data-media="<?php echo $image[0]; ?>" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                    </div>
                                    <?php 
                                } 
                            ?>
                            <?php if (isset($prk_samba_frontend_options['share_blog_stu']) && $prk_samba_frontend_options['share_blog_stu']=="true")  { ?>
                            <div class="prk_sharrre_stumbleupon fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                            </div>
                            <?php } ?>
                            
                            <?php if (isset($prk_samba_frontend_options['share_blog_twt']) && $prk_samba_frontend_options['share_blog_twt']=="true")  { ?>
                            <div class="prk_sharrre_twitter fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="share">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                  <div class="clearfix"></div>
                  <?php
                }
                if ($prk_samba_frontend_options['show_heart_blog']=="yes" || $prk_samba_frontend_options['share_blog']=="yes")
                {
                    echo '</div>';
                } 
                ?>
        </div><!-- /#main -->
    </div><!-- /#content -->
</div><!-- #main_block -->
<div class="clearfix"></div>
</div>
<?php endwhile; /* End loop */ ?>
<?php get_footer(); ?>