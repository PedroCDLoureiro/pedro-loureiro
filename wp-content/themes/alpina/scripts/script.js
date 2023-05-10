$(document).ready(function() {
	$(document).on('click', '.scroll-to', function () {
		var target = $(this.getAttribute('href'));
		if( target.length ) {
			event.preventDefault();
			$('html, body').stop().animate({
				scrollTop: target.offset().top
			}, 1000);
		}
	});
	$(document).on('click', '.menu-down', function () {
		$('.submenu').toggleClass('active');
	});
	$(document).on('click', '.menu-down-mobile', function () {
		$('.submenu-mobile').toggleClass('active');
	});
});