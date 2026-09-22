<?php

$heading = isset($attributes['heading']) ? wp_kses_post($attributes['heading']) : '';
$text = isset($attributes['text']) ? wp_kses_post($attributes['text']) : '';
$button_text = isset($attributes['buttonText']) ? sanitize_text_field($attributes['buttonText']) : '';
$button_url = isset($attributes['buttonUrl']) ? esc_url($attributes['buttonUrl']) : '';
?>
<section <?php echo get_block_wrapper_attributes(['class' => 'cta-block']); ?>>
    <div class="cta-block__inner container container--default">
        <div class="cta-block__content">
            <?php if ($heading) : ?>
                <h2><?php echo wp_kses_post($heading); ?></h2>
            <?php endif; ?>
            <?php if ($text) : ?>
                <p><?php echo wp_kses_post($text); ?></p>
            <?php endif; ?>
        </div>
        <?php if ($button_text && $button_url) : ?>
            <a class="button button--primary" href="<?php echo esc_url($button_url); ?>">
                <?php echo esc_html($button_text); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
