<?php
/**
 * Template Name: AI-медиапланирование и подбор гипотез для рекламы
 * Description: SEO-лендинг — внедрение AI-медиаплана: гипотезы, аудитории, календарь тестов на 30 дней.
 */

$page_seo_title       = 'AI-медиаплан под ключ: гипотезы, аудитории и тесты на 30 дней';
$page_seo_description = 'Внедрение AI-медиаплана: нейросеть генерирует рекламные гипотезы, аудитории и офферы, календарь A/B-тестов на месяц. Интеграция с CRM и кабинетами. Чек 80–250 тыс. ₽. Собрать медиаплан.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение',    'href' => '#vnedrenie'],
    ['label' => 'Интеграции',  'href' => '#integracii'],
    ['label' => 'Кейсы',       'href' => '#keisy'],
    ['label' => 'Стоимость',   'href' => '#ceny'],
    ['label' => 'FAQ',         'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

add_filter('body_class', static function (array $classes): array {
    if (!in_array('ai-mediaplan-page', $classes, true)) {
        $classes[] = 'ai-mediaplan-page';
    }
    return $classes;
});

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать медиаплан';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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

.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.nero-ai-delay-3{transition-delay:.36s;}

.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

.vmp-sh.vmp-left{margin-left:0;text-align:left;max-width:820px;}
.vmp-sh.vmp-left p{margin-left:0;}
.vmp-symptom .ico{font-size:28px;margin-bottom:10px;}
.vmp-symptom h3{font-size:16px;color:#fff;margin-bottom:8px;}
.vmp-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#22c55e;margin-bottom:10px;}
.vmp-price-card .tag{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#79f2ff;margin-bottom:10px;}
.vmp-price-card .price{font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;line-height:1;margin-bottom:10px;}
.zone-g{color:#22c55e;font-weight:700;}
.zone-y{color:#f59e0b;font-weight:700;}
.zone-r{color:#fb7185;font-weight:700;}
.vmp-toc a{transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.vmp-toc a:hover{border-color:rgba(121,242,255,.42);color:#79f2ff;background:rgba(121,242,255,.08);}
.vmp-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.vmp-intro-text p{text-align:left!important;}
.vmp-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.vmp-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.vmp-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:#fff;letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.vmp-kpi-card .kl{font-size:11px;font-weight:600;color:#9aa8bd;line-height:1.4;}
@media(max-width:900px){.vmp-intro-grid{grid-template-columns:1fr;gap:36px;}.vmp-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.vmp-intro-kpi{grid-template-columns:1fr 1fr;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-mediaplan-page" role="main" tabindex="-1">

<section class="nero-ai-hero amp-hero-mediaplan" id="hero" aria-labelledby="hero-mediaplan-title">
<style>
/* ── Hero ai-mediaplan: самодостаточные стили (Kadence / nero-ai-home-page) ── */
.amp-hero-mediaplan {
  --amp-cyan: #79f2ff;
  --amp-violet: #8b5cf6;
  --amp-green: #22c55e;
  --amp-amber: #f59e0b;
  --amp-red: #fb7185;
  --amp-text: #e6edf7;
  --amp-muted: #9aa8bd;
  --amp-soft: #c7d2e5;
  --amp-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--amp-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.amp-hero-mediaplan::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.amp-hero-mediaplan::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 680px;
  height: 680px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .11), transparent 66%);
  filter: blur(8px);
  animation: ampHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes ampHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.amp-hero-mediaplan .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.amp-hero-mediaplan .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.amp-hero-mediaplan .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.amp-hero-mediaplan .nero-ai-gradient-text {
  background: linear-gradient(92deg, var(--amp-cyan) 0%, var(--amp-violet) 55%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.amp-hero-mediaplan .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--amp-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.amp-hero-mediaplan .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--amp-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.amp-hero-mediaplan .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.amp-hero-mediaplan .nero-ai-badge {
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
.amp-hero-mediaplan .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.amp-hero-mediaplan .nero-ai-btn {
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
.amp-hero-mediaplan .nero-ai-btn:hover { transform: translateY(-2px); }
.amp-hero-mediaplan .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--amp-cyan), #38bdf8);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.amp-hero-mediaplan .nero-ai-btn-secondary {
  color: #e8f2ff !important;
  border-color: rgba(255,255,255,.14);
  background: rgba(255,255,255,.06);
}
.amp-hero-mediaplan .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--amp-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.amp-hero-mediaplan .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.amp-hero-mediaplan .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.amp-hero-mediaplan .nero-ai-dots { display: flex; gap: 7px; }
.amp-hero-mediaplan .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.22); }
.amp-hero-mediaplan .nero-ai-dot:nth-child(1) { background: #fb7185; }
.amp-hero-mediaplan .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.amp-hero-mediaplan .nero-ai-dot:nth-child(3) { background: #34d399; }
.amp-hero-mediaplan .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.amp-hero-mediaplan .nero-ai-window-body { padding: 18px; }
.amp-hero-mediaplan .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.amp-hero-mediaplan .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: #fff;
}
.amp-hero-mediaplan .nero-ai-live-pill {
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
.amp-hero-mediaplan .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--amp-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: ampPulse 1.6s infinite;
}
@keyframes ampPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.amp-hero-mediaplan .amp-dash-canvas-wrap {
  position: relative;
  height: clamp(168px, 24vw, 220px);
  margin-bottom: 14px;
  border-radius: 18px;
  border: 1px solid rgba(121, 242, 255, 0.12);
  background: radial-gradient(circle at 50% 40%, rgba(121, 242, 255, 0.06), rgba(2, 6, 23, 0.4));
  overflow: hidden;
}
.amp-hero-mediaplan #amp-hero-hypothesis-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.amp-hero-mediaplan .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.amp-hero-mediaplan .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.amp-hero-mediaplan .nero-ai-metric:hover {
  transform: translateY(-3px);
  border-color: rgba(121,242,255,.34);
  background: rgba(121,242,255,.07);
}
.amp-hero-mediaplan .nero-ai-metric span {
  display: block;
  color: var(--amp-muted);
  font-size: 12px;
  font-weight: 700;
}
.amp-hero-mediaplan .nero-ai-metric strong {
  display: block;
  margin-top: 7px;
  color: #fff;
  font-size: 24px;
  line-height: 1;
}
.amp-hero-mediaplan .nero-ai-metric small {
  display: block;
  margin-top: 6px;
  color: #9fb0c9;
  font-size: 11px;
}
.amp-hero-mediaplan .nero-ai-metric--green strong { color: var(--amp-green); }
.amp-hero-mediaplan .nero-ai-task-stream { margin-top: 16px; display: grid; gap: 10px; }
.amp-hero-mediaplan .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
}
.amp-hero-mediaplan .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--amp-cyan);
  font-size: 10px;
  font-weight: 900;
  letter-spacing: -.02em;
}
.amp-hero-mediaplan .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 13px;
}
.amp-hero-mediaplan .nero-ai-task span {
  color: var(--amp-muted);
  font-size: 12px;
}
.amp-hero-mediaplan .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 800;
  background: rgba(34,197,94,.12);
  color: #86efac;
}
.amp-hero-mediaplan .nero-ai-status--new {
  background: rgba(121,242,255,.12);
  color: #bae6fd;
}
@media (max-width: 900px) {
  .amp-hero-mediaplan .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .amp-hero-mediaplan .nero-ai-dashboard { transform: none; }
}
@media (max-width: 600px) {
  .amp-hero-mediaplan { min-height: auto; padding-top: 56px; }
  .amp-hero-mediaplan .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai медиаплан</p>
      <h1 id="hero-mediaplan-title">AI-медиаплан под ключ — <span class="nero-ai-gradient-text">гипотезы, аудитории и план тестов на 30 дней</span></h1>
      <p class="nero-ai-hero-lead">AI генерирует рекламные гипотезы, аудитории и офферы без хаотичных запусков и слива бюджета — внедрение AI-медиапланирования для маркетологов и агентств</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Гипотезы 15–25</li>
        <li class="nero-ai-badge">Календарь 30 дней</li>
        <li class="nero-ai-badge">Яндекс + VK</li>
        <li class="nero-ai-badge">CRM + отчёты</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-медиаплан">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Медиаплан · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-центр медиапланирования</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>

          <div class="amp-dash-canvas-wrap" aria-hidden="false">
            <canvas id="amp-hero-hypothesis-canvas" role="img" aria-label="Анимация: гипотезы ранжируются ICE, раскладываются в календарь 30 дней и проходят KPI-зоны"></canvas>
          </div>

          <div class="nero-ai-metrics-grid" aria-label="Демо-метрики медиаплана">
            <div class="nero-ai-metric">
              <span>Гипотезы</span>
              <strong>18</strong>
              <small>в матрице</small>
            </div>
            <div class="nero-ai-metric">
              <span>Тесты</span>
              <strong>30</strong>
              <small>дней</small>
            </div>
            <div class="nero-ai-metric">
              <span>Каналы</span>
              <strong>3</strong>
              <small>Яндекс · VK · TG</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--green">
              <span>CPL</span>
              <strong>−24%</strong>
              <small>демо KPI</small>
            </div>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий медиаплана">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Гипотезы ранжированы ICE</strong><span>креатив × аудитория × оффер</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">HITL</span>
              <div><strong>Отбор 8 из 18</strong><span>human-in-the-loop</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ADS</span>
              <div><strong>Запуск Яндекс + VK</strong><span>календарь недели 1</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">KPI</span>
              <div><strong>Зона 🟢 — масштаб</strong><span>stop/scale правила</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  "use strict";
  var canvas = document.getElementById("amp-hero-hypothesis-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var phase = 0;
  var bubbles = [];

  var C = {
    outline: "#1e293b",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    amber: "#f59e0b",
    red: "#fb7185",
    card: "rgba(255,255,255,0.92)",
    grid: "rgba(121,242,255,0.08)",
    agentY: "#eab308",
    agentG: "#10b981",
    agentB: "#3b82f6",
    agentP: "#ec4899",
    agentV: "#8b5cf6"
  };

  function resize() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 200;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw * 0.5;
    cy = ch * 0.52;
    scale = Math.min(cw / 420, ch / 220, 1.2);
  }
  window.addEventListener("resize", resize);
  resize();

  function rnd(a, b) { return a + Math.random() * (b - a); }

  function createBubble(text, x, y) {
    bubbles.push({ text: text, x: x, y: y, life: 0, max: 90 });
  }

  function drawBubble(b) {
    ctx.font = "600 " + Math.round(10 * scale) + "px Inter, sans-serif";
    var tw = ctx.measureText(b.text).width + 16 * scale;
    var th = 22 * scale;
    var bx = b.x - tw / 2;
    var by = b.y - th - 8 * scale;
    ctx.fillStyle = "rgba(15,23,42,0.92)";
    ctx.strokeStyle = "rgba(121,242,255,0.35)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(bx, by, tw, th, 8 * scale);
    else ctx.rect(bx, by, tw, th);
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = "#e2e8f0";
    ctx.fillText(b.text, bx + 8 * scale, by + 15 * scale);
  }

  /* Дуговые канальные рельсы — не конвейер */
  class HypothesisRiver {
    constructor() {
      this.t = 0;
      this.chips = [];
      for (var i = 0; i < 5; i++) {
        this.chips.push({
          arc: i % 3,
          prog: i * 0.18,
          label: ["Креатив", "Аудитория", "Оффер", "Лендинг", "Канал"][i],
          ice: Math.floor(rnd(62, 94))
        });
      }
    }
    draw(ctx) {
      this.t += 0.008;
      var arcs = [
        { col: C.cyan, r: 0.34 * cw },
        { col: C.violet, r: 0.28 * cw },
        { col: C.amber, r: 0.22 * cw }
      ];
      arcs.forEach(function (a, idx) {
        ctx.strokeStyle = a.col;
        ctx.globalAlpha = 0.35;
        ctx.lineWidth = 2 * scale;
        ctx.beginPath();
        ctx.arc(cx, cy, a.r, Math.PI * 0.15, Math.PI * 0.85);
        ctx.stroke();
        ctx.globalAlpha = 1;
        ctx.fillStyle = a.col;
        ctx.font = "700 " + Math.round(9 * scale) + "px Inter";
        ctx.fillText(idx === 0 ? "Яндекс" : idx === 1 ? "VK" : "TG", cx + a.r * 0.55, cy - a.r * 0.55);
      });
      this.chips.forEach(function (chip) {
        chip.prog += 0.004 + chip.arc * 0.001;
        if (chip.prog > 1) chip.prog = 0;
        var a = arcs[chip.arc];
        var ang = Math.PI * 0.15 + chip.prog * Math.PI * 0.7;
        var px = cx + Math.cos(ang) * a.r;
        var py = cy + Math.sin(ang) * a.r * 0.55;
        ctx.fillStyle = C.card;
        ctx.strokeStyle = C.outline;
        ctx.lineWidth = 1.5;
        var w = 44 * scale, h = 18 * scale;
        ctx.beginPath();
        if (ctx.roundRect) ctx.roundRect(px - w / 2, py - h / 2, w, h, 4 * scale);
        else ctx.rect(px - w / 2, py - h / 2, w, h);
        ctx.fill();
        ctx.stroke();
        ctx.fillStyle = "#0f172a";
        ctx.font = "700 " + Math.round(8 * scale) + "px Inter";
        ctx.fillText(chip.label.slice(0, 6), px - w / 2 + 4 * scale, py + 3 * scale);
        ctx.fillStyle = C.green;
        ctx.fillText("ICE " + chip.ice, px + w / 2 - 28 * scale, py + 3 * scale);
      });
    }
  }

  /* Центральная матрица календаря — не WebsiteTerminal */
  class MediaCalendarMatrix {
    constructor() {
      this.lockPulse = 0;
      this.cells = [];
      for (var d = 0; d < 30; d++) {
        this.cells.push({
          day: d + 1,
          zone: d % 7 === 2 ? "red" : d % 5 === 0 ? "amber" : "green",
          lit: Math.random() > 0.35
        });
      }
    }
    draw(ctx) {
      this.lockPulse += 0.03;
      var w = 118 * scale, h = 72 * scale;
      var x = cx - w / 2, y = cy - h / 2;
      ctx.fillStyle = "rgba(6,10,24,0.85)";
      ctx.strokeStyle = "rgba(121,242,255,0.4)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      if (ctx.roundRect) ctx.roundRect(x, y, w, h, 10 * scale);
      else ctx.rect(x, y, w, h);
      ctx.fill();
      ctx.stroke();
      ctx.fillStyle = "#94a3b8";
      ctx.font = "700 " + Math.round(9 * scale) + "px Inter";
      ctx.fillText("Календарь 30 дней", x + 8 * scale, y + 14 * scale);
      var cols = 10, rows = 3, gap = 3 * scale;
      var cellW = (w - 16 * scale - gap * (cols - 1)) / cols;
      var cellH = (h - 28 * scale - gap * (rows - 1)) / rows;
      for (var i = 0; i < 30; i++) {
        var col = i % cols, row = Math.floor(i / cols);
        var cx0 = x + 8 * scale + col * (cellW + gap);
        var cy0 = y + 20 * scale + row * (cellH + gap);
        var cell = this.cells[i];
        var colFill = cell.zone === "green" ? C.green : cell.zone === "amber" ? C.amber : C.red;
        ctx.fillStyle = cell.lit ? colFill : "rgba(255,255,255,0.06)";
        ctx.globalAlpha = cell.lit ? 0.55 + Math.sin(frame * 0.05 + i) * 0.15 : 0.35;
        ctx.beginPath();
        if (ctx.roundRect) ctx.roundRect(cx0, cy0, cellW, cellH, 2 * scale);
        else ctx.rect(cx0, cy0, cellW, cellH);
        ctx.fill();
        ctx.globalAlpha = 1;
      }
      if (phase >= 3) {
        var pulse = 0.5 + Math.sin(this.lockPulse) * 0.5;
        ctx.strokeStyle = C.green;
        ctx.globalAlpha = 0.4 + pulse * 0.4;
        ctx.lineWidth = 3 * scale;
        ctx.beginPath();
        ctx.arc(cx, cy, w * 0.62, 0, Math.PI * 2);
        ctx.stroke();
        ctx.globalAlpha = 1;
      }
    }
  }

  class Agent {
    constructor(x, y, color, role, dialogs) {
      this.x = x; this.y = y; this.color = color; this.role = role;
      this.dialogs = dialogs;
      this.stepTrig = Math.floor(rnd(0, 180));
      this.dir = 1;
      this.bubbleT = 0;
    }
    getTarget() {
      var offsets = [
        { tx: cx - 70 * scale, ty: cy + 38 * scale },
        { tx: cx - 95 * scale, ty: cy - 10 * scale },
        { tx: cx + 85 * scale, ty: cy + 20 * scale },
        { tx: cx + 60 * scale, ty: cy - 28 * scale },
        { tx: cx, ty: cy + 52 * scale }
      ];
      var o = offsets[this.role - 1] || offsets[0];
      return { tx: o.tx, ty: o.ty };
    }
    draw(ctx) {
      this.stepTrig = (this.stepTrig + 1) % 200;
      var t = this.getTarget();
      this.x += (t.tx - this.x) * 0.04;
      this.y += (t.ty - this.y) * 0.04;
      var bob = Math.sin(frame * 0.08 + this.role) * 2 * scale;
      ctx.fillStyle = this.color;
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(this.x, this.y + bob, 7 * scale, 0, Math.PI * 2);
      ctx.fill();
      ctx.stroke();
      ctx.fillStyle = "#0f172a";
      ctx.beginPath();
      ctx.arc(this.x, this.y + bob - 10 * scale, 5 * scale, 0, Math.PI * 2);
      ctx.fill();
      if (this.bubbleT++ > 220) {
        this.bubbleT = 0;
        var line = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
        createBubble(line, this.x, this.y + bob - 18 * scale);
      }
    }
  }

  var river = new HypothesisRiver();
  var matrix = new MediaCalendarMatrix();
  var agents = [
    new Agent(40 * scale, ch - 30 * scale, C.agentY, 1, ["Бриф: CPL ≤ 800 ₽", "Цель: лиды B2B", "Бюджет 30 дней"]),
    new Agent(60 * scale, ch - 50 * scale, C.agentG, 2, ["ICE: креатив 87", "RICE: аудитория 92", "Стоп красная зона"]),
    new Agent(cw - 50 * scale, ch - 40 * scale, C.agentP, 3, ["UGC vs продакшн", "Оффер: бонус 14%", "Видео 15 сек"]),
    new Agent(cw - 70 * scale, 30 * scale, C.agentB, 4, ["Яндекс: спрос", "VK: прогрев", "Look-alike CRM"]),
    new Agent(cx, ch - 20 * scale, C.agentV, 5, ["Масштаб 🟢", "Kill 🔴 гипотеза", "План готов"])
  ];

  function engineloop() {
    frame++;
    phase = Math.floor((frame % 480) / 120);

    ctx.clearRect(0, 0, cw, ch);
    ctx.fillStyle = C.grid;
    for (var gx = 0; gx < cw; gx += 24 * scale) {
      ctx.fillRect(gx, 0, 1, ch);
    }
    for (var gy = 0; gy < ch; gy += 24 * scale) {
      ctx.fillRect(0, gy, cw, 1);
    }

    river.draw(ctx);
    matrix.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });

    if (frame % 120 === 30) createBubble("Скан кабинетов", cx - 90 * scale, cy - 40 * scale);
    if (frame % 120 === 55) createBubble("Ранжирование ICE", cx, cy - 50 * scale);
    if (frame % 120 === 80) createBubble("Слот в календарь", cx + 20 * scale, cy);
    if (phase >= 3 && frame % 120 === 100) createBubble("План 30 дней ✓", cx, cy - 58 * scale);

    bubbles.forEach(function (b) {
      b.life++;
      b.y -= 0.15 * scale;
      if (b.life < b.max) drawBubble(b);
    });
    bubbles = bubbles.filter(function (b) { return b.life < b.max; });

    requestAnimationFrame(engineloop);
  }
  engineloop();
})();
</script>

<style>
/* VMP content root — dark theme, prefix vmp- */
.vmp-content{--vmp-bg:#050711;--vmp-bg2:#080b17;--vmp-surface:rgba(255,255,255,.072);--vmp-text:#e6edf7;--vmp-muted:#9aa8bd;--vmp-soft:#c7d2e5;--vmp-heading:#fff;--vmp-border:rgba(255,255,255,.10);--vmp-accent:#79f2ff;--vmp-violet:#8b5cf6;--vmp-green:#22c55e;--vmp-yellow:#f59e0b;--vmp-red:#fb7185;--vmp-btn-from:#2563eb;--vmp-btn-to:#7c3aed;--vmp-container:1220px;background:linear-gradient(180deg,#050711,#080b17 52%,#050711);color:var(--vmp-text);font-family:Inter,system-ui,sans-serif;overflow-x:hidden}
.vmp-content *,.vmp-content *::before,.vmp-content *::after{box-sizing:border-box}
.vmp-content p{color:var(--vmp-muted);line-height:1.72;margin:0 0 1em}
.vmp-content h2,.vmp-content h3{color:var(--vmp-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vmp-content strong{color:var(--vmp-soft)}
.vmp-content ul{list-style:none;padding:0;margin:0 0 1em}
.vmp-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vmp-muted);font-size:14.5px;line-height:1.65}
.vmp-content ul li::before{content:'›';position:absolute;left:0;color:var(--vmp-accent);font-weight:700}
.vmp-cnt{width:min(var(--vmp-container),calc(100% - 40px));margin:0 auto}
.vmp-section{padding:clamp(64px,8vw,112px) 0}
.vmp-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vmp-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vmp-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vmp-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vmp-eyebrow{display:inline-flex;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vmp-accent);margin-bottom:14px}
.vmp-intro{padding:clamp(40px,5vw,72px) 0;border-bottom:1px solid rgba(255,255,255,.06)}
.vmp-intro-text{max-width:920px;margin:0 auto;padding-left:20px;position:relative}
.vmp-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vmp-accent),var(--vmp-violet))}
.vmp-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;padding:0 0 48px}
.vmp-toc a{padding:9px 18px;background:var(--vmp-surface);border:1px solid var(--vmp-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vmp-muted);text-decoration:none!important}
.vmp-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vmp-border);border-radius:24px;padding:26px}
.vmp-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vmp-grid-3{grid-template-columns:1fr}}
.vmp-symptom-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:28px 0}
@media(max-width:768px){.vmp-symptom-grid{grid-template-columns:1fr}}
.vmp-symptom{padding:22px;border-radius:18px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);text-align:center}
.vmp-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vmp-table{width:100%;border-collapse:collapse;font-size:14px}
.vmp-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vmp-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.vmp-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vmp-text);vertical-align:top}
.vmp-table tr.vmp-row-highlight td{background:rgba(121,242,255,.06);font-weight:600}
.vmp-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vmp-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vmp-accent);border:1px solid rgba(121,242,255,.2)}
.vmp-flow .arr{color:var(--vmp-muted);background:none;border:none}
.vmp-sf-block{padding:32px;border-radius:24px;background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.22);margin-top:24px}
.vmp-int-row{display:flex;flex-wrap:wrap;gap:12px;margin:24px 0}
.vmp-int-pill{padding:10px 16px;border-radius:12px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);font-size:13px;font-weight:700;color:var(--vmp-soft)}
.vmp-pricing{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:28px}
@media(max-width:900px){.vmp-pricing{grid-template-columns:1fr}}
.vmp-price-card{padding:28px;border-radius:22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1)}
.vmp-price-card.featured{border-color:rgba(121,242,255,.35)}
.vmp-case-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:768px){.vmp-case-grid{grid-template-columns:1fr}}
.vmp-case{padding:24px;border-radius:20px;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09)}
.vmp-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vmp-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:19px 24px}
.vmp-faq-item h3{font-size:16px;margin-bottom:10px}
.vmp-inline-cta{margin:24px 0;padding:16px 20px;border-radius:14px;background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.18)}
.vmp-inline-cta a{color:var(--vmp-accent)!important;font-weight:700;text-decoration:underline!important}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vmp-muted);font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vmp-accent)!important;text-decoration:underline!important}
/* Boris block bmp- */
#ai-mediaplan-boris-block.bmp-root{padding:56px 0 64px;background:#f0f4fb}
#ai-mediaplan-boris-block .bmp-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#ai-mediaplan-boris-block .bmp-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px}
@media(max-width:1023px){#ai-mediaplan-boris-block .bmp-card{grid-template-columns:1fr;min-height:auto}}
#ai-mediaplan-boris-block .bmp-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0}
@media(max-width:1023px){#ai-mediaplan-boris-block .bmp-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}}
#ai-mediaplan-boris-block .bmp-ey{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6366f1;margin:0 0 14px;display:flex;align-items:center;gap:8px}
#ai-mediaplan-boris-block .bmp-ey::before{content:'';width:20px;height:2px;background:#6366f1;border-radius:1px}
#ai-mediaplan-boris-block .bmp-h3{font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px}
#ai-mediaplan-boris-block .bmp-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:10px}
#ai-mediaplan-boris-block .bmp-ul li{display:flex;gap:10px;font-size:14.5px;line-height:1.5;color:#334155}
#ai-mediaplan-boris-block .bmp-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#6366f1;font-style:normal}
#ai-mediaplan-boris-block .bmp-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px}
#ai-mediaplan-boris-block .bmp-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700}
#ai-mediaplan-boris-block .bmp-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#ai-mediaplan-boris-block .bmp-pl-y{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22)}
#ai-mediaplan-boris-block .bmp-pl-r{background:rgba(251,113,133,.08);color:#be123c;border:1.5px solid rgba(251,113,133,.22)}
#ai-mediaplan-boris-block .bmp-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0}
#ai-mediaplan-boris-block .bmp-rgt{background:linear-gradient(145deg,#07091a,#0d1224 55%,#090d1f);position:relative;overflow:hidden;min-height:400px}
#bmp-hypothesis-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>
<div class="vmp-content">

  <section class="vmp-intro" id="intro">
    <div class="vmp-cnt">
      <div class="vmp-intro-grid nero-ai-reveal">
        <div class="vmp-intro-text">
          <p class="vmp-eyebrow" style="margin-bottom:16px;">Лонгрид · ai медиаплан</p>
          <p><strong>Коротко:</strong> AI-медиаплан — это не генератор Excel за пять минут, а внедрённый процесс: нейросеть собирает рекламные гипотезы, аудитории и офферы, формирует календарь тестов на 30 дней и связывает план с рекламными кабинетами и CRM. Nero Network внедряет AI-медиапланирование под ключ в коридоре 80–250 тыс. ₽.</p>
        </div>
        <div class="vmp-intro-kpi" aria-label="Ключевые метрики медиаплана">
          <div class="vmp-kpi-card"><div class="kv">15–25</div><div class="kl">гипотез в матрице</div></div>
          <div class="vmp-kpi-card"><div class="kv">30</div><div class="kl">дней тестов</div></div>
          <div class="vmp-kpi-card"><div class="kv">3</div><div class="kl">канала рекламы</div></div>
          <div class="vmp-kpi-card"><div class="kv">80–250k</div><div class="kl">₽ внедрение</div></div>
        </div>
      </div>
    </div>
  </section>
  <nav class="vmp-toc vmp-cnt" aria-label="Оглавление">
    <a href="#pochemu-haos">Почему хаос</a>
    <a href="#chto-takoe">Что такое</a>
    <a href="#kak-rabotaet">Как работает</a>
    <a href="#salesforce-2026">Salesforce</a>
    <a href="#vnedrenie">Внедрение</a>
    <a href="#integracii">Интеграции</a>
    <a href="#dlya-kogo">Для кого</a>
    <a href="#keisy">Кейсы</a>
    <a href="#ceny">Стоимость</a>
    <a href="#faq">FAQ</a>
    <a href="#cta">Заявка</a>
  </nav>
  <section class="vmp-section" id="pochemu-haos">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">Боль рынка</span>
        <h2>Почему рекламные гипотезы запускаются хаотично и бюджет сливается без системы</h2>
        <p>Когда гипотезы для рекламы запускаются хаотично, бюджет тратится без системы — команда тестирует «что пришло в голову», а не то, что даёт измеримый прирост.</p>
      </div>
      <div class="vmp-card nero-ai-reveal">
        <p>Типичная картина: в понедельник таргетолог предлагает новый креатив, в среду собственник просит «попробовать VK», в пятницу агентство присылает Excel — но никто не фиксирует, <strong>какую гипотезу</strong> проверяем, <strong>какой KPI</strong> считаем успехом и <strong>когда</strong> останавливаем кампанию.</p>
        <p>По Salesforce State of Sales 2026 sales-профи тратят <strong>около 16%</strong> рабочего времени на планирование. <strong>51% руководителей</strong> указывают разрозненный tech stack как барьер для AI. АРИР/АЦ РИР: <strong>48%</strong> рынка используют AI/ML, но <strong>49%</strong> не хватает компетенций, <strong>41%</strong> — проблемы с данными.</p>
      </div>
      <div class="vmp-symptom-grid nero-ai-reveal">
        <div class="vmp-symptom"><div class="ico">📊</div><h3>Нет матрицы гипотез</h3><p>Тестируют только креатив, забывая про аудиторию, оффер и лендинг.</p></div>
        <div class="vmp-symptom"><div class="ico">📅</div><h3>Нет календаря</h3><p>Запуски накладываются — невозможно понять, что сработало.</p></div>
        <div class="vmp-symptom"><div class="ico">⛔</div><h3>Нет kill/scale</h3><p>Неэффективные кампании крутятся неделями, съедая бюджет.</p></div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
      <p class="nero-ai-reveal"><strong>Итог:</strong> без системы AI-медиапланирования даже нейросеть для рекламы превращается в дорогую игрушку.</p>
      <div class="vmp-inline-cta nero-ai-reveal"><a href="#kak-rabotaet">Узнать, как навести порядок в гипотезах →</a></div>
    </div>
  </section>
  <section class="vmp-section vmp-section-alt" id="chto-takoe">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">Определение</span>
        <h2>Что такое AI-медиаплан и чем отличается от Excel-таблицы</h2>
        <p>AI-медиаплан — процесс, в котором нейросеть помогает собрать, приоритизировать и протестировать гипотезы и связать план с CRM и кабинетами.</p>
      </div>
      <div class="vmp-table-wrap nero-ai-reveal"><table class="vmp-table"><thead><tr><th>Критерий</th><th>Excel-медиаплан</th><th>AI-медиаплан</th></tr></thead><tbody>
<tr><td>Генерация гипотез</td><td>Вручную, 3–7 идей</td><td>AI: 15–25, отбор 8–12</td></tr>
<tr><td>Приоритизация</td><td>Субъективно</td><td>ICE/RICE + CRM</td></tr>
<tr><td>Календарь</td><td>Статичная таблица</td><td>Динамический план 30 дней</td></tr>
<tr><td>Мониторинг KPI</td><td>Раз в неделю</td><td>KPI-зоны + алерты</td></tr>
<tr><td>Связка с CRM</td><td>Нет</td><td>Лид → гипотеза → сделка</td></tr>
<tr><td>Обновление</td><td>С нуля</td><td>Самообучение</td></tr>
</tbody></table></div>
      <div class="vmp-card nero-ai-reveal"><p>SaaS (Komanda.ai, CMO Analytics) дают черновик без интеграций и сопровождения. <strong>Внедрение под ключ</strong> — процесс, интеграции, первый цикл и шаблон «План тестов на 30 дней». Модель Nero — <strong>гибрид «нейросеть + человек»</strong> (кейсы O'STIN, i-Media).</p></div>
    </div>
  </section>

  <section id="ai-mediaplan-boris-block" class="bmp-root" aria-label="Анимация: KPI-зоны и календарь тестов AI-медиаплана">
    <div class="bmp-cnt"><div class="bmp-card">
      <div class="bmp-lft">
        <span class="bmp-ey">Мониторинг гипотез</span>
        <h3 class="bmp-h3">KPI-зоны вместо хаоса: что масштабировать, что стопнуть</h3>
        <ul class="bmp-ul">
          <li><span class="bmp-ic">🟢</span>Зелёная зона — KPI лучше baseline на 15%+ → масштаб бюджета</li>
          <li><span class="bmp-ic">🟡</span>Жёлтая — ±15% → доработка, ещё 3–5 дней теста</li>
          <li><span class="bmp-ic">🔴</span>Красная — хуже на 20%+ → стоп, бюджет на следующую гипотезу</li>
          <li><span class="bmp-ic">📅</span>Календарь 4 недель: запуск → stop/scale → волна 2 → итог</li>
        </ul>
        <div class="bmp-pills">
          <span class="bmp-pl bmp-pl-g">🟢 Scale</span>
          <span class="bmp-pl bmp-pl-y">🟡 Hold</span>
          <span class="bmp-pl bmp-pl-r">🔴 Stop</span>
        </div>
        <p class="bmp-foot">Дальше — матрица гипотез и план тестов на 30 дней →</p>
      </div>
      <div class="bmp-rgt">
        <canvas id="bmp-hypothesis-canvas" aria-label="Анимация: гипотезы проходят AI-ранжирование и попадают в KPI-зоны медиаплана" role="img"></canvas>
      </div>
    </div></div>
<script>
(function(){
  var cv=document.getElementById('bmp-hypothesis-canvas');if(!cv)return;
  var ctx=cv.getContext('2d'),W=0,H=0,fr=0;
  function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;W=cv.width;H=cv.height;}
  window.addEventListener('resize',resize);resize();
  var C={g:'#22c55e',gD:function(a){return 'rgba(34,197,94,'+a+')';},y:'#f59e0b',yD:function(a){return 'rgba(245,158,11,'+a+')';},r:'#fb7185',rD:function(a){return 'rgba(251,113,133,'+a+')';},cy:'#79f2ff',cyD:function(a){return 'rgba(121,242,255,'+a+')';},v:'#8b5cf6',vD:function(a){return 'rgba(139,92,246,'+a+')';},t:'#e2e8f0',m:'rgba(226,232,240,.45)',cd:'rgba(255,255,255,.07)',cb:'rgba(255,255,255,.12)',ln:'rgba(255,255,255,.08)'};
  var Z=[{l:'Scale',s:'+15%',c:C.g,d:C.gD},{l:'Hold',s:'±15%',c:C.y,d:C.yD},{l:'Stop',s:'−20%',c:C.r,d:C.rD}];
  var Hp=[{n:'UGC × VK',ch:'VK',z:0,d:40},{n:'Look-alike',ch:'Яндекс',z:0,d:110},{n:'Бонус × квиз',ch:'Яндекс',z:1,d:180},{n:'B2B смежный',ch:'VK',z:0,d:250},{n:'Telegram',ch:'TG',z:2,d:320},{n:'Видео × int',ch:'VK',z:1,d:390}];
  var cards=Hp.map(function(h){return{n:h.n,ch:h.ch,z:h.z,d:h.d,x:-100,y:0,a:0,st:0,set:0,ord:0};});
  var zc=[0,0,0],LP=640;
  function rr(x,y,w,h,r,f,s,l){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(f){ctx.fillStyle=f;ctx.fill();}if(s){ctx.strokeStyle=s;ctx.lineWidth=l||1.5;ctx.stroke();}}
  function lay(){var P=12,T=44,G=8,cw=(W-P*2-G*2)/3,ch=H-T-P-56;return{P:P,T:T,G:G,cw:cw,ch:ch};}
  function loop(){fr++;ctx.clearRect(0,0,W,H);var L=lay();
    ctx.fillStyle=C.t;ctx.font='bold 13px system-ui';ctx.textAlign='left';ctx.fillText('Медиаплан · 30 дней',14,24);
    ctx.strokeStyle=C.ln;ctx.beginPath();ctx.moveTo(0,36);ctx.lineTo(W,36);ctx.stroke();
    Z.forEach(function(z,i){var x=L.P+i*(L.cw+L.G);rr(x,L.T,L.cw,L.ch,10,C.cd,C.cb,1.5);ctx.fillStyle=z.c;ctx.font='bold 11px system-ui';ctx.textAlign='center';ctx.fillText(z.l,x+L.cw/2,L.T+18);ctx.fillStyle=C.m;ctx.font='10px system-ui';ctx.fillText(z.s,x+L.cw/2,L.T+32);});
    for(var wk=0;wk<4;wk++){var x=L.P+wk*((W-L.P*2)/4),act=Math.floor((fr%LP)/160)===wk;rr(x,H-52,(W-L.P*2)/4-6,38,8,act?C.cyD(.12):'rgba(255,255,255,.04)',act?C.cyD(.35):C.cb,1);ctx.fillStyle=act?C.cy:C.m;ctx.font='bold 10px system-ui';ctx.textAlign='center';ctx.fillText('Нед '+(wk+1),x+((W-L.P*2)/4-6)/2,H-36);}
    var cx=L.P-2,cy=L.T+L.ch/2,r=26,p=0.5+0.5*Math.sin(fr*.08);ctx.beginPath();ctx.arc(cx,cy,r+6+p*5,0,Math.PI*2);ctx.fillStyle=C.vD(.2);ctx.fill();rr(cx-r,cy-r,r*2,r*2,r*.4,C.vD(.25),C.v,2);ctx.fillStyle='#fff';ctx.font='bold 11px system-ui';ctx.textAlign='center';ctx.textBaseline='middle';ctx.fillText('AI',cx,cy);
    cards.forEach(function(c){if(fr>=c.d&&!c.st){c.st=1;c.ord=zc[c.z]++;}if(!c.st)return;var zx=L.P+c.z*(L.cw+L.G)+8,fy=L.T+44+c.ord*58;if(!c.set){c.x+=(zx-c.x)*.1;c.y+=(fy-c.y)*.1;c.a=Math.min(1,c.a+.06);if(Math.abs(c.x-zx)<2&&Math.abs(c.y-fy)<2)c.set=1;}else{c.x=zx;c.y=fy;}ctx.globalAlpha=c.set?1:c.a;var z=Z[c.z];rr(c.x,c.y,L.cw-16,48,8,z.d(.12),z.d(.35),1.5);ctx.fillStyle=C.t;ctx.font='bold 10px system-ui';ctx.textAlign='left';ctx.fillText(c.n,c.x+8,c.y+18);ctx.fillStyle=z.c;ctx.font='9px system-ui';ctx.fillText(c.ch,c.x+8,c.y+34);ctx.globalAlpha=1;});
    if(fr%LP===0){cards.forEach(function(c,i){c.x=-100;c.y=0;c.a=0;c.st=0;c.set=0;c.ord=0;c.d=Hp[i].d;});zc=[0,0,0];}
    requestAnimationFrame(loop);}loop();
})();
</script>
  </section>

  <section class="vmp-section" id="kak-rabotaet">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">Процесс</span>
        <h2>Как работает AI-медиаплан: гипотезы, аудитории, офферы и календарь тестов</h2>
        <p>Пять шагов — бриф → анализ → генерация → календарь 30 дней → мониторинг и волна 2.</p>
      </div>
      <div class="vmp-flow nero-ai-reveal" aria-label="5 шагов"><span>Бриф</span><span class="arr">→</span><span>Анализ данных</span><span class="arr">→</span><span>15–25 гипотез</span><span class="arr">→</span><span>Календарь 30 дней</span><span class="arr">→</span><span>KPI-зоны</span></div>
      <ol class="vmp-card nero-ai-reveal" style="list-style:decimal;padding-left:24px;color:var(--vmp-muted)">
        <li style="margin-bottom:8px">Клиент заполняет бриф: цель, продукт, ЦА, бюджет, CRM.</li>
        <li style="margin-bottom:8px">AI анализирует кабинеты и SEO-кластеры → 15–25 гипотез.</li>
        <li style="margin-bottom:8px">Менеджер и заказчик отбирают 8–12 (human-in-the-loop).</li>
        <li style="margin-bottom:8px">Календарь на 30 дней: бюджет, KPI, stop/scale.</li>
        <li style="margin-bottom:8px">Через 14 дней — отчёт 🟢🟡🔴 и волна 2.</li>
      </ol>
      <div class="vmp-sh vmp-left" id="matrica-gipotez" style="margin-top:40px"><span class="vmp-eyebrow">Матрица</span><h3>Матрица гипотез: креатив, аудитория, оффер, лендинг</h3></div>
      <div class="vmp-table-wrap nero-ai-reveal"><table class="vmp-table"><thead><tr><th>Ось</th><th>Примеры</th><th>Метрики</th></tr></thead><tbody>
<tr><td><strong>Креатив</strong></td><td>UGC vs продакшн; видео vs статика</td><td>CTR, CPC</td></tr>
<tr><td><strong>Аудитория</strong></td><td>look-alike; B2B-смежные (i-Media)</td><td>CPL, CR</td></tr>
<tr><td><strong>Оффер</strong></td><td>цена; бонус; соцдоказательство</td><td>CR, CPA</td></tr>
<tr><td><strong>Лендинг</strong></td><td>квиз vs форма</td><td>CR, отказы</td></tr>
<tr><td><strong>Канал</strong></td><td>Яндекс / VK / Telegram</td><td>CPL, ROAS</td></tr>
</tbody></table></div>
      <div id="plan-30-dnej" class="vmp-sh vmp-left" style="margin-top:32px"><span class="vmp-eyebrow">Лид-магнит</span><h3>План рекламных тестов на 30 дней</h3><p>Шаблон, который Nero Network передаёт после диагностики.</p></div>
      <div class="vmp-table-wrap nero-ai-reveal"><table class="vmp-table"><thead><tr><th>Неделя</th><th>Действие</th><th>Бюджет</th><th>KPI</th><th>Решение</th></tr></thead><tbody>
<tr><td><strong>1</strong></td><td>Запуск 4–6 тестов</td><td>30–40%</td><td>CPL, CTR</td><td>Сбор данных</td></tr>
<tr><td><strong>2</strong></td><td>Stop/scale</td><td>15% перерасп.</td><td>CPL vs baseline</td><td>Стоп 🔴</td></tr>
<tr><td><strong>3</strong></td><td>Волна 2</td><td>30%</td><td>CR, CPA</td><td>Scale 🟢</td></tr>
<tr><td><strong>4</strong></td><td>Итог + цикл 2</td><td>20%+резерв</td><td>ROAS</td><td>Roadmap</td></tr>
</tbody></table></div>
      <div class="vmp-card nero-ai-reveal"><p><span class="zone-g">🟢 Зелёная</span> — KPI +15% → scale. <span class="zone-y">🟡 Жёлтая</span> — ±15% → доработка. <span class="zone-r">🔴 Красная</span> — −20% → stop. Кейс O'STIN: +35% установок, CPI −32% (источник: digital-digest.ru).</p></div>
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-plan-30">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получить план рекламных тестов на 30 дней</p>
          <p class="ym-cta-block__sub">Матрица гипотез, календарь запусков и KPI-зоны 🟢🟡🔴 — структура после диагностики Nero Network.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn" target="_blank" rel="noopener noreferrer"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Собрать медиаплан'); ?></a>
        </div>
      </aside>
    </div>
  </section>
  <section class="vmp-section vmp-section-alt" id="salesforce-2026">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">Инфоповод 2026</span>
        <h2>Salesforce State of Sales 2026: планирование — тактика роста после AI</h2>
      </div>
      <div class="vmp-sf-block nero-ai-reveal">
        <p>AI и AI-агенты — <strong>тактика №1</strong> роста в 2026. <strong>Sales planning — №2</strong>. <strong>91%</strong> sales-профи: AI помогает planning. <strong>16%</strong> времени — на планирование. <strong>51%</strong> лидеров страдают от tech silos.</p>
        <div class="vmp-table-wrap"><table class="vmp-table"><thead><tr><th>Факт</th><th>Значение</th><th>Применение</th></tr></thead><tbody>
<tr><td>AI + planning</td><td><strong>91%</strong></td><td>Мост sales → marketing</td></tr>
<tr><td>Время на planning</td><td><strong>16%</strong></td><td>Аргумент vs Excel</td></tr>
<tr><td>Tech silos</td><td><strong>51%</strong></td><td>Единый медiаплан + CRM</td></tr>
<tr><td>Data hygiene</td><td><strong>74%</strong></td><td>Подготовка данных</td></tr>
<tr><td>AI-агенты</td><td><strong>1,7× у лидеров</strong></td><td>Аргумент внедрения</td></tr>
</tbody></table></div>
        <p style="margin-top:16px">АРИР: <strong>47%</strong> оптимизируют бюджеты между каналами. Эффект: CTR +11%, CR +10%, CPA −16%.</p></div>
    </div>
  </section>
  <section class="vmp-section" id="vnedrenie">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">Пакет под ключ</span>
        <h2>Внедрение AI-медиаплана под ключ — что входит в пакет</h2>
        <p>Диагностика → гипотезы → медиаплан 30 дней → интеграции → сопровождение. Срок 3–5 недель. Чек 80–250 тыс. ₽.</p>
      </div>
      <div class="vmp-card nero-ai-reveal" id="audit"><h3>Аудит текущих кампаний и сбор данных</h3><p>Аудит Яндекс/VK/Telegram, Метрика, CRM. UTM, baseline KPI. Минимум: Метрика + кабинеты.</p></div>
      <div class="vmp-card nero-ai-reveal" id="generaciya"><h3>Генерация гипотез и медиаплана на месяц</h3><p>Промпт-конвейер → матрица. 15–25 гипотез, ICE/RICE. LLM + Make/n8n.</p></div>
      <div class="vmp-card nero-ai-reveal" id="process-testov"><h3>Настройка процесса тестов и отчётности</h3><p>CRM-интеграция, Telegram-алерты, обучение, контроль 1-го цикла.</p></div>
      <div class="vmp-table-wrap nero-ai-reveal"><table class="vmp-table"><thead><tr><th></th><th>SaaS</th><th>Агентство</th><th>Nero Network</th></tr></thead><tbody>
<tr><td>Скорость</td><td>5–10 мин</td><td>2–4 нед</td><td><strong>3–5 нед + интеграции</strong></td></tr>
<tr><td>AI-гипотезы</td><td>Без контекста</td><td>Редко</td><td><strong>На данных клиента</strong></td></tr>
<tr><td>CRM</td><td>Нет</td><td>Частично</td><td><strong>amoCRM, Bitrix24</strong></td></tr>
<tr><td>Календарь</td><td>Нет</td><td>8 нед (t4ka)</td><td><strong>30 дней + kill/scale</strong></td></tr>
<tr class="vmp-row-highlight"><td>Цена</td><td>~3 000 ₽</td><td>от 100k</td><td><strong>80–250 тыс. ₽</strong></td></tr>
</tbody></table></div>
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-vnedrenie">
        <div class="ym-cta-block__icon" aria-hidden="true">🚀</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Заказать внедрение AI-медиаплана под ключ</p>
          <p class="ym-cta-block__sub">Диагностика → матрица → календарь 30 дней → CRM и кабинеты → сопровождение. 80–250 тыс. ₽, 3–5 недель.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn" target="_blank" rel="noopener noreferrer"<?php echo $primary_cta_attrs; ?>>Собрать медиаплан</a>
        </div>
      </aside>
    </div>
  </section>
  <section class="vmp-section vmp-section-alt" id="integracii">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">Стек</span>
        <h2>Интеграции: CRM, Яндекс Директ, VK Реклама, Meta</h2>
      </div>
      <div class="vmp-int-row nero-ai-reveal">
        <span class="vmp-int-pill">Яндекс Директ</span>
        <span class="vmp-int-pill">VK Реклама</span>
        <span class="vmp-int-pill">Telegram Ads</span>
        <span class="vmp-int-pill">Meta</span>
        <span class="vmp-int-pill">amoCRM</span>
        <span class="vmp-int-pill">Bitrix24</span>
        <span class="vmp-int-pill">Метрика</span>
        <span class="vmp-int-pill">Make / n8n</span>
      </div>
      <div class="vmp-card nero-ai-reveal"><p>AI-медиаплан связывает <strong>гипотезу → канал → лид → сделку → следующую волну</strong>. 51% Salesforce про silos → единая схема с <strong>ai медиаплан интеграция crm</strong>.</p></div>
    </div>
  </section>
  <section class="vmp-section" id="dlya-kogo">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">Целевая аудитория</span>
        <h2>AI-медиаплан для маркетологов, агентств и собственников</h2>
      </div>
      <div class="vmp-grid-3 nero-ai-reveal">
        <div class="vmp-card"><div class="vmp-eyebrow">In-house</div><h3>Маркетолог</h3><p>Повторяемый процесс вместо хаоса. AI — гипотезы и отчёты, вы — стратегия.</p></div>
        <div class="vmp-card"><div class="vmp-eyebrow">Агентство</div><h3>Рекламное агентство</h3><p>Фреймворк для клиента: матрица, календарь, KPI-зоны. Медиаплан за дни, не недели.</p></div>
        <div class="vmp-card"><div class="vmp-eyebrow">SMB</div><h3>Собственник</h3><p>Понятный артефакт: что тестируем, сколько тратим, когда стоп. Human-in-the-loop.</p></div>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите разобраться в AI-медиапланировании сами?</p>
          <p class="ym-cta-block__sub">Если команда хочет понимать промпты, матрицу гипотез и no-code до старта — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label ?: 'обучение'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>
  <section class="vmp-section vmp-section-alt" id="keisy">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">Кейсы рынка</span>
        <h2>Примеры и кейсы: как выглядит план тестов на 30 дней</h2>
        <p>Публичные кейсы. Nero Network не присваивает себе чужие результаты.</p>
      </div>
      <div class="vmp-case-grid nero-ai-reveal">
        <div class="vmp-case"><div class="vmp-case-tag">O'STIN + TopTraffic</div><p>6 ИИ-агентов, KPI-зоны, Яндекс+VK. +35% установок, CPI −32%.</p><p style="font-size:12px;margin-top:8px">Источник: digital-digest.ru</p></div>
        <div class="vmp-case"><div class="vmp-case-tag">i-Media + Яндекс Пэй</div><p>B2B-смежные сегменты в Директе. CPL −50%, CR ×10.</p><p style="font-size:12px;margin-top:8px">Источник: adindex.ru</p></div>
        <div class="vmp-case"><div class="vmp-case-tag">АРИР/АЦ РИР</div><p>48% AI/ML; 47% — бюджеты между каналами.</p><p style="font-size:12px;margin-top:8px">Источник: interactivead.ru</p></div>
        <div class="vmp-case"><div class="vmp-case-tag">WPP + Google</div><p>Pre-launch симуляция гипотез (enterprise-ориентир).</p><p style="font-size:12px;margin-top:8px">Источник: wpp.com</p></div>
      </div>
    </div>
  </section>
  <section class="vmp-section" id="ceny">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">Цены</span>
        <h2>Стоимость и сроки внедрения AI-медиаплана</h2>
        <p>Ориентир Nero Network: 80–250 тыс. ₽.</p>
      </div>
      <div class="vmp-pricing nero-ai-reveal">
        <div class="vmp-price-card"><div class="tag">Старт</div><div class="price">80–120 тыс. ₽</div><p>Аудит + матрица + план 30 дней</p><p style="font-size:13px;margin-top:12px">Срок: 1–2 недели</p></div>
        <div class="vmp-price-card featured"><div class="tag">Стандарт</div><div class="price">120–180 тыс. ₽</div><p>+ CRM/кабинеты + отчёты</p><p style="font-size:13px;margin-top:12px">Срок: 3–4 недели</p></div>
        <div class="vmp-price-card"><div class="tag">Полный</div><div class="price">180–250 тыс. ₽</div><p>+ 1-й цикл + Telegram + обучение</p><p style="font-size:13px;margin-top:12px">Срок: 4–5 недель</p></div>
      </div>
      <div class="vmp-inline-cta nero-ai-reveal"><a href="#cta">Узнать точную стоимость под ваш проект →</a></div>
    </div>
  </section>
  <section class="vmp-section vmp-section-alt" id="faq">
    <div class="vmp-cnt">
      <div class="vmp-sh nero-ai-reveal">
        <span class="vmp-eyebrow">FAQ</span>
        <h2>FAQ: внедрение без программиста, сроки, отличие от «нейросеть для рекламы»</h2>
      </div>
      <div class="vmp-faq nero-ai-reveal">
        <div class="vmp-faq-item"><h3>Как внедрить ai медиаплан?</h3><p>Бриф → аудит → матрица → календарь 30 дней → интеграции. Nero выполняет под ключ.</p></div>
        <div class="vmp-faq-item"><h3>Сколько стоит ai медиаплан?</h3><p>Ориентир 80–250 тыс. ₽. Смета после диагностики.</p></div>
        <div class="vmp-faq-item"><h3>Можно ли без программиста?</h3><p>Да. Make/n8n на стороне внедрения; клиенту программист не нужен.</p></div>
        <div class="vmp-faq-item"><h3>Отличие от «нейросеть для рекламы»?</h3><p>Нейросеть — генерация. AI-медиаплан — процесс: гипотезы + календарь + KPI + CRM.</p></div>
        <div class="vmp-faq-item"><h3>Нужна ли CRM?</h3><p>Желательна на этапе 2. Минимум: Метрика + кабинеты.</p></div>
        <div class="vmp-faq-item"><h3>Какие данные нужны для запуска?</h3><p>Цели и KPI, бюджет на 30+ дней, описание продукта и ЦА, конкуренты, доступ к кабинетам и аналитике, история креативов.</p></div>
        <div class="vmp-faq-item"><h3>AI сам всё настроит — зачем платить?</h3><p>SaaS не подключает кабинеты и не сопровождает 1-й цикл. Кейс O'STIN: человек принимает финальные решения — AI ускоряет.</p></div>
        <div class="vmp-faq-item"><h3>Только Яндекс или мультиканал?</h3><p>Матрица каналов: Яндекс (спрос) + VK (охват) + Telegram (ниша). Состав зависит от ЦА и бюджета.</p></div>
        <div class="vmp-faq-item"><h3>Какие сроки?</h3><p>Диагностика 1–2 дня. Внедрение 3–5 недель. Первый цикл — 30 дней.</p></div>
        <div class="vmp-faq-item"><h3>Что остаётся за маркетологом?</h3><p>Утверждение бюджета и гипотез, бренд-комплаенс, финальные креативы, стратегические решения при конфликте данных.</p></div>
      </div>
    </div>
  </section>
  <section class="vmp-section" id="cta">
    <div class="vmp-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Собрать AI-медиаплан — заявка на внедрение</p>
          <p class="ym-cta-block__sub">Матрица гипотез, календарь 30 дней, CRM и кабинеты, сопровождение 1-го цикла. Чек 80–250 тыс. ₽.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer"<?php echo $primary_cta_attrs; ?>>Собрать медиаплан</a>
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost" target="_blank" rel="noopener noreferrer"<?php echo $primary_cta_attrs; ?>>Получить план тестов на 30 дней</a>
          </div></div></div>
      <!-- AD_BANNER: вставить #ad-banner перед get_footer() когда env заполнен (Артур) -->
    </div>
  </section>
</div>
<!-- INTERNAL-LINKS:INSERT -->
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
