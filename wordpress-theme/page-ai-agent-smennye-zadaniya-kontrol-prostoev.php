<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев
 * Description: SEO-лендинг — внедрение AI-агента для сменных заданий, контроля простоев и отчётности руководителю.
 */

$page_seo_title       = 'AI-агент для производства: контроль простоев и сменные задания';
$page_seo_description = 'Внедрение AI-агента для сменных заданий и контроля простоев: сбор данных по смене, фиксация отклонений, отчёт руководителю. Кейсы, цены, карта потерь.';

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

$brand = get_bloginfo( 'name' ) ?: ( getenv( 'SITE_BRAND' ) ?: '' ); // pragma: allowlist secret

$nero_ai_header_links = [
	[ 'label' => 'Проблема', 'href' => '#problema' ],
	[ 'label' => 'Как работает', 'href' => '#kak-rabotaet' ],
	[ 'label' => 'Внедрение', 'href' => '#etapy' ],
	[ 'label' => 'Интеграции', 'href' => '#integracii' ],
	[ 'label' => 'Стоимость', 'href' => '#ceny' ],
	[ 'label' => 'Кейсы', 'href' => '#keisy' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'Как работает';
$secondary_cta_url   = '#kak-rabotaet';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if ( ! is_readable( $nero_ai_floating ) ) {
	require dirname( __DIR__ ) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
	require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles( [ 'nero-ai-longread-ui-compat.css' ] ); ?>

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

.asz-hero-shift {
  min-height: min(980px, calc(100dvh - 1px));
  position: relative;
}

.asz-content{
  --asz-bg:#050711;--asz-bg2:#0a0e1c;
  --asz-text:#e6edf7;--asz-muted:#9aa8bd;--asz-soft:#c7d2e5;--asz-heading:#fff;
  --asz-border:rgba(255,255,255,.10);
  --asz-accent:#f5c518;--asz-violet:#8b5cf6;--asz-green:#22c55e;--asz-red:#ef4444;
  --asz-container:1220px;--asz-r:18px;--asz-r-lg:24px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--asz-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
}
.asz-content *,.asz-content *::before,.asz-content *::after{box-sizing:border-box;}
.asz-content a{color:inherit;}
.asz-content p{color:var(--asz-muted);line-height:1.72;margin:0 0 1em;}
.asz-content h2,.asz-content h3{color:var(--asz-heading);letter-spacing:-.04em;margin:0 0 .7em;}
.asz-content strong{color:var(--asz-soft);}
.asz-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.asz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--asz-muted);font-size:14.5px;}
.asz-content ul li::before{content:'›';position:absolute;left:0;color:var(--asz-accent);font-weight:700;}
.asz-cnt{width:min(var(--asz-container),calc(100% - 40px));margin:0 auto;}
.asz-section{padding:clamp(56px,7vw,96px) 0;}
.asz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.03),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.asz-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.asz-sh.asz-left{margin-left:0;text-align:left;}
.asz-sh h2{font-size:clamp(26px,3.8vw,44px);line-height:1.08;}
.asz-sh p{font-size:clamp(15px,1.5vw,17px);}
.asz-eyebrow{display:inline-flex;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--asz-accent);margin-bottom:14px;}
.asz-intro{padding:clamp(36px,5vw,64px) 0;border-bottom:1px solid rgba(255,255,255,.06);}
.asz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:center;}
.asz-intro-text p{font-size:15px;line-height:1.78;}
.asz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.asz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:14px;text-align:center;}
.asz-kpi-card .kv{font-size:22px;font-weight:900;color:#fff;}
.asz-kpi-card .kl{font-size:11px;color:var(--asz-muted);}
.asz-callout-pain{display:flex;gap:20px;align-items:center;padding:24px 28px;margin-bottom:32px;border-radius:16px;background:rgba(239,68,68,.08);border-left:4px solid var(--asz-red);}
.asz-callout-num{font-size:48px;font-weight:900;color:var(--asz-red);line-height:1;}
.asz-callout-src{display:block;font-size:12px;color:var(--asz-muted);margin-top:6px;}
.asz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.asz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.asz-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:var(--asz-r-lg);padding:24px;}
.asz-card h3{font-size:17px;}
.asz-card p{font-size:14.5px;}
.asz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.asz-table{width:100%;border-collapse:collapse;font-size:14px;}
.asz-table th{padding:12px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--asz-accent);font-weight:700;}
.asz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--asz-text);}
.asz-timeline{position:relative;padding-left:40px;max-width:720px;}
.asz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--asz-accent),var(--asz-violet));opacity:.35;}
.asz-tl-item{position:relative;margin-bottom:28px;}
.asz-tl-dot{position:absolute;left:-32px;top:4px;width:14px;height:14px;border-radius:50%;background:var(--asz-accent);}
.asz-steps{display:flex;flex-direction:column;gap:14px;max-width:720px;}
.asz-step{display:flex;gap:16px;align-items:flex-start;padding:16px 20px;background:rgba(255,255,255,.04);border-radius:14px;border:1px solid rgba(255,255,255,.08);}
.asz-step-n{flex-shrink:0;width:32px;height:32px;border-radius:50%;background:var(--asz-accent);color:#1a1200;font-weight:900;display:flex;align-items:center;justify-content:center;font-size:14px;}
.asz-chips{display:flex;flex-wrap:wrap;gap:10px;}
.asz-chip{padding:8px 16px;border-radius:999px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);font-size:13px;font-weight:600;color:var(--asz-soft);}
.asz-case-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.asz-case-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:24px;}
.asz-case-tag{font-size:11px;font-weight:700;text-transform:uppercase;color:var(--asz-green);margin-bottom:8px;}
.asz-gartner{display:flex;gap:28px;align-items:flex-start;padding:28px 32px;border-radius:20px;background:rgba(139,92,246,.08);border:1px solid rgba(139,92,246,.2);}
.asz-gartner-num{font-size:clamp(48px,8vw,72px);font-weight:900;color:var(--asz-violet);line-height:1;flex-shrink:0;}
.asz-quote{margin:12px 0 0;padding-left:16px;border-left:3px solid var(--asz-violet);font-style:italic;color:var(--asz-muted);font-size:14px;}
.asz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.asz-faq-item{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.asz-faq-q{padding:18px 22px;font-weight:700;color:#fff;cursor:pointer;list-style:none;}
.asz-faq-a{padding:0 22px 18px;font-size:14.5px;}
.asz-btn-row{display:flex;flex-wrap:wrap;gap:12px;}
@media(max-width:900px){.asz-intro-grid,.asz-grid-2,.asz-case-grid{grid-template-columns:1fr;}}
@media(max-width:768px){.asz-grid-3{grid-template-columns:1fr;}}
@media(max-width:600px){.asz-gartner{flex-direction:column;}}
.asz-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.asz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--asz-accent),var(--asz-violet));}
.asz-intro-text p{text-align:left!important;}
.asz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.asz-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.asz-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid rgba(255,255,255,.10);border-radius:999px;font-size:13px;font-weight:600;color:var(--asz-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none;}
.asz-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--asz-accent);background:rgba(245,197,24,.08);}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--primary{text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--asz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub,.ym-cta-block--dual .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-link--accent{color:var(--asz-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.asz-faq-q{list-style:none;}
.asz-faq-q::-webkit-details-marker{display:none;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}


</style>

<main id="primary" class="site-main nero-ai-home-page asz-page ai-agent-smennye-zadaniya-kontrol-prostoev-page" role="main" tabindex="-1">

<section class="nero-ai-hero asz-hero-shift" id="hero" aria-labelledby="asz-hero-title">
<style>
/* ── Hero asz: самодостаточные стили (без CSS темы Kadence) ── */
.asz-hero-shift {
  --asz-gold: #f5c518;
  --asz-violet: #8b5cf6;
  --asz-green: #22c55e;
  --asz-red: #ef4444;
  --asz-orange: #f97316;
  --asz-text: #e6edf7;
  --asz-muted: #9aa8bd;
  --asz-soft: #c7d2e5;
  --asz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.asz-hero-shift::before {
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
.asz-hero-shift::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .10), transparent 66%);
  filter: blur(8px);
  animation: aszHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aszHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.asz-hero-shift .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.asz-hero-shift .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.asz-hero-shift .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.asz-hero-shift .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--asz-gold) 38%, var(--asz-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.asz-hero-shift .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--asz-gold) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.asz-hero-shift .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--asz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.asz-hero-shift .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.asz-hero-shift .nero-ai-badge {
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
.asz-hero-shift .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.asz-hero-shift .nero-ai-btn {
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
.asz-hero-shift .nero-ai-btn:hover { transform: translateY(-2px); }
.asz-hero-shift .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--asz-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.asz-hero-shift .nero-ai-btn-secondary {
  color: var(--asz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.asz-hero-shift .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--asz-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.asz-hero-shift .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.asz-hero-shift .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.asz-hero-shift .nero-ai-dots { display: flex; gap: 7px; }
.asz-hero-shift .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.asz-hero-shift .nero-ai-dot:nth-child(1) { background: #fb7185; }
.asz-hero-shift .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.asz-hero-shift .nero-ai-dot:nth-child(3) { background: #34d399; }
.asz-hero-shift .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.asz-hero-shift .nero-ai-window-body { padding: 16px; }
.asz-hero-shift .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.asz-hero-shift .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.asz-hero-shift .nero-ai-live-pill {
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
.asz-hero-shift .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aszPulse 1.6s infinite;
}
@keyframes aszPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.asz-hero-shift .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.asz-hero-shift .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.asz-hero-shift .nero-ai-metric span {
  display: block;
  color: var(--asz-muted);
  font-size: 11px;
  font-weight: 700;
}
.asz-hero-shift .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.asz-hero-shift .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.asz-hero-shift .nero-ai-metric--alert strong { color: var(--asz-orange); }
.asz-hero-shift .asz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(245, 197, 24, 0.16);
  background: radial-gradient(ellipse at 50% 40%, rgba(34,197,94,.06), rgba(6,10,24,.94) 72%);
}
.asz-hero-shift #asz-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.asz-hero-shift .nero-ai-task-stream { display: grid; gap: 8px; }
.asz-hero-shift .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.asz-hero-shift .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(245,197,24,.12);
  color: var(--asz-gold);
  font-size: 11px;
  font-weight: 800;
}
.asz-hero-shift .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.asz-hero-shift .nero-ai-task span {
  color: var(--asz-muted);
  font-size: 11px;
}
.asz-hero-shift .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.asz-hero-shift .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.asz-hero-shift .nero-ai-status--red {
  background: rgba(239,68,68,.14);
  color: #fecaca;
}
@media (max-width: 1100px) {
  .asz-hero-shift .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .asz-hero-shift .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .asz-hero-shift .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .asz-hero-shift .nero-ai-window-body { padding: 12px; }
  .asz-hero-shift .nero-ai-task { grid-template-columns: 28px 1fr; }
  .asz-hero-shift .nero-ai-status { grid-column: 2; width: fit-content; }
  .asz-hero-shift .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · AI для производства</p>
      <h1 id="asz-hero-title">AI-агент для сменных заданий и <span class="nero-ai-gradient-text">контроля простоев</span>: внедрение под ключ</h1>
      <p class="nero-ai-hero-lead">AI собирает данные по смене, фиксирует отклонения и формирует отчёт руководителю — без ручного учёта простоев и опоздавшей фиксации потерь</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Telegram для мастера</li>
        <li class="nero-ai-badge">1С / ERP</li>
        <li class="nero-ai-badge">Карта потерь</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-агента сменного контроля">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>смена №2 · демо AI-агента</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>План смены</span>
              <strong>87%</strong>
              <small>3 линии · 12 заказов</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--alert">
              <span>Простои сегодня</span>
              <strong>42 мин</strong>
              <small>−18% к прошлой смене</small>
            </div>
            <div class="nero-ai-metric">
              <span>Кодов «прочее»</span>
              <strong>6%</strong>
              <small>цель &lt; 10%</small>
            </div>
            <div class="nero-ai-metric">
              <span>Отчёт директору</span>
              <strong>18:05</strong>
              <small>автосводка смены</small>
            </div>
          </div>

          <div class="asz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="asz-hero-canvas" role="img" aria-label="Анимация: сменное задание на линии, фиксация простоя и отчёт руководителю"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📋</span>
              <div><strong>Сменное задание обновлено</strong><span>Участок 1: приоритет заказа #847</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⏸</span>
              <div><strong>Простой: ожидание материала</strong><span>Участок 2 · 23 мин · код M-04</span></div>
              <span class="nero-ai-status nero-ai-status--red">алерт</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Алерт мастеру</strong><span>агент предложил · мастер подтвердил</span></div>
              <span class="nero-ai-status nero-ai-status--amber">HITL</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📊</span>
              <div><strong>Сводка смены готова</strong><span>OEE-lite → Telegram директору</span></div>
              <span class="nero-ai-status">отправлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * asz-hero-engine — «Диспетчерская сменного цеха»
 * Мир: WorkOrderRail → ShiftCommandTower → DowntimeBeacon → MasterConfirmPad → TelegramPulseNotifier
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("asz-hero-canvas");
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
    outline: "#94a3b8",
    floor: "rgba(30,41,59,0.55)",
    rail: "#475569",
    railGlow: "#f5c518",
    towerBase: "#1e293b",
    towerScreen: "#0f172a",
    cardAmber: "#fef3c7",
    cardGreen: "#d1fae5",
    cardBlue: "#dbeafe",
    beaconRed: "#ef4444",
    beaconOrange: "#f97316",
    padScreen: "#1e293b",
    oeeGreen: "#22c55e",
    oeeAmber: "#f59e0b",
    tgBlue: "#38bdf8",
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

  function drawWorkCenter(ctx, x, y, label, active) {
    drawRR(ctx, x - 28, y - 18, 56, 36, 6, active ? "rgba(34,197,94,0.15)" : C.floor, C.outline);
    drawRR(ctx, x - 20, y - 12, 40, 22, 4, "rgba(255,255,255,0.06)", null);
    ctx.fillStyle = active ? C.oeeGreen : "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(label, x, y + 14);
  }

  /* Горизонтальный рельс тележек заказов — вместо Conveyor */
  function WorkOrderRail() {
    this.carts = [
      { offset: 0, color: C.cardAmber, label: "#847" },
      { offset: 90, color: C.cardGreen, label: "#902" },
      { offset: 180, color: C.cardBlue, label: "#711" }
    ];
  }
  WorkOrderRail.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    drawRR(ctx, -175, 42, 350, 8, 4, C.rail, C.outline);
    for (var i = -160; i < 180; i += 28) {
      ctx.fillStyle = C.railGlow;
      ctx.globalAlpha = 0.25 + Math.sin(frame * 0.08 + i) * 0.1;
      ctx.fillRect(i, 44, 6, 4);
      ctx.globalAlpha = 1;
    }
    this.carts.forEach(function (cart) {
      var t = ((frame * 0.35 + cart.offset) % 200) / 200;
      var dx = -155 + t * 310;
      drawRR(ctx, dx - 10, 28, 20, 14, 3, cart.color, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(cart.label, dx, 38);
    });
    drawWorkCenter(ctx, -100, -8, "Уч.1", prg < 80 || prg > 200);
    drawWorkCenter(ctx, 0, -12, "Уч.2", prg >= 80 && prg < 155);
    drawWorkCenter(ctx, 100, -8, "Уч.3", prg >= 155);
  };

  /* Центральная башня сменного задания — вместо WebsiteTerminal */
  function ShiftCommandTower() {
    this.queue = 0;
  }
  ShiftCommandTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    drawRR(ctx, -42, -72, 84, 100, 8, C.towerBase, C.outline);
    drawRR(ctx, -36, -66, 72, 18, [6, 6, 0, 0], C.railGlow, null);
    ctx.fillStyle = "#1a1200";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("СМЕНА №2", 0, -54);

    drawRR(ctx, -34, -44, 68, 58, 5, C.towerScreen, C.outline);

    if (prg < 55) {
      var rows = ["Заказ #847", "Переналадка", "Сборка"];
      rows.forEach(function (r, i) {
        var on = prg > 8 + i * 12;
        drawRR(ctx, -30, -38 + i * 16, 60, 11, 2, on ? "rgba(245,197,24,0.2)" : "rgba(255,255,255,0.05)", null);
        if (on) {
          ctx.fillStyle = "#fde68a";
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.textAlign = "left";
          ctx.fillText(r, -26, -30 + i * 16);
        }
      });
    } else if (prg < 155) {
      ctx.fillStyle = C.beaconOrange;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ПРОСТОЙ", 0, -18);
      ctx.fillStyle = "#fecaca";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("ожидание материала", 0, -6);
      ctx.fillStyle = "#f97316";
      ctx.font = "bold 14px Inter,sans-serif";
      ctx.fillText("23 мин", 0, 10);
    } else {
      drawRR(ctx, -28, -36, 56, 40, 4, "rgba(34,197,94,0.15)", C.oeeGreen);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Сводка", 0, -22);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.fillText("OEE 87%", 0, -6);
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillStyle = "#94a3b8";
      ctx.fillText("простои 42 мин", 0, 6);
    }
  };

  /* Маяк простоя на узле */
  function DowntimeBeacon() {
    this.blink = 0;
  }
  DowntimeBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 75 || prg >= 160) return;
    this.blink = Math.sin(frame * 0.25) * 0.5 + 0.5;
    ctx.save();
    ctx.globalAlpha = 0.35 + this.blink * 0.45;
    ctx.fillStyle = C.beaconRed;
    ctx.beginPath();
    ctx.arc(0, -28, 14 + this.blink * 6, 0, Math.PI * 2);
    ctx.fill();
    ctx.globalAlpha = 1;
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("!", 0, -25);
    ctx.restore();
  };

  /* Планшет мастера — подтверждение кода */
  function MasterConfirmPad() {
    this.code = "M-04";
  }
  MasterConfirmPad.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 95 || prg >= 175) return;
    drawRR(ctx, 118, -20, 52, 68, 8, C.padScreen, C.outline);
    drawRR(ctx, 124, -14, 40, 8, 3, "rgba(255,255,255,0.1)", null);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Telegram", 144, -7);

    if (prg > 108) {
      drawRR(ctx, 128, 2, 32, 14, 3, "rgba(239,68,68,0.25)", C.beaconRed);
      ctx.fillStyle = "#fecaca";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText(this.code, 144, 12);
    }
    if (prg > 135) {
      drawRR(ctx, 128, 22, 32, 14, 3, "rgba(34,197,94,0.25)", C.oeeGreen);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("✓ OK", 144, 32);
    }
  };

  /* Дуговой OEE-индикатор */
  function OeeArcMeter() {
    this.pct = 0.87;
  }
  OeeArcMeter.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    var cxm = -130, cym = 18, r = 22;
    ctx.strokeStyle = "rgba(255,255,255,0.08)";
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(cxm, cym, r, Math.PI * 0.75, Math.PI * 2.25);
    ctx.stroke();

    var fillPrg = prg < 155 ? 0.72 + Math.sin(frame * 0.06) * 0.05 : 0.87;
    ctx.strokeStyle = prg >= 155 ? C.oeeGreen : C.oeeAmber;
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(cxm, cym, r, Math.PI * 0.75, Math.PI * 0.75 + Math.PI * 1.5 * fillPrg);
    ctx.stroke();

    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(fillPrg * 100) + "%", cxm, cym + 4);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("OEE", cxm, cym + 14);
  };

  /* Полоска Pareto потерь */
  function LossParetoStrip() {
    this.bars = [0.42, 0.28, 0.18];
  }
  LossParetoStrip.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 165) return;
    var labels = ["Матер.", "Перен.", "Проч."];
    var colors = [C.beaconOrange, C.railGlow, "#64748b"];
    labels.forEach(function (lb, i) {
      var bw = this.bars[i] * 70;
      var by = 58 + i * 12;
      drawRR(ctx, -130, by, 70, 8, 2, "rgba(255,255,255,0.06)", null);
      if (prg > 170 + i * 8) {
        drawRR(ctx, -130, by, bw, 8, 2, colors[i], null);
        ctx.fillStyle = "#cbd5e1";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(lb, -128, by + 6);
      }
    }, this);
  };

  /* Telegram-пульс — финал: отчёт директору */
  function TelegramPulseNotifier() {
    this.wave = 0;
  }
  TelegramPulseNotifier.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 195) return;
    this.wave = (prg - 195) / 45;
    var alpha = prg < 225 ? this.wave : 1 - (prg - 225) / 15;
    ctx.save();
    ctx.globalAlpha = Math.max(0, alpha);
    drawRR(ctx, 108, 48, 58, 28, 8, "rgba(56,189,248,0.2)", C.tgBlue);
    ctx.fillStyle = C.tgBlue;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("→ Директору", 137, 58);
    ctx.fillText("18:05", 137, 68);
    for (var w = 0; w < 3; w++) {
      ctx.strokeStyle = "rgba(56,189,248," + (0.4 - w * 0.12) + ")";
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(120, 62, 8 + w * 6 + this.wave * 10, 0, Math.PI * 2);
      ctx.stroke();
    }
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
    var prg = (frame * 0.04) % 240;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -55, y: -35 },
      "2_seo": { x: 115, y: 5 },
      "3_coder": { x: -120, y: 55 },
      "4_designer": { x: 0, y: 55 },
      "5_deployer": { x: 130, y: 55 }
    };
    var tgt = targets[this.role] || { x: 0, y: 40 };

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
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 16) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 16) / 6);
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
  var rail = new WorkOrderRail();
  var tower = new ShiftCommandTower();
  var beacon = new DowntimeBeacon();
  var pad = new MasterConfirmPad();
  var oee = new OeeArcMeter();
  var pareto = new LossParetoStrip();
  var telegram = new TelegramPulseNotifier();

  entities.push(oee);
  entities.push(rail);
  entities.push(tower);
  entities.push(beacon);
  entities.push(pad);
  entities.push(pareto);
  entities.push(telegram);
  entities.push(new Agent(-145, 72, C.agentYellow, "1_architect", 12, [
    "План смены из 1С", "Приоритет заказа #847", "Матрица переналадок"
  ]));
  entities.push(new Agent(-70, 78, C.agentGreen, "2_seo", 58, [
    "Код M-04: материал", "«Прочее» — 6%", "Классификатор 8 кодов"
  ]));
  entities.push(new Agent(5, 80, C.agentBlue, "3_coder", 102, [
    "Webhook 1С → агент", "Сравнение план/факт", "Алерт каждые 15 мин"
  ]));
  entities.push(new Agent(78, 76, C.agentPink, "4_designer", 148, [
    "Мастер подтвердил", "Human-in-the-loop", "10 сек на запись"
  ]));
  entities.push(new Agent(148, 70, C.agentPurple, "5_deployer", 192, [
    "Сводка в Telegram", "Отчёт директору 18:05", "Карта потерь PDF"
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

    var prg = (frame * 0.04) % 240;
    if (prg >= 14 && prg < 14.05) createBubble(-50, -80, "1. Сменное задание выдано");
    if (prg >= 88 && prg < 88.05) createBubble(0, -50, "2. Простой на участке 2");
    if (prg >= 128 && prg < 128.05) createBubble(140, -10, "3. Мастер подтвердил код");
    if (prg >= 178 && prg < 178.05) createBubble(-20, 20, "4. Pareto топ-3 потерь");
    if (prg >= 210 && prg < 210.05) createBubble(130, 55, "5. Отчёт → директору");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.railGlow);
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

<div class="asz-content">

  <section class="asz-section asz-intro" id="intro" aria-label="Введение">
    <div class="asz-cnt">
      <div class="asz-intro-grid nero-ai-reveal">
        <div class="asz-intro-text">
          <p class="asz-eyebrow">Лонгрид · ai производство контроль</p>
          <p><strong>Коротко:</strong> AI-агент для производства — это операционный слой между 1С/ERP, цехом и руководителем. Он формирует сменные задания, собирает факт по смене, фиксирует простои в момент события и отправляет отчёт директору — без ручного Excel и опоздавшей фиксации потерь. Внедрение <strong>ai производство контроль</strong> под ключ для малого цеха: мебель, пищевая линия, сборочный участок 20–300 человек.</p>
        </div>
        <div class="asz-intro-kpi" aria-label="Ключевые метрики смены">
          <div class="asz-kpi-card"><div class="kv">8–12</div><div class="kl">кодов простоя на линию</div></div>
          <div class="asz-kpi-card"><div class="kv">15–30</div><div class="kl">мин цикл план vs факт</div></div>
          <div class="asz-kpi-card"><div class="kv">4–6</div><div class="kl">недель пилот</div></div>
          <div class="asz-kpi-card"><div class="kv">500к–2М ₽</div><div class="kl">ориентир чека</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="asz-toc-outer">
    <div class="asz-cnt">
      <nav class="asz-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#problema">Проблема</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#smennye-zadaniya">Сменные задания</a>
        <a href="#karta-poter">Контроль простоев</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#agentic-ai">Agentic AI</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="asz-section" id="problema">
    <div class="asz-cnt">
      <div class="asz-sh asz-left nero-ai-reveal">
        <span class="asz-eyebrow">Боль производства</span>
        <h2>Почему на производстве простои фиксируются поздно</h2>
        <p>На большинстве площадок, с которыми мы работаем, <strong>ai контроль простоев</strong> начинается не с нейросети, а с честного ответа: <em>когда вы узнали о вчерашнем простое?</em> Чаще всего — утром следующей смены.</p>
      </div>

      <aside class="asz-callout-pain nero-ai-reveal" aria-label="Ключевая боль">
        <div class="asz-callout-num">4</div>
        <div>
          <strong>рабочих дня</strong> на месячный OEE-отчёт при ручном учёте — пока цифры собраны, решения уже приняты «на глаз»
          <span class="asz-callout-src">по методологии ручного OEE, <a href="https://isu-it.ru/programmnye-produkty/oee/" target="_blank" rel="noopener noreferrer">ISU</a></span>
        </div>
      </aside>

      <div class="asz-grid-2 nero-ai-reveal">
        <div class="asz-card">
          <h3 id="problema-ruchnye-zadaniya">Ручные сменные задания и потери в Excel/журналах</h3>
          <ul>
            <li>план на смену живёт в Excel, WhatsApp или на бумажном листе у станка;</li>
            <li>при срочном заказе мастер переписывает очередь вручную — операторы видят разные версии;</li>
            <li><strong>учёт простоев на производстве</strong> ведётся постфактум: «простой 40 минут» появляется вечером или на следующий день;</li>
            <li>код причины — «прочее» в 10–15% записей, потому что классификатора нет или он слишком сложный.</li>
          </ul>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <h3 id="problema-skrytye-prostoi">Скрытые простои: мебель, пищевое, малые цеха</h3>
          <p><strong>Скрытый простой</strong> — не только поломка станка. В мебельном цехе — ожидание фурнитуры. На линии розлива — смена формата без фиксации микропростоя. На сборке — переналадка, которую никто не записал.</p>
          <p>Малые цеха редко покупают полноценную MES. В итоге <strong>ai для производства</strong> востребован там, где 1–5 линий, 20–80 человек на смену — но задачи меняются вручную, простои фиксируются поздно.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="asz-section asz-section-alt" id="kak-rabotaet">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Как работает</span>
        <h2>Как AI-агент контролирует смену и простои</h2>
        <p><strong>Определение:</strong> AI-агент для сменных заданий и контроля простоев — не чат-бот на сайте, а система, которая читает план из учётной системы, выдаёт задание мастеру, принимает факт и простои, классифицирует отклонения и готовит сводку руководителю. Принцип Nero Network: <strong>агент с проверкой результата</strong>, а не автономная фабрика без человека.</p>
      </div>

      <div class="asz-grid-3 nero-ai-reveal">
        <div class="asz-card">
          <h3 id="kak-sbor-dannyh">Сбор данных по смене в реальном времени</h3>
          <p>Агент получает план смены из 1С, ERP или таблицы. В смене мастер отмечает старт/стоп операций, простой с кодом причины (8–12 кодов на линию). Интерфейс — <strong>Telegram-бот или планшет мастера</strong>: 10 секунд на запись простоя.</p>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <h3 id="kak-alerty">Фиксация отклонений и алерты руководителю</h3>
          <p>Каждые 15–30 минут агент сравнивает план и факт. При аномалии — push мастеру: «Участок 2: простой 23 мин, код „ожидание материала“». Логика agentic-подхода <a href="https://www.bosch.com/stories/agentic-ai-manufacturing-production/" target="_blank" rel="noopener noreferrer">Bosch Shopfloor Agent</a>: агент помогает, <strong>не заменяя</strong> мастера.</p>
        </div>
        <div class="asz-card nero-ai-delay-2">
          <h3 id="kak-otchet">Отчёт по смене без ручного ввода</h3>
          <p>В конце смены агент формирует OEE-lite: доступность, простои по кодам, отставание от плана. Отчёт уходит в Telegram, email или PDF — как в проекте ФосАгро «AIХимик» (<a href="https://www.phosagro.ru/press/company/proekt-fosagro-po-vnedreniyu-ii-agentov-v-sistemu-upravleniya-proizvodstvom-otmechen-nagradoy-nezavi/" target="_blank" rel="noopener noreferrer">пресс-релиз, 2026</a>).</p>
        </div>
      </div>

      <!-- === БОРИС CANVAS: после карточек #kak-rabotaet === -->
      <section id="ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block" class="asz-boris-root" aria-label="Анимация: смена в реальном времени — мониторинг линии и подтверждение мастера">
<style>
/* === БОРИС: prefix asz-b-, scoped внутри #ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block === */
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block.asz-boris-root{
  margin:40px 0 0;
  padding:0;
  background:transparent;
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.12),0 0 0 1px rgba(148,163,184,.2);
  min-height:480px;
}
@media(max-width:1023px){
  #ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-lft{
  padding:36px 32px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
  background:#f8fafc;
}
@media(max-width:1023px){
  #ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:28px 22px;
  }
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#b45309;margin:0 0 12px;
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-ey::before{
  content:'';width:18px;height:2px;background:#f5c518;border-radius:1px;
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-h3{
  font-size:clamp(19px,2.2vw,24px);font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 16px;
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-ul{
  list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px;
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(245,197,24,.15);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#b45309;font-style:normal;margin-top:1px;
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-pl-g{background:rgba(34,197,94,.1);color:#15803d;border:1.5px solid rgba(34,197,94,.25);}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-pl-r{background:rgba(239,68,68,.08);color:#b91c1c;border:1.5px solid rgba(239,68,68,.22);}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-pl-a{background:rgba(245,197,24,.12);color:#92400e;border:1.5px solid rgba(245,197,24,.3);}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-foot{
  font-size:13px;color:#64748b;font-style:italic;margin:0;
}
#ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-rgt{
  position:relative;
  background:linear-gradient(135deg,#0a0e1c 0%,#111827 40%,#1a1f35 100%);
  min-height:420px;overflow:hidden;
}
@media(max-width:1023px){
  #ai-agent-smennye-zadaniya-kontrol-prostoev-boris-block .asz-b-rgt{min-height:360px;}
}
#asz-shift-monitor-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

        <div class="asz-b-card nero-ai-reveal">
          <div class="asz-b-lft">
            <span class="asz-b-ey">Мониторинг смены</span>
            <h3 class="asz-b-h3">Смена в реальном времени: линия, простой и подтверждение мастера</h3>
            <ul class="asz-b-ul">
              <li><span class="asz-b-ic">1</span>Три рабочих центра на линии — план vs факт каждые 15 мин</li>
              <li><span class="asz-b-ic">2</span>Агент фиксирует простой и предлагает код причины</li>
              <li><span class="asz-b-ic">3</span>Мастер подтверждает или корректирует — human-in-the-loop</li>
              <li><span class="asz-b-ic">✓</span>Алерт директору только после подтверждения классификации</li>
            </ul>
            <div class="asz-b-pills">
              <span class="asz-b-pl asz-b-pl-g">смена в норме</span>
              <span class="asz-b-pl asz-b-pl-r">простой 23 мин</span>
              <span class="asz-b-pl asz-b-pl-a">ожидание материала</span>
            </div>
            <p class="asz-b-foot">Дальше — сменные задания без хаоса: от Excel к AI →</p>
          </div>
          <div class="asz-b-rgt">
            <canvas id="asz-shift-monitor-canvas" role="img" aria-label="Анимация: производственная линия с тремя узлами, мигающий простой и подпись агент предложил — мастер подтвердил"></canvas>
          </div>
        </div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('asz-shift-monitor-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#e2e8f0', muted:'#94a3b8', dim:'#64748b',
    line:'#334155', lineAct:'#22c55e',
    node:'#1e293b', nodeBdr:'#475569',
    green:'#22c55e', greenGlow:'rgba(34,197,94,.25)',
    red:'#ef4444', redGlow:'rgba(239,68,68,.35)',
    amber:'#f5c518', violet:'#8b5cf6',
    panel:'rgba(15,23,42,.92)', panelBdr:'rgba(255,255,255,.12)',
    agent:'#8b5cf6', human:'#22c55e'
  };

  var NODES = [
    {label:'Узел 1', status:'ok', x:0},
    {label:'Узел 2', status:'down', x:0, downtime:23, code:'ожидание материала'},
    {label:'Узел 3', status:'ok', x:0}
  ];

  var confirmPhase = 0; // 0=agent proposed, 1=master confirmed

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawNode(nx, ny, nw, nh, node, pulse){
    var isDown = node.status === 'down';
    var glow = isDown ? C.redGlow : C.greenGlow;
    var bdr = isDown ? C.red : C.green;

    if(isDown){
      ctx.shadowColor = C.red;
      ctx.shadowBlur = 12 + Math.sin(pulse*0.08)*6;
    } else {
      ctx.shadowColor = C.green;
      ctx.shadowBlur = 6;
    }

    rr(nx, ny, nw, nh, 10, C.node, bdr, 2);
    ctx.shadowBlur = 0;

    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(node.label, nx+nw/2, ny+18);

    var barY = ny + nh - 14;
    var barW = nw - 16;
    rr(nx+8, barY, barW, 6, 3, '#0f172a', null, 0);
    var prog = isDown ? 0.35 : 0.82 + Math.sin(pulse*0.04)*0.05;
    rr(nx+8, barY, barW*prog, 6, 3, isDown ? C.red : C.green, null, 0);

    if(isDown){
      ctx.fillStyle = C.red;
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.fillText('ПРОСТОЙ ' + node.downtime + ' мин', nx+nw/2, ny+nh/2+4);
    } else {
      ctx.fillStyle = C.green;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText('в работе', nx+nw/2, ny+nh/2+4);
    }
  }

  function drawConfirmPanel(px, py, pw, ph, phase, pulse){
    rr(px, py, pw, ph, 12, C.panel, C.panelBdr, 1);

    ctx.fillStyle = C.amber;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('HUMAN-IN-THE-LOOP', px+14, py+20);

    var agentY = py + 32;
    rr(px+12, agentY, pw-24, 36, 8, 'rgba(139,92,246,.15)', C.violet, 1);
    ctx.fillStyle = C.violet;
    ctx.font = 'bold 9px Inter,sans-serif';
    ctx.fillText('🤖 Агент предложил:', px+20, agentY+14);
    ctx.fillStyle = C.ink;
    ctx.font = '10px Inter,sans-serif';
    ctx.fillText('код «ожидание материала» · узел 2', px+20, agentY+28);

    var humanY = agentY + 44;
    var confirmed = phase > 120;
    rr(px+12, humanY, pw-24, 36, 8,
      confirmed ? 'rgba(34,197,94,.15)' : 'rgba(255,255,255,.05)',
      confirmed ? C.human : C.dim, 1);
    ctx.fillStyle = confirmed ? C.human : C.muted;
    ctx.font = 'bold 9px Inter,sans-serif';
    ctx.fillText(confirmed ? '✓ Мастер подтвердил' : '⏳ Ожидание мастера…', px+20, humanY+14);
    ctx.fillStyle = C.ink;
    ctx.font = '10px Inter,sans-serif';
    if(confirmed){
      ctx.fillText('алерт директору отправлен', px+20, humanY+28);
    } else {
      var dots = '.'.repeat((Math.floor(pulse/20)%3)+1);
      ctx.fillText('Telegram · планшет смены' + dots, px+20, humanY+28);
    }
  }

  function tick(){
    frame++;
    var pulse = frame;
    confirmPhase = (confirmPhase + 1) % 280;

    ctx.clearRect(0,0,W,H);

    var pad = 20;
    var lineY = H * 0.42;
    var nodeW = Math.min(90, (W - pad*2) / 4.5);
    var nodeH = 64;
    var gap = (W - pad*2 - nodeW*3) / 4;
    var startX = pad + gap;

    ctx.strokeStyle = C.line;
    ctx.lineWidth = 3;
    ctx.setLineDash([]);
    ctx.beginPath();
    ctx.moveTo(pad, lineY + nodeH/2);
    ctx.lineTo(W - pad, lineY + nodeH/2);
    ctx.stroke();

    for(var i=0;i<3;i++){
      var nx = startX + i*(nodeW + gap);
      if(i < 2){
        ctx.strokeStyle = NODES[i].status === 'ok' ? C.lineAct : C.line;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(nx + nodeW, lineY + nodeH/2);
        ctx.lineTo(nx + nodeW + gap, lineY + nodeH/2);
        ctx.stroke();
      }
      drawNode(nx, lineY - nodeH/2, nodeW, nodeH, NODES[i], pulse);
    }

    var panelW = Math.min(280, W - 40);
    var panelH = 120;
    drawConfirmPanel(W - panelW - 16, 16, panelW, panelH, confirmPhase, pulse);

    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('смена №2 · live · план 87%', pad, H - 14);

    ctx.textAlign = 'right';
    ctx.fillStyle = C.amber;
    ctx.fillText((15 + Math.floor(pulse/60)%16) + ':42', W - pad, H - 14);

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
      </section>
      <!-- === /БОРИС CANVAS === -->

    </div>
  </section>

  <section class="asz-section" id="smennye-zadaniya">
    <div class="asz-cnt">
      <div class="asz-sh asz-left nero-ai-reveal">
        <span class="asz-eyebrow">Сменные задания</span>
        <h2>Сменные задания без хаоса: от Excel к AI</h2>
        <p><strong>ai сменные задания</strong> — отдельная боль, которую конкуренты часто пропускают. У вас хаос начинается раньше: кто что делает на линии в эту смену?</p>
      </div>

      <div class="asz-timeline nero-ai-reveal" aria-label="Сценарий дня мастера">
        <div class="asz-tl-item">
          <div class="asz-tl-dot"></div>
          <h3>Утро</h3>
          <p>Агент читает план и формирует очередь по приоритетам и матрице переналадок. Сменное задание — за минуты, не за часы.</p>
        </div>
        <div class="asz-tl-item">
          <div class="asz-tl-dot"></div>
          <h3 id="smennye-vydacha">Выдача и смена задач на линии</h3>
          <p>При срочном заказе или поломке пересчитывает очередь и <strong>предлагает</strong> новое задание — исполняет только после подтверждения мастера. Сценарий MBS Group для 1С: 20 рабочих центров, 50+ заказов (<a href="https://mbsgroup.ru/ai/1c/proizvodstvo-planirovanie/optimizator-proizvodstvennogo-raspisaniya/" target="_blank" rel="noopener noreferrer">mbsgroup.ru</a>).</p>
        </div>
        <div class="asz-tl-item">
          <div class="asz-tl-dot"></div>
          <h3 id="smennye-telegram">Telegram / планшет мастера смены</h3>
          <p>Мастер видит задание, статус линии и кнопки «старт / стоп / простой». Для пищевого — коды CIP-мойки, смены формата. Для мебельного — ожидание кромки, фурнитуры, сушки.</p>
        </div>
        <div class="asz-tl-item">
          <div class="asz-tl-dot"></div>
          <h3>Вечер</h3>
          <p><strong>Итог:</strong> сменное задание формируется за минуты; при изменении вводных мастер получает пересчитанный план, а не хаотичные правки в чате.</p>
        </div>
      </div>
    </div>
  </section>

  <p class="nero-ai-reveal asz-related" style="margin:0 auto 24px;max-width:var(--asz-max,960px);padding:0 20px;font-size:15px">Когда план смены берётся из учётной системы, агент логично стыковать с ERP: смежный разбор — <a href="/ai-1c-erp/">внедрение AI-агента для 1С и ERP под ключ</a> — показывает, как заказы и номенклатура попадают в производственный контур без двойного ввода.</p>

  <section class="asz-section asz-section-alt" id="karta-poter">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Контроль простоев</span>
        <h2>Контроль простоев и карта потерь</h2>
        <p><strong>ai контроль простоев</strong> работает только при дисциплине фиксации. Сначала — справочник причин, потом — аналитика.</p>
      </div>

      <div class="asz-sh asz-left nero-ai-reveal" style="margin-bottom:24px">
        <h3 id="karta-klassifikaciya">Классификация простоев: плановые, внеплановые, микропростои</h3>
        <p>Рекомендуем <strong>8–12 кодов на линию</strong> по правилу «первопричина, не следствие» (<a href="https://gse.kz/blog/klassifikator-prichin-prostoev-oee-reestr-pravila" target="_blank" rel="noopener noreferrer">классификатор GSE</a>).</p>
      </div>

      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table" aria-label="Классификатор простоев для мебельного и пищевого производства">
          <thead>
            <tr><th>Тип</th><th>Примеры кодов (мебель / пищевка)</th></tr>
          </thead>
          <tbody>
            <tr><td>Плановые</td><td>переналадка, плановое ТО, санобработка линии</td></tr>
            <tr><td>Внеплановые</td><td>поломка, аварийная остановка, отказ узла</td></tr>
            <tr><td>Организационные</td><td>нет материала, нет оператора, ожидание согласования</td></tr>
            <tr><td>Микропростои</td><td>поиск инструмента, короткая подстройка, смена рулона</td></tr>
          </tbody>
        </table>
      </div>

      <div class="asz-card nero-ai-reveal" style="margin-top:28px">
        <h3 id="karta-lid-magnit">Лид-магнит «Карта потерь производства»</h3>
        <p>Перед пилотом мы делаем <strong>карту потерь</strong> — аудит 2–3 дня: где теряются минуты, какие системы уже есть (Excel, 1С, бумага), кто принимает решения. Это вход в воронку и основа для KPI пилота.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-karta-poter">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Найти простои на вашем цехе</p>
          <p class="ym-cta-block__sub">Проведём экспресс-разбор и пришлём Карту потерь производства: где теряются минуты, какие системы уже есть и с чего начать пилот.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
          </div>
        </div>
      </aside>
    </div>
  </section>

  <section class="asz-section" id="etapy">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Под ключ</span>
        <h2>Внедрение AI на производство под ключ</h2>
        <p><strong>Внедрение ai агентов</strong> на производство — проект с измеримым результатом, не «цифровую трансформацию на три года». Модель Nero Network: пилот на одном участке → интеграция → масштабирование.</p>
      </div>

      <div class="asz-sh asz-left nero-ai-reveal" style="margin-bottom:20px">
        <h3 id="etapy-audit">Аудит текущего учёта (Excel, 1С, MES, бумага)</h3>
      </div>
      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table" aria-label="Сравнение способов учёта">
          <thead>
            <tr><th>Способ учёта</th><th>Проблема</th><th>Роль в проекте</th></tr>
          </thead>
          <tbody>
            <tr><td>Бумага / Excel</td><td>задержка, разные форматы</td><td>источник данных на MVP</td></tr>
            <tr><td>1С без MES</td><td>план есть, факт смены — нет в реальном времени</td><td>read плана, write-back простоев</td></tr>
            <tr><td>MES/OEE</td><td>дорого для МСБ</td><td>опционально на этапе 2</td></tr>
            <tr><td>AI-агент</td><td>фиксация в момент + отчёт</td><td>целевое состояние</td></tr>
          </tbody>
        </table>
      </div>

      <div class="asz-sh asz-left nero-ai-reveal" style="margin-top:40px;margin-bottom:20px">
        <h3 id="etapy-pilot">Этапы: пилот → интеграция → масштабирование</h3>
      </div>
      <div class="asz-steps nero-ai-reveal" aria-label="Этапы внедрения">
        <div class="asz-step"><span class="asz-step-n">1</span><p><strong>Аудит 2–3 дня</strong> — карта потерь, роли, источники данных.</p></div>
        <div class="asz-step"><span class="asz-step-n">2</span><p><strong>Справочник простоев</strong> — 8–12 кодов, правила классификации.</p></div>
        <div class="asz-step"><span class="asz-step-n">3</span><p><strong>Пилот 4–6 недель</strong> на одной смене/линии: задание + фиксация + отчёт.</p></div>
        <div class="asz-step"><span class="asz-step-n">4</span><p><strong>Интеграция с 1С/ERP</strong> — заказы, номенклатура; факт и простои — write-back или webhook.</p></div>
        <div class="asz-step"><span class="asz-step-n">5</span><p><strong>Масштабирование</strong> — второй участок только после KPI пилота.</p></div>
      </div>

      <div class="asz-sh asz-left nero-ai-reveal" style="margin-top:40px">
        <h3 id="etapy-roli">Сроки и роли: IT, мастер, руководитель</h3>
        <ul>
          <li><strong>Директор</strong> — KPI, бюджет, решение о масштабировании.</li>
          <li><strong>Мастер смены</strong> — подтверждение заданий и классификации простоев (human-in-the-loop).</li>
          <li><strong>IT / интегратор</strong> — 1С, бот, отчёты; on-premise при требованиях 152-ФЗ.</li>
        </ul>
        <p><strong>Внедрение ai в бизнес процессы</strong> производства без программиста на стороне заказчика возможно: на пилоте достаточно мастера и контакта с техслужбой.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации сами?</p>
          <p class="ym-cta-block__sub">Если команда хочет понимать guardrails и human-in-the-loop до старта пилота — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="asz-section asz-section-alt" id="integracii">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Стек</span>
        <h2>Интеграции: 1С, ERP, MES, CRM и датчики</h2>
        <p><strong>Интеграция ai производство контроль</strong> не требует замены всей MES. Достаточно точек обмена данными.</p>
      </div>

      <div class="asz-chips nero-ai-reveal" aria-label="Интеграции">
        <span class="asz-chip">1С:УПП</span>
        <span class="asz-chip">1С:ERP</span>
        <span class="asz-chip">Telegram</span>
        <span class="asz-chip">Bitrix24</span>
        <span class="asz-chip">amoCRM</span>
        <span class="asz-chip">OPC UA</span>
        <span class="asz-chip">MQTT</span>
        <span class="asz-chip">n8n / Make</span>
      </div>

      <div class="asz-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="asz-card">
          <h3 id="integracii-crm">ai производство контроль интеграция crm</h3>
          <p>Если заказы приходят через Bitrix24 или amoCRM — агент читает приоритеты из CRM и связывает их с планом смены. Подробнее про <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM</a> — отдельная посадочная; здесь <strong>ai производство контроль в CRM</strong> — не замена ERP, а синхронизация коммерческого и производственного контура.</p>
        </div>
        <div class="asz-card">
          <h3 id="integracii-oee">OEE и датчики без замены всей MES</h3>
          <p>На старте датчики <strong>не обязательны</strong>: факт смены — ручной ввод + агент. На этапе 2 — OPC UA, MQTT, телеметрия (<a href="https://www.verstov.info/news/company_news/za-dva-goda-na-magnitogorskom-metkombinate-realizovano-19-proektov-prediktivnoy-diagnostiki-oborudov" target="_blank" rel="noopener noreferrer">кейс ММК</a>). Агент видит паттерны: «каждую вторую смену простой на узле X».</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;font-size:14.5px"><strong>Стек:</strong> 1С:УПП, 1С:ERP, Galaktika; Telegram; n8n/Make; YandexGPT / GigaChat / OpenAI; Metabase или Google Sheets на MVP.</p>
    </div>
  </section>

  <section class="asz-section" id="ceny">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Цена и ROI</span>
        <h2>Стоимость внедрения и окупаемость</h2>
        <p><strong>ai производство контроль цена</strong> зависит от глубины интеграции и числа линий. Рыночный коридор пилота — от 420 тыс. до 1,8 млн ₽ (ориентир Noltis; не обещание Nero Network).</p>
      </div>

      <div class="asz-sh asz-left nero-ai-reveal">
        <h3 id="ceny-chek">Ориентир чека 500 тыс.–2 млн ₽</h3>
        <p>Для проекта <strong>ai производство контроль под ключ</strong> в малом цехе: аудит, пилот, интеграция с 1С, обучение мастеров, отчётность. Первое внедрение AI в малый бизнес — 100–500 тыс. ₽ за узкую задачу (<a href="https://vc.ru/ai/3093896-stoimost-vnedreniya-ii-v-maliy-biznes-i-sroki-okupayemosti" target="_blank" rel="noopener noreferrer">vc.ru</a>).</p>
      </div>

      <div class="asz-sh asz-left nero-ai-reveal" style="margin-top:32px">
        <h3 id="ceny-roi">ROI: экономия на простоях vs стоимость проекта</h3>
      </div>

      <div id="asz-downtime-calculator" class="asz-calc nero-ai-reveal" aria-label="Калькулятор стоимости часа простоя">
<style>
#asz-downtime-calculator.asz-calc{
  margin:24px 0 32px;padding:28px 32px;
  background:linear-gradient(135deg,rgba(245,197,24,.08),rgba(139,92,246,.06));
  border:1px solid rgba(245,197,24,.22);border-radius:20px;
}
#asz-downtime-calculator .asz-calc-grid{
  display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px;align-items:end;
}
@media(max-width:768px){#asz-downtime-calculator .asz-calc-grid{grid-template-columns:1fr;}}
#asz-downtime-calculator label{display:block;font-size:12px;font-weight:700;color:#9aa8bd;margin-bottom:8px;letter-spacing:.04em;}
#asz-downtime-calculator input[type=number]{
  width:100%;padding:12px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
  background:rgba(255,255,255,.06);color:#fff;font-size:16px;font-weight:700;
}
#asz-downtime-calculator .asz-calc-result{
  margin-top:24px;padding:20px 24px;border-radius:14px;
  background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);text-align:center;
}
#asz-downtime-calculator .asz-calc-result strong{
  display:block;font-size:clamp(28px,4vw,42px);font-weight:900;color:#ef4444;letter-spacing:-.04em;
}
#asz-downtime-calculator .asz-calc-result span{font-size:14px;color:#9aa8bd;}
#asz-downtime-calculator .asz-calc-note{font-size:13px;color:#64748b;margin-top:12px;font-style:italic;}
</style>
        <p style="margin-bottom:20px;font-size:15px"><strong>Калькулятор простоя:</strong> если час простоя линии стоит <em>X</em> ₽, а неучтённые простои — <em>Y</em> часов в неделю, сколько вы теряете в год?</p>
        <div class="asz-calc-grid">
          <div>
            <label for="asz-calc-hour-cost">Стоимость часа простоя, ₽</label>
            <input type="number" id="asz-calc-hour-cost" value="15000" min="1000" step="500" aria-describedby="asz-calc-result-text">
          </div>
          <div>
            <label for="asz-calc-hours-week">Неучтённых часов в неделю</label>
            <input type="number" id="asz-calc-hours-week" value="3" min="0.5" step="0.5" max="40">
          </div>
          <div>
            <label for="asz-calc-reduction">Снижение после пилота, %</label>
            <input type="number" id="asz-calc-reduction" value="25" min="5" max="50" step="5">
          </div>
        </div>
        <div class="asz-calc-result">
          <strong id="asz-calc-annual-loss">—</strong>
          <span id="asz-calc-result-text">годовые потери от неучтённых простоев</span>
        </div>
        <p class="asz-calc-note" id="asz-calc-savings">При снижении на 25% экономия окупает пилот за 3–9 месяцев — консервативный сценарий.</p>
