<?php


/* Custom Options Arrays ----------------------------------------------------- */

$pirenko_colors_arr = array(__("Theme Button", "js_composer") => "theme_button",__("Theme Button - Inverted Colors", "js_composer") => "theme_button_inverted",__("Grey", "js_composer") => "wpb_button", __("Blue", "js_composer") => "btn-primary", __("Turquoise", "js_composer") => "btn-info", __("Green", "js_composer") => "btn-success", __("Orange", "js_composer") => "btn-warning", __("Red", "js_composer") => "btn-danger", __("Black", "js_composer") => "btn-inverse");
$yes_no_arr = array(__('Yes', "js_composer") => "yes",__('No', "js_composer") => "no");
$target_arr = array(__("Same window", "js_composer") => "_self", __("New window", "js_composer") => "_blank");
$add_css_animation = array(
  "type" => "dropdown",
  "heading" => __("CSS Animation", "js_composer"),
  "param_name" => "css_animation",
  "admin_label" => true,
  "value" => array(__("No", "js_composer") => '', __("Top to bottom", "js_composer") => "top-to-bottom", __("Bottom to top", "js_composer") => "bottom-to-top", __("Left to right", "js_composer") => "left-to-right", __("Right to left", "js_composer") => "right-to-left", __("Appear from center", "js_composer") => "appear"),
  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "js_composer")
);
$size_arr = array(__("Regular size", "js_composer") => "wpb_regularsize", __("Large", "js_composer") => "btn-large", __("Small", "js_composer") => "btn-small", __("Mini", "js_composer") => "btn-mini");
$icons_arr = array(
    __("None", "js_composer") => "none",
    __("Address book icon", "js_composer") => "wpb_address_book",
    __("Alarm clock icon", "js_composer") => "wpb_alarm_clock",
    __("Anchor icon", "js_composer") => "wpb_anchor",
    __("Application Image icon", "js_composer") => "wpb_application_image",
    __("Arrow icon", "js_composer") => "wpb_arrow",
    __("Asterisk icon", "js_composer") => "wpb_asterisk",
    __("Hammer icon", "js_composer") => "wpb_hammer",
    __("Balloon icon", "js_composer") => "wpb_balloon",
    __("Balloon Buzz icon", "js_composer") => "wpb_balloon_buzz",
    __("Balloon Facebook icon", "js_composer") => "wpb_balloon_facebook",
    __("Balloon Twitter icon", "js_composer") => "wpb_balloon_twitter",
    __("Battery icon", "js_composer") => "wpb_battery",
    __("Binocular icon", "js_composer") => "wpb_binocular",
    __("Document Excel icon", "js_composer") => "wpb_document_excel",
    __("Document Image icon", "js_composer") => "wpb_document_image",
    __("Document Music icon", "js_composer") => "wpb_document_music",
    __("Document Office icon", "js_composer") => "wpb_document_office",
    __("Document PDF icon", "js_composer") => "wpb_document_pdf",
    __("Document Powerpoint icon", "js_composer") => "wpb_document_powerpoint",
    __("Document Word icon", "js_composer") => "wpb_document_word",
    __("Bookmark icon", "js_composer") => "wpb_bookmark",
    __("Camcorder icon", "js_composer") => "wpb_camcorder",
    __("Camera icon", "js_composer") => "wpb_camera",
    __("Chart icon", "js_composer") => "wpb_chart",
    __("Chart pie icon", "js_composer") => "wpb_chart_pie",
    __("Clock icon", "js_composer") => "wpb_clock",
    __("Fire icon", "js_composer") => "wpb_fire",
    __("Heart icon", "js_composer") => "wpb_heart",
    __("Mail icon", "js_composer") => "wpb_mail",
    __("Play icon", "js_composer") => "wpb_play",
    __("Shield icon", "js_composer") => "wpb_shield",
    __("Video icon", "js_composer") => "wpb_video"
);
$add_css_hide = array(
    'type' => 'checkbox',
    'heading' => __( 'Hide on smaller screens:', 'js_composer' ),
    'param_name' => 'hide_with_css',
    'admin_label' => true,
    'group' => __( 'Viewports', 'js_composer' ),
    'value' => array(
        __("Screens with less than 768px wide<br>", "js_composer") => 'hide_later',
        __("Screens with less than 480px wide", "js_composer") => 'hide_much_later',
    ),
    'description' => __( 'Tick the screen sizes on wich this element should be hidden.', 'js_composer' )
);

/* Page Elements Removal ----------------------------------------------------- */
wpb_remove("vc_images_carousel");
wpb_remove("vc_toggle");
wpb_remove("vc_teaser_grid");
wpb_remove("vc_posts_grid");
wpb_remove("vc_twitter");
wpb_remove("vc_posts_slider");
wpb_remove("vc_pie");
wpb_remove("vc_carousel");
wpb_remove("vc_cta_button");
wpb_remove("vc_cta_button2");
wpb_remove("vc_gallery");


