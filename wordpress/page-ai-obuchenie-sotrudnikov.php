<?php
/**
 * Template Name: AI для обучения сотрудников: AI-наставник под ключ
 * Description: SEO-лендинг — внедрение AI-наставника для корпоративного обучения. Кейсы, этапы, цены. Демо бесплатно.
 */

$page_seo_title       = 'AI для обучения сотрудников: AI-наставник под ключ';
$page_seo_description = 'Внедрим AI-наставника по материалам компании: масштабируемое корпоративное обучение, онбординг и база знаний без хаоса. Кейсы, сроки, цены. Демо бесплатно.';

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
	['label' => 'Внедрение',    'href' => '#etapy'],
	['label' => 'Кейсы',        'href' => '#keisy'],
	['label' => 'Стоимость',    'href' => '#ceny'],
	['label' => 'FAQ',          'href' => '#faq'],
	['label' => 'Запуск',       'href' => '#zapusk'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
	$nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Запустить AI-обучение';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Курс по AI для HR';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: 'https://t.me/nero_network';

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
.yoast-breadcrumb,.entry-header,.page-title-section { display: none !important; }

#primary,.site-main,.site-content,#content,.content-area {
	padding-top: 0 !important; margin-top: 0 !important;
}

.aos-content {
	--aos-bg: #050711; --aos-bg2: #080b17;
	--aos-surface: rgba(255,255,255,.072);
	--aos-text: #e6edf7; --aos-muted: #9aa8bd; --aos-soft: #c7d2e5; --aos-heading: #fff;
	--aos-border: rgba(255,255,255,.10);
	--aos-accent: #79f2ff; --aos-violet: #8b5cf6; --aos-green: #22c55e;
	--aos-btn-from: #2563eb; --aos-btn-to: #7c3aed;
	--aos-r: 18px; --aos-r-lg: 24px; --aos-container: 1220px;
	background: linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
	color: var(--aos-text);
	font-family: Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
	overflow-x: hidden;
}
.aos-content *,.aos-content *::before,.aos-content *::after { box-sizing: border-box; }
.aos-content a { color: inherit; text-decoration: none; }
.aos-content p { color: var(--aos-muted); line-height: 1.72; margin: 0 0 1em; }
.aos-content p:last-child { margin-bottom: 0; }
.aos-content h2,.aos-content h3,.aos-content h4 { color: var(--aos-heading); letter-spacing: -.045em; margin: 0 0 .7em; }
.aos-content strong { color: var(--aos-soft); }
.aos-content ul { padding-left: 0; list-style: none; margin: 0 0 1em; }
.aos-content ul li { padding-left: 20px; position: relative; margin-bottom: .45em; color: var(--aos-muted); font-size: 14.5px; line-height: 1.65; }
.aos-content ul li::before { content: '›'; position: absolute; left: 0; color: var(--aos-accent); font-weight: 700; }
.aos-cnt { width: min(var(--aos-container),calc(100% - 40px)); margin: 0 auto; position: relative; z-index: 1; }
.aos-section { padding: clamp(64px,8vw,112px) 0; position: relative; }
.aos-section-alt { background: linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01)); border-top: 1px solid rgba(255,255,255,.06); border-bottom: 1px solid rgba(255,255,255,.06); }
.aos-sh { max-width: 820px; margin: 0 auto 48px; text-align: center; }
.aos-sh.aos-left { margin-left: 0; text-align: left; }
.aos-sh h2 { font-size: clamp(26px,4vw,50px); line-height: 1.06; margin-bottom: 14px; }
.aos-sh p { font-size: clamp(15px,1.6vw,18px); max-width: 680px; margin: 0 auto; }
.aos-sh.aos-left p { margin-left: 0; }
.aos-eyebrow { display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; border-radius: 999px; background: rgba(121,242,255,.08); border: 1px solid rgba(121,242,255,.22); font-size: 11.5px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--aos-accent); margin-bottom: 14px; }
.aos-gt { background: linear-gradient(92deg,#fff 0%,var(--aos-accent) 44%,var(--aos-violet) 100%); -webkit-background-clip: text; background-clip: text; color: transparent !important; }
.aos-intro { padding: clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px); background: linear-gradient(180deg,rgba(255,255,255,.03),transparent); border-bottom: 1px solid rgba(255,255,255,.06); }
.aos-intro-grid { display: grid; grid-template-columns: 1fr 340px; gap: 56px; align-items: center; }
.aos-intro-text { position: relative; padding-left: 20px; }
.aos-intro-text::before { content: ''; position: absolute; left: 0; top: 4px; bottom: 4px; width: 3px; border-radius: 2px; background: linear-gradient(180deg,var(--aos-accent),var(--aos-violet)); }
.aos-intro-text p { text-align: left !important; font-size: clamp(14.5px,1.55vw,16.5px); line-height: 1.8; }
.aos-intro-kpi { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.aos-kpi-card { background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); border-radius: 14px; padding: 16px 14px; text-align: center; }
.aos-kpi-card .kv { font-size: clamp(20px,2.5vw,26px); font-weight: 900; color: var(--aos-heading); margin-bottom: 5px; }
.aos-kpi-card .kl { font-size: 11px; font-weight: 600; color: var(--aos-muted); line-height: 1.4; }
.aos-kpi-card .ks { font-size: 10px; color: #64748b; margin-top: 4px; }
@media(max-width:900px){ .aos-intro-grid { grid-template-columns: 1fr; } .aos-intro-kpi { grid-template-columns: repeat(4,1fr); } }
@media(max-width:600px){ .aos-intro-kpi { grid-template-columns: 1fr 1fr; } }
.aos-toc-outer { padding: 0 0 clamp(36px,4.5vw,56px); }
.aos-toc { display: flex; flex-wrap: wrap; gap: 9px; justify-content: center; }
.aos-toc a { display: inline-block; padding: 9px 18px; background: var(--aos-surface); border: 1px solid var(--aos-border); border-radius: 999px; font-size: 13px; font-weight: 600; color: var(--aos-muted); transition: border-color .2s,color .2s; }
.aos-toc a:hover { border-color: rgba(121,242,255,.42); color: var(--aos-accent); }
.aos-card { background: linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042)); border: 1px solid var(--aos-border); border-radius: var(--aos-r-lg); padding: 26px; }
.aos-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.aos-grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; }
.aos-grid-4 { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; }
@media(max-width:768px){ .aos-grid-2,.aos-grid-3,.aos-grid-4 { grid-template-columns: 1fr; } }
@media(max-width:960px){ .aos-grid-3,.aos-grid-4 { grid-template-columns: 1fr 1fr; } }
.aos-table-wrap { overflow-x: auto; border-radius: 14px; border: 1px solid rgba(255,255,255,.09); margin: 24px 0; }
.aos-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.aos-table th { padding: 13px 16px; text-align: left; background: rgba(121,242,255,.1); color: var(--aos-accent); font-weight: 700; border-bottom: 1px solid rgba(121,242,255,.25); }
.aos-table td { padding: 12px 16px; border-bottom: 1px solid rgba(255,255,255,.05); color: var(--aos-text); vertical-align: top; }
.aos-table tr:last-child td { border-bottom: none; }
.aos-flow { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; justify-content: center; margin: 28px 0; padding: 20px; background: rgba(255,255,255,.04); border-radius: 16px; border: 1px solid rgba(255,255,255,.08); }
.aos-flow span { padding: 8px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; background: rgba(121,242,255,.1); color: var(--aos-accent); border: 1px solid rgba(121,242,255,.2); }
.aos-flow .arr { color: var(--aos-muted); background: none; border: none; padding: 0 4px; }
.aos-timeline { position: relative; padding-left: 40px; }
.aos-timeline::before { content: ''; position: absolute; left: 12px; top: 8px; bottom: 8px; width: 2px; background: linear-gradient(180deg,var(--aos-accent),var(--aos-violet)); opacity: .35; }
.aos-tl-item { position: relative; margin-bottom: 32px; }
.aos-tl-dot { position: absolute; left: -32px; top: 4px; width: 16px; height: 16px; border-radius: 50%; background: var(--aos-accent); box-shadow: 0 0 0 4px rgba(121,242,255,.2); }
.aos-case-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; }
@media(max-width:900px){ .aos-case-grid { grid-template-columns: 1fr 1fr; } }
@media(max-width:600px){ .aos-case-grid { grid-template-columns: 1fr; } }
.aos-case-card { background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.09); border-radius: 20px; padding: 26px; }
.aos-case-tag { font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--aos-green); margin-bottom: 10px; }
.aos-metric .num { font-size: 22px; font-weight: 900; color: var(--aos-accent); }
.aos-metric .lbl { font-size: 13px; color: var(--aos-muted); }
.aos-faq { display: flex; flex-direction: column; gap: 10px; max-width: 820px; margin: 0 auto; }
.aos-faq-item { background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.1); border-radius: 14px; overflow: hidden; }
.aos-faq-q { padding: 19px 24px; font-size: 16px; font-weight: 700; color: var(--aos-heading); cursor: pointer; display: flex; justify-content: space-between; gap: 16px; }
.aos-faq-q::after { content: '▾'; color: var(--aos-accent); transition: transform .25s; }
.aos-faq-item.open .aos-faq-q::after { transform: rotate(180deg); }
.aos-faq-a { padding: 0 24px; max-height: 0; overflow: hidden; transition: max-height .38s ease; font-size: 14.5px; color: var(--aos-muted); line-height: 1.72; }
.aos-faq-item.open .aos-faq-a { max-height: 800px; padding: 0 24px 20px; }
.ym-cta-block { border-radius: 20px; padding: 36px 40px; margin: 32px 0; background: linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1)); border: 1px solid rgba(121,242,255,.3); text-align: center; }
.ym-cta-block--secondary { text-align: left; background: rgba(255,255,255,.04); border-color: rgba(255,255,255,.12); }
.ym-cta-block--footer-final { background: linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08)); border-color: rgba(139,92,246,.3); }
.ym-cta-block__headline { font-size: clamp(20px,2.8vw,28px); font-weight: 800; color: #fff; margin: 0 0 10px; }
.ym-cta-block__sub { color: var(--aos-muted); font-size: 15px; margin: 0 auto 22px; max-width: 600px; line-height: 1.7; }
.ym-cta-block--secondary .ym-cta-block__sub { margin-left: 0; max-width: none; }
.ym-cta-block__actions { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
.ym-btn { display: inline-flex; align-items: center; padding: 13px 28px; border-radius: 999px; font-size: 15px; font-weight: 700; text-decoration: none !important; }
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent { background: linear-gradient(135deg,var(--aos-btn-from),var(--aos-btn-to)); color: #fff !important; }
.ym-btn--ghost { background: rgba(255,255,255,.08); color: var(--aos-text) !important; border: 1.5px solid rgba(255,255,255,.18); }
.ym-link--accent { color: var(--aos-accent) !important; text-decoration: underline !important; }
.nero-ai-reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease,transform .55s ease; }
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
</style>

<main id="primary" class="site-main nero-ai-home-page aos-landing-page" role="main" tabindex="-1">

<style>
/* === AOS HERO — самодостаточные стили первого экрана === */
.aos-hero.nero-ai-hero {
  --aos-bg: #050711;
  --aos-bg2: #080b17;
  --aos-text: #e6edf7;
  --aos-muted: #9aa8bd;
  --aos-soft: #c7d2e5;
  --aos-heading: #fff;
  --aos-border: rgba(255,255,255,.10);
  --aos-accent: #79f2ff;
  --aos-violet: #8b5cf6;
  --aos-green: #22c55e;
  --aos-shadow: 0 24px 72px rgba(0,0,0,.4);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
  background:
    radial-gradient(ellipse 80% 50% at 70% 20%, rgba(59,130,246,.18), transparent),
    radial-gradient(ellipse 60% 40% at 10% 80%, rgba(139,92,246,.12), transparent),
    linear-gradient(180deg, var(--aos-bg) 0%, var(--aos-bg2) 52%, var(--aos-bg) 100%);
  isolation: isolate;
  overflow: hidden;
}
.aos-hero.nero-ai-hero::before {
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
  z-index: 0;
}
.aos-hero.nero-ai-hero::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121,242,255,.12), transparent 66%);
  filter: blur(6px);
  animation: aosHeroGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes aosHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.aos-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aos-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aos-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  border: 1px solid rgba(121,242,255,.22);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--aos-accent);
  margin: 0 0 14px;
}
.aos-hero h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(44px, 7.2vw, 94px);
  line-height: .89;
  letter-spacing: -0.075em;
  color: var(--aos-heading);
  font-weight: 900;
}
.aos-hero .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--aos-accent) 44%, var(--aos-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aos-hero .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--aos-soft) !important;
  font-size: clamp(18px, 2vw, 22px);
  line-height: 1.58;
}
.aos-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aos-hero .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
  white-space: nowrap;
}
.aos-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 34px;
}
.aos-hero .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 26px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none;
  transition: transform .2s, box-shadow .2s;
}
.aos-hero .nero-ai-btn-primary {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(37,99,235,.35);
}
.aos-hero .nero-ai-btn-secondary {
  background: transparent;
  color: #e2e8f0 !important;
  border: 1px solid var(--aos-border);
}
.aos-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.aos-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2,6,23,.42);
  box-shadow: var(--aos-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.aos-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15,23,42,.95), rgba(6,10,24,.96));
}
.aos-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aos-hero .nero-ai-dots { display: flex; gap: 7px; }
.aos-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aos-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aos-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aos-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.aos-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aos-hero .nero-ai-window-body { padding: 18px; }
.aos-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
.aos-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: var(--aos-heading);
}
.aos-hero .nero-ai-live-pill {
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
.aos-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aosPulse 1.6s infinite;
}
@keyframes aosPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aos-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.aos-hero .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
}
.aos-hero .nero-ai-metric span {
  display: block;
  color: var(--aos-muted);
  font-size: 12px;
  font-weight: 700;
}
.aos-hero .nero-ai-metric strong {
  display: block;
  margin-top: 7px;
  color: #fff;
  font-size: 24px;
  line-height: 1;
}
.aos-hero .nero-ai-metric small {
  display: block;
  margin-top: 6px;
  color: #9fb0c9;
  font-size: 11px;
}
.aos-hero .aos-hero-canvas-wrap {
  position: relative;
  margin-top: 14px;
  height: 140px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(121,242,255,.15);
  background: linear-gradient(180deg, rgba(15,23,42,.6), rgba(6,10,24,.8));
}
.aos-hero #aos-mentor-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.aos-hero .nero-ai-task-stream {
  margin-top: 16px;
  display: grid;
  gap: 10px;
}
.aos-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
}
.aos-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aos-accent);
  font-size: 11px;
  font-weight: 800;
}
.aos-hero .nero-ai-task strong {
  display: block;
  color: var(--aos-heading);
  font-size: 13px;
}
.aos-hero .nero-ai-task span {
  display: block;
  color: var(--aos-muted);
  font-size: 11px;
}
.aos-hero .nero-ai-status {
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .06em;
  color: var(--aos-green);
}
.aos-hero .nero-ai-reveal {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}
.aos-hero .nero-ai-reveal.nero-ai-active {
  opacity: 1;
  transform: none;
}
.aos-hero .nero-ai-delay-2 { transition-delay: .24s; }
@media (max-width: 900px) {
  .aos-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aos-hero .nero-ai-dashboard { transform: none; }
  .aos-hero.nero-ai-hero { min-height: auto; padding-top: 96px; }
}

