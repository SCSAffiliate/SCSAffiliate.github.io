/**
 * File common.js.
 */

var $ = jQuery.noConflict();

$( document ).ready(function($){

	$( '#navigation > .menu-item-has-children, #navigation > .page_item_has_children' ).addClass( 'dropdown' );

	$( '.portfolio-nav .next' ).click(function(){
		location.href = $( this ).attr( 'href' );
	});

	var body = $( 'body' );

	body.jpreLoader({
		loaderVPos: '50%',
		showSplash: true,
		showPercentage: false
	});

	var viewportWidth = $( 'body' ).innerWidth();
	var viewportHeigh = $( window ).outerHeight();

	var menuTrigger = $( '.menu-toggle' );
	var headerNav = $( '.header-nav' );

	var menuIcon = $( '.menu-icon' );

	menuTrigger.click(function(){
		$( this ).toggleClass( 'menu-open' );
		headerNav.toggleClass( 'opened' );
		body.toggleClass( 'fixed' );

	});

	headerNav.niceScroll({
		cursorcolor:'transparent',
		cursorborder: 0,
		cursorborderradius: 0,
		scrollspeed: 30,
		cursoropacitymin: 0.3,
		horizrailenabled: false
	});

}); 

