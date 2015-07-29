


/* Residential properties settings Property Unit Type */
jQuery('.delete_property_unit_type').live("click",function(evt){  

 
var delete_prop_name = jQuery(this).attr('type_name');
var delete_response = confirm("Are you sure You want to delete  '"+delete_prop_name+"' unit type?"); 

if (delete_response !== true) {
    return
}  



 

    var self = this; 
    var del_type_id = jQuery(this).attr('type_id');  

     var my_data = { 'type_id'  : del_type_id ,
                   }


      jQuery.post(ajaxurl, {        //the server_url
            action: "delete_property_unit_type",                 //the submit_data array
            data:my_data
        }, function(data) { 

                            if(data.success == true ){
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

                            }

                    }) 



})






jQuery('.edit_property_unit_type').live("click",function(evt){   

    var self = this; 
    var edit_type_id = jQuery(this).attr('type_id');  
    var edit_type_name = jQuery(this).attr('type_name');
    var edit_material_type = jQuery(this).attr('material_type'); 
    var edit_type_bedrooms = jQuery(this).attr('bedrooms'); 
    var edit_type_proptype_id = jQuery(this).attr('property_type_id');   

    jQuery('#edit_id').val(edit_type_id) 
    jQuery('#new-property-bedrooms').val(edit_type_bedrooms);
    jQuery('#new-property-unit-type').val(edit_type_name);
    jQuery('#material-type').val(edit_material_type);
    jQuery('#new-prop-type').val(edit_type_proptype_id);

    jQuery('.save_property_unit_type').attr('id','update_property_unit_type').attr('name','update_property_unit_type') 
    jQuery('.add_edit_type_formtitle').find('.title').html('Edit Property Unit Type');
    jQuery('.cancel_edit_property_unit_type').show(); 
 

})



jQuery('.add_new_type_form').live("click",function(evt){   

    display_add_new_property_unit_type_form();
})

jQuery('.cancel_edit_property_unit_type').live("click",function(evt){   

    display_add_new_property_unit_type_form();
})

function display_add_new_property_unit_type_form(){
     jQuery('#edit_id').val('') 
    jQuery('#new-property-bedrooms').val('');
    jQuery('#new-property-unit-type').val('');
    jQuery('#material-group').val('');

    jQuery('.save_property_unit_type').attr('id','add_new_property_unit_type').attr('name','add_new_property_unit_type') 
    jQuery('.add_edit_type_formtitle').find('.title').html('Add New Property Unit Type');
    jQuery('.cancel_edit_property_unit_type').hide();
}





     