.aos-hero.nero-ai-hero { min-height: 100vh; min-height: 100dvh; position: relative; }

</style>

<section class="nero-ai-hero aos-hero" id="hero" aria-labelledby="hero-obuchenie-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai обучение</p>
      <h1 id="hero-obuchenie-title">AI для обучения сотрудников: <span class="nero-ai-gradient-text">AI-наставник под ключ</span></h1>
      <p class="nero-ai-hero-lead">Создадим AI-наставника и систему обучения по материалам вашей компании — знания доходят до каждого сотрудника без хаоса и повторяющихся вопросов</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Онбординг</li>
        <li class="nero-ai-badge">RAG по регламентам</li>
        <li class="nero-ai-badge">ИИ-тренажёр</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-наставник">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">AI-наставник · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Корпоративная академия</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Автоответы</span><strong>70%</strong><small>типовых вопросов</small></div>
            <div class="nero-ai-metric"><span>Пилот</span><strong>30</strong><small>документов</small></div>
            <div class="nero-ai-metric"><span>Сценарии</span><strong>4</strong><small>онбординг · продажи</small></div>
            <div class="nero-ai-metric"><span>Доступ</span><strong>24/7</strong><small>чат · Telegram</small></div>
          </div>
          <div class="aos-hero-canvas-wrap" aria-hidden="true">
            <canvas id="aos-mentor-canvas"></canvas>
          </div>
          <div class="nero-ai-task-stream">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">D1</span>
              <div><strong>Онбординг</strong><span>план «День 1» для новичка</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">RAG</span>
              <div><strong>RAG-ответ</strong><span>регламент с цитатой источника</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Аттестация</strong><span>тест из ваших материалов</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="aos-content">

