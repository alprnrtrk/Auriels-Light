<?php

/**
 * Resolve a post ID for field lookups.
 *
 * @param int|null $post_id Optional post ID override.
 *
 * @return int|null
 */
function aurielslight_resolve_post_id($post_id = null) {
	if ($post_id !== null) {
		return $post_id;
	}

	$queried = get_queried_object_id();
	if ($queried) {
		return $queried;
	}

	$current = get_the_ID();

	return $current ? $current : null;
}

/**
 * Retrieve an ACF field with a safe fallback.
 *
 * @param string     $name
 * @param mixed      $default
 * @param int|string $post_id
 *
 * @return mixed
 */
function aurielslight_get_field($name, $default = '', $post_id = null) {
	if (!function_exists('get_field')) {
		return $default;
	}

	$resolved_id = aurielslight_resolve_post_id($post_id);
	$value = get_field($name, $resolved_id);

	if (is_array($value)) {
		return !empty($value) ? $value : $default;
	}

	if ($value === null || $value === '' || $value === false) {
		return $default;
	}

	return $value;
}

/**
 * Convenience helper when a pair of label/url fields is used.
 *
 * @param string $label_field
 * @param string $url_field
 * @param array  $default
 * @param int    $post_id
 *
 * @return array{label:string,url:string}
 */
function aurielslight_get_link_fields($label_field, $url_field, array $default = array(), $post_id = null) {
	$defaults = wp_parse_args($default, array('label' => '', 'url' => ''));

	$label = aurielslight_get_field($label_field, $defaults['label'], $post_id);
	$url = aurielslight_get_field($url_field, $defaults['url'], $post_id);

	return array(
		'label' => $label,
		'url'   => $url,
	);
}

/**
 * Retrieve an attachment image ID from an ACF image field.
 *
 * @param string $name
 * @param int    $default
 * @param int    $post_id
 *
 * @return int
 */
function aurielslight_get_image_id($name, $default = 0, $post_id = null) {
	$image = aurielslight_get_field($name, $default, $post_id);

	return is_numeric($image) ? (int) $image : $default;
}
