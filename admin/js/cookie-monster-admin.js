(function( $ ) {
	'use strict';

	/**
	 * All of the code for your Dashboard-specific JavaScript source
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

})( jQuery );
jQuery(document).ready(function($) {
	$( 'input[name="cookie_monster_alert_type"]' ).change(function() {
		var type = $(this).val();
		var data = {
			action: 'cookie_monster_alert_type',
			type: type
		};
		
		$('#config-texts, #config-display, #config-advanced').removeClass('selected');
		$('#config-'+type).addClass('selected');
		
		/*
		jQuery.post(cookie_monster_alert_type.ajax_url, data, function(response) {
			$('.alert-type-selection').html(response);
		});
		*/
	});

	window.addEventListener('load', function () {
		
		var type = $('input[name="cookie_monster_alert_type"]').val();
		var data = {
			action: 'cookie_monster_alert_type',
			type: type
		};
		
		$('#config-texts, #config-display, #config-advanced').removeClass('selected');
		$('#config-'+type).addClass('selected');

		
		//$('#config-'+type).toggle();
		/*
		jQuery.post(cookie_monster_alert_type.ajax_url, data, function(response) {
			$('.alert-type-selection').html(response);
		});
		*/
		
	}, false);
	
});
jQuery(document).ready(function($){
    $('.background-color').wpColorPicker();
});