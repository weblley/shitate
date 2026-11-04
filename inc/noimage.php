<?php
/**
 * Placeholder thumbnails for posts without a featured image.
 *
 * In a Query Loop, a Post Featured Image block renders nothing when the post
 * has no featured image, so that card or list row loses its picture and the
 * grid turns uneven. With the Customizer switch on (Thumbnails → Show a
 * placeholder…, on by default) those posts get a placeholder instead, set in
 * Thumbnails → Placeholder image:
 *
 * - by default, the No Image picture that ships with the theme
 *   (assets/images/noimage.webp; a child theme replaces it by shipping a
 *   file at the same path);
 * - an image picked from the media library;
 * - when the image is removed, a tinted panel with an image icon drawn in
 *   CSS, which follows the palette and every style variation.
 *
 * Only Query Loop thumbnails are affected (see shitate_in_post_template());
 * the featured image at the top of a single post or page stays empty, as
 * before. Core still builds the block's link, figure and wrapper
 * styles: the theme only supplies the missing image through
 * post_thumbnail_html while the block renders, so the aspect ratio, scale,
 * border and link settings of the block apply to the placeholder as well
 * (except that the bundled picture is never cropped, see
 * shitate_noimage_default_markup()).
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
 * URL of the No Image picture that ships with the theme (or of the child
 * theme's file at the same path).
 *
 * @return string
 */
function shitate_noimage_default_url() {
	return get_theme_file_uri( 'assets/images/noimage.webp' );
}

/**
 * Whether a URL points at the bundled picture, of this site or of the site
 * before a move (any host, parent or child theme folder).
 *
 * @param string $url URL.
 * @return bool
 */
function shitate_noimage_is_default_url( $url ) {
	$path = wp_parse_url( (string) $url, PHP_URL_PATH );
	return is_string( $path ) && str_ends_with( $path, '/assets/images/noimage.webp' );
}

/**
 * Sanitize the placeholder image setting.
 *
 * The Customizer image control sends the URL of the picked image, the URL of
 * the bundled picture when "Default" is clicked, and an empty string when the
 * image is removed.
 *
 * @param mixed $value Submitted value.
 * @return string Image URL, the bundled picture's URL, or '' for the panel.
 */
function shitate_sanitize_noimage_image( $value ) {
	if ( ! is_string( $value ) || '' === trim( $value ) ) {
		return '';
	}
	return shitate_noimage_is_default_url( $value ) ? shitate_noimage_default_url() : esc_url_raw( $value );
}

/**
 * Read the placeholder image setting. A stored URL of the bundled picture
 * always reads as the current one, so the default keeps working after a site
 * move or a switch to a child theme.
 *
 * @param mixed $value Stored value, or the default passed to get_theme_mod().
 * @return mixed
 */
function shitate_noimage_image_mod( $value ) {
	if ( false === $value || ( is_string( $value ) && shitate_noimage_is_default_url( $value ) ) ) {
		return shitate_noimage_default_url();
	}
	return $value;
}
add_filter( 'theme_mod_shitate_noimage_image', 'shitate_noimage_image_mod' );

/**
 * Attachment ID of the picked image (looked up once per request).
 *
 * @param string $url Image URL saved by the Customizer.
 * @return int
 */
function shitate_noimage_attachment_id( $url ) {
	static $ids = array();
	if ( ! isset( $ids[ $url ] ) ) {
		$ids[ $url ] = (int) attachment_url_to_postid( $url );
	}
	return $ids[ $url ];
}

/**
 * The placeholder that stands in for the missing <img>.
 *
 * @param string|int[] $size Image size the block asked for.
 * @param array        $attr Attributes core prepared for the image (alt, style, class).
 * @return string
 */
function shitate_noimage_markup( $size, $attr ) {
	$image    = get_theme_mod( 'shitate_noimage_image', shitate_noimage_default_url() );
	$image_id = 0;

	if ( is_numeric( $image ) ) {
		$image_id = absint( $image );
	} elseif ( is_string( $image ) && '' !== $image && shitate_noimage_default_url() !== $image ) {
		$image_id = shitate_noimage_attachment_id( $image );
	}
	if ( $image_id && ! wp_attachment_is_image( $image_id ) ) {
		$image_id = 0;
	}

	if ( '' === $image || null === $image ) {
		$html = shitate_noimage_panel_markup( $attr );
	} elseif ( $image_id ) {
		// Decorative unless the block links it, where core put the post title in alt.
		$attr['alt'] = isset( $attr['alt'] ) ? $attr['alt'] : '';
		$html        = wp_get_attachment_image( $image_id, $size, false, $attr );
	} else {
		// The bundled picture, also when the picked image has been deleted.
		$html = shitate_noimage_default_markup( $attr );
	}

	/**
	 * Filters the placeholder shown for a post without a featured image.
	 *
	 * @param string       $html     Placeholder markup (an <img>, or the theme's <span> panel).
	 * @param int          $image_id Attachment picked in the Customizer, 0 for the theme's own placeholder.
	 * @param string|int[] $size     Image size the block asked for.
	 * @param array        $attr     Attributes core prepared for the image.
	 */
	return (string) apply_filters( 'shitate_noimage_html', $html, $image_id, $size, $attr );
}

