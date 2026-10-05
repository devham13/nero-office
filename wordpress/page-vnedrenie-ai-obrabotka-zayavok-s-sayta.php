<?php
/**
 * Template Name: AI-агент для первичной обработки заявок с сайта: внедрение под ключ
 * Description: SEO-лендинг — AI обработка заявок с сайта, квалификация и CRM. Кейсы, этапы, цены. Аудит потерь заявок.
 */

$page_seo_title       = 'AI обработка заявок с сайта под ключ — внедрение для бизнеса';
$page_seo_description = 'Внедрим AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, уточняющие вопросы и передача горячего лида в CRM. Аудит потерь заявок за 30 минут.';
$page_seo_keywords    = 'ai обработка заявок, ai обработка заявок под ключ, внедрение ai в бизнес, ai агент для сайта, ai бот для сайта, ai менеджер заявок, ai обработка заявок с crm';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description, $page_seo_keywords ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta name="keywords" content="' . esc_attr( $page_seo_keywords ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
	echo '<meta property="og:type" content="article" />' . "\n";
}, 1 );

$brand = get_bloginfo( 'name' ) ?: ( getenv( 'SITE_BRAND' ) ?: '' ); // pragma: allowlist secret

$nero_ai_header_links = [
	[ 'label' => 'Почему теряют', 'href' => '#pochemu-ostyvayut' ],
	[ 'label' => 'Как работает', 'href' => '#kak-rabotaet' ],
	[ 'label' => 'Этапы', 'href' => '#etapy' ],
	[ 'label' => 'Стоимость', 'href' => '#ceny' ],
	[ 'label' => 'Кейсы', 'href' => '#keisy' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$page_cta_label      = 'Проверить, сколько заявок вы теряете';
$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: $page_cta_label;
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = 'Как это работает';
$secondary_cta_url   = '#kak-rabotaet';

$offer_cta_url   = (string) ( getenv( 'SECONDARY_CTA_URL' ) ?: '' );
$offer_cta_label = (string) ( getenv( 'SECONDARY_CTA_LABEL' ) ?: 'обучение по внедрению AI в бизнес-процессы' );
if ( $offer_cta_url !== '' && nero_ai_is_placeholder_cta_url( $offer_cta_url ) ) {
	$offer_cta_url = '';
}

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if ( ! is_readable( $nero_ai_floating ) ) {
	require dirname( __DIR__ ) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
	require $nero_ai_floating;
}

// Шапка темы показывает короткую подпись из env; hero и тело — оффер страницы.
$primary_cta_label = $page_cta_label;

?>

<?php nero_ai_echo_theme_styles( [ 'nero-ai-longread-ui-compat.css' ] ); ?>

<style>
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

/* === АЛИНА: hero vzas (scope .vzas-hero-lead) === */
/* Hero vzas — самодостаточные стили, scope .vzas-hero-lead */
.vzas-hero-lead.nero-ai-hero {
  --vzas-cyan: #79f2ff;
  --vzas-violet: #8b5cf6;
  --vzas-green: #22c55e;
  --vzas-text: #e6edf7;
  --vzas-muted: #9aa8bd;
  --vzas-soft: #c7d2e5;
  --vzas-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vzas-hero-lead::before {
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
.vzas-hero-lead::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(6px);
  animation: vzasHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vzasHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vzas-hero-lead .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vzas-hero-lead .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vzas-hero-lead .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(34px, 5.2vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vzas-hero-lead .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vzas-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vzas-hero-lead .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vzas-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vzas-hero-lead .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vzas-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vzas-hero-lead .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vzas-hero-lead .nero-ai-badge {
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
.vzas-hero-lead .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vzas-hero-lead .nero-ai-btn {
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
.vzas-hero-lead .nero-ai-btn:hover { transform: translateY(-2px); }
.vzas-hero-lead .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vzas-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vzas-hero-lead .nero-ai-btn-secondary {
  color: var(--vzas-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vzas-hero-lead .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vzas-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vzas-hero-lead .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vzas-hero-lead .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vzas-hero-lead .nero-ai-dots { display: flex; gap: 7px; }
.vzas-hero-lead .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vzas-hero-lead .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vzas-hero-lead .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vzas-hero-lead .nero-ai-dot:nth-child(3) { background: #34d399; }
.vzas-hero-lead .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vzas-hero-lead .nero-ai-window-body { padding: 16px; }
.vzas-hero-lead .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vzas-hero-lead .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vzas-hero-lead .nero-ai-live-pill {
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
.vzas-hero-lead .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vzasPulse 1.6s infinite;
}
@keyframes vzasPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vzas-hero-lead .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vzas-hero-lead .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vzas-hero-lead .nero-ai-metric span {
  display: block;
  color: var(--vzas-muted);
  font-size: 11px;
  font-weight: 700;
}
.vzas-hero-lead .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vzas-hero-lead .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vzas-hero-lead .vzas-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 35%, rgba(139,92,246,.12), rgba(6,10,24,.92) 72%);
}
.vzas-hero-lead #vzas-night-lead-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vzas-hero-lead .nero-ai-task-stream { display: grid; gap: 8px; }
.vzas-hero-lead .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.07);
  background: rgba(255,255,255,.04);
}
.vzas-hero-lead .nero-ai-task-icon {
  width: 28px;
  height: 28px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 800;
  background: rgba(121,242,255,.12);
  color: var(--vzas-cyan);
}
.vzas-hero-lead .nero-ai-task strong {
  display: block;
  color: #fff;
  font-size: 13px;
}
.vzas-hero-lead .nero-ai-task span {
  display: block;
  color: var(--vzas-muted);
  font-size: 11px;
  margin-top: 2px;
}
.vzas-hero-lead .nero-ai-status {
  font-size: 11px;
  font-weight: 800;
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #86efac;
}
.vzas-hero-lead .nero-ai-status--amber {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
@media (max-width: 1023px) {
  .vzas-hero-lead .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vzas-hero-lead .nero-ai-dashboard { transform: none; }
}

/* === НАТАША: страница и контент === */
.vzas-hero-lead.nero-ai-hero{min-height:100vh;min-height:100dvh;position:relative}
@media(max-width:900px){.vzas-hero-lead.nero-ai-hero{min-height:auto}}

/* ── Контент лонгрида (Наташа), prefix vzas- ── */
.vzas-content{
  --vzas-bg:#050711;--vzas-surface:rgba(255,255,255,.072);
  --vzas-text:#e6edf7;--vzas-muted:#9aa8bd;--vzas-soft:#c7d2e5;--vzas-heading:#fff;
  --vzas-border:rgba(255,255,255,.10);--vzas-accent:#79f2ff;--vzas-violet:#8b5cf6;--vzas-green:#22c55e;--vzas-amber:#fbbf24;--vzas-red:#f87171;
  --vzas-btn-from:#2563eb;--vzas-btn-to:#7c3aed;--vzas-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vzas-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vzas-content *,.vzas-content *::before,.vzas-content *::after{box-sizing:border-box}
.vzas-content [id]{scroll-margin-top:96px}
.vzas-content p{color:var(--vzas-muted);line-height:1.75;margin:0 0 1em;font-size:clamp(15px,1.5vw,16.5px)}
.vzas-content p:last-child{margin-bottom:0}
.vzas-content h2,.vzas-content h3,.vzas-content h4{color:var(--vzas-heading);letter-spacing:-.04em;margin:0 0 .7em}
.vzas-content h3{font-size:clamp(19px,2.2vw,24px);line-height:1.25;margin-top:1.8em}
.vzas-content strong{color:var(--vzas-soft)}
.vzas-content a:not(.nero-ai-btn):not(.ym-btn){color:var(--vzas-accent);text-decoration:underline;text-underline-offset:3px}
.vzas-content ul,.vzas-content ol{margin:0 0 1.2em;padding:0;list-style:none}
.vzas-content ul:not(.bzas-ul) li{position:relative;padding-left:22px;margin-bottom:.55em;color:var(--vzas-muted);font-size:15px;line-height:1.65}
.vzas-content ul:not(.bzas-ul) li::before{content:'›';position:absolute;left:2px;color:var(--vzas-accent);font-weight:800}
.vzas-content ol{counter-reset:vzas-ol}
.vzas-content ol li{counter-increment:vzas-ol;position:relative;padding-left:40px;margin-bottom:.8em;color:var(--vzas-muted);font-size:15px;line-height:1.65}
.vzas-content ol li::before{content:counter(vzas-ol);position:absolute;left:0;top:0;width:26px;height:26px;border-radius:8px;background:rgba(121,242,255,.1);border:1px solid rgba(121,242,255,.24);color:var(--vzas-accent);font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center}
.vzas-cnt{width:min(var(--vzas-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vzas-narrow{max-width:860px}
.vzas-section{padding:clamp(56px,7vw,104px) 0;position:relative}
.vzas-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vzas-sh{max-width:860px;margin:0 0 36px;text-align:left}
.vzas-sh.vzas-center{margin:0 auto 40px;text-align:center}
.vzas-sh h2{font-size:clamp(26px,3.8vw,46px);line-height:1.08;margin-bottom:14px}
.vzas-sh p{font-size:clamp(15px,1.6vw,18px)}
.vzas-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vzas-accent);margin-bottom:14px}

/* Введение сразу после hero: лид слева + KPI-декор */
.vzas-intro{padding:clamp(44px,5.5vw,80px) 0 clamp(36px,4.5vw,60px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vzas-intro-grid{display:grid;grid-template-columns:minmax(0,1fr) 360px;gap:56px;align-items:center}
.vzas-intro-text{position:relative;padding-left:22px;text-align:left}
.vzas-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vzas-accent),var(--vzas-violet))}
.vzas-intro-text p{text-align:left!important;line-height:1.8}
.vzas-intro-text .vzas-lead{font-size:clamp(16px,1.7vw,18px);color:var(--vzas-soft)}
.vzas-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vzas-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vzas-kpi-card .kv{font-size:clamp(20px,2.4vw,26px);font-weight:900;color:var(--vzas-heading);letter-spacing:-.04em;line-height:1;margin-bottom:6px}
.vzas-kpi-card .kl{font-size:11.5px;font-weight:600;color:var(--vzas-muted);line-height:1.4}
.vzas-kpi-card .ks{font-size:10px;color:#64748b;margin-top:5px}
.vzas-kpi-card--hot .kv{color:var(--vzas-green)}
.vzas-kpi-card--cold .kv{color:var(--vzas-red)}
@media(max-width:900px){.vzas-intro-grid{grid-template-columns:1fr;gap:32px}.vzas-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vzas-intro-kpi{grid-template-columns:1fr 1fr}}

/* Оглавление */
.vzas-toc-outer{padding:clamp(28px,3.5vw,44px) 0 clamp(8px,2vw,20px)}
.vzas-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vzas-toc a{display:inline-block;padding:9px 18px;background:var(--vzas-surface);border:1px solid var(--vzas-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vzas-muted)!important;text-decoration:none!important;transition:border-color .2s,color .2s,background .2s}
.vzas-toc a:hover,.vzas-toc a:focus-visible{border-color:rgba(121,242,255,.42);color:var(--vzas-accent)!important;background:rgba(121,242,255,.08)}

/* Карточки, сетки, split */
.vzas-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vzas-border);border-radius:22px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vzas-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.vzas-card h3,.vzas-card h4{margin-top:0;font-size:17px}
.vzas-card p{font-size:14.5px}
.vzas-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vzas-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.vzas-split{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(0,.9fr);gap:32px;align-items:start}
@media(max-width:960px){.vzas-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.vzas-grid-2,.vzas-grid-3,.vzas-split{grid-template-columns:1fr}}
.vzas-callout{border-left:3px solid var(--vzas-accent);background:rgba(121,242,255,.06);border-radius:0 16px 16px 0;padding:20px 24px;margin:24px 0}
.vzas-callout p{color:var(--vzas-soft);margin:0}
.vzas-callout--violet{border-left-color:var(--vzas-violet);background:rgba(139,92,246,.07)}
.vzas-callout--green{border-left-color:var(--vzas-green);background:rgba(34,197,94,.07)}
.vzas-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:24px 0}
.vzas-stat{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:18px;padding:20px}
.vzas-stat .num{display:block;font-size:clamp(24px,3vw,34px);font-weight:900;color:var(--vzas-accent);letter-spacing:-.04em;line-height:1;margin-bottom:10px}
.vzas-stat p{font-size:14px;margin:0}
.vzas-stat .src{display:block;margin-top:10px;font-size:12px;color:#64748b}
@media(max-width:860px){.vzas-stats{grid-template-columns:1fr}}
.vzas-loss-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:12px;margin:20px 0 8px}
.vzas-loss{background:rgba(248,113,113,.06);border:1px solid rgba(248,113,113,.2);border-radius:16px;padding:16px}
.vzas-loss .n{display:inline-flex;width:26px;height:26px;border-radius:8px;align-items:center;justify-content:center;background:rgba(248,113,113,.14);color:#fecaca;font-size:12px;font-weight:800;margin-bottom:10px}
.vzas-loss h4{font-size:14.5px;margin:0 0 6px}
.vzas-loss p{font-size:13px;line-height:1.55;margin:0}
@media(max-width:1100px){.vzas-loss-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:700px){.vzas-loss-grid{grid-template-columns:1fr}}

/* Таблицы */
.vzas-table-wrap{overflow-x:auto;border-radius:16px;border:1px solid rgba(255,255,255,.09);margin:22px 0;background:rgba(255,255,255,.02)}
.vzas-table{width:100%;border-collapse:collapse;font-size:14px;min-width:560px}
.vzas-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vzas-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.vzas-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vzas-text);vertical-align:top;line-height:1.55}
.vzas-table td:first-child{color:var(--vzas-heading);font-weight:600}
.vzas-table tr:last-child td{border-bottom:none}
.vzas-table tr:hover td{background:rgba(255,255,255,.03)}

/* Пайплайн заявки */
.vzas-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:flex-start;margin:22px 0;padding:18px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vzas-flow span{padding:8px 14px;border-radius:999px;font-size:12.5px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vzas-accent);border:1px solid rgba(121,242,255,.2)}
.vzas-flow .arr{color:var(--vzas-muted);padding:0 2px;background:none;border:none}
.vzas-steps{display:grid;grid-template-columns:repeat(7,1fr);gap:10px;margin:24px 0}
.vzas-step{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:16px 14px;position:relative}
.vzas-step .n{font-size:11px;font-weight:800;letter-spacing:.1em;color:var(--vzas-accent);text-transform:uppercase}
.vzas-step h4{font-size:14.5px;margin:8px 0 6px}
.vzas-step p{font-size:12.5px;line-height:1.5;margin:0}
@media(max-width:1100px){.vzas-steps{grid-template-columns:repeat(4,1fr)}}
@media(max-width:700px){.vzas-steps{grid-template-columns:1fr 1fr}}
@media(max-width:460px){.vzas-steps{grid-template-columns:1fr}}

/* Статусы лида */
.vzas-tier{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin:22px 0}
.vzas-tier-card{border-radius:18px;padding:20px;border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.05)}
.vzas-tier-card .tag{display:inline-block;padding:4px 10px;border-radius:999px;font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:10px}
.vzas-tier-card p{font-size:13.5px;line-height:1.6;margin:0}
.vzas-tier-hot{border-color:rgba(34,197,94,.32)}.vzas-tier-hot .tag{background:rgba(34,197,94,.14);color:#86efac}
.vzas-tier-warm{border-color:rgba(251,191,36,.3)}.vzas-tier-warm .tag{background:rgba(251,191,36,.14);color:#fde68a}
.vzas-tier-cold{border-color:rgba(148,163,184,.3)}.vzas-tier-cold .tag{background:rgba(148,163,184,.14);color:#cbd5e1}
.vzas-tier-spam{border-color:rgba(248,113,113,.3)}.vzas-tier-spam .tag{background:rgba(248,113,113,.14);color:#fecaca}
@media(max-width:960px){.vzas-tier{grid-template-columns:1fr 1fr}}
@media(max-width:520px){.vzas-tier{grid-template-columns:1fr}}

/* Кейсы */
.vzas-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin:20px 0}
@media(max-width:960px){.vzas-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:640px){.vzas-case-grid{grid-template-columns:1fr}}
.vzas-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:24px;transition:border-color .2s,transform .2s}
.vzas-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.vzas-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vzas-green);margin-bottom:10px}
.vzas-case-card h4{font-size:16px;margin:0 0 10px}
.vzas-case-card p{font-size:14px;line-height:1.62}
.vzas-case-card .src{display:block;margin-top:12px;font-size:12.5px}

/* FAQ */
.vzas-faq{display:flex;flex-direction:column;gap:10px;max-width:860px;margin:0 auto}
.vzas-faq details{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;transition:border-color .2s}
.vzas-faq details[open]{border-color:rgba(121,242,255,.3)}
.vzas-faq summary{padding:18px 22px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;list-style:none}
.vzas-faq summary::-webkit-details-marker{display:none}
.vzas-faq summary::after{content:'▾';font-size:13px;color:var(--vzas-accent);flex-shrink:0;transition:transform .25s}
.vzas-faq details[open] summary::after{transform:rotate(180deg)}
.vzas-faq summary h3{margin:0;font-size:16px;line-height:1.4;letter-spacing:-.02em}
.vzas-faq .vzas-faq-a{padding:0 22px 20px}
.vzas-faq .vzas-faq-a p{font-size:14.5px}

/* Квиз и финальный CTA */
.vzas-final{background:radial-gradient(ellipse at 50% 0%,rgba(121,242,255,.1),transparent 60%),linear-gradient(135deg,rgba(121,242,255,.05),rgba(139,92,246,.07))}
.vzas-quiz{display:grid;grid-template-columns:repeat(5,1fr);gap:12px;margin:26px 0;counter-reset:vzas-q;padding:0;list-style:none}
.vzas-quiz li{counter-increment:vzas-q;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.11);border-radius:18px;padding:18px 16px 18px;font-size:14px;line-height:1.55;color:var(--vzas-soft);margin:0}
.vzas-quiz li::before{content:'Вопрос ' counter(vzas-q);display:block;font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--vzas-accent);margin-bottom:8px}
@media(max-width:1000px){.vzas-quiz{grid-template-columns:1fr 1fr}}
@media(max-width:560px){.vzas-quiz{grid-template-columns:1fr}}
.vzas-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin:0 0 28px!important}
.vzas-content ul.vzas-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13.5px;color:var(--vzas-soft);margin:0}
.vzas-content ul.vzas-checklist li::before{content:'✓';position:static;color:var(--vzas-green);font-weight:800}
.vzas-final-actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-top:8px}
.vzas-final-note{text-align:center;font-size:13.5px!important;margin-top:14px!important}