/* Row Overrides ----------------------------------------------------- */
vc_remove_param('vc_row', 'font_color');
vc_remove_param('vc_row', 'el_class');
vc_remove_param('vc_row', 'css');

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" => __("Row type", "js_composer"),
    "param_name" => "bk_type",
    "value" => array(
      __("Boxed look", "js_composer") => "boxed_look", 
      __("Full width", "js_composer") => "full_width"),
    "description" => __("Full width should be only used on Pages with Sections", "js_composer")
));
vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __('Row anchor id', 'wpb'),
    "param_name" => "anchor_id",
    "description" => __("Optional - Useful for mini site pages.", "wpb")
));
vc_add_param("vc_row", array(
    "type" => "textfield",
    "heading" => __('Bottom margin', 'wpb'),
    "param_name" => "margin_bottom",
    "description" => __("You can use px, em, %, etc. or enter just number and pixels will be used. ", "wpb")
));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" => __("Background type", "js_composer"),
    "param_name" => "bk_element",
    "value" => array(
        __("Transparent", 'wpb') => '',
        __("Solid Color", 'wpb') => 'colored',
        __('Pattern', 'wpb') => 'pattern',
        __('Image', 'wpb') => 'image',
    ),
    "description" => __("", "js_composer"),
));
vc_add_param("vc_row", array(
    "type" => "colorpicker",
    "heading" => __("Custom Background Color", "wpb"),
    "param_name" => "bg_color",
    "description" => __("Select backgound color for your row", "wpb"),
    "dependency" => Array('element' => "bk_element", 'value' => 'colored')
));
vc_add_param("vc_row", array(
    "type" => "attach_image",
    "heading" => __('Background image', 'wpb'),
    "param_name" => "bg_image",
    "description" => __("Select background image for your row", "wpb"),
    "dependency" => Array('element' => "bk_element", 'value' => 'image')
));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" => __('Background image behavior', 'wpb'),
    "param_name" => "bg_image_repeat",
    "value" => array(
        __("Default", 'wpb') => '',
        __("Cover - background image aligned with top", 'wpb') => 'samba_cover_top',
        __("Cover - background image centered", 'wpb') => 'samba_cover',
        __("Cover - background image aligned with bottom", 'wpb') => 'samba_cover_bottom',
        __('Cover with parallax effect', 'wpb') => 'samba_with_parallax',
        __('Contain', 'wpb') => 'contain'
    ),
    "description" => __("Select how a background image will be repeated", "wpb"),
    "dependency" => Array('element' => "bk_element", 'value' => 'image')
));
vc_add_param("vc_row",array(
      "type" => "dropdown",
      "heading" => __("Background pattern", "js_composer"),
      "param_name" => "bk_pattern",
      "value" => array(
        __('None', "js_composer") => "", 
        __('Bedge Grunge', "js_composer") => "bedge_grunge.png", 
        __('Bullseyes', "js_composer") => "strange_bullseyes.png",
        __('Cream Pixels',"js_composer") =>'cream_pixels.png',
        __('Concrete', "js_composer") =>'concrete_wall_2.png',
        __('Cross Scratches', "js_composer") =>'cross_scratches.png',
        __('Diagonal Noise', "js_composer") =>'diagonal-noise.png',
        __('Dotted Grey', "js_composer") =>'grey.jpg',
        __('Grey Squares', "js_composer") =>'first_aid_kit.png',
        __('Grid Noise', "js_composer") =>'grid_noise.png',
        __('Light Honeycomb', "js_composer") =>'light_honeycomb.png',
        __('Ligh Mesh', "js_composer") =>'lghtmesh.png',
        __('Noise Lines', "js_composer") =>'noise_lines.png',
        __('Paper Fibers', "js_composer") =>'lightpaperfibers.png',
        __('Rough Diagonal', "js_composer") =>'rough_diagonal.png',
        __('Seamless Grid', "js_composer") =>'grid.png',
        __('Seamless White', "js_composer") =>'chruch.png',
        __('Simple White', "js_composer") =>'whitey.png',
        __('Squared Seamless', "js_composer") =>'farmer.png',
        __('Subtle Dots', "js_composer") =>'subtle_dots.png',
        __('Stacked Circles', "js_composer") =>'stacked_circles.png',
        __('Textured Grey', "js_composer") =>'texturetastic_gray.png',
        __('Tiny Grid', "js_composer") =>'tiny_grid.png',
        __('Vintage', "js_composer") =>'vintage_speckles.png',
        __('White Leather', "js_composer") =>'white_leather.png',
        __('White Texture', "js_composer") =>'white_texture.png',
        __('Black Leather', "js_composer") =>'black_leather.png',
        __('Black Linen', "js_composer") =>'black-linen.png',
        __('Black Paper', "js_composer") =>'black_paper.png',
        __('Broken Noise', "js_composer") =>'broken_noise.png',
        __('Cartographer', "js_composer") =>'cartographer.png',
        __('Classy Fabric', "js_composer") =>'classy_fabric.png',
        __('Criss Cross', "js_composer") =>'crissxcross.png',
        __('Dark Denim', "js_composer") =>'darkdenim.png',
        __('Dark Metal', "js_composer") =>'hixs_pattern_evolution.png',
        __('Dark Mosaic', "js_composer") =>'dark_mosaic.png',
        __('Dark Noisy Net', "js_composer") =>'noisy_net.png',
        __('Dark Pin Stripes', "js_composer") =>'pinstriped_suit.png',
        __('Dark Stripes', "js_composer") =>'dark_stripes.png',
        __('Dark Tyre', "js_composer") =>'dark_tire.png',
        __('Debut Dark', "js_composer") =>'debut_dark.png',
        __('Fake Fabric', "js_composer") =>'fake_brick.png',
        __('Iron Grip', "js_composer") =>'irongrip.png',
        __('Navy Blue', "js_composer") =>'navy_blue.png',
        __('Outlets', "js_composer") =>'outlets.png',
        __('Padded', "js_composer") =>'padded.png',
        __('Moulin', "js_composer") =>'moulin.png',
        __('Seamless Dark', "js_composer") =>'nami.png',
        __('Simple Dashed', "js_composer") =>'simple_dashed.png',
        __('Stressed Linen', "js_composer") =>'stressed_linen.png',
        __('Tiny Squares', "js_composer") =>'px.png',
        __('Typographic', "js_composer") =>'type.png',
        __('Vertical Cloth', "js_composer") =>'vertical_cloth.png',
        __('Wood - Dark', "js_composer") =>'dark_wood.png',
        __('Wood - Yellowish', "js_composer") =>'retina_wood.png',
        __('Wood - Yellow', "js_composer") =>'purty_wood.png',
        __('Wood - Textured', "js_composer") =>'wood_texture.png',
        __('Blue', "js_composer") =>'blu_stripes.png',
        __('Blue Variations', "js_composer") =>'random_grey_variations.png',
        __('Green - Vintage', "js_composer") =>'green_dust_scratch.png',
        __('Shattered', "js_composer") =>'shattered.png',
        __('Shattered', "js_composer") =>'shattered.jpg',
        __('Play Pattern', "js_composer") =>'gplaypattern.png'),
      "description" => __("Optional - Will override background color<span class='prk_theme_url' style='display:none;'>".get_template_directory_uri()."</span>", "js_composer"),
      "dependency" => Array('element' => "bk_element", 'value' => 'pattern')
    ));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "heading" => __("Text alignment", "js_composer"),
    "param_name" => "align",
    "value" => array("Left","Center","Right"),
    "description" => __("Can be overriden by individual elements settings", "js_composer")
));
vc_add_param("vc_row", array(
   "type" => "colorpicker",
   "holder" => "div",
   "class" => "",
   "heading" => __("Text color", 'js_composer'),
   "param_name" => "font_color",
   "value" => __("", 'js_composer'),
   "description" => __("Optional", 'js_composer')
));
vc_add_param("vc_row", $add_css_animation);
vc_add_param("vc_row", array(
    "type" => "textfield",
    'heading' => __( 'Extra class name', 'js_composer' ),
    "param_name" => "el_class",
    "value"=> "",
    "description" => ""
));
vc_add_param("vc_row", $add_css_hide);

