<?php
/**
 * Template Name: AI для HR и подбора персонала: внедрение под ключ
 * Description: Внедряем AI для HR: скрининг резюме, вопросы к интервью, коммуникация с кандидатами и аналитика найма.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для HR и подбора персонала: внедрение под ключ';
$page_seo_description = 'Внедряем AI для HR: скрининг резюме, вопросы к интервью, коммуникация с кандидатами и аналитика найма. Кейсы, интеграции с ATS и CRM, цены. Аудит HR-рутины бесплатно.';

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
    ['label' => 'Скрининг', 'href' => '#skrining'],
    ['label' => 'Коммуникация', 'href' => '#kommunikaciya'],
    ['label' => 'Аналитика', 'href' => '#analitika'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Цены', 'href' => '#ceny'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Автоматизировать подбор';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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

.vnhr-hero-hr {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}

.vnhr-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.vnhr-content .ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.vnhr-content .ym-btn:hover{transform:translateY(-2px);}
.vnhr-content .ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vnhr-btn-from),var(--vnhr-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
@media(max-width:600px){.vnhr-content .ym-cta-block{padding:28px 20px;}}
/* VNHR content root — prefix vnhr-, scoped в .vnhr-content */
.vnhr-content{
  --vnhr-bg:#050711;--vnhr-bg2:#080b17;--vnhr-surface:rgba(255,255,255,.072);
  --vnhr-text:#e6edf7;--vnhr-muted:#9aa8bd;--vnhr-soft:#c7d2e5;--vnhr-heading:#fff;
  --vnhr-border:rgba(255,255,255,.10);--vnhr-accent:#79f2ff;--vnhr-violet:#8b5cf6;
  --vnhr-green:#22c55e;--vnhr-amber:#f59e0b;--vnhr-amber-bg:rgba(245,158,11,.12);
  --vnhr-btn-from:#2563eb;--vnhr-btn-to:#7c3aed;--vnhr-r:18px;--vnhr-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnhr-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vnhr-content *,.vnhr-content *::before,.vnhr-content *::after{box-sizing:border-box}
.vnhr-content a{color:inherit}
.vnhr-content p{color:var(--vnhr-muted);line-height:1.72;margin:0 0 1em}
.vnhr-content p:last-child{margin-bottom:0}
.vnhr-content h2,.vnhr-content h3,.vnhr-content h4{color:var(--vnhr-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vnhr-content strong{color:var(--vnhr-soft)}
.vnhr-content ul,.vnhr-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.vnhr-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnhr-muted);font-size:14.5px;line-height:1.65}
.vnhr-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnhr-accent);font-weight:700}
.vnhr-content ol{counter-reset:vnhr-ol;list-style:none}
.vnhr-content ol li{counter-increment:vnhr-ol;padding-left:28px;position:relative;margin-bottom:.55em;color:var(--vnhr-muted);font-size:14.5px;line-height:1.65}
.vnhr-content ol li::before{content:counter(vnhr-ol);position:absolute;left:0;width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--vnhr-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;top:2px}
.vnhr-cnt{width:min(var(--vnhr-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vnhr-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vnhr-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vnhr-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vnhr-sh.vnhr-left{margin-left:0;text-align:left}
.vnhr-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vnhr-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vnhr-sh.vnhr-left p{margin-left:0}
.vnhr-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnhr-accent);margin-bottom:14px}
.vnhr-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vnhr-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vnhr-intro-text{position:relative;padding-left:20px}
.vnhr-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vnhr-accent),var(--vnhr-violet))}
.vnhr-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vnhr-muted);margin-bottom:1em}
.vnhr-intro-text p:last-child{margin-bottom:0;color:var(--vnhr-soft)}
.vnhr-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vnhr-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vnhr-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vnhr-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vnhr-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnhr-muted);line-height:1.4}
.vnhr-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vnhr-intro-grid{grid-template-columns:1fr;gap:36px}.vnhr-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vnhr-intro-kpi{grid-template-columns:1fr 1fr}}
.vnhr-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vnhr-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vnhr-toc a{display:inline-block;padding:9px 18px;background:var(--vnhr-surface);border:1px solid var(--vnhr-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vnhr-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vnhr-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vnhr-accent);background:rgba(121,242,255,.08)}
.vnhr-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vnhr-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22)}
.vnhr-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vnhr-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vnhr-grid-2,.vnhr-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.vnhr-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnhr-grid-3{grid-template-columns:1fr}}
.vnhr-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vnhr-table{width:100%;border-collapse:collapse;font-size:14px}
.vnhr-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vnhr-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vnhr-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vnhr-text);vertical-align:top}
.vnhr-table tr:last-child td{border-bottom:none}
.vnhr-table tr:hover td{background:rgba(255,255,255,.03)}
.vnhr-callout{border-radius:16px;padding:22px 24px;margin:28px 0;border:1px solid rgba(245,158,11,.35);background:var(--vnhr-amber-bg)}
.vnhr-callout h3{font-size:17px;color:#fde68a;margin-bottom:10px}
.vnhr-callout p{font-size:14.5px;margin:0}
.vnhr-quote-card{border-left:3px solid var(--vnhr-violet);padding:20px 24px;margin:28px 0;background:rgba(139,92,246,.08);border-radius:0 16px 16px 0}
.vnhr-quote-card blockquote{margin:0;font-size:15px;font-style:italic;color:var(--vnhr-soft);line-height:1.65}
.vnhr-quote-card cite{display:block;margin-top:10px;font-size:13px;color:var(--vnhr-muted);font-style:normal}
.vnhr-roi-box{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:20px 24px;margin:24px 0;font-family:ui-monospace,monospace;font-size:14px;color:var(--vnhr-accent);overflow-x:auto}
.vnhr-logos{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vnhr-logo-pill{padding:10px 18px;border-radius:999px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);font-size:13px;font-weight:700;color:var(--vnhr-soft)}
.vnhr-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vnhr-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnhr-case-grid{grid-template-columns:1fr}}
.vnhr-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.vnhr-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnhr-green);margin-bottom:10px}
.vnhr-case-card h3{font-size:16px;margin-bottom:14px}
.vnhr-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vnhr-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vnhr-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnhr-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vnhr-faq-q::after{content:'▾';font-size:13px;color:var(--vnhr-accent);flex-shrink:0;transition:transform .25s}
.vnhr-faq-item.open .vnhr-faq-q::after{transform:rotate(180deg)}
.vnhr-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vnhr-muted);line-height:1.72}
.vnhr-faq-item.open .vnhr-faq-a{max-height:900px;padding:0 24px 20px}
.vnhr-checklist{list-style:none;padding:0;margin:24px 0}
.vnhr-checklist li{display:flex;align-items:flex-start;gap:10px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.06);font-size:14.5px;color:var(--vnhr-muted)}
.vnhr-checklist li::before{content:'☐';color:var(--vnhr-accent);font-weight:700;flex-shrink:0}
.vnhr-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.vnhr-content .ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.vnhr-content .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.vnhr-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.vnhr-content .ym-cta-block__sub{color:var(--vnhr-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.vnhr-content .ym-link--accent{color:var(--vnhr-accent)!important;text-decoration:underline!important}
.vnhr-timeline{position:relative;padding-left:40px;margin:28px 0}
.vnhr-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnhr-accent),var(--vnhr-violet));opacity:.35;border-radius:2px}
.vnhr-tl-item{position:relative;margin-bottom:28px}
.vnhr-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnhr-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vnhr-tl-item h3{font-size:17px;margin-bottom:8px}
.vnhr-tl-item p{font-size:14.5px;margin:0}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-hr-podbor-personala-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnhr-hero-hr" id="vnhr-hero" aria-labelledby="vnhr-hero-title">
<style>
/* ── Hero vnedrenie-ai-hr-podbor-personala: самодостаточные стили (prefix vnhr-) ── */
.vnhr-hero-hr {
  --vnhr-teal: #2dd4bf;
  --vnhr-violet: #a78bfa;
  --vnhr-coral: #fb7185;
  --vnhr-green: #4ade80;
  --vnhr-text: #e6edf7;
  --vnhr-muted: #94a3b8;
  --vnhr-soft: #cbd5e1;
  --vnhr-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background:
    radial-gradient(ellipse 75% 55% at 72% 18%, rgba(45, 212, 191, 0.14), transparent),
    radial-gradient(ellipse 55% 45% at 8% 82%, rgba(167, 139, 250, 0.12), transparent),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.vnhr-hero-hr::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 32%, #000 0%, transparent 74%);
  opacity: .5;
  pointer-events: none;
  z-index: 0;
}
.vnhr-hero-hr::after {
  content: "";
  position: absolute;
  left: 6%;
  top: 18%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(45, 212, 191, .1), transparent 68%);
  filter: blur(10px);
  animation: vnhrHeroGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes vnhrHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .75; transform: scale(1.04); }
}
.vnhr-hero-hr .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnhr-hero-hr .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnhr-hero-hr .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.vnhr-hero-hr .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnhr-teal) 38%, var(--vnhr-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnhr-hero-hr .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(45, 212, 191, 0.24);
  border-radius: 999px;
  background: rgba(45, 212, 191, 0.08);
  color: var(--vnhr-teal) !important;
  font-size: 12px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.vnhr-hero-hr .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vnhr-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnhr-hero-hr .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnhr-hero-hr .nero-ai-badge {
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
.vnhr-hero-hr .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnhr-hero-hr .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 22px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  line-height: 1;
  text-decoration: none !important;
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.vnhr-hero-hr .nero-ai-btn:hover { transform: translateY(-2px); }
.vnhr-hero-hr .nero-ai-btn-primary {
  color: #042f2e !important;
  background: linear-gradient(135deg, var(--vnhr-teal), #5eead4);
  box-shadow: 0 18px 42px rgba(45, 212, 191, 0.22);
}
.vnhr-hero-hr .nero-ai-btn-secondary {
  color: var(--vnhr-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnhr-hero-hr .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnhr-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.vnhr-hero-hr .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnhr-hero-hr .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnhr-hero-hr .nero-ai-dots { display: flex; gap: 7px; }
.vnhr-hero-hr .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnhr-hero-hr .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnhr-hero-hr .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnhr-hero-hr .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnhr-hero-hr .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnhr-hero-hr .nero-ai-window-body { padding: 16px; }
.vnhr-hero-hr .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnhr-hero-hr .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnhr-hero-hr .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(74,222,128,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.vnhr-hero-hr .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--vnhr-green);
  box-shadow: 0 0 0 6px rgba(74,222,128,.14);
  animation: vnhrPulse 1.6s infinite;
}
@keyframes vnhrPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnhr-hero-hr .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnhr-hero-hr .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnhr-hero-hr .nero-ai-metric span {
  display: block;
  color: var(--vnhr-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnhr-hero-hr .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnhr-hero-hr .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnhr-hero-hr .vnhr-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(45, 212, 191, 0.18);
  background: radial-gradient(ellipse at 35% 42%, rgba(45,212,191,.08), rgba(6,10,24,.94) 72%);
}
.vnhr-hero-hr #vnhr-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnhr-hero-hr .nero-ai-task-stream { display: grid; gap: 8px; }
.vnhr-hero-hr .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnhr-hero-hr .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(45,212,191,.12);
  color: var(--vnhr-teal);
  font-size: 11px;
  font-weight: 800;
}
.vnhr-hero-hr .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnhr-hero-hr .nero-ai-task span {
  color: var(--vnhr-muted);
  font-size: 11px;
}
.vnhr-hero-hr .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(74,222,128,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnhr-hero-hr .nero-ai-status--amber {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
.vnhr-hero-hr .nero-ai-status--violet {
  background: rgba(167,139,250,.12);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .vnhr-hero-hr .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnhr-hero-hr .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnhr-hero-hr .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnhr-hero-hr .nero-ai-window-body { padding: 12px; }
  .vnhr-hero-hr .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnhr-hero-hr .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">HR / рекрутинг · внедрение под ключ</p>
      <h1 id="vnhr-hero-title">AI для HR и подбора персонала: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Автоматизируем скрининг резюме, коммуникацию с кандидатами и HR-аналитику — без ручной рутины и с интеграцией в ваши процессы найма</p>
      <ul class="nero-ai-badges" aria-label="Ключевые модули">
        <li class="nero-ai-badge">Скрининг резюме</li>
        <li class="nero-ai-badge">Коммуникация</li>
        <li class="nero-ai-badge">HR-аналитика</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация воронки найма с AI-скорингом">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Воронка найма · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Откликов сегодня</span>
              <strong>247</strong>
              <small>hh.ru + сайт + email</small>
            </div>
            <div class="nero-ai-metric">
              <span>Shortlist AI</span>
              <strong>18</strong>
              <small>score ≥ 78%</small>
            </div>
            <div class="nero-ai-metric">
              <span>Time-to-fill</span>
              <strong>9 дн.</strong>
              <small>было 20 · junior</small>
            </div>
            <div class="nero-ai-metric">
              <span>Конверсия в интервью</span>
              <strong>+20%</strong>
              <small>после чат-бота</small>
            </div>
          </div>

          <div class="vnhr-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnhr-hero-canvas" role="img" aria-label="Анимация: резюме по орбите проходят AI-скоринг, чат с кандидатом и синхронизацию shortlist в ATS"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий воронки найма">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CV</span>
              <div><strong>Резюме · Middle Frontend</strong><span>score 84% — навыки React, TypeScript</span></div>
              <span class="nero-ai-status">shortlist</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Чат-бот · статус кандидату</strong><span>«Приглашаем на интервью» · 2 мин</span></div>
              <span class="nero-ai-status">отправлено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">Q</span>
              <div><strong>Interview-prep · 12 вопросов</strong><span>под грейд middle · red flags</span></div>
              <span class="nero-ai-status nero-ai-status--violet">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">HF</span>
              <div><strong>Huntflow · карточка создана</strong><span>human review — финал за рекрутером</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * vnhr-hero-engine — «Диспетчерская воронки найма»
 * Мир: орбитальный поток резюме → TalentScoreTerminal → comms → ATS shortlist
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnhr-hero-canvas");
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
    outline: "#64748b",
    resume: "#f1f5f9",
    resumeHot: "#ccfbf1",
    resumeCool: "#ede9fe",
    teal: "#2dd4bf",
    violet: "#a78bfa",
    coral: "#fb7185",
    green: "#4ade80",
    panel: "#1e293b",
    panelLight: "rgba(255,255,255,0.08)",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6"
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

  function drawResume(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    if (label) ctx.fillText(label, x, y + 2);
    for (var i = 0; i < 3; i++) {
      ctx.strokeStyle = "rgba(100,116,139,0.45)";
      ctx.lineWidth = 0.7;
      ctx.beginPath();
      ctx.moveTo(x - w / 2 + 3, y - h / 2 + 6 + i * 4);
      ctx.lineTo(x + w / 2 - 3, y - h / 2 + 6 + i * 4);
      ctx.stroke();
    }
  }

  /* Орбитальный поток резюме — вместо Conveyor */
  function ResumeOrbitStream() {
    this.orbitals = [
      { angle: 0, color: C.resumeHot, label: "CV" },
      { angle: 2.1, color: C.resume, label: "CV" },
      { angle: 4.2, color: C.resumeCool, label: "CV" }
    ];
  }
  ResumeOrbitStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    ctx.strokeStyle = "rgba(45,212,191,0.18)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.ellipse(-55, 8, 95, 42, -0.15, 0, Math.PI * 2);
    ctx.stroke();

    this.orbitals.forEach(function (o, i) {
      var a = o.angle + frame * 0.022 + i * 0.4;
      var ox = -55 + Math.cos(a) * 95;
      var oy = 8 + Math.sin(a) * 42;
      if (prg < 200 || i === 0) drawResume(ctx, ox, oy, 14, 18, o.color, o.label);
    });
  };

  /* Центральный терминал скоринга — вместо WebsiteTerminal */
  function TalentScoreTerminal() {
    this.ring = 0;
  }
  TalentScoreTerminal.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    drawRR(ctx, -8, -62, 116, 128, 10, C.panel, C.outline);

    drawRR(ctx, 0, -54, 100, 16, [6, 6, 0, 0], "rgba(45,212,191,0.22)", null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("AI · скоринг кандидата", 6, -44);

    /* Аватар + имя */
    ctx.fillStyle = C.teal;
    ctx.beginPath();
    ctx.arc(18, -22, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("А. Козлов · Middle", 34, -24);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("React · TS · 4 года", 34, -14);

    /* Кольцо score */
    var scoreTarget = prg < 55 ? 0 : prg < 115 ? (prg - 55) / 60 : 0.84;
    this.ring += (scoreTarget - this.ring) * 0.08;
    ctx.strokeStyle = "rgba(255,255,255,0.1)";
    ctx.lineWidth = 5;
    ctx.beginPath();
    ctx.arc(88, -18, 16, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = C.teal;
    ctx.beginPath();
    ctx.arc(88, -18, 16, -Math.PI / 2, -Math.PI / 2 + Math.PI * 2 * this.ring);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(this.ring * 100) + "%", 88, -15);

  /* Explainable причина */
    if (prg > 70) {
      var alpha = Math.min(1, (prg - 70) / 20);
      ctx.globalAlpha = alpha;
      drawRR(ctx, 4, 2, 104, 22, 5, "rgba(74,222,128,0.12)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Совпадение навыков 84% · не хватает GraphQL", 10, 16);
      ctx.globalAlpha = 1;
    }

    /* Финал: shortlist badge */
    if (prg >= 195) {
      var bp = Math.min(1, (prg - 195) / 12);
      ctx.save();
      ctx.globalAlpha = bp;
      ctx.translate(52, 38);
      drawRR(ctx, -32, -10, 64, 20, 6, "rgba(74,222,128,0.2)", C.green);
      ctx.fillStyle = C.green;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("В SHORTLIST", 0, 4);
      ctx.restore();
    }
  };

  /* Лента вопросов к интервью */
  function InterviewPrepRibbon() {
    this.offset = 0;
  }
  InterviewPrepRibbon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    if (prg < 120 || prg > 185) return;
    var qs = ["React hooks?", "TS generics?", "Команда?", "Red flags"];
    var slide = ((prg - 120) * 0.6) % (qs.length * 38);
    qs.forEach(function (q, i) {
      var qx = -70 + i * 38 - slide;
      if (qx > -80 && qx < 90) {
        drawRR(ctx, qx, 48, 34, 14, 4, "rgba(167,139,250,0.15)", C.violet);
        ctx.fillStyle = "#ddd6fe";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(q, qx + 17, 58);
      }
    });
  };

  /* Чат-хаб кандидата */
  function CandidateCommsPod() {
    this.blink = 0;
  }
  CandidateCommsPod.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    if (prg < 95 || prg > 175) return;
    drawRR(ctx, 118, -48, 52, 58, 8, "rgba(251,113,133,0.08)", C.coral);
    ctx.fillStyle = C.coral;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Telegram", 144, -38);

    var msgs = ["Статус?", "Интервью завтра"];
    msgs.forEach(function (m, i) {
      var show = prg > 105 + i * 22;
      if (!show) return;
      var mx = i === 0 ? 124 : 130;
      var my = -24 + i * 18;
      drawRR(ctx, mx, my, 38, 12, 4, i === 0 ? C.panelLight : "rgba(45,212,191,0.18)", C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(m, mx + 19, my + 8);
    });
  };

  /* Мост синхронизации ATS */
  function AtsBridgeNode() {
    this.pulse = 0;
  }
  AtsBridgeNode.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    drawRR(ctx, 128, 18, 44, 36, 6, "rgba(30,41,59,0.7)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Huntflow", 150, 30);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "5px Inter,sans-serif";
    ctx.fillText("ATS sync", 150, 40);

    if (prg >= 185) {
      this.pulse = (prg - 185) / 20;
      ctx.strokeStyle = "rgba(74,222,128," + (0.5 - this.pulse * 0.4) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(150, 36, 8 + this.pulse * 18, 0, Math.PI * 2);
      ctx.stroke();
      /* Луч от терминала к ATS */
      ctx.strokeStyle = "rgba(45,212,191,0.5)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([4, 4]);
      ctx.beginPath();
      ctx.moveTo(52, 30);
      ctx.lineTo(128, 36);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  };

  /* Compliance shield — human-in-the-loop */
  function ComplianceShield() {
    this.glow = 0;
  }
  ComplianceShield.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 230;
    this.glow = 0.5 + Math.sin(frame * 0.06) * 0.2;
    drawRR(ctx, -168, 42, 36, 28, 5, "rgba(45,212,191,0.06)", "rgba(45,212,191,0.35)");
    ctx.fillStyle = "rgba(45,212,191," + this.glow + ")";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("152-ФЗ", -150, 54);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "5px Inter,sans-serif";
    ctx.fillText("human", -150, 62);
    if (prg > 160 && prg < 210) {
      ctx.fillStyle = C.green;
      ctx.fillText("✓", -150, 48);
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
    var prg = (frame * 0.042) % 230;
    var isMoving = false;
    var faceDir = 1;
    var targets = {
      "1_architect": { x: -140, y: 20 },
      "2_recruiter": { x: 20, y: -70 },
      "3_ai": { x: 50, y: 10 },
      "4_comms": { x: 130, y: -30 },
      "5_ats": { x: 145, y: 25 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else {
        this.x = tgt.x;
        this.y = tgt.y;
        if (local === 11 && Math.random() < 0.35) {
          createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
        }
        if (local > 16) {
          isMoving = true;
          faceDir = -1;
          var back = (local - 16) / 6;
          this.x = tgt.x - (tgt.x - this.baseX) * back;
          this.y = tgt.y - (tgt.y - this.baseY) * back;
        }
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
    ctx.save();
    ctx.translate(this.x, this.y + bob);
    drawRR(ctx, -12, -8, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -16, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new ResumeOrbitStream());
  entities.push(new ComplianceShield());
  entities.push(new TalentScoreTerminal());
  entities.push(new InterviewPrepRibbon());
  entities.push(new CandidateCommsPod());
  entities.push(new AtsBridgeNode());

  entities.push(new Agent(-175, 55, C.agentYellow, "1_architect", 18, [
    "Карта воронки готова", "Must-have критерии", "Аудит HR-рутины"
  ]));
  entities.push(new Agent(-155, 75, C.agentGreen, "2_recruiter", 58, [
    "Shortlist на review", "Финал — за мной", "Explainable score ок"
  ]));
  entities.push(new Agent(-120, 45, C.agentBlue, "3_ai", 98, [
    "Парсинг резюме...", "Score 84%", "Калибровка NLP"
  ]));
  entities.push(new Agent(-90, 70, C.agentPink, "4_comms", 138, [
    "Шаблон письма", "Статус в Telegram", "Follow-up отправлен"
  ]));
  entities.push(new Agent(-60, 50, C.agentPurple, "5_ats", 178, [
    "Webhook в Huntflow", "Карточка создана", "Тег shortlist"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 240, maxLife: customLife || 240 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.042) % 230;
    if (prg >= 12 && prg < 12.08) createBubble(-90, -20, "1. Отклик с hh.ru");
    if (prg >= 52 && prg < 52.08) createBubble(10, -55, "2. AI-скоринг 84%");
    if (prg >= 102 && prg < 102.08) createBubble(140, -35, "3. Чат кандидату");
    if (prg >= 142 && prg < 142.08) createBubble(0, 52, "4. Вопросы к интервью");
    if (prg >= 188 && prg < 188.08) createBubble(150, 30, "5. В ATS · review");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
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
      ctx.fillText(bub.text, bx, by - th / 2 + 1);
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


<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ — Борис (не hero)
     ==================================================== -->
<div class="vnhr-content vnedrenie-ai-hr-podbor-personala-page">

  <!-- INTRO + KPI -->
  <section class="vnhr-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vnhr-cnt">
      <div class="vnhr-intro-grid nero-ai-reveal">
        <div class="vnhr-intro-text">
          <span class="vnhr-eyebrow">Лонгрид · AI для HR</span>
          <p><strong>Коротко:</strong> AI для HR — это не одна нейросеть, а связка модулей вокруг воронки найма: скрининг резюме, подготовка к интервью, коммуникация с кандидатами и HR-аналитика. По данным hh.ru (июнь 2026, цит. HR-рейтинги), <strong>62%</strong> российских работодателей верят в пользу автоматизации подбора, но реально применяют AI в найме лишь <strong>~5%</strong>. Разрыв «хочу / делаю» — главный аргумент для внедрения AI-агентов под ключ.</p>
          <p>Nero Network внедряет <strong>AI для HR</strong> поверх вашей ATS и CRM — без замены Huntflow, Potok или Битрикс24. Скрининг, коммуникация, аналитика найма и соблюдение 152-ФЗ — в одном проекте с human-in-the-loop на каждом критичном этапе.</p>
        </div>
        <div class="vnhr-intro-kpi" aria-label="Ключевые метрики HR AI">
          <div class="vnhr-kpi-card"><div class="kv">62% vs 5%</div><div class="kl">верят в AI / реально внедрили</div><div class="ks">hh.ru, 2026</div></div>
          <div class="vnhr-kpi-card"><div class="kv">85%</div><div class="kl">подтверждают экономию времени</div><div class="ks">HR-рейтинги, 2026</div></div>
          <div class="vnhr-kpi-card"><div class="kv">67%</div><div class="kl">требуют explainable AI</div><div class="ks">HR-рейтинги, 2026</div></div>
          <div class="vnhr-kpi-card"><div class="kv">150к–1М ₽</div><div class="kl">ориентир бюджета под ключ</div><div class="ks">Google Таблица</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vnhr-toc-outer">
    <div class="vnhr-cnt">
      <nav class="vnhr-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Этапы</a>
        <a href="#skrining">Скрининг</a>
        <a href="#kommunikaciya">Коммуникация</a>
        <a href="#analitika">Аналитика</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Цены</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- H2-1: Что такое AI для HR -->
  <section class="vnhr-section" id="kak-rabotaet">
    <div class="vnhr-cnt">
      <div class="vnhr-sh vnhr-left nero-ai-reveal">
        <span class="vnhr-eyebrow">Ядро · ai для hr</span>
        <h2>Что такое AI для HR и какие задачи он закрывает в подборе персонала</h2>
        <p><strong>Определение:</strong> AI для HR в контексте подбора персонала — программные агенты на базе NLP и LLM, которые автоматизируют рутинные этапы воронки найма. Финальные кадровые решения остаются за человеком — требование ст. 16 152-ФЗ.</p>
      </div>

      <div class="vnhr-card nero-ai-reveal" style="margin-top:32px">
        <h3>Скрининг резюме, интервью, коммуникация и аналитика — четыре зоны автоматизации</h3>
        <p>Четыре модуля закрывают <strong>80% рутины</strong> рекрутера:</p>
        <ol>
          <li><strong>Скрининг резюме</strong> — NLP/LLM ранжирует отклики, выделяет топ-кандидатов и объясняет совпадение с профилем вакансии.</li>
          <li><strong>Подготовка к интервью</strong> — вопросы, чек-листы, «красные флаги» и summary по резюме под роль и грейд.</li>
          <li><strong>Коммуникация с кандидатами</strong> — чат-боты, голосовые агенты, письма, напоминания, follow-up.</li>
          <li><strong>HR-аналитика</strong> — time-to-fill, cost-per-hire, конверсия по этапам в одном дашборде.</li>
        </ol>
        <p>По данным HR-рейтингов (2026), <strong>85%</strong> работодателей, уже внедривших AI, подтверждают экономию времени. <strong>67%</strong> рекрутеров требуют объяснимости решений AI.</p>
      </div>

      <div class="vnhr-card nero-ai-reveal" style="margin-top:24px">
        <h3>Нейросети для HR vs классические ATS: когда нужен AI-агент поверх процессов</h3>
        <p>Готовые ATS с AI (Huntflow, Potok, Skillaz, hh Talantix) закрывают базовые сценарии. У растущих компаний часто возникают задачи, которые «коробка» не решает: нестандартная воронка, несколько ATS, кастомные критерии скоринга, интеграция с 1С:ЗУП и требования 152-ФЗ.</p>
        <p><strong>Позиция Nero Network:</strong> достраиваем AI-агентов поверх уже купленной ATS — по архитектуре, близкой к Microsoft Copilot Studio (event triggers → агент → уведомление рекрутеру), со стеком для России: YandexGPT/GigaChat, Telegram, серверы в РФ.</p>
        <div class="vnhr-table-wrap">
          <table class="vnhr-table" aria-label="Готовая HR-AI платформа vs кастомное внедрение">
            <thead><tr><th>Критерий</th><th>Готовая HR-AI платформа</th><th>Кастомное внедрение под ключ</th></tr></thead>
            <tbody>
              <tr><td>Срок запуска</td><td>1–2 недели</td><td>2–4 недели пилот, 1–3 мес. полный контур</td></tr>
              <tr><td>Бюджет</td><td>Подписка ATS + модули AI</td><td>150 тыс.–1 млн ₽ (проект)</td></tr>
              <tr><td>Гибкость</td><td>Ограничена платформой</td><td>Любая воронка, мульти-ATS, кастомные триггеры</td></tr>
              <tr><td>152-ФЗ / локализация</td><td>Зависит от вендора</td><td>Проектируется под ваш контур</td></tr>
              <tr><td>Explainable AI</td><td>Базовый score</td><td>Score + обоснование + лог аудита</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- H2-2: Внедрение под ключ -->
  <section class="vnhr-section vnhr-section-alt" id="etapy">
    <div class="vnhr-cnt">
      <div class="vnhr-sh nero-ai-reveal">
        <span class="vnhr-eyebrow">Внедрение ai для hr под ключ</span>
        <h2>Внедрение AI для HR под ключ: этапы и зона ответственности Nero Network</h2>
        <p>Проект с чёткими фазами, измеримым результатом и сопровождением — не «купили подписку и разбирайтесь сами».</p>
      </div>

      <div class="vnhr-timeline nero-ai-reveal">
        <div class="vnhr-tl-item"><div class="vnhr-tl-dot"></div><h3>Фаза 0 — Аудит HR-рутины</h3><p>Карта воронки, объёмы откликов, ATS/CRM, каналы, узкие места, 152-ФЗ. На выходе — дорожная карта с приоритетом модулей и оценкой ROI.</p></div>
        <div class="vnhr-tl-item"><div class="vnhr-tl-dot"></div><h3>Фаза 1 — Пилот (2–4 недели)</h3><p>Один модуль на 1–2 вакансиях: чаще AI-скрининг откликов или чат-бот первичного скрининга.</p></div>
        <div class="vnhr-tl-item"><div class="vnhr-tl-dot"></div><h3>Фаза 2 — Интеграция</h3><p>Двусторонняя связь с ATS, уведомления рекрутеру в Telegram или Битрикс24.</p></div>
        <div class="vnhr-tl-item"><div class="vnhr-tl-dot"></div><h3>Фаза 3 — Расширение</h3><p>Генерация вопросов к интервью, аналитический дашборд (time-to-fill, source of hire, конверсия этапов).</p></div>
        <div class="vnhr-tl-item"><div class="vnhr-tl-dot"></div><h3>Фаза 4 — Governance</h3><p>Политика AI в найме, согласия на ПДн, журнал решений AI, ежеквартальный bias-review.</p></div>
      </div>

      <div class="vnhr-card nero-ai-reveal" style="margin-top:32px">
        <h3>Разработка, настройка и интеграция: что входит в проект «под ключ»</h3>
        <ul>
          <li>проектирование архитектуры агентов (intake, screening, comms, analytics);</li>
          <li>настройка LLM под ваши вакансии и критерии скоринга;</li>
          <li>интеграция с ATS/CRM через API (Huntflow, Potok, Битрикс24, e-staff);</li>
          <li>подключение job-площадок (hh.ru, Авито, SuperJob) и мессенджеров;</li>
          <li>оркестрация потоков (n8n, Make.com, webhooks);</li>
          <li>обучение HR-команды и governance-слой: согласия, логи, запрет auto-reject без human review.</li>
        </ul>
        <p><strong>От клиента:</strong> профили вакансий, 50–200 исторических резюме для калибровки, регламент воронки, доступы к API.</p>
      </div>
    </div>
  </section>

  <!-- БОРИС: визуальный блок (после H2-2, перед CTA-1) -->
  <section id="vnedrenie-ai-hr-podbor-personala-boris-block" class="bh-root" aria-label="Анимация: AI-скрининг резюме и формирование shortlist в ATS">
<style>
#vnedrenie-ai-hr-podbor-personala-boris-block.bh-root{padding:56px 0 64px;background:#f8fafc}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #vnedrenie-ai-hr-podbor-personala-boris-block .bh-card{grid-template-columns:1fr;min-height:auto}
}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-hr-podbor-personala-boris-block .bh-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}
}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#6366f1;margin:0 0 14px;
}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-ey::before{content:'';width:18px;height:2px;background:#6366f1;border-radius:1px}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(99,102,241,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#6366f1;margin-top:1px;font-style:normal;
}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-pl-b{background:rgba(99,102,241,.08);color:#4338ca;border:1.5px solid rgba(99,102,241,.22)}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-pl-v{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22)}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0}
#vnedrenie-ai-hr-podbor-personala-boris-block .bh-rgt{
  background:linear-gradient(145deg,#f1f5f9 0%,#e8eef5 55%,#f8fafc 100%);
  position:relative;overflow:hidden;min-height:420px;
}
@media(max-width:1023px){#vnedrenie-ai-hr-podbor-personala-boris-block .bh-rgt{min-height:360px}}
#bh-hr-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>
<div class="bh-cnt">
  <div class="bh-card">
    <div class="bh-lft">
      <span class="bh-ey">Скрининг в действии</span>
      <h3 class="bh-h3">200+ откликов → explainable shortlist за минуты, не дни</h3>
      <ul class="bh-ul">
        <li><span class="bh-ic">1</span>Резюме парсится: навыки, опыт, грейд — сравнение с профилем вакансии</li>
        <li><span class="bh-ic">2</span>AI выдаёт score и текстовое обоснование («совпадение 78%, не хватает X»)</li>
        <li><span class="bh-ic">3</span>Топ-кандидаты попадают в shortlist ATS — рекрутер решает финал</li>
        <li><span class="bh-ic">?</span>Низкий score — не автоотказ, а очередь human review по 152-ФЗ</li>
      </ul>
      <div class="bh-pills">
        <span class="bh-pl bh-pl-g">70% рутины ↓</span>
        <span class="bh-pl bh-pl-b">92% pairwise*</span>
        <span class="bh-pl bh-pl-v">human-in-the-loop</span>
      </div>
      <p class="bh-foot">Дальше — риски bias, 152-ФЗ и прозрачность для кандидатов →</p>
    </div>
    <div class="bh-rgt">
      <canvas id="bh-hr-pipeline-canvas" aria-label="Анимация: поток резюме проходит AI-скрининг с оценкой и формирует shortlist в ATS" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bh-hr-pipeline-canvas');
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
    ink:'#0f172a', paper:'#ffffff', paperBdr:'#cbd5e1',
    ai:'#6366f1', aiGlow:'rgba(99,102,241,.2)',
    hi:'#22c55e', mid:'#f59e0b', low:'#94a3b8',
    ats:'#0ea5e9', line:'rgba(14,165,233,.3)',
    muted:'#64748b', text:'#1e293b'
  };

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function drawResume(x,y,s,alpha){
    ctx.save();
    ctx.globalAlpha = alpha || 1;
    rr(x-s*0.35,y-s*0.45,s*0.7,s*0.9,5,C.paper,C.paperBdr);
    ctx.fillStyle=C.muted;
    for(var i=0;i<3;i++){
      ctx.fillRect(x-s*0.22,y-s*0.28+i*s*0.14,s*0.44,s*0.06);
    }
    ctx.restore();
  }

  var resumes = [];
  var shortlist = [];
  var cycleT = 0;

  function spawnResume(){
    var scores = [88,76,62,45,91,55,72];
    var sc = scores[Math.floor(Math.random()*scores.length)];
    resumes.push({
      x: -40, y: H*0.25 + Math.random()*H*0.45,
      vx: 1.2 + Math.random()*0.6, score: sc,
      phase: 0, id: Math.random()
    });
  }

  function tick(){
    frame++;
    cycleT++;
    if(cycleT % 55 === 0) spawnResume();

    ctx.clearRect(0,0,W,H);

    /* lanes labels */
    var lx = W*0.08, ax = W*0.42, sx = W*0.72;
    ctx.font = '600 11px Inter,system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('ОТКЛИКИ', lx, 28);
    ctx.fillText('AI СКРИНИНГ', ax-20, 28);
    ctx.fillText('SHORTLIST', sx, 28);

    /* AI scanner zone */
    ctx.fillStyle = C.aiGlow;
    rr(ax-30, H*0.12, 80, H*0.76, 16, C.aiGlow, null);
    rr(ax-22, H*0.18, 64, H*0.64, 12, 'rgba(99,102,241,.12)', 'rgba(99,102,241,.35)');
    ctx.fillStyle = C.ai;
    ctx.font = '800 13px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', ax+10, H*0.5);
    ctx.textAlign = 'left';

    /* scan line */
    var scanY = H*0.18 + (Math.sin(frame*0.04)+1)*0.5*(H*0.64);
    ctx.strokeStyle = 'rgba(99,102,241,.5)';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(ax-22, scanY);
    ctx.lineTo(ax+42, scanY);
    ctx.stroke();

    /* ATS shortlist panel */
    rr(sx-10, H*0.15, W*0.22, H*0.7, 14, 'rgba(14,165,233,.06)', 'rgba(14,165,233,.25)');
    ctx.fillStyle = C.ats;
    ctx.font = '700 10px Inter,system-ui,sans-serif';
    ctx.fillText('Huntflow · ATS', sx, H*0.15+18);

  for(var i=resumes.length-1;i>=0;i--){
    var r = resumes[i];
    r.x += r.vx;
    if(r.x > ax-10 && r.x < ax+50 && r.phase === 0){
      r.phase = 1;
      if(r.score >= 70){
        shortlist.push({y: H*0.28 + shortlist.length*42, score:r.score, alpha:0, name:'Кандидат '+String.fromCharCode(65+(shortlist.length%5))});
        if(shortlist.length > 5) shortlist.shift();
      }
    }
    var col = r.score>=70?C.hi:(r.score>=55?C.mid:C.low);
    drawResume(r.x, r.y, 28, r.x > W*0.95 ? 0.3 : 1);
    if(r.phase === 1 && r.x > ax+20){
      ctx.font = '700 11px Inter,system-ui,sans-serif';
      ctx.fillStyle = col;
      ctx.fillText(r.score+'%', r.x+20, r.y-8);
    }
    if(r.x > W+50) resumes.splice(i,1);
  }

  for(var j=0;j<shortlist.length;j++){
    var s = shortlist[j];
    s.alpha = Math.min(1, s.alpha + 0.03);
    ctx.save();
    ctx.globalAlpha = s.alpha;
    var sy = H*0.28 + j*42;
    rr(sx, sy, W*0.18, 34, 8, C.paper, 'rgba(14,165,233,.3)');
    ctx.fillStyle = C.text;
    ctx.font = '600 11px Inter,system-ui,sans-serif';
    ctx.fillText(s.name, sx+10, sy+14);
    ctx.fillStyle = C.hi;
    ctx.fillText(s.score+'%', sx+10, sy+28);
    ctx.restore();
  }

    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
  </section>

  <!-- CTA-1: после внедрения, перед скринингом -->
  <div class="vnhr-cnt">
    <aside class="ym-cta-block ym-cta-block--primary" id="cta-audit-hr">
      <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Аудит HR-рутины — бесплатно</p>
        <p class="ym-cta-block__sub">Разберём воронку найма, объёмы откликов и узкие места. На выходе — дорожная карта с приоритетом модулей и оценкой ROI. Без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </aside>
  </div>

  <!-- H2-3: Скрининг -->
  <section class="vnhr-section" id="skrining">
    <div class="vnhr-cnt">
      <div class="vnhr-sh vnhr-left nero-ai-reveal">
        <span class="vnhr-eyebrow">ai подбор персонала</span>
        <h2>AI для скрининга резюме и первичного отбора кандидатов</h2>
        <p>На первичный отбор уходит до <strong>70%</strong> рабочего дня рекрутера. При 200+ откликах на вакансию сильные кандидаты уходят к конкурентам, пока HR разбирает очередь.</p>
      </div>

      <div class="vnhr-card nero-ai-reveal">
        <h3>Как нейросеть ранжирует резюме и снижает время на первичный отбор</h3>
        <ol>
          <li>Отклик с hh.ru / формы / email → webhook в оркестратор.</li>
          <li>Резюме парсится → ПДн маскируются для логов → LLM сравнивает с требованиями вакансии.</li>
          <li>AI выдаёт score + объяснение → запись в ATS.</li>
          <li>Рекрутер получает shortlist в мессенджере → финальное решение — <strong>только человек</strong>.</li>
        </ol>
        <p>Potok (март 2026): AI-скоринг — <strong>92%</strong> точности pairwise-сравнения. Huntflow AI пилот: time-to-fill junior <strong>20→9</strong> дней, middle <strong>60→32</strong> дня. Кейс «Свеза»: <strong>+20%</strong> конверсия, <strong>−15%</strong> время закрытия вакансий.</p>
      </div>

      <div class="vnhr-callout nero-ai-reveal" id="vnhr-compliance">
        <h3>152-ФЗ, bias и прозрачность</h3>
        <p><strong>Bias:</strong> регулярный аудит критериев, запрет обучения на «отклонённых» без human review. <strong>152-ФЗ:</strong> с 01.09.2025 согласие — отдельный документ; ст. 16 запрещает решения исключительно на основании АПР. <strong>Прозрачность:</strong> каждый кандидат в shortlist получает score и текстовое обоснование — explainable shortlist, не «чёрный ящик».</p>
      </div>
    </div>
  </section>

  <!-- H2-4: Коммуникация -->
  <section class="vnhr-section vnhr-section-alt" id="kommunikaciya">
    <div class="vnhr-cnt">
      <div class="vnhr-sh nero-ai-reveal">
        <span class="vnhr-eyebrow">ai агенты для hr</span>
        <h2>AI-агенты для коммуникации с кандидатами и подготовки интервью</h2>
        <p>Автономные агенты с триггерами, интеграцией в ATS и сценариями под бренд работодателя — не ChatGPT в браузере.</p>
      </div>

      <div class="vnhr-grid-2 nero-ai-reveal">
        <div class="vnhr-card">
          <h3>Статусы, напоминания, ответы на типовые вопросы</h3>
          <ul>
            <li>мгновенный ответ на типовые вопросы (график, формат, этапы);</li>
            <li>персонализированные статусы и напоминания;</li>
            <li>follow-up для «зависших» кандидатов.</li>
          </ul>
        </div>
        <div class="vnhr-card">
          <h3>Генерация вопросов к интервью</h3>
          <ul>
            <li>10–15 вопросов под вакансию и грейд;</li>
            <li>чек-лист компетенций и «красные флаги»;</li>
            <li>summary кандидата — экономия 30–40 мин подготовки.</li>
          </ul>
        </div>
      </div>

      <div class="vnhr-quote-card nero-ai-reveal">
        <blockquote>«Внедрение голосового помощника и чат-ботов оптимизирует этап коммуникации с соискателями.»</blockquote>
        <cite>— Ирина Кузьмина, руководитель подбора и адаптации, ГК «Свеза»</cite>
      </div>
      <p class="nero-ai-reveal">Архитектурный ориентир — Microsoft Copilot Studio Recruitment Assistant Agent. Nero Network адаптирует модель для России: Telegram вместо Teams, YandexGPT вместо Copilot, интеграция с Huntflow/Potok.</p>
    </div>
  </section>

  <!-- H2-5: Аналитика -->
  <section class="vnhr-section" id="analitika">
    <div class="vnhr-cnt">
      <div class="vnhr-sh nero-ai-reveal">
        <span class="vnhr-eyebrow">hr аналитика найма ai</span>
        <h2>HR-аналитика найма на базе AI: метрики, дашборды, ROI</h2>
        <p>Без цифр HR-директору сложно обосновать бюджет на автоматизацию рекрутинга перед руководством.</p>
      </div>

      <div class="vnhr-table-wrap nero-ai-reveal">
        <table class="vnhr-table" aria-label="Метрики HR-аналитики">
          <thead><tr><th>Метрика</th><th>Что показывает</th><th>Ориентир рынка</th></tr></thead>
          <tbody>
            <tr><td>Time-to-fill</td><td>Дней от публикации до оффера</td><td>−30–50% при AI</td></tr>
            <tr><td>Cost-per-hire</td><td>Стоимость закрытия вакансии</td><td>−20–40%</td></tr>
            <tr><td>Конверсия по этапам</td><td>Где «сыпется» воронка</td><td>Аномалии в реальном времени</td></tr>
            <tr><td>Source of hire</td><td>Лучший канал кандидатов</td><td>Оптимизация бюджета job-площадок</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vnhr-card nero-ai-reveal">
        <h3>ROI-калькулятор (упрощённая формула)</h3>
        <div class="vnhr-roi-box">Экономия = (Часы на скрининг/мес. × Ставка рекрутера) − Стоимость проекта / 12</div>
        <p>Пример: 2 рекрутера × 60 ч/мес. на отбор, ставка 80 000 ₽. Экономия 40% рутины ≈ 64 000 ₽/мес. Пилот за 150 000 ₽ окупается за <strong>2–3 месяца</strong>. SHRM 2026: AI в recruiting — <strong>27%</strong> организаций; в России — <strong>~5%</strong> (hh.ru).</p>
      </div>
    </div>
  </section>

  <!-- H2-6: Интеграции -->
  <section class="vnhr-section vnhr-section-alt" id="integracii">
    <div class="vnhr-cnt">
      <div class="vnhr-sh nero-ai-reveal">
        <span class="vnhr-eyebrow">ai для hr с crm</span>
        <h2>Интеграция AI для HR с ATS, CRM и корпоративными системами</h2>
        <p>Агент без интеграции — ChatGPT в браузере: нет триггеров, нет аналитики, риск утечки ПДн.</p>
      </div>

      <div class="vnhr-table-wrap nero-ai-reveal">
        <table class="vnhr-table" aria-label="Интеграции ATS">
          <thead><tr><th>Система</th><th>Сценарий интеграции AI</th></tr></thead>
          <tbody>
            <tr><td><strong>Huntflow</strong></td><td>Скоринг откликов, AI-поиск в базе, генерация писем, webhook</td></tr>
            <tr><td><strong>Potok</strong></td><td>Доп. агенты поверх встроенного AI, кастомные воронки</td></tr>
            <tr><td><strong>Битрикс24</strong></td><td>AI-скрининг в HR-воронке, роботы, CoPilot, hh.ru</td></tr>
            <tr><td><strong>hh Talantix</strong></td><td>Черновик вакансии, поиск в базе, первичный диалог</td></tr>
            <tr><td><strong>1С:ЗУП</strong></td><td>Синхронизация кадровых данных, штатное расписание</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vnhr-logos nero-ai-reveal" aria-label="Интеграции">
        <span class="vnhr-logo-pill">Huntflow</span>
        <span class="vnhr-logo-pill">Potok</span>
        <span class="vnhr-logo-pill">Битрикс24</span>
        <span class="vnhr-logo-pill">hh.ru</span>
        <span class="vnhr-logo-pill">Telegram</span>
        <span class="vnhr-logo-pill">1С:ЗУП</span>
      </div>

      <div class="vnhr-card nero-ai-reveal">
        <h3>Готовая платформа vs кастом под ключ</h3>
        <p><strong>Хватит готовой:</strong> стандартная воронка, одна ATS, типовые вакансии. <strong>Нужен кастом:</strong> несколько ATS, нестандартные этапы, жёсткие требования ИБ и 152-ФЗ, интеграция с LDAP/1С/SAP. Nero Network работает в обеих моделях.</p>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- H2-7: Сегменты -->
  <section class="vnhr-section" id="segmenty">
    <div class="vnhr-cnt">
      <div class="vnhr-sh nero-ai-reveal">
        <span class="vnhr-eyebrow">ai для hr для бизнеса</span>
        <h2>AI для HR для малого, среднего и растущего бизнеса</h2>
        <p>Начать с одного этапа воронки, а не «внедрить всё сразу».</p>
      </div>

      <div class="vnhr-table-wrap nero-ai-reveal">
        <table class="vnhr-table" aria-label="Сегменты и бюджет">
          <thead><tr><th>Сегмент</th><th>Штат HR</th><th>Старт</th><th>Бюджет</th></tr></thead>
          <tbody>
            <tr><td>Малый (до 100)</td><td>1 рекрутер</td><td>AI-скрининг + чат статусов</td><td>от 150 тыс. ₽</td></tr>
            <tr><td>Средний (100–500)</td><td>2–5 рекрутеров</td><td>Скрининг + comms + аналитика</td><td>300–500 тыс. ₽</td></tr>
            <tr><td>Растущий (500+)</td><td>HR-отдел + HRD</td><td>Полный контур + governance</td><td>500 тыс.–1 млн ₽</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vnhr-card nero-ai-reveal">
        <h3>Можно ли внедрить AI для HR без программиста</h3>
        <p><strong>Да</strong> — при модели «под ключ». HR не пишет код: интегратор настраивает агентов, подключает ATS, обучает рекрутеров. Low-code (n8n, Make.com) — на стороне Nero Network.</p>
      </div>
    </div>
  </section>

  <!-- CTA-2 -->
  <div class="vnhr-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie-hr">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите понимать AI в HR до старта проекта?</p>
        <p class="ym-cta-block__sub">Если HR-команда хочет разобраться в n8n, промптах, human-in-the-loop и интеграции с ATS до пилота — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование сценариев с HRD и IT.</p>
      </div>
    </aside>
  </div>

  <!-- H2-8: Цены -->
  <section class="vnhr-section vnhr-section-alt" id="ceny">
    <div class="vnhr-cnt">
      <div class="vnhr-sh nero-ai-reveal">
        <span class="vnhr-eyebrow">ai для hr цена</span>
        <h2>Сколько стоит AI для HR: цены, сроки и окупаемость</h2>
      </div>

      <div class="vnhr-table-wrap nero-ai-reveal">
        <table class="vnhr-table" aria-label="Бюджет проекта">
          <thead><tr><th>Этап</th><th>Что входит</th><th>Стоимость</th></tr></thead>
          <tbody>
            <tr><td>Аудит HR-рутины</td><td>Карта воронки, roadmap</td><td>Бесплатно</td></tr>
            <tr><td>Пилот (2–4 нед.)</td><td>1 модуль, 1–2 вакансии</td><td>150–300 тыс. ₽</td></tr>
            <tr><td>Интеграция</td><td>ATS + мессенджеры + job-площадки</td><td>200–400 тыс. ₽</td></tr>
            <tr><td>Полный контур</td><td>4 модуля + аналитика + governance</td><td>500 тыс.–1 млн ₽</td></tr>
            <tr><td>Сопровождение</td><td>Калибровка, bias-review</td><td>от 30 тыс. ₽/мес.</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vnhr-card nero-ai-reveal">
        <h3>ROI: окупаемость</h3>
        <ul>
          <li>снижение cost-per-hire на <strong>20–40%</strong>;</li>
          <li>сокращение time-to-fill на <strong>30–50%</strong>;</li>
          <li>пилот скрининга при 100+ откликов/вакансию — окупаемость <strong>1–4 месяца</strong>.</li>
        </ul>
        <p>«Свеза» — <strong>−15%</strong> время закрытия; Huntflow AI — junior <strong>20→9</strong> дней.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny-hr">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет под ваш объём найма</p>
          <p class="ym-cta-block__sub">Ориентир 150 тыс.–1 млн ₽ за внедрение под ключ. На бесплатном аудите HR-рутины дадим оценку сроков, совместимости с ATS и ROI — с цифрами для CFO.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-9: Кейсы -->
  <section class="vnhr-section" id="keisy">
    <div class="vnhr-cnt">
      <div class="vnhr-sh nero-ai-reveal">
        <span class="vnhr-eyebrow">ai для hr кейсы</span>
        <h2>Кейсы и примеры внедрения AI в HR</h2>
      </div>

      <div class="vnhr-case-grid nero-ai-reveal">
        <article class="vnhr-case-card">
          <div class="vnhr-case-tag">Подтверждённый · Россия</div>
          <h3>ГК «Свеза» + Поток</h3>
          <p>Голосовой помощник, чат-боты, AI-скоринг. <strong>+20%</strong> конверсия, <strong>−15%</strong> time-to-close.</p>
        </article>
        <article class="vnhr-case-card">
          <div class="vnhr-case-tag">Пилот · Huntflow AI</div>
          <h3>Time-to-fill</h3>
          <p>Junior <strong>20→9</strong> дней, middle <strong>60→32</strong> дня. AI-поиск в базе + follow-up.</p>
        </article>
        <article class="vnhr-case-card">
          <div class="vnhr-case-tag">Архитектура · Global</div>
          <h3>Microsoft Copilot Studio</h3>
          <p>Recruitment Assistant Agent: ранжирование, pipeline, event triggers на резюме.</p>
        </article>
      </div>

      <div class="vnhr-card nero-ai-reveal" style="margin-top:28px">
        <h3>Типовые ошибки первого пилота</h3>
        <ol>
          <li>Сразу автоматизировать всю воронку — начните с одного модуля.</li>
          <li>Не калибровать скоринг — передайте 50–200 исторических откликов.</li>
          <li>Игнорировать 152-ФЗ — отдельное согласие, human-in-the-loop.</li>
          <li>Не измерять ROI — зафиксируйте baseline до пилота.</li>
        </ol>
      </div>
    </div>
  </section>

  <!-- H2-10: План внедрения -->
  <section class="vnhr-section vnhr-section-alt" id="plan">
    <div class="vnhr-cnt">
      <div class="vnhr-sh nero-ai-reveal">
        <span class="vnhr-eyebrow">как внедрить ai для hr</span>
        <h2>Как внедрить AI для HR: пошаговый план и чек-лист</h2>
      </div>

      <div class="vnhr-table-wrap nero-ai-reveal">
        <table class="vnhr-table" aria-label="Самостоятельно vs подрядчик">
          <thead><tr><th>Критерий</th><th>ChatGPT + таблицы</th><th>Подрядчик под ключ</th></tr></thead>
          <tbody>
            <tr><td>Интеграция с ATS</td><td>Нет</td><td>API, webhooks, синхронизация</td></tr>
            <tr><td>Триггеры</td><td>Ручной запуск</td><td>Event-driven</td></tr>
            <tr><td>152-ФЗ</td><td>Риск утечки ПДн</td><td>Локализация, согласия, логи</td></tr>
            <tr><td>Срок до пилота</td><td>Эксперимент</td><td>2–4 недели</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vnhr-card nero-ai-reveal">
        <h3>Чек-лист аудита HR-рутины</h3>
        <ul class="vnhr-checklist">
          <li>Сколько откликов в месяц на типовую вакансию?</li>
          <li>Сколько часов на первичный скрининг?</li>
          <li>Какая ATS/CRM? Есть ли API?</li>
          <li>Каналы откликов (hh.ru, сайт, Telegram, email)?</li>
          <li>SLA ответа кандидату — соблюдается?</li>
          <li>Отдельное согласие на ПДн кандидатов?</li>
          <li>Где хранятся резюме? Серверы в РФ?</li>
          <li>Метрики: time-to-fill, cost-per-hire?</li>
          <li>Исторические данные для калибровки?</li>
          <li>Кто принимает финальное решение?</li>
        </ul>
        <p>Заполненный чек-лист — вход для бесплатного <strong>аудита HR-рутины</strong> от Nero Network.</p>
      </div>
    </div>
  </section>

  <!-- H2-11: FAQ -->
  <section class="vnhr-section" id="faq">
    <div class="vnhr-cnt">
      <div class="vnhr-sh nero-ai-reveal">
        <span class="vnhr-eyebrow">FAQ</span>
        <h2>FAQ по AI для HR и подбору персонала</h2>
      </div>

      <div class="vnhr-faq nero-ai-reveal" id="vnhr-faq-accordion">
        <div class="vnhr-faq-item">
          <div class="vnhr-faq-q" role="button" tabindex="0">Какие риски и ограничения у AI в рекрутинге?</div>
          <div class="vnhr-faq-a"><p>Bias, нарушение 152-ФЗ, утечка ПДн — закрываются governance-слоем: explainable shortlist, human-in-the-loop, серверы в РФ. Для EU-филиалов — AI Act high-risk (обязательства с декабря 2027).</p></div>
        </div>
        <div class="vnhr-faq-item">
          <div class="vnhr-faq-q" role="button" tabindex="0">Сколько длится внедрение и что нужно от HR-команды?</div>
          <div class="vnhr-faq-a"><p>Пилот — 2–4 недели. Полный контур — 1–3 месяца. От HR: профили вакансий, 50–200 резюме для калибровки, доступы к ATS, 2–4 ч/нед. на тестирование.</p></div>
        </div>
        <div class="vnhr-faq-item">
          <div class="vnhr-faq-q" role="button" tabindex="0">Как связать AI с уже работающими процессами найма?</div>
          <div class="vnhr-faq-a"><p>AI подключается поверх воронки через API ATS/CRM: отклик → webhook → скрининг → ATS → уведомление рекрутеру → интервью человеком → аналитика.</p></div>
        </div>
        <div class="vnhr-faq-item">
          <div class="vnhr-faq-q" role="button" tabindex="0">Чем AI для HR отличается от ChatGPT?</div>
          <div class="vnhr-faq-a"><p>Автоскрининг при каждом отклике, запись в ATS, письма по шаблону бренда, дашборд метрик, 152-ФЗ, explainable score — как ERP vs калькулятор.</p></div>
        </div>
        <div class="vnhr-faq-item">
          <div class="vnhr-faq-q" role="button" tabindex="0">Какие задачи решает AI для HR?</div>
          <div class="vnhr-faq-a"><p>Скрининг, первичный отбор, вопросы к интервью, коммуникация, поиск в базе, аналитика воронки. Не решает: финальный отбор, переговоры, культурный fit, юридически значимые отказы.</p></div>
        </div>
      </div>

      <div class="vnhr-card nero-ai-reveal" style="margin-top:40px;text-align:center">
        <p><strong>Итог:</strong> AI для HR — измеримая автоматизация рутины с человеческим контролем. Рынок России отстаёт (5% vs 62%), но кейсы доказывают ROI. Nero Network внедряет AI-агентов под ключ поверх вашей ATS.</p>
        <p style="margin-top:16px"><strong>Следующий шаг:</strong> закажите бесплатный <strong>аудит HR-рутины</strong> или оставьте заявку на <strong>автоматизацию подбора</strong>.</p>
      </div>
    </div>
  </section>

</div><!-- /.vnhr-content -->

<script>
(function(){
  var root = document.getElementById('vnhr-faq-accordion');
  if (!root) return;
  root.querySelectorAll('.vnhr-faq-q').forEach(function(q){
    q.addEventListener('click', function(){ q.parentElement.classList.toggle('open'); });
    q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); q.parentElement.classList.toggle('open'); }});
  });
})();
</script>
  <!-- INTERNAL-LINKS:INSERT -->
  <!-- SCHEMA-MARKUP:INSERT -->

</main>


<script>
(function(){
  'use strict';
  var root = document.querySelector('.vnedrenie-ai-hr-podbor-personala-page') || document.querySelector('.vnhr-content');
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
