<?php

namespace App\View\Composers;

use App\Support\FilterUrl;
use Roots\Acorn\View\Composer;

class Shop extends Composer
{
    protected static $views = [
        'woocommerce.archive-product',
        'woocommerce.taxonomy-product_cat',
    ];

    private const LEVEL_COLORS = [
        'beginner' => '#e03535',
        'intermediate' => '#e87722',
        'advanced' => '#3a9e5f',
    ];

    private function termOptions($terms, $term_order, array $colors = [])
    {
        $by_slug = [];
        foreach ($terms as $term) {
            $by_slug[$term->slug] = $term;
        }
        $options = [];
        foreach ($term_order as $slug) {
            if (isset($by_slug[$slug])) {
                $option = ['value' => $slug, 'label' => $by_slug[$slug]->name];
                if (isset($colors[$slug])) {
                    $option['color'] = $colors[$slug];
                }
                $options[] = $option;
            }
        }
        return $options;
    }

    public function getEventTypeOptions()
    {
        $terms = get_terms(['taxonomy' => 'event_type', 'hide_empty' => true]);
        return $this->termOptions($terms, ['clinic', 'tournament', 'cardio-tennis']);
    }

    public function getSkillLevelOptions()
    {
        $terms = get_terms(['taxonomy' => 'skill_level', 'hide_empty' => true]);
        return $this->termOptions($terms, ['beginner', 'intermediate', 'advanced'], self::LEVEL_COLORS);
    }

    public function getAgeGroupOptions()
    {
        $terms = get_terms(['taxonomy' => 'age_group', 'hide_empty' => true]);
        return $this->termOptions($terms, ['juniors', 'adults']);
    }

    public function with()
    {
        $groups = [
            ['label' => 'Age', 'param' => 'age_group', 'options' => $this->getAgeGroupOptions()],
            ['label' => 'Type', 'param' => 'event_type', 'options' => $this->getEventTypeOptions()],
            ['label' => 'Level', 'param' => 'skill_level', 'options' => $this->getSkillLevelOptions()],
        ];

        // Only carry through $_GET values that match a known param/option-value pair.
        $activeFilters = [];
        foreach ($groups as $group) {
            $value = sanitize_key($_GET[$group['param']] ?? '');
            if ($value !== '' && in_array($value, array_column($group['options'], 'value'), true)) {
                $activeFilters[$group['param']] = $value;
            }
        }

        $baseUrl = get_post_type_archive_link('product');

        return [
            'groups' => $groups,
            'active_filters' => $activeFilters,
            'clear_url' => $baseUrl,
            'filter_url' => fn (string $param, string $value) => FilterUrl::toggle($activeFilters, $param, $value, $baseUrl),
        ];
    }
}
