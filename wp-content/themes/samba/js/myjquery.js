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
            make_div_dropable(".drag_area_block")


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




$('.del_prop_type_layout_img').live("click",function(evt){
            /* Delete 2D Layout Image for the residential Property */ 

            var self = this;

            var curr_property_id = $(this).attr('property-id');
            var property_type = $(this).attr('type-id'); 
            var attachment_id = $(this).attr('file-id'); 
            var file_type     = 'layout_image'

            var my_data = { 'property_id'    : curr_property_id,
                            'property_type'  : property_type,
                            'attachment_id'  : attachment_id,
                            'file_type'     : file_type                               
                          } 

            $.post(ajaxurl,{   //the server_url
                    action: "delete_property_type_layout_image_pdf_file",                 //the submit_data array
                    data:my_data
                },
                function(data) {                   //the callback_handler
                    if (data==true) {

                    $(self).parent().parent().append('<input type="file" class="cust-prop-type-layout-file" name="cust-prop-type-layout-file_'+property_type+'" id="cust-prop-type-layout-file_'+property_type+'">')
                     
                    $(self).parent().remove();
                    }

                });


        })








$('.del_prop_type_layout_pdf').live("click",function(evt){
            /* Delete 2D Layout Pdf for the residential Property */ 

            var self = this;

            var curr_property_id = $(this).attr('property-id');
            var property_type = $(this).attr('type-id'); 
            var attachment_id = $(this).attr('file-id'); 
            var file_type     = 'layout_pdf'

            var my_data = { 'property_id'    : curr_property_id,
                            'property_type'  : property_type,
                            'attachment_id'  : attachment_id,
                            'file_type'     : file_type                               
                          } 

            $.post(ajaxurl,{   //the server_url
                    action: "delete_property_type_layout_image_pdf_file",                 //the submit_data array
                    data:my_data
                },
                function(data) {                   //the callback_handler
                    if (data==true) {

                    $(self).parent().parent().append('<input type="file" class="cust-prop-type-layout-pdf" name="cust-prop-type-layout-pdf_'+property_type+'" id="cust-prop-type-layout-pdf_'+property_type+'">')
                     
                    $(self).parent().remove();
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



 






$('.get_property_type').live("click",function(evt){   

    var  property_type_row ='';
     
     if(_.isUndefined(window.property_type_options)){

         $.post(ajaxurl, {        //the server_url
            action: "get_property_type_option",                 //the submit_data array            
        }, function(data) {  
                            if(_.isArray(data)){

                                window.property_type_options = data ;
                                property_type_row =  generate_options_html();
                                $('.cust-prop-type-table').prepend(property_type_row)


                            }
                               

                    }) 

     }
     else{
            property_type_row =  generate_options_html()
            alert($('.cust-prop-type-table').length)
             $('.cust-prop-type-table').prepend(property_type_row)
     }

     



})

function generate_options_html(){


    var html = "<span class='adm_property_type_row'>"
               +" <span class='adm_property_type_span_first'> <select name='cust_prop_type_select[]' class='cust-prop-type-select'>";
         html = html + '<option value="" >Select</option>';
    _.each(window.property_type_options,function(vl,ky){
        html = html + '<option value="'+vl.ID+'" >'+vl.property_type+'</option>';

    })    

    html = html + '</select> </span>'
                + '<span class="cust-prop-type-layout adm_property_type_span" > <input type="file"  class="cust-prop-type-layout-file"  /> </span> ' 
                + '<span class="cust-prop-type-pdf adm_property_type_span" > <input type="file"   class="cust-prop-type-layout-pdf"   /> </span> '
                + '</span>' ;


    return html ;


}




$('.cust-prop-type-select').live("change",function(evt){   

    alert($('.cust-prop-type-select').val())

    var self = this;

    var current_selected_property_type_id = $(self).val() ;
    var adm_property_type_row = $(self).closest('.adm_property_type_row');

    if(current_selected_property_type_id ==''){
        adm_property_type_row.find('.cust-prop-type-layout-file').attr('name','').attr('id','');
        adm_property_type_row.find('.cust-prop-type-layout-pdf').attr('name','').attr('id','');
    }

    var selected_prop_types = [];
    var cnt_selected_prop_types = 0;
    var selected_prop_type_count =0;

    $('.cust-prop-type-select').each(function(){ 

        selected_prop_types[cnt_selected_prop_types] = $(this).val();
            if(current_selected_property_type_id == $(this).val()){
                selected_prop_type_count = selected_prop_type_count + 1;
            }
                
         cnt_selected_prop_types++;
    });

    if(selected_prop_type_count>=2){
        alert('Pleasechoose other Property Type, as this Property Type is already Selected.');
        $(self).val('')
        adm_property_type_row.find('.cust-prop-type-layout-file').attr('name','').attr('id','');
        adm_property_type_row.find('.cust-prop-type-layout-pdf').attr('name','').attr('id','');
    }
    else{


            if(adm_property_type_row.find('.cust-prop-type-layout-file').length>0){
                adm_property_type_row.find('.cust-prop-type-layout-file').attr('name','cust-prop-type-layout-file_'+current_selected_property_type_id).attr('id','cust-prop-type-layout-file_'+current_selected_property_type_id);    
            }
            else{
                adm_property_type_row.find('.cust-prop-type-layout').append('<input type="file"  class="cust-prop-type-layout-file" name="cust-prop-type-layout-file_'+current_selected_property_type_id+'"  id="cust-prop-type-layout-file_'+current_selected_property_type_id+'"  />')

            }    



            if(adm_property_type_row.find('.cust-prop-type-layout-pdf').length>0){
                adm_property_type_row.find('.cust-prop-type-layout-pdf').attr('name','cust-prop-type-layout-pdf_'+current_selected_property_type_id).attr('id','cust-prop-type-layout-pdf'+current_selected_property_type_id);    
            }
            else{
                adm_property_type_row.find('.cust-prop-type-pdf').append('<input type="file"  class="cust-prop-type-layout-pdf" name="cust-prop-type-layout-pdf_'+current_selected_property_type_id+'"  id="cust-prop-type-layout-pdf_'+current_selected_property_type_id+'"  />')                
            }
            
            
    }
   

})



$('.del_property_type_row').live("change",function(evt){   








    /* Delete 2D Layout Pdf for the residential Property */ 

            var self = this;

            var curr_property_id = $(this).attr('property-id');
            var property_type = $(this).attr('type-id'); 
            var attachment_id = $(this).attr('file-id'); 
            var file_type     = 'layout_pdf'

            var my_data = { 'property_id'    : curr_property_id,
                            'property_type'  : property_type,
                            'attachment_id'  : attachment_id,
                            'file_type'     : file_type                               
                          } 

            $.post(ajaxurl,{   //the server_url
                    action: "delete_property_type_row",                 //the submit_data array
                    data:my_data
                },
                function(data) {                   //the callback_handler
                    if (data==true) {

                    $(self).parent().parent().append('<input type="file" class="cust-prop-type-layout-pdf" name="cust-prop-type-layout-pdf_'+property_type+'" id="cust-prop-type-layout-pdf_'+property_type+'">')
                     
                    $(self).parent().remove();
                    }

                });



    $(this).closest('.adm_property_type_row').remove();
})


});