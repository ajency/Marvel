(function($) {


/*Dynamic menu created using content head on single property page*/
$(".tab-section").each(function(index) {

    $(this).attr('tab-index', index);

    var menutext = $(this).find( ":header" ).html();
    $('#residentialpropertymenu').append('<li class="menu-item"><a class="fade_anchor_menu tab-menu-item" data-target="'+index+'"><div class="prk_menu_square" style="width: 14px; background-color: rgb(183, 183, 183);"></div>'+menutext+'</a></li>');


    /*var distance = $(this).offset().top,
    $window = $(window);
    $window.scroll(function() {
        if ( $window.scrollTop() >= distance ) {
            $("a[data-target='" + index +"']").addClass('current').parent().siblings().children().removeClass('current');
        }
    });*/

});

$(document).on('click', '.tab-menu-item', function(event) {
    event.preventDefault()
    var anchor = $(this).attr('data-target');

    $(this).addClass('current').parent().siblings().children().removeClass('current');
    $('html,body').animate({
        scrollTop: $("div[tab-index='" + anchor +"']").offset().top - 30},
        'slow');
});



function checkIfInView(element){
    var offset = $(element).offset().top - $(window).scrollTop();
    if(offset > window.innerHeight){
       $('html,body').animate({scrollTop: offset}, 1000);
        return false;
    }
   return true;
}


    //all child js
    $(document).ready(function() {
        $fullwidth = window.innerWidth ? window.innerWidth : $(window).width();
        $(window).resize(function() {
            $fullwidth = window.innerWidth ? window.innerWidth : $(window).width();
        });
        $(document).on('click', '.promise_btns .prk_service .service_lnk a', function(e) {
            e.preventDefault();
            //console.log($fullwidth);
            if ($fullwidth > 769)
                $('html, body').animate({scrollTop: ($($(this).attr('href')).offset().top - 50)}, 1200);
            else
                $('html, body').animate({scrollTop: ($($(this).attr('href')).offset().top - 100)}, 1200);
        });

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

        //location collapse

        //go down btn - centering
        function setleft() {
            $width = window.innerWidth ? window.innerWidth : $(window).width();
            if ($width > 769) {
                $lw = $('#menu_section').width();
                $aw = $width - $lw;
                $lv = (($aw - $('.go_d_see').width()) / 2 ) + $lw - 9;
            } else {
                $lv = (($width - $('.go_d_see').width()) / 2 );
            }
            $('.go_d_see').css('left', $lv);
        }
        setleft();
        $(window).resize(function() {
            setleft();
        });

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
                // $('#prk_ajax_container').append(
                //     '<div class="go_to_top_inpage"></div>'
                // );
                // $btmval = $('.floorplans_tab').offset().top + $('.floorplans_tab').height() - $('.go_to_top_inpage').height();
                // $('.go_to_top_inpage').css({
                //     'top': $btmval,
                //     'right': 0
                // });
                $(document).on('click', '.go_to_top_inpage', function() {
                    $('html, body').animate({scrollTop:0}, '500', 'swing');
                });
            }
            if ($('body').hasClass('home')) {
                placesearchbar();
            }
            if ($('div').hasClass('owl-carousel') && $('div').hasClass('wpb_tab')) {
                setInterval(function() {
                    $('.wpb_tab .owl-carousel .item img').each(function() {
                        resizeimgs($(this).parent(), $(this));
                    });
                }, 0.5);
            }

            if ($('div').hasClass('nothis') && !($('body').hasClass('single-residential-property')) && !($('body').hasClass('single-commercial-property'))) {
                $('.nothis .owl-carousel .item img').each(function() {
                    resizeimgs($(this).parent(), $(this));
                });
            } else if (($('body').hasClass('single-residential-property')) || ($('body').hasClass('single-commercial-property'))) {
                console.log($('body').hasClass('single-residential-property'));
                $('.owl-carousel .item img').each(function() {
                    resizeimgs($(this).parent(), $(this));
                });
            }
        });
        $(window).resize(function() {
            if ($('div').hasClass('nothis')) {
                $('.nothis .owl-carousel .item img').each(function() {
                    resizeimgs($(this).parent(), $(this));
                });
            }
            if (($('body').hasClass('single-residential-property')) || ($('body').hasClass('single-commercial-property'))) {
                $('.owl-carousel .item img').each(function() {
                    resizeimgs($(this).parent(), $(this));
                });
            }
            // if ($('body').hasClass('page-template-floor_plans')) {
            //     $btmval = $('.floorplans_tab').offset().top + $('.floorplans_tab').height() - $('.go_to_top_inpage').height();
            //     $('.go_to_top_inpage').css({
            //         'top': $btmval,
            //         'right': 0
            //     });
            // }
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
        if ($('div').hasClass('owl-carousel') && !($('div').hasClass('nothis'))) {
            $('.owl-carousel .owl-item .item a').each(function() {
                $(this).attr('href', $(this).find('img').attr('src'));
            });
            $('.owl-carousel .owl-item .item a').addClass('poppup'); //was image-popup-no-margins
            $('.owl-carousel .owl-controls .owl-buttons .owl-prev').html('<i class="fa fa-chevron-left"></i>');
            $('.owl-carousel .owl-controls .owl-buttons .owl-next').html('<i class="fa fa-chevron-right"></i>');
        }
        if ($('div').hasClass('nothis')) {
            $('.owl-carousel .owl-item .item a').addClass('poppup2'); //was image-popup-no-margins
            $('.owl-carousel .owl-controls .owl-buttons .owl-prev').html('<i class="fa fa-chevron-left"></i>');
            $('.owl-carousel .owl-controls .owl-buttons .owl-next').html('<i class="fa fa-chevron-right"></i>');
            $('.owl-wrapper').magnificPopup({
                delegate: 'a',
                type: 'iframe',
                mainClass: 'mfp-fade'
            });
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
            if ($('body').hasClass('single-residential-property') || $('body').hasClass('single-commercial-property')) {
                resizeimgs($('#full_fi_c'), $('#full_fi_c').find('img'));
            }
        });
        $(window).load(function() {
            if ($('body').hasClass('single-residential-property') || $('body').hasClass('single-commercial-property')) {
                resizeimgs($('#full_fi_c'), $('#full_fi_c').find('img'));
            }
        });

        //scroll down indi prj page
        $('.go_d_see').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: $hevp}, 1200, 'easeInQuad');
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

        if (!($('div').hasClass('nothis'))) {

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

        }

        //set min-height for project listings
        if($('div').hasClass('proj_list')) {
            console.log('has map');
            $('#projects_listings').css({
                'minHeight': $(window).height() - $('#projects_listings').position().top - 70,
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
        $width = window.innerWidth ? window.innerWidth : $(window).width();
        if ($width > 769) {
            obj.height('auto');
            var serhe = obj.map(function() {
                return $(this).height();
            }).get();
            var maxse = Math.max.apply(null, serhe);
            obj.height(maxse);
        } else {
            obj.height('auto');
        }
    }

    $(window).load(function() {
        $('.child-footer').fadeIn('slow');

        //equal height amenities
        setEqualHeight($('.le_p_m .wpb_wrapper .prk_service'));

        //equal height specifications
        setEqualHeight($('.se_o_6 .wpb_wrapper .prk_service'));

        //same height downloads
        setEqualHeight($('.do_3 .wpb_wrapper'));

        //same height careers
        setEqualHeight($('.lisofwork .wpb_wrapper'));

    });
    $(window).resize(function() {
        //equal height amenities
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



