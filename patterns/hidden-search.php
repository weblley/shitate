<?php
/**
 * Title: Search form
 * Slug: shitate/hidden-search
 * Inserter: no
 * Description: The search form on the search results page, with a translatable label and button text.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:search {"label":"<?php echo esc_attr__( 'Search', 'shitate' ); ?>","showLabel":false,"buttonText":"<?php echo esc_attr__( 'Search', 'shitate' ); ?>","buttonPosition":"button-inside","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|40"}}}} /-->
