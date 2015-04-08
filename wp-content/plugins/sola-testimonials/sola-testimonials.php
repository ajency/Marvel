<?php
/**
 * Plugin Name: Sola Testimonials
 * Plugin URI: http://solaplugins.com
 * Description: A super easy to use and comprehensive Testimonial plugin.
 * Version: 1.7
 * Author: Sola Plugins
 * Author URI: http://solaplugins.com
 * License: GPL2
 */

/* 1.7 2015-03-24 - Low Priority
 * New Feature: You can now choose to display the excerpt or the full body of a testimonial
 * New Feature: You can now change the pagination speed of the slider (Pro)
 * 
 * 1.6 2015-02-20 - Low Priority
 * Bug Fix: Read More Link now shows at the end of a testimonial excerpt
 * New Feature: You can now add star ratings to your testimonials (Pro)
 * New Feature: You can now choose if you want guests to submit a testimonial (Pro)
 * 
 * 1.5 2015-02-03 Low Priority
 * New Feature: You can choose to render HTML in a testimonial
 * New Feature: Specify in the shortcode the theme and layout you would like to use for your testimonials
 * Bug Fix: Layout issues fixed when showing more than 4 testimonials
 * Bug Fix: Testimonial image style wouldnt change in slider
 * Bug Fix: Add Media has been removed and a Featured Image metabox for testimonial images
 * Enhancement (Pro): Less testimonial items will display per slide on mobile devices
 * 
 * 1.4 
 * New feature: Media button added to testimonial author image
 * 
 * 1.3
 * Code improvements
 * Testimonial structure improvements
 * Bug fix: Sola Testimonials welcome page kept showing up for some users
 * New shortcode addition to show a random testimonial
 * Pro: Two new testimonial themes added
 * 
 * 1.2 2014-11-24
 * Fixed bug that caused Fatal error
 * 
 * 1.1 - 2014-11-21
 * Fixed the bug that caused an unnecessary break in the body of the testimonial
 * Neatened up the testimonial options page
 * 
 */

define('SOLA_T_PLUGIN_NAME', 'Sola Testimonials');
define('SOLA_T_SITE_URL', site_url());
define('SOLA_T_PLUGIN_DIR', plugins_url().'/sola-testimonials');

add_action('init', 'sola_t_init');
add_action('init', 'sola_t_post_type');

add_action('add_meta_boxes', 'sola_t_meta_box');
add_action('add_meta_boxes', 'sola_t_side_meta_box');
add_action('do_meta_boxes', 'sola_t_featured_user_image');
add_action('admin_menu', 'sola_t_menu');

add_action('save_post', 'sola_t_save_testimonial_meta');
add_action('manage_posts_custom_column', 'sola_t_populate_columns');
//add_action('widgets_init', 'sola_t_widget_register');
add_action('admin_enqueue_scripts', 'sola_t_admin_styles');
add_action('admin_enqueue_scripts', 'sola_t_admin_scripts');
add_action('wp_enqueue_scripts', 'sola_t_front_end_styles',99);
add_action('wp_enqueue_scripts', 'sola_t_front_end_scripts', 99);
add_action('admin_head','sola_t_admin_head');
add_action('wp_head','sola_t_user_head');

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'sola_t_custom_excerpt');

require_once 'includes/shortcodes.php';

add_filter('pre_get_posts', 'sola_t_loop_control');
add_filter('manage_testimonials_posts_columns' , 'sola_t_columns');
add_filter('excerpt_more', 'sola_t_read_more',999);
//add_filter('excerpt_length', 'sola_t_excerpt_length');

register_activation_hook( __FILE__, 'sola_t_activate');
register_deactivation_hook(__FILE__, 'sola_t_deactivate');
register_uninstall_hook(__FILE__, 'sola_t_uninstall');

global $sola_t_version;
global $sola_t_version_string;

$sola_t_version = "1.7";
$sola_t_version_string = "Basic";

