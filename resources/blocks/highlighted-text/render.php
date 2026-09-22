<?php

$content = function_exists('get_field') ? trim((string) get_field('highlighted_text_content')) : '';
$alignment = function_exists('get_field') ? (string) get_field('highlighted_text_alignment') : 'left';
$background = function_exists('get_field') ? (string) get_field('highlighted_text_background') : 'beige';
$alignment = in_array($alignment, ['left', 'right'], true) ? $alignment : 'left';
$background = in_array($background, ['beige', 'white', 'yellow', 'dark'], true) ? $background : 'beige';
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'highlighted-text-' . ($block['id'] ?? wp_unique_id());
$block_classes = [
    'highlighted-text-block',
    "highlighted-text-block--{$alignment}",
    "highlighted-text-block--{$background}",
    'alignfull',
];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $content) {
    if ($is_preview) {
        echo '<p class="highlighted-text-block__placeholder">' . esc_html__('Uzupełnij tekst.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.highlighted-text', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'content' => $content,
])->render();
