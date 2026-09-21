<?php
/**
 * Title: No posts message
 * Slug: shitate/hidden-no-results
 * Inserter: no
 * Description: Shown by the posts list and archives when the query returns nothing.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:paragraph -->
<p><?php esc_html_e( 'No posts were found.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->
