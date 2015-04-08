<?php
	get_header();  
	if ($prk_samba_frontend_options['archives_ptype']=="multisize")
	{
	global $retina_device;
	$retina_flag = $retina_device === "prk_retina" ? true : false;
	$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
	$show_title=true;
	$default_margin=0;
	$samba_show_filter=false;
	$ajax_single_layout="";
	$cols_number="variable";
	if (isset($data['alchemy_th_margin']) && $data['alchemy_th_margin']!="")
		$default_margin=$data['alchemy_th_margin'];
	if (isset($data['alchemy_show_skills']) && $data['alchemy_show_skills']!="")
		$samba_show_skills=true;
	else 
		$samba_show_skills=false;
	if (isset($data['alchemy_show_filter']) && $data['alchemy_show_filter']!="")
		$samba_show_filter=true;
	if (isset($data['alchemy_cols_number']) && $data['alchemy_cols_number']!="")
		$cols_number=$data['alchemy_cols_number'];
	if (isset($data['alchemy_show_title']) && $data['alchemy_show_title']=="yes")
        $show_title=true;
	$posts_nr=$prk_samba_frontend_options['samba_posts_nr'];
	if (isset($data['alchemy_posts_nr']) && $data['alchemy_posts_nr']!="")
		$posts_nr=$data['alchemy_posts_nr'];
	if (isset($data['alchemy_posts_display']))
		$ajax_single_layout=$data['alchemy_posts_display'];
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');	
	}
