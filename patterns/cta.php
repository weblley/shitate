<?php
/**
 * Title: Card gallery with call to action
 * Slug: shitate/cta
 * Categories: shitate, gallery, call-to-action
 * Description: A tinted section with a heading, a lead paragraph, three image cards and a closing button.
 * Keywords: gallery, cards, showcase, demo, call to action
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'See it in action', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}},"textColor":"neutral"} -->
<p class="has-text-align-center has-neutral-color has-text-color"><?php esc_html_e( 'These pages are built with the type scale and the theme styles alone, without a single line of extra CSS. Everything uses standard editor features, so you can rebuild them yourself.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"aspectRatio":"16/10","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"var(--st-radius-m)"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img alt="" style="border-radius:var(--st-radius-m);aspect-ratio:16/10;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Minimal', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size"><?php esc_html_e( 'Decoration kept to a minimum and a gentle jump ratio, in the spirit of a plain writing app.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"aspectRatio":"16/10","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"var(--st-radius-m)"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img alt="" style="border-radius:var(--st-radius-m);aspect-ratio:16/10;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Corporate', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size"><?php esc_html_e( 'A standard company site that balances a sense of trust with easy reading.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"aspectRatio":"16/10","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"var(--st-radius-m)"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img alt="" style="border-radius:var(--st-radius-m);aspect-ratio:16/10;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Rich', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size"><?php esc_html_e( 'A landing-page feel built from large elements, each one given room to breathe.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'View the demos', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->
