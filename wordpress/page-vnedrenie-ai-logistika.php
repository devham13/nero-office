<?php
/**
 * Template Name: Внедрение AI в логистику и склад под ключ
 * Description: SEO-лендинг — AI для логистики и склада: прогноз, маршрутизация, WMS/TMS, кейсы и цены.
 */

declare(strict_types=1);

$page_seo_title       = 'Внедрение AI в логистику и склад под ключ — цена и кейсы';
$page_seo_description = 'AI для логистики и склада: прогноз нагрузки и остатков, маршрутизация, контроль комплектации и сроков. Внедрение под ключ для e-commerce, дистрибуции и производства. Оцените экономику.';

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
    ['label' => 'Зачем AI', 'href' => '#zachem'],
    ['label' => 'Задачи', 'href' => '#zadachi'],
    ['label' => 'Внедрение', 'href' => '#usluga'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить логистику';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#zachem';

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
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

.vnal-hero-logistika{
  min-height:100vh;min-height:100dvh;position:relative;
}

.vnal-content{
  --vnal-bg:#050711;--vnal-bg2:#080b17;--vnal-bg3:#0a0e1c;
  --vnal-surface:rgba(255,255,255,.072);--vnal-text:#e6edf7;--vnal-muted:#9aa8bd;
  --vnal-soft:#c7d2e5;--vnal-heading:#fff;--vnal-border:rgba(255,255,255,.10);
  --vnal-accent:#79f2ff;--vnal-violet:#8b5cf6;--vnal-green:#22c55e;
  --vnal-btn-from:#2563eb;--vnal-btn-to:#7c3aed;
  --vnal-r:18px;--vnal-r-lg:24px;--vnal-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnal-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vnal-content *,.vnal-content *::before,.vnal-content *::after{box-sizing:border-box;}
.vnal-content a{color:inherit;text-decoration:none;}
.vnal-content p{color:var(--vnal-muted);line-height:1.72;margin:0 0 1em;}
.vnal-content p:last-child{margin-bottom:0;}
.vnal-content h2,.vnal-content h3,.vnal-content h4{color:var(--vnal-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.vnal-content strong{color:var(--vnal-soft);}
.vnal-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vnal-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnal-muted);font-size:14.5px;line-height:1.65;}
.vnal-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnal-accent);font-weight:700;}
.vnal-cnt{width:min(var(--vnal-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.vnal-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vnal-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.vnal-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vnal-sh.vnal-left{margin-left:0;text-align:left;}
.vnal-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vnal-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vnal-sh.vnal-left p{margin-left:0;}
.vnal-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnal-accent);margin-bottom:14px;}
.vnal-gt{background:linear-gradient(92deg,#fff 0%,var(--vnal-accent) 44%,var(--vnal-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.vnal-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vnal-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.vnal-intro-text{position:relative;padding-left:20px;text-align:left;}
.vnal-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vnal-accent),var(--vnal-violet));}
.vnal-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vnal-muted);margin-bottom:1em;}
.vnal-intro-text p:last-child{margin-bottom:0;color:var(--vnal-soft);}
.vnal-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.vnal-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.vnal-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vnal-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.vnal-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnal-muted);line-height:1.4;}
.vnal-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.vnal-intro-grid{grid-template-columns:1fr;gap:36px;}.vnal-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.vnal-intro-kpi{grid-template-columns:1fr 1fr;}}
.vnal-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.ym-toc,.vnal-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.ym-toc a,.vnal-toc a{display:inline-block;padding:9px 18px;background:var(--vnal-surface);border:1px solid var(--vnal-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vnal-muted);transition:border-color .2s,color .2s,background .2s;}
.ym-toc a:hover,.vnal-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vnal-accent);background:rgba(121,242,255,.08);}
.vnal-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.vnal-table{width:100%;border-collapse:collapse;font-size:14px;}
.vnal-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vnal-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.vnal-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vnal-text);vertical-align:top;}
.vnal-table tr:last-child td{border-bottom:none;}
.vnal-table tr:hover td{background:rgba(255,255,255,.03);}
.vnal-table .vnal-warn::before{content:'⚠ ';color:#fbbf24;}
.vnal-kpi-badge{display:inline-block;padding:3px 9px;border-radius:6px;font-size:11px;font-weight:700;background:rgba(121,242,255,.1);color:#79f2ff;margin-right:4px;}
.vnal-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vnal-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnal-case-grid{grid-template-columns:1fr;}}
.vnal-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.vnal-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vnal-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnal-green);margin-bottom:10px;}
.vnal-case-card h3{font-size:16px;margin-bottom:14px;}
.vnal-case-metric{font-size:clamp(28px,4vw,40px);font-weight:900;color:var(--vnal-accent);letter-spacing:-.04em;margin-bottom:8px;}
.vnal-flow{background:rgba(15,23,42,.6);border:1px solid rgba(121,242,255,.2);border-radius:14px;padding:20px 24px;margin:20px 0;font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:13px;line-height:1.7;color:var(--vnal-soft);white-space:pre-wrap;}
.vnal-timeline{position:relative;padding-left:40px;}
.vnal-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnal-accent),var(--vnal-violet));opacity:.35;border-radius:2px;}
.vnal-tl-item{position:relative;margin-bottom:32px;}
.vnal-tl-item:last-child{margin-bottom:0;}
.vnal-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnal-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.vnal-tl-item h3{font-size:17px;margin-bottom:8px;}
.vnal-tl-item p{font-size:14.5px;margin:0;}
.vnal-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vnal-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.vnal-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnal-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.vnal-faq-q::after{content:'▾';font-size:13px;color:var(--vnal-accent);flex-shrink:0;transition:transform .25s;}
.vnal-faq-item.open .vnal-faq-q::after{transform:rotate(180deg);}
.vnal-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vnal-muted);line-height:1.72;}
.vnal-faq-item.open .vnal-faq-a{max-height:600px;padding:0 24px 20px;}
.vnal-lead-magnet{background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.08));border:1px solid rgba(121,242,255,.28);border-radius:24px;padding:40px 36px;text-align:center;margin:32px 0;}
.vnal-lead-magnet__icon{font-size:40px;margin-bottom:12px;}
.vnal-lead-magnet h2{font-size:clamp(22px,3vw,32px);margin-bottom:12px;}
.vnal-lead-magnet__lead{font-size:15px;color:var(--vnal-muted);max-width:560px;margin:0 auto 20px;}
.vnal-lead-magnet__checklist{list-style:none;padding:0;margin:0 auto 24px;max-width:480px;text-align:left;}
.vnal-lead-magnet__checklist li{padding:6px 0 6px 24px;position:relative;color:var(--vnal-soft);font-size:14.5px;}
.vnal-lead-magnet__checklist li::before{content:'✓';position:absolute;left:0;color:var(--vnal-green);font-weight:800;}
.vnal-blockquote{border-left:3px solid var(--vnal-violet);padding:12px 20px;margin:20px 0;background:rgba(139,92,246,.08);border-radius:0 12px 12px 0;font-style:italic;color:var(--vnal-soft);}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--vnal-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vnal-btn-from),var(--vnal-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--vnal-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--vnal-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-logistika-page" role="main" tabindex="-1">


<section class="nero-ai-hero vnal-hero-logistika" id="hero" aria-labelledby="hero-vnal-title">
<style>
/* Hero логистики — самодостаточный блок (префикс vnal-) */
.vnal-hero-logistika {
  --vnal-accent: #79f2ff;
  --vnal-violet: #8b5cf6;
  --vnal-green: #22c55e;
  --vnal-muted: #9aa8bd;
}
.vnal-hero-logistika .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnal-accent) 44%, var(--vnal-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnal-hero-logistika .nero-ai-dashboard {
  border-color: rgba(121, 242, 255, 0.14);
  box-shadow: 0 28px 80px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.06);
}
.vnal-hero-logistika .nero-ai-window-title {
  font-size: 10px;
  letter-spacing: 0.04em;
}
.vnal-hero-logistika .nero-ai-metric strong {
  color: var(--vnal-accent);
}
.vnal-hero-logistika .nero-ai-metric:nth-child(2) strong { color: var(--vnal-violet); }
.vnal-hero-logistika .nero-ai-metric:nth-child(3) strong { color: var(--vnal-green); }
.vnal-hero-logistika .nero-ai-metric:nth-child(4) strong { color: #fbbf24; }
.vnal-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 35% 40%, rgba(121, 242, 255, 0.08), rgba(6, 10, 24, 0.92) 72%);
}
#vnal-logistics-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnal-hero-logistika .nero-ai-task-icon {
  background: rgba(121, 242, 255, 0.12);
  color: var(--vnal-accent);
}
.vnal-hero-logistika .nero-ai-status {
  background: rgba(34, 197, 94, 0.11);
  color: #bbf7d0;
}
.vnal-hero-logistika .nero-ai-status--amber {
  background: rgba(245, 158, 11, 0.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vnal-hero-logistika .nero-ai-hero-grid { grid-template-columns: 1fr; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai логистика</p>
      <h1 id="hero-vnal-title">AI для логистики и склада: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Прогнозируем нагрузку и остатки, оптимизируем маршруты и комплектацию — меньше ошибок, быстрее отгрузки</p>
      <ul class="nero-ai-badges" aria-label="Ключевые зоны AI">
        <li class="nero-ai-badge">Прогноз остатков</li>
        <li class="nero-ai-badge">Маршруты</li>
        <li class="nero-ai-badge">WMS/TMS</li>
        <li class="nero-ai-badge">Комплектация</li>
        <li class="nero-ai-badge">Last-mile</li>
        <li class="nero-ai-badge">Документы</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?> target="_blank" rel="noopener noreferrer"><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zachem">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI на складе и в логистике">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">WMS · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Складской AI-центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>OTIF</span><strong>94%</strong><small>в срок</small></div>
            <div class="nero-ai-metric"><span>MAPE</span><strong>12%</strong><small>прогноз</small></div>
            <div class="nero-ai-metric"><span>Пробег</span><strong>−22%</strong><small>отбор</small></div>
            <div class="nero-ai-metric"><span>Ошибки</span><strong>−18%</strong><small>комплектация</small></div>
          </div>

          <div class="vnal-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnal-logistics-hero-canvas" role="img" aria-label="Анимация: паллеты по орбитам зон склада, AI оптимизирует маршрут отбора и отгрузку last-mile"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий WMS">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">FC</span>
              <div><strong>Прогноз спроса</strong><span>Топ-SKU · нагрузка смены</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WV</span>
              <div><strong>Волна отбора #47</strong><span>Батчинг · 128 заказов</span></div>
              <span class="nero-ai-status">активно</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">RT</span>
              <div><strong>Маршрут сборщика</strong><span>−22% пробег · TSP</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Алерт дефицита SKU-8842</strong><span>human-in-the-loop · закупка</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
```

<div class="vnal-content">

  <section class="vnal-intro" id="intro">
    <div class="vnal-cnt">
      <div class="vnal-intro-grid nero-ai-reveal">
        <div class="vnal-intro-text">
          <p><strong>Коротко:</strong> AI для логистики и склада — это не чат-бот на сайте, а связка прогнозирования, оптимизации маршрутов и контроля операций, встроенная в WMS, TMS и ERP. Nero Network внедряет такие решения под ключ: от аудита данных до пилота с измеримым ROI.</p>
          <p>Ошибки в остатках, маршрутах, комплектации и сроках доставки обходятся складу и дистрибуции дороже, чем кажется на первый взгляд. Один неверный остаток — срыв отгрузки. Лишний километр сборщика — потерянные минуты на каждом заказе. Просроченная доставка — штраф маркетплейса или потерянный клиент. <strong>Внедрение AI в логистику</strong> закрывает эти узкие места системно.</p>
          <p>Если вы ищете <strong>ai логистика под ключ</strong> — с понятной экономикой, интеграцией с 1С или МойСклад и без «магии нейросети ради нейросети» — этот материал покажет, как устроено <strong>внедрение ai логистика</strong> на практике.</p>
        </div>
        <div class="vnal-intro-kpi" aria-label="Ключевые показатели рынка">
          <div class="vnal-kpi-card"><div class="kv">$30–34 млрд</div><div class="kl">рынок складской автоматизации</div><div class="ks">CAGR ~14%</div></div>
          <div class="vnal-kpi-card"><div class="kv">80%</div><div class="kl">складов без полной автоматизации</div><div class="ks">окно для преимущества</div></div>
          <div class="vnal-kpi-card"><div class="kv">45%</div><div class="kl">компаний с ML-прогнозом</div><div class="ks">Olimp Warehousing, 2025</div></div>
          <div class="vnal-kpi-card"><div class="kv">250+ млрд ₽</div><div class="kl">инвестиции РФ в ИИ</div><div class="ks">CNews, 2025</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vnal-toc-outer">
    <div class="vnal-cnt">
      <nav class="ym-toc vnal-toc" aria-label="Оглавление">
        <a href="#zachem">Зачем AI</a>
        <a href="#zadachi">Задачи</a>
        <a href="#usluga">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <section class="vnal-section" id="zachem">
    <div class="vnal-cnt">
      <div class="vnal-sh nero-ai-reveal">
        <span class="vnal-eyebrow">Отрасль 2026</span>
        <h2>Зачем складу и логистике AI в 2026 году</h2>
        <p><strong>Определение:</strong> AI для логистики и склада — ML-модули, оптимизаторы и agentic-ассистенты в WMS, TMS, ERP: прогноз спроса, маршруты, комплектация, документы.</p>
      </div>
      <div class="nero-ai-reveal">
        <p>Рынок складской автоматизации в 2026 году оценивается в <strong>$30–34 млрд</strong> с CAGR около 14%. При этом примерно <strong>80% складов</strong> по-прежнему работают без полноценной автоматизации. В России крупные игроки уже масштабируют алгоритмы: Ozon, X5, Яндекс, Лемана Про.</p>
        <p>По данным обзора CNews (2026), отечественные компании инвестировали в ИИ <strong>более 250 млрд ₽</strong> в 2025 году. В логистике инвестиции концентрируются там, где есть измеримый эффект: forecasting, data handling, оптимизация операций.</p>

        <h3>Ошибки в остатках, маршрутах и комплектации — где теряются деньги</h3>
        <div class="vnal-table-wrap">
          <table class="vnal-table">
            <thead><tr><th>Проблема</th><th>Как проявляется</th><th>Скрытая стоимость</th></tr></thead>
            <tbody>
              <tr><td class="vnal-warn">Ошибки в остатках</td><td>«На экране есть, на полке нет»</td><td>Срыв отгрузки, штрафы маркетплейса</td></tr>
              <tr><td class="vnal-warn">Неоптимальные маршруты</td><td>Сборщик ходит кругами</td><td>+15–30% пробега</td></tr>
              <tr><td class="vnal-warn">Ошибки комплектации</td><td>Пересорт, недокомплект</td><td>Возвраты, переделка</td></tr>
              <tr><td class="vnal-warn">Срыв сроков доставки</td><td>OTIF падает</td><td>Потеря SLA, отток клиентов</td></tr>
            </tbody>
          </table>
        </div>

        <h3>Forecasting и data handling в реальных операциях</h3>
        <p>В 2026 году индустрия переходит от «copilot» к AI-native workflow в planning, transport и warehousing. Практическое <strong>внедрение ai в бизнес процессы</strong> логистики строится на двух столпах:</p>
        <ul>
          <li><strong>Forecasting</strong> — прогноз спроса, нагрузки на смену, потребности в персонале и транспорте.</li>
          <li><strong>Data handling</strong> — нормализация SKU, остатков, заказов; единый справочник складов.</li>
        </ul>
        <p>По опросу Olimp Warehousing (2025), <strong>45% компаний</strong> уже используют ML для прогноза спроса. Для логистики <strong>human-in-the-loop</strong> — обязательный элемент зрелого внедрения (arXiv 2605.14675).</p>
      </div>
    </div>
  </section>

  <section class="vnal-section vnal-section-alt" id="zadachi">
    <div class="vnal-cnt">
      <div class="vnal-sh nero-ai-reveal">
        <span class="vnal-eyebrow">Задачи AI</span>
        <h2>Какие задачи решает AI для логистики и склада</h2>
        <p><strong>Коротко:</strong> <strong>ai решения для логистика</strong> закрывают шесть зон — прогноз, размещение, отбор, доставка, документы, исключения.</p>
      </div>
      <div class="nero-ai-reveal">
        <div class="vnal-table-wrap">
          <table class="vnal-table">
            <thead><tr><th>Задача</th><th>Технология</th><th>KPI</th></tr></thead>
            <tbody>
              <tr><td>Прогноз спроса и остатков</td><td>ML (Prophet, XGBoost)</td><td><span class="vnal-kpi-badge">MAPE</span> оборачиваемость</td></tr>
              <tr><td>Слоттинг и батчинг</td><td>Оптимизация</td><td><span class="vnal-kpi-badge">км</span> время отбора</td></tr>
              <tr><td>Маршрутизация last-mile</td><td>TMS + AI</td><td><span class="vnal-kpi-badge">OTIF</span> стоимость рейса</td></tr>
              <tr><td>Контроль комплектации</td><td>CV + правила</td><td>% ошибок</td></tr>
              <tr><td>Документооборот</td><td>LLM + шаблоны</td><td>Время ЭТРН/CMR</td></tr>
              <tr><td>Исключения</td><td>Agentic-ассистент</td><td>Время реакции</td></tr>
            </tbody>
          </table>
        </div>

        <h3>Прогноз нагрузки и остатков</h3>
        <p><strong>Прогноз остатков ai</strong> — один из первых модулей с быстрой окупаемостью. Модель учитывает историю продаж (12–24 месяца), сезонность, промо, остатки по складам и входящие заказы с маркетплейсов.</p>

        <h3>Маршрутизация и last-mile</h3>
        <p><strong>Ai маршрутизация доставки</strong> работает внутри склада (TSP на тысячах ячеек) и на last-mile (рейсы курьеров с учётом окон доставки). Кейс FM Logistic + Google AlphaEvolve: <strong>+10,4% эффективности</strong> и <strong>−15 000+ км/год</strong> пробега.</p>

        <h3>Контроль комплектации и сроков отгрузки</h3>
        <p><strong>Контроль комплектации ai</strong> сочетает правила WMS, сверку веса/сканирования и алерты при расхождениях. Для e-commerce критичен OTIF — AI предсказывает риск срыва до задержки.</p>

        <h3>AI-агенты в складских и транспортных процессах</h3>
        <p>По опросу ORTEC (14.01.2026): <strong>42%</strong> компаний ещё не исследуют agentic AI; <strong>23%</strong> планируют пилот. Типовой сценарий — агент-диспетчер исключений с audit log.</p>
        <blockquote class="vnal-blockquote">«Executives are entering 2026 with a clear mandate: make Agentic AI real, measurable, and safe for operations» — Daphne de Poot, SVP Operations ORTEC.</blockquote>
      </div>
    </div>
  </section>

<!-- ================================================
       БОРИС: после #zadachi, перед #usluga
       ================================================ -->
  <section id="vnedrenie-ai-logistika-boris-block" class="vnal-b-root" aria-label="Анимация: AI оптимизирует маршрут сборщика и волну отбора на складе">
<style>
/* === БОРИС: prefix vnal-b-, scoped внутри #vnedrenie-ai-logistika-boris-block === */
#vnedrenie-ai-logistika-boris-block.vnal-b-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-logistika-boris-block .vnal-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-logistika-boris-block .vnal-b-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-logistika-boris-block .vnal-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-logistika-boris-block .vnal-b-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0891b2;
  margin:0 0 14px;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(121,242,255,.15);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-pl-c{
  background:rgba(121,242,255,.1);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.35);
}
#vnedrenie-ai-logistika-boris-block .vnal-b-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-logistika-boris-block .vnal-b-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#vnedrenie-ai-logistika-boris-block .vnal-b-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-logistika-boris-block .vnal-b-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfeff 0%,#f0f9ff 35%,#faf5ff 70%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-logistika-boris-block .vnal-b-rgt{min-height:380px;}
}
#vnal-warehouse-route-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="vnal-b-cnt">
  <div class="vnal-b-card">

    <div class="vnal-b-lft">
      <span class="vnal-b-ey">Операции на полу склада</span>
      <h3 class="vnal-b-h3">Батчинг и маршрут сборщика: AI сокращает пробег по стеллажам</h3>
      <ul class="vnal-b-ul">
        <li><span class="vnal-b-ic">1</span>Оптимизатор группирует заказы в волны отбора по топологии ячеек</li>
        <li><span class="vnal-b-ic">2</span>TSP-маршрут строится с учётом «горячих» SKU и приоритетов OTIF</li>
        <li><span class="vnal-b-ic">3</span>Сборщик идёт по кратчайшему пути — меньше смен зон и этажей</li>
        <li><span class="vnal-b-ic">✓</span>Human-in-the-loop: критичные переназначения подтверждает диспетчер</li>
      </ul>
      <div class="vnal-b-pills">
        <span class="vnal-b-pl vnal-b-pl-g">Пробег −22%</span>
        <span class="vnal-b-pl vnal-b-pl-c">OTIF 94%</span>
        <span class="vnal-b-pl vnal-b-pl-v">Волна #3 · 12 SKU</span>
      </div>
      <p class="vnal-b-foot">Дальше — что входит во внедрение AI в логистику под ключ →</p>
    </div>

    <div class="vnal-b-rgt">
      <canvas
        id="vnal-warehouse-route-canvas"
        aria-label="Анимация: вид сверху на склад — AI строит маршрут сборщика между ячейками и формирует волну отбора"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vnal-warehouse-route-canvas');
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
    ink:'#0f172a',
    muted:'#64748b',
    rack:'#e2e8f0',
    rackHot:'#bae6fd',
    rackDone:'#bbf7d0',
    aisle:'#f1f5f9',
    cyan:'#06b6d4',
    cyanGlow:'rgba(6,182,212,.25)',
    violet:'#8b5cf6',
    green:'#22c55e',
    orange:'#f59e0b',
    trail:'rgba(6,182,212,.35)',
    picker:'#0f172a',
    cart:'#79f2ff',
    hud:'rgba(255,255,255,.92)',
    hudBdr:'rgba(148,163,184,.35)'
  };

  /* Сетка ячеек склада (col, row) — маршрут TSP */
  var GRID_COLS = 7, GRID_ROWS = 5;
  var ROUTE = [
    {c:0,r:2},{c:1,r:2},{c:2,r:1},{c:3,r:1},{c:4,r:0},
    {c:5,r:0},{c:6,r:1},{c:6,r:2},{c:5,r:3},{c:4,r:4},
    {c:3,r:4},{c:2,r:3},{c:1,r:4},{c:0,r:4},{c:0,r:3}
  ];
  var HOT = {'2,1':1,'4,0':1,'6,1':1,'3,4':1,'1,4':1};
  var PICKED = {};
  var LOOP = 680;
  var trail = [];

  function gridLayout(){
    var padX = 28, padY = 52, padB = 44;
    var gw = W - padX * 2;
    var gh = H - padY - padB;
    var cellW = gw / GRID_COLS;
    var cellH = gh / GRID_ROWS;
    return {padX:padX,padY:padY,cellW:cellW,cellH:cellH};
  }

  function cellCenter(L, c, r){
    return {
      x: L.padX + c * L.cellW + L.cellW * 0.5,
      y: L.padY + r * L.cellH + L.cellH * 0.5
    };
  }

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawHud(){
    rr(12,10,168,52,10,C.hud,C.hudBdr,1);
    ctx.fillStyle=C.ink;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('WMS · маршрут AI',22,30);
    ctx.fillStyle=C.green;
    ctx.font='10px Inter,sans-serif';
    ctx.fillText('−22% пробег · live',22,48);

    var wave = Math.floor((frame % LOOP) / 170) + 1;
    rr(W-130,10,118,52,10,C.hud,C.hudBdr,1);
    ctx.fillStyle=C.violet;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Волна отбора #'+wave,W-118,30);
    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.fillText('12 SKU · 3 зоны',W-118,48);
  }

  function drawWarehouse(L){
    for(var r=0;r<GRID_ROWS;r++){
      for(var c=0;c<GRID_COLS;c++){
        var x = L.padX + c * L.cellW + 4;
        var y = L.padY + r * L.cellH + 4;
        var w = L.cellW - 8;
        var h = L.cellH - 8;
        var key = c+','+r;
        var fill = C.rack;
        if(PICKED[key]) fill = C.rackDone;
        else if(HOT[key]) fill = C.rackHot;
        rr(x,y,w,h,6,fill,'#cbd5e1',1);
        if(HOT[key] && !PICKED[key]){
          ctx.fillStyle=C.cyan;
          ctx.font='bold 8px Inter,sans-serif';
          ctx.textAlign='center';
          ctx.fillText('SKU',x+w/2,y+h/2+3);
        }
      }
    }
  }

  function drawTrail(L, prog){
    if(trail.length < 2) return;
    ctx.strokeStyle=C.trail;
    ctx.lineWidth=3;
    ctx.lineCap='round';
    ctx.lineJoin='round';
    ctx.beginPath();
    var maxI = Math.min(trail.length - 1, Math.floor(prog * (ROUTE.length - 1)));
    ctx.moveTo(trail[0].x, trail[0].y);
    for(var i=1;i<=maxI;i++){
      ctx.lineTo(trail[i].x, trail[i].y);
    }
    ctx.stroke();
  }

  function drawRouteDots(L, prog){
    var total = ROUTE.length - 1;
    var idx = prog * total;
    ROUTE.forEach(function(pt, i){
      var cen = cellCenter(L, pt.c, pt.r);
      var alpha = i <= idx ? 0.9 : 0.25;
      ctx.globalAlpha = alpha;
      ctx.beginPath();
      ctx.arc(cen.x, cen.y, i <= idx ? 4 : 3, 0, Math.PI*2);
      ctx.fillStyle = i <= idx ? C.cyan : C.muted;
      ctx.fill();
      ctx.globalAlpha = 1;
    });
  }

  function drawPicker(L, prog){
    var total = ROUTE.length - 1;
    var fIdx = prog * total;
    var i0 = Math.floor(fIdx);
    var i1 = Math.min(i0 + 1, total);
    var t = fIdx - i0;
    var p0 = cellCenter(L, ROUTE[i0].c, ROUTE[i0].r);
    var p1 = cellCenter(L, ROUTE[i1].c, ROUTE[i1].r);
    var px = p0.x + (p1.x - p0.x) * t;
    var py = p0.y + (p1.y - p0.y) * t;

    ctx.fillStyle=C.cyanGlow;
    ctx.beginPath();
    ctx.arc(px, py, 18 + Math.sin(frame*0.08)*2, 0, Math.PI*2);
    ctx.fill();

    rr(px-10, py-6, 20, 12, 4, C.cart, C.cyan, 2);
    ctx.fillStyle=C.picker;
    ctx.beginPath();
    ctx.arc(px, py-14, 5, 0, Math.PI*2);
    ctx.fill();

    if(frame % 45 === 0){
      var key = ROUTE[i0].c+','+ROUTE[i0].r;
      PICKED[key] = true;
    }
  }

  function drawBatchQueue(){
    var bx = W - 108, by = H - 38;
    rr(bx, by, 96, 28, 8, 'rgba(139,92,246,.1)', C.violet, 1);
    ctx.fillStyle=C.violet;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='center';
    var done = Object.keys(PICKED).length;
    ctx.fillText('Собрано '+done+'/'+Object.keys(HOT).length, bx+48, by+18);
  }

  function loop(){
    frame++;
    var loopFr = frame % LOOP;
    var prog = (loopFr % 520) / 520;

    if(loopFr === 0){
      PICKED = {};
      trail = [];
    }

    var L = gridLayout();
    if(trail.length !== ROUTE.length){
      trail = ROUTE.map(function(pt){ return cellCenter(L, pt.c, pt.r); });
    }

    ctx.clearRect(0,0,W,H);
    drawHud();
    drawWarehouse(L);
    drawTrail(L, prog);
    drawRouteDots(L, prog);
    drawPicker(L, prog);
    drawBatchQueue();

    requestAnimationFrame(loop);
  }

  requestAnimationFrame(loop);
})();
</script>
  </section>
```

  <section class="vnal-section" id="usluga">
    <div class="vnal-cnt">
      <div class="vnal-sh nero-ai-reveal">
        <span class="vnal-eyebrow">Услуга под ключ</span>
        <h2>Внедрение AI в логистику под ключ: что входит в услугу</h2>
        <p><strong>Ai логистика внедрение под ключ</strong> — проектная модель от аудита до production. Ориентир чека: <strong>500 тыс.–3 млн ₽</strong>.</p>
      </div>
      <div class="vnal-timeline nero-ai-reveal">
        <div class="vnal-tl-item"><span class="vnal-tl-dot" aria-hidden="true"></span>
          <h3>Аудит процессов и данных</h3>
          <p><strong>Срок:</strong> 5–7 рабочих дней. Карта процессов, инвентаризация источников (1С, МойСклад, WMS), KPI: MAPE, OTIF, пробег. Результат — <strong>Карта AI для склада</strong>.</p>
        </div>
        <div class="vnal-tl-item"><span class="vnal-tl-dot" aria-hidden="true"></span>
          <h3>Проектирование AI-решения</h3>
          <p>ERP/WMS → ML-прогноз → оптимизатор волн → LLM/agentic для документов и аномалий → оператор подтверждает критические решения.</p>
        </div>
        <div class="vnal-tl-item"><span class="vnal-tl-dot" aria-hidden="true"></span>
          <h3>Интеграция с WMS, TMS, ERP и CRM</h3>
          <p>1С:ERP/УТ/КА, МойСклад, SAP EWM/TM, amoCRM, Bitrix24, Ozon/WB/Яндекс Маркет API, n8n/Make, DataLens/Power BI, YandexGPT/GigaChat/OpenAI.</p>
        </div>
        <div class="vnal-tl-item"><span class="vnal-tl-dot" aria-hidden="true"></span>
          <h3>Запуск, обучение команды и сопровождение</h3>
          <p>Пилот 4–6 недель на одном складе. A/B-сравнение «как было» vs «с AI». После пилота — production и донастройка моделей.</p>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-usluga">
        <div class="ym-cta-block__icon" aria-hidden="true">📦</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Оценить логистику — бесплатно</p>
          <p class="ym-cta-block__sub">За 5–7 дней проведём аудит процессов и данных, составим Карту AI для склада и покажем «быстрые победы»: прогноз, батчинг, документы. Ориентир по срокам и бюджету — без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="vnal-section vnal-section-alt" id="integracii">
    <div class="vnal-cnt nero-ai-reveal">
      <div class="vnal-sh">
        <span class="vnal-eyebrow">Стек интеграций</span>
        <h2>Интеграции: 1С, МойСклад, WMS, CRM и маркетплейсы</h2>
        <p><strong>Wms ai</strong> — слой поверх существующей системы, не замена учёта.</p>
      </div>
      <h3>Типовые связки для складов и e-commerce</h3>
      <div class="vnal-table-wrap">
        <table class="vnal-table">
          <thead><tr><th>Стек</th><th>Для кого</th><th>AI-модули</th><th>Сложность</th></tr></thead>
          <tbody>
            <tr><td>1С:УТ/ERP + 1С:WMS</td><td>Дистрибуция, 3PL</td><td>Прогноз, батчинг, документы</td><td>Средняя</td></tr>
            <tr><td>МойСклад + маркетплейсы</td><td>E-commerce, МСБ</td><td>Прогноз, алерты, API</td><td>Низкая–средняя</td></tr>
            <tr><td>SAP EWM/TM</td><td>Enterprise</td><td>IBP, TM-оптимизация</td><td>Высокая</td></tr>
            <tr><td>Кастом WMS + TMS</td><td>Уникальная топология</td><td>Полный AI-контур</td><td>Высокая</td></tr>
          </tbody>
        </table>
      </div>
      <h3>Барьеры production-внедрения и human-in-the-loop</h3>
      <p>Три барьера agentic AI: верификация, недетерминизм LLM, конфиденциальность данных.</p>
      <div class="vnal-flow" aria-label="Схема human-in-the-loop">Данные WMS/ERP → AI предлагает действие →
  если риск низкий и в рамках правил → автоматически
  если риск высокий → оператор подтверждает → журнал → обучение модели</div>
      <p><strong>Что остаётся за человеком:</strong> утверждение закупок и критических маршрутов; разбор претензий; настройка SLA; модерация agentic-решений.</p>
    </div>
  </section>

  <section class="vnal-section" id="ceny">
    <div class="vnal-cnt nero-ai-reveal">
      <div class="vnal-sh">
        <span class="vnal-eyebrow">Стоимость</span>
        <h2>Сколько стоит внедрение AI в логистику</h2>
        <p>Ориентир чека: <strong>500 тыс.–3 млн ₽</strong> в зависимости от масштаба и модулей.</p>
      </div>
      <div class="vnal-table-wrap">
        <table class="vnal-table">
          <thead><tr><th>Этап</th><th>Срок</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td>Аудит</td><td>5–7 дней</td><td>Входит в проект</td></tr>
            <tr><td>Data foundation</td><td>2–4 недели</td><td>150–400 тыс. ₽</td></tr>
            <tr><td>Quick wins</td><td>4–8 недель</td><td>300–800 тыс. ₽</td></tr>
            <tr><td>Полный AI-контур + agentic</td><td>3–6 месяцев</td><td>1–3 млн ₽</td></tr>
          </tbody>
        </table>
      </div>
      <p>Пилот на одном складе за 4–6 недель даёт цифры для бизнес-кейса масштабирования. Без пилота ROI остаётся теорией.</p>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI в логистику полезно разобраться в прогнозировании, human-in-the-loop и интеграции с WMS/1С. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>

      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет под ваш склад</p>
          <p class="ym-cta-block__sub">Ориентир 500 тыс.–3 млн ₽ за AI-контур под ключ. На первичной оценке дадим расчёт по KPI: MAPE, пробег, ошибки комплектации, OTIF — и план пилота на 4–6 недель.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#karta" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Скачать карту AI для склада</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vnal-section vnal-section-alt" id="keisy">
    <div class="vnal-cnt">
      <div class="vnal-sh nero-ai-reveal">
        <span class="vnal-eyebrow">Production-кейсы</span>
        <h2>Кейсы и примеры внедрения AI в логистике</h2>
      </div>
      <div class="vnal-case-grid nero-ai-reveal">
        <article class="vnal-case-card">
          <div class="vnal-case-tag">Ozon Tech</div>
          <div class="vnal-case-metric">−418 км</div>
          <h3>WMS + батчинг и слоттинг</h3>
          <p>Смена зон ↓ 92,3%; батчинг ↓ перемещения на 20–30%; слоттинг ↓ время поиска на 7%.</p>
        </article>
        <article class="vnal-case-card">
          <div class="vnal-case-tag">X5 Group</div>
          <div class="vnal-case-metric">+33%</div>
          <h3>РЦ «Новая Рига»</h3>
          <p>67 FMR-погрузчиков, робот-инвентаризатор. Эффективность инвентаризации ×4.</p>
        </article>
        <article class="vnal-case-card">
          <div class="vnal-case-tag">Яндекс Лавка</div>
          <div class="vnal-case-metric">−30%</div>
          <h3>Даркстор + AMR</h3>
          <p>12 AMR и 84 стеллажа под Yandex RMS. Плотность размещения +15%.</p>
        </article>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-keisy">
        <div class="ym-cta-block__icon" aria-hidden="true">🚚</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите такой же эффект на своём складе?</p>
          <p class="ym-cta-block__sub">Ozon и X5 начинали с данных и WMS, не с роботов. Разберём ваши процессы и покажем, какой модуль AI даст измеримый результат на пилоте.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="vnal-section" id="segmenty">
    <div class="vnal-cnt nero-ai-reveal">
      <div class="vnal-sh vnal-left">
        <span class="vnal-eyebrow">Сегменты</span>
        <h2>AI для малого и среднего бизнеса vs крупные склады</h2>
      </div>
      <div class="vnal-table-wrap">
        <table class="vnal-table">
          <thead><tr><th>Параметр</th><th>Малый/средний бизнес</th><th>Крупный ритейл / 3PL</th></tr></thead>
          <tbody>
            <tr><td>SKU</td><td>500–5 000</td><td>50 000+</td></tr>
            <tr><td>Стек</td><td>МойСклад, 1С:УТ</td><td>SAP, кастом WMS</td></tr>
            <tr><td>AI-модули</td><td>Прогноз, алерты, батчинг</td><td>Полный контур + роботы</td></tr>
            <tr><td>Чек</td><td>500 тыс.–1,5 млн ₽</td><td>2–10+ млн ₽</td></tr>
            <tr><td>Срок пилота</td><td>4–6 недель</td><td>3–6 месяцев</td></tr>
          </tbody>
        </table>
      </div>
      <p><strong>Ai логистика без программиста</strong> у клиента — да, если интеграцию делает команда подрядчика.</p>
    </div>
  </section>

  <section class="vnal-section vnal-section-alt" id="faq">
    <div class="vnal-cnt">
      <div class="vnal-sh nero-ai-reveal">
        <span class="vnal-eyebrow">FAQ</span>
        <h2>Как внедрить AI в логистику самостоятельно или под ключ</h2>
      </div>
      <div class="vnal-faq nero-ai-reveal" role="list">
        <div class="vnal-faq-item" role="listitem"><div class="vnal-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai логистика самостоятельно?</div><div class="vnal-faq-a">Теоретически — при наличии data scientist и 6–12 месяцев. Практически быстрее <strong>внедрение ai логистика под ключ</strong>: аудит → data foundation → пилот → production с ROI.</div></div>
        <div class="vnal-faq-item" role="listitem"><div class="vnal-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai логистика?</div><div class="vnal-faq-a">Ориентир: <strong>500 тыс.–3 млн ₽</strong>. Точная <strong>ai логистика стоимость</strong> — после аудита и фиксации KPI.</div></div>
        <div class="vnal-faq-item" role="listitem"><div class="vnal-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи решает ai логистика?</div><div class="vnal-faq-a">Прогноз спроса, оптимизация маршрутов отбора, last-mile, контроль комплектации, документы (ЭТРН, CMR), реакция на исключения через agentic-ассистента.</div></div>
        <div class="vnal-faq-item" role="listitem"><div class="vnal-faq-q" role="button" tabindex="0" aria-expanded="false">Ai логистика под ключ или самостоятельно?</div><div class="vnal-faq-a">Под ключ: пилот за 4–8 недель, предсказуемый чек, SLA. Самостоятельно: 6–12 месяцев, зарплаты + инфраструктура, выше риск.</div></div>
        <div class="vnal-faq-item" role="listitem"><div class="vnal-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли без роботов?</div><div class="vnal-faq-a">Да. <strong>Нейросети логистика</strong> — это прогноз, оптимизация и документы на существующем WMS. Роботы — опциональное масштабирование.</div></div>
        <div class="vnal-faq-item" role="listitem"><div class="vnal-faq-q" role="button" tabindex="0" aria-expanded="false">Какие данные нужны для старта?</div><div class="vnal-faq-a">История отгрузок ≥12–24 месяца; справочник SKU и ячеек; логи комплектации; данные TMS; регламенты SLA.</div></div>
        <div class="vnal-faq-item" role="listitem"><div class="vnal-faq-q" role="button" tabindex="0" aria-expanded="false">Нейросеть ошибётся — как быть?</div><div class="vnal-faq-a">ML работает с MAPE. Agentic-модули — только с audit log и подтверждением оператора. Критические решения не автоматизируем.</div></div>
        <div class="vnal-faq-item" role="listitem"><div class="vnal-faq-q" role="button" tabindex="0" aria-expanded="false">Уже есть 1С/МойСклад — нужно ли менять?</div><div class="vnal-faq-a">Нет. <strong>Ai логистика для компании</strong> с существующим учётом — AI-слой поверх ERP/WMS.</div></div>
      </div>
    </div>
  </section>

  <section class="vnal-section" id="ocenka">
    <div class="vnal-cnt">
      <div class="vnal-sh nero-ai-reveal">
        <span class="vnal-eyebrow">Первый шаг</span>
        <h2>Оценить логистику — бесплатная первичная оценка</h2>
        <p>Разбор процессов и данных; оценка «быстрых побед»; ориентир по срокам и бюджету; рекомендация по стеку интеграций. Ответ в течение 2 рабочих дней.</p>
      </div>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы понять, где на складе теряются деньги?</p>
          <p class="ym-cta-block__sub">Первичная оценка логистики: разбор процессов, «быстрые победы», ориентир по срокам и бюджету. Ответ в течение 2 рабочих дней.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="vnal-section vnal-section-alt">
    <div class="vnal-cnt">
      <div class="vnal-lead-magnet" id="karta">
        <div class="vnal-lead-magnet__icon" aria-hidden="true">🗺️</div>
        <h2>Карта AI для склада — скачать чек-лист зон автоматизации</h2>
        <p class="vnal-lead-magnet__lead">Одностраничный чек-лист: за 15 минут поймёте, какие зоны готовы к AI, а где сначала навести порядок в данных.</p>
        <ul class="vnal-lead-magnet__checklist">
          <li>Прогноз спроса и остатков</li>
          <li>Слоттинг и батчинг</li>
          <li>Маршрутизация last-mile</li>
          <li>Контроль комплектации</li>
          <li>Документооборот (ЭТРН, CMR)</li>
          <li>Исключения (agentic + human-in-the-loop)</li>
        </ul>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить карту на консультации</a>
      </div>
      <p style="text-align:center;margin-top:24px;color:var(--vnal-muted);"><strong>Итог:</strong> <strong>ai логистика</strong> в 2026 — WMS/TMS + данные + верификация. Nero Network внедряет AI в логистические процессы под ключ: от аудита до пилота с KPI.</p>
    </div>
  </section>

</div><!-- /.vnal-content -->

<!-- SCHEMA-MARKUP:INSERT -->

<script>
/**
 * vnal-logistics-hero-engine — «Диспетчерская складского графа»
 * Мир: орбитальный поток паллет → башня WMS → маршрут отбора → OTIF + last-mile
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnal-logistics-hero-canvas");
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
    zoneRecv: "rgba(121,242,255,0.35)",
    zoneStore: "rgba(139,92,246,0.28)",
    zonePick: "rgba(34,197,94,0.32)",
    zoneShip: "rgba(251,191,36,0.35)",
    towerBase: "#1e293b",
    towerGlow: "#79f2ff",
    pallet: "#cbd5e1",
    routeLine: "#22c55e",
    heatHot: "#f97316",
    heatMid: "#8b5cf6",
    heatCool: "#38bdf8",
    truck: "#e2e8f0",
    otifGreen: "#22c55e",
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
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Орбитальный поток паллет — замена Conveyor */
  function OrbitalPalletStream() {
    this.orbitals = [
      { zone: 0, angle: 0, speed: 0.018, r: 95, label: "П" },
      { zone: 1, angle: 1.4, speed: 0.014, r: 72, label: "Х" },
      { zone: 2, angle: 2.8, speed: 0.02, r: 58, label: "О" },
      { zone: 3, angle: 4.2, speed: 0.016, r: 88, label: "ОТ" }
    ];
  }
  OrbitalPalletStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    var zones = [
      { x: -110, y: -55, w: 44, h: 32, color: C.zoneRecv, t: "Приёмка" },
      { x: 70, y: -70, w: 44, h: 32, color: C.zoneStore, t: "Хранение" },
      { x: 95, y: 25, w: 44, h: 32, color: C.zonePick, t: "Отбор" },
      { x: -95, y: 45, w: 44, h: 32, color: C.zoneShip, t: "Отгрузка" }
    ];
    zones.forEach(function (z) {
      drawRR(ctx, z.x, z.y, z.w, z.h, 6, z.color, C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(z.t, z.x + z.w / 2, z.y + z.h / 2 + 2);
    });

    if (prg < 90) return;

    this.orbitals.forEach(function (o, i) {
      var a = o.angle + frame * o.speed;
      var px = Math.cos(a) * o.r * 0.55;
      var py = Math.sin(a) * o.r * 0.38;
      drawRR(ctx, px - 8, py - 6, 16, 12, 3, C.pallet, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(o.label, px, py + 2);
    });
  };

  /* Тепловая карта ячеек */
  function SlottingHeatGrid() {
    this.cells = [];
    for (var r = 0; r < 4; r++) {
      for (var c = 0; c < 5; c++) {
        this.cells.push({ r: r, c: c, heat: Math.random() });
      }
    }
  }
  SlottingHeatGrid.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 15) return;
    var grow = Math.min(1, (prg - 15) / 40);
    ctx.save();
    ctx.globalAlpha = grow * 0.85;
    for (var i = 0; i < this.cells.length; i++) {
      var cell = this.cells[i];
      var hx = -125 + cell.c * 14;
      var hy = -78 + cell.r * 12;
      var pulse = 0.5 + 0.5 * Math.sin(frame * 0.05 + i);
      var h = cell.heat;
      var col = h > 0.66 ? C.heatHot : h > 0.33 ? C.heatMid : C.heatCool;
      ctx.fillStyle = col;
      ctx.globalAlpha = grow * (0.25 + pulse * 0.35);
      drawRR(ctx, hx, hy, 11, 9, 2, col, null);
    }
    ctx.restore();
  };

  /* Башня управления WMS — замена WebsiteTerminal */
  function WarehouseControlTower() {
    this.waveNum = 47;
    this.otifPhase = 0;
  }
  WarehouseControlTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;

    /* Шестигранная башня */
    ctx.save();
    ctx.translate(0, -8);
    ctx.fillStyle = C.towerBase;
    ctx.strokeStyle = C.towerGlow;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    for (var i = 0; i < 6; i++) {
      var ang = (Math.PI / 3) * i - Math.PI / 6;
      var vx = Math.cos(ang) * 28;
      var vy = Math.sin(ang) * 28 - 20;
      if (i === 0) ctx.moveTo(vx, vy);
      else ctx.lineTo(vx, vy);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    /* Радар-скан */
    var scanAng = (frame * 0.04) % (Math.PI * 2);
    ctx.strokeStyle = "rgba(121,242,255,0.45)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(0, -20);
    ctx.lineTo(Math.cos(scanAng) * 22, -20 + Math.sin(scanAng) * 22);
    ctx.stroke();

    ctx.fillStyle = C.towerGlow;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("WMS", 0, -18);

    if (prg >= 90 && prg < 185) {
      var wavePrg = (prg - 90) / 95;
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("Волна #" + this.waveNum, 0, 2);
      ctx.fillStyle = "rgba(34,197,94," + (0.3 + wavePrg * 0.5) + ")";
      drawRR(ctx, -18, 8, 36, 10, 3, "rgba(34,197,94,0.25)", C.routeLine);
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("батчинг", 0, 16);
    }

    if (prg >= 185) {
      this.otifPhase = Math.min(1, (prg - 185) / 25);
      ctx.save();
      ctx.globalAlpha = this.otifPhase;
      ctx.strokeStyle = C.otifGreen;
      ctx.lineWidth = 2;
      ctx.strokeRect(-24, -6, 48, 22);
      ctx.fillStyle = C.otifGreen;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("OTIF 94%", 0, 10);
      ctx.restore();
    }
    ctx.restore();
  };

  /* Дуговой маршрут сборщика */
  function PickRouteArc() {
    this.points = [];
  }
  PickRouteArc.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 100 || prg > 200) return;
    var local = (prg - 100) / 100;
    var pts = [
      { x: 95, y: 40 }, { x: 60, y: 10 }, { x: 20, y: -30 },
      { x: -40, y: -20 }, { x: -80, y: 30 }, { x: -50, y: 55 }
    ];
    ctx.strokeStyle = C.routeLine;
    ctx.lineWidth = 2;
    ctx.setLineDash([4, 3]);
    ctx.beginPath();
    ctx.moveTo(pts[0].x, pts[0].y);
    var maxIdx = Math.floor(local * pts.length);
    for (var i = 1; i <= maxIdx && i < pts.length; i++) {
      ctx.lineTo(pts[i].x, pts[i].y);
    }
    ctx.stroke();
    ctx.setLineDash([]);
    if (maxIdx < pts.length) {
      var t = (local * pts.length) % 1;
      var i0 = Math.min(maxIdx, pts.length - 2);
      var px = pts[i0].x + (pts[i0 + 1].x - pts[i0].x) * t;
      var py = pts[i0].y + (pts[i0 + 1].y - pts[i0].y) * t;
      ctx.fillStyle = C.routeLine;
      ctx.beginPath();
      ctx.arc(px, py, 4, 0, Math.PI * 2);
      ctx.fill();
    }
    if (local > 0.6 && frame % 90 === 0) {
      createBubble(30, -10, "Маршрут −22% км", 200);
    }
  };

  /* Last-mile HUD */
  function LastMileHud() {
    this.truckX = -40;
  }
  LastMileHud.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 200) return;
    var local = (prg - 200) / 80;
    drawRR(ctx, 108, 38, 52, 34, 6, "rgba(15,23,42,0.75)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Last-mile", 114, 48);

    this.truckX = -8 + local * 42;
    drawRR(ctx, 112 + this.truckX, 52, 14, 10, 2, C.truck, C.outline);
    ctx.fillStyle = C.routeLine;
    ctx.beginPath();
    ctx.moveTo(118, 57);
    ctx.lineTo(112 + this.truckX + 14, 57);
    ctx.stroke();

    if (local > 0.85 && frame % 100 === 0) {
      createBubble(130, 45, "Рейс в срок · OTIF", 210);
    }
  };

  /* Алерт дефицита SKU */
  function SkuAlertBeacon() {
    this.flash = 0;
  }
  SkuAlertBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 120 || prg > 175) return;
    this.flash = Math.sin(frame * 0.15) * 0.5 + 0.5;
    ctx.save();
    ctx.globalAlpha = 0.4 + this.flash * 0.5;
    ctx.fillStyle = "#fbbf24";
    ctx.beginPath();
    ctx.arc(-100, -25, 6 + this.flash * 3, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SKU!", -100, -24);
    ctx.restore();
    if (frame % 110 === 0) createBubble(-95, -35, "Дефицит SKU-8842", 220);
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
    var prg = (frame * 0.042) % 280;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var towerTargets = {
      "1_planner": { x: -35, y: 35 },
      "2_slotting": { x: -10, y: 42 },
      "3_routes": { x: 15, y: 42 },
      "4_wms": { x: 40, y: 35 },
      "5_dispatch": { x: 0, y: 50 }
    };
    var tgt = towerTargets[this.role] || { x: 0, y: 40 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 26) {
      var local = prg - this.stepTrig;
      if (local < 13) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 13);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 13);
      } else if (local < 18) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 18) / 8);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 18) / 8);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 12 ? this.color : null;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.1) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
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
  entities.push(new OrbitalPalletStream());
  entities.push(new SlottingHeatGrid());
  entities.push(new WarehouseControlTower());
  entities.push(new PickRouteArc());
  entities.push(new LastMileHud());
  entities.push(new SkuAlertBeacon());

  entities.push(new Agent(-130, 55, C.agentYellow, "1_planner", 25, [
    "MAPE 12% — норма", "Прогноз на пик", "Сезонность учтена", "Нагрузка смены ↑"
  ]));
  entities.push(new Agent(-75, 70, C.agentGreen, "2_slotting", 55, [
    "Слоттинг ячеек", "Горячие SKU вперёд", "Поиск −7%", "Топология ок"
  ]));
  entities.push(new Agent(-20, 68, C.agentBlue, "3_routes", 95, [
    "TSP на 17к ячеек", "Пробег −22%", "Батчинг 128 заказов", "Волна #47"
  ]));
  entities.push(new Agent(45, 72, C.agentPink, "4_wms", 130, [
    "WMS синхрон", "1С остатки ok", "API маркетплейса", "Волна в TMS"
  ]));
  entities.push(new Agent(100, 58, C.agentPurple, "5_dispatch", 165, [
    "OTIF 94%", "Рейс назначен", "Last-mile ок", "Отгрузка в срок"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  function engineloop() {
    frame++;
    if (frame === 45) createBubble(-20, -50, "Прогноз спроса → волна", 250);
    ctx.save();
    ctx.clearRect(0, 0, cw, ch);
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.forEach(function (e) { e.draw(ctx); });

    bubbles.forEach(function (b) {
      b.life--;
      if (b.life <= 0) return;
      var alpha = b.life / b.maxLife;
      ctx.save();
      ctx.globalAlpha = alpha;
      ctx.font = "bold 7px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 14, 4, C.bubbleBg, C.towerGlow);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 8);
      ctx.restore();
    });
    bubbles = bubbles.filter(function (b) { return b.life > 0; });

    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>
```

<script>
(function(){
  document.querySelectorAll('.vnal-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vnal-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vnal-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vnal-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){ e.preventDefault(); btn.click(); }
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.vnedrenie-ai-logistika-page');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function(item){ observer.observe(item); });
  } else {
    items.forEach(function(item){ item.classList.add('nero-ai-active'); });
  }
})();
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
