/**
 * Same-page anchor navigation: smooth scroll without full document reload.
 *
 * @package aiagency-wez
 */
(function () {
	'use strict';

	var aliases = ( window.aiagencyWezSmoothNav && window.aiagencyWezSmoothNav.p ) || [];

	function pathsAreSameDocument( pathLink, pathHere ) {
		if ( pathLink === pathHere ) {
			return true;
		}
		if ( ! aliases.length ) {
			return false;
		}
		return aliases.indexOf( pathLink ) !== -1 && aliases.indexOf( pathHere ) !== -1;
	}

	function getHeaderOffset() {
		var header =
			document.querySelector( '.site-header--home-v1' ) ||
			document.querySelector( '.site-header' );
		if ( ! header ) {
			return 0;
		}
		return header.getBoundingClientRect().height;
	}

	function scrollToId( id ) {
		var el = document.getElementById( id );
		if ( ! el ) {
			return false;
		}
		var prefersReduced =
			window.matchMedia &&
			window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
		var top = el.getBoundingClientRect().top + window.scrollY - getHeaderOffset() - 12;
		window.scrollTo( {
			top: Math.max( 0, top ),
			behavior: prefersReduced ? 'auto' : 'smooth',
		} );
		return true;
	}

	document.addEventListener(
		'click',
		function ( ev ) {
			if ( ev.defaultPrevented ) {
				return;
			}
			if ( ev.button !== 0 ) {
				return;
			}
			if ( ev.ctrlKey || ev.metaKey || ev.shiftKey || ev.altKey ) {
				return;
			}

			var anchor = ev.target.closest( 'a[href*="#"]' );
			if ( ! anchor ) {
				return;
			}
			if ( anchor.getAttribute( 'download' ) ) {
				return;
			}
			var targetAttr = anchor.getAttribute( 'target' );
			if ( targetAttr && targetAttr.toLowerCase() === '_blank' ) {
				return;
			}

			try {
				var url = new URL( anchor.getAttribute( 'href' ), window.location.href );
				if ( url.origin !== window.location.origin ) {
					return;
				}
				var pathHere = window.location.pathname.replace( /\/$/, '' ) || '/';
				var pathLink = url.pathname.replace( /\/$/, '' ) || '/';
				if ( ! pathsAreSameDocument( pathLink, pathHere ) ) {
					return;
				}
				var hash = url.hash;
				if ( ! hash || hash === '#' ) {
					return;
				}
				var id = decodeURIComponent( hash.slice( 1 ) );
				if ( ! id ) {
					return;
				}
				if ( ! document.getElementById( id ) ) {
					return;
				}

				ev.preventDefault();
				if ( scrollToId( id ) ) {
					history.pushState( null, '', hash );
					anchor.blur();
				}
			} catch ( err ) {
				return;
			}
		},
		false
	);

	/* Initial load with hash (e.g. shared link): scroll after layout, no reload. */
	if ( window.location.hash && window.location.hash.length > 1 ) {
		window.requestAnimationFrame( function () {
			var id = decodeURIComponent( window.location.hash.slice( 1 ) );
			if ( id && document.getElementById( id ) ) {
				scrollToId( id );
			}
		} );
	}
}());
