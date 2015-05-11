  

        var searchOptionsView = Backbone.View.extend({

            el : ".top-dd-c"    ,
           
            template :'#projectlistSearchOptionsTemplate',

            events : {
                'click .btn_norm'	: 'searchProperties',
                'click .top_map'    : 'display_map',
                'click .top_list'    : 'searchProperties',
                'change .srchopt'   :  'searchProperties',
                'change #dd_city'   :  'load_locality_options'

           
            }, 

            initialize : function(args) {
                _.bindAll(this ,'render','searchProperties','display_map');
               /*  _.bindAll(this ,'renderForm'); */





                var self = this;

                jQuery.ajax(AJAXURL,{
                    type: 'GET',
                    action:'get_search_options',
                    data :{action:'get_search_options'},
                    complete: function() {

                    },
                    success: function(response) {
                        console.log('got search options........');
                        console.log(response);

                        getAppInstance().searchOptions = response ;
                       // var searchOptionTemplate = Backbone.Marionette.TemplateCache.prototype.loadTemplate('projectlistSearch_option.html');
                       
                       // var  data = {'d':response};

                      
                       // jQuery('.top-dd-c').html(_.template(searchOptionTemplate,data));

                      /* var html = _.template(jQuery(self.template), response);
                        self.$el.html(html);*/

                        var template = _.template(jQuery(self.template).html());
                        
                                jQuery('.top-dd-c').html(template({data : response}));

                                var projectlistView = new projectsListingsView();




                    },
                    error: function(){

                    },

                    dataType: 'json'
                });








                
            },



   display_map : function(){ 
    console.log('display map');;
    console.log(properties)


              //  var properties = getAppInstance().residentialPropertyCollection.toJSON();











var prop_status = jQuery('#dd_status').val();
                var prop_city = jQuery('#dd_city').val();
                var prop_locality = jQuery('#dd_locality').val();
                var prop_type = jQuery('#dd_type').val();

                var search_options = {};
                if(prop_status!='')
                   search_options['property_status'] =  prop_status;

                 if(prop_city!='')
                                   search_options['property_city'] =  prop_city;

                 if(prop_locality!='')
                                   search_options['property_locaity'] =  prop_locality;

                 if(prop_type!='')
                                   search_options['property_type'] =  prop_type;

                

                var res_collection = getAppInstance().residentialPropertyCollection  ;
                
                 // var search_collections = res_collection.where({ property_status: prop_status});

 
                /*var search_collections = res_collection.where({'property_status':prop_status, 
                                        'property_city':prop_city, 
                                        'property_locaity': prop_locality, 
                                        'property_type':prop_type
                                          }) */

                var search_collections = res_collection.models;
                
                if( (prop_status!='') || (prop_city!='') || (prop_locality!='') || (prop_type!='') )
                    var search_collections = res_collection.where(search_options ) 








 var properties = search_collections;








                console.log('properties:----------map')
                console.log(properties)

                var marker_image = 'http://marvel.ajency.in/wp-content/uploads/sites/8/2015/04/marvelLogo.png';
                

                

                var infowindow = new google.maps.InfoWindow();

                var marker, i; 

                for (i = 0; i < properties.length; i++) {  


console.log('FEATURED IMAGE')
//console.log(properties[i].get('featured_image'))
                    //var popup_content = "<table cellpadding='0' cellspacing='0' border='0' ><tr><td></td><td></td></tr>";

                    locations = properties[i].get('map_address')[0];
console.log('location');
console.log(locations)


jQuery('#projects_listings').css({'display':'block',
                                   'width' :'100%',
                                   'height' : 'auto',
                                   'min-height':'400px'
                                   
                                })

                  if(i==0){

                    var map = new google.maps.Map(document.getElementById('projects_listings'), {
                      zoom:8,
                      center: new google.maps.LatLng(locations.lat, locations.lng),
                      mapTypeId: google.maps.MapTypeId.ROADMAP 
                        
                    });

                  }

 
                  marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations.lat, locations.lng),
                    map: map,
                     /*  icon :  marker_image  */
                  });

                  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infowindow.setContent(locations.address);
                      infowindow.open(map, marker);
                    }
                  })(marker, i)); 
                }
            },


            /**
             * Render the view
             * @param  {[type]} evt [description]
             * @return {[type]}     [description]
             */
            render : function(evt) {

                console.log('render getAppInstance().searchOptions');
                console.log(getAppInstance().searchOptions)

                 var self =this;
               
                                var template = _.template(jQuery(self.template).html());
                        
                                jQuery('.top-dd-c').html(template({data : getAppInstance().searchOptions}));

                                var projectlistView = new projectsListingsView();


                return this;
            },

            searchProperties: function(){
               console.log('searchProperties') ;


                var prop_status = jQuery('#dd_status').val();
                var prop_city = jQuery('#dd_city').val();
                var prop_locality = jQuery('#dd_locality').val();
                var prop_type = jQuery('#dd_type').val();

                var search_options = {};
                if(prop_status!='')
                   search_options['property_status'] =  prop_status;

                 if(prop_city!='')
                                   search_options['property_city'] =  prop_city;

                 if(prop_locality!='')
                                   search_options['property_locaity'] =  prop_locality;

                 if(prop_type!='')
                                   search_options['property_type'] =  prop_type;

                

                var res_collection = getAppInstance().residentialPropertyCollection  ;
                
                 // var search_collections = res_collection.where({ property_status: prop_status});

 
                /*var search_collections = res_collection.where({'property_status':prop_status, 
                                        'property_city':prop_city, 
                                        'property_locaity': prop_locality, 
                                        'property_type':prop_type
                                          }) */

                var search_collections = res_collection.models;
                
                if( (prop_status!='') || (prop_city!='') || (prop_locality!='') || (prop_type!='') )
                    var search_collections = res_collection.where(search_options ) 

                /* var projectListingsTemplate2 = _.template(jQuery('#spn_propertieslistings').html());
                                        
                                                jQuery('#proj_list').html(projectListingsTemplate2({propertiesdata : search_collections}));
                */

                /*var template2 = _.template(jQuery('#spn_propertieslistings').html(), {propertiesdata : search_collections});
                console.log(template2);
                jQuery("#proj_list").html(template2);*/

             var projectListingsTemplate2 = _.template(jQuery('#spn_propertieslistings').html());
                                                    
             jQuery('#projects_listings').html(projectListingsTemplate2({propertiesdata : search_collections}));



            },

            load_locality_options : function(evt){

                var event_val = jQuery(evt.target).val();

                console.log('load_locality_options')
                console.log(getAppInstance().searchOptions)

                            _.each(getAppInstance().searchOptions['citylocality'], function(vl,ky){

console.log(ky)
console.log('jQuery(evt.target).val()'+event_val)
                                if(ky==event_val){
                                    jQuery('#dd_locality').empty();
                                    jQuery('#dd_locality').append("<option value=''>Select</option>")
                                    _.each(vl,function(v,k){

                                        jQuery('#dd_locality').append("<option value='"+v+"'>"+v+"</option>")

                                    })

                                }
                            })

            }


            




           


            
 


            


        });

/*        return SiteProfileView;

    }); */