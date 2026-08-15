<?php
/**
 * Template Name: AI-анализ возвратов для e-commerce: внедрение под ключ
 * Description: Внедряем AI, который собирает причины возвратов из отзывов, чатов и CRM. Покажем, что исправить в товаре, карточке и доставке.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-анализ возвратов для e-commerce: внедрение под ключ';
$page_seo_description = 'Внедряем AI, который собирает причины возвратов из отзывов, чатов и CRM. Покажем, что исправить в товаре, карточке и доставке. Разбор 100 отзывов — бесплатный старт.';

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

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Проблема', 'href' => '#problema'],
    ['label' => 'Как работает', 'href' => '#chto-takoe'],
    ['label' => 'Выгоды', 'href' => '#rezultat'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Найти причины возвратов';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#chto-takoe';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

<style>
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.avz-hero-vozvraty.nero-ai-hero{min-height:100vh;min-height:100dvh;position:relative}
.avz-content{--avz-bg:#050711;--avz-bg2:#080b17;--avz-text:#e6edf7;--avz-muted:#9aa8bd;--avz-soft:#c7d2e5;--avz-heading:#fff;--avz-border:rgba(255,255,255,.10);--avz-cyan:#79f2ff;--avz-violet:#8b5cf6;--avz-green:#22c55e;--avz-alert:#f97316;--avz-btn-from:#2563eb;--avz-btn-to:#7c3aed;--avz-container:1220px;background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);color:var(--avz-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden}
.avz-content *,.avz-content *::before,.avz-content *::after{box-sizing:border-box}
.avz-content a{color:inherit;text-decoration:none}
.avz-content p{color:var(--avz-muted);line-height:1.72;margin:0 0 1em;font-size:15px}
.avz-content p:last-child{margin-bottom:0}
.avz-content h2,.avz-content h3{color:var(--avz-heading);letter-spacing:-.04em;margin:0 0 .7em}
.avz-content strong{color:var(--avz-soft)}
.avz-content code{font-size:13px;background:rgba(255,255,255,.08);padding:2px 6px;border-radius:4px}
.avz-cnt{width:min(var(--avz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.avz-section{padding:clamp(56px,7vw,96px) 0;position:relative}
.avz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.avz-sh{max-width:820px;margin:0 auto 40px;text-align:center}
.avz-sh h2{font-size:clamp(26px,3.8vw,46px);line-height:1.08;margin-bottom:12px}
.avz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--avz-cyan);margin-bottom:14px}
.avz-body{max-width:920px;margin:0 auto}
.avz-intro{padding:clamp(40px,5vw,72px) 0 clamp(36px,4vw,56px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.avz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:center}
.avz-intro-text{position:relative;padding-left:20px;text-align:left!important}
.avz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--avz-cyan),var(--avz-violet))}
.avz-intro-text p{text-align:left!important}
.avz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.avz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.avz-kpi-card .kv{font-size:clamp(18px,2.2vw,24px);font-weight:900;color:var(--avz-heading);letter-spacing:-.04em;line-height:1.1;margin-bottom:5px}
.avz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--avz-muted);line-height:1.4}
.avz-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
.avz-kpi-alert{border-color:rgba(249,115,22,.28)}
.avz-kpi-alert .kv{color:var(--avz-alert)}
@media(max-width:900px){.avz-intro-grid{grid-template-columns:1fr;gap:32px}.avz-intro-kpi{grid-template-columns:repeat(2,1fr)}}
@media(max-width:520px){.avz-intro-kpi{grid-template-columns:1fr}}
.avz-toc-outer{padding:0 0 clamp(32px,4vw,48px)}
.avz-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.avz-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;font-weight:600;color:var(--avz-muted);transition:border-color .2s,color .2s,background .2s}
.avz-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--avz-cyan);background:rgba(121,242,255,.08)}
.avz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.avz-table{width:100%;border-collapse:collapse;font-size:14px}
.avz-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--avz-cyan);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.avz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--avz-text);vertical-align:top}
.avz-table tr:last-child td{border-bottom:none}
.avz-table tr:hover td{background:rgba(255,255,255,.03)}
.avz-ul,.avz-ol{padding-left:0;list-style:none;margin:0 0 1em}
.avz-ul li,.avz-ol li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--avz-muted);font-size:14.5px;line-height:1.65}
.avz-ul li::before{content:'›';position:absolute;left:0;color:var(--avz-cyan);font-weight:700}
.avz-ol{counter-reset:avzli}
.avz-ol li{counter-increment:avzli;padding-left:28px}
.avz-ol li::before{content:counter(avzli);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(139,92,246,.15);color:var(--avz-violet);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;top:2px}
.avz-body h3{font-size:19px;margin-top:28px;margin-bottom:12px}
.avz-link{color:var(--avz-cyan)!important;text-decoration:underline!important}
.avz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.avz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.avz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--avz-heading);cursor:pointer;list-style:none}
.avz-faq-q::-webkit-details-marker{display:none}
.avz-faq-a{padding:0 24px 20px;font-size:14.5px;color:var(--avz-muted);line-height:1.72}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px auto;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;max-width:920px}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;margin:0 auto 32px}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--avz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-link--accent{color:var(--avz-cyan)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn:hover{transform:translateY(-2px)}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--avz-btn-from),var(--avz-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
.avz-pricing-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin:28px 0}
.avz-price-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:28px 24px;transition:border-color .22s,transform .22s}
.avz-price-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.avz-price-card--featured{border-color:rgba(121,242,255,.35);background:linear-gradient(180deg,rgba(121,242,255,.1),rgba(255,255,255,.04))}
.avz-price-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--avz-cyan);margin-bottom:10px}
.avz-price-card h3{font-size:18px;margin-bottom:12px}
.avz-price-val{font-size:clamp(22px,2.5vw,28px);font-weight:900;color:#fff;margin-bottom:8px}
.avz-price-card p{font-size:14px;margin:0}
@media(max-width:900px){.avz-pricing-grid{grid-template-columns:1fr}}
.avz-timeline{position:relative;padding-left:40px;margin:24px 0}
.avz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--avz-cyan),var(--avz-violet));opacity:.35;border-radius:2px}
.avz-tl-item{position:relative;margin-bottom:28px}
.avz-tl-item:last-child{margin-bottom:0}
.avz-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--avz-cyan);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.avz-defbox{border-left:3px solid var(--avz-violet);padding:16px 20px;margin:20px 0;background:rgba(139,92,246,.08);border-radius:0 12px 12px 0}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-analiz-vozvratov-page" role="main" tabindex="-1">

<section class="nero-ai-hero avz-hero-vozvraty" id="hero" aria-labelledby="hero-vozvraty-title">
<style>
/* === АЛИНА: hero ai-analiz-vozvratov — scoped .avz-hero-vozvraty === */
.avz-hero-vozvraty {
  --avz-bg: #050711;
  --avz-bg2: #080b17;
  --avz-text: #f8fafc;
  --avz-soft: rgba(226, 232, 240, 0.78);
  --avz-muted: #94a3b8;
  --avz-cyan: #79f2ff;
  --avz-violet: #8b5cf6;
  --avz-green: #22c55e;
  --avz-alert: #f97316;
  --avz-shadow: 0 28px 80px rgba(0, 0, 0, 0.45);
}
.avz-hero-vozvraty .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--avz-cyan) 38%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.avz-hero-vozvraty .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--avz-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.avz-hero-vozvraty .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: 0.96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.avz-hero-vozvraty .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--avz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.avz-hero-vozvraty .nero-ai-badge {
  color: #dce8f7;
}
.avz-hero-vozvraty .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--avz-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.avz-hero-vozvraty .nero-ai-btn-secondary {
  color: var(--avz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.avz-hero-vozvraty .nero-ai-btn-secondary:hover {
  border-color: rgba(121, 242, 255, 0.36);
  background: rgba(121, 242, 255, 0.08);
}
.avz-hero-vozvraty .nero-ai-dashboard {
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
  box-shadow: var(--avz-shadow);
}
.avz-hero-vozvraty .nero-ai-metric strong {
  color: #fff;
}
.avz-hero-vozvraty .nero-ai-metric:nth-child(1) strong {
  color: var(--avz-alert);
}
.avz-hero-vozvraty .nero-ai-metric:nth-child(2) strong {
  color: var(--avz-cyan);
}
.avz-hero-vozvraty .avz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background:
    radial-gradient(ellipse at 25% 40%, rgba(139, 92, 246, 0.12), transparent 55%),
    radial-gradient(ellipse at 75% 60%, rgba(249, 115, 22, 0.08), transparent 50%),
    linear-gradient(180deg, rgba(8, 11, 23, 0.4), rgba(5, 7, 17, 0.92));
}
.avz-hero-vozvraty #ai-vozvraty-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.avz-hero-vozvraty .nero-ai-task-icon {
  background: rgba(121, 242, 255, 0.12);
  color: var(--avz-cyan);
}
.avz-hero-vozvraty .nero-ai-status--violet {
  background: rgba(139, 92, 246, 0.14);
  color: #ddd6fe;
}
.avz-hero-vozvraty .nero-ai-status--alert {
  background: rgba(249, 115, 22, 0.14);
  color: #fdba74;
}
@media (max-width: 1100px) {
  .avz-hero-vozvraty .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .avz-hero-vozvraty .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .avz-hero-vozvraty .nero-ai-window-body { padding: 12px; }
  .avz-hero-vozvraty .nero-ai-task { grid-template-columns: 28px 1fr; }
  .avz-hero-vozvraty .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai анализ возвратов</p>
      <h1 id="hero-vozvraty-title">AI-анализ возвратов и негативных отзывов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI собирает причины возвратов из отзывов и чатов — и показывает, что исправить в товаре, карточке или доставке</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Ozon/WB</li>
        <li class="nero-ai-badge">Отзывы</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">Кластеры</li>
        <li class="nero-ai-badge">Алерты</li>
        <li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Найти причины возвратов'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-takoe">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-аналитика возвратов">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-аналитика возвратов</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Возвраты</span>
              <strong>32%</strong>
              <small>fashion SKU</small>
            </div>
            <div class="nero-ai-metric">
              <span>Причина №1</span>
              <strong>маломерит</strong>
              <small>кластер «размер»</small>
            </div>
            <div class="nero-ai-metric">
              <span>Реакция</span>
              <strong>24ч</strong>
              <small>на негатив</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ручной разбор</span>
              <strong>−85%</strong>
              <small>потенциал пилота</small>
            </div>
          </div>

          <div class="avz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ai-vozvraty-hero-canvas" role="img" aria-label="Анимация: поток отзывов маркетплейсов кластеризуется по причинам возврата и превращается в задачи CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий аналитики возвратов">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WB</span>
              <div><strong>Отзыв WB · SKU-884</strong><span>«Маломерит, на фото другое» · ★2</span></div>
              <span class="nero-ai-status nero-ai-status--alert">новый</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Кластер «размер»</strong><span>37 цитат за 7 дней · confidence 0.91</span></div>
              <span class="nero-ai-status nero-ai-status--violet">кластер</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Задача в amoCRM</strong><span>Правка размерной сетки · ответственный продукт</span></div>
              <span class="nero-ai-status">создано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✎</span>
              <div><strong>Правка карточки</strong><span>Примечание «маломерит» + обновление фото</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ai-vozvraty-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    reviewBg: "#f8fafc",
    reviewNeg: "#fee2e2",
    reviewMid: "#fef3c7",
    wbPurple: "#cb11ab",
    ozonBlue: "#005bff",
    clusterCyan: "#79f2ff",
    clusterViolet: "#8b5cf6",
    clusterAlert: "#f97316",
    radarBase: "#1e293b",
    radarRing: "rgba(121,242,255,0.25)",
    tagGreen: "#a7f3d0",
    crmGreen: "#22c55e",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  function drawStar(ctx, x, y, r, color) {
    ctx.fillStyle = color;
    ctx.beginPath();
    for (var i = 0; i < 5; i++) {
      var ang = (i * 4 * Math.PI) / 5 - Math.PI / 2;
      var rad = i % 2 === 0 ? r : r * 0.42;
      ctx.lineTo(x + Math.cos(ang) * rad, y + Math.sin(ang) * rad);
    }
    ctx.closePath();
    ctx.fill();
  }

  function drawReviewCard(ctx, x, y, w, h, rating, mp, text) {
    var bg = rating <= 2 ? C.reviewNeg : rating === 3 ? C.reviewMid : C.reviewBg;
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, bg, C.outline);
    drawStar(ctx, x - w / 2 + 10, y - h / 2 + 9, 3.5, rating <= 2 ? C.clusterAlert : "#fbbf24");
    ctx.fillStyle = mp === "WB" ? C.wbPurple : C.ozonBlue;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText(mp, x - w / 2 + 18, y - h / 2 + 12);
    ctx.fillStyle = "#334155";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText(text, x - w / 2 + 6, y + 2);
  }

  /* Горизонтальная лента отзывов — вместо Conveyor */
  function ReviewRibbonCarousel() {
    this.cards = [
      { offset: 0, rating: 2, mp: "WB", text: "маломерит" },
      { offset: 55, rating: 1, mp: "WB", text: "не как фото" },
      { offset: 110, rating: 3, mp: "OZ", text: "брак молнии" },
      { offset: 165, rating: 2, mp: "WB", text: "размер L→S" }
    ];
  }
  ReviewRibbonCarousel.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, -175, 52, 350, 28, 6, "rgba(30,41,59,0.55)", C.outline);
    ctx.strokeStyle = "rgba(121,242,255,0.35)";
    ctx.lineWidth = 1;
    ctx.setLineDash([6, 5]);
    ctx.beginPath();
    ctx.moveTo(-170, 66);
    ctx.lineTo(170, 66);
    ctx.stroke();
    ctx.setLineDash([]);

    this.cards.forEach(function (c) {
      var t = ((frame * 0.55 + c.offset) % 200) / 200;
      var dx = -165 + t * 330;
      if (t < 0.88) drawReviewCard(ctx, dx, 66, 42, 22, c.rating, c.mp, c.text);
    });

    if (prg >= 8 && prg < 45) {
      ctx.fillStyle = "rgba(249,115,22,0.15)";
      ctx.beginPath();
      ctx.arc(-120 + ((prg - 8) / 37) * 80, 66, 18, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  /* NLP-сканер аспектов на ленте */
  function NlpAspectScanner() {
    this.beam = -80;
  }
  NlpAspectScanner.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 42 || prg >= 108) return;
    var scan = (prg - 42) / 66;
    this.beam = -90 + scan * 180;
    ctx.save();
    ctx.globalAlpha = 0.28 + Math.sin(frame * 0.14) * 0.12;
    ctx.fillStyle = "rgba(121,242,255,0.55)";
    ctx.fillRect(this.beam - 2, 38, 4, 52);
    ctx.strokeStyle = C.clusterCyan;
    ctx.lineWidth = 1.5;
    ctx.strokeRect(this.beam - 16, 42, 32, 44);
    ctx.restore();

    if (prg > 58) {
      var tags = ["размер", "фото", "брак"];
      tags.forEach(function (tag, i) {
        var pop = Math.min(1, (prg - 58 - i * 10) / 12);
        if (pop <= 0) return;
        var tx = -55 + i * 38;
        var ty = 18;
        ctx.globalAlpha = pop;
        drawRR(ctx, tx, ty, 34, 12, 3, C.tagGreen, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(tag, tx + 17, ty + 9);
        ctx.globalAlpha = 1;
      });
    }
  };

  /* Радар кластеров причин — вместо WebsiteTerminal */
  function ClusterReasonRadar() {
    this.pulse = 0;
    this.dominant = 0;
  }
  ClusterReasonRadar.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    this.pulse = 0.5 + Math.sin(frame * 0.08) * 0.5;

    drawRR(ctx, -58, -82, 116, 116, 12, C.radarBase, C.outline);
    for (var ring = 1; ring <= 3; ring++) {
      ctx.strokeStyle = C.radarRing;
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.arc(0, -38, ring * 18, 0, Math.PI * 2);
      ctx.stroke();
    }

    var clusters = [
      { label: "размер", angle: -0.9, color: C.clusterCyan, size: 14 },
      { label: "фото", angle: 0.4, color: C.clusterViolet, size: 10 },
      { label: "брак", angle: 1.6, color: C.clusterAlert, size: 9 },
      { label: "логист.", angle: 2.8, color: "#94a3b8", size: 7 }
    ];

    clusters.forEach(function (cl, i) {
      var appear = prg > 100 + i * 12;
      if (!appear) return;
      var r = 22 + cl.size * 0.8 + (i === 0 && prg > 130 ? this.pulse * 4 : 0);
      var bx = Math.cos(cl.angle) * r;
      var by = -38 + Math.sin(cl.angle) * r * 0.65;
      drawRR(ctx, bx - cl.size, by - cl.size, cl.size * 2, cl.size * 2, cl.size, cl.color, C.outline);
      if (i === 0 && prg > 125) {
        ctx.fillStyle = "#fff";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("№1", bx, by + 2);
      }
    }, this);

    if (prg >= 108) {
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("кластеры причин", 0, -88);
      if (prg > 130) {
        ctx.fillStyle = C.clusterCyan;
        ctx.font = "bold 9px Inter,sans-serif";
        ctx.fillText("маломерит · 37 отзывов", 0, -12);
      }
    }
  };

  /* Всплеск негатива по SKU */
  function NegativePulseAlert() {
    this.alpha = 0;
  }
  NegativePulseAlert.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 125 || prg > 175) { this.alpha = 0; return; }
    this.alpha = Math.min(1, (prg - 125) / 15) * (prg < 165 ? 1 : 1 - (prg - 165) / 10);
    ctx.save();
    ctx.globalAlpha = this.alpha * 0.35;
    ctx.strokeStyle = C.clusterAlert;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(42, -55, 22 + this.alpha * 6, 0, Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = C.clusterAlert;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.globalAlpha = this.alpha;
    ctx.fillText("ALERT", 42, -52);
    ctx.restore();
  };

  /* Маяк задачи в CRM */
  function CrmTaskBeacon() {
    this.flash = 0;
  }
  CrmTaskBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 168 || prg > 228) return;
    this.flash = Math.sin((prg - 168) * 0.35) * 0.5 + 0.5;
    drawRR(ctx, 118, -18, 52, 58, 6, "rgba(34,197,94,0.12)", C.crmGreen);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("amoCRM", 144, -6);
    if (prg > 178) {
      drawRR(ctx, 124, 2, 40, 14, 3, "rgba(255,255,255,0.1)", C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("правка карточки", 144, 12);
    }
    if (prg > 190) {
      ctx.strokeStyle = "rgba(34,197,94," + (0.4 + this.flash * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(58, -20);
      ctx.lineTo(118, 8);
      ctx.stroke();
      ctx.fillStyle = C.crmGreen;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("задача →", 88, -4);
    }
  };

  /* Пульс правки карточки товара — финал цикла */
  function ProductCardPatchGlow() {
    this.glow = 0;
  }
  ProductCardPatchGlow.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 205) return;
    this.glow = Math.min(1, (prg - 205) / 20);
    var fade = prg > 228 ? 1 - (prg - 228) / 12 : 1;
    ctx.save();
    ctx.globalAlpha = this.glow * fade;
    drawRR(ctx, -48, 8, 64, 78, 6, "rgba(255,255,255,0.08)", C.outline);
    drawRR(ctx, -44, 12, 56, 36, 4, "rgba(139,92,246,0.2)", C.clusterViolet);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("SKU-884", -40, 24);
    ctx.fillText("размерная сетка ✓", -40, 52);
    ctx.fillText("фото обновлено ✓", -40, 64);
    ctx.strokeStyle = C.clusterCyan;
    ctx.lineWidth = 2;
    ctx.strokeRect(-48, 8, 64, 78);
    ctx.fillStyle = C.clusterCyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("−12% возвратов*", -16, 78);
    ctx.restore();
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.042) % 240;
    var isMoving = false;
    var carryType = null;

    var targets = {
      "1_architect": { x: -95, y: 28 },
      "2_seo": { x: -35, y: 36 },
      "3_coder": { x: 35, y: 36 },
      "4_designer": { x: 95, y: 28 },
      "5_deployer": { x: 0, y: 48 }
    };
    var tgt = targets[this.role] || { x: 0, y: 40 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 15) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 15) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 15) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.1;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 6;
      legL = Math.sin(wp) * 4;
      legR = Math.sin(wp + Math.PI) * 4;
    }
    drawRR(ctx, -8, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
    drawRR(ctx, 0, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
    drawRR(ctx, -12, -10 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -22 - bob, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var ribbon = new ReviewRibbonCarousel();
  var scanner = new NlpAspectScanner();
  var radar = new ClusterReasonRadar();
  var alert = new NegativePulseAlert();
  var crm = new CrmTaskBeacon();
  var cardFix = new ProductCardPatchGlow();

  entities.push(ribbon);
  entities.push(scanner);
  entities.push(radar);
  entities.push(alert);
  entities.push(crm);
  entities.push(cardFix);
  entities.push(new Agent(-125, 92, C.agentYellow, "1_architect", 18, [
    "Таксономия: 12 причин", "SKU → кластер связка", "WB reason code ≠ текст"
  ]));
  entities.push(new Agent(-62, 98, C.agentGreen, "2_seo", 62, [
    "Карточка SKU-884 в фокусе", "Кластер «размер» +12%", "GEO: ai анализ возвратов"
  ]));
  entities.push(new Agent(0, 102, C.agentBlue, "3_coder", 108, [
    "WB API · 47 отзывов", "Webhook → amoCRM", "Embeddings кластер"
  ]));
  entities.push(new Agent(62, 98, C.agentPink, "4_designer", 152, [
    "Цитата рядом с %", "UI human-in-the-loop", "Explainability: текст→действие"
  ]));
  entities.push(new Agent(125, 92, C.agentPurple, "5_deployer", 198, [
    "Алерт Telegram · 24ч", "Задача: размерная сетка", "Пилот 100 отзывов"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 220, maxLife: life || 220 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 240;
    if (prg >= 12 && prg < 12.05) createBubble(-130, 20, "1. Отзыв с маркетплейса");
    if (prg >= 52 && prg < 52.05) createBubble(-40, -8, "2. NLP: причина возврата");
    if (prg >= 118 && prg < 118.05) createBubble(0, -58, "3. Кластер «маломерит»");
    if (prg >= 178 && prg < 178.05) createBubble(100, 0, "4. Задача в CRM");
    if (prg >= 212 && prg < 212.05) createBubble(-20, 42, "5. Правка карточки");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.clusterCyan);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 11);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineloop);
  } else {
    engineloop();
  }
});
</script>

