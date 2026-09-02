<?php
/**
 * Title: Hero with heading, text and buttons
 * Slug: st/hero
 * Categories: st, banner, call-to-action
 * Description: A full-width hero section with a large heading, supporting text and two call-to-action buttons.
 * Keywords: hero, header, banner, intro
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"var:preset|spacing|0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:var(--wp--preset--spacing--0);padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":1,"className":"mt-0","fontSize":"display"} -->
<h1 class="wp-block-heading mt-0 has-display-font-size"><?php esc_html_e( 'Tailored with a type scale', 'shitate' ); ?><br><?php esc_html_e( 'a block theme from a web studio', 'shitate' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large"} -->
<p class="has-contrast-2-color has-text-color has-large-font-size"><?php esc_html_e( 'Corporate sites, business sites, anything you build — freely, and with a little joy.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Get started', 'shitate' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'See the demo', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
