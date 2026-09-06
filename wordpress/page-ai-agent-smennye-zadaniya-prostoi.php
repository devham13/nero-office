<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев: внедрение под ключ
 * Description: SEO-лендинг — AI-агент для сменных заданий и контроля простоев на малом производстве.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-агент для сменных заданий и контроля простоев на производстве';
$page_seo_description = 'Внедрение AI-агента для сменных заданий и контроля простоев на малом производстве: сбор данных по смене, фиксация отклонений, отчёт руководителю. Под ключ.';

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

$nero_ai_header_links = [
    ['label' => 'Зачем',      'href' => '#zachem'],
    ['label' => 'Функции',    'href' => '#funkcii'],
    ['label' => 'Сценарий',   'href' => '#scenarii'],
    ['label' => 'Внедрение',  'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы',      'href' => '#keisy'],
    ['label' => 'FAQ',        'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Написать в Telegram';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

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
/* === AIPZ: контент лонгрида (не hero) === */
.aipz-content{
  --aipz-bg:#050711;--aipz-bg2:#080b17;--aipz-bg3:#0a0e1c;
  --aipz-surface:rgba(255,255,255,.072);--aipz-surface2:rgba(255,255,255,.108);
  --aipz-text:#e6edf7;--aipz-muted:#9aa8bd;--aipz-soft:#c7d2e5;--aipz-heading:#fff;
  --aipz-border:rgba(255,255,255,.10);--aipz-border-s:rgba(255,255,255,.18);
  --aipz-accent:#f5c518;--aipz-violet:#8b5cf6;--aipz-green:#22c55e;--aipz-cyan:#79f2ff;
  --aipz-red:#ef4444;--aipz-btn-from:#2563eb;--aipz-btn-to:#7c3aed;
  --aipz-shadow:0 24px 72px rgba(0,0,0,.4);
  --aipz-r:18px;--aipz-r-lg:24px;--aipz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aipz-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aipz-content *,.aipz-content *::before,.aipz-content *::after{box-sizing:border-box;}
.aipz-content a{color:inherit;text-decoration:none;}
.aipz-content p{color:var(--aipz-muted);line-height:1.72;margin:0 0 1em;}
.aipz-content p:last-child{margin-bottom:0;}
.aipz-content h2,.aipz-content h3,.aipz-content h4{color:var(--aipz-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aipz-content strong{color:var(--aipz-soft);}
.aipz-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aipz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aipz-muted);font-size:14.5px;line-height:1.65;}
.aipz-content ul li::before{content:'›';position:absolute;left:0;color:var(--aipz-accent);font-weight:700;}
.aipz-cnt{width:min(var(--aipz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aipz-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aipz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aipz-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aipz-sh.aipz-left{margin-left:0;text-align:left;}
.aipz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aipz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aipz-sh.aipz-left p{margin-left:0;}
.aipz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aipz-accent);margin-bottom:14px;}
.aipz-gt{background:linear-gradient(92deg,#fff 0%,var(--aipz-accent) 44%,var(--aipz-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.aipz-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aipz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aipz-intro-text{position:relative;padding-left:20px;}
.aipz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aipz-accent),var(--aipz-violet));}
.aipz-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.aipz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aipz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.aipz-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aipz-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.aipz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aipz-muted);line-height:1.4;}
.aipz-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.aipz-intro-grid{grid-template-columns:1fr;gap:36px;}.aipz-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.aipz-intro-kpi{grid-template-columns:1fr 1fr;}}
.aipz-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aipz-border);border-radius:var(--aipz-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.aipz-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.aipz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aipz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.aipz-grid-2,.aipz-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.aipz-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aipz-grid-3{grid-template-columns:1fr;}}
.aipz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aipz-table{width:100%;border-collapse:collapse;font-size:14px;}
.aipz-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--aipz-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
.aipz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aipz-text);vertical-align:top;}
.aipz-table tr:last-child td{border-bottom:none;}
.aipz-table tr:hover td{background:rgba(255,255,255,.03);}
.aipz-scenario-col{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aipz-scenario-col .aipz-card{border-radius:var(--aipz-r);padding:24px;}
.aipz-scenario-col .aipz-card--before{border-color:rgba(239,68,68,.25);}
.aipz-scenario-col .aipz-card--after{border-color:rgba(34,197,94,.28);}
.aipz-scenario-col .aipz-card--before h3{color:#fca5a5;}
.aipz-scenario-col .aipz-card--after h3{color:#86efac;}
@media(max-width:768px){.aipz-scenario-col{grid-template-columns:1fr;}}
.aipz-timeline{position:relative;padding-left:40px;}
.aipz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aipz-accent),var(--aipz-violet));opacity:.35;border-radius:2px;}
.aipz-tl-item{position:relative;margin-bottom:32px;}
.aipz-tl-item:last-child{margin-bottom:0;}
.aipz-tl-item::before{content:'';position:absolute;left:-34px;top:6px;width:12px;height:12px;border-radius:50%;background:var(--aipz-accent);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.aipz-tl-item h3{font-size:17px;margin-bottom:6px;}
.aipz-icon-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;}
.aipz-icon-item{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:18px 14px;text-align:center;}
.aipz-icon-item .ic{font-size:28px;margin-bottom:8px;}
.aipz-icon-item strong{display:block;font-size:13px;color:var(--aipz-heading);margin-bottom:4px;}
.aipz-icon-item span{font-size:12px;color:var(--aipz-muted);}
@media(max-width:768px){.aipz-icon-grid{grid-template-columns:repeat(2,1fr);}}
.aipz-quote{border-left:3px solid var(--aipz-violet);padding:20px 24px;background:rgba(139,92,246,.08);border-radius:0 14px 14px 0;margin:24px 0;}
.aipz-quote p{font-style:italic;color:var(--aipz-soft);margin:0;}
.aipz-quote cite{display:block;margin-top:10px;font-size:12px;color:var(--aipz-muted);font-style:normal;}
.aipz-checklist{display:grid;gap:8px;margin:16px 0;}
.aipz-checklist label{display:flex;align-items:flex-start;gap:10px;font-size:14px;color:var(--aipz-muted);cursor:pointer;}
.aipz-faq-item{border:1px solid rgba(255,255,255,.08);border-radius:14px;margin-bottom:10px;overflow:hidden;}
.aipz-faq-item summary{padding:18px 22px;font-weight:700;color:var(--aipz-heading);cursor:pointer;list-style:none;}
.aipz-faq-item summary::-webkit-details-marker{display:none;}
.aipz-faq-body{padding:0 22px 18px;color:var(--aipz-muted);font-size:14.5px;line-height:1.7;}
.ym-cta-block{margin:36px 0;padding:28px 32px;border-radius:var(--aipz-r-lg);background:linear-gradient(135deg,rgba(245,197,24,.1),rgba(139,92,246,.08));border:1px solid rgba(245,197,24,.22);text-align:center;}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.1);}
.ym-cta-block--footer-final{margin-bottom:0;}
.ym-cta-block__headline{font-size:clamp(18px,2.2vw,22px);font-weight:800;color:var(--aipz-heading);margin:0 0 10px;}
.ym-cta-block__sub{font-size:15px;color:var(--aipz-muted);margin:0 auto 20px;max-width:640px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
</style>

.aipz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aipz-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aipz-toc a{display:inline-block;padding:9px 18px;background:var(--aipz-surface);border:1px solid var(--aipz-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aipz-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.aipz-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--aipz-accent);background:rgba(245,197,24,.08);}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);margin-bottom:0;}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--aipz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aipz-btn-from),var(--aipz-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-link--accent{color:var(--aipz-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.aipz-hero{min-height:100vh;min-height:100dvh;position:relative;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important;}
body.nero-ai-landing{padding-top:0!important;}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important;}

</style>

<main id="primary" class="site-main nero-ai-home-page aipz-page" role="main" tabindex="-1">

<section class="nero-ai-hero aipz-hero" id="hero" aria-labelledby="aipz-hero-title">
<style>
/* ── Hero aipz: самодостаточные стили (без CSS темы) ── */
.aipz-hero {
  --aipz-gold: #f5c518;
  --aipz-cyan: #79f2ff;
  --aipz-violet: #8b5cf6;
  --aipz-green: #22c55e;
  --aipz-amber: #f59e0b;
  --aipz-red: #ef4444;
  --aipz-text: #e6edf7;
  --aipz-muted: #9aa8bd;
  --aipz-soft: #c7d2e5;
  --aipz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aipz-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 74%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.aipz-hero::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .09), transparent 66%);
  filter: blur(10px);
  animation: aipzHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aipzHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.aipz-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aipz-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aipz-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aipz-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aipz-cyan) 38%, var(--aipz-gold) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aipz-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.07);
  color: var(--aipz-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aipz-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aipz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aipz-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aipz-hero .nero-ai-badge {
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
.aipz-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aipz-hero .nero-ai-btn {
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
.aipz-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.aipz-hero .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--aipz-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.aipz-hero .nero-ai-btn-secondary {
  color: var(--aipz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aipz-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aipz-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.aipz-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aipz-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aipz-hero .nero-ai-dots { display: flex; gap: 7px; }
.aipz-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aipz-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aipz-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aipz-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.aipz-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aipz-hero .nero-ai-window-body { padding: 16px; }
.aipz-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aipz-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aipz-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(245,158,11,.12);
  color: #fde68a;
  font-size: 12px;
  font-weight: 800;
}
.aipz-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--aipz-amber);
  box-shadow: 0 0 0 6px rgba(245,158,11,.14);
  animation: aipzPulse 1.6s infinite;
}
@keyframes aipzPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aipz-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aipz-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aipz-hero .nero-ai-metric span {
  display: block;
  color: var(--aipz-muted);
  font-size: 11px;
  font-weight: 700;
}
.aipz-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aipz-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aipz-hero .nero-ai-metric--warn strong { color: var(--aipz-amber); }
.aipz-hero .nero-ai-metric--good strong { color: var(--aipz-green); }
.aipz-hero .aipz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 50% 60%, rgba(121,242,255,.06), rgba(6,10,24,.94) 72%);
}
.aipz-hero #aipz-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aipz-hero .aipz-phase-pill {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 12px;
}
.aipz-hero .aipz-phase-pill span {
  padding: 5px 10px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .04em;
  text-transform: uppercase;
  border: 1px solid rgba(255,255,255,.1);
  background: rgba(255,255,255,.04);
  color: var(--aipz-muted);
}
.aipz-hero .aipz-phase-pill span.is-active {
  border-color: rgba(121,242,255,.35);
  background: rgba(121,242,255,.12);
  color: var(--aipz-cyan);
}
.aipz-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.aipz-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aipz-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aipz-cyan);
  font-size: 11px;
  font-weight: 800;
}
.aipz-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aipz-hero .nero-ai-task span {
  color: var(--aipz-muted);
  font-size: 11px;
}
.aipz-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aipz-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.aipz-hero .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .aipz-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aipz-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aipz-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aipz-hero .nero-ai-window-body { padding: 12px; }
  .aipz-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aipz-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai производство контроль</p>
      <h1 id="aipz-hero-title">AI-агент для сменных заданий и контроля простоев: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI собирает данные по смене, фиксирует отклонения и простои — вы видите потери производства до конца смены, а не постфактум</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">1С/ERP</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">Пилот 4–8 нед.</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zachem">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-контроля смены на производстве">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-контроль смены · демо</h3>
            <span class="nero-ai-live-pill">смена live</span>
          </div>

          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--warn">
              <span>Активные простои</span>
              <strong>2</strong>
              <small>нет материала · переналадка</small>
            </div>
            <div class="nero-ai-metric">
              <span>План/факт смены</span>
              <strong>87%</strong>
              <small>обновлено 2 мин назад</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время реакции</span>
              <strong>12 мин</strong>
              <small>до эскалации мастеру</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--good">
              <span>Потери за смену</span>
              <strong>−23%</strong>
              <small>потенциал пилота</small>
            </div>
          </div>

          <div class="aipz-phase-pill" aria-hidden="true">
            <span class="is-active" data-aipz-phase="0">План</span>
            <span data-aipz-phase="1">Простой</span>
            <span data-aipz-phase="2">Перестановка</span>
            <span data-aipz-phase="3">Отчёт</span>
          </div>

          <div class="aipz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aipz-hero-canvas" role="img" aria-label="Анимация: сменные задания на рельсах участков, маячок простоя, AI переставляет бригаду и отправляет отчёт руководителю"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">08</span>
              <div><strong>Сменный план выдан</strong><span>Заказы из 1С → Telegram мастеру</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⚠</span>
              <div><strong>Простой: нет материала</strong><span>Участок 2 · код ожидания</span></div>
              <span class="nero-ai-status nero-ai-status--amber">12 мин</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI предложил перестановку</strong><span>2 варианта · ждёт подтверждения мастера</span></div>
              <span class="nero-ai-status nero-ai-status--violet">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Отчёт руководителю готов</strong><span>План/факт · топ-3 простоя · карта потерь</span></div>
              <span class="nero-ai-status">отправлен</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="aipz-content">


  <!-- INTRO -->
  <section class="aipz-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aipz-cnt">
      <div class="aipz-intro-grid nero-ai-reveal">
        <div class="aipz-intro-text">
          <p class="aipz-eyebrow">Лонгрид · ai производство контроль</p>
          <p><strong>Коротко:</strong> AI-агент для сменных заданий и контроля простоев — это не «автономный цех из презентации», а связка цифровой выдачи заданий, контроля событий смены и AI-оркестратора с human-in-the-loop. Nero Network внедряет такой пилот на одной линии за 4–8 недель.</p>
          <p>На малом производстве — мебельном цехе, пищевой линии, сборочном участке на 5–50 человек — <strong>ai производство контроль</strong> начинается не с датчиков и не с полной MES. Он начинается с вопроса: кто первым узнаёт, что смена встала, и сколько стоит каждый час паузы.</p>
        </div>
        <div class="aipz-intro-kpi" aria-label="Ключевые метрики производства">
          <div class="aipz-kpi-card"><div class="kv">14,5%</div><div class="kl">считают график ППР</div><div class="ks">Деснол, 2026</div></div>
          <div class="aipz-kpi-card"><div class="kv">40%+</div><div class="kl">agentic-проектов отменят</div><div class="ks">Gartner 2027</div></div>
          <div class="aipz-kpi-card"><div class="kv">60–600 тыс.</div><div class="kl">₽/час простоя</div><div class="ks">inner.su, 2025</div></div>
          <div class="aipz-kpi-card"><div class="kv">4–8 нед.</div><div class="kl">пилот на одной линии</div><div class="ks">Nero Network</div></div>
        </div>
      </div>
    </div>


  <div class="aipz-toc-outer">
    <div class="aipz-cnt">
      <nav class="aipz-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем</a>
        <a href="#funkcii">Функции</a>
        <a href="#scenarii">Сценарий</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#agentic">Agentic AI</a>
        <a href="#karta-poter">Карта потерь</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Заказать</a>
      </nav>
    </div>
  </div>
  </section>

  <!-- ZACHEM -->
  <section class="aipz-section" id="zachem">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <span class="aipz-eyebrow">Зачем производству</span>
        <h2>Зачем производству AI-агент для сменных заданий и контроля простоев</h2>
        <p>Типовая боль малого цеха: сменное задание в Excel или WhatsApp, простои узнают вечером, мастер тратит время на обзвоны.</p>
        <!-- INTERNAL-LINKS:INSERT -->
      </div>

      <div class="aipz-grid-2 nero-ai-reveal">
        <div class="aipz-card" id="bolez-ruchnye-zadaniya">
          <h3>Когда задачи меняются вручную, а простои фиксируются поздно</h3>
          <p>По данным Деснол (август 2026), только <strong>14,5%</strong> предприятий регулярно считают выполнение графика ППР. OEE на российских предприятиях часто <strong>30–70%</strong> при <strong>80–85%</strong> у мировых лидеров. Стоимость часа простоя — от <strong>60 000 до 600 000 ₽</strong>.</p>
          <p><strong>Итог:</strong> боль «задачи меняются вручную, простои фиксируются поздно» — прямой удар по выручке смены.</p>
        </div>
        <div class="aipz-card nero-ai-delay-1" id="ai-sbor-dannyh">
          <h3>Как AI собирает данные по смене и фиксирует отклонения</h3>
          <p><strong>AI собирает данные по смене, фиксирует отклонения и формирует отчёт руководителю</strong> — до конца смены, а не постфактум.</p>
          <ul>
            <li>Сменный план в Telegram Mini App из 1С или таблицы</li>
            <li>Кнопки «в работе», «выполнено», «простой» + справочник причин</li>
            <li>AI сравнивает план и факт каждые 15–30 мин</li>
            <li>Эскалация при простое &gt; N минут</li>
            <li>Автоотчёт: план/факт, топ-3 простоев, карта потерь в ₽</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- FUNKCII -->
  <section class="aipz-section aipz-section-alt" id="funkcii">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <span class="aipz-eyebrow">Функции агента</span>
        <h2>Что делает AI-агент на производстве: сменные задания, простои, отчёты</h2>
      </div>

      <div class="aipz-grid-3 nero-ai-reveal">
        <div class="aipz-card" id="smennye-zadaniya">
          <h3>Автоматизация сменных заданий для цеха</h3>
          <p><strong>ai сменные задания</strong> — живой план смены с приоритетами. MES-lite выдаёт план; AI-агент <strong>пересобирает</strong> его при сбое — по логике Hivekit OPS.AI с human-in-the-loop.</p>
        </div>
        <div class="aipz-card nero-ai-delay-1" id="kontrol-prostoev">
          <h3>Контроль простоев в реальном времени</h3>
          <p><strong>ai контроль простоев</strong> закрывает организационные простои: «нет задания», «нет материала», «ждём мастера». Коды MVP: нет материала, переналадка, поломка, ожидание задания, брак.</p>
        </div>
        <div class="aipz-card nero-ai-delay-2" id="otchet-rukovoditelyu">
          <h3>Отчёт руководителю по итогам смены</h3>
          <p>Live-дашборд + handoff-пакет для следующей смены. Кейс «Ай-Пласт» + 1С:ТОИР: −10% длительность простоев, отчётность на 20% быстрее.</p>
        </div>
      </div>

      <div class="aipz-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aipz-table" aria-label="Сравнение подходов к сменным заданиям">
          <thead>
            <tr>
              <th>Критерий</th>
              <th>Бумага / Excel / чат</th>
              <th>MES-lite</th>
              <th>AI-агент смены Nero</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Выдача плана</td><td>Вручную</td><td>Цифровой план</td><td>Из 1С/таблицы</td></tr>
            <tr><td>Изменение при сбое</td><td>Звонки</td><td>Частично вручную</td><td>AI предлагает 2–3 варианта</td></tr>
            <tr><td>Фиксация факта</td><td>Постфактум</td><td>В системе</td><td>В реальном времени</td></tr>
            <tr><td>Отчёт руководителю</td><td>Конец недели</td><td>Конец смены</td><td>Live + автоотчёт</td></tr>
            <tr><td>Срок внедрения</td><td>—</td><td>Месяцы</td><td>Пилот 4–8 недель</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- SCENARII -->
  <section class="aipz-section" id="scenarii">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <span class="aipz-eyebrow">Сценарий дня</span>
        <h2>Сценарий дня мастера: до и после</h2>
      </div>

      <div class="aipz-scenario-col nero-ai-reveal">
        <div class="aipz-card aipz-card--before">
          <h3>До (бумага и чаты)</h3>
          <ul>
            <li><strong>08:00</strong> — план на доске, половина бригады не видела изменений в WhatsApp</li>
            <li><strong>11:00</strong> — нет фасовки, линия стоит 40 мин; мастер узнал устно</li>
            <li><strong>14:00</strong> — срочный заказ: переписка с офисом, кто что делает — неясно</li>
            <li><strong>20:00</strong> — директор спрашивает «сколько простояли»; мастер считает «на глаз»</li>
          </ul>
        </div>
        <div class="aipz-card aipz-card--after">
          <h3>После (AI-агент Nero)</h3>
          <ul>
            <li><strong>08:00</strong> — сменный план в Telegram: заказы, приоритеты из 1С</li>
            <li><strong>11:00</strong> — «простой → нет материала»; эскалация; AI предложил перестановку — мастер подтвердил</li>
            <li><strong>14:00</strong> — срочный заказ: 2 варианта пересборки; рабочие получили обновлённые задания</li>
            <li><strong>20:00</strong> — отчёт: 47 мин организационных простоев, карта потерь в ₽</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- === БОРИС: визуальный блок после #scenarii === -->
  <section id="ai-agent-smennye-zadaniya-prostoi-boris-block" class="bpz-root" aria-label="Анимация: мониторинг смены в реальном времени — простои, эскалация и пересборка заданий AI-агентом">
