<?php
declare(strict_types=1);

require_once get_template_directory() . '/inc/vite.php';
require_once get_template_directory() . '/inc/theme-options.php';
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/hero-slides.php';

function auriel_theme_setup(): void
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'auriel_theme_setup');
