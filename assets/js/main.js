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
		const revealEls = document.querySelectorAll( '.service-card, .step, .stat, .process-step' );

		const observer = new IntersectionObserver( ( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					entry.target.style.opacity = '1';
					entry.target.style.transform = 'translateY(0)';
					observer.unobserve( entry.target );

					// Hand the element back to the stylesheet once it has
					// arrived. The inline transition set below is 0.5s and
					// only lists opacity and transform, which beat the CSS on
					// specificity: card hovers would run at half a second and
					// their shadow and border would snap rather than ease.
					entry.target.addEventListener( 'transitionend', () => {
						entry.target.style.transition = '';
						entry.target.style.transform = '';
						entry.target.style.opacity = '';
					}, { once: true } );
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
	 * Process timeline rail. Fills as the section travels up the viewport.
	 * Reduced motion gets the finished state immediately rather than an
	 * empty track, since the rail is part of the design and not decoration.
	 */
	const railProgress = document.querySelector( '.process-rail-progress' );
	const timeline = document.querySelector( '.process-timeline' );

	if ( railProgress && timeline ) {
		if ( prefersReducedMotion ) {
			railProgress.style.height = '100%';
		} else {
			let ticking = false;

			const updateRail = () => {
				const box = timeline.getBoundingClientRect();
				// Start filling when the timeline's top passes 60% down the
				// viewport, so the rail is already moving by the time the
				// first step is comfortably readable.
				const travelled = window.innerHeight * 0.6 - box.top;
				const ratio = box.height ? travelled / box.height : 0;
				railProgress.style.height = Math.min( Math.max( ratio, 0 ), 1 ) * 100 + '%';
				ticking = false;
			};

			const onScroll = () => {
				if ( ! ticking ) {
					ticking = true;
					window.requestAnimationFrame( updateRail );
				}
			};

			window.addEventListener( 'scroll', onScroll, { passive: true } );
			window.addEventListener( 'resize', onScroll, { passive: true } );
			updateRail();
		}
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
