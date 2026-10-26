<?php
declare( strict_types=1 );
namespace Pergamon\Features;
if ( ! defined( 'ABSPATH' ) ) exit;

final class Search_Overlay {
	public function register(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ) );
		add_action( 'wp_body_open', array( $this, 'render_overlay' ) );
		add_shortcode( 'pergamon_search_toggle', array( $this, 'render_icon' ) );
	}
	public function enqueue_css(): void {
		$o = get_option('pergamon_settings', []);
		if ( ( $o['enable_search'] ?? '1' ) === '1' ) {
			wp_enqueue_style( 'pergamon-search-overlay', PERGAMON_URI . '/assets/css/search-overlay.css', array(), PERGAMON_VERSION );
		}
	}
	public function render_overlay(): void {
		$o = get_option('pergamon_settings', []);
		if ( ( $o['enable_search'] ?? '1' ) !== '1' ) return;
		?>
		<input type="checkbox" id="pergamon-search-checkbox" class="pergamon-search-checkbox">
		<div class="pergamon-search-overlay">
			<label for="pergamon-search-checkbox" class="pergamon-search-close" aria-label="Close Search">✕</label>
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="search" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" style="width:100%; padding:15px; font-size:1.5rem; border:2px solid var(--wp--preset--color--primary); border-radius:8px;" />
			</form>
		</div>
		<?php
	}
	public function render_icon(): string {
		$o = get_option('pergamon_settings', []);
		if ( ( $o['enable_search'] ?? '1' ) !== '1' ) return '';
		// SVG Icon
		return '<label for="pergamon-search-checkbox" class="pergamon-search-icon" aria-label="Open Search"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></label>';
	}
}
