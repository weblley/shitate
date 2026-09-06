<?php
/**
 * Title: Pricing table (3 plans + custom offer)
 * Slug: shitate/pricing
 * Categories: shitate, services
 * Description: A three-column pricing table with a highlighted recommended plan and a closing banner for custom requests.
 * Keywords: pricing, plans, table, comparison
 * Block Types: core/columns
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"680px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Simple, transparent pricing', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"neutral"} -->
<p class="has-text-align-center has-neutral-color has-text-color"><?php esc_html_e( 'Pick the plan that fits today, and change it whenever your needs grow.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"style":{"spacing":{"padding":"var:preset|spacing|40"},"border":{"radius":"var(--st-radius-l)","width":"1px"}},"borderColor":"line","backgroundColor":"base"} -->
<div class="wp-block-column has-border-color has-line-border-color has-base-background-color has-background" style="border-width:1px;border-radius:var(--st-radius-l);padding:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Basic', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"xx-large"} -->
<p class="has-xx-large-font-size">$9<span class="has-small-font-size has-neutral-color has-text-color"><?php esc_html_e( ' / month', 'shitate' ); ?></span></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'For a personal site or a small project.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline","width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Choose Basic', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":"var:preset|spacing|40"},"border":{"radius":"var(--st-radius-l)","width":"2px"}},"borderColor":"primary","backgroundColor":"base"} -->
<div class="wp-block-column has-border-color has-primary-border-color has-base-background-color has-background" style="border-width:2px;border-radius:var(--st-radius-l);padding:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"textColor":"primary","fontSize":"small"} -->
<p class="has-primary-color has-text-color has-small-font-size" style="text-transform:uppercase;letter-spacing:1px"><?php esc_html_e( 'Most popular', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Standard', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"xx-large"} -->
<p class="has-xx-large-font-size">$29<span class="has-small-font-size has-neutral-color has-text-color"><?php esc_html_e( ' / month', 'shitate' ); ?></span></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'For a growing business that needs more room.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Choose Standard', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":"var:preset|spacing|40"},"border":{"radius":"var(--st-radius-l)","width":"1px"}},"borderColor":"line","backgroundColor":"base"} -->
<div class="wp-block-column has-border-color has-line-border-color has-base-background-color has-background" style="border-width:1px;border-radius:var(--st-radius-l);padding:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Premium', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"xx-large"} -->
<p class="has-xx-large-font-size">$69<span class="has-small-font-size has-neutral-color has-text-color"><?php esc_html_e( ' / month', 'shitate' ); ?></span></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'For teams that want everything, with priority help.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline","width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Choose Premium', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|40"}},"border":{"radius":"var(--st-radius-l)"}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide has-base-color has-contrast-background-color has-text-color has-background" style="border-radius:var(--st-radius-l);margin-top:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"textColor":"base","fontSize":"large"} -->
<h3 class="wp-block-heading has-base-color has-text-color has-large-font-size"><?php esc_html_e( 'Need something custom?', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"line"} -->
<p class="has-line-color has-text-color"><?php esc_html_e( 'Tell us about your project and we will put together a plan that fits.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"base","textColor":"contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button"><?php esc_html_e( 'Contact us', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
