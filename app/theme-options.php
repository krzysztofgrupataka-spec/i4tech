<?php

namespace App;

function footer_options_defaults(): array
{
    return [
        'heading' => __('Z jakim wyzwaniem', 'i4tech'),
        'heading_highlight' => __('mierzy się Twój zakład?', 'i4tech'),
        'description' => __('Opowiedz nam o nim, a przygotujemy idealnie dopasowane rozwiązanie.', 'i4tech'),
        'cta_label' => __('Skontaktuj się z nami', 'i4tech'),
        'cta_url' => home_url('/kontakt/'),
        'address' => "i4tech Sp. z o.o.\nul. 16 lipca 14\n41-506 Chorzów",
        'social_label' => __('Social media', 'i4tech'),
        'linkedin_url' => '',
        'facebook_url' => '',
        'youtube_url' => '',
        'background_image_id' => 0,
        'blog_heading' => __('Baza wiedzy', 'i4tech'),
        'blog_description' => __('Tutaj znajdziesz fachowe treści w zakresie oferowanych przez nas technologii', 'i4tech'),
    ];
}

function footer_options(): array
{
    $defaults = footer_options_defaults();

    if (! function_exists('get_field')) {
        $legacy = get_option('i4tech_footer_options', []);

        return wp_parse_args(is_array($legacy) ? $legacy : [], $defaults);
    }

    return [
        'heading' => (string) (get_field('footer_heading', 'option') ?? $defaults['heading']),
        'heading_highlight' => (string) (get_field('footer_heading_highlight', 'option') ?? $defaults['heading_highlight']),
        'description' => (string) (get_field('footer_description', 'option') ?? $defaults['description']),
        'cta_label' => (string) (get_field('footer_cta_label', 'option') ?? $defaults['cta_label']),
        'cta_url' => (string) (get_field('footer_cta_url', 'option') ?? $defaults['cta_url']),
        'address' => (string) (get_field('footer_address', 'option') ?? $defaults['address']),
        'social_label' => (string) (get_field('footer_social_label', 'option') ?? $defaults['social_label']),
        'linkedin_url' => (string) (get_field('footer_linkedin_url', 'option') ?? ''),
        'facebook_url' => (string) (get_field('footer_facebook_url', 'option') ?? ''),
        'youtube_url' => (string) (get_field('footer_youtube_url', 'option') ?? ''),
        'background_image_id' => absint(get_field('footer_background_image', 'option') ?: 0),
        'blog_heading' => (string) (get_field('blog_heading', 'option') ?: $defaults['blog_heading']),
        'blog_description' => (string) (get_field('blog_description', 'option') ?: $defaults['blog_description']),
    ];
}

add_action('acf/init', function (): void {
    if (! function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page([
        'page_title' => __('Theme settings', 'i4tech'),
        'menu_title' => __('Theme settings', 'i4tech'),
        'menu_slug' => 'i4tech-theme-settings',
        'capability' => 'edit_theme_options',
        'redirect' => false,
        'position' => 61,
        'icon_url' => 'dashicons-admin-generic',
        'update_button' => __('Zapisz ustawienia', 'i4tech'),
        'updated_message' => __('Ustawienia zostały zapisane.', 'i4tech'),
    ]);

    migrate_legacy_footer_options();
});

function migrate_legacy_footer_options(): void
{
    if (get_option('i4tech_footer_options_acf_migrated') || ! function_exists('update_field')) {
        return;
    }

    $legacy = get_option('i4tech_footer_options', []);
    $values = wp_parse_args(is_array($legacy) ? $legacy : [], footer_options_defaults());
    $field_map = [
        'field_i4tech_footer_heading' => 'heading',
        'field_i4tech_footer_heading_highlight' => 'heading_highlight',
        'field_i4tech_footer_description' => 'description',
        'field_i4tech_footer_cta_label' => 'cta_label',
        'field_i4tech_footer_cta_url' => 'cta_url',
        'field_i4tech_footer_address' => 'address',
        'field_i4tech_footer_social_label' => 'social_label',
        'field_i4tech_footer_linkedin_url' => 'linkedin_url',
        'field_i4tech_footer_facebook_url' => 'facebook_url',
        'field_i4tech_footer_youtube_url' => 'youtube_url',
        'field_i4tech_footer_background_image' => 'background_image_id',
    ];

    foreach ($field_map as $field_key => $legacy_key) {
        update_field($field_key, $values[$legacy_key], 'option');
    }

    update_option('i4tech_footer_options_acf_migrated', 1, false);
}
