<?php
	global $prk_samba_frontend_options;
	global $prk_translations;
	$prk_samba_frontend_options=get_option('samba_theme_options');
	//GET THE SEARCH PAGE URL
	$clean_url=get_search_link('remove');
	if (strpos($clean_url,'/?') == true)
	{
		$clean_url = substr($clean_url, 0, strpos($clean_url, "=")+1);
	}
	else
	{
		$clean_url=dirname($clean_url);
		$clean_url =includeTrailingCharacter($clean_url,'/');
	}
?>
<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>" data-url="<?php echo $clean_url; ?>">
	<div class="sform_wrapper">
  		<input type="text" value="" name="s" id="samba_search" class="search-query pirenko_highlighted" placeholder="<?php echo($prk_translations['search_tip_text']); ?>" />
  		<div class="icon-search"></div>
    </div>
</form>