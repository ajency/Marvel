<?php




function get_map_address_details($property_id){

	global $wpdb; 
	$qry_map_address_details = "SELECT address, city, region, postcode, country, lat, lng  FROM {$wpdb->prefix}addresses WHERE addressable_id = ".$property_id;
	//echo $qry_map_address_details;
	$res_map_address_details = $wpdb->get_results($qry_map_address_details,ARRAY_A);

	return $res_map_address_details;

}


function get_search_options(){

	$property_type = maybe_unserialize(get_option('residential-property-type',true));
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

	$search_option_data = array( 'cities'		 => $property_cities,
								 'status'		 => $property_status,
								 'locality'		 => $property_locality,
								 'neighbourhood' => $property_neighbourhood,
                                 'no_of_bedrooms'=> $property_bedrooms,
                                 'type'			 => $property_type,
                                 'citylocality'	 => $property_citylocality,
                                 'amenities'	 => $property_amenities
								);

	wp_send_json( $search_option_data);


}
add_action( 'wp_ajax_get_search_options', 'get_search_options' );
add_action( 'wp_ajax_nopriv_get_search_options', 'get_search_options' );


function get_res_property_meta_values($property_id){
	$property_sellablearea = get_post_meta($property_id, 'property-sellable_area',true);
    $property_cities = get_post_meta($property_id, 'property-city',true);
    $property_status = get_post_meta($property_id, 'property-status',true);
    $property_locality = get_post_meta($property_id, 'property-locality',true);
    $property_neighbourhood = maybe_unserialize(get_post_meta($property_id, 'property-neighbourhood',true));
    $property_type = get_post_meta($property_id, 'residential-property-type',true);
    $property_price = get_post_meta($property_id, 'property-price',true);

    $residential_property_meta_data = array('property_city'          => $property_cities,
                                             'property_status'       => $property_status,
                                             'property_locaity'      => $property_locality,
                                             'poperty_neighbourhood' => $property_neighbourhood,
                                             'property_type'		 => $property_type,
                                             'property_sellablearea' => $property_sellablearea, 
                                             'map_address'	 		 => get_map_address_details($property_id),
                                             'property_price' 		 => $property_price
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

	$new_res_prop->id = 	$res_property->ID ;
	$new_res_prop->post_date = 	$res_property->post_date ;
	$new_res_prop->post_excerpt = 	$res_property->post_excerpt ;
	$new_res_prop->post_parent = 	$res_property->post_parent ;
	$new_res_prop->post_title = 	$res_property->post_title ;
	$new_res_prop->guid = 	$res_property->guid ;
	$new_res_prop->post_author = 	$res_property->post_author ;
	$new_res_prop->post_url = 	site_url().'/Residential-Property/'.$res_property->post_name;
	$new_res_prop->featured_image = wp_get_attachment_url( get_post_thumbnail_id($res_property->ID) );
	$new_res_prop->featured_image_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($res_property->ID), 'thumbnail'  );
	$new_res_prop->amenities = 	$property_amenities;

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