<?php
/**
 * Bootstrap tests
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2021 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Money
 */

putenv( 'WP_PHPUNIT__TESTS_CONFIG=tests/wp-config.php' );

require_once __DIR__ . '/../vendor/autoload.php';

if ( is_readable( '.env' ) ) {
	$dotenv = new Dotenv\Dotenv( __DIR__ );
	$dotenv->load();
}

require_once getenv( 'WP_PHPUNIT__DIR' ) . '/includes/functions.php';

// Bootstrap.
require getenv( 'WP_PHPUNIT__DIR' ) . '/includes/bootstrap.php';
