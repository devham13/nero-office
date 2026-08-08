<?php
/**
 * Template Name: AI для производства: внедрение под ключ, кейсы и цена
 * Description: Внедрение AI для производства — контроль качества, PdM, OEE-аналитика на заводе. Кейсы, цена, аудит процессов под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для производства: внедрение под ключ, кейсы и цена';
$page_seo_description = 'Внедрим AI для производства: контроль качества, предиктивное техобслуживание и аналитика на заводе. Снижаем простои и брак. Кейсы, цена, аудит процессов — под ключ.';

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
    ['label' => 'Задачи AI',  'href' => '#zadachi'],
    ['label' => 'Внедрение',  'href' => '#etapy'],
    ['label' => 'Цена',       'href' => '#ceny'],
    ['label' => 'Кейсы',      'href' => '#keisy'],
    ['label' => 'Отрасли',    'href' => '#otrasli'],
    ['label' => 'Интеграция', 'href' => '#integraciya'],
    ['label' => 'FAQ',        'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Найти эффект AI на производстве';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#zadachi';

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


.aip-hero-proizvodstvo {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}
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

.aip-content{
  --aip-bg:#050711;--aip-bg2:#080b17;--aip-bg3:#0a0e1c;
  --aip-surface:rgba(255,255,255,.072);--aip-surface2:rgba(255,255,255,.108);
  --aip-text:#e6edf7;--aip-muted:#9aa8bd;--aip-soft:#c7d2e5;--aip-heading:#fff;
  --aip-border:rgba(255,255,255,.10);--aip-border-s:rgba(255,255,255,.18);
  --aip-accent:#f5c518;--aip-violet:#8b5cf6;--aip-green:#22c55e;--aip-cyan:#79f2ff;
  --aip-btn-from:#2563eb;--aip-btn-to:#7c3aed;
  --aip-shadow:0 24px 72px rgba(0,0,0,.4);
  --aip-r:18px;--aip-r-lg:24px;--aip-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aip-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aip-content *,.aip-content *::before,.aip-content *::after{box-sizing:border-box;}
.aip-content a{color:inherit;text-decoration:none;}
.aip-content p{color:var(--aip-muted);line-height:1.72;margin:0 0 1em;}
.aip-content p:last-child{margin-bottom:0;}
.aip-content h2,.aip-content h3,.aip-content h4{color:var(--aip-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aip-content strong{color:var(--aip-soft);}
.aip-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aip-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aip-muted);font-size:14.5px;line-height:1.65;}
.aip-content ul li::before{content:'›';position:absolute;left:0;color:var(--aip-accent);font-weight:700;}
.aip-cnt{width:min(var(--aip-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aip-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aip-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aip-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aip-sh.aip-left{margin-left:0;text-align:left;}
.aip-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aip-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aip-sh.aip-left p{margin-left:0;}
.aip-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aip-accent);margin-bottom:14px;}
.aip-gt{background:linear-gradient(92deg,#fff 0%,var(--aip-accent) 44%,var(--aip-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.aip-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aip-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aip-intro-text{position:relative;padding-left:20px;}
.aip-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aip-accent),var(--aip-violet));}
.aip-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--aip-muted);margin-bottom:1em;}
.aip-intro-text p:last-child{margin-bottom:0;color:var(--aip-soft);}
.aip-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aip-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.aip-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aip-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.aip-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aip-muted);line-height:1.4;}
.aip-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.aip-intro-grid{grid-template-columns:1fr;gap:36px;}.aip-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.aip-intro-kpi{grid-template-columns:1fr 1fr;}}
.aip-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aip-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aip-toc a{display:inline-block;padding:9px 18px;background:var(--aip-surface);border:1px solid var(--aip-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aip-muted);transition:border-color .2s,color .2s,background .2s;}
.aip-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--aip-accent);background:rgba(245,197,24,.08);}
.aip-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aip-border);border-radius:var(--aip-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.aip-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.aip-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aip-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.aip-grid-2,.aip-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.aip-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aip-grid-3{grid-template-columns:1fr;}}
.aip-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--aip-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.aip-scenario:last-child{margin-bottom:0;}
.aip-scenario:hover{border-color:rgba(245,197,24,.3);}
.aip-scenario h3{font-size:17px;margin-bottom:8px;}
.aip-scenario p{font-size:14.5px;margin:0 0 .6em;}
.aip-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aip-table{width:100%;border-collapse:collapse;font-size:14px;}
.aip-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--aip-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
.aip-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aip-text);vertical-align:top;}
.aip-table tr:last-child td{border-bottom:none;}
.aip-table tr:hover td{background:rgba(255,255,255,.03);}
.aip-timeline{position:relative;padding-left:40px;}
.aip-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aip-accent),var(--aip-violet));opacity:.35;border-radius:2px;}
.aip-tl-item{position:relative;margin-bottom:32px;}
.aip-tl-item:last-child{margin-bottom:0;}
.aip-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aip-accent);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.aip-tl-item h3{font-size:17px;margin-bottom:8px;}
.aip-tl-item p{font-size:14.5px;margin:0;}
.aip-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.aip-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aip-case-grid{grid-template-columns:1fr;}}
.aip-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.aip-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.aip-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aip-green);margin-bottom:10px;}
.aip-case-card h3{font-size:16px;margin-bottom:14px;}
.aip-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aip-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.aip-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aip-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.aip-faq-q::after{content:'▾';font-size:13px;color:var(--aip-accent);flex-shrink:0;transition:transform .25s;}
.aip-faq-item.open .aip-faq-q::after{transform:rotate(180deg);}
.aip-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--aip-muted);line-height:1.72;}
.aip-faq-item.open .aip-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--aip-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aip-btn-from),var(--aip-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--aip-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--aip-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

.aip-ol { margin: 0 0 1em; padding-left: 1.4em; color: var(--aip-muted); line-height: 1.72; }
.aip-ol li { margin-bottom: .4em; }
.aip-code {
  display: block; padding: 16px 18px; margin: 16px 0; border-radius: 14px;
  background: rgba(0,0,0,.35); border: 1px solid rgba(255,255,255,.1);
  font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-size: 13px;
  line-height: 1.55; color: var(--aip-soft); overflow-x: auto; white-space: pre-wrap;
}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlia-proizvodstva-page" role="main" tabindex="-1">

<section class="nero-ai-hero aip-hero-proizvodstvo" id="aip-hero-proizvodstvo" aria-labelledby="aip-hero-title">
<style>
/* ── Hero ai-dlia-proizvodstva: самодостаточные стили (без CSS темы) ── */
.aip-hero-proizvodstvo {
  --aip-gold: #f5c518;
  --aip-cyan: #79f2ff;
  --aip-violet: #8b5cf6;
  --aip-green: #22c55e;
  --aip-amber: #f59e0b;
  --aip-text: #e6edf7;
  --aip-muted: #9aa8bd;
  --aip-soft: #c7d2e5;
  --aip-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background:
    radial-gradient(ellipse 70% 55% at 18% 12%, rgba(121, 242, 255, 0.09), transparent 58%),
    radial-gradient(ellipse 55% 45% at 82% 18%, rgba(245, 197, 24, 0.11), transparent 62%),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.aip-hero-proizvodstvo::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 42% 24%, #000 0%, transparent 74%);
  opacity: .5;
  pointer-events: none;
  z-index: 0;
}
.aip-hero-proizvodstvo .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aip-hero-proizvodstvo .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aip-hero-proizvodstvo .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aip-hero-proizvodstvo .nero-ai-gradient-text {
  display: block;
  margin-top: .12em;
  background: linear-gradient(92deg, #fff 0%, var(--aip-gold) 38%, var(--aip-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aip-hero-proizvodstvo .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--aip-gold) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aip-hero-proizvodstvo .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aip-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aip-hero-proizvodstvo .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aip-hero-proizvodstvo .nero-ai-badge {
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
.aip-hero-proizvodstvo .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aip-hero-proizvodstvo .nero-ai-btn {
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
.aip-hero-proizvodstvo .nero-ai-btn:hover { transform: translateY(-2px); }
.aip-hero-proizvodstvo .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--aip-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.aip-hero-proizvodstvo .nero-ai-btn-secondary {
  color: var(--aip-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aip-hero-proizvodstvo .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aip-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.aip-hero-proizvodstvo .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aip-hero-proizvodstvo .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aip-hero-proizvodstvo .nero-ai-dots { display: flex; gap: 7px; }
.aip-hero-proizvodstvo .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aip-hero-proizvodstvo .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aip-hero-proizvodstvo .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aip-hero-proizvodstvo .nero-ai-dot:nth-child(3) { background: #34d399; }
.aip-hero-proizvodstvo .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aip-hero-proizvodstvo .nero-ai-window-body { padding: 16px; }
.aip-hero-proizvodstvo .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aip-hero-proizvodstvo .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aip-hero-proizvodstvo .nero-ai-live-pill {
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
.aip-hero-proizvodstvo .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aipPulse 1.6s infinite;
}
@keyframes aipPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aip-hero-proizvodstvo .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aip-hero-proizvodstvo .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aip-hero-proizvodstvo .nero-ai-metric span {
  display: block;
  color: var(--aip-muted);
  font-size: 11px;
  font-weight: 700;
}
.aip-hero-proizvodstvo .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aip-hero-proizvodstvo .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aip-hero-proizvodstvo .aip-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 50% 80%, rgba(121,242,255,.06), rgba(6,10,24,.94) 68%);
}
.aip-hero-proizvodstvo #aip-proizvodstvo-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aip-hero-proizvodstvo .nero-ai-task-stream { display: grid; gap: 8px; }
.aip-hero-proizvodstvo .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aip-hero-proizvodstvo .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aip-cyan);
  font-size: 11px;
  font-weight: 800;
}
.aip-hero-proizvodstvo .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aip-hero-proizvodstvo .nero-ai-task span {
  color: var(--aip-muted);
  font-size: 11px;
}
.aip-hero-proizvodstvo .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aip-hero-proizvodstvo .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.aip-hero-proizvodstvo .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .aip-hero-proizvodstvo .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aip-hero-proizvodstvo .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aip-hero-proizvodstvo .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aip-hero-proizvodstvo .nero-ai-window-body { padding: 12px; }
  .aip-hero-proizvodstvo .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aip-hero-proizvodstvo .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Производство · AI под ключ</p>
      <h1 id="aip-hero-title">AI для производства:<span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Снижаем простои и брак, автоматизируем отчёты и предиктивное техобслуживание на вашем заводе</p>
      <ul class="nero-ai-badges" aria-label="Ключевые модули">
        <li class="nero-ai-badge">PdM</li>
        <li class="nero-ai-badge">автоОТК</li>
        <li class="nero-ai-badge">OEE-аналитика</li>
        <li class="nero-ai-badge">on-prem</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#zadachi">Какие задачи закрывает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация производственного AI-центра">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Производственный AI-центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Простои сегодня</span>
              <strong>2,4 ч</strong>
              <small>−18% к вчера</small>
            </div>
            <div class="nero-ai-metric">
              <span>Брак на линии</span>
              <strong>−32%</strong>
              <small>inline CV-контроль</small>
            </div>
            <div class="nero-ai-metric">
              <span>OEE смены</span>
              <strong>87%</strong>
              <small>автосводка мастеру</small>
            </div>
            <div class="nero-ai-metric">
              <span>Алертов PdM</span>
              <strong>3</strong>
              <small>горизонт 12 дней</small>
            </div>
          </div>

          <div class="aip-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aip-proizvodstvo-hero-canvas" role="img" aria-label="Анимация: телеметрия с линии поступает в цифровой двойник, AI предсказывает отказ и создаёт заявку ТОиР"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий производственного AI">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CV</span>
              <div><strong>Дефект сварки отбракован</strong><span>Computer vision · линия №3 · без остановки</span></div>
              <span class="nero-ai-status">inline</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">PdM</span>
              <div><strong>Предупреждение: насос B-12</strong><span>Вибрация +18% · прогноз отказа за 12 дней</span></div>
              <span class="nero-ai-status nero-ai-status--amber">alert</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">OEE</span>
              <div><strong>Сводка смены в Telegram</strong><span>План-факт, топ-причины простоев · 18:00</span></div>
              <span class="nero-ai-status">отправлено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Аномалия режима плавки</strong><span>anomaly detection → review технолога</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="aip-content nero-ai-longread">

  <section class="aip-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aip-cnt">
      <div class="aip-intro-grid nero-ai-reveal">
        <div class="aip-intro-text">
          <p class="aip-eyebrow">Производство · AI под ключ</p>
          <p><strong>Коротко:</strong> AI для производства — это не чат-бот в офисе, а прикладные модели поверх данных цеха: датчиков SCADA, MES, ERP, камер на линии и журналов ТОиР. Они снижают простои, брак и ручную отчётность — без остановки конвейера. Nero Network внедряет такие решения под ключ: от аудита до пилота на одном участке и тиража на завод.</p>
          <p>Простой часа линии, бракованная партия, сводка OEE в Excel к концу смены — знакомые боли техдиректора и операционного директора. По данным ЦИПР 2026, более 50% российских предприятий уже вовлечены во внедрение ИИ, но лишь часть дошла до промышленной эксплуатации. В обрабатывающей промышленности 32% уже используют ИИ, ещё 18% планируют внедрение в течение трёх лет. На корпоративном масштабе похожие программы уже разбирали в материале <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--aip-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a>. Окно для измеримого эффекта на болезненном участке открыто прямо сейчас.</p>
        </div>
        <div class="aip-intro-kpi" aria-label="Ключевые метрики производства">
          <div class="aip-kpi-card"><div class="kv">2,4 ч</div><div class="kl">простои смены</div><div class="ks">типичная боль</div></div>
          <div class="aip-kpi-card"><div class="kv">−32%</div><div class="kl">брак на линии</div><div class="ks">после автоОТК</div></div>
          <div class="aip-kpi-card"><div class="kv">Excel</div><div class="kl">ручные отчёты</div><div class="ks">к 18:00</div></div>
          <div class="aip-kpi-card"><div class="kv">32%</div><div class="kl">уже используют ИИ</div><div class="ks">обрабатывающая отрасль</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aip-toc-outer">
    <div class="aip-cnt">
      <nav class="aip-toc" aria-label="Оглавление статьи">
        <a href="#zadachi">Задачи AI</a>
        <a href="#etapy">Внедрение</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#otrasli">Отрасли</a>
        <a href="#integraciya">Интеграция</a>
        <a href="#faq">FAQ</a>
        <a href="#zakazat">Заказать</a>
      </nav>
    </div>
  </div>

  <section class="aip-section" id="zadachi">
    <div class="aip-cnt">
      <div class="aip-sh nero-ai-reveal">
        <span class="aip-eyebrow">Задачи на заводе</span>
        <h2>Что даёт AI на производстве и какие задачи закрывает</h2>
        <p><strong>Определение:</strong> AI для производства — модели ML, computer vision и агентные системы, которые работают с телеметрией оборудования, видеопотоками линий и данными MES/ERP. Цель — предсказывать отказы, находить дефекты, автоматизировать отчёты и рекомендовать действия технологам.</p>
      </div>

      <div class="aip-table-wrap nero-ai-reveal" role="region" aria-label="Боль, решение и эффект">
        <table class="aip-table">
          <thead><tr><th>Боль</th><th>Решение AI</th><th>Типичный эффект</th></tr></thead>
          <tbody>
            <tr><td>Внеплановые простои</td><td>Предиктивное ТО (PdM), anomaly detection</td><td>−30–50% внеплановых остановок</td></tr>
            <tr><td>Брак и рекламации</td><td>Computer vision / автоОТК на линии</td><td>−30–40% брака на участке</td></tr>
            <tr><td>Ручные отчёты</td><td>Производственная аналитика, OEE-дашборды</td><td>Автосводки вместо Excel</td></tr>
            <tr><td>Слабый прогноз нагрузки</td><td>ML-прогнозирование спроса и режимов</td><td>План-факт без «догадок мастера»</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aip-grid-3 nero-ai-reveal nero-ai-delay-1">
        <article class="aip-card" id="qc">
          <h3>Контроль качества и computer vision на линии</h3>
          <p>Нейросети для производства в QC работают как «второй глаз» на конвейере: камеры снимают каждую единицу, модель классифицирует дефекты в реальном времени, система отбраковывает брак без остановки линии.</p>
          <ul>
            <li><strong>Nord Clan ML Sense</strong> — стеклотара: точность 100%, дефект от 1×1 мм, окупаемость 6–12 мес.</li>
            <li><strong>Lenta tech + «Кордиант»</strong> — шины на конвейере, точность &gt;95%, +15 000 шин/год.</li>
            <li><strong>Иж-Рэст + Zool.ai</strong> — MES и 1С: брак −30%, простои −15–20%, +20% за 6 мес.</li>
          </ul>
        </article>
        <article class="aip-card" id="pdm">
          <h3>Предиктивное техобслуживание и снижение простоев</h3>
          <p>Predictive maintenance AI анализирует вибрацию, температуру, ток и давление. Модель предупреждает об отказе за дни — не за минуты до аварии.</p>
          <ul>
            <li><strong>Северсталь</strong> — прогноз за 5–20 дней, 4,53 млн ₽ за полугодие на одном агрегате.</li>
            <li><strong>Unilever</strong> — 50 000+ датчиков: $2,3 млн/год, окупаемость &lt;7 мес.</li>
            <li><strong>Графитовое производство</strong> — простои −80% (~120 млн ₽/год).</li>
          </ul>
          <p><em>Важно:</em> PdM работает, если алерт запускает конкретное действие в поле — AI предупреждает, человек решает об останове.</p>
        </article>
        <article class="aip-card" id="oee">
          <h3>Производственная аналитика вместо ручных отчётов</h3>
          <p>AI собирает OEE, план-факт, аномалии режимов и топ-причины простоев в автоматические сводки для мастера и техдиректора.</p>
          <ul>
            <li><strong>Кольская ГМК</strong> — ИИ-флотация: +0,73 п.п. извлечения никеля.</li>
            <li><strong>IBS + химхолдинг</strong> — рекомендации технологам: +1–4% выработки, ~266 млн ₽/год.</li>
          </ul>
          <p>Тренд 2026: агентный ИИ в промышленности — отчётность, forecasting, maintenance — с human-in-the-loop для критических решений.</p>
        </article>
      </div>
    </div>
  </section>

<section id="ai-dlia-proizvodstva-boris-block" class="aipb-root" aria-label="Анимация: поток данных с линии через edge-AI к PdM, QC и OEE-аналитике">
<style>
/* === БОРИС: prefix aipb-, scoped внутри #ai-dlia-proizvodstva-boris-block === */
#ai-dlia-proizvodstva-boris-block.aipb-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-dlia-proizvodstva-boris-block .aipb-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-dlia-proizvodstva-boris-block .aipb-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-dlia-proizvodstva-boris-block .aipb-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-dlia-proizvodstva-boris-block .aipb-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlia-proizvodstva-boris-block .aipb-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-dlia-proizvodstva-boris-block .aipb-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#b45309;
  margin:0 0 14px;
}
#ai-dlia-proizvodstva-boris-block .aipb-ey::before{
  content:'';
  width:18px;height:2px;
  background:#f5c518;
  border-radius:1px;
}
#ai-dlia-proizvodstva-boris-block .aipb-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-dlia-proizvodstva-boris-block .aipb-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-dlia-proizvodstva-boris-block .aipb-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-dlia-proizvodstva-boris-block .aipb-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(245,197,24,.14);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#b45309;
  margin-top:1px;
  font-style:normal;
}
#ai-dlia-proizvodstva-boris-block .aipb-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-dlia-proizvodstva-boris-block .aipb-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-dlia-proizvodstva-boris-block .aipb-pl-y{
  background:rgba(245,197,24,.12);
  color:#92400e;
  border:1.5px solid rgba(245,197,24,.35);
}
#ai-dlia-proizvodstva-boris-block .aipb-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-dlia-proizvodstva-boris-block .aipb-pl-c{
  background:rgba(121,242,255,.1);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.28);
}
#ai-dlia-proizvodstva-boris-block .aipb-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-dlia-proizvodstva-boris-block .aipb-rgt{
  position:relative;
  background:linear-gradient(135deg,#fffbeb 0%,#fef9c3 18%,#ecfeff 55%,#f0fdf4 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-dlia-proizvodstva-boris-block .aipb-rgt{min-height:380px;}
}
#aipb-factory-edge-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="aipb-cnt">
  <div class="aipb-card">

    <div class="aipb-lft">
      <span class="aipb-ey">Данные цеха · Edge AI</span>
      <h3 class="aipb-h3">Датчики и камеры на линии — в один поток: PdM, автоОТК и OEE без остановки</h3>
      <ul class="aipb-ul">
        <li><span class="aipb-ic">◎</span>SCADA и IIoT отдают вибрацию, температуру и ток с агрегатов в edge-шлюз on-prem</li>
        <li><span class="aipb-ic">▣</span>Computer vision сканирует каждую единицу на конвейере — дефект отбраковывается inline</li>
        <li><span class="aipb-ic">⚡</span>AI-модуль ранжирует алерты: PdM за 5–20 дней, аномалия режима, сводка OEE в Telegram</li>
        <li><span class="aipb-ic">→</span>Человек принимает решение об останове — human-in-the-loop на пилоте</li>
      </ul>
      <div class="aipb-pills">
        <span class="aipb-pl aipb-pl-y">PdM −45% ТО</span>
        <span class="aipb-pl aipb-pl-g">QC 100% inline</span>
        <span class="aipb-pl aipb-pl-c">OPC UA · on-prem</span>
      </div>
      <p class="aipb-foot">Дальше — этапы внедрения AI для производства под ключ и сроки пилота →</p>
    </div>

    <div class="aipb-rgt">
      <canvas
        id="aipb-factory-edge-canvas"
        aria-label="Анимация: телеметрия с производственной линии поступает в edge-AI, формируются алерты PdM, отбраковка CV и сводка OEE"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('aipb-factory-edge-canvas');
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
    line:'#334155',
    belt:'#475569',
    beltRoll:'#1e293b',
    unit:'#cbd5e1',
    unitOk:'#86efac',
    unitBad:'#fca5a5',
    sensor:'#f5c518',
    sensorGlow:'rgba(245,197,24,.25)',
    cam:'#79f2ff',
    camGlow:'rgba(121,242,255,.22)',
    edge:'#8b5cf6',
    edgeGlow:'rgba(139,92,246,.18)',
    edgePanel:'#1e1b4b',
    data:'#38bdf8',
    alert:'#f59e0b',
    alertRed:'#ef4444',
    ok:'#22c55e',
    grid:'rgba(15,23,42,.06)',
    bubble:'#ffffff'
  };

  var LOOP = 900;
  var units = [];
  for (var i = 0; i < 6; i++) {
    units.push({x: i * 0.18 - 0.1, bad: i === 3, scanned: false});
  }

  var packets = [];
  var alerts = [];
  var wavePts = [];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle = fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
  }

  function drawGrid(){
    ctx.strokeStyle = C.grid;
    ctx.lineWidth = 1;
    for (var gx = 0; gx < W; gx += 32){
      ctx.beginPath(); ctx.moveTo(gx,0); ctx.lineTo(gx,H); ctx.stroke();
    }
    for (var gy = 0; gy < H; gy += 32){
      ctx.beginPath(); ctx.moveTo(0,gy); ctx.lineTo(W,gy); ctx.stroke();
    }
  }

  function drawBelt(bx, by, bw, bh, offset){
    rr(bx, by, bw, 28, 6, '#e2e8f0', C.line, 1.5);
    rr(bx + 8, by + 6, bw - 16, 16, 3, C.belt, C.line, 1);
    ctx.strokeStyle = 'rgba(255,255,255,.15)';
    ctx.lineWidth = 2;
    for (var d = (offset % 24) - 24; d < bw; d += 24){
      ctx.beginPath();
      ctx.moveTo(bx + d, by + 8);
      ctx.lineTo(bx + d - 8, by + 20);
      ctx.stroke();
    }
    rr(bx - 6, by + 4, 12, 20, 4, C.beltRoll, C.ink, 1.5);
    rr(bx + bw - 6, by + 4, 12, 20, 4, C.beltRoll, C.ink, 1.5);
  }

  function drawUnit(x, y, s, isBad, pulse){
    var col = isBad ? C.unitBad : C.unitOk;
    rr(x, y, s, s * 0.72, 4, col, C.ink, 1.5);
    if (isBad && pulse > 0.5){
      ctx.strokeStyle = 'rgba(239,68,68,' + (0.3 + 0.4 * Math.sin(frame * 0.2)) + ')';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(x + s/2, y + s*0.36, s * 0.55, 0, Math.PI * 2);
      ctx.stroke();
    }
  }

  function drawSensorNode(x, y, label, col, glow, pulse){
    ctx.fillStyle = glow;
    ctx.beginPath();
    ctx.arc(x, y, 18 + pulse * 4, 0, Math.PI * 2);
    ctx.fill();
    rr(x - 14, y - 14, 28, 28, 8, col, C.ink, 1.5);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 9px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(label, x, y + 28);
  }

  function drawCamNode(x, y, scanY, active){
    ctx.fillStyle = C.camGlow;
    ctx.beginPath();
    ctx.arc(x, y, 20, 0, Math.PI * 2);
    ctx.fill();
    rr(x - 16, y - 12, 32, 22, 5, C.cam, C.ink, 1.5);
    rr(x - 8, y - 4, 16, 10, 2, '#0e7490', null, 0);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 8px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('CV', x, y + 26);
    if (active){
      ctx.strokeStyle = 'rgba(121,242,255,.7)';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(x - 40, scanY);
      ctx.lineTo(x + 40, scanY);
      ctx.stroke();
    }
  }

  function drawEdgeHub(cx, cy, w, h, pulse){
    ctx.fillStyle = C.edgeGlow;
    ctx.beginPath();
    ctx.ellipse(cx, cy, w * 0.55, h * 0.55, 0, 0, Math.PI * 2);
    ctx.fill();
    rr(cx - w/2, cy - h/2, w, h, 12, C.edgePanel, C.edge, 2);
    ctx.fillStyle = '#c4b5fd';
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('Edge AI', cx, cy - 8);
    ctx.fillStyle = '#a5b4fc';
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText('on-prem', cx, cy + 8);
    var bars = [0.6, 0.85, 0.45, 0.7];
    for (var b = 0; b < 4; b++){
      var bh = 6 + bars[(b + Math.floor(frame/15)) % 4] * 14 * (0.7 + pulse * 0.3);
      rr(cx - 20 + b * 12, cy + 18 - bh, 8, bh, 2, C.edge, null, 0);
    }
  }

  function drawOutputCard(x, y, w, h, title, sub, col, icon, alpha){
    ctx.globalAlpha = alpha;
    rr(x, y, w, h, 8, C.bubble, col, 1.5);
    ctx.fillStyle = col;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(icon + ' ' + title, x + 10, y + 18);
    ctx.fillStyle = C.muted;
    ctx.font = '8.5px Inter,sans-serif';
    ctx.fillText(sub, x + 10, y + 32);
    ctx.globalAlpha = 1;
  }

  function drawWaveform(x, y, w, h, pts){
    rr(x, y, w, h, 6, 'rgba(255,255,255,.85)', 'rgba(148,163,184,.4)', 1);
    ctx.strokeStyle = C.alert;
    ctx.lineWidth = 1.8;
    ctx.beginPath();
    for (var i = 0; i < pts.length; i++){
      var px = x + 8 + (w - 16) * (i / (pts.length - 1));
      var py = y + h/2 - pts[i] * (h/2 - 10);
      if (i === 0) ctx.moveTo(px, py);
      else ctx.lineTo(px, py);
    }
    ctx.stroke();
    ctx.fillStyle = C.muted;
    ctx.font = '8px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('вибрация', x + 8, y + h - 5);
  }

  function spawnPacket(fromX, fromY, toX, toY, col){
    packets.push({x: fromX, y: fromY, tx: toX, ty: toY, t: 0, col: col});
  }

  function spawnAlert(x, y, text, col){
    alerts.push({x: x, y: y, text: text, col: col, life: 0, max: 120});
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    ctx.clearRect(0, 0, W, H);
    drawGrid();

    var pad = Math.max(16, W * 0.04);
    var beltY = H * 0.62;
    var beltW = W - pad * 2;
    var beltX = pad;
    var beltOffset = frame * 1.2;

    drawBelt(beltX, beltY, beltW, 28, beltOffset);

    var unitS = Math.min(36, W * 0.06);
    var speed = 0.0016;
    units.forEach(function(u, idx){
      u.x += speed;
      if (u.x > 1.15) u.x = -0.12;
      var ux = beltX + u.x * beltW;
      var uy = beltY - unitS * 0.85;
      var nearCam = Math.abs(u.x - 0.52) < 0.04;
      if (nearCam && !u.scanned){
        u.scanned = true;
        if (u.bad) spawnAlert(W * 0.78, H * 0.18, 'CV: дефект', C.alertRed);
      }
      if (u.x > 0.55) u.scanned = false;
      drawUnit(ux, uy, unitS, u.bad, nearCam ? 1 : 0);
    });

    var edgeX = W * 0.5;
    var edgeY = H * 0.34;
    var edgeW = Math.min(110, W * 0.22);
    var edgeH = 72;
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.06);
    drawEdgeHub(edgeX, edgeY, edgeW, edgeH, pulse);

    var s1x = beltX + beltW * 0.18;
    var s2x = beltX + beltW * 0.35;
    var s3x = beltX + beltW * 0.72;
    var sy = beltY - 52;
    drawSensorNode(s1x, sy, 'IoT', C.sensor, C.sensorGlow, pulse);
    drawSensorNode(s2x, sy, 'SCADA', C.sensor, C.sensorGlow, 0.5 + 0.5 * Math.sin(frame * 0.08));
    drawCamNode(beltX + beltW * 0.52, sy - 8, beltY - 4, Math.sin(frame * 0.1) > 0);
    drawSensorNode(s3x, sy, 'MES', C.sensor, C.sensorGlow, pulse * 0.8);

    if (frame % 45 === 0){
      spawnPacket(s1x, sy + 14, edgeX - edgeW * 0.3, edgeY, C.data);
      spawnPacket(s2x, sy + 14, edgeX, edgeY - 10, C.data);
    }
    if (frame % 60 === 20){
      spawnPacket(beltX + beltW * 0.52, sy + 20, edgeX + edgeW * 0.2, edgeY, C.cam);
    }

    packets = packets.filter(function(p){
      p.t += 0.028;
      var px = p.x + (p.tx - p.x) * p.t;
      var py = p.y + (p.ty - p.y) * p.t - Math.sin(p.t * Math.PI) * 18;
      ctx.fillStyle = p.col;
      ctx.beginPath();
      ctx.arc(px, py, 4, 0, Math.PI * 2);
      ctx.fill();
      if (p.t >= 1 && Math.random() > 0.7){
        spawnAlert(edgeX + edgeW * 0.5, edgeY - edgeH, 'PdM: 12 дн.', C.alert);
      }
      return p.t < 1;
    });

    if (frame % 200 === 0){
      spawnAlert(W * 0.72, H * 0.22, 'PdM: вибрация ↑', C.alert);
    }

    alerts = alerts.filter(function(a){
      a.life++;
      var aAlpha = a.life < 20 ? a.life / 20 : Math.max(0, 1 - (a.life - 80) / 40);
      if (aAlpha <= 0) return false;
      drawOutputCard(a.x, a.y - a.life * 0.15, 108, 42, a.text.split(':')[1] ? a.text.split(':')[1].trim() : a.text, a.text.split(':')[0], a.col, '●', aAlpha);
      return a.life < a.max;
    });

    drawOutputCard(pad, pad, 118, 44, 'OEE 87%', 'сводка смены', C.ok, '◆', 0.92);
    drawOutputCard(W - pad - 120, pad, 120, 44, 'Telegram', 'алерт мастеру', C.edge, '▸', 0.88 + 0.12 * Math.sin(frame * 0.05));

    wavePts = [];
    for (var w = 0; w < 24; w++){
      var spike = (w === 17 && t > 400 && t < 650) ? 0.9 : 0;
      wavePts.push(0.25 * Math.sin(frame * 0.08 + w * 0.45) + spike + 0.1 * Math.random());
    }
    drawWaveform(pad, H - pad - 52, 130, 44, wavePts);

    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Линия', beltX, H - 8);
    ctx.textAlign = 'center';
    ctx.fillText('Edge inference', edgeX, H - 8);
    ctx.textAlign = 'right';
    ctx.fillText('MES / 1С', W - pad, H - 8);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>

  <section class="aip-section aip-section-alt" id="etapy">
    <div class="aip-cnt">
      <div class="aip-sh nero-ai-reveal">
        <span class="aip-eyebrow">Под ключ</span>
        <h2>Внедрение AI для производства под ключ: этапы и сроки</h2>
        <p>Не «цифровая трансформация на три года», а управляемый путь: аудит → пилот на одном участке → тираж. Типовой горизонт — от 1 до 12 месяцев.</p>
      </div>

      <div class="aip-grid-2 nero-ai-reveal">
        <div class="aip-card">
          <h3>Аудит процессов и выбор пилотной зоны</h3>
          <p><strong>Аудит Nero Network (3–5 дней):</strong></p>
          <ol class="aip-ol">
            <li>Обход цеха и интервью с мастерами, главным инженером, финдиректором.</li>
            <li>Карта источников данных: SCADA, MES, 1С, камеры, журналы ТОиР.</li>
            <li>Расчёт стоимости часа простоя и доли брака на кандидатах в пилот.</li>
            <li>Выбор одного сценария: PdM, автоОТК или автосводка OEE.</li>
          </ol>
          <p><strong>Итог:</strong> не презентация «про ИИ», а цифры — где теряются деньги и какой пилот даст максимальный ROI.</p>
        </div>
        <div class="aip-card">
          <h3>Пилот на одной линии vs масштабирование</h3>
          <div class="aip-table-wrap">
            <table class="aip-table">
              <thead><tr><th>Этап</th><th>Срок</th><th>Что происходит</th></tr></thead>
              <tbody>
                <tr><td>Подготовка данных</td><td>2–4 нед.</td><td>OPC UA/Modbus/MQTT, история отказов, разметка CV</td></tr>
                <tr><td>Пилот on-prem</td><td>4–8 нед.</td><td>Модель + дашборд/Telegram, параллельный режим</td></tr>
                <tr><td>Промэксплуатация</td><td>2–6 мес.</td><td>Интеграция в CMMS, SLA, тираж на линии</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="aip-card nero-ai-reveal nero-ai-delay-1" id="mes-scada">
        <h3>Интеграция с MES, SCADA и ERP без остановки линии</h3>
        <pre class="aip-code" aria-label="Архитектура интеграции">Датчики / камеры / SCADA → Edge-сервер (on-prem) → AI-модуль → Rule-engine → Алерт мастеру
                                                                    ↓
                                              MES / 1С / SAP / CMMS ← заявка на ТО</pre>
        <p>AI работает поверх ISA-95: читает телеметрию, пишет алерты и отчёты. Стек: OPC UA, Modbus, MQTT; MES (Galaktika, Opcenter); ERP (1С, SAP); уведомления в Telegram и панель мастера. Для учётного контура и документооборота между цехом и бэк-офисом см. <a href="/ai-1c-erp/" style="color:var(--aip-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP: внедрение под ключ</a>.</p>
        <p>Кейс Köber + Siemens Opcenter: nonconformity reports −70% в первый год. Подключение к SCADA без замены парка — стандартная практика.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-audit">
        <div class="ym-cta-block__icon" aria-hidden="true">🏭</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Аудит производственных процессов — бесплатно</p>
          <p class="ym-cta-block__sub">За 3–5 дней обойдём цех, составим карту потерь (простои, брак, ручные отчёты), подключим SCADA/MES/камеры и выберем один пилот с максимальным ROI. Цифры — до подписания контракта.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aip-section" id="ceny">
    <div class="aip-cnt">
      <div class="aip-sh nero-ai-reveal">
        <span class="aip-eyebrow">Бюджет и ROI</span>
        <h2>Сколько стоит AI для производства и от чего зависит цена</h2>
      </div>

      <div class="aip-table-wrap nero-ai-reveal">
        <table class="aip-table">
          <thead><tr><th>Уровень</th><th>Бюджет</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Пилот (1 сценарий)</td><td>700 тыс. – 1,5 млн ₽</td><td>Аудит, данные, модель, дашборд, 4–8 недель</td></tr>
            <tr><td>Среднее внедрение</td><td>1,5 – 3 млн ₽</td><td>PdM + ОТК или аналитика + MES/1С</td></tr>
            <tr><td>Комплекс (завод)</td><td>3 – 5 млн ₽</td><td>Несколько линий, CMMS, SLA, дообучение</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aip-grid-2 nero-ai-reveal nero-ai-delay-1">
        <div class="aip-card">
          <h3>От чего зависит цена</h3>
          <ul>
            <li>Количество точек сбора данных (датчики от 5–15 тыс. ₽/агрегат)</li>
            <li>GPU on-prem vs CPU</li>
            <li>Глубина интеграции с MES/ERP</li>
            <li>Объём разметки для computer vision</li>
            <li>Требования КИИ и закрытый контур (ПНСТ 1046-2026)</li>
          </ul>
        </div>
        <div class="aip-card">
          <h3>ROI: окупаемость за счёт простоев и брака</h3>
          <pre class="aip-code">Экономия = (часы предотвращённых простоев × стоимость часа)
         + (снижение брака × цена единицы) − затраты на проект</pre>
          <p>Ориентиры: ML Sense 6–12 мес.; Unilever &lt;7 мес.; IBS ~266 млн ₽/год; Северсталь — один простой 4,53 млн ₽ за полугодие. Типичный коридор пилота — <strong>6–18 месяцев</strong>.</p>
        </div>
      </div>

      <div class="aip-table-wrap nero-ai-reveal">
        <table class="aip-table" aria-label="Сравнение подходов к обслуживанию">
          <thead><tr><th>Подход</th><th>Реакция</th><th>Простои</th><th>Затраты на ТО</th></tr></thead>
          <tbody>
            <tr><td>Реактивное ТО</td><td>После поломки</td><td>Максимальные</td><td>Высокие (аварийные)</td></tr>
            <tr><td>Плановое ТО</td><td>По графику</td><td>Средние</td><td>Плановые</td></tr>
            <tr><td>PdM + AI</td><td>За 5–20 дней до отказа</td><td>Минимальные</td><td>Оптимизированные</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Посчитайте эффект AI на вашем участке</p>
          <p class="ym-cta-block__sub">Укажите стоимость часа простоя и долю брака на проблемной линии — на аудите дадим ориентир окупаемости при бюджете 700 тыс.–5 млн ₽. Один предотвращённый простой часто окупает пилот.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="aip-section aip-section-alt" id="keisy">
    <div class="aip-cnt">
      <div class="aip-sh nero-ai-reveal">
        <span class="aip-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI на производстве</h2>
        <p>Эффект считается в рублях, штуках продукции и процентах OEE — не в «цифровой зрелости».</p>
      </div>
      <div class="aip-case-grid nero-ai-reveal">
        <article class="aip-case-card">
          <div class="aip-case-tag">QC · Computer Vision</div>
          <h3>Детекция дефектов</h3>
          <ul>
            <li>ML Sense — 100% inline, дефект 1×1 мм</li>
            <li>Lenta tech / «Кордиант» — +15 000 шин/год</li>
            <li>Иж-Рэст — брак −30%, MES + 1С</li>
          </ul>
        </article>
        <article class="aip-case-card">
          <div class="aip-case-tag">PdM · Anomaly</div>
          <h3>Predictive maintenance</h3>
          <ul>
            <li>Северсталь — прогноз 5–20 дней, Kafka + ML</li>
            <li>Графит — простои −80%</li>
            <li>Unilever — −45% затрат на ТО</li>
          </ul>
        </article>
        <article class="aip-case-card">
          <div class="aip-case-tag">Аналитика · OEE</div>
          <h3>Отчётность и прогноз</h3>
          <ul>
            <li>Кольская ГМК — +0,73 п.п. никеля</li>
            <li>IBS — +1–4% выработки</li>
            <li>FactoryNet — time-series foundation models</li>
          </ul>
        </article>
      </div>
    </div>
  </section>

  <section class="aip-section" id="otrasli">
    <div class="aip-cnt">
      <div class="aip-sh nero-ai-reveal">
        <span class="aip-eyebrow">Сегменты</span>
        <h2>Нейросети и AI-решения для разных типов производства</h2>
      </div>
      <div class="aip-grid-3 nero-ai-reveal">
        <article class="aip-card">
          <h3>Малый бизнес</h3>
          <p>Вход через один пилот: автоОТК, PdM на компрессоре или автосводка смены. Бюджет — от 700 тыс. ₽.</p>
        </article>
        <article class="aip-card">
          <h3>Средний бизнес</h3>
          <p>2–3 сценария: QC + PdM + OEE. Интеграция с 1С типична (кейс Иж-Рэст).</p>
        </article>
        <article class="aip-card">
          <h3>Крупные предприятия</h3>
          <p>Data Lake, тираж на цеха (Северсталь, Норникель). Чек 3–5 млн ₽ и выше.</p>
        </article>
      </div>
      <div class="aip-card nero-ai-reveal nero-ai-delay-1">
        <h3>AI-агенты и автоматизация рутины</h3>
        <p>Агенты — не замена мастера, а помощник: RAG по регламентам, разбор аварий, автогенерация сменных отчётов, маршрутизация заявок в CMMS/1С. Для коммерческого блока завода схожий подход описан в разделе про <a href="/vnedrenie-ai-amocrm/" style="color:var(--aip-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM</a>. Критические решения остаются за человеком.</p>
        <div class="aip-table-wrap">
          <table class="aip-table">
            <thead><tr><th>AI</th><th>Человек</th></tr></thead>
            <tbody>
              <tr><td>Прогнозирует отказы</td><td>Решает об останове линии</td></tr>
              <tr><td>Классифицирует дефекты</td><td>Утверждает режимы</td></tr>
              <tr><td>Собирает OEE-отчёты</td><td>Выполняет ремонт</td></tr>
              <tr><td>Ранжирует алерты</td><td>Размечает новые дефекты</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <section class="aip-section aip-section-alt" id="integraciya">
    <div class="aip-cnt">
      <div class="aip-sh nero-ai-reveal">
        <span class="aip-eyebrow">Разработка</span>
        <h2>Разработка, интеграция и настройка AI под ваш завод</h2>
      </div>

      <div class="aip-grid-2 nero-ai-reveal">
        <div class="aip-card">
          <h3>Под ключ или своими силами</h3>
          <div class="aip-table-wrap">
            <table class="aip-table">
              <thead><tr><th>Критерий</th><th>Под ключ</th><th>Своими силами</th></tr></thead>
              <tbody>
                <tr><td>Срок до эффекта</td><td>4–8 недель</td><td>6–18 месяцев</td></tr>
                <tr><td>Риск</td><td>KPI в договоре</td><td>Кадровый и технологический</td></tr>
                <tr><td>Интеграция MES/SCADA</td><td>Опыт OPC UA, 1С, SAP</td><td>Зависит от команды</td></tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="aip-card">
          <h3>Безопасность и регуляторика 2026</h3>
          <p>On-prem контур: данные не уходят в публичное облако. <strong>ФЗ № 243-ФЗ</strong>, <strong>ПНСТ 1046-2026</strong> (с 01.04.2026) для КИИ.</p>
          <ul>
            <li>«Данные уйдут в облако» → on-prem, air-gapped</li>
            <li>«ИИ ошибётся» → human-in-the-loop на пилоте</li>
            <li>«Старое оборудование» → датчики от 5–15 тыс. ₽</li>
            <li>«Нет IT-отдела» → под ключ, обучение 2–3 дня</li>
          </ul>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением полезно разобраться в OPC UA, human-in-the-loop и интеграции с MES — это ускоряет согласование с главным инженером и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="aip-section" id="faq">
    <div class="aip-cnt">
      <div class="aip-sh nero-ai-reveal">
        <span class="aip-eyebrow">Вопросы</span>
        <h2>FAQ по внедрению AI на производстве</h2>
      </div>
      <div class="aip-faq nero-ai-reveal">
        <div class="aip-faq-item"><button type="button" class="aip-faq-q" aria-expanded="false">Как внедрить AI для производства пошагово?</button><div class="aip-faq-a"><p>Аудит → подготовка данных (SCADA/MES) → пилот 4–8 недель в параллельном режиме → промэксплуатация с интеграцией в ТОиР → тираж на соседние линии.</p></div></div>
        <div class="aip-faq-item"><button type="button" class="aip-faq-q" aria-expanded="false">Нужны ли программисты и IT-отдел?</button><div class="aip-faq-a"><p>При модели «под ключ» интегратор настраивает OPC UA и модель, обучает мастера. Внутренний IT нужен для доступов к SCADA/MES — не для разработки моделей.</p></div></div>
        <div class="aip-faq-item"><button type="button" class="aip-faq-q" aria-expanded="false">Можно ли начать без остановки производства?</button><div class="aip-faq-a"><p>Да. Inline QC работает на скорости конвейера. PdM подключается к телеметрии. Пилот идёт параллельно — линия не останавливается.</p></div></div>
        <div class="aip-faq-item"><button type="button" class="aip-faq-q" aria-expanded="false">Сколько стоит AI для производства?</button><div class="aip-faq-a"><p>От 700 тыс. до 5 млн ₽ в зависимости от масштаба; пилот — нижняя граница вилки.</p></div></div>
        <div class="aip-faq-item"><button type="button" class="aip-faq-q" aria-expanded="false">Под ключ или самостоятельно?</button><div class="aip-faq-a"><p>Без ML-команды под ключ быстрее и дешевле по совокупной стоимости владения.</p></div></div>
        <div class="aip-faq-item"><button type="button" class="aip-faq-q" aria-expanded="false">Какие задачи решает AI для производства?</button><div class="aip-faq-a"><p>QC, PdM, OEE-аналитика, оптимизация режимов, ИИ-ассистент мастера.</p></div></div>
      </div>
    </div>
  </section>

  <section class="aip-section aip-section-alt" id="zakazat">
    <div class="aip-cnt">
      <div class="aip-sh aip-left nero-ai-reveal">
        <span class="aip-eyebrow">Следующий шаг</span>
        <h2>Заказать внедрение AI для производства</h2>
        <p>Nero Network внедряет AI для QC, PdM и производственной аналитики. Не «стратегия цифровизации» — измеримый пилот с KPI в договоре.</p>
      </div>
      <div class="aip-card nero-ai-reveal">
        <h3>Что вы получаете</h3>
        <ul>
          <li>Аудит с расчётом стоимости простоя и брака</li>
          <li>Пилот on-prem за 4–8 недель без остановки линии</li>
          <li>Интеграцию с MES, SCADA, 1С, SAP, Telegram</li>
          <li>Вилку бюджета 700 тыс. – 5 млн ₽ и SLA на дообучение</li>
        </ul>
        <h3>Чек-лист «Найти эффект AI на производстве»</h3>
        <ol class="aip-ol">
          <li>Посчитайте стоимость часа простоя критичного агрегата.</li>
          <li>Оцените долю брака на проблемной линии за 6 месяцев.</li>
          <li>Проверьте телеметрию или возможность датчиков/камеры.</li>
          <li>Определите сценарий с максимальным ROI: PdM, ОТК или OEE.</li>
          <li>Закажите аудит — цифры до контракта на пилот.</li>
        </ol>
        <p>AI для производства в 2026 — инструмент с доказанным ROI. Начните с аудита одного участка и посчитайте эффект до масштабирования.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы снизить простои и брак на производстве?</p>
          <p class="ym-cta-block__sub">Следующий шаг — аудит одного участка и пилот on-prem за 4–8 недель без остановки линии. KPI фиксируем в договоре.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aip-section" id="related">
    <div class="aip-cnt">
      <div class="aip-sh aip-left nero-ai-reveal">
        <span class="aip-eyebrow">Смежные темы</span>
        <h2>AI для бизнеса: смежные материалы</h2>
        <p>Цеховые сценарии — на этой странице; офисные потоки и CRM — на соседних посадочных.</p>
      </div>
      <p class="nero-ai-reveal" style="font-size:15px;line-height:1.65;color:var(--aip-muted,#94a3b8)">Если узкое место не только на линии, но и во входящих заказах и письмах поставщиков, сравните сценарий <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--aip-accent);text-decoration:underline;text-underline-offset:3px">AI-обработки входящей почты в CRM</a> — triage и маршрутизация до попадания данных в MES и ERP.</p>
    </div>
  </section>

