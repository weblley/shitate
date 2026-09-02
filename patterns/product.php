<?php
/**
 * Title: Feature cards (four columns with images)
 * Slug: st/product
 * Categories: st, featured, columns
 * Description: A tinted section with a heading, a lead paragraph and four feature cards, each with an image, a heading and a short description.
 * Keywords: features, cards, columns, grid, product
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'What shitate gives you', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'A simple structure that both builders and their clients can handle, with room to customise where it matters. Because the foundation stays simple, updates stay minimal and the site stays comfortable to run for years.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"200px"}} -->
<div class="wp-block-group">
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"3/4","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img alt="" style="aspect-ratio:3/4;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Eight type scales', 'shitate' ); ?><br><?php esc_html_e( 'to choose from', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Eight scales named after musical intervals, from a minor second up to the golden ratio. Restrained steps or bold jumps: pick the one that matches the character of your site.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"3/4","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img alt="" style="aspect-ratio:3/4;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'A simple structure', 'shitate' ); ?><br><?php esc_html_e( 'made for builders', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Every setting lives in CSS variables. Once you have picked a scale you can still fine-tune or switch it by overriding a variable, instead of working around the theme.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"3/4","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img alt="" style="aspect-ratio:3/4;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Minimal updates,', 'shitate' ); ?><br><?php esc_html_e( 'endless possibilities', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'A design with no surplus features means you are not chasing frequent updates. Build it once, then run it quietly for a long time.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"3/4","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img alt="" style="aspect-ratio:3/4;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'For people with', 'shitate' ); ?><br><?php esc_html_e( 'and without know-how', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'For studios and freelancers at work, and for the client running the site after handover. It is built to sit comfortably in both pairs of hands.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
</div>
<!-- /wp:group --></section>
<!-- /wp:group -->
