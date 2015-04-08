<div class="my_meta_control">
	<div class="my_meta_p">
		<?php 
			$mb->the_field('featured_color'); 
		?>
    	<span class="prk_alt_opt">Featured color (optional)</span>
    	<div id="featured_picker" class="color_selector prk_picker" data-color="<?php echo $mb->get_the_value(); ?>">
	    	<div style="background-color:<?php echo $mb->get_the_value(); ?>"></div>
	    </div>
    	<input id="featured_picker_input" class="prk_input_listen" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	</div>
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Skip featured image on slideshow and lightbox?</span>
		<?php 
			$mb->the_field('skip_featured'); 
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?>/><br/>
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Featured thumbnail (will have 2x height on the Portfolio Grid Multiple Sizes Template)?</span>
		<?php 
			$mb->the_field('featured_thumb'); 
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?>/><br/>
        
	</p>
    <p class="my_meta_p">
	    <span class="prk_alt_opt">Portfolio post layout: </span><br />
	    <?php 
				$mb->the_field('inner_layout'); 
		?>
	    <select name="<?php $metabox->the_name(); ?>">
	    <option value="default">Default</option>
	    <option value="wide" <?php if ($metabox->get_the_value() == 'wide') echo "selected='SELECTED'"; ?>>Full Width</option>
	    <option value="wideout" <?php if ($metabox->get_the_value() == 'wideout') echo "selected='SELECTED'"; ?>>Wide - without right info panel</option>
	    <option value="half" <?php if ($metabox->get_the_value() == 'half') echo "selected='SELECTED'"; ?>>Half</option>
	    </select>
	    <div class="clear"></div>
    </p>
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Client:</span> (Optional)
		<?php $mb->the_field('client_url'); ?><br />
		<input type="text" id="samba_client_url" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="5"/>
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Project link:</span> (Optional)<br />
		<?php $mb->the_field('ext_url'); ?>
		<input type="text" id="samba_ext_url" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="7"/>
	</p>
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Project link text:</span> (The text that will be displayed on the button - leave blank for the translation default value)<br />
		<?php $mb->the_field('ext_url_label'); ?>
		<input type="text" id="samba_ext_url_label" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="7"/>
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Open Project Link when thumb is clicked?</span>
		<?php 
			$mb->the_field('skip_to_external'); 
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?>/><br/>
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Disable slider and show images and videos stacked vertically?</span>
		<?php 
			$mb->the_field('no_slider'); 
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php $mb->the_checkbox_state('1'); ?>/><br/>
	</p>           
	<div class="my_meta_p">
        <span class="prk_alt_opt">Image 1</span><br />
        <em>This image is the featured image. Please set this up by editing the Featured Image on the right side of this page.</em>
    </div>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Image/Video 2</span><br />
		<?php $mb->the_field('image_2'); ?>
		<input type="text" id="samba_image_2" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_2">
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Image/Video 3</span><br />
		<?php $mb->the_field('image_3'); ?>
		<input type="text" id="samba_image_3" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_3">
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Image/Video 4</span><br />
		<?php $mb->the_field('image_4'); ?>
		<input type="text" id="samba_image_4" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_4">
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Image/Video 5</span><br />
		<?php $mb->the_field('image_5'); ?>
		<input type="text" id="samba_image_5" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_5">
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Image/Video 6</span><br />
		<?php $mb->the_field('image_6'); ?>
		<input type="text" id="samba_image_6" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_6">
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Image/Video 7</span><br />
		<?php $mb->the_field('image_7'); ?>
		<input type="text" id="samba_image_7" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_7">
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Image/Video 8</span><br />
		<?php $mb->the_field('image_8'); ?>
		<input type="text" id="samba_image_8" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_8">
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Image/Video 9</span><br />
		<?php $mb->the_field('image_9'); ?>
		<input type="text" id="samba_image_9" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_9">
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">Image/Video 10</span><br />
		<?php $mb->the_field('image_10'); ?>
		<input type="text" id="samba_image_10" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_10">
	</p>
	<?php
		for ($i=11;$i<11;$i++)
		{
			echo '<p class="my_meta_p">';
			echo 'Image/Video '.$i;
			$stringa='image_'.$i;
			$mb->the_field($stringa);
			?>
			<input type="text" id="samba_image_<?php echo $i; ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_<?php echo $i; ?>">
			<?php
			echo '</p>';
		}
	?>
</div>