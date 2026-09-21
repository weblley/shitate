<?php
/**
 * Title: Two testimonials
 * Slug: shitate/testimonials-2
 * Categories: shitate, testimonials, text
 * Description: Two customer quotes side by side on a soft background, each followed by a name and a job title.
 * Keywords: testimonials, quotes, reviews, customers, voices
 * Block Types: core/group
 * Viewport Width: 1400
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-base-2-background-color has-background" style="margin-top:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","className":"mt-0"} -->
<h2 class="wp-block-heading has-text-align-center mt-0"><?php esc_html_e( 'What our clients say', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"contrast-2"} -->
<p class="has-text-align-center has-contrast-2-color has-text-color"><?php esc_html_e( 'A few words from the people who build their sites with us.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote {"className":"mt-0"} -->
<blockquote class="wp-block-quote mt-0"><!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size"><?php esc_html_e( 'We rebuilt our corporate site in a single week. The type scale keeps every page consistent, so nobody on the team has to argue about font sizes any more.', 'shitate' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'Aoi Tanaka', 'shitate' ); ?><br><?php esc_html_e( 'Marketing Lead, Kitamura Foods', 'shitate' ); ?></cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote {"className":"mt-0"} -->
<blockquote class="wp-block-quote mt-0"><!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size"><?php esc_html_e( 'Editing pages is finally something our staff can do on their own. Spacing and colours come from the theme, so the result never falls apart.', 'shitate' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'Kenji Sato', 'shitate' ); ?><br><?php esc_html_e( 'Representative Director, Sato Design Office', 'shitate' ); ?></cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
