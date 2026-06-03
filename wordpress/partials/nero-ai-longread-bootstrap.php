<?php
/**
 * Хуки для лонгридов Nero AI: body class, подключение шапки CSS/JS из темы.
 * Подключать до get_header() в каждом page-{slug}.php с .nero-ai-home-page.
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

add_filter('body_class', static function (array $classes): array {
    $classes[] = 'nero-ai-landing-shell';
    return $classes;
});

add_action('wp_head', static function (): void {
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();
    $css_path = $theme_dir . '/assets/css/nero-ai-site-header.css';

    if (!is_readable($css_path)) {
        return;
    }

    echo '<link rel="stylesheet" href="' . esc_url($theme_uri . '/assets/css/nero-ai-site-header.css?v=1.0.0') . '" />' . "\n";
}, 5);

add_action('wp_footer', static function (): void {
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();
    $js_path = $theme_dir . '/assets/js/nero-ai-site-header.js';

    if (!is_readable($js_path)) {
        return;
    }

    echo '<script src="' . esc_url($theme_uri . '/assets/js/nero-ai-site-header.js?v=1.0.0') . '" defer></script>' . "\n";
}, 5);
