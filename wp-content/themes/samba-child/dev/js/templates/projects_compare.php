<script type="tex/template" id="projectsCompareTemplate" >

<%

console.log('pid : '+ pid);
console.log('psid'+psid);
console.log('propertiesdata : ');
console.log(propertiesdata);
console.log(searchOptions);
var f_prop, s_prop;
var f_prop_amenities,s_prop_amenities;
var f_amenity_present,s_amenity_present;

var prop_amenities = searchOptions.amenities;
var prop_neighbourhood = searchOptions.neighbourhood;
var f_prop_neighbourhood, s_prop_neighbourhood;





//var neighbourhood_options = searchOptions.
console.log('propertiesdata length');
console.log(propertiesdata.length);

_.each(propertiesdata,function(vl,ky){

console.log('vl');
    console.log(vl.get('id'));

    if(parseInt(vl.get('id'))==parseInt(pid)){


        f_prop = vl;
         console.log('f_prop');
 console.log(f_prop);


    }
    if(parseInt(vl.get('id'))==parseInt(psid)){

        s_prop = vl;
          console.log('s_prop');
 console.log(s_prop);
    }

});

 console.log('f_prop');
 console.log(f_prop);
  console.log('s_prop');
 console.log(s_prop);

%>

<!--these are the Compare styles-->
            <!--these are the Compare styles-->
            <!--these are the Compare styles-->
            <div class="compare_c">
                <div class="top-dd-c info_bar">
                     <a href="javascript:void(0)" onclick="if(history.length<=1){ location.href='<%=SITEURL%>/residential-properties'} else {history.go(-1);}"class="wpb_button back_btn"><i class="fa fa-angle-left"></i> Back to Residential</a>


                    <p>
                        You are comparing between
                        <a href="#" class="comp_n">Marvel <%=f_prop.get('post_title')%></a>
                        and
                        <a href="#" class="comp_n">Marvel <%=s_prop.get('post_title')%></a>
                    </p>
                </div>
                    <!--start here next-->
                    <div class="compare_i_c">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th></th>
                                <th class="with_img single_p_w">
                                    <div class="co_img_c single_p_img" style="background-image: url(<%=f_prop.get('featured_image') %>);">
                                        <!--<img src="<%=f_prop.get('featured_image') %>" alt="" class="compare_fi">-->
                                        <div class="single_p_hov_c">
                                            <div class="single_p_likes single_top"><i class="fa fa-heart"></i> 30</div>
                                            <div class="clearfix"></div>
                                            <div class="single_p_info">
                                                <% /* <h6> _.pluck(f_prop.get('property_unit_type'),'property_unit_type_display').join() </h6>*/ %>
                                                <h6><%=f_prop.get('property_display_unit_type') %></h6>
                                                <h6><%=f_prop.get('property_price') %></h6>
                                            </div>
                                            <div class="single_btm">
                                                <div class="pull-left">
                                                    <a href="#" class="btn_norm single_enq popmake-popup-property-list"><i class="fa fa-envelope-o"></i></a>
                                                   <!--  <a href="#" class="btn_norm single_share"><i class="fa fa-share-alt"></i></a> -->
                                                    <a class="btn_norm single_share">
                                                        <span class='st_sharethis' st_image="<%=f_prop.get('featured_image') %>"   st_url="<%=f_prop.get('post_url') %>" st_title="<%=f_prop.get('post_title')%>"  ></span>
                                                    </a>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="<%=f_prop.get('post_url') %>" target="_blank" class="btn_norm single_know">Know More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single_p_cap">
                                        <p class="single_p_inf">
                                            <a href="#">
                                                <span class="single_p_title">Marvel <%=f_prop.get('post_title')%></span>
                                                <span class="single_p_light">|</span>
                                                <span class="single_p_location"><%=f_prop.get('property_locality_name') %>  </span>
                                            </a>
                                        </p>
                                    </div>
                                </th>
                                <th class="with_img single_p_w">
                                    <div class="co_img_c single_p_img" style="background-image: url(<%=s_prop.get('featured_image') %>);">
                                        <!--<img src="<%=s_prop.get('featured_image') %>" alt="" class="compare_fi">-->
                                        <div class="single_p_hov_c">
                                            <div class="single_p_likes single_top"><i class="fa fa-heart"></i> 30</div>
                                            <div class="clearfix"></div>
                                            <div class="single_p_info">
                                                <% /* <h6>_.pluck(s_prop.get('property_unit_type'),'property_unit_type_display').join()</h6> */ %>
                                                <h6><%=s_prop.get('property_display_unit_type')%></h6>
                                                <h6><%=s_prop.get('property_price') %></h6>
                                            </div>
                                            <div class="single_btm">
                                                <div class="pull-left">
                                                    <a href="#" class="btn_norm single_enq popmake-popup-property-list"><i class="fa fa-envelope-o"></i></a>
                                                    <!-- <a href="#" class="btn_norm single_share"><i class="fa fa-share-alt"></i></a> -->
                                                    <a class="btn_norm single_share">
                                                        <span class='st_sharethis' st_image="<%=s_prop.get('featured_image') %>"   st_url="<%=s_prop.get('post_url') %>" st_title="<%=s_prop.get('post_title')%>"  ></span>
                                                    </a>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="<%=s_prop.get('post_url') %>" target="_blank" class="btn_norm single_know">Know More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single_p_cap">
                                        <p class="single_p_inf">
                                            <a href="#">
                                                <span class="single_p_title">Marvel <%=s_prop.get('post_title') %></span>
                                                <span class="single_p_light">|</span>
                                                <span class="single_p_location"><%=s_prop.get('property_locality_name') %>  </span>
                                            </a>
                                        </p>
                                    </div>
                                </th>
                            </tr>

                            <tr class="head-row">
                                <td colspan="3">Residences</td>
                            </tr>
                            <tr>
                                <td>Types</td>
                                <td><% /*_.pluck(f_prop.get('property_unit_type'),'property_unit_type_display').join() */ %><%=f_prop.get('property_display_unit_type')%></td>
                                <td><% /*_.pluck(s_prop.get('property_unit_type'),'property_unit_type_display').join() */ %><%=s_prop.get('property_display_unit_type')%></td>
                            </tr>
                            <tr>
                                <td>Sellable Area</td>

                                <%

                                var f_max_area_arr =  _.pluck(f_prop.get('property_unit_type'),'max_area');
                                var f_min_area_arr =  _.pluck(f_prop.get('property_unit_type'),'min_area');

                                var f_max_area = _.size(f_max_area_arr)>0?_.max(f_max_area_arr):'';
                                var f_min_area = _.size(f_min_area_arr)>0?_.min(f_min_area_arr):'';

                                var s_max_area_arr = _.max(_.pluck(s_prop.get('property_unit_type'),'max_area'));
                                var s_min_area_arr = _.min(_.pluck(s_prop.get('property_unit_type'),'min_area'));

                                var s_max_area = _.size(s_max_area_arr)>0?_.max(s_max_area_arr):'';
                                var s_min_area = _.size(s_min_area_arr)>0?_.min(s_min_area_arr):'';

                                console.log('-=-=-=-==--=-=-=-=---=-=-')    ;
                                console.log(_.pluck(s_prop.get('property_unit_type'),'min_area'));

                               /*  var min_sellable_area =' - ';
                                var max_sellable_area =' - ';

                                var array = jQuery.map(f_prop.get('property_sellablearea'), function(value, index) {
                                                if(index=='min-area'){
                                                      min_sellable_area = value;
                                                }
                                                else if(index=='max-area'){
                                                      max_sellable_area = value;
                                                }

                                                return [value];
                                            });



                                var s_min_sellable_area =' - ';
                                var s_max_sellable_area =' - ';

                                var s_array = jQuery.map(s_prop.get('property_sellablearea'), function(value, index) {
                                                if(index=='min-area'){
                                                      s_min_sellable_area = value;
                                                }
                                                else if(index=='max-area'){
                                                      s_max_sellable_area = value;
                                                }

                                                return [value];
                                            });
                                */


                                %>

                                <td><%= f_min_area+' to '+f_max_area+' Sq. Ft.'  %></td>
                                <td><%= s_min_area+' to '+s_max_area+' Sq. Ft.'  %></td>
                            </tr>

                            <tr class="head-row">
                                <td colspan="3">Amenities</td>
                            </tr>
                            <%
                                f_prop_amenities =  f_prop.get('amenities');
                                s_prop_amenities =  s_prop.get('amenities');


                               _.each(prop_amenities,function(vl_am,ky_am){
                                f_amenity_present = [];
                                s_amenity_present = [];

                                f_amenity_present = _.where(f_prop_amenities, {term_id: parseInt(vl_am.term_id)});
                                s_amenity_present = _.where(s_prop_amenities, {term_id: parseInt(vl_am.term_id)});


                            %>
                            <tr>
                                <td><%=vl_am.name %></td>
                                <td><span class="<% if(_.isUndefined(f_amenity_present) || f_amenity_present.length<=0) {%>no<% } else{%>yes<%} %>">-</span></td>
                                <td><span class="<% if(_.isUndefined(s_amenity_present) || s_amenity_present.length<=0) {%>no<% } else{%>yes<%} %>">-</span></td>
                            </tr>
                            <%

                               })
                            %>

                            <tr class="head-row darker-bg">
                                <td colspan="3">Neighbourhood</td>
                            </tr>

                            <%


                            f_prop_neighbourhood = f_prop.get('poperty_neighbourhood');
                            s_prop_neighbourhood = s_prop.get('poperty_neighbourhood');

                            _.each(prop_neighbourhood,function(vl_nb,ky_nb){



                             %>
                             <tr>
                                <td class="da"><%=vl_nb%></td>
                                <td><%= f_prop_neighbourhood[vl_nb]!='' && !_.isUndefined(f_prop_neighbourhood[vl_nb]) ?f_prop_neighbourhood[vl_nb]+' KM':' - '  %></td>
                                <td><%= s_prop_neighbourhood[vl_nb]!='' && !_.isUndefined(s_prop_neighbourhood[vl_nb])?s_prop_neighbourhood[vl_nb]+' KM':' - '  %></td>
                            </tr>
                             <%


                            })
                            %>

                        </table>
                    </div>
                    <div class="compare_f full-width">
                        <p class="foot_head">Looking for Help?</p>
                        <p>Its very easy to get overwhelmed with the unique propositions of Marvel properties. Let us help you in making up your mind.</p>
                        <a href="#" class="wpb_button popmake-give-details">Give Details</a>
                    </div>
            </div>
            <!--END Compare styles-->
            <!--END Compare styles-->
            <!--END Compare styles-->
</script>