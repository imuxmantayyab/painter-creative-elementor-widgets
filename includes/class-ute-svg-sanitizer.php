<?php
/**
 * Safe SVG Sanitizer for Painter Creative Elementor Widgets
 *
 * @package UsmanCreativeElementorWidgets
 * @author  Usman Tayyab (https://www.linkedin.com/in/imuxmantayyab/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UTE_SVG_Sanitizer {

	/**
	 * Disallowed tags
	 *
	 * @var array
	 */
	protected static $disallowed_tags = array(
		'script',
		'style',
		'iframe',
		'embed',
		'object',
		'applet',
		'foreignobject',
		'audio',
		'video',
		'canvas',
		'form',
		'input',
		'button',
		'select',
		'meta',
		'link',
	);

	/**
	 * Sanitize SVG string
	 *
	 * @param string $svg_content Raw SVG code.
	 * @return string Sanitized SVG code or empty string.
	 */
	public static function sanitize( $svg_content ) {
		if ( empty( $svg_content ) || ! is_string( $svg_content ) ) {
			return '';
		}

		// Remove XML declaration and comments that might conceal entities.
		$svg_content = preg_replace( '/<\?xml.*?\?>/i', '', $svg_content );
		$svg_content = preg_replace( '/<!--.*?-->/s', '', $svg_content );

		// Reject DOCTYPE / ENTITY injection (XXE attacks).
		if ( preg_match( '/<!ENTITY|<!DOCTYPE|SYSTEM|PUBLIC/i', $svg_content ) ) {
			return '';
		}

		// Strip disallowed tags.
		foreach ( self::$disallowed_tags as $tag ) {
			$svg_content = preg_replace( '#<' . $tag . '\b[^>]*>(.*?)</' . $tag . '>#is', '', $svg_content );
			$svg_content = preg_replace( '#<' . $tag . '\b[^>]*/>#is', '', $svg_content );
		}

		// Remove all on* event handler attributes.
		$svg_content = preg_replace( '/\s*on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $svg_content );

		// Remove javascript: and base64 script URIs in href/xlink:href.
		$svg_content = preg_replace( '/(href|xlink:href)\s*=\s*["\']\s*javascript:[^"\']*["\']/i', '', $svg_content );
		$svg_content = preg_replace( '/(href|xlink:href)\s*=\s*["\']\s*data:text\/html[^"\']*["\']/i', '', $svg_content );

		// Ensure svg tag is present.
		if ( ! preg_match( '/<svg\b[^>]*>/i', $svg_content ) ) {
			return '';
		}

		return trim( $svg_content );
	}
}
