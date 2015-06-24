<?php




function get_map_address_details($property_id){

	global $wpdb;
	$qry_map_address_details = "SELECT address, city, region, postcode, country, lat, lng  FROM {$wpdb->prefix}addresses WHERE addressable_id = ".$property_id;
	//echo $qry_map_address_details;
	$res_map_address_details = $wpdb->get_results($qry_map_address_details,ARRAY_A);

	return $res_map_address_details;

}





function get_search_options(){

    $property_unit_type = maybe_unserialize(get_option('residential-property-unit-type',true));
    $property_cities = maybe_unserialize(get_option('property-city',true));
    $property_status = maybe_unserialize(get_option('property-status',true));
    $property_locality = maybe_unserialize(get_option('property-locality',true));
    $property_neighbourhood = maybe_unserialize(get_option('property-neighbourhood',true));
    $property_bedrooms = maybe_unserialize(get_option('property-no_of_bedrooms',true));
    $property_citylocality = maybe_unserialize(get_option('property-citylocality',true));

    $property_amenities = get_terms( 'property_amenity', array(
    'orderby'    => 'count',
    'hide_empty' => 0,
 ) );

    $search_option_data = array( 'cities'        => $property_cities,
                                 'status'        => $property_status,
                                 'locality'      => $property_locality,
                                 'neighbourhood' => $property_neighbourhood,
                                 'no_of_bedrooms'=> $property_bedrooms,
                                 'type'          => maybe_unserialize($property_unit_type['property_unit_types']),
                                 'citylocality'  => $property_citylocality,
                                 'amenities'     => $property_amenities
                                );

   return( $search_option_data);


}


function get_search_options_ajx(){


	$search_option_data =  get_search_options();

	wp_send_json( $search_option_data);


}
add_action( 'wp_ajax_get_search_options', 'get_search_options_ajx' );
add_action( 'wp_ajax_nopriv_get_search_options', 'get_search_options_ajx' );


function get_res_property_meta_values($property_id){
	  $property_sellablearea    = maybe_unserialize(get_post_meta($property_id, 'property-sellable_area',true));
    $property_cities          = get_post_meta($property_id, 'property-city',true);
    $property_status          = get_post_meta($property_id, 'property-status',true);
    $property_locality        = get_post_meta($property_id, 'property-locality',true);
    $property_neighbourhood   = maybe_unserialize(get_post_meta($property_id, 'property-neighbourhood',true));
    $property_unit_type            = maybe_unserialize(get_post_meta($property_id, 'residential-property-unit-type',true));
    $property_price           = get_post_meta($property_id, 'property-price',true);

    $property_unit_type_updated    = array();
    $property_unit_type_penthouses = array();
    $property_unit_type_other      = array();    


    if(is_array($property_unit_type)){

       $property_unit_type_option =  maybe_unserialize(get_option('residential-property-unit-type'));
       $property_unit_type_option_values = maybe_unserialize($property_unit_type_option['property_unit_types']);

       //var_dump($property_unit_type_option_values);  

       foreach ($property_unit_type as $key => $value) {

              foreach ($property_unit_type_option_values as $key_typeoption => $value_typeoption) {
                  if($value['type'] ==$value_typeoption['ID'] ){


                    $value['type_name'] = $value_typeoption['property_unit_type'] ;
                    $value['no_bedrooms'] = $value_typeoption['number_bedrooms'] ;
                  }

              }

              if($value['layout_image']!=''){

                $layout_image = wp_get_attachment_image_src($value['layout_image'],'full');
                $layout_image_url = $layout_image[0];
                $layout_image_filename =basename( get_attached_file( $value['layout_image'] ) );

                $value['layout_image_data'] = array('ID'  => $value['layout_image'], 
                                                    'url' => $layout_image_url, 
                                                    'name'=> $layout_image_filename);

              }

              if($value['layout_pdf']!=''){

                $parsed_pdf_file = parse_url( wp_get_attachment_url( $value['layout_pdf'] ) );
                $layout_pdf_url    = dirname( $parsed_pdf_file [ 'path' ] ) . '/' . rawurlencode( basename( $parsed_pdf_file[ 'path' ] ) );
                $layout_pdf_filename =basename( get_attached_file( $value['layout_pdf'] ) );

                $value['layout_pdf_data'] = array('ID'  => $value['layout_pdf'], 
                                                  'url' => $layout_pdf_url, 
                                                  'name'=> $layout_pdf_filename);
              }

              $property_unit_type_updated[] = $value; 
              /* if(stripos($value['type_name'], 'penthouse')!==false || stripos($value['type_name'], 'pent house')!==false ){
                 $property_unit_type_penthouses[] = $value;
              }
              else{
                $property_unit_type_other[] = $value;
              }*/  
            
       }

    }

    $sortedproperty_unit_types = sort_multidimensional_array($property_unit_type_updated,'no_bedrooms');
    


    $residential_property_meta_data = array('property_city'          => $property_cities,
                                             'property_status'       => $property_status,
                                             'property_locaity'      => $property_locality,
                                             'poperty_neighbourhood' => $property_neighbourhood,
                                             'property_unit_type'		     => $sortedproperty_unit_types,
                                             'property_sellablearea' => $property_sellablearea,
                                             'map_address'	 		     => get_map_address_details($property_id),
                                             'property_price' 		   => $property_price
                                            );

    return $residential_property_meta_data;

}








