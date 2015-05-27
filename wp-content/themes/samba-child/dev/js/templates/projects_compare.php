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
                        <a href="#" class="comp_n"><%=f_prop.get('post_title')%></a>
                        and
                        <a href="#" class="comp_n"><%=s_prop.get('post_title')%></a>
                    </p>
                </div>
                    <!--start here next-->
                    <div class="compare_i_c">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th></th>
                                <th class="with_img">
                                    <div class="co_img_c">
                                        <img src="<%=f_prop.get('featured_image') %>" alt="" class="compare_fi">
                                    </div>
                                    <p class="single_p_inf">
                                        <a href="#">
                                            <span class="single_p_title"><%=f_prop.get('post_title')%></span>
                                            <span class="single_p_light">|</span>
                                            <span class="single_p_location"><%=f_prop.get('property_locaity') %> <%=f_prop.get('property_city') %></span>
                                        </a>
                                    </p>
                                </th>
                                <th class="with_img">
                                    <div class="co_img_c">
                                        <img src="<%=s_prop.get('featured_image') %>" alt="" class="compare_fi">
                                    </div>
                                    <p class="single_p_inf">
                                        <a href="#">
                                            <span class="single_p_title"><%=s_prop.get('post_title') %></span>
                                            <span class="single_p_light">|</span>
                                            <span class="single_p_location"><%=s_prop.get('property_locaity') %>  <%=f_prop.get('property_city') %></span>
                                        </a>
                                    </p>
                                </th>
                            </tr>

                            <tr class="head-row">
                                <td colspan="3">Residences</td>
                            </tr>
                            <tr>
                                <td>Types</td>
                                <td><%=f_prop.get('property_type')%></td>
                                <td><%=s_prop.get('property_type')%></td>
                            </tr>
                            <tr>
                                <td>Sellable Area</td>
                                <td><%= f_prop.get('property_sellablearea')!=''?f_prop.get('property_sellablearea')+'SQ. FT.': ' - ' %> </td>
                                <td><%= s_prop.get('property_sellablearea')!=''?s_prop.get('property_sellablearea')+'SQ. FT.': ' - ' %></td>
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
                        <p>Its very easy to get overwhelmed with the unique propositions of Marvel properties. Let us help you in making up your mmind.</p>
                        <a href="#" class="wpb_button">Give Details</a>
                    </div>
            </div>
            <!--END Compare styles-->
            <!--END Compare styles-->
            <!--END Compare styles-->
</script>