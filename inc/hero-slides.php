<?php
declare(strict_types=1);

const AURIEL_HERO_SLIDES_META_KEY = '_auriel_hero_slides';

/**
 * Register hero slides meta box for pages.
 */
function auriel_theme_register_hero_slides_meta_box(): void
{
  add_meta_box(
    'auriel-hero-slides',
    __('Hero Slides', 'auriel-theme'),
    'auriel_theme_render_hero_slides_meta_box',
    'page',
    'normal',
    'default'
  );
}
add_action('add_meta_boxes', 'auriel_theme_register_hero_slides_meta_box');

/**
 * Render the hero slides meta box UI.
 *
 * @param WP_Post $post Current post object.
 */
function auriel_theme_render_hero_slides_meta_box(WP_Post $post): void
{
  wp_nonce_field('auriel_hero_slides_nonce', 'auriel_hero_slides_nonce');
  wp_enqueue_media();

  auriel_theme_enqueue_hero_slides_admin_assets();

  $slides = get_post_meta($post->ID, AURIEL_HERO_SLIDES_META_KEY, true);
  if (!is_array($slides)) {
    $slides = array();
  }

  ?>
  <div class="auriel-hero-slides" data-slides-count="<?php echo esc_attr(count($slides)); ?>">
    <p class="description">
      <?php esc_html_e('Add one or more slides for the hero carousel. Each slide can include an image, text, and an optional button.', 'auriel-theme'); ?>
    </p>
    <div class="auriel-hero-slides__list" data-auriel-hero-slides-list>
      <?php
      foreach ($slides as $index => $slide) {
        auriel_theme_render_hero_slide_row($index, $slide);
      }
      ?>
    </div>
    <button type="button" class="button button-secondary" data-auriel-hero-slide-add>
      <?php esc_html_e('Add slide', 'auriel-theme'); ?>
    </button>
  </div>

  <template id="auriel-hero-slide-template">
    <?php auriel_theme_render_hero_slide_row('__index__', array()); ?>
  </template>
  <?php
}

/**
 * Output markup for a single slide row.
 *
 * @param int|string $index Slide index.
 * @param array      $slide Slide data.
 */
function auriel_theme_render_hero_slide_row($index, array $slide): void
{
  $title = $slide['title'] ?? '';
  $subtitle = $slide['subtitle'] ?? '';
  $content = $slide['content'] ?? '';
  $button_label = $slide['button_label'] ?? '';
  $button_url = $slide['button_url'] ?? '';
  $image_id = isset($slide['image_id']) ? (int) $slide['image_id'] : 0;

  $image_html = $image_id ? wp_get_attachment_image($image_id, 'medium', false, array('class' => 'auriel-hero-slide__image-preview', 'loading' => 'lazy')) : '';
  $placeholder_text = esc_html__('No image selected', 'auriel-theme');
  ?>
  <div class="auriel-hero-slide-card" data-auriel-hero-slide data-index="<?php echo esc_attr((string) $index); ?>">
    <div class="auriel-hero-slide-card__actions">
      <button type="button" class="button-link" data-auriel-hero-slide-move-up aria-label="<?php esc_attr_e('Move slide up', 'auriel-theme'); ?>">&#8593;</button>
      <button type="button" class="button-link" data-auriel-hero-slide-move-down aria-label="<?php esc_attr_e('Move slide down', 'auriel-theme'); ?>">&#8595;</button>
      <button type="button" class="button-link auriel-hero-slide-card__remove" data-auriel-hero-slide-remove>
        <?php esc_html_e('Remove', 'auriel-theme'); ?>
      </button>
    </div>
    <div class="auriel-hero-slide-card__body">
      <p class="description">
        <?php esc_html_e('Slide content', 'auriel-theme'); ?>
      </p>
      <div class="auriel-hero-slide-card__field">
        <label><?php esc_html_e('Title', 'auriel-theme'); ?></label>
        <input type="text" class="widefat" name="auriel_hero_slides[<?php echo esc_attr((string) $index); ?>][title]" value="<?php echo esc_attr($title); ?>">
      </div>
      <div class="auriel-hero-slide-card__field">
        <label><?php esc_html_e('Subtitle', 'auriel-theme'); ?></label>
        <textarea class="widefat" rows="2" name="auriel_hero_slides[<?php echo esc_attr((string) $index); ?>][subtitle]"><?php echo esc_textarea($subtitle); ?></textarea>
      </div>
      <div class="auriel-hero-slide-card__field">
        <label><?php esc_html_e('Body content', 'auriel-theme'); ?></label>
        <textarea class="widefat" rows="4" name="auriel_hero_slides[<?php echo esc_attr((string) $index); ?>][content]"><?php echo esc_textarea($content); ?></textarea>
      </div>
      <div class="auriel-hero-slide-card__two-col">
        <div class="auriel-hero-slide-card__field">
          <label><?php esc_html_e('Button label', 'auriel-theme'); ?></label>
          <input type="text" class="widefat" name="auriel_hero_slides[<?php echo esc_attr((string) $index); ?>][button_label]" value="<?php echo esc_attr($button_label); ?>">
        </div>
        <div class="auriel-hero-slide-card__field">
          <label><?php esc_html_e('Button URL', 'auriel-theme'); ?></label>
          <input type="url" class="widefat" name="auriel_hero_slides[<?php echo esc_attr((string) $index); ?>][button_url]" value="<?php echo esc_attr($button_url); ?>">
        </div>
      </div>
      <div class="auriel-hero-slide-card__field">
        <label><?php esc_html_e('Image', 'auriel-theme'); ?></label>
        <div class="auriel-hero-slide-card__image">
          <div class="auriel-hero-slide-card__image-preview-wrapper" data-auriel-hero-slide-image-preview data-placeholder-text="<?php echo esc_attr($placeholder_text); ?>">
            <?php
            if ($image_html) {
              echo wp_kses_post($image_html);
            } else {
              echo '<div class="auriel-hero-slide-card__image-placeholder">' . esc_html($placeholder_text) . '</div>';
            }
            ?>
          </div>
          <input type="hidden" name="auriel_hero_slides[<?php echo esc_attr((string) $index); ?>][image_id]" value="<?php echo esc_attr($image_id); ?>" data-auriel-hero-slide-image-id>
          <div class="auriel-hero-slide-card__image-actions">
            <button type="button" class="button button-secondary" data-auriel-hero-slide-select-image>
              <?php esc_html_e('Choose image', 'auriel-theme'); ?>
            </button>
            <button type="button" class="button button-link-delete" data-auriel-hero-slide-clear-image>
              <?php esc_html_e('Remove image', 'auriel-theme'); ?>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
}

