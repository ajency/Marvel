<div class="my_meta_control">
    <?php 
        //NO SIDEBAR ON PAGE WITH SECTIONS
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
        $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
        if ($template_file!="page-sections.php")
        {
            ?>
            <p class="my_meta_p">
                <span class="prk_alt_opt">Sidebar display:</span><br />
                <?php 
                        $mb->the_field('alchemy_show_sidebar'); 
                ?>
                <select name="<?php $metabox->the_name(); ?>">
                <option value="default">Default Option</option>
                <option value="yes" <?php if ($metabox->get_the_value() == 'yes') echo "selected='SELECTED'"; ?>>Show Sidebar</option>
                <option value="no" <?php if ($metabox->get_the_value() == 'no') echo "selected='SELECTED'"; ?>>Hide Sidebar</option>
                </select>
            </p>
            <?php
        }
    ?>
    <h2>Header options</h2>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Hide page title?</span>
        <?php 
            $mb->the_field('alchemy_show_title');
            if(!($mb->get_the_value()))
            {
                $mb->the_checkbox_state = 'checked';
            }
        ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br/><br/>
    </p>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Hide line under page title?</span>
        <?php 
            $mb->the_field('alchemy_hide_line');
            if(!($mb->get_the_value()))
            {
                $mb->the_checkbox_state = 'checked';
            }
        ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br/><br/>
    </p>
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Header text (will be displayed below the page title):</span>
		<?php 
			$mb->the_field('alchemy_below_headings');
		?>
        <textarea cols="40" rows="3" name="<?php $mb->the_name(); ?>"><?php $mb->the_value(); ?></textarea>
   	</p>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Header text color:</span> (Optional)
        <?php $mb->the_field('alchemy_text_color'); ?><br />
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="5" class="mdm_input" />
        <em class="em_darker_grey right_floated">&nbsp;Example:#000000</em>
        <br/><br/>
    </p>
    <p class="my_meta_p">
        <?php 
            $mb->the_field('alchemy_header_align'); 
        ?>
        <span class="prk_alt_opt">Header text alignment:</span>
        <select name="<?php $metabox->the_name(); ?>">
            <option value="head_left" <?php if ($metabox->get_the_value() == 'head_left') echo "selected='SELECTED'"; ?>>Left</option>
            <option value="head_center" <?php if ($metabox->get_the_value() == 'head_center') echo "selected='SELECTED'"; ?>>Center</option>
        </select>
    </p>
    <h2 class="extra_mg">Featured slideshow options</h2>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Show slideshow on top of this page?</span>
        <?php 
            $mb->the_field('alchemy_featured_slide');
            ?>
            <select id="prk_slider_selector" name="<?php $metabox->the_name(); ?>">
                <option value="no">No</option>
                <option value="yes" <?php if ($metabox->get_the_value() == 'yes') echo "selected='SELECTED'"; ?>>Yes - Flexslider</option>
                <?php 
                if (PRK_RVSLIDER=="true")
                {
                    ?>
                    <option value="show_revol" <?php if ($metabox->get_the_value() == 'show_revol') echo "selected='SELECTED'"; ?>>Yes - Revolution Slider</option>
                    <?php
                }
                ?>
            </select>
    </p>

    <div id="rev_slider_opts">
        <p class="my_meta_p">
        <span class="prk_alt_opt">Revolution slider alias:</span><br />
        <?php
            $mb->the_field('alchemy_revslider'); 
        ?>
        <select name="<?php $metabox->the_name(); ?>">
        <?php
        global $wpdb;
        $rs = $wpdb->get_results( "SELECT id, title, alias FROM ".$wpdb->prefix."revslider_sliders ORDER BY id ASC LIMIT 100");
        $revsliders = array();
        if ($rs) 
        {
            foreach ( $rs as $slider ) 
            {
                ?>
                <option value="<?php echo $slider->alias; ?>" <?php if ($metabox->get_the_value() == $slider->alias) echo "selected='SELECTED'"; ?>><?php echo $slider->alias; ?></option>
                <?php
            }
        } 
        else 
        {
            $revsliders["No sliders found"] = 0;
        }
    ?>
    </select>
    </p>
    <div class="clearfix big_lower"></div>
    </div>

    <div id="normal_slider_opts">
        <p class="my_meta_p">
            <span class="prk_alt_opt">Autoplay Slideshow?</span>
            <?php 
                $mb->the_field('alchemy_full_slide');
                if(!($mb->get_the_value()))
                {
                    $mb->the_checkbox_state = 'checked';
                }
            ?>
            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
        </p>
        <p class="my_meta_p">
            <span class="prk_alt_opt">&nbsp;Slideshow delay in miliseconds:</span> (Optional)
            <?php $mb->the_field('alchemy_full_delay'); ?><br />
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="5" class="mdm_input" />
        </p>
        <?php 
            //FLAG TO KNOW WHEN WE ARE GOING THROUGH THE GROUPS
            $mb->the_field('helper_fk');
        ?>
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="weirdostf"/>  
        <?php
            $terms=get_terms('pirenko_slide_set');
            $count = count($terms);
            if ($count>0)
            {   
                echo "<div class='btm_12'><span class='prk_alt_opt'>Slide groups to be displayed on this page:</span> (Leave blank for all)<br /><table>";
                foreach ( $terms as $term ) { 
                    $mb->the_field($term->slug);
                    echo "<tr><td>";
                    echo $term->name;
                    echo "</td>";echo "<td>";
                    ?>
                    <input type="checkbox" name="<?php $mb->the_name(); ?>" value="<?php echo $term->slug; ?>"<?php echo $mb->is_value($term->slug)?' checked="checked"':''; ?>/>
                    </td></tr>
                    <?php
                }
                echo "</table><div class='clear'></div></div>";
            }
        ?>
    </div>
</div>

