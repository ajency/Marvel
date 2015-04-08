<?php $sola_t_options = get_option('sola_t_options_settings'); ?>
<h4><?php _e('The below options will only affect testimonials using the \'Single\' or \'Grid\' Layouts. To change the options of your slider, plese navigate to the \'Slider\' tab.', 'sola_t'); ?><h4>
<form name="sola_t_options_form" method="post">
    <tr>
        <th><label for=""><?php _e('Show Testimonial Title', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_title" id="sola_t_show_title" value="1" <?php if(isset($sola_t_options['show_title']) && $sola_t_options['show_title'] == 1){ echo 'checked'; } ?> />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Show Testimonial Body', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_excerpt" id="sola_t_show_excerpt" value="1" <?php if(isset($sola_t_options['show_excerpt']) && $sola_t_options['show_excerpt'] == 1){ echo 'checked'; } ?> />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Allow HTML to be rendered in the testimonial', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_allow_html" id="sola_t_allow_html" value="1" <?php if(isset($sola_t_options['sola_t_allow_html']) && $sola_t_options['sola_t_allow_html'] == 1){ echo 'checked'; } ?>/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Testimonial content type', 'sola_t'); ?></label></th>
        <td>        
            <input type="radio" name="sola_t_content_type" id="sola_t_content_type_excerpt" value="0" <?php if((isset($sola_t_options['sola_t_content_type']) && $sola_t_options['sola_t_content_type']) == 0 || $sola_t_options['sola_t_content_type'] == null){ echo 'checked'; } ?>/><?php _e('An Excerpt', 'sola_t'); ?><br/>
            <input type="radio" name="sola_t_content_type" id="sola_t_content_type_content" value="1" <?php if(isset($sola_t_options['sola_t_content_type']) && $sola_t_options['sola_t_content_type'] == 1){ echo 'checked'; } ?>/><?php _e('Full Body', 'sola_t'); ?>
        </td>
    </tr>
    <tr class="excerpt_length_row">
        <th><label for=""><?php _e('Excerpt Length', 'sola_t'); ?></label></th>
        <td>        
            <input type="text" name="sola_t_except_length" id="sola_t_except_length" value="<?php if(isset($sola_t_options['excerpt_length'])){ echo $sola_t_options['excerpt_length']; } ?>" />
            <p class="description"><?php _e('How long should your testimonial teaser be? (Specify number of words).', 'sola_t'); ?></p>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Default Image Size', 'sola_t'); ?></label></th>
        <td>        
            <input type="text" name="sola_t_image_size" id="sola_t_image_size" value="<?php if(isset($sola_t_options['image_size'])){ echo $sola_t_options['image_size']; } ?>" />
            <p class="description"><?php _e('Size of testimonial images (px).', 'sola_t'); ?></p>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Read More Link', 'sola_t'); ?></label></th>
        <td>        
            <input type="text" name="sola_t_read_more_link" id="sola_t_read_more_link" value="<?php if(isset($sola_t_options['read_more_link']) && $sola_t_options['read_more_link'] != ""){ echo $sola_t_options['read_more_link']; } ?>" />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Show User\'s Name', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_user_name" id="sola_t_show_user_name" value="1" <?php if(isset($sola_t_options['show_user_name']) && $sola_t_options['show_user_name'] == 1){ echo 'checked'; } ?>/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Show Link To User\'s Website', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_web" id="sola_t_show_web" value="1" <?php if(isset($sola_t_options['show_user_web']) && $sola_t_options['show_user_web'] == 1){ echo 'checked'; } ?>/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Show Testimonial Image', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_image" id="sola_t_show_image" value="1" <?php if(isset($sola_t_options['show_image']) && $sola_t_options['show_image'] == 1){ echo 'checked'; } ?>/>
        </td>
    </tr>    
    <?php if(function_exists('sola_t_pro_activate')){ ?>
        <tr>
            <th><label for=""><?php _e('Show Star Rating', 'sola_t'); ?></label></th>
            <td>        
                <input type="checkbox" name="sola_t_show_rating" id="sola_t_show_rating" value="1" <?php if(isset($sola_t_options['show_rating']) && $sola_t_options['show_rating'] == 1){ echo 'checked'; } ?>/>
            </td>
        </tr>
    <?php 
    
        } else { 
            $pro_link = "<a href=\"http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=ratings_options_page\" target=\"_BLANK\">".__('Premium Version', 'sola_t')."</a>";
    ?>
        <tr>
            <th><label for=""><?php _e('Show Rating', 'sola_t'); ?></label></th>
            <td>        
                <input type="checkbox" disabled="disabled" readonly="readonly"/>
                <p class="description"><?php _e("Ratings are only available in the $pro_link", "sola_t"); ?></p>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <th><input type="submit" name="sola_t_save_options"  class="button-primary" value="<?php _e('Update Settings', 'sola_t'); ?>" /></th>
        <td></td>
    </tr>
</form>