<div class="avz-content">
  <section class="avz-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="avz-cnt nero-ai-container">
      <div class="avz-intro-grid nero-ai-reveal">
        <div class="avz-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai анализ возвратов</p>
          <p><strong>Коротко:</strong> AI-анализ возвратов — это внедрение системы, которая собирает отзывы, чаты, тикеты и заявки на возврат из маркетплейсов и CRM, классифицирует причины негатива и выдаёт конкретные действия: что исправить в товаре, карточке или доставке.</p>
          <p>Nero Network внедряет такой пайплайн под ключ — от пилота на 100 отзывов до интеграций с Ozon, Wildberries, amoCRM и Битрикс24.</p>
        </div>
        <div class="avz-intro-kpi" aria-label="Ключевые показатели e-commerce">
          <div class="avz-kpi-card">
            <div class="kv" data-nero-count="18" data-nero-suffix="%">0%</div>
            <div class="kl">средний % возвратов в e-commerce</div>
            <div class="ks">Data Insight, 2025</div>
          </div>
          <div class="avz-kpi-card">
            <div class="kv" data-nero-count="38" data-nero-suffix="%">0%</div>
            <div class="kl">fashion на Ozon/WB</div>
            <div class="ks">Shift, 2025–2026</div>
          </div>
          <div class="avz-kpi-card">
            <div class="kv">20 млрд ₽</div>
            <div class="kl">возвраты янв–фев 2025</div>
            <div class="ks">Интерфакс</div>
          </div>
          <div class="avz-kpi-card avz-kpi-alert">
            <div class="kv">WB 2026</div>
            <div class="kl">новая обратная логистика</div>
            <div class="ks">LOGIDEX</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="avz-toc-outer">
    <div class="avz-cnt">
      <nav class="avz-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#problema">Проблема</a>
        <a href="#chto-takoe">Как работает</a>
        <a href="#rezultat">Выгоды</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#keisy">Кейсы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>
  <section class="avz-section nero-ai-reveal" id="problema">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">Раздел</span>
        <h2>Возвраты растут, а причины размазаны по отзывам и чатам</h2>
      </div>
      <div class="avz-body">
