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
        
        
        //top move down for individual projects page
        $hevp = window.innerHeight ? window.innerHeight : $(window).height();
        $('#prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block').css('marginTop', $hevp);
        $(window).resize(function() {
            $hevp = window.innerHeight ? window.innerHeight : $(window).height();
            $('#prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block').css('marginTop', $hevp);
        });
        
    });
    $(window).load(function() {
        $('.child-footer').fadeIn('slow');
        //equal height services column
        var serhe = $('.le_p_m .wpb_wrapper .prk_service').map(function() {
            return $(this).height();
        }).get();
        var maxse = Math.max.apply(null, serhe);
        $('.le_p_m .wpb_wrapper .prk_service').height(maxse);
        
        //same height specifications
        var sphe = $('.se_o_6 .wpb_wrapper .prk_service').map(function() {
            return $(this).height();
        }).get();
        var maxsp = Math.max.apply(null, sphe);
        $('.se_o_6 .wpb_wrapper .prk_service').height(maxsp);
        
        //same height downloads
        var dnhe = $('.do_3 .wpb_wrapper').map(function() {
            return $(this).height();
        }).get();
        var maxdn = Math.max.apply(null, dnhe);
        $('.do_3 .wpb_wrapper').height(maxdn);
    });
})( jQuery );