<?php
if(function_exists('sola_t_register_pro')){
    echo submission_form_shortcode_row();
} else {
    $pro_link = "<a href=\"http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=sola_t_submission_form_shortcode\" target=\"_BLANK\">".__('Premium Version', 'sola_t')."</a>";
    echo "<tr>
            <th><label for=\"\">".__('Submit A Testimonial', 'sola_t')."</label></th>
            <td>        
                <p class=\"description\">".__("Allow your visitors to submit a testimonial on your website. Only in the $pro_link", 'sola_t')."</p>
            </td>
        </tr>";
}
?>
<tr>
    <td colspan="2">
        <hr/>
    </td>
</tr>
<tr>
    <th><label for=""><?php _e('Display A Single Testimonial', 'sola_t'); ?></label></th>
    <td>        
        <input type="text" readonly value="[sola_testimonial id=1]"/>
        <p class="description"><?php _e('Show off a single tesimonial. Use the ID of the testimonial.', 'sola_t'); ?></p>
    </td>
</tr>
<tr>
    <td colspan="2">
        <hr/>
    </td>
</tr>
<tr>
    <th><label for=""><?php _e('Display All Testimonials', 'sola_t'); ?></label></th>
    <td>        
        <input type="text" readonly value="[sola_t_all_testimonials]"/>
        <p class="description"><?php _e('Show off your raving reviews all on one page', 'sola_t'); ?></p>
    </td>
</tr>
<tr>
    <td colspan="2">
        <hr/>
    </td>
</tr>
<?php
if(function_exists('sola_t_register_pro')){
    echo slider_shortcode_row();
} else {
    $pro_link = "<a href=\"http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=sola_t_slider_shortcode\" target=\"_BLANK\">".__('Premium Version', 'sola_t')."</a>";
    echo "<tr>
            <th><label for=\"\">".__('Display Testimonials In A Slider', 'sola_t')."</label></th>
            <td>        
                <p class=\"description\">".__("Show off your raving testimonials in a slider. Only in the $pro_link", 'sola_t')."</p>
            </td>
        </tr>";
}
?>
<tr>
    <td colspan="2">
        <hr/>
    </td>
</tr>
<?php
if(function_exists('sola_t_register_pro')){
    echo categories_shortcode_row();
} else {
    $pro_link = "<a href=\"http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=sola_t_categories_shortcode\" target=\"_BLANK\">".__('Premium Version', 'sola_t')."</a>";
    echo "<tr>
            <th><label for=\"\">".__('Display Testimonials Based On Category', 'sola_t')."</label></th>
            <td>        
                <p class=\"description\">".__("Display and group your testimonials in a category. Only in the $pro_link", 'sola_t')."</p>
            </td>
        </tr>";
}
?>