<?php
/**
 * Element
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2023 Pronamic
 * @license   GPL-3.0-or-later
 * @package   Pronamic\WordPress\Html
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
	 * Element tag.
	 *
	 * @var string
	 */
	public string $tag;

	/**
	 * Element attributes.
	 *
	 * @var array<string, int|float|string|bool>
	 */
	public array $attributes;

	/**
	 * Children.
	 *
	 * @var array<string>
	 */
	public array $children;

	/**
	 * Construct HTML element.
	 *
	 * @param string                               $tag        Tag name.
	 * @param array<string, int|float|string|bool> $attributes Attributes.
	 */
	public function __construct( $tag, $attributes = [] ) {
		$this->tag        = $tag;
		$this->attributes = $attributes;
		$this->children   = [];
	}

	/**
	 * Is void element.
	 *
	 * @link https://html.spec.whatwg.org/multipage/syntax.html#void-elements
	 * @link http://xahlee.info/js/html5_non-closing_tag.html
	 */
	public function is_void_element(): bool {
		return \in_array(
			$this->tag,
			[
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
			],
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

			$atts = [];

			foreach ( $this->attributes as $name => $value ) {
				$atts[] = '' . $name . '="' . \esc_attr( (string) $value ) . '"';
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
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
