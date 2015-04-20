(function($) {
    //all child js
    $(document).ready(function() {
        $('.faq_faq .arconix-faq-wrap .arconix-faq-title').each(function(i) {
            $(this).prepend('<i class="faq_head_count">' + (i + 1) + '. </i>');
        });
        //gallery popup class adder
        if ($('div').hasClass('gallery')) {
            $('.gallery a.thumbnail').addClass('image-popup-no-margins');
        }
        if ($('div').hasClass('owl-carousel')) {
            $('.owl-carousel .owl-item .item a').each(function() {
                $(this).attr('href', $(this).find('img').attr('src'));
            });
            $('.owl-carousel .owl-item .item a').addClass('image-popup-no-margins');
            $('.owl-carousel .owl-controls .owl-buttons .owl-prev').html('<i class="fa fa-chevron-left"></i>');
            $('.owl-carousel .owl-controls .owl-buttons .owl-next').html('<i class="fa fa-chevron-right"></i>');
        }
        if ($('div').hasClass('cont_sp')) {
            $(document).on('click', '#ui-id-3', function(e) {
                console.log('clicked');
                e.preventDefault();
                window.location = 'http://' + window.location.host + '/careers/';
                e.stopPropagation();
            });
        }
        $('.frm_forms input').click(function() {
            
        });
    });
    $(window).load(function() {
        $('.child-footer').fadeIn('slow');
//        if ($('div').hasClass('owl-carousel')) {
//            $('.owl-carousel').each(function() {
//                console.log($(this).find('.owl-item').outerHeight());
//                $(this).find('.owl-controls')
//                .find('.owl-buttons').find('.owl-prev')
//                .height($(this).height());
//            });
//        }
    });
})( jQuery );