/* Column Overrides ----------------------------------------------------- */
vc_remove_param('vc_column', 'font_color');
vc_remove_param('vc_column', 'css');
vc_remove_param('vc_column', 'el_class');
vc_remove_param('vc_column', 'width');
vc_remove_param('vc_column', 'offset');
vc_add_param("vc_column", $add_css_animation);
vc_add_param("vc_column", array(
    "type" => "textfield",
    'heading' => __( 'Extra class name', 'js_composer' ),
    "param_name" => "el_class",
    "value"=> "",
    "description" => ""
));

/* Inner Column Overrides ----------------------------------------------------- */
vc_remove_param('vc_column_inner', 'font_color');
vc_remove_param('vc_column_inner', 'css');
vc_remove_param('vc_column_inner', 'el_class');
vc_remove_param('vc_column_inner', 'width');
vc_remove_param('vc_column_inner', 'offset');
vc_add_param("vc_column_inner", $add_css_animation);
vc_add_param("vc_column_inner", array(
    "type" => "textfield",
    'heading' => __( 'Extra class name', 'js_composer' ),
    "param_name" => "el_class",
    "value"=> "",
    "description" => ""
));

/* Text Block Overrides ----------------------------------------------------- */
vc_remove_param('vc_column_text', 'el_class');
vc_remove_param('vc_column_text', 'css');
vc_add_param("vc_column_text", $add_css_animation);
vc_add_param("vc_column_text", array(
    "type" => "textfield",
    'heading' => __( 'Extra class name', 'js_composer' ),
    "param_name" => "el_class",
    "value"=> "",
    "description" => ""
));

/* Message Box Overrides ----------------------------------------------------- */
vc_remove_param('vc_message', 'el_class');
vc_remove_param('vc_message', 'css');
vc_add_param("vc_message", $add_css_animation);
vc_add_param("vc_message", array(
    "type" => "textfield",
    'heading' => __( 'Extra class name', 'js_composer' ),
    "param_name" => "el_class",
    "value"=> "",
    "description" => ""
));

/* Single Image Overrides ----------------------------------------------------- */
vc_remove_param('vc_single_image', 'el_class');
vc_remove_param('vc_single_image', 'css');
vc_add_param("vc_single_image", $add_css_animation);
vc_add_param("vc_single_image", array(
    "type" => "textfield",
    'heading' => __( 'Extra class name', 'js_composer' ),
    "param_name" => "el_class",
    "value"=> "",
    "description" => ""
));

/* Google Maps Overrides ----------------------------------------------------- */
vc_remove_param('vc_gmaps', 'link');
vc_remove_param('vc_gmaps', 'size');
vc_remove_param('vc_gmaps', 'el_class');

