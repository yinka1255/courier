// @koala-prepend "./_debounce.js"
// @koala-prepend "./_menu_collapse.js"
// @koala-prepend "./_sticky_header.js"
// @koala-prepend "./_nav_search.js"
// @koala-prepend "./_masonry_layout.js"
// @koala-prepend "./_content_reveal.js"
// @koala-prepend "./_navigator_spy.js"
// @koala-prepend "./_pagination.js"
// @koala-prepend "./_instant_search.js"
// @koala-prepend "./_projects.js"
// @koala-prepend "./_sticky_content.js"

( function( $ ) {
	"use strict";

	var _initComponents = function( container ) {
		if ( $.fn.fitVids ) $( '.fitVids', container ).fitVids();
		if ( $.fn.flexslider ) {
			$( '.flexslider:not(.wpb_flexslider)', container ).each( function() {
				var slider = $( this ),
					config = {
						animation: 'slide',
						smoothHeight: true
					};

				try { config = $.extend( config, JSON.parse( '{' + slider.attr( 'data-slider-config' ) + '}' ) ); }
				catch( e ) {}

				slider.imagesLoaded( function() {
					slider.flexslider( config );
				} );
			} );
		}

		// Initialize projects layout
		$( '.projects.projects-masonry, .projects.projects-has-filter' ).projects();

		// Initialize project single
		$( '.project-single.project-content-left.project-content-sticky,\
			.project-single.project-content-right.project-content-sticky' ).sticky_content( {
			item: '.project-content',
			additionOffset: function() {
				return $( '#wpadminbar' ).height() + $( '#site-navigator.stick' ).height() + 20;
			}
		} );
	};

	$( function() {
		var body = $( 'body' );

		// Initialize header sticky feature
		if ( _themeConfig.stickyHeader ) {
			if ( body.hasClass( 'header-v2' ) ){
				$( '#site-navigator' ).stickyHeader( {
					position: 'fixed',
					additionOffset: $( '#wpadminbar' ).height() || 0
				} );
			}
			else {
				$( '#masthead' ).stickyHeader( {
					updatePosition: function( e, data ) {
						this.nav.css( {
							position: 'relative',
							top: data.offsetTop - this.navOriginOffset.top
						} );
					},

					additionOffset: $( '#wpadminbar' ).height() || 0
				} );
			}
		}

		// Collapsible menu for mobile views
		if ( _themeConfig.responsiveMenu ) {
			$('.navigator-mobile').menuCollapse();
		}

		// Modal content
		if ( _themeConfig.offCanvas ) {
			$( document ).on( 'click', '.navigator .off-canvas-toggle > a, .navigator-mobile .off-canvas-toggle > a', function( e ) {
				e.preventDefault();
				$( 'body' ).toggleClass( 'off-canvas-active' );
			} );

			$( document ).on( 'click', '#site-off-canvas .close', function( e ) {
				e.preventDefault();
				$( 'body' ).removeClass( 'off-canvas-active' );
			} );
		}

		// Blog masonry layout
		if ( body.hasClass( 'blog-masonry' ) ) {
			$( '.main-content-wrap' ).masonryLayout();
		}

		// Onepage Navigator
		if ( _themeConfig.onepageNavigator ) {
			$( '#site-header .navigator a, #site-header .navigator-mobile a' ).contentReveal( {
				offset: $( '#wpadminbar' ).height(),
				complete: function( evt ) {
					$( window ).trigger( 'scroll' );
				}
			} );

			$( '#site-header .navigator, #site-header .navigator-mobile' ).navigatorSpy( {
				offset: $( '#masthead-sticky' ).height() + $( '#wpadminbar' ).height()
			} );
		}

		// Ajax pagination
		if ( _themeConfig.pagingStyle == 'loadmore' ) {
			$( '.navigation.paging-navigation.loadmore' ).pagination( {
				paginator: _themeConfig.pagingNavigator,
				container: _themeConfig.pagingContainer,
				infiniteScroll: false,
				success: function() {
					_initComponents( $( '#main-content > .main-content-wrap > .content-inner' ) );
				}
			} );
		}

		// Pretty Photo
		if ( $.prettyPhoto ) {
			$( 'a.prettyPhoto, a.prettyphoto' ).prettyPhoto( {
				social_tools: ''
			} );

			$( document ).on( 'click', 'a[data-lightbox="prettyPhoto"]', function( e ) {
				e.preventDefault();
				
				if ( $( this ).attr( 'data-lightbox-gallery' ) !== undefined ) {
					var images = [], titles = [], descriptions = [];
					var href = $( this ).attr( 'href' );

					$( '[data-lightbox-gallery="' + $( this ).attr( 'data-lightbox-gallery' ) + '"]' ).each( function() {
						images.push( $( this ).attr( 'href' ) );
						titles.push( $( 'img', this ).attr( 'title' ) || '' );
						descriptions.push( $( this ).attr( 'title' ) || '' );
					} );

					$.prettyPhoto.open( images, titles, descriptions, images.indexOf( href ) );
				}
				else {
					$.prettyPhoto.open( $( this ).attr( 'href' ), $( 'img', this ).attr( 'title' ) || '', $( this ).attr( 'title' ) || '' );
				}
			} );
		}

		$( 'a.content-reveal' ).contentReveal();
		$( '.navigator .search-box' ).navSearch();
		
		// Global components
		_initComponents( body );
	} );

	/**
	 * Initialize gotop button
	 * 
	 * @return void
	 */
	$( function() {
		var gotop = $( '.goto-top' );

		$( 'body' ).imagesLoaded( function() {
			$.stellar({ horizontalScrolling: false });
		} );

		$( document ).on( 'woocommerce-cart-changed', function( e, data ) {
			if ( parseInt( data.items_count ) > 0 ) {
				$( '.shopping-cart-items-count' )
					.text( data.items_count )
					.removeClass( 'no-items' );
			}
			else {
				$( '.shopping-cart-items-count' )
					.empty()
					.addClass( 'no-items' );
			}
		} );

		// Goto Top button
		$( 'a', gotop ).on( 'click', function( e ) {
			e.preventDefault();

			$( 'html, body' ).animate( {
				scrollTop: 0
			} );
		} );

		$( window ).on( 'scroll', function() {
			if ( $( window ).scrollTop() > 0 ) $( '.goto-top' ).addClass( 'active' );
			else $( '.goto-top' ).removeClass( 'active' );
		} ).on( 'load', function() {
			$( window ).trigger( 'scroll' );
		} );
	} );
} ).call( this, jQuery );