<section class="aos-intro nero-ai-section" id="intro" aria-label="Введение">
	<div class="aos-cnt">
		<div class="aos-intro-grid nero-ai-reveal">
			<div class="aos-intro-text">
				<p class="aos-eyebrow">Лонгрид · ai обучение сотрудников</p>
				<p><strong>Коротко:</strong> AI-наставник — корпоративный ассистент, который обучает сотрудников по вашим регламентам, скриптам и базе знаний: отвечает 24/7, ведёт онбординг, проводит аттестацию и тренирует диалоги. Nero Network внедряет систему под ключ — от аудита материалов до запуска в Telegram, CRM или портале.</p>
				<p>Знания в компании часто «застревают» у экспертов. HR и руководители отвечают на одни и те же вопросы, онбординг не масштабируется. Только 27% сотрудников регулярно проходят корпоративное обучение, и лишь 12% применяют знания на практике (LinkedIn Learning, 2024). При этом 51% российских компаний пробовали AI в обучении, но системно внедрили AI-наставников лишь 2,9% (Digital Learning / РБК, 2025). Показательный пример масштаба — <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">опыт KPMG: Claude для 276 000 сотрудников</a>.</p>
			</div>
			<div class="aos-intro-kpi" aria-label="Ключевые метрики">
				<div class="aos-kpi-card"><div class="kv">2,9%</div><div class="kl">внедрили AI-наставников в РФ</div><div class="ks">Digital Learning, 2025</div></div>
				<div class="aos-kpi-card"><div class="kv">87%</div><div class="kl">L&D-команд используют AI</div><div class="ks">Synthesia, 2026</div></div>
				<div class="aos-kpi-card"><div class="kv">70%</div><div class="kl">типовых вопросов — автоответ</div><div class="ks">кейс Ростелеком</div></div>
				<div class="aos-kpi-card"><div class="kv">24/7</div><div class="kl">доступ к регламентам</div><div class="ks">RAG по вашим документам</div></div>
			</div>
		</div>
	</div>
</section>

<div class="aos-toc-outer">
	<div class="aos-cnt">
		<nav class="aos-toc ym-toc" aria-label="Оглавление">
			<a href="#kak-rabotaet">Как работает</a>
			<a href="#etapy">Этапы</a>
			<a href="#keisy">Кейсы</a>
			<a href="#ceny">Стоимость</a>
			<a href="#faq">FAQ</a>
			<a href="#zapusk">Запуск</a>
		</nav>
	</div>
</div>

<section class="aos-section" id="bole">
	<div class="aos-cnt">
		<div class="aos-sh aos-left nero-ai-reveal">
			<span class="aos-eyebrow">Боль HR и руководителей</span>
			<h2>AI для обучения сотрудников — что это и какую боль закрывает</h2>
			<p><strong>Определение:</strong> AI для обучения сотрудников — внедрение интеллектуального наставника на внутренних документах компании: регламентах, скриптах, FAQ, видео. В отличие от статичного курса в LMS, наставник отвечает в моменте — в чате, Telegram, CRM или на портале.</p>
			<p>Часть обращений, из которых потом собирают FAQ и скрипты, приходит по почте — <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработка входящей почты в CRM</a> помогает разобрать типовые письма и передать выжимку в базу знаний наставника.</p>
		</div>
		<div class="aos-grid-3 nero-ai-reveal" style="margin-top:32px">
			<div class="aos-card">
				<h3>Хаос в онбординге</h3>
				<p>Экспертиза концентрируется у нескольких наставников — при росте штата они становятся узким горлышком. Онбординг не масштабируется без пропорционального найма HR.</p>
			</div>
			<div class="aos-card">
				<h3>HR тонет в FAQ</h3>
				<p>Одни и те же вопросы к руководителям и HR повторяются ежедневно: «Где регламент?», «Как оформить возврат?», «Что говорить при возражении X?»</p>
			</div>
			<div class="aos-card">
				<h3>Обучение не масштабируется</h3>
				<p>Курс пройден — но в реальной задаче сотрудник не знает, куда смотреть. Сложно измерить, дошли ли знания до исполнения, а не только до галочки в LMS.</p>
			</div>
		</div>
		<div class="aos-table-wrap nero-ai-reveal" style="margin-top:32px">
			<table class="aos-table" aria-label="Сравнение wiki, LMS и AI-наставника">
				<thead><tr><th>Критерий</th><th>Wiki / Confluence</th><th>LMS</th><th>AI-наставник</th></tr></thead>
				<tbody>
					<tr><td>Формат</td><td>Статичные статьи</td><td>Курсы, тесты</td><td>Диалог в моменте задачи</td></tr>
					<tr><td>Актуальность</td><td>Зависит от авторов</td><td>Курс обновляется вручную</td><td>Обновили документ → свежие ответы</td></tr>
					<tr><td>Практика</td><td>Нет</td><td>Тесты</td><td>ИИ-тренажёр + аттестация</td></tr>
					<tr><td>Метрики HR</td><td>Просмотры</td><td>Прогресс курсов</td><td>Пробелы в базе, % верных ответов</td></tr>
				</tbody>
			</table>
		</div>
	</div>
</section>

