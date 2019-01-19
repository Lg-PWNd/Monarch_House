jQuery(document).ready(function($) {
    $('.inwave-countdown').each(function () {
        var countdown = $(this).data('countdown');
        var date_number = $(this).data('date-number');
        $(this).countdown(countdown, function(event){
            var inwave_day = event.strftime('%-D');
            var inwave_hour = event.strftime('%-H');
            var inwave_minute = event.strftime('%-M');
            var inwave_second = event.strftime('%-S');

            $(this).find('.day').html(inwave_day);
            $(this).find('.hour').html(inwave_hour);
            $(this).find('.minute').html(inwave_minute);
            $(this).find('.second').html(inwave_second);
            var w_line = (((date_number - inwave_day) / date_number ) * 100);
            $('.price-line .line').css("width", w_line+"%");
            if (w_line >= 48) {
                var price_center = $('.price-countdown .price.price-center');
                price_center.addClass('active');
            }
            if (w_line >= 98) {
                var price_end = $('.price-countdown .price.price-end');
                price_end.addClass('active');
            }
        })
    });
});