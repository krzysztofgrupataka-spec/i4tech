<?php

$heading = function_exists('get_field') ? trim((string) get_field('selected_solutions_heading')) : '';
$items = function_exists('get_field') ? get_field('selected_solutions_items') : [];
$image_id = function_exists('get_field') ? absint(get_field('selected_solutions_image') ?: 0) : 0;
$solution_ids = is_array($items) ? array_values(array_unique(array_filter(array_map(
    static fn ($item): int => absint(is_array($item) ? ($item['solution'] ?? 0) : $item),
    $items
)))) : [];
$image_span = 4 - (count($solution_ids) % 4);
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'selected-solutions-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['selected-solutions-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! $solution_ids && ! $image_id) {
    if ($is_preview) {
        echo '<p class="selected-solutions-block__placeholder">' . esc_html__('Uzupełnij nagłówek, wybierz rozwiązania i dodaj zdjęcie.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.selected-solutions', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'solutionIds' => $solution_ids,
    'imageId' => $image_id,
    'imageSpan' => $image_span,
])->render();