function sola_t_init(){
    
   /*
    * Load Text Domain
    */
    $plugin_dir = basename(dirname(__FILE__))."/languages/";
    load_plugin_textdomain( 'sola_t', false, $plugin_dir );
    
    if (isset($_POST['action']) && $_POST['action'] == 'sola_t_submit_find_us') {
        sola_t_feedback_head();
        wp_redirect("./edit.php?post_type=testimonials&page=sola_t_settings", 302);
        exit();
    }
    if (isset($_POST['action']) && $_POST['action'] == 'sola_t_skip_find_us') {
        wp_redirect("./edit.php?post_type=testimonials&page=sola_t_settings", 302);
        exit();
    }

    if (isset($_GET['post_type']) && $_GET['post_type'] == "testimonials") {
        
        global $sola_t_version;
        /* check if their using APC object cache, if yes, do nothing with the welcome page as it causes issues when caching the DB options */
        if (class_exists("APC_Object_Cache")) {
            /* do nothing here as this caches the "first time" option and the welcome page just loads over and over again. quite annoying really... */
        }  else { 
            if (isset($_GET['override']) && $_GET['override'] == "1") {
                $sola_t_first_time = $sola_t_version;
                update_option("sola_t_first_time",$sola_t_first_time);
            } else {
                $sola_t_first_time = get_option("sola_t_first_time");
                if (!$sola_t_first_time) { 
                    /* show welcome screen */
                    $sola_t_first_time = $sola_t_version;
                    update_option("sola_t_first_time",$sola_t_first_time);
                    wp_redirect('edit.php?post_type=testimonials&page=sola_t_settings&action=welcome_page');
                    exit();
                }
                
                if ($sola_t_first_time != $sola_t_version) {
                    // user has updated - will build update page
                    update_option("sola_t_first_time",$sola_t_version);
                    
                }
                
            }
        }
        
       
    }
    
} 

function sola_t_feedback_head() {
    if (function_exists('curl_version')) {

        $request_url = "http://www.solaplugins.com/apif-testimonials/rec.php";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
    }
    return;
}

function sola_t_activate(){
    
    add_role('testimonial_author', __('Testimonial Author', 'sola_t'), array('read' => true));
    
    $sola_t_options_settings = array(
        'show_title' => 1,
        'show_excerpt' => 1,
        'excerpt_length' => 20,
        'image_size' => 120,
        'read_more_link' => __('Read More', 'sola_t'),
        'show_user_name' => 1,
        'show_user_web' => 1,
        'show_image' => 1,
        'sola_t_allow_html' => 0
    );
    
    add_option('sola_t_options_settings', $sola_t_options_settings);
    
    $sola_t_style_settings = array(
        'custom_css' => '',
        'image_layout' => 'image-1',
        'chosen_layout' => 'layout-1',
        'chosen_theme' => 'theme-1'
    );
    
    add_option('sola_t_style_settings', $sola_t_style_settings);              
    
    /* Display All Testimonials */
    $sola_t_submit_testimonial = get_page_by_title( __('Our Testimonials', 'sola_t'), OBJECT, 'page' );
    
    if(!$sola_t_submit_testimonial){
    
        $sola_t_page_contents = '[sola_t_all_testimonials]';
        
        $sola_t_page = array(
            'post_title'    => __('Our Testimonials', 'sola_t'),
            'post_content'  => $sola_t_page_contents,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'ping_status'   => 'closed',
            'post_type'     => 'page',
            'comment_status'=> 'closed'
        );
        
        wp_insert_post($sola_t_page);
    }
    
    /*
     * Initiates Custom Post Type and Rewrite Flush
     */
    
    sola_t_post_type();

    flush_rewrite_rules();
}

function sola_t_deactivate(){
    
}

function sola_t_uninstall(){
//    remove_role('testimonial_author');
}

function sola_t_menu(){
    add_submenu_page('edit.php?post_type=testimonials', __('Settings','sola_t'), __('Settings','sola_t'), 'manage_options' , 'sola_t_settings', 'sola_t_settings_page');
    add_submenu_page('edit.php?post_type=testimonials', __('Feedback','sola_t'), __('Feedback','sola_t'), 'manage_options' , 'sola_t_feedback', 'sola_t_feedback_page');
}

function sola_t_admin_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');  
    wp_enqueue_script('jquery-ui-dialog');  
    
