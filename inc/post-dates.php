<?php
/**
 * The last-updated date in the single templates.
 *
 * Core shows a post's last-updated date as soon as it is later than the
 * publish time, so a post that was saved again a minute after publishing
 * shows the same day twice ("October 16 · Updated October 16"). The theme's
 * updated dates (.is-shitate-updated, see style.css) appear only from the day
 * after the post was published.
 *
 * @package shitate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Leave out the theme's updated date when the post was updated on the day it
 * was published.
 *
 * @param string        $block_content Rendered block.
 * @param array         $block         Parsed block.
 * @param WP_Block|null $instance      Block instance.
 * @return string
 */
function shitate_hide_same_day_update( $block_content, $block, $instance = null ) {
	$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
	if ( '' === $block_content || ! preg_match( '/(^|\s)is-shitate-updated(\s|$)/', $class ) ) {
		return $block_content;
	}

	$post_id = ( $instance instanceof WP_Block && isset( $instance->context['postId'] ) ) ? (int) $instance->context['postId'] : get_the_ID();
	if ( $post_id && get_the_modified_date( 'Y-m-d', $post_id ) === get_the_date( 'Y-m-d', $post_id ) ) {
		return '';
	}

	return $block_content;
}
add_filter( 'render_block_core/post-date', 'shitate_hide_same_day_update', 10, 3 );
