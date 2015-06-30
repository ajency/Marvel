

        var projectsListingsView = Backbone.View.extend({

            //el : '.child-footer',
            template :'#spn_propertieslistings',

             events : {
                'click .top_map'	: 'display_map',
                 
            }, 

            initialize : function(args) {
                _.bindAll(this ,'render');

               console.log('PROJECTS LISTINGS  OPTIONS:-----')
               console.log(args);  
              this.searchView = args;
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
 



            /* make_div_dropable : function(dropable_el){

 
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
                                var draggable_property_id = dropped.attr('property-id');


                                var draggable_property_image = dropped.find('.single_p_img').find('img').attr('src');
                                droppedOn.attr('property-id',draggable_property_id)

                                var cmp_html = "<div ><b>"+draggable_property_title+"</b><br/>"+draggable_property_address+"</div>";
                                console.log(cmp_html);
                                //jQuery(dropped).clone().detach().css({top: 0,left: 0}).appendTo(droppedOn); 
                                jQuery(cmp_html).appendTo(droppedOn); 


                                 var prop1_id = jQuery('.top-compar').find('.one').attr('property-id');
                                 var prop2_id = jQuery('.top-compar').find('.two').attr('property-id');
                                 if(!_.isUndefined(prop1_id) || !_.isUndefined(prop1_id)){

                                    var ur = "#compare";
                                    if(!_.isUndefined(prop1_id))
                                        ur = ur+'/'+prop1_id;
                                    else
                                        ur = ur+'/'+0;
                                    if(!_.isUndefined(prop2_id))
                                        ur = ur+'/'+prop2_id;
                                    else
                                        ur = ur+'/'+0;

                                    jQuery('.btn_compare').attr('href',ur);

                                 }


                                
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


            },*/



       
 




            /**
             * Render the view
             * @param  {[type]} evt [description]
             * @return {[type]}     [description]
             */
            render : function(evt) {

               
                var self = this;

                jQuery('#projects_listings').html(self.show_loader());

                 
/*

                getAppInstance().residentialPropertyCollection = new ResidentialPropertiesCollection();
                getAppInstance().residentialPropertyCollection.fetch({remove:false, add:true});
                console.log('resi coll');
                console.log(getAppInstance().residentialPropertyCollection.length);
                console.log(getAppInstance().residentialPropertyCollection);

               
                setTimeout( function(){
                var projectListingsTemplate = _.template(jQuery(self.template).html());
                                        
                                                jQuery('#proj_list').html(projectListingsTemplate({propertiesdata : getAppInstance().residentialPropertyCollection}));


                                                console.log('resi coll');
                                console.log(getAppInstance().residentialPropertyCollection.models);

                },1000);*/







    getAppInstance().residentialPropertyCollection = new ResidentialPropertiesCollection();
                getAppInstance().residentialPropertyCollection.fetch({
    success: function(collection) { // the fetched collection!

        console.log('success fetched:-----');

        console.log(getAppInstance().residentialPropertyCollection)

        var projectListingsTemplate = _.template(jQuery(self.template).html());
                                        
       // jQuery('#projects_listings').html(projectListingsTemplate({propertiesdata : getAppInstance().residentialPropertyCollection.models}));
self.searchView.searchProperties();



setTimeout(function(){

console.log('LOADING SHARE BUTTON  LISTINGSSSSSSSSS:-------------------------------------------')
//console.log(jQuery('#projects_listings').html())
  var switchTo5x=true;  
 stLight.options({publisher: "1423128c-ec17-415a-8eaf-4ba0d655a2d6", doNotHash: false, doNotCopy: false, hashAddressBar: false, onhover: false}); 
 stButtons.locateElements();

},300)


        if (collection.length) {
            // not empty
        } else {
            // empty
        }

  
      //  self.make_div_dropable(".drag_area")       
        

        if(jQuery(".draggable").length>0){
            console.log('draggable')
            jQuery(".draggable").draggable({ cursor: "crosshair",  revert:"invalid",helper:"clone",


            start: function(event, ui) {
                ui.helper.css({ height: 'auto', width: '300px' });
            },
            stop: function(event, ui) {
                ui.helper.css({ height: 'auto', width: '300px' });
            }


        });
        }
        else{
            console.log('no dragables')
        }





    }
} );
                console.log('resi coll');
                console.log(getAppInstance().residentialPropertyCollection.length);
                console.log(getAppInstance().residentialPropertyCollection);
                                

               

                return this;
            },

                     
              show_loader : function(){
                 return '<div id="np">'+
                           '<div class="spinner">'+
                               '<div class="spinner-icon" style="border-top-color: rgb(10, 194, 210); border-left-color: rgb(10, 194, 210);"></div>'+
                           '</div>'+
                       '</div>' ;
                      
            }

            

        });