vc_add_param("vc_gmaps", array(
"type" => "textfield",
"heading" => __("Google map latitude", "js_composer"),
"param_name" => "map_latitude",
"admin_label" => true,
"description" => __("", "js_composer")
));
vc_add_param("vc_gmaps", array(
"type" => "textfield",
"heading" => __("Google map longitude", "js_composer"),
"param_name" => "map_longitude",
"admin_label" => true,
"description" => __("", "js_composer")
));
vc_add_param("vc_gmaps", array(
"type" => "dropdown",
"heading" => __("Map Style", "js_composer"),
"param_name" => "map_style",
"value" => array(
__("Default", "js_composer") => "default", 
__("Almost Gray", "js_composer") => "almost_gray", 
__("Subtle Grayscale", "js_composer") => "subtle_grayscale",
__("Cobalt", "js_composer") => "cobalt", 
__("Midnight Commander", "js_composer") => "midnight", 
__("Old Timey", "js_composer") => "old_timey", 
__("Greenish", "js_composer") => "green"),
"description" => __("", "js_composer")
));
vc_add_param("vc_gmaps", array(
"type" => "textfield",
"heading" => __("Map height", "js_composer"),
"param_name" => "size",
"description" => __('Enter map height in pixels. Example: 200.', "js_composer")
));
vc_add_param("vc_gmaps", array(
"type" => "dropdown",
"heading" => __("Map Zoom", "js_composer"),
"param_name" => "zoom",
"value" => array(__("14 - Default", "js_composer") => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
));
vc_add_param("vc_gmaps", array(
"type" => "attach_image",
"heading" => __("Marker Image", "js_composer"),
"param_name" => "marker_image",
"value" => "",
"description" => __("Optional", "js_composer")
));
vc_add_param("vc_gmaps", array(
"type" => "textfield",
"heading" => __("Marker image latitude", "js_composer"),
"param_name" => "marker_image_lat",
"description" => __("Optional", "js_composer")
));
vc_add_param("vc_gmaps", array(
"type" => "textfield",
"heading" => __("Marker image longitude", "js_composer"),
"param_name" => "marker_image_long",
"description" => __("Optional", "js_composer")
));
vc_add_param("vc_gmaps", array(
"type" => "textfield",
"heading" => __("Extra class name", "js_composer"),
"param_name" => "el_class",
"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
));

/* Progress Bar Overrides ---------------------------------------------------------- */
vc_remove_param('vc_progress_bar', 'options');
vc_remove_param('vc_progress_bar', 'el_class');
vc_add_param("vc_progress_bar", array(
"type" => "colorpicker",
"heading" => __("Bar custom color", "js_composer"),
"param_name" => "custombgcolor",
"description" => __("Select custom color for bars.", "js_composer"),
"dependency" => Array('element' => "bgcolor", 'value' => array('custom'))
));
vc_add_param("vc_progress_bar", array(
"type" => "colorpicker",
"heading" => __("Bars custom background color", "js_composer"),
"param_name" => "custombgcolor_back",
"description" => __("Select custom background color for bars - leave blank for theme default value", "js_composer"),
));
vc_add_param("vc_progress_bar", array(
"type" => "textfield",
"heading" => __("Extra class name", "js_composer"),
"param_name" => "el_class",
"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
));


/* Extra Elements - Samba Theme ----------------------------------------------------- */
function samba_integrateWithVC() {
    $posts_terms=get_terms('category','hide_empty=0');
    $posts_terms_array=array();
    if (count($posts_terms)) {
        foreach ($posts_terms as $inner_term) {
            $posts_terms_array[$inner_term->name] = $inner_term->slug;
        }
    }
    $portfolio_terms=get_terms('pirenko_skills','hide_empty=0');
    $portfolio_terms_array=array();
    if (count($portfolio_terms)) {
        foreach ($portfolio_terms as $inner_term) {
            $portfolio_terms_array[$inner_term->name] = $inner_term->slug;
        }
    }
    $slides_terms=get_terms('pirenko_slide_set','hide_empty=0');
    $slides_terms_array=array();
    if (count($slides_terms)) {
        foreach ($slides_terms as $inner_term) {
            $slides_terms_array[$inner_term->name] = $inner_term->slug;
        }
    }

    $authors_terms=get_users();
    $authors_terms_array=array();
    if (count($authors_terms)) {
        foreach ($authors_terms as $inner_term) {
            $authors_terms_array[$inner_term->user_nicename] = $inner_term->ID;
        }
    }
    $testimonials_terms=get_terms('pirenko_testimonial_set','hide_empty=0');
    $testimonials_terms_array=array();
    if (count($testimonials_terms)) {
        foreach ($testimonials_terms as $inner_term) {
            $testimonials_terms_array[$inner_term->name] = $inner_term->slug;
        }
    }
    global $add_css_animation,$pirenko_colors_arr,$target_arr,$icons_arr,$size_arr,$yes_no_arr,$no_yes_arr;
    /* Vertical Spacer ----------------------------------------------------- */
    function prkwp_spacer_func($atts) {
        extract( shortcode_atts(array(
            'size' => '',
            'el_class' => ''
        ),$atts));
        return do_shortcode('[pirenko_spacer size="'.$size.'" el_class="'.$el_class.'"][/pirenko_spacer]');
    }
    add_shortcode('prkwp_spacer','prkwp_spacer_func');

    vc_map(array(
        "name" => __("Vertical Spacer","samba_lang"),
        "base" => "prkwp_spacer",
        "class" => "samba_scodes_editor",
        "description" => __('Control vertical space between elements', 'js_composer'),
        "icon" => "icon-wpb-ui-empty_space",
        "category" => __('Theme: Special',"seven_lang"),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Vertical size in pixels (use negative values to pull elements up)","samba_lang"),
                "param_name" => "size",
                "value" => "10",
                "description" => "This element creates a vertical space between adjacent elements."
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "js_composer"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
            )
        )
    ));

    /* Styled Title ----------------------------------------------------- */
    function prkwp_styled_title_func( $atts ) {
    extract( shortcode_atts( array(
    'prk_in' => '',
    'align' => '',
    'text_color' => '',
    'title_size' => '',
    'use_italic' => '',
    'show_lines' => '',
    'font_type' => '',
    'samba_show_line' => '',
    'underlined' => '',
    'css_animation' => '',
    'line_color' => '',
    'el_class' => ''
    ), $atts ) );

    return do_shortcode('[prk_styled_title align="'.strtolower($align).'" line_color="'.$line_color.'" text_color="'.$text_color.'" font_type="'.strtolower($font_type).'" underlined="'.strtolower($underlined).'" title_size="'.strtolower($title_size).'" samba_show_line="'.strtolower($samba_show_line).'" use_italic="'.strtolower($use_italic).'" css_animation="'.$css_animation.'" el_class="'.$el_class.'"]'.$prk_in.'[/prk_styled_title]');
    }
    add_shortcode('prkwp_styled_title','prkwp_styled_title_func');

  vc_map(array(
     "name" => __("Styled title","samba_lang"),
     "base" => "prkwp_styled_title",
     "class" => "samba_scodes_editor",
     "icon" => "icon-wpb-ui-separator-label",
     "description" => __('Display theme like titles', 'js_composer'),
     "category" => __('Theme: Special',"samba_lang"),
     "params" => array(
      array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Text","samba_lang"),
           "param_name" => "prk_in",
           "value" => "",
           "description" => ""
        ),
      array(
            "type" => "dropdown",
            "heading" => __("Alignment", "js_composer"),
            "param_name" => "align",
            "value" => array("Left","Center","Right"),
            "description" => ""
        ),
      array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => __("Color","samba_lang"),
           "param_name" => "text_color",
           "value" => "",
           "description" => __("Optional - If blank the theme default headings color will be used","samba_lang")
        ),
      array(
            "type" => "dropdown",
            "heading" => __("Title size", "js_composer"),
            "param_name" => "title_size",
            "value" => array("Large","Medium","Small"),
            "description" => ""
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Italic font style?", "js_composer"),
            "param_name" => "use_italic",
            "value" => array("No","Yes"),
            "description" => ""
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show line under title?", "js_composer"),
            "param_name" => "samba_show_line",
            "value" => array("Yes","No"),
            "description" => ""
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Zero margin after title?", "js_composer"),
            "param_name" => "unmargined",
            "value" => array(__('No', "js_composer") => "",__('Yes', "js_composer") => "unmargined"),
            "description" => __("This is usefull for single big headings.", "js_composer")
        ),
        $add_css_animation,
        array(
          "type" => "textfield",
          "heading" => __("Extra class name", "js_composer"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )     
     )
    ));


