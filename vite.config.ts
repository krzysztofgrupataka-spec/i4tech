import { defineConfig } from 'vite';
import type { Plugin } from 'vite';
import react from '@vitejs/plugin-react';
import { wordpressPlugin } from '@roots/vite-plugin';
import { rmSync, writeFileSync } from 'node:fs';

const blockEntries = [
  'resources/blocks/hero/edit.tsx',
  'resources/blocks/cta/edit.tsx',
  'resources/blocks/section/edit.tsx',
  'resources/blocks/cards/edit.tsx',
  'resources/blocks/faq/edit.tsx',
  'resources/blocks/hero/style.scss',
  'resources/blocks/hero-section/style.scss',
  'resources/blocks/hero-text/style.scss',
  'resources/blocks/highlighted-text/style.scss',
  'resources/blocks/solutions-grid/style.scss',
  'resources/blocks/selected-solutions/style.scss',
  'resources/blocks/selected-files/style.scss',
  'resources/blocks/solution-cta/style.scss',
  'resources/blocks/cta/style.scss',
  'resources/blocks/section/style.scss',
  'resources/blocks/cards/style.scss',
  'resources/blocks/faq/style.scss',
  'resources/blocks/full-width-video/style.scss',
  'resources/blocks/homepage-technologies/style.scss',
  'resources/blocks/linked-technologies/style.scss',
  'resources/blocks/image-text-column/style.scss',
  'resources/blocks/text-columns/style.scss',
  'resources/blocks/text-tiles-elements/style.scss',
  'resources/blocks/elements-text-image/style.scss',
  'resources/blocks/opinions-elements/style.scss',
  'resources/blocks/standard-and-procedures/style.scss',
  'resources/blocks/image-hero/style.scss',
  'resources/blocks/contact-form-section/style.scss',
  'resources/blocks/contact-page/style.scss',
  'resources/blocks/blog-table/style.scss',
  'resources/blocks/case-study-hero/style.scss',
  'resources/blocks/case-study-efects/style.scss',
  'resources/blocks/materials-form-section/style.scss',
  'resources/blocks/selected-case-studies/style.scss',
  'resources/blocks/selected-blog-posts/style.scss',
  'resources/blocks/selected-sectores/style.scss',
  'resources/blocks/hero/editor.scss',
  'resources/blocks/cta/editor.scss',
  'resources/blocks/section/editor.scss',
  'resources/blocks/cards/editor.scss',
  'resources/blocks/faq/editor.scss',
];

export default defineConfig(({ mode }) => ({
  base: mode === 'production' ? '/wp-content/themes/i4tech/public/build/' : '/',
  publicDir: false,
  build: {
    manifest: true,
    outDir: 'public/build',
    emptyOutDir: true,
    sourcemap: mode !== 'production',
    cssMinify: 'lightningcss',
    rollupOptions: {
      input: [
        'resources/scripts/app.ts',
        'resources/scripts/editor.ts',
        'resources/styles/app.scss',
        'resources/styles/editor.scss',
        ...blockEntries,
      ],
      output: {
        chunkFileNames: 'assets/[name]-[hash].js',
        entryFileNames: 'assets/[name]-[hash].js',
        assetFileNames: 'assets/[name]-[hash][extname]',
      },
    },
    target: 'es2022',
  },
  css: {
    devSourcemap: true,
    transformer: 'lightningcss',
  },
  plugins: [
    react(),
    wordpressPlugin(),
    viteHotFile(),
  ],
  server: {
    strictPort: false,
    cors: true,
  },
}));

function viteHotFile(): Plugin {
  const hotFile = 'public/hot';

  return {
    name: 'i4tech-vite-hot-file',
    configureServer(server) {
      const protocol = server.config.server.https ? 'https' : 'http';
      const host = server.config.server.host === '0.0.0.0' ? 'localhost' : server.config.server.host;
      const port = server.config.server.port ?? 5173;

      writeFileSync(hotFile, `${protocol}://${host || 'localhost'}:${port}`);

      server.httpServer?.once('close', () => {
        rmSync(hotFile, { force: true });
      });
    },
  };
}
