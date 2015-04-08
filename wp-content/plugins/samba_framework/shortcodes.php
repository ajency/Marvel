<?php
add_action( 'init', 'prk_samba_scodes' );


function prk_samba_scodes() {
	//SHORTCODES MANAGEMENT
	//SLIDERS
	function pirenko_sh_slider( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'category'  => '',
			'autoplay'	=> '',
			'delay'	=> '',
			'sl_size' => '',
			'hover' =>''
		), $atts));
		wp_reset_query();
		if ($category=="show_all")
			$category="";
		$args=array(	'post_type' => 'pirenko_slides',
						'showposts' => 99,
						'pirenko_slide_set' => $category
					);
		$loop = new WP_Query( $args );
		$out = '';
		$slide_number=0;
		if (!isset($autoplay) || $autoplay=="" || $autoplay=="yes")
			$autoplay="true";
		if (!isset($delay) || $delay=="")
			$delay="5500";
		if (!isset($sl_size) || $sl_size=="")
			$sl_size="";
		$id="prk_slider_". rand(1, 1000);
		$out.='	<div class="flexslider shortcode_slider boxed_shadow '.$sl_size.'" data-autoplay="'.$autoplay.'" data-delay="'.$delay.'" data-hover="'.$hover.'">
		<ul id="'.$id.'" class="slides">';
				while ( $loop->have_posts() ) : $loop->the_post();
				$data_slides = get_post_meta( get_the_ID(), '_custom_meta_slides', true );
				if (isset($data_slides['pirenko_sh_slide_txt']))
                	$use_txt = $data_slides['pirenko_sh_slide_txt'];
                else
                	$use_txt=1;
                if (isset($data_slides['pirenko_sh_slide_txt_size']))
                	$text_size = $data_slides['pirenko_sh_slide_txt_size'];
                else
                	$text_size="medium";
            	if (isset($data_slides['pirenko_sh_slide_txt_horz']))
                	$h_align = $data_slides['pirenko_sh_slide_txt_horz'];
               	else
               		$h_align="left";
            	if (isset($data_slides['pirenko_sh_slide_txt_vert']))
                	$v_align = $data_slides['pirenko_sh_slide_txt_vert'];
                else
                	$v_align="top";
                $pirenko_sh_slide_header_color="";
                if (isset($data_slides['pirenko_sh_slide_header_color']))
					$pirenko_sh_slide_header_color=$data_slides['pirenko_sh_slide_header_color'];
				$pirenko_sh_slide_header_bk_color="";
                if (isset($data_slides['pirenko_sh_slide_header_bk_color']))
					$pirenko_sh_slide_header_bk_color=$data_slides['pirenko_sh_slide_header_bk_color'];
				$pirenko_sh_slide_body_color="";
                if (isset($data_slides['pirenko_sh_slide_body_color']))
					$pirenko_sh_slide_body_color=$data_slides['pirenko_sh_slide_body_color'];
				$pirenko_sh_slide_body_bk_color="";
                if (isset($data_slides['pirenko_sh_slide_body_bk_color']))
					$pirenko_sh_slide_body_bk_color=$data_slides['pirenko_sh_slide_body_bk_color'];
				
				$pos_class="sld_".$h_align." "."sld_".$v_align;				
					if (has_post_thumbnail( get_the_ID() ) ) 
					{
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
					}
					else 
					{
						//THERE'S NO FEATURED IMAGE SO LET'S LOAD A DEFAULT IMAGE
						$container="".get_bloginfo('template_directory')."/images/sample/holdera.jpg";
						$image[0]=get_image_path($container);
					}
					$out.='<li id="samba_slide_'.$slide_number.'" class="'.$text_size.'">';
					if (isset($data_slides['pirenko_sh_slide_url']) && $data_slides['pirenko_sh_slide_url']!="" && !isset($data_slides['pirenko_sh_slide_show_button']))
					{
						$out.='<a href="'.$data_slides['pirenko_sh_slide_url'] .'" target="'.$data_slides['pirenko_sh_slide_wdw'].'" class="fade_anchor">';
					}
					if (get_the_title()=="" || $use_txt==0)
					{
						$sl_title="&nbsp;";
						$title_class="inv_el";
					}
					else
					{
						$sl_title=get_the_title();
						$title_class="";
					}
					if (get_the_content()=="" || $use_txt==0)
					{
						$sl_body="&nbsp;";
						$body_class="inv_el";
					}
					else
					{
						$sl_body=get_the_content();
						$body_class="";
					}
					
					if (!isset($data_slides['pirenko_sh_video']) || $data_slides['pirenko_sh_video']=="")
					{
						if ($use_txt==1)
						{
							$out.='<div class="slider_text_holder '. $pos_class .'">';
							$out.='<div id="'.$id.'top_'. $slide_number .'" class="left_floated headings_top '.$title_class.'" style="color:'. $pirenko_sh_slide_header_color .';">';
							$out.='<div class="prk_colored_slider" style="background-color:'.$pirenko_sh_slide_header_bk_color.'">';
							$out.=''. $sl_title .'';
							$out.='<div class="clearfix"></div>';
							$out.='</div>';
							$out.='</div>';
							$out.='<div class="clearfix"></div>';
							$out.='<div id="'.$id.'body_'. $slide_number .'" class="headings_body '.$body_class.'" style="color:'. $pirenko_sh_slide_body_color.';background-color:'.$pirenko_sh_slide_body_bk_color.';">';
							$out.='<div>';
							$out.=''. $sl_body .'';
							$out.='<div class="clearfix"></div>';
							$out.='</div>';
							$out.='</div>';
							$out.='<div class="clearfix"></div>';
							if (isset($data_slides['pirenko_sh_slide_url']) && $data_slides['pirenko_sh_slide_url']!="" && isset($data_slides['pirenko_sh_slide_show_button']))
                            {   
                            	$extra_style="";
                            	if ($data_slides['pirenko_sh_slide_header_bk_color']=="")
                            	{
                            		$extra_style='style="padding-left:10px;padding-right:10px;"';
                            	}
                                $out.='<div id="'.$id.'slidebtn_'.$slide_number.'" class="theme_button '.$text_size.'" '.$extra_style.'>';
                                    $out.='<a href="'.$data_slides['pirenko_sh_slide_url'].'" target="'.$data_slides['pirenko_sh_slide_wdw'].'" class="fade_anchor" data-color="'.$pirenko_sh_slide_header_color.'">';
                                        $out.=$data_slides['pirenko_sh_slide_button_label'];
                                    $out.='</a>';
                                $out.='</div>';
                            }
							$out.='</div>';
						}
						$vt_image = vt_resize( '', $image[0] , 0, 0, true ); 
						$out.='<img class="vsbl" src='. $image[0] .' alt="'.prk_get_img_alt($image[0]).'" data-or_w="'.$vt_image['width'].'" data-or_h="'.$vt_image['height'].'">';
						// FOR IE NO DISPLAY BUG
						$out.='<img src='. $image[0] .' alt="'.prk_get_img_alt($image[0]).'" class="hide_now">';
					}
					else
					{
						if ($use_txt==1)
						{
							//IT's A VIDEO SLIDE
							$out.='<div class="slider_text_holder '. $pos_class .'">';
							$out.='<div id="'.$id.'top_'. $slide_number .'" class="left_floated headings_top '.$title_class.'" style="color:'. $pirenko_sh_slide_header_color .';">';
							$out.='<span class="prk_colored_slider" style="background-color:'.$pirenko_sh_slide_header_bk_color.'">';
							$out.=''. $sl_title .'';
							$out.='<div class="clearfix"></div>';
							$out.='</span>';
							$out.='</div>';
							$out.='<div class="clearfix"></div>';
							$out.='<div id="'.$id.'body_'. $slide_number .'" class="headings_body '.$body_class.'" style="color:'. $pirenko_sh_slide_body_color.';background-color:'.$pirenko_sh_slide_body_bk_color.';">';
							$out.='<span>';
							$out.=''. $sl_body .'';
							$out.='<div class="clearfix"></div>';
							$out.='</span>';
							$out.='</div>';
							$out.='<div class="clearfix"></div>';
							if (isset($data_slides['pirenko_sh_slide_url']) &&  $data_slides['pirenko_sh_slide_url']!="" && isset($data_slides['pirenko_sh_slide_show_button']))
                            {   
                            	$extra_style="";
                            	if ($data_slides['pirenko_sh_slide_header_bk_color']=="")
                            	{
                            		$extra_style='style="padding-left:10px;padding-right:10px;"';
                            	}
                                $out.='<div id="'.$id.'slidebtn_'.$slide_number.'" class="theme_button '.$text_size.'" '.$extra_style.'>';
                                    $out.='<a href="'.$data_slides['pirenko_sh_slide_url'].'" target="'.$data_slides['pirenko_sh_slide_wdw'].'" class="fade_anchor" data-color="'.$pirenko_sh_slide_header_color.'">';
                                        $out.=$data_slides['pirenko_sh_slide_button_label'];
                                    $out.='</a>';
                                $out.='</div>';
                            }
							$out.='</div>';
						}
						$out.=$data_slides['pirenko_sh_video'];
					}
						if (isset($data_slides['pirenko_sh_slide_url']) && $data_slides['pirenko_sh_slide_url']!="" && !isset($data_slides['pirenko_sh_slide_show_button']))
						   $out.=' </a>';
					$out.='</li>';
					$slide_number++;
				endwhile;
	 	$out.='</ul><!-- slides -->
		</div>';
		wp_reset_query();
	  	return $out;
	}
	add_shortcode('prk_slider', 'pirenko_sh_slider');
	


	//TEAM MEMBER
	function prk_member_shortcode( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'category'    	=> '',//SHOW ALL SLIDES BY DEFAULT
			'columns'		=>'columns',
		), $atts));
		if ($category=="show_all")
			$category="";
		$args=array(	'post_type' => 'pirenko_team_member',
						'showposts' => 99,
						'pirenko_member_group' => $category
					);
	    if ($atts['columns']==2) {
	      $fluid="six columns";
	  	}
	    if ($atts['columns']==3){
	      $fluid="four columns";
	  	}
	    if ($atts['columns']==4){
	      $fluid="three columns";
	  	}
	    if ($atts['columns']==6){
	      $fluid="two columns";
	  	}
	  	if (isset($atts['css_animation']) && $atts['css_animation']!="")
			$fluid.=" wpb_animate_when_almost_visible wpb_".$atts['css_animation'];
		if (isset($atts['el_class']) && $atts['el_class']!="")
			$fluid.=" ".$atts['el_class'];
		$loop = new WP_Query( $args );
		$out = '';
		$i=0; 
		$out.='	<div class="row prk_row">
		<ul class="member_ul">';
			while ( $loop->have_posts() ) : $loop->the_post();
				$data=get_post_meta( get_the_ID(), '_custom_meta', true );
				if (isset($data['member_job']) && $data['member_job']!="")
					$member_job = $data['member_job'];
				else
					$member_job="";
				if (isset($data['member_email']) && $data['member_email']!="")
					$member_email = $data['member_email'];
				else
					$member_email="";
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
					if (has_post_thumbnail( get_the_ID() ) ):
						//GET THE FEATURED IMAGE
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );	
							else :
								//THERE'S NO FEATURED IMAGE SO LET'S LOAD A DEFAULT IMAGE
								$container="".get_bloginfo('template_directory')."/images/sample/user.jpg";
								$image[0]=get_image_path($container);
							endif; 
							
							$out.='<li class="'.$fluid.' sh_member_wrapper" data-color="'.$featured_color.'">';
								if ($data['alchemy_show_member_link']=="yes")
								{
									$out.='<a href="'.get_permalink().'" class="sh_member_link fade_anchor">';
									$out.='<div class="member_colored_block boxed_shadow">';
								}
								else
								{
									$out.='<div class="member_colored_block boxed_shadow no_link">';
								}
									
									$out.='<div class="member_colored_block_in">';
                                    $out.='<div class="navicon-plus sh_member_link_icon body_bk_color"></div>';
									$out.='</div>';
									$out.='<img src='. $image[0] .' alt="'.prk_get_img_alt($image[0]).'" class="mb_in_img" />';
									$out.='</div>';
								if ($data['alchemy_show_member_link']=="yes")
								{
									$out.=' </a>';
								}
								$out.='<div class="sh_member_name zero_color header_font bd_headings_text_shadow"><h3 class="small fade_anchor">';
								if ($data['alchemy_show_member_link']=="yes")
								{
									$out.='<a href="'.get_permalink().'" class="fade_anchor">';
										$out.=get_the_title();
									$out.=' </a>';
								}
								else
								{
									$out.=get_the_title();
								}
								$out.='</h3></div>';
								$out.='<div class="sh_member_function zero_color bd_headings_text_shadow header_font">';
								$out.=$member_job;
								$out.='</div>';
								$out.='<div class="tiny_line"></div>';
								$out.='<div class="sh_member_email default_color">';
									$out.='<a href="mailto:'.antispambot($member_email).'">';
										$out.=antispambot($member_email);
									$out.=' </a>';
								$out.='</div>';
								if (has_excerpt()) 
								{
									$out.='<div class="regular_font">';
									$out.=get_the_excerpt();
									$out.='</div>';
								}
								$out.='<div class="clearfix"></div>';
							$out.='</li>';
							$i++;
							if ($i%$atts['columns']==0)
							{
								$out.='<li class="clearfix"></li>';
							}
			endwhile;
	 	$out.='</ul></div>';
		wp_reset_query();
	  	return $out;
	}
	add_shortcode('prk_members', 'prk_member_shortcode');
	
	//PRICING TABLES
	function prk_price_table_shortcode( $atts, $content = null ) 
	{
		$featured="&nbsp;";
		$extra_class="";
		$header="";
		if (isset($atts['header']))
			$header=$atts['header'];
		$color="";
		if (isset($atts['color']))
			$color=$atts['color'];
		$price="";
		if (isset($atts['price']))
			$price=$atts['price'];
		$button_label="";
		if (isset($atts['button_label']))
			$button_label=$atts['button_label'];
		$button_link="#";
		if (isset($atts['button_link']))
			$button_link=$atts['button_link'];
		if (isset($atts['featured']) && $atts['featured']!="")
		{
			$featured=$atts['featured'];
		}
		$under_price="";
		if (isset($atts['under_price']))
			$under_price=$atts['under_price'];
		$extra_inline="";
		if ($color!="") {
			$extra_inline='style="background-color:'.$color.';"';
			$extra_class=" featured";
		}
		$specs_class="";
		if ($button_label!="")
		{
			$specs_class=" prk_wbtn";
		}
		$output="";
		$output.='<div class="prk_price_table'.$extra_class.'"><div class="prk_price_header zero_color">';
		$output.='<h3 class="header_font">'.$header.'</h3><div class="default_color">'.$featured.'</div></div>';
		$output.='<div class="prk_prices_specs'.$specs_class.'" '.$extra_inline.'><div class="prk_price header_font zero_color">'.$price.'</div><div class="underp">'.$under_price.'</div>'.$content;
		if ($button_label!="")
		{
			$output.='<div class="prk_price_button theme_button_inverted small"><a href="'.$button_link.'" class="fade_anchor">'.$button_label.'</a></div>';
		}
		$output.='</div></div>';
		return $output;
	}
	add_shortcode('prk_price_table', 'prk_price_table_shortcode');
	
	//SITEMAP
	function prk_sitemap_shortcode( $atts, $content = null ) 
	{
		//start building output string
		$output="<div class='prk_sitemap_wrapper fade_anchor'>";
		$txt_pages="Pages";
		if (isset($atts['txt_pages']) && $atts['txt_pages']!="")
			$txt_pages=$atts['txt_pages'];
		$show_pages="yes";
		if (isset($atts['show_pages']) && $atts['show_pages']!="")
			$show_pages=$atts['show_pages'];
		if ($show_pages=="yes")
		{
			$output.="<div class='prk_titlify_father'><h3 class='zero_color bd_headings_text_shadow small'>".$txt_pages."</h3></div>";
			$output.="<ul class='sitemap_block'>".wp_list_pages('title_li=&echo=0')."</ul>";
		}
		$txt_blog_cats="Blog categories";
		if (isset($atts['txt_blog_cats']) && $atts['txt_blog_cats']!="")
			$txt_blog_cats=$atts['txt_blog_cats'];
		$show_blog_cats="yes";
		if (isset($atts['show_blog_cats']) && $atts['show_blog_cats']!="")
			$show_blog_cats=$atts['show_blog_cats'];
		if ($show_blog_cats=="yes")
		{
			$output.="<div class='prk_titlify_father'><h3 class='zero_color bd_headings_text_shadow small'>".$txt_blog_cats."</h3></div>";
			$output.="<ul class='sitemap_block'>".wp_list_categories('title_li=&echo=0&sort_column=name&optioncount=1&hierarchical=0')."</ul>";
		}
		$txt_blog_posts="Blog posts";
		if (isset($atts['txt_blog_posts']) && $atts['txt_blog_posts']!="")
			$txt_blog_posts=$atts['txt_blog_posts'];
		$show_posts="yes";
		if (isset($atts['show_posts']) && $atts['show_posts']!="")
			$show_posts=$atts['show_posts'];
		if ($show_posts=="yes")
		{
			global $month, $wpdb, $wp_version;
			$sql = 'SELECT
				DISTINCT YEAR(post_date) AS year,
				MONTH(post_date) AS month,
				count(ID) as posts
			FROM ' . $wpdb->posts . '
			WHERE post_status="publish"
				AND post_type="post"
				AND post_password=""
			GROUP BY YEAR(post_date),
				MONTH(post_date)
			ORDER BY post_date DESC';
			$archiveSummary = $wpdb->get_results($sql);
			if ($archiveSummary) 
			{
				$output.="<div class='prk_titlify_father'><h3 class='zero_color bd_headings_text_shadow small'>".$txt_blog_posts."</h3></div>";
				$output.= "<ul class='sitemap_block'>";
				foreach ($archiveSummary as $date) 
				{
					// reset the query vsambable
					unset ($bmWp);
					$bmWp = new WP_Query('year=' . $date->year . '&monthnum=' . zeroise($date->month, 2) . '&posts_per_page=-1');
					if ($bmWp->have_posts()) 
					{
						$url = get_month_link($date->year, $date->month);
						$text = $month[zeroise($date->month, 2)] . ' ' . $date->year;
						$output.= get_archives_link($url, $text, '', '<li>', '</li>'); 
						$output.= '<ul class="children">';
						while ($bmWp->have_posts()) 
						{
							$bmWp->the_post();
							$output.= '<li><a href="' . get_permalink($bmWp->post) . '" title="' . esc_html($text, 1) . '" class="fade_anchor">' . wptexturize($bmWp->post->post_title) . '</a></li>';
						}
						$output.= '</ul>';			
					}
				}
				$output.= '</ul>';	
			}
		}
		$txt_port_posts="Portfolio";
		if (isset($atts['txt_port_posts']) && $atts['txt_port_posts']!="")
			$txt_port_posts=$atts['txt_port_posts'];
		$show_port_posts="yes";
		if (isset($atts['show_port_posts']) && $atts['show_port_posts']!="")
			$show_port_posts=$atts['show_port_posts'];
		if ($show_port_posts=="yes")
		{
			$output.="<div class='prk_titlify_father'><h3 class='zero_color bd_headings_text_shadow small'>".$txt_port_posts."</h3></div>";
			$output.= "<ul class='sitemap_block'>";
			$terms = get_terms( 'pirenko_skills', 'orderby=name' );
			foreach ($terms as $term) {
			$output.= "<li><a href='".get_term_link($term->slug, 'pirenko_skills')."' class='fade_anchor'>".$term->name."</a>";
			$output.= "<ul class='children'>";
			$args = array(
				'post_type' => 'pirenko_portfolios',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
					'taxonomy' => 'pirenko_skills',
					'field' => 'slug',
					'terms' => $term->slug
					)
				)
			);
			$new = new WP_Query($args);
			while ($new->have_posts()) {
			$new->the_post();
			$output.= '<li><a href="'.get_permalink().'" class="fade_anchor">'.get_the_title().'</a></li>';
			}
			$output.= "</ul>";
			$output.= "</li>";
			} 
			$output.= "</ul>";
		}
		$output.="</div>";
		return $output;
	}
	add_shortcode('prk_sitemap', 'prk_sitemap_shortcode');

	//SERVICES
	function prk_service_shortcode( $atts, $content = null ) 
	{
		$name="";
		if (isset($atts['name']))
			$name=$atts['name'];
		$image="";
		if (isset($atts['image']))
			$image=$atts['image'];
		$link="";
		if (isset($atts['link']))
			$link=$atts['link'];
		global $prk_translations;
		$link_text=$prk_translations['read_more'];
		if (isset($atts['link_text']) && $atts['link_text']!="")
			$link_text=$atts['link_text'];
		$align="";
		$extra="";
		if (isset($atts['bk_color']) && $atts['bk_color']!="") {
			$align.="serv_with_color";
			$extra=" style=background-color:".$atts['bk_color'];
		}
		if (isset($atts['align']))
			$align.=" ".$atts['align'];
		if (isset($atts['css_animation']) && $atts['css_animation']!="")
		{
			$align.=" wpb_animate_when_almost_visible wpb_".$atts['css_animation'];
		}
		if (isset($atts['el_class']) && $atts['el_class']!="")
		{
			$align.=" ".$atts['el_class'];
		}
		global $prk_samba_frontend_options;
		$serv_image="";
		if (isset($atts['serv_image']))
			$serv_image=$atts['serv_image'];
		global $retina_device;
		if ($serv_image!="") 
		{
			if ($retina_device=="prk_retina") {
				$path_parts = pathinfo($serv_image);
				$vt_image = vt_resize( '', $path_parts['dirname'] . "/".$path_parts['filename']."_@2X.".$path_parts['extension'] , 2000, 2000, false );
				$half_width=$vt_image['width']/2;
				$half_height=$vt_image['height']/2;
				//CHECK IF RETINA FILE EXISTS
				if ($half_width!=1000) {
					$imager ="<div><img alt='".prk_get_img_alt($serv_image)."' src='" . $path_parts['dirname'] . "/".$path_parts['filename']."_@2X.".$path_parts['extension']."' width='".$half_width."' height='".$half_height."'/></div>";
				}
				else
				{
					$imager='<div><img alt="'.prk_get_img_alt($serv_image).'" src="'.$serv_image.'" /></div>';
				}
			}
			else
			{
				$imager='<div><img alt="'.prk_get_img_alt($serv_image).'" src="'.$serv_image.'" /></div>';
			}
		}
		else
		{
			$imager='<div class="'.$image.' colored_link_icon not_zero_color"></div>';
		}
		if ($link=="")		
			return '<div class="prk_service '.$align.'"'.$extra.'>'.$imager.'<div class="clearfix"></div><div class="prk_service_ctt"><h3 class="small zero_color bd_headings_text_shadow header_font">'.$name.'</h3><div class="clearfix"></div><div>'.$content.'</div></div></div>';
		else {
			$new_window="";
			$extra_class=" fade_anchor";
			if (isset($atts['new_window']) && $atts['new_window']=="Yes") {
				$new_window=' target="_blank"';
				$extra_class="";
			}
			$serv_image=$atts['serv_image'];
			return '<div class="prk_service '.$align.'"'.$extra.'>'.$imager.'<div class="clearfix"></div><div class="prk_service_ctt"><h3 class="small zero_color bd_headings_text_shadow header_font">'.$name.'</h3><div class="clearfix"></div><div class="service_inner_desc">'.$content.'</div><div class="simple_line special_size thick"></div><div class="service_lnk header_font prk_bold"><a class="not_zero_color'.$extra_class.'" href="'.$link.'"'.$new_window.'>'.$link_text.'</a></div></div></div>';
		}
	}
	add_shortcode('prk_service', 'prk_service_shortcode');
	
	//BLOCKQUOTES
	function blockquotes_shortcode( $atts, $content = null ) 
	{
		if (isset($atts['css_animation']) && $atts['css_animation']!="")
		{
			if (isset($atts['el_class']) && $atts['el_class']!="")
				$atts['css_animation']=$atts['css_animation']." ".$atts['el_class'];
			$output='<div class="samba_bquote_wrapper wpb_animate_when_almost_visible wpb_'.$atts['css_animation'].'">';
		}
		else
			$output='<div class="samba_bquote_wrapper">';
		if ($atts['type']=="plain")
	   		$output.= '<div class="prk_blockquote ' . $atts['type']. '"><div class="in_quote"><div class="prk_inner_tip"></div><div class="tip_top_hide"></div>' . $content . '</div></div><div class="pirenko_author header_font body_text_shadow prk_bold">' . $atts['author'] . '<span class="after_author">' . $atts['after_author']. '</span></div>';
	   	else
	   	{
	   		if ($atts['author']!="" || $atts['after_author'] !="")
	   		{
	   			$author_html='<div class="pirenko_author header_font body_text_shadow prk_bold">' . $atts['author'] . '<span class="after_author">' . $atts['after_author']. '</span></div>';
	   		}
	   		else
	   		{
	   			$author_html="";
	   		}
	   		$output.= '<div class="prk_blockquote ' . $atts['type']. '"><div class="in_quote">'.$content.$author_html.'</div></div>';
	   	}
	   	$output.='</div>';
	   	return $output;
	}
	add_shortcode('pirenko_blockquote', 'blockquotes_shortcode');

	//SPACER
	function spacer_shortcode( $atts, $content = null ) 
	{
		if (isset($atts['size']))
		{
			$size=$atts['size'];
		}
		else
		{
			$size=0;
		}
	   		
	   		return '<div class="clearfix" style="margin-bottom:' .$size. 'px;""></div>';
	}
	add_shortcode('pirenko_spacer', 'spacer_shortcode');
	
	//LISTS
	function simple_line_shortcode( $atts, $content = null ) 
	{
		$custom_icons="";
		if (isset($atts['color']) && $atts['color']!="")
			return '<div class="simple_line" style="border-bottom: 1px solid '.$atts['color'].'"></div>';
		else
			return '<div class="simple_line"></div>';
	}
	add_shortcode('prk_line', 'simple_line_shortcode');

	//LISTS
	function list_with_icons_shortcode( $atts, $content = null ) 
	{
		$custom_icons="";
		if (isset($atts['icon']))
			$custom_icons=$atts['icon'];
		return '<div class="list_with_icons '. $custom_icons .'">' . $content . '</div>';
	}
	add_shortcode('list_with_icons', 'list_with_icons_shortcode');

	//TOGGLE CHILDNODES RETRIEVAL - LEGACY
	function prk_ac_single( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		//MAKE TAB ID MATCH THE CONTENT TAB ID
		return '<div class="prk_ac_single">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'prk_ac_single', 'prk_ac_single' );
	//TOGGLE
	function prk_accordion( $atts, $content = null ) 
	{
		$defaults = array( 'type' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		if (isset($atts['type']) && $atts['type']!="")
			$type=$atts['type'];
		else
			$type="";
		if (isset($atts['title']) && $atts['title']!="")
			$title=$atts['title'];
		else
			$title="No title was set";
		$main_classes="";
		if (isset($atts['css_animation']) && $atts['css_animation']!="")
			$main_classes.=" wpb_animate_when_almost_visible wpb_".$atts['css_animation'];
		if (isset($atts['el_class']) && $atts['el_class']!="")
			$main_classes.=" ".$atts['el_class'];
		$output = '';
	    $output .= '<div id="accordion_'. rand(1, 1000) .'" class="prk_accordion'.$main_classes.'">';
	    $output .= '<div class=""><a href="#">'.$title;
	    $output .= '</a></div>';
		$output .= '<div class="prk_ac_single">'. do_shortcode( $content ) .'</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'prk_accordion', 'prk_accordion' );
	
	//PROGRESS BARS - DEPRECATED
	//CHILDNODES RETRIEVAL
	function prk_progress_bar( $atts, $content = null ) {
		$defaults = array( 'title' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$title="";
		if (isset($atts['title']))
			$title=$atts['title'];
		$pctg="";
		if (isset($atts['pctg']))
			$pctg=$atts['pctg'];
		$active_color="";
		if (isset($atts['active_color']))
			$active_color=$atts['active_color'];
		$background_color="";
		if (isset($atts['background_color']))
			$background_color=$atts['background_color'];
		$show_pctg="yes";
		if (isset($atts['show_pctg']))
			$show_pctg=$atts['show_pctg'];
		if ($show_pctg!="yes") {
			return '<div class="prk_progress_bar no_pctg"><div class="active_bar" data-width="'.$pctg.'" style="width:'.$pctg.'%;background-color:'.$active_color.';"><div class="header_font" style="color:'.$background_color.';">'.$title.'</div></div><div class="inactive_bar" style="background-color:'.$background_color.';"></div></div>';
		}
		else {
			$pctg_out=$pctg.'%';
			return '<div class="prk_progress_bar"><div class="small_squared" style="color:'.$active_color.';background-color:'.$background_color.';">'.$pctg_out.'</div><div class="active_bar" data-width="'.$pctg.'" style="width:'.$pctg.'%;background-color:'.$active_color.';"><div class="header_font" style="color:'.$background_color.';">'.$title.'</div></div><div class="inactive_bar" style="background-color:'.$background_color.';"></div></div>';
		}
	}
	add_shortcode( 'prk_progress_bar', 'prk_progress_bar' );
	//MAIN PROGRESS BAR SECTION RETRIEVAL
	function prk_progress( $atts, $content = null ) 
	{
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
			
		$output = '';
		$output .= '<div class="prk_progress">';
		$output .= '<ul>';
		$output .= do_shortcode( $content );
		$output .= '</ul>';
		$output .= '</div>';
			
		return $output;
	}
	add_shortcode( 'prk_progress', 'prk_progress' );
	
	//CAROUSEL
	//CHILDNODES RETRIEVAL
	function prk_carousel_single( $atts, $content = null ) {
		$defaults = array( 'path' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$path="";
		if (isset($atts['path']))
			$path=$atts['path'];
		//MAKE TAB ID MATCH THE CONTENT TAB ID
		return '<img src="'.$path.'" '.prk_dims($path,1).'/>';
	}
	add_shortcode( 'prk_carousel_single', 'prk_carousel_single' );
	//MAIN CAROUSEL BAR SECTION RETRIEVAL
	function prk_carousel( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'title'    	 => ''
		), $atts));
		if (isset($atts['title']) && $atts['title']!="")
			$title=$atts['title'];
		else
			$title="";
		$output = '';
		if ($title!="")
        	$output.=do_shortcode('[prk_styled_title align="left" text_color="" show_lines="no" use_italic="" title_size="small"]'.$title.'[/prk_styled_title]');
		$output .= '<div class="prk_list_carousel">';
		$output .= '<ul class="prk_rousel">';
		$output .= do_shortcode( $content );
		$output .= '</ul>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'prk_carousel', 'prk_carousel' );
	
	//THEME BUTTONS
	function button_shortcode( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'caption'    	 => 'This is my text',
			'icon'		 => 'heart'
		), $atts));
		$link="";
		if (isset($atts['link']))
			$link=$atts['link'];
		$type="theme_button medium";
		if (isset($atts['type']))
			$type=$atts['type'];
		$window="_self";
		if (isset($atts['window']))
			$window=$atts['window'];
		$out = '';
	   	$out.= '<div class="'.$type.'"><a href="'.$link.'" target="'.$window.'" class="fade_anchor">' . $content . '</a></div>';
	   	return $out;
	}
	add_shortcode('theme_button', 'button_shortcode');
	
	//LAYOUTS
	function pirenko_sh_one_full_row( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'extra_class'    	 => '',
		), $atts));
		if (isset($atts['extra_class']) && $atts['extra_class']!="")
   			return '<div class="row prk_row '.$extra_class.'">' . do_shortcode($content) . '</div>';
   		else
   			return '<div class="row prk_row">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_full_row', 'pirenko_sh_one_full_row');

	function pirenko_sh_one_full( $atts, $content = null ) {
   	return '<div class="twelve columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_full', 'pirenko_sh_one_full');
	
	
	function pirenko_sh_one_half( $atts, $content = null ) {
	   return '<div class="six columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'pirenko_sh_one_half');
	
	
	function pirenko_sh_one_half_last( $atts, $content = null ) {
	   return '<div class="six columns prk_last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_half_last', 'pirenko_sh_one_half_last');
	
	
	function pirenko_sh_one_third( $atts, $content = null ) {
	   return '<div class="four columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'pirenko_sh_one_third');
	
	
	function pirenko_sh_one_third_last( $atts, $content = null ) {
	   return '<div class="four columns prk_last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_third_last', 'pirenko_sh_one_third_last');
	
	
	function pirenko_sh_two_third( $atts, $content = null ) {
	   return '<div class="eight columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_third', 'pirenko_sh_two_third');
	
	
	function pirenko_sh_two_third_last( $atts, $content = null ) {
	   return '<div class="eight columns prk_last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_third_last', 'pirenko_sh_two_third_last');
	
	
	function pirenko_sh_one_fourth( $atts, $content = null ) {
	   return '<div class="three columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'pirenko_sh_one_fourth');
	
	
	function pirenko_sh_one_fourth_last( $atts, $content = null ) {
	   return '<div class="three columns prk_last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fourth_last', 'pirenko_sh_one_fourth_last');
	
	
	function pirenko_sh_three_fourth( $atts, $content = null ) {
	   return '<div class="nine columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourth', 'pirenko_sh_three_fourth');
	
	
	function pirenko_sh_three_fourth_last( $atts, $content = null ) {
	   return '<div class="nine columns prk_last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fourth_last', 'pirenko_sh_three_fourth_last');
	
	
	function pirenko_sh_one_sixth( $atts, $content = null ) {
	   return '<div class="two columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_sixth', 'pirenko_sh_one_sixth');
	
	
	function pirenko_sh_one_sixth_last( $atts, $content = null ) {
	   return '<div class="two columns prk_last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_sixth_last', 'pirenko_sh_one_sixth_last');
	
	
	function pirenko_sh_five_sixth( $atts, $content = null ) {
	   return '<div class="ten columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('five_sixth', 'pirenko_sh_five_sixth');
	
	
	function pirenko_sh_five_sixth_last( $atts, $content = null ) {
	   return '<div class="ten columns prk_last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('five_sixth_last', 'pirenko_sh_five_sixth_last');
	
	
	function pirenko_sh_styled_title( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type'    	 => '',
		), $atts));
		$main_classes="";
		if (isset($atts['unmargined']) && $atts['unmargined']=="unmargined")
			$main_classes.=" ".$atts['unmargined'];
		//INLINE
		$inline="";
		if (isset($atts['text_color']) && $atts['text_color']!="")
			$inline="color:".$atts['text_color'].";";
		//CLASSES
		if (isset($atts['use_italic']) && $atts['use_italic']=="yes")
			$classes="special_italic ";
		else
			$classes="header_font ";
		if (isset($atts['align']) && $atts['align']=="center")
		{
			$main_classes.=" alignify_center";
			$classes.="alignify_center ";
		}
		if (isset($atts['title_size']))
			$classes.="sizer_".$atts['title_size']." ";
		if (isset($atts['text_color']) && $atts['text_color']=="") {
			$classes.="bd_headings_text_shadow ";
		}
		else {
			$splitted_shadow=html2rgb($atts['text_color']);
			$inline.="text-shadow:0px 0px 1px rgba(".$splitted_shadow[0].", ".$splitted_shadow[1].", ".$splitted_shadow[2].",0.3);";
		}
		if (isset($atts['css_animation']) && $atts['css_animation']!="")
			$main_classes.=" wpb_animate_when_almost_visible wpb_".$atts['css_animation'];
		if (isset($atts['el_class']) && $atts['el_class']!="")
			$main_classes.=" ".$atts['el_class'];
		$out='';
		$out.='<div class="prk_shortcode-title'.$main_classes.'">';
		if (isset($atts['samba_show_line']) && ($atts['samba_show_line']=="yes" || $atts['samba_show_line']=="Yes"))
		{
			if (isset($atts['title_size']))
				$father_classes=" ft_".$atts['title_size'];
			$out.='<div class="prk_titlify_father'.$father_classes.$main_classes.'">';
		}
		if ($inline!="")
		{
			$out.='<div class="'.$classes.'zero_color prk_vc_title" style="'.$inline.'">' . $content . '</div>';
		}
		else
		{
			$out.='<div class="'.$classes.'zero_color prk_vc_title">' . $content . '</div>';
		}
		if (isset($atts['samba_show_line']) && ($atts['samba_show_line']=="yes" || $atts['samba_show_line']=="Yes"))
		{
			$out.='</div>';
		}
		$out.='</div>';
		return do_shortcode($out);

	}
	add_shortcode('prk_styled_title', 'pirenko_sh_styled_title');
	
	//LAST PORTFOLIOS
	function pirenko_last_portfolios_shortcode( $atts, $content = null ) 
	{
		global $prk_samba_frontend_options;
		global $retina_device;
		global $prk_translations;
		$retina_flag = $retina_device === "prk_retina" ? true : false;
		if (!isset($prk_translations['all_text']))
			$prk_translations['all_text']='All';
		extract(shortcode_atts(array(
			'title'    	 => '',
			'items_number'		 => ''
		), $atts));
		if (isset($atts['title']) && $atts['title']!="")
			$title=$atts['title'];
		else
			$title="";
		if (isset($atts['button_url']) && $atts['button_url']!="")
			$button_url=$atts['button_url'];
		else
			$button_url="";
		if (isset($atts['button_label']) && $atts['button_label']!="")
			$button_label=$atts['button_label'];
		else
			$button_label="";
		if (isset($atts['cols_number']) && $atts['cols_number']!="")
			$cols_number = $atts['cols_number'];
		else
			$cols_number="variable";
		if (isset($atts['items_number']) && $atts['items_number']!="")
			$items_number = $atts['items_number'];
		else
			$items_number="9";
		if (isset($atts['cat_filter']) && $atts['cat_filter']!="")
			$cat_filter = $atts['cat_filter'];
		else
			$cat_filter="";
		if (isset($atts['show_filter']) && $atts['show_filter']!="")
			$show_filter = $atts['show_filter'];
		else
			$show_filter="no";
		if (isset($atts['layout_type_folio']) && $atts['layout_type_folio']!="")
			$layout_type_folio = $atts['layout_type_folio'];
		else
			$layout_type_folio="without_titles";
		if (isset($atts['thumbs_mg']) && $atts['thumbs_mg']!="")
			$thumbs_mg = $atts['thumbs_mg'];
		else
			$thumbs_mg="10";
		if (isset($atts['samba_show_skills']) && $atts['samba_show_skills']=="yes")
			$samba_show_skills=true;
		else
			$samba_show_skills=false;
		$my_home_query = new WP_Query();
		$args = array (	'post_type' => 'pirenko_portfolios', 
					'posts_per_page' => $items_number,
					'pirenko_skills'=>$cat_filter,
					);
		$my_home_query->query($args);
		if ($my_home_query->have_posts())
		{
			$out = '';
            $out.='<div class="recentfolio_ul_wp prk_shorts cf twelve">';
            	$shifted="";
				if ($show_filter=="yes" || $button_url!="")
				{
					$terms = get_terms("pirenko_skills");
					$count = count($terms);
						$out.='<div class="clearfix"></div>';
                        $out.='<div class="filter_shortcodes">';
							 $out.='<div class="scode_categories cf">';
                            $out.='<ul class="filter clearfix">';
                            	if ($show_filter=="yes")
                            	{
	                                $out.='<li class="active">';
	                                    $out.='<a class="all colored_bg" data-filter="p_all" href="javascript:void(0)">'.$prk_translations['all_text'].'</a>';
	                                $out.='</li>';
	                                $out.='<li class="clearfix show_much_later"></li>';
	                            }
                                if ($show_filter=="yes" && $count > 0)
                                {
	                            	foreach ( $terms as $term ) {
										if (strpos($cat_filter,$term->slug) !== false || $cat_filter=="")
	                               		$out.='<li><a class="'.$term->slug.' colored_bg" data-filter="'.$term->slug.'" href="javascript:void(0)">'.$term->name.'</a></li><li class="clearfix show_much_later"></li>';
	                            	}
	                            }
                            	if ($button_url!="")
				            	{
				            		$out.='<li>';
				                    $out.='<a href="'.$button_url.'" class="colored_bg pf_link fade_anchor">';
				                    $out.=$button_label.' &rarr;';
				                    $out.='</a>';
				                    $out.='</li>';
				                }
                            $out.='</ul>';
							$out.='</div>';
							$out.='</div>';
					}
				
				if ($layout_type_folio=="grid" || $layout_type_folio=="masonry")
				{
	                $out.='<div id="folio_masonry" class="iso_folio shortcoded" data-columns="'.$cols_number.'" style="margin-right:-'.$thumbs_mg.'px;" data-margin='.$thumbs_mg.'>';
	                        while ($my_home_query->have_posts()) : $my_home_query->the_post();
								$skills_links="";
								$skills_names="";
								$skills_yo="";
								$skills_output="";
								$terms = get_the_terms (get_the_ID(), 'pirenko_skills');
								if (!empty($terms))
								{
									foreach ($terms as $term) {
										$skills_links[] = $term->slug;
										$skills_names[] = $term->name;
									}
									$skills_yo = join(" ", $skills_links);
									$skills_output = join(", ", $skills_names);
								}
	                            if (has_post_thumbnail())
	                            {	
	                                $image = wp_get_attachment_image_src( get_post_thumbnail_id(), '' );
	                                $magnific_image[0] = $image[0] = get_image_path($image[0]);
	                                global $simple_mb;
									$data=$simple_mb->the_meta();
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
									$extra_mfp="";
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
												$magnific_image[0]=get_iframe_src($data['image_2']);
												$extra_mfp=" mfp-iframe";
											}
										}
									}
	                                $out.='<div id="post-'.get_the_ID().'" class="'.$featured_class.'portfolio_entry_li '.$skills_yo.' p_all" style="margin-bottom:'.$thumbs_mg.'px;" data-color="'.$featured_color.'">';
	                                    $out.='<div class="grid_image_wrapper">';
	                                        $out.='<div class="prk_magnificent body_bk_color'.$extra_mfp.'" data-mfp-src="'.esc_attr($magnific_image[0]).'">';
												$out.='<div class="navicon-expand-2"></div>';
											$out.='</div>';
											$out.='<a href="'.get_permalink().'" class="fade_anchor">';
	                                        $out.='<div class="grid_single_title zero_color bd_headings_text_shadow zero_color">';
	                                        $out.='<div class="prk_ttl"><h4 class="header_font body_bk_color body_bk_text_shadow big">'.the_title("","",false).'</h4></div> '; 
	                                        if ($skills_output!="" && $samba_show_skills==true)
											{
												$out.='<div class="inner_skills body_bk_color">';
												$out.=$skills_output;
												$out.='</div>';
											}
	                                        $out.='</div><!-- grid_single_title -->';

	                                            $out.='<div class="grid_colored_block">';
	                                           $out.='</div>';
												if (!isset($data['featured_thumb']))
												$data['featured_thumb']=0;
											if ($data['featured_thumb']==0)
											{
												$forced_w=480;
												if ($layout_type_folio=="masonry")
													$forced_h=0;
												else
													$forced_h=300;
												$vt_image = vt_resize( '', $image[0] , $forced_w, $forced_h, true , $retina_flag );
	                                            $out.='<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" id="home_fader-'.get_the_ID().'" class="custom-img grid_image" alt="'.prk_get_img_alt($image[0]).'" data-featured="no" />';
											}
											else
											{
												$forced_w=480;
												if ($layout_type_folio=="masonry")
													$forced_h=0;
												else
													$forced_h=600+1+1;
												$vt_image = vt_resize( '', $image[0] , $forced_w, $forced_h, true , $retina_flag );
	                                            $out.='<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" id="home_fader-'.get_the_ID().'" class="custom-img grid_image" alt="'.prk_get_img_alt($image[0]).'" data-featured="yes" />';
											}
	                                   		$out.=' </a>';
	                                    $out.='</div>';
	                                $out.='</div>';
	                            }
	                        endwhile;
	            $out.='</div>';
	        }
	        if ($layout_type_folio=="titled" || $layout_type_folio=="with_excerpt")
				{
	                $out.='<div id="folio_titled" class="iso_folio shortcoded" data-columns="'.$cols_number.'" style="margin-right:-'.$thumbs_mg.'px;" data-margin='.$thumbs_mg.'>';
	                        while ($my_home_query->have_posts()) : $my_home_query->the_post();
								$skills_links="";
								$skills_names="";
								$skills_yo="";
								$skills_output="";
								$terms = get_the_terms (get_the_ID(), 'pirenko_skills');
								if (!empty($terms))
								{
									foreach ($terms as $term) {
										$skills_links[] = $term->slug;
										$skills_names[] = $term->name;
									}
									$skills_yo = join(" ", $skills_links);
									$skills_output = join(", ", $skills_names);
								}
	                            if (has_post_thumbnail())
	                            {	
	                                $image = wp_get_attachment_image_src( get_post_thumbnail_id(), '' );
	                                $magnific_image[0] = $image[0] = get_image_path($image[0]);
	                                global $simple_mb;
									$data=$simple_mb->the_meta();
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
									$extra_mfp="";
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
												$magnific_image[0]=get_iframe_src($data['image_2']);
												$extra_mfp=" mfp-iframe";
											}
										}
									}
	                                $out.='<div id="post-'.get_the_ID().'" class="'.$featured_class.'portfolio_entry_li zero_shadow '.$skills_yo.' p_all" style="margin-bottom:'.$thumbs_mg.'px;" data-color="'.$featured_color.'">';
	                                    $out.='<div class="grid_image_wrapper boxed_shadow">';
	                                        $out.='<div class="prk_magnificent body_bk_color'.$extra_mfp.'" data-mfp-src="'.esc_attr($magnific_image[0]).'">';
												$out.='<div class="navicon-expand-2"></div>';
											$out.='</div>';
											$out.='<a href="'.get_permalink().'" class="fade_anchor">';
	                                            $out.='<div class="grid_colored_block">';
												$out.='<div class="prk_overlayer"></div>';
	                                           $out.='</div>';
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
	                                            $out.='<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" id="home_fader-'.get_the_ID().'" class="custom-img grid_image" alt="'.prk_get_img_alt($image[0]).'" data-featured="yes" />';
	                                   		$out.=' </a>';
	                                    $out.='</div>';
	                                    if ($layout_type_folio=="with_excerpt")
	                                    	$out.='<div class="titled_block width_exc">';
	                                    else
	                                    	$out.='<div class="titled_block">';
                                    	$out.='<div class="grid_single_title" id="grid_title-<?php the_ID(); ?>">';
                                    	$out.='<div class="zero_color bd_headings_text_shadow">';
	                                        $out.='<a href="'.get_permalink().'" class="fade_anchor">';
	                                        	$out.='<h4 class="header_font">'.the_title("","",false).'</h4>';
	                                       	$out.='</a>';
                                       	$out.='</div>';
											if ($skills_output!="" && $samba_show_skills==true)
											{
												$out.="<div class='tiny_line' data-color='".$featured_color."'></div>";
												$out.='<div class="inner_skills fade_anchor zero_color">';
													$out.=get_the_term_list(get_the_ID(),'pirenko_skills',"",", ");
												$out.='</div>';
											}
											if ($layout_type_folio=="with_excerpt") {
												$out.='<div class="titled_exc regular_font">';
												$out.=the_excerpt_dynamic(100);
												$out.='</div>';
											}
                                    $out.='</div><!-- grid_single_title -->';
                                	$out.='</div>';
	                                $out.='</div>';
	                            }
	                        endwhile;
	            $out.='</div>';
	        }
			$out.='</div>';
       	}
        else
        {
			echo "No content was found!";	
		}
		wp_reset_query();
		return $out;
	}
	add_shortcode('pirenko_last_portfolios', 'pirenko_last_portfolios_shortcode'); 
	//LAST POSTS
	function pirenko_last_posts_shortcode( $atts, $content = null ) 
	{
		global $prk_samba_frontend_options;
		global $retina_device;
		global $prk_translations;
		$retina_flag = $retina_device === "prk_retina" ? true : false;
		extract(shortcode_atts(array(
			'title'    	 => '',
			'items_number'		 => '',
			'rows_number'		 => '',
			'cat_filter'	=> '',
			'css_animation' => '',
			'el_class' => ''
		), $atts));
		if (isset($atts['title']) && $atts['title']!="")
			$title=$atts['title'];
		else
			$title="";
		if (isset($atts['button_url']) && $atts['button_url']!="")
			$button_url=$atts['button_url'];
		else
			$button_url="";
		if (isset($atts['button_label']) && $atts['button_label']!="")
			$button_label=$atts['button_label'];
		else
			$button_label="";
		if (isset($atts['items_number']) && $atts['items_number']!="")
			$items_number = $atts['items_number'];
		else
			$items_number="3";
		if (isset($atts['rows_number']) && $atts['rows_number']!="")
			$rows_number = $atts['rows_number'];
		else
			$rows_number="3";
		if (isset($atts['cat_filter']) && $atts['cat_filter']!="")
			$cat_filter = $atts['cat_filter'];
		else
			$cat_filter="";
		if (isset($atts['align']) && $atts['align']!="")
			$align = $atts['align'];
		else
			$align="left";
		$my_home_query = new WP_Query();
		$args = array (	'post_type=posts', 
					'showposts' => $items_number,
					'category_name'=>$cat_filter,
					);
		$my_home_query->query($args);
		$cols_number=floor($items_number/$rows_number);
		$rand_nbr=rand(1, 500);
		$out = '';
		if ($my_home_query->have_posts())
		{
			if ($cols_number>=$my_home_query->post_count) 
				$extra_a="";
			else
				$extra_a=" extra_spaced";
			if (isset($atts['css_animation']) && $atts['css_animation']!="")
			{
				$extra_a.=" wpb_animate_when_almost_visible wpb_".$atts['css_animation'];
			}
			if (isset($atts['el_class']) && $atts['el_class']!="")
			{
				$extra_a.=" ".$atts['el_class'];
			}
            $out.='<div id="prk_shortcode_latest_posts_'.rand(1, 500).'" class="prk_shorts cf recentposts_ul_wp row'.$extra_a.'">';
                $i=0;
                $out.='<ul id="recent_blog-'.$rand_nbr.'" class="recentposts_ul_shortcode" data-columns='.$cols_number.' data-rows='.$rows_number.'>';
                        while ($my_home_query->have_posts()) : $my_home_query->the_post();
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id(), '' );
                                $image[0] = get_image_path($image[0]);
                                $data = get_post_meta( get_the_ID(), '_custom_meta', true );
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
                                $out.='<li class="columns">';
                                $out.='<div class="'.$featured_class.'" data-color="'.$featured_color.'">';
									if (has_post_thumbnail())
									{	
                                    	$out.='<a href="'.get_permalink().'" class="fade_anchor">';
                                            $out.='<div class="masonr_img_wp boxed_shadow">';
                                             $out.='<div class="blog_fader_grid">';
                                                    $out.='<div class="navicon-plus titled_link_icon body_bk_color"></div>';
                                             $out.='</div>';
                                                    $vt_image = vt_resize( '', $image[0] , 600, 375, true , $retina_flag );
                                                    $out.='<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" id="home_fader-'.get_the_ID().'" class="custom-img grid_image" alt="'.prk_get_img_alt($image[0]).'" />';
                                        $out.='</div>';
                                    $out.='</a>';
								}
								else
								{
									//CHECK IF THERE'S A VIDEO TO SHOW
                                       	if (isset($data['image_2']) && substr($data['image_2'],0,6)!="http:/" && substr($data['image_2'],0,6)!="")
                                        {
                                        	$out.= "<div class='video-container boxed_shadow'>";
                                           	$out.= $data['image_2'];
											$out.= "</div>";
                                      	}
								}
								$out.='<div class="single_blog_meta_div">';
                        			$out.='<div class="navicon-clock-2 left_floated not_zero_color"></div>';
	                    			$out.='<div class="left_floated header_font">';
	                    				$out.=get_the_time(get_option('date_format'));
	                    			$out.='</div>';
	                    		$out.='</div>';
								$out.='<div class="entry_title entry_title_single">';
								$out.='<h4 class="masonr_title bd_headings_text_shadow zero_color small">';
										$out.='<a href="'.get_permalink().'" class="prk_break_word fade_anchor">'.the_title("","",false).'</a>'; 
                        		$out.='</h4>';
                        		$out.='</div>';  
                        		$out.='<div class="on_colored prk_break_word">';
									$out.=the_excerpt_dynamic(64);
	                                if (is_big_excerpt(64))
									{
										$out.='<div class="theme_button small four_margin_tp">';
	                                    $out.='<a href="'.get_permalink().'" class="fade_anchor">';
	                                    $out.=$prk_translations['read_more'];
	                                    $out.='</a>';
	                                    $out.='</div>';
										$out.='<div class="clearfix"></div>';
									}
								$out.='</div>';
                            $out.='</li>';
                            $i++;
							if ($i%$cols_number==0 && $i<$items_number)
							{
								$out.='<li class="clearfix bt_40"></li>';
							}
                        endwhile;
                $out.='</ul>';
            $out.='</div>';
       	}
        else
        {
			$out.='<div id="prk_shortcode_latest_posts" class="prk_shorts cf recentposts_ul_wp twelve">';
                $out.='<div class="shortcode-title">'.$title.'</div>';
                $out.='<div class="simple_line"></div>';
			 $out.= "No content was found!";
			 $out.='</div>';	
		}
		wp_reset_query();
		return $out;
	}
	add_shortcode('pirenko_last_posts', 'pirenko_last_posts_shortcode');
	//LAST COMMENTS
	function pirenko_comments_shortcode( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'title'    	 => 'Latest Comments',
			'items_number'		 => '',
			'css_animation' => '',
			'el_class' => ''
		), $atts));
		if (isset($atts['title']) && $atts['title']!="")
			$title=$atts['title'];
		else
			$title="";
		if (isset($atts['items_number']) && $atts['items_number']!="")
			$items_number = $atts['items_number'];
		else
			$items_number="4";
		$extra_a="";
		if (isset($atts['css_animation']) && $atts['css_animation']!="")
		{
			$extra_a.=" wpb_animate_when_almost_visible wpb_".$atts['css_animation'];
		}
		if (isset($atts['el_class']) && $atts['el_class']!="")
		{
			$extra_a.=" ".$atts['el_class'];
		}
		$temp_str='[decent-comments number="'.$items_number.'" show_avatar="false" max_excerpt_words="80" /]';
		$out = '';
        $out.='<div id="prk_shortcode_latest_cmts" class="prk_shorts twelve cf'.$extra_a.'">';
        if ($title!="") {
			$out.=do_shortcode('[prk_styled_title align="left" text_color="" show_lines="no" use_italic="" title_size="medium"]'.$title.'[/prk_styled_title]');
		};
        $out.=do_shortcode($temp_str);
        $out.='</div>';
		return $out;
	}
	add_shortcode('pirenko_comments', 'pirenko_comments_shortcode');

	//THEME GALLERY
	function pirenko_gallery_shortcode( $atts, $content = null ) 
	{
		global $prk_astro_options;
		global $retina_device;
		global $prk_translations;
		$retina_flag = $retina_device === "prk_retina" ? true : false;
		if (!isset($prk_translations['all_text']))
			$prk_translations['all_text']='All';
		extract(shortcode_atts(array(
			'type'    	=> '',
			'thumbs_mg'	=> '',
			'images' => ''
		), $atts));
		$cols_number="variable";
		$items_number="999";
		if (isset($atts['type']) && $atts['type']!="")
			$layout_type_folio = $atts['type'];
		else
			$layout_type_folio="masonry";
		if (isset($atts['thumbs_mg']) && $atts['thumbs_mg']!="")
			$thumbs_mg = $atts['thumbs_mg'];
		else
			$thumbs_mg="10";
		$arr=explode(",",$images);
    	if (count($arr)>0)
		{
			$rand_nbr=rand(1, 5000);
			$out = '';
            $out.='<div class="recentfolio_ul_wp cf twelve pirenko_gallery">';	
	                $out.='<div id="iso_gallery-'.$rand_nbr.'" class="iso_folio shortcoded samba_iso_gallery" data-columns="'.$cols_number.'" style="margin-right:-'.$thumbs_mg.'px;" data-margin='.$thumbs_mg.'>';
	                        foreach ($arr as $single) {
	                                $image = wp_get_attachment_image_src( $single,'full' );
	                                $magnific_image[0] = $image[0] = get_image_path($image[0]); 
	                                $out.='<div class="portfolio_entry_li" style="margin-bottom:'.$thumbs_mg.'px;" data-mfp-src="'.$magnific_image[0].'">';
	                                    $out.='<div class="grid_image_wrapper">';
	                                        $out.='<div class="prk_magnificent body_bk_color" >';
												$out.='<div class="navicon-expand-2"></div>';
											$out.='</div>';
	                                        $out.='<div class="grid_single_title zero_color bd_headings_text_shadow zero_color">';
	                                        $out.='<div class="prk_ttl"><h3 class="header_font body_bk_color body_bk_text_shadow small">'.get_post($single)->post_title.'</h3></div> ';
	                                        $out.='</div>';
	                                            $out.='<div class="grid_colored_block">';
	                                           $out.='</div>';
												$forced_w=480;
												if ($layout_type_folio=="masonry") {
													$forced_h=0;
													$vt_image = vt_resize( '', $image[0] , $forced_w, $forced_h, false , $retina_flag );
												}
												else if ($layout_type_folio=="squares")
												{
													$forced_h=480;
													$vt_image = vt_resize( '', $image[0] , $forced_w, $forced_h, true , $retina_flag );
												}
												else 
												{
													$forced_h=300;
													$vt_image = vt_resize( '', $image[0] , $forced_w, $forced_h, true , $retina_flag );
												}
	                                            $out.='<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" id="home_fader-'.get_the_ID().'" class="custom-img grid_image" alt="" data-featured="no" />';
	                                    $out.='</div>';
	                                $out.='</div>';
	                            
	                        }
	            $out.='</div>';
			$out.='</div>';
       	}
        else
        {
			$out.= "No content was found!";	
		}
		wp_reset_query();
		return $out;
	}
	add_shortcode('pirenko_gallery', 'pirenko_gallery_shortcode'); 
}

?>