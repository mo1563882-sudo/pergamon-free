<?php
/**
 * H1 Protection feature.
 * Converts any <h1> inside the_content to <h2>.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class H1_Protection {

	public function register(): void {
		add_filter( 'the_content', array( $this, 'filter_content' ), 10 );
	}

	public function filter_content( string $content ): string {
		if ( is_admin() ) {
			return $content;
		}

		return preg_replace( '/<h1(\s[^>]*)?>(.*?)<\/h1>/is', '<h2$1>$2</h2>', $content );
	}
}
