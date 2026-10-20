<?php
/**
 * Title: Category navigation
 * Slug: shitate/hidden-category-nav
 * Inserter: no
 * Description: A row of chips under a list heading: "All" (the posts page) followed by every category that has posts. The current one is filled.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shitate_posts_page_id = (int) get_option( 'page_for_posts' );
$shitate_all_url       = $shitate_posts_page_id ? get_permalink( $shitate_posts_page_id ) : home_url( '/' );
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10","margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"className":"is-style-chips","fontSize":"small"} -->
<p class="is-style-chips has-small-font-size"><a<?php echo is_home() ? ' class="is-current"' : ''; ?> href="<?php echo esc_url( $shitate_all_url ); ?>"><?php esc_html_e( 'All', 'shitate' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:categories {"className":"is-style-chips","fontSize":"small"} /--></div>
<!-- /wp:group -->
