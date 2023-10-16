<?php
declare( strict_types = 1 );
namespace Atmozorg\UltimateUtm;

/**
 *
 */
class Ninja_Forms extends Form {

	public function init() {
		parent::init();
		add_filter( 'ninja_forms_display_after_fields', [ $this, 'ninja_forms_display_after_fields' ], 10, 2 );

		$fields = Ninja_Forms()->form( 1 )->get_fields();
		var_dump( $fields );
		wp_die();

	// 	add_filter( 'ninja_forms_get_fields', function( $fields, $form_id ) {
	// 		$field = Ninja_Forms()->form( $form_id )->field()->get();
	// 		$field->update_settings( 'type', 'textbox' )->save();
	// 		$fields[] = $field;
	// 		return $fields;
	// 	}, 10000, 2 );
	}

	public function ninja_forms_display_after_fields( $html, $form_id ) {
		$html .= '<input type="hidden" name="utm_source">
		<input type="hidden" name="utm_medium">
		<input type="hidden" name="utm_term">
		<input type="hidden" name="utm_content">
		<input type="hidden" name="utm_campaign">';
		return $html;
	}
}
