var APPLICATION = {};
(function ($) {

	"use strict";

	var
	$window = $(window),
	$body = $('body');

	APPLICATION.categories = {
		functions: function () {
			APPLICATION.categories.dropdown();
		},
		visible: function (element, mode='') {
			if($body.is('.mainMenu-open')){
				$('#mainMenu-trigger > .lines-button.x').removeClass("toggle-active");
				$body.removeClass('mainMenu-open');
			}
			$body.toggleClass('mainCategory-open');
		},
		dropdown: function () {
			var $dropdownToggle = $('.mycategories').find('.toggle-dropdown-menu');
			if($dropdownToggle.length > 0){
				$dropdownToggle.each(function(k,v){
					$(this).on('click', function(){
						var $element = $(this).parent();
						if($element.is('.dropdown.actived')){
							// actived
							$element.removeClass('actived');
							$element.children('.dropdown-menu').slideToggle();
						}else{
							// not actived
							if($('.mycategories > ul > li.dropdown.actived').length){
								$('.mycategories > ul > li.dropdown.actived').children('.dropdown-menu').slideToggle();
								$('.mycategories > ul > li.dropdown.actived').removeClass('actived');
							}
							$element.addClass('actived');
							$element.children('.dropdown-menu').slideToggle();
						}
						return false;
					});
				});
			}
		}
	}

	APPLICATION.documentOnResize = {
		functions: function () {

		}
	};
	$window.on('resize', APPLICATION.documentOnResize.functions);

	APPLICATION.documentReady = {
		functions: function () {
			if($body.is('.device-lg') || $body.is('.device-md')){
				$('#header--categories .toggle').click();
			}
			APPLICATION.categories.functions();
		}
	};
	$(document).ready(APPLICATION.documentReady.functions);

	APPLICATION.documentOnLoad = {
		functions: function () {

		}
	};
	$(window).on('load', APPLICATION.documentOnLoad.functions);

})(jQuery);