#!/usr/bin/env node
/**
 * languages/ のカタログを「この版で出荷するファイルだけ」の内容に作り直す。
 *
 * 文字列の抽出と辞書はプラグイン側（plugins/shitate-pro-blocks/bin/make-i18n.mjs）に
 * あり、テーマのフォルダを丸ごと走査する。bin/deferred-patterns.txt のパターンを
 * 配布zipから落とすと、カタログにはもう出荷しない文字列（＝辞書が無いので未訳）が
 * 残り、bin/build-zip.sh の未訳ガードに引っかかる。
 *
 * そこで、見送るパターン「だけ」に出てくる msgid をカタログから取り除く。
 * make-i18n.mjs と同じ正規表現で抽出するので、結果は「見送る12本が無い状態で
 * make-i18n.mjs を走らせたカタログ」と一致する（辞書が無い＝未訳の行だけが消える）。
 * 出荷するファイルでも使われている文字列は残す。
 *
 * 使い方: node bin/trim-deferred-i18n.mjs
 *   作り直すのは languages/shitate.pot / shitate-<locale>.po と、対応する .mo。
 *   12本を出荷する版では bin/deferred-patterns.txt を空にして、代わりに
 *   make-i18n.mjs を走らせる（このスクリプトは何もしなくなる）。
 */
import fs from 'node:fs';
import path from 'node:path';
import { execFileSync } from 'node:child_process';

const ROOT = path.resolve( import.meta.dirname, '..' );
const LANG = path.join( ROOT, 'languages' );
const DOMAIN = 'shitate';

// ---- make-i18n.mjs と同じ抽出 ----
const FUNCS = '(?:__|_e|esc_html__|esc_html_e|esc_attr__|esc_attr_e)';
const RE_S = new RegExp( FUNCS + "\\(\\s*'((?:[^'\\\\]|\\\\.)*)'\\s*,\\s*'" + DOMAIN + "'\\s*\\)", 'g' );
const RE_D = new RegExp( FUNCS + '\\(\\s*"((?:[^"\\\\]|\\\\.)*)"\\s*,\\s*"' + DOMAIN + '"\\s*\\)', 'g' );
const unescapeJs = ( s ) => s.replace( /\\'/g, "'" ).replace( /\\"/g, '"' ).replace( /\\\\/g, '\\' );

function stringsFrom( src ) {
	const out = new Set();
	for ( const re of [ RE_S, RE_D ] ) {
		re.lastIndex = 0;
		let m;
		while ( ( m = re.exec( src ) ) ) out.add( unescapeJs( m[ 1 ] ) );
	}
	return out;
}

// ドット付きの名前（.git / .climpire-worktrees …）と生成物は走査しない。
const SKIP = new Set( [ 'node_modules', 'dist', 'bin', 'languages', 'build' ] );
function walk( dir ) {
	let files = [];
	for ( const name of fs.readdirSync( dir ) ) {
		if ( name.startsWith( '.' ) || SKIP.has( name ) ) continue;
		const full = path.join( dir, name );
		if ( fs.statSync( full ).isDirectory() ) files = files.concat( walk( full ) );
		else files.push( full );
	}
	return files;
}

// ---- 見送るパターン ----
const deferred = fs
	.readFileSync( path.join( ROOT, 'bin', 'deferred-patterns.txt' ), 'utf8' )
	.split( '\n' )
	.map( ( l ) => l.replace( /#.*$/, '' ).trim() )
	.filter( Boolean );

if ( ! deferred.length ) {
	console.log( '見送るパターンはありません（カタログはそのまま）' );
	process.exit( 0 );
}

const missing = deferred.filter( ( n ) => ! fs.existsSync( path.join( ROOT, 'patterns', n ) ) );
if ( missing.length ) {
	console.error( '✗ bin/deferred-patterns.txt に無いファイルがあります: ' + missing.join( ', ' ) );
	process.exit( 1 );
}

const deferredIds = new Set();
const shippedIds = new Set();
for ( const file of walk( ROOT ) ) {
	const ext = path.extname( file );
	if ( ext !== '.php' && ext !== '.js' ) continue;
	const isDeferred =
		path.dirname( file ) === path.join( ROOT, 'patterns' ) && deferred.includes( path.basename( file ) );
	const target = isDeferred ? deferredIds : shippedIds;
	stringsFrom( fs.readFileSync( file, 'utf8' ) ).forEach( ( s ) => target.add( s ) );
}
const drop = new Set( [ ...deferredIds ].filter( ( id ) => ! shippedIds.has( id ) ) );
console.log( `見送る ${ deferred.length } 本だけに出てくる文字列: ${ drop.size } 件` );

// ---- カタログの書き換え ----
// 形式は make-i18n.mjs が書くもの固定: ヘッダー → 空行 → msgid/msgstr の2行組。
const poUnescape = ( s ) => s.replace( /\\"/g, '"' ).replace( /\\\\/g, '\\' );

function trimCatalog( file ) {
	const text = fs.readFileSync( file, 'utf8' );
	const blocks = text.split( '\n\n' );
	const kept = blocks.filter( ( b, i ) => {
		if ( i === 0 ) return true; // ヘッダー
		const m = b.match( /^msgid "((?:[^"\\]|\\.)*)"$/m );
		return ! m || ! drop.has( poUnescape( m[ 1 ] ) );
	} );
	fs.writeFileSync( file, kept.join( '\n\n' ) );
	return blocks.length - kept.length;
}

let touched = 0;
for ( const name of fs.readdirSync( LANG ).sort() ) {
	if ( name !== DOMAIN + '.pot' && ! /^shitate-[a-z]{2}(_[A-Z]{2})?\.po$/.test( name ) ) continue;
	const file = path.join( LANG, name );
	const removed = trimCatalog( file );
	const untranslated = ( fs.readFileSync( file, 'utf8' ).match( /^msgstr ""$/gm ) || [] ).length;
	let note = '';
	if ( name.endsWith( '.po' ) ) {
		// テーマは languages/<locale>.mo を読む（load_theme_textdomain）。
		const locale = name.slice( ( DOMAIN + '-' ).length, -'.po'.length );
		const mo = path.join( LANG, locale + '.mo' );
		try {
			execFileSync( 'msgfmt', [ file, '-o', mo ] );
			note = ` → ${ path.basename( mo ) } ${ fs.statSync( mo ).size } bytes`;
		} catch ( e ) {
			note = ' (msgfmt が見つからず .mo は未更新)';
		}
	}
	console.log( `${ name }: ${ removed } 件削除, 未訳 ${ untranslated } 件${ note }` );
	touched++;
}
console.log( `✓ ${ touched } 個のカタログを作り直しました` );
