<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use App\Repositories\StaffRepository;

/**
 * Bind data to the staff archive template (views/staff/archive.blade.php).
 *
 * Register in config/view.php:
 *
 *   \App\View\Composers\StaffArchiveComposer::class => ['staff.archive'],
 */
class StaffArchiveComposer extends Composer
{
    /**
     * List of views served by this composer.
     */
    protected static $views = [
        'staff.archive',
    ];

    public function with(): array
    {
        return [
            'staff' => StaffRepository::all(),
        ];
    }
}
