<?php
/**
 * Title: Call to action banner
 * Slug: st/cta
 * Categories: st, call-to-action, banner
 * Description: A full-width call-to-action banner with a heading, supporting text and a button.
 * Keywords: cta, call to action, banner, contact
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"primary","textColor":"base","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-base-color has-primary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"680px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","textColor":"base"} -->
<h2 class="wp-block-heading has-text-align-center has-base-color has-text-color"><?php esc_html_e( 'Ready to get started?', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"line","fontSize":"large"} -->
<p class="has-text-align-center has-line-color has-text-color has-large-font-size"><?php esc_html_e( 'Tell us about your project and we will get back to you within one business day.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"base","textColor":"primary","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-base-background-color has-text-color has-background wp-element-button"><?php esc_html_e( 'Contact us', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
