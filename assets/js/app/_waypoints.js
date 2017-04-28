/* ==========================================================================
    _waypoints.js

    Uses waypoints.js to do stuff when a waypoint is reached.
   ========================================================================== */

(function($){

	$(document).ready(function(){

    if ( $('.js-stick-me').length ) {
      
      // Make header sticky
  		var sticky = new Waypoint.Sticky({
    		element: $('.js-stick-me')[0],
    		stuckClass: 'is-stuck'
  		});
    }

    // Show 'back to top'
    var waypoints = $( '.l-page-content' ).waypoint({
      handler: function( direction ) {

        $( '.c-back-to-top' ).toggleClass( 'is-visible' );
      }
    });
	});

})(jQuery);