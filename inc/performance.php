<?php
/**
 * Image loading optimization for block templates.
 *
 * Core adds loading="lazy" / fetchpriority="high" to images inside post
 * content, but deliberately skips images rendered as part of a block
 * template ("template" context) and leaves them to be handled elsewhere.
 * On a block theme most of a landing page lives in the template, so those
 * images end up with no hint at all: every photo loads eagerly and none is
 * marked as the LCP candidate.
 *
 * This file fills that gap for the template context only:
 * - the first large image (width × height ≥ the core threshold, 50 000 px)
 *   gets fetchpriority="high" and stays eager;
 * - the first few sized images stay eager (the same count core uses for
 *   post content, wp_omit_loading_attr_threshold, 3 by default), so a row
 *   of cards above the fold is not delayed; every sized image after that
 *   gets loading="lazy";
 * - images without width/height (SVG logos, icons) are left alone, as core
 *   does, because lazy-loading them would risk layout shift;
 * - an image that already carries loading or fetchpriority (set by a block
 *   attribute, a plugin or the site owner) is respected and only counted.
 *
 * The whole behaviour is opt-in: a Customizer switch (Performance → Optimize
 * image loading, off by default) or a filter. Off by default so a
 * performance plugin such as WP Rocket never has to fight the theme:
 *
 *     add_filter( 'shitate_optimize_image_loading', '__return_false' );
 *
 * @package shitate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether the theme should manage image loading hints in templates.
 *
 * @return bool
 */
function shitate_optimize_image_loading() {
	$enabled = (bool) get_theme_mod( 'shitate_image_loading', false );
	return (bool) apply_filters( 'shitate_optimize_image_loading', $enabled );
}

/**
 * Add loading / fetchpriority hints to images rendered in the block template.
 *
 * Runs on wp_get_loading_optimization_attributes, which core applies to every
 * <img> in document order while filtering the template HTML.
 *
 * @param array  $loading_attrs Attributes core decided on (empty for templates).
 * @param string $tag_name      Tag name.
 * @param array  $attr          The tag's existing attributes.
 * @param string $context       Filter context.
 * @return array
 */
function shitate_template_image_loading_attributes( $loading_attrs, $tag_name, $attr, $context ) {
	static $lcp_done = false;
	static $sized_count = 0;

	if ( 'img' !== $tag_name || 'template' !== $context || is_admin() ) {
		return $loading_attrs;
	}
	if ( ! shitate_optimize_image_loading() ) {
		return $loading_attrs;
	}

	// Respect hints that are already there (block attribute, plugin, owner).
	if ( ! empty( $attr['loading'] ) || ! empty( $attr['fetchpriority'] ) ) {
		if ( ! empty( $attr['fetchpriority'] ) && 'high' === $attr['fetchpriority'] ) {
			$lcp_done = true;
		}
		return $loading_attrs;
	}

	// Only sized images: lazy-loading an image without dimensions risks
	// layout shift, and core follows the same rule.
	if ( empty( $attr['width'] ) || empty( $attr['height'] ) ) {
		return $loading_attrs;
	}

	++$sized_count;

	// Beyond the above-the-fold allowance (core's own count for post
	// content, 3 by default): lazy.
	if ( $sized_count > wp_omit_loading_attr_threshold() ) {
		$loading_attrs['loading'] = 'lazy';
		return $loading_attrs;
	}

	if ( $lcp_done ) {
		return $loading_attrs; // Eager, no priority hint.
	}

	$area = (int) $attr['width'] * (int) $attr['height'];
	/** This filter is documented in wp-includes/media.php */
	$min_area = (int) apply_filters( 'wp_min_priority_img_pixels', 50000 );
	if ( $area < $min_area ) {
		return $loading_attrs; // A small image before the hero: eager, no hint.
	}

	// The first large image is the LCP candidate.
	$lcp_done                       = true;
	$loading_attrs['fetchpriority'] = 'high';
	if ( function_exists( 'wp_high_priority_element_flag' ) ) {
		// Tell core the high-priority slot is taken so it does not mark a
		// second image inside post content as well.
		wp_high_priority_element_flag( false );
	}

	return $loading_attrs;
}
add_filter( 'wp_get_loading_optimization_attributes', 'shitate_template_image_loading_attributes', 10, 4 );

/**
 * Customizer: Performance section with the image-loading switch.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function shitate_performance_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'shitate_performance',
		array(
			'title'    => __( 'Performance', 'shitate' ),
			'priority' => 41,
		)
	);

	$wp_customize->add_setting(
		'shitate_image_loading',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'shitate_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shitate_image_loading',
		array(
			'type'        => 'checkbox',
			'section'     => 'shitate_performance',
			'label'       => __( 'Optimize image loading', 'shitate' ),
			'description' => __( 'Marks the first large image in the template as high priority and lazy-loads the images after it. Turn this off if a performance plugin (WP Rocket, Perfmatters, etc.) handles image loading, so the two do not interfere.', 'shitate' ),
		)
	);
}
add_action( 'customize_register', 'shitate_performance_customize_register' );
