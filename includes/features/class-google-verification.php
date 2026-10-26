<?php
/**
 * Google & Bing Verification feature.
 * Adds fields to settings and outputs meta tags in head.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Google_Verification {

	public function register(): void {
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'wp_head', array( $this, 'output_meta' ) );
	}

	public function register_settings(): void {
		// Register new options independently
		register_setting( 'pergamon_settings_group', 'pergamon_google_verify', 'sanitize_text_field' );
		register_setting( 'pergamon_settings_group', 'pergamon_bing_verify', 'sanitize_text_field' );

		// Add fields to the existing "Schema" section (first tab) to avoid making a new tab
		add_settings_field(
			'pergamon_google_verify',
			'Google Verification',
			array( $this, 'render_input' ),
			'pergamon-settings',
			'pergamon_schema_section',
			array( 'name' => 'pergamon_google_verify' )
		);

		add_settings_field(
			'pergamon_bing_verify',
			'Bing Verification',
			array( $this, 'render_input' ),
			'pergamon-settings',
			'pergamon_schema_section',
			array( 'name' => 'pergamon_bing_verify' )
		);
	}

	public function render_input( array $args ): void {
		$val = get_option( $args['name'], '' );
		echo '<input type="text" name="' . esc_attr( $args['name'] ) . '" value="' . esc_attr( $val ) . '" style="width:100%; max-width:400px;">';
		echo '<p class="description">Enter only the content value (e.g., the code inside content="...").</p>';
	}

	public function output_meta(): void {
		$google = get_option( 'pergamon_google_verify' );
		$bing   = get_option( 'pergamon_bing_verify' );

		if ( ! empty( $google ) ) {
			echo '<meta name="google-site-verification" content="' . esc_attr( $google ) . '" />' . "\n";
		}
		if ( ! empty( $bing ) ) {
			echo '<meta name="msvalidate.01" content="' . esc_attr( $bing ) . '" />' . "\n";
		}
	}
}
