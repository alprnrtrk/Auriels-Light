const initHomePage = () => {
	const template = document.body.dataset.template;

	// Skip execution when we're not on the home template or front page.
	if (!['front-page', 'page-home', 'home'].includes(template)) {
		return;
	}

	// Page-specific enhancements can be added here when needed.
};

export default initHomePage;
