(function ($) {
    "use strict";
    $.fn.iwCarousel = function () {
        $(this).each(function () {
            var iwCarouselObj = this,
                    $iwCarouselE = $(this),
                    clients = $iwCarouselE.find('.iw-testimonial-client-item');
            $iwCarouselE.find('.testi-owl-maincontent').owlCarousel({
                slideSpeed: 500,
                autoPlay: true,
                paginationSpeed: 400,
                singleItem: true,
				direction: $('body').hasClass('rtl') ? 'rtl' : 'ltr',
                navigation: false,
                pagination: false,
                navigationText: ["<i class=\"ion-arrow-left-c\"></i>", "<i class=\"ion-arrow-right-c\"></i>"],
                afterMove: function () {
                    var carContent = $iwCarouselE.find('.testi-owl-maincontent').data('owlCarousel');
                    iwCarouselObj.slideItem(carContent.currentItem);
                }
            });

            $iwCarouselE.find('.iw-testimonial-client-item').click(function () {
                var index = $(this).data('item-active'),
                        carContent = $iwCarouselE.find('.testi-owl-maincontent').data('owlCarousel');
                carContent.goTo(index);
                iwCarouselObj.slideItem(carContent.currentItem);

            });

            this.slideItem = function (index) {
                clients.each(function () {
                    if ($(this).data('item-active') == index) {
                        $(this).addClass('active');
                    } else {
                        $(this).removeClass('active');
                    }
                });
            };

        });

    };

    $(document).ready(function($){

        $('.slick-slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            speed: 200,
            arrows: false,
            fade: true,
            centerMode: true,
            rtl: $('body').hasClass('rtl') ? true : false,
            asNavFor: '.slick-slider-nav'
        });
        $('.slick-slider-nav').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            speed: 200,
            asNavFor: '.slick-slider-for',
            dots: false,
            arrows:false,
            rtl: $('body').hasClass('rtl') ? true : false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        centerPadding: '0'
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        centerPadding: '0'
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        centerPadding: '0',
                        variableWidth: false
                    }
                },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        centerPadding: '0',
                        variableWidth: false
                    }
                }
            ]
        });

    });

})(jQuery);

