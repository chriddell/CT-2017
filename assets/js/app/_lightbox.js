'use strict';
var $ = jQuery;

/* ==========================================================================
		LIGHTBOX

		Fire lightbox (lightcase.js).
   ========================================================================== */

$(document).ready(function(){
	
	$('a[data-rel^=lightcase').lightcase({

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
				MktoForms2.loadForm("//app-ab17.marketo.com", "694-KCV-926", 1854, function(form){ 

					// Add an onSuccess handler
    			form.onSuccess(function(values, followUpUrl) {

        		// Get the form's jQuery element and hide it
        		form.getFormElem().hide();

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