<?php
/**
 * Template Name: AI-агент для памяток пациенту после приёма: внедрение под ключ
 * Description: SEO-лендинг — AI-памятки после приёма для клиник. Human-in-the-loop, МИС/CRM, 152-ФЗ.
 */

$page_seo_title       = 'AI-агент для памяток пациенту после приёма: внедрение под ключ';
$page_seo_description = 'AI собирает памятку после приёма по шаблонам клиники — врач проверяет, пациент не забывает рекомендации. Внедрение под ключ, МИС и CRM. Заявка на расчёт.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Примеры', 'href' => '#primery'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать памятки';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

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

.pam-section-tight{padding:clamp(28px,4vw,40px) 0;}
.pam-intro{padding:clamp(40px,5vw,72px) 0 clamp(36px,4.5vw,56px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.pam-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.pam-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.pam-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,#79f2ff,#8b5cf6);}
.pam-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:#9aa8bd;margin:0 0 1em;}
.pam-intro-text p:last-child{margin-bottom:0;color:#c7d2e5;}
.pam-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.pam-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);}
.pam-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:#fff;letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.pam-kpi-card .kl{font-size:11px;font-weight:600;color:#9aa8bd;line-height:1.4;}
.pam-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.pam-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.pam-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid rgba(255,255,255,.10);border-radius:999px;font-size:13px;font-weight:600;color:#9aa8bd;transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.pam-toc a:hover{border-color:rgba(121,242,255,.42);color:#79f2ff;background:rgba(121,242,255,.08);}
.pam-content .nero-ai-btn{display:inline-flex;align-items:center;justify-content:center;min-height:48px;padding:14px 20px;border-radius:999px;border:1px solid transparent;font-size:15px;font-weight:800;line-height:1;text-decoration:none!important;transition:transform .22s ease,border-color .22s ease,background .22s ease;}
.pam-content .nero-ai-btn:hover{transform:translateY(-2px);}
.pam-content .nero-ai-btn-primary{color:#031018!important;background:linear-gradient(135deg,#79f2ff,#a7f3d0);box-shadow:0 18px 42px rgba(121,242,255,.22);}
.pam-content .nero-ai-btn-secondary{color:#e6edf7!important;background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.14);}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:900px){.pam-intro-grid{grid-template-columns:1fr;gap:36px;}.pam-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.pam-intro-kpi{grid-template-columns:1fr 1fr;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-pamyatka-pacientu-page" role="main" tabindex="-1">

<section class="nero-ai-hero pam-hero-postvisit" id="hero" aria-labelledby="pam-hero-title">
<style>
/* ── Hero patient memo: самодостаточные стили (без CSS темы) ── */
.pam-hero-postvisit {
  --pam-cyan: #79f2ff;
  --pam-violet: #8b5cf6;
  --pam-green: #22c55e;
  --pam-amber: #f59e0b;
  --pam-text: #e6edf7;
  --pam-muted: #9aa8bd;
  --pam-soft: #c7d2e5;
  --pam-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.pam-hero-postvisit::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 45% 30%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.pam-hero-postvisit::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(34, 197, 94, .10), transparent 66%);
  filter: blur(6px);
  animation: pamHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes pamHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.pam-hero-postvisit .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.pam-hero-postvisit .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.pam-hero-postvisit .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.pam-hero-postvisit .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--pam-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.pam-hero-postvisit .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--pam-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.pam-hero-postvisit .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--pam-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.pam-hero-postvisit .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.pam-hero-postvisit .nero-ai-badge {
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
.pam-hero-postvisit .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.pam-hero-postvisit .nero-ai-btn {
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
.pam-hero-postvisit .nero-ai-btn:hover { transform: translateY(-2px); }
.pam-hero-postvisit .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--pam-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.pam-hero-postvisit .nero-ai-btn-secondary {
  color: var(--pam-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.pam-hero-postvisit .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--pam-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.pam-hero-postvisit .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.pam-hero-postvisit .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.pam-hero-postvisit .nero-ai-dots { display: flex; gap: 7px; }
.pam-hero-postvisit .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.pam-hero-postvisit .nero-ai-dot:nth-child(1) { background: #fb7185; }
.pam-hero-postvisit .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.pam-hero-postvisit .nero-ai-dot:nth-child(3) { background: #34d399; }
.pam-hero-postvisit .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.pam-hero-postvisit .nero-ai-window-body { padding: 16px; }
.pam-hero-postvisit .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.pam-hero-postvisit .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.pam-hero-postvisit .nero-ai-live-pill {
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
.pam-hero-postvisit .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: pamPulse 1.6s infinite;
}
@keyframes pamPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.pam-hero-postvisit .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.pam-hero-postvisit .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.pam-hero-postvisit .nero-ai-metric span {
  display: block;
  color: var(--pam-muted);
  font-size: 11px;
  font-weight: 700;
}
.pam-hero-postvisit .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.pam-hero-postvisit .pam-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(34, 197, 94, 0.18);
  background: radial-gradient(ellipse at 50% 40%, rgba(34,197,94,.08), rgba(6,10,24,.9) 70%);
}
.pam-hero-postvisit #pam-postvisit-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.pam-hero-postvisit .nero-ai-task-stream { display: grid; gap: 8px; }
.pam-hero-postvisit .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.pam-hero-postvisit .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--pam-cyan);
  font-size: 13px;
  font-weight: 800;
}
.pam-hero-postvisit .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.pam-hero-postvisit .nero-ai-task span {
  color: var(--pam-muted);
  font-size: 11px;
}
.pam-hero-postvisit .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.pam-hero-postvisit .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.pam-hero-postvisit .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #bae6fd;
}
@media (max-width: 1100px) {
  .pam-hero-postvisit .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .pam-hero-postvisit .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .pam-hero-postvisit .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .pam-hero-postvisit .nero-ai-window-body { padding: 12px; }
  .pam-hero-postvisit .nero-ai-task { grid-template-columns: 28px 1fr; }
  .pam-hero-postvisit .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow">Медицина / post-visit · внедрение под ключ</p>
    <h1 id="pam-hero-title">AI-агент для памяток пациенту после приёма: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
    <p class="nero-ai-hero-lead">AI собирает понятную памятку по шаблонам вашей клиники — врач проверяет, пациент не забывает рекомендации и реже звонит с повторными вопросами</p>
    <ul class="nero-ai-badges" aria-label="Ключевые возможности">
      <li class="nero-ai-badge">Шаблоны клиники</li>
      <li class="nero-ai-badge">Human-in-the-loop</li>
      <li class="nero-ai-badge">МИС / CRM</li>
      <li class="nero-ai-badge">152-ФЗ</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Собрать памятки</a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация post-visit AI-памяток">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>Post-visit центр</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>Приёмов сегодня</span>
            <strong>18</strong>
          </div>
          <div class="nero-ai-metric">
            <span>Черновиков AI</span>
            <strong>16</strong>
          </div>
          <div class="nero-ai-metric">
            <span>Ожидают approve</span>
            <strong>2</strong>
          </div>
          <div class="nero-ai-metric">
            <span>Отправлено пациентам</span>
            <strong>14</strong>
          </div>
        </div>

        <div class="pam-dash-canvas-wrap" aria-hidden="false">
          <canvas id="pam-postvisit-canvas" role="img" aria-label="Анимация: визит закрывается, AI собирает памятку, врач утверждает, пациент получает SMS"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента событий post-visit">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">✓</span>
            <div><strong>Приём #1847 закрыт</strong><span>Стоматология · протокол из МИС</span></div>
            <span class="nero-ai-status">intake</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">AI</span>
            <div><strong>Черновик памятки собран</strong><span>6 блоков · plain language</span></div>
            <span class="nero-ai-status nero-ai-status--cyan">compose</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">⚕</span>
            <div><strong>Ожидает approve врача</strong><span>Др. Соколова · 2 в очереди</span></div>
            <span class="nero-ai-status nero-ai-status--amber">review</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">📱</span>
            <div><strong>Памятка отправлена пациенту</strong><span>SMS + Telegram · визит #1842</span></div>
            <span class="nero-ai-status">delivered</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<script>
/**
 * pam-postvisit-engine — Диспетчерская «Клиника памяток»
 * Мир: карточки визитов по коридору → AI-сборка памятки → approve врача → доставка пациенту
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("pam-postvisit-canvas");
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
    cardBg: "#f8fafc",
    cardAccent: "#e2e8f0",
    corridor: "rgba(121,242,255,0.18)",
    corridorGlow: "rgba(139,92,246,0.28)",
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    hubGreen: "#22c55e",
    hubAmber: "#f59e0b",
    chipBlue: "#93c5fd",
    chipGreen: "#a7f3d0",
    stampRed: "#ef4444",
    phoneGlow: "#34d399",
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

  /* Коридор визитов — дугообразный поток карточек (не конвейер) */
  function VisitCardStream() {
    this.flowPhase = 0;
  }
  VisitCardStream.prototype.draw = function (ctx) {
    this.flowPhase = (frame * 0.028) % (Math.PI * 2);
    var arcs = [
      { rx: 125, ry: 48, y: -15, dash: [5, 7] },
      { rx: 95, ry: 36, y: 5, dash: [4, 9] }
    ];
    arcs.forEach(function (arc, idx) {
      ctx.save();
      ctx.strokeStyle = idx === 0 ? C.corridorGlow : C.corridor;
      ctx.lineWidth = idx === 0 ? 2 : 1;
      ctx.setLineDash(arc.dash);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.ellipse(0, arc.y, arc.rx, arc.ry, 0, Math.PI * 0.15, Math.PI * 0.85);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    for (var i = 0; i < 4; i++) {
      var t = (this.flowPhase + i * 1.4) % (Math.PI * 0.7);
      var ang = Math.PI * 0.15 + t;
      var ex = Math.cos(ang) * 125;
      var ey = -15 + Math.sin(ang) * 48;
      drawVisitCard(ctx, ex, ey, 16, 12, i === 0 ? C.hubAccent : C.cardBg);
    }
  };

  function drawVisitCard(ctx, x, y, w, h, color) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("VIS", 0, 2);
    ctx.restore();
  }

  /* Центральный стол памятки — вместо WebsiteTerminal */
  function MemoComposerHub() {
    this.sectionFill = 0;
    this.stampAlpha = 0;
    this.sendPulse = 0;
  }
  MemoComposerHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.sectionFill = Math.min(1, Math.max(0, (prg - 40) / 80));
    this.stampAlpha = 0;
    this.sendPulse = 0;

    drawRR(ctx, -58, -78, 116, 156, 10, C.hubBase, C.outline);

    /* Лист памятки */
    drawRR(ctx, -42, -62, 84, 110, 6, "#fff", C.outline);
    var sections = ["Сегодня", "24 часа", "Срочно"];
    sections.forEach(function (s, i) {
      var fillW = 60 * (i < Math.floor(this.sectionFill * 3) ? 1 : (this.sectionFill * 3 - i));
      if (fillW > 0) {
        drawRR(ctx, -34, -48 + i * 22, Math.min(60, fillW), 8, 3, i === 2 ? "rgba(245,158,11,0.35)" : C.chipGreen, null);
      }
      ctx.fillStyle = "#64748b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(s, -34, -42 + i * 22);
    }, this);

    /* Фаза COMPOSE — чипы назначений */
    if (prg >= 50 && prg < 130) {
      var chips = ["Амокс.", "Обезб.", "Контроль"];
      chips.forEach(function (c, i) {
        var cx2 = 62 + Math.sin(frame * 0.07 + i) * 3;
        var cy2 = -52 + i * 20;
        drawRR(ctx, cx2, cy2, 36, 14, 4, C.chipBlue, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(c, cx2 + 18, cy2 + 10);
      });
    }

    /* Фаза REVIEW — печать approve */
    if (prg >= 130 && prg < 195) {
      this.stampAlpha = Math.min(1, (prg - 130) / 25);
      ctx.save();
      ctx.globalAlpha = this.stampAlpha;
      ctx.strokeStyle = C.stampRed;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(28, 20, 14 + Math.sin(frame * 0.12) * 2, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.stampRed;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("OK", 28, 23);
      ctx.restore();
    }

    /* Фаза DELIVER — луч к телефону пациента */
    if (prg >= 195) {
      var sendPrg = Math.min(1, (prg - 195) / 30);
      this.sendPulse = sendPrg;
      ctx.strokeStyle = "rgba(52,211,153," + (0.8 - sendPrg * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(0, 55);
      ctx.quadraticCurveTo(55, 70, 95, 45);
      ctx.stroke();
      ctx.setLineDash([]);
    }

    ctx.fillStyle = C.hubGreen;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "right";
    ctx.fillText("+" + (prg > 210 ? 1 : 0) + " сегодня", 48, -68);
  };

  /* Полка шаблонов клиники */
  function TemplateShelf() {
    this.highlight = 0;
  }
  TemplateShelf.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -168, -55, 42, 70, 5, "rgba(255,255,255,0.06)", C.outline);
    var folders = ["Стом.", "Дерм.", "Хир."];
    folders.forEach(function (f, i) {
      var active = prg > 20 && prg < 70 && i === 1;
      drawRR(ctx, -160, -48 + i * 20, 26, 16, 3, active ? "rgba(121,242,255,0.25)" : "rgba(139,92,246,0.15)", C.outline);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(f, -147, -38 + i * 20);
    });
  };

  /* Врачебная печать approve */
  function ApproveSealGate() {
    this.ring = 0;
  }
  ApproveSealGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 125 || prg > 200) return;
    this.ring = Math.sin((prg - 125) * 0.08) * 0.5 + 0.5;
    ctx.strokeStyle = "rgba(245,158,11," + (0.3 + this.ring * 0.4) + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(-95, 25, 16 + this.ring * 6, 0, Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = C.hubAmber;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("MD", -95, 28);
  };

  /* Сигнал доставки на телефон пациента */
  function PatientDeliveryBeacon() {
    this.pulse = 0;
  }
  PatientDeliveryBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 118, 28, 28, 44, 6, "rgba(15,23,42,0.9)", C.outline);
    drawRR(ctx, 122, 34, 20, 28, 3, "#0f172a", C.phoneGlow);
    if (prg >= 200) {
      this.pulse = Math.min(1, (prg - 200) / 20);
      ctx.strokeStyle = "rgba(52,211,153," + (0.9 - this.pulse * 0.6) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(132, 48, 10 + this.pulse * 22, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.phoneGlow;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("SMS", 132, 50);
    }
  };

  var visitStream = new VisitCardStream();
  var memoHub = new MemoComposerHub();
  var templateShelf = new TemplateShelf();
  var approveGate = new ApproveSealGate();
  var deliveryBeacon = new PatientDeliveryBeacon();

  var agents = [
    new Agent(-140, 75, C.agentYellow, "1_architect", [
      "Шаблон стоматологии готов",
      "Мастер-блоки утверждены",
      "Протокол клиники подключён"
    ]),
    new Agent(-105, 95, C.agentGreen, "2_seo", [
      "Plain language — 6-й класс",
      "Блок «срочно» на месте",
      "Читаемость памятки ок"
    ]),
    new Agent(0, 105, C.agentBlue, "3_coder", [
      "МИС отдала протокол",
      "Поля визита извлечены",
      "Триггер post-visit сработал"
    ]),
    new Agent(70, 90, C.agentPink, "4_designer", [
      "Таймлайн: сегодня → неделя",
      "Чипы назначений вставлены",
      "Мобильный preview готов"
    ]),
    new Agent(130, 78, C.agentPurple, "5_deployer", [
      "SMS + Telegram отправлено",
      "Копия в карте визита",
      "Журнал 152-ФЗ записан"
    ])
  ];

  function Agent(x, y, color, role, dialogs) {
    this.homeX = x;
    this.homeY = y;
    this.x = x;
    this.y = y;
    this.color = color;
    this.role = role;
    this.dialogs = dialogs;
    this.bubble = null;
    this.bubbleTimer = 0;
    this.stepTrig = Math.floor(Math.random() * 80);
    this.walkPhase = Math.random() * 6;
  }

  Agent.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    var targets = {
      "1_architect": { x: -145, y: -20, active: prg > 15 && prg < 75 },
      "2_seo": { x: -30, y: -55, active: prg > 55 && prg < 115 },
      "3_coder": { x: 0, y: -25, active: prg > 35 && prg < 95 },
      "4_designer": { x: 35, y: -40, active: prg > 75 && prg < 135 },
      "5_deployer": { x: 115, y: 35, active: prg > 185 && prg < 245 }
    };
    var t = targets[this.role] || { x: this.homeX, y: this.homeY, active: false };
    var destX = t.active ? t.x : this.homeX;
    var destY = t.active ? t.y : this.homeY;
    this.x += (destX - this.x) * 0.04;
    this.y += (destY - this.y) * 0.04;

    this.walkPhase += 0.12;
    var bob = Math.sin(this.walkPhase) * 1.5;

    ctx.save();
    ctx.translate(this.x, this.y + bob);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -8, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.fillRect(-4, -3, 8, 10);
    ctx.beginPath();
    ctx.moveTo(-5, 7);
    ctx.lineTo(-3, 14);
    ctx.moveTo(5, 7);
    ctx.lineTo(3, 14);
    ctx.stroke();
    ctx.restore();

    if (t.active && frame % 90 === Math.floor(this.stepTrig)) {
      this.bubble = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      this.bubbleTimer = 70;
    }
    if (this.bubble && this.bubbleTimer > 0) {
      createBubble(ctx, this.x, this.y - 22, this.bubble);
      this.bubbleTimer--;
    }
  };

  function createBubble(ctx, x, y, text) {
    ctx.font = "bold 7px Inter,sans-serif";
    var tw = ctx.measureText(text).width;
    var bw = tw + 14;
    var bx = x - bw / 2;
    var by = y - 16;
    drawRR(ctx, bx, by, bw, 14, 4, C.bubbleBg, C.hubAccent);
    ctx.fillStyle = C.bubbleText;
    ctx.textAlign = "center";
    ctx.fillText(text, x, by + 10);
  }

  var bubbles = [
    { trig: 45, text: "Визит #1847 закрыт" },
    { trig: 95, text: "AI собирает 6 блоков памятки" },
    { trig: 155, text: "Врач: approve за 42 сек" },
    { trig: 215, text: "Пациент получил SMS" }
  ];
  var shownBubbles = {};

  function engineloop() {
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    visitStream.draw(ctx);
    templateShelf.draw(ctx);
    memoHub.draw(ctx);
    approveGate.draw(ctx);
    deliveryBeacon.draw(ctx);

    agents.forEach(function (a) { a.draw(ctx); });

    var prg = (frame * 0.038) % 260;
    bubbles.forEach(function (b) {
      if (prg > b.trig && prg < b.trig + 18 && !shownBubbles[b.trig + "-" + Math.floor(prg / 260)]) {
        createBubble(ctx, 0, -95, b.text);
      }
    });
    if (prg < 5) shownBubbles = {};

    ctx.restore();
    frame++;
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>


<div class="pam-content">

<!-- ====================================================
     PAM PAGE STYLES — префикс pam-, scoped в .pam-content
     ==================================================== -->
<style>
.pam-content{
  --pam-bg:#050711;--pam-bg2:#080b17;--pam-bg3:#0a0e1c;
  --pam-surface:rgba(255,255,255,.072);--pam-surface2:rgba(255,255,255,.108);
  --pam-text:#e6edf7;--pam-muted:#9aa8bd;--pam-soft:#c7d2e5;--pam-heading:#fff;
  --pam-border:rgba(255,255,255,.10);--pam-border-s:rgba(255,255,255,.18);
  --pam-accent:#79f2ff;--pam-violet:#8b5cf6;--pam-green:#22c55e;--pam-amber:#f59e0b;
  --pam-shadow:0 24px 72px rgba(0,0,0,.4);
  --pam-r:18px;--pam-r-lg:24px;--pam-container:1220px;
  --ym-shadow-sm:0 8px 28px rgba(0,0,0,.25);
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--pam-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.pam-content *,.pam-content *::before,.pam-content *::after{box-sizing:border-box;}
.pam-content a{color:inherit;text-decoration:none;}
.pam-content p{color:var(--pam-muted);line-height:1.72;margin:0 0 1em;}
.pam-content p:last-child{margin-bottom:0;}
.pam-content h2,.pam-content h3,.pam-content h4{color:var(--pam-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.pam-content strong{color:var(--pam-soft);}
.pam-content ul,.pam-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.pam-content ul li,.pam-content ol li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--pam-muted);font-size:14.5px;line-height:1.65;
}
.pam-content ul li::before{content:'›';position:absolute;left:0;color:var(--pam-accent);font-weight:700;}
.pam-cnt{width:min(var(--pam-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.pam-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.pam-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);
}
.pam-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.pam-sh.pam-left{margin-left:0;text-align:left;}
.pam-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.pam-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.pam-sh.pam-left p{margin-left:0;}
.pam-eyebrow{
  display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--pam-accent);margin-bottom:14px;
}
.pam-callout{
  background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.06));
  border:1px solid rgba(121,242,255,.22);border-radius:var(--pam-r);
  padding:28px 32px;margin-top:32px;
}
.pam-disclaimer{
  border-left:4px solid var(--pam-amber);background:rgba(245,158,11,.08);
  padding:16px 20px;border-radius:12px;font-size:14px;color:var(--pam-muted);margin:24px 0;
}
.pam-disclaimer__icon{margin-right:8px;}
.pam-stat-row{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:36px;}
.pam-stat-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:24px 20px;text-align:center;
}
.pam-stat-card .pam-stat-val{font-size:clamp(28px,4vw,42px);font-weight:900;color:var(--pam-heading);line-height:1;}
.pam-stat-card .pam-stat-label{font-size:13px;color:var(--pam-muted);margin-top:8px;line-height:1.4;}
.pam-process{display:grid;gap:0;margin-top:40px;position:relative;}
.pam-process-step{
  display:grid;grid-template-columns:48px 1fr;gap:20px;padding:24px 0;
  border-bottom:1px solid rgba(255,255,255,.06);
}
.pam-process-step:last-child{border-bottom:none;}
.pam-process-dot{
  width:48px;height:48px;border-radius:50%;display:flex;align-items:center;justify-content:center;
  background:rgba(121,242,255,.12);border:2px solid rgba(121,242,255,.35);
  font-weight:800;font-size:16px;color:var(--pam-accent);
}
.pam-timeline{display:grid;gap:20px;margin-top:32px;}
.pam-tl-item{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--pam-r);padding:24px 28px;border-left:3px solid var(--pam-violet);
}
.pam-tl-item h3{font-size:18px;margin-bottom:8px;}
.pam-memo-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:36px;}
.pam-memo-card{
  background:#0a0e1c;border:1px solid rgba(255,255,255,.12);border-radius:var(--pam-r);
  overflow:hidden;
}
.pam-memo-card__head{
  padding:12px 16px;background:rgba(121,242,255,.08);border-bottom:1px solid rgba(255,255,255,.08);
  font-size:12px;font-weight:700;color:var(--pam-accent);text-transform:uppercase;letter-spacing:.06em;
}
.pam-memo-card__body{
  padding:16px;font-family:'SF Mono',Consolas,monospace;font-size:12px;line-height:1.65;
  color:var(--pam-soft);white-space:pre-line;
}
.pam-memo-card__warn{color:var(--pam-amber);margin-top:8px;}
.pam-table-wrap{overflow-x:auto;margin-top:32px;border-radius:var(--pam-r);border:1px solid rgba(255,255,255,.1);}
.pam-table{width:100%;border-collapse:collapse;font-size:14px;}
.pam-table th,.pam-table td{padding:14px 16px;text-align:left;border-bottom:1px solid rgba(255,255,255,.08);}
.pam-table th{background:rgba(255,255,255,.06);color:var(--pam-heading);font-weight:700;}
.pam-table td{color:var(--pam-muted);}
.pam-table tr:last-child td{border-bottom:none;}
.pam-grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;margin-top:32px;}
.pam-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--pam-r);padding:28px;
}
.pam-card h3{font-size:17px;margin-bottom:10px;}
.pam-logo-row{display:flex;flex-wrap:wrap;gap:12px;margin-top:24px;}
.pam-logo-pill{
  padding:8px 16px;border-radius:999px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.12);font-size:13px;color:var(--pam-muted);
}
.pam-metrics-row{display:grid;grid-template-columns:repeat(2,1fr);gap:24px;margin-top:32px;}
.pam-metric-col h4{font-size:15px;color:var(--pam-accent);margin-bottom:12px;}
.pam-price-table{margin-top:32px;}
.pam-price-row{
  display:flex;justify-content:space-between;align-items:center;gap:16px;
  padding:18px 24px;border-bottom:1px solid rgba(255,255,255,.08);
  background:rgba(255,255,255,.03);
}
.pam-price-row:first-child{border-radius:var(--pam-r) var(--pam-r) 0 0;}
.pam-price-row:last-child{border-bottom:none;border-radius:0 0 var(--pam-r) var(--pam-r);}
.pam-quote{
  border-left:4px solid var(--pam-violet);padding:24px 28px;margin-top:32px;
  background:rgba(139,92,246,.08);border-radius:0 var(--pam-r) var(--pam-r) 0;
  font-style:italic;color:var(--pam-soft);
}
.pam-faq{display:grid;gap:12px;margin-top:32px;}
.pam-faq details{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.pam-faq summary{
  padding:18px 24px;cursor:pointer;font-weight:700;color:var(--pam-heading);
  list-style:none;display:flex;justify-content:space-between;align-items:center;
}
.pam-faq summary::after{content:'+';color:var(--pam-accent);font-size:20px;}
.pam-faq details[open] summary::after{content:'−';}
.pam-faq .pam-faq-body{padding:0 24px 20px;color:var(--pam-muted);font-size:14.5px;line-height:1.7;}
.pam-lead-magnet{
  background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.08));
  border:1px solid rgba(34,197,94,.3);border-radius:var(--pam-r-lg);
  padding:40px;margin-top:32px;
}
.pam-lead-magnet ol{counter-reset:pam-li;}
.pam-lead-magnet ol li{counter-increment:pam-li;padding-left:28px;}
.pam-lead-magnet ol li::before{
  content:counter(pam-li);position:absolute;left:0;
  width:20px;height:20px;border-radius:50%;background:rgba(34,197,94,.2);
  color:var(--pam-green);font-size:11px;font-weight:800;text-align:center;line-height:20px;
}
.pam-final-cta{
  text-align:center;padding:clamp(48px,6vw,80px) 0;
  background:linear-gradient(180deg,rgba(121,242,255,.06),transparent);
}
.pam-final-cta h2{margin-bottom:16px;}
.pam-ad-banner-wrap{text-align:center;padding:32px 0 48px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--pam-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--pam-accent);text-decoration:underline;}
@media(max-width:900px){
  .pam-stat-row,.pam-memo-grid,.pam-grid-2,.pam-metrics-row{grid-template-columns:1fr;}
  .pam-memo-grid{grid-template-columns:1fr;}
}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
</style>

  <section class="pam-intro" id="intro" aria-label="Введение">
    <div class="pam-cnt">
      <div class="pam-intro-grid nero-ai-reveal">
        <div class="pam-intro-text">
          <span class="pam-eyebrow">Post-visit · лонгрид</span>
          <p><strong>AI-агент для памяток пациенту после приёма</strong> — контролируемая автоматизация: данные визита из МИС или CRM → черновик простым языком → проверка врачом → доставка в SMS, Telegram или email. Не диагностика и не «робот-врач», а донесение уже принятых рекомендаций.</p>
          <p>Внедрение под ключ — связка шаблонов клиники, human-in-the-loop, интеграций и журнала по 152-ФЗ. Ниже — процесс, примеры памяток, сравнение с ручной работой и ChatGPT, стоимость и FAQ.</p>
        </div>
        <div class="pam-intro-kpi" aria-label="Ключевые метрики post-visit">
          <div class="pam-kpi-card"><div class="kv">32%</div><div class="kl">забывают инструкцию на follow-up</div></div>
          <div class="pam-kpi-card"><div class="kv">HITL</div><div class="kl">approve врача перед отправкой</div></div>
          <div class="pam-kpi-card"><div class="kv">152-ФЗ</div><div class="kl">журнал и хостинг в РФ</div></div>
          <div class="pam-kpi-card"><div class="kv">SMS</div><div class="kl">Telegram · email · ЛК</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="pam-toc-outer">
    <div class="pam-cnt">
      <nav class="pam-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#korotko">Коротко</a>
        <a href="#bol">Проблема</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#primery">Примеры</a>
        <a href="#integracii">Интеграции</a>
        <a href="#bezopasnost">152-ФЗ</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

