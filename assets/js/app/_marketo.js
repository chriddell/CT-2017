'use strict';

/* ==========================================================================
    MARKETO

    Embeds Marketo form.
   ========================================================================== */

(function($){

	$(document).ready(function(){

		// Add an onFormRender handler.
		// This is called whenever a form is rendered
		// on the page.
		if ( $('.u-marketo').length ) {
			MktoForms2.onFormRender( function( form ){

				// Removeit'sstupidstyles
				swapMarketoStyles();
			});
		}
	});

	/**
	 * Remove exported styles from Marketo form
	 * because we don't have access to the exporting 
	 * method
	 *
	 * Based on https://www.phireworx.co.uk/marketo/remove-marketo-form-css/
	 *
	 * It's fine to do this (for now) because our form is initially hidden and
	 * displayed as an overlay from a user action.
	 */
	function swapMarketoStyles() {

		// Remove <style> tag from
		$( '.mktoForm style' ).remove();

		// Remove classes & styles from individual elements within <form>
		$( '.mktoForm input, .mktoForm textarea, .mktoForm label, .mktoForm .mktoFormCol, .mktoForm .mktoButtonWrap, .mktoRequired, .mktoCheckboxList' ).removeAttr( 'style' );
		$( '.mktoForm' ).css( 'width', '100%' );
		$( '.mktoOffset, .mktoGutter' ).remove();
		$( '.mktoAsterix' ).remove(); // this essentially hides unused <labels>
		$( 'input.mktoField, input.mktoTextField' ).removeClass( 'mktoField' ).removeClass( 'mktoTextField' );
		$( '.mktoFieldWrap' ).removeClass( 'mktoFieldWrap' );
		$( '.mktoFormCol' ).removeClass( 'mktoFormCol' );
		$( '.mktoButtonRow' ).removeClass( 'mktoButtonRow' ).addClass( 'mktoFormRow c-form__submit-group' );
		$( '.mktoFormRow' ).addClass( 'c-form__input-group' );
		$( '.mktoForm button' ).addClass( 'register' ).removeClass( 'mktoButton' );

		// Remove classes and style attr from <form> element
		$( '.mktoForm' ).removeAttr( 'style' ).removeClass( 'mktoForm mktoHasWidth mktoLayoutAbove' );

		// Add our own classes :)
	  $('.c-form--marketo input, .c-form--marketo button, .c-form--marketo select, .c-form--marketo textarea').addClass( 'c-form__input' );
	  $('.c-form--marketo input[type="text"], .c-form--marketo input[type="email"], .c-form--marketo textarea').addClass( 'c-form__input--text' );
	  $('.c-form--marketo input[type="checkbox"]').addClass( 'c-form__input--checkbox' );
	  $( '.c-form--marketo textarea' ).addClass( 'c-form__input--textarea' );
	  $( '.c-form--marketo button[type="submit"]' ).addClass( 'c-form__input c-form__input--submit c-btn c-btn--submit c-read-more' );
	  $( '.c-form--marketo select' ).addClass( 'c-form__input--select' ).parents( '.mktoFormRow' ).addClass( 'c-form__input-group--50' );
	  $( '.c-form--marketo label' ).addClass( 'c-form__label' );
	  $( '.c-form--marketo input[type="checkbox"] + label' ).addClass( 'c-form__label--checkbox' );
	}

})(jQuery);