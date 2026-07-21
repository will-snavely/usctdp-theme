<?php

namespace App\Repositories;

class ProgramsRepository
{
    public function getProgramming($audience, $filters)
    {
        global $wpdb;

        $conditions = ["age_group = %s"];
        $where_args = [$audience];

        if (isset($filters["type"])) {
            $conditions[] = "type = %s";
            $where_args[] = $filters['type'];
        }

        if (isset($filters["level"])) {
            $conditions[] = "(level = %s OR level = 'varies')";
            $where_args[] = $filters['level'];
        }

        $where_clause = "WHERE " . implode(" AND ", $conditions);

        $query = $wpdb->prepare(
            "SELECT product_id, woocommerce_id, data
                FROM {$wpdb->prefix}usctdp_program_schedule
                {$where_clause}
                ORDER BY product_id ASC",
            $where_args
        );
        $rows = $wpdb->get_results($query);

        $products = [];
        foreach ($rows as $row) {
            $program = json_decode($row->data, true);
            $program['product_url'] = get_permalink($row->woocommerce_id);
            $products[$row->product_id] = $program;
        }
        return $products;
    }

    public function getLevelsForAudience(string $audience): array
    {
        return [
            ['value' => 'beginner', 'label' => 'Beginner', 'color' => '#e03535'],
            ['value' => 'intermediate', 'label' => 'Intermediate', 'color' => '#e87722'],
            ['value' => 'advanced', 'label' => 'Advanced', 'color' => '#3a9e5f'],
        ];
    }

    public function getTypesForAudience(string $audience): array
    {
        if ($audience === 'adults') {
            return [
                ['value' => 'clinic',      'label' => 'Clinic'],
                ['value' => 'cardio',      'label' => 'Cardio Tennis'],
                ['value' => 'tournament',  'label' => 'Tournament'],
            ];
        }

        return [
            ['value' => 'clinic',     'label' => 'Clinic'],
            ['value' => 'camp',       'label' => 'Camp'],
            ['value' => 'tournament', 'label' => 'Tournament'],
        ];
    }
}
