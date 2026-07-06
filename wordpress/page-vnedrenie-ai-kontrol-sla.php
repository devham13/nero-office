<?php
/**
 * Template Name: AI-агент для контроля SLA в поддержке: внедрение под ключ
 * Description: SEO-лендинг — AI-контроль SLA, просрочки, эскалация в CRM/helpdesk. Внедрение под ключ.
 */

$page_seo_title       = 'AI-агент для контроля SLA в поддержке — внедрение под ключ';
$page_seo_description = 'AI-контроль SLA в поддержке: просрочки, приоритеты и автоэскалация в CRM/helpdesk. Внедрение под ключ, аудит заявок. Чек-лист потерь SLA — 15 минут.';

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
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Найти просроченные обращения';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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

.vsla-content{
  --vsla-bg:#050711;--vsla-bg2:#080b17;--vsla-surface:rgba(255,255,255,.072);
  --vsla-text:#e6edf7;--vsla-muted:#9aa8bd;--vsla-soft:#c7d2e5;--vsla-heading:#fff;
  --vsla-border:rgba(255,255,255,.10);--vsla-accent:#79f2ff;--vsla-violet:#8b5cf6;--vsla-green:#22c55e;
  --vsla-btn-from:#2563eb;--vsla-btn-to:#7c3aed;--vsla-r:18px;--vsla-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vsla-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vsla-content *,.vsla-content *::before,.vsla-content *::after{box-sizing:border-box}
.vsla-content a{color:inherit}
.vsla-content p{color:var(--vsla-muted);line-height:1.72;margin:0 0 1em}
.vsla-content p:last-child{margin-bottom:0}
.vsla-content h2,.vsla-content h3,.vsla-content h4{color:var(--vsla-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vsla-content strong{color:var(--vsla-soft)}
.vsla-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vsla-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vsla-muted);font-size:14.5px;line-height:1.65}
.vsla-content ul li::before{content:'›';position:absolute;left:0;color:var(--vsla-accent);font-weight:700}
.vsla-cnt{width:min(var(--vsla-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vsla-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vsla-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vsla-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vsla-sh.vsla-left{margin-left:0;text-align:left}
.vsla-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vsla-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vsla-sh.vsla-left p{margin-left:0}
.vsla-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vsla-accent);margin-bottom:14px}
.vsla-gt{background:linear-gradient(92deg,#fff 0%,var(--vsla-accent) 44%,var(--vsla-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vsla-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vsla-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vsla-intro-text{position:relative;padding-left:20px}
.vsla-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vsla-accent),var(--vsla-violet))}
.vsla-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vsla-muted);margin-bottom:1em}
.vsla-intro-text p:last-child{margin-bottom:0;color:var(--vsla-soft)}
.vsla-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vsla-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vsla-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vsla-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vsla-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vsla-muted);line-height:1.4}
.vsla-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vsla-intro-grid{grid-template-columns:1fr;gap:36px}.vsla-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vsla-intro-kpi{grid-template-columns:1fr 1fr}}
.vsla-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vsla-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vsla-toc a{display:inline-block;padding:9px 18px;background:var(--vsla-surface);border:1px solid var(--vsla-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vsla-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vsla-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vsla-accent);background:rgba(121,242,255,.08)}
.vsla-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vsla-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vsla-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.vsla-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vsla-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vsla-grid-2,.vsla-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.vsla-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vsla-grid-3{grid-template-columns:1fr}}
.vsla-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vsla-table{width:100%;border-collapse:collapse;font-size:14px}
.vsla-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vsla-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vsla-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vsla-text);vertical-align:top}
.vsla-table tr:last-child td{border-bottom:none}
.vsla-table tr:hover td{background:rgba(255,255,255,.03)}
.vsla-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vsla-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vsla-accent);border:1px solid rgba(121,242,255,.2)}
.vsla-flow .arr{color:var(--vsla-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vsla-timeline{position:relative;padding-left:40px}
.vsla-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vsla-accent),var(--vsla-violet));opacity:.35;border-radius:2px}
.vsla-tl-item{position:relative;margin-bottom:32px}
.vsla-tl-item:last-child{margin-bottom:0}
.vsla-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vsla-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vsla-tl-item h3{font-size:17px;margin-bottom:8px}
.vsla-tl-item p{font-size:14.5px;margin:0}
.vsla-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vsla-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vsla-case-grid{grid-template-columns:1fr}}
.vsla-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.vsla-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.vsla-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vsla-green);margin-bottom:10px}
.vsla-case-card h3{font-size:16px;margin-bottom:14px}
.vsla-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.vsla-metric .num{font-size:20px;font-weight:900;color:var(--vsla-accent);flex-shrink:0}
.vsla-metric .lbl{font-size:13px;color:var(--vsla-muted)}
.vsla-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vsla-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vsla-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vsla-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vsla-faq-q::after{content:'▾';font-size:13px;color:var(--vsla-accent);flex-shrink:0;transition:transform .25s}
.vsla-faq-item.open .vsla-faq-q::after{transform:rotate(180deg)}
.vsla-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vsla-muted);line-height:1.72}
.vsla-faq-item.open .vsla-faq-a{max-height:800px;padding:0 24px 20px}
.vsla-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.vsla-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vsla-muted)}
.vsla-cta-checklist li::before{content:'✓';color:var(--vsla-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vsla-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vsla-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vsla-btn-from),var(--vsla-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}

.vsla-chips{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin:28px 0}
.vsla-chips span{padding:8px 16px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:var(--vsla-muted)}
.vsla-calc-wrap{margin:28px 0}
.vsla-calc-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:28px}
.vsla-calc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:20px 0}
@media(max-width:768px){.vsla-calc-grid{grid-template-columns:1fr}}
.vsla-calc-input{width:100%;margin-top:6px;padding:10px 12px;border-radius:10px;border:1px solid rgba(255,255,255,.15);background:rgba(0,0,0,.25);color:#fff}
.vsla-body h2{font-size:clamp(24px,3.6vw,42px);margin-bottom:20px}
.vsla-body h3{font-size:clamp(17px,2vw,22px);margin-top:28px}
.vsla-esc-matrix .vsla-table th:nth-child(3){background:rgba(248,113,113,.15)}
.ym-btn--ghost{color:var(--vsla-text)!important;background:rgba(255,255,255,.07)!important;border:1px solid rgba(255,255,255,.14)!important}
#vnedrenie-ai-kontrol-sla-boris-block.vslb-root{padding:0;background:transparent}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-cnt{padding:0}

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-kontrol-sla-page" role="main" tabindex="-1">

<section class="nero-ai-hero vsla-hero-sla" id="vsla-hero-sla" aria-labelledby="vsla-hero-title">
<style>
/* ── Hero SLA: самодостаточные стили (без CSS темы) ── */
.vsla-hero-sla {
  --vsla-cyan: #79f2ff;
  --vsla-violet: #8b5cf6;
  --vsla-green: #22c55e;
  --vsla-amber: #fbbf24;
  --vsla-red: #f87171;
  --vsla-text: #e6edf7;
  --vsla-muted: #9aa8bd;
  --vsla-soft: #c7d2e5;
  --vsla-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: linear-gradient(180deg, #050711 0%, #080b17 48%, #050711 100%);
}
.vsla-hero-sla::before {
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
  z-index: 0;
}
.vsla-hero-sla::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 640px;
  height: 640px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(248, 113, 113, .10), transparent 66%);
  filter: blur(8px);
  animation: vslaHeroGlow 7s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes vslaHeroGlow {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .82; transform: scale(1.05); }
}
.vsla-hero-sla .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vsla-hero-sla .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vsla-hero-sla .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vsla-hero-sla .nero-ai-gradient-text {
  display: inline;
  background: linear-gradient(92deg, #fff 0%, var(--vsla-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vsla-hero-sla .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vsla-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vsla-hero-sla .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vsla-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vsla-hero-sla .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vsla-hero-sla .nero-ai-badge {
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
.vsla-hero-sla .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vsla-hero-sla .nero-ai-btn {
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
.vsla-hero-sla .nero-ai-btn:hover { transform: translateY(-2px); }
.vsla-hero-sla .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vsla-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vsla-hero-sla .nero-ai-btn-secondary {
  color: var(--vsla-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vsla-hero-sla .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vsla-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vsla-hero-sla .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vsla-hero-sla .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vsla-hero-sla .nero-ai-dots { display: flex; gap: 7px; }
.vsla-hero-sla .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vsla-hero-sla .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vsla-hero-sla .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vsla-hero-sla .nero-ai-dot:nth-child(3) { background: #34d399; }
.vsla-hero-sla .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vsla-hero-sla .nero-ai-window-body { padding: 16px; }
.vsla-hero-sla .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vsla-hero-sla .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vsla-hero-sla .nero-ai-live-pill {
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
.vsla-hero-sla .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vslaPulse 1.6s infinite;
}
@keyframes vslaPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vsla-hero-sla .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vsla-hero-sla .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vsla-hero-sla .nero-ai-metric span {
  display: block;
  color: var(--vsla-muted);
  font-size: 11px;
  font-weight: 700;
}
.vsla-hero-sla .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vsla-hero-sla .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vsla-hero-sla .vsla-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(248, 113, 113, 0.16);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.07), rgba(6,10,24,.92) 72%);
}
.vsla-hero-sla #vsla-hero-sla-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vsla-hero-sla .nero-ai-task-stream { display: grid; gap: 8px; }
.vsla-hero-sla .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vsla-hero-sla .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vsla-cyan);
  font-size: 11px;
  font-weight: 800;
}
.vsla-hero-sla .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vsla-hero-sla .nero-ai-task span {
  color: var(--vsla-muted);
  font-size: 11px;
}
.vsla-hero-sla .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vsla-hero-sla .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.vsla-hero-sla .nero-ai-status--red {
  background: rgba(248,113,113,.14);
  color: #fecaca;
}
@media (max-width: 1100px) {
  .vsla-hero-sla .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vsla-hero-sla .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vsla-hero-sla .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vsla-hero-sla .nero-ai-window-body { padding: 12px; }
  .vsla-hero-sla .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vsla-hero-sla .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow">SLA / поддержка · внедрение под ключ</p>
    <h1 id="vsla-hero-title">AI-агент для контроля SLA в поддержке: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
    <p class="nero-ai-hero-lead">AI отслеживает просрочки по SLA, приоритеты заявок и эскалирует критичные обращения — без ручного контроля в CRM</p>
    <ul class="nero-ai-badges" aria-label="Ключевые возможности">
      <li class="nero-ai-badge">Отслеживание SLA</li>
      <li class="nero-ai-badge">Risk scoring</li>
      <li class="nero-ai-badge">Автоэскалация</li>
      <li class="nero-ai-badge">CRM / helpdesk</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Найти просроченные обращения'); ?></a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация AI-контроля SLA">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>SLA Control Center</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>В зоне риска</span>
            <strong>7</strong>
            <small>risk ≥ 70%</small>
          </div>
          <div class="nero-ai-metric">
            <span>% compliance</span>
            <strong>94.2%</strong>
            <small>за 7 дней</small>
          </div>
          <div class="nero-ai-metric">
            <span>Эскалаций сегодня</span>
            <strong>3</strong>
            <small>Telegram + CRM</small>
          </div>
          <div class="nero-ai-metric">
            <span>До breach (мин)</span>
            <strong>18</strong>
            <small>тикет #4821 VIP</small>
          </div>
        </div>

        <div class="vsla-dash-canvas-wrap" aria-hidden="false">
          <canvas id="vsla-hero-sla-canvas" role="img" aria-label="Анимация: тикеты на орбитах SLA, таймер приближается к breach, AI эскалирует в Telegram"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента тикетов SLA">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">VIP</span>
            <div><strong>#4821 · возврат B2B</strong><span>До breach 18 мин · risk 88%</span></div>
            <span class="nero-ai-status nero-ai-status--amber">at-risk</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">↑</span>
            <div><strong>#4799 · нет assignee</strong><span>Эскалация → тимлид Telegram</span></div>
            <span class="nero-ai-status nero-ai-status--red">escalated</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">✓</span>
            <div><strong>#4805 · first response</strong><span>Ответ за 4 мин · в SLA</span></div>
            <span class="nero-ai-status">ok</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">⏸</span>
            <div><strong>#4812 · on-hold</strong><span>Таймер паузы учтён AI</span></div>
            <span class="nero-ai-status">ok</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function () {
  var canvas = document.getElementById('vsla-hero-sla-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var W = 0, H = 0, frame = 0, dpr = 1;

  function resize() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    W = wrap.clientWidth;
    H = wrap.clientHeight;
    canvas.width = Math.floor(W * dpr);
    canvas.height = Math.floor(H * dpr);
    canvas.style.width = W + 'px';
    canvas.style.height = H + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    outline: '#0f172a',
    cyan: '#79f2ff',
    violet: '#8b5cf6',
    green: '#22c55e',
    amber: '#fbbf24',
    red: '#f87171',
    muted: '#94a3b8',
    text: '#e2e8f0',
    bubbleBg: '#ffffff',
    agentYellow: '#eab308',
    agentGreen: '#10b981',
    agentBlue: '#3b82f6',
    agentPink: '#ec4899',
    agentPurple: '#8b5cf6'
  };

  function rr(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.lineWidth = 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  function drawPolyRound(x, y, w, h, radius, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, radius);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.lineWidth = 2; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  /* ── Орбитальные дорожки приоритетов (вместо Conveyor) ── */
  class PriorityOrbitLanes {
    constructor(cx, cy) { this.cx = cx; this.cy = cy; }
    draw(ctx, pulse) {
      var radii = [0.34, 0.44, 0.54];
      var colors = ['rgba(34,197,94,.35)', 'rgba(251,191,36,.4)', 'rgba(248,113,113,.45)'];
      var base = Math.min(W, H);
      radii.forEach(function (r, i) {
        ctx.strokeStyle = colors[i];
        ctx.lineWidth = 1.2 + pulse * 0.8;
        ctx.setLineDash([5, 7]);
        ctx.beginPath();
        ctx.ellipse(this.cx, this.cy, base * r, base * r * 0.38, 0, 0, Math.PI * 2);
        ctx.stroke();
      }, this);
      ctx.setLineDash([]);
    }
  }

  /* ── Башня SLA с таймером и risk gauge (вместо WebsiteTerminal) ── */
  class SlaBreachTower {
    constructor(x, y) {
      this.x = x; this.y = y;
      this.phase = 0;
      this.telegramWave = 0;
      this.recoverFlash = 0;
    }
    draw(ctx, cyclePrg) {
      this.phase = cyclePrg;
      var w = 120, h = 150;
      var x = this.x - w / 2, y = this.y - h / 2;

      drawPolyRound(x, y, w, h, 10, '#1e293b', C.outline);

      /* risk gauge arc */
      var gx = this.x, gy = this.y - 18, gr = 38;
      var risk = cyclePrg < 80 ? 0.35 + cyclePrg / 200 : cyclePrg < 160 ? 0.5 + (cyclePrg - 80) / 160 : Math.min(1, 0.85 + (cyclePrg - 160) / 80);
      ctx.lineWidth = 6;
      ctx.strokeStyle = 'rgba(148,163,184,.25)';
      ctx.beginPath();
      ctx.arc(gx, gy, gr, Math.PI * 0.75, Math.PI * 2.25);
      ctx.stroke();
      var arcColor = risk < 0.5 ? C.green : risk < 0.75 ? C.amber : C.red;
      ctx.strokeStyle = arcColor;
      ctx.beginPath();
      ctx.arc(gx, gy, gr, Math.PI * 0.75, Math.PI * (0.75 + 1.5 * risk));
      ctx.stroke();

      ctx.fillStyle = C.text;
      ctx.font = 'bold 11px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('risk ' + Math.round(risk * 100) + '%', gx, gy + 4);

      /* countdown */
      var mins = cyclePrg < 160 ? Math.max(3, Math.round(42 - cyclePrg * 0.22)) : 0;
      ctx.fillStyle = mins < 15 ? C.red : C.cyan;
      ctx.font = '900 22px system-ui,sans-serif';
      ctx.fillText(mins + 'м', gx, gy + 32);
      ctx.fillStyle = C.muted;
      ctx.font = '9px system-ui,sans-serif';
      ctx.fillText('до breach', gx, gy + 46);

      /* matrix ladder 50 / 80 / breach */
      var steps = [
        { label: '50%', color: C.amber, y: y + 78 },
        { label: '80%', color: '#fb923c', y: y + 98 },
        { label: 'breach', color: C.red, y: y + 118 }
      ];
      steps.forEach(function (s, i) {
        var active = (cyclePrg > 50 + i * 40);
        rr(x + 12, s.y, w - 24, 14, 4, active ? s.color + '33' : 'rgba(255,255,255,.06)', active ? s.color : 'rgba(255,255,255,.12)');
        ctx.fillStyle = active ? s.color : C.muted;
        ctx.font = 'bold 9px system-ui,sans-serif';
        ctx.textAlign = 'left';
        ctx.fillText(s.label, x + 18, s.y + 10);
      });

      /* Telegram escalation wave */
      if (cyclePrg >= 160 && cyclePrg < 210) {
        this.telegramWave = (cyclePrg - 160) / 50;
        var tx = this.x + w / 2 + 8 + this.telegramWave * 55;
        var ty = this.y - 20;
        var alpha = 1 - this.telegramWave * 0.7;
        ctx.globalAlpha = alpha;
        rr(tx, ty, 36, 28, 8, '#229ED9', C.outline);
        ctx.fillStyle = '#fff';
        ctx.font = 'bold 10px system-ui,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('TG', tx + 18, ty + 18);
        ctx.strokeStyle = C.red;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(this.x + w / 2, this.y - 10);
        ctx.lineTo(tx, ty + 14);
        ctx.stroke();
        ctx.globalAlpha = 1;
      }

      if (cyclePrg >= 210) {
        this.recoverFlash = Math.min(1, (cyclePrg - 210) / 30);
        ctx.globalAlpha = this.recoverFlash * 0.35;
        rr(x - 6, y - 6, w + 12, h + 12, 12, C.green, null);
        ctx.globalAlpha = 1;
      }
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
    draw(ctx, cyclePrg) {
      this.timer += 0.03;
      var isMoving = false, faceDir = 1;
      var targetX = W * 0.38, targetY = H * 0.42 + (this.stepTrig * 0.15);
      if (cyclePrg >= this.stepTrig && cyclePrg < this.stepTrig + 22) {
        var local = cyclePrg - this.stepTrig;
        if (local < 11) {
          isMoving = true;
          this.x = this.baseX + (targetX - this.baseX) * (local / 11);
          this.y = this.baseY + (targetY - this.baseY) * (local / 11);
        } else {
          isMoving = true; faceDir = -1;
          var back = (local - 11) / 11;
          this.x = targetX - (targetX - this.baseX) * back;
          this.y = targetY - (targetY - this.baseY) * back;
        }
      } else {
        this.x = this.baseX; this.y = this.baseY;
      }
      if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
        createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 260);
      }
      var bob = Math.sin(this.timer * 1.5) * (isMoving ? 2 : 1);
      ctx.save();
      ctx.translate(this.x, this.y + bob);
      drawPolyRound(-12, -8, 24, 16, 5, this.color, C.outline);
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(0, -18, 10, 0, Math.PI * 2);
      ctx.fill();
      ctx.lineWidth = 2;
      ctx.strokeStyle = C.outline;
      ctx.stroke();
      ctx.restore();
    }
  }

  var orbitTickets = [];
  function spawnTicket() {
    var lanes = ['low', 'med', 'high'];
    var lane = lanes[Math.floor(Math.random() * lanes.length)];
    orbitTickets.push({
      angle: Math.random() * Math.PI * 2,
      lane: lane,
      speed: lane === 'high' ? 0.022 : lane === 'med' ? 0.016 : 0.012,
      id: '#' + (4700 + Math.floor(Math.random() * 200)),
      vip: Math.random() < 0.15
    });
  }
  for (var i = 0; i < 5; i++) spawnTicket();

  var bubbles = [];
  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 280, maxLife: life || 280 });
  }

  var tower, orbits;
  var agents = [
    new Agent(W * 0.08, H * 0.78, C.agentYellow, '1_architect', 12, ['Сверяю SLA-матрицу…', 'Порог 80% для VIP', 'Договор tier Enterprise']),
    new Agent(W * 0.18, H * 0.88, C.agentGreen, '2_seo', 45, ['Risk score 72%', 'Idle 40 мин — алерт', 'Паттерн: пятница, возвраты']),
    new Agent(W * 0.28, H * 0.72, C.agentBlue, '3_coder', 78, ['Webhook Okdesk OK', 'Пауза on-hold учтена', 'Cron каждые 5 мин']),
    new Agent(W * 0.12, H * 0.62, C.agentPink, '4_designer', 110, ['Приоритет ↑ критичный', 'Assignee пустой — эскалация', 'VIP-клиент в зоне риска']),
    new Agent(W * 0.22, H * 0.58, C.agentPurple, '5_deployer', 145, ['Пинг тимлиду в Telegram', 'Тег sla_breached', 'Summary для руководителя'])
  ];

  function drawTicketChip(tx, ty, t, cyclePrg) {
    var col = t.lane === 'high' ? C.red : t.lane === 'med' ? C.amber : C.green;
    if (cyclePrg > 150 && t.lane === 'high') col = C.red;
    rr(tx - 16, ty - 8, 32, 16, 4, 'rgba(15,23,42,.85)', col);
    ctx.fillStyle = col;
    ctx.font = 'bold 8px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(t.vip ? 'VIP' : t.id.slice(-4), tx, ty + 3);
  }

  function loop() {
    frame++;
    var cyclePrg = frame % 240;
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.05);
    var cx = W * 0.5, cy = H * 0.48;

    if (!orbits) orbits = new PriorityOrbitLanes(cx, cy);
    if (!tower) tower = new SlaBreachTower(cx, cy);

    ctx.clearRect(0, 0, W, H);

    /* фоновая сетка радара */
    ctx.strokeStyle = 'rgba(121,242,255,.06)';
    ctx.lineWidth = 1;
    for (var g = 0; g < 4; g++) {
      ctx.beginPath();
      ctx.arc(cx, cy, (g + 1) * Math.min(W, H) * 0.12, 0, Math.PI * 2);
      ctx.stroke();
    }

    orbits.draw(ctx, pulse);
    tower.draw(ctx, cyclePrg);

    if (frame % 55 === 0 && orbitTickets.length < 8) spawnTicket();

    var laneR = { low: 0.34, med: 0.44, high: 0.54 };
    orbitTickets.forEach(function (t) {
      t.angle += t.speed;
      var r = Math.min(W, H) * laneR[t.lane];
      var tx = cx + Math.cos(t.angle) * r;
      var ty = cy + Math.sin(t.angle) * r * 0.38;
      drawTicketChip(tx, ty, t, cyclePrg);
      if (cyclePrg > 155 && t.lane === 'high' && Math.random() < 0.02) {
        t.lane = 'med';
        createBubble(tx, ty - 12, 'Эскалация отправлена', 200);
      }
    });

    agents.forEach(function (a) { a.draw(ctx, cyclePrg); });

    if (cyclePrg >= 20 && cyclePrg < 20.05) createBubble(W * 0.12, H * 0.2, '1. Скан очереди SLA', 220);
    if (cyclePrg >= 70 && cyclePrg < 70.05) createBubble(cx, cy - 50, '2. Risk score растёт', 220);
    if (cyclePrg >= 130 && cyclePrg < 130.05) createBubble(cx + 40, cy, '3. Порог 80% — тимлид', 220);
    if (cyclePrg >= 168 && cyclePrg < 168.05) createBubble(cx + 70, cy - 30, '4. Telegram-эскалация', 240);
    if (cyclePrg >= 215 && cyclePrg < 215.05) createBubble(cx, cy + 60, '5. Compliance восстановлен', 220);

    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.textAlign = 'center';
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 30);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      rr(b.x - tw / 2, b.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.outline;
      ctx.fillText(b.text, b.x, b.y - 7);
      ctx.globalAlpha = 1;
    }

    requestAnimationFrame(loop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(loop);
  } else {
    loop();
  }
})();
</script>
</section>

