<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    protected static $views = ['*'];

    public function with(): array
    {
        return [
            'siteName' => get_bloginfo('name'),
            'primaryNavigation' => $this->navigation('primary_navigation'),
            'primaryNavigationItems' => $this->navigationItems('primary_navigation'),
            'footerNavigation' => $this->navigation('footer_navigation'),
            'footerNavigationItems' => $this->navigationItems('footer_navigation'),
            'footerIndustryNavigationItems' => $this->navigationItems('footer_industries_navigation'),
            'footerOptions' => function_exists('\\App\\footer_options') ? \App\footer_options() : [],
        ];
    }

    private function navigation(string $location): string
    {
        if (! has_nav_menu($location)) {
            return '';
        }

        return wp_nav_menu([
            'theme_location' => $location,
            'container' => false,
            'echo' => false,
            'fallback_cb' => false,
            'menu_class' => 'menu',
            'depth' => 2,
        ]) ?: '';
    }

    private function navigationItems(string $location): array
    {
        if (! has_nav_menu($location)) {
            return [];
        }

        $locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($locations[$location] ?? 0);

        if (! $menu) {
            return [];
        }

        $items = wp_get_nav_menu_items($menu->term_id, ['update_post_term_cache' => false]);

        if (! is_array($items)) {
            return [];
        }

        $itemsById = [];

        foreach ($items as $item) {
            $itemsById[(int) $item->ID] = [
                'id' => (int) $item->ID,
                'parent' => (int) $item->menu_item_parent,
                'title' => $item->title,
                'url' => $item->url,
                'target' => $item->target,
                'description' => $item->description,
                'classes' => array_filter((array) $item->classes),
                'children' => [],
            ];
        }

        $tree = [];

        foreach ($itemsById as $id => &$item) {
            if ($item['parent'] && isset($itemsById[$item['parent']])) {
                $itemsById[$item['parent']]['children'][] = &$item;

                continue;
            }

            $tree[] = &$item;
        }

        unset($item);

        return $tree;
    }

}
