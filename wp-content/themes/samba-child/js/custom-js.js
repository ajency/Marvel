jQuery(document).ready(function($) {



	$('.btm_unit_type_btn').live("click",function(evt){

		var tab_link = $(this).attr('tab-link')
		console.log(' tab link '+tab_link)
		$(this).closest('.floorplans_tab').find('.ui-tabs-nav').find('a[href="'+tab_link+'"]').click();

		/* console.log('clicking tab manually')
		console.log($(this).closest('.floorplans_tab').find('.ui-tabs-nav').length)
		console.log($(this).closest('.floorplans_tab').find('.ui-tabs-nav').find('a[href="'+tab_link+'"]').length)
		console.log($(this).closest('.floorplans_tab').find('.ui-tabs-nav').find("a[href='"+tab_link+"']").html()) */
	})




	$('.ui-tabs-anchor').live("click",function(evt){
    

    var current_tab_id_link = $(this).attr('href');

    var current_tab_id=current_tab_id_link.replace('#','');

    var prev_tab = $(this).parent().prev('li').find('.ui-tabs-anchor');
    var next_tab = $(this).parent().next('li').find('.ui-tabs-anchor');
   /* console.log(prev_tab.attr('href'))
    console.log(prev_tab.html()) */

    var btm_foot_html ="<p> Check availability in other unit types.";

    if(prev_tab.length>0 && prev_tab.attr('href')!=="#tab-siteplan"){
    	btm_foot_html = btm_foot_html + ' <a tab-link="'+prev_tab.attr('href')+'"  href="javascript:void(0)" class="wpb_button_a btm_unit_type_btn">'
                 				  +'      <span   class="wpb_button  wpb_btn-inverse">'+prev_tab.html()+'</span>'
                 				  +'  </a>';
    }
    if(next_tab.length>0){
    	btm_foot_html = btm_foot_html + '<a tab-link="'+next_tab.attr('href')+'"  href="javascript:void(0)"  class="wpb_button_a btm_unit_type_btn">'
                        		  +'<span class="wpb_button  wpb_btn-inverse">'+next_tab.html()+'</span>'
                     			  +'</a>';
	}

    btm_foot_html = btm_foot_html + '</p>';

    $(current_tab_id_link).find('.btm_foot').html(btm_foot_html)

})




	


	});