/* Blockquote ----------------------------------------------------- */
function bquote_func( $atts ) {
    extract( shortcode_atts( array(
    'prk_in' => '',
    'author' => '',
    'after_author' => '',
    'type' => '',
    'css_animation' => '',
    'el_class' => ''
    ), $atts ) );

    return do_shortcode("<div class='wpb_content_element'>[pirenko_blockquote author='{$author}' after_author='{$after_author}' type='{$type}' css_animation='{$css_animation}' el_class='{$el_class}']{$prk_in}[/pirenko_blockquote]</div>");
}
add_shortcode( 'bquote', 'bquote_func' );

vc_map( array(
"name" => __("Blockquote","samba_lang"),
"base" => "bquote",
"class" => "samba_scodes_editor",
"icon" => "icon-wpb-atm",
"description" => __('Stylish quotes that stand out', 'js_composer'),
"category" => __('Theme: Special',"seven_lang"),
"params" => array(
array(
   "type" => "textfield",
   "holder" => "div",
   "class" => "",
   "heading" => __("Author","samba_lang"),
   "param_name" => "author",
   "value" => __("","samba_lang"),
   "description" => __("","samba_lang")
),
array(
   "type" => "textfield",
   "holder" => "div",
   "class" => "",
   "heading" => __("After author text","samba_lang"),
   "param_name" => "after_author",
   "value" => __("","samba_lang"),
   "description" => __("Optional","samba_lang")
),
array(
   "type" => "textarea",
   "holder" => "div",
   "class" => "",
   "heading" => __("Content","samba_lang"),
   "param_name" => "prk_in",
   "value" => __("","samba_lang"),
   "description" => __("","samba_lang")
),
array(
    "type" => "dropdown",
    "heading" => __("Blockquote type", "js_composer"),
    "param_name" => "type",
     "value" => array(
      __('Plain', "js_composer") => "plain", 
      __('Colored background', "js_composer") => "colored_background"
    ),
    "description" => ""
),
$add_css_animation,
  array(
    "type" => "textfield",
    "heading" => __("Extra class name", "js_composer"),
    "param_name" => "el_class",
    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
  )
)
));

//TOGGLE
  vc_map( array(
     "name" => __("Toggle","samba_lang"),
     "base" => "prk_accordion",
     "class" => "samba_scodes_editor",
     "icon" => "icon-wpb-toggle-small-expand",
     "description" => __('jQuery UI accordion', 'js_composer'),
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title","samba_lang"),
           "param_name" => "title",
           "value" => "",
           "description" => ""
        ),
        array(
           "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Toggle text", "js_composer"),
            "param_name" => "content",
            "value" => __("<p>Toggle content goes here, click edit button to change this text.</p>", "js_composer"),
        ),
     )
  ));


 //SERVICE
  function prkwp_service_func( $atts,$content=null ) {
     extract( shortcode_atts( array(
        'name' => '',
        'align' => '',
        'image' => '',
        'bk_color' => '',
        'link' => '',
        'serv_image' => '',
        'link_text' => '',
        'new_window' => '',
        'css_animation' => '',
        'el_class' => ''
     ), $atts ) );
     if ($align=="center")
        $align="prk_service_center";
      else
        $align="prk_service_left";
    $image_attributes = wp_get_attachment_image_src( $serv_image,'full' );
     return do_shortcode('[prk_service name="'.$name.'" align="'.$align.'" image="'.$image.'" serv_image="'.$image_attributes[0].'" link="'.$link.'" bk_color="'.$bk_color.'" link_text="'.$link_text.'" css_animation="'.$css_animation.'" new_window="'.$new_window.'" el_class="'.$el_class.'"]'.$content.'[/prk_service]');
  }
  add_shortcode( 'prkwp_service', 'prkwp_service_func' );
  vc_map( array(
     "name" => __("Service","samba_lang"),
     "base" => "prkwp_service",
     "class" => "samba_scodes_editor",
     "icon" => "icon-wpb-call-to-action",
     "description" => __('Easy information blocks with images', 'js_composer'),
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title","samba_lang"),
           "param_name" => "name",
           "value" => "",
           "description" => ""
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Alignment", "js_composer"),
            "param_name" => "align",
            "value" => array(
              __('Left', "js_composer") => "left", 
              __('Center', "js_composer") => "center"
            ),
            "description" => ""
        ),
        array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => __("Background color","samba_lang"),
           "param_name" => "bk_color",
           "value" => "",
           "description" => __("Optional","samba_lang")
        ),
        array(
          "type" => "attach_image",
          "heading" => __("Service image", "js_composer"),
          "param_name" => "serv_image",
          "value" => "",
          "description" => __("Select image from media library. Has priority over icon class value below.", "js_composer")
    ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Icon class","samba_lang"),
           "param_name" => "image",
           "value" => "",
           "description" => __("Example: icon-video. For a complete list open the icons.png file inside the documentation folder.","samba_lang")
        ),
        array(
        "type" => "textarea_html",
        "holder" => "div",
        "class" => "messagebox_text prkadmin_hide_now",
        "heading" => __("Service text", "js_composer"),
        "param_name" => "content",
        "value" => __("", "js_composer")
      ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("URL link","samba_lang"),
           "param_name" => "link",
           "value" => "",
           "description" => __("Optional","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("URL link text","samba_lang"),
           "param_name" => "link_text",
           "value" => "",
           "description" => __("Leave blank for theme default Read More text.","samba_lang")
        ),
        array(
          "type" => "dropdown",
          "heading" => __("Open link in a new window?", "js_composer"),
          "param_name" => "new_window",
          "value" => array("No","Yes"),
          "description" => __("", "js_composer","samba_lang")
        ),
        $add_css_animation,
        array(
          "type" => "textfield",
          "heading" => __("Extra class name", "js_composer"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
     )
  ) );

  /* Theme Button ----------------------------------------------------- */
  function theme_button_func( $atts ) {
    extract( shortcode_atts( array(
        'prk_in' => '',
        'type' => '',
        'window' => '',
        'link' => '',
      ), $atts ) );
      if ($window=="No")
        $window="_self";
      else
        $window="_blank";
   
     return do_shortcode('[theme_button type="'.$type.'" link="'.$link.'" window="'.$window.'"]'.$prk_in.'[/theme_button]');
  }
  add_shortcode( 'prk_wp_theme_button', 'theme_button_func' );

  vc_map( array(
     "name" => __("Theme Button","samba_lang"),
     "base" => "prk_wp_theme_button",
     "class" => "samba_scodes_editor",
     "description" => __('Buttons with the theme default styling', 'js_composer'),
     "icon" => "icon-wpb-ui-button",
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
      array(
            "type" => "dropdown",
            "heading" => __("Button type", "js_composer"),
            "param_name" => "type",
             "value" => array(
              __('Large Theme Button', "js_composer") => "theme_button large", 
              __('Medium Theme Button', "js_composer") => "theme_button medium",
              __('Small Theme Button', "js_composer") => "theme_button small", 
              __('Tiny Theme Button', "js_composer") => "theme_button tiny",
              __('Large Theme Button - Inverted Colors', "js_composer") => "theme_button_inverted large", 
              __('Medium Theme Button - Inverted Colors', "js_composer") => "theme_button_inverted medium",
              __('Small Theme Button - Inverted Colors', "js_composer") => "theme_button_inverted small", 
              __('Tiny Theme Button - Inverted Colors', "js_composer") => "theme_button_inverted tiny",
            ),
            "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Button text","samba_lang"),
           "param_name" => "prk_in",
           "value" => __("","samba_lang"),
           "description" => __("","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Link","samba_lang"),
           "param_name" => "link",
           "value" => __("","samba_lang"),
           "description" => __("","samba_lang")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Open link in a new window?", "js_composer"),
            "param_name" => "window",
            "value" => array("No","Yes"),
            "description" => __("", "js_composer","samba_lang")
        ),
        $add_css_animation,
        array(
          "type" => "textfield",
          "heading" => __("Extra class name", "js_composer"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
     )
  ));

