<?php

add_shortcode('sola_testimonial', 'sola_t_all_testimonials');
add_shortcode('sola_t_all_testimonials', 'sola_t_all_testimonials');
add_shortcode('sola_testimonials_all', 'sola_t_all_testimonials');



function sola_t_all_testimonials($atts){
    global $post;

    $options = get_option('sola_t_options_settings');
    
    isset($options['show_title']) ? $show_title = $options['show_title'] : $show_title = "";
    isset($options['show_excerpt']) ? $show_body = $options['show_excerpt'] : $show_body = "";
    isset($options['show_user_name']) ? $show_name = $options['show_user_name'] : $show_name = "";
    isset($options['show_user_web']) ? $show_website = $options['show_user_web'] : $show_website = "";
    isset($options['show_image']) ? $show_image = $options['show_image'] : $show_image = "";
    isset($options['image_size']) ? $image_size = $options['image_size'] : $image_size = "";
    isset($options['show_rating']) ? $show_rating = $options['show_rating'] : $show_rating = "";
    isset($options['excerpt_length']) ? $excerpt_length = intval($options['excerpt_length']) : $excerpt_length = "";    
    if(isset($options['sola_t_allow_html']) && $options['sola_t_allow_html'] == 1) { $sola_t_allow_html = 1; } else { $sola_t_allow_html = 0; }
    
    isset($options['sola_t_content_type']) ? $content_type = $options['sola_t_content_type'] : $content_type = 0;
    
    if(function_exists('sola_t_register_pro')){
        $my_query = testimonials_in_categories($atts);
    } else {
        if (isset($atts['random']) && $atts['random'] == "yes") {
            $my_query = new WP_Query('post_type=testimonials&posts_per_page=1&orderby=rand');
        }
        else if (isset($atts['id']) && $atts['id'] > 0) {
            $my_query = new WP_Query('post_type=testimonials&posts_per_page=1&p='.$atts['id']);
        } else {
            $my_query = new WP_Query('post_type=testimonials&posts_per_page=-1&status=publish');
        }
    }

    $ret = "<div class='sola_t_container'>";
    $cnt = 0;
    
    while ($my_query->have_posts()): $my_query->the_post(); 
        $cnt++;
        if(isset($show_title) && $show_title == 1){
            $the_title = "
                <div class=\"sola_t_title\"><a href=\"".get_the_permalink($post->ID)."\">".get_the_title()."</a></div>";
        } else {
            $the_title = "";
        }
        
        if(isset($show_body) && $show_body == 1){
            
            if($content_type == 0){
                $sola_t_edited_contents = get_the_excerpt();
            } else {
                $sola_t_edited_contents = get_the_content();
            }

            $the_body = "
                <div class=\"sola_t_body\">&ldquo;".$sola_t_edited_contents."&rdquo;</div>";
        } else {
            $the_body = "";
        }
        
        if(isset($show_name) && $show_name == 1){
            if($name = get_post_meta($post->ID, 'sola_t_user_name', true)) {
//                $name = $name[0]; 
                if($name != ""){
                    $the_name = "
                    <span class=\"sola_t_name\">$name</span>";
                } else {
                    $the_name = "";
                }
            } else { 
                $the_name = "";
            }
        } else {
            $the_name = "";
        }
        
        if(isset($show_website) && $show_website == 1){
            if($website_name = get_post_meta($post->ID, 'sola_t_website_name', true)) {
                $website_name = $website_name; 
            } else { 
                $website_name = '';
            }
            if($website = get_post_meta($post->ID, 'sola_t_website_address', true)) {
                $website = $website; 
            } else { 
                $website = '';
            }
            if($website_name == ""){
                $website_name = $website;
            }
            if($website != "" && $website != "http://"){
                $the_website = "
                    <span class=\"sola_t_website\">, <a href=\"".$website."\" target=\"_BLANK\" rel=\"nofollow\" >".$website_name."</a>"."</span>";
            } else {
                $the_website = "<span class=\"sola_t_website\">&nbsp;</span>";
            }
        } else {
            $the_website = "<span class=\"sola_t_website\">&nbsp;</span>";
        }

        if(isset($show_rating) && $show_rating == 1){
            if($rating = get_post_meta($post->ID, 'sola_t_rating', true)){
                $the_rating = '<div class="sola_t_display_rating" score="'.$rating.'"></div>';
            } else {
                $the_rating = "";
            }
        } else {
            $the_rating = "";
        }
            
        $layouts = get_option('sola_t_style_settings');
        
        if (isset($layouts['image_layout'])) {
            $image = $layouts['image_layout'];
        } else {
            $image = "image-1";
        }

        if (isset($atts['theme']) && $atts['theme'] != '') {
            $theme = $atts['theme'];
        } else {
            if (isset($layouts['chosen_theme'])) {
                $theme = $layouts['chosen_theme'];
            } else {
                $theme = "theme-1";
            }
        }
        
        if (isset($atts['layout']) && $atts['layout'] != '') {
            $layout = $atts['layout'];
        } else {
            if (isset($layouts['chosen_layout'])) {
                $layout = $layouts['chosen_layout'];
            } else {
                $layout = "layout-1";
            }
        }

        if(isset($image) && $image == 'image-1'){
            $class = "";
        } else if(isset($image) && $image == 'image-2'){
            $class = "sola-t-round-image";
        } else {
            $class = "";
        }

        $secure = sola_t_is_secure();
        
        if($secure){
            $http_req = "https://";
        } else {
            $http_req = "http://";
        }
        
        if(isset($show_image) && $show_image == 1){ 
            
            /* Check in this order:
             * Is there a link in the url field - we need to accommodate the users that had this functionality
             * Then check if there is a featured image
             * Then use the gravatar image
             */
                
            $sola_t_custom_image = get_post_meta($post->ID, 'sola_t_image_url', true);

            $sola_t_featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

            if(isset($sola_t_custom_image) && $sola_t_custom_image != "" && !empty($sola_t_custom_image)){

                $the_image = "<div class=\"sola_t_image $class\"  style=\"width:".$image_size."px; height:".$image_size."px;\"><img src=\"$sola_t_custom_image\" title=\"".get_the_title()."\" alt=\"".get_the_title()."\" /></div>";

            } else if ($sola_t_featured_image) {
                
                $the_image = "<div class=\"sola_t_image $class\"  style=\"width:".$image_size."px; height:".$image_size."px;\"><img src=\"$sola_t_featured_image\" title=\"".get_the_title()."\" alt=\"".get_the_title()."\" /></div>";
                
            } else {

                $sola_t_user_email = get_post_meta($post->ID, 'sola_t_user_email', true);

                if(isset($sola_t_user_email) && $sola_t_user_email != "" && !empty($sola_t_user_email)){

                    $author_email_address = $sola_t_user_email;

                    $grav_url = $http_req."www.gravatar.com/avatar/".md5(strtolower(trim($author_email_address)))."?s=$image_size&d=mm";

                    $the_image = "<div class=\"sola_t_image $class\" style=\"width:".$image_size."px; height:".$image_size."px;\"><img src=\"$grav_url\" title=\"".get_the_title()."\" alt=\"".get_the_title()."\"/></div>";

                } else {

                    $author_email_address = get_the_author_meta('user_email');

                    $grav_url = $http_req."www.gravatar.com/avatar/".md5(strtolower(trim($author_email_address)))."?s=$image_size&d=mm";

                    $the_image = "<div class=\"sola_t_image $class\" style=\"width:".$image_size."px; height:".$image_size."px;\"><img src=\"$grav_url\" title=\"".get_the_title()."\" alt=\"".get_the_title()."\"/></div>";
                }
            }

        } else {
            $the_image = "";
        }
        
        
        switch($theme) {
            case 'theme-5':
                $structure = "
                    <div class=\"sola_t_container\">
                            <div class=\"sola_t_container_body\">
                                $the_title
                                $the_rating
                                $the_body
                            </div>
                            <div class='meta-container'>
                                $the_image
                                    <div class=\"sola_t_meta_data\">
                                        $the_name
                                        $the_website
                                        
                                    </div>
                            </div>
                            
                        </div>";
                break;
            default:
                $structure = "
                    <div class=\"sola_t_container\">
                            $the_image
                            <div class=\"sola_t_container_body\">
                                $the_title
                                $the_rating
                                $the_body
                            </div>
                            <div class=\"sola_t_meta_data\">
                                $the_name
                                $the_website
                                
                            </div>
                        </div>";
                break;
                
        }
        
        switch($layout){
            case 'layout-1':
                $content = "
                    <div class=\"sola_t_layout_1_container $theme sola_t_cnt_$cnt sola_t_same_height\">                    
                        $structure
                    </div>
                ";
                break;
            case 'layout-2':
                $content = "
                    <div class=\"sola_t_layout_2_container $theme sola_t_cnt_$cnt sola_t_same_height\">                    
                        $structure
                    </div>
                ";
                break;
            case 'layout-3':
                $content = "
                    <div class=\"sola_t_layout_3_container $theme sola_t_cnt_$cnt sola_t_same_height\">                    
                        $structure
                    </div>
                ";
                break;
            case 'layout-4':
                $content = "
                    <div class=\"sola_t_layout_4_container $theme sola_t_cnt_$cnt sola_t_same_height\">                    
                        $structure
                    </div>
                ";
                break;
            case 'layout-5':
                    $content = "
                        <div class=\"sola_t_layout_5_container sola_t_cnt_$cnt sola_t_same_height\">                    
                            $structure
                        </div>
                    ";
                    break;
        }        
        $ret .= $content;
    endwhile;
    
    $ret .= "</div>";
    return $ret;
    wp_reset_query();
}



