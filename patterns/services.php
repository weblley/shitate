<?php
/**
 * Title: Services / features grid (3 columns)
 * Slug: st/services
 * Categories: st, columns, services
 * Description: A three-column grid of service or feature cards, each with a heading and description.
 * Keywords: services, features, columns, grid, cards
 * Block Types: core/columns
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"680px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'What we do', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"neutral"} -->
<p class="has-text-align-center has-neutral-color has-text-color"><?php esc_html_e( 'A short summary of the services your company offers. Edit this text to match your business.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"var(--st-radius-m)","width":"1px"}},"borderColor":"line","backgroundColor":"base"} -->
<div class="wp-block-column has-border-color has-line-border-color has-base-background-color has-background" style="border-width:1px;border-radius:var(--st-radius-m);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Consulting', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Describe this service in a sentence or two. Explain the value it brings to your customers.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"var(--st-radius-m)","width":"1px"}},"borderColor":"line","backgroundColor":"base"} -->
<div class="wp-block-column has-border-color has-line-border-color has-base-background-color has-background" style="border-width:1px;border-radius:var(--st-radius-m);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Development', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Describe this service in a sentence or two. Explain the value it brings to your customers.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"var(--st-radius-m)","width":"1px"}},"borderColor":"line","backgroundColor":"base"} -->
<div class="wp-block-column has-border-color has-line-border-color has-base-background-color has-background" style="border-width:1px;border-radius:var(--st-radius-m);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Support', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Describe this service in a sentence or two. Explain the value it brings to your customers.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
