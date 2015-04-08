<div class="my_meta_control">
	<p>
       <label for="pirenko_sh_slide_txt" class="small_label">Hide text on this slide</label>
        <?php 
            $mb->the_field('pirenko_sh_slide_txt');
            if(!($mb->get_the_value()))
            {
                $mb->the_checkbox_state = 'checked';
            }
        ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
    </p>
	<p>
		<?php
    	$sld_size_options = array(
			'medium' => array(
			'value' => 'medium',
			'label' => __( 'Medium', 'sambatheme' )
			),
			'big' => array(
			'value' => 'big',
			'label' => __( 'Big', 'sambatheme' )
			));
			$mb->the_field('pirenko_sh_slide_txt_size'); 
			?>
			<label for="pirenko_sh_slide_txt" class="small_label">Text size:</label>
			<select id="" name="<?php $metabox->the_name(); ?>">
				<?php   
				foreach ( $sld_size_options as $sld_size_option ) 
				{
					$label = $sld_size_option['label'];
					if ( $metabox->get_the_value() == $sld_size_option['value'] ) // Make default first in list
						echo "\n\t<option selected='selected' value='" . esc_attr( $sld_size_option['value'] ) . "'>$label</option>";
					else
						echo "\n\t<option value='" . esc_attr( $sld_size_option['value'] ) . "'>$label</option>";
				}
				?>
			</select>
	</p>
	<p>
		<?php
    	$horz_options = array(
			'left' => array(
			'value' => 'left',
			'label' => __( 'Left', 'sambatheme' )
			),
			'center' => array(
			'value' => 'center',
			'label' => __( 'Center', 'sambatheme' )
			),
			'right' => array(
			'value' => 'right',
			'label' => __( 'Right', 'sambatheme' )
			));
			$mb->the_field('pirenko_sh_slide_txt_horz'); 
			?>
			<label for="pirenko_sh_slide_txt_horz" class="small_label">Text horizontal position:</label>
			<select id="" name="<?php $metabox->the_name(); ?>">
				<?php   
				foreach ( $horz_options as $horz_option ) 
				{
					$label = $horz_option['label'];
					if ( $metabox->get_the_value() == $horz_option['value'] ) // Make default first in list
						echo "\n\t<option selected='selected' value='" . esc_attr( $horz_option['value'] ) . "'>$label</option>";
					else
						echo "\n\t<option value='" . esc_attr( $horz_option['value'] ) . "'>$label</option>";
				}
			?>
			</select>
	</p>
	<p>
		<?php
    	$vert_options = array(
			'top' => array(
			'value' => 'top',
			'label' => __( 'Top', 'sambatheme' )
			),
			'v_center' => array(
			'value' => 'v_center',
			'label' => __( 'Center', 'sambatheme' )
			),
			'bottom' => array(
			'value' => 'bottom',
			'label' => __( 'Bottom', 'sambatheme' )
			));
			$mb->the_field('pirenko_sh_slide_txt_vert'); 
			?>
			<label for="pirenko_sh_slide_txt_vert" class="small_label">Text vertical position:</label>
			<select id="" name="<?php $metabox->the_name(); ?>">
				<?php   
				foreach ( $vert_options as $vert_option ) 
				{
					$label = $vert_option['label'];
					if ( $metabox->get_the_value() == $vert_option['value'] ) // Make default first in list
						echo "\n\t<option selected='selected' value='" . esc_attr( $vert_option['value'] ) . "'>$label</option>";
					else
						echo "\n\t<option value='" . esc_attr( $vert_option['value'] ) . "'>$label</option>";
				}
				?>
			</select>
	</p>
	<p>
		<?php 
			$mb->the_field('pirenko_sh_slide_header_color'); 
		?>
        <label for="pirenko_sh_slide_header_color" class="small_label">Title color:</label>
        <input type="text" class="small_text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
        <em class="em_darker_grey">&nbsp;Example:#000000</em>
        <br /><br />
	</p>
	<p>
		<?php 
			$mb->the_field('pirenko_sh_slide_header_bk_color'); 
		?>
        <label for="pirenko_sh_slide_header_bk_color" class="small_label">Title background color:</label>
        <input type="text" class="small_text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
        <em class="em_darker_grey">&nbsp;Examples:#000000 or rgba(40,40,40,0.5)</em>
        <br /><br />
	</p>
	<p>
		<?php 
			$mb->the_field('pirenko_sh_slide_body_color'); 
		?>
        <label for="pirenko_sh_slide_body_color" class="small_label">Body color:</label>
        <input type="text" class="small_text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
        <em class="em_darker_grey">&nbsp;Example:#000000</em>
        <br /><br />
	</p>
	<p>
		<?php 
			$mb->the_field('pirenko_sh_slide_body_bk_color'); 
		?>
        <label for="pirenko_sh_slide_body_bk_color" class="small_label">Body background color:</label>
        <input type="text" class="small_text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
        <em class="em_darker_grey">&nbsp;Examples:#000000 or rgba(40,40,40,0.5)</em>
        <br /><br />
	</p>
	<p>
		<?php 
			$mb->the_field('pirenko_sh_video'); 
		?>
        <label for="pirenko_sh_video" class="">Video HTML code (optional):</label>
        <input type="text" class="" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	</p>
	<h2>Slide Linking</h2>
	<p>
       <label for="pirenko_sh_slide_txt" class="small_label">Show action button</label>
        <?php 
            $mb->the_field('pirenko_sh_slide_show_button');
            if(!($mb->get_the_value()))
            {
                $mb->the_checkbox_state = 'checked';
            }
        ?>
        <input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/>
    </p>
    <p>
		<?php 
			$mb->the_field('pirenko_sh_slide_button_label'); 
		?>
        <label for="pirenko_sh_slide_header_color" class="small_label">Button text:</label>
        <input type="text" class="small_text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	</p>
	<p>
		<?php 
			$mb->the_field('pirenko_sh_slide_url'); 
		?>
        <label class="">Open this URL when slide/button is clicked:</label>
        <input type="text" class="" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	</p>
	<p>
		<?php
    	$wdw_options = array(
			'_self' => array(
			'value' => '_self',
			'label' => __( 'Same window', 'sambatheme' )
			),
			'_blank' => array(
			'value' => '_blank',
			'label' => __( 'New Window', 'sambatheme' )
			));
			$mb->the_field('pirenko_sh_slide_wdw'); 
			?>
			<label for="pirenko_sh_slide_wdw" class="small_label">Open link in</label>
			<select id="" name="<?php $metabox->the_name(); ?>">
				<?php   
				foreach ( $wdw_options as $wdw_option ) 
				{
					$label = $wdw_option['label'];
					if ( $metabox->get_the_value() == $wdw_option['value'] ) // Make default first in list
						echo "\n\t<option selected='selected' value='" . esc_attr( $wdw_option['value'] ) . "'>$label</option>";
					else
						echo "\n\t<option value='" . esc_attr( $wdw_option['value'] ) . "'>$label</option>";
				}
				?>
			</select>
	</p>
</div>