<div class="vsla-content">

<section class="vsla-intro nero-ai-section" id="intro" aria-label="Введение">
  <div class="vsla-cnt">
    <div class="vsla-intro-grid nero-ai-reveal">
      <div class="vsla-intro-text">
        <p class="vsla-eyebrow">Лонгрид · AI контроль SLA</p>
        <p>Когда заявки просрочены, ответственные теряются, а клиент злится — проблема редко в отсутствии SLA в CRM. Чаще срыв происходит между дедлайном и реакцией команды: письмо уже в очереди, а тикет в helpdesk ещё не создан — типичный разрыв, который закрывает <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-obrabotka-email-crm/' ) ); ?>" class="ym-link ym-link--accent">AI-обработка входящей почты в CRM</a>. Nero Network внедряет <strong>AI-контроль SLA</strong> как надстройку над helpdesk и CRM: агент отслеживает таймеры, приоритеты и до нарушения норматива запускает эскалацию.</p>
        <p>Ниже — как устроено решение, что даёт бизнесу и как заказать внедрение под ключ. Ориентир бюджета: <strong>180–550 тыс. ₽</strong>. Первый шаг — <strong>«Найти просроченные обращения»</strong> и чек-лист потерь SLA за 15 минут.</p>
      </div>
      <div class="vsla-intro-kpi" aria-label="Ключевые метрики SLA">
        <div class="vsla-kpi-card"><div class="kv">74%</div><div class="kl">ожидают поддержку 24/7</div><div class="ks">Zendesk CX Trends 2026</div></div>
        <div class="vsla-kpi-card"><div class="kv">94.2%</div><div class="kl">цель % compliance</div><div class="ks">после пилота AI</div></div>
        <div class="vsla-kpi-card"><div class="kv">18 мин</div><div class="kl">до breach VIP-тикета</div><div class="ks">демо-дашборд</div></div>
        <div class="vsla-kpi-card"><div class="kv">15 мин</div><div class="kl">чек-лист потерь SLA</div><div class="ks">аудит Nero Network</div></div>
      </div>
    </div>
  </div>
