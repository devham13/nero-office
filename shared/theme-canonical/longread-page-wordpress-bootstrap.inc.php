<?php
/**
 * Bootstrap для page-{slug}.php AI-лендингов.
 * Добавляет body.nero-ai-landing и хелпер чтения CSS/JS из активной темы.
 */

$nero_ai_cta_helpers = __DIR__ . '/nero-ai-cta-helpers.php';
if (is_readable($nero_ai_cta_helpers)) {
    require_once $nero_ai_cta_helpers;
}

$nero_page_social_meta = __DIR__ . '/nero-page-social-meta.php';
if (is_readable($nero_page_social_meta)) {
    require_once $nero_page_social_meta;
}

if (!function_exists('nero_ai_landing_body_class')) {
    add_filter('body_class', static function (array $classes): array {
        if (!in_array('nero-ai-landing', $classes, true)) {
            $classes[] = 'nero-ai-landing';
        }
        return $classes;
    });
}

if (!function_exists('nero_ai_read_theme_asset')) {
    /**
     * @return string Содержимое файла из папки активной темы или пустая строка.
     */
    function nero_ai_read_theme_asset(string $filename): string
    {
        $path = get_stylesheet_directory() . '/' . ltrim($filename, '/');
        if (!is_readable($path)) {
            return '';
        }
        return (string) file_get_contents($path);
    }
}

if (!function_exists('nero_ai_echo_theme_styles')) {
    /**
     * Печатает inline <style> из стандартного набора ассетов темы.
     *
     * @param list<string> $extra Дополнительные css-файлы в теме (опционально).
     */
    function nero_ai_echo_theme_styles(array $extra = []): void
    {
        $assets = array_merge([
            'longread-page-kadence-layout.css',
            'nero-ai-floating-header.css',
            'longread-page-design-reference.css',
        ], $extra);

        echo "<style>\n";
        foreach ($assets as $file) {
            $css = nero_ai_read_theme_asset($file);
            if ($css !== '') {
                echo "/* ", esc_html($file), " */\n", $css, "\n";
            }
        }
        echo "</style>\n";
    }
}

if (!function_exists('nero_ai_echo_theme_scripts')) {
    /**
     * @param list<string> $files JS-файлы в теме (по умолчанию header + reveal).
     */
    function nero_ai_echo_theme_scripts(array $files = []): void
    {
        if ($files === []) {
            $files = [
                'nero-ai-floating-header.js',
                'longread-page-reveal.js',
            ];
        }
        foreach ($files as $file) {
            $js = nero_ai_read_theme_asset($file);
            if ($js === '') {
                continue;
            }
            echo "<script>\n", $js, "\n</script>\n";
        }
    }
}