?>
<div id="centered_block"> 
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
	<div id="headings_wrap" class="bd_headings_text_shadow zero_color folio_skills">
		<div class="prk_inner_block centered twelve columns">
            <div class="single_page_title twelve columns">
                <h1 class="header_font">
                	<?php single_cat_title(); ?>			                	
                </h1>
    		</div>
			<div class="clearfix"></div>
        </div>
	</div>
    <?php
		if ($ajax_single_layout!="")
		{
			$extra_class="";
			if ($ajax_single_layout=="half")
				echo '<div class="clearfix bt_40"></div>';
			else
				$extra_class=" wided_ld";
			?>
			<div id="prk_ajax_container_folio" data-ajax_path="<?php echo get_template_directory_uri() ?>/inc/ajax-handler.php"  data-ajax_layout="<?php echo $ajax_single_layout; ?>" data-retina="<?php echo $retina_device; ?>" data-color="">
				
			</div>
			<div id="aj_loader_wrapper" class="twelve extra_pad columns prk_inner_block centered"> 
				<div class="project_ajax_loader">
	            	<div class="spinner"><div class="spinner-icon"></div></div>
	            </div>
	            <div class="simple_line blog_divider"></div>
		    </div>
			<?php
		}
	?>
    <div id="content">
      	<div id="main" class="main_no_sections prk_more_space">
      			<div class="row prk_row">
      		<div id="folio_father">
			<?php 
				$make_lbox="no";
				$mini_sliders="no";
				 $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
						$my_query = new WP_Query();
						$args = array( 	'post_type' => 'pirenko_portfolios', 
										'portfolio_tag'=>$term->slug,
										'posts_per_page'=>999
									);
						$my_query->query($args);
		        if ($my_query->have_posts()) : 
						$ins=0;
						echo "<div id='magner'><div id='d_magner'><div id=\"folio_masonry\" class=\"iso_folio\" data-columns='".$cols_number."' data-margin=".$default_margin.">";
							while ($my_query->have_posts()) : $my_query->the_post();
								$data = get_post_meta( $post->ID, '_custom_meta', true );
				                  if (isset($data['featured_color']) && $data['featured_color']!="")
				                  {
				                    $featured_color=$data['featured_color'];
				                    $featured_class="featured_color ";
				                  }
				                  else
				                  {
				                    $featured_color="default";
				                    $featured_class="";
				                  }
								$skills_links="";
								$skills_names="";
								$skills_yo="";
								$skills_output="";
								$terms = get_the_terms ($post->ID, 'pirenko_skills');
								if (!empty($terms))
								{
									foreach ($terms as $term) {
										$skills_links[] = $term->slug;
										$skills_names[] = $term->name;
										}
								
									$skills_yo = join(" ", $skills_links);
									$skills_output = join(", ", $skills_names);
								}
							?>
						<div id="post-<?php the_ID(); ?>" class="<?php echo $featured_class; ?>boxed_shadow portfolio_entry_li <?php echo $skills_yo; ?> p_all" data-id="id-<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
							<?php 
							if (has_post_thumbnail( $post->ID ) ):
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$magnific_image[0]=$image[0] = get_image_path($image[0]);
							else :
								//THERE'S NO FEATURED IMAGE
							endif; 
							$meta = get_post_meta( $post->ID, 'key', true );
							global $simple_mb;
							$data=$simple_mb->the_meta();
							if (!isset($data['skip_featured']))
								$data['skip_featured']=0;
							$hide_second=false;
							if ($data['skip_featured']==1)
							{
								//CHECK IF THERE'S A SECOND IMAGE
								if (isset($data['image_2']) &&  $data['image_2']!="")
								{
									//CHECK IF IT'S AN IMAGE OR A VIDEO
									if (prk_external_content($data['image_2'])=="other") {
										$magnific_image[0]=$data['image_2'];
										$hide_second=true;
									}
								}
							}
							if (!isset($data['skip_to_external']))
								$data['skip_to_external']=0;
							if ($data['skip_to_external']==1)
							{
								//CHECK IF PROJECT URL IS SET
								if (!isset($data['ext_url']))
									$data['ext_url']=get_permalink();
								//ADD HTTP PREFIX IF NEEDED
								if (substr($data['ext_url'],0,7)!="http://")
									$data['ext_url']="http://".$data['ext_url'];
								$href_val=$data['ext_url'];
							}
							else
							{
								if ($make_lbox=="no" || $mini_sliders=="yes")
								{
									$href_val=get_permalink();
								}
								else
								{
									$href_val=$magnific_image[0];
								}
							}
							?>
						
                            <div class="grid_image_wrapper boxed_shadow">
								<?php 
									if ($make_lbox!="yes" && $mini_sliders=="no")
									{
										?>
										<div class="prk_magnificent body_bk_color" data-mfp-src="<?php echo $magnific_image[0]; ?>">
											<div class="navicon-expand-2"></div>
										</div>
										<?php
									}
									if ($make_lbox!="yes" && $mini_sliders=="yes")
									{
										?>
										<div class="prk_magnificent_li prk_magnificent_li_outer body_bk_color" data-mfp-src="<?php echo $magnific_image[0]; ?>">
											<div class="navicon-expand-2"></div>
										</div>
									<?php
									}
								?>
                            	<a href="<?php echo $href_val; ?>" class="<?php if ($make_lbox=="yes" && $mini_sliders=="no"){echo 'magna_a';} else { if ($ajax_single_layout!=""){echo "prk_trigger_ajax";} else { echo "fade_anchor"; } } ?>" data-ajax_id="<?php the_ID(); ?>" data-ajax_order="<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
                                <div id="grid_title-<?php the_ID(); ?>" class="grid_single_title">
                                    <div class="prk_ttl">
                                    	<h4 class="header_font body_bk_color body_bk_text_shadow big"><?php the_title(); ?></h4>
                                    </div>
									<?php 
										if ($skills_output!="" && $samba_show_skills==true)
										{
											?>
											<div class="inner_skills body_bk_color">
												<?php echo $skills_output; ?>
											</div>
											<?php
										}
                                    ?>
                                </div><!-- grid_single_title -->
                                <?php $data = get_post_meta( $post->ID, '_custom_meta', true );
								if (!isset($data['skip_featured']))
									$data['skip_featured']=0;
								
								?>
                                	<div class="grid_colored_block">
									</div>
									<?php 
                                    if (has_post_thumbnail( $post->ID ) )
                                    {
										if (!isset($data['featured_thumb']))
											$data['featured_thumb']=0;
										if ($cols_number=="variable")
										{
											$forced_w=480;
										}
										else
										{
											$forced_w=round($prk_samba_frontend_options['custom_width']/$cols_number);
										}
										if ($forced_w<round($prk_samba_frontend_options['custom_width']/2))
                                			$forced_w=round($prk_samba_frontend_options['custom_width']/2);//BECAUSE OF RESPONSIVE 2 COLS
										//DOUBLE SIZE THUMB?
										if ($data['featured_thumb']==0)
										{
											$forced_h=round($forced_w/1.6);
											$vt_image = vt_resize( '', $image[0] ,$forced_w ,$forced_h , true , $retina_flag );
											?>
											<div id="tiny_slider-<?php echo $post->ID;?>" <?php if ($mini_sliders=="yes"){echo 'class="tiny_slider per_init"';} ?>>
												<ul class="slides">
													<li>
														<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" data-featured="no" />
													</li>
											<?php
										}
										else
										{
											$forced_h=round($forced_w/1.6)*2+$default_margin+1;//+1 IS FOR ODD MARGINS
											$vt_image = vt_resize( '', $image[0] ,$forced_w ,$forced_h , true , $retina_flag );
											?>
											<div id="tiny_slider-<?php echo $post->ID;?>" <?php if ($mini_sliders=="yes"){echo 'class="tiny_slider per_init"';} ?>>
											<ul class="slides">
												<li>
													<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" data-featured="yes" />
												
											<?php
										}
										if ($mini_sliders=="yes") 
										{
											//PLACE THE OTHER NINETEEN IMAGES
	                                        for ($count=2;$count<21;$count++)
	                                        {
	                                            if (isset($data['image_'.$count]) && $data['image_'.$count]!="")
	                                            {
                                                    if (prk_external_content($data['image_'.$count])=="other")
                                                    {
                                                    	echo "</li>";
                                                    	echo "<li>";
                                                   		$vt_image = vt_resize( '', $data['image_'.$count] , $forced_w, $forced_h, true , $retina_flag );
                                                    	echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" class="grid_image" />';
	                                                    if ($count==2 && $hide_second==true) 
	                                                    {

	                                                    }
	                                                	else
	                                                	{
	                                                    	echo '<div class="prk_magnificent_li" data-mfp-src="'.$data['image_'.$count].'"></div>';
	                                                    }
	                                                }
	                                                else
	                                                {
	                                                	echo '<div class="prk_magnificent_li body_bk_color mfp-iframe" data-mfp-src="'.get_iframe_src($data['image_'.$count]).'">';
                                                        echo '<div class="navicon-expand-2"></div>';
                                                        echo '</div>';
	                                                }
	                                               
	                                            }
	                                        }
	                                        }
										?>
										</li>
		                                	</ul>
		                                </div>
											<?php
                                    }
                                    ?>
                                
                                <!-- FOR IE 10 NO DISPLAY BUG -->
                                <img src="<?php echo $vt_image['url']; ?>" class="hide_now" alt="<?php echo prk_get_img_alt($image[0]); ?>" />
                                </a>
                            </div>
							</div>
						<?php $ins++; ?>
					<?php 
						endwhile; 
						echo "</div></div></div>";
					endif; 
        ?>
    </div>
