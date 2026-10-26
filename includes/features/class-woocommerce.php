<?php
/**
 * WooCommerce Base feature (Free).
 * Conditional loading, zero extra JS.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class WooCommerce {

	public function register(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_woo_styles' ) );
		add_action( 'after_setup_theme', array( $this, 'woo_support' ) );
	}

	public function woo_support(): void {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	public function enqueue_woo_styles(): void {
		if ( ! class_exists( 'WooCommerce' ) || ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			return;
		}

		wp_enqueue_style(
			'pergamon-woocommerce',
			PERGAMON_URI . '/assets/css/woocommerce.css',
			array(),
			PERGAMON_VERSION
		);
	}
}
