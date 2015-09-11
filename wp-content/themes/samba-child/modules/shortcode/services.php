<?php
function  services_properties_rent_resale(){


    global $wpdb;

    $table_name ="  `table 25`  ";
    $qry_get_rent_resale_data = " SELECT * FROM ".$table_name." WHERE   type like 'resale' ORDER BY Project_Name   ";
    $res_get_rent_resale_data = $wpdb->get_results($qry_get_rent_resale_data,ARRAY_A);

    $rent_cost_header = "Cost (INR)";





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
                                                        <a href="javascript:void(0)" class="wpb_button enq_ico"><span project-name="<?php echo $current_project; ?>" project-area="<?php echo $value_rent_resale['Area_Sq_ft']; ?>"   project-rooms="<?php echo $value_rent_resale['No_of_Rooms']; ?>"
                                                                rent-resale-type="<?php echo $value_rent_resale['type'] ?>"  building-floor="<?php echo $value_rent_resale['Building']; ?> <?php echo $value_rent_resale['Floor']; ?>" class="wpb_button wpb_btn-inverse wpb_regularsize popmake-services-enquiry"></span></a>
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
                                                <span class="loca"><?php 

                                                echo $value_rent_resale['Area']; 
                                                    if(isset($value_rent_resale['City']) && $value_rent_resale['City']!='')
                                                    echo ", ".$value_rent_resale['City']; ?>
                                                </span>
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
                                                        <small class="clr_lt">Area (Sq. Ft.)</small>
                                                    </div>
                                                    <div class="set">
                                                        <small class="clr_lt">Type</small>
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
                                                        <a href="javascript:void(0)" class="wpb_button enq_ico"><span  project-name="<?php echo $current_project; ?>"  project-area="<?php echo $value_rent_resale['Area_Sq_ft']; ?>"   project-rooms="<?php echo $value_rent_resale['No_of_Rooms']; ?>"
                                                           rent-resale-type="<?php echo $value_rent_resale['type'] ?>"  building-floor="<?php echo $value_rent_resale['Building']; ?> <?php echo $value_rent_resale['Floor']; ?>"  class="wpb_button wpb_btn-inverse wpb_regularsize  popmake-services-enquiry"></span></a>
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













function sap_availability_table_shortcode(){
global $wpdb;

$queried_object = get_queried_object();

$post = get_post($queried_object->ID);

$plant_id = get_post_meta($post->ID,'property-plant-id',true);

    $data = get_sap_data();

    $upload_dir = wp_upload_dir();
    $plan_url = $upload_dir['baseurl'].'/floor-plans/';
    $plan_path = $upload_dir['basedir'].'/floor-plans/';
    

    $tabs = array();

    $areas = array();

    $plans = array();

    $buildings = array();

    $flats = array();
        
    foreach($data as $record){
       
       //Generating Tabs data
         if (!array_key_exists($record['mkt_group_desc'],$tabs)){
            $tabs[$record['mkt_group_desc']] = array();
         }

         if (!in_array($record['mkt_material_type_desc'], $tabs[$record['mkt_group_desc']])) {
         array_push($tabs[$record['mkt_group_desc']],$record['mkt_material_type_desc']);
         }


         //Generating Areas data
         if (!array_key_exists($record['mkt_group_desc'],$areas)){
            $areas[$record['mkt_group_desc']] = array();
         }

         if (!array_key_exists($record['mkt_material_type_desc'],$areas[$record['mkt_group_desc']])) {
          $areas[$record['mkt_group_desc']][$record['mkt_material_type_desc']] = array();
         }


         if (!in_array($record['total_saleable_area'], $areas[$record['mkt_group_desc']][$record['mkt_material_type_desc']])) {
         array_push($areas[$record['mkt_group_desc']][$record['mkt_material_type_desc']],$record['total_saleable_area']);
         }



         //Generating Plans data
         if (!array_key_exists($record['mkt_group_desc'],$plans)){
            $plans[$record['mkt_group_desc']] = array();
         }

         if (!array_key_exists($record['mkt_material_type_desc'],$plans[$record['mkt_group_desc']])) {
          $plans[$record['mkt_group_desc']][$record['mkt_material_type_desc']] = $record['common_floor_plan'];
         }


         //Generating Buildings data
         if (!array_key_exists($record['mkt_group_desc'],$buildings)){
            $buildings[$record['mkt_group_desc']] = array();
         }

         if (!array_key_exists($record['mkt_material_type_desc'],$buildings[$record['mkt_group_desc']])) {
          $buildings[$record['mkt_group_desc']][$record['mkt_material_type_desc']] = array();
         }

         if (!in_array($record['building_no'], $buildings[$record['mkt_group_desc']][$record['mkt_material_type_desc']])) {
         array_push($buildings[$record['mkt_group_desc']][$record['mkt_material_type_desc']],$record['building_no']);
         }


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
         $flats[$record['mkt_group_desc']][$record['mkt_material_type_desc']][$record['building_no']][$record['flat_no']] = array('area'=>$record['act_area'],'terrace_area'=>$record['terrace_area'],'saleable_area'=>$record['saleable_area'],'total_saleable_area'=>$record['total_saleable_area'],'floor_plan'=>$record['specific_floor_plan'],'status'=>$record['status_desc']);
         }
    }



    /*echo "<pre>";
    print_r($plans);
    echo "</pre>";*/

$html = '<div id="content">';
$html .= '<div id="main" role="main" class="main_with_sections with_title">';
$html .= '<div class="vc_row">';
$html .= '<div class="vc_column">';
$html .= '<div class="wpb_tabs wpb_content_element floorplans_tab" data-interval="0">';
$html .= '<div class="tabb y wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix ui-widget ui-widget-content ui-corner-all">';


/****************
***************Tabs***************
**************/
$html .= '<ul class="wpb_tabs_nav ui-tabs-nav vc_clearfix ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">';
$html .= ' <li><a href="#tab-siteplan" class="standout">SITE PLAN</a></li>';

if(array_key_exists('R1',$tabs)){
    asort($tabs['R1']);
    foreach($tabs['R1'] as $key=>$value){
        $html .= '<li><a href="#tab-R1'.str_replace(".","",$value).'">'.$value.' BHK</a></li>';
    }
}

if(array_key_exists('R4',$tabs)){
    asort($tabs['R4']);
    foreach($tabs['R4'] as $key=>$value){
        $html .= '<li><a href="#tab-R4'.str_replace(".","",$value).'">'.$value.' BHK '.get_flat_type('R4').'</a></li>';
    }
}

if(array_key_exists('R2',$tabs)){
    asort($tabs['R2']);
    foreach($tabs['R2'] as $key=>$value){
        $html .= '<li><a href="#tab-R2'.str_replace(".","",$value).'">'.$value.' BHK '.get_flat_type('R2').'</a></li>';
    }
}

if(array_key_exists('R3',$tabs)){
    asort($tabs['R3']);
    foreach($tabs['R3'] as $key=>$value){
        $html .= '<li><a href="#tab-R3'.str_replace(".","",$value).'">'.$value.' BHK '.get_flat_type('R3').'</a></li>';
    }
}

if(array_key_exists('R5',$tabs)){
    asort($tabs['R5']);
    foreach($tabs['R5'] as $key=>$value){
        $html .= '<li><a href="#tab-R5'.str_replace(".","",$value).'">'.$value.' BHK '.get_flat_type('R5').'</a></li>';
    }
}

if(array_key_exists('O1',$tabs)){
    asort($tabs['O1']);
    foreach($tabs['O1'] as $key=>$value){
        $html .= '<li><a href="#tab-O1'.str_replace(".","",$value).'">'.$value.' BHK '.get_flat_type('O1').'</a></li>';
    }
}

if(array_key_exists('O2',$tabs)){
    asort($tabs['O2']);
    foreach($tabs['O2'] as $key=>$value){
        $html .= '<li><a href="#tab-O2'.str_replace(".","",$value).'">'.$value.' BHK '.get_flat_type('O2').'</a></li>';
    }
}

if(array_key_exists('O3',$tabs)){
    asort($tabs['O3']);
    foreach($tabs['O3'] as $key=>$value){
        $html .= '<li><a href="#tab-O3'.str_replace(".","",$value).'">'.$value.' BHK '.get_flat_type('O3').'</a></li>';
    }
}

if(array_key_exists('Co',$tabs)){
    asort($tabs['Co']);
    foreach($tabs['Co'] as $key=>$value){
        $html .= '<li><a href="#tab-Co'.str_replace(".","",$value).'">'.$value.' BHK '.get_flat_type('Co').'</a></li>';
    }
}

$html .= '</ul>';


/****************
***************Layout and Availability head***************
**************/

$site_plan_id = maybe_unserialize(get_post_meta($post->ID, 'custom_property-siteplan', true));
$plan_source = wp_get_attachment_image_src( $site_plan_id['image_id'], 'full' );

if (@getimagesize($plan_source[0])) {
    $site_plan = $plan_source[0];
}else{
  $site_plan = get_stylesheet_directory_uri().'/img/image-not-found_smaller.jpg';
}

$html .= '<div id="tab-siteplan" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix ui-widget-content ui-corner-bottom">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Site Plan of '.$post->post_title.'
                                            <a class="wpb_button_a download_prj" title="Download" href="'.$plan_source[0].'" download>
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">
                                    <div class="wpb_wrapper">
                                        <a class="image-popup-no-margins boxed_shadow" href="'.$plan_source[0].'" target="_self">
                                            <img width="700" height="561" src="'.$plan_source[0].'" class=" vc_box_border_grey attachment-full" alt="layout" />
                                        </a>
                                    </div>
                                </div>
                            </div>';

foreach($tabs as $tabkey=>$tabvalue){
    foreach($tabvalue as $key=>$value){
        $tab_id = $tabkey.str_replace(".","",$value);
        $min_area = min($areas[$tabkey][$value]);
        $max_area = max($areas[$tabkey][$value]);
        $common_floor_plan = $plan_url.$plans[$tabkey][$value];
        $common_floor_plan_path = $plan_path.$plans[$tabkey][$value];
          
        if(file_exists($common_floor_plan_path.'.jpg')){
            $common_plan = $common_floor_plan.'.jpg';
        }else{
           $common_plan = get_stylesheet_directory_uri().'/img/image-not-found_smaller.jpg';
        }

        if(file_exists($common_floor_plan_path.'.pdf')){
            $common_plan_pdf = $common_floor_plan.'.pdf';
        }else{
           $common_plan_pdf = get_stylesheet_directory_uri().'/img/image-not-found_smaller.jpg';
        }

        if($min_area == $max_area){
        $area = $min_area.' sq. ft';
        }else{
           $area = $min_area.' sq. ft. to '.$max_area.' sq. ft.';  
        }

        
        $html .= '<div id="tab-'.$tab_id.'" class="wpb_tab ui-tabs-panel wpb_ui-tabs-hide ui-widget-content vc_clearfix">';

        $html .= '<div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p style="text-align: center;">
                                            Typical floor plan of a '.$value.' BHK '.get_flat_type($tabkey).' &#8211; '.$area.'
                                            <a class="wpb_button_a download_prj" title="Download" href="'.$common_plan_pdf.'" download>
                                                <span class="wpb_button  wpb_wpb_button wpb_btn-small wpb_document_pdf sep">Download <i class="icon"> </i></span>
                                            </a>
                                        </p>
                                        <p class="btncol">
                                            <a class="wpb_button_a ava_tog curr" title="2D Layout" href="#lay_'.$tab_id.'"><span class="wpb_button  wpb_btn-inverse tog white">2D Layout</span></a>
                                            <a class="wpb_button_a ava_tog" title="Availability" href="#ava_'.$tab_id.'"><span class="wpb_button  wpb_btn-inverse tog">Availability</span></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="lay_'.$tab_id.'" class="inner-panels wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center current">
                                    <div class="wpb_wrapper">
                                        <a class="image-popup-no-margins boxed_shadow" href="'.$common_plan.'" target="_self">
                                            <img width="700" height="561" src="'.$common_plan.'" alt="layout" />
                                        </a>
                                    </div>
                                </div>';
        $html .='<div id="ava_'.$tab_id.'" class="inner-panels avatab wpb_content_element wpb_animate_when_almost_visible wpb_bottom-to-top vc_align_center">';
        $html .='<div class="wpb_wrapper">';
                                        
        $html .='<div class="top_head">
                     <div class="pull-left">
                        <span class="box white_bg"></span>
                        <span class="text">Available</span>
                        <span class="box blue_bg"></span>
                        <span class="text">Sold</span>
                        <span class="box hold_bg"></span>
                        <span class="text">Hold</span>
                    </div>
                    <div class="pull-right">
                        <h6>Click on the available flat to request a hold.</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>';

        $html .= '<div class="tabular_c" style="">';
        
        $html .= '<div class="left" style="display: none;">
                    <i class="fa fa-chevron-left"></i>
                </div>
                <div class="right active" style="display: none;">
                    <i class="fa fa-chevron-right"></i>
                </div>';

        
        
    $html .= '<div class="clearfix"></div>';

    $html .= '<div class="table-cover">';
            $html .= '<div class="tabular_c" style="margin-top: 0; border-top: 0;">';                                   
                    $html .= '<div class="left">
                                <i class="fa fa-chevron-left"></i>
                             </div>
                             <div class="right active">
                                <i class="fa fa-chevron-right"></i>
                            </div>';

                $html .= ' <div class="table-holder">';


                foreach($flats[$tabkey][$value] as $building_key=>$building_value){
                    $html .= '<div class="tabul_hold">
                                                    <table border="1">
                                                        <tr>
                                                            <th colspan="2">'.$building_key.'-Flat No. (Sq.Ft.)</th>
                                                        </tr>';

                                                        
                                                        $counter = 0;
                                                        $total = count($building_value)-1;
                                                                                                                
                                                        foreach($building_value as $flat=>$flat_data) {

                                                            $specific_floor_plan = $plan_url.$flat_data['floor_plan'].'.jpg';

                                                            if($flat_data['status'] == 'Unsold'){
                                                                $popdata = 'data-plantId="'.$plant_id.'" data-building="'.$building_key.'" data-flatNo="'.$flat.'" data-flatArea="'.$flat_data['saleable_area'].'" data-terraceArea="'.$flat_data['terrace_area'].'" data-sellableArea="'.$flat_data['total_saleable_area'].'" data-floorPlan="'.$specific_floor_plan.'"';
                                                                $col = '<td '.$popdata.'>'.$building_key.' '.$flat.' ('.$flat_data['total_saleable_area'].')</td>';
                                                            }else if(($flat_data['status'] == 'Hold') || ($flat_data['status'] == 'Land_Owner') || ($flat_data['status'] == 'Management')){
                                                                $col = '<td class="hold_bg">'.$building_key.' '.$flat.' ('.$flat_data['total_saleable_area'].')</td>';
                                                            }else{
                                                               $col = '<td class="blue_bg">'.$building_key.' '.$flat.' ('.$flat_data['total_saleable_area'].')</td>';
                                                             }

                                                            

                                                        if ($counter%2 == 0) {
                                                            $html .= '<tr>'.$col;
                                                            if(($counter>0) && ($counter == $total)){
                                                            $html .= '<td class="blue_bg">&nbsp;</td>';
                                                            }
                                                        } else { 
                                                            $html .= $col.'</tr>';
                                                        }
                                                        $counter++;
                                                        }
                                                        
                                                        

                                                    $html .= '</table>
                            </div>';

                }


                $html .= '</div>';

            $html .= '</div>';    
    $html .= '</div>';            


        $html .= '</div>';

        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';
    }
}


$html .= '<div class="popup_tab_data"></div>';


$html .= '</div>';
$html .= '</div>';






$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';



return $html;
}
add_shortcode('sap-availability-table', 'sap_availability_table_shortcode');