</div>
	</div>
</div>
</div>
    <?php
	}//GRID



	if ($prk_samba_frontend_options['archives_ptype']=="titled")
	{
    global $retina_device;
	$retina_flag = $retina_device === "prk_retina" ? true : false;
	$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
	$default_margin=20;
	$samba_show_filter=false;
	$ajax_single_layout="";
	$cols_number="variable";
	$samba_show_skills=true;
	$samba_show_excerpt=false;
	$posts_nr=$prk_samba_frontend_options['samba_posts_nr'];
	if (isset($data['alchemy_posts_nr']) && $data['alchemy_posts_nr']!="")
		$posts_nr=$data['alchemy_posts_nr'];
	if (isset($data['alchemy_posts_display']))
		$ajax_single_layout=$data['alchemy_posts_display'];
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE) {
		include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');	
	}
?>
<div id="centered_block"> 
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
	<div id="headings_wrap" class="bd_headings_text_shadow zero_color folio_skills">
		<div class="prk_inner_block centered twelve columns">
            <div class="single_page_title twelve columns">
                <h1 class="header_font">
                	<?php single_cat_title(); ?>			                	
                </h1>
    		</div>
			<div class="clearfix"></div>
        </div>
	</div>
	<?php
        if ($ajax_single_layout!="")
		{
			$extra_class="";
			?>
			
			<div id="prk_ajax_container_folio" data-ajax_path="<?php echo get_template_directory_uri() ?>/inc/ajax-handler.php"  data-ajax_layout="<?php echo $ajax_single_layout; ?>" data-retina="<?php echo $retina_device; ?>" data-color="">
				
			</div>
			<div id="aj_loader_wrapper" class="twelve extra_pad columns prk_inner_block centered"> 
				<div class="project_ajax_loader">
	            	<div class="spinner"><div class="spinner-icon"></div></div>
	            </div>
	            <div class="simple_line blog_divider"></div>
		    </div>
			<?php
		}
    ?>
    <div id="content">
      	<div id="main" class="main_no_sections prk_more_space">
      			<div class="row prk_row">
      		<div id="folio_father">
			<?php 
				$make_lbox="no";
				$mini_sliders="no";
				$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
				if (!empty($data))
				{
					if (isset($data['alchemy_lbox']) && $data['alchemy_lbox']=="yes")
					{
						$make_lbox="yes";
					}
					if (isset($data['mini_sliders']) && $data['mini_sliders']=="yes")
					{
						$mini_sliders="yes";
					}
				}
				 $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		                $make_lbox="no";
						$my_query = new WP_Query();
						$args = array( 	'post_type' => 'pirenko_portfolios', 
										'portfolio_tag'=>$term->slug,
										'posts_per_page'=>999
									);
						$my_query->query($args);
        if ($my_query->have_posts()) :
        	$ins=0;
						echo "<div id='magner'><div id='d_magner'><div id=\"folio_titled\" class=\"iso_folio\" data-columns='".$cols_number."' data-margin=".$default_margin.">";
							while ($my_query->have_posts()) : $my_query->the_post();
								$data = get_post_meta( $post->ID, '_custom_meta', true );
								if (isset($data['featured_color']) && $data['featured_color']!="")
								{
									$featured_color=$data['featured_color'];
									$featured_class="featured_color ";
								}
								else
								{
									$featured_color="default";
									$featured_class="";
								}
								$skills_links="";
								$skills_names="";
								$skills_yo="";
								$skills_output="";
								$terms = get_the_terms ($post->ID, 'pirenko_skills');
								if (!empty($terms))
								{
									foreach ($terms as $term) {
										$skills_links[] = $term->slug;
										$skills_names[] = $term->name;
										}
								
									$skills_yo = join(" ", $skills_links);
									$skills_output = join(", ", $skills_names);
								}
							?>
						<div id="post-<?php the_ID(); ?>" class="<?php echo $featured_class; ?>portfolio_entry_li zero_shadow <?php echo $skills_yo; ?> p_all" data-id="id-<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
							<?php 
							if (has_post_thumbnail( $post->ID ) ):
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$magnific_image[0]=$image[0] = get_image_path($image[0]);
							else :
								//THERE'S NO FEATURED IMAGE
							endif; 
							$meta = get_post_meta( $post->ID, 'key', true );
							global $simple_mb;
							$data=$simple_mb->the_meta();
							if (!isset($data['skip_featured']))
								$data['skip_featured']=0;
							$hide_second=false;
							if ($data['skip_featured']==1)
							{
								//CHECK IF THERE'S A SECOND IMAGE
								if (isset($data['image_2']) &&  $data['image_2']!="")
								{
									//CHECK IF IT'S AN IMAGE OR A VIDEO
									if (prk_external_content($data['image_2'])=="other") {
										$magnific_image[0]=$data['image_2'];
										$hide_second=true;
									}
								}
							}
							if (!isset($data['skip_to_external']))
								$data['skip_to_external']=0;
							if ($data['skip_to_external']==1)
							{
								//CHECK IF PROJECT URL IS SET
								if (!isset($data['ext_url']))
									$data['ext_url']=get_permalink();
								//ADD HTTP PREFIX IF NEEDED
								if (substr($data['ext_url'],0,7)!="http://")
									$data['ext_url']="http://".$data['ext_url'];
								$href_val=$data['ext_url'];
							}
							else
							{
								if ($make_lbox=="no" || $mini_sliders=="yes")
								{
									$href_val=get_permalink();
								}
								else
								{
									$href_val=$magnific_image[0];
								}
								if (!isset($data['skip_featured']))
									$data['skip_featured']=0;
							}
							?>
							<div class="grid_image_wrapper boxed_shadow">
								<?php 
									if ($make_lbox!="yes" && $mini_sliders=="no")
									{
										?>
										<div class="prk_magnificent body_bk_color" data-mfp-src="<?php echo $magnific_image[0]; ?>">
											<div class="navicon-expand-2"></div>
										</div>
										<?php
									}
									if ($make_lbox!="yes" && $mini_sliders=="yes")
									{
										?>
											<div class="prk_magnificent_li prk_magnificent_li_outer body_bk_color" data-mfp-src="<?php echo $magnific_image[0]; ?>">
											<div class="navicon-expand-2"></div>
										</div>
									<?php
									}
								?>
									<a href="<?php echo $href_val; ?>" class="<?php if ($make_lbox=="yes" && $mini_sliders=="no"){echo 'magna_a';} else { if ($ajax_single_layout!=""){echo "prk_trigger_ajax";} else { echo "fade_anchor"; } } ?>" data-ajax_id="<?php the_ID(); ?>" data-ajax_order="<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
                                	<div class="grid_colored_block">
									</div>
										<?php
											if (has_post_thumbnail( $post->ID ) )
			                                {
			                                	if ($cols_number=="variable")
												{
													$forced_w=480;
												}
												else
												{
													$forced_w=round($prk_samba_frontend_options['custom_width']/$cols_number);
												}
												if ($forced_w<round($prk_samba_frontend_options['custom_width']/2))
		                                			$forced_w=round($prk_samba_frontend_options['custom_width']/2);//BECAUSE OF RESPONSIVE 2 COLS
		                                		$forced_h=round($forced_w/1.6);
												$vt_image = vt_resize( '', $image[0] , $forced_w, $forced_h, true , $retina_flag );
											?>
											<div id="tiny_slider-<?php echo $post->ID;?>" <?php if ($mini_sliders=="yes"){echo 'class="tiny_slider per_init"';} ?>>
											<ul class="slides">
											<li>
												<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" alt="<?php echo prk_get_img_alt($image[0]); ?>" />
											<?php
												if ($mini_sliders=="yes") 
												{
													//PLACE THE OTHER NINETEEN IMAGES
			                                        for ($count=2;$count<21;$count++)
			                                        {
			                                            if (isset($data['image_'.$count]) && $data['image_'.$count]!="")
			                                            {
                                                            if (prk_external_content($data['image_'.$count])=="other")
                                                            {
                                                            	echo "</li>";
                                                            	echo "<li>";
                                                           		$vt_image = vt_resize( '', $data['image_'.$count] , $forced_w, $forced_h, true , $retina_flag );
                                                            	echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" class="grid_image" />';
			                                                    if ($count==2 && $hide_second==true) 
			                                                    {

			                                                    }
			                                                	else
			                                                	{
			                                                    	echo '<div class="prk_magnificent_li" data-mfp-src="'.$data['image_'.$count].'"></div>';
			                                                    }
			                                                }
			                                                else
			                                                {
			                                                	echo '<div class="prk_magnificent_li body_bk_color mfp-iframe" data-mfp-src="'.get_iframe_src($data['image_'.$count]).'">';
                                                                echo '<div class="navicon-expand-2"></div>';
                                                                echo '</div>';
			                                                } 
			                                            }
			                                        }
			                                    }
		                                    ?>
		                                		</li>
											</ul>
										</div>
											<?php
		                                }
		                            ?>
                                <!-- FOR IE 10 NO DISPLAY BUG -->
                                <img src="<?php echo $vt_image['url']; ?>" class="hide_now" alt="<?php echo prk_get_img_alt($image[0]); ?>" />
                                </a>
