<?php

namespace App\View\Composers;

use App\Repositories\ProgramsRepository;
use Roots\Acorn\View\Composer;

class ProgramsComposer extends Composer
{
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
        $routeType = $this->data->get('type');  // set by type-URL routes, e.g. /juniors/clinic/
        $levels = $this->repository->getLevelsForAudience($audience);
        $types = $this->repository->getTypesForAudience($audience);
        $filters = $this->resolveFilters($audience, [], $routeType);
        $programs = $this->repository->getProgramming($audience, '', $filters);

        $mailerKey = $audience === 'adults' ? 'usctdp_adult_mailers' : 'usctdp_junior_mailers';
        $mailers = json_decode(get_option($mailerKey, '[]'), true) ?: [];

        // Type labels for breadcrumb display.
        $typeLabels = collect($types)->pluck('label', 'value')->toArray();
        $routeTypeLabel = $routeType ? ($typeLabels[$routeType] ?? ucfirst($routeType)) : null;

        // Base URL for the audience page (used for type-pill navigation + breadcrumb back-link).
        $audienceBaseUrl = home_url('/programming/' . $audience . '/');

        // Filters that came from the user (query params only, not the route-passed type).
        $userFilters = array_filter($filters, fn($k) => $k !== 'type', ARRAY_FILTER_USE_KEY);

        return [
            'audience' => $audience,
            'programs' => array_values($programs['products']),
            'activeFilters' => $filters,
            'userFilters' => $userFilters,
            'levels' => $levels,
            'types' => $types,
            'mailers' => $mailers,
            'routeType' => $routeType,
            'routeTypeLabel' => $routeTypeLabel,
            'audienceBaseUrl' => $audienceBaseUrl,
            'accents' => $this->getAccents(),
        ];
    }

    private function getAccents() {
      return [
            "tinytots" => [
                "card-bg" => "#e03535",
                "icon" => "red-ball.svg",
            ],
            "red-pre" => [
                "card-bg" => "#e03535",
                "icon" => "red-ball.svg",
            ],
            "red" => [
                "card-bg" => "#e03535",
                "icon" => "red-ball.svg",
            ],
            "orange-pre" => [
                "card-bg" => "#f9a54c",
                "icon" => "orange-ball.svg",
            ],
            "teen" => [
                "card-bg" => "#e03535",
                "icon" => "red-ball.svg",
            ],
            "orange" => [
                "card-bg" => "#f9a54c",
                "icon" => "orange-ball.svg",
            ],
            "green" => [
                "card-bg" => "#3a9e5f",
                "icon" => "green-ball.svg",
            ],
            "yellow" => [
                "card-bg" => "#fcd12a",
                "icon" => "yellow-ball.svg",
            ],
            "yellow-open" => [
                "card-bg" => "#fcd12a",
                "icon" => "yellow-ball.svg",
            ],
            "adult1" => [
                "card-bg" => "#e03535",
                "icon" => "red-ball.svg",
            ],
            "adult2" => [
                "card-bg" => "#f9a54c",
                "icon" => "orange-ball.svg",
            ],
            "adult3" => [
                "card-bg" => "#3a9e5f",
                "icon" => "green-ball.svg",
            ],
            "adult4" => [
                "card-bg" => "#fcd12a",
                "icon" => "yellow-ball.svg",
            ],
            "cardio" => [
                "card-bg" => "#3a9e5f",
                "icon" => "cardio.svg",
            ],
        ];
    }

    /**
     * Read, sanitize, and validate query params against allowed values.
     * When $routeType is provided it is injected directly into filters,
     * bypassing the query param for 'type'.
     */
    private function resolveFilters(string $audience, array $seasons, ?string $routeType): array
    {
        $filters = [];

        // Route-passed type is authoritative; query param cannot override it.
        if ($routeType && in_array($routeType, $this->allowedTypes($audience), true)) {
            $filters['type'] = $routeType;
        }

        $allowed = [
            'season' => array_column($seasons, 'value'),
            'level' => array_column($this->repository->getLevelsForAudience($audience), 'value'),
        ];

        // Only allow type from query param when no route type is set.
        if (!$routeType) {
            $allowed['type'] = $this->allowedTypes($audience);
        }

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
        if ($audience === 'adults') {
            return ['clinic', 'cardio', 'tournament'];
        }
        return ['clinic', 'camp', 'tournament'];
    }
}
