( function( $ ) {
	"use strict";

	function MasonryLayout( element ) {
		this.container = $( element );
		this.gridContainer = $( '.content-inner', element );
		this.columnCount = 2;

		if ( $( 'body' ).hasClass( 'blog-three-columns' ) ) this.columnCount = 3;
		if ( $( 'body' ).hasClass( 'blog-four-columns' ) ) this.columnCount = 4;
		if ( $( 'body' ).hasClass( 'blog-five-columns' ) ) this.columnCount = 5;

		this.container.on( 'content-appended', ( function( e, data ) {
			data.items.imagesLoaded( ( function() {
				var frames = data.items.find( 'iframe' );
				var frameLoaded = 0;
				
				frames.on( 'load', ( function() {
					frameLoaded++;

					if ( frameLoaded == frames.length ) {
						this.gridContainer.masonry( 'layout' );
					}
				} ).bind( this ) );

				data.items.css( 'visibility', 'visible' );
				this.resizeColumns();
				this.gridContainer.masonry( 'appended', data.items );
			} ).bind( this ) );
		} ).bind( this ) );

		$( window ).on( 'load', ( function() {
			this.container.imagesLoaded( ( function() {

				this.resizeColumns();
				this.gridContainer.masonry( {
					itemSelector: '.hentry'
				} );

			} ).bind( this ) );
		} ).bind( this ) );
		
		$( window ).smartresize( this.update.bind( this ) );
	};

	MasonryLayout.prototype = {
		resizeColumns: function() {
			this.gridContainer.removeAttr( 'style' );
			this.gridContainer.css( 'position', 'relative' );

			var containerWidth = this.gridContainer.width(),
				extraWidth = containerWidth % this.columnCount,
				columnWidth = Math.round( containerWidth/this.columnCount );

			$( '.hentry', this.gridContainer ).css( 'width', columnWidth );
			$( '.hentry:nth-child(' + this.columnCount + ')', this.gridContainer ).css( 'width', columnWidth - extraWidth );
			
			this.gridContainer.css( 'width', containerWidth + 10 );
		},

		update: function() {
			this.resizeColumns();
			this.gridContainer.masonry( 'layout' );
		}
	}

	$.fn.masonryLayout = function( options ) {
		return this.each( function() {
			$( this ).data( '_masonryLayout', new MasonryLayout( this, options ) );
		} );
	};

} ).call( this, jQuery );