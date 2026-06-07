<?php
/**
 * Канонический шаблон page-{slug}.php для AI-лонгридов WP_SITE_HOST.
 *
 * Источник истины по дизайну: живая главная сайта (WP_SITE_URL из env).
 * и эталонные страницы темы (page-ai-kvalifikaciya-lidov.php и др.).
 *
 * ОБЯЗАТЕЛЬНО:
 * - get_header() / get_footer() — шапка Kadence + плавающая pill-шапка SITE_BRAND из темы
 * - НЕ хардкодить <header>, sticky-nav, бренд Nero Network, amo-sticky-nav, ym-sticky-nav
 * - hero в классах .nero-ai-hero / .nero-ai-home-page (как на главной)
 * - внутреннее меню — только $nero_ai_header_links → nero-ai-floating-header.inc.php
 * - контент в <main id="primary" class="site-main nero-ai-home-page">
 *
 * Bootstrap и partials: тема (runtime) → fallback shared/theme-canonical/
 */

declare(strict_types=1);

// --- SEO (заменить под страницу) ---
$page_seo_title       = 'Заголовок страницы';
$page_seo_description = 'Meta description для excerpt и og:description';

add_filter(
    'document_title_parts',
    static function (array $parts) use ($page_seo_title): array {
        $parts['title'] = $page_seo_title;
        return $parts;
    },
    20
);

add_action(
    'wp_head',
    static function () use ($page_seo_title, $page_seo_description): void {
        echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
    },
    1
);

// --- CTA из env (primary → Telegram по умолчанию) ---
$brand               = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Написать в Telegram';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

// Якоря ТОЛЬКО к существующим id секций этой страницы
$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#section-id-1'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}
?>

<?php nero_ai_echo_theme_styles(); ?>

<main id="primary" class="site-main nero-ai-home-page {slug}-page" role="main" tabindex="-1">

  <section class="nero-ai-hero" id="hero" aria-labelledby="hero-title">
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy nero-ai-reveal">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · тема страницы</p>
        <h1 id="hero-title">H1 <span class="nero-ai-gradient-text">с градиентом</span></h1>
        <p class="nero-ai-hero-lead">Подзаголовок hero — как на главной.</p>
        <ul class="nero-ai-badges" aria-label="Ключевые теги">
          <li class="nero-ai-badge">Тег 1</li>
          <li class="nero-ai-badge">Тег 2</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>"><?php echo esc_html($secondary_cta_label); ?></a>
        </div>
      </div>
      <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо AI-логики">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">демо · ai</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title"><h3>AI-операционный центр</h3><span class="nero-ai-live-pill">live</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Контентные секции: .nero-ai-section, id для якорей меню -->
  <section class="nero-ai-section" id="section-id-1">
    <div class="nero-ai-container">
      <p>Контент лонгрида…</p>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT — внутренние ссылки из === INTERNAL-LINKER === (Юра) -->
  <!-- SCHEMA-MARKUP: вставить JSON-LD из === SCHEMA-MARKUP === перед публикацией (Юра) -->
  <!-- <script type="application/ld+json">...</script> -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
