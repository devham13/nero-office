<?php
/**
 * CTA helpers for Nero longread pages (env resolution + external link attrs).
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('nero_ai_resolve_env')) {
    function nero_ai_resolve_env(string $key): string
    {
        $candidates = [
            getenv($key),
            $_ENV[$key] ?? null,
            $_SERVER[$key] ?? null,
        ];

        foreach ($candidates as $value) {
            if (is_string($value) && $value !== '') {
                return $value;
            }
        }

        return '';
    }
}

if (!function_exists('nero_ai_external_link_attrs')) {
    function nero_ai_external_link_attrs(string $url): string
    {
        if (!str_starts_with($url, 'http')) {
            return '';
        }

        $home = home_url();
        if ($home !== '' && str_starts_with($url, $home)) {
            return '';
        }

        return ' target="_blank" rel="noopener noreferrer"';
    }
}
