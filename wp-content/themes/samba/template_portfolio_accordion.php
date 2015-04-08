<?php 
/*
Template Name: Portfolio - Carousel
*/
?>
<?php 
	get_header(); 
	global $retina_device;
	$retina_flag = $retina_device === "prk_retina" ? true : false;
	$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
	$cols_number="5";
	if (isset($data['alchemy_show_skills']) && $data['alchemy_show_skills']!="")
		$samba_show_skills=true;
	else 
		$samba_show_skills=false;
	if (isset($data['alchemy_cols_number']) && $data['alchemy_cols_number']!="")
		$cols_number=$data['alchemy_cols_number'];
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include_once(ABSPATH . 'wp-content/plugins/color-manager-samba/style_header.php');	
	}
	//ADD PROTECTED GALLERIES FEATURE
	if ( !post_password_required() ) 
	{
?>
<div id="centered_block"> 
<div id="main_block" class="row fff_folio page-<?php echo get_the_ID(); ?>">
    <div id="content">
      	<div id="main" class="main_no_sections">
      		<div id="folio_father" class="columns twelve with_accordion">
			<?php
				$inside_filter="";
				$make_lbox="no";
				$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
				if (!isset($data['alchemy_acc_look']))
					$layout="samba_opener";
				else
					$layout=$data['alchemy_acc_look'];
				if (!empty($data))
				{
					$in_flag=false;
					foreach ($data as $childs)
					{
						//ADD THE CATEGORIES TO THE FILTER
						if ($in_flag==true)
						{
							$inside_filter.=$childs.", ";
						}
						if ($childs=='weirdostf')
		                {
		                  	$in_flag=true;
		                }
					}
					if (isset($data['alchemy_lbox']) && $data['alchemy_lbox']=="yes")
					{
						$make_lbox="yes";
					}
				}
			?>
		<?php
		$my_query = new WP_Query();
		$args = array( 
			'post_type' => 'pirenko_portfolios', 
			'posts_per_page' => 999,
			//'orderby'        => 'rand',
			'pirenko_skills'=>$inside_filter
			);
		$my_query->query($args);
    	if ($my_query->have_posts()) :
    		$ins=0;
    		if ($layout=="prk_no_open") {
				echo "<div id='folio_carousel' class='prk_no_open accordion-slider' data-columns='".$cols_number."'>";
					echo "<div class='as-panels'>";
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
						if (has_post_thumbnail( $post->ID ) ) {
							?>
							<div id="prk_panel-<?php echo $ins; ?>" class="as-panel" data-id="id-<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
								<div class="prk-panel">
								<?php 
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$magnific_image[0]=$image[0] = get_image_path($image[0]);
							
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
									$go_out="prk_ext_link";
								}
								else
								{
									$href_val=get_permalink();
									$go_out="fade_anchor";
								}
								$vt_image = vt_resize( get_post_thumbnail_id( $post->ID ), '' , 1920, 1200, false , $retina_flag);
							?>
	                            <a href="<?php echo $href_val; ?>" class="prk_panel_lnk <?php echo $go_out; if ($make_lbox=="yes"){echo ' magna_a';echo $vid_cl;} ?>" data-mfp-src="<?php echo $image[0]; ?>">
									<img class="as-background" src="<?php echo $vt_image['url']; ?>" alt="" />
								</a>
								<div class="header_font as-layer as-closed as-prk-rotated" data-position="bottomLeft" data-horizontal="0px" data-vertical="54%" data-show-transition="up" data-show-duration="300" data-show-delay="500" data-hide-transition="fade">
							        <a href="<?php echo $href_val; ?>" class="gusto_mirror_link fade_anchor">
							        	<div class="as-prk_title as-layer as-padding small"><?php the_title(); ?></div>
							        </a>
							    </div>
							    <?php
								    if ($skills_output!="" && $samba_show_skills==true)
									{
										?>
										<div class="as-prk-inner">
											<div class="as-layer as-closed as-prk-line" data-position="topLeft" data-horizontal="0px" data-vertical="49%" data-show-transition="up" data-show-duration="300" data-show-delay="500">
												<div class='tiny_line' data-color='<?php echo $featured_color; ?>'></div>
											</div>
											<div class="as-layer as-closed as-prk-skills" data-position="topLeft" data-horizontal="0px" data-vertical="48%" data-show-transition="up" data-show-duration="300" data-show-delay="500">
												<h5 class="small">
												<?php echo " ".get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
												</h5>
											</div>
										</div>
										<?php
									}
								?>
                            </div>
						</div>
						<?php $ins++;
						}
				endwhile;
				echo "</div>";
				echo "</div>";
			}
			else {
				echo '<div id="folio_carousel" class="accordion-slider samba_opener" data-columns="'.$cols_number.'">';
				echo "<div class='as-panels'>";
					while ($my_query->have_posts()) : $my_query->the_post();
						$data = get_post_meta( $post->ID, '_custom_meta', true );
						if (isset($data['featured_color']) && $data['featured_color']!="")
					    {
					        $featured_color=$data['featured_color'];
					        $featured_class='featured_color';
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
						if (has_post_thumbnail( $post->ID))
						{
						?>
							<div id="prk_panel-<?php echo $ins; ?>" class="as-panel" data-id="id-<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
								<div class="prk-panel">
								<?php 
									//GET THE FEATURED IMAGE
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
									$magnific_image[0]=$image[0] = get_image_path($image[0]);
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
										$go_out="prk_ext_link";
									}
									else
									{
										$href_val=get_permalink();
										$go_out="fade_anchor";
									}
									$hide_second=false;
									$vid_cl="";
									$vt_image = vt_resize( '', $image[0] , 1820, 1200, false , $retina_flag);
								?>
								<a href="<?php echo $href_val; ?>" class="prk_panel_lnk <?php echo $go_out; if ($make_lbox=="yes"){echo ' magna_a';} echo $vid_cl; ?>" data-mfp-src="<?php echo $magnific_image[0]; ?>">
									<img class="as-background" src="<?php echo $vt_image['url']; ?>" alt="" />
								</a>
								<div class="header_font as-layer as-closed as-prk-rotated" data-position="bottomLeft" data-horizontal="20px" data-vertical="20px" data-show-transition="left" data-show-delay="300" data-hide-transition="right">
							        <h2 class="as-layer as-padding as-black small"><?php the_title(); ?></h2>
							    </div>
							    <div class="as-layer as-opened as-prk-bottom" data-width="96%" data-horizontal="2%" data-show-delay="700" data-vertical="100%">
							    	<div class="titled_block">
	                                    <div class="grid_single_title" id="grid_title-<?php the_ID(); ?>">
	                                        <a href="<?php echo $href_val; ?>" class="<?php echo $go_out; if ($make_lbox=="yes"){echo ' magna_b';} ?>" data-ajax_id="<?php the_ID(); ?>" data-ajax_order="<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>" data-mfp-src="<?php echo $image[0]; ?>">
	                                        	<h1 class="header_font"><?php the_title(); ?></h1>
	                                       	</a>
	                                        <?php
	                                        	$skills_class="";
												if ($skills_output!="" && $samba_show_skills==true)
												{
													?>
													<div class="clearfix"></div>
													<div class="inner_skills fade_anchor">
														<h5 class="small">
														<?php echo " ".get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
														</h5>
													</div>
													<?php
												}
												else {
													$skills_class=" samba_unskilled";
												}
												if ($prk_samba_frontend_options['show_heart_folio']=="yes")
				                                {
				                                    echo '<div class="prk_heart_carousel site_background_colored'.$skills_class.'">';
				                                    	echo get_folio_like(get_the_ID(),true);
				                                    echo '</div>';
				                                }
	                                        ?>
	                                        <div class="clearfix"></div>
	                                    </div>
	                                    <div class="clearfix"></div>
	                                </div>
							    </div>
								</div>
							</div>
							<?php $ins++; ?>
						<?php 
						}
							endwhile;
							echo "</div>";
							echo "</div>";
			}
				 endif; 
        ?>
    </div>
</div>
</div>
</div>
</div>
<?php
}//PROTECTED GALLERY
else
{
	echo '<div id="centered_block"><div id="main_block">';
		while (have_posts()) : the_post();
	    	the_content();   
	    endwhile;
	if (INJECT_STYLE) {
		echo '<div class="clearfix"></div><p></p><p>For testing use this password: pass</p>';
	}
    echo '</div></div>';
}
get_footer(); ?>