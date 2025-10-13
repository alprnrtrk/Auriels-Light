import initHomePage from './home';
import initAboutPage from './about';
import initContactPage from './contact';

// Page-level controllers run after partials. Each one checks `body[data-template]` before doing work.
const controllers = [initHomePage, initAboutPage, initContactPage];

const initPages = () => {
	controllers.forEach((controller) => {
		if (typeof controller === 'function') {
			controller();
		}
	});
};

export default initPages;
