<?php
/**
 * Plugin Name: Nero Social OG (MU)
 * Description: Open Graph / Twitter: превью hero 1200×630 вместо фавикона. Фильтр AIOSEO + динамический рендер.
 * Version: 1.0.0
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

final class Nero_Social_Og
{
    private const WIDTH = 1200;
    private const HEIGHT = 630;

    public function __construct()
    {
        add_action('init', [$this, 'register_rewrite']);
        add_action('template_redirect', [$this, 'serve_dynamic_image'], 0);
        add_filter('aioseo_facebook_tags', [$this, 'filter_aioseo_facebook'], 20);
        add_filter('aioseo_twitter_tags', [$this, 'filter_aioseo_twitter'], 20);
    }

    public function register_rewrite(): void
    {
        add_rewrite_tag('%nero_og_image%', '([0-9]+)');
        add_rewrite_rule('^nero-og/([0-9]+)\\.jpg$', 'index.php?nero_og_image=$matches[1]', 'top');
    }

    public function serve_dynamic_image(): void
    {
        $id = (int) get_query_var('nero_og_image');
        if ($id <= 0) {
            return;
        }

        $post = get_post($id);
        if (!$post instanceof WP_Post || $post->post_status !== 'publish') {
            status_header(404);
            exit;
        }

        $cache = $this->cache_path($id, $post);
        if (is_readable($cache) && (time() - (int) filemtime($cache)) < WEEK_IN_SECONDS) {
            $this->output_jpeg($cache);
        }

        $generated = $this->generate_jpeg($post, $cache);
        if ($generated === null) {
            status_header(500);
            exit;
        }

        $this->output_jpeg($generated);
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
            return $meta;
        }

        $meta['og:image'] = $url;
        $meta['og:image:secure_url'] = $url;
        $meta['og:image:width'] = (string) self::WIDTH;
        $meta['og:image:height'] = (string) self::HEIGHT;
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

    private function cache_path(int $id, WP_Post $post): string
    {
        $upload = wp_upload_dir();
        $dir = trailingslashit($upload['basedir']) . 'nero-og';
        if (!is_dir($dir)) {
            wp_mkdir_p($dir);
        }

        $hash = substr(md5($post->post_title . '|' . $post->post_modified_gmt), 0, 12);

        return $dir . '/' . $id . '-' . $hash . '.jpg';
    }

    private function generate_jpeg(WP_Post $post, string $path): ?string
    {
        if (!function_exists('imagecreatetruecolor')) {
            return null;
        }

        $im = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
        if ($im === false) {
            return null;
        }

        $bgTop = imagecolorallocate($im, 5, 7, 17);
        $bgBot = imagecolorallocate($im, 8, 11, 23);
        $cyan = imagecolorallocate($im, 121, 242, 255);
        $violet = imagecolorallocate($im, 139, 92, 246);
        $white = imagecolorallocate($im, 230, 237, 247);
        $muted = imagecolorallocate($im, 154, 168, 189);

        imagefilledrectangle($im, 0, 0, self::WIDTH, self::HEIGHT, $bgTop);
        for ($y = 0; $y < self::HEIGHT; $y++) {
            $r = (int) (5 + (8 - 5) * $y / self::HEIGHT);
            $g = (int) (7 + (11 - 7) * $y / self::HEIGHT);
            $b = (int) (17 + (23 - 17) * $y / self::HEIGHT);
            $c = imagecolorallocate($im, $r, $g, $b);
            imageline($im, 0, $y, self::WIDTH, $y, $c);
        }

        imagefilledellipse($im, 980, 120, 420, 420, $violet);
        imagefilledellipse($im, 200, 520, 360, 360, $cyan);

        for ($x = 0; $x < self::WIDTH; $x += 48) {
            imageline($im, $x, 0, $x, self::HEIGHT, imagecolorallocatealpha($im, 255, 255, 255, 115));
        }
        for ($y = 0; $y < self::HEIGHT; $y += 48) {
            imageline($im, 0, $y, self::WIDTH, $y, imagecolorallocatealpha($im, 255, 255, 255, 115));
        }

        $title = wp_strip_all_tags(get_the_title($post));
        $brand = get_bloginfo('name') ?: 'AI-автоматизация бизнеса';

        $font = $this->resolve_font();
        if ($font !== null) {
            $this->draw_wrapped_ttf($im, $title, $font, 52, $white, 72, 100, self::WIDTH - 144, 3);
            imagettftext($im, 22, 0, 72, self::HEIGHT - 72, $muted, $font, mb_substr($brand, 0, 60, 'UTF-8'));
            imagettftext($im, 18, 0, 72, self::HEIGHT - 40, $cyan, $font, '1200×630 · hero preview');
        } else {
            imagestring($im, 5, 72, 100, mb_substr($title, 0, 80, 'UTF-8'), $white);
            imagestring($im, 3, 72, self::HEIGHT - 50, mb_substr($brand, 0, 40, 'UTF-8'), $muted);
        }

        $dir = dirname($path);
        if (!is_dir($dir)) {
            wp_mkdir_p($dir);
        }

        if (!imagejpeg($im, $path, 88)) {
            imagedestroy($im);
            return null;
        }

        imagedestroy($im);

        return $path;
    }

    private function resolve_font(): ?string
    {
        $candidates = [
            __DIR__ . '/fonts/DejaVuSans-Bold.ttf',
            '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
            '/usr/share/fonts/dejavu/DejaVuSans-Bold.ttf',
        ];

        foreach ($candidates as $path) {
            if (is_readable($path)) {
                return $path;
            }
        }

        return null;
    }

    /**
     * @return list<string>
     */
    private function wrap_text(string $text, string $font, int $size, int $maxWidth): array
    {
        $words = preg_split('/\s+/u', trim($text)) ?: [];
        $lines = [];
        $line = '';

        foreach ($words as $word) {
            $test = $line === '' ? $word : $line . ' ' . $word;
            $box = imagettfbbox($size, 0, $font, $test);
            $width = abs($box[2] - $box[0]);
            if ($width > $maxWidth && $line !== '') {
                $lines[] = $line;
                $line = $word;
            } else {
                $line = $test;
            }
        }

        if ($line !== '') {
            $lines[] = $line;
        }

        return $lines;
    }

    private function draw_wrapped_ttf(
        \GdImage $im,
        string $text,
        string $font,
        int $size,
        int $color,
        int $x,
        int $y,
        int $maxWidth,
        int $maxLines
    ): void {
        $lines = $this->wrap_text($text, $font, $size, $maxWidth);
        $lineHeight = (int) ($size * 1.35);
        $count = min(count($lines), $maxLines);

        for ($i = 0; $i < $count; $i++) {
            $line = $lines[$i];
            if ($i === $maxLines - 1 && count($lines) > $maxLines) {
                $line = mb_substr($line, 0, max(0, mb_strlen($line, 'UTF-8') - 1), 'UTF-8') . '…';
            }
            imagettftext($im, $size, 0, $x, $y + $i * $lineHeight, $color, $font, $line);
        }
    }

    private function output_jpeg(string $path): void
    {
        header('Content-Type: image/jpeg');
        header('Cache-Control: public, max-age=604800');
        header('Content-Length: ' . (string) filesize($path));
        readfile($path);
        exit;
    }
}

if (!function_exists('nero_social_is_bad_og_image')) {
    function nero_social_is_bad_og_image(string $url): bool
    {
        $lower = mb_strtolower($url, 'UTF-8');

        foreach (['cropped-photo', 'site-icon', 'favicon', 'custom-logo', '-150x150', '-300x300'] as $needle) {
            if (strpos($lower, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('nero_social_dynamic_og_url')) {
    function nero_social_dynamic_og_url(int $post_id): string
    {
        return home_url('/nero-og/' . $post_id . '.jpg');
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
            return (string) $GLOBALS['nero_page_explicit_og_image'];
        }

        $meta = get_post_meta($post_id, '_nero_og_image', true);
        if (is_string($meta) && $meta !== '' && !nero_social_is_bad_og_image($meta)) {
            return esc_url_raw($meta);
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
        if (is_string($filtered) && $filtered !== '') {
            return esc_url_raw($filtered);
        }

        return nero_social_dynamic_og_url($post_id);
    }
}

new Nero_Social_Og();
