<?php
declare( strict_types = 1 );
namespace blenndiris\ultimate_utm;

class GF_Field_UTM_Medium extends \GF_Field_Hidden {
	public $type = 'utm_medium';

	public function get_form_editor_field_title() {
		return 'UTM Medium';
	}

	public function get_form_editor_field_description() {
		return esc_attr__( 'Tracking utm_medium in your form' );
	}

	public function get_form_editor_field_icon() {
		return 'gform-icon--vote';
	}
}