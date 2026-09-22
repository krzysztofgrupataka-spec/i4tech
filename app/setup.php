<?php

namespace App;

use App\Blocks\BlockRegistrar;

add_action('after_setup_theme', function (): void {
    load_theme_textdomain('i4tech', get_template_directory() . '/lang');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('custom-logo', [
        'flex-height' => true,
        'flex-width' => true,
        'unlink-homepage-logo' => false,
    ]);
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'navigation-widgets',
        'script',
        'search-form',
        'style',
    ]);

    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'i4tech'),
        'footer_navigation' => __('Stopka — Blog, kontakt i polityka prywatności', 'i4tech'),
        'footer_industries_navigation' => __('Stopka — Branże', 'i4tech'),
    ]);

    add_editor_style(asset_path('resources/styles/editor.scss'));
});

add_action('init', function (): void {
    add_image_size('content-wide', 1440, 9999, false);
    add_image_size('card', 720, 540, true);

    BlockRegistrar::registerAll();
});

add_action('wp_enqueue_scripts', function (): void {
    enqueue_asset('resources/styles/app.scss');
    enqueue_asset('resources/scripts/app.ts');
}, 100);

add_action('pre_get_posts', function (\WP_Query $query): void {
    if (! is_admin() && $query->is_main_query() && (bool) $query->get('i4tech_blog')) {
        $query->set('post_type', 'post');
        $query->set('post_status', 'publish');
        $query->is_home = true;
        $query->is_archive = false;
        $query->is_404 = false;
    }

    if (! is_admin() && $query->is_main_query() && $query->is_home()) {
        $query->set('posts_per_page', 8);
    }

    if (! is_admin() && $query->is_main_query() && $query->is_post_type_archive('case_study')) {
        $query->set('posts_per_page', 8);
    }
});

add_action('init', function (): void {
    add_rewrite_tag('%i4tech_blog%', '([0-1])');
    add_rewrite_rule('^blog/?$', 'index.php?i4tech_blog=1', 'top');

    if (get_option('i4tech_blog_rewrite_version') !== '1') {
        flush_rewrite_rules(false);
        update_option('i4tech_blog_rewrite_version', '1', false);
    }
}, 20);

add_filter('post_type_archive_link', function (string $link, string $post_type): string {
    return $post_type === 'post' ? home_url('/blog/') : $link;
}, 10, 2);

add_filter('wp_setup_nav_menu_item', function ($item) {
    if (! is_object($item)) {
        return $item;
    }

    if (
        ($item->type ?? '') === 'post_type_archive'
        && ($item->object ?? '') === 'post'
    ) {
        $item->url = home_url('/blog/');
    }

    return $item;
});

add_action('enqueue_block_editor_assets', function (): void {
    enqueue_asset('resources/styles/editor.scss');
    enqueue_asset('resources/scripts/editor.ts');
}, 100);
