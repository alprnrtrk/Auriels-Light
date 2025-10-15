(() => {
  const container = document.querySelector('.auriel-hero-slides');
  if (!container) {
    return;
  }

  const list = container.querySelector('[data-auriel-hero-slides-list]');
  const addButton = container.querySelector('[data-auriel-hero-slide-add]');
  const template = document.getElementById('auriel-hero-slide-template');

  if (!list || !addButton || !template) {
    return;
  }

  const placeholderMarkup = (previewWrapper) => {
    const text = previewWrapper.getAttribute('data-placeholder-text') || 'No image selected';
    return `<div class="auriel-hero-slide-card__image-placeholder">${text}</div>`;
  };

  const updateFieldNames = () => {
    const slides = list.querySelectorAll('[data-auriel-hero-slide]');
    slides.forEach((slide, index) => {
      slide.setAttribute('data-index', String(index));
      const fields = slide.querySelectorAll('input[name], textarea[name]');
      fields.forEach((field) => {
        const name = field.getAttribute('name');
        if (!name) {
          return;
        }
        const updated = name.replace(/\[(?:__index__|\d+)\]/, `[${index}]`);
        field.setAttribute('name', updated);
      });
    });
  };

  const addSlide = () => {
    const fragment = template.content.cloneNode(true);
    const slide = fragment.querySelector('[data-auriel-hero-slide]');
    if (!slide) {
      return;
    }
    list.appendChild(slide);
    updateFieldNames();
  };

  const moveSlide = (slide, direction) => {
    const sibling = direction < 0 ? slide.previousElementSibling : slide.nextElementSibling;
    if (!sibling) {
      return;
    }
    if (direction < 0) {
      list.insertBefore(slide, sibling);
    } else {
      list.insertBefore(sibling, slide);
    }
    updateFieldNames();
  };

  const removeSlide = (slide) => {
    slide.remove();
    updateFieldNames();
  };

  const setImage = (slide, attachment) => {
    const previewWrapper = slide.querySelector('[data-auriel-hero-slide-image-preview]');
    const input = slide.querySelector('[data-auriel-hero-slide-image-id]');
    if (!previewWrapper || !input) {
      return;
    }
    const imageMarkup = `<img src="${attachment.url}" alt="${attachment.alt || ''}" class="auriel-hero-slide-card__image-preview" />`;
    previewWrapper.innerHTML = imageMarkup;
    input.value = attachment.id;
  };

  const clearImage = (slide) => {
    const previewWrapper = slide.querySelector('[data-auriel-hero-slide-image-preview]');
    const input = slide.querySelector('[data-auriel-hero-slide-image-id]');
    if (!previewWrapper || !input) {
      return;
    }
    previewWrapper.innerHTML = placeholderMarkup(previewWrapper);
    input.value = '';
  };

  addButton.addEventListener('click', (event) => {
    event.preventDefault();
    addSlide();
  });

  list.addEventListener('click', (event) => {
    const target = event.target;
    if (!(target instanceof HTMLElement)) {
      return;
    }
    const slide = target.closest('[data-auriel-hero-slide]');
    if (!slide) {
      return;
    }

    if (target.matches('[data-auriel-hero-slide-remove]')) {
      event.preventDefault();
      removeSlide(slide);
      return;
    }

    if (target.matches('[data-auriel-hero-slide-move-up]')) {
      event.preventDefault();
      moveSlide(slide, -1);
      return;
    }

    if (target.matches('[data-auriel-hero-slide-move-down]')) {
      event.preventDefault();
      moveSlide(slide, 1);
      return;
    }

    if (target.matches('[data-auriel-hero-slide-select-image]')) {
      event.preventDefault();
      const frame = wp.media({
        title: 'Select slide image',
        multiple: false,
        library: {
          type: ['image'],
        },
      });

      frame.on('select', () => {
        const attachment = frame.state().get('selection').first().toJSON();
        setImage(slide, attachment);
      });

      frame.open();
      return;
    }

    if (target.matches('[data-auriel-hero-slide-clear-image]')) {
      event.preventDefault();
      clearImage(slide);
    }
  });
  updateFieldNames();
})();