<!-- ========== БОРИС: визуальный блок (не hero) ========== -->
<section id="ai-obuchenie-sotrudnikov-boris-block" class="aos-b-root" aria-label="Анимация: поток знаний от документов компании к AI-наставнику и прогрессу сотрудника">
<style>
#ai-obuchenie-sotrudnikov-boris-block.aos-b-root { padding: 56px 0 64px; background: #f8fafc; }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-cnt { max-width: 1160px; margin: 0 auto; padding: 0 24px; }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-card {
	display: grid; grid-template-columns: minmax(0,42%) minmax(0,58%);
	border-radius: 22px; overflow: hidden; background: #fff;
	box-shadow: 0 10px 40px rgba(15,23,42,.08), 0 0 0 1px rgba(148,163,184,.18);
	min-height: 500px;
}
@media(max-width:1023px){
	#ai-obuchenie-sotrudnikov-boris-block .aos-b-card { grid-template-columns: 1fr; min-height: auto; }
}
#ai-obuchenie-sotrudnikov-boris-block .aos-b-lft {
	padding: 40px 36px; display: flex; flex-direction: column; justify-content: center;
	border-right: 1px solid #e2e8f0;
}
@media(max-width:1023px){
	#ai-obuchenie-sotrudnikov-boris-block .aos-b-lft { border-right: none; border-bottom: 1px solid #e2e8f0; padding: 32px 24px; }
}
#ai-obuchenie-sotrudnikov-boris-block .aos-b-ey {
	display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 700;
	letter-spacing: .12em; text-transform: uppercase; color: #7c3aed; margin: 0 0 14px;
}
#ai-obuchenie-sotrudnikov-boris-block .aos-b-ey::before { content: ''; width: 18px; height: 2px; background: #7c3aed; border-radius: 1px; }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-h3 { font-size: clamp(20px,2.4vw,26px); font-weight: 800; color: #0f172a; line-height: 1.28; margin: 0 0 18px; }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-ul { list-style: none; margin: 0 0 22px; padding: 0; display: flex; flex-direction: column; gap: 9px; }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-ul li { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; line-height: 1.5; color: #334155; }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-ic {
	flex-shrink: 0; width: 22px; height: 22px; border-radius: 50%;
	background: rgba(124,58,237,.1); display: flex; align-items: center; justify-content: center;
	font-size: 11px; color: #6d28d9; font-style: normal;
}
#ai-obuchenie-sotrudnikov-boris-block .aos-b-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 18px; }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-pl { padding: 5px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-pl-v { background: rgba(124,58,237,.08); color: #6d28d9; border: 1.5px solid rgba(124,58,237,.22); }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-pl-g { background: rgba(34,197,94,.08); color: #15803d; border: 1.5px solid rgba(34,197,94,.22); }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-pl-c { background: rgba(14,165,233,.08); color: #0369a1; border: 1.5px solid rgba(14,165,233,.22); }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-foot { font-size: 13px; color: #64748b; font-style: italic; margin: 0; }
#ai-obuchenie-sotrudnikov-boris-block .aos-b-rgt {
	position: relative; background: linear-gradient(135deg,#faf5ff 0%,#ede9fe 35%,#f0f9ff 70%,#f8fafc 100%);
	min-height: 440px; overflow: hidden;
}
#aos-tutor-flow-canvas { position: absolute; inset: 0; width: 100%; height: 100%; display: block; }
</style>

<div class="aos-b-cnt">
	<div class="aos-b-card">
		<div class="aos-b-lft">
			<span class="aos-b-ey">Поток знаний</span>
			<h3 class="aos-b-h3">Регламенты компании → RAG → ответ наставника → прогресс сотрудника</h3>
			<ul class="aos-b-ul">
				<li><span class="aos-b-ic">1</span>Документы (PDF, Wiki, скрипты) индексируются в векторную базу с правами доступа</li>
				<li><span class="aos-b-ic">2</span>Сотрудник задаёт вопрос — RAG находит фрагменты и формирует ответ с цитатой</li>
				<li><span class="aos-b-ic">3</span>Низкая уверенность — эскалация HR; высокая — мгновенный ответ 24/7</li>
				<li><span class="aos-b-ic">✓</span>Прогресс онбординга, аттестация и аналитика пробелов — в дашборде HR</li>
			</ul>
			<div class="aos-b-pills">
				<span class="aos-b-pl aos-b-pl-v">RAG по регламентам</span>
				<span class="aos-b-pl aos-b-pl-g">70% без HR</span>
				<span class="aos-b-pl aos-b-pl-c">152-ФЗ контур</span>
			</div>
			<p class="aos-b-foot">Дальше разберём архитектуру AI-наставника и сценарии обучения →</p>
		</div>
		<div class="aos-b-rgt">
			<canvas id="aos-tutor-flow-canvas" aria-label="Анимация: документы компании проходят RAG-пайплайн, AI-наставник отвечает сотруднику и фиксирует прогресс обучения" role="img"></canvas>
		</div>
	</div>
</div>

