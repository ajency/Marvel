jQuery(document).ready(function() {

    jQuery(".popmake").each(function(index) {
     jQuery(this).addClass('jsneeded');
 } );

    jQuery(".popmake").each(function(index) {
     jQuery(this).hide();
 } );

    window.addEventListener("load", popupFullyLoaded, false);

    function popupFullyLoaded(e) {
        jQuery(".popmake").each(function(index) {
         jQuery(this).removeClass('jsneeded');
     } );
    }

});