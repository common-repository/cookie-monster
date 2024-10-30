(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */
	$( ".close-cookie-monster" ).click(function() {
		var accept = 1;
		var data = {
			action: 'cookie_monster',
			accept: accept
		};
		$("#cookie-monster").fadeOut('slow', function (){
			$.post(cookie_monster.ajax_url, data, function(response) {
				// $("#maps-list").fadeIn('slow');
				// execute something
				$('#cookie-monster-debug').html(response);
			});
		});
	});
	$( ".hide-cookie-monster" ).click(function() {
		$("#cookie-monster").fadeOut('slow', function (){
			// ocultado
		});
	});
	
	
})( jQuery );