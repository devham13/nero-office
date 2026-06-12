<?php
/**
 * Template Name: AI-проверка договоров и рисковых пунктов: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-проверки договоров. LegalTech, human-in-the-loop, интеграции CRM/ЭДО, кейсы, цена.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-проверка договоров под ключ: риски и внедрение для бизнеса';
$page_seo_description = 'Внедрение AI-проверки договоров: нейросеть за минуты выделяет рисковые пункты и готовит вопросы юристу. Интеграция с CRM и ЭДО, кейсы, чек-лист, цена под ключ.';

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
    ['label' => 'Зачем', 'href' => '#zachem'],
    ['label' => 'Риски', 'href' => '#riski'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Проверить договор';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '';

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

.apvd-hero-legal {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.apvd-content{
  --apvd-bg:#060a12;--apvd-bg2:#0a0e1c;--apvd-bg3:#0f172a;
  --apvd-surface:rgba(255,255,255,.072);--apvd-surface2:rgba(255,255,255,.108);
  --apvd-text:#e2e8f0;--apvd-muted:#94a3b8;--apvd-soft:#c7d2fe;--apvd-heading:#f8fafc;
  --apvd-border:rgba(148,163,184,.14);--apvd-border-s:rgba(99,102,241,.28);
  --apvd-accent:#8b5cf6;--apvd-legal:#6366f1;--apvd-green:#22c55e;--apvd-red:#ef4444;
  --apvd-btn-from:#4f46e5;--apvd-btn-to:#7c3aed;
  --apvd-shadow:0 24px 72px rgba(0,0,0,.45);
  --apvd-r:18px;--apvd-r-lg:24px;--apvd-container:1220px;
  background:linear-gradient(180deg,#060a12 0%,#0a0e1c 52%,#060a12 100%);
  color:var(--apvd-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.apvd-content *,.apvd-content *::before,.apvd-content *::after{box-sizing:border-box;}
.apvd-content a{color:inherit;text-decoration:none;}
.apvd-content p{color:var(--apvd-muted);line-height:1.72;margin:0 0 1em;text-align:left!important;}
.apvd-content p:last-child{margin-bottom:0;}
.apvd-content h2,.apvd-content h3,.apvd-content h4{color:var(--apvd-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.apvd-content strong{color:var(--apvd-soft);}
.apvd-content ul,.apvd-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.apvd-content ul li,.apvd-content ol li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apvd-muted);font-size:14.5px;line-height:1.65;text-align:left!important;}
.apvd-content ul li::before{content:'›';position:absolute;left:0;color:var(--apvd-legal);font-weight:700;}
.apvd-content ol.apvd-ol{counter-reset:apvd-ol;}
.apvd-content ol.apvd-ol li{counter-increment:apvd-ol;padding-left:28px;}
.apvd-content ol.apvd-ol li::before{content:counter(apvd-ol) '.';position:absolute;left:0;color:var(--apvd-accent);font-weight:800;}
.apvd-cnt{width:min(var(--apvd-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.apvd-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.apvd-section-alt{background:linear-gradient(180deg,rgba(99,102,241,.06),rgba(139,92,246,.03));border-top:1px solid rgba(99,102,241,.12);border-bottom:1px solid rgba(99,102,241,.12);}
#human-loop.apvd-section{border:1px solid rgba(139,92,246,.22);box-shadow:inset 0 0 80px rgba(99,102,241,.06);}
.apvd-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.apvd-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.apvd-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;text-align:left!important;}
.apvd-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(99,102,241,.1);border:1px solid rgba(99,102,241,.28);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#a5b4fc;margin-bottom:14px;}
.apvd-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(99,102,241,.05),transparent);border-bottom:1px solid rgba(99,102,241,.12);}
.apvd-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.apvd-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.apvd-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apvd-legal),var(--apvd-accent));}
.apvd-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.apvd-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.apvd-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(99,102,241,.18);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.apvd-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--apvd-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.apvd-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apvd-muted);line-height:1.4;}
.apvd-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.apvd-intro-grid{grid-template-columns:1fr;gap:36px;}.apvd-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.apvd-intro-kpi{grid-template-columns:1fr 1fr;}}
.apvd-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.apvd-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.apvd-toc a{display:inline-block;padding:9px 18px;background:var(--apvd-surface);border:1px solid var(--apvd-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--apvd-muted);transition:border-color .2s,color .2s,background .2s;}
.apvd-toc a:hover{border-color:rgba(139,92,246,.42);color:#c7d2fe;background:rgba(99,102,241,.1);}
.apvd-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apvd-border);border-radius:var(--apvd-r-lg);padding:26px;margin-bottom:20px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);}
.apvd-card h3{font-size:17px;margin-bottom:10px;}
.apvd-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.apvd-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.apvd-grid-2,.apvd-grid-3{grid-template-columns:1fr;}}
.apvd-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(99,102,241,.18);margin:20px 0;}
.apvd-table{width:100%;border-collapse:collapse;font-size:14px;}
.apvd-table th{padding:13px 16px;text-align:left;background:rgba(99,102,241,.14);color:#c7d2fe;font-weight:700;border-bottom:1px solid rgba(99,102,241,.28);white-space:nowrap;}
.apvd-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apvd-text);vertical-align:top;text-align:left!important;}
.apvd-table tr:last-child td{border-bottom:none;}
.apvd-table tr:hover td{background:rgba(255,255,255,.03);}
.apvd-flow-diagram{display:block;padding:20px 22px;border-radius:14px;background:rgba(15,23,42,.85);border:1px solid rgba(99,102,241,.22);color:#a5b4fc;font-family:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace;font-size:12px;line-height:1.6;overflow-x:auto;white-space:pre-wrap;margin:20px 0;}
.apvd-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:20px;}
@media(max-width:900px){.apvd-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.apvd-case-grid{grid-template-columns:1fr;}}
.apvd-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(99,102,241,.16);border-radius:20px;padding:26px;}
.apvd-case-card h3{font-size:16px;margin-bottom:10px;}
.apvd-case-kpi{font-size:clamp(22px,3vw,30px);font-weight:900;color:var(--apvd-accent);margin-bottom:8px;}
.apvd-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.apvd-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.apvd-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--apvd-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.apvd-faq-q::after{content:'▾';font-size:13px;color:var(--apvd-accent);flex-shrink:0;transition:transform .25s;}
.apvd-faq-item.open .apvd-faq-q::after{transform:rotate(180deg);}
.apvd-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--apvd-muted);line-height:1.72;text-align:left!important;}
.apvd-faq-item.open .apvd-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(99,102,241,.14),rgba(139,92,246,.1));border:1px solid rgba(99,102,241,.32);text-align:center;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(99,102,241,.12),rgba(34,197,94,.08));border-color:rgba(99,102,241,.28);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.14),rgba(99,102,241,.1));border-color:rgba(139,92,246,.32);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--apvd-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;text-align:left!important;}
.ym-cta-block--dual .ym-cta-block__sub,.ym-cta-block--footer-final .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-cta-block--dual .ym-cta-block__actions,.ym-cta-block--footer-final .ym-cta-block__actions{justify-content:flex-start;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--apvd-btn-from),var(--apvd-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(99,102,241,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--apvd-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:#a5b4fc!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-proverka-dogovorov-page" role="main" tabindex="-1">

<section class="nero-ai-hero apvd-hero-legal" id="hero" aria-labelledby="apvd-hero-title">
<style>
.apvd-hero-legal {
  --apvd-bg: #060a12;
  --apvd-surface: rgba(15, 23, 42, 0.72);
  --apvd-border: rgba(148, 163, 184, 0.14);
  --apvd-text: #cbd5e1;
  --apvd-heading: #f8fafc;
  --apvd-muted: #94a3b8;
  --apvd-accent: #8b5cf6;
  --apvd-legal: #6366f1;
  --apvd-risk: #ef4444;
  --apvd-warn: #f59e0b;
  --apvd-ok: #22c55e;
  padding: clamp(108px, 14vh, 148px) 0 clamp(64px, 8vw, 80px);
  background:
    radial-gradient(ellipse 80% 50% at 70% 20%, rgba(99, 102, 241, 0.16), transparent),
    radial-gradient(ellipse 60% 40% at 10% 80%, rgba(139, 92, 246, 0.12), transparent),
    var(--apvd-bg);
  color: var(--apvd-text);
  font-family: Inter, system-ui, -apple-system, sans-serif;
  position: relative;
  overflow: hidden;
}
.apvd-hero-legal *, .apvd-hero-legal *::before, .apvd-hero-legal *::after { box-sizing: border-box; }
.apvd-hero-legal .nero-ai-container { width: min(1200px, 92vw); margin: 0 auto; }
.apvd-hero-legal .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: 1fr 1.05fr;
  gap: clamp(32px, 5vw, 56px);
  align-items: center;
}
.apvd-hero-legal .nero-ai-eyebrow {
  display: inline-block;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #a5b4fc;
  margin: 0 0 14px;
}
.apvd-hero-legal .nero-ai-h1,
.apvd-hero-legal #apvd-hero-title {
  font-size: clamp(34px, 5vw, 56px);
  font-weight: 800;
  line-height: 1.08;
  letter-spacing: -0.03em;
  color: var(--apvd-heading);
  margin: 0 0 20px;
}
.apvd-hero-legal .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #c7d2fe 0%, #818cf8 44%, #a78bfa 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.apvd-hero-legal .nero-ai-hero-lead {
  font-size: clamp(17px, 2vw, 20px);
  line-height: 1.6;
  color: var(--apvd-muted);
  margin: 0 0 28px;
  max-width: 640px;
}
.apvd-hero-legal .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 28px;
  padding: 0;
  list-style: none;
}
.apvd-hero-legal .nero-ai-badge {
  padding: 8px 14px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  background: rgba(99, 102, 241, 0.12);
  border: 1px solid rgba(99, 102, 241, 0.28);
  color: #c7d2fe;
}
.apvd-hero-legal .nero-ai-btn-row { display: flex; flex-wrap: wrap; gap: 14px; }
.apvd-hero-legal .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 26px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
}
.apvd-hero-legal .nero-ai-btn-primary {
  background: linear-gradient(135deg, #4f46e5, #7c3aed);
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(99, 102, 241, 0.35);
}
.apvd-hero-legal .nero-ai-btn-secondary {
  background: transparent;
  color: #e2e8f0 !important;
  border: 1px solid var(--apvd-border);
}
.apvd-hero-legal .nero-ai-btn:hover { transform: translateY(-2px); }
.apvd-hero-legal .nero-ai-dashboard {
  background: var(--apvd-surface);
  border: 1px solid var(--apvd-border);
  border-radius: 20px;
  padding: 20px;
  backdrop-filter: blur(12px);
  box-shadow: 0 24px 64px rgba(0, 0, 0, 0.45);
  transform: perspective(1100px) rotateY(-2deg) rotateX(1deg);
}
.apvd-hero-legal .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 18px;
  background: linear-gradient(180deg, rgba(15, 23, 42, 0.95), rgba(6, 10, 24, 0.96));
}
.apvd-hero-legal .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.045);
}
.apvd-hero-legal .nero-ai-dots { display: flex; gap: 7px; }
.apvd-hero-legal .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.apvd-hero-legal .nero-ai-dot:nth-child(1) { background: #fb7185; }
.apvd-hero-legal .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.apvd-hero-legal .nero-ai-dot:nth-child(3) { background: #34d399; }
.apvd-hero-legal .nero-ai-window-title {
  color: #c7d2fe;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.apvd-hero-legal .nero-ai-window-body { padding: 16px; }
.apvd-hero-legal .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.apvd-hero-legal .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.apvd-hero-legal .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.1);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.apvd-hero-legal .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.14);
  animation: apvdPulse 1.6s infinite;
}
@keyframes apvdPulse {
  0%, 100% { transform: scale(0.86); opacity: 0.65; }
  50% { transform: scale(1); opacity: 1; }
}
.apvd-hero-legal .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.apvd-hero-legal .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  border-radius: 16px;
  background: rgba(255, 255, 255, 0.055);
}
.apvd-hero-legal .nero-ai-metric span {
  display: block;
  color: var(--apvd-muted);
  font-size: 11px;
  font-weight: 700;
}
.apvd-hero-legal .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.apvd-hero-legal .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.apvd-hero-legal .apvd-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(99, 102, 241, 0.22);
  background: radial-gradient(ellipse at 40% 40%, rgba(99, 102, 241, 0.1), rgba(6, 10, 24, 0.92) 72%);
}
.apvd-hero-legal #apvd-legal-scan-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.apvd-hero-legal .nero-ai-task-stream { display: grid; gap: 8px; }
.apvd-hero-legal .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.04);
}
.apvd-hero-legal .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(99, 102, 241, 0.14);
  color: #c7d2fe;
  font-size: 11px;
  font-weight: 800;
}
.apvd-hero-legal .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.apvd-hero-legal .nero-ai-task span {
  color: var(--apvd-muted);
  font-size: 11px;
}
.apvd-hero-legal .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(239, 68, 68, 0.12);
  color: #fecaca;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.apvd-hero-legal .nero-ai-status--amber {
  background: rgba(245, 158, 11, 0.12);
  color: #fde68a;
}
.apvd-hero-legal .nero-ai-status--green {
  background: rgba(34, 197, 94, 0.12);
  color: #bbf7d0;
}
@media (max-width: 1100px) {
  .apvd-hero-legal .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .apvd-hero-legal .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .apvd-hero-legal .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .apvd-hero-legal .nero-ai-window-body { padding: 12px; }
  .apvd-hero-legal .nero-ai-task { grid-template-columns: 28px 1fr; }
  .apvd-hero-legal .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · LegalTech · ai проверка договоров</p>
      <h1 id="apvd-hero-title">AI-проверка договоров и рисковых пунктов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть за минуты выделяет рисковые формулировки и готовит вопросы юристу — финальное решение остаётся за человеком</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">LegalTech</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">CRM / ЭДО</li>
        <li class="nero-ai-badge">Чек-лист рисков</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить договор</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает AI</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-скрининга договора">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-скрининг договора · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Критичных рисков</span>
              <strong>3</strong>
              <small>штраф · расторжение · ПДн</small>
            </div>
            <div class="nero-ai-metric">
              <span>Вопросов юристу</span>
              <strong>12</strong>
              <small>чек-лист эскалации</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время скрининга</span>
              <strong>~5 мин</strong>
              <small>типовой договор</small>
            </div>
            <div class="nero-ai-metric">
              <span>Решение</span>
              <strong>Юрист</strong>
              <small>human-in-the-loop</small>
            </div>
          </div>

          <div class="apvd-dash-canvas-wrap" aria-hidden="false">
            <canvas id="apvd-legal-scan-canvas" role="img" aria-label="Анимация: страницы договора проходят AI-скрининг, рисковые пункты подсвечиваются, чек-лист уходит на подтверждение юристу"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий скрининга">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">NDA</span>
              <div><strong>NDA · штраф без потолка</strong><span>п. 7.2 — критично 🔴</span></div>
              <span class="nero-ai-status">риск</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ПД</span>
              <div><strong>Подряд · размытая приёмка</strong><span>п. 4.1 — средне 🟡</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ПС</span>
              <div><strong>Поставка · автопролонгация</strong><span>п. 12 — критично 🔴</span></div>
              <span class="nero-ai-status">риск</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Чек-лист сформирован</strong><span>12 вопросов → юридический отдел</span></div>
              <span class="nero-ai-status nero-ai-status--green">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
/**
 * apvd-legal-scan-engine — «Юридическая диспетчерская скрининга договоров»
 * Мир: вертикальная карусель страниц → верстак ClauseRiskWorkbench → шлюз HumanApprovalGate
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("apvd-legal-scan-canvas");
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
    doc: "#f8fafc",
    docEdge: "#cbd5e1",
    riskRed: "#ef4444",
    riskAmber: "#f59e0b",
    riskGreen: "#22c55e",
    shelf: "#334155",
    shelfGlow: "rgba(99,102,241,0.35)",
    workbench: "#1e293b",
    beam: "rgba(129,140,248,0.55)",
    stamp: "rgba(34,197,94,0.88)",
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

  function drawMiniPage(ctx, x, y, w, h, highlights) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, C.doc, C.outline);
    ctx.strokeStyle = "rgba(148,163,184,0.45)";
    ctx.lineWidth = 0.7;
    for (var i = 0; i < 4; i++) {
      ctx.beginPath();
      ctx.moveTo(x - w / 2 + 3, y - h / 2 + 5 + i * 4);
      ctx.lineTo(x + w / 2 - 3, y - h / 2 + 5 + i * 4);
      ctx.stroke();
    }
    if (highlights) {
      highlights.forEach(function (hl, i) {
        ctx.fillStyle = hl;
        ctx.fillRect(x - w / 2 + 4, y - h / 2 + 8 + i * 7, w - 8, 3);
      });
    }
  }

  /* Стеллаж playbook RAG */
  function PlaybookRagShelf() {}
  PlaybookRagShelf.prototype.draw = function (ctx) {
    drawRR(ctx, -168, -72, 34, 88, 5, C.shelf, C.outline);
    var books = ["Поставка", "NDA", "Подряд", "Аренда"];
    books.forEach(function (b, i) {
      var col = [C.riskAmber, C.agentBlue, C.riskGreen, C.agentPurple][i];
      drawRR(ctx, -162, -64 + i * 20, 22, 16, 2, col, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.slice(0, 3), -151, -54 + i * 20);
    });
    ctx.fillStyle = C.shelfGlow;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("RAG", -166, -78);
  };

  /* Вертикальная карусель страниц — вместо Conveyor */
  function ContractIntakeCarousel() {
    this.pages = [
      { offset: 0, type: "NDA", color: C.agentPurple },
      { offset: 55, type: "ПС", color: C.riskAmber },
      { offset: 110, type: "ПД", color: C.agentBlue }
    ];
  }
  ContractIntakeCarousel.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, -148, -98, 18, 118, 4, "rgba(51,65,85,0.5)", C.outline);
    ctx.fillStyle = "#64748b";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Вход", -139, -102);

    this.pages.forEach(function (pg) {
      var t = ((frame * 0.55 + pg.offset) % 100) / 100;
      var py = -88 + t * 95;
      if (t < 0.88) {
        drawMiniPage(ctx, -139, py, 14, 18, null);
        ctx.fillStyle = pg.color;
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.fillText(pg.type, -139, py + 14);
      }
    });
  };

  /* Луч сканирования рисков */
  function RiskScanBeam() {
    this.y = -40;
  }
  RiskScanBeam.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 45 || prg >= 115) return;
    var scanT = (prg - 45) / 70;
    this.y = -42 + scanT * 72;
    ctx.save();
    ctx.globalAlpha = 0.4 + Math.sin(frame * 0.14) * 0.15;
    ctx.fillStyle = C.beam;
    ctx.fillRect(-22, this.y - 2, 88, 4);
    ctx.strokeStyle = "#818cf8";
    ctx.lineWidth = 1.2;
    ctx.strokeRect(-26, this.y - 18, 96, 36);
    ctx.restore();
  };

  /* Центральный верстак анализа — вместо WebsiteTerminal */
  function ClauseRiskWorkbench() {
    this.highlightPhase = 0;
  }
  ClauseRiskWorkbench.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, -35, -55, 110, 130, 8, C.workbench, C.outline);

    drawRR(ctx, -28, -48, 96, 116, 6, C.doc, C.outline);
    ctx.fillStyle = "#6366f1";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Договор №847", -22, -38);

    for (var ln = 0; ln < 8; ln++) {
      ctx.fillStyle = "rgba(148,163,184,0.35)";
      ctx.fillRect(-22, -30 + ln * 10, 70 + (ln % 3) * 8, 3);
    }

    if (prg >= 55 && prg < 130) {
      var risks = [
        { y: -22, col: C.riskRed, w: 72 },
        { y: -2, col: C.riskAmber, w: 58 },
        { y: 18, col: C.riskRed, w: 80 },
        { y: 38, col: C.riskGreen, w: 50 }
      ];
      risks.forEach(function (r, i) {
        var pop = Math.min(1, (prg - 58 - i * 12) / 10);
        if (pop > 0) {
          ctx.globalAlpha = pop;
          ctx.fillStyle = r.col;
          ctx.fillRect(-20, r.y, r.w * pop, 4);
          ctx.globalAlpha = 1;
        }
      });
    }

    if (prg >= 125 && prg < 200) {
      drawRR(ctx, 42, -20, 52, 70, 5, "rgba(15,23,42,0.85)", C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Вопросы юристу:", 46, -10);
      var qs = ["Лимит неустойки?", "DPA 152-ФЗ?", "Срок приёмки?"];
      qs.forEach(function (q, i) {
        var on = prg > 132 + i * 14;
        ctx.fillStyle = on ? "#a5b4fc" : "rgba(148,163,184,0.4)";
        ctx.fillText((on ? "• " : "○ ") + q, 46, 2 + i * 14);
      });
    }
  };

  /* Бейджи типов договоров */
  function ContractTypeBadge() {}
  ContractTypeBadge.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 20 || prg > 55) return;
    var badges = ["NDA", "Поставка", "Подряд"];
    badges.forEach(function (b, i) {
      var alpha = prg > 22 + i * 8 ? 1 : 0.3;
      ctx.globalAlpha = alpha;
      drawRR(ctx, -30 + i * 32, -68, 28, 12, 3, "rgba(99,102,241,0.25)", C.outline);
      ctx.fillStyle = "#c7d2fe";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b, -16 + i * 32, -59);
      ctx.globalAlpha = 1;
    });
  };

  /* Шлюз human-in-the-loop */
  function HumanApprovalGate() {
    this.stampScale = 0;
  }
  HumanApprovalGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, 118, -62, 52, 78, 6, "rgba(30,41,59,0.7)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Юрист", 144, -52);

    drawRR(ctx, 124, -38, 40, 48, 4, "rgba(255,255,255,0.06)", C.outline);

    if (prg >= 198) {
      var stampPrg = Math.min(1, (prg - 198) / 16);
      ctx.save();
      ctx.translate(144, -8);
      ctx.rotate(-0.12 * stampPrg);
      ctx.globalAlpha = stampPrg;
      ctx.strokeStyle = C.stamp;
      ctx.lineWidth = 2;
      ctx.strokeRect(-30, -10, 60, 22);
      ctx.fillStyle = C.stamp;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ПОДТВЕРЖДЕНО", 0, 2);
      ctx.restore();
    }

    if (prg >= 215) {
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("→ подпись", 144, 28);
    }
  };

  /* Волна приоритетов — фоновая анимация */
  function RiskPriorityWave() {}
  RiskPriorityWave.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 50 || prg > 140) return;
    for (var i = 0; i < 3; i++) {
      var rad = 20 + i * 14 + Math.sin(frame * 0.06 + i) * 4;
      ctx.strokeStyle = ["rgba(239,68,68,0.2)", "rgba(245,158,11,0.18)", "rgba(34,197,94,0.15)"][i];
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.arc(20, 10, rad, 0, Math.PI * 2);
      ctx.stroke();
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
    var prg = (frame * 0.042) % 240;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -150, y: 42 },
      "2_seo": { x: -70, y: 52 },
      "3_coder": { x: 10, y: 55 },
      "4_designer": { x: 70, y: 52 },
      "5_deployer": { x: 140, y: 42 }
    };
    var tgt = targets[this.role] || { x: 0, y: 50 };

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

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.1) {
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
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new PlaybookRagShelf());
  entities.push(new ContractIntakeCarousel());
  entities.push(new RiskPriorityWave());
  entities.push(new ContractTypeBadge());
  entities.push(new RiskScanBeam());
  entities.push(new ClauseRiskWorkbench());
  entities.push(new HumanApprovalGate());
  entities.push(new Agent(-155, 88, C.agentYellow, "1_architect", 18, [
    "Playbook: 30 правил", "RAG по шаблонам", "Аудит маршрута согласования"
  ]));
  entities.push(new Agent(-78, 92, C.agentGreen, "2_seo", 58, [
    "Тип: договор поставки", "LSI: автопролонгация", "Класс риска: high"
  ]));
  entities.push(new Agent(0, 95, C.agentBlue, "3_coder", 98, [
    "LLM: п. 7.2 штраф", "OCR PDF готов", "RAG: эталон NDA"
  ]));
  entities.push(new Agent(78, 92, C.agentPink, "4_designer", 138, [
    "🔴 3 критичных", "Отчёт для юриста", "Приоритеты 🟡🟢"
  ]));
  entities.push(new Agent(155, 88, C.agentPurple, "5_deployer", 178, [
    "Эскалация в CRM", "Human review UI", "Audit log 152-ФЗ"
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

    var prg = (frame * 0.042) % 240;
    if (prg >= 16 && prg < 16.05) createBubble(-150, 30, "1. Playbook RAG");
    if (prg >= 56 && prg < 56.05) createBubble(-70, 38, "2. Класс договора");
    if (prg >= 96 && prg < 96.05) createBubble(10, 42, "3. Скан рисков");
    if (prg >= 136 && prg < 136.05) createBubble(70, 38, "4. Чек-лист вопросов");
    if (prg >= 176 && prg < 176.05) createBubble(140, 30, "5. Подтверждение юриста");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
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
    requestAnimationFrame(engineloop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineloop);
  } else {
    engineloop();
  }
});
</script>
</section>

