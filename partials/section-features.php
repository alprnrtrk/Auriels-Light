<?php
/**
 * Feature carousel section for the home template.
 */
$post_id = aurielslight_resolve_post_id();

$section_heading = aurielslight_get_field('features_heading', 'Reusable sections ready for motion', $post_id);
$section_intro   = aurielslight_get_field('features_intro', 'Use this slider as a starting point for showcasing product features or services. It is powered by Swiper and initialised per-partial.', $post_id);
$slides          = aurielslight_get_field(
	'features_list',
	// Provide sensible defaults when the repeater is empty or ACF is disabled.
	array(
		array(
			'title'       => 'Composable sections',
			'description' => 'Keep markup in small PHP partials and assemble any layout with get_template_part.',
		),
		array(
			'title'       => 'Scoped styling',
			'description' => 'Add Tailwind utility classes or layer in custom styles that target a specific template.',
		),
		array(
			'title'       => 'Interactive by default',
			'description' => 'Register section specific controllers so motion and sliders only load where required.',
		),
	),
	$post_id
);
?>
<section id="features" data-partial="features" class="bg-white py-20">
	<div class="container mx-auto max-w-5xl px-6">
		<div class="mx-auto mb-12 max-w-3xl text-center">
			<?php if ($section_heading) : ?>
				<h2 class="section-heading mb-4 text-slate-900">
					<?php echo esc_html($section_heading); ?>
				</h2>
			<?php endif; ?>
			<?php if ($section_intro) : ?>
				<p class="text-lg text-slate-600">
					<?php echo wp_kses_post($section_intro); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if (!empty($slides)) : ?>
			<div class="relative">
				<div class="swiper js-feature-slider">
					<div class="swiper-wrapper">
						<?php foreach ($slides as $slide) : ?>
							<?php
							$title       = isset($slide['title']) ? $slide['title'] : '';
							$description = isset($slide['description']) ? $slide['description'] : '';
							?>
							<div class="swiper-slide">
								<div class="feature-card">
									<?php if ($title) : ?>
										<h3 class="text-xl font-semibold text-slate-900"><?php echo esc_html($title); ?></h3>
									<?php endif; ?>
									<?php if ($description) : ?>
										<p class="mt-3 text-base text-slate-600"><?php echo wp_kses_post($description); ?></p>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="swiper-pagination"></div>
				</div>

				<button class="swiper-button-prev" type="button" aria-label="<?php echo esc_attr__('Previous slide', 'aurielslight'); ?>"></button>
				<button class="swiper-button-next" type="button" aria-label="<?php echo esc_attr__('Next slide', 'aurielslight'); ?>"></button>
			</div>
		<?php endif; ?>
	</div>
</section>


