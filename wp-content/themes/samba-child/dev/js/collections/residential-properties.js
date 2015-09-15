/* The ResidentialPropertiesCollection
 */
/*define(['underscore', 'backbone',  'residentialPropertymodel'],
    function(_, Backbone,  residentialPropertymodel) {
*/
        var ResidentialPropertiesCollection = Backbone.Collection.extend({

            //model property
            model: ResidentialModel,

            fetched : false,

             initialize : function( options){

                console.log('Collection  fetch :----')
                console.log(options)
                

                var options = !_.isUndefined(options)?options: {} ;
                
                this.status     = _.isUndefined(options.status)?'ongoing':options.status;
                this.city       = (_.isUndefined(options.city) || (options.city=="city-all") )?'all':options.city;
                this.locality   = (_.isUndefined(options.locality) || (options.locality=='locality-all') ) ?'all':options.locality;
                this.type       = (_.isUndefined(options.type) || (options.type=='type-all') )?'all':options.type; 
                this.nearby     = _.isUndefined(options.nearby)?'':options.nearby; 

                

            },  


            url: function() {
               // return AJAXURL + '?action=get_residential_properties_list_ajx&post_type=residential-property'

                var url_link;
                url_link = AJAXURL + '?action=get_residential_properties_list_ajx&post_type=residential-property';

                if(this.nearby!=''){
                    url_link+= '&status='+this.status+'&city='+this.city+'&locality='+this.locality+'&type='+this.type+'&near='+this.nearby;
                }
                else if(this.type!='all'){
                    url_link+= '&status='+this.status+'&city='+this.city+'&locality='+this.locality+'&type='+this.type;

                }
                else if(this.locality!='all'){
                    url_link+= '&status='+this.status+'&city='+this.city+'&locality='+this.locality

                }
                else if(this.locality!='all'){
                    url_link+= '&status='+this.status+'&city='+this.city+'&locality='+this.locality

                }
                else if(this.city!='all'){
                    url_link+= '&status='+this.status+'&city='+this.city

                }
                else {
                    url_link+= '&status='+this.status
                }

                return url_link;
            },
            /**
             * Pasrse JSOn response to check if code is OK
             */
            parse: function(response) {

                if (response.code === "OK") {
                    return response.data;
                }
                else if (response.code === "ERROR") {
                    getAppInstance().vent.trigger('fetch failed', response);
                }

            },



        }) ;



        var CommercialPropertiesCollection = Backbone.Collection.extend({

            //model property
            model: CommercialModel,

            fetched : false,

             initialize : function( options){

                console.log('Collection  fetch :----')
                console.log(options)
                

                var options = !_.isUndefined(options)?options: {} ;
                
                this.status     = _.isUndefined(options.status)?'ongoing':options.status;
                this.city       = (_.isUndefined(options.city) || (options.city=="city-all") )?'all':options.city;
                this.locality   = (_.isUndefined(options.locality) || (options.locality=='locality-all') ) ?'all':options.locality;
                this.type       = (_.isUndefined(options.type) || (options.type=='type-all') )?'all':options.type; 
                this.nearby     = _.isUndefined(options.nearby)?'':options.nearby; 

                

            },  



            url: function() {
               // return AJAXURL + '?action=get_residential_properties_list_ajx&post_type=commercial-property'
                var url_link;
                url_link = AJAXURL + '?action=get_residential_properties_list_ajx&post_type=commercial-property';

                if(this.nearby!=''){
                    url_link+= '&status='+this.status+'&city='+this.city+'&locality='+this.locality+'&type='+this.type+'&near='+this.nearby;
                }
                else if(this.type!='all'){
                    url_link+= '&status='+this.status+'&city='+this.city+'&locality='+this.locality+'&type='+this.type;

                }
                else if(this.locality!='all'){
                    url_link+= '&status='+this.status+'&city='+this.city+'&locality='+this.locality

                }
                else if(this.locality!='all'){
                    url_link+= '&status='+this.status+'&city='+this.city+'&locality='+this.locality

                }
                else if(this.city!='all'){
                    url_link+= '&status='+this.status+'&city='+this.city

                }
                else {
                    url_link+= '&status='+this.status
                }

                return url_link;
            },
            /**
             * Pasrse JSOn response to check if code is OK
             */
            parse: function(response) {

                if (response.code === "OK") {
                    return response.data;
                }
                else if (response.code === "ERROR") {
                    getAppInstance().vent.trigger('fetch failed', response);
                }

            }

        }) ;



/*        return ResidentialPropertiesCollection;

    });

    */