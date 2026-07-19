<?php

namespace App\Support;

/**
 * Titles for named routes (routes/web.php) that have no backing WP post to
 * pull a title from. Shared by the page-header composer and the document
 * <title> filter so the two stay in sync.
 */
class RouteTitles
{
    protected const TITLES = [
        'staff.single' => 'Our Team',
        'programs.juniors' => 'Juniors',
        'programs.juniors.type' => 'Juniors',
        'programs.adults' => 'Adults',
        'programs.adults.type' => 'Adults',
    ];

    /**
     * Route names whose {type} segment (e.g. "camp") should be appended to the title.
     */
    protected const TYPE_SUFFIXED_ROUTES = [
        'programs.juniors.type',
        'programs.adults.type',
    ];

    public static function for(?string $routeName, ?string $type = null): ?string
    {
        if (!$routeName || !isset(self::TITLES[$routeName])) {
            return null;
        }

        $title = self::TITLES[$routeName];

        if ($type && in_array($routeName, self::TYPE_SUFFIXED_ROUTES, true)) {
            $title .= ': ' . ucfirst($type);

            if( $type === 'cardio') {
                $title .= ' Tennis';
            } else {
                $title .= 's';
            }
        }

        return $title;
    }
}
