<?php

$heading = isset($attributes['heading']) ? wp_kses_post($attributes['heading']) : '';
$lead = isset($attributes['lead']) ? wp_kses_post($attributes['lead']) : '';
$tone = isset($attributes['tone']) && in_array($attributes['tone'], ['default', 'surface'], true)
    ? $attributes['tone']
    : 'default';
?>
<section <?php echo get_block_wrapper_attributes(['class' => "section-block section-block--{$tone}"]); ?>>
    <div class="section-block__inner container container--default">
        <?php if ($heading) : ?>
            <h2><?php echo wp_kses_post($heading); ?></h2>
        <?php endif; ?>
        <?php if ($lead) : ?>
            <p><?php echo wp_kses_post($lead); ?></p>
        <?php endif; ?>
    </div>
</section>