<style>
/* === БОРИС: prefix bpz-, scoped внутри #ai-agent-smennye-zadaniya-prostoi-boris-block === */
#ai-agent-smennye-zadaniya-prostoi-boris-block.bpz-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:520px;
}
@media(max-width:1023px){
  #ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#d97706;margin:0 0 14px;
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-ey::before{
  content:'';width:18px;height:2px;background:#d97706;border-radius:1px;
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-ul{
  list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(217,119,6,.1);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#b45309;margin-top:1px;font-style:normal;
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-pl-a{background:rgba(245,197,24,.12);color:#b45309;border:1.5px solid rgba(245,197,24,.35);}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-rgt{
  position:relative;
  background:linear-gradient(135deg,#0f172a 0%,#1e293b 45%,#0f172a 100%);
  min-height:460px;overflow:hidden;
}
@media(max-width:1023px){
  #ai-agent-smennye-zadaniya-prostoi-boris-block .bpz-rgt{min-height:380px;}
}
#aipz-shift-live-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="bpz-cnt">
  <div class="bpz-card">
    <div class="bpz-lft">
      <span class="bpz-ey">Мониторинг смены · live</span>
      <h3 class="bpz-h3">Смена в реальном времени: простой → эскалация → пересборка заданий</h3>
      <ul class="bpz-ul">
        <li><span class="bpz-ic">⚡</span>Оператор фиксирует простой в Telegram — событие сразу на панели мастера</li>
        <li><span class="bpz-ic">⏱</span>Через 15 мин без действия — эскалация руководителю с кодом причины</li>
        <li><span class="bpz-ic">🤖</span>AI-оркестратор предлагает 2–3 варианта перестановки бригады</li>
        <li><span class="bpz-ic">✓</span>Мастер подтверждает — human-in-the-loop, не автопилот</li>
      </ul>
      <div class="bpz-pills">
        <span class="bpz-pl bpz-pl-a">реакция 12 мин</span>
        <span class="bpz-pl bpz-pl-g">план/факт 87%</span>
        <span class="bpz-pl bpz-pl-b">Telegram + 1С</span>
      </div>
      <p class="bpz-foot">Дальше — этапы внедрения AI-агента под ключ и ориентиры по цене →</p>
    </div>
    <div class="bpz-rgt">
      <canvas
        id="aipz-shift-live-canvas"
        aria-label="Анимация: панель мониторинга смены — станки, простои, эскалация и пересборка заданий AI-агентом"
        role="img"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('aipz-shift-live-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0, cycle = 0;

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
    ink:'#e2e8f0', muted:'#94a3b8', panel:'#1e293b', panelBdr:'#334155',
    line:'#475569', accent:'#f5c518', accentGlow:'rgba(245,197,24,.25)',
    green:'#22c55e', greenGlow:'rgba(34,197,94,.2)',
    red:'#ef4444', redGlow:'rgba(239,68,68,.25)',
    cyan:'#79f2ff', violet:'#8b5cf6', aiGlow:'rgba(139,92,246,.3)',
    card:'#0f172a', cardBdr:'#475569', ok:'#22c55e', warn:'#f59e0b'
  };

  var LOOP = 720;
  var stations = [
    {label:'Уч. A', status:'work', progress:0.72},
    {label:'Уч. B', status:'down',  progress:0.18, reason:'Нет материала'},
    {label:'Уч. C', status:'work', progress:0.55},
    {label:'Уч. D', status:'idle',  progress:0.05, reason:'Переналадка'}
  ];

  var events = [];
  var aiPulse = 0;
  var confirmFlash = 0;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function pushEvent(text, kind){
    events.unshift({text:text, kind:kind, age:0});
    if(events.length > 4) events.pop();
  }

  function drawHeader(x,y,w){
    rr(x,y,w,36,8,C.panel,C.panelBdr,1);
    ctx.fillStyle=C.cyan;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('AI-контроль смены · live', x+12, y+22);
    var t = new Date();
    var ts = ('0'+t.getHours()).slice(-2)+':'+('0'+t.getMinutes()).slice(-2);
    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='right';
    ctx.fillText('Смена · '+ts, x+w-12, y+22);
  }

  function drawKpiRow(x,y,w){
    var kw = (w-24)/3;
    var kpis = [
      {l:'План/факт', v:'87%', c:C.green},
      {l:'Простои', v:'2', c:C.accent},
      {l:'Реакция', v:'12 мин', c:C.cyan}
    ];
    for(var i=0;i<3;i++){
      var kx = x + 8 + i*(kw+4);
      rr(kx,y,kw,44,6,C.card,C.cardBdr,1);
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(kpis[i].l, kx+8, y+16);
      ctx.fillStyle=kpis[i].c;
      ctx.font='bold 16px Inter,sans-serif';
      ctx.fillText(kpis[i].v, kx+8, y+36);
    }
  }

  function drawStation(sx,sy,sw,sh,st,pulse){
    var stColor = st.status==='work'?C.green:(st.status==='down'?C.red:C.warn);
    rr(sx,sy,sw,sh,8,C.card,stColor,2);
    ctx.fillStyle=C.ink;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText(st.label, sx+10, sy+18);
    var barW = sw-20;
    rr(sx+10,sy+26,barW,8,3,C.line,null,0);
    rr(sx+10,sy+26,barW*st.progress,8,3,stColor,null,0);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    var stLabel = st.status==='work'?'В работе':(st.status==='down'?'Простой':'Переналадка');
    ctx.fillText(stLabel, sx+10, sy+46);
    if(st.reason && st.status==='down'){
      ctx.fillStyle=C.red;
      ctx.font='8px Inter,sans-serif';
      ctx.fillText(st.reason, sx+10, sy+58);
      if(pulse>0.3){
        ctx.globalAlpha = pulse*0.5;
        rr(sx-2,sy-2,sw+4,sh+4,10,null,C.red,2);
        ctx.globalAlpha = 1;
      }
    }
  }

  function drawAiHub(cx,cy,r,pulse,showConfirm){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0,C.aiGlow);
    g.addColorStop(1,'rgba(139,92,246,0)');
    ctx.fillStyle=g;
    ctx.beginPath();ctx.arc(cx,cy,r*1.8,0,Math.PI*2);ctx.fill();
    rr(cx-r,cy-r,r*2,r*2,r*0.4,'#1e1b4b',C.violet,2);
    ctx.fillStyle=C.cyan;
    ctx.font='bold '+Math.max(10,r*0.28)+'px Inter,sans-serif';
    ctx.textAlign='center';ctx.textBaseline='middle';
    ctx.fillText('AI', cx, cy-4);
    ctx.fillStyle=C.muted;
    ctx.font=Math.max(8,r*0.16)+'px Inter,sans-serif';
    ctx.fillText('пересборка', cx, cy+r*0.35);
    if(showConfirm){
      ctx.fillStyle=C.green;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.fillText('✓ мастер', cx, cy+r*0.75);
    }
    ctx.strokeStyle=C.violet;
    ctx.lineWidth=1.5+pulse*2;
    ctx.globalAlpha=0.25+pulse*0.35;
    ctx.beginPath();ctx.arc(cx,cy,r+5+pulse*6,0,Math.PI*2);ctx.stroke();
    ctx.globalAlpha=1;
  }

  function drawEventFeed(x,y,w,h){
    rr(x,y,w,h,8,C.panel,C.panelBdr,1);
    ctx.fillStyle=C.muted;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Лента событий', x+10, y+16);
    for(var i=0;i<events.length;i++){
      var ev = events[i];
      var ey = y + 24 + i*22;
      var dot = ev.kind==='down'?C.red:(ev.kind==='ai'?C.violet:C.green);
      ctx.fillStyle=dot;
      ctx.beginPath();ctx.arc(x+14,ey+6,3,0,Math.PI*2);ctx.fill();
      ctx.fillStyle=C.ink;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText(ev.text, x+24, ey+10);
    }
  }

  function drawRerouteArrow(x1,y1,x2,y2,alpha){
    if(alpha<0.05) return;
    ctx.globalAlpha=alpha;
    ctx.strokeStyle=C.cyan;
    ctx.lineWidth=2;
    ctx.setLineDash([6,4]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);
    ctx.quadraticCurveTo((x1+x2)/2,y1-30,x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.globalAlpha=1;
  }

  function tick(){
    frame++;
    cycle = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var pad = Math.max(12,W*0.03);
    var topY = pad;
    drawHeader(pad, topY, W-pad*2);
    drawKpiRow(pad, topY+44, W-pad*2);

    var gridY = topY + 100;
    var gridH = H - gridY - pad - 70;
    var sw = (W - pad*2 - 30) / 4;
    var pulse = 0.5 + 0.5*Math.sin(frame*0.08);

    /* фазы цикла */
    var phase = cycle / LOOP;
    var showAi = phase > 0.25 && phase < 0.85;
    var showConfirm = phase > 0.55 && phase < 0.75;
    var arrowAlpha = phase > 0.35 && phase < 0.7 ? Math.sin((phase-0.35)*Math.PI/0.35)*0.9 : 0;

    if(cycle === 180) pushEvent('Простой: нет материала · уч. B', 'down');
    if(cycle === 320) pushEvent('AI: 2 варианта перестановки', 'ai');
    if(cycle === 480) pushEvent('Мастер подтвердил план B→A', 'ok');
    if(cycle === 600) pushEvent('Эскалация директору · 15 мин', 'down');

    for(var i=0;i<4;i++){
      var sx = pad + i*(sw+10);
      var st = stations[i];
      if(i===1 && cycle>180 && cycle<500) st.status='down';
      else if(i===1 && cycle>=500) st.status='work';
      else if(i===3) st.status = cycle%LOOP<400?'idle':'work';
      drawStation(sx, gridY, sw, Math.min(gridH,72), st, i===1?pulse:0);
    }

    /* линия цеха */
    ctx.strokeStyle=C.line;
    ctx.lineWidth=3;
    ctx.beginPath();
    ctx.moveTo(pad+20, gridY+82);
    ctx.lineTo(W-pad-20, gridY+82);
    ctx.stroke();

    var hubX = W*0.5, hubY = gridY + gridH*0.55;
    if(showAi) drawAiHub(hubX, hubY, Math.min(W,H)*0.06, pulse, showConfirm);

    if(showAi && arrowAlpha>0){
      drawRerouteArrow(pad+sw+sw/2, gridY+40, hubX-20, hubY-20, arrowAlpha);
      drawRerouteArrow(hubX+20, hubY+10, pad+sw*3+sw/2, gridY+40, arrowAlpha*0.7);
    }

    drawEventFeed(pad, H-pad-62, W-pad*2, 58);

    for(var j=0;j<events.length;j++) events[j].age++;

    requestAnimationFrame(tick);
  }

  pushEvent('Сменный план выдан · 08:00', 'ok');
  pushEvent('Уч. A: операция в работе', 'ok');
  tick();
})();
</script>
</section>

  <!-- CTA после сценария (Артур) -->
  <div class="aipz-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
      <div class="ym-cta-block__icon" aria-hidden="true">🏭</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Найдите простои на вашем участке — до конца смены</p>
        <p class="ym-cta-block__sub">За 1 неделю проведём аудит: где живут сменные задания, какие коды простоев уже есть и сколько стоит час линии. На выходе — карта потерь производства и ориентир ROI пилота без обязательств.</p>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>

  <!-- ETAPY -->
  <section class="aipz-section aipz-section-alt" id="etapy">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <span class="aipz-eyebrow">Внедрение под ключ</span>
        <h2>Внедрение AI в бизнес-процессы производства под ключ</h2>
        <p>Gartner: <strong>более 40%</strong> agentic AI-проектов будут отменены к 2027. Nero отвечает узким пилотом: одна линия, human-in-the-loop.</p>
      </div>

      <div class="aipz-timeline nero-ai-reveal">
        <div class="aipz-tl-item" id="faza-audit">
          <h3>Фаза 0 (1 неделя) — аудит «как сейчас»</h3>
          <p>Где живут сменные задания, коды простоев, кто узнаёт о простое первым, стоимость часа линии.</p>
        </div>
        <div class="aipz-tl-item" id="faza-mvp">
          <h3>Фаза 1 (2–3 недели) — MVP на одном участке</h3>
          <p>Telegram Mini App, план из 1С/Sheets, кнопки статусов, эскалация при простое &gt; N минут.</p>
        </div>
        <div class="aipz-tl-item" id="faza-ai">
          <h3>Фаза 2 (2–3 недели) — AI-оркестратор</h3>
          <p>2–3 варианта перестановки, сменный отчёт, карта потерь — только после подтверждения мастера.</p>
        </div>
        <div class="aipz-tl-item" id="faza-datchiki">
          <h3>Фаза 3 (опционально) — датчики</h3>
          <p>MonitoringLite, ЭНКОСТ, Modbus — сверка автоматической остановки с ручным вводом.</p>
        </div>
      </div>

      <div class="aipz-table-wrap nero-ai-reveal" style="margin-top:36px;">
        <table class="aipz-table" aria-label="Сроки и стоимость внедрения">
          <thead><tr><th>Параметр</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td>Чек проекта Nero Network</td><td><strong>500 000 – 2 000 000 ₽</strong></td></tr>
            <tr><td>AI-пилот на одном процессе (РФ)</td><td><strong>600 000 – 900 000 ₽</strong></td></tr>
            <tr><td>Срок пилота</td><td><strong>4–8 недель</strong></td></tr>
          </tbody>
        </table>
      </div>

      <div class="aipz-card nero-ai-reveal" id="bez-programmista" style="margin-top:28px;">
        <h3>Как внедрить ai производство контроль без программиста</h3>
        <p>Telegram Mini App (3 кнопки), n8n/Make, YandexGPT/GigaChat — интеграции настраивает Nero; на цеху нужен мастер, знающий процесс.</p>
        <div class="aipz-checklist" aria-label="Чек-лист приёмки пилота">
          <label><input type="checkbox" disabled> live-дашборд показывает активные простои</label>
          <label><input type="checkbox" disabled> уведомления в Telegram при эскалации</label>
          <label><input type="checkbox" disabled> история событий за смену доступна руководителю</label>
          <label><input type="checkbox" disabled> сменный отчёт формируется автоматически</label>
          <label><input type="checkbox" disabled> расчёт карты потерь от стоимости часа смены</label>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понять AI до старта пилота на цехе?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI-агента смены полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с 1С/Telegram. Посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- INTEGRACII -->
  <section class="aipz-section" id="integracii">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <span class="aipz-eyebrow">Интеграции</span>
        <h2>Интеграция AI-агента с 1С, ERP, CRM и датчиками</h2>
      </div>
      <div class="aipz-icon-grid nero-ai-reveal">
        <div class="aipz-icon-item"><div class="ic">📊</div><strong>1С / ERP</strong><span>УНФ, ERP, Sheets</span></div>
        <div class="aipz-icon-item"><div class="ic">💬</div><strong>Telegram</strong><span>Mini App для мастера</span></div>
        <div class="aipz-icon-item"><div class="ic">📡</div><strong>Датчики</strong><span>Modbus, ЭНКОСТ</span></div>
        <div class="aipz-icon-item"><div class="ic">🔗</div><strong>CRM</strong><span>Bitrix24, amoCRM</span></div>
      </div>
      <div class="aipz-card nero-ai-reveal" style="margin-top:24px;" id="integraciya-crm">
        <h3>AI производство контроль в CRM и мобильные формы для мастеров</h3>
        <p>CRM фиксирует статус пилота; оперативные данные смены — в Telegram и дашборде. Опционально — голосовой ввод простоя через SpeechKit.</p>
      </div>
    </div>
  </section>

  <!-- KEISY -->
  <section class="aipz-section aipz-section-alt" id="keisy">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <span class="aipz-eyebrow">Малый бизнес</span>
        <h2>AI для малого производства: цеха, мебель, пищевка</h2>
      </div>
      <div class="aipz-table-wrap nero-ai-reveal">
        <table class="aipz-table">
          <thead><tr><th>Отрасль</th><th>Типовой сценарий</th></tr></thead>
          <tbody>
            <tr><td>Мебель / деревообработка</td><td>Сменное задание по заказам, переналадка, «нет заготовки»</td></tr>
            <tr><td>Пищевое производство</td><td>Линия фасовки, «нет тары», контроль сроков</td></tr>
            <tr><td>Металлообработка / сборка</td><td>Участок без MES, простои «ожидание задания»</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aipz-grid-2 nero-ai-reveal" style="margin-top:24px;">
        <div class="aipz-card"><h3>Кейсы и примеры</h3><p>КитМон, ЭНКОСТ, Hivekit OPS.AI, ICAMES Bot, ZenAI — смежные аналоги по функциям. Прямых публичных кейсов для малого мебельного/пищевого цеха не найдено.</p></div>
        <div class="aipz-card"><h3>Типовые сценарии сбоя</h3><ul><li>Нет материала — перестановка бригады</li><li>Поломка — эскалация + перераспределение</li><li>Срочный заказ — пересборка приоритетов</li><li>Передача смены — handoff-пакет</li></ul></div>
      </div>
    </div>
  </section>

  <!-- AGENTIC -->
  <section class="aipz-section" id="agentic">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <span class="aipz-eyebrow">Agentic AI 2026</span>
        <h2>Agentic AI на производстве: автономия с проверкой результата</h2>
      </div>
      <div class="aipz-quote nero-ai-reveal">
        <p>«Most agentic AI projects right now are early stage experiments… mostly driven by hype and are often misapplied»</p>
        <cite>— Anushree Verma, Gartner, 25.06.2025</cite>
      </div>
      <div class="aipz-table-wrap nero-ai-reveal">
        <table class="aipz-table" aria-label="Сравнение с MES и OEE">
          <thead><tr><th>Решение</th><th>Сильные стороны</th><th>Ограничение для малого цеха</th></tr></thead>
          <tbody>
            <tr><td>MES / APS</td><td>Зрелое планирование</td><td>Долго, дорого</td></tr>
            <tr><td>MES-lite</td><td>Сменные задания, 1С</td><td>Нет AI-пересборки</td></tr>
            <tr><td>OEE-мониторинг</td><td>Датчики, простои</td><td>Нет связки с заданиями</td></tr>
            <tr><td><strong>AI-агент Nero</strong></td><td>Задания + простои + AI + Telegram</td><td>Пилот на одной линии</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- KARTA-POTER -->
  <section class="aipz-section aipz-section-alt" id="karta-poter">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <span class="aipz-eyebrow">Лид-магнит</span>
        <h2>Карта потерь производства: как найти простои до конца смены</h2>
      </div>
      <div class="aipz-grid-2 nero-ai-reveal">
        <div class="aipz-card" id="metodika-audita">
          <h3>Методика аудита потерь</h3>
          <p>8 типов потерь: ожидание, переналадка, микропростои, снижение скорости, брак, простой оборудования, перепроизводство, потери управления.</p>
        </div>
        <div class="aipz-card" id="roi-prostoi">
          <h3>ROI: экономия на простоях</h3>
          <p>Цифровизация учёта даёт рост OEE на <strong>5–15%</strong> и снижение внеплановых простоев на <strong>15–22%</strong> (СПб Политех, 2025).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="aipz-section" id="faq">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <span class="aipz-eyebrow">FAQ</span>
        <h2>FAQ: внедрение AI-агента для контроля производства</h2>
      </div>
      <div class="nero-ai-reveal">
        <details class="aipz-faq-item" id="faq-kak-vnedrit">
          <summary>Как внедрить ai производство контроль</summary>
          <div class="aipz-faq-body"><p>Аудит → MVP на одной линии → AI-оркестратор → опционально датчики. Старт: сменный план за 2–4 недели, справочник причин простоев, стоимость часа линии.</p></div>
        </details>
        <details class="aipz-faq-item" id="faq-cena">
          <summary>Сколько стоит ai производство контроль</summary>
          <div class="aipz-faq-body"><p><strong>500 000 – 2 000 000 ₽</strong> (Nero Network); типовой AI-пилот — <strong>600 000 – 900 000 ₽</strong>. Датчики для старта не обязательны.</p></div>
        </details>
        <details class="aipz-faq-item" id="faq-pod-klyuch">
          <summary>Можно ли заказать разработку и интеграцию под ключ</summary>
          <div class="aipz-faq-body"><p>Да — от аудита до приёмки пилота с интеграцией 1С, CRM, Telegram, датчиками.</p></div>
        </details>
      </div>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="aipz-section" id="cta" style="background:linear-gradient(135deg,rgba(245,197,24,.08),rgba(139,92,246,.08));">
    <div class="aipz-cnt">
      <div class="aipz-sh">
        <h2>Заказать внедрение AI-агента — найти простои</h2>
      </div>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы увидеть простои до конца смены?</p>
          <p class="ym-cta-block__sub">Следующий шаг — аудит участка, карта потерь производства и пилот AI-агента на одной линии за 4–8 недель. Human-in-the-loop: мастер подтверждает каждое изменение плана.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </div>
    </div>
  </section>


</div>


<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * aipz-hero-engine — «Диспетчерская смены цеха»
 * Мир: канбан-рельсы заданий → маячок простоя → AI-перестановка → heatmap потерь → отчёт в Telegram
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aipz-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var phasePills = document.querySelectorAll(".aipz-phase-pill [data-aipz-phase]");

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 12;
    scale = Math.min(cw / 440, ch / 290) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    floor: "#1e293b",
    rail: "#334155",
    railGlow: "rgba(121,242,255,0.25)",
    panelBg: "#0f172a",
    panelBorder: "#475569",
    cyan: "#79f2ff",
    gold: "#f5c518",
    amber: "#f59e0b",
    red: "#ef4444",
    green: "#22c55e",
    violet: "#8b5cf6",
    ticketBlue: "#93c5fd",
    ticketGreen: "#6ee7b7",
    ticketAmber: "#fcd34d",
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

  /* Горизонтальные канбан-рельсы — вместо Conveyor */
  function TaskTicketRail() {
    this.lanes = [
      { y: 42, color: C.ticketBlue, label: "Уч.1" },
      { y: 8, color: C.ticketAmber, label: "Уч.2" },
      { y: -26, color: C.ticketGreen, label: "Уч.3" }
    ];
    this.tickets = [
      { lane: 0, offset: 0, w: 22, label: "З-14" },
      { lane: 1, offset: 55, w: 24, label: "З-22" },
      { lane: 2, offset: 110, w: 20, label: "З-09" },
      { lane: 0, offset: 140, w: 22, label: "З-31" }
    ];
    this.reroute = 0;
  }
  TaskTicketRail.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    this.reroute = prg >= 115 && prg < 175 ? (prg - 115) / 60 : prg >= 175 ? 1 : 0;

    this.lanes.forEach(function (ln) {
      drawRR(ctx, -175, ln.y - 6, 350, 12, 4, C.rail, C.outline);
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(ln.label, -172, ln.y + 3);
    });

    this.tickets.forEach(function (tk, i) {
      var ln = this.lanes[tk.lane];
      var speed = 0.55;
      var baseX = -160 + ((frame * speed + tk.offset) % 280);
      if (this.reroute > 0 && i === 1) {
        var altLane = this.lanes[0];
        var blend = this.reroute;
        var y = ln.y + (altLane.y - ln.y) * blend;
        drawRR(ctx, baseX - tk.w / 2, y - 8, tk.w, 16, 3, C.ticketAmber, C.amber);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(tk.label, baseX, y + 2);
      } else if (baseX < 165) {
        drawRR(ctx, baseX - tk.w / 2, ln.y - 8, tk.w, 16, 3, ln.color, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(tk.label, baseX, ln.y + 2);
      }
    }, this);

    if (prg >= 50 && prg < 115) {
      ctx.strokeStyle = C.railGlow;
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 4]);
      ctx.beginPath();
      ctx.moveTo(-30, 8);
      ctx.lineTo(40, -26);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  };

  /* Пульт смены — вместо WebsiteTerminal */
  function ShiftOrchestratorPanel() {
    this.planFact = 0.72;
  }
  ShiftOrchestratorPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    var px = 118, py = -72, pw = 108, ph = 130;
    drawRR(ctx, px, py, pw, ph, 10, C.panelBg, C.panelBorder);

    drawRR(ctx, px + 6, py + 6, pw - 12, 16, [5, 5, 0, 0], "rgba(121,242,255,0.15)", null);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Пульт смены", px + 10, py + 16);

    var pf = prg < 60 ? 0.72 + prg * 0.002 : prg < 175 ? 0.87 : 0.91;
    this.planFact = pf;
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("План/факт", px + 10, py + 34);
    drawRR(ctx, px + 10, py + 38, pw - 20, 8, 3, "rgba(255,255,255,0.08)", null);
    drawRR(ctx, px + 10, py + 38, (pw - 20) * pf, 8, 3, C.green, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "right";
    ctx.fillText(Math.round(pf * 100) + "%", px + pw - 10, py + 46);

    var downtimes = [
      { label: "Нет материала", on: prg >= 48 },
      { label: "Переналадка", on: prg >= 90 },
      { label: "Ожид. мастера", on: false }
    ];
    ctx.textAlign = "left";
    ctx.fillStyle = "#94a3b8";
    ctx.fillText("Простои", px + 10, py + 58);
    downtimes.forEach(function (d, i) {
      var dy = py + 66 + i * 14;
      ctx.fillStyle = d.on ? C.amber : "rgba(255,255,255,0.2)";
      ctx.beginPath();
      ctx.arc(px + 14, dy, 3, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = d.on ? "#fde68a" : "#64748b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText(d.label, px + 22, dy + 3);
    });

    if (prg >= 175) {
      drawRR(ctx, px + 8, py + 108, pw - 16, 14, 4, "rgba(34,197,94,0.2)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Отчёт → Telegram", px + pw / 2, py + 118);
    }
  };

  /* Маячок простоя на участке */
  function DowntimeBeacon() {
    this.angle = 0;
  }
  DowntimeBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    if (prg < 48 || prg > 170) return;
    var bx = -18, by = 0;
    this.angle += 0.08;
    var pulse = 0.5 + Math.sin(frame * 0.15) * 0.5;

    ctx.save();
    ctx.translate(bx, by);
    ctx.globalAlpha = 0.25 + pulse * 0.35;
    ctx.fillStyle = C.amber;
    ctx.beginPath();
    ctx.arc(0, 0, 18 + pulse * 6, 0, Math.PI * 2);
    ctx.fill();
    ctx.globalAlpha = 1;

    drawRR(ctx, -6, -14, 12, 20, 3, C.amber, C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("!", 0, 2);

    ctx.strokeStyle = C.amber;
    ctx.lineWidth = 2;
    for (var i = 0; i < 4; i++) {
      var a = this.angle + (Math.PI / 2) * i;
      ctx.beginPath();
      ctx.moveTo(Math.cos(a) * 10, Math.sin(a) * 10 - 4);
      ctx.lineTo(Math.cos(a) * 18, Math.sin(a) * 18 - 4);
      ctx.stroke();
    }
    ctx.restore();
  };

  /* Зона ожидания материала */
  function MaterialStagingBay() {
    this.crateCount = 3;
  }
  MaterialStagingBay.prototype.draw = function (ctx) {
    drawRR(ctx, -168, -58, 36, 28, 4, "rgba(30,41,59,0.7)", C.outline);
    for (var i = 0; i < this.crateCount; i++) {
      drawRR(ctx, -162 + i * 10, -52 + (i % 2) * 4, 10, 10, 2, C.ticketAmber, C.outline);
    }
    ctx.fillStyle = C.gold;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Материал", -166, -62);
    var prg = (frame * 0.042) % 230;
    if (prg >= 48 && prg < 115) {
      ctx.strokeStyle = "rgba(239,68,68,0.6)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([3, 3]);
      ctx.strokeRect(-170, -60, 40, 32);
      ctx.setLineDash([]);
    }
  };

  /* Полоса heatmap потерь */
  function LossHeatmapStrip() {
    this.segments = [0, 0, 0, 0, 0, 0, 0, 0];
  }
  LossHeatmapStrip.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    if (prg < 155) return;
    var fillPrg = Math.min(1, (prg - 155) / 40);
    var sx = -120, sy = 68, sw = 200, sh = 10;
    drawRR(ctx, sx, sy, sw, sh, 3, "rgba(255,255,255,0.06)", C.outline);
    var colors = [C.green, C.green, C.amber, C.amber, C.red, C.amber, C.green, C.green];
    var segW = sw / 8;
    for (var i = 0; i < 8; i++) {
      if (i / 8 > fillPrg) break;
      drawRR(ctx, sx + i * segW + 1, sy + 1, segW - 2, sh - 2, 2, colors[i], null);
    }
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Карта потерь", sx, sy - 4);
  };

  /* Пульс отчёта в Telegram */
  function TelegramReportPulse() {
    this.y = 0;
  }
  TelegramReportPulse.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    if (prg < 188 || prg > 225) return;
    var t = (prg - 188) / 37;
    this.y = -20 - t * 45;
    var alpha = prg < 210 ? t : 1 - (prg - 210) / 15;
    ctx.save();
    ctx.globalAlpha = alpha;
    drawRR(ctx, 95 + this.y * 0.1, -30 + this.y, 28, 18, 5, C.violet, C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TG", 109 + this.y * 0.1, -20 + this.y);
    ctx.strokeStyle = C.cyan;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.moveTo(70, 10);
    ctx.quadraticCurveTo(90, -10 + this.y, 109, -20 + this.y);
    ctx.stroke();
    ctx.restore();
  };

  /* Мостик диспетчера сверху */
  function DispatchWalkway() {
    this.wave = 0;
  }
  DispatchWalkway.prototype.draw = function (ctx) {
    drawRR(ctx, -175, -78, 350, 10, 4, "rgba(71,85,105,0.5)", C.outline);
    this.wave = Math.sin(frame * 0.04) * 2;
    ctx.strokeStyle = "rgba(121,242,255,0.2)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(-175, -73 + this.wave);
    for (var x = -175; x <= 175; x += 20) {
      ctx.lineTo(x, -73 + Math.sin((x + frame) * 0.05) * 1.5);
    }
    ctx.stroke();
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
    var prg = (frame * 0.042) % 230;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -140, y: -62 },
      "2_seo": { x: -20, y: -62 },
      "3_coder": { x: 50, y: -62 },
      "4_designer": { x: -20, y: 18 },
      "5_deployer": { x: 130, y: -55 }
    };
    var tgt = targets[this.role] || { x: this.baseX, y: this.baseY };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        faceDir = tgt.x > this.baseX ? 1 : -1;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
        if (this.role === "1_architect" || this.role === "3_coder") carryType = this.color;
      } else {
        this.x = tgt.x;
        this.y = tgt.y;
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = isMoving ? 0 : Math.sin(this.timer * 1.5) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";

    var legL = 0, legR = 0;
    if (isMoving) {
      var walkPhase = this.timer * 6;
      legL = Math.sin(walkPhase) * 4;
      legR = Math.sin(walkPhase + Math.PI) * 4;
    }
    ctx.fillStyle = "#0f172a";
    drawRR(ctx, -8, -3 + Math.max(0, legL), 7, 12, 2, "#0f172a", null);
    drawRR(ctx, 1, -3 + Math.max(0, legR), 7, 12, 2, "#0f172a", null);
    drawRR(ctx, -12, -10 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -22 - bob, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 1.5;
    ctx.strokeStyle = C.outline;
    ctx.stroke();

    if (carryType) {
      drawRR(ctx, -16 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new DispatchWalkway());
  entities.push(new MaterialStagingBay());
  entities.push(new TaskTicketRail());
  entities.push(new DowntimeBeacon());
  entities.push(new ShiftOrchestratorPanel());
  entities.push(new LossHeatmapStrip());
  entities.push(new TelegramReportPulse());

  entities.push(new Agent(-155, -48, C.agentYellow, "1_architect", 8, [
    "План смены готов!", "Заказы из 1С загружены", "Три участка в работе", "Приоритеты расставлены"
  ]));
  entities.push(new Agent(-95, -48, C.agentGreen, "2_seo", 52, [
    "Простой: нет материала!", "Код ожидания зафиксирован", "Эскалация мастеру", "Участок 2 стоит"
  ]));
  entities.push(new Agent(-35, -48, C.agentBlue, "3_coder", 98, [
    "AI: 2 варианта перестановки", "Пересчёт приоритетов...", "Human-in-the-loop", "План обновлён"
  ]));
  entities.push(new Agent(25, -48, C.agentPink, "4_designer", 128, [
    "Мастер подтвердил!", "Бригада переставлена", "Простой сокращён", "Ок — в работу"
  ]));
  entities.push(new Agent(85, -48, C.agentPurple, "5_deployer", 168, [
    "Отчёт в Telegram!", "Карта потерь готова", "Руководитель уведомлён", "Смена закрыта"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 260, maxLife: customLife || 260 });
  }

  function updatePhasePills(prg) {
    var phase = 0;
    if (prg >= 48) phase = 1;
    if (prg >= 98) phase = 2;
    if (prg >= 168) phase = 3;
    phasePills.forEach(function (el, i) {
      el.classList.toggle("is-active", parseInt(el.getAttribute("data-aipz-phase"), 10) === phase);
    });
  }

  function engineloop() {
    frame++;
    var prg = (frame * 0.042) % 230;
    updatePhasePills(prg);

    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    if (prg >= 6 && prg < 6.08) createBubble(-140, -75, "Смена стартовала", 200);
    if (prg >= 52 && prg < 52.08) createBubble(-18, -5, "Простой: нет материала", 200);
    if (prg >= 102 && prg < 102.08) createBubble(50, -70, "AI: перестановка?", 200);
    if (prg >= 192 && prg < 192.08) createBubble(130, -70, "Отчёт руководителю →", 200);

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
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bub.x - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, by - th / 2);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  document.fonts.ready.then(function () { engineloop(); });
});
</script>


<script>
(function(){
  'use strict';
  var root = document.querySelector('.aipz-page') || document.querySelector('.aipz-content');
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
