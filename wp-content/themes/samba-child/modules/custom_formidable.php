<?php 


/** Function to get field data as  field id, name, description,type, default value, options,
 *  field_order, required,  field options, form_id, created_at  by passing array of field keys to function
 * @param array $field_keys
 * @return array
 */
function get_field_id_by_key($field_keys=array()){

    global $wpdb;
    $fields_data = array();
    if(count($field_keys)>0){
        $field_key_str = "'" . implode("','", $field_keys) . "'";
        $qry_fields_details = "SELECT * FROM {$wpdb->prefix}frm_fields
                                    WHERE field_key in (".$field_key_str.")";

        $res_fields_details = $wpdb->get_results($qry_fields_details,ARRAY_A);
        if(count($res_fields_details)>0){
            foreach($res_fields_details as $field_details){
                $fields_data[$field_details['field_key']] = $field_details;
            }
        }
    }

    return $fields_data;

}



 
function frm_populate_formidable_field_values($values, $field){

        switch($field->field_key){

            case 'ky_contact1projects':   
                                            $all_properties = get_residential_properties_list();

                                            if(is_array($all_properties) && count($all_properties)>0){
                                                foreach($all_properties as $p){
                                                 $values['options'][$p->id] = $p->post_title;
                                               }
                                            }
                                            //$values['use_key'] = true; //this will set the field to save the post ID instead of post title                                       

                                        break;
            case 'ky_contact1city':   
                                              $property_cities_option = maybe_unserialize(get_option('property-city',true));

                                               $property_cities = isset($property_cities_option['cities'])?maybe_unserialize($property_cities_option['cities']):array();

                                             if(isset($property_cities)){

                                                 if(is_array($property_cities) && count($property_cities)>0){

                                                    foreach($property_cities as $city){

                                                        $values['options'][$city['ID']] = $city['name'];

                                                   }
                                                }

                                              } 
 
                                           
                                           
                                           // $values['use_key'] = true; //this will set the field to save the post ID instead of post title                                       

                                        break;

        }
 

 
        return $values;
}
add_filter('frm_setup_new_fields_vars', 'frm_populate_formidable_field_values', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'frm_populate_formidable_field_values', 20, 2); //use this function on edit too


 


 