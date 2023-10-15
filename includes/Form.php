<?php
declare( strict_types = 1 );
namespace Atmozorg\UltimateUtm;

/**
 *
 */
abstract class Form {


	/**
	 *
     */
	public function init() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
	}


	/**
	 *
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'ultimate-utm' );
	}


	/**
	 *
	 */
	public function admin_scripts() {
	}

}
