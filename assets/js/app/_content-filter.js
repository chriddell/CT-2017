'use strict';
var $ = jQuery;

/* ==========================================================================
    CONTENT FILTER
   
		Show/hide DOM elements based on data-attributes and user 
		selection.
   ========================================================================== */

// Vars
var $filterInput 							= $( '.c-content-filter__input' ),
		$filterFromSidebarInput 	= $( '.c-content-filter__sidebar-input'),
		$filterArea								= $( '.c-content-filter__canvas' ),
		$filterElems							= $( '.c-content-filter__canvas .filterable' ),
		$filterShowing						= $( '#filter-active-category'),
		$filterMenu 							= $( '#filter-control-menu'),
		$filterContainer					= $( '#filter' ),
		$filterMenuTrigger				= $filterShowing;

$( document ).ready( function(){

	// Change filter
	$filterInput.click( function( e ){

		// Prevent link follow
		e.preventDefault();

		// Get tag from data-attr
		var tagToMatch = getTag( this );

		// Run the filter
		runFilter( tagToMatch );

		// Swap text on active
		setText( $filterShowing, getText( this ) );

		// Hide menu if input came from within
		// it (didn't come from outside it)
		if ( !$(this).hasClass('js-no-menu-toggle') ) {
			toggleFilterMenu();
		}

		// Scroll to top of section
		$('html, body').animate({
			scrollTop: $('#main-content').offset().top
		}, 1000 );
	});

	// Show/hide menu
	$filterMenuTrigger.click(function(){ toggleFilterMenu(); });

});

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

function runFilter( tag ) {

	// Loop the filterable elements
	$filterElems.each( function( i ){

		// Get the tags from the element
		var tagsToCheck = getTag( this );

		// If tags (string) on this contain
		// requested tag (string)
		if ( tagsToCheck.indexOf( tag ) !== -1 ) {

			// Show this element
			$(this).css({ 'display': 'block' });
		}

		// Else it doesn't have the requested tag
		else {

			// So hide this element
			$(this).css({ 'display': 'none '});
		}
	});
}

function toggleFilterMenu() {

	$filterContainer.toggleClass('is-active');
}
