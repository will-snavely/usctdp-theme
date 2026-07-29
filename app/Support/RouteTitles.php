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
    ];

    public static function for(?string $routeName, ?string $ageGroup = null, ?string $type = null): ?string
    {
        if ($routeName === 'programs.archive') {
            return self::programsTitle($ageGroup, $type);
        }

        if (!$routeName || !isset(self::TITLES[$routeName])) {
            return null;
        }

        return self::TITLES[$routeName];
    }

    private static function programsTitle(?string $ageGroup, ?string $type): string
    {
        $title = match ($ageGroup) {
            'adults' => 'Adults',
            'juniors' => 'Juniors',
            default => 'Programming',
        };

        if ($type) {
            $title .= ': ' . ucfirst($type);

            if ($type === 'cardio') {
                $title .= ' Tennis';
            } else {
                $title .= 's';
            }
        }

        return $title;
    }
}
