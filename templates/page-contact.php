<?php
/**
 * Template Name: Contact
 */

get_header();

$post_id = aurielslight_resolve_post_id();

// Field-driven labels/placeholder text keep the form manageable from the WP admin.
$page_heading        = aurielslight_get_field('contact_heading', 'Let\'s build something together', $post_id);
$page_description    = aurielslight_get_field('contact_description', 'This form uses page-specific JavaScript to validate fields and Tailwind utilities for layout.', $post_id);
$name_label          = aurielslight_get_field('contact_name_label', 'Name', $post_id);
$name_placeholder    = aurielslight_get_field('contact_name_placeholder', 'Ada Lovelace', $post_id);
$email_label         = aurielslight_get_field('contact_email_label', 'Email', $post_id);
$email_placeholder   = aurielslight_get_field('contact_email_placeholder', 'you@example.com', $post_id);
$message_label       = aurielslight_get_field('contact_message_label', 'Project details', $post_id);
$message_placeholder = aurielslight_get_field('contact_message_placeholder', 'Tell us about your next project...', $post_id);
$submit_label        = aurielslight_get_field('contact_submit_label', 'Send request', $post_id);
$email_error         = aurielslight_get_field('contact_email_error', 'Enter a valid email.', $post_id);
?>

<main class="bg-slate-50 py-16">
	<div class="container mx-auto max-w-3xl space-y-12 px-6" data-template-module="contact">
		<header class="text-center">
			<?php if ($page_heading) : ?>
				<h1 class="section-heading text-slate-900"><?php echo esc_html($page_heading); ?></h1>
			<?php endif; ?>
			<?php if ($page_description) : ?>
				<p class="mt-4 text-lg text-slate-600">
					<?php echo wp_kses_post($page_description); ?>
				</p>
			<?php endif; ?>
		</header>

		<form class="contact-form space-y-6 rounded-2xl bg-white p-8 shadow-lg">
			<div class="grid gap-6 md:grid-cols-2">
				<label class="field">
					<?php if ($name_label) : ?>
						<span class="field__label"><?php echo esc_html($name_label); ?></span>
					<?php endif; ?>
					<input type="text" name="name" class="field__input" placeholder="<?php echo esc_attr($name_placeholder); ?>" required>
				</label>
				<label class="field">
					<?php if ($email_label) : ?>
						<span class="field__label"><?php echo esc_html($email_label); ?></span>
					<?php endif; ?>
					<input type="email" name="email" class="field__input js-contact-email" placeholder="<?php echo esc_attr($email_placeholder); ?>" required>
					<?php if ($email_error) : ?>
						<small class="field__error" hidden><?php echo esc_html($email_error); ?></small>
					<?php endif; ?>
				</label>
			</div>
			<label class="field">
				<?php if ($message_label) : ?>
					<span class="field__label"><?php echo esc_html($message_label); ?></span>
				<?php endif; ?>
				<textarea name="message" class="field__input field__input--textarea" rows="5" placeholder="<?php echo esc_attr($message_placeholder); ?>" required></textarea>
			</label>
			<button type="submit" class="btn-primary js-contact-submit"><?php echo esc_html($submit_label); ?></button>
		</form>
	</div>
</main>

<?php
get_template_part('partials/section', 'cta');
get_footer();

