/**
 * Home V1 Projects modal (image click => description popup).
 *
 * @package aiagency-wez
 */
(function () {
	'use strict';

	function isShown( el ) {
		return el && ! el.hasAttribute( 'hidden' );
	}

	function getFocusable( root ) {
		if ( ! root ) {
			return [];
		}
		var selectors = [
			'a[href]',
			'button:not([disabled])',
			'input:not([disabled])',
			'select:not([disabled])',
			'textarea:not([disabled])',
			'[tabindex]:not([tabindex="-1"])',
		];
		return Array.prototype.slice
			.call( root.querySelectorAll( selectors.join( ',' ) ) )
			.filter( function ( el ) {
				return el.offsetParent !== null;
			} );
	}

	function setText( el, value ) {
		if ( ! el ) {
			return;
		}
		el.textContent = value || '';
	}

	function setup() {
		var modal = document.querySelector( '[data-aiagency-wez-project-popup="true"]' );
		if ( ! modal ) {
			return;
		}

		var dialog = modal.querySelector( '.home-v1-project-popup__dialog' );
		var titleEl = modal.querySelector( '#home-v1-project-popup-title' );
		var categoryEl = modal.querySelector( '#home-v1-project-popup-category' );
		var descriptionEl = modal.querySelector( '#home-v1-project-popup-description' );
		var closeButton = modal.querySelector( '.home-v1-project-popup__close' );

		var lastTrigger = null;

		function open( trigger ) {
			if ( isShown( modal ) ) {
				return;
			}
			if ( ! trigger ) {
				return;
			}

			var title = trigger.getAttribute( 'data-project-title' ) || '';
			var category = trigger.getAttribute( 'data-project-category' ) || '';
			var description = trigger.getAttribute( 'data-project-description' ) || '';

			if ( ! description ) {
				return;
			}

			lastTrigger = trigger;
			setText( titleEl, title );
			setText( categoryEl, category );
			setText( descriptionEl, description );

			if ( categoryEl ) {
				categoryEl.style.display = category ? '' : 'none';
			}
			if ( titleEl ) {
				titleEl.style.display = title ? '' : 'none';
			}

			modal.removeAttribute( 'hidden' );
			document.documentElement.classList.add( 'home-v1-project-popup-open' );

			window.setTimeout( function () {
				if ( closeButton ) {
					closeButton.focus();
				} else if ( dialog ) {
					dialog.focus();
				}
			}, 0 );
		}

		function close() {
			if ( ! isShown( modal ) ) {
				return;
			}
			modal.setAttribute( 'hidden', 'hidden' );
			document.documentElement.classList.remove( 'home-v1-project-popup-open' );

			var next = lastTrigger;
			lastTrigger = null;
			if ( next && typeof next.focus === 'function' ) {
				next.focus();
			}
		}

		document.addEventListener( 'click', function ( ev ) {
			if ( ev.defaultPrevented ) {
				return;
			}

			var trigger = ev.target.closest( '[data-aiagency-wez-project-popup-trigger="true"]' );
			if ( trigger ) {
				ev.preventDefault();
				open( trigger );
				return;
			}

			if ( ! isShown( modal ) ) {
				return;
			}

			if ( ev.target.closest( '[data-aiagency-wez-project-popup-close="true"]' ) ) {
				ev.preventDefault();
				close();
			}
		} );

		document.addEventListener( 'keydown', function ( ev ) {
			if ( ! isShown( modal ) ) {
				return;
			}

			if ( ev.key === 'Escape' ) {
				ev.preventDefault();
				close();
				return;
			}

			if ( ev.key !== 'Tab' ) {
				return;
			}

			var focusables = getFocusable( dialog );
			if ( ! focusables.length ) {
				ev.preventDefault();
				return;
			}

			var active = document.activeElement;
			var first = focusables[0];
			var last = focusables[focusables.length - 1];

			if ( ev.shiftKey ) {
				if ( active === first || active === dialog ) {
					ev.preventDefault();
					last.focus();
				}
				return;
			}

			if ( active === last ) {
				ev.preventDefault();
				first.focus();
			}
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', setup );
	} else {
		setup();
	}
}());

