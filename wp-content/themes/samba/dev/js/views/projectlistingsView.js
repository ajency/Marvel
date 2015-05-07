

        var projectsListingsView = Backbone.View.extend({

            //el : '.child-footer',
            template :'#spn_propertieslistings',

           /* events : {
                'click #btn_save'	: 'save',
                 
            },*/

            initialize : function(args) {
                _.bindAll(this ,'render');
               /*  _.bindAll(this ,'renderForm','renderError', 'saveProfileSuccess', 'saveProfileFailure','parsleyInitialize');

                //ensure site model property is set
                if(!getAppInstance().siteModel)
                    getAppInstance().siteModel = new SiteModel();

                //set ID
                getAppInstance().siteModel.set(SITEID);

                this.listenTo(getAppInstance().siteModel, 'model-fetch-failed', this.renderError);
*/
this.render();
            },





            /**
             * Render the view
             * @param  {[type]} evt [description]
             * @return {[type]}     [description]
             */
            render : function(evt) {

               
                var self = this;

 


                getAppInstance().residentialPropertyCollection = new ResidentialPropertiesCollection();
                getAppInstance().residentialPropertyCollection.fetch({remove:false, add:true});
                console.log('resi coll');
                console.log(getAppInstance().residentialPropertyCollection.length);
                console.log(getAppInstance().residentialPropertyCollection);

               
                setTimeout( function(){
                var projectListingsTemplate = _.template(jQuery(self.template).html());
                                        alert(jQuery('#projects_listings').length + " --- proj_list:" + jQuery('#proj_list').length)
                                                jQuery('#proj_list').html(projectListingsTemplate({propertiesdata : getAppInstance().residentialPropertyCollection}));


                                                console.log('resi coll');
                                console.log(getAppInstance().residentialPropertyCollection.models);

                },1000);
                                

               

                return this;
            },

                     
              

            

        });

