<?php
declare( strict_types=1 );
namespace Pergamon;
if ( ! defined( 'ABSPATH' ) ) exit;

final class Theme {
	private static ?self $instance = null;

	public static function instance(): self {
		if ( null === self::$instance ) { self::$instance = new self(); }
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

	/**
	 * تحميل الميزات بترتيب ثابت (sort) لأن ترتيب glob يعتمد على نظام الملفات.
	 */
	private function init_features(): void {
		$feature_files = glob( PERGAMON_DIR . '/includes/features/class-*.php' );
		if ( ! $feature_files ) { return; }
		sort( $feature_files );
		foreach ( $feature_files as $file ) {
			$class_name = 'Pergamon\\Features\\' . str_replace( array( 'class-', '.php', '-' ), array( '', '', '_' ), basename( $file ) );
			if ( class_exists( $class_name ) ) {
				$feature = new $class_name();
				if ( method_exists( $feature, 'register' ) ) { $feature->register(); }
			}
		}
	}

	public function setup(): void {
		load_theme_textdomain( 'pergamon', PERGAMON_DIR . '/languages' );
		/*
		 * قوالب البلوك تحصل تلقائياً من النواة على:
		 * title-tag / post-thumbnails / editor-styles / responsive-embeds.
		 * نضيف صراحة فقط ما ليس تلقائياً:
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
		add_theme_support( 'custom-logo', array( 'height' => 48, 'width' => 160, 'flex-width' => true, 'flex-height' => true ) );
	}

	public function enqueue_front(): void {
		wp_enqueue_style( 'pergamon-header', PERGAMON_URI . '/assets/css/header.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-layout', PERGAMON_URI . '/assets/css/layout.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-performance', PERGAMON_URI . '/assets/css/performance.css', array(), PERGAMON_VERSION );
		/* CSS الوضع الليلي يُحمّل فقط عندما تكون كوكي الزائر dark (توفير ~0.5KB بالزيارات الفاتحة): */
		if ( isset( $_COOKIE['pergamon_theme'] ) && 'dark' === $_COOKIE['pergamon_theme'] ) {
			wp_enqueue_style( 'pergamon-dark-mode', PERGAMON_URI . '/assets/css/dark-mode.css', array(), PERGAMON_VERSION );
		}
		if ( is_rtl() ) {
			wp_enqueue_style( 'pergamon-rtl', PERGAMON_URI . '/assets/css/rtl.css', array(), PERGAMON_VERSION );
		}
	}

	public function enqueue_admin( string $hook ): void {
		if ( 'toplevel_page_pergamon-settings' !== $hook ) { return; }
		wp_enqueue_style( 'pergamon-admin', PERGAMON_URI . '/assets/css/admin.css', array(), PERGAMON_VERSION );
		wp_enqueue_script( 'pergamon-admin', PERGAMON_URI . '/assets/js/admin.js', array(), PERGAMON_VERSION, true );
	}
}
