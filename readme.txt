=== shitate ===
Contributors: weblley
Requires at least: 7.0
Tested up to: 7.1
Requires PHP: 8.3
Stable tag: 1.0.6
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, portfolio, block-patterns, full-site-editing, block-styles, style-variations, wide-blocks, editor-style, custom-colors, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready, full-width-template, template-editing, theme-options, one-column

shitate is a clean, versatile block theme for corporate and business websites.

== Description ==

shitate is a block theme for corporate and business websites that asks you to make one decision instead of a hundred. Pick one of 8 standard type scale ratios in the Customizer and the whole site settles: heading sizes and body text are all derived from that single ratio, while spacing keeps a fixed scale and the space between paragraphs follows the line height, so pages stay consistent without writing a line of CSS. There are no breakpoints to manage and no layout theory to learn first. Colors work the same way: set the four source colors in the Site Editor and the derived tones (hover states, tinted surfaces, borders, muted text) follow on their own. Four style variations and block patterns for common business pages are included, and the header, footer and every template are editable in the Site Editor. shitate was built by a web production agency in Japan for sites that are handed over to clients and updated by them afterward. The settings are deliberately few, so a site can be put together quickly and the people who maintain it are unlikely to break the design. Translations for Japanese, German, French, Spanish, Italian, Dutch and Portuguese are bundled. See the demo sites at https://shitate.weblley.co.jp

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

assets/css/reset.css
Copyright (C) 2026 weblley inc. A small base reset written for this theme, informed by widely shared modern reset practices; no third-party code is included.
License: GNU General Public License v2 or later, https://www.gnu.org/licenses/gpl-2.0.html

No fonts are bundled; the typography relies on system font stacks.

== Changelog ==

= 1.0.7 =
* New pattern "Posts, first post large": a heading with a "View all" link, the latest post as a large card with the text beside its image, and the next three posts as cards in a three-column grid.
* Featured images in the single (other post types) and page templates no longer have rounded corners by default; set a radius on the block in the Site Editor to add one.
* The icons in the "Three features with icons" pattern now save the same markup on WordPress 7.0 and 7.1, so the editor no longer converts them when the pattern is inserted.
* The "shitate settings" panel in the editor now has even spacing between its controls.

= 1.0.6 =
* Requires PHP 8.3 (was 7.4). WordPress will not update or activate the theme on older PHP; please upgrade PHP before updating.
* New screenshot taken from the renewed demo site.

= 1.0.5 =
* Posts get a reading layout (single-post.html, posts only): a 42rem column, breadcrumbs, category, title, author / date / reading time, a 16:9 featured image, tags, an author box and previous / next links.
* One list card for the posts page, archives and search, built from core blocks only: 16:9 image, category chips and date, two-line title, two-line excerpt. Three Post Template styles, "Cards, first post large", "List" and "Rows": the posts page uses the first, archives and search the list.
* Posts page heading with the page's excerpt beside it and a row of category chips ("All" plus every category with posts); the same row on category archives. New "News rows" pattern for announcement sections. Pagination centred, with 2.25rem page-number targets.
* Navigation styles in the manner of Japanese business themes: "Captioned" (a small caption under each item taken from the link's Description, a brand-coloured bar on hover and under the current page, shadowed drop-downs, a mobile overlay with hairline rows) and "Underline" without captions; Navigation Link "Button" and "Outline" for a call-to-action link. The default header uses Captioned.
* More block styles: "Chips" (Post Terms, Categories, Paragraph), "Two lines" (Post Title, Post Excerpt) and "Single line" (Breadcrumbs). Each style's CSS is printed only on pages that use it.
* Content details decided once for every site: heading tracking, thin offset link underlines, quotes, pullquotes, tables (horizontal rules, zebra rows, tabular figures), captions, separators, code blocks and inline code. Two derived colours, --st-color-rule and --st-color-underline, follow the palette.
* Vertical rhythm is now line-based: stacked blocks one line apart, media and headings at fixed multiples of the line, half a line after a heading. The spacing scale is fixed rem steps (4 to 104px) that no longer follow the type-scale ratio or the viewport.
* Editor: a "shitate settings" panel in the post sidebar sets the type-scale ratio and base size for one post or page and can hide the page title on pages that open with their own hero.
* Performance: the front end loads one minified stylesheet (17 KB instead of four files, 34 KB); core's default colour, gradient and shadow presets are no longer printed (global styles 18 KB to 10 KB on a fresh install). The sources ship with the theme and SCRIPT_DEBUG serves them.
* Upgrade notes: single-post.html takes precedence over a Site Editor copy of "single" for posts (other post types keep it); content coloured with core's default presets (has-vivid-red-color and the like) loses that colour, so recolour it with the theme palette; the four stylesheet handles are now aliases of the bundle and add_filter( 'shitate_use_bundle', '__return_false' ) restores them.
* Fixed: an image or table right after a heading now gets half a line as documented; card excerpts no longer carry an extra bottom margin; the hide-title switch leaves titles inside a Query Loop alone; breadcrumb links lose their underline through the Single line style; the "Line" spacing preset sits in size order in the editor.

= 1.0.4 =
* Twelve new patterns built from core blocks only: about (image and text), contact banner, FAQ (details), three features, cover hero, split hero, latest posts, pricing (three plans), services grid, three steps, team (three members) and two testimonials. Sample copy ships in Japanese and six European languages.
* Vertical rhythm now steps with the type-scale ratio: stacked blocks gap × r, media/tables/quotes gap × r², before h3/h4 gap × r³, before h1/h2 gap × r⁴. Navigation and button rows keep the plain blockGap.
* Editor: the Typography panel on paragraphs, headings, post titles, lists, quotes and buttons shows Font and Appearance (weight/style) by default.
* Customizer: "Japanese typography" switch (off by default) applies strict line breaking, auto spacing between Japanese and Latin text and proportional kana/kanji widths (palt) when the site language is Japanese.
* Fixed: no space between the title and the first paragraph in the post editor when the template is hidden.
* Added four more theme tags: full-width-template, template-editing, theme-options and one-column.
* Expanded the theme description to say what the eight ready-made scales do and what the theme gives you without any prior knowledge of typographic scales. Corrected two details: the palette is derived from four source colours (base, contrast, primary, accent), and the bundled translations are Japanese plus six European languages.
* Fixed a wrong path in the Resources section of this readme (assets/css/reset.css).

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
