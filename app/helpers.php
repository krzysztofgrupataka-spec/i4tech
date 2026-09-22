<?php

namespace App;

use Illuminate\Support\Str;

function asset_path(string $entry): string
{
    if (is_vite_hot()) {
        return vite_dev_server_url($entry);
    }

    $manifest = vite_manifest();

    if (! isset($manifest[$entry]['file'])) {
        return get_theme_file_uri($entry);
    }

    return get_theme_file_uri('public/build/' . $manifest[$entry]['file']);
}

function enqueue_asset(string $entry, array $dependencies = []): void
{
    $handle = 'i4tech/' . sanitize_key(Str::slug($entry));
    $uri = asset_path($entry);

    if (str_ends_with($entry, '.scss') || str_ends_with($uri, '.css')) {
        wp_enqueue_style($handle, $uri, [], theme_asset_version($entry));

        return;
    }

    wp_enqueue_script($handle, $uri, $dependencies, theme_asset_version($entry), true);
}

function vite_manifest(): array
{
    static $manifest = null;

    if (is_array($manifest)) {
        return $manifest;
    }

    $path = get_theme_file_path('public/build/.vite/manifest.json');
    $fallback = get_theme_file_path('public/build/manifest.json');

    if (! file_exists($path) && file_exists($fallback)) {
        $path = $fallback;
    }

    if (! file_exists($path)) {
        return $manifest = [];
    }

    $contents = file_get_contents($path);

    if (! is_string($contents)) {
        return $manifest = [];
    }

    return $manifest = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
}

function is_vite_hot(): bool
{
    return file_exists(get_theme_file_path('public/hot'));
}

function vite_dev_server_url(string $entry): string
{
    $hot = trim((string) file_get_contents(get_theme_file_path('public/hot')));
    $server = $hot !== '' ? $hot : 'http://localhost:5173';

    return trailingslashit($server) . ltrim($entry, '/');
}

function theme_asset_version(string $entry): ?string
{
    if (is_vite_hot()) {
        return null;
    }

    $manifest = vite_manifest();

    return isset($manifest[$entry]['file']) ? null : wp_get_theme()->get('Version');
}

function svg_icon(string $name): string
{
    $path = get_theme_file_path("resources/icons/{$name}.svg");

    if (! file_exists($path)) {
        return '';
    }

    return (string) file_get_contents($path);
}

function hierarchical_breadcrumbs(): array
{
    $current_post_id = get_queried_object_id() ?: get_the_ID();
    $current_post_type = $current_post_id ? get_post_type($current_post_id) : '';
    $items = [];

    if (
        ! $current_post_id
        || ! in_array($current_post_type, ['solution', 'technology'], true)
        || ! wp_get_post_parent_id($current_post_id)
    ) {
        return ['items' => [], 'schema' => []];
    }

    $breadcrumb_ids = array_merge(
        array_reverse(get_post_ancestors($current_post_id)),
        [$current_post_id]
    );

    foreach ($breadcrumb_ids as $breadcrumb_id) {
        $breadcrumb_id = absint($breadcrumb_id);

        if (! $breadcrumb_id) {
            continue;
        }

        $items[] = [
            'title' => get_the_title($breadcrumb_id),
            'url' => get_permalink($breadcrumb_id),
            'current' => $breadcrumb_id === $current_post_id,
        ];
    }

    if (defined('WPSEO_VERSION')) {
        return ['items' => $items, 'schema' => []];
    }

    return [
        'items' => $items,
        'schema' => [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(
                static fn (array $item, int $index): array => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => wp_strip_all_tags($item['title']),
                    'item' => $item['url'],
                ],
                $items,
                array_keys($items)
            ),
        ],
    ];
}
