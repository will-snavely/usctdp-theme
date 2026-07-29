<?php

namespace App\View\Composers;

use App\Repositories\ProgramsRepository;
use App\Support\FilterUrl;
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
        $ageGroups = $this->repository->getAgeGroups();
        $levels = $this->repository->getLevels();

        // Type options (and validity) depend on the selected age group — camp
        // is juniors-only, cardio tennis is adults-only — so age group must
        // resolve first.
        $ageGroup = $this->resolveParam('age_group', array_column($ageGroups, 'value'));
        $types = $this->repository->getTypesForAgeGroup($ageGroup);

        $filters = array_filter([
            'age_group' => $ageGroup,
            'type' => $this->resolveParam('type', array_column($types, 'value')),
            'level' => $this->resolveParam('level', array_column($levels, 'value')),
        ]);

        $programs = $this->repository->getProgramming($filters);

        $baseUrl = home_url('/programming/schedule/');

        return [
            'programs' => array_values($programs),
            'activeFilters' => $filters,
            'clearUrl' => $baseUrl,
            'filterUrl' => fn (string $param, string $value) => FilterUrl::toggle($filters, $param, $value, $baseUrl),
            'groups' => [
                ['label' => 'Age', 'param' => 'age_group', 'options' => $ageGroups],
                ['label' => 'Type', 'param' => 'type', 'options' => $types],
                ['label' => 'Level', 'param' => 'level', 'options' => $levels],
            ],
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
     * Read, sanitize, and validate a single query param against allowed values.
     */
    private function resolveParam(string $param, array $validValues): ?string
    {
        $value = sanitize_key($_GET[$param] ?? '');
        return ($value !== '' && in_array($value, $validValues, true)) ? $value : null;
    }
}
