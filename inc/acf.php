<?php

if (!function_exists('acf_add_local_field_group')) {
	return;
}

acf_add_local_field_group(
	array(
		'key'    => 'group_aurielslight_home',
		'title'  => __('Home Page Content', 'aurielslight'),
		'fields' => array(
			array(
				'key'           => 'field_aurielslight_hero_badge',
				'label'         => __('Hero Badge', 'aurielslight'),
				'name'          => 'hero_badge',
				'type'          => 'text',
				'default_value' => 'Build faster with Auriels Light',
				'wrapper'       => array(
					'width' => '30',
				),
			),
			array(
				'key'           => 'field_aurielslight_hero_title',
				'label'         => __('Hero Heading', 'aurielslight'),
				'name'          => 'hero_title',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => 'The blank WordPress theme that keeps development playful.',
			),
			array(
				'key'           => 'field_aurielslight_hero_description',
				'label'         => __('Hero Description', 'aurielslight'),
				'name'          => 'hero_description',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'Tailwind, Vite and modern tooling are already wired for you. Drop in sections, sprinkle animations, and ship new ideas without wrestling legacy code.',
			),
			array(
				'key'     => 'field_aurielslight_hero_primary_button_label',
				'label'   => __('Primary Button Label', 'aurielslight'),
				'name'    => 'hero_primary_button_label',
				'type'    => 'text',
				'wrapper' => array(
					'width' => '40',
				),
				'default_value' => 'Discover the sections',
			),
			array(
				'key'     => 'field_aurielslight_hero_primary_button_link',
				'label'   => __('Primary Button Link', 'aurielslight'),
				'name'    => 'hero_primary_button_link',
				'type'    => 'url',
				'wrapper' => array(
					'width' => '40',
				),
				'default_value' => '#features',
			),
			array(
				'key'     => 'field_aurielslight_hero_secondary_button_label',
				'label'   => __('Secondary Button Label', 'aurielslight'),
				'name'    => 'hero_secondary_button_label',
				'type'    => 'text',
				'wrapper' => array(
					'width' => '40',
				),
				'default_value' => 'Contact us',
			),
			array(
				'key'     => 'field_aurielslight_hero_secondary_button_link',
				'label'   => __('Secondary Button Link', 'aurielslight'),
				'name'    => 'hero_secondary_button_link',
				'type'    => 'url',
				'wrapper' => array(
					'width' => '40',
				),
				'default_value' => home_url('/contact'),
			),
			array(
				'key'           => 'field_aurielslight_hero_image',
				'label'         => __('Hero Illustration', 'aurielslight'),
				'name'          => 'hero_image',
				'type'          => 'image',
				'return_format' => 'id',
				'preview_size'  => 'medium',
				'instructions'  => __('Upload an optional hero illustration.', 'aurielslight'),
			),
			array(
				'key'           => 'field_aurielslight_features_heading',
				'label'         => __('Features Section Heading', 'aurielslight'),
				'name'          => 'features_heading',
				'type'          => 'text',
				'default_value' => 'Reusable sections ready for motion',
			),
			array(
				'key'           => 'field_aurielslight_features_intro',
				'label'         => __('Features Section Intro', 'aurielslight'),
				'name'          => 'features_intro',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'Use this slider as a starting point for showcasing product features or services. It is powered by Swiper and initialised per-partial.',
			),
			array(
				'key'          => 'field_aurielslight_features_list',
				'label'        => __('Feature Slides', 'aurielslight'),
				'name'         => 'features_list',
				'type'         => 'repeater',
				'layout'       => 'row',
				'button_label' => __('Add Feature', 'aurielslight'),
				'sub_fields'   => array(
					array(
						'key'   => 'field_aurielslight_feature_title',
						'label' => __('Title', 'aurielslight'),
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'           => 'field_aurielslight_feature_description',
						'label'         => __('Description', 'aurielslight'),
						'name'          => 'description',
						'type'          => 'textarea',
						'rows'          => 3,
					),
				),
			),
			array(
				'key'           => 'field_aurielslight_home_content_heading',
				'label'         => __('Content Section Heading', 'aurielslight'),
				'name'          => 'home_content_heading',
				'type'          => 'text',
				'default_value' => 'Page editor content',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/page-home.php',
				),
			),
		),
	)
);

