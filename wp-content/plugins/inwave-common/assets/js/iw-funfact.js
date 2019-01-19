jQuery(document).ready(function($) {
    $('.inwave-funfact').waypoint(function() {
        var default_settings =  {
            from: 0,
            to: 0,
            speed: 2500,
            refreshInterval: 50,
            formatter: function(value, settings){
                if(settings.add_comma){
                    return value.toFixed(settings.decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
                else{
                    return value.toFixed(settings.decimals);
                }
            }
        };

        var settings = $(this).data('settings');
        settings = $.extend({}, default_settings, settings);
        $(".funfact-number", this).countTo(settings);
    },{
        triggerOnce: true,
        offset: '90%'
    });
});