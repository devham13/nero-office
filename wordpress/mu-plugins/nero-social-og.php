<?php
/**
 * Plugin Name: Nero Social OG (MU)
 * Description: Open Graph / Twitter: превью — скрин первого экрана (hero), не фавикон и не автогенерация.
 * Version: 1.1.0
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

final class Nero_Social_Og
{
    private const OG_WIDTH = 1200;
    private const OG_HEIGHT = 630;

    public function __construct()
    {
        add_filter('aioseo_facebook_tags', [$this, 'filter_aioseo_facebook'], 20);
        add_filter('aioseo_twitter_tags', [$this, 'filter_aioseo_twitter'], 20);
    }

    /**
     * @param array<string, string> $meta
     * @return array<string, string>
     */
    public function filter_aioseo_facebook(array $meta): array
    {
        if (!is_singular()) {
            return $meta;
        }

        $url = nero_social_resolve_og_image_url((int) get_queried_object_id());
        if ($url === null) {
            return $this->strip_bad_og_image($meta);
        }

        $meta['og:image'] = $url;
        $meta['og:image:secure_url'] = $url;
        $meta['og:image:width'] = (string) self::OG_WIDTH;
        $meta['og:image:height'] = (string) self::OG_HEIGHT;
        $meta['og:image:type'] = 'image/jpeg';

        return $meta;
    }

    /**
     * @param array<string, string> $meta
     * @return array<string, string>
     */
    public function filter_aioseo_twitter(array $meta): array
    {
        if (!is_singular()) {
            return $meta;
        }

        $url = nero_social_resolve_og_image_url((int) get_queried_object_id());
        if ($url === null) {
            return $meta;
        }

        $meta['twitter:card'] = 'summary_large_image';
        $meta['twitter:image'] = $url;

        return $meta;
    }

    /**
     * @param array<string, string> $meta
     * @return array<string, string>
     */
    private function strip_bad_og_image(array $meta): array
    {
        if (isset($meta['og:image']) && nero_social_is_bad_og_image((string) $meta['og:image'])) {
            unset($meta['og:image'], $meta['og:image:secure_url'], $meta['og:image:width'], $meta['og:image:height'], $meta['og:image:type']);
        }

        return $meta;
    }
}

if (!function_exists('nero_social_is_bad_og_image')) {
    function nero_social_is_bad_og_image(string $url): bool
    {
        $lower = mb_strtolower($url, 'UTF-8');

        foreach (['cropped-photo', 'site-icon', 'favicon', 'custom-logo', '-150x150', '-300x300', '/nero-og/'] as $needle) {
            if (strpos($lower, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('nero_social_screenshot_file_url')) {
    /** Скрин первого экрана: uploads/nero-og-screenshots/{slug}.jpg */
    function nero_social_screenshot_file_url(int $post_id): ?string
    {
        $post = get_post($post_id);
        if (!$post instanceof WP_Post || $post->post_name === '') {
            return null;
        }

        $upload = wp_upload_dir();
        $relative = 'nero-og-screenshots/' . $post->post_name . '.jpg';
        $path = trailingslashit($upload['basedir']) . $relative;

        if (!is_readable($path)) {
            return null;
        }

        return esc_url_raw(trailingslashit($upload['baseurl']) . $relative);
    }
}

if (!function_exists('nero_social_og_from_post_content')) {
    function nero_social_og_from_post_content(int $post_id): ?string
    {
        $post = get_post($post_id);
        if (!$post instanceof WP_Post) {
            return null;
        }

        $haystack = $post->post_content;
        if (preg_match('/<img[^>]+class="[^"]*nero-og-source[^"]*"[^>]+src=["\']([^"\']+)["\']/i', $haystack, $m)) {
            return esc_url_raw($m[1]);
        }
        if (preg_match('/data-nero-og-image=["\']([^"\']+)["\']/i', $haystack, $m)) {
            return esc_url_raw($m[1]);
        }

        return null;
    }
}

if (!function_exists('nero_social_resolve_og_image_url')) {
    function nero_social_resolve_og_image_url(int $post_id): ?string
    {
        if ($post_id <= 0) {
            return null;
        }

        if (!empty($GLOBALS['nero_page_explicit_og_image'])) {
            $explicit = (string) $GLOBALS['nero_page_explicit_og_image'];
            if (!nero_social_is_bad_og_image($explicit)) {
                return $explicit;
            }
        }

        $meta = get_post_meta($post_id, '_nero_og_image', true);
        if (is_string($meta) && $meta !== '' && !nero_social_is_bad_og_image($meta)) {
            return esc_url_raw($meta);
        }

        $screenshot = nero_social_screenshot_file_url($post_id);
        if ($screenshot !== null) {
            return $screenshot;
        }

        $from_content = nero_social_og_from_post_content($post_id);
        if ($from_content !== null && !nero_social_is_bad_og_image($from_content)) {
            return $from_content;
        }

        $thumb_id = (int) get_post_thumbnail_id($post_id);
        if ($thumb_id > 0) {
            $src = wp_get_attachment_image_url($thumb_id, 'large');
            if (is_string($src) && $src !== '' && !nero_social_is_bad_og_image($src)) {
                return esc_url_raw($src);
            }
        }

        $filtered = apply_filters('nero_social_og_image_url', null, $post_id);
        if (is_string($filtered) && $filtered !== '' && !nero_social_is_bad_og_image($filtered)) {
            return esc_url_raw($filtered);
        }

        return null;
    }
}

new Nero_Social_Og();
