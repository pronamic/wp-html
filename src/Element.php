<?php
/**
 * Element
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
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
	 * @var array<string|self>
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
	 * @throws \Exception Throws exception if output buffering is not active.
	 */
	public function render() {
		\ob_start();

		$this->output();

		$output = \ob_get_clean();

		if ( false === $output ) {
			throw new \Exception( 'Output buffering is not active.' );
		}

		return $output;
	}

	/**
	 * Output.
	 *
	 * @return void
	 */
	public function output() {
		echo '<', \tag_escape( $this->tag );

		foreach ( $this->attributes as $name => $value ) {
			/**
			 * Attribute name escape.
			 *
			 * There is currently not a specific escape function for HTML attributes.
			 *
			 * @link https://core.trac.wordpress.org/ticket/43010
			 * @link https://html.spec.whatwg.org/multipage/syntax.html#attributes-2
			 */
			echo ' ', \esc_html( $name ), '="', \esc_attr( (string) $value ), '"';
		}

		if ( $this->is_void_element() ) {
			echo ' />';

			return;
		}

		echo '>';

		foreach ( $this->children as $child ) {
			if ( $child instanceof self ) {
				$child->output();
			}

			if ( \is_string( $child ) ) {
				switch ( $this->tag ) {
					case 'textarea':
						echo \esc_textarea( $child );
						break;
					default:
						echo \esc_html( $child );
						break;
				}
			}
		}

		echo '</', \tag_escape( $this->tag ), '>';
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
