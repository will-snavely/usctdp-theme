<?php

namespace App\Repositories;

class ProgramsRepository
{
    public function getClinics($args)
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
            $conditions[] = "(prod.level = %s OR prod.level='varies')";
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
                    act.meta as activity_meta,
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
                    sess.meta as session_meta,
                    prod.wp_image_id as product_image_id,
                    prod.title as product_name,
                    prod.code as product_code,
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
        return $wpdb->get_results($query);
    }

    public function getTournaments($args)
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
            $conditions[] = "(prod.level = %s OR prod.level='varies')";
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
                    act.meta as activity_meta,
                    tourn.start_date as tournament_start_date,
                    tourn.start_date_addtl as tournament_start_date_addtl,
                    tourn.registration_deadline as tournament_registration_deadline,
                    tourn.early_registration_deadline as tournament_early_registration_deadline,
                    tourn.schedule as tournament_schedule,
                    sess.id as session_id,
                    sess.title as session_name,
                    sess.start_date as session_start_date,
                    sess.end_date as session_end_date,
                    sess.num_weeks as session_num_weeks,
                    sess.category as session_category,
                    sess.season as session_season,
                    sess.meta as session_meta,
                    prod.wp_image_id as product_image_id,
                    prod.title as product_name,
                    prod.code as product_code,
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
                JOIN {$wpdb->prefix}usctdp_tournament AS tourn ON act.id = tourn.id
                JOIN {$wpdb->prefix}usctdp_session AS sess ON act.session_id = sess.id
                JOIN {$wpdb->prefix}usctdp_product AS prod ON act.product_id = prod.id
                JOIN {$wpdb->prefix}usctdp_pricing AS pricing ON (prod.id = pricing.product_id AND sess.id = pricing.session_id)
                {$where_clause}
                ORDER BY tourn.start_date ASC",
            $where_args
        );
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
    private function ensureProduct(&$products, $row)
    {
        $product_id = $row->product_id;
        if (!isset($products[$product_id])) {
            $products[$product_id] = [
                "id" => $product_id,
                "name" => $row->product_name,
                "code" => $row->product_code,
                "description" => $row->product_description,
                "short_description" => $row->product_short_description,
                "image_id" => $row->product_image_id,
                "level" => strtolower($row->product_level),
                "level_label" => ucfirst(strtolower($row->product_level)),
                "type" => strtolower($row->product_type),
                "ball_color" => $this->getLevelColor($row->product_level),
                "age_group" => $row->product_age_group,
                "age_range" => $row->product_age_range,
                "woocommerce_id" => $row->product_woocommerce_id,
                "product_url" => get_permalink($row->product_woocommerce_id),
                "season" => $row->session_season,
                "schedule" => $this->getEmptySchedule(),
                "sessions" => [],
                "schedule_days" => []
            ];
        }
        return $product_id;
    }

    private function addLevel(&$levels, $product_level)
    {
        if (!isset($levels[$product_level])) {
            $levels[$product_level] = [
                "level" => strtolower($product_level),
                "label" => $product_level,
                "color" => $this->getLevelColor($product_level),
            ];
        }
    }

    private function addTournamentToProducts(&$products, &$levels, $tournament)
    {
        $product_id = $this->ensureProduct($products, $tournament);

        $scheduleEntries = json_decode($tournament->tournament_schedule, true) ?: [];
        foreach ($scheduleEntries as $entry) {
            $dayOfWeek = isset($entry['day']) ? $this->dayNameToInt($entry['day']) : null;
            if (!$dayOfWeek || empty($entry['startTime']) || empty($entry['endTime'])) {
                continue;
            }
            $start_time = strtotime($entry['startTime']);
            $end_time = strtotime($entry['endTime']);
            $products[$product_id]['schedule'][$dayOfWeek]['times'][$start_time] = [
                'start_time' => date('g:i A', $start_time),
                'end_time' => date('g:i A', $end_time),
                'level_label' => null,
                'level_color' => null,
                'note' => $entry['description'] ?? null,
            ];
            $products[$product_id]['schedule_days'][$this->intToDayOfWeek($dayOfWeek)[1]] = 1;
        }

        $session_start = strtotime($tournament->session_start_date);
        $session_end = strtotime($tournament->session_end_date);
        $sessionMeta = json_decode($tournament->session_meta, true) ?: [];
        $products[$product_id]['sessions'][$session_start] = [
            'title' => $tournament->session_name,
            'start_date' => date('M j, Y', $session_start),
            'end_date' => date('M j, Y', $session_end),
            'note' => $sessionMeta['note'] ?? null,
        ];

        $this->addLevel($levels, $tournament->product_level);
    }

    public function getProgramming($audience, $season, $filters)
    {
        $args = array_merge(['audience' => $audience, 'season' => $season], $filters);
        $activities = $this->getClinics($args);
        $tournaments = $this->getTournaments($args);
        $products = [];
        $levels = [];
        foreach ($activities as $activity) {
            $product_id = $this->ensureProduct($products, $activity);
            $dayOfWeek = $this->intToDayOfWeek($activity->day_of_week);
            $dayShort = $dayOfWeek[1];
            $start_time = strtotime($activity->start_time);
            $end_time = strtotime($activity->end_time);
            $start_time_str = date('g:i A', $start_time);
            $end_time_str = date('g:i A', $end_time);

            $activityMeta = json_decode($activity->activity_meta, true) ?: [];
            $activityLevel = $activityMeta['level'] ?? null;

            $products[$product_id]['schedule'][$activity->day_of_week]['times'][$start_time] = [
                'start_time' => $start_time_str,
                'end_time' => $end_time_str,
                'level_label' => $activityLevel ? $this->formatLevelLabel($activityLevel) : null,
                'level_color' => $activityLevel ? $this->getLevelColor($activityLevel) : null,
                'note' => $activityMeta['note'] ?? null,
            ];
            $products[$product_id]['schedule_days'][$dayShort] = 1;

            $session_title = $activity->session_name;
            $session_start = strtotime($activity->session_start_date);
            $session_end = strtotime($activity->session_end_date);
            $sessionMeta = json_decode($activity->session_meta, true) ?: [];
            $products[$product_id]['sessions'][$session_start] = [
                'title' => $session_title,
                'start_date' => date('M j, Y', $session_start),
                'end_date' => date('M j, Y', $session_end),
                'note' => $sessionMeta['note'] ?? null,
            ];

            $this->addLevel($levels, $activity->product_level);
        }
        foreach ($tournaments as $tournament) {
            $this->addTournamentToProducts($products, $levels, $tournament);
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

    public function dayNameToInt($day)
    {
        $days = [
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6,
            'sunday' => 7,
        ];
        return $days[strtolower(trim((string) $day))] ?? null;
    }

    public function getLevelColor($level)
    {
        $colors = [
            "beginner"     => "#e03535",
            "intermediate" => "#e87722",
            "advanced"     => "#3a9e5f",
            "varies"       => "#466be5",
        ];
        return $colors[strtolower($level)] ?? "#3893de";
    }

    public function formatLevelLabel($level)
    {
        $words = explode(' ', strtolower(trim($level)));
        $words = array_map(fn($word) => $word === 'to' ? $word : ucfirst($word), $words);
        return implode(' ', $words);
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
