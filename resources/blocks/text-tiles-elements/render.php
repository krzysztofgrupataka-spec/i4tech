<?php

$heading = function_exists('get_field') ? trim((string) get_field('text_tiles_elements_heading')) : '';
$items = function_exists('get_field') ? get_field('text_tiles_elements_items') : [];
$items = is_array($items) ? array_values(array_filter(array_map(
    static function ($item): array {
        return is_array($item) ? [
            'title' => trim((string) ($item['title'] ?? '')),
            'text' => trim((string) ($item['text'] ?? '')),
        ] : ['title' => '', 'text' => ''];
    },
    $items
), static fn (array $item): bool => $item['title'] !== '' || $item['text'] !== '')) : [];
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'text-tiles-elements-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['text-tiles-elements-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $items) {
    if ($is_preview) {
        echo '<p class="text-tiles-elements-block__placeholder">' . esc_html__('Uzupełnij nagłówek i dodaj kafle.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.text-tiles-elements', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'items' => $items,
])->render();
