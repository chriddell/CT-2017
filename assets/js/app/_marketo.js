'use strict';
var $ = jQuery;

/* ==========================================================================
    MARKETO

    Embeds Marketo form.
   ========================================================================== */

$(document).ready(function(){

	// If form with ID exists
	if ( $('#mktoForm_1854').length ) {

		// Load the form
		MktoForms2.loadForm("//app-ab17.marketo.com", "694-KCV-926", 1854, function(form){ });

		// When form has finished rendering
		MktoForms2.whenRendered(function(form){

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
	$( '.mktoForm input, .mktoForm textarea, .mktoForm label, .mktoForm .mktoFormCol, .mktoForm .mktoButtonWrap, .mktoRequired' ).removeAttr( 'style' );
	$( '.mktoForm' ).css( 'width', '100%' );
	$( '.mktoOffset, .mktoGutter' ).remove();
	$( 'label' ).remove();
	$( 'input.mktoField, input.mktoTextField' ).removeClass( 'mktoField' ).removeClass( 'mktoTextField' );
	$( '.mktoFieldWrap' ).removeClass( 'mktoFieldWrap' );
	$( '.mktoFormCol' ).removeClass( 'mktoFormCol' );
	$( '.mktoButtonRow' ).removeClass( 'mktoButtonRow' );
	$( '.mktoForm button' ).addClass( 'register' ).removeClass( 'mktoButton' );

	// Remove classes and style attr from <form> element
	$( '.mktoForm' ).removeAttr( 'style' ).removeClass('mktoForm mktoHasWidth mktoLayoutAbove');

	// Add our own classes :)
  $('.c-form--marketo input, .c-form--marketo button, .c-form--marketo select, .c-form--marketo textarea').addClass('c-form__input');
  $('.c-form--marketo input[type="text"], .c-form--marketo input[type="email"], .c-form--marketo textarea').addClass('c-form__input--text');
  $('.c-form--marketo textarea').addClass('c-form__input--textarea');
  $('.c-form--marketo button[type="submit"]').addClass('c-form__input c-form__input--submit c-btn c-btn--submit like-link');
  $('.c-form--marketo select').addClass('c-form__input--select');
  $('.c-form--marketo label').addClass('c-form__label').removeClass('mktoLabel');
}