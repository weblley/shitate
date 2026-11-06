<?php
/**
 * Placeholder thumbnails for posts without a featured image.
 *
 * In a Query Loop, a Post Featured Image block renders nothing when the post
 * has no featured image, so that card or list row loses its picture and the
 * grid turns uneven. With the Customizer switch on (Thumbnails → Show a
 * placeholder…, on by default) those posts get a placeholder instead: the
 * image picked in the Customizer, or, when none is picked, a tinted panel
 * with an image icon drawn in CSS, so it follows the palette and every style
 * variation.
 *
 * Only Query Loop thumbnails are affected (see shitate_in_post_template());
 * the featured image at the top of a single post or page stays empty, as
 * before. Core still builds the block's link, figure and wrapper
 * styles: the theme only supplies the missing image through
 * post_thumbnail_html while the block renders, so the aspect ratio, scale,
 * border and link settings of the block apply to the placeholder as well.
 *
 * The markup can be replaced with the shitate_noimage_html filter.
 *
 * @package shitate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether posts without a featured image get a placeholder in Query Loops.
 *
 * @return bool
 */
function shitate_noimage_enabled() {
	return (bool) get_theme_mod( 'shitate_noimage', true );
}

/**
 * Sanitize the placeholder image: an image attachment ID, or 0 for the
 * theme's own placeholder.
 *
 * @param mixed $value Submitted value.
 * @return int
 */
function shitate_sanitize_noimage_image( $value ) {
	$id = absint( $value );
	return ( $id && wp_attachment_is_image( $id ) ) ? $id : 0;
}

/**
 * The placeholder that stands in for the missing <img>.
 *
 * @param string|int[] $size Image size the block asked for.
 * @param array        $attr Attributes core prepared for the image (alt, style, class).
 * @return string
 */
function shitate_noimage_markup( $size, $attr ) {
	$image_id = shitate_sanitize_noimage_image( get_theme_mod( 'shitate_noimage_image', 0 ) );

	if ( $image_id ) {
		// Decorative unless the block links it, where core put the post title in alt.
		$attr['alt'] = isset( $attr['alt'] ) ? $attr['alt'] : '';
		$html        = wp_get_attachment_image( $image_id, $size, false, $attr );
	} else {
		wp_enqueue_style( 'shitate-noimage' );
		$label = isset( $attr['alt'] ) ? (string) $attr['alt'] : '';
		$class = trim( 'shitate-noimage ' . ( isset( $attr['class'] ) ? $attr['class'] : '' ) );
		$html  = '<span class="' . esc_attr( $class ) . '"'
			. ( empty( $attr['style'] ) ? '' : ' style="' . esc_attr( $attr['style'] ) . '"' )
			. ( '' === $label ? ' aria-hidden="true"' : ' role="img" aria-label="' . esc_attr( $label ) . '"' )
			. '></span>';
	}

	/**
	 * Filters the placeholder shown for a post without a featured image.
	 *
	 * @param string       $html     Placeholder markup (an <img> or the theme's <span>).
	 * @param int          $image_id Attachment picked in the Customizer, 0 for the theme placeholder.
	 * @param string|int[] $size     Image size the block asked for.
	 * @param array        $attr     Attributes core prepared for the image.
	 */
	return (string) apply_filters( 'shitate_noimage_html', $html, $image_id, $size, $attr );
}

/**
 * Wrap the Post Featured Image block's render callback so a Query Loop
 * thumbnail without an image gets the placeholder.
 *
 * @param array  $args       Block type arguments.
 * @param string $block_type Block name.
 * @return array
 */