/* Call to Action Button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Call to Action Button", "js_composer"),
  "base" => "vc_cta_button",
  "icon" => "icon-wpb-call-to-action",
  "description" => __('Call to action element', 'js_composer'),
  "category" => __('Theme: Special',"seven_lang"),
  "params" => array(
    array(
      "type" => "textarea",
      'admin_label' => true,
      "heading" => __("Title", "js_composer"),
      "param_name" => "call_text",
      "value" => __("Click edit button to change this text.", "js_composer"),
      "description" => __("Enter your content.", "js_composer")
    ),
    array(
      "type" => "textarea",
      'admin_label' => true,
      "heading" => __("Text", "js_composer"),
      "param_name" => "call_desc",
      "value" => __("This is the call to action description. Click edit button to change this text.", "js_composer"),
      "description" => __("Optional", "js_composer")
    ),
    array(
       "type" => "colorpicker",
       "holder" => "div",
       "class" => "",
       "heading" => __("Background color"),
       "param_name" => "bk_color",
       "value" => __(""),
       "description" => __("Optional")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Text alignment", "js_composer"),
      "param_name" => "text_align",
      "value" => array(__("Right", "js_composer") => "text_right", __("Left", "js_composer") => "text_left", __("Center", "js_composer") => "text_center"),
      "description" => __("Select general text alignment.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Text on the button", "js_composer"),
      "param_name" => "title",
      "value" => __("Text on the button", "js_composer"),
      "description" => __("Text on the button.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("URL (Link)", "js_composer"),
      "param_name" => "href",
      "description" => __("Button link.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Target", "js_composer"),
      "param_name" => "target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Color", "js_composer"),
      "param_name" => "color",
      "value" => $pirenko_colors_arr,
      "description" => __("Button color.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Icon", "js_composer"),
      "param_name" => "icon",
      "value" => $icons_arr,
      "description" => __("Button icon (not available for theme buttons).", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Size", "js_composer"),
      "param_name" => "size",
      "value" => $size_arr,
      "description" => __("Button size.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Button position", "js_composer"),
      "param_name" => "position",
      "value" => array(__("Right", "js_composer") => "cta_align_right", __("Left", "js_composer") => "cta_align_left", __("Bottom", "js_composer") => "cta_align_bottom"),
      "description" => __("Select button alignment.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Button horizontal alignment", "js_composer"),
      "param_name" => "button_align",
      "value" => array(__("Right", "js_composer") => "button_right", __("Left", "js_composer") => "button_left", __("Center", "js_composer") => "button_center"),
      "description" => __("Select button alignment.", "js_composer")
    ),
    $add_css_animation,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  ),
  "js_view" => 'VcCallToActionView'
) );

    /* Image Gallery ----------------------------------------------------- */
    vc_map( array(
  "name" => __("Image Gallery", "js_composer"),
  "base" => "vc_gallery",
  "icon" => "icon-wpb-images-stack",
  "description" => __('Multiple images from Media Library', 'js_composer'),
  "category" => __('Theme: Special',"seven_lang"),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "js_composer"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Gallery type", "js_composer"),
      "param_name" => "type",
      "value" => array(
        __("Flex slider fade", "js_composer") => "flexslider_fade", 
        __("Flex slider slide", "js_composer") => "flexslider_slide", 
        __("Nivo slider", "js_composer") => "nivo", 
        __("Image grid", "js_composer") => "image_grid"),
      "description" => __("Select gallery type.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate slides", "js_composer"),
      "param_name" => "interval",
      "value" => array(3, 5, 10, 15, __("Disable", "js_composer") => 0),
      "description" => __("Auto rotate slides each X seconds.", "js_composer"),
      "dependency" => Array('element' => "type", 'value' => array('flexslider_fade', 'flexslider_slide', 'nivo'))
    ),
    array(
      "type" => "attach_images",
      "heading" => __("Images", "js_composer"),
      "param_name" => "images",
      "value" => "",
      "description" => __("Select images from media library.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Image size", "js_composer"),
      "param_name" => "img_size",
      "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("On click", "js_composer"),
      "param_name" => "onclick",
      "value" => array(__("Open lightbox", "js_composer") => "link_image", __("Do nothing", "js_composer") => "link_no"),
      "description" => __("What to do when image is clicked?", "js_composer")
    ),
    array(
      "type" => "exploded_textarea",
      "heading" => __("Custom links", "js_composer"),
      "param_name" => "custom_links",
      "description" => __('Enter links for each slide here. Divide links with linebreaks (Enter).', 'js_composer'),
      "dependency" => Array('element' => "onclick", 'value' => array('custom_link'))
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Custom link target", "js_composer"),
      "param_name" => "custom_links_target",
      "description" => __('Select where to open  custom links.', 'js_composer'),
      "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
      'value' => $target_arr
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  )
) );

   //THEME SLIDER
  vc_map( array(
     "name" => __("Theme slider","samba_lang"),
     "base" => "prk_slider",
     "class" => "samba_scodes_editor",
     "description" => __('Display theme slides using Flexslider', 'js_composer'),
     "icon" => "icon-wpb-slideshow",
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
      array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Groups filter using slug(s) - comma separated ","samba_lang"),
           "param_name" => "category",
           "value" => "",
           "description" => __("Optional - leave blank for all","samba_lang")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Autoplay slider?", "js_composer"),
            "param_name" => "autoplay",
            "value" => $yes_no_arr,
            "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Slider delay","samba_lang"),
           "param_name" => "delay",
           "value" => "",
           "description" => __("In miliseconds - If blank the theme default value will be used","samba_lang")
        )
     )
  ) );

