<?php
	/*
		Plugin Name: Pirenko Social Links 
		Plugin URI: http://www.munto.net
		Description: A widget to add social network links to your website.
		Version: 1.1
		Author: Pirenko
		Author URI: http://www.munto.net
	*/
	
	//ADD WIDGET LOADING
	add_action( 'widgets_init', 'load_pirenko_vcard' );
	//REGISTER WIDGET
	function load_pirenko_vcard() {
		register_widget('samba_Vcard_Widget');
	}
class samba_Vcard_Widget extends WP_Widget 
{
  	function samba_Vcard_Widget() 
  	{
		$widget_ops = array('classname' => 'widget_samba_vcard', 'description' => __('Use this widget to add a vCard', 'samba_lang'));
		$this->WP_Widget('widget_samba_vcard', __('Samba: vCard', 'samba_lang'), $widget_ops);
		$this->alt_option_name = 'widget_samba_vcard';
	
		add_action('save_post', array(&$this, 'flush_widget_cache'));
		add_action('deleted_post', array(&$this, 'flush_widget_cache'));
		add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  	}

  	function widget($args, $instance) 
	{
		$cache = wp_cache_get('widget_samba_vcard', 'widget');
	
		if (!is_array($cache)) {
		  $cache = array();
		}
	
		if (!isset($args['widget_id'])) {
		  $args['widget_id'] = null;
		}
	
		if (isset($cache[$args['widget_id']])) {
		  echo $cache[$args['widget_id']];
		  return;
		}

		ob_start();
		extract($args, EXTR_SKIP);
	
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		if (!isset($instance['company_name'])) { $instance['company_name'] = ''; }
		if (!isset($instance['street_address'])) { $instance['street_address'] = ''; }
		if (!isset($instance['locality'])) { $instance['locality'] = ''; }
		if (!isset($instance['region'])) { $instance['region'] = ''; }
		if (!isset($instance['postal_code'])) { $instance['postal_code'] = ''; }
		if (!isset($instance['tel'])) { $instance['tel'] = ''; }
		if (!isset($instance['email'])) { $instance['email'] = ''; }
		
		echo $before_widget;
		if ($title) 
		{
		  	echo $before_title;
		  	echo $title;
		  	echo $after_title;
    	}
		if ($instance['region']!='')
			$instance['region']=', ' . $instance['region'];
  	?>
    <div class="vcard">
    	<?php 
			if ($instance['image_path']!="")
			{
				?>
				<img src="<?php echo $instance['image_path']; ?>" />
				<?php
			}
		?>
      	<div class="adr twelve">
            <div class="prk_vc_icon">
                <div class="navicon-home-2"></div>
            </div>
            <?php 
				if ($instance['company_name']!="")
				{
					?>
					<div class="ttl not_zero_color"><?php echo $instance['company_name']; ?></div>
					<?php
				}
				if ($instance['street_address']!="")
				{
					?>
					<div class="street-address"><?php echo $instance['street_address']; ?></div>
                    <?php
				}
				if ($instance['locality']!="" || $instance['region']!="")
				{
					?>
					<div class="locality"><?php echo $instance['locality']; echo $instance['region'];?></div>
					<?php
				}
				if ($instance['postal_code']!="")
				{
					?>
					<div class="postal-code"><?php echo $instance['postal_code']; ?></div>
					<?php
				}
			?>
      	</div><!-- adr -->
		<?php if ($instance['tel']!="")
		{
			?>
            <div class="tel twelve">
                <div class="prk_vc_icon">
                    <div class="navicon-phone"></div>
                </div>
                <div class="vcard_padded">
                	<?php echo $instance['tel']; ?>
                </div>
            </div>
            <?php
		}
		if ($instance['email']!="")
		{
			?>
            <div class="email twelve">
                <div class="prk_vc_icon">
                    <div class="navicon-envelop"></div>
                </div>
                <div class="vcard_padded default_color">
	                <a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a>
	            </div>
            </div>
            <?php
		}
        ?>   
    </div>
  	<?php
    echo $after_widget;
    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_samba_vcard', $cache, 'widget');
}

function update($new_instance, $old_instance) 
{
	$instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
	$instance['image_path'] = strip_tags($new_instance['image_path']);
	$instance['company_name'] = strip_tags($new_instance['company_name']);
    $instance['street_address'] = strip_tags($new_instance['street_address']);
    $instance['locality'] = strip_tags($new_instance['locality']);
    $instance['region'] = strip_tags($new_instance['region']);
    $instance['postal_code'] = strip_tags($new_instance['postal_code']);
    $instance['tel'] = strip_tags($new_instance['tel']);
    $instance['email'] = strip_tags($new_instance['email']);
    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');
    if (isset($alloptions['widget_samba_vcard'])) 
	{
      	delete_option('widget_samba_vcard');
    }

    return $instance;
}

