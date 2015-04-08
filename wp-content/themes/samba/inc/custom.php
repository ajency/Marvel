<?php
	
	//GET THEME OPTIONS
	$curr_options = get_option('samba_theme_options');
	//CHECK IF RESET BUTTON WAS PRESSED
	if (isset($_REQUEST['action']))
	{
		if ('reset_samba' == $_REQUEST['action'])
		{
			$curr_options['set_default']="";
		}
	}
	//RESET OPTIONS IF NEEDED
	if ($curr_options['set_default']=="")
	{
		//TURN OFF RESET FLAG
		$curr_options['set_default']="false";
		$curr_options['just_saved']="false";
		
		//GENERAL
		$curr_options['responsive']="true";
		$curr_options['responsive_width']="1100";
		$curr_options['custom_width']="1200";
		$curr_options['ajax_calls']="false";
		$curr_options['pattern']="";
		$curr_options['site_background_color']='#ffffff';
		$curr_options['header_font']="Titillium+Web:400,400italic,600,700,700italic";
		$curr_options['body_font']="PT+Sans:400,700,400italic,700italic";
		$curr_options['uppercase_titles']="no";
		$curr_options['use_custom_colors']="yes";
		$curr_options['active_color']="#0ac2d2";
		$curr_options['inactive_color']="#444444";
		$curr_options['bd_headings_color']="#111111";
		$curr_options['background_color_btns']="#0ac2d2";
		$curr_options['custom_opacity_folio']=90;
		$curr_options['background_color_btns_blog']="#0ac2d2";
		$curr_options['custom_opacity']=75;
		$curr_options['background_color']="#f0f0f0";
		$curr_options['lines_color']="#dedede";
		$curr_options['shadow_color']="#000000";
		$curr_options['custom_shadow']=20;
		$curr_options['theme_buttons_color']="#111111";
		$curr_options['buttons_color']="#111111";
		$curr_options['carousel_text_color']="#ffffff";
		$curr_options['carousel_nav_color']="#111111";
		$curr_options['right_sidebar']="yes";
		$curr_options['bottom_sidebar']="yes";

		//BRANDING
		$curr_options['logo']=get_template_directory_uri().'/images/logo.png';
		$curr_options['alt_logo']=get_template_directory_uri().'/images/alt_logo.png';
		$curr_options['small_logo']='';
		$curr_options['logo_retina']=get_template_directory_uri().'/images/logo-retina.png';
		$curr_options['alt_logo_retina']=get_template_directory_uri().'/images/alt_logo-retina.png';
		$curr_options['small_logo_retina']='';
		$curr_options['favicon']=get_template_directory_uri()."/images/favicon.ico";
		$curr_options['menu_vertical']=36;

		//HEADER
		$curr_options['3d_menu']="true";
		$curr_options['background_color_header']="#1f282d";
		$curr_options['custom_menu_opacity']="100";
		$curr_options['menu_lines_color']="#27373c";
		$curr_options['menu_border_color']="";
		$curr_options['coll_menu_border_color']="";
		$curr_options['menu_active_color']="#ffffff";
		$curr_options['menu_up_color']="#cccccc";
		$curr_options['menu_subheadings_color']="#27373c";
		$curr_options['submenu_color']="#1f282d";

		//FOOTER
		$curr_options['titles_color_footer']="#ffffff";
		$curr_options['body_color_footer']="#b5b5b5";
		$curr_options['lines_color_footer']="#272727";
		$curr_options['background_color_footer']="#0d0d0d";
		$curr_options['show_drop_shadow_footer']="no";
		$curr_options['backgroundft_image']="";
		$curr_options['repeat_bkft']="yes";
		$curr_options['pattern_footer']="dark_mosaic.png";
		$curr_options['color_footer_bar']="#b5b5b5";
		$curr_options['background_color_footer_bar']="#000000";
		$curr_options['footer_text']='Samba for WordPress by <a href="#">Pirenko</a>'; 
		$curr_options['ganalytics_text']="";
		
		//PORTFOLIO
		$curr_options['archives_ptype']='multisize';
		$curr_options['samba_posts_nr']="9";
		$curr_options['portfolio_layout']="half";
		$curr_options['autoplay_portfolio']="true";
		$curr_options['delay_portfolio']="6000";
		$curr_options['folio_enable_lightbox']="yes";
		$curr_options['dateby_port']="yes";
		$curr_options['show_heart_folio']="yes";
		$curr_options['categoriesby_port']="yes";
		$curr_options['related_port']="no";
		$curr_options['share_portfolio']="yes";
		$curr_options['share_portfolio_goo']="true";
		$curr_options['share_portfolio_pin']="true";
		$curr_options['share_portfolio_twt']="true";
		
		//BLOG
		$curr_options['archives_type']='classic';
		$curr_options['forcesize_news']='yes';
		$curr_options['postedby_news']="yes";
		$curr_options['categoriesby_news']="yes";
		$curr_options['show_heart_blog']="yes";
		$curr_options['related_blog']='yes';
		$curr_options['related_author']='yes';
		$curr_options['share_blog']="yes";
		$curr_options['share_blog_goo']="true";
		$curr_options['share_blog_pin']="true";
		$curr_options['share_blog_twt']="true";
		
		//CONTACT
		$curr_options['email_address']='samba@mail.com';
		$curr_options['contact-info_title_body']='A good team';
		$curr_options['contact-body']='';
		$curr_options['contact-info_title_form']='Want to talk? We are all ears...';
		$curr_options['contact-shortcode']='';
		$curr_options['contact-info_title']='Get in touch';
		$curr_options['contact-right_header']='Samba Company & Stuff, Ltd';
		$curr_options['contact-address']='Lorem Ipsum Street, nr. 23 - 2nd floor<br>1234 London City - ENGLAND';
		$curr_options['contact-info_tel_h']='Telephone:';
		$curr_options['contact-info_tel']='+1 234 567 890';
		$curr_options['contact-info_fax_h']='Fax:';
		$curr_options['contact-info_fax']='+1 098 765 432';
		$curr_options['contact-info_email_h']='Email:';
		$curr_options['contact-info_email']='samba@mail.com';
		$curr_options['google-maps']='<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msa=0&amp;msid=217545660865479534545.0004d9ebc5fb990598c5d&amp;ie=UTF8&amp;t=m&amp;z=17&amp;output=embed"></iframe>';

		//TRANSLATIONS
		$curr_options['theme_translation']='no';
		$curr_options['404_title_text']='Page not found';
		$curr_options['404_body_text']='We do not know how you ended up here, but please could you try again by selecting an option on the menu?';
		$curr_options['search_tip_text']='Search this website...';
		$curr_options['submit_search_res_title']='Search Results for';
		$curr_options['submit_search_no_results']='No Results Found';
		$curr_options['load_more']='LOAD MORE POSTS';
		$curr_options['no_more_text']='NO MORE POSTS TO SHOW';
		$curr_options['required_text']=' (required)';
		$curr_options['like_text']='I like this!';
		$curr_options['already_liked_text']='You already liked this.';
		$curr_options['share_text']='Share on';
		$curr_options['in_touch_text']='Get In Touch';
		$curr_options['to_portfolio']='To Portfolio';
		$curr_options['launch_text']='Launch Project';
		$curr_options['skills_text']='Skills';
		$curr_options['client_text']='Client';
		$curr_options['date_text']='Date';
		$curr_options['related_text']='Related Projects';
		$curr_options['all_text']='All';
		$curr_options['to_blog']='To Blog';
		$curr_options['read_more']='Read More';
		$curr_options['sticky_text']='Sticky Post';
		$curr_options['posted_by_text']='by';
		$curr_options['about_author_text']='About';
		$curr_options['comments_label']='Comments'; 
		$curr_options['comments_no_response']='No comments'; 
		$curr_options['comments_one_response']='1 comment'; 
		$curr_options['comments_oneplus_response']='comments'; 
		$curr_options['reply_text']='Reply'; 
		$curr_options['comments_leave_reply']='Leave a Comment'; 
		$curr_options['comments_author_text']='Name'; 
		$curr_options['comments_email_text']='Email'; 
		$curr_options['comments_url_text']='Website';
		$curr_options['comments_comment_text']='Your comment';  
		$curr_options['comments_submit']='Submit Comment';
		$curr_options['empty_text_error']='Error! This field is required.';
		$curr_options['invalid_email_error']='Error! Invalid email.';
		$curr_options['comment_ok_message']='Thank you for your feedback!';
		$curr_options['contact_subject_text']='Subject';
		$curr_options['contact_message_text']='Your Message';
		$curr_options['contact_submit']='Send Message';
		$curr_options['contact_error_text']='Error! This field is required.';
		$curr_options['contact_error_email_text']='Error! This email is not valid.';
		$curr_options['contact_wait_text']='Please wait...';
		$curr_options['contact_ok_text']='Thank you for contacting us. We will reply soon!';
		
		//CUSTOM SCRIPTS
		$curr_options['css_text']="";
		$curr_options['js_text']="";

		//WOOCOMMERCE
		$curr_options['woo_sidebar_display']="yes";
		$curr_options['woo_cart_display']="cart";
		$curr_options['woo_cart_always_display']="no";
		$curr_options['woo_cart_info']="both";

		//ADVANCED
		$curr_options['slides_slug']="slides";
		$curr_options['groups_slug']="group";
		$curr_options['members_slug']="member";
		$curr_options['team_slug']="team";
		$curr_options['portfolio_slug']="portfolios";
		$curr_options['skills_slug']="skills";
		$curr_options['folio_tags_slug']="tagged";
		
		//UPDATE OPTIONS
		update_option('samba_theme_options', $curr_options );
	}
	
?>