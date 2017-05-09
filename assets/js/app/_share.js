'use strict';
var $ = jQuery;

/* ==========================================================================
    SHARE
   
		1. Set-up SDKs where necessary.

		2. Share UI.
   ========================================================================== */

/* 1. SDKs
   ========================================================================== */

/* Facebook
   ========================================================================== */

// Connect to Facebook SDK
window.fbAsyncInit = function() {

  FB.init({
    appId      : '613149088880214',
    xfbml      : true,
    version    : 'v2.8'
  });

  FB.AppEvents.logPageView();
};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));


// Vars
var shareToFacebookClass = '.c-share--fb',
		$shareToFacebook 	= $( shareToFacebookClass );

$(document).ready(function(){

	// Some elements which contain handler will be loaded
	// dynamically
	$('body').on( 'click', shareToFacebookClass, function(e){

		// Prevent default
		e.preventDefault();

		// Get URL from data-attr
		var url = $(this).data('url');

		// Invoke FB.ui
		FB.ui({	

		  method: 'share',
		  href: url,

		}, function(response){

		  // Debug response
		  console.log(response);
		});
	});
});

/* LinkedIn
   ========================================================================== */

// Vars
var shareToLinkedInClass = '.c-share--li',
		$shareToLinkedIn 	= $( shareToLinkedInClass );

$(document).ready(function(){

	// Event listener
	$('body').on( 'click', shareToLinkedInClass, function(e){

		// Prevent link follow
		e.preventDefault();

		// Open pop-up
		window.open( $(this).attr('href'), 'Share to LinkedIn', 'width=570,height=520' );

	});
});

/* Share UI
   ========================================================================== */

var shareDialogTriggerClass		= '.c-share__trigger',
		$shareDialogTrigger 			= $(shareDialogTriggerClass);

// Some elements which contain handler will be loaded
// dynamically
$('body').on( 'click', shareDialogTriggerClass, function(){

	$(this).parent().toggleClass('is-active');
});
