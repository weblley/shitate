<?php
/**
 * Title: Block pattern showcase
 * Slug: st/pattern-showcase
 * Categories: st, gallery, featured
 * Description: A grid that highlights the block patterns included with the theme.
 * Keywords: patterns, showcase, blocks, library, gallery
 * Block Types: core/columns
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"680px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Patterns for every page', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"neutral"} -->
<p class="has-text-align-center has-neutral-color has-text-color"><?php esc_html_e( 'Mix and match ready-made sections to build pages in minutes. Insert them from the block inserter under the shitate category.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40","top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"style":{"spacing":{"padding":"var:preset|spacing|40"},"border":{"radius":"10px","width":"1px"}},"borderColor":"border"} -->
<div class="wp-block-column has-border-color" style="border-width:1px;border-radius:10px;padding:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Hero & banners', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Make a strong first impression with flexible hero and call-to-action sections.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":"var:preset|spacing|40"},"border":{"radius":"10px","width":"1px"}},"borderColor":"border"} -->
<div class="wp-block-column has-border-color" style="border-width:1px;border-radius:10px;padding:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Services & features', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Present what you offer with clean, responsive multi-column layouts.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":"var:preset|spacing|40"},"border":{"radius":"10px","width":"1px"}},"borderColor":"border"} -->
<div class="wp-block-column has-border-color" style="border-width:1px;border-radius:10px;padding:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Pricing & FAQ', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Communicate plans and answer questions with structured, accessible sections.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
