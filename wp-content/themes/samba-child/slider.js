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

        $(window).load(function() {
            if ($('div').hasClass('frm_submit')) {
                // var timerset;
                // $('.frm_style_formidable-style.with_frm_style .frm_submit input[type=submit]').click(function() {
                //     var timecount = 0;
                //     timerset = setInterval(function() {
                //         timecount += 1;
                //         if (timecount > 10) {
                //             clearInterval(timerset);
                //             console.log('run again');
                //         } else {
                //             loadingcontinforms();
                //             console.log('contentloaded');
                //         }
                //     }, 1000);
                // });
            }

            $(document).on('click', '.elips-cont', function() {
                $(this).next('select').trigger('click');
            });

            if ($('div').hasClass('job_type')) {
                $('.job_type a').each(function() {
                    $countdet = $(this).attr('href');
                    $count = $('.car_' + $countdet.slice(1)).find('.job_listings li').length;
                    if ($count > 1) {
                        $(this).text($count + ' positions');
                    } else if ($count == 1) {
                        $(this).text($count + ' position');
                    } else {
                        $(this).text('-');
                    }
                });
            }
        });

        //careers stuff
        if ($('div').hasClass('job_type')) {
            setTimeout(function() {
                $('.job_type a').each(function() {
                    $countdet = $(this).attr('href');
                    if ($('.car_' + $countdet.slice(1)).find('.job_listings li').text().trim().toLowerCase() !== 'there are no listings matching your search.') {
                        $count = $('.car_' + $countdet.slice(1)).find('.job_listings li').length;
                        if ($count > 1) {
                            $(this).text($count + ' positions');
                        } else if ($count == 1) {
                            $(this).text($count + ' position');
                        }
                    } else {
                        $(this).text('-');
                    }
                });
            }, 10000);

            $('.job_type').click(function() {
                $('html, body').animate({scrollTop: jQuery('.careers-scroll-down').offset().top}, 600);
                $('.car_togglethis').addClass('hidden');
                $locationdet = $(this).find('.wpb_text_column a').attr('href');
                $('.car_' + $locationdet.slice(1)).removeClass('hidden');
            });
        }
        //end careers stuff

        function popupmake_scrollbarhide() {
            $('.popmake').on('popmakeBeforeOpen', function () {
              $('html, body').css('overflow', 'hidden');
              $('html').css('height', $(window).height());
            });
            $('.popmake').on('popmakeAfterClose', function () {
              $('html, body').css('overflow', 'visible');
              $('html').css('height', 'auto');
            });
        }
        popupmake_scrollbarhide();

        // $("#home_location").dropkick({
        //     mobile: true
        // });

        //add more space above location
        $('.vc_custom_heading').each(function () {
            if ($(this).text().trim().toLowerCase() == 'location') {
                $(this).prev('.vc_empty_space').height(35);
                $(this).css('margin-bottom', 35);
            }
        });
        $('.tab-section').each(function () {
            if ($(this).text().trim().toLowerCase() == 'residences') {
                if ($(this).next().hasClass('vc_empty_space')) {
                    $(this).next('.vc_empty_space').hide();
                }
            }
        });

        $(window).scroll(function() {
            //fix for the menu bar height in mobiles
            $wid = window.innerWidth ? window.innerWidth : $(window).width();
            $hei = window.innerHeight ? window.innerHeight : $(window).height();
            if ($wid <= 768) {
                $('#menu_section').height($hei);
            }
        });

        //Adding go to top btns in single property page
        $(window).load(function() {
            if ($('div').hasClass('sticky')) {
                $(window).on('scroll', function() {
                    $stopperheight = $(document).height() - ($(window).height() * 2);
                    if ($(window).scrollTop() > ($(window).height() / 2) && $(window).scrollTop() < $stopperheight) {
                        $('.sticky.go_to_top_inpage').addClass('visigoth');
                        $('.sticky.enquiry_sideways').addClass('visigoth');
                    } else {
                        $('.sticky.go_to_top_inpage').removeClass('visigoth');
                        $('.sticky.enquiry_sideways').removeClass('visigoth');
                    }
                });
            }
            // if ($('div').hasClass('project-list')) {
            //     if ($('div').hasClass('single_p_w')) {
            //         $('.project-list.row .single_p_w').each(function() {
            //             $theval = ($(window).scrollTop() + $(window).height()) + 20;
            //             if ($(window).scrollTop() < ($(this).offset().top + 50) && $(this).offset().top < $theval) {
            //                 $(this).addClass('visigoth');
            //             } else {
            //                 $(this).removeClass('visigoth');
            //             }
            //         });
            //     }
            // }
            $(window).on('scroll', function() {
                if ($('div').hasClass('project-list')) {
                    if ($('div').hasClass('single_p_w')) {
                        $('.project-list.row .single_p_w').each(function() {
                            $theval = ($(window).scrollTop() + $(window).height()) + 20;
                            if ($(window).scrollTop() < ($(this).offset().top + 50) && $(this).offset().top < $theval) {
                                $(this).addClass('visigoth');
                            } else if ($(this).offset().top > $theval) {
                                $(this).removeClass('visigoth');
                            } else {
                                //$(this).removeClass('visigoth');
                            }
                        });
                    }
                }
                // if ($('div').hasClass('indi_prj_page')) {
                    if ($('div').hasClass('wpb_animate_when_almost_visible')) {
                        $('.wpb_animate_when_almost_visible').each(function() {
                            $theval = ($(window).scrollTop() + $(window).height()) + 20;
                            if ($(window).scrollTop() < ($(this).offset().top + 50) && $(this).offset().top < $theval) {
                                $(this).addClass('wpb_start_animation');
                            } else if ($(this).offset().top > $theval) {
                                $(this).removeClass('wpb_start_animation');
                            } else {
                                //$(this).removeClass('visigoth');
                            }
                        });
                    }
                // }
                if ($('div').hasClass('list_forent')) {
                    $('.list_forent, .partintro').each(function() {
                        $theval = ($(window).scrollTop() + $(window).height()) + 20;
                        if ($(window).scrollTop() < ($(this).offset().top + 50) && $(this).offset().top < $theval) {
                            $(this).addClass('fade-in');
                        } else if ($(this).offset().top > $theval) {
                            $(this).removeClass('fade-in');
                        } else {
                                //$(this).removeClass('visigoth');
                            }
                        });
                }
            });
        });

        //sliding menu code
        // Hide Header on on scroll down
        var didScroll;
        var lastScrollTop = 0;
        var delta = 5;
        var navbarHeight = $('#prk_responsive_menu').outerHeight();

        $(window).scroll(function(event){
            didScroll = true;
        });

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        function hasScrolled() {
            var st = $(this).scrollTop();

            // Make sure they scroll more than delta
            if(Math.abs(lastScrollTop - st) <= delta)
                return;

            // If they scrolled down and are past the navbar, add class .nav-up.
            // This is necessary so you never see what is "behind" the navbar.
            if (st > lastScrollTop && st > navbarHeight){
                // Scroll Down
                $('#prk_responsive_menu').removeClass('nav-down').addClass('nav-up');
            } else {
                // Scroll Up
                if(st + $(window).height() < $(document).height()) {
                    $('#prk_responsive_menu').removeClass('nav-up').addClass('nav-down');
                }
            }

            lastScrollTop = st;
        }


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

        $(document).on('click', '.home_search', function() {
            $width = window.innerWidth ? window.innerWidth : $(window).width();
            if (!($(this).hasClass('popup')) && $width < 768) {
                $('.home_search.popup').show();
            }
        });
        $(document).on('click', '.proj-showinmob .filter-btn', function() {
            $width = window.innerWidth ? window.innerWidth : $(window).width();
            // if (!($(this).hasClass('popup')) && $width < 768) {
                $('.home_search.popup').show();
            // }
        });
        $(document).on('click, touchstart', '.home_search.popup .searc_head i', function(e) {
            e.preventDefault();
            $(this).parents('.popup').hide();
        });

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
            if ($('div').hasClass('home_search')) {
                $width = window.innerWidth ? window.innerWidth : $(window).width();
                if ($width > 769) {
                    $('.home_search.popup').hide();
                }
            }
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
                $seawid = $('.adjustcenter').width();
                $actual_right = ($wid - $leftg - $seawid) / 2;
                $('.adjustcenter').css('right', $actual_right);
            } else {
                $seawid = $('.adjustcenter').width();
                $actual_right = ($wid - $seawid) / 2;
                $('.adjustcenter').css('right', $actual_right);
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
            if ($('body').hasClass('home')) {
                $hevp = window.innerHeight ? window.innerHeight : $(window).height();
                $('.flexslider li').css('height', $hevp);
                resizeimgs($(window), $('.flexslider li img'));
            }
            if ($('body').hasClass('single-residential-property') || $('body').hasClass('single-commercial-property')) {
                $hevp = window.innerHeight ? window.innerHeight : $(window).height();
                resizeimgs($('.full_fi_c'), $('.full_fi_c img'));
            }

            if ($('body').hasClass('page-template-page-services')) {
                $topval = $('#spn_services_div').offset().top - $('.go_to_top_inpage').height() + 25;
                $('body').append('<div class="go_to_top_inpage serm"></div>');
                $('.go_to_top_inpage.serm').css('top', $topval);

                $('.enquiry_sideways').css('top', ($topval - 125));
            }

            $(document).on('click', '.go_to_top_inpage', function() {
                $('html, body').animate({scrollTop:0}, 'slow', 'swing');
            });
            if ($('body').hasClass('home')) {
                placesearchbar();
            }
            if ($('div').hasClass('owl-carousel') && $('div').hasClass('wpb_tab')) {
                setInterval(function() {
                    $('.wpb_tab .owl-carousel .item img').each(function() {
                        resizeimgs($(this).parent(), $(this));
                        // $(this).addClass('widthadjust');
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
            popupmake_scrollbarhide();

            if ($('body').hasClass('home')) {
                $hevp = window.innerHeight ? window.innerHeight : $(window).height();
                resizeimgs($(window), $('.flexslider li img'));
                $('.flexslider li').css('height', $hevp);
            }
            if ($('body').hasClass('single-residential-property') || $('body').hasClass('single-commercial-property')) {
                $hevp = window.innerHeight ? window.innerHeight : $(window).height();
                resizeimgs($('.full_fi_c'), $('.full_fi_c img'));
            }

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
            //--------------------------------------------------------------------------
            //-------don't remove this set of comments - required for testimonials popup
            // $('.owl-wrapper').magnificPopup({
            //     delegate: 'a',
            //     type: 'iframe',
            //     mainClass: 'mfp-fade'
            // });
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
        $wid = window.innerWidth ? window.innerWidth : $(window).width();
        if (!($('.indi_prj_page').hasClass('floorplans'))) {
            if ($wid < 769)
                $('#prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block').css('marginTop', ($hevp - 10));
            else
                $('#prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block').css('marginTop', $hevp);
        }

        $('#full_fi_c').css('height', $hevp);
        //$('#centered_block').css('minHeight', $hevp);
        $(window).resize(function() {
            $hevp = window.innerHeight ? window.innerHeight : $(window).height();
            $wid = window.innerWidth ? window.innerWidth : $(window).width();
            if (!($('.indi_prj_page').hasClass('floorplans'))) {
                if ($wid < 769)
                    $('#prk_ajax_container .indi_prj_page.columns.centered.prk_inner_block').css('marginTop', ($hevp - 10));
                else
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

        //set the height of map
        if ($wid < 769)
            $('.indi_map_area iframe').height(350);
        else
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

        //404
        if ($('body').hasClass('error404')) {
            $hevp = window.innerHeight ? window.innerHeight : $(window).height();
            $('#prk_ajax_container').css('min-height', $hevp - 43);
        }

        //set min-height for project listings
        if($('div').hasClass('proj_list')) {
            console.log('has map');
            $('#projects_listings').css({
                'minHeight': $(window).height() - $('#projects_listings').position().top - 43,
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


        // //top value for left sidebar content in home page
        // $topval_home = $(window).height() - $('#after_widgets').offset().top - $('#after_widgets').height() - 43 - 47;
        // $('#after_widgets').css('top', $topval_home);

        $('.child-footer').hide();

    });


    //jQuery Readmore for services
    function readmoreorless() {
        $width = window.innerWidth ? window.innerWidth : $(window).width();
        if ($width < 768 && $('div').hasClass('view_properties_rent')) {
            $('.view_properties_rent .wpb_call_desc, .view_properties_resale .wpb_call_desc').readmore({
                collapsedHeight: 73,
                heightMargin: 22,
                moreLink: '<a href="#">More</a>',
                lessLink: '<a href="#">Less</a>'
            });
        } else {
            $('.view_properties_rent .wpb_call_desc, .view_properties_resale .wpb_call_desc').readmore('destroy');
        }
    }


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


        readmoreorless();

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

        readmoreorless();


        //set the height of map
        if ($wid < 769)
            $('.indi_map_area iframe').height(350);
        else
            $('.indi_map_area iframe').height($('.indi_map_area').find('.vc_col-sm-6').eq(1).height());

        //map view - set height to fill the remaining space
        if ($('div').hasClass('gm-style')) {
            $('#projects_listings').height($(window).height() - $('#projects_listings').position().top - 43);
        }

        if ($('body').hasClass('error404')) {
            $hevp = window.innerHeight ? window.innerHeight : $(window).height();
            $('#prk_ajax_container').css('min-height', $hevp - 43);
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




/* =======================================================
 * =======================================================
 * ======== FORMIDABLE - ON FORM SUBMIT RUN THIS =========
 * =======================================================
 * ======================================================= */

function frmThemeOverride_frmAfterSubmit(e,f,b,a) {
    console.log('formidable form details:');
    console.log('a: ' + a);
    console.log('f: ' + f);
    console.log('e: ' + e);
    var formid = jQuery(a).find('input[name="form_id"]').val();
    console.log('id ' + formid);
    //if(typeof(formid) == 'number'){
        console.log('form ' + formid + ' has been submitted');
        afterformidablesubmit();
    //}
}
function afterformidablesubmit() {
    loadingcontinforms();
}

function loadingcontinforms() {
    var countries = ["Your Country","Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas"
    ,"Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands"
    ,"Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica"
    ,"Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea"
    ,"Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana"
    ,"Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India"
    ,"Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia"
    ,"Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania"
    ,"Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia"
    ,"New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal"
    ,"Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles"
    ,"Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","St. Lucia","Sudan"
    ,"Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia"
    ,"Turkey","Turkmenistan","Turks &amp; Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","United States Minor Outlying Islands","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
    var htmlcount = '';
    for (var i = 0; i < countries.length; i++) {
        htmlcount += '<option value="'+ countries[i] +'">'+ countries[i] +'</option>';
    }
    if (jQuery('div').hasClass('hascountry-list')) {
        jQuery('.hascountry-list').find('select').each(function() {
            jQuery(this).html(htmlcount)
        });
    }
            //trying out custom dropdowns
            // jQuery("#dd_locality").chosen({disable_search_threshold: 450});
            // jQuery("#dd_locality").change(function() {
            //     jQuery("#dd_locality").trigger('chosen:updated');
            // });
            //dropdown elipsis
            setTimeout(function() {
                jQuery('select').each(function() {
                    if (!(jQuery(this).prev('div').hasClass('elips-cont'))) {
                        jQuery(this).before('<div class="elips-cont"></div>');
                    }
                });

                jQuery('.elips-cont').each(function() {
                    jQuery(this).text(jQuery(this).next('select').find('option:selected').text());
                });
                jQuery('select').each(function() {
                    jQuery(this).change(function() {
                    //jQuery(this).prev('.elips-cont').text(jQuery("option:selected", this).text());
                    var cont = jQuery('.elips-cont').parent('div');

                    setTimeout(function() {
                        jQuery('.elips-cont').each(function() {
                            var par = jQuery(this).parent('div');
                            jQuery(this).text(par.find('select').find('option:selected').text());
                        });
                    }, 0.7);

                });
                });
            }, 0.1);

    var stuff = setInterval(function() {
        if (jQuery('.frm_message').is(':visible')) {
            setTimeout(function(){jQuery('.frm_message').hide('slow')}, 5000);
            clearInterval(stuff);
        } else {
        }
    }, 0.3);
}
jQuery(document).ready(function() {
    loadingcontinforms();
    jQuery(document).on('click', '.back_btn', function() {
        setTimeout(function() {
            loadingcontinforms();
        }, 50);
    });
});
