<?php
if(function_exists('sola_t_register_pro')){
    echo sola_t_submission_form_options();
} else {
?>
<tr>
    <th style="text-align: center;" colspan="3">        
        <?php 
            $pro_link = "<a href=\"http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=sola_t_submission_form_settings\" target=\"_BLANK\">".__('Premium Version', 'sola_t')."</a>";
            echo "<h3>".__("Allow users to submit testimonials using a fully comprehensive submission form on your website with the $pro_link.", "sola_t")."</h3>";
        ?>
    </th>
</tr>
<tr>
    <th><label for=""><?php _e('Display Title Input?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled />
        </td>
        <td rowspan="8" style="text-align: center;">
            <?php echo "<img src='".SOLA_T_PLUGIN_DIR."/images/submit_testimonial.png' />"; ?>
        </div>
    </tr>
    <tr>
        <th><label for=""><?php _e('Title Field Required?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Title Field Label', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Title', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Title Field Description', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Provide a title for your testimonial.', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Display Name Input?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Name Field Required?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Name Field Label', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Name', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Name Field Description', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('What is your name?', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Display Website Name Input?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Website Name Field Required?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Website Name Field Label', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Website Name', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Website Name Field Description', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('What is the name of your website?', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Display Website Address Input?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Website Address Field Required?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Website Address Field Label', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Website URL', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Website Address Field Description', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('What is the URL to your website?', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Body Content Field Label', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Body', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Body Content Field Description', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Tell us your thoughts?', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Enable Ratings?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled  />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Rating Field Label', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Rating', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Rating Field Description', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Rate your experience with us', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Enable CAPTCHA?', 'sola_t'); ?></label></th>
        <td>
            <input type="checkbox" disabled  />
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('CAPTCHA Field Label', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('CAPTCHA Verification', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('CAPTCHA Address Field Description', 'sola_t'); ?></label></th>
        <td>
            <input type="text" disabled value="<?php _e('Please verify you are human.', 'sola_t'); ?>"/>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>   
    <tr>
        <th><label for=""><?php _e('Allow Users To Choose A Category', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" disabled />
        </td>    
    </tr>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Display Testimonials Based On Category', 'sola_t'); ?></label></th>
        <td>        
            <select disabled><option><?php _e('None', 'sola_t'); ?></option></select>
        </td>    
    </tr>
<?php } ?>


