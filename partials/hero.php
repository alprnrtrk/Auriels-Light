<?php
declare(strict_types=1);

$default_headline = get_the_title() ?: get_bloginfo('name');
$default_subheading = get_bloginfo('description', 'display');
$default_button = array(
  'label' => __('Explore more', 'auriel-theme'),
  'url' => home_url(),
);

$hero_headline = function_exists('auriel_theme_get_field') ? auriel_theme_get_field('hero_headline', $default_headline) : $default_headline;
$hero_subheading = function_exists('auriel_theme_get_field') ? auriel_theme_get_field('hero_subheading', $default_subheading) : $default_subheading;
$hero_button_label = function_exists('auriel_theme_get_field') ? auriel_theme_get_field('hero_button_label', $default_button['label']) : $default_button['label'];
$hero_button_url = function_exists('auriel_theme_get_field') ? auriel_theme_get_field('hero_button_url', (string) $default_button['url']) : (string) $default_button['url'];

$design_tokens_defaults = array(
  'primary_color' => '#3b82f6',
  'secondary_color' => '#f59e0b',
  'accent_color' => '#10b981',
  'surface_color' => '#ffffff',
  'text_color' => '#0f172a',
);

$design_tokens = function_exists('auriel_theme_get_design_tokens')
  ? wp_parse_args(auriel_theme_get_design_tokens(), $design_tokens_defaults)
  : $design_tokens_defaults;

$raw_slides = function_exists('auriel_theme_get_hero_slides') ? auriel_theme_get_hero_slides() : array();
$prepared_slides = array();

if (!empty($raw_slides)) {
  foreach ($raw_slides as $raw_slide) {
    $title = !empty($raw_slide['title']) ? $raw_slide['title'] : __('Untitled slide', 'auriel-theme');
    $subtitle = $raw_slide['subtitle'] ?? '';
    $content = $raw_slide['content'] ?? '';
    $button_label = $raw_slide['button_label'] ?? '';
    $button_url = $raw_slide['button_url'] ?? '';
    $image_id = isset($raw_slide['image_id']) ? (int) $raw_slide['image_id'] : 0;
    $image_html = $image_id ? wp_get_attachment_image($image_id, 'large', false, array('class' => 'h-full w-full object-cover', 'loading' => 'lazy')) : '';

    $prepared_slides[] = array(
      'title' => $title,
      'subtitle' => $subtitle,
      'button' => array(
        'label' => $button_label,
        'url' => $button_url,
      ),
      'image_html' => $image_html,
      'content' => $content,
    );
  }
}

if (empty($prepared_slides)) {
  $prepared_slides = array(
    array(
      'title' => __('Primary palette in action', 'auriel-theme'),
      'subtitle' => sprintf(
        /* translators: %s is a HEX colour value. */
        __('Buttons and interactive accents inherit %s.', 'auriel-theme'),
        $design_tokens['primary_color']
      ),
      'button' => array(),
      'image_html' => '',
      'content' => '',
    ),
    array(
      'title' => __('Secondary highlights', 'auriel-theme'),
      'subtitle' => sprintf(
        __('Badges and highlights rely on %s.', 'auriel-theme'),
        $design_tokens['secondary_color']
      ),
      'button' => array(),
      'image_html' => '',
      'content' => '',
    ),
    array(
      'title' => __('Accent tone', 'auriel-theme'),
      'subtitle' => sprintf(
        __('CTA backgrounds use %s.', 'auriel-theme'),
        $design_tokens['accent_color']
      ),
      'button' => array(),
      'image_html' => '',
      'content' => '',
    ),
  );
}
?>
<section class="relative isolate overflow-hidden bg-surface text-text" data-hero-partial>
  <div class="mx-auto flex max-w-6xl flex-col gap-8 px-6 py-16 text-center">
    <div class="space-y-4" data-hero-animate>
      <p class="text-sm font-semibold uppercase tracking-[0.3em] text-secondary">
        <?php esc_html_e('Featured', 'auriel-theme'); ?>
      </p>
      <h1 class="text-4xl font-semibold text-primary md:text-5xl">
        <?php echo esc_html($hero_headline); ?>
      </h1>
      <?php if (!empty($hero_subheading)): ?>
        <p class="mx-auto max-w-2xl text-base text-text/80 md:text-lg">
          <?php echo esc_html($hero_subheading); ?>
        </p>
      <?php endif; ?>

      <?php if (!empty($hero_button_label) && !empty($hero_button_url)): ?>
        <div class="flex justify-center">
          <a class="inline-flex items-center gap-2 rounded-full border border-primary bg-primary px-6 py-3 text-sm font-semibold text-white shadow transition hover:bg-primary/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/60" href="<?php echo esc_url($hero_button_url); ?>">
            <?php echo esc_html($hero_button_label); ?>
          </a>
        </div>
      <?php endif; ?>
    </div>

    <div class="relative">
      <div class="swiper rounded-2xl border border-text/10 bg-white/70 p-6 shadow-xl backdrop-blur" data-hero-slider>
        <div class="swiper-wrapper">
          <?php foreach ($prepared_slides as $index => $slide): ?>
            <div class="swiper-slide">
              <div class="grid gap-6 md:grid-cols-2 md:items-center">
                <?php if (!empty($slide['image_html'])): ?>
                  <div class="overflow-hidden rounded-2xl bg-surface shadow-inner">
                    <?php echo wp_kses_post($slide['image_html']); ?>
                  </div>
                <?php endif; ?>
                <div class="text-left space-y-4">
                  <p class="text-xs font-medium uppercase tracking-widest text-secondary">
                    <?php
                    printf(
                      /* translators: %d is the slide index. */
                      esc_html__('Slide %d', 'auriel-theme'),
                      (int) $index + 1
                    );
                    ?>
                  </p>
                  <h2 class="text-2xl font-semibold text-primary">
                    <?php echo esc_html($slide['title']); ?>
                  </h2>
                  <?php if (!empty($slide['subtitle'])): ?>
                    <p class="text-sm text-text/70">
                      <?php echo esc_html($slide['subtitle']); ?>
                    </p>
                  <?php endif; ?>
                  <?php if (!empty($slide['content'])): ?>
                    <div class="prose prose-sm prose-slate max-w-none">
                      <?php echo wp_kses_post(wpautop($slide['content'])); ?>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($slide['button']['label']) && !empty($slide['button']['url'])): ?>
                    <div>
                      <a class="inline-flex items-center gap-2 rounded-full border border-accent bg-accent px-5 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-accent/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-accent/60" href="<?php echo esc_url($slide['button']['url']); ?>">
                        <?php echo esc_html($slide['button']['label']); ?>
                      </a>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="mt-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          <div class="flex items-center gap-2">
            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-primary/40 text-primary transition hover:bg-primary hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/60" data-hero-prev>
              <span class="sr-only"><?php esc_html_e('Previous slide', 'auriel-theme'); ?></span>
              &larr;
            </button>
            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-primary/40 text-primary transition hover:bg-primary hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/60" data-hero-next>
              <span class="sr-only"><?php esc_html_e('Next slide', 'auriel-theme'); ?></span>
              &rarr;
            </button>
          </div>
          <div class="flex items-center justify-center gap-2" data-hero-pagination></div>
        </div>
      </div>
    </div>
  </div>
</section>
