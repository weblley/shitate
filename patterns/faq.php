<?php
/**
 * Title: FAQ (collapsible details)
 * Slug: st/faq
 * Categories: st, text, faq
 * Description: A frequently asked questions section built from collapsible details blocks with a bordered card look.
 * Keywords: faq, questions, accordion, details, support
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}},"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Frequently asked questions', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The questions we are asked most often. If yours is not here, ask away on the support forum.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"width":"1px","radius":"var(--st-radius-m)"}},"borderColor":"primary"} -->
<details class="wp-block-details has-border-color has-primary-border-color" style="border-width:1px;border-radius:var(--st-radius-m);padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><summary><?php esc_html_e( 'Do I need to write CSS to change the design?', 'shitate' ); ?></summary><!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'No. Colors, type sizes and spacing are all set from the Site Editor and the Customizer. The type scale drives the whole ladder, so changing one ratio restyles the site consistently.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"width":"1px","radius":"var(--st-radius-m)"}},"borderColor":"primary"} -->
<details class="wp-block-details has-border-color has-primary-border-color" style="border-width:1px;border-radius:var(--st-radius-m);padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><summary><?php esc_html_e( 'Can I change the type scale after the site is live?', 'shitate' ); ?></summary><!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'Yes. Pick another ratio at any time and every heading, body size and spacing step follows it, so the design keeps its proportions.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"width":"1px","radius":"var(--st-radius-m)"}},"borderColor":"primary"} -->
<details class="wp-block-details has-border-color has-primary-border-color" style="border-width:1px;border-radius:var(--st-radius-m);padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><summary><?php esc_html_e( 'Does the theme depend on any plugin?', 'shitate' ); ?></summary><!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'No. shitate uses standard WordPress features only, so your content stays yours if you ever switch themes.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
</section>
<!-- /wp:group -->