<script>
(function(){
	'use strict';
	var cv = document.getElementById('aos-tutor-flow-canvas');
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
		ink: '#0f172a', muted: '#64748b', paper: '#ffffff', paperBdr: '#cbd5e1',
		violet: '#8b5cf6', violetGlow: 'rgba(139,92,246,.2)',
		cyan: '#0ea5e9', green: '#22c55e', greenGlow: 'rgba(34,197,94,.15)',
		field: '#e0f2fe', fieldBdr: '#7dd3fc', line: 'rgba(124,58,237,.25)',
		chat: '#f5f3ff', chatBdr: '#c4b5fd', progress: '#7c3aed'
	};

	var DOCS = [
		{label: 'Регламент', color: '#f59e0b', delay: 0},
		{label: 'Скрипт', color: '#0ea5e9', delay: 90},
		{label: 'FAQ', color: '#22c55e', delay: 180},
		{label: 'Видео', color: '#8b5cf6', delay: 270}
	];
	var LOOP = 680;

	function rr(x,y,w,h,r,fill,stroke,lw){
		ctx.beginPath();
		if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
		else ctx.rect(x,y,w,h);
		if (fill) { ctx.fillStyle = fill; ctx.fill(); }
		if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
	}

	function drawDoc(x,y,s,clr,label,alpha){
		ctx.globalAlpha = alpha || 1;
		rr(x,y,s,s*1.2,5,C.paper,C.paperBdr,1.5);
		rr(x+5,y+6,s-10,8,2,clr,null,0);
		ctx.fillStyle = C.ink;
		ctx.font = 'bold 8px Inter,sans-serif';
		ctx.textAlign = 'center';
		ctx.fillText(label, x+s/2, y+s*1.05);
		ctx.globalAlpha = 1;
	}

	function drawRagHub(cx,cy,r,pulse){
		rr(cx-r,cy-r,r*2,r*2,r,C.violetGlow,C.violet,2);
		ctx.fillStyle = C.violet;
		ctx.font = 'bold 11px Inter,sans-serif';
		ctx.textAlign = 'center';
		ctx.fillText('RAG', cx, cy-4);
		ctx.font = '9px Inter,sans-serif';
		ctx.fillStyle = C.muted;
		ctx.fillText('векторный поиск', cx, cy+10);
		for (var i = 0; i < 4; i++) {
			var ang = (i/4)*Math.PI*2 + pulse*0.05;
			ctx.beginPath();
			ctx.arc(cx+Math.cos(ang)*(r-8), cy+Math.sin(ang)*(r-8), 3, 0, Math.PI*2);
			ctx.fillStyle = C.violet; ctx.fill();
		}
	}

	function drawChat(x,y,w,h,text,source,alpha){
		ctx.globalAlpha = alpha || 1;
		rr(x,y,w,h,12,C.chat,C.chatBdr,1.5);
		ctx.fillStyle = C.ink;
		ctx.font = 'bold 10px Inter,sans-serif';
		ctx.textAlign = 'left';
		ctx.fillText('AI-наставник', x+12, y+18);
		ctx.fillStyle = C.muted;
		ctx.font = '9px Inter,sans-serif';
		var lines = text.split('\n');
		lines.forEach(function(ln,i){ ctx.fillText(ln, x+12, y+34+i*14); });
		rr(x+10,y+h-22,w-20,16,6,C.field,C.fieldBdr,1);
		ctx.fillStyle = '#0369a1';
		ctx.font = '8px Inter,sans-serif';
		ctx.fillText('📎 '+source, x+16, y+h-10);
		ctx.globalAlpha = 1;
	}

	function drawProgress(x,y,w,steps,done,pulse){
		rr(x,y,w,80,10,'rgba(255,255,255,.9)','#e2e8f0',1);
		ctx.fillStyle = C.ink;
		ctx.font = 'bold 10px Inter,sans-serif';
		ctx.textAlign = 'left';
		ctx.fillText('Онбординг · День '+done+'/5', x+12, y+18);
		var barY = y+30, barW = w-24;
		rr(x+12,barY,barW,8,4,'#e2e8f0',null,0);
		rr(x+12,barY,barW*(done/5),8,4,C.progress,null,0);
		steps.forEach(function(s,i){
			var sx = x+12 + (barW/4)*i;
			ctx.beginPath();
			ctx.arc(sx, barY+20, i<done?5:4, 0, Math.PI*2);
			ctx.fillStyle = i<done ? C.green : '#cbd5e1';
			ctx.fill();
			ctx.fillStyle = C.muted;
			ctx.font = '7px Inter,sans-serif';
			ctx.textAlign = 'center';
			ctx.fillText(s, sx, barY+34);
		});
	}

	function loop(){
		frame++;
		var loopFr = frame % LOOP;
		ctx.clearRect(0,0,W,H);

		var docX = W*0.06, docY = H*0.12, docS = 44;
		DOCS.forEach(function(d,i){
			var t = loopFr - d.delay;
			if (t < 0) return;
			var prog = Math.min(1, t/80);
			var y = docY + i*58 + (1-prog)*(-40);
			var alpha = Math.min(1, t/40);
			drawDoc(docX, y, docS, d.color, d.label, alpha);
			if (prog > 0.3) {
				ctx.globalAlpha = prog*0.4;
				ctx.strokeStyle = C.line;
				ctx.setLineDash([3,3]);
				ctx.beginPath();
				ctx.moveTo(docX+docS+4, y+docS/2);
				ctx.lineTo(W*0.32, H*0.45);
				ctx.stroke();
				ctx.setLineDash([]);
				ctx.globalAlpha = 1;
			}
		});

		drawRagHub(W*0.32, H*0.45, 42, frame);

		var chatT = loopFr - 200;
		if (chatT > 0) {
			var chatAlpha = Math.min(1, chatT/60);
			drawChat(W*0.48, H*0.18, W*0.46, 110,
				'Как оформить возврат?\nОтвет по регламенту §4.2…',
				'reglament-vozvrat.pdf', chatAlpha);
		}

		var progT = loopFr - 320;
		if (progT > 0) {
			var done = Math.min(5, Math.floor(progT/70)+1);
			drawProgress(W*0.48, H*0.62, W*0.46, ['День1','День2','День3','День4','День5'], done, frame);
		}

		if (loopFr > 400) {
			ctx.fillStyle = C.green;
			ctx.font = 'bold 11px Inter,sans-serif';
			ctx.textAlign = 'right';
			ctx.globalAlpha = Math.min(1,(loopFr-400)/60);
			ctx.fillText('✓ Знание зафиксировано в аналитике HR', W-20, H-16);
			ctx.globalAlpha = 1;
		}

		requestAnimationFrame(loop);
	}
	loop();
})();
</script>
</section>
<!-- ========== /БОРИС ========== -->

<section class="aos-section aos-section-alt" id="kak-rabotaet">
	<div class="aos-cnt">
		<div class="aos-sh nero-ai-reveal">
			<span class="aos-eyebrow">Архитектура</span>
			<h2>Как работает AI-наставник на материалах вашей компании</h2>
			<p><strong>Определение:</strong> корпоративный AI-ассистент обучения на RAG — нейросеть ищет фрагменты в базе знаний и формирует ответ с цитированием источника. При низкой уверенности — эскалация человеку.</p>
		</div>
		<div class="aos-flow nero-ai-reveal" aria-label="5 шагов RAG">
			<span>Вопрос сотрудника</span><span class="arr">→</span>
			<span>Определение роли</span><span class="arr">→</span>
			<span>RAG-поиск</span><span class="arr">→</span>
			<span>Ответ + цитата</span><span class="arr">→</span>
			<span>Аналитика HR</span>
		</div>
		<div class="aos-table-wrap nero-ai-reveal">
			<table class="aos-table" aria-label="RAG vs LMS с AI">
				<thead><tr><th>Критерий</th><th>RAG AI-наставник</th><th>LMS с AI-модулем</th></tr></thead>
				<tbody>
					<tr><td>Суть</td><td>Ответы из ваших документов в реальном времени</td><td>Курсы + AI для генерации контента</td></tr>
					<tr><td>Скорость запуска</td><td>4–8 недель на пилот</td><td>2–4 недели на базовую LMS</td></tr>
					<tr><td>Риск галлюцинаций</td><td>Ниже при grounded RAG + цитирование</td><td>Средний: нужна экспертная проверка</td></tr>
					<tr><td>Лучше для</td><td>Онбординг, поддержка, FAQ, скрипты продаж</td><td>Compliance, сертификация, отчётность</td></tr>
				</tbody>
			</table>
		</div>

		<div id="scenarii" style="margin-top:48px">
			<div class="aos-sh aos-left nero-ai-reveal">
				<span class="aos-eyebrow">Сценарии</span>
				<h2>Онбординг, продажи, поддержка и аттестация в одной системе</h2>
			</div>
			<div class="aos-grid-4 nero-ai-reveal">
				<div class="aos-card"><h3>AI онбординг</h3><p>Персональный план по дням: наставник отвечает на вопросы, напоминает о шагах, фиксирует прогресс новичка.</p></div>
				<div class="aos-card"><h3>ИИ-тренажёр продаж</h3><p>Отработка диалогов без отрыва от работы. Альфа-Банк: +13% оценка клиентов; Зетта: +36% качество звонков.</p></div>
				<div class="aos-card"><h3>База знаний поддержки</h3><p>Ответ по регламенту с цитатой 24/7. Ростелеком: до 70% запросов без участия человека.</p></div>
				<div class="aos-card"><h3>Аттестация</h3><p>AI генерирует тест из материалов, проверяет ответы. Росгосстрах: завершаемость курсов 40% → 89%.</p></div>
			</div>
			<p class="nero-ai-reveal" style="margin-top:24px">Для отдела продаж наставник часто встраивается в CRM: см. также <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента для amoCRM</a> — скрипты и ответы по базе знаний прямо в контексте сделки.</p>
		</div>
	</div>
</section>

<div class="aos-cnt">
	<div class="ym-cta-block ym-cta-block--primary" id="cta-demo">
		<div class="ym-cta-block__icon" aria-hidden="true">🎓</div>
		<div class="ym-cta-block__body">
			<p class="ym-cta-block__headline">Демо AI-наставника на ваших 5 документах — бесплатно</p>
			<p class="ym-cta-block__sub">Загрузите регламенты, скрипты или FAQ — через 15 минут покажем работающий прототип: ответы по вашим материалам, цитирование источников и сценарий онбординга. Без обязательств по внедрению.</p>
			<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
		</div>
	</div>
