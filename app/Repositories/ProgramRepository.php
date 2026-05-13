<?php

namespace App\Repositories;

/**
 * ProgramRepository
 *
 * Wraps BerlinDB query objects to provide a clean, intention-revealing
 * interface for the rest of the application. Controllers and Composers
 * should never instantiate BerlinDB queries directly — always go through
 * here so query logic stays in one place.
 *
 * Assumptions:
 *   - Your BerlinDB Query class lives at App\DB\Queries\Programs.
 *     Adjust the use statement above to match your actual namespace.
 *   - Your BerlinDB Row object exposes at minimum:
 *       $program->id
 *       $program->name
 *       $program->description
 *       $program->level          (e.g. 'red', 'orange', 'green', 'yellow', 'tiny', 'teen')
 *       $program->ball_color     (e.g. '#e03535')
 *       $program->age_range      (e.g. 'Ages 5+')
 *       $program->audience       ('junior' | 'adult')
 *       $program->season         ('spring' | 'summer' | 'both')
 *       $program->price_one_day  (float)
 *       $program->price_two_day  (float)
 *       $program->product_url    (WooCommerce product permalink)
 *       $program->schedule       (JSON string — see note below)
 *       $program->sort_order     (int, for display ordering)
 *
 * Schedule JSON shape (array of slot objects):
 *   [
 *     { "day": "Mon", "day_full": "Monday", "time": "3:30–4:15 pm" },
 *     { "day": "Fri", "day_full": "Friday", "time": "3:30–4:15 pm" }
 *   ]
 *
 * If your schedules live in a related table instead of a JSON column,
 * replace getScheduleForProgram() below and decode accordingly.
 */
class ProgramRepository
{
    public function getActivities($args)
    {
        global $wpdb;

        $where_clause = '';
        $where_args = [];
        $conditions = [];

        if (isset($args["is_active"])) {
            $conditions[] = "sess.is_active = %d";
            $where_args[] = $args['is_active'];
        }

        if (isset($args["categories"]) && is_array($args["categories"])) {
            $categories = $args["categories"];
            $placeholders = array_fill(0, count($categories), '%d');
            $format = implode(',', $placeholders);
            $conditions[] = "sess.category IN ($format)";
            $where_args = array_merge($where_args, $categories);
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
                    prod.title as product_name, 
                    prod.id as product_id, 
                    prod.level as product_level,
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
                ORDER BY act.id DESC",
            $where_args
        );
        error_log($query);
        return $wpdb->get_results($query);
    }

    public function intToDayOfWeekFull($int)
    {
        $days = [
            1 => "Monday",
            2 => "Tuesday",
            3 => "Wednesday",
            4 => "Thursday",
            5 => "Friday",
            6 => "Saturday",
            7 => "Sunday"
        ];
        return isset($days[$int]) ? $days[$int] : "";
    }

    public function intToDayOfWeekShort($int)
    {
        $days = [
            1 => "Mon",
            2 => "Tue",
            3 => "Wed",
            4 => "Thu",
            5 => "Fri",
            6 => "Sat",
            7 => "Sun"
        ];
        return isset($days[$int]) ? $days[$int] : "";
    }

    public function getLevelColor($level)
    {
        $colors = [
            "Beginner" => "#f45757ff",
            "Intermediate" => "#3be843ff",
            "Advanced" => "#e6f23dff",
        ];
        return isset($colors[$level]) ? $colors[$level] : "#3893deff";
    }
}
