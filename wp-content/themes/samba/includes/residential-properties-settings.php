<?php 










function custom_submenu_page_property_unit_type_callback() {





if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class My_Example_List_Table extends WP_List_Table {

   /* var $example_data = array(
            array( 'ID' => 1,'property_unit_type' => '1 BHK', 'number_bedrooms' => '1',
                   'action' => 'Edit' ),
            array( 'ID' => 2, 'property_unit_type' => '2 BHK','number_bedrooms' => '2',
                   'action' => 'Edit' ),
            array( 'ID' => 3, 'property_unit_type' => '3 BHK', 'number_bedrooms' => '3',
                   'action' => 'Edit' ),
            array( 'ID' => 4, 'property_unit_type' => '4 BHK', 'number_bedrooms' => '4',
                   'action' => 'Edit' ),
            array( 'ID' => 5, 'property_unit_type'     => '5 BHK', 'number_bedrooms'    => '5',
                   'action' => 'Edit' ),
            array(' ID' => 6, 'property_unit_type' => '6 BHK', 'number_bedrooms' => '6',
                  'action' => 'Edit' )
        ); */
    function __construct(){
    global $status, $page;

        parent::__construct( array(
            'singular'  => __( 'Property Unit Type', 'mylisttable' ),     //singular name of the listed records
            'plural'    => __( 'Property Unit Types', 'mylisttable' ),   //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
    ) );
    }



  function column_default( $item, $column_name ) {
    switch( $column_name ) {
        case 'property_unit_type':
						$actions = array(
						            'edit'      => sprintf('<a href="javascript:void(0)" class="edit_property_unit_type"  type_id ="'.$item['ID'].'"    type_name="'.$item['property_unit_type'].'"  bedrooms="'.$item['number_bedrooms'].'" property_type_id="'.$item['property_type_id'].'" >Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
						            'delete'    => sprintf('<a href="javascript:void(0)" class="delete_property_unit_type" type_id ="'.$item['ID'].'" >Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
						        );

						  return sprintf('%1$s %2$s', "<span class='spn_property_unit_type'>".$item['property_unit_type']."</span>", $this->row_actions($actions) );



        case 'number_bedrooms':
        //case 'action':
            return $item[ $column_name ];
        case 'property_type':

        $display_property_type = ' - ';

        		$property_type_options = maybe_unserialize(get_option('residential-property-type'));
        		if($property_type_options!=false){
        			if(isset($property_type_options['property_types'])){
        				if(is_array($property_type_options['property_types'])){
        					foreach ($property_type_options['property_types'] as $prop_type ) {
        						if($prop_type['ID'] == $item[ 'property_type_id' ]){
        							$display_property_type = $prop_type['property_type'] ;
        						}
        					}
        				}
        			}
        		}

        	return $display_property_type;
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

function get_columns(){
        $columns = array(
            'property_unit_type' => __( 'Property Unit Type', 'mylisttable' ),
            'number_bedrooms'    => __( 'No Of Bedrooms', 'mylisttable' ),
            'property_type'    => __( 'Property Type', 'mylisttable' )
            //'action'      => __( 'Action', 'mylisttable' )
        );
         return $columns;
    }
function prepare_items() {
  $columns  = $this->get_columns();
  $hidden   = array();
  $sortable = array();
  $this->_column_headers = array( $columns, $hidden, $sortable );
  $this->items = $this->get_data();//$this->example_data;
}

function get_data(){



	global $wpdb;

	$current_property_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));

	if($current_property_unit_types==false){
		return array();
	}
	else{


		if(!isset($current_property_unit_types['max_property_unit_types'])    ||    $current_property_unit_types['max_property_unit_types']<=0 ){
			return array();
		}
		else if($current_property_unit_types['max_property_unit_types']>0){
///var_dump(maybe_unserialize($current_property_unit_types['property_unit_types']));

			return maybe_unserialize($current_property_unit_types['property_unit_types']);
		}


	}



}



function get_sortable_columns() {
  $sortable_columns = array(
    'property_unit_type'  => array('property_unit_type',true),
    'number_bedrooms' => array('number_bedrooms',false),
    'property_type' => array('property_type',false),
    // 'action'   => array('actoin',false)
  );
  return $sortable_columns;
}

} //class


/*
function get_property_unit_types(){
	global $wpdb;

	$property_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));

} */


  echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
  echo '<h2>Residential Properties Settings</h2>';
  echo '</div>';


  $property_type_options = maybe_unserialize(get_option('residential-property-type'));
  ///var_dump($property_type_options);
  $myListTable = new My_Example_List_Table();
  echo '<div class="wrap"><h3>Property Unit Types </h3>';
  $myListTable->prepare_items();
  echo '<div col-container>

  <div class="property_unit_type_message ">

  </div>

  			<div id="col-right">
				<div class="col-wrap">';
  $myListTable->display();

  echo '		</div>
  			</div>
  			<div id="col-left">
				<div class="col-wrap">




					<div class="form-wrap">
						<h3 class="add_edit_type_formtitle"><span class="title">Add New Property Unit Type</span>
							<a href="javascript:void(0)" class="add-new-h2 add_new_type_form">Add New</a>
						</h3>
						<form id="frm_property_unit_type" method="post" action="" class="validate">
							<!-- <input type="hidden" name="action" value="">
							<input type="hidden" name="screen" value="edit-property_amenity">
							<input type="hidden" name="custom_field_name" value="property_amenity">
							<input type="hidden" name="post_type" value="residential-property">
							<input type="hidden" id="_wpnonce_add-tag" name="_wpnonce_add-tag" value="781a607a1b">
							<input type="hidden" name="_wp_http_referer" value="/marvel/wp-admin/edit-tags.php?taxonomy=property_amenity&amp;post_type=residential-property"> -->

							<input type="hidden" name="edit_id" id="edit_id"  value="" />
							<div class="form-field form-required term-name-wrap">
								<label for="tag-name">Type</label>
								<input name="new-property-unit-type" id="new-property-unit-type" type="text" value="" size="40" aria-required="true">
								<p><!-- The name is how it appears on your site. --></p>
							</div>
							<div class="form-field term-slug-wrap">
								<label for="tag-slug">Number Of Bedrooms</label>
								<input name="new-property-bedrooms" id="new-property-bedrooms" class="allownumericwithdecimal"  type="text" value="" size="40" >
								<p><!-- The “slug” is the URL-friendly version of the name.
								It is usually all lowercase and contains only letters, numbers, and hyphens. --></p>
							</div>

							<div class="form-field term-slug-wrap">
								<label for="tag-slug">Property Types</label>
								<select name="new-prop-type" id="new-prop-type">
									<option value="">Select</option>';

		if(isset($property_type_options['property_types'])){
			if(is_array($property_type_options['property_types'])){
				foreach($property_type_options['property_types'] as $prop_type){
					echo '<option value="'. $prop_type['ID'].'">'. $prop_type['property_type'].'</option>';	
				}	
			}		
			
		}
		echo					'</select>
								<p><!-- The “slug” is the URL-friendly version of the name.
								It is usually all lowercase and contains only letters, numbers, and hyphens. --></p>
							</div>

							<p class="submit">
								<input type="button" name="add_new_property_unit_type" id="add_new_property_unit_type"
								class="button button-primary save_property_unit_type" value="Save">
								<input type="button" name="cancel_edit_property_unit_type" id="cancel_edit_property_unit_type"
								class="button cancel_edit_property_unit_type" value="Cancel" style="display:none">
							</p><br>

						</form>
				</div>







				</div>
			</div>

  		</div>  ';
  echo '<input type="hidden" name="custom_field_name" id="custom_field_name" value="residential-property-unit-type" /> ';
  echo '</div>';

}






/*function register_my_custom_submenu_page() {
//  add_submenu_page( 'tools.php', 'My Custom Submenu Page', 'My Custom Submenu Page', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' );
  add_submenu_page( 'edit.php?post_type=residential-property', 'Residential Properties Settings', 'Residential Properties Settings', 'manage_options', 'residential-properties-settings', 'my_custom_submenu_page_callback' );
}
add_action('admin_menu', 'register_my_custom_submenu_page');
*/


function save_property_unit_type(){

	
	$num_bedrooms 		= $_REQUEST['data']['num_bedrooms'];
	$property_unit_type = $_REQUEST['data']['property_unit_type'];
	$property_edit_id 	= $_REQUEST['data']['edit_id'];
	$new_prop_type 		= $_REQUEST['data']['prop_type_id'];

	$current_property_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));

	$new_property_unit_type['number_bedrooms'] 		= $num_bedrooms;
	$new_property_unit_type['property_unit_type'] 	= $property_unit_type;
	$new_property_unit_type['property_type_id'] 	= $new_prop_type;

	if($property_edit_id!=''){
		$new_property_unit_type['ID'] = $property_edit_id;

		foreach ($current_property_unit_types['property_unit_types'] as $key => $value) {

			if($property_edit_id == $value['ID']){
					$updated_new_property_unit_types[$key] = $new_property_unit_type;
			}
			else{
					$updated_new_property_unit_types[$key] = $value;
			}

		}

		$updated_new_max_property_unit_type = $current_property_unit_types['max_property_unit_types'];

	}
	else{
			if(!isset($current_property_unit_types['max_property_unit_types'])){

				$new_property_unit_type['ID'] = 1;
				$current_property_unit_types ['property_unit_types'] = array();
			}
			else if(count($current_property_unit_types['max_property_unit_types'])<=0 || $current_property_unit_types==false ){

				$new_property_unit_type['ID'] = 1;
				$current_property_unit_types ['property_unit_types'] = array();

			}
			else{

				/*$current_max_property_id = 0;
				foreach ($current_property_unit_types as $key => $value) {
					if($value['ID']>$current_max_property_id){
					 	$current_max_property_id = $value['ID'];
					}
				}
				$new_property_unit_type['ID']  = $current_max_property_id + 1 ;	*/

				$new_property_unit_type['ID'] = $current_property_unit_types['max_property_unit_types'] + 1;
			}

			if(!is_array($current_property_unit_types['property_unit_types'])){
				$current_property_unit_types['property_unit_types'] = array();
			}

			$updated_new_property_unit_types =    $current_property_unit_types['property_unit_types'];
			$updated_new_property_unit_types[] = $new_property_unit_type ;
			$updated_new_max_property_unit_type = $new_property_unit_type['ID'];
	}



	$result = update_option('residential-property-unit-type',maybe_serialize(array('max_property_unit_types' => $updated_new_max_property_unit_type,
																			  'property_unit_types'     => $updated_new_property_unit_types
																		)));

	if($result==false){
		$current_property_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));
	}

	wp_send_json(array('success' => $result, 'ID'=>$new_property_unit_type['ID'], 'data'=>$updated_new_property_unit_types));

}
add_action( 'wp_ajax_save_property_unit_type', 'save_property_unit_type' );




