<?php
/**
 * shitate theme functions.
 *
 * Naming convention:
 *   shitate_ / SHITATE_ / shitate-  = this theme's PHP functions, constants,
 *                                    Customizer settings and script/style handles
 *   --st-*                          = this theme's CSS custom properties (kept short
 *                                    on purpose; the companion plugin reads them)
 *   sb_ / sb/                       = the companion block plugin
 * The text domain stays "shitate" because WordPress.org requires it to match
 * the theme slug.
 *
 * @package shitate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Cache buster for the theme's CSS/JS. Kept in sync with the style.css header
// by bin/release.sh — do not edit by hand.
if ( ! defined( 'SHITATE_VERSION' ) ) {
	define( 'SHITATE_VERSION', '1.0.5' );
}

// Derived palette tones (Base / Two, Border, Contrast / Two, Neutral,
// Primary / Hover) follow their source colors when those are edited.
require_once get_template_directory() . '/inc/colors.php';
require_once get_template_directory() . '/inc/performance.php';

/**
 * One-time migration of Customizer settings saved under the old "st_" prefix.
 */
function shitate_migrate_theme_mods() {
	$mods = get_theme_mods();
	if ( ! is_array( $mods ) ) {
		return;
	}
	// Copy through the same sanitizers the Customizer uses, so a legacy value
	// stored under the old name cannot bypass them.
	$sanitizers = array(
		'ratio'       => 'shitate_sanitize_ratio',
		'text_m'      => 'shitate_sanitize_text_m',
		'round_scale' => 'shitate_sanitize_checkbox',
	);
	foreach ( $sanitizers as $key => $sanitize ) {
		if ( array_key_exists( 'st_' . $key, $mods ) && ! array_key_exists( 'shitate_' . $key, $mods ) ) {
			set_theme_mod( 'shitate_' . $key, call_user_func( $sanitize, $mods[ 'st_' . $key ] ) );
			remove_theme_mod( 'st_' . $key );
		}
	}
	// The per-post-type overrides (shitate_ratio_{type} / shitate_text_m_{type},
	// a 2026-10-20 dev build, never released) are gone: drop saved values so
	// they cannot resurface. shitate_ratio_mobile is a live setting.
	foreach ( array_keys( $mods ) as $key ) {
		if ( preg_match( '/^shitate_(?:ratio|text_m)_(?!mobile$)[a-z0-9_-]+$/', $key ) ) {
			remove_theme_mod( $key );
		}
	}
}
add_action( 'after_setup_theme', 'shitate_migrate_theme_mods', 5 );

/**
 * Whether the theme's base reset (assets/css/reset.css) is loaded.
 *
 * Disable it from a child theme or plugin, on both the front end and the
 * editor canvas:
 *
 *     add_filter( 'shitate_use_reset', '__return_false' );
 *
 * @return bool
 */
function shitate_use_reset() {
	return (bool) apply_filters( 'shitate_use_reset', true );
}

/**
 * Theme setup.
 */
