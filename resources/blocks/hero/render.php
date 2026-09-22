<?php

$eyebrow = isset($attributes['eyebrow']) ? sanitize_text_field($attributes['eyebrow']) : '';
$heading = isset($attributes['heading']) ? wp_kses_post($attributes['heading']) : '';
$text = isset($attributes['text']) ? wp_kses_post($attributes['text']) : '';
$button_text = isset($attributes['buttonText']) ? sanitize_text_field($attributes['buttonText']) : '';
$button_url = isset($attributes['buttonUrl']) ? esc_url($attributes['buttonUrl']) : '';
?>
<section <?php echo get_block_wrapper_attributes(['class' => 'hero-block']); ?>>
    <div class="hero-block__inner container container--default">
        <?php if ($eyebrow) : ?>
            <p class="hero-block__eyebrow"><?php echo esc_html($eyebrow); ?></p>
        <?php endif; ?>

        <?php if ($heading) : ?>
            <h1 class="hero-block__heading"><?php echo wp_kses_post($heading); ?></h1>
        <?php endif; ?>

        <?php if ($text) : ?>
            <p class="hero-block__text"><?php echo wp_kses_post($text); ?></p>
        <?php endif; ?>

        <?php if ($button_text && $button_url) : ?>
            <a class="button button--primary" href="<?php echo esc_url($button_url); ?>">
                <?php echo esc_html($button_text); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
