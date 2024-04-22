jQuery(document).ready(function () {
    "use strict";

    $('.allproduct-slider').owlCarousel({
        loop: false,
        dots: false,
        autoplay: true,
        nav: false,
        margin: 10,
        items: 6,
        smartSpeed: 1000,
        autoplayTimeout: 3000,
        responsiveClass: true,
        responsive: {
             0: {
                items: 2,
                nav: false
            },
            500: {
                items: 2,
                nav: false
            },
            768: {
                items: 2,
                nav: false
            },
            991: {
                items: 3,
                loop: true,
                nav: false
            },
            1192: {
                items: 6,
                loop: true,
                nav: false
            }
        }
    });

    $('.brand-slider').owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        nav: false,
        margin: 10,
        items: 1,
        smartSpeed: 1000,
        autoplayTimeout: 4000,
        mouseDrag: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            500: {
                items: 3,
                nav: false
            },
            768: {
                items: 4,
                nav: false
            },
            991: {
                items: 5,
                nav: false,
                loop: true,
            },
            1192: {
                items: 6,
                nav: false,
                loop: true,
            }
        }
    });
    $('.related-slider').owlCarousel({
        loop: false,
        dots: false,
        autoplay: false,
        nav: true,
        margin: 10,
        items: 4,
        smartSpeed: 2500,
        autoplayTimeout: 4000,
        mouseDrag: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            500: {
                items: 2,
                nav: false
            },
            768: {
                items: 4,
                nav: false
            },
            991: {
                items: 4,
                nav: false,
                loop: true,
            },
            1192: {
                items: 5,
                nav: false,
                loop: true,
            }
        }
    });
    //    offer product slider end
    $('.brandslider').owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        nav: false,
        margin: 10,
        items: 1,
        smartSpeed: 3000,
        autoplayTimeout: 5000,
        mouseDrag: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            500: {
                items: 3,
                nav: false
            },
            768: {
                items: 4,
                nav: false
            },
            991: {
                items: 4,
                nav: false,
                loop: true,
            },
            1192: {
                items: 6,
                nav: false,
                loop: true,
            }
        }
    });
    //    newarrival product slider end
     $('#testimonialslider').owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        autoplay: true,
        nav: false,
        autoplayHoverPause: false,
        margin: 0,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        mouseDrag: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    });

    $('.blogslider').owlCarousel({
        loop: true,
        dots: false,
        autoplay: false,
        nav: true,
        margin: 10,
        items: 2,
        smartSpeed: 1000,
        autoplayTimeout: 1000,
        mouseDrag: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            500: {
                items: 2,
                nav: true
            },
            768: {
                items: 4,
                nav: true
            },
            991: {
                items: 4,
                nav: true,
                loop: true,
            },
            1192: {
                items: 4,
                nav: true,
                loop: true,
            }
        }
    });
    //    newarrival product slider end
    
    $('.productslider').owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        nav: false,
        margin: 10,
        items: 1,
        smartSpeed: 1000,
        autoplayTimeout: 3000,
        mouseDrag: true,
    });
    //    main slider end
    $('#slider').owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        autoplay: true,
        nav: true,
        autoplayHoverPause: false,
        margin: 0,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        mouseDrag: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    });

    var owl = $('#slider');
    owl.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 500,

    });
    owl.on('changed.owl.carousel', function (event) {
        var item = event.item.index - 2; // Position of the current item
        $('h2').removeClass('animated slideInLeft');
        $('p').removeClass('animated zoomIn');
        $('a').removeClass('animated zoomIn');
        $('.owl-item').not('.cloned').eq(item).find('h2').addClass('animated slideInLeft');
        $('.owl-item').not('.cloned').eq(item).find('p').addClass('animated zoomIn');
        $('.owl-item').not('.cloned').eq(item).find('a').addClass('animated zoomIn');
    });
    //    MAIN SLIDER END

    
    $("#sticker").sticky({
        topSpacing: 0
    });
    /*========sticker end========*/
    $.scrollUp({
        animation: 'slide', // Fade, slide, none
    });
    /*======scroll up======*/
    (function ($) {
        var $main_nav = $('#main-nav');
        var $toggle = $('.toggle');

        var defaultData = {
            maxWidth: false,
            customToggle: $toggle,
            navTitle: 'Category',
            levelTitles: true,
            pushContent: '#container'
        };

        // add new items to original nav
        $main_nav.find('li.add').children('a').on('click', function () {
            var $this = $(this);
            var $li = $this.parent();
            var items = eval('(' + $this.attr('data-add') + ')');

            $li.before('<li class="new"><a>' + items[0] + '</a></li>');

            items.shift();

            if (!items.length) {
                $li.remove();
            } else {
                $this.attr('data-add', JSON.stringify(items));
            }

            Nav.update(true);
        });

        // call our plugin
        var Nav = $main_nav.hcOffcanvasNav(defaultData);

        // demo settings update

        const update = (settings) => {
            if (Nav.isOpen()) {
                Nav.on('close.once', function () {
                    Nav.update(settings);
                    Nav.open();
                });

                Nav.close();
            } else {
                Nav.update(settings);
            }
        };

        $('.actions').find('a').on('click', function (e) {
            e.preventDefault();

            var $this = $(this).addClass('active');
            var $siblings = $this.parent().siblings().children('a').removeClass('active');
            var settings = eval('(' + $this.data('demo') + ')');

            update(settings);
        });

        $('.actions').find('input').on('change', function () {
            var $this = $(this);
            var settings = eval('(' + $this.data('demo') + ')');

            if ($this.is(':checked')) {
                update(settings);
            } else {
                var removeData = {};
                $.each(settings, function (index, value) {
                    removeData[index] = false;
                });

                update(removeData);
            }
        });
    })(jQuery);
    /*========scrollUp end========*/
    $("img").lazyload({
          effect : "fadeIn"
      });
    
      
});


