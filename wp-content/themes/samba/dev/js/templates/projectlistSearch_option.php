
<?php /* <div class="top-dd-c"> */ ?>
<script type="text/template" id="projectlistSearchOptionsTemplate" >
    <div class="top-dd one">
        <select id="dd_status">
        <% console.log('test template');
            
            _.each(data.status,function(vl,ky){
            %><option value="<%=vl%>"><%=vl%></option>

            <% }) %>
             
        </select>
    </div>
    <div class="top-dd two">
        <select id="dd_city">
            <% console.log('test template');
            
            _.each(data.cities,function(vl,ky){
            %><option value="<%=vl%>"><%=vl%></option>

            <% }) %>
            
        </select>
    </div>
    <div class="top-dd thr">
        <select id="dd_locality" >
            <% console.log('test template');
            
            _.each(data.locality,function(vl,ky){
            %><option value="<%=vl%>"><%=vl%></option>

            <% }) %>
        </select>
    </div>
    <div class="top-dd fou">
        <select id="dd_type" >
            <% console.log('test template');
            
            _.each(data.type,function(vl,ky){
            %><option value="<%=vl%>"><%=vl%></option>

            <% }) %>
        </select>
    </div>
    <div class="top-sea">
        <button type="button" class="btn_norm sea"><i class="fa fa-search"></i></button>
        <input type="button" value="test" class="tstcheck"/>
    </div>
    <div class="pull-right top-view">
        <a href="#" class="top_list current"><i class="fa fa-th-large"></i></a>
        <a href="#" class="top_map"><i class="fa fa-map-marker"></i></a>
    </div>

<?php /* 
</div>  */ ?>
</script>