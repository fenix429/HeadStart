/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function($) {
	if ( ("ontouchstart" in document.documentElement) || window.navigator.msPointerEnabled ) {
		$('li.menu-item-has-children > a').on('touchstart MSPointerDown', function(evt){
			var menuitem = $(evt.target).parent();
			
			if( ! menuitem.hasClass('touchopen') ) { evt.preventDefault(); }
			
			menuitem.siblings().removeClass('touchopen');
			menuitem.toggleClass('touchopen');
			
			// stop it from bubbling to ALL other handlers
			evt.stopImmediatePropagation();
		});
		
		$('.site-navigation a').on('touchstart MSPointerDown', function(evt){
			// stop it from bubbling to document
			evt.stopPropagation();
		});
		
		$(document).on('touchstart MSPointerDown', function(){
			// close menu if body touched
			$('li.menu-item-has-children').removeClass('touchopen');
		});
	}
	
	$('#primary-menu > ul').slicknav({ prependTo: '#mobile-menu-container' });
} )(window.jQuery);
