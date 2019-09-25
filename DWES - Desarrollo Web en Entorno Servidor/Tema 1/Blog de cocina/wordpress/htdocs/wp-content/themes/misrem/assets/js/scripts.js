(function($,sr){
	// debouncing function from John Hann
	// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
	var debounce = function (func, threshold, execAsap) {
		var timeout;

		return function debounced () {
			var obj = this, args = arguments;
			function delayed () {
				if ( ! execAsap ) {
					func.apply( obj, args );
				}
				timeout = null;
			};

			if ( timeout ) {
				clearTimeout( timeout );
			} else if (execAsap) {
				func.apply( obj, args );
			}
			timeout = setTimeout( delayed, threshold || 100 );
		};
	};
	// smartresize
	jQuery.fn[sr] = function( fn ){  return fn ? this.bind( 'resize', debounce( fn ) ) : this.trigger( sr ); };

})(jQuery,'smartresize' );


/*
 * jQuery offscreen plugin
 *
 * Copyright 2017 A Beautiful Site, LLC
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @license: MIT - http://opensource.org/licenses/MIT
 *
 */
( function( $ ) {
	$.extend( $.expr[':'], {
		'off-top': function( el ) {
			return $( el ).offset().top < $( window ).scrollTop();
		},
		'off-right': function( el ) {
			return $( el ).offset().left + $( el ).outerWidth() - $( window ).scrollLeft() > $( window ).width();
		},
		'off-bottom': function( el ) {
			return $( el ).offset().top + $( el ).outerHeight() - $( window ).scrollTop() > $( window ).height();
		},
		'off-left': function( el ) {
			return $( el ).offset().left < $( window ).scrollLeft();
		},
		'off-screen': function( el ) {
			return $( el ).is( ':off-top, :off-right, :off-bottom, :off-left' );
		}
	});
})( jQuery );

	//Checking if scroll is lower than 200px, then make header nav fixed position
	( function( $ ) {
		$( document ).on( 'scroll', function () {
			if ( $( window ).scrollTop() > 200 ) {
				$( '.header' ).addClass( 'header--fixed' );
				if ( $( '.navigation .custom-logo-link' ).length === 0 && $( window ).width() < 1401 && $( window ).width() > 991 ) {
					$( '.header__page' ).addClass( 'header__page--hide' );
				}
			} else if ( $( window ).scrollTop() === 0 ) {
				if ( $( window ).width() < 1401 && $( window ).width() > 991 ) {
					$( '.navigation .custom-logo-link' ).remove();
					$( '.header__page' ).removeClass( 'header__page--hide' );
				}
				$( '.header' ).removeClass( 'header--fixed' );
			}
		});

		//this fix changes on fixed header when user resize window
		$( window ).on( 'resize', function () {
			if ( $( '.header__page' ).hasClass( 'header__page--hide' ) && ( $( window ).width() >= 1400 || $( window ).width() <= 991 ) ) {
				$( '.header__page' ).removeClass( 'header__page--hide' );
			}
		});
	}) ( jQuery );

//Displaying burger on click, on the burger buttom
( function( $ ){
	const roler = $( '.burger' );
	const navList = $( '.header .navigation' );

	roler.on( 'click', function () {
		roler.children().toggleClass( 'burger__roler--transform' );
		navList.toggleClass( 'navigation--visible' );
	});
}) ( jQuery );

//Second menu functions add show more "+" button and toogle sub menus on click
( function( $ ){
	function subMenu() {
		if ( $( window ).width() > 768 ) {
			if ( $( '.sub-menu' ).is( ':off-right' ) ) {
				$( '.sub-menu .sub-menu' ).css( 'left', '-100%' );
			}
		} else {
			$( '.menu-item-has-children > a' ).after( $( '<button/>', {class: 'show-sub', html: '<i class="fa fa-caret-down" aria-hidden="true"></i>' } ) );
		}

		$( '.show-sub' ).on( 'click', function() {
			$( this ).parent().children( '.sub-menu' ).first().toggleClass( 'second-menu-show' );
			if ( $( window ).width() > 768 ) {
				$( '.sub-menu .sub-menu' ).css( 'min-height', function() {
					return $( this ).parent().parent().height();
				});
			}
		});
	}

	subMenu();

	$( window ).smartresize( function(){
		$( '.show-sub' ).remove();
		$( '.back' ).remove();
		subMenu();
	});

})( jQuery );

//Show/hide search form from header
( function( $ ){
	$( '.search__show-input' ).on( 'click', function( e ) {
		e.preventDefault();
		$( '.search__show-input' ).css( {'opacity' : '0', 'cursor' : 'initial'} );
		$( '.search__form' ).addClass( 'search__form--active' );
		$( '.search__close' ).on( 'click', function( e ){
			e.preventDefault();
			$( '.search__form' ).removeClass( 'search__form--active' );
			$( '.search__show-input' ).css( {'opacity' : '1', 'cursor' : 'pointer'} );
		});
	});
})( jQuery );

