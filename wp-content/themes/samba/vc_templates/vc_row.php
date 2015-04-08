<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $bk_element = $vid_mp4 = $vid_webm ='';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'row_height'   => '',
    'bk_type' =>'boxed_look',
    'align' =>'Left',
    'bk_element' => '',
    'vid_parallax'=>'no',
    'append_arrow' =>'no',
    'vid_mp4' =>'',
    'vid_webm' =>'',
    'hide_with_css' =>'',
    'css_animation'
), $atts));
if ($bk_type=="full_width")
    $prk_css_classes=" prk_full_width prk_section";
else
    $prk_css_classes=" prk_section centered columns";

if ($align=="Left")
{
    $prk_css_classes.=" samba_align_left";
}
if ($align=="Center")
{
    $prk_css_classes.=" samba_align_center";
}
if ($align=="Right")
{
    $prk_css_classes.=" samba_align_right";
}

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);

$hide_with_css = str_replace(',', ' ', $hide_with_css);
$css_class .= $this->getExtraClass($hide_with_css);

$father_css_class="";
if ($this->settings['base']=="vc_row_inner")
{
    $father_css_class=" inner_row_father";
}
if (isset($atts['css_animation']) && $atts['css_animation']!="")
    $prk_css_classes.=" wpb_animate_when_almost_visible wpb_".$atts['css_animation'];
$parallax_code='';
if (isset($atts['bg_image_repeat'])) {
    $prk_css_classes.=' '.$atts['bg_image_repeat'];
    if ($atts['bg_image_repeat']=='samba_with_parallax')
    {
        if (strpos($css_class,'ultra_lax') !== false) {
            $parallax_code=' data-0-top-top="background-position: 50% 0%;" data-0-top-bottom="background-position: 50% 100%;"';
        }
        else {
            $parallax_code=' data-bottom-top="background-position: 50% 0%;" data-top-bottom="background-position: 50% 100%;"';
        }
    }
}

//LEGACY SUPPORT
$row_id=$arrow_code=$video_code='';
if (isset($atts['anchor_id']) && $atts['anchor_id']!="")
{
    $row_id='id="'.$atts['anchor_id'].'"';
}
else
{
    $row_id='id="seven-'.rand(1, 1000).'"';
}

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
if ($bk_type=="full_width") {
    $output .= '<div '.$row_id.' class="'.$css_class.' '.$prk_css_classes.'" '.$style.$parallax_code.'>';
        $output .= '<div class="prk_inner_block columns centered">';
        $output .= '<div class="row">';
            $output .= wpb_js_remove_wpautop($content);
        $output .= '</div>';
        $output .= '</div>';
        $output .='<div class="clearfix"></div>';
    $output .= '</div>'.$this->endBlockComment('row');
}
else {
    $output .= '<div '.$row_id.' class="reg_wdt'.$father_css_class.'">';
        $output .= '<div class="prk_inner_block '.$css_class.' '.$prk_css_classes.'" '.$style.$parallax_code.'>';
            $output .= '<div class="row">';
                $output .= wpb_js_remove_wpautop($content);
            $output .= '</div>';
            $output .='<div class="clearfix"></div>';
        $output .= '</div>'.$this->endBlockComment('row');
    $output .= '</div>';
}
$output .='<div class="clearfix"></div>';
echo $output;
