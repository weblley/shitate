<?php
/**
 * Title: FAQ with details
 * Slug: shitate/faq
 * Categories: shitate, text, featured
 * Description: A section heading followed by five questions that open and close, separated by thin rules.
 * Keywords: faq, questions, answers, accordion, details
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|25"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"className":"mt-0"} -->
<h2 class="wp-block-heading mt-0"><?php esc_html_e( 'Frequently asked questions', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large"} -->
<p class="has-contrast-2-color has-text-color has-large-font-size"><?php esc_html_e( 'If something is still unclear, send us a message and we will answer it here.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e( 'Do I need a page builder plugin to use this theme?', 'shitate' ); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e( 'No. Everything here is built from the blocks that come with WordPress, and the layouts are edited in the site editor.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:separator {"backgroundColor":"line"} -->
<hr class="wp-block-separator has-text-color has-line-color has-alpha-channel-opacity has-line-background-color has-background"/>
<!-- /wp:separator -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e( 'Can I change the colors and the type size?', 'shitate' ); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e( 'Yes. Colors come from the palette in Styles, and the type scale has its own panel in the customizer, so one change moves every heading and every gap with it.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:separator {"backgroundColor":"line"} -->
<hr class="wp-block-separator has-text-color has-line-color has-alpha-channel-opacity has-line-background-color has-background"/>
<!-- /wp:separator -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e( 'Which style variation should I start from?', 'shitate' ); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e( 'Any of them. Dark, Cream, Mist and Mono each carry their own colors, so you can switch between them at any point without redoing your pages.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:separator {"backgroundColor":"line"} -->
<hr class="wp-block-separator has-text-color has-line-color has-alpha-channel-opacity has-line-background-color has-background"/>
<!-- /wp:separator -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e( 'Is the theme ready for languages other than English?', 'shitate' ); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e( 'It is. The theme ships with translations, and the text in these patterns follows whichever language your site is set to.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:separator {"backgroundColor":"line"} -->
<hr class="wp-block-separator has-text-color has-line-color has-alpha-channel-opacity has-line-background-color has-background"/>
<!-- /wp:separator -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e( 'What happens to my pages if I stop using the theme?', 'shitate' ); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e( 'Your content stays where it is. Because these are standard blocks, the text and images remain readable and editable under any other block theme.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
