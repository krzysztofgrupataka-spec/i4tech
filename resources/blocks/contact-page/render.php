<?php

$field = static fn (string $name, string $default = ''): string => function_exists('get_field')
    ? trim((string) (get_field($name) ?: $default))
    : $default;

$data = [
    'heading' => $field('contact_page_heading', __('Przed jakim wyzwaniem stoi Twój zakład?', 'i4tech')),
    'intro' => $field('contact_page_intro', __('Opisz krótko swój problem technologiczny. Skontaktujemy się z Tobą i przedstawimy Ci kolejne kroki do jego rozwiązania. Możesz też zadzwonić do nas od razu.', 'i4tech')),
    'email' => $field('contact_page_email', 'i4t@i4t.pl'),
    'directionsUrl' => $field('contact_page_directions_url'),
    'officeLabel' => $field('contact_page_office_label', __('Sekretariat', 'i4tech')),
    'officePhones' => array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $field('contact_page_office_phones')))),
    'officeEmail' => $field('contact_page_office_email'),
    'salesLabel' => $field('contact_page_sales_label', __('Dział sprzedaży', 'i4tech')),
    'salesPhone' => $field('contact_page_sales_phone'),
    'salesEmail' => $field('contact_page_sales_email'),
    'formId' => function_exists('get_field') ? absint(get_field('contact_page_form') ?: 0) : 0,
    'address' => function_exists('\\App\\footer_options') ? (string) (\App\footer_options()['address'] ?? '') : '',
];

$block_attributes = isset($block) && is_array($block) ? $block : [];
$is_preview = isset($is_preview) && $is_preview;

echo view('blocks.contact-page', compact('data', 'block_attributes', 'is_preview'))->render();
