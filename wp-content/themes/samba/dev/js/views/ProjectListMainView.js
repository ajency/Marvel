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

            initialize : function(){


                           
                 _.bindAll(this ,'render');
              
                this.render();
            },

            render:function(){

                jQuery('#main').html(this.show_loader());

                var mainViewtemplate = _.template(jQuery(this.template).html());
                //jQuery('.right_container').html(mainViewtemplate()); 
                            jQuery('#main').html(mainViewtemplate()); 
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
            }


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

             
             


        });
