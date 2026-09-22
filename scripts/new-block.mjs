import { mkdir, writeFile } from 'node:fs/promises';
import { existsSync } from 'node:fs';
import path from 'node:path';

const slug = process.argv[2];

if (!slug || !/^[a-z0-9-]+$/.test(slug)) {
  console.error('Usage: npm run new:block -- my-block');
  process.exit(1);
}

const title = slug
  .split('-')
  .map((part) => part.charAt(0).toUpperCase() + part.slice(1))
  .join(' ');

const dir = path.join('resources', 'blocks', slug);

if (existsSync(dir)) {
  console.error(`Block already exists: ${dir}`);
  process.exit(1);
}

await mkdir(dir, { recursive: true });

await writeFile(
  path.join(dir, 'block.json'),
  `${JSON.stringify(
    {
      apiVersion: 3,
      name: `i4tech/${slug}`,
      title,
      category: 'design',
      icon: 'layout',
      description: `${title} block.`,
      textdomain: 'i4tech',
      supports: {
        align: ['wide', 'full'],
        anchor: true,
        spacing: {
          margin: true,
          padding: true
        }
      },
      attributes: {
        heading: {
          type: 'string',
          default: title
        }
      }
    },
    null,
    2,
  )}\n`,
);

await writeFile(
  path.join(dir, 'edit.tsx'),
  `import { registerBlockType } from '@wordpress/blocks';\nimport { useBlockProps, RichText } from '@wordpress/block-editor';\nimport metadata from './block.json';\nimport './editor.scss';\n\ntype Attributes = { heading: string };\n\nregisterBlockType<Attributes>(metadata.name, {\n  ...metadata,\n  edit: ({ attributes, setAttributes }) => (\n    <section {...useBlockProps({ className: '${slug}' })}>\n      <RichText\n        tagName=\"h2\"\n        value={attributes.heading}\n        onChange={(heading) => setAttributes({ heading })}\n        placeholder=\"${title} heading\"\n      />\n    </section>\n  ),\n  save: () => null,\n});\n`,
);

await writeFile(path.join(dir, 'save.tsx'), 'export default function save() {\n  return null;\n}\n');
await writeFile(path.join(dir, 'style.scss'), `.${slug} {\n  padding-block: var(--wp--preset--spacing--12, 3rem);\n}\n`);
await writeFile(path.join(dir, 'editor.scss'), `.${slug} {\n  outline: 1px dashed var(--color-border);\n}\n`);
await writeFile(
  path.join(dir, 'render.php'),
  `<?php\n\n$heading = isset($attributes['heading']) ? sanitize_text_field($attributes['heading']) : '';\n?>\n<section <?php echo get_block_wrapper_attributes(['class' => '${slug}']); ?>>\n    <?php if ($heading) : ?>\n        <h2><?php echo esc_html($heading); ?></h2>\n    <?php endif; ?>\n</section>\n`,
);

console.log(`Created ${dir}`);