	function flush_widget_cache() 
  	{
    	wp_cache_delete('widget_samba_vcard', 'widget');
  	}

	function form($instance) 
  	{
    	$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$image_path = isset($instance['image_path']) ? esc_attr($instance['image_path']) : '';
    	$company_name = isset($instance['company_name']) ? esc_attr($instance['company_name']) : '';
		$street_address = isset($instance['street_address']) ? esc_attr($instance['street_address']) : '';
    	$locality = isset($instance['locality']) ? esc_attr($instance['locality']) : '';
    	$region = isset($instance['region']) ? esc_attr($instance['region']) : '';
    	$postal_code = isset($instance['postal_code']) ? esc_attr($instance['postal_code']) : '';
    	$tel = isset($instance['tel']) ? esc_attr($instance['tel']) : '';
    	$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
  		?>
    	<p>
      		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title (optional):', 'samba_lang'); ?></label>
      		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    	</p>
        <p>
				<label>Image URL Path:</label>
				<input class="widefat" id="prk_vcard_image" name="<?php echo $this->get_field_name( 'image_path' ); ?>" type="text" value="<?php echo $image_path; ?>" />
				<?php
				if ($image_path!="")
				{
					?>
					<br />
					<img id="prk_vcard_image_image" src="<?php echo $image_path; ?>" width="200" />
					<?php
				}
				?>
				<br />
			</p>
        <p>
      		<label for="<?php echo esc_attr($this->get_field_id('company_name')); ?>"><?php _e('Company Name:', 'samba_lang'); ?></label>
      		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('company_name')); ?>" name="<?php echo esc_attr($this->get_field_name('company_name')); ?>" type="text" value="<?php echo esc_attr($company_name); ?>" />
    	</p>
    	<p>
      		<label for="<?php echo esc_attr($this->get_field_id('street_address')); ?>"><?php _e('Street Address:', 'samba_lang'); ?></label>
      		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('street_address')); ?>" name="<?php echo esc_attr($this->get_field_name('street_address')); ?>" type="text" value="<?php echo esc_attr($street_address); ?>" />
    	</p>
    	<p>
      		<label for="<?php echo esc_attr($this->get_field_id('locality')); ?>"><?php _e('City/Locality:', 'samba_lang'); ?></label>
      		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('locality')); ?>" name="<?php echo esc_attr($this->get_field_name('locality')); ?>" type="text" value="<?php echo esc_attr($locality); ?>" />
    	</p>
    	<p>
      		<label for="<?php echo esc_attr($this->get_field_id('region')); ?>"><?php _e('State/Region:', 'samba_lang'); ?></label>
      		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('region')); ?>" name="<?php echo esc_attr($this->get_field_name('region')); ?>" type="text" value="<?php echo esc_attr($region); ?>" />
    	</p>
    	<p>
      		<label for="<?php echo esc_attr($this->get_field_id('postal_code')); ?>"><?php _e('Zipcode/Postal Code:', 'samba_lang'); ?></label>
      		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('postal_code')); ?>" name="<?php echo esc_attr($this->get_field_name('postal_code')); ?>" type="text" value="<?php echo esc_attr($postal_code); ?>" />
    	</p>
    	<p>
      		<label for="<?php echo esc_attr($this->get_field_id('tel')); ?>"><?php _e('Telephone:', 'samba_lang'); ?></label>
      		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tel')); ?>" name="<?php echo esc_attr($this->get_field_name('tel')); ?>" type="text" value="<?php echo esc_attr($tel); ?>" />
    	</p>
    	<p>
      		<label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('Email:', 'samba_lang'); ?></label>
      		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
    	</p>
  		<?php
  	}
}
?>