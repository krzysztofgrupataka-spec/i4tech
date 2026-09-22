<?php

/**
 * WordPress template fallback.
 */

if (function_exists('view')) {
    $templates = [];

    if (is_front_page()) {
        $templates[] = 'front-page';
    }

    if (is_home()) {
        $templates[] = 'home';
    }

    if (is_category() || is_tag() || is_date() || is_author()) {
        $templates[] = 'home';
    }

    if (is_page()) {
        $templates[] = 'page';
    }

    if (is_single()) {
        $post_type = get_post_type();

        if (is_string($post_type) && $post_type !== '') {
            $templates[] = 'single-' . $post_type;
        }

        $templates[] = 'single';
    }

    if (is_404()) {
        $templates[] = '404';
    }

    $templates[] = 'index';

    foreach (array_unique($templates) as $template) {
        if (view()->exists($template)) {
            echo view($template)->render();

            return;
        }
    }

    return;
}

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        the_title('<h1>', '</h1>');
        the_content();
    }
}

get_footer();
