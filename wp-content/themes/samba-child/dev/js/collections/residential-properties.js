/* The ResidentialPropertiesCollection
 */
/*define(['underscore', 'backbone',  'residentialPropertymodel'],
    function(_, Backbone,  residentialPropertymodel) {
*/
        var ResidentialPropertiesCollection = Backbone.Collection.extend({

            //model property
            model: ResidentialModel,

            fetched : false,


            url: function() {
                return AJAXURL + '?action=get_residential_properties_list_ajx&post_type=residential-property'
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



        var CommercialPropertiesCollection = Backbone.Collection.extend({

            //model property
            model: CommercialModel,

            fetched : false,


            url: function() {
                return AJAXURL + '?action=get_residential_properties_list_ajx&post_type=commercial-property'
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