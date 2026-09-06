/**
 * Live preview for the Typography Scale Customizer controls.
 * Updates the root CSS variables so the whole modular scale rescales instantly.
 */
( function () {
	if ( ! window.wp || ! window.wp.customize ) {
		return;
	}

	wp.customize( 'shitate_ratio', function ( setting ) {
		setting.bind( function ( value ) {
			document.documentElement.style.setProperty( '--st-ratio', value );
		} );
	} );

	wp.customize( 'shitate_text_m', function ( setting ) {
		setting.bind( function ( value ) {
			document.documentElement.style.setProperty(
				'--st-text-m',
				parseInt( value, 10 ) + 'px'
			);
		} );
	} );
} )();
