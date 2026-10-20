/**
 * "Type scale" panel in the post/page editor sidebar.
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
			{ name: 'shitate-scale', title: __( 'Type scale', 'shitate' ), className: 'shitate-scale-panel' },
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
		);
	}

	wp.plugins.registerPlugin( 'shitate-scale', { render: ScalePanel } );
} )( window.wp );
