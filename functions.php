<?php
/**
 * shitate theme functions.
 *
 * Naming convention:
 *   st  = shitate theme  (this theme's PHP, constants, CSS vars, handles)
 *   sb  = shitate block  (the companion block plugins)
 * The text domain stays "shitate" because WordPress.org requires it to match
 * the theme slug.
 *
 * @package shitate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'ST_VERSION' ) ) {
	define( 'ST_VERSION', '0.1.0' );
}

// GitHub-based updates while distributed outside WordPress.org.
// REMOVE before .org submission (see inc/github-updater.php).
require_once get_template_directory() . '/inc/github-updater.php';

/**
 * Theme setup.
 */
function st_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	// The featured-image block renders the "post-thumbnail" size. Without this,
	// a tiny legacy size (e.g. 150x150 from a previous classic theme) can win
	// and get stretched blurry. Proportional, not cropped: templates shape the
	// image with aspectRatio + object-fit. Existing uploads need a regenerate.
	set_post_thumbnail_size( 1568, 9999 );
	add_editor_style( array( 'assets/css/tokens.css', 'assets/css/utilities.css', 'assets/css/editor.css' ) );
	load_theme_textdomain( 'shitate', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'st_setup' );

/**
 * Register custom block pattern categories.
 */
function st_register_pattern_categories() {
	register_block_pattern_category(
		'st',
		array( 'label' => __( 'shitate', 'shitate' ) )
	);
}
add_action( 'init', 'st_register_pattern_categories' );

/**
 * Appearance → Patterns shortcut.
 *
 * Block themes only get "Editor" under Appearance, which buries pattern
 * management inside the Site Editor. Link straight to its patterns view,
 * using the same URL core shows classic themes (wp-admin/menu.php).
 */
function st_patterns_admin_menu() {
	add_theme_page(
		__( 'Patterns', 'shitate' ),
		__( 'Patterns', 'shitate' ),
		'edit_theme_options',
		'site-editor.php?p=/pattern'
	);
}
add_action( 'admin_menu', 'st_patterns_admin_menu' );

/**
 * Drive vertical layout with margin-top only.
 *
 * Vertical rhythm follows DADS using margin-top: the base gap comes from
 * blockGap and headings get extra space before them (see tokens.css). To keep
 * manual spacing consistent, expose a margin control on every core block but
 * restrict it to the top side.
 *
 * @param array  $args       Registered block type arguments.
 * @param string $block_name Block name (e.g. "core/paragraph").
 * @return array Filtered arguments.
 */
function st_top_margin_only_supports( $args, $block_name ) {
	if ( 0 !== strpos( (string) $block_name, 'core/' ) ) {
		return $args;
	}

	if ( ! isset( $args['supports'] ) || ! is_array( $args['supports'] ) ) {
		$args['supports'] = array();
	}
	if ( ! isset( $args['supports']['spacing'] ) || ! is_array( $args['supports']['spacing'] ) ) {
		$args['supports']['spacing'] = array();
	}

	$args['supports']['spacing']['margin'] = array( 'top' );

	return $args;
}
add_filter( 'register_block_type_args', 'st_top_margin_only_supports', 10, 2 );

/**
 * Sanitize the type-scale ratio against the allowed list.
 *
 * @param string $value Submitted value.
 * @return string
 */
function st_sanitize_ratio( $value ) {
	$allowed = array( '1.067', '1.125', '1.2', '1.25', '1.333', '1.414', '1.5', '1.618' );
	return in_array( (string) $value, $allowed, true ) ? (string) $value : '1.25';
}

/**
 * Customizer: typography scale (ratio + base) with live preview.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function st_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'st_typography',
		array(
			'title'    => __( 'Typography Scale', 'shitate' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'st_ratio',
		array(
			'default'           => '1.25',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'st_sanitize_ratio',
		)
	);
	$wp_customize->add_control(
		'st_ratio',
		array(
			'type'        => 'select',
			'section'     => 'st_typography',
			'label'       => __( 'Scale ratio', 'shitate' ),
			'description' => __( 'Bigger ratio = more contrast between headings (like typescale.com).', 'shitate' ),
			'choices'     => array(
				'1.067' => __( 'Minor Second — 1.067', 'shitate' ),
				'1.125' => __( 'Major Second — 1.125', 'shitate' ),
				'1.2'   => __( 'Minor Third — 1.2', 'shitate' ),
				'1.25'  => __( 'Major Third — 1.25', 'shitate' ),
				'1.333' => __( 'Perfect Fourth — 1.333', 'shitate' ),
				'1.414' => __( 'Augmented Fourth — 1.414', 'shitate' ),
				'1.5'   => __( 'Perfect Fifth — 1.5', 'shitate' ),
				'1.618' => __( 'Golden Ratio — 1.618', 'shitate' ),
			),
		)
	);

	$wp_customize->add_setting(
		'st_text_m',
		array(
			'default'           => 16,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'st_text_m',
		array(
			'type'        => 'number',
			'section'     => 'st_typography',
			'label'       => __( 'Base size (px)', 'shitate' ),
			'description' => __( 'Body text size. The whole scale is built from this.', 'shitate' ),
			'input_attrs' => array(
				'min'  => 12,
				'max'  => 24,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'st_round_scale',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'st_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'st_round_scale',
		array(
			'type'        => 'checkbox',
			'section'     => 'st_typography',
			'label'       => __( 'Apply rounding to font sizes', 'shitate' ),
			'description' => __( 'Snaps every step to even pixels (2px) and makes headings fluid between a derived mobile ratio and the chosen ratio.', 'shitate' ),
		)
	);
}
add_action( 'customize_register', 'st_customize_register' );

/**
 * Sanitize a Customizer checkbox.
 *
 * @param mixed $value Submitted value.
 * @return bool
 */
