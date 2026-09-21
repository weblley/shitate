<?php
/**
 * Title: Pricing: three plans
 * Slug: shitate/pricing-3
 * Categories: shitate, call-to-action, featured
 * Description: Three pricing plans side by side, with the middle plan highlighted on a primary background.
 * Keywords: pricing, plans, columns, table, cta
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|25"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"className":"mt-0"} -->
<h2 class="wp-block-heading mt-0"><?php esc_html_e( 'Simple pricing', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large"} -->
<p class="has-contrast-2-color has-text-color has-large-font-size"><?php esc_html_e( 'Three plans, no hidden extras. Change the numbers to your own.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|25"}},"backgroundColor":"base-2"} -->
<div class="wp-block-column has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"level":3,"className":"mt-0","fontSize":"large"} -->
<h3 class="wp-block-heading mt-0 has-large-font-size"><?php esc_html_e( 'Starter', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"mb-0","fontSize":"xx-large"} -->
<p class="mb-0 has-xx-large-font-size"><?php esc_html_e( '$19', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2","className":"mt-0","fontSize":"small"} -->
<p class="mt-0 has-contrast-2-color has-text-color has-small-font-size"><?php esc_html_e( 'per month, billed yearly', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><?php esc_html_e( 'One website', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'All four style variations', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Email support', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Updates for one year', 'shitate' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"layout":{"type":"flex"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Choose Starter', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|25"}},"backgroundColor":"primary","textColor":"base"} -->
<div class="wp-block-column has-base-color has-primary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"level":3,"textColor":"base","className":"mt-0","fontSize":"large"} -->
<h3 class="wp-block-heading mt-0 has-base-color has-text-color has-large-font-size"><?php esc_html_e( 'Studio', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"mb-0","fontSize":"xx-large"} -->
<p class="mb-0 has-xx-large-font-size"><?php esc_html_e( '$49', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"mt-0","fontSize":"small"} -->
<p class="mt-0 has-small-font-size"><?php esc_html_e( 'per month, billed yearly', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><?php esc_html_e( 'Up to five websites', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'All four style variations', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Priority support', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Updates for three years', 'shitate' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"layout":{"type":"flex"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"base","textColor":"primary"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-base-background-color has-text-color has-background wp-element-button"><?php esc_html_e( 'Choose Studio', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|25"}},"backgroundColor":"base-2"} -->
<div class="wp-block-column has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"level":3,"className":"mt-0","fontSize":"large"} -->
<h3 class="wp-block-heading mt-0 has-large-font-size"><?php esc_html_e( 'Agency', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"mb-0","fontSize":"xx-large"} -->
<p class="mb-0 has-xx-large-font-size"><?php esc_html_e( '$99', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2","className":"mt-0","fontSize":"small"} -->
<p class="mt-0 has-contrast-2-color has-text-color has-small-font-size"><?php esc_html_e( 'per month, billed yearly', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li><?php esc_html_e( 'Unlimited websites', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'All four style variations', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Support within one business day', 'shitate' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Updates for as long as you subscribe', 'shitate' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"layout":{"type":"flex"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Choose Agency', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