<p>В российском e-commerce средний уровень возвратов держится на уровне <strong>15–20%</strong> (по данным Data Insight, через обзор AX Digital, 2025). В категории fashion на маркетплейсах Ozon и Wildberries показатель доходит до <strong>30–45%</strong> (отчёт Shift, Forbes/ECOMHUB, 2025–2026). За январь–февраль 2025 продавцы одежды и электроники столкнулись с возвратами на <strong>20 млрд ₽</strong> (Интерфакс/Data Insight). При этом <strong>29% селлеров</strong> регулярно сталкиваются с возвратами, а пики приходятся на январь и март.</p>
<p>Проблема не только в цифре. <strong>Причины возвратов интернет-магазина</strong> размазаны по пяти и более системам: личный кабинет маркетплейса, чат поддержки, Usedesk или Jivo, amoCRM, Excel-выгрузки и переписка в Telegram. Команда видит «средний рейтинг 4,3», но не видит, <strong>что именно чинить</strong> — размерную сетку, фото, партию от поставщика или SLA доставки.</p>
<p>С <strong>марта 2026</strong> Wildberries изменил расчёт обратной логистики: стоимость возврата привязана к объёму товара, и для селлера каждый лишний возврат бьёт по юнит-экономике сильнее (LOGIDEX, 2026). <strong>Рост возвратов ecommerce</strong> перестал быть «статистикой в отчёте» — это прямая статья расходов.</p>
<h3>Почему ручной разбор отзывов не масштабируется</h3>
<p>Типовой сценарий: менеджер раз в неделю выгружает отзывы, фильтрует негатив, копирует цитаты в таблицу. При <strong>100–200 отзывах в день</strong> и 500 SKU (данные публикации на vc.ru о AI-автоматизации на Wildberries) ручная обработка занимает <strong>6–10 часов в сутки</strong> — это почти полная ставка оператора.</p>
<p>Ручной <strong>анализ негативных отзывов</strong> не масштабируется по трём причинам:</p>
<ol class="avz-ol"><li><strong>Объём.</strong> Отзывы, вопросы, чаты и заявки на возврат растут быстрее штата.</li><li><strong>Субъективность.</strong> Один менеджер помечает «брак», другой — «не понравилось»; единой таксономии нет.</li><li><strong>Задержка.</strong> Отчёт «раз в неделю» опаздывает на всплеск массового дефекта — пока собрали Excel, партия уже ушла в тысячи заказов.</li></ol>
<p>В кейсе OSMI IT (издательско-дистрибьюторский холдинг, Ozon/Wildberries/сайт) доля ручной аналитики до внедрения AI составляла <strong>80–90%</strong>; после — <strong>≤10%</strong>. Время подготовки отчёта сократилось с недели до <strong>8–12 часов</strong>, реакция на негатив — с 7 дней до <strong>24 часов</strong>.</p>
<h3>Где теряется маржа: товар, карточка, логистика, упаковка</h3>
<p>По агрегированным данным MP Manager, AX Digital и Shift, типовые причины возвратов распределяются так:</p>
<div class="avz-table-wrap"><table class="avz-table">
<thead><tr><th>Причина</th><th>Доля (ориентир)</th><th>Что обычно винят</th><th>Что показывает AI-анализ</th></tr></thead>
<tbody>
<tr><td>Не подошёл размер</td><td>30–40% (одежда/обувь)</td><td>«Покупатель ошибся»</td><td>Систематический «маломерит» на конкретных SKU → правка размерной сетки</td></tr>
<tr><td>Не соответствует фото/описанию</td><td>15–20%; AX Digital: <strong>34%</strong> всех возвратов</td><td>«Ожидания»</td><td>Повторяющиеся жалобы на цвет, материал, комплектацию → правка карточки и фото</td></tr>
<tr><td>Брак / повреждение</td><td>10–15%</td><td>Поставщик</td><td>Кластер по дате поставки и партии → эскалация в QC</td></tr>
<tr><td>Передумал / импульс</td><td>10–15%</td><td>Маркетинг</td><td>Отдельный кластер; не смешивать с браком</td></tr>
<tr><td>Повреждение при доставке</td><td>5–10%</td><td>Курьер</td><td>Всплеск по региону или складу → логистика</td></tr>
</tbody></table></div>
<p><strong>Определение:</strong> <em>AI причины возвратов</em> — это не тег «негатив» в CRM, а классификация свободного текста отзыва и обращения по смысловым категориям (размер, описание, брак, логистика, упаковка, сервис) с привязкой к SKU, каналу и факту возврата.</p>
<p>Маржа утекает не в «среднем проценте», а в <strong>неисправленных паттернах</strong>: одна ошибка в размерной сетке на хитовом SKU при возвратности 40% может стоить дороже, чем месяц подписки на любой SaaS для отзывов.</p>
<h3>Ozon, Wildberries, Яндекс Маркет: разные каналы — одна картина причин</h3>
<p>Каждый маркетплейс даёт свою аналитику: % возврата, рейтинг, иногда формальную причину из выпадающего списка. Но <strong>негативные отзывы маркетплейса</strong> и реальные мотивы покупателя часто расходятся: в reason code стоит «не подошёл размер», а в тексте — «ткань колется, на фото другое».</p>
<div class="avz-table-wrap"><table class="avz-table">
<thead><tr><th>Канал</th><th>Что даёт кабинет</th><th>Чего не хватает</th></tr></thead>
<tbody>
<tr><td>Wildberries</td><td>Отзывы, вопросы, заявки на возврат, рейтинг</td><td>Связки с CRM, кластеризации по смыслу, задач на продукт</td></tr>
<tr><td>Ozon</td><td>Отзывы, вопросы, возвраты через API Seller</td><td>Единой картины с D2C-сайтом и чатами</td></tr>
<tr><td>Яндекс Маркет</td><td>Отзывы, вопросы, метрики карточки</td><td>Сквозной аналитики с внутренним helpdesk</td></tr>
</tbody></table></div>
<p><strong>AI возвраты ecommerce</strong> имеет смысл строить <strong>поверх всех каналов</strong>: единая таксономия, единый дашборд, единые алерты. Именно это отличает внедрение под ключ от «ещё одного виджета в кабинете WB».</p>
      </div>
    </div>
  </section>
  <section class="avz-section nero-ai-reveal" id="chto-takoe">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">Раздел</span>
        <h2>Что такое AI-анализ возвратов и отзывов</h2>
      </div>
      <div class="avz-body">
