'use strict';

/* ==========================================================================
    LOAD MORE

    AJAX to load more posts.
   ========================================================================== */

(function($){

	// Vars
	var loadTriggerTarget 	= '#load-more',
			$loadTrigger 				= $( loadTriggerTarget );

	// Get the page no. from data-attr on
	// button
	function getPage() {

		return parseInt( $loadTrigger.data('page') );
	}

	// Update button's data-attr to reflect
	// new page
	function updatePage( pageNo ) {

		$loadTrigger.data( 'page', pageNo );
		$loadTrigger.attr( 'data-page', pageNo ); // also update DOM for clarity
	}

	// AJAX to get posts
	function filterPosts() {

		$.ajax({

			url: wp_ajax.url,
			type: 'GET',

			data: {
				action: 'otm_ajax_return_posts',
				tag: getTag(loadTriggerTarget),
				page: getPage()
			},

			success: function( html ){

				$( '#ajax-container' ).append( html );

				var nextPage = getPage() + 1;
				updatePage( nextPage );
			}
		});
	}

	$( document ).on( 'click', loadTriggerTarget, function( e ){

		e.preventDefault();
		filterPosts();
	});

	/* ==========================================================================
    CONTENT FILTER
   
		Show/hide DOM elements based on data-attributes and user 
		selection.
   ========================================================================== */

	// Vars
	var $filterInput 							= $( '.c-content-filter__input' ),
			$filterFromSidebarInput 	= $( '.c-content-filter__sidebar-input'),
			$filterArea								= $( '.c-content-filter__canvas' ),
			$filterShowing						= $( '#filter-active-category' ),
			$filterMenu 							= $( '#filter-control-menu' ),
			$filterContainer					= $( '#filter' ),
			$filterMenuTrigger				= $filterShowing;

	function getTag( target ) {
		
		var tag = $( target ).data('tag');
		return tag;
	}

	function getText( target ) {

		var text = $( target ).text();
		return text;
	}

	function setText( $target, text ) {

		$target.text( text );
	}

	function setTag ( $target, string ) {

		$target.data( 'tag', string );
		$target.attr( 'data-tag', string );
	}

	function updateLoadMoreTrigger( tag ) {

		$( '#load-more' ).data( 'tag', tag );
		$( '#load-more' ).attr( 'data-tag', tag ); // update DOM for clarity

		// Reset page (datt-attr, used for
		// paged in AJAX function
		$( '#load-more' ).data( 'page', 1 );
		$( '#load-more' ).attr( 'data-page', 1 );
	}

	function toggleFilterMenu() {

		$filterContainer.toggleClass('is-active');
	}

	// Event Listeners
	$( document ).ready( function(){

		// When user clicks filter option
		$filterInput.click( function( e ){

			e.preventDefault();

			// Get tag from data-attr
			var tagToMatch = getTag( this );

			// Update load more button
			updateLoadMoreTrigger( tagToMatch );

			// Swap text & tag on active
			setText( $filterShowing, getText( this ) );
			setTag( $filterShowing, tagToMatch );

			// Hide menu if input came from within it
			// (aka. didn't come from tags menu in sidebar)
			if ( ! $( this ).hasClass( 'js-no-menu-toggle' ) ) {

				toggleFilterMenu();
			}

			// Run AJAX request to get posts,
			// but clear the container first
			$( '#ajax-container' ).empty();
			filterPosts();

			// Scroll to top of section
			$('html, body').animate({

				scrollTop: $('#main-content').offset().top
			}, 1000 );
		});

		// Show/hide menu
		$filterMenuTrigger.click(function(){ toggleFilterMenu(); });

	});

})(jQuery);