//jQuery('#update_property_unit_type').live("click",function(){
jQuery('.save_property_unit_type').live("click",function(){

        console.log('Updating custom field options ');

        var self = this;    

         var edit_id            = jQuery('#edit_id').val();  
         var num_bedrooms       = jQuery('#new-property-bedrooms').val();
         var property_unit_type = jQuery('#new-property-unit-type').val();
         var material_type      = jQuery('#material-type').val();
         var prop_type_id       = jQuery('#new-prop-type').val();
         var post_type          = jQuery('#current_post_type').val();

         
         jQuery(self).parent().find('.spinner').css('display','inline-block');
         jQuery(self).prop('disabled',true)

         if(property_unit_type==''){
            alert('Please enter property unit type')
            return

         }
         if(material_type==''){
            alert('Please enter material type')
            return

         }
         if(num_bedrooms==''){ 
            alert('Please enter number of bedrooms')
            return

         }

          if(prop_type_id==''){ 
            alert('Please select property type')
            return

         }


         var my_data = { 'num_bedrooms'  : num_bedrooms ,
                         'property_unit_type' : property_unit_type,
                         'material_type' : material_type,
                         'edit_id'       : edit_id,
                         'prop_type_id'  : prop_type_id,
                         'post_type'     : post_type   
                           
                       } 


        jQuery.post(ajaxurl, {         
            action: "save_property_unit_type",                  
            data:my_data
        }, function(data) { 
       jQuery(self).parent().find('.spinner').css('display','none');
       jQuery(self).prop('disabled',false)

           //the callback_handler;
            if (data) {
                if(data.success!=true){

                    jQuery('.property_unit_type_message').addClass('error')
                                                        .removeClass('update-nag')
                                                        .removeClass('updated')
                                                        .html('<p>Error Saving Property Unit Type</p>')
                }
                else if(data.success==true){


                    if(edit_id==''){ /* Add New Property Unit Type*/
                        jQuery('#new-property-bedrooms').val('');
                        jQuery('#new-property-unit-type').val('');
                         jQuery('#material-type').val('');
                        var new_prop_type_name = jQuery("#new-prop-type option:selected").text();
                       
                        jQuery('#new-prop-type').val('');
                      
                        var last_row_class = jQuery('table.propertyunittypes').find('tr:last').hasClass('alternate')

                        var new_row_class =' ';
                        if(last_row_class==false){
                            new_row_class = ' alternate ';
                        }

                        var property_unit_type_row = '<tr class="'+new_row_class+'">'
                                                +'<td class="property_unit_type column-property_unit_type "><span class="spn_property_unit_type">'+property_unit_type+'</span>'
                                                +'        <div class="row-actions">'
                                                +'            <span class="edit">'
                                                +'                <a href="javascript:void(0)" class="edit_property_unit_type" type_id="'+data.ID+'"   type_name="'+property_unit_type+'" material_type="'+material_type+'" bedrooms="'+num_bedrooms+'"  property_type_id="'+prop_type_id+'">Edit</a> | '
                                                +'            </span>'
                                                +'            <span class="delete">'
                                                +'                <a href="javascript:void(0)" class="delete_property_unit_type" type_id="'+data.ID+'"   type_name="'+property_unit_type+'" >Delete</a>'
                                                +'            </span>'
                                                +'        </div>'
                                                +'    </td><td class="material_type column-material_type">'+material_type
                                                +'    </td>'
                                                +'    <td class="number_bedrooms column-number_bedrooms">'+num_bedrooms
                                                +'    </td>'
                                                +'    <td class="property_type column-property_type">'+new_prop_type_name+'</td>'
                                                +'</tr>';

                        jQuery('table.propertyunittypes tbody').append(property_unit_type_row);
                        jQuery('.property_unit_type_message').removeClass('error')
                                                        .removeClass('update-nag')
                                                        .addClass('updated')
                                                        .html('<p>New Property Unit Type Added</p>')

                    }
                    else{  /* Update Property Unit Type*/

                        var edit_element =  jQuery(".edit_property_unit_type[type_id='"+data.ID+"']") 
                        var delete_element =  jQuery(".delete_property_unit_type[type_id='"+data.ID+"']") 

                      
                        var new_prop_type_name = jQuery("#new-prop-type option:selected").text();
                        
                         

                        edit_element.attr('type_name',property_unit_type)
                                    .attr('bedrooms',num_bedrooms)
                                    .attr('property_type_id',prop_type_id)
                                    .attr('material_type',material_type)
                                    .closest('tr').find('td:last').html(new_prop_type_name)
                                    .closest('tr').find('td.material_type').html(material_type)
                                    .closest('tr').find('.spn_property_unit_type').html(property_unit_type)
                                    .closest('tr').find( "td:nth-last-child(2)" ).html(num_bedrooms);

                        delete_element.attr('type_name',property_unit_type)            

                        jQuery('.property_unit_type_message').removeClass('error')
                                                        .removeClass('update-nag')
                                                        .addClass('updated')
                                                        .html('<p>Property Unit Type Updated</p>')

                    }

                    

                    

                }
                 
            }
        });
    })

/* End Residential properties settings Property Unit Type */






