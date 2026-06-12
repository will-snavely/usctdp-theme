<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ProgrammingComposer extends Composer
{
    protected static $views = [
        'pages.programming',
    ];

    public function with(): array
    {
        return [
            'juniorMailers' => $this->getMailers('usctdp_junior_mailers'),
            'adultMailers'  => $this->getMailers('usctdp_adult_mailers'),
        ];
    }

    private function getMailers(string $optionKey): array
    {
        $json = get_option($optionKey, '[]');
        return json_decode($json, true) ?: [];
    }
}
