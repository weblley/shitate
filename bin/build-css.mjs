#!/usr/bin/env node
/**
 * Bundles the theme's front-end CSS into one minified file per variant, so a
 * page loads a single stylesheet instead of four render-blocking ones
 * (reset → tokens → utilities → style, the same order functions.php uses).
 *
 * The four source files stay the editable, readable ones: SCRIPT_DEBUG serves
 * them unbundled, and the editor always loads them. Run `npm run build:css`
 * after editing any of them and commit the result; bin/release.sh rebuilds
 * and refuses to release a stale bundle. Output is deterministic.
 */
import { readFileSync, writeFileSync } from 'node:fs';
import { resolve, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';
import { transform } from 'esbuild';

const root = resolve( dirname( fileURLToPath( import.meta.url ) ), '..' );
const read = ( file ) => readFileSync( resolve( root, file ), 'utf8' );
// style.css opens with the theme header; only style.css may carry it.
const stripHeader = ( css ) => css.replace( /^\/\*[\s\S]*?\*\/\s*/, '' );

const sources = {
	reset: read( 'assets/css/reset.css' ),
	tokens: read( 'assets/css/tokens.css' ),
	utilities: read( 'assets/css/utilities.css' ),
	style: stripHeader( read( 'style.css' ) ),
};

async function build( name, files ) {
	const input = files.map( ( f ) => sources[ f ] ).join( '\n' );
	const { code } = await transform( input, {
		loader: 'css',
		minify: true,
		legalComments: 'none',
		charset: 'utf8',
	} );
	const banner = `/* shitate: built from ${ files.map( ( f ) => ( f === 'style' ? 'style.css' : `assets/css/${ f }.css` ) ).join( ' + ' ) }. Edit those files, then run \`npm run build:css\`. */\n`;
	const out = banner + code + '\n';
	writeFileSync( resolve( root, `assets/css/${ name }.min.css` ), out );
	console.log( `assets/css/${ name }.min.css: ${ Buffer.byteLength( input ) } → ${ Buffer.byteLength( out ) } bytes` );
}

await build( 'shitate', [ 'tokens', 'utilities', 'style' ] );
await build( 'shitate-reset', [ 'reset', 'tokens', 'utilities', 'style' ] );
