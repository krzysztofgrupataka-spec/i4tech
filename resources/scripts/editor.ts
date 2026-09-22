import '../styles/editor.scss';
import { initHomepageTechnologies } from './modules/homepage-technologies';
import { initOpinionsSliders } from './modules/opinions-slider';

const editorReady = (): void => {
  document.body.classList.add('is-editor-ready');
  initHomepageTechnologies();
  initOpinionsSliders();
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', editorReady, { once: true });
} else {
  editorReady();
}
