/**
 * The Property List Main View.
 *
 */

 

        var ProjectListMainView = Backbone.View.extend({

            id 			: 'proj_list_main',

            template :' #projectlistMainTemplate',

            initialize : function(){


                           
                
                //set left column view
           //     this.leftColumn = new LeftColumnView();
            /*    console.log('projectlist main view')

                getAppInstance().residentialPropertyCollection = new ResidentialPropertiesCollection();
                getAppInstance().residentialPropertyCollection.fetch();
                console.log('resi coll');
                console.log(getAppInstance().residentialPropertyCollection);*/

 
                
                //$('#top-dd-c').html(searchOptionView)
                this.render();
            },

            render:function(){
                var mainViewtemplate = _.template(jQuery(this.template).html());
                            jQuery('.right_container').html(mainViewtemplate()); 
            }

             
             


        });
