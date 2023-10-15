<?php
declare( strict_types = 1 );
namespace Atmozorg\UltimateUtm;

/**
 *
 */
class Contact_Form_7 extends Form {

	public function init() {
		parent::init();
		add_filter( 'wpcf7_form_hidden_fields', [ $this, 'add_form_hidden_fields' ] );
	}

	public function add_form_hidden_fields( $hidden ) {
		$form = wpcf7_get_current_contact_form();
		$post = get_post($form->id());
		$hidden[ 'utm_source'] = '';
		$hidden[ 'utm_medium'] = '';
		$hidden[ 'utm_term'] = '';
		$hidden[ 'utm_content'] = '';
		$hidden[ 'utm_campaign'] = '';
		return $hidden;
	}
}
