
<?php /* <div class="top-dd-c"> */ ?>
<script type="text/template" id="projectlistSearchOptionsTemplate" >


<%  
var selectedCity     = !_.isUndefined(selected.selectedCity)? selected.selectedCity : '' ;
var selectedLocality = !_.isUndefined(selected.selectedLocality)? selected.selectedLocality : '' ;
var selectedType     = !_.isUndefined(selected.selectedType)? selected.selectedType : '' ;
var selectedStatus     = !_.isUndefined(selected.selectedStatus)? selected.selectedStatus : '' ;

%>
    <div class="top-dd one">
        <select id="dd_status" name="dd_status" class='srchopt' >
         <option value="">Status</option>
        <% 
            _.each(data.status,function(vl,ky){
            %><option value="<%=vl%>"  <% if(selectedStatus==vl){%> selected  <% }%>  ><%=vl%></option>

            <% }) %>

        </select>
    </div>
    <div class="top-dd two">
        <select id="dd_city" name="dd_city"  class='srchopt' >
         <option value="">City</option>
            <%  
            _.each(data.citylocality,function(vl,ky){
            %><option value="<%=ky%>"   <% if(selectedCity == ky) {%> selected <% }%> ><%=ky%></option>

            <% }) %>

        </select>
    </div>
    <div class="top-dd thr">
        <select id="dd_locality" name="dd_locality"  class='srchopt'  >
         <option value="">Locality</option>
            <% 
            _.each(data.citylocality,function(vl,ky){
if(selectedCity == ky) {
    _.each(vl,function(vl_locality,ky_locality){
            %><option value="<%=vl_locality%>"  <% if(vl_locality==selectedLocality) { %> selected <% } %>><%=vl_locality%></option><%

    })
}



            }) 

            console.log('SELECTED OPTIONS DROPDOWN ');
            console.log(data);
            console.log(selected);

             if(selectedCity!=''){

                console.log('SELECTED OPTIONS CITY ');
                console.log(data.citylocality.selectedCity);
             }

             %>
        </select>
    </div>
    <div class="top-dd fou">
        <select id="dd_type" name="dd_type"  class='srchopt' >
         <option value="">Type</option>
            <%   
            _.each(data.type,function(vl,ky){
            %><option value="<%=vl.ID%>" <% if(selectedType==vl.ID) { %> selected <% } %>><%=vl.property_type%></option>

            <% }) %>
        </select>
    </div>
    <div class="top-sea">
        <button type="button" class="btn_norm sea"><i class="fa fa-search"></i></button>
    </div>
    <div class="pull-right top-view">
        <a href="#" class="top_list current"><i class="fa fa-th-large"></i></a>
        <a href="javascript:void(0);" class="top_map"><i class="fa fa-map-marker"></i></a>
    </div>

<?php /*
</div>  */ ?>
</script>