  

        var searchOptionsView = Backbone.View.extend({

            el : ".top-dd-c"    ,
           
            template :'#projectlistSearchOptionsTemplate',

            events : {
                'click .btn_norm'	: 'searchProperties',
                'click .top_map'    : 'display_map',
                'change .srchopt'   :  'searchProperties'

           
            }, 

            initialize : function(args) {
                _.bindAll(this ,'render','searchProperties','display_map');
               /*  _.bindAll(this ,'renderForm'); */
                this.render();
            },



   display_map : function(){ 
    console.log('display map');;
    console.log(properties)


                var properties = getAppInstance().residentialPropertyCollection.toJSON();

                console.log('properties:----------map')
                console.log(properties)

                var marker_image = 'http://marvel.ajency.in/wp-content/uploads/sites/8/2015/04/marvelLogo.png';
                

                

                var infowindow = new google.maps.InfoWindow();

                var marker, i; 

                for (i = 0; i < properties.length; i++) {  

                    locations = properties[i].map_address[0];
console.log('location');
console.log(locations.lat)


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



                return this;
            },

            searchProperties: function(){
                

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
                                                    
             jQuery('#proj_list').html(projectListingsTemplate2({propertiesdata : search_collections}));






















  










            }

            




           


            
 


            


        });

/*        return SiteProfileView;

    }); */