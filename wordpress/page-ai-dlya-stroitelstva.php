<?php
/**
 * Template Name: AI для строительства: заявки, сметы и контроль под ключ
 * Description: Внедрение AI-ассистента для строительной компании — квиз, бриф, предварительная смета, CRM.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для строительства: заявки, сметы и контроль под ключ';
$page_seo_description = 'Внедрим AI-ассистента для строительной компании: уточнение заявок, квиз-бриф и предварительная смета. Интеграция с CRM, кейсы, цены от 180 тыс. ₽. Собрать AI-квиз.';

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

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Написать в Telegram';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по AI';
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

.astr-content{
  --astr-bg:#050711;--astr-bg2:#080b17;
  --astr-text:#e6edf7;--astr-muted:#9aa8bd;--astr-soft:#c7d2e5;--astr-heading:#fff;
  --astr-border:rgba(255,255,255,.10);--astr-accent:#f59e0b;--astr-cyan:#79f2ff;
  --astr-green:#22c55e;--astr-violet:#8b5cf6;
  --astr-btn-from:#f59e0b;--astr-btn-to:#fde68a;
  --astr-container:1220px;--astr-r:18px;--astr-r-lg:24px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--astr-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.astr-content *,.astr-content *::before,.astr-content *::after{box-sizing:border-box;}
.astr-content a{color:inherit;}
.astr-content p{color:var(--astr-muted);line-height:1.72;margin:0 0 1em;}
.astr-content p:last-child{margin-bottom:0;}
.astr-content h2,.astr-content h3,.astr-content h4{color:var(--astr-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.astr-content strong{color:var(--astr-soft);}
.astr-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.astr-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--astr-muted);font-size:14.5px;line-height:1.65;}
.astr-content ul li::before{content:'›';position:absolute;left:0;color:var(--astr-accent);font-weight:700;}
.astr-cnt{width:min(var(--astr-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.astr-section,.nero-ai-section.astr-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.astr-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.astr-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.astr-sh.astr-left{margin-left:0;text-align:left;}
.astr-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.astr-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.astr-sh.astr-left p{margin-left:0;}
.astr-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--astr-accent);margin-bottom:14px;}
.astr-def{background:rgba(255,255,255,.04);border-left:3px solid var(--astr-cyan);padding:16px 20px;border-radius:0 12px 12px 0;margin:20px 0;font-size:14.5px;}
.astr-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.astr-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.astr-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.astr-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--astr-accent),var(--astr-cyan));}
.astr-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--astr-muted);margin-bottom:1em;}
.astr-intro-text p:last-child{margin-bottom:0;color:var(--astr-soft);}
.astr-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.astr-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.astr-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--astr-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.astr-kpi-card .kl{font-size:11px;font-weight:600;color:var(--astr-muted);line-height:1.4;}
.astr-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.astr-intro-grid{grid-template-columns:1fr;gap:36px;}.astr-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.astr-intro-kpi{grid-template-columns:1fr 1fr;}}
.astr-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.astr-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.astr-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid var(--astr-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--astr-muted);text-decoration:none;transition:border-color .2s,color .2s,background .2s;}
.astr-toc a:hover{border-color:rgba(245,158,11,.42);color:var(--astr-accent);background:rgba(245,158,11,.08);}
.astr-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--astr-border);border-radius:var(--astr-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);}
.astr-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.astr-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.astr-grid-2,.astr-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.astr-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.astr-grid-3{grid-template-columns:1fr;}}
.astr-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--astr-r);padding:26px;margin-bottom:14px;}
.astr-scenario:last-child{margin-bottom:0;}
.astr-scenario h3{font-size:17px;margin-bottom:8px;}
.astr-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.astr-table{width:100%;border-collapse:collapse;font-size:14px;}
.astr-table th{padding:13px 16px;text-align:left;background:rgba(245,158,11,.1);color:var(--astr-accent);font-weight:700;border-bottom:1px solid rgba(245,158,11,.25);white-space:nowrap;}
.astr-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--astr-text);vertical-align:top;}
.astr-table tr:last-child td{border-bottom:none;}
.astr-table tr:hover td{background:rgba(255,255,255,.03);}
.astr-compare-table th:nth-child(3){background:rgba(34,197,94,.12);color:var(--astr-green);}
.astr-compare-table td:nth-child(3){color:#bbf7d0;}
.astr-flow-diagram{background:#0a0e1c;border:1px solid rgba(121,242,255,.15);border-radius:14px;padding:24px 28px;margin:24px 0;font-family:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace;font-size:13px;line-height:1.7;color:var(--astr-cyan);overflow-x:auto;white-space:pre;}
.astr-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;}
@media(max-width:768px){.astr-case-grid{grid-template-columns:1fr;}}
.astr-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:22px;}
.astr-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--astr-green);margin-bottom:10px;}
.astr-price-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.astr-price-grid{grid-template-columns:1fr;}}
.astr-price-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:28px;text-align:center;}
.astr-price-card.featured{border-color:rgba(245,158,11,.4);background:linear-gradient(180deg,rgba(245,158,11,.1),rgba(255,255,255,.04));}
.astr-price-card h3{font-size:18px;margin-bottom:8px;}
.astr-price-card .price{font-size:28px;font-weight:900;color:var(--astr-accent);margin:12px 0;}
.astr-timeline{position:relative;padding-left:40px;}
.astr-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--astr-accent),var(--astr-cyan));opacity:.35;}
.astr-tl-item{position:relative;margin-bottom:32px;}
.astr-tl-item:last-child{margin-bottom:0;}
.astr-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--astr-accent);box-shadow:0 0 0 4px rgba(245,158,11,.2);}
.astr-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.astr-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.astr-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--astr-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.astr-faq-q::after{content:'▾';font-size:13px;color:var(--astr-accent);flex-shrink:0;transition:transform .25s;}
.astr-faq-item.open .astr-faq-q::after{transform:rotate(180deg);}
.astr-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--astr-muted);line-height:1.72;}
.astr-faq-item.open .astr-faq-a{max-height:800px;padding:0 24px 20px;}
.astr-kviz-demo{background:rgba(255,255,255,.04);border:1px solid rgba(245,158,11,.2);border-radius:20px;padding:32px;margin-top:24px;}
.astr-kviz-steps{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px;}
.astr-kviz-step{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;border:1px solid rgba(255,255,255,.12);color:var(--astr-muted);}
.astr-kviz-step.active{background:rgba(245,158,11,.15);border-color:rgba(245,158,11,.35);color:var(--astr-accent);}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,158,11,.12),rgba(139,92,246,.1));border:1px solid rgba(245,158,11,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,158,11,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--astr-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--astr-btn-from),var(--astr-btn-to));color:#1a1200!important;box-shadow:0 8px 32px rgba(245,158,11,.25);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--astr-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--astr-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-stroitelstva-page astr-page" role="main" tabindex="-1">

<section class="nero-ai-hero astr-hero-stroy" id="hero" aria-labelledby="astr-hero-stroy-title">
<style>
/* ── Hero ai-dlya-stroitelstva: самодостаточные стили (без CSS темы) ── */
.astr-hero-stroy {
  --astr-bg: #050711;
  --astr-accent: #79f2ff;
  --astr-warm: #f59e0b;
  --astr-green: #22c55e;
  --astr-text: #e6edf7;
  --astr-muted: #9aa8bd;
  --astr-soft: #c7d2e5;
  --astr-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: var(--astr-bg);
}
.astr-hero-stroy::before {
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
.astr-hero-stroy::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 158, 11, .12), transparent 66%);
  filter: blur(8px);
  animation: astrStroyGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes astrStroyGlow {
  from { opacity: .35; transform: scale(.95); }
  to { opacity: .78; transform: scale(1.05); }
}
.astr-hero-stroy .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.astr-hero-stroy .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.astr-hero-stroy .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.astr-hero-stroy .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--astr-warm) 38%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.astr-hero-stroy .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 158, 11, 0.22);
  border-radius: 999px;
  background: rgba(245, 158, 11, 0.08);
  color: var(--astr-warm) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.astr-hero-stroy .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--astr-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.astr-hero-stroy .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.astr-hero-stroy .nero-ai-badge {
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
.astr-hero-stroy .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.astr-hero-stroy .nero-ai-btn {
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
.astr-hero-stroy .nero-ai-btn:hover { transform: translateY(-2px); }
.astr-hero-stroy .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--astr-warm), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 158, 11, 0.22);
}
.astr-hero-stroy .nero-ai-btn-secondary {
  color: var(--astr-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.astr-hero-stroy .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--astr-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.astr-hero-stroy .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.astr-hero-stroy .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.astr-hero-stroy .nero-ai-dots { display: flex; gap: 7px; }
.astr-hero-stroy .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.astr-hero-stroy .nero-ai-dot:nth-child(1) { background: #fb7185; }
.astr-hero-stroy .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.astr-hero-stroy .nero-ai-dot:nth-child(3) { background: #34d399; }
.astr-hero-stroy .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.astr-hero-stroy .nero-ai-window-body { padding: 16px; }
.astr-hero-stroy .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.astr-hero-stroy .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.astr-hero-stroy .nero-ai-live-pill {
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
.astr-hero-stroy .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: astrStroyPulse 1.6s infinite;
}
@keyframes astrStroyPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.astr-hero-stroy .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.astr-hero-stroy .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.astr-hero-stroy .nero-ai-metric span {
  display: block;
  color: var(--astr-muted);
  font-size: 11px;
  font-weight: 700;
}
.astr-hero-stroy .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.astr-hero-stroy .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.astr-hero-stroy .astr-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(245, 158, 11, 0.16);
  background: radial-gradient(ellipse at 30% 45%, rgba(245,158,11,.07), rgba(6,10,24,.92) 72%);
}
.astr-hero-stroy #astr-stroy-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.astr-hero-stroy .nero-ai-task-stream { display: grid; gap: 8px; }
.astr-hero-stroy .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.astr-hero-stroy .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(245,158,11,.12);
  color: var(--astr-warm);
  font-size: 11px;
  font-weight: 800;
}
.astr-hero-stroy .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.astr-hero-stroy .nero-ai-task span {
  color: var(--astr-muted);
  font-size: 11px;
}
.astr-hero-stroy .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.astr-hero-stroy .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.astr-hero-stroy .nero-ai-status--cyan {
  background: rgba(121,242,255,.10);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .astr-hero-stroy .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .astr-hero-stroy .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .astr-hero-stroy .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .astr-hero-stroy .nero-ai-window-body { padding: 12px; }
  .astr-hero-stroy .nero-ai-task { grid-template-columns: 28px 1fr; }
  .astr-hero-stroy .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Строительство · AI под ключ</p>
      <h1 id="astr-hero-stroy-title">AI для строительства: ассистент <span class="nero-ai-gradient-text">заявок, смет и контроля</span> под ключ</h1>
      <p class="nero-ai-hero-lead">AI уточняет заявку, собирает вводные через квиз и готовит предварительную смету — внедрим под ключ для вашей строительной компании</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">AI-квиз</li>
        <li class="nero-ai-badge">Предварительная смета</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">Контроль объектов</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="#kviz">Собрать AI-квиз</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-обработки заявок строительной компании">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Заявка → квиз → смета → CRM</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Заявок сегодня</span>
              <strong>47</strong>
              <small>сайт, Авито, Telegram</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время сметы</span>
              <strong>4 мин</strong>
              <small>вместо 2–4 часов</small>
            </div>
            <div class="nero-ai-metric">
              <span>Лидов в CRM</span>
              <strong>12</strong>
              <small>amoCRM / Битрикс24</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ответ</span>
              <strong>24/7</strong>
              <small>без потери ночных лидов</small>
            </div>
          </div>

          <div class="astr-dash-canvas-wrap" aria-hidden="false">
            <canvas id="astr-stroy-hero-canvas" role="img" aria-label="Анимация: заявка проходит квиз, AI формирует предварительную смету и передаёт лид в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий воронки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">1</span>
              <div><strong>Заявка с сайта — капитальный ремонт</strong><span>Квиз запущен · 68 м² · вторичка</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">квиз</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">2</span>
              <div><strong>Бриф собран — 8 из 12 полей</strong><span>Площадь, зоны, сроки, бюджет</span></div>
              <span class="nero-ai-status nero-ai-status--amber">бриф</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">3</span>
              <div><strong>Предварительная смета</strong><span>Вилка 1,2–1,6 млн ₽ · дисклеймер</span></div>
              <span class="nero-ai-status">смета</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">4</span>
              <div><strong>Карточка лида → amoCRM</strong><span>Замер на субботу · статус «требует проверки»</span></div>
              <span class="nero-ai-status">CRM</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * astr-stroy-hero-engine — «Диспетчерская брифов и смет»
 * Мир: рельсы заявок → планшет квиза → чертёж сметы → портал CRM
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("astr-stroy-hero-canvas");
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
    rail: "#475569",
    railGlow: "rgba(245,158,11,0.35)",
    leadCard: "#fef3c7",
    leadBlue: "#dbeafe",
    leadGreen: "#d1fae5",
    hubBase: "#1e293b",
    warm: "#f59e0b",
    cyan: "#79f2ff",
    green: "#22c55e",
    gridLine: "rgba(121,242,255,0.18)",
    priceChip: "#fde68a",
    stampOrange: "rgba(245,158,11,0.9)",
    crmPurple: "#8b5cf6",
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

  function drawLeadCard(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 2);
  }

  /* Горизонтальные рельсы заявок — вместо Conveyor */
  function LeadPipelineRails() {
    this.cards = [
      { offset: 0, color: C.leadCard, label: "Заявка" },
      { offset: 90, color: C.leadBlue, label: "Квиз" },
      { offset: 180, color: C.leadGreen, label: "Бриф" }
    ];
  }
  LeadPipelineRails.prototype.draw = function (ctx) {
    var y = 42;
    ctx.strokeStyle = C.rail;
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.moveTo(-175, y);
    ctx.lineTo(175, y);
    ctx.stroke();
    for (var i = -160; i < 180; i += 28) {
      ctx.fillStyle = C.railGlow;
      ctx.fillRect(i, y - 2, 8, 4);
    }
    this.cards.forEach(function (c) {
      var t = ((frame * 0.42 + c.offset) % 140) / 140;
      var x = -165 + t * 330;
      if (t < 0.88) drawLeadCard(ctx, x, y - 18, 22, 16, c.color, c.label);
    });
  };

  /* Планшет квиза — уникальный объект */
  function QuizTabletStation() {
    this.step = 0;
  }
  QuizTabletStation.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    drawRR(ctx, -155, -55, 52, 68, 6, "rgba(30,41,59,0.7)", C.outline);
    drawRR(ctx, -148, -48, 38, 50, 4, "#0f172a", C.warm);
    if (prg >= 25 && prg < 120) {
      var q = Math.min(4, Math.floor((prg - 25) / 20));
      for (var i = 0; i <= q; i++) {
        drawRR(ctx, -142, -40 + i * 10, 26, 6, 2, i === q ? C.warm : "rgba(255,255,255,0.15)", null);
      }
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Квиз " + (q + 1) + "/4", -142, -52);
    }
  };

  /* Полка RAG-прайса */
  function PriceRagShelf() {
    this.glow = 0;
  }
  PriceRagShelf.prototype.draw = function (ctx) {
    drawRR(ctx, -178, 8, 36, 48, 4, "rgba(71,85,105,0.5)", C.outline);
    var books = [C.leadCard, C.leadBlue, C.priceChip];
    books.forEach(function (col, i) {
      drawRR(ctx, -172, 14 + i * 12, 24, 8, 2, col, C.outline);
    });
    var prg = (frame * 0.04) % 260;
    if (prg >= 100 && prg < 160) {
      this.glow = Math.sin(frame * 0.1) * 0.3 + 0.5;
      ctx.globalAlpha = this.glow;
      ctx.fillStyle = C.warm;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("RAG", -172, 8);
      ctx.globalAlpha = 1;
    }
  };

  /* Маяк замера объекта */
  function SiteMeasureBeacon() {
    this.pulse = 0;
  }
  SiteMeasureBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    if (prg < 80 || prg > 200) return;
    this.pulse = Math.sin(frame * 0.15) * 3;
    ctx.strokeStyle = "rgba(121,242,255,0.5)";
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.arc(-120, -20, 12 + this.pulse, 0, Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("м²", -120, -18);
  };

  /* Центральный хаб — чертёж сметы, вместо WebsiteTerminal */
  function EstimateBlueprintHub() {
    this.rows = 0;
    this.priceVisible = false;
  }
  EstimateBlueprintHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    drawRR(ctx, -35, -72, 130, 155, 10, C.hubBase, C.outline);

    /* Сетка чертежа */
    ctx.strokeStyle = C.gridLine;
    ctx.lineWidth = 0.8;
    for (var gx = -28; gx < 88; gx += 14) {
      ctx.beginPath(); ctx.moveTo(gx, -62); ctx.lineTo(gx, 70); ctx.stroke();
    }
    for (var gy = -55; gy < 65; gy += 14) {
      ctx.beginPath(); ctx.moveTo(-28, gy); ctx.lineTo(88, gy); ctx.stroke();
    }

    /* Фаза BRIEF: контур объекта */
    if (prg >= 70) {
      ctx.strokeStyle = C.cyan;
      ctx.lineWidth = 2;
      ctx.strokeRect(-18, -48, 56, 40);
      ctx.fillStyle = "rgba(121,242,255,0.12)";
      ctx.fillRect(-18, -48, 56, 40);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("68 м²", 10, -25);
    }

    /* Фаза ESTIMATE: строки сметы */
    if (prg >= 130) {
      var rows = Math.min(4, Math.floor((prg - 130) / 12));
      this.rows = rows;
      for (var r = 0; r < rows; r++) {
        drawRR(ctx, -22, -5 + r * 14, 74, 10, 2, "rgba(255,255,255,0.08)", null);
        ctx.fillStyle = "#cbd5e1";
        ctx.fillRect(-18, -1 + r * 14, 30 + r * 8, 3);
      }
    }

    /* Вилка цены */
    if (prg >= 165 && prg < 210) {
      var pop = Math.min(1, (prg - 165) / 15);
      ctx.globalAlpha = pop;
      drawRR(ctx, -20, 48, 90, 18, 4, "rgba(245,158,11,0.25)", C.warm);
      ctx.fillStyle = C.warm;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("1,2–1,6 млн ₽", 25, 60);
      ctx.globalAlpha = 1;
    }

    /* Штамп предварительной сметы — финал вместо ракеты */
    if (prg >= 210) {
      var stampPrg = Math.min(1, (prg - 210) / 16);
      ctx.save();
      ctx.translate(55, 15);
      ctx.rotate(-0.12 * stampPrg);
      ctx.globalAlpha = stampPrg;
      ctx.strokeStyle = C.stampOrange;
      ctx.lineWidth = 2;
      ctx.strokeRect(-32, -10, 64, 22);
      ctx.fillStyle = C.stampOrange;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ПРЕДВ. СМЕТА", 0, 4);
      ctx.restore();
    }
  };

  /* Портал CRM — карточка лида */
  function CrmLeadPortal() {
    this.synced = false;
  }
  CrmLeadPortal.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 260;
    drawRR(ctx, 108, -58, 58, 78, 8, "rgba(139,92,246,0.15)", C.crmPurple);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("amoCRM", 137, -48);

    if (prg >= 220) {
      this.synced = true;
      drawRR(ctx, 114, -35, 46, 50, 5, "rgba(255,255,255,0.08)", C.outline);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Лид #847", 118, -22);
      ctx.fillText("Замер: сб", 118, -10);
      ctx.fillStyle = C.green;
      ctx.fillText("✓ CRM", 118, 2);

      /* Луч синхронизации */
      var beamAlpha = Math.min(1, (prg - 220) / 12);
      ctx.strokeStyle = "rgba(139,92,246," + (beamAlpha * 0.7) + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 3]);
      ctx.beginPath();
      ctx.moveTo(55, 20);
      ctx.lineTo(108, -10);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  };

  /* Волна этапов стройки по сетке */
  function PhaseProgressBeam() {
    this.wave = 0;
  }
  PhaseProgressBeam.prototype.draw = function (ctx) {
    this.wave = (frame * 0.06) % 40;
    ctx.strokeStyle = "rgba(245,158,11,0.25)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(-170, -75 + this.wave * 0.3);
    ctx.lineTo(170, -75 + this.wave * 0.3);
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
    var prg = (frame * 0.04) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    /* Агенты идут к станциям по дуге вокруг хаба — иная геометрия */
    var stationTargets = {
      "1_architect": { x: -125, y: -15 },
      "2_seo": { x: -55, y: 25 },
      "3_coder": { x: 5, y: 30 },
      "4_designer": { x: 45, y: 25 },
      "5_deployer": { x: 125, y: -5 }
    };
    var tgt = stationTargets[this.role] || { x: 0, y: 20 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 26) {
      var local = prg - this.stepTrig;
      if (local < 13) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 13);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 13);
      } else if (local < 18) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 18) / 8);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 18) / 8);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 12 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
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

    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(3, -24 - bob, 3, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(-3, -24 - bob, 3, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(4, -24 - bob, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(-2, -24 - bob, 1.5, 0, Math.PI * 2); ctx.fill();

    if (this.role === "1_architect") {
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1;
      ctx.strokeRect(0, -28 - bob, 5, 5);
    } else if (this.role === "3_coder") {
      ctx.fillStyle = C.warm;
      ctx.fillRect(-6, -30 - bob, 12, 4);
    } else if (this.role === "5_deployer") {
      ctx.strokeStyle = C.crmPurple; ctx.lineWidth = 1.5;
      ctx.strokeRect(-5, -30 - bob, 10, 6);
    }
    ctx.restore();

    if (carryType) {
      drawRR(ctx, -14 * faceDir, -18 - bob, 12, 12, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new PhaseProgressBeam());
  entities.push(new LeadPipelineRails());
  entities.push(new QuizTabletStation());
  entities.push(new PriceRagShelf());
  entities.push(new SiteMeasureBeacon());
  entities.push(new EstimateBlueprintHub());
  entities.push(new CrmLeadPortal());

  entities.push(new Agent(-165, 75, C.agentYellow, "1_architect", 20, [
    "Заявка с сайта!",
    "Какая площадь объекта?",
    "Запускаю квиз…"
  ]));
  entities.push(new Agent(-95, 88, C.agentGreen, "2_seo", 55, [
    "Капиталка или косметика?",
    "Сроки и бюджет?",
    "Бриф на 80%"
  ]));
  entities.push(new Agent(-25, 82, C.agentBlue, "3_coder", 95, [
    "Подставляю расценки",
    "RAG: прайс 2026",
    "Считаю вилку…"
  ]));
  entities.push(new Agent(40, 88, C.agentPink, "4_designer", 135, [
    "Строки сметы готовы",
    "Дисклеймер добавлен",
    "PDF сформирован"
  ]));
  entities.push(new Agent(110, 78, C.agentPurple, "5_deployer", 175, [
    "Лид в amoCRM!",
    "Замер на субботу",
    "Менеджер уведомлён"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.04) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-155, -70, "Заявка с сайта", 220);
    if (prg >= 58 && prg < 58.05) createBubble(-55, 5, "Квиз: 8 из 12", 220);
    if (prg >= 98 && prg < 98.05) createBubble(5, 10, "Бриф собран", 220);
    if (prg >= 148 && prg < 148.05) createBubble(30, -30, "Смета: предварительная", 220);
    if (prg >= 198 && prg < 198.05) createBubble(125, -40, "CRM: карточка лида", 220);

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
    requestAnimationFrame(engineLoop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineLoop);
  } else {
    engineLoop();
  }
});
</script>


<div class="astr-content">

  <section class="astr-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="astr-cnt">
      <div class="astr-intro-grid nero-ai-reveal">
        <div class="astr-intro-text">
          <p class="astr-eyebrow">Лонгрид · AI для строительства</p>
          <p><strong>Коротко:</strong> AI для строительства в 2026 году — это не робот на стройплощадке, а связка квиза на сайте, диалогового ассистента с базой расценок компании и интеграций с CRM. Nero Network внедряет такой контур под ключ: от уточнения заявки до предварительной сметы и контроля объекта.</p>
          <p>Ремонтные и строительные компании с оборотом 3–50 млн ₽/мес теряют лиды на этапе «заявка → смета». Связка <strong>квиз + AI + CRM</strong> сокращает цикл с часов до минут — финальный расчёт остаётся за сметчиком.</p>
        </div>
        <div class="astr-intro-kpi" aria-label="Ключевые метрики воронки">
          <div class="astr-kpi-card"><div class="kv">22%</div><div class="kl">строительных компаний уже используют ИИ</div><div class="ks">Минстрой / Yandex Cloud</div></div>
          <div class="astr-kpi-card"><div class="kv">56%</div><div class="kl">хотят ИИ-агентов для офисной рутины</div><div class="ks">Сбер, май 2026</div></div>
          <div class="astr-kpi-card"><div class="kv">3 ч</div><div class="kl">ручная смета на объект</div><div class="ks">до автоматизации</div></div>
          <div class="astr-kpi-card"><div class="kv">5 мин</div><div class="kl">предварительная вилка с AI</div><div class="ks">типовой объект</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="astr-toc-outer">
    <div class="astr-cnt">
      <nav class="astr-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#integracii">Интеграции</a>
        <a href="#kontrol">Контроль</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#etapy">Внедрение</a>
        <a href="#faq">FAQ</a>
        <a href="#kviz">AI-квиз</a>
      </nav>
    </div>
  </div>

  <section class="astr-section" id="zachem">
    <div class="astr-cnt">
      <div class="astr-sh astr-left nero-ai-reveal">
        <span class="astr-eyebrow">Боль и решение</span>
        <h2>Зачем строительной компании AI-ассистент</h2>
      </div>

      <div class="astr-def nero-ai-reveal"><strong>AI-ассистент для строительной компании</strong> — программный модуль на базе LLM, который ведёт диалог с клиентом, собирает бриф, считает предварительную смету по прайсу компании и передаёт структурированную карточку лида в CRM. Человек проверяет расчёт после замера.</div>

      <div class="astr-grid-2 nero-ai-reveal">
        <div class="astr-card">
          <h3>Боль: заявки без уточнений и долгие сметы</h3>
          <ul>
            <li><strong>Заявка приходит неполной</strong> — менеджер тратит 15–40 минут на уточнения</li>
            <li><strong>Предварительная смета готовится часами</strong> — сметчик вручную тратит 2,5–3 часа (<a href="https://simplysmeta.ru/" target="_blank" rel="noopener noreferrer">ПРОСТОСМЕТА</a>)</li>
            <li><strong>Заявки теряются вне рабочего времени</strong> — ночью и в сезон лиды остывают</li>
          </ul>
        </div>
        <div class="astr-card nero-ai-delay-1">
          <h3>Что меняется после внедрения AI</h3>
          <div class="astr-table-wrap">
            <table class="astr-table astr-compare-table">
              <thead><tr><th>Показатель</th><th>Ручной процесс</th><th>С AI-ассистентом</th></tr></thead>
              <tbody>
                <tr><td>Время первого ответа</td><td>2–24 часа</td><td>1–3 минуты, 24/7</td></tr>
                <tr><td>Время предварительной сметы</td><td>2–4 часа</td><td>3–10 минут</td></tr>
                <tr><td>Полнота брифа</td><td>30–50%</td><td>80–95%</td></tr>
                <tr><td>Ночные заявки</td><td>Потеря</td><td>Автоквалификация</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;">По опросу Сбера (май 2026) <strong>56%</strong> российских организаций хотят ИИ-агентов для офисной рутины; составление смет — <strong>6-е место</strong> среди приоритетов (<a href="https://www.cnews.ru/news/line/2026-05-29_56_rossijskih_kompanij_hotyat" target="_blank" rel="noopener noreferrer">CNews</a>). Минстрой: <strong>22%</strong> строительных компаний уже используют ИИ (<a href="https://yandex.cloud/ru/blog/posts/2025/04/technologies-in-construction" target="_blank" rel="noopener noreferrer">Yandex Cloud</a>).</p>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="kak-rabotaet">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Воронка</span>
        <h2>Как работает AI-квиз: от заявки до предварительной сметы</h2>
        <p>Три узла: уточнение заявки → сбор брифа → предварительная смета и передача менеджеру.</p>
      </div>

      <div class="astr-def nero-ai-reveal"><strong>AI-квиз для строительства</strong> — многошаговая форма (7–12 шагов), где каждый ответ запускает уточняющие вопросы, а на выходе система формирует бриф и предварительную вилку стоимости по прайсу компании.</div>

      <div class="astr-grid-3 nero-ai-reveal">
        <div class="astr-scenario">
          <h3>Уточнение заявки на сайте</h3>
          <p>AI задаёт структурированные вопросы: тип объекта, площадь, состояние, тип работ, зоны, сроки, бюджет, контакт. October Group: «ИИ-боты эволюционируют от FAQ к <strong>первой линии продаж</strong>».</p>
        </div>
        <div class="astr-scenario nero-ai-delay-1">
          <h3>Сбор брифа через квиз</h3>
          <p>Квиз работает по веткам: косметика, капиталка, дом под ключ — разные сценарии. Стартап «Пазл Дом» (ИТМО): смета за ~6,5 секунды, 3000+ пользователей.</p>
        </div>
        <div class="astr-scenario nero-ai-delay-2">
          <h3>Предварительная смета и CRM</h3>
          <p>RAG-база из прайса → вилка «от — до» → PDF «Предварительное КП» → карточка в amoCRM/Битрикс24. Сметчик верифицирует после замера за 15–30 минут.</p>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:16px;text-align:center;font-size:13px;color:#64748b;"><strong>Важно:</strong> AI-смета — коммерческое предложение, не официальный расчёт по ГЭСН/ФЕР. Документы к договору подписывает аттестованный сметчик.</p>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-kviz">
        <div class="ym-cta-block__icon" aria-hidden="true">🏗️</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите AI-квиз с предварительной сметой для вашей компании?</p>
          <p class="ym-cta-block__sub">Разберём ваши заявки, прайс и воронку CRM — покажем, как квиз уточняет бриф и считает вилку стоимости за минуты. Бесплатная консультация, без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section
  id="ai-dlya-stroitelstva-boris-block"
  class="nero-ai-section astr-section bst-root"
  aria-label="Анимация: AI-квиз уточняет заявку и формирует предварительную смету для строительной компании"
>
<style>
/* === БОРИС: prefix bst-, scoped внутри #ai-dlya-stroitelstva-boris-block === */
#ai-dlya-stroitelstva-boris-block.bst-root{
  padding:56px 0 64px;
  background:linear-gradient(180deg,rgba(5,7,17,0) 0%,rgba(8,11,23,.6) 50%,rgba(5,7,17,0) 100%);
}
#ai-dlya-stroitelstva-boris-block .bst-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-dlya-stroitelstva-boris-block .bst-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:rgba(255,255,255,.04);
  border:1px solid rgba(255,255,255,.10);
  box-shadow:0 24px 64px rgba(0,0,0,.35),0 0 0 1px rgba(121,242,255,.06);
  min-height:500px;
  backdrop-filter:blur(12px);
  -webkit-backdrop-filter:blur(12px);
}
@media(max-width:1023px){
  #ai-dlya-stroitelstva-boris-block .bst-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-dlya-stroitelstva-boris-block .bst-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid rgba(255,255,255,.08);
  background:rgba(8,11,23,.55);
}
@media(max-width:1023px){
  #ai-dlya-stroitelstva-boris-block .bst-lft{
    border-right:none;
    border-bottom:1px solid rgba(255,255,255,.08);
    padding:32px 24px;
  }
}
#ai-dlya-stroitelstva-boris-block .bst-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#f59e0b;
  margin:0 0 14px;
}
#ai-dlya-stroitelstva-boris-block .bst-ey::before{
  content:'';
  width:18px;height:2px;
  background:#f59e0b;
  border-radius:1px;
}
#ai-dlya-stroitelstva-boris-block .bst-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#fff;
  line-height:1.28;
  margin:0 0 18px;
  letter-spacing:-.03em;
}
#ai-dlya-stroitelstva-boris-block .bst-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-dlya-stroitelstva-boris-block .bst-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#9aa8bd;
}
#ai-dlya-stroitelstva-boris-block .bst-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(245,158,11,.12);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#f59e0b;
  margin-top:1px;
  font-style:normal;
}
#ai-dlya-stroitelstva-boris-block .bst-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-dlya-stroitelstva-boris-block .bst-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-dlya-stroitelstva-boris-block .bst-pl-g{
  background:rgba(34,197,94,.10);
  color:#4ade80;
  border:1.5px solid rgba(34,197,94,.25);
}
#ai-dlya-stroitelstva-boris-block .bst-pl-w{
  background:rgba(245,158,11,.10);
  color:#fbbf24;
  border:1.5px solid rgba(245,158,11,.25);
}
#ai-dlya-stroitelstva-boris-block .bst-pl-c{
  background:rgba(121,242,255,.08);
  color:#79f2ff;
  border:1.5px solid rgba(121,242,255,.22);
}
#ai-dlya-stroitelstva-boris-block .bst-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-dlya-stroitelstva-boris-block .bst-rgt{
  position:relative;
  background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-dlya-stroitelstva-boris-block .bst-rgt{min-height:380px;}
}
#bst-quiz-estimate-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bst-cnt">
  <div class="bst-card">

    <div class="bst-lft">
      <span class="bst-ey">Квиз · смета · CRM</span>
      <h3 class="bst-h3">7 вопросов — и клиент видит вилку стоимости, пока менеджер ещё на объекте</h3>
      <ul class="bst-ul">
        <li><span class="bst-ic">1</span>Клиент выбирает тип объекта, площадь и перечень работ — AI ветвит сценарий</li>
        <li><span class="bst-ic">2</span>RAG подставляет расценки из вашего прайса, не из чужого SaaS-калькулятора</li>
        <li><span class="bst-ic">3</span>Предварительная смета с дисклеймером — PDF за минуты, не за часы</li>
        <li><span class="bst-ic">✓</span>Карточка лида в amoCRM: бриф, вилка, статус «требует проверки сметчиком»</li>
      </ul>
      <div class="bst-pills">
        <span class="bst-pl bst-pl-w">3 ч → 5 мин</span>
        <span class="bst-pl bst-pl-g">80–95% брифа</span>
        <span class="bst-pl bst-pl-c">24/7 квиз</span>
      </div>
      <p class="bst-foot">Дальше — сценарии AI для ремонта, ИЖС и подрядных работ →</p>
    </div>

    <div class="bst-rgt">
      <canvas
        id="bst-quiz-estimate-canvas"
        aria-label="Анимация: клиент проходит AI-квиз, система считает предварительную смету и создаёт лид в CRM"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bst-quiz-estimate-canvas');
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
    ink:'#e2e8f0',
    muted:'rgba(226,232,240,.45)',
    card:'rgba(255,255,255,.06)',
    cardBdr:'rgba(255,255,255,.12)',
    warm:'#f59e0b',
    warmD:'rgba(245,158,11,.18)',
    cyan:'#79f2ff',
    cyanD:'rgba(121,242,255,.15)',
    green:'#22c55e',
    greenD:'rgba(34,197,94,.15)',
    viol:'#a78bfa',
    violD:'rgba(167,139,250,.18)',
    line:'rgba(255,255,255,.08)',
    paper:'#f8fafc',
    paperBdr:'#cbd5e1',
    crm:'#3b82f6'
  };

  var STEPS = [
    {q:'Тип объекта?', a:'Квартира 68 м²'},
    {q:'Вид работ?', a:'Капитальный ремонт'},
    {q:'Зоны?', a:'Кухня + 2 с/у'},
    {q:'Сроки?', a:'Старт через 2 нед.'}
  ];

  var LOOP = 680;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawTopBar(){
    ctx.fillStyle=C.ink;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('AI-квиз · строительство',14,22);
    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='right';
    ctx.fillText('шаг 4 из 7',W-14,22);
    ctx.strokeStyle=C.line;ctx.lineWidth=1;
    ctx.beginPath();ctx.moveTo(0,32);ctx.lineTo(W,32);ctx.stroke();
  }

  function drawProgressBar(y,w,prog){
    var barW=Math.min(w-28,W-28);
    var x=(W-barW)/2;
    rr(x,y,barW,5,3,'rgba(255,255,255,.06)',null,0);
    rr(x,y,barW*prog,5,3,C.warm,null,0);
    for(var i=0;i<7;i++){
      var dotX=x+(barW/6)*i;
      var filled=i/6<=prog;
      ctx.beginPath();
      ctx.arc(dotX,y+2.5,filled?4:3,0,Math.PI*2);
      ctx.fillStyle=filled?C.warm:'rgba(255,255,255,.15)';
      ctx.fill();
    }
  }

  function drawQuizPanel(x,y,w,h,t){
    rr(x,y,w,h,12,C.card,C.cardBdr,1.5);
    ctx.fillStyle=C.cyan;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Диалог с клиентом',x+12,y+18);

    var stepIdx=Math.min(3,Math.floor(t/90));
    var stepProg=(t%90)/90;
    var chatY=y+30;
    var bubbleH=32;

    for(var i=0;i<=stepIdx&&i<STEPS.length;i++){
      var alpha=i<stepIdx?1:Math.min(1,stepProg*2);
      var sy=chatY+i*(bubbleH+8);

      ctx.globalAlpha=alpha*0.85;
      rr(x+10,sy,w-20,22,8,'rgba(121,242,255,.08)',C.cyanD,1);
      ctx.fillStyle=C.cyan;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(STEPS[i].q,x+18,sy+14);
      ctx.globalAlpha=alpha;

      if(i<stepIdx||(i===stepIdx&&stepProg>0.4)){
        var aAlpha=i<stepIdx?1:Math.min(1,(stepProg-0.4)/0.4);
        ctx.globalAlpha=aAlpha*0.9;
        rr(x+24,sy+26,w-34,22,8,C.warmD,C.warm,1);
        ctx.fillStyle=C.warm;
        ctx.font='bold 9px Inter,sans-serif';
        ctx.textAlign='right';
        ctx.fillText(STEPS[i].a,x+w-18,sy+40);
      }
      ctx.globalAlpha=1;
    }

    if(stepIdx>=3&&t>360){
      var typAlpha=Math.min(1,(t-360)/40);
      ctx.globalAlpha=typAlpha;
      ctx.fillStyle=C.muted;
      ctx.font='10px Inter,sans-serif';
      ctx.textAlign='center';
      var dots='';
      for(var d=0;d<3;d++) dots+=(Math.floor(t/12)%3===d)?'●':'○';
      ctx.fillText('AI считает по прайсу '+dots,x+w/2,y+h-14);
      ctx.globalAlpha=1;
    }
  }

  function drawAiCore(cx,cy,r,pulse){
    var gR=r+Math.sin(pulse*0.08)*4;
    ctx.beginPath();
    ctx.arc(cx,cy,gR+8,0,Math.PI*2);
    ctx.fillStyle='rgba(167,139,250,'+(0.08+0.06*Math.sin(pulse*0.08))+')';
    ctx.fill();
    ctx.beginPath();
    ctx.arc(cx,cy,r,0,Math.PI*2);
    ctx.fillStyle=C.violD;
    ctx.fill();
    ctx.strokeStyle=C.viol;ctx.lineWidth=2;ctx.stroke();
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('RAG',cx,cy+4);
    for(var i=0;i<4;i++){
      var ang=(i/4)*Math.PI*2+pulse*0.07;
      ctx.beginPath();
      ctx.arc(cx+Math.cos(ang)*(r+14),cy+Math.sin(ang)*(r+14),3,0,Math.PI*2);
      ctx.fillStyle=C.cyan;ctx.fill();
    }
  }

  function drawEstimate(x,y,w,h,t){
    if(t<400) return;
    var slide=Math.min(1,(t-400)/50);
    var offY=(1-slide)*40;
    ctx.globalAlpha=slide;

    rr(x,y+offY,w,h,10,C.paper,C.paperBdr,1.5);
    rr(x,y+offY,w,24,10,C.warm,null,0);
    ctx.fillStyle='#0f172a';
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Предварительное КП',x+10,y+offY+16);
    ctx.fillStyle='#334155';
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('Капремонт · 68 м²',x+10,y+offY+38);
    ctx.fillStyle='#0f172a';
    ctx.font='bold 14px Inter,sans-serif';
    ctx.fillText('1,2 – 1,6 млн ₽',x+10,y+offY+58);
    ctx.fillStyle='#94a3b8';
    ctx.font='8px Inter,sans-serif';
    ctx.fillText('после замера — финальная смета',x+10,y+offY+72);

    if(t>480){
      var chk=Math.min(1,(t-480)/30);
      ctx.globalAlpha=slide*chk;
      rr(x+w-28,y+offY+6,20,18,6,C.greenD,C.green,1);
      ctx.fillStyle=C.green;
      ctx.font='bold 12px sans-serif';
      ctx.textAlign='center';
      ctx.fillText('✓',x+w-18,y+offY+19);
    }
    ctx.globalAlpha=1;
  }

  function drawCrmCard(x,y,w,h,t){
    if(t<520) return;
    var slide=Math.min(1,(t-520)/45);
    var offX=(1-slide)*30;
    ctx.globalAlpha=slide;

    rr(x+offX,y,w,h,10,'rgba(59,130,246,.12)',C.crm,1.5);
    ctx.fillStyle=C.crm;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('amoCRM · новый лид',x+offX+10,y+18);
    ctx.fillStyle=C.ink;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('Иван К. · капремонт 68 м²',x+offX+10,y+34);
    ctx.fillStyle=C.green;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.fillText('1,2–1,6 млн ₽ · горячий',x+offX+10,y+48);
    ctx.fillStyle=C.muted;
    ctx.font='8px Inter,sans-serif';
    ctx.fillText('статус: требует проверки сметчиком',x+offX+10,y+62);

    if(t>580){
      var pulse=Math.sin((t-580)*0.15)*0.3+0.7;
      ctx.globalAlpha=slide*pulse;
      ctx.beginPath();
      ctx.arc(x+offX+w-16,y+16,5,0,Math.PI*2);
      ctx.fillStyle=C.green;ctx.fill();
    }
    ctx.globalAlpha=1;
  }

  function drawFlowArrows(x1,y1,x2,y2,alpha){
    ctx.globalAlpha=alpha||0.4;
    ctx.strokeStyle=C.cyan;
    ctx.lineWidth=1.5;
    ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);ctx.lineTo(x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    var ang=Math.atan2(y2-y1,x2-x1);
    ctx.beginPath();
    ctx.moveTo(x2,y2);
    ctx.lineTo(x2-8*Math.cos(ang-0.4),y2-8*Math.sin(ang-0.4));
    ctx.lineTo(x2-8*Math.cos(ang+0.4),y2-8*Math.sin(ang+0.4));
    ctx.closePath();
    ctx.fillStyle=C.cyan;ctx.fill();
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);

    drawTopBar();

    var pad=12;
    var prog=Math.min(1,t/360);
    drawProgressBar(40,W,prog);

    var quizW=Math.min(200,W*0.38);
    var quizH=Math.min(200,H*0.55);
    var quizX=pad;
    var quizY=52;
    drawQuizPanel(quizX,quizY,quizW,quizH,t);

    var coreR=Math.min(22,W*0.04);
    var coreX=quizX+quizW+pad+coreR+8;
    var coreY=quizY+quizH/2;
    if(coreX+coreR<W*0.55){
      drawAiCore(coreX,coreY,coreR,t);
      if(t>350) drawFlowArrows(quizX+quizW,quizY+quizH/2,coreX-coreR-4,coreY,Math.min(1,(t-350)/40));
    }

    var estW=Math.min(130,W*0.28);
    var estH=88;
    var estX=W-pad-estW;
    var estY=quizY+10;
    drawEstimate(estX,estY,estW,estH,t);

    var crmW=Math.min(150,W*0.32);
    var crmH=72;
    var crmX=W-pad-crmW;
    var crmY=estY+estH+16;
    drawCrmCard(crmX,crmY,crmW,crmH,t);

    if(t>460&&t<560){
      var fa=Math.min(1,(t-460)/30)*Math.min(1,(560-t)/30);
      var srcX=coreX+coreR+4;
      drawFlowArrows(srcX,coreY,estX,estY+estH/2,fa*0.6);
    }
    if(t>540){
      var fa2=Math.min(1,(t-540)/30);
      drawFlowArrows(estX+estW/2,estY+estH,crmX+crmW/2,crmY,fa2*0.5);
    }

    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('заявка → бриф → смета → CRM',W/2,H-10);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>

  <section class="astr-section" id="scenarii">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Ниши</span>
        <h2>Сценарии AI для ремонта и строительства</h2>
      </div>
      <div class="astr-grid-3 nero-ai-reveal">
        <div class="astr-scenario">
          <h3>Ремонт квартир и офисов</h3>
          <p>AI закрывает типовые 70–80% заявок: косметика, капиталка, отделка новостроек. <strong>AI расчёт стоимости ремонта</strong> по площади и классу материалов. Отличие кастомного внедрения: ваш прайс, ваш бренд, ваш квиз.</p>
        </div>
        <div class="astr-scenario nero-ai-delay-1">
          <h3>Строительство домов и коттеджей</h3>
          <p>В ИЖС AI собирает «биометрию объекта»: фундамент, коробка, инженерия. «Пазл Дом» сократил согласование ипотеки с 2–3 недель до 22 часов.</p>
        </div>
        <div class="astr-scenario nero-ai-delay-2">
          <h3>Инженерные и подрядные работы</h3>
          <p>AI-квиз уточняет мощность, протяжённость трасс, тип оборудования. Смета по справочнику работ с привязкой к нормо-часам бригад.</p>
        </div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="integracii">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">CRM и каналы</span>
        <h2>Интеграция AI с CRM и мессенджерами</h2>
      </div>
      <div class="astr-grid-2 nero-ai-reveal">
        <div class="astr-card">
          <h3>amoCRM, Bitrix24 и учётные системы</h3>
          <p><strong>Интеграция AI для строительства с CRM</strong> — обязательный элемент. Автоматически передаётся: контакт, бриф, предварительная смета, саммари диалога, статус воронки, тег квалификации. Поддержка: amoCRM, Битрикс24, выгрузка из 1С.</p>
        </div>
        <div class="astr-card nero-ai-delay-1">
          <h3>Telegram, WhatsApp и сайт-виджет</h3>
          <p>AI-ассистент в Telegram, WhatsApp Business API, VK и виджете на WordPress. Менеджер получает уведомление: «Новый лид: капремонт, 68 м², вилка 1,2–1,6 млн ₽».</p>
        </div>
      </div>
    </div>
  </section>

  <section class="astr-section" id="kontrol">
    <div class="astr-cnt">
      <div class="astr-sh astr-left nero-ai-reveal">
        <span class="astr-eyebrow">После договора</span>
        <h2>Контроль проектов и документов с AI</h2>
      </div>
      <div class="astr-grid-2 nero-ai-reveal">
        <div class="astr-card">
          <h3>Статусы объектов и напоминания</h3>
          <p><strong>AI контроль проектов</strong> — чек-лист этапов, напоминания бригадиру и клиенту, фото-отчёты через бот, дашборд для руководителя. Модуль подключается как upsell после базового пакета «квиз + смета + CRM».</p>
        </div>
        <div class="astr-card nero-ai-delay-1">
          <h3>Документы, акты и сметные таблицы</h3>
          <p>Генерация шаблонов актов и КС-2/КС-3, сверка фактических объёмов с предварительной сметой. Capital Group: пилоты ИИ в тендерной документации — измерение → масштаб.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="keisy">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Доказательства</span>
        <h2>Кейсы внедрения AI в строительстве</h2>
        <p>Российские референсы для ориентира. Для бригады 5–10 человек: до — ~4 часа на заявку; после — ~25 минут активного времени команды.</p>
      </div>

      <div class="astr-case-grid nero-ai-reveal">
        <div class="astr-case-card"><div class="astr-case-tag">ГК «Самолёт»</div><h3>LLM для ВОР и смет</h3><p>До −85% времени на ВОР, до −30% на расчёт себестоимости. <a href="https://yandex.cloud/ru/blog/posts/2025/04/technologies-in-construction" target="_blank" rel="noopener noreferrer">Yandex Cloud</a></p></div>
        <div class="astr-case-card"><div class="astr-case-tag">Пазл Дом · ИТМО</div><h3>AI-ассистент ИЖС</h3><p>Смета за ~6,5 сек.; ипотека: с 2–3 нед. до 22 ч. <a href="https://www.cnews.ru/news/line/2026-04-20_startap_magistranta_itmo" target="_blank" rel="noopener noreferrer">CNews</a></p></div>
        <div class="astr-case-card"><div class="astr-case-tag">October Group</div><h3>AI LAB: боты первой линии</h3><p>Структурированная передача брифа менеджеру. <a href="https://www.cnews.ru/articles/2026-02-24_pochemu_developery_stanovyatsya_ai-kompaniyami" target="_blank" rel="noopener noreferrer">CNews</a></p></div>
        <div class="astr-case-card"><div class="astr-case-tag">Международный контекст</div><h3>Agitech · Boon AI</h3><p>AI quantity takeoff за &lt;30 мин вместо 2–3 дней; обработано 66 000+ страниц чертежей.</p></div>
      </div>

      <div class="astr-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="astr-table">
          <thead><tr><th>Метрика</th><th>Как измерять</th></tr></thead>
          <tbody>
            <tr><td>Время первого ответа</td><td>От заявки до первого содержательного ответа</td></tr>
            <tr><td>Время предварительной сметы</td><td>От полного брифа до отправки вилки</td></tr>
            <tr><td>Конверсия заявка → замер</td><td>% лидов, дошедших до выезда</td></tr>
            <tr><td>Нагрузка на сметчика</td><td>Часы на типовые расчёты в неделю</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="astr-section" id="ceny">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Коммерция</span>
        <h2>Стоимость внедрения AI для строительства</h2>
        <p><strong>AI для строительства под ключ</strong> от Nero Network: аудит → квиз → ассистент → интеграции → запуск. Ориентир <strong>180–600 тыс. ₽</strong>.</p>
      </div>

      <div class="astr-price-grid nero-ai-reveal">
        <div class="astr-price-card">
          <h3>Старт</h3>
          <div class="price">от 180 тыс. ₽</div>
          <p>Квиз + AI-бриф + CRM (1 канал)</p>
        </div>
        <div class="astr-price-card featured">
          <h3>Бизнес</h3>
          <div class="price">300–450 тыс. ₽</div>
          <p>+ мессенджеры + предварительная смета + 2 CRM-интеграции</p>
        </div>
        <div class="astr-price-card">
          <h3>Полный</h3>
          <div class="price">до 600 тыс. ₽</div>
          <p>+ контроль объектов + дашборд + сопровождение 3 мес.</p>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет под вашу строительную компанию</p>
          <p class="ym-cta-block__sub">Ориентир 180–600 тыс. ₽ за внедрение под ключ. На консультации оценим каналы заявок, объём смет и интеграции с CRM — бесплатно.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="etapy">
    <div class="astr-cnt">
      <div class="astr-sh astr-left nero-ai-reveal">
        <span class="astr-eyebrow">Под ключ</span>
        <h2>Как внедрить AI для строительства: этапы под ключ</h2>
        <p>Базовый пакет — 3–4 недели: аудит → квиз + ассистент → интеграции → калибровка.</p>
      </div>

      <div class="astr-card nero-ai-reveal">
        <div class="astr-timeline">
          <div class="astr-tl-item"><div class="astr-tl-dot"></div><h3>Аудит заявок и смет (неделя 1)</h3><p>Карта каналов, шаблоны смет, этапы воронки, типовые вопросы клиентов. Результат — ТЗ на квиз и список веток сценариев.</p></div>
          <div class="astr-tl-item"><div class="astr-tl-dot"></div><h3>Сборка квиза и обучение ассистента (недели 2–3)</h3><p>Многошаговая форма с ветками, LLM + RAG из прайса, tool-calling для расчёта, PDF «Предварительное КП», тест на 10–15 реальных сценариях.</p></div>
          <div class="astr-tl-item"><div class="astr-tl-dot"></div><h3>Запуск и сопровождение (неделя 4+)</h3><p>CRM-коннектор, A/B тест вопросов, калибровка вилки по 20–30 сметам, модерация AI 2–4 недели, обучение менеджеров.</p></div>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта проекта?</p>
          <p class="ym-cta-block__sub">Перед внедрением квиза и ассистента полезно разобраться в промптах, RAG и human-in-the-loop. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a> — это ускоряет согласование ТЗ и снижает риски на этапе пилота.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="astr-section" id="arhitektura">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Архитектура</span>
        <h2>Архитектура решения: как устроен AI-ассистент</h2>
      </div>
      <div class="astr-flow-diagram nero-ai-reveal" aria-label="Схема контура Nero Network">Сайт / Telegram / WhatsApp
        ↓
   AI-квиз (7–12 вопросов)
        ↓
   LLM-агент + RAG (прайс, типовые сметы)
        ↓
   Калькулятор предварительной сметы
        ↓
   PDF/Excel «Предварительное КП» + дисклеймер
        ↓
   amoCRM / Битрикс24 (лид + бриф + файл)
        ↓
   Уведомление менеджеру (Telegram / email)
        ↓
   Сметчик верифицирует после замера → финальное КП</div>

      <div class="astr-table-wrap nero-ai-reveal">
        <table class="astr-table">
          <thead><tr><th>Компонент</th><th>Варианты</th></tr></thead>
          <tbody>
            <tr><td>AI-модель</td><td>OpenAI GPT-4o/Agents, Claude, YandexGPT/GigaChat (152-ФЗ)</td></tr>
            <tr><td>RAG-база</td><td>Google Sheets, Notion, PDF прайсы → векторное хранилище</td></tr>
            <tr><td>CRM</td><td>amoCRM, Битрикс24, 1С (номенклатура)</td></tr>
            <tr><td>Мессенджеры</td><td>Telegram, WhatsApp Business API, VK</td></tr>
            <tr><td>Автоматизация</td><td>n8n, Make.com — маршрутизация, напоминания</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="dlya-kogo">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит и для кого нет</h2>
      </div>
      <div class="astr-grid-2 nero-ai-reveal">
        <div class="astr-card">
          <h3>Подходит</h3>
          <ul>
            <li>Ремонтные компании и бригады (3–50 человек)</li>
            <li>Строители домов и коттеджей (ИЖС)</li>
            <li>Отделочные и инженерные подрядчики</li>
            <li>Бизнес с потоком заявок с сайта, Авито, ЦИАН, VK</li>
            <li>Компании, где сметчик — узкое горлышко воронки</li>
          </ul>
        </div>
        <div class="astr-card nero-ai-delay-1">
          <h3>Не подходит (пока)</h3>
          <ul>
            <li>Девелоперы с BIM и сотнями позиций ВОР</li>
            <li>Компании без прайса и типовых смет</li>
            <li>Бизнес с 1–2 заявками в месяц</li>
            <li>Ожидание официальной сметы по ГЭСН/ФЕР в один клик</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="astr-section" id="faq">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">FAQ</span>
        <h2>FAQ по AI для строительных компаний</h2>
      </div>
      <div class="astr-faq nero-ai-reveal" id="astr-faq-list">
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">Насколько точна предварительная смета?</div><div class="astr-faq-a">AI-смета даёт ориентировочную вилку на основе прайса и ответов квиза. Точность на типовых объектах — порядка 80–85%. Финальный расчёт после замера всегда делает сметчик. В каждом КП — дисклеймер: не является официальным сметным документом по ГЭСН/ФЕР.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли CRM для старта?</div><div class="astr-faq-a">Желательна, но не обязательна на этапе пилота. Минимальный контур — квиз + AI + email/Telegram-уведомление. CRM подключается на 2–3 неделе внедрения.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">Сроки внедрения</div><div class="astr-faq-a">Базовый пакет — 3–4 недели: аудит (1 нед.) → квиз + ассистент (1–2 нед.) → интеграции + запуск (1 нед.) → калибровка. Расширенный пакет с контролем объектов — до 6 недель.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">AI для строительства для малого бизнеса — реально?</div><div class="astr-faq-a">Да. Пакет «Старт» от 180 тыс. ₽ рассчитан на бригаду 3–10 человек. Окупаемость считается через экономию времени сметчика и рост конверсии заявка → замер.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">152-ФЗ и данные в облаке?</div><div class="astr-faq-a">Для компаний с требованиями к хранению данных — варианты GigaChat/YandexGPT и on-prem развёртывание. Обсуждается на этапе аудита.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">Чем Nero Network отличается от Constract.io и ПРОСТОСМЕТА?</div><div class="astr-faq-a">SaaS-сметчики считают по своим расценкам и не закрывают воронку (заявки, CRM, мессенджеры). Nero собирает кастомный контур под ваш бренд и процессы — квиз, AI, CRM, контроль.</div></div>
      </div>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="kviz">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Демо</span>
        <h2>Соберите AI-квиз для вашего типа объекта</h2>
        <p>Посмотрите, как ассистент уточняет заявку и формирует предварительную смету — три шага демо-воронки.</p>
      </div>
      <div class="astr-kviz-demo nero-ai-reveal">
        <div class="astr-kviz-steps" aria-hidden="true">
          <span class="astr-kviz-step active">1. Тип объекта</span>
          <span class="astr-kviz-step">2. Площадь и работы</span>
          <span class="astr-kviz-step">3. Вилка стоимости</span>
        </div>
        <p><strong>Шаг 1:</strong> Клиент выбирает «Квартира 68 м² · капитальный ремонт» — AI ветвит сценарий вопросов по зонам и срокам.</p>
        <p><strong>Шаг 2:</strong> Система подставляет расценки из RAG-базы вашего прайса, не из чужого калькулятора.</p>
        <p><strong>Шаг 3:</strong> Клиент видит вилку 1,2–1,6 млн ₽ с дисклеймером; карточка лида уходит в amoCRM со статусом «требует проверки сметчиком».</p>
        <div style="margin-top:24px;text-align:center;">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Собрать AI-квиз</a>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:28px;text-align:center;max-width:720px;margin-left:auto;margin-right:auto;"><strong>Итог:</strong> Nero Network внедряет AI-ассистент для строительной компании под ключ за 3–4 недели. Ориентир бюджета — <strong>180–600 тыс. ₽</strong>.</p>
    </div>
  </section>

</div>

<!-- SCHEMA-MARKUP:INSERT -->

</main>


<script>
(function(){
  document.querySelectorAll('.astr-faq-q').forEach(function(q){
    function toggle(){
      var item=q.parentElement;
      var open=item.classList.contains('open');
      document.querySelectorAll('.astr-faq-item.open').forEach(function(el){el.classList.remove('open');el.querySelector('.astr-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}
    }
    q.addEventListener('click',toggle);
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();toggle();}});
  });
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
