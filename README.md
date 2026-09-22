# i4tech Sage WordPress Theme

Production-oriented WordPress starter theme based on Roots Sage ideas, Acorn, Laravel Blade, Vite, TypeScript and SCSS. It is intentionally framework-light: no Tailwind, no page builder, no custom CSS framework.

## Requirements

- WordPress 6.6+
- PHP 8.3+
- Composer 2+
- Node.js 22+
- npm 10+
- A local WordPress environment such as Local, DDEV, Lando or Valet

## Install

```bash
composer install
npm install
```

Activate the theme in WordPress, then save permalinks once.

## Development

```bash
npm run dev
```

Vite writes `public/hot` and serves assets with HMR. WordPress enqueues source entrypoints during development and hashed files from `public/build` in production.

## Production Build

```bash
npm run build
```

The build emits:

- hashed JavaScript and CSS assets;
- a Vite manifest for cache busting;
- minified CSS via Lightning CSS;
- source maps outside production mode.

Commit source files, not `node_modules`, `vendor` or `public/build` unless your deployment process requires built assets.

## Project Structure

```txt
app/
  Blocks/
  Providers/
  View/Composers/
config/
public/
resources/
  blocks/
  fonts/
  icons/
  scripts/
  styles/
  views/
```

## Blade

Templates live in `resources/views`. Shared components live in `resources/views/components`:

- `button`
- `container`
- `picture`
- `header`
- `footer`
- `section`

Use components from Blade:

```blade
<x-container size="narrow">
  <x-button href="/contact">Contact</x-button>
</x-container>
```

Global template data is provided by `app/View/Composers/App.php`.

## CSS Architecture

Styles use SCSS with design tokens exposed as CSS Custom Properties:

```txt
resources/styles/
  settings/
  tools/
  generic/
  elements/
  objects/
  components/
  blocks/
  utilities/
```

SCSS is used for organization, mixins and small helpers. Prefer CSS variables and native CSS features for runtime theming.

## TypeScript

TypeScript is strict by default. Entrypoints:

- `resources/scripts/app.ts`
- `resources/scripts/editor.ts`
- block editor entrypoints in `resources/blocks/*/edit.tsx`

Use dynamic imports for large optional interactions that are not needed on every page.

## Gutenberg Blocks

Blocks live in `resources/blocks`. Included examples:

- Hero
- CTA
- Section
- Cards
- FAQ

Each block contains:

```txt
block.json
edit.tsx
save.tsx
style.scss
editor.scss
render.php
```

Blocks are registered automatically by `App\Blocks\BlockRegistrar`.

Create a new block:

```bash
npm run new:block -- testimonial
```

Then add its assets to the `blockEntries` array in `vite.config.ts`.

## Fonts

Fonts are self-hosted. Place font files in:

```txt
resources/fonts/<family>/
```

The starter expects:

```txt
resources/fonts/inter/InterVariable.woff2
```

Recommended workflow:

1. Download licensed `.woff2` files.
2. Add `@font-face` definitions in `resources/styles/settings/_fonts.scss`.
3. Use `font-display: swap`.
4. Add matching families to `theme.json`.
5. Preload only critical fonts from WordPress when the font is present and used above the fold.

## Images

Use the `picture` Blade component for responsive images:

```blade
<x-picture :id="$imageId" size="content-wide" sizes="(min-width: 80rem) 72rem, 100vw" />
```

The component uses WordPress image markup, so it benefits from:

- `srcset`
- `sizes`
- lazy loading
- `decoding="async"`
- registered image sizes
- WebP/AVIF when supported by the server and WordPress media stack

## Favicons

The optimal default path is the native WordPress Site Icon:

1. Go to Appearance -> Customize -> Site Identity.
2. Upload a square 512 x 512 PNG, WebP or JPEG.
3. Let WordPress generate the required icon sizes for frontend, admin and mobile contexts.

For projects that require explicit favicon variants, generate a full package at https://www.favicon-generator.org/ and place the output files in `public/favicons`. Keep the generator filenames unchanged, for example:

- `favicon.ico`
- `favicon-16x16.png`
- `favicon-32x32.png`
- `favicon-96x96.png`
- `android-icon-192x192.png`
- `apple-icon-180x180.png`
- `ms-icon-144x144.png`
- `manifest.json`
- `browserconfig.xml`

The theme detects this package automatically and prints only tags for files that exist. If no generated favicon package is present, it falls back to the lightweight `favicon.svg` and `site.webmanifest`. If WordPress Site Icon is configured and no generated package exists, WordPress handles the tags to avoid duplicates.

## Quality Commands

```bash
npm run lint
npm run lint:ts
npm run lint:styles
composer lint:php
composer stan
```

Configured tools:

- ESLint
- Stylelint
- Prettier
- PHP_CodeSniffer
- WordPress Coding Standards
- PHPStan
- EditorConfig

## Accessibility and SEO

The theme provides semantic landmarks, skip links, keyboard-friendly navigation, visible focus states and accessible block patterns. It does not implement custom SEO logic. Use Yoast SEO, Rank Math or another dedicated plugin for metadata, schema and XML sitemaps.

## Deployment

A typical deployment pipeline:

1. Install PHP dependencies with optimized autoloading.
2. Install Node dependencies with `npm ci`.
3. Run linting and static analysis.
4. Run `npm run build`.
5. Deploy the theme without development-only files if your host requires a lean artifact.

GitHub Actions in `.github/workflows/ci.yml` covers linting, PHPStan and the production build.
