import initHeader from './header';
import initHeroSection from './hero';
import initFeaturesSection from './features';
import initCtaSection from './cta';

// Register every partial controller here.
const partialInitialisers = [initHeader, initHeroSection, initFeaturesSection, initCtaSection];

const initPartials = () => {
	partialInitialisers.forEach((initialiser) => {
		if (typeof initialiser === 'function') {
			initialiser();
		}
	});
};

export default initPartials;