<div class="apvd-content">

  <section class="apvd-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="apvd-cnt">
      <div class="apvd-intro-grid nero-ai-reveal">
        <div class="apvd-intro-text">
          <p class="apvd-eyebrow">Лонгрид · ai проверка договоров</p>
          <p><strong>Коротко:</strong> AI-первичная проверка договоров — это B2B LegalTech-внедрение, при котором нейросеть за минуты читает контракт, выделяет рисковые формулировки и формирует чек-лист вопросов для юриста. Финальное решение о подписании всегда остаётся за человеком.</p>
          <p><strong>Определение:</strong> <em>Первичная AI-проверка договора</em> — автоматизированный скрининг текста до полноценной юридической экспертизы. Система не выдаёт юридическое заключение и не подписывает документы; она готовит структурированный отчёт, чтобы юрист сфокусировался на спорных пунктах.</p>
          <p>Nero Network внедряет <strong>ai проверка договоров под ключ</strong>: от аудита процесса согласования до интеграции с CRM, ЭДО и почтой. Ориентир чека — <strong>180–700 тыс. ₽</strong>.</p>
        </div>
        <div class="apvd-intro-kpi" aria-label="Ключевые метрики LegalTech">
          <div class="apvd-kpi-card"><div class="kv">15 млрд ₽</div><div class="kl">рынок LegalTech РФ</div><div class="ks">оценка 2025</div></div>
          <div class="apvd-kpi-card"><div class="kv">60%+</div><div class="kl">компаний инвестировали в LegalTech</div><div class="ks">2024–2025</div></div>
          <div class="apvd-kpi-card"><div class="kv">39–75</div><div class="kl">мин на договор вручную</div><div class="ks">до AI-скрининга</div></div>
          <div class="apvd-kpi-card"><div class="kv">~5 мин</div><div class="kl">первичный AI-скрининг</div><div class="ks">типовой договор</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="apvd-toc-outer">
    <div class="apvd-cnt">
      <nav class="apvd-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем</a>
        <a href="#riski">Риски</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#human-loop">Human-in-the-loop</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="apvd-section" id="zachem">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <span class="apvd-eyebrow">Зачем бизнесу</span>
        <h2>Зачем бизнесу AI-первичная проверка договоров</h2>
      </div>
      <p class="nero-ai-reveal">Российский рынок LegalTech оценивается примерно в <strong>15 млрд ₽</strong> (итоги 2025 года, перспективы 2026 — по данным РБК Компании и АРХАНГЕЛ). Более <strong>60%</strong> компаний в 2024–2025 годах инвестировали в LegalTech больше, чем за предыдущие пять лет. При этом договоры по-прежнему проверяются вручную: юрист читает PDF, ищет штрафы и автопролонгацию, согласует правки с контрагентом — и сделка встаёт.</p>
      <p class="nero-ai-reveal"><strong>Боль клиента</strong> из практики Nero Network и отраслевых кейсов: на один типовой договор уходит от <strong>39 до 75 минут</strong> (кейс «Русклимат» + Embedika Contract, Computerra, август 2025), а при десятках документов в день юридический отдел превращается в узкое горлышко. Типовые риски — односторонние штрафы, размытые сроки, автопролонгация без уведомления — пропускаются при усталости и цейтноте.</p>
      <p class="nero-ai-reveal"><strong>Ai проверка договоров для бизнеса</strong> закрывает именно первичный этап: нейросеть за минуты выделяет рисковые пункты и готовит вопросы юристу. Коммерческий оффер Nero Network: не замена юротдела, а ускорение скрининга перед экспертизой.</p>
      <div class="apvd-card nero-ai-reveal"><h3>Кому подходит: юротдел, предприниматели, агентства, поставщики</h3>
      <div class="nero-ai-reveal"><div class="apvd-table-wrap"><table class="apvd-table"><tbody><tr><th>Сегмент</th><th>Типовая ситуация</th><th>Что даёт AI-скрининг</th></tr><tr><td><strong>Юридический отдел</strong></td><td>50–300 договоров в месяц, нестандартные правки контрагентов</td><td>Очередь с приоритетами: юрист видит только эскалированные риски</td></tr><tr><td><strong>Предприниматель / ИП</strong></td><td>Подряд, поставка, NDA без штатного юриста</td><td>Чек-лист рисков и вопросы перед подписанием</td></tr><tr><td><strong>Агентство / digital</strong></td><td>Договоры с подрядчиками, фрилансерами, SaaS</td><td>Единый playbook по IT-подряду и передаче ПДн</td></tr><tr><td><strong>Поставщик / производитель</strong></td><td>Массовые договоры поставки, скидки, ответственность</td><td>Сравнение с эталонным шаблоном компании через RAG</td></tr></tbody></table></div></div>
      <p class="nero-ai-reveal">Для <strong>малого бизнеса</strong> достаточно пилота на Telegram-боте или форме загрузки: один настроенный playbook на 3–5 типов договоров вместо штатного юриста на полную ставку.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Что даёт первичный AI-скрининг перед юристом</h3>
      <ol class="apvd-ol nero-ai-reveal">
        <li><strong>Скорость ответа контрагенту</strong> — часы вместо дней на типовых договорах (по оценкам Право.ру, при правильных процессах согласование сокращается с двух недель до двух дней, иногда до двух часов).</li>
        <li><strong>Единообразие экспертизы</strong> — одинаковые правила для филиалов и часовых поясов (актуально для «Русклимат»: согласование между городами).</li>
        <li><strong>Меньше пропущенных «ловушек»</strong> — система не устаёт на 15-м договоре за день.</li>
        <li><strong>Прозрачная эскалация</strong> — инициатор сделки получает упрощённую сводку, юрист — полный отчёт с ссылками на пункты.</li>
      </ol>
      <p class="nero-ai-reveal"><strong>Итог блока:</strong> ai проверка договоров для бизнеса — это не «юрист в коробке», а ускоритель первичного анализа с обязательным human-in-the-loop.</p>
      </div>
    </div>
  </section>
  <section class="apvd-section apvd-section-alt" id="riski">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <span class="apvd-eyebrow">Риски</span>
        <h2>Какие рисковые пункты чаще всего пропускают</h2>
      </div>
      <p class="nero-ai-reveal">По открытым чек-листам (PROMAREN, Prime IT, РБК, Embedika) и судебной практике, <strong>ai риски договора</strong> группируются в шесть классов: деньги, сроки, ответственность, расторжение, персональные данные, несоответствие внутренним правилам. Ручная проверка часто «залипает» на очевидных пунктах и пропускает формулировки в приложениях или мелком шрифте.</p>
      <p class="nero-ai-reveal"><strong>Чек-лист рисков договора</strong> — лид-магнит Nero Network: скачайте базовый список и сравните с тем, что выделяет нейросеть на вашем документе.</p>
      <div class="apvd-card nero-ai-reveal"><h3>Поставка, подряд, NDA, аренда — типовые ловушки</h3>
      <div class="nero-ai-reveal"><div class="apvd-table-wrap"><table class="apvd-table"><tbody><tr><th>Тип договора</th><th>Что пропускают чаще всего</th><th>Почему опасно</th></tr><tr><td><strong>Поставка</strong></td><td>Односторонние штрафы, предоплата без защиты, скрытые комиссии</td><td>Потеря маржи при срыве поставки</td></tr><tr><td><strong>Подряд (IT)</strong></td><td>«По мере готовности», размытая приёмка, асимметрия ответственности</td><td>Споры о сроках и объёме работ</td></tr><tr><td><strong>NDA</strong></td><td>Нет фиксированного штрафа, не определён перечень конфиденциальной информации</td><td>Сложно доказать нарушение</td></tr><tr><td><strong>Аренда</strong></td><td>Автопролонгация без уведомления, односторонний отказ без компенсации</td><td>«Залипание» на невыгодных условиях</td></tr></tbody></table></div></div>
      <p class="nero-ai-reveal">РБК отмечает: шаблон договора подряда из интернета «не учитывает ни специфику бизнеса, ни судебную практику» — аргумент в пользу <strong>кастомного playbook</strong> под вашу отрасль, а не только универсального SaaS.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Штрафы, одностороннее расторжение, автопролонгация</h3>
      <p class="nero-ai-reveal">Три «классических» рисковых пункта договора, которые AI выделяет в первую очередь:</p>
      <ol class="apvd-ol nero-ai-reveal">
        <li><strong>Штрафы и неустойка без потолка</strong> — контрагент может требовать неограниченную сумму; в кейсе Siemens + Embedika отдельно прорабатывали финансовые санкции (штрафы, убытки).</li>
        <li><strong>Одностороннее расторжение</strong> — партнёр уходит без компенсации ваших вложений; типично для аренды и SaaS.</li>
        <li><strong>Автопролонгация</strong> — договор продлевается молча, если не отправить уведомление за N дней; ловушка для долгосрочных контрактов.</li>
      </ol>
      <p class="nero-ai-reveal">Нейросеть для юриста в связке с RAG сопоставляет эти формулировки с <strong>эталонным шаблоном</strong> компании и подсвечивает отклонения цветом приоритета: критично / средне / защитные пункты в вашу пользу.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-riski">
        <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Скачайте чек-лист рисков договора</p>
          <p class="ym-cta-block__sub">Базовый список из шести классов рисков — поставка, подряд, NDA, аренда. Сравните с тем, что выделяет AI на вашем документе, и передайте юристу только спорные пункты.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить договор</a>
        </div>
      </aside>
    </div>
  </section>
  <section class="apvd-section" id="kak-rabotaet">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <span class="apvd-eyebrow">Как работает</span>
        <h2>Как работает AI-анализ договора</h2>
      </div>
      <p class="nero-ai-reveal"><strong>Ai анализ договора</strong> в модели Nero Network — это пайплайн, а не «загрузил в ChatGPT». Типовой стек: OCR и парсинг PDF/DOCX → языковая модель (YandexGPT, GigaChat или локальная LLM в on-prem) → RAG по шаблонам договоров и риск-картам → правила playbook → отчёт в CRM или СЭД → эскалация юристу.</p>
      <div class="apvd-card nero-ai-reveal"><h3>Загрузка документа и выделение рисковых формулировок</h3>
      <ol class="apvd-ol nero-ai-reveal">
        <li>Договор поступает из почты, СЭД, CRM или Telegram-бота.</li>
        <li>Система определяет <strong>тип договора</strong> (поставка, подряд, NDA, аренда) и извлекает структуру: стороны, сумма, сроки, ответственность.</li>
        <li>AI сравнивает текст с <strong>риск-картой</strong> и эталонным шаблоном.</li>
        <li>Формируется отчёт с ссылками на пункты договора и, где применимо, статьи ГК РФ.</li>
      </ol>
      <p class="nero-ai-reveal">Конкуренты обещают скорость от 1 до 60 минут (Zekta, JustLex, tab-is). Nero Network ориентируется на <strong>минуты для первичного скрининга</strong> типового договора — с последующей верификацией юристом.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Формирование вопросов и чек-листа для юридического отдела</h3>
      <p class="nero-ai-reveal">На выходе — не готовое заключение, а:</p>
      <p class="nero-ai-reveal">- приоритизированный список рисков (high / medium / low);</p>
      <p class="nero-ai-reveal">- <strong>чек-лист вопросов юристу</strong> («уточнить лимит неустойки», «запросить DPA по 152-ФЗ»);</p>
      <p class="nero-ai-reveal">- черновик замечаний для переговоров с контрагентом;</p>
      <p class="nero-ai-reveal">- упрощённая сводка для инициатора сделки (менеджер, закупщик).</p>
      <p class="nero-ai-reveal">Так работает <strong>ai юридический ассистент</strong> в корпоративном контуре: как у Embedika Contract у «Русклимата» — карта рисков с пояснениями и маршрут согласования между подразделениями.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Ограничения: почему AI не подписывает за вас</h3>
      <div class="nero-ai-reveal"><div class="apvd-table-wrap"><table class="apvd-table"><tbody><tr><th>Делает AI</th><th>Только человек (юрист)</th></tr><tr><td>Первичный скрининг 100% входящих договоров</td><td>Юридическое заключение и решение о подписании</td></tr><tr><td>Выделение 6–7 классов рисков</td><td>Переговоры, коммерческие уступки</td></tr><tr><td>Сравнение с шаблоном и прошлыми версиями</td><td>M&A, госзакупки 44-ФЗ/223-ФЗ (отдельный playbook)</td></tr><tr><td>Черновик вопросов и замечаний</td><td>Проверка галлюцинаций AI (цитаты, ссылки на статьи)</td></tr><tr><td>Сводка для не-юристов</td><td>Обновление playbook при изменении законодательства</td></tr></tbody></table></div></div>
      <p class="nero-ai-reveal">Harvey AI формулирует это так: «The judgment a lawyer brings to interpreting those results in context… the commercial relationship, the negotiation history, the risk appetite of the client» — AI не заменяет интерпретацию в контексте сделки.</p>
      </div>
    </div>
  </section>

