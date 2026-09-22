<?php

$heading = function_exists('get_field') ? (string) get_field('image_text_column_heading') : '';
$heading_highlight = function_exists('get_field') ? (string) get_field('image_text_column_heading_highlight') : '';
$text = function_exists('get_field') ? (string) get_field('image_text_column_text') : '';
$button = function_exists('get_field') ? get_field('image_text_column_button') : [];
$image_id = function_exists('get_field') ? absint(get_field('image_text_column_image') ?: 0) : 0;
$layout = function_exists('get_field') ? (string) get_field('image_text_column_layout') : 'text-left';
$layout = $layout === 'image-left' ? 'image-left' : 'text-left';
$padding_top = function_exists('get_field') ? (string) get_field('image_text_column_padding_top') : 'full';
$padding_bottom = function_exists('get_field') ? (string) get_field('image_text_column_padding_bottom') : 'full';
$padding_options = ['full', 'half', 'none'];
$padding_top = in_array($padding_top, $padding_options, true) ? $padding_top : 'full';
$padding_bottom = in_array($padding_bottom, $padding_options, true) ? $padding_bottom : 'full';

$button_label = is_array($button) ? sanitize_text_field($button['title'] ?? '') : '';
$button_url = is_array($button) ? esc_url_raw($button['url'] ?? '') : '';
$button_target = is_array($button) ? sanitize_key($button['target'] ?? '') : '';
$block_attributes = isset($block) && is_array($block) ? $block : [];

if (! $heading && ! $text && ! ($button_label && $button_url) && ! $image_id) {
    return;
}

echo view('blocks.image-text-column', [
    'attributes' => $block_attributes,
    'heading' => $heading,
    'headingHighlight' => $heading_highlight,
    'text' => $text,
    'buttonLabel' => $button_label,
    'buttonUrl' => $button_url,
    'buttonTarget' => $button_target,
    'imageId' => $image_id,
    'layout' => $layout,
    'paddingTop' => $padding_top,
    'paddingBottom' => $padding_bottom,
])->render();
