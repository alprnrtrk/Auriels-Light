<?php
/**
 * Call-to-action block used on multiple templates.
 */
$post_id    = aurielslight_resolve_post_id();
$heading    = aurielslight_get_field('cta_heading', 'Need a kickstart? This CTA partial is shared across templates.', $post_id);
$text       = aurielslight_get_field('cta_text', 'The JavaScript controller attached to this partial only runs when the section exists on the page.', $post_id);
$cta_button = aurielslight_get_link_fields(
	'cta_button_label',
	'cta_button_link',
	array(
		'label' => 'Trigger CTA animation',
		'url'   => '#',
	),
	$post_id
);
$cta_href = $cta_button['url'] ? $cta_button['url'] : '#';
?>
<section data-partial="cta" class="bg-slate-900 py-16 text-white">
	<div class="container mx-auto flex max-w-4xl flex-col items-center gap-6 px-6 text-center">
		<?php if ($heading) : ?>
			<h2 class="section-heading text-balance">
				<?php echo esc_html($heading); ?>
			</h2>
		<?php endif; ?>
		<?php if ($text) : ?>
			<p class="text-lg text-slate-300">
				<?php echo wp_kses_post($text); ?>
			</p>
		<?php endif; ?>
		<?php if ($cta_button['label']) : ?>
			<a class="btn-primary js-cta-button" href="<?php echo esc_url($cta_href); ?>">
				<?php echo esc_html($cta_button['label']); ?>
			</a>
		<?php endif; ?>
	</div>
</section>

