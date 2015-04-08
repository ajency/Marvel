<div class="my_meta_control">
    <h2>General Options</h2>
     <p class="my_meta_p">
        <span class="prk_alt_opt">Number of columns:</span>
        <?php $mb->the_field('alchemy_cols_number'); ?>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="2" class="mdm_input_small" />
        <em class="em_darker_grey right_floated">Default value is 5</em>
        <br /><br />
    </p>
    <h2 class="extra_mg">Thumbnail Options</h2>
    <p class="my_meta_p">
        <span class="prk_alt_opt">Carousel panels rollover behavior?</span>
        <?php 
                $mb->the_field('alchemy_acc_look'); 
        ?>
        <select name="<?php $metabox->the_name(); ?>">
        <option value="samba_opener" <?php if ($metabox->get_the_value() == 'samba_opener') echo "selected='SELECTED'"; ?>>Open panel and show more info</option>
        <option value="prk_no_open" <?php if ($metabox->get_the_value() == 'prk_no_open') echo "selected='SELECTED'"; ?>>Keep panel size and enlarge image</option>
        </select>
    </p>
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

