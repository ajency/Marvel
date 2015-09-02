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





function get_search_options($post_type){

    $property_unit_types = array();

    if($post_type =="residential-property"){

        $property_unit_types_meta_serialized       = maybe_unserialize(get_option('residential-property-unit-type',true));
        $property_types_meta_serialized            =   maybe_unserialize(get_option('residential-property-type',true));

        $property_unit_types_meta = maybe_unserialize($property_unit_types_meta_serialized['property_unit_types']);
        $property_types_meta = maybe_unserialize($property_types_meta_serialized['property_types']);

        if(is_array($property_types_meta)){
          foreach ($property_types_meta as $property_types_key => $property_types_value) {
                $property_types[$property_types_value['ID']] = $property_types_value['property_type'];
          }
        }


        if(is_array($property_unit_types_meta)){
          foreach ($property_unit_types_meta as $unit_type_key => $unit_type_value) {

             $current_property_type_id =  $unit_type_value['property_type_id'];
             $unit_type_value['property_type_name'] = $property_types[$current_property_type_id];
             $property_unit_types[] =       $unit_type_value ;
          }
        }





        $property_cities          = maybe_unserialize(get_option('property-city',true));
        $property_locality        = maybe_unserialize(get_option('property-locality',true));
        $property_neighbourhood   = maybe_unserialize(get_option('property-neighbourhood',true));

        $property_amenities       = get_terms( 'property_amenity', array(
                                      'orderby'    => 'count',
                                      'hide_empty' => 0,
                                   ) );

    }
    else if($post_type =="commercial-property"){

        $property_unit_type     = maybe_unserialize(get_option('commercial-property-unit-type',true));

        $property_unit_types_meta_serialized       = maybe_unserialize(get_option('commercial-property-unit-typee',true));
        $property_types_meta_serialized            =   maybe_unserialize(get_option('commercial-property-type',true));
        $property_types_meta = maybe_unserialize($property_unit_types_meta_serialized['property_types']);
        $property_unit_types_meta = maybe_unserialize($property_unit_types_meta_serialized['property_unit_types']);


        if(is_array($property_types_meta)){
          foreach ($property_types_meta as $property_types_key => $property_types_value) {
              $property_types[$property_types_value['ID']] = $property_types_value['property_type'];
          }
        }

        if(is_array($property_unit_types_meta)){
          foreach ($property_unit_types_meta as $unit_type_key => $unit_type_value) {

           $current_property_type_id =  $unit_type_value['property_type_id'];
           $unit_type_value['property_type_name'] = $property_types[$current_property_type_id];
           $property_unit_types[] =       $unit_type_value ;
          }
        }







        $property_cities        = maybe_unserialize(get_option('commercial-property-city',true));
        $property_locality      = maybe_unserialize(get_option('commercial-property-locality',true));
        $property_neighbourhood = array();
        $property_amenities     = array();
    }


    $property_status = maybe_unserialize(get_option('property-status',true));
    /* $property_bedrooms = maybe_unserialize(get_option('property-no_of_bedrooms',true)); */
    $property_citylocality = maybe_unserialize(get_option('property-citylocality',true));

    $search_option_data = array( 'cities'        => $property_cities,
                                 'status'        => $property_status,
                                 'locality'      => $property_locality,
                                 'neighbourhood' => $property_neighbourhood,
                                 /* 'no_of_bedrooms'=> $property_bedrooms, */
                                 'type'          => $property_unit_types,
                                /* 'citylocality'  => $property_citylocality, */
                                 'amenities'     => $property_amenities
                                );

   return( $search_option_data);


}


