<?php
declare( strict_types = 1 );
namespace Atmozorg\UltimateUtm;

/**
 *
 */
class WPForms extends Form {

	public function init() {
		parent::init();
		add_action( 'wpforms_frontend_output', [ $this, 'add_form_hidden_fields' ], PHP_INT_MAX );
		add_filter( 'wpforms_process_before_filter', [ $this, 'wpforms_process_before_filter' ] );
		add_filter( 'wpforms_process_before_form_data', [ $this, 'wpforms_process_before_form_data' ] );
	}

	public function add_form_hidden_fields() {
		echo '<input type="hidden" name="utm_source">';
		echo '<input type="hidden" name="utm_medium">';
		echo '<input type="hidden" name="utm_term">';
		echo '<input type="hidden" name="utm_content">';
		echo '<input type="hidden" name="utm_campaign">';
	}

	public function wpforms_process_before_filter( $entry ) {
		$entry[ 'fields' ][] = sanitize_text_field( $_POST[ 'utm_source' ] ?? '' );
		$entry[ 'fields' ][] = sanitize_text_field( $_POST[ 'utm_medium' ] ?? '' );
		$entry[ 'fields' ][] = sanitize_text_field( $_POST[ 'utm_term' ] ?? '' );
		$entry[ 'fields' ][] = sanitize_text_field( $_POST[ 'utm_content' ] ?? '' );
		$entry[ 'fields' ][] = sanitize_text_field( $_POST[ 'utm_campaign' ] ?? '' );
		return $entry;
	}

	public function wpforms_process_before_form_data( $form_data ) {
		$count = count( $form_data[ 'fields' ] );
		$form_data[ 'fields' ][] = [
			'id' => $count + 1,
			'type' => 'text',
			'label' => 'utm_source',
		];
		$form_data[ 'fields' ][] = [
			'id' => $count + 2,
			'type' => 'text',
			'label' => 'utm_medium',
		];
		$form_data[ 'fields' ][] = [
			'id' => $count + 3,
			'type' => 'text',
			'label' => 'utm_term',
		];
		$form_data[ 'fields' ][] = [
			'id' => $count + 4,
			'type' => 'text',
			'label' => 'utm_content',
		];
		$form_data[ 'fields' ][] = [
			'id' => $count + 5,
			'type' => 'text',
			'label' => 'utm_campaign',
		];
		return $form_data;
	}
}