<!-- #disclaimer -->
<section id="disclaimer" class="pam-section pam-section-tight" aria-label="Медицинский дисклеймер">
  <div class="pam-cnt">
    <div class="pam-disclaimer" role="note">
      <span class="pam-disclaimer__icon" aria-hidden="true">⚕</span>
      Материал описывает информационную автоматизацию post-visit коммуникации и не является медицинской консультацией, диагнозом или назначением лечения. AI-агент не заменяет врачебный приём. При острых симптомах обращайтесь в клинику или вызывайте скорую помощь.
    </div>
  </div>
</section>

<!-- #korotko -->
<section id="korotko" class="pam-section" aria-labelledby="korotko-h2">
  <div class="pam-cnt">
    <div class="pam-sh pam-left">
      <span class="pam-eyebrow">Коротко</span>
      <h2 id="korotko-h2">Что такое AI-памятка пациенту</h2>
    </div>
    <div class="pam-callout">
      <p><strong>AI-агент для памяток пациенту после приёма</strong> — это контролируемая автоматизация post-visit коммуникации в частной медицине. После визита система на основе данных приёма (протокол в МИС или CRM, назначения, тип процедуры, шаблоны клиники) формирует черновик пациентской памятки простым языком: что делать дома, чего избегать, когда звонить в клинику, когда прийти на контроль.</p>
      <p>Это не «робот-врач» и не диагностика. AI работает в зоне информационной подачи уже утверждённых врачом рекомендаций — переводит клинический язык в понятный текст, структурирует по блокам, подставляет персональные детали. Финальная отправка — только после проверки человеком.</p>
      <p><strong>Определение для владельца клиники:</strong> внедрение ai памятка пациенту под ключ — это связка «шаблоны клиники + данные визита + AI-черновик + human-in-the-loop + канал доставки», а не разовый промпт в ChatGPT.</p>
    </div>
  </div>
