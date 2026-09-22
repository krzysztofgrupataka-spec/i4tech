<?php

$heading = function_exists('get_field') ? trim((string) get_field('selected_files_heading')) : '';
$items = function_exists('get_field') ? get_field('selected_files_items') : [];
$files = is_array($items) ? array_values(array_filter(array_map(
    static function ($item): array {
        $file = is_array($item) ? ($item['file'] ?? []) : [];
        $file_id = is_array($file) ? absint($file['ID'] ?? $file['id'] ?? 0) : absint($file);
        $url = is_array($file) ? (string) ($file['url'] ?? '') : '';
        $url = $url !== '' ? $url : ($file_id ? (string) wp_get_attachment_url($file_id) : '');
        $label = is_array($file) ? trim((string) ($file['title'] ?? '')) : '';
        $label = $label !== '' ? $label : ($file_id ? trim((string) get_the_title($file_id)) : '');

        if ($label === '' && $url) {
            $label = wp_basename((string) wp_parse_url($url, PHP_URL_PATH));
        }

        return [
            'url' => $url ? esc_url_raw($url) : '',
            'label' => $label,
            'action' => is_array($item) && ($item['action'] ?? '') === 'download' ? 'download' : 'open',
        ];
    },
    $items
), static fn (array $file): bool => $file['url'] !== '' && $file['label'] !== '')) : [];
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'selected-files-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['selected-files-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $files) {
    if ($is_preview) {
        echo '<p class="selected-files-block__placeholder">' . esc_html__('Uzupełnij nagłówek i dodaj pliki.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.selected-files', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'files' => $files,
])->render();
