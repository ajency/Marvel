
<?php /* <div class="top-dd-c"> */ ?>
<script type="text/template" id="projectlistSearchOptionsTemplate" >
    <div class="top-dd one">
        <select id="dd_status" name="dd_status" class='srchopt' >
         <option value="">Select</option>
        <% console.log('test template');

            _.each(data.status,function(vl,ky){
            %><option value="<%=vl%>"><%=vl%></option>

            <% }) %>

        </select>
    </div>
    <div class="top-dd two">
        <select id="dd_city" name="dd_city"  class='srchopt' >
         <option value="">Select</option>
            <% console.log('test template');

            _.each(data.citylocality,function(vl,ky){
            %><option value="<%=ky%>"><%=ky%></option>

            <% }) %>

        </select>
    </div>
    <div class="top-dd thr">
        <select id="dd_locality" name="dd_locality"  class='srchopt'  >
         <option value="">Select</option>
            <% console.log('test template');

          /*  _.each(data.locality,function(vl,ky){
            %  ><option value="< %=vl% >">< %=vl% ></option>

            < % }) */ %>
        </select>
    </div>
    <div class="top-dd fou">
        <select id="dd_type" name="dd_type"  class='srchopt' >
         <option value="">Select</option>
            <% console.log('test template');

            _.each(data.type,function(vl,ky){
            %><option value="<%=vl%>"><%=vl%></option>

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