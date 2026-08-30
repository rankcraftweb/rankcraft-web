#!/usr/bin/env node
/**
 * Takes a real screenshot of a page or one element on it.
 *
 * This exists because measurements are not enough. Three separate design
 * problems shipped past a full set of passing checks in one afternoon: an
 * illustration floating in a half-empty frame, a set of drawings too pale
 * to register against the cards holding them, and a card whose contents
 * were in the wrong order. Every one of those measured identically to the
 * version that replaced it - same box, same height, no overflow. Layout
 * can be checked mechanically. Whether something looks right cannot.
 *
 * It also works where the editor's own browser pane does not:
 * IntersectionObserver never fires there while the pane is hidden, so
 * anything behind a scroll reveal photographs as a blank rectangle.
 *
 * Usage:
 *   node bin/screenshot.js https://rankcraftweb.com/
 *   node bin/screenshot.js https://rankcraftweb.com/ --out home.png
 *   node bin/screenshot.js https://rankcraftweb.com/ --selector "#services .services-grid"
 *   node bin/screenshot.js http://localhost:8080/ --width 375 --full
 *
 * Options:
 *   --out <file>       where to write it (default screenshot.png)
 *   --selector <css>   photograph one element rather than the viewport
 *   --width <px>       viewport width (default 1280)
 *   --height <px>      viewport height (default 900)
 *   --full             capture the whole scrollable page
 *
 * Needs Playwright, which is resolved from wherever it already lives.
 * See bin/lib/find-playwright.js.
 */

const { launch } = require( './lib/find-playwright' );

function parseArgs( argv ) {
	const opts = {
		url: null,
		out: 'screenshot.png',
		selector: null,
		width: 1280,
		height: 900,
		full: false,
	};

	for ( let i = 0; i < argv.length; i++ ) {
		const arg = argv[ i ];
		if ( arg === '--full' ) {
			opts.full = true;
		} else if ( arg === '--out' ) {
			opts.out = argv[ ++i ];
		} else if ( arg === '--selector' ) {
			opts.selector = argv[ ++i ];
		} else if ( arg === '--width' ) {
			opts.width = parseInt( argv[ ++i ], 10 );
		} else if ( arg === '--height' ) {
			opts.height = parseInt( argv[ ++i ], 10 );
		} else if ( ! opts.url ) {
			opts.url = arg;
		}
	}

	return opts;
}

async function main() {
	const opts = parseArgs( process.argv.slice( 2 ) );

	if ( ! opts.url ) {
		console.error( 'Usage: node bin/screenshot.js <url> [--out file.png] [--selector css] [--width px] [--full]' );
		process.exit( 1 );
	}

	const browser = await launch();

	// deviceScaleFactor 2 so the result is legible when you actually look
	// at it rather than a soft approximation of the thing being judged.
	const page = await browser.newPage( {
		viewport: { width: opts.width, height: opts.height },
		deviceScaleFactor: 2,
	} );

	await page.goto( opts.url, { waitUntil: 'load', timeout: 30000 } );

	// Walk the page so the scroll reveal has run. Shooting straight after
	// load catches everything below the fold at opacity 0, which comes out
	// as a blank rectangle and looks exactly like a broken page.
	await page.evaluate( async () => {
		for ( let y = 0; y < document.body.scrollHeight; y += 400 ) {
			window.scrollTo( 0, y );
			await new Promise( ( r ) => setTimeout( r, 100 ) );
		}
		window.scrollTo( 0, 0 );
	} );

	await page.waitForTimeout( 1200 );

	if ( opts.selector ) {
		const target = page.locator( opts.selector ).first();
		if ( await target.count() === 0 ) {
			console.error( 'No element matched: ' + opts.selector );
			await browser.close();
			process.exit( 1 );
		}
		await target.screenshot( { path: opts.out } );
	} else {
		await page.screenshot( { path: opts.out, fullPage: opts.full } );
	}

	console.log( 'Saved ' + opts.out );
	console.log( opts.selector ? 'Element: ' + opts.selector : ( opts.full ? 'Full page' : 'Viewport' ) );
	console.log( 'Width:   ' + opts.width + 'px at 2x' );

	await browser.close();
}

main().catch( ( e ) => {
	console.error( e );
	process.exit( 2 );
} );
