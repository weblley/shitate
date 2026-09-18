<?php
/**
 * Title: Hero: cover with overlay
 * Slug: shitate/hero-cover
 * Categories: shitate, banner, call-to-action
 * Description: A full-width cover hero with a dark overlay, a centred heading, supporting text and two buttons. Add a background image and the overlay keeps the text readable.
 * Keywords: hero, cover, banner, intro, image, overlay
 * Block Types: core/cover
 * Viewport Width: 1400
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:cover {"overlayColor":"contrast","isUserOverlayColor":true,"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|30","margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-cover alignfull" style="margin-top:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","textColor":"base","className":"mt-0","fontSize":"small"} -->
<p class="has-text-align-center mt-0 has-base-color has-text-color has-small-font-size"><?php esc_html_e( 'Free, and built to stay that way', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"textColor":"base","fontSize":"display"} -->
<h1 class="wp-block-heading has-text-align-center has-base-color has-text-color has-display-font-size"><?php esc_html_e( 'Build the site you had in mind', 'shitate' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"large"} -->
<p class="has-text-align-center has-base-color has-text-color has-large-font-size"><?php esc_html_e( 'Core blocks only, a type scale you can tune in one place, and nothing to unlearn later.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"base","textColor":"contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button"><?php esc_html_e( 'Start building', 'shitate' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"base","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-base-color has-text-color wp-element-button"><?php esc_html_e( 'Read the guide', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></section>
<!-- /wp:cover -->
