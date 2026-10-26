<?php
/**
 * RTL Support feature.
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
		add_action( 'wp_head', array( $this, 'inline_critical_css' ), 1 );
	}

	public function inline_critical_css(): void {
		// Critical CSS to prevent CLS and ensure base layout works instantly
		?>
		<style id="pergamon-critical-css">
			/* Critical CSS */
			body { margin: 0; padding: 0; }
			img { max-width: 100%; height: auto; }
			.pergamon-content-wrapper { display: grid; gap: 2rem; }
			.pergamon-ad-container { min-height: 50px; }
			<?php if ( is_rtl() ) : ?>
			/* RTL Overrides */
			body { direction: rtl; unicode-bidi: embed; }
			.pergamon-secondary-nav .wp-block-navigation__container { justify-content: flex-start; }
			<?php endif; ?>
		</style>
		<?php
	}
}
