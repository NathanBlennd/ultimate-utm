<?php
/**
 * Plugin Name:       Ultimate UTM
 * Description:       Automatically capture UTM parameters in WordPress forms.
 * Requires at least: 6.3
 * Requires PHP:      8.0
 * Version:           0.1.0
 * Author:            Atmoz
 * Author URI:        https://atmoz.org/
 * Text Domain:       ultimate-utm
 */

declare( strict_types = 1 );
namespace Atmozorg\UltimateUtm;


/**
 * Register styles and scripts
 */
function init() {
	wp_register_script( 'cookie', plugin_dir_url( __FILE__ ) . '/js/cookie.js' );
	wp_register_script( 'ultimate-utm', plugin_dir_url( __FILE__ ) . 'dist/ultimate-utm.js', [ 'cookie' ], '1.0.0', true );
	wp_register_script( 'ultimate-utm-gravity-forms-admin', plugin_dir_url( __FILE__ ) . 'dist/ultimate-utm-gravity-forms-admin.js', [], '1.0.0', true );

	wp_register_style( 'ultimate-utm-gravity-forms', plugin_dir_url( __FILE__ ) . '/css/ultimate-utm-gravity-forms.css', '1.0.0' );
}
add_action( 'init', __NAMESPACE__ . '\init' );


/**
 * Load the necessary plugin classes
 */
function plugins_loaded() {
	require __DIR__ . '/includes/Form.php';

	if( class_exists( 'GFForms' ) ) {
		require __DIR__ . '/includes/Gravity_Forms.php';
		require __DIR__ . '/includes/GravityFormFields/GF_Field_UTM_Campaign.php';
		require __DIR__ . '/includes/GravityFormFields/GF_Field_UTM_Content.php';
		require __DIR__ . '/includes/GravityFormFields/GF_Field_UTM_Medium.php';
		require __DIR__ . '/includes/GravityFormFields/GF_Field_UTM_Source.php';
		require __DIR__ . '/includes/GravityFormFields/GF_Field_UTM_Term.php';
		$gravity_forms = new Gravity_Forms();
		$gravity_forms->init();
	}

	if( class_exists( 'WPCF7' ) ) {
		require __DIR__ . '/includes/Contact_Form_7.php';
		$contact_form_7 = new Contact_Form_7();
		$contact_form_7->init();
	}

	if( class_exists( 'WPForms' ) ) {
		require __DIR__ . '/includes/WPForms.php';
		$wpforms = new WPForms();
		$wpforms->init();
	}
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\plugins_loaded' );
