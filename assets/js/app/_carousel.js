'use strict';
var $ = jQuery;

/* ==========================================================================
    CAROUSEL
   
		We are using Owl Carousel 2
		https://owlcarousel2.github.io/OwlCarousel2/.
   ========================================================================== */

$(document).ready(function(){

	$( '.c-carousel--hero' ).owlCarousel({
		items: 1,
		loop: true,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplaySpeed: 1000,
		autoplayHoverPause: true,
		smartSpeed: 1000,
		dots: false,
		nav: true,
		navContainerClass: 'c-carousel__nav',
		navClass: ['c-carousel__control prev','c-carousel__control next'],
		navText: [ '<span class="u-sr-only">Previous</span>', '<span class="u-sr-only">Next</span>' ]
	});

	$( '.c-carousel--related' ).owlCarousel({
		items: 1.5,
		loop: true,
		smartSpeed: 1000,
		dots: false,
		nav: true,
		navContainerClass: 'c-carousel__nav',
		navClass: ['c-carousel__control c-carousel__control--dark prev','c-carousel__control c-carousel__control--dark next'],
		navText: [ '<span class="u-sr-only">Previous</span>', '<span class="u-sr-only">Next</span>' ],
		responsive: {
			0: {
				items: 1,
				margin: 0,
				loop: false
			},
			768: {
				items: 1.5,
				margin: 10,
				loop: true
			}
		}
	});

});