//    wp_enqueue_script('thickbox');
//    wp_enqueue_script('media-upload');    
    
    wp_register_script('sola-t-general-js', SOLA_T_PLUGIN_DIR.'/js/sola_t.js', 'jquery');
    wp_enqueue_script('sola-t-general-js');
    
    if(!wp_script_is('registered', 'ace')){
        /* Enqueue the script then */
        wp_register_script('ace', SOLA_T_PLUGIN_DIR.'/js/ace/ace.js', 'jquery');
        wp_enqueue_script('ace');
    } else {
        if(!wp_script_is('queue', 'ace')){
            wp_enqueue_script('ace');
        } else {
            /* It is registered and enqueued. Dont do anything. */
        }
        /* Register and enqueue it */
    }
    
    if(!wp_script_is('registered', 'ace-theme-twilight')){
        /* Enqueue the script then */
        wp_register_script('ace-theme-twilight', SOLA_T_PLUGIN_DIR.'/js/ace/theme-twilight.js');
        wp_enqueue_script('ace-theme-twilight');
    } else {
        if(!wp_script_is('queue', 'ace-theme-twilight')){
            wp_enqueue_script('ace-theme-twilight');
        } else {
            /* It is registered and enqueued. Dont do anything. */
        }
        /* Register and enqueue it */
    }
    
    if(!wp_script_is('registered', 'ace-mode-css')){
        /* Enqueue the script then */
        wp_register_script('ace-mode-css', SOLA_T_PLUGIN_DIR.'/js/ace/mode-css.js');
        wp_enqueue_script('ace-mode-css');
    } else {
        if(!wp_script_is('queue', 'ace-mode-css')){
            wp_enqueue_script('ace-mode-css');
        } else {
            /* It is registered and enqueued. Dont do anything. */
        }
        /* Register and enqueue it */
    }
    
    if(!wp_script_is('registered', 'jquery-ace')){
        /* Enqueue the script then */
        wp_register_script('jquery-ace', SOLA_T_PLUGIN_DIR.'/js/jquery-ace.js');
        wp_enqueue_script('jquery-ace');
    } else {
        if(!wp_script_is('queue', 'jquery-ace')){
            wp_enqueue_script('jquery-ace');
        } else {
            /* It is registered and enqueued. Dont do anything. */
        }
        /* Register and enqueue it */
    }                    
}

function sola_t_admin_styles(){
    wp_enqueue_style('thickbox');
    
    wp_register_style('sola-t-jquery-ui-css', SOLA_T_PLUGIN_DIR.'/css/jquery-ui.css');
    wp_enqueue_style('sola-t-jquery-ui-css');

    wp_register_style('sola-t-jquery-css', SOLA_T_PLUGIN_DIR.'/css/jquery-ui.theme.min.css');
    wp_enqueue_style('sola-t-jquery-css');
    
    wp_register_style('sola-t-custom-admin-css', SOLA_T_PLUGIN_DIR.'/css/custom-admin.css');
    wp_enqueue_style('sola-t-custom-admin-css');
}

function sola_t_front_end_styles(){
    wp_register_style('sola-t-layout-css', SOLA_T_PLUGIN_DIR.'/css/layouts.css');
    wp_enqueue_style('sola-t-layout-css');

    wp_register_style('sola-t-theme-css', SOLA_T_PLUGIN_DIR.'/css/themes.css');
    wp_enqueue_style('sola-t-theme-css');
    

}

function sola_t_front_end_scripts(){
    wp_enqueue_script('jquery');
    
    wp_register_script('sola-t-form-validation', SOLA_T_PLUGIN_DIR.'/js/jquery.form-validator.min.js', array('jquery'));
    wp_enqueue_script('sola-t-form-validation');
    
    wp_register_script('sola-t-front-end-js', SOLA_T_PLUGIN_DIR.'/js/sola_t_frontend.js', array('jquery'));
    wp_enqueue_script('sola-t-front-end-js');
    
    wp_register_script('imgLiquid', SOLA_T_PLUGIN_DIR.'/js/imgLiquid-min.js', array('jquery'));
    wp_enqueue_script('imgLiquid');
    
    if(!wp_script_is('registered', 'jquery-matchHeight')){
        /* Enqueue the script then */
        wp_register_script('jquery-matchHeight', SOLA_T_PLUGIN_DIR.'/js/jquery.matchHeight-min.js');
        wp_enqueue_script('jquery-matchHeight');
    } else {
        if(!wp_script_is('queue', 'jquery-matchHeight')){
            wp_enqueue_script('jquery-matchHeight');
        } else {
            /* It is registered and enqueued. Dont do anything. */
        }
        /* Register and enqueue it */
    }    
    
}

