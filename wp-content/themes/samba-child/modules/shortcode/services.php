<?php
function  services_properties_rent_resale(){


    global $wpdb;

    $table_name ="  `table 25`  ";
    $qry_get_rent_resale_data = " SELECT * FROM ".$table_name." WHERE   type like 'resale' ORDER BY Project_Name   ";
    $res_get_rent_resale_data = $wpdb->get_results($qry_get_rent_resale_data,ARRAY_A);

    $rent_cost_header = "Cost";





    $pids                    = array();
    $all_cities              = array();
    $all_areas               = array();
    $all_no_of_bedrooms      = array();
    $all_punecity_localities = array();
    $all_punecity_bedrooms   = array();


    foreach ($res_get_rent_resale_data as $result_data) {
        $all_cities[]           = $result_data['City'];
        $all_areas[]            = $result_data['Area'];
        $all_no_of_bedrooms[]   = $result_data['No_of_Bedrooms'];
        $all_no_of_rooms[]      = $result_data['No_of_Rooms'];
        if(strtolower($result_data['City']) == "pune")
            $all_punecity_localities[] = $result_data['Area'];
            $all_punecity_bedrooms[] = $result_data['No_of_Bedrooms'];
        }



    $uniq_cities                = array_unique($all_cities);
    $uniq_areas                 = array_unique($all_areas); //localities
    $uniq_no_of_bedrooms        = array_unique($all_no_of_bedrooms);
    $punecity_localities        = array_unique($all_punecity_localities);
    $punecity_bedroooms         = array_unique($all_punecity_bedrooms);

    sort($uniq_cities);

    $pune_city_property_exists = false;
    foreach ($uniq_cities as $key_ => $value_) {

        if(strtolower($value_)=="pune")
            $pune_city_property_exists = true ;

    }

//$res = array_search(strtolower('Pune'), array_map('strtolower', $uniq_cities));
//var_dump($res);

if($pune_city_property_exists==true){
    sort($punecity_localities);
    sort($punecity_bedroooms);

    $dropdown_localities = $punecity_localities;
    $dropdown_bedrooms = $punecity_bedroooms;

    $qry_count_properties = " SELECT  count(DISTINCT Project_Name) as pune_city_cnt FROM ".$table_name."  WHERE City ='Pune' and type = 'resale'  ";
    $city_properties_cnt = $wpdb->get_var($qry_count_properties);
}
else {

sort($uniq_areas);
sort($uniq_no_of_bedrooms);

    $dropdown_localities = $uniq_areas;
    $dropdown_bedrooms = $uniq_no_of_bedrooms;

    $qry_count_properties = " SELECT  count(DISTINCT Project_Name) as pune_city_cnt FROM ".$table_name."  WHERE   type = 'resale'  ";
    $city_properties_cnt = $wpdb->get_var($qry_count_properties);
}


?>



<!--Careers Bottom content-->
                <!--Careers Bottom content-->
               <!--  <a class="wpb_button_a" href="#">
                    <span class="wpb_button  wpb_btn-inverse wpb_regularsize view_properties_resale">View Properties on Resale</span>
                </a>
                <a class="wpb_button_a" href="#">
                    <span class="wpb_button  wpb_btn-inverse wpb_regularsize view_properties_rent">View Properties on Rent</span>
                </a> -->

              <div id="spn_services_div" class="vc_separator wpb_content_element vc_separator_align_center vc_el_width_100 vc_sep_dashed vc_sep_color_white services_properties_h4">
                     <span class="vc_sep_holder vc_sep_holder_l">
                        <span class="vc_sep_line"></span>
                    </span>
                    <h4>Properties on Resale</h4>
                    <span class="vc_sep_holder vc_sep_holder_r">
                        <span class="vc_sep_line"></span>
                    </span>
              </div>



                <div class="vc_row-fluid full-width totally-full-width">
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
                                <select id="dd_city" class="services_dd_city" >
                                    <option value="">City</option>
                                    <?php
                                    foreach ($uniq_cities  as $city_val) {
                                        ?><option value="<?php echo $city_val; ?>" <?php if(strtolower($city_val)=="pune") { echo " selected "; }; ?>><?php echo $city_val;?></option><?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="top-dd thr">
                                <select id="dd_locality" class="services_dd_locality" >
                                    <option value="">Locality</option>
                                    <?php
                                    foreach ($dropdown_localities   as $locality_val) {
                                        if(!empty($locality_val)) {?><option value="<?php echo $locality_val; ?>"  ><?php echo $locality_val;?></option><?php } ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="top-dd fou">
                                <select id="dd_type" class="services_dd_type" >
                                    <option value="">No. of Bedrooms</option>
                                     <?php
                                    foreach ($dropdown_bedrooms  as $bedrooms_val) {
                                        ?><option value="<?php echo $bedrooms_val; ?>"  ><?php echo $bedrooms_val;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="top-sea">
                                <button type="submit" class="btn_norm sea"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="top-note services_top_note">
                                <?php /* <p>Note: Minimum deposit of 10 months has to be given prior to taking flat for rent.</p> */ ?>
<!--
                                <a href="#" class="top_list current"><i class="fa fa-th-large"></i></a>
                                <a href="#" class="top_map"><i class="fa fa-map-marker"></i></a>
-->
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>







                <div class="prk_inner_block vc_row-fluid centered columns">
                    <div class="row">
                        <div class="vc_col-sm-12 wpb_column vc_column_container serices_properties_heading">
                            <h5>Residential Projects On Resale <span class="spn_title_city"><?php if($pune_city_property_exists==true) { echo  " in Pune "; } ?> </span> <span class="spn_title_property_cnt">(<?php echo $city_properties_cnt; ?>)</span></h5>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="services_project_type"  id="services_project_type"  value="resale" />
                <div id="services_properties_listings">



                <?php
                $current_project = '';
                foreach ( $res_get_rent_resale_data as $key_rent_resale => $value_rent_resale) {
                    # code...
                    if ($value_rent_resale['type']=='resale' && strtolower($value_rent_resale['City']) == "pune") {

                        //echo "<br/> <h2> CURRENT PROJECT NAME: ".$current_project."</h2>";
                        //echo "<br/> <h2> NEW PROJECT NAME : ".$value_rent_resale['Project_Name']."</h2>";


                        if($current_project !='' &&  (strcasecmp($current_project,$value_rent_resale['Project_Name'])!==0) ){
                           // echo "<h3> END MAIN PROJECT DIV</h3>";
                        ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php
                        }

                        if($current_project !='' &&  (strcasecmp($current_project,$value_rent_resale['Project_Name'])===0) ){
                            //echo "<h3> CONTINUE MAIN PROJECT DIV</h3>";
                            ?>

                                                <div class="top_inner t_i_body">
                                                    <div class="set">
                                                        <big><?php echo $value_rent_resale['Building']; ?> <?php echo $value_rent_resale['Floor']; ?></big>
                                                    </div>
                                                    <div class="set">
                                                        <big><?php echo $value_rent_resale['Area_Sq_ft']; ?></big>
                                                    </div>
                                                    <div class="set">
                                                        <big><?php echo $value_rent_resale['No_of_Rooms']; ?></big>
                                                    </div>
                                                    <div class="set rent">
                                                       <?php if($value_rent_resale['Rental_Value_Unfurnished']!='') { ?> <big><?php echo $value_rent_resale['Rental_Value_Unfurnished']; ?></big><small> - Unfurnished</small><?php } ?>
                                                       <?php if($value_rent_resale['Rental_Value_Furnished']!=''){ ?> <big><?php echo $value_rent_resale['Rental_Value_Furnished']; ?></big><small> - Furnished</small><?php } ?>
                                                    </div>
                                                    <div class="set alrt">
                                                        <a href="#" class="wpb_button enq_ico"><span project-name="<?php echo $current_project; ?>" project-area="<?php echo $value_rent_resale['Area_Sq_ft']; ?>"   project-rooms="<?php echo $value_rent_resale['No_of_Rooms']; ?>"
                                                            building-floor="<?php echo $value_rent_resale['Building']; ?> <?php echo $value_rent_resale['Floor']; ?>" class="wpb_button wpb_btn-inverse wpb_regularsize popmake-services-enquiry"></span></a>
                                                    </div>
                                                </div>
                            <?php

                        }
                        else if($current_project =='' || (strcasecmp($current_project,$value_rent_resale['Project_Name'])!==0) ){
                            $current_project = $value_rent_resale['Project_Name'];
                            //echo "<h1> New Project </h1>";


                ?>

                        <div class="prk_inner_block vc_row-fluid centered columns forent">
                            <div class="row partintro">
                                <div class="vc_col-sm-12 wpb_column vc_column_container bgrey">
                                    <div class="wpb_wrapper img_hold" style="background-image: url(<?php echo site_url()."/wp-content/themes/samba-child/services-images/".$value_rent_resale['Image_File_Name']; ?>);">
                                        <div class="clearfix"></div>
                                        <div class="work_cont">
                                            <!-- <img src="<?php //echo site_url()."/wp-content/themes/samba-child/services-images/".$value_rent_resale['Image_File_Name']; ?>"> -->
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
                                                <span class="title"><?php echo $value_rent_resale['Project_Name']; ?></span>
                                                <span class="divi">|</span>
                                                <span class="loca"><?php echo $value_rent_resale['Area']; ?></span>
                                            </a>
                                            <p class="excerpt">
                                                <?php echo $value_rent_resale['Flat_Description']; ?>
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
                                                        <small class="clr_lt"><?php echo $rent_cost_header ; ?></small>
                                                    </div>
                                                    <div class="set">

                                                    </div>
                                                </div>
                                                <div class="top_inner t_i_body">
                                                    <div class="set">
                                                        <big><?php echo $value_rent_resale['Building']; ?> <?php echo $value_rent_resale['Floor']; ?></big>
                                                    </div>
                                                    <div class="set">
                                                        <big><?php echo $value_rent_resale['Area_Sq_ft']; ?></big>
                                                    </div>
                                                    <div class="set">
                                                        <big><?php echo $value_rent_resale['No_of_Rooms']; ?></big>
                                                    </div>
                                                    <div class="set rent">
                                                       <?php if($value_rent_resale['Rental_Value_Unfurnished']!='') { ?> <big><?php echo $value_rent_resale['Rental_Value_Unfurnished']; ?></big><small> - Unfurnished</small><?php } ?>
                                                       <?php if($value_rent_resale['Rental_Value_Furnished']!=''){ ?> <big><?php echo $value_rent_resale['Rental_Value_Furnished']; ?></big><small> - Furnished</small><?php } ?>
                                                    </div>
                                                    <div class="set alrt">
                                                        <a href="#" class="wpb_button enq_ico"><span  project-name="<?php echo $current_project; ?>"  project-area="<?php echo $value_rent_resale['Area_Sq_ft']; ?>"   project-rooms="<?php echo $value_rent_resale['No_of_Rooms']; ?>"
                                                        building-floor="<?php echo $value_rent_resale['Building']; ?> <?php echo $value_rent_resale['Floor']; ?>"  class="wpb_button wpb_btn-inverse wpb_regularsize  popmake-services-enquiry"></span></a>
                                                    </div>
                                                </div>


            <?php
                    }
                }
            }
            ?>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
            </div>



<?php

}
add_shortcode('services_properties_rent_resale', 'services_properties_rent_resale');



function get_services_properties($rent_resale='rent',$city='',$locality='',$no_bedrooms=''){

    global $wpdb;
    $table_name = " `table 25` ";
    // echo 'CITY'.$city;

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

    if(isset($_REQUEST['data']['type'])) {
        if($_REQUEST['data']['type']!='')
            $rent_resale = $_REQUEST['data']['type'];

    }

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


