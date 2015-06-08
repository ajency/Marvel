jQuery(document).ready(function($) {


      //the wrapper
    $("#myplugin_field").change(function() {  //the selector and event

        var my_data =[$("#myplugin_field").val()];
        $.post(ajaxurl, {        //the server_url
            action: "change",                 //the submit_data array
            data:my_data
        }, function(data) {                   //the callback_handler
            if (data) {
                $("#myother_field").html(data);
            }
        });
    });
    $('.save_additional_option').live("click",function(){

        console.log('saving custom field options ');

        var self = this;

        $(self).parent().find('.new_field_value').css({border:'red'});


        var custom_element = $(self).closest('.row').find('.custom_input_field');

        var attr_name = custom_element.attr('attr-name');



        if(custom_element.length>0)
            var Html_input_type =  custom_element[0].type.toLowerCase() || custom_element[0].nodeName.toLowerCase();
        else
            var Html_input_type =  'checkbox';

        var new_field_value = $(self).closest('.row').find('.additional_option').val();

        var field_type = $(this).closest('.row').find('.field_type').val();

        if(new_field_value==''){
            $(self).parent().find('.spn_additional_option_msg').addClass('admin_msg_error').html('Please enter new custom field value.');
            $(self).parent().find('.additional_option').addClass('admin_msg_error');
            return;
        }


        if(field_type == 'property-locality'){

            var my_data = { 'field_val'     : new_field_value ,
                            'field_type'    : field_type,
                            'post_type'     : $('#current_post_type').val(),
                            'property_city' : $('#custom_property-city').val()
                          }

        }
        else{

            var my_data = { 'field_val'  : new_field_value ,
                            'field_type' : field_type,
                            'post_type'  : $('#current_post_type').val(),
                          }

        }



        $.post(ajaxurl, {        //the server_url
            action: "save_custom_field_option",                 //the submit_data array
            data:my_data
        }, function(data) {                   //the callback_handler
            if (data) {

                if(data==true){
                    switch(Html_input_type){

                        case 'select'       :
                        case 'select-one'   :
                                                custom_element.append("<option value='"+new_field_value+"'>"+new_field_value+"</option>")
                                                $(self).closest('.row').find('.additional_option').val('');
                                                break;
                        case 'text'         :


                                            var new_element_html = '<span attr-field-val ="'+new_field_value+'" > <br/> &nbsp; '+new_field_value+'  <input type="text" value="" attr-name="'+attr_name+'" attr-value="'+new_field_value+'"     name="'+attr_name+'['+new_field_value+']"   class="postbox custom_input_field"  /> </span>';

                                            $(new_element_html).insertAfter(custom_element.last().closest('span'));
                                            $(self).closest('.row').find('.additional_option').val('');
                                            break;

                        case 'checkbox'     : 

                        var new_element_html = '<span attr-field-val ="'+new_field_value+'" class="row" >' 
                                            +'<input type="checkbox"  value="'+new_field_value+'" attr-name="<?php echo $element_id; ?>"  attr-value="'+new_field_value+'"   name="'+attr_name+'[]"   class="postbox custom_input_field  "  />' 
                                            +'<label class="inline" for="">'+new_field_value+'</label>'
                                            +'<input type="file" value="" attr-name=""  attr-value=""   name="'+attr_name+'_'+new_field_value+'"   class="postbox custom_input_field "  />'
                                            +'</span>' 
                                             $(new_element_html).insertAfter(custom_element.last().closest('span'));
                                            $(self).closest('.row').find('.additional_option').val('');

                                                  
                                            break;

                    }
                    $(self).parent().find('.spn_additional_option_msg').addClass('admin_msg_success').removeClass('admin_msg_error').html('<span>New Option Value Added Successfully</span>');
                    //$(self).parent().find('.additional_option').addClass('admin_msg_success');

                    setTimeout(function(){   
                        
                        $(self).parent().html('');

                    },3000)

                }
                $("#myother_field").html(data);
            }
        });
    })

    $('.add_custom_postmeta_options').click(function(){
        if( $(this).closest('.row').find('.span_additional_option').length <= 0 ){
            var span_additional_input_option_box = get_additional_option_box($(this).attr('field-type'));
            alert(span_additional_input_option_box)
            $(this).closest('.row').append(span_additional_input_option_box);
        }

    }).addClass('preview button button-large');


    $('.cancel_additional_option').live("click",function(){
             $(this).parent().remove();
    })


     $('.cancel_edit_custom_postmeta_options').live('click',function(){

        var self = this;
         $(self).html('Edit');
         $(self).removeClass('cancel_edit_custom_postmeta_options');
         $(self).addClass('edit_custom_postmeta_options');
         $(self).closest('.row').find('.edit_options_area').hide();


     })


    $('.edit_custom_postmeta_options').live('click',function(){


       //commented on 18may2015 6am $(this).closest('.row').find('.edit_options_area').show();
        $(this).parent().find('.edit_options_area').show();
        var loader_html = '<div id="np">'+
                           '<div class="spinner">'+
                               '<div class="spinner-icon" style="border-top-color: rgb(10, 194, 210); border-left-color: rgb(10, 194, 210);"></div>'+
                           '</div>'+
                       '</div>';

        $(this).parent().find('.edit_options_area').html(loader_html);
       

        $(this).html('Cancel Edit');
        $(this).addClass('cancel_edit_custom_postmeta_options');
        $(this).removeClass('edit_custom_postmeta_options');

        var field_type        = $(this).attr('field-type');
        var current_post_type = $('#current_post_type').val();
        var self = this;

        var my_data = { 'field_type' : field_type,
                        'post_type'  : current_post_type
                      }

       // $(self).closest('.row').find('.edit_options_area').html('');

        $.post(ajaxurl,{   //the server_url
                                        action: "get_custom_field_options",                 //the submit_data array
                                        data:my_data
                                    },
                                    function(response_data) {

                                    var data=[];                  //the callback_handler
                                        if (response_data) {
                                            console.log('RESPONSE DATA ');
                                            console.log(data)
                                            var html_field_options = '';

                                            if(field_type=='property-city'){

                                                var i=0;
                                                _.each(response_data,function(vl_res,ky_res){

                                                        data[i] = ky_res ;
                                                        i = i+1;
                                                })

                                            }
                                            else if(field_type == 'property-locality'){


                                                _.each(response_data,function(vl_res,ky_res){

                                                    if(ky_res==$('#custom_property-city').val()){
                                                        data  = vl_res ;
                                                    }



                                                })

                                            }
                                            else{
                                                var data = response_data;
                                            }


                                            for(var i=0;i<data.length;i++){

                                               var html_field_options = html_field_options +"<br/><div class='edit_option_row'>"+data[i]+ " &nbsp; <a href='javascript:void(0)' class='delete_field_option' field-value= '"+data[i]+"' field-name='"+field_type+"' >Delete</a> </div>";

                                            }

                                            console.log('html_field_options')
                                            console.log(html_field_options);

                                            /* commented on 18may2015
                                            $(self).closest('.row').find('.edit_options_area').html(html_field_options);
                                            $(self).closest('.row').find('.edit_options_area').html(html_field_options);
                                            */

                                            // $(self).closest('.admin_input').find('.edit_options_area').html(html_field_options);
                                            $(self).parent().find('.edit_options_area').html(html_field_options);

                                           // $("#myother_field").html(data);
                                        }
                                    });
        }).addClass('preview button button-large');

        $('.delete_field_option').live("click",function(){
            /* Delete option value for field type */

            var self = this;
            var custom_element = $(self).closest('.row').find('.custom_input_field');

            var Html_input_type =  custom_element[0].type.toLowerCase() || custom_element[0].nodeName.toLowerCase();


            if($(this).attr('field-name')=='property-city' || $(this).attr('field-name') == 'property-locality'){
                var my_data = { 'field_name'   : $(this).attr('field-name'),
                                'field_value'  : $(this).attr('field-value'),
                                'post_type'    : $('#current_post_type').val(),
                                'property_city': $('#custom_property-city').val()
                             }


            }
            else{

                var my_data = { 'field_name'   : $(this).attr('field-name'),
                                'field_value'  : $(this).attr('field-value'),
                                'post_type'    : $('#current_post_type').val()
                              }
            }


            $.post(ajaxurl,{   //the server_url
                    action: "delete_custom_field_option",                 //the submit_data array
                    data:my_data
                },
                function(data) {                   //the callback_handler
                    if (data==true) {


                    $(self).closest('.edit_option_row').remove();

                    //remove the element from select/radio/checkboxes

                        switch(Html_input_type){
                            case 'select-one':
                            case 'select'    :
                                                custom_element.find("[value='"+$(self).attr('field-value')+"']").remove();
                                                break;

                            case 'text'      :
                                                $('[attr-field-val="'+$(self).attr('field-value')+'"]').closest('.admin_new_add').remove();
                                                /* commented on 7june2015 $('[attr-field-val="'+$(self).attr('field-value')+'"]').remove(); */ 
                                                break;

                        }




                    }

                });


        })


        function get_additional_option_box(field_type){

            var addtional_option_box = '<div class="span_additional_option" > '+
            '<span class="spn_additional_option_msg"></span><br/>'+
            '<input type="text" name="additional_option" class="additional_option"  value=""/>'+
            '<input type="hidden"  class="field_type"  value="'+field_type+'"/>'+
            ' &nbsp; <input type="button"  class="button button-primary button-large save_additional_option " value="Save Option" /> '+
            ' &nbsp; <input type="button"  class="preview button button-large cancel_additional_option cancel_additional_option" value="Cancel Option" /> '+
            '<div class="edit_area"></div>'
            '</div>';

            return addtional_option_box;

        }









        $('#custom_property-city').live('change',function(){

            var selected_city = $('#custom_property-city').val();


            $.post(ajaxurl, {        //the server_url
                action: "get_search_options",                 //the submit_data array

            }, function(data) {                   //the callback_handler
                if (data) {

                    var property_city_locality = data['citylocality'];

                    //_.where(property_city_locality,{});
                    console.log(property_city_locality[selected_city]);


                    var localities_list = property_city_locality[selected_city];

                    $('#custom_property-locality').empty();

                    $('#custom_property-locality').append('<option value=""  >Select</option>');

                    _.each(localities_list,function(locality_vl, locality_k ){

                       //$('#custom_property-locality').append(new Option(locality_vl, locality_vl, true, true))
                       $('#custom_property-locality').append('<option value="'+locality_vl+'"  >'+locality_vl+'</option>');
                    })



                }
            });

        })





 /**
         * Restricts input box to enter only integers/floating point numbers
         * add class allownumericwithdecimal to input box for which only floating point numbers/integers should be allowed
         */
        function allow_float_input_values(){

            jQuery(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
                //this.value = this.value.replace(/[^0-9\.]/g,'');
              /*  if (event.keyCode == 9 || event.keyCode == 8 ||   event.keyCode == 46 || (event.keyCode>=35 && event.keyCode <=40 ) ) {
                    return true;
                }

              //  $(this).val($(this).val().replace(/[^0-9\.]/g,''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }*/

                if(event.which < 46  || event.which > 59) {
                         event.preventDefault();
                 } // prevent if not number/dot

                if(event.which == 46  && $(this).val().indexOf('.') != -1) {
                        event.preventDefault();
                } // prevent if already dot






            });

        }








          /**
         * Restricts input box to enter only integers  numbers
         * add class allownumericwithdecimal to input box for which only  integers should be allowed
         */
         function allow_integer_input_values(){

            jQuery(".allownumericwithoutdecimal").on("keypress keyup blur",function (evt) {


                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;


            });
        }


        allow_float_input_values();
        allow_integer_input_values();
































        setTimeout(function(){
            /* After creating a new group call make_div_dropable()  and pass id of the new div group
            ex: make_div_dropable("child_group_1")
            */
            make_div_dropable(".drag_area")


            if(jQuery(".draggable").length>0){
                console.log('draggable')
                jQuery(".draggable").draggable({ cursor: "crosshair",  revert:"invalid",helper:"clone"});
            }
            else{
                console.log('no dragables')
            }

        },200)






    function make_div_dropable(dropable_el){

    jQuery(dropable_el).droppable({ accept: ".draggable",
           drop: function(event, ui) {
                    // $(ui.draggable).clone().appendTo($(this));
                    console.log("drop");
                    jQuery(this).removeClass("border").removeClass("over");
                    var dropped = ui.draggable;
                    var droppedOn = jQuery(this);
                    jQuery(this).html('');
                    jQuery(dropped).clone().detach().css({top: 0,left: 0}).appendTo(droppedOn);

            },
            over: function(event, elem) {
                    jQuery(this).addClass("over");
                    console.log("over");
            },
            out: function(event, elem) {
                    jQuery(this).removeClass("over");
            }
      });

    }




$('.delete_property_type_layout').live("click",function(evt){
            /* Delete 2D Layout for the residential Property */ 

            var self = this;

            var curr_property_id = $(this).attr('property-id');
            var property_type = $(this).attr('property-type-value'); 

            var my_data = { 'property_id'    : curr_property_id,
                            'property_type'  : property_type                                 
                          } 

            $.post(ajaxurl,{   //the server_url
                    action: "delete_property_layout",                 //the submit_data array
                    data:my_data
                },
                function(data) {                   //the callback_handler
                    if (data==true) {


                    $(self).parent().find('img').remove();
                    $(self).remove();

                     

                    }

                });


        })






$('.delete_property_siteplan').live("click",function(evt){
            /* Delete 2D Layout for the residential Property */ 

            var self = this;
            var custom_field_name = $(this).attr('custom-field');
            var curr_property_id = $(this).attr('property-id');
            var attachment_id = $(this).attr('attr-value'); 

            var my_data = { 'custom_field_name' : custom_field_name,
                            'property_id'       : curr_property_id,
                            'attachment_id'     : attachment_id
                          } 

            $.post(ajaxurl,{   //the server_url
                    action: "delete_custom_file_field",                 //the submit_data array
                    data:my_data
                },
                function(data) {                   //the callback_handler
                    if (data==true) {


                    $(self).parent().find('img').remove();
                    $(self).remove(); 

                    }

                });


        })




















});