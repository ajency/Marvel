<?php 
    get_header();
    $show_sidebar=$prk_samba_frontend_options['right_sidebar'];
    if ($show_sidebar=="yes")
        $show_sidebar=true;
    else
        $show_sidebar=false;
    //FROCE NO SIDEBAR
    $show_sidebar=false;
    $site_background_color = $prk_samba_frontend_options['site_background_color'];
    //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
    if (INJECT_STYLE)
    {
        include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');  
    }
    $darker_inactive_color=alter_brightness($prk_samba_frontend_options['inactive_color'],-80);
    $inactive_color=$prk_samba_frontend_options['inactive_color'];
    //GET THEME CUSTOM FIELDS INFO
    $data=$simple_mb->the_meta();
    $show_image="yes";
    if (isset($data['alchemy_show_member_image']) && $data['alchemy_show_member_image']=="no")
    {
        $show_image="no";
    }
    $sl_class="not_slider";
    if (isset($data['featured_color']) && $data['featured_color']!="")
    {
        $featured_color=$data['featured_color'];
        $featured_class='featured_color';
    }
    else
    {
        $featured_color="default";
        $featured_class="";
    }
    while (have_posts()) : the_post(); 
        ?>
        <div id="centered_block" class="prk_no_change"> 
        <div id="main_block" class="row page-<?php echo get_the_ID(); ?>">   
            <div id="content">
                <div id="main" role="main">
                    <div class="twelve">
                        <?php 
                            if ($show_image=="yes")
                            {
                                ?>
                                <div class="<?php echo $sl_class; ?>">
                                    <ul class="slides">
                                        <?php
                                            if (isset($data['image_2']) && $data['image_2']!="")
                                            {
                                                echo '<li class="boxed_shadow"><img src="'.$data['image_2'].'" alt="'.prk_get_img_alt($data['image_2']).'" /></li>';
                                            }
                                            else
                                            {
                                                if (has_post_thumbnail( $post->ID ) )
                                                {
                                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                                                    ?>
                                                    <li class="boxed_shadow">
                                                        <img src="<?php echo $image[0]; ?>" alt="<?php echo prk_get_img_alt($image[0]); ?>" />
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>   
                                <?php
                            }
                            else
                            {
                                echo '<div class="clearfix bt_15"></div>';
                            }
                        ?>   
                    <div class="twelve extra_pad columns prk_inner_block centered">
                        <div class="row prk_row">
                            <div id="member_full_row" data-color="<?php echo $featured_color; ?>">
                            <div id="member_resume" class="prk_member twelve columns">
                            <div class="member_post_title">
                                <h2 class="header_font bd_headings_text_shadow zero_color">
                                    <?php the_title(); ?>
                                </h2>
                            </div>
                            <?php
                                if (isset($data['member_job']) && $data['member_job']!="")
                                {
                                    echo '<div class="prk_button_like header_font">';
                                    echo $data['member_job'];
                                    echo '</div>';
                                }
                                else
                                {
                                    echo '<div class="clearfix bt_20"></div>';
                                }
                            ?>           
                            <div class="clearfix"></div>
                            <div class="prk_titlify_father">
                                <h6 class="zero_color prk_bold header_font big">
                                    <?php echo($prk_translations['in_touch_text']); ?>                                          
                                </h6>
                            </div>
                            
                            <div class="member_social_wrapper">
                            <?php
                                if (isset($data['member_email']) && $data['member_email']!="none")
                                {
                                    ?>
                                    <div class="member_lnk default_color">
                                        <a href="mailto:<?php echo $data['member_email']; ?>" data-color="#000000">
                                            <div class="navicon-mail-4"></div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                if (isset($data['member_social_1']) && $data['member_social_1']!="none")
                                {
                                    if (isset($data['member_social_1_link']) && $data['member_social_1_link']!="")
                                        $in_link=$data['member_social_1_link'];
                                    else
                                        $in_link="";
                                    ?>
                                    <div class="member_lnk default_color">
                                        <a href="<?php echo $in_link; ?>" target="_blank" data-color="<?php echo prk_social_color($data['member_social_1']); ?>">
                                            <div class="navicon-<?php echo $data['member_social_1']; ?>"></div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                if (isset($data['member_social_2']) && $data['member_social_2']!="none")
                                {
                                    if (isset($data['member_social_2_link']) && $data['member_social_2_link']!="")
                                        $in_link=$data['member_social_2_link'];
                                    else
                                        $in_link="";
                                    ?>
                                    <div class="member_lnk default_color">
                                        <a href="<?php echo $in_link; ?>" target="_blank" data-color="<?php echo prk_social_color($data['member_social_2']); ?>">
                                            <div class="navicon-<?php echo $data['member_social_2']; ?>"></div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                if (isset($data['member_social_3']) && $data['member_social_3']!="none")
                                {
                                    if (isset($data['member_social_3_link']) && $data['member_social_3_link']!="")
                                        $in_link=$data['member_social_3_link'];
                                    else
                                        $in_link="";
                                    ?>
                                    <div class="member_lnk default_color">
                                        <a href="<?php echo $in_link; ?>" target="_blank" data-color="<?php echo prk_social_color($data['member_social_3']); ?>">
                                            <div class="navicon-<?php echo $data['member_social_3']; ?>"></div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                if (isset($data['member_social_4']) && $data['member_social_4']!="none")
                                {
                                    if (isset($data['member_social_4_link']) && $data['member_social_4_link']!="")
                                        $in_link=$data['member_social_4_link'];
                                    else
                                        $in_link="";
                                    ?>
                                    <div class="member_lnk default_color">
                                        <a href="<?php echo $in_link; ?>" target="_blank" data-color="<?php echo prk_social_color($data['member_social_4']); ?>">
                                            <div class="navicon-<?php echo $data['member_social_4']; ?>"></div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                if (isset($data['member_social_5']) && $data['member_social_5']!="none")
                                {
                                    if (isset($data['member_social_5_link']) && $data['member_social_5_link']!="")
                                        $in_link=$data['member_social_5_link'];
                                    else
                                        $in_link="";
                                    ?>
                                    <div class="member_lnk default_color">
                                        <a href="<?php echo $in_link; ?>" target="_blank" data-color="<?php echo prk_social_color($data['member_social_5']); ?>">
                                            <div class="navicon-<?php echo $data['member_social_5']; ?>"></div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                if (isset($data['member_social_6']) && $data['member_social_6']!="none")
                                {
                                    if (isset($data['member_social_6_link']) && $data['member_social_6_link']!="")
                                        $in_link=$data['member_social_6_link'];
                                    else
                                        $in_link="";
                                    ?>
                                    <div class="member_lnk default_color">
                                        <a href="<?php echo $in_link; ?>" target="_blank" data-color="<?php echo prk_social_color($data['member_social_6']); ?>">
                                            <div class="navicon-<?php echo $data['member_social_6']; ?>"></div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="clearfix"></div>
                            </div>
                            <div id="half_helper" class="clearfix"></div>
                        </div>
                <div id="member-<?php the_ID(); ?>" <?php post_class('twelve columns memberized'); ?>>                          
                    <div id="single_post_content" class="twelve centered columns t_member">
                        <?php the_content(); ?>           
                    </div><!-- single_post_wp -->
                            <div id="members_nav">
                                <div class="simple_line thick"></div>
                                <div class="navigation-previous-blog bd_headings_text_shadow zero_color fade_anchor">
                                        <?php 
                                        next_post_link_plus( array(
                                            'in_same_cat' => true,
                                            'format' => '%link',
                                            'link' => ' <div class="icon-left-bold"></div>
                                                        <div class="after_icon_blog"><h4 class="header_font small">%title</h4></div>'
                                            ) );
                                        ?>
                                </div><!-- navigation-previous-blog -->
                                <div class="navigation-next-blog right_floated bd_headings_text_shadow zero_color fade_anchor">
                                        <?php previous_post_link_plus( array(
                                            'in_same_cat' => true,
                                            'format' => '%link',
                                            'link' => '<div class="next_link_blog">
                                              <div class="left_floated bf_icon_blog"><h4 class="header_font small">%title</h4></div>
                                          </div>
                                          <div class="left_floated">
                                                <div class="icon-right-bold"></div>
                                            </div>'
                                            ) );
                                        ?>
                                </div><!-- navigation_next -->
                                <div class="clearfix"></div>
                            </div>
                </div>
            <?php 
              if ($show_sidebar) 
              {
                  ?>
                <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?> inside right_floated" role="complementary">
                    <?php get_sidebar(); ?>
                </aside><!-- /#sidebar -->
                <?php
              }
          ?>
        </div>
        </div>
        </div>
        </div>
    </div>
</div>
</div>
</div>
<?php endwhile; /* End loop */ ?>
<?php get_footer(); ?>