</div>

<section class="aos-section" id="etapy">
	<div class="aos-cnt">
		<div class="aos-sh nero-ai-reveal">
			<span class="aos-eyebrow">Внедрение под ключ</span>
			<h2>Внедрение AI-обучения сотрудников под ключ: этапы и сроки</h2>
			<p><strong>Определение:</strong> проект от аудита материалов до работающего AI-наставника в продакшене с интеграциями, обучением HR и метриками.</p>
		</div>
		<div class="aos-timeline nero-ai-reveal">
			<div class="aos-tl-item"><div class="aos-tl-dot"></div><h3>Этап 0 — Аудит (1 неделя)</h3><p>Интервью HR, инвентаризация материалов, выбор 1–2 пилотных сценариев, baseline-метрики.</p></div>
			<div class="aos-tl-item"><div class="aos-tl-dot"></div><h3>Этап 1 — Пилот (3–4 недели)</h3><p>Загрузка 30–100 документов, настройка RAG и guardrails, тест на 10–30 сотрудниках.</p></div>
			<div class="aos-tl-item"><div class="aos-tl-dot"></div><h3>Этап 2 — Расширение (4–8 недель)</h3><p>CRM, мессенджеры, HRIS, аттестация, дашборд HR, обучение кураторов.</p></div>
			<div class="aos-tl-item"><div class="aos-tl-dot"></div><h3>Этап 3 — Масштаб</h3><p>ИИ-тренажёр, мультиканал (Telegram, Bitrix24, виджет), все роли компании.</p></div>
		</div>
		<p class="nero-ai-reveal" style="margin-top:24px">На этапе расширения подключают учётные системы: <a href="/ai-1c-erp/">AI-агент для 1С и ERP</a> дополняет наставника регламентами из ERP, склада и бухгалтерии.</p>
		<div class="aos-table-wrap nero-ai-reveal">
			<table class="aos-table" aria-label="Этапы внедрения">
				<thead><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr></thead>
				<tbody>
					<tr><td>Аудит</td><td>1 неделя</td><td>Карта материалов, пилотные сценарии</td></tr>
					<tr><td>Пилот</td><td>3–4 недели</td><td>Прототип на 10–30 сотрудниках</td></tr>
					<tr><td>Расширение</td><td>4–8 недель</td><td>Интеграции, аттестация, дашборд</td></tr>
					<tr><td>Масштаб</td><td>по запросу</td><td>Тренажёр, все роли</td></tr>
				</tbody>
			</table>
		</div>
		<p class="nero-ai-reveal" style="text-align:center;margin-top:24px"><strong>Ориентиры:</strong> пилот 4–6 недель, 200–400 тыс. ₽ · под ключ 6–12 недель, 500 тыс.–1,2 млн ₽</p>
	</div>
</section>

<div class="aos-cnt">
	<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
		<div class="ym-cta-block__body">
			<p class="ym-cta-block__headline">HR и руководители хотят понимать AI до старта пилота?</p>
			<p class="ym-cta-block__sub">Перед внедрением AI-наставника полезно разобраться в RAG, промптах, guardrails и интеграции с LMS/CRM — это ускоряет согласование сценариев с IT и снижает риск «теневого ChatGPT». Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
		</div>
	</aside>
</div>

<section class="aos-section aos-section-alt" id="ceny">
	<div class="aos-cnt">
		<div class="aos-sh nero-ai-reveal">
			<span class="aos-eyebrow">Бюджет</span>
			<h2>Сколько стоит ai обучение сотрудников</h2>
			<p><strong>Определение:</strong> стоимость зависит от объёма базы, числа сценариев, интеграций и контура данных. Ориентир Nero Network — <strong>200 тыс.–1,2 млн ₽</strong>.</p>
		</div>
		<div class="aos-table-wrap nero-ai-reveal">
			<table class="aos-table" aria-label="Факторы цены">
				<thead><tr><th>Фактор</th><th>Влияние на бюджет</th></tr></thead>
				<tbody>
					<tr><td>Объём базы знаний</td><td>30–100 документов (пилот) vs 200+ (продакшен)</td></tr>
					<tr><td>Число сценариев</td><td>1–2 (онбординг) vs 5+ (продажи, поддержка, аттестация)</td></tr>
					<tr><td>Интеграции</td><td>Telegram-бот vs CRM + HRIS + LMS</td></tr>
					<tr><td>ИИ-тренажёр</td><td>Опция: симуляция диалогов с обратной связью</td></tr>
					<tr><td>Контур данных</td><td>Облако vs on-premise (152-ФЗ, госсектор)</td></tr>
				</tbody>
			</table>
		</div>
		<div class="aos-grid-2 nero-ai-reveal" style="margin-top:32px">
			<div class="aos-card"><h3>Малый бизнес (до 50 чел.)</h3><p>Пилот с Telegram-ботом и 30–50 документами. От <strong>200 тыс. ₽</strong>, 4–6 недель.</p></div>
			<div class="aos-card"><h3>Компании 50–500 чел.</h3><p>Оптимальный сегмент: пилот на одном отделе → масштабирование. До <strong>1,2 млн ₽</strong> под ключ.</p></div>
		</div>
	</div>
</section>

<section class="aos-section" id="keisy">
	<div class="aos-cnt">
		<div class="aos-sh nero-ai-reveal">
			<span class="aos-eyebrow">Кейсы</span>
			<h2>Кейсы и примеры внедрения AI-наставника</h2>
		</div>
		<div class="aos-case-grid nero-ai-reveal">
			<div class="aos-case-card">
				<div class="aos-case-tag">Ростелеком</div>
				<h3>40+ ИИ-менторов, 6000+ обученных</h3>
				<p>Чат-бот обрабатывает до 70% запросов. Умный поиск по документам — в 30 раз быстрее ручного.</p>
				<div class="aos-metric"><span class="num">70%</span><span class="lbl">типовых вопросов без человека</span></div>
			</div>
			<div class="aos-case-card">
				<div class="aos-case-tag">Альфа-Банк</div>
				<h3>ИИ-тренажёры для 14 сценариев</h3>
				<p>Оценка клиентов +13%, время обработки звонка −6,4%.</p>
				<div class="aos-metric"><span class="num">+13%</span><span class="lbl">оценка клиентов</span></div>
			</div>
			<div class="aos-case-card">
				<div class="aos-case-tag">Зетта Страхование</div>
				<h3>1146 тренировок без наставников</h3>
				<p>+36% к средней оценке качества звонков за 4 месяца.</p>
				<div class="aos-metric"><span class="num">+36%</span><span class="lbl">качество звонков</span></div>
			</div>
		</div>
	</div>
</section>

<section class="aos-section aos-section-alt" id="riski">
	<div class="aos-cnt">
		<div class="aos-sh nero-ai-reveal">
			<span class="aos-eyebrow">Риски и комплаенс</span>
			<h2>Риски внедрения и как мы их закрываем</h2>
		</div>
		<div class="aos-table-wrap nero-ai-reveal">
			<table class="aos-table" aria-label="Возражения и ответы">
				<thead><tr><th>Возражение</th><th>Ответ Nero Network</th></tr></thead>
				<tbody>
					<tr><td>«AI будет врать»</td><td>RAG по вашим документам + цитирование + модерация на пилоте</td></tr>
					<tr><td>«У нас уже есть LMS»</td><td>Наставник дополняет LMS, не дублирует</td></tr>
					<tr><td>«Дорого»</td><td>Пилот от 200 тыс.; сравните со штатом наставников</td></tr>
					<tr><td>«Данные утекут»</td><td>On-premise, 152-ФЗ, политика AI, запрет Shadow AI</td></tr>
				</tbody>
			</table>
		</div>
	</div>
