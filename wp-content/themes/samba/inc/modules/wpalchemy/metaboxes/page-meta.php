<div class="my_meta_control">
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Sidebar display:</span><br>
		<?php 
                $mb->the_field('alchemy_show_sidebar'); 
        ?>
        <select name="<?php $metabox->the_name(); ?>">
        <option value="default">Default Option</option>
        <option value="yes" <?php if ($metabox->get_the_value() == 'yes') echo "selected='SELECTED'"; ?>>Show Sidebar</option>
        <option value="no" <?php if ($metabox->get_the_value() == 'no') echo "selected='SELECTED'"; ?>>Hide Sidebar</option>
        </select>
    </p>
</div>

