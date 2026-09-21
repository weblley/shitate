<?php
/**
 * Title: No search results message
 * Slug: shitate/hidden-no-results-search
 * Inserter: no
 * Description: Shown on the search results page when nothing matches.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:paragraph -->
<p><?php esc_html_e( 'No results found. Try another search.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->
