<?php

$image_id = function_exists('get_field') ? absint(get_field('image_hero_image') ?: 0) : 0;
$heading = function_exists('get_field') ? (string) get_field('image_hero_heading') : '';
$text = function_exists('get_field') ? (string) get_field('image_hero_text') : '';
$alignment_value = function_exists('get_field') ? (string) get_field('image_hero_alignment') : 'left';
$alignment = in_array($alignment_value, ['left', 'center'], true) ? $alignment_value : 'left';
$primary_button = function_exists('get_field') ? get_field('image_hero_primary_button') : [];
$secondary_button = function_exists('get_field') ? get_field('image_hero_secondary_button') : [];
$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';

$normalize_button = static function ($button): array {
    if (! is_array($button)) {
        return ['label' => '', 'url' => '', 'target' => ''];
    }

    return [
        'label' => sanitize_text_field($button['title'] ?? ''),
        'url' => esc_url_raw($button['url'] ?? ''),
        'target' => sanitize_key($button['target'] ?? ''),
    ];
};

$primary = $normalize_button($primary_button);
$secondary = $normalize_button($secondary_button);
$breadcrumb_data = \App\hierarchical_breadcrumbs();

if (! $image_url && ! $heading && ! $text && ! ($primary['label'] && $primary['url']) && ! ($secondary['label'] && $secondary['url'])) {
    return;
}

echo view('blocks.image-hero', [
    'imageUrl' => $image_url,
    'heading' => $heading,
    'text' => $text,
    'alignment' => $alignment,
    'primary' => $primary,
    'secondary' => $secondary,
    'breadcrumbs' => $breadcrumb_data['items'],
    'breadcrumbSchema' => $breadcrumb_data['schema'],
])->render();
