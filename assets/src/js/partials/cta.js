import { gsap, pulseElement } from '../vendors';

const initCtaSection = () => {
	const cta = document.querySelector('[data-partial="cta"]');

	if (!cta) {
		return;
	}

	const button = cta.querySelector('.js-cta-button');

	if (!button) {
		return;
	}

	button.addEventListener('click', (event) => {
		// Allow the CTA to act as a trigger even if no URL is provided in the CMS.
		if (button instanceof HTMLAnchorElement && button.getAttribute('href') === '#') {
			event.preventDefault();
		}

		pulseElement(button);

		gsap.fromTo(
			cta,
			{ backgroundColor: '#0f172a' },
			{
				backgroundColor: '#1d4ed8',
				duration: 0.4,
				yoyo: true,
				repeat: 1,
				ease: 'power1.inOut',
			}
		);
	});
};

export default initCtaSection;