</section>

<section class="aos-section" id="vybor">
	<div class="aos-cnt">
		<div class="aos-sh aos-left nero-ai-reveal">
			<span class="aos-eyebrow">Выбор подхода</span>
			<h2>Под ключ или самостоятельно — что выбрать</h2>
			<p>Для SaaS-пилота программист не нужен. Для RAG с ACL, интеграцией CRM/HRIS, on-premise и ИИ-тренажёром — нужна команда. Nero Network берёт разработку на себя.</p>
		</div>
	</div>
</section>

<section class="aos-section aos-section-alt" id="faq">
	<div class="aos-cnt">
		<div class="aos-sh nero-ai-reveal">
			<span class="aos-eyebrow">FAQ</span>
			<h2>FAQ по AI-обучению сотрудников</h2>
		</div>
		<div class="aos-faq nero-ai-reveal" id="aos-faq-list">
			<div class="aos-faq-item"><div class="aos-faq-q">Как внедрить ai обучение сотрудников с нуля?</div><div class="aos-faq-a"><p>Аудит материалов → 30–100 документов → пилот на 10–30 сотрудниках (4–6 недель) → метрики → масштабирование. Nero Network ведёт весь цикл.</p></div></div>
			<div class="aos-faq-item"><div class="aos-faq-q">Сколько стоит ai обучение сотрудников под ключ?</div><div class="aos-faq-a"><p>Пилот: 200–400 тыс. ₽, 4–6 недель. Под ключ: 500 тыс.–1,2 млн ₽, 6–12 недель.</p></div></div>
			<div class="aos-faq-item"><div class="aos-faq-q">Какие задачи решает в продажах и поддержке?</div><div class="aos-faq-a"><p>Продажи: ИИ-тренажёр диалогов (+36% качество звонков у Зетта). Поддержка: автоответы по регламентам (до 70% у Ростелеком).</p></div></div>
			<div class="aos-faq-item"><div class="aos-faq-q">Можно ли для малого бизнеса?</div><div class="aos-faq-a"><p>Да: Telegram-бот + 30–50 документов, от 200 тыс. ₽, 1–2 сценария.</p></div></div>
			<div class="aos-faq-item"><div class="aos-faq-q">Нужны ли программисты?</div><div class="aos-faq-a"><p>Для SaaS-пилота — нет. Для кастомного RAG с интеграциями — да; Nero Network берёт разработку на себя.</p></div></div>
			<div class="aos-faq-item"><div class="aos-faq-q">Заменит ли AI наставника живого?</div><div class="aos-faq-a"><p>Нет. AI закрывает типовые вопросы и тренировки; человек — за регламенты, сложные кейсы и стратегию.</p></div></div>
		</div>
	</div>
</section>

<section class="aos-section" id="zapusk">
	<div class="aos-cnt">
		<div class="aos-sh nero-ai-reveal">
			<span class="aos-eyebrow">Старт проекта</span>
			<h2>Запустить AI-обучение</h2>
			<p>Nero Network создаёт AI-наставника по материалам вашей компании — под ключ, с измеримым результатом и без vendor lock-in.</p>
		</div>
		<div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
			<div class="ym-cta-block__body">
				<p class="ym-cta-block__headline">Готовы запустить AI-обучение сотрудников?</p>
				<p class="ym-cta-block__sub">Проведём аудит материалов, предложим пилотный сценарий и покажем демо наставника на ваших документах. Пилот — от 200 тыс. ₽, 4–6 недель; внедрение под ключ — до 1,2 млн ₽.</p>
				<div class="ym-cta-block__actions">
					<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
					<a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
				</div>
			</div>
		</div>
	</div>
</section>

</div><!-- .aos-content -->

