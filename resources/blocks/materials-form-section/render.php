<?php

$heading = function_exists('get_field') ? trim((string) get_field('materials_form_heading')) : '';
$text = function_exists('get_field') ? trim((string) get_field('materials_form_text')) : '';
$form_id = function_exists('get_field') ? absint(get_field('materials_form_form') ?: 0) : 0;
$block_attributes = isset($block) && is_array($block) ? $block : [];
$is_preview = isset($is_preview) && $is_preview;
$show_on_frontend = (bool) (($block_attributes['data']['materials_form_show_on_frontend'] ?? true));

if (! $show_on_frontend) {
    if ($is_preview) {
        echo '<p class="materials-form-section-block__placeholder">' . esc_html__('Sekcja pobierania materiałów jest ukryta na stronie publicznej.', 'i4tech') . '</p>';
    }

    return;
}

if (! $heading && ! $text && ! $form_id) {
    if ($is_preview) {
        echo '<p class="materials-form-section-block__placeholder">' . esc_html__('Uzupełnij treść i wybierz formularz.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.materials-form-section', [
    'attributes' => $block_attributes,
    'heading' => $heading,
    'text' => $text,
    'formId' => $form_id,
    'isPreview' => $is_preview,
])->render();
