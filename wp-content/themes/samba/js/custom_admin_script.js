


/* Residential properties settings Property Unit Type */
jQuery('.delete_property_unit_type').live("click",function(evt){  

 
var delete_prop_name = jQuery(this).attr('type_name');
var delete_response = confirm("Are you sure You want to delete  '"+delete_prop_name+"' unit type?"); 

if (delete_response !== true) {
    return
}  



 

    var self = this; 
    var del_type_id = jQuery(this).attr('type_id');  

     var my_data = { 'type_id'    : del_type_id ,
                     'post_type' : jQuery('#current_post_type').val() 
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
         var return_validation  = false;

         
         jQuery(self).parent().find('.spinner').css('display','inline-block');
         jQuery(self).prop('disabled',true)

         if(property_unit_type==''){
            alert('Please enter property unit type')
            var return_validation = true

         }
         if(material_type==''){
            alert('Please enter material type')
            var return_validation = true

         }
         if(num_bedrooms=='' && post_type=='residential-property'){ 
            alert('Please enter number of bedrooms')
            var return_validation = true

         }

          if(prop_type_id==''){ 
            alert('Please select property type')
             var return_validation = true

         }

         if(return_validation == true){
            jQuery(self).parent().find('.spinner').css('display','none');
            jQuery(self).prop('disabled',false)
            return ;
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
                                                +'    </td>';

                         if(post_type=="residential-property"){
                            property_unit_type_row =  property_unit_type_row +
                                                '    <td class="number_bedrooms column-number_bedrooms">'+num_bedrooms
                                                +'    </td>' ;
                         }
                                               
                         property_unit_type_row =  property_unit_type_row +
                                                '    <td class="property_type column-property_type">'+new_prop_type_name+'</td>'
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
                                    .attr('property_type_id',prop_type_id)
                                    .attr('material_type',material_type)
                                    .closest('tr').find('td:last').html(new_prop_type_name)
                                    .closest('tr').find('td.material_type').html(material_type)
                                    .closest('tr').find('.spn_property_unit_type').html(property_unit_type)
                                    .closest('tr').find( "td:nth-last-child(2)" ).html(num_bedrooms);

                        if(post_type=="residential-property"){
                            edit_element.attr('bedrooms',num_bedrooms)
                         }

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


    var delete_prop_name = jQuery(this).attr('type_label');
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
    var edit_type_label = jQuery(this).attr('type_label');
    var edit_type_code = jQuery(this).attr('data-code');   
    

    jQuery('#edit_id').val(edit_type_id) 
    jQuery('#property_type_label').val(edit_type_label);
    jQuery('#property_type_code').val(edit_type_code);
    jQuery('#property_type_code').attr('disabled','disabled');

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
    jQuery('#property_type_label').val('');    
    jQuery('#property_type_code').val('');


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
         var property_type_code  = jQuery('#property_type_code').val();
         var property_type_label = jQuery('#property_type_label').val();
         var post_type      = jQuery(this).attr('post_type');

               

         if(property_type_code==''){
            alert('Please enter Property Type Code')
            return

         }

         if(property_type_label==''){
            alert('Please enter Label')
            return

         }


         
         var type_data = {
                         'property_type' : property_type_label,
                         'mkt_group_desc' : property_type_code,
                         'edit_id'       : edit_id,
                         'post_type'      : post_type
                           
                       } 


        jQuery.post(ajaxurl, {         
            action: "save_property_type",                  
            data:type_data
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

                    console.log('Saved successfully, type');


                    if(edit_id==''){ /* Add New Property Type*/
                        jQuery('#property_type_label').val('');    
                        jQuery('#property_type_code').val('');

                      
                        var last_row_class = jQuery('table.propertytypes').find('tr:last').hasClass('alternate')

                        var new_row_class =' ';
                        if(last_row_class==false){
                            new_row_class = ' alternate ';
                        }

                        var property_type_row = '<tr class="'+new_row_class+'">'
                                                +'<td>'+property_type_code+'</td>'
                                                +'<td class="property_type column-property_type "><span class="spn_property_type">'+property_type_label+'</span>'
                                                +'        <div class="row-actions">'
                                                +'            <span class="edit">'
                                                +'                <a href="javascript:void(0)" class="edit_property_type" type_id="'+data.ID+'"   type_label="'+property_type_label+'" data-code="'+property_type_code+'">Edit</a> | '
                                                +'            </span>'
                                                +'            <span class="delete">'
                                                +'                <a href="javascript:void(0)" class="delete_property_type" type_id="'+data.ID+'"   type_label="'+property_type_label+'" >Delete</a>'
                                                +'            </span>'
                                                +'        </div>'
                                                +'    </td>'                                               
                                                +'</tr>';

                        jQuery('table.propertytypes tbody').append(property_type_row);
                        jQuery('.property_type_message').removeClass('error')
                                                        .removeClass('update-nag')
                                                        .addClass('updated')
                                                        .html('<p>New Property Type Added</p>')

                    }
                    else{  /* Update Property Type*/

                        jQuery('#edit_id').val('') 
                        jQuery('#property_type_label').val('');    
                        jQuery('#property_type_code').val('');

                        var edit_element =  jQuery(".edit_property_type[type_id='"+data.ID+"']") 
                        var delete_element =  jQuery(".delete_property_type[type_id='"+data.ID+"']") 

                        edit_element.attr('type_label',property_type_label)
                                    .attr('data-code',property_type_code);
                                    //.closest('tr').find('td:last').html(property_type_label);
                                    //.closest('tr').find('.spn_property_type').html(property_type_label);

                                    edit_element.closest('tr').find('.spn_property_type').html(property_type_label);

                        delete_element.attr('type_label',property_type_label);

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




        jQuery(document).on('click', '#generate_unit_types', function() {
            
            var property_id = jQuery(this).attr('data-postId');
                        
            var data = {
                'action': 'generatePropertyUnits',
                'property_id': property_id
            };

            jQuery('#unit_load_loader').show();

            jQuery.post(ajaxurl, data, function(response) {
               var property_units = JSON.parse(response);
               if(property_units.status == 'true'){
                jQuery('#unit_type_list').empty();
                jQuery('#unit_type_list').html(property_units.units);
                jQuery('#generate_unit_types').html('Regenerate Units');
               }else{
                alert('No unit type found for this property!');
               }
               jQuery('#unit_load_loader').hide();
            });
        });





        })

        