/* Рекламные вставки Артура */
.ym-cta-block{border-radius:20px;padding:34px 38px;margin:36px 0 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:34px;margin-bottom:12px}
.vzas-content .ym-cta-block__headline{font-size:clamp(20px,2.6vw,27px);font-weight:800;color:#fff;margin:0 0 10px;line-height:1.25}
.vzas-content .ym-cta-block__sub{color:var(--vzas-muted);font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7}
.vzas-content .ym-cta-block--secondary .ym-cta-block__sub{margin:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.vzas-content .ym-link--accent{color:var(--vzas-accent)!important;text-decoration:underline!important}
.vzas-content .ym-btn{display:inline-flex;align-items:center;justify-content:center;min-height:48px;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;border:1px solid transparent}
.vzas-content .ym-btn:hover{transform:translateY(-2px)}
.vzas-content .ym-btn--accent{background:linear-gradient(135deg,var(--vzas-btn-from),var(--vzas-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.vzas-content .ym-btn--ghost{background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.16);color:var(--vzas-text)!important}

/* Итог */
.vzas-summary{border-radius:22px;padding:26px 28px;margin:40px auto 0;max-width:860px;background:rgba(255,255,255,.05);border:1px solid rgba(121,242,255,.22)}
.vzas-summary p{color:var(--vzas-soft);margin:0}

/* Reveal */
.vzas-content .nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.vzas-content .nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.vzas-content .nero-ai-delay-1{transition-delay:.12s}
.vzas-content .nero-ai-delay-2{transition-delay:.24s}
@media(prefers-reduced-motion:reduce){.vzas-content .nero-ai-reveal{opacity:1;transform:none;transition:none}}
.vzas-content .screen-reader-text{position:absolute!important;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
.vzas-content code{font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:.9em;padding:2px 6px;border-radius:6px;background:rgba(121,242,255,.1);color:var(--vzas-accent)}

/* === БОРИС: prefix bzas-, scoped внутри #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block === */
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block.bzas-root{
  padding:40px 0 8px;
  margin:32px 0 0;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-card{
  display:grid;
  grid-template-columns:minmax(0,44%) minmax(0,56%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 12px 44px rgba(15,23,42,.1),0 0 0 1px rgba(148,163,184,.2);
  min-height:460px;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-lft{
  padding:36px 32px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:28px 22px;
  }
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#059669;margin:0 0 12px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-ey::before{
  content:'';width:18px;height:2px;background:#059669;border-radius:1px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-h3{
  font-size:clamp(19px,2.3vw,25px);font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 16px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-ul{
  list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(5,150,105,.12);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#047857;margin-top:1px;font-style:normal;font-weight:700;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-pl-r{
  background:rgba(239,68,68,.08);color:#b91c1c;border:1.5px solid rgba(239,68,68,.22);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-pl-g{
  background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-pl-b{
  background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-foot{
  font-size:13px;color:#64748b;font-style:italic;margin:0;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-rgt{
  position:relative;
  background:linear-gradient(145deg,#f0fdf4 0%,#ecfeff 42%,#f8fafc 100%);
  min-height:400px;overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bzas-rgt{min-height:340px;}
}
#bzas-sla-funnel-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-obrabotka-zayavok-s-sayta-page" role="main" tabindex="-1" style="padding-top:0">

<section class="nero-ai-hero vzas-hero-lead" id="vzas-hero-lead" aria-labelledby="vzas-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Заявки с сайта · внедрение под ключ</p>
      <h1 id="vzas-hero-title">AI-агент для первичной обработки заявок с сайта: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Ответ за 5–15 секунд, уточняющие вопросы и передача горячего лида в CRM — без ночных «мёртвых» заявок</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Ответ 5–15 сек</li>
        <li class="nero-ai-badge">Квалификация hot/warm</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
        <li class="nero-ai-badge">24/7 на сайте</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url( $primary_cta_url ); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-обработки заявок с сайта">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Диспетчерская заявок с сайта</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Ночных заявок</span>
              <strong>12</strong>
              <small>после 22:00</small>
            </div>
            <div class="nero-ai-metric">
              <span>Первый ответ</span>
              <strong>8 сек</strong>
              <small>виджет + форма</small>
            </div>
            <div class="nero-ai-metric">
              <span>Hot сегодня</span>
              <strong>5</strong>
              <small>score ≥ 4</small>
            </div>
            <div class="nero-ai-metric">
              <span>В CRM</span>
              <strong>auto</strong>
              <small>сделки + задачи</small>
            </div>
          </div>

          <div class="vzas-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vzas-night-lead-canvas" role="img" aria-label="Анимация: ночная заявка с сайта проходит AI-квалификацию и уходит горячим лидом в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий заявок">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🌙</span>
              <div><strong>23:40 · форма на сайте</strong><span>Webhook → черновик лида</span></div>
              <span class="nero-ai-status">принято</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>3 уточняющих вопроса</strong><span>услуга · бюджет · срок</span></div>
              <span class="nero-ai-status">диалог</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Hot · сделка #201</strong><span>amoCRM + резюме менеджеру</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Менеджер уведомлён</strong><span>перезвонить в 15 мин</span></div>
              <span class="nero-ai-status nero-ai-status--amber">hot</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vzas-content">

  <section class="vzas-intro" id="vvedenie" aria-label="Введение">
    <div class="vzas-cnt">
      <div class="vzas-intro-grid nero-ai-reveal">
        <div class="vzas-intro-text">
          <span class="vzas-eyebrow">Лонгрид · AI-обработка заявок с сайта</span>
          <p class="vzas-lead"><strong>Коротко.</strong> AI обработка заявок — это сценарий, в котором на каждую заявку с сайта (форма, чат, обратный звонок) за 5–15 секунд отвечает AI-агент: здоровается, уточняет задачу, проверяет критерии «горячего» клиента и сам создаёт сделку в amoCRM или Битрикс24 с кратким резюме для менеджера. Nero Network внедряет такой сценарий под ключ для малого и среднего бизнеса — услуг, онлайн-школ, клиник: от аудита потерь заявок до пилота и поддержки. Ориентир — 2–4 недели на один канал и 120–350 тыс. ₽ на старт.</p>
          <p>Заявка приходит в 23:40. Клиент сравнивает три компании и пишет во все три формы подряд. Менеджер первой увидит сообщение утром, второй — после планёрки, а третья ответит через несколько секунд, задаст два уточняющих вопроса и предложит удобное время звонка. Кто получит клиента, догадаться несложно.</p>
          <p>Эта страница — о том, как сделать вашу компанию третьей. Без расширения штата, без «бота с кнопками», который раздражает клиентов, и без рискованных обещаний от нейросети. Разберём, как устроено внедрение AI в бизнес-процесс приёма заявок, что AI делает сам, а что обязательно остаётся за человеком, сколько стоит запуск и какие ограничения по персональным данным нужно учесть в 2025–2026 годах.</p>
        </div>
        <div class="vzas-intro-kpi" aria-label="Ключевые цифры о скорости ответа на заявки">
          <div class="vzas-kpi-card vzas-kpi-card--cold"><div class="kv">~50%</div><div class="kl">уходят, если ждать ответа дольше 10 минут</div><div class="ks">Телфин + OkoCRM, 2025</div></div>
          <div class="vzas-kpi-card"><div class="kv">42 ч</div><div class="kl">средний ответ на веб-заявку</div><div class="ks">HBR, 2011</div></div>
          <div class="vzas-kpi-card vzas-kpi-card--hot"><div class="kv">5–15 с</div><div class="kl">первый ответ AI-агента</div><div class="ks">сценарий Nero Network</div></div>
          <div class="vzas-kpi-card"><div class="kv">2–4 нед</div><div class="kl">внедрение на один канал</div><div class="ks">с пилотом</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vzas-toc-outer">
    <div class="vzas-cnt">
      <nav class="vzas-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-ostyvayut">Почему заявки остывают</a>
        <a href="#chto-takoe-ai">Что такое AI-обработка</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Этапы и сроки</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#riski">Риски и 152-ФЗ</a>
        <a href="#faq">FAQ</a>
        <a href="#audit-kviz">Квиз и аудит</a>
      </nav>
    </div>
  </div>

  <section class="vzas-section" id="pochemu-ostyvayut" aria-labelledby="vzas-h2-pochemu">
    <div class="vzas-cnt">
      <div class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Почему теряются деньги</span>
        <h2 id="vzas-h2-pochemu">Почему заявки с сайта «остывают» без мгновенного ответа</h2>
        <p>Заявка с сайта — самый «горячий» момент интереса клиента. Через час он уже переключился на другую задачу, через день — купил у конкурента или передумал. Это не ощущение, а то, что регулярно показывают исследования клиентских обращений.</p>
      </div>

      <p class="nero-ai-reveal"><strong>Что говорят данные:</strong></p>
      <div class="vzas-stats nero-ai-reveal">
        <div class="vzas-stat">
          <span class="num">~50%</span>
          <p><strong>Около половины клиентов уходят без заказа</strong>, если ответа приходится ждать дольше 10 минут. Это вывод исследования Телфин и OkoCRM: опрос более 7 500 респондентов в сентябре 2025 года, сегменты — e-commerce, медицина, недвижимость.</p>
          <span class="src"><a href="https://www.cnews.ru/news/line/2025-11-24_issledovanie_telfin_i" target="_blank" rel="noopener noreferrer">CNews, ноябрь 2025</a>; <a href="https://oborot.ru/articles/kommunikacii-opros-72-i259134.html" target="_blank" rel="noopener noreferrer">Oborot.ru</a></span>
        </div>
        <div class="vzas-stat">
          <span class="num">10–15%</span>
          <p><strong>В B2B 10–15% чат-заявок остаются без своевременного ответа</strong>, а 15–20% звонков — без ответа вовсе. Callibri пришёл к этому на массиве из 674 871 обращения за год.</p>
          <span class="src"><a href="https://callibri.ru/blog/obrabotka-lidov-na-b2b-rynke-v-2025-godu" target="_blank" rel="noopener noreferrer">Callibri, обработка лидов в B2B, 2025</a></span>
        </div>
        <div class="vzas-stat">
          <span class="num">≤ 1 мин</span>
          <p><strong>Для B2C-услуг ориентир SLA в чате — не больше 1 минуты</strong>, а в срочных нишах ответ по телефону ожидается быстрее 20 секунд.</p>
          <span class="src"><a href="https://callibri.ru/blog/issledovanie-klientskih-obrashchenij-rynka-uslug-b2c-2025" target="_blank" rel="noopener noreferrer">Callibri, исследование рынка услуг B2C, 2025</a></span>
        </div>
      </div>
      <div class="vzas-callout nero-ai-reveal">
        <p>Получается простая арифметика: если заявка пришла ночью, а менеджер ответил в 9:30 утра, вы конкурируете уже не за горячего клиента, а за того, кто ещё не нашёл исполнителя.</p>
      </div>

      <h3 class="nero-ai-reveal">Где именно теряются заявки</h3>
      <p class="nero-ai-reveal">По опыту аудитов воронок у малого и среднего бизнеса потери почти всегда концентрируются в одних и тех же точках:</p>
      <div class="vzas-loss-grid nero-ai-reveal" role="list">
        <div class="vzas-loss" role="listitem"><span class="n">1</span><h4>Нерабочее время и выходные</h4><p>Форма принимает заявки круглосуточно, отдел продаж — нет.</p></div>
        <div class="vzas-loss" role="listitem"><span class="n">2</span><h4>Пики после рекламы</h4><p>Запустили кампанию — заявки пришли пачкой, менеджеры физически не успевают ответить всем в первые минуты.</p></div>
        <div class="vzas-loss" role="listitem"><span class="n">3</span><h4>Менеджер занят</h4><p>Он на звонке, на встрече или выставляет счёт, а новый лид ждёт в очереди.</p></div>
        <div class="vzas-loss" role="listitem"><span class="n">4</span><h4>Заявка ушла «не туда»</h4><p>Форма отправляет письмо на общий ящик, его читают раз в день.</p></div>
        <div class="vzas-loss" role="listitem"><span class="n">5</span><h4>Нецелевые обращения</h4><p>Спам, вопросы «не по профилю», конкуренты — они съедают время, которое должно было уйти на горячих клиентов.</p></div>
      </div>

      <div class="vzas-narrow">
        <h3 class="nero-ai-reveal">Мифы и данные о скорости ответа</h3>
        <p class="nero-ai-reveal">В интернете часто цитируют «правило 5 минут от Гарварда» с обещанием роста конверсии «в 100 раз». Исходные данные скромнее и при этом убедительнее. Исследование Harvard Business Review 2011 года показало: среднее время ответа компаний на тестовую веб-заявку составило <strong>42 часа</strong>, а <strong>23% компаний не ответили совсем</strong>. Компании, которые связывались с клиентом в течение часа, почти <strong>в 7 раз чаще</strong> доводили лид до содержательного разговора с лицом, принимающим решение, чем те, кто ответил даже на час позже (<a href="https://hbr.org/2011/03/the-short-life-of-online-sales-leads" target="_blank" rel="noopener noreferrer">HBR, The Short Life of Online Sales Leads, 2011</a>).</p>
        <p class="nero-ai-reveal">Это классика, а не свежий тренд, но вывод из неё только усилился: клиенты 2025–2026 годов ждут ещё меньше, а ответ «в течение часа» сегодня — это уже медленно.</p>
      </div>

<section id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block" class="bzas-root" aria-label="Анимация: воронка ответа на заявку — медленный ответ против AI за 5–15 секунд">
  <div class="bzas-card">
    <div class="bzas-lft">
      <span class="bzas-ey">SLA и потери лидов</span>
      <h3 class="bzas-h3">Две скорости одной заявки: часы ожидания или ответ за секунды</h3>
      <ul class="bzas-ul">
        <li><span class="bzas-ic">×</span>Без мгновенного ответа ~половина клиентов уходит, если ждать дольше 10 минут (Телфин + OkoCRM, 2025)</li>
        <li><span class="bzas-ic">⏱</span>Классика рынка: средний ответ на веб-заявку измерялся часами, не секундами (HBR, 2011)</li>
        <li><span class="bzas-ic">✓</span>AI-агент на сайте: первый ответ 5–15 с, квалификация и карточка в CRM без ночной паузы</li>
        <li><span class="bzas-ic">→</span>Менеджер получает уже размеченный hot/warm лид, а не «сырой» номер из формы</li>
      </ul>
      <div class="bzas-pills">
        <span class="bzas-pl bzas-pl-r">10+ мин → уход</span>
        <span class="bzas-pl bzas-pl-b">5–15 сек AI</span>
        <span class="bzas-pl bzas-pl-g">hot в CRM</span>
      </div>
      <p class="bzas-foot">Дальше разберём, чем AI-агент отличается от кнопочного чат-бота →</p>
    </div>
    <div class="bzas-rgt">
      <canvas id="bzas-sla-funnel-canvas" role="img" aria-label="Сравнение: заявка с сайта при медленном ответе остывает, при AI проходит путь за секунды в CRM"></canvas>
    </div>
  </div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bzas-sla-funnel-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0, cycle = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 400;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a', muted:'#64748b', line:'#cbd5e1',
    slow:'#ef4444', slowBg:'rgba(254,226,226,.5)',
    fast:'#22c55e', fastBg:'rgba(220,252,231,.55)',
    lead:'#3b82f6', crm:'#0ea5e9', clock:'#f59e0b'
  };

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  var slowLead = { t:0, x:0, y:0, alpha:1, phase:'wait' };
  var fastLead = { t:0, x:0, y:0, alpha:0, phase:'idle' };

  function resetCycle(){
    cycle = 0;
    slowLead = { t:0, x: W*0.22, y: H*0.32, alpha:1, phase:'wait' };
    fastLead = { t:0, x: W*0.72, y: H*0.32, alpha:0, phase:'idle' };
  }
  resetCycle();

  function drawLead(x,y,r,color,label){
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.arc(x,y,r,0,Math.PI*2);
    ctx.fill();
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.stroke();
    if (label){
      ctx.fillStyle = C.ink;
      ctx.font = 'bold 9px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(label, x, y + r + 12);
    }
  }

  function drawClock(cx,cy,r,angle){
    rr(cx-r,cy-r,r*2,r*2,r,'#fffbeb',C.clock);
    ctx.strokeStyle = C.clock;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(cx,cy,r-4,0,Math.PI*2);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(cx,cy);
    ctx.lineTo(cx + Math.cos(angle)*(r-8), cy + Math.sin(angle)*(r-8));
    ctx.stroke();
  }

  function drawCrmBadge(x,y,w,h,hot){
    rr(x,y,w,h,10,'#fff',C.crm);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('CRM', x+10, y+18);
    ctx.fillStyle = hot ? C.fast : C.muted;
    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.fillText(hot ? 'HOT · score 5' : 'черновик', x+10, y+34);
    ctx.fillStyle = C.ink;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText('резюме диалога', x+10, y+50);
  }

  function tick(){
    frame++;
    cycle++;

    var splitX = W * 0.5;
    var laneTop = H * 0.14;

    ctx.clearRect(0,0,W,H);

    /* колонки */
    rr(W*0.04, laneTop, W*0.42, H*0.78, 14, C.slowBg, 'rgba(239,68,68,.25)');
    rr(W*0.54, laneTop, W*0.42, H*0.78, 14, C.fastBg, 'rgba(34,197,94,.28)');

    ctx.fillStyle = C.ink;
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Медленный ответ', W*0.08, laneTop + 22);
    ctx.textAlign = 'right';
    ctx.fillText('AI 5–15 сек', W*0.92, laneTop + 22);

    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('заявка → очередь → остывание', W*0.08, laneTop + 38);
    ctx.textAlign = 'right';
    ctx.fillText('заявка → диалог → CRM', W*0.92, laneTop + 38);

    /* медленная ветка */
    if (cycle < 220){
      slowLead.phase = 'wait';
      slowLead.x = W*0.22;
      slowLead.y = H*0.36 + Math.sin(frame*0.04)*3;
      var ang = frame * 0.07;
      drawClock(W*0.22, H*0.58, Math.min(W,H)*0.09, ang);
      ctx.fillStyle = C.slow;
      ctx.font = 'bold 11px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('10+ мин', W*0.22, H*0.72);
    } else if (cycle < 320){
      slowLead.y += 0.35;
      slowLead.alpha -= 0.012;
      ctx.globalAlpha = Math.max(0, slowLead.alpha);
      drawLead(slowLead.x, slowLead.y, 14, C.slow, '');
      ctx.fillStyle = C.slow;
      ctx.font = '10px system-ui,sans-serif';
      ctx.fillText('лид остыл', slowLead.x, slowLead.y + 28);
      ctx.globalAlpha = 1;
    } else {
      slowLead.alpha = 0;
    }

    if (slowLead.alpha > 0.2 && cycle < 220){
      drawLead(slowLead.x, slowLead.y, 14, C.lead, 'заявка');
    }

    /* быстрая ветка */
    if (cycle > 40 && cycle < 280){
      fastLead.alpha = Math.min(1, fastLead.alpha + 0.03);
      ctx.globalAlpha = fastLead.alpha;

      if (cycle < 120){
        fastLead.x = W*0.72;
        fastLead.y = H*0.36;
        drawLead(fastLead.x, fastLead.y, 14, C.lead, 'заявка');
        ctx.fillStyle = C.fast;
        ctx.font = 'bold 10px system-ui,sans-serif';
        ctx.fillText('ответ 8 с', W*0.72, H*0.52);
      } else if (cycle < 200){
        var hubX = W*0.72, hubY = H*0.5;
        rr(hubX-28,hubY-18,56,36,8,'#ecfdf5',C.fast);
        ctx.fillStyle = C.fast;
        ctx.font = 'bold 10px system-ui,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('квалиф.', hubX, hubY+4);
        drawLead(W*0.72, H*0.36, 12, C.lead, '');
      } else {
        drawCrmBadge(W*0.62, H*0.55, W*0.2, 62, true);
        ctx.strokeStyle = C.fast;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(W*0.72, H*0.42);
        ctx.lineTo(W*0.72, H*0.55);
        ctx.stroke();
      }
      ctx.globalAlpha = 1;
    }

    /* разделитель */
    ctx.strokeStyle = C.line;
    ctx.setLineDash([4,6]);
    ctx.beginPath();
    ctx.moveTo(splitX, laneTop + 8);
    ctx.lineTo(splitX, laneTop + H*0.76);
    ctx.stroke();
    ctx.setLineDash([]);

    if (cycle > 360) resetCycle();

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
</section>

      <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-pochemu">
        <div class="ym-cta-block__icon" aria-hidden="true">⏱️</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверьте, не остывают ли заявки из‑за медленного ответа</p>
          <p class="ym-cta-block__sub">За 30 минут разберём каналы, ночной поток и время первого ответа — и покажем, где теряются лиды до CRM. Бесплатно, без обязательств.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </aside>
    </div>
  </section>

  <section class="vzas-section vzas-section-alt" id="chto-takoe-ai" aria-labelledby="vzas-h2-chto">
    <div class="vzas-cnt">
      <div class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">AI-агент vs чат-бот</span>
        <h2 id="vzas-h2-chto">Что такое AI-обработка заявок с сайта и чем она отличается от обычного чат-бота</h2>
      </div>
      <div class="vzas-callout vzas-callout--violet nero-ai-reveal">
        <p><strong>Определение.</strong> AI-агент для первичной обработки заявок — программный слой между точкой входа (форма, виджет чата, обратный звонок, мессенджер) и CRM. Он понимает свободный текст, ведёт диалог по правилам вашего бизнеса, извлекает данные из переписки, задаёт уточняющие вопросы, классифицирует лид и выполняет действия: создаёт или обновляет сделку, ставит задачу менеджеру, пишет резюме диалога, передаёт спорные случаи человеку.</p>
      </div>
      <p class="nero-ai-reveal">Ключевое слово — <strong>действия</strong>. Обычный чат-бот отвечает. AI-агент для сайта отвечает и делает работу первой линии продаж.</p>
      <div class="vzas-table-wrap nero-ai-reveal">
        <table class="vzas-table">
          <caption class="screen-reader-text">Сравнение кнопочного чат-бота и AI-агента</caption>
          <thead><tr><th scope="col">Критерий</th><th scope="col">Кнопочный чат-бот</th><th scope="col">AI-агент (AI менеджер заявок)</th></tr></thead>
          <tbody>
            <tr><td>Понимание запроса</td><td>Только кнопки и ключевые слова</td><td>Свободный текст, опечатки, голосовые (при настройке)</td></tr>
            <tr><td>Сценарий диалога</td><td>Жёсткое дерево</td><td>Скрипт квалификации + ответы из базы знаний</td></tr>
            <tr><td>Работа с CRM</td><td>Чаще всего только «создать заявку»</td><td>Создать/обновить сделку, заполнить поля, поставить теги и задачу</td></tr>
            <tr><td>Квалификация</td><td>Нет или по одной кнопке</td><td>Скоринг hot / warm / cold / spam по вашим критериям</td></tr>
            <tr><td>Передача менеджеру</td><td>Пересылка переписки целиком</td><td>Резюме в 3–5 предложений + история диалога</td></tr>
            <tr><td>Эскалация</td><td>По кнопке «позвать оператора»</td><td>По правилам: негатив, скидки, юридические и медицинские вопросы</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vzas-split">
        <div class="nero-ai-reveal">
          <h3>Почему агентные сценарии стали актуальны в 2026 году</h3>
          <p>Рынок сместился от «бота с FAQ» к агентам, которые выполняют действия. Это видно по продуктовой линейке OpenAI: в enterprise-направлении компания предлагает агентов для demand generation — квалификации лидов, фиксации намерения клиента и обогащения записей (<a href="https://openai.com/business/openai-presence/" target="_blank" rel="noopener noreferrer">OpenAI Presence</a>), а в ChatGPT Business и Enterprise появились workspace-агенты, которые среди прочего квалифицируют новые лиды и готовят follow-up письма (<a href="https://openai.com/index/introducing-workspace-agents-in-chatgpt/" target="_blank" rel="noopener noreferrer">OpenAI, workspace agents, 2026</a>).</p>
          <p>Это решения уровня крупных компаний. Для малого и среднего бизнеса в России тот же класс задач закрывается связкой «интегратор + amoCRM/Битрикс24 + языковая модель (OpenAI, Claude, YandexGPT, GigaChat)» — с выбором модели под вашу политику обработки данных.</p>
        </div>
        <div class="vzas-card nero-ai-reveal nero-ai-delay-1" aria-label="Стек для МСБ">
          <h4>Связка для МСБ в России</h4>
          <div class="vzas-flow" style="margin:12px 0 0">
            <span>Интегратор</span><span class="arr" aria-hidden="true">+</span><span>amoCRM / Битрикс24</span><span class="arr" aria-hidden="true">+</span><span>OpenAI · Claude · YandexGPT · GigaChat</span>
          </div>
        </div>
      </div>

      <h3 class="nero-ai-reveal">Сценарии: виджет/чат, форма + webhook, мессенджер как продолжение заявки</h3>
      <div class="vzas-table-wrap nero-ai-reveal">
        <table class="vzas-table">
          <caption class="screen-reader-text">Сценарии AI-обработки заявок</caption>
          <thead><tr><th scope="col">Сценарий</th><th scope="col">Как это выглядит для клиента</th><th scope="col">На что обратить внимание при внедрении</th></tr></thead>
          <tbody>
            <tr><td>Виджет / чат на сайте</td><td>Пишет в чат — через секунды получает ответ и уточняющие вопросы</td><td>SLA первого ответа, правила эскалации, согласие на обработку ПДн</td></tr>
            <tr><td>Форма + webhook</td><td>Оставил заявку в форме — сразу получает сообщение в чате, Telegram или на e-mail</td><td>Единая карточка лида, дедупликация повторных заявок</td></tr>
            <tr><td>Мессенджер как продолжение заявки</td><td>После формы на сайте приходит сообщение в WhatsApp или Telegram, диалог ведёт тот же агент</td><td>Отдельное согласие на ПДн, хранение данных в РФ</td></tr>
            <tr><td>Ночной режим</td><td>Ответ 24/7, запись на удобное время звонка утром</td><td>Список того, что агент <strong>не</strong> обещает: индивидуальные цены, сроки, диагнозы</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">Начинать мы рекомендуем с одного-двух сценариев, где потери заметнее всего. Остальные каналы подключаются к уже настроенному агенту, а не строятся заново.</p>
      <!-- INTERNAL-LINKS:INSERT -->

      <h3 class="nero-ai-reveal">Что считается «горячим» лидом и SLA ответа 5–15 секунд</h3>
      <p class="nero-ai-reveal">Без чёткого определения «горячего» лида AI-квалификация превращается в лотерею. Поэтому в проекте внедрения мы фиксируем критерии письменно — до написания первого промпта.</p>
      <div class="vzas-tier nero-ai-reveal" role="list">
        <div class="vzas-tier-card vzas-tier-hot" role="listitem"><span class="tag">Горячий · hot</span><p>Есть контакт, целевая услуга, бюджет в вашей вилке, срок до 30 дней, нет «красных флагов» (спам, конкурент, вне географии). Менеджеру ставится задача перезвонить в течение заданного числа минут.</p></div>
        <div class="vzas-tier-card vzas-tier-warm" role="listitem"><span class="tag">Тёплый · warm</span><p>Интерес есть, но не хватает данных или срок размыт. Нужен дожим менеджером.</p></div>
        <div class="vzas-tier-card vzas-tier-cold" role="listitem"><span class="tag">Холодный · cold / nurture</span><p>Отложенный спрос — подписка на рассылку, полезные материалы, напоминание позже.</p></div>
        <div class="vzas-tier-card vzas-tier-spam" role="listitem"><span class="tag">Спам / нецелевой</span><p>Фиксируется и не отвлекает отдел продаж.</p></div>
      </div>

      <div class="vzas-grid-2">
        <div class="nero-ai-reveal">
          <p><strong>Тайминги сценария:</strong></p>
          <div class="vzas-table-wrap">
            <table class="vzas-table" style="min-width:0">
              <caption class="screen-reader-text">Тайминги сценария обработки заявки</caption>
              <thead><tr><th scope="col">Момент</th><th scope="col">Что происходит</th></tr></thead>
              <tbody>
                <tr><td>&lt; 1 секунды</td><td>Создаётся черновик лида в CRM или сессия в очереди</td></tr>
                <tr><td>5–15 секунд</td><td>Приветствие и запрос согласия на обработку ПДн, если оно не получено в форме</td></tr>
                <tr><td>1–5 минут</td><td>3–7 вопросов квалификации, ответы на типовые вопросы из базы знаний</td></tr>
                <tr><td>Сразу после диалога</td><td>Скоринг, запись полей и резюме в CRM, уведомление ответственному</td></tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="nero-ai-reveal nero-ai-delay-1">
          <p><strong>Квалификационные вопросы зависят от ниши. Одна платформа — разные поля:</strong></p>
          <div class="vzas-table-wrap">
            <table class="vzas-table" style="min-width:0">
              <caption class="screen-reader-text">Квалификационные вопросы по нишам</caption>
              <thead><tr><th scope="col">Ниша</th><th scope="col">Что спрашивает агент</th><th scope="col">Что получает менеджер в CRM</th></tr></thead>
              <tbody>
                <tr><td>Услуги (B2C и B2B)</td><td>Какая услуга, объём, город, желаемый срок, бюджет</td><td>Услуга, срочность, вилка бюджета, score 1–5</td></tr>
                <tr><td>Онлайн-школа</td><td>Цель обучения, текущий уровень, формат, удобное время консультации</td><td>Продукт, уровень, слот консультации, источник</td></tr>
                <tr><td>Клиника</td><td>Направление, удобная дата, первичный или повторный визит</td><td>Запись или заявка на запись; без медицинских оценок</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vzas-section" id="kak-rabotaet" aria-labelledby="vzas-h2-kak">
    <div class="vzas-cnt">
      <div class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Путь заявки</span>
        <h2 id="vzas-h2-kak">Как работает первичная квалификация: вопросы, теги, передача в CRM</h2>
        <p>Схема работы AI обработки заявок с CRM выглядит так:</p>
      </div>
      <div class="vzas-flow nero-ai-reveal" aria-label="Схема пути заявки">
        <span>Событие</span><span class="arr" aria-hidden="true">→</span><span>Фиксация</span><span class="arr" aria-hidden="true">→</span><span>Первый ответ</span><span class="arr" aria-hidden="true">→</span><span>Диалог</span><span class="arr" aria-hidden="true">→</span><span>Классификация</span><span class="arr" aria-hidden="true">→</span><span>Передача</span><span class="arr" aria-hidden="true">→</span><span>Контроль</span>
      </div>
      <div class="vzas-split">
        <ol class="nero-ai-reveal">
          <li><strong>Событие.</strong> Клиент отправил форму, написал в виджет или пришёл входящий webhook.</li>
          <li><strong>Фиксация.</strong> Меньше чем за секунду в CRM создаётся черновик лида или сессия — заявка уже не потеряется, даже если клиент закроет вкладку.</li>
          <li><strong>Первый ответ.</strong> За 5–15 секунд агент здоровается, подтверждает получение заявки и при необходимости запрашивает согласие на обработку персональных данных.</li>
          <li><strong>Диалог.</strong> Агент задаёт 3–7 вопросов по скрипту квалификации и отвечает на типовые вопросы по базе знаний (RAG — поиск по вашим документам, FAQ, прайс-рамкам).</li>
          <li><strong>Классификация.</strong> Лид получает статус hot / warm / cold / spam, агент вызывает действие «создать или обновить сделку».</li>
          <li><strong>Передача.</strong> Ответственный получает уведомление (например, в Telegram); для горячего лида ставится задача «перезвонить в течение N минут».</li>
          <li><strong>Контроль.</strong> Спорный диалог помечается флагом <code>human_review</code> — его просматривает человек, а агент не даёт обещаний, которые не может выполнить.</li>
        </ol>
        <div class="vzas-card nero-ai-reveal nero-ai-delay-1">
          <h4>Structured output вместо «текста»</h4>
          <p>Технически результат диалога агент отдаёт не «текстом», а в виде <strong>структурированного ответа (structured output)</strong> — фиксированного набора полей: имя, телефон, услуга, бюджет, срочность, score от 1 до 5, краткое резюме переписки. Это важная деталь: без жёсткой схемы числовой скоринг у языковых моделей «плавает», и CRM заполняется непредсказуемо.</p>
        </div>
      </div>

      <h3 class="nero-ai-reveal">amoCRM и Битрикс24: типовые поля и статусы</h3>
      <p class="nero-ai-reveal">Интеграция AI обработки заявок обычно строится вокруг уже существующей воронки — мы не заставляем отдел продаж переезжать.</p>
      <div class="vzas-grid-2">
        <div class="vzas-card nero-ai-reveal">
          <h4>amoCRM</h4>
          <p>Агент создаёт сделку в нужной воронке, заполняет пользовательские поля (услуга, бюджет, срочность, score), ставит теги канала и статуса квалификации, переводит сделку на этап вроде «Квалифицированный лид» и ставит задачу ответственному. Подключение — через вебхуки и API; там, где уже работает Salesbot, агент дополняет его пониманием свободного текста и резюме диалога.</p>
        </div>
        <div class="vzas-card nero-ai-reveal nero-ai-delay-1">
          <h4>Битрикс24</h4>
          <p>Обращения из чата приходят через открытые линии, заявки с форм — через входящий webhook. Агент создаёт лид или сделку, заполняет поля, добавляет комментарий с резюме и назначает ответственного.</p>
        </div>
      </div>
      <div class="vzas-callout nero-ai-reveal">
        <p><strong>Типовой набор полей для старта:</strong> источник и канал, услуга/продукт, бюджет (вилка), срок, город, статус квалификации, score 1–5, резюме диалога, отметка о согласии на обработку ПДн, флаг <code>human_review</code>.</p>
      </div>

      <h3 class="nero-ai-reveal">Эскалация на живого менеджера</h3>
      <div class="vzas-split">
        <div class="nero-ai-reveal">
          <p>Хороший AI менеджер заявок знает границы своей компетенции. Передача человеку срабатывает автоматически, если:</p>
          <ul>
            <li>клиент раздражён или жалуется;</li>
            <li>просит скидку или условия вне вашей политики;</li>
            <li>задаёт юридически значимые вопросы или требует индивидуальное КП;</li>
            <li>в клинике — описывает симптомы и ждёт медицинской оценки (агент только записывает и маршрутизирует);</li>
            <li>прямо просит «позвать человека»;</li>
            <li>агент не нашёл ответ в базе знаний.</li>
          </ul>
        </div>
        <div class="vzas-card nero-ai-reveal nero-ai-delay-1">
          <h4>Что всегда остаётся за человеком</h4>
          <p>Закрытие сделки и переговоры по цене, нестандартные коммерческие предложения, регулируемые консультации, разбор жалоб, утверждение изменений в базе знаний и критериях квалификации. AI берёт на себя первую линию, а не продажу целиком.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vzas-section vzas-section-alt" id="etapy" aria-labelledby="vzas-h2-etapy">
    <div class="vzas-cnt">
      <div class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Под ключ</span>
        <h2 id="vzas-h2-etapy">Внедрение AI обработки заявок под ключ: этапы и сроки</h2>
        <p>Внедрение AI агентов в отдел продаж — это не «подключить виджет», а короткий проект с понятными этапами. Типовой план Nero Network на один канал:</p>
      </div>
      <div class="vzas-steps nero-ai-reveal" role="list" aria-label="Этапы внедрения">
        <div class="vzas-step" role="listitem"><span class="n">Этап 1</span><h4>Аудит потерь заявок</h4><p>30-минутный разбор + выгрузка заявок</p></div>
        <div class="vzas-step" role="listitem"><span class="n">Этап 2</span><h4>Проектирование</h4><p>1–2 пилотных сценария, критерии hot/warm/cold</p></div>
        <div class="vzas-step" role="listitem"><span class="n">Этап 3</span><h4>База знаний</h4><p>FAQ, прайс-рамки, запреты, эскалация</p></div>
        <div class="vzas-step" role="listitem"><span class="n">Этап 4</span><h4>Интеграция</h4><p>Webhook, виджет, API CRM, уведомления</p></div>
        <div class="vzas-step" role="listitem"><span class="n">Этап 5</span><h4>Пилот ~2 недели</h4><p>Логи, ручная проверка, донастройка</p></div>
        <div class="vzas-step" role="listitem"><span class="n">Этап 6</span><h4>Обучение команды</h4><p>Резюме и подхват диалога</p></div>
        <div class="vzas-step" role="listitem"><span class="n">Этап 7</span><h4>Поддержка</h4><p>База знаний, каналы, аналитика</p></div>
      </div>
      <div class="vzas-table-wrap nero-ai-reveal">
        <table class="vzas-table">
          <caption class="screen-reader-text">Этапы внедрения AI-обработки заявок</caption>
          <thead><tr><th scope="col">Этап</th><th scope="col">Что делаем</th><th scope="col">Результат</th></tr></thead>
          <tbody>
            <tr><td>1. Аудит потерь заявок</td><td>30-минутный разбор + выгрузка заявок</td><td>Карта потерь и приоритетные сценарии</td></tr>
            <tr><td>2. Проектирование</td><td>Выбираем 1–2 пилотных сценария, фиксируем критерии hot/warm/cold</td><td>Схема «точка входа → агент → CRM»</td></tr>
            <tr><td>3. База знаний</td><td>FAQ, прайс-рамки, запретные формулировки, шаблоны эскалации</td><td>Документ, который утверждает клиент</td></tr>
            <tr><td>4. Интеграция</td><td>Webhook формы, виджет, API CRM, уведомления менеджерам</td><td>Работающая связка на тестовом контуре</td></tr>
            <tr><td>5. Пилот (около 2 недель)</td><td>Логи диалогов, ручная проверка спорных кейсов, донастройка промпта</td><td>Метрики первого ответа и качества квалификации</td></tr>
            <tr><td>6. Обучение команды</td><td>Как читать резюме, когда подхватывать диалог</td><td>Регламент для менеджеров</td></tr>
            <tr><td>7. Поддержка</td><td>Обновление базы знаний, новые каналы, аналитика</td><td>Стабильная работа и рост покрытия</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vzas-callout vzas-callout--green nero-ai-reveal">
        <p><strong>Ориентир срока — 2–4 недели на один канал.</strong> Для сравнения: в публичном кейсе интегратора для строительной компании «Арт-Комфорт» мультиканальный агент (Avito, WhatsApp, Telegram, виджет сайта) с интеграцией amoCRM был внедрён за 3 недели (<a href="https://kanun.blog/post/47-kak-ai-agent-uvelichil-potok-lidov-s-avito-v-2-3-raza-keys-art-komfort" target="_blank" rel="noopener noreferrer">кейс на kanun.blog</a>).</p>
      </div>

      <div class="vzas-split">
        <div class="nero-ai-reveal">
          <h3>Аудит потерь заявок (лид-магнит 30 минут)</h3>
          <p>Аудит — бесплатная точка входа, после которой понятно, стоит ли вообще внедрять AI и в каком канале. За 30 минут и по выгрузке заявок мы смотрим:</p>
          <ul>
            <li>какие каналы приводят заявки и сколько их в день, ночью и в выходные;</li>
            <li>среднее время первого ответа днём и в нерабочее время;</li>
            <li>долю заявок и чатов без ответа или с ответом позже 10 минут;</li>
            <li>куда физически уходит заявка с формы и кто её видит первым;</li>
            <li>какие поля CRM заполняются, а какие пустуют;</li>
            <li>как сейчас определяется «горячий» клиент и сколько времени менеджеры тратят на нецелевые обращения;</li>
            <li>сколько стоит один лид в рекламе — чтобы оценить деньги, которые уходят вместе с остывшими заявками.</li>
          </ul>
          <p><strong>На выходе:</strong> карта потерь, 1–2 сценария для пилота и предварительная оценка проекта.</p>
        </div>
        <div class="nero-ai-reveal nero-ai-delay-1">
          <h3>Пилот, обучение на FAQ и прайсе, запуск</h3>
          <p>Для запуска от вас понадобятся:</p>
          <ul>
            <li>скрипт квалификации и письменное определение «горячего» лида;</li>
            <li>прайс-рамки и FAQ — то, что можно сообщать клиенту публично;</li>
            <li>доступ к CRM (API или webhook);</li>
            <li>политика обработки ПДн и шаблон согласия;</li>
            <li>20–50 реальных обезличенных заявок или диалогов для тестов;</li>
            <li>регламент эскалации: кому уходит уведомление и за сколько минут человек подхватывает горячий лид.</li>
          </ul>
          <p>Промпт и база знаний почти никогда не бывают идеальными с первого раза. В том же кейсе «Арт-Комфорт» база знаний состояла из 60+ фрагментов, а промпт квалификации прошёл 3 итерации настройки. Поэтому пилот у нас — обязательный этап, а не формальность: мы читаем логи, разбираем ошибки и только потом расширяем сценарий.</p>
        </div>
      </div>
      <div class="vzas-card nero-ai-reveal" style="margin-top:24px">
        <h4>Стек под ключ</h4>
        <p>Оркестрация — Make.com или n8n, языковая модель — по вашей политике данных (OpenAI, Claude, YandexGPT, GigaChat), база знаний — из ваших документов, CRM-коннектор — amoCRM или Битрикс24, аналитика — цели в Яндекс Метрике и дашборд скорости ответа. Разработку и сопровождение интеграций мы ведём в Cursor с MCP-инструментами, поэтому логика сценария прозрачна и воспроизводима: вы не зависите от «чёрного ящика» конструктора.</p>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->

<?php if ( $offer_cta_url !== '' ) : ?>
      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать сценарий до запуска пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-агента полезно разобраться в промптах, human-in-the-loop и связке webhook → CRM — так быстрее согласуются критерии hot/warm/cold. Посмотрите <a href="<?php echo esc_url( $offer_cta_url ); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_external_link_attrs( $offer_cta_url ); ?>><?php echo esc_html( $offer_cta_label ); ?></a>.</p>
        </div>
      </aside>
<?php endif; ?>
    </div>
  </section>

  <section class="vzas-section" id="ceny" aria-labelledby="vzas-h2-ceny">
    <div class="vzas-cnt">
      <div class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Бюджет</span>
        <h2 id="vzas-h2-ceny">Стоимость и ориентиры по чеку для МСБ</h2>
        <p><strong>AI обработка заявок под ключ для малого и среднего бизнеса — ориентир 120–350 тыс. ₽ на старт</strong> плюс ежемесячная поддержка. Точная смета появляется после аудита.</p>
      </div>
      <div class="vzas-grid-2">
        <div class="vzas-card nero-ai-reveal">
          <h4>Что влияет на цену</h4>
          <ul>
            <li>количество каналов (только форма или форма + виджет + мессенджеры);</li>
            <li>CRM и глубина интеграции: только создание сделки или полная запись полей, задачи, смена этапов;</li>
            <li>объём базы знаний и число направлений услуг;</li>
            <li>нестандартные интеграции — например, медицинская информационная система (МИС) для клиник или телефония для обратного звонка;</li>
            <li>требования к хранению данных и выбору модели.</li>
          </ul>
        </div>
        <div class="vzas-card nero-ai-reveal nero-ai-delay-1">
          <h4>Что входит в ежемесячные расходы</h4>
          <p>Поддержка и обновление базы знаний, оплата языковой модели и сервисов автоматизации. Эти суммы зависят от объёма диалогов, поэтому мы считаем их на ваших данных после аудита, а не обещаем «от N рублей».</p>
        </div>
      </div>
      <div class="vzas-callout vzas-callout--green nero-ai-reveal">
        <p><strong>Как оценить окупаемость самостоятельно.</strong> Возьмите число заявок, которые приходят в нерабочее время или ждут ответа дольше 10 минут, умножьте на долю тех, кто уходит без ответа (по данным Телфин и OkoCRM — около половины при ожидании больше 10 минут), на вашу конверсию из заявки в продажу и на средний чек. Это и есть деньги, которые сейчас уходят конкурентам. Именно этот расчёт мы делаем на аудите и в квизе ниже.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Оценить бюджет и потери заявок на ваших цифрах</p>
          <p class="ym-cta-block__sub">Ориентир внедрения — 120–350 тыс. ₽ на старт плюс поддержка. На аудите «Аудит потерь заявок за 30 минут» посчитаем, сколько денег уходит вместе с остывшими лидами, и предложим 1–2 сценария пилота.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
            <a href="#audit-kviz" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Пройти квиз →</a>
          </div>
        </div>
      </aside>
    </div>
  </section>

  <section class="vzas-section vzas-section-alt" id="keisy" aria-labelledby="vzas-h2-keisy">
    <div class="vzas-cnt">
      <div class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Публичные примеры</span>
        <h2 id="vzas-h2-keisy">Кейсы и примеры внедрения AI обработки заявок</h2>
        <p>Ниже — публичные примеры внедрения AI от разных российских и зарубежных команд. Цифры приводятся так, как их заявили авторы кейсов; на вашем трафике результат проверяется на пилоте.</p>
      </div>

      <h3 class="nero-ai-reveal">Российские кейсы</h3>
      <div class="vzas-case-grid">
        <article class="vzas-case-card nero-ai-reveal">
          <div class="vzas-case-tag">Строительство · Тюмень</div>
          <h4>«Арт-Комфорт»</h4>
          <p>AI-агент отвечает в Avito, WhatsApp, Telegram и виджете сайта примерно за 15 секунд, квалифицирует клиента, создаёт лид в amoCRM и отправляет уведомления о горячих заявках в Telegram. Срок внедрения — 3 недели.</p>
          <a class="src" href="https://kanun.blog/post/47-kak-ai-agent-uvelichil-potok-lidov-s-avito-v-2-3-raza-keys-art-komfort" target="_blank" rel="noopener noreferrer">kanun.blog</a>
        </article>
        <article class="vzas-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vzas-case-tag">Окна · Neuron Group</div>
          <h4>Оконная компания</h4>
          <p>ИИ-менеджер на связке Tilda, Telegram, WhatsApp и сайта с amoCRM. Время ответа сократилось с 4–6 часов до 17 секунд; агент задаёт 3–5 квалифицирующих вопросов и записывает на замер или передаёт менеджеру с пометкой «клиент готов». По данным кейса, 83% ответов уходят в течение минуты, а объём обработанных заявок вырос на 210% к прежнему месяцу работы отдела — это заявление автора кейса.</p>
          <a class="src" href="https://neuron-group.ru/cases/ii-menedzher/" target="_blank" rel="noopener noreferrer">neuron-group.ru</a>
        </article>
        <article class="vzas-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vzas-case-tag">Промоборудование</div>
          <h4>ПВВК</h4>
          <p>AI на сайте, в Telegram и WhatsApp Business с amoCRM консультирует по продукту, квалифицирует обращения и разгружает команду из 7 менеджеров, работая 24/7. В кейсе приведена смета внедрения — полезный ориентир рынка.</p>
          <a class="src" href="https://aliot.tech/case-pvvk-ai-agent" target="_blank" rel="noopener noreferrer">aliot.tech</a>
        </article>
        <article class="vzas-case-card nero-ai-reveal">
          <div class="vzas-case-tag">Онлайн-школа</div>
          <h4>Ultima.school</h4>
          <p>После заявки на сайте клиент получает сообщение в WhatsApp от бота на ChatGPT, который записывает на консультацию и заполняет поля в amoCRM — сценарий «сайт → мессенджер → CRM» без роста штата при росте трафика.</p>
          <a class="src" href="https://textback.ru/kak-ii-bot-i-amocrm-dali-rost-obrabotki-lidov-v-2-raza-kejs-ultima-school/" target="_blank" rel="noopener noreferrer">textback.ru</a>
        </article>
        <article class="vzas-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vzas-case-tag">Медицина · МИС Renovatio</div>
          <h4>Сеть клиник «ВЕРАМЕД»</h4>
          <p>Чат-бот интегрирован с МИС Renovatio: запись, напоминания, перенос визита. «Конверсия в успешную запись из чат-бота за первый месяц составила 72%», — представитель клиники.</p>
          <a class="src" href="https://chatme.ai/blog/kejs-veramed-integraciya-chat-bota-s-mis-renovatio/" target="_blank" rel="noopener noreferrer">chatme.ai</a>
        </article>
        <article class="vzas-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vzas-case-tag">Медицина · Nextbot</div>
          <h4>Администратор клиники</h4>
          <p>Агент ведёт до 90% переписок в WhatsApp, работает с календарём врачей и переводит сделки на этап «Квалифицированный лид»; принципиальное ограничение — никакой диагностики, только навигация и запись.</p>
          <a class="src" href="https://www.nextbot.ru/cases/yuridicheskie-kompanii/administrator-kliniki/" target="_blank" rel="noopener noreferrer">nextbot.ru</a>
        </article>
        <article class="vzas-case-card nero-ai-reveal">
          <div class="vzas-case-tag">B2B-маршрутизация</div>
          <h4>ReqAI, «ИТ-Оптимизация»</h4>
          <p>Сбор обращений с сайта и мессенджеров, классификация, скоринг и распределение по отделам — пример для B2B-услуг с нестандартными запросами.</p>
          <a class="src" href="https://workspace.ru/cases/ii-agent-dlya-obrascheniy/" target="_blank" rel="noopener noreferrer">workspace.ru</a>
        </article>
      </div>

      <h3 class="nero-ai-reveal">Международные кейсы</h3>
      <div class="vzas-grid-2">
        <article class="vzas-case-card nero-ai-reveal">
          <div class="vzas-case-tag">Dashly</div>
          <h4>WOWInfluencer</h4>
          <p>Цепочка из четырёх AI-агентов; агент-квалификатор спрашивает роль, задачу и бюджет, проверяет критерии MQL и бронирует встречу. Вендор заявляет 82% конверсии в забронированную встречу и 66% MQL из чата, а не из формы.</p>
          <a class="src" href="https://www.dashly.io/blog/wowinfluencer-case-study/" target="_blank" rel="noopener noreferrer">dashly.io</a>
        </article>
        <article class="vzas-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vzas-case-tag">Synapsa · США</div>
          <h4>Helium SEO</h4>
          <p>AI отсекает около 90% нецелевых обращений до того, как они попадут к человеку; из 8 квалифицированных лидов 6 дошли до встречи. Вывод для дорогих ниш: фильтрация так же ценна, как скорость.</p>
          <a class="src" href="https://www.synapsa.ai/case-studies/helium-seo/" target="_blank" rel="noopener noreferrer">synapsa.ai</a>
        </article>
      </div>
      <div class="vzas-callout nero-ai-reveal">
        <p><strong>Что объединяет удачные внедрения:</strong> несколько каналов сходятся в одну CRM, у агента есть база знаний и понятные критерии квалификации, а человек подключается в заранее определённых точках.</p>
      </div>
    </div>
  </section>

  <section class="vzas-section" id="riski" aria-labelledby="vzas-h2-riski">
    <div class="vzas-cnt">
      <div class="vzas-sh nero-ai-reveal">
        <span class="vzas-eyebrow">Compliance и качество</span>
        <h2 id="vzas-h2-riski">Риски: персональные данные, хранение переписки, качество ответов</h2>
        <p>Автоматизация через AI обработку заявок — это работа с персональными данными и с репутацией компании. Конкуренты об этом часто молчат; мы закладываем эти требования в проект с первого дня.</p>
      </div>
      <div class="vzas-grid-2">
        <div class="vzas-card nero-ai-reveal">
          <h3>Персональные данные и 152-ФЗ</h3>
          <ul>
            <li><strong>Переписка в чате — это персональные данные.</strong> Имя, телефон, описание задачи клиента подпадают под 152-ФЗ, а данные граждан РФ должны записываться и храниться с использованием баз данных на территории России (ст. 18 152-ФЗ) (<a href="https://notiflow.ru/journal/152fz-chat-sajt-trebovaniya" target="_blank" rel="noopener noreferrer">notiflow.ru</a>).</li>
            <li><strong>С 1 сентября 2025 года согласие на обработку ПДн оформляется отдельным документом</strong> и отдельным действием пользователя — «галочка внутри общих условий» больше не подходит (изменения 156-ФЗ) (<a href="https://152fzpro.ru/chat-boty-i-personalnye-dannye/" target="_blank" rel="noopener noreferrer">152fzpro.ru</a>).</li>
            <li><strong>Сроки хранения и маскирование.</strong> Определяем, сколько хранится переписка, и маскируем персональные данные в технических логах.</li>
            <li><strong>Выбор модели.</strong> Если политика компании требует, используем российские модели (YandexGPT, GigaChat) или передаём в модель только обезличенный контекст.</li>
          </ul>
        </div>
        <div class="vzas-card nero-ai-reveal nero-ai-delay-1">
          <h3>Качество ответов и типовые ошибки внедрения</h3>
          <ul>
            <li><strong>«AI выдумает цену».</strong> Агент отвечает только по утверждённой базе знаний; индивидуальные цены и сроки входят в список запретных тем и уходят на эскалацию.</li>
            <li><strong>Утечка контекста между сессиями.</strong> Каждый диалог изолирован: сведения одного клиента не должны попасть в ответ другому. На эту ошибку указывают практики, которые делятся опытом внедрения агентов для приёма заявок (<a href="https://community.openai.com/t/built-an-ai-agent-for-a-clients-lead-intake-heres-what-actually-went-wrong/1377088" target="_blank" rel="noopener noreferrer">OpenAI Community</a>).</li>
            <li><strong>Хрупкий скоринг.</strong> Решается структурированным выводом с фиксированной схемой полей и порогами.</li>
            <li><strong>Размытый портрет клиента.</strong> Если бизнес сам не может сформулировать, кто его целевой клиент, агент тоже не сможет. Поэтому критерии фиксируются на этапе аудита.</li>
            <li><strong>Регулируемые темы.</strong> В медицине, юриспруденции и финансах агент маршрутизирует и записывает, но не консультирует по существу.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="vzas-section vzas-section-alt" id="faq" aria-labelledby="vzas-h2-faq">
    <div class="vzas-cnt">
      <div class="vzas-sh vzas-center nero-ai-reveal">
        <span class="vzas-eyebrow">FAQ</span>
        <h2 id="vzas-h2-faq">FAQ: частые вопросы об AI обработке заявок</h2>
      </div>
      <div class="vzas-faq nero-ai-reveal">
        <details open>
          <summary><h3>Сколько стоит AI обработка заявок?</h3></summary>
          <div class="vzas-faq-a"><p>Ориентир для малого и среднего бизнеса — 120–350 тыс. ₽ на старт плюс ежемесячная поддержка и оплата модели. Цена зависит от числа каналов, CRM, объёма базы знаний и нестандартных интеграций. Точную смету даём после аудита.</p></div>
        </details>
        <details>
          <summary><h3>Как внедрить AI обработку заявок, если у нас уже есть виджет чата или форма?</h3></summary>
          <div class="vzas-faq-a"><p>Чаще всего ничего менять не нужно: подключаемся к существующей форме через webhook, к виджету — через его API или интеграцию с CRM. Если текущий виджет не даёт доступа к сообщениям, предложим замену.</p></div>
        </details>
        <details>
          <summary><h3>Сколько длится внедрение?</h3></summary>
          <div class="vzas-faq-a"><p>2–4 недели на один канал, включая пилот около двух недель. Следующие каналы подключаются быстрее, потому что агент и база знаний уже настроены.</p></div>
        </details>
        <details>
          <summary><h3>Заменит ли AI менеджера по продажам?</h3></summary>
          <div class="vzas-faq-a"><p>Нет. AI закрывает первую линию: мгновенный ответ, уточняющие вопросы, квалификацию и запись в CRM. Переговоры, КП и закрытие сделки остаются за человеком — просто он получает уже подготовленного клиента.</p></div>
        </details>
        <details>
          <summary><h3>Не отпугнёт ли бот клиентов?</h3></summary>
          <div class="vzas-faq-a"><p>Клиентов отпугивает молчание: около половины уходят, если ждать ответа больше 10 минут. AI-агент общается свободным текстом, а не кнопками, и сразу передаёт диалог человеку, если клиент об этом просит.</p></div>
        </details>
        <details>
          <summary><h3>Что будет, если AI ошибётся?</h3></summary>
          <div class="vzas-faq-a"><p>Агент работает только по утверждённой базе знаний, у него есть список запретных тем, а спорные диалоги получают флаг ручной проверки. На пилоте мы разбираем логи и донастраиваем сценарий до запуска на весь поток.</p></div>
        </details>
        <details>
          <summary><h3>У нас уже есть Salesbot в amoCRM. Зачем AI-агент?</h3></summary>
          <div class="vzas-faq-a"><p>Salesbot хорошо работает по жёстким сценариям. AI-агент добавляет понимание свободного текста, ответы по базе знаний, скоринг лида и резюме диалога для менеджера. Их можно использовать вместе.</p></div>
        </details>
        <details>
          <summary><h3>Подходит ли AI обработка заявок для малого бизнеса?</h3></summary>
          <div class="vzas-faq-a"><p>Да, особенно если заявки приходят вечером и в выходные, а отдельной первой линии нет. Для малого бизнеса разумно начать с одного канала — например, формы на сайте с продолжением диалога в мессенджере.</p></div>
        </details>
        <details>
          <summary><h3>AI лидогенерация и нейросеть для обработки лидов — это одно и то же?</h3></summary>
          <div class="vzas-faq-a"><p>Не совсем. AI лидогенерация шире: она включает привлечение трафика и прогрев. Нейросеть для обработки лидов отвечает за то, что происходит после заявки: ответ, квалификацию и передачу в CRM. На этой странице речь именно об обработке.</p></div>
        </details>
        <details>
          <summary><h3>Как вы решаете вопрос с персональными данными?</h3></summary>
          <div class="vzas-faq-a"><p>Отдельное согласие по требованиям, действующим с 1 сентября 2025 года, хранение данных граждан РФ в России, понятные сроки хранения переписки, маскирование в логах и выбор модели под вашу политику данных.</p></div>
        </details>
      </div>
    </div>
  </section>

  <section class="vzas-section vzas-final" id="audit-kviz" aria-labelledby="vzas-h2-audit">
    <div class="vzas-cnt">
      <div class="vzas-sh vzas-center nero-ai-reveal">
        <span class="vzas-eyebrow">Аудит потерь заявок за 30 минут</span>
        <h2 id="vzas-h2-audit">Проверить, сколько заявок вы теряете</h2>
        <p>Прежде чем внедрять AI, полезно увидеть цифры. Пройдите короткий квиз — он займёт пару минут:</p>
      </div>
      <ol class="vzas-quiz nero-ai-reveal" aria-label="Вопросы квиза">
        <li>Сколько заявок с сайта приходит в среднем за день?</li>
        <li>Какая доля приходит вечером, ночью и в выходные?</li>
        <li>Через сколько минут менеджер обычно отвечает на новую заявку?</li>
        <li>Какая у вас CRM: amoCRM, Битрикс24, другая или пока нет?</li>
        <li>Какой средний чек и сколько стоит один лид из рекламы?</li>
      </ol>
      <p class="nero-ai-reveal" style="text-align:center;max-width:760px;margin:0 auto 18px">По ответам мы оценим, сколько денег уходит вместе с остывшими заявками, и пригласим на <strong>«Аудит потерь заявок за 30 минут»</strong>. На аудите вы получите:</p>
      <ul class="vzas-checklist nero-ai-reveal">
        <li>карту потерь заявок по каналам и времени суток</li>
        <li>1–2 сценария, с которых выгоднее всего начать</li>
        <li>предварительную оценку сроков и бюджета внедрения</li>
      </ul>
      <div class="vzas-final-actions nero-ai-reveal">
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
      <p class="vzas-final-note nero-ai-reveal">Аудит бесплатный и ни к чему не обязывает.</p>

      <div class="vzas-summary nero-ai-reveal">
        <p><strong>Итог.</strong> AI обработка заявок с сайта — это не замена отдела продаж, а гарантия того, что ни одна заявка не останется без ответа дольше 15 секунд. Агент отвечает 24/7, задаёт нужные вопросы, отсеивает нецелевые обращения и передаёт менеджеру горячий лид с резюме в amoCRM или Битрикс24. Nero Network внедряет такой сценарий под ключ за 2–4 недели на канал — с пилотом, учётом 152-ФЗ и прозрачной архитектурой.</p>
      </div>
    </div>
  </section>

</div>

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * vzas-night-lead-engine — Ночная диспетчерская заявок с сайта
 * Фазы: CAPTURE → DIALOG → SCORE → HANDOFF (не сборка/ракета эталона)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vzas-night-lead-canvas");
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
    outline: "#64748b",
    night: "#0b1224",
    star: "rgba(255,255,255,0.35)",
    siteBg: "#1e293b",
    siteField: "#334155",
    pulse: "rgba(121,242,255,0.55)",
    pulseHot: "rgba(34,197,94,0.75)",
    hub: "#8b5cf6",
    hubGlow: "rgba(139,92,246,0.35)",
    crm: "#0ea5e9",
    crmCard: "rgba(34,197,94,0.22)",
    tg: "#38bdf8",
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

  function NightStarfield() {
    this.stars = [];
    for (var i = 0; i < 28; i++) {
      this.stars.push({
        x: (Math.random() - 0.5) * 360,
        y: (Math.random() - 0.5) * 200 - 40,
        s: Math.random() * 1.8 + 0.4,
        tw: Math.random() * Math.PI * 2
      });
    }
  }
  NightStarfield.prototype.draw = function (ctx) {
    var self = this;
    self.stars.forEach(function (st) {
      var a = 0.35 + Math.sin(frame * 0.04 + st.tw) * 0.25;
      ctx.fillStyle = "rgba(255,255,255," + a + ")";
      ctx.beginPath();
      ctx.arc(st.x, st.y, st.s, 0, Math.PI * 2);
      ctx.fill();
    });
  };

  function WebsiteIntakePanel() {
    this.blink = 0;
  }
  WebsiteIntakePanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    drawRR(ctx, -165, -55, 92, 78, 8, C.siteBg, C.outline);
    drawRR(ctx, -158, -48, 78, 12, 4, "#0f172a", null);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("ваш-сайт.ru · заявка", -152, -40);
    drawRR(ctx, -152, -28, 68, 10, 3, C.siteField, null);
    drawRR(ctx, -152, -12, 68, 10, 3, C.siteField, null);
    drawRR(ctx, -152, 4, 40, 12, 4, C.hub, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Отправить", -132, 13);

    ctx.fillStyle = "#fbbf24";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("23:40", -158, -58);

    if (prg > 8 && prg < 28) {
      this.blink = (prg - 8) / 20;
      ctx.strokeStyle = "rgba(251,191,36," + this.blink + ")";
      ctx.lineWidth = 2;
      ctx.strokeRect(-167, -57, 96, 82);
    }
    if (prg === 9) createBubble(-120, -70, "Новая заявка с формы!", 200);
  };

  function InquiryPulseArcs() {
    this.phase = 0;
  }
  InquiryPulseArcs.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    this.phase = prg;
    var arcs = [
      { from: { x: -115, y: 5 }, ctrl: { x: -40, y: -45 }, to: { x: 0, y: -15 }, t0: 25, t1: 70 },
      { from: { x: 0, y: -15 }, ctrl: { x: 55, y: 10 }, to: { x: 120, y: -5 }, t0: 75, t1: 120 },
      { from: { x: 120, y: -5 }, ctrl: { x: 80, y: 55 }, to: { x: 0, y: 45 }, t0: 125, t1: 175 }
    ];
    arcs.forEach(function (a, idx) {
      ctx.strokeStyle = idx === 2 ? "rgba(34,197,94,0.35)" : "rgba(121,242,255,0.22)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath();
      ctx.moveTo(a.from.x, a.from.y);
      ctx.quadraticCurveTo(a.ctrl.x, a.ctrl.y, a.to.x, a.to.y);
      ctx.stroke();
      ctx.setLineDash([]);

      if (prg >= a.t0 && prg <= a.t1) {
        var t = (prg - a.t0) / (a.t1 - a.t0);
        var px = (1 - t) * (1 - t) * a.from.x + 2 * (1 - t) * t * a.ctrl.x + t * t * a.to.x;
        var py = (1 - t) * (1 - t) * a.from.y + 2 * (1 - t) * t * a.ctrl.y + t * t * a.to.y;
        ctx.fillStyle = idx === 2 ? C.pulseHot : C.pulse;
        ctx.beginPath();
        ctx.arc(px, py, 5 + Math.sin(frame * 0.2) * 1.5, 0, Math.PI * 2);
        ctx.fill();
        if (t > 0.45 && t < 0.52 && frame % 18 === 0) {
          drawRR(ctx, px - 14, py - 22, 28, 12, 4, C.bubbleBg, C.outline);
          ctx.fillStyle = C.bubbleText;
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.textAlign = "center";
          ctx.fillText("…", px, py - 13);
        }
      }
    });
    if (prg === 72) createBubble(-20, -55, "Согласие на ПДн получено", 210);
    if (prg === 128) createBubble(60, -20, "Бюджет в вилке — hot", 210);
  };

  function LeadQualificationHub() {
    this.ring = 0;
  }
  LeadQualificationHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    this.ring = (prg % 80) / 80;
    drawRR(ctx, -48, -38, 96, 88, 12, "rgba(15,23,42,0.92)", C.outline);
    ctx.strokeStyle = C.hubGlow;
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(0, -2, 34, -Math.PI / 2, -Math.PI / 2 + this.ring * Math.PI * 2);
    ctx.stroke();

    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI-хаб", 0, -18);
    ctx.fillStyle = "#c4b5fd";
    ctx.font = "7px Inter,sans-serif";
    var q = ["Услуга?", "Срок?", "Бюджет?"];
    q.forEach(function (line, i) {
      var on = prg > 40 + i * 18 && prg < 130;
      ctx.fillStyle = on ? "#bbf7d0" : "#94a3b8";
      ctx.fillText(line, 0, -2 + i * 14);
    });

    if (prg >= 130 && prg < 200) {
      var sc = Math.min(1, (prg - 130) / 40);
      drawRR(ctx, -22, 22, 44, 16, 5, "rgba(34,197,94," + (0.15 + sc * 0.25) + ")", C.agentGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("HOT · 5/5", 0, 33);
    }
    if (prg === 165) createBubble(0, -50, "Structured output готов", 220);
  };

  function CrmHandoffTerminal() {
    this.ping = 0;
  }
  CrmHandoffTerminal.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    drawRR(ctx, 118, -42, 72, 96, 10, C.siteBg, C.outline);
    ctx.fillStyle = C.crm;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM", 154, -28);

    if (prg >= 175) {
      var lift = Math.min(1, (prg - 175) / 30);
      var cardY = 8 - lift * 12;
      drawRR(ctx, 130, cardY, 48, 34, 6, C.crmCard, C.agentGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Лид #201", 154, cardY + 14);
      ctx.fillStyle = "#86efac";
      ctx.font="6px Inter,sans-serif";
      ctx.fillText("квалифицирован", 154, cardY + 24);
    }

    if (prg >= 205 && prg < 245) {
      this.ping = (prg - 205) / 40;
      drawRR(ctx, 138, 58, 32, 22, 6, "rgba(56,189,248,0.2)", C.tg);
      ctx.fillStyle = C.tg;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("TG", 154, 72);
      ctx.strokeStyle = "rgba(56,189,248," + (0.8 - this.ping * 0.7) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(154, 69, 12 + this.ping * 35, 0, Math.PI * 2);
      ctx.stroke();
      if (prg === 212) createBubble(154, 40, "Менеджер: перезвонить!", 200);
    }
    if (prg > 248 && prg < 252) {
      /* сброс цикла — мягкая вспышка «следующая заявка» */
      ctx.fillStyle = "rgba(121,242,255,0.08)";
      ctx.fillRect(-180, -80, 360, 160);
    }
  };

  function WarmColdTagSorter() {
    this.warmX = 0;
  }
  WarmColdTagSorter.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 260;
    if (prg < 100) return;
    var tags = [
      { label: "warm", color: "#fbbf24", x: -175, y: 52 },
      { label: "cold", color: "#94a3b8", x: -175, y: 72 }
    ];
    tags.forEach(function (tg) {
      drawRR(ctx, tg.x, tg.y, 36, 14, 4, "rgba(255,255,255,0.06)", tg.color);
      ctx.fillStyle = tg.color;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(tg.label, tg.x + 18, tg.y + 10);
    });
    if (prg > 110 && prg < 150) {
      this.warmX = -140 + ((prg - 110) / 40) * 25;
      drawRR(ctx, this.warmX, 50, 28, 12, 3, "rgba(251,191,36,0.2)", "#fbbf24");
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
    var prg = (frame * 0.045) % 260;
    var targets = {
      "1_architect": { x: -95, y: 78 },
      "2_seo": { x: -35, y: 88 },
      "3_coder": { x: 25, y: 88 },
      "4_designer": { x: 85, y: 78 },
      "5_deployer": { x: 145, y: 70 }
    };
    var tgt = targets[this.role] || { x: 0, y: 80 };
    var isMoving = false;
    var faceDir = 1;

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
    }

    if (!isMoving && frame % 240 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
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

  var bubbles = [];
  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  var entities = [
    new NightStarfield(),
    new WebsiteIntakePanel(),
    new InquiryPulseArcs(),
    new WarmColdTagSorter(),
    new LeadQualificationHub(),
    new CrmHandoffTerminal(),
    new Agent(-150, 105, C.agentYellow, "1_architect", 20, [
      "Webhook формы настроен", "ПДн — отдельное согласие", "Канал: чат + форма"
    ]),
    new Agent(-80, 112, C.agentGreen, "2_seo", 55, [
      "Ночной лид не остывает", "Уточняем услугу и город", "Не обещаем цену вне FAQ"
    ]),
    new Agent(-10, 115, C.agentBlue, "3_coder", 95, [
      "JSON: phone, budget, score", "tool: create_deal", "human_review на спорном"
    ]),
    new Agent(60, 112, C.agentPink, "4_designer", 135, [
      "Тег hot в amoCRM", "Резюме на 4 предложения", "Warm — задача на дожим"
    ]),
    new Agent(130, 105, C.agentPurple, "5_deployer", 178, [
      "201 Created в CRM", "Задача «перезвонить»", "Пинг в Telegram duty"
    ])
  ];

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    bubbles = bubbles.filter(function (b) {
      b.life--;
      if (b.life <= 0) return false;
      var alpha = Math.min(1, b.life / b.maxLife);
      ctx.globalAlpha = alpha;
      var tw = Math.min(120, ctx.measureText ? 90 : 90);
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      var short = b.text.length > 22 ? b.text.slice(0, 20) + "…" : b.text;
      ctx.fillText(short, b.x, b.y - 8);
      ctx.globalAlpha = 1;
      return true;
    });

    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>

<script>
(function () {
  'use strict';
  var root = document.querySelector('.vzas-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if (!('IntersectionObserver' in window)) {
    items.forEach(function (el) { el.classList.add('nero-ai-active'); });
    return;
  }
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('nero-ai-active');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
  items.forEach(function (el) { observer.observe(el); });
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
