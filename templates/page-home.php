<?php
/**
 * Template Name: Home
 */

get_header();
?>

<main class="space-y-16">
	<?php
	// Assemble the home page layout from reusable section partials.
	get_template_part('partials/section', 'hero');
	get_template_part('partials/section', 'features');
	get_template_part('partials/section', 'cta');
	?>

	<section class="bg-white py-12">
		<div class="container mx-auto max-w-4xl space-y-8 px-6">
			<?php
			$post_id         = aurielslight_resolve_post_id();
			$content_heading = aurielslight_get_field('home_content_heading', 'Page editor content', $post_id);
			?>
			<?php if ($content_heading) : ?>
				<h2 class="section-heading text-slate-900"><?php echo esc_html($content_heading); ?></h2>
			<?php endif; ?>
			<div class="prose prose-slate max-w-none">
				<?php
				// Pull whatever the editor enters in the block editor for this page.
				?>
				<?php the_content(); ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();

