

        var searchOptionsView = Backbone.View.extend({

            el : ".top-dd-c"    ,

            template :'#projectlistSearchOptionsTemplate',

            events : {
                'click .btn_norm'   : 'searchProperties',
                //'click .top_map'  : 'display_map',
                'click .top_list'   : 'searchProperties',
                'change .srchopt'   : 'searchPropertiesRoute',
                'change #dd_city'   : 'load_locality_options',
                'click .top_map'    : 'searchPropertiesRoute',
                'click .top_list'   : 'searchPropertiesRoute'

            },




            initialize : function(args) {

               var self = this;

                _.bindAll(this ,'render','searchProperties','display_map');
               /*  _.bindAll(this ,'renderForm'); */

               console.log('SEARCH OPTIONS:-----')
               console.log(args);


                if(!_.isUndefined(args)){

                  this.selectedStatus   = args.pstatus;
                  this.selectedCity     = args.city;
                  this.selectedLocality = args.locality;
                  this.selectedType     = args.type;

                }



                if(_.isUndefined(getAppInstance().searchOptions)){
                    jQuery.ajax(AJAXURL,{
                        type: 'GET',
                        action:'get_search_options',
                        data :{action:'get_search_options'},
                        complete: function() {

                        },
                        success: function(response) {

                            getAppInstance().searchOptions = response ;

                            self.load_display_properties();
                        },
                        error: function(){

                        },

                        dataType: 'json'
                    });
                }
                else{
                    self.load_display_properties();
                }




            },








            load_display_properties :function function_name (argument) {

                        var self = this;

                         var seldata = { 'selectedCity'  : this.selectedCity,
                                      'selectedLocality' : this.selectedLocality,
                                      'selectedType'     : this.selectedType,
                                      'selectedStatus'   : this.selectedStatus
                                    }



                        if(jQuery('#dd_status').length<=0){
                            var template = _.template(jQuery(self.template).html());
                            jQuery('.top-dd-c').html(template({data : getAppInstance().searchOptions, selected:seldata }));
                        }
                        else{


                        }






 
                         
              if(jQuery('#dd_status').val().toLowerCase()=='completed'){
                jQuery('.top-compar').hide();
                jQuery('#projects_listings').addClass('completed_status_projects')
              }
              else{
                jQuery('.top-compar').show();
                jQuery('#projects_listings').removeClass('completed_status_projects')

              }









                        if(_.isUndefined(getAppInstance().residentialPropertyCollection ) || getAppInstance().residentialPropertyCollection.length <0){
                        getAppInstance().residentialPropertyCollection = new ResidentialPropertiesCollection();
                        getAppInstance().residentialPropertyCollection.fetch({
                            success: function(collection) { // the fetched collection!


                                 if(!_.isUndefined(getAppInstance().mainView.mapview) && getAppInstance().mainView.mapview==true){
                                     jQuery('.top_map').addClass('current');

                                    jQuery('.top_list').removeClass('current')

                                    self.display_map();
                                }
                                else{

                                     jQuery('.top_list').addClass('current');

                                    jQuery('.top_map').removeClass('current')

                                    if(_.isUndefined(getAppInstance().projectlistView ))
                                        getAppInstance().projectlistView = new projectsListingsView(self);
                                    else{
                                      console.log('self.searchProperties() :-------------------------------------1');
                                        self.searchProperties()
                                      }
                                }


                            },
                            error: function(){

                            },

                            dataType: 'json'
                        });
                    }
                    else{

                         if (!_.isUndefined(getAppInstance().mainView.mapview) && getAppInstance().mainView.mapview==true){
                                     jQuery('.top_map').addClass('current');

                                    jQuery('.top_map').removeClass('current')
                                    self.display_map();
                                }

                                else{

                                    if(_.isUndefined(getAppInstance().projectlistView ))
                                        getAppInstance().projectlistView = new projectsListingsView(self);
                                    else{
                                      console.log('self.searchProperties() :-------------------------------------2')
                                      self.searchProperties()
                                    }

                                }

                    }


    },




   display_map : function(){

    var self = this;
                console.log('display map');;

                jQuery('.top_map').addClass('current');
                jQuery('.top_list').removeClass('current')

              //  var properties = getAppInstance().residentialPropertyCollection.toJSON();


                var prop_status = jQuery('#dd_status').val();
                var prop_city = jQuery('#dd_city').val();
                var prop_locality = jQuery('#dd_locality').val();
                var prop_type = jQuery('#dd_type').val();

                var search_options = {};
                if(prop_status!='')
                   search_options['property_status'] =  prop_status;

                 if(prop_city!='')
                                   search_options['property_city'] =  prop_city;

                 if(prop_locality!='')
                                   search_options['property_locaity'] =  prop_locality;

                 if(prop_type!='')
                                   search_options['property_unit_type'] =  prop_type;



                var res_collection = getAppInstance().residentialPropertyCollection  ;

                 // var search_collections = res_collection.where({ property_status: prop_status});


                /*var search_collections = res_collection.where({'property_status':prop_status,
                                        'property_city':prop_city,
                                        'property_locaity': prop_locality,
                                        'property_unit_type':prop_type
                                          }) */

                var search_collections = res_collection.models;

                delete search_options['property_unit_type'] ;

                if( (prop_status!='') || (prop_city!='') || (prop_locality!='')  )
                    var search_collections = res_collection.where(search_options )


                var sel_search_collections = {};
                var cnt_sel_search_collection = 0;



                if( prop_type!='' && !_.isNull(prop_type)){

                     console.log('MAP PROPERTY is not NULL & NOt Empty:------------------- SEARCH COLLECTIONS ')
                     console.log(search_collections)

                    _.each(search_collections,function(vl_searchres,ky_searchres){


                       var exists_by_type = _.where(vl_searchres.get('property_unit_type'),{type:prop_type})
                      if(exists_by_type.length>0){
                        sel_search_collections[cnt_sel_search_collection] = vl_searchres;

                        cnt_sel_search_collection = cnt_sel_search_collection+1;
                      }
                    })
                    search_collections = sel_search_collections;
                  }






                var properties = search_collections;
                console.log('properties:----------map')
                console.log(properties)

                var marker_image = SITEURL+'/wp-content/themes/samba-child/img/map_pin_norm.png';
                var marker_image2 = SITEURL+'/wp-content/themes/samba-child/img/map_pin_selected.png';

                var infowindow = new google.maps.InfoWindow();

                var marker, i;


                //commented on 1june2015 if(properties.length>0){
                  if(_.size(properties)>0){

                     var map = new google.maps.Map(document.getElementById('projects_listings'), {
                                zoom:11,
                                center: new google.maps.LatLng(18.52043, 73.85674),
                                mapTypeId: google.maps.MapTypeId.ROADMAP

                            });


                    for (i = 0; i < _.size(properties); i++) {


                        locations = properties[i].get('map_address')[0];

                        jQuery('#projects_listings').css({'display':'block',
                                   'width' :'100%',
                                   'height' : 'auto',
                                   'min-height':'400px'

                                })

                       /* commented on 23july2015 zoom to pune if(i==0){

                            var map = new google.maps.Map(document.getElementById('projects_listings'), {
                                zoom:15,
                                center: new google.maps.LatLng(locations.lat, locations.lng),
                                mapTypeId: google.maps.MapTypeId.ROADMAP

                            });

                        } */


                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations.lat, locations.lng),
                            map: map,
                            icon :  marker_image
                        });


                        google.maps.event.addListener(marker, 'mouseover', function() {
                            this.setIcon(marker_image2);
                        });
                        google.maps.event.addListener(marker, 'mouseout', function() {
                            this.setIcon(marker_image);
                        });

                        google.maps.event.addListener(infowindow, 'domready', function() {
                         /* var l = $('#hook').parent().parent().parent().siblings();
                          var l = $('.map_info_c').closest('.gm-style-iw').parent().addClass('MYCUSTOM TEST CLASS');

                          for (var i = 0; i < l.length; i++) {
                              if($(l[i]).css('z-index') == 'auto') {
                                  $(l[i]).css('border-radius', '16px 16px 16px 16px');
                                  $(l[i]).css('border', '2px solid red');
                              }
                          }*/
                          //alert(jQuery('.map_info_c').length);
                         /* var l =  jQuery('.map_info_c').closest('.gm-style-iw').parent();
                          for (var i = 0; i < l.length; i++) {

                            jQuery(l[i]).addClass('MYCUSTOM_TEST_CLASS');

                          } */




                           jQuery('.gm-style-iw').each(function() {
                            var iwOuter = jQuery(this);
                            var iwBackground = iwOuter.prev();
                            var acwi = window.innerWidth ? window.innerWidth : jQuery(window).width();
                            console.log('actual screen width: ' + acwi);
                            // Remove the background shadow DIV
                            iwBackground.children(':nth-child(2)').css({'display' : 'none'});
                            // Remove the white background DIV
                            iwBackground.children(':nth-child(4)').css({'display' : 'none'});
                            // Moves the infowindow 115px to the right. because after
                            //applying styles and all, the arrow and close btn do not position properly
                            if (acwi <= 680) {
                              iwOuter.parent().parent().css({left: '108px'});
                            } else {
                              iwOuter.parent().parent().css({left: '128px'});
                            }
                            // Moves the shadow of the arrow 76px to the left margin function
                            function setarrowposition() {
                              if (acwi < 680) {
                                iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 63px !important;'});
                                // Moves the arrow 76px to the left margin
                                iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 63px !important;'});
                              } else {
                                iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 63px !important;'});
                                // Moves the arrow 76px to the left margin
                                iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 63px !important;'});
                              }
                            }
                            jQuery('html, body').mousemove(function(e) {
                              setarrowposition();
                            });
                            jQuery('html, body').click(function() {
                              setarrowposition();
                            });
                            // Moves the shadow of the arrow 76px to the left margin
                            setarrowposition();
                            // Changes the desired color for the tail outline.
                            // The outline of the tail is composed of two descendants of div which contains the tail.
                            // The .find('div').children() method refers to all the div which are direct descendants of the previous div.
                            iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(0, 0, 0, 0.2) 0px 1px 6px', 'z-index' : '1'});

                            //for the mobile scales
                            if (acwi < 680) {
                              iwOuter.children().css({
                                width: '300px',
                                'min-width': '310px'
                              });
                              iwOuter.parent().css({
                                'min-width': '320px'
                              });
                            } else {
                              iwOuter.children().css({
                                width: '288px',
                                'min-width': '352px'
                              });
                              iwOuter.parent().css({
                                'min-width': '404px'
                              });
                            }

                            // Taking advantage of the already established reference to
                            // div .gm-style-iw with iwOuter variable.
                            // You must set a new variable iwCloseBtn.
                            // Using the .next() method of JQuery you reference the following div to .gm-style-iw.
                            // Is this div that groups the close button elements.
                            var iwCloseBtn = iwOuter.next();
                            // Apply the desired effect to the close button
                            if (acwi < 680) {
                              iwCloseBtn.css({
                                width: '27px',
                                height: '27px',
                                opacity: '0.5', // by default the close button has an opacity of 0.7
                                right: '30px', top: '3px', // button repositioning
                                border: '7px solid rgb(255, 255, 255)', // increasing button border and new color
                                'border-radius': '13px', // circular effect
                                'box-shadow': 'rgba(0, 0, 0, 0.298039) 0px 0px 5px' // 3D effect to highlight the button
                                });
                            } else {
                              iwCloseBtn.css({
                                width: '27px',
                                height: '27px',
                                opacity: '0.5', // by default the close button has an opacity of 0.7
                                right: '38px', top: '3px', // button repositioning
                                border: '7px solid rgb(255, 255, 255)', // increasing button border and new color
                                'border-radius': '13px', // circular effect
                                'box-shadow': 'rgba(0, 0, 0, 0.298039) 0px 0px 5px' // 3D effect to highlight the button
                                });
                            }

                            // The API automatically applies 0.7 opacity to the button after the mouseout event.
                            // This function reverses this event to the desired value.
                            jQuery(this).mouseover(function(){
                              iwCloseBtn.css({opacity: '1'});
                            });
                            jQuery(this).mouseout(function(){
                              iwCloseBtn.css({opacity: '0.5'});
                            });
                          });



                        jQuery('.map_info_c').closest('.gm-style-iw').addClass('draggable');

                          jQuery('.map_info_c').closest('.gm-style-iw').attr('property-id',jQuery('.map_info_c').attr('property-id'))

                          jQuery('.map_info_c').closest('.gm-style-iw').attr('property-address',jQuery('.map_info_c').attr('property-address'))
                          jQuery('.map_info_c').closest('.gm-style-iw').attr('property-title',jQuery('.map_info_c').attr('property-title'))

                         /* commented on 23july2015  self.make_div_draggable() */
                      });


                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {

                      /*       var popup_content = "<table cellpadding='0' cellspacing='0' border='0' ><tr><td>"+
                       "<img src='"+properties[i].get('featured_image')+"' width='60' /></td><td><b>"+properties[i].get('post_title')
                       +" </b> |  "+properties[i].get('property_locaity')+" "+properties[i].get('property_city')+" <br/>"+properties[i].get('property_unit_type')+"</td></tr>";

                        */


              map.setCenter(marker.getPosition()); //Center align the Marker
            self.offsetCenter(map,map.getCenter(),-0,-100)

infowindow.open(map,marker);


              /* circle = new google.maps.Circle({
                map: map,
                fillColor : '#BBD8E9',
                fillOpacity : 0.3,
                radius : 60000,
                strokeColor : '#BBD8E9',
                strokeOpacity : 0.9,
                strokeWeight : 2,
              });

            // console.log(circle);

            circle.bindTo('center', marker, 'position');


            showHideCircle(map, circle);


            function showHideCircle(map, circle) {
              google.maps.event.addListener(circle, 'mouseout', function() {
                circle.setOptions({
                  fillOpacity: 0,
                  strokeOpacity: 0
                });
              });
              google.maps.event.addListener(circle, 'mouseover', function() {
                circle.setOptions({
                  fillOpacity: 0.35,
                  strokeOpacity: 0.3
                });
              });
            }  */



                    var featured_img_thumbnail = properties[i].get('featured_image_thumbnail');

                    var property_price = _.isEmpty(properties[i].get('property_price'))?'':'INR '+properties[i].get('property_price')


                    var popup_content ='<div class="map_info_c"    property-id="'+properties[i].get('id')+'" property-title = "'+properties[i].get('post_title')+'" property-address="'+properties[i].get('property_locality_name')+' '+properties[i].get('property_city_name')+'">'+
                                       '                  <div class="img_cont">'+
                                            '<a href="#" class="img_link">'+
                                                '<img src="'+featured_img_thumbnail[0]+'" alt="" class="pull-left map_fi">'+
                                           ' </a>'+
                                        '</div>'+
                                        '<div class="map_info "       >'+
                                            '<a href="'+properties[i].get('post_url')+'" class="map_p_title">'+
                                                '<span class="single_p_title">'+properties[i].get('post_title')+'</span>'+
                                                '<span class="single_p_light">|</span>'+
                                                '<span class="single_p_location">'+properties[i].get('property_locality_name')+' ';

                          if(jQuery('#dd_city').val()==''){
                              popup_content = popup_content + properties[i].get('property_city_name');
                           }
                              popup_content = popup_content + '</span>'+


                                            '</a>'+
                                            '<p class="map_excerpt">';

                      var individial_proptype_cnt  = 0;
                                            _.each(properties[i].get('property_unit_type'),function(proptype_vl1,proptype_ky1){
                                               if(individial_proptype_cnt>0)
                                                popup_content+= ', ';
                                              popup_content+= proptype_vl1.type_name;
                                              individial_proptype_cnt++;
                                            })

                    popup_content = popup_content +
                                            '</p>'+
                                            ' <p class="map_p_cost">'+
                                                property_price+
                                            '</p>   '+
                                            '<div class="map_btm">'+
                                            '    <div class="pull-left">'+
                                            '       <a href="#" class="btn_norm single_enq popmake-popup-property-list"><i class="fa fa-envelope-o"></i></a>'+
                                            '      <!-- <a href="#" class="btn_norm single_share"><i class="fa fa-share-alt"></i></a> -->'+
                                            '       <a class="btn_norm single_share">'+
                                            '         <span class="st_sharethis" st_image="'+featured_img_thumbnail[0]+'"   st_url="'+properties[i].get('post_url')+'" st_title="'+properties[i].get('post_title')+'"  ></span>'+
                                            '      </a>'+
                                            '        <a href="javascript:void(0)" class="btn_norm single_compare add_to_compare"    property-id="'+properties[i].get('id')+'" property-title = "'+properties[i].get('post_title')+'" property-address="'+properties[i].get('property_locality_name')+' '+properties[i].get('property_city_name')+'"></a>'+
                                            '    </div>'+
                                            '    <div class="pull-right">'+
                                            '        <a href="'+properties[i].get('post_url')+'" class="btn_norm single_know">'+
                                            '            <i class="fa fa-angle-right"></i>'+
                                            '        </a>'+
                                            '    </div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'





                      infowindow.setContent(popup_content);
                      infowindow.open(map, marker);


                      jQuery('#projects_listings').height(jQuery(window).height() - jQuery('#projects_listings').position().top - 40);
                     // jQuery('#projects_listings').first(div).css({'padding':'5px 50px 25px'});

                    // Draggabled commented 27july2015    self.make_div_draggable();


                        setTimeout(function(){

                            var switchTo5x=true;
                           stLight.options({publisher: "1423128c-ec17-415a-8eaf-4ba0d655a2d6", doNotHash: false, doNotCopy: false, hashAddressBar: false, onhover: false});
                           stButtons.locateElements();

                        },300)


                    }
                  })(marker, i));
                }


                var min_ht = jQuery(window).height() - jQuery('#projects_listings').position().top - 43;
               // alert(min_ht) ;
                jQuery ('#projects_listings').css('min-height',min_ht+'px');


        }
        else{

            jQuery('#projects_listings').html('<p class="no_props">No Properties to display!</p>');
        }

            },


            make_div_draggable : function(){
              if(jQuery(".draggable").length>0){
                                console.log('draggable')
                                jQuery(".draggable").draggable({ cursor: "crosshair",  revert:"invalid",helper:"clone",appendTo: 'body', containment: 'parent',scroll: false,iframeFix: true,zIndex: 1000,


                                start: function(event, ui) {
                                    ui.helper.css({ height: 'auto', width: 'auto' });
                                },
                                stop: function(event, ui) {
                                    ui.helper.css({ height: 'auto', width: 'auto' });
                                }

                            });
                        }
                        else{
                            console.log('no dragables')
                        }
            },


            /**
             * Render the view
             * @param  {[type]} evt [description]
             * @return {[type]}     [description]
             */
            render : function(evt) {

                console.log('render getAppInstance().searchOptions');
                console.log(getAppInstance().searchOptions)

                 var self =this;

                                var template = _.template(jQuery(self.template).html());

                                jQuery('.top-dd-c').html(template({data : getAppInstance().searchOptions}));

                                var projectlistView = new projectsListingsView();


                return this;
            },

            searchProperties: function(evt){


                var self = this ;



                var prop_city       = self.selectedCity;
                var prop_locality   = self.selectedLocality;
                var prop_type       = self.selectedType;
                var prop_status     = self.selectedStatus;


                var prop_status     = jQuery('#dd_status').val();
                var prop_city       = jQuery('#dd_city').val();
                var prop_locality   = jQuery('#dd_locality').val();
                var prop_type       = jQuery('#dd_type').val();

                var search_options  = {};


                if(prop_status!='')
                   search_options['property_status'] =  prop_status;

                 if(prop_city!='')
                                   search_options['property_city'] =  prop_city;

                 if(prop_locality!='')
                                   search_options['property_locaity'] =  prop_locality;

                 if(prop_type!='')
                                   search_options['property_unit_type'] =  prop_type;



                var res_collection = getAppInstance().residentialPropertyCollection  ;

                 // var search_collections = res_collection.where({ property_status: prop_status});


                /*var search_collections = res_collection.where({'property_status':prop_status,
                                        'property_city':prop_city,
                                        'property_locaity': prop_locality,
                                        'property_unit_type':prop_type
                                          }) */

                var search_collections = res_collection.models;


                delete search_options['property_unit_type'] ;

                if( (prop_status!='') || (prop_city!='') || (prop_locality!='') )
                    var search_collections = res_collection.where(search_options )


                  var sel_search_collections = {};
                  var cnt_sel_search_collection = 0;

                  if( prop_type!='' && !_.isNull(prop_type)){

                     console.log(search_collections)

                    _.each(search_collections,function(vl_searchres,ky_searchres){


                       var exists_by_type = _.where(vl_searchres.get('property_unit_type'),{type:prop_type})
                      if(exists_by_type.length>0){
                        sel_search_collections[cnt_sel_search_collection] = vl_searchres;

                        cnt_sel_search_collection = cnt_sel_search_collection+1;
                      }
                    })
                    search_collections = sel_search_collections;
                  }

                /* var projectListingsTemplate2 = _.template(jQuery('#spn_propertieslistings').html());

                                                jQuery('#proj_list').html(projectListingsTemplate2({propertiesdata : search_collections}));
                */

                /*var template2 = _.template(jQuery('#spn_propertieslistings').html(), {propertiesdata : search_collections});
                console.log(template2);
                jQuery("#proj_list").html(template2);*/
                jQuery('#projects_listings').attr('style','')





                 //if( (!_.isUndefined(getAppInstance().mainView.mapview) && getAppInstance().mainView.mapview==true)  || (jQuery(evt.target).hasClass('top_list')==false && jQuery('.top_map').hasClass('current'))     ||  (jQuery(evt.target).hasClass('top_map') ) ){
                    if( !_.isUndefined(getAppInstance().mainView.mapview) && getAppInstance().mainView.mapview==true) {
                    jQuery('.top_map').addClass('current');
                    jQuery('.top_map').removeClass('current')
                    this.display_map();
                }
               // if(jQuery(evt.target).hasClass('top_list') || (jQuery(evt.target).hasClass('top_map') ==false && jQuery('.top_map').hasClass('current') == false)){
                if( _.isUndefined(getAppInstance().mainView.mapview) || getAppInstance().mainView.mapview==false) {
                    jQuery('.top_list').addClass('current');
                    jQuery('.top_map').removeClass('current')

                     var projectListingsTemplate2 = _.template(jQuery('#spn_propertieslistings').html());

                 jQuery('#projects_listings').html(projectListingsTemplate2({propertiesdata : search_collections, dropdown_city:jQuery('#dd_city').val(), dropdown_city_name:jQuery("#dd_city option:selected").text()}));

                 var min_ht = jQuery(window).height() - jQuery('#projects_listings').position().top - 43;
                //alert(min_ht+'=========') ;
                jQuery ('#projects_listings').css('min-height',min_ht+'px');



                  setTimeout(function(){

                  //console.log('LOADING SHARE BUTTON :-------------------------------------------')
                  //console.log(jQuery('#projects_listings').html())
                    var switchTo5x=true;
                   stLight.options({publisher: "1423128c-ec17-415a-8eaf-4ba0d655a2d6", doNotHash: false, doNotCopy: false, hashAddressBar: false, onhover: false});
                   stButtons.locateElements();

                  },300) 





                if(jQuery(".draggable").length>0){
                    console.log('draggable')
                    jQuery(".draggable").draggable({ cursor: "crosshair",  revert:"invalid",helper:"clone", cursorAt: { top: 120, left: 150 },

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




              if (jQuery('div').hasClass('project-list')) {
               if (jQuery('div').hasClass('single_p_w')) {
                   jQuery('.project-list.row .single_p_w').each(function() {
                       //console.log('winscroll: ' + $(window).scrollTop() + ' this.offset: ' + $(this).offset().top);
                       if (jQuery(window).scrollTop() < (jQuery(this).offset().top - 150) && jQuery(this).offset().top < (jQuery(window).scrollTop() + jQuery(window).height())) {
                           console.log('adds class visi')
                           jQuery(this).addClass('visigoth');
                       } else {
                           console.log('removes class visi')
                           jQuery(this).removeClass('visigoth');
                       }
                   });
               }
              }



                /*this.mainView.make_div_dropable2(".drag_area")





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
                } */







                }





            },

            load_locality_options : function(evt){

                var event_val = jQuery(evt.target).val();

                console.log('load_locality_options')
                console.log(getAppInstance().searchOptions)
                var localities_options = [];
                var sorted_localities_options = [];

                if(!_.isUndefined(getAppInstance().searchOptions['locality'].localities)){
                    if(_.isArray(getAppInstance().searchOptions['locality'].localities) )
                      localities_options = getAppInstance().searchOptions['locality'].localities;
                }

                if(_.size(localities_options)>0){
                      sorted_localities_options = _.sortBy(localities_options, function(obj){ return obj.name.toLowerCase() });
                }

                            console.log('event_val:---------------------------------------------')
                            console.log(event_val)

                            jQuery('#dd_locality').empty();
                            jQuery('#dd_locality').append("<option value=''>Locality : All</option>")
                            jQuery('#dd_locality').append("<option class='select-dash' disabled='disabled'>------------------------------</option>");

                            _.each(sorted_localities_options, function(vl_localities,ky_localities){

                               if(parseInt(vl_localities.city_id)==parseInt(event_val)){

                                    var display_locality_name = vl_localities.name;
                                    if(_.size(vl_localities.name)>14){
                                      display_locality_name =  display_locality_name.substr(0, 13)+'...';

                                    }
                                    jQuery('#dd_locality').append("<option value='"+vl_localities.ID+"'>"+display_locality_name+"</option>")




                                }
                            })

            },


            searchPropertiesRoute:function(evt){

              var self = this;

              var search_opt = '';

              var prop_status     = jQuery('#dd_status').val();
                var prop_city       = jQuery('#dd_city').val();
                var prop_locality   = jQuery('#dd_locality').val();
                var prop_type       = jQuery('#dd_type').val();


              if(prop_status.toLowerCase()=='completed'){
                jQuery('.top-compar').hide();
                jQuery('#projects_listings').addClass('completed_status_projects')
              }
              else{
                jQuery('.top-compar').show();
                jQuery('#projects_listings').removeClass('completed_status_projects')

              }

              if(!_.isUndefined(prop_status) && prop_status !='' )
                search_opt = search_opt + '/st/'+prop_status;

              if(!_.isUndefined(prop_city) && prop_city !='' )
                search_opt = search_opt + '/ct/'+prop_city;


              if(!_.isUndefined(prop_locality) && prop_locality!='')
                search_opt = search_opt+'/loc/'+prop_locality;

              if(!_.isUndefined(prop_type) && prop_type!='')
                search_opt = search_opt+'/type/'+prop_type;

              var evt_type =   typeof jQuery(evt.target).attr('href');

              if( (evt_type == 'undefined' &&  jQuery('.top_list').hasClass('current') ) || ( jQuery(evt.target).hasClass('top_list') )  ){

                var RedirectUrl = SITEURL+'/residential-properties/#' ;

              }
              else if( (evt_type == 'undefined' &&  jQuery('.top_map').hasClass('current') ) || ( jQuery(evt.target).hasClass('top_map') )  ){

                var RedirectUrl = SITEURL+'/residential-properties/#map' ;

              }



              console.log('REDIRECT URL :  '+RedirectUrl+search_opt)


              location.assign(RedirectUrl+search_opt) ;


            },


             offsetCenter:function(map,latlng,offsetx,offsety) {

            // latlng is the apparent centre-point
            // offsetx is the distance you want that point to move to the right, in pixels
            // offsety is the distance you want that point to move upwards, in pixels
            // offset can be negative

            var scale = Math.pow(2, map.getZoom());
            var nw = new google.maps.LatLng(
                map.getBounds().getNorthEast().lat(),
                map.getBounds().getSouthWest().lng()
            );

            var worldCoordinateCenter = map.getProjection().fromLatLngToPoint(latlng);
            var pixelOffset = new google.maps.Point((offsetx/scale) || 0,(offsety/scale) ||0)

            var worldCoordinateNewCenter = new google.maps.Point(
                worldCoordinateCenter.x - pixelOffset.x,
                worldCoordinateCenter.y + pixelOffset.y
            );

            var newCenter = map.getProjection().fromPointToLatLng(worldCoordinateNewCenter);

            map.setCenter(newCenter);

            }

















        });

/*        return SiteProfileView;

    }); */