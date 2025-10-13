const initHeader = () => {
	const header = document.querySelector('[data-partial="site-header"]');

	if (!header) {
		return;
	}

	const toggle = header.querySelector('[data-header-toggle]');
	const nav = header.querySelector('[data-header-menu]');

	if (toggle && nav) {
		const closeMenu = () => {
			toggle.setAttribute('aria-expanded', 'false');
			header.classList.remove('is-nav-open');
		};

		toggle.addEventListener('click', () => {
			const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
			toggle.setAttribute('aria-expanded', String(!isExpanded));
			header.classList.toggle('is-nav-open', !isExpanded);
		});

		nav.querySelectorAll('a').forEach((link) => {
			link.addEventListener('click', () => {
				if (window.innerWidth < 1024) {
					closeMenu();
				}
			});
		});

		window.addEventListener('resize', () => {
			if (window.innerWidth >= 1024) {
				closeMenu();
			}
		});
	}

	const handleScroll = () => {
		header.classList.toggle('is-scrolled', window.scrollY > 16);
	};

	handleScroll();
	window.addEventListener('scroll', handleScroll, { passive: true });
};

export default initHeader;
