<?php 
function  custom_search_box(){


$html = '<div class="vc_wp_search wpb_content_element faq_search"><div class="widget widget_search"><form role="search" method="get" id="searchform" class="form-search" action="http://www.marvelrealtors.com/" data-url="http://www.marvelrealtors.com/search/">
	<div class="sform_wrapper">

	<input type="hidden" name="post_type" value="faq" />
  		<input type="text" value="" name="s" id="samba_search" class="search-query pirenko_highlighted placeholder" placeholder="Search this website..." style="outline: none;">
  		<div class="icon-search"></div>
    </div>
</form></div></div>';


return $html;
}

add_shortcode('custom_search_box', 'custom_search_box');