</div>
                                <div class="titled_block<?php if ($samba_show_excerpt==true) {echo " width_exc";} if ($samba_show_skills==false) {echo " fifte";} ?>" >
                                    <div class="grid_single_title" id="grid_title-<?php the_ID(); ?>">
                                    	<div class="zero_color bd_headings_text_shadow">
	                                        <a href="<?php echo $href_val; ?>" class="<?php if ($make_lbox=="yes" && $mini_sliders=="no"){echo 'magna_b';} else { if ($ajax_single_layout!=""){echo "prk_trigger_ajax";} else { echo "fade_anchor"; } } ?>" data-ajax_id="<?php the_ID(); ?>" data-ajax_order="<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
	                                        	<h4 class="header_font"><?php the_title(); ?></h4>
	                                       	</a>
                                       	</div>
                                        <?php 
											if ($skills_output!="" && $samba_show_skills==true)
											{
												echo "<div class='tiny_line' data-color='".$featured_color."'></div>";
												?>
												<div class="inner_skills fade_anchor <?php if ($samba_show_excerpt==true) {echo "zero_color";}else{echo "default_color";} ?>">
													<?php echo " ".get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
												</div>
												<?php
												
											}
											if ($samba_show_excerpt==true) {
												echo "<div class='titled_exc regular_font'>";
												echo the_excerpt_dynamic(100);
												echo "</div>";
											}

                                        ?>
                                    </div><!-- grid_single_title -->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>

							</div>
						<?php $ins++; ?>
					<?php 
						endwhile; 
						echo "</div></div></div>";
					 endif; 
        			?>
				</div>
      		</div>
		</div>
	</div>
