/**
 * Keep the mobile menu's close button where the open button is.
 *
 * Core places the overlay's close button at the top-right of the overlay's
 * padding, which rarely matches where the hamburger sits in the header
 * (the header centers it against the logo, whose height is up to the site
 * owner). When the menu opens we record the open button's position as CSS
 * custom properties on the navigation block; style.css pins the close
 * button to those coordinates. Without JS, core's default position applies.
 * With the custom Navigation Overlay template part (WP 7.1+) the Close block
 * is instead nudged onto the hamburger with a measured translate.
 */
( function () {
	function sync( nav ) {
		var open = nav.querySelector( '.wp-block-navigation__responsive-container-open' );
		if ( ! open ) {
			return;
		}
		var rect = open.getBoundingClientRect();
		nav.style.setProperty( '--shitate-nav-toggle-top', rect.top + 'px' );
		nav.style.setProperty( '--shitate-nav-toggle-right', window.innerWidth - rect.right + 'px' );
		nav.style.setProperty( '--shitate-nav-toggle-size', rect.height + 'px' );
		alignCustomClose( nav, rect );
	}

	/*
	 * Custom Navigation Overlay template part (WP 7.1+): the Close block is
	 * laid out by the site owner, so instead of repositioning it we measure
	 * how far it is from the hamburger once the overlay is open and hand the
	 * offset to CSS as a translate. Core toggles the overlay after our
	 * capture-phase listener, and fades it in with a translateY on the
	 * container, so we wait a frame and subtract the container's own
	 * (animated) offset to get the settled position.
	 */
	function alignCustomClose( nav, openRect ) {
		var container = nav.querySelector( '.wp-block-navigation__responsive-container.disable-default-overlay' );
		var close = container && container.querySelector( '.wp-block-navigation-overlay-close' );
		if ( ! close ) {
			return;
		}
		nav.style.setProperty( '--shitate-nav-close-dx', '0px' );
		nav.style.setProperty( '--shitate-nav-close-dy', '0px' );
		var measure = function () {
			var closeRect = close.getBoundingClientRect();
			var containerTop = container.getBoundingClientRect().top;
			nav.style.setProperty( '--shitate-nav-close-dx', openRect.right - closeRect.right + 'px' );
			nav.style.setProperty( '--shitate-nav-close-dy', openRect.top - ( closeRect.top - containerTop ) + 'px' );
		};
		if ( container.classList.contains( 'is-menu-open' ) ) {
			measure();
			return;
		}
		// Core adds .is-menu-open after this listener; watch for it instead of
		// polling frames (requestAnimationFrame pauses in background tabs).
		var observer = new MutationObserver( function () {
			if ( container.classList.contains( 'is-menu-open' ) ) {
				observer.disconnect();
				measure();
			}
		} );
		observer.observe( container, { attributes: true, attributeFilter: [ 'class' ] } );
		window.setTimeout( function () {
			observer.disconnect();
		}, 2000 );
	}

	function syncAll() {
		document.querySelectorAll( '.wp-block-navigation.is-responsive' ).forEach( sync );
	}

	// Measure at the moment of opening (the button is on screen then) and
	// again on resize, so rotation or a resized window keeps the alignment.
	document.addEventListener(
		'click',
		function ( event ) {
			var open = event.target.closest && event.target.closest( '.wp-block-navigation__responsive-container-open' );
			if ( open ) {
				sync( open.closest( '.wp-block-navigation' ) );
			}
		},
		true
	);
	document.addEventListener(
		'keydown',
		function ( event ) {
			if ( 'Enter' !== event.key && ' ' !== event.key ) {
				return;
			}
			var open = event.target.closest && event.target.closest( '.wp-block-navigation__responsive-container-open' );
			if ( open ) {
				sync( open.closest( '.wp-block-navigation' ) );
			}
		},
		true
	);
	window.addEventListener( 'resize', syncAll );
	syncAll();
} )();
