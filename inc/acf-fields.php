<?php
declare(strict_types=1);

/**
 * Register basic ACF fields for pages.
 */
function auriel_theme_register_acf_fields(): void
{
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(
    array(
      'key' => 'group_auriel_page_hero',
      'title' => __('Page Hero', 'auriel-theme'),
      'fields' => array(
        array(
          'key' => 'field_auriel_hero_headline',
          'label' => __('Hero headline', 'auriel-theme'),
          'name' => 'hero_headline',
          'type' => 'text',
          'instructions' => __('Displayed as the main heading inside the hero partial.', 'auriel-theme'),
          'default_value' => '',
        ),
        array(
          'key' => 'field_auriel_hero_subheading',
          'label' => __('Hero subheading', 'auriel-theme'),
          'name' => 'hero_subheading',
          'type' => 'textarea',
          'rows' => 3,
          'new_lines' => '',
          'instructions' => __('Short description that appears beneath the headline.', 'auriel-theme'),
        ),
        array(
          'key' => 'field_auriel_hero_button_label',
          'label' => __('Hero button label', 'auriel-theme'),
          'name' => 'hero_button_label',
          'type' => 'text',
          'instructions' => __('Optional call-to-action label.', 'auriel-theme'),
        ),
        array(
          'key' => 'field_auriel_hero_button_url',
          'label' => __('Hero button URL', 'auriel-theme'),
          'name' => 'hero_button_url',
          'type' => 'url',
          'instructions' => __('Optional call-to-action link URL.', 'auriel-theme'),
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page',
          ),
        ),
      ),
      'style' => 'seamless',
      'position' => 'acf_after_title',
    )
  );
}
add_action('acf/init', 'auriel_theme_register_acf_fields');

/**
 * Safe wrapper around get_field to keep templates resilient.
 *
 * @param string     $field    Field name.
 * @param mixed      $default  Default value returned when field is empty.
 * @param int|string $post_id  Optional post ID, defaults to current post.
 *
 * @return mixed
 */
function auriel_theme_get_field(string $field, $default = '', $post_id = 0)
{
  if (!function_exists('get_field')) {
    return $default;
  }

  if (0 === $post_id) {
    $post_id = get_the_ID();
  }

  $value = get_field($field, $post_id);

  if (null === $value || '' === $value) {
    return $default;
  }

  return $value;
}
