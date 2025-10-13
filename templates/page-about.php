<?php
/**
 * Template Name: About
 */

get_header();

$post_id = aurielslight_resolve_post_id();

// Pull editable content from the "About Page Content" field group.
$intro_label      = aurielslight_get_field('about_intro_label', 'Who we are', $post_id);
$intro_heading    = aurielslight_get_field('about_intro_heading', 'About the Auriels Light starter', $post_id);
$intro_text       = aurielslight_get_field('about_intro_text', 'This template demonstrates page-scoped styling and scripts. Inspect the markup to see the data-template attribute applied to the body element.', $post_id);
$highlight_title  = aurielslight_get_field('about_highlight_title', 'Our blank slate philosophy', $post_id);
$highlight_text   = aurielslight_get_field('about_highlight_text', 'We keep defaults minimal so you can add only what a project needs. Tailwind utilities help to iterate fast, while dedicated SCSS layers let you extract reusable components as they emerge.', $post_id);
$cards            = aurielslight_get_field(
	'about_cards',
	array(
		array(
			'title'       => 'Design tokens',
			'description' => 'Start with Tailwind\'s defaults, then extend the theme in tailwind.config.js to share colours and spacing across templates.',
		),
		array(
			'title'       => 'Animation helpers',
			'description' => 'GSAP utilities are available through assets/src/js/vendors/gsap.js. Only templates that import them will execute animations.',
		),
	),
	$post_id
);
?>

<main class="bg-white py-16">
	<div class="container mx-auto max-w-4xl space-y-12 px-6">
		<header class="space-y-4 text-center">
			<?php if ($intro_label) : ?>
				<p class="text-sm font-semibold uppercase tracking-wide text-brand"><?php echo esc_html($intro_label); ?></p>
			<?php endif; ?>

			<?php if ($intro_heading) : ?>
				<h1 class="section-heading text-slate-900"><?php echo esc_html($intro_heading); ?></h1>
			<?php endif; ?>

			<?php if ($intro_text) : ?>
				<p class="text-lg text-slate-600">
					<?php echo wp_kses_post($intro_text); ?>
				</p>
			<?php endif; ?>
		</header>

		<section class="space-y-6">
			<?php if ($highlight_title || $highlight_text) : ?>
				<div class="about-highlight rounded-xl border border-slate-200 bg-slate-50 p-6">
					<?php if ($highlight_title) : ?>
						<h2 class="text-2xl font-semibold text-slate-900"><?php echo esc_html($highlight_title); ?></h2>
					<?php endif; ?>
					<?php if ($highlight_text) : ?>
						<p class="mt-3 text-slate-600">
							<?php echo wp_kses_post($highlight_text); ?>
						</p>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($cards)) : ?>
				<div class="grid gap-6 lg:grid-cols-2">
					<?php foreach ($cards as $card) : ?>
						<?php
						$card_title = isset($card['title']) ? $card['title'] : '';
						$card_text  = isset($card['description']) ? $card['description'] : '';
						?>
						<article class="rounded-xl border border-slate-200 p-6 shadow-sm">
							<?php if ($card_title) : ?>
								<h3 class="text-xl font-semibold text-slate-900"><?php echo esc_html($card_title); ?></h3>
							<?php endif; ?>
							<?php if ($card_text) : ?>
								<p class="mt-3 text-slate-600">
									<?php echo wp_kses_post($card_text); ?>
								</p>
							<?php endif; ?>
						</article>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</section>

		<section class="prose prose-slate max-w-none">
			<?php the_content(); ?>
		</section>
	</div>
</main>

<?php
get_template_part('partials/section', 'cta');
get_footer();



