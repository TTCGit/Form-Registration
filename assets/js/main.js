
jQuery(document).ready(function(){
	
	"use strict";

	//Menu Trigger
	$(".menu-trigger").click(function() {

		$(".header").toggleClass("active");

	});
	//End Menu Trigger

	//header-fullscreen__trigger
	$('.header-fullscreen__trigger').click(function(){

		$('.bars, .bar, .header-fullscreen').toggleClass('active');

	});
	//end header-fullscreen__trigger
	
	//Detect Menu Item & Add Active Class
	jQuery(function($) {

		var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
		$('.header-fullscreen__navbar .main-nav a').each(function() {

		if (this.href === path) {
			$(this).addClass('active');
		}

		});
		
	});
	//End Detect Menu Item & Add Active Class

});


