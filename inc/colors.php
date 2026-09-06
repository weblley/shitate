<?php
/**
 * Derived palette colors that follow their source colors.
 *
 * The palette has four source colors (base, contrast, primary, accent) and
 * five derived tones (base-2, line, contrast-2, neutral, primary-hover). When
 * a user edits a source color in the Site Editor, the derived tones would
 * otherwise keep their old values and the palette drifts apart — a darker
 * "Primary / Hover" that no longer matches the new primary, a "Base / Two"
 * tinted toward the old brand color, and so on.
 *
 * This filter recomputes a derived tone at read time whenever (a) at least
 * one of its sources differs from every shipped default and (b) the tone
 * itself still equals a shipped default, i.e. the user has not set it by
 * hand. Nothing is written back: revert the source and the tone reverts too,
 * and a tone the user picked deliberately is always left alone. Values stay
 * plain hex, so the editor's color pickers and KSES are unaffected (KSES
 * strips color-mix() from user data, which rules out CSS-side derivation).
 *
 * The formulas reproduce theme.json's default palette exactly; style
 * variations keep their hand-tuned tones until a source is changed.
 *
 * @package shitate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Which sources each derived slug depends on.
 *
 * @return array<string, string[]>
 */
function st_derived_color_sources() {
	return array(
		'primary-hover' => array( 'primary', 'base' ),
		'base-2'        => array( 'base', 'primary' ),
		'line'          => array( 'base', 'primary' ),
		'contrast-2'    => array( 'contrast', 'base' ),
		'neutral'       => array( 'contrast', 'primary', 'base' ),
	);
}

/**
 * Compute one derived tone from the current source colors.
 *
 * @param string $slug    Derived slug.
 * @param array  $sources Slug => hex of the current source colors.
 * @return string|null Hex color, or null when a source is missing.
 */
function st_compute_derived_color( $slug, $sources ) {
	$base     = isset( $sources['base'] ) ? st_hex_to_rgb( $sources['base'] ) : null;
	$contrast = isset( $sources['contrast'] ) ? st_hex_to_rgb( $sources['contrast'] ) : null;
	$primary  = isset( $sources['primary'] ) ? st_hex_to_rgb( $sources['primary'] ) : null;

	switch ( $slug ) {
		case 'primary-hover':
			if ( ! $primary || ! $base ) {
				return null;
			}
			// Darken on light backgrounds, lighten on dark ones.
			return st_is_dark( $base )
				? st_rgb_to_hex( st_mix( $primary, array( 255, 255, 255 ), 0.75 ) )
				: st_rgb_to_hex( st_mix( $primary, array( 0, 0, 0 ), 0.78 ) );

		case 'base-2':
			return ( $base && $primary ) ? st_rgb_to_hex( st_mix( $base, $primary, 0.95 ) ) : null;

		case 'line':
			return ( $base && $primary ) ? st_rgb_to_hex( st_mix( $base, $primary, 0.87 ) ) : null;

		case 'contrast-2':
			return ( $contrast && $base ) ? st_rgb_to_hex( st_mix( $contrast, $base, 0.75 ) ) : null;

		case 'neutral':
			if ( ! $contrast || ! $primary || ! $base ) {
				return null;
			}
			return st_rgb_to_hex( st_mix( st_mix( $contrast, $primary, 0.714 ), $base, 0.7 ) );
	}

	return null;
}

/**
 * Recompute derived palette tones in the user's global styles.
 *
 * @param WP_Theme_JSON_Data $theme_json User-origin theme.json data.
 * @return WP_Theme_JSON_Data
 */
