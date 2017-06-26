'use strict';

/* ==========================================================================
		LIGHTBOX

		Fire lightbox (lightcase.js).
   ========================================================================== */

(function($){

	// @function
	// get the ID of contained form
	function getFormID() {

		// Find the form ID
		var formID = lightcase.get( 'case' ).find( 'form' ).attr( 'id' );
		formID = formID.replace( 'mktoForm_', '' );

		// Return it
		return formID;
	};

	$(document).ready(function(){
		
		$('a[data-rel="lightcase"]').lightcase({

			// Options: http://cornel.bopp-art.com/lightcase/documentation/#api
			closeOnOverlayClick: false,

			// Add methods
			onStart: {

				addActiveClass: function() {

					var parent = lightcase.get('case');
					parent.addClass('is-active');
				},

				loadForm: function() {

					// Load a Marketo form
					// http://developers.marketo.com/javascript-api/forms/api-reference/
					MktoForms2.loadForm("//app-ab17.marketo.com", "694-KCV-926", getFormID(), function(form){ 

						// Add an onSuccess handler
	    			form.onSuccess( function( values, followUpUrl ) {

	        		// Get the form's jQuery element and hide it
	        		form.getFormElem().hide();

	        		// Replace title text
	        		$( '#overlay-title' ).text( 'Thank you' );

	        		// If form ID is the 'contact us' form
	        		if ( getFormID() == '1854' ) {
							
								// Show this message
		        		$( '<p class="c-lightbox__copy">Thank you for your interest, we will be in touch soon. In the meantime, please visit <a href="investmentmanagement.tech" target="_blank">investmentmanagement.tech</a> for more information about our solutions or contact your <a href="http://investmentmanagement.tech/contact-ssc-advent.html" target="_blank">nearest SS&C Advent office.</a>' ).insertAfter( form.getFormElem() );
		        	}

		        	else {

		        		// Find the video markup (from vidyard: https://www.vidyard.com/developers/)
		        		var vidyardContainer 	= lightcase.get( 'case' ).find( '.vidyard_player' ),
		        				vidyardIframe			= vidyardContainer.find('iframe');

		        		// Show the container
		        		vidyardContainer.css({
		        			'display': 'block'
		        		});

		        		// Show the iFrame
		        		vidyardIframe.css({
		        			'opacity': 1
		        		});
		        	}

	        		// Return false to prevent the submission handler 
	        		// from taking the lead to the follow up url
	        		return false;
	    			});
					});
				}
			},

			onClose: {
				removeActiveClass: function() {
					var parent = lightcase.get('case');
					parent.removeClass('is-active');
				}
			}
		});
	});

})(jQuery);