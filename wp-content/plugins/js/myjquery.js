jQuery(document).ready(function($) {    


      //the wrapper
    $("#myplugin_field").change(function() {  //the selector and event

        var my_data =[$("#myplugin_field").val()];
        $.post(ajax_object.ajax_url, {        //the server_url
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
        var custom_element = $(self).closest('.row').find('.custom_input_field');

        var attr_name = custom_element.attr('attr-name');

 

        if(custom_element.length>0)
            var Html_input_type =  custom_element[0].type.toLowerCase() || custom_element[0].nodeName.toLowerCase();
        else
            var Html_input_type =  'checkbox';
        
        var new_field_value = $(self).closest('.row').find('.additional_option').val()
        var my_data = { 'field_val'  : new_field_value ,
                        'field_type' : $(this).closest('.row').find('.field_type').val(),
                        'post_type'  : $('#current_post_type').val()
                      }




        $.post(ajax_object.ajax_url, {        //the server_url
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

                    }

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

    })


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

        
        $(this).closest('.row').find('.edit_options_area').show(); 

        $(this).html('Cancel Edit');
        $(this).addClass('cancel_edit_custom_postmeta_options');        
        $(this).removeClass('edit_custom_postmeta_options');    

        var field_type        = $(this).attr('field-type');
        var current_post_type = $('#current_post_type').val();
        var self = this;

        var my_data = { 'field_type' : field_type,
                        'post_type'  : current_post_type
                      }

        $(self).closest('.row').find('.edit_options_area').html('');

        $.post(ajax_object.ajax_url,{   //the server_url
                                        action: "get_custom_field_options",                 //the submit_data array
                                        data:my_data
                                    },
                                    function(data) {                   //the callback_handler
                                        if (data) {
                                            console.log('RESPONSE DATA ');
                                            console.log(data)
                                            var html_field_options = '';

                                            for(var i=0;i<data.length;i++){

                                               var html_field_options = html_field_options +"<br/><div class='edit_option_row'>"+data[i]+ " &nbsp; <a href='javascript:void(0)' class='delete_field_option' field-value= '"+data[i]+"' field-name='"+field_type+"' >Delete</a> </div>";

                                            }


                                            $(self).closest('.row').find('.edit_options_area').html(html_field_options);
                                            $(self).closest('.row').find('.edit_options_area').html(html_field_options);

                                           // $("#myother_field").html(data);
                                        }
                                    });
        })

        $('.delete_field_option').live("click",function(){
            /* Delete option value for field type */

            var self = this;
            var custom_element = $(self).closest('.row').find('.custom_input_field');

            var Html_input_type =  custom_element[0].type.toLowerCase() || custom_element[0].nodeName.toLowerCase();
      
            
            var my_data = { 'field_name'   : $(this).attr('field-name'),
                            'field_value'  : $(this).attr('field-value'),
                            'post_type'    : $('#current_post_type').val()
                          }

            $.post(ajax_object.ajax_url,{   //the server_url
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
                                                $('[attr-field-val="'+$(self).attr('field-value')+'"]').remove();
                                                break;

                        }



                        
                    }
                    
                });


        })


        function get_additional_option_box(field_type){

            var addtional_option_box = '<div class="span_additional_option" > '+
            '<input type="text" name="additional_option" class="additional_option"  value=""/>'+
            '<input type="hidden"  class="field_type"  value="'+field_type+'"/>'+
            ' &nbsp; <input type="button"  class="save_additional_option" value="Save Option" /> '+
            ' &nbsp; <input type="button"  class="cancel_additional_option" value="Cancel Option" /> '+
            '<div class="edit_area"></div>'
            '</div>';

            return addtional_option_box;

        }





});