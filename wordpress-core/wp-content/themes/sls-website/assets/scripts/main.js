(function ($) {
    $(document).ready(function () {
        function renderImgToSvg() {
            $('.svg').each(function () {
                var $img = $(this);
                var imgURL = $img.attr('src');
                var attributes = $img.prop('attributes');

                $.get(
                    imgURL,
                    function (data) {
                        // Get the SVG tag, ignore the rest
                        var $svg = $(data).find('svg');

                        // Remove any invalid XML tags
                        $svg = $svg.removeAttr('xmlns:a');

                        // Loop through IMG attributes and apply on SVG
                        $.each(attributes, function () {
                            $svg.attr(this.name, this.value);
                        });

                        // Replace IMG with SVG
                        $img.replaceWith($svg);
                    },
                    'xml'
                );
            });
        }

        function toggleMobileNav() {
            var mobileNavBtn = $('.header__navigation__button');
            var mobileNav = $('.header__navigation');

            mobileNavBtn.on('click', function(e) {
                e.preventDefault();

                if (!mobileNavBtn.hasClass('active')) {
                    mobileNav.fadeIn(200);
                    mobileNavBtn.addClass('active');
                    $('body').addClass('hidden');
                } else {
                    mobileNav.fadeOut(200);
                    mobileNavBtn.removeClass('active');
                    $('body').removeClass('hidden');
                }
            });
        }

        var ourProductsSliderContainer = $("#our_products_slider");
        function handleOurProductsSlider() {
            var ourProductsSlider = ourProductsSliderContainer.slick({
                infinite: false,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: "unslick"
                    }
                ]
            });

            ourProductsSlider.on('init, afterChange', function(event, slick, currentSlide) {
                var slidesToShow = 1;

                if (currentSlide > 0) {
                    $('.slick-prev').addClass('show');
                } else {
                    $('.slick-prev').removeClass('show');
                }

                if (slick.slideCount === currentSlide + slidesToShow) {
                    $('.slick-next').hide();
                } else {
                    $('.slick-next').show();
                }
            });
        }

        if (ourProductsSliderContainer.length > 0) {
            handleOurProductsSlider();
        }

        var managementSliderContainer = $('#management_slider');
        function handleManagementSlider() {
            var managementSlider = managementSliderContainer.slick({
                infinite: false,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });

            managementSlider.on('init, afterChange', function(event, slick, currentSlide) {
                var slidesToShow = 3;
                var breakpoints = slick.breakpoints;

                if ($(window).width() <= breakpoints[0]) {
                    slidesToShow = 2;
                } else if ($(window).width() <= breakpoints[1]) {
                    slidesToShow = 1;
                }

                if (currentSlide > 0) {
                    $('.slick-prev').addClass('show');
                } else {
                    $('.slick-prev').removeClass('show');
                }

                if (slick.slideCount === currentSlide + slidesToShow) {
                    $('.slick-next').hide();
                } else {
                    $('.slick-next').show();
                }
            });
        }

        if (managementSliderContainer.length > 0) {
            handleManagementSlider();
        }

        $.fn.isInViewport = function() {
            var elementTop = $(this).offset().top + ($(window).height() / 10);
            var elementBottom = elementTop + $(this).outerHeight();

            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            return elementBottom > viewportTop && elementTop < viewportBottom;
        };

        var parallax = $('.parallax');
        function handleParallax() {
            var animationTime = 350;

            $(window).on('resize scroll load', function() {
                parallax.each(function() {
                    var currentParallax = $(this);

                    if (currentParallax.isInViewport()) {
                        if (!currentParallax.hasClass('animated')) {
                            currentParallax.addClass('animated');
                        }

                        var parallaxItem = currentParallax.children().find('.parallax__item');
                        var parallaxSingle = currentParallax.find('.parallax__single');

                        if (parallaxItem.length > 0 && parallaxItem.isInViewport()) {
                            parallaxItem.each(function(i) {
                                var currentParallaxItem = $(this);

                                var chainAnimation = setTimeout(function() {
                                    if (!currentParallaxItem.hasClass('animated')) {
                                        currentParallaxItem.addClass('animated');
                                    }

                                    clearTimeout(chainAnimation);
                                }, animationTime * i);
                            });
                        }

                        if (parallaxSingle.length > 0) {
                            parallaxSingle.each(function() {
                                var currentParallaxSingle = $(this);

                                if (currentParallaxSingle.isInViewport() && !currentParallaxSingle.hasClass('animated')) {
                                    currentParallaxSingle.addClass('animated');
                                }
                            });
                        }
                    }
                });
            });
        }

        if (parallax.length > 0) {
            handleParallax();
        }

        var articleGallery = $('.blocks-gallery-grid');
        function handleArticleGallerySlider() {
            var articleGallerySlider = articleGallery.slick({
                infinite: false,
                speed: 500,
                fade: true,
                cssEase: 'linear'
            });

            articleGallerySlider.on('init, afterChange', function(event, slick, currentSlide) {
                if (currentSlide > 0) {
                    $('.slick-prev').addClass('show');
                } else {
                    $('.slick-prev').removeClass('show');
                }

                if (slick.slideCount === currentSlide + 1) {
                    $('.slick-next').hide();
                } else {
                    $('.slick-next').show();
                }
            });
        }

        if (articleGallery.length > 0) {
            handleArticleGallerySlider();
        }

        function handleOnClickAnchor() {
            $('a').on('click', function(e) {
                var link = $(this);
                var linkHref = link.attr('href');

                if (linkHref.charAt(0) === '#') {
                    e.preventDefault();

                    $('html,body').animate({
                        scrollTop: $(linkHref).offset().top - 70
                    }, 'slow');
                }
            });
        }

        var startBtn = $('#streaming-systems__questions__start');
        var streamingSystemsQuestions = $('#streaming-systems__questions__slider');
        var maxSteps = 3;
        var currentStep = 0;
        var progress = $('.streaming-systems__questions__progress');
        var progressText = $('.streaming-systems__questions__progress__text');
        var progressBar = $('.streaming-systems__questions__progress__bar');
        var progressBarWidth = progressBar.outerWidth();
        function handleStreamingSystemsQuestions() {
            progressText.children('.counter__max').text(maxSteps);

            startBtn.on('click', function(e) {
                e.preventDefault();
                $(this).fadeOut();
                initSliderWithButtons();
            });
        }

        function initSliderWithButtons() {
            streamingSystemsQuestions.fadeIn();
            streamingSystemsQuestions.slick({
                infinite: false,
                speed: 500,
                initialSlide: 0,
                slidesToShow: 1,
                slidesToScroll: 1,
                mobileFirst: true
            });

            progress.fadeIn(50);

            var nextBtn = streamingSystemsQuestions.find('.slick-next');
            var prevBtn = streamingSystemsQuestions.find('.slick-prev');
            var progressBarStep = progressBarWidth / maxSteps;

            nextBtn.on('click', function() {
                if (currentStep < maxSteps) {
                    currentStep++;
                }

                progressText.children('.counter').text(currentStep);
                progressBar.children('.progress__bar').css('width', `${currentStep * progressBarStep}px`);

                if (currentStep === maxSteps) {
                    progress.fadeOut();
                    nextBtn.fadeOut();
                    prevBtn.fadeOut();
                    streamingSystemsQuestions.addClass('done');
                    $('.streaming-systems__questions__wrap').addClass('done');

                    var doneBtn = $('.streaming-systems__questions__done__btn');
                    doneBtn.on('click', function(e) {
                        e.preventDefault();

                        $('html,body').animate({
                            scrollTop: $('.streaming-systems__options__table__column.selected').offset().top - 58
                        }, 'slow');
                    });

                    handleSendStreamingSystemsOffer();
                }
            });

            prevBtn.on('click', function() {
                if (currentStep > 0 && currentStep <= maxSteps) {
                    currentStep--;
                }

                progressText.children('.counter').text(currentStep);
                progressBar.children('.progress__bar').css('width', `${currentStep * progressBarStep}px`);
            });
        }

        function handleSendStreamingSystemsOffer() {
            var selectedPackageNum = 2;
            var selectedPackage = $('#option_' + selectedPackageNum);
            selectedPackage.addClass('selected');

            var sendOfferBtn = $('.streaming-systems__options__table__btn .send-offer');
            sendOfferBtn.on('click', function(e) {
                e.preventDefault();

                selectedPackage.removeClass('selected').addClass('thank-you');
            });

            var thankyouBtn = $('.streaming-systems__options__table__btn .thank-you');
            thankyouBtn.on('click', function(e) {
                e.preventDefault();

                resetStreamingSystemsQuestions();
            });
        }

        function resetStreamingSystemsQuestions() {
            $('.streaming-systems__options__table__column').each(function () {
                $(this).removeClass('thank-you');
            });
            $('.streaming-systems__options__table__column').each(function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                if ($(this).hasClass('thank-you')) {
                    $(this).removeClass('thank-you');
                }
            });

            if (streamingSystemsQuestions.hasClass('slick-initialized')) {
                currentStep = 0;
                progressText.children('.counter').text(currentStep);
                progressBar.children('.progress__bar').css('width', '0px');
                progress.fadeIn();
                $('.slick-arrow').each(function (){
                    $(this).fadeIn();
                });
                streamingSystemsQuestions.removeClass('done').slick('slickGoTo', 0);
                $('.streaming-systems__questions__wrap').removeClass('done');
            }
        }

        function handleManualStreamingSystemsSelect() {
            var selectBtn = $('.streaming-systems__options__table__btn button');
            var options = $('.streaming-systems__options__table__column');
            selectBtn.on('click', function(e) {
                e.preventDefault();

                options.each(function() {
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    }
                });

                $(this).parents('.streaming-systems__options__table__column').addClass('selected');
            });

            var resetBtn = $('.streaming-systems__options__table__head .reset');
            resetBtn.on('click', function(e) {
                e.preventDefault();
                resetStreamingSystemsQuestions();
            });
        }

        if (streamingSystemsQuestions.length > 0) {
            handleStreamingSystemsQuestions();
            handleManualStreamingSystemsSelect();
        }

        renderImgToSvg();
        toggleMobileNav();
        handleOnClickAnchor();
    });
})(jQuery);