<p><strong>AI-анализ возвратов</strong> — коммерческая услуга и технологический пайплайн: система собирает неструктурированную обратную связь (отзывы, тикеты, чаты, заявки на возврат) и с помощью NLP/LLM:</p>
<ul class="avz-ul"><li>классифицирует причины возвратов и негатива;</li><li>группирует повторяющиеся паттерны по SKU, категории, площадке и периоду;</li><li>связывает текст обращения с фактом возврата и метриками (выкуп, % возврата, рейтинг);</li><li>выдаёт <strong>действия</strong>, а не только график тональности.</li></ul>
<p>Как формулирует Arvind Krishna, CEO IBM (IBM Think, март 2026): начинать стоит с зон «низкого риска» — <strong>клиентский опыт и обработка обращений</strong>. Анализ причин возвратов — как раз такая зона: понятный ROI, измеримый эффект, минимальные репутационные риски при human-in-the-loop.</p>
<h3>Как AI собирает причины из отзывов, тикетов и CRM</h3>
<p>Типовой поток данных при <strong>внедрении ai анализ возвратов</strong>:</p>
<ol class="avz-ol"><li><strong>Сбор.</strong> Cron или webhook забирает новые отзывы, вопросы, чаты, заявки на возврат, тикеты CRM. Данные нормализуются: SKU, order_id, канал, текст, рейтинг, формальный reason code, временные метки.</li><li><strong>Обогащение.</strong> Связка с каталогом: категория, размерная сетка, поставщик, партия. Дедупликация. Маскирование персональных данных.</li><li><strong>AI-разметка.</strong> LLM/NLP извлекает аспекты (товар / доставка / упаковка / сервис), причину возврата, тональность, критичность, confidence, цитату-доказательство.</li><li><strong>Кластеризация.</strong> Embeddings и группировка похожих жалоб; детекция всплесков (z-score по SKU и неделе).</li><li><strong>Action layer.</strong> Рекомендации и задачи: «обновить фото», «проверить партию от 12.03», «добавить примечание „маломерит“ в карточку».</li></ol>
<p>Принцип <strong>explainability</strong> (как у UNIT и enterprise VoC-платформ): от цифры к цитате покупателя. Не «возвраты выросли на 3 п.п.», а «37 отзывов за неделю содержат „молния расходится“ на SKU-4567».</p>
<h3>Классификация причин: брак, описание, размер, доставка, упаковка</h3>
<p>Таксономия настраивается под нишу — обычно <strong>8–15 категорий</strong>. Базовый набор:</p>
<ul class="avz-ul"><li><strong>Размер и посадка</strong> — маломерит, великоват, не тот крой.</li><li><strong>Описание и ожидания</strong> — цвет, материал, комплектация, «не как на фото».</li><li><strong>Качество и брак</strong> — дефект шва, неработающая электроника, срок годности.</li><li><strong>Упаковка</strong> — помятая коробка, отсутствие защиты хрупкого товара.</li><li><strong>Логистика</strong> — задержка, повреждение при доставке, неверный ПВЗ.</li><li><strong>Сервис</strong> — грубость поддержки, долгий ответ (важно отделять от товарных причин).</li></ul>
<p>Международная практика (RefundSentry, Shopify) показывает силу <strong>семантической кластеризации</strong>: вместо 40 разных строк в CRM — <strong>5–15 смысловых кластеров</strong>. Пример: <strong>62% возвратов одного SKU</strong> попали в кластер «sizing discrepancy»; после правки карточки вендор заявляет <strong>снижение возвратов на 20–35%</strong> на затронутых SKU за 2 месяца (заявление RefundSentry, не независимый аудит).</p>
<p>Исследование ACM Web Conference 2024 (BERT для предсказания причин возврата из отзывов) подтверждает: текст отзывов даёт <strong>+20% average precision</strong> по сравнению с моделью только на формальных reason codes. <strong>15–40% всех онлайн-покупок</strong> в мире возвращаются — и формальные коды не отражают реальные мотивы.</p>
<h3>Отчёт для продукта, контента и логистики — не «просто sentiment»</h3>
<p><strong>AI анализ отзывов покупателей</strong> в формате SaaS-мониторинга (Brand Analytics, Revuze) даёт тональность и «характеристики продукта». Это полезно для маркетинга, но <strong>не закрывает операционку возвратов</strong>:</p>
<div class="avz-table-wrap"><table class="avz-table">
<thead><tr><th>Подход</th><th>Что показывает</th><th>Чего не хватает для снижения возвратов</th></tr></thead>
<tbody>
<tr><td>Sentiment-дашборд</td><td>% позитива/негатива</td><td>Действий для продуктовой команды</td></tr>
<tr><td>BI по reason codes</td><td>Формальные причины из CRM</td><td>Смысла в свободном тексте</td></tr>
<tr><td><strong>AI-анализ возвратов под ключ</strong></td><td>Кластеры причин + SKU + задачи</td><td>—</td></tr>
</tbody></table></div>
<p>Nero Network продаёт не «тональность ради тональности», а <strong>action-first отчёт</strong>: каждый инсайт = задача в CRM («исправить размерную сетку SKU-123», «проверить партию от 12.03»).</p>
      </div>
    </div>
  </section>
  <section class="avz-section nero-ai-reveal" id="rezultat">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">Раздел</span>
        <h2>Что вы получите после внедрения</h2>
      </div>
      <div class="avz-body">
<p><strong>AI анализ возвратов для бизнеса</strong> даёт измеримые артефакты, а не абстрактную «цифровизацию».</p>
<h3>Топ причин возвратов по SKU и категориям</h3>
<p>Дашборд с drill-down: категория → SKU → кластер причин → цитаты покупателей. Видно, где <strong>снижение возвратов маркетплейса</strong> реально достижимо точечными правками, а где проблема в ассортименте или поставщике.</p>
<p>Для fashion с возвратностью <strong>30–45%</strong> (Shift) даже снижение на <strong>2–3 п.п.</strong> на топ-SKU окупает проект быстрее, чем годовая подписка на enterprise VoC.</p>
<h3>Рекомендации: что править в карточке, фото и описании</h3>
<p>Система генерирует конкретные правки:</p>
<ul class="avz-ul"><li>обновить размерную сетку и добавить «маломерит» в описание;</li><li>переснять фото при расхождении цвета;</li><li>уточнить состав и уход в тексте карточки;</li><li>добавить видео примерки для категории «верхняя одежда».</li></ul>
<p>Это ответ на запрос <strong>«ai причины возвратов»</strong> в прикладном виде: не список жалоб, а <strong>дорожная карта улучшений</strong> (формулировка из практики селлеров на vc.ru).</p>
<h3>Алерты на всплеск негатива и массовые дефекты</h3>
<p>Триггеры эскалации (по модели OSMI IT):</p>
<ul class="avz-ul"><li>угрозы и безопасность;</li><li>массовый брак;</li><li>противоречие рейтинга и текста (5★ + негатив);</li><li>confidence модели <strong>< 0,6</strong>;</li><li>z-score всплеска по SKU за 24–72 часа.</li></ul>
<p>Алерты уходят в Telegram, email или как задача в amoCRM / Битрикс24.</p>
<h3>ROI: меньше возвратов, быстрее реакция на негатив</h3>
<p><strong>Итог:</strong> ожидаемые эффекты без выдуманных гарантий:</p>
<ul class="avz-ul"><li>время от инцидента до выявления причины: <strong>дни → часы</strong>;</li><li>доля ручной аналитики отзывов: <strong>сокращение в разы</strong> (ориентир OSMI IT: с 80–90% до ≤10%);</li><li>рост доли отзывов с ответом без расширения штата;</li><li>точечные правки карточек → потенциальное снижение % возвратов на проблемных SKU.</li></ul>
<p>Ориентиры из рынка (не обещание Nero Network): OSMI IT — <strong>−9% возвратов по негативному опыту</strong>; RefundSentry — <strong>−20–35%</strong> на SKU после правок размерной сетки (заявления вендоров).</p>
      </div>
    </div>
  </section>
  <div class="avz-cnt">
    <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-rezultat">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте топ-причины возвратов по вашим SKU</p>
        <p class="ym-cta-block__sub">Бесплатный разбор 100 отзывов и возвратов: топ-10 причин, 3 рисковых SKU и 5 конкретных правок в карточках — до решения о полном внедрении. Без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>
  <section class="avz-section nero-ai-reveal" id="vnedrenie">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">Раздел</span>
        <h2>Как мы внедряем AI-анализ возвратов под ключ</h2>
      </div>
      <div class="avz-body">
