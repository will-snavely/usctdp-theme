<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use App\Repositories\StaffRepository;

/**
 * Bind data to the single-staff template (views/staff/single.blade.php).
 *
 * Register in config/view.php:
 *
 *   \App\View\Composers\StaffSingleComposer::class => ['staff.single'],
 *
 * The staff ID is expected as a query var: e.g. ?staff_id=5
 * Wire this up however fits your routing — a rewrite rule, a page template,
 * or a custom endpoint. The composer just reads the query var.
 */
class StaffSingleComposer extends Composer
{

    /**
     * List of views served by this composer.
     */
    protected static $views = [
        'staff.single',
    ];

    public function with(): array
    {
        $id = (int) get_query_var('staff_id', 0);
        $slug = get_query_var('name', '');

        return [
            'member' => $id ? StaffRepository::find($id) : ($slug ? StaffRepository::findBySlug($slug) : null),
        ];
    }
}
