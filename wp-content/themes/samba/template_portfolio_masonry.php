<?php 
/*
Template Name: Portfolio - Masonry
*/
?>
<?php 
	get_header(); 
	global $retina_device;
	$retina_flag = $retina_device === "prk_retina" ? true : false;
	$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
	$show_title=false;
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
	//ADD PROTECTED GALLERIES FEATURE
	if ( !post_password_required() ) 
	{
?>
<div id="centered_block"> 
<div id="main_block" class="clearfix fff_folio page-<?php echo get_the_ID(); ?>">
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
	<?php
       $extra_space="";
        if ($show_title==true)
        {
            prk_output_title($data);
            $extra_space=" prk_more_space";
        }
    ?>
    <div id="content">
      	<div id="main" class="main_no_sections<?php echo $extra_space; ?>">
      			<div class="prk_row">
      		<div id="folio_father">
			<?php 
                while (have_posts()) : the_post();
                if (get_the_content()!="")
                {
                	echo "<div id='folio_content' class='twelve columns'>";
                	echo "<div class='twelve columns'>";
                    	the_content();
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='clearfix'></div>";
                }
                endwhile;
	            if ($samba_show_filter==true)
				{
					?>
		            <div id="filter_top">
		                <?php
						if (!isset($prk_translations['all_text']))
							$prk_translations['all_text']='All';
						$inside_filter="";
						if (!empty($data))
						{
							$cats_counter=0;
							$in_flag=false;
							foreach ($data as $childs)
							{
								//ADD THE CATEGORIES TO THE FILTER
								if ($in_flag==true)
								{
									$inside_filter.=$childs.", ";
									$cats_counter++;
								}
								if ($childs=='weirdostf')
				                {
				                  	$in_flag=true;
				                }
							}
							if ($cats_counter>=1)
							{
								?>
                                <div id="pir_categories" class="cf">
                                    <ul class="filter">
                                        <li class="active">
                                            <a class="all" data-filter="p_all" href="javascript:void(0)"><?php echo $prk_translations['all_text']; ?></a>
                                        </li>
										<?php
											$helper=0;
											foreach ($data as $key=>$childs)
											{
												if ($helper>0)
												{
													$arra=get_term_by('slug', $childs, 'pirenko_skills');
													echo '<li><a class="'.$childs.'" data-filter="'.$childs.'" href="javascript:void(0)">'.$arra->name.'</a></li>';
												}
												if ($key=='helper_fk')
													$helper++;
											}
                                        ?>
                               		</ul>
                                </div><!--pir_categories-->
                                <?php
							}
							else
							{
								?>
								<div id="pir_categories" class="cf">
									<?php 
										$terms = get_terms("pirenko_skills");
										$count = count($terms);
										if ( $count > 0 )
										{
											?>
											<ul class="filter">
												<li class="active">
													<a class="all" data-filter="p_all" href="javascript:void(0)"><?php echo $prk_translations['all_text']; ?></a>
												</li>
											<?php
											foreach ( $terms as $term ) 
											{
												echo '<li><a class="'.$term->slug.'" data-filter="'.$term->slug.'" href="javascript:void(0)">'.$term->name.'</a></li>';
											}
											echo "</ul>";
										}
									?>
								</div><!--pir_categories-->
								<?php
							}
						}
					?>
	                </div>
	                <div class="clearfix bt_50"></div>
	            	<?php
	            }
				$inside_filter="";
				$make_lbox="no";
				$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
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
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if (get_query_var('page')!="")
			$paged=get_query_var('page');
		$args = array( 
			'post_type' => 'pirenko_portfolios', 
			'paged' => $paged,
			'posts_per_page' => $posts_nr,
			'pirenko_skills'=>$inside_filter
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
		                            	<div class="prk_magnificent body_bk_color<?php echo $extra_mfp; ?>" data-mfp-src="<?php echo esc_attr($magnific_image[0]); ?>">
											<div class="navicon-expand-2"></div>
										</div>
										<?php
									}
								?>
                            	<a href="<?php echo $href_val; ?>" class="<?php if ($make_lbox=="yes"){echo 'magna_a';echo $extra_mfp;} else { if ($ajax_single_layout!=""){echo "prk_trigger_ajax";} else { if ($data['skip_to_external']==0) {echo "fade_anchor";}}} ?>" data-ajax_id="<?php the_ID(); ?>" data-ajax_order="<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
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
											if ($forced_w<round($prk_samba_frontend_options['custom_width']/2))
											{	
                                				$forced_w=round($prk_samba_frontend_options['custom_width']/2);//BECAUSE OF RESPONSIVE 2 COLS
                                			}
										}
										$forced_h='';
										if ($data['featured_thumb']==0)
										{
											$vt_image = vt_resize( '', $image[0] ,$forced_w ,$forced_h , false , $retina_flag );
											?>
											<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" data-featured="no" alt="<?php echo prk_get_img_alt($image[0]); ?>" />
											<?php
										}
										else
										{
											$vt_image = vt_resize( '', $image[0] ,$forced_w ,$forced_h , false , $retina_flag );
											?>
											<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" data-featured="yes" alt="<?php echo prk_get_img_alt($image[0]); ?>" />
											<?php
										}	
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
						//SHOW BUTTON TO SHOW MORE POSTS ONLY IF NEEDED
						if ($paged!=$my_query->max_num_pages) {
							?>
							<div class="clearfix"></div>
							<div id="next_portfolio_masonry">
								<div class="simple_line blog_divider"></div>
								<div class="navigation twelve">	
									<div class="next-posts">
										<div id="nbr_helper" data-pir_curr="<?php echo $paged; ?>" data-pir_max="<?php echo $my_query->max_num_pages; ?>">
											<div id="pages_static_nav" class="theme_button">
				                                <a href="#">
				                                        <?php echo($prk_translations['load_more']); ?> 
				                                </a>
				                                <div class="clearfix"></div>
				                            </div>
				                            <div id="pir_loader_wrapper" class="cf">
				                                <div class="spinner"><div class="spinner-icon"></div></div>
				                            </div>
				                            <div class="nx_lnk_wp">
				                                <?php next_posts_link('',$my_query->max_num_pages); ?>
				                            </div>
										</div>
									</div>
								</div><!-- navigation -->
							</div><!-- entries_navigation -->
							<div class="clearfix"></div>
							<div id="no_more" class="header_font">
								<div class="simple_line blog_divider"></div>
			                    <div id="in_no_more" class="header_font"><?php echo($prk_translations['no_more_text']); ?></div>
			                    <div class="clearfix"></div>
			                </div>
							<?php
						}
				 endif; 
        ?>
    </div>
</div>
	</div>
</div>
</div>
</div>
<?php
}//PROTECTED GALLERY
else
{
	echo '<div id="centered_block" class="prk_inner_block columns centered"><div id="main_block">';
		while (have_posts()) : the_post();
	    	the_content();   
	    endwhile;
	if (INJECT_STYLE) {
		echo '<div class="clearfix"></div><p></p><p>For testing use this password: pass</p>';
	}
    echo '</div></div>';
}
get_footer(); ?>