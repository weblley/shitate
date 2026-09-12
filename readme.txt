=== shitate ===
Contributors: weblley
Requires at least: 7.0
Tested up to: 7.1
Requires PHP: 7.2
Stable tag: 0.4.2
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, portfolio, block-patterns, full-site-editing, block-styles, style-variations, wide-blocks, editor-style, custom-colors, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready

shitate is a clean, versatile block theme for corporate and business websites.

== Description ==

shitate is a block theme for the Site Editor with a token-driven design system:

* A modular type scale (typescale.com style) driven by a single base size and ratio.
* A modular spacing ladder built on the same base and ratio, with margin-top rhythm and heading hierarchy.
* Fluid spacing and headings without media queries, so the rhythm tightens itself on small screens.
* A palette-driven color system: change a source color in the Site Editor and the derived tones (hover, tinted surfaces, borders, muted text) follow.
* Spacing utility classes (mt-0 … p-xxxl) plus a Spacing dropdown in the block toolbar.
* Four style variations (Dark, Cream, Mist, Mono).

== Copyright ==

shitate WordPress Theme, (C) 2026 weblley inc.
shitate is distributed under the terms of the GNU GPL v2 or later.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

shitate bundles no third-party resources. All CSS, JavaScript,
patterns and the screenshot are original work by weblley inc and are
released under the same GPL v2 or later license; see Resources below.

== Resources ==

screenshot.png
Copyright (C) 2026 weblley inc. A screenshot of the theme's own front page, rendered with the bundled patterns and no third-party content.
License: GNU General Public License v2 or later, https://www.gnu.org/licenses/gpl-2.0.html
Source: created by weblley inc for this theme.

assets/css/*.css, assets/js/*.js, patterns/*.php, templates, parts, theme.json and style variations
Copyright (C) 2026 weblley inc. Original work created for this theme.
License: GNU General Public License v2 or later, https://www.gnu.org/licenses/gpl-2.0.html

assets/css/reset/reset.css
Copyright (C) 2026 weblley inc. A small base reset written for this theme, informed by widely shared modern reset practices; no third-party code is included.
License: GNU General Public License v2 or later, https://www.gnu.org/licenses/gpl-2.0.html

No fonts are bundled; the typography relies on system font stacks.

== Changelog ==

= 0.4.3 =
* Fixed the mobile menu when the WordPress 7.1 Navigation Overlay template part is used: the overlay no longer inherits the theme's top padding, and its Close block is aligned with the header's menu button.
* Added an opt-in image loading optimization (Customizer > Performance): marks the first large template image as high priority and lazy-loads the images after the first three. Off by default so performance plugins are never interfered with.

= 0.4.2 =
* Added a minimal base reset (assets/css/reset/reset.css): zero-specificity rules for what core does not cover, such as text-size-adjust, scrollbar-gutter, media sizing, form font inheritance, text-wrap, a visible focus ring and reduced-motion support. Disable it with the shitate_use_reset filter.
* Bundled translations for German, French, Spanish, Italian, Dutch and Portuguese (Portugal).
* Font stacks now depend on the site language: system fonts by default, with a Japanese-first stack on Japanese sites. No web fonts are loaded.
* Added a "Fixed sizes for small text" option to the Typography Scale Customizer section. Small, X-Small and XX-Small follow the type scale again by default.

= 0.4.1 =
* Replaced the bundled patterns with four rebuilt ones: hero, three columns with image cards, four columns with images and text, and a call to action with two buttons. The front-page template was removed; the front page is now composed from the page template.
* The mobile menu's close button now sits exactly where the header's hamburger button is, whatever the header height.
* Small, X-Small and XX-Small font sizes are now fixed at 0.95rem, 0.8rem and 0.75rem instead of following the type-scale ratio, which made them too small to read.
* Removed the top margin of the main container in every template.
* Removed the plugin mention from the theme description.

= 0.4.0 =
* Renamed every public identifier to the shitate_ / shitate- / shitate/ prefix (functions, constants, Customizer settings, script and style handles, pattern category and slugs). Existing Customizer values migrate automatically.
* Replaced the fixed footer copyright with an editable site-owner credit (current year and site title).
* Removed promotional content from the default front page and patterns; the pricing pattern is now a generic table.
* Added comments to the page template and made the 404 home link portable.
* Added a Resources section to this readme.
* Raised the minimum WordPress version to 7.0 (the single template uses the core Breadcrumbs block).

= 0.3.0 =
* Rebuilt the spacing scale as a 15-step modular ladder that follows the type-scale ratio and base size.
* Made the larger spacing steps and the headings fluid, so the rhythm tightens on small screens without media queries.
* Added the radius tokens and switched the content widths to rem, so line length follows the browser font size.
* Declared responsive viewports (768px / 1024px) for the editor's responsive styles.
* Fixed the spacing picker showing numbers and core's default steps instead of the theme's named steps.
* Fixed a palette slug clashing with core's border color class, which could override text color on bordered blocks.

= 0.2.0 =
* Added an Appearance > Patterns shortcut to the Site Editor's pattern screen.
* Fixed blurry featured images by defining the post-thumbnail size (regenerate thumbnails on existing sites).

= 0.1.0 =
* Initial release.
