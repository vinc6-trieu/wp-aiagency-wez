/**
 * Scroll-triggered visibility for Home V1 sections.
 *
 * @package aiagency-wez
 */
(function () {
	'use strict';

	var root = document.documentElement;
	if ( ! root.classList.contains( 'home-v1-reveal-js' ) ) {
		return;
	}

	var sections = document.querySelectorAll( '.home-v1-page .home-v1-section' );
	if ( ! sections.length ) {
		return;
	}

	function reveal( entries, observer ) {
		entries.forEach( function ( entry ) {
			if ( ! entry.isIntersecting ) {
				return;
			}
			entry.target.classList.add( 'home-v1-section--in-view' );
			observer.unobserve( entry.target );
		} );
	}

	if ( ! ( 'IntersectionObserver' in window ) ) {
		sections.forEach( function ( section ) {
			section.classList.add( 'home-v1-section--in-view' );
		} );
		return;
	}

	var observer = new IntersectionObserver( reveal, {
		root: null,
		rootMargin: '0px 0px -6% 0px',
		threshold: 0.06,
	} );

	sections.forEach( function ( section ) {
		observer.observe( section );
	} );
}());
