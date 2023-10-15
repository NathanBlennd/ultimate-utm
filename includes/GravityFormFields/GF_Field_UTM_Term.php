<?php
declare( strict_types = 1 );
namespace Atmozorg\UltimateUtm\GravityFormFields;

class GF_Field_UTM_Term extends \GF_Field_Hidden {
	public $type = 'utm_term';

	public function get_form_editor_field_title() {
		return 'UTM Term';
	}

	public function get_form_editor_field_description() {
		return esc_attr__( 'Tracking utm_term in your form' );
	}

	public function get_form_editor_field_icon() {
		return 'gform-icon--vote';
	}
}
