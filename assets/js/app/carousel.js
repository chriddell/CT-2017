'use strict';

/* ==========================================================================
    CAROUSEL
   
		We are using Owl Carousel 2
		https://owlcarousel2.github.io/OwlCarousel2/.
   ========================================================================== */

(function($){

	$(document).ready(function(){

		$('.c-hero-carousel').owlCarousel({
			loop: true,
			items: 1,
			autoplay: true,
			autoplayTimeout: 3000,
			autoplaySpeed: 1000,
			autoplayHoverPause: true,
			smartSpeed: 1000,
			nav: true,
			navContainerClass: 'c-carousel__nav',
			navClass: ['c-carousel__control prev','c-carousel__control next'],
			navText: [ '<span class="u-sr-only">Previous</span>', '<span class="u-sr-only">Next</span>' ]
		});
	});

})(jQuery);