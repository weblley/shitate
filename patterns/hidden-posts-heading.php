<?php
/**
 * Title: Posts page heading
 * Slug: shitate/hidden-posts-heading
 * Inserter: no
 * Description: The heading row of the posts page: the title of the page chosen as "Posts page" in Settings → Reading (or "Blog" when no page is set) on the left and, when that page has an excerpt, the excerpt on the right. Edit it freely in the Site Editor.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shitate_posts_page_id = (int) get_option( 'page_for_posts' );
$shitate_posts_heading = $shitate_posts_page_id ? get_the_title( $shitate_posts_page_id ) : '';
if ( '' === $shitate_posts_heading ) {
	$shitate_posts_heading = __( 'Blog', 'shitate' );
}
$shitate_posts_description = $shitate_posts_page_id ? trim( (string) get_post_field( 'post_excerpt', $shitate_posts_page_id ) ) : '';
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":1,"fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-xx-large-font-size"><?php echo esc_html( $shitate_posts_heading ); ?></h1>
<!-- /wp:heading -->
<?php if ( '' !== $shitate_posts_description ) : ?>

<!-- wp:paragraph {"style":{"layout":{"selfStretch":"fixed","flexSize":"28rem"}},"textColor":"neutral"} -->
<p class="has-neutral-color has-text-color"><?php echo esc_html( $shitate_posts_description ); ?></p>
<!-- /wp:paragraph -->
<?php endif; ?></div>
<!-- /wp:group -->