function delete_property_unit_type(){

	$property_unit_type_id = $_REQUEST['data']['type_id'];
	$current_property_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));

	$found_del_type = false ;

	foreach ($current_property_unit_types['property_unit_types'] as $key => $value) {
		 if($value['ID']!=$property_unit_type_id ){

		 	$updated_property_unit_types [] = $value ;
		 }
		 else if($value['ID']==$property_unit_type_id ){
			 $found_del_type = true ;
		 }

	}

	$updated_new_property_unit_types =  array('max_property_unit_types' => $current_property_unit_types['max_property_unit_types'],
									 'property_unit_types'	  => $updated_property_unit_types);

	update_option('residential-property-unit-type',maybe_serialize($updated_new_property_unit_types));

	wp_send_json(array('success'=>true,'types'=>$updated_property_unit_types ));
}
add_action( 'wp_ajax_delete_property_unit_type', 'delete_property_unit_type' );



function get_property_unit_type_option(){

	global $wpdb;

	$current_property_unit_types = maybe_unserialize(get_option('residential-property-unit-type'));

	if(isset($current_property_unit_types['property_unit_types'])){
		wp_send_json(maybe_unserialize($current_property_unit_types['property_unit_types']));
	}
	else{
		wp_send_json(array() );
	}



}
add_action( 'wp_ajax_get_property_unit_type_option', 'get_property_unit_type_option' );

