function shitate_noimage_block_args( $args, $block_type ) {
	if ( 'core/post-featured-image' !== $block_type || empty( $args['render_callback'] ) || ! is_callable( $args['render_callback'] ) ) {
		return $args;
	}

	$render                  = $args['render_callback'];
	$args['render_callback'] = static function ( $attributes, $content, $block ) use ( $render ) {
		$output = call_user_func( $render, $attributes, $content, $block );

		// Only an empty thumbnail inside a Query Loop (this also leaves a
		// "use the first image of the post" result alone).
		if ( '' !== $output || ! ( $block instanceof WP_Block ) || ! isset( $block->context['postId'] ) || ! shitate_in_post_template() || ! shitate_noimage_enabled() ) {
			return $output;
		}

		$post_id = (int) $block->context['postId'];
		$used    = false;
		$filter  = static function ( $html, $id, $thumbnail_id, $size, $attr ) use ( $post_id, &$used ) {
			if ( '' !== $html || (int) $id !== $post_id ) {
				return $html;
			}
			$used = true;
			return shitate_noimage_markup( $size, is_array( $attr ) ? $attr : array() );
		};

		add_filter( 'post_thumbnail_html', $filter, 10, 5 );
		$output = call_user_func( $render, $attributes, $content, $block );
		remove_filter( 'post_thumbnail_html', $filter, 10 );

		if ( $used ) {
			// Let styles tell a placeholder from a real image.
			$tags = new WP_HTML_Tag_Processor( $output );
			if ( $tags->next_tag( 'figure' ) ) {
				$tags->add_class( 'is-shitate-noimage' );
				$output = $tags->get_updated_html();
			}
		}

		return $output;
	};

	return $args;
}
add_filter( 'register_block_type_args', 'shitate_noimage_block_args', 10, 2 );

/**
 * Register the placeholder stylesheet (inline, enqueued only when a
 * placeholder is printed).
 */
function shitate_noimage_register_style() {
	$icon = "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48' fill='none' stroke='%23000' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='6' y='9' width='36' height='30' rx='3'/%3E%3Ccircle cx='17' cy='19' r='3.5' fill='%23000' stroke='none'/%3E%3Cpath d='M8 35l10-11 7 7 5-5 10 9'/%3E%3C/svg%3E\") center/contain no-repeat";

	wp_register_style( 'shitate-noimage', false, array(), SHITATE_VERSION );
	wp_add_inline_style(
		'shitate-noimage',
		'.shitate-noimage{display:grid;place-items:center;inline-size:100%;aspect-ratio:16/9;background-color:var(--st-color-base-2)}'
		. '.shitate-noimage::before{content:"";inline-size:clamp(1.5rem,16%,3rem);aspect-ratio:1;background-color:var(--st-color-rule);-webkit-mask:' . $icon . ';mask:' . $icon . '}'
	);
}
add_action( 'init', 'shitate_noimage_register_style' );

/**
 * Customizer: Thumbnails section with the placeholder switch and image.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function shitate_noimage_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'shitate_thumbnails',
		array(
			'title'    => __( 'Thumbnails', 'shitate' ),
			'priority' => 42,
		)
	);

	$wp_customize->add_setting(
		'shitate_noimage',
		array(
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'shitate_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'shitate_noimage',
		array(
			'type'        => 'checkbox',
			'section'     => 'shitate_thumbnails',
			'label'       => __( 'Show a placeholder for posts without a featured image', 'shitate' ),
			'description' => __( 'Used for the featured image in post lists (Query Loop) when a post has none. The featured image on a single post or page is not affected.', 'shitate' ),
		)
	);

	$wp_customize->add_setting(
		'shitate_noimage_image',
		array(
			'default'           => 0,
			'transport'         => 'refresh',
			'sanitize_callback' => 'shitate_sanitize_noimage_image',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'shitate_noimage_image',
			array(
				'section'         => 'shitate_thumbnails',
				'label'           => __( 'Placeholder image', 'shitate' ),
				'description'     => __( 'Leave empty to use the theme placeholder: a tinted panel with an image icon in the site colors, which follows the style variation. A landscape image (16:9) suits the cards best.', 'shitate' ),
				'mime_type'       => 'image',
				'active_callback' => 'shitate_noimage_enabled',
			)
		)
	);
}
add_action( 'customize_register', 'shitate_noimage_customize_register' );
