<?php
/**
 * Performance & Image Optimization feature.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Performance {

	public function register(): void {
		add_filter( 'the_content', array( $this, 'optimize_images' ), 20 );
	}

	public function optimize_images( string $content ): string {
		if ( is_admin() || empty( $content ) ) {
			return $content;
		}

		// Find all images
		if ( preg_match_all( '/<img[^>]+>/i', $content, $matches ) ) {
			$first_image = true;
			
			foreach ( $matches[0] as $img_tag ) {
				$new_img = $img_tag;

				if ( $first_image ) {
					// Remove lazy loading and add fetchpriority
					$new_img = preg_replace( '/loading="lazy"/i', '', $new_img );
					if ( strpos( $new_img, 'fetchpriority' ) === false ) {
						$new_img = str_replace( '<img', '<img fetchpriority="high"', $new_img );
					}
					$first_image = false;
				} else {
					// Ensure subsequent images have lazy loading
					if ( strpos( $new_img, 'loading=' ) === false ) {
						$new_img = str_replace( '<img', '<img loading="lazy"', $new_img );
					}
				}
				
				$content = str_replace( $img_tag, $new_img, $content );
			}
		}

		return $content;
	}
}