<p><strong>Внедрение ai анализ возвратов</strong> в Nero Network — проект с фиксированными фазами, а не бесконечная подписка «пока платите». <strong>Разработка ai анализ возвратов</strong> и <strong>ai анализ возвратов внедрение под ключ</strong> занимают от нескольких дней (пилот) до 4–6 недель (полный контур).</p>
<h3>Аудит источников: отзывы, возвраты, чаты, CRM</h3>
<p><strong>Фаза 1 (1 неделя):</strong> карта источников — Ozon/WB/Яндекс Маркет API, amoCRM/Битрикс24, Usedesk/Jivo, почта, Telegram. Согласование таксономии причин под вашу нишу. Требования <strong>152-ФЗ</strong>: отзывы с именем и контактом — персональные данные; нужен compliance-by-design.</p>
<h3>Пилот на 100 отзывах и возвратах (лид-магнит)</h3>
<p><strong>Фаза 0 (3–5 рабочих дней):</strong> клиент передаёт выгрузку <strong>100 отзывов + 100 заявок на возврат</strong> или доступ к API. Nero Network запускает пилотный пайплайн и отдаёт отчёт:</p>
<ul class="avz-ul"><li>топ-10 причин;</li><li>3 SKU с максимальным риском;</li><li>5 конкретных правок в карточках и процессах.</li></ul>
<p>Это лид-магнит <strong>«Разбор 100 отзывов и возвратов»</strong> — вход в воронку с доказуемой ценностью до контракта на полное внедрение.</p>
<h3>Настройка классификатора под ваши категории товаров</h3>
<p><strong>Фаза 2 — MVP (2–3 недели):</strong> ETL + LLM-разметка + дашборд (Metabase, Grafana или BI Битрикс24) + алерты. Модели: YandexGPT / GigaChat (on-prem, 152-ФЗ), RuBERT для тональности, при допустимости — OpenAI GPT-4o-mini / Claude.</p>
<p>Human-in-the-loop: модерация при низком confidence, выборочный аудит <strong>5–10%</strong> разметки.</p>
<h3>Дашборд и регламент для продуктовой и поддержки</h3>
<p>Дашборд отвечает на вопросы продуктовой, контента и логистики:</p>
<ul class="avz-ul"><li>какие SKU тянут возвраты вверх;</li><li>какая причина доминирует на каждой площадке;</li><li>есть ли <strong>reason-code drift</strong> — смена причин во времени (от «стиль» к «брак»).</li></ul>
<p>Регламент: кто правит карточку, кто эскалирует поставщику, SLA ответа на всплеск негатива.</p>
<h3>Запуск в прод и обучение команды</h3>
<p><strong>Фаза 3–4 (1–2 недели + 3–5 дней):</strong> интеграции с CRM, шаблоны ответов, логирование. Обучение: 2 сессии с командой клиента, инструкции, SLA поддержки.</p>
      </div>
    </div>
  </section>
  <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
    <div class="avz-cnt">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать AI до старта проекта?</p>
        <p class="ym-cta-block__sub">Перед пилотом продуктовая и поддержка могут пройти <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a> — так вы быстрее согласуете таксономию причин, регламент HITL и критерии эскалации.</p>
      </div>
    </div>
  </aside>
  <section class="avz-section avz-section-alt nero-ai-reveal" id="integracii">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">Интеграции</span>
        <h2>Интеграции: маркетплейсы, CRM и чаты поддержки</h2>
      </div>
      <div class="avz-body">
<p><strong>Интеграция ai анализ возвратов</strong> — ключевое отличие от SaaS «только для WB». <strong>AI анализ возвратов интеграция crm</strong> связывает сигнал покупателя с задачей ответственного.</p>
<h3>API Ozon, Wildberries, Яндекс Маркет — отзывы и возвраты</h3>
<ul class="avz-ul"><li><strong>Ozon Seller API</strong> — отзывы, вопросы, данные о возвратах (по доступным методам).</li><li><strong>Wildberries</strong> — отзывы, вопросы, заявки на возврат, чаты.</li><li><strong>Яндекс Маркет</strong> — отзывы, вопросы, метрики карточки.</li></ul>
<p><strong>AI обработка отзывов Ozon</strong> и <strong>AI обработка отзывов Wildberries</strong> в одном контуре — единая таксономия вместо трёх разрозненных кабинетов.</p>
<h3>amoCRM, Битрикс24, Usedesk, Jivo — обращения и тикеты</h3>
<p>Тикеты поддержки часто содержат причину возврата раньше, чем формальный отзыв на маркетплейсе. Связка helpdesk + маркетплейс даёт полную картину (подход Zendesk AI: intent detection на 100% обращений).</p>
<p>Кейс OSMI IT: интеграция с Bitrix24, до <strong>1000 отзывов/час</strong>, эскалация чувствительных кейсов.</p>
<h3>ERP/склад и 1С — связка с остатками и партиями</h3>
<p>Опционально: связь возврата с партией и поставщиком через 1С или МойСклад — чтобы кластер «брак» автоматически привязывался к дате поставки. Смежная услуга: <a href="/ai-1c-erp/" class="avz-link">внедрение AI в 1С/ERP</a> — без дублирования отдельной страницы, только как опция.</p>
<!-- INTERNAL-LINKS:INSERT -->
<h3>AI анализ возвратов без программиста — что входит в «под ключ»</h3>
<p><strong>AI анализ возвратов без программиста</strong> возможен, потому что Nero Network берёт на себя:</p>
<ul class="avz-ul"><li>настройку коннекторов и ETL;</li><li>оркестрацию через Make.com или n8n на MVP;</li><li>дашборд и алерты;</li><li>обучение команды.</li></ul>
<p>Со стороны клиента нужны: доступы к API, выгрузки, участие продуктового owner в согласовании таксономии — не разработчик в штате.</p>
      </div>
    </div>
  </section>
  <section class="avz-section nero-ai-reveal" id="dlya-kogo">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">Раздел</span>
        <h2>Для кого подходит услуга</h2>
      </div>
      <div class="avz-body">
<p><strong>AI анализ возвратов для компании</strong> и <strong>ai анализ возвратов для малого бизнеса</strong> — разные масштабы одного решения.</p>
<h3>Селлеры на маркетплейсах с растущим % возвратов</h3>
<p>50–500 SKU, 2–5 каналов данных, возвратность выше медианы по категории. Боль: кабинет WB/Ozon показывает цифру, но не объясняет всплеск. SaaS вроде MPtab («Сканер возвратов», обучен на 5+ млн отзывов WB) закрывает часть задачи, но <strong>не связывает отзывы с CRM и внутренними данными о возвратах</strong>.</p>
<h3>D2C-бренды и производители с собственным магазином</h3>
<p>Бренд продаёт на сайте + маркетплейсах: нужна <strong>единая правда</strong> о причинах негатива. Производителю важна связка «партия — поставщик — QC», а не только автоответы на отзывы (ILAI, SellerDen).</p>
<h3>Категории с высоким возвратом: одежда, обувь, электроника, косметика</h3>
<div class="avz-table-wrap"><table class="avz-table">
<thead><tr><th>Категория</th><th>% возвратов (ориентир, Россия 2025–2026)</th><th>Фокус AI-аналитики</th></tr></thead>
<tbody>
<tr><td>Fashion (маркетплейсы)</td><td>30–45%</td><td>Размер, фото, ожидания</td></tr>
<tr><td>Fashion D2C</td><td>15–25%</td><td>Описание, примерка, контент</td></tr>
<tr><td>Электроника</td><td>8–12%</td><td>Брак, комплектация, прошивка</td></tr>
<tr><td>Косметика</td><td>8–18%</td><td>Аллергия, запах, несоответствие оттенка</td></tr>
<tr><td>Продукты</td><td>2–5%</td><td>Сроки, повреждение, температура</td></tr>
</tbody></table></div>
      </div>
    </div>
  </section>
  <section class="avz-section avz-section-alt nero-ai-reveal" id="keisy">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">Раздел</span>
        <h2>Примеры и кейсы внедрения</h2>
      </div>
      <div class="avz-body">
