const selector = '.technology-accordion__item';

const getPanel = (details: HTMLDetailsElement): HTMLElement | null =>
  details.querySelector<HTMLElement>('.technology-accordion__panel');

const finishAnimation = (details: HTMLDetailsElement, panel: HTMLElement): void => {
  details.classList.remove('is-animating', 'is-closing');
  panel.style.height = '';
  panel.style.overflow = '';
};

const afterHeightTransition = (panel: HTMLElement, callback: () => void): void => {
  let didFinish = false;

  const finish = (): void => {
    if (didFinish) {
      return;
    }

    didFinish = true;
    panel.removeEventListener('transitionend', onTransitionEnd);
    callback();
  };

  const onTransitionEnd = (event: TransitionEvent): void => {
    if (event.propertyName !== 'height' && event.propertyName !== 'block-size') {
      return;
    }

    finish();
  };

  panel.addEventListener('transitionend', onTransitionEnd);
  window.setTimeout(finish, 380);
};

const openDetails = (details: HTMLDetailsElement, panel: HTMLElement): void => {
  details.open = true;
  details.classList.remove('is-closing');
  details.classList.add('is-animating');
  panel.style.overflow = 'hidden';
  panel.style.height = '0px';
  void panel.offsetHeight;

  requestAnimationFrame(() => {
    panel.style.height = `${panel.scrollHeight}px`;
  });

  afterHeightTransition(panel, () => finishAnimation(details, panel));
};

const closeDetails = (details: HTMLDetailsElement, panel: HTMLElement): void => {
  details.classList.add('is-animating', 'is-closing');
  panel.style.overflow = 'hidden';
  panel.style.height = `${panel.scrollHeight}px`;
  void panel.offsetHeight;

  requestAnimationFrame(() => {
    panel.style.height = '0px';
  });

  afterHeightTransition(panel, () => {
    details.open = false;
    finishAnimation(details, panel);
  });
};

const closeSiblingItems = (details: HTMLDetailsElement): void => {
  const block = details.closest('.technology-accordion');

  if (!block) {
    return;
  }

  block.querySelectorAll<HTMLDetailsElement>(selector).forEach((item) => {
    if (item === details || !item.open || item.classList.contains('is-animating')) {
      return;
    }

    const panel = getPanel(item);

    if (panel) {
      closeDetails(item, panel);
    }
  });
};

const bindItem = (details: HTMLDetailsElement): void => {
  if (details.dataset.technologyAccordionBound === 'true') {
    return;
  }

  const summary = details.querySelector('summary');
  const panel = getPanel(details);

  if (!summary || !panel) {
    return;
  }

  details.dataset.technologyAccordionBound = 'true';

  summary.addEventListener('click', (event) => {
    event.preventDefault();

    if (details.classList.contains('is-animating')) {
      return;
    }

    if (details.open) {
      closeDetails(details, panel);
    } else {
      closeSiblingItems(details);
      openDetails(details, panel);
    }
  });
};

export const initHomepageTechnologies = (): void => {
  document.querySelectorAll<HTMLDetailsElement>(selector).forEach(bindItem);

  const observer = new MutationObserver(() => {
    document.querySelectorAll<HTMLDetailsElement>(selector).forEach(bindItem);
  });

  observer.observe(document.body, {
    childList: true,
    subtree: true,
  });
};
