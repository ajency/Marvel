<div class="my_meta_control">
    <p class="my_meta_p">
        <span class="prk_alt_opt">Sidebar display:</span>
        <?php 
                $mb->the_field('alchemy_show_sidebar'); 
        ?>
        <select name="<?php $metabox->the_name(); ?>">
        <option value="default">Default Option</option>
        <option value="yes" <?php if ($metabox->get_the_value() == 'yes') echo "selected='SELECTED'"; ?>>Show Sidebar</option>
        <option value="no" <?php if ($metabox->get_the_value() == 'no') echo "selected='SELECTED'"; ?>>Hide Sidebar</option>
        </select>
    </p>
    <h2>Header options</h2>
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
    <h2 class="extra_mg">Thumbnail options</h2>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Show avatar inside thumbnail image?</span>
        <?php 
            $mb->the_field('alchemy_show_avatar');
            if(!($mb->get_the_value()))
            {
                $mb->the_checkbox_state = 'checked';
            }
        ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
        <em class="em_darker_grey right_floated">Applicable only for posts with featured images.</em>
        <br/><br/>
    </p>
    <h2 class="extra_mg">Filter options</h2>
    <div class="clear btm_20"></div>
    <?php 
        //FLAG TO KNOW WHEN WE ARE GOING THROUGH THE CATEGORIES
        $mb->the_field('helper_fk');
    ?>
    <input type="hidden" name="<?php $mb->the_name(); ?>" value="weirdostf"/>  
        <?php
        	$terms= get_categories(); 
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

