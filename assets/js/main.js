/**
 * RankCraft Web - Main JS
 * Lightweight scroll-reveal animation, no external dependencies.
 */

document.addEventListener( 'DOMContentLoaded', function () {
	// Feature-detect first: if IntersectionObserver isn't available,
	// skip the opacity/transform setup entirely rather than leaving
	// content permanently invisible with no way to reveal it. Same for
	// visitors who've asked their OS/browser for reduced motion.
	const prefersReducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	if ( 'IntersectionObserver' in window && ! prefersReducedMotion ) {
		const revealEls = document.querySelectorAll( '.service-card, .step, .stat, .experience-item' );

		const observer = new IntersectionObserver( ( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					entry.target.style.opacity = '1';
					entry.target.style.transform = 'translateY(0)';
					observer.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.15 } );

		revealEls.forEach( ( el ) => {
			el.style.opacity = '0';
			el.style.transform = 'translateY(16px)';
			el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
			observer.observe( el );
		} );
	}

	/**
	 * Mobile nav toggle.
	 */
	const navToggle = document.querySelector( '.nav-toggle' );
	const navWrap = document.querySelector( '.header-nav-wrap' );
	const siteHeader = document.querySelector( '.site-header' );

	if ( navToggle && navWrap ) {
		// Keyboard focus and screen readers shouldn't be able to reach
		// content behind the open mobile nav overlay. Everything at the
		// body's top level except the header (which holds the toggle and
		// the nav itself) gets marked inert while the nav is open.
		const setBackgroundInert = ( isInert ) => {
			Array.from( document.body.children ).forEach( ( child ) => {
				if ( child === siteHeader ) {
					return;
				}
				if ( isInert ) {
					child.setAttribute( 'inert', '' );
				} else {
					child.removeAttribute( 'inert' );
				}
			} );
		};

		const closeNav = () => {
			navWrap.classList.remove( 'is-open' );
			navToggle.classList.remove( 'is-active' );
			navToggle.setAttribute( 'aria-expanded', 'false' );
			document.body.style.overflow = '';
			setBackgroundInert( false );
		};

		navToggle.addEventListener( 'click', () => {
			const isOpen = navWrap.classList.toggle( 'is-open' );
			navToggle.classList.toggle( 'is-active', isOpen );
			navToggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );

			if ( isOpen ) {
				// .header-nav-wrap is position:fixed on mobile so it can
				// reach the bottom of the viewport regardless of how much
				// content is behind it; its top has to be set here since
				// "fixed" can't inherit it from the header via CSS alone.
				if ( siteHeader ) {
					navWrap.style.top = siteHeader.getBoundingClientRect().bottom + 'px';
				}
				document.body.style.overflow = 'hidden';
				setBackgroundInert( true );
			} else {
				document.body.style.overflow = '';
				setBackgroundInert( false );
			}
		} );

		navWrap.querySelectorAll( 'a' ).forEach( ( link ) => {
			link.addEventListener( 'click', closeNav );
		} );

		document.addEventListener( 'keydown', ( e ) => {
			if ( e.key === 'Escape' ) {
				closeNav();
			}
		} );
	}
} );
