<?php

$heading = function_exists('get_field') ? trim((string) get_field('selected_case_studies_heading')) : '';
$items = function_exists('get_field') ? get_field('selected_case_studies_items') : [];
$background = function_exists('get_field') ? (string) get_field('selected_case_studies_background') : 'white';
$background = in_array($background, ['white', 'beige'], true) ? $background : 'white';
$case_study_ids = array_slice(array_values(array_filter(array_map('absint', is_array($items) ? $items : []))), 0, 3);
$archive_url = get_post_type_archive_link('case_study') ?: '';

if (! $heading && ! $case_study_ids) {
    return;
}

echo view('blocks.selected-case-studies', [
    'heading' => $heading,
    'caseStudyIds' => $case_study_ids,
    'archiveUrl' => $archive_url,
    'background' => $background,
])->render();