function get_residential_properties_list_ajx() {

    global $wpdb;
    $sel_properties = array();
    $residential_properties = get_posts( array(
        'post_type' => 'residential-property',
        'post_status' => 'publish',
        'posts_per_page' => -1
    ) );

	$new_res_prop = new stdClass();
    foreach (  $residential_properties as $res_property ) {


    $property_amenities = wp_get_post_terms($res_property->ID , 'property_amenity', array("fields" => "all"));

    $image_id = get_post_thumbnail_id($res_property->ID);
    $image_url = wp_get_attachment_image_src($image_id,'medium', true);
    $property_featured_image = $image_url[0];

	$new_res_prop->id                        = 	$res_property->ID ;
	$new_res_prop->post_date                 = 	$res_property->post_date ;
	$new_res_prop->post_excerpt              = 	$res_property->post_excerpt ;
	$new_res_prop->post_parent               = 	$res_property->post_parent ;
	$new_res_prop->post_title                = 	$res_property->post_title ;
	$new_res_prop->guid                      = 	$res_property->guid ;
	$new_res_prop->post_author               = 	$res_property->post_author ;
	$new_res_prop->post_url                  = 	site_url().'/ResidentialProperties/'.$res_property->post_name;
	//$new_res_prop->featured_image            = wp_get_attachment_url( get_post_thumbnail_id($res_property->ID) );
  $new_res_prop->featured_image            = $property_featured_image;
	$new_res_prop->featured_image_thumbnail  = wp_get_attachment_image_src( get_post_thumbnail_id($res_property->ID), 'thumbnail'  );
	$new_res_prop->amenities                 = 	$property_amenities;

	$property_meta_value =  get_res_property_meta_values($res_property->ID);
 	$sel_properties[] =  (object)array_merge((array)$new_res_prop,$property_meta_value) ;

		/*$res_property->id = $res_property->ID;
		$res_property->featured_image = wp_get_attachment_url( get_post_thumbnail_id($res_property->ID) );
        $property_meta_value =  get_res_property_meta_values($res_property->ID);
        unset($res_property->ID);
        $sel_properties[] =  (object)array_merge((array)$res_property,$property_meta_value) ;*/


    }



   /*  foreach ( $rooms_list as $room ) {

        $room = new RoomModel( $room );

        $room_data [ ] = $room->get_all_roomdata();
    }*/
    wp_send_json( array(
        'code' => 'OK',
        'data' => $sel_properties
    ) );
}

add_action( 'wp_ajax_get_residential_properties_list_ajx', 'get_residential_properties_list_ajx' );
add_action( 'wp_ajax_nopriv_get_residential_properties_list_ajx', 'get_residential_properties_list_ajx' );





/**
 * [get_parent_template_directory_uri description]
 * @return [type]
 */
function get_parent_template_directory_uri()
{
    return site_url('wp-content/themes/samba');
}





