<?php
/**
 * Element test
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2022 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Pay\Payments
 */

namespace Pronamic\WordPress\Html;

/**
 * Element test
 *
 * @author  Remco Tolsma
 * @version 1.0.0
 * @since   1.0.0
 */
class ElementTest extends \WP_UnitTestCase {
	/**
	 * Test element.
	 */
	public function test_element() {
		$element = new Element( 'a' );

		$this->assertEquals( '<a></a>', (string) $element );
	}
}
