/**
 * Property model
 */

/* define([ "jquery", "underscore", "backbone" ], function($, _, Backbone) {
*/
    var ResidentialModel = Backbone.Model.extend({

        addRoomUrl : AJAXURL + '?action=get_property_ajx',

    })
/*
    return ResidentialModel;
})
    */