/* Residential properties settings Property Type */
jQuery('.delete_property_type').live("click",function(evt){   


    var delete_prop_name = jQuery(this).attr('type_name');
    var delete_response = confirm("Are you sure You want to delete  '"+delete_prop_name+"' property type?"); 

    if (delete_response !== true) {
        return
    }  

    var self = this; 
    var del_type_id = jQuery(this).attr('type_id');  

     var my_data = { 'type_id'  : del_type_id ,
                     'post_type': jQuery('#current_post_type').val()
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
    var edit_material_group = jQuery(this).attr('data-material');   
    var edit_type_bedrooms = jQuery(this).attr('bedrooms');  

    jQuery('#edit_id').val(edit_type_id) 
    jQuery('#new-property-bedrooms').val(edit_type_bedrooms);
    jQuery('#new-property-type').val(edit_type_name);
    jQuery('#material-group').val(edit_material_group);

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
    jQuery('#material-group').val('');


    jQuery('.save_property_type').attr('id','add_new_property_type').attr('name','add_new_property_type') 
    jQuery('.add_edit_type_formtitle').find('.title').html('Add New Property Type');
    jQuery('.cancel_edit_property_type').hide();
}








//jQuery('#update_property_type').live("click",function(){
jQuery('.save_property_type').live("click",function(){

        console.log('Updating custom field options ');

        var self = this;    
        jQuery(self).parent().find('.spinner').css('display','inline-block');
        jQuery(self).prop('disabled',true)

         var edit_id        = jQuery('#edit_id').val();  
         var num_bedrooms   = jQuery('#new-property-bedrooms').val();
         var property_type  = jQuery('#new-property-type').val();
         var material_group = jQuery('#material-group').val();
         var post_type      = jQuery(this).attr('post_type');

               

         if(property_type==''){
            alert('Please enter Property Type')
            return

         }

         if(material_group==''){
            alert('Please enter Material Group')
            return

         }


         if(num_bedrooms==''){ 
            alert('Please enter number of bedrooms')
            return

         }


         var my_data = { 'num_bedrooms'  : num_bedrooms ,
                         'property_type' : property_type,
                         'material_group' : material_group,
                         'edit_id'       : edit_id,
                         'post_type'      : post_type
                           
                       } 


        jQuery.post(ajaxurl, {         
            action: "save_property_type",                  
            data:my_data
        }, function(data) { 
            
            jQuery(self).parent().find('.spinner').css('display','none');
            jQuery(self).prop('disabled',false);
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
                        jQuery('#material-group').val('');

                      
                        var last_row_class = jQuery('table.propertytypes').find('tr:last').hasClass('alternate')

                        var new_row_class =' ';
                        if(last_row_class==false){
                            new_row_class = ' alternate ';
                        }

                        var property_type_row = '<tr class="'+new_row_class+'">'
                                                +'<td class="property_type column-property_type "><span class="spn_property_type">'+property_type+'</span>'
                                                +'        <div class="row-actions">'
                                                +'            <span class="edit">'
                                                +'                <a href="javascript:void(0)" class="edit_property_type" type_id="'+data.ID+'"   type_name="'+property_type+'" data-material="'+material_group+'" bedrooms="'+num_bedrooms+'" >Edit</a> | '
                                                +'            </span>'
                                                +'            <span class="delete">'
                                                +'                <a href="javascript:void(0)" class="delete_property_type" type_id="'+data.ID+'"   type_name="'+property_type+'" >Delete</a>'
                                                +'            </span>'
                                                +'        </div>'
                                                +'    </td><td>'+material_group+'</td>'                                               
                                                +'</tr>';

                        jQuery('table.propertytypes tbody').append(property_type_row);
                        jQuery('.property_type_message').removeClass('error')
                                                        .removeClass('update-nag')
                                                        .addClass('updated')
                                                        .html('<p>New Property Type Added</p>')

                    }
                    else{  /* Update Property Type*/

                        var edit_element =  jQuery(".edit_property_type[type_id='"+data.ID+"']") 
                        var delete_element =  jQuery(".delete_property_type[type_id='"+data.ID+"']") 

                        edit_element.attr('type_name',property_type)
                                    .attr('bedrooms',num_bedrooms)
                                    .attr('data-material',material_group)
                                    .closest('tr').find('td:last').html(material_group)
                                    .closest('tr').find('.spn_property_type').html(property_type);
                        delete_element.attr('type_name',property_type)

                        jQuery('.property_type_message').removeClass('error')
                                                        .removeClass('update-nag')
                                                        .addClass('updated')
                                                        .html('<p>Property Type Updated</p>')

                    }

                    

                    

                }
                 
            }
        });
    })
/* End Residential properties settings Property Type */




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




        /**
         * Restricts input box to enter only integers/floating point numbers
         * add class allownumericwithdecimal to input box for which only floating point numbers/integers should be allowed
         */
        function allow_float_input_values(element){

            jQuery(element).on("keypress keyup blur",function (event) {
                //this.value = this.value.replace(/[^0-9\.]/g,'');
              /*  if (event.keyCode == 9 || event.keyCode == 8 ||   event.keyCode == 46 || (event.keyCode>=35 && event.keyCode <=40 ) ) {
                    return true;
                }

              //  $(this).val($(this).val().replace(/[^0-9\.]/g,''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }*/

                if(event.which < 46  || event.which > 59 || event.which==47) {
                         event.preventDefault();
                 } // prevent if not number/dot

                if(event.which == 46  && jQuery(this).val().indexOf('.') != -1) {
                        event.preventDefault();
                } // prevent if already dot






            });

        }





        jQuery(document).ready(function(){

        //allow_integer_input_values('#new-property-bedrooms'); 
        allow_float_input_values('#new-property-bedrooms'); 

        })

        