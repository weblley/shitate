<?php
/**
 * Title: Posts page heading
 * Slug: shitate/hidden-posts-heading
 * Inserter: no
 * Description: The H1 of the posts page: the title of the page chosen as "Posts page" in Settings → Reading, or "Blog" when no page is set. Edit it freely in the Site Editor.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shitate_posts_page_id = (int) get_option( 'page_for_posts' );
$shitate_posts_heading = $shitate_posts_page_id ? get_the_title( $shitate_posts_page_id ) : '';
if ( '' === $shitate_posts_heading ) {
	$shitate_posts_heading = __( 'Blog', 'shitate' );
}
?>
<!-- wp:heading {"level":1,"fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-xx-large-font-size"><?php echo esc_html( $shitate_posts_heading ); ?></h1>
<!-- /wp:heading -->