function marvel_scripts_styles(){

    // if(is_page_template()== 'project_list_new.php'){

     	wp_enqueue_script( 'geolocation_gmap','https://maps.googleapis.com/maps/api/js?sensor=false' );

/*
        wp_enqueue_script('backbone', get_template_directory_uri() . '/dev/js/lib/backbone.js', array('jquery'), false, true);
        wp_enqueue_script('backbonebabysitter', get_template_directory_uri() . '/dev/js/lib/backbone.babysitter.js', array('jquery'), false, true);
        wp_enqueue_script('backbonewreqr', get_template_directory_uri() . '/dev/js/lib/backbone.wreqr.js', array('jquery'), false, true);
        wp_enqueue_script('underscore', get_template_directory_uri() . '/dev/js/lib/underscore.min', array('jquery'), false, true);
        wp_enqueue_script('marionette', get_template_directory_uri() . '/dev/js/lib/backbone.marionette.js', array('backbone'), false, true);
        wp_enqueue_script('project-list-app', get_template_directory_uri() . '/dev/js/projectlist_app.js', array('marionette'), false, true);




        wp_enqueue_script('residential_property_list_router', get_template_directory_uri() . '/dev/js/routers/PropertyListRouter.js', array('project-list-app'), false, true);
        wp_enqueue_script('residential_property_model', get_template_directory_uri() . '/dev/js/models/residential-property.js', array('project-list-app'), false, true);
        wp_enqueue_script('residential_property_collection', get_template_directory_uri() . '/dev/js/collections/residential-properties.js', array('project-list-app'), false, true);
        wp_enqueue_script('projectlistmainview', get_template_directory_uri() . '/dev/js/views/ProjectListMainView.js',array('marionette'),false,true);
        wp_enqueue_script('search_option_view', get_template_directory_uri() . '/dev/js/views/projectlistSearch_optionView.js',array('marionette'),false,true);

*/


   // }

}
add_action('wp_enqueue_scripts', 'marvel_scripts_styles');


  


function floor_plans_tabs() {

  global $wp_query;
//$cur_property_id = get_the_ID();
$cur_property_id = $wp_query->get_queried_object_id();

//$property_unit_type_option = maybe_unserialize(get_option('residential-property-unit-type'));

//$property_unit_type_option_values = $property_unit_type_option['property_unit_types'];



$property_data = get_res_property_meta_values($cur_property_id);



$site_plan_img_url = site_url()."/wp-content/themes/samba-child/img/2d_layout_missing.jpg";

$site_plan_img_id = maybe_unserialize(get_post_meta($cur_property_id,'custom_property-siteplan',true));

$property_unit_types = $property_data['property_unit_type'];

$property_sellable_area = $property_data['property_sellablearea'];

$display_area='';

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

                                            <a class="wpb_button_a download_prj" title="Download" href="'.$site_plan_img_url.'" download>
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <a class="image-popup-no-margins boxed_shadow" href="'.$site_plan_img_url.'" target="_self">
                                            <img width="700" height="561" src="'.$site_plan_img_url.'" class=" vc_box_border_grey attachment-full" alt="layout" />
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









 $floor_plans_tab_content.='<div id="tab-'.str_replace(" ", "_", $value_proptype['type']).'" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a '.$option_value_name.$display_area.'
                                            <a class="wpb_button_a download_prj" title="Download" href="'.$pdfurl.'" download>
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a ava_tog curr" title="2D Layout" href="#lay_1_'.str_replace(" ", "_", $value_proptype['type']).'"><span class="wpb_button  wpb_btn-inverse tog white">2D Layout</span></a>
                                            <a class="wpb_button_a ava_tog" title="Availability" href="javascript:void(0)"><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>
                                            <!-- <a class="wpb_button_a ava_tog" title="Availability" href="#ava_1_".str_replace(" ", "_", $value_proptype["type"])."><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>-->
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












function sort_multidimensional_array($myArray,$sort_key){

 
   usort($myArray, function($a, $b) use ($sort_key) {
 
    //echo '\n <br/> Compare '.$a[$sort_key].' with '. $b[$sort_key];
    

    return (float)$a['no_bedrooms'] - (float)$b['no_bedrooms'];
});
  return $myArray;


}
