<?php
/**
 * Title: Call to action with two buttons
 * Slug: shitate/cta-two-buttons
 * Categories: shitate, call-to-action
 * Description: A short bold message next to two half-width buttons, stacking on narrow screens.
 * Keywords: cta, call to action, contact, buttons
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"layout":{"type":"grid","minimumColumnWidth":"30rem"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size"><strong><?php esc_html_e( 'Not sure what to build yet? That is fine.', 'shitate' ); ?> <br><?php esc_html_e( 'Just tell us the challenge you are facing today.', 'shitate' ); ?></strong></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"dimensions":{"width":"var:preset|dimension|50"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Contact us', 'shitate' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"dimensions":{"width":"var:preset|dimension|50"}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Call us', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
