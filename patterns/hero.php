<?php
/**
 * Title: Hero with heading, text and buttons
 * Slug: st/hero
 * Categories: st, banner, call-to-action
 * Description: A centered hero section with a heading, supporting text and two call-to-action buttons.
 * Keywords: hero, header, banner, intro
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"textColor":"primary","fontSize":"small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-small-font-size" style="text-transform:uppercase;letter-spacing:1px"><?php esc_html_e( 'Welcome to your business', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"display"} -->
<h1 class="wp-block-heading has-text-align-center has-display-font-size"><?php esc_html_e( 'Build a site that works as hard as you do', 'shitate' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"large","textColor":"contrast-2"} -->
<p class="has-text-align-center has-contrast-2-color has-text-color has-large-font-size"><?php esc_html_e( 'A clean, flexible foundation for corporate websites. Tell your story, showcase your services and convert visitors into customers.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--20)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Get started', 'shitate' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Learn more', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
