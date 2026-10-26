<?php
/**
 * Advertisements feature.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Ads {

	public function register(): void {
		add_action( 'wp_body_open', array( $this, 'render_sticky_top' ), 5 );
		add_filter( 'the_content', array( $this, 'inject_content_ads' ), 15 );
	}

	public function render_sticky_top(): void {
		$options = get_option( 'pergamon_settings', array() );
		$ad      = isset( $options['ad_sticky_top'] ) ? $options['ad_sticky_top'] : '';

		if ( empty( $ad ) ) {
			return;
		}
		?>
		<input type="checkbox" id="pergamon-close-topbar" class="pergamon-ad-checkbox" autocomplete="off">
		<div class="pergamon-sticky-topbar">
			<label for="pergamon-close-topbar" class="pergamon-ad-close" aria-label="Close Ad">✕</label>
			<div class="pergamon-ad-content"><?php echo do_shortcode( $ad ); ?></div>
		</div>
		<?php
	}

	public function inject_content_ads( string $content ): string {
		if ( is_admin() || ! is_singular() || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}

		$options = get_option( 'pergamon_settings', array() );
		$top_ad  = isset( $options['ad_content_top'] ) ? $options['ad_content_top'] : '';
		$para_ad = isset( $options['ad_content_paragraph'] ) ? $options['ad_content_paragraph'] : '';

		// 1. Ad after title (before content)
		if ( ! empty( $top_ad ) ) {
			$content = '<div class="pergamon-ad-container pergamon-ad-top">' . do_shortcode( $top_ad ) . '</div>' . $content;
		}

		// 2. Ad after first paragraph
		if ( ! empty( $para_ad ) ) {
			$paragraphs = explode( '</p>', $content );
			if ( count( $paragraphs ) > 1 ) {
				$ad_html = '<div class="pergamon-ad-container pergamon-ad-paragraph">' . do_shortcode( $para_ad ) . '</div>';
				$paragraphs[1] .= $ad_html . '</p>';
				$content = implode( '</p>', $paragraphs );
			}
		}

		return $content;
	}
}
