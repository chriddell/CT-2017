'use strict';
var $ = jQuery;

/* ==========================================================================
		LIGHTBOX

		Fire lightbox (lightcase.js).
   ========================================================================== */

$(document).ready(function(){
	
	$('a[data-rel^=lightcase').lightcase();
});