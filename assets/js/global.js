$(document).ready(function() {

	// Meow
	$('#onready div').each( function(index) {
		var is_sticky = $(this).hasClass('is-sticky');
		$.meow({
			message: $(this).html(),
			sticky: is_sticky
		});
	});

});