<?php
/**
 * Breadcrumbs feature.
 * PHP-only breadcrumb trail output.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Breadcrumbs {

	public function register(): void {
		add_shortcode( 'pergamon_breadcrumbs', array( $this, 'render_breadcrumbs' ) );
	}

	public function render_breadcrumbs(): string {
		if ( is_front_page() ) {
			return '';
		}

		$html = '<nav class="pergamon-breadcrumbs" aria-label="Breadcrumb" style="font-size: 0.85rem; margin-bottom: 1rem; opacity: 0.8;">';
		$html .= '<a href="' . esc_url( home_url( '/' ) ) . '" style="text-decoration:none; color:inherit;">Home</a> <span class="sep" style="margin:0 5px;">»</span> ';

		if ( is_singular( 'post' ) ) {
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$category = $categories[0];
				$html .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" style="text-decoration:none; color:inherit;">' . esc_html( $category->name ) . '</a> <span class="sep" style="margin:0 5px;">»</span> ';
			}
			$html .= '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';
		} elseif ( is_page() ) {
			$html .= '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';
		} elseif ( is_category() || is_tag() || is_tax() ) {
			$html .= '<span aria-current="page">' . esc_html( single_term_title( '', false ) ) . '</span>';
		} elseif ( is_search() ) {
			$html .= '<span aria-current="page">Search results for: ' . esc_html( get_search_query() ) . '</span>';
		} else {
			$html .= '<span aria-current="page">' . esc_html( wp_get_document_title() ) . '</span>';
		}

		$html .= '</nav>';
		return $html;
	}
}