//Sliders
( function( $ ){
	//top slider, with promoted posts
	( function slider() {
		const bodyBg = $( 'body' ).css( 'background' );

		if ( $( '.baner__slider' ).children( '.slider__slide' ).length > 1 ) {
			$( '.baner__slider' ).slick( {
				dots: true,
				infinite: true,
				speed: 300,
				slidesToShow: 1,
				arrows: false
			});
		}

	}() );

	//sliders in category view, work only in grid mode
	const sliders = $( '.category__slider' );
	$( sliders ).each( function(){
		if ( $( this ).children().length > 4 ) {
			if ( $( 'body' ).hasClass( 'grid' ) ) {
				$( this ).slick( {
					dots: false,
					infinite: false,
					speed: 300,
					slidesToShow: 4,
					slidesToScroll: 4,
					nextArrow: '<i class="fa fa-chevron-right"></i>',
					prevArrow: '<i class="fa fa-chevron-left"></i>',
					responsive: [
					{
						breakpoint: 1301,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
						}
					},
					{
						breakpoint: 769,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
					]
				});
				$( this ).on( 'setPosition', function() {
					$( '.category__slider article' ).width( $( '.slick-track article' ).width() );
				});
			} // End if().
		} // End if().
	});

	//slick-slider resizing windwo polyfill
	$( window ).on( 'orientationchange', function() {
		$( '.slick-slider' ).slick( 'resize' );
	});

	$( window ).smartresize( function(){
		$( '.slick-slider' ).slick( 'resize' );
	});
})( jQuery );

//Live validation for comments forms
( function( $ ){
	const name = $( '[name="author"]' );
	const email = $( '[name="email"]' );
	const button = $( '[name="submit"]' );

	if ( name.length > 0 ) {
		function testEmail() {
			const regMail = /^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,3}$/gi;
			if ( ! regMail.test( email.val() ) ) {
				email.css( 'border-bottom', '3px solid red' );
				$( '.error-mail' ).css( 'display', 'block' );
				return false;
			} else {
				email.css( 'border-bottom', '3px solid green' );
				$( '.error-mail' ).css( 'display', 'none' );
				return true;
			}
		}

		function test( e ) {
			if ( ! e.val() ) {
				e.css( 'border-bottom', '3px solid red' );
				$( '.error-author' ).css( 'display', 'block' );
				return false;
			} else {
				e.css( 'border-bottom', '3px solid green' );
				$( '.error-author' ).css( 'display', 'none' );
				return true;
			}
		}

		function testAll() {
			test( name );
			testEmail();

			if ( test( name ) === true && testEmail() === true ) {
				button.attr( "disabled", false );
			} else {
				button.attr( "disabled", true );
			}
		}

		function clikEvents( params ) {
			$( params ).each( function ( i, e ) {
				e.on( 'keyup blur click', function () {
					testAll();
				});
			});
		}

		clikEvents( [email, name ] );

		button.on( 'mouseenter', function () {
			testAll();
		});
	}// End if().
})( jQuery );

//Show/hide sub menu of categories widget
( function( $ ){

	if ( $( '.archive__sidebar .cat-item' ).children( '.children' ) ) {

		$( '.archive__sidebar .cat-item' ).prepend( $( '<button/>', { class: 'show-cat', html: '<i class="fa fa-caret-right" aria-hidden="true"></i>' } ) );

		$( '.children' ).parent().children( '.show-cat' ).addClass( 'has-children' );

		$( '.children' ).parent().children( '.show-cat' ).on( 'click', function() {
			$( this ).parent().children( '.children' ).toggleClass( 'children--show' );
			$( this ).toggleClass( 'show-cat--active' );
		});
	}
})( jQuery );

//Show/hide list of categories and tags if post has more than 4 categories/tags
( function( $ ){

	function showHide( selector, where ) {
		let containerHide = $( selector );

		function mrSelector() {
			if ( where === 'cat' ) {
				return 'li:gt(4)';
			} else {
				return ':gt(4)';
			}
		}

		containerHide.each(function() {
			let moreResults = $( this ).children( mrSelector() );

			const button = $( this ).parent().children( 'button' );

			if ( moreResults.length > 3) {
				moreResults.toggle();
			} else {
				button.css( 'display', 'none' );
			}

		});

		$( '.post__more-cat' ).on( 'click', function() {
			let container = $( this ).parent().children( selector );

			let moreResults = container.children( mrSelector() );
			moreResults.toggle();

		});
	}

	showHide( '.post__categories-list', 'cat' );
	showHide( '.post__tax', 'tag' );
})( jQuery );
