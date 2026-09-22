<?php

$heading = function_exists('get_field') ? trim((string) get_field('hero_text_heading')) : '';
$text = function_exists('get_field') ? trim((string) get_field('hero_text_text')) : '';
$cta = function_exists('get_field') ? get_field('hero_text_cta') : [];
$background = function_exists('get_field') ? (string) get_field('hero_text_background') : 'white';
$background = in_array($background, ['white', 'beige', 'yellow', 'dark'], true) ? $background : 'white';
$cta_label = is_array($cta) ? sanitize_text_field($cta['title'] ?? '') : '';
$cta_url = is_array($cta) ? esc_url_raw($cta['url'] ?? '') : '';
$cta_target = is_array($cta) ? sanitize_key($cta['target'] ?? '') : '';
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'hero-text-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['hero-text-block', "hero-text-block--{$background}", 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $text && ! ($cta_label && $cta_url)) {
    if ($is_preview) {
        echo '<p class="hero-text-block__placeholder">' . esc_html__('Uzupełnij nagłówek, tekst lub CTA.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.hero-text', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'text' => $text,
    'ctaLabel' => $cta_label,
    'ctaUrl' => $cta_url,
    'ctaTarget' => $cta_target,
    'background' => $background,
])->render();
