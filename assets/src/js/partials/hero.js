import { fadeInElements } from '../vendors';

const initHeroSection = () => {
	const hero = document.querySelector('[data-partial="hero"]');

	if (!hero) {
		return;
	}

	const animatedNodes = hero.querySelectorAll('[data-animate="fade"]');
	fadeInElements(animatedNodes, { delay: 0.1 });
};

export default initHeroSection;