</div>

<?php
$aip_page_url = trailingslashit( get_permalink() );
$aip_site_url = trailingslashit( home_url( '/' ) );
$aip_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$aip_h1       = 'AI для производства: внедрение и настройка под ключ';
$aip_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $aip_site_url . '#organization',
      'name'  => $aip_brand,
      'url'   => $aip_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $aip_site_url . '#website',
      'url'       => $aip_site_url,
      'name'      => $aip_brand,
      'publisher' => [ '@id' => $aip_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $aip_page_url . '#webpage',
      'url'         => $aip_page_url,
      'name'        => $aip_h1,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $aip_site_url . '#website' ],
      'about'       => [ '@id' => $aip_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $aip_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $aip_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $aip_h1, 'item' => $aip_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $aip_page_url . '#service',
      'name'        => $aip_h1,
      'description' => $page_seo_description,
      'url'         => $aip_page_url,
      'provider'    => [ '@id' => $aip_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $aip_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить AI для производства пошагово?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит → подготовка данных (SCADA/MES) → пилот 4–8 недель в параллельном режиме → промэксплуатация с интеграцией в ТОиР → тираж на соседние линии.' ] ],
        [ '@type' => 'Question', 'name' => 'Нужны ли программисты и IT-отдел?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'При модели «под ключ» интегратор настраивает OPC UA и модель, обучает мастера. Внутренний IT нужен для доступов к SCADA/MES — не для разработки моделей.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли начать без остановки производства?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Inline QC работает на скорости конвейера. PdM подключается к телеметрии. Пилот идёт параллельно — линия не останавливается.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит AI для производства?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'От 700 тыс. до 5 млн ₽ в зависимости от масштаба; пилот — нижняя граница вилки.' ] ],
        [ '@type' => 'Question', 'name' => 'Под ключ или самостоятельно?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Без ML-команды под ключ быстрее и дешевле по совокупной стоимости владения.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие задачи решает AI для производства?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'QC, PdM, OEE-аналитика, оптимизация режимов, ИИ-ассистент мастера.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $aip_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</script>

</main>

<script>
/**
 * aip-proizvodstvo-hero-engine — «Диспетчерская предиктивного завода»
 * Мир: потоки телеметрии снизу → цифровой двойник → эскалация ТОиР → всплеск OEE
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aip-proizvodstvo-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 280) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    grid: "rgba(121,242,255,0.06)",
    river: "#334155",
    packetBlue: "#38bdf8",
    packetAmber: "#f59e0b",
    packetGreen: "#22c55e",
    twinBg: "#0f172a",
    twinBorder: "#1e293b",
    twinAccent: "#79f2ff",
    gold: "#f5c518",
    alertRed: "#ef4444",
    okGreen: "#22c55e",
    cvFrame: "rgba(245,197,24,0.35)",
    sensorPulse: "rgba(139,92,246,0.45)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0b1224",
    bubbleText: "#e2e8f0"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Фоновая сетка аномалий */
  function AnomalyHeatmapGrid() {}
  AnomalyHeatmapGrid.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    for (var gx = -200; gx <= 200; gx += 40) {
      for (var gy = -80; gy <= 80; gy += 32) {
        var hot = Math.sin((gx + frame) * 0.04) * Math.cos((gy - frame * 0.5) * 0.05);
        if (hot > 0.55 && prg > 120 && prg < 200) {
          ctx.fillStyle = "rgba(239,68,68," + (0.08 + hot * 0.06) + ")";
          ctx.fillRect(gx - 8, gy - 6, 16, 12);
        } else {
          ctx.strokeStyle = C.grid;
          ctx.strokeRect(gx - 8, gy - 6, 16, 12);
        }
      }
    }
  };

  /* Горизонтальные реки телеметрии — вместо Conveyor */
  function SensorTelemetryRiver() {
    this.streams = [
      { y: 72, color: C.packetBlue, label: "SCADA" },
      { y: 88, color: C.packetAmber, label: "CV" },
      { y: 104, color: C.packetGreen, label: "MES" }
    ];
  }
  SensorTelemetryRiver.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    this.streams.forEach(function (s, idx) {
      ctx.strokeStyle = C.river;
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(-190, s.y);
      ctx.bezierCurveTo(-60, s.y - 8, 40, s.y + 10, 190, s.y - 4);
      ctx.stroke();

      for (var i = 0; i < 5; i++) {
        var t = ((frame * 0.55 + i * 48 + idx * 22) % 220) / 220;
        var px = -190 + t * 380;
        var py = s.y + Math.sin(t * Math.PI) * (idx === 1 ? -6 : 4);
        ctx.fillStyle = s.color;
        ctx.beginPath();
        ctx.arc(px, py, 4, 0, Math.PI * 2);
        ctx.fill();
      }

      if (prg < 70) {
        ctx.fillStyle = s.color;
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(s.label, -188, s.y - 10);
      }
    });
  };

  /* Узлы вибрации на линии */
  function VibrationSensorNode(x, y) {
    this.x = x; this.y = y; this.phase = Math.random() * 6;
  }
  VibrationSensorNode.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    var pulse = 1 + Math.sin(frame * 0.08 + this.phase) * 0.35;
    if (prg > 130 && prg < 195) pulse += 0.4;
    ctx.strokeStyle = C.sensorPulse;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 10 * pulse, 0, Math.PI * 2);
    ctx.stroke();
    drawRR(ctx, this.x - 5, this.y - 5, 10, 10, 3, "#1e293b", C.outline);
    ctx.fillStyle = prg > 130 ? C.alertRed : C.gold;
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Hz", this.x, this.y + 2);
  };

  /* Рамка computer vision */
  function CvInspectionFrame() {
    this.scanY = -28;
  }
  CvInspectionFrame.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    drawRR(ctx, -168, -42, 52, 44, 5, "rgba(15,23,42,0.7)", C.gold);
    ctx.strokeStyle = C.cvFrame;
    ctx.lineWidth = 2;
    ctx.strokeRect(-162, -36, 40, 32);
    this.scanY = -34 + ((frame * 0.6) % 28);
    ctx.fillStyle = "rgba(245,197,24,0.35)";
    ctx.fillRect(-160, this.scanY, 36, 2);

    if (prg > 55 && prg < 120) {
      var defect = prg > 85;
      drawRR(ctx, -148, -20, 14, 10, 2, defect ? "rgba(239,68,68,0.5)" : C.okGreen, null);
      if (defect) {
        ctx.fillStyle = "#fecaca";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("BR", -141, -13);
      }
    }
    ctx.fillStyle = C.gold;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("CV·ОТК", -166, -46);
  };

  /* Цифровой двойник — вместо WebsiteTerminal */
  function PredictiveTwinPanel() {
    this.phase = 0;
    this.alertPop = 0;
  }
  PredictiveTwinPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    drawRR(ctx, -55, -78, 150, 118, 10, C.twinBg, C.twinBorder);

    ctx.fillStyle = C.twinAccent;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Цифровой двойник · OEE", -48, -66);

    /* Фаза 1: ingest */
    if (prg < 70) {
      ctx.fillStyle = "#94a3b8";
      ctx.font = "7px Inter,sans-serif";
      ctx.fillText("ingest телеметрии…", -48, -52);
      for (var b = 0; b < 4; b++) {
        var bw = 20 + b * 28;
        drawRR(ctx, -48 + b * 32, -38, 24, 8, 2, "rgba(56,189,248,0.25)", null);
      }
    }

    /* Фаза 2: analyze — график прогноза */
    if (prg >= 70 && prg < 140) {
      ctx.strokeStyle = C.twinAccent;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      for (var i = 0; i < 12; i++) {
        var gx = -48 + i * 10;
        var gy = -10 - Math.sin(i * 0.7 + frame * 0.05) * 14 - (i > 8 ? (i - 8) * 4 : 0);
        if (i === 0) ctx.moveTo(gx, gy);
        else ctx.lineTo(gx, gy);
      }
      ctx.stroke();
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("PdM: риск отказа ↑", -48, 8);
    }

    /* Фаза 3: escalate */
    if (prg >= 140 && prg < 200) {
      this.alertPop = Math.min(1, (prg - 140) / 20);
      ctx.globalAlpha = this.alertPop;
      drawRR(ctx, -48, -30, 130, 36, 6, "rgba(239,68,68,0.22)", C.alertRed);
      ctx.fillStyle = "#fecaca";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("⚠ Аномалия: насос B-12", -42, -10);
      ctx.fillStyle = "#94a3b8";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("human-in-the-loop · review", -42, 0);
      ctx.globalAlpha = 1;
    }

    /* Фаза 4: resolve — OEE */
    if (prg >= 200) {
      var oee = 0.72 + Math.min(0.15, (prg - 200) / 80);
      ctx.strokeStyle = C.okGreen;
      ctx.lineWidth = 4;
      ctx.beginPath();
      ctx.arc(20, 18, 22, -Math.PI / 2, -Math.PI / 2 + oee * Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 9px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(Math.round(oee * 100) + "%", 20, 22);
      ctx.textAlign = "left";
    }
  };

  /* Панель эскалации ТОиР */
  function MaintenanceEscalationPad() {}
  MaintenanceEscalationPad.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    drawRR(ctx, 118, 8, 58, 52, 6, "rgba(30,41,59,0.85)", C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CMMS", 147, 20);

    if (prg >= 195) {
      var stamp = Math.min(1, (prg - 195) / 15);
      ctx.save();
      ctx.translate(147, 38);
      ctx.rotate(-0.12 * stamp);
      ctx.globalAlpha = stamp;
      ctx.strokeStyle = C.okGreen;
      ctx.lineWidth = 1.5;
      ctx.strokeRect(-24, -10, 48, 20);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("ЗАЯВКА ТОиР", 0, 4);
      ctx.restore();
    }
  };

  /* Маяк OEE в финале */
  function OeePulseBeacon() {}
  OeePulseBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.034) % 260;
    if (prg < 210) return;
    var pulse = 0.5 + Math.sin(frame * 0.1) * 0.3;
    ctx.fillStyle = "rgba(34,197,94," + (pulse * 0.25) + ")";
    ctx.beginPath();
    ctx.arc(-10, -55, 28 + pulse * 8, 0, Math.PI * 2);
    ctx.fill();
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.028;
    var prg = (frame * 0.034) % 260;
    var isMoving = false;
    var faceDir = 1;

    /* Дуговое движение к twin-панели */
    var targets = {
      "1_architect": { x: -90, y: -55 },
      "2_seo": { x: -20, y: -62 },
      "3_coder": { x: 35, y: -58 },
      "4_designer": { x: -130, y: -25 },
      "5_deployer": { x: 95, y: 25 }
    };
    var tgt = targets[this.role] || { x: 0, y: -40 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
      var local = prg - this.stepTrig;
      var t = local / 28;
      var arc = Math.sin(t * Math.PI) * -18;
      this.x = this.baseX + (tgt.x - this.baseX) * t;
      this.y = this.baseY + (tgt.y - this.baseY) * t + arc;
      isMoving = t < 0.92;
      faceDir = tgt.x > this.baseX ? 1 : -1;
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
    }

    var bob = Math.sin(this.timer * 1.4) * 1.2;
    ctx.save();
    ctx.translate(this.x, this.y + bob);
    ctx.lineJoin = "round";

    drawRR(ctx, -10, -5, 8, 12, 2, C.outline, null);
    drawRR(ctx, 2, -5, 8, 12, 2, C.outline, null);
    drawRR(ctx, -14, -12, 28, 18, 6, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -26, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();

    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(3, -28, 3, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(-3, -28, 3, 0, Math.PI * 2); ctx.fill();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new AnomalyHeatmapGrid());
  entities.push(new SensorTelemetryRiver());
  entities.push(new CvInspectionFrame());
  entities.push(new VibrationSensorNode(-95, 58));
  entities.push(new VibrationSensorNode(12, 62));
  entities.push(new PredictiveTwinPanel());
  entities.push(new MaintenanceEscalationPad());
  entities.push(new OeePulseBeacon());

  entities.push(new Agent(-175, 28, C.agentYellow, "1_architect", 22, [
    "Карта SCADA готова", "Где час простоя?", "Аудит участка №3"
  ]));
  entities.push(new Agent(-155, 48, C.agentGreen, "2_seo", 62, [
    "Порог вибрации +18%", "Anomaly в норме?", "OEE ниже плана"
  ]));
  entities.push(new Agent(-125, 18, C.agentBlue, "3_coder", 98, [
    "XGBoost на edge", "Inference 180 мс", "Дообучаю CV-модель"
  ]));
  entities.push(new Agent(-105, 38, C.agentPink, "4_designer", 138, [
    "Камера на сварке", "Дефект 1×1 мм", "Inline без стопа"
  ]));
  entities.push(new Agent(155, 42, C.agentPurple, "5_deployer", 178, [
    "Алерт в Telegram", "Заявка в CMMS", "On-prem SLA ок"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 280, maxLife: customLife || 280 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.034) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-175, 8, "1. Аудит датчиков");
    if (prg >= 58 && prg < 58.05) createBubble(-155, 28, "2. Калибровка PdM");
    if (prg >= 98 && prg < 98.05) createBubble(-125, -2, "3. ML на edge");
    if (prg >= 138 && prg < 138.05) createBubble(-105, 18, "4. CV-рамка линии");
    if (prg >= 178 && prg < 178.05) createBubble(155, 22, "5. Эскалация ТОиР");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 12) alpha = (bub.maxLife - bub.life) / 12;
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

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineloop);
  } else {
    engineloop();
  }
});
</script>


<script>
(function(){
  document.querySelectorAll('.aip-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aip-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aip-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aip-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-dlia-proizvodstva-page') || document.querySelector('.aip-content');
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
