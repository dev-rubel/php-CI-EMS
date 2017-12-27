$(document).ready(function() {
	var interval = setInterval(function() {
		var momentNow = moment();
		$('#date-part').html(momentNow.format('DD MMMM YYYY'));
		$('#time-part').html(momentNow.format('hh:mm:ss A'));
	}, 100);
	
	
});

$(window).on('load', function() { // makes sure the whole site is loaded 
  $('#status').fadeOut(); // will first fade out the loading animation 
  $('#preloader').delay(50).fadeOut('slow'); // will fade out the white DIV that covers the website. 
  $('body').delay(50).css({'overflow':'visible'});
})


$(document).ready(function () {
	$.validate({
		modules: 'security, file'
	});
});
$(document).ready(function () {
	new WOW().init();
});
$(document).ready(function () {

	$("#owl-all").owlCarousel({
		autoPlay: true,
		pagination: false
	});

});
(function ($) {
	"use strict";

	function count($this) {
		var current = parseInt($this.html(), 10);
		current = current + 1; /* Where 50 is increment */
		$this.html(++current);
		if (current > $this.data('count')) {
			$this.html($this.data('count'));
		} else {
			setTimeout(function () {
				count($this)
			}, 50);
		}
	}
	$(".stat-count").each(function () {
		$(this).data('count', parseInt($(this).html(), 10));
		$(this).html('0');
		count($(this));
	});
})(jQuery);

// For DataPicker
 $(document).ready(function () {
	var date_input = $('input[name="date"]'); //our date input has the name "date"
	var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
	date_input.datepicker({
		format: 'dd/mm/yyyy',
		container: container,
		todayHighlight: true,
		autoclose: true,
	})
})