<?php

$heading = function_exists('get_field') ? trim((string) get_field('contact_form_heading')) : '';
$text = function_exists('get_field') ? trim((string) get_field('contact_form_text')) : '';
$form_id = function_exists('get_field') ? absint(get_field('contact_form_form') ?: 0) : 0;
$contact_details = function_exists('\\App\\footer_options') ? \App\footer_options() : [];
$block_attributes = isset($block) && is_array($block) ? $block : [];
$is_preview = isset($is_preview) && $is_preview;

if (! $heading && ! $text && ! $form_id) {
    if ($is_preview) {
        echo '<p class="contact-form-section-block__placeholder">' . esc_html__('Uzupełnij treść i wybierz formularz.', 'i4tech') . '</p>';
    }
    return;
}

echo view('blocks.contact-form-section', [
    'attributes' => $block_attributes,
    'heading' => $heading,
    'text' => $text,
    'formId' => $form_id,
    'contactDirectIntro' => (string) ($contact_details['contact_direct_intro'] ?? ''),
    'contactDirectName' => (string) ($contact_details['contact_direct_name'] ?? ''),
    'contactDirectEmail' => (string) ($contact_details['contact_direct_email'] ?? ''),
    'contactDirectPhone' => (string) ($contact_details['contact_direct_phone'] ?? ''),
    'isPreview' => $is_preview,
])->render();
