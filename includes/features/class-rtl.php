<?php
/**
 * RTL Support & Global Frontend CSS.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class RTL {

	public function register(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global_css' ) );
		add_action( 'wp_head', array( $this, 'inline_critical_css' ), 1 );
	}

	public function enqueue_global_css(): void {
		// تحميل الملفات الأساسية فقط في كل الصفحات
		wp_enqueue_style( 'pergamon-header', PERGAMON_URI . '/assets/css/header.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-layout', PERGAMON_URI . '/assets/css/layout.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-dark-mode', PERGAMON_URI . '/assets/css/dark-mode.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-search-overlay', PERGAMON_URI . '/assets/css/search-overlay.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-floating-menu', PERGAMON_URI . '/assets/css/floating-menu.css', array(), PERGAMON_VERSION );
		wp_enqueue_style( 'pergamon-performance', PERGAMON_URI . '/assets/css/performance.css', array(), PERGAMON_VERSION );

		if ( is_rtl() ) {
			wp_enqueue_style( 'pergamon-rtl', PERGAMON_URI . '/assets/css/rtl.css', array(), PERGAMON_VERSION );
		}
	}

	public function inline_critical_css(): void {
		?>
		<style id="pergamon-critical-css">
			body { margin: 0; padding: 0; }
			img { max-width: 100%; height: auto; }
			.pergamon-content-wrapper { display: grid; gap: 2rem; }
			<?php if ( is_rtl() ) : ?>
			body { direction: rtl; unicode-bidi: embed; }
			<?php endif; ?>
		</style>
		<?php
	}
}
