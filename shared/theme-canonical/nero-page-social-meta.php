<?php
/**
 * Социальные мета-теги (Open Graph / Twitter) для page-{slug}.php.
 * og:image — не фавикон: явный URL, featured image или динамический hero-preview (MU-plugin).
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('nero_page_register_social_meta')) {
    /**
     * Регистрирует title, description и опциональный og:image для страницы.
     *
     * @param string      $title       SEO title (без суффикса сайта).
     * @param string      $description Meta description / og:description.
     * @param string|null $og_image    Абсолютный HTTPS URL превью 1200×630 (hero). null = авто.
     */
    function nero_page_register_social_meta(string $title, string $description, ?string $og_image = null): void
    {
        if ($og_image !== null && $og_image !== '') {
            $GLOBALS['nero_page_explicit_og_image'] = esc_url_raw($og_image);
        }

        add_filter(
            'document_title_parts',
            static function (array $parts) use ($title): array {
                $parts['title'] = $title;
                return $parts;
            },
            20
        );

        add_action(
            'wp_head',
            static function () use ($title, $description): void {
                $url = function_exists('nero_social_resolve_og_image_url')
                    ? nero_social_resolve_og_image_url((int) get_queried_object_id())
                    : null;

                echo '<meta name="description" content="' . esc_attr($description) . '" />' . "\n";
                echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
                echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
                echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
                echo '<meta property="og:type" content="article" />' . "\n";

                if ($url) {
                    echo '<meta property="og:image" content="' . esc_url($url) . '" />' . "\n";
                    echo '<meta property="og:image:secure_url" content="' . esc_url($url) . '" />' . "\n";
                    echo '<meta property="og:image:width" content="1200" />' . "\n";
                    echo '<meta property="og:image:height" content="630" />' . "\n";
                    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
                    echo '<meta name="twitter:image" content="' . esc_url($url) . '" />' . "\n";
                }
            },
            1
        );
    }
}
