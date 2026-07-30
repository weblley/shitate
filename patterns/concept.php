<?php
/**
 * Title: Concept (two columns)
 * Slug: st/concept
 * Categories: st, text, about
 * Description: A two-column concept section with a heading on the left and supporting copy on the right.
 * Keywords: concept, about, intro, mission
 * Block Types: core/columns
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"textColor":"primary","fontSize":"small"} -->
<p class="has-primary-color has-text-color has-small-font-size" style="text-transform:uppercase;letter-spacing:1px"><?php esc_html_e( 'Concept', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-xx-large-font-size"><?php esc_html_e( 'Design that gets out of your way', 'shitate' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"60%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:60%"><!-- wp:paragraph {"fontSize":"large","textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color has-large-font-size"><?php esc_html_e( 'shitate is built on the WordPress Site Editor with a carefully tuned theme.json. Every color, font size and spacing value is a design token, so your site stays consistent as it grows.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'No page builder lock-in, no heavy dependencies. Just clean, fast, standards-based output that you fully own.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
