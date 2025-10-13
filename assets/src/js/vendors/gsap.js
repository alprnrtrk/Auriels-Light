import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

let scrollTriggerRegistered = false;

const ensureScrollTrigger = () => {
	if (!scrollTriggerRegistered) {
		gsap.registerPlugin(ScrollTrigger);
		scrollTriggerRegistered = true;
	}
};

/**
 * Fade elements upward with a small stagger.
 *
 * @param {Element[]|NodeList|Element} targets
 * @param {object} options
 */
export const fadeInElements = (targets, options = {}) => {
	if (!targets) {
		return;
	}

	const items = targets instanceof Element ? [targets] : Array.from(targets);

	if (!items.length) {
		return;
	}

	gsap.fromTo(
		items,
		{ autoAlpha: 0, y: 24 },
		{
			autoAlpha: 1,
			y: 0,
			duration: 0.6,
			ease: 'power2.out',
			stagger: 0.08,
			...options,
		}
	);
};

/**
 * Quick pulse animation for CTA buttons.
 *
 * @param {Element} element
 */
export const pulseElement = (element) => {
	if (!element) {
		return;
	}

	gsap.fromTo(
		element,
		{ scale: 1 },
		{
			scale: 1.05,
			duration: 0.25,
			yoyo: true,
			repeat: 1,
			ease: 'power1.inOut',
		}
	);
};

/**
 * Create a ScrollTrigger-powered reveal animation.
 *
 * @param {Element[]|NodeList|Element} targets
 * @param {object} config
 */
export const scrollReveal = (targets, config = {}) => {
	if (!targets) {
		return;
	}

	const items = targets instanceof Element ? [targets] : Array.from(targets);

	if (!items.length) {
		return;
	}

	ensureScrollTrigger();

	const {
		fromVars = {},
		toVars = {},
		trigger = null,
		start = 'top 80%',
		once = true,
		stagger = 0.16,
		duration = 0.7,
		ease = 'power2.out',
		scrollTrigger = {},
	} = config;

	const resolvedTrigger =
		trigger || (items.length === 1 ? items[0] : items[0].closest('[data-partial]') || items[0]);

	gsap.fromTo(
		items,
		{ autoAlpha: 0, y: 48, ...fromVars },
		{
			autoAlpha: 1,
			y: 0,
			duration,
			ease,
			stagger,
			...toVars,
			scrollTrigger: {
				trigger: resolvedTrigger,
				start,
				once,
				toggleActions: once ? 'play none none none' : 'play reverse play reverse',
				...scrollTrigger,
			},
		}
	);
};

export { gsap };
