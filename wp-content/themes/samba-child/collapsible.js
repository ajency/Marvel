(function($) {

	//Collapsible in mobile and tablets
	function collapsing_objects($control, $target1, $target2, $target3) {
		$control.click(function() {
			$(this).toggleClass('toggle_open');
			$target1.toggleClass('visi');
			if ($target2)
				$target2.toggleClass('visi');
			if ($target3)
				$target3.toggleClass('visi');
		});
	}

	//location toggle
	collapsing_objects($('.col_head_loc'), $('.col_cont_loc'), '', '');

})( jQuery );