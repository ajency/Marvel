<?php

require_once('floor-plans-tab.php');
require_once('modules/shortcode/services.php');

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



function get_main_property_type_by_unit_type_id($unit_type_id){
  //echo '\n unit_type_id'.$unit_type_id;
        global $wpdb;
        $property_type_details = array();

        $property_type_option =  maybe_unserialize(get_option('residential-property-type'));
        $property_type_option_value = maybe_unserialize($property_type_option['property_types']);
 
  //var_dump($property_type_option_value);
        foreach ($property_type_option_value as $key => $value) {


          if((int)$value['ID'] ==(int)$unit_type_id){

          
            $property_type_details = array('property_type_name'         => $value['property_type'],
                                           'property_type_id'           => $value['ID'],
                                           'property_type_materialgroup'=> $value['material_group'],
                                           );
          }
        }

        return $property_type_details;

}

function get_res_property_meta_values($property_id){
	  $property_sellablearea    = maybe_unserialize(get_post_meta($property_id, 'property-sellable_area',true));
    $property_cities          = get_post_meta($property_id, 'property-city',true);
    $property_status          = get_post_meta($property_id, 'property-status',true);
    $property_locality        = get_post_meta($property_id, 'property-locality',true);
    $property_neighbourhood   = maybe_unserialize(get_post_meta($property_id, 'property-neighbourhood',true));
    $property_unit_type       = maybe_unserialize(get_post_meta($property_id, 'residential-property-unit-type',true));
    $property_price           = get_post_meta($property_id, 'property-price',true);

    $property_unit_type_updated    = array();
    $property_unit_type_penthouses = array();
    $property_unit_type_other      = array();    

    $property_meta_options = get_search_options();

    $property_city_name = '';
    if(isset($property_meta_options['cities']['cities'])){
      foreach ($property_meta_options['cities']['cities'] as $option_city ) {
        if($option_city['ID'] ==$property_cities){
          $property_city_name = $option_city['name'];
        }
      }
  }


     $property_locality_name = '';
     if(isset($property_meta_options['locality']['localities'])){

      foreach ($property_meta_options['locality']['localities'] as $option_locality ) {
      if($option_locality['ID'] == $property_locality){
        $property_locality_name = $option_locality['name'];
      }
      }
     }
    


    if(is_array($property_unit_type)){

       $property_unit_type_option =  maybe_unserialize(get_option('residential-property-unit-type'));
       $property_unit_type_option_values = maybe_unserialize($property_unit_type_option['property_unit_types']);

       //var_dump($property_unit_type_option_values);  

       


       foreach ($property_unit_type as $key => $value) {

              $main_property_type = array();

              foreach ($property_unit_type_option_values as $key_typeoption => $value_typeoption) {
                  if($value['type'] ==$value_typeoption['ID'] ){


                    $value['type_name'] = $value_typeoption['property_unit_type'] ;
                    $value['no_bedrooms'] = $value_typeoption['number_bedrooms'] ;

                    $main_property_type = get_main_property_type_by_unit_type_id($value_typeoption['property_type_id']);
 

                   $value = array_merge($value,$main_property_type);
                   $value['property_unit_type_display'] = $value['type_name']." ".$main_property_type['property_type_name'];

                   /* echo "\n\n\n FETCHD TYPE ";
                   var_dump($main_property_type);
                   echo "\n\n\nMERGED ";

                   var_dump($value); */


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
                                             'property_unit_type'		 => $sortedproperty_unit_types,
                                             'property_sellablearea' => $property_sellablearea,
                                             'map_address'	 		     => get_map_address_details($property_id),
                                             'property_price' 		   => $property_price,
                                             'property_city_name'    => $property_city_name,
                                             'property_locality_name'=> $property_locality_name
                                            );

    return $residential_property_meta_data;

}






function get_residential_properties_list(){
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

  $new_res_prop->id                        =  $res_property->ID ;
  $new_res_prop->post_date                 =  $res_property->post_date ;
  $new_res_prop->post_excerpt              =  $res_property->post_excerpt ;
  $new_res_prop->post_parent               =  $res_property->post_parent ;
  $new_res_prop->post_title                =  $res_property->post_title ;
  $new_res_prop->guid                      =  $res_property->guid ;
  $new_res_prop->post_author               =  $res_property->post_author ;
  $new_res_prop->post_url                  =  site_url().'/ResidentialProperties/'.$res_property->post_name;
  //$new_res_prop->featured_image            = wp_get_attachment_url( get_post_thumbnail_id($res_property->ID) );
  $new_res_prop->featured_image            = $property_featured_image;
  $new_res_prop->featured_image_thumbnail  = wp_get_attachment_image_src( get_post_thumbnail_id($res_property->ID), 'thumbnail'  );
  $new_res_prop->amenities                 =  $property_amenities;

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
    
      
        return $sel_properties;
    
}




function get_residential_properties_list_ajx() {

    /* global $wpdb;
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
        $sel_properties[] =  (object)array_merge((array)$res_property,$property_meta_value) ;* /


    }



   /*  foreach ( $rooms_list as $room ) {

        $room = new RoomModel( $room );

        $room_data [ ] = $room->get_all_roomdata();
    }*/



    $sel_properties = get_residential_properties_list();
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
      wp_enqueue_script('jquery_easing', get_stylesheet_directory_uri(). '/jquery.easing.1.3.js', array('jquery'), false, true);
      
      wp_enqueue_script( 'imagesloaded_pkgd',  get_stylesheet_directory_uri() . '/imgfill/imagesloaded.pkgd.min.js', array('jquery'), false, true);
      wp_enqueue_script( 'jquery-imagefill',  get_stylesheet_directory_uri() . '/imgfill/jquery-imagefill.js', array('imagesloaded_pkgd'), false, true);


      wp_enqueue_script( 'slider',  get_stylesheet_directory_uri() . '/slider.js', array('jquery','imagesloaded_pkgd','jquery-imagefill'), false, true);
      wp_enqueue_script( 'collapsible',  get_stylesheet_directory_uri() . '/collapsible.js', array('jquery'), false, true);
      wp_enqueue_script( 'custom-js',  get_stylesheet_directory_uri() . '/js/custom-js.js', array('jquery'), false, true);
      wp_enqueue_script( 'underscore-js',  get_stylesheet_directory_uri() . '/dev/js/lib/underscore.min.js', array('jquery'), false, true);

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


  














function sort_multidimensional_array($myArray,$sort_key){

 
   usort($myArray, function($a, $b)  {
 
    //echo '\n <br/> Compare '.$a[$sort_key].' with '. $b[$sort_key];
    

    //return (float)$a['no_bedrooms'] - (float)$b['no_bedrooms'];
    if((float)$a['no_bedrooms'] > (float)$b['no_bedrooms'] )
      $return_val =  1;
    else if((float)$a['no_bedrooms'] < (float)$b['no_bedrooms'] )
      $return_val = -1;
    else if((float)$a['no_bedrooms'] === (float)$b['no_bedrooms'] )
      $return_val = 0;

    return $return_val;

});
  return $myArray;


}


require_once('modules/custom_formidable.php');







