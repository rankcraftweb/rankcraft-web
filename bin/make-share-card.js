/**
 * Renders a 1200x630 share card in the house style.
 *
 * The blog cards in assets/images were all built to the same pattern -
 * navy field, a flat two-tone motif, a bold white line and a green
 * second line - but nothing in the repo could reproduce one, so each
 * new card meant rebuilding the recipe from a screenshot. This is that
 * recipe, written down.
 *
 * 1200x630 is the size every platform documents, and it is what
 * inc/seo-meta.php's 'rankcraft-og' size crops to. Authoring at exactly
 * that ratio means WordPress serves the original untouched and nothing
 * is cropped.
 *
 * Poppins is loaded from assets/fonts rather than Google Fonts so the
 * card renders identically with no network, and so the weights match
 * the ones the site actually ships.
 *
 *   node bin/make-share-card.js \
 *     --title "Website Designer in Dasmariñas" \
 *     --subtitle "Six local sites measured. Not one was quick." \
 *     --icon bin/lib/card-icons/map-pin.svg \
 *     --out assets/images/geo-dasmarinas.png
 *
 * --icon is optional; without it the card is type only. Long titles
 * shrink to fit rather than wrapping into the subtitle, because a card
 * that overflows is worse than one set a few points smaller.
 */

const fs = require( 'fs' );
const path = require( 'path' );
const { launch } = require( './lib/find-playwright' );

const ROOT = path.join( __dirname, '..' );
const FONT_DIR = path.join( ROOT, 'assets', 'fonts' );

const WIDTH = 1200;
const HEIGHT = 630;

const NAVY = '#0C2A4A';
const WHITE = '#FFFFFF';
const GREEN_LIGHT = '#63C89F';

function parseArgs( argv ) {
	const out = {};
	for ( let i = 0; i < argv.length; i += 2 ) {
		const key = argv[ i ];
		if ( ! key.startsWith( '--' ) ) {
			throw new Error( 'Unexpected argument: ' + key );
		}
		if ( argv[ i + 1 ] === undefined ) {
			throw new Error( 'Missing value for ' + key );
		}
		out[ key.slice( 2 ) ] = argv[ i + 1 ];
	}
	return out;
}

/**
 * woff2 as a data URI. Embedding beats a file:// @font-face src, which
 * Chromium refuses to load when the page itself is set via setContent
 * and therefore has no origin to resolve against.
 */
function fontFace( family, weight, files ) {
	const found = files
		.map( ( f ) => path.join( FONT_DIR, f ) )
		.filter( ( f ) => fs.existsSync( f ) );

	if ( ! found.length ) {
		throw new Error( 'No font files found for weight ' + weight + ' in ' + FONT_DIR );
	}

	return found
		.map( ( f ) => {
			const b64 = fs.readFileSync( f ).toString( 'base64' );
			return `@font-face{font-family:'${ family }';font-weight:${ weight };font-style:normal;` +
				`src:url(data:font/woff2;base64,${ b64 }) format('woff2');}`;
		} )
		.join( '\n' );
}

function buildHtml( { title, subtitle, iconSvg } ) {
	const fonts = [
		fontFace( 'Poppins', 500, [ 'poppins-500-latin.woff2', 'poppins-500-latin-ext.woff2' ] ),
		fontFace( 'Poppins', 700, [ 'poppins-700-latin.woff2', 'poppins-700-latin-ext.woff2' ] ),
	].join( '\n' );

	return `<!DOCTYPE html>
<html><head><meta charset="utf-8"><style>
${ fonts }
*{margin:0;padding:0;box-sizing:border-box}
html,body{width:${ WIDTH }px;height:${ HEIGHT }px;overflow:hidden}
body{
	background:${ NAVY };
	font-family:'Poppins',sans-serif;
	display:flex;flex-direction:column;
	align-items:center;justify-content:center;
	gap:52px;
	padding:0 90px;
	text-align:center;
	-webkit-font-smoothing:antialiased;
}
.icon{width:300px;height:150px;flex:none}
.icon svg{width:100%;height:100%;display:block}
h1{
	font-weight:700;color:${ WHITE };
	font-size:64px;line-height:1.12;letter-spacing:-0.5px;
	white-space:nowrap;
}
p{
	font-weight:500;color:${ GREEN_LIGHT };
	font-size:29px;line-height:1.35;margin-top:18px;
}
</style></head><body>
${ iconSvg ? `<div class="icon">${ iconSvg }</div>` : '' }
<div>
	<h1 id="title">${ title }</h1>
	${ subtitle ? `<p>${ subtitle }</p>` : '' }
</div>
</body></html>`;
}

/**
 * Shrink the headline until it fits the padded width. Runs in the page
 * because only the browser knows how wide the text actually is once
 * Poppins has loaded.
 */
function fitTitle() {
	const el = document.getElementById( 'title' );
	// 130px of clear space each side. Not just taste: several platforms
	// crop a share card's edges to fit their own frame, and a headline
	// set to the full padded width is the one that loses its last word.
	const max = document.body.clientWidth - 260;
	let size = 64;
	while ( el.scrollWidth > max && size > 34 ) {
		size -= 1;
		el.style.fontSize = size + 'px';
	}
	// Still too wide at the floor: let it wrap rather than clip.
	if ( el.scrollWidth > max ) {
		el.style.whiteSpace = 'normal';
	}
	return size;
}

( async () => {
	const args = parseArgs( process.argv.slice( 2 ) );

	if ( ! args.title || ! args.out ) {
		console.error( 'Usage: node bin/make-share-card.js --title "..." [--subtitle "..."] [--icon file.svg] --out file.png' );
		process.exit( 1 );
	}

	let iconSvg = '';
	if ( args.icon ) {
		iconSvg = fs.readFileSync( path.resolve( args.icon ), 'utf8' );
	}

	const browser = await launch();
	const page = await browser.newPage( {
		viewport: { width: WIDTH, height: HEIGHT },
		deviceScaleFactor: 1,
	} );

	await page.setContent( buildHtml( { title: args.title, subtitle: args.subtitle, iconSvg } ) );
	await page.evaluate( () => document.fonts.ready );
	const size = await page.evaluate( fitTitle );

	const out = path.resolve( args.out );
	fs.mkdirSync( path.dirname( out ), { recursive: true } );
	await page.screenshot( { path: out } );
	await browser.close();

	console.log( 'Saved ' + out );
	console.log( WIDTH + 'x' + HEIGHT + ', headline set at ' + size + 'px' );
} )().catch( ( e ) => {
	console.error( e.message );
	process.exit( 1 );
} );
