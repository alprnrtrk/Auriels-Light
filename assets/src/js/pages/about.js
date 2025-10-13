import { scrollReveal } from '../vendors';

const initAboutPage = () => {
	const template = document.body.dataset.template;

	// Only run this controller on pages using the About template.
	if (template !== 'page-about') {
		return;
	}

	const highlights = document.querySelectorAll('.about-highlight');
	scrollReveal(highlights, { trigger: document.body, start: 'top 80%' });
};

export default initAboutPage;
