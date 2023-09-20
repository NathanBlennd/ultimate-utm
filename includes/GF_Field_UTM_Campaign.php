<?php
declare( strict_types = 1 );
namespace blenndiris\ultimate_utm;

class GF_Field_UTM_Campaign extends \GF_Field_Hidden {
	public $type = 'utm_campaign';

	public function get_form_editor_field_title() {
		return 'UTM Campaign';
	}

	public function get_form_editor_field_description() {
		return esc_attr__( 'Tracking utm_campaign in your form' );
	}

	public function get_form_editor_field_icon() {
		return 'gform-icon--vote';
	}
}