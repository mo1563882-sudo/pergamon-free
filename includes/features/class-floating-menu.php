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

		if ( '1' !== $enabled ) {
			return;
		}

		$title    = isset( $options['floating_menu_title'] ) && ! empty( $options['floating_menu_title'] ) ? $options['floating_menu_title'] : 'Quick Links';
		$position = isset( $options['floating_menu_position'] ) ? $options['floating_menu_position'] : 'bottom-right';
		$size     = isset( $options['floating_menu_size'] ) ? absint( $options['floating_menu_size'] ) : 50;
		$color    = isset( $options['floating_menu_color'] ) ? sanitize_hex_color( $options['floating_menu_color'] ) : '#1A2B4C';
		$icon     = isset( $options['floating_menu_icon'] ) ? sanitize_text_field( $options['floating_menu_icon'] ) : '+';
		$items    = isset( $options['floating_menu_items'] ) && is_array( $options['floating_menu_items'] ) ? $options['floating_menu_items'] : array();

		if ( empty( $items ) ) {
			return;
		}

		// CSS Variables for dynamic sizing and coloring
		$style = sprintf(
			'--pergamon-fm-size: %dpx; --pergamon-fm-color: %s;',
			$size,
			esc_attr( $color )
		);

		?>
		<div class="pergamon-floating-menu pergamon-fm-<?php echo esc_attr( $position ); ?>" style="<?php echo esc_attr( $style ); ?>">
			<input type="checkbox" id="pergamon-floating-menu__checkbox" class="pergamon-floating-menu__checkbox">
			<label for="pergamon-floating-menu__checkbox" class="pergamon-floating-menu__toggle" aria-label="Toggle Menu"><?php echo esc_html( $icon ); ?></label>
			<div class="pergamon-floating-menu__links">
				<div class="pergamon-fm-title" style="font-weight:bold; padding:5px 10px; font-size:0.9rem; border-bottom:1px solid var(--wp--preset--color--muted); margin-bottom:5px;">
					<?php echo esc_html( $title ); ?>
				</div>
				<?php foreach ( $items as $item ) : 
					$item_title = isset( $item['title'] ) ? $item['title'] : '';
					$url        = isset( $item['url'] ) ? $item['url'] : '';
					if ( empty( $item_title ) || empty( $url ) ) {
						continue;
					}
				?>
					<a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $item_title ); ?></a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
