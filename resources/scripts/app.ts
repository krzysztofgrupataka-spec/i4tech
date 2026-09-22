import '../styles/app.scss';
import { initNavigation } from './modules/navigation';
import { initHomepageTechnologies } from './modules/homepage-technologies';
import { initOpinionsSliders } from './modules/opinions-slider';

const boot = (): void => {
  initNavigation();
  initHomepageTechnologies();
  initOpinionsSliders();
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', boot, { once: true });
} else {
  boot();
}
