<?php

namespace App;

add_filter('excerpt_more', static fn (): string => '&hellip;');

add_filter('body_class', function (array $classes): array {
    if (! is_singular()) {
        $classes[] = 'is-archive-view';
    }

    if (is_front_page()) {
        $classes[] = 'is-front-page';
    }

    return array_unique($classes);
});

add_filter('script_loader_tag', function (string $tag, string $handle, string $src): string {
    if (! str_starts_with($handle, 'i4tech/')) {
        return $tag;
    }

    return sprintf(
        '<script type="module" src="%s" id="%s-js"></script>',
        esc_url($src),
        esc_attr($handle)
    );
}, 10, 3);
