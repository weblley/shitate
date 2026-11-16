<?php
/**
 * Reading speed of the Time to Read block in languages counted in characters.
 *
 * Core's Time to Read block divides the length of the post by a reading speed
 * of 189, meant as English words a minute. WordPress counts Japanese and
 * Chinese in characters instead (wp_get_word_count_type() is
 * "characters_including_spaces" or "characters_excluding_spaces"), so there
 * the 189 is applied to characters, and the estimate comes out about 2.6 times
 * too long: people read roughly 400–600 Japanese characters a minute.
 *
 * In those languages the block's default speed becomes 500 characters a
 * minute. Only the default changes: a speed saved on the block itself is
 * kept. The block editor takes block defaults from the server, so it shows
 * the same estimate as the front end. Change the speed with the
 * shitate_reading_speed filter; 0 keeps core's default.
 *
 * @package shitate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default reading speed of the Time to Read block in the current language.
 *
 * @return int Characters a minute, or 0 to keep core's default.
 */
function shitate_reading_speed() {
	$type  = wp_get_word_count_type();
	$speed = 0 === strpos( $type, 'characters' ) ? 500 : 0;

	/**
	 * Filters the default reading speed of the Time to Read block.
	 *
	 * @param int    $speed Words or characters a minute; 0 keeps core's default (189).
	 * @param string $type  How the language is counted: "words",
	 *                      "characters_excluding_spaces" or "characters_including_spaces".
	 */
	return max( 0, (int) apply_filters( 'shitate_reading_speed', $speed, $type ) );
}

/**
 * Set the default speed of the Time to Read block for the current language.
 *
 * @param array  $args       Block type arguments.
 * @param string $block_type Block name.
 * @return array
 */
function shitate_reading_speed_default( $args, $block_type ) {
	if ( 'core/post-time-to-read' !== $block_type || ! isset( $args['attributes']['averageReadingSpeed'] ) ) {
		return $args;
	}

	$speed = shitate_reading_speed();
	if ( $speed > 0 ) {
		$args['attributes']['averageReadingSpeed']['default'] = $speed;
	}

	return $args;
}
add_filter( 'register_block_type_args', 'shitate_reading_speed_default', 10, 2 );
