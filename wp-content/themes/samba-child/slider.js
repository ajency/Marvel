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
        
        if ($('div').hasClass('gallery_indi')) {
            $('.gallery_indi').attr('id', 'gall');
            $('.andmore a[href=#gall]').click(function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop: $('.gallery_indi').offset().top - 70}, '65500', 'linear');
            });
        }
        
        //top move down for individual projects page
        $hevp = window.innerHeight ? window.innerHeight : $(window).height();
        $('#prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block').css('marginTop', $hevp);
        $('#full_fi_c').css('height', $hevp);
        $('#centered_block').css('minHeight', $hevp);
        $(window).resize(function() {
            $hevp = window.innerHeight ? window.innerHeight : $(window).height();
            $('#prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block').css('marginTop', $hevp);
            $('#full_fi_c').css('height', $hevp);
        });
        
        //scroll down indi prj page
        $('.go_d_see').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: $hevp}, '65500', 'linear');
        });
        
        //set the height
        $('.indi_map_area iframe').height($('.indi_map_area').find('.vc_col-sm-6').eq(1).height());
    });
    
    function setEqualHeight(obj) {
        var serhe = obj.map(function() {
            return $(this).height();
        }).get();
        var maxse = Math.max.apply(null, serhe);
        obj.height(maxse);
    }
    
    $(window).load(function() {
        $('.child-footer').fadeIn('slow');
        
        //equal height services column
        setEqualHeight($('.le_p_m .wpb_wrapper .prk_service'));
        
        //equal height specifications
        setEqualHeight($('.se_o_6 .wpb_wrapper .prk_service'));
        
        //same height downloads
        setEqualHeight($('.do_3 .wpb_wrapper'));
        
        //same height careers
        setEqualHeight($('.lisofwork .wpb_wrapper'));
        
    });
    $(window).resize(function() {
        //equal height services column
        setEqualHeight($('.le_p_m .wpb_wrapper .prk_service'));
        
        //equal height specifications
        setEqualHeight($('.se_o_6 .wpb_wrapper .prk_service'));
        
        //same height downloads
        setEqualHeight($('.do_3 .wpb_wrapper'));
        
        //same height careers
        setEqualHeight($('.lisofwork .wpb_wrapper'));
        
        
        //map height set
        $('.indi_map_area iframe').height($('.indi_map_area').find('.vc_col-sm-6').eq(1).height());
    });
})( jQuery );