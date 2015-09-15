jQuery(document).ready(function($) {



	$('.btm_unit_type_btn').live("click",function(evt){

		var tab_link = $(this).attr('tab-link')
		/* --  console.log(' tab link '+tab_link) */
		$(this).closest('.floorplans_tab').find('.ui-tabs-nav').find('a[href="'+tab_link+'"]').click();

		/* console.log('clicking tab manually')
		console.log($(this).closest('.floorplans_tab').find('.ui-tabs-nav').length)
		console.log($(this).closest('.floorplans_tab').find('.ui-tabs-nav').find('a[href="'+tab_link+'"]').length)
		console.log($(this).closest('.floorplans_tab').find('.ui-tabs-nav').find("a[href='"+tab_link+"']").html()) */
	})




	$('.ui-tabs-anchor').live("click",function(evt){


        var current_tab_id_link = $(this).attr('href');

        var current_tab_id=current_tab_id_link.replace('#','');

        var prev_tab = $(this).parent().prev('li').find('.ui-tabs-anchor');
        var next_tab = $(this).parent().next('li').find('.ui-tabs-anchor');
       /* console.log(prev_tab.attr('href'))
        console.log(prev_tab.html()) */

        var btm_foot_html ="<p> Check availability in other unit types.";

        if(prev_tab.length>0 && prev_tab.attr('href')!=="#tab-siteplan"){
        	btm_foot_html = btm_foot_html + ' <a tab-link="'+prev_tab.attr('href')+'"  href="javascript:void(0)" class="wpb_button_a btm_unit_type_btn">'
                     				  +'      <span   class="wpb_button  wpb_btn-inverse">'+prev_tab.html()+'</span>'
                     				  +'  </a>';
        }
        if(next_tab.length>0){
        	btm_foot_html = btm_foot_html + '<a tab-link="'+next_tab.attr('href')+'"  href="javascript:void(0)"  class="wpb_button_a btm_unit_type_btn">'
                            		  +'<span class="wpb_button  wpb_btn-inverse">'+next_tab.html()+'</span>'
                         			  +'</a>';
    	}

        btm_foot_html = btm_foot_html + '</p>';

        $(current_tab_id_link).find('.btm_foot').html(btm_foot_html)

    })



   // $('.view_properties_resale').live("click",function(evt){
    $('.view_properties_resale .button_left a.wpb_button_a').live("click",function(evt){

        evt.preventDefault();
        $('html, body').animate({
            scrollTop: $('#spn_services_div').offset().top
        }, 50);

        $('#services_project_type').val('resale');

        $('.services_dd_city').val('');
        $('.services_dd_locality').val('');
        $('.services_dd_type').val('');

        var options = {'repopulate_city':true,
                        'repopulate_locality':  false,
                        'repopulate_bedrooms' : false

                        };

        fetch_servies_projects(options)

        $('.serices_properties_heading').find('h5').html('RESIDENTIAL PROJECTS ON RESALE   <span class="spn_title_city"></span> <span class="spn_title_property_cnt"></span>');

        $('.services_properties_h4').find('h4').html('Properties on Resale');
        $('.services_top_note').html('');


     })

    //$('.view_properties_rent').live("click",function(evt){
   $('.view_properties_rent .button_left a.wpb_button_a').live("click",function(evt){

        evt.preventDefault();
        $('html, body').animate({
            scrollTop: $('#spn_services_div').offset().top
        }, 50);


        $('#services_project_type').val('rent');

        $('.services_dd_city').val('');
        $('.services_dd_locality').val('');
        $('.services_dd_type').val('');

         var options = {'repopulate_city':true,
                        'repopulate_locality':  false,
                        'repopulate_bedrooms' : false

                        };

        fetch_servies_projects(options)

        $('.serices_properties_heading').find('h5').html('RESIDENTIAL PROJECTS ON RENT    <span class="spn_title_city"></span> <span class="spn_title_property_cnt"></span>');
        $('.services_properties_h4').find('h4').html('Properties on Rent');
        $('.services_top_note').html('<p>Note: Minimum deposit of 10 months has to be given prior to taking flat for rent.</p>');


     })


    function fetch_servies_projects(options){

        jQuery('#services_properties_listings').html(get_spinner());

        var city = $('#dd_city').val();
        var locality = $('#dd_locality').val();
        var no_bedrooms = $('#dd_type').val();
        var type = $('#services_project_type').val();



        var my_data = { 'city' :city,
                        'locality': locality,
                        'no_bedrooms':no_bedrooms,
                        'type' :type
                     }



       jQuery.post(ajax_var.url, {        //the server_url
            action: "get_services_properties_ajx",                 //the submit_data array
            data:my_data
        }, function(data) {


            /* -- console.log('get_services_properties_ajx data');
            console.log(data) */
            var html=''

            if(data==false){
                html ="No Properties to display."
                jQuery('#services_properties_listings').html(html);
            }
            else{
                html_data = display_services_properties(data)



/*

var property_list_details = {'property_list_html':property_list_html,
                              'city_list':city_list,
                              'area_list':area_list,
                              'bedrooms_list':bedrooms_list,

                            }
                            var options = {'repopulate_city':true,
                        'repopulate_locality':  true,
                        'repopulate_bedrooms' : true

                        };
*/

/* console.log('REPOPULATE OPTIOSN:----------***')
console.log(options) */


                if(options.repopulate_city == true){
                    $('.services_dd_city').empty();
                    $('.services_dd_city').append('<option value="">City</option>')

                    var sorted_city_list = _.sortBy(html_data.city_list);

                   // _.each(html_data.city_list,function(vl_city,ky_city){
                    _.each(sorted_city_list,function(vl_city,ky_city){
                        var selected_pune =' ';
                        if(vl_city=="Pune")
                            var selected_pune = ' selected ';
                        $('.services_dd_city').append('<option value="'+vl_city+'" '+selected_pune+' >'+vl_city+'</option>')

                    })

                   /* console.log('REPOPULATE CITY ')
                    console.log(data)
                    console.log('Pune Defaulted')
                    console.log(_.where(data,{City:{$likeI:'pune'}}))
                    console.log('*******')
                    console.log(_.where(data,{City:'Pune'}))*/
                    var pune_properties = _.where(data,{City:'Pune'})

                   //console.log(_.uniq(pune_properties.Project_Name, JSON.stringify));
                    if(_.size(pune_properties)>0){
                        var no_of_projects = _.countBy(pune_properties, "Project_Name")
                        $('.spn_title_city').html(' IN PUNE ')

                    }
                    else{
                        var no_of_projects = _.countBy(data, "Project_Name")
                    }
                    $('.spn_title_property_cnt').html('('+_.size(no_of_projects)+')')


                }
                else /* if(options.repopulate_locality==true && options.repopulate_bedrooms==true) */{

                    var selected_city = $('.services_dd_city').val();
                    if(selected_city!=''){
                        var city_properties = _.where(data,{City:selected_city})
                        var no_of_projects = _.countBy(city_properties, "Project_Name")

                        $('.spn_title_city').html(' IN '+selected_city+' ')
                    }
                    else{
                        $('.spn_title_city').html('')
                        var no_of_projects = _.countBy(data, "Project_Name")
                    }

                    $('.spn_title_property_cnt').html('('+_.size(no_of_projects)+')')

                }





                 if(options.repopulate_locality==true){

                    var sorted_area_list = _.sortBy(html_data.area_list);

                    $('.services_dd_locality').empty();
                    $('.services_dd_locality').append('<option value="">Locality</option>')
                    //_.each(html_data.area_list,function(vl_area,ky_area){
                     _.each(sorted_area_list,function(vl_area,ky_area){
                        $('.services_dd_locality').append('<option value="'+vl_area+'">'+vl_area+'</option>')

                    })
                }


                if(options.repopulate_bedrooms==true){

                    var sorted_bedrooms = _.sortBy(html_data.bedrooms_list);

                    $('.services_dd_type').empty();
                    $('.services_dd_type').append('<option value="">No. of Bedrooms</option>')
                    //_.each(html_data.bedrooms_list,function(vl_bedroom,ky_bedroom){
                    _.each(sorted_bedrooms,function(vl_bedroom,ky_bedroom){
                        $('.services_dd_type').append('<option value="'+vl_bedroom+'">'+vl_bedroom+'</option>')

                    })
                }


                 jQuery('#services_properties_listings').html(html_data.property_list_html);

                 jQuery(window).trigger('scroll');


            }
            /* -- console.log(html); */

            /* var property_list_details = {'property_list_html':property_list_html,
                              'city_list':city_list,
                              'area_list':area_list,
                              'bedrooms_list':bedrooms_list,

                            }
            */



                            /* if(data.success == true ){
                                 console.log(jQuery(self).closest('tr').html())
                                 jQuery(self).closest('tr').remove();

                                  jQuery('.property_unit_type_message').removeClass('error')
                                                        .removeClass('update-nag')
                                                        .addClass('updated')
                                                        .html('<p>Property Unit Type Deleted</p>')
                            }
                            else{

                                 jQuery('.property_unit_type_message').addClass('error')
                                                        .removeClass('update-nag')
                                                        .removeClass('updated')
                                                        .html('<p>Error Deleting Property Unit Type</p>')

                            } */

                    })

    }


    $('.services_dd_city,.services_dd_locality,.services_dd_type').live("change",function(evt){

            var  services_dd_city = false;
            var repopulate_locality = false;
            var repopulate_bedrooms = false;
            var repopulate_city = false;

        if($(this).hasClass('services_dd_city')){

            $('.services_dd_locality').val('');
           $('.services_dd_type').val('');

            repopulate_locality = true;
            repopulate_bedrooms = true;

        }

        if($(this).hasClass('services_dd_locality')){

            repopulate_bedrooms = true;

        }


         var options = {'repopulate_city':repopulate_city,
                        'repopulate_locality':  repopulate_locality,
                        'repopulate_bedrooms' : repopulate_bedrooms

                        };

        fetch_servies_projects(options);

    })


    function display_services_properties(services_properties){


        var current_property_type = $('#services_project_type').val();

        var current_project = '';
        var property_list_html='';
        var city_list = [];
        var city_list_cnt =0;

        var area_list = [];
        var area_list_cnt =0;

        var bedrooms_list = [];
        var bedrooms_list_cnt = 0;

        /* var city_area = [];
        var city_area_cnt =0; */


        _.each(services_properties,function(servproperties_vl,servproperties_ky){

            if(_.contains(city_list,servproperties_vl.City)!=true){
                city_list[city_list_cnt] = servproperties_vl.City;
                city_list_cnt = city_list_cnt + 1;
            }

            if(_.contains(area_list,servproperties_vl.Area)!=true){
                area_list[area_list_cnt] = servproperties_vl.Area;
                area_list_cnt = area_list_cnt+1;
            }


             if(_.contains(bedrooms_list,servproperties_vl.No_of_Bedrooms)!=true){
                bedrooms_list[bedrooms_list_cnt] = servproperties_vl.No_of_Bedrooms;
                bedrooms_list_cnt = bedrooms_list_cnt+1;
            }



                /* -- console.log('servproperties_vl');
                console.log(servproperties_vl) */
                            if(servproperties_vl.type == current_property_type){
                /* -- console.log('type match '+servproperties_vl.type+' : '+current_property_type); */

                if(current_project !='' &&  (current_project !=servproperties_vl.Project_Name) ){
                    property_list_html = property_list_html +
                    '                           </div>'+
                    '                        </div>'+
                    '                    </div>'+
                    '                </div>'+
                    '            </div>'+
                    '            <div class="clearfix"></div>'+
                    '        </div>'

                }
                if(current_project !='' &&  (current_project ==servproperties_vl.Project_Name) ){
                            //echo "<h3> CONTINUE MAIN PROJECT DIV</h3>";
                             property_list_html = property_list_html +

                                                '<div class="top_inner t_i_body">'+
                                                '    <div class="set">'+
                                                '        <big>'+servproperties_vl.Building+' '+servproperties_vl.Floor+'</big>'+
                                                '    </div>'+
                                                '    <div class="set">'+
                                                '        <big>'+servproperties_vl.Area_Sq_ft+'</big>'+
                                                '    </div>'+
                                                '    <div class="set">'+
                                                '        <big>'+servproperties_vl.No_of_Rooms+'</big>'+
                                                '    </div>'+
                                                '    <div class="set rent">'
                        if(servproperties_vl.Rental_Value_Unfurnished!='') {
                            property_list_html = property_list_html+'<big>'+servproperties_vl.Rental_Value_Unfurnished+'</big><small> - Unfurnished</small>';
                        }

                        if(servproperties_vl.Rental_Value_Furnished!=''){
                            property_list_html = property_list_html+'<big>'+servproperties_vl.Rental_Value_Furnished+'</big><small> - Furnished</small>';
                        }
                        property_list_html = property_list_html+
                                                '    </div>'+
                                                '    <div class="set alrt">'+
                                                '        <a href="javascript:void(0);" class="wpb_button enq_ico">'+
                                                '           <span project-name="'+servproperties_vl.Project_Name+'" project-area="'+servproperties_vl.Area_Sq_ft+'" '+
                                                '               project-rooms="'+servproperties_vl.No_of_Rooms+'" rent-resale-type="'+servproperties_vl.type+'"  '+
                                                '               building-floor="'+servproperties_vl.Building+' '+servproperties_vl.Floor+'" '+
                                                '               class="wpb_button wpb_btn-inverse wpb_regularsize popmake-services-enquiry"> '+
                                                '           </span>'+
                                                '        </a>'+
                                                '    </div>'+
                                                '</div>';
                        }










                        else if(current_project =='' || (current_project!=servproperties_vl.Project_Name) ){
                           current_project = servproperties_vl.Project_Name;
                            //echo "<h1> New Project </h1>";

                            if($('#services_project_type').val()=="rent"){
                                var rent_resale_head = 'Rent (INR/Month)';
                            }
                            else if($('#services_project_type').val()=="resale"){
                                var rent_resale_head = 'Cost (INR)';
                            }

                        property_list_html = property_list_html+


                                            '<div class="prk_inner_block vc_row-fluid centered columns forent">'+
                                            '    <div class="row partintro">'+
                                            '        <div class="vc_col-sm-12 wpb_column vc_column_container bgrey">'+
                                            '            <div class="wpb_wrapper img_hold" style="background-image: url('+site_url+"/wp-content/themes/samba-child/services-images/"+servproperties_vl.Image_File_Name+');">'+
                                            '                <div class="clearfix"></div>'+
                                            '                <div class="work_cont">'+
                                            //'                    <img src="'+site_url+"/wp-content/themes/samba-child/services-images/"+servproperties_vl.Image_File_Name+'">'+
                                            '                    <div class="forent_cap">Sample Flat</div>'+
                                            '                </div>'+
                                            '            </div>'+
                                            '    <!--'+
                                            '        </div>'+
                                            '        <div class="vc_col-sm-6 wpb_column vc_column_container ">'+
                                            '    -->'+
                                            '            <div class="wpb_wrapper introtext">'+
                                            '                <div class="clearfix"></div>'+
                                            '                <div class="work_cont">'+
                                            '                    <a href="#" class="proj_title">'+
                                            '                        <span class="title">'+servproperties_vl.Project_Name+'</span>'+
                                            '                        <span class="divi">|</span>'+
                                            '                        <span class="loca">'+servproperties_vl.Area

if(!_.isUndefined(servproperties_vl.City) && servproperties_vl.City!="" ){
                    property_list_html +=", "+servproperties_vl.City
}


                    property_list_html +=   '</span>'+
                                            '                    </a>'+
                                            '                    <p class="excerpt">'+
                                                                    servproperties_vl.Flat_Description+
                                            '                    </p>'+
                                            '                </div>'+
                                            '            </div>'+
                                            '        </div>'+
                                            '    </div>'+
                                            '    <div class="row list_forent">'+
                                            '        <div class="vc_col-sm-12 wpb_column vc_column_container">'+
                                            '            <div class="wpb_wrapper">'+
                                            '                <div class="clearfix"></div>'+
                                            '                <div class="work_cont tab_con">'+
                                            '                    <div class="top-tab">'+
                                            '                       <div class="top_inner t_i_head">'+
                                            '                            <div class="set">'+
                                            '                                <small class="clr_lt">Building | Floor</small>'+
                                            '                            </div>'+
                                            '                            <div class="set">'+
                                            '                                <small class="clr_lt">Area (Sq. Ft.)</small>'+
                                            '                            </div>'+
                                            '                            <div class="set">'+
                                            '                                <small class="clr_lt">Type</small>'+
                                            '                            </div>'+
                                            '                            <div class="set rent">'+
                                            '                                <small class="clr_lt">'+rent_resale_head+'</small>'+
                                            '                            </div>'+
                                            '                            <div class="set">'+
                                            '                            </div>'+
                                            '                        </div>'+
                                            '                        <div class="top_inner t_i_body">'+
                                            '                            <div class="set">'+
                                            '                                <big>'+servproperties_vl.Building+' '+servproperties_vl.Floor+'</big>'+
                                            '                            </div>'+
                                            '                            <div class="set">'+
                                            '                                <big>'+servproperties_vl.Area_Sq_ft+' </big>'+
                                            '                            </div>'+
                                            '                            <div class="set">'+
                                            '                                <big>'+servproperties_vl.No_of_Rooms+'</big>'+
                                            '                            </div>'+
                                            '                            <div class="set rent">';
                                                         if(servproperties_vl.Rental_Value_Unfurnished!='') {
                                                            property_list_html = property_list_html+'<big>'+servproperties_vl.Rental_Value_Unfurnished+'</big><small> - Unfurnished</small>';
                                                        }

                                                        if(servproperties_vl.Rental_Value_Furnished!=''){
                                                            property_list_html = property_list_html+'<big>'+servproperties_vl.Rental_Value_Furnished+'</big><small> - Furnished</small>';
                                                        }
                                                        /* property_list_html = property_list_html+
                                                                        '</div>'+
                                                                        '<div class="set alrt">'+
                                                                        '    <a href="#" class="wpb_button enq_ico popmake-services-enquiry"><span class="wpb_button wpb_btn-inverse wpb_regularsize"></span></a>'+
                                                                        '</div>'+
                                                                    '</div>';
                                                       */


                                                         property_list_html = property_list_html+
                                                                            '    </div>'+
                                                                            '    <div class="set alrt">'+
                                                                            '        <a href="javascript:void(0);" class="wpb_button enq_ico">'+
                                                                            '           <span project-name="'+servproperties_vl.Project_Name+'" project-area="'+servproperties_vl.Area_Sq_ft+'" '+
                                                                            '               project-rooms="'+servproperties_vl.No_of_Rooms+'" rent-resale-type="'+servproperties_vl.type+'"  '+
                                                                            '               building-floor="'+servproperties_vl.Building+' '+servproperties_vl.Floor+'" '+
                                                                            '               class="wpb_button wpb_btn-inverse wpb_regularsize popmake-services-enquiry"> '+
                                                                            '           </span>'+
                                                                            '        </a>'+
                                                                            '    </div>'+
                                                                            '</div>';



                   
}




            }//end if(servproperties_vl.type == current_property_type){


        }) //end _.each(services_properties,function(servproperties_vl,servproperties_ky){

        property_list_html = property_list_html+
                    '                            </div>'+
                    '                    </div>'+
                    '                </div>'+
                    '            </div>'+
                    '        </div>'+
                    '        <div class="clearfix"></div>'+
                    '    </div>'
        var property_list_details = {'property_list_html':property_list_html,
                              'city_list':city_list,
                              'area_list':area_list,
                              'bedrooms_list':bedrooms_list,

                            }


    return property_list_details;
    }




    function get_spinner(){

        var spinner = '<div id="np">'+
                           '<div class="spinner">'+
                               '<div class="spinner-icon" style="border-top-color: rgb(10, 194, 210); border-left-color: rgb(10, 194, 210);"></div>'+
                           '</div>'+
                       '</div>'

                       return spinner;

    }





    /* Populate cities and Properties values on Fomidable form added on Contact page
    */
   /* function get_formidable_contact_properties(tab_id){

        if(!_.isUndefined(tab_id)){

            var tab_container = jQuery( "[aria-labelledby='"+tab_id+"']" )
            var city_selector = tab_container.find('#field_ky_contact1city');
            var properties_selector = tab_container.find('#field_ky_contact1projects');
        }
        else{
            var city_selector = jQuery('#field_ky_contact1city');
            var properties_selector = jQuery('#field_ky_contact1projects');
        }

        console.log(' (.nri_fullrow.indi_pr.redsp ).find(.wpb_call_desc).length')
        console.log(jQuery('.nri_fullrow.indi_pr.redsp' ).find('.wpb_call_desc').length)

        if(city_selector.length>0 || jQuery('.nri_fullrow.indi_pr.redsp' ).find('.wpb_call_desc').length>0){

             properties_selector.empty();

             if(_.size(window.residential_properties)>0){
                        show_cities_on_formidable_contact(city_selector)
                        show_nearby_properties()

             }
             else{
                    jQuery.post(ajax_var.url, {        //the server_url
                        action: "get_residential_properties_list_ajx",                 //the submit_data array
                        data:{post_type:'both'}
                        }, function(response) {


                            console.log('RESPONSE')
                            console.log(response);
                            if(response.code == 'OK' ){
                                window.residential_properties =  response.data;
                                city_selector.empty();
                                show_cities_on_formidable_contact(city_selector)
                                show_nearby_properties();

                            }
                    })

             }
        }


    } */




    var rad = function(x) {
              return x * Math.PI / 180;
            };

    var getDistance = function(p1, p2) {
      var R = 6378137; // Earth’s mean radius in meter
      var dLat = rad(p2.lat - p1.lat);
      var dLong = rad(p2.lng - p1.lng);
      var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(rad(p1.lat)) * Math.cos(rad(p2.lat)) *
        Math.sin(dLong / 2) * Math.sin(dLong / 2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      var d = R * c;
      return d; // returns the distance in meter
    };




    function show_nearby_properties(post_type){
        console.log('show nearby properties')       

        jQuery('.nri_fullrow.indi_pr.redsp' ).find('.wpb_call_desc').html('');


        if(jQuery('.nri_fullrow.indi_pr.redsp' ).find('.wpb_call_desc').length>0){

            console.log('window All properties')
            console.log(window.all_properties)
            console.log('Post ID :'+jQuery('#post_id').val())


            var current_property = _.first( _.where(window.all_properties,{id:parseInt(jQuery('#post_id').val()) }) )
            console.log('current_property')
            console.log(current_property)

            var current_property_map_address  = _.first(current_property.map_address);

            var current_property_map_lat =   current_property_map_address.lat;

            var current_property_map_lng =   current_property_map_address.lng;


            // We create a circle to look within:
            /* search_area = {
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                center : new google.maps.LatLng(location.lat, location.lon),
                radius : 500
            }

            search_area = new google.maps.Circle(search_area);

             $.each(markers, function(i,marker) {
               if (google.maps.geometry.poly.containsLocation(marker.getPosition(), search_area)) {
                 in_area.push(marker);
               }
            });

            */
            var this_area_cnt   = 0;
            var nearby_area_cnt = 0;
            var nearby_area     = [];
            var this_area       = [];
            var this_area_id    = [];
            var nearby_area_ids = [];


            var post_type_properties = _.where(window.all_properties,{property_status:'ongoing',post_type:post_type} )

            _.each(post_type_properties,function(resprop_v,resprop_k){

                var property_map_address  = _.first(resprop_v.map_address);

                var distance = getDistance(current_property_map_address,property_map_address);

                if(parseFloat(distance)  <=2000 && jQuery('#post_id').val()!=resprop_v.id ){
                    
                    this_area[this_area_cnt]    = resprop_v ;
                    this_area_id[this_area_cnt] = resprop_v.id
                    this_area_cnt = this_area_cnt + 1;
                }
                else if(parseFloat(distance)  >2000 && parseFloat(distance)  <5000 ){
                    nearby_area[nearby_area_cnt]      = resprop_v ;
                    nearby_area_ids[nearby_area_cnt]  = resprop_v.id ;
                    nearby_area_cnt = nearby_area_cnt + 1;
                }

                console.log("ID :"+resprop_v.id+"  || Distance : "+distance)
            })




            console.log('THIS AREA : ')
            console.log(this_area)
            console.log('NEARBY AREA : ')
            console.log(nearby_area)

             var closer_properties ="";

            if(_.size(this_area)>0 || _.size(nearby_area) >0){

                var all_near_closer_properties_arr = this_area_id.concat(nearby_area_ids) ;

                var all_near_closer_properties = all_near_closer_properties_arr.join();


                closer_properties = "There " ;
                var properties_txt = " Marvel properties ";

                    if(_.size(this_area)>0){

                        if(_.size(this_area) == 1){
                            var properties_txt = ' Marvel property ';
                            closer_properties = closer_properties + ' is ';
                        }
                        else{
                            closer_properties = closer_properties + ' are ';
                        }

                        closer_properties = closer_properties + _.size(this_area)+" "+properties_txt+" in this area ";
                    }
                    if(_.size(this_area)>0 && _.size(nearby_area) >0)
                        closer_properties = closer_properties + " and ";
                    if( _.size(nearby_area) >0) {

                       

                        if(_.size(this_area)<=0){
                           properties_txt = " Marvel properties ";

                           if(_.size(nearby_area) == 1){
                                var properties_txt = ' Marvel property ';
                                closer_properties = closer_properties + ' is ';
                            }
                            else{

                                closer_properties = closer_properties + ' are ';
                            } 
                        }
                        else{
                            properties_txt =""
                        }
                        


                        closer_properties = closer_properties + _.size(nearby_area)+" "+properties_txt+" in nearby areas ";
                    }

               // jQuery('.spn_nearby_properties').find('.wpb_call_desc').html(closer_properties)



                var explore_url = "";

                if(jQuery('#current_post_type').val() == 'residential-property'){
                    explore_url = SITE_URL + "/residential-properties/ongoing/?near="+all_near_closer_properties;
                }
                else if(jQuery('#current_post_type').val() == 'commercial-property'){
                    explore_url = SITE_URL + "/commercial-properties/ongoing/?near="+all_near_closer_properties;
                }

 
 

                jQuery('.nri_fullrow.indi_pr.redsp' ).find('.wpb_call_desc').html(closer_properties)
                jQuery('.nri_fullrow.indi_pr.redsp' ).find('.wpb_content_element')
                    .find('.wpb_button_a')
                    .attr('href',explore_url);


            }
            else{
                jQuery('.nri_fullrow.indi_pr.redsp' ).find('.wpb_call_desc').html('There are no properties in this or nearby areas')
                jQuery('.nri_fullrow.indi_pr.redsp' ).find('.wpb_content_element')
                    .find('.wpb_button_a')
                    .hide()
            }

        }

    }

    function show_cities_on_formidable_contact(city_selector,post_type){ 

        populate_properties_cities_on_contact()

    }

    //commented on 26aug2015  get_formidable_contact_properties();

    jQuery('.contact_form_tab_container li a').live('click',function(){

        get_formidable_contact_properties($(this).attr('id'));
    })

    jQuery('#field_ky_contact1city').live('change',function(){



        var selected_city = jQuery(this).val()
    
        var selected_post_type = jQuery('option:selected', this).attr('post_type');       
        

        if(!_.isUndefined(window.all_properties)){

            var city_post_type_based_properties = _.where(window.all_properties,{post_type:selected_post_type,property_city_name:selected_city});               


               /* --  console.log('city_post_type_based_properties :-----------');
                console.log(city_post_type_based_properties)             */    


                 if(_.size(city_post_type_based_properties)>0){

                    var city_post_type_based_projectnames = _.pluck(city_post_type_based_properties,'post_title');
                    var city_post_type_based_projectoptions ="";              
                     
                    _.each(city_post_type_based_projectnames,function(project_vl,project_ky){

                        city_post_type_based_projectoptions+= "<option post_type='"+selected_post_type+"' value='"+project_vl+"'>"+project_vl+"</option>" ; 
                    })                    

                     
                    jQuery(this).closest('form').find('#field_ky_contact1projects').empty();
                    jQuery(this).closest('form').find('#field_ky_contact1projects').append(city_post_type_based_projectoptions);

                    
                } 

        }


         /* var city_id = jQuery(this).children(":selected").attr("city_id");

          var project_selector = jQuery(this).closest('form').find('#field_ky_contact1projects')

          project_selector.empty()
          project_selector.append('<option value="">Select the Project</option>')

          if(!_.isUndefined(window.residential_properties)){
                _.each(window.residential_properties,function(prop_vl,prop_ky){

                    if(city_id == prop_vl.property_city){

                        project_selector.append('<option value="'+prop_vl.post_title+'">'+prop_vl.post_title+'</option>');

                    }

              })

          }

            console.log(window.residential_properties); */





           /* var selectedcity = jQuery('#form_contact2').find("#field_ky_contact1city").val();
            var selectedcity_post_type = jQuery('option:selected', jQuery('#form_contact2').find("#field_ky_contact1city")).attr('post_type');
            alert(selectedcity_post_type)
                    var selected_projects = _.where(window.all_properties,{property_city_name:selectedcity,post_type:selectedcity_post_type})
            console.log('liiiiiiiiiiiiiveeee change')
            console.log(selected_projects)
            var all_projects = _.pluck(selected_projects,'project_name')

            console.log('all_projects')
            console.log(all_projects)

            jQuery('#form_contact2').find("#field_ky_contact1projects").empty()
            jQuery('#form_contact2').find("#field_ky_contact1projects").html("<option value=''>Projects</option>")

            _.each(all_projects,function(project_vl,project_ky){
                jQuery('#form_contact2').find("#field_ky_contact1projects").append("<option value='"+project_vl+"'>"+project_vl+"</option>")
            }) */
 

    })

    /* END Populate cities and Properties values on Fomidable form added on Contact page
    */





    jQuery('.popmake-services-enquiry').live('click',function(){

        var project_name        = jQuery(this).attr('project-name');
        var building_floor      = jQuery(this).attr('building-floor');
        var project_area        = jQuery(this).attr('project-area');
        var project_rooms       = jQuery(this).attr('project-rooms');
        var project_rent_resale = jQuery(this).attr('rent-resale-type');

        jQuery('#field_serv_cont_projectname').val(project_name);
        jQuery('#field_serv_cont_buildingfloor').val(building_floor)
        jQuery('#field_serv_cont_type').val(project_rooms)
        jQuery('#field_serv_cont_area').val(project_area)
        jQuery('#field_serv_cont_rentresale').val(project_rent_resale)


        jQuery('#form_frm_serv_contact').find('.serv-prj-title').html(project_name)
        jQuery('#form_frm_serv_contact').find('.serv-prj-flr').html(building_floor)
        jQuery('#form_frm_serv_contact').find('.serv-prj-type').html(project_rooms)
        jQuery('#form_frm_serv_contact').find('.serv-prj-area').html(project_area)
        jQuery('#form_frm_serv_contact').find('.serv-prj-rent-resale').html(project_rent_resale)


    })

jQuery('.popmake-careers-apply-now').live('click',function(evt){


        evt.preventDefault();
        var job_list_classes = jQuery(this).closest('li').attr('class');

        var jobtype_class_arr = []
        job_list_classes_arr = job_list_classes.split(' ');

        _.each(job_list_classes_arr,function(jobclass_vl,jobclass_ky){
            if(jobclass_vl.indexOf('job-type')==0){
                var jobtype_class = jobclass_vl;
                jobtype_class_arr =  jobtype_class.split('-')
            }
        })

        var current_job_category ='';
        var current_job_name ='';

        /* -- console.log('jobtype_class_arr')
        console.log(jobtype_class_arr) */

        if(_.size(jobtype_class_arr)==3)
            current_job_category = jobtype_class_arr[2];

        if(jQuery(this).closest('li').find('.job-name').length>0)
            current_job_name  =  jQuery(this).closest('li').find('.job-name').html()


        jQuery('#form_careers_applynow').find('.job-title-text').html(current_job_name);

        jQuery('#form_careers_applynow').find('.job-category-text').html(' ('+current_job_category+')')

        jQuery('#form_careers_applynow').find('#field_careers_hid_jobtitle').val(current_job_name);

        jQuery('#form_careers_applynow').find('#field_careers_hid_jobcategory').val(current_job_category)


    }),

    jQuery('.popmake-popup-property-list').live('click',function(evt){
        
        evt.preventDefault();

        jQuery('.popmake-popup-property-list').removeClass('formidable_active');
        jQuery(evt.target).addClass('formidable_active')

        if(jQuery(this).closest('.single_p_w').length>0){  // On REsidential properties listings page
            var property_title = jQuery(this).closest('.single_p_w').attr('property-title');

            jQuery('#form_frm_individual_proj_popup').find('#field_individual_popup_project').val(property_title)
            jQuery('#form_frm_individual_proj_popup').find('.sign-prop-title').html(property_title)
        }
        else if(jQuery(this).closest('.map_info_c').length>0){  // On REsidential properties listings page
            var property_title = jQuery(this).closest('.map_info_c').attr('property-title');

            jQuery('#form_frm_individual_proj_popup').find('#field_individual_popup_project').val(property_title)
            jQuery('#form_frm_individual_proj_popup').find('.sign-prop-title').html(property_title)
        }



    })


    jQuery('.popmake-popup-property-page').live('click',function(evt){
        evt.preventDefault();
        jQuery('#form_frm_individual_proj_popup').find('#field_individual_popup_project').val(property.title)
        jQuery('#form_frm_individual_proj_popup').find('.sign-prop-title').html(property.title)
     })




    if(jQuery('#current_property_title').length>0){
        setTimeout(function(){

          //console.log('LOADING SHARE BUTTON :-------------------------------------------')
          //console.log(jQuery('#projects_listings').html())
            var switchTo5x=true;
           stLight.options({publisher: "1423128c-ec17-415a-8eaf-4ba0d655a2d6", doNotHash: false, doNotCopy: false, hashAddressBar: false, onhover: false});
           stButtons.locateElements();

          },300)
    }



    jQuery('.popmake-popup-property-page').live('click',function(evt){
        evt.preventDefault();

         if(jQuery('#form_frm_individual_proj_popup').length>0){

            var current_prperty_title = jQuery('#current_property_title').val();
            jQuery('#frm_individual_proj_popup').find('#field_individual_popup_project').val(current_prperty_title)
         }



    })




    if( jQuery('#form_frm_individual_project_contact').length>0 ){

        if(jQuery('#field_indi_hid_project_name').length>0){

            var current_prperty_title = jQuery('#current_property_title').val();
            jQuery('#field_indi_hid_project_name').val(current_prperty_title);
        }
    }











/* commented on 15sep2015 jQuery('#home_city2, #home_city').live('change',function(){




  jQuery('.home_location').empty();
  jQuery('.home_location').append('<option value="">Locality : All</option>');
  jQuery('.home_location').append('<option class="select-dash" disabled="disabled">----------------------------------</option>')



   var main_search_bar = jQuery('.top-dd-c')
   main_search_bar.find('#dd_locality').empty();
   main_search_bar.find('#dd_locality').append('<option value="">Locality : All</option>');
   main_search_bar.find('#dd_locality').append('<option class="select-dash" disabled="disabled">----------------------------------</option>')


 /* --  console.log('window.search_options.locality.localities........')
  console.log(window.search_options.locality.localities) * /

  // commented on 4sep2015 url change var selected_city = jQuery(this).val();

  var selected_city = jQuery('option:selected', this).attr('data-cityid');

  var sorted_locality_options = [];

  if(_.size(window.search_options.locality.localities)>0){

      var sorted_locality_options  = _.sortBy(window.search_options.locality.localities, function(obj){ return obj.name.toLowerCase() });

      _.each(sorted_locality_options,function(vl_cl,ky_cl){
            /* -- console.log(vl_cl);
            console.log('ky'+ky_cl)

            console.log(':::::::::'+jQuery('.home_city').val()+'--------'+vl_cl.city_id)
            * /

            if(selected_city==vl_cl.city_id){

               var display_locality_name = vl_cl.name;
                if(_.size(vl_cl.name)>14){
                  //display_locality_name =  display_locality_name.substr(0, 13)+'...';

                }

                jQuery('.home_location').append('<option value="'+display_locality_name+'">'+display_locality_name+'</option>')
                main_search_bar.find('#dd_locality').append('<option value="'+display_locality_name+'">'+display_locality_name+'</option>')

            }
       })
  }

})

*/



jQuery('.home_btn_search_properties').live('click',function(evt){


  evt.preventDefault();


  if(jQuery('#post_type').val()=='commercial-property'){
    var search_url = SITE_URL+'/commercial-properties';
  }
  else{
    var search_url = SITE_URL+'/residential-properties';
  }


  var status_el = jQuery(this).closest('.search_propperty_block').find('.home_status')
  var city_el = jQuery(this).closest('.search_propperty_block').find('.home_city')
  var locality_el = jQuery(this).closest('.search_propperty_block').find('.home_location')
  var type_el = jQuery(this).closest('.search_propperty_block').find('.home_type')

  





  var current_selected_status     = (_.isUndefined(status_el.val()) || (status_el.val()=='') )?'ongoing':format_filter_text1(status_el.val());
  var current_selected_city       = (_.isUndefined(city_el.val()) || (city_el.val()=="") )?'city-all':format_filter_text1(city_el.val());
  var current_selected_locality   = (_.isUndefined(locality_el.val()) || (locality_el.val()=='') ) ?'locality-all':format_filter_text1(locality_el.val());
  var current_selected_type       = (_.isUndefined(type_el.val()) || (type_el.val()=='') )?'type-all':format_filter_text1(type_el.val()); 
               

  if(current_selected_type!='type-all'){
      search_url+= '/'+current_selected_status+'/'+current_selected_city+'/'+current_selected_locality+'/'+current_selected_type;

  }
  else if(current_selected_locality!='locality-all'){
       search_url+= '/'+current_selected_status+'/'+current_selected_city+'/'+current_selected_locality;
  }
  else if(current_selected_city!='city-all'){
      search_url+= '/'+current_selected_status+'/'+current_selected_city ;

   }                
   else {
      search_url+= '/'+current_selected_status
   }

    var width = window.innerWidth ? window.innerWidth : jQuery(window).width();
   if (!(jQuery(this).hasClass('popup')) ) {

      if( (width >= 768 && jQuery(this).hasClass('home_btn_sea'))  || (width < 768 && jQuery(this).hasClass('home_btn_sea2')) ){
       
           window.location.href = search_url  
        }
    }

/* commented on 3sep2015 Rewrite URL UPDATE
  if(_.isUndefined(status_el.val())  || status_el.val() =='' ){
    var status_value ="Ongoing";
  }
  else{
    var status_value = jQuery('.home_status').val();
  }
  search_url+='#/st/'+status_value;
  //residential-properties/#/ct/blore/loc/mekri circle/type/1 BHK

  if(city_el.val()!=''){
    search_url= search_url + '/ct/'+  city_el.val()
  }


  if(locality_el.val()!=''){
    search_url= search_url + '/loc/'+ locality_el.val()
  }


   if(type_el.val()!=''){
    search_url= search_url + '/type/'+type_el.val()
  }



  var width = window.innerWidth ? window.innerWidth : jQuery(window).width();

  //console.log(jQuery(this).hasClass('popup')+'  ::::::::: '+width+'  ########  '+jQuery(this).hasClass('home_btn_sea'))

  if (!(jQuery(this).hasClass('popup')) ) {

      if( (width >= 768 && jQuery(this).hasClass('home_btn_sea'))  || (width < 768 && jQuery(this).hasClass('home_btn_sea2')) ){


                var popup_parent_class = jQuery(this).closest('.home_search')

                var main_search_bar = jQuery('.top-dd-c')
                main_search_bar.find('#dd_status').val(''+popup_parent_class.find('#home_status2').val());


                main_search_bar.find('#dd_city').val(popup_parent_class.find('#home_city2').val());
                main_search_bar.find('#dd_locality').val(popup_parent_class.find('#home_location2').val());
                main_search_bar.find('#dd_type').val(popup_parent_class.find('#home_type2').val());



          //  window.location.href = search_url;

            //location.assign(search_url) ;
            //location.href = search_url  ;

            //window.location.assign(search_url) ;
            window.location.href = search_url  ;

            jQuery(this).closest('.home_search').hide();
      }


  } */


})


function format_filter_text1(filter_text){

              filter_text = filter_text.trim();
              
              var formated_filter_text = filter_text.replace(/ /g , "-").toLowerCase();
              return formated_filter_text;
}



function show_project_title_on_autopopup_individual_page(){

var autopopup_individual_page_id;
    autopopup_individual_page_id = window.setInterval(function(){
        /// call your function here
        /* --  console.log('check FORMMMMMMMMMMM') */
         if(jQuery('#form_frm_individual_proj_popup').length>0 && jQuery('#current_property_title').length>0){

                    var current_prperty_title = jQuery('#current_property_title').val();
                    jQuery('#form_frm_individual_proj_popup').find('#field_individual_popup_project').val(current_prperty_title)
                    jQuery('#form_frm_individual_proj_popup').find('.sign-prop-title').html(current_prperty_title)
                    /* -- console.log('remoced FORM INTERVAL')
                    console.log('current_prperty_title :'+current_prperty_title) */
                    window.clearInterval(jQuery('#interval_id_auto_popup').val());

        }



    }, 2000);
   return autopopup_individual_page_id


}

if(!(_.isUndefined(jQuery('#current_property_title').val())) ){
   var autopopup_individual_page_id = show_project_title_on_autopopup_individual_page()
    jQuery('#interval_id_auto_popup').val(autopopup_individual_page_id) 
}








/* Populate city and project list on footer popup on single residential and commercial residential property*/
 
    jQuery('.popmake-01-enquiry-footer-popup').live('click',function(evt){
        console.log('\n\n\n\PROHECT LIST TO POPULATE ON FORMDABLE')
        _.each(window.all_properties,function(proj__v,proj__k){
            console.log(proj__v)

        }) 

      //  populate_properties_cities_on_contact()


    })





    function populate_properties_cities_on_contact(){

        
        if(jQuery('.formidable_contact_form').length>0){


                jQuery('.formidable_contact_form').find("#field_ky_contact1city").empty()

                var residential_properties = _.where(window.all_properties,{post_type:'residential-property'});
                var commercial_properties = _.where(window.all_properties,{post_type:'commercial-property'});


                console.log('ALL RESIDENTIAL PROPERTIES :-----------');
                console.log(residential_properties)
                console.log('ALL Commercial PROPERTIES')
                console.log(commercial_properties)

                jQuery('.formidable_contact_form').find("#field_ky_contact1city").append('<option value="">City</option>');


                 if(_.size(residential_properties)>0){

                    var all_residential_cities = _.pluck(residential_properties,'property_city_name')
                    var uniq_residential_cities = _.uniq(all_residential_cities);                    
                    var residential_properties_options = "<optgroup label='Residential'>";
                    _.each(uniq_residential_cities,function(city_vl,city_ky){

                        residential_properties_options+= "<option post_type='residential-property' value='"+city_vl+"'>"+city_vl+"</option>" ; 
                    })                    

                    residential_properties_options = residential_properties_options + '</optgroup>';
                    
                    jQuery('.formidable_contact_form').find("#field_ky_contact1city").append(residential_properties_options);

                } 

                if(_.size(commercial_properties)>0){

                    var all_commercial_cities = _.pluck(commercial_properties,'property_city_name')
                    var uniq_commercial_cities = _.uniq(all_commercial_cities);                    
                    var commercial_properties_options = "<optgroup label='Commercial'>";
                    _.each(uniq_commercial_cities,function(city_vl,city_ky){

                        commercial_properties_options+= "<option  post_type='commercial-property' value='"+city_vl+"'>"+city_vl+"</option>" ; 
                    })                    

                    commercial_properties_options = commercial_properties_options + '</optgroup>';                     

                    jQuery('.formidable_contact_form').find("#field_ky_contact1city").append(commercial_properties_options);

                }             



        }
    }

/* End Populate city and project list on footer popup on singel and commercial residential property*/


function populate_homepage_search_types(){

    var type_drop_down_values = [];
    var type_drop_downs_values_cnt = 0;
    var sorted_type_options = [];
    var add_to_types_options = true ; 

    jQuery('#dd_type').append('<option value="">Type : All</option>'+
              '<option class="select-dash" disabled="disabled">------------------------------</option>')
 
              _.each(type_drop_down_values,function(typeoptions_vl,typeoptions_ky){
 
                   if(typeoptions_vl.locality_id!=''){



                    if(self.selectedType == self.format_filter_text(typeoptions_vl.property_unit_type_display))
                      var selected_type_dropdown = " selected ";
                    else
                      var selected_type_dropdown = ' ';
                  
                    jQuery('#dd_type').append('<option '+selected_type_dropdown+' value="'+typeoptions_vl.property_unit_type_display+'">'+typeoptions_vl.property_unit_type_display+'</option>')


                  }


              })
}



jQuery('.home_city').live('change',function(evt){

   // 15sep2015  alert('home city change')

    var args ={     'loadcities' : false, 
                    'loadlocalities':true,
                    'loadtypes'     :true    
              }

    var selected_args = {    'selected_city' : jQuery(evt.target).val(),
                            'selected_locality' : '',
                            'selected_type' : ''

                        }          

    var ongoing_residential_properties = _.where(window.all_properties,{property_status:'ongoing',post_type:'residential-property'} );


    populate_homepage_search_drop_downs(ongoing_residential_properties,args,selected_args)

})

 
 jQuery('.home_location').live('change',function(evt){

   // alert('home locality change')

    var args ={     'loadcities' : false, 
                    'loadlocalities':false,
                    'loadtypes'     :true    
              }

    var selected_city_val =jQuery(evt.target).closest('.search_propperty_block').find('.home_city').val() 

    var selected_args = {   'selected_city' : selected_city_val,
                            'selected_locality' : jQuery(evt.target).val(),
                            'selected_type' : ''

                        }          

    var ongoing_residential_properties = _.where(window.all_properties,{property_status:'ongoing',post_type:'residential-property'} );


    populate_homepage_search_drop_downs(ongoing_residential_properties,args,selected_args)

})


function populate_homepage_search_drop_downs(propertyCollection,args,selected_args){
              

console.log('propertyCollection:---------------||||||||||||||||||||||||||||')
              console.log(propertyCollection);
              var self = this ;

              var city_drop_downs_values = [];
              var city_drop_downs_values_cnt = 0;
              var sorted_cities_options = [];
              var add_to_cities_options = true ;



              var locality_drop_down_values = [];
              var locality_drop_downs_values_cnt = 0;
              var sorted_locality_options = [];
              var add_to_locality_options = true ;



              var type_drop_down_values = [];
              var type_drop_downs_values_cnt = 0;
              var sorted_type_options = [];
              var add_to_types_options = true ;

              _.each(propertyCollection,function(property_vl,property_ky){

 

                     
                    city_drop_downs_values[city_drop_downs_values_cnt] =  {'city_id':property_vl.property_city,
                                                                         'city_name':property_vl.property_city_name,
                                                                         };
                    city_drop_downs_values_cnt++; 

                    console.log('*&*&*&*&*&*&*&*'+args.loadlocalities+ '   '+jQuery('.home_city').val()+ '   ' +property_vl.property_city_name )
                    console.log(property_vl)               
                   

                    if(args.loadlocalities == true   ){ 

                        if(selected_args.selected_city!=''){
                             if(selected_args.selected_city == property_vl.property_city_name){
                                locality_drop_down_values[locality_drop_downs_values_cnt] =  {'locality_id':property_vl.property_locaity,
                                                                                          'locality_name':property_vl.property_locality_name,
                                                                                         };
                                locality_drop_downs_values_cnt++;
                            }
                        }
                        else{

                                locality_drop_down_values[locality_drop_downs_values_cnt] =  {'locality_id':property_vl.property_locaity,
                                                                                          'locality_name':property_vl.property_locality_name,
                                                                                         };
                                locality_drop_downs_values_cnt++;

                            
                        }
                    }
                     

                    if(args.loadtypes==true){

                        if(selected_args.selected_locality!='' && selected_args.selected_city!='' ){       

                            if((selected_args.selected_city == property_vl.property_city_name) && 
                                (selected_args.selected_locality == property_vl.property_locality_name) ){
                                    mergeByProperty(type_drop_down_values, property_vl.property_unit_type, 'type');    
                                }

                        }


                        if(selected_args.selected_locality!='' ){       

                            if(selected_args.selected_locality == property_vl.property_locality_name) {
                                    mergeByProperty(type_drop_down_values, property_vl.property_unit_type, 'type');    
                                }

                        }
                        else if(selected_args.selected_city!='' ){   
                            if(selected_args.selected_city == property_vl.property_city_name){
                                mergeByProperty(type_drop_down_values, property_vl.property_unit_type, 'type');
                            }
                        }
                        else{
                            mergeByProperty(type_drop_down_values, property_vl.property_unit_type, 'type');
                        }
                         
                    }


              })

              

              if(args.loadcities == true ){ 

               // 15sep2015  alert('populating cities ')
                      var uniq_drop_down_cities = _.uniq(city_drop_downs_values,function(item){return JSON.stringify(item);})

                      sorted_cities_options   = _.sortBy(uniq_drop_down_cities, function(obj){ return obj.city_name.toLowerCase() });
                       

                      jQuery('.home_city').empty()
                      jQuery('.home_city').append('<option value="">City : All</option>'+
                      '<option class="select-dash" disabled="disabled">------------------------------</option>')

                      _.each(sorted_cities_options,function(citoptions_vl,citoptions_ky){

                          if(citoptions_vl.locality_id!=''){
                           
                            jQuery('.home_city').append('<option  value="'+citoptions_vl.city_name+'">'+citoptions_vl.city_name+'</option>')
                          }


                      })

            }
 

            if(args.loadlocalities == true ){   

               // 15sep2015  alert('populating localities')
                   var uniq_drop_down_localities = _.uniq(locality_drop_down_values,function(item){return JSON.stringify(item);})
                   sorted_locality_options = _.sortBy(locality_drop_down_values, function(obj){ return obj.locality_name.toLowerCase() });


                   jQuery('.home_location').empty()
                   jQuery('.home_location').append('<option value="">Locality : All</option>'+
                  '<option class="select-dash" disabled="disabled">------------------------------</option>')

                   console.log('-=-=-=-=- =-locoptions_vl=- =-=- =-=- =- =-= ')

                  _.each(sorted_locality_options,function(locoptions_vl,locoptions_ky){

                      if(locoptions_vl.locality_id!=''){ 

                        console.log(locoptions_vl)

                        jQuery('.home_location').append('<option  value="'+locoptions_vl.locality_name+'">'+locoptions_vl.locality_name+'</option>')
                      }


                  })

            }









            if(args.loadtypes == true ){ 

           

              jQuery('.home_type').empty()
              jQuery('.home_type').append('<option value="">Type : All</option>'+
              '<option class="select-dash" disabled="disabled">------------------------------</option>')

              var unit_type_dropdown_values = [];
              var unit_type_dropdown_values_cnt = 0;
 
              _.each(type_drop_down_values,function(typeoptions_vl,typeoptions_ky){
 
                   if(typeoptions_vl.type!='' &&  !_.isUndefined(typeoptions_vl.type) ){



                    if(self.selectedType == format_filter_text1(typeoptions_vl.property_unit_type_display))
                      var selected_type_dropdown = " selected ";
                    else
                      var selected_type_dropdown = ' ';


                    console.log('typeoptions_vl : - &&&&&&&&&&&&&&&&&&&&&&&&')
                    console.log(typeoptions_vl)
                    
                  
                    if(_.isUndefined(this.post_type)  || this.post_type=='residential-property'){
                      if(_.indexOf(unit_type_dropdown_values,typeoptions_vl.property_unit_type_display) == -1){
                        jQuery('.home_type').append('<option '+selected_type_dropdown+' value="'+typeoptions_vl.property_unit_type_display+'">'+typeoptions_vl.property_unit_type_display+'</option>')
                        
                          unit_type_dropdown_values[unit_type_dropdown_values_cnt] =  typeoptions_vl.property_unit_type_display;
                            unit_type_dropdown_values_cnt++;
                      }
                    }
                    else{

                      if(_.indexOf(unit_type_dropdown_values,typeoptions_vl.type_name) == -1){
                        jQuery('.home_type').append('<option '+selected_type_dropdown+' value="'+typeoptions_vl.type_name+'">'+typeoptions_vl.type_name+'</option>')

                          unit_type_dropdown_values[unit_type_dropdown_values_cnt] =  typeoptions_vl.type_name;
                          unit_type_dropdown_values_cnt++;
                      }
                    }


                  }


              })
            }   //end if(args.loadtypes == true ){   







               
  
}




            function mergeByProperty (arr1, arr2, prop) {

              console.log('^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^')
              _.each(arr2, function(arr2obj) {
                  var arr1obj = _.find(arr1, function(arr1obj) {
                      return arr1obj[prop] === arr2obj[prop];
                  });
                   
                  //If the object already exist extend it with the new values from arr2, otherwise just add the new object to arr1

                  console.log(arr1);
                  console.log(arr1obj)
                  arr1obj ? _.extend(arr1obj, arr2obj) : arr1.push(arr2obj);
              });
          }



var cities_args = {};

cities_args['show_cities_formidable_contact'] = true


if(jQuery('#current_post_type').length>0){
    cities_args['post_type'] = jQuery('#current_post_type').val();
    cities_args['nearby_properties'] = true;
}

if(jQuery('#home_city').length>0){
    cities_args['home_page_search'] = true;
}

get_cities_properties(cities_args) 


function get_cities_properties(args){


    var nearby_properties = (!_.isUndefined(args.nearby_properties)? args.nearby_properties : false );
    var show_cities_formidable_contact  = (!_.isUndefined(args.show_cities_formidable_contact)? args.show_cities_formidable_contact : false );
    var show_homepage_filters  = (!_.isUndefined(args.home_page_search)? args.home_page_search : false );




    var my_data = { 'post_type' :'both'
                     }

    if(_.isUndefined(window.all_properties)){
        jQuery.post(ajax_var.url, {        //the server_url
                        action: "get_residential_properties_list_ajx",                 //the submit_data array
                        data:my_data
                        }, function(response) {


                            console.log('RESPONSE')
                            console.log(response);
                            if(response.code == 'OK' ){
                                window.all_properties =  response.data;

                                if(nearby_properties==true){
                                      show_nearby_properties(args.post_type);      
                                } 
                                if(show_cities_formidable_contact==true){
                                    populate_properties_cities_on_contact()    
                                } 
                                if(show_homepage_filters == true){
                                    var ongoing_residential_properties = _.where(window.all_properties,{property_status:'ongoing',post_type:'residential-property'} );


                            console.log(window.all_properties)
                                    console.log('ongoing_residential_properties :&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&')

                                    var args ={     'loadcities' : true, 
                                                    'loadlocalities':true,
                                                    'loadtypes'     :true    
                                              }

                                    var selected_args = {    'selected_city' : '',
                                            'selected_locality' : '',
                                            'selected_type' : ''

                                        }     
  
                                    populate_homepage_search_drop_downs(ongoing_residential_properties,args,selected_args);
                                }
                                
                            }
                                

                        }
                    )
    }
    else{

        if(nearby_properties==true){
              show_nearby_properties(args.post_type);      
        }
        if(show_cities_formidable_contact==true){
            populate_properties_cities_on_contact()    
        }  

    }
                    
}


jQuery('#field_givedetails_city').live("click",function(evt){

    var localities  = window.search_options.locality.localities;

    var selected_city_id =  jQuery('option:selected', this).attr('attr_cityid');

    var current_form = jQuery(evt.target).closest('.frm_givedetails');

    current_form.find('#field_givedetails_locality').empty();
    current_form.find('#field_givedetails_locality').append('<option value="">Locality</option>')

    _.each(localities,function(options_vl,options_ky){

        if(options_vl.city_id == selected_city_id ){
            current_form.find('#field_givedetails_locality').append('<option value="'+options_vl.name+'">'+options_vl.name+'</option>')
        }        
    })


})

jQuery('.popmake-give-details').live("click",function(evt){

    console.log('*#*#*#*#*#*##*#*#*#*#*#*#*#*#*#*#**#*#*#*##*#*#*#*#*')
    console.log(window.search_options );

    var cities      = window.search_options.cities.cities ;
    var localities  = window.search_options.locality.localities;
    var types       = window.search_options.type;

    jQuery('.frm_givedetails').find('#field_givedetails_city').empty();
    jQuery('.frm_givedetails').find('#field_givedetails_locality').empty();

    jQuery('.frm_givedetails').find('#field_givedetails_city').append('<option value="" attr_cityid="" >City</option>');
    jQuery('.frm_givedetails').find('#field_givedetails_locality').append('<option value="" attr_cityid="" >Locality</option>');
    _.each(cities,function(options_vl,options_ky){

        jQuery('.frm_givedetails').find('#field_givedetails_city').append('<option  attr_cityid="'+options_vl.ID+'"  value="'+options_vl.name+'">'+options_vl.name+'</option>');

    })


    var display_type = "";
    jQuery('.frm_givedetails').find('#field_givedetails_type').empty(); 

    jQuery('.frm_givedetails').find('#field_givedetails_type').append('<option value=""   >Type</option>');

    _.each(types,function(options_typesvl,options_typesky){

        display_type = options_typesvl.property_unit_type;

        if(Current_property_type=="residential-property"){
            display_type+=' '+options_typesvl.property_type_name ;    
        }
        

        jQuery('.frm_givedetails').find('#field_givedetails_type').append('<option   value="'+display_type+'">'+display_type+'</option>');

    })

})





get_campaign_params()

function get_campaign_params() {

  console.log('get_campaign_params:------------------------------- START');

  var query = decodeURIComponent(window.location.search.substring(1));
  console.log(query)
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    jQuery('#field_'+pair[0]).val(pair[1])   

    for(var j=1;j<10;j++){
        jQuery('.frm-show-form').find('#field_'+pair[0]+j).val(pair[1])
    }


    console.log(pair[0]+" : "+pair[1])
  } 
    console.log('get_campaign_params:------------------------------- END ');


    jQuery('.frm-show-form').find('.campaign_frm_loading').html('');
    jQuery('.frm-show-form').find('.frm_submit').find('input').prop('disabled',false);


    /* jQuery('.campaign_frm_loading').html('')      
    jQuery('.btn_submit_compaign').prop('disabled',false)   */
}



function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}




jQuery('.popmake-availability-hold-popup').live('click',function(evt){

         var project_name    = jQuery('#current_property_title').val(); 
        var building        = jQuery(this).attr('popbuilding');
        var flatno        = jQuery(this).attr('popflatno');

        jQuery('#field_tellmore_project').val(project_name);
        jQuery('#field_tellmore_flat').val(building+' '+flatno);
        jQuery('#form_frm_tellmore').find('.sign-prop-title').html(project_name)
         

    })




});