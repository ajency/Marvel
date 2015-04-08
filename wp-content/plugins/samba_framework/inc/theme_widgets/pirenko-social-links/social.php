<?php
	/*
		Plugin Name: Pirenko Social Links 
		Plugin URI: http://www.munto.net
		Description: A widget to add social network links to your website.
		Version: 1.0
		Author: Pirenko
		Author URI: http://www.munto.net
	*/
	
	//ADD WIDGET LOADING
	add_action( 'widgets_init', 'load_pirenko_social' );
	//REGISTER WIDGET
	function load_pirenko_social() {
		register_widget( 'pirenko_social_widget' );
	}
	//CREATE CLASS TO CONTROL EVERYTHING
	class pirenko_social_widget extends WP_Widget 
	{
		//SET UP WIDGET
		function pirenko_social_widget() 
		{
			$widget_ops = array( 'classname' => 'pirenko-social-widget', 'description' => ('A widget to add social network links to your website.') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'pirenko-social-widget' );
			$this->WP_Widget( 'pirenko-social-widget', __('Samba : Social Links ', 'samba_lang'), $widget_ops, $control_ops );
		}

		
		var $imgs_url;
		var $z_social_title;
		var $pir_icons;
		var $tips;
		function fields_array( $instance = array() ) 
		{
			$this->imgs_url = plugins_url( '/icons/colored/' , __FILE__ );
			return array(
				'500px' => array(
					'title' => __('500px URL', 'astro_lang'),
					'img' => sprintf( '%s500px.png', '' ),
					'img_widget' => sprintf( '%s500px.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'fivehundredpx',
					'img_color' => '#000000',
					'img_title' => __('500 px', 'astro_lang')
				),
				'behance' => array(
					'title' => __('Behance URL', 'astro_lang'),
					'img' => sprintf( '%sbehance.png', '' ),
					'img_widget' => sprintf( '%sbehance.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'behance',
					'img_color' => '#2d9ad2',
					'img_title' => __('Behance', 'astro_lang')
				),
				'blogger' => array(
					'title' => __('Blogger URL', 'astro_lang'),
					'img' => sprintf( '%sblogger.png', '' ),
					'img_widget' => sprintf( '%sblogger.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'blogger',
					'img_color' => '#ee5a22',
					'img_title' => __('Blogger', 'astro_lang')
				),
				'digg' => array(
					'title' => __('Digg URL', 'astro_lang'),
					'img' => sprintf( '%sdigg.png', '' ),
					'img_widget' => sprintf( '%sdigg.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'digg',
					'img_color' => '#24578e',
					'img_title' => __('Digg', 'astro_lang')
				),
				'dribbble' => array(
					'title' => __('Dribbble', 'astro_lang'),
					'img' => sprintf( '%sdribbble.png', '' ),
					'img_widget' => sprintf( '%sdribbble.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'dribbble',
					'img_color' => '#ea4c89',
					'img_title' => __('Dribbble', 'astro_lang')
				),
				'facebook' => array(
					'title' => __('Facebook URL', 'astro_lang'),
					'img' => sprintf( '%sfacebook.png', '' ),
					'img_widget' => sprintf( '%sfacebook.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'facebook',
					'img_color' => '#1f69b3',
					'img_title' => __('Facebook', 'astro_lang')
				),
				'flickr' => array(
					'title' => __('Flickr URL', 'astro_lang'),
					'img' => sprintf( '%sflickr.png', '' ),
					'img_widget' => sprintf( '%sflickr.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'flickr',
					'img_color' => '#fd0083',
					'img_title' => __('Flickr', 'astro_lang')
				),
				'google_plus' => array(
					'title' => __('Google Plus URL', 'astro_lang'),
					'img' => sprintf( '%sgoogle_plus.png', '' ),
					'img_widget' => sprintf( '%sgoogle_plus.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'googleplus',
					'img_color' => '#333333',
					'img_title' => __('Google Plus', 'astro_lang')
				),
				'instagram' => array(
					'title' => __('Instagram URL', 'astro_lang'),
					'img' => sprintf( '%sinstagram.png', '' ),
					'img_widget' => sprintf( '%sinstagram.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'instagram',
					'img_color' => '#3f729b',
					'img_title' => __('Instagram', 'astro_lang')
				),
				'linkedin' => array(
					'title' => __('Linkedin URL', 'astro_lang'),
					'img' => sprintf( '%slinkedin.png', '' ),
					'img_widget' => sprintf( '%slinkedin.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'linkedin',
					'img_color' => '#1a7696',
					'img_title' => __('Linkedin', 'astro_lang')
				),
				'myspace' => array(
					'title' => __('MySpace URL', 'astro_lang'),
					'img' => sprintf( '%smyspace.png', '' ),
					'img_widget' => sprintf( '%smyspace.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'myspace',
					'img_color' => '#000000',
					'img_title' => __('MySpace', 'astro_lang')
				),
				'pinterest' => array(
					'title' => __('Pinterest URL', 'astro_lang'),
					'img' => sprintf( '%spinterest.png', '' ),
					'img_widget' => sprintf( '%spinterest.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'pinterest',
					'img_color' => '#df2126',
					'img_title' => __('Pinterest', 'astro_lang')
				),
				'skype' => array(
					'title' => __('Skype URL', 'astro_lang'),
					'img' => sprintf( '%sskype.png', '' ),
					'img_widget' => sprintf( '%sskype.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'skype',
					'img_color' => '#28a9ed',
					'img_title' => __('Skype', 'astro_lang')
				),
				'stumbleupon' => array(
					'title' => __('StumbleUpon URL', 'samba_lang'),
					'img' => sprintf( '%sstumbleupon.png', '' ),
					'img_widget' => sprintf( '%sstumbleupon.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'stumbleupon',
					'img_color' => '#eb4924',
					'img_title' => __('StumbleUpon', 'samba_lang')
				),
				'tumblr' => array(
					'title' => __('Tumblr URL', 'astro_lang'),
					'img' => sprintf( '%stumblr.png', '' ),
					'img_widget' => sprintf( '%stumblr.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'tumblr',
					'img_color' => '#374a61',
					'img_title' => __('Tumblr', 'astro_lang')
				),
				'twitter' => array(
					'title' => __('Twitter URL', 'astro_lang'),
					'img' => sprintf( '%stwitter.png', '' ),
					'img_widget' => sprintf( '%stwitter.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'twitter',
					'img_color' => '#43b3e5',
					'img_title' => __('Twitter', 'astro_lang')
				),
				'vimeo' => array(
					'title' => __('Vimeo URL', 'astro_lang'),
					'img' => sprintf( '%svimeo.png', '' ),
					'img_widget' => sprintf( '%svimeo.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'vimeo',
					'img_color' => '#4ab2d9',
					'img_title' => __('Vimeo', 'astro_lang')
				),
				'youtube' => array(
					'title' => __('YouTube URL', 'astro_lang'),
					'img' => sprintf( '%syoutube.png', '' ),
					'img_widget' => sprintf( '%syoutube.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'youtube',
					'img_color' => '#fb2d39',
					'img_title' => __('Youtube', 'astro_lang')
				),
				'feedburner' => array(
					'title' => __('RSS/Feedburner URL', 'astro_lang'),
					'img' => sprintf( '%srss.png', '' ),
					'img_widget' => sprintf( '%srss.png', $this->imgs_url . esc_attr( $instance['icon_set'] ) ),
					'img_class' => 'rss',
					'img_color' => '#ed8333',
					'img_title' => __('RSS Feed', 'astro_lang')
				),		
			);
		}
		//SET UP WIDGET OUTPUT
		function widget( $args, $instance ) 
		{
			extract($args);
			//GRAB CURRENT VALUES
			$instance = wp_parse_args($instance, array(
				'title' => '',
				'new_window' => 0,
				'icon_set' => '',
				'size' => '24x24'
			) );
			//BEFORE WIDGET CODE
			echo $before_widget;	
			//DISPLAY TITLE IF NECESSARY
			if ( ! empty( $instance['title'] ) )
					echo $before_title . $instance['title'] . $after_title;
			//DISPLAY LINKS
			$c_color="";
			?>
			<div class="pirenko_social <?php echo $instance['pir_icons']; ?>">
				<?php
				$tips_class="";
				if (isset($instance['tips']) && $instance['tips']=="yes")
					$tips_class='class="tipped"';
				$big_icons="";
				if ($instance['pir_icons']=="rounded_large")
					$big_icons="big_icons";	
				$new_window="target='_blank'";
				$inside_counter=1;
				$sizer=34;
				if ($instance['pir_icons'] == 'minimal') 
				{
					$sizer=24;
					foreach ( $this->fields_array( $instance ) as $key => $data ) 
					{
						if ( ! empty ( $instance[$key] ) ) 
						{
							printf( '<div class="social_img_wrp"><a href="%s" title="%s" %s %s data-color="%s"><div class="prk_less_opacity prk_minimal_icon zocial icon %s"></div></a></div>',( $instance[$key] ), esc_attr( $data['img_title'] ), $new_window , $tips_class,$data['img_color'],$data['img_class']);
							$inside_counter++;
						}
					}
				}
				if ($instance['pir_icons'] == 'colored') 
				{
					$sizer=24;
					foreach ( $this->fields_array( $instance ) as $key => $data ) 
					{
						if ( ! empty ( $instance[$key] ) ) 
						{
							printf( '<div class="social_img_wrp"><a href="%s" title="%s" %s %s><div class="prk_with_back zocial icon %s"></div></a></div>',( $instance[$key] ), esc_attr( $data['img_title'] ), $new_window , $tips_class,$data['img_class']);
							$inside_counter++;
						}
					}
				}
				if ($instance['pir_icons'] == 'rounded') 
				{
					$sizer=34;
					foreach ( $this->fields_array( $instance ) as $key => $data ) 
					{
						if ( ! empty ( $instance[$key] ) ) 
						{
							printf( '<div class="social_img_wrp" style="width:%spx;height:%spx;float:left;"><a href="%s" title="%s" %s %s><img src="%s" class="pir_icons %s" width="%s" height="%s" alt="%s" /></a></div>', $sizer,$sizer,( $instance[$key] ), esc_attr( $data['img_title'] ), $new_window , $tips_class, plugins_url( '/icons/' , __FILE__ ).$instance['pir_icons'].'/'.$data['img'], $big_icons,$sizer,$sizer, esc_attr( $data['img_title'] ) );
							$inside_counter++;
						}
					}
				}
				if ($instance['pir_icons'] == 'squared') 
				{
					$sizer=34;
					foreach ( $this->fields_array( $instance ) as $key => $data ) 
					{
						if ( ! empty ( $instance[$key] ) ) 
						{
							printf( '<div class="social_img_wrp" style="width:%spx;height:%spx;float:left;"><a href="%s" title="%s" %s %s><img src="%s" class="pir_icons %s" width="%s" height="%s" alt="%s" /></a></div>', $sizer,$sizer,( $instance[$key] ), esc_attr( $data['img_title'] ), $new_window , $tips_class, plugins_url( '/icons/' , __FILE__ ).$instance['pir_icons'].'/'.$data['img'], $big_icons,$sizer,$sizer, esc_attr( $data['img_title'] ) );
							$inside_counter++;
						}
					}
				}
				?>
				<div class="clearfix"></div>
			</div>
			<?php
			//AFTER WIDGET CODE
			echo $after_widget;
			?>
			<script type="text/javascript">
				jQuery(document).ready(function()
				{		
						jQuery('.pir_icons').hover(
						function() 
						{
							//alert (slider.count);
							jQuery(this).stop().animate({'opacity':0.75}, 150 );
						},
						function()
						{
							jQuery(this).stop().animate({'opacity':1}, 150 );
						});
				});
					
			</script>
            <?php
		}
		//UPDATE WIDGET SETTINGS
		function update( $new_instance, $old_instance ) 
		{
			return $new_instance;
		}
		//SET UP WIDGET FORM ON THE CONTROL PANEL
		function form( $instance ) 
		{
			$instance = wp_parse_args($instance, array(
				'title' => '',
				'new_window' => 0,
				'icon_set' => '',
				'size' => '24x24',
				'c_color' => ''
			) ); 
			if (isset($instance['tips']))
				$tips=$instance['tips'];
			else
				$tips="yes";
			$instance['tips']=$tips;
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'samba_lang'); ?>:</label><br />
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="pct_89" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('tips'); ?>"><?php _e('Show Tooltips', 'samba_lang'); ?>:</label><br />
				<select id="<?php echo $this->get_field_id('tips'); ?>" name="<?php echo $this->get_field_name('tips'); ?>" class="pct_69">
					<?php    
							if ( $instance['tips'] == 'yes' ) // Make default first in list
                                echo "\n\t<option selected='selected' value='yes'>Yes</option>";
                            else
                                echo "\n\t<option value='yes'>Yes</option>";
							if ( $instance['tips'] == 'no' ) // Make default first in list
                                echo "\n\t<option selected='selected' value='no'>No</option>";
                            else
                                echo "\n\t<option value='no'>No</option>";
                    ?>
              	</select>
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('pir_icons'); ?>"><?php _e('Icon Set', 'samba_lang'); ?>:</label><br />
				<select id="<?php echo $this->get_field_id('pir_icons'); ?>" name="<?php echo $this->get_field_name('pir_icons'); ?>" class="pct_69">
					<?php    
							if ( $instance['pir_icons'] == 'colored' ) // Make default first in list
                                echo "\n\t<option selected='selected' value='colored'>Squared</option>";
                            else
                                echo "\n\t<option value='colored'>Squared</option>";

							if ( $instance['pir_icons'] == 'rounded' ) // Make default first in list
                                echo "\n\t<option selected='selected' value='rounded'>Rounded flat</option>";
                            else
                                echo "\n\t<option value='rounded'>Rounded flat</option>";

							if ( $instance['pir_icons'] == 'squared' ) // Make default first in list
                                echo "\n\t<option selected='selected' value='squared'>Squared flat</option>";
                            else
                                echo "\n\t<option value='squared'>Squared flat</option>";

							if ( $instance['pir_icons'] == 'minimal' ) // Make default first in list
                                echo "\n\t<option selected='selected' value='minimal'>Minimal</option>";
                            else
                                echo "\n\t<option value='minimal'>Minimal</option>";
                    ?>
              	</select>
			</p>
			<?php
			foreach ( $this->fields_array( $instance ) as $key => $data ) 
			{
				$inner_c="";
				if (isset($instance[$key]))
					$inner_c=$instance[$key];
				echo '<p>';
				printf( '<img class="socials_icns" src="%s" title="%s" />', $data['img_widget'], $data['img_title'] );
				printf( '<label for="%s"> %s:</label><br>', esc_attr( $this->get_field_id($key) ), esc_attr( $data['title'] ) );
				if ($data['img_title']!='Skype') {
					printf( '<input id="%s" name="%s" value="%s" style="%s" class="pct_75" />', esc_attr( $this->get_field_id($key) ), esc_attr( $this->get_field_name($key) ), esc_url( $inner_c ), 'width:75%;' );
				}
				else
				{
					printf( '<input id="%s" name="%s" value="%s" style="%s" class="pct_75" />', esc_attr( $this->get_field_id($key) ), esc_attr( $this->get_field_name($key) ), ( $inner_c ), 'width:75%;' );
				}
				echo '</p>' . "\n";
			}
		}
	}
?>