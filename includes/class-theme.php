<?php
/**
 * Main theme class. Singleton. Orchestrates all Free features.
 *
 * Phase 1: hooks registered but empty. Phases 3-6 fill them.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Theme {

	private static ?self $instance = null;

	public static function instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->register_hooks();
	}

	private function register_hooks(): void {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front' ) );
	}

	/**
	 * Theme setup. Filled in Phase 3.
	 *
	 * @since 0.1.0
	 */
	public function setup(): void {
		// Intentionally empty in Phase 1.
	}

	/**
	 * Front-end assets. Filled in Phase 3.
	 *
	 * @since 0.1.0
	 */
	public function enqueue_front(): void {
		// Intentionally empty in Phase 1.
	}
}
