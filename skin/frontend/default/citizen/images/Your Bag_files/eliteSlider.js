$(document).ready(function () {
    countSlides = $('.eliteSlider .slides li').length;

    if (countSlides > 4) {

        $('.eliteSlider .slides').width(countSlides * 210 + 'px');

        $('.eliteSlider .controller .right').click(function () {
            $('.eliteSlider .slides').animate({ left: '-840px' }, 1500, function () {
                for (var i = 0; i < 4; i++) {
                    $('.eliteSlider .slides li:first').detach().insertAfter('.eliteSlider .slides li:last');
                    $('.eliteSlider .slides').css('left', '0px');
                }
            });
            $('.eliteSlider .text').animate({ left: '-840px' }, 1500, function () {
                $('.eliteSlider .text').css('left', '0px');
                $('.eliteSlider .text li:first').detach().insertAfter('.eliteSlider .text li:last');
            });
        });

        $('.eliteSlider .controller .left').click(function () {
            for (var i = 0; i < 4; i++) {
                $('.eliteSlider .slides li:last').detach().insertBefore('.eliteSlider .slides li:first');
            }
            $('.eliteSlider .slides, .eliteSlider .text').css('left', '-840px');
            $('.eliteSlider .slides, .eliteSlider .text').animate({ left: '0px' }, 1500);
            $('.eliteSlider .text li:last').detach().insertBefore('.eliteSlider .text li:first');
        });

    } else {
        $('.eliteSlider .controller').hide();
    }
});