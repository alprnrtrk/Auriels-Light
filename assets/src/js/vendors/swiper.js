import Swiper from 'swiper';
import { Navigation, Pagination, EffectCoverflow } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow';

const resolveElement = (target) => {
	if (target instanceof HTMLElement) {
		return target;
	}

	if (typeof target === 'string') {
		return document.querySelector(target);
	}

	return null;
};

/**
 * Initialise a Swiper instance with navigation and pagination enabled.
 *
 * @param {string|HTMLElement} target
 * @param {object} config
 * @returns {Swiper|null}
 */
export const createFeatureSlider = (target, config = {}) => {
	const element = resolveElement(target);

	if (!element) {
		return null;
	}

	return new Swiper(
		element,
		{
			modules: [Navigation, Pagination, EffectCoverflow],
			loop: true,
			centeredSlides: true,
			slidesPerView: 'auto',
			spaceBetween: 36,
			observer: true,
			observeParents: true,
			effect: 'coverflow',
			coverflowEffect: {
				rotate: 32,
				stretch: 0,
				depth: 200,
				modifier: 1,
				slideShadows: true,
			},
			pagination: {
				el: element.querySelector('.swiper-pagination'),
				clickable: true,
			},
			navigation: {
				nextEl: element.parentElement?.querySelector('.swiper-button-next') ?? null,
				prevEl: element.parentElement?.querySelector('.swiper-button-prev') ?? null,
			},
			...config,
		}
	);
};

export { Swiper };