</section>

<!-- #bol -->
<section id="bol" class="pam-section pam-section-alt" aria-labelledby="bol-h2">
  <div class="pam-cnt">
    <div class="pam-sh pam-left">
      <span class="pam-eyebrow">Проблема</span>
      <h2 id="bol-h2">Почему пациенты забывают рекомендации после приёма</h2>
      <p>Пациенты забывают рекомендации — и это не лень, а нормальная когнитивная нагрузка. Исследование в BMC Primary Care (2011) показало: у 32% пациентов забыта хотя бы одна инструкция на follow-up; при трёх–четырёх инструкциях риск забывания резко растёт.</p>
    </div>
    <div class="pam-stat-row" aria-label="Статистика забывания рекомендаций">
      <div class="pam-stat-card">
        <div class="pam-stat-val">32%</div>
        <div class="pam-stat-label">забыли хотя бы одну инструкцию на follow-up</div>
      </div>
      <div class="pam-stat-card">
        <div class="pam-stat-val">49%</div>
        <div class="pam-stat-label">точно вспоминают рекомендации через неделю</div>
      </div>
      <div class="pam-stat-card">
        <div class="pam-stat-val">15%</div>
        <div class="pam-stat-label">неверно вспоминают или не вспоминают вовсе</div>
      </div>
    </div>
    <div style="margin-top:40px;">
      <h3>Что теряет клиника, когда регистратура отвечает на одно и то же</h3>
      <p>Повторные вопросы пациентов после приёма — скрытая статья расходов. Администратор тратит 3–7 минут на типовой ответ, отвлекаясь от записи и оплаты. Врач получает сообщения в мессенджере вне рабочего времени. Разные формулировки у разных сотрудников создают путаницу: один говорит «можно», другой — «лучше не надо».</p>
      <p>Для сети с несколькими филиалами проблема масштабируется. Стандарт post-visit коммуникации размывается: в одном кабинете выдают подробную памятку, в другом — устное «всё объяснил». NPS падает не из-за качества лечения, а из-за того, что пациент «ничего не понял после ухода».</p>
      <p>Сценарий <strong>ai после приема</strong> закрывает именно этот разрыв: не лечение, а донесение уже принятых рекомендаций до пациента в структурированном виде.</p>
      <h3>Почему бумажная памятка не работает в 2026</h3>
      <p>Большинство клиник уже имеют PDF или Word-шаблоны. Но статичный лист не учитывает конкретный визит: какой препарат назначен, какая доза, когда контроль. Администратор вручную копирует блоки, иногда ошибается. Пациент теряет бумажку или не читает её — особенно если текст написан медицинским языком.</p>
      <p>Электронная доставка решает только половину задачи. Без персонализации и без контроля формулировок клиника по-прежнему рискует отправить неактуальный или неполный текст. Здесь и нужен <strong>ai клиника памятки</strong> — не замена шаблона, а умная сборка под конкретный приём с обязательной проверкой.</p>
    </div>
  </div>
