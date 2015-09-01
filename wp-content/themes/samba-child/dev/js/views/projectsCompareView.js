/**
 * The Property List Main View.
 *
 */

 

        var ProjectsCompareView = Backbone.View.extend({

            id 			: 'proj_compare',

            template :' #projectsCompareTemplate',

            initialize : function(options){

            this.pid = options.pid;
            this.psid = options.psid;
                           
               console.log(options) ;
              
                this.render();
            },

            render:function(){
               


                var self = this;
                if(_.isUndefined(getAppInstance().residentialPropertyCollection)){

 
                    getAppInstance().residentialPropertyCollection = new ResidentialPropertiesCollection();

                    getAppInstance().residentialPropertyCollection.fetch({
                        success: function(collection) { // the fetched collection!

                            console.log('success fetched:-----');

                            console.log(getAppInstance().residentialPropertyCollection)

                            //var projectListingsTemplate = _.template(jQuery(self.template).html());
                                                            
                            //jQuery('#projects_listings').html(projectListingsTemplate({propertiesdata : getAppInstance().residentialPropertyCollection.models}));


                            if (collection.length) {
                                // not empty
                            } 
                            else {
                                // empty
                            }

                            self.show_comparison()
                            

                        }
                    } );


 

                }

                else{
                    self.show_comparison();
                }
                //jQuery('.right_container').html(mainViewtemplate()); 
                            
            },

            show_comparison : function(){

                var self = this;
                 /*var compareViewtemplate = _.template(jQuery(this.template).html());
                jQuery('#main').html(compareViewtemplate()); */



                var f_prop = {};
                var s_prop = {};

                if(_.isUndefined(getAppInstance().searchOptions)){


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

                                getAppInstance().searchOptions = response ;                               
                               
                                var projectListingsTemplate = _.template(jQuery(self.template).html());

                                console.log("**********************"+self.pid+' : '+self.psid)


                                _.each(getAppInstance().residentialPropertyCollection.models,function(vl,ky){

                                    if(parseInt(vl.get('id'))==parseInt(self.pid)) 
                                        f_prop = vl;                                      
                                    if(parseInt(vl.get('id'))==parseInt(self.psid))
                                        s_prop = vl;

                                });  





                                jQuery('#main').html(projectListingsTemplate({pid:self.pid,
                                                                              psid:self.psid,
                                                                              propertiesdata : getAppInstance().residentialPropertyCollection.models,
                                                                              searchOptions:getAppInstance().searchOptions,
                                                                              f_prop:f_prop, 
                                                                              s_prop:s_prop,
                                                                             }));                                 

                                  

                                self.load_compare_give_details_fomidable_details(f_prop,s_prop)


                                setTimeout(function(){

                                    var switchTo5x=true;
                                   stLight.options({publisher: "1423128c-ec17-415a-8eaf-4ba0d655a2d6", doNotHash: false, doNotCopy: false, hashAddressBar: false, onhover: false});
                                   stButtons.locateElements();

                                },300)


                            },
                            error: function(){

                            },

                            dataType: 'json'
                        });

                }
                else{


                    var projectListingsTemplate = _.template(jQuery(self.template).html());


                    _.each(getAppInstance().residentialPropertyCollection.models,function(vl,ky){

                                    if(parseInt(vl.get('id'))==parseInt(self.pid)) 
                                        f_prop = vl;                                      
                                    if(parseInt(vl.get('id'))==parseInt(self.psid))
                                        s_prop = vl;

                                });  
                    console.log("################"+self.pid+' : '+self.psid)

                                                            
                    jQuery('#main').html(projectListingsTemplate({pid:self.pid,
                                                                  psid:self.psid,
                                                                  propertiesdata : getAppInstance().residentialPropertyCollection.models,
                                                                  searchOptions:getAppInstance().searchOptions,
                                                                  f_prop:f_prop, 
                                                                  s_prop:s_prop,}));
                    
                    self.load_compare_give_details_fomidable_details(f_prop,s_prop)

                    setTimeout(function(){

                                    var switchTo5x=true;
                                   stLight.options({publisher: "1423128c-ec17-415a-8eaf-4ba0d655a2d6", doNotHash: false, doNotCopy: false, hashAddressBar: false, onhover: false});
                                   stButtons.locateElements();

                                },300)
                }


                












                 

            },

            load_compare_give_details_fomidable_details : function(f_prop,s_prop){
                if(jQuery('#form_frm_compare').length >0 ){

                    jQuery('#form_frm_compare').find('#field_frmcomp_project1').val(f_prop.get('post_title'));
                    jQuery('#form_frm_compare').find('#field_frmcomp_project2').val(s_prop.get('post_title'));

                    jQuery('#form_frm_compare').find('.sign-prop-title-1').html(f_prop.get('post_title'));
                    jQuery('#form_frm_compare').find('.sign-prop-title-2').html(s_prop.get('post_title'));

                }
            }

            /* make_div_dropable2 : function(dropable_el){

 
                     jQuery(dropable_el).droppable({ accept: ".draggable", 
                       drop: function(event, ui) {
                                // $(ui.draggable).clone().appendTo($(this));
                                console.log("drop");

                        //        console.log(jQuery(self).html())
 
                          //      alert(jQuery(self).attr('property-title'))
                                jQuery(this).removeClass("border").removeClass("over");
                                var dropped = ui.draggable;
                                var droppedOn = jQuery(this);
                                jQuery(this).html('');
                                console.log('droppable.........................') 

                                console.log(dropped)
                                console.log('-=-=-=-=-=-=-=-=-=-=-=-=-==-=-')
                                var draggable_property_title = dropped.attr('property-title');
                                var draggable_property_address = dropped.attr('property-address');

                                var draggable_property_image = dropped.find('.single_p_img').find('img').attr('src');

                                var cmp_html = "<div ><b>"+draggable_property_title+"</b><br/>"+draggable_property_address+"</div>";
                                console.log(cmp_html);
                                //jQuery(dropped).clone().detach().css({top: 0,left: 0}).appendTo(droppedOn); 
                                jQuery(cmp_html).appendTo(droppedOn); 


                                
                        }, 
                        over: function(event, elem) {

                                jQuery(this).addClass("over");
                                console.log("over");

                                console.log('-------------------');
                                console.log(this)
                                //console.log(jQuery(elem.draggable.target));


                               // console.log(jQuery(elem.target))
                               // jQuery(this.target).css({width:'50%; height:auto;'});
                                
                        },
                        out: function(event, elem) {
                                jQuery(self).removeClass("over");
                        }
                  });


            }, */

             
             


        });
