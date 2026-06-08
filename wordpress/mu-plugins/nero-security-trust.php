<?php
/**
 * Plugin Name: Nero Security & Trust (MU)
 * Description: Anti-fraud trust signals: brand disclaimers, duplicate redirects, security headers, footer legal links, CTA safety notice.
 * Version: 1.2.0
 * Author: Nero Network Security
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

$nero_site_legal = __DIR__ . '/nero-site-legal.php';
if (is_readable($nero_site_legal)) {
    require_once $nero_site_legal;
}

final class Nero_Security_Trust
{
    private const CANONICAL_META_SLUG = 'meta-business-agent-whatsapp-ai-agent';

    /** @var array<string, string> */
    private const META_DUPLICATE_REDIRECTS = [
        'meta-business-agent-whatsapp-ii-agent-prodazhi' => self::CANONICAL_META_SLUG,
        'meta-business-agent-ai-whatsapp-instagram'      => self::CANONICAL_META_SLUG,
    ];

    private const CANONICAL_ALICE_SLUG = 'yandex-alice-ai-llm-flash-vnedrenie-biznes';

    /** @var array<string, string> */
    private const ALICE_DUPLICATE_REDIRECTS = [
        'yandex-alice-ai-llm-flash-biznes-avtomatizaciya' => self::CANONICAL_ALICE_SLUG,
        'alice-ai-llm-flash-yandex-dlya-biznesa'          => self::CANONICAL_ALICE_SLUG,
        'alice-ai-llm-flash-vnedrenie-biznes'             => self::CANONICAL_ALICE_SLUG,
        'yandex-alice-ai-llm-flash-avtomatizaciya-biznesa' => self::CANONICAL_ALICE_SLUG,
    ];

    private const CANONICAL_ZAYAVKI_SLUG = 'vnedrenie-ai-obrabotka-zayavok-s-sayta';

    /** @var array<string, string> */
    private const CONTENT_DUPLICATE_REDIRECTS = [
        'ai-obrabotka-zayavok-s-sayta' => self::CANONICAL_ZAYAVKI_SLUG,
    ];

    /** Черновики/заглушки, случайно опубликованные с title «hero fix». */
    private const PLACEHOLDER_SLUGS = [
        'microsoft-otkaz-claude-code-stoimost-ai-avtomatizaciya',
        'salesforce-claude-code-13-dnej-agentnaya-razrabotka',
        'copilot-computer-use-mcp-agenty-bez-api',
        'kontrol-rashodov-ai-tokeny-500-mln-claude',
    ];

    /** @var array<string, string> */
    private const DISCLAIMERS = [
        'meta' => 'Дисклеймер: этот материал является независимым аналитическим обзором. Данный сайт не является официальным сайтом Meta, WhatsApp или Instagram, не связан с ними и не представляет их интересы. WhatsApp и Instagram принадлежат соответствующим правообладателям. Материал опубликован в информационных целях и не предлагает вход в аккаунт, подтверждение данных, получение выплат или передачу паролей.',
        'kpmg' => 'Дисклеймер: этот материал является независимым аналитическим обзором и не является официальной публикацией KPMG. Данный сайт не связан с KPMG и не представляет её интересы. Все товарные знаки принадлежат их правообладателям.',
        'yandex' => 'Дисклеймер: этот материал является независимым аналитическим обзором и не является официальной публикацией Яндекса. Данный сайт не связан с Яндексом и не представляет его интересы. Все товарные знаки принадлежат их правообладателям.',
        'microsoft' => 'Дисклеймер: этот материал является независимым аналитическим обзором и не является официальной публикацией Microsoft. Данный сайт не связан с Microsoft и не представляет её интересы. Все товарные знаки принадлежат их правообладателям.',
        'sber' => 'Дисклеймер: этот материал является независимым аналитическим обзором и не является официальной публикацией Сбера. Данный сайт не связан со Сбером и не представляет его интересы. Все товарные знаки принадлежат их правообладателям.',
        'openai' => 'Дисклеймер: этот материал является независимым аналитическим обзором и не является официальной публикацией OpenAI. Данный сайт не связан с OpenAI и не представляет её интересы. Все товарные знаки принадлежат их правообладателям.',
    ];

    /** @var array<int, string> */
    private const BRAND_RULES = [
        ['keys' => ['meta', 'whatsapp', 'instagram'], 'type' => 'meta'],
        ['keys' => ['kpmg'], 'type' => 'kpmg'],
        ['keys' => ['yandex', 'alice', 'алиса', 'нейроаналитик'], 'type' => 'yandex'],
        ['keys' => ['microsoft'], 'type' => 'microsoft'],
        ['keys' => ['sber', 'gigachat', 'gigacowork'], 'type' => 'sber'],
        ['keys' => ['openai', 'chatgpt', 'codex', 'claude'], 'type' => 'openai'],
    ];

    /** @var array<string, string> */
    private const PHISHING_REPLACEMENTS = [
        'официальная страница' => 'информационная статья',
        'официальный сервис'   => 'аналитический обзор',
        'официальный сайт'     => 'независимый материал',
        'официальный'          => 'аналитический',
        'подтвердить данные'   => 'описать задачу',
        'подтвердить аккаунт'  => 'связаться для консультации',
        'забрать выплату'      => 'обсудить внедрение',
        'получить выплату'     => 'получить консультацию',
        'вход whatsapp'        => 'обзор WhatsApp',
        'аккаунт meta'         => 'сервисы Meta',
        'войти'                => 'узнать больше',
    ];

    public function __construct()
    {
        add_action('template_redirect', [$this, 'redirect_duplicate_pages'], 1);
        add_filter('the_content', [$this, 'inject_disclaimer_and_sanitize'], 5);
        add_action('send_headers', [$this, 'send_security_headers']);
        add_action('wp_head', [$this, 'noindex_duplicate_pages'], 1);
        add_action('wp_footer', [$this, 'render_trust_footer'], 99);
        add_action('wp_head', [$this, 'render_cta_safety_styles'], 20);
    }

    public function redirect_duplicate_pages(): void
    {
        if (is_admin() || wp_doing_ajax() || wp_doing_cron()) {
            return;
        }

        if (!is_singular('page')) {
            return;
        }

        $post = get_queried_object();
        if (!$post instanceof WP_Post) {
            return;
        }

        $slug = $post->post_name;
        $target = self::META_DUPLICATE_REDIRECTS[$slug]
            ?? self::ALICE_DUPLICATE_REDIRECTS[$slug]
            ?? self::CONTENT_DUPLICATE_REDIRECTS[$slug]
            ?? null;
        if ($target === null) {
            return;
        }

        $url = home_url('/' . $target . '/');
        wp_safe_redirect($url, 301);
        exit;
    }

    public function noindex_duplicate_pages(): void
    {
        if (!is_singular('page')) {
            return;
        }

        $post = get_queried_object();
        if (!$post instanceof WP_Post) {
            return;
        }

        $slug = $post->post_name;
        $is_redirect_source = isset(self::META_DUPLICATE_REDIRECTS[$slug])
            || isset(self::ALICE_DUPLICATE_REDIRECTS[$slug])
            || isset(self::CONTENT_DUPLICATE_REDIRECTS[$slug]);
        $is_placeholder = in_array($slug, self::PLACEHOLDER_SLUGS, true)
            || mb_strtolower(trim($post->post_title), 'UTF-8') === 'hero fix';

        if ($is_redirect_source || $is_placeholder) {
            echo '<meta name="robots" content="noindex, follow" />' . "\n";
        }
    }

    /**
     * @param string $content
     * @return string
     */
    public function inject_disclaimer_and_sanitize(string $content): string
    {
        if (!is_singular('page') || is_admin()) {
            return $content;
        }

        $post = get_queried_object();
        if (!$post instanceof WP_Post) {
            return $content;
        }

        if (strpos($content, 'nero-brand-disclaimer') !== false) {
            return $content;
        }

        $disclaimer = $this->resolve_disclaimer($post->post_name, $post->post_title);
        if ($disclaimer === null) {
            return $this->sanitize_phishing_phrases($content);
        }

        $block = $this->disclaimer_html($disclaimer);
        if (preg_match('/<h1[^>]*>.*?<\/h1>/is', $content, $m, PREG_OFFSET_CAPTURE)) {
            $pos = $m[0][1] + strlen($m[0][0]);
            $content = substr($content, 0, $pos) . $block . substr($content, $pos);
        } else {
            $content = $block . $content;
        }

        return $this->sanitize_phishing_phrases($content);
    }

    private function resolve_disclaimer(string $slug, string $title): ?string
    {
        $haystack = mb_strtolower($slug . ' ' . wp_strip_all_tags($title), 'UTF-8');

        foreach (self::BRAND_RULES as $rule) {
            foreach ($rule['keys'] as $key) {
                if (strpos($haystack, mb_strtolower($key, 'UTF-8')) !== false) {
                    return self::DISCLAIMERS[$rule['type']] ?? null;
                }
            }
        }

        return null;
    }

    private function disclaimer_html(string $text): string
    {
        return '<aside class="nero-brand-disclaimer" role="note" aria-label="Дисклеймер">'
            . '<p><strong>' . esc_html($text) . '</strong></p>'
            . '</aside>';
    }

    private function sanitize_phishing_phrases(string $content): string
    {
        foreach (self::PHISHING_REPLACEMENTS as $from => $to) {
            $pattern = '/' . preg_quote($from, '/') . '/iu';
            $content = preg_replace($pattern, $to, $content) ?? $content;
        }

        return $content;
    }

    public function send_security_headers(): void
    {
        if (headers_sent()) {
            return;
        }

        header('X-Content-Type-Options: nosniff', true);
        header('X-Frame-Options: SAMEORIGIN', true);
        header('Referrer-Policy: strict-origin-when-cross-origin', true);
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()', true);

        if (is_ssl()) {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains', true);
        }
    }

    public function render_cta_safety_styles(): void
    {
        echo '<style>.nero-brand-disclaimer{background:rgba(255,193,7,.12);border:1px solid rgba(255,193,7,.45);border-radius:12px;padding:14px 18px;margin:18px 0 24px;color:inherit}'
            . '.nero-trust-footer,.nero-site-legal-block{margin-top:24px;padding:16px 0;border-top:1px solid rgba(255,255,255,.12);font-size:.92rem;opacity:.9}'
            . '.nero-cta-safety,.nero-site-legal-consent{font-size:.85rem;opacity:.85;margin-top:8px}'
            . '.nero-site-legal-operator{opacity:.8;margin-bottom:8px}</style>' . "\n";
    }

    public function render_trust_footer(): void
    {
        if (function_exists('nero_site_render_legal_footer_block')) {
            nero_site_render_legal_footer_block();
            return;
        }

        echo '<div class="nero-trust-footer" role="contentinfo">';
        echo '<p><a href="' . esc_url(home_url('/politika-konfidentsialnosti/')) . '">Политика конфиденциальности</a></p>';
        echo '</div>';
    }
}

new Nero_Security_Trust();