</section>

<!-- ====================================================
     БОРИС: визуальный блок (после #bol, перед #kak-rabotaet)
     ==================================================== -->
<section id="boris-pamyatka-viz" class="bpm-root" aria-label="Доставка памятки пациенту: от approve до телефона">
<style>
/* === БОРИС: prefix bpm-, scoped внутри #boris-pamyatka-viz === */
.bpm-root{padding:60px 0 72px;background:#eef4fb;}
.bpm-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.bpm-card{
  display:grid;grid-template-columns:42% 58%;border-radius:24px;overflow:hidden;
  box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(121,242,255,.2);min-height:520px;
}
@media(max-width:960px){.bpm-card{grid-template-columns:1fr;min-height:auto;}}
.bpm-lft{background:#fff;padding:48px 40px;display:flex;flex-direction:column;justify-content:center;}
@media(max-width:600px){.bpm-lft{padding:32px 24px;}}
.bpm-ey{display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:#0891b2;margin:0 0 15px;}
.bpm-ey::before{content:'';display:inline-block;width:20px;height:2px;background:#0891b2;border-radius:1px;}
.bpm-h3{font-size:25px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 22px;}
@media(max-width:600px){.bpm-h3{font-size:20px;}}
.bpm-ul{list-style:none;margin:0 0 26px;padding:0;display:flex;flex-direction:column;gap:10px;}
.bpm-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155;}
.bpm-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0891b2;margin-top:1px;font-style:normal;}
.bpm-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:22px;}
.bpm-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
.bpm-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
.bpm-pl-c{background:rgba(121,242,255,.1);color:#0e7490;border:1.5px solid rgba(121,242,255,.3);}
.bpm-pl-a{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22);}
.bpm-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0;padding-top:2px;}
.bpm-rgt{background:linear-gradient(145deg,#050711 0%,#080b17 55%,#0a0e1c 100%);position:relative;overflow:hidden;min-height:400px;}
@media(max-width:960px){.bpm-rgt{min-height:380px;}}
#bpm-memo-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="bpm-cnt">
<div class="bpm-card">
  <div class="bpm-lft">
    <span class="bpm-ey">Post-visit · доставка</span>
    <h3 class="bpm-h3">Пациент получает памятку на телефон — регистратура перестаёт отвечать на одно и то же</h3>
    <ul class="bpm-ul">
      <li><span class="bpm-ic">✓</span>После approve врача текст уходит в SMS, Telegram или email</li>
      <li><span class="bpm-ic">📋</span>Структура: сегодня → 24 часа → неделя → когда звонить срочно</li>
      <li><span class="bpm-ic">🔒</span>Журнал отправок для аудита по 152-ФЗ</li>
      <li><span class="bpm-ic">↩</span>Напоминание через 24–48 ч с эскалацией на администратора</li>
    </ul>
    <div class="bpm-pills">
      <span class="bpm-pl bpm-pl-g">Отправлено: 14/18</span>
      <span class="bpm-pl bpm-pl-c">Human-in-the-loop</span>
      <span class="bpm-pl bpm-pl-a">−3–7 мин на звонок</span>
    </div>
    <p class="bpm-foot">Дальше — как устроен AI-агент с human-in-the-loop →</p>
  </div>
  <div class="bpm-rgt">
    <canvas id="bpm-memo-canvas" aria-label="Анимация: смартфон пациента получает персонализированную памятку после approve врача" role="img"></canvas>
  </div>
</div>
</div>
<script>
(function(){
  var cv=document.getElementById('bpm-memo-canvas');
  if(!cv)return;
  var cx=cv.getContext('2d'),W=0,H=0,fr=0,pulse=0;
  function resize(){
    var p=cv.parentElement;if(!p)return;
    cv.width=p.clientWidth||640;cv.height=p.clientHeight||520;
    W=cv.width;H=cv.height;
  }
  window.addEventListener('resize',resize);resize();
  var C={cyan:'#79f2ff',green:'#22c55e',viol:'#8b5cf6',amber:'#f59e0b',text:'#e6edf7',muted:'rgba(230,237,247,.45)',card:'rgba(255,255,255,.07)',line:'rgba(255,255,255,.08)'};
  var phone={x:0,y:0,w:0,h:0};
  var notifs=[
    {t:'Черновик AI готов',s:'ожидает approve',c:C.amber,d:30,a:0,y:0,done:false},
    {t:'Врач утвердил',s:'памятка одобрена',c:C.green,d:120,a:0,y:0,done:false},
    {t:'Памятка отправлена',s:'SMS + Telegram',c:C.cyan,d:220,a:0,y:0,done:false},
    {t:'Пациент открыл',s:'прочитано 2 мин назад',c:C.viol,d:340,a:0,y:0,done:false}
  ];
  var memoLines=['Сегодня: мягкая пища','Ибупрофен 400 мг при боли','Контроль: 12.09.2026','⚠ Тревожно: t > 38°C'];
  var memoProg=0,LOOP=480;
  function rr(x,y,w,h,r,fill,stroke,lw){
    cx.beginPath();
    if(cx.roundRect)cx.roundRect(x,y,w,h,r);
    else{cx.moveTo(x+r,y);cx.arcTo(x+w,y,x+w,y+h,r);cx.arcTo(x+w,y+h,x,y+h,r);cx.arcTo(x,y+h,x,y,r);cx.arcTo(x,y,x+w,y,r);cx.closePath();}
    if(fill){cx.fillStyle=fill;cx.fill();}
    if(stroke){cx.strokeStyle=stroke;cx.lineWidth=lw||1.5;cx.stroke();}
  }
  function layoutPhone(){
    var pw=Math.min(W*0.42,220),ph=pw*1.85;
    phone.w=pw;phone.h=ph;phone.x=(W-pw)/2;phone.y=(H-ph)/2+10;
  }
  function drawPhone(){
    layoutPhone();
    var px=phone.x,py=phone.y,pw=phone.w,ph=phone.h;
    rr(px-8,py-8,pw+16,ph+16,28,'rgba(121,242,255,.06)',C.line,1);
    rr(px,py,pw,ph,22,'#0d1224',C.line,2);
    rr(px+pw*0.3,py+8,pw*0.4,5,3,'rgba(255,255,255,.15)',null,0);
    rr(px+10,py+24,pw-20,ph-48,14,C.card,C.line,1);
    cx.fillStyle=C.cyan;cx.font='bold 11px Inter,sans-serif';cx.textAlign='center';
    cx.fillText('Памятка после приёма',px+pw/2,py+44);
    var my=py+56;
    memoLines.forEach(function(ln,i){
      if(i>memoProg)return;
      rr(px+16,my,pw-32,22,6,'rgba(121,242,255,.08)',null,0);
      cx.fillStyle=C.text;cx.font='10px Inter,sans-serif';cx.textAlign='left';
      cx.fillText(ln,px+24,my+14);my+=28;
    });
    if(memoProg>=3){
      rr(px+16,py+ph-52,pw-32,28,8,'rgba(34,197,94,.15)',C.green,1);
      cx.fillStyle=C.green;cx.font='bold 10px Inter,sans-serif';cx.textAlign='center';
      cx.fillText('✓ Отправлено пациенту',px+pw/2,py+ph-34);
    }
  }
  function drawNotifs(loopFr){
    var startX=phone.x+phone.w+20;
    if(startX+180>W)startX=W-200;
    notifs.forEach(function(n,i){
      if(loopFr<n.d)return;
      if(!n.done){n.a=Math.min(1,n.a+0.06);if(n.a>=1)n.done=true;}
      var ny=phone.y+20+i*58;
      cx.globalAlpha=n.a;
      rr(startX,ny,185,48,10,C.card,n.c+'55',1);
      cx.fillStyle=n.c;cx.font='bold 11px Inter,sans-serif';cx.textAlign='left';
      cx.fillText(n.t,startX+12,ny+18);
      cx.fillStyle=C.muted;cx.font='10px Inter,sans-serif';
      cx.fillText(n.s,startX+12,ny+34);
      cx.globalAlpha=1;
    });
  }
  function drawFlow(loopFr){
    if(loopFr<100)return;
    cx.strokeStyle=C.cyan;cx.lineWidth=2;cx.setLineDash([6,4]);
    cx.beginPath();
    cx.moveTo(40,H/2);cx.lineTo(phone.x-12,H/2);cx.stroke();
    cx.setLineDash([]);
    cx.fillStyle=C.muted;cx.font='10px Inter,sans-serif';cx.textAlign='left';
    cx.fillText('Post-visit центр',24,H/2-12);
    cx.fillText('→ approve →',24,H/2+16);
    var pulseX=40+(phone.x-52)*((loopFr-100)/200);
    if(loopFr<300){
      cx.beginPath();cx.arc(Math.min(pulseX,phone.x-12),H/2,5,0,Math.PI*2);
      cx.fillStyle=C.cyan;cx.fill();
    }
  }
  function loop(){
    fr++;pulse++;var loopFr=fr%LOOP;
    if(loopFr===0){
      notifs.forEach(function(n){n.a=0;n.done=false;});
      memoProg=0;
    }
    if(loopFr===240)memoProg=1;
    if(loopFr===280)memoProg=2;
    if(loopFr===320)memoProg=3;
    if(loopFr===360)memoProg=4;
    cx.clearRect(0,0,W,H);
    drawFlow(loopFr);
    drawPhone();
    drawNotifs(loopFr);
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

<!-- #kak-rabotaet -->
<section id="kak-rabotaet" class="pam-section" aria-labelledby="kak-rabotaet-h2">
  <div class="pam-cnt">
    <div class="pam-sh">
      <span class="pam-eyebrow">Процесс</span>
      <h2 id="kak-rabotaet-h2">AI-агент для памяток: как это работает (human-in-the-loop)</h2>
      <p>В 2026 году рынок смещается к agentic AI — системам, которые не просто отвечают на вопрос, а выполняют цепочку действий. McKinsey фиксирует: риск смещается от «сказал не то» к «сделал не то». Для медицины это означает: агент может отправить пациенту текст без approve — и ответственность ляжет на клинику.</p>
    </div>
    <p style="text-align:center;max-width:720px;margin:0 auto 32px;">Поэтому <strong>ai памятка пациенту</strong> строится как ограниченный агент с human-in-the-loop: действие = отправка текста, но только после утверждения врачом или уполномоченным сотрудником.</p>
    <div class="pam-process">
      <div class="pam-process-step">
        <div class="pam-process-dot">1</div>
        <div>
          <h3>Данные визита и шаблоны клиники</h3>
          <p>Врач завершает приём. В МИС или CRM фиксируются: услуга, диагноз или процедура, назначения, рекомендации, дата контроля. Триггер передаёт структурированные данные в AI-агент. Параллельно в системе хранится библиотека шаблонов клиники — утверждает главврач, не нейросеть.</p>
        </div>
      </div>
      <div class="pam-process-step">
        <div class="pam-process-dot">2</div>
        <div>
          <h3>Черновик памятки от AI</h3>
          <p>Агент переписывает клинический жаргон в plain language (6–8 класс читаемости). Структурирует по таймлайну: «сегодня», «первые 24 часа», «неделя», «когда звонить срочно». Прогоняет чеклист безопасности и формирует полную и SMS-версию.</p>
        </div>
      </div>
      <div class="pam-process-step">
        <div class="pam-process-dot">3</div>
        <div>
          <h3>Проверка врачом или администратором</h3>
          <p>Черновик попадает в очередь модерации. Врач видит preview, diff с шаблоном, подсветку расхождений. Approve, reject или правка — за 30–60 секунд. На пилоте — 100% review; в пилоте дерматологии США 19% summaries потребовали правки врача.</p>
        </div>
      </div>
      <div class="pam-process-step">
        <div class="pam-process-dot">4</div>
        <div>
          <h3>Отправка пациенту (мессенджер, email, ЛК)</h3>
          <p>После approve текст уходит выбранным каналом: SMS, email, WhatsApp Business, Telegram-бот, личный кабинет. Копия сохраняется в карте визита. Журнал фиксирует: кто утвердил, что отправлено, когда — для аудита по 152-ФЗ.</p>
        </div>
      </div>
    </div>
    <p style="text-align:center;margin-top:32px;"><strong>Итог:</strong> приём → данные → черновик → approve → отправка. Пять шагов, каждый с понятной зоной ответственности.</p>
  </div>
</section>

<!-- #vnedrenie -->
<section id="vnedrenie" class="pam-section pam-section-alt" aria-labelledby="vnedrenie-h2">
  <div class="pam-cnt">
    <div class="pam-sh">
      <span class="pam-eyebrow">Под ключ</span>
      <h2 id="vnedrenie-h2">Что входит во внедрение AI-памяток под ключ</h2>
      <p><strong>Внедрение ai памятка пациенту</strong> — проект с этапами, интеграциями и обучением. Ориентир чека: 150–450 тыс. ₽.</p>
    </div>
    <div class="pam-timeline">
      <div class="pam-tl-item">
        <h3>Аудит шаблонов и протоколов клиники</h3>
        <p>3–5 рабочих дней. Разбор 5–10 типовых приёмов, текущих PDF/Word-памяток, полей МИС/CRM, каналов отправки.</p>
      </div>
      <div class="pam-tl-item">
        <h3>Настройка AI-агента и правил формулировок</h3>
        <p>7–10 дней. Pipeline на YandexGPT, GigaChat или локальной модели с guardrails: только утверждённые блоки, запрет новых назначений.</p>
      </div>
      <div class="pam-tl-item">
        <h3>Обучение администраторов и врачей</h3>
        <p>2–3 сессии. Очередь approve, reject, обновление шаблонов без программиста. Врач тратит на проверку меньше минуты.</p>
      </div>
      <div class="pam-tl-item">
        <h3>Запуск и сопровождение</h3>
        <p>Пилот на 1 филиале / 2–3 врачах, 2 недели. Замер повторных обращений, масштабирование на сеть, техподдержка.</p>
      </div>
    </div>
    <p style="margin-top:28px;"><strong>Разработка ai памятка пациенту</strong> включает Template Engine, Visit Data Adapter, LLM Composer, Safety Layer, Review Console, Delivery Hub и Audit &amp; Versioning.</p>
  </div>
</section>

<!-- CTA #1 после #vnedrenie -->
<div class="pam-cnt">
  <aside class="ym-cta-block ym-cta-block--primary" id="cta-vnedrenie">
    <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Собрать памятки — аудит шаблонов бесплатно</p>
      <p class="ym-cta-block__sub">Разберём 5–10 типовых приёмов вашей клиники, текущие PDF/Word-памятки и поля МИС/CRM. На выходе — карта post-visit процесса и ориентир архитектуры под чек 150–450 тыс. ₽. Без обязательств.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </aside>
</div>

<!-- #primery -->
<section id="primery" class="pam-section" aria-labelledby="primery-h2">
  <div class="pam-cnt">
    <div class="pam-sh">
      <span class="pam-eyebrow">Демо</span>
      <h2 id="primery-h2">Примеры памяток для разных клиник</h2>
      <p>Демонстрационные фрагменты — типовые структуры, не реальные кейсы конкретных медучреждений.</p>
    </div>
    <div class="pam-memo-grid">
      <div class="pam-memo-card">
        <div class="pam-memo-card__head">Стоматология · удаление зуба</div>
        <div class="pam-memo-card__body">Сегодня и первые 24 часа:
— Не полоскать рот активно
— Питание: мягкое, тёплое
— Ибупрофен 400 мг при боли

Контроль: 12.09.2026, 10:00<span class="pam-memo-card__warn">⚠ Тревожно: t &gt; 38°C, нарастающий отёк</span></div>
      </div>
      <div class="pam-memo-card">
        <div class="pam-memo-card__head">Косметология · химпилинг</div>
        <div class="pam-memo-card__body">Первые 48 часов:
— SPF 50+ каждые 2–3 часа
— Без декоративной косметики 24 ч
— Крем [из протокола]: 2 р/день

Нормально: покраснение, шелушение<span class="pam-memo-card__warn">⚠ Срочно: гной, сильный отёк</span></div>
      </div>
      <div class="pam-memo-card">
        <div class="pam-memo-card__head">Терапия · ОРВИ</div>
        <div class="pam-memo-card__body">Что делать дома:
— Питьё 2–2,5 л/сутки
— Парацетамол 500 мг до 4 р/сут
— Промывание носа 3–4 р/день

Когда звонить: одышка, t &gt; 39°C 3 дня</div>
      </div>
    </div>
  </div>
</section>

<!-- #sravnenie -->
<section id="sravnenie" class="pam-section pam-section-alt" aria-labelledby="sravnenie-h2">
  <div class="pam-cnt">
    <div class="pam-sh">
      <span class="pam-eyebrow">Сравнение</span>
      <h2 id="sravnenie-h2">Ручная памятка, ChatGPT вручную, AI-агент под ключ</h2>
    </div>
    <div class="pam-table-wrap">
      <table class="pam-table">
        <thead>
          <tr><th>Критерий</th><th>Ручная памятка</th><th>ChatGPT вручную</th><th>AI-агент Nero Network</th></tr>
        </thead>
        <tbody>
          <tr><td>Персонализация под визит</td><td>Ручной ввод, риск ошибок</td><td>Врач копирует тезисы в промпт</td><td>Автоподстановка из МИС/CRM</td></tr>
          <tr><td>Шаблоны клиники</td><td>PDF/Word, статичные</td><td>Нет единой библиотеки</td><td>Утверждённые мастер-шаблоны</td></tr>
          <tr><td>Human-in-the-loop</td><td>Да, но долго</td><td>Да, без журнала версий</td><td>Очередь approve + audit trail</td></tr>
          <tr><td>Интеграция МИС/CRM</td><td>Нет</td><td>Нет</td><td>Webhook/API, триггеры</td></tr>
          <tr><td>152-ФЗ, хранение в РФ</td><td>Зависит от канала</td><td>Риск утечки в публичный сервис</td><td>Российский LLM, договор обработчика</td></tr>
          <tr><td>Масштаб на сеть</td><td>Разный стандарт</td><td>Хаотично</td><td>Единый процесс во всех филиалах</td></tr>
          <tr><td>ROI регистратуры</td><td>Низкий</td><td>Точечная экономия</td><td>Системное снижение повторных звонков</td></tr>
        </tbody>
      </table>
    </div>
    <p style="margin-top:24px;">Зазор Nero Network — агент с шаблонами, контролем и доставкой, а не промпт-гайд.</p>
  </div>
</section>

<!-- #integracii -->
<!-- INTERNAL-LINKS:INSERT -->
<section id="integracii" class="pam-section" aria-labelledby="integracii-h2">
  <div class="pam-cnt">
    <div class="pam-sh">
      <span class="pam-eyebrow">Интеграции</span>
      <h2 id="integracii-h2">МИС, CRM и мессенджеры</h2>
      <p><strong>Интеграция ai памятка пациенту</strong> — ключевой фактор, отличающий продукт от ручного копирования.</p>
    </div>
    <div class="pam-grid-2">
      <div class="pam-card">
        <h3>МИС и карта визита</h3>
        <p>IDENT, Инфоклиника/Инфодент, 1С:Медицина, DentalPRO, Medesk, YCLIENTS, iDent — по согласованию с вендором. Visit Data Adapter забирает услугу, диагноз, назначения, дату контроля.</p>
      </div>
      <div class="pam-card">
        <h3>amoCRM / Bitrix24</h3>
        <p>Журнал коммуникаций, теги «памятка отправлена / ожидает approve». Триггер: статус «Приём завершён» → запуск агента. Отчёт для руководителя по повторным обращениям.</p>
      </div>
      <div class="pam-card">
        <h3>SMS, email, мессенджеры</h3>
        <p>Delivery Hub: SMS.ru, SMSC, корпоративная почта, WhatsApp Business API, Telegram-бот клиники. Пациент получает туда, куда клиника уже отправляет напоминания.</p>
      </div>
      <div class="pam-card">
        <h3>Оркестрация без тяжёлой разработки</h3>
        <p>Триггеры через n8n или Make на старте. На эксплуатации шаблоны и правила — через интерфейс, не через код.</p>
      </div>
    </div>
    <div class="pam-logo-row" aria-label="Возможные системы интеграции">
      <span class="pam-logo-pill">IDENT</span>
      <span class="pam-logo-pill">Инфоклиника</span>
      <span class="pam-logo-pill">1С:Медицина</span>
      <span class="pam-logo-pill">amoCRM</span>
      <span class="pam-logo-pill">Bitrix24</span>
      <span class="pam-logo-pill">Telegram</span>
      <span class="pam-logo-pill">n8n</span>
    </div>
  </div>
</section>

<!-- #bezopasnost -->
<section id="bezopasnost" class="pam-section pam-section-alt" aria-labelledby="bezopasnost-h2">
  <div class="pam-cnt">
    <div class="pam-sh pam-left">
      <span class="pam-eyebrow">🛡 Безопасность</span>
      <h2 id="bezopasnost-h2">152-ФЗ и медицинский дисклеймер</h2>
      <p>Данные о здоровье — специальная категория ПДн. Хранение граждан РФ — на серверах в РФ (ст. 18 152-ФЗ). Штрафы за утечки с 2025–2026: первая — 3–15 млн ₽; повторная — до 1–3% выручки.</p>
    </div>
    <div class="pam-grid-2">
      <div class="pam-card">
        <h3>Персональные данные пациента</h3>
        <ul>
          <li>Клиника — оператор, Nero Network — обработчик по договору</li>
          <li>Запрет передачи в публичные зарубежные LLM</li>
          <li>Шифрование каналов, ограничение срока хранения черновиков</li>
          <li>Аудит: кто открыл, кто утвердил, что ушло пациенту</li>
        </ul>
      </div>
      <div class="pam-card">
        <h3>Почему AI не заменяет врача</h3>
        <p>AI-памятка — информационный слой: не ставит диагноз, не назначает лечение, только структурирует уже принятые рекомендации. Диагностический ИИ требует регистрации как медизделие (приказ №686н).</p>
        <p>Guardrails сверяют черновик с протоколом. При расхождении — стоп и ручная проверка.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA #2 после #bezopasnost (условный) -->
<?php
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '';
if ($secondary_cta_url) : ?>
<div class="pam-cnt">
  <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Хотите понять human-in-the-loop до старта проекта?</p>
      <p class="ym-cta-block__sub">Если команда хочет разобраться в guardrails, шаблонах и очереди approve до заказа внедрения — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer">обучение по внедрению AI в бизнес-процессы</a>. Это ускоряет согласование с главврачом и IT на этапе пилота.</p>
    </div>
  </aside>
</div>
<?php endif; ?>

<!-- #roi -->
<!-- INTERNAL-LINKS:INSERT -->
<section id="roi" class="pam-section" aria-labelledby="roi-h2">
  <div class="pam-cnt">
    <div class="pam-sh">
      <span class="pam-eyebrow">ROI</span>
      <h2 id="roi-h2">Меньше повторных обращений на регистратуру</h2>
      <p>Главная бизнес-метрика — разгрузка регистратуры и единый стандарт сервиса после приёма.</p>
    </div>
    <div class="pam-metrics-row">
      <div class="pam-metric-col">
        <h4>До внедрения (базовая линия)</h4>
        <ul>
          <li>Звонки и чаты «после приёма» по тегам</li>
          <li>Минуты администратора на ручную сборку памяток</li>
          <li>Доля визитов с памяткой в течение 2 часов</li>
          <li>Жалобы «не объяснили / непонятно»</li>
        </ul>
      </div>
      <div class="pam-metric-col">
        <h4>После запуска</h4>
        <ul>
          <li>Те же метрики за тот же период — без выдуманных %</li>
          <li>AI-агент сокращает сборку до 1–2 мин на approve</li>
          <li>При 15–30 приёмах/день — экономия часов в неделю</li>
          <li>Единый стандарт post-visit во всех филиалах</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- #ceny -->
<section id="ceny" class="pam-section pam-section-alt" aria-labelledby="ceny-h2">
  <div class="pam-cnt">
    <div class="pam-sh">
      <span class="pam-eyebrow">Стоимость</span>
      <h2 id="ceny-h2">Сколько стоит внедрение AI-памяток</h2>
      <p><strong>Ai памятка пациенту цена</strong> зависит от масштаба, числа интеграций и глубины библиотеки шаблонов.</p>
    </div>
    <div class="pam-price-table">
      <div class="pam-price-row">
        <span>Базовый пилот (1 филиал, 5–10 шаблонов, 1–2 интеграции)</span>
        <strong>от 150 000 ₽</strong>
      </div>
      <div class="pam-price-row">
        <span>Сеть, несколько МИС, on-prem LLM, расширенная аналитика</span>
        <strong>до 450 000 ₽+</strong>
      </div>
      <div class="pam-price-row">
        <span>В смету входят</span>
        <span>аудит, шаблоны, AI-агент, Review Console, интеграции, пилот, обучение</span>
      </div>
    </div>
    <!-- CTA #3 dual внутри #ceny -->
    <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет под вашу клинику</p>
        <p class="ym-cta-block__sub">Ориентир 150–450 тыс. ₽ за внедрение под ключ: от пилота на одном филиале до сети с несколькими МИС. На аудите «Собрать памятки» дадим смету, сроки интеграции и план пилота — бесплатно.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn">Ответы на вопросы</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- #2026 -->
<section id="2026" class="pam-section" aria-labelledby="2026-h2">
  <div class="pam-cnt">
    <div class="pam-sh pam-left">
      <span class="pam-eyebrow">Тренды 2026</span>
      <h2 id="2026-h2">Почему клиники внедряют AI-агентов в 2026</h2>
      <p>Ответ для сервисной медицины: не диагностика, а документы и коммуникация после визита — там быстрый ROI и контролируемый риск.</p>
    </div>
    <div class="pam-quote">
      McKinsey (декабрь 2025 – январь 2026): средняя зрелость Responsible AI — 2,3 из 4. В agentic era организации должны думать не только о том, сказала ли модель не то, но и сделала ли система не то.
    </div>
    <h3>«Второй этаж» после ИИ-протокола</h3>
    <p>В России уже внедряют ИИ для заполнения протокола: LazyDoc, Яндекс, «Звёздочка». Nero Network строит надстройку: <strong>протокол → памятка пациенту → мессенджер/email/ЛК</strong>. Международные референсы: Abridge PVS, Scribeable AVS с 41 отраслевым шаблоном.</p>
  </div>
</section>

<!-- #faq -->
<section id="faq" class="pam-section pam-section-alt" aria-labelledby="faq-h2">
  <div class="pam-cnt">
    <div class="pam-sh">
      <span class="pam-eyebrow">FAQ</span>
      <h2 id="faq-h2">Частые вопросы</h2>
    </div>
    <div class="pam-faq">
      <details>
        <summary>Как внедрить ai памятка пациенту?</summary>
        <div class="pam-faq-body">Аудит шаблонов и МИС (3–5 дней) → библиотека мастер-шаблонов (5–7 дней) → настройка AI-агента и guardrails (7–10 дней) → Review Console и интеграции (5–10 дней) → пилот на 1 филиале (2 недели) → масштабирование. Nero Network ведёт проект под ключ.</div>
      </details>
      <details>
        <summary>Сколько стоит ai памятка пациенту?</summary>
        <div class="pam-faq-body">Ориентир: 150–450 тыс. ₽ в зависимости от числа филиалов, интеграций и объёма шаблонов. Точная смета — после аудита.</div>
      </details>
      <details>
        <summary>Ai памятка пациенту примеры внедрения — что есть на рынке?</summary>
        <div class="pam-faq-body">Прямых публичных кейсов в России мало. Есть смежные: LazyDoc и Яндекс — протокол приёма. Международно: Abridge PVS, Scribeable AVS. Модель Nero Network — агент + шаблоны + approve + delivery.</div>
      </details>
      <details>
        <summary>Ai памятка пациенту кейсы — можно ли назвать цифры ROI?</summary>
        <div class="pam-faq-body">Публичных кейсов с верифицируемым снижением повторных звонков для РФ мы не выдумываем. На пилоте клиника сама замеряет звонки и минуты администратора до/после.</div>
      </details>
      <details>
        <summary>Ai памятка пациенту для малого бизнеса — реально ли?</summary>
        <div class="pam-faq-body">Да. Старт с 5–7 шаблонов по топ-процедурам, одна интеграция (CRM или МИС), один канал доставки. Пилот на 2–3 врачах.</div>
      </details>
      <details>
        <summary>Ai памятка пациенту в CRM — зачем, если есть МИС?</summary>
        <div class="pam-faq-body">МИС хранит протокол. CRM — коммуникации, теги, аналитика повторных обращений. Связка даёт триггер «приём закрыт» и отчёт для руководителя.</div>
      </details>
      <details>
        <summary>Ai памятка пациенту без программиста — правда?</summary>
        <div class="pam-faq-body">На эксплуатации — да: approve, правка шаблонов, отчёты. На внедрении интеграторы Nero Network настраивают pipeline, API, guardrails.</div>
      </details>
    </div>
  </div>
</section>

<!-- #shablon -->
<section id="shablon" class="pam-section" aria-labelledby="shablon-h2">
  <div class="pam-cnt">
    <div class="pam-lead-magnet">
      <span class="pam-eyebrow">Лид-магнит</span>
      <h2 id="shablon-h2">Шаблон памятки пациента</h2>
      <p>Скачайте <strong>шаблон памятки пациента</strong> с блоками, которые мы используем при аудите клиник:</p>
      <ol>
        <li>Ограничения по питанию/питью по таймлайну (2 ч, 24 ч, 48 ч)</li>
        <li>Гигиена и уход</li>
        <li>Препараты (если назначены) — режим приёма</li>
        <li>Нормальные ощущения vs тревожные симптомы</li>
        <li>Контакты клиники / когда звонить срочно</li>
        <li>Дата контрольного визита</li>
        <li>Юридический дисклеймер</li>
      </ol>
      <p style="margin-top:20px;">Оставьте заявку — пришлём шаблон и поможем адаптировать под ваши протоколы.</p>
    </div>
  </div>
</section>

<!-- #kontakt -->
<section id="kontakt" class="pam-section pam-final-cta" aria-labelledby="kontakt-h2">
  <div class="pam-cnt">
    <h2 id="kontakt-h2">Собрать памятки: следующий шаг</h2>
    <p style="max-width:640px;margin:0 auto 28px;"><strong>Ai памятка пациенту заказать</strong> у Nero Network — проект с понятными этапами, а не эксперимент «вставьте промпт в ChatGPT».</p>
    <ul style="max-width:520px;margin:0 auto 32px;text-align:left;">
      <li>AI-агент на шаблонах вашей клиники с human-in-the-loop</li>
      <li>Интеграция с МИС/CRM и каналами доставки</li>
      <li>Безопасность по 152-ФЗ, российский хостинг</li>
      <li>Пилот с замером нагрузки на регистратуру</li>
      <li>Обучение персонала и сопровождение на запуске</li>
    </ul>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    <p style="margin-top:32px;font-size:13px;color:var(--pam-muted);">Информация носит ознакомительный характер и не является медицинской услугой. AI-агент не ставит диагноз и не назначает лечение.</p>
  </div>
</section>

<!-- #ad-banner (условный) -->
<?php
$ad_banner_url = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt = getenv('AD_BANNER_ALT') ?: 'Партнёрский баннер';
if ($ad_banner_url && $ad_banner_image) : ?>
<div class="pam-cnt pam-ad-banner-wrap" id="ad-banner">
  <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
    <img src="<?php echo esc_url($ad_banner_image); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_banner_alt); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;box-shadow:var(--ym-shadow-sm);">
  </a>
</div>
<?php endif; ?>

<!-- закрытие .pam-content — Наташа ставит после #ad-banner -->
</div>

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
