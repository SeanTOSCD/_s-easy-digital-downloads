/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'sdm_read_more', function( value ) {
		value.bind( function( to ) {
			$( '.more-link' ).text( to );
		} );
	} );
	wp.customize( 'sdm_edd_store_archives_title', function( value ) {
		value.bind( function( to ) {
			$( '.store-title' ).text( to );
		} );
	} );
	wp.customize( 'sdm_product_view_details', function( value ) {
		value.bind( function( to ) {
			$( '.view-details' ).text( to );
		} );
	} );
	wp.customize( 'sdm_credits_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.site-info' ).text( to );
		} );
	} );
} )( jQuery );
