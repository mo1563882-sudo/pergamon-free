<?php
/**
 * Table of Contents (TOC) feature.
 * Generates a TOC using PHP only (zero JS).
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class TOC {

	public function register(): void {
		add_filter( 'the_content', array( $this, 'add_toc' ), 20 );
	}

	public function add_toc( string $content ): string {
		if ( ! is_singular() || is_admin() ) {
			return $content;
		}

		// Only apply if there are at least 2 <h2> tags.
		$h2_count = substr_count( strtolower( $content ), '<h2' );
		if ( $h2_count < 2 ) {
			return $content;
		}

		$toc_items = array();
		$index     = 0;

		// Find H2 tags, add IDs, and collect them for the TOC.
		$content = preg_replace_callback(
			'/<h2(\s[^>]*)?>(.*?)<\/h2>/is',
			function ( $matches ) use ( &$toc_items, &$index ) {
				$index++;
				$id    = 'pergamon-heading-' . $index;
				$text  = wp_strip_all_tags( $matches[2] );
				$attrs = $matches[1] ?? '';

				// Add ID to the H2 tag.
				$attrs = preg_replace( '/id="[^"]*"/i', '', $attrs );
				$new_h2 = '<h2' . $attrs . ' id="' . $id . '">' . $matches[2] . '</h2>';

				$toc_items[] = array(
					'id'   => $id,
					'text' => $text,
				);

				return $new_h2;
			},
			$content
		);

		if ( empty( $toc_items ) ) {
			return $content;
		}

		// Build the TOC HTML.
		$toc_html  = '<div class="pergamon-toc" style="background:var(--wp--preset--color--muted);padding:var(--wp--preset--spacing--30);border-radius:8px;margin-bottom:var(--wp--preset--spacing--40);">';
		$toc_html .= '<h4 style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20);">Table of Contents</h4>';
		$toc_html .= '<ul style="margin:0;padding-left:var(--wp--preset--spacing--20);">';

		foreach ( $toc_items as $item ) {
			$toc_html .= '<li><a href="#' . esc_attr( $item['id'] ) . '">' . esc_html( $item['text'] ) . '</a></li>';
		}

		$toc_html .= '</ul></div>';

		return $toc_html . $content;
	}
}
