<?php

require_once('floor-plans-tab.php');
require_once('modules/shortcode/services.php');
require_once('modules/shortcode/general.php');
function get_map_address_details($property_id){

	global $wpdb;
	$qry_map_address_details = "SELECT address, city, region, postcode, country, lat, lng  FROM {$wpdb->prefix}addresses WHERE addressable_id = ".$property_id;
	//echo $qry_map_address_details;
	$res_map_address_details = $wpdb->get_results($qry_map_address_details,ARRAY_A);

	return $res_map_address_details;

}



function get_property_unit_types_options_data($post_type){
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
      }
      return $property_unit_types;
}




function get_search_options($post_type){

    $property_unit_types = array();

    if($post_type =="residential-property"){

        /* commented on 9sep2015$property_unit_types_meta_serialized       = maybe_unserialize(get_option('residential-property-unit-type',true));
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
        */

        $property_unit_types = get_property_unit_types_options_data($post_type);


        $property_cities          = maybe_unserialize(get_option('property-city',true));
        $property_locality        = maybe_unserialize(get_option('property-locality',true));
        $property_neighbourhood   = maybe_unserialize(get_option('property-neighbourhood',true));

        $property_amenities       = get_terms( 'property_amenity', array(
                                      'orderby'    => 'count',
                                      'hide_empty' => 0,
                                   ) );

    }
    else if($post_type =="commercial-property"){

        /* commented on 9sep2015 $property_unit_type     = maybe_unserialize(get_option('commercial-property-unit-type',true));

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
        */

        $property_unit_types = get_property_unit_types_options_data($post_type);




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
                   if($post_type=="residential-property"){
                      $value['property_unit_type_display'] = $value['type_name']." ".$main_property_type['property_type_name'];
                    }
                    else if($post_type=="commercial-property"){ 
                     $value['property_unit_type_display'] = $value['type_name']; 
                    }

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






function get_residential_properties_list($post_type,$propertylist_args=array()){

    global $wpdb;
    $sel_properties = array();
    $propmeta_query = array();


    /* 'meta_query' => array(
         array(
             'key' => '_wp_page_template',
             'value' => array('page-frontpage.php', 'page-frontpage2.php'),
             'compare' => 'IN',
         )
    ), */
    

    if($post_type=="both"){
      $residential_properties = get_posts( array(
                                          'post_type'       => array('residential-property','commercial-property'),
                                          'post_status'     => 'publish',
                                          'posts_per_page'  => -1,
                                          'order'           => 'ASC',
                                          'orderby'         => 'menu_order',
                                          'meta_query'      => $propmeta_query
                                      ) );
    }
    else{



       $properties_optionsmeta = get_search_options($post_type) ; 


       /*
          $propmeta_query[] = array(
           'key' => 'property-city',
           'value' => array('page-frontpage.php', 'page-frontpage2.php'),
           'compare' => 'IN',
          )

       */


        if(isset($propertylist_args['status'])){ 

                    $propmeta_query[] = array(
                     'key' => 'property-status',
                     'value' => $propertylist_args['status'],
                     'compare' => '=',
                    );
        } 

         


        if(isset($propertylist_args['city'])){

            if($propertylist_args['city']!='all'){

               $current_cities = $properties_optionsmeta['cities']['cities'] ;

               foreach ($current_cities as $citieskey => $citiesvalue) {

                $current_city_name = format_filter_text($citiesvalue['name']);

                  if($current_city_name == strtolower($propertylist_args['city']) )
                    $current_city_id = $citiesvalue['ID'] ;                   

                  }  

                  $propmeta_query[] = array(
                  'key' => 'property-city',
                  'value' => $current_city_id,
                  'compare' => '=' 
                  ) ;
            }
        } 



        if(isset($propertylist_args['locality'])){

          if($propertylist_args['locality']!="all"){

            $current_localities = $properties_optionsmeta['locality']['localities'] ;
            foreach ($current_localities as $localitykey => $localityvalue) {

              $current_locality_name = format_filter_text($localityvalue['name']);

              if($current_locality_name == strtolower(($propertylist_args['locality']) ) )
                $current_locality_id = $localityvalue['ID'] ;                   

            }  

            $propmeta_query[] = array(
             'key' => 'property-locality',
             'value' => $current_locality_id,
             'compare' => '=',
            ) ;

          }
            
        } 

 

 //var_dump($propmeta_query);

        if(isset($propertylist_args['near'])){ 

                   $residential_properties = get_posts( array(
                                          'post_type'       => $post_type,
                                          'post_status'     => 'publish',
                                          'posts_per_page'  => -1,
                                          'post__in'        => explode(',',$propertylist_args['near']),
                                          'order'           => 'ASC',
                                          'orderby'         => 'menu_order',
                                          'meta_query'      => $propmeta_query

                                      ) );
        } 
        else{

          $residential_properties = get_posts( array(
                                          'post_type'       => $post_type,
                                          'post_status'     => 'publish',
                                          'posts_per_page'  => -1,
                                          'order'           => 'ASC',
                                          'orderby'         => 'menu_order',
                                          'meta_query'      => $propmeta_query

                                      ) );


        }


      



           /* if(isset($propertylist_args['type'])){

               $current_unit_types = $properties_optionsmeta['type'] ;

                foreach ($current_unit_types as $unit_typekey => $unit_typevalue) {

                  if(strtolower($unit_typevalue['property_unit_type']) == strtolower(($propertylist_args['type']) )
                    $current_unit_type_id = $unit_typevalue['ID'] ;                   

                }  

                if($post_type=="residential-property"){

                  foreach ($residential_properties as $propertykey => $propertyvalue) {

                    $property_unit_types = get_post_meta($propertyvalue->id,'residential-property-unit-type',true);
                    for
                    
                  }

                }
                else if($post_type=="commercial-property"){ 

                  
                }
                 
            }  */


    }



    if(isset($_REQUEST['type']) && ($_REQUEST['type']!="all") ){
      $property_unit_types_options =  get_property_unit_types_options_data($post_type);
    /*  echo "<br/><br/>TYPE : ".$_REQUEST['type'];
      var_dump($property_unit_types_options);
      echo "<br/><br/>";*/
      //get the unit type id by passed unit type slug
      foreach ($property_unit_types_options as $unit_type_options_key => $unit_type_options_value) {
            if($post_type=="residential-property"){
              $unit_type_option_slug = format_filter_text($unit_type_options_value['property_unit_type']." ".$unit_type_options_value['property_type_name']);
            }
            else{
             $unit_type_option_slug = format_filter_text($unit_type_options_value['property_unit_type']);
            }
            if($unit_type_option_slug==$_REQUEST['type']){
              $pd_unit_type_option_id = $unit_type_options_value['ID'];
            }
     
      }
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
 
    if(isset($_REQUEST['type']) && ($_REQUEST['type']!="all") ){
      if(isset($pd_unit_type_option_id) && (is_array($property_meta_value['property_unit_type'])) ){
          foreach ($property_meta_value['property_unit_type'] as $current_prop_unit_type_key => $current_prop_unit_type_value) {
            if($current_prop_unit_type_value['type'] == $pd_unit_type_option_id ){
              $sel_properties[] =  (object)array_merge((array)$new_res_prop,$property_meta_value) ;
            }
          }
      }        
    }
    else{
      $sel_properties[] =  (object)array_merge((array)$new_res_prop,$property_meta_value) ;  
    }




      

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



    $propertylist_args = array();

    if(isset($_REQUEST['status']))
      $propertylist_args['status'] = $_REQUEST['status'] ;

    if(isset($_REQUEST['city']))
      $propertylist_args['city'] = $_REQUEST['city'] ; 

    if(isset($_REQUEST['locality']))
      $propertylist_args['locality'] = $_REQUEST['locality'] ; 

    if(isset($_REQUEST['type']))
      $propertylist_args['type'] = $_REQUEST['type'] ; 

 if(isset($_REQUEST['near']))
      $propertylist_args['near'] = $_REQUEST['near'] ; 

/*var_dump($_REQUEST);

echo "----------------------------------";*/

    $sel_properties = get_residential_properties_list($post_type,$propertylist_args);
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
    'residential-properties/completed/?$' => 'index.php?pagename=residential-properties',




    'commercial-properties/ongoing/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?pagename=commercial-properties&city=$matches[1]&locality=$matches[2]&type=$matches[3]',
    'commercial-properties/completed/([^/]+)/([^/]+)/([^/]+)/?$' => 'index.php?pagename=commercial-properties&city=$matches[1]&locality=$matches[2]&type=$matches[3]',

    'commercial-properties/ongoing/([^/]+)/([^/]+)/?$' => 'index.php?pagename=commercial-properties&city=$matches[1]&locality=$matches[2]',
    'commercial-properties/completed/([^/]+)/([^/]+)/?$' => 'index.php?pagename=commercial-properties&city=$matches[1]&locality=$matches[2]',

    'commercial-properties/ongoing/([^/]+)/?$' => 'index.php?pagename=commercial-properties&city=$matches[1]',
    'commercial-properties/completed/([^/]+)/?$' => 'index.php?pagename=commercial-properties&city=$matches[1]',

    'commercial-properties/ongoing/?$' => 'index.php?pagename=commercial-properties',
    'commercial-properties/completed/?$' => 'index.php?pagename=commercial-properties'
  );

   $existing_rules = $new_rules + $existing_rules;

   return $existing_rules;
}
add_filter('rewrite_rules_array', 'properties_custom_rewrite_rules');





function get_sap_data(){
  global $wpdb;

  $queried_object = get_queried_object();

  $post = get_post($queried_object->ID);

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
        $type = '';
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
        $type = '';
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





function get_pdf_max_row_count($flats){
  $rec = array();
  foreach($flats as $bld=>$flt){
    $rec[] = count($flt)+8;
  }
  $max_row = $max_row = ceil(array_sum($rec));

  if(count($flats)<=1){
    if(array_sum($rec)>$max_row){
      $max_row = ceil(array_sum($rec)/8)+8;
    }else{
      $max_row = ceil(array_sum($rec)/8);
    }

  }else{
    $max_row = ceil(array_sum($rec)/8)+8;
  }

  if($max_row>27){
    $max_row = 27;
  }

  return $max_row;
}






function download_availability_pdf(){

  global $wpdb;

  if(!isset($_GET['action']) || $_GET['action']!='download_availability'){
    return;
  }

  if(!isset($_GET['prop_id']) || !isset($_GET['plant_id']) || !isset($_GET['m_group']) || !isset($_GET['m_type'])){
    return;
  }

  $property = get_post($_GET['prop_id']);

  $title = $property->post_title;

  $mkt_group_desc = $_GET['m_group'];
  $mkt_material_type_desc = $_GET['m_type'];

  $filename = 'Availability_'.$mkt_material_type_desc.'_BHK_'.get_flat_type($mkt_group_desc).'_'.$title.'.pdf';

  //$max_row = 25;

  $table_name = $wpdb->prefix.'sap_inventory';
  $plan_query = " SELECT * FROM ".$table_name." WHERE plant=".$_GET['plant_id']." AND mkt_group_desc='".$mkt_group_desc."' AND mkt_material_type_desc='".$mkt_material_type_desc."'";
  $plans = $wpdb->get_results($plan_query,ARRAY_A);

    $flats = array();

    foreach($plans as $record){

      //Generating Flats data
         if (!array_key_exists($record['building_no'],$flats)){
            $flats[$record['building_no']] = array();
         }

         if (!array_key_exists($record['flat_no'], $flats[$record['building_no']])) {
         $flats[$record['building_no']][$record['flat_no']] = array('flat'=>$record['flat_no'],'area'=>$record['act_area'],'terrace_area'=>$record['terrace_area'],'total_saleable_area'=>$record['total_saleable_area'],'floor_plan'=>$record['specific_floor_plan'],'status'=>$record['status_desc']);
         }
    }

    $max_row = get_pdf_max_row_count($flats);


    $total_columns = array();
    foreach($flats as $building=>$flt){
      $split_records = array_chunk( $flats[$building], $max_row);
      foreach($split_records as $keyyy => $csmm)
      {
        array_unshift($split_records[$keyyy], 'head');
      }
      $col = count($split_records);
      $total_columns[] = $col;

      /*echo "<pre>";
      print_r($split_records);
      echo "</pre>";*/

    }
    $total_rec = array_sum($total_columns);


    /*$numbers = $total_rec/8;
    $max_row = ceil($numbers);*/


  $html = '<style>'.file_get_contents(get_stylesheet_directory().'/availability/availability.css').'</style><page>';
  $html .= '<div class="full-wrap" style="width: 100%;">
      <table class="header" style="width: 100%;">
        <tr>
          <td class="project_name inbl" style="vertical-align: top; width: 30%;">
            <h1>'.$title.'</h1>
            <h4>Availability</h4>
          </td>
          <td class="legend inbl" style="vertical-align: top; width: 69%;">
            <table align="right">
              <tr>
                <td class="set set1" style="width: 125px;">
                  <div class="color white"></div>
                  <p class="info">WHITE = AVAILABLE</p>
                </td>
                <td class="set set2" style="width: 125px;">
                  <div class="color blue" style="background-color: #d5effc; border-color: #d5effc;"></div>
                  <p class="info">BLUE = SOLD</p>
                </td>
                <td class="set set3" style="width: 125px;">
                  <div class="color green" style="background-color: #d0e5af; border-color: #d0e5af;"></div>
                  <p class="info">GREEN = HOLD</p>
                </td>

                <td class="set updatedon" style="width: 120px; text-align: right;">
                  <!--<div class="color transparent" style="background-color: transparent; border-color: transparent;"></div>-->
                  <p class="info">UPDATED ON<br><span class="updated">'.date("jS F 'y").'</span></p>
                </td>

              </tr>
            </table>
          </td>
        </tr>
      </table>';


$html .= '<table class="ava_table fiveorless" style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="0">';
$html .= '<tr><th colspan="'.$total_rec.'" class="table-head">'.$mkt_material_type_desc.' BHK '.get_flat_type($mkt_group_desc).'</th></tr>';
$html .= '<tr>';
foreach($flats as $key=>$val){

$chunks = array_chunk( $flats[$key], $max_row);
foreach($chunks as $keyy => $csm)
 {
  array_unshift($chunks[$keyy], $key);
 }


 /*echo "<pre>";
      print_r($chunks);
      echo "</pre>";*/

$columns = count($chunks);
$html .= '<td>';
  $html .= '<table class="ava_table_in fiveorless" style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="0">';

  for($i=0;$i<$max_row+1;$i++){

    $html .= '<tr>';

    foreach($chunks as $chunk){

      if(($i==0)){
        $html .= '<th style="width: 90px;">'.$key.'</th>';
      }else{

        if($chunk[$i]['status'] == 'Unsold'){
          $tdclass = '';
        }else if($chunk[$i]['status'] == 'Hold'){
          $tdclass = 'colorgreen';
        }else{
          $tdclass = 'colorblue';
        }

        if($chunk[$i]['flat'] != ''){
          $html .= '<td class="'.$tdclass.'">'.$key.$chunk[$i]['flat'].' ('.$chunk[$i]['area'].')</td>';
        }else{
          $html .= '<td>&nbsp;</td>';
        }
      }

    }

    $html .= '</tr>';
  }

  $html .= '</table>';

   $html .= '</td>';
}
$html .= '</tr>';
$html .= '</table>';

      $html .= '</div>';

      //$html .= '<page_footer><img src="'.get_stylesheet_directory_uri().'/availability/marvelLogo_withtag.png" alt="Marvel Logo" class="marvelogo"></page_footer>';

  $html .= '</page>';


  require_once('html2pdf/html2pdf.class.php');

  try
    {
        $html2pdf = new HTML2PDF('P', 'A4');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($html);
        $html2pdf->Output($filename,'D');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

}

add_action('template_redirect','download_availability_pdf');




















function download_all_availability_pdf(){

  global $wpdb;

  if(!isset($_GET['action']) || $_GET['action']!='download_all_availability'){
    return;
  }

  if(!isset($_GET['prop_id']) || !isset($_GET['plant_id'])){
    return;
  }

  $property = get_post($_GET['prop_id']);

  $title = $property->post_title;

  $filename = 'Availability_'.$title.'.pdf';

  

  //$max_row = 25;

  $table_name = $wpdb->prefix.'sap_inventory';
  $plan_query = " SELECT * FROM ".$table_name." WHERE plant=".$_GET['plant_id']."";
  $plans = $wpdb->get_results($plan_query,ARRAY_A);

    $flats = array();

    foreach($plans as $record){

      //Generating Flats data
         if (!array_key_exists($record['mkt_group_desc'],$flats)){
            $flats[$record['mkt_group_desc']] = array();
         }

         if (!array_key_exists($record['mkt_material_type_desc'],$flats[$record['mkt_group_desc']])) {
          $flats[$record['mkt_group_desc']][$record['mkt_material_type_desc']] = array();
         }

         if (!array_key_exists($record['building_no'], $flats[$record['mkt_group_desc']][$record['mkt_material_type_desc']])) {
         $flats[$record['mkt_group_desc']][$record['mkt_material_type_desc']][$record['building_no']] = array();
         }

         if (!array_key_exists($record['flat_no'], $flats[$record['mkt_group_desc']][$record['mkt_material_type_desc']][$record['building_no']])) {
         $flats[$record['mkt_group_desc']][$record['mkt_material_type_desc']][$record['building_no']][$record['flat_no']] = array('flat'=>$record['flat_no'],'area'=>$record['act_area'],'terrace_area'=>$record['terrace_area'],'total_saleable_area'=>$record['total_saleable_area'],'floor_plan'=>$record['specific_floor_plan'],'status'=>$record['status_desc']);
         }
    }


  /*echo "<pre>";
  print_r($flats);
  echo "</pre>";*/

$html = '<style>'.file_get_contents(get_stylesheet_directory().'/availability/availability.css').'</style>';
  foreach($flats as $type=>$desc){

    
    
    foreach($desc as $bl=>$fl){

      $max_row = get_pdf_max_row_count($fl);

    $total_columns = array();
    foreach($fl as $building=>$flt){
      $split_records = array_chunk( $fl[$building], $max_row);
      foreach($split_records as $keyyy => $csmm)
      {
        array_unshift($split_records[$keyyy], 'head');
      }
      $col = count($split_records);
      $total_columns[] = $col;
    }
    $total_rec = array_sum($total_columns);    


    $html .= '<page>';
  $html .= '<div class="full-wrap" style="width: 100%;">
      <table class="header" style="width: 100%;">
        <tr>
          <td class="project_name inbl" style="vertical-align: top; width: 30%;">
            <h1>'.$title.'</h1>
            <h4>Availability</h4>
          </td>
          <td class="legend inbl" style="vertical-align: top; width: 69%;">
            <table align="right">
              <tr>
                <td class="set set1" style="width: 125px;">
                  <div class="color white"></div>
                  <p class="info">WHITE = AVAILABLE</p>
                </td>
                <td class="set set2" style="width: 125px;">
                  <div class="color blue" style="background-color: #d5effc; border-color: #d5effc;"></div>
                  <p class="info">BLUE = SOLD</p>
                </td>
                <td class="set set3" style="width: 125px;">
                  <div class="color green" style="background-color: #d0e5af; border-color: #d0e5af;"></div>
                  <p class="info">GREEN = HOLD</p>
                </td>

                <td class="set updatedon" style="width: 120px; text-align: right;">
                  <!--<div class="color transparent" style="background-color: transparent; border-color: transparent;"></div>-->
                  <p class="info">UPDATED ON<br><span class="updated">'.date("jS F 'y").'</span></p>
                </td>

              </tr>
            </table>
          </td>
        </tr>
      </table>';



     $html .= '<table class="ava_table fiveorless" style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="0">';
    $html .= '<tr><th colspan="'.$total_rec.'" class="table-head">'.$bl.' BHK '.get_flat_type($type).'</th></tr>';
$html .= '<tr>';
foreach($fl as $key=>$val){

$chunks = array_chunk( $fl[$key], $max_row);
foreach($chunks as $keyy => $csm)
 {
  array_unshift($chunks[$keyy], $key);
 }

$columns = count($chunks);
$html .= '<td>';
  $html .= '<table class="ava_table_in fiveorless" style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="0">';

  for($i=0;$i<$max_row;$i++){

    $html .= '<tr>';

    foreach($chunks as $chunk){

      if(($i==0)){
        $html .= '<th style="width: 90px;">'.$key.'</th>';
      }else{

        if($chunk[$i]['status'] == 'Unsold'){
          $tdclass = '';
        }else if($chunk[$i]['status'] == 'Hold'){
          $tdclass = 'colorgreen';
        }else{
          $tdclass = 'colorblue';
        }

        if($chunk[$i]['flat'] != ''){
          $html .= '<td class="'.$tdclass.'">'.$key.$chunk[$i]['flat'].' ('.$chunk[$i]['area'].')</td>';
        }else{
          $html .= '<td>&nbsp;</td>';
        }
      }

    }

    $html .= '</tr>';
  }

  $html .= '</table>';

   $html .= '</td>';
}
$html .= '</tr>';
$html .= '</table>'; 




      $html .= '</div>';

      //$html .= '<page_footer><img src="'.get_stylesheet_directory_uri().'/availability/marvelLogo_withtag.png" alt="Marvel Logo" class="marvelogo"></page_footer>';

      $html .= '</page>';



    

    }

    
  }
  


  require_once('html2pdf/html2pdf.class.php');

  try
    {
        $html2pdf = new HTML2PDF('P', 'A4');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($html);
        $html2pdf->Output($filename,'D');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }



}

add_action('template_redirect','download_all_availability_pdf');




function format_filter_text($filter_text=""){

    $filter_text = trim($filter_text);
    return str_replace(' ','-',strtolower($filter_text));
}





function get_unique_property_types($project_type){
global $wpdb;
$table_name = $wpdb->prefix.'sap_inventory';
//$property_type_query = " SELECT material_group_desc,mkt_group_desc FROM ".$table_name." WHERE project_type='".$project_type."' GROUP BY material_group";
 $property_type_query = " SELECT material_group_desc,mkt_group_desc,project_type FROM ".$table_name." GROUP BY material_group HAVING project_type='".$project_type."'";
 $sap_data_type = $wpdb->get_results($property_type_query,ARRAY_A);

  $property_types = array();
  foreach($sap_data_type as $key=>$property){
  	$property_types[] = array(
  		'property_type' => $property['material_group_desc'],
  		'material_group' => $property['material_group_desc'],
  		'mkt_group_desc' => $property['mkt_group_desc'],
  		'ID' => $key+1
  	);
  }
  return $property_types;
}



function get_unique_property_unit_types($project_type){
	global $wpdb;
	$table_name = $wpdb->prefix.'sap_inventory';
	//$property_query = " SELECT DISTINCT material_group_desc,material_type,mkt_group_desc,mkt_material_type_desc FROM ".$table_name." WHERE project_type='Residential' GROUP BY material_type,mkt_material_type_desc";
	$property_query = " SELECT DISTINCT material_group_desc,material_type,mkt_group_desc,mkt_material_type_desc,project_type FROM ".$table_name." GROUP BY material_type,mkt_material_type_desc HAVING project_type='".$project_type."'";
	$sap_data = $wpdb->get_results($property_query,ARRAY_A);
	return $sap_data;
}


function get_sap_property_type_id($code,$project){
if($project == 'residential'){
$type_options = maybe_unserialize(get_option('residential-property-type'));
}else{
$type_options = array();
}

$types = $type_options['property_types'];
$key = array_search($code, array_column($types, 'mkt_group_desc'));
return $types[$key]['ID'];
}








function update_residentials_property_type(){
  global $wpdb;

  $type_options = maybe_unserialize(get_option('residential-property-type')); 
  if(!$type_options || count($type_options)<=0){

  	$property_types = get_unique_property_types('Residential');

  	$last = end($property_types);

  	$property_type_options = array(
  		'max_property_types' => $last['ID'],
  		'property_types' => $property_types
  		);

  	update_option( 'residential-property-type', maybe_serialize($property_type_options));
  }



$prop_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));
if(!$prop_unit_types || count($prop_unit_types)<=0){
  
$property_unit_types = get_property_units_options_residential();

$last_unit = end($property_unit_types);

$residential_property_unit_type = array(
	'max_property_unit_types' => $last_unit['ID'],
	'property_unit_types' => $property_unit_types
	);

update_option( 'residential-property-unit-type', maybe_serialize($residential_property_unit_type));
}

 }

 add_action('init','update_residentials_property_type');






 function get_property_units_options_residential(){
  global $wpdb;

  $table_name = $wpdb->prefix.'sap_inventory';
  $property_query = " SELECT * FROM ".$table_name." WHERE project_type='Residential'";
  $data = $wpdb->get_results($property_query,ARRAY_A);

  
  $areas = array();
  foreach($data as $record){

    if($record['mkt_group_desc'] != 'Co'){
     if (!array_key_exists($record['mkt_group_desc'],$areas)){
      $areas[$record['mkt_group_desc']] = array();
    }

    if (!array_key_exists($record['mkt_material_type_desc'],$areas[$record['mkt_group_desc']])) {
      $areas[$record['mkt_group_desc']][$record['mkt_material_type_desc']] = array(
        'material_type'=>$record['material_type'],
        'mkt_material_type_desc'=>$record['mkt_material_type_desc'],
        'mkt_group_desc'=>$record['mkt_group_desc']
        );
    }
  }

}

$unit_types = array();
$i = 1;
foreach ($areas as $group=>$types){


  foreach ($types as $key=>$value){

    if(is_numeric($value['mkt_material_type_desc'])){
      $bedroom = round($value['mkt_material_type_desc']);
      $property_unit_type = $value['mkt_material_type_desc'].' BHK';
    }else{
      $bedroom = '';
      $property_unit_type = $value['material_type'];
    }

    $unit_types[] = array(
      'number_bedrooms' => $bedroom,
      'property_unit_type' => $property_unit_type,
      'material_type' => $value['material_type'],
      'material_type_desc' => $value['mkt_material_type_desc'],
      'mkt_group_desc' => $value['mkt_group_desc'],
      'mkt_material_type_desc' => $value['mkt_material_type_desc'],
      'property_type_id' => get_sap_property_type_id($value['mkt_group_desc'],'residential'),
      'ID' => $i
      );
    $i++;
  }
  //$i++;

}
return $unit_types;
}




function multidimensional_search($parents, $searched) { 
  if (empty($searched) || empty($parents)) { 
    return false; 
  } 

  foreach ($parents as $key => $value) { 
    $exists = true; 
    foreach ($searched as $skey => $svalue) { 
      $exists = ($exists && IsSet($parents[$key][$skey]) && $parents[$key][$skey] == $svalue); 
    } 
    if($exists){ return $key; } 
  } 

  return false; 
} 




function get_unit_type_by_desc_group($group,$key){
  $prop_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));
  $units = $prop_unit_types['property_unit_types'];
  $type = multidimensional_search($units, array('mkt_group_desc'=>$group, 'mkt_material_type_desc'=>$key));
  return $units[$type]['ID'];
  }






  function generate_property_unit_types_residential($plant_id){
    global $wpdb;

    
    $table_name = $wpdb->prefix.'sap_inventory';
    $property_query = " SELECT * FROM ".$table_name." WHERE plant='".$plant_id."'";
    $data = $wpdb->get_results($property_query,ARRAY_A);


    $areas = array();
    foreach($data as $record){

      if($record['mkt_group_desc'] != 'Co'){

       if (!array_key_exists($record['mkt_group_desc'],$areas)){
        $areas[$record['mkt_group_desc']] = array();
      }

      if (!array_key_exists($record['mkt_material_type_desc'],$areas[$record['mkt_group_desc']])) {
        $areas[$record['mkt_group_desc']][$record['mkt_material_type_desc']] = array();
      }


      if (!in_array($record['total_saleable_area'], $areas[$record['mkt_group_desc']][$record['mkt_material_type_desc']])) {
       array_push($areas[$record['mkt_group_desc']][$record['mkt_material_type_desc']],$record['total_saleable_area']);
     }
   }

 }

 /*$unit_meta = maybe_unserialize(get_post_meta('926','residential-property-unit-type', true));
 $prop_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));*/

 $property_unit_types = array();
 foreach ($areas as $group=>$types){

  foreach ($types as $key=>$value){
    $type = get_unit_type_by_desc_group($group,$key);
    $property_unit_types[] = array(
      'type' =>$type,
      'min_area' => min($value),
      'max_area' => max($value)
      );
  }

}

return $property_unit_types;
}

