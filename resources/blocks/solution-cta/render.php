<?php

$heading = function_exists('get_field') ? (string) get_field('solution_cta_heading') : '';
$button = function_exists('get_field') ? get_field('solution_cta_button') : [];
$button_label = is_array($button) ? sanitize_text_field($button['title'] ?? '') : '';
$button_url = is_array($button) ? esc_url_raw($button['url'] ?? '') : '';
$button_target = is_array($button) ? sanitize_key($button['target'] ?? '') : '';
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'solution-cta-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['solution-cta-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $heading && ! ($button_label && $button_url)) {
    if ($is_preview) {
        echo '<p class="solution-cta-block__placeholder">' . esc_html__('Uzupełnij nagłówek i przycisk.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.solution-cta', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'buttonLabel' => $button_label,
    'buttonUrl' => $button_url,
    'buttonTarget' => $button_target,
])->render();
