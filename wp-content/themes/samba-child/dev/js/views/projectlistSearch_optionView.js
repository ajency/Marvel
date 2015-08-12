

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
                'click .top_list'   : 'searchPropertiesRoute',
                'change #home_city2': 'load_locality_options',
                

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
                  this.post_type        = args.post_type;
                  if(!_.isUndefined(args.near))
                    this.near             = args.near;

                }

console.log(this.selectedStatus)

                if(_.isUndefined(getAppInstance().searchOptions)){
                    jQuery.ajax(AJAXURL,{
                        type: 'GET',
                        action:'get_search_options',
                        data :{action:'get_search_options',post_type:self.post_type},
                        complete: function() {

                        },
                        success: function(response) {

                            getAppInstance().searchOptions = response ;

                            window.search_options = response;

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







            load_search_filter_values_mobile : function(searchOptions,selected){
                
                var selectedCity     = !_.isUndefined(selected.selectedCity)? selected.selectedCity : '' ;
                var selectedLocality = !_.isUndefined(selected.selectedLocality)? selected.selectedLocality : '' ;
                var selectedType     = !_.isUndefined(selected.selectedType)? selected.selectedType : '' ;
                var selectedStatus   = !_.isUndefined(selected.selectedStatus)? selected.selectedStatus : '' ;



                var sorted_status = [];
                if(_.size(searchOptions.status)>0){

                    var sorted_status_options  = _.sortBy(searchOptions.status, function(obj){ /* return obj.toLowerCase() */ return obj.charCodeAt() * -1;  });
                    jQuery('#home_status2').empty();
                    var status_html ='';
                    var status_dropdown_selected = '';
                    var home_status2_html='';
                   
                    _.each(sorted_status_options,function(vl,ky){

                        if(selectedStatus==vl){
                           status_dropdown_selected = ' selected ';
                        }

                        home_status2_html+='<option value="'+vl+'"  '+status_dropdown_selected+'  >'+vl+'</option>';
                    })

                    jQuery('#home_status2').html(home_status2_html);
                }





                var cities_options = _.isUndefined(searchOptions.cities.cities)?[]:searchOptions.cities.cities;

                var sorted_cities_options = [];
                var home_city2_html = ''
                var city_dropdown_selected = '';
                home_city2_html+='<option value="">City : All</option>';
                home_city2_html+='<option class="select-dash" disabled="disabled">----------------------------------</option>';

                if(_.size(cities_options)>0){
                    var sorted_cities_options  = _.sortBy(cities_options, function(obj){ return obj.name.toLowerCase() });
                    _.each(sorted_cities_options,function(vl,ky){

                      if(selectedCity == vl.ID){
                        city_dropdown_selected = ' selected ';
                      }

                    home_city2_html+='<option value="'+vl.ID+'"  '+city_dropdown_selected+' >'+vl.name+'</option>';

                     })
                }

                 jQuery('#home_city2').html(home_city2_html);






                 var sorted_type_options = [];
                 var type_dropdown_selected = '';
                 var home_type2_html = '';
                 home_type2_html ='<option value="">Type : All</option>';
                 home_type2_html+='<option class="select-dash" disabled="disabled">------------------------------</option>'; 
                  if(_.size(searchOptions.type) > 0)
                      var sorted_type_options  = _.sortBy(searchOptions.type, function(obj){ return obj.property_unit_type.toLowerCase() });

                  _.each(sorted_type_options,function(vl,ky){

                    if(selectedType==vl.ID) {
                      type_dropdown_selected = ' selected';

                    }
                    home_type2_html+='<option value="'+vl.ID+'" '+type_dropdown_selected+'>'+vl.property_unit_type+' '+vl.property_type_name+'</option>';

                   })

                  jQuery('#home_type2').html(home_type2_html);


                 


            },

            load_display_properties :function (argument) {

                        var self = this;

                         var seldata = { 'selectedCity'  : this.selectedCity,
                                      'selectedLocality' : this.selectedLocality,
                                      'selectedType'     : this.selectedType,
                                      'selectedStatus'   : this.selectedStatus
                                    }



                        if(jQuery('#dd_status').length<=0){
                            var template = _.template(jQuery(self.template).html());
                            jQuery('.top-dd-c').html(template({data : getAppInstance().searchOptions, selected:seldata }));

                            self.load_search_filter_values_mobile(getAppInstance().searchOptions, seldata);
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





console.log('getAppInstance().residentialPropertyCollection:===================================')
console.log(getAppInstance().residentialPropertyCollection)
console.log(this.post_type)


                        if(_.isUndefined(getAppInstance().residentialPropertyCollection ) || getAppInstance().residentialPropertyCollection.length <0){
                      //alert(this.post_type) 
                       if(this.post_type=='residential-property') {
                       // alert('residential collection')
                          getAppInstance().residentialPropertyCollection = new ResidentialPropertiesCollection();
                          var propertyCollection = getAppInstance().residentialPropertyCollection;

                          jQuery('#post_type').val('residential-property')
                        }
                        else{
                       // alert('commercial collection')
                          getAppInstance().commercialPropertyCollection = new CommercialPropertiesCollection();
                          var propertyCollection = getAppInstance().commercialPropertyCollection  ;
                          jQuery('#post_type').val('commercial-property')
                        }


                       

                        propertyCollection.fetch({
                            success: function(collection) { // the fetched collection!
console.log(' getAppInstance()residentialPropertyCollection')
console.log( getAppInstance().residentialPropertyCollection)

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


                if(self.post_type =='commercial-property')
                    var res_collection = getAppInstance().commercialPropertyCollection  ;
                 else  
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
                if(!_.isUndefined(self.near))
                  var prop_near       = self.near;


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


                if(self.post_type =="commercial-property"){
                    var res_collection = getAppInstance().commercialPropertyCollection  ;
                }
                else{
                    var res_collection = getAppInstance().residentialPropertyCollection  ;
                }
                  
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


console.log('CHECKING SEARCH OPTIONS :______________________________ ')
console.log(search_options)


                if(!_.isUndefined(prop_near)){
                  alert(prop_near+': prop_near')
                  search_collections = self.show_nearby_properties(prop_near,search_collections)  
                }
                

                if(_.size(search_collections)>0){
                      search_collections = _.sortBy(search_collections, function(obj){ return parseInt(obj.menu_order) });
                }

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
                    jQuery(".draggable").draggable({ cursor: "crosshair",  revert:"invalid",helper:"clone", cursorAt: { top: 10, left: 10 },

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
                    //if(_.isArray(getAppInstance().searchOptions['locality'].localities) ){

                      localities_options = getAppInstance().searchOptions['locality'].localities;
                  //  }
                      
                    
                }

                console.log('localities_options:---------------------------------------')
                console.log(localities_options)

                if(_.size(localities_options)>0){
                      sorted_localities_options = _.sortBy(localities_options, function(obj){ return obj.name.toLowerCase() });
                }
                console.log('sorted_localities_options:---------------------------------------')
                console.log(sorted_localities_options)

                            console.log('event_val:---------------------------------------------')
                            console.log(event_val)

                            jQuery('#dd_locality').empty();
                            jQuery('#dd_locality').append("<option value=''>Locality : All</option>")
                            jQuery('#dd_locality').append("<option class='select-dash' disabled='disabled'>------------------------------</option>");


                            jQuery('#home_location2').empty();
                            jQuery('#home_location2').append("<option value=''>Locality : All</option>")
                            jQuery('#home_location2').append("<option class='select-dash' disabled='disabled'>------------------------------</option>");

                            _.each(sorted_localities_options, function(vl_localities,ky_localities){

                               if(parseInt(vl_localities.city_id)==parseInt(event_val)){

                                    var display_locality_name = vl_localities.name;
                                    if(_.size(vl_localities.name)>14){
                                      //display_locality_name =  display_locality_name.substr(0, 13)+'...';

                                    }
                                    jQuery('#dd_locality').append("<option value='"+vl_localities.ID+"'>"+display_locality_name+"</option>")
                                    jQuery('#home_location2').append("<option value='"+vl_localities.ID+"'>"+display_locality_name+"</option>")



                                }
                            })

            },


            searchPropertiesRoute:function(evt){

              var self = this;


              var evt_id = jQuery(evt.target).attr('id')
/*
              if(evt_id =='dd_city'){
                self.load_locality_options(evt);
              }
*/


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
                search_opt = search_opt + '/city/'+prop_city;


              if(!_.isUndefined(prop_locality) && prop_locality!='')
                search_opt = search_opt+'/loc/'+prop_locality;

              if(!_.isUndefined(prop_type) && prop_type!='')
                search_opt = search_opt+'/type/'+prop_type;

              var evt_type =   typeof jQuery(evt.target).attr('href');
              if(!_.isUndefined(getAppInstance().commercialPropertyCollection)){
                var RedirectUrl = SITEURL+'/commercial-properties/';
              }
              else{
                var RedirectUrl = SITEURL+'/residential-properties/';
              }

              if( (evt_type == 'undefined' &&  jQuery('.top_list').hasClass('current') ) || ( jQuery(evt.target).hasClass('top_list') )  ){

                  RedirectUrl = RedirectUrl + '#' ;

              }
              else if( (evt_type == 'undefined' &&  jQuery('.top_map').hasClass('current') ) || ( jQuery(evt.target).hasClass('top_map') )  ){

                  RedirectUrl = RedirectUrl + '#map' ;

              }

             // alert('evt_id:'+evt_id)
             jQuery(evt.target).closest('.top-dd').find('.elips-cont').html('jjj')

           //    jQuery(evt.target).closest('.top-dd').find('.elips-cont').html(jQuery('#'+evt_id+' option:selected').text())



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

            },


  rad : function(x) {
              return x * Math.PI / 180;
            },

     getDistance : function(p1, p2) {
      var R = 6378137; // Earth’s mean radius in meter
      var dLat = this.rad(p2.lat - p1.lat);
      var dLong = this.rad(p2.lng - p1.lng);
      var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(this.rad(p1.lat)) * Math.cos(this.rad(p2.lat)) *
        Math.sin(dLong / 2) * Math.sin(dLong / 2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      var d = R * c;
      return d; // returns the distance in meter
    },


            show_nearby_properties : function(near,search_collections){
        console.log('show nearby properties')
        console.log(_.where(search_collections,{id:parseInt(near)}))
 
            console.log('near Post ID :'+near)

var self = this;
          


            var current_property = _.first( _.where(search_collections,{id:parseInt(near) }) )            

            var current_property_map_address  = _.first(current_property.get('map_address'));

            var current_property_map_lat =   current_property_map_address.lat;

            var current_property_map_lng =   current_property_map_address.lng;


           
            var this_area_cnt = 0;
            var nearby_area_cnt = 0;
            var nearby_area = [];
            var this_area = [];


            _.each(search_collections,function(resprop_v,resprop_k){


console.log('SHOWING NEARBY PROPERTIES');
console.log(resprop_v.get('id'))
console.log(_.first(resprop_v.get('map_address')));
console.log('###########################################')
                var property_map_address  = _.first(resprop_v.get('map_address'));

                var distance = self.getDistance(current_property_map_address,property_map_address);

               /* if(parseFloat(distance)  <=2000 && distance != 0 ){
                    this_area[this_area_cnt] = resprop_v ;
                    this_area_cnt = this_area_cnt + 1;
                }
                else if(parseFloat(distance)  >2000 && parseFloat(distance)  <5000 ){
                    nearby_area[nearby_area_cnt] = resprop_v ;
                    nearby_area_cnt = nearby_area_cnt + 1;
                }*/



                if( (resprop_v.id!=current_property.get('id')) && ((parseFloat(distance)  <=2000 && distance == 0 ) || (parseFloat(distance)  >2000 && parseFloat(distance)  <5000 ) ) ){
                    this_area[this_area_cnt] = resprop_v ;
                    this_area_cnt = this_area_cnt + 1;
                }
             

                console.log("ID :"+resprop_v.id+"  || Distance : "+distance)
            })




            console.log('THIS AREA : ')
            console.log(this_area)
           // console.log('NEARBY AREA : ')
           // console.log(nearby_area)

            
            return this_area;

        }

             



        });

/*        return SiteProfileView;

    }); */