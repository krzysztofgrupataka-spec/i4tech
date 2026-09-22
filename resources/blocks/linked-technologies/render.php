<?php

$heading = function_exists('get_field') ? (string) get_field('linked_technologies_heading') : '';
$variant = function_exists('get_field') ? (string) get_field('linked_technologies_variant') : 'vertical-accordion';
$variant = in_array($variant, ['vertical-accordion', 'horizontal'], true) ? $variant : 'vertical-accordion';
$technology_ids = function_exists('get_field') ? get_field('linked_technologies_items') : [];
$technology_ids = is_array($technology_ids) ? array_values(array_unique(array_map('absint', $technology_ids))) : [];
$technology_ids = array_values(array_filter(
    $technology_ids,
    static fn (int $technology_id): bool => $technology_id > 0
));

if ($variant === 'vertical-accordion') {
    $technology_ids = array_values(array_filter(
        $technology_ids,
        static fn (int $technology_id): bool => wp_get_post_parent_id($technology_id) === 0
    ));
}
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor'] ? sanitize_title($block['anchor']) : 'linked-technologies-' . ($block['id'] ?? wp_unique_id());
$block_classes = [
    'linked-technologies-block',
    'linked-technologies-block--' . $variant,
    'alignfull',
];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $technology_ids) {
    if ($is_preview) {
        echo '<p class="linked-technologies-block__placeholder">' . esc_html__('Uzupełnij nagłówek i wybierz technologie.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.linked-technologies', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'variant' => $variant,
    'technologyIds' => $technology_ids,
])->render();
