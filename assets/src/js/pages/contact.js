import { pulseElement, scrollReveal } from '../vendors';

const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const initContactPage = () => {
	const template = document.body.dataset.template;

	// Bail early when we're on a different template to avoid touching unrelated forms.
	if (template !== 'page-contact') {
		return;
	}

	const form = document.querySelector('.contact-form');

	if (!form) {
		return;
	}

	scrollReveal(form, { trigger: form, start: 'top 85%' });

	const emailInput = form.querySelector('.js-contact-email');
	const errorLabel = form.querySelector('.field__error');
	const submitButton = form.querySelector('.js-contact-submit');

	form.addEventListener('submit', (event) => {
		let isValid = true;

		if (emailInput && !emailPattern.test(emailInput.value)) {
			isValid = false;
			errorLabel?.removeAttribute('hidden');
			emailInput?.setAttribute('aria-invalid', 'true');
		}

		if (!isValid) {
			event.preventDefault();
			pulseElement(submitButton);
		}
	});

	emailInput?.addEventListener('input', () => {
		if (emailPattern.test(emailInput.value)) {
			errorLabel?.setAttribute('hidden', 'hidden');
			emailInput.removeAttribute('aria-invalid');
		}
	});
};

export default initContactPage;
