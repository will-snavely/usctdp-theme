<?php

namespace App\Repositories;

class ProgramsRepository
{
    public function getActivities($args)
    {
        global $wpdb;

        $where_clause = '';
        $where_args = [];
        $conditions = [];

        $conditions[] = "sess.is_active = %d";
        $where_args[] = 1;

        if (isset($args["season"]) && $args["season"]) {
            $conditions[] = "sess.season = %s";
            $where_args[] = $args['season'];
        }

        if (isset($args["audience"])) {
            $conditions[] = "prod.age_group = %s";
            $where_args[] = $args["audience"];
        }

        if (isset($args["type"])) {
            $conditions[] = "prod.type = %s";
            $where_args[] = $args['type'];
        }

        if (isset($args["level"])) {
            $conditions[] = "prod.level = %s";
            $where_args[] = $args['level'];
        }

        if ($conditions) {
            $where_clause = "WHERE " . implode(" AND ", $conditions);
        }

        $query = $wpdb->prepare(
            "   SELECT
                    act.id as activity_id, 
                    act.title as activity_name, 
                    act.type as activity_type,
                    clinic.day_of_week as day_of_week,
                    clinic.start_time as start_time,
                    clinic.end_time as end_time,
                    sess.id as session_id, 
                    sess.title as session_name,
                    sess.start_date as session_start_date, 
                    sess.end_date as session_end_date,
                    sess.num_weeks as session_num_weeks, 
                    sess.category as session_category,
                    sess.season as session_season,
                    prod.wp_image_id as product_image_id,
                    prod.title as product_name,
                    prod.id as product_id,
                    prod.level as product_level,
                    prod.type as product_type,
                    prod.description as product_description,
                    prod.short_description as product_short_description,
                    prod.age_group as product_age_group,
                    prod.age_range as product_age_range,
                    prod.woocommerce_id as product_woocommerce_id,
                    pricing.pricing as product_pricing
                FROM {$wpdb->prefix}usctdp_activity AS act
                JOIN {$wpdb->prefix}usctdp_clinic AS clinic ON act.id = clinic.id
                JOIN {$wpdb->prefix}usctdp_session AS sess ON act.session_id = sess.id
                JOIN {$wpdb->prefix}usctdp_product AS prod ON act.product_id = prod.id
                JOIN {$wpdb->prefix}usctdp_pricing AS pricing ON (prod.id = pricing.product_id AND sess.id = pricing.session_id)
                {$where_clause}
                ORDER BY act.id ASC",
            $where_args
        );
        error_log("Executing query: " . $query);
        return $wpdb->get_results($query);
    }
    
    private function getEmptySchedule()
    {
        return [
            1 => ['day' => 'Mon', 'day_full' => 'Monday', 'times' => []],
            2 => ['day' => 'Tue', 'day_full' => 'Tuesday', 'times' => []],
            3 => ['day' => 'Wed', 'day_full' => 'Wednesday', 'times' => []],
            4 => ['day' => 'Thu', 'day_full' => 'Thursday', 'times' => []],
            5 => ['day' => 'Fri', 'day_full' => 'Friday', 'times' => []],
            6 => ['day' => 'Sat', 'day_full' => 'Saturday', 'times' => []],
            7 => ['day' => 'Sun', 'day_full' => 'Sunday', 'times' => []],
        ];
    }
    public function getProgramming($audience, $season, $filters)
    {
        $args = array_merge(['audience' => $audience, 'season' => $season], $filters);
        $activities = $this->getActivities($args);
        $products = [];
        $levels = [];
        foreach ($activities as $activity) {
            $product_id = $activity->product_id;
            $dayOfWeek = $this->intToDayOfWeek($activity->day_of_week);
            $dayShort = $dayOfWeek[1];
            $levelColor = $this->getLevelColor($activity->product_level);
            $pricing = json_decode($activity->product_pricing, true);
            if (!isset($products[$product_id])) {
                $products[$product_id] = [
                    "id" => $product_id,
                    "name" => $activity->product_name,
                    "description" => $activity->product_description,
                    "short_description" => $activity->product_short_description,
                    "image_id" => $activity->product_image_id,
                    "level" => strtolower($activity->product_level),
                    "level_label" => ucfirst(strtolower($activity->product_level)),
                    "type" => strtolower($activity->product_type),
                    "ball_color" => $levelColor,
                    "age_group" => $activity->product_age_group,
                    "age_range" => $activity->product_age_range,
                    "woocommerce_id" => $activity->product_woocommerce_id,
                    "product_url" => get_permalink($activity->product_woocommerce_id),
                    "season" => $activity->session_season,
                    "price_one_day" => floatval($pricing["One"]),
                    "price_two_day" => floatval($pricing["Two"]),
                    "schedule" => $this->getEmptySchedule(),
                    "sessions" => [],
                    "schedule_days" => []
                ];
            }
            $start_time = strtotime($activity->start_time);
            $end_time = strtotime($activity->end_time);
            $start_time_str = date('g:i A', $start_time);
            $end_time_str = date('g:i A', $end_time);

            $products[$product_id]['schedule'][$activity->day_of_week]['times'][$start_time] = [
                'start_time' => $start_time_str,
                'end_time' => $end_time_str
            ];
            $products[$product_id]['schedule_days'][$dayShort] = 1;

            $session_title = $activity->session_name;
            $session_start = strtotime($activity->session_start_date);
            $session_end = strtotime($activity->session_end_date);
            $products[$product_id]['sessions'][$session_start] = [
                'title' => $session_title,
                'start_date' => date('M j, Y', $session_start),
                'end_date' => date('M j, Y', $session_end),
            ];

            if (!isset($levels[$activity->product_level])) {
                $levels[$activity->product_level] = [
                    "level" => strtolower($activity->product_level),
                    "label" => $activity->product_level,
                    "color" => $levelColor,
                ];
            }
        }
        foreach ($products as &$product) {
            ksort($product['schedule']);
            ksort($product['sessions']);
            foreach ($product['schedule'] as &$day) {
                ksort($day['times']);
            }
        }
        return [
            "products" => $products,
            "levels" => $levels
        ];
    }

    public function intToDayOfWeek($int)
    {
        $days = [
            1 => ["Monday", "Mon"],
            2 => ["Tuesday", "Tue"],
            3 => ["Wednesday", "Wed"],
            4 => ["Thursday", "Thu"],
            5 => ["Friday", "Fri"],
            6 => ["Saturday", "Sat"],
            7 => ["Sunday", "Sun"]
        ];
        return isset($days[$int]) ? $days[$int] : "";
    }

    public function getLevelColor($level)
    {
        $colors = [
            "beginner"     => "#e03535",
            "intermediate" => "#e87722",
            "advanced"     => "#3a9e5f",
        ];
        return $colors[strtolower($level)] ?? "#3893de";
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
