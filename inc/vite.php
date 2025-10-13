<?php

/**
 * Minimal Vite integration for the theme.
 *
 * Keeps the dev server workflow while staying out of the way until we add code.
 */

defined('AURIELSLIGHT_DIST_DIR') || define('AURIELSLIGHT_DIST_DIR', 'assets/dist');
defined('AURIELSLIGHT_VITE_SERVER') || define('AURIELSLIGHT_VITE_SERVER', 'http://localhost:5173');

/**
 * Returns the decoded Vite manifest when it exists.
 *
 * @return array|false
 */
function aurielslight_get_vite_manifest() {
	static $manifest = null;

	if ($manifest !== null) {
		return $manifest;
	}

	$manifest_path = get_template_directory() . '/' . AURIELSLIGHT_DIST_DIR . '/.vite/manifest.json';

	if (!file_exists($manifest_path)) {
		$manifest = false;

		return $manifest;
	}

	$manifest = json_decode(file_get_contents($manifest_path), true);

	return $manifest;
}

/**
 * Whether the theme is using the Vite production build.
 *
 * @return bool
 */
function aurielslight_vite_is_build() {
	return is_array(aurielslight_get_vite_manifest());
}

/**
 * Enqueue the main Vite assets.
 */
function aurielslight_enqueue_vite_assets() {
	$manifest = aurielslight_get_vite_manifest();
	$theme_uri = get_template_directory_uri();

	$script_handle = 'aurielslight-app';
	$style_handle = 'aurielslight-style';

	$style_src = null;

	if ($manifest && isset($manifest['assets/src/js/main.js'])) {
		$entry = $manifest['assets/src/js/main.js'];
		$script_src = $theme_uri . '/' . AURIELSLIGHT_DIST_DIR . '/' . $entry['file'];

		if (!empty($entry['css'][0])) {
			$style_src = $theme_uri . '/' . AURIELSLIGHT_DIST_DIR . '/' . $entry['css'][0];
		} elseif (isset($manifest['assets/src/scss/main.scss'])) {
			$style_entry = $manifest['assets/src/scss/main.scss'];
			$style_src = $theme_uri . '/' . AURIELSLIGHT_DIST_DIR . '/' . $style_entry['file'];
		}
	} else {
		$script_src = AURIELSLIGHT_VITE_SERVER . '/assets/src/js/main.js';
		$style_src = AURIELSLIGHT_VITE_SERVER . '/assets/src/scss/main.scss';
	}

	if ($style_src) {
		wp_enqueue_style($style_handle, $style_src, array(), null);
	}

	wp_enqueue_script($script_handle, $script_src, array(), null, true);
}

add_action('wp_enqueue_scripts', 'aurielslight_enqueue_vite_assets', 20);

/**
 * Inject the Vite client in development so HMR works with PHP templates.
 */
function aurielslight_vite_client() {
	if (aurielslight_vite_is_build()) {
		return;
	}

	echo '<script type="module" src="' . esc_url(AURIELSLIGHT_VITE_SERVER . '/@vite/client') . '" crossorigin></script>';
}

add_action('wp_head', 'aurielslight_vite_client');

/**
 * Ensure scripts loaded from the dev server use type="module".
 *
 * @param string $tag
 * @param string $handle
 * @param string $src
 *
 * @return string
 */
function aurielslight_vite_script_tag($tag, $handle, $src) {
	if ('aurielslight-app' !== $handle || aurielslight_vite_is_build()) {
		return $tag;
	}

	return '<script type="module" src="' . esc_url($src) . '" crossorigin></script>';
}

add_filter('script_loader_tag', 'aurielslight_vite_script_tag', 10, 3);



