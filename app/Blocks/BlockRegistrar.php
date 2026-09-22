<?php

namespace App\Blocks;

use DirectoryIterator;

use function App\enqueue_asset;

class BlockRegistrar
{
    public static function registerAll(): void
    {
        $base = get_theme_file_path('resources/blocks');

        if (! is_dir($base)) {
            return;
        }

        foreach (new DirectoryIterator($base) as $block) {
            if ($block->isDot() || ! $block->isDir()) {
                continue;
            }

            $path = $block->getPathname();

            if (! file_exists($path . '/block.json')) {
                continue;
            }

            if (self::isAcfBlock($path)) {
                register_block_type($path);
            } else {
                register_block_type($path, [
                    'render_callback' => static fn (array $attributes, string $content, \WP_Block $instance): string => self::render(
                        $path,
                        $attributes,
                        $content,
                        $instance
                    ),
                ]);
            }

            self::enqueueBlockAssets($block->getBasename());
        }
    }

    private static function isAcfBlock(string $path): bool
    {
        $metadata = json_decode((string) file_get_contents($path . '/block.json'), true);

        return is_array($metadata) && isset($metadata['acf']) && is_array($metadata['acf']);
    }

    private static function render(string $path, array $attributes, string $content, \WP_Block $block): string
    {
        $template = $path . '/render.php';

        if (! file_exists($template)) {
            return $content;
        }

        ob_start();

        include $template;

        return (string) ob_get_clean();
    }

    private static function enqueueBlockAssets(string $name): void
    {
        add_action('enqueue_block_assets', static function () use ($name): void {
            if (file_exists(get_theme_file_path("resources/blocks/{$name}/style.scss"))) {
                enqueue_asset("resources/blocks/{$name}/style.scss");
            }
        });

        add_action('enqueue_block_editor_assets', static function () use ($name): void {
            if (file_exists(get_theme_file_path("resources/blocks/{$name}/editor.scss"))) {
                enqueue_asset("resources/blocks/{$name}/editor.scss");
            }

            if (file_exists(get_theme_file_path("resources/blocks/{$name}/edit.tsx"))) {
                enqueue_asset("resources/blocks/{$name}/edit.tsx", [
                    'wp-blocks',
                    'wp-block-editor',
                    'wp-components',
                    'wp-element',
                    'wp-i18n',
                ]);
            }
        });
    }
}
