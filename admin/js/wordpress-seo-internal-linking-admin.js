(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document ).ready( function(){
		$( '.wp_sil_add_row a' ).click( function(){
			var data_row_num = parseInt( $('.wp_sil_options_fields').attr( 'data-key' ) ) + 1 ;
			console.log( data_row_num );
			var row_html = "<tr class='wp_sil_setting_row' id='"+ data_row_num +"'><td><input class='wp_sil_keyword' name='wp_sil_plugin_options[keyword][" + data_row_num + "]' type='text' placeholder='Keyword' /></td><td><input class='wp_sil_link' name='wp_sil_plugin_options[link][" + data_row_num + "]' type='url' placeholder='Link URL' /></td><td><input class='wp_sil_priority' name='wp_sil_plugin_options[priority]["+ data_row_num +"]' type='checkbox' /></td><td><a class='wp_sil_remove_row button button-secondary' data-rem-id='" + data_row_num + "'> Remove</a></td></tr>";

			$( '.wp_sil_setting_table tbody' ).append( row_html );
			
			$('.wp_sil_options_fields').attr( 'data-key', data_row_num );

		} );

		$( '#wp_sil_import_settings_form' ).submit( 'on', function( e ) {
			var cnf_import = confirm( 'Are you sure you want to run import? It may alter the data you have saved. This action is irreversible' );

			if( false === cnf_import ){
				e.preventDefault();
			}

		} );

		$( '.copy-export-data' ).click( 'on', function(){
			navigator.clipboard.writeText( $( "#wp_sil_plugin_options" ).val().replace(/'/g, '"') );
		} );

	} );

	// $( 'a.wp_sil_remove_row ' ).ready( function() {
	// 	$( 'a.wp_sil_remove_row ' ).click( function() {
	// 		$( 'tr#' + $( this ).data( 'rem-id' ) ).remove();
	// 	} );
	// } );

	$(document).on('click', 'a.wp_sil_remove_row', function() {
		$('tr#' + $(this).data('rem-id')).remove();
	});

})( jQuery );
