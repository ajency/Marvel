<?php 
function  services_properties_rent_resale(){


    global $wpdb;
    $qry_get_rent_resale_data = " SELECT * FROM `table 25` ";
    $res_get_rent_resale_data = $wpdb->get_results($qry_get_rent_resale_data,ARRAY_A);


    $pids = array();
    foreach ($res_get_rent_resale_data as $result_data) {
        $all_cities[]           = $result_data['City'];
        $all_areas[]            = $result_data['Area'];
        $all_no_of_bedrooms[]   = $result_data['No_of_Bedrooms'];
        $all_no_of_rooms[]      = $result_data['No_of_Rooms'];
        if(strtolower($result_data['City']) == "pune")
            $all_punecity_localities[] = $result_data['Area'];
        }    

    $uniq_cities                = array_unique($all_cities);
    $uniq_areas                 = array_unique($all_areas);
    $uniq_no_of_bedrooms        = array_unique($all_no_of_bedrooms);
    $punecity_localities        = array_unique($all_punecity_localities);
      

?>



<!--Careers Bottom content-->
                <!--Careers Bottom content-->
                <div class="vc_row-fluid full-width">
                    <div class="vc_col-sm-12">
                        <div class="top-dd-c">
<!--
                            <div class="top-dd one">
                                <select id="dd_status">
                                    <option>Ongoing</option>
                                    <option>Upcoming</option>
                                </select>
                            </div>
-->
                            <div class="top-dd two">
                                <select id="dd_city"> 
                                    <option value="">City</option>                                   
                                    <?php  
                                    foreach ($uniq_cities  as $city_val) {
                                        ?><option value="<?php echo $city_val; ?>" <?php if(strtolower($city_val)=="pune") { echo " selected "; }; ?>><?php echo $city_val;?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="top-dd thr">
                                <select id="dd_locality"  >
                                    <option value="">Locality</option>
                                    <?php  
                                    foreach ($punecity_localities   as $locality_val) {
                                        if(!empty($locality_val)) {?><option value="<?php echo $locality_val; ?>"  ><?php echo $locality_val;?></option><?php } ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="top-dd fou">
                                <select id="dd_type"  >
                                    <option value="">No. of Bedrooms</option>
                                     <?php  
                                    foreach ($uniq_no_of_bedrooms  as $bedrooms_val) {
                                        ?><option value="<?php echo $bedrooms_val; ?>"  ><?php echo $bedrooms_val;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="top-sea">
                                <button type="submit" class="btn_norm sea"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="top-note">
                                <p>Note: Minimum deposit of 10 months has to be given prior to taking flat for rent.</p>
<!--
                                <a href="#" class="top_list current"><i class="fa fa-th-large"></i></a>
                                <a href="#" class="top_map"><i class="fa fa-map-marker"></i></a>
-->
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>





                <div id="services_properties"></div>


                <div class="prk_inner_block vc_row-fluid centered columns">
                    <div class="row">
                        <div class="vc_col-sm-12 wpb_column vc_column_container">
                            <h5>Residential Projects on Rent in Pune (3)</h5>
                        </div>
                    </div>
                </div>
                <div class="prk_inner_block vc_row-fluid centered columns forent">
                    <div class="row partintro">
                        <div class="vc_col-sm-12 wpb_column vc_column_container bgrey">
                            <div class="wpb_wrapper img_hold">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <img src="http://loremflickr.com/1000/457/luxury,house">
                                    <div class="forent_cap">Sample Flat</div>
                                </div>
                            </div>
<!--
                        </div>
                        <div class="vc_col-sm-6 wpb_column vc_column_container ">
-->
                            <div class="wpb_wrapper introtext">
                                <div class="clearfix"></div>
                                <div class="work_cont">
                                    <a href="#" class="proj_title">
                                        <span class="title">Marvel Diva</span>
                                        <span class="divi">|</span>
                                        <span class="loca">Magarpatta Road</span>
                                    </a>
                                    <p class="excerpt">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row list_forent">
                        <div class="vc_col-sm-12 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="clearfix"></div>
                                <div class="work_cont tab_con">
                                    <div class="top-tab">
                                       <div class="top_inner t_i_head">
                                            <div class="set">
                                                <small class="clr_lt">Building | Floor</small>
                                            </div>
                                            <div class="set">
                                                <small class="clr_lt">Area (SQ.FT.)</small>
                                            </div>
                                            <div class="set">
                                                <small class="clr_lt">No. Of Rooms</small>
                                            </div>
                                            <div class="set rent">
                                                <small class="clr_lt">Rent (Rs./Month)</small>
                                            </div>
                                            <div class="set">
                                                
                                            </div>
                                        </div>
                                        <div class="top_inner t_i_body">
                                            <div class="set">
                                                <big>D 10</big>
                                            </div>
                                            <div class="set">
                                                <big>2,155</big>
                                            </div>
                                            <div class="set">
                                                <big>3.5 BHK</big>
                                            </div>
                                            <div class="set rent">
                                                <big>45,000</big><small> - Unfurnished</small>
                                            </div>
                                            <div class="set alrt">
                                                <a href="#" class="wpb_button enq_ico"><span class="wpb_button wpb_btn-inverse wpb_regularsize"></span></a>
                                            </div>
                                        </div>
                                        
                                        <div class="top_inner t_i_body">
                                            <div class="set">
                                                <big>D 10</big>
                                            </div>
                                            <div class="set">
                                                <big>2,155</big>
                                            </div>
                                            <div class="set">
                                                <big>3.5 BHK</big>
                                            </div>
                                            <div class="set rent">
                                                <big>45,000</big><small> - Unfurnished</small>
                                            </div>
                                            <div class="set alrt">
                                                <a href="#" class="wpb_button enq_ico"><span class="wpb_button wpb_btn-inverse wpb_regularsize"></span></a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                    <div class="clearfix"></div>
                </div>
                

<?php

}
add_shortcode('services_properties_rent_resale', 'services_properties_rent_resale');



function get_services_properties($rent_resale='rent',$city='',$locality='',$no_bedrooms=''){

global $wpdb;
$table_name = " `table 25` ";
 echo 'CITY'.$city;

$where_sql =" WHERE type ='".$rent_resale."' ";

if($city!='') {     
    $where_sql.=" and City = '".$city."'";
}


if($locality!='') {    
    $where_sql.=" and Area = '".$locality."'";
}


if($no_bedrooms!='') {    
    $where_sql.=" and No_of_Bedrooms = '".$no_bedrooms."'";
}

$qry_get_services_properties = "SELECT * FROM ".$table_name." ".$where_sql;
 

$res_get_services_properties = $wpdb->get_results($qry_get_services_properties,ARRAY_A);


return $res_get_services_properties;


}


function get_services_properties_ajx(){

    $no_bedrooms = '';
    $city = '';
    $locality='';
    $no_bedrooms = '';

     /* if(isset($_REQUEST['type_rent_resale'])){
        $rent_resale = $_REQUEST['type_rent_resale'];
     } 

     var_dump($_REQUEST);*/ 

    $rent_resale = 'rent';
    if(isset($_REQUEST['data']['city'])) {
        $city = $_REQUEST['data']['city'];
        
    } 

    if(isset($_REQUEST['data']['locality'])) {
        $locality = $_REQUEST['data']['locality'];     
    }


    if(isset($_REQUEST['data']['no_bedrooms'])) {
        $no_bedrooms = $_REQUEST['data']['no_bedrooms'];
         
    }

    $res_get_services_properties = get_services_properties($rent_resale,$city,$locality,$no_bedrooms);

    wp_send_json( $res_get_services_properties);

}
add_action( 'wp_ajax_get_services_properties_ajx', 'get_services_properties_ajx' );
add_action('wp_ajax_nopriv_get_services_properties_ajx', 'get_services_properties_ajx');
 

?>                


