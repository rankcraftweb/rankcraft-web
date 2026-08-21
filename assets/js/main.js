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

	if ( navToggle && navWrap ) {
		const closeNav = () => {
			navWrap.classList.remove( 'is-open' );
			navToggle.classList.remove( 'is-active' );
			navToggle.setAttribute( 'aria-expanded', 'false' );
		};

		navToggle.addEventListener( 'click', () => {
			const isOpen = navWrap.classList.toggle( 'is-open' );
			navToggle.classList.toggle( 'is-active', isOpen );
			navToggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
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
