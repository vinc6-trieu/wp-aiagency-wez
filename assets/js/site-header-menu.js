/**
 * Toggle primary navigation on small screens.
 *
 * @package aiagency-wez
 */
(function () {
	'use strict';

	var mq = window.matchMedia( '(max-width: 899px)' );
	var header = document.querySelector( '.site-header' );
	if ( ! header ) {
		return;
	}

	var btn = header.querySelector( '.site-header__menu-toggle' );
	var panel = header.querySelector( '#site-header-primary-menu' );
	if ( ! btn || ! panel ) {
		return;
	}

	function setOpen( open ) {
		header.classList.toggle( 'site-header--nav-open', open );
		btn.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
	}

	function close() {
		setOpen( false );
	}

	btn.addEventListener( 'click', function () {
		if ( ! mq.matches ) {
			return;
		}
		setOpen( ! header.classList.contains( 'site-header--nav-open' ) );
	} );

	function onMqChange() {
		if ( ! mq.matches ) {
			close();
		}
	}

	if ( typeof mq.addEventListener === 'function' ) {
		mq.addEventListener( 'change', onMqChange );
	} else if ( typeof mq.addListener === 'function' ) {
		mq.addListener( onMqChange );
	}

	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' ) {
			close();
		}
	} );

	panel.addEventListener( 'click', function ( e ) {
		if ( ! mq.matches ) {
			return;
		}
		var t = e.target;
		if ( t.closest && t.closest( 'a' ) ) {
			close();
		}
	} );
} )();
