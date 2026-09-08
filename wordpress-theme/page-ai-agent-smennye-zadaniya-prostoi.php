<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев — под ключ
 * Description: SEO-лендинг — внедрение AI-агента для сменных заданий и контроля простоев на производстве.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-агент для сменных заданий и контроля простоев — под ключ';
$page_seo_description = 'Внедрение AI-агента для сменных заданий и контроля простоев на производстве: сбор данных по смене, фиксация отклонений, отчёт руководителю до конца смены. Для цехов и малого производства.';

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

$primary_cta_label   = 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = '#kak-rabotaet';

$nero_ai_header_links = [
    ['label' => 'Зачем AI',     'href' => '#zachem'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение',    'href' => '#etapy'],
    ['label' => 'Отрасли',      'href' => '#keisy'],
    ['label' => 'Цена',         'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

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
/* Kadence reset + page shell */
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

.asz-hero-shift{
  min-height:100vh;
  min-height:100dvh;
  position:relative;
}

/* Intro after hero: left-aligned lead + accent bar */
.asz-intro-grid > div:first-child{
  position:relative;
  padding-left:20px;
  text-align:left!important;
}
.asz-intro-grid > div:first-child::before{
  content:'';
  position:absolute;
  left:0;
  top:4px;
  bottom:4px;
  width:3px;
  border-radius:2px;
  background:linear-gradient(180deg,#f59e0b,#8b5cf6);
}
.asz-intro-grid > div:first-child p{text-align:left!important;}

.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost,.nero-ai-btn-ghost{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18);}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
</style>

<style>
/* === ASZ: тело лонгрида (не hero), prefix asz- === */
.asz-content{
  --asz-bg:#050711;--asz-bg2:#080b17;--asz-bg3:#0a0e1c;
  --asz-surface:rgba(255,255,255,.072);--asz-text:#e6edf7;--asz-muted:#9aa8bd;
  --asz-soft:#c7d2e5;--asz-heading:#fff;--asz-border:rgba(255,255,255,.10);
  --asz-amber:#f59e0b;--asz-green:#22c55e;--asz-cyan:#79f2ff;--asz-violet:#8b5cf6;
  --asz-container:1220px;--asz-r:18px;--asz-r-lg:24px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--asz-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.asz-content *,.asz-content *::before,.asz-content *::after{box-sizing:border-box;}
.asz-content a{color:inherit;}
.asz-content p{color:var(--asz-muted);line-height:1.72;margin:0 0 1em;font-size:15px;}
.asz-content p:last-child{margin-bottom:0;}
.asz-content h2,.asz-content h3,.asz-content h4{color:var(--asz-heading);letter-spacing:-.04em;margin:0 0 .7em;}
.asz-content strong{color:var(--asz-soft);}
.asz-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.asz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--asz-muted);font-size:14.5px;line-height:1.65;}
.asz-content ul li::before{content:'›';position:absolute;left:0;color:var(--asz-amber);font-weight:700;}
.asz-cnt{width:min(var(--asz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.asz-section{padding:clamp(56px,7vw,96px) 0;position:relative;}
.asz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.asz-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.asz-sh.asz-left{margin-left:0;text-align:left;}
.asz-sh h2{font-size:clamp(26px,3.8vw,46px);line-height:1.08;margin-bottom:12px;}
.asz-sh p{font-size:clamp(15px,1.5vw,17px);max-width:680px;margin:0 auto;}
.asz-sh.asz-left p{margin-left:0;}
.asz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.22);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--asz-amber);margin-bottom:14px;}
.asz-intro{padding:clamp(36px,4.5vw,64px) 0;border-bottom:1px solid rgba(255,255,255,.06);}
.asz-intro-grid{display:grid;grid-template-columns:1fr 300px;gap:48px;align-items:start;}
.asz-pullquote{position:relative;padding:24px 28px 24px 24px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:var(--asz-r-lg);border-left:4px solid var(--asz-cyan);}
.asz-pullquote p{font-size:clamp(15px,1.5vw,17px);color:var(--asz-soft);margin:0;line-height:1.75;}
.asz-pullquote cite{display:block;margin-top:12px;font-size:13px;color:var(--asz-muted);font-style:normal;}
.asz-kpi-stack{display:flex;flex-direction:column;gap:10px;}
.asz-kpi{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:14px 16px;text-align:center;}
.asz-kpi .kv{font-size:22px;font-weight:900;color:var(--asz-heading);letter-spacing:-.04em;}
.asz-kpi .kl{font-size:11px;color:var(--asz-muted);margin-top:4px;}
@media(max-width:900px){.asz-intro-grid{grid-template-columns:1fr;}}
.asz-toc-outer{padding:0 0 clamp(32px,4vw,48px);}
.asz-toc{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;}
.asz-toc a{display:inline-block;padding:8px 16px;background:var(--asz-surface);border:1px solid var(--asz-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--asz-muted);text-decoration:none;transition:border-color .2s,color .2s;}
.asz-toc a:hover{border-color:rgba(245,158,11,.4);color:var(--asz-amber);}
.asz-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.04));border:1px solid var(--asz-border);border-radius:var(--asz-r-lg);padding:24px;backdrop-filter:blur(14px);}
.asz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.asz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
@media(max-width:768px){.asz-grid-2,.asz-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.asz-grid-3{grid-template-columns:1fr 1fr;}}
.asz-callout{border-radius:var(--asz-r);padding:20px 24px;margin:24px 0;}
.asz-callout--warning{background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.35);}
.asz-callout--warning p{color:var(--asz-soft);margin:0;}
.asz-callout--warning strong{color:var(--asz-amber);}
.asz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.asz-table{width:100%;border-collapse:collapse;font-size:14px;}
.asz-table th{padding:12px 16px;text-align:left;background:rgba(245,158,11,.1);color:var(--asz-amber);font-weight:700;border-bottom:1px solid rgba(245,158,11,.25);white-space:nowrap;}
.asz-table td{padding:11px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--asz-text);vertical-align:top;}
.asz-table tr:last-child td{border-bottom:none;}
.asz-table tr:hover td{background:rgba(255,255,255,.03);}
.asz-steps{counter-reset:aszstep;display:flex;flex-direction:column;gap:14px;margin:24px 0;}
.asz-step{display:grid;grid-template-columns:44px 1fr;gap:16px;align-items:start;padding:18px 20px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:14px;}
.asz-step-num{width:44px;height:44px;border-radius:50%;background:rgba(34,197,94,.12);border:2px solid rgba(34,197,94,.35);display:flex;align-items:center;justify-content:center;font-weight:800;color:var(--asz-green);font-size:16px;}
.asz-step h4{font-size:15px;margin:0 0 6px;}
.asz-step p{font-size:14px;margin:0;}
.asz-timeline{position:relative;padding-left:36px;}
.asz-timeline::before{content:'';position:absolute;left:10px;top:6px;bottom:6px;width:2px;background:linear-gradient(180deg,var(--asz-amber),var(--asz-violet));opacity:.35;}
.asz-tl-item{position:relative;margin-bottom:28px;}
.asz-tl-item:last-child{margin-bottom:0;}
.asz-tl-dot{position:absolute;left:-30px;top:4px;width:14px;height:14px;border-radius:50%;background:var(--asz-amber);box-shadow:0 0 0 4px rgba(245,158,11,.2);}
.asz-tl-item h3{font-size:16px;margin-bottom:6px;}
.asz-tl-item p{font-size:14px;margin:0;}
.asz-scenario-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
@media(max-width:768px){.asz-scenario-grid{grid-template-columns:1fr;}}
.asz-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--asz-r);padding:24px;}
.asz-scenario-tag{font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--asz-green);margin-bottom:8px;}
.asz-scenario h3{font-size:17px;margin-bottom:10px;}
.asz-ref-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:24px;}
@media(max-width:900px){.asz-ref-cards{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.asz-ref-cards{grid-template-columns:1fr;}}
.asz-ref-card{padding:16px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:14px;font-size:13px;}
.asz-ref-card strong{display:block;color:var(--asz-heading);margin-bottom:4px;font-size:14px;}
.asz-checklist{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin:20px 0;}
@media(max-width:600px){.asz-checklist{grid-template-columns:1fr;}}
.asz-checklist li::before{content:'✓';color:var(--asz-green);}
.asz-compare{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin:24px 0;}
@media(max-width:768px){.asz-compare{grid-template-columns:1fr;}}
.asz-compare-col{padding:22px;border-radius:var(--asz-r);border:1px solid rgba(255,255,255,.1);}
.asz-compare-col h4{font-size:15px;margin-bottom:10px;color:var(--asz-cyan);}
.asz-compare-col--alt h4{color:var(--asz-amber);}
.asz-quote{padding:20px 24px;border-left:3px solid var(--asz-violet);background:rgba(139,92,246,.06);border-radius:0 14px 14px 0;margin:20px 0;}
.asz-quote p{font-style:italic;color:var(--asz-soft);margin:0 0 8px;}
.asz-quote cite{font-size:12px;color:var(--asz-muted);font-style:normal;}
.asz-lead-magnet{display:inline-flex;align-items:center;gap:6px;padding:4px 12px;border-radius:999px;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);font-size:12px;font-weight:700;color:var(--asz-green);margin-bottom:12px;}
.asz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.asz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.asz-faq-q{padding:18px 22px;font-size:15px;font-weight:700;color:var(--asz-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:14px;user-select:none;}
.asz-faq-q::after{content:'▾';font-size:12px;color:var(--asz-amber);flex-shrink:0;transition:transform .25s;}
.asz-faq-item.open .asz-faq-q::after{transform:rotate(180deg);}
.asz-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .35s ease,padding .2s;font-size:14px;color:var(--asz-muted);line-height:1.7;}
.asz-faq-item.open .asz-faq-a{max-height:500px;padding:0 22px 18px;}
.ym-cta-block{border-radius:20px;padding:32px 36px;margin:32px 0;background:linear-gradient(135deg,rgba(245,158,11,.12),rgba(139,92,246,.1));border:1px solid rgba(245,158,11,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,158,11,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:32px;margin-bottom:12px;}
.ym-cta-block__headline{font-size:clamp(19px,2.6vw,26px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--asz-muted);font-size:15px;margin:0 auto 20px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--asz-amber)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(20px);transition:opacity .5s ease,transform .5s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:600px){.ym-cta-block{padding:24px 18px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-agent-smennye-zadaniya-prostoi-page" role="main" tabindex="-1">

<section class="nero-ai-hero asz-hero-shift" id="asz-hero-shift" aria-labelledby="asz-hero-title">
<style>
/* ── Hero ai-agent-smennye-zadaniya-prostoi: самодостаточные стили ── */
.asz-hero-shift {
  --asz-amber: #f59e0b;
  --asz-green: #22c55e;
  --asz-cyan: #79f2ff;
  --asz-violet: #8b5cf6;
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
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 158, 11, .10), transparent 66%);
  filter: blur(8px);
  animation: aszHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aszHeroGlow {
  from { opacity: .35; transform: scale(.95); }
  to { opacity: .78; transform: scale(1.05); }
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
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.asz-hero-shift .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--asz-cyan) 38%, var(--asz-violet) 100%);
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
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--asz-cyan) !important;
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
  color: #041018 !important;
  background: linear-gradient(135deg, var(--asz-cyan), #38bdf8);
  box-shadow: 0 18px 42px rgba(56, 189, 248, 0.28);
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
  grid-template-columns: repeat(3, minmax(0, 1fr));
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
.asz-hero-shift .nero-ai-metric--green strong { color: var(--asz-green); }
.asz-hero-shift .nero-ai-metric--amber strong { color: var(--asz-amber); }
.asz-hero-shift .asz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(245, 158, 11, 0.18);
  background: radial-gradient(ellipse at 50% 40%, rgba(245,158,11,.06), rgba(6,10,24,.92) 72%);
}
.asz-hero-shift #asz-shift-hero-canvas {
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
  background: rgba(121,242,255,.12);
  color: var(--asz-cyan);
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
.asz-hero-shift .nero-ai-status--cyan {
  background: rgba(56,189,248,.12);
  color: #bae6fd;
}
@media (max-width: 1100px) {
  .asz-hero-shift .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .asz-hero-shift .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .asz-hero-shift .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .asz-hero-shift .nero-ai-window-body { padding: 12px; }
  .asz-hero-shift .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
  .asz-hero-shift .nero-ai-task { grid-template-columns: 28px 1fr; }
  .asz-hero-shift .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Производство / смены</p>
      <h1 id="asz-hero-title">AI-агент для сменных заданий и контроля простоев: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI собирает данные по смене, фиксирует отклонения и формирует отчёт руководителю — чтобы простои не терялись до конца недели</p>
      <ul class="nero-ai-badges" aria-label="Ключевые преимущества">
        <li class="nero-ai-badge">План и факт в одном контуре</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">Telegram для мастера</li>
        <li class="nero-ai-badge">От 500 тыс. ₽</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация диспетчера смены">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики · демо-данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Диспетчер смены</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--green">
              <span>План/факт</span>
              <strong>87%</strong>
            </div>
            <div class="nero-ai-metric nero-ai-metric--amber">
              <span>Простоя за смену</span>
              <strong>3</strong>
            </div>
            <div class="nero-ai-metric">
              <span>Отчёт руководителю</span>
              <strong>18:00</strong>
            </div>
          </div>

          <div class="asz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="asz-shift-hero-canvas" role="img" aria-label="Анимация: цифровой диспетчер смены — задания по линии, фиксация простоя, пересборка очереди и отчёт руководителю"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">08</span>
              <div><strong>08:05 План смены загружен из 1С</strong><span>12 заданий · 3 рабочих центра</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">10</span>
              <div><strong>10:42 Простой: наладка раскроя (12 мин)</strong><span>Причина зафиксирована оператором</span></div>
              <span class="nero-ai-status nero-ai-status--amber">простой</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">14</span>
              <div><strong>14:15 Пересборка очереди — ожидает мастера</strong><span>Human-in-the-loop · 4 задания</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">17</span>
              <div><strong>17:55 Сводка смены готова</strong><span>Топ-3 простоя · план/факт 87%</span></div>
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
 * asz-shift-hero-engine — «Диспетчерская цифровой смены»
 * Мир: TaskFlowRail → ShiftDispatchBoard → DowntimeBeacon → отчёт в Telegram
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("asz-shift-hero-canvas");
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
    floor: "#1e293b",
    station: "#334155",
    stationActive: "#475569",
    taskCard: "#dbeafe",
    taskAmber: "#fef3c7",
    taskGreen: "#d1fae5",
    boardBase: "#0f172a",
    boardAccent: "#79f2ff",
    amber: "#f59e0b",
    green: "#22c55e",
    cyan: "#38bdf8",
    violet: "#8b5cf6",
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

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, max: life });
  }

  /* Горизонтальный рельс заданий между станками — вместо Conveyor */
  function TaskFlowRail() {
    this.tickets = [
      { offset: 0, color: C.taskGreen, label: "Р-1" },
      { offset: 70, color: C.taskCard, label: "У-2" },
      { offset: 140, color: C.taskAmber, label: "Н-3" }
    ];
  }
  TaskFlowRail.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    var railY = 42;
    var railX1 = -155;
    var railX2 = 55;

    drawRR(ctx, railX1, railY - 6, railX2 - railX1, 12, 4, C.floor, C.outline);
    var dashOff = (frame * 0.6) % 20;
    ctx.strokeStyle = "rgba(121,242,255,0.35)";
    ctx.lineWidth = 1;
    ctx.setLineDash([4, 6]);
    ctx.beginPath();
    ctx.moveTo(railX1 + 8, railY);
    ctx.lineTo(railX2 - 8 - dashOff, railY);
    ctx.stroke();
    ctx.setLineDash([]);

    /* Станции вдоль линии */
    var stations = [-120, -55, 10];
    stations.forEach(function (sx, i) {
      var active = prg > 40 + i * 35 && prg < 200;
      drawRR(ctx, sx - 14, railY - 28, 28, 22, 4, active ? C.stationActive : C.station, C.outline);
      ctx.fillStyle = active ? C.cyan : "#64748b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("РЦ" + (i + 1), sx, railY - 14);
    });

    this.tickets.forEach(function (t) {
      var tt = ((frame * 0.5 + t.offset) % 140) / 140;
      if (prg > 180) tt = Math.min(tt, 0.35);
      var tx = railX1 + (railX2 - railX1) * tt;
      drawRR(ctx, tx - 10, railY - 22, 20, 14, 3, t.color, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(t.label, tx, railY - 12);
    });
  };

  /* Центральная панель диспетчера — вместо WebsiteTerminal */
  function ShiftDispatchBoard() {
    this.queue = 0;
  }
  ShiftDispatchBoard.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    drawRR(ctx, -42, -72, 118, 108, 10, C.boardBase, C.outline);

    drawRR(ctx, -36, -66, 106, 16, [6, 6, 0, 0], "rgba(121,242,255,0.18)", null);
    ctx.fillStyle = C.boardAccent;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Диспетчер смены", -30, -56);

    var rows = ["Задание 1", "Задание 2", "Задание 3"];
    var activeRow = prg < 90 ? 0 : prg < 160 ? 1 : 2;
    rows.forEach(function (r, i) {
      var ry = -42 + i * 18;
      var hl = i === activeRow;
      drawRR(ctx, -34, ry, 98, 14, 3, hl ? "rgba(34,197,94,0.15)" : "rgba(255,255,255,0.05)", C.outline);
      ctx.fillStyle = hl ? "#bbf7d0" : "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(r, -28, ry + 10);
      if (hl && prg > 50) {
        ctx.fillStyle = C.green;
        ctx.fillText("✓", 52, ry + 10);
      }
    });

    /* Фаза пересборки очереди */
    if (prg >= 155 && prg < 210) {
      var shuffle = (prg - 155) / 55;
      ctx.fillStyle = "rgba(245,158,11," + (0.2 + shuffle * 0.3) + ")";
      drawRR(ctx, -34, 8, 98, 18, 4, "rgba(245,158,11,0.12)", C.amber);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Пересборка очереди…", 15, 20);
    }

    /* Фаза отчёта */
    if (prg >= 220) {
      var stamp = Math.min(1, (prg - 220) / 16);
      ctx.save();
      ctx.globalAlpha = stamp;
      ctx.strokeStyle = C.green;
      ctx.lineWidth = 2;
      ctx.strokeRect(-8, 32, 56, 20);
      ctx.fillStyle = C.green;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ОТЧЁТ 18:00", 20, 46);
      ctx.restore();
    }
  };

  /* Маяк простоя */
  function DowntimeBeacon() {
    this.flash = 0;
  }
  DowntimeBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    if (prg < 75 || prg > 145) return;
    this.flash = Math.sin(frame * 0.25) * 0.5 + 0.5;
    var bx = -95;
    var by = -18;
    ctx.save();
    ctx.globalAlpha = 0.35 + this.flash * 0.45;
    ctx.fillStyle = C.amber;
    ctx.beginPath();
    ctx.arc(bx, by, 8 + this.flash * 4, 0, Math.PI * 2);
    ctx.fill();
    ctx.globalAlpha = 1;
    drawRR(ctx, bx - 18, by + 10, 36, 14, 3, "rgba(245,158,11,0.2)", C.amber);
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ПРОСТОЙ", bx, by + 20);
    ctx.restore();
    if (prg === 90) createBubble(bx, by - 20, "Наладка раскроя 12 мин", 200);
  };

  /* Дуга план/факт */
  function PlanFactGauge() {
    this.pct = 0.87;
  }
  PlanFactGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    drawRR(ctx, 88, -58, 52, 52, 8, "rgba(255,255,255,0.04)", C.outline);
    ctx.strokeStyle = "rgba(255,255,255,0.12)";
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(114, -32, 18, Math.PI * 0.75, Math.PI * 2.25);
    ctx.stroke();
    var sweep = prg > 30 ? this.pct : (prg / 30) * this.pct;
    ctx.strokeStyle = C.green;
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(114, -32, 18, Math.PI * 0.75, Math.PI * 0.75 + Math.PI * 1.5 * sweep);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(sweep * 100) + "%", 114, -28);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("план/факт", 114, -18);
  };

  /* Пульс Telegram-уведомления */
  function TelegramPulseOrb() {
    this.r = 0;
  }
  TelegramPulseOrb.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    if (prg < 228) return;
    this.r = Math.min(1, (prg - 228) / 20);
    var ox = 130;
    var oy = 38;
    ctx.save();
    ctx.globalAlpha = 0.25 * (1 - this.r * 0.5);
    ctx.strokeStyle = C.cyan;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(ox, oy, 10 + this.r * 18, 0, Math.PI * 2);
    ctx.stroke();
    ctx.globalAlpha = 1;
    drawRR(ctx, ox - 12, oy - 10, 24, 20, 6, "rgba(56,189,248,0.25)", C.cyan);
    ctx.fillStyle = "#bae6fd";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TG", ox, oy + 4);
    ctx.restore();
    if (prg === 232) createBubble(ox, oy - 18, "Отчёт руководителю", 210);
  };

  /* Справочник причин простоя */
  function ReasonCodePicker() {
    this.idx = 0;
  }
  ReasonCodePicker.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    if (prg < 95 || prg > 150) return;
    var codes = ["Наладка", "Материал", "Поломка"];
    this.idx = Math.floor((prg - 95) / 18) % codes.length;
    drawRR(ctx, 72, 8, 58, 36, 5, "rgba(15,23,42,0.85)", C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Причина:", 78, 20);
    codes.forEach(function (c, i) {
      var on = i === this.idx;
      ctx.fillStyle = on ? C.amber : "#64748b";
      ctx.fillText((on ? "● " : "○ ") + c, 78, 30 + i * 8);
    }, this);
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
    var prg = (frame * 0.04) % 260;
    var isMoving = false;
    var faceDir = 1;

    var targets = {
      "1_architect": { x: 5, y: -8 },
      "2_seo": { x: -88, y: 8 },
      "3_coder": { x: -30, y: 52 },
      "4_designer": { x: 15, y: 18 },
      "5_deployer": { x: 118, y: 34 }
    };
    var tgt = targets[this.role] || { x: 0, y: 20 };

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

    if (!isMoving && frame % 195 === Math.floor(this.timer * 10) % 195 && Math.random() < 0.12) {
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
    ctx.fillStyle = "#fff";
    ctx.beginPath();
    ctx.arc(faceDir * 3, -23 - bob, 2, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();
  };

  var taskRail = new TaskFlowRail();
  var dispatchBoard = new ShiftDispatchBoard();
  var downtimeBeacon = new DowntimeBeacon();
  var planFactGauge = new PlanFactGauge();
  var telegramOrb = new TelegramPulseOrb();
  var reasonPicker = new ReasonCodePicker();

  var agents = [
    new Agent(-145, -55, C.agentYellow, "1_architect", 35, ["План из 1С загружен", "Сверяю план/факт", "Очередь на 3 РЦ"]),
    new Agent(-150, 18, C.agentGreen, "2_seo", 88, ["Простой: наладка", "Код причины выбран", "12 мин — в отчёт"]),
    new Agent(-20, 68, C.agentBlue, "3_coder", 158, ["Пересобираю очередь", "4 задания сдвинуты", "Жду мастера"]),
    new Agent(55, -48, C.agentPink, "4_designer", 168, ["Мастер подтвердил", "Human-in-the-loop", "Новый план утверждён"]),
    new Agent(145, 12, C.agentPurple, "5_deployer", 225, ["Сводка в Telegram", "Топ-3 простоя", "Отчёт до 18:00"])
  ];

  function drawBubbles(ctx) {
    bubbles = bubbles.filter(function (b) {
      b.life--;
      if (b.life <= 0) return false;
      var alpha = Math.min(1, b.life / 40);
      ctx.save();
      ctx.globalAlpha = alpha;
      ctx.font = "bold 7px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 18, tw, 16, 4, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 7);
      ctx.restore();
      return true;
    });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    taskRail.draw(ctx);
    planFactGauge.draw(ctx);
    dispatchBoard.draw(ctx);
    downtimeBeacon.draw(ctx);
    reasonPicker.draw(ctx);
    telegramOrb.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });
    drawBubbles(ctx);

    ctx.restore();
    requestAnimationFrame(engineLoop);
  }

  if (frame === 0) {
    createBubble(-10, -50, "Смена стартовала", 180);
    createBubble(15, 0, "План/факт 87%", 180);
    createBubble(100, 20, "Мастер в Telegram", 180);
    createBubble(-90, 0, "Простой зафиксирован", 180);
  }

  engineLoop();
});
</script>