function sola_t_settings_page(){
    if (isset($_GET['page']) && $_GET['page'] == "sola_t_settings" && isset($_GET['action']) && $_GET['action'] == "welcome_page") {
        include('includes/welcome-page.php');
    } else {
        include 'includes/settings.php';
    }
}

function sola_t_feedback_page(){
    include 'includes/feedback.php';
}

function sola_t_post_type() {
    $labels = array(
        'name'               => __('Testimonials', 'sola_t' ),
        'singular_name'      => __('Testimonial', 'sola_t' ),
        'menu_name'          => __('Testimonials', 'sola_t' ),
        'name_admin_bar'     => __('Testimonials', 'sola_t' ),
        'add_new'            => __('Add New', 'sola_t' ),
        'add_new_item'       => __('Add New Testimonial', 'sola_t' ),
        'new_item'           => __('New Testimonial', 'sola_t' ),
        'edit_item'          => __('Edit Testimonial', 'sola_t' ),
        'view_item'          => __('View Testimonial', 'sola_t' ),
        'all_items'          => __('All Testimonials', 'sola_t' ),
        'search_items'       => __('Search Testimonials', 'sola_t' ),
        'parent_item_colon'  => __('Parent Testimonials:', 'sola_t' ),
        'not_found'          => __('No testimonials Found.', 'sola_t' ),
        'not_found_in_trash' => __('No testimonials Found In Trash.', 'sola_t' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail')
    );

    register_post_type( 'testimonials', $args ); 
}

//function sola_t_excerpt_length($length) {
//    $options = get_option('sola_t_options_settings');
//    $length = intval($options['excerpt_length']);
//    return $length;
//}
function sola_t_read_more($more) {
    $options = get_option('sola_t_options_settings');
    $link = $options['read_more_link'];
    
    
    if (get_post_type() == "testimonials") {
        if(isset($link) && $link != ""){
            $more = "... <a class=\"read-more\" href=\"".get_permalink(get_the_ID())."\">$link</a>";
        } else {
            $more =  "... <a class=\"read-more\" href=\"".get_permalink(get_the_ID())."\">".__("Read More", "sola_t")."</a>";
        }
    }
    return $more;
}

function sola_t_meta_box() {
    add_meta_box( 
        'sola_t_testimonial_meta_data',
        __('Testimonial Data', 'sola_t'),
        'sola_t_meta_box_contents',
        'testimonials',
        'normal',
        'high'            
    );
}

function sola_t_meta_box_contents(){
    
    global $post;
    global $post_id;

    ?>

<table class="form-table">
    <tr>
        <th><label for="sola_t_user_name"><?php _e('User Name', 'sola_t'); ?></label></th>
        <td>        
            <input class="sola_input" type="text" name="sola_t_user_name" value="<?php if($sola_t_user_name = get_post_meta($post_id, 'sola_t_user_name')){ echo $sola_t_user_name[0]; } ?>" placeholder="<?php _e('User Name', 'sola_t'); ?>"/>    
        </td>
    </tr>
    <tr>
        <th><label for="sola_t_image_url"><?php _e('User Email Address', 'sola_t'); ?></label></th>
        <td>
            <input class="sola_input" type="text" name="sola_t_user_email" value="<?php if($sola_t_user_email = get_post_meta($post_id, 'sola_t_user_email')){ echo $sola_t_user_email[0]; } ?>" placeholder="<?php _e('User Email Address', 'sola_t'); ?>"/>            
            <div class="description">
                <p><?php _e('The users email address will be used to show their gravatar image. To use a custom image, leave this field blank and enter an Image URL below. ', 'sola_t'); ?>
            </div>
        </td>        
    </tr>
    <tr>
        <th><label for="sola_t_image_url"><?php _e('Image URL', 'sola_t'); ?></label></th>
        <td>
            <input class="sola_input" type="text" name="sola_t_image_url" id="sola_t_user_upload_image" value="<?php if($sola_t_image_url = get_post_meta($post_id, 'sola_t_image_url')){ echo $sola_t_image_url[0]; } ?>" placeholder="<?php _e('Image URL', 'sola_t'); ?>"/>
            <div class="description">
                <p><?php _e('Leave this field blank to use the gravatar image of the author. The User Image (Right) will override this option.', 'sola_t'); ?>
            </div>
        </td>
    </tr>
    <tr>
        <th><label for="sola_t_website_name"><?php _e('Website Name', 'sola_t'); ?></label>
        <td>
            <input class="sola_input" type="text" name="sola_t_website_name" value="<?php if($sola_t_website_name = get_post_meta($post_id, 'sola_t_website_name')){ echo $sola_t_website_name[0]; } ?>" placeholder="<?php _e('User Website Name', 'sola_t'); ?>"/>
        </td>        
    </tr>
    <tr>
        <th><label for="sola_t_website_address"><?php _e('Website Address', 'sola_t'); ?></label></th>
        <td>
            <input class="sola_input" type="text" name="sola_t_website_address" value="<?php if($sola_t_website_address = get_post_meta($post_id, 'sola_t_website_address')){ echo $sola_t_website_address[0]; } else { echo 'http://'; } ?>" placeholder="<?php _e('User Web Address', 'sola_t'); ?>"/>
        </td>
    </tr>
    <?php if(function_exists('sola_t_pro_activate')){ ?>
        <?php
        global $sola_t_pro_version;
        if($sola_t_pro_version <= "1.2"){
        ?>
         <tr>
            <th><label for="sola_t_rating"><?php _e('Rating', 'sola_t'); ?></label></th>
            <td>
                <p><?php _e('Please update to the latest version of Sola Testimonials Pro to take advantage of star ratings', 'sola_t'); ?>
            </td>
        </tr>
        <?php
        } else {
        ?>
        <tr>
            <th><label for="sola_t_rating"><?php _e('Rating', 'sola_t'); ?></label></th>
            <td>
                
                <?php 
                $sola_t_rating_value = get_post_meta($post_id, 'sola_t_rating', true);
                if($sola_t_rating_value){
                    $sola_t_rating_value = intval($sola_t_rating_value);
                } else {
                    $sola_t_rating_value = 0;
                }
                ?>
                <script>
                    jQuery(document).ready(function(){
                        jQuery('#sola_t_rating_container').raty({
                            score: <?php echo $sola_t_rating_value; ?>,
                            click: function(score, evt) {
                                jQuery("#sola_t_rating").val(score);
                            }
                        });
                    });
                </script>                
                <div id="sola_t_rating_container"></div>                
                <input class="sola_input" type="hidden" name="sola_t_rating" id="sola_t_rating" value="<?php echo $sola_t_rating_value; ?>" />
            </td>
        </tr>
    <?php } } else { ?>
        <tr>
            <th><label for="sola_t_rating"><?php _e('Rating', 'sola_t'); ?></label></th>
            <td>
                <?php $pro_link = "<a href=\"http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=sola_t_add_rating\" target=\"_BLANK\">".__('Premium Version', 'sola_t')."</a>"; ?>
                <p><?php _e("Star Ratings are only available in the $pro_link", 'sola_t'); ?>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <th><label><?php _e('Shortcode', 'sola_t'); ?></label></th>
        <td>
            <input class="sola_input" type="text" readonly name="sola_t_single_shortcode" value="<?php echo '[sola_testimonial id='.$post->ID.']'; ?>" />
        </td>
    </tr>
    
</table>
          
    <?php
}

function sola_t_save_testimonial_meta($post_id) {

    if ( SOLA_T_PLUGIN_NAME != isset($_POST['post_type'])){
        return;
    }
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
        return; 
    }
    if( !current_user_can( 'edit_post', $post_id ) ){
        return;  
    }
    
    if(isset($_REQUEST['sola_t_user_name'])){
        update_post_meta( $post_id, 'sola_t_user_name', sanitize_text_field( $_REQUEST['sola_t_user_name'] ) );
    }

    if(isset($_REQUEST['sola_t_website_name'])){
        update_post_meta( $post_id, 'sola_t_website_name', sanitize_text_field( $_REQUEST['sola_t_website_name'] ) );
    }

    if(isset($_REQUEST['sola_t_website_address'])){
        update_post_meta( $post_id, 'sola_t_website_address', sanitize_text_field( $_REQUEST['sola_t_website_address'] ) );
    }
    
    if(isset($_REQUEST['sola_t_image_url'])){
        update_post_meta( $post_id, 'sola_t_image_url', sanitize_text_field( $_REQUEST['sola_t_image_url'] ) );
    }
    
    if(isset($_REQUEST['sola_t_user_email'])){
        update_post_meta( $post_id, 'sola_t_user_email', sanitize_text_field( $_REQUEST['sola_t_user_email'] ) );
    }
    
    if(isset($_REQUEST['sola_t_rating'])){
        update_post_meta( $post_id, 'sola_t_rating', sanitize_text_field( $_REQUEST['sola_t_rating'] ) );
    }
    
    update_post_meta ($post_id, '_sola_t_status', 1);
}

function sola_t_side_meta_box() {
    add_meta_box( 
        'sola_t_testimonial_meta_side_data',
        __('Testimonial Status', 'sola_t'),
        'sola_t_side_meta_box_contents',
        'testimonials',
        'side',
        'high'            
    );
}

function sola_t_side_meta_box_contents(){
    global $post_id;
    $post_meta = get_post_meta($post_id, '_sola_t_status');
    if(isset($post_meta[0]) && $post_meta[0] == 0){ $selected0 = "selected"; } else { $selected0 = ""; }
    if(isset($post_meta[0]) && $post_meta[0] == 1){ $selected1 = "selected"; } else { $selected1 = ""; }
    
    $content = "
        <table class=\"form-table\">
            <tr>
                <th>
                ".__('Status', 'sola_t')."
                </th>
                <td>
                    <select name=\"sola_t_submit_status\" >
                        <option value=\"0\" $selected0>".__('Pending Approval', 'sola_t')."</option>
                        <option value=\"1\" $selected1>".__('Approved', 'sola_t')."</option>
                    </select>
                </td>
            </tr>
        </table>
        ";
    
    echo $content;
}

function sola_t_columns($columns) {
    
    $new_columns = array(
        'sola_t_user_name' => __('User Name', 'sola_t'),
        'sola_t_website_name' => __('Website Name', 'sola_t'),
        'sola_t_website_address' => __('Website Address', 'sola_t'),
        'sola_t_status' => __('Status', 'sola_t'),
        'sola_t_rating' => __('Rating', 'sola_t'),
        'sola_t_single_shortcode' => __('Shortcode', 'sola_t')
    );
    return array_merge($columns, $new_columns);
}

function sola_t_populate_columns($column) {
    global $post;
    
    if ( 'sola_t_user_name' == $column ) {
        $sola_t_user_title = get_post_meta( get_the_ID(), 'sola_t_user_name', true );
        echo $sola_t_user_title;
        
    } else if ( 'sola_t_website_name' == $column ) {
        $sola_t_website_name = get_post_meta( get_the_ID(), 'sola_t_website_name', true );
        echo $sola_t_website_name;
        
    } else if ( 'sola_t_website_address' == $column ) {
        $sola_t_website_address = esc_html( get_post_meta( get_the_ID(), 'sola_t_website_address', true ) );
        echo '<a href="http://'.$sola_t_website_address.'" target="_BLANK">'.$sola_t_website_address.'</a>';
    } else if ('sola_t_status' == $column){
        $sola_t_status = get_post_meta( get_the_ID(), '_sola_t_status', true );   
        if($sola_t_status == 1){
            $status = __('Approved', 'sola_t');
        } else {
            $status = __('Pending Approval', 'sola_t');
        }
        echo $status;
    } else if ('sola_t_rating' == $column){
        $sola_t_status = get_post_meta( get_the_ID(), 'sola_t_rating', true );
        echo $sola_t_status;
    }else if ( 'sola_t_single_shortcode' == $column ) {
        echo '[sola_testimonial id='.$post->ID.']';
    }
    
}

function sola_t_admin_head(){
    if (isset($_POST['sola_t_send_feedback'])) {
        if(wp_mail("support@solaplugins.com", "Plugin feedback", 
                "Name: ".$_POST['sola_t_feedback_name']."\n\r".
                "Email: ".$_POST['sola_t_feedback_email']."\n\r".
                "Website: ".$_POST['sola_t_feedback_website']."\n\r".
                "Feedback:".$_POST['sola_t_feedback_feedback']."\n\r
                Sent from Sola Testimonials")){
            echo "<div id=\"message\" class=\"updated\"><p>".__("Thank you for your feedback. We will be in touch soon","sola_t")."</p></div>";
        } else {
            if (function_exists('curl_version')) {
                $request_url = "http://www.solaplugins.com/apif-testimonials/rec_feedback.php";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $request_url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
                curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                echo "<div id=\"message\" class=\"updated\"><p>".__("Thank you for your feedback. We will be in touch soon","sola_t")."</p></div>";
            } 
            else {
                echo "<div id=\"message\" class=\"error\">";
                echo "<p>".__("There was a problem sending your feedback. Please log your feedback on ","sola_t")."<a href='http://solaplugins.com/support-desk' target='_BLANK'>http://solaplugins.com/support-desk</a></p>";
                echo "</div>";
            }
        }
    }
} 

function sola_t_user_head(){
    
    $style_options = get_option('sola_t_style_settings');
    if(isset($style_options['custom_css']) && $style_options['custom_css'] != ""){
        $custom_css = "
            <!-- Sola Testimonials Custom CSS -->
            <style type=\"text/css\">".
                $style_options['custom_css']
            ."</style>
            ";
        echo $custom_css;
    }        
                
}

/* Save Options */
    
if (isset($_POST['sola_t_save_options'])){
    
    if(function_exists('sola_t_pro_activate')){
        if(function_exists('sola_t_pro_save_options')){
            sola_t_pro_save_options();
        }
    } else {
    
        extract($_POST);

        $sola_t_saved_forms = Array();

        if(isset($sola_t_show_title)){ $sola_t_saved_forms['show_title'] = $sola_t_show_title; } else { $sola_t_saved_forms['show_title'] = ''; }
        if(isset($sola_t_show_excerpt)){ $sola_t_saved_forms['show_excerpt'] = $sola_t_show_excerpt; } else { $sola_t_saved_forms['show_excerpt'] = ''; }
        if(isset($sola_t_image_size)){ $sola_t_saved_forms['image_size'] = $sola_t_image_size; } else { $sola_t_saved_forms['image_size'] = '120'; }
        if(isset($sola_t_except_length) && $sola_t_except_length != ""){ $sola_t_saved_forms['excerpt_length'] = $sola_t_except_length; } else { $sola_t_saved_forms['excerpt_length'] = 20; }
        if(isset($sola_t_read_more_link) && $sola_t_read_more_link != ""){ $sola_t_saved_forms['read_more_link'] = $sola_t_read_more_link; } else { $sola_t_saved_forms['read_more_link'] = __('Read More', 'sola_t'); }
        if(isset($sola_t_show_user_name)){ $sola_t_saved_forms['show_user_name'] = $sola_t_show_user_name; } else { $sola_t_saved_forms['show_user_name'] = ''; }
        if(isset($sola_t_show_web)){ $sola_t_saved_forms['show_user_web'] = $sola_t_show_web; } else { $sola_t_saved_forms['show_user_web'] = ''; }
        if(isset($sola_t_show_image)){ $sola_t_saved_forms['show_image'] = $sola_t_show_image; } else { $sola_t_saved_forms['show_image'] = ''; }
        if(isset($sola_t_allow_html)){ $sola_t_saved_forms['sola_t_allow_html'] = $sola_t_allow_html; } else { $sola_t_saved_forms['sola_t_allow_html'] = ''; }        
        if(isset($sola_t_content_type)){ $sola_t_saved_forms['sola_t_content_type'] = $sola_t_content_type; } else { $sola_t_saved_forms['sola_t_content_type'] = 0; }
        
        $update_form = update_option('sola_t_options_settings', $sola_t_saved_forms);

        if($update_form){
            echo "
                <div class=\"updated\">
                    <p>".__('Update Successful', 'sola_t')."</p>
                </div>
            ";
        } else {
            echo "
                <div class=\"error\">
                    <p>".__('No changes were made', 'sola_t')."</p>
                </div>
            ";
        }
    }
} else if(isset($_POST['sola_t_save_style_settings'])){
        
    extract($_POST);

    $sola_t_style_settings = array();

    if(isset($sola_t_custom_css) && $sola_t_custom_css != ""){ $sola_t_style_settings['custom_css'] =  $sola_t_custom_css; } else { $sola_t_style_settings['custom_css'] = ""; }
    if(isset($sola_t_layout) && $sola_t_layout != ""){ $sola_t_style_settings['chosen_layout'] =  $sola_t_layout; } else { $sola_t_style_settings['chosen_layout'] = ""; }
    if(isset($sola_t_image_layout) && $sola_t_image_layout != ""){ $sola_t_style_settings['image_layout'] =  $sola_t_image_layout; } else { $sola_t_style_settings['image_layout'] = ""; }
    if(isset($sola_t_image_layout) && $sola_t_image_layout != ""){ $sola_t_style_settings['image_layout'] =  $sola_t_image_layout; } else { $sola_t_style_settings['image_layout'] = ""; }
    if(isset($sola_t_theme) && $sola_t_theme != ""){ $sola_t_style_settings['chosen_theme'] =  $sola_t_theme; } else { $sola_t_style_settings['chosen_theme'] = ""; }
    
    $update_form = update_option('sola_t_style_settings', $sola_t_style_settings);
    
    if($update_form){
        echo "
            <div class=\"updated\">
                <p>".__('Update Successful', 'sola_t')."</p>
            </div>
        ";
    } else {
        echo "
            <div class=\"error\">
                <p>".__('No changes were made', 'sola_t')."</p>
            </div>
        ";
    }
}

function sola_t_loop_control( $query ) {
    if (!is_single() && !is_admin()) { 
        if (isset($query->query['post_type']) && $query->query['post_type'] == "testimonials") {
            $query->set( 'meta_query', array(
                    array(
                          'key' => '_sola_t_status',
                          'value' => 1
                    )
            ));
        }    
    }
}

function sola_t_featured_user_image() {
    remove_meta_box('postimagediv', 'testimonials', 'side');
    add_meta_box('postimagediv', __('User Image', 'sola_t'), 'post_thumbnail_meta_box', 'testimonials', 'side');
}

function sola_t_custom_excerpt($text) {
    $options = get_option('sola_t_options_settings');
        
    if(isset($options['excerpt_length'])) { $length = intval($options['excerpt_length']); } else { $length = 120; }
    
    if(isset($options['sola_t_allow_html']) && $options['sola_t_allow_html'] == 1) { $sola_t_allow_html = 1; } else { $sola_t_allow_html = 0; }
    
    $raw_excerpt = $text;
    
    if ( '' == $text ) {
        $text = get_the_content('');
 
        $text = strip_shortcodes( $text );

        $text = apply_filters('the_content', $text);
        
        $text = str_replace(']]>', ']]>', $text);
        
        if(!$sola_t_allow_html){
            $text = strip_tags($text);
        }
        
        $excerpt_length = apply_filters('excerpt_length', $length);
 
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
        
        $words = preg_split('/(<a.*?a>)|\n|\r|\t|\s/', $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE );
        
        if ( count($words) > $excerpt_length ) {
                array_pop($words);
                $text = implode(' ', $words);
                $text = $text . $excerpt_more;
        } else {
                $text = implode(' ', $words);
        }
    }
    return apply_filters('new_wp_trim_excerpt', $text, $raw_excerpt);
}

function sola_t_is_secure() {
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
}