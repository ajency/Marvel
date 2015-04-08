<div class="my_meta_control">
	<p class="my_meta_p">
    	<strong>Autoplay Slideshow?</strong>
		<?php 
			$mb->the_field('alchemy_autoplay');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br/>
	</p>
	<p class="my_meta_p">
    	<strong>Play slideshow even when mouse is over?</strong>
		<?php 
			$mb->the_field('alchemy_hover');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br/>
	</p>
    	<p class="my_meta_p">
            <strong>&nbsp;Slideshow delay in miliseconds:</strong> (Optional)
            <?php $mb->the_field('alchemy_full_delay'); ?><br />
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="5" style="width:100px"/>
        </p>
        <?php 
			//FLAG TO KNOW WHEN WE ARE GOING THROUGH THE GROUPS
			$mb->the_field('helper_fk');
		?>
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="weirdostf"/><br/>		
        <?php
        	$terms=get_terms('pirenko_slide_set');
			$count = count($terms);
			if ($count>0)
			{   
				echo "<div class='btm_12'><span class='prk_alt_opt'>Groups to be displayed on this page:</span> (Leave blank for all)<br /><table>";
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

