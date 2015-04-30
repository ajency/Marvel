/**
 * The Property List View.
 *
 */

define(['underscore', 'jquery', 'backbone'],
    function( _ , $, Backbone ){


        var ProjectListMainView = Backbone.View.extend({

          //  el 			: 'body',
            el : '.top-compar',

            initialize : function(){

                alert('initialize routers')

            },

            show : function(view,data_id){
                alert('rr')

            }



        });


        return ProjectListMainView;

    });