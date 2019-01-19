jQuery( function ( $ ) {
	'use strict';
	$(document).ready(function () {
        $.datetimepicker.setLocale(iwjmbDateTime.locale_short);
        $('.iwjmb-datetime, .iwjmb-date, .iwjmb-time').each(function () {
			var options = $(this).data('options');
			$(this).datetimepicker(options);
		});
	})
} );