<?php
$aos_page_url = trailingslashit( get_permalink() );
$aos_site_url = trailingslashit( home_url( '/' ) );
$aos_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$aos_schema   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $aos_site_url . '#organization',
			'name'  => $aos_brand,
			'url'   => $aos_site_url,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $aos_site_url . '#website',
			'url'       => $aos_site_url,
			'name'      => $aos_brand,
			'publisher' => [ '@id' => $aos_site_url . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $aos_page_url . '#webpage',
			'url'         => $aos_page_url,
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $aos_site_url . '#website' ],
			'about'       => [ '@id' => $aos_site_url . '#organization' ],
		],
		[
			'@type' => 'BreadcrumbList',
			'@id'   => $aos_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $aos_site_url ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $aos_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $aos_page_url . '#service',
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'url'         => $aos_page_url,
			'provider'    => [ '@id' => $aos_site_url . '#organization' ],
		],
		[
			'@type' => 'FAQPage',
			'@id'   => $aos_page_url . '#faq',
			'mainEntity' => [
				[ '@type' => 'Question', 'name' => 'Как внедрить ai обучение сотрудников с нуля?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит материалов → 30–100 документов → пилот на 10–30 сотрудниках (4–6 недель) → метрики → масштабирование. Nero Network ведёт весь цикл.' ] ],
				[ '@type' => 'Question', 'name' => 'Сколько стоит ai обучение сотрудников под ключ?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пилот: 200–400 тыс. ₽, 4–6 недель. Под ключ: 500 тыс.–1,2 млн ₽, 6–12 недель.' ] ],
				[ '@type' => 'Question', 'name' => 'Какие задачи решает в продажах и поддержке?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Продажи: ИИ-тренажёр диалогов (+36% качество звонков у Зетта). Поддержка: автоответы по регламентам (до 70% у Ростелеком).' ] ],
				[ '@type' => 'Question', 'name' => 'Можно ли для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да: Telegram-бот + 30–50 документов, от 200 тыс. ₽, 1–2 сценария.' ] ],
				[ '@type' => 'Question', 'name' => 'Нужны ли программисты?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Для SaaS-пилота — нет. Для кастомного RAG с интеграциями — да; Nero Network берёт разработку на себя.' ] ],
				[ '@type' => 'Question', 'name' => 'Заменит ли AI наставника живого?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. AI закрывает типовые вопросы и тренировки; человек — за регламенты, сложные кейсы и стратегию.' ] ],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $aos_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("aos-mentor-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");
  let cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    const wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 140;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 10;
    scale = Math.min(cw / 420, ch / 160) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  const C = {
    outline: "#94a3b8",
    podium: "#1e293b",
    screen: "#0f172a",
    accent: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    orbDoc: "#93c5fd",
    orbReg: "#a7f3d0",
    orbScript: "#fbcfe8",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "rgba(15,23,42,.92)"
  };

  function roundRect(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.lineWidth = 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  /* Транспорт: дуговые семантические рельсы */
  class SemanticArc {
    constructor() { this.phase = 0; }
    draw(ctx) {
      this.phase = (frame * 0.02) % (Math.PI * 2);
      ctx.save();
      ctx.strokeStyle = "rgba(121,242,255,.25)";
      ctx.lineWidth = 2;
      for (let i = 0; i < 3; i++) {
        ctx.beginPath();
        const r = 90 + i * 22;
        ctx.arc(0, -20, r, Math.PI * 0.15, Math.PI * 0.85);
        ctx.stroke();
      }
      ctx.restore();
    }
    orbPos(t, lane) {
      const r = 90 + lane * 22;
      const a = Math.PI * 0.15 + (Math.PI * 0.7) * t;
      return { x: Math.cos(a) * r, y: -20 + Math.sin(a) * r };
    }
  }

  /* Центральный объект: пульт AI-наставника */
  class MentorPodium {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.cycle = 0;
      this.badgePulse = 0;
    }
    draw(ctx) {
      this.cycle = (frame * 0.04) % 220;
      ctx.save();
      ctx.translate(this.x, this.y);

      roundRect(ctx, -55, -8, 110, 70, 8, C.podium, C.outline);
      roundRect(ctx, -48, -55, 96, 52, 6, C.screen, C.accent);

      const phases = ["ingest", "answer", "practice", "attest"];
      const phaseIdx = Math.floor(this.cycle / 55) % 4;

      if (phaseIdx === 0) {
        roundRect(ctx, -38, -42, 76, 10, 2, "rgba(121,242,255,.3)", null);
        roundRect(ctx, -38, -28, 56, 6, 1, "#334155", null);
        roundRect(ctx, -38, -18, 64, 6, 1, "#334155", null);
      } else if (phaseIdx === 1) {
        roundRect(ctx, -40, -44, 28, 8, 2, C.violet, null);
        ctx.fillStyle = C.accent;
        ctx.font = "bold 7px sans-serif";
        ctx.fillText("Q: регламент?", -10, -38);
        roundRect(ctx, -10, -32, 42, 14, 3, "rgba(34,197,94,.25)", C.green);
        ctx.fillStyle = "#bbf7d0";
        ctx.font = "6px sans-serif";
        ctx.fillText("цитата §4.2", -6, -22);
      } else if (phaseIdx === 2) {
        roundRect(ctx, -35, -40, 70, 22, 4, "rgba(139,92,246,.2)", C.violet);
        ctx.fillStyle = "#e9d5ff";
        ctx.font = "6px sans-serif";
        ctx.fillText("тренажёр диалога", -28, -26);
      } else {
        this.badgePulse = Math.sin(frame * 0.15) * 4;
        ctx.save();
        ctx.translate(0, -50 + this.badgePulse);
        ctx.fillStyle = C.green;
        ctx.beginPath();
        ctx.moveTo(0, -14);
        ctx.lineTo(12, 4);
        ctx.lineTo(-12, 4);
        ctx.closePath();
        ctx.fill();
        ctx.strokeStyle = "#fff";
        ctx.lineWidth = 1.5;
        ctx.stroke();
        ctx.restore();
      }

      for (let i = 0; i < 3; i++) {
        const prg = ((this.cycle + i * 18) % 55) / 55;
        ctx.strokeStyle = `rgba(121,242,255,${0.3 + prg * 0.5})`;
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.arc(0, 18, 14 + i * 6, -Math.PI / 2, -Math.PI / 2 + prg * Math.PI * 1.6);
        ctx.stroke();
      }
      ctx.restore();
    }
  }

  class DocumentOrb {
    constructor(lane, color, delay) {
      this.lane = lane;
      this.color = color;
      this.delay = delay;
    }
    draw(ctx, arc) {
      const t = ((frame * 0.008 + this.delay) % 1);
      const p = arc.orbPos(t, this.lane);
      roundRect(ctx, p.x - 6, p.y - 6, 12, 12, 3, this.color, C.outline);
    }
  }

  class Agent {
    constructor(x, y, color, role, stepTrig, dialogs) {
      this.x = x; this.y = y;
      this.baseX = x; this.baseY = y;
      this.color = color;
      this.role = role;
      this.stepTrig = stepTrig;
      this.dialogs = dialogs;
      this.timer = Math.random() * 100;
    }
    draw(ctx) {
      this.timer += 0.04;
      const prg = (frame * 0.04) % 220;
      let tx = 0, ty = 25;
      let isMoving = false;
      let faceDir = 1;

      if (prg >= this.stepTrig && prg < this.stepTrig + 30) {
        const local = prg - this.stepTrig;
        isMoving = local < 15;
        faceDir = local < 15 ? 1 : -1;
        const t = local < 15 ? local / 15 : (local - 15) / 15;
        const fromX = this.baseX, fromY = this.baseY;
        const toX = tx, toY = ty - 10;
        this.x = isMoving || local >= 15 ? fromX + (toX - fromX) * t : toX;
        this.y = isMoving || local >= 15 ? fromY + (toY - fromY) * t : toY;
      } else {
        this.x = this.baseX;
        this.y = this.baseY;
      }

      if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
        const txt = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
        createBubble(this.x, this.y - 18, txt, 200);
      }

      const bob = Math.sin(this.timer * 2) * 1.5;
      ctx.save();
      ctx.translate(this.x, this.y);
      roundRect(ctx, -8, -4 + bob, 16, 12, 3, this.color, C.outline);
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(0, -10 - bob, 7, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.lineWidth = 1.5;
      ctx.stroke();
      ctx.restore();
    }
  }

  const entities = [];
  const bubbles = [];
  const arc = new SemanticArc();
  const podium = new MentorPodium(0, 5);

  entities.push(arc);
  entities.push(podium);
  entities.push(new DocumentOrb(0, C.orbDoc, 0));
  entities.push(new DocumentOrb(1, C.orbReg, 0.33));
  entities.push(new DocumentOrb(2, C.orbScript, 0.66));

  entities.push(new Agent(-70, 45, C.agentYellow, "1_architect", 10, [
    "Карта модулей готова", "Сценарий онбординга", "Программа на 4 недели"
  ]));
  entities.push(new Agent(-45, 55, C.agentGreen, "2_seo", 55, [
    "Пробел в базе знаний", "70% вопросов закрыты", "HR-дашборд обновлён"
  ]));
  entities.push(new Agent(-20, 48, C.agentBlue, "3_coder", 100, [
    "RAG переиндексирован", "Цитата из §4.2", "Guardrails активны"
  ]));
  entities.push(new Agent(20, 55, C.agentPink, "4_designer", 145, [
    "Микроурок 3 мин", "Тренажёр настроен", "UX чата готов"
  ]));
  entities.push(new Agent(55, 45, C.agentPurple, "5_deployer", 190, [
    "Пилот на 30 чел.", "Telegram подключён", "Аттестация запущена"
  ]));

  function createBubble(x, y, text, life = 200) {
    bubbles.push({ x, y, text, life, maxLife: life });
  }

  if (frame === 0) {
    createBubble(0, -30, "Документы → наставник → аттестация", 280);
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    arc.draw(ctx);
    [entities[2], entities[3], entities[4]].forEach(o => o.draw(ctx, arc));
    podium.draw(ctx);
    entities.slice(5).forEach(a => a.draw(ctx));

    if (frame % 110 === 55) createBubble(-20, -35, "Орбита знаний: ingest", 160);
    if (frame % 110 === 0) createBubble(15, -40, "Ответ с цитатой регламента", 160);
    if (frame % 220 === 180) createBubble(0, -55, "Badge: знание усвоено ✓", 200);

    for (let i = bubbles.length - 1; i >= 0; i--) {
      const b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      const alpha = Math.min(1, b.life / 40);
      ctx.globalAlpha = alpha;
      const tw = ctx.measureText(b.text).width + 12;
      roundRect(ctx, b.x - tw / 2, b.y - 18, tw, 16, 4, C.bubbleBg, C.accent);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "7px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 7);
      ctx.globalAlpha = 1;
    }
    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  engineloop();

  document.querySelectorAll(".aos-hero .nero-ai-reveal").forEach((el, i) => {
    setTimeout(() => el.classList.add("nero-ai-active"), 80 + i * 120);
  });
});
</script>

<script>
document.querySelectorAll('.aos-faq-q').forEach(function(q){
	q.addEventListener('click',function(){ q.parentElement.classList.toggle('open'); });
});
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
