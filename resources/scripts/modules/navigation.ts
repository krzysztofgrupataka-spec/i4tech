export const initNavigation = (): void => {
  const header = document.querySelector<HTMLElement>('[data-site-header]');
  const toggle = document.querySelector<HTMLButtonElement>('[data-nav-toggle]');
  const navigation = document.querySelector<HTMLElement>('[data-nav]');
  const submenuToggles = Array.from(
    document.querySelectorAll<HTMLButtonElement>('[data-submenu-toggle]'),
  );

  if (!toggle || !navigation) {
    return;
  }

  const updateHeaderState = (): void => {
    header?.classList.toggle('is-scrolled', window.scrollY > 8);
  };

  updateHeaderState();
  window.addEventListener('scroll', updateHeaderState, { passive: true });

  const updateMegaMenuState = (): void => {
    const hasOpenMegaMenu = submenuToggles.some((submenuToggle) => (
      submenuToggle.closest('.site-header__item')?.classList.contains('is-open') ?? false
    ));

    header?.classList.toggle('is-mega-open', hasOpenMegaMenu);
  };

  const closeSubmenus = (except?: HTMLElement): void => {
    submenuToggles.forEach((submenuToggle) => {
      const item = submenuToggle.closest<HTMLElement>('.site-header__item');

      if (!item || item === except) {
        return;
      }

      item.classList.remove('is-open');
      submenuToggle.setAttribute('aria-expanded', 'false');

      if (document.activeElement === submenuToggle) {
        submenuToggle.blur();
      }
    });
  };

  const setOpen = (isOpen: boolean): void => {
    toggle.setAttribute('aria-expanded', String(isOpen));
    navigation.classList.toggle('is-open', isOpen);
    header?.classList.toggle('is-nav-open', isOpen);
    document.body.classList.toggle('is-mobile-nav-open', isOpen);

    if (!isOpen) {
      closeSubmenus();
      updateMegaMenuState();
      toggle.blur();
    }
  };

  toggle.addEventListener('click', () => {
    setOpen(toggle.getAttribute('aria-expanded') !== 'true');
  });

  submenuToggles.forEach((submenuToggle) => {
    submenuToggle.addEventListener('click', () => {
      const item = submenuToggle.closest<HTMLElement>('.site-header__item');

      if (!item) {
        return;
      }

      const isOpen = !item.classList.contains('is-open');
      const isSwitchingMegaMenu = isOpen && submenuToggles.some((otherToggle) => {
        const otherItem = otherToggle.closest<HTMLElement>('.site-header__item');
        return otherItem !== item && (otherItem?.classList.contains('is-open') ?? false);
      });

      if (isSwitchingMegaMenu) {
        header?.classList.add('is-switching-mega');
      }

      closeSubmenus(item);
      item.classList.toggle('is-open', isOpen);
      submenuToggle.setAttribute('aria-expanded', String(isOpen));
      updateMegaMenuState();

      if (isSwitchingMegaMenu) {
        window.requestAnimationFrame(() => {
          window.requestAnimationFrame(() => header?.classList.remove('is-switching-mega'));
        });
      }
    });
  });

  document.addEventListener('click', (event) => {
    const target = event.target;

    if (!(target instanceof Node)) {
      return;
    }

    if (!navigation.contains(target) && !toggle.contains(target)) {
      setOpen(false);
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      setOpen(false);
    }
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024 && toggle.getAttribute('aria-expanded') === 'true') {
      setOpen(false);
    }
  });
};
