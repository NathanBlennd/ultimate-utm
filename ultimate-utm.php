<?php
/**
 * Plugin Name:       Ultimate UTM
 * Description:       Automatically capture UTM parameters in WordPress forms.
 * Requires at least: 6.3
 * Requires PHP:      8.0
 * Version:           0.1.0
 * Author:            Blennd
 * Author URI:        https://blennd.com/
 * Text Domain:       ultimate-utm
 */

declare( strict_types = 1 );
namespace blenndiris\ultimate_utm;

require __DIR__ . '/includes/GF_Field_UTM_Campaign.php';
require __DIR__ . '/includes/GF_Field_UTM_Content.php';
require __DIR__ . '/includes/GF_Field_UTM_Medium.php';
require __DIR__ . '/includes/GF_Field_UTM_Source.php';
require __DIR__ . '/includes/GF_Field_UTM_Term.php';

/**
 * 
 */
function get_types() : array {
    return [
        'utm_campaign' => [
			'id' => 1000,
			'label' => 'UTM Campaign',
		],
        'utm_content' => [
			'id' => 1001,
			'label' => 'UTM Content',
		],
        'utm_medium' => [
			'id' => 1002,
			'label' => 'UTM Medium',
		],
		'utm_medium' => [
			'id' => 1003,
			'label' => 'UTM Medium',
		],
		'utm_source' => [
			'id' => 1004,
			'label' => 'UTM Source',
		],
        'utm_term' => [
			'id' => 1005,
			'label' => 'UTM Term',
		],
	];
}

/**
 * 
 */
function register_gravity_forms_fields() {
	if ( ! class_exists( 'GFForms' ) ) {
		return;
	}
	\GF_Fields::register( new GF_Field_UTM_Campaign() );
	\GF_Fields::register( new GF_Field_UTM_Content() );
	\GF_Fields::register( new GF_Field_UTM_Medium() );
	\GF_Fields::register( new GF_Field_UTM_Source() );
	\GF_Fields::register( new GF_Field_UTM_Term() );
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\register_gravity_forms_fields' );

/**
 * 
 */
function add_utm_fields( $form ) {

	$types = get_types();
	$has_types = [];

	foreach( $form[ 'fields' ] as $field ) {
		if(  in_array( $field->type, array_keys( $types ) ) ) {
			$has_types[] = $field->type;
		}
	}

	$keys = array_keys( $types );
	foreach( array_diff( $keys, $has_types ) as $type ) {
		$utm_source = \GF_Fields::create( [
			'type'   => $type,
			'id'     => $types[ $type ][ 'id' ],
			'formId' => $form[ 'id' ],
			'label'  => $types[ $type ][ 'label' ],
			'allowsPrepopulate' => 1,
		] );
		$form[ 'fields' ][] = $utm_source;
	}
	return $form;
}
add_filter( 'gform_pre_render', __NAMESPACE__ . '\add_utm_fields' );
add_filter( 'gform_pre_validation', __NAMESPACE__ . '\add_utm_fields' );
add_filter( 'gform_pre_submission_filter', __NAMESPACE__ . '\add_utm_fields' );
add_filter( 'gform_admin_pre_render', __NAMESPACE__ . '\add_utm_fields' );

/**
 * 
 */
function wp_enqueue_scripts() {
	wp_register_script( 'cookie', plugin_dir_url( __FILE__ ) . '/js/cookie.js' );
    wp_enqueue_script( 'ultimate-utm', plugin_dir_url( __FILE__ ) . '/js/ultimate-utm.js', [ 'jquery', 'cookie' ], '1.0.0', true );
    wp_enqueue_style( 'ultimate-utm', plugin_dir_url( __FILE__ ) . '/css/ultimate-utm.css', '1.0.0' );
    wp_enqueue_script( 'ultimate-utm-admin', plugin_dir_url( __FILE__ ) . '/js/ultimate-utm-admin.js', [ 'jquery' ], '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\wp_enqueue_scripts' );

/**
 * 
 */
function admin_enqueue_scripts() {
    wp_enqueue_style( 'ultimate-utm', plugin_dir_url( __FILE__ ) . '/css/ultimate-utm.css', '1.0.0' );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\wp_enqueue_scripts' );

/**
 * 
 */
function gform_field_content( $field_content, $field ) {
	$data = str_replace( '-', '_', sanitize_title( $field->label ) );
	return str_replace( "class='", "class='gfield--type-utm-$data $data ", $field_content );
}
add_filter( 'gform_field_content', __NAMESPACE__ . '\gform_field_content', 10, 2 );