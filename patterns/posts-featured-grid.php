<?php
/**
 * Title: Posts, first post large
 * Slug: shitate/posts-featured-grid
 * Categories: shitate, posts, featured
 * Keywords: posts, news, blog, cards, grid, featured, latest
 * Description: A heading, the latest post as a large card (image beside the text) and the next three as cards in a three-column grid, with a link to the posts page.
 * Viewport Width: 1200
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shitate_posts_page_id = (int) get_option( 'page_for_posts' );
$shitate_all_url       = $shitate_posts_page_id ? get_permalink( $shitate_posts_page_id ) : home_url( '/' );
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size"><?php esc_html_e( 'Latest news', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><a href="<?php echo esc_url( $shitate_all_url ); ?>"><?php esc_html_e( 'View all', 'shitate' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":2,"query":{"perPage":4,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
<div class="wp-block-query" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:post-template {"className":"is-style-cards-featured","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"16rem"}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|25"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"category","className":"is-style-chips","fontSize":"small"} /-->

<!-- wp:post-date {"textColor":"neutral","fontSize":"small"} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"isLink":true,"className":"is-style-two-lines","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}},"typography":{"lineHeight":"1.4"},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"contrast"} /-->

<!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":48,"className":"is-style-two-lines","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}},"textColor":"contrast-2","fontSize":"small"} /-->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color"><?php esc_html_e( 'No posts have been published yet.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
