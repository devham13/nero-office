<?php
/**
 * Template Name: AI-поддержка клиентов 24/7: внедрение под ключ
 * Description: SEO-лендинг — AI-поддержка клиентов 24/7. Типовые обращения, RAG, эскалация оператору. Аудит за 48 часов.
 */

$page_seo_title       = 'AI-поддержка клиентов 24/7: внедрение под ключ';
$page_seo_description = 'Внедряем AI-службу поддержки: круглосуточно закрываем типовые вопросы — заказ, доставка, возврат, тарифы. Сложные кейсы — оператору с контекстом. Аудит и демо за 48 часов.';

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
	['label' => 'Зачем', 'href' => '#zachem'],
	['label' => 'Типовые вопросы', 'href' => '#tipovye-obrashcheniya'],
	['label' => 'Архитектура', 'href' => '#kak-ustroena'],
	['label' => 'Внедрение', 'href' => '#vnedrenie'],
	['label' => 'Кейсы', 'href' => '#keisy'],
	['label' => 'Стоимость', 'href' => '#stoimost'],
	['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
	$nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить поддержку';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI';
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
/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

/* Intro after hero — left accent stripe */
.vnap-intro-text{position:relative;padding-left:20px;text-align:left!important}
.vnap-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,#79f2ff,#8b5cf6)}
.vnap-intro-text p{text-align:left!important}
.vnedrenie-ai-podderzhka-klientov-24-7-page .vnas-hero-support{min-height:min(980px,calc(100dvh - 1px));position:relative}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-podderzhka-klientov-24-7-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnas-hero-support" id="vnas-hero-support" aria-labelledby="vnas-hero-title">
<style>
/* ── Hero AI-поддержка 24/7: самодостаточные стили (без CSS темы) ── */
.vnas-hero-support {
  --vnas-cyan: #79f2ff;
  --vnas-violet: #8b5cf6;
  --vnas-green: #22c55e;
  --vnas-amber: #f59e0b;
  --vnas-text: #e6edf7;
  --vnas-muted: #9aa8bd;
  --vnas-soft: #c7d2e5;
  --vnas-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnas-hero-support {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnas-hero-support::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 55% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vnas-hero-support::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(34, 197, 94, .11), transparent 66%);
  filter: blur(6px);
  animation: vnasHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnasHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.vnas-hero-support .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnas-hero-support .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnas-hero-support .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnas-hero-support .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnas-green) 38%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnas-hero-support .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(34, 197, 94, 0.22);
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.08);
  color: #86efac !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnas-hero-support .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnas-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnas-hero-support .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnas-hero-support .nero-ai-badge {
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
.vnas-hero-support .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnas-hero-support .nero-ai-btn {
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
.vnas-hero-support .nero-ai-btn:hover { transform: translateY(-2px); }
.vnas-hero-support .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnas-green), var(--vnas-cyan));
  box-shadow: 0 18px 42px rgba(34, 197, 94, 0.22);
}
.vnas-hero-support .nero-ai-btn-secondary {
  color: var(--vnas-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnas-hero-support .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnas-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnas-hero-support .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnas-hero-support .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnas-hero-support .nero-ai-dots { display: flex; gap: 7px; }
.vnas-hero-support .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnas-hero-support .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnas-hero-support .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnas-hero-support .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnas-hero-support .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .02em;
}
.vnas-hero-support .nero-ai-window-body { padding: 16px; }
.vnas-hero-support .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.vnas-hero-support .nero-ai-dashboard-title h3 {
  margin: 0;
  color: #f8fafc;
  font-size: 15px;
  font-weight: 800;
}
.vnas-hero-support .nero-ai-live-pill {
  padding: 4px 10px;
  border-radius: 999px;
  background: rgba(34, 197, 94, .14);
  color: #86efac;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .06em;
  text-transform: uppercase;
}
.vnas-hero-support .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnas-hero-support .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnas-hero-support .nero-ai-metric span {
  display: block;
  color: var(--vnas-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnas-hero-support .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnas-hero-support .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnas-hero-support .vnas-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(34, 197, 94, 0.18);
  background: radial-gradient(ellipse at 50% 35%, rgba(34,197,94,.09), rgba(6,10,24,.92) 72%);
}
.vnas-hero-support #vnas-helpdesk-hub-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnas-hero-support .nero-ai-task-stream { display: grid; gap: 8px; }
.vnas-hero-support .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnas-hero-support .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(34,197,94,.12);
  color: var(--vnas-green);
  font-size: 13px;
  font-weight: 800;
}
.vnas-hero-support .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnas-hero-support .nero-ai-task span {
  color: var(--vnas-muted);
  font-size: 11px;
}
.vnas-hero-support .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnas-hero-support .nero-ai-status--amber {
  background: rgba(245,158,11,.14);
  color: #fde68a;
}
@media (max-width: 1024px) {
  .vnas-hero-support .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnas-hero-support .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai поддержка 24/7</p>
      <h1 id="vnas-hero-title">AI-поддержка клиентов 24/7: <span class="nero-ai-gradient-text">внедрение под ключ для типовых обращений</span></h1>
      <p class="nero-ai-hero-lead">Закрываем повторяющиеся вопросы круглосуточно, сложные кейсы — оператору с полным контекстом. Аудит типовых обращений и демо за 48 часов.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые преимущества">
        <li class="nero-ai-badge">Аудит 48 ч</li>
        <li class="nero-ai-badge">RAG + CRM</li>
        <li class="nero-ai-badge">Эскалация с контекстом</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить поддержку</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#tipovye-obrashcheniya">Типовые вопросы</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI Support Center">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI Support Center · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Automation rate</span>
              <strong>67%</strong>
              <small>типовые без оператора</small>
            </div>
            <div class="nero-ai-metric">
              <span>Первый ответ</span>
              <strong>10 сек</strong>
              <small>медиана на пилоте</small>
            </div>
            <div class="nero-ai-metric">
              <span>Режим</span>
              <strong>24/7</strong>
              <small>чат и мессенджеры</small>
            </div>
            <div class="nero-ai-metric">
              <span>Handoff</span>
              <strong>summary</strong>
              <small>контекст оператору</small>
            </div>
          </div>

          <div class="vnas-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnas-helpdesk-hub-canvas" role="img" aria-label="Анимация: обращения из каналов маршрутизируются AI, типовые закрываются, сложные уходят оператору с контекстом"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий поддержки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Статус заказа #4821</strong><span>Intent: доставка · confidence 0.94</span></div>
              <span class="nero-ai-status">AI закрыл</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">FAQ</span>
              <div><strong>Возврат по FAQ</strong><span>RAG: политика 14 дней</span></div>
              <span class="nero-ai-status">AI закрыл</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Негатив в чате</strong><span>Эскалация + summary для оператора</span></div>
              <span class="nero-ai-status nero-ai-status--amber">handoff</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* === VNAP: vnedrenie-ai-podderzhka-klientov-24-7 — контент лонгрида === */
.vnap-content{
  --vnap-bg:#050711;--vnap-bg2:#080b17;
  --vnap-surface:rgba(255,255,255,.072);--vnap-surface2:rgba(255,255,255,.108);
  --vnap-text:#e6edf7;--vnap-muted:#9aa8bd;--vnap-soft:#c7d2e5;--vnap-heading:#fff;
  --vnap-border:rgba(255,255,255,.10);--vnap-accent:#79f2ff;--vnap-violet:#8b5cf6;
  --vnap-green:#22c55e;--vnap-amber:#f59e0b;--vnap-r:18px;--vnap-r-lg:24px;
  --vnap-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnap-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vnap-content *,.vnap-content *::before,.vnap-content *::after{box-sizing:border-box;}
.vnap-content p{color:var(--vnap-muted);line-height:1.72;margin:0 0 1em;}
.vnap-content h2,.vnap-content h3,.vnap-content h4{color:var(--vnap-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.vnap-content strong{color:var(--vnap-soft);}
.vnap-content ul,.vnap-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.vnap-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnap-muted);font-size:14.5px;line-height:1.65;}
.vnap-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnap-accent);font-weight:700;}
.vnap-content ol{counter-reset:vnap-ol;}
.vnap-content ol li{counter-increment:vnap-ol;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--vnap-muted);font-size:14.5px;line-height:1.65;}
.vnap-content ol li::before{content:counter(vnap-ol);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--vnap-accent);font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;top:2px;}
.vnap-cnt{width:min(var(--vnap-container),calc(100% - 40px));margin:0 auto;}
.vnap-section{padding:clamp(56px,7vw,88px) 0;position:relative;}
.vnap-section-alt{background:linear-gradient(180deg,transparent,rgba(15,23,42,.45) 40%,transparent);}
.vnap-sh{text-align:center;max-width:780px;margin:0 auto 40px;}
.vnap-sh.vnap-left{text-align:left;margin-left:0;margin-right:auto;}
.vnap-eyebrow{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--vnap-accent);margin-bottom:12px;}
.vnap-sh h2{font-size:clamp(26px,3.6vw,38px);font-weight:800;line-height:1.15;}
.vnap-sh p{font-size:16px;margin-top:12px;}
.vnap-card{background:var(--vnap-surface);border:1px solid var(--vnap-border);border-radius:var(--vnap-r-lg);padding:28px 32px;margin-bottom:20px;}
.vnap-grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;}
.vnap-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vnap-grid-2,.vnap-grid-3{grid-template-columns:1fr;}}
.vnap-kpi-row{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin:28px 0;}
@media(max-width:768px){.vnap-kpi-row{grid-template-columns:repeat(2,1fr);}}
.vnap-kpi{background:var(--vnap-surface2);border:1px solid var(--vnap-border);border-radius:var(--vnap-r);padding:18px 16px;text-align:center;}
.vnap-kpi .kv{font-size:clamp(22px,3vw,30px);font-weight:800;color:var(--vnap-accent);}
.vnap-kpi .kl{font-size:12.5px;color:var(--vnap-muted);margin-top:6px;line-height:1.4;}
.vnap-table-wrap{overflow-x:auto;border-radius:var(--vnap-r);border:1px solid var(--vnap-border);}
.vnap-table{width:100%;border-collapse:collapse;font-size:14px;}
.vnap-table th,.vnap-table td{padding:12px 16px;text-align:left;border-bottom:1px solid var(--vnap-border);}
.vnap-table th{color:var(--vnap-soft);font-weight:700;background:rgba(255,255,255,.04);}
.vnap-table tr:last-child td{border-bottom:none;}
.vnap-table tr.vnap-highlight td{background:rgba(34,197,94,.08);color:var(--vnap-green);}
.vnap-callout{border-left:3px solid var(--vnap-violet);padding:16px 20px;background:rgba(139,92,246,.08);border-radius:0 var(--vnap-r) var(--vnap-r) 0;margin:24px 0;}
.vnap-phase{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:28px;}
@media(max-width:900px){.vnap-phase{grid-template-columns:repeat(2,1fr);}}
@media(max-width:520px){.vnap-phase{grid-template-columns:1fr;}}
.vnap-phase-card{background:var(--vnap-surface);border:1px solid var(--vnap-border);border-radius:var(--vnap-r);padding:22px 18px;}
.vnap-phase-num{font-size:11px;font-weight:700;color:var(--vnap-violet);letter-spacing:.08em;margin-bottom:8px;}
.vnap-timeline{display:flex;flex-wrap:wrap;gap:8px;align-items:center;margin:24px 0;font-size:13px;}
.vnap-timeline span{background:var(--vnap-surface);border:1px solid var(--vnap-border);border-radius:99px;padding:8px 14px;color:var(--vnap-soft);}
.vnap-timeline .arr{color:var(--vnap-accent);font-weight:700;}
.vnap-scenario{display:flex;gap:16px;padding:20px 0;border-bottom:1px solid var(--vnap-border);}
.vnap-scenario:last-child{border-bottom:none;}
.vnap-sc-icon{font-size:28px;flex-shrink:0;}
.vnap-faq details{background:var(--vnap-surface);border:1px solid var(--vnap-border);border-radius:var(--vnap-r);margin-bottom:10px;padding:0;}
.vnap-faq summary{padding:18px 22px;cursor:pointer;font-weight:700;color:var(--vnap-heading);list-style:none;}
.vnap-faq summary::-webkit-details-marker{display:none;}
.vnap-faq details[open] summary{border-bottom:1px solid var(--vnap-border);}
.vnap-faq .vnap-faq-body{padding:0 22px 18px;color:var(--vnap-muted);font-size:14.5px;line-height:1.7;}
.vnap-intro{padding:clamp(48px,6vw,72px) 0;}
.vnap-intro-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:32px;align-items:start;}
@media(max-width:900px){.vnap-intro-grid{grid-template-columns:1fr;}}
.vnap-intro-kpi{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;}
.vnap-toc-outer{padding:8px 0 24px;position:sticky;top:64px;z-index:20;background:linear-gradient(180deg,rgba(5,7,17,.97),rgba(5,7,17,.85));backdrop-filter:blur(8px);}
.vnap-toc{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;}
.vnap-toc a{font-size:12.5px;font-weight:600;padding:8px 14px;border-radius:99px;border:1px solid var(--vnap-border);color:var(--vnap-muted);transition:color .2s,border-color .2s;}
.vnap-toc a:hover{color:var(--vnap-accent);border-color:rgba(121,242,255,.35);}
.vnap-logo-strip{display:flex;flex-wrap:wrap;gap:10px;margin:20px 0;}
.vnap-logo-pill{padding:8px 14px;border-radius:99px;font-size:12px;font-weight:600;background:rgba(255,255,255,.05);border:1px solid var(--vnap-border);color:var(--vnap-soft);}
.vnap-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.vnap-content .ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.vnap-content .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.vnap-content .ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.vnap-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.vnap-content .ym-cta-block__sub{color:var(--vnap-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.vnap-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.vnap-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.vnap-content .ym-link--accent{color:var(--vnap-accent);text-decoration:underline;text-underline-offset:3px;}
</style>

<div class="vnap-content">

  <!-- INTRO -->
  <section class="vnap-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vnap-cnt">
      <div class="vnap-intro-grid nero-ai-reveal">
        <div class="vnap-intro-text">
          <p class="vnap-eyebrow">Лонгрид · ai поддержка клиентов</p>
          <p><strong>AI-поддержка клиентов 24/7</strong> — круглосуточная первая линия, которая за секунды закрывает повторяющиеся вопросы и передаёт сложные обращения оператору с полным контекстом. Не замена людей, а разгрузка контакт-центра.</p>
          <p>Операторы тонут в «где мой заказ», «как оформить возврат», «какой тариф». <strong>60–80% обращений</strong> в e-commerce, SaaS, банках и телекоме повторяются. Nero Network внедряет <strong>ai поддержку клиентов под ключ</strong> — старт с аудита типовых обращений за <strong>48 часов</strong>.</p>
        </div>
        <div class="vnap-intro-kpi" aria-label="Ключевые показатели">
          <div class="vnap-kpi"><div class="kv">60–80%</div><div class="kl">повторяющихся обращений</div></div>
          <div class="vnap-kpi"><div class="kv">70%</div><div class="kl">клиентов к conversational AI к 2028</div></div>
          <div class="vnap-kpi"><div class="kv">10 сек</div><div class="kl">первый ответ (кейс VseMayki)</div></div>
          <div class="vnap-kpi"><div class="kv">48 ч</div><div class="kl">аудит и демо Nero Network</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vnap-toc-outer">
    <div class="vnap-cnt">
      <nav class="vnap-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем</a>
        <a href="#tipovye-obrashcheniya">Типовые вопросы</a>
        <a href="#kak-ustroena">Архитектура</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#riski">Риски</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Аудит</a>
      </nav>
    </div>
  </div>

  <!-- H2-1: #zachem -->
  <section class="vnap-section" id="zachem">
    <div class="vnap-cnt">
      <div class="vnap-sh vnap-left nero-ai-reveal">
        <span class="vnap-eyebrow">Зачем бизнесу</span>
        <h2>Зачем бизнесу AI-поддержка клиентов 24/7</h2>
        <p><strong>Коротко:</strong> AI-поддержка — круглосуточная первая линия: типовые вопросы за секунды, сложные — оператору с контекстом.</p>
      </div>
      <p class="vnap-related nero-ai-reveal" style="margin-top:20px;font-size:15px">Омниканальная первая линия включает не только чат: письма из общего ящика попадают в тот же triage, что и в сценарии <a href="/vnedrenie-ai-obrabotka-email-crm/" class="ym-link ym-link--accent">AI-обработки входящей почты в CRM</a> — классификация, извлечение сути и маршрутизация до эскалации оператору.</p>
      <p class="vnap-related nero-ai-reveal" style="margin-top:16px;font-size:15px">Без связки с CRM AI не видит историю клиента и не создаёт тикет при handoff — на пилоте мы интегрируем read-only с amoCRM и Битрикс24; подробнее про CRM-контур в материале про <a href="/vnedrenie-ai-amocrm/" class="ym-link ym-link--accent">внедрение AI-агента в amoCRM под ключ</a>.</p>
      <p class="nero-ai-reveal">Контакт-центр в 2026 — одно из самых быстроокупаемых направлений AI. Рынок смещается к <strong>гибридной модели</strong>: AI первая линия + человек для сложного. Gartner: к 2028 не менее <strong>70% клиентов</strong> начнут путь с conversational AI; к 2029 agentic AI сможет автономно закрывать до <strong>80% типовых обращений</strong>.</p>
      <p class="nero-ai-reveal"><strong>50% компаний</strong>, сокративших штат из-за AI, к 2027 <strong>перенанимают</strong> сотрудников. <strong>95% лидеров</strong> customer service строят стратегию «digital first, but not digital only».</p>
      <div class="vnap-callout nero-ai-reveal">
        <p><strong>Определение:</strong> AI-служба поддержки — не «чат-бот с кнопками» и не «просто ChatGPT на сайте». Это омниканальный приём + LLM/RAG по базе знаний + интеграции CRM/OMS + правила эскалации на человека.</p>
      </div>
      <div class="vnap-table-wrap nero-ai-reveal" style="margin-top:28px">
        <table class="vnap-table" aria-label="Сравнение моделей поддержки">
          <thead><tr><th>Модель</th><th>Время ответа</th><th>Ночь и выходные</th><th>Сложные кейсы</th></tr></thead>
          <tbody>
            <tr><td>Только операторы</td><td>Минуты, в пик — 15–20 мин</td><td>Очередь</td><td>Сильная эмпатия</td></tr>
            <tr><td>Только бот без RAG</td><td>Секунды</td><td>24/7</td><td>Риск «тупика»</td></tr>
            <tr class="vnap-highlight"><td><strong>Гибрид AI + человек</strong></td><td><strong>Секунды на типовых</strong></td><td><strong>24/7 на FAQ</strong></td><td><strong>Оператор с контекстом</strong></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- H2-2: #tipovye-obrashcheniya -->
  <section class="vnap-section vnap-section-alt" id="tipovye-obrashcheniya">
    <div class="vnap-cnt">
      <div class="vnap-sh nero-ai-reveal">
        <span class="vnap-eyebrow">Типовые сценарии</span>
        <h2>Какие типовые обращения закрывает AI без оператора</h2>
        <p><strong>Коротко:</strong> автоматизируют повторяющиеся сценарии с чёткими правилами — статус заказа, доставка, возврат по FAQ, тарифы, часы работы.</p>
      </div>
      <p class="nero-ai-reveal" style="text-align:center;max-width:720px;margin:0 auto 28px">Перед внедрением Nero Network классифицирует 200–500 последних обращений и формирует <strong>список вопросов для автоматизации</strong> — лид-магнит для вашей команды.</p>
      <div class="vnap-grid-2 nero-ai-reveal">
        <div class="vnap-card"><h3>Топ-10 для автоматизации</h3>
          <ol>
            <li><strong>Статус заказа</strong> — трек, срок (read-only OMS/CRM)</li>
            <li><strong>Доставка</strong> — способы, сроки, пункты выдачи</li>
            <li><strong>Возврат и обмен</strong> — условия, инструкция (без auto-refund на пилоте)</li>
            <li><strong>Оплата</strong> — способы, рассрочка, статус платежа</li>
            <li><strong>Тарифы</strong> — сравнение планов, смена подписки</li>
          </ol>
        </div>
        <div class="vnap-card"><h3>Ещё 5 сценариев</h3>
          <ol start="6">
            <li><strong>Доступ к сервису</strong> — сброс пароля, диагностика</li>
            <li><strong>Часы и контакты</strong> — адреса, мессенджеры</li>
            <li><strong>FAQ по продукту</strong> — из базы знаний</li>
            <li><strong>Запись на услугу</strong> — слоты, подтверждение</li>
            <li><strong>Маршрутизация</strong> — сбор данных перед эскалацией</li>
          </ol>
        </div>
      </div>
      <div class="vnap-kpi-row nero-ai-reveal">
        <div class="vnap-kpi"><div class="kv">70%</div><div class="kl">VseMayki — без менеджера</div></div>
        <div class="vnap-kpi"><div class="kv">10 сек</div><div class="kl">средний ответ (было 3 мин)</div></div>
        <div class="vnap-kpi"><div class="kv">60%</div><div class="kl">М.Видео «Алёна»</div></div>
        <div class="vnap-kpi"><div class="kv">52%</div><div class="kl">статус заказа автоматизирован</div></div>
      </div>
      <div class="vnap-callout nero-ai-reveal">
        <p><strong>Лид-магнит:</strong> чек-лист «50 вопросов для автоматизации» — формируем на аудите под вашу отрасль.</p>
      </div>
    </div>
  </section>

  <!-- БОРИС: визуальный блок после 2-го H2 -->
  <section id="vnedrenie-ai-podderzhka-klientov-24-7-boris-block" class="bsp-root" aria-label="Поток AI-поддержки: от канала до оператора с контекстом">
<style>
/* === БОРИС: prefix bsp-, scoped внутри #vnedrenie-ai-podderzhka-klientov-24-7-boris-block === */
.bsp-root{padding:56px 0 64px;background:#f0f4fb;}
.bsp-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.bsp-card{display:grid;grid-template-columns:42% 58%;border-radius:24px;overflow:hidden;box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(6,182,212,.18);min-height:500px;}
@media(max-width:960px){.bsp-card{grid-template-columns:1fr;min-height:auto;}}
.bsp-lft{background:#fff;padding:44px 36px;display:flex;flex-direction:column;justify-content:center;}
@media(max-width:600px){.bsp-lft{padding:28px 22px;}}
.bsp-ey{display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:#0891b2;margin:0 0 14px;}
.bsp-ey::before{content:'';display:inline-block;width:20px;height:2px;background:#0891b2;border-radius:1px;}
.bsp-h3{font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px;}
.bsp-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:10px;}
.bsp-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;}
.bsp-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(6,182,212,.12);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0891b2;font-style:normal;font-weight:700;}
.bsp-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
.bsp-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
.bsp-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bsp-pl-b{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22);}
.bsp-pl-a{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22);}
.bsp-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;}
.bsp-rgt{background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);position:relative;overflow:hidden;min-height:400px;}
@media(max-width:960px){.bsp-rgt{min-height:360px;}}
#bsp-support-flow-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bsp-cnt">
  <div class="bsp-card">
    <div class="bsp-lft">
      <span class="bsp-ey">Эскалация с контекстом</span>
      <h3 class="bsp-h3">От «где мой заказ» до оператора — без повторения вопроса</h3>
      <ul class="bsp-ul">
        <li><span class="bsp-ic">1</span>Обращение из сайта, Telegram или email попадает в единый inbox</li>
        <li><span class="bsp-ic">2</span>Классификатор определяет интент: доставка, возврат, тариф, негатив</li>
        <li><span class="bsp-ic">✓</span>Типовой кейс — AI отвечает за секунды по RAG и CRM read-only</li>
        <li><span class="bsp-ic">→</span>Сложный — тикет оператору с транскриптом, summary и тегами</li>
      </ul>
      <div class="bsp-pills">
        <span class="bsp-pl bsp-pl-g">67% automation rate</span>
        <span class="bsp-pl bsp-pl-b">Handoff + summary</span>
        <span class="bsp-pl bsp-pl-a">confidence &lt; 0,85 → человек</span>
      </div>
      <p class="bsp-foot">Дальше разберём архитектуру чата, helpdesk и эскалации →</p>
    </div>
    <div class="bsp-rgt">
      <canvas id="bsp-support-flow-canvas" aria-label="Анимация: омниканальные обращения классифицируются AI, типовые закрываются, сложные эскалируются оператору с контекстом" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bsp-support-flow-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    cyan:'#22d3ee', cyanD:'rgba(34,211,238,.15)',
    green:'#4ade80', greenD:'rgba(74,222,128,.12)',
    amber:'#fbbf24', amberD:'rgba(251,191,36,.12)',
    viol:'#a78bfa', violD:'rgba(167,139,250,.12)',
    card:'rgba(255,255,255,.06)', cardBdr:'rgba(255,255,255,.12)',
    line:'rgba(255,255,255,.08)'
  };

  var CHANNELS = [
    {label:'Сайт', icon:'💬', color:C.cyan},
    {label:'Telegram', icon:'✈', color:C.viol},
    {label:'Email', icon:'✉', color:C.amber}
  ];

  var TICKETS = [];
  var LOOP = 600;

  function spawnTicket(){
    var ch = Math.floor(Math.random() * 3);
    var intents = ['Доставка','Статус','Возврат','Тариф','Негатив'];
    var intent = intents[Math.floor(Math.random() * intents.length)];
    var escalate = intent === 'Негатив' || Math.random() < 0.28;
    TICKETS.push({
      ch:ch, intent:intent, escalate:escalate,
      x:-60, phase:0, alpha:0, born:frame,
      resolved:false, atOp:false
    });
    if (TICKETS.length > 8) TICKETS.shift();
  }

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}
  }

  function drawHeader(){
    ctx.fillStyle=C.ink;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Support Flow · live', 14, 22);
    var pulse = 5 + Math.sin(frame * 0.08) * 2;
    ctx.beginPath(); ctx.arc(W - 50, 18, pulse, 0, Math.PI * 2);
    ctx.fillStyle='rgba(34,197,94,.15)'; ctx.fill();
    ctx.beginPath(); ctx.arc(W - 50, 18, 4, 0, Math.PI * 2);
    ctx.fillStyle='#22c55e'; ctx.fill();
    ctx.fillStyle=C.green;
    ctx.font='10px Inter,sans-serif';
    ctx.fillText('24/7', W - 38, 22);
    ctx.strokeStyle=C.line; ctx.lineWidth=1;
    ctx.beginPath(); ctx.moveTo(0, 32); ctx.lineTo(W, 32); ctx.stroke();
  }

  function drawChannels(yBase){
    var cw = (W - 40) / 3;
    CHANNELS.forEach(function(ch, i){
      var x = 12 + i * (cw + 8);
      rr(x, yBase, cw - 4, 52, 10, C.card, C.cardBdr, 1);
      ctx.font='16px sans-serif'; ctx.textAlign='center';
      ctx.fillText(ch.icon, x + (cw-4)/2, yBase + 22);
      ctx.fillStyle=ch.color;
      ctx.font='bold 10px Inter,sans-serif';
      ctx.fillText(ch.label, x + (cw-4)/2, yBase + 42);
    });
  }

  function drawClassifier(cx, cy){
    rr(cx - 55, cy - 28, 110, 56, 14, C.violD, C.viol, 1.5);
    ctx.fillStyle=C.viol;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Intent AI', cx, cy - 4);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('RAG + CRM', cx, cy + 12);
    var rot = frame * 0.04;
    ctx.strokeStyle=C.viol;
    ctx.lineWidth=1.5;
    ctx.beginPath();
    ctx.arc(cx, cy, 38 + Math.sin(rot)*3, 0, Math.PI*2);
    ctx.stroke();
  }

  function drawOutcomes(yBase){
    var half = (W - 30) / 2;
    rr(12, yBase, half - 6, 70, 12, C.greenD, C.green, 1);
    ctx.fillStyle=C.green;
    ctx.font='bold 11px Inter,sans-serif'; ctx.textAlign='left';
    ctx.fillText('AI закрыл', 22, yBase + 22);
    ctx.fillStyle=C.muted; ctx.font='9px Inter,sans-serif';
    ctx.fillText('FAQ · статус · тариф', 22, yBase + 38);
    var cnt = TICKETS.filter(function(t){return t.resolved;}).length;
    if(cnt>0){
      ctx.fillStyle=C.green; ctx.font='bold 18px Inter,sans-serif';
      ctx.fillText(cnt, half - 30, yBase + 58);
    }
    var x2 = 18 + half;
    rr(x2, yBase, half - 6, 70, 12, C.amberD, C.amber, 1);
    ctx.fillStyle=C.amber;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.fillText('→ Оператор', x2 + 10, yBase + 22);
    ctx.fillStyle=C.muted; ctx.font='9px Inter,sans-serif';
    ctx.fillText('summary + контекст', x2 + 10, yBase + 38);
  }

  function drawFlowLines(y1, y2, y3){
    ctx.strokeStyle=C.line; ctx.lineWidth=1.5;
    ctx.setLineDash([4,4]);
    var cx = W/2;
    ctx.beginPath();
    ctx.moveTo(cx, y1 + 52); ctx.lineTo(cx, y2 - 28);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(cx, y2 + 28); ctx.lineTo(cx, y3 - 4);
    ctx.stroke();
    ctx.setLineDash([]);
  }

  function drawTickets(yCh, yCl, yOut){
    TICKETS.forEach(function(t){
      var age = frame - t.born;
      if(age < 0) return;
      var progress = Math.min(1, age / 120);
      t.alpha = Math.min(1, age / 20);
      var startX = 12 + t.ch * ((W-40)/3) + ((W-40)/3)/2;
      var cx = W/2;
      if(t.phase === 0){
        t.x = startX + (cx - startX) * progress;
        t.y = yCh + 26 + (yCl - yCh - 26) * progress;
        if(progress >= 1) t.phase = 1;
      } else if(t.phase === 1){
        t.x = cx; t.y = yCl;
        if(age > 140){
          t.phase = 2;
          t.resolved = !t.escalate;
          if(t.escalate) t.atOp = true;
        }
      } else {
        var targetX = t.escalate ? W * 0.72 : W * 0.28;
        var targetY = yOut + 35;
        t.x += (targetX - t.x) * 0.08;
        t.y += (targetY - t.y) * 0.08;
        if(Math.abs(t.x - targetX) < 2) t.phase = 3;
      }
      ctx.globalAlpha = t.alpha * (t.phase === 3 ? 0.5 : 1);
      var col = t.escalate ? C.amber : C.green;
      rr(t.x - 28, t.y - 10, 56, 20, 6, t.escalate ? C.amberD : C.greenD, col, 1);
      ctx.fillStyle=col;
      ctx.font='bold 9px Inter,sans-serif'; ctx.textAlign='center';
      ctx.fillText(t.intent, t.x, t.y + 4);
      ctx.globalAlpha = 1;
    });
  }

  function loop(){
    frame++;
    if(frame % 85 === 0) spawnTicket();
    ctx.clearRect(0, 0, W, H);
    drawHeader();
    var yCh = 44, yCl = H * 0.42, yOut = H - 88;
    drawChannels(yCh);
    drawClassifier(W/2, yCl);
    drawOutcomes(yOut);
    drawFlowLines(yCh, yCl, yOut);
    drawTickets(yCh, yCl, yOut);
    if(frame >= LOOP){
      frame = 0;
      TICKETS = [];
    }
    requestAnimationFrame(loop);
  }
  spawnTicket();
  loop();
})();
</script>
  </section>

  <!-- CTA-1 Артур: после типовых обращений -->
  <div class="vnap-cnt">
    <aside class="ym-cta-block ym-cta-block--primary" id="cta-audit-tipovye">
      <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите список вопросов для автоматизации</p>
        <p class="ym-cta-block__sub">На аудите за 48 часов классифицируем 200–500 ваших обращений и покажем, какие 5–10 сценариев закрыть на пилоте без оператора. Чек-лист до 50 пунктов — бесплатно с демо.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить поддержку</a>
      </div>
    </aside>
  </div>

  <!-- H2-3: #kak-ustroena -->
  <section class="vnap-section" id="kak-ustroena">
    <div class="vnap-cnt">
      <div class="vnap-sh nero-ai-reveal">
        <span class="vnap-eyebrow">Архитектура</span>
        <h2>Как устроена AI-служба поддержки: чат, helpdesk и эскалация</h2>
        <p><strong>Коротко:</strong> канал → классификатор → RAG + CRM → LLM → эскалация с транскриптом и summary.</p>
      </div>
      <div class="vnap-timeline nero-ai-reveal" aria-label="7 шагов от обращения до решения">
        <span>Клиент пишет</span><span class="arr">→</span>
        <span>Классификатор</span><span class="arr">→</span>
        <span>RAG + CRM</span><span class="arr">→</span>
        <span>LLM ответ</span><span class="arr">→</span>
        <span>Риск?</span><span class="arr">→</span>
        <span>Эскалация</span><span class="arr">→</span>
        <span>Аналитика KPI</span>
      </div>
      <div class="vnap-grid-3 nero-ai-reveal" style="margin-top:32px">
        <div class="vnap-card" id="ai-chat-podderzhki">
          <h3>AI чат поддержки и виджет</h3>
          <p>Основной вход для e-commerce и SaaS: виджет + мессенджеры. Клиент пишет свободным текстом — без дерева кнопок. На пилоте: сайт + один мессенджер (Telegram или VK).</p>
        </div>
        <div class="vnap-card" id="ai-helpdesk">
          <h3>AI helpdesk и тикет-система</h3>
          <p>Email, формы, голос. AI классифицирует, тегирует в CRM, создаёт тикет. DPD «Юля»: <strong>57%</strong> звонков, <strong>93%</strong> чатов автоматически.</p>
        </div>
        <div class="vnap-card" id="eskalaciya-operator">
          <h3>Эскалация с полным контекстом</h3>
          <p>Тикет с транскриптом, summary, тегами и рекомендуемым ответом. Клиент не повторяет вопрос второй линии — подход ВТБ GenAI и agent assist Альфа-Банка.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-4: #vnedrenie -->
  <section class="vnap-section vnap-section-alt" id="vnedrenie">
    <div class="vnap-cnt">
      <div class="vnap-sh nero-ai-reveal">
        <span class="vnap-eyebrow">Под ключ</span>
        <h2>Внедрение AI-поддержки под ключ: этапы, сроки и стек</h2>
        <p><strong>Коротко:</strong> аудит → пилот 2–3 недели → production → масштаб. Аудит и демо — <strong>48 часов</strong>.</p>
      </div>
      <div class="vnap-phase nero-ai-reveal">
        <div class="vnap-phase-card">
          <div class="vnap-phase-num">Фаза 0 · 3–5 дней</div>
          <h3>Аудит</h3>
          <p>200–500 обращений, классификация, матрица эскалации, лид-магнит «список вопросов».</p>
        </div>
        <div class="vnap-phase-card">
          <div class="vnap-phase-num">Фаза 1 · 2–3 нед.</div>
          <h3>Пилот</h3>
          <p>5–10 сценариев, RAG, виджет + 1 мессенджер, handoff в Bitrix24/amoCRM.</p>
        </div>
        <div class="vnap-phase-card">
          <div class="vnap-phase-num">Фаза 2 · 2–4 нед.</div>
          <h3>Production</h3>
          <p>Omnichannel, read-only OMS/CRM, дашборд, review 50 диалогов/нед.</p>
        </div>
        <div class="vnap-phase-card">
          <div class="vnap-phase-num">Фаза 3 · опционально</div>
          <h3>Масштаб</h3>
          <p>Agent assist, голос (SpeechKit), write-actions по жёстким правилам.</p>
        </div>
      </div>
      <p class="vnap-related nero-ai-reveal" style="margin-top:24px;font-size:15px">На production этапе read-only к OMS/ERP даёт AI доступ к статусу заказа — тот же паттерн извлечения данных, что в <a href="/ai-1c-erp/" class="ym-link ym-link--accent">внедрении AI-агента для 1С и ERP</a>, адаптированный под helpdesk вместо счетов и накладных.</p>
      <p class="vnap-related nero-ai-reveal" style="margin-top:16px;font-size:15px">Для крупных контакт-центров полезно смотреть на enterprise-опыт: в разборе <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" class="ym-link ym-link--accent">KPMG и Claude — уроки AI для бизнеса</a> — цифровые шлюзы и managed-агенты, которые масштабируют первую линию без потери контроля.</p>
      <p class="nero-ai-reveal" style="margin-top:24px"><strong>Разработка и настройка ai поддержка клиентов</strong> в модели Nero Network — Make/n8n + CRM + RAG + compliance 152-ФЗ. Middle между SaaS-виджетом за 990 ₽/мес и enterprise CraftTalk/Just AI.</p>
    </div>
  </section>

  <!-- CTA-2 Артур: после внедрения -->
  <div class="vnap-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie-vnedrenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите понимать стек до старта пилота?</p>
        <p class="ym-cta-block__sub">Если команда хочет разобраться в RAG, n8n/Make и human-in-the-loop до подписания сметы — посмотрите <a href="<?php echo esc_url($secondary_cta_url ?: getenv('SECONDARY_CTA_URL') ?: '#vnedrenie'); ?>" class="ym-link ym-link--accent"><?php echo esc_html($secondary_cta_label ?: (getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI')); ?></a>. Это ускоряет согласование этапов аудита и пилота.</p>
      </div>
    </aside>
  </div>

  <!-- H2-5: #integracii -->
  <section class="vnap-section" id="integracii">
    <div class="vnap-cnt">
      <div class="vnap-sh vnap-left nero-ai-reveal">
        <span class="vnap-eyebrow">Интеграции</span>
        <h2>Интеграция AI-поддержки с CRM, базой знаний и каналами</h2>
        <p><strong>Коротко:</strong> без интеграции с CRM AI отвечает «в вакууме» — не видит заказ, не создаёт тикет.</p>
      </div>
      <div class="vnap-grid-2 nero-ai-reveal">
        <div class="vnap-card">
          <h3>Связка с amoCRM, Битрикс24 и тикет-системами</h3>
          <p>На пилоте — read-only: статус заказа, история клиента. При эскалации — создание тикетов. Поддерживаем amoCRM, Bitrix24, RetailCRM, Мегаплан.</p>
          <div class="vnap-logo-strip">
            <span class="vnap-logo-pill">amoCRM</span>
            <span class="vnap-logo-pill">Битрикс24</span>
            <span class="vnap-logo-pill">RetailCRM</span>
            <span class="vnap-logo-pill">Jivo</span>
          </div>
        </div>
        <div class="vnap-card" style="border-color:rgba(121,242,255,.25)">
          <h3>База знаний, RAG и n8n/Make</h3>
          <p>RAG по FAQ и политикам. Guardrails, confidence threshold, еженедельный аудит 50 диалогов. <strong>152-ФЗ:</strong> YandexGPT/GigaChat, ПДн в РФ.</p>
          <div class="vnap-logo-strip">
            <span class="vnap-logo-pill">n8n</span>
            <span class="vnap-logo-pill">Make</span>
            <span class="vnap-logo-pill">YandexGPT</span>
            <span class="vnap-logo-pill">GigaChat</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-6: #keisy -->
  <section class="vnap-section vnap-section-alt" id="keisy">
    <div class="vnap-cnt">
      <div class="vnap-sh nero-ai-reveal">
        <span class="vnap-eyebrow">Кейсы и ROI</span>
        <h2>Кейсы и ROI: сколько обращений снимает AI по отраслям</h2>
        <p>Коридор автоматизации в открытых источниках: <strong>40–70%</strong> для чата, <strong>50–52%</strong> для голоса.</p>
      </div>
      <div class="vnap-grid-3 nero-ai-reveal">
        <div class="vnap-card">
          <h3>E-commerce</h3>
          <ul>
            <li>VseMayki: <strong>70%</strong> без менеджера, 10 сек ответ</li>
            <li>М.Видео «Алёна»: <strong>60%</strong>, статус — 52%</li>
            <li>Klarna: 2/3 чатов, −25% повторных</li>
          </ul>
        </div>
        <div class="vnap-card">
          <h3>SaaS</h3>
          <ul>
            <li>Intercom Fin: <strong>67%</strong> resolution rate</li>
            <li>Тариф, доступ, биллинг, onboarding</li>
            <li>Триалы не «протухают» ночью</li>
          </ul>
        </div>
        <div class="vnap-card">
          <h3>Банки и телеком</h3>
          <ul>
            <li>Альфа-Банк RAG: поиск БЗ ×20 быстрее</li>
            <li>Ренессанс: <strong>52%</strong> на голосе</li>
            <li>Ростелеком: <strong>50%</strong> в чатах</li>
          </ul>
        </div>
      </div>
      <p class="nero-ai-reveal" style="text-align:center;margin-top:20px">Метрики пилота: automation rate, FCR (70–85%), median response time, CSAT, cost per resolution. Gartner: self-service <strong>$1.84</strong> vs assisted <strong>$13.50</strong>.</p>
    </div>
  </section>

  <!-- H2-7: #stoimost -->
  <section class="vnap-section" id="stoimost">
    <div class="vnap-cnt">
      <div class="vnap-sh nero-ai-reveal">
        <span class="vnap-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения AI-поддержки и окупаемость</h2>
        <p>Ориентир <strong>внедрение ai поддержка клиентов под ключ</strong> — <strong>180–600 тыс. ₽</strong>. Точная смета — после аудита.</p>
      </div>
      <div class="vnap-table-wrap nero-ai-reveal">
        <table class="vnap-table" aria-label="Факторы цены">
          <thead><tr><th>Фактор</th><th>Влияние на бюджет</th></tr></thead>
          <tbody>
            <tr><td>Число каналов (сайт + мессенджеры + email + голос)</td><td>+20–40% за канал на production</td></tr>
            <tr><td>Интеграции CRM/OMS</td><td>Пилот read-only; write-actions — отдельная фаза</td></tr>
            <tr><td>База знаний и миграция</td><td>От 0 до 2–3 недель структурирования</td></tr>
            <tr><td>Agent assist и голос</td><td>Фаза 3, не обязательна на старте</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px"><strong>AI поддержка клиентов для малого бизнеса</strong> — реалистична при 5–10 сценариях: виджет, Telegram, RAG, handoff в CRM. Пилот за 2–3 недели даёт цифры для решения о production.</p>
    </div>
  </section>

  <!-- H2-8: #riski -->
  <section class="vnap-section vnap-section-alt" id="riski">
    <div class="vnap-cnt">
      <div class="vnap-sh nero-ai-reveal">
        <span class="vnap-eyebrow">Риски</span>
        <h2>Риски внедрения и как их снижать</h2>
        <p>Главные риски — галлюцинации, плохой handoff, обещания AI сверх полномочий, утечка ПДн.</p>
      </div>
      <div class="vnap-grid-2 nero-ai-reveal">
        <div class="vnap-card" style="border-color:rgba(34,197,94,.25)">
          <h3 style="color:var(--vnap-green)">AI может</h3>
          <ul>
            <li>FAQ 24/7 за секунды</li>
            <li>Статус заказа read-only</li>
            <li>Сбор данных перед эскалацией</li>
            <li>Summary для оператора</li>
            <li>Классификация и теги в CRM</li>
          </ul>
        </div>
        <div class="vnap-card" style="border-color:rgba(245,158,11,.35)">
          <h3 style="color:var(--vnap-amber)">AI не может</h3>
          <ul>
            <li>Споры, компенсации, исключения</li>
            <li>Возвраты выше порога суммы</li>
            <li>Эмоционально заряженные кейсы</li>
            <li>Юридические и мед/фин претензии</li>
            <li>Финальная модерация write-actions</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-9: #faq -->
  <section class="vnap-section" id="faq">
    <div class="vnap-cnt">
      <div class="vnap-sh nero-ai-reveal">
        <span class="vnap-eyebrow">FAQ</span>
        <h2>FAQ по внедрению AI-поддержки клиентов</h2>
      </div>
      <div class="vnap-faq nero-ai-reveal">
        <details><summary>Что такое AI-поддержка клиентов 24/7?</summary>
          <div class="vnap-faq-body">Круглосуточная первая линия на LLM + RAG + интеграциях: типовые вопросы за секунды, сложные — оператору с полным контекстом. Гибридная модель, не замена всей команды.</div></details>
        <details><summary>Какие вопросы автоматизировать в первую очередь?</summary>
          <div class="vnap-faq-body">Статус заказа, доставка, возврат по FAQ, тарифы, часы, оплата, доступ к аккаунту. Список формируем на аудите за 48 часов из ваших реальных обращений.</div></details>
        <details><summary>Сколько времени занимает внедрение?</summary>
          <div class="vnap-faq-body">Аудит 3–5 дней. Пилот 2–3 недели. Production 2–4 недели. Голос и write-actions — опциональная фаза 3.</div></details>
        <details><summary>Как AI передаёт диалог оператору?</summary>
          <div class="vnap-faq-body">Тикет в CRM с транскриптом, summary, тегами и рекомендуемым ответом. Клиент не повторяет вопрос — контекст уже у оператора.</div></details>
        <details><summary>Нужна ли интеграция с CRM?</summary>
          <div class="vnap-faq-body">Да, для статуса заказа, истории клиента и эскалации. На пилоте достаточно read-only + создание тикетов при handoff.</div></details>
        <details><summary>Подходит ли для малого бизнеса?</summary>
          <div class="vnap-faq-body">Да, при 5–10 типовых сценариях: виджет, один мессенджер, RAG по FAQ. VseMayki — 70% в e-commerce.</div></details>
        <details><summary>Качество на русском языке?</summary>
          <div class="vnap-faq-body">RAG по вашим текстам, YandexGPT/GigaChat, еженедельный аудит диалогов. Опираемся на вашу БЗ, не на общие знания модели.</div></details>
        <details><summary>Сколько стоит ai поддержка клиентов?</summary>
          <div class="vnap-faq-body">Ориентир 180–600 тыс. ₽ под ключ. Точная смета — после аудита; пилот проверяет ROI до полного масштаба.</div></details>
      </div>
    </div>
  </section>

  <!-- H2-10: #cta финальный -->
  <section class="vnap-section vnap-section-alt" id="cta">
    <div class="vnap-cnt">
      <div class="ym-cta-block ym-cta-block--dual" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить поддержку — аудит типовых обращений</p>
          <p class="ym-cta-block__sub">Аудит за 48 часов, демо на ваших вопросах, чек-лист автоматизации и внедрение под ключ от пилота до production с CRM, RAG и compliance 152-ФЗ.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить поддержку</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы и ответы</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.vnap-content -->

<?php
$vnas_page_url = trailingslashit( get_permalink() );
$vnas_site_url = trailingslashit( home_url( '/' ) );
$vnas_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vnas_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vnas_site_url . '#organization',
      'name'  => $vnas_brand,
      'url'   => $vnas_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vnas_site_url . '#website',
      'url'       => $vnas_site_url,
      'name'      => $vnas_brand,
      'publisher' => [ '@id' => $vnas_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vnas_page_url . '#webpage',
      'url'         => $vnas_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vnas_site_url . '#website' ],
      'about'       => [ '@id' => $vnas_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vnas_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnas_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vnas_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vnas_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $vnas_page_url,
      'provider'    => [ '@id' => $vnas_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vnas_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Что такое AI-поддержка клиентов 24/7?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Круглосуточная первая линия на LLM + RAG + интеграциях: типовые вопросы за секунды, сложные — оператору с полным контекстом. Гибридная модель, не замена всей команды.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие вопросы автоматизировать в первую очередь?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Статус заказа, доставка, возврат по FAQ, тарифы, часы, оплата, доступ к аккаунту. Список формируем на аудите за 48 часов из ваших реальных обращений.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько времени занимает внедрение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит 3–5 дней. Пилот 2–3 недели. Production 2–4 недели. Голос и write-actions — опциональная фаза 3.' ] ],
        [ '@type' => 'Question', 'name' => 'Как AI передаёт диалог оператору?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Тикет в CRM с транскриптом, summary, тегами и рекомендуемым ответом. Клиент не повторяет вопрос — контекст уже у оператора.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужна ли интеграция с CRM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, для статуса заказа, истории клиента и эскалации. На пилоте достаточно read-only + создание тикетов при handoff.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходит ли для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, при 5–10 типовых сценариях: виджет, один мессенджер, RAG по FAQ. VseMayki — 70% в e-commerce.' ] ],
        [ '@type' => 'Question', 'name' => 'Качество на русском языке?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'RAG по вашим текстам, YandexGPT/GigaChat, еженедельный аудит диалогов. Опираемся на вашу БЗ, не на общие знания модели.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит ai поддержка клиентов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир 180–600 тыс. ₽ под ключ. Точная смета — после аудита; пилот проверяет ROI до полного масштаба.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnas_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
/**
 * vnas-support-dispatch-engine — Диспетчерская «AI Support Center 24/7»
 * Мир: омниканальные ленты → RAG-хаб → resolve / handoff оператору
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnas-helpdesk-hub-canvas");
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
    scale = Math.min(cw / 420, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    hubBase: "#1e293b",
    hubAccent: "#22c55e",
    hubCyan: "#79f2ff",
    hubViolet: "#8b5cf6",
    laneChat: "rgba(121,242,255,0.35)",
    laneMsg: "rgba(139,92,246,0.35)",
    laneVoice: "rgba(245,158,11,0.35)",
    bubbleUser: "#f8fafc",
    bubbleAi: "rgba(34,197,94,0.22)",
    amber: "#f59e0b",
    spam: "#fb7185",
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

  function drawChatBubble(ctx, x, y, w, h, color, tail) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, color, C.outline);
    if (tail) {
      ctx.fillStyle = color;
      ctx.beginPath();
      ctx.moveTo(x - 4, y + h / 2 - 1);
      ctx.lineTo(x + 4, y + h / 2 - 1);
      ctx.lineTo(x, y + h / 2 + 5);
      ctx.fill();
    }
  }

  /* Вертикальные ленты каналов — транспорт (не конвейер) */
  function OmniLaneStream() {
    this.phase = 0;
  }
  OmniLaneStream.prototype.draw = function (ctx) {
    this.phase = (frame * 0.035) % 1;
    var lanes = [
      { x: -155, color: C.laneChat, label: "чат", icon: "💬" },
      { x: -125, color: C.laneMsg, label: "TG", icon: "✈" },
      { x: -95, color: C.laneVoice, label: "голос", icon: "☎" }
    ];
    lanes.forEach(function (lane) {
      ctx.strokeStyle = lane.color;
      ctx.lineWidth = 2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.55;
      ctx.beginPath();
      ctx.moveTo(lane.x, -95);
      ctx.lineTo(lane.x, 55);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = lane.color;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(lane.label, lane.x, -102);
    });

    for (var i = 0; i < 6; i++) {
      var lane = lanes[i % 3];
      var t = (this.phase + i * 0.17) % 1;
      var by = -90 + t * 140;
      var bw = 22 + (i % 2) * 6;
      var bh = 12;
      var col = i % 5 === 4 ? C.amber : C.bubbleUser;
      drawChatBubble(ctx, lane.x, by, bw, bh, col, true);
    }
  };

  /* Центральный helpdesk-хаб — вместо WebsiteTerminal */
  function SupportRoutingHub() {
    this.resolveFlash = 0;
    this.handoffY = 0;
  }
  SupportRoutingHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 250;

    drawRR(ctx, -62, -72, 124, 148, 12, C.hubBase, C.outline);

    /* Экран очереди */
    drawRR(ctx, -50, -58, 100, 70, 6, "rgba(255,255,255,0.06)", C.hubCyan);
    var tickets = ["#4821", "#4822", "#4823"];
    tickets.forEach(function (t, i) {
      var ty = -48 + i * 18;
      var active = prg > 70 && prg < 150 && i === 0;
      drawRR(ctx, -42, ty, 84, 14, 3, active ? C.bubbleAi : "rgba(255,255,255,0.04)", active ? C.hubAccent : C.outline);
      ctx.fillStyle = active ? "#bbf7d0" : "#cbd5e1";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(t + (active ? " · AI" : ""), -36, ty + 10);
    });

    /* RAG-ответ в фазе RESOLVE */
    if (prg >= 80 && prg < 155) {
      this.resolveFlash = Math.sin((prg - 80) * 0.12) * 0.4 + 0.6;
      drawRR(ctx, -48, 22, 96, 28, 6, "rgba(34,197,94," + (0.12 + this.resolveFlash * 0.15) + ")", C.hubAccent);
      ctx.fillStyle = "#86efac";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Ответ из БЗ · 10 сек", 0, 36);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("статус заказа: в пути", 0, 44);
    }

    /* HANDOFF — summary к оператору */
    if (prg >= 165) {
      var hp = Math.min(1, (prg - 165) / 28);
      this.handoffY = -20 - hp * 55;
      drawRR(ctx, 35, this.handoffY, 58, 34, 6, "rgba(245,158,11,0.22)", C.amber);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("SUMMARY", 64, this.handoffY + 12);
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("негатив · контекст", 64, this.handoffY + 22);

      if (prg > 188 && prg < 228) {
        var pulse = (prg - 188) / 40;
        ctx.strokeStyle = "rgba(245,158,11," + (0.75 - pulse * 0.65) + ")";
        ctx.lineWidth = 2.5;
        ctx.beginPath();
        ctx.arc(64, this.handoffY + 17, 18 + pulse * 32, 0, Math.PI * 2);
        ctx.stroke();
      }
    } else {
      this.handoffY = 0;
    }
  };

  /* Кольцо классификации интентов */
  function IntentClassifierRing() {
    this.angle = 0;
  }
  IntentClassifierRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 250;
    this.angle = frame * 0.018;
    if (prg < 75) return;

    var tags = ["доставка", "возврат", "тариф"];
    tags.forEach(function (tag, i) {
      var a = this.angle + i * (Math.PI * 2 / 3);
      var tx = Math.cos(a) * 38;
      var ty = -88 + Math.sin(a) * 12;
      drawRR(ctx, tx - 22, ty - 7, 44, 14, 4, "rgba(139,92,246,0.2)", C.hubViolet);
      ctx.fillStyle = "#ddd6fe";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(tag, tx, ty + 4);
    }, this);
  };

  /* Мост эскалации к оператору */
  function EscalationHandoffBridge() {
    this.glow = 0;
  }
  EscalationHandoffBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 250;
    drawRR(ctx, 108, -18, 42, 56, 8, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("оператор", 129, -6);

    /* Силуэт оператора */
    ctx.fillStyle = C.hubCyan;
    ctx.beginPath();
    ctx.arc(129, 8, 10, 0, Math.PI * 2);
    ctx.fill();
    drawRR(ctx, 119, 18, 20, 22, 4, C.hubCyan, C.outline);

    if (prg >= 175) {
      this.glow = Math.min(1, (prg - 175) / 20);
      ctx.strokeStyle = "rgba(245,158,11," + this.glow * 0.8 + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(62, -5);
      ctx.lineTo(108, 5);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  };

  /* Шкала confidence */
  function ConfidenceMeter() {
    this.val = 0.5;
  }
  ConfidenceMeter.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 250;
    if (prg < 50) this.val = 0.42 + prg / 50 * 0.18;
    else if (prg < 120) this.val = 0.6 + (prg - 50) / 70 * 0.22;
    else if (prg < 170) this.val = 0.82 + (prg - 120) / 50 * 0.1;
    else this.val = 0.38;

    drawRR(ctx, -58, 78, 116, 14, 4, "rgba(255,255,255,0.06)", C.outline);
    var fillW = 112 * this.val;
    var barColor = this.val > 0.75 ? C.hubAccent : (this.val > 0.5 ? C.hubCyan : C.amber);
    drawRR(ctx, -56, 80, fillW, 10, 3, barColor, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("confidence " + Math.round(this.val * 100) + "%", 0, 88);
  };

  /* Пульс CSAT при resolve */
  function SatisfactionPulse() {
    this.r = 0;
  }
  SatisfactionPulse.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 250;
    if (prg < 95 || prg > 145) { this.r = 0; return; }
    this.r = (prg - 95) / 50;
    ctx.strokeStyle = "rgba(34,197,94," + (0.7 - this.r * 0.65) + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, -15, 28 + this.r * 45, 0, Math.PI * 2);
    ctx.stroke();
    if (prg > 110 && prg < 125) {
      ctx.fillStyle = C.hubAccent;
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("✓ resolved", 0, -12);
    }
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
    var prg = (frame * 0.042) % 250;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    /* Агенты сходятся сверху к хабу — иная геометрия */
    var hubTargets = {
      "1_architect": { x: -45, y: -95 },
      "2_seo": { x: 0, y: -105 },
      "3_coder": { x: 45, y: -95 },
      "4_designer": { x: -25, y: -115 },
      "5_deployer": { x: 25, y: -115 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: -100 };

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
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 10 ? this.color : null;
    }

    if (!isMoving && frame % 210 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 210);
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
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var lanes = new OmniLaneStream();
  var hub = new SupportRoutingHub();
  var intentRing = new IntentClassifierRing();
  var handoffBridge = new EscalationHandoffBridge();
  var confidence = new ConfidenceMeter();
  var csatPulse = new SatisfactionPulse();

  entities.push(lanes);
  entities.push(hub);
  entities.push(intentRing);
  entities.push(confidence);
  entities.push(csatPulse);
  entities.push(handoffBridge);
  entities.push(new Agent(-130, -55, C.agentYellow, "1_architect", 20, [
    "Матрица эскалации", "AI не обещает скидки", "Порог confidence 0.85"
  ]));
  entities.push(new Agent(-65, -48, C.agentGreen, "2_seo", 58, [
    "Intent: статус заказа", "Тег: доставка", "FAQ покрыт на 67%"
  ]));
  entities.push(new Agent(0, -45, C.agentBlue, "3_coder", 102, [
    "RAG chunk=512", "YandexGPT guardrails", "Read-only CRM"
  ]));
  entities.push(new Agent(65, -48, C.agentPink, "4_designer", 148, [
    "Summary для оператора", "Тон бренда в чате", "Кнопка «человек»"
  ]));
  entities.push(new Agent(130, -55, C.agentPurple, "5_deployer", 188, [
    "Виджет 24/7 live", "Handoff в amoCRM", "FCR дашборд"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 230, maxLife: life || 230 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 250;
    if (prg >= 18 && prg < 18.05) createBubble(-125, -30, "1. Обращение в канал");
    if (prg >= 62 && prg < 62.05) createBubble(-40, -70, "2. Классификация интента");
    if (prg >= 108 && prg < 108.05) createBubble(0, -20, "3. RAG + ответ AI");
    if (prg >= 158 && prg < 158.05) createBubble(55, 10, "4. Типовой закрыт ✓");
    if (prg >= 198 && prg < 198.05) createBubble(120, -15, "5. Handoff оператору");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.hubAccent);
      ctx.fillStyle = C.bubbleText;
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
