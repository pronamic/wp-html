<?php
/**
 * Attribute
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2022 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Number
 */

namespace Pronamic\WordPress\Html;

/**
 * Attribute
 *
 * @author Remco Tolsma
 * @version 1.0.0
 * @since 1.0.0
 */
class Attribute {
	/**
	 * Construct attribute.
	 *
	 * @param string      $name  Name.
	 * @param string|null $value Value.
	 */
	public function __construct( $name, $value = null ) {
		$this->name  = $name;
		$this->value = $value;
	}

	/**
	 * Is boolean attribute.
	 *
	 * @link https://www.w3.org/TR/html51/infrastructure.html#boolean-attribute
	 */
	public function is_boolean_attribute() {
		return \in_array(
			$this->name,
			array(
				'required',
				'disabled',
				'checked',
				'selected',
				'readonly',
				'multiple',
				'novalidate',
				'formnovalidate',
				'autofocus',
			),
			true
		);
	}

	/**
	 * To string.
	 *
	 * @return string
	 */
	public function __toString() {
		if ( $this->is_boolean_attribute() ) {
			return $this->name;
		}

		return $this->name . '="' . \esc_attr( \strval( $this->value ) ) . '"';
	}
}
