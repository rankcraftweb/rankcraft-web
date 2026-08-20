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
} );
