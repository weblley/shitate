<?php
/**
 * Default ids on the page landmarks.
 *
 * The page's header and footer template parts get id="header" and
 * id="footer", and its <main> group gets id="main", so links (#main, a
 * "back to top" link to #header) and custom CSS can target them out of the
 * box. Core's skip link reuses the id of <main>, so it points at #main too.
 *
 * - The ids are added at render time, so templates and template parts saved
 *   in the Site Editor get them as well (and the Template Part block has no
 *   HTML anchor setting, so this is the only way to give <header> or
 *   <footer> an id).
 * - An element that already has an id keeps it, e.g. an HTML anchor set on
 *   the main group.
 * - Each id is given once per page: to the first <main> group, and to the
 *   first header / footer template part outside <main> (a part placed
 *   inside the content gets none).
 * - The shitate_landmark_ids filter renames them, or drops one with ''.
 *
 * @package shitate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The ids given to the page landmarks.
 *
 * @return string[] Element (header, main, footer) => id.
 */
function shitate_landmark_ids() {
	/**
	 * Filters the default ids of the page landmarks.
	 *
	 * Return '' for an element to leave it without an id, e.g.
	 *     add_filter( 'shitate_landmark_ids', fn( $ids ) => array_merge( $ids, array( 'main' => 'content' ) ) );
	 *
	 * @param string[] $ids Element (header, main, footer) => id.
	 */
	$ids = apply_filters(
		'shitate_landmark_ids',
		array(
			'header' => 'header',
			'main'   => 'main',
			'footer' => 'footer',
		)
	);
	return is_array( $ids ) ? $ids : array();
}

/**
 * Whether rendering is inside the page's <main> group.
 *
 * @param int $change 1 when a main group starts rendering, -1 when it ends.
 * @return bool
 */
function shitate_in_main( $change = 0 ) {
	static $depth = 0;
	$depth = max( 0, $depth + (int) $change );
	return $depth > 0;
}

/**
 * Give the block's outer element its landmark id, once per page.
 *
 * @param string   $block_content Rendered block.
 * @param string[] $elements      Landmark elements the block may render as.
 * @return string
 */
function shitate_landmark_id( $block_content, $elements ) {
	static $done = array();

	$tags = new WP_HTML_Tag_Processor( $block_content );
	if ( ! $tags->next_tag() ) {
		return $block_content;
	}
	$element = strtolower( $tags->get_tag() );
	if ( ! in_array( $element, $elements, true ) || isset( $done[ $element ] ) ) {
		return $block_content;
	}
	$done[ $element ] = true;

	$ids = shitate_landmark_ids();
	$id  = isset( $ids[ $element ] ) ? trim( (string) $ids[ $element ] ) : '';
	if ( '' === $id || null !== $tags->get_attribute( 'id' ) ) {
		return $block_content; // No id wanted, or the element has its own.
	}

	$tags->set_attribute( 'id', $id );
	return $tags->get_updated_html();
}

/**
 * Note when a <main> group starts rendering.
 *
 * @param array $parsed_block Block about to render.
 * @return array
 */
function shitate_main_start( $parsed_block ) {
	if ( isset( $parsed_block['blockName'], $parsed_block['attrs']['tagName'] ) && 'core/group' === $parsed_block['blockName'] && 'main' === $parsed_block['attrs']['tagName'] ) {
		shitate_in_main( 1 );
	}
	return $parsed_block;
}
add_filter( 'render_block_data', 'shitate_main_start' );

/**
 * id="main" on the <main> group, once its content has rendered.
 *
 * @param string $block_content Rendered block.
 * @param array  $block         Parsed block.
 * @return string
 */
function shitate_main_end( $block_content, $block ) {
	if ( isset( $block['attrs']['tagName'] ) && 'main' === $block['attrs']['tagName'] ) {
		shitate_in_main( -1 );
		$block_content = shitate_landmark_id( $block_content, array( 'main' ) );
	}
	return $block_content;
}
add_filter( 'render_block_core/group', 'shitate_main_end', 10, 2 );

/**
 * id="header" / id="footer" on the page's header and footer template parts.
 *
 * @param string $block_content Rendered block.
 * @return string
 */
function shitate_template_part_landmark( $block_content ) {
	if ( shitate_in_main() ) {
		return $block_content;
	}
	return shitate_landmark_id( $block_content, array( 'header', 'footer' ) );
}
add_filter( 'render_block_core/template-part', 'shitate_template_part_landmark' );
