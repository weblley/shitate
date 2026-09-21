=== shitate ===
Contributors: weblley
Requires at least: 7.0
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.3
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, portfolio, block-patterns, full-site-editing, block-styles, style-variations, wide-blocks, editor-style, custom-colors, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready

shitate is a clean, versatile block theme for corporate and business websites.

== Description ==

shitate is a WordPress block theme for corporate and business websites, built around a typographic scale. Choose one of 8 standard type scale ratios, and every size on the site, from headings and body text to spacing, follows that single ratio, so pages look consistent without writing additional CSS. The theme fully supports Full Site Editing: the header, footer, and every template can be edited in the Site Editor. Colors work the same way. Set three colors (accent, base, and contrast) and they are applied across the whole site. Style variations and block patterns for common business uses are included. shitate was developed by a web production agency in Japan for sites that are handed over to clients and updated by them afterward. The settings are intentionally few, so builders can put a site together quickly and the people who maintain it are unlikely to break the design. Available in English and Japanese. See the demo sites at https://shitate.weblley.co.jp

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

= 1.0.3 =
* Posts page (index template) now has an H1: the title of the page set as "Posts page", or "Blog" when none is set.
* The remaining hard-coded English in templates ("No posts were found.", "No results found. Try another search.", the search label/button and the "Tags:" prefix) moved into PHP patterns and is translatable; Japanese and six European translations included.
* Internal patterns renamed with a hidden- prefix (footer-credit → hidden-footer-credit, 404-content → hidden-404). Templates saved in the Site Editor that still reference the old slugs need to be reset or updated.
* Header/footer template parts no longer nest a second <header>/<footer> inside the template-part element.
* Layout width tokens follow Global Styles (content/wide size), and the fluid type-scale ratio reaches its full value at the wide layout width instead of a fixed 1260px.
* Base text size is clamped to 12–24px at save time; legacy settings are sanitized on migration; pattern files gained a direct-access guard.
* Description rewritten; no more references to third-party sites in the Customizer text.

= 1.0.2 =
* Requires PHP is now 7.4 (was 7.2), matching WordPress 7.0's own minimum. Verified on PHP 8.5.

= 1.0.1 =
* Style variations now define their own primary and hover colors (Dark, Mono, Cream, Mist). Previously the primary color stayed blue in every variation, so Mono still had blue buttons and links and Dark's button text fell below the recommended contrast. All new pairs meet a 4.5:1 contrast against body and button text.
* The derived-color logic no longer overrides the tones a style variation defines; it recomputes them only after you edit one of the source colors.
* Fixed the fluid type scale in Safari: it stayed at the small-screen ratio at every width because Safari evaluates tan(atan2(100vw, 1px)) as 0. The viewport width is now passed through a registered custom property, so the scale opens up on wide screens in every browser.

= 1.0.0 =
* The scale now rests on a single fluid ratio: it eases to a gentler ratio on phones and opens up to the chosen ratio on wide screens, so type and spacing stay an exact geometric progression at every viewport width. Previously each step interpolated on its own, which broke the progression at intermediate widths.
* Added "Scale ratio on small screens" to the Typography Scale section of the Customizer (defaults to automatic), so the phone end of the scale can be chosen independently of the desktop one.
* The base reset now also evens out the browser defaults: box-sizing, default margins, text-level semantics, monospace fonts, tables and form controls. Lists, heading sizes, link colours and button appearance are still left to WordPress.
* Added the --st-transition token (0.2s) and applied it to links, buttons and other elements with a hover state.
* Added an opt-in image loading optimization (Customizer > Performance): marks the first large template image as high priority and lazy-loads the images after the first three. Off by default, so a performance plugin is never interfered with.
* Fixed the mobile menu when the WordPress 7.1 Navigation Overlay template part is used: the overlay no longer inherits the old overlay's top padding, and its Close block sits where the header's menu button is.
* Fixed an iframe pasted into a Custom HTML block (a map, a video, a form) keeping its fixed width and hugging the left edge.

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