function sap_floor_plans_download_shortcode(){
//global $post;

$queried_object = get_queried_object();

$post = get_post($queried_object->ID);

$plant_id = get_post_meta($post->ID,'property-plant-id',true);

$data = get_sap_data();
    

    $tabs = array();
         
    foreach($data as $record){
       
       //Generating Tabs data
         if (!array_key_exists($record['mkt_group_desc'],$tabs)){
            $tabs[$record['mkt_group_desc']] = array();
         }

         if (!in_array($record['mkt_material_type_desc'], $tabs[$record['mkt_group_desc']])) {
         array_push($tabs[$record['mkt_group_desc']],$record['mkt_material_type_desc']);
         }
    }


$html = '<a class="wpb_button_a" title="All" href="'.get_site_url().'/?action=download_all_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'" target="_blank"><span class="wpb_button  wpb_wpb_button wpb_regularsize">All</span></a>';


if(array_key_exists('R1',$tabs)){
    asort($tabs['R1']);
    foreach($tabs['R1'] as $key=>$value){

        $index = $key+1;
        if((count($tabs['R1']) == $index) && ($index % 2 != 0)){
            $btn_class = '';
        }else{
            if ($index % 2 == 0) {
                $btn_class = 'half right';
            }else{
             $btn_class = 'half left'; 
            }
        }

        $html .= '<a class="wpb_button_a" title="'.$value.' BHK" href="'.get_site_url().'/?action=download_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R1&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize '.$btn_class.'">'.$value.' BHK</span></a>';
    }
}

if(array_key_exists('R4',$tabs)){
    asort($tabs['R4']);
    foreach($tabs['R4'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('R4').'" href="'.get_site_url().'/?action=download_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R4&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('R4').'</span></a>';
    }
}

if(array_key_exists('R2',$tabs)){
    asort($tabs['R2']);
    foreach($tabs['R2'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('R2').'" href="'.get_site_url().'/?action=download_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R2&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('R2').'</span></a>';
    }
}

if(array_key_exists('R3',$tabs)){
    asort($tabs['R3']);
    foreach($tabs['R3'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('R3').'" href="'.get_site_url().'/?action=download_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R3&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('R3').'</span></a>';
    }
}

if(array_key_exists('R5',$tabs)){
    asort($tabs['R5']);
    foreach($tabs['R5'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('R5').'" href="'.get_site_url().'/?action=download_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R5&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('R5').'</span></a>';
    }
}

if(array_key_exists('O1',$tabs)){
    asort($tabs['O1']);
    foreach($tabs['O1'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('O1').'" href="'.get_site_url().'/?action=download_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=O1&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('O1').'</span></a>';
    }
}

if(array_key_exists('O2',$tabs)){
    asort($tabs['O2']);
    foreach($tabs['O2'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('O2').'" href="'.get_site_url().'/?action=download_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=O2&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('O2').'</span></a>';
    }
}

if(array_key_exists('O3',$tabs)){
    asort($tabs['O3']);
    foreach($tabs['O3'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('O3').'" href="'.get_site_url().'/?action=download_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=O3&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('O3').'</span></a>';
    }
}

if(array_key_exists('Co',$tabs)){
    asort($tabs['Co']);
    foreach($tabs['Co'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('Co').'" href="'.get_site_url().'/?action=download_plan&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=Co&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('Co').'</span></a>';
    }
}


return $html;
}
add_shortcode('floor-plans-table', 'sap_floor_plans_download_shortcode');




















function sap_availability_pdf_shortcode(){
$queried_object = get_queried_object();

$post = get_post($queried_object->ID);

$plant_id = get_post_meta($post->ID,'property-plant-id',true);

$data = get_sap_data();

    $tabs = array();
         
    foreach($data as $record){
       
       //Generating Tabs data
         if (!array_key_exists($record['mkt_group_desc'],$tabs)){
            $tabs[$record['mkt_group_desc']] = array();
         }

         if (!in_array($record['mkt_material_type_desc'], $tabs[$record['mkt_group_desc']])) {
         array_push($tabs[$record['mkt_group_desc']],$record['mkt_material_type_desc']);
         }
    }


$html = '<a class="wpb_button_a" title="All" href="'.get_site_url().'/?action=download_all_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'" target="_blank"><span class="wpb_button  wpb_wpb_button wpb_regularsize">All</span></a>';


if(array_key_exists('R1',$tabs)){
    asort($tabs['R1']);
    foreach($tabs['R1'] as $key=>$value){
        $index = $key+1;
        if((count($tabs['R1']) == $index) && ($index % 2 != 0)){
            $btn_class = '';
        }else{
            if ($index % 2 == 0) {
                $btn_class = 'half right';
            }else{
             $btn_class = 'half left'; 
            }
        }

        $html .= '<a class="wpb_button_a" title="'.$value.' BHK" href="'.get_site_url().'/?action=download_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R1&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize '.$btn_class.'">'.$value.' BHK</span></a>';
    }
}

if(array_key_exists('R4',$tabs)){
    asort($tabs['R4']);
    foreach($tabs['R4'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('R4').'" href="'.get_site_url().'/?action=download_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R4&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('R4').'</span></a>';
    }
}

if(array_key_exists('R2',$tabs)){
    asort($tabs['R2']);
    foreach($tabs['R2'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('R2').'" href="'.get_site_url().'/?action=download_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R2&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('R2').'</span></a>';
    }
}

if(array_key_exists('R3',$tabs)){
    asort($tabs['R3']);
    foreach($tabs['R3'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('R3').'" href="'.get_site_url().'/?action=download_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R3&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('R3').'</span></a>';
    }
}

if(array_key_exists('R5',$tabs)){
    asort($tabs['R5']);
    foreach($tabs['R5'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('R5').'" href="'.get_site_url().'/?action=download_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=R5&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('R5').'</span></a>';
    }
}

if(array_key_exists('O1',$tabs)){
    asort($tabs['O1']);
    foreach($tabs['O1'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('O1').'" href="'.get_site_url().'/?action=download_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=O1&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('O1').'</span></a>';
    }
}

if(array_key_exists('O2',$tabs)){
    asort($tabs['O2']);
    foreach($tabs['O2'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('O2').'" href="'.get_site_url().'/?action=download_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=O2&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('O2').'</span></a>';
    }
}

if(array_key_exists('O3',$tabs)){
    asort($tabs['O3']);
    foreach($tabs['O3'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('O3').'" href="'.get_site_url().'/?action=download_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=O3&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('O3').'</span></a>';
    }
}

if(array_key_exists('Co',$tabs)){
    asort($tabs['Co']);
    foreach($tabs['Co'] as $key=>$value){
        $html .= '<a class="wpb_button_a" title="'.$value.' BHK '.get_flat_type('Co').'" href="'.get_site_url().'/?action=download_availability&prop_id='.$post->ID.'&plant_id='.$plant_id.'&m_group=Co&m_type='.$value.'" target="_blank"><span class="wpb_button  wpb_btn-inverse wpb_regularsize">'.$value.' BHK '.get_flat_type('Co').'</span></a>';
    }
}


return $html;
}

add_shortcode('availability-download-table', 'sap_availability_pdf_shortcode');