</div>
        <?php
	}//TITLED


	if ($prk_samba_frontend_options['archives_ptype']=="masonry")
	{
    global $retina_device;
	$retina_flag = $retina_device === "prk_retina" ? true : false;
	$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
	$show_title=false;
	$default_margin=10;
	$samba_show_filter=false;
	$ajax_single_layout="";
	$cols_number="variable";
	$samba_show_skills=true;
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');	
	}
?>
<div id="centered_block"> 
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
	<div id="headings_wrap" class="bd_headings_text_shadow zero_color folio_skills">
		<div class="prk_inner_block centered twelve columns">
            <div class="single_page_title twelve columns">
                <h1 class="header_font">
                	<?php single_cat_title(); ?>			                	
                </h1>
    		</div>
			<div class="clearfix"></div>
        </div>
	</div>
    <div id="content">
      	<div id="main" class="main_no_sections prk_more_space">
      			<div class="row prk_row">
      		<div id="folio_father">
			<?php 
				$make_lbox="no";
				$mini_sliders="no";
				 $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		                $make_lbox="no";
						$my_query = new WP_Query();
						$args = array( 	'post_type' => 'pirenko_portfolios', 
										'portfolio_tag'=>$term->slug,
										'posts_per_page'=>999
									);
						$my_query->query($args);
        				if ($my_query->have_posts()) : 
        					$ins=0;
						echo "<div id='magner'><div id='d_magner'><div id=\"folio_masonry\" class=\"iso_folio\" data-columns='".$cols_number."' data-margin=".$default_margin.">";
							while ($my_query->have_posts()) : $my_query->the_post();
								$data = get_post_meta( $post->ID, '_custom_meta', true );
								if (isset($data['featured_color']) && $data['featured_color']!="")
								{
									$featured_color=$data['featured_color'];
									$featured_class="featured_color ";
								}
								else
								{
									$featured_color="default";
									$featured_class="";
								}
								$skills_links="";
								$skills_names="";
								$skills_yo="";
								$skills_output="";
								$terms = get_the_terms ($post->ID, 'pirenko_skills');
								if (!empty($terms))
								{
									foreach ($terms as $term) {
										$skills_links[] = $term->slug;
										$skills_names[] = $term->name;
										}
								
									$skills_yo = join(" ", $skills_links);
									$skills_output = join(", ", $skills_names);
								}
							?>
						<div id="post-<?php the_ID(); ?>" class="<?php echo $featured_class; ?>boxed_shadow portfolio_entry_li <?php echo $skills_yo; ?> p_all" data-id="id-<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
							<?php 
							if (has_post_thumbnail( $post->ID ) ):
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$magnific_image[0]=$image[0] = get_image_path($image[0]);
							else :
								//THERE'S NO FEATURED IMAGE
							endif; 
							$meta = get_post_meta( $post->ID, 'key', true );
							global $simple_mb;
							$extra_mfp="";
							$data=$simple_mb->the_meta();
							if (!isset($data['skip_featured']))
								$data['skip_featured']=0;
							if ($data['skip_featured']==1)
							{
								//CHECK IF THERE'S A SECOND IMAGE
								if (isset($data['image_2']) &&  $data['image_2']!="")
								{
									$magnific_image[0]=$data['image_2'];
									//CHECK IF IT'S AN IMAGE OR A VIDEO
									if (prk_external_content($data['image_2'])!="other") {
										$extra_mfp=" mfp-iframe";
									}
								}
							}
							if (!isset($data['skip_to_external']))
								$data['skip_to_external']=0;
							if ($data['skip_to_external']==1)
							{
								//CHECK IF PROJECT URL IS SET
								if (!isset($data['ext_url']))
									$data['ext_url']=get_permalink();
								//ADD HTTP PREFIX IF NEEDED
								if (substr($data['ext_url'],0,7)!="http://")
									$data['ext_url']="http://".$data['ext_url'];
								$href_val=$data['ext_url'];
							}
							else
							{
								if ($make_lbox=="no")
								{
									$href_val=get_permalink();
								}
								else
								{
									$href_val=$magnific_image[0];
								}
							}
							?>
						
                            <div class="grid_image_wrapper boxed_shadow">
								<?php 
									if ($make_lbox!="yes")
									{
										?>
		                            	<div class="prk_magnificent body_bk_color<?php echo $extra_mfp; ?>" data-mfp-src="<?php echo $magnific_image[0]; ?>">
											<div class="navicon-expand-2"></div>
										</div>
										<?php
									}
								?>
                            	<a href="<?php echo $href_val; ?>" class="<?php if ($make_lbox=="yes"){echo 'magna_a';} else { if ($ajax_single_layout!=""){echo "prk_trigger_ajax";} else { echo "fade_anchor"; } } ?>" data-ajax_id="<?php the_ID(); ?>" data-ajax_order="<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
                                	<?php 
                                		if ($make_lbox=="yes")
										{
											?>
			                            	<div class="prk_magnificent_disabled body_bk_color">
												<div class="navicon-expand-2"></div>
											</div>
											<?php
										}
									?>
                                	<div id="grid_title-<?php the_ID(); ?>" class="grid_single_title">
                                    <div class="prk_ttl">
                                    	<h4 class="header_font body_bk_color body_bk_text_shadow big"><?php the_title(); ?></h4>
                                    </div>
									<?php 
										if ($skills_output!="" && $samba_show_skills==true)
										{
											?>
											<div class="inner_skills body_bk_color">
												<?php echo $skills_output; ?>
											</div>
											<?php
										}
                                    ?>
                                </div><!-- grid_single_title -->
                                <?php $data = get_post_meta( $post->ID, '_custom_meta', true );
								if (!isset($data['skip_featured']))
									$data['skip_featured']=0;
								
								?>
                                	<div class="grid_colored_block">
									</div>
									<?php 
                                    if (has_post_thumbnail( $post->ID ) )
                                    {
										if (!isset($data['featured_thumb']))
											$data['featured_thumb']=0;
										if ($cols_number=="variable")
										{
											$forced_w=480;
										}
										else
										{
											$forced_w=round($prk_samba_frontend_options['custom_width']/$cols_number);
										}
										$forced_h='';
										if ($data['featured_thumb']==0)
										{
											$vt_image = vt_resize( '', $image[0] ,$forced_w ,$forced_h , false , $retina_flag );
											?>
											<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" data-featured="no" />
											<?php
										}
										else
										{
											$vt_image = vt_resize( '', $image[0] ,$forced_w ,$forced_h , false , $retina_flag );
											?>
											<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" data-featured="yes" />
											<?php
										}	
                                    }
                                    ?>
                                
                                <!-- FOR IE 10 NO DISPLAY BUG -->
                                <img src="<?php echo $vt_image['url']; ?>" class="hide_now" />
                                </a>
                                </div>
							</div>
						<?php $ins++; ?>
					<?php 
						endwhile; 
						echo "</div></div></div>";
				 endif; 
        ?>
    </div>
</div>
	</div>
</div>
</div>
        <?php
	}//MASONRY
	?>
<?php get_footer(); ?>