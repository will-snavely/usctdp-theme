<?php

namespace App\View\Composers;

use App\Repositories\ProgramsRepository;
use Roots\Acorn\View\Composer;

class AudienceComposer extends Composer
{
    protected static $views = [
        'programs.juniors',
        'programs.adults',
    ];

    protected ProgramsRepository $repository;

    public function __construct(ProgramsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function with(): array
    {
        $audience  = $this->data->get('audience', 'juniors');
        $mailerKey = $audience === 'adults' ? 'usctdp_adult_mailers' : 'usctdp_junior_mailers';

        return [
            'mailers'         => json_decode(get_option($mailerKey, '[]'), true) ?: [],
            'audienceBaseUrl' => home_url('/programming/' . $audience . '/'),
        ];
    }
}
