<?php

$heading = function_exists('get_field') ? trim((string) get_field('text_columns_heading')) : '';
$text = function_exists('get_field') ? trim((string) get_field('text_columns_text')) : '';
$show_items = function_exists('get_field') && (bool) get_field('text_columns_show_items');
$items = $show_items && function_exists('get_field') ? get_field('text_columns_items') : [];
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
    : 'text-columns-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['text-columns-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $text) {
    if ($is_preview) {
        echo '<p class="text-columns-block__placeholder">' . esc_html__('Uzupełnij nagłówek i tekst.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.text-columns', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'text' => $text,
    'items' => $items,
])->render();
