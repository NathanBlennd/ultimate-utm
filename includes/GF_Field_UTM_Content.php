<?php
declare( strict_types = 1 );
namespace blenndiris\ultimate_utm;

class GF_Field_UTM_Content extends \GF_Field_Hidden {
	public $type = 'utm_content';

	public function get_form_editor_field_title() {
		return 'UTM Content';
	}

	public function get_form_editor_field_description() {
		return esc_attr__( 'Tracking utm_content in your form' );
	}

	public function get_form_editor_field_icon() {
		return 'gform-icon--vote';
	}
}