<?php

$columns = function_exists('get_field') ? (array) get_field('blog_table_columns') : [];
$rows = function_exists('get_field') ? (array) get_field('blog_table_rows') : [];
$caption = function_exists('get_field') ? trim((string) get_field('blog_table_caption')) : '';
$block_attributes = isset($block) && is_array($block) ? $block : [];
$is_preview = isset($is_preview) && $is_preview;

$headings = array_values(array_filter(array_map(
    static fn ($column): string => is_array($column) ? trim((string) ($column['heading'] ?? '')) : '',
    $columns
), static fn (string $heading): bool => $heading !== ''));

if (count($headings) < 2) {
    if ($is_preview) {
        echo '<p class="blog-table-block__placeholder">' . esc_html__('Dodaj co najmniej 2 kolumny tabeli.', 'i4tech') . '</p>';
    }

    return;
}

$normalized_rows = array_map(static function ($row) use ($headings): array {
    $row = is_array($row) ? $row : [];
    $cells = array_map(
        static fn ($cell): string => is_array($cell) ? trim((string) ($cell['content'] ?? '')) : '',
        (array) ($row['cells'] ?? [])
    );

    return array_slice(array_pad($cells, count($headings), ''), 0, count($headings));
}, $rows);

echo view('blocks.blog-table', [
    'attributes' => $block_attributes,
    'headings' => $headings,
    'rows' => $normalized_rows,
    'caption' => $caption,
])->render();
