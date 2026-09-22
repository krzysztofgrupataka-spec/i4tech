<?php

$heading = function_exists('get_field') ? (string) get_field('full_width_video_heading') : '';
$media_type = function_exists('get_field') && 'video' === get_field('full_width_video_media_type') ? 'video' : 'image';
$image_id = function_exists('get_field') ? absint(get_field('full_width_video_image') ?: 0) : 0;
$video_id = function_exists('get_field') ? absint(get_field('full_width_video_video') ?: 0) : 0;
$button = function_exists('get_field') ? get_field('full_width_video_button') : [];

$button_text = is_array($button) ? sanitize_text_field($button['label'] ?? '') : '';
$button_url = is_array($button) ? esc_url_raw($button['url'] ?? '') : '';
$media_url = 'video' === $media_type && $video_id ? wp_get_attachment_url($video_id) : '';
$media_url = ! $media_url && $image_id ? wp_get_attachment_image_url($image_id, 'full') : $media_url;
$media_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor'] ? sanitize_title($block['anchor']) : 'full-width-video-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['full-width-video-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (isset($block['align']) && $block['align']) {
    $block_classes[] = 'align' . sanitize_html_class($block['align']);
}

if (! $heading && ! $media_url && ! ($button_text && $button_url)) {
    if ($is_preview) {
        ?>
        <section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr(implode(' ', array_merge($block_classes, ['full-width-video-block--placeholder']))); ?>">
            <div class="full-width-video-block__content container container--default">
                <p class="full-width-video-block__placeholder-text">
                    <?php echo esc_html__('Uzupelnij pola bloku Full Width Video.', 'i4tech'); ?>
                </p>
            </div>
        </section>
        <?php
    }

    return;
}
?>
<section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr(implode(' ', $block_classes)); ?>">
    <div class="full-width-video-block__media" aria-hidden="true">
        <?php if ($media_url && 'video' === $media_type) : ?>
            <video src="<?php echo esc_url($media_url); ?>" autoplay muted loop playsinline></video>
        <?php elseif ($media_url) : ?>
            <img src="<?php echo esc_url($media_url); ?>" alt="<?php echo esc_attr($media_alt); ?>">
        <?php endif; ?>
    </div>
    <div class="full-width-video-block__overlay" aria-hidden="true"></div>
    <div class="full-width-video-block__content container container--default">
        <?php if ($heading) : ?>
            <h2 class="full-width-video-block__heading"><?php echo wp_kses_post($heading); ?></h2>
        <?php endif; ?>

        <?php if ($button_text && $button_url) : ?>
            <a class="button button--primary full-width-video-block__button" href="<?php echo esc_url($button_url); ?>">
                <?php echo esc_html($button_text); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
