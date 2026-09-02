<?php
/**
 * Title: Concept (heading and lead paragraph)
 * Slug: st/concept
 * Categories: st, text, about
 * Description: A full-width concept section with a heading and one longer paragraph of supporting copy.
 * Keywords: concept, about, intro, text
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
<h2 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--20)"><?php esc_html_e( 'We tailor it. You decide how to wear it.', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"large"} -->
<p class="has-contrast-2-color has-text-color has-large-font-size"><?php esc_html_e( 'Most themes settle font sizes and spacing for you in fine detail, so matching your own taste means piling up CSS overrides. shitate works the other way around: pick the type scale closest to the site you have in mind, and the type, the spacing and the rest of the groundwork fall into place together. That leaves you free to concentrate on the content and the design itself.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