<section
  id="apvd-boris-human-review"
  class="abvd-root"
  aria-label="Визуализация human-in-the-loop: юрист подтверждает риски после AI-скрининга"
>
<style>
/* === БОРИС: prefix abvd-, scoped внутри #apvd-boris-human-review === */
#apvd-boris-human-review.abvd-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#apvd-boris-human-review .abvd-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#apvd-boris-human-review .abvd-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 44px rgba(15,23,42,.09),0 0 0 1px rgba(139,92,246,.14);
  min-height:520px;
}
@media(max-width:1023px){
  #apvd-boris-human-review .abvd-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#apvd-boris-human-review .abvd-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #apvd-boris-human-review .abvd-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#apvd-boris-human-review .abvd-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#7c3aed;
  margin:0 0 14px;
}
#apvd-boris-human-review .abvd-ey::before{
  content:'';
  width:18px;height:2px;
  background:#7c3aed;
  border-radius:1px;
}
#apvd-boris-human-review .abvd-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#apvd-boris-human-review .abvd-ul{
  list-style:none;
  margin:0 0 20px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#apvd-boris-human-review .abvd-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#apvd-boris-human-review .abvd-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(124,58,237,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#6d28d9;
  margin-top:1px;
  font-style:normal;
}
#apvd-boris-human-review .abvd-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:20px;
}
#apvd-boris-human-review .abvd-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#apvd-boris-human-review .abvd-pl-r{
  background:rgba(239,68,68,.08);
  color:#b91c1c;
  border:1.5px solid rgba(239,68,68,.22);
}
#apvd-boris-human-review .abvd-pl-v{
  background:rgba(124,58,237,.08);
  color:#5b21b6;
  border:1.5px solid rgba(124,58,237,.22);
}
#apvd-boris-human-review .abvd-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#apvd-boris-human-review .abvd-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0 0 22px;
}
#apvd-boris-human-review .abvd-cta{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  align-self:flex-start;
  padding:12px 22px;
  border-radius:12px;
  font-size:14px;
  font-weight:700;
  text-decoration:none;
  color:#fff;
  background:linear-gradient(135deg,#6366f1 0%,#4f46e5 100%);
  box-shadow:0 4px 14px rgba(79,70,229,.35);
  transition:transform .15s ease,box-shadow .15s ease;
}
#apvd-boris-human-review .abvd-cta:hover{
  transform:translateY(-1px);
  box-shadow:0 6px 20px rgba(79,70,229,.42);
}
#apvd-boris-human-review .abvd-rgt{
  position:relative;
  background:linear-gradient(145deg,#faf5ff 0%,#f5f3ff 35%,#f8fafc 100%);
  min-height:460px;
  overflow:hidden;
}
@media(max-width:1023px){
  #apvd-boris-human-review .abvd-rgt{min-height:400px;}
}
#apvd-lawyer-review-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="abvd-cnt">
  <div class="abvd-card">

    <div class="abvd-lft">
      <span class="abvd-ey">Human-in-the-loop · LegalTech</span>
      <h3 class="abvd-h3">Юрист подтверждает каждый риск — AI не подписывает за вас</h3>
      <ul class="abvd-ul">
        <li><span class="abvd-ic">🔴</span>Критичные пункты (штраф без потолка, одностороннее расторжение) — только после override юриста</li>
        <li><span class="abvd-ic">✓</span>Кнопки «Согласен / Доработка / Отклонить» фиксируются в audit log</li>
        <li><span class="abvd-ic">📋</span>Чек-лист вопросов к контрагенту формируется из подтверждённых рисков</li>
        <li><span class="abvd-ic">👤</span>Финальное решение о подписании — всегда за человеком (тренд 2026)</li>
      </ul>
      <div class="abvd-pills">
        <span class="abvd-pl abvd-pl-r">3 критичных</span>
        <span class="abvd-pl abvd-pl-v">Human review UI</span>
        <span class="abvd-pl abvd-pl-g">Audit log</span>
      </div>
      <p class="abvd-foot">Дальше — как ограничивается автономность AI в договорных процессах →</p>
      <a
        href="<?php echo esc_url(nero_ai_primary_cta_url()); ?>"
        class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent abvd-cta"
        target="_blank"
        rel="noopener noreferrer"
      >Проверить договор</a>
    </div>

    <div class="abvd-rgt">
      <canvas
        id="apvd-lawyer-review-canvas"
        role="img"
        aria-label="Анимация: интерфейс human review — AI передаёт рисковые пункты договора юристу для подтверждения или отклонения"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('apvd-lawyer-review-canvas');
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
    ink:'#0f172a',
    muted:'#64748b',
    paper:'#ffffff',
    paperBdr:'#e2e8f0',
    viol:'#7c3aed',
    violSoft:'rgba(124,58,237,.12)',
    red:'#ef4444',
    redSoft:'rgba(239,68,68,.14)',
    amber:'#f59e0b',
    amberSoft:'rgba(245,158,11,.14)',
    green:'#22c55e',
    greenSoft:'rgba(34,197,94,.14)',
    ai:'#6366f1',
    aiSoft:'rgba(99,102,241,.1)',
    line:'rgba(148,163,184,.35)'
  };

  var RISKS = [
    {lvl:'crit', label:'\u041f. 7.2 \u2014 \u0448\u0442\u0440\u0430\u0444 \u0431\u0435\u0437 \u043f\u043e\u0442\u043e\u043b\u043a\u0430', delay:40},
    {lvl:'med',  label:'\u041f. 12 \u2014 \u0430\u0432\u0442\u043e\u043f\u0440\u043e\u043b\u043e\u043d\u0433\u0430\u0446\u0438\u044f 30 \u0434\u043d.', delay:130},
    {lvl:'ok',   label:'\u041f. 4.1 \u2014 \u043b\u0438\u043c\u0438\u0442 \u043e\u0442\u0432\u0435\u0442\u0441\u0442\u0432\u0435\u043d\u043d\u043e\u0441\u0442\u0438', delay:220}
  ];

  var BTNS = ['\u0421\u043e\u0433\u043b\u0430\u0441\u0435\u043d','\u0414\u043e\u0440\u0430\u0431\u043e\u0442\u043a\u0430','\u041e\u0442\u043a\u043b\u043e\u043d\u0438\u0442\u044c'];
  var LOOP = 680;
  var activeRisk = 0;
  var confirmPhase = 0;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect){ctx.roundRect(x,y,w,h,r);}
    else{
      ctx.moveTo(x+r,y);ctx.arcTo(x+w,y,x+w,y+h,r);
      ctx.arcTo(x+w,y+h,x,y+h,r);ctx.arcTo(x,y+h,x,y,r);
      ctx.arcTo(x,y,x+w,y,r);ctx.closePath();
    }
    if(fill){ctx.fillStyle=fill;ctx.fill();}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1;ctx.stroke();}
  }

  function lvlColor(lvl){
    if(lvl==='crit') return {fg:C.red, bg:C.redSoft};
    if(lvl==='med')  return {fg:C.amber, bg:C.amberSoft};
    return {fg:C.green, bg:C.greenSoft};
  }

  function drawDocPanel(x,y,w,h){
    rr(x,y,w,h,10,C.paper,C.paperBdr,1.2);
    ctx.fillStyle=C.muted;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('\u0414\u043e\u0433\u043e\u0432\u043e\u0440 \u043f\u043e\u0441\u0442\u0430\u0432\u043a\u0438 \u00b7 v3.pdf',x+14,y+22);

    var lines = [
      {t:'\u0421\u0442\u043e\u0440\u043e\u043d\u044b \u0438 \u043f\u0440\u0435\u0434\u043c\u0435\u0442', hi:false},
      {t:'\u0421\u0440\u043e\u043a \u0438 \u043f\u043e\u0440\u044f\u0434\u043e\u043a \u043f\u043e\u0441\u0442\u0430\u0432\u043a\u0438', hi:false},
      {t:'\u041e\u0442\u0432\u0435\u0442\u0441\u0442\u0432\u0435\u043d\u043d\u043e\u0441\u0442\u044c \u0438 \u0448\u0442\u0440\u0430\u0444\u044b', hi:true, lvl:'crit'},
      {t:'\u0420\u0430\u0441\u0442\u043e\u0440\u0436\u0435\u043d\u0438\u0435 \u0438 \u043f\u0440\u043e\u043b\u043e\u043d\u0433\u0430\u0446\u0438\u044f', hi:true, lvl:'med'},
      {t:'\u041f\u0435\u0440\u0435\u0434\u0430\u0447\u0430 \u043f\u0435\u0440\u0441\u043e\u043d\u0430\u043b\u044c\u043d\u044b\u0445 \u0434\u0430\u043d\u043d\u044b\u0445', hi:false},
      {t:'\u041f\u043e\u0434\u0441\u0443\u0434\u043d\u043e\u0441\u0442\u044c', hi:false}
    ];

    var ly = y + 38;
    for(var i=0;i<lines.length;i++){
      var ln = lines[i];
      var pulse = (frame % LOOP);
      var showHi = ln.hi && (
        (ln.lvl==='crit' && pulse>30 && pulse<LOOP-80) ||
        (ln.lvl==='med'  && pulse>120 && pulse<LOOP-80)
      );
      if(showHi){
        var lc = lvlColor(ln.lvl);
        rr(x+10, ly-2, w-20, 18, 4, lc.bg, lc.fg, 1);
      }
      ctx.fillStyle = showHi ? C.ink : 'rgba(100,116,139,.75)';
      ctx.font = showHi ? 'bold 11px Inter,system-ui,sans-serif' : '11px Inter,system-ui,sans-serif';
      ctx.fillText(ln.t, x+16, ly+11);
      ly += 22;
    }

    /* AI scan beam */
    var scanY = y + 36 + ((frame * 1.4) % (h - 70));
    var g = ctx.createLinearGradient(x, scanY-8, x, scanY+8);
    g.addColorStop(0,'rgba(99,102,241,0)');
    g.addColorStop(0.5,'rgba(99,102,241,.22)');
    g.addColorStop(1,'rgba(99,102,241,0)');
    ctx.fillStyle=g;
    ctx.fillRect(x+8, scanY-8, w-16, 16);
  }

  function drawReviewPanel(x,y,w,h){
    rr(x,y,w,h,10,C.paper,C.paperBdr,1.2);

    ctx.fillStyle=C.ink;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.fillText('Human review UI', x+14, y+22);

    ctx.fillStyle=C.ai;
    ctx.font='600 10px Inter,system-ui,sans-serif';
    ctx.fillText('AI \u2192 \u044e\u0440\u0438\u0441\u0442', x+14, y+38);

    var cardY = y + 48;
    var cycle = frame % LOOP;

    for(var r=0;r<RISKS.length;r++){
      var risk = RISKS[r];
      var visible = cycle >= risk.delay;
      var alpha = visible ? Math.min(1, (cycle - risk.delay) / 25) : 0;
      if(!visible) continue;

      var lc = lvlColor(risk.lvl);
      var isActive = (cycle >= risk.delay && cycle < risk.delay + 140) ||
                     (r === activeRisk && cycle > 300);

      ctx.globalAlpha = alpha;
      rr(x+12, cardY, w-24, 52, 8, isActive ? lc.bg : 'rgba(248,250,252,.9)', isActive ? lc.fg : C.line, isActive ? 1.5 : 1);

      ctx.fillStyle = lc.fg;
      ctx.font='bold 9px Inter,system-ui,sans-serif';
      var badge = risk.lvl==='crit' ? 'CRIT' : (risk.lvl==='med' ? 'MED' : 'OK');
      ctx.fillText(badge, x+20, cardY+16);

      ctx.fillStyle = C.ink;
      ctx.font='10px Inter,system-ui,sans-serif';
      ctx.fillText(risk.label, x+20, cardY+32);

      if(isActive && cycle > risk.delay + 50 && cycle < risk.delay + 130){
        var bx = x + 16;
        var by = cardY + 38;
        for(var b=0;b<BTNS.length;b++){
          var sel = (b === 1 && risk.lvl !== 'ok') || (b === 0 && risk.lvl === 'ok');
          var press = sel && (Math.sin(frame*0.12)>0.3);
          rr(bx, by, 58, 18, 5, press ? C.violSoft : '#f1f5f9', sel ? C.viol : C.line, sel ? 1.2 : 1);
          ctx.fillStyle = sel ? C.viol : C.muted;
          ctx.font='8px Inter,system-ui,sans-serif';
          ctx.fillText(BTNS[b], bx+6, by+12);
          bx += 64;
        }
      }

      if(cycle > risk.delay + 120){
        ctx.fillStyle = C.green;
        ctx.font='bold 14px Inter,system-ui,sans-serif';
        ctx.fillText('\u2713', x+w-28, cardY+30);
      }

      cardY += 60;
      ctx.globalAlpha = 1;
    }

    /* Audit log strip */
    var logY = y + h - 36;
    rr(x+12, logY, w-24, 22, 6, C.violSoft, C.viol, 1);
    ctx.fillStyle = C.viol;
    ctx.font='9px Inter,system-ui,sans-serif';
    var logged = Math.min(3, Math.floor(Math.max(0, cycle - 200) / 90));
    ctx.fillText('Audit log: ' + logged + '/3 \u043f\u043e\u0434\u0442\u0432\u0435\u0440\u0436\u0434\u0451\u043d\u043e \u00b7 ' + new Date().toLocaleTimeString('ru-RU',{hour:'2-digit',minute:'2-digit'}), x+20, logY+14);
  }

  function drawLawyerBadge(x,y){
    var bob = Math.sin(frame*0.06)*2;
    rr(x, y+bob, 44, 44, 22, C.violSoft, C.viol, 1.5);
    ctx.fillStyle = C.viol;
    ctx.font='bold 18px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('\u2696', x+22, y+28+bob);
    ctx.textAlign='left';
    ctx.fillStyle = C.ink;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.fillText('\u042e\u0440\u0438\u0441\u0442', x+52, y+18+bob);
    ctx.fillStyle = C.muted;
    ctx.font='10px Inter,system-ui,sans-serif';
    ctx.fillText('\u0424\u0438\u043d\u0430\u043b\u044c\u043d\u044b\u0439 \u043a\u043e\u043d\u0442\u0440\u043e\u043b\u044c', x+52, y+34+bob);
  }

  function drawArrow(x1,y1,x2,y2){
    var prog = 0.5 + 0.5*Math.sin(frame*0.05);
    ctx.strokeStyle = 'rgba(99,102,241,'+(0.25+0.35*prog)+')';
    ctx.lineWidth = 2;
    ctx.setLineDash([5,4]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);
    ctx.lineTo(x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = C.ai;
    ctx.beginPath();
    ctx.moveTo(x2,y2);
    ctx.lineTo(x2-7,y2-4);
    ctx.lineTo(x2-7,y2+4);
    ctx.closePath();
    ctx.fill();
  }

  function tick(){
    frame++;
    ctx.clearRect(0,0,W,H);

    var pad = Math.max(12, W*0.03);
    var gap = 16;
    var panelW = (W - pad*2 - gap) * 0.44;
    var revW   = W - pad*2 - gap - panelW;
    var panelH = H - pad*2;
    var docX = pad;
    var revX = pad + panelW + gap;
    var topY = pad;

    drawDocPanel(docX, topY, panelW, panelH);
    drawReviewPanel(revX, topY, revW, panelH);
    drawArrow(docX + panelW, topY + panelH*0.45, revX, topY + panelH*0.45);
    drawLawyerBadge(revX + revW - 130, topY + 8);

    requestAnimationFrame(tick);
  }

  tick();
})();
</script>
</section>

  <section class="apvd-section apvd-section-alt" id="human-loop">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <span class="apvd-eyebrow">Human-in-the-loop</span>
        <h2>Human-in-the-loop: контроль человека в правовых сценариях 2026</h2>
      </div>
      <p class="nero-ai-reveal">В 2026 году <strong>ai legal tech</strong> строится вокруг принципа <strong>human-in-the-loop</strong> — не как маркетинговый слоган, а как ответ на регуляторные и исследовательские тренды.</p>
      <p class="nero-ai-reveal"><strong>International AI Safety Report 2026</strong> (Executive Summary) предупреждает: «Early evidence suggests that reliance on AI tools can weaken critical thinking skills and encourage 'automation bias', the tendency to trust AI system outputs without sufficient scrutiny.» Рекомендация для политиков — «policies mandating human oversight for critical decisions».</p>
      <p class="nero-ai-reveal"><strong>EU AI Act, статья 14:</strong> человек имеет право <strong>не использовать</strong>, <strong>отклонить или переопределить</strong> вывод системы в high-risk сценариях.</p>
      <p class="nero-ai-reveal">Для договорных процессов это означает: AI готовит отчёт, юрист <strong>подтверждает или отклоняет</strong> каждый риск. Финальное решение остаётся за человеком — это позиционирование Nero Network в отличие от сценариев полной автовалидции (например, у Systeme Electric ИИ нормоконтролирует договоры до 1 млн ₽ без обязательной эскалации).</p>
      <div class="apvd-card nero-ai-reveal"><h3>Где обязателен финальный контроль юриста</h3>
      <p class="nero-ai-reveal">- Нестандартные и крупные сделки.</p>
      <p class="nero-ai-reveal">- Споры с контрагентом, где нужна переговорная позиция.</p>
      <p class="nero-ai-reveal">- Передача персональных данных (152-ФЗ, DPA).</p>
      <p class="nero-ai-reveal">- Иностранное право, арбитраж за рубежом.</p>
      <p class="nero-ai-reveal">- Любой пункт, где AI указал «критично» — без override юриста документ не уходит на подпись.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Как ограничивается автономность AI в договорных процессах</h3>
      <p class="nero-ai-reveal">Архитектура Nero Network:</p>
      <ol class="apvd-ol nero-ai-reveal">
        <li><strong>Human review UI</strong> — юрист видит каждый риск и ставит «согласен / не согласен / нужна доработка».</li>
        <li><strong>Audit log</strong> — кто и когда подтвердил скрининг; защита от слепого доверия AI.</li>
        <li><strong>Обучение команды</strong> — anti-automation-bias: не подписывать, потому что «нейросеть зелёная».</li>
        <li><strong>Границы автономности</strong> — AI не отправляет договор контрагенту и не ставит электронную подпись.</li>
      </ol>
      <p class="nero-ai-reveal">Тренд РФ 2026 (РБК «Российское цифровое право»): переход от статичных шаблонов к <strong>агентным ИИ-экосистемам</strong> (классификация → анализ → черновик позиции), но с обязательной точкой контроля человека.</p>
      </div>
    </div>
  </section>
  <section class="apvd-section" id="vnedrenie">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <span class="apvd-eyebrow">Внедрение</span>
        <h2>Внедрение AI-проверки договоров под ключ</h2>
      </div>
      <p class="nero-ai-reveal"><strong>Внедрение ai проверка договоров</strong> в Nero Network — проектная модель, не подписка на чужой SaaS. Срок пилота: <strong>4–8 недель</strong>, чек <strong>180–700 тыс. ₽</strong>. Ниже — этапы, которые закрывают запрос «как внедрить ai проверка договоров».</p>
      <div class="apvd-card nero-ai-reveal"><h3>Аудит текущего процесса согласования</h3>
      <p class="nero-ai-reveal"><strong>Неделя 1:</strong> анализ 3–5 типов договоров (поставка, подряд, NDA, аренда), маршрута согласования, СЭД/CRM, болевых пунктов из истории споров. Собираются 10–20 эталонных договоров «как должно быть» и 10–20 проблемных из архива.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Пилот на типовых шаблонах договоров</h3>
      <p class="nero-ai-reveal"><strong>Недели 2–4:</strong> MVP-пайплайн — загрузка → OCR → LLM-анализ → отчёт с приоритетами + вопросы юристу → задача в CRM/СЭД. Playbook рисков: <strong>30–50 правил</strong> (штрафы, автопролонгация, подсудность, одностороннее расторжение, передача ПДн, отсутствие лимита неустойки).</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Обучение команды и регламент эскалации к юристу</h3>
      <p class="nero-ai-reveal">Роли: инициатор (загружает договор), юрист (верифицирует риски), админ playbook (обновляет правила). Регламент: что делать при «критично», кто согласует исключения, SLA на ответ контрагенту.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Сроки и этапы внедрения</h3>
      <div class="nero-ai-reveal"><div class="apvd-table-wrap"><table class="apvd-table"><tbody><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr><tr><td>Аудит</td><td>1 неделя</td><td>Карта процесса, список интеграций</td></tr><tr><td>Playbook + MVP</td><td>2–4 недели</td><td>Рабочий скрининг на тестовых договорах</td></tr><tr><td>Интеграции</td><td>3–6 недель</td><td>CRM, СЭД, почта, Telegram</td></tr><tr><td>Пилот 50–100 договоров</td><td>5–8 недель</td><td>Метрики до/после, доработка правил</td></tr><tr><td>Продакшен</td><td>после пилота</td><td>SLA, логирование, дашборд</td></tr></tbody></table></div></div>
      <p class="nero-ai-reveal">Кейс «Русклимат»: проект внедрения ~1 год, первые эффекты через ~6 месяцев; время проверки типового договора <strong>75 → 39 минут</strong> (~×2).</p>
      <p class="nero-ai-reveal">На корпоративном масштабе те же принципы human-in-the-loop и managed-агентов разобраны в материале <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:#a5b4fc;text-decoration:underline;text-underline-offset:3px">KPMG и Claude: уроки AI для бизнеса</a> — цифровые шлюзы можно адаптировать к LegalTech-процессам согласования договоров.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-vnedrenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Запустите пилот AI-проверки за 4–8 недель</p>
          <p class="ym-cta-block__sub">Аудит 3–5 типов договоров, playbook 30–50 правил, интеграция с CRM/СЭД. Ориентир <strong>180–700 тыс. ₽</strong>. Если команда хочет понимать human-in-the-loop и автоматизацию до старта — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить договор</a>
            <a href="#ceny" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Смотреть ориентиры цены →</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="apvd-section apvd-section-alt" id="integracii">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <span class="apvd-eyebrow">Интеграции</span>
        <h2>Интеграции: CRM, ЭДО, 1С и почта</h2>
      </div>
      <p class="nero-ai-reveal"><strong>Интеграция ai проверка договоров с crm</strong> и документооборотом — главный дифференциатор Nero Network перед облачными сервисами вроде JustLex или Zekta. Мы не продаём «ещё один кабинет юриста», а встраиваем скрининг в <strong>вашу воронку сделок</strong>.</p>
      <div class="apvd-card nero-ai-reveal"><h3>Автозапуск проверки из CRM и вложений почты</h3>
      <p class="nero-ai-reveal">- <a href="/vnedrenie-ai-amocrm/" style="color:#a5b4fc;text-decoration:underline;text-underline-offset:3px">amoCRM и Bitrix24</a> — карточка сделки + статус проверки («на скрининге», «у юриста», «одобрено»).</p>
      <p class="nero-ai-reveal">- <strong>Почта (IMAP/Exchange)</strong> — вложение PDF автоматически уходит в пайплайн; на этапе triage полезна <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:#a5b4fc;text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM</a>.</p>
      <p class="nero-ai-reveal">- <strong>Telegram-бот</strong> — для ИП и агентств: загрузил договор, получил риски за минуты.</p>
      <p class="nero-ai-reveal">- <strong>Make.com, n8n</strong> — оркестрация без тяжёлой разработки.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Связка с ЭДО и документооборотом</h3>
      <p class="nero-ai-reveal">- <strong>1С:Документооборот, Directum RX, Тезис</strong> — триггер на этапе «юридическая экспертиза»; учётный контур закрывает <a href="/ai-1c-erp/" style="color:#a5b4fc;text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP под ключ</a>.</p>
      <p class="nero-ai-reveal">- Кейс <strong>Systeme Electric + Directum RX</strong>: нормоконтроль ускорился <strong>в 6 раз</strong>, экономия <strong>2 FTE</strong> (РБК Компании).</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Стек: LLM + RAG по шаблонам договоров</h3>
      <pre class="apvd-flow-diagram nero-ai-reveal" aria-label="Схема пайплайна">Вход (email, СЭД, CRM) → OCR/парсинг → Классификатор типа договора
    → LLM + RAG (шаблоны, playbooks, Confluence/Notion)
    → Движок рисков (правила + LLM) → Отчёт + вопросы юристу
    → Human review UI → Метрики в дашборд</pre>
      <p class="nero-ai-reveal"><strong>Legal tech внедрение</strong> в закрытом контуре: YandexGPT / GigaChat в облаке РФ или Llama/Qwen on-prem — без трансграничной передачи данных (152-ФЗ).</p>
      <p class="nero-ai-reveal"><strong>Сравнение: готовый SaaS vs внедрение Nero Network</strong></p>
      <div class="nero-ai-reveal"><div class="apvd-table-wrap"><table class="apvd-table"><tbody><tr><th>Критерий</th><th>SaaS (Нейроюрист, Zekta, Embedika)</th><th>Внедрение Nero под ключ</th></tr><tr><td>Playbook</td><td>Универсальный или ограниченная настройка</td><td>Ваши шаблоны, ваши риск-карты</td></tr><tr><td>CRM/воронка</td><td>Слабо или отдельно</td><td>Интеграция с amoCRM, Bitrix24, 1С</td></tr><tr><td>Human-in-the-loop</td><td>Заявлен, но процесс клиента не меняется</td><td>Регламент эскалации под вашу оргструктуру</td></tr><tr><td>Цена</td><td>Подписка</td><td>Проект 180–700 тыс. ₽, владение процессом</td></tr><tr><td>On-prem</td><td>Зависит от вендора</td><td>Опция под 152-ФЗ и закрытый контур</td></tr></tbody></table></div></div>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Единый контур: почта → CRM → договор → учёт</h3>
      <p class="nero-ai-reveal">AI-проверка договоров редко живёт изолированно: документ приходит из почты, проходит скрининг, фиксируется в CRM и уходит в СЭД или ERP. Смежные посадочные Nero Network по интеграциям выше закрывают цепочку «письмо → сделка → документ» без ручного копирования и двойного ввода.</p>
      </div>
    </div>
  </section>
  <section class="apvd-section" id="ceny">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <span class="apvd-eyebrow">Стоимость</span>
        <h2>Стоимость и ориентиры чека</h2>
      </div>
      <p class="nero-ai-reveal">Запрос <strong>ai проверка договоров цена</strong> закрывается прозрачной проектной моделью, а не скрытыми тарифами SaaS.</p>
      <div class="apvd-card nero-ai-reveal"><h3>Из чего складывается цена внедрения (180–700 тыс. ₽)</h3>
      <ol class="apvd-ol nero-ai-reveal">
        <li><strong>Аудит и playbook</strong> — сбор правил, эталонных шаблонов, обучающих примеров.</li>
        <li><strong>MVP-пайплайн</strong> — OCR, LLM, RAG, генератор отчётов.</li>
        <li><strong>Интеграции</strong> — CRM, СЭД, почта, Telegram (каждый канал добавляет трудозатраты).</li>
        <li><strong>Пилот и обучение</strong> — 50–100 договоров, метрики, anti-automation-bias тренинг.</li>
        <li><strong>On-prem / 152-ФЗ</strong> — при необходимости закрытого контура.</li>
      </ol>
      <p class="nero-ai-reveal">Ориентир из Google Таблицы Nero Network: <strong>180–700 тыс. ₽</strong> — соответствует пилоту + интеграции, а не только месячной подписке.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Пилот vs полное внедрение</h3>
      <div class="nero-ai-reveal"><div class="apvd-table-wrap"><table class="apvd-table"><tbody><tr><th>Формат</th><th>Для кого</th><th>Ориентир</th></tr><tr><td><strong>Пилот (4–8 недель)</strong></td><td>Малый бизнес, агентство, тест гипотезы</td><td>Нижняя граница чека, 1–2 типа договоров</td></tr><tr><td><strong>Полное внедрение</strong></td><td>Юротдел, retail, производство</td><td>Интеграции CRM+СЭД, 30–50 правил, дашборд</td></tr></tbody></table></div></div>
      <p class="nero-ai-reveal">Сравнение с FTE: Systeme Electric сэкономила <strong>2 штатные единицы</strong>; в retail-кейсе (РБК, имя сети не раскрыто) — экономия ФОТ <strong>200 000 ₽/мес</strong> при сокращении согласования с <strong>5 дней до 2 часов</strong>.</p>
      <p class="nero-ai-reveal"><strong>Разработка ai проверка договоров</strong> и <strong>настройка ai проверка договоров</strong> входят в один проектный контур — отдельно не продаём «коробку без интеграции».</p>
      </div>
    </div>
  </section>
  <section class="apvd-section apvd-section-alt" id="keisy">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <span class="apvd-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения</h2>
      </div>
      <p class="nero-ai-reveal">Запросы <strong>ai проверка договоров кейсы</strong>, <strong>пример внедрения ai проверка договоров</strong> и <strong>ai кейсы внедрения</strong> закрываются верифицируемыми публичными историями. Ниже — российские кейсы с цифрами (источники Артёма) и международный бенчмарк.</p>
      <div class="apvd-card nero-ai-reveal"><h3>Юридический отдел и сокращение времени первичного скрининга</h3>
      <p class="nero-ai-reveal"><strong>«Русклимат» + Embedika Contract</strong> (Computerra, август 2025): 15 юристов, ~75 мин на договор, десятки документов в день. После внедрения: время проверки типового договора <strong>75 → 39 минут</strong> (~×2); выше точность обнаружения рисков; быстрее сделки в продажах.</p>
      <p class="nero-ai-reveal"><strong>ПАО «Сибур Холдинг» + Contract by Embedika</strong>: нестандартные договоры, чек-листы юристов «переложены на язык компьютера». Результат: точность обнаружения рисков <strong>95%</strong>, время проверки <strong>сократилось в 2 раза</strong>.</p>
      <p class="nero-ai-reveal"><strong>Systeme Electric + Directum RX</strong>: ИИ-нормоконтроль договоров — ускорение <strong>в 6 раз</strong>, экономия <strong>2 FTE</strong> (РБК Компании).</p>
      <p class="nero-ai-reveal"><strong>Яндекс «Нейроюрист»</strong> (внутренние замеры, CNews, ноябрь 2025): ~<strong>75%</strong> юристов департамента используют постоянно; анализ договоров <strong>×1,5 быстрее</strong>; ~<strong>40%</strong> рутинных задач автоматизировано. Дифференциатор Nero: внедрение под ключ + CRM, а не только подписка на SaaS.</p>
      </div>
      <div class="apvd-card nero-ai-reveal"><h3>Предприниматель и типовые договоры с контрагентами</h3>
      <p class="nero-ai-reveal"><strong>Retail-сеть</strong> (120 магазинов, 6 регионов; имя в публикации не указано, РБК): 200–300 документов/день, согласование было <strong>5 дней</strong>. AI-агент первичной обработки: <strong>5 дней → 2 часа</strong> (−98%), ошибки <strong>−90%</strong>, экономия ФОТ <strong>200 000 ₽/мес</strong>, режим 24/7. Сценарий: аренда + поставка + подряд — релевантен агентствам и сетям.</p>
      <p class="nero-ai-reveal"><strong>Международный бенчмарк (адаптация для РФ):</strong></p>
      <p class="nero-ai-reveal">- <strong>Talanx + Harvey AI</strong>: проверка ICT-договоров по DORA <strong>2 часа → 15 минут</strong>.</p>
      <p class="nero-ai-reveal">- <strong>Repsol + Harvey AI</strong>: проверка пункта договора <strong>30–60 мин → несколько минут</strong> (>90% экономии времени).</p>
      <p class="nero-ai-reveal">- <strong>Kira (Litera)</strong>: 20–60% экономии времени vs ручной review в due diligence.</p>
      <p class="nero-ai-reveal">Для <strong>автоматизация через ai проверка договоров</strong> в малом бизнесе Nero предлагает пилот на 1–2 типах договоров через Telegram или форму — без годового enterprise-контракта.</p>
      </div>
    </div>
  </section>
  <section class="apvd-section" id="faq">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <span class="apvd-eyebrow">FAQ</span>
        <h2>FAQ по AI-проверке договоров</h2>
      </div>
      <div class="apvd-faq nero-ai-reveal">
        <div class="apvd-faq-item"><div class="apvd-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли доверять AI без юриста?</div><div class="apvd-faq-a">Нет — и мы так не позиционируем продукт. AI Safety Report 2026 описывает automation bias: склонность доверять выводу системы без проверки. Первичный скрининг + обязательная верификация юристом + audit log — стандарт архитектуры Nero Network.</div></div>
        <div class="apvd-faq-item"><div class="apvd-faq-q" role="button" tabindex="0" aria-expanded="false">Какие форматы договоров поддерживаются?</div><div class="apvd-faq-a">PDF, DOCX, сканы (через OCR). Типы: поставка, подряд, NDA, аренда, услуги, SaaS. Нестандартные M&amp;A и госзакупки 44-ФЗ/223-ФЗ — по отдельному playbook.</div></div>
        <div class="apvd-faq-item"><div class="apvd-faq-q" role="button" tabindex="0" aria-expanded="false">Соблюдается ли 152-ФЗ?</div><div class="apvd-faq-a">Да, при on-prem или российском облаке без трансграничной передачи. Договоры обрабатываются в контуре клиента; RAG — только по вашим шаблонам и согласованной нормативке.</div></div>
        <div class="apvd-faq-item"><div class="apvd-faq-q" role="button" tabindex="0" aria-expanded="false">Чем это отличается от КонсультантаПлюс / Гаранта?</div><div class="apvd-faq-a">СПС — справочная система. Ai проверка договоров сравнивает входящий договор контрагента с вашим playbook, а не ищет статью вручную. Яндекс Нейроюрист интегрирован с Гарантом; Nero строит аналогичный слой под ваш процесс и CRM.</div></div>
        <div class="apvd-faq-item"><div class="apvd-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит и сколько длится внедрение?</div><div class="apvd-faq-a">Ориентир: 180–700 тыс. ₽, пилот 4–8 недель. Точная смета — после аудита 3–5 типов договоров и списка интеграций.</div></div>
        <div class="apvd-faq-item"><div class="apvd-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли ai проверка договоров для малого бизнеса?</div><div class="apvd-faq-a">Да. Пилот на Telegram-боте или форме загрузки, 1 настроенный playbook на типовые договоры с подрядчиками и поставщиками — без штатного юриста на полную ставку.</div></div>
        <div class="apvd-faq-item"><div class="apvd-faq-q" role="button" tabindex="0" aria-expanded="false">Заменит ли AI юристов?</div><div class="apvd-faq-a">Нет. Кейсы показывают ускорение рутины (×2, ×6), а не сокращение экспертизы на нестандартных сделках. Юрист нужен для заключения, переговоров и ответственности перед бизнесом.</div></div>
        <div class="apvd-faq-item"><div class="apvd-faq-q" role="button" tabindex="0" aria-expanded="false">Как начать: CTA «Проверить договор»</div><div class="apvd-faq-a">Оставьте заявку или загрузите тестовый договор. Получите чек-лист рисков договора и демо-скрининг. Обсудим пилот и интеграции под ваш CRM/СЭД.</div></div>
      </div>
    </div>
  </section>

  <section class="apvd-section apvd-section-alt" id="itog">
    <div class="apvd-cnt">
      <div class="apvd-sh nero-ai-reveal">
        <h2>Итог</h2>
        <p>AI-первичная проверка договоров ускоряет скрининг, снижает риск пропуска типовых ловушек и встраивается в CRM и ЭДО. Финальное решение остаётся за юристом — в соответствии с трендом human-in-the-loop 2026. Nero Network внедряет решение под ключ: playbook, интеграции, обучение, пилот с метриками.</p>
      </div>
    </div>
  </section>

  <section class="apvd-section" id="cta-final-wrap">
    <div class="apvd-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы ускорить первичную проверку договоров?</p>
          <p class="ym-cta-block__sub">Загрузите тестовый договор — получите демо-скрининг рисков и чек-лист вопросов для юриста. Финальное решение о подписании остаётся за человеком.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить договор</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Ответы на вопросы →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>


