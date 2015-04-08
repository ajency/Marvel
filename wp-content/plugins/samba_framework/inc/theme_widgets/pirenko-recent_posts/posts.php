<?php
	/*
		Plugin Name: Pirenko Recent Posts
		Plugin URI: http://www.munto.net
		Description: A widget to show Recent Posts.
		Version: 1.0
		Author: Pirenko
		Author URI: http://www.munto.net
	*/
	
	//ADD WIDGET LOADING
	add_action( 'widgets_init', 'load_pirenko_recent_posts' );
	//REGISTER WIDGET
	function load_pirenko_recent_posts() {
		register_widget( 'pirenko_recent_posts_widget' );
	}
	//CREATE CLASS TO CONTROL EVERYTHING
	class pirenko_recent_posts_widget extends WP_Widget 
	{
		//SET UP WIDGET
		function pirenko_recent_posts_widget() 
		{
			$widget_ops = array( 'classname' => 'pirenko-recent_posts-widget', 'description' => ('A widget to show Recent Posts.') );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'pirenko-recent_posts-widget' );
			$this->WP_Widget( 'pirenko-recent_posts-widget', __('Samba: Recent Posts', 'samba_lang'), $widget_ops, $control_ops );
		}

		//SET UP WIDGET OUTPUT
		function widget( $args, $instance ) 
		{
			global $retina_device;
			$retina_flag = $retina_device === "prk_retina" ? true : false;
			extract($args);
			//BEFORE WIDGET CODE
			echo $before_widget;	
			//DISPLAY TITLE IF NECESSARY
			if (!empty( $instance['title'] ) )
					echo $before_title . $instance['title'] . $after_title;
			?>
			<div class="pirenko_recent_posts fade_anchor">
                    <?php
						$my_home_query = new WP_Query();
						if (isset($instance['posts_per_row']))
							$posts_per_row = $instance['posts_per_row'] ;
						else
							$posts_per_row="four";
						if (isset($instance['num_items']))
							$num_items = $instance['num_items'];
						else
							$num_items="9";
						if (isset($instance['prk_filter']))
							$prk_filter = $instance['prk_filter'] ;
						else
							$prk_filter="";
						if (isset($instance['layout_type']))
							$layout_type = $instance['layout_type'] ;
						else
							$layout_type="thumbnail_lay";
						if ($instance['link_type']!='posts')
							$args = array (	'post_type' => $instance['link_type'], 
										'showposts' => $num_items,
										'pirenko_skills'=>$prk_filter
										);
						else
							$args = array (	'post_type='.$instance['link_type'], 
										'showposts' => $num_items,
										'category_name'=>$prk_filter
										);
						$my_home_query->query($args);
                        if ($my_home_query->have_posts())
						{
							?>
								<div class="cf">
                       			<ul class="recent_ul <?php echo $layout_type; ?>">
								<?php
									while ($my_home_query->have_posts()) : $my_home_query->the_post();
										if ($layout_type=="thumbnail_lay") {
											if (has_post_thumbnail())
											{	
												$image = wp_get_attachment_image_src( get_post_thumbnail_id(  ), 'full' );
												$image[0] = get_image_path($image[0]);
												$vt_image = vt_resize( '', $image[0] , 300, 300, true , $retina_flag );
												?>
												<li class="<?php echo $posts_per_row; ?> columns thumbnail_lay left_floated">
												<a href="<?php the_permalink(); ?>">
													<div class="blog_fader_grid"></div>
													<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" />
												</a>
												</li>	
												<?php
											}
										}
										else
										{
											?>
												<li class="twelve info_lay">
													<h4 class="header_font small">
														<a href="<?php the_permalink(); ?>">
															<?php echo get_the_title(); ?>
														</a>
													</h4>
													<div class="clearfix"></div>
													<?php the_date(); ?>
													<div class="simple_line"></div>
												</li>	
												<?php
										}
									endwhile; 
						}
						else
						{
							echo '<div class="cf">';
							echo ("No content was found!");	
						}
						wp_reset_query();
                    ?>
                </ul>
			</div>
            </div>
			<?php
			//AFTER WIDGET CODE
			echo $after_widget;
		}
		//UPDATE WIDGET SETTINGS
		function update( $new_instance, $old_instance ) 
		{
			return $new_instance;
		}
		//SET UP WIDGET FORM ON THE CONTROL PANEL
		function form( $instance ) 
		{
			if (isset($instance['title']))
				$title = $instance['title'] ;
			else
				$title="";
			if (isset($instance['posts_per_row']))
				$posts_per_row = $instance['posts_per_row'] ;
			else
				$posts_per_row="four";
			if (isset($instance['link_type']))
				$link_type = $instance['link_type'];
			else
				$link_type="tags";
			if (isset($instance['num_items']))
				$num_items = $instance['num_items'];
			else
				$num_items="9";
			if (isset($instance['prk_filter']))
				$prk_filter = $instance['prk_filter'] ;
			else
				$prk_filter="";
			if (isset($instance['layout_type']))
				$layout_type = $instance['layout_type'] ;
			else
				$layout_type="thumbnail_lay";
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'samba_lang'); ?>:</label><br />
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="pct_89" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('link_type'); ?>"><?php _e('Show posts or portfolios?', 'samba_lang'); ?></label><br />
				<select id="<?php echo $this->get_field_id('link_type'); ?>" name="<?php echo $this->get_field_name('link_type'); ?>" class="pct_69">
					<?php   
						if ( $link_type == 'posts' ) // Make default first in list
                        	echo "\n\t<option selected='selected' value='posts'>Posts</option>";
                       	else
                          	echo "\n\t<option value='posts'>Posts</option>";
                      	if ( $link_type == 'pirenko_portfolios' ) // Make default first in list
                        	echo "\n\t<option selected='selected' value='pirenko_portfolios'>Portfolios</option>";
                       	else
                         	echo "\n\t<option value='pirenko_portfolios'>Portfolios</option>";
							
                    ?>
              	</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('layout_type'); ?>"><?php _e('Show thumbnail or title and date?', 'samba_lang'); ?></label><br />
				<select id="<?php echo $this->get_field_id('layout_type'); ?>" name="<?php echo $this->get_field_name('layout_type'); ?>" class="possibly_hider pct_69">
					<?php   
						if ( $layout_type == 'thumbnail_lay' ) // Make default first in list
                        	echo "\n\t<option selected='selected' value='thumbnail_lay'>Thumbnail</option>";
                       	else
                          	echo "\n\t<option value='thumbnail_lay'>Thumbnail</option>";
                      	if ( $layout_type == 'info_lay' ) // Make default first in list
                        	echo "\n\t<option selected='selected' value='info_lay'>Title and date</option>";
                       	else
                         	echo "\n\t<option value='info_lay'>Title and date</option>";
							
                    ?>
              	</select>
			</p>
             <p class="possibly_hidden">
				<label for="<?php echo $this->get_field_id('posts_per_row'); ?>"><?php _e('Posts per row?', 'samba_lang'); ?></label><br />
				<select id="<?php echo $this->get_field_id('posts_per_row'); ?>" name="<?php echo $this->get_field_name('posts_per_row'); ?>" class="pct_69">
					<?php   
						if ( $posts_per_row == 'twelve' ) // Make default first in list
                        	echo "\n\t<option selected='twelve' value='posts'>One</option>";
                       	else
                          	echo "\n\t<option value='twelve'>One</option>";
                      	if ( $posts_per_row == 'six' ) // Make default first in list
                        	echo "\n\t<option selected='selected' value='six'>Two</option>";
                       	else
                         	echo "\n\t<option value='six'>Two</option>";
						if ( $posts_per_row == 'four' ) // Make default first in list
                        	echo "\n\t<option selected='selected' value='four'>Three</option>";
                       	else
                         	echo "\n\t<option value='four'>Three</option>";	
                    ?>
              	</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('prk_filter'); ?>"><?php _e('Filter (optional)', 'samba_lang'); ?>:</label><br />
				<input id="<?php echo $this->get_field_id('prk_filter'); ?>" name="<?php echo $this->get_field_name('prk_filter'); ?>" value="<?php echo $prk_filter; ?>" class="pct_89" />
				<br />
				<span class="description">Use category or skills slug (comma separated)</span>
			</p>
            <p>
				<label for="<?php echo $this->get_field_id( 'num_items' ); ?>">Number of entries:</label>
				<input id="<?php echo $this->get_field_id( 'num_items' ); ?>" name="<?php echo $this->get_field_name( 'num_items' ); ?>" value="<?php echo $num_items; ?>" class="pct_89" />
			</p>
			<?php
			
		}
	}
?>