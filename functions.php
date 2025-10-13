<?php

require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/vite.php';
require get_template_directory() . '/inc/acf.php';

/**
 * Basic theme setup so WordPress can render pages without extra opinions.
 */
function aurielslight_setup() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	register_nav_menus(
		array(
			'primary' => __('Primary Menu', 'aurielslight'),
		)
	);

	load_theme_textdomain('aurielslight', get_template_directory() . '/languages');
}

add_action('after_setup_theme', 'aurielslight_setup');

/**
 * Returns a short handle for the current template or view.
 *
 * Used to attach data attributes for page-specific assets.
 *
 * @return string
 */
function aurielslight_get_template_context() {
	if (is_front_page()) {
		return 'front-page';
	}

	$template_slug = get_page_template_slug();

	if ($template_slug) {
		$template_slug = str_replace(array('templates/', '.php'), '', $template_slug);

		return sanitize_title($template_slug);
	}

	if (is_home()) {
		return 'blog';
	}

	if (is_page()) {
		$page = get_post(get_queried_object_id());

		return $page ? 'page-' . sanitize_title($page->post_name) : 'page';
	}

	if (is_single()) {
		return 'single-' . get_post_type();
	}

	if (is_archive()) {
		return 'archive';
	}

	return 'default';
}


