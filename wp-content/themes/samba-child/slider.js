(function($) {
    $.fn.galleryfy = function() {
        return this.each(function() {
            // Do something to each element here.
            if ($(this).find('dl.gallery-item').length > 4) {
                console.log('more');
                $(this).append(
                    '<div class="gal-ctrl">' +
                    '<a href="#" class="goLeft"><i class="fa fa-chevron-left"></i></a>' +
                    '<a href="#" class="goRight"><i class="fa fa-chevron-right"></i></a>' +
                    '</div>'
                );
                $(this).css('height', $(this).find('dl.galleryItem').outerHeight());
                $(window).resize(function() {
                    $(this).css('height', $(this).find('dl.galleryItem').outerHeight());
                });
            } else {
                console.log('4 images');
            }
//            $(this).on('click', '.goLeft', function(e) {
//                $(this).parents('.media_congal')
//            });
        });
    };
    $(document).ready(function() {
        $('.gallery').galleryfy();
    });
})( jQuery );