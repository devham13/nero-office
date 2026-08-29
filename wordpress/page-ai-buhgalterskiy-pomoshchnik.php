<?php
/**
 * Template Name: AI бухгалтерский помощник: внедрение и настройка под ключ
 * Description: SEO-лендинг — AI бухгалтерский помощник для типовых вопросов клиентов бухгалтерской фирмы.
 */

$page_seo_title       = 'AI бухгалтерский помощник: внедрение и настройка под ключ';
$page_seo_description = 'AI бухгалтерский помощник для типовых вопросов клиентов: ответы по базе компании, сложные кейсы — бухгалтеру. Внедрение под ключ, CRM, кейсы, цены.';

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
    ['label' => 'Зачем',        'href' => '#zachem'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Вопросы',      'href' => '#voprosy'],
    ['label' => 'Внедрение',    'href' => '#etapy'],
    ['label' => 'Интеграции',   'href' => '#integracii'],
    ['label' => 'Цена',         'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Настроить помощника';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = '#kak-rabotaet';

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

/* Скрыть шапку Kadence */
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

.abp-hero {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.buh-intro-text p { text-align: left !important; }
.buh-content a { color: var(--buh-cyan); text-decoration: underline; text-underline-offset: 2px; }
.buh-content a:hover { color: var(--buh-accent); }

.buh-toc-outer { padding: 0 0 clamp(36px, 4.5vw, 56px); }
.buh-toc {
  display: flex; flex-wrap: wrap; gap: 9px; justify-content: center;
}
.buh-toc a {
  display: inline-block; padding: 9px 18px;
  background: rgba(255,255,255,.072); border: 1px solid rgba(255,255,255,.10);
  border-radius: 999px; font-size: 13px; font-weight: 600; color: var(--buh-muted);
  text-decoration: none !important; transition: border-color .2s, color .2s, background .2s;
}
.buh-toc a:hover {
  border-color: rgba(245,197,24,.42); color: var(--buh-accent);
  background: rgba(245,197,24,.08);
}

.buh-content .ym-cta-block__icon { font-size: 36px; margin-bottom: 14px; }
.buh-content .ym-link--accent { color: var(--buh-accent) !important; text-decoration: underline !important; }
.nero-ai-delay-1 { transition-delay: .12s; }
.nero-ai-delay-2 { transition-delay: .24s; }
@media(max-width:600px){ .buh-content .ym-cta-block { padding: 28px 20px; } }
/* === BUH CONTENT ROOT — тёмная тема (как vna-/a1c-) === */
.buh-content{
  --buh-bg:#050711;--buh-bg2:#080b17;
  --buh-text:#e6edf7;--buh-muted:#9aa8bd;--buh-soft:#c7d2e5;--buh-heading:#fff;
  --buh-border:rgba(255,255,255,.10);
  --buh-accent:#f5c518;--buh-violet:#8b5cf6;--buh-cyan:#79f2ff;
  --buh-green:#22c55e;--buh-amber:#f59e0b;
  --buh-btn-from:#2563eb;--buh-btn-to:#7c3aed;
  --buh-r:18px;--buh-r-lg:24px;--buh-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--buh-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.buh-content *,.buh-content *::before,.buh-content *::after{box-sizing:border-box;}
.buh-content p{color:var(--buh-muted);line-height:1.72;margin:0 0 1em;font-size:15px;}
.buh-content p:last-child{margin-bottom:0;}
.buh-content h2,.buh-content h3,.buh-content h4{color:var(--buh-heading);letter-spacing:-.04em;margin:0 0 .7em;}
.buh-content strong{color:var(--buh-soft);}
.buh-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.buh-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--buh-muted);font-size:14.5px;line-height:1.65;}
.buh-content ul li::before{content:'›';position:absolute;left:0;color:var(--buh-accent);font-weight:700;}
.buh-cnt{width:min(var(--buh-container),calc(100% - 40px));margin:0 auto;}
.buh-section{padding:clamp(56px,7vw,96px) 0;}
.buh-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.buh-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.buh-sh.buh-left{margin-left:0;text-align:left;}
.buh-sh h2{font-size:clamp(24px,3.6vw,44px);line-height:1.08;margin-bottom:12px;}
.buh-sh p{font-size:clamp(15px,1.5vw,17px);max-width:680px;margin:0 auto;}
.buh-sh.buh-left p{margin-left:0;}
.buh-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--buh-accent);margin-bottom:12px;}
.buh-gt{background:linear-gradient(92deg,#fff 0%,var(--buh-accent) 44%,var(--buh-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
/* intro */
.buh-intro{padding:clamp(40px,5vw,72px) 0;border-bottom:1px solid rgba(255,255,255,.06);}
.buh-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:center;}
.buh-intro-text{padding-left:20px;position:relative;}
.buh-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--buh-accent),var(--buh-violet));}
.buh-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.buh-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.buh-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--buh-heading);margin-bottom:4px;}
.buh-kpi-card .kl{font-size:11px;color:var(--buh-muted);line-height:1.4;}
@media(max-width:900px){.buh-intro-grid{grid-template-columns:1fr;}}
/* cards / grid */
.buh-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--buh-border);border-radius:var(--buh-r-lg);padding:26px;}
.buh-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.buh-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.buh-grid-2,.buh-grid-3{grid-template-columns:1fr;}}
/* categories */
.buh-cat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:28px;}
.buh-cat-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:20px;}
.buh-cat-item .buh-cat-ic{font-size:22px;margin-bottom:8px;}
.buh-cat-item h4{font-size:15px;margin-bottom:6px;}
.buh-cat-item p{font-size:13px;margin:0;}
@media(max-width:768px){.buh-cat-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:480px){.buh-cat-grid{grid-template-columns:1fr;}}
/* table */
.buh-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.buh-table{width:100%;border-collapse:collapse;font-size:14px;}
.buh-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--buh-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);}
.buh-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--buh-text);vertical-align:top;}
.buh-table tr:last-child td{border-bottom:none;}
.buh-table tr:hover td{background:rgba(255,255,255,.03);}
/* scenarios */
.buh-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--buh-r);padding:24px;margin-bottom:14px;}
.buh-scenario--ok{border-color:rgba(34,197,94,.35);}
.buh-scenario--esc{border-color:rgba(245,158,11,.35);}
.buh-scenario h3{font-size:17px;}
.buh-scenario p{font-size:14.5px;}
/* timeline */
.buh-timeline{position:relative;padding-left:40px;}
.buh-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--buh-accent),var(--buh-violet));opacity:.35;}
.buh-tl-item{position:relative;margin-bottom:28px;}
.buh-tl-dot{position:absolute;left:-32px;top:4px;width:14px;height:14px;border-radius:50%;background:var(--buh-accent);}
/* leadmagnet */
.buh-leadmagnet{background:linear-gradient(135deg,rgba(245,197,24,.1),rgba(139,92,246,.08));border:1px solid rgba(245,197,24,.22);border-radius:20px;padding:28px 32px;margin:28px 0;}
.buh-leadmagnet h3{font-size:20px;margin-bottom:8px;}
/* channels */
.buh-channels{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-top:24px;}
.buh-channel{padding:14px 22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;font-size:14px;font-weight:600;text-align:center;min-width:120px;}
/* roi */
.buh-roi{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin:24px 0;}
.buh-roi-item{text-align:center;padding:20px 14px;background:rgba(255,255,255,.055);border-radius:16px;border:1px solid rgba(255,255,255,.09);}
.buh-roi-item strong{display:block;font-size:clamp(22px,3vw,32px);color:var(--buh-accent);margin-bottom:4px;}
@media(max-width:768px){.buh-roi{grid-template-columns:1fr 1fr;}}
/* cases */
.buh-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:24px;}
.buh-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--buh-green);margin-bottom:8px;}
/* disclaimer */
.buh-disclaimer{background:rgba(245,158,11,.08);border-left:4px solid var(--buh-amber);border-radius:0 14px 14px 0;padding:24px 28px;margin-top:24px;}
.buh-disclaimer blockquote{margin:0;font-size:14px;color:var(--buh-soft);line-height:1.7;font-style:italic;}
/* faq */
.buh-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.buh-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.buh-faq-q{padding:18px 22px;font-size:16px;font-weight:700;color:var(--buh-heading);cursor:pointer;display:flex;justify-content:space-between;gap:12px;user-select:none;}
.buh-faq-q::after{content:'▾';color:var(--buh-accent);transition:transform .25s;}
.buh-faq-item.open .buh-faq-q::after{transform:rotate(180deg);}
.buh-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .35s ease,padding .25s;font-size:14.5px;color:var(--buh-muted);line-height:1.72;}
.buh-faq-item.open .buh-faq-a{max-height:500px;padding:0 22px 18px;}
/* cta final */
.buh-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:28px;list-style:none;padding:0;}
.buh-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--buh-muted);}
.buh-cta-checklist li::before{content:'✓';color:var(--buh-green);font-weight:800;}
/* ym-cta (Artur) */
.buh-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.buh-content .ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.buh-content .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
.buh-content .ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.buh-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.buh-content .ym-cta-block__sub{color:var(--buh-muted);font-size:15px;margin:0 auto 20px;max-width:600px;line-height:1.7;}
.buh-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.buh-content .ym-btn{display:inline-flex;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.buh-content .ym-btn--accent{background:linear-gradient(135deg,var(--buh-btn-from),var(--buh-btn-to));color:#fff!important;}
.buh-content .ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--buh-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-buhgalterskiy-pomoshchnik-page buh-ai-page" role="main" tabindex="-1">

<section class="nero-ai-hero abp-hero" id="abp-hero" aria-labelledby="abp-hero-title">
<style>
/* ── Hero ai-buhgalterskiy-pomoshchnik: самодостаточные стили ── */
.abp-hero {
  --abp-gold: #f5c518;
  --abp-violet: #8b5cf6;
  --abp-green: #22c55e;
  --abp-cyan: #38bdf8;
  --abp-text: #e6edf7;
  --abp-muted: #9aa8bd;
  --abp-soft: #c7d2e5;
  --abp-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.abp-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.abp-hero::after {
  content: "";
  position: absolute;
  left: 6%;
  top: 14%;
  width: 560px;
  height: 560px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139,92,246,.12), transparent 66%);
  filter: blur(8px);
  animation: abpHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes abpHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.abp-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.abp-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.abp-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.abp-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--abp-gold) 40%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.abp-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(139, 92, 246, 0.28);
  border-radius: 999px;
  background: rgba(139, 92, 246, 0.1);
  color: #c4b5fd !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.abp-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--abp-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.abp-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.abp-hero .nero-ai-badge {
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
.abp-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.abp-hero .nero-ai-btn {
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
.abp-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.abp-hero .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--abp-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.abp-hero .nero-ai-btn-secondary {
  color: var(--abp-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.abp-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--abp-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.abp-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.abp-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.abp-hero .nero-ai-dots { display: flex; gap: 7px; }
.abp-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.abp-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.abp-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.abp-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.abp-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.abp-hero .nero-ai-window-body { padding: 16px; }
.abp-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.abp-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.abp-hero .nero-ai-live-pill {
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
.abp-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: abpPulse 1.6s infinite;
}
@keyframes abpPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.abp-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.abp-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.abp-hero .nero-ai-metric span {
  display: block;
  color: var(--abp-muted);
  font-size: 11px;
  font-weight: 700;
}
.abp-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.abp-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.abp-hero .abp-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.2);
  background: radial-gradient(ellipse at 28% 42%, rgba(139,92,246,.09), rgba(6,10,24,.94) 72%);
}
.abp-hero #abp-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.abp-hero .abp-stage-pill {
  position: absolute;
  bottom: 10px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 6px;
  z-index: 2;
  pointer-events: none;
}
.abp-hero .abp-stage-pill span {
  padding: 5px 10px;
  border-radius: 999px;
  background: rgba(15, 23, 42, 0.82);
  border: 1px solid rgba(255,255,255,.12);
  color: #cbd5e1;
  font-size: 10px;
  font-weight: 700;
}
.abp-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.abp-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.abp-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(139,92,246,.14);
  color: #c4b5fd;
  font-size: 11px;
  font-weight: 800;
}
.abp-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.abp-hero .nero-ai-task span {
  color: var(--abp-muted);
  font-size: 11px;
}
.abp-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.abp-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.abp-hero .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .abp-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .abp-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .abp-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .abp-hero .nero-ai-window-body { padding: 12px; }
  .abp-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .abp-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Клиентский FAQ · внедрение под ключ</p>
      <h1 id="abp-hero-title">AI бухгалтерский помощник: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Отвечает клиентам на типовые вопросы по базе вашей компании — сложные случаи передаёт бухгалтеру без потери контроля</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">FAQ по регламентам</li>
        <li class="nero-ai-badge">Telegram / WhatsApp</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">CRM и тикеты</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Настроить помощника</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI бухгалтерского помощника для клиентских вопросов">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Клиентская линия → AI-ответ</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Вопросов сегодня</span>
              <strong>47</strong>
              <small>Telegram, WhatsApp, виджет</small>
            </div>
            <div class="nero-ai-metric">
              <span>Автоответов</span>
              <strong>68%</strong>
              <small>по базе знаний фирмы</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ср. время ответа</span>
              <strong>12 сек</strong>
              <small>типовой FAQ</small>
            </div>
            <div class="nero-ai-metric">
              <span>Эскалаций</span>
              <strong>3</strong>
              <small>к живому бухгалтеру</small>
            </div>
          </div>

          <div class="abp-dash-canvas-wrap" aria-hidden="false">
            <canvas id="abp-hero-canvas" role="img" aria-label="Анимация: клиентские вопросы классифицируются, типовые закрываются по базе знаний, сложные уходят бухгалтеру"></canvas>
            <div class="abp-stage-pill" aria-hidden="true">
              <span>Приём вопроса</span>
              <span>Поиск в базе</span>
              <span>Автоответ</span>
              <span>Эскалация</span>
            </div>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента клиентских обращений">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">УСН</span>
              <div><strong>Срок сдачи отчёта по УСН</strong><span>Регламент фирмы → мгновенный ответ</span></div>
              <span class="nero-ai-status">закрыто AI</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">Док</span>
              <div><strong>Какие документы к кварталу?</strong><span>Чек-лист из базы знаний</span></div>
              <span class="nero-ai-status">закрыто AI</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">НДС</span>
              <div><strong>Как выставить счёт-фактуру?</strong><span>Шаблон + ссылка на регламент</span></div>
              <span class="nero-ai-status">закрыто AI</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Что выгоднее: патент или УСН?</strong><span>confidence 0.41 — тикет бухгалтеру</span></div>
              <span class="nero-ai-status nero-ai-status--amber">эскалация</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * abp-hero-engine — «Диспетчерская клиентской бухгалтерской линии»
 * Мир: MessengerBubbleStream → ClassifierMatrix → FaqAnswerConsole → EscalationTicketGate
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("abp-hero-canvas");
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
    bubbleClient: "#dbeafe",
    bubbleTypical: "#d1fae5",
    bubbleComplex: "#fecaca",
    shelf: "#334155",
    shelfDoc: "#f8fafc",
    matrixOn: "#8b5cf6",
    matrixOff: "rgba(71,85,105,0.45)",
    consoleBg: "#1e293b",
    consoleScreen: "#0f172a",
    ticketAmber: "#f59e0b",
    disclaimer: "#22c55e",
    channelTg: "#38bdf8",
    channelWa: "#34d399",
    channelWeb: "#c4b5fd",
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

  function drawBubble(ctx, x, y, r, fill, label, isComplex) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    ctx.arc(x, y, r, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = isComplex ? "#ef4444" : C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 2);
  }

  /* Орбиты каналов — ClientChannelOrb */
  function ClientChannelOrb() {
    this.angle = 0;
  }
  ClientChannelOrb.prototype.draw = function (ctx) {
    this.angle += 0.012;
    var channels = [
      { color: C.channelTg, label: "TG", orbit: 52 },
      { color: C.channelWa, label: "WA", orbit: 68 },
      { color: C.channelWeb, label: "WEB", orbit: 84 }
    ];
    channels.forEach(function (ch, i) {
      var a = this.angle + i * 2.1;
      var ox = -175 + Math.cos(a) * 6;
      var oy = -55 + Math.sin(a) * 6;
      ctx.strokeStyle = "rgba(148,163,184,0.25)";
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.ellipse(ox, oy, ch.orbit * 0.22, ch.orbit * 0.14, 0, 0, Math.PI * 2);
      ctx.stroke();
      var px = ox + Math.cos(a + i) * ch.orbit * 0.22;
      var py = oy + Math.sin(a + i) * ch.orbit * 0.14;
      drawRR(ctx, px - 10, py - 7, 20, 14, 7, ch.color, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(ch.label, px, py + 2);
    }, this);
  };

  /* Поток вопросов по дугам — вместо Conveyor */
  function MessengerBubbleStream() {
    this.items = [
      { path: 0, offset: 0, label: "?", complex: false },
      { path: 1, offset: 55, label: "УСН", complex: false },
      { path: 2, offset: 110, label: "НДС", complex: false },
      { path: 0, offset: 165, label: "!", complex: true }
    ];
  }
  MessengerBubbleStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var paths = [
      { x0: -185, y0: -70, cx1: -120, cy1: -20, x1: -55, y1: 10 },
      { x0: -185, y0: -35, cx1: -105, cy1: 5, x1: -40, y1: 25 },
      { x0: -185, y0: 0, cx1: -100, cy1: 30, x1: -30, y1: 38 }
    ];
    paths.forEach(function (p, idx) {
      ctx.strokeStyle = idx === 2 ? "rgba(239,68,68,0.35)" : "rgba(56,189,248,0.28)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([4, 5]);
      ctx.beginPath();
      ctx.moveTo(p.x0, p.y0);
      ctx.quadraticCurveTo(p.cx1, p.cy1, p.x1, p.y1);
      ctx.stroke();
      ctx.setLineDash([]);
    });

    this.items.forEach(function (it) {
      var p = paths[it.path];
      var t = ((frame * 0.5 + it.offset) % 130) / 130;
      if (t > 0.95) return;
      var mt = 1 - t;
      var bx = mt * mt * p.x0 + 2 * mt * t * p.cx1 + t * t * p.x1;
      var by = mt * mt * p.y0 + 2 * mt * t * p.cy1 + t * t * p.y1;
      var col = it.complex ? C.bubbleComplex : (t < 0.5 ? C.bubbleClient : C.bubbleTypical);
      drawBubble(ctx, bx, by, 9, col, it.label, it.complex);

      if (it.complex && t > 0.72 && prg >= 188) {
        ctx.strokeStyle = "rgba(239,68,68,0.6)";
        ctx.lineWidth = 1.2;
        ctx.beginPath();
        ctx.moveTo(bx, by);
        ctx.quadraticCurveTo(40, -10, 118, -35);
        ctx.stroke();
      }
    });
  };

  /* Стеллаж базы знаний */
  function KnowledgeBaseShelf() {}
  KnowledgeBaseShelf.prototype.draw = function (ctx) {
    drawRR(ctx, -178, -18, 36, 78, 5, C.shelf, C.outline);
    var labels = ["FAQ", "Регл", "Сроки"];
    labels.forEach(function (lb, i) {
      drawRR(ctx, -172, -8 + i * 22, 24, 16, 2, C.shelfDoc, C.outline);
      ctx.fillStyle = "#475569";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(lb, -160, 2 + i * 22);
    });
    ctx.fillStyle = C.agentPurple;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("База", -176, -24);
  };

  /* Матрица классификации */
  function ClassifierMatrix() {
    this.highlight = 0;
  }
  ClassifierMatrix.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -48, -62, 56, 48, 6, "rgba(15,23,42,0.5)", C.outline);
    var cells = ["Типовой", "Докум.", "Сроки", "Сложный"];
    cells.forEach(function (c, i) {
      var cx = -42 + (i % 2) * 26;
      var cy = -54 + Math.floor(i / 2) * 20;
      var on = (prg >= 58 && prg < 130 && i < 3) || (prg >= 188 && i === 3);
      drawRR(ctx, cx, cy, 22, 14, 3, on ? "rgba(139,92,246,0.35)" : C.matrixOff, C.outline);
      ctx.fillStyle = on ? "#e9d5ff" : "#94a3b8";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(c, cx + 11, cy + 9);
    });
  };

  /* Центральная консоль ответов — вместо WebsiteTerminal */
  function FaqAnswerConsole() {
    this.typed = 0;
  }
  FaqAnswerConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -8, -72, 118, 138, 10, C.consoleBg, C.outline);
    drawRR(ctx, 0, -64, 102, 16, [6, 6, 0, 0], "rgba(139,92,246,0.35)", null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("FAQ · ответ", 6, -54);

    drawRR(ctx, 4, -42, 94, 72, 5, C.consoleScreen, C.outline);

    if (prg >= 72 && prg < 188) {
      var lines = ["Срок УСН: 25.04", "Источник: регламент", "Дисклеймер ✓"];
      lines.forEach(function (ln, i) {
        if (prg > 80 + i * 18) {
          ctx.fillStyle = "#cbd5e1";
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.textAlign = "left";
          ctx.fillText(ln, 10, -30 + i * 14);
        }
      });
      if (prg > 150) {
        drawRR(ctx, 58, 8, 34, 14, 3, "rgba(34,197,94,0.25)", C.disclaimer);
        ctx.fillStyle = "#bbf7d0";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("OK", 75, 18);
      }
    }

    if (prg >= 130 && prg < 188) {
      var pulse = 0.5 + Math.sin(frame * 0.15) * 0.3;
      ctx.globalAlpha = pulse;
      ctx.strokeStyle = C.disclaimer;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(51, 0, 22, 0, Math.PI * 2);
      ctx.stroke();
      ctx.globalAlpha = 1;
    }
  };

  /* Штамп дисклеймера */
  function DisclaimerSeal() {
    this.scale = 0;
  }
  DisclaimerSeal.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 145 || prg > 185) { this.scale = 0; return; }
    this.scale = Math.min(1, (prg - 145) / 14);
    ctx.save();
    ctx.translate(30, 22);
    ctx.rotate(-0.12 * this.scale);
    ctx.globalAlpha = this.scale * 0.85;
    ctx.strokeStyle = C.disclaimer;
    ctx.lineWidth = 1.5;
    ctx.strokeRect(-24, -8, 48, 16);
    ctx.fillStyle = C.disclaimer;
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("НЕ НАЛОГ. СОВЕТ", 0, 2);
    ctx.restore();
  };

  /* Ворота эскалации к бухгалтеру */
  function EscalationTicketGate() {
    this.ticketY = 40;
  }
  EscalationTicketGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, 108, -58, 52, 88, 8, "rgba(30,41,59,0.75)", C.outline);
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Бухгалтер", 134, -48);

    if (prg >= 195) {
      this.ticketY = 40 - Math.min(28, (prg - 195) * 1.4);
      drawRR(ctx, 114, this.ticketY, 40, 48, 4, "#fff7ed", C.ticketAmber);
      ctx.fillStyle = "#92400e";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Тикет #47", 118, this.ticketY + 10);
      ctx.fillText("Патент vs УСН", 118, this.ticketY + 22);
      ctx.fillText("контекст ✓", 118, this.ticketY + 34);

      if (prg > 228) {
        ctx.fillStyle = C.disclaimer;
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("Принято", 134, 18);
      }
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
    var prg = (frame * 0.042) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -158, y: 18 },
      "2_seo": { x: -22, y: -48 },
      "3_coder": { x: 38, y: 42 },
      "4_designer": { x: 18, y: -8 },
      "5_deployer": { x: -168, y: -48 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 15) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 15) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 15) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.5) * 1;
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
    if (carryType) {
      drawRR(ctx, -18 * faceDir, -16 - bob, 14, 14, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var channelOrb = new ClientChannelOrb();
  var bubbleStream = new MessengerBubbleStream();
  var knowledgeShelf = new KnowledgeBaseShelf();
  var classifier = new ClassifierMatrix();
  var faqConsole = new FaqAnswerConsole();
  var disclaimer = new DisclaimerSeal();
  var escalation = new EscalationTicketGate();

  entities.push(channelOrb);
  entities.push(bubbleStream);
  entities.push(knowledgeShelf);
  entities.push(classifier);
  entities.push(faqConsole);
  entities.push(disclaimer);
  entities.push(escalation);

  entities.push(new Agent(-140, 55, C.agentYellow, "1_architect", 18, [
    "Срок УСН в регламенте…",
    "Аудит типовых вопросов",
    "Корпус FAQ готов"
  ]));
  entities.push(new Agent(-95, 62, C.agentGreen, "2_seo", 62, [
    "Кластер «документы»",
    "LSI: сроки отчётности",
    "Матрица размечена"
  ]));
  entities.push(new Agent(-50, 58, C.agentBlue, "3_coder", 98, [
    "RAG по базе фирмы",
    "Порог эскалации 0.55",
    "Журнал ответов включён"
  ]));
  entities.push(new Agent(5, 62, C.agentPink, "4_designer", 138, [
    "Дисклеймер на месте",
    "Шаблон ответа клиенту",
    "Не налоговый совет"
  ]));
  entities.push(new Agent(55, 55, C.agentPurple, "5_deployer", 198, [
    "Telegram подключён",
    "Human-in-the-loop ✓",
    "Тикет → бухгалтеру"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  function engineloop() {
    frame++;
    var prg = (frame * 0.042) % 260;
    ctx.save();
    ctx.clearRect(0, 0, cw, ch);
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    if (prg === 62) createBubble(-30, -20, "Типовой FAQ ✓", 200);
    if (prg === 118) createBubble(20, -5, "Источник: регламент фирмы", 200);
    if (prg === 172) createBubble(45, 10, "Клиент не ждёт 30 мин", 200);
    if (prg === 210) createBubble(120, -20, "Тикет → бухгалтеру", 200);

    entities.forEach(function (e) { e.draw(ctx); });

    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 40);
      ctx.globalAlpha = alpha;
      ctx.font = "bold 7px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 16, 6, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 12);
      ctx.globalAlpha = 1;
    }
    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>

<div class="buh-content">

  <!-- 1. INTRO -->
  <section class="buh-intro" id="intro" aria-label="Введение">
    <div class="buh-cnt">
      <div class="buh-intro-grid nero-ai-reveal">
        <div class="buh-intro-text">
          <p class="buh-eyebrow">Коротко · ai бухгалтерия</p>
          <p><strong>AI бухгалтерский помощник</strong> — первая линия клиентского сервиса бухгалтерской фирмы. Отвечает на типовые вопросы строго по базе знаний вашей компании, сложные кейсы передаёт живому бухгалтеру с полным контекстом диалога.</p>
          <p>Клиенты задают одни и те же вопросы десятки раз в день — бухгалтеры отвлекаются. В пиковые периоды очередь растёт, а экспертное время уходит на повторение регламентов, а не на учёт.</p>
        </div>
        <div class="buh-intro-kpi" aria-label="Ключевые показатели">
          <div class="buh-kpi-card"><div class="kv">30–55%</div><div class="kl">типовых обращений можно автоматизировать</div></div>
          <div class="buh-kpi-card"><div class="kv">52%</div><div class="kl">автозакрытие после LLM+RAG (TenChat, 2026)</div></div>
          <div class="buh-kpi-card"><div class="kv">2–4 нед</div><div class="kl">пилот на одном канале</div></div>
          <div class="buh-kpi-card"><div class="kv">150–450К ₽</div><div class="kl">ориентир MVP первой линии</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="buh-toc-outer">
    <div class="buh-cnt">
      <nav class="buh-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#voprosy">Вопросы</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#zayavka">Заявка</a>
      </nav>
    </div>
  </div>

  <!-- 2. ZACHEM -->
  <section class="buh-section" id="zachem">
    <div class="buh-cnt">
      <div class="buh-sh buh-left nero-ai-reveal">
        <span class="buh-eyebrow">Боль → решение</span>
        <h2>Зачем бухгалтерской компании AI-помощник для первичных вопросов клиентов</h2>
        <p>Бухгалтерские компании, аутсорсинг и налоговые консультанты живут в режиме постоянного клиентского потока. Типовые обращения составляют <strong>30–55%</strong> всей линии — их можно закрывать автоматически.</p>
      </div>

      <h3 class="nero-ai-reveal">Какие вопросы клиентов съедают время экспертов</h3>
      <div class="buh-cat-grid nero-ai-reveal">
        <div class="buh-cat-item"><div class="buh-cat-ic" aria-hidden="true">📅</div><h4>Сроки отчётности</h4><p>УСН, НДС, РСВ, ЕНП, НДФЛ 2026</p></div>
        <div class="buh-cat-item"><div class="buh-cat-ic">📄</div><h4>Документы и первичка</h4><p>Акты, УПД, выписки по СНО</p></div>
        <div class="buh-cat-item"><div class="buh-cat-ic">📊</div><h4>Статус задачи</h4><p>Готов ли отчёт, получены ли документы</p></div>
        <div class="buh-cat-item"><div class="buh-cat-ic">💼</div><h4>Зарплата и кадры</h4><p>Сроки выплат, документы при приёме</p></div>
        <div class="buh-cat-item"><div class="buh-cat-ic">🧾</div><h4>НДС и оформление</h4><p>Счёт-фактура, вычеты</p></div>
        <div class="buh-cat-item"><div class="buh-cat-ic">⚠️</div><h4>ИП/ООО / режим</h4><p>Зона human-only — всегда бухгалтер</p></div>
      </div>

      <h3 class="nero-ai-reveal" style="margin-top:36px;">Почему шаблонные ответы в мессенджерах не масштабируются</h3>
      <p class="nero-ai-reveal">Кнопочный бот закрывал <strong>38%</strong> обращений; LLM-агент с базой знаний фирмы — <strong>52%</strong> (TenChat, 2026). Разница в способности уточнять контекст СНО, штата и периода.</p>
      <!-- INTERNAL-LINKS:INSERT -->
      <p class="nero-ai-reveal"><strong>Итог:</strong> AI окупается возвратом времени экспертов — «как будто с линии ушёл ещё один бухгалтер».</p>
    </div>
  </section>

  <!-- 3. CHTO-ETO -->
  <section class="buh-section buh-section-alt" id="chto-eto">
    <div class="buh-cnt">
      <div class="buh-sh nero-ai-reveal">
        <span class="buh-eyebrow">Определение</span>
        <h2>Что такое AI бухгалтерский помощник и чем он отличается от ERP и CRM-ботов</h2>
        <p>Диалоговая система первой линии: отвечает по регламентам <strong>конкретной фирмы</strong>, не из интернета. Не автоматизация учёта в 1С.</p>
      </div>

      <h3 class="nero-ai-reveal">Клиентский FAQ vs автоматизация документов в 1С</h3>
      <div class="buh-table-wrap nero-ai-reveal">
        <table class="buh-table">
          <thead><tr><th>Задача</th><th>AI для 1С/ERP</th><th>AI бухгалтерский помощник</th></tr></thead>
          <tbody>
            <tr><td>Кто спрашивает</td><td>Бухгалтер / система</td><td>Клиент фирмы</td></tr>
            <tr><td>Что автоматизируется</td><td>Первичка, сверки, проводки</td><td>FAQ, сроки, документы, статус</td></tr>
            <tr><td>Источник ответа</td><td>Учётные данные, OCR</td><td>База знаний и регламенты фирмы</td></tr>
            <tr><td>Контроль</td><td>Сверка с 1С</td><td>Human-in-the-loop + дисклеймер</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">Если нужен AI для документооборота в учётной системе — см. <a href="/ai-1c-erp/">AI для 1С и ERP</a>. Здесь фокус: <strong>клиент спрашивает — фирма отвечает быстро</strong>.</p>

      <h3 class="nero-ai-reveal">Ответы по базе знаний компании, а не «общие советы из интернета»</h3>
      <p class="nero-ai-reveal">RAG: извлечение фрагментов из регламентов, чек-листов, шаблонов. Принцип «Главбух Нейро»: <strong>не выдумывает ответы</strong>. В бухгалтерии цена неточного ответа слишком высока.</p>
    </div>
  </section>

  <!-- === БОРИС: ВИЗУАЛЬНЫЙ БЛОК (после 2-го H2) === -->
  <section id="ai-buhgalterskiy-pomoshchnik-boris-block" class="bbu-root" aria-label="Анимация: мост эскалации — типовой FAQ закрыт, сложный кейс у бухгалтера">
<style>
#ai-buhgalterskiy-pomoshchnik-boris-block.bbu-root{padding:56px 0 64px;background:#f0f4f8;}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-card{grid-template-columns:1fr;min-height:auto;}}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#b45309;margin:0 0 14px;
}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-ey::before{content:'';width:18px;height:2px;background:#b45309;border-radius:1px;}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(180,83,9,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#b45309;font-style:normal;
}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-pl-a{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22);}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-rgt{
  position:relative;background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);
  min-height:420px;overflow:hidden;
}
@media(max-width:1023px){#ai-buhgalterskiy-pomoshchnik-boris-block .bbu-rgt{min-height:360px;}}
#bbu-escalation-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bbu-cnt">
  <div class="bbu-card">
    <div class="bbu-lft">
      <span class="bbu-ey">Human-in-the-loop</span>
      <h3 class="bbu-h3">Типовой вопрос — мгновенный ответ. Спорный кейс — тикет бухгалтеру с контекстом</h3>
      <ul class="bbu-ul">
        <li><span class="bbu-ic">✓</span>«Документы к кварталу по УСН?» — чек-лист из KB за секунды</li>
        <li><span class="bbu-ic">?</span>«Можно патент с новой деятельностью?» — эскалация, без ответа клиенту</li>
        <li><span class="bbu-ic">→</span>Бухгалтер видит СНО, историю диалога и черновик ответа</li>
        <li><span class="bbu-ic">📋</span>Журнал источников KB — аудит каждого ответа (McKinsey 2026)</li>
      </ul>
      <div class="bbu-pills">
        <span class="bbu-pl bbu-pl-g">52% автозакрытие</span>
        <span class="bbu-pl bbu-pl-a">&lt;60 сек ответ</span>
        <span class="bbu-pl bbu-pl-b">→ CRM / Telegram</span>
      </div>
      <p class="bbu-foot">Дальше — сценарии работы ассистента и правила эскалации →</p>
    </div>
    <div class="bbu-rgt">
      <canvas id="bbu-escalation-canvas" aria-label="Анимация: поток клиентских сообщений — зелёные закрыты AI, янтарные эскалированы бухгалтеру" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bbu-escalation-canvas');
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
    green:'#4ade80', greenD:function(a){return 'rgba(74,222,128,'+a+')';},
    amber:'#fbbf24', amberD:function(a){return 'rgba(251,191,36,'+a+')';},
    blue:'#60a5fa',  blueD:function(a){return 'rgba(96,165,250,'+a+')';},
    text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    card:'rgba(255,255,255,.065)', line:'rgba(255,255,255,.08)'
  };

  var MSGS = [
    {q:'Документы к кварталу?', type:'ok', delay:0},
    {q:'Когда сдать УСН?', type:'ok', delay:90},
    {q:'Можно патент?', type:'esc', delay:180},
    {q:'Получили акт?', type:'ok', delay:270},
    {q:'Рассчитайте налог', type:'esc', delay:360}
  ];

  var LOOP = 600;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect){ctx.roundRect(x,y,w,h,r);}
    else{ctx.moveTo(x+r,y);ctx.arcTo(x+w,y,x+w,y+h,r);ctx.arcTo(x+w,y+h,x,y+h,r);ctx.arcTo(x,y+h,x,y,r);ctx.arcTo(x,y,x+w,y,r);ctx.closePath();}
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1;ctx.stroke();}
  }

  function drawCol(x, y, w, h, label, clr){
    rr(x,y,w,h,12,C.card,C.line,1);
    ctx.fillStyle=clr; ctx.font='bold 11px Inter,system-ui,sans-serif'; ctx.textAlign='left';
    ctx.fillText(label, x+12, y+22);
    ctx.strokeStyle=C.line; ctx.beginPath(); ctx.moveTo(x+8,y+32); ctx.lineTo(x+w-8,y+32); ctx.stroke();
    return {x:x+10, y:y+40, w:w-20, h:h-48};
  }

  function draw(){
    ctx.clearRect(0,0,W,H);
    var t = frame % LOOP;
    var pulse = Math.sin(frame*0.06);

    ctx.fillStyle=C.text; ctx.font='bold 12px Inter,system-ui,sans-serif'; ctx.textAlign='left';
    ctx.fillText('Мост эскалации · клиентская линия', 14, 22);
    ctx.fillStyle=C.muted; ctx.font='10px Inter,system-ui,sans-serif';
    ctx.fillText('KB фирмы · RAG · human-in-the-loop', 14, 36);

    var colW = (W - 48) / 3;
    var top = 52, colH = H - top - 20;
    var c1 = drawCol(12, top, colW, colH, 'Клиент', C.blue);
    var c2 = drawCol(24+colW, top, colW, colH, 'AI-помощник', C.green);
    var c3 = drawCol(36+colW*2, top, colW, colH, 'Бухгалтер', C.amber);

    MSGS.forEach(function(m, i){
      var start = m.delay;
      if(t < start) return;
      var prog = Math.min(1, (t - start) / 80);
      var alpha = prog < 0.15 ? prog/0.15 : 1;
      var isEsc = m.type === 'esc';
      var clr = isEsc ? C.amber : C.green;
      var y1 = c1.y + 8 + i * 52;
      var y2 = c2.y + 8 + i * 52;
      var y3 = c3.y + 8 + (isEsc ? i * 52 : -100);

      ctx.globalAlpha = alpha * 0.9;
      rr(c1.x, y1, c1.w, 38, 8, clr.replace(')',',0.12)').replace('rgb','rgba').replace('#4ade80','rgba(74,222,128').replace('#fbbf24','rgba(251,191,36') || (isEsc?'rgba(251,191,36,0.12)':'rgba(74,222,128,0.12)'), clr, 1);
      ctx.fillStyle=C.text; ctx.font='10px Inter,system-ui,sans-serif';
      ctx.fillText(m.q, c1.x+8, y1+22);

      if(prog > 0.35){
        var p2 = Math.min(1, (prog-0.35)/0.4);
        ctx.globalAlpha = p2 * 0.85;
        rr(c2.x, y2, c2.w, 38, 8, isEsc?'rgba(251,191,36,0.15)':'rgba(74,222,128,0.15)', clr, 1);
        ctx.fillStyle=C.text;
        ctx.fillText(isEsc ? '→ эскалация' : '✓ из KB', c2.x+8, y2+22);
      }
      if(isEsc && prog > 0.7){
        var p3 = Math.min(1, (prog-0.7)/0.3);
        ctx.globalAlpha = p3 * 0.9;
        rr(c3.x, y3, c3.w, 42, 8, 'rgba(251,191,36,0.18)', C.amber, 1.5);
        ctx.fillStyle=C.amber; ctx.font='bold 10px Inter,system-ui,sans-serif';
        ctx.fillText('Тикет #'+ (1040+i), c3.x+8, y3+16);
        ctx.fillStyle=C.text; ctx.font='9px Inter,system-ui,sans-serif';
        ctx.fillText('контекст + СНО', c3.x+8, y3+30);
      }
      ctx.globalAlpha = 1;
    });

    /* AI pulse */
    var ax = 24+colW + colW/2, ay = top + colH/2;
    ctx.beginPath(); ctx.arc(ax, ay, 10+pulse*3, 0, Math.PI*2);
    ctx.fillStyle='rgba(74,222,128,'+(0.15+0.1*Math.abs(pulse))+')'; ctx.fill();
    ctx.beginPath(); ctx.arc(ax, ay, 5, 0, Math.PI*2);
    ctx.fillStyle=C.green; ctx.fill();

    frame++;
    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
  </section>
  <!-- === / БОРИС === -->

  <!-- 4. KAK-RABOTAET -->
  <section class="buh-section" id="kak-rabotaet">
    <div class="buh-cnt">
      <div class="buh-sh nero-ai-reveal">
        <span class="buh-eyebrow">Продукт · доверие</span>
        <h2>Как работает ассистент: база знаний, human-in-the-loop и эскалация</h2>
        <p>Три опоры: корпус знаний фирмы, правила эскалации, аудит ответов. McKinsey 2026: риск смещается от «сказал не то» к «<strong>сделал не то</strong>» — узкая автономия для FAQ.</p>
      </div>

      <div class="buh-scenario buh-scenario--ok nero-ai-reveal">
        <h3>Сценарий: типовой вопрос → мгновенный ответ</h3>
        <p>Клиент в Telegram: «Какие документы к закрытию квартала по УСН?» → классификация FAQ → чек-лист из KB с учётом СНО из CRM → ответ за секунды → лог в карточке клиента.</p>
      </div>
      <div class="buh-scenario buh-scenario--esc nero-ai-reveal">
        <h3>Сценарий: сложный кейс → тикет живому бухгалтеру</h3>
        <p>«Можно перейти на патент?» → триггеры эскалации → AI <strong>не отвечает</strong> → собирает контекст → тикет в CRM / уведомление в Telegram бухгалтеру.</p>
      </div>

      <h3 class="nero-ai-reveal">Контролируемые источники и журнал ответов (тренд McKinsey 2026)</h3>
      <ul class="nero-ai-reveal">
        <li>журнал диалогов и источников фрагментов KB;</li>
        <li>еженедельный review старшим бухгалтером;</li>
        <li>стоп-слова и запрет расчёта налогов без эскалации;</li>
        <li>дисклеймер: «не является налоговой консультацией».</li>
      </ul>
    </div>
  </section>

  <!-- 5. VOPROSY -->
  <section class="buh-section buh-section-alt" id="voprosy">
    <div class="buh-cnt">
      <div class="buh-sh nero-ai-reveal">
        <span class="buh-eyebrow">Лид-магнит</span>
        <h2>Какие клиентские вопросы можно закрыть автоматически</h2>
      </div>
      <div class="buh-table-wrap nero-ai-reveal">
        <table class="buh-table">
          <thead><tr><th>Категория</th><th>Примеры</th><th>Автоматизация</th><th>Кому передать</th></tr></thead>
          <tbody>
            <tr><td>Сроки отчётности</td><td>УСН/НДС/РСВ</td><td>Высокая</td><td>Изменение закона в день дедлайна</td></tr>
            <tr><td>Документы к закрытию</td><td>Что принести к кварталу</td><td>Высокая</td><td>Нестандартные операции</td></tr>
            <tr><td>Статус задачи</td><td>Готов ли отчёт</td><td>Средняя*</td><td>Без CRM — «передали бухгалтеру»</td></tr>
            <tr><td>ИП/ООО / режим</td><td>«Можно патент»</td><td>Низкая</td><td><strong>Всегда человек</strong></td></tr>
            <tr><td>Требования ФНС</td><td>«Пришло требование»</td><td>Низкая</td><td><strong>Всегда человек</strong></td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="font-size:13px;">*При интеграции с CRM бот показывает актуальный статус.</p>

      <div class="buh-leadmagnet nero-ai-reveal" id="leadmagnet-faq">
        <h3>📋 FAQ бухгалтерии для клиентов</h3>
        <p>Готовая структура категорий и формулировок для старта базы знаний. Заполните под регламент фирмы или закажите адаптацию у Nero Network.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Настроить помощника</a>
      </div>
    </div>
  </section>

  <!-- CTA-1 Артура: после #voprosy -->
  <div class="buh-cnt">
    <aside class="ym-cta-block ym-cta-block--primary" id="cta-faq-leadmagnet">
      <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Получите шаблон FAQ бухгалтерии для клиентов</p>
        <p class="ym-cta-block__sub">Готовая структура категорий вопросов, формулировок и правил эскалации — старт для базы знаний вашей фирмы.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Настроить помощника</a>
      </div>
    </aside>
  </div>

  <!-- 6. ETAPY -->
  <section class="buh-section" id="etapy">
    <div class="buh-cnt">
      <div class="buh-sh nero-ai-reveal">
        <span class="buh-eyebrow">Внедрение под ключ</span>
        <h2>Внедрение AI бухгалтерского помощника под ключ: этапы и сроки</h2>
        <p>Пилот — <strong>2–4 недели</strong> на одном канале; полный запуск — <strong>3–8 недель</strong>.</p>
      </div>
      <div class="buh-timeline nero-ai-reveal">
        <div class="buh-tl-item"><div class="buh-tl-dot"></div><h3>Аудит типовых вопросов и базы знаний</h3><p>Discovery 1–2 дня: топ-30 вопросов, карта каналов, матрица «бот / бухгалтер».</p></div>
        <div class="buh-tl-item"><div class="buh-tl-dot"></div><h3>Настройка промптов, эскалации и дисклеймера</h3><p>Тест 30–50 реальных вопросов со сверкой ответов старшего бухгалтера.</p></div>
        <div class="buh-tl-item"><div class="buh-tl-dot"></div><h3>Пилот на одном канале → масштабирование</h3><p>Telegram или виджет → WhatsApp, CRM, тикеты.</p></div>
        <div class="buh-tl-item"><div class="buh-tl-dot"></div><h3>Без программиста</h3><p>No-code (Make, n8n), готовые коннекторы к мессенджерам и CRM.</p></div>
      </div>
      <div class="buh-table-wrap nero-ai-reveal">
        <table class="buh-table">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы для бухфирмы</th></tr></thead>
          <tbody>
            <tr><td>Кнопочный бот</td><td>Дёшево</td><td>Не понимает контекст СНО</td></tr>
            <tr><td>«Просто ChatGPT»</td><td>Быстрый старт</td><td>Галлюцинации, риск 152-ФЗ</td></tr>
            <tr><td>LLM + RAG + эскалация</td><td>Ответы по KB фирмы</td><td>Требует настройки и пилота</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- CTA-2 Артура: после #etapy -->
  <div class="buh-cnt">
    <aside class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Запустить пилот AI-помощника за 2–4 недели</p>
        <p class="ym-cta-block__sub">Аудит типовых вопросов, матрица «бот / бухгалтер», RAG на одном канале.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Настроить помощника</a>
      </div>
    </aside>
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации до старта проекта?</p>
        <p class="ym-cta-block__sub">Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: $primary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение'); ?></a> — ускоряет согласование коридора ответов.</p>
      </div>
    </aside>
  </div>

  <!-- 7. INTEGRACII -->
  <section class="buh-section buh-section-alt" id="integracii">
    <div class="buh-cnt">
      <div class="buh-sh nero-ai-reveal">
        <span class="buh-eyebrow">Каналы и CRM</span>
        <h2>Интеграция с CRM, Telegram, WhatsApp и тикет-системой</h2>
      </div>
      <div class="buh-channels nero-ai-reveal">
        <div class="buh-channel">Telegram</div>
        <div class="buh-channel">WhatsApp</div>
        <div class="buh-channel">amoCRM</div>
        <div class="buh-channel">Битрикс24</div>
        <div class="buh-channel">Виджет сайта</div>
        <div class="buh-channel">Тикеты</div>
      </div>
      <h3 class="nero-ai-reveal" style="margin-top:32px;">Единая история диалога для бухгалтера</h3>
      <p class="nero-ai-reveal">Диалог привязан к карточке клиента и ответственному специалисту. Паттерн CRM + KB + передача консультанту — <strong>~30%</strong> входящих закрывается ботом круглосуточно.</p>
      <h3 class="nero-ai-reveal">Передача контекста при эскалации</h3>
      <p class="nero-ai-reveal">СНО, период, тип операции, цитаты из регламента → тикет с черновиком ответа (без отправки до approve).</p>
    </div>
  </section>

  <!-- 8. CENY -->
  <section class="buh-section" id="ceny">
    <div class="buh-cnt">
      <div class="buh-sh nero-ai-reveal">
        <span class="buh-eyebrow">Коммерция</span>
        <h2>Стоимость внедрения AI бухгалтерского помощника</h2>
        <p>Ориентир Nero Network: <strong>150–450 тыс. ₽</strong> за MVP первой линии.</p>
      </div>
      <h3 class="nero-ai-reveal">Из чего складывается цена</h3>
      <ul class="nero-ai-reveal">
        <li>Discovery и аудит переписки;</li>
        <li>База знаний: регламенты, чек-листы, FAQ;</li>
        <li>LLM (YandexGPT / GigaChat / OpenAI в RU-контуре);</li>
        <li>Интеграции CRM, мессенджеры, тикеты;</li>
        <li>Пилот, тест, обучение, сопровождение.</li>
      </ul>
      <!-- INTERNAL-LINKS:INSERT -->
      <h3 class="nero-ai-reveal">ROI: часы бухгалтера vs стоимость пилота</h3>
      <div class="buh-roi nero-ai-reveal">
        <div class="buh-roi-item"><strong>15</strong><span>типовых обращений/день</span></div>
        <div class="buh-roi-item"><strong>7 мин</strong><span>на каждый ответ</span></div>
        <div class="buh-roi-item"><strong>~38 ч</strong><span>экспертного времени/мес</span></div>
        <div class="buh-roi-item"><strong>95–150К ₽</strong><span>«сгоревшей» экспертизы</span></div>
      </div>
    </div>
  </section>

  <!-- CTA-3 Артура: после #ceny -->
  <div class="buh-cnt">
    <aside class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Верните бухгалтерам ~38 часов в месяц</p>
        <p class="ym-cta-block__sub">Ориентир внедрения — 150–450 тыс. ₽. На аудите покажем потенциал автозакрытия и срок окупаемости.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Настроить помощника</a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
        </div>
      </div>
    </aside>
  </div>

  <!-- 9. KEISY -->
  <section class="buh-section buh-section-alt" id="keisy">
    <div class="buh-cnt">
      <div class="buh-sh nero-ai-reveal">
        <span class="buh-eyebrow">Социальное доказательство</span>
        <h2>Кейсы и примеры внедрения</h2>
      </div>
      <div class="buh-grid-3">
        <div class="buh-case-card nero-ai-reveal">
          <div class="buh-case-tag">Аутсорсинг МСБ</div>
          <h3>38% → 52% автозакрытия</h3>
          <p>Кнопочный бот → LLM+RAG. TenChat, 2026. *Клиент не назван.</p>
        </div>
        <div class="buh-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="buh-case-tag">Пилот</div>
          <h3>5–7 вопросов, один мессенджер</h3>
          <p>Модель Зинин×Штурбин: сроки и документы, расчёты — эскалация.</p>
        </div>
        <div class="buh-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="buh-case-tag">UK (Softomate)</div>
          <h3>4 ч → &lt;60 сек</h3>
          <p>80+ запросов/день; ROI за 90 дней (заявление автора).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 10. RISKI -->
  <section class="buh-section" id="riski">
    <div class="buh-cnt">
      <div class="buh-sh buh-left nero-ai-reveal">
        <span class="buh-eyebrow">E-E-A-T</span>
        <h2>Риски, персональные данные и дисклеймер</h2>
      </div>
      <h3 class="nero-ai-reveal">Почему AI не заменяет налогового консультанта</h3>
      <p class="nero-ai-reveal">Не подписывает отчётность, не несёт ответственность за расчёт. Информирует по регламенту и маршрутизирует сложное к эксперту.</p>
      <h3 class="nero-ai-reveal">Хранение ПДн и ограничение доступа к базе знаний</h3>
      <p class="nero-ai-reveal">152-ФЗ: для сроков ПДн не нужны; баланс и зарплата — обезличивание или human. Локализация в РФ, RU-контур LLM.</p>
      <div class="buh-disclaimer nero-ai-reveal">
        <blockquote>Информация, предоставляемая AI-ассистентом, носит справочный характер и <strong>не является налоговой или бухгалтерской консультацией</strong>. Расчёт налогов, выбор режима, ответы на требования ФНС обрабатываются только квалифицированным специалистом.</blockquote>
      </div>
    </div>
  </section>

  <!-- 11. FAQ -->
  <section class="buh-section buh-section-alt" id="faq">
    <div class="buh-cnt">
      <div class="buh-sh nero-ai-reveal">
        <span class="buh-eyebrow">GEO-блок</span>
        <h2>FAQ — частые вопросы о AI бухгалтерском помощнике</h2>
      </div>
      <div class="buh-faq nero-ai-reveal" id="buh-faq-accordion">
        <div class="buh-faq-item"><div class="buh-faq-q">Как внедрить ai бухгалтерский помощник?</div><div class="buh-faq-a">Аудит → KB → пилот Telegram → тест 30–50 вопросов → CRM. Nero Network — 2–8 недель под ключ.</div></div>
        <div class="buh-faq-item"><div class="buh-faq-q">Сколько стоит?</div><div class="buh-faq-a">Ориентир 150–450 тыс. ₽ за MVP; точная смета после discovery.</div></div>
        <div class="buh-faq-item"><div class="buh-faq-q">Можно ли без программиста?</div><div class="buh-faq-a">Да: коннекторы Telegram, WhatsApp, amoCRM, Битрикс24; настройка KB в админке.</div></div>
        <div class="buh-faq-item"><div class="buh-faq-q">Подходит ли для малого бизнеса?</div><div class="buh-faq-a">Да — компактные команды получают максимальный относительный эффект.</div></div>
        <div class="buh-faq-item"><div class="buh-faq-q">Как интегрировать с CRM?</div><div class="buh-faq-a">Диалоги в карточке клиента; при эскалации — задача с полным контекстом.</div></div>
        <div class="buh-faq-item"><div class="buh-faq-q">Что если AI ответит неверно?</div><div class="buh-faq-a">Журнал, review, узкий коридор KB, триггеры эскалации, дисклеймер.</div></div>
        <div class="buh-faq-item"><div class="buh-faq-q">Заменит ли бухгалтера?</div><div class="buh-faq-a">Нет. Закрывает типовую первую линию; расчёты и спорные нормы — зона эксперта.</div></div>
        <div class="buh-faq-item"><div class="buh-faq-q">Чем отличается от AI для 1С?</div><div class="buh-faq-a">1С-AI — учёт внутри компании. Помощник — клиенты фирмы в мессенджерах.</div></div>
      </div>
    </div>
  </section>

  <!-- 12. ZAYAVKA -->
  <section class="buh-section" id="zayavka">
    <div class="buh-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal">
        <span class="buh-eyebrow">Финальный CTA</span>
        <h2 style="margin-bottom:16px;">Настроить AI бухгалтерского помощника для вашей фирмы</h2>
        <ul class="buh-cta-checklist">
          <li>Ответы по вашей базе знаний</li>
          <li>Эскалация с контекстом</li>
          <li>CRM, Telegram, WhatsApp</li>
          <li>152-ФЗ и дисклеймер</li>
        </ul>
        <p class="ym-cta-block__sub">Бесплатный аудит типовых вопросов — матрица «бот / бухгалтер» за 1–2 дня.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Настроить помощника</a>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.buh-content -->

<script>
(function(){
  var faq = document.getElementById('buh-faq-accordion');
  if (!faq) return;
  faq.querySelectorAll('.buh-faq-q').forEach(function(q){
    q.addEventListener('click', function(){
      var item = q.parentElement;
      var open = item.classList.contains('open');
      faq.querySelectorAll('.buh-faq-item').forEach(function(i){ i.classList.remove('open'); });
      if (!open) item.classList.add('open');
    });
  });
})();
</script>
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-buhgalterskiy-pomoshchnik-page') || document.querySelector('.buh-content');
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
