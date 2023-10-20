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

	wp_enqueue_script( 'ultimate-utm' );
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
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\plugins_loaded' );

add_action( 'frm_entry_form', function() {
	echo '<input type="hidden" name="utm_source">';
	echo '<input type="hidden" name="utm_medium">';
	echo '<input type="hidden" name="utm_term">';
	echo '<input type="hidden" name="utm_content">';
	echo '<input type="hidden" name="utm_campaign">';
});

add_filter( 'frm_new_post', function( $post, $args ) {
	var_dump( $post );
	var_dump( $args );
	wp_die();
});

add_filter( 'frm_available_fields', __NAMESPACE__ . '\add_basic_field' );
function add_basic_field( $fields ) {
    $fields['new-type'] = array(
        'name' => 'My Field',
        'icon' => 'frm_icon_font frm_pencil_icon', // Set the class for a custom icon here.
    );

    return $fields;
}

add_filter('frm_validate_field_entry', __NAMESPACE__ . '\copy_my_field', 10, 3);
function copy_my_field($errors, $posted_field, $posted_value){
	var_dump( $_POST );
	wp_die();
	if ( $posted_field->id == 25 ) { //change 25 to the ID of the field to change
		$_POST['item_meta'][$posted_field->id] = $_POST['item_meta'][20]; //Change 20 to the ID of the field to copy
	}
	return $errors;
}
