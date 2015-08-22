<?php


function get_material_type($unit_type){
    $units_data = maybe_unserialize(get_option( 'residential-property-unit-type' ));
    foreach($units_data['property_unit_types'] as $unit){
        if($unit['property_unit_type'] == $unit_type){
            $material_type = $unit['material_type'];
            break;
        }
    }
    return $material_type;
}


function get_property_type_id($unit_type){
    $units_data = maybe_unserialize(get_option( 'residential-property-unit-type' ));
    foreach($units_data['property_unit_types'] as $unit){
        if($unit['property_unit_type'] == $unit_type){
            $property_type_id = $unit['property_type_id'];
            break;
        }
    }
    return $property_type_id;
}


function get_material_group($unit_type){
    $units_data = maybe_unserialize(get_option( 'residential-property-type' ));
    $type_id = get_property_type_id($unit_type);
    foreach($units_data['property_types'] as $type){
        if($type['ID'] == $type_id){
            $material_group = $type['material_group'];
            break;
        }
    }
    return $material_group;
}




function floor_plans_tabs() {

  global $wp_query;
//$cur_property_id = get_the_ID();
$cur_property_id = $wp_query->get_queried_object_id();

//$property_unit_type_option = maybe_unserialize(get_option('residential-property-unit-type'));

//$property_unit_type_option_values = $property_unit_type_option['property_unit_types'];

$cur_post_type = get_post_type($cur_property_id);


$property_data = get_res_property_meta_values($cur_property_id,$cur_post_type);



$site_plan_img_url = site_url()."/wp-content/themes/samba-child/img/2d_layout_missing.jpg";
$site_plan_img_url = site_url()."/wp-content/themes/samba-child/img/2d_layout_missing.jpg";
$siteplan_pdf_url ="javascript:void(0)";

$site_plan_img_id = maybe_unserialize(get_post_meta($cur_property_id,'custom_property-siteplan',true));




 
if($site_plan_img_id !=false && is_array($site_plan_img_id )){
 
    if($site_plan_img_id['image_id']!='' && isset($site_plan_img_id['image_id'])){
 

 
 
                $siteplan_image = wp_get_attachment_image_src($site_plan_img_id['image_id'],'full');
                 
                $siteplan_image_url = $siteplan_image[0];
                $siteplan_image_filename =basename( get_attached_file( $site_plan_img_id['image_id'] ) );

    }
    else{
        $siteplan_image_url = $site_plan_img_url ;
        
    }
                 
      if($site_plan_img_id['pdf_id']!='' && isset($site_plan_img_id['pdf_id'])){
 
        $parsed_siteplan_pdf_file = parse_url( wp_get_attachment_url( $site_plan_img_id['pdf_id'] ) );
        $siteplan_pdf_url    = dirname( $parsed_siteplan_pdf_file [ 'path' ] ) . '/' . rawurlencode( basename( $parsed_siteplan_pdf_file[ 'path' ] ) );
        $siteplan_pdf_filename =basename( get_attached_file( $site_plan_img_id['pdf_id'] ) );
    }
    else{
        
        $siteplan_pdf_url ="javascript:void(0)";
    }
    
}

 




$property_unit_types = $property_data['property_unit_type'];

$property_sellable_area = $property_data['property_sellablearea'];

$display_area='';

$plant_id = get_post_meta($cur_property_id, 'property-plant-id', true);

/* commented on 21june2015 if(isset($property_sellable_area['min-area'])) {
    if(!empty($property_sellable_area['min-area'])){
        $display_area = "  &#8211;  ".$property_sellable_area['min-area']." sq. ft" ;
    }
}

if(isset($property_sellable_area['max-area'])) {
    if(!empty($property_sellable_area['max-area'])){
        $display_area.= " to ".$property_sellable_area['max-area']." sq. ft" ;
    }
} */



if($property_unit_types==false)
    $property_unit_types =  array( );

if($site_plan_img_id!=false){
    $site_plan_img_data =  wp_get_attachment_image_src( $site_plan_img_id,'full' );
    $site_plan_img_url = $site_plan_img_data[0];
}







$floor_plans_tab_content='

<!--tabs-->


                    <!-- <div class="vc_custom_heading wpb_content_element m_t_b_m">
                        <h4 style="text-align: center;font-family:Montserrat;font-weight:400;font-style:normal">Residences</h4>
                    </div> -->

                    <div class="wpb_tabs wpb_content_element floorplans_tab" data-interval="0">
                        <div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">
                            <ul class="wpb_tabs_nav ui-tabs-nav vc_clearfix">
                                <li><a href="#tab-siteplan" class="standout">SITE PLAN</a></li>
                                <!-- <li><a href="#tab-3bhk">4.5 BHK</a></li>-->';



foreach ($property_unit_types as $key_proptype => $value_proptype) {

      /* $option_value_name = '';

      foreach ($property_unit_type_option_values as $key_type_options => $value_type_options) {

         if($value_type_options['ID'] == $value_proptype['type']){

              $option_value_name = $value_type_options['property_unit_type'];
         }
      
      } */

      $option_value_name = $value_proptype['type_name'];

    //print_r($value_proptype);


  $floor_plans_tab_content.='<li><a href="#tab-'.str_replace(" ", "_", $value_proptype['type']).'">'.$option_value_name.'</a></li>';
}

 $floor_plans_tab_content.='<!-- <li><a href="#tab-3_5bhk">3.5 BHK</a></li> -->
                            </ul>

                            <div id="tab-siteplan" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Site Plan of '.get_the_title($cur_property_id);
 $floor_plans_tab_content.='

                                            <a class="wpb_button_a download_prj" title="Download" href="'.$siteplan_pdf_url.'" download>
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <a class="image-popup-no-margins boxed_shadow" href="'.$siteplan_image_url.'" target="_self">
                                            <img width="700" height="561" src="'.$siteplan_image_url.'" class=" vc_box_border_grey attachment-full" alt="layout" />
                                        </a>
                                    </div>
                                </div>

                            </div>';





foreach ($property_unit_types as $key_proptype => $value_proptype) {

            $cur_prop_type_img_id = $value_proptype['layout_image_data']['ID'];
            $cur_prop_type_img_url = site_url()."/wp-content/themes/samba-child/img/2d_layout_missing.jpg";


            if(isset($cur_prop_type_img_id) && ($cur_prop_type_img_id!=false)){


                $cur_prop_type_img = wp_get_attachment_image_src( $cur_prop_type_img_id,'full' );

                $cur_prop_type_img_url = $value_proptype['layout_image_data']['url'];

            }


            if(isset($value_proptype['layout_pdf_data']['ID'])){
              $pdfurl = wp_get_attachment_url($value_proptype['layout_pdf_data']['ID']);
            }
            else{
              $pdfurl = "javascript:void(0)";
            }


            if(isset($value_proptype['min_area'])) {
                if(!empty($value_proptype['min_area'])){
                    $display_area = "  &#8211;  ".$value_proptype['min_area']." SQ FT." ;
                }
            }


            if(isset($value_proptype['max_area'])) {
                if(!empty($value_proptype['max_area'])){
                    $display_area.= " to ".$value_proptype['max_area']." SQ FT." ;
                }
            } 









 $floor_plans_tab_content.='<div id="tab-'.str_replace(" ", "_", $value_proptype['type']).'" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a '.$value_proptype['type_name'].' '.$display_area.'
                                            <a class="wpb_button_a download_prj" title="Download" href="'.$pdfurl.'" download>
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p>
                                        Plant ID: '.$plant_id.'
                                        </p>
                                        <p>
                                        Material Type: '.get_material_type($value_proptype['type_name']).'
                                        </p>
                                        <p>
                                        Material Group: '.get_material_group($value_proptype['type_name']).'
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a ava_tog curr" title="2D Layout" href="#lay_1_'.str_replace(" ", "_", $value_proptype['type']).'"><span class="wpb_button  wpb_btn-inverse tog white">2D Layout</span></a>
                                           <!-- <a class="wpb_button_a ava_tog" title="Availability" href="javascript:void(0)"><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>-->
                                             <a class="wpb_button_a ava_tog" title="Availability" href="#ava_1_'.str_replace(" ", "_", $value_proptype["type"]).'"><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="lay_1_'.str_replace(" ", "_", $value_proptype['type']).'" class="inner-panels wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center current">
                                    <div class="wpb_wrapper">
                                        <a class="image-popup-no-margins boxed_shadow" href="'.$cur_prop_type_img_url.'" target="_self">
                                            <img width="700" height="561" src="'.$cur_prop_type_img_url.'" alt="layout" />
                                        </a>
                                    </div>
                                </div>
                                <div id="ava_1_'.str_replace(" ", "_", $value_proptype['type']).'" class="inner-panels avatab wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <!-- <p>Availability content goes here</p> -->
                                        <div class="top_head">
                                            <div class="pull-left">
                                                <span class="box white_bg"></span>
                                                <span class="text">Available</span>
                                                <span class="box blue_bg"></span>
                                                <span class="text">Sold</span>
                                            </div>
                                            <div class="pull-right">
                                                <h6>Click on the available flat to request a hold.</h6>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="tabular_c">
                                            <div class="left">
                                                <i class="fa fa-chevron-left"></i>
                                            </div>
                                            <div class="right active">
                                                <i class="fa fa-chevron-right"></i>
                                            </div>
                                            <div class="tabul_hold">
                                                <div class="tabular tabul_main">
                                                    <div class="tab_row head">
                                                        <div class="tab_col">A-Flat No. (Sq.Ft.)</div>
                                                        <div class="tab_col">B-Flat No. (Sq.Ft.)</div>
                                                        <div class="tab_col">C-Flat No. (Sq.Ft.)</div>
                                                    </div>
                                                    <div class="tab_row">
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col">
                                                                        <span class="text_in">A 1001 (5,500)</span>
                                                                        <div class="popup_tab_data">
                                                                            <div class="pull-left left_d">Flat Area</div>
                                                                            <div class="pull-left right_d">3,950</div>
                                                                            <div class="clearfix"></div>
                                                                            <div class="pull-left left_d">Terrace Area</div>
                                                                            <div class="pull-left right_d">350</div>
                                                                            <div class="clearfix"></div>
                                                                            <div class="pull-left left_d">Total Sellable Area</div>
                                                                            <div class="pull-left right_d">4,300</div>
                                                                            <div class="clearfix"></div>
                                                                            <div class="btncol">
                                                                                <a class="wpb_button_a image-popup-no-margins" title="2D Layout" href="http://marvel.ajency.in/wp-content/uploads/2015/05/Aries-4.5BHK-4045-SQ.FT_.1.jpg"><span class="wpb_button left_b wpb_btn-inverse wpb_btn-small">View Plan</span></a>
                                                                                <a class="wpb_button_a" title="Availability" href="#"><span class="wpb_button  wpb_btn-inverse" style="  padding: 7px 13px;">Request Hold</span></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_row">
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_row">
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_row">
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_row">
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab_row">
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab_col">
                                                            <div class="tabular inner">
                                                                <div class="tab_row">
                                                                    <div class="tab_col"><span class="text_in">A 1001 (5,500)</span></div>
                                                                    <div class="tab_col blue_bg"><span class="text_in">A 1002 (5,500)</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="btm_foot">
                                            <p>
                                                Check availability in other unit types.
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse">4 BHK</span>
                                                </a>
                                                <a href="#" class="wpb_button_a">
                                                    <span class="wpb_button  wpb_btn-inverse">4.5 BHK</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }








 $floor_plans_tab_content.='
                         </div>
                    </div>

            <!--/tabs end-->
            ';


    return $floor_plans_tab_content;
}
add_shortcode('floor_plans_tabs', 'floor_plans_tabs');
