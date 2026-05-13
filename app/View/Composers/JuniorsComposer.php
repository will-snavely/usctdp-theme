<?php

namespace App\View\Composers;
use App\Repositories\ProgramRepository;
use Roots\Acorn\View\Composer;

/**
 * JuniorsComposer
 *
 * Binds all data needed by resources/views/pages/juniors.blade.php.
 *
 * Sage 11 composers extend Roots\Acorn\View\Composer. The $views array
 * tells Acorn which Blade templates this composer should run for.
 *
 * Registration:
 *   Sage auto-discovers composers in app/View/Composers/ — no manual
 *   registration needed as long as this class is autoloaded via Composer.
 *   If you have disabled auto-discovery, add this to config/view.php:
 *
 *     'composers' => [
 *         App\View\Composers\JuniorsComposer::class,
 *     ],
 */
class JuniorsComposer extends Composer
{
    /**
     * The Blade templates this composer applies to.
     * Matches resources/views/pages/juniors.blade.php
     */
    protected static $views = [
        'pages.juniors',
    ];

    protected ProgramRepository $repository;

    public function __construct(ProgramRepository $repository)
    {
        $this->repository = $repository;
    }

    public function with(): array
    {
        $requestedSeason = $this->resolveActiveSeason();

        $juniorActivities = $this->repository->getActivities([
            'is_active' => 1,
            'categories' => [1, 2]
        ]);
        $juniorProducts = [];
        $levels = [];
        foreach ($juniorActivities as $activity) {
            $product_id = $activity->product_id;
            $dayShort = $this->repository->intToDayOfWeekShort($activity->day_of_week);
            $dayFull = $this->repository->intToDayOfWeekFull($activity->day_of_week);
            $levelColor = $this->repository->getLevelColor($activity->product_level);
            $pricing = json_decode($activity->product_pricing, true);
            if (!isset($juniorProducts[$product_id])) {

                $juniorProducts[$product_id] = [
                    "id" => $product_id,
                    "name" => $activity->product_name,
                    "description" => $activity->product_description,
                    "short_description" => $activity->product_short_description,
                    "level" => $activity->product_level,
                    "level_label" => $activity->product_level,
                    "ball_color" => $levelColor,
                    "age_group" => $activity->product_age_group,
                    "age_range" => $activity->product_age_range,
                    "woocommerce_id" => $activity->product_woocommerce_id,
                    "product_url" => get_permalink($activity->product_woocommerce_id),
                    "season" => $activity->session_season,
                    "price_one_day" => floatval($pricing["One"]),
                    "price_two_day" => floatval($pricing["Two"]),
                    "schedule" => [],
                    "schedule_days" => []
                ];
            }
            $juniorProducts[$product_id]['schedule'][] = [
                'day' => $dayShort,
                'day_full' => $dayFull,
                'time' => $activity->start_time . ' - ' . $activity->end_time
            ];
            $juniorProducts[$product_id]['schedule_days'][$dayShort] = 1;

            if (!isset($levels[$activity->product_level])) {
                $levels[$activity->product_level] = [
                    "level" => $activity->product_level,
                    "label" => $activity->product_level,
                    "color" => $levelColor,
                ];
            }
        }


        error_log(print_r($requestedSeason, true));
        return [
            'programs' => array_values($juniorProducts),
            'levels' => array_values($levels),
            'seasons' => $this->buildSeasonOptions(),
            'activeSeason' => $requestedSeason,
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
    private function buildSeasonOptions(): array
    {
        return [
            [
                'value' => 'spring',
                'label' => 'Spring',
                'session' => 'May 4 - June 7, 2026 • 5 Weeks',
            ],
            [
                'value' => 'summer',
                'label' => 'Summer',
                'session' => 'June 8 - August 2, 2026 • 8 Weeks',
            ],
        ];
    }
}
