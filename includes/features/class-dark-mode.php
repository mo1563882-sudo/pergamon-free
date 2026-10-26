<?php
/**
 * Dark Mode feature (PHP + Cookie).
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Dark_Mode {

	public function register(): void {
		add_action( 'init', array( $this, 'handle_toggle' ) );
		add_filter( 'language_attributes', array( $this, 'add_html_class' ) );
		add_action( 'send_headers', array( $this, 'add_vary_header' ) );
		add_shortcode( 'pergamon_dark_mode_toggle', array( $this, 'render_toggle' ) );
	}

	public function handle_toggle(): void {
		if ( is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
			return;
		}

		if ( ! isset( $_GET['pergamon_theme'] ) ) {
			return;
		}

		$nonce = isset( $_GET['pergamon_nonce'] ) ? sanitize_text_field( $_GET['pergamon_nonce'] ) : '';
		if ( ! wp_verify_nonce( $nonce, 'pergamon_theme_toggle' ) ) {
			return;
		}

		$theme  = ( $_GET['pergamon_theme'] === 'dark' ) ? 'dark' : 'light';
		$path   = defined( 'COOKIEPATH' ) && COOKIEPATH ? COOKIEPATH : '/';
		$domain = defined( 'COOKIE_DOMAIN' ) && COOKIE_DOMAIN ? COOKIE_DOMAIN : '';

		if ( headers_sent() ) {
			return;
		}

		setcookie(
			'pergamon_theme',
			$theme,
			array(
				'expires'  => time() + YEAR_IN_SECONDS,
				'path'     => $path,
				'domain'   => $domain,
				'secure'   => is_ssl(),
				'httponly' => true,
				'samesite' => 'Lax',
			)
		);

		header( 'X-Robots-Tag: noindex, nofollow', true );
		wp_safe_redirect( remove_query_arg( 'pergamon_theme' ) );
		exit;
	}

	public function add_html_class( string $output ): string {
		if ( isset( $_COOKIE['pergamon_theme'] ) && $_COOKIE['pergamon_theme'] === 'dark' ) {
			if ( strpos( $output, 'class=' ) === false ) {
				$output .= ' class="pergamon-dark-mode"';
			} else {
				$output = preg_replace( '/class="([^"]*)"/', 'class="$1 pergamon-dark-mode"', $output );
			}
		}
		return $output;
	}

	public function add_vary_header(): void {
		header( 'Vary: Cookie' );
	}

	public function render_toggle(): string {
		$current = isset( $_COOKIE['pergamon_theme'] ) ? $_COOKIE['pergamon_theme'] : 'light';
		$next    = ( $current === 'dark' ) ? 'light' : 'dark';
		$icon    = ( $current === 'dark' ) ? '☀️' : '🌙';
		$label   = ( $current === 'dark' ) ? 'Switch to Light Mode' : 'Switch to Dark Mode';

		ob_start();
		?>
		<form method="get" action="" class="pergamon-theme-switcher" style="display:inline-block;margin:0;">
			<?php wp_nonce_field( 'pergamon_theme_toggle', 'pergamon_nonce' ); ?>
			<input type="hidden" name="pergamon_theme" value="<?php echo esc_attr( $next ); ?>">
			<button type="submit" aria-label="<?php echo esc_attr( $label ); ?>" aria-pressed="<?php echo $current === 'dark' ? 'true' : 'false'; ?>" style="background:none;border:none;cursor:pointer;font-size:1.2rem;padding:0;">
				<?php echo $icon; ?>
			</button>
		</form>
		<?php
		return ob_get_clean();
	}
}
