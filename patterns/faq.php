<?php
/**
 * Title: FAQ (accordion)
 * Slug: st/faq
 * Categories: st, text, faq
 * Description: A frequently asked questions section using collapsible details blocks.
 * Keywords: faq, questions, accordion, details, help
 * Block Types: core/details
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Frequently asked questions', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group"><!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"radius":"var(--st-radius-m)","width":"1px"}},"borderColor":"line"} -->
<details class="wp-block-details has-border-color has-line-border-color" style="border-width:1px;border-radius:var(--st-radius-m);padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><summary><?php esc_html_e( 'Is the shitate theme free?', 'shitate' ); ?></summary><!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Yes. The shitate theme is free and open source under the GPL. shitate pro blocks is a paid plugin that extends it.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"radius":"var(--st-radius-m)","width":"1px"}},"borderColor":"line"} -->
<details class="wp-block-details has-border-color has-line-border-color" style="border-width:1px;border-radius:var(--st-radius-m);padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><summary><?php esc_html_e( 'How many sites can I use one license on?', 'shitate' ); ?></summary><!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Personal covers 1 site, Business up to 5 sites and Agency unlimited sites. The one-time Lifetime license covers a single site.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"radius":"var(--st-radius-m)","width":"1px"}},"borderColor":"line"} -->
<details class="wp-block-details has-border-color has-line-border-color" style="border-width:1px;border-radius:var(--st-radius-m);padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><summary><?php esc_html_e( 'What happens when my subscription ends?', 'shitate' ); ?></summary><!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Your site keeps working. You simply stop receiving new updates and support until you renew.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