</section>

<div class="vsla-toc-outer">
  <div class="vsla-cnt">
    <nav class="vsla-toc ym-toc" aria-label="Оглавление статьи">
      <a href="#prosrochki-sla">Просрочки</a>
      <a href="#kak-rabotaet">Как работает</a>
      <a href="#vnedrenie">Внедрение</a>
      <a href="#integracii">Интеграции</a>
      <a href="#stoimost">Стоимость</a>
      <a href="#keisy">Кейсы</a>
      <a href="#faq">FAQ</a>
    </nav>
  </div>
</div>

<section class="vsla-section vsla-section-alt" id="prosrochki-sla">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>Просрочки SLA в поддержке: почему теряются заявки и злятся клиенты</h2>
<p><strong>Коротко:</strong> просрочка SLA — это не только «опоздали с ответом», а цепочка сбоев: неверный приоритет, пустой assignee, пауза таймера, которую никто не учёл, канал без интеграции с очередью.</p>
<p>Типовая картина в B2B SaaS, e-commerce и сервисных компаниях: в helpdesk формально настроены нормативы, но руководитель узнаёт о breach постфактум — из жалобы клиента или еженедельного отчёта. Ответственный «теряется» между почтой, мессенджером и задачей в CRM. Клиент видит тишину, а внутри системы тикет числится «в работе».</p>
<p><strong>Основные причины просрочек SLA:</strong></p>
<ul><li>заявка создана без назначенного исполнителя;</li><li>приоритет занижен — критичное обращение попало в общую очередь;</li><li>статус «ожидание клиента» не поставлен, таймер resolution продолжает тикать;</li><li>обращение пришло в Telegram или WhatsApp, а SLA считается только по письму в helpdesk;</li><li>нативные триггеры CRM срабатывают с задержкой — после breach, а не до него.</li></ul>
<p>По данным исследования рынка, боль «заявки просрочены, ответственные теряются, клиент злится» массова у компаний с договорными SLA и несколькими каналами поддержки. Штрафы по B2B-контрактам, падение NPS и отток — прямое следствие системных пропусков, а не разовой ошибки оператора.</p>
<p><strong>Что даёт проактивный контроль:</strong> по документации Zendesk, автоматизации с условием «Hours until next SLA breach» позволяют уведомить команду за 2 часа до нарушения — но сами automations в Zendesk выполняются <strong>раз в час</strong>, не в реальном времени. Для точного окна «за 15–30 минут до breach» нужен внешний AI-агент или marketplace-приложение. Именно этот разрыв закрывает внедрение AI-контроля SLA под ключ.</p>
<p><strong>CTA:</strong> начните с аудита — <strong>найти просроченные обращения</strong> за последние 30–90 дней и увидеть, где именно рвётся цепочка. Nero Network предлагает чек-лист потерь SLA за 15 минут — быстрый срез до полного проекта.</p>
    </div>
  </div>
