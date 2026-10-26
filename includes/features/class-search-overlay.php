<?php
/**
 * Search Overlay feature.
 * Outputs the HTML structure for the CSS-only search overlay.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Search_Overlay {

	public function register(): void {
		add_action( 'wp_body_open', array( $this, 'render_overlay' ) );
		add_shortcode( 'pergamon_search_toggle', array( $this, 'render_icon' ) );
	}

	/**
	 * Outputs the hidden overlay and checkbox right after <body>.
	 */
	public function render_overlay(): void {
		?>
		<input type="checkbox" id="pergamon-search-checkbox" class="pergamon-search-checkbox">
		<div class="pergamon-search-overlay">
			<label for="pergamon-search-checkbox" class="pergamon-search-close" aria-label="Close Search">✕</label>
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label for="pergamon-search-input" class="screen-reader-text">Search</label>
				<input type="search" id="pergamon-search-input" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" style="width:100%; padding:15px; font-size:1.5rem; border:2px solid var(--wp--preset--color--primary); border-radius:8px;" />
			</form>
		</div>
		<?php
	}

	/**
	 * Outputs the search icon via shortcode.
	 */
	public function render_icon(): string {
		return '<label for="pergamon-search-checkbox" class="pergamon-search-icon" aria-label="Open Search" style="cursor:pointer;">🔍</label>';
	}
}