/**
 * Enqueue admin assets for hero slides meta box.
 */
function auriel_theme_enqueue_hero_slides_admin_assets(): void
{
  static $enqueued = false;

  if ($enqueued) {
    return;
  }

  $style_path = get_template_directory() . '/assets/admin/hero-slides.css';
  $script_path = get_template_directory() . '/assets/admin/hero-slides.js';

  if (file_exists($style_path)) {
    wp_enqueue_style(
      'auriel-hero-slides-admin',
      get_template_directory_uri() . '/assets/admin/hero-slides.css',
      array(),
      (string) filemtime($style_path)
    );
  }

  if (file_exists($script_path)) {
    wp_enqueue_script(
      'auriel-hero-slides-admin',
      get_template_directory_uri() . '/assets/admin/hero-slides.js',
      array(),
      (string) filemtime($script_path),
      true
    );
  }

  $enqueued = true;
}

/**
 * Persist hero slides meta when saving the post.
 *
 * @param int $post_id Post ID.
 */
function auriel_theme_save_hero_slides_meta(int $post_id): void
{
  if (!isset($_POST['auriel_hero_slides_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['auriel_hero_slides_nonce'])), 'auriel_hero_slides_nonce')) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  $slides_input = $_POST['auriel_hero_slides'] ?? array();

  if (!is_array($slides_input)) {
    delete_post_meta($post_id, AURIEL_HERO_SLIDES_META_KEY);
    return;
  }

  $slides_input = wp_unslash($slides_input);

  $prepared = array();

  foreach ($slides_input as $slide) {
    if (!is_array($slide)) {
      continue;
    }

    $title = sanitize_text_field($slide['title'] ?? '');
    $subtitle = sanitize_text_field($slide['subtitle'] ?? '');
    $content = isset($slide['content']) ? wp_kses_post($slide['content']) : '';
    $button_label = sanitize_text_field($slide['button_label'] ?? '');
    $button_url = isset($slide['button_url']) ? esc_url_raw($slide['button_url']) : '';
    $image_id = isset($slide['image_id']) ? absint($slide['image_id']) : 0;

    if ('' === $title && '' === $subtitle && '' === $content && '' === $button_label && '' === $button_url && 0 === $image_id) {
      continue;
    }

    $prepared[] = array(
      'title' => $title,
      'subtitle' => $subtitle,
      'content' => $content,
      'button_label' => $button_label,
      'button_url' => $button_url,
      'image_id' => $image_id,
    );
  }

  if (!empty($prepared)) {
    update_post_meta($post_id, AURIEL_HERO_SLIDES_META_KEY, $prepared);
  } else {
    delete_post_meta($post_id, AURIEL_HERO_SLIDES_META_KEY);
  }
}
add_action('save_post_page', 'auriel_theme_save_hero_slides_meta');

/**
 * Retrieve hero slides for a given page.
 *
 * @param int $post_id Post ID. Defaults to current post in the loop.
 *
 * @return array<int,array<string,mixed>>
 */
function auriel_theme_get_hero_slides(int $post_id = 0): array
{
  if (0 === $post_id) {
    $post_id = get_the_ID();
  }

  $slides = get_post_meta($post_id, AURIEL_HERO_SLIDES_META_KEY, true);

  if (!is_array($slides)) {
    return array();
  }

  return array_map(
    static function ($slide): array {
      return array(
        'title' => isset($slide['title']) ? (string) $slide['title'] : '',
        'subtitle' => isset($slide['subtitle']) ? (string) $slide['subtitle'] : '',
        'content' => isset($slide['content']) ? (string) $slide['content'] : '',
        'button_label' => isset($slide['button_label']) ? (string) $slide['button_label'] : '',
        'button_url' => isset($slide['button_url']) ? (string) $slide['button_url'] : '',
        'image_id' => isset($slide['image_id']) ? (int) $slide['image_id'] : 0,
      );
    },
    $slides
  );
}
