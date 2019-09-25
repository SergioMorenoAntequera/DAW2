/* global ajaxresponse */
/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
	// Update site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( r ) {
			$( '.header__title a' ).text( r );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( r ) {
			$( '.header__subtitle' ).text( r );
		});
	});

	function makeCategorySlider() {
		let sliders = $( '.category__slider' );
		$( '.category__posts .slick-slider' ).slick( 'unslick' );
		$( sliders ).each( function(){
			if ( $( this ).children().length > 4 ) {
				if ( $( 'body' ).hasClass( 'grid' ) ) {
					$( this ).slick({
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
								slidesToScroll: 3
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
	}

	//update site display way
	wp.customize( 'display_way', function( value ) {
		value.bind( function( r ) {
			if ( r === 'grid' ) {
				$( 'body' ).removeClass( 'list' );
				$( 'body' ).addClass( 'grid' );
				makeCategorySlider();
			} else {
				$( 'body' ).removeClass( 'grid' );
				$( 'body' ).addClass( 'list' );
				$( '.category__posts .slick-slider' ).slick( 'unslick' );
				$( '.list .category__slider .post' ).css( 'width', '100%' );
			}
		});
	});

	// Update slider categories
	wp.customize( 'slider_category', function( value ) {
		value.bind( function( category ) {
			$.ajax({
				url: ajaxresponse.ajaxurl,
				type: 'GET',
				data: {
					action: 'preview_slider',
					cat_name: category
				},
				success: function( r ) {
					if ( $( '.baner .slick-initialized' ) != 0 ) {
						$( '.slick-initialized' ).slick( 'unslick' );
					}
					$( '.baner__slider' ).empty();

					if ( r !== 'false' ) {
						$( 'body' ).removeClass( 'no-slider' );
						$( '.baner__slider' ).append( r );
						if ( $( '.baner__slider' ).children( '.slider__slide' ).length > 1 ) {
							$( '.baner__slider' ).slick({
								dots: true,
								infinite: true,
								speed: 300,
								slidesToShow: 1,
								arrows: false
							});
						}
					} else {
						$( 'body' ).addClass( 'no-slider' );
					}
				}
			});
		} );
	} );

	// Update footer categories
	wp.customize( 'footer_category', function( value ) {
		value.bind( function( footer_category ) {
			$.ajax({
				url: ajaxresponse.ajaxurl,
				method: 'GET',
				data: {
					action: 'preview_footer',
					cat_footer_name: footer_category
				},
				success: function( r ) {
					$( '.footer__highlighted .container' ).children().remove();
					if ( r !== 'false' ) {
						$( '.footer__highlighted .container' ).append( r );
					}
				}
			});
		} );
	} );

	wp.customize( 'footer_number', function( value ) {
		value.bind( function( footer_number ) {
			$.ajax({
				url: ajaxresponse.ajaxurl,
				method: 'GET',
				data: {
					action: 'preview_footer',
					cat_number: footer_number
				},
				success: function( r ) {
					$( '.footer__highlighted .container' ).children().remove();
					if ( r !== 'false' ) {
						$( '.footer__highlighted .container' ).append( r );
					}
				}
			});
		} );
	} );

})( jQuery );
