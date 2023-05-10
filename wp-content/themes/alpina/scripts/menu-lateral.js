$(document).ready(function() {
	$(document).on('click', '#btn-mobile', function () {
		$(this).toggleClass('is-active');
		$('#menu-lateral').toggleClass('is-active');
		$('body').toggleClass('is-menu-active');
	});

	// $(document).on('click', '#menu-lateral a, #menu-lateral .bg', function () {
	//     $('#menu-lateral').removeClass('is-active');
	//     $('#btn-mobile').removeClass('is-active');
	//     $('body').removeClass('is-menu-active');
	// });

	$(document).on('click', '#menu-categorias', function () {
	    $('#menu-categorias').toggleClass('is-active');
	    $('.categorias-mobile ul').toggleClass('is-active');
	    $('#main_blog').toggleClass('is-active');
	});
});