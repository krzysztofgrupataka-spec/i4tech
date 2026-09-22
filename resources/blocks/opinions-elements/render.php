<?php

$heading = function_exists('get_field') ? trim((string) get_field('opinions_elements_heading')) : '';
$raw_items = function_exists('get_field') ? get_field('opinions_elements_items') : [];
$items = [];

foreach (is_array($raw_items) ? $raw_items : [] as $raw_item) {
    if (! is_array($raw_item)) {
        continue;
    }

    $item = [
        'text' => trim((string) ($raw_item['text'] ?? '')),
        'name' => trim((string) ($raw_item['name'] ?? '')),
        'position' => trim((string) ($raw_item['position'] ?? '')),
    ];

    if ($item['text'] || $item['name'] || $item['position']) {
        $items[] = $item;
    }
}

$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'opinions-elements-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['opinions-elements-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $items) {
    if ($is_preview) {
        echo '<p class="opinions-elements-block__placeholder">' . esc_html__('Uzupełnij nagłówek i dodaj opinie.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.opinions-elements', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'items' => $items,
])->render();
