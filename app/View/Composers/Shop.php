<?php
 
namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Shop extends Composer
{
    protected static $views = [
        'woocommerce.archive-product',
        'woocommerce.taxonomy-product_cat',
    ];

    private function orderTerms($terms, $term_order) {
        $by_slug = [];
        foreach($terms as $term) {
            $by_slug[$term->slug] = $term;
        }
        $result = [];
        foreach($term_order as $term) {
            if(isset($by_slug[$term])) {
                $result[] = $by_slug[$term];
            }
        }
        return $result;
    }

    public function getEventTerms() {
        $terms = get_terms(['taxonomy' => 'event_type', 'hide_empty' => true]);
        return $this->orderTerms($terms, ['clinic', 'cardio-tennis', 'tournament']);
    }

    public function getLevelTerms() {
        $terms = get_terms(['taxonomy' => 'skill_level', 'hide_empty' => true]);
        return $this->orderTerms($terms, ['beginner', 'intermediate', 'advanced']);
    }

    public function getAgeGroupTerms() {
        $terms = get_terms(['taxonomy' => 'age_group', 'hide_empty' => true]);
        return $this->orderTerms($terms, ['junior', 'adult']); 
    }

    public function with()
    {
        return [
            'event_types' => $this->getEventTerms(),
            'age_groups'  => $this->getAgeGroupTerms(), 
            'skill_levels'=> $this->getLevelTerms(), 
            'active_filters' => $_GET, 
            'filter_url' => function ($taxonomy, $term_slug) {
                $params = $_GET;
                if (isset($params[$taxonomy]) && $params[$taxonomy] === $term_slug) {
                    unset($params[$taxonomy]);
                } else {
                    $params[$taxonomy] = $term_slug;
                }
                return add_query_arg(array_filter($params), get_permalink(wc_get_page_id('shop')));
            },
        ];
    }
}
