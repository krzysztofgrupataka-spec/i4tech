<?php

$rows = function_exists('get_field') ? get_field('homepage_technologies_items') : [];
$technology_ids = [];

if (is_array($rows)) {
    foreach ($rows as $row) {
        $technology = is_array($row) ? ($row['technology'] ?? 0) : 0;
        $technology_id = is_object($technology) && isset($technology->ID) ? absint($technology->ID) : absint($technology);

        if ($technology_id) {
            $technology_ids[] = $technology_id;
        }
    }
}

$technology_ids = array_values(array_unique($technology_ids));
$is_preview = isset($is_preview) && $is_preview;
$block_id = isset($block['anchor']) && $block['anchor'] ? sanitize_title($block['anchor']) : 'homepage-technologies-' . ($block['id'] ?? wp_unique_id());
$block_classes = ['homepage-technologies-block', 'alignfull'];

if (isset($block['className']) && $block['className']) {
    $block_classes[] = sanitize_html_class($block['className']);
}

if (isset($block['align']) && $block['align']) {
    $block_classes[] = 'align' . sanitize_html_class($block['align']);
}

if (! $technology_ids) {
    if ($is_preview) {
        ?>
        <section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr(implode(' ', array_merge($block_classes, ['homepage-technologies-block--placeholder']))); ?>">
            <div class="container container--default">
                <p class="homepage-technologies-block__placeholder">
                    <?php echo esc_html__('Wybierz technologie w polach bloku Homepage Technologies.', 'i4tech'); ?>
                </p>
            </div>
        </section>
        <?php
    }

    return;
}
?>
<section id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr(implode(' ', $block_classes)); ?>">
    <div class="homepage-technologies-block__inner container container--default">
        <?php echo view('components.technology-accordion', [
            'technologyIds' => $technology_ids,
            'columns' => 2,
            'openFirst' => true,
        ])->render(); ?>
    </div>
</section>
