<?php
/**
 * Reading Progress Bar feature.
 * CSS-only implementation using animation-timeline.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Reading_Progress {

	public function register(): void {
		add_action( 'wp_body_open', array( $this, 'render_bar' ) );
	}

	public function render_bar(): void {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		echo '<div class="pergamon-reading-progress" aria-hidden="true"></div>' . "\n";
	}
}
