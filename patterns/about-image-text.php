<?php
/**
 * Title: About: image and text
 * Slug: shitate/about-image-text
 * Categories: shitate, about, text
 * Description: Two columns with an image on the left and a heading, a short story and a button on the right.
 * Keywords: about, image, text, company, story
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"41.66%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:41.66%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"mt-0"} -->
<figure class="wp-block-image size-large mt-0"><img alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"58.33%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58.33%"><!-- wp:paragraph {"textColor":"primary","className":"mt-0","fontSize":"small"} -->
<p class="mt-0 has-primary-color has-text-color has-small-font-size"><?php esc_html_e( 'About us', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'A small studio that builds websites to last', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'We design and build sites that the people who own them can keep editing. No page builder to learn, no lock-in: everything here is made of the blocks the editor already gives you.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Replace this image and text with your own story, and the layout will follow along on every screen size.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Read more about us', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
