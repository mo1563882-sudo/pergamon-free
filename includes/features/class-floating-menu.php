<?php
/**
 * Floating Menu feature.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Floating_Menu {

	public function register(): void {
		add_action( 'wp_footer', array( $this, 'render_menu' ) );
	}

	public function render_menu(): void {
		if ( is_admin() ) {
			return;
		}

		$options = get_option( 'pergamon_settings', array() );
		$enabled = isset( $options['enable_floating_menu'] ) ? $options['enable_floating_menu'] : '0';

		// Zero KB if disabled.
		if ( '1' !== $enabled ) {
			return;
		}

		?>
		<div class="pergamon-floating-menu">
			<input type="checkbox" id="pergamon-floating-menu__checkbox" class="pergamon-floating-menu__checkbox">
			<label for="pergamon-floating-menu__checkbox" class="pergamon-floating-menu__toggle" aria-label="Toggle Menu">+</label>
			<div class="pergamon-floating-menu__links">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<a href="#" class="pergamon-back-to-top">Back to Top</a>
			</div>
		</div>
		<?php
	}
}
