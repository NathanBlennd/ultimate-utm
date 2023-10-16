<?php
declare( strict_types = 1 );
namespace Atmozorg\UltimateUtm;

/**
 *
 */
class Forminator extends Form {

	public function init() {
		parent::init();
		add_action( 'forminator_render_fields_markup', [ $this, 'forminator_render_fields_markup' ], 10, 2 );
	}

	public function forminator_render_fields_markup( $html, $fields ) {
		$html .= '<input type="hidden" name="utm_source">
		<input type="hidden" name="utm_medium">
		<input type="hidden" name="utm_term">
		<input type="hidden" name="utm_content">
		<input type="hidden" name="utm_campaign">';
		return $html;
	}
}
