<?php
/*
Template Name: Page - Contact
*/
?>
<?php 
    get_header(); 
    $show_sidebar=false;
    $show_title=false;
    $data = get_post_meta( $post->ID, '_custom_meta_contact-page_template', true );
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
    }
    //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
    if (INJECT_STYLE)
    {
        include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');    
    }
?>
<div id="centered_block"> 
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
    <?php
        $extra_pad="";
        if ($show_title==true)
        {
            prk_output_title($data);
            $extra_pad=' class="prk_more_space"';
        }
    ?>
    <div id="content">
        <?php 
            if ($prk_samba_frontend_options['google-maps']!="")
            {
                echo '<div id="google-maps"'.$extra_pad.'>';
                echo $prk_samba_frontend_options['google-maps'];
                echo '<div class="spinner"><div class="spinner-icon"></div></div>';
                echo '</div>';
            } 
        ?>
        <div id="main" class="prk_inner_block columns centered main_no_sections">
            <?php
            if ($show_sidebar)
            {
              echo '<div class="twelve sidebarized">';
            }
            else
            {
              echo '<div class="twelve top_40">';
            }
                while (have_posts()) : the_post();
                if (get_the_content()!="")
                {
                    ?>
                    <div class="twelve columns contact_content">
                        <?php echo do_shortcode($prk_samba_frontend_options['contact-body']); ?>
                            <?php the_content(); ?>
                    </div>
                    <?php
                }
                endwhile;
            ?>
            <div class="clearfix"></div>
                <div id="contact_lower">
                    <div id="contact_side" class="columns">
                <div id="contact_address">
                    <?php 
                        if ($prk_samba_frontend_options['contact-body']!="")
                        {
                            ?>
                            <div class="contact_header prk_titlify_father">
                                <h4 class="header_font bd_headings_text_shadow zero_color">
                                    <?php echo do_shortcode($prk_samba_frontend_options['contact-info_title_body']); ?>
                                </h4>
                            </div>
                            <div class="contact_content on_colored">
                                <?php echo do_shortcode($prk_samba_frontend_options['contact-body']); ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="contact_header prk_titlify_father">
                        <h4 class="header_font bd_headings_text_shadow zero_color">
                            <?php echo do_shortcode($prk_samba_frontend_options['contact-info_title']); ?>
                        </h4>    
                    </div>
                    <div class="contact_info">
                        <?php
                        if ($prk_samba_frontend_options['contact-right_header']!="")
                            {
                                ?>
                                <div>
                                    <span>
                                        <strong><?php echo do_shortcode($prk_samba_frontend_options['contact-right_header']); ?></strong>
                                    </span>
                                </div>
                                <?php
                            }
                            if ($prk_samba_frontend_options['contact-address']!="")
                            {
                                ?>
                                <div class="ctt_address">
                                    <span>
                                        <?php echo do_shortcode($prk_samba_frontend_options['contact-address']); ?>
                                    </span>
                                </div>
                                <?php
                            }
                            if ($prk_samba_frontend_options['contact-info_tel']!="")
                            {
                                ?>
                                <div class="six_margin_bt">
                                    <div class="single_portfolio_headings zero_color header_font">
                                        <?php echo($prk_samba_frontend_options['contact-info_tel_h']); ?>
                                    </div>
                                    <div class="block_description">
                                        <?php echo do_shortcode($prk_samba_frontend_options['contact-info_tel']); ?>
                                    </div>
                                </div>
                                <?php
                            }
                            if ($prk_samba_frontend_options['contact-info_fax']!="")
                            {
                                ?>
                                <div class="six_margin_bt">
                                    <div class="single_portfolio_headings zero_color header_font">
                                    <?php echo($prk_samba_frontend_options['contact-info_fax_h']); ?>
                                    </div>
                                    <div class="block_description">
                                        <?php echo " ".do_shortcode($prk_samba_frontend_options['contact-info_fax']); ?>
                                    
                                    </div>
                                </div>
                                <?php
                            }
                            if ($prk_samba_frontend_options['contact-info_email']!="")
                            {
                                ?>
                                <div class="six_margin_bt">
                                    <div class="single_portfolio_headings zero_color header_font">
                                    <?php echo($prk_samba_frontend_options['contact-info_email_h']); ?> 
                                    </div>
                                    <div class="block_description">
                                        <a href="mailto:<?php echo antispambot($prk_samba_frontend_options['contact-info_email']); ?>" class="zero_color">
                                        <?php echo antispambot($prk_samba_frontend_options['contact-info_email']); ?>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div id="half_helper" class="clearfix"></div>
            </div>
                    <div id="contact_description" class="twelve columns halfsized">
                    <div id="contact_form">
                        <div class="contact_header prk_titlify_father">
                            <h4 class="header_font bd_headings_text_shadow zero_color">
                                <?php echo do_shortcode($prk_samba_frontend_options['contact-info_title_form']); ?>
                            </h4>   
                        </div>
                        <div class="clearfix"></div>
                        <?php 
                            if ($prk_samba_frontend_options['contact-shortcode']!="") 
                            {
                                echo do_shortcode($prk_samba_frontend_options['contact-shortcode']);
                            }
                            else
                            {
                                ?>
                                <form action="#" id="contact-form" method="post" data-empty='<?php echo esc_attr($prk_translations['empty_text_error']); ?>' data-invalid='<?php echo esc_attr($prk_translations['invalid_email_error']); ?>' data-ok='<?php echo esc_attr($prk_translations['contact_ok_text']); ?>' data-name='<?php bloginfo('name'); ?>'>
                                    <div class="row">
                                        <div class="six columns">
                                            <input type="text" class="pirenko_highlighted" name="c_name" id="c_name" 
                                            placeholder="<?php echo esc_attr($prk_translations['comments_author_text']);echo esc_attr($prk_translations['required_text']); ?>"  data-original="<?php echo esc_attr($prk_translations['comments_author_text']);echo esc_attr($prk_translations['required_text']); ?>" />
                                        </div>
                                        <div class="six columns">
                                                <input type="text" class="pirenko_highlighted" name="c_email" id="c_email" size="28"                           placeholder="<?php echo esc_attr($prk_translations['comments_email_text']);echo esc_attr($prk_translations['required_text']); ?>"/>
                                        </div>
                                        <div class="twelve columns">
                                            <input type="text" class="pirenko_highlighted" name="c_subject" id="c_subject" size="28"
                                            placeholder="<?php echo esc_attr($prk_translations['contact_subject_text']); ?>" />
                                        
                                            <textarea class="pirenko_highlighted" name="c_message" id="c_message" rows="8"
                                            placeholder="<?php echo esc_attr($prk_translations['contact_message_text']); ?>" data-original="<?php echo esc_attr($prk_translations['contact_message_text']); ?>" ></textarea>
                                       
                                        </div>
                                    </div>
                                    <?php
                                        if (!isset($prk_translations['contact_submit']))
                                            $prk_translations['contact_submit']='Send Message';
                                    ?>
                                    <input type="hidden" id="full_subject" name="full_subject" value="" />
                                    <input type="hidden" name="rec_email" value="<?php echo $prk_samba_frontend_options['email_address']; ?>" />
                                    <div id="contact_ok" class="zero_color header_font bd_headings_text_shadow"><?php echo($prk_translations['contact_wait_text']); ?></div>
                                    <input type="hidden" name="c_submitted" id="c_submitted" value="true" />
                                    <div class="clearfix"></div>
                                    <div id="submit_message_div" class="theme_button">
                                        <a href="#" ><?php echo($prk_translations['contact_submit']); ?></a>
                                    </div>
                                </form>
                                <?php
                            }
                        ?>
                    </div><!-- contact form wrap -->
                    <div class="clearfix"></div>
                </div>
        </div>
            </div>
            <?php 
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
          
          <div class="clearfix"></div>
        </div><!-- /#main -->
    </div><!-- /#content -->
</div><!-- #main_block -->
</div>
<?php get_footer(); ?>