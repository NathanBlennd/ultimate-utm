<?php
/**
 * Plugin Name:       Ultimate UTM
 * Description:       Automatically capture UTM parameters in WordPress forms.
 * Requires at least: 6.3
 * Requires PHP:      8.0
 * Version:           0.1.0
 * Author:            Atmoz
 * Author URI:        https://atmoz.org/
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       ultimate-utm
 */

declare( strict_types = 1 );
namespace Atmozorg\UltimateUtm;

require __DIR__ . '/vendor/autoload.php';

/**
 * Register styles and scripts
 */
function init() {
	wp_register_script( 'ultimate-utm', plugin_dir_url( __FILE__ ) . 'dist/ultimate-utm.js', [], '1.0.0', true );
	wp_register_script( 'ultimate-utm-gravity-forms-admin', plugin_dir_url( __FILE__ ) . 'dist/ultimate-utm-gravity-forms-admin.js', [], '1.0.0', true );

	wp_register_style( 'ultimate-utm-gravity-forms', plugin_dir_url( __FILE__ ) . 'assets/css/ultimate-utm-gravity-forms.css', '1.0.0' );
}
add_action( 'init', __NAMESPACE__ . '\init' );


/**
 * Load the necessary plugin classes
 */
function plugins_loaded() {

	if( class_exists( 'GFForms' ) ) {
		( new Gravity_Forms() )->init();
	}

	if( class_exists( 'WPCF7' ) ) {
		( new Contact_Form_7() )->init();
	}

	if( class_exists( 'WPForms' ) ) {
		( new WPForms() )->init();
	}

	if( class_exists( 'Forminator' ) ) {
		require __DIR__ . '/includes/Forminator.php';
		$forminator = new Forminator();
		$forminator->init();
	}

	if( class_exists( 'Ninja_Forms' ) ) {
		require __DIR__ . '/includes/Ninja_Forms.php';
		$Ninja_Forms = new Ninja_Forms();
		$Ninja_Forms->init();
	}
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\plugins_loaded' );
