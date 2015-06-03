(function($) {
    //all child js
    $(document).ready(function() {
        //remove this line later
        // $('#prk_ajax_container .tabular.inner .tab_col .text_in').click(function() {
        //     $('#prk_ajax_container .tabular.inner .tab_col').removeClass('opened');
        //     console.log(!($(this).parent().hasClass('blue_bg')) && !($(this).parent().hasClass('opened')));
        //     console.log($(this).parent('.tab_col').attr('class'));

        //     if (!($(this).parent().hasClass('blue_bg')) && !($(this).parent().hasClass('opened'))) {
        //         $(this).parent().addClass('opened');
        //     } else {
        //         $('#prk_ajax_container .tabular.inner .tab_col').removeClass('opened');
        //     }
        // });


        //tabular left and right
        $(document).on('click', '.tabular_c .right', function() {
            $par = $(this).parent('.tabular_c');
            $objiq = $par.find('.tabul_main');
            $contw = $par/*.find('.tabul_hold')*/.innerWidth();
            $mainw = $objiq.width();
            $r = Math.floor($mainw / $contw);
            // console.log('$contw: ' + $contw);
            // console.log('$mainw: ' + $mainw);
            // console.log('$r: ' + $r);
            // console.log(parseInt($objiq.css('left')) + (2 * $contw) < $mainw);
            // console.log(parseInt($objiq.css('left')));
            // console.log((parseInt($objiq.css('left')) + $contw));
            // console.log((parseInt($objiq.css('left')) + $contw < $mainw));
            // console.log((-parseInt($objiq.css('left')) + $contw < $mainw));

            // if (parseInt($objiq.css('left')) + (2 * $contw) < $mainw) {
            //     $objiq.css('left', '-='+$contw);
            // } else if (parseInt($objiq.css('left')) == 0) {
            //     $objiq.css('left', '-='+($mainw - $contw));
            // } else if (-parseInt($objiq.css('left')) + $contw < $mainw) {
            //     $objiq.css('left', '-='+$contw);
            // }

            // if (parseInt($objiq.css('left')) + (2 * $contw) < $mainw) {
            //     $objiq.css('left', '='+$contw);
            // } else if ($mainw - $contw < $contw && parseInt($objiq.css('left')) < ($mainw - $contw)) {
            //     $objiq.css('left', '-='+($mainw - $contw));
            // }
        });

        $(window).load(function() {
            if ($('body').hasClass('page-template-floor_plans')) {
                $('#prk_ajax_container').append(
                    '<div class="go_to_top_inpage"></div>'
                );
                $btmval = $('.floorplans_tab').offset().top + $('.floorplans_tab').height() - $('.go_to_top_inpage').height();
                $('.go_to_top_inpage').css({
                    'top': $btmval,
                    'right': 0
                });
                $(document).on('click', '.go_to_top_inpage', function() {
                    $('html, body').animate({scrollTop:0}, '500', 'swing');
                });
            }
        });
        $(window).resize(function() {
            if ($('body').hasClass('page-template-floor_plans')) {
                $btmval = $('.floorplans_tab').offset().top + $('.floorplans_tab').height() - $('.go_to_top_inpage').height();
                $('.go_to_top_inpage').css({
                    'top': $btmval,
                    'right': 0
                });
            }
        });



        $('.faq_faq .arconix-faq-wrap .arconix-faq-title').each(function(i) {
            $(this).prepend('<i class="faq_head_count">' + (i + 1) + '. </i>');
        });
        //gallery popup class adder
        if ($('div').hasClass('gallery')) {
            $('.gallery a.thumbnail').addClass('poppup'); //was image-popup-no-margins
        }
        if ($('div').hasClass('owl-carousel')) {
            $('.owl-carousel .owl-item .item a').each(function() {
                $(this).attr('href', $(this).find('img').attr('src'));
            });
            $('.owl-carousel .owl-item .item a').addClass('poppup'); //was image-popup-no-margins
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
        if (!($('.indi_prj_page').hasClass('floorplans'))) {
            $('#prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block').css('marginTop', $hevp);
        }

        $('#full_fi_c').css('height', $hevp);
        //$('#centered_block').css('minHeight', $hevp);
        $(window).resize(function() {
            $hevp = window.innerHeight ? window.innerHeight : $(window).height();
            if (!($('.indi_prj_page').hasClass('floorplans'))) {
                $('#prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block').css('marginTop', $hevp);
            }
            $('#full_fi_c').css('height', $hevp);
        });

        //scroll down indi prj page
        $('.go_d_see').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: $hevp}, '2000ms', 'easeInQuad');
        });

        //set the height
        $('.indi_map_area iframe').height($('.indi_map_area').find('.vc_col-sm-6').eq(1).height());

        $('.gallery').each(function() {
            $(this).owlCarousel({
                loop:true,
                items: 3,
                autoHeight: 160,
                autoPlay: false,
                pagination: false,
                navigation: true,
                itemsCustom : false,
                itemsDesktop : [1199, 3],
                itemsDesktopSmall : [979, 2],
                itemsTablet : [767, 2],
                itemsTabletSmall : [680, 2],
                itemsMobile : [479, 1],
                singleItem : false,
                scrollPerPage: true,

                responsiveClass:true/*,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1217:{
                        items:3
                    }
                }*/
            });
            //$(this).find('.owl-item').find('br').parent().removeClass('owl-item').remove();
            $(this).find('.owl-item').each(function() {
                $title = $(this).find('img').attr('alt');
                $(this).find('.gallery-icon').append(
                    '<p class="img-title">' + $title + '</p>'
                    );
            });
        });
        if ($('div').hasClass('gallery')) {
            $('.gallery .owl-item .item a').addClass('poppup'); //was image-popup-no-margins
            $('.gallery .owl-controls .owl-buttons .owl-prev').html('<i class="fa fa-chevron-left"></i>');
            $('.gallery .owl-controls .owl-buttons .owl-next').html('<i class="fa fa-chevron-right"></i>');
        }


        $('.owl-wrapper').each(function() {
            $(this).magnificPopup({
              delegate: 'a',
              type: 'image',
              tLoading: 'Loading image #%curr%...',
              mainClass: 'mfp-img-mobile',
              gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
              },
              image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                  return item.el.attr('title') + '<small>Marvel</small>';
                }
              },

              midClick: true,
              removalDelay: 300,
              mainClass: 'my-mfp-zoom-in'
            });
        });

        //set min-height for project listings
        if($('div').hasClass('proj_list')) {
            $('#projects_listings').css({
                'min-height': $(window).height() - $('#projects_listings').position().top - 70,
                'position': 'relative'
            });
        }

        //availability and layout
        $(document).on('click', '.ava_tog', function(e) {
            e.preventDefault();
            if (!($($(this).attr('href')).hasClass('current'))) {
                $loc = $(this).attr('href');
                $par = $(this).parents('.wpb_tab');

                $par.find('.inner-panels').removeClass('current');
                $($loc).addClass('current');

                $par.find('.ava_tog').removeClass('curr')
                $par.find('.ava_tog').find('span').removeClass('white')

                $(this).addClass('curr');
                $(this).find('span').addClass('white')
            }
        });

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

        //map view - set height to fill the remaining space
        if ($('div').hasClass('gm-style')) {
            $('#projects_listings').height($(window).height() - $('#projects_listings').position().top - 40);
        }
    });
})( jQuery );