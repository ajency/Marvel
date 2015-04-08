jQuery(document).ready(function() {

    /* Title Row */
    if (jQuery('#sola_t_display_title').is(':checked')) {
        jQuery(".sola-t-title-row").show();
    } else if (!jQuery('#sola_t_display_title').is(':checked')) {
        jQuery(".sola-t-title-row").hide();
    }
    jQuery('#sola_t_display_title').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery(".sola-t-title-row").show();
        } else if (!jQuery(this).is(':checked')) {
            jQuery(".sola-t-title-row").hide();
        }
    });

    /* Name Row */
    if (jQuery('#sola_t_display_name').is(':checked')) {
        jQuery(".sola-t-name-row").show();
    } else if (!jQuery('#sola_t_display_name').is(':checked')) {
        jQuery(".sola-t-name-row").hide();
    }
    jQuery('#sola_t_display_name').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery(".sola-t-name-row").show();
        } else if (!jQuery(this).is(':checked')) {
            jQuery(".sola-t-name-row").hide();
        }
    });

    /* Website Name Row */
    if (jQuery('#sola_t_display_site_name').is(':checked')) {
        jQuery(".sola-t-web-name-row").show();
    } else if (!jQuery('#sola_t_display_site_name').is(':checked')) {
        jQuery(".sola-t-web-name-row").hide();
    }
    jQuery('#sola_t_display_site_name').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery(".sola-t-web-name-row").show();
        } else if (!jQuery(this).is(':checked')) {
            jQuery(".sola-t-web-name-row").hide();
        }
    });

    /* Website Address Row */
    if (jQuery('#sola_t_display_site_address_name').is(':checked')) {
        jQuery(".sola-t-address-row").show();
    } else if (!jQuery('#sola_t_display_site_address_name').is(':checked')) {
        jQuery(".sola-t-address-row").hide();
    }
    jQuery('#sola_t_display_site_address_name').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery(".sola-t-address-row").show();
        } else if (!jQuery(this).is(':checked')) {
            jQuery(".sola-t-address-row").hide();
        }
    });

    /* CAPTCHA */
    if (jQuery('#sola_t_required_captcha').is(':checked')) {
        jQuery(".sola-t-captcha-row").show();
    } else if (!jQuery('#sola_t_required_captcha').is(':checked')) {
        jQuery(".sola-t-captcha-row").hide();
    }
    jQuery('#sola_t_required_captcha').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery(".sola-t-captcha-row").show();
        } else if (!jQuery(this).is(':checked')) {
            jQuery(".sola-t-captcha-row").hide();
        }
    });

    /* Categories */
    if (jQuery('#sola_t_choose_category').is(':checked')) {
        jQuery(".sola_t_category_row").hide();
    } else if (!jQuery('#sola_t_choose_category').is(':checked')) {
        jQuery(".sola_t_category_row").show();
    }
    jQuery('#sola_t_choose_category').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery(".sola_t_category_row").hide();
        } else if (!jQuery(this).is(':checked')) {
            jQuery(".sola_t_category_row").show();
        }
    });


    /* Layout Buttons */

    jQuery(".sola_t_hide_input").hide();

    jQuery("#sola_t_layout_1").click(function() {
        jQuery("#sola_t_rb_layout_1").attr('checked', true);
        jQuery("#sola_t_rb_layout_2").attr('checked', false);
        jQuery("#sola_t_rb_layout_3").attr('checked', false);
        jQuery("#sola_t_rb_layout_4").attr('checked', false);
        jQuery("#sola_t_layout_1").addClass("layout_activate");
        jQuery("#sola_t_layout_2").removeClass("layout_activate");
        jQuery("#sola_t_layout_3").removeClass("layout_activate");
        jQuery("#sola_t_layout_4").removeClass("layout_activate");
        jQuery("#sola_t_layout_5").removeClass("layout_activate");
    });
    jQuery("#sola_t_layout_2").click(function() {
        jQuery("#sola_t_rb_layout_2").attr('checked', true);
        jQuery("#sola_t_rb_layout_1").attr('checked', false);
        jQuery("#sola_t_rb_layout_3").attr('checked', false);
        jQuery("#sola_t_rb_layout_4").attr('checked', false);
        jQuery("#sola_t_layout_2").addClass("layout_activate");
        jQuery("#sola_t_layout_1").removeClass("layout_activate");
        jQuery("#sola_t_layout_3").removeClass("layout_activate");
        jQuery("#sola_t_layout_4").removeClass("layout_activate");
        jQuery("#sola_t_layout_5").removeClass("layout_activate");
    });
    jQuery("#sola_t_layout_3").click(function() {
        jQuery("#sola_t_rb_layout_3").attr('checked', true);
        jQuery("#sola_t_rb_layout_1").attr('checked', false);
        jQuery("#sola_t_rb_layout_2").attr('checked', false);
        jQuery("#sola_t_rb_layout_4").attr('checked', false);
        jQuery("#sola_t_layout_3").addClass("layout_activate");
        jQuery("#sola_t_layout_2").removeClass("layout_activate");
        jQuery("#sola_t_layout_1").removeClass("layout_activate");
        jQuery("#sola_t_layout_4").removeClass("layout_activate");
        jQuery("#sola_t_layout_5").removeClass("layout_activate");
    });
    jQuery("#sola_t_layout_4").click(function() {
        jQuery("#sola_t_rb_layout_4").attr('checked', true);
        jQuery("#sola_t_rb_layout_2").attr('checked', false);
        jQuery("#sola_t_rb_layout_3").attr('checked', false);
        jQuery("#sola_t_rb_layout_1").attr('checked', false);
        jQuery("#sola_t_layout_4").addClass("layout_activate");
        jQuery("#sola_t_layout_2").removeClass("layout_activate");
        jQuery("#sola_t_layout_3").removeClass("layout_activate");
        jQuery("#sola_t_layout_1").removeClass("layout_activate");
        jQuery("#sola_t_layout_5").removeClass("layout_activate");
    });

    jQuery("#sola_t_layout_5").click(function() {
        jQuery("#sola_t_rb_layout_5").attr('checked', true);
        jQuery("#sola_t_rb_layout_2").attr('checked', false);
        jQuery("#sola_t_rb_layout_4").attr('checked', false);
        jQuery("#sola_t_rb_layout_3").attr('checked', false);
        jQuery("#sola_t_rb_layout_1").attr('checked', false);
        jQuery("#sola_t_layout_5").addClass("layout_activate");
        jQuery("#sola_t_layout_4").removeClass("layout_activate");
        jQuery("#sola_t_layout_2").removeClass("layout_activate");
        jQuery("#sola_t_layout_3").removeClass("layout_activate");
        jQuery("#sola_t_layout_1").removeClass("layout_activate");
    });
    
    jQuery(".sola_t_theme_select").click(function() {
        var orig_tid = jQuery(this).attr('tid');
        jQuery( ".sola_t_theme_select" ).each(function() {
            var tid = jQuery(this).attr('tid');
            jQuery("#sola_t_rb_theme_"+tid).attr('checked', false);
            jQuery("#sola_t_theme_"+tid).removeClass("layout_activate");
        });
        jQuery("#sola_t_rb_theme_"+orig_tid).attr('checked', true);
        jQuery("#sola_t_theme_"+orig_tid).addClass("layout_activate");
        
    });
    
 
    jQuery("#sola_t_image_1").click(function() {
        jQuery("#sola_t_rb_image_1").attr('checked', true);
        jQuery("#sola_t_rb_image_2").attr('checked', false);
        jQuery("#sola_t_image_1").addClass("layout_activate");
        jQuery("#sola_t_image_2").removeClass("layout_activate");
    });

    jQuery("#sola_t_image_2").click(function() {
        jQuery("#sola_t_rb_image_2").attr('checked', true);
        jQuery("#sola_t_rb_image_1").attr('checked', false);
        jQuery("#sola_t_image_2").addClass("layout_activate");
        jQuery("#sola_t_image_1").removeClass("layout_activate");
    });


    jQuery('#sola_t_custom_css').ace({theme: 'twilight', lang: 'css'});
    jQuery('#sola_t_custom_css_slider').ace({theme: 'twilight', lang: 'css'});

    jQuery(function() {
        jQuery("#sola_t_dialog").dialog({
            autoOpen: false
        });

        jQuery("#sola_t_open_dialog").click(function() {
            jQuery("#sola_t_dialog").dialog("open");
        });
    });
    
    jQuery(function() {
        jQuery("#sola_t_dialog").dialog({
            autoOpen: false
        });

        jQuery("#sola_t_open_slider_dialog").click(function() {
            jQuery("#sola_t_dialog").dialog("open");
        });
    });
    
    if(jQuery("#sola_t_content_type_excerpt").is(':checked')){
        jQuery(".excerpt_length_row").show();
    } else {
        jQuery(".excerpt_length_row").hide();
    }
    
    jQuery("#sola_t_content_type_content").click(function(){
        jQuery(".excerpt_length_row").hide();
        jQuery(".excerpt_length_row").css('display', 'none');
    });
    
    jQuery("#sola_t_content_type_excerpt").click(function(){
        jQuery(".excerpt_length_row").show();
        jQuery(".excerpt_length_row").css('display', 'table-row');
    });
    
});
