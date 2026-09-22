<?php

/**
 * Theme bootstrap.
 */

use Roots\Acorn\Application;

if (! file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(
        esc_html__('Composer dependencies are missing. Run `composer install` in the theme directory.', 'i4tech'),
        esc_html__('Theme dependencies missing', 'i4tech')
    );
}

require $composer;

Application::configure()
    ->withProviders([
        App\Providers\ThemeServiceProvider::class,
    ])
    ->boot();

collect(['setup', 'filters', 'helpers', 'favicon', 'post-types', 'theme-options', 'acf'])
    ->each(static function (string $file): void {
        $path = __DIR__ . "/app/{$file}.php";

        if (file_exists($path)) {
            require_once $path;
        }
    });