acf_add_local_field_group(
	array(
		'key'    => 'group_aurielslight_about',
		'title'  => __('About Page Content', 'aurielslight'),
		'fields' => array(
			array(
				'key'           => 'field_aurielslight_about_intro_label',
				'label'         => __('Intro Label', 'aurielslight'),
				'name'          => 'about_intro_label',
				'type'          => 'text',
				'default_value' => 'Who we are',
				'wrapper'       => array(
					'width' => '30',
				),
			),
			array(
				'key'           => 'field_aurielslight_about_intro_heading',
				'label'         => __('Intro Heading', 'aurielslight'),
				'name'          => 'about_intro_heading',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => 'About the Auriels Light starter',
			),
			array(
				'key'           => 'field_aurielslight_about_intro_text',
				'label'         => __('Intro Description', 'aurielslight'),
				'name'          => 'about_intro_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'This template demonstrates page-scoped styling and scripts. Inspect the markup to see the data-template attribute applied to the body element.',
			),
			array(
				'key'           => 'field_aurielslight_about_highlight_title',
				'label'         => __('Highlight Title', 'aurielslight'),
				'name'          => 'about_highlight_title',
				'type'          => 'text',
				'default_value' => 'Our blank slate philosophy',
			),
			array(
				'key'           => 'field_aurielslight_about_highlight_text',
				'label'         => __('Highlight Text', 'aurielslight'),
				'name'          => 'about_highlight_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'We keep defaults minimal so you can add only what a project needs. Tailwind utilities help to iterate fast, while dedicated SCSS layers let you extract reusable components as they emerge.',
			),
			array(
				'key'          => 'field_aurielslight_about_cards',
				'label'        => __('Support Cards', 'aurielslight'),
				'name'         => 'about_cards',
				'type'         => 'repeater',
				'layout'       => 'row',
				'button_label' => __('Add Card', 'aurielslight'),
				'sub_fields'   => array(
					array(
						'key'   => 'field_aurielslight_about_card_title',
						'label' => __('Title', 'aurielslight'),
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'           => 'field_aurielslight_about_card_text',
						'label'         => __('Description', 'aurielslight'),
						'name'          => 'description',
						'type'          => 'textarea',
						'rows'          => 3,
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/page-about.php',
				),
			),
		),
	)
);

acf_add_local_field_group(
	array(
		'key'    => 'group_aurielslight_contact',
		'title'  => __('Contact Page Content', 'aurielslight'),
		'fields' => array(
			array(
				'key'           => 'field_aurielslight_contact_heading',
				'label'         => __('Page Heading', 'aurielslight'),
				'name'          => 'contact_heading',
				'type'          => 'text',
				'default_value' => 'Let\'s build something together',
			),
			array(
				'key'           => 'field_aurielslight_contact_description',
				'label'         => __('Intro Description', 'aurielslight'),
				'name'          => 'contact_description',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'This form uses page-specific JavaScript to validate fields and Tailwind utilities for layout.',
			),
			array(
				'key'           => 'field_aurielslight_contact_name_label',
				'label'         => __('Name Label', 'aurielslight'),
				'name'          => 'contact_name_label',
				'type'          => 'text',
				'default_value' => 'Name',
				'wrapper'       => array(
					'width' => '50',
				),
			),
			array(
				'key'           => 'field_aurielslight_contact_name_placeholder',
				'label'         => __('Name Placeholder', 'aurielslight'),
				'name'          => 'contact_name_placeholder',
				'type'          => 'text',
				'default_value' => 'Ada Lovelace',
				'wrapper'       => array(
					'width' => '50',
				),
			),
			array(
				'key'           => 'field_aurielslight_contact_email_label',
				'label'         => __('Email Label', 'aurielslight'),
				'name'          => 'contact_email_label',
				'type'          => 'text',
				'default_value' => 'Email',
				'wrapper'       => array(
					'width' => '50',
				),
			),
			array(
				'key'           => 'field_aurielslight_contact_email_placeholder',
				'label'         => __('Email Placeholder', 'aurielslight'),
				'name'          => 'contact_email_placeholder',
				'type'          => 'text',
				'default_value' => 'you@example.com',
				'wrapper'       => array(
					'width' => '50',
				),
			),
			array(
				'key'           => 'field_aurielslight_contact_message_label',
				'label'         => __('Details Label', 'aurielslight'),
				'name'          => 'contact_message_label',
				'type'          => 'text',
				'default_value' => 'Project details',
				'wrapper'       => array(
					'width' => '50',
				),
			),
			array(
				'key'           => 'field_aurielslight_contact_message_placeholder',
				'label'         => __('Details Placeholder', 'aurielslight'),
				'name'          => 'contact_message_placeholder',
				'type'          => 'text',
				'default_value' => 'Tell us about your next project...',
				'wrapper'       => array(
					'width' => '50',
				),
			),
			array(
				'key'           => 'field_aurielslight_contact_submit_label',
				'label'         => __('Submit Button Label', 'aurielslight'),
				'name'          => 'contact_submit_label',
				'type'          => 'text',
				'default_value' => 'Send request',
			),
			array(
				'key'           => 'field_aurielslight_contact_email_error',
				'label'         => __('Email Error Message', 'aurielslight'),
				'name'          => 'contact_email_error',
				'type'          => 'text',
				'default_value' => 'Enter a valid email.',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/page-contact.php',
				),
			),
		),
	)
);

acf_add_local_field_group(
	array(
		'key'    => 'group_aurielslight_cta',
		'title'  => __('Page CTA', 'aurielslight'),
		'fields' => array(
			array(
				'key'           => 'field_aurielslight_cta_heading',
				'label'         => __('CTA Heading', 'aurielslight'),
				'name'          => 'cta_heading',
				'type'          => 'text',
				'default_value' => 'Need a kickstart? This CTA partial is shared across templates.',
			),
			array(
				'key'           => 'field_aurielslight_cta_text',
				'label'         => __('CTA Description', 'aurielslight'),
				'name'          => 'cta_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'The JavaScript controller attached to this partial only runs when the section exists on the page.',
			),
			array(
				'key'           => 'field_aurielslight_cta_button_label',
				'label'         => __('CTA Button Label', 'aurielslight'),
				'name'          => 'cta_button_label',
				'type'          => 'text',
				'default_value' => 'Trigger CTA animation',
				'wrapper'       => array(
					'width' => '50',
				),
			),
			array(
				'key'           => 'field_aurielslight_cta_button_link',
				'label'         => __('CTA Button Link', 'aurielslight'),
				'name'          => 'cta_button_link',
				'type'          => 'url',
				'default_value' => '#contact',
				'wrapper'       => array(
					'width' => '50',
				),
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/page-home.php',
				),
			),
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/page-about.php',
				),
			),
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/page-contact.php',
				),
			),
		),
	)
);




