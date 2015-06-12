  



jQuery('.delete_property_type').live("click",function(evt){   

    var self = this; 
    var del_type_id = jQuery(this).attr('type_id');  

     var my_data = { 'type_id'  : del_type_id ,
                   }


      jQuery.post(ajaxurl, {        //the server_url
            action: "delete_property_type",                 //the submit_data array
            data:my_data
        }, function(data) { 

                            if(data.success == true ){
                                 console.log(jQuery(self).closest('tr').html())
                                 jQuery(self).closest('tr').remove();

                                  jQuery('.property_type_message').removeClass('error')
                                                        .removeClass('update-nag')
                                                        .addClass('updated')
                                                        .html('<p>Property Type Deleted</p>')
                            }
                            else{

                                 jQuery('.property_type_message').addClass('error')
                                                        .removeClass('update-nag')
                                                        .removeClass('updated')
                                                        .html('<p>Error Deleting Property Type</p>')

                            }

                    }) 



})






jQuery('.edit_property_type').live("click",function(evt){   

    var self = this; 
    var edit_type_id = jQuery(this).attr('type_id');  
    var edit_type_name = jQuery(this).attr('type_name');  
    var edit_type_bedrooms = jQuery(this).attr('bedrooms');  

    jQuery('#edit_id').val(edit_type_id) 
    jQuery('#new-property-bedrooms').val(edit_type_bedrooms);
    jQuery('#new-property-type').val(edit_type_name);

    jQuery('.save_property_type').attr('id','update_property_type').attr('name','update_property_type') 
    jQuery('.add_edit_type_formtitle').find('.title').html('Edit Property Type');
     jQuery('.cancel_edit_property_type').show(); 
 

})



jQuery('.add_new_type_form').live("click",function(evt){   

    display_add_new_property_type_form();
})

jQuery('.cancel_edit_property_type').live("click",function(evt){   

    display_add_new_property_type_form();
})

function display_add_new_property_type_form(){
     jQuery('#edit_id').val('') 
    jQuery('#new-property-bedrooms').val('');
    jQuery('#new-property-type').val('');

    jQuery('.save_property_type').attr('id','add_new_property_type').attr('name','add_new_property_type') 
    jQuery('.add_edit_type_formtitle').find('.title').html('Add New Property Type');
    jQuery('.cancel_edit_property_type').hide();
}








//jQuery('#update_property_type').live("click",function(){
jQuery('.save_property_type').live("click",function(){

        console.log('Updating custom field options ');

        var self = this;    

         var edit_id       = jQuery('#edit_id').val();  
         var num_bedrooms  = jQuery('#new-property-bedrooms').val();
         var property_type = jQuery('#new-property-type').val();

       

         if(property_type==''){
            alert('Please enter property Type')
            return

         }
         if(num_bedrooms==''){ 
            alert('Please enter number of bedrooms')
            return

         }


         var my_data = { 'num_bedrooms'  : num_bedrooms ,
                         'property_type' : property_type,
                         'edit_id'       : edit_id
                           
                       } 


        jQuery.post(ajaxurl, {         
            action: "save_property_type",                  
            data:my_data
        }, function(data) { 

           //the callback_handler;
            if (data) {
                if(data.success!=true){

                    jQuery('.property_type_message').addClass('error')
                                                        .removeClass('update-nag')
                                                        .removeClass('updated')
                                                        .html('<p>Error Saving Property Type</p>')
                }
                else if(data.success==true){


                    if(edit_id==''){ /* Add New Property Type*/
                        jQuery('#new-property-bedrooms').val('');
                        jQuery('#new-property-type').val('');

                      
                        var last_row_class = jQuery('table.propertytypes').find('tr:last').hasClass('alternate')

                        var new_row_class =' ';
                        if(last_row_class==false){
                            new_row_class = ' alternate ';
                        }

                        var property_type_row = '<tr class="'+new_row_class+'">'
                                                +'<td class="property_type column-property_type "><span class="spn_property_type">'+property_type+'</span>'
                                                +'        <div class="row-actions">'
                                                +'            <span class="edit">'
                                                +'                <a href="javascript:void(0)" class="edit_property_type" type_id="'+data.ID+'"   type_name="'+property_type+'" bedrooms="'+num_bedrooms+'" >Edit</a> | '
                                                +'            </span>'
                                                +'            <span class="delete">'
                                                +'                <a href="javascript:void(0)" class="delete_property_type" type_id="'+data.ID+'">Delete</a>'
                                                +'            </span>'
                                                +'        </div>'
                                                +'    </td>'
                                                +'    <td class="number_bedrooms column-number_bedrooms">'+num_bedrooms
                                                +'    </td>'
                                                +'</tr>';

                        jQuery('table.propertytypes tbody').append(property_type_row);
                        jQuery('.property_type_message').removeClass('error')
                                                        .removeClass('update-nag')
                                                        .addClass('updated')
                                                        .html('<p>New Property Type Added</p>')

                    }
                    else{  /* Update Property Type*/

                        var edit_element =  jQuery(".edit_property_type[type_id='"+data.ID+"']") 

                        alert(".edit_property_type[type_id='"+data.ID+"']")
                        alert(jQuery(".edit_property_type[type_id='"+data.ID+"']").length )

                        edit_element.attr('type_name',property_type)
                                    .attr('bedrooms',num_bedrooms)
                                    .closest('tr').find('td:last').html(num_bedrooms)
                                    .closest('tr').find('.spn_property_type').html(property_type)

                        jQuery('.property_type_message').removeClass('error')
                                                        .removeClass('update-nag')
                                                        .addClass('updated')
                                                        .html('<p>Property Type Updated</p>')

                    }

                    

                    

                }
                 
            }
        });
    })


        /**
         * Restricts input box to enter only integers  numbers
         * add class allownumericwithdecimal to input box for which only  integers should be allowed
         */
         function allow_integer_input_values(element){
 
            jQuery(element).on("keypress keyup blur",function (evt) {


                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;


            });
        }

        jQuery(document).ready(function(){

        allow_integer_input_values('#new-property-bedrooms');    
        })

        