function shitate_setup() {
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
	$editor_styles = array( 'assets/css/tokens.css', 'assets/css/utilities.css', 'assets/css/editor.css' );
	if ( shitate_use_reset() ) {
		array_unshift( $editor_styles, 'assets/css/reset.css' );
	}
	add_editor_style( $editor_styles );
	load_theme_textdomain( 'shitate', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'shitate_setup' );

/**
 * Drop core's default presets from the generated CSS.
 *
 * theme.json already hides them (defaultPalette / defaultGradients /
 * defaultDuotone / shadow.defaultPresets = false), but core still prints
 * the custom properties and .has-*-color / -background-color /
 * -gradient-background classes for its 12 colours, 12 gradients and 5
 * shadows on every page (about 5 KB of global-styles CSS). Emptying the
 * default data removes them at the source; the theme palette, gradients
 * and shadows are untouched. Aspect-ratio presets stay: the editor uses
 * them and they are a few lines.
 *
 * @param WP_Theme_JSON_Data $theme_json Core's theme.json data.
 * @return WP_Theme_JSON_Data
 */
function shitate_strip_core_presets( $theme_json ) {
	return $theme_json->update_with(
		array(
			'version'  => 3,
			'settings' => array(
				'color'  => array(
					'palette'   => array(),
					'gradients' => array(),
					'duotone'   => array(),
				),
				'shadow' => array(
					'presets' => array(),
				),
			),
		)
	);
}
add_filter( 'wp_theme_json_data_default', 'shitate_strip_core_presets' );

/**
 * Register custom block pattern categories.
 */
function shitate_register_pattern_categories() {
	register_block_pattern_category(
		'shitate',
		array( 'label' => __( 'shitate', 'shitate' ) )
	);
}
add_action( 'init', 'shitate_register_pattern_categories' );

/**
 * Block styles.
 *
 * Each style's CSS lives in its own stylesheet handle (shitate-style-<name>,
 * inline, no file) and is enqueued only when a rendered block carries that
 * style class (shitate_enqueue_block_style_css), so a page prints the CSS of
 * the styles it uses, once. The editor loads them all.
 *
 * - Breadcrumbs "Single line": never wraps; the trail scrolls sideways
 *   (scrollbar hidden). Core forces flex-wrap:wrap at 0-1-1, so the
 *   selectors deliberately carry the block class as well.
 * - "Chips" on Post Terms, Categories and Paragraph: every link becomes a
 *   chip (tinted surface, brand text; inverted on hover and when current).
 * - Post Title / Post Excerpt "Two lines": clamps the text to two lines so
 *   cards in a grid keep the same height.
 * - Post Template layouts, all CSS only: "Cards" (grid, rows breathe more
 *   than columns), "Cards, first post large" (the first post spread across
 *   the grid; an ordinary card from page 2 on and in narrow containers),
 *   "List" (image left, text right, hairlines) and "Rows" (date, chip and
 *   title on one line, for news). The card layouts share the image hover
 *   and the PICKUP label on sticky posts; --st-label-pickup carries the
 *   translated label (see shitate_enqueue_styles). The block gap stays a
 *   single value because core's responsive grid folds it into its column
 *   formula; the space between the image and the text is set here, not in
 *   the template, so each layout can decide it.
 * - Navigation "Captioned" / "Underline" and Navigation Link "Button" /
 *   "Outline": see shitate_block_style_definitions().
 *
 * @return array[] name, blocks, label, css.
 */
function shitate_block_style_definitions() {
	$chip  = '{display:inline-block;padding:0.125rem 0.5rem;border-radius:var(--st-radius-s);background-color:var(--st-color-base-2);color:var(--st-color-brand);font-weight:600;text-decoration:none}';
	$chips = '.wp-block-post-terms.is-style-chips{display:inline-flex;flex-wrap:wrap;gap:var(--st-space-xxs)}'
		. '.wp-block-post-terms.is-style-chips .wp-block-post-terms__separator{display:none}'
		. '.wp-block-categories.is-style-chips{display:flex;flex-wrap:wrap;gap:var(--st-space-xxs);margin:0;padding:0;list-style:none}'
		. '.wp-block-categories.is-style-chips li{margin:0}'
		. 'p.is-style-chips{display:flex;flex-wrap:wrap;gap:var(--st-space-xxs)}'
		. '.wp-block-post-terms.is-style-chips a,.wp-block-categories.is-style-chips a,p.is-style-chips a' . $chip
		. '.wp-block-post-terms.is-style-chips a:hover,.wp-block-categories.is-style-chips a:hover,p.is-style-chips a:hover,.wp-block-categories.is-style-chips .current-cat>a,p.is-style-chips a.is-current{background-color:var(--st-color-brand);color:var(--st-color-base)}';

	// Image hover and the PICKUP label, shared by the card layouts.
	$media = static function ( $style ) {
		$li = '.wp-block-post-template.is-style-' . $style . '>li';
		return $li . ' .wp-block-post-featured-image{position:relative;overflow:hidden}'
			. $li . ' .wp-block-post-featured-image img{transition:transform var(--st-transition,0.2s)}'
			. $li . ':hover .wp-block-post-featured-image img{transform:scale(1.03)}'
			. '@media (prefers-reduced-motion:reduce){' . $li . ':hover .wp-block-post-featured-image img{transform:none}}'
			. $li . '.sticky .wp-block-post-featured-image::before{content:var(--st-label-pickup,"PICKUP");position:absolute;inset-block-start:var(--st-space-xs);inset-inline-start:var(--st-space-xs);z-index:1;padding:0.125rem 0.5rem;border-radius:var(--st-radius-s);background-color:var(--st-color-contrast);color:var(--st-color-base);font-size:var(--st-text-xs);font-weight:600;line-height:1.5}';
	};
	$cards = '.wp-block-post-template.is-style-cards';
	$feat  = '.wp-block-post-template.is-style-cards-featured';
	$first = $feat . '>li:first-child';
	$list  = '.wp-block-post-template.is-style-list';
	$rows  = '.wp-block-post-template.is-style-rows';

	// Navigation, the way Japanese business themes draw it: each item is a
	// label with a small caption under it (the link's Description field, which
	// core renders but hides), a brand-coloured bar slides in on hover and
	// stays under the current page, drop-downs are shadowed panels, and the
	// mobile overlay becomes a list with hairlines. "Underline" is the same
	// without captions. Selectors carry .wp-block-navigation plus the style
	// class (0-3-0) to outrank core's own navigation rules (0-2-0).
	$nav_style = static function ( $style, $captions ) {
		$n   = '.wp-block-navigation.is-style-' . $style;
		$css = $n . ' .wp-block-navigation-item__content{position:relative;display:flex;flex-direction:column;align-items:center;gap:0.125rem;padding:0.5rem;line-height:1.3;text-decoration:none}'
			. $n . ' .wp-block-navigation-item__content::after{content:"";position:absolute;inset-inline:0.5rem;inset-block-end:0;block-size:0.125rem;border-radius:0.0625rem;background-color:var(--st-color-brand);transform:scaleX(0);transform-origin:left;transition:transform var(--st-transition,0.2s)}'
			. $n . ' .wp-block-navigation-item:hover>.wp-block-navigation-item__content::after,' . $n . ' .wp-block-navigation-item:focus-within>.wp-block-navigation-item__content::after,' . $n . ' .current-menu-item>.wp-block-navigation-item__content::after,' . $n . ' .current-menu-ancestor>.wp-block-navigation-item__content::after{transform:scaleX(1)}'
			. $n . ' .current-menu-item>.wp-block-navigation-item__content,' . $n . ' .current-menu-ancestor>.wp-block-navigation-item__content{color:var(--st-color-brand)}'
			. '@media (prefers-reduced-motion:reduce){' . $n . ' .wp-block-navigation-item__content::after{transition:none}}'
			// Drop-down: a shadowed panel, rows with a tinted hover, no bars or captions inside.
			. $n . ' .wp-block-navigation__submenu-container{border:0;border-radius:var(--st-radius-s);box-shadow:var(--wp--preset--shadow--card);padding:var(--st-space-xs) 0;min-inline-size:14rem}'
			. $n . ' .wp-block-navigation__submenu-container .wp-block-navigation-item__content{flex-direction:row;align-items:center;justify-content:flex-start;padding:var(--st-space-xs) var(--st-space-m)}'
			. $n . ' .wp-block-navigation__submenu-container .wp-block-navigation-item__content:hover{background-color:var(--st-color-base-2)}'
			. $n . ' .wp-block-navigation__submenu-container .wp-block-navigation-item__content::after,' . $n . ' .wp-block-navigation__submenu-container .wp-block-navigation-item__description{display:none}'
			// Mobile overlay: full-width rows with hairlines, captions beside the label.
			// The overlay inherits the header's justification (often right); rows span the width instead.
			. $n . ' .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__responsive-container-content,' . $n . ' .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__container,' . $n . ' .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__submenu-container{align-items:stretch}'
			. $n . ' .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item{inline-size:100%;justify-content:flex-start;align-items:stretch;text-align:start;border-block-end:0.0625rem solid var(--st-color-rule)}'
			. $n . ' .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item__content{inline-size:100%;flex-direction:row;align-items:baseline;justify-content:flex-start;gap:var(--st-space-s);padding:var(--st-space-s) 0}'
			. $n . ' .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item__content::after{display:none}'
			. $n . ' .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__submenu-container{box-shadow:none;padding:0 0 var(--st-space-xs) var(--st-space-m);min-inline-size:0}'
			. $n . ' .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__submenu-container .wp-block-navigation-item{border:0}';
		if ( $captions ) {
			$css .= $n . ' .wp-block-navigation-item__description{display:block;font-size:0.7em;letter-spacing:0.06em;color:var(--st-color-neutral)}'
				. $n . ' .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item__description{font-size:0.75em}';
		}
		return $css;
	};
	// A navigation link as a call-to-action button (filled) or an outline
	// button; full width and centred in the mobile overlay. 0-4-0 so it wins
	// inside the Captioned / Underline navigation.
	$nav_link = '.wp-block-navigation .wp-block-navigation-item.is-style-button>.wp-block-navigation-item__content,.wp-block-navigation .wp-block-navigation-item.is-style-outline>.wp-block-navigation-item__content{flex-direction:row;align-items:center;justify-content:center;padding:0.5rem 1rem;border-radius:var(--st-radius-s);font-weight:600;text-decoration:none;transition:background-color var(--st-transition,0.2s),color var(--st-transition,0.2s)}'
		. '.wp-block-navigation .wp-block-navigation-item.is-style-button>.wp-block-navigation-item__content{background-color:var(--st-color-brand);color:var(--st-color-base)}'
		. '.wp-block-navigation .wp-block-navigation-item.is-style-button>.wp-block-navigation-item__content:hover{background-color:var(--st-color-brand-hover)}'
		. '.wp-block-navigation .wp-block-navigation-item.is-style-outline>.wp-block-navigation-item__content{border:0.0625rem solid var(--st-color-brand);color:var(--st-color-brand)}'
		. '.wp-block-navigation .wp-block-navigation-item.is-style-outline>.wp-block-navigation-item__content:hover{background-color:var(--st-color-brand);color:var(--st-color-base)}'
		. '.wp-block-navigation .wp-block-navigation-item.is-style-button>.wp-block-navigation-item__content::after,.wp-block-navigation .wp-block-navigation-item.is-style-outline>.wp-block-navigation-item__content::after,.wp-block-navigation .wp-block-navigation-item.is-style-button .wp-block-navigation-item__description,.wp-block-navigation .wp-block-navigation-item.is-style-outline .wp-block-navigation-item__description{display:none}'
		. '.wp-block-navigation .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item.is-style-button,.wp-block-navigation .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item.is-style-outline{border:0;margin-block-start:var(--st-space-m)}'
		. '.wp-block-navigation .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item.is-style-button>.wp-block-navigation-item__content,.wp-block-navigation .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item.is-style-outline>.wp-block-navigation-item__content{inline-size:100%;justify-content:center;padding:0.75rem 1rem}';

	return array(
		array(
			'name'   => 'single-line',
			'blocks' => array( 'core/breadcrumbs' ),
			'label'  => __( 'Single line', 'shitate' ),
			'css'    => '.wp-block-breadcrumbs.is-style-single-line ol{flex-wrap:nowrap;overflow-x:auto;white-space:nowrap;scrollbar-width:none}'
				. '.wp-block-breadcrumbs.is-style-single-line ol::-webkit-scrollbar{display:none}'
				. '.wp-block-breadcrumbs.is-style-single-line li{flex:none}'
				. '.wp-block-breadcrumbs.is-style-single-line a{text-decoration:none}',
		),
		array(
			'name'   => 'chips',
			'blocks' => array( 'core/post-terms', 'core/categories', 'core/paragraph' ),
			'label'  => __( 'Chips', 'shitate' ),
			'css'    => $chips,
		),
		array(
			'name'   => 'two-lines',
			'blocks' => array( 'core/post-title', 'core/post-excerpt' ),
			'label'  => __( 'Two lines', 'shitate' ),
			// The link inside a Post Title is inline-block in core, which would
			// keep the whole title on one (tall) line box; inline lets the clamp cut it.
			'css'    => '.is-style-two-lines.wp-block-post-title,.wp-block-post-excerpt.is-style-two-lines .wp-block-post-excerpt__excerpt{display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;overflow:hidden}'
				. '.is-style-two-lines.wp-block-post-title a{display:inline}',
		),
		array(
			'name'   => 'cards',
			'blocks' => array( 'core/post-template' ),
			'label'  => __( 'Cards', 'shitate' ),
			'css'    => $cards . '{row-gap:var(--st-space-xl)}'
				. $cards . ' .wp-block-post-title{font-size:var(--st-text-m)}'
				. $cards . '>li>.wp-block-post-featured-image+*{margin-block-start:var(--st-space-m)}'
				. $cards . '>li>.wp-block-post-excerpt{margin-block-end:0}'
				. $media( 'cards' ),
		),
		array(
			'name'   => 'cards-featured',
			'blocks' => array( 'core/post-template' ),
			'label'  => __( 'Cards, first post large', 'shitate' ),
			'css'    => $feat . '{row-gap:var(--st-space-xl);container-type:inline-size}'
				. $feat . ' .wp-block-post-title{font-size:var(--st-text-m)}'
				. $feat . '>li>.wp-block-post-featured-image+*{margin-block-start:var(--st-space-m)}'
				. $feat . '>li>.wp-block-post-excerpt{margin-block-end:0}'
				. $first . '{grid-column:1/-1;display:grid;grid-template-columns:minmax(0,7fr) minmax(0,5fr);column-gap:var(--st-space-xl);align-content:center}'
				. $first . '>.wp-block-post-featured-image{grid-row:1/span 4;align-self:center}'
				. $first . '>:not(.wp-block-post-featured-image){grid-column:2}'
				. $first . '>.wp-block-post-featured-image+*{margin-block-start:0}'
				. $first . ':not(:has(>.wp-block-post-featured-image))>*{grid-column:1/-1}'
				. $first . ' .wp-block-post-title{font-size:var(--st-text-xl);-webkit-line-clamp:3}'
				. $first . ' .wp-block-post-excerpt__excerpt{-webkit-line-clamp:3}'
				// From page 2 on, and in a narrow container: an ordinary card.
				. '.paged ' . $first . '{grid-column:auto;display:block}'
				. '.paged ' . $first . ' .wp-block-post-title{font-size:var(--st-text-m);-webkit-line-clamp:2}'
				. '.paged ' . $first . ' .wp-block-post-excerpt__excerpt{-webkit-line-clamp:2}'
				. '.paged ' . $first . '>.wp-block-post-featured-image+*{margin-block-start:var(--st-space-m)}'
				. '@container (max-width:40rem){' . $first . '{display:block}' . $first . ' .wp-block-post-title{font-size:var(--st-text-m);-webkit-line-clamp:2}' . $first . ' .wp-block-post-excerpt__excerpt{-webkit-line-clamp:2}' . $first . '>.wp-block-post-featured-image+*{margin-block-start:var(--st-space-m)}}'
				. $media( 'cards-featured' ),
		),
		array(
			'name'   => 'list',
			'blocks' => array( 'core/post-template' ),
			'label'  => __( 'List', 'shitate' ),
			// One post per row, image left (a third), text right, hairlines
			// between rows; for the default (stacked) post-template layout.
			'css'    => $list . '{display:flex;flex-direction:column;gap:0;container-type:inline-size}'
				. $list . '>li{display:grid;grid-template-columns:minmax(0,4fr) minmax(0,8fr);column-gap:var(--st-space-l);margin:0;padding-block:var(--st-space-l);border-block-end:0.0625rem solid var(--st-color-rule)}'
				. $list . '>li:first-child{border-block-start:0.0625rem solid var(--st-color-rule)}'
				. $list . '>li>.wp-block-post-featured-image{grid-row:1/span 4}'
				. $list . '>li>:not(.wp-block-post-featured-image){grid-column:2}'
				. $list . '>li:not(:has(>.wp-block-post-featured-image))>*{grid-column:1/-1}'
				. $list . '>li>.wp-block-post-excerpt{margin-block-end:0}'
				. $list . ' .wp-block-post-title{font-size:var(--st-text-l)}'
				. '@container (max-width:40rem){' . $list . '>li{display:block}' . $list . '>li>.wp-block-post-featured-image+*{margin-block-start:var(--st-space-m)}}'
				. $media( 'list' ),
		),
		array(
			'name'   => 'rows',
			'blocks' => array( 'core/post-template' ),
			'label'  => __( 'Rows', 'shitate' ),
			// Date, chip and title on one line (news / announcements); no image.
			'css'    => $rows . '{display:flex;flex-direction:column;gap:0}'
				. $rows . '>li{display:flex;flex-wrap:wrap;align-items:center;gap:var(--st-space-xs) var(--st-space-m);margin:0;padding-block:var(--st-space-s);border-block-end:0.0625rem solid var(--st-color-rule)}'
				. $rows . '>li:first-child{border-block-start:0.0625rem solid var(--st-color-rule)}'
				. $rows . '>li>*{margin:0}'
				. $rows . ' .wp-block-post-title{flex:1 1 20rem;font-size:var(--st-text-m);font-weight:500}',
		),
		array(
			'name'   => 'captioned',
			'blocks' => array( 'core/navigation' ),
			'label'  => __( 'Captioned', 'shitate' ),
			'css'    => $nav_style( 'captioned', true ),
		),
		array(
			'name'   => 'underline',
			'blocks' => array( 'core/navigation' ),
			'label'  => __( 'Underline', 'shitate' ),
			'css'    => $nav_style( 'underline', false ),
		),
		array(
			'name'   => 'button',
			'blocks' => array( 'core/navigation-link' ),
			'label'  => __( 'Button', 'shitate' ),
			'css'    => $nav_link,
		),
		array(
			'name'   => 'outline',
			'blocks' => array( 'core/navigation-link' ),
			'label'  => __( 'Outline', 'shitate' ),
			'css'    => $nav_link,
		),
	);
}

/**
 * Register the styles and one inline stylesheet handle per style.
 */
function shitate_register_block_styles() {
	foreach ( shitate_block_style_definitions() as $style ) {
		$handle = 'shitate-style-' . $style['name'];
		wp_register_style( $handle, false, array(), SHITATE_VERSION );
		wp_add_inline_style( $handle, $style['css'] );
		foreach ( $style['blocks'] as $block ) {
			register_block_style(
				$block,
				array(
					'name'  => $style['name'],
					'label' => $style['label'],
				)
			);
		}
	}
}
add_action( 'init', 'shitate_register_block_styles' );

/**
 * Enqueue a style's stylesheet when a block carrying that style renders.
 *
 * @param string $content Rendered block.
 * @param array  $block   Parsed block.
 * @return string
 */
function shitate_enqueue_block_style_css( $content, $block ) {
	if ( empty( $block['attrs']['className'] ) || false === strpos( $block['attrs']['className'], 'is-style-' ) ) {
		return $content;
	}
	static $map = null;
	if ( null === $map ) {
		$map = array();
		foreach ( shitate_block_style_definitions() as $style ) {
			foreach ( $style['blocks'] as $name ) {
				$map[ $name ][ $style['name'] ] = 'shitate-style-' . $style['name'];
			}
		}
	}
	if ( empty( $block['blockName'] ) || empty( $map[ $block['blockName'] ] ) ) {
		return $content;
	}
	preg_match_all( '/\bis-style-([a-z0-9-]+)/', $block['attrs']['className'], $m );
	foreach ( $m[1] as $style_name ) {
		if ( isset( $map[ $block['blockName'] ][ $style_name ] ) ) {
			wp_enqueue_style( $map[ $block['blockName'] ][ $style_name ] );
		}
	}
	return $content;
}
add_filter( 'render_block', 'shitate_enqueue_block_style_css', 10, 2 );

/**
 * The editor needs every style for its previews.
 */
function shitate_enqueue_block_styles_in_editor() {
	if ( ! is_admin() ) {
		return;
	}
	foreach ( shitate_block_style_definitions() as $style ) {
		wp_enqueue_style( 'shitate-style-' . $style['name'] );
	}
}
add_action( 'enqueue_block_assets', 'shitate_enqueue_block_styles_in_editor' );

/**
 * Appearance → Patterns shortcut.
 *
 * Block themes only get "Editor" under Appearance, which buries pattern
 * management inside the Site Editor. Link straight to its patterns view,
 * using the same URL core shows classic themes (wp-admin/menu.php).
 */
function shitate_patterns_admin_menu() {
	add_theme_page(
		__( 'Patterns', 'shitate' ),
		__( 'Patterns', 'shitate' ),
		'edit_theme_options',
		'site-editor.php?p=/pattern'
	);
}
add_action( 'admin_menu', 'shitate_patterns_admin_menu' );

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
function shitate_top_margin_only_supports( $args, $block_name ) {
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
add_filter( 'register_block_type_args', 'shitate_top_margin_only_supports', 10, 2 );

/**
 * Show the font family and appearance (weight / style) controls by default
 * on headings and paragraphs.
 *
 * Core hides them behind the Typography panel's "+" menu and shows only the
 * size, so changing a single heading's face or weight takes three clicks
 * most people never find. The site-wide values still live in Global Styles
 * (Styles → Typography); this only affects which per-block controls are
 * visible in the inspector.
 *
 * @param array  $args       Registered block type arguments.
 * @param string $block_name Block name.
 * @return array Filtered arguments.
 */
function shitate_default_typography_controls( $args, $block_name ) {
	if ( ! in_array( $block_name, array( 'core/paragraph', 'core/heading', 'core/post-title', 'core/list', 'core/quote', 'core/button' ), true ) ) {
		return $args;
	}
	if ( ! isset( $args['supports']['typography'] ) || ! is_array( $args['supports']['typography'] ) ) {
		return $args;
	}
	$defaults = isset( $args['supports']['typography']['__experimentalDefaultControls'] ) && is_array( $args['supports']['typography']['__experimentalDefaultControls'] )
		? $args['supports']['typography']['__experimentalDefaultControls']
		: array();

	$defaults['fontSize']       = true;
	$defaults['fontFamily']     = true;
	$defaults['fontAppearance'] = true;

	$args['supports']['typography']['__experimentalDefaultControls'] = $defaults;

	return $args;
}
add_filter( 'register_block_type_args', 'shitate_default_typography_controls', 10, 2 );

/**
 * Sanitize the type-scale ratio against the allowed list.
 *
 * @param string $value Submitted value.
 * @return string
 */
function shitate_sanitize_ratio( $value ) {
	$allowed = array( '1.067', '1.125', '1.2', '1.25', '1.333', '1.414', '1.5', '1.618' );
	return in_array( (string) $value, $allowed, true ) ? (string) $value : '1.25';
}

/**
 * Sanitize the base text size: an integer in the 12–24px range the control
 * offers (out-of-range or non-numeric input falls back to 16).
 *
 * @param mixed $value Submitted value.
 * @return int
 */
function shitate_sanitize_text_m( $value ) {
	$size = absint( $value );
	return ( $size >= 12 && $size <= 24 ) ? $size : 16;
}

/**
 * Sanitize the small-screen ratio: a whitelisted ratio or "auto".
 *
 * @param mixed $value Submitted value.
 * @return string
 */
function shitate_sanitize_ratio_mobile( $value ) {
	if ( 'auto' === $value ) {
		return 'auto';
	}
	$allowed = array( '1.067', '1.125', '1.2', '1.25', '1.333', '1.414', '1.5', '1.618' );
	return in_array( (string) $value, $allowed, true ) ? (string) $value : 'auto';
}

/**
 * Customizer: typography scale (ratio + base) with live preview.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
/**
 * Post types whose posts can carry a type-scale override (the editor
 * "shitate settings" panel): every public post type with an admin UI except
 * attachments.
 *
 * @return WP_Post_Type[] Keyed by post type name.
 */
function shitate_scale_post_types() {
	$types = get_post_types( array( 'public' => true, 'show_ui' => true ), 'objects' );
	unset( $types['attachment'] );
	return apply_filters( 'shitate_scale_post_types', $types );
}

/**
 * Sanitize an optional ratio: '' (inherit) or one of the eight ratios.
 *
 * @param mixed $value Submitted value.
 * @return string
 */
function shitate_sanitize_ratio_optional( $value ) {
	$value = (string) $value;
	return '' === $value ? '' : shitate_sanitize_ratio( $value );
}

/**
 * Sanitize an optional base size: 0 (inherit) or 12–24.
 *
 * @param mixed $value Submitted value.
 * @return int
 */
function shitate_sanitize_text_m_optional( $value ) {
	$size = absint( $value );
	return ( $size >= 12 && $size <= 24 ) ? $size : 0;
}

/**
 * Resolve the ratio and base size for a post: post override → site-wide
 * Customizer value.
 *
 * @param int $post_id Post ID (optional).
 * @return array{ratio:string,base:int}
 */
function shitate_scale_for( $post_id = 0 ) {
	$ratio = shitate_sanitize_ratio( get_theme_mod( 'shitate_ratio', '1.25' ) );
	$base  = shitate_sanitize_text_m( get_theme_mod( 'shitate_text_m', 16 ) );

	if ( $post_id ) {
		$post_ratio = shitate_sanitize_ratio_optional( get_post_meta( $post_id, '_shitate_ratio', true ) );
		$post_base  = shitate_sanitize_text_m_optional( get_post_meta( $post_id, '_shitate_text_m', true ) );
		if ( '' !== $post_ratio ) {
			$ratio = $post_ratio;
		}
		if ( $post_base ) {
			$base = $post_base;
		}
	}

	return array(
		'ratio' => $ratio,
		'base'  => $base,
	);
}

/**
 * The eight ratio choices, keyed by value, with their translated labels.
 *
 * @return array<string,string>
 */
function shitate_ratio_choices() {
	return array(
		'1.067' => __( 'Minor Second — 1.067', 'shitate' ),
		'1.125' => __( 'Major Second — 1.125', 'shitate' ),
		'1.2'   => __( 'Minor Third — 1.2', 'shitate' ),
		'1.25'  => __( 'Major Third — 1.25', 'shitate' ),
		'1.333' => __( 'Perfect Fourth — 1.333', 'shitate' ),
		'1.414' => __( 'Augmented Fourth — 1.414', 'shitate' ),
		'1.5'   => __( 'Perfect Fifth — 1.5', 'shitate' ),
		'1.618' => __( 'Golden Ratio — 1.618', 'shitate' ),
	);
}

function shitate_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'shitate_typography',
		array(
			'title'    => __( 'Typography Scale', 'shitate' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'shitate_ratio',
		array(
			'default'           => '1.25',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'shitate_sanitize_ratio',
		)
	);
	$wp_customize->add_control(
		'shitate_ratio',
		array(
			'type'        => 'select',
			'section'     => 'shitate_typography',
			'label'       => __( 'Scale ratio', 'shitate' ),
			'description' => __( 'Bigger ratio = more contrast between headings.', 'shitate' ),
			'choices'     => shitate_ratio_choices(),
		)
	);

	$wp_customize->add_setting(
		'shitate_ratio_mobile',
		array(
			'default'           => 'auto',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'shitate_sanitize_ratio_mobile',
		)
	);
	$wp_customize->add_control(
		'shitate_ratio_mobile',
		array(
			'type'        => 'select',
			'section'     => 'shitate_typography',
			'label'       => __( 'Scale ratio on small screens', 'shitate' ),
			'description' => __( 'The ratio used at 375px wide. The type scale eases from this to the main ratio by the wide layout width (1260px by default), so headings tighten on phones without media queries. Spacing is not affected.', 'shitate' ),
			'choices'     => array(
				'auto'  => __( 'Auto — halfway between 1 and the main ratio', 'shitate' ),
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
		'shitate_text_m',
		array(
			'default'           => 16,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'shitate_sanitize_text_m',
		)
	);
	$wp_customize->add_control(
		'shitate_text_m',
		array(
			'type'        => 'number',
			'section'     => 'shitate_typography',
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
		'shitate_round_scale',
		array(
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'shitate_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shitate_round_scale',
		array(
			'type'        => 'checkbox',
			'section'     => 'shitate_typography',
			'label'       => __( 'Apply rounding to font sizes', 'shitate' ),
			'description' => __( 'Snaps every text step to even pixels (2px).', 'shitate' ),
		)
	);

	$wp_customize->add_setting(
		'shitate_fixed_small_text',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'shitate_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shitate_fixed_small_text',
		array(
			'type'        => 'checkbox',
			'section'     => 'shitate_typography',
			'label'       => __( 'Fixed sizes for small text', 'shitate' ),
			'description' => __( 'Sets Small / X-Small / XX-Small to 0.95rem / 0.8rem / 0.75rem instead of dividing by the ratio, which can make them too small to read.', 'shitate' ),
		)
	);

	$wp_customize->add_setting(
		'shitate_ja_typography',
		array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => 'shitate_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shitate_ja_typography',
		array(
			'type'        => 'checkbox',
			'section'     => 'shitate_typography',
			'label'       => __( 'Japanese typography', 'shitate' ),
			'description' => __( 'When the site language is Japanese, applies print-style typesetting: strict line-breaking rules (no small kana or long-vowel marks at the start of a line), automatic spacing between Japanese and Latin text, and proportional kana/kanji spacing (palt). Code blocks are left alone.', 'shitate' ),
		)
	);
}
add_action( 'customize_register', 'shitate_customize_register' );

/**
 * Sanitize a Customizer checkbox.
 *
 * @param mixed $value Submitted value.
 * @return bool
 */
function shitate_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Build the type-scale override CSS from the saved Customizer values and,
 * for a post, its own override.
 *
 * @param int $post_id Post ID (optional).
 * @return string
 */
function shitate_scale_inline_css( $post_id = 0 ) {
	$scale = shitate_scale_for( $post_id );
	$ratio = $scale['ratio'];
	$base  = $scale['base'];

	$css = shitate_font_inline_css();
	$css .= ':root{--st-ratio:' . $ratio . ';--st-text-m:' . $base . 'px;';
	// Small-screen ratio: the low end of the fluid ratio (tokens.css derives
	// (1 + ratio) / 2 when this is "auto").
	$mobile = shitate_sanitize_ratio_mobile( get_theme_mod( 'shitate_ratio_mobile', 'auto' ) );
	if ( 'auto' !== $mobile ) {
		$css .= '--st-ratio-min:' . $mobile . ';';
	}
	$css .= '}';

	$fixed_small = (bool) get_theme_mod( 'shitate_fixed_small_text', false );

	// Optional rounding: every text step snapped to even pixels (2px). The
	// steps are recomputed from the base with the fluid ratio (--st-r, see
	// tokens.css) rather than chained from each other, so rounding errors do
	// not compound. Fluidity itself lives in the ratio and is always on.
	if ( get_theme_mod( 'shitate_round_scale', true ) ) {
		$css .= ':root{';
		if ( ! $fixed_small ) {
			$css .= '--st-text-s:round(nearest, calc(var(--st-text-m) / var(--st-r)), 2px);'
				. '--st-text-xs:round(nearest, calc(var(--st-text-m) / var(--st-r) / var(--st-r)), 2px);'
				. '--st-text-xxs:round(nearest, calc(var(--st-text-m) / var(--st-r) / var(--st-r) / var(--st-r)), 2px);';
		}
		$css .= '--st-text-l:round(nearest, calc(var(--st-text-m) * var(--st-r)), 2px);'
			. '--st-text-xl:round(nearest, calc(var(--st-text-m) * var(--st-r) * var(--st-r)), 2px);'
			. '--st-text-xxl:round(nearest, calc(var(--st-text-m) * var(--st-r) * var(--st-r) * var(--st-r)), 2px);'
			. '--st-text-xxxl:round(nearest, calc(var(--st-text-m) * var(--st-r) * var(--st-r) * var(--st-r) * var(--st-r)), 2px);'
			. '}';
	}

	// "Fixed sizes for small text": pin the three steps below the base to
	// readable rem values instead of dividing by the ratio (xx-small would be
	// 8px at 1.25). Emitted last so it wins over the rounded chain above.
	if ( $fixed_small ) {
		$css .= ':root{--st-text-s:0.95rem;--st-text-xs:0.8rem;--st-text-xxs:0.75rem;}';
	}

	$css .= shitate_ja_typography_css();

	return $css;
}

/**
 * Japanese typesetting rules (Customizer "Japanese typography", off by default).
 *
 * Emitted only when the switch is on AND the request locale is Japanese, the
 * same test the font stack uses, so the rules follow multilingual plugins
 * that switch the locale per page and reach the editor canvas through the
 * same inline CSS. Everything is `:where()` (specificity 0) so site CSS wins.
 *
 * - line-break: strict — print-style kinsoku: no small kana or long-vowel
 *   marks at the start of a line. Supported everywhere.
 * - text-autospace: normal — a quarter-em between Japanese and Latin text.
 *   The initial value in browsers that implement it (Baseline 2025); stated
 *   explicitly so a reset or plugin cannot switch it off.
 * - font-feature-settings: "palt" — proportional kana/kanji widths, applied
 *   site-wide (the owner's call: tighter running text is a common choice on
 *   Japanese sites). Code elements keep full-width metrics. Fonts without the
 *   feature (Meiryo) simply ignore it.
 * word-break: auto-phrase is deliberately not used: shitate pro blocks has
 * [wbr] for manual phrase breaks, and the automatic one is Chromium-only.
 *
 * @return string
 */
function shitate_ja_typography_css() {
	if ( ! get_theme_mod( 'shitate_ja_typography', false ) ) {
		return '';
	}
	if ( 'ja' !== substr( determine_locale(), 0, 2 ) ) {
		return '';
	}
	return ':where(body){line-break:strict;text-autospace:normal;font-feature-settings:"palt" 1}'
		. ':where(code,pre,kbd,samp){font-feature-settings:normal}';
}

/**
 * Font stack override for Japanese sites.
 *
 * tokens.css ships a system-font stack with no CJK font in it, so every
 * language gets its OS's native fonts and ideographs fall back by page
 * language. Japanese sites get a Japanese-first stack instead (Hiragino on
 * macOS, Yu Gothic Medium then Meiryo on Windows). Decided from the request
 * locale, so multilingual plugins that switch the locale per page are
 * honoured, and it reaches the editor canvas through the same inline CSS.
 *
 * @return string
 */
function shitate_font_inline_css() {
	if ( 'ja' !== substr( determine_locale(), 0, 2 ) ) {
		return '';
	}
	return ':root{'
		. '--st-font-sans:-apple-system,BlinkMacSystemFont,"Hiragino Sans","Hiragino Kaku Gothic ProN","Yu Gothic Medium","Yu Gothic",Meiryo,"Segoe UI",sans-serif,"Apple Color Emoji","Segoe UI Emoji";'
		. '--st-font-serif:"Hiragino Mincho ProN","Yu Mincho","Noto Serif JP",Georgia,"Times New Roman",serif;'
		. '}';
}

/**
 * Apply the scale override inside the block editor (iframe canvas).
 *
 * Appending to the editor "styles" array injects the CSS into the editor iframe
 * after the theme's editor styles, so it reliably overrides tokens.css there.
 * The front end is handled in shitate_enqueue_styles().
 *
 * @param array $settings Block editor settings.
 * @return array
 */
function shitate_scale_editor_settings( $settings, $context = null ) {
	if ( ! isset( $settings['styles'] ) || ! is_array( $settings['styles'] ) ) {
		$settings['styles'] = array();
	}
	$post_id = 0;
	if ( $context && ! empty( $context->post ) && $context->post instanceof WP_Post ) {
		$post_id = (int) $context->post->ID;
	}
	$settings['styles'][] = array( 'css' => shitate_scale_inline_css( $post_id ) );
	return $settings;
}
add_filter( 'block_editor_settings_all', 'shitate_scale_editor_settings', 10, 2 );

/**
 * Live preview script for the Customizer.
 */
function shitate_customize_preview_js() {
	wp_enqueue_script(
		'shitate-customize-preview',
		get_theme_file_uri( 'assets/js/customize-preview.js' ),
		array( 'customize-preview' ),
		SHITATE_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'shitate_customize_preview_js' );

/**
 * Block toolbar "Spacing" dropdown that toggles the utility classes
 * (mt-0 … p-xxxl) on any block, so they can be adjusted without typing.
 */
function shitate_utilities_toolbar_script() {
	wp_enqueue_script(
		'shitate-utilities-toolbar',
		get_theme_file_uri( 'assets/js/utilities-toolbar.js' ),
		array( 'wp-hooks', 'wp-compose', 'wp-element', 'wp-blocks', 'wp-block-editor', 'wp-components', 'wp-i18n' ),
		SHITATE_VERSION,
		true
	);
	wp_set_script_translations( 'shitate-utilities-toolbar', 'shitate', get_template_directory() . '/languages' );
}
add_action( 'enqueue_block_editor_assets', 'shitate_utilities_toolbar_script' );

/**
 * Per-post overrides: ratio, base size and "hide the page title", stored as
 * post meta and edited from the "Type scale" panel in the editor sidebar.
 */
function shitate_register_scale_meta() {
	foreach ( array_keys( shitate_scale_post_types() ) as $type ) {
		register_post_meta(
			$type,
			'_shitate_ratio',
			array(
				'type'              => 'string',
				'single'            => true,
				'default'           => '',
				'show_in_rest'      => true,
				'sanitize_callback' => 'shitate_sanitize_ratio_optional',
				'auth_callback'     => 'shitate_scale_meta_auth',
			)
		);
		register_post_meta(
			$type,
			'_shitate_text_m',
			array(
				'type'              => 'integer',
				'single'            => true,
				'default'           => 0,
				'show_in_rest'      => true,
				'sanitize_callback' => 'shitate_sanitize_text_m_optional',
				'auth_callback'     => 'shitate_scale_meta_auth',
			)
		);
		register_post_meta(
			$type,
			'_shitate_hide_title',
			array(
				'type'              => 'boolean',
				'single'            => true,
				'default'           => false,
				'show_in_rest'      => true,
				'sanitize_callback' => 'rest_sanitize_boolean',
				'auth_callback'     => 'shitate_scale_meta_auth',
			)
		);
	}
}
add_action( 'init', 'shitate_register_scale_meta', 20 );

/**
 * Only users who can edit the post may change its scale meta.
 *
 * @param bool   $allowed  Unused.
 * @param string $meta_key Unused.
 * @param int    $post_id  Post ID.
 * @return bool
 */
function shitate_scale_meta_auth( $allowed, $meta_key, $post_id ) {
	return current_user_can( 'edit_post', $post_id );
}

/**
 * "Hide the page title": drop the Post Title block of the page being viewed.
 *
 * Only the title of the queried singular post is affected, so titles in
 * query loops, cards and the document <title> stay as they are.
 *
 * @param string $block_content Rendered block.
 * @param array  $block         Parsed block.
 * @return string
 */
function shitate_maybe_hide_post_title( $block_content, $block, $instance = null ) {
	if ( ! is_singular() ) {
		return $block_content;
	}
	// Only the page's own title: a title inside a Query Loop (which may list
	// the same post) stays. The parsed block has no context; the instance does.
	if ( $instance instanceof WP_Block && isset( $instance->context['queryId'] ) ) {
		return $block_content;
	}
	$queried = (int) get_queried_object_id();
	$post_id = ( $instance instanceof WP_Block && isset( $instance->context['postId'] ) ) ? (int) $instance->context['postId'] : (int) get_the_ID();
	if ( $queried && $post_id === $queried && get_post_meta( $queried, '_shitate_hide_title', true ) ) {
		return '';
	}
	return $block_content;
}
add_filter( 'render_block_core/post-title', 'shitate_maybe_hide_post_title', 10, 3 );

/**
 * Editor sidebar panel "shitate settings": per-post ratio, base size and
 * the hide-title switch, with a live preview in the canvas.
 */
function shitate_scale_panel_script() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || empty( $screen->post_type ) || ! array_key_exists( $screen->post_type, shitate_scale_post_types() ) ) {
		return;
	}
	wp_enqueue_script(
		'shitate-scale-panel',
		get_theme_file_uri( 'assets/js/scale-panel.js' ),
		array( 'wp-plugins', 'wp-editor', 'wp-element', 'wp-components', 'wp-data', 'wp-i18n' ),
		SHITATE_VERSION,
		true
	);
	$inherited = shitate_scale_for( 0 );
	wp_add_inline_script(
		'shitate-scale-panel',
		'window.shitateScalePanel = ' . wp_json_encode(
			array(
				'ratios'    => shitate_ratio_choices(),
				'inherited' => $inherited,
				'minBase'   => 12,
				'maxBase'   => 24,
			)
		) . ';',
		'before'
	);
	wp_set_script_translations( 'shitate-scale-panel', 'shitate', get_template_directory() . '/languages' );
}
add_action( 'enqueue_block_editor_assets', 'shitate_scale_panel_script' );

/**
 * Enqueue front-end styles.
 *
 * Normally one request: assets/css/shitate-reset.min.css (or shitate.min.css
 * when the reset layer is filtered off), built from reset → tokens →
 * utilities → style.css by bin/build-css.mjs. With SCRIPT_DEBUG the four
 * source files load separately. The bundle is registered under the
 * `shitate-tokens` handle and the other handles become empty aliases, so
 * inline styles and dependencies keyed to any of them keep working; a child
 * theme's own style.css still loads as `shitate-style`.
 */
function shitate_enqueue_styles() {
	$use_reset = shitate_use_reset();
	$bundle    = $use_reset ? 'assets/css/shitate-reset.min.css' : 'assets/css/shitate.min.css';
	$debug     = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
	/**
	 * Serve the minified bundle (true) or the four source files (false).
	 * The per-file branch keeps 'shitate-reset' / 'shitate-utilities' /
	 * 'shitate-style' as real stylesheets a child theme can dequeue.
	 *
	 * @param bool $use_bundle Default: true unless SCRIPT_DEBUG.
	 */
	$use_bundle = (bool) apply_filters( 'shitate_use_bundle', ! $debug );
	if ( $use_bundle && file_exists( get_theme_file_path( $bundle ) ) ) {
		wp_enqueue_style(
			'shitate-tokens',
			get_theme_file_uri( $bundle ),
			array(),
			SHITATE_VERSION
		);
		wp_register_style( 'shitate-reset', false, array( 'shitate-tokens' ), SHITATE_VERSION );
		wp_register_style( 'shitate-utilities', false, array( 'shitate-tokens' ), SHITATE_VERSION );
		wp_enqueue_style( 'shitate-utilities' );
		// wp_enqueue_style() only registers when it gets a src, so the alias is
		// registered explicitly: code that lists 'shitate-style' as a dependency
		// must keep working when the bundle is in use.
		wp_register_style(
			'shitate-style',
			is_child_theme() ? get_stylesheet_uri() : false,
			array( 'shitate-tokens', 'shitate-utilities' ),
			SHITATE_VERSION
		);
		wp_enqueue_style( 'shitate-style' );
	} else {
		$deps = array();
		if ( $use_reset ) {
			// Base reset first: zero-specificity rules core does not cover.
			wp_enqueue_style(
				'shitate-reset',
				get_theme_file_uri( 'assets/css/reset.css' ),
				array(),
				SHITATE_VERSION
			);
			$deps[] = 'shitate-reset';
		}
		wp_enqueue_style(
			'shitate-tokens',
			get_theme_file_uri( 'assets/css/tokens.css' ),
			$deps,
			SHITATE_VERSION
		);
		wp_enqueue_style(
			'shitate-utilities',
			get_theme_file_uri( 'assets/css/utilities.css' ),
			array( 'shitate-tokens' ),
			SHITATE_VERSION
		);
		wp_enqueue_style(
			'shitate-style',
			get_stylesheet_uri(),
			array( 'shitate-tokens', 'shitate-utilities' ),
			SHITATE_VERSION
		);
	}
	// Customizer type-scale override, right after the tokens so it always wins.
	$scale_id = is_singular() ? (int) get_queried_object_id() : 0;
	wp_add_inline_style( 'shitate-tokens', shitate_scale_inline_css( $scale_id ) );
	// Translated label for sticky posts in list cards (CSS generated content).
	wp_add_inline_style( 'shitate-tokens', ':root{--st-label-pickup:"' . str_replace( array( '\\', '"' ), array( '\\\\', '\\"' ), __( 'PICKUP', 'shitate' ) ) . '"}' );
}
add_action( 'wp_enqueue_scripts', 'shitate_enqueue_styles' );

/**
 * Front-end script that keeps the mobile menu's close button aligned with the
 * hamburger (see assets/js/navigation-toggle.js and style.css).
 */
function shitate_enqueue_navigation_toggle() {
	wp_enqueue_script(
		'shitate-navigation-toggle',
		get_theme_file_uri( 'assets/js/navigation-toggle.js' ),
		array(),
		SHITATE_VERSION,
		array( 'in_footer' => true, 'strategy' => 'defer' )
	);
}
add_action( 'wp_enqueue_scripts', 'shitate_enqueue_navigation_toggle' );