<?php
$apvd_page_url = trailingslashit( get_permalink() );
$apvd_site_url = trailingslashit( home_url( '/' ) );
$apvd_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$apvd_schema   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => $apvd_site_url . '#organization',
            'name'  => $apvd_brand,
            'url'   => $apvd_site_url,
        ],
        [
            '@type'     => 'WebSite',
            '@id'       => $apvd_site_url . '#website',
            'url'       => $apvd_site_url,
            'name'      => $apvd_brand,
            'publisher' => [ '@id' => $apvd_site_url . '#organization' ],
        ],
        [
            '@type'       => 'WebPage',
            '@id'         => $apvd_page_url . '#webpage',
            'url'         => $apvd_page_url,
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'isPartOf'    => [ '@id' => $apvd_site_url . '#website' ],
            'about'       => [ '@id' => $apvd_site_url . '#organization' ],
        ],
        [
            '@type'           => 'BreadcrumbList',
            '@id'             => $apvd_page_url . '#breadcrumb',
            'itemListElement' => [
                [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $apvd_site_url ],
                [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $apvd_page_url ],
            ],
        ],
        [
            '@type'        => 'Service',
            '@id'          => $apvd_page_url . '#service',
            'name'         => $page_seo_title,
            'description'  => $page_seo_description,
            'url'          => $apvd_page_url,
            'provider'     => [ '@id' => $apvd_site_url . '#organization' ],
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => $apvd_page_url . '#faq',
            'mainEntity' => [
                [ '@type' => 'Question', 'name' => 'Можно ли доверять AI без юриста?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет — и мы так не позиционируем продукт. AI Safety Report 2026 описывает automation bias: склонность доверять выводу системы без проверки. Первичный скрининг + обязательная верификация юристом + audit log — стандарт архитектуры Nero Network.' ] ],
                [ '@type' => 'Question', 'name' => 'Какие форматы договоров поддерживаются?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'PDF, DOCX, сканы (через OCR). Типы: поставка, подряд, NDA, аренда, услуги, SaaS. Нестандартные M&A и госзакупки 44-ФЗ/223-ФЗ — по отдельному playbook.' ] ],
                [ '@type' => 'Question', 'name' => 'Соблюдается ли 152-ФЗ?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, при on-prem или российском облаке без трансграничной передачи. Договоры обрабатываются в контуре клиента; RAG — только по вашим шаблонам и согласованной нормативке.' ] ],
                [ '@type' => 'Question', 'name' => 'Чем это отличается от КонсультантаПлюс / Гаранта?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'СПС — справочная система. Ai проверка договоров сравнивает входящий договор контрагента с вашим playbook, а не ищет статью вручную. Яндекс Нейроюрист интегрирован с Гарантом; Nero строит аналогичный слой под ваш процесс и CRM.' ] ],
                [ '@type' => 'Question', 'name' => 'Сколько стоит и сколько длится внедрение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир: 180–700 тыс. ₽, пилот 4–8 недель. Точная смета — после аудита 3–5 типов договоров и списка интеграций.' ] ],
                [ '@type' => 'Question', 'name' => 'Подходит ли ai проверка договоров для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Пилот на Telegram-боте или форме загрузки, 1 настроенный playbook на типовые договоры с подрядчиками и поставщиками — без штатного юриста на полную ставку.' ] ],
                [ '@type' => 'Question', 'name' => 'Заменит ли AI юристов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. Кейсы показывают ускорение рутины (×2, ×6), а не сокращение экспертизы на нестандартных сделках. Юрист нужен для заключения, переговоров и ответственности перед бизнесом.' ] ],
                [ '@type' => 'Question', 'name' => 'Как начать: CTA «Проверить договор»', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Оставьте заявку или загрузите тестовый договор. Получите чек-лист рисков договора и демо-скрининг. Обсудим пилот и интеграции под ваш CRM/СЭД.' ] ],
            ],
        ],
    ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $apvd_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>
</main>

<!-- AD_BANNER: skipped -->

<?php nero_ai_echo_theme_scripts(); ?>
<script>
document.querySelectorAll('.apvd-faq-q').forEach(function(q){
  function toggle(){ q.parentElement.classList.toggle('open'); q.setAttribute('aria-expanded', q.parentElement.classList.contains('open')?'true':'false'); }
  q.addEventListener('click', toggle);
  q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); toggle(); }});
});
</script>
<?php get_footer(); ?>
