<?php
    if(!function_exists('wp_head')) {
        if(file_exists('../../../../wp-load.php')) {
            include '../../../../wp-load.php';
        } 
        else {
            include '../../../../../wp-load.php';
        }
        $post_id = $_POST['entry_id'];
        $my_query = new WP_Query();
        $args = array(  'post_type' => 'pirenko_portfolios','p' => $post_id);
        $my_query->query($args);
        $prk_samba_frontend_options=get_option('samba_theme_options');
        //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
        if (INJECT_STYLE) {
            include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');   
        }
        $single_max_width=($prk_samba_frontend_options['custom_width']-130)*0.68;//APLLIED 0.68, because it's eight columns
        $retina_flag = $_POST['retina_device'] === "prk_retina" ? true : false;
        $site_background_color=$prk_samba_frontend_options['site_background_color'];
        $background_color_header=$prk_samba_frontend_options['background_color_header'];
        //TRANSLATE ACCORDING TO THE SELECTED METHOD
        if ($prk_samba_frontend_options['theme_translation']=="no"){
            $prk_translations=$prk_samba_frontend_options;
            if (!isset($prk_translations['prev_prj_text'])) {
                $prk_translations['prev_prj_text']="Previous Project";
            }
            if (!isset($prk_translations['next_prj_text'])) {
                $prk_translations['next_prj_text']="Next Project";
        }
        }
        else
        {
            // Make theme available for translation
            load_theme_textdomain('samba_lang', get_template_directory() . '/lang');
            $prk_translations['like_text']=__("I like this!", 'samba_lang');
            $prk_translations['already_liked_text']=__("You already liked this.", 'samba_lang');
            $prk_translations['share_text']=__("Share", 'samba_lang');
            $prk_translations['launch_text']=__("Project URL", 'samba_lang');
            $prk_translations['skills_text']=__("Skills", 'samba_lang');
            $prk_translations['client_text']=__("Client", 'samba_lang');
            $prk_translations['date_text']=__("Date", 'samba_lang');
            $prk_translations['next_prj_text']=__("Next Project", 'samba_lang');
            $prk_translations['prev_prj_text']=__("Previous Project", 'samba_lang');
        }
    }




