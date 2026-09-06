<?php
/**
 * Title: Footer credit
 * Slug: shitate/footer-credit
 * Inserter: no
 * Description: The site owner's copyright line: the current year and the site title. Edit it freely in the Site Editor.
 */
?>
<!-- wp:paragraph {"style":{"typography":{"textAlign":"left"}},"textColor":"base","fontSize":"small"} -->
<p class="has-text-align-left has-base-color has-text-color has-small-font-size">&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
<!-- /wp:paragraph -->
