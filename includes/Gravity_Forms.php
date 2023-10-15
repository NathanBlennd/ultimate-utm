<?php
declare( strict_types = 1 );
namespace Atmozorg\UltimateUtm;

/**
 *
 */
class Gravity_Forms extends Form {


   /**
	*
    */
	public function init() {
		parent::init();

		\GF_Fields::register( new GravityFormFields\GF_Field_UTM_Campaign() );
		\GF_Fields::register( new GravityFormFields\GF_Field_UTM_Content() );
		\GF_Fields::register( new GravityFormFields\GF_Field_UTM_Medium() );
		\GF_Fields::register( new GravityFormFields\GF_Field_UTM_Source() );
		\GF_Fields::register( new GravityFormFields\GF_Field_UTM_Term() );

		add_filter( 'gform_field_content', [ $this, 'gform_field_content' ], 10, 2 );
		add_filter( 'gform_pre_render',[ $this, 'add_utm_fields' ] );
		add_filter( 'gform_pre_validation',[ $this, 'add_utm_fields' ] );
		add_filter( 'gform_pre_submission_filter',[ $this, 'add_utm_fields' ] );
		add_filter( 'gform_admin_pre_render',[ $this, 'add_utm_fields' ] );
	}


	/**
	 *
	 */
	public function enqueue_scripts() {
		parent::enqueue_scripts();
		wp_enqueue_style( 'ultimate-utm-gravity-forms' );
	}


	/**
	 *
	 */
	public function admin_scripts() {
		parent::admin_scripts();
		wp_enqueue_style( 'ultimate-utm-gravity-forms' );
		wp_enqueue_script( 'ultimate-utm-gravity-forms-admin' );
	}


	/**
	 *
	 */
	public function gform_field_content( $field_content, $field ) {
		$data = str_replace( '-', '_', sanitize_title( $field->label ) );
		return str_replace( "class='", "class='gfield--type-utm-$data $data ", $field_content );
	}


	/**
	 *
	 */
	public function add_utm_fields( $form ) {

		$types = $this->get_types();
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


	/**
	 *
	 */
	private function get_types() : array {
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
}
