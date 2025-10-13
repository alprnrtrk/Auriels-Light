import { createFeatureSlider, scrollReveal } from '../vendors';

const initFeaturesSection = () => {
	const section = document.querySelector('[data-partial="features"]');

	if (!section) {
		return;
	}

	const slider = section.querySelector('.js-feature-slider');

	if (!slider) {
		return;
	}

	createFeatureSlider(slider, {
		breakpoints: {
			1024: {
				spaceBetween: 48,
			},
		},
	});

	scrollReveal(section.querySelectorAll('.feature-card'), {
		trigger: section,
		start: 'top 75%',
		stagger: 0.18,
	});
};

export default initFeaturesSection;
