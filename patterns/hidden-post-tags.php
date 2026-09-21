<?php
/**
 * Title: Post tags
 * Slug: shitate/hidden-post-tags
 * Inserter: no
 * Description: The tag list under a single post, with a translatable prefix.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:post-terms {"term":"post_tag","prefix":"<?php echo esc_attr__( 'Tags: ', 'shitate' ); ?>","textColor":"neutral","fontSize":"small"} /-->
