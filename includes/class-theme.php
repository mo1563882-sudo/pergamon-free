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
		
		$this->init_features();
	}

	private function init_features(): void {
		$features = array(
			Features\Settings::class,
			Features\Dark_Mode::class,
			Features\H1_Protection::class,
			Features\Schema::class,
			Features\TOC::class,
			Features\Reading_Progress::class,
			Features\Search_Overlay::class,
			Features\Floating_Menu::class, // الميزة الجديدة
		);

		foreach ( $features as $feature_class ) {
			$feature = new $feature_class();
			if ( method_exists( $feature, 'register' ) ) {
				$feature->register();
			}
		}
	}

	public function setup(): void {
		// Intentionally empty in Phase 1.
	}

	public function enqueue_front(): void {
		wp_enqueue_style(
			'pergamon-dark-mode',
			PERGAMON_URI . '/assets/css/dark-mode.css',
			array(),
			PERGAMON_VERSION
		);

		wp_enqueue_style(
			'pergamon-reading-progress',
			PERGAMON_URI . '/assets/css/reading-progress.css',
			array(),
			PERGAMON_VERSION
		);

		wp_enqueue_style(
			'pergamon-search-overlay',
			PERGAMON_URI . '/assets/css/search-overlay.css',
			array(),
			PERGAMON_VERSION
		);

		wp_enqueue_style(
			'pergamon-floating-menu',
			PERGAMON_URI . '/assets/css/floating-menu.css',
			array(),
			PERGAMON_VERSION
		);
	}
}