</section>

<div class="vsla-cnt"><aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-audit-sla">
  <div class="ym-cta-block__icon" aria-hidden="true">⏱</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Найти просроченные обращения за 15 минут</p>
    <p class="ym-cta-block__sub">Выгрузим тикеты за 30–90 дней, покажем карту breach по каналам и ответственным и дадим чек-лист потерь SLA. Без обязательств на полное внедрение.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside></div>

<section class="vsla-section" id="chto-takoe-sla">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>Что такое AI-контроль SLA в службе поддержки</h2>
<p><strong>Определение:</strong> AI-контроль SLA — надстройка над helpdesk/CRM, которая в реальном времени отслеживает таймеры <strong>первого ответа</strong> (first response), <strong>следующего ответа</strong> (next response) и <strong>решения</strong> (resolution) по каждой заявке, сравнивает их с договорными или внутренними нормативами, оценивает риск просрочки и <strong>до нарушения SLA</strong> запускает эскалацию: уведомление ответственного, смену приоритета, переназначение, пинг руководителю в Telegram или Slack.</p>
<p><strong>Мониторинг SLA в службе поддержке</strong> включает учёт рабочих часов (business hours), пауз при статусах pending/on-hold и разных политик по приоритету и типу клиента (VIP, enterprise tier).</p>
<p>Отличие от «просто SLA в CRM»:</p>
<div class="vsla-table-wrap nero-ai-reveal"><table class="vsla-table">
<thead><tr><th>Подход</th><th>Как работает</th><th>Ограничение</th></tr></thead><tbody>
<tr><td>Нативные правила helpdesk</td><td>триггеры «если до просрочки X часов → уведомить»</td><td>часто реагируют постфактум или с задержкой (часовые циклы)</td></tr>
<tr><td>AI-агент контроля SLA</td><td>risk score + предиктивный контроль «сорвёт SLA через N минут»</td><td>требует интеграции и калибровки</td></tr>
<tr><td>Полная автономия (agentic resolution)</td><td>AI закрывает типовые тикеты без человека</td><td>отдельный продуктовый слой; SLA-контроль — фундамент</td></tr>
</tbody></table></div>
<p>В российском контексте Okdesk, HelpDeskEddy и Битрикс24 дают зрелый SLA из коробки — нормативы по договорам, графики обслуживания, триггеры эскалации при приближении дедлайна. Nero Network не заменяет helpdesk, а ставит <strong>AI-слой</strong> поверх: классификация приоритета, предсказание breach, умная эскалация между каналами (почта → CRM → мессенджер → руководитель).</p>
<p>Тренд 2026 года: переход от rule-based ботов к агентам, решающим многошаговые запросы. IBM в материале о автоматизации контакт-центров со ссылкой на McKinsey указывает на потенциал до <strong>50% снижения cost per call</strong> при росте CSAT. Параллельно Freshworks (2025) выводит Freddy AI Insights — проактивные алерты при всплеске SLA breaches с root cause analysis до эскалации к клиентам.</p>
    </div>
  </div>
</section>

