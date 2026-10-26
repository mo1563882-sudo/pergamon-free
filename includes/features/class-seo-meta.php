<?php
/**
 * SEO Meta Tags & Canonical feature.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Seo_Meta {

	public function register(): void {
		add_action( 'wp_head', array( $this, 'output_meta' ), 1 );
	}

	public function output_meta(): void {
		// If an SEO plugin is active, do not output to prevent duplication.
		if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) {
			return;
		}

		$options          = get_option( 'pergamon_settings', array() );
		$enable_og        = isset( $options['enable_og_tags'] ) ? $options['enable_og_tags'] : '1';
		$enable_canonical = isset( $options['enable_canonical'] ) ? $options['enable_canonical'] : '1';

		// 1. Canonical Tag
		if ( '1' === $enable_canonical && is_singular() ) {
			echo '<link rel="canonical" href="' . esc_url( wp_get_canonical_url() ) . '" />' . "\n";
		}

		// 2. Open Graph & Twitter Cards
		if ( '1' === $enable_og ) {
			$title = wp_get_document_title();
			$desc  = is_singular() ? wp_strip_all_tags( get_the_excerpt() ) : get_bloginfo( 'description' );
			$url   = is_singular() ? get_permalink() : home_url( '/' );
			$image = is_singular() && has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : '';

			echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
			echo '<meta property="og:description" content="' . esc_attr( $desc ) . '" />' . "\n";
			echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
			echo '<meta property="og:type" content="' . ( is_singular() ? 'article' : 'website' ) . '" />' . "\n";
			if ( $image ) {
				echo '<meta property="og:image" content="' . esc_url( $image ) . '" />' . "\n";
			}

			echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
			echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
			echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '" />' . "\n";
			if ( $image ) {
				echo '<meta name="twitter:image" content="' . esc_url( $image ) . '" />' . "\n";
			}
		}
	}
}
