<?php

namespace App\Repositories;

/**
 * StaffRepository
 *
 * Handles all database queries for the usctdp_staff table.
 */
class StaffRepository
{
    /**
     * Return all staff members, ordered by last name.
     *
     * @return array<object>
     */
    public static function all(): array
    {
        global $wpdb;

        $table = $wpdb->prefix . 'usctdp_staff';

        $results = $wpdb->get_results(
            "SELECT * FROM {$table} ORDER BY display_order ASC, last_name ASC, first_name ASC"
        );

        return array_map([static::class, 'hydrate'], $results ?: []);
    }

    /**
     * Return a single staff member by their database ID.
     *
     * @param  int $id
     * @return object|null
     */
    public static function find(int $id): ?object
    {
        global $wpdb;

        $table = $wpdb->prefix . 'usctdp_staff';

        $row = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$table} WHERE id = %d LIMIT 1", $id)
        );

        return $row ? static::hydrate($row) : null;
    }

    /**
     * Return a single staff member by their slug.
     *
     * @param  string $slug
     * @return object|null
     */
    public static function findBySlug(string $slug): ?object
    {
        global $wpdb;
        $table = $wpdb->prefix . 'usctdp_staff';
        $row = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$table} WHERE slug = %s LIMIT 1", $slug)
        );
        return $row ? static::hydrate($row) : null;
    }

    /**
     * Return a single staff member by their WordPress user ID.
     *
     * @param  int $wp_user_id
     * @return object|null
     */
    public static function findByWpUser(int $wp_user_id): ?object
    {
        global $wpdb;

        $table = $wpdb->prefix . 'usctdp_staff';

        $row = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$table} WHERE wp_user_id = %d LIMIT 1", $wp_user_id)
        );

        return $row ? static::hydrate($row) : null;
    }

    /**
     * Decode JSON columns and attach the resolved image URL.
     *
     * @param  object $row  Raw DB row.
     * @return object       Enriched row.
     */
    private static function hydrate(object $row): object
    {
        // Decode JSON columns into arrays (fall back to empty array on failure).
        $row->roles = !empty($row->roles) ? (json_decode($row->roles, true) ?? []) : [];
        $row->faq = !empty($row->faq) ? (json_decode($row->faq, true) ?? []) : [];

        // Resolve the WordPress attachment image URL.
        $row->image_url = $row->image_id
            ? (wp_get_attachment_image_url((int) $row->image_id, 'large') ?: null)
            : null;

        // A convenience full-name string.
        $row->full_name = trim($row->first_name . ' ' . $row->last_name);

        return $row;
    }
}
