/**
 * RankCraft Web - Main JS
 * Lightweight scroll-reveal animation, no external dependencies.
 */

document.addEventListener( 'DOMContentLoaded', function () {
	const revealEls = document.querySelectorAll( '.service-card, .step, .stat' );

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

	/**
	 * Mobile nav toggle.
	 */
	const navToggle = document.querySelector( '.nav-toggle' );
	const navWrap = document.querySelector( '.header-nav-wrap' );
	const siteHeader = document.querySelector( '.site-header' );

	if ( navToggle && navWrap ) {
		const closeNav = () => {
			navWrap.classList.remove( 'is-open' );
			navToggle.classList.remove( 'is-active' );
			navToggle.setAttribute( 'aria-expanded', 'false' );
			document.body.style.overflow = '';
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
			} else {
				document.body.style.overflow = '';
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