vc_map( array(
  "name" => __("Theme Image Gallery", "js_composer"),
  "description" => __('Multiple images from Media Library', 'js_composer'),
  "base" => "pirenko_gallery",
  "icon" => "icon-wpb-images-stack",
  "category" => __('Theme: Special',"seven_lang"),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Gallery type", "js_composer"),
      "param_name" => "type",
      "value" => array(__("Masonry", "js_composer") => "masonry", __("Grid (rectangles)", "js_composer") => "grid", __("Grid (squares)", "js_composer") => "squares"),
      "description" => __("Select grid type.", "js_composer")
    ),
    array(
       "type" => "textfield",
       "holder" => "div",
       "class" => "",
       "heading" => __("Thumbnails margin","astro_lang"),
       "param_name" => "thumbs_mg",
       "value" => "",
       "description" => __("Default value is 10","astro_lang")
    ),
    array(
      "type" => "attach_images",
      "heading" => __("Images", "js_composer"),
      "param_name" => "images",
      "value" => "",
      "description" => __("Select images from media library.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  )
) );


   //CAROUSEL
  function prkwp_carousel_func( $atts ) {
     extract( shortcode_atts( array(
        'images' => '',
        'title' => '',
     ), $atts ) );
    $images_output="";
    $arr=explode(",",$images);
    if (count($arr)>0) {
      foreach ($arr as $single) {
        $image_attributes = wp_get_attachment_image_src( $single,'full' );
        $images_output.='[prk_carousel_single path="'.$image_attributes[0].'"][/prk_carousel_single]';
      }
    }
   
     return do_shortcode('[prk_carousel title="'.$title.'"]'.$images_output.'[/prk_carousel]');
  }
  add_shortcode( 'prkwp_carousel', 'prkwp_carousel_func' );
  vc_map( array(
     "name" => __("Images Carousel","samba_lang"),
     "base" => "prkwp_carousel",
     "description" => __('Animated carousel with images', 'js_composer'),
     "class" => "samba_scodes_editor",
     "icon" => "icon-wpb-images-carousel",
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title","samba_lang"),
           "param_name" => "title",
           "value" => __("","samba_lang"),
           "description" => __("","samba_lang")
        ),
        array(
          "type" => "attach_images",
          "heading" => __("Images", "js_composer"),
          "param_name" => "images",
          "value" => "",
          "description" => __("Select images from media library.", "js_composer")
    )
     )
  ));


  //PRICING TALBES
  function prkwp_price_table_func( $atts ) {
     extract( shortcode_atts( array(
        'prk_in' => '',
        'featured' => '',
        'header' => '',
        'color' => '',
        'price' => '',
        'under_price' => '',
        'button_label' => '',
        'button_link' => '',
     ), $atts ) );
    $lines_output="<ul>";
    $prk_tweaked = str_replace(", ", "prkwrdoff", $prk_in);
    $arr=explode(",",$prk_tweaked);
    if (count($arr)>0) 
    {
      foreach ($arr as $single) {
        $lines_output.='<li>'.str_replace("prkwrdoff", ", ",$single).'</li>';
      }
    }
    $lines_output.="</ul>";
     return do_shortcode('[prk_price_table header="'.$featured.'" featured="'.$header.'" color="'.$color.'" price="'.$price.'" under_price="'.$under_price.'" button_label="'.$button_label.'" button_link="'.$button_link.'"]'.$lines_output.'[/prk_price_table]');
  }
  add_shortcode( 'prkwp_price_table', 'prkwp_price_table_func' );
  
  vc_map( array(
     "name" => __("Pricing table","samba_lang"),
     "base" => "prkwp_price_table",
     "class" => "samba_scodes_editor",
     "icon" => "icon-wpb-atm",
     "description" => __('Informational tables with multiple content fields', 'js_composer'),
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title","samba_lang"),
           "param_name" => "featured",
           "value" => "",
           "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Header/featured text","samba_lang"),
           "param_name" => "header",
           "value" => "",
           "description" => __("Optional - Will be displayed under the title","samba_lang")
        ),
        array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => __("Color","samba_lang"),
           "param_name" => "color",
           "value" => "",
           "description" => __("Optional - If blank the theme active color will be used","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Price text","samba_lang"),
           "param_name" => "price",
           "value" => "",
           "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Under price text","samba_lang"),
           "param_name" => "under_price",
           "value" => "",
           "description" => __("Example: per month","samba_lang")
        ),
        array(
           "type" => "exploded_textarea",
           "holder" => "div",
           "class" => "",
           "heading" => __("Description text","samba_lang"),
           "param_name" => "prk_in",
           "value" => "",
           "description" => __("Enter descriptions for this table here. Divide them with linebreaks (Enter).","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Button text","samba_lang"),
           "param_name" => "button_label",
           "value" => "",
           "description" => __("Leave blank if no button is needed","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Button URL","samba_lang"),
           "param_name" => "button_link",
           "value" => "",
           "description" => __("Leave blank if no button is needed","samba_lang")
        )
     )
  ) );
    //LATEST POSTS
  vc_map( array(
     "name" => __("Latest Posts","samba_lang"),
     "base" => "pirenko_last_posts",
     "class" => "samba_scodes_editor",
     "icon" => "icon-wpb-vc_carousel",
     "description" => __('Show blog entries', 'js_composer'),
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
        array(
           "type" => "checkbox",
           "heading" => __("Category filter","samba_lang"),
           "param_name" => "cat_filter",
           "value" => $posts_terms_array,
           "description" => __("Optional - leave blank for all","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Items number","samba_lang"),
           "param_name" => "items_number",
           "value" => "",
           "description" => __("Optional - Default is three","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Rows number","samba_lang"),
           "param_name" => "rows_number",
           "value" => "3",
           "description" => ""
        ),
        $add_css_animation,
        array(
          "type" => "textfield",
          "heading" => __("Extra class name", "js_composer"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
     )
  ) );

 //LATEST PORTFOLIO
  vc_map( array(
     "name" => __("Latest Portfolio","samba_lang"),
     "base" => "pirenko_last_portfolios",
     "class" => "samba_scodes_editor",
     "description" => __('Show portfolio entries', 'js_composer'),
     "icon" => "icon-wpb-images-carousel",
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Block type?", "js_composer"),
            "param_name" => "layout_type_folio",
            "value" => array(__("Grid", "js_composer") => "grid", __("Masonry", "js_composer") => "masonry", __("With titles", "js_composer") => "titled",__("With titles and excerpt", "js_composer") => "with_excerpt"),
            "description" => ""
          ),
          array(
            "type" => "dropdown",
            "heading" => __("Show skills information on each post?", "js_composer"),
            "param_name" => "samba_show_skills",
            "value" => $yes_no_arr,
            "description" => ""
        ),
          array(
           "type" => "checkbox",
           "heading" => __("Skills filter","samba_lang"),
           "param_name" => "cat_filter",
           "value" => $portfolio_terms_array,
           "description" => __("Optional - leave blank for all","samba_lang")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show filter above thumbnails?", "js_composer"),
            "param_name" => "show_filter",
            "value" => $yes_no_arr,
            "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Items number","samba_lang"),
           "param_name" => "items_number",
           "value" => "",
           "description" => __("Optional - default value is 9","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Columns number","samba_lang"),
           "param_name" => "cols_number",
           "value" => "3",
           "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Thumbnails margin","samba_lang"),
           "param_name" => "thumbs_mg",
           "value" => "",
           "description" => __("Default value is 10","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("View portfolio button text","samba_lang"),
           "param_name" => "button_label",
           "value" => "",
           "description" => __("Leave blank if no button is needed","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("View portfolio button URL","samba_lang"),
           "param_name" => "button_url",
           "value" => "",
           "description" => __("Leave blank if no button is needed","samba_lang")
        ),
        $add_css_animation,
        array(
          "type" => "textfield",
          "heading" => __("Extra class name", "js_composer"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
     )
  ) );
//TEAM MEMBERS
  vc_map( array(
     "name" => __("Team members","samba_lang"),
     "base" => "prk_members",
     "class" => "samba_scodes_editor",
     "icon" => "icon-wpb-information-white",
     "description" => __('Display team members info', 'js_composer'),
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Teams filter using slug(s) - comma separated ","samba_lang"),
           "param_name" => "category",
           "value" => "",
           "description" => __("Optional - leave blank for all","samba_lang")
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Number of members per column","samba_lang"),
           "param_name" => "columns",
           "value" => "3",
           "description" => ""
        ),
        $add_css_animation,
        array(
          "type" => "textfield",
          "heading" => __("Extra class name", "js_composer"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
     )
  ) );

   //COMMENTS
  vc_map( array(
     "name" => __("Comments","samba_lang"),
     "base" => "pirenko_comments",
     "class" => "samba_scodes_editor",
     "icon" => "icon-wpb-prk-comments",
     "description" => __('Display comments from users', 'js_composer'),
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title","samba_lang"),
           "param_name" => "title",
           "value" => "",
           "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Number of comments","samba_lang"),
           "param_name" => "items_number",
           "value" => "",
           "description" => ""
        ),
        $add_css_animation,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
     )
  ));

  //SITEMAP
  vc_map( array(
     "name" => __("Sitemap","samba_lang"),
     "base" => "prk_sitemap",
     "class" => "samba_scodes_editor",
     "icon" => "icon-wpb-information-white",
     "description" => __('Complete sitemap with all post types', 'js_composer'),
     "category" => __('Theme: Special',"seven_lang"),
     "params" => array(
      array(
            "type" => "dropdown",
            "heading" => __("Show Pages?", "js_composer"),
            "param_name" => "show_pages",
            "value" => $yes_no_arr,
            "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title for Pages","samba_lang"),
           "param_name" => "txt_pages",
           "value" => "",
           "description" => ""
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show blog categories?", "js_composer"),
            "param_name" => "show_blog_cats",
            "value" => $yes_no_arr,
            "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title for blog categories","samba_lang"),
           "param_name" => "txt_blog_cats",
           "value" => "",
           "description" => ""
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show blog posts?", "js_composer"),
            "param_name" => "show_posts",
            "value" => $yes_no_arr,
            "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title for blog posts","samba_lang"),
           "param_name" => "txt_posts",
           "value" => "",
           "description" => ""
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show portfolio posts?", "js_composer"),
            "param_name" => "show_port_posts",
            "value" => $yes_no_arr,
            "description" => ""
        ),
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title for portfolio posts","samba_lang"),
           "param_name" => "txt_port_posts",
           "value" => "",
           "description" => ""
        ),
        $add_css_animation,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
     )
  ));


}
add_action( 'vc_before_init', 'samba_integrateWithVC' );



