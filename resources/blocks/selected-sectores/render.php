<?php

$heading = function_exists('get_field') ? (string) get_field('selected_sectors_heading') : '';
$items = function_exists('get_field') ? get_field('selected_sectors_items') : [];
$industry_ids = array_values(array_unique(array_filter(
    array_map('absint', is_array($items) ? $items : []),
    static fn (int $post_id): bool => $post_id > 0 && get_post_type($post_id) === 'industry'
)));
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'selected-sectors-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['selected-sectores-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $industry_ids) {
    if ($is_preview) {
        echo '<p class="selected-sectores-block__placeholder">' . esc_html__('Uzupełnij nagłówek i wybierz branże.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.selected-sectores', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'industryIds' => $industry_ids,
])->render();
