/**
 * Property model
 */

/* define([ "jquery", "underscore", "backbone" ], function($, _, Backbone) {
*/
    var CommercialModel = Backbone.Model.extend({

        addRoomUrl : AJAXURL + '?action=get_property_ajx',

    })
/*
    return ResidentialModel;
})
    */