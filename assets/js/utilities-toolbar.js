/**
 * Adds a "Spacing" dropdown to every block's toolbar that toggles the theme's
 * spacing utility classes (mt-0 … p-xxxl) on the block's className attribute,
 * so quick adjustments don't require typing classes by hand.
 */
( function ( wp ) {
	if ( ! wp || ! wp.hooks || ! wp.blockEditor ) {
		return;
	}

	var addFilter = wp.hooks.addFilter;
	var createHigherOrderComponent = wp.compose.createHigherOrderComponent;
	var el = wp.element.createElement;
	var Fragment = wp.element.Fragment;
	var BlockControls = wp.blockEditor.BlockControls;
	var ToolbarGroup = wp.components.ToolbarGroup;
	var ToolbarButton = wp.components.ToolbarButton;
	var Dropdown = wp.components.Dropdown;
	var SelectControl = wp.components.SelectControl;
	var ToggleControl = wp.components.ToggleControl;
	var Button = wp.components.Button;
	var getBlockSupport = wp.blocks.getBlockSupport;
	var __ = wp.i18n.__;

	var STEPS = [ '0', 'xxs', 'xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl' ];

	var GROUPS = [
		{ prefix: 'mt', label: __( 'Margin top', 'shitate' ) },
		{ prefix: 'mb', label: __( 'Margin bottom', 'shitate' ) },
		{ prefix: 'pt', label: __( 'Padding top', 'shitate' ) },
		{ prefix: 'pb', label: __( 'Padding bottom', 'shitate' ) },
		{ prefix: 'px', label: __( 'Padding left/right', 'shitate' ) },
	];

	var UTIL_RE = /^(m|p)(t|r|b|l|x|y)?-(0|xxs|xs|s|m|l|xl|xxl|xxxl)$/;
	var MX_AUTO = 'mx-auto';

	function isUtility( t ) {
		return UTIL_RE.test( t ) || t === MX_AUTO;
	}

	function tokens( className ) {
		return ( className || '' ).split( /\s+/ ).filter( Boolean );
	}

	function currentValue( className, prefix ) {
		var found = '';
		tokens( className ).forEach( function ( t ) {
			if ( t.indexOf( prefix + '-' ) === 0 && UTIL_RE.test( t ) ) {
				found = t.slice( prefix.length + 1 );
			}
		} );
		return found;
	}

	function setUtility( className, prefix, value ) {
		var rest = tokens( className ).filter( function ( t ) {
			return ! ( t.indexOf( prefix + '-' ) === 0 && UTIL_RE.test( t ) );
		} );
		if ( value ) {
			rest.push( prefix + '-' + value );
		}
		return rest.join( ' ' );
	}

	function clearUtilities( className ) {
		return tokens( className )
			.filter( function ( t ) {
				return ! isUtility( t );
			} )
			.join( ' ' );
	}

	function toggleToken( className, token, on ) {
		var rest = tokens( className ).filter( function ( t ) {
			return t !== token;
		} );
		if ( on ) {
			rest.push( token );
		}
		return rest.join( ' ' );
	}

	var withSpacingToolbar = createHigherOrderComponent( function ( BlockEdit ) {
		return function ( props ) {
			var supportsClass =
				getBlockSupport( props.name, 'customClassName', true ) !== false;

			if ( ! supportsClass || ! props.isSelected ) {
				return el( BlockEdit, props );
			}

			var className = props.attributes.className || '';
			var hasAny = tokens( className ).some( isUtility );
			var hasMxAuto = tokens( className ).indexOf( MX_AUTO ) !== -1;

			var options = [ { label: __( 'Default', 'shitate' ), value: '' } ].concat(
				STEPS.map( function ( s ) {
					return { label: s.toUpperCase(), value: s };
				} )
			);

			var controls = GROUPS.map( function ( group ) {
				return el( SelectControl, {
					key: group.prefix,
					label: group.label + ' (' + group.prefix + ')',
					value: currentValue( className, group.prefix ),
					options: options,
					onChange: function ( value ) {
						props.setAttributes( {
							className:
								setUtility( className, group.prefix, value ) ||
								undefined,
						} );
					},
					__nextHasNoMarginBottom: true,
				} );
			} );

			return el(
				Fragment,
				null,
				el( BlockEdit, props ),
				el(
					BlockControls,
					null,
					el(
						ToolbarGroup,
						null,
						el( Dropdown, {
							popoverProps: { placement: 'bottom-start' },
							renderToggle: function ( args ) {
								return el( ToolbarButton, {
									icon: 'move',
									label: __( 'Spacing', 'shitate' ),
									isPressed: hasAny,
									onClick: args.onToggle,
									'aria-expanded': args.isOpen,
								} );
							},
							renderContent: function () {
								return el(
									'div',
									{
										style: {
											padding: '8px',
											minWidth: '200px',
											display: 'grid',
											gap: '12px',
										},
									},
									controls,
									el( ToggleControl, {
										label: __(
											'Center horizontally (mx-auto)',
											'shitate'
										),
										checked: hasMxAuto,
										onChange: function ( value ) {
											props.setAttributes( {
												className:
													toggleToken(
														className,
														MX_AUTO,
														value
													) || undefined,
											} );
										},
										__nextHasNoMarginBottom: true,
									} ),
									el(
										Button,
										{
											variant: 'link',
											isDestructive: true,
											disabled: ! hasAny,
											onClick: function () {
												props.setAttributes( {
													className:
														clearUtilities( className ) ||
														undefined,
												} );
											},
										},
										__( 'Clear spacing classes', 'shitate' )
									)
								);
							},
						} )
					)
				)
			);
		};
	}, 'withSpacingToolbar' );

	addFilter(
		'editor.BlockEdit',
		'shitate/utilities-toolbar',
		withSpacingToolbar
	);
} )( window.wp );
