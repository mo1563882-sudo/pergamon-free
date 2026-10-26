<?php
/**
 * Main theme class. Singleton. Orchestrates all Free features.
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
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin' ) );
		
		$this->init_features();
	}

	private function init_features(): void {
		$feature_files = glob( PERGAMON_DIR . '/includes/features/class-*.php' );
		if ( ! $feature_files ) {
			return;
		}

		foreach ( $feature_files as $file ) {
			$class_name = 'Pergamon\\Features\\' . str_replace( array( 'class-', '.php', '-' ), array( '', '', '_' ), basename( $file ) );
			if ( class_exists( $class_name ) ) {
				$feature = new $class_name();
				if ( method_exists( $feature, 'register' ) ) {
					$feature->register();
				}
			}
		}
	}

	public function setup(): void {
		load_theme_textdomain( 'pergamon', PERGAMON_DIR . '/languages' );
	}

	public function enqueue_front(): void {
		wp_enqueue_style( 'pergamon-dark-mode', PERGAMON_URI . '/assets/css/dark-mode.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-reading-progress', PERGAMON_URI . '/assets/css/reading-progress.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-search-overlay', PERGAMON_URI . '/assets/css/search-overlay.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-floating-menu', PERGAMON_URI . '/assets/css/floating-menu.css', array(), PERGAMON_VERSION );
	}

	public function enqueue_admin( string $hook ): void {
		if ( 'toplevel_page_pergamon-settings' !== $hook ) {
			return;
		}
		wp_enqueue_style( 'pergamon-admin', PERGAMON_URI . '/assets/css/admin.css', array(), PERGAMON_VERSION );
		wp_enqueue_script( 'pergamon-admin', PERGAMON_URI . '/assets/js/admin.js', array(), PERGAMON_VERSION, true );
	}
}
