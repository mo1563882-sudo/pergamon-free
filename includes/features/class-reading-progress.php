<?php
declare( strict_types=1 );
namespace Pergamon\Features;
if ( ! defined( 'ABSPATH' ) ) exit;

final class Reading_Progress {
	public function register(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ) );
		add_action( 'wp_body_open', array( $this, 'render_bar' ) );
	}
	public function enqueue_css(): void {
		$o = get_option('pergamon_settings', []);
		if ( ( $o['enable_reading_progress'] ?? '1' ) === '1' && is_singular('post') ) {
			wp_enqueue_style( 'pergamon-reading-progress', PERGAMON_URI . '/assets/css/reading-progress.css', array(), PERGAMON_VERSION );
		}
	}
	public function render_bar(): void {
		$o = get_option('pergamon_settings', []);
		if ( ( $o['enable_reading_progress'] ?? '1' ) === '1' && is_singular('post') ) {
			echo '<div class="pergamon-reading-progress" aria-hidden="true"></div>';
		}
	}
}
