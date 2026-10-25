<?php
/**
 * Pergamon Theme bootstrap.
 *
 * @package Pergamon
 * @since   0.1.0
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PERGAMON_VERSION', '0.1.0' );
define( 'PERGAMON_DIR', get_template_directory() );
define( 'PERGAMON_URI', get_template_directory_uri() );

require_once PERGAMON_DIR . '/includes/class-autoloader.php';

Pergamon\Autoloader::register();

Pergamon\Theme::instance();
