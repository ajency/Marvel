<?php
/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */
 
        $color = $icon = $size = $target = $href = $title = $call_text = $call_desc= $position = $el_class = $text_align='';
        extract(shortcode_atts(array(
            'color' => 'wpb_button',
            'icon' => 'none',
            'size' => '',
            'target' => '',
            'href' => '',
            'title' => __('Text on the button', "js_composer"),
            'call_text' => '',
            'call_desc' => '',
            'text_align' => '',
            'button_align' => '',
            'position' => 'cta_align_right',
            'el_class' => '',
            'bk_color' => ''
        ), $atts));
        $output = '';

        $el_class = $this->getExtraClass($el_class);

        if ( $target == 'same' || $target == '_self' ) { $target = ''; }
        if ( $target != '' ) { $target = ' target="'.$target.'"'; }

        $icon = ( $icon != '' && $icon != 'none' ) ? ' '.$icon : '';
        $i_icon = ( $icon != '' ) ? ' <i class="icon"> </i>' : '';
        
        if ($color!="theme_button" && $color!="theme_button_inverted")
            $color = ( $color != '' ) ? ' wpb_'.$color : '';
        else {
            $sizar=" ".$size;
        }


        $size = ( $size != '' && $size != 'wpb_regularsize' ) ? ' wpb_'.$size : ' '.$size;

        $a_class = '';
        if ( $el_class != '' ) {
            $tmp_class = explode(" ", $el_class);
        }
        
        if ( $href != '' ) {
            if ($color!="theme_button" && $color!="theme_button_inverted") 
            {
                $button = '<span class="wpb_button '.$color.$size.$icon.'">'.$title.$i_icon.'</span>';
                if ( $position == 'cta_align_bottom' ) 
                {
                    $button = '<div class="twelve columns '.$button_align.'"><a class="wpb_button_a'.$a_class.'" href="'.$href.'"'.$target.'>' . $button . '</a></div>';
                    $prk_cols="twelve columns ";
                }
                else 
                {
                    $button = '<div class="four columns '.$button_align.'"><a class="wpb_button_a'.$a_class.'" href="'.$href.'"'.$target.'>' . $button . '</a></div>';
                    $prk_cols="eight columns ";
                }
            }
            else
            {
                if ( $position == 'cta_align_bottom' ) 
                {
                    $button = '<div class="twelve columns '.$button_align.'"><div class="'.$color.$sizar.'"><a href="'.$href.'"'.$target.'>' . $title . '</a></div></div>';
                    $prk_cols="twelve columns ";
                }
                else 
                {
                    $button = '<div class="four columns '.$button_align.'"><div class="'.$color.$sizar.'"><a href="'.$href.'"'.$target.'>' . $title . '</a></div></div>';
                    $prk_cols="eight columns ";
                }
            }
            
        } else {
            //$button = '<button class="wpb_button '.$color.$size.$icon.'">'.$title.$i_icon.'</button>';
            $button = '';
            $el_class .= ' cta_no_button';
            $prk_cols="twelve columns ";
        }
        $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_call_to_action wpb_content_element clearfix '.$position.$el_class, $this->settings['base']);

        $custom_style='';
        if ($bk_color!="")
        {
            $custom_style=' style="background-color:'.$bk_color.';"';
        }

        $output .= '<div class="'.$css_class.'"'.$custom_style.'>';
        $output .= '<div class="row">';
        if ( $position == 'cta_align_left' )
        { 
        	$output .= $button;
        }
        $output.='<div class="'.$prk_cols.''.$text_align.'">';
        $output .= apply_filters('wpb_cta_text', '<div class="wpb_call_text zero_color bd_headings_text_shadow twelve"><h3 class="header_font small">'. $call_text . '</h3></div><div class="clearfix"></div>', array('content'=>$call_text));
        $output .= '<div class="wpb_call_desc">'. $call_desc . '</div>';
        $output.='</div>';
        if ( $position != 'cta_align_left' )
        {
        	$output .= $button;
        }
        $output.='</div>';
        $output .= '</div> ' . $this->endBlockComment('.wpb_call_to_action') . "\n";

        echo $output;