<section id="vnedrenie-ai-kontrol-sla-boris-block" class="vslb-root" aria-label="Анимация: матрица эскалации SLA — от риска до Telegram-алерта">
<style>
/* === БОРИС: prefix vslb-, scoped внутри #vnedrenie-ai-kontrol-sla-boris-block === */
#vnedrenie-ai-kontrol-sla-boris-block.vslb-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-kontrol-sla-boris-block .vslb-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-kontrol-sla-boris-block .vslb-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0ea5e9;
  margin:0 0 14px;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0ea5e9;
  border-radius:1px;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-ul{
  list-style:none;
  margin:0 0 20px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  font-weight:700;
  margin-top:1px;
  font-style:normal;
  color:#fff;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-ic-g{background:#22c55e;}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-ic-y{background:#eab308;}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-ic-o{background:#f97316;}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-ic-r{background:#ef4444;}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:20px;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-pl-y{
  background:rgba(234,179,8,.1);
  color:#a16207;
  border:1.5px solid rgba(234,179,8,.28);
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-pl-o{
  background:rgba(249,115,22,.1);
  color:#c2410c;
  border:1.5px solid rgba(249,115,22,.28);
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-pl-r{
  background:rgba(239,68,68,.08);
  color:#b91c1c;
  border:1.5px solid rgba(239,68,68,.22);
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-cta{
  margin-bottom:14px;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-kontrol-sla-boris-block .vslb-rgt{
  position:relative;
  background:linear-gradient(145deg,#f0f9ff 0%,#e0f2fe 40%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-kontrol-sla-boris-block .vslb-rgt{min-height:380px;}
}
#vsla-escalation-ladder-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="vslb-cnt">
  <div class="vslb-card">

    <div class="vslb-lft">
      <span class="vslb-ey">Матрица эскалации</span>
      <h3 class="vslb-h3">До breach — не постфактум: AI ведёт заявку по ступеням риска</h3>
      <ul class="vslb-ul">
        <li><span class="vslb-ic vslb-ic-y">1</span><strong>−120 мин</strong> или risk ≥50% — пинг ответственному в Telegram</li>
        <li><span class="vslb-ic vslb-ic-o">2</span><strong>−30 мин</strong> или risk ≥70% — тимлид, повышение приоритета</li>
        <li><span class="vslb-ic vslb-ic-r">3</span><strong>Breach</strong> — руководитель, тег <code>sla_breached</code>, задача в CRM</li>
        <li><span class="vslb-ic vslb-ic-g">AI</span>Risk Scorer пересчитывает таймеры каждые 5–15 мин — вне часового цикла CRM</li>
      </ul>
      <div class="vslb-pills">
        <span class="vslb-pl vslb-pl-y">раннее предупреждение</span>
        <span class="vslb-pl vslb-pl-o">критическая зона</span>
        <span class="vslb-pl vslb-pl-r">breach → эскалация</span>
      </div>
      <div class="vslb-cta">
        <a class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
      <p class="vslb-foot">Дальше разберём модули SLA Engine, Risk Scorer и Escalation Router →</p>
    </div>

    <div class="vslb-rgt">
      <canvas
        id="vsla-escalation-ladder-canvas"
        role="img"
        aria-label="Анимация: заявки проходят через зоны риска SLA, AI оценивает score и отправляет эскалации в Telegram"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vsla-escalation-ladder-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 440;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    line:'rgba(14,165,233,.3)',
    ok:'#22c55e',
    warn:'#eab308',
    crit:'#f97316',
    breach:'#ef4444',
    ai:'#8b5cf6',
    aiGlow:'rgba(139,92,246,.22)',
    card:'#ffffff',
    cardBdr:'#cbd5e1',
    tg:'#229ed9',
    tgDark:'#1a8bc7'
  };

  var ZONES = [
    {id:'ok',     label:'В норме',           sub:'compliance', color:C.ok,     y:0},
    {id:'warn',   label:'−120 мин',          sub:'risk ≥50%',  color:C.warn,   y:0},
    {id:'crit',   label:'−30 мин',           sub:'risk ≥70%',  color:C.crit,   y:0},
    {id:'breach', label:'Breach',            sub:'sla_breached',color:C.breach,y:0}
  ];

  var tickets = [];
  var pings = [];
  var cycle = 0;

  function rr(ctx,x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){
      ctx.strokeStyle=stroke;
      ctx.lineWidth=lw||1.5;
      ctx.stroke();
    }
  }

  function spawnTicket(){
    var ids = ['#4821','#4819','#4807','#4798','#4785'];
    var prios = ['P1 VIP','P2','P3','P2','P1'];
    var zones = ['ok','warn','crit','breach'];
    var startZone = zones[Math.floor(Math.random()*zones.length)];
    tickets.push({
      id: ids[tickets.length % ids.length],
      prio: prios[tickets.length % prios.length],
      zone: startZone,
      targetZone: startZone,
      x: W*0.08,
      y: 0,
      t: 0,
      risk: startZone === 'ok' ? 0.25 : startZone === 'warn' ? 0.55 : startZone === 'crit' ? 0.78 : 0.95,
      mins: startZone === 'ok' ? 180 : startZone === 'warn' ? 95 : startZone === 'crit' ? 22 : -3,
      phase: 'enter'
    });
  }

  function spawnPing(tx, ty, level){
    pings.push({
      x: tx, y: ty,
      tx: W*0.88, ty: H*0.12 + Math.random()*H*0.08,
      t: 0, alpha: 1, level: level
    });
  }

  function zoneY(idx){
    return H*0.18 + idx * (H*0.17);
  }

  function drawZone(z, i){
    z.y = zoneY(i);
    var x = W*0.52, w = W*0.4, h = H*0.13;
    rr(ctx, x, z.y, w, h, 8, 'rgba(255,255,255,.92)', z.color, 2);
    ctx.fillStyle = z.color;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(z.label, x+12, z.y+18);
    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.fillText(z.sub, x+12, z.y+h-10);
    /* индикатор полосы SLA */
    var barW = w - 24;
    rr(ctx, x+12, z.y+26, barW, 5, 2, '#e2e8f0', null);
    var fill = Math.min(1, 0.2 + i*0.22 + 0.08*Math.sin(frame*0.04+i));
    rr(ctx, x+12, z.y+26, barW*fill, 5, 2, z.color, null);
  }

  function drawAiScorer(cx, cy, r){
    var pulse = 0.5 + 0.5*Math.sin(frame*0.07);
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0, C.aiGlow);
    g.addColorStop(1, 'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx,cy,r*1.7,0,Math.PI*2);
    ctx.fill();
    rr(ctx,cx-r,cy-r,r*2,r*2,r*0.4,'#f5f3ff',C.ai,2);
    ctx.fillStyle = C.ai;
    ctx.font = 'bold ' + Math.max(10,r*0.2) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('Risk', cx, cy-4);
    ctx.font = Math.max(8,r*0.15) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('Scorer', cx, cy+r*0.35);
    ctx.strokeStyle = C.ai;
    ctx.lineWidth = 1.5 + pulse*2;
    ctx.globalAlpha = 0.25 + pulse*0.35;
    ctx.beginPath();
    ctx.arc(cx,cy,r+5+pulse*6,0,Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawTicket(tk, x, y, w, h){
    var zoneColor = ZONES.find(function(z){return z.id===tk.zone;});
    var col = zoneColor ? zoneColor.color : C.muted;
    rr(ctx,x,y,w,h,6,C.card,col,2);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(tk.id, x+8, y+14);
    ctx.fillStyle = col;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText(tk.prio, x+8, y+26);
    /* risk arc */
    var cx = x+w-14, cy = y+h*0.5, rad = 10;
    ctx.strokeStyle = '#e2e8f0';
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(cx,cy,rad,-Math.PI/2,Math.PI*1.5);
    ctx.stroke();
    ctx.strokeStyle = col;
    ctx.beginPath();
    ctx.arc(cx,cy,rad,-Math.PI/2,-Math.PI/2+Math.PI*2*tk.risk);
    ctx.stroke();
    /* mins */
    ctx.fillStyle = C.muted;
    ctx.font = '8px system-ui,sans-serif';
    ctx.textAlign = 'center';
    var minsTxt = tk.mins > 0 ? tk.mins+'м' : 'breach';
    ctx.fillText(minsTxt, cx, cy+3);
  }

  function drawTelegramBubble(px, py, alpha, level){
    if(alpha < 0.05) return;
    ctx.globalAlpha = alpha;
    var bw = 52, bh = 28;
    rr(ctx, px-bw*0.5, py-bh*0.5, bw, bh, 8, C.tg, C.tgDark, 1.5);
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 9px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('TG', px, py-2);
    ctx.font = '7px system-ui,sans-serif';
    ctx.fillText(level === 'breach' ? 'руковод.' : 'алерт', px, py+8);
    /* хвостик */
    ctx.fillStyle = C.tg;
    ctx.beginPath();
    ctx.moveTo(px-bw*0.15, py+bh*0.5);
    ctx.lineTo(px-bw*0.3, py+bh*0.5+6);
    ctx.lineTo(px+bw*0.05, py+bh*0.5);
    ctx.fill();
    ctx.globalAlpha = 1;
  }

  function advanceTicket(tk){
    tk.t++;
    var zoneIdx = ZONES.findIndex(function(z){return z.id===tk.zone;});
    var targetIdx = zoneIdx;
    if(tk.t % 180 === 0 && zoneIdx < ZONES.length - 1){
      targetIdx = zoneIdx + 1;
      tk.targetZone = ZONES[targetIdx].id;
      tk.risk = Math.min(0.98, tk.risk + 0.22);
      tk.mins = targetIdx === 1 ? 95 : targetIdx === 2 ? 22 : targetIdx === 3 ? -3 : 180;
      if(targetIdx >= 2) spawnPing(W*0.38, zoneY(targetIdx)+H*0.065, targetIdx === 3 ? 'breach' : 'crit');
    }
    if(tk.t % 180 === 90 && tk.zone !== tk.targetZone){
      tk.zone = tk.targetZone;
    }
    var zi = ZONES.findIndex(function(z){return z.id===tk.zone;});
    var tx = W*0.06 + Math.sin(frame*0.02 + tk.t*0.01)*4;
    var ty = zoneY(zi) + H*0.03;
    return {x:tx, y:ty};
  }

  function tick(){
    frame++;
    cycle++;
    if(frame % 140 === 0 && tickets.length < 4) spawnTicket();

    ZONES.forEach(function(z,i){ z.y = zoneY(i); });

    ctx.clearRect(0,0,W,H);

    /* подписи */
    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Очередь helpdesk', W*0.05, H*0.1);
    ctx.textAlign = 'right';
    ctx.fillText('Эскалация → Telegram', W*0.95, H*0.1);

    /* зоны */
    ZONES.forEach(drawZone);

    /* AI scorer */
    drawAiScorer(W*0.34, H*0.52, Math.min(W,H)*0.08);

    /* связующие линии */
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([5,4]);
    ctx.beginPath();
    ctx.moveTo(W*0.22, H*0.5);
    ctx.lineTo(W*0.26, H*0.52);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(W*0.42, H*0.48);
    ctx.lineTo(W*0.52, H*0.35);
    ctx.stroke();
    ctx.setLineDash([]);

    /* тикеты */
    tickets.forEach(function(tk, idx){
      var pos = advanceTicket(tk);
      var tw = W*0.18, th = H*0.1;
      drawTicket(tk, pos.x, pos.y + idx*4, tw, th);
    });
    if(tickets.length > 4) tickets.shift();

    /* telegram pings */
    pings = pings.filter(function(p){
      p.t++;
      p.x += (p.tx - p.x) * 0.06;
      p.y += (p.ty - p.y) * 0.06;
      p.alpha = Math.max(0, 1 - p.t/90);
      drawTelegramBubble(p.x, p.y, p.alpha, p.level);
      return p.t < 95;
    });

    requestAnimationFrame(tick);
  }

  spawnTicket();
  spawnTicket();
  requestAnimationFrame(tick);
})();
</script>
</section>

<section class="vsla-section vsla-section-alt" id="kak-rabotaet">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>Как AI-агент контролирует SLA, приоритеты и эскалацию</h2>
<p>AI-контроль заявок строится на трёх модулях: <strong>SLA Engine</strong> (расчёт дедлайнов), <strong>Risk Scorer</strong> (оценка риска), <strong>Escalation Router</strong> (маршрутизация алертов). Ниже — как это работает на практике.</p>
<h3>Отслеживание дедлайнов и статусов по SLA</h3>
<p>Агент по webhook или cron (каждые 5–15 минут) пересчитывает для каждого открытого тикета:</p>
<ul><li><code>time_to_breach</code> — сколько осталось до нарушения по каждой SLA-политике;</li><li>учёт пауз таймера при корректных статусах;</li><li>привязку политики first response / next response / resolution к приоритету и календарю.</li></ul>
<p>ServiceNow в workflow «Explain SLA» показывает elapsed time, reassignments и риск breach <strong>до</strong> нарушения — агент отвечает на вопрос «почему рискуем сорвать». Nero Network переносит эту логику объяснимости в поддержку SMB и mid-market: эскалация сопровождается summary из 3–5 предложений — что случилось и что делать.</p>
<h3>Приоритизация критичных обращений</h3>
<p><strong>Risk Scorer</strong> сочетает правила и LLM:</p>
<ul><li>приоритет и тип обращения из текста (intent, urgency, sentiment);</li><li>статус VIP-клиента и tier по договору;</li><li>возраст тикета, idle time, загрузка назначенного агента;</li><li>история клиента (повторные обращения, прошлые breach).</li></ul>
<p>Модель «экзоинтеллект» из кейса ТЕХНОНИКОЛЬ (AutoFAQ Xplain AI Copilot): оператор остаётся в контуре решения, ИИ ускоряет классификацию и подсказки. Для SLA-агента аналогично: AI не подменяет финальное решение по VIP и юридически значимым обращениям — человек утверждает спорные эскалации.</p>
<h3>Автоэскалация руководителю и в CRM/helpdesk</h3>
<p><strong>Матрица эскалации</strong> (пример для внедрения):</p>
<div class="vsla-table-wrap nero-ai-reveal"><table class="vsla-table">
<thead><tr><th>Этап</th><th>Условие</th><th>Действие</th></tr></thead><tbody>
<tr><td>Раннее предупреждение</td><td>−120 мин до breach или risk ≥50%</td><td>уведомление ответственному в Telegram</td></tr>
<tr><td>Критическая зона</td><td>−30 мин или risk ≥70%</td><td>пинг тимлиду, повышение приоритета</td></tr>
<tr><td>Breach</td><td>нарушение SLA</td><td>руководитель, тег <code>sla_breached</code>, задача в CRM</td></tr>
<tr><td>Post-breach</td><td>+60 мин без реакции</td><td>повторная эскалация, переназначение</td></tr>
</tbody></table></div>
<p>Freshdesk SLA Policies поддерживают многоуровневую эскалацию: за 30 мин до breach, на breach, после breach. Zendesk рекомендует матрицу 50% SLA → агент, 80% → тимлид, breach → руководитель. AI-агент Nero выполняет эту логику <strong>вне часового цикла</strong> нативных automations — через Make, n8n или собственный FastAPI-контур.</p>
<p><strong>Автоматическая эскалация обращений</strong> включает: смену assignee, <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-amocrm/' ) ); ?>" class="ym-link ym-link--accent">создание задач в amoCRM через AI-агента</a>, синхронизацию с Битрикс24, запись в Google Sheets для еженедельного отчёта compliance.</p>
    </div>
  </div>
</section>

<section class="vsla-section" id="vnedrenie">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>Внедрение AI-контроля SLA под ключ</h2>
<p><strong>Внедрение ai контроль sla</strong> в Nero Network — проект с фиксированными этапами, ориентир чека <strong>180–550 тыс. ₽</strong> (из брифа темы). Публичных прямых кейсов формулировки «AI-агент именно для контроля SLA и эскалации просрочек» в РФ недостаточно; ниже — воспроизводимая архитектура, которую команда разворачивает под клиента.</p>
<h3>Аудит текущих SLA и точек потерь (лид-магнит: чек-лист за 15 минут)</h3>
<p><strong>День 1–2:</strong> выгрузка 30–90 дней тикетов из helpdesk/CRM → карта просрочек по приоритету, каналу, ответственному → baseline метрик FRT (first response time), ART (average resolution time) и % breach.</p>
<p>Чек-лист потерь SLA за 15 минут — быстрый самодиагностический срез: сколько тикетов без assignee, какой канал даёт больше всего breach, есть ли «repeat offenders» среди агентов. Этот лид-магнит отсутствует у конкурентов вроде AiKraft и Viora.pro в узкой связке с российским стеком.</p>
<h3>Настройка правил, порогов и сценариев эскалации</h3>
<ul><li>синхронизация SLA-политик из договоров B2B или внутренних регламентов;</li><li>калибровка порогов: risk ≥70% и <2 ч до breach → Telegram ответственному; ≥90% или VIP → тимлид + смена assignee;</li><li>20–50 примеров «хороших» и «плохих» тикетов для обучения классификатора;</li><li>матрица эскалации агент → тимлид → руководитель с chat_id для алертов.</li></ul>
<h3>Запуск и обучение команды поддержки</h3>
<ul><li><strong>Пилот 2–4 недели</strong> на одной очереди (например, только возвраты или только VIP);</li><li>дашборд в Google Sheets или Metabase: % SLA compliance, топ причин просрочек;</li><li>обучение: как читать эскалации, когда переопределять приоритет вручную;</li><li>масштабирование на остальные очереди после стабилизации baseline.</li></ul>
<p>По методологии ThinkBot Agency (n8n-связка helpdesk → CRM → Slack/Teams): структурированный выход LLM → детерминированная маршрутизация → эскалация по политике. Nero Network использует тот же паттерн на стеке Make/n8n + OpenAI/Claude + Telegram.</p>
    </div>
  </div>
</section>

<div class="vsla-cnt"><aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите понимать AI-эскалацию до старта проекта?</p>
    <p class="ym-cta-block__sub">Если команде важно разобраться в n8n, risk scoring и human-in-the-loop на VIP-заявках — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование SLA-матрицы и пилота на одной очереди.</p>
  </div>
</aside></div>

<section class="vsla-section vsla-section-alt" id="integracii">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>Интеграция с CRM и helpdesk</h2>
<p><strong>Ai контроль sla интеграция crm</strong> — ключевое требование: без сквозной синхронизации заявок, ответственных и уведомлений AI-агент превращается в отчёт, который никто не читает.</p>
<h3>amoCRM, Битрикс24, Zendesk, Freshdesk и мессенджеры</h3>
<p><strong>Российский стек:</strong></p>
<ul><li><strong>amoCRM</strong> — сделки/лиды + входящие обращения;</li><li><strong>Битрикс24</strong> — CRM, задачи, Открытые линии (Telegram, WhatsApp, VK); нативная bot-платформа для AI-агентов внутри портала;</li><li><strong>HelpDeskEddy, Okdesk, Usedesk</strong> — зрелый SLA из коробки, отчёты по compliance;</li><li><strong>Telegram</strong> — канал эскалаций для ответственных и руководителей.</li></ul>
<p><strong>Международный стек</strong> (для филиалов и SaaS с Zendesk/Freshdesk):</p>
<ul><li>Zendesk — SLA-политики + hourly automations (ограничение по частоте);</li><li>Freshdesk — Freddy AI Insights и многоуровневая эскалация в SLA Policies.</li></ul>
<p><strong>Ingest-модуль</strong> принимает webhook/API из всех перечисленных систем. Опционально: Mango Office, UIS для голосовых SLA; для учётных контуров — <a href="<?php echo esc_url( home_url( '/ai-1c-erp/' ) ); ?>" class="ym-link ym-link--accent">интеграция AI с 1С и ERP</a>; база знаний Confluence/Notion для summary-агента.</p>
<h3>Синхронизация заявок, ответственных и уведомлений</h3>
<p>Типовая цепочка:</p>
<ol><li>Заявка создаётся (почта, виджет, Telegram, WhatsApp, Битрикс24 Открытые линии).</li><li>Webhook → очередь (Redis/n8n) → AI классифицирует тип, приоритет, привязывает SLA-политику.</li><li>Фоновый агент пересчитывает таймеры.</li><li>При приближении к breach — контекст (summary треда) и эскалация.</li><li>После закрытия — аналитика; AI помечает паттерны («категория X срывает SLA по пятницам»).</li></ol>
<p><strong>Ai агент helpdesk</strong> не дублирует тикет-систему: он читает и обновляет статусы, assignee, теги, создаёт связанные задачи в CRM. Для требований 152-ФЗ переписка и AI-summary обрабатываются в согласованном контуре — при необходимости YandexGPT или on-prem webhook-агент в периметре клиента.</p>
    </div>
  </div>
</section>

<div class="vsla-cnt"><div class="vsla-chips nero-ai-reveal" aria-label="Интеграции helpdesk и CRM">
  <span>amoCRM</span><span>Битрикс24</span><span>Okdesk</span><span>HelpDeskEddy</span><span>Zendesk</span><span>Freshdesk</span><span>Telegram</span><span>Make / n8n</span>
</div></div>

<section class="vsla-section" id="stoimost">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>Сколько стоит AI-контроль SLA</h2>
<p><strong>Ai контроль sla цена</strong> зависит от глубины интеграции, числа каналов и очередей. Ориентир по брифу Nero Network: <strong>180–550 тыс. ₽</strong> за типовой проект «аудит + интеграция helpdesk/CRM + AI-агент эскалации + дашборд».</p>
<p><strong>Из чего складывается стоимость:</strong></p>
<div class="vsla-table-wrap nero-ai-reveal"><table class="vsla-table">
<thead><tr><th>Компонент</th><th>Что входит</th></tr></thead><tbody>
<tr><td>Аудит SLA</td><td>выгрузка тикетов, карта breach, чек-лист за 15 мин</td></tr>
<tr><td>Интеграция</td><td>webhook/API helpdesk + CRM + Telegram</td></tr>
<tr><td>AI-агент</td><td>Risk Scorer, Escalation Router, Summary Agent</td></tr>
<tr><td>Дашборд</td><td>Google Sheets / Metabase, еженедельный отчёт</td></tr>
<tr><td>Пилот и обучение</td><td>2–4 недели на одной очереди, масштабирование</td></tr>
</tbody></table></div>
<p><strong>Сколько стоит ai контроль sla</strong> в сравнении с альтернативами: ФОТ сотрудника, который вручную мониторит очередь (частичная занятость руководителя поддержки), плюс штрафы по B2B-договорам за breach. Прямых гарантий ROI в цифрах для узкого продукта «только SLA-агент» в открытых источниках нет — ориентиры берут из смежных кейсов ускорения поддержки.</p>
<p><strong>Ai контроль sla заказать:</strong> CTA «Найти просроченные обращения» + расчёт калькулятора упущенной маржи/штрафов — на странице будет блок калькулятора (задача вёрстки пайплайна). Консультация Nero Network начинается с аудита, без обязательства полного внедрения.</p>
    </div>
  </div>
</section>

<div class="vsla-cnt"><div class="vsla-calc-wrap nero-ai-reveal" id="vsla-roi-calc" aria-label="Калькулятор упущенной маржи и штрафов по SLA">
  <div class="vsla-calc-card">
    <h3>Калькулятор потерь от просрочек SLA</h3>
    <p>Оцените штрафы по B2B-договорам и стоимость ручного мониторинга очереди — на аудите Nero Network подставим ваши цифры.</p>
    <div class="vsla-calc-grid">
      <label>Тикетов в месяц <input type="number" value="800" min="50" class="vsla-calc-input" data-vsla-calc="tickets" aria-label="Тикетов в месяц"></label>
      <label>% breach сейчас <input type="number" value="12" min="1" max="50" class="vsla-calc-input" data-vsla-calc="breach" aria-label="Процент breach"></label>
      <label>Штраф за breach, ₽ <input type="number" value="5000" min="0" class="vsla-calc-input" data-vsla-calc="fine" aria-label="Штраф за breach"></label>
    </div>
    <p class="vsla-calc-result"><strong>Ориентир потерь:</strong> <span id="vsla-calc-output">480 000 ₽/мес</span> при снижении breach на 50% — экономия от <span id="vsla-calc-save">240 000 ₽/мес</span></p>
  </div>
</div></div>

<div class="vsla-cnt"><div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-stoimost">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте бюджет под ваш helpdesk</p>
    <p class="ym-cta-block__sub">Ориентир 180–550 тыс. ₽ за внедрение под ключ. На аудите «Найти просроченные обращения» оценим интеграции, очереди и ROI от снижения breach — бесплатно.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы по внедрению</a>
    </div>
  </div>
</div></div>

<section class="vsla-section vsla-section-alt" id="dlya-kogo">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>Для кого подходит AI-агент контроля SLA</h2>
<p><strong>Ai контроль sla для бизнеса</strong> актуален, когда объём обращений вырос быстрее процессов, а договорные или репутационные SLA уже нельзя игнорировать.</p>
<p><strong>Целевые сегменты (из брифа и исследования):</strong></p>
<ul><li><strong>B2B SaaS</strong> — разные tier клиентов, договорные SLA, мультиканальность;</li><li><strong>E-commerce</strong> — пики нагрузки, возвраты, VIP-покупатели;</li><li><strong>Сервисные компании</strong> — выездные бригады, Okdesk/HelpDeskEddy, SLA по договорам обслуживания.</li></ul>
<p><strong>Ai контроль sla для малого бизнеса:</strong> пилот на одной очереди за 2–4 недели снижает порог входа. Не нужна собственная IT-команда — внедрение под ключ на Make/n8n. Минимальные данные для старта: экспорт тикетов, текущие нормативы, список ответственных, API-ключи helpdesk, Telegram chat_id для алертов.</p>
<p>Ожидания потребителей растут: по Zendesk CX Trends 2026, <strong>74%</strong> потребителей из-за AI ожидают поддержку <strong>24/7</strong>; <strong>83%</strong> считают, что опыт должен быть лучше. SLA-контроль — часть ответа на этот запрос даже при частично человеческой линии.</p>
    </div>
  </div>
</section>

<section class="vsla-section" id="keisy">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>Примеры внедрения и кейсы</h2>
<p><strong>Важно:</strong> публичных прямых кейсов «AI-агент именно для контроля SLA и эскалации просрочек» в России <strong>не найдено</strong>. Ниже — проверенные смежные внедрения и международные аналоги. Цифры — только из указанных источников.</p>
<h3>Россия: ускорение поддержки и косвенный эффект на SLA</h3>
<p><strong>Ростелеком-ЦОД + AutoFAQ</strong> (<a href="https://autofaq.ai/case/rostelecom" target="_blank" rel="noopener noreferrer">кейс</a>): омниканальный чат-центр с ИИ, интеграция с BMC Remedy ITSM. До 40–80% обращений закрываются ботом; время реакции сократилось <strong>в 10 раз</strong>; NPS вырос с <strong>−4 до 30</strong> за 6 месяцев (данные 2021 г.). Это не отдельный «AI-агент SLA», но доказывает ROI ускорения поддержки в РФ.</p>
<p><strong>ТЕХНОНИКОЛЬ + AutoFAQ Xplain AI Copilot</strong> (<a href="https://autofaq.ai/case/tehnonikol" target="_blank" rel="noopener noreferrer">кейс</a>, <a href="https://companies.rbc.ru/news/J81mUROluP/ii-pomog-uskorit-chat-podderzhku-tehnonikol-v-3-raza/" target="_blank" rel="noopener noreferrer">РБК</a>): модель «экзоинтеллект» — оператор + нейросеть. Время консультаций <strong>↓ в 3 раза</strong>, CSAT <strong>97%</strong>, точность ИИ <strong>92%</strong> (обновление 30.04.2026). Платформа AutoFAQ имеет встроенные SLA-дашборды (AFRT/ART, доля диалогов в SLA). Андрей Цымбалюк (ТЕХНОНИКОЛЬ): «внедрение позволило снизить время консультаций в 3 раза; 80% чатов получили положительные отзывы».</p>
<p><strong>Okdesk</strong> (<a href="https://help.okdesk.ru/knowledge_base/sections/4-nastroika-normativov-resheniya-zayavok-sla-51" target="_blank" rel="noopener noreferrer">документация SLA</a>): модуль SLA с нормативами, графиками, триггерами эскалации — <strong>базовый слой</strong>, поверх которого Nero ставит AI (классификация, предсказание breach). Публичного кейса «AI-агент SLA поверх Okdesk» не найдено.</p>
<h3>Международные аналоги проактивного SLA</h3>
<ul><li><strong>Zendesk</strong> — алерт за 2 часа до breach; ограничение hourly automations (<a href="https://support.zendesk.com/hc/en-us/articles/4408820131994-Workflow-How-to-alert-your-team-to-tickets-nearing-an-SLA-breach" target="_blank" rel="noopener noreferrer">документация</a>).</li><li><strong>Freshworks Freddy AI Insights (2025)</strong> — алерты на всплески SLA breaches, root cause до эскалации к клиентам.</li><li><strong>ServiceNow Explain SLA</strong> — анализ назначений, пауз, риска breach до нарушения.</li><li><strong>Cyntexa + ServiceNow Predictive Intelligence</strong> — предсказание breach для MSP с разными SLA по tier клиентов.</li><li><strong>ThinkBot / n8n</strong> — кастомный агент: helpdesk → CRM → Slack, таймеры «due soon», классификация intent/urgency/sentiment.</li></ul>
<p><strong>Ai контроль sla кейсы</strong> для узкого продукта — проектная сборка Nero Network под клиента. Честная подача: сильные российские цифры — про <strong>ускорение</strong> (ТЕХНОНИКОЛЬ, Ростелеком), отдельный SLA-бот — инженерный проект на вашем стеке.</p>
    </div>
  </div>
</section>

<section class="vsla-section vsla-section-alt" id="biznes-processy">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>Внедрение AI в бизнес-процессы поддержки</h2>
<p><strong>Внедрение ai в бизнес</strong> поддержки в 2026 году — не выбор между «ботом» и «людьми», а слоистая архитектура; об этом же говорят <a href="<?php echo esc_url( home_url( '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>" class="ym-link ym-link--accent">масштабные корпоративные внедрения AI</a>. <strong>Внедрение ai агентов</strong> и <strong>внедрение ai решений</strong> в контур SLA даёт измеримый эффект на дисциплину процессов, даже когда узкое место — не скорость ответа, а контроль дедлайнов.</p>
<p><strong>Внедрение ai в бизнес процессы</strong> поддержки по модели Nero Network:</p>
<ol><li><strong>Ingest</strong> — единая очередь из всех каналов.</li><li><strong>SLA Engine</strong> — дедлайны, business hours, паузы.</li><li><strong>Risk AI</strong> — классификация, предсказание breach, аномалии.</li><li><strong>Escalation Router</strong> — Telegram, email, CRM-задачи.</li><li><strong>Analytics</strong> — compliance, FRT, ART, escalation rate, repeat breach по агенту.</li></ol>
<p>По отчёту Zendesk 2025 (<strong>10 000+</strong> респондентов), <strong>75%</strong> CX-лидеров ожидают, что <strong>80%</strong> обращений будут решаться без человека в ближайшие годы; <strong>73%</strong> агентов считают, что AI-copilot поможет в работе. Rob Thomas (IBM): «клиенты всё больше готовы к высокоавтоматизированным каналам; NPS цифровых агентов может быть выше, чем у классического call-центра».</p>
<p><strong>Внедрение нейросетей</strong> в поддержку без замены helpdesk — позиция Nero Network: гибрид нативного SLA + AI risk score + human-in-the-loop на VIP. Конкурент AiKraft описывает роботизацию контроля SLA (RPA + ИИ), но без кейсов, калькулятора и привязки к конкретным helpdesk — пробел, который закрывает эта посадочная.</p>
<p>Метрики до/после внедрения (без выдуманных гарантий):</p>
<ul><li>% SLA compliance;</li><li>FRT и ART;</li><li>escalation rate по категориям;</li><li>доля repeat breach по агенту;</li><li>снижение ручного мониторинга очереди руководителем.</li></ul>
<p>Качественный результат: меньше «тихих» просрочек, быстрее реакция на at-risk тикеты, прозрачная ответственность.</p>
    </div>
  </div>
</section>

<section class="vsla-section vsla-section-alt" id="faq">
  <div class="vsla-cnt">
    <div class="vsla-body nero-ai-reveal">
<h2>FAQ по AI-контролю SLA</h2>
<div class="vsla-faq nero-ai-reveal">
<div class="vsla-faq-item"><div class="vsla-faq-q" tabindex="0" role="button" aria-expanded="false">Нужны ли программисты для внедрения?</div><div class="vsla-faq-a"><p><strong>Ai контроль sla без программиста</strong> — да, при модели «под ключ». Nero Network настраивает интеграции на Make/n8n, webhook-агенты и Telegram-эскалации. С вашей стороны: доступы API helpdesk/CRM, согласование SLA-матрицы и матрицы эскалации. Для on-prem или YandexGPT в контуре клиента — отдельное согласование архитектуры (паттерн Битрикс24 bot platform).</p></div></div>
<div class="vsla-faq-item"><div class="vsla-faq-q" tabindex="0" role="button" aria-expanded="false">Как быстро окупается контроль SLA?</div><div class="vsla-faq-a"><p>Прямых публичных ROI именно для «только SLA-агент» нет. Ориентиры из смежных кейсов: ускорение первого ответа до <strong>10×</strong> (Ростелеком-ЦОД) и консультаций <strong>в 3 раза</strong> (ТЕХНОНИКОЛЬ) — при условии, что узкое место скорость. Если узкое место — дисциплина эскалации, эффект в снижении breach % и штрафов по B2B. Пилот 2–4 недели даёт baseline для решения о масштабировании.</p></div></div>
<div class="vsla-faq-item"><div class="vsla-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли подключить к уже работающему helpdesk?</div><div class="vsla-faq-a"><p>Да. <strong>Как внедрить ai контроль sla:</strong> AI-надстройка, не миграция. Работает поверх Okdesk, HelpDeskEddy, Битрикс24, amoCRM, Zendesk, Freshdesk. Нативные SLA остаются источником нормативов; агент добавляет risk score и проактивную эскалацию в реальном времени.</p>
<p><strong>Дополнительные вопросы:</strong></p>
<ul><li><strong>«У нас уже есть SLA в CRM»</strong> — нативные правила часто реактивны; AI даёт предиктивный контроль и объяснимость (как ServiceNow Explain SLA).</li><li><strong>«AI ошибётся в приоритете»</strong> — human-in-the-loop на VIP; аудит логов эскалаций.</li><li><strong>«Дорого»</strong> — сравнение с ФОТ ручного контроля и штрафами; чек 180–550 тыс. ₽ vs стоимость потерянного клиента.</li><li><strong>«Долго внедрять»</strong> — пилот на одной очереди 2–4 недели по аналогии с n8n-гайдом ThinkBot.</li></ul>
<p><strong>Итог:</strong> AI-агент для контроля SLA в поддержке — это проактивная надстройка над вашим helpdesk и CRM. Nero Network внедряет аудит, интеграцию, risk scoring и эскалацию в Telegram под ключ — от чек-листа потерь SLA за 15 минут до пилота и масштабирования. <strong>Найти просроченные обращения</strong> — первый шаг к прозрачным SLA и спокойным клиентам.</p></div></div>
</div>
    </div>
  </div>
</section>

<section class="vsla-section" id="cta-final" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
  <div class="vsla-cnt" style="text-align:center">
    <span class="vsla-eyebrow">Первый шаг бесплатно</span>
    <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px">Найти просроченные обращения:<br>чек-лист потерь SLA за 15 минут</h2>
    <p style="max-width:580px;margin:0 auto 28px;font-size:16px">Nero Network выгрузит тикеты за 30–90 дней, покажет карту breach и даст рекомендации по AI-эскалации — без обязательства полного внедрения.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</section>

</div><!-- /.vsla-content -->

<?php
$vsla_page_url = trailingslashit( get_permalink() );
$vsla_site_url = trailingslashit( home_url( '/' ) );
$vsla_brand    = get_bloginfo( 'name' ) ?: 'Nero Network'; // pragma: allowlist secret
$vsla_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vsla_site_url . '#organization',
      'name'  => $vsla_brand,
      'url'   => $vsla_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vsla_site_url . '#website',
      'url'       => $vsla_site_url,
      'name'      => $vsla_brand,
      'publisher' => [ '@id' => $vsla_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vsla_page_url . '#webpage',
      'url'         => $vsla_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vsla_site_url . '#website' ],
      'about'       => [ '@id' => $vsla_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vsla_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vsla_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vsla_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vsla_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $vsla_page_url,
      'provider'    => [ '@id' => $vsla_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vsla_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Нужны ли программисты для внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ai контроль sla без программиста — да, при модели «под ключ». Nero Network настраивает интеграции на Make/n8n, webhook-агенты и Telegram-эскалации.' ] ],
        [ '@type' => 'Question', 'name' => 'Как быстро окупается контроль SLA?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентиры из смежных кейсов: ускорение первого ответа до 10× (Ростелеком-ЦОД) и консультаций в 3 раза (ТЕХНОНИКОЛЬ). Пилот 2–4 недели даёт baseline для масштабирования.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли подключить к уже работающему helpdesk?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. AI-надстройка работает поверх Okdesk, HelpDeskEddy, Битрикс24, amoCRM, Zendesk, Freshdesk.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vsla_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>

</main>


<script>
(function(){
  document.querySelectorAll('.vsla-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vsla-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vsla-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vsla-faq-q');if(q)q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
    });
    btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
  });
})();
</script>

<script>
(function(){
  var tickets=document.querySelector('[data-vsla-calc="tickets"]');
  var breach=document.querySelector('[data-vsla-calc="breach"]');
  var fine=document.querySelector('[data-vsla-calc="fine"]');
  var out=document.getElementById('vsla-calc-output');
  var save=document.getElementById('vsla-calc-save');
  function fmt(n){return Math.round(n).toLocaleString('ru-RU')+' ₽';}
  function recalc(){
    if(!tickets||!breach||!fine||!out||!save)return;
    var t=parseFloat(tickets.value)||0,b=parseFloat(breach.value)||0,f=parseFloat(fine.value)||0;
    var loss=t*(b/100)*f;
    out.textContent=fmt(loss)+'/мес';
    save.textContent=fmt(loss*0.5)+'/мес';
  }
  [tickets,breach,fine].forEach(function(el){if(el)el.addEventListener('input',recalc);});
  recalc();
})();
</script>

<script>
(function(){
  'use strict';
  var root=document.querySelector('.vsla-content');
  if(!root)return;
  var items=root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver' in window){
    var observer=new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){entry.target.classList.add('nero-ai-active');observer.unobserve(entry.target);}
      });
    },{threshold:0.1,rootMargin:'0px 0px -6% 0px'});
    items.forEach(function(item){observer.observe(item);});
  }else{items.forEach(function(item){item.classList.add('nero-ai-active');});}
})();
</script>

<?php
if (getenv('AD_BANNER_URL') && getenv('AD_BANNER_IMAGE_URL')) :
    $ad_url = esc_url(getenv('AD_BANNER_URL'));
    $ad_img = esc_url(getenv('AD_BANNER_IMAGE_URL'));
    $ad_alt = esc_attr(getenv('AD_BANNER_ALT') ?: 'Реклама');
?>
<div class="vsla-cnt" style="padding:32px 0 48px;text-align:center">
  <a href="<?php echo $ad_url; ?>" target="_blank" rel="noopener noreferrer">
    <img src="<?php echo $ad_img; ?>" width="970" height="90" alt="<?php echo $ad_alt; ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
  </a>
</div>
<?php endif; ?>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
