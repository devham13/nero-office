<?php
/**
 * Template Name: Внедрение AI в бизнес под ключ: аудит, KPI и цена
 * Description: SEO-лендинг — внедрение AI в бизнес под ключ. AI-аудит, agentic-решения, кейсы, этапы и стоимость для МСБ.
 */

$page_seo_title       = 'Внедрение AI в бизнес под ключ: аудит, KPI и цена';
$page_seo_description = 'Внедрение AI в бизнес под ключ: AI-аудит процессов, точки быстрого эффекта и agentic-решения с понятным KPI. Кейсы, этапы и стоимость для МСБ. Получите план внедрения.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
	echo '<meta property="og:type" content="article" />' . "\n";
}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Услуга под ключ', 'href' => '#pod-klyuch'],
    ['label' => 'AI-аудит', 'href' => '#audit'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'AI-агенты', 'href' => '#agenty'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$hero_eyebrow = $brand . ' · внедрение AI под ключ';
$hero_title = 'Внедрение AI в бизнес под ключ: аудит, KPI и agentic-решения';
$hero_lead = 'Проведём AI-аудит процессов, выберем точки быстрого эффекта и внедрим решения с понятным KPI — без бесконечных пилотов';
$hero_badges = ['AI-аудит', 'KPI-рамка', 'Agentic AI', '4–8 недель пилот'];
$hero_primary_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить план внедрения';
$hero_primary_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$hero_primary_attrs = nero_ai_primary_cta_link_attrs($hero_primary_url);
$hero_secondary_label = 'AI-аудит процессов';
$hero_secondary_url = '#audit';
$hero_dashboard_title = 'AI-операционный центр';
$hero_dashboard_note = 'пример логики внедрения AI · демонстрационные данные';
$hero_metrics = [
    ['value' => '71% → 4%', 'label' => 'пробуют GenAI / довели до конца', 'small' => 'разрыв 2026'],
    ['value' => '4–8 нед.', 'label' => 'пилот под ключ до первых KPI', 'small' => 'PoC → production'],
    ['value' => '250K–3M ₽', 'label' => 'ориентир чека для МСБ', 'small' => 'аудит + пилот'],
    ['value' => 'RAI 2.3', 'label' => 'зрелость governance agentic AI', 'small' => 'McKinsey 2026'],
];

$primary_cta_label = $hero_primary_label;
$primary_cta_url = $hero_primary_url;
$primary_cta_attrs = $hero_primary_attrs;
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '';

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

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

<style>
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header {
  display: none !important;
}
body.nero-ai-landing {
  padding-top: 0 !important;
}

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

.vaibk-hero-ai-biznes.nero-ai-hero,
section.vaibk-hero-ai-biznes {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.nero-ai-reveal{
  opacity:0;transform:translateY(22px);
  transition:opacity .55s ease,transform .55s ease;
}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.nero-ai-delay-3{transition-delay:.36s;}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-v-biznes-pod-klyuch-page" role="main" tabindex="-1">

<section class="nero-ai-hero vaibk-hero-ai-biznes" id="vaibk-hero-ai-biznes" aria-labelledby="vaibk-hero-title">
<style>
/* Hero vaibk — самодостаточные стили (эталон главной WP / .nero-ai-home-page) */
.vaibk-hero-ai-biznes {
  --vaibk-cyan: #79f2ff;
  --vaibk-violet: #8b5cf6;
  --vaibk-green: #22c55e;
  --vaibk-amber: #fbbf24;
  --vaibk-text: #e6edf7;
  --vaibk-muted: #9aa8bd;
  --vaibk-soft: #c7d2e5;
  --vaibk-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vaibk-hero-ai-biznes::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vaibk-hero-ai-biznes::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121,242,255,.12), transparent 66%);
  filter: blur(8px);
  animation: vaibkHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vaibkHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.vaibk-hero-ai-biznes .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vaibk-hero-ai-biznes .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vaibk-hero-ai-biznes .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vaibk-hero-ai-biznes .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vaibk-cyan) 44%, var(--vaibk-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vaibk-hero-ai-biznes .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121,242,255,.22);
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  color: var(--vaibk-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.vaibk-hero-ai-biznes .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vaibk-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vaibk-hero-ai-biznes .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vaibk-hero-ai-biznes .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.vaibk-hero-ai-biznes .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vaibk-hero-ai-biznes .nero-ai-btn {
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
  transition: transform .22s ease;
}
.vaibk-hero-ai-biznes .nero-ai-btn:hover { transform: translateY(-2px); }
.vaibk-hero-ai-biznes .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  box-shadow: 0 18px 42px rgba(59,130,246,.28);
}
.vaibk-hero-ai-biznes .nero-ai-btn-secondary {
  color: var(--vaibk-text) !important;
  background: rgba(255,255,255,.07);
  border-color: rgba(255,255,255,.14);
}
.vaibk-hero-ai-biznes .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2,6,23,.42);
  box-shadow: var(--vaibk-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.vaibk-hero-ai-biznes .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15,23,42,.95), rgba(6,10,24,.96));
}
.vaibk-hero-ai-biznes .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vaibk-hero-ai-biznes .nero-ai-dots { display: flex; gap: 7px; }
.vaibk-hero-ai-biznes .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vaibk-hero-ai-biznes .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vaibk-hero-ai-biznes .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vaibk-hero-ai-biznes .nero-ai-dot:nth-child(3) { background: #34d399; }
.vaibk-hero-ai-biznes .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vaibk-hero-ai-biznes .nero-ai-window-body { padding: 16px; }
.vaibk-hero-ai-biznes .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vaibk-hero-ai-biznes .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vaibk-hero-ai-biznes .nero-ai-live-pill {
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
.vaibk-hero-ai-biznes .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vaibkPulse 1.6s infinite;
}
@keyframes vaibkPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vaibk-hero-ai-biznes .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vaibk-hero-ai-biznes .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vaibk-hero-ai-biznes .nero-ai-metric span {
  display: block;
  color: var(--vaibk-muted);
  font-size: 11px;
  font-weight: 700;
}
.vaibk-hero-ai-biznes .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vaibk-hero-ai-biznes .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vaibk-hero-ai-biznes .vaibk-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121,242,255,.14);
  background: radial-gradient(ellipse at 50% 42%, rgba(139,92,246,.10), rgba(6,10,24,.92) 72%);
}
.vaibk-hero-ai-biznes #vaibk-ai-command-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vaibk-hero-ai-biznes .nero-ai-task-stream { display: grid; gap: 8px; }
.vaibk-hero-ai-biznes .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vaibk-hero-ai-biznes .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vaibk-cyan);
  font-size: 13px;
  font-weight: 800;
}
.vaibk-hero-ai-biznes .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vaibk-hero-ai-biznes .nero-ai-task span {
  display: block;
  color: var(--vaibk-muted);
  font-size: 11px;
  margin-top: 2px;
}
.vaibk-hero-ai-biznes .nero-ai-status {
  font-size: 11px;
  font-weight: 800;
  color: var(--vaibk-green);
  text-transform: lowercase;
}
.vaibk-hero-ai-biznes .nero-ai-status--amber { color: var(--vaibk-amber); }
@media (max-width: 1023px) {
  .vaibk-hero-ai-biznes .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vaibk-hero-ai-biznes .nero-ai-dashboard { transform: none; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
    <h1 id="vaibk-hero-title">Внедрение AI в бизнес под ключ: <span class="nero-ai-gradient-text">аудит, KPI и agentic-решения</span></h1>
    <p class="nero-ai-hero-lead"><?php echo esc_html($hero_lead); ?></p>
    <ul class="nero-ai-badges" aria-label="Ключевые этапы">
      <?php foreach ($hero_badges as $badge) : ?>
        <li class="nero-ai-badge"><?php echo esc_html($badge); ?></li>
      <?php endforeach; ?>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($hero_primary_url); ?>"<?php echo $hero_primary_attrs; ?>><?php echo esc_html($hero_primary_label); ?></a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($hero_secondary_url); ?>"><?php echo esc_html($hero_secondary_label); ?></a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация AI-операционного центра внедрения">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title"><?php echo esc_html($hero_dashboard_note); ?></span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3><?php echo esc_html($hero_dashboard_title); ?></h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <?php foreach ($hero_metrics as $metric) : ?>
            <div class="nero-ai-metric">
              <span><?php echo esc_html((string) ($metric['label'] ?? '')); ?></span>
              <strong><?php echo esc_html((string) ($metric['value'] ?? '')); ?></strong>
              <?php if (!empty($metric['small'])) : ?>
                <small><?php echo esc_html((string) $metric['small']); ?></small>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="vaibk-dash-canvas-wrap" aria-hidden="false">
          <canvas id="vaibk-ai-command-canvas" role="img" aria-label="Анимация: AI-аудит процессов, приоритизация пилотов, agentic-workflow и KPI-пульс внедрения под ключ"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента событий внедрения">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">◎</span>
            <div><strong>AI-аудит процессов</strong><span>Shortlist 3 пилота · baseline KPI</span></div>
            <span class="nero-ai-status">audit</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">⚡</span>
            <div><strong>Agentic-workflow</strong><span>Поддержка → CRM → задача менеджеру</span></div>
            <span class="nero-ai-status">live</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">↗</span>
            <div><strong>KPI: время ответа</strong><span>4 ч → 15 мин · shadow-mode</span></div>
            <span class="nero-ai-status">+ROI</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">🛡</span>
            <div><strong>Human-in-the-loop</strong><span>Эскалация директору · логи агента</span></div>
            <span class="nero-ai-status nero-ai-status--amber">review</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<style>
/* === БОРИС: prefix bpk-, scoped внутри .bpk-content и #vnedrenie-ai-v-biznes-pod-klyuch-boris-block === */
.bpk-content{
  --bpk-bg:#050711;--bpk-bg2:#080b17;--bpk-bg3:#0a0e1c;
  --bpk-surface:rgba(255,255,255,.072);--bpk-surface2:rgba(255,255,255,.108);
  --bpk-text:#e6edf7;--bpk-muted:#9aa8bd;--bpk-soft:#c7d2e5;--bpk-heading:#fff;
  --bpk-border:rgba(255,255,255,.10);--bpk-border-s:rgba(255,255,255,.18);
  --bpk-accent:#79f2ff;--bpk-violet:#8b5cf6;--bpk-green:#22c55e;--bpk-cyan:#38bdf8;
  --bpk-btn-from:#2563eb;--bpk-btn-to:#7c3aed;
  --bpk-r:18px;--bpk-r-lg:24px;--bpk-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--bpk-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.bpk-content *,.bpk-content *::before,.bpk-content *::after{box-sizing:border-box;}
.bpk-content a{color:inherit;text-decoration:none;}
.bpk-content p{color:var(--bpk-muted);line-height:1.72;margin:0 0 1em;}
.bpk-content p:last-child{margin-bottom:0;}
.bpk-content h2,.bpk-content h3,.bpk-content h4{color:var(--bpk-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.bpk-content strong{color:var(--bpk-soft);}
.bpk-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.bpk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--bpk-muted);font-size:14.5px;line-height:1.65;}
.bpk-content ul li::before{content:'›';position:absolute;left:0;color:var(--bpk-accent);font-weight:700;}
.bpk-cnt{width:min(var(--bpk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.bpk-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.bpk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.bpk-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.bpk-sh.bpk-left{margin-left:0;text-align:left;}
.bpk-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.bpk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.bpk-sh.bpk-left p{margin-left:0;}
.bpk-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--bpk-accent);margin-bottom:14px;}
.bpk-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.bpk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.bpk-intro-text{position:relative;padding-left:20px;}
.bpk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--bpk-accent),var(--bpk-violet));}
.bpk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--bpk-muted);margin-bottom:1em;}
.bpk-intro-text p:last-child{margin-bottom:0;color:var(--bpk-soft);}
.bpk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.bpk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.bpk-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--bpk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.bpk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--bpk-muted);line-height:1.4;}
.bpk-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.bpk-intro-grid{grid-template-columns:1fr;gap:36px;}.bpk-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.bpk-intro-kpi{grid-template-columns:1fr 1fr;}}
.bpk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.bpk-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.bpk-toc a{display:inline-block;padding:9px 18px;background:var(--bpk-surface);border:1px solid var(--bpk-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--bpk-muted);transition:border-color .2s,color .2s,background .2s;}
.bpk-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--bpk-accent);background:rgba(121,242,255,.08);}
.bpk-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--bpk-border);border-radius:var(--bpk-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.bpk-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.bpk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.bpk-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.bpk-grid-2,.bpk-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.bpk-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.bpk-grid-3{grid-template-columns:1fr;}}
.bpk-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--bpk-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.bpk-scenario:last-child{margin-bottom:0;}
.bpk-scenario:hover{border-color:rgba(121,242,255,.3);}
.bpk-scenario h3{font-size:17px;margin-bottom:8px;}
.bpk-scenario p{font-size:14.5px;margin:0 0 .6em;}
.bpk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.bpk-table{width:100%;border-collapse:collapse;font-size:14px;}
.bpk-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--bpk-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.bpk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--bpk-text);vertical-align:top;}
.bpk-table tr:last-child td{border-bottom:none;}
.bpk-table tr:hover td{background:rgba(255,255,255,.03);}
.bpk-timeline{position:relative;padding-left:40px;}
.bpk-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--bpk-accent),var(--bpk-violet));opacity:.35;border-radius:2px;}
.bpk-tl-item{position:relative;margin-bottom:32px;}
.bpk-tl-item:last-child{margin-bottom:0;}
.bpk-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--bpk-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.bpk-tl-item h3{font-size:17px;margin-bottom:8px;}
.bpk-tl-item p{font-size:14.5px;margin:0;}
.bpk-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.bpk-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.bpk-case-grid{grid-template-columns:1fr;}}
.bpk-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.bpk-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.bpk-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--bpk-green);margin-bottom:10px;}
.bpk-case-card h3{font-size:16px;margin-bottom:14px;}
.bpk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.bpk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.bpk-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--bpk-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.bpk-faq-q::after{content:'▾';font-size:13px;color:var(--bpk-accent);flex-shrink:0;transition:transform .25s;}
.bpk-faq-item.open .bpk-faq-q::after{transform:rotate(180deg);}
.bpk-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--bpk-muted);line-height:1.72;}
.bpk-faq-item.open .bpk-faq-a{max-height:600px;padding:0 24px 20px;}
.bpk-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.bpk-content .ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.bpk-content .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.bpk-content .ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.bpk-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.bpk-content .ym-cta-block__sub{color:var(--bpk-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.bpk-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.bpk-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.bpk-content .ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.bpk-content .ym-btn:hover{transform:translateY(-2px);}
.bpk-content .ym-btn--accent,.bpk-content .nero-ai-btn-primary{background:linear-gradient(135deg,var(--bpk-btn-from),var(--bpk-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.bpk-content .ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--bpk-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.bpk-content .ym-link--accent{color:var(--bpk-accent)!important;text-decoration:underline!important;}
@media(max-width:600px){.bpk-content .ym-cta-block{padding:28px 20px;}}
</style>

<div class="bpk-content">

  <section class="bpk-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="bpk-cnt">
      <div class="bpk-intro-grid nero-ai-reveal">
        <div class="bpk-intro-text">
          <p class="bpk-eyebrow">Лонгрид · внедрение AI под ключ</p>
          <p><strong>Коротко:</strong> внедрение AI в бизнес под ключ в 2026 году — это не подписка на ChatGPT для сотрудников, а управляемый проект: AI-аудит процессов → выбор 1–2 точек быстрого эффекта → пилот с human-in-the-loop → интеграции с CRM и учётными системами → масштабирование с понятным KPI.</p>
          <p>По данным «Яков и Партнёры», <strong>71% российских компаний</strong> уже применяют генеративный ИИ хотя бы в одной функции, но <strong>только 4%</strong> довели хотя бы один кейс до полного внедрения. Разрыв объясняется не «слабой моделью», а отсутствием процесса: аудита, метрик, интеграций и governance.</p>
        </div>
        <div class="bpk-intro-kpi" aria-label="Ключевые метрики рынка">
          <div class="bpk-kpi-card"><div class="kv">71% → 4%</div><div class="kl">пробуют GenAI / довели до конца</div><div class="ks">Яков и Партнёры</div></div>
          <div class="bpk-kpi-card"><div class="kv">4–8 нед.</div><div class="kl">пилот под ключ до первых KPI</div><div class="ks">Nero Network</div></div>
          <div class="bpk-kpi-card"><div class="kv">250K–3M ₽</div><div class="kl">ориентир чека для МСБ</div><div class="ks">коммерческая модель</div></div>
          <div class="bpk-kpi-card"><div class="kv">RAI 2.3</div><div class="kl">зрелость governance AI</div><div class="ks">McKinsey 2026</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="bpk-toc-outer">
    <div class="bpk-cnt">
      <nav class="bpk-toc" aria-label="Оглавление статьи">
        <a href="#pod-klyuch">Услуга под ключ</a>
        <a href="#audit">AI-аудит</a>
        <a href="#etapy">Этапы</a>
        <a href="#agenty">AI-агенты</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#rezultat">Результат</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="bpk-section" id="pod-klyuch">
    <div class="bpk-cnt">
      <div class="bpk-sh">
        <span class="bpk-eyebrow">Зонтичная услуга</span>
        <h2>Внедрение AI в бизнес — что входит в услугу «под ключ»</h2>
        <p><strong>Определение:</strong> услуга «AI-внедрение под ключ» — полный цикл: диагностика процессов, проектирование agentic-сценария, разработка, интеграция с CRM/ERP/каналами, production с контролем качества и отчётность по KPI.</p>
      </div>

      <div class="bpk-grid-3 nero-ai-reveal">
        <div class="bpk-card">
          <h3>Почему бизнес слышит про AI, но не видит быстрого эффекта</h3>
          <p>AI не встроен в CRM, телефонию, почту и документооборот — остаётся «чат сбоку». Нет baseline-метрик «до» и критериев успеха пилота. Только <strong>26% компаний с бюджетом на AI</strong> имеют стратегию внедрения (Ведомости, 2026).</p>
        </div>
        <div class="bpk-card nero-ai-delay-1">
          <h3>95% выгоды не получили</h3>
          <p>«В 2024 году компании покупали ИИ, чтобы успеть запрыгнуть в уходящий поезд. В 2026-м — чтобы получить выгоду» — <a href="https://companies.rbc.ru/news/YrC5rh4JgK/kak-malomu-i-srednemu-biznesu-vnedrit-ii-i-ne-poteryat-byudzhet/" target="_blank" rel="noopener noreferrer">РБК Компании</a>. Разница — в процессах и владельце метрик.</p>
        </div>
        <div class="bpk-card nero-ai-delay-2">
          <h3>Под ключ vs разрозненные пилоты</h3>
          <p>Под ключ — связанная система «агент + процессы + KPI»: заявка → квалификация → CRM → задача менеджеру → контроль SLA → отчёт руководителю. Не один чат-бот, а оркестрация.</p>
        </div>
      </div>

      <div class="bpk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="bpk-table">
          <thead><tr><th>Критерий</th><th>Разрозненные пилоты</th><th>Внедрение под ключ</th></tr></thead>
          <tbody>
            <tr><td>Старт</td><td>«Купим ChatGPT Team»</td><td>AI-аудит процессов и shortlist пилотов</td></tr>
            <tr><td>Интеграции</td><td>Копирование текста вручную</td><td>CRM, email, Telegram, 1С через API/Make/n8n</td></tr>
            <tr><td>Метрики</td><td>«Кажется, стало быстрее»</td><td>Время ответа, стоимость операции, % автозакрытия</td></tr>
            <tr><td>Срок эффекта</td><td>Неопределён</td><td>Первый measurable результат за 4–8 недель</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="bpk-section bpk-section-alt" id="audit">
    <div class="bpk-cnt">
      <div class="bpk-sh">
        <span class="bpk-eyebrow">Лид-магнит</span>
        <h2>AI-аудит процессов: первый шаг внедрения</h2>
        <p>Deliverable за 1–2 недели: карта процессов, baseline-метрики и shortlist 1–3 пилотов с прогнозом KPI. PhaseLink называет «building before auditing» главной ошибкой внедрения.</p>
      </div>

      <div class="bpk-grid-2 nero-ai-reveal">
        <div class="bpk-card">
          <h3>Какие процессы проверяем в первую очередь</h3>
          <ul>
            <li>Входящие заявки и лиды — сайт, мессенджеры, звонки</li>
            <li>Клиентская поддержка — FAQ, статусы, типовые инциденты</li>
            <li>Документооборот — накладные, КП, договоры</li>
            <li>Email → CRM — разбор почты, создание сделок</li>
            <li>Продажи — квалификация, follow-up, черновики КП</li>
          </ul>
        </div>
        <div class="bpk-card nero-ai-delay-1">
          <h3>KPI аудита: что измеряем до и после</h3>
          <div class="bpk-table-wrap" style="margin:0;">
            <table class="bpk-table">
              <thead><tr><th>Метрика</th><th>Пример «до → после»</th></tr></thead>
              <tbody>
                <tr><td>Время ответа</td><td>4 часа → 15 минут</td></tr>
                <tr><td>% автозакрытия</td><td>52% обращений IT-поддержки</td></tr>
                <tr><td>Error rate</td><td>−92% в документообороте</td></tr>
                <tr><td>FTE-экономия</td><td>~4 ч/день → ~1,5 ч на типовых задачах</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- === БОРИС CANVAS: после #audit, перед #cta-audit === -->
  <section id="vnedrenie-ai-v-biznes-pod-klyuch-boris-block" class="bpk-boris-root" aria-label="Анимация: AI-аудит → agentic-workflow → дашборд KPI пилота">
<style>
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block.bpk-boris-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#6366f1;margin:0 0 14px;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-ey::before{
  content:'';width:18px;height:2px;background:#6366f1;border-radius:1px;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;
  line-height:1.28;margin:0 0 18px;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-ul{
  list-style:none;margin:0 0 22px;padding:0;
  display:flex;flex-direction:column;gap:9px;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-ul li{
  display:flex;align-items:flex-start;gap:10px;
  font-size:14px;line-height:1.5;color:#334155;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(99,102,241,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#6366f1;margin-top:1px;font-style:normal;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-pills{
  display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-pl-v{background:rgba(99,102,241,.08);color:#4338ca;border:1.5px solid rgba(99,102,241,.22);}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-pl-c{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22);}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-foot{
  font-size:13px;color:#64748b;font-style:italic;margin:0;
}
#vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-rgt{
  position:relative;
  background:linear-gradient(135deg,#eef2ff 0%,#e0f2fe 40%,#f0fdf4 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-v-biznes-pod-klyuch-boris-block .bpk-b-rgt{min-height:380px;}
}
#bpk-pilot-pipeline-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="bpk-b-cnt">
  <div class="bpk-b-card">
    <div class="bpk-b-lft">
      <span class="bpk-b-ey">KPI-мост пилота</span>
      <h3 class="bpk-b-h3">От AI-аудита к agentic-workflow: процессы → агент → метрики «до/после»</h3>
      <ul class="bpk-b-ul">
        <li><span class="bpk-b-ic">1</span>Аудит приоритизирует 1–2 процесса с высоким ROI/час и data readiness</li>
        <li><span class="bpk-b-ic">2</span>Agentic AI связывает CRM, email, Telegram и Make/n8n/MCP</li>
        <li><span class="bpk-b-ic">3</span>Shadow-mode 1–2 недели: human-in-the-loop и логи каждого действия</li>
        <li><span class="bpk-b-ic">✓</span>Production: дашборд KPI — время ответа, % автозакрытия, стоимость операции</li>
      </ul>
      <div class="bpk-b-pills">
        <span class="bpk-b-pl bpk-b-pl-v">4–8 нед. пилот</span>
        <span class="bpk-b-pl bpk-b-pl-g">52% автозакрытия</span>
        <span class="bpk-b-pl bpk-b-pl-c">RAI 2.3 → governance</span>
      </div>
      <p class="bpk-b-foot">Дальше разберём этапы внедрения AI в бизнес-процессы и roadmap 30/60/90 →</p>
    </div>
    <div class="bpk-b-rgt">
      <canvas id="bpk-pilot-pipeline-canvas" role="img" aria-label="Анимация: процессы проходят через AI-агента к дашборду KPI пилота внедрения"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bpk-pilot-pipeline-canvas');
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
    ink:'#0f172a', muted:'#64748b', white:'#ffffff',
    audit:'#6366f1', auditGlow:'rgba(99,102,241,.15)',
    agent:'#8b5cf6', agentGlow:'rgba(139,92,246,.2)',
    kpi:'#0ea5e9', green:'#22c55e', orange:'#f59e0b',
    line:'rgba(99,102,241,.35)', dashBg:'rgba(255,255,255,.85)'
  };

  var PROCS = [
    {label:'Лиды', icon:'IN', color:C.orange, delay:0},
    {label:'Поддержка', icon:'?', color:C.kpi, delay:120},
    {label:'Документы', icon:'DOC', color:C.green, delay:240},
    {label:'Email→CRM', icon:'@', color:C.audit, delay:360}
  ];
  var LOOP = 720;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawAuditPanel(x,y,w,h,pulse){
    rr(x,y,w,h,12,C.auditGlow,C.audit,2);
    ctx.fillStyle=C.audit;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI-аудит',x+w/2,y+20);
    var items=['Карта процессов','Baseline KPI','Shortlist пилотов'];
    items.forEach(function(t,i){
      var iy=y+36+i*28;
      var chk=(pulse+i*40)%180<120;
      rr(x+10,iy,w-20,22,6,chk?'rgba(34,197,94,.12)':'rgba(255,255,255,.6)',chk?C.green:'#cbd5e1',1);
      ctx.fillStyle=chk?C.green:C.muted;
      ctx.font=(chk?'bold ':'')+'9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText((chk?'✓ ':'○ ')+t,x+18,iy+14);
    });
  }

  function drawAgentHub(cx,cy,r,pulse){
    ctx.beginPath();
    ctx.arc(cx,cy,r,0,Math.PI*2);
    ctx.fillStyle=C.agentGlow;
    ctx.fill();
    ctx.strokeStyle=C.agent;
    ctx.lineWidth=2.5;
    ctx.stroke();
    for(var i=0;i<6;i++){
      var ang=(i/6)*Math.PI*2+pulse*0.04;
      ctx.beginPath();
      ctx.arc(cx+Math.cos(ang)*(r+14),cy+Math.sin(ang)*(r+14),4,0,Math.PI*2);
      ctx.fillStyle=C.agent;
      ctx.fill();
    }
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Agent',cx,cy+4);
    ctx.fillStyle=C.muted;
    ctx.font='8px Inter,sans-serif';
    ctx.fillText('MCP·Make',cx,cy+16);
  }

  function drawKpiDash(x,y,w,h,t){
    rr(x,y,w,h,12,C.dashBg,'#cbd5e1',1);
    ctx.fillStyle=C.ink;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('KPI пилота · live',x+12,y+20);
    var metrics=[
      {l:'Время ответа',v:'4ч→15м',p:0.82,c:C.green},
      {l:'Автозакрытие',v:'52%',p:0.52,c:C.kpi},
      {l:'Стоимость оп.',v:'−38%',p:0.65,c:C.orange}
    ];
    metrics.forEach(function(m,i){
      var my=y+32+i*42;
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText(m.l,x+12,my);
      ctx.fillStyle=C.ink;
      ctx.font='bold 12px Inter,sans-serif';
      ctx.textAlign='right';
      ctx.fillText(m.v,x+w-12,my);
      var prog=Math.min(1,((t+i*60)%240)/240)*m.p;
      rr(x+12,my+6,w-24,5,3,'#e2e8f0',null,0);
      rr(x+12,my+6,(w-24)*prog,5,3,m.c,null,0);
      ctx.textAlign='left';
    });
  }

  function drawProcChip(x,y,proc,alpha){
    ctx.globalAlpha=alpha||1;
    rr(x,y,72,52,8,C.white,'#cbd5e1',1);
    ctx.fillStyle=proc.color;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(proc.icon,x+36,y+22);
    ctx.fillStyle=C.ink;
    ctx.font='8px Inter,sans-serif';
    ctx.fillText(proc.label,x+36,y+38);
    ctx.globalAlpha=1;
  }

  function drawFlowLine(x1,y1,x2,y2,alpha,dashOff){
    ctx.globalAlpha=alpha||0.6;
    ctx.strokeStyle=C.line;
    ctx.lineWidth=1.5;
    ctx.setLineDash([5,5]);
    ctx.lineDashOffset=-dashOff;
    ctx.beginPath();
    ctx.moveTo(x1,y1);ctx.lineTo(x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);

    var pad=16;
    var auditW=Math.min(118,W*0.22);
    var auditH=Math.min(130,H*0.38);
    var auditX=pad;
    var auditY=H*0.5-auditH/2;
    var agentR=Math.min(36,W*0.06);
    var agentX=W*0.46;
    var agentY=H*0.5;
    var dashW=Math.min(150,W*0.26);
    var dashH=Math.min(170,H*0.52);
    var dashX=W-dashW-pad;
    var dashY=H*0.5-dashH/2;

    drawAuditPanel(auditX,auditY,auditW,auditH,frame);
    drawAgentHub(agentX,agentY,agentR,frame);
    drawKpiDash(dashX,dashY,dashW,dashH,t);

    drawFlowLine(auditX+auditW,auditY+auditH/2,agentX-agentR-8,agentY,0.5,frame*0.5);
    drawFlowLine(agentX+agentR+8,agentY,dashX,dashY+dashH/2,0.5,frame*0.5);

    PROCS.forEach(function(proc){
      var localT=(t-proc.delay+LOOP)%LOOP;
      if(localT>LOOP-60) return;
      var prog=Math.min(1,localT/280);
      var startX=auditX+auditW/2-36;
      var endX=agentX-agentR-40;
      var px=startX+(endX-startX)*prog;
      var py=auditY+auditH+8+Math.sin(prog*Math.PI)*-18;
      var alpha=prog<0.92?1:Math.max(0,1-(localT-260)/20);
      if(prog>0.55){
        var pp=(prog-0.55)/0.45;
        px=endX+(agentX+agentR+20-endX)*pp;
        py=agentY-26+Math.sin(pp*Math.PI)*-12;
      }
      drawProcChip(px,py,proc,alpha);
    });

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Аудит',auditX,auditY-8);
    ctx.textAlign='center';
    ctx.fillText('Agentic workflow',agentX,H-pad);
    ctx.textAlign='right';
    ctx.fillText('KPI «до/после»',dashX+dashW,dashY-8);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>

  <div class="bpk-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit">
      <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите AI-аудит процессов и план внедрения</p>
        <p class="ym-cta-block__sub">За 1–2 недели составим карту процессов, baseline-метрики и shortlist 1–3 пилотов с прогнозом KPI. На выходе — документ «что автоматизировать первым» и вилка бюджета 250 тыс.–3 млн ₽ — без обязательств по пилоту.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <section class="bpk-section" id="etapy">
    <div class="bpk-cnt">
      <div class="bpk-sh bpk-left">
        <span class="bpk-eyebrow">Roadmap</span>
        <h2>Этапы внедрения AI в бизнес-процессы</h2>
        <p>Пять этапов Nero Network — ответ на запрос «как внедрить AI в бизнес» без бесконечных стратегических сессий.</p>
        <!-- INTERNAL-LINKS:INSERT -->
      </div>

      <div class="bpk-card nero-ai-reveal">
        <div class="bpk-timeline">
          <div class="bpk-tl-item"><div class="bpk-tl-dot"></div><h3>Диагностика и выбор 2–3 кейсов с быстрым ROI</h3><p>После аудита — 1–2 кейса с максимальным ROI/час. Методология МСБ: «одна болевая точка → 30–60 дней → масштабирование».</p></div>
          <div class="bpk-tl-item"><div class="bpk-tl-dot"></div><h3>Пилот за 2–4 недели и масштабирование</h3><p><strong>0–30 дней:</strong> AI-аудит, PoC, shadow-mode. <strong>30–60:</strong> пилот одного workflow. <strong>60–90:</strong> rollout, дашборд KPI, AI champions.</p></div>
          <div class="bpk-tl-item"><div class="bpk-tl-dot"></div><h3>Интеграция с CRM, ERP и документооборотом</h3><p>amoCRM, Bitrix24, 1С, Telegram, email, телефония. Оркестрация: Make.com, n8n, MCP-серверы. McKinsey 2026: RAI maturity <strong>2,3 из 4,0</strong> — trust-by-design с первого пилота.</p></div>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением agentic-workflow полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с CRM — это ускоряет согласование сценариев с директором и IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="bpk-section bpk-section-alt" id="agenty">
    <div class="bpk-cnt">
      <div class="bpk-sh">
        <span class="bpk-eyebrow">Agentic era 2026</span>
        <h2>AI-агенты и agentic-решения для бизнеса</h2>
        <p>Agentic AI выполняет действия в системах: пишет в CRM, ставит задачи, маршрутизирует, готовит документы, эскалирует человеку.</p>
      </div>

      <div class="bpk-grid-2 nero-ai-reveal">
        <div class="bpk-card">
          <h3>Agentic AI в продажах и поддержке</h3>
          <ul>
            <li>Квалификация входящих заявок и скоринг лида</li>
            <li>RAG-ответы по базе знаний с цитированием источника</li>
            <li>Резюме звонков, follow-up, черновик КП</li>
            <li>52% обращений IT-поддержки ритейла закрываются без человека</li>
          </ul>
        </div>
        <div class="bpk-card nero-ai-delay-1">
          <h3>Автоматизация документов и операционных задач</h3>
          <p>Кейс металлургического холдинга: <strong>12 автономных агентов</strong>, накладная с <strong>~4 часов до ~15 минут</strong>, ошибки <strong>−92%</strong>, экономия <strong>45 млн ₽/год</strong>.</p>
          <p>152-ФЗ, российские LLM (YandexGPT, GigaChat), on-premise при необходимости. Юридически значимые решения — только с подтверждением человека.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="bpk-section" id="keisy">
    <div class="bpk-cnt">
      <div class="bpk-sh">
        <span class="bpk-eyebrow">Доказательства</span>
        <h2>Кейсы внедрения AI в бизнес</h2>
        <p>Зонтичная услуга ведёт в воронку вертикалей Nero — без конкуренции slug.</p>
      <!-- INTERNAL-LINKS:INSERT -->
      </div>

      <div class="bpk-table-wrap nero-ai-reveal">
        <table class="bpk-table">
          <thead><tr><th>Сценарий</th><th>Боль</th><th>Ожидаемый эффект пилота</th></tr></thead>
          <tbody>
            <tr><td>Входящие заявки</td><td>Потери между сайтом и CRM</td><td>Ответ за минуты, запись в CRM, задача менеджеру</td></tr>
            <tr><td>Email → CRM</td><td>Ручной разбор почты</td><td>Автосоздание сделок и задач</td></tr>
            <tr><td>Поддержка L1</td><td>Перегруз операторов</td><td>30–50% автозакрытия типовых обращений</td></tr>
            <tr><td>Документы</td><td>Долгая подготовка КП</td><td>Черновик за минуты, проверка человеком</td></tr>
          </tbody>
        </table>
      </div>

      <div class="bpk-case-grid nero-ai-reveal" style="margin-top:28px;">
        <div class="bpk-case-card"><div class="bpk-case-tag">amoCRM</div><h3>AI-агент для amoCRM</h3><p>Квалификация лидов, сделки и задачи 24/7 — <a href="/vnedrenie-ai-amocrm/">внедрение AI в amoCRM</a></p></div>
        <div class="bpk-case-card"><div class="bpk-case-tag">Email</div><h3>Email → CRM</h3><p>Автосоздание сделок из входящей почты — <a href="/vnedrenie-ai-obrabotka-email-crm/">обработка email в CRM</a></p></div>
        <div class="bpk-case-card"><div class="bpk-case-tag">1С / ERP</div><h3>AI для учётных систем</h3><p>Документы и первичка без ручного ввода — <a href="/ai-1c-erp/">интеграция с 1С</a></p></div>
      </div>
    </div>
  </section>

  <section class="bpk-section bpk-section-alt" id="ceny">
    <div class="bpk-cnt">
      <div class="bpk-sh">
        <span class="bpk-eyebrow">Коммерция</span>
        <h2>Сколько стоит внедрение AI в бизнес</h2>
        <p>Ориентир чека Nero Network: <strong>250 тыс.–3 млн ₽</strong> — совпадает с рынком интеграторов.</p>
      </div>

      <div class="bpk-table-wrap nero-ai-reveal">
        <table class="bpk-table">
          <thead><tr><th>Компонент</th><th>Ориентир</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>AI-аудит</td><td>50–150 тыс. ₽</td><td>Карта процессов, shortlist, KPI</td></tr>
            <tr><td>PoC / пилот</td><td>200–700 тыс. ₽</td><td>Agent + RAG + 1 workflow</td></tr>
            <tr><td>Интеграции</td><td>200–500 тыс. ₽+</td><td>CRM, каналы, Make/n8n, MCP</td></tr>
            <tr><td>Rollout</td><td>500 тыс.–2 млн ₽+</td><td>Масштаб, обучение, SLA</td></tr>
          </tbody>
        </table>
      </div>

      <div class="bpk-table-wrap nero-ai-reveal" style="margin-top:20px;">
        <table class="bpk-table">
          <thead><tr><th>Параметр</th><th>SaaS / «сами ChatGPT»</th><th>Под ключ (Nero Network)</th></tr></thead>
          <tbody>
            <tr><td>Срок до эффекта</td><td>Неопределён</td><td>4–8 недель пилота</td></tr>
            <tr><td>Интеграции</td><td>Нет</td><td>Включены в проект</td></tr>
            <tr><td>Governance</td><td>Нет</td><td>Human-in-the-loop, логи</td></tr>
            <tr><td>Риск провала</td><td>Высокий</td><td>Снижается audit-first моделью</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет и сроки под ваши процессы</p>
          <p class="ym-cta-block__sub">Ориентир 250 тыс.–3 млн ₽ за внедрение под ключ. На AI-аудите покажем, какие процессы дадут быстрый ROI, сроки пилота 4–8 недель и скрытые затраты «сделать самим» vs под ключ.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Смотреть FAQ</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bpk-section" id="rezultat">
    <div class="bpk-cnt">
      <div class="bpk-sh bpk-left">
        <span class="bpk-eyebrow">Nero Network</span>
        <h2>AI-автоматизация бизнеса: где Nero Network даёт результат</h2>
        <p><strong>AI автоматизация бизнеса</strong> — связка agentic AI + MCP + Make/n8n + CRM, а не абстрактный «искусственный интеллект».</p>
      </div>

      <div class="bpk-grid-2 nero-ai-reveal">
        <div class="bpk-card">
          <h3>Типовые ошибки (и как их избежать)</h3>
          <ul>
            <li>«Автоматизировать всё сразу» → один пилот с KPI</li>
            <li>Building before auditing → AI-аудит первым</li>
            <li>Нет владельца проекта → 50% времени ответственного с клиента</li>
            <li>~23% провалов по организационным причинам → change management</li>
          </ul>
        </div>
        <div class="bpk-card nero-ai-delay-1">
          <h3>Коммерческий оффер и CTA «Получить план внедрения»</h3>
          <p>1. AI-аудит процессов — карта болей, shortlist пилотов, KPI-прогноз.<br>2. Пилот под ключ — один agentic-workflow за 4–8 недель.<br>3. Rollout — масштабирование на смежные отделы и вертикали.</p>
          <p style="margin-top:16px;"><a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a></p>
        </div>
      </div>
    </div>
  </section>

  <section class="bpk-section bpk-section-alt" id="faq">
    <div class="bpk-cnt">
      <div class="bpk-sh">
        <span class="bpk-eyebrow">FAQ</span>
        <h2>FAQ — частые вопросы о внедрении AI в бизнес</h2>
      </div>
      <div class="bpk-faq nero-ai-reveal">
        <div class="bpk-faq-item"><div class="bpk-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить AI в бизнес без бесконечных экспериментов?</div><div class="bpk-faq-a">Начните с AI-аудита: зафиксируйте 1–2 процесса с высоким объёмом и baseline-метриками. Запустите PoC на 50–100 реальных примерах, затем пилот с go/no-go по KPI.</div></div>
        <div class="bpk-faq-item"><div class="bpk-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит внедрение и когда окупается?</div><div class="bpk-faq-a">Вилка 250 тыс.–3 млн ₽ зависит от числа интеграций. Окупаемость — от стоимости операции и FTE: кейс металлургии ~4 месяца при экономии 45 млн ₽/год.</div></div>
        <div class="bpk-faq-item"><div class="bpk-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли интеграция с CRM и ERP?</div><div class="bpk-faq-a">Да, если цель — AI автоматизация бизнеса, а не генерация текстов. Nero интегрирует amoCRM, Bitrix24, 1С, email, Telegram, телефонию через Make/n8n и MCP.</div></div>
        <div class="bpk-faq-item"><div class="bpk-faq-q" role="button" tabindex="0" aria-expanded="false">Под ключ или своими силами — что выбрать?</div><div class="bpk-faq-a">Своими силами — при ML/data-команде и 6–12 месяцах. Под ключ — если нужен результат за 4–8 недель, нет IT-отдела, важны интеграции и KPI.</div></div>
        <div class="bpk-faq-item"><div class="bpk-faq-q" role="button" tabindex="0" aria-expanded="false">С чего начать малому бизнесу?</div><div class="bpk-faq-a">Один процесс с быстрым ROI: входящие заявки, email→CRM или поддержка L1. Методология «30–60 дней на первую болевую точку».</div></div>
        <div class="bpk-faq-item"><div class="bpk-faq-q" role="button" tabindex="0" aria-expanded="false">Безопасны ли корпоративные данные?</div><div class="bpk-faq-a">Разграничение доступа, логи действий агента, российские LLM и on-premise при 152-ФЗ. Юридически значимые решения — только с подтверждением человека.</div></div>
        <div class="bpk-faq-item"><div class="bpk-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-агент отличается от чат-бота?</div><div class="bpk-faq-a">Чат-бот отвечает в окне чата. AI агенты выполняют действия: пишут в CRM, ставят задачи, маршрутизируют, готовят документы — в связке с Make/n8n и MCP.</div></div>
        <div class="bpk-faq-item"><div class="bpk-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли начать с одного процесса?</div><div class="bpk-faq-a">Да, это рекомендуемый путь: пилот → метрики → расширение. Именно так устроена услуга внедрение AI в бизнес под ключ в Nero Network.</div></div>
      </div>
    </div>
  </section>

</div>

<script>
/**
 * vaibk-ai-command-engine — Операционный центр внедрения AI
 * Мир: AuditScannerRing → ProcessSignalBeam → KpiAgentHub → KPI GO-LIVE
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vaibk-ai-command-canvas");
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
    cy = ch / 2 + 8;
    scale = Math.min(cw / 440, ch / 290) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    hubViolet: "#8b5cf6",
    hubGreen: "#22c55e",
    hubAmber: "#fbbf24",
    scanRing: "rgba(121,242,255,0.28)",
    beamCore: "rgba(139,92,246,0.55)",
    chipBg: "rgba(255,255,255,0.12)",
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

  function ProcessSignalBeam() {
    this.phase = 0;
    this.nodes = [
      { label: "Продажи", angle: -Math.PI * 0.75, color: C.hubAccent },
      { label: "Поддержка", angle: -Math.PI * 0.25, color: C.hubGreen },
      { label: "Документы", angle: Math.PI * 0.25, color: C.hubAmber },
      { label: "CRM", angle: Math.PI * 0.75, color: C.hubViolet },
      { label: "Email", angle: Math.PI, color: "#60a5fa" },
      { label: "1С", angle: 0, color: "#f87171" }
    ];
  }
  ProcessSignalBeam.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    this.phase = prg;
    var radius = 118;
    this.nodes.forEach(function (node, idx) {
      var nx = Math.cos(node.angle) * radius;
      var ny = -25 + Math.sin(node.angle) * (radius * 0.55);
      var active = prg >= 70 && prg < 210 && (idx === 0 || idx === 1 || idx === 2);
      drawRR(ctx, nx - 22, ny - 8, 44, 16, 5, active ? "rgba(34,197,94,0.22)" : C.chipBg, active ? C.hubGreen : C.outline);
      ctx.fillStyle = active ? "#fff" : "#cbd5e1";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(node.label, nx, ny + 2);

      if (prg >= 55) {
        var beamAlpha = prg < 70 ? (prg - 55) / 15 : (prg >= 210 ? Math.max(0, 1 - (prg - 210) / 25) : 1);
        if (active || prg < 70) {
          ctx.strokeStyle = "rgba(121,242,255," + (beamAlpha * 0.45) + ")";
          ctx.lineWidth = 1.5;
          ctx.setLineDash([5, 7]);
          ctx.lineDashOffset = -frame * 0.35;
          ctx.beginPath();
          ctx.moveTo(nx * 0.55, ny * 0.55 - 10);
          ctx.lineTo(0, -15);
          ctx.stroke();
          ctx.setLineDash([]);
        }
        var dotT = ((frame * 0.02 + idx * 0.4) % 1);
        var dx = nx * 0.55 * (1 - dotT);
        var dy = (ny * 0.55 - 10) * (1 - dotT) + (-15) * dotT;
        ctx.fillStyle = node.color;
        ctx.beginPath();
        ctx.arc(dx, dy, 3, 0, Math.PI * 2);
        ctx.fill();
      }
    });
  };

  function AuditScannerRing() {
    this.spin = 0;
  }
  AuditScannerRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    this.spin = frame * 0.012;
    var alpha = prg < 70 ? 0.35 + (prg / 70) * 0.45 : prg >= 210 ? 0.8 - ((prg - 210) / 70) * 0.5 : 0.75;
    ctx.save();
    ctx.strokeStyle = "rgba(121,242,255," + alpha + ")";
    ctx.lineWidth = 2;
    ctx.setLineDash([10, 14]);
    ctx.lineDashOffset = -frame * 0.6;
    ctx.beginPath();
    ctx.ellipse(0, -18, 145, 62, 0, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.restore();

    if (prg >= 8 && prg < 65) {
      ctx.strokeStyle = "rgba(139,92,246,0.5)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(0, -18);
      ctx.lineTo(Math.cos(this.spin) * 145, -18 + Math.sin(this.spin) * 62);
      ctx.stroke();
    }
  };

  function KpiAgentHub() {
    this.pulse = 0;
  }
  KpiAgentHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    var hexR = 42;
    ctx.save();
    ctx.translate(0, -18);
    ctx.fillStyle = C.hubBase;
    ctx.strokeStyle = C.hubAccent;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var i = 0; i < 6; i++) {
      var a = (Math.PI / 3) * i - Math.PI / 6;
      var hx = Math.cos(a) * hexR;
      var hy = Math.sin(a) * hexR * 0.85;
      if (i === 0) ctx.moveTo(hx, hy);
      else ctx.lineTo(hx, hy);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("KPI HUB", 0, -4);
    ctx.font = "7px Inter,sans-serif";
    ctx.fillStyle = C.hubAccent;
    ctx.fillText("agentic", 0, 8);

    if (prg >= 140 && prg < 210) {
      var orbit = (prg - 140) / 70;
      for (var j = 0; j < 3; j++) {
        var oa = frame * 0.04 + j * 2.1;
        var ox = Math.cos(oa) * (18 + orbit * 8);
        var oy = Math.sin(oa) * (14 + orbit * 6);
        drawRR(ctx, ox - 6, oy - 4, 12, 8, 3, C.hubViolet, C.outline);
      }
    }

    if (prg >= 210) {
      this.pulse = Math.min(1, (prg - 210) / 30);
      ctx.strokeStyle = "rgba(34,197,94," + (0.85 - this.pulse * 0.6) + ")";
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.arc(0, 0, hexR + 8 + this.pulse * 38, 0, Math.PI * 2);
      ctx.stroke();
      if (prg > 235 && prg < 265) {
        drawRR(ctx, -28, -52, 56, 18, 6, "rgba(34,197,94,0.35)", C.hubGreen);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 8px Inter,sans-serif";
        ctx.fillText("GO-LIVE", 0, -40);
      }
    }
    ctx.restore();
  };

  function PilotTimelineGate() {}
  PilotTimelineGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    drawRR(ctx, -95, 58, 190, 14, 4, "rgba(255,255,255,0.06)", C.outline);
    var fillW = prg < 70 ? (prg / 70) * 60 : prg < 140 ? 60 + ((prg - 70) / 70) * 70 : prg < 210 ? 130 + ((prg - 140) / 70) * 40 : 190;
    drawRR(ctx, -93, 60, fillW * 0.95, 10, 3, C.hubViolet, null);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Пилот 4–8 нед.", -93, 54);
    ctx.textAlign = "right";
    ctx.fillText(prg >= 210 ? "KPI ✓" : "PoC", 95, 54);
  };

  function GovernanceShield() {
    this.glow = 0;
  }
  GovernanceShield.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    if (prg < 130 || prg > 220) return;
    this.glow = Math.sin((prg - 130) * 0.08) * 0.3 + 0.5;
    ctx.save();
    ctx.translate(118, -58);
    ctx.fillStyle = "rgba(34,197,94," + (this.glow * 0.25) + ")";
    ctx.strokeStyle = C.hubGreen;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.moveTo(0, -14);
    ctx.lineTo(12, -8);
    ctx.lineTo(12, 4);
    ctx.quadraticCurveTo(0, 14, -12, 4);
    ctx.lineTo(-12, -8);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
    ctx.strokeStyle = "#fff";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(-4, 0);
    ctx.lineTo(-1, 4);
    ctx.lineTo(5, -3);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HITL", 0, 18);
    ctx.restore();
  };

  function IntegrationNode() {}
  IntegrationNode.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    if (prg < 145 || prg > 215) return;
    var labels = ["MCP", "CRM", "Make"];
    labels.forEach(function (lb, i) {
      var ix = -55 + i * 55;
      var iy = 38 + Math.sin(frame * 0.06 + i) * 2;
      drawRR(ctx, ix - 16, iy, 32, 14, 4, "rgba(59,130,246,0.2)", C.hubAccent);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(lb, ix, iy + 10);
    });
  };

  function RoiSparkline() {}
  RoiSparkline.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 280;
    if (prg < 200) return;
    var prog = Math.min(1, (prg - 200) / 50);
    drawRR(ctx, -118, -72, 52, 28, 5, "rgba(255,255,255,0.06)", C.outline);
    ctx.strokeStyle = C.hubGreen;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(-110, -50);
    for (var i = 0; i <= 4; i++) {
      var px = -110 + i * 10;
      var py = -50 - i * 4 * prog;
      ctx.lineTo(px, py);
    }
    ctx.stroke();
    ctx.fillStyle = C.hubGreen;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("ROI ↑", -110, -78);
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
    var prg = (frame * 0.038) % 280;
    var isMoving = false;
    var hubTargets = {
      "1_architect": { x: -75, y: 42 },
      "2_seo": { x: -25, y: 52 },
      "3_coder": { x: 25, y: 52 },
      "4_designer": { x: 75, y: 42 },
      "5_deployer": { x: 0, y: 62 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: 50 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 17) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 240 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 210);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.2;
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
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new AuditScannerRing());
  entities.push(new ProcessSignalBeam());
  entities.push(new KpiAgentHub());
  entities.push(new PilotTimelineGate());
  entities.push(new GovernanceShield());
  entities.push(new IntegrationNode());
  entities.push(new RoiSparkline());
  entities.push(new Agent(-130, 88, C.agentYellow, "1_architect", 12, [
    "Карта процессов готова", "Shortlist: 3 пилота", "Baseline KPI зафиксирован"
  ]));
  entities.push(new Agent(-65, 98, C.agentGreen, "2_seo", 58, [
    "ROI/час: поддержка №1", "71% пробуют — 4% внедрили", "Приоритет: быстрый эффект"
  ]));
  entities.push(new Agent(0, 102, C.agentBlue, "3_coder", 108, [
    "Agent + RAG + MCP", "Shadow-mode 2 недели", "Интеграция amoCRM"
  ]));
  entities.push(new Agent(65, 98, C.agentPink, "4_designer", 148, [
    "Human-in-the-loop ON", "Логи каждого действия", "Governance с пилота"
  ]));
  entities.push(new Agent(130, 88, C.agentPurple, "5_deployer", 188, [
    "Go/no-go по KPI", "Rollout на смежный отдел", "Отчёт директору"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife, maxLife: customLife });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.038) % 280;
    if (prg >= 10 && prg < 10.08) createBubble(-90, -35, "1. AI-аудит процессов", 200);
    if (prg >= 75 && prg < 75.08) createBubble(-20, -30, "2. Shortlist пилотов", 200);
    if (prg >= 145 && prg < 145.08) createBubble(30, -25, "3. Agentic → CRM", 200);
    if (prg >= 215 && prg < 215.08) createBubble(0, -45, "4. KPI GO-LIVE ✓", 220);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2);
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


<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.bpk-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.bpk-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.bpk-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.bpk-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.vnedrenie-ai-v-biznes-pod-klyuch-page');
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
