/* jshint ignore:start */ 
function samba_init() {
	//FUNCTION TO CONVERT NUMBERS TO TEXT - RESPONSIVE COLUMN SIZES
	"use strict";
	//HEXADECIMAL TO RGB:#CCCCCC=>rgb(204,204,204)
	function hex2rgb(hexStr,alpha) {
		var hex = parseInt(hexStr.substring(1), 16);
		var r = (hex & 0xff0000) >> 16;
		var g = (hex & 0x00ff00) >> 8;
		var b = hex & 0x0000ff;
		return "rgba("+[r, g, b]+","+alpha+")";
	}
	//FUNCTION TO DETECT IF A TOUCH DEVICE IS IN USE
	function is_mobile() {
		var check = false;
		(function(a){
			if((/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase())) || /(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a.toLowerCase())||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4).toLowerCase())){check = true;}})(navigator.userAgent||navigator.vendor||window.opera);
		return check;
	}
	var ajax_calls = theme_options.ajax_calls==="true" ? true : false;
	if (is_mobile()) {
		var eventtype='touchstart';
		var samba_on_mobile=true;
		jQuery('body').addClass('samba_on_mobile');
	}
	else {
		var eventtype='click';
		var samba_on_mobile=false;
	}
	var stop_verification=false;
	var admin_bar_height=0;
	var prk_sensi="";
	var prk_panel_event="";
	if (jQuery('.samba_theme.admin-bar').length) {
		admin_bar_height=32;
	}
	function textize(m_nb) {
		if (m_nb===1) {
			return "one";}
		if (m_nb===2){
			return "two";}
		if (m_nb===3){
			return "three";}
		if (m_nb===4){
			return "four";}
		if (m_nb===5){
			return "five";}
		if (m_nb===6){
			return "six";}
		if (m_nb===7){
			return "seven";}
		if (m_nb===8){
			return "eight";}
		if (m_nb===9){
			return "nine";}
		if (m_nb===10){
			return "ten";}
		if (m_nb===11){
			return "eleven";}
		if (m_nb===12){
			return "twelve";}
	}
	function isScrolledIntoView(elem) {
		var docViewTop = jQuery(window).scrollTop();
		var docViewBottom = docViewTop + jQuery(window).height();
	
		var elemTop = jQuery(elem).offset().top;
		var elemBottom = elemTop + jQuery(elem).height();
	
		return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
	}
	var original_active_color=theme_options.active_color;
	var is_iphone = navigator.userAgent.toLowerCase().indexOf("iphone");
	if (jQuery('html').hasClass('no-csstransforms3d')) {
		jQuery('#st-container').addClass('no-csstransforms3d');
	}	
	//SHARING FUNCTIONS
	function prk_init_sharrre() {
		jQuery('.prk_sharrre_twitter').sharrre({
			share: {
			twitter: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#43b3e5" title="'+theme_options.share_text+' Twitter"><div class="share"><div class="icon-twitter"></div></div><div class="share_colored_bg"></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			//buttons: { twitter: {via: 'username'}},
			click: function(api) {
				api.simulateClick();
				api.openPopup('twitter');
			},
			render: function(api){
				jQuery(".prk_sharrre_twitter a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'bottom-right',
					offsetY:-12,
					offsetX:-13
				});
			}
		});
		jQuery('.prk_sharrre_facebook').sharrre({
			share: {
				facebook: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#1f69b3" title="'+theme_options.share_text+' Facebook"><div class="share"><div class="icon-facebook"></div></div><div class="share_colored_bg"></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('facebook');
			},
			render: function(api){
				jQuery(".prk_sharrre_facebook a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'bottom-right',
					offsetY:-12,
					offsetX:-13
				});
			}
		});
		jQuery('.prk_sharrre_google').sharrre({
			share: {
				googlePlus: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#222222" title="'+theme_options.share_text+' Google +"><div class="share"><span></span><div class="icon-gplus"></div></div><div class="share_colored_bg"></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('googlePlus');
			},
			render: function(api){
				jQuery(".prk_sharrre_google a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'bottom-right',
					offsetY:-12,
					offsetX:-13
				});
			}
		});
		var pinterestMedia="";
		jQuery('.prk_sharrre_pinterest').sharrre({
			share: {
				pinterest: true
			},
			buttons: {
				pinterest: {
				media: pinterestMedia,
				description: ''
				}   
			},
			template: '<a class="box social_tipped" href="#" data-color="#df2126" title="'+theme_options.share_text+' Pinterest"><div class="share"><span></span><div class="icon-pinterest"></div></div><div class="share_colored_bg"></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('pinterest');
			},
			render: function(api){
				jQuery(".prk_sharrre_pinterest a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'bottom-right',
					offsetY:-12,
					offsetX:-13
				});
			}
		});
		jQuery('.prk_sharrre_linkedin').sharrre({
			share: {
				linkedin: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#1a7696" title="'+theme_options.share_text+' LinkedIn"><div class="share"><div class="icon-linkedin"></div></div><div class="share_colored_bg"></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('linkedin');
			},
			render: function(api){
				jQuery(".prk_sharrre_linkedin a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'bottom-right',
					offsetY:-12,
					offsetX:-13
				});
			}
		});
		jQuery('.prk_sharrre_stumbleupon').sharrre({
			share: {
				stumbleupon: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#ef4e23" title="'+theme_options.share_text+' Stumbleupon"><div class="share"><div class="icon-stumbleupon"></div></div><div class="share_colored_bg"></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('stumbleupon');
			},
			render: function(api){
				jQuery(".prk_sharrre_stumbleupon a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'bottom-right',
					offsetY:-12,
					offsetX:-13
				});
			}
		});
		jQuery('.prk_sharrre_delicious').sharrre({
			share: {
				delicious: true
			},
			template: '<a class="box social_tipped" href="#" data-color="#3274d1" title="'+theme_options.share_text+' Delicious"><div class="share"><div class="icon-delicious"></div></div><div class="share_colored_bg"></div></a><div class="count prk_sharrre_count" href="#">{total}</div>',
			enableHover: false,
			enableTracking: false,
			click: function(api) {
				api.simulateClick();
				api.openPopup('delicious');
			},
			render: function(api){
				jQuery(".prk_sharrre_delicious a.social_tipped").tooltipster({
					touchDevices:false,
					theme:'tooltipster-light',
					position:'bottom-right',
					offsetY:-12,
					offsetX:-13
				});
			}
		});
		jQuery('.prk_sharrre_pinterest').live('mouseover', function() { 
			jQuery('#prk_pint').attr('data-media',jQuery(this).attr('data-media'));
		});
	}
	//PARENT LINKS
	jQuery('#menu_section .sf-menu>li>a').hover(function() {
		if (is_mobile()===false) {
			if(!jQuery('#menu_section').hasClass('under_logo')) {
				jQuery(this).stop().transition({
					delay:100,
					backgroundColor:theme_options.menu_subheadings_color,
					color:theme_options.menu_active_color,
					duration:150
				});
				jQuery(this).children('.prk_menu_square').stop().animate({
						width:14
					},
					{
						easing:'easeOutQuad',
						duration:200
					}
				);
			}
		}
	},
	function() {
		if((!jQuery('#menu_section').hasClass('under_logo') && !jQuery(this).parent().hasClass('active') && !jQuery(this).parent().hasClass('active_father')) || (jQuery(this).parent().children('.sub-menu').children('li.active').length>0 && !jQuery(this).parent().hasClass('active_father'))) {
			jQuery(this).stop().transition({
				backgroundColor:theme_options.submenu_color,
				color:theme_options.menu_up_color,
				duration:150
			});
			jQuery(this).children('.prk_menu_square').stop().animate({
				backgroundColor:jQuery(this).attr('data-color'),
				width:8,
			},
			{
				easing:'easeOutQuad',
				duration:200
			});
		}
	});
	//SUBMENU LINKS
	jQuery('#menu_section .sub-menu>li>a').hover(
	function() {
		if (is_mobile()===false) {
			if(!jQuery('#menu_section').hasClass('under_logo')) {
				jQuery(this).stop().transition({
					backgroundColor:theme_options.menu_subheadings_color,
					color:theme_options.menu_active_color,
					duration:150
				});
				jQuery(this).children('.prk_menu_square').stop().animate({
						width:14,
						backgroundColor:jQuery(this).attr('data-color'),
					},
					{
						easing:'easeOutQuad',
						duration:200
					}
				);
			}
		}
	},
	function() {
		if(!jQuery('#menu_section').hasClass('under_logo') && !jQuery(this).parent().hasClass('active')) {
			jQuery(this).stop().transition({
				backgroundColor:theme_options.submenu_color,
				color:theme_options.menu_up_color,
				duration:150
			});
			jQuery(this).children('.prk_menu_square').stop().animate({
				width:8,
			},
			{
				easing:'easeOutQuad',
				duration:200
			});
		}
	});
	//ADD ELEMENTS TO SUBMENUS
	jQuery('.sf-menu ul.sub-menu').each(function() 
	{
		jQuery(this).addClass('clearfix'); 
		jQuery(this).parent().children('a').prepend('<div class="prk_btm_square icon-plus"></div>');
	});
	jQuery('.sf-menu ul.sub-menu>li>a').each(function() {
		jQuery(this).html('<div class="icon-right-open-mini"></div>'+' '+jQuery(this).html());
	});

	//CHECK FOR CART TEXT
	var prk_cart_txt="";
	if (jQuery('#prk_hidden_cart').length) {
		prk_cart_txt=jQuery('#prk_hidden_cart').find('.prk_cart_label').text();
	}

	function activate_menu_links() {
		//CHECK IF THERE'S A PARENT PAGE THAT HAS AN ACTIVE SUBPAGE
		jQuery('#nav-main ul.sf-menu>li.active ul.sub-menu li.active').each(function() {
			jQuery(this).parent().parent().removeClass('active');
		});
		//HIGHLIGHT BLOG OR PORTFOLIO IF NEEDED
		jQuery('#nav-main ul li a').each(function() {
			if (jQuery(this).attr('data-color')!==undefined && theme_options.use_custom_colors==="yes") {
				jQuery(this).prepend('<div class="prk_menu_square"></div>');
				jQuery(this).find('.prk_menu_square,.samba_viewie').css({'background-color':jQuery(this).attr('data-color')});
			}
			else {
				jQuery(this).prepend('<div class="prk_menu_square"></div>');
				jQuery(this).find('.prk_menu_square').css({'background-color':theme_options.active_color});
				jQuery(this).attr('data-color',theme_options.active_color);
			}
			jQuery(this).addClass('fade_anchor_menu');
		});
		update_menu(jQuery(location).attr('href'));
	}
	activate_menu_links();

	//BLOG ISOTOPE FUNCTIONS
	var $container_blog = jQuery('#blog_entries_masonr');
	function rearrange_cols() {
		var columns = Math.ceil(($container_blog.width())/parseInt(jQuery('#blog_entries_masonr').attr('data-max-width'),10));
		var entry_width = $container_blog.width()/columns;
		entry_width = Math.floor(entry_width);
		//FORCE COLUMNS TO HAVE A MINIMUM SIZE
		if (entry_width<parseInt(jQuery('#blog_entries_masonr').attr('data-min-width'),10)) {
			columns--;	
		}
		entry_width = ($container_blog.width())/columns;
		entry_width = Math.floor(entry_width);
		jQuery(".blog_entry_li").each(function() {
			jQuery(this).css({"width":entry_width});
			jQuery(this).find('.blog_fader_grid').height(jQuery(this).find('.grid_image').height());
		});
	}
	function rearrange_layout() {
		var winWidth = jQuery(window).width();
		rearrange_cols();
		$container_blog.isotope('reLayout',function(){
			//DELAY CALCULATIONS IF WE ARE SCALING DOWN THE STAGE
			if(jQuery(window).width() !== winWidth) {
				setTimeout(function(){ rearrange_layout();},10);
			}
		});
	}
	function init_blog() {
		if (jQuery('.recentposts_ul_shortcode').length) {
			jQuery('.recentposts_ul_shortcode .featured_color').each(function() {
				jQuery(this).find('.not_zero_color').stop().css({'color':jQuery(this).attr('data-color')});
				jQuery(this).find('.theme_button a,.theme_button input').stop().css({'background-color':jQuery(this).attr('data-color')});
				jQuery(this).find('.theme_button a,.theme_button input,.theme_button_inverted a,.zero_color a,.default_color a').attr('data-color',jQuery(this).attr('data-color'));
				jQuery(this).find('.masonr_img_wp,.video-container,.soundcloud-container').stop().css({'border-top':'6px solid '+jQuery(this).attr('data-color')});
				jQuery(this).find('.blog_fader_grid').stop().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.custom_opacity)});
			});
		}
		if (jQuery('#blog_entries_masonr').length) {
			jQuery('#blog_entries_masonr').fitVids();
			$container_blog = jQuery('#blog_entries_masonr');
			jQuery('#blog_entries_masonr').imagesLoaded(function() {
				NProgress.done();
				$container_blog.isotope({
					itemSelector : '.blog_entry_li',
					resizable: false,
					transformsEnabled: false
				},
				function() {
					setTimeout(function(){ 
						jQuery(window).trigger("debouncedresize");
						jQuery('#blog_entries_masonr').delay(200).animate({
							opacity:1
						}, 
						{
							easing:'linear',
							duration:300
						});
					},50);
				});
				jQuery('#blog_entries_masonr .featured_color').each(function() {
					jQuery(this).find('.not_zero_color').stop().css({'color':jQuery(this).attr('data-color')});
					jQuery(this).find('.theme_button a').stop().css({'background-color':jQuery(this).attr('data-color')});
					jQuery(this).find('.theme_button a,.theme_button_inverted a,.zero_color a,.default_color a').attr('data-color',jQuery(this).attr('data-color'));
					jQuery(this).find('.masonr_img_wp,.video-container,.soundcloud-container').css({'border-top':'6px solid '+jQuery(this).attr('data-color')});
					jQuery(this).find('.blog_fader_grid').stop().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.custom_opacity)});
				});
			}); 
		}
		if (jQuery('#classic_blog_section').length) {
			jQuery('#classic_blog_section').fitVids();
			jQuery('#classic_blog_section .featured_color').each(function() {
				jQuery(this).find('.not_zero_color').stop().css({'color':jQuery(this).attr('data-color')});
				jQuery(this).find('.theme_button a').stop().css({'background-color':jQuery(this).attr('data-color')});
				jQuery(this).find('.theme_button a,.theme_button_inverted a,.zero_color a,a.zero_color,.default_color a').attr('data-color',jQuery(this).attr('data-color'));
				jQuery(this).find('.prk_titlify_father h3').stop().css({'border-bottom':'4px solid '+jQuery(this).attr('data-color')});
				jQuery(this).find('.blog_content').stop().css({'border-top':'6px solid '+jQuery(this).attr('data-color')});
				jQuery(this).find('.blog_fader_grid').stop().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.custom_opacity)});
			});
			jQuery('#classic_blog_section').imagesLoaded(function() {
				NProgress.done();
				jQuery('#classic_blog_section').delay(200).animate({
					opacity:1
				}, 
				{
					easing:'linear',
					duration:300
				});
			});
		}
		if (jQuery('#single_blog_content.featured_color').length) {
			jQuery('#single_blog_content.featured_color').each(function() {
				jQuery(this).find('.not_zero_color,.not_zero_color a').stop().css({'color':jQuery(this).attr('data-color')});
				jQuery(this).find('.blog_fader_grid').stop().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.custom_opacity)});
				jQuery(this).find('.theme_button a,.prk_blockquote.colored_background,.tiny_line,.wpb_tour .ui-state-active, .wpb_tour .ui-widget-content .ui-state-active, .wpb_tour .ui-widget-header .ui-state-active,  .wpb_tour .ui-tabs .ui-tabs-nav li.ui-state-active, .wpb_tabs .ui-tabs-nav .ui-state-active, .wpb_tabs .ui-tabs-nav .ui-widget-content .ui-state-active, .wpb_tabs .ui-tabs-nav .ui-widget-header .ui-state-active, .wpb_tabs .ui-tabs-nav .ui-tabs .ui-tabs-nav li.ui-state-active,.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header,.prk_accordion .ui-accordion-header').not('#author_area.prk_blockquote.colored_background').css({'background-color':jQuery(this).attr('data-color')});
				jQuery(this).find('.wpb_tabs_nav>li,.theme_button a,.theme_button_inverted a,.zero_color a,a.zero_color,.default_color a,a.default_color').attr('data-color',jQuery(this).attr('data-color'));
				jQuery(this).find('.wpb_tabs .ui-tabs .ui-tabs-panel').css({'border-top':'4px solid '+jQuery(this).attr('data-color')});
				jQuery(this).find('.prk_titlify_father h3,.prk_titlify_father.ft_large>div.header_font,.prk_titlify_father.ft_medium>div.header_font,.prk_titlify_father.ft_small>div.header_font').stop().css({'border-bottom':'4px solid '+jQuery(this).attr('data-color')});
				jQuery(this).find('.blog_content').stop().css({'border-top':'6px solid '+jQuery(this).attr('data-color')});
			});
			jQuery('#sidebar .prk_titlify_father .widget-title').css({'border-bottom':'4px solid '+jQuery('#single_blog_content.featured_color').attr('data-color')});
			jQuery('#nprogress .bar,.theme_button input').stop().css({'background-color':jQuery('#single_blog_content.featured_color').attr('data-color')});
			jQuery("#sidebar,.theme_button input").attr('data-color',jQuery('#single_blog_content.featured_color').attr('data-color'));
			jQuery('#top_bar_wrapper,#nav-collapsed-icon .prk_menu_block').animate({'background-color':jQuery('#single_blog_content.featured_color').attr('data-color')}, 500);
			jQuery('#menu_section .prk_titlify_father .widget-title').stop().animate({'borderBottomColor':'4px solid '+jQuery('#single_blog_content.featured_color').attr('data-color')}, 500);
			jQuery('#menu_section .not_zero_color,#back_to_top,#samba_collapse_menu,#back_to_top-collapsed,#sidebar .not_zero_color').stop().delay(50).animate({'color':jQuery('#single_blog_content.featured_color').attr('data-color')}, 500);
		}
		jQuery('.video-container,.soundcloud-container').css({opacity:1});
	}
	function init_member() {
		if (jQuery('.member_ul').length) {
			jQuery('.member_ul li').each(function() {
				if (jQuery('this').attr('data-color')!=="default") {
					jQuery(this).find('.tiny_line').css({'background-color':jQuery(this).attr('data-color')});
					jQuery(this).find('.zero_color a,.default_color a').attr({'data-color':jQuery(this).attr('data-color')});
				}
			});
		}
		if (jQuery('#member_full_row').length && jQuery('#member_full_row').attr('data-color')!=="default") {
			jQuery('#member_full_row .prk_button_like,#member_full_row .prk_blockquote.colored_background,.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header').css({'background-color':jQuery('#member_full_row').attr('data-color')});
			jQuery('#member_full_row  .prk_titlify_father h6,.prk_titlify_father .prk_vc_title').css({'border-bottom':'4px solid '+jQuery('#member_full_row').attr('data-color')});
			jQuery('#members_nav .zero_color a').attr({'data-color':jQuery('#member_full_row').attr('data-color')});
			jQuery('#menu_section .not_zero_color,#back_to_top,#samba_collapse_menu,#back_to_top-collapsed,#sidebar .not_zero_color').stop().animate({'color':jQuery('#member_full_row').attr('data-color')}, 500);
			jQuery('#nav-collapsed-icon .prk_menu_block').animate({'background-color':jQuery('#member_full_row').attr('data-color')}, 500);
		}
	}

	//PORTFOLIO ISOTOPE FUNCTIONS
	var $container="";
	var grid_helper="";
	var portfolio_gutter=0;
	var curr_filter="p_all";
	//FILTER FUNCTIONS
	function calculate_filters() {
		if (jQuery('#folio_masonry').length) {
			portfolio_gutter=parseInt(jQuery('#folio_masonry').attr('data-margin'),10);
			jQuery('#folio_masonry .portfolio_entry_li').css({'margin-bottom':Math.floor(portfolio_gutter/2)});
			jQuery('#pir_categories ul.filter li a').each(function() {
				var classes = jQuery(this).attr("data-filter").split(" "); 
				var in_counter=0;
				jQuery('#folio_masonry>div').each(
				function()
				{
					if (jQuery(this).hasClass(classes)) {
						in_counter++;
					}
				});
				jQuery(this).attr("data-q_counter",in_counter);
			});
		}
		if (jQuery('#folio_titled').length) {
			portfolio_gutter=parseInt(jQuery('#folio_titled').attr('data-margin'),10);
			jQuery('#folio_titled .portfolio_entry_li').css({'margin-bottom':Math.floor(portfolio_gutter/2)});
			jQuery('#pir_categories ul.filter li a').each(function() {
				var classes = jQuery(this).attr("data-filter").split(" "); 
				var in_counter=0;
				jQuery('#folio_titled>div').each(
				function()
				{
					if (jQuery(this).hasClass(classes)) {
						in_counter++;
					}
				});
				jQuery(this).attr("data-q_counter",in_counter);
			});
		}
	}
	calculate_filters();
	var first_cross=true;
	function init_portfolio() {
		jQuery('#pir_categories ul.filter li a').live().click(function(e) {
			e.preventDefault();
			jQuery('#pir_categories ul.filter li.active a').stop().transition({
				backgroundColor:'',
				color:theme_options.site_background_color,
				duration:300
			});
			jQuery('#pir_categories ul.filter li').removeClass('active');
			curr_filter = jQuery(this).attr('data-filter').split(' ');
			jQuery(this).parent().addClass('active');
			jQuery(this).stop().transition({
				backgroundColor:theme_options.site_background_color,
				color:theme_options.active_color,
				duration:300
			});
			setTimeout(function(){ jQuery(window).trigger( "smartresize");},0);
			$container.isotope({
				filter: '.'+curr_filter
			});
		});
		jQuery('#pir_categories ul.filter li a').live().hover(
		function() {
			if (is_mobile()===false) {
				jQuery(this).stop().transition({
					backgroundColor:theme_options.site_background_color,
					color:theme_options.active_color,
					duration:300
				});
			}
		},
		function() {
			if (!jQuery(this).parent().hasClass('active')) {
				jQuery(this).stop().transition({
					backgroundColor:'',
					color:'',
					duration:300
				});
			}
		});
		//PORTFOLIO SHORTCODE
		jQuery('.scode_categories .filter li a').live().hover(
		function() {
			if (is_mobile()===false) {
				jQuery(this).stop().transition({
					backgroundColor:theme_options.active_color,
					color:theme_options.site_background_color,
					duration:300
				});
			}
		},
		function() {
			if (!jQuery(this).parent().hasClass('active')) {
				jQuery(this).stop().transition({
					backgroundColor:'',
					color:'',
					duration:300
				});
			}
		});
		jQuery('.scode_categories .filter li a').live().click(function(e) {
			if (!jQuery(this).hasClass('pf_link')) {
				e.preventDefault();
				jQuery('.scode_categories .filter li.active a').stop().transition({
					backgroundColor:'',
					color:'',
					duration:300
				});
				jQuery('.scode_categories .filter li').removeClass('active');
				jQuery(this).stop().transition({
					backgroundColor:theme_options.site_background_color,
					color:theme_options.active_color,
					duration:300
				});
				curr_filter = jQuery(this).attr('data-filter').split(' ');
				jQuery(this).parent().addClass('active');
				setTimeout(function(){ jQuery(window).trigger( "smartresize");},0);
				$container.isotope({
					filter: '.'+curr_filter
				});
			}
		});
		//RELATED PORTFOLIO POSTS CAROUSEL
		if (jQuery('#carousel_single').length) {
			var $size_helper=4;
			if ($js_flexislider('#carousel_single li').size()<$size_helper) {
				$size_helper=$js_flexislider('#carousel_single li').size();
			}
			jQuery('#carousel_single').elastislide({
				imageW:606,
				minItems:$size_helper,
				margin:1
			});
			jQuery('.related_post').hover(function() {
				jQuery(this).find('.grid_colored_block').stop();
				jQuery(this).find('.grid_image').stop();
				jQuery(this).find('.grid_single_title .inner_skills').stop();
				var dif=0;
				//ADJUST TITLE VERTICALLY
				if (jQuery(this).find('.grid_single_title .inner_skills').length) {
					dif=jQuery(this).find('.grid_single_title').height()-4;
				}
				if (jQuery(this).hasClass('featured_color')) {
					jQuery(this).find('.grid_colored_block').css({'background-color':hex2rgb(jQuery(this).attr('data-color'),theme_options.custom_opacity_folio)});
				}
				else {
					jQuery(this).find('.grid_colored_block').css({'background-color':hex2rgb(theme_options.active_color,theme_options.custom_opacity_folio)});
				}
				//jQuery(this).find('.grid_single_title .prk_ttl').css({'margin-top':'-10px'});
				jQuery(this).find('.grid_single_title .inner_skills').css({'top':dif});
				jQuery(this).find('.grid_image').animate({
					scale:1.2
				},300);
				jQuery(this).find('.grid_colored_block').transition({
					opacity:1
				},300);
				jQuery(this).find('.grid_single_title').transition({
					opacity: 1
				},300);
			},
			function() {
				jQuery(this).find('.grid_colored_block').stop();
				jQuery(this).find('.grid_single_title').stop();
				jQuery(this).find('.grid_single_title').stop().transition({
					opacity: 0
				},300);
				jQuery(this).find('.grid_image').stop().animate({
					scale:1
				},300);
				jQuery(this).find('.grid_colored_block').stop().delay(0).transition({
					duration:300,
					opacity:0
				});
			});
		}
		if (jQuery('.samba_iso_gallery').length) {
			jQuery('.samba_iso_gallery').each(function() {
				var iso_gallery_gutter=parseInt(jQuery(this).attr('data-margin'),10);
				jQuery(this).css({'margin-left':iso_gallery_gutter});
				jQuery(this).css({'margin-top':iso_gallery_gutter});
				jQuery(this).find('.portfolio_entry_li').css({'margin-bottom':Math.floor(iso_gallery_gutter/2)});
				var $container_gals = jQuery('#'+jQuery(this).attr('id'));
				$container_gals.imagesLoaded( function() {
					NProgress.done();
					first_cross=true;
					$container_gals.css({'display':'block','opacity':0});
					var img_nr=2;
					if ($container_gals .attr('data-columns')==="variable") {
						img_nr=Math.ceil($container_gals.width()/430);
					}
					else {	
						img_nr=jQuery('.samba_iso_gallery').attr('data-columns');
					}
					var helper= Math.floor($container_gals.width() / img_nr);
					$container_gals.isotope({
						itemSelector : '.portfolio_entry_li',
						resizable: false, // disable normal resizing
						// set columnWidth to a percentage of container width
						masonry: { columnWidth: $container_gals.width() / img_nr },
						transformsEnabled : false,
						animationEngine : "jquery"
						},
						function() {
							$container_gals.find('.portfolio_entry_li,.inset_shadow,.prk_overlayer').css({'width':helper});
							$container_gals .delay(200).animate({
								opacity:1
							}, 
							{
								easing:'linear',
								duration:300
							});
							//NO 1 PIXEL SPACING SOMETIMES!
							setTimeout(function(){ jQuery(window).trigger( "smartresize");},10);
						});
				});
				jQuery(window).smartresize(function() {
					//SET THE NUMBER OF IMAGES TO SHOW
					var img_nr=2;
					if (jQuery(window).width()<(768 - scrollbar_width)) {
						
						if (jQuery(window).width()<(420 - scrollbar_width)) {
							img_nr=1;
						}
					}
					else 
					{
						if ($container_gals.attr('data-columns')==="variable") {
							img_nr=Math.ceil($container_gals.width()/430);
						}
						else {	
							img_nr=$container_gals.attr('data-columns');
						}
					}
					$container_gals.find('.portfolio_entry_li').css({'width':'auto'});
					var helper= Math.floor($container_gals.width() / img_nr);
					$container_gals.find('.portfolio_entry_li,.portfolio_entry_li img').css({'width':helper});
					$container_gals.isotope({
						animationOptions: {
						duration: first_cross === true ? 10 : 450,
						easing:'linear',
					},
						// update columnWidth to a percentage of container width
						masonry: { columnWidth: Math.floor($container_gals.width() / img_nr) }
					},
					function() {

					});
					//TRICK TO MAKE SURE THE FILTER WORKS
					if (curr_filter!=="p_all" && jQuery('#folio_father.dyn_loaded').length) {
						$container_gals.isotope({
							filter: '.p_all'
						});
						$container_gals.isotope({
							filter: '.'+curr_filter
						});
					}
					$container_gals.find('.portfolio_entry_li,.inset_shadow,.prk_overlayer').css({'width':helper-iso_gallery_gutter});
					first_cross=false;
				});
			});
		}
		if (jQuery('#folio_masonry').length) {
			jQuery('#folio_masonry').css({'margin-left':portfolio_gutter,'margin-top':portfolio_gutter});
			jQuery('#folio_masonry .portfolio_entry_li').css({'margin-bottom':Math.floor(portfolio_gutter),'margin-right':Math.floor(portfolio_gutter)});
			var $container = jQuery('#folio_masonry');
			$container.imagesLoaded( function() {
				NProgress.done();
				first_cross=true;
				jQuery('.portfolio_entry_li img').each(function() 
				{
					if (grid_helper==="" && jQuery(this).attr('data-featured')==="no") {
						grid_helper=jQuery(this).parent().parent().parent().attr('id');
					}
                });
				jQuery('#folio_masonry').css({'display':'block'});
				var img_nr=2;
				if (jQuery('#folio_masonry').attr('data-columns')==="variable") {
					img_nr=Math.ceil($container.width()/430);
				}
				else {	
					img_nr=jQuery('#folio_masonry').attr('data-columns');
				}
				var helper= Math.floor($container.width() / img_nr);
				$container.isotope({
					itemSelector : '.portfolio_entry_li',
					resizable: false, // disable normal resizing
					// set columnWidth to a percentage of container width
					masonry: { columnWidth: $container.width() / img_nr },
					transformsEnabled : false,
					animationEngine : "jquery"
				});
				setTimeout(function(){
					jQuery('.portfolio_entry_li,.inset_shadow,.prk_overlayer').css({'width':helper});
					jQuery('#folio_father').delay(200).animate({
						opacity:1
					}, 
					{
						easing:'linear',
						duration:300
					});
				},10);
				setTimeout(function(){
					jQuery(window).trigger( "smartresize");
				},50);
				jQuery('#folio_father').css({'min-height':jQuery(window).height()});
			});
			jQuery(window).smartresize(function() {
				//SET THE NUMBER OF IMAGES TO SHOW
				var img_nr=2;
				if (jQuery(window).width()<(768 - scrollbar_width) && theme_options.resp_mode==="true") {
					
					if (jQuery(window).width()<(401 - scrollbar_width)) {
						img_nr=1;
					}
				}
				else 
				{
					if (jQuery('#folio_masonry').attr('data-columns')==="variable") {
						img_nr=Math.ceil($container.width()/430);
					}
					else {	
						img_nr=jQuery('#folio_masonry').attr('data-columns');
					}
				}
				jQuery('.portfolio_entry_li').css({'width':'auto'}); 
				var helper= Math.floor($container.width() / img_nr);
				jQuery('.portfolio_entry_li,.portfolio_entry_li img').css({'width':helper});
				jQuery('.portfolio_entry_li img').each(function() 
				{
					if (jQuery(this).attr('data-featured')==="yes") {
						jQuery(this).height(parseInt(jQuery('#'+grid_helper).height()*2+portfolio_gutter,10));
					}
                });
                jQuery('.portfolio_entry_li,.inset_shadow,.prk_overlayer').css({'width':helper-Math.floor(portfolio_gutter)});
				$container.isotope({
					animationOptions: {
					duration: first_cross === true ? 10 : 450,
					easing:'linear',
				},
					// update columnWidth to a percentage of container width
					masonry: { columnWidth: Math.floor($container.width() / img_nr) }
				});
				//TRICK TO MAKE SURE THE FILTER WORKS
				if (curr_filter!=="p_all" && jQuery('#folio_father.dyn_loaded').length) {
					$container.isotope({
						filter: '.p_all'
					});
					$container.isotope({
						filter: '.'+curr_filter
					});
				}
				
				first_cross=false;
			});
		}
		if(jQuery('#folio_carousel.samba_opener').length) {
			var $ac_container = jQuery('#folio_carousel');
			$ac_container.find('.titled_block .grid_single_title>a').each(function() {
				if (jQuery(this).attr('data-color')!=="default" && jQuery(this).attr('data-color')!==undefined) {
					jQuery(this).parent().parent().css({'background-color':hex2rgb(jQuery(this).attr('data-color'),parseInt(theme_options.carousel_background_opacity,10)/100)});
				}	
			});
			jQuery('#folio_carousel.samba_opener').imagesLoaded(function() {
				NProgress.done();
				if (prk_panel_event==="click") {
					jQuery('.prk_panel_lnk').removeClass('fade_anchor');
					jQuery(".prk_panel_lnk").click(function() {
						event.preventDefault();
					});
				}
				jQuery('#folio_carousel').accordionSlider({
					width:'100%',
					height: '100%',
					shadow: true,
					autoplay:false,
					visiblePanels:jQuery('#folio_carousel').attr('data-columns'),
					mouseDelay:100,
					openPanelDuration:500,
					closePanelDuration:500,
					mouseWheelTarget: 'page',
					startPanel:-1,
					maxOpenedPanelSize:'60%',
					openPanelOn:prk_panel_event,
					panelOverlap:false,
					panelOpenComplete: function(event) {
						var panel_string='#prk_panel-'+event.index;
						jQuery(panel_string).children('.prk-panel').children('.as-prk-bottom').css({'margin-top':0});
						jQuery(panel_string).children('.prk-panel').children('.as-prk-bottom').animate({'margin-top':-jQuery(panel_string).children('.prk-panel').children('.as-prk-bottom').children('.titled_block').height()-40},0);
						jQuery(panel_string).children('.prk-panel').find('.grid_single_title a.fade_anchor').removeClass('prk_first_anim');
						jQuery(panel_string).children('.prk-panel').find('.titled_block .inner_skills').removeClass('prk_first_anim');
						jQuery(panel_string).children('.prk-panel').find('.prk_heart_carousel').removeClass('prk_first_anim');
				    	setTimeout(function() {
				    		jQuery(panel_string).children('.prk-panel').find('.grid_single_title a.fade_anchor').addClass('prk_first_anim');
				    		jQuery(panel_string).children('.prk-panel').find('.titled_block .inner_skills').addClass('prk_first_anim');
				    		jQuery(panel_string).children('.prk-panel').find('.prk_heart_carousel').addClass('prk_first_anim');
				    	},580);

				    },
				    panelClick: function(event) {
					},
					breakpoints: {
				        767: {
				        	height: '101%',
				        	maxOpenedPanelSize:'50%',
				        	visiblePanels: 4, 
				        	orientation: 'vertical'},
				        640: {
				        	height: '101%',
				        	maxOpenedPanelSize:'46%', 
				        	visiblePanels: 3, 
				        	orientation: 'vertical'
				        }
				    }
				});
				jQuery('#folio_father').delay(200).animate({
					opacity:1
				}, 
				{
					easing:'linear',
					duration:300
				});
				jQuery('html').css({'overflow-y':'hidden'});
				setTimeout(function() {
					pirenko_resize();
					jQuery(window).trigger("smartresize");
					jQuery(window).trigger("debouncedresize");
					var accordion = jQuery('#folio_carousel').data('accordionSlider');
					accordion.update();
				},150);
			});
		}
		if (jQuery('#folio_carousel.prk_no_open').length) {
			var $ac_container = jQuery('#folio_carousel');
			$ac_container.find('.tiny_line').each(function() {
				if (jQuery(this).attr('data-color')!=="default") {
					jQuery(this).css({'background-color':jQuery(this).attr('data-color'),'opacity':0});
				}	
			});
			$ac_container.find('.as-prk-inner').css({'opacity':0});
			$ac_container.imagesLoaded(function() {
				NProgress.done();
				$ac_container.accordionSlider({
					width:'100%',
					height: '100%',
					shadow: false,
					autoplay:false,
					visiblePanels:jQuery('#folio_carousel').attr('data-columns'),
					mouseDelay:100,
					openPanelDuration:500,
					closePanelDuration:500,
					mouseWheelTarget: 'page',
					startPanel:-1,
					maxOpenedPanelSize:'60%',
					openPanelOn:'nothing',
					panelOverlap:false,
					panelOpenComplete: function(event) {
						var panel_string='#prk_panel-'+event.index;
						jQuery(panel_string).children('.prk-panel').children('.as-prk-bottom').css({'margin-top':0});
						jQuery(panel_string).children('.prk-panel').children('.as-prk-bottom').animate({'margin-top':-jQuery(panel_string).children('.prk-panel').children('.as-prk-bottom').children('.titled_block').height()-20},0);
						jQuery(panel_string).children('.prk-panel').find('.grid_single_title a.fade_anchor').removeClass('prk_first_anim');
						jQuery(panel_string).children('.prk-panel').find('.titled_block .inner_skills').removeClass('prk_first_anim');
						jQuery(panel_string).children('.prk-panel').find('.prk_heart_carousel').removeClass('prk_first_anim');
				    	setTimeout(function() {
				    		jQuery(panel_string).children('.prk-panel').find('.grid_single_title a.fade_anchor').addClass('prk_first_anim');
				    		jQuery(panel_string).children('.prk-panel').find('.titled_block .inner_skills').addClass('prk_first_anim');
				    		jQuery(panel_string).children('.prk-panel').find('.prk_heart_carousel').addClass('prk_first_anim');
				    	},580);

				    },
				    panelOpen: function(event) {
				    	//MOBILE DEVICES HACK - NO PANEL OPENING
				    	if (jQuery('#folio_carousel.prk_no_open').length) {
					    	var panel_string='#prk_panel-'+event.index;
					    	jQuery('#gusto_fake_anchor').attr('href',jQuery(panel_string).find('.as-prk-rotated>a').attr('href'));
					    	jQuery('#gusto_fake_anchor').trigger("click");
					    	var secaccordion = jQuery('#folio_carousel').data('accordionSlider');
					    	secaccordion.closePanels();
					    }
				    	
					},
					panelMouseOver: function(event) {
						var panel_string='#prk_panel-'+event.index;
						jQuery(panel_string).addClass('prk_active_panel');
						if (jQuery('#folio_carousel.prk_no_open').length) {
							jQuery(panel_string).find('.as-background').stop().transition({
								scale:1.2,
								opacity:1,
								easing:'linear',
								duration:300
							});
							jQuery(panel_string).find('.as-prk-rotated').stop().transition({
								bottom:'58%',
								easing:'linear',
								duration:300
							});
							jQuery(panel_string).find('.as-prk-inner').stop().transition({
								opacity:1,
								duration:300,
							});
							jQuery(panel_string).find('.as-prk-inner .tiny_line').stop().transition({
								opacity:1,
								duration:300,
								delay:150
							});
							jQuery(panel_string).find('.as-prk-skills a').css({'opacity':1});
							jQuery(panel_string).find('.as-prk-skills').stop().transition({
								top:'52%',
								opacity:1,
								duration:300
							});
						}
				    },
				    panelMouseOut: function(event) {
						var panel_string='#prk_panel-'+event.index;
						jQuery(panel_string).removeClass('prk_active_panel');
						if (jQuery('#folio_carousel.prk_no_open').length) {
							jQuery(panel_string).find('.as-background').stop().transition({
								scale:1,
								opacity:0.4,
								duration:300
							},
							function() {
								jQuery(this).css({'-webkit-transform':'none','-moz-transform':'none','-ms-transform':'none','-o-transform':'none','transform':'none'});
							});
							jQuery(panel_string).find('.as-prk-rotated').stop().transition({
								bottom:'54%',
								duration:300
							});
							jQuery(panel_string).find('.as-prk-inner').stop().transition({
								opacity:0,
								duration:300
							});
							jQuery(panel_string).find('.as-prk-inner .tiny_line').stop().transition({
								opacity:0,
								duration:300,
							});
							jQuery(panel_string).find('.as-prk-skills').stop().transition({
								top:'48%',
								opacity:0,
								duration:300
							});
						}
				    },
					breakpoints: {
				        767: {
				        	height: '101%',
				        	maxOpenedPanelSize:'50%',
				        	visiblePanels: 4, 
				        	orientation: 'vertical'},
				        640: {
				        	height: '101%',
				        	maxOpenedPanelSize:'46%', 
				        	visiblePanels: 3, 
				        	orientation: 'vertical'
				        }
				    }
				});
				jQuery('#folio_father').delay(50).animate({
					opacity:1
				}, 
				{
					easing:'linear',
					duration:200
				});
				setTimeout(function(){
					pirenko_resize();
					jQuery(window).trigger("debouncedresize");
				},10);
			});
		}
		if (jQuery('#folio_titled').length) {
			portfolio_gutter=parseInt(jQuery('#folio_titled').attr('data-margin'),10);
			jQuery('#folio_titled').css({'margin-left':portfolio_gutter,'margin-top':portfolio_gutter});
			jQuery('#folio_titled .portfolio_entry_li').css({'margin-bottom':Math.floor(portfolio_gutter/2)});
			$container = jQuery('#folio_titled');
			$container.imagesLoaded( function() {
				NProgress.done();
				//SET THE NUMBER OF IMAGES TO SHOW
				var img_nr=2;
				if (jQuery(window).width()<(768 - scrollbar_width) && theme_options.resp_mode==="true") {
					
					if (jQuery(window).width()<(401 - scrollbar_width)) {
						img_nr=1;
					}
				}
				else 
				{
					if (jQuery('#folio_titled').attr('data-columns')==="variable") {
						img_nr=Math.ceil($container.width()/430);
					}
					else {	
						img_nr=jQuery('#folio_titled').attr('data-columns');
					}
				}
				var helper= Math.floor($container.width() / img_nr);
				var h_helper=Math.floor(helper/480*300);
				jQuery('.portfolio_entry_li,.grid_image_wrapper').css({'height':h_helper}); 
				$container.isotope({
					itemSelector : '.portfolio_entry_li',
					resizable: false, // disable normal resizing
					// set columnWidth to a percentage of container width
					masonry: { columnWidth: $container.width() / img_nr },
					transformsEnabled : false,
					animationEngine : "jquery"
				});
				setTimeout(function(){
					jQuery('.portfolio_entry_li,.inset_shadow,.prk_overlayer').css({'width':helper,'height':h_helper});
					jQuery('#folio_father').delay(200).animate({
						opacity:1
					}, 
					{
						easing:'linear',
						duration:300
					});
				},10);
				setTimeout(function(){jQuery(window).trigger( "smartresize");},20);
				jQuery('.portfolio_entry_li .tiny_line').each(function() {
					if (jQuery(this).attr('data-color')!=="default") {
						jQuery(this).css({'background-color':jQuery(this).attr('data-color')});
						jQuery(this).parent().find('.inner_skills a').attr('data-color',jQuery(this).attr('data-color'));
					}	
				});
				jQuery('#folio_father').css({'min-height':jQuery(window).height()});
				init_sliders();
			});
			jQuery(window).smartresize(function() {
				//SET THE NUMBER OF IMAGES TO SHOW
				var img_nr=2;
				if (jQuery(window).width()<(768 - scrollbar_width) && theme_options.resp_mode==="true") {
					
					if (jQuery(window).width()<(401 - scrollbar_width)) {
						img_nr=1;
					}
				}
				else 
				{
					if (jQuery('#folio_titled').attr('data-columns')==="variable") {
						img_nr=Math.ceil($container.width()/430);
					}
					else {	
						img_nr=jQuery('#folio_titled').attr('data-columns');
					}
				}
				jQuery('.portfolio_entry_li').css({'width':'auto'}); 
				var helper= Math.floor($container.width() / img_nr);
				var h_helper=Math.floor((helper-portfolio_gutter)/480*300);
				jQuery('.portfolio_entry_li').css({'width':helper,'height':h_helper+jQuery('.titled_block').height()});
				jQuery('.grid_image_wrapper').css({'height':h_helper});
				jQuery('.titled_block').css({'top':h_helper});
				$container.isotope({
					// update columnWidth to a percentage of container width
					masonry: { columnWidth: Math.floor($container.width() / img_nr) }
				},
				function() {
				});
				//TRICK TO MAKE SURE THE FILTER WORKS
				if (curr_filter!=="p_all" && jQuery('#folio_father.dyn_loaded').length) {
					$container.isotope({
						filter: '.p_all'
					});
					$container.isotope({
						filter: '.'+curr_filter
					});
				}
				jQuery('.portfolio_entry_li,.inset_shadow,.prk_overlayer,.portfolio_entry_li img').css({'width':helper-portfolio_gutter});
			});
		}
		if (jQuery('#single_portfolio_half.featured_color').length) {
			jQuery('#top_bar_wrapper,#nav-collapsed-icon .prk_menu_block').animate({'background-color':jQuery('#single_portfolio_half.featured_color').attr('data-color')}, 500);
			jQuery("#half_portfolio_link .colored_button").css({'background-color':jQuery('#single_portfolio_half.featured_color').attr('data-color')});
			jQuery('#menu_section .not_zero_color,#back_to_top,#samba_collapse_menu,#back_to_top-collapsed').stop().delay(50).animate({'color':jQuery('#single_portfolio_half.featured_color').attr('data-color')}, 500);
			jQuery('#single-entry-content_half').find('.prk_titlify_father h1,.prk_titlify_father h2,.prk_titlify_father h3,.prk_titlify_father h4,.prk_titlify_father h6,.prk_titlify_father .widget-title,.prk_titlify_father .prk_vc_title').stop().css({'border-bottom':'4px solid '+jQuery('#single_portfolio_half.featured_color').attr('data-color')});
			jQuery('#related_projects_wp .prk_titlify_father h3,#respond .prk_titlify_father h3').stop().css({'border-bottom':'4px solid '+jQuery('#single_portfolio_half.featured_color').attr('data-color')});
		}
		else {
			if (jQuery('#single_portfolio_half').length) {
				jQuery('#top_bar_wrapper').animate({'background-color':theme_options.active_color}, 500);
				jQuery("#half_portfolio_link .colored_button").css({'background-color':theme_options.active_color});
				jQuery('#menu_section .not_zero_color,#back_to_top,#samba_collapse_menu,#back_to_top-collapsed').stop().delay(50).animate({'color':theme_options.active_color}, 500);
				jQuery('#related_projects_wp .prk_titlify_father h3,#respond .prk_titlify_father h3').stop().css({'border-bottom':'4px solid '+theme_options.active_color});
			}
		}
		if (jQuery('#prk_full_folio.featured_color').length) {
			jQuery('#top_bar_wrapper,#nav-collapsed-icon .prk_menu_block').animate({'background-color':jQuery('#prk_full_folio.featured_color').attr('data-color')}, 500);
			jQuery("#full_portfolio_link .colored_button").css({'background-color':jQuery('#prk_full_folio.featured_color').attr('data-color')});
			jQuery('#prk_full_folio').find('.prk_titlify_father h1,.prk_titlify_father h2,.prk_titlify_father h3,.prk_titlify_father h4,.prk_titlify_father h6,.prk_titlify_father .widget-title,.prk_titlify_father .prk_vc_title').stop().css({'border-bottom':'4px solid '+jQuery('#prk_full_folio.featured_color').attr('data-color')});
			jQuery('#full-entry-right .side_skills a').attr('data-color',jQuery('#prk_full_folio.featured_color').attr('data-color'));
			jQuery('#menu_section .not_zero_color,#back_to_top,#samba_collapse_menu,#back_to_top-collapsed').stop().delay(50).animate({'color':jQuery('#prk_full_folio.featured_color').attr('data-color')}, 500);
			jQuery('#related_projects_wp .prk_titlify_father h3,#respond .prk_titlify_father h3').stop().css({'border-bottom':'4px solid '+jQuery('#prk_full_folio.featured_color').attr('data-color')});
		}
		jQuery('#tiny_line_half').each(function() {
			if (jQuery(this).attr('data-color')!=="default") {
				jQuery(this).css({'background-color':jQuery(this).attr('data-color')});
				jQuery(this).parent().find('.side_skills a').attr('data-color',jQuery(this).attr('data-color'));
			}
		});
		jQuery('#filter_top').css({'background-color':theme_options.active_color});
		jQuery('.video-container,.soundcloud-container').css({opacity:1});
	}

	//SEARCH FORM
	jQuery('#searchform').submit(function(e) {
		if (ajax_calls) {
			e.preventDefault();
			close_top_bar(400);
			var search_query=jQuery(this).attr('data-url')+jQuery(this).find('#samba_search').val();
			jQuery ('#sidebar').stop().transition({
				opacity:0,
				duration:300 
			});
			jQuery ('#main_block').stop().transition({
				opacity:0,
				duration:300 
			},function() {
				load_ajax_link(search_query,true);
				NProgress.start();
				jQuery('#nprogress .bar').css({'background-color':theme_options.active_color});
				if (jQuery('#prk_responsive_menu.at_top').length) {
					jQuery('#nprogress .bar').css({'top':'50px'});
					jQuery('#nprogress .spinner').css({'top':'65px'});
				}
				jQuery('.spinner-icon').css({'border-top-color':theme_options.active_color,'border-left-color':theme_options.active_color});
				jQuery('#nav-collapsed-icon .prk_menu_block').animate({'background-color':theme_options.active_color}, 500);
			});
		}
	});
	jQuery('.sform_wrapper .icon-search').click(function() {
		jQuery('#searchform').submit();
	});
	//SCROLLING FUNCTIONS
	if (!is_mobile()) {
		var samba_skrollr = skrollr.init({
			forceHeight:true,
			smoothScrolling:false,
			keyframe: function(element, name, direction) {
		    }
		});
		jQuery(window).trigger("debouncedresize");
		jQuery(window).scroll(function() {
			//SKROLLR FIX IF NEEDED
			if (stop_verification===false) {
				stop_verification=true;
			 	if ((parseInt(jQuery('body')[0].style.height,10)-jQuery('.ultra_wrapper').outerHeight())>100) {
					jQuery(window).trigger("debouncedresize");
				}
			}
		});
	}
	//BACK TO TOP BUTTON
	jQuery(window).scroll(function() {
		if(jQuery(window).scrollTop() >= 180)
		{
			jQuery('#back_to_top,#back_to_top-collapsed').css({'display':'inline'});
			jQuery('#back_to_top,#back_to_top-collapsed').stop().animate({opacity: 1}, 300,
			function() {
			});
		}
		else
		{
			jQuery('#back_to_top,#back_to_top-collapsed').stop().animate({opacity: 0}, 300,
			function() 
			{
				jQuery('#back_to_top,#back_to_top-collapsed').css({'display':'none'});
			});
		}
	});
	//INITIALIZE BUTTON
	if(jQuery(window).scrollTop() >= 200)
    {
		jQuery('#back_to_top,#back_to_top-collapsed').css({'display':'inline',opacity: 1});
	}
	else
	{
		jQuery('#back_to_top,#back_to_top-collapsed').css({'display':'none',opacity: 0});	
	}
	jQuery('#back_to_top,#back_to_top-collapsed').click(function() {
		jQuery('body,html').animate({scrollTop:0},600);
	});

	//SLIDERS INIT
	function init_sliders() {
		if (jQuery('#not_slider').length) {
			jQuery('#not_slider').imagesLoaded(function() {
				jQuery('#after_single_folio').stop().animate({opacity:1 },200);
				jQuery(window).trigger("debouncedresize");
			});
			jQuery('#not_slider').fitVids();
			jQuery('#not_slider').magnificPopup({
				delegate: 'div.prk_magnificent_li',
				src:'data-src',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
			jQuery('.video-container,.soundcloud-container').css({opacity:1});
		}
		//SINGLE PAGES SLIDER - PORTFOLIO AND BLOG
		if (jQuery('#single_slider').length) {
			jQuery('#single_slider .slides').css({'opacity':'0'});
			jQuery('#single_slider').append('<div class="spinner"><div class="spinner-icon"></div></div>');
			jQuery('#single_slider').css({'opacity':1,'padding-bottom':'45px'});
			jQuery('#single_slider').addClass('loading_sld');
			$js_flexislider('#single_slider').fitVids().flexslider({
				slideshow : $js_flexislider('#single_slider>ul').attr('data-autoplay') === "true" ? true : false,
				slideshowSpeed : theme_options.delay_portfolio,
				smoothHeight: true, 
				controlNav: false,
				useCSS: 'false',
				pauseOnHover: true, 
				touch:true,
				start:function (slider) {
					//SHIFT BUTTONS IF VIDEO SLIDE
					if (jQuery('.flex-active-slide .prk-video-container').length) {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:50}, 0 );
					}
					else {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:14}, 0 );
					}
					if (slider.attr('data-color')!=="default") {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').attr('data-color',slider.attr('data-color'));
						jQuery('#single_slider .spinner-icon').css({'border-top-color':slider.attr('data-color'),'border-left-color':slider.attr('data-color')});
					}
					else {
						jQuery('#single_slider .spinner-icon').css({'border-top-color':theme_options.active_color,'border-left-color':theme_options.active_color});
					}
					jQuery('.flex-direction-nav li a.flex-prev').each(function() 
					{
						jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_left"><div class="icon-left-open-big"></div></div>');
                    });
					jQuery('.flex-direction-nav li a.flex-next').each(function() 
					{
						jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_right"><div class="icon-right-open-big"></div></div>');
                    });
                    if (jQuery('#single_slider .slides>li').length===1) {
						jQuery('.flex-direction-nav').css({'display':'none'});
                    }
                    //OVERRIDE COLORS IF NEEDED
					if (theme_options.use_custom_colors==="no") {
						slider.find('.flex-next,.flex-prev').attr('data-color',original_active_color);
					}
                    jQuery('#single_slider').imagesLoaded(function() {
                    	jQuery('.video-container,.soundcloud-container').css({opacity:1});
						setTimeout(function(){
							jQuery('#single_slider').css({'padding-bottom':'','opacity':0});
							jQuery('#single_slider').removeClass('loading_sld');
							jQuery('#single_slider .slides').css({'opacity':'1'});
							jQuery('#single_slider .spinner').remove();
							jQuery('#single_slider img').css({'width':'100%'});
							jQuery('#single_slider #slide_1').css({'display':'block'});
							jQuery(window).trigger("debouncedresize");
							jQuery('#single_slider').css({'height':jQuery('#single_slider>ul>li:nth-child(1) img').height()});
							if (jQuery('#single_slider>ul>li:nth-child(1) iframe').length) {
								jQuery('#single_slider').css({'height':jQuery('#single_slider>ul>li:nth-child(1) iframe').height()});
							}
							jQuery('#single_slider').stop().animate({
								opacity:1 },200,
								function() {
									if (jQuery('#single_slider').height()===0) {
										jQuery('#single_slider').css({'height':jQuery('#single_slider #slide_1 img').height()});
										if (jQuery('#single_slider #slide_1 iframe').length) {
											jQuery('#single_slider').css({'height':jQuery('#single_slider #slide_1 iframe').height()});
										}
									}
									if (jQuery('#single_slider #slide_1 img').length && jQuery('#single_slider').height()!==jQuery('#single_slider #slide_1 img').height()) {
										jQuery('#single_slider').css({'height':jQuery('#single_slider #slide_1 img').height()});
									}
									if (jQuery('#single_slider #slide_1 iframe').length) {
										jQuery('#single_slider').css({'height':jQuery('#single_slider #slide_1 iframe').height()});
									}
									jQuery('#after_single_folio').stop().animate({opacity:1 },200);
									jQuery(window).trigger("debouncedresize");
								} 
							);
							jQuery('.flex-direction-nav').stop().animate({
								opacity:1 },200, 
								function() {
									
								} 
							);
						},350);	
                    });
                    
                    jQuery('#single_slider').magnificPopup({
						delegate: 'div.prk_magnificent_li',
						src:'data-src',
						type: 'image',
						tLoading: 'Loading image #%curr%...',
						fixedContentPos: false,
						fixedBgPos: true,
						closeOnContentClick: true,
						closeBtnInside: false,
						mainClass: 'mfp-no-margins my-mfp-zoom-in',
						removalDelay: 300,
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						},
						image: {
							tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
							titleSrc: function(item) {
								return item.el.attr('title');
							}
						},
						callbacks: {
							open: function() {
								scrollbar_width=window.innerWidth-jQuery("body").width();
								jQuery('html').css({'padding-right':scrollbar_width});
								jQuery('html').css({'overflow-y':'hidden'});
								jQuery('.mfp-bg').css({'opacity':0.8});
							},
							beforeClose: function() {
								jQuery('.mfp-bg').css({'opacity':0});
							},
							close: function() {
								jQuery('html').css({'overflow-y':'','padding-right':''});
						}
						}
					});
				},
				before: function(slider) {
				},
				after: function()
				{
					//SHIFT BUTTONS IF VIDEO SLIDE
					if (jQuery('.flex-active-slide .prk-video-container').length) {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:50}, 200 );
					}
					else {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:14}, 200 );
					}
				}
			});
		}
		
		$js_flexislider('.tiny_slider.per_init').each(function() {
			jQuery(this).removeClass('per_init');
			var delayer = Math.floor(Math.random() * 3000);
			$js_flexislider(this).flexslider({
				slideshow : true,
				slideshowSpeed : (parseInt(theme_options.delay_portfolio,10)-2000)>2000 ? parseInt(theme_options.delay_portfolio,10)-2000 : 2000,
				smoothHeight: false, 
				controlNav: false,
				useCSS: 'false',
				pauseOnHover: false, 
				initDelay:delayer,
				touch:false,
				startAt:0,
				start: function(){
					
				} 
			});
			jQuery(this).parent().parent().each(function() {
				jQuery(this).magnificPopup({
					delegate: 'div.prk_magnificent_li',
					src:'data-src',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					fixedContentPos: false,
					fixedBgPos: true,
					closeOnContentClick: true,
					closeBtnInside: false,
					mainClass: 'mfp-no-margins my-mfp-zoom-in',
					removalDelay: 300,
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
						tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
						titleSrc: function(item) {
							return item.el.attr('title');
						}
					},
					callbacks: {
						open: function() {
							scrollbar_width=window.innerWidth-jQuery("body").width();
							jQuery('html').css({'padding-right':scrollbar_width});
							jQuery('html').css({'overflow-y':'hidden'});
							jQuery('.mfp-bg').css({'opacity':0.8});
						},
						beforeClose: function() {
							jQuery('.mfp-bg').css({'opacity':0});
						},
						close: function() {
							jQuery('html').css({'overflow-y':'','padding-right':''});
						}
					}
				});
			});
		});
		//SHORTCODE SLIDERS	
		$js_flexislider('.shortcode_slider').not($js_flexislider('.shortcode_slider.super_height')).each(function() {
			var $this_slder=$js_flexislider(this);
			$js_flexislider(this).flexslider({
				slideshow : $js_flexislider(this).attr('data-autoplay') === "true" ? true : false,
				slideshowSpeed : $js_flexislider(this).attr('data-delay') !== "" ? $js_flexislider(this).attr('data-delay') : theme_options.delay_portfolio,
				smoothHeight: true,
				controlNav: false,
				useCSS: 'false',
				pauseOnHover: true,
				pauseOnAction:true,
				touch:true,
				start:function (slider) {
					//SHIFT BUTTONS IF VIDEO SLIDE
					if (jQuery('.flex-active-slide .fluid-width-video-wrapper').length) {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:50}, 0 );
					}
					else {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:14}, 0 );
					}
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_0';
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_0';
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_0';
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(my_button_string).css({'left':'8px','display':'inline-block'});
					if (jQuery(my_button_string).children('a').attr('data-color')!==undefined && jQuery(my_button_string).children('a').attr('data-color')!=="") {
						jQuery(my_button_string).children('a').css({'background-color':jQuery(my_button_string).children('a').attr('data-color')});
					}
					else {
						jQuery(my_button_string).children('a').css({'background-color':theme_options.active_color});
					}
					jQuery(my_string).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_body_string).transition({
						delay:800,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_button_string).transition({
						delay:1000,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery('.flex-direction-nav').delay(1000).transition({opacity:1}, 300 );
					if (jQuery('.flex-direction-nav').length)
					{
						jQuery('.flex-direction-nav li a.flex-prev').each(function() 
						{
							jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_left"><div class="icon-left-open-big"></div></div>');
						});
						jQuery('.flex-direction-nav li a.flex-next').each(function() 
						{
							jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_right"><div class="icon-right-open-big"></div></div>');
						});
						//OVERRIDE COLORS IF NEEDED
						if (theme_options.use_custom_colors==="no") {
							slider.find('.flex-next,.flex-prev').attr('data-color',original_active_color);
						}
					}
					else {
						//IT'S A SINGLE SLIDE - HIDE CAPTIONS	
						jQuery(my_string).transition({
							delay:7500,
							opacity:0,
							duration:300,
							left:0
						});
						jQuery(my_body_string).transition({
							delay:7500,
							opacity:0,
							duration:300,
							left:0
						});
						jQuery(my_button_string).transition({
							delay:7500,
							opacity:0,
							duration:300,
							left:0
						});
					}
					if ($this_slder.find('.slides>li').length===1) {
						$this_slder.find('.flex-direction-nav').css({'display':'none'});
                    }
					jQuery('.sld_v_center').each(function() {
						jQuery(this).css({'margin-top':-parseInt(jQuery(this).height()/2,10)});
					});
					jQuery('.shortcode_slider #samba_slide_0').imagesLoaded( function() {
						jQuery(slider).height(jQuery(slider).find('#samba_slide_0').height());
						jQuery(window).trigger("debouncedresize");
						jQuery('.shortcode_slider').transition({opacity:1}, 300 );
                    });
                    if (jQuery('#single_slider .slides>li').length===1) {
						jQuery('.flex-direction-nav').css({'display':'none'});
                    }
				},
				before: function(slider) {
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_'+slider.currentSlide;
					jQuery(my_string).stop().animate({opacity:0}, 200 );
					jQuery(my_body_string).stop().animate({opacity:0}, 200 );
					jQuery(my_button_string).stop().animate({
						opacity:0 },200, 
						function() {
							jQuery(my_button_string).css({'display':'none'});
						} 
					);
				},
				after: function(slider)
				{
					//SHIFT BUTTONS IF VIDEO SLIDE
					if (jQuery('.flex-active-slide .fluid-width-video-wrapper').length) {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:50}, 200 );
					}
					else {
						jQuery('.flex-direction-nav li a.flex-next, .flex-direction-nav li a.flex-prev').transition({bottom:14}, 200 );
					}
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_'+slider.currentSlide;
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(my_button_string).css({'left':'8px','display':'inline-block'});
					if (jQuery(my_button_string).children('a').attr('data-color')!==undefined && jQuery(my_button_string).children('a').attr('data-color')!=="") {
						jQuery(my_button_string).children('a').css({'background-color':jQuery(my_button_string).children('a').attr('data-color')});
					}
					else {
						jQuery(my_button_string).children('a').css({'background-color':theme_options.active_color});
					}
					jQuery(my_string).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_body_string).transition({
						delay:800,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_button_string).transition({
						delay:1000,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery('.sld_v_center').each(function() {
						jQuery(this).css({'margin-top':-parseInt(jQuery(this).height()/2,10)});
					});
				}
			});
		});
		//HOMEPAGE MAIN SLIDER	
		if ($js_flexislider('.shortcode_slider.super_height').length) {
			if (is_iphone > -1)
			{
				jQuery('body').css({height:'auto'});	
			}
			jQuery(window).on("debouncedresize", function( event ) {
				jQuery('.shortcode_slider.super_height .slides>li').each(function(index, element) {
					var minWidth=jQuery(this).parent().width();// Min width for the image
					var minHeight=jQuery(window).height()+2;// Min height for the image
					var width=parseInt(jQuery(this).find('img.vsbl').attr('data-or_w'),10); 
					var height=parseInt(jQuery(this).find('img.vsbl').attr('data-or_h'),10);
					var ratio=minHeight / height;

					//FILL HEIGHT
					jQuery(this).find('img.vsbl').css("height", minHeight);  
					jQuery(this).find('img.vsbl').css("width", width * ratio); 
					//UPDATE VARS
					width = jQuery(this).find('img.vsbl').width(); 
					height = jQuery(this).find('img.vsbl').height(); 
					//FILL WIDTH IF NEEDED
					if(width < minWidth) {
						ratio = minWidth / width;
						jQuery(this).find('img.vsbl').css("width", minWidth);
						jQuery(this).find('img.vsbl').css("height", height * ratio);
					}
					//LIMIT SLIDER HEIGHT ON SMALL DEVICES
					if((is_mobile() && is_iphone > -1) || jQuery("#prk_responsive_menu.at_top").length) {
						jQuery('html').css({'overflow-y':''});
						jQuery('.main_with_sections').css({'overflow':'hidden'});
						if (Math.abs(window.orientation) === 90) {
							ratio = 210 / jQuery(this).find('img.vsbl').height(); // get ratio for scaling image
							jQuery(this).find('img.vsbl').css("height", 210);   // Set new height
							jQuery(this).find('img.vsbl').css("width", jQuery(this).find('img.vsbl').width() * ratio);    // Scale width based on ratio
							//width = width * ratio;    // Reset width to match scaled image
							if(jQuery(this).find('img.vsbl').width() < (jQuery(window).width()+15)) {
								ratio = (jQuery(window).width()+15) / jQuery(this).find('img.vsbl').width();   // get ratio for scaling image
								jQuery(this).find('img.vsbl').css("width", jQuery(window).width()+15); // Set new width
								jQuery(this).find('img.vsbl').css("height", jQuery(this).find('img.vsbl').height() * ratio);  // Scale height based on ratio
								//height = height * ratio;    // Reset height to match scaled image
							}
						}
						else
						{
							ratio = 350 / jQuery(this).find('img.vsbl').height(); // get ratio for scaling image
							jQuery(this).find('img.vsbl').css("height", 350);   // Set new height
							jQuery(this).find('img.vsbl').css("width", jQuery(this).find('img.vsbl').width() * ratio);    // Scale width based on ratio
							//width = width * ratio;    // Reset width to match scaled image
							//if(jQuery(this).find('img').width() < jQuery(window).width()) {
								ratio = (jQuery(window).width()+15) / jQuery(this).find('img.vsbl').width();   // get ratio for scaling image
								jQuery(this).find('img.vsbl').css("width", jQuery(window).width()+15); // Set new width
								jQuery(this).find('img.vsbl').css("height", jQuery(this).find('img.vsbl').height() * ratio);  // Scale height based on ratio
								//height = height * ratio;    // Reset height to match scaled image
							//}
						}
						jQuery('.flex-control-nav').css({'top':15,'right':7});
					}
					else {
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.main_with_sections').css({'overflow':''});
						jQuery('.flex-control-nav').css({'position':'relative'});
						var al_helper=jQuery('.flex-control-nav').outerHeight();
						jQuery('.flex-control-nav').css({'position':'absolute'});
						jQuery('.flex-control-nav').css({'right':'','top':parseInt((jQuery(window).height()-al_helper)/2,10)});
					}
					//ADJUST MARGINS
					if (jQuery("#nav-main.resp_mode").length) 
					{
						jQuery(this).find('img.vsbl').css("margin-left",0);
					}
					else {
						jQuery(this).find('img.vsbl').css("margin-left",-(jQuery(this).find('img.vsbl').width()-minWidth)/2);
					}
					if (jQuery(window).width()<780) {
						jQuery(this).find('img.vsbl').css("margin-top",0);
					}
					else {
						jQuery(this).find('img.vsbl').css("margin-top",-(jQuery(this).find('img.vsbl').height()-minHeight)/2);
					}
					if (!jQuery(this).find('.slider_text_holder').hasClass('sld_top')) {
						var btm_dis=parseInt(jQuery(this).find('.slider_text_holder').outerHeight(),10);
						jQuery(this).find('.slider_text_holder').css({"bottom":-parseInt(jQuery(this).find('img.vsbl').css("margin-top"),10)+35});
					}
					jQuery('.sld_v_center').each(function() {
						jQuery(this).css({'margin-top':Math.ceil(-parseInt(jQuery(this).height()/2,10)+parseInt(jQuery(this).parent().children('img.vsbl').css('margin-top'),10)/2)});
					});
					//ALSO FORCE YOUTUBE AND VIMEO VIDEO DIMENSIONS - FIX FOR IE AND FIREFOX
					jQuery(this).find('iframe,.fluid-width-video-wrapper').css("height", jQuery(window).height()+1);
				});
				if((is_mobile() && is_iphone > -1) || jQuery("#prk_responsive_menu.at_top").length) {
					jQuery('.shortcode_slider.super_height .flex-direction-nav li a').css({'top':jQuery('.shortcode_slider.super_height').height()/2});
					jQuery('.shortcode_slider.super_height').css({'height':jQuery('.shortcode_slider.super_height .flex-active-slide').height()});
					jQuery('iframe,.fluid-width-video-wrapper,.shortcode_slider.super_height').css({'height':''});
				}
				else {
					jQuery('.shortcode_slider.super_height').css({'height':''});
					jQuery('.shortcode_slider.super_height .flex-direction-nav li a').css({'top':jQuery(window).height()/2});
				}
			});//DEBOUNCED RESIZE
			$js_flexislider('.shortcode_slider.super_height .slides').css({'display':'none'});
			$js_flexislider('.shortcode_slider.super_height').append('<div class="spinner"><div class="spinner-icon"></div></div>');
			$js_flexislider('.shortcode_slider.super_height').css({'opacity':1});
			jQuery('#bottom_sidebar').css({'display':'none'});
			jQuery('html').css({'overflow-y':'hidden'});
			$js_flexislider('.shortcode_slider.super_height').flexslider({
				slideshow : $js_flexislider('.shortcode_slider.super_height').attr('data-autoplay') === "true" ? true : false,
				slideshowSpeed : $js_flexislider('.shortcode_slider.super_height').attr('data-delay'),
				smoothHeight: false,
				controlNav: true,
				directionNav:false,
				pauseOnHover: $js_flexislider('.shortcode_slider.super_height').attr('data-hover') === "true" ? true : false,
				touch:true,
				start:function (slider){
					jQuery('.flexslider').css({'min-height':0});
					if (jQuery('.flex-direction-nav').length)
					{
						jQuery('.flex-direction-nav li a.flex-prev').each(function() 
						{
							jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_left"><div class="icon-left-open-big"></div></div>');
						});
						jQuery('.flex-direction-nav li a.flex-next').each(function() 
						{
							jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_right"><div class="icon-right-open-big"></div></div>');
						});
					}
					jQuery('.shortcode_slider.super_height .spinner-icon').css({'border-top-color':theme_options.active_color,'border-left-color':theme_options.active_color});
					//ADJUST TEXT TO BE SHOWN
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_0';
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_0';
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_0';
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(my_button_string).css({'left':'8px','display':'inline-block'});
					if (jQuery(my_button_string).children('a').attr('data-color')!==undefined && jQuery(my_button_string).children('a').attr('data-color')!=="") {
						jQuery(my_button_string).children('a').css({'background-color':jQuery(my_button_string).children('a').attr('data-color')});
					}
					else {
						jQuery(my_button_string).children('a').css({'background-color':theme_options.active_color});
					}
					jQuery(my_string).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_body_string).transition({
						delay:800,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_button_string).transition({
						delay:1000,
						opacity:1,
						duration:300,
						left:0
					});	
					if (jQuery('.shortcode_slider.super_height .slides>li').length===1) {
						jQuery('.flex-direction-nav').css({'display':'none'});
                    }
                    jQuery('.flex-control-nav li a').live('mouseover', function() {
						jQuery(this).css({'backgroundColor': theme_options.active_color,'box-shadow':'0x 0px 1px '+hex2rgb(theme_options.active_color,0.75)});
					});
					jQuery('.flex-control-nav li a').live('mouseout', function() {
						if (!jQuery(this).hasClass('flex-active')) {
							jQuery(this).css({'backgroundColor': '','box-shadow':''});
						}
					});
                    jQuery('.shortcode_slider.super_height #samba_slide_0').imagesLoaded( function() {
						jQuery('.flex-control-nav li a.flex-active').css({'background-color':theme_options.active_color,'box-shadow':'0px 0px 1px '+hex2rgb(theme_options.active_color,0.75)});
						jQuery('.shortcode_slider.super_height').css({'opacity':0});
						jQuery('.shortcode_slider.super_height .slides').css({'display':'block'});
						jQuery('.shortcode_slider.super_height .spinner').remove();
						jQuery('.shortcode_slider.super_height').transition({opacity:1}, 300 );
						//ADJUST IMAGE SIZE
						jQuery(window).trigger("debouncedresize");
                    });
				},
				before: function(slider)
				{
					jQuery('.flex-control-nav li a.flex-active').css({'backgroundColor': '','box-shadow':'none'});
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_'+slider.currentSlide;
					jQuery(my_string).stop().animate({opacity:0}, 200 );
					jQuery(my_body_string).stop().animate({opacity:0}, 200 );
					jQuery(my_button_string).stop().animate({
						opacity:0 },200, 
						function() {
							jQuery(my_button_string).css({'display':'none'});
						} 
					);
				},
				after: function(slider) {
					if ((is_mobile() && is_iphone > -1) || jQuery("#prk_responsive_menu.at_top").length) {
						jQuery('.shortcode_slider.super_height').css({'height':jQuery('.shortcode_slider.super_height #samba_slide_'+slider.currentSlide).height()});
					}
					jQuery('.flex-control-nav li a').css({'box-shadow':''});
					jQuery('.flex-control-nav li a.flex-active').css({'backgroundColor': theme_options.active_color,'box-shadow':'0px 0px 1px '+hex2rgb(theme_options.active_color,0.75)});
					var my_string='#'+jQuery(slider).find('ul').attr('id')+'top_'+slider.currentSlide;
					var my_body_string='#'+jQuery(slider).find('ul').attr('id')+'body_'+slider.currentSlide;
					var my_button_string='#'+jQuery(slider).find('ul').attr('id')+'slidebtn_'+slider.currentSlide;
					jQuery(my_string).stop();
					jQuery(my_body_string).stop();
					jQuery(my_string).css({'left':'8px'});
					jQuery(my_body_string).css({'left':'-8px'});
					jQuery(my_button_string).css({'left':'8px','display':'inline-block'});
					if (jQuery(my_button_string).children('a').attr('data-color')!==undefined && jQuery(my_button_string).children('a').attr('data-color')!=="") {
						jQuery(my_button_string).children('a').css({'background-color':jQuery(my_button_string).children('a').attr('data-color')});
					}
					else {
						jQuery(my_button_string).children('a').css({'background-color':theme_options.active_color});
					}
					jQuery(my_string).transition({
						delay:600,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_body_string).transition({
						delay:800,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery(my_button_string).transition({
						delay:1000,
						opacity:1,
						duration:300,
						left:0
					});
					jQuery('.sld_v_center').each(function() {
						jQuery(this).css({'margin-top':-parseInt(jQuery(this).height()/2,10)});
					});
				}
			});
		}
	}
	//LIKE FEATURE
	jQuery("a.pir_like").live("click",function(event)	{
		event.preventDefault();
		//CHECK IF WE ARE CLICKING ON THE BUTTON THAT "SHOULD" BE INACTIVE
		if (jQuery(this).hasClass('alreadyvoted'))
		{
			return false;
		}
		else
		{
			var heart = jQuery(this);
			var post_id = heart.data("post_id");
			jQuery.ajax(
			{
				type: "post",
				url: ajax_var.url,
				data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
				success: function(count)
				{
					if(count !== "already")
					{
						heart.addClass("alreadyvoted");
						heart.find(".like_count").text(''+count+'');
						heart.tooltipster('hide');
						setTimeout(function(){ heart.tooltipster('update', heart.attr("data-no_more"));},300); 
					}
				}
			});
			return false;
		}
	});
	//THUMBS ROLLOVER
	//SMOOTHER HOVER COLORS
	var main_color_elements=".smoothed_a,.zero_color a,a.zero_color,.default_color a,a.default_color,#mini_social_nets a,#footer_in a,#top_widgets_in a";
	var inv_color_elements=".inv_smoothed_a";
	var alt_color_elements=".alt_smoothed_a,.tweet_body a";
	function thumbs_roll() {
		jQuery(inv_color_elements).hover(
			function() {
				if (is_mobile()===false) {
					jQuery(this).stop().transition({
					color:theme_options.menu_up_color,
					duration:250
					});
				}
			},
			function() {
					jQuery(this).stop().transition({
				color:'',
				duration:250
				});
			}
		);
		jQuery(alt_color_elements).hover(
			function() {
				if (is_mobile()===false) {
					jQuery(this).stop().transition({
					color:theme_options.bd_headings_color,
					duration:250
					});
				}	
			},
			function() {
					jQuery(this).stop().transition({
				color:'',
				duration:250
				});
			}
		);
		jQuery(main_color_elements).live('mouseover', function() {
			if (is_mobile()===false) {
				if (jQuery(this).attr('data-color')!==undefined  && jQuery(this).attr('data-color')!=="default") {
					jQuery(this).css({'text-shadow':'0px 0px 1px '+hex2rgb(jQuery(this).attr('data-color'),0.3)});
					jQuery(this).stop().transition({
						color:jQuery(this).attr('data-color'),
						duration:250,
					});
					if (jQuery(this).parent().hasClass('prk_less_opacity')) {
						jQuery(this).parent().transition({
							opacity:1,
							duration:250,
						});
					}
				}
				else {
					jQuery(this).css({'text-shadow':'0px 0px 1px '+hex2rgb(theme_options.active_color,0.3)});
					jQuery(this).stop().transition({
						color:theme_options.active_color,
						duration:250
					});
				}
				
			} 
		});
		jQuery('.site_background_colored').live('mouseover', function() {
			if (is_mobile()===false) {
				jQuery(this).find('.share_colored_bg').stop().transition({
					top:0,
					duration:250,
				});
			}
		});
		jQuery('.site_background_colored').live('mouseout', function() {
			if (is_mobile()===false) {
				jQuery(this).find('.share_colored_bg').stop().transition({
					top:50,
					duration:250,
				});
			}
		});
		jQuery(main_color_elements).live( 'mouseout', function() {
			if (is_mobile()===false) { 
				jQuery(this).css({'text-shadow':''});
				jQuery(this).stop().transition({
					color:'',
					duration:250
				});
				if (jQuery(this).parent().hasClass('prk_less_opacity')) {
					jQuery(this).parent().transition({
						opacity:'',
						duration:250,
					});
				}
			} 
		});
		jQuery('.theme_button a,.theme_button input').live('mouseover', function() {
			if (is_mobile()===false) {
				jQuery(this).stop().animate({'backgroundColor': theme_options.theme_buttons_color}, 200 );
			}
		});
		jQuery('.theme_button a,.theme_button input').live( 'mouseout', function() {

			if (is_mobile()===false) {
				if (jQuery(this).attr('data-color')!==undefined && jQuery(this).attr('data-color')!=="default" && jQuery(this).attr('data-color')!=="") {
						jQuery(this).stop().animate({'backgroundColor': jQuery(this).attr('data-color')}, 200 );
					}
					else 
					{
						jQuery(this).stop().animate({'backgroundColor': theme_options.active_color}, 200 );
				}
			}
		});
		jQuery('.theme_button_inverted a').live('mouseover', function() {
			if (is_mobile()===false && jQuery(this).attr('id')!=='in_no_more') {
				if (jQuery(this).attr('data-color')!==undefined && jQuery(this).attr('data-color')!=="default"  && jQuery(this).attr('data-color')!=="") {
					jQuery(this).stop().animate({'backgroundColor': jQuery(this).attr('data-color')}, 200 );
				}
				else {
					jQuery(this).stop().animate({'backgroundColor': theme_options.active_color}, 200 );
				}
			}
		});
		jQuery('.theme_button_inverted a').live( 'mouseout', function() {
			jQuery(this).stop().animate({'backgroundColor': theme_options.theme_buttons_color}, 200 );
		});
		jQuery('.flexslider .theme_button_inverted a,.flex-prev,.flex-next,.navigation-next,.navigation-previous').live('mouseover', function() {
			if (is_mobile()===false) {
				if (jQuery(this).attr('data-color')!==undefined && jQuery(this).attr('data-color')!=="default" && jQuery(this).attr('data-color')!=="") {
					jQuery(this).stop().animate({'backgroundColor': jQuery(this).attr('data-color')}, 200 );
				}
				else {
					jQuery(this).stop().animate({'backgroundColor': theme_options.active_color}, 200 );
				}
			}
		});
		jQuery('.flexslider .theme_button_inverted a,.flex-prev,.flex-next,.navigation-next,.navigation-previous').live( 'mouseout', function() {
			if (is_mobile()===false) {
				jQuery(this).stop().animate({'backgroundColor': theme_options.buttons_color}, 200 );
			}
		});
		jQuery('.prk_titlify_father').each(function() {
			if (!jQuery(this).find('.tinys_wrapper').length) {
				if (jQuery(this).hasClass('alignify_center')) {
					jQuery(this).append("<div class='tinys_wrapper'></div>");
					jQuery(this).after("<div class='clearfix'></div>");
				}
				else {
					jQuery(this).append("<div class='tinys_wrapper'></div>");
					jQuery(this).after("<div class='clearfix'></div>");
				}
			}
		});
		jQuery('.blog_fader_grid').hover(function() {
			if (is_mobile()===false) {
				jQuery(this).stop().animate({'opacity':'1'}, 300 );
				jQuery(this).find('.titled_link_icon').stop();
				jQuery(this).find('.titled_link_icon').css({'top':'56%','opacity':'0'});
				jQuery(this).find('.titled_link_icon').delay(100).animate({'opacity':'1','top':'50%'}, 300 );
			}
		},	
		function() {
			jQuery(this).stop().delay(100).animate({'opacity':0}, 300 );
			jQuery(this).find('.titled_link_icon').stop().animate({'top':'44%','opacity':'0'}, 300 );
		});
		jQuery("a.pir_like").tooltipster({
			touchDevices:false,
			theme:'tooltipster-light',
			position:'bottom-right',
			offsetY:-12,
			offsetX:-13
		});
		jQuery("#samba_right,#samba_left,#samba_close").tooltipster({
			theme:'tooltipster-light',
			touchDevices:false,
			position:'bottom-left',
			offsetY:-2,
			offsetX:-1
		});
		jQuery(".minimal a.tipped").tooltipster({
			theme:'tooltipster-light inverted',
			touchDevices:false,
			position:'top-left',
			offsetY:2,
			offsetX:-4
		});
		jQuery(".squared a.tipped,.rounded a.tipped").tooltipster({
			theme:'tooltipster-light inverted',
			touchDevices:false,
			position:'top-left',
			offsetY:2,
			offsetX:3
		});
		jQuery(".colored a.tipped").tooltipster({
			theme:'tooltipster-light inverted',
			touchDevices:false,
			position:'top-left',
			offsetY:2,
			offsetX:1
		});
		jQuery('.grid_image_wrapper').hover(function() {
			jQuery(this).find('.grid_colored_block').stop();
			jQuery(this).find('.prk_magnificent,.prk_magnificent_disabled').stop();
			jQuery(this).find('.prk_magnificent_li_outer').stop();
			jQuery(this).find('.grid_image').stop();
			jQuery(this).find('.grid_single_title .inner_skills').stop();
			var dif=0;
			//ADJUST TITLE VERTICALLY
			if (jQuery(this).find('.grid_single_title .inner_skills').length) {
				dif=jQuery(this).find('.grid_single_title').height()-4;
			}
			if (jQuery(this).parent().hasClass('featured_color')) {
				jQuery(this).find('.grid_colored_block').css({'background-color':hex2rgb(jQuery(this).parent().attr('data-color'),theme_options.custom_opacity_folio)});
			}
			else {
				jQuery(this).find('.grid_colored_block').css({'background-color':hex2rgb(theme_options.active_color,theme_options.custom_opacity_folio)});
			}
			//jQuery(this).find('.grid_single_title .prk_ttl').css({'margin-top':'-10px'});
			jQuery(this).find('.grid_single_title .inner_skills').css({'top':dif});
			jQuery(this).find('.grid_image').animate({
				scale:1.2
			},300);
			jQuery(this).find('.prk_magnificent,.prk_magnificent_disabled').transition({
				opacity:1
			},300);
			jQuery(this).find('.prk_magnificent_li_outer').transition({
				opacity:1
			},300);
			jQuery(this).find('.grid_colored_block').transition({
				opacity:1
			},300);
			jQuery(this).find('.grid_single_title').transition({
				opacity: 1
			},300);
		},
		function()
		{
			jQuery(this).find('.grid_colored_block').stop();
			jQuery(this).find('.grid_single_title').stop();
			jQuery(this).find('.prk_magnificent,.prk_magnificent_disabled').stop();
			jQuery(this).find('.prk_magnificent_li_outer').stop();
			jQuery(this).find('.prk_magnificent,.prk_magnificent_disabled').stop().transition({
				opacity: 0
			},300);
			jQuery(this).find('.prk_magnificent_li_outer').stop().transition({
				opacity: 0
			},300);
			jQuery(this).find('.grid_single_title').stop().transition({
				opacity: 0
			},300);
			jQuery(this).find('.grid_image').stop().animate({
				scale:1
			},200);
			jQuery(this).find('.grid_colored_block').stop().delay(0).transition({
				duration:300,
				opacity:0
			});
		});
		jQuery('.member_colored_block').not('.member_colored_block.no_link').hover( function() {
			//NO 1 PIXEL SPACING ON SOME SIZES

			jQuery(this).find('.sh_member_link_icon').stop();
			jQuery(this).find('.sh_member_link_icon').css({'top':'56%','opacity':'0'});
			jQuery(this).find('.sh_member_link_icon').delay(100).animate({'opacity':'1','top':'50%'}, 300 );
			jQuery(this).find('.member_colored_block_in').stop();
			var color_helper=theme_options.active_color;
			if (jQuery(this).parent().parent().attr('data-color')!=="default") {
				color_helper=jQuery(this).parent().parent().attr('data-color');
			}
			jQuery(this).find('.member_colored_block_in').css({'background-color':hex2rgb(color_helper,theme_options.custom_opacity)});
			jQuery(this).find('.member_colored_block_in').animate({
				opacity: 1
			},300);
			jQuery(this).find('.mb_in_img').stop();
			jQuery(this).find('.mb_in_img').animate({
					scale:1.2
				},300); 
		}, 
		function() {
			jQuery(this).find('.sh_member_link_icon').animate({'top':'44%','opacity':'0'}, 300 );
			jQuery(this).find('.member_colored_block_in').stop();
			jQuery(this).find('.member_colored_block_in').delay(100).animate({
				opacity: 0
			},300);
			jQuery(this).find('.mb_in_img').stop();
			jQuery(this).find('.mb_in_img').delay(100).animate({
					scale:1
				},300); 
		});
	}
	//NAV BUTTON ROLLOVER ANIMATIONS
	jQuery("#samba_close").hover(function() {
			if (is_mobile()===false) {
				jQuery(this).children('.navicon-close').stop().transition({ rotate: '0deg' },0);
				jQuery(this).children('.navicon-close').stop().transition({ rotate: '90deg' });
			}
		},	
		function() {
	});
	jQuery("#samba_left").hover(function() {
			if (is_mobile()===false) {
				jQuery('#prk_left_1,#prk_left_2').stop().delay(100).animate({
						'left':'-30px'
					},
					{
						easing:'easeOutQuad',
						duration:300
					}
				);
			}
		},	
		function() {
			jQuery('#prk_left_1,#prk_left_2').stop().css({'left':0});
		}
	);
	jQuery("#samba_right").hover(function() {
			if (is_mobile()===false) {
				jQuery('#prk_right_1,#prk_right_2').stop().delay(100).animate({
						'left':'0px'
					},
					{
						easing:'easeOutQuad',
						duration:300
					}
				);
			}
		},	
		function() {
			jQuery('#prk_right_1,#prk_right_2').stop().css({'left':'-30px'});
		}
	);

	//LOGOS MANAGEMENT
	jQuery('#alt_logo_holder').imagesLoaded( function() {
		jQuery('#alt_logo_holder').css({'margin-top':(-jQuery('#alt_logo_holder img').attr('height')+50)/2});//50 if for the menu button
		jQuery('#alt_logo_holder').stop().animate({
			opacity:1
		},
		{
			easing:'easeOutQuint',
			duration:500,
		});
	});

	//AJAX PAGE LOAD FUNCTIONS
	var prk_content;
	function update_colors() {
		//ACTIVE SUBMENU?
		if (jQuery('#nav-main ul .sub-menu li.active>a').length && jQuery('#nav-main ul .sub-menu li.active>a').attr('data-color')!==undefined) {
			theme_options.active_color=jQuery('#nav-main ul .sub-menu li.active>a').attr('data-color');
		}
		else {
			//ACTIVE PARENT?
			if (jQuery('#nav-main ul>li.active>a').length && jQuery('#nav-main ul>li.active>a').attr('data-color')!==undefined) {
					theme_options.active_color=jQuery('#nav-main ul>li.active>a').attr('data-color');
			}
		}
		jQuery('#copy .not_zero_color,.not_zero_color,.not_zero_color a,#pir_categories li.active a,#back_to_top,#samba_collapse_menu,#back_to_top-collapsed,.woocommerce .star-rating').animate({'color':theme_options.active_color}, 500);
		jQuery('#menu_section .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,.prk_button_like,.theme_tags li.active,.blog_icon,.inner_line_block,.flex-control-nav li a.flex-active,.inner_line_single_block,.home_fader_grid,.theme_button a,.theme_button input,.sidebar_bubble,.big_icon,.single_special_line,#right_rect,#left_rect,.special_line,.member_function,blockquote,#tp_side_plus,.blog_squared_icon,.prk_blockquote.colored_background,.tiny_line,#headings_wrap.back_activated_color,.back_activated_color,#nav-collapsed-icon .prk_menu_block,.wpb_tour .ui-state-active, .wpb_tour .ui-widget-content .ui-state-active, .wpb_tour .ui-widget-header .ui-state-active,  .wpb_tour .ui-tabs .ui-tabs-nav li.ui-state-active, .wpb_tabs .ui-tabs-nav .ui-state-active, .wpb_tabs .ui-tabs-nav .ui-widget-content .ui-state-active, .wpb_tabs .ui-tabs-nav .ui-widget-header .ui-state-active, .wpb_tabs .ui-tabs-nav .ui-tabs .ui-tabs-nav li.ui-state-active,.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header,.prk_accordion .ui-accordion-header,.scode_categories li.active a').not('#author_area.prk_blockquote.colored_background').css({'background-color':theme_options.active_color});
		jQuery('.blog_fader_grid').css({'background-color':hex2rgb(theme_options.active_color,theme_options.custom_opacity)});
		jQuery('#classic_blog_section .blog_content').css({'border-top':'6px solid '+theme_options.active_color});
		jQuery('.prk_titlify_father h1,.prk_titlify_father h2,.prk_titlify_father h3,.prk_titlify_father h4,.prk_titlify_father h6,.prk_titlify_father .widget-title,.prk_titlify_father .prk_vc_title').css({'border-bottom':'4px solid '+theme_options.active_color});
		jQuery('.wpb_tabs .ui-tabs .ui-tabs-panel').css({'border-top':'4px solid '+theme_options.active_color});
		jQuery('.spinner-icon').css({'border-top-color':theme_options.active_color,'border-left-color':theme_options.active_color});
	}
	function deactivate_menu_links() {
		jQuery('#nav-main .sf-menu li.active,#nav-main .sf-menu li.active_father').children('a').stop().transition({
			backgroundColor:theme_options.submenu_color,
			color:theme_options.menu_up_color,
			duration:150
		});
		jQuery('#nav-main ul li.active,#nav-main ul li.active_father').children('a').children('.prk_menu_square').stop().animate({
			width:8,
		},
		{
			easing:'easeOutQuad',
			duration:200
		});
		jQuery('#nav-main ul li.active').removeClass('active');
		jQuery('#nav-main ul li.active_father').removeClass('active_father');
	}
	function update_menu(new_page) {
		//WOOCOMERCE CART TEXT IF NEEDED
		jQuery('#nav-main ul li a').each(function() {
			if (jQuery(this).attr('href')===theme_options.woo_link_for_cart) {
				if (jQuery(this).attr('data-original')===undefined) {
					jQuery(this).attr('data-original','no');
					if (prk_cart_txt!=="") {
						jQuery(this).html(jQuery(this).html()+" ( "+prk_cart_txt+" )");
					}
				}
			}
		});
		//CHECK IF THE CHANGE CAME FROM THE MENU
		if (jQuery('#menu_section.just_clicked').length) {
			jQuery('#menu_section').removeClass('just_clicked');
		}
		else {
			//CHECK IF THERE'S AN EXACT URL MATCH
			var found_url=false;
			jQuery('#nav-main .sf-menu li a').each(function() {
				if (jQuery(this).attr('href')===new_page) {
					found_url=true;
					deactivate_menu_links();
					jQuery(this).parent().addClass('active');
					jQuery(this).stop().transition({
						delay:100,
						backgroundColor:theme_options.menu_subheadings_color,
						color:theme_options.menu_active_color,
						duration:150
					});
					if (jQuery(this).attr('data-color')!==undefined && theme_options.use_custom_colors==="yes") {
						theme_options.active_color=jQuery(this).attr('data-color');
					}
					jQuery(this).children('.prk_menu_square').stop().animate({
						backgroundColor:jQuery(this).attr('data-color'),
						width:14,
					},
					{
						easing:'easeOutQuad',
						duration:200
					});
					close_inactive_submenus();
					//OPEN SUBMENU IF NEEDED
					if (jQuery('#nav-main ul .sub-menu li.active>a').length) {
						jQuery('#nav-main ul .sub-menu li.active>a').parent().parent().parent().find('.prk_btm_square').transition({ rotate: '45deg' });
						///jQuery('#nav-main ul .sub-menu li.active>a').parent().parent().parent().find('.prk_btm_square').addClass('icon-minus');
						///jQuery('#nav-main ul .sub-menu li.active>a').parent().parent().parent().find('.prk_btm_square').removeClass('icon-plus');
						jQuery('#nav-main ul .sub-menu li.active>a').children('.prk_menu_square').css({'width':'14px'});
						jQuery('#nav-main ul .sub-menu li.active').parent().parent().children('.sub-menu').slideDown({
							'duration':'normal',
							step: function(now, fx) {
								if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
								jQuery(window).trigger("debouncedresize");
								}
							},
							complete:function() {
								jQuery(window).trigger("debouncedresize");
							}
						});
						//OPEN SUBMENU IF NEEDED (THIRD LEVEL)
						if(jQuery('#nav-main ul .sub-menu li.active').parent().parent().parent().parent().children('.sub-menu').length) {
							jQuery('#nav-main ul .sub-menu li.active>a').parent().parent().parent().parent().parent().find('.prk_btm_square').transition({ rotate: '45deg' });
							jQuery('#nav-main ul .sub-menu li.active').parent().parent().parent().parent().children('.sub-menu').slideDown({
								'duration':'normal',
								step: function(now, fx) {
									if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
									jQuery(window).trigger("debouncedresize");
									}
								},
								complete:function() {
									jQuery(window).trigger("debouncedresize");
								}
							});
						}
					}
					//TRY TO OPEN WOOCOMMERCE SUBMENUS IF NEEDED
					jQuery('#nav-main ul li.menu-item-has-children.current-product_cat-parent>a').each(function() {
						jQuery(this).parent().parent().parent().children('.prk_btm_square').transition({ rotate: '45deg' });
						jQuery(this).children('.prk_menu_square').css({'width':'14px'});
						jQuery(this).parent().parent().parent().children('.sub-menu').slideDown({ 
							'duration':'normal',
							step: function(now, fx) {
								if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
								jQuery(window).trigger("debouncedresize");
								}
							},
							complete:function() {
								jQuery(window).trigger("debouncedresize");
							}
						});
					});
				}
			});
			if (found_url===false) {
				//TRY TO HIGHLIGHT PARENT ON SINGLES PAGE
				if (jQuery('.prk_no_change').length) {
					if (jQuery('#content').attr('data-parent')!==undefined) {
						jQuery('#nav-main .sf-menu li a').each(function() {
							if (jQuery(this).attr('href')===jQuery('#content').attr('data-parent')) {
								found_url=true;
								deactivate_menu_links();
								jQuery(this).parent().addClass('active');
								jQuery(this).stop().transition({
									delay:100,
									backgroundColor:theme_options.menu_subheadings_color,
									color:theme_options.menu_active_color,
									duration:150
								});
								if (jQuery(this).attr('data-color')!==undefined && theme_options.use_custom_colors==="yes") {
									theme_options.active_color=jQuery(this).attr('data-color');
								}
								jQuery(this).children('.prk_menu_square').stop().animate({
									backgroundColor:jQuery(this).attr('data-color'),
									width:14,
								},
								{
									easing:'easeOutQuad',
									duration:200
								});
								//OPEN SUBMENU IF NEEDED
								if (jQuery('#nav-main ul .sub-menu li.active>a').length) {
									jQuery('#nav-main ul .sub-menu li.active>a').parent().parent().parent().find('.prk_btm_square').transition({ rotate: '45deg' });
									jQuery('#nav-main ul .sub-menu li.active>a').children('.prk_menu_square').css({'width':'14px'});
									jQuery('#nav-main ul .sub-menu li.active').parent().parent().children('.sub-menu').slideDown({
										'duration':'normal',
										step: function(now, fx) {
											if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
											jQuery(window).trigger("debouncedresize");
											}
										},
										complete:function() {
											jQuery(window).trigger("debouncedresize");
										}
									});
								}
								//OPEN SUBMENU IF NEEDED (THIRD LEVEL)
								jQuery('#nav-main ul .sub-menu li.active').parent().parent().parent().parent().children('.sub-menu').slideDown({
									'duration':'normal',
									step: function(now, fx) {
										if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
										jQuery(window).trigger("debouncedresize");
										}
									},
									complete:function() {
										jQuery(window).trigger("debouncedresize");
									}
								});
								//TRY TO OPEN WOOCOMMERCE SUBMENUS IF NEEDED
								jQuery('#nav-main ul li.menu-item-has-children.current-product_cat-parent>a').each(function() {
									jQuery(this).parent().parent().parent().children('.prk_btm_square').transition({ rotate: '45deg' });
									jQuery(this).children('.prk_menu_square').css({'width':'14px'});
									jQuery(this).parent().parent().parent().children('.sub-menu').slideDown({ 
										'duration':'normal',
										step: function(now, fx) {
											if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
											jQuery(window).trigger("debouncedresize");
											}
										},
										complete:function() {
											jQuery(window).trigger("debouncedresize");
										}
									});
								});
							}
						});
					}
				}
				else {
					//HIGHLIGHT WOOCOMERCE IF NEEDED
					jQuery('#nav-main ul li a').each(function() {
						if (jQuery(this).attr('href')===theme_options.woo_link)
						{
							jQuery(this).parent().addClass('active');
							if (prk_cart_txt!=="") {
								jQuery(this).parent().parent().parent().children('a').attr('data-subheader',prk_cart_txt);
							}
						}
					});
					//TRY TO OPEN WOOCOMERCE SUBMENUS IF NEEDED 
					if (jQuery('#nav-main ul li.menu-item-has-children.current-product-ancestor').length) {
						//MAIN MENU LINK
						jQuery('#nav-main>div>ul>li.menu-item-has-children.active').children('.sub-menu').slideDown({
							'duration':'normal',
							step: function(now, fx) {
								if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
								jQuery(window).trigger("debouncedresize");
								}
							},
							complete:function() {
								jQuery(window).trigger("debouncedresize");
							}
						});
						jQuery('#nav-main ul li.menu-item-has-children.current-product-ancestor').parent().parent().parent().children('.prk_btm_square').transition({ rotate: '45deg' });
						jQuery('#nav-main ul li.menu-item-has-children.current-product-ancestor').children('.prk_menu_square').css({'width':'14px'});
						jQuery('#nav-main ul li.menu-item-has-children.current-product-ancestor').parent().parent().parent().children('.sub-menu').slideDown({
							'duration':'normal',
							step: function(now, fx) {
								if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
								jQuery(window).trigger("debouncedresize");
								}
							},
							complete:function() {
								jQuery(window).trigger("debouncedresize");
							}
						});
					}
				}
			}
		}
	}
	function update_page_meta(text) {
		var new_title = text.find('.prk_page_ttl').text();
		document.title = new_title;
		jQuery('body').removeClass();
		jQuery('body').addClass(text.find('.prk_body_classes').text().substring(7, text.find('.prk_body_classes').text().length-1));
	}
	function show_new_page(ajax_page,text) {
		prk_content.html('');
		var loaded_html = jQuery(text);
		var new_inner = loaded_html.find('#centered_block');
		current_URL=jQuery(location).attr('href');
		prk_content.append(new_inner);
		update_menu(ajax_page);
		jQuery('#main_block,#sidebar').css({'opacity':'0','visibility':'visible'});
		jQuery('#main_block,#sidebar').delay(500).animate({opacity:'1'}, 300);	
		update_page_meta(loaded_html);
		ended_loading();
		jQuery('body,html').animate({scrollTop:0},0);
		if (location.href.indexOf("#")!==-1) {
			setTimeout(function(){ jQuery('html,body').animate({scrollTop:jQuery(''+location.href.substr(location.href.indexOf("#"))+'').offset().top}, 0);},100);
		}
	}
	function load_ajax_link(ajax_page,change_history) {
		jQuery('body,html').animate({scrollTop:0},600);
		jQuery.ajax({
			url: ajax_page,
			dataType: 'html',
			async: true,
			success: function (text) {
				//HIDE PRELOADER
				if (change_history===true && window.history.pushState) {
					var pageurl = ajax_page;
					if (pageurl !== window.location) {
						window.history.pushState({
						path: pageurl
						}, '', pageurl);
					}
				}
				show_new_page(ajax_page,text);
			},
			error: function () {
				//SHOW 404 ERROR PAGE
				window.location.replace(ajax_page);
			}
		});
	}
	function close_top_bar(timing) {
		if (jQuery('#top_bar_wrapper').css('display')==='block') {
			jQuery('.prk_right_panel').stop().animate({'opacity':0},timing/2);
			jQuery('#top_bar_wrapper').stop().animate({
				top:'-51px'
				}, 
				{
					easing:'easeOutQuad',
					duration:timing,
					complete:function() {
						jQuery('#top_bar_wrapper').css({'display':'none','background-color':theme_options.active_color,'left':''});
					}
				}
			);
		}
	}
	function close_inactive_submenus() {
		jQuery('#nav-main .sub-menu').each(function() {
			if (!jQuery(this).find('li.active').length){
				jQuery(this).parent().children('a').children('.prk_btm_square').stop().transition({ rotate: '0deg' });
				///jQuery(this).parent().children('a').children('.prk_btm_square').removeClass('icon-minus');
				///jQuery(this).parent().children('a').children('.prk_btm_square').addClass('icon-plus');
				jQuery(this).slideUp({
					'duration':'fast',
					complete:function() {
						jQuery(window).trigger("debouncedresize");
					}
				});
			}
		});
	}

	//EMAIL SEND FEATURE
	function ajaxSubmit() {
		var prk_form_content = jQuery('#contact-form').serialize();
		var data = {
			action: 'mail_before_submit',
			email_wrap: prk_form_content,
			_ajax_nonce:ajax_var.nonce
		};
		jQuery.post(ajax_var.url, data, function(response) {
		if(response === 'sent0') {
				jQuery("#contact_ok").html(jQuery('#contact-form').attr('data-ok'));
			}
			else {
				jQuery("#contact_ok").html(response);
			}
		});
		return false;
    }
	//ANCHOR TAGS DELAYED SCRIPT
	jQuery("a.fade_anchor,a.fade_anchor_menu,.fade_anchor a,.titled_block .fade_anchor a,#members_nav .fade_anchor a,.single_blog_meta_div .theme_button.fade_anchor a,.blog_categories a,.side_skills a").live('click', function(event) {
		if (jQuery(this).attr("target")==="_blank" || jQuery(this).parent().hasClass('regular_load') || jQuery(this).parent().hasClass('smooth_anchor')) {
			//OPEN LINK NORMALLY
		}
		else {
			if (ajax_calls) {
				//SPECIAL BEHAVIOR FOR PARENT PAGES WITH URL LINKS THAT HAVE SUBMENUS
				if (current_URL===jQuery(this).attr("href") && jQuery(this).parent().children('.sub-menu').length) {
					event.preventDefault();
					if(jQuery(this).parent().children('.sub-menu').css('display')==="none") {
						//MENU WILL OPEN
						jQuery(this).parent().children('a').children('.prk_btm_square').stop().transition({ rotate: '45deg' });
						///jQuery(this).parent().children('a').children('.prk_btm_square').addClass('icon-minus');
						///jQuery(this).parent().children('a').children('.prk_btm_square').removeClass('icon-plus');
						//SMOOTH FOOTER POSITION IF NEEDED - TRANSITION EVENTS
						overlap_menu=parseInt(jQuery('.footer').css('top'),10)-(jQuery(this).parent().children('.sub-menu').height()+offset_helper.top);
					}
					else {
						//MENU WILL CLOSE
						jQuery(this).parent().children('a').children('.prk_btm_square').stop().transition({ rotate: '0deg' });
						///jQuery(this).parent().children('a').children('.prk_btm_square').removeClass('icon-minus');
						///jQuery(this).parent().children('a').children('.prk_btm_square').addClass('icon-plus');
						//SMOOTH FOOTER POSITION IF NEEDED - TRANSITION EVENTS
						overlap_menu=jQuery(window).height()-offset_helper.top-jQuery('.footer').height()+jQuery(this).parent().children('.sub-menu').height();
					}
					if(jQuery(this).parent().children('.sub-menu').css('display')==="block" && jQuery(this).parent().children('.sub-menu').children('li.active').length>0) {
						jQuery(this).parent().addClass('active_father');
					}
					else {
						jQuery(this).parent().removeClass('active_father');
					}
					jQuery(this).parent().children('.sub-menu').slideToggle({
						'duration':'fast',
						step: function(now, fx) {
						if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
							jQuery(window).trigger("debouncedresize");
						}
						},
						complete:function() {
							jQuery(window).trigger("debouncedresize");
						}
					});
					return;
				}
				if (jQuery(this).hasClass('fade_anchor_menu') && jQuery(this).attr("href")==="#") {
					event.preventDefault();
				}
				if (loading_page===false && jQuery(this).attr("href")!=="#" && !event.metaKey && current_URL!==jQuery(this).attr("href")  && admin_bar_height!=="0") {
					event.preventDefault();
					loading_page=true;
					var next_page=jQuery(this).attr("href");
					var new_color="";
					if (jQuery(this).hasClass('fade_anchor_menu')) {
						if (current_URL!==jQuery(this).attr("href") && jQuery(this).attr("href")!==theme_options.woo_link || (jQuery(this).attr("href")===theme_options.woo_link && !jQuery(this).parent().hasClass('active'))) {
							deactivate_menu_links();
						}
						jQuery('#menu_section').addClass('just_clicked');
						new_color=jQuery(this).attr('data-color');
						jQuery(this).parent().addClass('active');
						if (jQuery('#st-container.st-menu-open').length) {
							click_on_body('close_flag');
						}
						if (menu_is_open===true) {
							prk_toggle_menu();		
						}
						close_inactive_submenus();
					}
					if (jQuery(this).hasClass('fade_anchor') && jQuery(this).attr('data-color')!==undefined && jQuery(this).attr('data-color')!=="default") {
						new_color=jQuery(this).attr('data-color');
					}
					if (new_color==="" || theme_options.use_custom_colors==="no") {
						new_color=theme_options.active_color;
					}
					close_top_bar(400);
					jQuery('#sidebar').stop().animate({
							opacity:0
						}, 
						{
							easing:'linear',
							duration:300
						}
					);
					//NO VIEMO FLICK ON SAFARI
					if (navigator.userAgent.indexOf("Safari") > -1) {
						jQuery('#classic_blog_section').css({'opacity':0});
					}
					jQuery('#main_block').stop().animate({
						opacity:0
						}, 
						{
							easing:'linear',
							duration:300,
							complete:function() {
								load_ajax_link(next_page,true);
								NProgress.start();
								jQuery('#nprogress .bar').css({'background-color':new_color});
								if (jQuery('#prk_responsive_menu.at_top').length) {
									jQuery('#nprogress .bar').css({'top':'50px'});
									jQuery('#nprogress .spinner').css({'top':'65px'});
								}
								jQuery('.spinner-icon').css({'border-top-color':new_color,'border-left-color':new_color});
								jQuery('#nav-collapsed-icon .prk_menu_block').animate({'background-color':new_color}, 500);
							}
						}
					);
				}
				//DON'T RELOAD CURRENT PAGES AND WAIT IF STILL LOADING PREVIOUS PAGE
				if (current_URL===jQuery(this).attr("href") || loading_page===true) {
					event.preventDefault();
				}
				if (jQuery(this).parent().children('.sub-menu').length) {
					if(jQuery(this).parent().children('.sub-menu').css('display')==="none") {
						//MENU WILL OPEN
						jQuery(this).parent().children('a').children('.prk_btm_square').stop().transition({ rotate: '45deg' });
						//SMOOTH FOOTER POSITION IF NEEDED - TRANSITION EVENTS
						overlap_menu=parseInt(jQuery('.footer').css('top'),10)-(jQuery(this).parent().children('.sub-menu').height()+offset_helper.top);
					}
					else {
						//MENU WILL CLOSE
						jQuery(this).parent().children('a').children('.prk_btm_square').stop().transition({ rotate: '0deg' });
						//SMOOTH FOOTER POSITION IF NEEDED - TRANSITION EVENTS
						overlap_menu=jQuery(window).height()-offset_helper.top-jQuery('.footer').height()+jQuery(this).parent().children('.sub-menu').height();
					}
					
					if(jQuery(this).parent().children('.sub-menu').css('display')==="block" && jQuery(this).parent().children('.sub-menu').children('li.active').length>0) {
						jQuery(this).parent().addClass('active_father');
					}
					else {
						jQuery(this).parent().removeClass('active_father');
					}
					jQuery(this).parent().children('.sub-menu').slideToggle({
						'duration':'fast',
						step: function(now, fx) {
							if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
							jQuery(window).trigger("debouncedresize");
						}
						},
						complete:function() {
							jQuery(window).trigger("debouncedresize");
						}
					});
				}
			}
			else {
				//HANDLE SUBMENUS
				//SPECIAL BEHAVIOR FOR PARENT PAGES WITH URL LINKS THAT HAVE SUBMENUS
				if (current_URL===jQuery(this).attr("href") && jQuery(this).parent().children('.sub-menu').length) {
					event.preventDefault();
					if(jQuery(this).parent().children('.sub-menu').css('display')==="none") {
						//MENU WILL OPEN
						jQuery(this).parent().children('a').children('.prk_btm_square').stop().transition({ rotate: '45deg' });
						///jQuery(this).parent().children('a').children('.prk_btm_square').addClass('icon-minus');
						///jQuery(this).parent().children('a').children('.prk_btm_square').removeClass('icon-plus');
						//SMOOTH FOOTER POSITION IF NEEDED - TRANSITION EVENTS
						overlap_menu=parseInt(jQuery('.footer').css('top'),10)-(jQuery(this).parent().children('.sub-menu').height()+offset_helper.top);
					}
					else {
						//MENU WILL CLOSE
						jQuery(this).parent().children('a').children('.prk_btm_square').stop().transition({ rotate: '0deg' });
						///jQuery(this).parent().children('a').children('.prk_btm_square').removeClass('icon-minus');
						///jQuery(this).parent().children('a').children('.prk_btm_square').addClass('icon-plus');
						//SMOOTH FOOTER POSITION IF NEEDED - TRANSITION EVENTS
						overlap_menu=jQuery(window).height()-offset_helper.top-jQuery('.footer').height()+jQuery(this).parent().children('.sub-menu').height();
					}
					if(jQuery(this).parent().children('.sub-menu').css('display')==="block" && jQuery(this).parent().children('.sub-menu').children('li.active').length>0) {
						jQuery(this).parent().addClass('active_father');
					}
					else {
						jQuery(this).parent().removeClass('active_father');
					}
					jQuery(this).parent().children('.sub-menu').slideToggle({
						'duration':'fast',
						step: function(now, fx) {
						if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
							jQuery(window).trigger("debouncedresize");
						}
						},
						complete:function() {
							jQuery(window).trigger("debouncedresize");
						}
						});
					return;
				}
				else {
					if (jQuery(this).parent().children('.sub-menu').length) {
						if(jQuery(this).parent().children('.sub-menu').css('display')==="none") {
							//MENU WILL OPEN
							jQuery(this).parent().children('a').children('.prk_btm_square').stop().transition({ rotate: '45deg' });
							///jQuery(this).parent().children('a').children('.prk_btm_square').addClass('icon-minus');
							///jQuery(this).parent().children('a').children('.prk_btm_square').removeClass('icon-plus');
							//SMOOTH FOOTER POSITION IF NEEDED - TRANSITION EVENTS
							overlap_menu=parseInt(jQuery('.footer').css('top'),10)-(jQuery(this).parent().children('.sub-menu').height()+offset_helper.top);
						}
						else {
							//MENU WILL CLOSE
							jQuery(this).parent().children('a').children('.prk_btm_square').stop().transition({ rotate: '0deg' });
							///jQuery(this).parent().children('a').children('.prk_btm_square').removeClass('icon-minus');
							///jQuery(this).parent().children('a').children('.prk_btm_square').addClass('icon-plus');
							//SMOOTH FOOTER POSITION IF NEEDED - TRANSITION EVENTS
							overlap_menu=jQuery(window).height()-offset_helper.top-jQuery('.footer').height()+jQuery(this).parent().children('.sub-menu').height();
						}
						
						if(jQuery(this).parent().children('.sub-menu').css('display')==="block" && jQuery(this).parent().children('.sub-menu').children('li.active').length>0) {
							jQuery(this).parent().addClass('active_father');
						}
						else {
							jQuery(this).parent().removeClass('active_father');
						}
						jQuery(this).parent().children('.sub-menu').slideToggle({
							'duration':'fast',
							step: function(now, fx) {
								if ((overlap_menu<0 && jQuery('.footer').css('position')==='absolute') || (overlap_menu>0 && jQuery('.footer').css('position')==='relative')) {
								jQuery(window).trigger("debouncedresize");
							}
							},
							complete:function() {
								jQuery(window).trigger("debouncedresize");
							}
						});
					}
				}
			}
		}
	});

	//AJAX FOR PORTFOLIO PAGES
	var ajax_in_pos=0;
	var offset_ajax=0;
	var ajax_link="";
	var ajax_id="";
	var ajax_single_layout="";
	//AJAX LOAD FUNCTIONS
	function switch_projects(sense) {
		if (sense==='back') {
			ajax_in_pos=parseInt(ajax_in_pos,10)-1;
			var flag=true;
			while (flag) {
				if (jQuery('.iso_folio>div:nth-child('+parseInt((ajax_in_pos+1),10)+')').hasClass(curr_filter)) {
					flag=false;
				}
				else {
					ajax_in_pos=parseInt(ajax_in_pos,10)-1;
					if (ajax_in_pos<0) {
						ajax_in_pos=jQuery('.iso_folio>div').length-1;
					}
				}
			}
			load_ajax_element(jQuery('.iso_folio>div:nth-child('+parseInt((ajax_in_pos+1),10)+') a.prk_trigger_ajax').attr('data-ajax_id'),ajax_single_layout);
		}
		else {
			ajax_in_pos=parseInt(ajax_in_pos,10)+1;
			var flag=true;
			while (flag) {
				if (jQuery('.iso_folio>div:nth-child('+parseInt((ajax_in_pos+1),10)+')').hasClass(curr_filter)) {
					flag=false;
				}
				else {
					ajax_in_pos=parseInt(ajax_in_pos,10)+1;
					if (ajax_in_pos>jQuery('.iso_folio>div').length) {
						ajax_in_pos=0;
					}
				}
			}
			load_ajax_element(jQuery('.iso_folio>div:nth-child('+parseInt((ajax_in_pos+1),10)+') a.prk_trigger_ajax').attr('data-ajax_id'),ajax_single_layout);
		}
	}
	function load_ajax_element(ajax_id,ajax_single_layout) {
		jQuery('#prk_ajax_container_folio').load(ajax_link,{ 
			entry_id : ajax_id, 
			entry_layout:ajax_single_layout, 
			retina_device:jQuery('#prk_ajax_container_folio').attr('data-retina')},function() {
			//HIDE PRELOADER
			prk_init_sharrre();
			thumbs_roll();
			//GALLERIES
			jQuery('.popup-gallery').magnificPopup({
				delegate: 'a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
			if (ajax_single_layout==="full" || ajax_single_layout==="fullout") {
				//INITIALIZE CONTENT
				jQuery('#single_slider .slides').imagesLoaded(function() {
					init_sliders();
				});
				jQuery(window).trigger("debouncedresize");
				jQuery('.prk_right_panel').stop();
				jQuery('.prk_right_panel').css({'opacity':0});
				setTimeout(function(){ update_top_bar();},700);
				if (jQuery('#prk_full_folio.featured_color').length) {
					jQuery('#top_bar_wrapper').animate({'background-color':jQuery('#prk_full_folio.featured_color').attr('data-color')}, 500);
					jQuery("#full_portfolio_link .colored_button").css({'background-color':jQuery('#prk_full_folio.featured_color').attr('data-color')});
					jQuery('#prk_full_folio').find('.prk_titlify_father h1,.prk_titlify_father h2,.prk_titlify_father h3,.prk_titlify_father h4,.prk_titlify_father h6,.prk_titlify_father .widget-title,.prk_titlify_father .prk_vc_title').stop().css({'border-bottom':'4px solid '+jQuery('#prk_full_folio.featured_color').attr('data-color')});
				}
				else {
					jQuery('#top_bar_wrapper').animate({'background-color':theme_options.active_color}, 500);
					jQuery("#full_portfolio_link .colored_button").css({'background-color':theme_options.active_color});
					jQuery('#prk_full_folio').find('.prk_titlify_father h3').stop().css({'border-bottom':'4px solid '+theme_options.active_color});
				}
				jQuery('.project_ajax_loader').animate({opacity:0}, 200);
				//CHECK IF WE NEED TO MOVE THE PORTFOLIO
				if (jQuery('#prk_ajax_container_folio').css('display')==='none') {
					jQuery('#prk_ajax_container_folio').slideUp(0);
					jQuery('html, body').animate({scrollTop:offset_ajax}, 500, 
						function() {
							jQuery('#aj_loader_wrapper').css({'margin-top':'50px'});
							jQuery('#prk_ajax_wrapper').css({'display':'block','opacity':'1'});
							jQuery('#prk_ajax_container_folio').slideDown(250, function() {
								loading_page=false;
								showing_ajax_page=true;
								jQuery('#folio_father').css({'min-height':''});
							}
						);	
					});	
				}			
			}//FULL
			
			if (ajax_single_layout==="half") {
				jQuery('#prk_folio_close').click(function() {
					jQuery('html, body').animate({scrollTop:0}, 400);
					jQuery('#aj_loader_wrapper').slideUp(100);
					jQuery('#prk_ajax_container_folio').slideUp(400,
							function() {
							jQuery('#prk_ajax_wrapper').remove();
							jQuery('.single_page_title>h1').stop().animate({opacity:0}, 150, 
							function() {
								jQuery('.single_page_title>h1').html(my_ajax_string);
								jQuery('.single_page_title>h1').stop().animate({opacity:1}, 150);
							});
					});					
				});
				//INITIALIZE CONTENT
				jQuery('#single_slider .slides').imagesLoaded(function() {
					init_sliders();
				});
				jQuery('.prk_right_panel').stop();
				jQuery('.prk_right_panel').css({'opacity':0});
				setTimeout(function(){ update_top_bar();},700);
				if (jQuery('#single_portfolio_half.featured_color').length) {
					jQuery('#top_bar_wrapper').animate({'background-color':jQuery('#single_portfolio_half.featured_color').attr('data-color')}, 500);
					jQuery("#half_portfolio_link .colored_button").css({'background-color':jQuery('#single_portfolio_half.featured_color').attr('data-color')});
				}
				else {
					jQuery('#top_bar_wrapper').animate({'background-color':theme_options.active_color}, 500);
					jQuery("#full_portfolio_link .colored_button").css({'background-color':theme_options.active_color});
					jQuery('#prk_full_folio').find('.prk_titlify_father h3').stop().css({'border-bottom':'4px solid '+theme_options.active_color});
				}
				jQuery('#tiny_line_half').each(function() {
					if (jQuery(this).attr('data-color')!=="default") {
						jQuery(this).css({'background-color':jQuery(this).attr('data-color')});
						jQuery(this).parent().find('.side_skills a').attr('data-color',jQuery(this).attr('data-color'));
					}
					else {
						jQuery(this).css({'background-color':theme_options.active_color});
						jQuery(this).parent().find('.side_skills a').attr('data-color',theme_options.active_color);
					}
				});
				jQuery('.project_ajax_loader').animate({opacity:0}, 200);
				//CHECK IF WE NEED TO MOVE THE PORTFOLIO
				if (jQuery('#prk_ajax_container_folio').css('display')==='none') {
					//RETRIEVE THE CORRECT HEIGHT
					jQuery('#prk_ajax_container_folio').css('display','block');
					half_helper = jQuery('#half_helper');
					offset_half_helper = half_helper.position();
					jQuery('#prk_ajax_container_folio').slideUp(0);
					jQuery('body').animate({scrollTop:offset_ajax}, 500);
					jQuery('html').animate({scrollTop:offset_ajax}, 500, 
						function() {
							jQuery('#aj_loader_wrapper').css({'margin-top':'50px'});
							jQuery('#prk_ajax_wrapper').css({'display':'block','opacity':'0'});
							jQuery('#prk_ajax_wrapper').transition({'opacity':'1'});
							jQuery('#prk_ajax_wrapper').css({'min-height':parseInt(offset_half_helper.top,10)-30});
							jQuery('#prk_ajax_container_folio').slideDown(250, function() {
								loading_page=false;
								showing_ajax_page=true;
								jQuery('#folio_father').css({'min-height':''});
							});	
						}
					);	
				}
			}//HALF
		});
	}//AJAX LOAD FUNCTION
	//AJAX ANCHORS
	jQuery('a.prk_trigger_ajax').live("click",function(event) {
		event.preventDefault();
		jQuery('.project_ajax_loader .spinner-icon').css({'border-top-color':theme_options.lines_color,'border-left-color':theme_options.lines_color});
		ajax_link=jQuery('#prk_ajax_container_folio').attr('data-ajax_path');
		ajax_single_layout=jQuery('#prk_ajax_container_folio').attr('data-ajax_layout');
		ajax_id=jQuery(this).attr('data-ajax_id');
		ajax_in_pos=jQuery(this).parent().parent().index();
		var timer=jQuery(document).scrollTop();
		if (timer>400) {
			timer=400;
		}
		jQuery('html, body').animate({scrollTop:0}, timer);
		if (jQuery('#prk_ajax_container_folio').css('display')==='none') {
			jQuery('#aj_loader_wrapper').css({'margin-top':'0px'});
			jQuery('#aj_loader_wrapper').delay(timer-50).slideDown(300, "easeInSine",
				function() {
					jQuery('.project_ajax_loader').animate({opacity:1}, 200);
					load_ajax_element(ajax_id,ajax_single_layout);
				}
			);
		}
		else {
			jQuery('#prk_ajax_container_folio').delay(timer-50).slideUp(300,
				function() {
					jQuery('.project_ajax_loader').animate({opacity:1}, 200);
					load_ajax_element(ajax_id,ajax_single_layout);
				}
			);
		}
	});

	//AJAX LAZY LOAD MORE POSTS FUNCTIONS
	var jq_paged=-1;
	var jq_max=0;
	var jq_load=false;
	var delayed_counter=2;
	function load_more_ps() {
		var orig_text;
		var link;
		var new_url;
		var items_nr_before;
		//CLASSIC BLOG 
		if (jQuery('#entries_navigation .nx_lnk_wp>a').length)
		{
			jq_load=true;
			jQuery("#pir_loader_wrapper").css({'visibility':'visible','opacity':'1'});
			if (jq_paged===-1)
			{
				jq_paged=parseInt(jQuery('#entries_navigation .nx_lnk_wp>a').parent().parent().attr('data-pir_curr'),10)+1;
			}
			jq_max=jQuery('#entries_navigation .nx_lnk_wp>a').parent().parent().attr('data-pir_max');
			link = jQuery('#entries_navigation .nx_lnk_wp>a').attr('href');
			if (theme_options.home_link!=="" && jq_paged===2)
			{
				link = link.replace(theme_options.home_link, theme_options.home_link+theme_options.home_slug+'/');
			}
			jQuery('li').removeClass('last_li');
			jQuery('#dump').append('<div id=more_content_'+jq_paged+'></div>');
			jQuery('#more_content_'+jq_paged+'').load(link+' #classic_blog_section',function()
			{
				var $newEls = jQuery('#more_content_'+delayed_counter+' #blog_entries> *');
				new_url=jQuery('#more_content_'+delayed_counter+' .nx_lnk_wp a').attr('href');
				jQuery('#wrap #blog_entries').append($newEls);
				jQuery('#entries_navigation .nx_lnk_wp>a').attr('href',new_url);
				jQuery('#dump').html('');
				//OVERRIDE COLORS IF NEEDED
				if (theme_options.use_custom_colors==="no") {
					change_data_color_values();
				}
				//APPLY SPECIAL JQUERY FUNCTIONS
				thumbs_roll();
				update_colors();
				init_blog();

				//INCREASE COUNTER
				delayed_counter++;
				jQuery("#pir_loader_wrapper").stop().fadeTo('slow', 0,function()
				{
					
				});
				if (jq_paged<=jq_max)
				{
					jq_load=false;
				}
				else
				{
					jQuery('#entries_navigation').css({'display':'none'});
					jQuery('#no_more').css({'display':'block'});
				}
			});
			jq_paged++;
		}

		//MASONRY BLOG
		if (jQuery('#entries_navigation_mason .nx_lnk_wp>a').length)
		{
			jq_load=true;
			jQuery("#pir_loader_wrapper").css({'visibility':'visible','opacity':'1'});
			if (jq_paged===-1)
			{
				jq_paged=parseInt(jQuery('#entries_navigation_mason .nx_lnk_wp>a').parent().parent().attr('data-pir_curr'),10)+1;
			}
			items_nr_before= jQuery('#blog_entries_masonr>div').length;
			orig_text=jQuery('#entries_navigation_mason .nx_lnk_wp>a').html();
			jq_max=jQuery('#entries_navigation_mason .nx_lnk_wp>a').parent().parent().attr('data-pir_max');
			link = jQuery('#entries_navigation_mason .nx_lnk_wp>a').attr('href');
			if (theme_options.home_link!=="")
			{
				link = link.replace(theme_options.home_link, theme_options.home_link+theme_options.home_slug+'/');
			}
			jQuery('div').removeClass('last_li');
			jQuery('#dump').append('<div id=more_content_'+jq_paged+'></div>');
			jQuery('#more_content_'+jq_paged+'').load(link+' #main_block > *',function()
			{
				//APPLY SPECIAL JQUERY METHODS TO ELEMENTS THAT WERE JUST LOADED
				var $newEls = jQuery('#more_content_'+delayed_counter+' #blog_entries_masonr > *');
				new_url=jQuery('#more_content_'+delayed_counter+' .nx_lnk_wp a').attr('href');
				jQuery('#entries_navigation_mason .nx_lnk_wp>a').attr('href',new_url);
				$newEls.imagesLoaded(function() 
				{
					$container_blog.append($newEls).isotope( 'appended', $newEls,function()
					{
						jQuery('#dump').html('');
						var ctr=1;
						var adjusted_mg=parseInt(jQuery('#blog_entries_masonr').attr('data-margin'),10)-7;
						jQuery('#blog_entries_masonr>div').each(function() {
						if (ctr>items_nr_before)
						{
							jQuery(this).children('.on_colored').css({'margin-bottom':adjusted_mg+'px'});
							jQuery(this).css({opacity:0,'padding':jQuery('#blog_entries_masonr').attr('data-margin')+'px '+jQuery('#blog_entries_masonr').attr('data-margin')+'px 0px'});
							jQuery(this).delay(150).transition({
								opacity:1,
								duration:200,
								easing:'linear'
							});
						}
						ctr++;
						});
						setTimeout(function(){ rearrange_layout();},100);
						//OVERRIDE COLORS IF NEEDED
						if (theme_options.use_custom_colors==="no") {
							change_data_color_values();
						}
						thumbs_roll();
						init_blog();
						jQuery("#pir_loader_wrapper").stop().fadeTo('slow', 0,function()
						{
							
						});
					});//$container_blog.append
					//INCREASE COUNTER
					delayed_counter++;

					if (delayed_counter<=jq_max)
					{
						jq_load=false;
					}
					else
					{
						jQuery('.next-posts').css({'display':'none'});
						jQuery('#no_more').css({'display':'block'});
					}
				});//$newEls.imagesLoaded			
			});
			//INCREASE COUNTER
			jq_paged++;
		}

		//MASONRY AND GRID PORTFOLIO 
		if (jQuery('#next_portfolio_masonry .nx_lnk_wp>a').length)
		{
			jq_load=true;
			jQuery("#pir_loader_wrapper").css({'visibility':'visible','opacity':'1'});
			if (jq_paged===-1)
			{
				jq_paged=parseInt(jQuery('#next_portfolio_masonry .nx_lnk_wp>a').parent().parent().attr('data-pir_curr'),10)+1;
			}
			items_nr_before=jQuery('#folio_masonry>div').length;
			orig_text=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').html();
			jq_max=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').parent().parent().attr('data-pir_max');
			link = jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href');
			if (theme_options.home_link!=="" && jq_paged===2)
			{
				link = link.replace(theme_options.home_link, theme_options.home_link+theme_options.home_slug+'/');
			}
			jQuery('li').removeClass('last_li');
			jQuery('#dump').append('<div id=more_content_'+jq_paged+'></div>');
			jQuery('#more_content_'+jq_paged+'').load(link+' #folio_masonry >*',function()
			{
				var $newEls = jQuery('#more_content_'+delayed_counter+' > *');
				$newEls.imagesLoaded(function() 
				{
					$container = jQuery('#folio_masonry');
					$container.append($newEls).isotope( 'appended', $newEls,function() {
						var ctr=1;
						jQuery('#folio_masonry>div').each(function() {
							jQuery(this).css({'margin-bottom':Math.floor(portfolio_gutter),'margin-right':Math.floor(portfolio_gutter)});
							if (ctr>items_nr_before)
							{
								ctr++;
							}
						});
					});
					jQuery('#folio_father').addClass('dyn_loaded');
					setTimeout(function(){jQuery(window).trigger("smartresize");},50);
					//OVERRIDE COLORS IF NEEDED
					if (theme_options.use_custom_colors==="no") {
						change_data_color_values();
					}
					//UPDATE CONTENT
					calculate_filters();
					thumbs_roll();
					init_sliders();
				});
				//INCREASE COUNTER
				delayed_counter++;
				jQuery("#pir_loader_wrapper").stop().fadeTo('slow', 0,function()
				{
					
				});
				if (jq_paged<=jq_max)
				{
					jQuery('#next_portfolio_masonry .nx_lnk_wp>a').html(orig_text);
					jq_load=false;
				}
				else
				{
					jQuery('.next-posts').css({'display':'none'});
					jQuery('#no_more').css({'display':'block'});
				}
			});
			jq_paged++;
			//ADJUST LINK ACCORDING TO PERMALINK OPTION
			if (jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 1, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length)==='/') {
				new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 2)+jq_paged;
			}
			else {
				new_url=jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href').length - 1)+jq_paged;
			}
			jQuery('#next_portfolio_masonry .nx_lnk_wp>a').attr('href',new_url);
		}

		//TITLED PORTFOLIO 
		if (jQuery('#next_portfolio_titled .nx_lnk_wp>a').length)
		{
			jq_load=true;
			jQuery("#pir_loader_wrapper").css({'visibility':'visible','opacity':'1'});
			if (jq_paged===-1)
			{
				jq_paged=parseInt(jQuery('#next_portfolio_titled .nx_lnk_wp>a').parent().parent().attr('data-pir_curr'),10)+1;
			}
			items_nr_before= jQuery('#folio_titled>div').length;
			orig_text=jQuery('#next_portfolio_titled .nx_lnk_wp>a').html();
			jq_max=jQuery('#next_portfolio_titled .nx_lnk_wp>a').parent().parent().attr('data-pir_max');
			link = jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href');
			if (theme_options.home_link!=="")
			{
				link = link.replace(theme_options.home_link, theme_options.home_link+theme_options.home_slug+'/');
			}
			jQuery('li').removeClass('last_li');
			jQuery('#dump').append('<div id=more_content_'+jq_paged+'></div>');
			jQuery('#more_content_'+jq_paged+'').load(link+' #folio_titled >*',function()
			{
				var $newEls = jQuery('#more_content_'+delayed_counter+' > *');
				$newEls.imagesLoaded(function() {
					$container = jQuery('#folio_titled');
					$container.append($newEls).isotope( 'appended', $newEls,function()
					{
						var ctr=1;
						jQuery('#folio_titled>div').each(function() {
							if (ctr>items_nr_before)
							{
								if (jQuery(this).attr('data-color')!=="default") {
									jQuery(this).find('.tiny_line').css({'background-color':jQuery(this).attr('data-color')});
									jQuery(this).find('.inner_skills a').attr('data-color',jQuery(this).attr('data-color'));
								}
							}
							ctr++;
						});
					});
					jQuery('#folio_father').addClass('dyn_loaded');
					setTimeout(function(){ jQuery(window).trigger("smartresize");},0);
					//OVERRIDE COLORS IF NEEDED
					if (theme_options.use_custom_colors==="no") {
						change_data_color_values();
					}
					//UPDATE CONTENT
					calculate_filters();
					thumbs_roll();
					init_sliders();
				});
				//INCREASE COUNTER
				delayed_counter++;
				jQuery("#pir_loader_wrapper").stop().fadeTo('slow', 0,function()
				{
					
				});
				if (jq_paged<=jq_max)
				{
					jQuery('#next_portfolio_titled .nx_lnk_wp>a').html(orig_text);
					jq_load=false;
				}
				else
				{
					jQuery('.next-posts').css({'display':'none'});
					jQuery('#no_more').css({'display':'block'});
				}
			});
			jq_paged++;
			//ADJUST LINK ACCORDING TO PERMALINK OPTION
			if (jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').substring(jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').length - 1, jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').length)==='/') {
				new_url=jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').length - 2)+jq_paged;
			}
			else {
				new_url=jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').substring(0, jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href').length - 1)+jq_paged;
			}
			jQuery('#next_portfolio_titled .nx_lnk_wp>a').attr('href',new_url);
		}
	}
	jQuery("#pages_static_nav").live('click', function(event) { 
		event.preventDefault();
		load_more_ps();
	});

	//NAVIGATION BUTTONS
	jQuery('#samba_left').live('click', function(event) {
		if (ajax_calls) {
			if (loading_page===false) {
				loading_page=true;
				if (jQuery('#prk_ajax_container_folio').length) {
					if (ajax_in_pos>0) {
						jQuery('html, body').animate({scrollTop:offset_ajax}, 100);
						jQuery('#prk_ajax_container_folio').delay(50).slideUp(400,
							function() {
								jQuery('#prk_ajax_wrapper').remove();
								jQuery('.project_ajax_loader').animate({opacity:1}, 200);
								switch_projects('back');
							}
						);
					}
				}
				else {
					var next_page=jQuery('#prk_nav_left').children('a').attr("href");
					jQuery ('#sidebar').stop().transition({
						opacity:0,
						duration:300
					});
					jQuery ('#main_block').stop().transition({
						opacity:0,
						duration:300 
					},function(){
						NProgress.start();
						jQuery('.spinner-icon').css({'border-top-color':theme_options.site_background_color,'border-left-color':theme_options.site_background_color});
						load_ajax_link(next_page,true);
					});
				}
			}
		}
		else {
			document.location.href=jQuery('#prk_nav_left').children('a').attr("href");
		}
	});
	jQuery('#samba_right').live('click', function(event) {
		if (ajax_calls) {
			if (loading_page===false) {
				loading_page=true;
				if (jQuery('#prk_ajax_container_folio').length) {
					if (ajax_in_pos<(jQuery('.iso_folio>div').length-1)) {
						jQuery('html, body').animate({scrollTop:offset_ajax}, 100);
						jQuery('#prk_ajax_container_folio').delay(50).slideUp(400,
							function() {
								jQuery('#prk_ajax_wrapper').remove();
								jQuery('.project_ajax_loader').animate({opacity:1}, 200);
								switch_projects('forward');
							}
						);
					}
				}
				else {
					var next_page=jQuery('#prk_nav_right').children('a').attr("href");
					jQuery ('#sidebar').stop().transition({
						opacity:0,
						duration:300
					});
					jQuery('#main_block').stop().transition({
						opacity:0,
						duration:300 
					},function(){
						NProgress.start();
						jQuery('.spinner-icon').css({'border-top-color':theme_options.site_background_color,'border-left-color':theme_options.site_background_color});
						load_ajax_link(next_page,true);
					});
				}
			}
		}
		else {
			document.location.href=jQuery('#prk_nav_right').children('a').attr("href");
		}
	});
	jQuery('#samba_close').live('click', function(event) {
		if (ajax_calls) {
			if (loading_page===false) {
				loading_page=true;
				showing_ajax_page=false;
				jQuery('#folio_father').css({'min-height':jQuery(window).height()});
				jQuery('#nav-collapsed-icon .prk_menu_block').animate({'background-color':theme_options.active_color}, 500);
				if (jQuery('#prk_ajax_container_folio').length) {
					//PORTFOLIO AJAX IS ON
					jQuery('html, body').animate({scrollTop:0}, 100);
						jQuery('#aj_loader_wrapper').slideUp(100);
						jQuery('#prk_ajax_container_folio').slideUp(400,
							function() {
							jQuery('#prk_ajax_container_folio #content').remove();
							loading_page=false;
					});
				}
				else {
					var next_page=jQuery('#prk_nav_close').children('a').attr("href");
					jQuery ('#sidebar').stop().transition({
						opacity:0,
						duration:300
					});
					jQuery ('#main_block').stop().transition({
						opacity:0,
						duration:300 
					},function(){
						NProgress.start();
						jQuery('#nprogress .bar').css({'background-color':theme_options.active_color});
						jQuery('.spinner-icon').css({'border-top-color':theme_options.active_color,'border-left-color':theme_options.active_color});
						load_ajax_link(next_page,true);
					});
				}
				close_top_bar(400);
			}
		}
		else {
			document.location.href=jQuery('#prk_nav_close').children('a').attr("href");
		}
	});

	//INITIALIZE CONTENT AND VARIABLES
	//FLEXISLIDER MANIPULATION
	var overlap_menu=0;
	var loading_page=true;
	var showing_ajax_page=false;
	var first_load=true;
	var current_URL=jQuery(location).attr('href');
	var $js_flexislider = jQuery.noConflict();

	//FIX FOR MEDIA QUERIES ON SOME BROWSERS
	var scrollbar_width=window.innerWidth-jQuery("body").width();
	if (jQuery.browser.msie) {
		scrollbar_width=scrollbar_width+1;
	}

	//WINDOW HISTORY MANAGEMENT
	if (ajax_calls && window.history.pushState) {
		jQuery(window).bind('popstate', function () {
			if (current_URL!==jQuery(location).attr('href') && first_load===false && location.href.indexOf("#")===-1) {
				loading_page=true;
				showing_ajax_page=false;
				var next_page=jQuery(location).attr('href');
				jQuery ('#sidebar').stop().transition({
					opacity:0,
					duration:300
				});
				jQuery ('#main_block').stop().transition({
					opacity:0,
					duration:300 
				},function(){
					load_ajax_link(next_page,false);
				});
			}
		});
	}
	function update_top_bar() {
		if (jQuery('#content.has_top_bar').length) {
			if (jQuery('#top_bar_wrapper').css('display')==='none') {
				jQuery('#top_bar_wrapper').css({'top':'-51px','display':'block'});
				jQuery('#top_bar_wrapper').animate({
					top:admin_bar_height
					}, 
					{
						easing:'easeOutQuad',
						duration:400
					}
				);
			}
			jQuery('.prk_right_panel').stop();
			jQuery('.prk_right_panel').css({'opacity':0});
			jQuery('.prk_right_panel').delay(800).animate({'opacity':1});
		}
		else
		{
			close_top_bar(0);
		}
		jQuery('#samba_close').tooltipster('update', jQuery('#prk_nav_close a').attr('data-pir_title'));
		if (jQuery('#prk_nav_left').length) {
			jQuery('#samba_left').css({'display':'block'});
			if (jQuery('#prk_ajax_container_folio').length) {
				if (ajax_in_pos===0) {
					//jQuery('#samba_left').css({'display':'none'});
				}
				jQuery('#samba_left').tooltipster('update', jQuery('#prk_nav_left').attr('data-text'));
			}
			else {
				jQuery('#samba_left').tooltipster('update', jQuery('#prk_nav_left a').attr('data-pir_title'));
			}
			jQuery('#samba_left').stop().animate({
				opacity:1
				}, 
				{
					easing:'easeOutQuad',
					duration:200
				}
			);
		}
		else {
			jQuery('#samba_left').stop().animate({
				opacity:0
			}, 
			{
				easing:'easeOutQuad',
				duration:200,
				complete:function()
				{
					jQuery('#samba_left').css({'display':'none'});
				}
			});
		}
		if (jQuery('#prk_nav_right').length) {
			jQuery('#samba_right').css({'display':'block'});
			if (jQuery('#prk_ajax_container_folio').length) {
				if (ajax_in_pos===(jQuery('.iso_folio>div').length-1)) {
					//jQuery('#samba_right').css({'display':'none'});
				}
				jQuery('#samba_right').tooltipster('update', jQuery('#prk_nav_right').attr('data-text'));
			}
			else {
				jQuery('#samba_right').tooltipster('update', jQuery('#prk_nav_right a').attr('data-pir_title'));
			}
			jQuery('#samba_right').stop().animate({
				opacity:1
				}, 
				{
					easing:'easeOutQuad',
					duration:200
				}
			);
		}
		else {
			jQuery('#samba_right').stop().animate({
				opacity:0
			}, 
			{
				easing:'easeOutQuad',
				duration:200,
				complete:function()
				{
					jQuery('#samba_right').css({'display':'none'});
				}
			});
		}
	}
	function change_data_color_values() {
		jQuery('article,#member_full_row,#folio_masonry>div,#blog_entries_masonr>div,#single_blog_content,#folio_titled>div,#folio_titled .tiny_line,.inner_skills a,#tiny_line_half,li,#sidebar>div,.flex-direction-nav,.theme_button a').not('.prk_inner_block,.single_page_title,#headings_wrap,.colored_link_icon,.clearfix,.prk_service_ctt').attr('data-color',original_active_color);
	}
	//CAN BE CALLED MULTIPLE TIMES IF AJAX PAGE LOADING IS ON
	function ended_loading() {
		//INIT CONTENT
		if (!jQuery('#folio_father,#classic_blog_section,#blog_masonry_father').length ){
			NProgress.done();
		}
		jQuery('html').css({'overflow-y':''});
		jQuery('.main_with_sections').css({'overflow':''});

		//OVERRIDE COLORS IF NEEDED
		if (theme_options.use_custom_colors==="no") {
			change_data_color_values();
		}

		//UPDATE CONTAINER
		prk_content=jQuery("#prk_ajax_container");
 
		//REMOVE PREVIOUS BINDINGS
		jQuery(window).off( "smartresize" );
		//FORCE BLUR ON COMMENTS FORM
		jQuery('#author').blur();
		jQuery('#email').blur();
		jQuery('#url').blur();
		jQuery('#comment').blur();

		//FORM INPUTS FUNCTIONS
		jQuery('.pirenko_highlighted,.pk_contact_highlighted').not('#menu_section .pirenko_highlighted').focus(function (){
			jQuery(this).css({'outline': 'none','border':'1px solid '+theme_options.inactive_color+''});
		});
		//SMOOTHER ANCHORS
	    jQuery('.smooth_anchor a,a.smooth_anchor').live('click', function(event) {
	    	event.preventDefault();
	    	jQuery('html, body').animate({
		        scrollTop: jQuery(jQuery(this).attr('href')).offset().top
		    },500);
		    return false;
	    });
		//CONTACT FORM
		jQuery('#submit_message_div a').click(function(e) {
			e.preventDefault();
			//REMOVE PREVIOUS ERRORS IF THEY EXIST
			jQuery("#contact-form .contact_error").remove();
	    
			//ADD THE TEMPLATE NAME TO THE SUBJECT
			var helper=jQuery('#c_subject').attr('value');
			jQuery('#full_subject').attr('value',jQuery('#contact-form').attr('data-name')+' - '+helper);
			var empty_text_error=jQuery('#contact-form').attr('data-empty');
			var invalid_email_error=jQuery('#contact-form').attr('data-invalid');
			var value, theID, error, emailReg;
			error = false;
	        emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;				
			//DATA VALIDATION
			jQuery('#c_name, #c_email, #c_message').each(function()
	        {
				value = jQuery(this).val();
	            theID = jQuery(this).attr('id');
	            if(value === '' || value=== jQuery(this).attr('data-original'))
	            {
	                if (theID === 'c_message') {
	                    jQuery(this).after('<p class="contact_error zero_color special_italic">'+empty_text_error+'</p>');
	                }
	                else {
						jQuery(this).after('<p class="contact_error zero_color special_italic">'+empty_text_error+'</p>');
					}
	                error = true;
				}
				if(theID === 'c_email' && value !== '' && !emailReg.test(value))
				{
					jQuery(this).after('<p class="contact_error zero_color special_italic">'+invalid_email_error+'</p>');
					error = true;
				}
			});
					
			//SEND EMAIL IF THERE ARE NO ERRORS
			if(error === false)
			{
				//HIDE THE SEND BUTTON
				jQuery("#submit_message_div").fadeTo("slow",0,function() 
				{
					//ON COMPLETE MAKE THE BUTTON INVISIBLE
					jQuery("#submit_message_div").addClass("hidden_div");	
					jQuery("#contact_ok").fadeIn("slow");
					ajaxSubmit();
				});
			}
		});
		//RETINA IMAGES SIZE CHANGE
		jQuery('img.prk_retina').each(function() {
			jQuery(this).width('');
			jQuery(this).height('');
			var original_height=jQuery(this).height();
			//DO NOTHING IF THERE ARE CSS RESTRICTIONS TO THE VERTICAL SIZE
			jQuery(this).css({'max-height':'5000px'});
			if (jQuery(this).height()>original_height) {
				jQuery(this).css({'max-height':''});
			}
			else {
				jQuery(this).width((jQuery(this).width()/2));
				jQuery(this).height((original_height/2));
			}
		});

		jQuery('.wpb_alert').not('.wpb_alert.wpb_alert-info,.wpb_alert.wpb_alert-success,.wpb_alert.wpb_alert-error').each(function() {
			jQuery(this).prepend('<div class="navicon-spam"></div>');
		});
		jQuery('.wpb_alert.wpb_alert-info').each(function() {
			jQuery(this).prepend('<div class="navicon-info"></div>');
		});
		jQuery('.wpb_alert.wpb_alert-success').each(function() {
			jQuery(this).prepend('<div class="navicon-checkmark-circle"></div>');
		});
		jQuery('.wpb_alert.wpb_alert-error').each(function() {
			jQuery(this).prepend('<div class="navicon-cancel-circle"></div>');
		});

		if ($js_flexislider('.comments_slider').length)
		{
			$js_flexislider('.comments_slider').flexslider(
			{
				animation: "fade",
				useCSS  :false,        
				slideshow: true,    
				slideshowSpeed: 5000,    
				animationDuration: 300, 
				smoothHeight: true,
				directionNav: false,   
				controlNav: false,   
				keyboardNav: false,
				touch:false,
				start:function (slider)
				{
					slider.css({'min-height':0});
					jQuery(window).trigger("debouncedresize");
					$js_flexislider('.comments_slider').stop().delay(100).animate({'opacity':'1'}, 100 );
				}
			});
		}
		//HANDLE PLACEHODERS EVEN ON OLDER BROWSERS
		jQuery('[placeholder]').focus(function() {
			var input = jQuery(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			}
			}).blur(function() {
				var input = jQuery(this);
				if (input.val() == '' || input.val() == input.attr('placeholder')) {
					input.addClass('placeholder');
					input.val(input.attr('placeholder'));
				}
			}).blur();
			
		//ADD ARROWS
		jQuery('ul.sitemap_block li a,.widget_rss ul li a, .widget_meta a,.widget_recent_entries a,.widget_categories a,.widget_archive a,.widget_pages a,.widget_links a,.widget_nav_menu a').each(function() {
			jQuery(this).addClass('smoothed_a');
			jQuery(this).prepend('<div class="prk_theme_arrows"><div class="tr_wrapper"><div class="icon-right-open"></div></div></div>');
		});

		//WOOCOMERCERCE
		if (theme_options.active_woocommerce==="true") {
			jQuery('.woocommerce-tabs .panel, .woocommerce form.login, .woocommerce form.checkout_coupon, .woocommerce form.register, .woocommerce-page form.login, .woocommerce-page form.checkout_coupon, .woocommerce-page form.register, .woocommerce #payment,.woocommerce .form-row.place-order, .woocommerce #payment ul.payment_methods, .woocommerce-page #payment ul.payment_methods.woocommerce-tabs .panel.entry-content,.woocommerce-message, .woocommerce-error, .woocommerce-info,.shop_table,.cart_totals>table,.woocommerce #searchform #s').live().addClass('no_radius');
			jQuery('.woocommerce-tabs .panel').addClass("prk_bordered");
			jQuery('.woocommerce-result-count,.woocommerce-review-link').addClass("zero_color header_font");
			jQuery('.woocommerce .reset_variations, .woocommerce h2, .cart_totals h2,.woocommerce h1,.shipping_calculator h2,.checkout h3,.woocommerce h2,.woocommerce h3').not('.prk-woocommerce .woocommerce-tabs h2').addClass('zero_color bd_headings_text_shadow');
			jQuery('.woocommerce .woocommerce-ordering select,.woocommerce-page .woocommerce-ordering select,.woocommerce .input-text,.woocommerce textarea,.woocommerce form .form-row textarea, .woocommerce-page form .form-row textarea').addClass('pirenko_highlighted');
			jQuery('.woocommerce .product_meta .posted_in,.woocommerce .product_meta .tagged_as,.tagcloud').addClass('clearfix');
			jQuery('.prk-woocommerce h1,.woocommerce h2,.woocommerce h3').not('').addClass('header_font');
			jQuery('.woocommerce button').live().addClass('no_radius');
			jQuery('.woocommerce #searchform #searchsubmit').live().addClass('button product_type_simple');
			jQuery('.product .images .thumbnails>a,.product .images>a,.product>a,.widget .product_list_widget a').live().addClass('woo_small_fade');
			jQuery('.woocommerce ul.products li.product a img, .woocommerce-page ul.products li.product a img,.woocommerce div.product div.images img, .woocommerce #content div.product div.images img, .woocommerce-page div.product div.images img, .woocommerce-page #content div.product div.images img,.woocommerce ul.cart_list li img, .woocommerce ul.product_list_widget li img, .woocommerce-page ul.cart_list li img, .woocommerce-page ul.product_list_widget li img').live().addClass('boxed_shadow');
			jQuery('.woocommerce-page #sidebar .tagcloud a').live('mouseover', function() {
				if (is_mobile()===false) {
					if (jQuery(this).attr('data-color')!==undefined) {
						jQuery(this).stop().animate({'backgroundColor': jQuery(this).attr('data-color')}, 200 );
					}
					else {
						jQuery(this).stop().animate({'backgroundColor': theme_options.active_color}, 200 );
					}
				}
			});
			jQuery('.woocommerce-page #sidebar .tagcloud a').live( 'mouseout', function() {
				jQuery(this).stop().animate({'backgroundColor': theme_options.bd_headings_color}, 200 );
			});
			jQuery('.prk-woo-sidebar .product-categories li a').each(function() 
			{
				jQuery(this).prepend('<div class="prk_theme_arrows"><div class="tr_wrapper"><div class="icon-right-open-big"></div></div></div>');
			});
			jQuery('.prk-woo-sidebar .product-categories a').each(function() {
				jQuery(this).addClass('smoothed_a');
			});
			jQuery('.woo_small_fade img').live('mouseover', function() {
				if (is_mobile()===false) {
					jQuery(this).stop().transition({
						opacity:0.8,
						duration:200,
						easing:'linear' 
					});
				}
			});
			jQuery('.woo_small_fade img').live( 'mouseout', function() {
				jQuery(this).stop().transition({
					opacity:1,
					duration:200,
					easing:'linear' 
				});
			});
			jQuery('.woocommerce .woocommerce-ordering select,.woocommerce-page .woocommerce-ordering select').each(function() {
				var curr_text=jQuery(this).parent().find('select option:selected').text();
				jQuery(this).parent().append("<div class='pirenko_highlighed select_twin colored_bg prk_bordered'><div class='twin_text'>"+curr_text+"</div><div class='navicon-menu-2 woo_select_navicon'></div></div>");
				if (!jQuery(this).parent().children('.reset_variations').length) {
					jQuery(this).parent().addClass('no_reset_btn');
				}
				jQuery(this).change(function() {
					var curr_text=jQuery(this).parent().find('select option:selected').text();
					jQuery(this).parent().find('.twin_text').html('');
					jQuery(this).parent().find('.twin_text').html(curr_text);
				});
			});
			jQuery('.product_meta a,.product-name a,a.showcoupon,a.showlogin,a.added_to_cart,.woocommerce-pagination a,.woocommerce-tabs .panel a').live().css({'color':theme_options.woo_color});

			//PRODUCT GALLERIES
			jQuery('.prk-woocommerce').magnificPopup({
				delegate: 'a.prk_woo_magnificent',
				src:'data-src',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('data-title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
		}//END WOOCOMMERCE STUFF

		//VISUAL COMPOSER STUFF
		if (theme_options.active_visual_composer==="true") {
			jQuery('.wpb_single_image a').not('.wpb_single_image a.no_magnize').addClass('image-popup-no-margins boxed_shadow');
			jQuery('.image-popup-no-margins').magnificPopup({
				type: 'image',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				image: {
					verticalFit: true
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
			//GALLERIES
			jQuery('.popup-gallery').each(function() {
				jQuery(this).magnificPopup({
					delegate: 'a',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					fixedContentPos: false,
					fixedBgPos: true,
					closeOnContentClick: true,
					closeBtnInside: false,
					mainClass: 'mfp-no-margins my-mfp-zoom-in',
					removalDelay: 300,
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
						tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
						titleSrc: function(item) {
							return item.el.attr('title');
						}
					},
					callbacks: {
						open: function() {
							scrollbar_width=window.innerWidth-jQuery("body").width();
							jQuery('html').css({'padding-right':scrollbar_width});
							jQuery('html').css({'overflow-y':'hidden'});
							jQuery('.mfp-bg').css({'opacity':0.8});
						},
						beforeClose: function() {
							jQuery('.mfp-bg').css({'opacity':0});
						},
						close: function() {
							jQuery('html').css({'overflow-y':'','padding-right':''});
						}
					}
				});
			});
			jQuery('.wpb_slider_nivo').magnificPopup({
				delegate: 'a.prettyphoto',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
			jQuery('.wpb_single_image a,.wpb_image_grid_ul li a').hover( function() {
				jQuery(this).children('img').stop();
				jQuery(this).children('img').animate({
					opacity: 0.8
				},300);
				}, function() {
					jQuery(this).find('img').stop();
					jQuery(this).find('img').delay(100).animate({
							opacity:1
				},300); 
			});
			jQuery('.wpb_flexslider').each(function() {
				console.log("UH");
				var this_element = jQuery(this);
				var sliderSpeed = 800,
				sliderTimeout = parseInt(this_element.attr('data-interval'),10)*1000,
				sliderFx = this_element.attr('data-flex_fx'),
				slideshow = true;
				if ( sliderTimeout === 0 ) {
					slideshow = false;
				}
				this_element.flexslider({
					animation: sliderFx,
					slideshow: slideshow,
					slideshowSpeed: sliderTimeout,
					sliderSpeed: sliderSpeed,
					controlNav: false,
					smoothHeight: true,
					start:function (slider) {
					jQuery('.flex-direction-nav li a.flex-prev').each(function() 
					{
						jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_left"><div class="icon-left-open-big"></div></div>');
					});
					jQuery('.flex-direction-nav li a.flex-next').each(function() 
					{
						jQuery(this).prepend('<div class="pirenko_tinted submenu_arrow_right"><div class="icon-right-open-big"></div></div>');
					});
					}
				});
			});
			jQuery('.wpb_gallery_slides').each(function(index) {
				var this_element = jQuery(this);

				if ( this_element.hasClass('wpb_slider_nivo') ) {
					var sliderSpeed = 800,
						sliderTimeout = this_element.attr('data-interval')*1000;

					if ( sliderTimeout === 0 ) {
						sliderTimeout = 9999999999;
					}
					this_element.find('.nivoSlider').nivoSlider({
						effect: 'boxRainGrow,boxRain,boxRainReverse,boxRainGrowReverse', // Specify sets like: 'fold,fade,sliceDown'
						slices: 15, // For slice animations
						boxCols: 8, // For box animations
						boxRows: 4, // For box animations
						animSpeed: sliderSpeed, // Slide transition speed
						pauseTime: sliderTimeout, // How long each slide will show
						startSlide: 0, // Set starting Slide (0 index)
						directionNav: true, // Next & Prev navigation
						directionNavHide: true, // Only show on hover
						controlNav: true, // 1,2,3... navigation
						keyboardNav: false, // Use left & right arrows
						pauseOnHover: true, // Stop animation while hovering
						manualAdvance: false, // Force manual transitions
						prevText: 'Prev', // Prev directionNav text
						nextText: 'Next' // Next directionNav text
					});
				}
				else if ( this_element.hasClass('wpb_image_grid') ) {
					var $isotope = this_element.find('.wpb_image_grid_ul');
					$isotope.imagesLoaded(function() {
						$isotope.isotope({
							// options
							itemSelector : '.isotope-item',
							transformsEnabled: false,
							masonry: { columnWidth: Math.floor(jQuery('.wpb_image_grid_ul').width() / 4) },
							resizable: false, // disable normal resizing

						animationEngine : "jquery"
						});
						setTimeout(function(){ jQuery(window).trigger("smartresize");},50);
					});
					jQuery(window).smartresize(function() {
						//SET THE NUMBER OF IMAGES TO SHOW
						var img_nr=2;
						if (jQuery(window).width()<(768 - scrollbar_width)) {
							
							if (jQuery(window).width()<(420 - scrollbar_width)) {
								img_nr=1;
							}
						}
						else {
							img_nr=Math.ceil($isotope.width()/430);
						}
						$isotope.find('.isotope-item').css({'width':'auto'});
						var helper= Math.floor($isotope.width() / img_nr);
						$isotope.find('.isotope-item,.isotope-item img').css({'width':helper});
						$isotope.isotope({
							animationOptions: {
							duration: 450,
							easing:'linear',
						},
							// update columnWidth to a percentage of container width
							masonry: { columnWidth: Math.floor($isotope.width() / img_nr) }
						});
						$isotope.find('.isotope-item').css({'width':helper-1});
						first_cross=false;
					});
				}
			});
			jQuery('.wpb_tour_tabs_wrapper>ul>li').hover(function() {
				if (is_mobile()===false) {
					if (jQuery(this).attr('data-color')!==undefined) {
						jQuery(this).stop().animate({
							backgroundColor:jQuery(this).attr('data-color'),
						},200);
					}
					else {
						jQuery(this).stop().animate({
							backgroundColor:theme_options.active_color,
						},200);
					}
				}
			},	
				function() {
					if (!jQuery(this).hasClass('ui-state-active')) {
						jQuery(this).stop().animate({
							backgroundColor:theme_options.background_color,
						},200);
					}
				}
			);
			var ac_icons = {
					header: "icon-plus-3",
					activeHeader: "icon-minus-1"
				};
			jQuery(".prk_accordion").accordion({
				collapsible: true,
				active: false ,
				autoHeight:false,
				icons: ac_icons,
				change: function() { 
					//MAKE SURE THE HOVER STATE IS GONE
					jQuery(".prk_accordion h3").each(function(){
						jQuery(this).blur();
					});
				}
			});
			vc_tabsBehaviour();
			vc_twitterBehaviour();
			vc_toggleBehaviour();
			vc_accordionBehaviour();
			vc_teaserGrid();
			vc_carouselBehaviour();
			vc_slidersBehaviour();
			vc_prettyPhoto();
			vc_googleplus();
			vc_pinterest();
			vc_progress_bar();
			vc_waypoints();
		}//END VISUAL COMPOSER STUFF

		//FIT SCREENR VIDEOS
		jQuery(".columns").fitVids({ customSelector: "iframe[src^='http://www.screenr.com']"});

		//MAGNIFIC POPUP
		jQuery('.prk_shorts').magnificPopup({
			delegate: 'div.prk_magnificent',
			src:'data-src',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
				}
			}
		});
		jQuery('.pirenko_gallery').each(function(){
			jQuery(this).magnificPopup({
				delegate: 'div.portfolio_entry_li',
				src:'data-src',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
		});
		jQuery('#folio_masonry').magnificPopup({
			delegate: 'a.magna_a',
			src:'data-src',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
				}
			}
		});
		jQuery('#folio_titled').magnificPopup({
			delegate: 'a.magna_a',
			src:'data-src',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
				}
			}
		});
		jQuery('#magner').magnificPopup({
			delegate: 'a.magna_b',
			src:'data-src',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
				}
			}
		});
		jQuery('#d_magner').not('#d_magner.individuals').magnificPopup({
			delegate: 'div.prk_magnificent',
			src:'data-src',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			fixedContentPos: false,
			fixedBgPos: true,
			closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins my-mfp-zoom-in',
			removalDelay: 300,
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return item.el.attr('title');
				}
			},
			callbacks: {
				open: function() {
					scrollbar_width=window.innerWidth-jQuery("body").width();
					jQuery('html').css({'padding-right':scrollbar_width});
					jQuery('html').css({'overflow-y':'hidden'});
					jQuery('.mfp-bg').css({'opacity':0.8});
				},
				beforeClose: function() {
					jQuery('.mfp-bg').css({'opacity':0});
				},
				close: function() {
					jQuery('html').css({'overflow-y':'','padding-right':''});
				}
			}
		});
		jQuery('.portfolio_entry_li').each(function() {
			jQuery(this).magnificPopup({
				delegate: 'div.prk_magnificent',
				src:'data-src',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: false,
				fixedBgPos: true,
				closeOnContentClick: true,
				closeBtnInside: false,
				mainClass: 'mfp-no-margins my-mfp-zoom-in',
				removalDelay: 300,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				callbacks: {
					open: function() {
						scrollbar_width=window.innerWidth-jQuery("body").width();
						jQuery('html').css({'padding-right':scrollbar_width});
						jQuery('html').css({'overflow-y':'hidden'});
						jQuery('.mfp-bg').css({'opacity':0.8});
					},
					beforeClose: function() {
						jQuery('.mfp-bg').css({'opacity':0});
					},
					close: function() {
						jQuery('html').css({'overflow-y':'','padding-right':''});
					}
				}
			});
		});

		//HEADINGS STYLE
		if (jQuery('#headings_wrap').length && jQuery('#headings_wrap').attr('data-color')!==undefined) {
			jQuery('#headings_wrap,#headings_wrap #breadcrumbs.zero_color,#headings_wrap #breadcrumbs.zero_color a').css({'color':jQuery('#headings_wrap').attr('data-color'),'text-shadow':'0px 0px 1px rgba('+jQuery('#headings_wrap').attr('data-c1')+', '+jQuery('#headings_wrap').attr('data-c2')+', '+jQuery('#headings_wrap').attr('data-c3')+',0.3)'});
		}

		//MAILCHIMP && CONTACT FORM 7
		jQuery('.cptch_input,.mc_input,.wpcf7-form input[type="password"],.wpcf7-form input[type="tel"],.wpcf7-form input[type="email"],.wpcf7-form input[type="text"],.wpcf7-form textarea').not('.wpcf7-submit').addClass('pirenko_highlighted');
		jQuery('.mc_signup_submit').addClass('theme_button');
		jQuery('.wpcf7-submit').parent().addClass('theme_button');
		jQuery('#mc_display_rewards a').addClass('not_zero_color');
		
		//CAROUSELS
		jQuery(".prk_rousel").each( function () {
			var this_element = jQuery(this);
			jQuery(this).css({'opacity':0});
			jQuery(this).imagesLoaded(function() {
				var imgs_w=jQuery(this).find('img').attr('width');
				jQuery(this).carouFredSel({
					circular    : true,
					infinite    : true,
					responsive  : true,
					auto : {
						play: false,
						pauseOnHover:true,
						duration    : 1000
					},	//AUTOSTART
					swipe       : {
						onTouch     : true,
						onMouse     : true
					}, 
					items: {
						width:imgs_w,
						visible: {
							min : 2,
							max : 6
						}
					},
					onCreate:function(){
						setTimeout(function(){ 
							jQuery(window).trigger("debouncedresize");
							this_element.animate({'opacity':1},300);
						},150);
					}
				});
			});
		});

		//FORCE TEXTFIELDS BLUR
		jQuery('.pirenko_highlighted,.pk_contact_highlighted').blur(function() {
			jQuery(this).css({'border':'','outline':'none'});
		});

		//SHORTCODES MANAGEMENT
		jQuery('.wpb_row').each(function() {
			if (jQuery(this).find('.prk_price_table').length && !jQuery(this).find('.wpb_row .prk_price_table').length) {
				jQuery(this).children('.row').addClass('tables_father');
			}
		});
		jQuery('.prk_progress_bar').each(function() {
			if( !jQuery(this).hasClass('prk_already_anim') && isScrolledIntoView(jQuery(this))) {
				jQuery(this).addClass('prk_already_anim');
				jQuery(this).children('.active_bar').each(function() {
					jQuery(this).width('50');
					jQuery(this).transition({'width': jQuery(this).attr('data-width')+'%'}, 1400);
				});
			}
		});
		jQuery(".recentposts_ul_shortcode").each( function () {
			var classy=textize(Math.floor(12/jQuery(this).attr('data-columns')));
			jQuery(this).children('li').each(function() {
				if (!jQuery(this).hasClass('clearfix')) {
					jQuery(this).addClass('columns '+classy);
				} 
			});
		});

		jQuery('#sidebar a').not('.tagcloud a').addClass('zero_color');
		if (jQuery('#blog_entries_masonr').length) {
			jQuery('#blog_entries_masonr').css({'opacity':0});
			jQuery('#blog_entries_masonr .blog_entry_li').css({'padding':jQuery('#blog_entries_masonr').attr('data-margin')+'px '+jQuery('#blog_entries_masonr').attr('data-margin')+'px 0px'});
			var adjusted_mg=parseInt(jQuery('#blog_entries_masonr').attr('data-margin'),10)-7;
			jQuery('#blog_entries_masonr .blog_entry_li .on_colored').css({'margin-bottom':adjusted_mg+'px'});
			jQuery('#wrap').css({'max-width':'none'});
		}
		else {
			jQuery('#wrap').css({'max-width':''});
			jQuery('#prk_ajax_container').css({'padding-left':'','padding-right':''});
		}
		if (jQuery('#classic_blog_section').length) {
			jQuery('#classic_blog_section').css({'opacity':0});
		}

		//VARIOUS THEME FUNCTIONS
		thumbs_roll();
		update_colors();
		init_sliders();
		init_blog();
		calculate_filters();
		init_portfolio();
		init_member();
		prk_init_sharrre();

		//FADE IN CONTENT
		jQuery('#top_area,.video-container,.soundcloud-container').css({opacity:1});
		jQuery('.footer').css({'visibility':'visible'});
		jQuery('#main_block,#sidebar').css({'visibility':'visible','opacity':'0'});
		jQuery('#main_block,#sidebar,.prk_rv').transition({
			delay:100,
			opacity:1,
			duration:400,
			easing:'linear' 
		});
		jQuery('#prk_ajax_container').imagesLoaded( function() {
			jQuery(window).trigger("debouncedresize");
		});
		setTimeout(function(){ update_top_bar();},50);
		first_load=false;
		loading_page=false;
	}//ENDED LOADING


	var helper = jQuery('#height_helper');
	var offset_helper = helper.position();
	var half_helper="";
	var offset_half_helper="";
	var bk_ratio=1;
	var height_fix;
	//DELAYED RESIZE LISTENTER
	jQuery(window).on("debouncedresize", function() {
		//LIMIT SLIDER HEIGHT
		//jQuery('#single_slider').css({'height':'','max-height':jQuery(window).height()-130});
		//jQuery('#single_slider img').css({'max-height':jQuery(window).height()-130});
		//jQuery('#single_slider').css({'height':jQuery('#single_slider .flex-active-slide').height()});
		jQuery("#menu_section").height(height_fix);
		offset_helper = helper.position();
		if (parseInt(height_fix-60-offset_helper.top-jQuery('.footer').height(),10)>0 && !is_mobile()) {
			var more_space=0;
			if (jQuery('.no-csstransforms3d .st-pusher').length) {
				more_space=30;
			}
			if (jQuery('.no-csstransforms3d .st-pusher').css('margin-top')==='50px') {
				more_space=44;
			}
			jQuery('.footer').css({'top':parseInt(height_fix-more_space-jQuery('.footer').height(),10),'position':'absolute'});
		}
		else {
			jQuery('.footer').css({'top':20,'position':'relative'});
		}
		jQuery("#menu_section").mCustomScrollbar("update");
		if (jQuery('#folio_father').length && showing_ajax_page===false) {
			jQuery('#folio_father').css({'min-height':jQuery(window).height()});
		}
		else {
			jQuery('#folio_father').css({'min-height':''});
		}
		if (jQuery('#blog_masonry_father').length) {
			jQuery('#blog_masonry_father').css({'min-height':jQuery(window).height()});
			jQuery('#entries_navigation_mason').css({'width':jQuery('#blog_masonry_father').width()});
		}
		if (jQuery('#single_portfolio_half').length) {
			half_helper = jQuery('#half_helper');
			offset_half_helper = half_helper.position();
			jQuery('#single_portfolio_half').css({'min-height':parseInt(offset_half_helper.top,10)});
		}
		if (jQuery('#prk_full_size_single').length) {
			half_helper = jQuery('#half_helper');
			offset_half_helper = half_helper.position();
			jQuery('#prk_full_size_single').css({'min-height':parseInt(offset_half_helper.top,10)});
		}
		if (jQuery('#member_full_row').length) {
			half_helper = jQuery('#half_helper');
			offset_half_helper = half_helper.position();
			jQuery('#member_full_row').css({'min-height':parseInt(offset_half_helper.top,10)+20});
		}
		if (jQuery('#sidebar').length && jQuery('#half_helper').length) {
			half_helper = jQuery('#half_helper');
			offset_half_helper = half_helper.position();
			jQuery('#main').css({'min-height':parseInt(offset_half_helper.top,10)+20});
		}
		if (jQuery('#contact_lower').length) {
			half_helper = jQuery('#half_helper');
			offset_half_helper = half_helper.position();
			jQuery('#contact_lower').css({'min-height':parseInt(offset_half_helper.top,10)});
		}
		if (jQuery('#single-entry-content_half').length) {
			jQuery('body').css({'min-height':jQuery('#single-entry-content_half').outerHeight()+50});
		}
		else {
			jQuery('body').css({'min-height':''});
		}
		if (jQuery('#blog_entries_masonr.isotope').length) {
			rearrange_layout();
		}
		if (jQuery('#full-screen-background-image').attr('src')!==undefined) {
			var dth=jQuery(window).width()-parseInt(jQuery('#full-screen-background-image').css('padding-left'),10);
			var ght=parseInt(jQuery("#full-screen-background-image").attr('data-or_h')*dth/jQuery("#full-screen-background-image").attr('data-or_w'),10);
			if (ght<jQuery(window).height()) {

				ght=jQuery(window).height();
				dth=ght*jQuery("#full-screen-background-image").attr('data-or_w')/jQuery("#full-screen-background-image").attr('data-or_h');
			}
			jQuery("#full-screen-background-image").css({'width':dth,'height':ght,'left':-(dth-(jQuery(window).width()-parseInt(jQuery('#full-screen-background-image').css('padding-left'),10)))/2,'top':-(ght-jQuery(window).height())/2});		
		}
		jQuery('#google-maps iframe').css({'max-height':height_fix-100});
		if (jQuery('#folio_carousel.prk_no_open').length) {
			jQuery('#folio_carousel.prk_no_open .as-background').each(function() {
				jQuery(this).height(height_fix);
				jQuery(this).css({'margin-left':-jQuery(this).width()/2});
			});
		}
		if (jQuery('#folio_carousel.samba_opener').length) {
			jQuery('#folio_carousel.samba_opener .as-background').each(function() {
				jQuery(this).height(height_fix);
			});
		}
		if (!is_mobile()) {
			samba_skrollr.refresh();
		}
	});
	//RESIZE LISTENER
	function pirenko_resize() {
		if (jQuery.browser.msie  && parseInt(jQuery.browser.version, 10) === 8) {
			height_fix = jQuery(window).height()-admin_bar_height;
		}
		else {
			height_fix = window.innerHeight ? window.innerHeight-admin_bar_height : jQuery(window).height()-admin_bar_height;
		}
		scrollbar_width = window.innerWidth - jQuery("body").width();
		if (jQuery.browser.msie) {
			scrollbar_width=scrollbar_width+1;
		}
		jQuery("#menu_section").height(height_fix);
		if (jQuery(window).width()>(theme_options.responsive_width - scrollbar_width)) {
			jQuery('#menu_section,#top_bar_wrapper,#prk_ajax_container').css({'left':''});
			jQuery('#prk_responsive_menu').css({'margin-left':'','left':''});
			jQuery('#alt_logo_holder').css({'display':'inline-block','opacity':1});
			menu_is_open=false;
			document.removeEventListener( eventtype, click_on_body );
			jQuery('#menu_section').removeClass('st-menu st-effect-14');
			jQuery('#st-container').removeClass('st-menu-open');
			jQuery('#body_hider').css({'display':'none'});
			jQuery('#menu_section').css({'margin-left':''});
		}
		else {
			if (!jQuery('#st-container').hasClass('no-csstransforms3d')) {
				jQuery('#menu_section').addClass('st-menu st-effect-14');
			}	
		}
		if (jQuery(window).width()<(768 - scrollbar_width)) {
			jQuery('#prk_responsive_menu,#top_bar_wrapper,.ultra_wrapper').addClass('at_top');
			jQuery('.wpb_call_to_action.cta_align_right .wpb_button_a,.wpb_call_to_action.cta_align_left .wpb_button_a,.wpb_call_to_action.cta_align_right .theme_button,.wpb_call_to_action.cta_align_right .theme_button_inverted,.wpb_call_to_action.cta_align_left .theme_button,.wpb_call_to_action.cta_align_left .theme_button_inverted').each(function() {
				jQuery(this).css({'top':'16px'});
			});
			jQuery('#folio_carousel').css({'min-height':height_fix-50});
		}
		else {
			jQuery('#prk_responsive_menu,#top_bar_wrapper,.ultra_wrapper').removeClass('at_top');
			jQuery('.wpb_call_to_action.cta_align_right .wpb_button_a,.wpb_call_to_action.cta_align_left .wpb_button_a,.wpb_call_to_action.cta_align_right .theme_button,.wpb_call_to_action.cta_align_right .theme_button_inverted,.wpb_call_to_action.cta_align_left .theme_button,.wpb_call_to_action.cta_align_left .theme_button_inverted').each(function() {
				jQuery(this).css({'top':(jQuery(this).parent().parent().height()-jQuery(this).height())/2});
			});
			jQuery('#folio_carousel').css({'min-height':height_fix});
		}
		jQuery('#folio_father.has_carousel').css({'width':jQuery(window).width()+50});
	}
	pirenko_resize();
	jQuery(window).resize(function() {
		pirenko_resize();
	});
	//THIS FUNCTION IS EXECUTED ONLY ONCE
	jQuery(window).load(function() {
		if (isMobileOut()) {
			prk_sensi=false;
			prk_panel_event="click";
		}
		else
		{
			prk_sensi=true;
			prk_panel_event="hover";
		}
		//NO ANIMATION WHEN SITE LOADS
		//UPDATE ACTIVE COLOR: IS IT A SUBMENU?
		if (jQuery('#nav-main ul .sub-menu li.active>a').length && jQuery('#nav-main ul .sub-menu li.active>a').attr('data-color')!==undefined && theme_options.use_custom_colors==="yes") {
			theme_options.active_color=jQuery('#nav-main ul .sub-menu li.active>a').attr('data-color');
		}
		else 
		{
			//ACTIVE PARENT?
			if (jQuery('#nav-main ul>li.active>a').length && jQuery('#nav-main ul>li.active>a').attr('data-color')!==undefined) {
				if (theme_options.use_custom_colors==="yes") {
					theme_options.active_color=jQuery('#nav-main ul>li.active>a').attr('data-color');
				}
				jQuery('#nav-main ul>li.active>a').children('.prk_menu_square').css({'width':'14px'});
			}
		}
		//OPEN SUBMENU IF NEEDED
		if (jQuery('#nav-main ul .sub-menu li.active>a').length) {
			jQuery('#nav-main ul .sub-menu li.active>a').parent().parent().parent().find('.prk_btm_square').transition({ rotate: '45deg' },5);
			///jQuery('#nav-main ul .sub-menu li.active>a').parent().parent().parent().find('.prk_btm_square').addClass('icon-minus');
			///jQuery('#nav-main ul .sub-menu li.active>a').parent().parent().parent().find('.prk_btm_square').removeClass('icon-plus');
			jQuery('#nav-main ul .sub-menu li.active>a').children('.prk_menu_square').css({'width':'14px'});
			jQuery('#nav-main ul .sub-menu li.active').parent().parent().children('.sub-menu').show();
		}
		jQuery('#top_bar_wrapper,#nprogress .bar,#nav-collapsed-icon .prk_menu_block').css({'background-color':theme_options.active_color});
		jQuery('.spinner-icon').css({'border-top-color':theme_options.active_color,'border-left-color':theme_options.active_color});
		jQuery('.not_zero_color,.not_zero_color a').not('.featured_color .not_zero_color').css({'color':theme_options.active_color});
		jQuery(window).trigger("debouncedresize");
		jQuery("#menu_section,#prk_responsive_menu").delay(100).animate({
			opacity:1
			}, 
			{
				easing:'easeOutQuad',
				duration:400
			}
		);
		jQuery("#menu_section").mCustomScrollbar({
			scrollInertia:450,
			autoHideScrollbar:true,
			scrollButtons:{
				enable:false
			}
		});
		jQuery('#main_block,#sidebar').css({'opacity':'0'});
		jQuery('#prk_ajax_container').css({'display':'block','visibility':'visible'});
		ended_loading();
	});//WINDOW LOAD
}
//ANIMATED MENU FUNCTIONS
var menu_is_open=false;
var container_menu;
var buttons;
var eventtype;
function prk_toggle_menu() {
	"use strict";
	if (menu_is_open===false) {
		menu_is_open=true;
		jQuery('#prk_responsive_menu').stop().animate({
			left:-90
		},
		{
			easing:'easeOutQuint',
			duration:500
		});
		jQuery('#menu_section').stop().animate({
			'margin-left':0
		},
		{
			easing:'easeOutQuint',
			duration:800
		});
		var lefty=170;
		if (jQuery('#prk_responsive_menu.at_top').length) {
			lefty=260;
		}
		jQuery('#prk_ajax_container').css({'position':'relative'});
		jQuery('#prk_ajax_container').stop().animate({
			left:lefty
		},
		{
			easing:'easeOutQuint',
			duration:800
		});
		jQuery('#top_bar_wrapper').stop().animate({
			left:lefty
		},
		{
			easing:'easeOutQuint',
			duration:800
		});
		jQuery('#body_hider').css({'display':'block','opacity':0});
		jQuery('#body_hider').stop().animate({
			opacity:0.5
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function() {
				document.addEventListener( eventtype, click_on_body );
			}
		});
	}
	else {
		menu_is_open=false;
		jQuery('#prk_responsive_menu').stop().animate({
			left:0
		},
		{
			easing:'easeOutQuint',
			duration:800
		});
		jQuery('#menu_section').stop().animate({
			'margin-left':-260
		},
		{
			easing:'easeOutQuint',
			duration:500
		});
		jQuery('#prk_ajax_container').stop().animate({
			'left':0
		},
		{
			easing:'easeOutQuint',
			duration:500
		});
		jQuery('#top_bar_wrapper').stop().animate({
			left:0
		},
		{
			easing:'easeOutQuint',
			duration:500
		});
		jQuery('#body_hider').stop().animate({
			opacity:0
		},
		{
			easing:'easeOutQuint',
			duration:500
		});
		jQuery('#alt_logo_holder').css({'display':'inline-block'});
		jQuery('#alt_logo_holder').stop().animate({
			opacity:1
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function()
			{
				jQuery('#prk_ajax_container').css({'position':''});
				jQuery('#body_hider').css({'display':'none'});
				document.removeEventListener( eventtype, click_on_body );
			}
		});
	}
}
/**
 * sidebarEffects.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
function hasParentClass( e, classname ) {
	"use strict";
	if(e === document){ 
		return false;
	}
	if( classie.has( e, classname ) ) {
		return true;
	}
	return e.parentNode && hasParentClass( e.parentNode, classname );
}

// http://coveroverflow.com/a/11381730/989439
function is_mobile() {
	"use strict";
	var check = false;
	(function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))){check = true;}})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
}
function isAppleDevice(){
    return (
        (navigator.userAgent.toLowerCase().indexOf("ipad") > -1) ||
        (navigator.userAgent.toLowerCase().indexOf("iphone") > -1) ||
        (navigator.userAgent.toLowerCase().indexOf("ipod") > -1)
    );
}
function reset_menu() {
	"use strict";
	classie.remove( container_menu, 'st-menu-open' );
	menu_is_open=false;
}
click_on_body = function(evt) {
	"use strict";
	if( evt==='close_flag' || (!hasParentClass( evt.target, 'st-menu') && !jQuery('#st-container').hasClass('no-csstransforms3d')) || (hasParentClass( evt.target, 'close_flagger') && !jQuery('#st-container').hasClass('no-csstransforms3d'))) {
		reset_menu();
		jQuery('#prk_responsive_menu').stop().delay(100).animate({
			'margin-left':0
		},
		{
			easing:'easeOutQuint',
			duration:500
		});
		jQuery('#prk_ajax_container').stop().delay(100).animate({
			'left':0
		},
		{
			easing:'easeOutQuint',
			duration:500
		});
		jQuery('#top_bar_wrapper').stop().delay(100).animate({
			left:0
		},
		{
			easing:'easeOutQuint',
			duration:500
		});
		jQuery('#body_hider').stop().animate({
			'opacity': 0});
		jQuery('#alt_logo_holder').css({'display':'inline-block'});
		jQuery('#alt_logo_holder').stop().delay(100).animate({
			opacity:1
		},
		{
			easing:'easeOutQuint',
			duration:500,
			complete:function()
			{
				jQuery('#prk_ajax_container,.st-pusher').css({'position':''});
				jQuery('#body_hider').css({'display':'none'});
				
			}
		});
		document.removeEventListener( eventtype, click_on_body );
	}
	else {
		if ((evt==='close_flag' && jQuery('#st-container').hasClass('no-csstransforms3d')) || (!hasParentClass( evt.target, 'mCustomScrollbar') &&  jQuery('#st-container').hasClass('no-csstransforms3d')) || (hasParentClass( evt.target, 'close_flagger') && jQuery('#st-container').hasClass('no-csstransforms3d'))) {
			prk_toggle_menu();
		}
	}
};
function init_sidebar() {
	"use strict";
	if (jQuery.browser.msie && parseInt(jQuery.browser.version, 10) === 8) {}
	else {
		container_menu = document.getElementById( 'st-container' );
			buttons = Array.prototype.slice.call( document.querySelectorAll( '#nav-collapsed-icon,#alt_logo_holder' ) ),
			eventtype = isAppleDevice() ? 'click' : 'click',

		buttons.forEach( function( el, i ) {
			var effect = el.getAttribute( 'data-effect' );
			el.addEventListener( eventtype, function( ev ) {
				//ARE ANIMATIONS ON?
				if (!jQuery('#st-container').hasClass('no-csstransforms3d')) {
					ev.stopPropagation();
					ev.preventDefault();
					//IS THE MENU OPEN?
					if (jQuery("#st-container").hasClass('st-menu-open')){
						click_on_body('close_flag');
					}
					else {
						container_menu.className = 'st-container';
						classie.add( container_menu, effect );
						jQuery(window).trigger( "debouncedresize");
						setTimeout( function() {
							classie.add( container_menu, 'st-menu-open' );
							var lefty=170;
							if (jQuery('#prk_responsive_menu.at_top').length) {
								lefty=260;
							}
							jQuery('#prk_ajax_container').css({'position':'relative'});
							jQuery('#prk_ajax_container').stop().animate({
								left:lefty
							},
							{
								easing:'easeOutQuint',
								duration:500,
							});
							jQuery('#prk_responsive_menu').animate({
								'margin-left': -90});
							jQuery('#body_hider').css({'display':'block','opacity':0});
							jQuery('#body_hider').stop().delay(400).animate({
								'opacity': 0.5});
							jQuery('#top_bar_wrapper').stop().animate({
								left:lefty
							},
							{
								easing:'easeOutQuint',
								duration:500,
								complete:function()
								{
									
								}
							});

						}, 25 );
						document.addEventListener( eventtype, click_on_body );
					}
				}
				else {
					if (menu_is_open===false) {
						prk_toggle_menu();
					}
				}
			});
		});
	}
}
function iOSversion() {
	"use strict";
  if (/iP(hone|od|ad)/.test(navigator.platform)) {
    // supports iOS 2.0 and later: <http://bit.ly/TJjs1V>
    var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
    return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
  }
}
jQuery(window).bind("pageshow", function(event) {
	"use strict";
    if (event.originalEvent.persisted) {
        window.location.reload();
    }
});
jQuery(document).ready(function() {
	"use strict";
	//FORCE NO 3D EFFECT ON CERTAIN DEVICES
	var prk_version = iOSversion();
	if (prk_version!== undefined && prk_version[0] <= 6) {
	  jQuery('html').removeClass('csstransforms3d');
	  jQuery('html').addClass('no-csstransforms3d');
	}
	if (jQuery.browser.chrome) {
		jQuery('html').addClass('samba_chrome');
	}
	else {
		var nua = navigator.userAgent;
		if (((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1))) {
			jQuery('html').addClass('samba_android');
		}
		else {
			var msie = nua.indexOf('MSIE ');
		    var trident = nua.indexOf('Trident/');
		    if (msie > 0 || trident > 0) {
		        jQuery('html').addClass('samba_ie');
		    }
		    else {
		    	if (jQuery.browser.safari) {
					jQuery('html').addClass('samba_safari');
				} 
		    }
		}
	}
	//CALL MAIN JSCRIPT FUNCTION
	if (make_session!==true) {
		samba_init();
		init_sidebar();
	}
	NProgress.configure({ minimum: 0.3, trickleRate: 0.08, trickleSpeed: 400  });
	NProgress.start();
	jQuery('#nprogress .bar').css({'background-color':theme_options.active_color});
	jQuery('.spinner-icon').css({'border-top-color':theme_options.active_color,'border-left-color':theme_options.active_color});
	//LOAD THE BACKGROUND IMAGE
	if (theme_options.bk_url!="") {
	jQuery('#full-screen-background-image').attr('src', theme_options.bk_url);
		jQuery('#full-screen-background-image').imagesLoaded(function() {
			jQuery('#full-screen-background-image').attr('data-or_w',jQuery('#full-screen-background-image').width());
			jQuery('#full-screen-background-image').attr('data-or_h',jQuery('#full-screen-background-image').height());
			jQuery(window).trigger("debouncedresize");
		});
	}
});
/* jshint ignore:end */