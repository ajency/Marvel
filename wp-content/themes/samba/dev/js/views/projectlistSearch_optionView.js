  

        var searchOptionsView = Backbone.View.extend({

           
            template :'#projectlistSearchOptionsTemplate',

            events : {
                'click .btn_norm'	: 'searchProperties',
                'click .tstcheck'   : 'searchProperties'
           
            }, 

            initialize : function(args) {
                _.bindAll(this ,'render','searchProperties');
               /*  _.bindAll(this ,'renderForm','renderError', 'saveProfileSuccess', 'saveProfileFailure','parsleyInitialize');

               
*/
this.render();
            },





            /**
             * Render the view
             * @param  {[type]} evt [description]
             * @return {[type]}     [description]
             */
            render : function(evt) {

                /*if(!_.isUndefined(evt))
                    evt.preventDefault();

                //trigger fetch
                getAppInstance().siteModel.fetch({
                    success : this.renderForm
                });
*/
                var self = this;

                jQuery.ajax(AJAXURL,{
                    type: 'GET',
                    action:'get_search_options',
                    data :{action:'get_search_options'},
                    complete: function() {

                    },
                    success: function(response) {
                        console.log('got search options........');
                        console.log(response);
                       // var searchOptionTemplate = Backbone.Marionette.TemplateCache.prototype.loadTemplate('projectlistSearch_option.html');
                        //console.log(searchOptionTemplate)
                       // var  data = {'d':response};

                        //console.log(_.template(searchOptionTemplate(data)))
                       // jQuery('.top-dd-c').html(_.template(searchOptionTemplate,data));

                      /* var html = _.template(jQuery(self.template), response);
                        self.$el.html(html);*/

                        var template = _.template(jQuery(self.template).html());
                        
                                jQuery('.top-dd-c').html(template({data : response}));

                                var projectlistView = new projectsListingsView();

                    },
                    error: function(){

                    },

                    dataType: 'json'
                });



                return this;
            },

            searchProperties: function(){
                alert('search properties');
            }

            




           


            
 


            


        });

/*        return SiteProfileView;

    }); */