function st_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Build the type-scale override CSS from the saved Customizer values.
 *
 * @return string
 */
function st_scale_inline_css() {
	$ratio = st_sanitize_ratio( get_theme_mod( 'st_ratio', '1.25' ) );
	$base  = absint( get_theme_mod( 'st_text_m', 16 ) );
	if ( $base < 12 || $base > 24 ) {
		$base = 16;
	}

	$css = ':root{--st-ratio:' . $ratio . ';--st-text-m:' . $base . 'px;}';

	// Optional rounded/fluid scale: every step snapped to even pixels (2px),
	// headings fluid between a mobile ratio derived from --st-ratio (never
	// inverts: always 1 < min < ratio) and the chosen ratio itself. Raw chains
	// are kept un-rounded so rounding errors do not compound across steps.
	if ( get_theme_mod( 'st_round_scale', false ) ) {
		$css .= ':root{'
			. '--st-ratio-min:calc((1 + var(--st-ratio)) / 2);'
			// Down-scale (fixed, rounded).
			. '--st-s-raw:calc(var(--st-text-m) / var(--st-ratio));'
			. '--st-xs-raw:calc(var(--st-s-raw) / var(--st-ratio));'
			. '--st-xxs-raw:calc(var(--st-xs-raw) / var(--st-ratio));'
			. '--st-text-s:round(nearest, var(--st-s-raw), 2px);'
			. '--st-text-xs:round(nearest, var(--st-xs-raw), 2px);'
			. '--st-text-xxs:round(nearest, var(--st-xxs-raw), 2px);'
			// Up-scale bounds (desktop = ratio, mobile = derived ratio-min).
			. '--st-l-max:calc(var(--st-text-m) * var(--st-ratio));'
			. '--st-xl-max:calc(var(--st-l-max) * var(--st-ratio));'
			. '--st-xxl-max:calc(var(--st-xl-max) * var(--st-ratio));'
			. '--st-xxxl-max:calc(var(--st-xxl-max) * var(--st-ratio));'
			. '--st-l-min:calc(var(--st-text-m) * var(--st-ratio-min));'
			. '--st-xl-min:calc(var(--st-l-min) * var(--st-ratio-min));'
			. '--st-xxl-min:calc(var(--st-xl-min) * var(--st-ratio-min));'
			. '--st-xxxl-min:calc(var(--st-xxl-min) * var(--st-ratio-min));'
			// Fluid between the bounds, snapped to even pixels.
			. '--st-text-l:round(nearest, clamp(var(--st-l-min), calc(var(--st-l-min) + 0.3vw), var(--st-l-max)), 2px);'
			. '--st-text-xl:round(nearest, clamp(var(--st-xl-min), calc(var(--st-xl-min) + 0.7vw), var(--st-xl-max)), 2px);'
			. '--st-text-xxl:round(nearest, clamp(var(--st-xxl-min), calc(var(--st-xxl-min) + 1.1vw), var(--st-xxl-max)), 2px);'
			. '--st-text-xxxl:round(nearest, clamp(var(--st-xxxl-min), calc(var(--st-xxxl-min) + 1.6vw), var(--st-xxxl-max)), 2px);'
			. '}';
	}

	return $css;
}

/**
 * Apply the scale override inside the block editor (iframe canvas).
 *
 * Appending to the editor "styles" array injects the CSS into the editor iframe
 * after the theme's editor styles, so it reliably overrides tokens.css there.
 * The front end is handled in st_enqueue_styles().
 *
 * @param array $settings Block editor settings.
 * @return array
 */
function st_scale_editor_settings( $settings ) {
	if ( ! isset( $settings['styles'] ) || ! is_array( $settings['styles'] ) ) {
		$settings['styles'] = array();
	}
	$settings['styles'][] = array( 'css' => st_scale_inline_css() );
	return $settings;
}
add_filter( 'block_editor_settings_all', 'st_scale_editor_settings' );

/**
 * Live preview script for the Customizer.
 */
function st_customize_preview_js() {
	wp_enqueue_script(
		'st-customize-preview',
		get_theme_file_uri( 'assets/js/customize-preview.js' ),
		array( 'customize-preview' ),
		ST_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'st_customize_preview_js' );

/**
 * Block toolbar "Spacing" dropdown that toggles the utility classes
 * (mt-0 … p-xxxl) on any block, so they can be adjusted without typing.
 */
function st_utilities_toolbar_script() {
	wp_enqueue_script(
		'st-utilities-toolbar',
		get_theme_file_uri( 'assets/js/utilities-toolbar.js' ),
		array( 'wp-hooks', 'wp-compose', 'wp-element', 'wp-blocks', 'wp-block-editor', 'wp-components', 'wp-i18n' ),
		ST_VERSION,
		true
	);
	wp_set_script_translations( 'st-utilities-toolbar', 'shitate', get_template_directory() . '/languages' );
}
add_action( 'enqueue_block_editor_assets', 'st_utilities_toolbar_script' );

/**
 * Enqueue front-end styles.
 */
function st_enqueue_styles() {
	wp_enqueue_style(
		'st-tokens',
		get_theme_file_uri( 'assets/css/tokens.css' ),
		array(),
		ST_VERSION
	);
	// Customizer type-scale override, right after tokens.css so it always wins.
	wp_add_inline_style( 'st-tokens', st_scale_inline_css() );
	wp_enqueue_style(
		'st-utilities',
		get_theme_file_uri( 'assets/css/utilities.css' ),
		array( 'st-tokens' ),
		ST_VERSION
	);
	wp_enqueue_style(
		'st-style',
		get_stylesheet_uri(),
		array( 'st-tokens', 'st-utilities' ),
		ST_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'st_enqueue_styles' );
