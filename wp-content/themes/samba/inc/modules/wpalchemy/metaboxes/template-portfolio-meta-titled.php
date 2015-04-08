<div class="my_meta_control">
    <h2 class="extra_mg">Header options</h2>
	<p class="my_meta_p">
        <span class="prk_alt_opt">Show title on this page?</span>
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
    	<span class="prk_alt_opt">Teaser text (will be displayed below the page title):</span>
		<?php 
			$mb->the_field('alchemy_below_headings');
		?>
        <textarea cols="40" rows="3" name="<?php $mb->the_name(); ?>"><?php $mb->the_value(); ?></textarea>
   	</p>
   	<p class="my_meta_p">
        <span class="prk_alt_opt">Text Color:</span> (Optional)
        <?php $mb->the_field('alchemy_text_color'); ?><br />
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="5" class="mdm_input" />
        <em class="em_darker_grey right_floated">Example:#000000</em>
        <br /><br />
    </p>
    <p class="my_meta_p">
        <?php 
            $mb->the_field('alchemy_header_align'); 
        ?>
        <span class="prk_alt_opt">Header text alignment:</span>
        <select name="<?php $metabox->the_name(); ?>">
            <option value="head_left" <?php if ($metabox->get_the_value() == 'head_left') echo "selected='SELECTED'"; ?>>Left</option>
            <option value="head_center" <?php if ($metabox->get_the_value() == 'head_center') echo "selected='SELECTED'"; ?>>Center</option>
            <option value="head_right" <?php if ($metabox->get_the_value() == 'head_right') echo "selected='SELECTED'"; ?>>Right</option>
        </select>
    </p>
    <h2>General Options</h2>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Load posts on the same page?</span>
        <?php 
            $mb->the_field('alchemy_posts_display'); 
        ?>
        <select name="<?php $metabox->the_name(); ?>">
        <option value="" <?php if ($metabox->get_the_value() == '') echo "selected='SELECTED'"; ?>>No - Thumbs open single pages</option>
        <option value="full" <?php if ($metabox->get_the_value() == 'full') echo "selected='SELECTED'"; ?>>Yes - Wide Layout</option>
        <option value="fullout" <?php if ($metabox->get_the_value() == 'fullout') echo "selected='SELECTED'"; ?>>Yes - Wide Layout without right info panel</option>
        <option value="half" <?php if ($metabox->get_the_value() == 'half') echo "selected='SELECTED'"; ?>>Yes - Half Width Layout</option>
        </select>
    </p>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Number of posts to load on each load event:</span>
        <?php $mb->the_field('alchemy_posts_nr'); ?>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="2" class="mdm_input_small" />
        <em class="em_darker_grey right_floated">Leave blank for the theme default value</em><br /><br />
    </p>
     <p class="my_meta_p">
        <span class="prk_alt_opt">Number of columns:</span>
        <?php $mb->the_field('alchemy_cols_number'); ?>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="2" class="mdm_input_small" />
        <em class="em_darker_grey right_floated">Leave blank for variable number</em><br /><br />
    </p>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Show skills filter above the thumbnails?</span>
        <?php 
            $mb->the_field('alchemy_show_filter');
            if(!($mb->get_the_value()))
            {
                $mb->the_checkbox_state = 'checked';
            }
        ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
    </p>
    <h2 class="extra_mg">Thumbnail Options</h2>
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Show item skills?</span>
		<?php 
			$mb->the_field('alchemy_show_skills');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
   	</p>
    <p class="my_meta_p extra_pad">
        <span class="prk_alt_opt">Show item text excerpt?</span>
        <?php 
            $mb->the_field('alchemy_show_excerpt');
            if(!($mb->get_the_value()))
            {
                $mb->the_checkbox_state = 'checked';
            }
        ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
        <em class="em_darker_grey right_floated">Will show post exerpt (if not found will display post content).</em>
        <br /><br />
    </p>
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Thumbnails open lightbox?</span>
		<?php 
			$mb->the_field('alchemy_lbox');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
   	</p>
    <p class="my_meta_p extra_pad">
        <span class="prk_alt_opt">Show mini sliders when there are multiple images?</span>
        <?php 
            $mb->the_field('mini_sliders');
            if(!($mb->get_the_value()))
            {
                $mb->the_checkbox_state = 'checked';
            }
        ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
        <em class="em_darker_grey right_floated">If on, thumbnails open lightbox option will be disabled.</em>
        <br /><br />
    </p>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Thumbnails margin (in pixels):</span><br />
        <?php $mb->the_field('alchemy_th_margin'); ?>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="2" class="mdm_input_small" />
    </p>
	<h2 class="extra_mg">Filter options</h2>
    <div class="clear btm_20"></div>
    <?php 
        //FLAG TO KNOW WHEN WE ARE GOING THROUGH THE CATEGORIES
        $mb->the_field('helper_fk');
    ?>
    <input type="hidden" name="<?php $mb->the_name(); ?>" value="weirdostf"/>  
        <?php
        	$terms=get_terms('pirenko_skills');
			$count = count($terms);
			if ($count>0)
			{   
				echo "<div class='btm_12'><span class='prk_alt_opt'>Categories to be displayed on this page:</span><br /><table>";
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