//add_action('template_redirect', 'generate_property_unit_types_residential');







function add_unit_types_metabox (){
   add_meta_box('property_unit_types', __('Unit Types'),  'property_unit_types_metabox', 'residential-property', 'side', 'high');
}
add_action('admin_init', 'add_unit_types_metabox');

function property_unit_types_metabox($post) {
  if( $post->post_modified_gmt != $post->post_date_gmt ){

    $plant_id = get_post_meta($post->ID,'property-plant-id',true);

    if(!$plant_id){
      echo '<h4>Plant ID is missing!!!</h4>';
      return;
    }

    $prop_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));
    $units = $prop_unit_types['property_unit_types'];

    $type_options = maybe_unserialize(get_option('residential-property-type'));
    $groups = $type_options['property_types'];


    $html = '';
    $unit_meta = maybe_unserialize(get_post_meta($post->ID,'residential-property-unit-type', true));
    if($unit_meta && count($unit_meta)>0){
      $html .= '<ul id="unit_type_list">';
      foreach ($unit_meta as $unit){
        $key = array_search($unit['type'], array_column($units, 'ID'));
        $type = array_search($units[$key]['property_type_id'], array_column($groups, 'ID'));
        $html .= '<li>'.$units[$key]['material_type'].' - '.$groups[$type]['property_type'].'</li>';
      }
      $html .= '</ul>';

      $html .= '<a class="button button-default button-large" id="generate_unit_types" data-postId="'.$post->ID.'">Regenerate Units</a><img id="unit_load_loader" style="display:none; margin:06px 0px 0px 05px;" src="'.get_stylesheet_directory_uri().'/img/loader.gif">';
    }else{
      $html .= '<ul id="unit_type_list"></ul>';
      $html .= '<a class="button button-default button-large" id="generate_unit_types" data-postId="'.$post->ID.'">Generate Units</a><img id="unit_load_loader" style="display:none; margin:06px 0px 0px 05px;" src="'.get_stylesheet_directory_uri().'/img/loader.gif">';
    }
    echo $html;
    }
}






add_action( 'wp_ajax_generatePropertyUnits', 'generate_property_units_aj' );

function generate_property_units_aj() {
  $plant_id = get_post_meta($_POST['property_id'],'property-plant-id',true);
  $property_units = generate_property_unit_types_residential($plant_id);
  

if(count($property_units)>0){
  update_post_meta($_POST['property_id'],'residential-property-unit-type', maybe_serialize($property_units));

  $prop_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));
  $units = $prop_unit_types['property_unit_types'];

  $type_options = maybe_unserialize(get_option('residential-property-type'));
  $groups = $type_options['property_types'];


  $dt = '';
  foreach ($property_units as $unit){
    $key = array_search($unit['type'], array_column($units, 'ID'));
    $type = array_search($units[$key]['property_type_id'], array_column($groups, 'ID'));
    $dt .= '<li>'.$units[$key]['material_type'].' - '.$groups[$type]['property_type'].'</li>';
  }
  $response = array('status'=>'true', 'units'=>$dt);
}else{
  $response = array('status'=>'false');
}
  echo json_encode($response);
  wp_die();
}