function delete_property_unit_type_row() {

	$property_id   		= $_REQUEST['data']['property_id'];
	$property_unit_type 		= $_REQUEST['data']['property_unit_type'];


	$delete_success = false;

	  $custom_file_field_value = maybe_unserialize( get_post_meta($property_id,'residential-property-unit-type',true) );


	  if($custom_file_field_value!=false and is_array($custom_file_field_value)){



	  	foreach ($custom_file_field_value as $key => $value) {

	  		$data = maybe_unserialize($value);


	  		if($data['type'] == $property_unit_type){

	  				if($data['layout_image']!='')
	  					$result_delete_attachment = wp_delete_attachment($data['layout_image']);
	  				if($data['layout_pdf']!='')
				  		$result_delete_attachment = wp_delete_attachment($data['layout_pdf']);

	  		}
	  		else{
	  			$updated_data[] = $value;
	  		}


	  	}
	  	

	}

	update_post_meta($property_id,'residential-property-unit-type',$updated_data);
    wp_send_json($delete_success);


}
add_action( 'wp_ajax_delete_property_unit_type_row', 'delete_property_unit_type_row' );



























function custom_submenu_page_property_type_callback() {





if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class My_Example_List_Table extends WP_List_Table {

   /* var $example_data = array(
            array( 'ID' => 1,'property_type' => '1 BHK', 'number_bedrooms' => '1',
                   'action' => 'Edit' ),
            array( 'ID' => 2, 'property_type' => '2 BHK','number_bedrooms' => '2',
                   'action' => 'Edit' ),
            array( 'ID' => 3, 'property_type' => '3 BHK', 'number_bedrooms' => '3',
                   'action' => 'Edit' ),
            array( 'ID' => 4, 'property_type' => '4 BHK', 'number_bedrooms' => '4',
                   'action' => 'Edit' ),
            array( 'ID' => 5, 'property_type'     => '5 BHK', 'number_bedrooms'    => '5',
                   'action' => 'Edit' ),
            array(' ID' => 6, 'property_type' => '6 BHK', 'number_bedrooms' => '6',
                  'action' => 'Edit' )
        ); */
    function __construct(){
    global $status, $page;

        parent::__construct( array(
            'singular'  => __( 'Property Type', 'mylisttable' ),     //singular name of the listed records
            'plural'    => __( 'Property Types', 'mylisttable' ),   //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
    ) );
    }



  function column_default( $item, $column_name ) {
    switch( $column_name ) {
        case 'property_type':
						$actions = array(
						            //'edit'      => sprintf('<a href="javascript:void(0)" class="edit_property_type"  type_id ="'.$item['ID'].'"    type_name="'.$item['property_type'].'"  bedrooms="'.$item['number_bedrooms'].'" >Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
							'edit'      => sprintf('<a href="javascript:void(0)" class="edit_property_type"  type_id ="'.$item['ID'].'"    type_name="'.$item['property_type'].'"   >Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
						            'delete'    => sprintf('<a href="javascript:void(0)" class="delete_property_type" type_id ="'.$item['ID'].'" >Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
						        );

						  return sprintf('%1$s %2$s', "<span class='spn_property_type'>".$item['property_type']."</span>", $this->row_actions($actions) );



        //case 'number_bedrooms':
        //case 'action':
            return $item[ $column_name ];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

function get_columns(){
        $columns = array(
            'property_type' => __( 'Property Type', 'mylisttable' ),
            //'number_bedrooms'    => __( 'No Of Bedrooms', 'mylisttable' )
            //'action'      => __( 'Action', 'mylisttable' )
        );
         return $columns;
    }
function prepare_items() {
  $columns  = $this->get_columns();
  $hidden   = array();
  $sortable = array();
  $this->_column_headers = array( $columns, $hidden, $sortable );
  $this->items = $this->get_data();//$this->example_data;
}

function get_data(){



	global $wpdb;

	$current_property_types = maybe_unserialize(get_option('residential-property-type'));

	if($current_property_types==false){
		return array();
	}
	else{


		if(!isset($current_property_types['max_property_types'])    ||    $current_property_types['max_property_types']<=0 ){
			return array();
		}
		else if($current_property_types['max_property_types']>0){


			return maybe_unserialize($current_property_types['property_types']);
		}


	}



}



function get_sortable_columns() {
  $sortable_columns = array(
    'property_type'  => array('property_type',true),
   // 'number_bedrooms' => array('number_bedrooms',false),
    // 'action'   => array('actoin',false)
  );
  return $sortable_columns;
}

} //class


/*
function get_property_types(){
	global $wpdb;

	$property_types = maybe_unserialize(get_option('residential-property-type'));

} */


  echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>Residential Properties Settings</h2>';
  echo '</div>';



  $myListTable = new My_Example_List_Table();
  echo '<div class="wrap"><h3>Property Types </h3>';
  $myListTable->prepare_items();
  echo '<div col-container>

  <div class="property_type_message ">

  </div>

  			<div id="col-right">
				<div class="col-wrap">';
  $myListTable->display();

  echo '		</div>
  			</div>
  			<div id="col-left">
				<div class="col-wrap">




					<div class="form-wrap">
						<h3 class="add_edit_type_formtitle"><span class="title">Add New Property Type</span>
							<a href="javascript:void(0)" class="add-new-h2 add_new_type_form">Add New</a>
						</h3>
						<form id="frm_property_type" method="post" action="" class="validate">
							<!-- <input type="hidden" name="action" value="">
							<input type="hidden" name="screen" value="edit-property_amenity">
							<input type="hidden" name="custom_field_name" value="property_amenity">
							<input type="hidden" name="post_type" value="residential-property">
							<input type="hidden" id="_wpnonce_add-tag" name="_wpnonce_add-tag" value="781a607a1b">
							<input type="hidden" name="_wp_http_referer" value="/marvel/wp-admin/edit-tags.php?taxonomy=property_amenity&amp;post_type=residential-property"> -->

							<input type="hidden" name="edit_id" id="edit_id"  value="" />
							<div class="form-field form-required term-name-wrap">
								<label for="tag-name">Type</label>
								<input name="new-property-type" id="new-property-type" type="text" value="" size="40" aria-required="true">
								<p><!-- The name is how it appears on your site. --></p>
							</div>';
							/* <div class="form-field term-slug-wrap">
								<label for="tag-slug">Number Of Bedrooms</label>
								<input name="new-property-bedrooms" id="new-property-bedrooms" class="allownumericwithdecimal"  type="text" value="" size="40" >
								<p><!-- The “slug” is the URL-friendly version of the name.
								It is usually all lowercase and contains only letters, numbers, and hyphens. --></p>
							</div> */



		echo'				<p class="submit">
								<input type="button" name="add_new_property_type" id="add_new_property_type"
								class="button button-primary save_property_type" value="Save">
								<input type="button" name="cancel_edit_property_type" id="cancel_edit_property_type"
								class="button cancel_edit_property_type" value="Cancel" style="display:none">
							</p><br>

						</form>
				</div>







				</div>
			</div>

  		</div>  ';
  echo '<input type="hidden" name="custom_field_name" id="custom_field_name" value="residential-property-type" /> ';
  echo '</div>';

}




/*

function register_my_custom_submenu_page() {
//  add_submenu_page( 'tools.php', 'My Custom Submenu Page', 'My Custom Submenu Page', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' );
  add_submenu_page( 'edit.php?post_type=residential-property', 'Residential Properties Settings', 'Residential Properties Settings', 'manage_options', 'residential-properties-settings', 'my_custom_submenu_page_callback' );
}
add_action('admin_menu', 'register_my_custom_submenu_page');
*/


function save_property_type(){

	//$num_bedrooms 		= $_REQUEST['data']['num_bedrooms'];
	$property_type 		= $_REQUEST['data']['property_type'];
	$property_edit_id 	= $_REQUEST['data']['edit_id'];

	$current_property_types = maybe_unserialize(get_option('residential-property-type'));

	//$new_property_type['number_bedrooms'] 	= $num_bedrooms;
	$new_property_type['property_type'] 	= $property_type;


	if($property_edit_id!=''){
		$new_property_type['ID'] = $property_edit_id;

		foreach ($current_property_types['property_types'] as $key => $value) {

			if($property_edit_id == $value['ID']){
					$updated_new_property_types[$key] = $new_property_type;
			}
			else{
					$updated_new_property_types[$key] = $value;
			}

		}

		$updated_new_max_property_type = $current_property_types['max_property_types'];

	}
	else{
			if(!isset($current_property_types['max_property_types'])){

				$new_property_type['ID'] = 1;
				$current_property_types ['property_types'] = array();
			}
			else if(count($current_property_types['max_property_types'])<=0 || $current_property_types==false ){

				$new_property_type['ID'] = 1;
				$current_property_types ['property_types'] = array();

			}
			else{

				/*$current_max_property_id = 0;
				foreach ($current_property_types as $key => $value) {
					if($value['ID']>$current_max_property_id){
					 	$current_max_property_id = $value['ID'];
					}
				}
				$new_property_type['ID']  = $current_max_property_id + 1 ;	*/

				$new_property_type['ID'] = $current_property_types['max_property_types'] + 1;
			}

			if(!is_array($current_property_types['property_types'])){
				$current_property_types['property_types'] = array();
			}

			$updated_new_property_types =    $current_property_types['property_types'];
			$updated_new_property_types[] = $new_property_type ;
			$updated_new_max_property_type = $new_property_type['ID'];
	}



	$result = update_option('residential-property-type',maybe_serialize(array('max_property_types' => $updated_new_max_property_type,
																			  'property_types'     => $updated_new_property_types
																		)));

	if($result==false){
		$current_property_types = maybe_unserialize(get_option('residential-property-type'));
	}

	wp_send_json(array('success' => $result, 'ID'=>$new_property_type['ID'], 'data'=>$updated_new_property_types));

}
add_action( 'wp_ajax_save_property_type', 'save_property_type' );




function delete_property_type(){

	$property_type_id = $_REQUEST['data']['type_id'];
	$current_property_types = maybe_unserialize(get_option('residential-property-type'));

	$found_del_type = false ;

	foreach ($current_property_types['property_types'] as $key => $value) {
		 if($value['ID']!=$property_type_id ){

		 	$updated_property_types [] = $value ;
		 }
		 else if($value['ID']==$property_type_id ){
			 $found_del_type = true ;
		 }

	}

	$updated_new_property_types =  array('max_property_types' => $current_property_types['max_property_types'],
									 'property_types'	  => $updated_property_types);

	update_option('residential-property-type',maybe_serialize($updated_new_property_types));

	wp_send_json(array('success'=>true,'types'=>$updated_property_types ));
}
add_action( 'wp_ajax_delete_property_type', 'delete_property_type' );



function get_property_type_option(){

	global $wpdb;

	$current_property_types = maybe_unserialize(get_option('residential-property-type'));

	if(isset($current_property_types['property_types'])){
		wp_send_json(maybe_unserialize($current_property_types['property_types']));
	}
	else{
		wp_send_json(array() );
	}



}
add_action( 'wp_ajax_get_property_type_option', 'get_property_type_option' );

















function delete_property_type_row() {

	$property_id   		= $_REQUEST['data']['property_id'];
	$property_type 		= $_REQUEST['data']['property_type'];


	$delete_success = false;

	  $custom_file_field_value = maybe_unserialize( get_post_meta($property_id,'residential-property-type',true) );


	  if($custom_file_field_value!=false and is_array($custom_file_field_value)){



	  	foreach ($custom_file_field_value as $key => $value) {

	  		$data = maybe_unserialize($value);


	  		if($data['type'] == $property_type){

	  				if($data['layout_image']!='')
	  					$result_delete_attachment = wp_delete_attachment($data['layout_image']);
	  				if($data['layout_pdf']!='')
				  		$result_delete_attachment = wp_delete_attachment($data['layout_pdf']);

	  		}
	  		else{
	  			$updated_data[] = $value;
	  		}


	  	}
	  	

	}

	update_post_meta($property_id,'residential-property-type',$updated_data);
    wp_send_json($delete_success);


}
add_action( 'wp_ajax_delete_property_type_row', 'delete_property_type_row' );

?>