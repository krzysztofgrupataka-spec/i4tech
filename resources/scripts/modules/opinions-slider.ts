const initializedSliders = new WeakSet<HTMLElement>();

const getPerPage = (): number => {
  if (window.matchMedia('(max-width: 39.999rem)').matches) {
    return 1;
  }

  if (window.matchMedia('(max-width: 63.999rem)').matches) {
    return 2;
  }

  return 3;
};

const initSlider = (slider: HTMLElement): void => {
  if (initializedSliders.has(slider)) {
    return;
  }

  const viewport = slider.querySelector<HTMLElement>('[data-opinions-viewport]');
  const pagination = slider.querySelector<HTMLElement>('[data-opinions-pagination]');
  const slides = Array.from(slider.querySelectorAll<HTMLElement>('.opinions-elements-block__item'));

  if (!viewport || !pagination || slides.length === 0) {
    return;
  }

  initializedSliders.add(slider);
  let perPage = getPerPage();
  let pageCount = 1;
  let activePage = 0;
  let scrollFrame = 0;

  const setActivePage = (page: number): void => {
    activePage = Math.max(0, Math.min(page, pageCount - 1));

    pagination.querySelectorAll<HTMLButtonElement>('button').forEach((button, index) => {
      if (index === activePage) {
        button.setAttribute('aria-current', 'true');
      } else {
        button.removeAttribute('aria-current');
      }
    });
  };

  const goToPage = (page: number, smooth = true): void => {
    const targetSlide = slides[Math.min(page * perPage, slides.length - 1)];

    if (!targetSlide) {
      return;
    }

    viewport.scrollTo({
      left: targetSlide.offsetLeft,
      behavior: smooth ? 'smooth' : 'auto',
    });
    setActivePage(page);
  };

  const renderPagination = (): void => {
    perPage = getPerPage();
    pageCount = Math.ceil(slides.length / perPage);
    const interactive = pageCount > 1;

    slider.classList.toggle('is-interactive', interactive);
    pagination.replaceChildren();

    if (!interactive) {
      viewport.scrollTo({ left: 0, behavior: 'auto' });
      activePage = 0;
      return;
    }

    for (let index = 0; index < pageCount; index += 1) {
      const button = document.createElement('button');
      button.type = 'button';
      button.setAttribute('aria-label', `Przejdź do strony ${index + 1} z ${pageCount}`);
      button.addEventListener('click', () => goToPage(index));
      pagination.append(button);
    }

    goToPage(Math.min(activePage, pageCount - 1), false);
  };

  viewport.addEventListener('scroll', () => {
    window.cancelAnimationFrame(scrollFrame);
    scrollFrame = window.requestAnimationFrame(() => {
      const pageOffsets = Array.from({ length: pageCount }, (_, index) => {
        const targetSlide = slides[Math.min(index * perPage, slides.length - 1)];
        return targetSlide?.offsetLeft ?? 0;
      });
      const closestPage = pageOffsets.reduce((closest, offset, index) => (
        Math.abs(offset - viewport.scrollLeft) < Math.abs((pageOffsets[closest] ?? 0) - viewport.scrollLeft) ? index : closest
      ), 0);

      setActivePage(closestPage);
    });
  }, { passive: true });

  const resizeObserver = new ResizeObserver(renderPagination);
  resizeObserver.observe(slider);
  renderPagination();
};

export const initOpinionsSliders = (): void => {
  document.querySelectorAll<HTMLElement>('[data-opinions-slider]').forEach(initSlider);

  const observer = new MutationObserver(() => {
    document.querySelectorAll<HTMLElement>('[data-opinions-slider]').forEach(initSlider);
  });

  observer.observe(document.body, { childList: true, subtree: true });
};
