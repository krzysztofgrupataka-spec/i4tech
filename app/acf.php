<?php

namespace App;

add_filter('acf/fields/wysiwyg/toolbars', function (array $toolbars): array {
    $toolbars['I4tech'] = [
        1 => ['styleselect', 'forecolor', 'bold', 'italic', 'bullist', 'numlist', 'link', 'unlink', 'removeformat', 'undo', 'redo'],
    ];

    return $toolbars;
});

add_filter('tiny_mce_before_init', function (array $settings): array {
    $formats = [];

    if (! empty($settings['style_formats'])) {
        $decoded_formats = json_decode((string) $settings['style_formats'], true);
        $formats = is_array($decoded_formats) ? $decoded_formats : [];
    }

    $formats[] = [
        'title' => __('Wyróżnienie żółte', 'i4tech'),
        'inline' => 'span',
        'classes' => 'text-highlight',
        'wrapper' => false,
    ];
    $formats[] = [
        'title' => __('Biały tekst', 'i4tech'),
        'inline' => 'span',
        'classes' => 'text-white',
        'wrapper' => false,
    ];
    $settings['style_formats'] = wp_json_encode($formats);
    $settings['style_formats_merge'] = true;
    $settings['textcolor_map'] = wp_json_encode([
        'F7BD00', __('Żółty', 'i4tech'),
        '272727', __('Czarny', 'i4tech'),
    ]);
    $text_colors = json_decode((string) $settings['textcolor_map'], true);
    $text_colors = is_array($text_colors) ? $text_colors : [];
    $text_colors[] = 'FFFFFF';
    $text_colors[] = __('Biały', 'i4tech');
    $settings['textcolor_map'] = wp_json_encode($text_colors);
    $settings['custom_colors'] = false;

    return $settings;
});

add_filter('acf/settings/save_json', function (): string {
    return get_theme_file_path('acf-json');
});

add_filter('acf/settings/load_json', function (array $paths): array {
    $themePath = get_theme_file_path('acf-json');

    if (! in_array($themePath, $paths, true)) {
        $paths[] = $themePath;
    }

    return $paths;
});
