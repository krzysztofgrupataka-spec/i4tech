<?php

namespace App;

add_action('wp_head', __NAMESPACE__ . '\\render_favicon_links', 1);
add_action('admin_head', __NAMESPACE__ . '\\render_favicon_links', 1);
add_action('login_head', __NAMESPACE__ . '\\render_favicon_links', 1);

function render_favicon_links(): void
{
    if (has_site_icon() && ! has_generated_favicon_set()) {
        return;
    }

    if (has_generated_favicon_set()) {
        render_generated_favicon_set();

        return;
    }

    $base = trailingslashit(get_theme_file_uri('public/favicons'));
    printf(
        '<link rel="icon" href="%s" type="image/svg+xml">' . "\n",
        esc_url($base . 'favicon.svg')
    );
    printf(
        '<link rel="manifest" href="%s">' . "\n",
        esc_url($base . 'site.webmanifest')
    );
    echo '<meta name="theme-color" content="#0f3d5e">' . "\n";
}

function has_generated_favicon_set(): bool
{
    return file_exists(get_theme_file_path('public/favicons/favicon.ico'))
        || file_exists(get_theme_file_path('public/favicons/favicon-32x32.png'))
        || file_exists(get_theme_file_path('public/favicons/apple-icon-180x180.png'));
}

function render_generated_favicon_set(): void
{
    $png_icons = [
        ['favicon-16x16.png', '16x16'],
        ['favicon-32x32.png', '32x32'],
        ['favicon-96x96.png', '96x96'],
        ['android-icon-192x192.png', '192x192'],
    ];

    $apple_icons = [
        ['apple-icon-57x57.png', '57x57'],
        ['apple-icon-60x60.png', '60x60'],
        ['apple-icon-72x72.png', '72x72'],
        ['apple-icon-76x76.png', '76x76'],
        ['apple-icon-114x114.png', '114x114'],
        ['apple-icon-120x120.png', '120x120'],
        ['apple-icon-144x144.png', '144x144'],
        ['apple-icon-152x152.png', '152x152'],
        ['apple-icon-180x180.png', '180x180'],
        ['apple-icon-precomposed.png', null],
        ['apple-icon.png', null],
    ];

    foreach ($apple_icons as [$file, $sizes]) {
        if (! favicon_file_exists($file)) {
            continue;
        }

        printf(
            '<link rel="apple-touch-icon"%s href="%s">' . "\n",
            $sizes ? ' sizes="' . esc_attr($sizes) . '"' : '',
            esc_url(favicon_uri($file))
        );
    }

    foreach ($png_icons as [$file, $sizes]) {
        if (! favicon_file_exists($file)) {
            continue;
        }

        printf(
            '<link rel="icon" type="image/png" sizes="%s" href="%s">' . "\n",
            esc_attr($sizes),
            esc_url(favicon_uri($file))
        );
    }

    if (favicon_file_exists('favicon.ico')) {
        printf(
            '<link rel="shortcut icon" href="%s" type="image/x-icon">' . "\n",
            esc_url(favicon_uri('favicon.ico'))
        );
        printf(
            '<link rel="icon" href="%s" type="image/x-icon">' . "\n",
            esc_url(favicon_uri('favicon.ico'))
        );
    }

    if (favicon_file_exists('manifest.json')) {
        printf(
            '<link rel="manifest" href="%s">' . "\n",
            esc_url(favicon_uri('manifest.json'))
        );
    }

    if (favicon_file_exists('browserconfig.xml')) {
        printf(
            '<meta name="msapplication-config" content="%s">' . "\n",
            esc_url(favicon_uri('browserconfig.xml'))
        );
    }

    if (favicon_file_exists('ms-icon-144x144.png')) {
        printf(
            '<meta name="msapplication-TileImage" content="%s">' . "\n",
            esc_url(favicon_uri('ms-icon-144x144.png'))
        );
    }

    echo '<meta name="msapplication-TileColor" content="#ffffff">' . "\n";
    echo '<meta name="theme-color" content="#ffffff">' . "\n";
}

function favicon_file_exists(string $file): bool
{
    return file_exists(get_theme_file_path('public/favicons/' . $file));
}

function favicon_uri(string $file): string
{
    return trailingslashit(get_theme_file_uri('public/favicons')) . ltrim($file, '/');
}
