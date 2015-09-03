
<?php /* <div class="top-dd-c"> */ ?>
<script type="text/template" id="projectlistSearchOptionsTemplate" >


<%
var selectedCity     = !_.isUndefined(selected.selectedCity)? selected.selectedCity : '' ;
var selectedLocality = !_.isUndefined(selected.selectedLocality)? selected.selectedLocality : '' ;
var selectedType     = !_.isUndefined(selected.selectedType)? selected.selectedType : '' ;
var selectedStatus     = !_.isUndefined(selected.selectedStatus)? selected.selectedStatus : '' ;
var selected_city_id ;

console.log('SELECTED STATUS :--------------------------------------');
console.log(selectedStatus);

%>
    <div class="proj-showinmob">
        <a href="#" class="filter-btn"></a>
    </div>
    <div class="top-dd one">
        <select id="dd_status" name="dd_status" class='srchopt' >
    <% /*    <option value="">Status : All</option> 
         <option class="select-dash" disabled="disabled">----------------------------------</option> */ %>
        <%
        var sorted_status = [];
        if(_.size(data.status)>0){

            var sorted_status_options  = _.sortBy(data.status, function(obj){ /* return obj.toLowerCase() */ return obj.charCodeAt() * -1;  });
 

            _.each(sorted_status_options,function(vl,ky){
            %><option value="<%=vl%>"  <% if(selectedStatus==vl){%> selected  <% }%>  ><%=vl%></option>

            <% })
        }
        %>

        </select>
    </div>
    <div class="top-dd two">
        <select id="dd_city" name="dd_city"  class='srchopt' >
         <option value="">City : All</option>
         <option class="select-dash" disabled="disabled">----------------------------------</option>
            <%
             /* commented on 21june2015    _.each(data.citylocality,function(vl,ky){ */
            console.log('data.city');
            console.log(data);
            var cities_options = _.isUndefined(data.cities.cities)?[]:data.cities.cities;

            var sorted_cities_options = [];

            if(_.size(cities_options)>0){
                var sorted_cities_options  = _.sortBy(cities_options, function(obj){ return obj.name.toLowerCase() });


                _.each(sorted_cities_options,function(vl,ky){

                    if(selectedCity == vl.name){


                        selected_city_id = vl.ID;

                    }

                %><option value="<%=vl.name%>" data-cityid="<%=vl.ID%>"  <% if(selectedCity == vl.name) {%> selected <% }%> ><%=vl.name%></option>

                <% })
                }

             %>

        </select>
    </div>
    <div class="top-dd thr">
        <select id="dd_locality" name="dd_locality"  class='srchopt'  >
         <option value="">Locality : All</option>
         <option class="select-dash" disabled="disabled">------------------------------</option>
            <%
           
             

                 var locality_options = _.isUndefined(data.locality.localities)?[]:data.locality.localities;

                var sorted_locality_options = [];

                if(_.size(locality_options)>0){
                    var sorted_locality_options  = _.sortBy(locality_options, function(obj){ return obj.name.toLowerCase() });

                    _.each(locality_options,function(vl__locality,ky__locality){
                        
                        if(selected_city_id == vl__locality.city_id) {

                        %><option value="<%=vl__locality.name%>"  <% if(vl__locality.name==selectedLocality) { %> selected <% } %>><%=vl__locality.name%></option>
                        <% }


                    })
                }

            console.log('SELECTED OPTIONS DROPDOWN ');
            console.log(data);
            console.log(selected);

             /* if(selectedCity!=''){

                console.log('SELECTED OPTIONS CITY ');
                console.log(data.citylocality.selectedCity);
             } */

             %>
        </select>
    </div>
    <div class="top-dd fou">
        <select id="dd_type" name="dd_type"  class='srchopt' >
         <option value="">Type : All</option>
         <option class="select-dash" disabled="disabled">------------------------------</option>
            <%

            console.log('SORT POTIONS :---------------------')  ;
            console.log(_.size(data.type));

            var sorted_type_options = [];
            if(_.size(data.type) > 0)
                var sorted_type_options  = _.sortBy(data.type, function(obj){ return obj.property_unit_type.toLowerCase() });

console.log('sorted_type_options:------------------------------------------------------');
console.log(sorted_type_options);

            _.each(sorted_type_options,function(vl,ky){

                if(post_type=='residential-property'){
                %><option value="<%=vl.property_unit_type%><%= (post_type=='residential-property')?' '+vl.property_type_name:'' %>" <% if(selectedType==vl.property_unit_type+' '+vl.property_type_name) { %> selected <% } %>><%=vl.property_unit_type%><%= (post_type=='residential-property')?' '+vl.property_type_name:'' %></option>
                <%    
                }
                else{
                %>
                <option value="<%=vl.property_unit_type%>" <% if(selectedType==vl.property_unit_type) { %> selected <% } %>><%=vl.property_unit_type%></option>
                <%    
                }
                %>


            <% }) %>
        </select>
    </div>
    <div class="top-sea">
        <button type="button" class="btn_norm sea"><i class="fa fa-search"></i></button>
    </div>
    <div class="pull-right top-view">
        <a href="#" class="top_list current"><i class="fa fa-th-large"></i></a>
        <a href="#map" class="top_map"><i class="fa fa-map-marker"></i></a>
    </div>

<?php /*
</div>  */ ?>
</script>