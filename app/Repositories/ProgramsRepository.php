<?php

namespace App\Repositories;

class ProgramsRepository
{
    public function getProgramming(array $filters)
    {
        global $wpdb;

        $conditions = [];
        $where_args = [];

        if (isset($filters["age_group"])) {
            $conditions[] = "age_group = %s";
            $where_args[] = $filters['age_group'];
        }

        if (isset($filters["type"])) {
            $conditions[] = "type = %s";
            $where_args[] = $filters['type'];
        }

        if (isset($filters["level"])) {
            $conditions[] = "(level = %s OR level = 'varies')";
            $where_args[] = $filters['level'];
        }

        $where_clause = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";

        $query = $conditions
            ? $wpdb->prepare(
                "SELECT product_id, woocommerce_id, data
                    FROM {$wpdb->prefix}usctdp_program_schedule
                    {$where_clause}
                    ORDER BY product_id ASC",
                $where_args
            )
            : "SELECT product_id, woocommerce_id, data
                FROM {$wpdb->prefix}usctdp_program_schedule
                ORDER BY product_id ASC";
        $rows = $wpdb->get_results($query);

        $products = [];
        foreach ($rows as $row) {
            $program = json_decode($row->data, true);
            $program['product_url'] = get_permalink($row->woocommerce_id);
            $products[$row->product_id] = $program;
        }
        return $products;
    }

    public function getAgeGroups(): array
    {
        return [
            ['value' => 'juniors', 'label' => 'Juniors'],
            ['value' => 'adults', 'label' => 'Adults'],
        ];
    }

    public function getLevels(): array
    {
        return [
            ['value' => 'beginner', 'label' => 'Beginner', 'color' => '#e03535'],
            ['value' => 'intermediate', 'label' => 'Intermediate', 'color' => '#e87722'],
            ['value' => 'advanced', 'label' => 'Advanced', 'color' => '#3a9e5f'],
        ];
    }

    public function getAllTypes(): array
    {
        return [
            ['value' => 'clinic',     'label' => 'Clinic'],
            ['value' => 'tournament', 'label' => 'Tournament'],
            ['value' => 'cardio',     'label' => 'Cardio Tennis'],
            ['value' => 'camp',       'label' => 'Camp'],
        ];
    }

    /**
     * Types available for a given age group — camp is juniors-only, cardio
     * tennis is adults-only. With no age group selected, all types show.
     */
    public function getTypesForAgeGroup(?string $ageGroup): array
    {
        $types = $this->getAllTypes();

        if ($ageGroup === 'adults') {
            return array_values(array_filter($types, fn ($type) => $type['value'] !== 'camp'));
        }

        if ($ageGroup === 'juniors') {
            return array_values(array_filter($types, fn ($type) => $type['value'] !== 'cardio'));
        }

        return $types;
    }
}
