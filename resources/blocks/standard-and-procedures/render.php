<?php

$heading = function_exists('get_field') ? trim((string) get_field('standard_and_procedures_heading')) : '';
$highlighted_text = function_exists('get_field') ? trim((string) get_field('standard_and_procedures_highlighted_text')) : '';
$text = function_exists('get_field') ? trim((string) get_field('standard_and_procedures_text')) : '';
$raw_files = function_exists('get_field') ? get_field('standard_and_procedures_files') : [];
$files = [];

foreach (is_array($raw_files) ? $raw_files : [] as $raw_item) {
    if (! is_array($raw_item)) {
        continue;
    }

    $file = $raw_item['file'] ?? [];
    $file_id = is_array($file) ? absint($file['ID'] ?? $file['id'] ?? 0) : absint($file);
    $url = is_array($file) ? trim((string) ($file['url'] ?? '')) : '';
    $url = $url !== '' ? $url : ($file_id ? (string) wp_get_attachment_url($file_id) : '');
    $label = trim((string) ($raw_item['label'] ?? ''));
    $label = $label !== '' ? $label : (is_array($file) ? trim((string) ($file['title'] ?? '')) : '');
    $label = $label !== '' ? $label : ($file_id ? trim((string) get_the_title($file_id)) : '');

    if ($label === '' && $url !== '') {
        $label = wp_basename((string) wp_parse_url($url, PHP_URL_PATH));
    }

    if ($url !== '' && $label !== '') {
        $files[] = [
            'url' => esc_url_raw($url),
            'label' => $label,
        ];
    }
}

$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'standard-and-procedures-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['standard-and-procedures-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $highlighted_text && ! $text && ! $files) {
    if ($is_preview) {
        echo '<p class="standard-and-procedures-block__placeholder">' . esc_html__('Uzupełnij treść i dodaj pliki.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.standard-and-procedures', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'highlightedText' => $highlighted_text,
    'text' => $text,
    'files' => $files,
])->render();
