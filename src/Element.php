<?php
/**
 * Element
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2022 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Number
 */

namespace Pronamic\WordPress\Html;

/**
 * Element
 *
 * @author Remco Tolsma
 * @version 1.0.0
 * @since 1.0.0
 */
class Element {
	/**
	 * Construct HTML element.
	 *
	 * @param string $tag        Tag name.
	 * @param array  $attributes Attributes.
	 */
	public function __construct( $tag, $attributes = array() ) {
		$this->tag        = $tag;
		$this->attributes = $attributes;
		$this->children   = array();
	}

	/**
	 * Is void element.
	 *
	 * @link https://html.spec.whatwg.org/multipage/syntax.html#void-elements
	 * @link http://xahlee.info/js/html5_non-closing_tag.html
	 */
	public function is_void_element() {
		return \in_array(
			$this->tag,
			array(
				'area',
				'base',
				'br',
				'col',
				'embed',
				'hr',
				'img',
				'input',
				'link',
				'meta',
				'param',
				'source',
				'track',
				'wbr',
			),
			true
		);
	}

	/**
	 * Render.
	 *
	 * @return string
	 */
	public function render() {
		$result = '<' . $this->tag;

		if ( \count( $this->attributes ) > 0 ) {
			$result .= ' ';

			$atts = array();

			foreach ( $this->attributes as $name => $value ) {
				$atts[] = '' . $name . '="' . \esc_attr( $value ) . '"';
			}

			$result .= \implode( ' ', $atts );
		}

		if ( $this->is_void_element() ) {
			$result .= ' />';

			return $result;
		}

		$result .= '>';

		foreach ( $this->children as $child ) {
			$result .= $child;
		}

		$result .= '</' . $this->tag . '>';

		return $result;
	}

	/**
	 * Print output.
	 *
	 * @return int
	 */
	public function output() {
		return print $this->render();
	}

	/**
	 * To string.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->render();
	}
}
