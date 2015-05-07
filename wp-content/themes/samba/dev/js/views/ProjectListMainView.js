/**
 * The Property List Main View.
 *
 */

 

        var ProjectListMainView = Backbone.View.extend({

            id 			: 'proj_list_main',

            template :' #projectlistMainTemplate',

            initialize : function(){


                           
                
              
                this.render();
            },

            render:function(){
                var mainViewtemplate = _.template(jQuery(this.template).html());
                            jQuery('.right_container').html(mainViewtemplate()); 
            }

             
             


        });