<p><strong>AI анализ возвратов кейсы</strong> и <strong>ai анализ возвратов примеры внедрения</strong> на рынке — в основном смежные (отзывы + поддержка); прямых публичных кейсов по точному запросу «под ключ» мало. Ниже — проверенные ориентиры.</p>
<h3>Кейс: нашли массовую причину в описании размерной сетки</h3>
<p><strong>Сценарий (типовой, по методологии RefundSentry и OSMI IT):</strong> у SKU-хита 38% возвратов с формальным кодом «не подошёл размер». AI кластеризовал тексты: <strong>72% содержат «маломерит на размер»</strong>. Продукт обновил сетку и добавил предупреждение в карточку. Международный ориентир после таких правок — <strong>−20–35%</strong> возвратов на SKU (RefundSentry, заявление вендора).</p>
<h3>Кейс: всплеск негатива по доставке — реакция за 24 часа</h3>
<p><strong>Сценарий (по метрикам OSMI IT):</strong> алерт на кластер «повреждение упаковки» по региону за 48 часов. Логистика сменила упаковку для хрупкого SKU; поддержка проактивно ответила на отзывы. До внедрения AI реакция занимала <strong>7 дней</strong>; после — <strong>24 часа</strong>.</p>
<h3>Что измеряем до/после: % возвратов, NPS, время разбора обращений</h3>
<div class="avz-table-wrap"><table class="avz-table">
<thead><tr><th>Метрика</th><th>До</th><th>После (ориентиры рынка)</th></tr></thead>
<tbody>
<tr><td>Доля ручной аналитики</td><td>80–90%</td><td>≤10% (OSMI IT)</td></tr>
<tr><td>Время отчёта</td><td>7 дней</td><td>8–12 часов</td></tr>
<tr><td>Реакция на негатив</td><td>7 дней</td><td>24 часа</td></tr>
<tr><td>Возвраты по негативному опыту</td><td>базовый уровень</td><td>−9% (OSMI IT)</td></tr>
</tbody></table></div>
<h3>Сравнение подходов: ручной разбор vs BI vs SaaS vs внедрение под ключ</h3>
<div class="avz-table-wrap"><table class="avz-table">
<thead><tr><th>Критерий</th><th>Ручной разбор</th><th>BI-дашборд</th><th>SaaS (MPtab, ILAI)</th><th>Nero Network под ключ</th></tr></thead>
<tbody>
<tr><td>Смысл в свободном тексте</td><td>Частично</td><td>Нет</td><td>Да</td><td>Да</td></tr>
<tr><td>Связка с CRM/задачами</td><td>Нет</td><td>Нет</td><td>Ограниченно</td><td>Да</td></tr>
<tr><td>Кастомная таксономия</td><td>Да</td><td>Нет</td><td>Шаблон</td><td>Да</td></tr>
<tr><td>Все каналы (сайт + МП)</td><td>Сложно</td><td>Сложно</td><td>Часто только МП</td><td>Да</td></tr>
<tr><td>152-ФЗ / on-prem</td><td>Зависит</td><td>—</td><td>Облако вендора</td><td>YandexGPT, on-prem</td></tr>
<tr><td>Стоимость</td><td>FTE 6–10 ч/день</td><td>Лицензия BI</td><td>Подписка</td><td>150–450 тыс. ₽ проект</td></tr>
</tbody></table></div>
      </div>
    </div>
  </section>
<section id="ai-analiz-vozvratov-boris-block" class="bav-root nero-ai-reveal" aria-label="Анимация drill-down: от процента возврата к кластеру, цитате покупателя и задаче в CRM">
<style>
/* === БОРИС: prefix bav-, scoped внутри #ai-analiz-vozvratov-boris-block === */
#ai-analiz-vozvratov-boris-block.bav-root{
  padding:56px 0 64px;
  background:#f0f4fb;
}
#ai-analiz-vozvratov-boris-block .bav-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-analiz-vozvratov-boris-block .bav-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:24px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 44px rgba(15,23,42,.1),0 0 0 1px rgba(148,163,184,.16);
  min-height:520px;
}
@media(max-width:1023px){
  #ai-analiz-vozvratov-boris-block .bav-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-analiz-vozvratov-boris-block .bav-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-analiz-vozvratov-boris-block .bav-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-analiz-vozvratov-boris-block .bav-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#7c3aed;
  margin:0 0 14px;
}
#ai-analiz-vozvratov-boris-block .bav-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#ai-analiz-vozvratov-boris-block .bav-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-analiz-vozvratov-boris-block .bav-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-analiz-vozvratov-boris-block .bav-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-analiz-vozvratov-boris-block .bav-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(139,92,246,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#7c3aed;
  margin-top:1px;
  font-style:normal;
}
#ai-analiz-vozvratov-boris-block .bav-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-analiz-vozvratov-boris-block .bav-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-analiz-vozvratov-boris-block .bav-pl-r{
  background:rgba(249,115,22,.08);
  color:#c2410c;
  border:1.5px solid rgba(249,115,22,.22);
}
#ai-analiz-vozvratov-boris-block .bav-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-analiz-vozvratov-boris-block .bav-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-analiz-vozvratov-boris-block .bav-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-analiz-vozvratov-boris-block .bav-rgt{
  position:relative;
  background:linear-gradient(145deg,#050711 0%,#0a0f1f 48%,#080b17 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-analiz-vozvratov-boris-block .bav-rgt{min-height:380px;}
}
#bav-drilldown-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bav-cnt">
  <div class="bav-card">

    <div class="bav-lft">
      <span class="bav-ey">Explainability</span>
      <h3 class="bav-h3">От цифры «32% возвратов» — к цитате покупателя и задаче в CRM</h3>
      <ul class="bav-ul">
        <li><span class="bav-ic">1</span>Метрика % возврата по SKU сигнализирует о проблеме, а не объясняет её</li>
        <li><span class="bav-ic">2</span>AI группирует отзывы в кластер «маломерит» — 62% негатива на одном артикуле</li>
        <li><span class="bav-ic">3</span>Цитата-доказательство из WB/Ozon: «на размер больше, ткань колется»</li>
        <li><span class="bav-ic">4</span>Action layer: задача «Правка размерной сетки SKU-4567» уходит в amoCRM</li>
      </ul>
      <div class="bav-pills">
        <span class="bav-pl bav-pl-r">32% → кластер</span>
        <span class="bav-pl bav-pl-v">37 отзывов / нед.</span>
        <span class="bav-pl bav-pl-g">−20–35% возвратов*</span>
      </div>
      <p class="bav-foot">Дальше — форматы работы, пилот и ориентиры по стоимости →</p>
    </div>

    <div class="bav-rgt">
      <canvas
        id="bav-drilldown-canvas"
        aria-label="Анимация drill-down: процент возврата, кластер причин, цитата покупателя и задача в CRM"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bav-drilldown-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    cyan:'#79f2ff', viol:'#8b5cf6', green:'#22c55e', alert:'#f97316',
    text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    card:'rgba(255,255,255,.06)', cardBdr:'rgba(255,255,255,.12)',
    line:'rgba(255,255,255,.08)'
  };

  var CLUSTERS = [
    {label:'Размер', pct:62, hot:true},
    {label:'Фото', pct:18, hot:false},
    {label:'Брак', pct:11, hot:false},
    {label:'Доставка', pct:9, hot:false}
  ];

  var LOOP = 640;
  var PHASE = {KPI:0, CLUSTER:140, QUOTE:280, TASK:420};

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect){ctx.roundRect(x,y,w,h,r);}
    else{
      ctx.moveTo(x+r,y);ctx.arcTo(x+w,y,x+w,y+h,r);
      ctx.arcTo(x+w,y+h,x,y+h,r);ctx.arcTo(x,y+h,x,y,r);
      ctx.arcTo(x,y,x+w,y,r);ctx.closePath();
    }
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}
  }

  function ease(t){return t<0?0:t>1?1:t*t*(3-2*t);}

  function phaseAlpha(start,end){
    var f=frame%LOOP;
    if(f<start) return 0;
    if(f>=end) return 0;
    if(f<start+24) return ease((f-start)/24);
    if(f>end-24) return ease((end-f)/24);
    return 1;
  }

  function phaseProgress(start,dur){
    var f=frame%LOOP;
    if(f<start) return 0;
    if(f>=start+dur) return 1;
    return ease((f-start)/dur);
  }

  function drawHeader(){
    ctx.fillStyle=C.text;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('AI-аналитика возвратов · drill-down',16,24);
    ctx.fillStyle=C.muted;
    ctx.font='11px Inter,system-ui,sans-serif';
    ctx.fillText('SKU-4567 · платье · Wildberries',16,42);
    ctx.strokeStyle=C.line;ctx.lineWidth=1;
    ctx.beginPath();ctx.moveTo(0,52);ctx.lineTo(W,52);ctx.stroke();
  }

  function drawKpi(){
    var a=phaseAlpha(PHASE.KPI,PHASE.CLUSTER+30);
    if(a<=0) return;
    ctx.globalAlpha=a;
    var cx=W*0.5, cy=H*0.42;
    var pulse=1+0.03*Math.sin(frame*0.06);
    rr(cx-110,cy-70,220,140,16,C.card,C.cardBdr,1.5);
    ctx.fillStyle=C.alert;
    ctx.font='bold 42px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('32%',cx,cy-8);
    ctx.fillStyle=C.muted;
    ctx.font='12px Inter,system-ui,sans-serif';
    ctx.fillText('возвратов · fashion SKU',cx,cy+18);
    var ring=58*pulse;
    ctx.beginPath();ctx.arc(cx,cy-22,ring,0,Math.PI*2);
    ctx.strokeStyle='rgba(249,115,22,'+(0.15+0.1*Math.sin(frame*0.05))+')';
    ctx.lineWidth=3;ctx.stroke();
    ctx.globalAlpha=1;
  }

  function drawClusters(){
    var a=phaseAlpha(PHASE.CLUSTER-20,PHASE.QUOTE+40);
    if(a<=0) return;
    ctx.globalAlpha=a;
    var pad=20, top=68, barH=H-top-100;
    var barW=(W-pad*2-24)/4;
    var prog=phaseProgress(PHASE.CLUSTER,50);
    CLUSTERS.forEach(function(cl,i){
      var x=pad+i*(barW+8);
      var h=barH*(cl.pct/70)*prog;
      var y=top+barH-h;
      var fill=cl.hot
        ? 'rgba(139,92,246,'+(0.35+0.15*Math.sin(frame*0.08))+')'
        : 'rgba(121,242,255,0.18)';
      var stroke=cl.hot?C.viol:C.cyan;
      rr(x,y,barW,h,6,fill,stroke,cl.hot?2:1);
      ctx.fillStyle=cl.hot?C.viol:C.muted;
      ctx.font=(cl.hot?'bold ':'')+'10px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(cl.label,x+barW/2,top+barH+16);
      if(cl.hot&&prog>0.8){
        ctx.fillStyle=C.alert;
        ctx.font='bold 11px Inter,sans-serif';
        ctx.fillText(cl.pct+'%',x+barW/2,y-8);
      }
    });
    ctx.fillStyle=C.text;
    ctx.font='bold 13px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Кластер причин · неделя 12',pad,top-10);
    ctx.globalAlpha=1;
  }

  function drawQuote(){
    var a=phaseAlpha(PHASE.QUOTE-20,PHASE.TASK+30);
    if(a<=0) return;
    ctx.globalAlpha=a;
    var slide=phaseProgress(PHASE.QUOTE,40);
    var bx=W*0.5-150, by=H*0.52+(1-slide)*40;
    rr(bx,by,300,88,14,'rgba(249,115,22,0.12)',C.alert,1.5);
    ctx.fillStyle=C.alert;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('WB · ★2 · возврат',bx+14,by+22);
    ctx.fillStyle=C.text;
    ctx.font='13px Inter,sans-serif';
    var lines=['«На размер больше,','ткань колется,','на фото другое»'];
    lines.forEach(function(ln,j){
      ctx.fillText(ln,bx+14,by+42+j*16);
    });
    ctx.beginPath();
    ctx.moveTo(bx+30,by-10);ctx.lineTo(bx+44,by);ctx.lineTo(bx+16,by);
    ctx.closePath();
    ctx.fillStyle='rgba(249,115,22,0.12)';ctx.fill();
    ctx.globalAlpha=1;
  }

  function drawTask(){
    var a=phaseAlpha(PHASE.TASK-20,LOOP);
    if(a<=0) return;
    ctx.globalAlpha=a;
    var slide=phaseProgress(PHASE.TASK,45);
    var tx=W*0.5-130, ty=H*0.78+(1-slide)*50;
    rr(tx,ty,260,72,12,'rgba(34,197,94,0.12)',C.green,2);
    ctx.fillStyle=C.green;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('✓ Задача в amoCRM',tx+14,ty+22);
    ctx.fillStyle=C.text;
    ctx.font='12px Inter,sans-serif';
    ctx.fillText('Правка размерной сетки',tx+14,ty+42);
    ctx.fillStyle=C.muted;
    ctx.font='11px Inter,sans-serif';
    ctx.fillText('SKU-4567 · продукт · срок 24ч',tx+14,ty+58);
    var dot=6+2*Math.sin(frame*0.1);
    ctx.beginPath();ctx.arc(tx+230,ty+20,dot,0,Math.PI*2);
    ctx.fillStyle='rgba(34,197,94,0.25)';ctx.fill();
    ctx.beginPath();ctx.arc(tx+230,ty+20,4,0,Math.PI*2);
    ctx.fillStyle=C.green;ctx.fill();
    ctx.globalAlpha=1;
  }

  function drawStepIndicator(){
    var steps=['%','Кластер','Цитата','CRM'];
    var f=frame%LOOP;
    var active=f<PHASE.CLUSTER?0:f<PHASE.QUOTE?1:f<PHASE.TASK?2:3;
    var startX=W-16-steps.length*52;
    steps.forEach(function(s,i){
      var x=startX+i*52, y=H-28;
      var on=i===active;
      rr(x,y,44,20,10,on?'rgba(121,242,255,0.15)':'rgba(255,255,255,0.04)',on?C.cyan:C.cardBdr,1);
      ctx.fillStyle=on?C.cyan:C.muted;
      ctx.font=(on?'bold ':'')+'9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(s,x+22,y+14);
    });
  }

  function loop(){
    frame++;
    ctx.clearRect(0,0,W,H);
    drawHeader();
    drawKpi();
    drawClusters();
    drawQuote();
    drawTask();
    drawStepIndicator();
    requestAnimationFrame(loop);
  }

  if(document.fonts&&document.fonts.ready){
    document.fonts.ready.then(loop);
  } else {
    loop();
  }
})();
</script>
</section>
  <section class="avz-section nero-ai-reveal" id="stoimost">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">Раздел</span>
        <h2>Стоимость и форматы работы</h2>
      </div>
      <div class="avz-body">
