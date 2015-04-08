<div class="my_meta_control">
    <p class="my_meta_p">
        <span class="prk_alt_opt">Show title on this page?</span>
        <?php 
            $mb->the_field('alchemy_show_title');
            if(!($mb->get_the_value()))
            {
                $mb->the_checkbox_state = 'checked';
            }
        ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br/>
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
        <span class="prk_alt_opt">Text Color (Optional):</span>
        <?php $mb->the_field('alchemy_text_color'); ?><br />
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="5" class="mdm_input" />
        <em class="em_darker_grey">&nbsp;Example:#000000</em>
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
</div>