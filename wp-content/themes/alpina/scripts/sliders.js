$(document).ready(function() {
	$('.wrapper-slider').slick({
	  	slidesToShow   : 1,
	  	slidesToScroll : 1,
	  	fade           : true,
	  	speed          : 500,
	  	cssEase        : 'linear',
	  	autoplay 	   : true,
	    dots 		   : true,
	  	autoplaySpeed  : 4000,
	});
	$('.slider-clientes').slick({
	  	slidesToShow   : 6,
	  	slidesToScroll : 1,
		arrows		   : false,
	  	autoplay 	   : true,
	  	infinite 	   : true,
	  	autoplaySpeed  : 2000,
		responsive: [
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 4,
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 3,
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
				}
			}
		]
	});
});