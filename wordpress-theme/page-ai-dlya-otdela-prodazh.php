<?php
/**
 * Template Name: AI для отдела продаж: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI-помощника для отдела продаж. Квалификация лидов, follow-up, CRM.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для отдела продаж — внедрение и настройка под ключ';
$page_seo_description = 'Внедрим AI-помощника для отдела продаж: квалификация лидов, follow-up, подсказки менеджерам и контроль CRM. Кейсы, цена, бесплатный аудит воронки.';

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
    ['label' => 'Зачем AI', 'href' => '#zachem-ai'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'CRM', 'href' => '#crm'],
    ['label' => 'Стоимость', 'href' => '#cena'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'Заказать', 'href' => '#cta'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Ускорить продажи';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение AI';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

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
/* Kadence reset — pill-шапка как на главной */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,
.entry-header,.page-title-section { display: none !important; }

#primary,.site-main,.site-content,#content,.content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}

/* Hero full viewport */
#sales-hero-ai-dlya-otdela-prodazh {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

/* CTA + reveal (adop tokens) */
.adop-content {
  --adop-btn-from: #2563eb;
  --adop-btn-to: #7c3aed;
}
.ym-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 13px 28px;
  border-radius: 999px;
  font-size: 15px;
  font-weight: 700;
  text-decoration: none !important;
  transition: transform .2s, box-shadow .2s;
}
.ym-btn:hover { transform: translateY(-2px); }
.ym-btn--accent,
.nero-ai-home-page .ym-btn--accent {
  background: linear-gradient(135deg, var(--adop-btn-from, #2563eb), var(--adop-btn-to, #7c3aed));
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(59, 130, 246, .35);
}
.ym-btn--ghost {
  background: rgba(255, 255, 255, .08);
  color: #e6edf7 !important;
  border: 1.5px solid rgba(255, 255, 255, .18);
}
.nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}
.nero-ai-reveal.nero-ai-active {
  opacity: 1;
  transform: none;
}
.nero-ai-delay-1 { transition-delay: .12s; }
.nero-ai-delay-2 { transition-delay: .24s; }
</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-otdela-prodazh-page" role="main" tabindex="-1">

<section id="sales-hero-ai-dlya-otdela-prodazh" class="nero-ai-home sales-hero-section" aria-labelledby="sales-hero-title">
<style>
/* Hero ai-dlya-otdela-prodazh — самодостаточные стили, не зависят от Kadence */
#sales-hero-ai-dlya-otdela-prodazh {
  --sales-hero-bg: #060812;
  --sales-hero-surface: rgba(255,255,255,.072);
  --sales-hero-border: rgba(255,255,255,.12);
  --sales-hero-text: #e6edf7;
  --sales-hero-muted: #9aa8bd;
  --sales-hero-soft: #c7d2e5;
  --sales-hero-heading: #fff;
  --sales-hero-primary: #79f2ff;
  --sales-hero-violet: #8b5cf6;
  --sales-hero-green: #22c55e;
  --sales-hero-shadow: 0 28px 90px rgba(0,0,0,.42);
  --sales-hero-container: 1220px;
  position: relative;
  overflow: hidden;
  color: var(--sales-hero-text);
  background:
    radial-gradient(circle at 12% 7%, rgba(121,242,255,.16), transparent 28rem),
    radial-gradient(circle at 86% 12%, rgba(139,92,246,.18), transparent 34rem),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
#sales-hero-ai-dlya-otdela-prodazh *, #sales-hero-ai-dlya-otdela-prodazh *::before, #sales-hero-ai-dlya-otdela-prodazh *::after { box-sizing: border-box; }
#sales-hero-ai-dlya-otdela-prodazh a { color: inherit; text-decoration: none; }
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-container {
  width: min(var(--sales-hero-container), calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-wrap {
  position: relative;
  min-height: min(920px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
  isolation: isolate;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-wrap::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 40% 30%, #000 0%, transparent 72%);
  opacity: .5;
  pointer-events: none;
  z-index: -1;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(340px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121,242,255,.2);
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  color: var(--sales-hero-primary);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .11em;
  text-transform: uppercase;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.5vw, 64px);
  font-weight: 800;
  line-height: 1.06;
  letter-spacing: -.045em;
  color: var(--sales-hero-heading);
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-h1 span {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--sales-hero-primary) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-lead {
  margin: 22px 0 0;
  max-width: 680px;
  font-size: clamp(16px, 1.8vw, 20px);
  line-height: 1.58;
  color: var(--sales-hero-soft);
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 14px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-cta-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 32px;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 22px;
  border-radius: 999px;
  font-size: 15px;
  font-weight: 800;
  transition: transform .2s, box-shadow .2s;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-btn--primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--sales-hero-primary), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121,242,255,.22);
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-btn--ghost {
  color: var(--sales-hero-text) !important;
  background: rgba(255,255,255,.07);
  border: 1px solid rgba(255,255,255,.14);
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-btn:hover { transform: translateY(-2px); }
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2,6,23,.42);
  box-shadow: var(--sales-hero-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15,23,42,.95), rgba(6,10,24,.96));
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dash-note {
  margin: 0 0 12px;
  text-align: center;
  font-size: 11px;
  color: #64748b;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dash-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dash-title {
  font-size: 13px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: #cfe3f9;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dash-status {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.1);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dash-status::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--sales-hero-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: salesHeroPulse 1.6s infinite;
}
@keyframes salesHeroPulse { 0%,100% { transform: scale(.86); opacity: .65; } 50% { transform: scale(1); opacity: 1; } }
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dash-body { padding: 16px; }
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-metrics {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 14px;
  background: rgba(255,255,255,.055);
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-metric strong {
  display: block;
  font-size: 20px;
  color: #fff;
  line-height: 1;
  margin-bottom: 4px;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-metric span {
  font-size: 11px;
  color: var(--sales-hero-muted);
  font-weight: 600;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-canvas-wrap {
  position: relative;
  margin-top: 12px;
  height: 168px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(121,242,255,.14);
  background: radial-gradient(circle at 50% 40%, rgba(121,242,255,.08), rgba(6,10,24,.9));
}
#sales-hero-ai-dlya-otdela-prodazh #sales-funnel-command-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-feed {
  margin-top: 12px;
  display: grid;
  gap: 8px;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-feed-row {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 9px 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 12px;
  background: rgba(255,255,255,.04);
  font-size: 12px;
  color: var(--sales-hero-muted);
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  flex-shrink: 0;
}
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dot--blue { background: #3b82f6; }
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dot--green { background: var(--sales-hero-green); }
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dot--amber { background: #f59e0b; }
#sales-hero-ai-dlya-otdela-prodazh .sales-hero-dot--violet { background: var(--sales-hero-violet); }
@media (max-width: 960px) {
  #sales-hero-ai-dlya-otdela-prodazh .sales-hero-grid { grid-template-columns: 1fr; }
  #sales-hero-ai-dlya-otdela-prodazh .sales-hero-dashboard { transform: none; }
  #sales-hero-ai-dlya-otdela-prodazh .sales-hero-wrap { min-height: auto; padding-top: 96px; }
}
</style>

  <div class="sales-hero-wrap">
    <div class="sales-hero-container sales-hero-grid">
      <div class="sales-hero-copy">
        <span class="sales-hero-eyebrow">Продажи · AI под ключ · 2026</span>
        <h1 id="sales-hero-title" class="sales-hero-h1">
          AI для отдела продаж:
          <span>внедрение и настройка под ключ</span>
        </h1>
        <p class="sales-hero-lead">Квалификация лидов, автоматический follow-up, подсказки менеджерам и контроль сделок в CRM — внедрим AI-помощника продаж, чтобы воронка не теряла заявки</p>
        <ul class="sales-hero-badges" aria-label="Ключевые функции">
          <li class="sales-hero-badge">Квалификация</li>
          <li class="sales-hero-badge">Follow-up</li>
          <li class="sales-hero-badge">Подсказки</li>
          <li class="sales-hero-badge">Контроль CRM</li>
        </ul>
        <div class="sales-hero-cta-row">
          <a class="sales-hero-btn sales-hero-btn--primary nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url(nero_ai_primary_cta_url()); ?>"><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Ускорить продажи'); ?></a>
          <a class="sales-hero-btn sales-hero-btn--ghost nero-ai-btn nero-ai-btn-secondary" href="#scenarii">Сценарии AI</a>
        </div>
      </div>

      <div class="nero-ai-dashboard sales-hero-dashboard" aria-label="Демонстрация AI-помощника продаж">
        <p class="sales-hero-dash-note">пример логики воронки · демонстрационные данные</p>
        <div class="sales-hero-dashboard-shell">
          <div class="sales-hero-dash-header">
            <span class="sales-hero-dash-title">AI-помощник продаж</span>
            <span class="sales-hero-dash-status">онлайн</span>
          </div>
          <div class="sales-hero-dash-body">
            <div class="sales-hero-metrics">
              <div class="sales-hero-metric"><strong>3–8 сек</strong><span>первый ответ</span></div>
              <div class="sales-hero-metric"><strong>+61%</strong><span>квалификация</span></div>
              <div class="sales-hero-metric"><strong>87%</strong><span>команд с AI</span></div>
              <div class="sales-hero-metric"><strong>24/7</strong><span>первая линия</span></div>
            </div>
            <div class="sales-hero-canvas-wrap" aria-hidden="true">
              <canvas id="sales-funnel-command-canvas"></canvas>
            </div>
            <div class="sales-hero-feed">
              <div class="sales-hero-feed-row"><span class="sales-hero-dot sales-hero-dot--blue" aria-hidden="true"></span>Новый лид с сайта → квалификация по BANT</div>
              <div class="sales-hero-feed-row"><span class="sales-hero-dot sales-hero-dot--amber" aria-hidden="true"></span>Follow-up отправлен в Telegram</div>
              <div class="sales-hero-feed-row"><span class="sales-hero-dot sales-hero-dot--green" aria-hidden="true"></span>Карточка CRM заполнена</div>
              <div class="sales-hero-feed-row"><span class="sales-hero-dot sales-hero-dot--violet" aria-hidden="true"></span>Эскалация на менеджера</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* === ADOP: контент лонгрида, prefix adop- === */
.adop-content{
  --adop-bg:#050711;--adop-bg2:#080b17;
  --adop-text:#e6edf7;--adop-muted:#9aa8bd;--adop-soft:#c7d2e5;--adop-heading:#fff;
  --adop-border:rgba(255,255,255,.10);
  --adop-accent:#79f2ff;--adop-violet:#8b5cf6;--adop-green:#22c55e;
  --adop-btn-from:#2563eb;--adop-btn-to:#7c3aed;
  --adop-r:18px;--adop-r-lg:24px;--adop-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--adop-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.adop-content *,.adop-content *::before,.adop-content *::after{box-sizing:border-box;}
.adop-content a{color:inherit;}
.adop-content p{color:var(--adop-muted);line-height:1.72;margin:0 0 1em;}
.adop-content p:last-child{margin-bottom:0;}
.adop-content h2,.adop-content h3,.adop-content h4{color:var(--adop-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.adop-content strong{color:var(--adop-soft);}
.adop-content ul,.adop-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.adop-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--adop-muted);font-size:14.5px;line-height:1.65;}
.adop-content ul li::before{content:'›';position:absolute;left:0;color:var(--adop-accent);font-weight:700;}
.adop-content ol{counter-reset:adop-ol;}
.adop-content ol li{counter-increment:adop-ol;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--adop-muted);font-size:14.5px;line-height:1.65;}
.adop-content ol li::before{content:counter(adop-ol);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--adop-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;top:2px;}
.adop-cnt{width:min(var(--adop-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.adop-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.adop-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.adop-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.adop-sh.adop-left{margin-left:0;text-align:left;}
.adop-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.adop-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.adop-sh.adop-left p{margin-left:0;}
.adop-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--adop-accent);margin-bottom:14px;}
.adop-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.adop-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.adop-intro-text{position:relative;padding-left:20px;}
.adop-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--adop-accent),var(--adop-violet));}
.adop-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.adop-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.adop-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.adop-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--adop-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.adop-kpi-card .kl{font-size:11px;font-weight:600;color:var(--adop-muted);line-height:1.4;}
@media(max-width:900px){.adop-intro-grid{grid-template-columns:1fr;gap:36px;}.adop-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.adop-intro-kpi{grid-template-columns:1fr 1fr;}}
.adop-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.adop-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.adop-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid var(--adop-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--adop-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.adop-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--adop-accent);background:rgba(121,242,255,.08);}
.adop-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--adop-border);border-radius:var(--adop-r-lg);padding:26px;backdrop-filter:blur(16px);}
.adop-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--adop-r);padding:26px;margin-bottom:14px;}
.adop-scenario:last-child{margin-bottom:0;}
.adop-scenario h3{font-size:17px;margin-bottom:8px;}
.adop-scenario p{font-size:14.5px;margin:0 0 .6em;}
.adop-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.adop-table{width:100%;border-collapse:collapse;font-size:14px;}
.adop-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--adop-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.adop-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--adop-text);vertical-align:top;}
.adop-table tr:last-child td{border-bottom:none;}
.adop-table tr:hover td{background:rgba(255,255,255,.03);}
.adop-timeline{position:relative;padding-left:40px;}
.adop-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--adop-accent),var(--adop-violet));opacity:.35;border-radius:2px;}
.adop-tl-item{position:relative;margin-bottom:32px;}
.adop-tl-item:last-child{margin-bottom:0;}
.adop-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--adop-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.adop-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.adop-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.adop-case-grid{grid-template-columns:1fr;}}
.adop-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.adop-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--adop-green);margin-bottom:10px;}
.adop-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.adop-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.adop-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--adop-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.adop-faq-q::after{content:'▾';font-size:13px;color:var(--adop-accent);flex-shrink:0;transition:transform .25s;}
.adop-faq-item.open .adop-faq-q::after{transform:rotate(180deg);}
.adop-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--adop-muted);line-height:1.72;}
.adop-faq-item.open .adop-faq-a{max-height:800px;padding:0 24px 20px;}
.adop-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.adop-content .ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.adop-content .ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.adop-content .ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.adop-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.adop-content .ym-cta-block__sub{color:var(--adop-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.adop-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.adop-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.adop-content .ym-link--accent{color:var(--adop-accent)!important;text-decoration:underline!important;}
.adop-footnote{font-size:13px;color:#64748b;font-style:italic;margin-top:32px;padding-top:24px;border-top:1px solid rgba(255,255,255,.08);}
@media(max-width:600px){.adop-content .ym-cta-block{padding:28px 20px;}}
</style>

<div class="adop-content" id="adop-article-body">

  <!-- INTRO -->
  <section class="adop-intro" id="intro" aria-label="Введение">
    <div class="adop-cnt">
      <div class="adop-intro-grid nero-ai-reveal">
        <div class="adop-intro-text">
          <p class="adop-eyebrow">Лонгрид · AI для отдела продаж</p>
          <p><strong>Коротко:</strong> AI для отдела продаж — это не чат-бот на сайте, а слой автоматизации поверх CRM и каналов связи: квалификация лидов, письма и follow-up, подсказки менеджерам в момент диалога, дисциплина CRM и контроль сделок. Nero Network внедряет такой AI-помощник продаж под ключ — от аудита воронки до запуска и сопровождения по метрикам.</p>
          <p>Руководитель отдела продаж знает ситуацию: заявки приходят, менеджеры заняты, в CRM пустые карточки, follow-up откладывается «на завтра», а конкурент отвечает клиенту быстрее. В 2026 году это уже не вопрос «нужен ли AI в продажах» — по данным <a href="https://www.salesforce.com/news/stories/state-of-sales-report-announcement-2026/" target="_blank" rel="noopener noreferrer">Salesforce State of Sales Report 2026</a>, <strong>87% организаций</strong> используют AI в sales-процессах, а <strong>AI и AI-агенты названы главной тактикой роста</strong> на 2026 год.</p>
          <p>Nero Network закрывает этот запрос как услугу: <strong>внедрение ai для отдела продаж под ключ</strong> — с интеграцией в amoCRM, Bitrix24 и ваши каналы, с human-in-the-loop и контролем для РОПа.</p>
        </div>
        <div class="adop-intro-kpi" aria-label="Ключевые показатели">
          <div class="adop-kpi-card"><div class="kv">87%</div><div class="kl">организаций с AI в sales</div></div>
          <div class="adop-kpi-card"><div class="kv">3–8 сек</div><div class="kl">первый ответ (кейс B2B)</div></div>
          <div class="adop-kpi-card"><div class="kv">+61%</div><div class="kl">квалифицированные лиды за 60 дн.</div></div>
          <div class="adop-kpi-card"><div class="kv">250К+</div><div class="kl">ориентир чека под ключ</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="adop-toc-outer">
    <div class="adop-cnt">
      <nav class="adop-toc" aria-label="Оглавление">
        <a href="#zachem-ai">Зачем AI</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#crm">CRM</a>
        <a href="#cena">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Заказать</a>
      </nav>
    </div>
  </div>

  <!-- H2 #1: zachem-ai -->
  <section class="adop-section" id="zachem-ai">
    <div class="adop-cnt">
      <div class="adop-sh adop-left">
        <span class="adop-eyebrow">Боль РОПа</span>
        <h2>Почему отдел продаж теряет лиды без AI</h2>
      </div>

      <div class="adop-scenario nero-ai-reveal" id="medlennaya-obrabotka">
        <h3>Медленная обработка заявок и «дырявая» воронка</h3>
        <p>Типичная картина: лид приходит в нерабочее время или в пик нагрузки — и ждёт первого ответа часами. По кейсу ЭПОХА\ИИ (B2B) время первого ответа до внедрения составляло <strong>2–4 часа</strong>; после запуска агента — <strong>3–8 секунд</strong> (<a href="https://epokha.ai/blog/keis-ai-menedzher" target="_blank" rel="noopener noreferrer">epokha.ai</a>).</p>
        <p><strong>Определение:</strong> «дырявая воронка» — когда лиды теряются не на этапе переговоров, а раньше: нет первого касания, нет квалификации, сделка зависла без статуса. AI продажи и нейросети продажи закрывают именно этот разрыв.</p>
        <p>По оценкам <a href="https://www.kixie.com/sales-blog/sales-automation-statistics-2026/" target="_blank" rel="noopener noreferrer">Kixie (2026)</a>, продавцы тратят до <strong>~60% рабочего времени</strong> на задачи, не связанные напрямую с закрытием сделок.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal nero-ai-delay-1" id="zabytyj-followup">
        <h3>Забытый follow-up и слабая дисциплина CRM</h3>
        <p>Менеджеры забывают follow-up, карточки в CRM остаются пустыми, просроченные задачи не видны до еженедельного разбора. AI-агенты в 2026 году не только советуют, но и <strong>действуют</strong> — пишут в CRM, отправляют цепочки follow-up, напоминают о просроченных касаниях.</p>
        <p>Salesforce фиксирует: <strong>54% продавцов</strong> уже использовали AI-агентов; для лидеров с агентами <strong>94%</strong> называют их критичными для бизнеса.</p>
      </div>

      <div class="adop-card nero-ai-reveal nero-ai-delay-2" id="trend-2026">
        <h3>Тренд 2026: AI в sales-командах (Salesforce State of Sales)</h3>
        <p>Salesforce опросил <strong>4 050 sales-профессионалов</strong> (август–сентябрь 2025, 22 страны):</p>
        <div class="adop-table-wrap">
          <table class="adop-table">
            <thead><tr><th>Показатель</th><th>Значение</th></tr></thead>
            <tbody>
              <tr><td>Организации с AI в sales</td><td><strong>87%</strong></td></tr>
              <tr><td>AI и AI-агенты как тактика роста №1</td><td><strong>2026</strong></td></tr>
              <tr><td>Продавцы, использовавшие агентов</td><td><strong>54%</strong></td></tr>
              <tr><td>Ожидаемое сокращение времени на email/контент</td><td><strong>−36%</strong></td></tr>
              <tr><td>Топ-перформеры: prospecting AI-агенты</td><td><strong>1,7×</strong> чаще</td></tr>
              <tr><td>Лидеры: разрозненные системы тормозят AI</td><td><strong>51%</strong></td></tr>
            </tbody>
          </table>
        </div>
        <p>Adam Alfano, EVP Sales в Salesforce: <em>«We want to kill the busywork so our teams can focus on what actually moves deals forward»</em>.</p>
        <p>Внутри Salesforce AI-агенты за 4 месяца связались с <strong>130 000</strong> «необработанными» лидами и создали <strong>3 200 opportunities</strong> — сценарий реанимации базы для российского B2B.</p>
        <p><strong>Итог блока:</strong> если отдел продаж теряет лиды из-за скорости, follow-up и пустой CRM — это повод внедрить ai для отдела продаж с измеримыми KPI на пилоте, а не нанимать ещё двух менеджеров на первую линию.</p>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->
  <div class="adop-cnt">
    <p class="adop-related nero-ai-reveal" style="margin:28px 0 10px;font-size:15px;line-height:1.72;color:var(--adop-muted)">Когда «дырявая воронка» связана с amoCRM — квалификация, статусы сделок и SLA первого ответа — имеет смысл сравнить узкий CRM-сценарий: <a href="/vnedrenie-ai-amocrm/" style="color:var(--adop-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> с автозаписью лидов и задач без ручного переноса данных.</p>
    <p class="adop-related nero-ai-reveal" style="margin:0 0 28px;font-size:15px;line-height:1.72;color:var(--adop-muted)">Если основная потеря выручки — в забытых письмах и цепочках follow-up, отдельная посадочная про <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--adop-accent);text-decoration:underline;text-underline-offset:3px">AI-обработку входящей почты в CRM</a> показывает, как triage и маршрутизация писем закрывают разрыв до этапа переговоров.</p>
  </div>

  <!-- H2 #2: scenarii -->
  <section class="adop-section adop-section-alt" id="scenarii">
    <div class="adop-cnt">
      <div class="adop-sh">
        <span class="adop-eyebrow">Сценарии AI</span>
        <h2>Что даёт AI для отдела продаж: задачи и сценарии</h2>
        <p><strong>Определение:</strong> AI для отдела продаж — слой из ai агентов и автоматизации поверх CRM и каналов, который закрывает узкие места воронки до переговоров по крупным чекам.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal" id="kvalifikaciya">
        <h3>Квалификация и скоринг лидов</h3>
        <p>Агент отвечает в SLA (до 1 минуты), задаёт вопросы по скрипту (BANT, MEDDIC), фиксирует бюджет, срок и потребность в CRM. <strong>Lead scoring</strong> приоритизирует очередь. В кейсе ЭПОХА\ИИ доля квалифицированных лидов выросла на <strong>+61% за 60 дней</strong>.</p>
        <p>Штатные amoAI / Bitrix24 CoPilot подходят для базовых задач; для мультиканала и жёсткой записи в поля CRM нужен кастомный ai агент под ключ.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal nero-ai-delay-1" id="follow-up">
        <h3>Письма, КП и автоматический follow-up</h3>
        <p>Черновики писем и КП по шаблонам бренда, цепочки напоминаний по email, Telegram, WhatsApp — по расписанию и триггерам. Salesforce фиксирует ожидаемое сокращение времени на email и контент на <strong>36%</strong>.</p>
        <p>На этапе пилота Nero Network рекомендует <strong>human-in-the-loop</strong>: исходящие письма и скидки согласует менеджер или РОП.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal nero-ai-delay-2" id="podskazki">
        <h3>Подсказки менеджеру в звонке и переписке</h3>
        <p>Контекст из CRM, история переписки, типовые возражения, черновик ответа, next-best-action. После звонка — транскрибация и саммари с автозаполнением полей.</p>
        <p><em>«AI не заменил переговоры — он убрал всё, что было до них»</em> — владелец компании из кейса ЭПОХА\ИИ.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal nero-ai-delay-1" id="kontrol-crm">
        <h3>Контроль сделок и прогноз воронки в CRM</h3>
        <p>Дашборд SLA, конверсия по этапам, доля автозаполнения CRM, просроченные задачи, лиды без касаний 24/48 часов. Adam Alfano: <em>«The secret sauce for sales AI agents is unified data… Otherwise, you get garbage outputs»</em> — <strong>51% лидеров</strong> называют разрозненные системы главным тормозом.</p>
      </div>

      <div class="adop-table-wrap nero-ai-reveal">
        <table class="adop-table">
          <thead><tr><th>Задача AI</th><th>Что делает</th><th>Что остаётся человеку</th></tr></thead>
          <tbody>
            <tr><td>Квалификация</td><td>Вопросы по скрипту, запись в CRM, скоринг</td><td>Переговоры по крупным чекам</td></tr>
            <tr><td>Follow-up</td><td>Письма, напоминания, цепочки</td><td>Согласование нестандартных условий</td></tr>
            <tr><td>Подсказки</td><td>Контекст, возражения, черновик КП</td><td>Финальное закрытие сделки</td></tr>
            <tr><td>Контроль CRM</td><td>Саммари, автозаполнение, SLA-дашборд</td><td>Скидки, юридические формулировки</td></tr>
            <tr><td>Прогноз</td><td>Приоритизация, next-best-action</td><td>Стратегия и план продаж</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- CTA-1 Артура: после #scenarii -->
  <div class="adop-cnt">
    <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-audit-voronki">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Бесплатный аудит воронки продаж</p>
        <p class="ym-cta-block__sub">Покажем, где теряются лиды: SLA первого ответа, просроченный follow-up и пустые поля CRM. На выходе — приоритеты для пилота AI-помощника, без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </aside>
  </div>

  <!-- ================================================
       БОРИС: визуальный блок (продолжение hero)
       ================================================ -->
  <section id="ai-dlya-otdela-prodazh-boris-block" class="basp-root" aria-label="Анимация: ночной цикл AI-помощника продаж — лиды из каналов в CRM к утру">
<style>
/* === БОРИС: prefix basp-, scoped внутри #ai-dlya-otdela-prodazh-boris-block === */
#ai-dlya-otdela-prodazh-boris-block.basp-root{
  padding:56px 0 64px;
  background:#f0f4fb;
}
#ai-dlya-otdela-prodazh-boris-block .basp-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-dlya-otdela-prodazh-boris-block .basp-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.10),0 0 0 1px rgba(99,102,241,.14);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-dlya-otdela-prodazh-boris-block .basp-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-dlya-otdela-prodazh-boris-block .basp-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-otdela-prodazh-boris-block .basp-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ai-dlya-otdela-prodazh-boris-block .basp-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#6366f1;margin:0 0 14px;
}
#ai-dlya-otdela-prodazh-boris-block .basp-ey::before{
  content:'';width:18px;height:2px;background:#6366f1;border-radius:1px;
}
#ai-dlya-otdela-prodazh-boris-block .basp-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ai-dlya-otdela-prodazh-boris-block .basp-ul{
  list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;
}
#ai-dlya-otdela-prodazh-boris-block .basp-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#ai-dlya-otdela-prodazh-boris-block .basp-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(99,102,241,.1);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#6366f1;margin-top:1px;font-style:normal;
}
#ai-dlya-otdela-prodazh-boris-block .basp-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-dlya-otdela-prodazh-boris-block .basp-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-dlya-otdela-prodazh-boris-block .basp-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-dlya-otdela-prodazh-boris-block .basp-pl-b{background:rgba(99,102,241,.08);color:#4338ca;border:1.5px solid rgba(99,102,241,.22);}
#ai-dlya-otdela-prodazh-boris-block .basp-pl-c{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22);}
#ai-dlya-otdela-prodazh-boris-block .basp-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-dlya-otdela-prodazh-boris-block .basp-rgt{
  position:relative;
  background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){
  #ai-dlya-otdela-prodazh-boris-block .basp-rgt{min-height:380px;}
}
#basp-sales-pipeline-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="basp-cnt">
  <div class="basp-card">
    <div class="basp-lft">
      <span class="basp-ey">Ночной цикл AI</span>
      <h3 class="basp-h3">Пока отдел спит: лиды квалифицированы, CRM заполнена, задачи стоят</h3>
      <ul class="basp-ul">
        <li><span class="basp-ic">1</span>Заявки с сайта, Telegram и email принимаются 24/7 — SLA до 1 минуты</li>
        <li><span class="basp-ic">2</span>AI-агент задаёт вопросы по BANT, пишет саммари и lead score в CRM</li>
        <li><span class="basp-ic">3</span>Follow-up уходит по триггерам; просроченные касания подсвечиваются РОПу</li>
        <li><span class="basp-ic">→</span>Утром менеджер видит готовые карточки — только переговоры и закрытие</li>
      </ul>
      <div class="basp-pills">
        <span class="basp-pl basp-pl-g">2–4 ч → 3–8 сек</span>
        <span class="basp-pl basp-pl-c">+61% квалификация</span>
        <span class="basp-pl basp-pl-b">amoCRM · Bitrix24</span>
      </div>
      <p class="basp-foot">Дальше — этапы внедрения AI для отдела продаж под ключ →</p>
    </div>
    <div class="basp-rgt">
      <canvas id="basp-sales-pipeline-canvas" aria-label="Анимация: лиды проходят каналы, квалификацию AI-агентом и попадают в CRM с задачами менеджерам" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('basp-sales-pipeline-canvas');
  if (!cv) return;
  var cx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0, pulse = 0;
  var LOOP = 680;

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
    cyan:'#22d3ee', cyanD:function(a){return 'rgba(34,211,238,'+a+')';},
    viol:'#a78bfa', violD:function(a){return 'rgba(167,139,250,'+a+')';},
    green:'#4ade80', greenD:function(a){return 'rgba(74,222,128,'+a+')';},
    amber:'#fbbf24', amberD:function(a){return 'rgba(251,191,36,'+a+')';},
    text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    line:'rgba(255,255,255,.08)', card:'rgba(255,255,255,.06)', cardBdr:'rgba(255,255,255,.12)'
  };

  var STAGES = [
    {label:'Каналы', xR:.14, clr:C.cyan, dim:C.cyanD},
    {label:'AI-агент', xR:.42, clr:C.viol, dim:C.violD},
    {label:'CRM', xR:.70, clr:C.green, dim:C.greenD},
    {label:'Менеджер', xR:.90, clr:C.amber, dim:C.amberD}
  ];

  var LEADS = [
    {ch:'Сайт', stage:0, delay:30, spd:.0042},
    {ch:'TG', stage:0, delay:90, spd:.0045},
    {ch:'Email', stage:0, delay:150, spd:.004},
    {ch:'Авито', stage:0, delay:220, spd:.0043},
    {ch:'WA', stage:0, delay:290, spd:.0041},
    {ch:'Сайт', stage:0, delay:360, spd:.0044},
    {ch:'TG', stage:0, delay:430, spd:.0042},
    {ch:'Email', stage:0, delay:500, spd:.004}
  ];

  function initLeads(){
    LEADS.forEach(function(l){
      l.t = 0; l.x = 0; l.active = false; l.done = false; l.alpha = 0;
      l.name = ['ООО Прогресс','ИП Смирнов','ТехЛидер','Медиа Групп','Альфа-Строй','БизнесПро'][Math.floor(Math.random()*6)];
    });
  }
  initLeads();

  function rr(x,y,w,h,r,fill,stroke,lw){
    cx.beginPath();
    if(cx.roundRect){cx.roundRect(x,y,w,h,r);}
    else{cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);cx.arcTo(x,y,x+w,y,r);cx.closePath();}
    if(fill){cx.fillStyle=fill;cx.fill();}
    if(stroke){cx.strokeStyle=stroke;cx.lineWidth=lw||1.5;cx.stroke();}
  }

  function stageX(i){ return W * STAGES[i].xR; }

  function drawHeader(){
    cx.fillStyle=C.text;
    cx.font='bold 13px Inter,system-ui,sans-serif';
    cx.textAlign='left';
    cx.fillText('AI-помощник продаж  ·  ночной цикл  ·  03:12', 14, 24);
    var gR = 7 + Math.sin(pulse * 0.08) * 2;
    cx.beginPath(); cx.arc(W - 58, 20, gR + 3, 0, Math.PI * 2);
    cx.fillStyle = 'rgba(34,197,94,' + (0.12 + 0.08 * Math.sin(pulse * 0.08)) + ')';
    cx.fill();
    cx.beginPath(); cx.arc(W - 58, 20, 4, 0, Math.PI * 2);
    cx.fillStyle = '#22c55e'; cx.fill();
    cx.fillStyle = C.green; cx.font = '10px Inter,sans-serif';
    cx.fillText('live', W - 48, 24);
    cx.strokeStyle = C.line; cx.lineWidth = 1;
    cx.beginPath(); cx.moveTo(0, 36); cx.lineTo(W, 36); cx.stroke();
  }

  function drawPipeline(){
    var yMid = H * 0.52;
    var top = 52;
    cx.strokeStyle = C.line; cx.lineWidth = 2;
    cx.setLineDash([6, 8]);
    cx.beginPath(); cx.moveTo(W * 0.06, yMid); cx.lineTo(W * 0.94, yMid); cx.stroke();
    cx.setLineDash([]);

    STAGES.forEach(function(st, i){
      var x = stageX(i);
      rr(x - 52, top, 104, H - top - 56, 12, C.card, C.cardBdr, 1.5);
      cx.fillStyle = st.clr;
      cx.font = 'bold 11px Inter,sans-serif';
      cx.textAlign = 'center';
      cx.fillText(st.label, x, top + 22);

      if(i === 1){
        for(var d = 0; d < 3; d++){
          var ang = (d / 3) * Math.PI * 2 + pulse * 0.1;
          cx.beginPath();
          cx.arc(x + Math.cos(ang) * 14, yMid + Math.sin(ang) * 10, 3, 0, Math.PI * 2);
          cx.fillStyle = C.viol; cx.fill();
        }
        cx.fillStyle = C.muted; cx.font = '9px Inter,sans-serif';
        cx.fillText('BANT · score', x, yMid + 28);
      }
      if(i === 2){
        var done = LEADS.filter(function(l){return l.done;}).length;
        if(done > 0){
          rr(x - 18, top + 8, 30, 18, 9, st.dim(0.2), null, 0);
          cx.fillStyle = st.clr; cx.font = 'bold 10px Inter,sans-serif';
          cx.fillText(done, x - 3, top + 21);
        }
      }
    });
  }

  function drawLeads(loopFr){
    var yMid = H * 0.52;
    LEADS.forEach(function(l){
      if(!l.active && loopFr >= l.delay){
        l.active = true; l.t = 0; l.x = W * 0.04;
      }
      if(!l.active) return;

      l.t += l.spd;
      l.x = W * (0.04 + l.t * 0.92);
      l.alpha = Math.min(1, l.alpha + 0.06);

      if(l.t >= 0.92){ l.done = true; l.active = false; }

      cx.globalAlpha = l.done ? 0.35 : l.alpha;
      var stage = l.t < 0.28 ? 0 : l.t < 0.55 ? 1 : l.t < 0.82 ? 2 : 3;
      var st = STAGES[stage];
      var ly = yMid + (LEADS.indexOf(l) % 3 - 1) * 22;

      rr(l.x - 38, ly - 14, 76, 28, 8, st.dim(0.12), st.dim(0.35), 1.5);
      cx.fillStyle = C.text; cx.font = 'bold 10px Inter,sans-serif'; cx.textAlign = 'left';
      var nm = l.name.length > 9 ? l.name.slice(0, 8) + '…' : l.name;
      cx.fillText(nm, l.x - 32, ly + 1);
      cx.fillStyle = st.clr; cx.font = '9px Inter,sans-serif';
      cx.fillText(l.ch, l.x - 32, ly + 11);

      if(stage >= 2){
        cx.fillStyle = C.green; cx.font = 'bold 12px sans-serif'; cx.textAlign = 'right';
        cx.fillText('✓', l.x + 30, ly + 4);
      }
      cx.globalAlpha = 1;
    });
  }

  function drawFooter(){
    var barY = H - 34;
    cx.strokeStyle = C.line; cx.lineWidth = 1;
    cx.beginPath(); cx.moveTo(0, barY); cx.lineTo(W, barY); cx.stroke();
    var ready = LEADS.filter(function(l){return l.done;}).length;
    var active = LEADS.filter(function(l){return l.active;}).length;
    cx.fillStyle = C.muted; cx.font = '11px Inter,sans-serif'; cx.textAlign = 'left';
    cx.fillText('За ночь: ' + ready + ' лидов в CRM' + (active ? ', ' + active + ' в обработке' : ''), 12, barY + 18);
  }

  function loop(){
    fr++; pulse++;
    var loopFr = fr % LOOP;
    if(loopFr === 0) initLeads();

    cx.clearRect(0, 0, W, H);
    drawHeader();
    drawPipeline();
    drawLeads(loopFr);
    drawFooter();
    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>
  <!-- / БОРИС -->

  <!-- H2 #3: vnedrenie -->
  <section class="adop-section" id="vnedrenie">
    <div class="adop-cnt">
      <div class="adop-sh adop-left">
        <span class="adop-eyebrow">Под ключ</span>
        <h2>Внедрение AI для отдела продаж под ключ</h2>
        <p>Проектная модель с фиксированными этапами. Ориентир чека: <strong>250 тыс.–2 млн ₽</strong> — от пилота до полного контура.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal" id="audit-voronki">
        <h3>Аудит воронки продаж (лид-магнит)</h3>
        <ul>
          <li>карта каналов: сайт, мессенджеры, Авито, email, телефония;</li>
          <li>SLA первого ответа по факту;</li>
          <li>% лидов без контакта за 24 часа;</li>
          <li>заполненность обязательных полей CRM;</li>
          <li>этапы с максимальным отвалом.</li>
        </ul>
        <p>Результат — список дыр с приоритетом: что закрыть агентом в первую очередь для быстрого ROI.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal nero-ai-delay-1" id="proektirovanie">
        <h3>Проектирование сценариев под вашу CRM</h3>
        <p>Входящая заявка → квалификация → follow-up → карточка в CRM; реанимация «забытых» сделок; подсказки после звонка. Стек: amoCRM / Bitrix24 + Make/n8n + LLM (YandexGPT, GigaChat — РФ-контур).</p>
      </div>

      <div class="adop-scenario nero-ai-reveal nero-ai-delay-2" id="zapusk-obuchenie">
        <h3>Запуск, обучение РОПа и менеджеров</h3>
        <p>Пилот — <strong>2–4 недели</strong> на одном сценарии. Порог окупаемости по B2B-кейсам — от <strong>~20 заявок/день</strong>.</p>
      </div>

      <!-- CTA-2 Артура -->
      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Разобраться в AI до старта пилота</p>
          <p class="ym-cta-block__sub">Если РОП и менеджеры хотят понимать n8n, промпты и human-in-the-loop до внедрения — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование сценариев на этапе запуска.</p>
        </div>
      </aside>

      <div class="adop-scenario nero-ai-reveal" id="soprovozhdenie">
        <h3>Сопровождение и доработка по метрикам</h3>
        <p>Доработка промптов, расширение базы знаний, call coaching, реанимация базы, next-best-action. Модель «цифровой сотрудник с KPI» — агент с регламентом и performance review.</p>
      </div>

      <div class="adop-card nero-ai-reveal nero-ai-delay-1">
        <h3>Логика работы системы (проектная модель Nero Network)</h3>
        <ol>
          <li>Лид приходит из канала (сайт, мессенджер, Авито, email).</li>
          <li>AI-агент отвечает в SLA, квалифицирует по скрипту.</li>
          <li>Данные пишутся в CRM: источник, бюджет, срок, саммари диалога.</li>
          <li>Lead score определяет следующее действие.</li>
          <li>Менеджер получает подсказки; крупные сделки — только человек.</li>
          <li>РОП видит воронку и «дыры»: просрочки, пустые поля, лиды без касаний.</li>
        </ol>
      </div>
    </div>
  </section>

  <!-- H2 #4: crm -->
  <section class="adop-section adop-section-alt" id="crm">
    <div class="adop-cnt">
      <div class="adop-sh">
        <span class="adop-eyebrow">Интеграции</span>
        <h2>Интеграция AI с CRM: amoCRM, Bitrix24 и другие</h2>
        <p>Поверх вашей CRM — без миграции. amoCRM, Bitrix24, RetailCRM, 1С через API.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal">
        <h3>Какие данные подключаем (лиды, сделки, активности)</h3>
        <ul>
          <li><strong>Входящие:</strong> лиды, сделки, контакты, источники, UTM;</li>
          <li><strong>Активности:</strong> звонки, письма, чаты, задачи;</li>
          <li><strong>Исходящие от агента:</strong> сделки, статусы, поля, саммари;</li>
          <li><strong>Триггеры:</strong> webhook, Telegram, WhatsApp, VK, телефония.</li>
        </ul>
        <p>Оркестрация — Make.com или n8n между CRM, LLM и каналами.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal nero-ai-delay-1">
        <h3>Безопасность и персональные данные</h3>
        <p>Для РФ-компаний критичен <strong>152-ФЗ</strong> (<a href="https://habr.com/ru/articles/1048334/" target="_blank" rel="noopener noreferrer">habr.com</a>). Nero Network проектирует контур с YandexGPT, GigaChat, on-prem или private API, договором обработки ПДн.</p>
      </div>

      <div class="adop-scenario nero-ai-reveal nero-ai-delay-2">
        <h3>Внедрение без программиста с вашей стороны</h3>
        <p>Разработка и настройка на стороне Nero Network; с вашей стороны — доступ к CRM, согласование скриптов и участие РОПа в приёмке пилота.</p>
      </div>

      <div class="adop-table-wrap nero-ai-reveal">
        <table class="adop-table">
          <thead><tr><th>Критерий</th><th>amoAI / Bitrix24 CoPilot</th><th>Кастомный AI-помощник под ключ</th></tr></thead>
          <tbody>
            <tr><td>Срок запуска</td><td>Дни</td><td>2–4 недели пилот</td></tr>
            <tr><td>Мультиканал</td><td>Ограниченно</td><td>Полный контур</td></tr>
            <tr><td>Скрипт квалификации</td><td>Шаблонный</td><td>Под ваш регламент</td></tr>
            <tr><td>Follow-up по триггерам</td><td>Базовый</td><td>Кастомные цепочки</td></tr>
            <tr><td>Дашборд SLA для РОПа</td><td>Стандартный</td><td>Под ваши KPI</td></tr>
            <tr><td>Стоимость входа</td><td>Подписка CRM</td><td>250 тыс.+ ₽ проект</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- H2 #5: cena -->
  <section class="adop-section" id="cena">
    <div class="adop-cnt">
      <div class="adop-sh adop-left">
        <span class="adop-eyebrow">ROI</span>
        <h2>Стоимость AI для отдела продаж и окупаемость</h2>
      </div>

      <div class="adop-table-wrap nero-ai-reveal">
        <table class="adop-table">
          <thead><tr><th>Фактор</th><th>Влияние на бюджет</th></tr></thead>
          <tbody>
            <tr><td>Число каналов (сайт, TG, WA, Авито, email)</td><td>+</td></tr>
            <tr><td>Глубина интеграции CRM</td><td>+</td></tr>
            <tr><td>Телефония + транскрибация</td><td>+</td></tr>
            <tr><td>Число сценариев</td><td>+</td></tr>
            <tr><td>Сопровождение после пилота</td><td>+</td></tr>
          </tbody>
        </table>
      </div>

      <div class="adop-scenario nero-ai-reveal nero-ai-delay-1">
        <h3>ROI: скорость лидов, конверсия, экономия времени</h3>
        <ul>
          <li>ЭПОХА\ИИ: выручка <strong>+18%</strong>, расходы первой линии <strong>−40%</strong> за 60 дней;</li>
          <li>Nurax.ai / Bitrix24 (маркетинговый кейс): конверсия <strong>8% → 27%</strong> — без независимой верификации;</li>
          <li>Salesforce: <strong>130 000</strong> лидов → <strong>3 200</strong> opportunities за 4 месяца.</li>
        </ul>
        <p><strong>Ai для отдела продаж консультация</strong> начинается с аудита воронки и расчёта под ваш поток заявок.</p>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->
  <div class="adop-cnt">
    <p class="adop-related nero-ai-reveal" style="margin:28px 0 10px;font-size:15px;line-height:1.72;color:var(--adop-muted)">Для компаний, где продажи стыкуются с учётным контуром, полезно посмотреть <a href="/ai-1c-erp/" style="color:var(--adop-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP</a> — сценарий «лид в CRM → счёт или заказ в 1С» без двойного ввода и с контролем документооборота.</p>
    <p class="adop-related nero-ai-reveal" style="margin:0 0 28px;font-size:15px;line-height:1.72;color:var(--adop-muted)">На фоне тренда 2026 и enterprise-масштаба в блоке ROI уместен разбор <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--adop-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude: уроки AI для бизнеса</a> — цифровые шлюзы и managed-агенты, которые можно адаптировать к sales-командам с большим потоком лидов.</p>
  </div>

  <!-- H2 #6: keisy -->
  <section class="adop-section adop-section-alt" id="keisy">
    <div class="adop-cnt">
      <div class="adop-sh">
        <span class="adop-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения AI в продажах</h2>
      </div>
      <div class="adop-case-grid">
        <div class="adop-case-card nero-ai-reveal">
          <div class="adop-case-tag">B2B · ЭПОХА\ИИ</div>
          <h3>Ускорение квалификации</h3>
          <p>~120 заявок/день; первый ответ <strong>2–4 ч → 3–8 сек</strong>; квалифицированные лиды <strong>+61%</strong>; выручка <strong>+18%</strong>. Крупные сделки — только с человеком.</p>
        </div>
        <div class="adop-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="adop-case-tag">Bitrix24 · Nurax.ai</div>
          <h3>Дисциплина follow-up</h3>
          <p>Заявлено: конверсия <strong>8% → 27%</strong>, ROI <strong>340%</strong>. ⚠️ Маркетинговый материал интегратора.</p>
        </div>
        <div class="adop-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="adop-case-tag">Международный · Asymbl</div>
          <h3>Цифровой SDR «Teddy»</h3>
          <p>~1000+ лидов/нед; агент с KPI и performance review. Nancy Xu (Salesforce): контроль качества встроен в модель.</p>
        </div>
      </div>

      <div class="adop-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Что измеряем после запуска</h3>
        <ol>
          <li>SLA первого ответа по каналам.</li>
          <li>% лидов с квалификацией.</li>
          <li>Конверсия по этапам воронки до/после.</li>
          <li>Доля эскалаций на менеджера.</li>
          <li>Время менеджера на рутину vs переговоры.</li>
          <li>Просроченные задачи и «забытые» сделки в CRM.</li>
        </ol>
      </div>
    </div>
  </section>

  <!-- H2 #7: smb -->
  <section class="adop-section" id="smb">
    <div class="adop-cnt">
      <div class="adop-sh adop-left">
        <span class="adop-eyebrow">МСБ</span>
        <h2>AI для отдела продаж: малый и средний бизнес</h2>
      </div>
      <div class="adop-grid-2" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
        <div class="adop-scenario nero-ai-reveal">
          <h3>Минимальный набор для старта</h3>
          <p>Входящая заявка → квалификация → карточка в CRM → одно follow-up. При потоке до 10–15 заявок/день — начните со штатного amoAI / CoPilot. При <strong>20+ заявках/день</strong> кастомный агент окупается быстрее.</p>
        </div>
        <div class="adop-scenario nero-ai-reveal nero-ai-delay-1">
          <h3>Масштабирование по мере роста</h3>
          <ol>
            <li>Квалификация + CRM (пилот).</li>
            <li>Follow-up и реанимация базы.</li>
            <li>Подсказки в звонках + call coaching.</li>
            <li>Прогноз воронки для РОПа.</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- H2 #8: faq -->
  <section class="adop-section adop-section-alt" id="faq">
    <div class="adop-cnt">
      <div class="adop-sh">
        <span class="adop-eyebrow">FAQ</span>
        <h2>FAQ — как внедрить AI в отдел продаж</h2>
      </div>
      <div class="adop-faq" id="adop-faq-accordion">
        <div class="adop-faq-item"><div class="adop-faq-q">Под ключ или самостоятельно?</div><div class="adop-faq-a"><p>Самостоятельная сборка на Make + ChatGPT возможна для MVP, но без 152-ФЗ, эскалаций и дашборда РОПа пилот часто «умирает» через 2–3 месяца. Под ключ Nero Network берёт архитектуру, интеграцию, пилот с KPI и сопровождение.</p></div></div>
        <div class="adop-faq-item"><div class="adop-faq-q">Сколько времени занимает внедрение?</div><div class="adop-faq-a"><p>Типовой пилот — <strong>2–4 недели</strong> на один сценарий. Полный контур — <strong>1,5–3 месяца</strong>.</p></div></div>
        <div class="adop-faq-item"><div class="adop-faq-q">Сколько стоит ai для отдела продаж?</div><div class="adop-faq-a"><p>Ориентир <strong>250 тыс.–2 млн ₽</strong>. Точная стоимость — после аудита воронки и выбора сценария пилота.</p></div></div>
        <div class="adop-faq-item"><div class="adop-faq-q">Какие задачи решает ai для отдела продаж?</div><div class="adop-faq-a"><p>Квалификация, первичный ответ 24/7, follow-up, саммари звонков, подсказки менеджеру, контроль просрочек и прогноз воронки. Не заменяет переговоры по крупным чекам и юридические формулировки.</p></div></div>
        <div class="adop-faq-item"><div class="adop-faq-q">Риски: галлюцинации, сопротивление менеджеров</div><div class="adop-faq-a"><p>База знаний, human-in-the-loop, эскалация; позиционирование «ИИ убирает рутину до переговоров»; 152-ФЗ и единый customer context.</p></div></div>
        <div class="adop-faq-item"><div class="adop-faq-q">Нужен ли свой разработчик?</div><div class="adop-faq-a"><p>На стороне заказчика — контакт РОПа и администратор CRM для API. Постоянный разработчик для поддержки агента не требуется.</p></div></div>
        <div class="adop-faq-item"><div class="adop-faq-q">С какой CRM работаете?</div><div class="adop-faq-a"><p>amoCRM, Bitrix24, RetailCRM, 1С через API — <strong>ai для отдела продаж с CRM</strong> без миграции.</p></div></div>
      </div>
    </div>
  </section>

  <!-- H2 #9: cta -->
  <section class="adop-section" id="cta">
    <div class="adop-cnt">
      <div class="adop-sh">
        <span class="adop-eyebrow">Заказать</span>
        <h2>Ускорить продажи — заказать внедрение AI</h2>
        <p>AI-помощник продаж из пяти функций — квалификация, письма, follow-up, подсказки, контроль CRM. Бесплатный аудит воронки, интеграция без миграции, compliance по 152-ФЗ.</p>
      </div>

      <ul class="adop-content" style="display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin:0 0 32px;padding:0;list-style:none;">
        <li style="padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--adop-muted);">Аудит воронки</li>
        <li style="padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--adop-muted);">Пилот 2–4 недели</li>
        <li style="padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--adop-muted);">amoCRM / Bitrix24</li>
        <li style="padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--adop-muted);">152-ФЗ</li>
      </ul>

      <!-- CTA-3 Артура -->
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final-block">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Ускорить продажи — заказать внедрение AI</p>
          <p class="ym-cta-block__sub">Аудит воронки, пилот за 2–4 недели, интеграция с amoCRM/Bitrix24 без миграции. Рассчитаем сценарий и стоимость под ваш поток заявок.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#cena" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Стоимость и ROI →</a>
          </div>
        </div>
      </div>

      <p class="adop-footnote">Проектная модель, этапы и модули на этой странице — методология Nero Network. Цифры из кейсов третьих сторон приведены с указанием источника; индивидуальный результат зависит от ниши, потока лидов и дисциплины внедрения.</p>
    </div>
  </section>

</div><!-- /adop-content -->



<?php
$adop_page_url = trailingslashit(get_permalink());
$adop_site_url = trailingslashit(home_url('/'));
$adop_brand    = get_bloginfo('name') ?: 'Nero Network';
$adop_schema   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => $adop_site_url . '#organization',
            'name'  => $adop_brand,
            'url'   => $adop_site_url,
        ],
        [
            '@type'     => 'WebSite',
            '@id'       => $adop_site_url . '#website',
            'url'       => $adop_site_url,
            'name'      => $adop_brand,
            'publisher' => ['@id' => $adop_site_url . '#organization'],
        ],
        [
            '@type'       => 'WebPage',
            '@id'         => $adop_page_url . '#webpage',
            'url'         => $adop_page_url,
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'isPartOf'    => ['@id' => $adop_site_url . '#website'],
            'about'       => ['@id' => $adop_site_url . '#organization'],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id'   => $adop_page_url . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $adop_site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $adop_page_url],
            ],
        ],
        [
            '@type'       => 'Service',
            '@id'         => $adop_page_url . '#service',
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'url'         => $adop_page_url,
            'provider'    => ['@id' => $adop_site_url . '#organization'],
        ],
        [
            '@type' => 'FAQPage',
            '@id'   => $adop_page_url . '#faq',
            'mainEntity' => [
                ['@type' => 'Question', 'name' => 'Под ключ или самостоятельно?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Самостоятельная сборка на Make + ChatGPT возможна для MVP, но без 152-ФЗ, эскалаций и дашборда РОПа пилот часто «умирает» через 2–3 месяца. Под ключ Nero Network берёт архитектуру, интеграцию, пилот с KPI и сопровождение.']],
                ['@type' => 'Question', 'name' => 'Сколько времени занимает внедрение?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Типовой пилот — 2–4 недели на один сценарий. Полный контур — 1,5–3 месяца.']],
                ['@type' => 'Question', 'name' => 'Сколько стоит ai для отдела продаж?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Ориентир 250 тыс.–2 млн ₽. Точная стоимость — после аудита воронки и выбора сценария пилота.']],
                ['@type' => 'Question', 'name' => 'Какие задачи решает ai для отдела продаж?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Квалификация, первичный ответ 24/7, follow-up, саммари звонков, подсказки менеджеру, контроль просрочек и прогноз воронки. Не заменяет переговоры по крупным чекам и юридические формулировки.']],
                ['@type' => 'Question', 'name' => 'Риски: галлюцинации, сопротивление менеджеров', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'База знаний, human-in-the-loop, эскалация; позиционирование «ИИ убирает рутину до переговоров»; 152-ФЗ и единый customer context.']],
                ['@type' => 'Question', 'name' => 'Нужен ли свой разработчик?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'На стороне заказчика — контакт РОПа и администратор CRM для API. Постоянный разработчик для поддержки агента не требуется.']],
                ['@type' => 'Question', 'name' => 'С какой CRM работаете?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'amoCRM, Bitrix24, RetailCRM, 1С через API — ai для отдела продаж с CRM без миграции.']],
            ],
        ],
    ],
];
echo '<script type="application/ld+json">' . wp_json_encode($adop_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
?>

</main>

<script id="sales-funnel-command-engine">
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("sales-funnel-command-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");
  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    const wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 360;
    canvas.height = wrap.clientHeight || 168;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 200) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const C = {
    outline: "#94a3b8",
    towerBg: "#1e293b",
    towerCard: "#334155",
    fieldEmpty: "#475569",
    fieldFill: "#22c55e",
    leadHot: "#f97316",
    leadWarm: "#3b82f6",
    leadCold: "#64748b",
    envelope: "#a78bfa",
    slaRing: "rgba(121,242,255,.35)",
    agentYellow: "#eab308", agentGreen: "#10b981", agentBlue: "#3b82f6",
    agentPink: "#ec4899", agentPurple: "#8b5cf6",
    bubbleBg: "rgba(15,23,42,.92)", bubbleText: "#e2e8f0"
  };

  function roundRect(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.lineWidth = 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  class LeadSpiral {
    constructor() { this.offset = 0; }
    draw(ctx) {
      this.offset = (frame * 0.45) % 360;
      ctx.save();
      ctx.strokeStyle = "rgba(121,242,255,.18)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      for (let t = 0; t <= 280; t += 4) {
        const ang = (t + this.offset) * Math.PI / 180;
        const r = 8 + t * 0.22;
        const px = -90 + Math.cos(ang) * r * 0.35;
        const py = -75 + Math.sin(ang) * r * 0.55 + t * 0.08;
        if (t === 0) ctx.moveTo(px, py); else ctx.lineTo(px, py);
      }
      ctx.stroke();
      const chips = [
        { phase: 0, color: C.leadWarm, label: "L" },
        { phase: 120, color: C.leadHot, label: "H" },
        { phase: 240, color: C.leadCold, label: "C" }
      ];
      chips.forEach(chip => {
        const t = (frame * 0.45 + chip.phase) % 280;
        const ang = t * Math.PI / 180;
        const r = 8 + t * 0.22;
        const px = -90 + Math.cos(ang) * r * 0.35;
        const py = -75 + Math.sin(ang) * r * 0.55 + t * 0.08;
        roundRect(ctx, px - 7, py - 7, 14, 14, 3, chip.color, C.outline);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(chip.label, px, py + 2);
      });
      ctx.restore();
    }
  }

  class CrmDealTower {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.phase = 0;
      this.handoffPulse = 0;
    }
    draw(ctx) {
      this.phase = (frame * 0.04) % 240;
      ctx.save();
      ctx.translate(this.x, this.y);
      roundRect(ctx, -42, -55, 84, 110, 6, C.towerBg, C.outline);
      const stages = ["Новый", "Квал.", "Сделка"];
      stages.forEach((st, i) => {
        const sy = -48 + i * 34;
        roundRect(ctx, -36, sy, 72, 28, 4, C.towerCard, "rgba(148,163,184,.3)");
        ctx.fillStyle = "#cbd5e1";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(st, 0, sy + 10);
        const fillLevel = Math.min(1, Math.max(0, (this.phase - i * 55) / 40));
        if (fillLevel > 0) {
          roundRect(ctx, -30, sy + 14, 60 * fillLevel, 6, 2, C.fieldFill, null);
        }
      });
      if (this.phase > 195) {
        this.handoffPulse = Math.sin(frame * 0.15) * 4;
        roundRect(ctx, -28, -68 + this.handoffPulse, 56, 14, 4, "rgba(34,197,94,.25)", C.fieldFill);
        ctx.fillStyle = C.fieldFill;
        ctx.font = "bold 8px Inter,sans-serif";
        ctx.fillText("→ Менеджер", 0, -58 + this.handoffPulse);
      }
      ctx.restore();
    }
  }

  class BantQualifier {
    draw(ctx) {
      const prg = (frame * 0.04) % 240;
      if (prg < 50 || prg > 130) return;
      const local = (prg - 50) / 80;
      const labels = ["B", "A", "N", "T"];
      labels.forEach((lb, i) => {
        const alpha = Math.min(1, Math.max(0, local * 4 - i));
        if (alpha <= 0) return;
        ctx.globalAlpha = alpha;
        roundRect(ctx, 55 + i * 16, -20, 12, 12, 2, C.fieldFill, C.outline);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(lb, 61 + i * 16, -11);
      });
      ctx.globalAlpha = 1;
    }
  }

  class FollowUpOrbit {
    draw(ctx) {
      const prg = (frame * 0.04) % 240;
      if (prg < 100 || prg > 190) return;
      const orbitR = 55 + Math.sin(frame * 0.05) * 3;
      for (let i = 0; i < 3; i++) {
        const ang = frame * 0.06 + i * (Math.PI * 2 / 3);
        const ex = Math.cos(ang) * orbitR;
        const ey = Math.sin(ang) * orbitR * 0.45 - 10;
        roundRect(ctx, ex - 8, ey - 5, 16, 10, 2, C.envelope, C.outline);
        ctx.fillStyle = "#fff";
        ctx.font = "6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("✉", ex, ey + 2);
      }
    }
  }

  class SlaPulseRing {
    draw(ctx) {
      const pulse = 48 + Math.sin(frame * 0.08) * 6;
      ctx.strokeStyle = C.slaRing;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.ellipse(0, 5, pulse * 0.55, pulse * 0.35, 0, 0, Math.PI * 2);
      ctx.stroke();
      ctx.beginPath();
      ctx.ellipse(0, 5, (pulse - 14) * 0.55, (pulse - 14) * 0.35, 0, 0, Math.PI * 2);
      ctx.stroke();
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs) {
      this.x = x; this.y = y; this.baseX = x; this.baseY = y;
      this.color = color; this.role = role;
      this.timer = Math.random() * 100;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
    }
    draw(ctx) {
      this.timer += 0.035;
      let isMoving = false, faceDir = 1;
      const prg = (frame * 0.04) % 240;
      const targetX = 20;
      const targetY = -15 + (this.stepTrig * 0.08);
      if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
        const local = prg - this.stepTrig;
        isMoving = true;
        faceDir = local < 11 ? 1 : -1;
        const t = local < 11 ? local / 11 : (local - 11) / 11;
        if (local < 11) {
          this.x = this.baseX + (targetX - this.baseX) * t;
          this.y = this.baseY + (targetY - this.baseY) * t;
        } else {
          this.x = targetX - (targetX - this.baseX) * t;
          this.y = targetY - (targetY - this.baseY) * t;
        }
      } else {
        this.x = this.baseX; this.y = this.baseY;
        if (frame % 180 === 0 && Math.random() < 0.12) {
          createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
        }
      }
      const bob = isMoving ? Math.abs(Math.sin(this.timer * 5)) * 2 : Math.sin(this.timer * 1.4);
      ctx.save();
      ctx.translate(this.x, this.y);
      roundRect(ctx, -8, 2, 6, 10, 2, C.outline, null);
      roundRect(ctx, 2, 2, 6, 10, 2, C.outline, null);
      roundRect(ctx, -10, -10 - bob, 20, 14, 5, this.color, C.outline);
      ctx.fillStyle = this.color;
      ctx.beginPath(); ctx.arc(0, -18 - bob, 8, 0, Math.PI * 2); ctx.fill();
      ctx.lineWidth = 1.5; ctx.strokeStyle = C.outline; ctx.stroke();
      ctx.restore();
    }
  }

  const entities = [];
  const bubbles = [];
  entities.push(new SlaPulseRing());
  entities.push(new LeadSpiral());
  entities.push(new CrmDealTower(0, 8));
  entities.push(new BantQualifier());
  entities.push(new FollowUpOrbit());
  entities.push(new Agent(-95, 35, C.agentYellow, "1_architect", 12, [
    "Карта воронки готова", "Сценарий BANT", "Аудит SLA", "Пилот на 1 канал", "Регламент этапов"
  ]));
  entities.push(new Agent(-70, 55, C.agentGreen, "2_seo", 58, [
    "Скоринг лида: 87", "BANT заполнен", "Горячий — в CRM", "Теги по нише", "Приоритет очереди"
  ]));
  entities.push(new Agent(-50, 25, C.agentBlue, "3_coder", 102, [
    "Webhook → amoCRM", "Поля записаны", "Make-сценарий", "API без миграции", "Статус обновлён"
  ]));
  entities.push(new Agent(-30, 50, C.agentPink, "4_designer", 146, [
    "Шаблон follow-up", "Тон бренда ок", "КП-черновик", "Письмо в TG", "Цепочка 24ч"
  ]));
  entities.push(new Agent(-10, 30, C.agentPurple, "5_deployer", 190, [
    "Пилот включён", "Human-in-the-loop", "Эскалация РОПу", "Дашборд SLA", "Передано менеджеру"
  ]));

  function createBubble(x, y, text, life = 260) {
    bubbles.push({ x, y, text, life, maxLife: life });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);
    entities.forEach(e => e.draw(ctx));

    const prg = (frame * 0.04) % 240;
    if (prg >= 10 && prg < 10.05) createBubble(-95, 10, "1. Лид в воронке");
    if (prg >= 55 && prg < 55.05) createBubble(-70, 30, "2. BANT-скоринг");
    if (prg >= 105 && prg < 105.05) createBubble(-50, 0, "3. Запись в CRM");
    if (prg >= 150 && prg < 150.05) createBubble(-30, 25, "4. Follow-up");
    if (prg >= 200 && prg < 200.05) createBubble(0, -75, "5. Менеджеру!");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (let i = bubbles.length - 1; i >= 0; i--) {
      const b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      let alpha = Math.min(1, b.life / 24);
      if (b.life > b.maxLife - 8) alpha = (b.maxLife - b.life) / 8;
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(b.text).width + 14;
      const th = 18;
      const by = b.y - (b.maxLife - b.life) * 0.04;
      roundRect(ctx, b.x - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, by - th / 2 + 1);
      ctx.globalAlpha = 1;
    }
    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  document.fonts.ready.then(() => engineloop()).catch(() => engineloop());
});
</script>

<script>
(function(){
  var acc = document.getElementById('adop-faq-accordion');
  if (!acc) return;
  acc.querySelectorAll('.adop-faq-q').forEach(function(q){
    q.addEventListener('click', function(){
      var item = q.parentElement;
      var open = item.classList.contains('open');
      acc.querySelectorAll('.adop-faq-item').forEach(function(i){ i.classList.remove('open'); });
      if (!open) item.classList.add('open');
    });
  });
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