//-------------------------------------------------------------------------------------
//------------------------------------ FULL LAYOUT ------------------------------------

    if ($_POST['entry_layout']=="full" || $_POST['entry_layout']=="fullout")
    {   
        if ($my_query->have_posts()) :
            while ($my_query->have_posts()) : $my_query->the_post();
            $data = get_post_meta( get_the_ID(), '_custom_meta', true );
                global $simple_mb;
                $data=$simple_mb->the_meta();
                $sl_id="single_slider";
                $sl_class="flexslider boxed_shadow";
                $slides_class="";
                if (isset($data['no_slider']) && $data['no_slider']=="1")
                {
                    $sl_id="not_slider";
                    $sl_class="";
                    $slides_class="boxed_shadow";
                }
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
                if ($_POST['entry_layout']=="fullout") {
                    $featured_class.=" wideout";
                }
                ?>
             <div id="content" class="has_top_bar prk_tucked">
                <div id="main" class="main_no_sections row"> 
                    <div class="twelve">
                <article id="prk_full_folio" <?php post_class($featured_class); ?> data-color="<?php echo $featured_color; ?>">
                     <div id="<?php echo $sl_id; ?>" class="<?php echo $sl_class; ?>" data-color="<?php echo $featured_color; ?>">
                                <ul class="slides" data-autoplay="<?php echo $prk_samba_frontend_options['autoplay_portfolio']; ?>">
                                    <?php
                                        $ext_count=0;
                                        if (!isset($data['skip_featured']))
                                            $data['skip_featured']=0;
                                        if ($data['skip_featured']!=1 || $data['skip_featured']=="")
                                        {
                                            if (has_post_thumbnail( $post->ID ) )
                                            {
                                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                                                $image[0] = get_image_path($image[0]);
                                                $in_ttl="";
                                                $alt_text="";
                                                if ( $thumb = get_post_thumbnail_id() )
                                                {
                                                    $in_ttl=get_post( $thumb )->post_title;
                                                    $alt_text=get_post_meta($thumb, '_wp_attachment_image_alt', true);
                                                }
                                                echo '<li id="slide_1" class="'.$slides_class.'">';
                                                if (0)//$prk_samba_frontend_options['folio_enable_lightbox']=="yes"
                                                {
                                                    echo '<div class="prk_magnificent_li body_bk_color" data-mfp-src="'.$image[0].'">';
                                                    echo '<div class="navicon-expand-2"></div>';
                                                    echo '</div>';
                                                }
                                                $ext_count=1;
                                                $vt_image = vt_resize( '', $image[0] , 1920, 1200, false , $retina_flag );
                                                echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" />';
                                                echo '</li>';
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
                                                    ?>
                                                    
                                                        <?php 
                                                            if (substr($data['image_'.$count],0,6)=="http:/" || substr($data['image_'.$count],0,7)=="https:/")
                                                            {
                                                                echo "<li id=slide_".$ext_count." class='".$slides_class."''>";
                                                                if (0)//$prk_samba_frontend_options['folio_enable_lightbox']=="yes"
                                                                {
                                                                    echo '<div class="prk_magnificent_li body_bk_color" data-mfp-src="'.$data['image_'.$count].'">';
                                                                    echo '<div class="navicon-expand-2"></div>';
                                                                    echo '</div>';
                                                                }
                                                                $alt_text = get_post_meta(get_attachment_id_from_src($data['image_'.$count]), '_wp_attachment_image_alt', true);
                                                                $vt_image = vt_resize( '', $data['image_'.$count] , 1920, 1200, false , $retina_flag );
                                                                echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" />';
                                                                echo "</li>";
                                                            }
                                                            else
                                                            {
                                                                echo "<li id=slide_".$ext_count." class='slide_video ".$slides_class."''>";
                                                                if (0)//$prk_samba_frontend_options['folio_enable_lightbox']=="yes"
                                                                {
                                                                    echo '<div class="prk_magnificent_li body_bk_color mfp-iframe" data-mfp-src="'.get_iframe_src($data['image_'.$count]).'">';
                                                                    echo '<div class="navicon-expand-2"></div>';
                                                                    echo '</div>';
                                                                }
                                                                $el_class='prk-video-container';
                                                                if (strpos($data['image_'.$count],'soundcloud.com') !== false) {
                                                                  $el_class= 'soundcloud-container';
                                                                }
                                                                echo "<div class='".$el_class."'>";
                                                                echo $data['image_'.$count];
                                                                echo "</div></li>";
                                                            }
                                                        ?>
                                                    
                                                    <?php 
                                                }
                                            }
                                        }
                                        //ADJUST CONTENTS IF THERE ARE NO IMAGES TO SHOW
                                        if ($ext_count==0)
                                        {
                                            echo  '<style type="text/css">
                                                    .flexslider
                                                    {
                                                        display:none;
                                                    }
                                                    </style>';
                                        }
                                    ?>
                                    <div id="ctrls_container" class="four columns">
                                    </div>
                                </ul><!-- slides -->
                            </div><!-- flexslider home_slider -->  
                <div class="prk_inner_block columns centered prk_no_change"> 
                    <div class="row prk_row"  style="position:relative;">
                        <div class="row"> 
                        <div id="prk_full_size_single">
                            <div class="twelve columns halfsized">
                                <div class="prk_titlify_father">
                                        <h2 class="header_font bd_headings_text_shadow zero_color">
                                            <?php the_title(); ?>
                                        </h2>
                                    </div>
                                  <div class="single-entry-content prk_no_composer">
                                      <?php the_content(); ?>
                                  </div>
                                  <div class="clearfix"></div>
                            </div><!--twelve columns -->
                        </div>
                            <div id="full-entry-right" class="columns">
                                <div class="prk_titlify_father">
                                        <h2 class="header_font bd_headings_text_shadow zero_color prk_invisible">
                                            <?php echo "Details" ?>
                                        </h2>
                                    </div>
                <?php 
                    $data=$simple_mb->the_meta();
                      if ($prk_samba_frontend_options['dateby_port']=="yes")
                      {
                          ?>
                          <div class="six_margin_bt">
                                <div class="single_portfolio_headings zero_color header_font">
                                    <?php echo($prk_translations['date_text']); ?>
                                </div>
                                
                                <div class="block_description">
                                    <?php echo " ".the_date(); ?>
                                </div>
                           </div>
                          <?php
                      }
                  ?>
                                  <?php 
                                    if ($prk_samba_frontend_options['categoriesby_port']=="yes")
                                    {
                                        if (get_the_term_list(get_the_ID(),'pirenko_skills')!="")
                                        {
                                            ?>
                                            <div class="six_margin_bt">
                                                <div class="single_portfolio_headings zero_color header_font">
                                                    <?php echo($prk_translations['skills_text']); ?>
                                                </div>
                                                <div class="block_description default_color side_skills">
                                                    <?php echo " ".get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
                                <?php
                                if (isset($data['client_url']) && $data['client_url']!="")
                                { 
                                    ?>
                                    <div class="six_margin_bt">
                                        <div class="single_portfolio_headings zero_color header_font">
                                        <?php echo($prk_translations['client_text']); ?>
                                        </div>
                                        <div class="block_description">
                                            <?php echo " ".$data['client_url']; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                if (isset($data['ext_url']) && $data['ext_url']!="") { 
                                    //ADD HTTP PREFIX IF NEEDED
                                    if (substr($data['ext_url'],0,7)!="http://")
                                        $data['ext_url']="http://".$data['ext_url'];
                                    ?>
                                        <div id="full_portfolio_link" class="theme_button">
                                            <a class="view_more_single left_floated colored_button" href="<?php echo $data['ext_url']; ?>" target="_blank" data-color="<?php echo $featured_color; ?>">
                                                <?php
                                                    if (isset($data['ext_url_label']) && $data['ext_url_label']!="") 
                                                    {
                                                        echo($data['ext_url_label']);
                                                    }
                                                    else {
                                                        
                                                        echo($prk_translations['launch_text']);
                                                    }
                                                    echo " &rarr;"; 
                                                ?>
                                            </a>
                                        </div>
                                    <?php
                                }
            ?> 
            <div id="half_helper" class="clearfix"></div>
        </div>
    </div>
    </div>
        <div id="prk_nav_close">
            <a href="#" data-pir_title="<?php echo($prk_translations['to_portfolio']); ?>">Portfolio</a>
        </div>
        <div id="prk_nav_left" data-text="<?php echo $prk_translations['prev_prj_text']; ?>"></div>
        <div id="prk_nav_right" data-text="<?php echo $prk_translations['next_prj_text']; ?>"></div>
                            <div class="clearfix"></div>
                            </div><!-- row-->
            <?php
                                if ( $prk_samba_frontend_options['show_heart_folio']=="yes" || $prk_samba_frontend_options['share_portfolio']=="yes")
                                {
                                    echo '<div class="prk_right_panel">';
                                }
                                if ($prk_samba_frontend_options['show_heart_folio']=="yes")
                                {
                                    echo '<div class="fifty_button">';
                                    echo get_folio_like(get_the_ID(),true);
                                    echo '</div>';
                                }
                            if ($prk_samba_frontend_options['share_portfolio']=="yes")
                                {
                                    ?>
                                        <div class="prk_sharrre_wrapper left_floated">
                                            <div class="prk_sharre_btns">
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_del']) && $prk_samba_frontend_options['share_portfolio_del']=="true") { ?>
                                                <div class="prk_sharrre_delicious fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_fb']) && $prk_samba_frontend_options['share_portfolio_fb']=="true") { ?>
                                                <div class="prk_sharrre_facebook fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_goo']) && $prk_samba_frontend_options['share_portfolio_goo']=="true") { ?>
                                                <div class="prk_sharrre_google fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_lnk']) && $prk_samba_frontend_options['share_portfolio_lnk']=="true") { ?>
                                                <div class="prk_sharrre_linkedin fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                <?php 
                                                    if (isset($prk_samba_frontend_options['share_portfolio_pin']) && $prk_samba_frontend_options['share_portfolio_pin']=="true")
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
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_stu']) && $prk_samba_frontend_options['share_portfolio_stu']=="true") { ?>
                                                <div class="prk_sharrre_stumbleupon fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_twt']) && $prk_samba_frontend_options['share_portfolio_twt']=="true") { ?>
                                                <div class="prk_sharrre_twitter fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                  <?php
                                };
                                ?>
            </article>
                </div>
                </div>
            </div>
            <?php
            endwhile; 
        endif;
    }



//-------------------------------------------------------------------------------------
//------------------------------------ HALF LAYOUT ------------------------------------



    if ($_POST['entry_layout']=="half")
    {   
        if ($my_query->have_posts()) :
            while ($my_query->have_posts()) : $my_query->the_post();
            $data = get_post_meta( get_the_ID(), '_custom_meta', true );
            global $simple_mb;
            $data=$simple_mb->the_meta();
            $sl_id="single_slider";
            $sl_class="flexslider boxed_shadow";
            $slides_class="";
            if (isset($data['no_slider']) && $data['no_slider']=="1")
            {
                $sl_id="not_slider";
                $sl_class="";
                $slides_class="boxed_shadow";
            }
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
            <div class="clearfix"></div>
            <div id="content" class="has_top_bar">
                <div id="main" class="main_no_sections"> 
                <div id="prk_ajax_wrapper" class="prk_inner_block centered twelve columns extra_pad">
                    <div id="single_portfolio_ajax">
                        <div class="row prk_row">
                        <div id="single_portfolio_half" <?php post_class($featured_class); ?> data-color="<?php echo $featured_color; ?>">
                            <div class="twelve columns halfsized">
                            <div id="<?php echo $sl_id; ?>" class="<?php echo $sl_class; ?> flexslider_half" data-color="<?php echo $featured_color; ?>">
                                <ul class="slides" data-autoplay="<?php echo $prk_samba_frontend_options['autoplay_portfolio']; ?>">
                                    <?php
                                        $ext_count=0;
                                        if (!isset($data['skip_featured']))
                                            $data['skip_featured']=0;
                                        if ($data['skip_featured']!=1 || $data['skip_featured']=="")
                                        {
                                            if (has_post_thumbnail( $post->ID ) )
                                            {
                                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                                                $in_ttl="";
                                                $alt_text="";
                                                if ( $thumb = get_post_thumbnail_id() )
                                                {
                                                    $in_ttl=get_post( $thumb )->post_title;
                                                    $alt_text=get_post_meta($thumb, '_wp_attachment_image_alt', true);
                                                }
                                                echo '<li id="slide_0" class="'.$slides_class.'">';
                                                if (0)//$prk_samba_frontend_options['folio_enable_lightbox']=="yes"
                                                {
                                                    echo '<div class="prk_magnificent_li body_bk_color" data-mfp-src="'.$image[0].'">';
                                                    echo '<div class="navicon-expand-2"></div>';
                                                    echo '</div>';
                                                }
                                                $ext_count=1;$vt_image = vt_resize( '', $image[0] , $single_max_width, 0, false , $retina_flag );
                                                echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" />';
                                                echo '</li>';
                                                ?>
                                                <?php
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
                                                    ?>
                                                    
                                                        <?php 
                                                            if (substr($data['image_'.$count],0,6)=="http:/" || substr($data['image_'.$count],0,7)=="https:/")
                                                            {
                                                                echo "<li id=slide_".$ext_count." class='".$slides_class."''>";
                                                                if (0)//$prk_samba_frontend_options['folio_enable_lightbox']=="yes"
                                                                {
                                                                    echo '<div class="prk_magnificent_li body_bk_color" data-mfp-src="'.$data['image_'.$count].'">';
                                                                    echo '<div class="navicon-expand-2"></div>';
                                                                    echo '</div>';
                                                                }
                                                                $vt_image = vt_resize( '', $data['image_'.$count] , $single_max_width, 0, false , $retina_flag );
                                                                echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" />';
                                                                echo "</li>";
                                                            }
                                                            else
                                                            {
                                                                echo "<li id=slide_".$ext_count." class='slide_video ".$slides_class."''>";
                                                                if (0)//$prk_samba_frontend_options['folio_enable_lightbox']=="yes"
                                                                {
                                                                    echo '<div class="prk_magnificent_li body_bk_color mfp-iframe" data-mfp-src="'.get_iframe_src($data['image_'.$count]).'">';
                                                                    echo '<div class="navicon-expand-2"></div>';
                                                                    echo '</div>';
                                                                }
                                                                $el_class='prk-video-container';
                                                                if (strpos($data['image_'.$count],'soundcloud.com') !== false) {
                                                                    $el_class= 'soundcloud-container';
                                                                }
                                                                echo "<div class='".$el_class."'>";
                                                                echo $data['image_'.$count];
                                                                echo "</div></li>";
                                                            }
                                                        ?>
                                                    
                                                    <?php 
                                                }
                                            }
                                        }
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
                                    <div id="ctrls_container" class="four columns">
                                    </div>
                                </ul><!-- slides -->
                                </div>
                            </div><!-- flexslider -->

                            <div id="single-entry-content_half" class="columns">
                                 <div id="prk_nav_close">
                                    <a href="<?php echo get_page_link(prk_get_parent_portfolio()); ?>" data-pir_title="<?php echo($prk_translations['to_portfolio']); ?>">Portfolio</a>
                                </div>
                                <div id="prk_nav_left" data-text="<?php echo $prk_translations['prev_prj_text']; ?>"></div>
                                <div id="prk_nav_right" data-text="<?php echo $prk_translations['next_prj_text']; ?>"></div>
                            <div class="clearfix"></div>
                            <div id="portfolio_info_half">
                                 <h2 class="header_font bd_headings_text_shadow zero_color">
                                    <?php the_title(); ?>
                                </h2>
                             <div class="clearfix"></div>
                            </div><!-- #portfolio_info -->
                            <div class="single-entry-content prk_no_composer">
                                <?php the_content(); ?>
                            </div>
                            <div id="tiny_line_half" class="tiny_line" data-color="<?php echo $featured_color; ?>"></div>
                            <div id="single_portfolio_meta">
                                    <?php
                                      if ($prk_samba_frontend_options['dateby_port']=="yes")
                                      {
                                          ?>
                                          <div class="six_margin_bt">
                                                <div class="single_portfolio_headings zero_color header_font">
                                                    <?php echo($prk_translations['date_text']); ?>
                                                </div>
                                                
                                                <div class="block_description">
                                                    <?php echo " ".the_date(); ?>
                                                </div>
                                           </div>
                                          <?php
                                      }
                                  ?>
                                  <?php 
                                    if ($prk_samba_frontend_options['categoriesby_port']=="yes")
                                    {
                                        if (get_the_term_list(get_the_ID(),'pirenko_skills')!="")
                                        {
                                            ?>
                                            <div class="six_margin_bt">
                                                <div class="single_portfolio_headings zero_color header_font">
                                                    <?php echo($prk_translations['skills_text']); ?>
                                                </div>
                                                <div class="block_description default_color side_skills">
                                                    <?php echo " ".get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
                                <?php
                                if (isset($data['client_url']) && $data['client_url']!="")
                                { 
                                    ?>
                                    <div class="six_margin_bt">
                                        <div class="single_portfolio_headings zero_color header_font">
                                        <?php echo($prk_translations['client_text']); ?>
                                        </div>
                                        <div class="block_description">
                                            <?php echo " ".$data['client_url']; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                if (isset($data['ext_url']) && $data['ext_url']!="") { 
                                    //ADD HTTP PREFIX IF NEEDED
                                    if (substr($data['ext_url'],0,7)!="http://")
                                        $data['ext_url']="http://".$data['ext_url'];
                                    ?>
                                        <div id="half_portfolio_link" class="theme_button">
                                            <a class="view_more_single left_floated colored_button" href="<?php echo $data['ext_url']; ?>" target="_blank" data-color="<?php echo $featured_color; ?>">
                                                <?php
                                                    if (isset($data['ext_url_label']) && $data['ext_url_label']!="") 
                                                    {
                                                        echo($data['ext_url_label']);
                                                    }
                                                    else {
                                                        
                                                        echo($prk_translations['launch_text']);
                                                    }
                                                    echo " &rarr;"; 
                                                ?>
                                            </a>
                                        </div>
                                    <?php
                                }
                                ?>
                                <div id="half_helper" class="clearfix"></div>
                            </div>
                            </div>             
                            <?php
                                if ( $prk_samba_frontend_options['show_heart_folio']=="yes" || $prk_samba_frontend_options['share_portfolio']=="yes")
                                {
                                    echo '<div class="prk_right_panel">';
                                }
                                if ($prk_samba_frontend_options['show_heart_folio']=="yes")
                                {
                                    echo '<div class="fifty_button">';
                                    echo get_folio_like(get_the_ID(),true);
                                    echo '</div>';
                                }
                            if ($prk_samba_frontend_options['share_portfolio']=="yes")
                                {
                                    ?>
                                        <div class="prk_sharrre_wrapper left_floated">
                                            <div class="prk_sharre_btns">
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_del']) && $prk_samba_frontend_options['share_portfolio_del']=="true") { ?>
                                                <div class="prk_sharrre_delicious fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_fb']) && $prk_samba_frontend_options['share_portfolio_fb']=="true") { ?>
                                                <div class="prk_sharrre_facebook fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_goo']) && $prk_samba_frontend_options['share_portfolio_goo']=="true") { ?>
                                                <div class="prk_sharrre_google fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_lnk']) && $prk_samba_frontend_options['share_portfolio_lnk']=="true") { ?>
                                                <div class="prk_sharrre_linkedin fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                <?php 
                                                    if (isset($prk_samba_frontend_options['share_portfolio_pin']) && $prk_samba_frontend_options['share_portfolio_pin']=="true")
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
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_stu']) && $prk_samba_frontend_options['share_portfolio_stu']=="true") { ?>
                                                <div class="prk_sharrre_stumbleupon fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                                
                                                <?php if (isset($prk_samba_frontend_options['share_portfolio_twt']) && $prk_samba_frontend_options['share_portfolio_twt']=="true") { ?>
                                                <div class="prk_sharrre_twitter fifty_button site_background_colored" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-title="share">
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                  <?php
                                };
                                ?>
                                <div class="clearfix"></div>
                            </div><!-- single_post_wp -->
                        <div class="clearfix"></div>
                        </div><!-- twelve columns -->
                        <div class="clearfix"></div>
                    </div>
                </div><!-- ajax_wrapper -->
            </div>
            <?php
            endwhile; 
        endif;
    }//HALF
    wp_reset_query();
?>