<p><strong>AI анализ возвратов цена</strong> зависит от числа каналов, глубины интеграций и объёма SKU. <strong>Сколько стоит ai анализ возвратов</strong> — вопрос из FAQ; ниже ориентиры из коммерческой модели Nero Network.</p>
<div class="avz-pricing-grid">
  <div class="avz-price-card">
    <div class="avz-price-tag">Лид-магнит</div>
    <h3>Разбор 100 отзывов</h3>
    <div class="avz-price-val">Бесплатный старт</div>
    <p>100 отзывов + 100 возвратов → топ-10 причин, 3 рисковых SKU, 5 правок в карточках. Минимальный риск перед контрактом.</p>
  </div>
  <div class="avz-price-card avz-price-card--featured">
    <div class="avz-price-tag">Пилот</div>
    <h3>Дашборд + алерты</h3>
    <div class="avz-price-val">150–250 тыс. ₽</div>
    <p>MVP: 1–2 канала, дашборд, алерты, одна интеграция (CRM или второй маркетплейс). Срок: <strong>3–4 недели</strong>.</p>
  </div>
  <div class="avz-price-card">
    <div class="avz-price-tag">Под ключ</div>
    <h3>Полное внедрение</h3>
    <div class="avz-price-val">250–450 тыс. ₽</div>
    <p>Все маркетплейсы + CRM + helpdesk + опционально ERP. HITL, обучение, регламенты. Срок: <strong>4–6 недель</strong>.</p>
  </div>
</div>
<p>Сравнение с альтернативами: enterprise VoC (Revuze) — от <strong>~$30 000/год</strong> по оценкам обзоров; один оператор на ручной разбор — <strong>от 80 000 ₽/мес</strong> при полной занятости; обратная логистика WB с 2026 — растущая статья при каждом лишнем возврате.</p>
<div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" style="margin-top:28px;">
  <p class="ym-cta-block__headline">Найти причины возвратов</p>
  <p class="ym-cta-block__sub">Оставьте заявку: площадка (Ozon / WB / свой магазин), объём отзывов и возвратов в месяц, контакт. Мы предложим формат — от разбора 100 отзывов до полного <strong>ai анализ возвратов под ключ</strong>.</p>
  <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
</div>
      </div>
    </div>
  </section>
  <section class="avz-section avz-section-alt nero-ai-reveal" id="faq">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">FAQ</span>
        <h2>FAQ: как внедрить AI-анализ возвратов</h2>
      </div>
      <div class="avz-body">
