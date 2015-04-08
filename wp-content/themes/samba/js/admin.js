/*global jQuery,samba_directory,post_id,formfield,tb_show,tb_remove:false */
/*jshint -W020 */
jQuery(document).ready(function() 
{
	//AJAX SAVE OPTIONS
	jQuery('#prk_save_progress').css({'display':'none'});
	jQuery('#prk_main_options').submit( function () {
		var b =  jQuery(this).serialize();
		jQuery('#prk_save_progress').html("Saving...");
		jQuery('#prk_save_progress').css({"top":( jQuery(window).height() - jQuery('#prk_save_progress').height() - 200 ) / 2+jQuery(window).scrollTop() + "px","left":'350px','display':'block'});
		jQuery('#prk_save_progress').animate({"opacity":1},100);
		jQuery.post('options.php', b ).error( 
		function() {
			jQuery('#prk_save_progress').html("Save Error!");
		}).success( function() {
			jQuery('#prk_save_progress').html("Settings Updated!");
			jQuery('#prk_save_progress').delay(900).animate({"opacity":0},300,function() {
				jQuery('#prk_save_progress').css({'display':'none'});
			});
			//REFRESH SLUGS
			jQuery('#dump').load(jQuery('#prk_options_container').attr('data-directory')+'/inc/rewrite_slugs.php');
		});
		return false;    
	});
	//INITIALIZE
	if (jQuery('#pattern_selector').attr('value')==='') {
		jQuery('.preview_pattern').css({"display":'none'});
	}
	if (jQuery('#pattern_selector_footer').attr('value')==='') {
		jQuery('.preview_pattern_footer').css({"display":'none'});
	}
	if (jQuery('#pattern_selector_sidebar').attr('value')==='') {
		jQuery('.preview_pattern_sidebar').css({"display":'none'});
	}
	//COLOR PICKERS  

	jQuery('.prk_picker').each(function() {
	var in_id='#'+jQuery(this).attr('id');
	jQuery(in_id).ColorPicker({
	color: jQuery(in_id).attr('data-color'),
	onBeforeShow: function () {
	jQuery(in_id).ColorPickerSetColor(jQuery(in_id).next('input').attr('value'));
	},
	onShow: function (colpkr) {
	jQuery(colpkr).fadeIn(500);
	return false;
	},
	onHide: function (colpkr) {
	jQuery(colpkr).fadeOut(500);
	return false;
	},
	onChange: function (hsb, hex) {
	jQuery(in_id).children('div').css('backgroundColor', '#' + hex);
	jQuery(in_id).next('input').attr('value','#' + hex);
	}
	});
	});
	jQuery('.prk_input_listen').keyup(function() {
	jQuery(this).parent().find('.prk_picker').children('div').css({"background-color":jQuery(this).val()});
	});

	//BACKGROUND MANAGEMENT
	if (jQuery('input#samba_theme_options_background').val()==='')
	{
		jQuery('#samba_theme_options_background_image').hide();
	}
	jQuery('#remove_background_button').click(function() 
	{
		jQuery('input#samba_theme_options_background').val('');
		jQuery('#samba_theme_options_background_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_background_button').blur();
		return false;
	});
	jQuery('#remove_alt_logo_button').click(function() 
	{
		jQuery('input#samba_theme_options_alt_logo').val('');
		jQuery('#samba_theme_options_alt_logo_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_alt_logo_button').blur();
		return false;
	});
	jQuery('#remove_small_logo_button').click(function() 
	{
		jQuery('input#samba_theme_options_small_logo').val('');
		jQuery('#samba_theme_options_small_logo_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_small_logo_button').blur();
		return false;
	});
	jQuery('#remove_logo_retina_button').click(function() 
	{
		jQuery('input#samba_theme_options_logo_retina').val('');
		jQuery('#samba_theme_options_logo_retina_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_logo_retina_button').blur();
		return false;
	});
	jQuery('#remove_alt_logo_retina_button').click(function() 
	{
		jQuery('input#samba_theme_options_alt_logo_retina').val('');
		jQuery('#samba_theme_options_alt_logo_retina_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_alt_logo_retina_button').blur();
		return false;
	});
	jQuery('#remove_small_logo_retina_button').click(function() 
	{
		jQuery('input#samba_theme_options_small_logo_retina').val('');
		jQuery('#samba_theme_options_small_logo_retina_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_small_logo_retina_button').blur();
		return false;
	});
	if (jQuery('input#samba_theme_options_backgroundinfo').val()==='')
	{
		jQuery('#samba_theme_options_backgroundinfo_image').hide();
	}
	if (jQuery('input#samba_theme_options_backgroundft').val()==='')
	{
		jQuery('#samba_theme_options_backgroundft_image').hide();
	}
	if (jQuery('input#samba_theme_options_backgroundhd').val()==='')
	{
		jQuery('#samba_theme_options_backgroundhd_image').hide();
	}
	if (jQuery('input#samba_theme_options_background').val()==='')
	{
		jQuery('#samba_theme_options_background_image').hide();
	}
	if (jQuery('input#samba_theme_options_backgroundsidebar').val()==='')
	{
		jQuery('#samba_theme_options_backgroundsidebar_image').hide();
	}
	jQuery('#remove_backgroundft_button').click(function() 
	{
		jQuery('input#samba_theme_options_backgroundft').val('');
		jQuery('#samba_theme_options_backgroundft_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_backgroundft_button').blur();
		return false;
	});
	jQuery('#remove_backgroundinfo_button').click(function() 
	{
		jQuery('input#samba_theme_options_backgroundinfo').val('');
		jQuery('#samba_theme_options_backgroundinfo_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_backgroundft_button').blur();
		return false;
	});
	jQuery('#remove_backgroundhd_button').click(function() 
	{
		jQuery('input#samba_theme_options_backgroundhd').val('');
		jQuery('#samba_theme_options_backgroundhd_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_backgroundft_button').blur();
		return false;
	});
	jQuery('#remove_backgroundsidebar_button').click(function() 
	{
		jQuery('input#samba_theme_options_backgroundsidebar').val('');
		jQuery('#samba_theme_options_backgroundsidebar_image').slideUp();
		//REMOVE FOCUS FROM THIS BUTTON - BROWSER BUG?
		jQuery('#remove_backgroundsidebar_button').blur();
		return false;
	});

	//PATTERN SELECTOR
	jQuery('#pattern_selector').change(function()
	{
		if (jQuery('#pattern_selector').attr('value')==='')
		{
			jQuery('.preview_pattern').css({"display":'none'});
		}
		else
		{
			jQuery('.preview_pattern').css({"background-image":'url('+samba_directory+'/images/patterns/'+jQuery('#pattern_selector').attr('value')+')'});
			jQuery('.preview_pattern').css({"display":'inline'});
		}
	});
	jQuery('#pattern_selector_footer').change(function()
	{
		if (jQuery('#pattern_selector_footer').attr('value')==='')
		{
			jQuery('.preview_pattern_footer').css({"display":'none'});
		}
		else
		{
			jQuery('.preview_pattern_footer').css({"background-image":'url('+samba_directory+'/images/patterns/'+jQuery('#pattern_selector_footer').attr('value')+')'});
			jQuery('.preview_pattern_footer').css({"display":'inline'});
		}
	});
	jQuery('#pattern_selector_sidebar').change(function()
	{
		if (jQuery('#pattern_selector_sidebar').attr('value')==='')
		{
			jQuery('.preview_pattern_sidebar').css({"display":'none'});
		}
		else
		{
			jQuery('.preview_pattern_sidebar').css({"background-image":'url('+samba_directory+'/images/patterns/'+jQuery('#pattern_selector_sidebar').attr('value')+')'});
			jQuery('.preview_pattern_sidebar').css({"display":'inline'});
		}
	});

	//PAGES SLIDER SELECTOR
	jQuery('#prk_slider_selector').change(function()
	{
		if (jQuery('#prk_slider_selector').attr('value')==='no')
		{
			jQuery('#rev_slider_opts,#normal_slider_opts').css({"display":'none'});
		}
		if (jQuery('#prk_slider_selector').attr('value')==='yes')
		{
			jQuery('#rev_slider_opts').css({"display":'none'});
			jQuery('#normal_slider_opts').css({"display":'inline'});
		}
		if (jQuery('#prk_slider_selector').attr('value')==='show_revol')
		{
			jQuery('#rev_slider_opts').css({"display":'inline'});
			jQuery('#normal_slider_opts').css({"display":'none'});
		}
	});
	if (jQuery('#prk_slider_selector').attr('value')==='no')
	{
		jQuery('#rev_slider_opts,#normal_slider_opts').css({"display":'none'});
	}
	if (jQuery('#prk_slider_selector').attr('value')==='yes')
	{
		jQuery('#rev_slider_opts').css({"display":'none'});
		jQuery('#normal_slider_opts').css({"display":'inline'});
	}
	if (jQuery('#prk_slider_selector').attr('value')==='show_revol')
	{
		jQuery('#rev_slider_opts').css({"display":'inline'});
		jQuery('#normal_slider_opts').css({"display":'none'});
	}
	
	//MULTIPLE MEDIA-UPLOAD BOXES MANAGEMENT
	//STORE ORIGINAL FUNCTION
	window.original_send_to_editor = window.send_to_editor;
	//CREATE SEMAPHORE VARIABLE
	var header_clicked = false;
	jQuery('.pirenko_upload').click(function() 
	{
		formfield = (jQuery(this).attr("name"));
		post_id = jQuery('#post_ID').val();
		tb_show('', 'media-upload.php?post_id='+post_id+'type=image&amp;TB_iframe=true');
		header_clicked = true;
		return false;
	});
	
	jQuery('.pirenko_upload_options').click(function() 
	{
		formfield = (jQuery(this).attr("name"));
		post_id = jQuery(this).attr("secret_id");
		tb_show('', 'media-upload.php?post_id='+post_id+'&TB_iframe=1');
		header_clicked = true;
		return false;
	});
	
	window.send_to_editor = function(html) 
	{
		if (header_clicked) 
		{
			var regex = /src="(.+?)"/;
            var rslt =html.match(regex);
            var imgurl = rslt[1];
			//FOR THE THEME OPTIONS - BACKGROUND, LOGO AND FAVICON
			jQuery('img#samba_'+formfield+'_image').show();
			jQuery('img#samba_'+formfield+'_image').attr("src",imgurl);
			//FOR THE WRITE PANEL AND CATEGORIES PANEL
			jQuery('input#samba_'+formfield).val(imgurl);
			jQuery('#samba_theme_options_category_image').attr("src",imgurl);
			jQuery('#samba_theme_options_category_image').show();
			header_clicked = false;
			tb_remove();
		}
		else
		{
			window.original_send_to_editor(html);
		}
	};
	function prk_hide_all_admin_tabs() {
		jQuery('#pirenko_advanced_options,#pirenko_woo_options,#pirenko_header_options,#pirenko_footer_options,#pirenko_general_options,#pirenko_branding_options,#pirenko_portfolio_options,#pirenko_blog_options,#pirenko_contact_options,#pirenko_404_options,#pirenko_translations_options,#pirenko_scripts_options').css('display','none');
	}
	prk_hide_all_admin_tabs();
	jQuery('#pirenko_general_options').css({'display':'block'});
	jQuery('#samba_general_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_general_options').css('display','block');
		jQuery('#samba_options').stop();
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1',
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_branding_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_branding_options').css('display','block');
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1'
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_portfolio_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_portfolio_options').css('display','block');
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1'
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_news_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_blog_options').css('display','block');
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1'
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_contact_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_contact_options').css('display','block');
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1'
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_404_error_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_404_options').css('display','block');
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1'
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_translations_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_translations_options').css('display','block');
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1'
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_custom_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_scripts_options').css('display','block');
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1'
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_woo_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_woo_options').css('display','block');
		jQuery('#samba_options').stop();
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1',
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_footer_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_footer_options').css('display','block');
		jQuery('#samba_options').stop();
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1',
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_header_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_header_options').css('display','block');
		jQuery('#samba_options').stop();
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1',
		}, 300, function() {
		// Animation complete.
		});
	});
	jQuery('#samba_advanced_options_button').click(function()
	{
		jQuery('#pirenko_admin_menu li').removeClass('current');
		jQuery(this).parent().addClass('current');
		jQuery('#samba_options').stop();
		prk_hide_all_admin_tabs();
		jQuery('#pirenko_advanced_options').css('display','block');
		jQuery('#samba_options').stop();
		jQuery('#samba_options').css({'opacity':'0'});
		jQuery('#samba_options').animate({
		opacity: '1',
		}, 300, function() {
		// Animation complete.
		});
	});

	jQuery('.bl_icon_preview').click(function()
	{
		jQuery(this).parent().find('.bl_icon_preview').removeClass('active_ic');
		jQuery(this).addClass('active_ic');
		jQuery('#blog_icon_input').val(jQuery(this).attr("secret_pos"));
	});
	//THEME WIDGETS
	jQuery('.possibly_hider').each(function() {
		if (jQuery(this).attr('value')==='info_lay') {
			jQuery(this).parent().parent().find('.possibly_hidden').css({"display":'none'});
		}
	});
	jQuery('.possibly_hider').change(function()
	{
		if (jQuery(this).attr('value')==='info_lay') {
			jQuery(this).parent().parent().find('.possibly_hidden').css({"display":'none'});
		}
		else {
			jQuery(this).parent().parent().find('.possibly_hidden').css({"display":'block'});
		}
	});
});