<div class="asz-content" id="asz-longread-body">

  <!-- INTRO + pull-quote -->
  <section class="asz-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="asz-cnt">
      <div class="asz-intro-grid nero-ai-reveal">
        <div>
          <p class="asz-eyebrow">Лонгрид · ai производство контроль</p>
          <p><strong>Коротко:</strong> AI-агент для сменных заданий и контроля простоев — программный слой поверх учётных систем (1С, Excel, MES, Telegram), который получает план смены и фактические события, пересобирает задания при сбоях, фиксирует причины простоев в момент события и формирует сводку для руководителя до конца смены.</p>
          <p>На малом производстве — в цехе на 5–30 человек, на мебельной линии или пищевой фасовке — боль одна: <strong>задачи меняются вручную, простои фиксируются поздно</strong>. План смены живёт в Excel или WhatsApp, а реальные потери вспоминают в пятницу.</p>
          <blockquote class="asz-pullquote">
            <p><strong>Цифровой диспетчер смены</strong> — не «автономный цех», а agentic AI с обязательным подтверждением мастера: агент рекомендует, человек утверждает план, ремонт и закупку.</p>
            <cite>Nero Network · human-in-the-loop</cite>
          </blockquote>
        </div>
        <div class="asz-kpi-stack" aria-label="Ключевые метрики">
          <div class="asz-kpi"><div class="kv">6%</div><div class="kl">производителей уже используют agentic AI</div></div>
          <div class="asz-kpi"><div class="kv">24%</div><div class="kl">планируют к 2027 (Deloitte)</div></div>
          <div class="asz-kpi"><div class="kv">500K+</div><div class="kl">пилот от (INTEBRIX, рынок)</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <div class="asz-toc-outer">
    <div class="asz-cnt">
      <nav class="asz-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Внедрение</a>
        <a href="#keisy">Отрасли</a>
        <a href="#ceny">Цена</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- H2 #1: #zachem -->
  <section class="asz-section" id="zachem">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Зачем бизнесу</span>
        <h2>Зачем производству AI-агент для сменных заданий и контроля простоев</h2>
        <p>AI для производства закрывает разрыв между планом, фактом и отчётом — без обещания «автономного цеха».</p>
      </div>

      <div class="asz-grid-3 nero-ai-reveal">
        <div class="asz-card">
          <h3>Где теряются данные</h3>
          <p>Excel, WhatsApp, устная передача, 1С с задержкой — при сбое версии расходятся, контекст теряется при пересменке.</p>
        </div>
        <div class="asz-card">
          <h3>Поздняя фиксация простоев</h3>
          <p>OEE на российских предприятиях часто 30–70%; простои в 25–30% планового фонда — «норма». Без записи в момент события причина растворяется.</p>
        </div>
        <div class="asz-card">
          <h3>Цифровой диспетчер</h3>
          <p>Agentic AI с human-in-the-loop: пересборка плана, классификация простоя, отчёт смены — мастер подтверждает каждое критичное действие.</p>
        </div>
      </div>

      <div class="asz-callout asz-callout--warning nero-ai-reveal" role="note">
        <p><strong>Gartner (25.06.2025):</strong> более 40% agentic AI-проектов будут отменены к концу 2027 года из-за роста затрат, неясного ROI и слабого risk control. Anushree Verma (Gartner): <em>«Most agentic AI projects right now are early stage experiments… driven by hype and often misapplied»</em>.</p>
      </div>

      <h3 id="gde-teryayutsya-dannye">Где теряются данные: ручные задания и поздняя фиксация простоев</h3>
      <p><strong>Определение:</strong> сменное задание — перечень операций, рабочих центров и приоритетов на смену. Учёт простоев — фиксация остановки с причиной и длительностью.</p>

      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table">
          <thead><tr><th>Отрасль</th><th>Частые причины простоя</th><th>Как фиксируют без AI</th></tr></thead>
          <tbody>
            <tr><td>Мебель</td><td>переналадка раскроя, нехватка плёнки, поломка ЧПУ, брак ОТК</td><td>запись в конце смены, устно мастеру</td></tr>
            <tr><td>Пищевое</td><td>мойка линии, смена фасовки, ожидание сырья, санобработка</td><td>журнал на линии, иногда Excel</td></tr>
            <tr><td>Общее</td><td>поломка, наладка, нехватка материала, пересменка, ОТК</td><td>чаты, звонки, «рации»</td></tr>
          </tbody>
        </table>
      </div>

      <!-- INTERNAL-LINKS:INSERT -->

      <h3 id="agentic-ai-hitl">Agentic AI с проверкой результата, а не «автономный цех»</h3>
      <p>Позиция Nero Network — <strong>цифровой диспетчер смены</strong>: агент рекомендует, не запускает станок; человек утверждает план, ремонт, закупку. Референс — ФосАгро «AIХимик»: RAG по регламентам, рекомендации операторам, решение принимает человек.</p>

      <div class="asz-quote nero-ai-reveal">
        <p>«Shift handoff should be a required workflow step, not a dashboard someone can ignore»</p>
        <cite>MES Engineer — best practice передачи смены</cite>
      </div>
    </div>
  </section>

  <!-- H2 #2: #kak-rabotaet -->
  <section class="asz-section asz-section-alt" id="kak-rabotaet">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Как работает</span>
        <h2>Как AI собирает данные по смене и контролирует простои</h2>
        <p>Оркестратор поверх 1С, Excel и Telegram — план, факт и отклонения в одном контуре.</p>
      </div>

      <h3 id="plan-fakt">Сменные задания: план, факт и отклонения в одном контуре</h3>
      <p>Утром агент загружает план из 1С/таблицы и рассылает задания в Telegram. При отклонении фиксирует расхождение и показывает мастеру план/факт. Референсы: MBS Group (планирование 1С:ERP), INTEBRIX (APS Plan-Fact), ICAMES Bot (Telegram для цеха), Symestic (70% полей из MES автоматически).</p>

      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table">
          <thead><tr><th>Что делает AI-агент</th><th>Что остаётся за мастером</th></tr></thead>
          <tbody>
            <tr><td>Загружает план смены из 1С/таблицы</td><td>Утверждает пересобранный план</td></tr>
            <tr><td>Рассылает задания операторам</td><td>Финальная классификация спорных простоев</td></tr>
            <tr><td>Пересобирает очередь при сбое (рекомендация)</td><td>Ремонт, закупка материалов</td></tr>
            <tr><td>Сравнивает план и факт</td><td>Дисциплинарные решения</td></tr>
            <tr><td>Формирует отчёт смены</td><td>Действия по безопасности и качеству</td></tr>
          </tbody>
        </table>
      </div>

      <h3 id="fiksaciya-prostoiev">Фиксация простоев и уведомления до конца смены</h3>
      <div class="asz-steps nero-ai-reveal" aria-label="5 шагов фиксации простоя">
        <div class="asz-step"><div class="asz-step-num">1</div><div><h4>Событие «простой»</h4><p>Кнопка оператора, таймер без выработки или сигнал датчика.</p></div></div>
        <div class="asz-step"><div class="asz-step-num">2</div><div><h4>Фиксация timestamp</h4><p>Агент запрашивает причину из справочника: материал, поломка, наладка, брак, ОТК.</p></div></div>
        <div class="asz-step"><div class="asz-step-num">3</div><div><h4>Критический простой</h4><p>При превышении N минут — пересчёт очереди и предложение нового плана мастеру.</p></div></div>
        <div class="asz-step"><div class="asz-step-num">4</div><div><h4>Эскалация</h4><p>Уведомление руководителю при пороговых потерях; опционально — задача в Bitrix24.</p></div></div>
        <div class="asz-step"><div class="asz-step-num">5</div><div><h4>Сводка смены</h4><p>План/факт, топ-3 простоя, потери в часах и рублях — до конца смены.</p></div></div>
      </div>

      <div class="asz-compare nero-ai-reveal">
        <div class="asz-compare-col">
          <h4>Мониторинг станков</h4>
          <p>Датчик видит остановку, телеметрия ЧПУ, OEE-дашборд. ENGINE: простои −20–40%. Kitmon: AI на паттернах простоев.</p>
        </div>
        <div class="asz-compare-col asz-compare-col--alt">
          <h4>AI-агент смены</h4>
          <p>Связывает простой с заданием, причиной и отчётом руководителю. Bosch Shopfloor Agent: агент для оператора, не для IT — оператор подтверждает действия.</p>
        </div>
      </div>
      <p><strong>Сравнение:</strong> мониторинг и агент смены <strong>не конкурируют</strong> — дополняют друг друга.</p>
    </div>
  </section>

  <!-- БОРИС: визуальный блок (после #kak-rabotaet) -->
  <section id="ai-agent-smennye-zadaniya-prostoi-boris-block" class="b-asz-root" aria-label="Анимация: вид с цеха — линия, простои и очередь сменных заданий">
<style>
#ai-agent-smennye-zadaniya-prostoi-boris-block.b-asz-root{padding:48px 0 56px;background:#f1f5f9;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-card{display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.2);min-height:480px;}
@media(max-width:1023px){#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-card{grid-template-columns:1fr;min-height:auto;}}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-lft{padding:36px 32px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:28px 22px;}}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-ey{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#d97706;margin:0 0 12px;display:flex;align-items:center;gap:8px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-ey::before{content:'';width:16px;height:2px;background:#d97706;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-h3{font-size:clamp(19px,2.2vw,24px);font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 16px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-ul{list-style:none;margin:0 0 18px;padding:0;display:flex;flex-direction:column;gap:8px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-ul li{display:flex;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-ic{flex-shrink:0;width:20px;height:20px;border-radius:50%;background:rgba(217,119,6,.12);display:flex;align-items:center;justify-content:center;font-size:10px;color:#b45309;font-style:normal;font-weight:700;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-pl{padding:4px 11px;border-radius:99px;font-size:11px;font-weight:700;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-pl-a{background:rgba(245,158,11,.1);color:#b45309;border:1px solid rgba(245,158,11,.25);}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-pl-g{background:rgba(34,197,94,.1);color:#15803d;border:1px solid rgba(34,197,94,.25);}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-pl-b{background:rgba(14,165,233,.1);color:#0369a1;border:1px solid rgba(14,165,233,.25);}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .b-asz-rgt{position:relative;background:linear-gradient(145deg,#ecfdf5 0%,#f0fdf4 30%,#fef3c7 70%,#f8fafc 100%);min-height:420px;overflow:hidden;}
#asz-shift-floor-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="b-asz-cnt">
  <div class="b-asz-card">
    <div class="b-asz-lft">
      <span class="b-asz-ey">Вид с цеха</span>
      <h3 class="b-asz-h3">Линия в реальном времени: простой зафиксирован — очередь пересобрана</h3>
      <ul class="b-asz-ul">
        <li><span class="b-asz-ic">1</span>Станок A — в работе; станок B — простой «наладка» (12 мин)</li>
        <li><span class="b-asz-ic">2</span>Оператор нажал «простой» → агент запросил причину из справочника</li>
        <li><span class="b-asz-ic">3</span>Очередь заданий пересчитана — ждёт подтверждения мастера</li>
        <li><span class="b-asz-ic">✓</span>Human-in-the-loop: без автозапуска, только рекомендация</li>
      </ul>
      <div class="b-asz-pills">
        <span class="b-asz-pl b-asz-pl-a">3 простоя / смена</span>
        <span class="b-asz-pl b-asz-pl-g">87% план/факт</span>
        <span class="b-asz-pl b-asz-pl-b">Telegram + 1С</span>
      </div>
      <p class="b-asz-foot">Дальше — этапы внедрения AI на производство под ключ →</p>
    </div>
    <div class="b-asz-rgt">
      <canvas id="asz-shift-floor-canvas" aria-label="Анимация: производственная линия со станками, индикаторами простоя и очередью сменных заданий" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
'use strict';
var cv=document.getElementById('asz-shift-floor-canvas');
if(!cv)return;
var ctx=cv.getContext('2d'),W=0,H=0,frame=0;
function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||420;W=cv.width;H=cv.height;}
window.addEventListener('resize',resize);resize();
var C={ink:'#0f172a',muted:'#64748b',floor:'#e2e8f0',machine:'#334155',machineOn:'#22c55e',machineOff:'#f59e0b',machineErr:'#ef4444',belt:'#475569',task:'#0ea5e9',taskBg:'#e0f2fe',human:'#8b5cf6',line:'rgba(14,165,233,.25)'};
var MACHINES=[
  {x:.12,label:'Раскрой',state:'on',downtime:0},
  {x:.32,label:'Сборка',state:'idle',downtime:12},
  {x:.52,label:'ОТК',state:'on',downtime:0},
  {x:.72,label:'Упаковка',state:'warn',downtime:4}
];
var TASKS=['Заказ #1842','Заказ #1845','Заказ #1847'];
var LOOP=600;
function rr(x,y,w,h,r,fill,stroke,lw){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(fill){ctx.fillStyle=fill;ctx.fill();}if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}}
function drawMachine(mx,my,sw,sh,m,pulse){
  var stClr=m.state==='on'?C.machineOn:m.state==='warn'?C.machineOff:C.machineErr;
  rr(mx,my,sw,sh,8,'#f8fafc','#cbd5e1',1.5);
  rr(mx+6,my+6,sw-12,sh*.55,5,C.machine,null,0);
  ctx.fillStyle='#fff';ctx.font='bold 9px Inter,sans-serif';ctx.textAlign='center';
  ctx.fillText(m.label,mx+sw/2,my+sh*.32);
  var lampY=my+sh*.72;
  ctx.beginPath();ctx.arc(mx+sw/2,lampY,7,0,Math.PI*2);
  ctx.fillStyle=stClr;ctx.fill();
  if(m.state!=='on'){ctx.fillStyle=C.machineOff;ctx.font='bold 8px Inter,sans-serif';ctx.fillText(m.downtime+' мин',mx+sw/2,my+sh+14);}
  if(m.state==='idle'&&pulse%40<20){ctx.strokeStyle=C.machineOff;ctx.lineWidth=2;ctx.setLineDash([4,4]);ctx.strokeRect(mx-3,my-3,sw+6,sh+6);ctx.setLineDash([]);}
}
function drawTaskQueue(x,y,w,pulse){
  rr(x,y,w,90,10,'#fff','#cbd5e1',1);
  ctx.fillStyle=C.ink;ctx.font='bold 10px Inter,sans-serif';ctx.textAlign='left';
  ctx.fillText('Очередь смены',x+10,y+16);
  TASKS.forEach(function(t,i){
    var ty=y+28+i*20;
    var alpha=i===0?1:.55;
    ctx.globalAlpha=alpha;
    rr(x+8,ty,w-16,16,6,C.taskBg,C.task,1);
    ctx.fillStyle=C.ink;ctx.font='8px Inter,sans-serif';ctx.fillText(t,x+14,ty+11);
    if(i===0&&pulse%50<25){ctx.fillStyle=C.machineOff;ctx.font='bold 7px Inter,sans-serif';ctx.fillText('↻ пересборка',x+w-58,ty+11);}
    ctx.globalAlpha=1;
  });
}
function drawMaster(x,y,pulse){
  rr(x,y,48,56,8,'#faf5ff','#c4b5fd',1.5);
  ctx.fillStyle=C.human;ctx.beginPath();ctx.arc(x+24,y+18,10,0,Math.PI*2);ctx.fill();
  ctx.fillRect(x+14,y+30,20,18);
  ctx.fillStyle=C.ink;ctx.font='8px Inter,sans-serif';ctx.textAlign='center';
  ctx.fillText('Мастер',x+24,y+52);
  if(pulse%80<40){rr(x+54,y-8,72,28,8,'#fff','#f59e0b',1.5);ctx.fillStyle=C.ink;ctx.font='7px Inter,sans-serif';ctx.fillText('Подтвердить?',x+90,y+6);ctx.fillText('новый план',x+90,y+16);}
}
function loop(){
  frame++;
  var pulse=frame%LOOP;
  ctx.clearRect(0,0,W,H);
  var floorY=H*.62;
  ctx.fillStyle=C.floor;ctx.fillRect(0,floorY,W,H-floorY);
  ctx.strokeStyle=C.belt;ctx.lineWidth=3;
  ctx.beginPath();ctx.moveTo(0,floorY+20);ctx.lineTo(W,floorY+20);ctx.stroke();
  var beltOff=(frame*1.2)%40;
  ctx.fillStyle=C.belt;
  for(var bx=0;bx<W+40;bx+=40)ctx.fillRect(bx-beltOff,floorY+16,12,8);
  var mw=W*.16,mh=H*.38;
  MACHINES.forEach(function(m,i){
    var mx=W*m.x,my=floorY-mh-10;
    drawMachine(mx,my,mw,mh,m,pulse);
    if(i<MACHINES.length-1){ctx.strokeStyle=C.line;ctx.lineWidth=1.5;ctx.beginPath();ctx.moveTo(mx+mw+4,my+mh/2);ctx.lineTo(W*MACHINES[i+1].x-4,my+mh/2);ctx.stroke();}
  });
  drawTaskQueue(W*.04,H*.08,W*.28,pulse);
  drawMaster(W*.78,floorY-mh-30,pulse);
  ctx.fillStyle=C.muted;ctx.font='9px Inter,sans-serif';ctx.textAlign='right';
  ctx.fillText('18:00 · сводка смены',W-12,H-10);
  requestAnimationFrame(loop);
}
loop();
})();
</script>
  </section>

  <!-- CTA 1: после #kak-rabotaet (Артур) -->
  <div class="asz-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-najti-prostoi">
      <div class="ym-cta-block__icon" aria-hidden="true">🔍</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Найти простои — бесплатный аудит фиксации</p>
        <p class="ym-cta-block__sub">За 1 неделю разберём, как сейчас ведутся сменные задания (Excel, WhatsApp, 1С) и где теряются данные о простоях. На выходе — <strong>Карта потерь производства</strong>: Pareto причин простоев и приоритет пилота. Без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
      </div>
    </div>
  </div>

  <!-- H2 #3: #etapy -->
  <section class="asz-section" id="etapy">
    <div class="asz-cnt">
      <div class="asz-sh asz-left">
        <span class="asz-eyebrow">Под ключ</span>
        <h2>Внедрение AI на производство: этапы под ключ</h2>
        <p>4–10 недель, чек 500 тыс.–2 млн ₽ (после аудита). Не с модели — с карты потерь.</p>
      </div>

      <h3 id="audit-karta">Аудит процессов и карта потерь производства</h3>
      <p><span class="asz-lead-magnet">📊 Карта потерь производства</span> — лид-магнит Nero Network: Pareto причин простоев за 2–4 недели пилота.</p>

      <div class="asz-card nero-ai-reveal">
        <div class="asz-timeline" aria-label="5 этапов внедрения">
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>1. Аудит (1 неделя)</h3><p>Как ведутся сменные задания, где фиксируются простои, какие системы есть (1С, Bitrix, мониторинг).</p></div>
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>2. MVP-контур (2–4 недели)</h3><p>Telegram Mini App / бот + AI-оркестратор (n8n/Make + LLM) + БД событий смены.</p></div>
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>3. Интеграции (2–4 недели)</h3><p>Чтение плана из 1С/Google Sheets; опционально — сигналы простоя с ENGINE/ФОРСЕТИ/Kitmon.</p></div>
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>4. Human-in-the-loop</h3><p>Мастер подтверждает пересборку и классификацию; руководитель получает PDF/Telegram-отчёт.</p></div>
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>5. Пилот → масштабирование</h3><p>Одна линия/смена, карта потерь, решение о расширении.</p></div>
        </div>
      </div>

      <h3 id="integracii">Интеграция с 1С, MES, Telegram и учётными системами</h3>
      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table">
          <thead><tr><th>Категория</th><th>Системы</th></tr></thead>
          <tbody>
            <tr><td>Учёт</td><td>1С:УНФ, 1С:КА, Google Sheets, Excel</td></tr>
            <tr><td>CRM/задачи</td><td>Bitrix24</td></tr>
            <tr><td>Мессенджеры</td><td>Telegram (основной), MAX/VK — опционально</td></tr>
            <tr><td>Мониторинг</td><td>ENGINE, ФОРСЕТИ, WINNUM, Kitmon — API/CSV</td></tr>
            <tr><td>AI</td><td>YandexGPT, GigaChat, OpenAI; n8n или Make</td></tr>
          </tbody>
        </table>
      </div>

      <h3 id="riski-agentic">Риски agentic-проектов и контроль качества внедрения</h3>
      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table">
          <thead><tr><th>Риск</th><th>Как снижает Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Gartner: &gt;40% agentic-проектов отменят к 2027</td><td>узкий scope, пилот на одной смене</td></tr>
            <tr><td>76% AI-проектов не масштабируются (Pertama)</td><td>старт без MES, Telegram + 1С/Excel</td></tr>
            <tr><td>«AI остановит производство»</td><td>recommendation-first, мастер подтверждает</td></tr>
            <tr><td>Неясный ROI</td><td>карта потерь за 2–4 недели пилота</td></tr>
            <tr><td>Перегруз датчиками</td><td>датчики опционально, после MVP</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- CTA 2: после #etapy (Артур) -->
  <div class="asz-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать agentic AI до пилота на смене?</p>
        <p class="ym-cta-block__sub">Перед внедрением AI на производство полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с 1С/Telegram — это ускоряет согласование с мастерами и IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
      </div>
    </aside>
  </div>

  <!-- H2 #4: #keisy -->
  <section class="asz-section asz-section-alt" id="keisy">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Отрасли</span>
        <h2>AI для малого производства: цеха, мебель, пищевая отрасль</h2>
        <p>Адаптация enterprise-практик в проектной модели для SMB — честно, без выдуманных кейсов малого цеха.</p>
      </div>

      <h3 id="prichiny-prostoiev">Типовые причины простоев без AI и как их видит агент</h3>
      <div class="asz-scenario-grid nero-ai-reveal">
        <div class="asz-scenario">
          <div class="asz-scenario-tag">Мебельное производство</div>
          <h3>Сценарий: раскрой → сборка → ОТК</h3>
          <ul>
            <li>Утро: агент загружает заказы из 1С, рассылает задания</li>
            <li>Переналадка: оператор жмёт «простой — наладка», агент фиксирует длительность</li>
            <li>Нехватка плёнки: эскалация мастеру, пересчёт очереди</li>
            <li>Вечер: отчёт — план/факт, топ-3 простоя</li>
          </ul>
        </div>
        <div class="asz-scenario">
          <div class="asz-scenario-tag">Пищевое производство</div>
          <h3>Сценарий: линия фасовки</h3>
          <ul>
            <li>Мойка линии: фиксация по регламенту с таймером</li>
            <li>Смена фасовки: агент пересобирает задания на упаковке</li>
            <li>Ожидание сырья: код «материал», уведомление при пороге</li>
            <li>Паттерн: «каждую пятницу простой на упаковке» → карта потерь</li>
          </ul>
        </div>
      </div>

      <h3 id="keisy-ref">Кейсы и сценарии внедрения</h3>
      <div class="asz-ref-cards nero-ai-reveal">
        <div class="asz-ref-card"><strong>Иж-Рэст + Zool.ai</strong>Прозрачность смен, простои −15–20%</div>
        <div class="asz-ref-card"><strong>MBS Group</strong>Сменное планирование 1С:ERP за минуты</div>
        <div class="asz-ref-card"><strong>ICAMES Bot</strong>Telegram как интерфейс оператора</div>
        <div class="asz-ref-card"><strong>INTEBRIX</strong>Сменные задания, пилот от 500 000 ₽</div>
        <div class="asz-ref-card"><strong>Bosch Shopfloor</strong>~€850K экономии на завод в год</div>
        <div class="asz-ref-card"><strong>Symestic</strong>Передача смены: 20+ мин → 5–8 мин</div>
      </div>
    </div>
  </section>

  <!-- H2 #5: #ceny -->
  <section class="asz-section" id="ceny">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI-контроль производства и как заказать</h2>
        <p>Ориентиры рынка — после аудита точная оценка по рабочим центрам и интеграциям.</p>
      </div>

      <h3 id="byudzhet">Ориентиры бюджета и сроков внедрения</h3>
      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table">
          <thead><tr><th>Источник</th><th>Бюджет</th><th>Срок</th></tr></thead>
          <tbody>
            <tr><td>Nero Network (тема)</td><td>500 тыс.–2 млн ₽</td><td>4–10 недель</td></tr>
            <tr><td>INTEBRIX</td><td>пилот от 500 000 ₽</td><td>по проекту</td></tr>
            <tr><td>ai-journal.ru (2026)</td><td>первый пилот 200K–1M ₽</td><td>1–3 месяца</td></tr>
            <tr><td>agmind.dev</td><td>внедрение ИИ 1,5–4 млн ₽</td><td>по проекту</td></tr>
          </tbody>
        </table>
      </div>

      <h3 id="moduli">Что входит в услугу Nero Network под ключ</h3>
      <ul class="asz-checklist nero-ai-reveal">
        <li>Модуль сменных заданий (план, приоритеты, переназначение)</li>
        <li>Модуль учёта простоев (коды причин, длительность, РЦ/линия)</li>
        <li>AI-оркестратор (пересборка плана, классификация, резюме)</li>
        <li>Мобильный интерфейс (Telegram Mini App)</li>
        <li>Дашборд руководителя (веб или Google Sheets/BI)</li>
        <li>Модуль эскалации (таймеры, уведомления)</li>
      </ul>
      <p><strong>CTA:</strong> «Найти простои» — аудит способа фиксации. <strong>Лид-магнит:</strong> «Карта потерь производства».</p>
    </div>
  </section>

  <!-- CTA 3: после #ceny (Артур) -->
  <div class="asz-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет пилота на одной смене</p>
        <p class="ym-cta-block__sub">Ориентир 500 тыс.–2 млн ₽ за внедрение под ключ, 4–10 недель. На аудите «Найти простои» дадим оценку по рабочим центрам, интеграциям и срокам карты потерь — бесплатно.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
          <a href="#faq" class="nero-ai-btn nero-ai-btn-ghost ym-btn ym-btn--ghost">Вопросы и ответы</a>
        </div>
      </div>
    </div>
  </div>

  <!-- H2 #6: #faq -->
  <section class="asz-section asz-section-alt" id="faq">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">FAQ</span>
        <h2>FAQ: внедрение AI без программиста и связь с CRM</h2>
      </div>

      <div class="asz-faq nero-ai-reveal" id="asz-faq-accordion">
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли внедрить AI-агента без штатных разработчиков?</div><div class="asz-faq-a">Да. Nero Network разворачивает MVP на n8n/Make + LLM, настраивает Telegram-бота и интеграции с 1С. Штатному IT достаточно выдать доступ к учётной системе.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли датчики для старта?</div><div class="asz-faq-a">Нет. Ручная фиксация через Telegram достаточна для MVP; датчики (ENGINE, ФОРСЕТИ, Kitmon) ускоряют обнаружение, но не заменяют классификацию причины.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Это замена MES?</div><div class="asz-faq-a">Нет. Это MES-lite + AI-оркестрация для малого цеха. Полноценный MES — следующий этап после пилота.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Agentic AI — не хайп?</div><div class="asz-faq-a">Gartner предупреждает о 40% отмен — поэтому Nero Network делает узкий scope с human-in-the-loop, а не «автономный цех».</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли CRM?</div><div class="asz-faq-a">Не обязательна для старта. Базовый контур — 1С + Telegram. Bitrix24 полезен, когда простои влияют на отгрузки и нужна эскалация в задачи.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько длится пилот?</div><div class="asz-faq-a">2–4 недели на одной линии/смене; полное внедрение — 4–10 недель.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai производство контроль?</div><div class="asz-faq-a">Ориентир 500 тыс.–2 млн ₽ после аудита. Пилот на одной смене — в нижней части коридора.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Какие AI-модели используются?</div><div class="asz-faq-a">YandexGPT, GigaChat или OpenAI через API — в зависимости от требований к данным и инфраструктуре заказчика.</div></div>
      </div>
    </div>
  </section>

</div><!-- /.asz-content -->



  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.asz-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      var item=q.parentElement;
      var open=item.classList.contains('open');
      document.querySelectorAll('.asz-faq-item.open').forEach(function(i){i.classList.remove('open');i.querySelector('.asz-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-agent-smennye-zadaniya-prostoi-page') || document.querySelector('.asz-content');
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
