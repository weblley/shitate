<?php
/**
 * Title: News rows
 * Slug: shitate/news-rows
 * Categories: shitate
 * Keywords: news, announcements, list, posts, rows
 * Description: A heading, the latest five posts as rows (date, category chip, title) and a link to the posts page. For announcements, point the query at a category or another post type.
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
<h2 class="wp-block-heading has-x-large-font-size"><?php esc_html_e( 'News', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><a href="<?php echo esc_url( $shitate_all_url ); ?>"><?php esc_html_e( 'View all', 'shitate' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":1,"query":{"perPage":5,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"layout":{"type":"default"}} -->
<div class="wp-block-query" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:post-template {"className":"is-style-rows","layout":{"type":"default"}} -->
<!-- wp:post-date {"textColor":"neutral","fontSize":"small"} /-->

<!-- wp:post-terms {"term":"category","className":"is-style-chips","fontSize":"x-small"} /-->

<!-- wp:post-title {"isLink":true,"className":"is-style-two-lines","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"contrast"} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
