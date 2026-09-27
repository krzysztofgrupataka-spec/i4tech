<?php

$heading = function_exists('get_field') ? trim((string) get_field('selected_blog_posts_heading')) : '';
$items = function_exists('get_field') ? get_field('selected_blog_posts_items') : [];
$post_ids = array_slice(array_values(array_unique(array_filter(array_map('absint', is_array($items) ? $items : [])))), 0, 3);
$posts_page_id = absint(get_option('page_for_posts'));
$archive_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/blog/');
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor']
    ? sanitize_title($block['anchor'])
    : 'selected-blog-posts-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['selected-blog-posts-block', 'alignfull'];
$show_blog_sections = function_exists('\\App\\footer_options')
    ? (bool) (\App\footer_options()['show_blog_sections'] ?? false)
    : false;

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (! $show_blog_sections) {
    if ($is_preview) {
        echo '<p class="selected-blog-posts-block__placeholder">' . esc_html__('Sekcja bloga jest obecnie ukryta w ustawieniach motywu.', 'i4tech') . '</p>';
    }

    return;
}

if (! $heading && ! $post_ids) {
    if ($is_preview) {
        echo '<p class="selected-blog-posts-block__placeholder">' . esc_html__('Uzupełnij nagłówek i wybierz wpisy.', 'i4tech') . '</p>';
    }

    return;
}

echo view('blocks.selected-blog-posts', [
    'blockId' => $block_id,
    'blockClasses' => $block_classes,
    'heading' => $heading,
    'postIds' => $post_ids,
    'archiveUrl' => $archive_url,
])->render();
