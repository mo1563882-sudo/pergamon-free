<?php
/**
 * PSR-4-style autoloader for the Pergamon namespace.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Pergamon;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Autoloader {

	private const PREFIX = 'Pergamon\\';

	public static function register(): void {
		spl_autoload_register( array( __CLASS__, 'load' ) );
	}

	public static function load( string $class ): void {
		$len = strlen( self::PREFIX );

		if ( 0 !== strncmp( self::PREFIX, $class, $len ) ) {
			return;
		}

		$relative   = substr( $class, $len );
		$parts      = explode( '\\', $relative );
		$class_name = array_pop( $parts );

		$file_name = 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';

		$dir = PERGAMON_DIR . '/includes/';
		if ( ! empty( $parts ) ) {
			$dir .= strtolower( implode( '/', $parts ) ) . '/';
		}

		$file = $dir . $file_name;

		if ( is_readable( $file ) ) {
			require_once $file;
		}
	}
}
