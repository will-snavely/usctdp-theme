<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Navigation extends Composer
{
    /**
     * List of views served by this composer.
     */
    protected static $views = [
        'sections.header',
    ];

    /**
     * Data to be passed to view before rendering.
     */
    public function with()
    {
        return [
            'navigation' => $this->get_menu_tree(),
        ];
    }

    /**
     * Build the Recursive Menu Tree
     */
    private function get_menu_tree()
    {
        $locations = get_nav_menu_locations();
        if (!isset($locations['primary_navigation'])) {
            return [];
        }

        $menu = wp_get_nav_menu_object($locations['primary_navigation']);
        if (!$menu) {
            return [];
        }

        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_tree = [];
        $items_by_id = [];

        // First pass: Index items by ID
        foreach ($menu_items as $item) {
            $item->children = [];
            $items_by_id[$item->ID] = $item;
        }

        // Second pass: Build tree
        foreach ($items_by_id as $id => &$item) {
            if ($item->menu_item_parent && isset($items_by_id[$item->menu_item_parent])) {
                $items_by_id[$item->menu_item_parent]->children[] = &$item;
            } else {
                $menu_tree[] = &$item;
            }
        }

        return $menu_tree;
    }
}