<div class="avz-faq">
        <details class="avz-faq-item nero-ai-reveal">
          <summary class="avz-faq-q">Нужны ли программисты с нашей стороны?</summary>
          <div class="avz-faq-a"><p>Нет, если выбираете формат <strong>ai анализ возвратов без программиста</strong> / под ключ. Nero Network настраивает коннекторы, ETL, дашборд и алерты. От клиента — доступы к API, продуктовый owner, согласование таксономии.</p></div>
        </details>
        <details class="avz-faq-item nero-ai-reveal">
          <summary class="avz-faq-q">Сколько времени занимает пилот?</summary>
          <div class="avz-faq-a"><p><strong>3–5 рабочих дней</strong> на лид-магнит «100 отзывов + 100 возвратов». Полный MVP — <strong>2–3 недели</strong>, полное внедрение — <strong>4–6 недель</strong>.</p></div>
        </details>
        <details class="avz-faq-item nero-ai-reveal">
          <summary class="avz-faq-q">Какие данные нужны для старта?</summary>
          <div class="avz-faq-a"><ul class="avz-ul"><li>Выгрузки или API к отзывам, вопросам, чатам (минимум <strong>3 месяца</strong> истории).</li><li>Данные о возвратах: SKU, дата, формальная причина, статус, канал.</li><li>Справочник товаров: артикул, категория, поставщик, размерная сетка.</li><li>Желательно: фото из отзывов, логистические SLA.</li></ul></div>
        </details>
        <details class="avz-faq-item nero-ai-reveal">
          <summary class="avz-faq-q">Как избежать галлюцинаций LLM при разборе отзывов?</summary>
          <div class="avz-faq-a"><ul class="avz-ul"><li>Порог <strong>confidence</strong> и маршрутизация в human-in-the-loop при значениях ниже <strong>0,6</strong>.</li><li>Цитата-доказательство в каждой разметке.</li><li>Выборочный аудит <strong>5–10%</strong> разметки.</li><li>Запрет на «выдуманные» причины без привязки к тексту.</li><li>Для критичных категорий (брак, безопасность) — только подтверждённые кластеры.</li></ul></div>
        </details>
        <details class="avz-faq-item nero-ai-reveal">
          <summary class="avz-faq-q">Юридические ограничения на обработку отзывов и ПДн</summary>
          <div class="avz-faq-a"><p>Отзывы с именем, email и телефоном — <strong>персональные данные</strong> (152-ФЗ). Нужны: правовое основание, политика конфиденциальности, при поручении обработки — договор с Nero Network. При трансграничной передаче в зарубежные LLM — отдельная оценка рисков; альтернатива — <strong>YandexGPT</strong>, <strong>GigaChat</strong>, on-prem.</p></div>
        </details>
        <details class="avz-faq-item nero-ai-reveal">
          <summary class="avz-faq-q">Чем отличается от ручного разбора и BI-дашбордов?</summary>
          <div class="avz-faq-a"><p>Кабинет маркетплейса и BI показывают <strong>что</strong> произошло (% возврата, reason code). <strong>AI анализ возвратов</strong> показывает <strong>почему</strong> в свободном тексте, кластеризует синонимы, ставит задачи и алертирует до того, как проблема станет массовой. Это не замена BI, а <strong>смысловой слой</strong> поверх него.</p></div>
        </details>
        <details class="avz-faq-item nero-ai-reveal">
          <summary class="avz-faq-q">Как внедрить ai анализ возвратов, если отзывов мало?</summary>
          <div class="avz-faq-a"><p>Старт с категорийных аналогов, подключение чатов и тикетов (там сигнал появляется раньше), пилот на 100 единиц. Для новых SKU — мониторинг первых 10–20 отзывов с пониженным порогом алерта.</p></div>
        </details>
        <details class="avz-faq-item nero-ai-reveal">
          <summary class="avz-faq-q">Какие маркетплейсы поддерживаются?</summary>
          <div class="avz-faq-a"><p>Ozon, Wildberries, Яндекс Маркет — через API; плюс собственный интернет-магазин, маркетплейсы как источник через выгрузки при ограничениях API.</p></div>
        </details>
</div>
      </div>
    </div>
  </section>
  <section class="avz-section nero-ai-reveal" id="related">
    <div class="avz-cnt">
      <div class="avz-sh">
        <span class="avz-eyebrow">Раздел</span>
        <h2>Связанные услуги Nero Network</h2>
      </div>
      <div class="avz-body">
<p><strong>Внедрение ai в бизнес</strong> для e-commerce редко ограничивается одним модулем. Смежные проекты Nero Network:</p>
<ul class="avz-ul"><li><a href="/vnedrenie-ai-amocrm/" class="avz-link">Внедрение AI в amoCRM</a> — автоматизация воронки и задач после анализа обращений.</li><li><a href="/vnedrenie-ai-obrabotka-email-crm/" class="avz-link">AI-обработка email и CRM</a> — если часть негатива приходит на почту.</li><li><a href="/ai-1c-erp/" class="avz-link">AI для 1С и ERP</a> — связка возвратов с партиями, остатками и закупкой.</li></ul>
<p><strong>AI анализ возвратов</strong> — логичная первая зона внедрения AI в клиентский опыт: понятный ROI, измеримые метрики, низкий операционный риск при human-in-the-loop. Как рекомендует IBM (март 2026), начинать стоит именно с обработки обращений и качества сервиса — там эффект виден быстрее всего.</p>
<p><strong>Найти причины возвратов.</strong> Закажите <strong>разбор 100 отзывов и возвратов</strong> — получите топ-причин, рисковые SKU и конкретные правки до решения о полном внедрении.</p>
      </div>
    </div>
  </section>
  <!-- AD_BANNER: не настроен; при появлении env вставить:
<a href="${AD_BANNER_URL}" target="_blank" rel="noopener noreferrer">
  <img src="${AD_BANNER_IMAGE_URL}" width="970" height="90" alt="${AD_BANNER_ALT}" loading="lazy" decoding="async" style="max-width:100%; height:auto; border-radius:12px; box-shadow:var(--ym-shadow-sm);">
</a>
-->
</div>

  <!-- INTERNAL-LINKS:INSERT -->

<?php
$avz_page_url = trailingslashit( get_permalink() );
$avz_site_url = trailingslashit( home_url( '/' ) );
$avz_schema_h1 = 'AI-анализ возвратов и негативных отзывов: внедрение под ключ';
$avz_schema = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $avz_site_url . '#organization',
      'name'  => $brand,
      'url'   => $avz_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $avz_site_url . '#website',
      'url'       => $avz_site_url,
      'name'      => $brand,
      'publisher' => [ '@id' => $avz_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $avz_page_url . '#webpage',
      'url'         => $avz_page_url,
      'name'        => $avz_schema_h1,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $avz_site_url . '#website' ],
      'about'       => [ '@id' => $avz_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $avz_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $avz_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $avz_schema_h1, 'item' => $avz_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $avz_page_url . '#service',
      'name'        => $avz_schema_h1,
      'description' => $page_seo_description,
      'url'         => $avz_page_url,
      'provider'    => [ '@id' => $avz_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $avz_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Нужны ли программисты с нашей стороны?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет, если выбираете формат ai анализ возвратов без программиста / под ключ. Nero Network настраивает коннекторы, ETL, дашборд и алерты. От клиента — доступы к API, продуктовый owner, согласование таксономии.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько времени занимает пилот?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '3–5 рабочих дней на лид-магнит «100 отзывов + 100 возвратов». Полный MVP — 2–3 недели, полное внедрение — 4–6 недель.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие данные нужны для старта?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '• Выгрузки или API к отзывам, вопросам, чатам (минимум 3 месяца истории). • Данные о возвратах: SKU, дата, формальная причина, статус, канал. • Справочник товаров: артикул, категория, поставщик, размерная сетка. • Желательно: фото из отзывов, логистические SLA.' ] ],
        [ '@type' => 'Question', 'name' => 'Как избежать галлюцинаций LLM при разборе отзывов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '• Порог confidence и маршрутизация в human-in-the-loop при значениях ниже 0,6. • Цитата-доказательство в каждой разметке. • Выборочный аудит 5–10% разметки. • Запрет на «выдуманные» причины без привязки к тексту. • Для критичных категорий (брак, безопасность) — только подтверждённые кластеры.' ] ],
        [ '@type' => 'Question', 'name' => 'Юридические ограничения на обработку отзывов и ПДн', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Отзывы с именем, email и телефоном — персональные данные (152-ФЗ). Нужны: правовое основание, политика конфиденциальности, при поручении обработки — договор с Nero Network. При трансграничной передаче в зарубежные LLM — отдельная оценка рисков; альтернатива — YandexGPT, GigaChat, on-prem.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем отличается от ручного разбора и BI-дашбордов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Кабинет маркетплейса и BI показывают что произошло (% возврата, reason code). AI анализ возвратов показывает почему в свободном тексте, кластеризует синонимы, ставит задачи и алертирует до того, как проблема станет массовой. Это не замена BI, а смысловой слой поверх него.' ] ],
        [ '@type' => 'Question', 'name' => 'Как внедрить ai анализ возвратов, если отзывов мало?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Старт с категорийных аналогов, подключение чатов и тикетов (там сигнал появляется раньше), пилот на 100 единиц. Для новых SKU — мониторинг первых 10–20 отзывов с пониженным порогом алерта.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие маркетплейсы поддерживаются?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ozon, Wildberries, Яндекс Маркет — через API; плюс собственный интернет-магазин, маркетплейсы как источник через выгрузки при ограничениях API.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $avz_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>

<script>
(function () {
  'use strict';

  var root = document.querySelector('.nero-ai-home-page');
  if (!root) return;

  var revealItems = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

    revealItems.forEach(function (item) { observer.observe(item); });
  } else {
    revealItems.forEach(function (item) { item.classList.add('nero-ai-active'); });
  }

  var tooltipItems = root.querySelectorAll('[data-nero-tooltip]');
  tooltipItems.forEach(function (item) {
    if (!item.hasAttribute('tabindex')) item.setAttribute('tabindex', '0');

    item.addEventListener('click', function (event) {
      var isActive = item.classList.contains('nero-ai-tooltip-active');
      tooltipItems.forEach(function (other) { other.classList.remove('nero-ai-tooltip-active'); });
      if (!isActive) item.classList.add('nero-ai-tooltip-active');
      event.stopPropagation();
    });
  });

  document.addEventListener('click', function () {
    tooltipItems.forEach(function (item) { item.classList.remove('nero-ai-tooltip-active'); });
  });

  var counters = root.querySelectorAll('[data-nero-count]');
  function animateCounter(el) {
    var target = parseFloat(el.getAttribute('data-nero-count') || '0');
    var suffix = el.getAttribute('data-nero-suffix') || '';
    var prefix = el.getAttribute('data-nero-prefix') || '';
    var duration = 850;
    var start = performance.now();

    function frame(now) {
      var progress = Math.min((now - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var value = Math.round(target * eased);
      el.textContent = prefix + value + suffix;
      if (progress < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  if ('IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting && !entry.target.dataset.neroDone) {
          entry.target.dataset.neroDone = '1';
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.35 });
    counters.forEach(function (counter) { counterObserver.observe(counter); });
  } else {
    counters.forEach(animateCounter);
  }
})();

</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
