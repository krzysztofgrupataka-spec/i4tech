<?php

$image_id = function_exists('get_field') ? absint(get_field('hero_section_image') ?: 0) : 0;
$variant_value = function_exists('get_field') ? (string) get_field('hero_section_variant') : 'default';
$variant = 'centered' === $variant_value ? 'centered' : 'default';
$heading = function_exists('get_field') ? (string) get_field('hero_section_heading') : '';
$text = function_exists('get_field') ? (string) get_field('hero_section_text') : '';
$button = function_exists('get_field') ? get_field('hero_section_button') : [];

$button_label = is_array($button) ? sanitize_text_field($button['label'] ?? '') : '';
$button_url = is_array($button) ? esc_url_raw($button['url'] ?? '') : '';
$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';
$block_attributes = isset($block) && is_array($block) ? $block : [];
$breadcrumb_data = \App\hierarchical_breadcrumbs();

if (! $image_url && ! $heading && ! $text && ! ($button_label && $button_url)) {
    return;
}

echo view('blocks.hero-section', [
    'attributes' => $block_attributes,
    'imageUrl' => $image_url,
    'variant' => $variant,
    'heading' => $heading,
    'text' => $text,
    'buttonLabel' => $button_label,
    'buttonUrl' => $button_url,
    'breadcrumbs' => $breadcrumb_data['items'],
    'breadcrumbSchema' => $breadcrumb_data['schema'],
])->render();
