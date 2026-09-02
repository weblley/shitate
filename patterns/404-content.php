<?php
/**
 * Title: 404 content
 * Slug: st/404-content
 * Inserter: no
 * Description: The body of the 404 page: a large code, a short explanation and a link home.
 */
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"560px"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":1,"style":{"typography":{"textAlign":"center"}},"fontSize":"display"} -->
<h1 class="wp-block-heading has-text-align-center has-display-font-size"><?php esc_html_e( '404 Not Found', 'shitate' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}},"fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"><?php esc_html_e( 'This page could not be found.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The page you are looking for may have been moved or deleted, or it may be temporarily unavailable. Please try again from the home page.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
