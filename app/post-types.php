<?php

namespace App;

add_action('init', function (): void {
    register_post_type('solution', [
        'labels' => [
            'name' => __('Rozwiązania', 'i4tech'),
            'singular_name' => __('Rozwiązanie', 'i4tech'),
            'add_new_item' => __('Dodaj rozwiązanie', 'i4tech'),
            'edit_item' => __('Edytuj rozwiązanie', 'i4tech'),
            'new_item' => __('Nowe rozwiązanie', 'i4tech'),
            'view_item' => __('Zobacz rozwiązanie', 'i4tech'),
            'search_items' => __('Szukaj rozwiązań', 'i4tech'),
            'not_found' => __('Nie znaleziono rozwiązań', 'i4tech'),
            'all_items' => __('Wszystkie rozwiązania', 'i4tech'),
            'menu_name' => __('Rozwiązania', 'i4tech'),
        ],
        'public' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'rewrite' => ['slug' => 'rozwiazania'],
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'revisions'],
    ]);

    register_post_type('technology', [
        'labels' => [
            'name' => __('Technologie', 'i4tech'),
            'singular_name' => __('Technologia', 'i4tech'),
            'add_new_item' => __('Dodaj technologię', 'i4tech'),
            'edit_item' => __('Edytuj technologię', 'i4tech'),
            'new_item' => __('Nowa technologia', 'i4tech'),
            'view_item' => __('Zobacz technologię', 'i4tech'),
            'search_items' => __('Szukaj technologii', 'i4tech'),
            'not_found' => __('Nie znaleziono technologii', 'i4tech'),
            'all_items' => __('Wszystkie technologie', 'i4tech'),
            'menu_name' => __('Technologie', 'i4tech'),
        ],
        'public' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'menu_icon' => 'dashicons-lightbulb',
        'rewrite' => ['slug' => 'technologie'],
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'revisions'],
    ]);

    register_post_type('case_study', [
        'labels' => [
            'name' => __('Case study', 'i4tech'),
            'singular_name' => __('Case study', 'i4tech'),
            'add_new_item' => __('Dodaj case study', 'i4tech'),
            'edit_item' => __('Edytuj case study', 'i4tech'),
            'new_item' => __('Nowe case study', 'i4tech'),
            'view_item' => __('Zobacz case study', 'i4tech'),
            'search_items' => __('Szukaj case study', 'i4tech'),
            'not_found' => __('Nie znaleziono case study', 'i4tech'),
            'all_items' => __('Wszystkie case studies', 'i4tech'),
            'menu_name' => __('Case study', 'i4tech'),
        ],
        'public' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-portfolio',
        'rewrite' => ['slug' => 'case-study'],
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
    ]);

    register_post_type('industry', [
        'labels' => [
            'name' => __('Branże', 'i4tech'),
            'singular_name' => __('Branża', 'i4tech'),
            'add_new' => __('Dodaj nową', 'i4tech'),
            'add_new_item' => __('Dodaj branżę', 'i4tech'),
            'edit_item' => __('Edytuj branżę', 'i4tech'),
            'new_item' => __('Nowa branża', 'i4tech'),
            'view_item' => __('Zobacz branżę', 'i4tech'),
            'view_items' => __('Zobacz branże', 'i4tech'),
            'search_items' => __('Szukaj branż', 'i4tech'),
            'not_found' => __('Nie znaleziono branż', 'i4tech'),
            'not_found_in_trash' => __('Nie znaleziono branż w koszu', 'i4tech'),
            'all_items' => __('Wszystkie branże', 'i4tech'),
            'archives' => __('Archiwum branż', 'i4tech'),
            'attributes' => __('Atrybuty branży', 'i4tech'),
            'featured_image' => __('Obraz wyróżniający', 'i4tech'),
            'set_featured_image' => __('Ustaw obraz wyróżniający', 'i4tech'),
            'remove_featured_image' => __('Usuń obraz wyróżniający', 'i4tech'),
            'use_featured_image' => __('Użyj jako obrazu wyróżniającego', 'i4tech'),
            'menu_name' => __('Branże', 'i4tech'),
        ],
        'public' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-building',
        'rewrite' => [
            'slug' => 'branze',
            'with_front' => false,
        ],
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions'],
    ]);
});
