/* ==========================================================================
    _stickyHeader.js

    Uses waypoints.js to stick an element to header (fixed pos.) when waypoint
    is reached.
   ========================================================================== */

(function($){

	$(document).ready(function(){

		var sticky = new Waypoint.Sticky({
  		element: $('.js-stick-me')[0],
  		stuckClass: 'is-stuck'
		});
	});

})(jQuery);