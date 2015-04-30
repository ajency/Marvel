/**
 * Property model
 */

define([ "jquery", "underscore", "backbone" ], function($, _, Backbone) {

    var ResidentialModel = Backbone.Model.extend({

        addRoomUrl : AJAXURL + '?action=add_new_room_ajx',

    })

    return ResidentialModel;
})