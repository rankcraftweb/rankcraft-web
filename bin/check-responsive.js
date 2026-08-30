#!/usr/bin/env node
/**
 * Responsive regression check.
 *
 * Loads each page at a spread of viewport widths and reports any that
 * scroll sideways, naming the elements that stick out. Horizontal
 * overflow is the one responsive fault that is entirely objective: the
 * document is either wider than the viewport or it is not, so it can be
 * checked mechanically instead of by eye.
 *
 * This exists because three separate overflow bugs shipped unnoticed in
 * a single afternoon, all of them present for months. Each was found by
 * hand at a width nobody had thought to try. The 320px one was a footer
 * logo with a fixed width and no max-width; the other two were text
 * measures that only went wrong between the two widths being spot
 * checked. Checking eleven widths by hand is not something anyone will
 * keep doing. Running this before a deploy is.
 *
 * Usage:
 *   node bin/check-responsive.js                     # live site, all pages
 *   node bin/check-responsive.js http://localhost:8080
 *   node bin/check-responsive.js https://rankcraftweb.com/about/
 *
 * Exits 1 if any page overflows, so it can gate a deploy.
 *
 * Needs Playwright, which is resolved from wherever it already lives.
 * See bin/lib/find-playwright.js.
 */

const { launch } = require( './lib/find-playwright' );

/* Widths worth checking, and why each earns its place:
 *  320  iPhone SE 1st gen and budget Android, the narrowest in real use
 *  375  iPhone SE 2nd/3rd gen, still extremely common
 *  414  larger iPhones
 *  480  the small-phone/large-phone boundary
 *  600  small tablets in portrait
 *  768  iPad portrait, and this theme's mobile breakpoint edge
 *  769  one pixel the other side of it, where rules flip
 *  820  iPad Air portrait
 *  900  this theme's other breakpoint edge
 *  901  one pixel the other side of that
 * 1024  iPad landscape
 * 1200  the container's max-width, where side padding stops growing
 * 1440  common laptop
 */
const WIDTHS = [ 320, 375, 414, 480, 600, 768, 769, 820, 900, 901, 1024, 1200, 1440 ];

const DEFAULT_PAGES = [
	'/',
	'/about/',
	'/services/',
	'/wordpress-development/',
	'/seo-and-local-search/',
	'/performance-audits/',
	'/website-developer-silang-cavite/',
	'/portfolio/',
	'/blog/',
	'/contact/',
];

const DEFAULT_BASE = 'https://rankcraftweb.com';


/**
 * Runs inside the page. Returns the overflow verdict plus the elements
 * responsible, skipping fixed-position ones since those are positioned
 * against the viewport and routinely sit outside the document flow.
 */
function probe() {
	const docW = document.documentElement.clientWidth;
	const scrollW = document.documentElement.scrollWidth;
	const offenders = [];

	document.querySelectorAll( 'body *' ).forEach( ( el ) => {
		const box = el.getBoundingClientRect();
		if ( box.width === 0 || box.height === 0 ) {
			return;
		}
		if ( getComputedStyle( el ).position === 'fixed' ) {
			return;
		}
		if ( box.right > docW + 1 || box.left < -1 ) {
			const cls = ( el.className || '' ).toString().split( ' ' ).filter( Boolean ).slice( 0, 2 ).join( '.' );
			offenders.push( {
				sel: el.tagName.toLowerCase() + ( cls ? '.' + cls : '' ),
				right: Math.round( box.right ),
				left: Math.round( box.left ),
			} );
		}
	} );

	// Only the outermost offenders are useful. A parent that overflows
	// drags its children with it, and listing all of them buries the
	// one element actually at fault.
	const trimmed = [];
	const seen = new Set();
	for ( const o of offenders ) {
		if ( ! seen.has( o.sel ) ) {
			seen.add( o.sel );
			trimmed.push( o );
		}
	}

	return {
		docW,
		scrollW,
		overflow: scrollW > docW,
		by: scrollW - docW,
		offenders: trimmed.slice( 0, 5 ),
	};
}

async function main() {
	const args = process.argv.slice( 2 );

	// A single bare origin means "sweep the usual pages against this
	// host", which is how you point it at a staging or local copy.
	// Anything else is taken as an explicit list of pages to check.
	let targets;
	if ( args.length === 0 ) {
		targets = DEFAULT_PAGES.map( ( p ) => DEFAULT_BASE + p );
	} else if ( args.length === 1 && new URL( args[ 0 ] ).pathname === '/' ) {
		targets = DEFAULT_PAGES.map( ( p ) => args[ 0 ].replace( /\/$/, '' ) + p );
	} else {
		targets = args;
	}

	const browser = await launch();

	const failures = [];

	for ( const url of targets ) {
		const results = [];

		for ( const width of WIDTHS ) {
			const context = await browser.newContext( { viewport: { width, height: 900 } } );
			const page = await context.newPage();

			try {
				await page.goto( url, { waitUntil: 'load', timeout: 30000 } );
				// Lazy images and the reveal observer both settle after
				// load; without this pause the measurements catch the
				// page mid-flight and report phantom results.
				await page.waitForTimeout( 400 );
				const r = await page.evaluate( probe );
				results.push( { width, ...r } );
				if ( r.overflow ) {
					failures.push( { url, width, ...r } );
				}
			} catch ( e ) {
				results.push( { width, error: e.message.split( '\n' )[ 0 ] } );
				failures.push( { url, width, error: e.message.split( '\n' )[ 0 ] } );
			}

			await context.close();
		}

		const bad = results.filter( ( r ) => r.overflow || r.error );
		const label = bad.length === 0 ? 'ok' : bad.length + ' failing';
		console.log( '\n' + url + '  [' + label + ']' );

		for ( const r of results ) {
			if ( r.error ) {
				console.log( '  ' + String( r.width ).padStart( 4 ) + '  ERROR  ' + r.error );
			} else if ( r.overflow ) {
				console.log( '  ' + String( r.width ).padStart( 4 ) + '  OVERFLOW by ' + r.by + 'px' );
				for ( const o of r.offenders ) {
					console.log( '        ' + o.sel + '  (right ' + o.right + ' vs ' + r.docW + ')' );
				}
			} else {
				console.log( '  ' + String( r.width ).padStart( 4 ) + '  ok' );
			}
		}
	}

	await browser.close();

	console.log( '\n' + '-'.repeat( 52 ) );
	if ( failures.length === 0 ) {
		console.log( 'No horizontal overflow at any width.' );
		process.exit( 0 );
	}

	console.log( failures.length + ' failing width' + ( failures.length === 1 ? '' : 's' ) + ':' );
	for ( const f of failures ) {
		console.log( '  ' + f.width + 'px  ' + f.url + ( f.error ? '  ' + f.error : '  by ' + f.by + 'px' ) );
	}
	process.exit( 1 );
}

main().catch( ( e ) => {
	console.error( e );
	process.exit( 2 );
} );
