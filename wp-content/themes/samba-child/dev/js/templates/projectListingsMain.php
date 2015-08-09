<script type="text/template" id="projectlistMainTemplate" >
	<div class="proj_list" id="proj_list_main">
		<div class="top-dd-c">

	    </div>
	    <input type="hidden" name="post_type" id="post_type" value="<%=post_type%>"  />
	    <%  
	     if(post_type=="residential-property") { %>
	    <div class="drag_area_block2 top-compar">
	     <div class="drag_area one"   >Drag for Comparision</div>
		    <div class="drag_area two"    >Drag for Comparision</div>
		    <a href="#compare/0/0" class="btn_norm top_btn_co disabled btn_compare">Compare</a>


	    </div>
	    <% } %>
	    
	    <div id="projects_listings" <% if(post_type=="commercial-property") { %>class="commercial-property-list" <% } %>> 

			                
	        
	         
	    </div>    
	       
	</div>
</script>