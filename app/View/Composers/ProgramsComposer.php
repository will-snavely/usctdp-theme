<?php

namespace App\View\Composers;
use App\Repositories\ProgramsRepository;
use Roots\Acorn\View\Composer;
use Illuminate\View\View;

class ProgramsComposer extends Composer
{
    /**
     * The Blade templates this composer applies to.
     * Matches resources/views/pages/juniors.blade.php
     */
    protected static $views = [
        'programs.archive',
    ];

    protected ProgramsRepository $repository;

    public function __construct(ProgramsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function with(): array
    {
        $audience = $this->data->get('audience', 'juniors');
        $levels  = $this->repository->getLevelsForAudience($audience);
        $types   = $this->repository->getTypesForAudience($audience);
        $filters  = $this->resolveFilters($audience);
        $programs = $this->repository->getProgramming($audience, $filters);
        return [
            'audience'      => $audience,
            'programs'      => array_values($programs['products']),
            'activeFilters' => $filters,
            'seasons'       => $this->buildSeasons(),
            'levels'        => $levels,
            'types'         => $types,
        ];
    }

    private function resolveActiveSeason(): string
    {
        $allowed = ['spring', 'summer'];
        $param = sanitize_key($_GET['season'] ?? '');

        if (in_array($param, $allowed, true)) {
            return $param;
        }

        return 'spring';
    }

    /**
     * Resolve audience from the page slug.
     * Expects the WordPress page slug to be 'juniors' or 'adults'.
     * Adjust this logic to match however your Sage routes expose audience.
     */
    private function resolveAudience(): string
    {
        $slug = request()->route('audience');
        error_log("Resolving audience from slug: " . $slug);
        if($slug === 'adults' || $slug === 'juniors') {
            return $slug;
        }
        return '';
    }

    /**
     * Read, sanitize, and validate query params against allowed values.
     * Returns only params that are explicitly set and valid — unset params
     * are omitted so the repository treats them as "no filter".
     */
    private function resolveFilters(string $audience): array
    {
        $filters = [];
        $allowed = [
            'season' => ['spring', 'summer'],
            'type'   => $this->allowedTypes($audience),
            'level'  => array_column(
                $this->repository->getLevelsForAudience($audience),
                'value'
            ),
        ];

        foreach ($allowed as $param => $validValues) {
            $value = sanitize_key($_GET[$param] ?? '');
            if ($value !== '' && in_array($value, $validValues, true)) {
                $filters[$param] = $value;
            }
        }

        return $filters;
    }

    private function allowedTypes(string $audience): array
    {
        $types = ['clinic', 'camp', 'tournament'];
        if ($audience === 'adults') {
            $types[] = 'cardio';
        }
        return $types;
    }

    private function buildSeasons(): array
    {
        return [
            [
                'value'   => 'spring',
                'label'   => 'Spring',
                'session' => 'May 4 - June 7, 2026 · 5 Weeks',
            ],
            [
                'value'   => 'summer',
                'label'   => 'Summer',
                'session' => 'June 8 - August 2, 2026 · 8 Weeks',
            ],
        ];
    }
}