<script>
(function(){
  var hour = document.getElementById('asz-calc-hour-cost');
  var week = document.getElementById('asz-calc-hours-week');
  var red = document.getElementById('asz-calc-reduction');
  var lossEl = document.getElementById('asz-calc-annual-loss');
  var saveEl = document.getElementById('asz-calc-savings');
  if(!hour||!week||!red||!lossEl) return;
  function fmt(n){ return Math.round(n).toLocaleString('ru-RU') + ' ₽'; }
  function calc(){
    var h = parseFloat(hour.value)||0;
    var w = parseFloat(week.value)||0;
    var r = parseFloat(red.value)||0;
    var annual = h * w * 52;
    var savings = annual * (r/100);
    lossEl.textContent = fmt(annual);
    saveEl.textContent = 'При снижении на ' + r + '% экономия ' + fmt(savings) + ' в год — окупаемость пилота 3–9 мес. при правильной точке внедрения.';
  }
  [hour,week,red].forEach(function(el){ el.addEventListener('input', calc); });
  calc();
})();
</script>
      </div>

      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table" aria-label="Сравнение подходов Excel vs AI vs MES">
          <thead>
            <tr><th>Подход</th><th>Срок запуска</th><th>Ориентир бюджета</th><th>Для кого</th></tr>
          </thead>
          <tbody>
            <tr><td>Excel / бумага</td><td>0</td><td>минимальный</td><td>пока потери «терпимы»</td></tr>
            <tr><td>AI-агент (пилот)</td><td>4–6 недель</td><td>500 тыс.–2 млн ₽</td><td>малый цех, 1–5 линий</td></tr>
            <tr><td>Полная MES</td><td>6–18 мес.</td><td>от нескольких млн ₽</td><td>крупные площадки</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px"><strong>ai производство контроль заказать</strong> — через заявку с описанием линий и текущего учёта; без этого оценка будет вилкой в 3 раза.</p>

      <aside class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет под ваши линии</p>
          <p class="ym-cta-block__sub">Ориентир 500 тыс.–2 млн ₽ за пилот с 1С и одной линией. На разборе «Найти простои» дадим вилку сроков и ROI — без обязательств.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
          </div>
        </div>
      </aside>
    </div>
  </section>

  <section class="asz-section asz-section-alt" id="keisy">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения</h2>
        <p>Прямых публичных кейсов «AI-агент = сменные задания + контроль простоев» для мебельного цеха 30 человек <strong>мало</strong> — рынок молодой. Ниже — смежные реализации с оговорками.</p>
      </div>
      <div class="asz-case-grid">
        <div class="asz-case-card nero-ai-reveal">
          <div class="asz-case-tag">Мебель · проектная модель</div>
          <h3 id="keisy-mebel">Мебельное производство</h3>
          <p>3 линии, сменное задание в Excel, простои в журнале. Пилот: Telegram-бот, 10 кодов, 1С:УПП. Задание за 5 мин вместо 40; «прочие» простои с 14% до 6%. <em>Модель Nero Network, не именованный клиент.</em></p>
        </div>
        <div class="asz-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="asz-case-tag">Пищевая · сценарий</div>
          <h3 id="keisy-pischevoe">Пищевое производство и цеха</h3>
          <p>Линия розлива, смена формата, санитарные остановки. Агент различает плановую мойку и внеплановый простой; алерт при простое &gt; 15 мин. Утренняя сводка — топ-3 потери.</p>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;font-size:14.5px">Смежные кейсы: <a href="https://noltis.ru/product/ai-dlya-proizvodstva/" target="_blank" rel="noopener noreferrer">Noltis</a> (Telegram, OEE), <a href="https://www.phosagro.ru/press/company/proekt-fosagro-po-vnedreniyu-ii-agentov-v-sistemu-upravleniya-proizvodstvom-otmechen-nagradoy-nezavi/" target="_blank" rel="noopener noreferrer">ФосАгро «AIХимик»</a> (крупное производство), MBS Group (расписание 1С).</p>
    </div>
  </section>

  <section class="asz-section" id="agentic-ai">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">Тренд 2026</span>
        <h2>Agentic AI на производстве: тренд 2026 и риски</h2>
        <p>Рынок хочет agentic AI, но отменяет проекты без governance. На фоне <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">масштабного внедрения AI в крупном бизнесе</a> это не противоречие — это фильтр зрелости проекта.</p>
      </div>

      <div class="asz-gartner nero-ai-reveal" aria-label="Прогноз Gartner">
        <div class="asz-gartner-num">&gt;40%</div>
        <div>
          <p><strong>agentic AI-проектов будут отменены к 2027</strong> — из-за стоимости, неясного ROI и рисков (<a href="https://www.gartner.com/en/newsroom/press-releases/2025-06-25-gartner-predicts-over-40-percent-of-agentic-ai-projects-will-be-canceled-by-end-of-2027" target="_blank" rel="noopener noreferrer">Gartner, 25.06.2025</a>).</p>
          <blockquote class="asz-quote">«Most agentic AI projects right now are early stage experiments… often misapplied» — Anushree Verma, Gartner</blockquote>
        </div>
      </div>

      <div class="asz-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="asz-card">
          <h3 id="agentic-risk">Почему проекты отменяют и как снизить риск</h3>
          <p>Deloitte/MLC: ожидания agentic AI в manufacturing <strong>6% → 24%</strong> за два года (<a href="https://www.deloitte.com/us/en/insights/industry/manufacturing-industrial-products/agentic-ai-manufacturing-digital-transformation.html" target="_blank" rel="noopener noreferrer">Deloitte</a>). Nero Network снижает риск: пилот с KPI, human-in-the-loop, audit log, масштабирование после цифр.</p>
        </div>
        <div class="asz-card">
          <h3 id="agentic-human">Контроль результата человеком на смене</h3>
          <p>Агент <strong>не запускает ремонт сам</strong>, не меняет регламенты. Решения — за мастером и директором. Позиция Plex/Rockwell: agentic AI в guardrails (<a href="https://plex.rockwellautomation.com/en-us/platform/agentic-ai-in-manufacturing.html" target="_blank" rel="noopener noreferrer">Plex</a>).</p>
        </div>
      </div>
    </div>
  </section>

  <p class="nero-ai-reveal asz-related" style="margin:0 auto 24px;max-width:var(--asz-max,960px);padding:0 20px;font-size:15px">Если отчёты руководителю идут из почтового потока, а не только из чата смены, полезно сравнить с <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработкой входящей почты в CRM</a> — как автоматизируют заявки до попадания в учёт и производственный план.</p>

  <section class="asz-section asz-section-alt" id="faq">
    <div class="asz-cnt">
      <div class="asz-sh nero-ai-reveal">
        <span class="asz-eyebrow">FAQ</span>
        <h2>Частые вопросы</h2>
      </div>
      <div class="asz-faq nero-ai-reveal" itemscope itemtype="https://schema.org/FAQPage">
        <details class="asz-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <summary class="asz-faq-q" itemprop="name">Как внедрить ai производство контроль без программиста?</summary>
          <div class="asz-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><p itemprop="text">На пилоте программист на стороне заказчика не нужен. Нужны: мастер смены, контакт IT для доступа к 1С, директор для KPI. Excel на старте — допустимый источник данных.</p></div>
        </details>
        <details class="asz-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <summary class="asz-faq-q" itemprop="name">Сколько стоит ai производство контроль для малого бизнеса?</summary>
          <div class="asz-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><p itemprop="text">Ориентир 500 тыс.–2 млн ₽ за пилот с интеграцией 1С и одной линией. Узкая задача без ERP — от 100–500 тыс. ₽ по рынку.</p></div>
        </details>
        <details class="asz-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <summary class="asz-faq-q" itemprop="name">Чем AI-агент отличается от MES?</summary>
          <div class="asz-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><p itemprop="text">MES — полноценная система: дорого, долго. AI-агент — лёгкий слой для сменного задания, фиксации простоев и отчёта. MES можно подключить на этапе 2.</p></div>
        </details>
        <details class="asz-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <summary class="asz-faq-q" itemprop="name">Заменит ли агент мастера смены?</summary>
          <div class="asz-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><p itemprop="text">Нет. Агент ускоряет планирование и фиксацию; мастер подтверждает задания и классифицирует спорные простои.</p></div>
        </details>
        <details class="asz-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <summary class="asz-faq-q" itemprop="name">Нужны ли датчики на старте?</summary>
          <div class="asz-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><p itemprop="text">Нет. Факт смены — ручной ввод через Telegram. Датчики — опционально после пилота.</p></div>
        </details>
        <details class="asz-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <summary class="asz-faq-q" itemprop="name">Как быть с 152-ФЗ и on-premise?</summary>
          <div class="asz-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><p itemprop="text">Возможны on-premise, локальные LLM (GigaChat), хранение логов на серверах заказчика. Обсуждается на аудите.</p></div>
        </details>
        <details class="asz-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <summary class="asz-faq-q" itemprop="name">ai производство контроль примеры внедрения — где смотреть?</summary>
          <div class="asz-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><p itemprop="text">Смежные кейсы: ФосАгро, Noltis, MBS, Bosch Shopfloor Agent. Для МСБ — пилот с измеримым KPI, а не копирование чужого пресс-релиза.</p></div>
        </details>
      </div>
    </div>
  </section>

  <section class="asz-section" id="cta">
    <div class="asz-cnt">
      <div class="asz-sh asz-left nero-ai-reveal">
        <span class="asz-eyebrow">Следующий шаг</span>
        <h2>Найти простои на вашем производстве</h2>
        <p>Если <strong>задачи меняются вручную</strong>, а <strong>простои фиксируются поздно</strong> — вы теряете деньги каждую смену. AI-агент даёт: сменное задание за минуты, фиксацию простоя в момент события, отчёт руководителю без сбора по пяти системам.</p>
        <p>Оставьте заявку на <strong>«Найти простои»</strong> — проведём экспресс-разбор и пришлём <strong>Карту потерь производства</strong>. <strong>ai производство контроль внедрение под ключ</strong> начинается с честного аудита.</p>
        <div class="asz-btn-row" style="margin-top:28px">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.asz-content -->
