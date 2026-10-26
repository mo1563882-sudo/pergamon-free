<?php
/**
 * Navigation feature.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Navigation {

	public function register(): void {
		add_action( 'after_setup_theme', array( $this, 'register_menus' ) );
		add_filter( 'body_class', array( $this, 'add_sticky_class' ) );
	}

	public function register_menus(): void {
		register_nav_menus( array(
			'primary'   => __( 'Primary Menu', 'pergamon' ),
			'secondary' => __( 'Secondary Menu', 'pergamon' ),
			'mobile'    => __( 'Mobile Menu', 'pergamon' ),
			'footer'    => __( 'Footer Menu', 'pergamon' ),
			'offcanvas' => __( 'Off-Canvas Menu (Pro)', 'pergamon' ),
		) );
	}

	public function add_sticky_class( array $classes ): array {
		$options = get_option( 'pergamon_settings', array() );
		$sticky  = isset( $options['enable_sticky_header'] ) ? $options['enable_sticky_header'] : '0';

		if ( '1' === $sticky ) {
			$classes[] = 'pergamon-sticky-header';
		}

		return $classes;
	}
}
