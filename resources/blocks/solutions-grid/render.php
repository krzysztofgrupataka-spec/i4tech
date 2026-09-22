<?php

$heading = function_exists('get_field') ? (string) get_field('solutions_grid_heading') : '';
$heading_highlight = function_exists('get_field') ? (string) get_field('solutions_grid_heading_highlight') : '';
$items = function_exists('get_field') ? get_field('solutions_grid_items') : [];

$solution_ids = array_values(array_filter(array_map('absint', is_array($items) ? $items : [])));

if (! $heading && ! $heading_highlight && ! $solution_ids) {
    return;
}

echo view('blocks.solutions-grid', [
    'heading' => $heading,
    'headingHighlight' => $heading_highlight,
    'solutionIds' => $solution_ids,
])->render();
