/**
 * Customizer Live Preview
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Ctpress
 */

( function( $ ) {

	/*menu search box*/
	wp.customize( 'ctpress[menu_search]', function( values ) {	
		values.bind( function( value ) {
			if ( value ) {
				$(".navbar .attr-nav").addClass("d-none");
			} else {
				$(".navbar .attr-nav").removeClass("d-none");
			}
		} );
	} );

	/*menu search box*/
	wp.customize( 'ctpress[theme_bg_color]', function( value ) {	
		value.bind( function( res ) {
			if ( res ) {
				$(":root").css('--theme-bg-color',res);
			} 
		} );
	} );

	/*page heading position change box*/
	wp.customize( 'ctpress[page-heading]', function( value ) {	
		value.bind( function( heading ) {
			if ( heading == 1 ) {
				$('figure.img-holder').insertBefore('.title-holder');
			} else {
				$('.title-holder').insertBefore('figure.img-holder');
			}
		} );
	} );

	/*menu search box*/
	wp.customize( 'ctpress[page_img_cap]', function( value ) {	
		value.bind( function( res ) {
			if ( res ) {
				$(".img-layer-thumb").addClass('d-none');
			} else {
				$(".img-layer-thumb").removeClass('d-none');
			}
		} );
	} );

	/*Post featured image caption hide/show*/
	wp.customize( 'ctpress[post_img_cap]', function( value ) {	
		value.bind( function( res ) {
			if ( res ) {
				$(".img-layer-thumb").addClass('d-none');
			} else {
				$(".img-layer-thumb").removeClass('d-none');
			}
		} );
	} );


	/*Post Navigation settings*/
	wp.customize( 'ctpress[post-navigation]', function( value ) {	
		value.bind( function( navigation ) {
			if ( navigation ) {
				$(".post-navigation").addClass('d-none');
			} else {
				$(".post-navigation").removeClass('d-none');
			}
		} );
	} );

	/*Post Tags settings*/
	wp.customize( 'ctpress[post-tags]', function( value ) {	
		value.bind( function( tag ) {
			if ( tag ) {
				$(".post-tags").addClass('d-none');
			} else {
				$(".post-tags").removeClass('d-none');
			}
		} );
	} );

	/*Post comment hide/show*/
	wp.customize( 'ctpress[post-comment]', function( value ) {	
		value.bind( function( res ) {
			if ( res ) {
				$(".comment-area").addClass('d-none');
			} else {
				$(".comment-area").removeClass('d-none');
			}
		} );
	} );

	/*menu search box*/
	wp.customize( 'ctpress[theme_color]', function( value ) {	
		value.bind( function( res ) {
			if ( res ) {
				$(":root").css('--theme-color',res);
			} 
		} );
	} );

	/*post heading position change box*/
	wp.customize( 'ctpress[post-heading]', function( value ) {	
		value.bind( function( heading ) {
			if ( heading == 1 ) {
				$('figure.img-holder').insertBefore('.title-holder');
			} else {
				$('.title-holder').insertBefore('figure.img-holder');
			}
		} );
	} );

	/*menu search box*/
	wp.customize( 'ctpress[post-screen]', function( value ) {	
		value.bind( function( screen ) {

			switch ( screen ) {
				case "1":
					$('.page_main_wrapper .row .col-md-8').insertBefore('.col-md-4');
					break;
				case "2":
					$('.page_main_wrapper .row .col-md-4').insertBefore('.col-md-8');
					break;
				case "3":
					$('.page_main_wrapper .row .col-md-4').addClass('d-none');
					$('.page_main_wrapper .row .col-md-8').addClass('mx-auto');
					break;
				case "4":
					$('.page_main_wrapper .row .col-md-4').addClass('d-none');
					$('.page_main_wrapper .row .col-md-8').addClass('mx-auto');
					break;
				default:
					console.log('default' + screen);
					break;
			}
		} );
	} );
	
	// Credit Link checkbox.
	wp.customize( 'ctpress[credit_link]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				$( 'body' ).addClass( 'credit-link-hidden' );
			} else {
				$( 'body' ).removeClass( 'credit-link-hidden' );
			}
		} );
	} );


	/*Header social button hide/show*/
	wp.customize( 'ctpress[header_social]', function( value ) {	
		value.bind( function( res ) {
			if ( res ) {
				$(".header-social").addClass('d-none');
			} else {
				$(".header-social").removeClass('d-none');
			}
		} );
	} );

	/*Footer social button hide/show*/
	wp.customize( 'ctpress[footer_social]', function( value ) {	
		value.bind( function( res ) {
			if ( res ) {
				$(".footer-box .social-connect").addClass('d-none');
			} else {
				$(".footer-box .social-connect").removeClass('d-none');
			}
		} );
	} );

} )( jQuery );
