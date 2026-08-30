/**
 * Locates Playwright wherever it already lives on this machine.
 *
 * This theme has no build step and no package.json, so adding a
 * dependency for two dev scripts would mean introducing both. Playwright
 * is already present via the npx cache, so find that copy instead.
 *
 * The cache can hold several versions side by side, each expecting a
 * particular Chromium build. Taking the first one found is how this
 * failed the first time: the copy it grabbed wanted a browser revision
 * that had never been downloaded. Prefer a copy whose browser is
 * actually on disk, and keep any other as a fallback for the
 * system-Chrome path in launch() below.
 */

const fs = require( 'fs' );
const path = require( 'path' );
const os = require( 'os' );

function findPlaywright() {
	try {
		return require( 'playwright' );
	} catch ( e ) {
		// Not installed locally; fall through to the cache search.
	}

	const cache = path.join( os.homedir(), 'AppData', 'Local', 'npm-cache', '_npx' );
	let entries = [];
	try {
		entries = fs.readdirSync( cache );
	} catch ( e ) {
		entries = [];
	}

	let fallback = null;

	for ( const entry of entries ) {
		const candidate = path.join( cache, entry, 'node_modules', 'playwright' );
		if ( ! fs.existsSync( candidate ) ) {
			continue;
		}

		let mod;
		try {
			mod = require( candidate );
		} catch ( e ) {
			continue;
		}

		try {
			if ( fs.existsSync( mod.chromium.executablePath() ) ) {
				return mod;
			}
		} catch ( e ) {
			// executablePath() throws when nothing is registered at all.
		}

		fallback = fallback || mod;
	}

	if ( fallback ) {
		return fallback;
	}

	console.error( 'Could not find Playwright.' );
	console.error( 'Install it with:  npm i -D playwright' );
	console.error( '(the Chromium binary itself is usually already cached)' );
	process.exit( 2 );
}

/**
 * Launches Chromium, falling back to the Chrome already installed on the
 * machine if the bundled browser is missing or the wrong revision. These
 * scripts only measure and photograph layout, so the exact build does
 * not matter.
 */
async function launch() {
	const { chromium } = findPlaywright();

	try {
		return await chromium.launch();
	} catch ( e ) {
		console.log( 'Bundled Chromium unavailable, using installed Chrome.\n' );
		return await chromium.launch( { channel: 'chrome' } );
	}
}

module.exports = { findPlaywright, launch };