/**
 * The bundled No Image picture as an <img>.
 *
 * The picture is a 16:9 graphic with text, so it is never cropped: in a frame
 * of another shape it is shown whole on its own white instead of following
 * the block's "cover" scale.
 *
 * @param array $attr Attributes core prepared for the image.
 * @return string
 */
function shitate_noimage_default_markup( $attr ) {
	static $dimensions = null;
	if ( null === $dimensions ) {
		$dimensions = wp_getimagesize( get_theme_file_path( 'assets/images/noimage.webp' ) );
	}

	// Keep core's sizing and border styles, swap its object-fit for contain.
	$style = '';
	foreach ( explode( ';', isset( $attr['style'] ) ? (string) $attr['style'] : '' ) as $declaration ) {
		$declaration = trim( $declaration );
		if ( '' !== $declaration && 0 !== stripos( $declaration, 'object-fit' ) ) {
			$style .= $declaration . ';';
		}
	}

	$img = array(
		'src'   => shitate_noimage_default_url(),
		'alt'   => isset( $attr['alt'] ) ? (string) $attr['alt'] : '',
		'class' => trim( 'shitate-noimage-image ' . ( isset( $attr['class'] ) ? $attr['class'] : '' ) ),
		'style' => $style . 'object-fit:contain;background-color:#fff;',
	);
	if ( $dimensions ) {
		$img['width']  = (int) $dimensions[0];
		$img['height'] = (int) $dimensions[1];
	}
	// Same loading hints as a real thumbnail in this position.
	$img = array_merge( $img, wp_get_loading_optimization_attributes( 'img', $img, 'wp_get_attachment_image' ) );

	$html = '<img';
	foreach ( $img as $name => $value ) {
		$html .= ' ' . $name . '="' . ( 'src' === $name ? esc_url( $value ) : esc_attr( $value ) ) . '"';
	}
	return $html . ' />';
}

/**
 * The panel placeholder: a tinted box with an image icon drawn in CSS, so it
 * follows the palette and every style variation.
 *
 * @param array $attr Attributes core prepared for the image.
 * @return string
 */
function shitate_noimage_panel_markup( $attr ) {
	wp_enqueue_style( 'shitate-noimage' );
	$label = isset( $attr['alt'] ) ? (string) $attr['alt'] : '';
	$class = trim( 'shitate-noimage ' . ( isset( $attr['class'] ) ? $attr['class'] : '' ) );

	return '<span class="' . esc_attr( $class ) . '"'
		. ( empty( $attr['style'] ) ? '' : ' style="' . esc_attr( $attr['style'] ) . '"' )
		. ( '' === $label ? ' aria-hidden="true"' : ' role="img" aria-label="' . esc_attr( $label ) . '"' )
		. '></span>';
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
 * Register the panel placeholder's stylesheet (inline, enqueued only when the
 * panel is printed).
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

	// An image control (URL value), not a media control (attachment ID): only
	// a URL-based control shows a default that is not in the media library,
	// so the bundled picture appears in the control and "Default" restores it.
	$wp_customize->add_setting(
		'shitate_noimage_image',
		array(
			'default'           => shitate_noimage_default_url(),
			'transport'         => 'refresh',
			'sanitize_callback' => 'shitate_sanitize_noimage_image',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shitate_noimage_image',
			array(
				'section'         => 'shitate_thumbnails',
				'label'           => __( 'Placeholder image', 'shitate' ),
				'description'     => __( 'By default the No Image picture that comes with the theme is used. Pick another image to replace it, or remove it to show a plain panel in the site colors, which follows the style variation. A landscape image (16:9) suits the cards best.', 'shitate' ),
				'active_callback' => 'shitate_noimage_enabled',
			)
		)
	);
}
add_action( 'customize_register', 'shitate_noimage_customize_register' );
