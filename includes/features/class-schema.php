<?php
/**
 * Basic Schema (Free version) outputting a unified @graph.
 * Includes Auto mode detection for SEO plugins.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Schema {

	public function register(): void {
		add_action( 'wp_head', array( $this, 'output_schema' ), 99 );
	}

	public function output_schema(): void {
		// Auto Mode: If an SEO plugin is active, output nothing.
		if ( $this->has_seo_plugin() ) {
			return;
		}

		// Only output on single posts and pages.
		if ( ! is_singular() ) {
			return;
		}

		$post_id = get_the_ID();
		if ( ! $post_id ) {
			return;
		}

		$url       = get_permalink( $post_id );
		$title     = get_the_title( $post_id );
		$site_url  = home_url( '/' );
		$site_name = get_bloginfo( 'name' );

		$graph = array(
			'@context' => 'https://schema.org',
			'@graph'   => array(
				// 1. Article Node
				array(
					'@type'            => 'Article',
					'@id'              => $url . '#article',
					'headline'         => $title,
					'datePublished'    => get_the_date( 'c', $post_id ),
					'dateModified'     => get_the_modified_date( 'c', $post_id ),
					'author'           => array(
						'@type' => 'Person',
						'name'  => get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_id ) ),
					),
				),
				// 2. Breadcrumb Node
				array(
					'@type'           => 'BreadcrumbList',
					'@id'             => $url . '#breadcrumb',
					'itemListElement' => array(
						array(
							'@type'    => 'ListItem',
							'position' => 1,
							'name'     => 'Home',
							'item'     => $site_url,
						),
						array(
							'@type'    => 'ListItem',
							'position' => 2,
							'name'     => $title,
						),
					),
				),
				// 3. WebSite Node
				array(
					'@type' => 'WebSite',
					'@id'   => $site_url . '#website',
					'url'   => $site_url,
					'name'  => $site_name,
				),
			),
		);

		echo '<script type="application/ld+json">' . wp_json_encode( $graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	}

	private function has_seo_plugin(): bool {
		return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'AIOSEO_VERSION' );
	}
}
