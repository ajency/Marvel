<?php 
    get_header();
    global $retina_device;
    $retina_flag = $retina_device === "prk_retina" ? true : false;
    $single_max_width=$prk_samba_frontend_options['custom_width']*0.72;//APLLIED 0.72, because it's eight columns
    //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
    if (INJECT_STYLE)
    {
        include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');  
    }
    $site_background_color=$prk_samba_frontend_options['site_background_color'];
    $pf_layout=$prk_samba_frontend_options['portfolio_layout'];
?>
            <?php 
                while (have_posts()) : the_post(); 
                $meta = get_post_meta( $post->ID, 'key', true );
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
                if (isset($data['inner_layout']) && $data['inner_layout']!="default")
                    $pf_layout=$data['inner_layout'];

                //------------------------ WIDE LAYOUT ------------------------
                if ($pf_layout=="wide" || $pf_layout=="wideout")
                {
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
                    if ($pf_layout=="wideout") {
                        $featured_class.=" wideout";
                    }
                    ?>
                    <div id="centered_block" class="prk_no_change"> 
                        <div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
                <div id="content" class="has_top_bar prk_tucked" data-parent="<?php echo get_page_link(prk_get_parent_portfolio()); ?>">
                <div id="main" class="main_no_sections"> 
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
                                                $ext_count=1;
                                                $vt_image = vt_resize( '', $image[0] , 1920, 1200, false , $retina_flag );
                                                if ($prk_samba_frontend_options['folio_enable_lightbox']=="yes")
                                                {
                                                    echo '<div class="prk_magnificent_li body_bk_color" data-mfp-src="'.$image[0].'">';
                                                    echo '<div class="navicon-expand-2"></div>';
                                                    echo '</div>';
                                                }
                                                echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($image[0]).'" />';
                                                echo '</li>';
                                            }
                                        }
                                        $flagger=true;//VARIABLE TO CHECK IF THERE'S ONLY ONE IMAGE
                                        //PLACE THE OTHER NINETEEN IMAGES
                                        for ($count=2;$count<21;$count++)
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
                                                                echo "<li id=slide_".$ext_count." class='".$slides_class."'>";
                                                                if ($prk_samba_frontend_options['folio_enable_lightbox']=="yes")
                                                                {
                                                                    echo '<div class="prk_magnificent_li body_bk_color" data-mfp-src="'.$data['image_'.$count].'">';
                                                                    echo '<div class="navicon-expand-2"></div>';
                                                                    echo '</div>';
                                                                }
                                                                $image_alt=$data['image_'.$count];
                                                                $vt_image = vt_resize( '', $data['image_'.$count] , 1920, 1200, false , $retina_flag );
                                                                echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($image_alt).'" />';
                                                                echo "</li>";
                                                            }
                                                            else
                                                            {
                                                                echo "<li id=slide_".$ext_count." class='slide_video ".$slides_class."'>";
                                                                if ($prk_samba_frontend_options['folio_enable_lightbox']=="yes")
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
                                </ul><!-- slides -->
                            </div><!-- flexslider home_slider -->
                            <div class="clearfix"></div>
                            <div class="prk_inner_block columns centered prk_no_change"> 
                            <div class="row"> 
                    <div class="row prk_row" style="position:relative;">
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
                                                    <?php echo the_date(); ?>
                                                </div>
                                           </div>
                                          <?php
                                      }
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
                                                    <?php echo get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    if (get_the_term_list(get_the_ID(),'portfolio_tag')!="")
                                      {
                                          ?>
                                            <div class="six_margin_bt">
                                                <div class="single_portfolio_headings zero_color header_font">
                                                    <?php echo($prk_translations['tags_text']); ?>
                                                </div>
                                                <div class="block_description default_color side_skills">
                                                    <?php echo get_the_term_list(get_the_ID(),'portfolio_tag', '', ', ', '' ); ?>
                                                </div>
                                            </div>
                                          <?php
                                      }
                                if (isset($data['client_url']) && $data['client_url']!="")
                                { 
                                    ?>
                                    <div class="six_margin_bt">
                                        <div class="single_portfolio_headings zero_color header_font">
                                        <?php echo($prk_translations['client_text']); ?>
                                        </div>
                                        <div class="block_description">
                                            <?php echo $data['client_url']; ?>
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
            </div>
            <div id="half_helper" class="clearfix"></div>
        </div>
    </div>
        <div id="prk_nav_close">
            <a href="<?php echo get_page_link(prk_get_parent_portfolio()); ?>" data-pir_title="<?php echo($prk_translations['to_portfolio']); ?>">Portfolio</a>
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
        ?>
                            <div class="clearfix"></div>
                            </div><!-- row--> 
                            <div class="clearfix"></div>
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
                                  <?php
                                };
                                if ( $prk_samba_frontend_options['show_heart_folio']=="yes" || $prk_samba_frontend_options['share_portfolio']=="yes")
                                {
                                    echo '</div>';
                                }
                                ?>
            <?php
                if ((isset($prk_samba_frontend_options['related_port']) && $prk_samba_frontend_options['related_port']=="yes") || comments_open(get_the_ID()))
                {
                    ?> 
                    <div id="after_single_folio" class="twelve centered prk_inner_block columns">      
                        <?php 
                            if (isset($prk_samba_frontend_options['related_port']) && $prk_samba_frontend_options['related_port']=="yes")
                            {
                                if (get_the_terms(get_the_ID(), 'pirenko_skills')!="") 
                                {
                                    global $prk_category_ids;
                                    $prk_category_ids="";
                                    foreach(get_the_terms(get_the_ID(), 'pirenko_skills') as $term)
                                    {
                                        $prk_category_ids.= $term->slug.", ";   
                                    }
                                    $args=array(
                                        'post_type' => 'pirenko_portfolios',
                                        'pirenko_skills' => $prk_category_ids,
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page'=> 3,
                                        'orderby' => 'rand'
                                    );
                                }
                                else
                                {
                                    //THIS POST HAS NO CATEGORIES. LET'S SHOW ALL
                                    $args=array(
                                        'post_type' => 'pirenko_portfolios',
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page'=> 3,
                                        'orderby' => 'rand'
                                    );
                                }
                                $loop = new WP_Query( $args );
                                if ($loop->post_count>0)
                                {
                                    ?>
                                        <div id="related_projects_wp">
                                        <div class="prk_titlify_father">
                                            <h3 class="small header_font bd_headings_text_shadow prk_bold zero_color">
                                                <?php echo($prk_translations['related_text']); ?>
                                            </h3>
                                        </div>
                                            <ul id="carousel_single" class="elastislide-list">  
                                                    <?php 
                                                    $l_count=1;
                                                    while ( $loop->have_posts() ) : $loop->the_post();
                                                        if($l_count % 3 == 0)
                                                            $p_class="third_related";
                                                        else
                                                            $p_class="";
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
                                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                                        $image[0] = get_image_path($image[0]);
                                                        $skills_links="";
                                                        $skills_names="";
                                                        $skills_yo="";
                                                        $skills_output="";
                                                        $terms = get_the_terms ($post->ID, 'pirenko_skills');
                                                        if (!empty($terms))
                                                        {
                                                            foreach ($terms as $term) {
                                                                $skills_links[] = $term->slug;
                                                                $skills_names[] = $term->name;
                                                                }
                                                        
                                                            $skills_yo = join(" ", $skills_links);
                                                            $skills_output = join(", ", $skills_names);
                                                        }
                                                        ?>
                                                        <li class="<?php echo $featured_class; ?>related_post <?php echo $p_class; ?>" data-color="<?php echo $featured_color; ?>">
                                                            <a href="<?php the_permalink(); ?>" class="fade_anchor">
                                                                <div class="grid_colored_block">
                                                                </div>
                                                                <div id="grid_title-<?php the_ID(); ?>" class="grid_single_title">
                                                                    <div class="prk_ttl">
                                                                        <h4 class="header_font body_bk_color body_bk_text_shadow big">
                                                                            <?php the_title(); ?>
                                                                        </h4>
                                                                    </div>
                                                                    <?php 
                                                                        if ($skills_output!="" && $prk_samba_frontend_options['categoriesby_port']=="yes")
                                                                        {
                                                                            ?>
                                                                            <div class="inner_skills header_font menu_bk_color">
                                                                                <?php echo $skills_output; ?>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </div><!-- grid_single_title -->
                                                                <?php
                                                                    $vt_image = vt_resize( '', $image[0] , 700, 463, true , $retina_flag );
                                                                ?>
                                                                <img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img" alt="<?php echo prk_get_img_alt($image[0]); ?>" />
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $l_count++;
                                                    endwhile;
                                                    //RESET MAIN LOOP
                                                    wp_reset_postdata();
                                                    ?>
                                                </ul>
                                            </div>
                                        
                                <?php
                                }
                            }
                        ?>  
                        <?php comments_template(); ?>
                    </div>
                </div>
                    <?php
                }
                ?>
                </article>
</div>
                    
            <div class="clearfix"></div>                        
                            <?php
                        }
                        else 
                        {
                            //-------------------------- HALF LAYOUT  --------------------------
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
                            ?>
                            <div id="centered_block" class="prk_inner_block columns centered prk_no_change"> 
                            <div id="main_block" class="row page-<?php echo get_the_ID(); ?>">   
                <div id="content" class="has_top_bar" data-parent="<?php echo get_page_link(prk_get_parent_portfolio()); ?>">
                <div id="main" class="main_no_sections"> 
                    <div class="prk_row">
                        <article id="single_portfolio_half" <?php post_class($featured_class); ?> data-color="<?php echo $featured_color; ?>">
                            
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
                                                echo '<li id="slide_1" class="'.$slides_class.'">';
                                                if ($prk_samba_frontend_options['folio_enable_lightbox']=="yes")
                                                {
                                                    echo '<div class="prk_magnificent_li body_bk_color" data-mfp-src="'.$image[0].'">';
                                                    echo '<div class="navicon-expand-2"></div>';
                                                    echo '</div>';
                                                }
                                                $ext_count=1;
                                                $vt_image = vt_resize( '', $image[0] , $single_max_width, 0, false , $retina_flag );
                                                echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($image[0]).'" />';
                                                echo '</li>';
                                                ?>
                                                <?php
                                            }
                                        }
                                        $flagger=true;//VARIABLE TO CHECK IF THERE'S ONLY ONE IMAGE
                                        //PLACE THE OTHER NINETEEN IMAGES
                                        for ($count=2;$count<21;$count++)
                                        {
                                            if (isset($data['image_'.$count]))
                                            {
                                                if ($data['image_'.$count]!="")
                                                {
                                                    $ext_count++;
                                                    if ($ext_count>1):
                                                        $flagger=false;
                                                    endif;
                                                            if (substr($data['image_'.$count],0,6)=="http:/" || substr($data['image_'.$count],0,7)=="https:/")
                                                            {
                                                                echo "<li id=slide_".$ext_count." class='".$slides_class."'>";
                                                                if ($prk_samba_frontend_options['folio_enable_lightbox']=="yes")
                                                                {
                                                                    echo '<div class="prk_magnificent_li body_bk_color" data-mfp-src="'.$data['image_'.$count].'">';
                                                                    echo '<div class="navicon-expand-2"></div>';
                                                                    echo '</div>';
                                                                }
                                                                $image_alt=$data['image_'.$count];
                                                                $vt_image = vt_resize( '', $data['image_'.$count] , $single_max_width, 0, false , $retina_flag );
                                                                echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="'.prk_get_img_alt($image_alt).'" />';
                                                                echo "</li>";
                                                            }
                                                            else
                                                            {
                                                                echo "<li id=slide_".$ext_count." class='slide_video ".$slides_class."'>";
                                                                if ($prk_samba_frontend_options['folio_enable_lightbox']=="yes")
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
                                    ?>
                                </ul><!-- slides -->
                                </div>
                            </div><!-- flexslider -->

                            <div id="single-entry-content_half" class="columns">
                                 <div id="prk_nav_close">
                                    <a href="<?php echo get_page_link(prk_get_parent_portfolio()); ?>" data-pir_title="<?php echo($prk_translations['to_portfolio']); ?>">Portfolio</a>
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
                                ?>
                            <div class="clearfix"></div>
                            <div id="portfolio_info_half">
                                 <h2 class="header_font bd_headings_text_shadow zero_color">
                                    <?php the_title(); ?>
                                </h2>
                             <div class="clearfix"></div>
                            </div>
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
                                                    <?php echo the_date(); ?>
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
                                                    <?php echo get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    if (get_the_term_list(get_the_ID(),'portfolio_tag')!="")
                                      {
                                          ?>
                                            <div class="six_margin_bt">
                                                <div class="single_portfolio_headings zero_color header_font">
                                                    <?php echo($prk_translations['tags_text']); ?>
                                                </div>
                                                <div class="block_description default_color side_skills">
                                                    <?php echo get_the_term_list(get_the_ID(),'portfolio_tag', '', ', ', '' ); ?>
                                                </div>
                                            </div>
                                          <?php
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
                                            <?php echo $data['client_url']; ?>
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
                                  <?php
                                };
                                if ( $prk_samba_frontend_options['show_heart_folio']=="yes" || $prk_samba_frontend_options['share_portfolio']=="yes")
                                {
                                    echo '</div>';
                                }
                if ((isset($prk_samba_frontend_options['related_port']) && $prk_samba_frontend_options['related_port']=="yes") || comments_open(get_the_ID()))
                {
                    ?>
                    <div class="clearfix"></div>
                    </article>
                </div>

             <div id="after_single_folio">      
            <?php 
                if (isset($prk_samba_frontend_options['related_port']) && $prk_samba_frontend_options['related_port']=="yes")
                {
                    if (get_the_terms(get_the_ID(), 'pirenko_skills')!="") 
                    {
                        global $prk_category_ids;
                        $prk_category_ids="";
                        foreach(get_the_terms(get_the_ID(), 'pirenko_skills') as $term)
                        {
                            $prk_category_ids.= $term->slug.", ";   
                        }
                        $args=array(
                            'post_type' => 'pirenko_portfolios',
                            'pirenko_skills' => $prk_category_ids,
                            'post__not_in' => array($post->ID),
                            'posts_per_page'=> 3,
                            'orderby' => 'rand'
                        );
                    }
                    else
                    {
                        //THIS POST HAS NO CATEGORIES. LET'S SHOW ALL
                        $args=array(
                            'post_type' => 'pirenko_portfolios',
                            'post__not_in' => array($post->ID),
                            'posts_per_page'=> 3,
                            'orderby' => 'rand'
                        );
                    }
                    $loop = new WP_Query( $args );
                    if ($loop->post_count>0)
                    {
                        ?>
                                        <div id="related_projects_wp">
                                        <div class="prk_titlify_father">
                                            <h3 class="small header_font bd_headings_text_shadow prk_bold zero_color">
                                                <?php echo($prk_translations['related_text']); ?>
                                            </h3>
                                        </div>
                                            <ul id="carousel_single" class="elastislide-list">  
                                                    <?php 
                                                    $l_count=1;
                                                    while ( $loop->have_posts() ) : $loop->the_post();
                                                        if($l_count % 3 == 0)
                                                            $p_class="third_related";
                                                        else
                                                            $p_class="";
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
                                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                                                        $image[0] = get_image_path($image[0]);
                                                        $skills_links="";
                                                        $skills_names="";
                                                        $skills_yo="";
                                                        $skills_output="";
                                                        $terms = get_the_terms ($post->ID, 'pirenko_skills');
                                                        if (!empty($terms))
                                                        {
                                                            foreach ($terms as $term) {
                                                                $skills_links[] = $term->slug;
                                                                $skills_names[] = $term->name;
                                                                }
                                                        
                                                            $skills_yo = join(" ", $skills_links);
                                                            $skills_output = join(", ", $skills_names);
                                                        }
                                                        ?>
                                                        <li class="<?php echo $featured_class; ?>related_post <?php echo $p_class; ?>" data-color="<?php echo $featured_color; ?>">
                                                            <a href="<?php the_permalink(); ?>" class="fade_anchor">
                                                                <div class="grid_colored_block">
                                                                </div>
                                                                <div id="grid_title-<?php the_ID(); ?>" class="grid_single_title">
                                                                    <div class="prk_ttl">
                                                                        <h4 class="header_font body_bk_color body_bk_text_shadow big">
                                                                            <?php the_title(); ?>
                                                                        </h4>
                                                                    </div>
                                                                    <?php 
                                                                        if ($skills_output!="" && $prk_samba_frontend_options['categoriesby_port']=="yes")
                                                                        {
                                                                            ?>
                                                                            <div class="inner_skills header_font menu_bk_color">
                                                                                <?php echo $skills_output; ?>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </div><!-- grid_single_title -->
                                                                <?php
                                                                    $vt_image = vt_resize( '', $image[0] , 700, 463, true , $retina_flag );
                                                                ?>
                                                                <img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img" alt="<?php echo prk_get_img_alt($image[0]); ?>" />
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $l_count++;
                                                    endwhile;
                                                    //RESET MAIN LOOP
                                                    wp_reset_postdata();
                                                    ?>
                                                </ul>
                                            </div>
                                    
                        <?php
                    }
                }
            ?>  
            
                <?php comments_template(); ?>
                <?php
            }
            ?>
            <div class="clearfix"></div>
        </div>
        </div>
        </div>
       <?php
                        }
                    endwhile; /* End loop */
                    ?>
        </div>
    </div>
</div>
</div>
<?php get_footer(); ?>
