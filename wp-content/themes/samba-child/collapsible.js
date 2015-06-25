(function($) {

	//Collapsible in mobile and tablets
	function collapsing_objects($control, $target1, $target2, $target3, $ifnoclass) {
		$control.click(function() {
			if ($ifnoclass) {
				$(this).toggleClass('toggle_open');
				$(this).find($target1).toggleClass('visi');
			} else {
				$(this).toggleClass('toggle_open');
				$target1.toggleClass('visi');
				if ($target2)
					$target2.toggleClass('visi');
				if ($target3)
					$target3.toggleClass('visi');
			}
		});
	}

	//location toggle
	collapsing_objects($('.col_head_loc'), $('.col_cont_loc'), '', '', false);
	//sub hero section
	collapsing_objects($('.col_head_sec'), $('.col_cont_sec'), '', '', false);
	//section with 2 column content
	collapsing_objects($('.col_head_sec2'), $('.col_cont_sec2'), '', '', false);
	collapsing_objects($('.col_head_sec3'), $('.col_cont_sec3'), '', '', false);
	//amenities
	collapsing_objects($('.col_head_ame'), $('.col_cont_ame'), '', '', false);
	//specs
	collapsing_objects($('.col_spec_wrap .prk_service'), '.service_inner_desc', '', '', true);
	//downloads
	collapsing_objects($('.col_down_wrap.do_3 .wpb_wrapper'), '.wpb_button_a', '', '', true);

})( jQuery );