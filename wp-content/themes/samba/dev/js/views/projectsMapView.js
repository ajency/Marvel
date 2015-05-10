  

        var propertiesMapView = Backbone.View.extend({

            el : ".top-dd-c"    ,
           
            template :'#projectlistSearchOptionsTemplate',

            events : {
                'click .btn_norm'	: 'searchProperties',

           
            }, 

            initialize : function(args) {
                _.bindAll(this ,'render','searchProperties');
               /*  _.bindAll(this ,'renderForm'); */
                this.render();
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
                       
                        var template = _.template(jQuery(self.template).html());
                        
                                jQuery('.top-dd-c').html(template({data : response}));

                                var projectlistView = new projectsListingsView();

                    },
                    error: function(){

                    },

                    dataType: 'json'
                });

 self.show_markers_on_map(getAppInstance().residentialPropertyCollection.toJSON())

                return this;
            },











            show_markers_on_map : function(properties){ 
    


                var marker_image = 'http://marvel.ajency.in/wp-content/uploads/sites/8/2015/04/marvelLogo.png';
                

                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 10,
                  center: new google.maps.LatLng(-33.92, 151.25),
                  mapTypeId: google.maps.MapTypeId.ROADMAP 
                    
                });

                var infowindow = new google.maps.InfoWindow();

                var marker, i; 

                for (i = 0; i < properties.length; i++) {  

                    locations = properties.map_address;
                  marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations.lat, locations.lng),
                    map: map,
                     /*  icon :  marker_image  */
                  });

                  google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infowindow.setContent();locations.address
                      infowindow.open(map, marker);
                    }
                  })(marker, i));
                }
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
                                   search_options['property_type'] =  prop_type;s

                var res_collection = getAppInstance().residentialPropertyCollection  ;
                
                 
                var search_collections = res_collection.models;
                
                if( (prop_status!='') || (prop_city!='') || (prop_locality!='') || (prop_type!='') )
                    var search_collections = res_collection.where(search_options ) 

               
             var projectListingsTemplate2 = _.template(jQuery('#spn_propertieslistings').html());
                                                    
             jQuery('#proj_list').html(projectListingsTemplate2({propertiesdata : search_collections}));


            }

            




           


            
 


            


        });

/*        return SiteProfileView;

    }); */