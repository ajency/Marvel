jQuery(document).ready(function($) {



	$('.btm_unit_type_btn').live("click",function(evt){

		var tab_link = $(this).attr('tab-link')
		console.log(' tab link '+tab_link)
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
 
        event.preventDefault();
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


     })

    //$('.view_properties_rent').live("click",function(evt){
   $('.view_properties_rent .button_left a.wpb_button_a').live("click",function(evt){
        
        event.preventDefault();
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


            console.log('get_services_properties_ajx data');
            console.log(data)
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

                


            }
            console.log(html);

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
             


                console.log('servproperties_vl');
                console.log(servproperties_vl)
                            if(servproperties_vl.type == current_property_type){
                console.log('type match '+servproperties_vl.type+' : '+current_property_type);

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
                                                '        <a href="#" class="wpb_button enq_ico"><span class="wpb_button wpb_btn-inverse wpb_regularsize"></span></a>'+
                                                '    </div>'+
                                                '</div>';
                        }










                        else if(current_project =='' || (current_project!=servproperties_vl.Project_Name) ){
                           current_project = servproperties_vl.Project_Name;
                            //echo "<h1> New Project </h1>";

                            if($('#services_project_type').val=="rent"){
                                var rent_resale_head = 'Rent (Rs./Month)';
                            }
                            else if($('#services_project_type').val=="resale"){
                                var rent_resale_head = 'Cost';   
                            }
                    
                        property_list_html = property_list_html+
                 

                                            '<div class="prk_inner_block vc_row-fluid centered columns forent">'+
                                            '    <div class="row partintro">'+
                                            '        <div class="vc_col-sm-12 wpb_column vc_column_container bgrey">'+
                                            '            <div class="wpb_wrapper img_hold">'+
                                            '                <div class="clearfix"></div>'+
                                            '                <div class="work_cont">'+
                                            '                    <img src="'+servproperties_vl.Image_File_Name+'">'+
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
                                            '                        <span class="loca">'+servproperties_vl.Area+'</span>'+
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
                                            '                                <small class="clr_lt">Area (SQ.FT.)</small>'+
                                            '                            </div>'+
                                            '                            <div class="set">'+
                                            '                                <small class="clr_lt">No. Of Rooms</small>'+
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
                                                        property_list_html = property_list_html+
                                                                        '</div>'+
                                                                        '<div class="set alrt">'+
                                                                        '    <a href="#" class="wpb_button enq_ico"><span class="wpb_button wpb_btn-inverse wpb_regularsize"></span></a>'+
                                                                        '</div>'+
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


});