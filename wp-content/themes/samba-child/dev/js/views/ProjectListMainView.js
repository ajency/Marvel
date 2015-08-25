/**
 * The Property List Main View.
 *
 */



        var ProjectListMainView = Backbone.View.extend({

            el			: '#main',

            template :' #projectlistMainTemplate',
            /*events : {
                'click .btn_compare'    : 'show_compare2',

            },*/
              events : {

                'click .add_to_compare'   : 'add_property_for_comparison4',
                'click .remove_from_comp' : 'remove_comparison_property'


            },



        remove_comparison_property : function(evt){

            evt.preventDefault();

            var target_ele = jQuery(evt.target);

            var property_id = target_ele.closest('.drag_area').attr('property-id');

             
            target_ele.closest('.drag_area').attr('property-id','') 

            //var prop_id = target_ele.closest('.drag_area').attr('property_id');

            target_ele.closest('.drag_area_block2').find('.btn_compare').attr('href','javascript:void(0)').addClass('disabled');

            target_ele.closest('.drag_area').html('Drag for Comparision').removeClass('after_drag')

         //   jQuery('.single_p_w[property-id="'+property_id+'"]').find('.compare').remove();


            jQuery('.single_p_w[property-id="'+property_id+'"]').removeClass('added_for_compare');

        },

        add_property_for_comparison4:function(evt){



        console.log("drop");
              
 
        console.log("Add property for comparison drop:--");

        //        console.log($(self).html())

        //      alert($(self).attr('property-title'))

        var dropped = jQuery(evt.target);

        //Remove property from compare box if clicked again on add to compare icon
        var existing_compare_property =  jQuery('.drag_area_block2').find('.drag_area[property-id="'+dropped.attr('property-id')+'"]') 
        if (existing_compare_property.length>0) { 
            existing_compare_property.html('Drag for Comparision').removeClass('after_drag');
            existing_compare_property.attr('property-id','');

            jQuery('.drag_area_block2').find('.btn_compare').attr('href','javascript:void(0)').addClass('disabled');
            return;
        }; //End Remove property from compare box if clicked again on add to compare icon
        
 

        if( jQuery('.drag_area_block2').find('.one').attr('property-id')=='' || _.isUndefined(jQuery('.drag_area_block2').find('.one').attr('property-id')) ){
            var droppedOn = jQuery('.drag_area_block2').find('.one') ;

        }
        else{
            var droppedOn = jQuery('.drag_area_block2').find('.two') ;

            if(jQuery('.drag_area_block2').find('.one').attr('property-id')== dropped.attr('property-id')){

                //ui.draggable.animate(ui.draggable.data().origPosition,"fast");

                    alert('Please Select two different projects to compare')
                    return;

            }
        }


        console.log('droppedOn:---------------------')
        console.log(droppedOn)
        droppedOn.removeClass("border").removeClass("over");
        droppedOn.html('');
        /* commented on 8june2015 2_30pm
        jQuery(this).removeClass("border").removeClass("over");
         var droppedOn = jQuery(this);
        jQuery(this).html('');
         */


        console.log('droppable.........................')

        console.log(dropped)
        console.log('-=-=-=-=-=-=-=-=-=-=-=-=-==-=-')
        var draggable_property_title = dropped.attr('property-title');
        var draggable_property_address = dropped.attr('property-address');
        var draggable_property_id = dropped.attr('property-id');


        var draggable_property_image = dropped.find('.single_p_img').find('img').attr('src');

        var prev_dropedon_prop_id =droppedOn.attr('property-id')

      //  jQuery('.property_span_'+prev_dropedon_prop_id).find('.single_p_img').find('.compare').remove();

        droppedOn.attr('property-id',draggable_property_id)

        jQuery('.single_p_w[property-id="'+draggable_property_id+'"]').addClass('added_for_compare');

        //var cmp_html = "<div ><b>"+draggable_property_title+"</b><br/>"+draggable_property_address+"</div>";



        var cmp_html = '<div class="after_drag_content">'+
                        '<p class="dragged_title">'+
                            '<span class="single_p_title">'+draggable_property_title+'</span><br>'+
                            '<span class="single_p_location">'+draggable_property_address+'</span>'+
                            '<a href="javascript:void(0)" class="remove_from_comp">×</a>'+
                        '</p>'+
                    '</div>'



        console.log(cmp_html);
        //jQuery(dropped).clone().detach().css({top: 0,left: 0}).appendTo(droppedOn);
        jQuery(cmp_html).appendTo(droppedOn);


         var prop1_id = jQuery('.top-compar').find('.one').attr('property-id');
         var prop2_id = jQuery('.top-compar').find('.two').attr('property-id');




        // if(!_.isUndefined(prop1_id) || !_.isUndefined(prop1_id)){

            var ur = "#compare";
            if(!_.isUndefined(prop1_id))
                ur = ur+'/'+prop1_id;
            else
                ur = ur+'/'+0;
            if(!_.isUndefined(prop2_id))
                ur = ur+'/'+prop2_id;
            else
                ur = ur+'/'+0;

            jQuery('.btn_compare').attr('href',ur);

            var compareico_html = '<div class="compare">'+
                                            '<a href="#" class="comp_ico"></a>'+
                                        '</div>'


            if(!_.isUndefined(prop1_id) ){
                jQuery('.top-compar').find('.one').addClass('after_drag');
               // jQuery(compareico_html).insertBefore(dropped.closest('.single_p_w').find('.single_p_img').find('.single_p_hov_c'));

            }
            else{
                jQuery('.top-compar').find('.one').removeClass('after_drag');
            }

            if(!_.isUndefined(prop2_id) ){
                jQuery('.top-compar').find('.two').addClass('after_drag');
               // jQuery(compareico_html).insertBefore(dropped.closest('.single_p_w').find('.single_p_img').find('.single_p_hov_c'));
            }
            else{
                jQuery('.top-compar').find('.two').removeClass('after_drag');
            }



         //}


         if( _.isUndefined(prop1_id) || _.isUndefined(prop2_id) ){
                jQuery('.btn_compare').attr('href','javascript:void(0);')
                jQuery('.btn_compare').addClass('disabled')
            }
            else{


                jQuery('.btn_compare').removeClass('disabled')
            }


            },

            initialize : function(options){
            console.log(options);

            this.post_type = options.post_type; 

            

            if(!_.isUndefined(options))
                if(!_.isUndefined('options.mapview'))
                    this.mapview = options.mapview;

                 _.bindAll(this ,'render');

                this.render();
            },

            render:function(){

                jQuery('#main').html(this.show_loader());

                var mainViewtemplate = _.template(jQuery(this.template).html());
                //jQuery('.right_container').html(mainViewtemplate()); 
                var current_post_type = this.post_type;

                jQuery('#post_type').val(current_post_type);
                            
                jQuery('#main').html(mainViewtemplate({post_type:current_post_type})); 



                if(current_post_type == 'residential-property'){
                    this.make_div_dropable(".drag_area")
                }
                    
                
            },

            /*show_compare2:function(){
                /* var  url = location.protocol + '//' + location.host + location.pathname;
                alert(url); * /

                var prop1_id = jQuery('.top-compar').find('.one').attr('property-id');
                var prop2_id = jQuery('.top-compar').find('.two').attr('property-id');

                console.log('test'+window.location)
                //window.location = SITEURL+'/residential-projects/#compare/'+prop1_id+'/'+prop2_id;

                location.assign( location.protocol + '//' + location.host + location.pathname+'/#compare/'+prop1_id+'/'+prop2_id)


            },*/
            show_loader : function(){
               return '<div id="np">'+
                           '<div class="spinner">'+
                               '<div class="spinner-icon" style="border-top-color: rgb(10, 194, 210); border-left-color: rgb(10, 194, 210);"></div>'+
                           '</div>'+
                       '</div>' ;
            },


            /* make_div_dropable2 : function(dropable_el){


                     jQuery(dropable_el).droppable({ accept: ".draggable",
                       drop: function(event, ui) {
                                // $(ui.draggable).clone().appendTo($(this));
                                console.log("drop");

                        //        console.log(jQuery(self).html())

                          //      alert(jQuery(self).attr('property-title'))
                                jQuery(this).removeClass("border").removeClass("over");
                                var dropped = ui.draggable;
                                var droppedOn = jQuery(this);
                                jQuery(this).html('');
                                console.log('droppable.........................')

                                console.log(dropped)
                                console.log('-=-=-=-=-=-=-=-=-=-=-=-=-==-=-')
                                var draggable_property_title = dropped.attr('property-title');
                                var draggable_property_address = dropped.attr('property-address');

                                var draggable_property_image = dropped.find('.single_p_img').find('img').attr('src');

                                var cmp_html = "<div ><b>"+draggable_property_title+"</b><br/>"+draggable_property_address+"</div>";
                                console.log(cmp_html);
                                //jQuery(dropped).clone().detach().css({top: 0,left: 0}).appendTo(droppedOn);
                                jQuery(cmp_html).appendTo(droppedOn);



                        },
                        over: function(event, elem) {

                                jQuery(this).addClass("over");
                                console.log("over");

                                console.log('-------------------');
                                console.log(this)
                                //console.log(jQuery(elem.draggable.target));


                               // console.log(jQuery(elem.target))
                               // jQuery(this.target).css({width:'50%; height:auto;'});

                        },
                        out: function(event, elem) {
                                jQuery(self).removeClass("over");
                        }
                  });


            }, */

             make_div_dropable : function(dropable_el){


                     jQuery(dropable_el).droppable({ accept: ".draggable",
                        hoverClass: "over",
                        tolerance: "pointer",
                       drop: function(event, ui) {
                                // $(ui.draggable).clone().appendTo($(this));
                                console.log("drop");

                        //        console.log(jQuery(self).html())

                          //      alert(jQuery(self).attr('property-title'))

                                var dropped = ui.draggable;


                               /* if( jQuery(this).find('.one').attr('property-id')=='' || _.isUndefined(jQuery(this).find('.one').attr('property-id')) ){
                                    var droppedOn = jQuery(this).find('.one') ;

                                }
                                else{
                                    var droppedOn = jQuery(this).find('.two') ;

                                    if(jQuery(this).find('.one').attr('property-id')== dropped.attr('property-id')){

                                        //ui.draggable.animate(ui.draggable.data().origPosition,"fast");


                                            alert('Please Select two different projects to compare')
                                            return;

                                    }
                                }*/
var droppedOn = jQuery(this);

var droppedOn_target =  jQuery(_.first(droppedOn)) ;

var dropped_target =  jQuery(_.first(dropped)) ;

console.log('droppedOn_target:-----')
console.log( droppedOn_target.hasClass('two'))

//var dropped_target = jQuery(_.first(ui.draggable).target);


                                console.log('droppedOn:---------------------')
                                console.log(droppedOn)

                                console.log('Dropped---------------------------')
                                console.log(dropped)

                                /* commented on 8june2015 2_30pm
                                jQuery(this).removeClass("border").removeClass("over");
                                 var droppedOn = jQuery(this);
                                jQuery(this).html('');
                                 */

                                // alert(dropped.attr('property-id') + ' ----- ' + droppedOn_target.attr('property-id') )


                                if(droppedOn_target.hasClass('one')==true){

                                    var one_property_id = dropped_target.attr('property-id');
                                    var second_property_id = jQuery('.drag_area_block2').find('.two').attr('property-id')  ;

                                    console.log('one_property_id:=========================')
                                    console.log(one_property_id);
                                    console.log('second_property_id:=========================')
                                    console.log(second_property_id);
                                    if(!_.isUndefined(one_property_id) &&  !_.isUndefined(second_property_id)){

                                       if( parseInt(one_property_id) == parseInt(second_property_id) ){
                                                alert('Please Select two different projects to compare')
                                                                            return;
                                        }
                                    }




                                }
                                else if(droppedOn_target.hasClass('two')==true  ){

                                    var one_property_id = dropped_target.attr('property-id');
                                    var second_property_id = jQuery('.drag_area_block2').find('.one').attr('property-id') ;


                                    console.log('one_property_id:=========================')
                                    console.log(one_property_id);
                                    console.log('second_property_id:=========================')
                                    console.log(second_property_id);


                                    if(!_.isUndefined(one_property_id) &&  !_.isUndefined(second_property_id)){
                                       if( parseInt(one_property_id) == parseInt(second_property_id) ){
                                            alert('Please Select two different projects to compare')
                                                                                return;
                                        }
                                    }
                                }

                                droppedOn.removeClass("border").removeClass("over");
                                droppedOn.html('');



                                console.log('droppable.........................')

                                console.log(dropped)
                                console.log('-=-=-=-=-=-=-=-=-=-=-=-=-==-=-')
                                var draggable_property_title = dropped.attr('property-title');
                                var draggable_property_address = dropped.attr('property-address');
                                var draggable_property_id = dropped.attr('property-id');


                                var draggable_property_image = dropped.find('.single_p_img').find('img').attr('src');

                                var prev_dropedon_prop_id =droppedOn.attr('property-id')

                                jQuery('.property_span_'+prev_dropedon_prop_id).find('.single_p_img').find('.compare').remove();

                                droppedOn.attr('property-id',draggable_property_id)

                                jQuery('.single_p_w[property-id="'+draggable_property_id+'"]').addClass('added_for_compare');

                                //var cmp_html = "<div ><b>"+draggable_property_title+"</b><br/>"+draggable_property_address+"</div>";



                                var cmp_html = '<div class="after_drag_content">'+
                                                '<p class="dragged_title">'+
                                                    '<span class="single_p_title">'+draggable_property_title+'</span><br>'+
                                                    '<span class="single_p_location">'+draggable_property_address+'</span>'+
                                                    '<a href="javascript:void(0)" class="remove_from_comp">×</a>'+
                                                '</p>'+
                                            '</div>'



                                console.log(cmp_html);
                                //jQuery(dropped).clone().detach().css({top: 0,left: 0}).appendTo(droppedOn);
                                jQuery(cmp_html).appendTo(droppedOn);


                                 var prop1_id = jQuery('.top-compar').find('.one').attr('property-id');
                                 var prop2_id = jQuery('.top-compar').find('.two').attr('property-id');




                                // if(!_.isUndefined(prop1_id) || !_.isUndefined(prop1_id)){

                                    var ur = "#compare";
                                    if(!_.isUndefined(prop1_id))
                                        ur = ur+'/'+prop1_id;
                                    else
                                        ur = ur+'/'+0;
                                    if(!_.isUndefined(prop2_id))
                                        ur = ur+'/'+prop2_id;
                                    else
                                        ur = ur+'/'+0;

                                    jQuery('.btn_compare').attr('href',ur);

                                    var compareico_html = '<div class="compare">'+
                                                                    '<a href="#" class="comp_ico"></a>'+
                                                                '</div>'


                                    if(!_.isUndefined(prop1_id) ){
                                        jQuery('.top-compar').find('.one').addClass('after_drag');
                                      //  jQuery(compareico_html).insertBefore(dropped.closest('.single_p_w').find('.single_p_img').find('.single_p_hov_c'));

                                    }
                                    else{
                                        jQuery('.top-compar').find('.one').removeClass('after_drag');
                                    }

                                    if(!_.isUndefined(prop2_id) ){
                                        jQuery('.top-compar').find('.two').addClass('after_drag');
                                      //  jQuery(compareico_html).insertBefore(dropped.closest('.single_p_w').find('.single_p_img').find('.single_p_hov_c'));
                                    }
                                    else{
                                        jQuery('.top-compar').find('.two').removeClass('after_drag');
                                    }



                                 //}


                                 if( _.isUndefined(prop1_id) || _.isUndefined(prop2_id) ){
                                        jQuery('.btn_compare').attr('href','javascript:void(0);')
                                        jQuery('.btn_compare').addClass('disabled')
                                    }
                                    else{


                                        jQuery('.btn_compare').removeClass('disabled')
                                    }





                        },
                        over: function(event, elem) {

                                //jQuery(this).addClass("over");
                                console.log("over");

                                console.log('-------------------');
                                console.log(this)
                                //console.log(jQuery(elem.draggable.target));


                               // console.log(jQuery(elem.target))
                               // jQuery(this.target).css({width:'50%; height:auto;'});

                        },
                        out: function(event, elem) {
                               // jQuery(self).removeClass("over");
                        }
                  });


            },



        });
