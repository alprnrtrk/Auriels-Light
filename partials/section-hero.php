<?php
/**
 * Hero section partial displayed on the home template.
 */
$post_id = aurielslight_resolve_post_id();

$badge           = aurielslight_get_field('hero_badge', 'Build faster with Auriels Light', $post_id);
$heading         = aurielslight_get_field('hero_title', 'The blank WordPress theme that keeps development playful.', $post_id);
$description     = aurielslight_get_field('hero_description', 'Tailwind, Vite and modern tooling are already wired for you. Drop in sections, sprinkle animations, and ship new ideas without wrestling legacy code.', $post_id);
$primary_button  = aurielslight_get_link_fields(
	'hero_primary_button_label',
	'hero_primary_button_link',
	array(
		'label' => 'Discover the sections',
		'url'   => '#features',
	),
	$post_id
);
$secondary_button = aurielslight_get_link_fields(
	'hero_secondary_button_label',
	'hero_secondary_button_link',
	array(
		'label' => 'Contact us',
		'url'   => home_url('/contact'),
	),
	$post_id
);

$primary_href   = $primary_button['url'] ? $primary_button['url'] : '#';
$secondary_href = $secondary_button['url'] ? $secondary_button['url'] : '#';

$hero_image_id = aurielslight_get_image_id('hero_image', 0, $post_id);
// Render the uploaded hero illustration or fall back to a friendly placeholder bubble.
$hero_image    = $hero_image_id ? wp_get_attachment_image($hero_image_id, 'large', false, array('class' => 'max-h-60 w-full max-w-sm rounded-3xl shadow-xl')) : '';
?>
<section data-partial="hero" class="relative isolate overflow-hidden bg-slate-900 py-24 text-white">
	<div class="absolute inset-y-0 right-[-15%] hidden h-full w-1/2 rounded-full bg-slate-700 blur-3xl lg:block" aria-hidden="true"></div>
	<div class="container mx-auto flex max-w-5xl flex-col gap-10 px-6 text-center lg:flex-row lg:text-left">
		<div class="flex-1 space-y-6">
			<?php if ($badge) : ?>
				<p class="inline-block rounded-full bg-slate-800 px-4 py-1 text-sm font-semibold uppercase tracking-wide text-slate-200" data-animate="fade">
					<?php echo esc_html($badge); ?>
				</p>
			<?php endif; ?>
			<?php if ($heading) : ?>
				<h1 class="section-heading text-balance" data-animate="fade">
					<?php echo wp_kses_post($heading); ?>
				</h1>
			<?php endif; ?>
			<?php if ($description) : ?>
				<p class="text-lg text-slate-300" data-animate="fade">
					<?php echo wp_kses_post($description); ?>
				</p>
			<?php endif; ?>
			<?php if ($primary_button['label'] || $secondary_button['label']) : ?>
				<div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center lg:justify-start" data-animate="fade">
					<?php if ($primary_button['label']) : ?>
						<a href="<?php echo esc_url($primary_href); ?>" class="btn-primary">
							<?php echo esc_html($primary_button['label']); ?>
						</a>
					<?php endif; ?>
					<?php if ($secondary_button['label']) : ?>
						<a href="<?php echo esc_url($secondary_href); ?>" class="btn-secondary">
							<?php echo esc_html($secondary_button['label']); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="flex flex-1 items-center justify-center lg:justify-end" data-animate="fade">
			<?php if ($hero_image) : ?>
				<?php echo $hero_image; ?>
			<?php else : ?>
				<div class="grid h-60 w-60 place-items-center rounded-full border border-slate-700 bg-slate-800 shadow-lg shadow-slate-900/40">
					<span class="text-2xl font-medium tracking-wide text-slate-200">Hello there</span>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>


