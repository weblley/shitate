<?php
/**
 * Title: Product introduction (Shitate Pro Blocks)
 * Slug: st/product
 * Categories: st, call-to-action, featured
 * Description: A product introduction section with a heading, feature list and a call-to-action, designed to promote the Shitate Pro Blocks plugin.
 * Keywords: product, plugin, pro, upgrade, feature
 * Block Types: core/columns
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"textColor":"primary","fontSize":"small"} -->
<p class="has-primary-color has-text-color has-small-font-size" style="text-transform:uppercase;letter-spacing:1px"><?php esc_html_e( 'Shitate Pro Blocks', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-xx-large-font-size"><?php esc_html_e( 'Go further with premium blocks', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large","textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color has-large-font-size"><?php esc_html_e( 'The Shitate Pro Blocks plugin adds advanced, business-ready blocks that integrate seamlessly with the theme, all editable right inside the Site Editor.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-none"} -->
<ul class="wp-block-list is-style-none"><!-- wp:list-item -->
<li><?php esc_html_e( 'Pricing tables, testimonial carousels and animated counters', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Mega menu, project slider and contact form', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'A growing library of pro patterns', 'shitate' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'View Pro Blocks', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"12px"}},"backgroundColor":"primary","textColor":"base"} -->
<div class="wp-block-column is-vertically-aligned-center has-base-color has-primary-background-color has-text-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"textAlign":"center","level":3,"textColor":"base","fontSize":"x-large"} -->
<h3 class="wp-block-heading has-text-align-center has-base-color has-text-color has-x-large-font-size"><?php esc_html_e( '12+ premium blocks', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"border"} -->
<p class="has-text-align-center has-border-color has-text-color"><?php esc_html_e( 'Built with the WordPress Interactivity API for fast, accessible interactions.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
