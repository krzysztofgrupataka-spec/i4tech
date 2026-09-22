<?php

$heading = function_exists('get_field') ? trim((string) get_field('case_study_hero_heading')) : '';
$sector = function_exists('get_field') ? trim((string) get_field('case_study_hero_sector')) : '';
$project_type = function_exists('get_field') ? trim((string) get_field('case_study_hero_project_type')) : '';
$cooperation_subject = function_exists('get_field') ? trim((string) get_field('case_study_hero_cooperation_subject')) : '';
$solutions = function_exists('get_field') ? (array) get_field('case_study_hero_solutions') : [];
$image_id = function_exists('get_field') ? absint(get_field('case_study_hero_image') ?: 0) : 0;
$block_attributes = isset($block) && is_array($block) ? $block : [];
$is_preview = isset($is_preview) && $is_preview;

if (! $heading && ! $image_id && ! $sector && ! $project_type && ! $cooperation_subject) {
    if ($is_preview) {
        echo '<p class="case-study-hero-block__placeholder">' . esc_html__('Uzupełnij treść bloku Case study hero.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.case-study-hero', [
    'attributes' => $block_attributes,
    'heading' => $heading,
    'sector' => $sector,
    'projectType' => $project_type,
    'cooperationSubject' => $cooperation_subject,
    'solutions' => $solutions,
    'imageId' => $image_id,
])->render();
