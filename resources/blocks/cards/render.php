<?php

$heading = isset($attributes['heading']) ? wp_kses_post($attributes['heading']) : '';
$items = isset($attributes['items']) && is_array($attributes['items']) ? $attributes['items'] : [];
?>
<section <?php echo get_block_wrapper_attributes(['class' => 'cards-block']); ?>>
    <div class="cards-block__inner container container--default">
    <?php if ($heading) : ?>
        <h2><?php echo wp_kses_post($heading); ?></h2>
    <?php endif; ?>

    <?php if ($items) : ?>
        <div class="cards-block__grid">
            <?php foreach ($items as $item) : ?>
                <article class="cards-block__card">
                    <?php if (! empty($item['title'])) : ?>
                        <h3><?php echo esc_html($item['title']); ?></h3>
                    <?php endif; ?>
                    <?php if (! empty($item['text'])) : ?>
                        <p><?php echo wp_kses_post($item['text']); ?></p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </div>
</section>
