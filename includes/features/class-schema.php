<?php
/**
 * Basic Schema (Free version) outputting a unified @graph.
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
		add_action( 'save_post', array( $this, 'save_schema_meta' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
	}

	public function output_schema(): void {
		$options = get_option( 'pergamon_settings', array() );
		$mode    = isset( $options['schema_mode'] ) ? $options['schema_mode'] : 'auto';

		if ( 'off' === $mode ) {
			return;
		}

		if ( 'auto' === $mode && $this->has_seo_plugin() ) {
			return;
		}

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
				array(
					'@type'         => 'Article',
					'@id'           => $url . '#article',
					'headline'      => $title,
					'datePublished' => get_the_date( 'c', $post_id ),
					'dateModified'  => get_the_modified_date( 'c', $post_id ),
					'author'        => array(
						'@type' => 'Person',
						'name'  => get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_id ) ),
					),
				),
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

	public function save_schema_meta( int $post_id ): void {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		// Save a basic timestamp or identifier to post_meta as requested in specs
		update_post_meta( $post_id, '_pergamon_schema_generated', current_time( 'mysql' ) );
	}

	public function admin_notice(): void {
		$options = get_option( 'pergamon_settings', array() );
		$mode    = isset( $options['schema_mode'] ) ? $options['schema_mode'] : 'auto';

		if ( 'auto' === $mode && $this->has_seo_plugin() && ! get_user_meta( get_current_user_id(), 'pergamon_dismissed_schema_notice', true ) ) {
			echo '<div class="notice notice-warning is-dismissible"><p><strong>Pergamon:</strong> An SEO plugin was detected. Theme schema is disabled in Auto mode to prevent duplication. <a href="' . esc_url( admin_url( 'admin.php?page=pergamon-settings' ) ) . '">Manage Settings</a></p></div>';
		}
	}

	private function has_seo_plugin(): bool {
		return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'AIOSEO_VERSION' );
	}
}
