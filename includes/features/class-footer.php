<?php
/**
 * Footer Copyright feature.
 *
 * @package Pergamon
 * @since   0.1.0
 */
declare( strict_types=1 );
namespace Pergamon\Features;
if ( ! defined( 'ABSPATH' ) ) exit;

final class Footer {
	public function register(): void {
		add_shortcode( 'pergamon_footer_copy', array( $this, 'render_footer' ) );
	}

	public function render_footer(): string {
		$options = get_option( 'pergamon_settings', array() );
		
		// Free users always see "Powered by Pergamon". Pro users can turn it off.
		// This is the Upsell logic.
		$site_name = get_bloginfo( 'name' );
		$year      = date( 'Y' );
		
		$html  = '<div class="pergamon-footer-copy" style="font-size: 0.85rem; text-align: center; color: var(--wp--preset--color--contrast);">';
		$html .= '&copy; ' . esc_html( $year ) . ' ' . esc_html( $site_name ) . '. ';
		$html .= '<a href="https://getly.store" target="_blank" rel="nofollow" style="text-decoration:none; color:inherit; opacity:0.7;">Powered by Pergamon</a>';
		$html .= '</div>';

		return $html;
	}
}
