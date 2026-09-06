=== shitate ===
Contributors: weblley
Requires at least: 7.0
Tested up to: 7.1
Requires PHP: 7.2
Stable tag: 0.4.0
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

Extend it with the shitate pro blocks plugin for FAQ, modal, conditional display, layout and more.

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

No fonts are bundled; the typography relies on system font stacks.

== Changelog ==

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
