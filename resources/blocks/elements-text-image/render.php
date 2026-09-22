<?php

$heading = function_exists('get_field') ? trim((string) get_field('elements_text_image_heading')) : '';
$raw_items = function_exists('get_field') ? get_field('elements_text_image_items') : [];
$rounded = ! function_exists('get_field') || (bool) get_field('elements_text_image_rounded');
$background = function_exists('get_field') ? (string) get_field('elements_text_image_background') : 'gradient';
$background = in_array($background, ['gradient', 'white', 'beige'], true) ? $background : 'gradient';
$items = [];

foreach (is_array($raw_items) ? $raw_items : [] as $raw_item) {
    if (! is_array($raw_item)) {
        continue;
    }

    $type = ($raw_item['type'] ?? 'text') === 'image' ? 'image' : 'text';
    $item_background = (string) ($raw_item['background'] ?? 'white');
    $item_background = in_array($item_background, ['white', 'yellow', 'beige'], true) ? $item_background : 'white';
    $item = [
        'type' => $type,
        'imageId' => absint($raw_item['image'] ?? 0),
        'title' => trim((string) ($raw_item['title'] ?? '')),
        'text' => trim((string) ($raw_item['text'] ?? '')),
        'background' => $item_background,
    ];

    if (($type === 'image' && $item['imageId']) || ($type === 'text' && ($item['title'] || $item['text']))) {
        $items[] = $item;
    }
}

$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'elements-text-image-' . ($block['id'] ?? wp_unique_id());
$block_classes = [
    'elements-text-image-block',
    'elements-text-image-block--background-' . $background,
    'alignfull',
];

if ($rounded) {
    $block_classes[] = 'elements-text-image-block--rounded';
}

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $items) {
    if ($is_preview) {
        echo '<p class="elements-text-image-block__placeholder">' . esc_html__('Uzupełnij nagłówek i dodaj elementy.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.elements-text-image', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'items' => $items,
])->render();
