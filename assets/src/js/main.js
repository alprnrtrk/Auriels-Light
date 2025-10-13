import initPartials from './partials';
import initPages from './pages';

/**
 * Entry point for theme scripts.
 *
 * Runs partial controllers first (they gracefully exit when their section is missing),
 * then executes page/template specific modules.
 */
document.addEventListener('DOMContentLoaded', () => {
	initPartials();
	initPages();
});
