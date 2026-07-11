<?php
/**
 * Template Name: AI для документооборота: внедрение под ключ для бизнеса
 * Description: Внедрим AI для обработки, поиска и маршрутизации документов в юротделе, финансах и администрации.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для документооборота: внедрение под ключ для бизнеса';
$page_seo_description = 'Внедрим AI для обработки, поиска и маршрутизации документов в юротделе, финансах и администрации. Сократим согласования и ошибки. Аудит документооборота — бесплатно.';

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
    ['label' => 'Зачем AI',   'href' => '#zachem-ai-2026'],
    ['label' => 'Задачи',     'href' => '#zadachi-ai'],
    ['label' => 'Для кого',   'href' => '#dlya-kogo'],
    ['label' => 'Внедрение',  'href' => '#vnedrenie'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Стоимость',  'href' => '#stoimost'],
    ['label' => 'Кейсы',      'href' => '#keisy-roi'],
    ['label' => 'FAQ',        'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Автоматизировать документы';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie';

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

.ai-dokumentooborot-page .ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ai-dokumentooborot-page .ym-btn:hover{transform:translateY(-2px);}
.ai-dokumentooborot-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ai-dokumentooborot-page .ym-btn--ghost{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18);}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-dokumentooborot-page" role="main" tabindex="-1">
<span id="main" class="screen-reader-text" tabindex="-1">Основное содержимое</span>

<section class="nero-ai-hero ado-hero-dokumentooborot" id="hero" aria-labelledby="hero-dokumentooborot-title">
<style>
/* ── Hero ai-dokumentooborot: самодостаточные стили (Kadence + nero-ai-home-page) ── */
.ado-hero-dokumentooborot {
  --ado-cyan: #79f2ff;
  --ado-violet: #8b5cf6;
  --ado-green: #22c55e;
  --ado-amber: #fbbf24;
  --ado-text: #e6edf7;
  --ado-muted: #9aa8bd;
  --ado-soft: #c7d2e5;
  --ado-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: linear-gradient(165deg, #050711 0%, #080b17 48%, #0a0e1c 100%);
}
.ado-hero-dokumentooborot::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(121, 242, 255, 0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(121, 242, 255, 0.04) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 74%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.ado-hero-dokumentooborot::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, 0.14), transparent 68%);
  filter: blur(10px);
  animation: adoHeroGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes adoHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.ado-hero-dokumentooborot .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.ado-hero-dokumentooborot .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.ado-hero-dokumentooborot .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.ado-hero-dokumentooborot .nero-ai-gradient-text {
  background: linear-gradient(92deg, var(--ado-cyan) 0%, var(--ado-violet) 55%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.ado-hero-dokumentooborot .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--ado-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.ado-hero-dokumentooborot .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--ado-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.ado-hero-dokumentooborot .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.ado-hero-dokumentooborot .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.ado-hero-dokumentooborot .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.ado-hero-dokumentooborot .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 20px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  line-height: 1;
  text-decoration: none !important;
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.ado-hero-dokumentooborot .nero-ai-btn:hover { transform: translateY(-2px); }
.ado-hero-dokumentooborot .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--ado-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.ado-hero-dokumentooborot .nero-ai-btn-secondary {
  color: var(--ado-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.ado-hero-dokumentooborot .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--ado-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.ado-hero-dokumentooborot .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.ado-hero-dokumentooborot .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.ado-hero-dokumentooborot .nero-ai-dots { display: flex; gap: 7px; }
.ado-hero-dokumentooborot .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.ado-hero-dokumentooborot .nero-ai-dot:nth-child(1) { background: #fb7185; }
.ado-hero-dokumentooborot .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.ado-hero-dokumentooborot .nero-ai-dot:nth-child(3) { background: #34d399; }
.ado-hero-dokumentooborot .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.ado-hero-dokumentooborot .nero-ai-window-body { padding: 16px; }
.ado-hero-dokumentooborot .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.ado-hero-dokumentooborot .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.ado-hero-dokumentooborot .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.ado-hero-dokumentooborot .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: adoPulse 1.6s infinite;
}
@keyframes adoPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.ado-hero-dokumentooborot .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.ado-hero-dokumentooborot .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.ado-hero-dokumentooborot .nero-ai-metric span {
  display: block;
  color: var(--ado-muted);
  font-size: 11px;
  font-weight: 700;
}
.ado-hero-dokumentooborot .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.ado-hero-dokumentooborot .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.ado-hero-dokumentooborot .ado-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 28% 42%, rgba(121,242,255,.08), rgba(6,10,24,.94) 72%);
}
.ado-hero-dokumentooborot #ado-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.ado-hero-dokumentooborot .nero-ai-task-stream { display: grid; gap: 8px; }
.ado-hero-dokumentooborot .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.ado-hero-dokumentooborot .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--ado-cyan);
  font-size: 11px;
  font-weight: 800;
}
.ado-hero-dokumentooborot .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.ado-hero-dokumentooborot .nero-ai-task span {
  color: var(--ado-muted);
  font-size: 11px;
}
.ado-hero-dokumentooborot .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.ado-hero-dokumentooborot .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .ado-hero-dokumentooborot .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .ado-hero-dokumentooborot .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .ado-hero-dokumentooborot .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .ado-hero-dokumentooborot .nero-ai-window-body { padding: 12px; }
  .ado-hero-dokumentooborot .nero-ai-task { grid-template-columns: 28px 1fr; }
  .ado-hero-dokumentooborot .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai документооборот</p>
      <h1 id="hero-dokumentooborot-title">AI для документооборота: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Внедрим AI для обработки, поиска и маршрутизации документов — юротдел, финансы и администрация перестают терять время на ручные согласования и дорогие ошибки</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">OCR + поля</li>
        <li class="nero-ai-badge">RAG-поиск</li>
        <li class="nero-ai-badge">Согласования</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Автоматизировать документы</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zadachi-ai">Какие задачи решает AI</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-документооборота">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Документооборот · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Документы</span>
              <strong>847</strong>
              <small>/мес</small>
            </div>
            <div class="nero-ai-metric">
              <span>Авто</span>
              <strong>82%</strong>
              <small>без ручного ввода</small>
            </div>
            <div class="nero-ai-metric">
              <span>Цикл</span>
              <strong>−4.2×</strong>
              <small>согласование</small>
            </div>
            <div class="nero-ai-metric">
              <span>HITL</span>
              <strong>12%</strong>
              <small>на проверку</small>
            </div>
          </div>

          <div class="ado-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ado-hero-canvas" role="img" aria-label="Анимация: документы проходят intake, OCR, валидацию 152-ФЗ и маршрутизацию согласований"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий документооборота">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">PDF</span>
              <div><strong>PDF входящий</strong><span>Скан зарегистрирован · intake</span></div>
              <span class="nero-ai-status">OCR готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ДГ</span>
              <div><strong>Договор</strong><span>ИНН, сумма, срок · confidence 0.91</span></div>
              <span class="nero-ai-status">извлечение полей</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↳</span>
              <div><strong>Согласование</strong><span>Маршрут: юротдел → финансы</span></div>
              <span class="nero-ai-status nero-ai-status--amber">маршрут юротделу</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* === ADO CONTENT: scoped лонгрид ai-dokumentooborot === */
.ado-content{
  --ado-bg:#050711;--ado-bg2:#080b17;--ado-surface:rgba(255,255,255,.072);
  --ado-text:#e6edf7;--ado-muted:#9aa8bd;--ado-soft:#c7d2e5;--ado-heading:#fff;
  --ado-border:rgba(255,255,255,.10);--ado-accent:#79f2ff;--ado-violet:#8b5cf6;
  --ado-green:#22c55e;--ado-amber:#f59e0b;--ado-btn-from:#2563eb;--ado-btn-to:#7c3aed;
  --ado-container:1220px;--ado-r:18px;--ado-r-lg:24px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--ado-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
}
.ado-content *,.ado-content *::before,.ado-content *::after{box-sizing:border-box;}
.ado-content a{color:inherit;}
.ado-content p{color:var(--ado-muted);line-height:1.72;margin:0 0 1em;}
.ado-content p:last-child{margin-bottom:0;}
.ado-content h2,.ado-content h3{color:var(--ado-heading);letter-spacing:-.04em;margin:0 0 .65em;}
.ado-content strong{color:var(--ado-soft);}
.ado-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.ado-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--ado-muted);font-size:14.5px;line-height:1.65;}
.ado-content ul li::before{content:'›';position:absolute;left:0;color:var(--ado-accent);font-weight:700;}
.ado-cnt{width:min(var(--ado-container),calc(100% - 40px));margin:0 auto;}
.ado-section{padding:clamp(56px,7vw,96px) 0;}
.ado-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.ado-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.ado-sh.ado-left{margin-left:0;text-align:left;}
.ado-sh h2{font-size:clamp(26px,3.8vw,44px);line-height:1.08;}
.ado-sh p{font-size:clamp(15px,1.5vw,17px);max-width:680px;margin:0 auto;}
.ado-sh.ado-left p{margin-left:0;}
.ado-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--ado-accent);margin-bottom:14px;}
.ado-intro{padding:clamp(40px,5vw,72px) 0;border-bottom:1px solid rgba(255,255,255,.06);}
.ado-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:center;}
.ado-intro-text{padding-left:20px;position:relative;}
.ado-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--ado-accent),var(--ado-violet));}
.ado-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.ado-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.ado-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:#fff;margin-bottom:5px;}
.ado-kpi-card .kl{font-size:11px;font-weight:600;color:var(--ado-muted);line-height:1.4;}
.ado-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
.ado-toc-outer{padding:20px 0 8px;}
.ado-toc{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;}
.ado-toc a{padding:8px 14px;border-radius:999px;border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04);font-size:13px;font-weight:600;color:var(--ado-soft)!important;text-decoration:none!important;transition:background .2s,border-color .2s;}
.ado-toc a:hover{background:rgba(121,242,255,.1);border-color:rgba(121,242,255,.25);}
.ado-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:var(--ado-r-lg);padding:24px 26px;backdrop-filter:blur(12px);}
.ado-grid-2{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px;}
.ado-grid-3{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;}
.ado-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.1);}
.ado-table{width:100%;border-collapse:collapse;font-size:14px;}
.ado-table th,.ado-table td{padding:12px 14px;text-align:left;border-bottom:1px solid rgba(255,255,255,.08);}
.ado-table th{color:var(--ado-accent);font-size:12px;text-transform:uppercase;letter-spacing:.06em;background:rgba(255,255,255,.04);}
.ado-table td{color:var(--ado-muted);}
.ado-table tr:last-child td{border-bottom:none;}
.ado-flow{display:flex;flex-wrap:wrap;align-items:center;gap:8px;padding:18px 20px;border-radius:var(--ado-r);background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.15);font-size:13px;font-weight:600;color:var(--ado-soft);}
.ado-flow .arr{color:var(--ado-accent);opacity:.7;}
.ado-timeline{display:grid;gap:16px;}
.ado-tl-item{padding:18px 20px;border-radius:var(--ado-r);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-left:3px solid var(--ado-accent);}
.ado-tl-item h3{font-size:17px;margin-bottom:8px;}
.ado-warn{border-color:rgba(245,158,11,.35)!important;background:rgba(245,158,11,.06)!important;border-left:3px solid var(--ado-amber)!important;}
.ado-metric-green{color:var(--ado-green)!important;font-weight:800;}
.ado-faq-item{padding:20px 0;border-bottom:1px solid rgba(255,255,255,.08);}
.ado-faq-item:last-child{border-bottom:none;}
.ado-faq-item h3{font-size:17px;margin-bottom:10px;}
.ym-cta-block{margin:40px 0;padding:28px 32px;border-radius:var(--ado-r-lg);text-align:center;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);}
.ym-cta-block--primary{background:linear-gradient(135deg,rgba(37,99,235,.15),rgba(124,58,237,.12));border-color:rgba(121,242,255,.2);}
.ym-cta-block--dual{background:rgba(139,92,246,.08);border-color:rgba(139,92,246,.2);}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(37,99,235,.18),rgba(124,58,237,.14));border-color:rgba(121,242,255,.25);padding:40px 36px;}
.ym-cta-block__headline{font-size:clamp(20px,2.5vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--ado-muted);font-size:15px;margin:0 auto 20px;max-width:640px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--ado-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(20px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:900px){.ado-intro-grid,.ado-grid-2,.ado-grid-3{grid-template-columns:1fr;}.ado-intro-kpi{grid-template-columns:repeat(2,1fr);}}
@media(max-width:520px){.ado-intro-kpi{grid-template-columns:1fr;}}

/* === БОРИС: prefix ado-b-, scoped #ai-dokumentooborot-boris-block === */
#ai-dokumentooborot-boris-block.ado-b-root{padding:48px 0 56px;background:#f8fafc;margin:32px 0;}
#ai-dokumentooborot-boris-block .ado-b-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-dokumentooborot-boris-block .ado-b-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px;}
@media(max-width:1023px){#ai-dokumentooborot-boris-block .ado-b-card{grid-template-columns:1fr;min-height:auto;}}
#ai-dokumentooborot-boris-block .ado-b-lft{padding:36px 32px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-dokumentooborot-boris-block .ado-b-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:28px 22px;}}
#ai-dokumentooborot-boris-block .ado-b-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0ea5e9;margin:0 0 12px;}
#ai-dokumentooborot-boris-block .ado-b-ey::before{content:'';width:18px;height:2px;background:#0ea5e9;border-radius:1px;}
#ai-dokumentooborot-boris-block .ado-b-h3{font-size:clamp(19px,2.2vw,25px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 16px;}
#ai-dokumentooborot-boris-block .ado-b-ul{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px;}
#ai-dokumentooborot-boris-block .ado-b-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-dokumentooborot-boris-block .ado-b-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(14,165,233,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0284c7;font-style:normal;}
#ai-dokumentooborot-boris-block .ado-b-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;}
#ai-dokumentooborot-boris-block .ado-b-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;}
#ai-dokumentooborot-boris-block .ado-b-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-dokumentooborot-boris-block .ado-b-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-dokumentooborot-boris-block .ado-b-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-dokumentooborot-boris-block .ado-b-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-dokumentooborot-boris-block .ado-b-rgt{position:relative;background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 40%,#f5f3ff 100%);min-height:420px;overflow:hidden;}
@media(max-width:1023px){#ai-dokumentooborot-boris-block .ado-b-rgt{min-height:360px;}}
#ado-doc-agent-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="ado-content">

  <!-- INTRO -->
  <section class="ado-intro" id="intro" aria-label="Введение">
    <div class="ado-cnt">
      <div class="ado-intro-grid nero-ai-reveal">
        <div class="ado-intro-text">
          <p class="ado-eyebrow">Лонгрид · ai документооборот</p>
          <p>Документы обрабатываются вручную. Согласования затягиваются на дни и недели. Ошибка в реквизитах или сумме обходится в штрафы, пересогласования и репутационные потери. <strong>AI для документооборота</strong> — это не замена вашей СЭД и не «чат-бот для PDF», а интеллектуальный слой поверх существующих систем: почты, ECM, CRM и учёта. Nero Network внедряет <strong>ai документооборот под ключ</strong> — от распознавания и извлечения полей до маршрутизации согласований и поиска по корпоративному архиву.</p>
          <p><strong>Коротко:</strong> мы автоматизируем обработку, поиск, резюмирование и маршрутизацию документов в юридических, финансовых и административных отделах — без навязывания новой СЭД и с соблюдением 152-ФЗ.</p>
        </div>
        <div class="ado-intro-kpi" aria-label="Ключевые метрики документооборота">
          <div class="ado-kpi-card"><div class="kv">67%</div><div class="kl">enterprise оценивают agentic IDP</div><div class="ks">Paperwise / Gartner 2025</div></div>
          <div class="ado-kpi-card"><div class="kv">×7</div><div class="kl">ускорение первички</div><div class="ks">Systeme Electric</div></div>
          <div class="ado-kpi-card"><div class="kv">97%</div><div class="kl">документов — полная автоматизация</div><div class="ks">MADP, arXiv 2026</div></div>
          <div class="ado-kpi-card"><div class="kv">12%</div><div class="kl">HITL — норма пилота</div><div class="ks">human-in-the-loop</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="ado-cnt">
    <p class="nero-ai-reveal" style="margin:0 0 8px;font-size:15px">Входящие документы часто попадают в контур через почту и CRM ещё до OCR и согласований — если важен именно этот канал, отдельно разобран сценарий <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--ado-accent);text-decoration:underline;text-underline-offset:3px">AI-обработки входящей почты в CRM</a>: triage писем, извлечение вложений и маршрутизация в amoCRM или Битрикс24 без ручного переноса.</p>
  </div>

  <!-- CTA 1 -->
  <div class="ado-cnt">
    <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-intro">
      <div class="ym-cta-block__icon" aria-hidden="true">📄</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте, где теряются часы вашей команды</p>
        <p class="ym-cta-block__sub">Бесплатный аудит документооборота: разберём 50–100 реальных документов, покажем узкие места и ориентир ROI — без обязательства на внедрение.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Автоматизировать документы</a>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Заказать аудит документооборота</a>
        </div>
      </div>
    </div>
  </div>

  <!-- TOC -->
  <div class="ado-toc-outer">
    <div class="ado-cnt">
      <nav class="ado-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai-2026">Зачем AI</a>
        <a href="#zadachi-ai">Задачи</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#keisy-roi">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Автоматизировать</a>
      </nav>
    </div>
  </div>

  <!-- H2: Зачем AI -->
  <section class="ado-section" id="zachem-ai-2026">
    <div class="ado-cnt">
      <div class="ado-sh ado-left nero-ai-reveal">
        <span class="ado-eyebrow">Зачем бизнесу</span>
        <h2>Зачем бизнесу AI в документообороте в 2026 году</h2>
        <p><strong>Определение:</strong> AI для документооборота — слой интеллектуальной автоматизации поверх СЭД, ECM, почты и CRM. Типовой стек: OCR → классификация → извлечение полей → валидация → маршрутизация → RAG-поиск → генеративные функции.</p>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;font-size:15px">В 2026 году рынок сместился от «OCR из коробки» к <strong>agentic IDP</strong> — мультиагентным пайплайнам с human-in-the-loop. По обзору Paperwise, <strong>67% enterprise-инициатив</strong> оценивают agentic AI-подходы — два года назад это было 23% (<a href="https://www.paperwise.com/how-ai-is-changing-document-management-in-2026/" target="_blank" rel="noopener noreferrer" style="color:var(--ado-accent)">paperwise.com</a>).</p>
      <p class="nero-ai-reveal">Исследование ~5,5 млн сессий Microsoft 365 Copilot Chat (<a href="https://arxiv.org/abs/2605.23958" target="_blank" rel="noopener noreferrer" style="color:var(--ado-accent)">arXiv 2605.23958</a>) подтверждает: AI в enterprise используется для анализа, принятия решений и контентной работы с документами.</p>

      <div class="ado-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="ado-card" id="ruchnaya-obrabotka">
          <h3>Ручная обработка и затянутые согласования</h3>
          <p>Типичная картина: входящий договор → ручная регистрация → юрист ищет шаблон → согласующие теряют статус → документ «зависает» на неделю. Кейс «Дороги и Мосты»: за 1,5 месяца ОПЭ — <strong>23,5 тыс. документов</strong>, экономия <strong>~28 тыс. листов/мес</strong> (<a href="https://www.directum.ru/blog-post/kompanija_dorogi_i_mosty_uskorila_dokumentooborot_s_pomoshhju_ii-servisov_directum_rx" target="_blank" rel="noopener noreferrer" style="color:var(--ado-accent)">directum.ru</a>).</p>
        </div>
        <div class="ado-card" id="stoimost-oshibok">
          <h3>Стоимость ошибок в юридических и финансовых документах</h3>
          <p>Ошибка в ИНН, сумме или сроке — пересогласование, штраф, претензии регулятора. С 01.07.2025 — запрет хранения ПДн за рубежом; штрафы до 15–20 млн ₽ (<a href="https://buro152.ru/knowledge/blog/izmeneniya-152-fz-2025-2026/" target="_blank" rel="noopener noreferrer" style="color:var(--ado-accent)">152-ФЗ</a>). AI снижает ошибки через валидацию кода и HITL.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2: Задачи AI -->
  <section class="ado-section ado-section-alt" id="zadachi-ai">
    <div class="ado-cnt">
      <div class="ado-sh nero-ai-reveal">
        <span class="ado-eyebrow">Задачи AI</span>
        <h2>Какие задачи решает AI для документооборота</h2>
        <p><strong>Коротко:</strong> шесть функций — распознать → классифицировать → извлечь → проверить → маршрутизировать → найти в архиве.</p>
      </div>

      <div class="ado-table-wrap nero-ai-reveal" style="margin-bottom:32px">
        <table class="ado-table" aria-label="Задачи AI документооборота">
          <thead><tr><th>Задача</th><th>Что делает AI</th><th>Типичный результат</th></tr></thead>
          <tbody>
            <tr><td>OCR и распознавание</td><td>Сканы → текст, определение формата</td><td>Минуты вместо часов</td></tr>
            <tr><td>Классификация</td><td>Договор, счёт, акт, записка, письмо</td><td>Авторегистрация и приоритет</td></tr>
            <tr><td>Извлечение полей (IDP)</td><td>ИНН, суммы, даты, стороны → JSON</td><td>70–90% без ручного ввода</td></tr>
            <tr><td>Валидация</td><td>Сверка с шаблонами и учётными системами</td><td>Меньше дорогих ошибок</td></tr>
            <tr><td>Маршрутизация</td><td>Автомаршрут, напоминания, резолюция</td><td>Ускорение в 3–7 раз</td></tr>
            <tr><td>RAG-поиск и GenAI</td><td>Поиск по смыслу, резюме, проверка норм</td><td>Секунды вместо «полчаса в папках»</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ado-grid-2 nero-ai-reveal">
        <div class="ado-card" id="ocr-klassifikaciya">
          <h3>OCR, классификация и извлечение полей</h3>
          <p>Intake: почта, Telegram, веб-форма, SharePoint, API СЭД. OCR для сканов. LLM с JSON-схемой и <strong>confidence score</strong>. MADP: на 955 документах <strong>97% автоматизированы</strong>, 3% — fallback (<a href="https://arxiv.org/html/2605.17159v1" target="_blank" rel="noopener noreferrer" style="color:var(--ado-accent)">arXiv</a>).</p>
        </div>
        <div class="ado-card" id="rag-poisk">
          <h3>Поиск и резюмирование по корпоративному архиву (RAG)</h3>
          <p>Индексация регламентов и договоров в Qdrant/pgvector. Вопрос на естественном языке → ответ с источниками. ВЭБ.РФ + Т1: проверка договора <strong>с 10 мин/лист до 15 сек</strong>, точность <strong>&gt;97%</strong>.</p>
        </div>
        <div class="ado-card" id="marshrutizaciya">
          <h3>Маршрутизация и согласование документов</h3>
          <p>При confidence ≥90% — автомаршрут; 70–90% — HITL-очередь; ниже — отклонение. Systeme Electric: письма <strong>×5</strong>, договоры <strong>×3,5</strong>, первичка <strong>×7,5</strong>.</p>
        </div>
        <div class="ado-card" id="ai-agenty">
          <h3>AI-агенты в цепочке документооборота</h3>
          <p>Цепочка специализированных агентов: OCR → классификация → извлечение → валидация → индексация (<a href="https://aws.amazon.com/blogs/publicsector/how-leidos-enhanced-intelligent-document-processing-using-agentic-ai-on-aws/" target="_blank" rel="noopener noreferrer" style="color:var(--ado-accent)">Leidos / AWS</a>). Три уровня: (1) OCR+поля, (2) workflow, (3) RAG+GenAI.</p>
        </div>
      </div>
    </div>

    <!-- БОРИС: agentic IDP canvas -->
    <section id="ai-dokumentooborot-boris-block" class="ado-b-root" aria-label="Анимация: agentic IDP — цепочка агентов и HITL-маршрутизация документов">
      <div class="ado-b-cnt">
        <div class="ado-b-card">
          <div class="ado-b-lft">
            <span class="ado-b-ey">Agentic IDP · глава 2</span>
            <h3 class="ado-b-h3">Пять агентов обрабатывают документ — человек подключается только при низком confidence</h3>
            <ul class="ado-b-ul">
              <li><span class="ado-b-ic">C</span><strong>Classifier</strong> — тип документа и приоритет маршрута</li>
              <li><span class="ado-b-ic">E</span><strong>Extractor</strong> — ИНН, суммы, даты, стороны в JSON</li>
              <li><span class="ado-b-ic">V</span><strong>Validator</strong> — сверка с регламентом и учётными системами</li>
              <li><span class="ado-b-ic">R</span><strong>Router</strong> — юротдел, финансы или админ по правилам</li>
              <li><span class="ado-b-ic">H</span><strong>HITL</strong> — очередь ручной проверки при confidence 70–90%</li>
            </ul>
            <div class="ado-b-pills">
              <span class="ado-b-pl ado-b-pl-g">97% auto</span>
              <span class="ado-b-pl ado-b-pl-b">×7 первичка</span>
              <span class="ado-b-pl ado-b-pl-v">12% HITL</span>
            </div>
            <p class="ado-b-foot">Дальше — сравним подходы и разберём, кому подходит внедрение →</p>
          </div>
          <div class="ado-b-rgt">
            <canvas id="ado-doc-agent-canvas" role="img" aria-label="Анимация: документ проходит цепочку AI-агентов Classifier, Extractor, Validator, Router и попадает в HITL или автомаршрут"></canvas>
          </div>
        </div>
      </div>
      <script>
      (function(){
        'use strict';
        var cv=document.getElementById('ado-doc-agent-canvas');
        if(!cv)return;
        var ctx=cv.getContext('2d'),W=0,H=0,frame=0;
        function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||460;W=cv.width;H=cv.height;}
        window.addEventListener('resize',resize);resize();
        var C={ink:'#0f172a',muted:'#64748b',doc:'#fff',docBdr:'#cbd5e1',cls:'#8b5cf6',ext:'#0ea5e9',val:'#22c55e',rtr:'#f59e0b',hitl:'#ef4444',lane:'rgba(14,165,233,.12)',line:'rgba(139,92,246,.35)'};
        var AGENTS=[{k:'C',label:'Classifier',color:C.cls,x:0},{k:'E',label:'Extractor',color:C.ext,x:0},{k:'V',label:'Validator',color:C.val,x:0},{k:'R',label:'Router',color:C.rtr,x:0}];
        var LANES=[{l:'Юротдел',c:'#3b82f6'},{l:'Финансы',c:'#22c55e'},{l:'Админ',c:'#8b5cf6'}];
        var docs=[],fields=[],hitlQ=[];
        function rr(x,y,w,h,r,fill,stroke){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(fill){ctx.fillStyle=fill;ctx.fill();}if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=1.5;ctx.stroke();}}
        function drawAgent(ax,ay,aw,ah,a,pulse){
          var lit=pulse>0.3;
          rr(ax,ay,aw,ah,10,lit?a.color+'22':'rgba(255,255,255,.7)',a.color);
          ctx.fillStyle=a.color;ctx.font='bold 13px Inter,sans-serif';ctx.textAlign='center';
          ctx.fillText(a.k,ax+aw/2,ay+22);
          ctx.fillStyle=C.ink;ctx.font='9px Inter,sans-serif';
          ctx.fillText(a.label,ax+aw/2,ay+ah-10);
          if(lit){ctx.strokeStyle=a.color;ctx.lineWidth=2;ctx.globalAlpha=0.4+0.6*Math.sin(frame*0.08);ctx.strokeRect(ax-2,ay-2,aw+4,ah+4);ctx.globalAlpha=1;}
        }
        function drawDoc(x,y,s,alpha){ctx.globalAlpha=alpha||1;rr(x,y,s,s*1.25,4,C.doc,C.docBdr);ctx.fillStyle=C.ink;ctx.font='bold 9px sans-serif';ctx.textAlign='center';ctx.fillText('PDF',x+s/2,y+s*0.55);ctx.globalAlpha=1;}
        function spawnDoc(){docs.push({t:0,x:20,y:H*0.42+Math.random()*30,speed:0.8+Math.random()*0.3,hitl:Math.random()<0.12});}
        if(!docs.length)spawnDoc();
        function loop(){
          frame++;ctx.clearRect(0,0,W,H);
          var pad=16,aw=Math.min(72,W*0.11),ah=56,gap=(W-pad*2-aw*4)/3;
          AGENTS.forEach(function(a,i){a.x=pad+i*(aw+gap);});
          var ay=H*0.28;
          AGENTS.forEach(function(a,i){
            var prog=((frame+i*40)%320)/320;
            drawAgent(a.x,ay,aw,ah,a,prog>0.2&&prog<0.85?prog:0);
            if(i<3){ctx.strokeStyle=C.line;ctx.setLineDash([4,4]);ctx.beginPath();ctx.moveTo(a.x+aw,ay+ah/2);ctx.lineTo(AGENTS[i+1].x,ay+ah/2);ctx.stroke();ctx.setLineDash([]);}
          });
          if(frame%90===0)spawnDoc();
          docs=docs.filter(function(d){
            d.t+=d.speed;d.x+=d.speed*1.8;
            var stage=Math.floor(d.t/70)%5;
            drawDoc(d.x,d.y,32,Math.max(0,1-d.t/400));
            if(stage===1){ctx.fillStyle=C.cls;ctx.font='9px sans-serif';ctx.fillText('договор',d.x,d.y-6);}
            if(stage===2){fields.push({x:d.x+40,y:d.y,l:'ИНН',t:0});}
            if(stage===4&&!d.routed){
              d.routed=1;
              if(d.hitl)hitlQ.push({y:H*0.72+hitlQ.length*22,t:0});
              else LANES[Math.floor(Math.random()*3)].count=(LANES[Math.floor(Math.random()*3)].count||0)+1;
            }
            return d.t<400;
          });
          fields=fields.filter(function(f){f.t++;ctx.globalAlpha=Math.max(0,1-f.t/60);rr(f.x,f.y,36,18,6,C.ext+'22',C.ext);ctx.fillStyle=C.ink;ctx.font='8px sans-serif';ctx.fillText(f.l,f.x+18,f.y+12);ctx.globalAlpha=1;return f.t<60;});
          var lx=pad,ly=H*0.68,lw=(W-pad*2)/3-8;
          LANES.forEach(function(ln,i){
            var lx2=lx+i*(lw+8);
            rr(lx2,ly,lw,48,8,C.lane,ln.c);
            ctx.fillStyle=ln.c;ctx.font='bold 10px sans-serif';ctx.textAlign='center';
            ctx.fillText(ln.l,lx2+lw/2,ly+20);
            ctx.fillStyle=C.muted;ctx.font='9px sans-serif';
            ctx.fillText((ln.count||0)+' авто',lx2+lw/2,ly+38);
          });
          rr(W*0.72,H*0.68,W*0.24,56,8,'rgba(239,68,68,.08)',C.hitl);
          ctx.fillStyle=C.hitl;ctx.font='bold 10px sans-serif';ctx.textAlign='center';
          ctx.fillText('HITL · '+hitlQ.length,W*0.84,H*0.7+14);
          ctx.fillStyle=C.muted;ctx.font='9px sans-serif';ctx.fillText('confidence 70–90%',W*0.84,H*0.7+30);
          if(hitlQ.length>5)hitlQ=hitlQ.slice(-5);
          requestAnimationFrame(loop);
        }
        loop();
      })();
      </script>
    </section>

    <div class="ado-cnt">
      <div class="ado-card nero-ai-reveal" id="sravnenie-podhodov" style="margin-top:8px">
        <h3>Сравнение подходов: что выбрать</h3>
        <div class="ado-table-wrap" style="margin-top:16px">
          <table class="ado-table" aria-label="Сравнение подходов AI документооборота">
            <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th><th>Кому подходит</th></tr></thead>
            <tbody>
              <tr><td>Готовая СЭД с ИИ</td><td>Единая платформа, поддержка</td><td>Дорого, долгая миграция</td><td>Крупные с заменой с нуля</td></tr>
              <tr><td>AI-слой на n8n/Make</td><td>Гибкость, быстрый пилот</td><td>Нужен интегратор</td><td>Средний бизнес с СЭД/CRM</td></tr>
              <tr><td>Только RAG-чат</td><td>Старт 1–2 недели</td><td>Не закрывает OCR и согласования</td><td>Узкая задача поиска</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:14px"><strong>Угол Nero Network:</strong> AI-модули поверх существующего контура через REST API — не тяжёлая СЭД. Отстройка от <code>ai-1c-erp</code>: здесь весь документооборот, там — учёт в 1С.</p>
      </div>
    </div>
  </section>

  <!-- CTA 2 -->
  <div class="ado-cnt">
    <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-zadachi">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Какой уровень автоматизации нужен вашему отделу?</p>
        <p class="ym-cta-block__sub">На аудите определим приоритетный сценарий и посчитаем окупаемость под ваш объём документов.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Заказать консультацию по ai документооборот</a>
      </div>
    </div>
  </div>

  <!-- H2: Для кого -->
  <section class="ado-section" id="dlya-kogo">
    <div class="ado-cnt">
      <div class="ado-sh nero-ai-reveal">
        <span class="ado-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит внедрение AI документооборота</h2>
        <p>Критерий — объём документопотока и стоимость ручной обработки, не только размер компании.</p>
      </div>
      <div class="ado-grid-2 nero-ai-reveal">
        <div class="ado-card" id="yuridicheskie"><h3>Юридические отделы</h3><p>Входящие договоры, претензии, корреспонденция. AI классифицирует, извлекает условия, сверяет с шаблонами, предлагает маршрут. GenAI проверяет соответствие регламентам.</p></div>
        <div class="ado-card" id="finansovye"><h3>Финансовые службы</h3><p>Первичка, счета, акты. Извлечение ИНН, сумм, НДС; сверка с 1С; детекция дубликатов и аномалий.</p></div>
        <div class="ado-card" id="administrativnye"><h3>Административные и операционные отделы</h3><p>Служебные записки, входящая/исходящая корреспонденция, поручения. Авторегистрация и напоминания — кейс «Дороги и Мосты».</p></div>
        <div class="ado-card" id="msb"><h3>Малый и средний бизнес</h3><p>Пилот от <strong>300 тыс. ₽</strong> на одном сценарии. Полный контур 6–12 недель, бюджет <strong>500 тыс.–2 млн ₽</strong>. Усиление существующего контура ИИ-модулями без покупки СЭД с нуля.</p></div>
      </div>
    </div>
  </section>

  <!-- H2: Внедрение -->
  <section class="ado-section ado-section-alt" id="vnedrenie">
    <div class="ado-cnt">
      <div class="ado-sh nero-ai-reveal">
        <span class="ado-eyebrow">Под ключ</span>
        <h2>Как мы внедряем AI для документооборота под ключ</h2>
        <p>Срок полного контура: <strong>6–12 недель</strong>. MVP intake→OCR→LLM→export — <strong>1–2 недели</strong> на n8n.</p>
      </div>
      <div class="ado-timeline nero-ai-reveal">
        <div class="ado-tl-item" id="audit"><h3>Аудит документооборота (лид-магнит)</h3><p><strong>1–2 недели.</strong> Разбор 50–100 документов. Карта узких мест, приоритет сценариев, ориентир ROI — без обязательства на внедрение.</p></div>
        <div class="ado-tl-item" id="pilot"><h3>Пилот на типовых документах</h3><p><strong>4–8 недель.</strong> Один сценарий, ~30% потока. KPI: % auto, время цикла, точность по полям.</p></div>
        <div class="ado-tl-item" id="integraciya-processy"><h3>Интеграция в рабочие процессы</h3><p>CRM, СЭД, 1С, почта, Telegram HITL. Продакшен с SLA и журналом действий AI.</p></div>
        <div class="ado-tl-item" id="obuchenie"><h3>Обучение команды и сопровождение</h3><p>Обучение юристов, бухгалтеров, администраторов. Low-code для доработок. Мониторинг метрик и калибровка моделей.</p></div>
      </div>
      <div class="ado-flow nero-ai-reveal" style="margin-top:28px" aria-label="7 шагов системы">
        <span>Intake</span><span class="arr">→</span><span>OCR</span><span class="arr">→</span><span>AI extraction</span><span class="arr">→</span><span>Validation</span><span class="arr">→</span><span>Routing</span><span class="arr">→</span><span>RAG</span><span class="arr">→</span><span>Audit</span>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie" style="margin-top:28px">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации документов сами?</p>
          <p class="ym-cta-block__sub">Если команда хочет понимать n8n, OCR, human-in-the-loop и RAG до старта проекта — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование пилота с юротделом и финансами.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- H2: Интеграции -->
  <section class="ado-section" id="integracii">
    <div class="ado-cnt">
      <div class="ado-sh nero-ai-reveal">
        <span class="ado-eyebrow">Интеграции</span>
        <h2>Интеграции: ECM, CRM, почта и электронная подпись</h2>
        <p>Через REST API и low-code. Без замены инфраструктуры.</p>
      </div>
      <div class="ado-grid-3 nero-ai-reveal">
        <div class="ado-card" id="ecm-dms"><h3>ECM/DMS и корпоративные хранилища</h3><p>Directum, 1С:Документооборот, ELMA365, Битрикс24 Диск — обмен карточками и статусами. AI ускоряет работу с существующими документами.</p></div>
        <div class="ado-card" id="crm"><h3>CRM и сервисные заявки</h3><p>amoCRM, Битрикс24 — карточки контрагентов, задачи согласования. Фокус на документообороте, не на учётных проводках (см. ai-1c-erp).</p></div>
        <div class="ado-card ado-warn" id="bezopasnost-152"><h3>Безопасность: 152-ФЗ, хранение, аудит доступа</h3><p>ПДн — только в закрытом контуре (YandexGPT, GigaChat, self-hosted). Обезличивание. Запрет публичных API для документов с ФИО и ИНН. ЭП: Контур, СБИС, Такском.</p></div>
      </div>
    </div>
  </section>

  <!-- H2: Стоимость -->
  <section class="ado-section ado-section-alt" id="stoimost">
    <div class="ado-cnt">
      <div class="ado-sh nero-ai-reveal">
        <span class="ado-eyebrow">Цена</span>
        <h2>Стоимость внедрения AI документооборота</h2>
        <p>Ориентир: <strong>300 тыс.–2 млн ₽</strong> в зависимости от глубины, объёма и интеграций.</p>
      </div>
      <div class="ado-card nero-ai-reveal" id="faktory-ceny">
        <h3>От чего зависит чек (300 тыс.–2 млн ₽)</h3>
        <div class="ado-table-wrap" style="margin-top:14px">
          <table class="ado-table" aria-label="Факторы цены">
            <thead><tr><th>Фактор</th><th>Влияние</th></tr></thead>
            <tbody>
              <tr><td>Типы документов</td><td>+50–200 эталонов на тип</td></tr>
              <tr><td>Объём потока</td><td>OCR, HITL, инфраструктура</td></tr>
              <tr><td>Интеграции</td><td>Каждая связка — отдельный этап</td></tr>
              <tr><td>On-premise</td><td>Обязателен для юр/фин с ПДн</td></tr>
              <tr><td>Уровень 1–3</td><td>OCR дешевле; RAG+workflow дороже</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="ado-card nero-ai-reveal" id="pod-klyuch-ili-samostoyatelno" style="margin-top:20px">
        <h3>Под ключ или поэтапно</h3>
        <div class="ado-table-wrap" style="margin-top:14px">
          <table class="ado-table" aria-label="Варианты внедрения">
            <thead><tr><th>Вариант</th><th>Когда</th><th>Бюджет</th></tr></thead>
            <tbody>
              <tr><td>Под ключ</td><td>Нет команды ИИ, результат за 6–12 нед.</td><td>300 тыс.–2 млн ₽</td></tr>
              <tr><td>Пилот + масштабирование</td><td>Есть low-code аналитик</td><td>Пилот от 300 тыс. ₽</td></tr>
              <tr><td>Только аудит</td><td>ROI до решения</td><td>Бесплатно / консультация</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:16px"><strong>Формула ROI:</strong> <code>документов/мес × минуты × (ставка ₽/час / 60)</code>. Пример: 800 × 12 × (1500/60) = <strong class="ado-metric-green">240 000 ₽/мес</strong>.</p>
      </div>
    </div>
  </section>

  <div class="ado-cnt">
    <p class="nero-ai-reveal" style="margin-bottom:16px;font-size:15px">Документооборот редко живёт изолированно: согласования часто уходят в CRM, а первичка и проводки — в учётную систему. Для задач на стороне сделок и заявок см. <a href="/vnedrenie-ai-amocrm/" style="color:var(--ado-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a>.</p>
    <p class="nero-ai-reveal" style="margin-bottom:28px;font-size:15px">Если фокус смещён с маршрутов согласования на бухучёт и синхронизацию с 1С — это другой контур: <a href="/ai-1c-erp/" style="color:var(--ado-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP</a> закрывает извлечение полей из счетов и УПД, а не юридические маршруты.</p>
  </div>

  <!-- H2: Кейсы -->
  <section class="ado-section" id="keisy-roi">
    <div class="ado-cnt">
      <div class="ado-sh nero-ai-reveal">
        <span class="ado-eyebrow">Кейсы</span>
        <h2>Кейсы и ориентиры ROI</h2>
        <p>Публичные результаты с измеримыми цифрами.</p>
      </div>
      <div class="ado-card nero-ai-reveal" id="sokrashchenie-soglasovaniya">
        <h3>Сокращение времени согласования</h3>
        <div class="ado-table-wrap" style="margin-top:12px">
          <table class="ado-table" aria-label="Кейсы согласования">
            <thead><tr><th>Компания</th><th>Результат</th></tr></thead>
            <tbody>
              <tr><td>Systeme Electric</td><td class="ado-metric-green">Письма ×5, договоры ×3,5, первичка ×7,5</td></tr>
              <tr><td>ВЭБ.РФ + Т1</td><td class="ado-metric-green">10 мин/лист → 15 сек</td></tr>
              <tr><td>«Дороги и Мосты»</td><td class="ado-metric-green">23,5 тыс. док. за 1,5 мес.</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="ado-card nero-ai-reveal" id="snizhenie-ruchnogo-vvoda" style="margin-top:20px">
        <h3>Снижение доли ручного ввода и ошибок</h3>
        <div class="ado-table-wrap" style="margin-top:12px">
          <table class="ado-table" aria-label="Кейсы автоматизации">
            <thead><tr><th>Компания</th><th>Результат</th></tr></thead>
            <tbody>
              <tr><td>MADP</td><td class="ado-metric-green">97% полная автоматизация</td></tr>
              <tr><td>«Дороги и Мосты»</td><td class="ado-metric-green">OCR 80%, ~28 тыс. листов/мес</td></tr>
              <tr><td>«Подружки»</td><td class="ado-metric-green">Окупаемость 8 мес., 1,5 млн ₽/год</td></tr>
            </tbody>
          </table>
        </div>
        <p style="margin-top:14px"><strong>HITL — не баг, а фича:</strong> 10–15% документов на ручную проверку. Финальное подписание, нестандартные договоры и confidence &lt;85–90% — всегда за человеком.</p>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="ado-section ado-section-alt" id="faq">
    <div class="ado-cnt">
      <div class="ado-sh nero-ai-reveal">
        <span class="ado-eyebrow">FAQ</span>
        <h2>FAQ по AI документообороту</h2>
      </div>
      <div class="nero-ai-reveal">
        <div class="ado-faq-item"><h3>Как внедрить ai документооборот?</h3><p>Аудит (1–2 нед.) → пилот 30% потока (4–8 нед.) → продакшен (6–12 нед.). Nero Network ведёт внедрение под ключ.</p></div>
        <div class="ado-faq-item"><h3>Сколько стоит ai документооборот?</h3><p>Ориентир <strong>300 тыс.–2 млн ₽</strong>. Точная смета после аудита. Пилот — от 300 тыс. ₽.</p></div>
        <div class="ado-faq-item"><h3>Нужен ли программист?</h3><p>Для внедрения под ключ — нет. Для доработок — достаточно low-code; обучаем команду.</p></div>
        <div class="ado-faq-item"><h3>Какие системы интегрируются?</h3><p>CRM, СЭД/ECM, 1С, почта, Telegram, ЭП, YandexGPT/GigaChat/self-hosted.</p></div>
        <div class="ado-faq-item"><h3>Чем отличается от готового SaaS?</h3><p>AI-слой под ваши типы документов и регламенты — не замена СЭД, а усиление.</p></div>
        <div class="ado-faq-item"><h3>Сколько останется ручной работы?</h3><p>70–90% без ручного ввода; 10–15% HITL. Сложные сканы и нестандартные договоры — на человеке.</p></div>
        <div class="ado-faq-item"><h3>Как считать ROI?</h3><p><code>документов/мес × минуты × (ставка/60)</code> + стоимость ошибок. Считаем на аудите.</p></div>
        <div class="ado-faq-item"><h3>Безопасно ли для персональных данных?</h3><p>Да при закрытом контуре: российские модели, обезличивание, без публичных API.</p></div>
      </div>
    </div>
  </section>

  <!-- Финальный CTA -->
  <section class="ado-section" id="cta">
    <div class="ado-cnt">
      <div class="ado-sh nero-ai-reveal">
        <h2>Автоматизировать документы — заказать внедрение</h2>
        <p><strong>AI документооборот заказать</strong> у Nero Network — измеримый результат: аудит, пилот с KPI, интеграции, HITL-панель, 152-ФЗ, обучение.</p>
      </div>
      <ul class="nero-ai-reveal" style="max-width:640px;margin:0 auto 28px">
        <li>Аудит и карта узких мест</li>
        <li>Пилот на реальных документах (% auto, время цикла)</li>
        <li>Интеграция CRM, СЭД, 1С, почты</li>
        <li>Закрытый контур и соответствие 152-ФЗ</li>
      </ul>
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Автоматизировать документы</p>
          <p class="ym-cta-block__sub">Внедрим AI для обработки, поиска, резюмирования и маршрутизации документов — юротдел, финансы и администрация перестают терять время на ручные согласования и дорогие ошибки. Внедрение ai документооборот под ключ от 300 тыс. ₽ · Пилот 4–8 недель · Окупаемость от 8 месяцев.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Автоматизировать документы</a>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Заказать аудит документооборота</a>
          </div>
        </div>
      </div>
      <p class="nero-ai-reveal" style="text-align:center;margin-top:28px;font-size:15px;color:var(--ado-soft)"><strong>Итог:</strong> AI для документооборота в 2026 — agentic IDP с human-in-the-loop, интеграцией в существующие системы и честными метриками. Nero Network внедряет <strong>ai решения для документов</strong> без замены вашей СЭД.</p>
    </div>
  </section>

