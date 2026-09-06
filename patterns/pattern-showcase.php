<?php
/**
 * Title: Icon grid in three groups
 * Slug: shitate/pattern-showcase
 * Categories: shitate, gallery, featured
 * Description: A centered heading followed by three labelled groups, each showing a responsive grid of icons with captions.
 * Keywords: icons, grid, services, showcase, gallery
 * Block Types: core/group
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Everything we do, at a glance', 'shitate' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}},"textColor":"neutral"} -->
<p class="has-text-align-center has-neutral-color has-text-color"><?php esc_html_e( 'Group what you offer and let a plain icon grid carry the overview.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Design', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The work that decides how a site looks and reads before a single line is built.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"layout":{"type":"grid","columnCount":6,"minimumColumnWidth":"140px"}} -->
<div class="wp-block-group">
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Branding', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Web design', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'UI design', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Illustration', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Photography', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Copywriting', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Build', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Turning the design into something maintainable, fast and standards-based.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"layout":{"type":"grid","columnCount":6,"minimumColumnWidth":"140px"}} -->
<div class="wp-block-group">
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Development', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'CMS setup', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'E-commerce', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Integrations', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Accessibility', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Name things after what they are, not after how they happen to look today. Labels that describe the role survive a redesign; labels that describe the decoration do not.', 'shitate' ); ?></p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Support', 'shitate' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'What keeps a site healthy after launch, in your hands or in theirs.', 'shitate' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"layout":{"type":"grid","columnCount":6,"minimumColumnWidth":"140px"}} -->
<div class="wp-block-group">
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Maintenance', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-full is-resized"><img alt="" style="width:100px;height:auto"/><figcaption class="wp-element-caption"><?php esc_html_e( 'Training', 'shitate' ); ?></figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'See all services', 'shitate' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->