function st_derive_palette_colors( $theme_json ) {
	$data = $theme_json->get_data();
	if ( empty( $data['settings']['color']['palette']['theme'] ) || ! is_array( $data['settings']['color']['palette']['theme'] ) ) {
		return $theme_json;
	}

	$defaults = st_shipped_palette_defaults();
	if ( empty( $defaults ) ) {
		return $theme_json;
	}

	// Current effective value per slug: the user's copy of the theme palette.
	$current = array();
	foreach ( $data['settings']['color']['palette']['theme'] as $entry ) {
		if ( isset( $entry['slug'], $entry['color'] ) && st_hex_to_rgb( $entry['color'] ) ) {
			$current[ $entry['slug'] ] = strtolower( $entry['color'] );
		}
	}

	$changed = false;
	foreach ( st_derived_color_sources() as $slug => $sources ) {
		if ( ! isset( $current[ $slug ] ) ) {
			continue;
		}
		// Leave tones the user set by hand alone.
		if ( ! st_is_shipped_default( $slug, $current[ $slug ], $defaults ) ) {
			continue;
		}
		$source_changed = false;
		$values         = array();
		foreach ( $sources as $source ) {
			if ( ! isset( $current[ $source ] ) ) {
				continue 2;
			}
			$values[ $source ] = $current[ $source ];
			if ( ! st_is_shipped_default( $source, $current[ $source ], $defaults ) ) {
				$source_changed = true;
			}
		}
		if ( ! $source_changed ) {
			continue;
		}
		$computed = st_compute_derived_color( $slug, $values );
		if ( null === $computed || $computed === $current[ $slug ] ) {
			continue;
		}
		foreach ( $data['settings']['color']['palette']['theme'] as &$entry ) {
			if ( isset( $entry['slug'] ) && $entry['slug'] === $slug ) {
				$entry['color'] = $computed;
				$changed        = true;
			}
		}
		unset( $entry );
		$current[ $slug ] = $computed;
	}

	if ( ! $changed ) {
		return $theme_json;
	}

	return new WP_Theme_JSON_Data( $data, 'custom' );
}
add_filter( 'wp_theme_json_data_user', 'st_derive_palette_colors' );

/**
 * Every shipped value per slug: theme.json plus each style variation.
 *
 * @return array<string, string[]> Slug => list of lowercase hex values.
 */
function st_shipped_palette_defaults() {
	static $defaults = null;
	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array();
	$files    = array_merge(
		array( get_template_directory() . '/theme.json' ),
		glob( get_template_directory() . '/styles/*.json' ) ?: array()
	);
	foreach ( $files as $file ) {
		$json = wp_json_file_decode( $file, array( 'associative' => true ) );
		if ( empty( $json['settings']['color']['palette'] ) || ! is_array( $json['settings']['color']['palette'] ) ) {
			continue;
		}
		foreach ( $json['settings']['color']['palette'] as $entry ) {
			if ( isset( $entry['slug'], $entry['color'] ) ) {
				$defaults[ $entry['slug'] ][] = strtolower( $entry['color'] );
			}
		}
	}

	return $defaults;
}

/**
 * Whether a value is one of the shipped defaults for a slug.
 *
 * @param string $slug     Palette slug.
 * @param string $value    Lowercase hex.
 * @param array  $defaults From st_shipped_palette_defaults().
 * @return bool
 */
function st_is_shipped_default( $slug, $value, $defaults ) {
	return isset( $defaults[ $slug ] ) && in_array( $value, $defaults[ $slug ], true );
}

/**
 * Parse #rgb / #rrggbb into [r, g, b].
 *
 * @param string $hex Hex color.
 * @return int[]|null
 */
function st_hex_to_rgb( $hex ) {
	$hex = ltrim( trim( (string) $hex ), '#' );
	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	if ( 6 !== strlen( $hex ) || ! ctype_xdigit( $hex ) ) {
		return null;
	}
	return array( hexdec( substr( $hex, 0, 2 ) ), hexdec( substr( $hex, 2, 2 ) ), hexdec( substr( $hex, 4, 2 ) ) );
}

/**
 * Format [r, g, b] as lowercase #rrggbb.
 *
 * @param int[] $rgb Channels.
 * @return string
 */
function st_rgb_to_hex( $rgb ) {
	return sprintf( '#%02x%02x%02x', max( 0, min( 255, (int) round( $rgb[0] ) ) ), max( 0, min( 255, (int) round( $rgb[1] ) ) ), max( 0, min( 255, (int) round( $rgb[2] ) ) ) );
}

/**
 * Mix two colors in sRGB: $weight of $a, the rest of $b.
 *
 * @param int[] $a      First color.
 * @param int[] $b      Second color.
 * @param float $weight Share of $a (0..1).
 * @return float[]
 */
function st_mix( $a, $b, $weight ) {
	return array(
		$a[0] * $weight + $b[0] * ( 1 - $weight ),
		$a[1] * $weight + $b[1] * ( 1 - $weight ),
		$a[2] * $weight + $b[2] * ( 1 - $weight ),
	);
}

/**
 * Rough relative luminance test (sRGB, linearized).
 *
 * @param int[] $rgb Channels.
 * @return bool True when the color reads as dark.
 */
function st_is_dark( $rgb ) {
	$lin = array();
	foreach ( $rgb as $c ) {
		$c     = $c / 255;
		$lin[] = $c <= 0.03928 ? $c / 12.92 : pow( ( $c + 0.055 ) / 1.055, 2.4 );
	}
	return ( 0.2126 * $lin[0] + 0.7152 * $lin[1] + 0.0722 * $lin[2] ) < 0.35;
}
