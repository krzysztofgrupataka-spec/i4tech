<?php

$heading = isset($attributes['heading']) ? wp_kses_post($attributes['heading']) : '';
$items = isset($attributes['items']) && is_array($attributes['items']) ? $attributes['items'] : [];
?>
<section <?php echo get_block_wrapper_attributes(['class' => 'faq-block']); ?>>
    <div class="faq-block__inner container container--default">
    <?php if ($heading) : ?>
        <h2><?php echo wp_kses_post($heading); ?></h2>
    <?php endif; ?>

    <?php if ($items) : ?>
        <div class="faq-block__items">
            <?php foreach ($items as $item) : ?>
                <details class="faq-block__item">
                    <summary><?php echo esc_html($item['question'] ?? ''); ?></summary>
                    <div class="faq-block__answer">
                        <?php echo wp_kses_post($item['answer'] ?? ''); ?>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </div>
</section>
