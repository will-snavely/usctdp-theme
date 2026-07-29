<?php

namespace App\Support;

class FilterUrl
{
    /**
     * Build a filter-pill URL that toggles a param/value pair on or off
     * against the given base URL, preserving all other current params.
     */
    public static function toggle(array $currentParams, string $param, string $value, string $baseUrl): string
    {
        $params = $currentParams;

        if (isset($params[$param]) && $params[$param] === $value) {
            unset($params[$param]);
        } else {
            $params[$param] = $value;
        }

        return $params ? add_query_arg($params, $baseUrl) : $baseUrl;
    }
}
