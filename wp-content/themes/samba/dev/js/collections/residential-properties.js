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
                return AJAXURL + '?action=get_residential_properties_list_ajx'
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