<?php

$heading = function_exists('get_field') ? trim((string) get_field('case_study_efects_heading')) : '';
$text = function_exists('get_field') ? trim((string) get_field('case_study_efects_text')) : '';
$block_attributes = isset($block) && is_array($block) ? $block : [];
$is_preview = isset($is_preview) && $is_preview;

if (! $heading && ! $text) {
    if ($is_preview) {
        echo '<p class="case-study-efects-block__placeholder">' . esc_html__('Uzupełnij nagłówek i tekst efektów.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.case-study-efects', [
    'attributes' => $block_attributes,
    'heading' => $heading,
    'text' => $text,
])->render();
