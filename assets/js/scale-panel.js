/**
 * "shitate settings" panel in the post/page editor sidebar (the theme's
 * mark in front of the title, like the favicon).
 *
 * Writes three post meta values (_shitate_ratio, _shitate_text_m,
 * _shitate_hide_title) and previews the first two in the canvas by setting
 * --st-ratio / --st-text-m on the editor wrapper, the same variables the
 * theme's inline CSS sets from the Customizer. "Default" removes the
 * override so the post type / site value applies again.
 */
( function ( wp ) {
	if ( ! wp || ! wp.plugins || ! wp.editor || ! wp.editor.PluginDocumentSettingPanel ) {
		return;
	}
	var cfg = window.shitateScalePanel || {};
	var el = wp.element.createElement;
	var useEffect = wp.element.useEffect;
	var __ = wp.i18n.__;
	var sprintf = wp.i18n.sprintf;
	var useSelect = wp.data.useSelect;
	var useDispatch = wp.data.useDispatch;
	var SelectControl = wp.components.SelectControl;
	var ToggleControl = wp.components.ToggleControl;
	var Panel = wp.editor.PluginDocumentSettingPanel;

	// The theme's mark (the favicon), 54×74 units, in the brand colour.
	function Mark() {
		return el(
			'svg',
			{ viewBox: '0 0 54 74', width: 16, height: 22, 'aria-hidden': 'true', focusable: 'false', style: { flex: 'none' } },
			el( 'path', { d: 'M27.16 0L0.0200195 11.86L0 11.87V12.41V27.79L10.44 32.35L0 36.91V36.93V37.44V41.73L26.9 53.47V56.27L0 44.53V47.97L26.9 59.71V62.51L0 50.77V54.21L26.9 65.95V68.75L0 57.01V61.3L26.9 73.04L53.81 61.29V37.69V36.92V36.73L43.6 32.25L53.81 27.8V24.34L39.66 30.52L37.57 31.43L26.91 36.09V33.29L34.38 30.03L36.47 29.12L53.82 21.54V18.1L32.55 27.4L30.46 28.31L26.92 29.86V27.06L27.26 26.91L29.35 26L53.82 15.3V12.7V11.87V11.74L27.16 0ZM26.91 39.54L41.51 33.17L51.93 37.74L26.89 48.67L2.06 37.83L12.52 33.26L26.91 39.54ZM26.91 23.6L2.11002 12.77L27.16 1.82001L51.87 12.7L26.91 23.6Z', fill: '#2952cc' } )
		);
	}

	function canvasRoot() {
		var frame = document.querySelector( 'iframe[name="editor-canvas"]' );
		var doc = frame && frame.contentDocument ? frame.contentDocument : document;
		return doc.querySelector( '.editor-styles-wrapper' ) || doc.documentElement;
	}

	function ScalePanel() {
		var meta = useSelect( function ( select ) {
			return select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {};
		}, [] );
		var editPost = useDispatch( 'core/editor' ).editPost;

		var ratio = meta._shitate_ratio || '';
		var base = meta._shitate_text_m ? String( meta._shitate_text_m ) : '';
		var hide = !! meta._shitate_hide_title;

		useEffect( function () {
			var root = canvasRoot();
			if ( ! root ) {
				return;
			}
			if ( ratio ) {
				root.style.setProperty( '--st-ratio', ratio );
			} else {
				root.style.removeProperty( '--st-ratio' );
			}
			if ( base ) {
				root.style.setProperty( '--st-text-m', base + 'px' );
			} else {
				root.style.removeProperty( '--st-text-m' );
			}
		}, [ ratio, base ] );

		var inherited = cfg.inherited || {};
		var ratioOptions = [ { value: '', label: sprintf( __( 'Default (%s)', 'shitate' ), inherited.ratio || '' ) } ];
		Object.keys( cfg.ratios || {} ).forEach( function ( value ) {
			ratioOptions.push( { value: value, label: cfg.ratios[ value ] } );
		} );
		var baseOptions = [ { value: '', label: sprintf( __( 'Default (%s)', 'shitate' ), inherited.base ? inherited.base + 'px' : '' ) } ];
		for ( var px = cfg.minBase || 12; px <= ( cfg.maxBase || 24 ); px++ ) {
			baseOptions.push( { value: String( px ), label: px + 'px' } );
		}

		return el(
			Panel,
			{
				name: 'shitate-scale',
				title: el( 'span', { style: { display: 'inline-flex', alignItems: 'center', gap: '0.5em' } }, el( Mark ), __( 'shitate settings', 'shitate' ) ),
				className: 'shitate-settings-panel',
			},
			el(
				'div',
				{ style: { display: 'grid', gap: '16px' } },
			el( SelectControl, {
				label: __( 'Scale ratio', 'shitate' ),
				value: ratio,
				options: ratioOptions,
				onChange: function ( value ) {
					editPost( { meta: { _shitate_ratio: value } } );
				},
				__nextHasNoMarginBottom: true,
				__next40pxDefaultSize: true,
			} ),
			el( SelectControl, {
				label: __( 'Base size', 'shitate' ),
				value: base,
				options: baseOptions,
				onChange: function ( value ) {
					editPost( { meta: { _shitate_text_m: value ? parseInt( value, 10 ) : 0 } } );
				},
				__nextHasNoMarginBottom: true,
				__next40pxDefaultSize: true,
			} ),
			el( ToggleControl, {
				label: __( 'Hide the page title', 'shitate' ),
				help: __( 'Removes the Post Title block from the template for this page only, for pages that open with their own hero. The document title and menus are unchanged.', 'shitate' ),
				checked: hide,
				onChange: function ( value ) {
					editPost( { meta: { _shitate_hide_title: !! value } } );
				},
				__nextHasNoMarginBottom: true,
			} )
			)
		);
	}

	wp.plugins.registerPlugin( 'shitate-scale', { render: ScalePanel } );
} )( window.wp );
