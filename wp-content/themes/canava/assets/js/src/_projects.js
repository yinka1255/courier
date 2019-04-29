( function( $ ) {
	"use strict";

	$.fn['projects'] = function() {
		return this.each( function( index, container ) {
			$( '> .projects-wrap > .projects-items', container ).imagesLoaded( function() {
				$( '> .projects-wrap > .projects-items', container ).isotope( {
					layoutMode: 'packery',
					itemSelector: '.project',
					percentPosition: true
				} );

				$( '> .projects-wrap > .projects-filter li[data-filter] a', container ).on( 'click', function( e ) {
					e.preventDefault();

					$( '> .projects-wrap > .projects-filter li', container ).removeClass( 'active' );
					$( '> .projects-wrap > .projects-items', container ).isotope( {
						filter: $( this ).parent().attr( 'data-filter' )
					} );

					$( this ).parent().addClass( 'active' );
				} );
			} );
		} );
	};

} )( jQuery );
