<script type="text/templte" id="spn_propertieslistings">
<div id="proj_list" class="project-list row">
<div class="twelve columns">
    <h5>Residential Projects </h5>
</div>
<!--single project listing-->
<%
console.log('-=-=-=-=-=--=-');
console.log(propertiesdata);
console.log(dropdown_city);

%>
<%
if(propertiesdata.length<=0){
%> <p class="no_props">No Properties to display!</p>
<%

}

_.each(propertiesdata,function(propertyvl,propertyky){


var property_id = _.isUndefined(propertyvl.id)? propertyvl.get('id'): propertyvl.id;
var property_title = _.isUndefined(propertyvl.post_title)? propertyvl.get('post_title'): propertyvl.post_title;

var property_city = _.isUndefined(propertyvl.property_city)? propertyvl.get('property_city'): propertyvl.property_city;
var property_locality = _.isUndefined(propertyvl.property_locaity)? propertyvl.get('property_locaity'): propertyvl.property_locaity;
var featured_image = _.isUndefined(propertyvl.featured_image)? propertyvl.get('featured_image'): propertyvl.featured_image;
var property_url = _.isUndefined(propertyvl.post_url)? propertyvl.get('post_url'): propertyvl.post_url;
var property_unit_type = _.isUndefined(propertyvl.property_unit_type)? propertyvl.get('property_unit_type'): propertyvl.property_unit_type;
var property_price = _.isUndefined(propertyvl.property_price)? propertyvl.get('property_price'): propertyvl.property_price;

var property_locality_name = _.isUndefined(propertyvl.property_locality_name)? propertyvl.get('property_locality_name'): propertyvl.property_locality_name;
var property_city_name = _.isUndefined(propertyvl.property_city_name)? propertyvl.get('property_city_name'): propertyvl.property_city_name;


var property_sellablearea = _.isUndefined(propertyvl.property_sellablearea)? propertyvl.get('property_sellablearea'): propertyvl.property_sellablearea;
    %>
<div class="single_p_w six columns property_span_<%=property_id%> draggable"  property-id="<%=property_id%>" property-title = '<%=property_title%>' property-address="<%=property_locality_name%><%= _.isEmpty(property_locality_name)?'':', '%><%=property_city_name%>" >
    <div class="single_p_img" style="background-image: url(<% if(featured_image!=false) { %><%=featured_image%><% } else { %>http://loremflickr.com/1000/1000/building<% } %>);">
        <!--<img src=" <% if(featured_image!=false) { %><%=featured_image%><% } else { %>http://loremflickr.com/1000/1000/building<% } %>">-->
            <div class="single_p_hov_c">
                <div class="single_p_likes single_top"><i class="fa fa-heart"></i> 30</div>
                <div class="clearfix"></div>
                <div class="single_p_info">
                    <h6>
                    <% var current_property_unit_types = '';
                    var proptype_cnt = 0;
                    _.each(property_unit_type,function(proptype_val,proptype_key){

                        if(!_.isUndefined(proptype_val['type'])){
                             if(proptype_cnt>0)
                            current_property_unit_types = current_property_unit_types + ', ';
                        current_property_unit_types = current_property_unit_types + proptype_val['type_name'];

                        }
                        proptype_cnt++;
                    })
                    %>
                    <%=current_property_unit_types%> </h6>
                    <h6><%= _.isEmpty(property_price)?'':'INR '+property_price /* INR 2.2 CR + */ %></h6>
                </div>

                <div class="single_btm">
                    <div class="pull-left">
                        <a href="#" class="btn_norm single_enq"><i class="fa fa-envelope-o"></i></a>
                        <!--<a href="#" class="btn_norm single_share"><i class="fa fa-share-alt"></i></a>-->
                        <a class="btn_norm single_share">
                            <span class='st_sharethis' st_image="<%=featured_image %>"   st_url="<%=property_url %>" st_title="<%=property_title%>"  ></span>
                        </a>
                        <!-- <span class='st_email'  ></span> -->

                    </div>
                    <div class="pull-right">
                        <a href="<%=property_url%>" class="btn_norm single_know" target="_blank" >Know More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_p_cap " property-id="<%=property_id%>" property-title = '<%=property_title%>' property-address="<%=property_locality%>, <%=property_city%>" >
            <p class="single_p_inf">
                <a href="#">
                    <span class="single_p_title"><%=property_title%></span>
                    <% if(property_locality!='' ) { %><span class="single_p_light">|</span>
                        <span class="single_p_location"><%=property_locality_name%></span>
                    <% }
                    if(dropdown_city=='') { %>
                    <%= _.isUndefined(property_city_name)?'':property_city_name%>
                    <% } %>
                </a>
            </p>
        </div>
    </div>
<%
})
%>
<div class="single_p_w last_one six columns">
    <div class="last_one_t">
        <h4>Looking for more options?</h4>
        <p>Tell us your requirement and <br>we will let you know when there is a match.</p>
        <a href="#" class="btn_norm single_know">
            Give Details
        </a>
    </div>
</div>
</div>
</script>