<?php
$nero_schema_origin   = untrailingslashit( home_url( '/' ) );
$nero_schema_page_url = trailingslashit( get_permalink() );
$nero_schema_h1       = 'AI-агент для сменных заданий и контроля простоев: внедрение под ключ';
$nero_schema_org_id   = $nero_schema_origin . '/#organization';
$nero_schema_site_id  = $nero_schema_origin . '/#website';
$nero_schema_web_id   = $nero_schema_page_url . '#webpage';
$nero_schema_faq      = [
	[
		'question' => 'Как внедрить ai производство контроль без программиста?',
		'answer'   => 'На пилоте программист на стороне заказчика не нужен. Нужны: мастер смены, контакт IT для доступа к 1С, директор для KPI. Excel на старте — допустимый источник данных.',
	],
	[
		'question' => 'Сколько стоит ai производство контроль для малого бизнеса?',
		'answer'   => 'Ориентир 500 тыс.–2 млн ₽ за пилот с интеграцией 1С и одной линией. Узкая задача без ERP — от 100–500 тыс. ₽ по рынку.',
	],
	[
		'question' => 'Чем AI-агент отличается от MES?',
		'answer'   => 'MES — полноценная система: дорого, долго. AI-агент — лёгкий слой для сменного задания, фиксации простоев и отчёта. MES можно подключить на этапе 2.',
	],
	[
		'question' => 'Заменит ли агент мастера смены?',
		'answer'   => 'Нет. Агент ускоряет планирование и фиксацию; мастер подтверждает задания и классифицирует спорные простои.',
	],
	[
		'question' => 'Нужны ли датчики на старте?',
		'answer'   => 'Нет. Факт смены — ручной ввод через Telegram. Датчики — опционально после пилота.',
	],
	[
		'question' => 'Как быть с 152-ФЗ и on-premise?',
		'answer'   => 'Возможны on-premise, локальные LLM (GigaChat), хранение логов на серверах заказчика. Обсуждается на аудите.',
	],
	[
		'question' => 'ai производство контроль примеры внедрения — где смотреть?',
		'answer'   => 'Смежные кейсы: ФосАгро, Noltis, MBS, Bosch Shopfloor Agent. Для МСБ — пилот с измеримым KPI, а не копирование чужого пресс-релиза.',
	],
];
$nero_schema_faq_entities = [];
foreach ( $nero_schema_faq as $nero_schema_item ) {
	$nero_schema_faq_entities[] = [
		'@type'          => 'Question',
		'name'           => $nero_schema_item['question'],
		'acceptedAnswer' => [
			'@type' => 'Answer',
			'text'  => $nero_schema_item['answer'],
		],
	];
}
$nero_schema_graph = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $nero_schema_org_id,
			'name'  => $brand,
			'url'   => trailingslashit( $nero_schema_origin ),
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $nero_schema_site_id,
			'url'       => trailingslashit( $nero_schema_origin ),
			'name'      => $brand,
			'publisher' => [ '@id' => $nero_schema_org_id ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $nero_schema_web_id,
			'url'         => $nero_schema_page_url,
			'name'        => $nero_schema_h1,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $nero_schema_site_id ],
			'about'       => [ '@id' => $nero_schema_org_id ],
		],
		[
			'@type'           => 'BreadcrumbList',
			'@id'             => $nero_schema_page_url . '#breadcrumb',
			'itemListElement' => [
				[
					'@type'    => 'ListItem',
					'position' => 1,
					'name'     => 'Главная',
					'item'     => trailingslashit( $nero_schema_origin ),
				],
				[
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => $nero_schema_h1,
					'item'     => $nero_schema_page_url,
				],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $nero_schema_page_url . '#service',
			'name'        => $nero_schema_h1,
			'description' => $page_seo_description,
			'url'         => $nero_schema_page_url,
			'provider'    => [ '@id' => $nero_schema_org_id ],
		],
		[
			'@type'      => 'FAQPage',
			'@id'        => $nero_schema_page_url . '#faq',
			'mainEntity' => $nero_schema_faq_entities,
		],
	],
];
?>
<script type="application/ld+json">
<?php echo wp_json_encode( $nero_schema_graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-agent-smennye-zadaniya-kontrol-prostoev-page') || document.querySelector('.asz-content');
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
