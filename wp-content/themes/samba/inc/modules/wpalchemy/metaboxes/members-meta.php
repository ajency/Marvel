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
    	<span class="prk_alt_opt">&nbsp;Team member job:</span>
		<?php $mb->the_field('member_job'); ?><br />
		<input type="text" id="samba_member_job" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="7"/>
	</p>
    <p class="my_meta_p">
    	<span class="prk_alt_opt">&nbsp;Team member email:</span> (Optional)<br />
		<?php $mb->the_field('member_email'); ?>
		<input type="text" id="samba_member_email" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="7"/>
	</p>
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Show link to single member page?</span><br>
		<?php 
                $mb->the_field('alchemy_show_member_link'); 
        ?>
        <select name="<?php $metabox->the_name(); ?>">
        <option value="yes" <?php if ($metabox->get_the_value() == 'yes') echo "selected='SELECTED'"; ?>>Yes</option>
        <option value="no" <?php if ($metabox->get_the_value() == 'no') echo "selected='SELECTED'"; ?>>No</option>
        </select>
    </p>
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Show image on single member page?</span><br>
		<?php 
                $mb->the_field('alchemy_show_member_image'); 
        ?>
        <select name="<?php $metabox->the_name(); ?>">
        <option value="yes" <?php if ($metabox->get_the_value() == 'yes') echo "selected='SELECTED'"; ?>>Yes</option>
        <option value="no" <?php if ($metabox->get_the_value() == 'no') echo "selected='SELECTED'"; ?>>No</option>
        </select>
    </p>
	<p class="my_meta_p">
    	<span class="prk_alt_opt">Single page image </span> (Optional)
		<?php $mb->the_field('image_2'); ?>
		<input type="text" id="samba_image_2" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
         <input class="pirenko_upload button hundred" type="button" value="Upload image" name="image_2">
	</p>
	<?php
		$social_options=array(
		'0' => array(
			'value' =>	'none',
			'label' => 'None'
		),
		'1' => array(
			'value' =>	'delicious',
			'label' => 'Delicious'
		),
		'2' => array(
			'value' =>	'deviantart',
			'label' => 	'Deviantart'
		),
		'3' => array(
			'value' =>	'facebook-2',
			'label' => 	'Facebook'
		),
		'4' => array(
			'value' =>	'flickr-2',
			'label' => 	'Flickr'
		),
		'5' => array(
			'value' =>	'google-plus-2',
			'label' => 	'Google Plus'
		),
		'6' => array(
			'value' =>	'instagram',
			'label' => 	'Instagram'
		),
		'7' => array(
			'value' =>	'linkedin',
			'label' => 	'Linkedin'
		),
		'9' => array(
			'value' =>	'pinterest',
			'label' => 	'Pinterest'
		),
		'10' => array(
			'value' =>	'skype',
			'label' => 	'Skype'
		),
		'11' => array(
			'value' =>	'twitter-2',
			'label' => 	'Twitter'
		),
		'12' => array(
			'value' =>	'vimeo2',
			'label' => 	'Vimeo'
		),
		'13' => array(
			'value' =>	'yahoo',
			'label' => 	'Yahoo'
		),
		'14' => array(
			'value' =>	'youtube-2',
			'label' => 	'Youtube'
		),
		'15' => array(
			'value' =>	'feed-2',
			'label' => 	'RSS'
		),
		'16' => array(
			'value' =>	'address-book',
			'label' => 	'vCard'
		)
	);
	?>
	<p class="my_meta_p">
	<span class="prk_alt_opt">Social networks 1</span>
	<?php 
		$mb->the_field('member_social_1'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span><br />
	<?php 
		$mb->the_field('member_social_1_link'); 
	?>
    <input type="text" id="member_social_1_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
    <p class="my_meta_p">
    <span class="prk_alt_opt">Social networks 2</span>
	<?php 
		$mb->the_field('member_social_2'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span><br />
	<?php 
		$mb->the_field('member_social_2_link'); 
	?>
    <input type="text" id="member_social_2_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
   </p>
   <p class="my_meta_p">
    <span class="prk_alt_opt">Social networks 3</span>
	<?php 
		$mb->the_field('member_social_3'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span><br />
	<?php 
		$mb->the_field('member_social_3_link'); 
	?>
    <input type="text" id="member_social_3_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
    <p class="my_meta_p">
    <span class="prk_alt_opt">Social networks 4</span>
	<?php 
		$mb->the_field('member_social_4'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span><br />
	<?php 
		$mb->the_field('member_social_4_link'); 
	?>
    <input type="text" id="member_social_4_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
    <p class="my_meta_p">
    <span class="prk_alt_opt">Social networks 5</span>
	<?php 
		$mb->the_field('member_social_5'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span><br />
	<?php 
		$mb->the_field('member_social_5_link'); 
	?>
    <input type="text" id="member_social_5_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
    <p class="my_meta_p">
    <span class="prk_alt_opt">Social networks 6</span>
	<?php 
		$mb->the_field('member_social_6'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span><br />
	<?php 
		$mb->the_field('member_social_6_link'); 
	?>
    <input type="text" id="member_social_6_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
</div>