function get_search_options_ajx(){


  if(is_null($_REQUEST['post_type']) || !isset($_REQUEST['post_type']))
    $post_type = $_REQUEST['data']['post_type'];
  else
  $post_type = $_REQUEST['post_type'];


	$search_option_data =  get_search_options($post_type);

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


function get_res_property_meta_values($property_id, $post_type){
	  $property_sellablearea    = maybe_unserialize(get_post_meta($property_id, 'property-sellable_area',true));
    $property_cities          = get_post_meta($property_id, 'property-city',true);
    $property_status          = get_post_meta($property_id, 'property-status',true);
    $property_locality        = get_post_meta($property_id, 'property-locality',true);
    $property_neighbourhood   = maybe_unserialize(get_post_meta($property_id, 'property-neighbourhood',true));
    if($post_type=="residential-property"){

      $property_unit_type       = maybe_unserialize(get_post_meta($property_id, 'residential-property-unit-type',true));

    }
    else if($post_type=="commercial-property"){

      $property_unit_type       = maybe_unserialize(get_post_meta($property_id, 'commercial-property-unit-type',true));
      $property_office_spaces   = maybe_unserialize(get_post_meta($property_id, 'office-spaces',true));
      $property_retail_spaces   = maybe_unserialize(get_post_meta($property_id, 'retail-spaces',true));

    }

    $property_price                = get_post_meta($property_id, 'property-price',true);
	  $property_siteplan             = get_post_meta($property_id, 'custom_property-siteplan',true);
    $property_display_unit_type    = get_post_meta($property_id, 'property-display-unit-type',true);

    $property_unit_type_updated    = array();
    $property_unit_type_penthouses = array();
    $property_unit_type_other      = array();

    $property_meta_options = get_search_options($post_type);

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


       if($post_type=="residential-property"){
          $property_unit_type_option =  maybe_unserialize(get_option('residential-property-unit-type'));
       }
       else  if($post_type=="commercial-property"){
          $property_unit_type_option =  maybe_unserialize(get_option('commercial-property-unit-type'));
       }

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



    $property_meta_data_values = array('property_city'               => $property_cities,
                                             'property_status'            => $property_status,
                                             'property_locaity'           => $property_locality,
                                             'property_unit_type'		      => $sortedproperty_unit_types,
                                             //'property_sellablearea'      => $property_sellablearea,
                                             'map_address'	 		          => get_map_address_details($property_id),
                                             'property_price' 		        => $property_price,
                                             'property_city_name'         => $property_city_name,
                                             'property_locality_name'     => $property_locality_name,
                                             'property_siteplan'          => $property_siteplan

                                            );
  if($post_type=="commercial-property"){

    $property_meta_data_values['property_office_spaces']  = $property_office_spaces;

    $property_meta_data_values['property_retail_spaces']  = $property_retail_spaces;

  }
  else if($post_type=="residential-property"){

    $property_meta_data_values['poperty_neighbourhood']  = $property_neighbourhood;

    $property_meta_data_values['property_display_unit_type']  = $property_display_unit_type;

  }



    return $property_meta_data_values;

}






function get_residential_properties_list($post_type){
  global $wpdb;
    $sel_properties = array();
    

    if($post_type=="both"){
      $residential_properties = get_posts( array(
                                          'post_type'       => array('residential-property','commercial-property'),
                                          'post_status'     => 'publish',
                                          'posts_per_page'  => -1,
                                          'order'           => 'ASC',
                                          'orderby'         => 'menu_order'
                                      ) );
    }
    else{
      $residential_properties = get_posts( array(
                                          'post_type'       => $post_type,
                                          'post_status'     => 'publish',
                                          'posts_per_page'  => -1,
                                          'order'           => 'ASC',
                                          'orderby'         => 'menu_order'
                                      ) );
    }
    

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

  $new_res_prop->menu_order                =  ($res_property->menu_order==0?9000:$res_property->menu_order) ;
  if($res_property->post_type=="residential-property"){
    $new_res_prop->post_url                  =  site_url().'/residential-properties/'.$res_property->post_name;
  }
  else if($res_property->post_type=="commercial-property"){
    $new_res_prop->post_url                  =  site_url().'/commercial-properties/'.$res_property->post_name;
  }

  //$new_res_prop->featured_image            = wp_get_attachment_url( get_post_thumbnail_id($res_property->ID) );
  $new_res_prop->featured_image            = $property_featured_image;
  $new_res_prop->featured_image_thumbnail  = wp_get_attachment_image_src( get_post_thumbnail_id($res_property->ID), 'thumbnail'  );
  $new_res_prop->amenities                 =  $property_amenities;

  $new_res_prop->post_type                 =  $res_property->post_type ;

  $property_meta_value =  get_res_property_meta_values($res_property->ID,$res_property->post_type);
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
    if(isset($_REQUEST['post_type'])){
      $post_type = $_REQUEST['post_type'];
    }
    else{
      $post_type = $_REQUEST['data']['post_type'];  
    }
    



    $sel_properties = get_residential_properties_list($post_type);
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



  $property = array();
  if(is_single()){
    $property['id'] = get_the_id();
    $property['title'] = get_the_title();
  }

     	wp_enqueue_script( 'geolocation_gmap','https://maps.googleapis.com/maps/api/js?sensor=false' );
      wp_enqueue_script('jquery_easing', get_stylesheet_directory_uri(). '/jquery.easing.1.3.js', array('jquery'), false, true);

      wp_enqueue_script( 'imagesloaded_pkgd',  get_stylesheet_directory_uri() . '/imgfill/imagesloaded.pkgd.min.js', array('jquery'), false, true);
      wp_enqueue_script( 'jquery-imagefill',  get_stylesheet_directory_uri() . '/imgfill/jquery-imagefill.js', array('imagesloaded_pkgd'), false, true);

      //wp_enqueue_script( 'chosen',  get_stylesheet_directory_uri() . '/chosen/chosen.jquery.min.js', array('jquery'), false, true);
      wp_enqueue_script( 'readmore',  get_stylesheet_directory_uri() . '/readmore.min.js', array('jquery'), false, true);
      wp_enqueue_script( 'slider',  get_stylesheet_directory_uri() . '/slider.js', array('jquery','imagesloaded_pkgd','jquery-imagefill'), false, true);
      wp_enqueue_script( 'collapsible',  get_stylesheet_directory_uri() . '/collapsible.js', array('jquery'), false, true);
      wp_enqueue_script( 'custom-js',  get_stylesheet_directory_uri() . '/js/custom-js.js', array('jquery'), false, true);
      wp_localize_script( 'custom-js', 'property', $property );
      wp_enqueue_script( 'underscore-js',  get_stylesheet_directory_uri() . '/dev/js/lib/underscore.min.js', array('jquery'), false, true);

      // //POP UP FORMIDABLE FIX
      global $frm_settings;
       global $frm_vars;
       
       if (class_exists('FrmAppHelper')) {
        $version = FrmAppHelper::plugin_version();
        wp_register_script('formidable',plugins_url() . '/formidable/js/formidable.min.js', array('jquery'), $version, true);
        wp_enqueue_script('formidable-js', plugins_url() . '/formidable/js/formidable.min.js', array( 'jquery'), false, true);
      }
       
      



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


//require_once('modules/custom_formidable.php');



//Fix to load popup maker form on residential  & commercial Listings Page 
function popup28579_load_on_arvhices( $is_loadable, $popup_id ) {

  // If its standard arvhice for posts.
  /* if($popup_id  == 782 && is_archive()) {
    return true;
  } */
  
  // If its CPT archive for post type 'portfolio'
  if( ($popup_id == 3291 || $popup_id == 3293 ||  $popup_id == 725 || $popup_id == 847) && (is_post_type_archive( 'residential-property' )  ||  is_post_type_archive( 'commercial-property' )  )     ) {
    return true;
   
  }
  else
    return $is_loadable;
}
add_filter('popmake_popup_is_loadable', 'popup28579_load_on_arvhices', 10, 2);






function add_query_vars($aVars) {
//$aVars[] = "status";
$aVars[] = "city";
$aVars[] = "locality";
$aVars[] = "type";
return $aVars;
}
 
// hook add_query_vars function into query_vars
add_filter('query_vars', 'add_query_vars');




function properties_custom_rewrite_rules( $existing_rules ) {
  $new_rules = array(
    'residential-properties/ongoing/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?pagename=residential-properties&city=$matches[1]&locality=$matches[2]&type=$matches[3]',
    'residential-properties/completed/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?pagename=residential-properties&city=$matches[1]&locality=$matches[2]&type=$matches[3]',

    'residential-properties/ongoing/([^/]+)/([^/]+)/?$' => 'index.php?pagename=residential-properties&city=$matches[1]&locality=$matches[2]',
    'residential-properties/completed/([^/]+)/([^/]+)/?$' => 'index.php?pagename=residential-properties&city=$matches[1]&locality=$matches[2]',

    'residential-properties/ongoing/([^/]+)/?$' => 'index.php?pagename=residential-properties&city=$matches[1]',
    'residential-properties/completed/([^/]+)/?$' => 'index.php?pagename=residential-properties&city=$matches[1]',

    'residential-properties/ongoing/?$' => 'index.php?pagename=residential-properties',
    'residential-properties/completed/?$' => 'index.php?pagename=residential-properties'
  );

   $existing_rules = $new_rules + $existing_rules;
 
   return $existing_rules;
}
add_filter('rewrite_rules_array', 'properties_custom_rewrite_rules');





function get_sap_data(){
  global $post, $wpdb;

  /*if(!is_singular( array( 'residential-property', 'commercial-property' ) )){
    return;
  }*/

  $plant_id = get_post_meta($post->ID,'property-plant-id',true);
  $table_name = $wpdb->prefix.'sap_inventory';
  $property_query = " SELECT * FROM ".$table_name." WHERE plant=".$plant_id."";
  $sap_data = $wpdb->get_results($property_query,ARRAY_A);
  return $sap_data;
 }


 function get_flat_type($code){
  switch ($code) {
    case "R1":
        $type = 'Flat';
        break;
    case "R2":
        $type = 'Duplex Flat';
        break;
    case "R3":
        $type = 'Garden Flat';
        break;
    case "R4":
        $type = 'Penthouse';
        break;
    case "R5":
        $type = 'Villa';
        break;
    case "O1":
        $type = 'Non IT Office Space';
        break;
    case "O2":
        $type = 'Showroom';
        break;
    case "O3":
        $type = 'Retailspace';
        break;
    case "Co":
        $type = 'Commercial Spaces';
        break;
    default:
        $type = 'Flat';
}
return $type;
 }




function flatten($array, $index) {
     $return = array();

     if (is_array($array)) {
        foreach ($array as $row) {
             $return[] = $row[$index];
        }
     }

     return $return;
}



function sizeImage($thisImage,$pageW,$pageH,$fixedMargin,$threshold) {
   
   list($thisW,$thisH) = getimagesize($thisImage);
    
    if($thisW<=$pageW && $thisH<=$pageH){
       // DO NOT RESIZE IMAGE, JUST CENTER IT HORIZONTALLY
        $newLeftMargin = centerMe($thisW,$pageW);
        $leftMargin = $newLeftMargin;
      return array('leftMargin' => $leftMargin, 'width' => $thisW);
    } else {
        $thisThreshold = $thisW / $thisH;
      if($thisThreshold>=$threshold) {
         $width = $pageW;
         $leftMargin = $fixedMargin;
      } else {
         $thisMultiplier = $pageH / $thisH;
         $width = $thisW * $thisMultiplier;
         $width = round($width, 0, PHP_ROUND_HALF_DOWN);
         // CENTER ON PAGE IF NOT FULL WIDTH
         $newLeftMargin = centerMe($width,$pageW);
         $leftMargin = $newLeftMargin;
      }
      return array('leftMargin' => $leftMargin, 'width' => $width);
   }
}



function centerMe($thisWidth,$pageW){
   $newMargin = ($pageW - $thisWidth) / 2;
   $newMargin = round($newMargin, 0, PHP_ROUND_HALF_DOWN);
   return $newMargin;
}





 function download_floor_plan(){

  global $wpdb;

  if(!isset($_GET['action']) || $_GET['action']!='download_plan'){
    return;
  }

  if(!isset($_GET['prop_id']) || !isset($_GET['plant_id']) || !isset($_GET['m_group']) || !isset($_GET['m_type'])){
    return;
  }
  require_once('fpdf/fpdf.php');

  $upload_dir = wp_upload_dir();
  $path = $upload_dir['basedir'].'/floor-plans';
  wp_mkdir_p( $path );

  $mkt_group_desc = $_GET['m_group'];
  $mkt_material_type_desc = $_GET['m_type'];

  $table_name = $wpdb->prefix.'sap_inventory';
  $plan_query = " SELECT specific_floor_plan FROM ".$table_name." WHERE plant=".$_GET['plant_id']." AND mkt_group_desc='".$mkt_group_desc."' AND mkt_material_type_desc='".$mkt_material_type_desc."'";
  $plans = $wpdb->get_results($plan_query,ARRAY_A);

  $plans = flatten($plans, 'specific_floor_plan');
  array_unique($plans);

  $property = get_post($_GET['prop_id']);

  $title = $property->post_title;
  $plan_type = $mkt_material_type_desc.' BHK '.get_flat_type($mkt_group_desc);
  $filename = 'Floor_Plans_'.$mkt_material_type_desc.'_BHK_'.get_flat_type($mkt_group_desc).'_'.$title.'.pdf';

$pdf = new FPDF('P','pt','Letter');
$pdf->SetTitle($title,1);
$pdf->SetAuthor('Ajency',1);
$pdf->SetSubject('Floor Plans - '.$plan_type,1);
$pdf->SetCompression(1);

// LETTER size pages
// UNIT IS POINTS, 72 PTS = 1 INCH
$pageW = 612 - 36; // 8.5 inches wide with .25 margin left and right
$pageH = 792 - 36; // 11 inches tall with .25 margin top and bottom
$fixedMargin = 18; // .25 inch
$threshold = $pageW / $pageH;

foreach ($plans as $value) {
   $currentImage = $path.'/'.$value.'.jpg';
   if(file_exists($currentImage)){
   $reSized = sizeImage($currentImage,$pageW,$pageH,$fixedMargin,$threshold);
   $width = $reSized['width'];
   $leftMargin = $reSized['leftMargin'];
   $pdf->AddPage();
   $pdf->Image($currentImage,$leftMargin,18,$width);
   }
} 
 

$pdf->Output($filename,'D');
//$pdf->Output();
}

add_action('template_redirect','download_floor_plan');








function download_all_floor_plan(){

  global $wpdb;

  if(!isset($_GET['action']) || $_GET['action']!='download_all_plan'){
    return;
  }

  if(!isset($_GET['prop_id']) || !isset($_GET['plant_id'])){
    return;
  }
  require_once('fpdf/fpdf.php');

  $upload_dir = wp_upload_dir();
  $path = $upload_dir['basedir'].'/floor-plans';
  wp_mkdir_p( $path );

  $table_name = $wpdb->prefix.'sap_inventory';
  $plan_query = " SELECT specific_floor_plan FROM ".$table_name." WHERE plant=".$_GET['plant_id']."";
  $plans = $wpdb->get_results($plan_query,ARRAY_A);

  $plans = flatten($plans, 'specific_floor_plan');
  array_unique($plans);

  $property = get_post($_GET['prop_id']);

  $title = $property->post_title;
  $filename = 'Floor_Plans_'.$title.'.pdf';

$pdf = new FPDF('P','pt','Letter');
$pdf->SetTitle($title,1);
$pdf->SetAuthor('Ajency',1);
$pdf->SetSubject('Floor Plans',1);
$pdf->SetCompression(1);

// LETTER size pages
// UNIT IS POINTS, 72 PTS = 1 INCH
$pageW = 612 - 36; // 8.5 inches wide with .25 margin left and right
$pageH = 792 - 36; // 11 inches tall with .25 margin top and bottom
$fixedMargin = 18; // .25 inch
$threshold = $pageW / $pageH;

foreach ($plans as $value) {
   $currentImage = $path.'/'.$value.'.jpg';
   if(file_exists($currentImage)){
   $reSized = sizeImage($currentImage,$pageW,$pageH,$fixedMargin,$threshold);
   $width = $reSized['width'];
   $leftMargin = $reSized['leftMargin'];
   $pdf->AddPage();
   $pdf->Image($currentImage,$leftMargin,18,$width);
   }
} 
 

$pdf->Output($filename,'D');
//$pdf->Output();
}

add_action('template_redirect','download_all_floor_plan');









function download_availability_pdf(){

  global $wpdb;

  if(!isset($_GET['action']) || $_GET['action']!='download_availability'){
    return;
  }

  if(!isset($_GET['prop_id']) || !isset($_GET['plant_id']) || !isset($_GET['m_group']) || !isset($_GET['m_type'])){
    return;
  }

  $mkt_group_desc = $_GET['m_group'];
  $mkt_material_type_desc = $_GET['m_type'];

  $table_name = $wpdb->prefix.'sap_inventory';
  $plan_query = " SELECT specific_floor_plan FROM ".$table_name." WHERE plant=".$_GET['plant_id']." AND mkt_group_desc='".$mkt_group_desc."' AND mkt_material_type_desc='".$mkt_material_type_desc."'";
  $plans = $wpdb->get_results($plan_query,ARRAY_A);

  $html = '<style>'.file_get_contents(get_stylesheet_directory().'/availability/availability.css').'</style><page>';
  $html .= '<div class="full-wrap">
      <div class="header">
        <div class="project_name inbl">
          <h1>Albero</h1>
          <h4>Availability</h4>
        </div>
        <div class="legend inbl">
          <div class="set set1">
            <div class="color white"></div>
            <p class="info">WHITE = AVAILABLE</p>
          </div>
          <div class="set set2">
            <div class="color blue"></div>
            <p class="info">BLUE = SOLD</p>
          </div>
          <div class="set set3">
            <div class="color green"></div>
            <p class="info">GREEN = HOLD</p>
          </div>
          <div class="set updatedon">
            <div class="color transparent"></div>
            <p class="info">UPDATED ON <span class="updated">9th MARCH 15</span></p>
          </div>
        </div>
      </div>
      <!--Add the class "fiveorless" if no. of columns is 5 or less than 5-->
      <table class="ava_table fiveorless" cellpadding="0" cellspacing="0">
        <tr>
          <!-- here the colspan value has to equal the number of columns -->
          <th colspan="5" class="table-head">
            3 BHK
          </th>
        </tr>
        <tr>
          <th>A</th>
          <th>A</th>
          <th>B</th>
          <th>B</th>
          <th>C</th>
        </tr>
        <tr>
          <td class="colorblue">A101 (1300)</td>
          <td class="colorblue">A102 (1300)</td>
          <td class="colorblue">B101 (1300)</td>
          <td class="colorblue">B102 (1300)</td>
          <td>C101 (1300)</td>
        </tr>
        <tr>
          <td class="colorgreen">A101 (1300)</td>
          <td class="colorblue">A102 (1300)</td>
          <td class="colorgreen">B101 (1300)</td>
          <td class="colorblue">B102 (1300)</td>
          <td class="colorblue">C101 (1300)</td>
        </tr>
        <tr>
          <td class="colorblue">A101 (1300)</td>
          <td class="">A102 (1300)</td>
          <td class="colorblue">B101 (1300)</td>
          <td class="colorblue">B102 (1300)</td>
          <td class="colorblue">C101 (1300)</td>
        </tr>
        <tr>
          <td class="colorblue">A101 (1300)</td>
          <td class="colorblue">A102 (1300)</td>
          <td class="colorblue">B101 (1300)</td>
          <td class="colorblue">B102 (1300)</td>
          <td class="colorblue">C101 (1300)</td>
        </tr>
        <tr>
          <td class="colorblue">A101 (1300)</td>
          <td class="colorgreen">A102 (1300)</td>
          <td class="colorgreen">B101 (1300)</td>
          <td class="colorblue">B102 (1300)</td>
          <td>C101 (1300)</td>
        </tr>
      </table>

      <!--<img src="marvelLogo_withtag.png" alt="Marvel Logo" class="marvelogo">-->
    </div>';
  $html .= '</page>';


  require_once('html2pdf/html2pdf.class.php');

  try
    {
        $html2pdf = new HTML2PDF('P', 'A4');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($html);
        $html2pdf->Output('availability.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

}

add_action('template_redirect','download_availability_pdf');