</div><!-- /.ado-content -->

<?php
$ado_page_url = trailingslashit( get_permalink() );
$ado_site_url = trailingslashit( home_url( '/' ) );
$ado_brand    = get_bloginfo( 'name' ) ?: 'Nero Network'; // pragma: allowlist secret
$ado_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $ado_site_url . '#organization',
      'name'  => $ado_brand,
      'url'   => $ado_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $ado_site_url . '#website',
      'url'       => $ado_site_url,
      'name'      => $ado_brand,
      'publisher' => [ '@id' => $ado_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $ado_page_url . '#webpage',
      'url'         => $ado_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $ado_site_url . '#website' ],
      'about'       => [ '@id' => $ado_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $ado_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $ado_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $ado_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $ado_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $ado_page_url,
      'provider'    => [ '@id' => $ado_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $ado_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai документооборот?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит (1–2 нед.) → пилот 30% потока (4–8 нед.) → продакшен (6–12 нед.). Nero Network ведёт внедрение под ключ.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит ai документооборот?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир 300 тыс.–2 млн ₽. Точная смета после аудита. Пилот — от 300 тыс. ₽.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужен ли программист?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Для внедрения под ключ — нет. Для доработок — достаточно low-code; обучаем команду.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие системы интегрируются?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'CRM, СЭД/ECM, 1С, почта, Telegram, ЭП, YandexGPT/GigaChat/self-hosted.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем отличается от готового SaaS?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'AI-слой под ваши типы документов и регламенты — не замена СЭД, а усиление.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько останется ручной работы?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '70–90% без ручного ввода; 10–15% HITL. Сложные сканы и нестандартные договоры — на человеке.' ] ],
        [ '@type' => 'Question', 'name' => 'Как считать ROI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'документов/мес × минуты × (ставка/60) + стоимость ошибок. Считаем на аудите.' ] ],
        [ '@type' => 'Question', 'name' => 'Безопасно ли для персональных данных?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да при закрытом контуре: российские модели, обезличивание, без публичных API.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $ado_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
/**
 * ado-hero-engine — «Диспетчерская маршрутизации документов»
 * Мир: intake-портал → OCR-узел → шлюз 152-ФЗ → хаб согласований → RAG-архив
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ado-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var bubbles = [];

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
    outline: "#94a3b8",
    docWhite: "#f8fafc",
    docBlue: "#dbeafe",
    docViolet: "#ede9fe",
    docAmber: "#fef3c7",
    lane: "rgba(71,85,105,0.45)",
    laneEdge: "#334155",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    amber: "#fbbf24",
    hubBase: "#0f172a",
    shield: "rgba(251,191,36,0.85)",
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

  function drawDoc(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    if (label) {
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 2);
    }
    ctx.strokeStyle = "rgba(148,163,184,0.45)";
    ctx.lineWidth = 0.7;
    for (var i = 0; i < 3; i++) {
      ctx.beginPath();
      ctx.moveTo(x - w / 2 + 3, y - h / 2 + 6 + i * 4);
      ctx.lineTo(x + w / 2 - 3, y - h / 2 + 6 + i * 4);
      ctx.stroke();
    }
  }

  /* Горизонтальная волновая лента пакетов — вместо Conveyor */
  function DocumentStreamRoller() {
    this.packets = [
      { t: 0, color: C.docAmber, label: "PDF" },
      { t: 0.35, color: C.docBlue, label: "ДГ" },
      { t: 0.68, color: C.docViolet, label: "АКТ" }
    ];
  }
  DocumentStreamRoller.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    ctx.strokeStyle = "rgba(121,242,255,0.25)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var i = -180; i <= 180; i += 4) {
      var waveY = Math.sin((i + frame * 0.6) * 0.04) * 6;
      if (i === -180) ctx.moveTo(i, 18 + waveY);
      else ctx.lineTo(i, 18 + waveY);
    }
    ctx.stroke();

    this.packets.forEach(function (p, idx) {
      var t = ((frame * 0.018 + p.t) % 1);
      var px = -170 + t * 340;
      var py = 18 + Math.sin((px + frame * 0.5) * 0.04) * 6 - 14;
      if (t > 0.05 && t < 0.92) drawDoc(ctx, px, py, 14, 18, p.color, p.label);
    });
  };

  /* Портал intake: почта / API / папка */
  function IntakePortal() {}
  IntakePortal.prototype.draw = function (ctx) {
    drawRR(ctx, -168, -52, 52, 64, 6, "rgba(15,23,42,0.75)", C.outline);
    drawRR(ctx, -160, -44, 36, 22, 4, "rgba(121,242,255,0.12)", C.cyan);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("IN", -142, -30);
    for (var i = 0; i < 3; i++) {
      drawDoc(ctx, -148 + i * 8, -8 + i * 3, 12, 15, C.docWhite, "");
    }
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Intake", -164, -58);
  };

  /* OCR-узел извлечения полей */
  function FieldExtractionPod() {
    this.beam = -20;
  }
  FieldExtractionPod.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    drawRR(ctx, -58, -48, 56, 72, 8, "rgba(139,92,246,0.12)", C.violet);
    ctx.fillStyle = C.violet;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("OCR", -30, -38);

    if (prg >= 55 && prg < 125) {
      var scan = (prg - 55) / 70;
      this.beam = -48 + scan * 96;
      ctx.save();
      ctx.globalAlpha = 0.4 + Math.sin(frame * 0.1) * 0.15;
      ctx.fillStyle = "rgba(121,242,255,0.45)";
      ctx.fillRect(this.beam - 2, -42, 4, 58);
      ctx.restore();
      var fields = ["ИНН", "Сумма", "Срок"];
      fields.forEach(function (f, i) {
        var pop = Math.min(1, (prg - 70 - i * 10) / 14);
        if (pop > 0) {
          drawRR(ctx, -52 + (i % 2) * 28, -18 + Math.floor(i / 2) * 16, 24, 10, 3, "rgba(34,197,94,0.35)", C.green);
          ctx.fillStyle = "#ecfdf5";
          ctx.font = "bold 5px Inter,sans-serif";
          ctx.textAlign = "center";
          ctx.globalAlpha = pop;
          ctx.fillText(f, -40 + (i % 2) * 28, -10 + Math.floor(i / 2) * 16);
          ctx.globalAlpha = 1;
        }
      });
    }
  };

  /* Шлюз 152-ФЗ */
  function ComplianceGate152() {}
  ComplianceGate152.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    drawRR(ctx, 8, -50, 44, 76, 8, "rgba(251,191,36,0.08)", C.amber);
    ctx.fillStyle = C.amber;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("152", 30, -38);
    ctx.fillText("ФЗ", 30, -28);
    if (prg >= 120 && prg < 175) {
      var ok = prg > 145;
      ctx.strokeStyle = ok ? C.green : C.amber;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(30, -8, 14, 0, Math.PI * 2);
      ctx.stroke();
      if (ok) {
        ctx.strokeStyle = C.green;
        ctx.beginPath();
        ctx.moveTo(24, -8);
        ctx.lineTo(28, -4);
        ctx.lineTo(36, -12);
        ctx.stroke();
      }
    }
  };

  /* Центральный хаб маршрутизации — вместо WebsiteTerminal */
  function ApprovalRoutingHub() {
    this.activeRoute = 0;
  }
  ApprovalRoutingHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    drawRR(ctx, 62, -62, 108, 92, 10, C.hubBase, C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Маршрут", 72, -48);

    var routes = [
      { label: "Юр", color: C.violet, y: -32 },
      { label: "Фин", color: C.cyan, y: -12 },
      { label: "Адм", color: C.green, y: 8 }
    ];
    var active = prg < 100 ? 0 : prg < 180 ? 1 : 2;
    this.activeRoute = active;
    routes.forEach(function (r, i) {
      drawRR(ctx, 72, r.y, 84, 14, 4, i === active ? "rgba(255,255,255,0.12)" : "rgba(255,255,255,0.04)", C.outline);
      ctx.fillStyle = r.color;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(r.label, 78, r.y + 10);
      if (prg >= 175 && i === active) {
        ctx.fillStyle = C.green;
        ctx.fillText("✓", 148, r.y + 10);
      }
    });

    if (prg >= 195) {
      var stamp = Math.min(1, (prg - 195) / 16);
      ctx.save();
      ctx.translate(108, 22);
      ctx.rotate(-0.12 * stamp);
      ctx.globalAlpha = stamp;
      ctx.strokeStyle = "rgba(34,197,94,0.9)";
      ctx.lineWidth = 2;
      ctx.strokeRect(-30, -10, 60, 22);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("СОГЛАСОВАНО", 0, 4);
      ctx.restore();
    }
  };

  /* HITL-слот ручной проверки */
  function HitlReviewSlot() {}
  HitlReviewSlot.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 130 || prg > 200) return;
    drawRR(ctx, 54, 34, 36, 22, 5, "rgba(245,158,11,0.12)", C.amber);
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HITL 12%", 72, 48);
  };

  /* RAG-полка архива — финал цикла */
  function RagArchiveShelf() {
    this.glow = 0;
  }
  RagArchiveShelf.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    drawRR(ctx, 168, -40, 42, 58, 6, "rgba(15,23,42,0.7)", C.outline);
    for (var i = 0; i < 4; i++) {
      drawRR(ctx, 174, -32 + i * 12, 30, 8, 2, "rgba(121,242,255,0.15)", null);
    }
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("RAG", 189, -46);

    if (prg >= 220) {
      this.glow = Math.min(1, (prg - 220) / 30);
      ctx.save();
      ctx.globalAlpha = this.glow * 0.55;
      ctx.fillStyle = C.cyan;
      ctx.beginPath();
      ctx.arc(189, -8, 10 + this.glow * 6, 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
      if (prg >= 248) {
        var split = (prg - 248) / 32;
        ["Юр", "Фин", "Адм"].forEach(function (lbl, i) {
          var ang = -0.5 + i * 0.5;
          var dist = 20 + split * 18;
          var px = 189 + Math.cos(ang) * dist;
          var py = 10 + Math.sin(ang) * dist * 0.6;
          drawDoc(ctx, px, py, 10, 13, [C.docViolet, C.docBlue, C.docAmber][i], lbl);
        });
      }
    }
  };

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, max: life });
  }

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

    var hubs = {
      "1_architect": { x: -145, y: -18 },
      "2_seo": { x: -35, y: -22 },
      "3_coder": { x: 30, y: -20 },
      "4_designer": { x: 95, y: -18 },
      "5_deployer": { x: 175, y: -10 }
    };
    var tgt = hubs[this.role] || { x: 0, y: -15 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 16) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 16) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 16) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 200 === Math.floor(this.timer * 10) % 200 && Math.random() < 0.12) {
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
    ctx.scale(faceDir, 1);
    ctx.fillStyle = C.outline;
    ctx.fillRect(3, -24 - bob, 3, 3);
    ctx.fillRect(8, -24 - bob, 3, 3);
    ctx.restore();
  };

  var stream = new DocumentStreamRoller();
  var intake = new IntakePortal();
  var ocrPod = new FieldExtractionPod();
  var compliance = new ComplianceGate152();
  var hub = new ApprovalRoutingHub();
  var hitl = new HitlReviewSlot();
  var archive = new RagArchiveShelf();

  var agents = [
    new Agent(-155, 42, C.agentYellow, "1_architect", 18, ["Регистрирую PDF в intake", "Метаданные на месте", "Очередь документов OK"]),
    new Agent(-55, 48, C.agentGreen, "2_seo", 58, ["OCR: 11 полей извлечено", "Confidence 0.91 по сумме", "Договор — типовой шаблон"]),
    new Agent(5, 50, C.agentBlue, "3_coder", 98, ["JSON-схема валидна", "ИНН проверен кодом", "Маппинг в СЭД готов"]),
    new Agent(70, 48, C.agentPink, "4_designer", 138, ["152-ФЗ: обезличивание OK", "Спорный пункт — на HITL", "Юрист подтвердит маршрут"]),
    new Agent(155, 44, C.agentPurple, "5_deployer", 205, ["Архив проиндексирован", "RAG ответ за 2 сек", "Цикл согласования −4.2×"])
  ];

  if (frame === 60) createBubble(-30, -55, "Скан → OCR за 8 сек", 240);
  if (frame === 140) createBubble(30, -58, "152-ФЗ: ПДн в контуре", 240);
  if (frame === 200) createBubble(108, -65, "Маршрут: юр → фин", 240);
  if (frame === 255) createBubble(189, -50, "Согласовано → архив", 260);

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    intake.draw(ctx);
    stream.draw(ctx);
    ocrPod.draw(ctx);
    compliance.draw(ctx);
    hub.draw(ctx);
    hitl.draw(ctx);
    archive.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });

    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 40);
      ctx.globalAlpha = alpha;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 16;
      var bx = bub.x, by = bub.y - (bub.max - bub.life) * 0.15;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 6, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2 + 4);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  document.fonts.ready.then(function () { engineloop(); });
});
</script>

<script>
(function () {
  'use strict';
  var root = document.querySelector('.ai-dokumentooborot-page') || document.querySelector('.nero-ai-home-page');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function (item) { observer.observe(item); });
  } else {
    items.forEach(function (item) { item.classList.add('nero-ai-active'); });
  }
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
