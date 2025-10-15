<?php
/**
 * Template Name: Contact Page
 * Description: Lightweight contact layout leveraging theme tokens.
 */
declare(strict_types=1);

get_header();
?>
<main id="main" class="site-main space-y-16 bg-surface py-12">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'partials/hero' ); ?>

			<?php
			$accent  = function_exists( 'auriel_theme_get_design_token' ) ? auriel_theme_get_design_token( 'accent_color', '#10b981' ) : '#10b981';
			$surface = function_exists( 'auriel_theme_get_design_token' ) ? auriel_theme_get_design_token( 'surface_color', '#ffffff' ) : '#ffffff';
			?>
			<section class="mx-auto flex max-w-4xl flex-col gap-10 px-6 text-left md:flex-row">
				<div
					class="flex-1 rounded-2xl border border-text/10 p-8 shadow-sm"
					style="background: <?php echo esc_attr( $surface ); ?>;"
				>
					<h2 class="text-2xl font-semibold text-primary">
						<?php esc_html_e( 'Get in touch', 'auriel-theme' ); ?>
					</h2>
					<p class="mt-3 text-sm text-text/70">
						<?php esc_html_e( 'Drop in your details and we’ll respond as soon as possible.', 'auriel-theme' ); ?>
					</p>
					<article class="prose prose-slate mt-6 max-w-none">
						<?php the_content(); ?>
					</article>
				</div>
				<div
					class="flex w-full max-w-sm flex-col gap-4 rounded-2xl border border-transparent p-8 text-white shadow-lg"
					style="background: <?php echo esc_attr( $accent ); ?>;"
				>
					<h3 class="text-xl font-semibold">
						<?php esc_html_e( 'Quick links', 'auriel-theme' ); ?>
					</h3>
					<ul class="space-y-2 text-sm">
						<li>
							<a class="underline decoration-white/60 decoration-2 underline-offset-4 hover:decoration-white" href="mailto:hello@example.com">
								hello@example.com
							</a>
						</li>
						<li>
							<a class="underline decoration-white/60 decoration-2 underline-offset-4 hover:decoration-white" href="tel:+1123456789">
								+1 123 456 789
							</a>
						</li>
						<li>
							<span class="opacity-80">
								<?php esc_html_e( '123 Tailwind Ave, Suite 100', 'auriel-theme' ); ?>
							</span>
						</li>
					</ul>
				</div>
			</section>
		<?php endwhile; ?>
	<?php endif; ?>
</main>
<?php
get_footer();
