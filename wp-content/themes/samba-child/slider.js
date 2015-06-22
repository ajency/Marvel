(function($) {
    //all child js
    $(document).ready(function() {
        //remove this line later
        $('#prk_ajax_container .tabular.inner .tab_col .text_in').click(function() {
            $('#prk_ajax_container .tabular.inner .tab_col').removeClass('opened');
            console.log(!($(this).parent().hasClass('blue_bg')) && !($(this).parent().hasClass('opened')));
            console.log($(this).parent('.tab_col').attr('class'));

            if (!($(this).parent().hasClass('blue_bg')) && !($(this).parent().hasClass('opened'))) {
                $(this).parent().addClass('opened');
            } else {
                $('#prk_ajax_container .tabular.inner .tab_col').removeClass('opened');
            }
        });


        //tabular left and right
        // var $actualWidth = 317;
        // $no_of_columns = $('.tabular_c').find('.tabul_main').find('.head').find('.tab_col').length;
        // $actual_table_width = $no_of_columns * $actualWidth;
        // $('.tabular_c').find('.tabul_main').width($actual_table_width);

        // $(document).on('click', '.tabular_c .right', function() {
        //     var $toShow;

        //     $wide = window.innerWidth ? window.innerWidth : $(window).width();
        //     if ($wide < 1199) {
        //         $toShow = 2;
        //     } else if ($wide < 769) {
        //         $toShow = 1;
        //     } else {
        //         $toShow = 3;
        //     }
        //     $no_of_columns = $(this).parents('.tabular_c').find('.tabul_main').find('.head').find('.tab_col').length;
        //     $rotations = Math.floor($no_of_columns / $toShow);
        //     $if_extra = $no_of_columns % $toShow;

        //     if ($rotations == 1 && $if_extra == 0) {
        //         alert('nothing to show')
        //     } else if ($rotations == 1 && $if_extra > 0) {
        //         $(this).removeClass('active');
        //         $widthoftab = $(this).parents('.tabular_c').find('.tabul_main').width();
        //         $widthofcon = $(this).parents('.tabular_c').width();
        //         $moveby = $widthoftab - $widthofcon;

        //         if (parseInt($(this).parents('.tabular_c').find('.tabul_main').css('left')) !== $moveby) {
        //             $(this).parents('.tabular_c').find('.tabul_main').css('left', '-' + $moveby + 'px');
        //             $(this).prev('.left').addClass('active');
        //         }
        //     }
        // });
        // $(document).on('click', '.tabular_c .left', function() {
        //     var $toShow;

        //     $wide = window.innerWidth ? window.innerWidth : $(window).width();
        //     if ($wide < 1199) {
        //         $toShow = 2;
        //     } else if ($wide < 769) {
        //         $toShow = 1;
        //     } else {
        //         $toShow = 3;
        //     }
        //     $no_of_columns = $(this).parents('.tabular_c').find('.tabul_main').find('.head').find('.tab_col').length;
        //     $rotations = Math.floor($no_of_columns / $toShow);
        //     $if_extra = $no_of_columns % $toShow;

        //     if ($rotations == 1 && $if_extra == 0) {
        //         alert('nothing to show')
        //     } else if ($rotations == 1 && $if_extra > 0) {
        //         $(this).removeClass('active');
        //         $widthoftab = $(this).parents('.tabular_c').find('.tabul_main').width();
        //         $widthofcon = $(this).parents('.tabular_c').width();
        //         $moveby = $widthoftab - $widthofcon;

        //         $(this).parents('.tabular_c').find('.tabul_main').css('left', 0);
        //         $(this).next('.right').addClass('active');
        //     }
        // });

        // responsive-table
        // var scroll = 100;
        // var scroll = $('.tabul_hold').width();
        // var speed = 0;
        //     $('.tabular_c .right').click(function() {
        //     $('.table-holder').animate({
        //         'scrollLeft': '+=' + scroll
        //     }, speed);
        // });
        // /responsive-table

        // responsive-table test2
        var scroll = $('.tabul_hold').width();
            var $item = $('div.tabul_hold'), //Cache your DOM selector
                visible = 2, //Set the number of items that will be visible
                index = 0, //Starting index
                endIndex = ( $item.length / visible ) - 1; //End index

            $('.tabular_c .right').click(function(){
                if(index < endIndex ){
                  index++;
                  $item.animate({'left':'-=' +scroll+ 'px'});
                }
            });

            $('.tabular_c .left').click(function(){
                if(index > 0){
                  index--;
                  $item.animate({'left':'+=' +scroll+ 'px'});
                }
            });
        // responsive-table test2

        function placesearchbar() {
            $wid = window.innerWidth ? window.innerWidth : $(window).width();
            if ($wid > 769) {
                $leftg = $('#menu_section').width();
                $seawid = $('.home_search').width();
                $actual_right = ($wid - $leftg - $seawid) / 2;
                $('.home_search').css('right', $actual_right);
            }
        }

        if ($('body').hasClass('home')) {
            $hevp = window.innerHeight ? window.innerHeight : $(window).height();
            $('.flexslider').height($hevp);
        }

        function resizeimgs(tw, obj) {
            var ar = obj.width() / obj.height();

            //console.log('AR: '+ar+'\n cont: ' + (tw.width() / tw.height()));
            if ( (tw.width() / tw.height()) < ar ) {
                obj
                    .removeClass()
                    .addClass('heightadjust');
            } else {
                obj.removeClass('heightadjust');
            }
        }

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
            if ($('body').hasClass('home')) {
                placesearchbar();
            }
            if ($('body').hasClass('single-residential-property')) {
                $('.owl-carousel .item img').each(function() {
                    resizeimgs($(this).parent(), $(this));
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
            if ($('body').hasClass('home')) {
                placesearchbar();
            }
            if ($('body').hasClass('home')) {
                $hevp = window.innerHeight ? window.innerHeight : $(window).height();
                $('.flexslider').height($hevp);
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
            jQuery.fn.myFunction();
        });

    });


    function setEqualHeight(obj) {
        obj.height('auto');
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

// table
jQuery.fn.myFunction = function testfun()
{
var vwidth;
var tcwidth=parseInt(jQuery('.table-cover').width());

if(parseInt(jQuery(window).width()) <= 1476 && parseInt(jQuery(window).width()) >= 1110)
    {
        vwidth = parseInt(jQuery('.table-cover').width())/3;
    }
    else if(parseInt(jQuery(window).width()) <= 1110 && parseInt(jQuery(window).width()) >= 768)
    {
        vwidth = parseInt(jQuery('.table-cover').width())/2;
    }

    else if(parseInt(jQuery(window).width()) <= 768 && parseInt(jQuery(window).width()) >= 560)
    {

        vwidth = parseInt(jQuery('.table-cover').width())/2;
    }
    else if(parseInt(jQuery(window).width()) <= 559)
    {

        vwidth = parseInt(jQuery('.table-cover').width());
    }
    jQuery('.tabul_hold').css('width', vwidth);
}

jQuery(window).resize(function() {
        jQuery.fn.myFunction();
    });
jQuery(window).load(function() {
        jQuery.fn.myFunction();
    });



