<script type="text/templte" id="spn_propertieslistings">

<div class="twelve columns">
    <h5>Residential Projects </h5>
</div>
<!--single project listing-->
<%  
console.log('-=-=-=-=-=--=-');
console.log(propertiesdata);
 

%>
<% 
if(propertiesdata.length<=0){
%> No Properties to display!!
<%

}

_.each(propertiesdata,function(propertyvl,propertyky){

 var property_title = _.isUndefined(propertyvl.post_title)? propertyvl.get('post_title'): propertyvl.post_title;

var property_city = _.isUndefined(propertyvl.property_city)? propertyvl.get('property_city'): propertyvl.property_city;
var property_locaity = _.isUndefined(propertyvl.property_locaity)? propertyvl.get('property_locaity'): propertyvl.property_locaity;
var featured_image = _.isUndefined(propertyvl.featured_image)? propertyvl.get('featured_image'): propertyvl.featured_image;
 
var property_sellablearea = _.isUndefined(propertyvl.property_sellablearea)? propertyvl.get('property_sellablearea'): propertyvl.property_sellablearea;
    %>
<div class="single_p_w six columns">
    <div class="single_p_img">
        <img src=" <% if(featured_image!=false) { %><%=featured_image%><% } else { %>http://loremflickr.com/1000/1000/building<% } %>">
            <div class="single_p_hov_c">
                <div class="single_p_likes single_top"><i class="fa fa-heart"></i> 30</div>
                <div class="clearfix"></div>
                <div class="single_p_info">
                    <h6>Office Spaces: <%=property_sellablearea%></h6>
                    <h6>Retail Spaces: 500 - 1,400 sq. ft.</h6>
                </div>
                <div class="single_btm">
                    <div class="pull-left">
                        <a href="#" class="btn_norm single_enq"><i class="fa fa-envelope-o"></i></a>
                        <a href="#" class="btn_norm single_share"><i class="fa fa-share-alt"></i></a>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="btn_norm single_know">Know More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_p_cap">
            <p class="single_p_inf">
                <a href="#">
                    <span class="single_p_title"><%=property_title%></span>
                    <span class="single_p_light">|</span>
                    <span class="single_p_location"><%=property_locaity%> <%=property_city%></span>
                </a>
            </p>
        </div>
    </div>
<%
})
%>  
</script>
