<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев
 * Description: SEO-лендинг — внедрение AI-агента для сменных заданий и контроля простоев на производстве.
 */

declare(strict_types=1);

$page_seo_title       = 'Внедрение AI на производстве: сменные задания и простои';
$page_seo_description = 'AI-агент для сменных заданий и контроля простоев на производстве. Фиксация простоев в реальном времени, отчёт руководителю. Внедрение под ключ — Nero Network.';

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
    ['label' => 'Боль в цехе',  'href' => '#bolezni'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение',    'href' => '#etapy'],
    ['label' => 'Интеграции',   'href' => '#integracii'],
    ['label' => 'Цена',         'href' => '#ceny'],
    ['label' => 'Кейсы',        'href' => '#keisy'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = 'Как работает';
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

.asz-content{
  --asz-bg:#050711;--asz-bg2:#080b17;--asz-bg3:#0a0e1c;
  --asz-surface:rgba(255,255,255,.072);--asz-surface2:rgba(255,255,255,.108);
  --asz-text:#e6edf7;--asz-muted:#9aa8bd;--asz-soft:#c7d2e5;--asz-heading:#fff;
  --asz-border:rgba(255,255,255,.10);--asz-border-s:rgba(255,255,255,.18);
  --asz-accent:#f5c518;--asz-violet:#8b5cf6;--asz-green:#22c55e;--asz-cyan:#79f2ff;
  --asz-btn-from:#2563eb;--asz-btn-to:#7c3aed;
  --asz-shadow:0 24px 72px rgba(0,0,0,.4);
  --asz-r:18px;--asz-r-lg:24px;--asz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--asz-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.asz-content *,.asz-content *::before,.asz-content *::after{box-sizing:border-box;}
.asz-content a{color:inherit;text-decoration:none;}
.asz-content p{color:var(--asz-muted);line-height:1.72;margin:0 0 1em;}
.asz-content p:last-child{margin-bottom:0;}
.asz-content h2,.asz-content h3,.asz-content h4{color:var(--asz-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.asz-content strong{color:var(--asz-soft);}
.asz-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.asz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--asz-muted);font-size:14.5px;line-height:1.65;}
.asz-content ul li::before{content:'›';position:absolute;left:0;color:var(--asz-accent);font-weight:700;}
.asz-cnt{width:min(var(--asz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.asz-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.asz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.asz-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.asz-sh.asz-left{margin-left:0;text-align:left;}
.asz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.asz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.asz-sh.asz-left p{margin-left:0;}
.asz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--asz-accent);margin-bottom:14px;}
.asz-gt{background:linear-gradient(92deg,#fff 0%,var(--asz-accent) 44%,var(--asz-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.asz-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.asz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.asz-intro-text{position:relative;padding-left:20px;}
.asz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--asz-accent),var(--asz-violet));}
.asz-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--asz-muted);margin-bottom:1em;}
.asz-intro-text p:last-child{margin-bottom:0;color:var(--asz-soft);}
.asz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.asz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.asz-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--asz-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.asz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--asz-muted);line-height:1.4;}
.asz-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.asz-intro-grid{grid-template-columns:1fr;gap:36px;}.asz-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.asz-intro-kpi{grid-template-columns:1fr 1fr;}}
.asz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.asz-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.asz-toc a{display:inline-block;padding:9px 18px;background:var(--asz-surface);border:1px solid var(--asz-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--asz-muted);transition:border-color .2s,color .2s,background .2s;}
.asz-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--asz-accent);background:rgba(245,197,24,.08);}
.asz-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--asz-border);border-radius:var(--asz-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.asz-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.asz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.asz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.asz-grid-2,.asz-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.asz-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.asz-grid-3{grid-template-columns:1fr;}}
.asz-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--asz-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.asz-scenario:last-child{margin-bottom:0;}
.asz-scenario:hover{border-color:rgba(245,197,24,.3);}
.asz-scenario h3{font-size:17px;margin-bottom:8px;}
.asz-scenario p{font-size:14.5px;margin:0 0 .6em;}
.asz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.asz-table{width:100%;border-collapse:collapse;font-size:14px;}
.asz-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--asz-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
.asz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--asz-text);vertical-align:top;}
.asz-table tr:last-child td{border-bottom:none;}
.asz-table tr:hover td{background:rgba(255,255,255,.03);}
.asz-timeline{position:relative;padding-left:40px;}
.asz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--asz-accent),var(--asz-violet));opacity:.35;border-radius:2px;}
.asz-tl-item{position:relative;margin-bottom:32px;}
.asz-tl-item:last-child{margin-bottom:0;}
.asz-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--asz-accent);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.asz-tl-item h3{font-size:17px;margin-bottom:8px;}
.asz-tl-item p{font-size:14.5px;margin:0;}
.asz-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.asz-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.asz-case-grid{grid-template-columns:1fr;}}
.asz-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.asz-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.asz-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--asz-green);margin-bottom:10px;}
.asz-case-card h3{font-size:16px;margin-bottom:14px;}
.asz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.asz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.asz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--asz-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.asz-faq-q::after{content:'▾';font-size:13px;color:var(--asz-accent);flex-shrink:0;transition:transform .25s;}
.asz-faq-item.open .asz-faq-q::after{transform:rotate(180deg);}
.asz-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--asz-muted);line-height:1.72;}
.asz-faq-item.open .asz-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--asz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--asz-btn-from),var(--asz-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--asz-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--asz-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* Скопировать из .a1c-* → .asz-*; добавить: */
.asz-int-grid{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.asz-int-item{display:flex;align-items:center;gap:10px;padding:12px 18px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;font-size:14px;font-weight:600;}
.asz-int-icon{width:36px;height:36px;border-radius:10px;background:rgba(245,197,24,.12);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;color:var(--asz-accent,#f5c518);}
.asz-table-highlight td{background:rgba(245,197,24,.08)!important;font-weight:600;}
.asz-alert{padding:20px 24px;border-radius:16px;border:1px solid rgba(245,197,24,.45);background:rgba(245,197,24,.08);margin-bottom:8px;}
.asz-alert p{margin:0;color:var(--asz-soft,#c7d2e5);font-size:15px;line-height:1.7;}
.asz-roi-list{margin:0;padding-left:20px;color:var(--asz-muted,#9aa8bd);}
.asz-roi-list li{margin-bottom:8px;line-height:1.65;}
.asz-tag-enterprise{color:#f59e0b;}
.asz-tag-related{color:#22c55e;}
.asz-tag-intl{color:#79f2ff;}
.asz-tag-model{color:#8b5cf6;}
</style>

<main id="primary" class="site-main nero-ai-home-page asz-page ai-smennye-zadaniya-kontrol-prostoeev-page" role="main" tabindex="-1">

<section class="nero-ai-hero asz-hero-prostoeev" id="asz-hero-prostoeev" aria-labelledby="asz-hero-title">
<style>
/* ── Hero ai-smennye-zadaniya-kontrol-prostoeev: самодостаточные стили ── */
.asz-hero-prostoeev {
  --asz-gold: #f5c518;
  --asz-cyan: #79f2ff;
  --asz-violet: #8b5cf6;
  --asz-green: #22c55e;
  --asz-amber: #f59e0b;
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
  overflow: hidden;
}
.asz-hero-prostoeev::before {
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
.asz-hero-prostoeev::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 197, 24, .12), transparent 66%);
  filter: blur(8px);
  animation: aszHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
.asz-hero-prostoeev .asz-hero-glow-cyan {
  position: absolute;
  left: -8%;
  bottom: 8%;
  width: 480px;
  height: 480px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .08), transparent 68%);
  filter: blur(10px);
  animation: aszHeroGlow 11s ease-in-out infinite alternate-reverse;
  z-index: -1;
  pointer-events: none;
}
@keyframes aszHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.asz-hero-prostoeev .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.asz-hero-prostoeev .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.asz-hero-prostoeev .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.asz-hero-prostoeev .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--asz-gold) 38%, var(--asz-cyan) 78%, var(--asz-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.asz-hero-prostoeev .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--asz-cyan) !important;
  font-size: 12px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.asz-hero-prostoeev .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--asz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.asz-hero-prostoeev .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.asz-hero-prostoeev .nero-ai-badge {
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
.asz-hero-prostoeev .nero-ai-badge--gold {
  border-color: rgba(245, 197, 24, .28);
  background: rgba(245, 197, 24, .08);
  color: #fde68a;
}
.asz-hero-prostoeev .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.asz-hero-prostoeev .nero-ai-btn {
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
  transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
}
.asz-hero-prostoeev .nero-ai-btn:hover { transform: translateY(-2px); }
.asz-hero-prostoeev .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--asz-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.asz-hero-prostoeev .nero-ai-btn-secondary {
  color: var(--asz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(121, 242, 255, 0.22);
}
.asz-hero-prostoeev .nero-ai-btn-secondary:hover {
  border-color: rgba(121, 242, 255, 0.42);
  box-shadow: 0 12px 32px rgba(121, 242, 255, 0.08);
}
.asz-hero-prostoeev .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--asz-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.asz-hero-prostoeev .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.asz-hero-prostoeev .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.asz-hero-prostoeev .nero-ai-dots { display: flex; gap: 7px; }
.asz-hero-prostoeev .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.asz-hero-prostoeev .nero-ai-dot:nth-child(1) { background: #fb7185; }
.asz-hero-prostoeev .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.asz-hero-prostoeev .nero-ai-dot:nth-child(3) { background: #34d399; }
.asz-hero-prostoeev .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.asz-hero-prostoeev .nero-ai-window-body { padding: 16px; }
.asz-hero-prostoeev .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.asz-hero-prostoeev .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.asz-hero-prostoeev .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
  text-transform: lowercase;
}
.asz-hero-prostoeev .nero-ai-live-pill::before {
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
.asz-hero-prostoeev .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.asz-hero-prostoeev .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.asz-hero-prostoeev .nero-ai-metric span {
  display: block;
  color: var(--asz-muted);
  font-size: 11px;
  font-weight: 700;
}
.asz-hero-prostoeev .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.asz-hero-prostoeev .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.asz-hero-prostoeev .nero-ai-metric--alert {
  border-color: rgba(245, 158, 11, .22);
  background: rgba(245, 158, 11, .06);
}
.asz-hero-prostoeev .nero-ai-metric--alert strong { color: #fde68a; }
.asz-hero-prostoeev .asz-shift-flow {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 8px;
  margin: 0 0 12px;
  padding: 10px;
  border: 1px solid rgba(121, 242, 255, .14);
  border-radius: 16px;
  background: rgba(121, 242, 255, .04);
}
.asz-hero-prostoeev .asz-shift-step {
  text-align: center;
  font-size: 10px;
  font-weight: 700;
  color: var(--asz-muted);
  line-height: 1.35;
}
.asz-hero-prostoeev .asz-shift-step strong {
  display: block;
  margin-bottom: 4px;
  color: var(--asz-cyan);
  font-size: 11px;
}
.asz-hero-prostoeev .asz-shift-step.is-active strong { color: var(--asz-gold); }
.asz-hero-prostoeev .nero-ai-task-stream { display: grid; gap: 8px; }
.asz-hero-prostoeev .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.asz-hero-prostoeev .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121, 242, 255, .12);
  color: var(--asz-cyan);
  font-size: 10px;
  font-weight: 800;
}
.asz-hero-prostoeev .nero-ai-task-icon--warn {
  background: rgba(245, 158, 11, .14);
  color: #fde68a;
}
.asz-hero-prostoeev .nero-ai-task-icon--ai {
  background: rgba(139, 92, 246, .14);
  color: #ddd6fe;
}
.asz-hero-prostoeev .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.asz-hero-prostoeev .nero-ai-task span {
  color: var(--asz-muted);
  font-size: 11px;
}
.asz-hero-prostoeev .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.asz-hero-prostoeev .nero-ai-status--work {
  background: rgba(245, 158, 11, .12);
  color: #fde68a;
}
.asz-hero-prostoeev .nero-ai-status--new {
  background: rgba(121, 242, 255, .12);
  color: #bae6fd;
}
@media (max-width: 1100px) {
  .asz-hero-prostoeev .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .asz-hero-prostoeev .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .asz-hero-prostoeev .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .asz-hero-prostoeev .nero-ai-window-body { padding: 12px; }
  .asz-hero-prostoeev .nero-ai-task { grid-template-columns: 28px 1fr; }
  .asz-hero-prostoeev .nero-ai-status { grid-column: 2; width: fit-content; }
  .asz-hero-prostoeev .asz-shift-flow { grid-template-columns: 1fr 1fr; }
}
</style>

  <div class="asz-hero-glow-cyan" aria-hidden="true"></div>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow">Пилот 6–10 недель · Telegram + 1С</p>
      <h1 id="asz-hero-title">AI-агент для сменных заданий и контроля простоев: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Автоматизируем выдачу заданий на смене, фиксируем простои в моменте и отдаём руководителю понятный отчёт — без ручного хаоса в цехе</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge nero-ai-badge--gold">AI сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">1С</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">OEE</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#karta-poter">Карта потерь производства</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: панель смены и контроль простоев">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Панель смены · демо</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>

          <div class="nero-ai-metrics-grid" aria-label="Метрики смены">
            <div class="nero-ai-metric nero-ai-metric--alert">
              <span>Простои сегодня</span>
              <strong>47 мин</strong>
              <small>за смену</small>
            </div>
            <div class="nero-ai-metric">
              <span>OEE смены</span>
              <strong>68%</strong>
              <small>vs вчера +3%</small>
            </div>
            <div class="nero-ai-metric">
              <span>Заданий в очереди</span>
              <strong>12</strong>
              <small>актуальный приоритет</small>
            </div>
            <div class="nero-ai-metric">
              <span>Реакция на простой</span>
              <strong>4:20</strong>
              <small>мин (baseline)</small>
            </div>
          </div>

          <div class="asz-shift-flow" aria-label="Цикл смены">
            <div class="asz-shift-step"><strong>Задание</strong>выдача</div>
            <div class="asz-shift-step is-active"><strong>Простой</strong>фиксация</div>
            <div class="asz-shift-step"><strong>Переплан</strong>агент</div>
            <div class="asz-shift-step"><strong>Отчёт</strong>handoff</div>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Сменное задание выдано</strong><span>Приоритет пересчитан агентом</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--warn">P03</span>
              <div><strong>Простой: поломка фрезера</strong><span>Код P03, таймер запущен</span></div>
              <span class="nero-ai-status nero-ai-status--work">в работе</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon nero-ai-task-icon--ai">AI</span>
              <div><strong>Агент предложил переплан</strong><span>2 варианта на выбор мастера</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↳</span>
              <div><strong>Handoff для ночной смены</strong><span>Топ-3 потери собраны</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- INTERNAL-LINKS:INSERT -->

<!-- КОНТЕНТНАЯ ЧАСТЬ: вставлять после hero Алины, внутри <div class="asz-content"> -->
<div class="asz-content">

  <section class="asz-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="asz-cnt">
      <div class="asz-intro-grid nero-ai-reveal">
        <div class="asz-intro-text">
          <p class="asz-eyebrow">Лонгрид · ai производство контроль</p>
          <p><strong>Коротко:</strong> Nero Network внедряет AI-агента, который собирает данные по смене, фиксирует простои и отклонения в моменте и формирует отчёт руководителю — без ручного хаоса на доске, в WhatsApp и Excel. Старт — с «Карты потерь производства» и пилота на одном участке за 6–10 недель.</p>
          <p>На малом производстве — мебельном цехе, пищевой линии, участке сборки — смена живёт в другом ритме, чем в презентациях про «Industry 4.0». Задания переписывают на доске или в чате, мастер узнаёт о простое, когда линия уже стоит час, а директор получает сводку «по памяти» в конце дня. <strong>AI производство контроль</strong> в такой среде — не замена всего цеха роботами, а управляемый слой поверх 1С, Excel и Telegram.</p>
        </div>
        <div class="asz-intro-kpi" aria-label="Ключевые метрики производства">
          <div class="asz-kpi-card"><div class="kv">65–75%</div><div class="kl">OEE в РФ</div><div class="ks">vs 85%+ мир</div></div>
          <div class="asz-kpi-card"><div class="kv">25–30%</div><div class="kl">простои планового фонда</div><div class="ks">типичная «норма»</div></div>
          <div class="asz-kpi-card"><div class="kv">6–10</div><div class="kl">недель до пилота</div><div class="ks">Nero Network</div></div>
          <div class="asz-kpi-card"><div class="kv">500К–2М ₽</div><div class="kl">ориентир чека</div><div class="ks">под ключ</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="asz-toc-outer">
    <div class="asz-cnt">
      <nav class="asz-toc" aria-label="Оглавление статьи">
        <a href="#bolezni">Боль в цехе</a>
        <a href="#chto-takoe">Что такое агент</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Цена и ROI</a>
        <a href="#keisy">Кейсы</a>
        <a href="#riski">Риски AI</a>
        <a href="#faq">FAQ</a>
        <a href="#zakazat">Заказать</a>
      </nav>
    </div>
  </div>

  <section class="asz-section" id="bolezni">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Боль малого цеха</span>
        <h2>Почему сменные задания и простои «съедают» маржу малого производства</h2>
        <p><strong>Определение:</strong> скрытые потери — не только поломки, но и микропростои, поздняя фиксация отклонений и ручная пересборка приоритетов, которые не попадают в учёт до конца смены.</p>
      </div>
      <p class="nero-ai-reveal" style="max-width:820px;margin:0 auto 28px;text-align:center;">Средний <strong>OEE на российских предприятиях — 65–75%</strong> при мировом ориентире <strong>85%+</strong>. <strong>Простои 25–30%</strong> планового фонда считаются «нормой». В Q1 2025 <strong>31% предпринимателей</strong> отметили сокращение объёмов производства — <strong>контроль простоев производство</strong> становится условием выживания.</p>
      <div class="asz-grid-2 nero-ai-reveal">
        <div class="asz-card">
          <h3>⚙️ Задачи меняются вручную — где теряется время смены</h3>
          <p>Типовой цех — <strong>15–80 сотрудников</strong>, учёт в <strong>1С:УНФ/ERP или Excel</strong>, задания на <strong>бумаге, доске или в WhatsApp</strong>. Срочный заказ → мастер переписывает наряд вручную. До <strong>40% инцидентов</strong> связаны с передачей смены: устные договорённости не доходят до исполнения.</p>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <h3>📉 Простои фиксируются поздно — скрытые потери</h3>
          <p><strong>Боль:</strong> «задачи меняются вручную, простои фиксируются поздно». Оператор отмечает простой «когда вспомнит». <strong>AI контроль простоев</strong> — дисциплина момента: кнопка в Telegram, QR на РЦ, опционально датчик — событие с таймстампом попадает в систему <strong>сразу</strong>.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="asz-section asz-section-alt" id="chto-takoe">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Решение</span>
        <h2>Что такое AI-агент для сменных заданий и контроля простоев</h2>
        <p><strong>Определение:</strong> интеллектуальный слой поверх 1С, ERP, Excel, бумажных нарядов, Telegram и датчиков — формирует задания, фиксирует простои в реальном времени и отдаёт отчёт руководителю. Режим <strong>«рекомендация → подтверждение человеком»</strong>.</p>
      </div>

      <div class="asz-table-wrap nero-ai-reveal">
        <table class="asz-table">
          <thead>
            <tr><th>Уровень</th><th>Что закрывает</th><th>Ограничение</th></tr>
          </thead>
          <tbody>
            <tr><td>Бумага / Excel / WhatsApp</td><td>Привычность, нулевой порог входа</td><td>Нет real-time, простои «забывают»</td></tr>
            <tr><td>MES (ПС:MES на 1С)</td><td>Электронные сменные задания, индикация отклонений</td><td>Тяжёлое внедрение, без AI-пересборки при сбоях</td></tr>
            <tr class="asz-table-highlight"><td><strong>AI-агент Nero Network</strong></td><td>План смены + фиксация простоев + handoff + отчёт</td><td>Требует аудита и дисциплины подтверждений</td></tr>
          </tbody>
        </table>
      </div>

      <div class="asz-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="asz-card">
          <h3>Отличие от MES, 1С и «просто дашборда»</h3>
          <p><strong>1С:ERP</strong> умеет сменные задания штатно — но не пересчитывает очередь за две минуты после поломки. <strong>MES</strong> — базовая инфраструктура, с которой агент интегрируется. «Просто дашборд» показывает вчерашние цифры. <strong>AI-агент</strong> реагирует на событие: поломка → 2–3 варианта новых заданий → мастер OK → план в чат смены.</p>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <h3>Agentic AI: автономность с проверкой человеком</h3>
          <p>Gartner (25.06.2025): <strong>более 40% agentic AI-проектов будут отменены к 2027</strong> из-за неясного ROI. Позиция Nero — <strong>управляемый агент</strong>: журнал решений, кнопка «утвердить план», без автоматического изменения сроков заказа. Только <strong>19% компаний</strong> сделали значимые инвестиции в agentic AI; <strong>42%</strong> на стадии POC.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ БОРИС: визуальный блок (canvas) — вставка после #chto-takoe ═══ -->
  <section id="asz-boris-shift-block" class="bsz-root" aria-label="Анимация: смена → простой → отчёт руководителю">
<style>
#asz-boris-shift-block.bsz-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#asz-boris-shift-block .bsz-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#asz-boris-shift-block .bsz-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #asz-boris-shift-block .bsz-card{grid-template-columns:1fr;min-height:auto;}
}
#asz-boris-shift-block .bsz-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #asz-boris-shift-block .bsz-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#asz-boris-shift-block .bsz-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#b45309;margin:0 0 14px;
}
#asz-boris-shift-block .bsz-ey::before{content:'';width:18px;height:2px;background:#f5c518;border-radius:1px;}
#asz-boris-shift-block .bsz-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#asz-boris-shift-block .bsz-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#asz-boris-shift-block .bsz-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#asz-boris-shift-block .bsz-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(245,197,24,.12);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#b45309;margin-top:1px;font-style:normal;font-weight:700;
}
#asz-boris-shift-block .bsz-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#asz-boris-shift-block .bsz-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#asz-boris-shift-block .bsz-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#asz-boris-shift-block .bsz-pl-o{background:rgba(245,197,24,.1);color:#b45309;border:1.5px solid rgba(245,197,24,.28);}
#asz-boris-shift-block .bsz-pl-c{background:rgba(121,242,255,.1);color:#0369a1;border:1.5px solid rgba(121,242,255,.25);}
#asz-boris-shift-block .bsz-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#asz-boris-shift-block .bsz-rgt{
  position:relative;
  background:linear-gradient(135deg,#fffbeb 0%,#fef9c3 22%,#f0f9ff 68%,#f8fafc 100%);
  min-height:420px;overflow:hidden;
}
@media(max-width:1023px){#asz-boris-shift-block .bsz-rgt{min-height:360px;}}
#asz-shift-flow-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bsz-cnt">
  <div class="bsz-card">
    <div class="bsz-lft">
      <span class="bsz-ey">Цех в реальном времени</span>
      <h3 class="bsz-h3">Смена → простой → handoff → отчёт директору за одну смену</h3>
      <ul class="bsz-ul">
        <li><span class="bsz-ic">1</span>Утро: агент собирает план из 1С и публикует приоритеты в Telegram смены</li>
        <li><span class="bsz-ic">2</span>Событие P03: поломка фрезера — таймер простоя и код причины в моменте</li>
        <li><span class="bsz-ic">3</span>Агент предлагает 2 варианта переплана — мастер нажимает «Утвердить»</li>
        <li><span class="bsz-ic">4</span>Handoff и сводка потерь уходят директору без ручной «сборки картины»</li>
      </ul>
      <div class="bsz-pills">
        <span class="bsz-pl bsz-pl-g">Реакция &lt;5 мин</span>
        <span class="bsz-pl bsz-pl-o">Коды P01–P06</span>
        <span class="bsz-pl bsz-pl-c">Human-in-the-loop</span>
      </div>
      <p class="bsz-foot">Дальше разберём пошагово, как агент работает на смене ↓</p>
    </div>
    <div class="bsz-rgt" aria-hidden="true">
      <canvas id="asz-shift-flow-canvas" role="img" aria-label="Схема: рабочие центры, фиксация простоя, отчёт руководителю"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  var canvas=document.getElementById('asz-shift-flow-canvas');
  if(!canvas)return;
  var ctx=canvas.getContext('2d');
  var W,H,frame=0;
  var C={gold:'#f5c518',cyan:'#79f2ff',violet:'#8b5cf6',green:'#22c55e',red:'#ef4444',
    slate:'#334155',muted:'#94a3b8',bg:'#f8fafc',white:'#ffffff'};

  function resize(){
    var wrap=canvas.parentElement;
    if(!wrap)return;
    canvas.width=wrap.clientWidth||400;
    canvas.height=wrap.clientHeight||380;
    W=canvas.width;H=canvas.height;
  }
  window.addEventListener('resize',resize);
  resize();

  var stations=[
    {x:0.18,label:'Раскрой',color:C.cyan},
    {x:0.42,label:'Кромка',color:C.gold},
    {x:0.66,label:'Сборка',color:C.violet}
  ];

  function drawStation(sx,sy,sw,sh,label,color,active,pulse){
    ctx.fillStyle='rgba(255,255,255,.92)';
    ctx.strokeStyle=color;
    ctx.lineWidth=active?2.5:1.5;
    roundRect(sx,sy,sw,sh,10);
    ctx.fill();ctx.stroke();
    ctx.fillStyle=C.slate;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(label,sx+sw/2,sy+sh/2+4);
    if(active){
      ctx.strokeStyle=color;
      ctx.globalAlpha=0.25+pulse*0.35;
      roundRect(sx-4,sy-4,sw+8,sh+8,12);
      ctx.stroke();
      ctx.globalAlpha=1;
    }
  }

  function roundRect(x,y,w,h,r){
    ctx.beginPath();
    ctx.moveTo(x+r,y);
    ctx.arcTo(x+w,y,x+w,y+h,r);
    ctx.arcTo(x+w,y+h,x,y+h,r);
    ctx.arcTo(x,y+h,x,y,r);
    ctx.arcTo(x,y,x+w,y,r);
    ctx.closePath();
  }

  function drawPacket(px,py,size,color,alpha){
    ctx.globalAlpha=alpha||1;
    ctx.fillStyle=color;
    roundRect(px,py,size,size*0.7,4);
    ctx.fill();
    ctx.globalAlpha=1;
  }

  function drawDowntimeBadge(x,y,t){
    var pulse=0.5+0.5*Math.sin(t*0.08);
    ctx.fillStyle='rgba(239,68,68,'+(0.15+pulse*0.15)+')';
    roundRect(x-28,y-14,56,28,8);
    ctx.fill();
    ctx.strokeStyle=C.red;
    ctx.lineWidth=1.5;
    roundRect(x-28,y-14,56,28,8);
    ctx.stroke();
    ctx.fillStyle=C.red;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('P03 · 4:20',x,y+2);
  }

  function drawReportPanel(rx,ry,rw,rh,fill,t){
    ctx.fillStyle='rgba(255,255,255,.95)';
    ctx.strokeStyle='rgba(139,92,246,.35)';
    ctx.lineWidth=1.5;
    roundRect(rx,ry,rw,rh,12);
    ctx.fill();ctx.stroke();
    ctx.fillStyle=C.violet;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Отчёт директору',rx+12,ry+18);
    var bars=3;
    for(var i=0;i<bars;i++){
      var bw=(rw-24)*(0.4+0.2*i)*Math.min(1,fill);
      ctx.fillStyle=i===0?C.red:i===1?C.gold:C.green;
      roundRect(rx+12,ry+28+i*22,bw,14,4);
      ctx.fill();
    }
    if(fill>0.8){
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText('OEE 68% · топ-3 потери',rx+12,ry+rh-10);
    }
  }

  function drawTgBubble(x,y,alpha){
    ctx.globalAlpha=alpha;
    ctx.fillStyle='#229ED9';
    roundRect(x,y,52,22,6);
    ctx.fill();
    ctx.fillStyle='#fff';
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('TG ✓',x+26,y+14);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t=frame;
    ctx.clearRect(0,0,W,H);
    var pad=24;
    var lineY=H*0.48;
    var stW=Math.min(72,W*0.14);
    var stH=44;

    ctx.strokeStyle='rgba(148,163,184,.35)';
    ctx.lineWidth=2;
    ctx.setLineDash([6,4]);
    ctx.beginPath();
    ctx.moveTo(pad,lineY);
    ctx.lineTo(W-pad-100,lineY);
    ctx.stroke();
    ctx.setLineDash([]);

    var cycle=(t%480)/480;
    var downtimePhase=cycle>0.35&&cycle<0.65;
    var reportFill=Math.max(0,Math.min(1,(cycle-0.55)/0.35));

    stations.forEach(function(st,i){
      var sx=pad+(W-pad*2-100)*st.x-stW/2;
      var active=i===1&&downtimePhase;
      drawStation(sx,lineY-stH/2,stW,stH,st.label,st.color,active,Math.sin(t*0.06));
      if(active) drawDowntimeBadge(sx+stW/2,lineY-stH/2-20,t);
    });

    if(!downtimePhase){
      var pktX=pad+(W-pad*2-100)*((cycle*1.8)%1);
      drawPacket(pktX,lineY-6,14,C.green,0.9);
    }

    if(cycle>0.5) drawTgBubble(W*0.55,H*0.22,Math.min(1,(cycle-0.5)*4));

    var rpW=88,rpH=100;
    drawReportPanel(W-pad-rpW,H*0.28,rpW,rpH,reportFill,t);

    if(cycle>0.7){
      ctx.strokeStyle=C.violet;
      ctx.globalAlpha=0.4;
      ctx.lineWidth=1.5;
      ctx.beginPath();
      ctx.moveTo(pad+(W-pad*2-100)*0.42+stW/2,lineY-stH/2);
      ctx.lineTo(W-pad-rpW,H*0.38);
      ctx.stroke();
      ctx.globalAlpha=1;
    }

    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Линия смены',pad,H-12);
    ctx.textAlign='right';
    ctx.fillText('Сводка потерь',W-pad,H-12);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>
  <!-- ═══ конец блока Бориса ═══ -->

  <section class="asz-section" id="kak-rabotaet">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Процесс на смене</span>
        <h2>Как AI-агент работает на смене: от задания до отчёта руководителю</h2>
        <p><strong>Итог блока:</strong> пять шагов — утро смены, работа на линии, событие-сбой, handoff, отчёт директору — замыкают цикл <strong>ai производство контроль</strong>.</p>
      </div>

      <div class="asz-card nero-ai-reveal">
        <div class="asz-timeline">
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>Утро смены — выдача заданий</h3><p>Агент читает заказы из 1С, загрузку РЦ, остатки → план <strong>сменных заданий</strong> с приоритетами → Telegram-чат и планшет мастера. При срочном заказе пересобирает очередь и показывает, <strong>что сдвинуть</strong>.</p></div>
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>Во время смены — фиксация простоев</h3><p>«Старт / Стоп / Простой» или датчик → классификация по <strong>кодам потерь</strong> → таймер в реальном времени.</p></div>
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>Событие-сбой — переплан</h3><p>Поломка, нехватка материала → агент предлагает 2–3 варианта → мастер выбирает → обновлённые задания в чат.</p></div>
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>Конец смены — handoff</h3><p>Что сделано, открытые простои, риски, <strong>топ-3 потери</strong> по минутам.</p></div>
          <div class="asz-tl-item"><div class="asz-tl-dot"></div><h3>Утро директора — отчёт</h3><p>OEE-оценка, сравнение со вчера, «красные зоны», рекомендации <strong>без автоматического исполнения</strong>.</p></div>
        </div>
      </div>

      <div class="asz-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="asz-table">
          <thead><tr><th>Код</th><th>Мебельный цех</th><th>Пищевое производство</th></tr></thead>
          <tbody>
            <tr><td>P01</td><td>Переналадка фрезера / форматки</td><td>CIP-мойка, смена SKU</td></tr>
            <tr><td>P02</td><td>Ожидание фурнитуры / кромки</td><td>Ожидание сырья / упаковки</td></tr>
            <tr><td>P03</td><td>Поломка оборудования</td><td>Остановка линии разлива</td></tr>
            <tr><td>P04</td><td>Брак / доработка</td><td>Отклонение по весу/герметичности</td></tr>
            <tr><td>P05</td><td>Нехватка людей на участке</td><td>Санитарная пауза</td></tr>
            <tr><td>P06</td><td>Микропростой (≤5 мин)</td><td>Микропростой на упаковке</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-nayti-prostoi-mid">
        <div class="ym-cta-block__icon" aria-hidden="true">🔍</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте, где теряются минуты на вашей смене</p>
          <p class="ym-cta-block__sub">Экспресс-разбор: почему простои не видны директору и что даст пилот на одном участке. Без обязательств по внедрению.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        </div>
      </div>
    </div>
  </section>

  <section class="asz-section asz-section-alt" id="dlya-kogo">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит: малые цеха и производственные ниши</h2>
        <p><strong>ai производство контроль для малого бизнеса</strong> — цеха без полноценного MES, но с болью «ручные задания + поздние простои». Не подходит, если нет даже Excel-учёта смен.</p>
      </div>
      <div class="asz-grid-2 nero-ai-reveal">
        <div class="asz-card">
          <h3>Мебельное производство</h3>
          <p>Корпусная мебель на заказ: частая <strong>переналадка</strong> раскроя и кромки, ручное планирование смен. Агент Nero добавляет <strong>AI-слой перепланирования</strong> при сбоях поверх 1С или Sheets.</p>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <h3>Пищевое производство и другие цеха</h3>
          <p>Линии разлива, фасовки: <strong>санитарные остановки</strong>, смена SKU, брак по весу — простои классифицируются иначе, но логика <strong>ai для производства</strong> та же: код → таймер → отчёт.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="asz-section" id="etapy">
    <div class="asz-cnt">
      <div class="asz-sh asz-left">
        <span class="asz-eyebrow">Под ключ</span>
        <h2>Внедрение AI на производстве под ключ — этапы Nero Network</h2>
        <p><strong>6–10 недель</strong> от аудита до пилота; чек <strong>500 тыс.–2 млн ₽</strong>. Сначала измеримая боль, потом масштаб.</p>
      </div>

      <div class="asz-grid-3 nero-ai-reveal">
        <div class="asz-card" id="karta-poter">
          <h3>Аудит смены и карта потерь</h3>
          <p><strong>Лид-магнит «Карта потерь производства»</strong> — 3–5 дней: обход цеха, интервью с мастером, таблица потерь. Результат — база для ROI: стоимость часа простоя × часы по кодам.</p>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <h3>Пилот на одной линии или участке</h3>
          <p><strong>MVP (4–6 недель):</strong> Telegram-бот + панель мастера + 1С/Sheets. <strong>Agentic-логика:</strong> пересборка приоритетов; «предложил → мастер OK». Метрики до/после — время реакции на простой, % актуальных приоритетов.</p>
        </div>
        <div class="asz-card nero-ai-delay-2">
          <h3>Масштабирование и обучение персонала</h3>
          <p>Тираж на второй участок / ночную смену. <strong>70% успеха ROI</strong> — человеческий фактор. Nero включает обучение Telegram-интерфейсу — проще нового MES. Также доступно <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer">обучение по внедрению AI в бизнес-процессы</a>.</p>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--dual" id="cta-karta-poter">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Карта потерь производства</p>
          <p class="ym-cta-block__sub">Структурированный аудит 3–5 дней: обход цеха, интервью с мастером, таблица кодов потерь и расчёт стоимости часа простоя — фундамент для внедрения под ключ.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить карту потерь</a>
            <a href="#kak-rabotaet" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как работает агент →</a>
          </div>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:20px;text-align:center;max-width:720px;margin-left:auto;margin-right:auto;color:var(--asz-muted,#9aa8bd);font-size:14px;"><strong>Модули:</strong> сменные задания · фиксация простоев · agentic orchestrator · handoff &amp; reporting · governance (журнал действий агента).</p>
    </div>
  </section>

  <section class="asz-section asz-section-alt" id="integracii">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Стек</span>
        <h2>Интеграции: 1С, ERP, CRM, Telegram и датчики</h2>
        <p>Сохранить ERP/MES, подключить ИИ через API — отделить модель от интеграционного слоя.</p>
      </div>

      <div class="asz-int-grid nero-ai-reveal" aria-label="Интеграции">
        <div class="asz-int-item"><span class="asz-int-icon" aria-hidden="true">1С</span><span>1С:УНФ / ERP</span></div>
        <div class="asz-int-item"><span class="asz-int-icon" aria-hidden="true">TG</span><span>Telegram</span></div>
        <div class="asz-int-item"><span class="asz-int-icon" aria-hidden="true">CRM</span><span>amoCRM / Bitrix24</span></div>
        <div class="asz-int-item"><span class="asz-int-icon" aria-hidden="true">n8n</span><span>n8n / Make</span></div>
        <div class="asz-int-item"><span class="asz-int-icon" aria-hidden="true">OPC</span><span>Modbus / OPC UA</span></div>
      </div>

      <div class="asz-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="asz-card">
          <h3>AI-агент без программиста на стороне заказчика</h3>
          <p><strong>ai производство контроль без программиста</strong> — через n8n/Make, готовые коннекторы к Telegram и выгрузки 1С. От заказчика — образец наряда, справочник кодов простоев, контакты ролей.</p>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <h3>Связка с CRM и учётными системами</h3>
          <p><strong>ai производство контроль интеграция crm</strong> — приоритет заказов из amoCRM/Bitrix24 для сменных заданий. Учёт: 1С, Excel/Sheets. AI: YandexGPT / GigaChat / on-premise <strong>152-ФЗ</strong>.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="asz-section" id="ceny">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Коммерция</span>
        <h2>Сколько стоит и когда окупается контроль простоев</h2>
      </div>

      <div class="asz-grid-2 nero-ai-reveal">
        <div class="asz-card">
          <h3>Ориентир чека и факторы цены</h3>
          <p><strong>Сколько стоит ai производство контроль:</strong> <strong>500 тыс.–2 млн ₽</strong> — число участков, глубина интеграции с 1С, датчики, on-premise vs облако. Аудит «Карты потерь» — отдельно (рынок: <strong>80–180 тыс. ₽</strong> за обследование).</p>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <h3>ROI: меньше скрытых простоев, быстрее реакция смены</h3>
          <ol class="asz-roi-list">
            <li>На аудите считаем <strong>стоимость часа простоя</strong> по участку.</li>
            <li>Baseline: задержка регистрации простоя, доля неучтённых микропростоев.</li>
            <li>После пилота — время реакции и полнота учёта.</li>
          </ol>
          <p style="margin-top:12px;font-size:14px;">Manufacturing AI failure rate ~76,4% (Revature) — главная причина OT/SCADA. Nero стартует с Telegram + 1С, датчики — фаза 2.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="asz-section asz-section-alt" id="keisy">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Доказательства</span>
        <h2>Примеры и кейсы внедрения AI на производстве</h2>
        <p>Прямых публичных кейсов «agentic AI = сменные задания + простои» для малого цеха мало — ниже смежные внедрения и критерии пилота.</p>
      </div>

      <div class="asz-case-grid nero-ai-reveal">
        <div class="asz-case-card"><div class="asz-case-tag asz-tag-enterprise">enterprise</div><h3>Северсталь — CV, простои</h3><p>Автофиксация простоев на видеопотоке; эффект <strong>21 млн ₽</strong> в 2024. Принцип «в моменте» переносится на малый цех через Telegram.</p></div>
        <div class="asz-case-card"><div class="asz-case-tag asz-tag-enterprise">enterprise</div><h3>Ростелеком — «цифровой барьер»</h3><p>CV предотвращает аварийные остановки конвейера. Экономика «стоимость ошибки vs алгоритм».</p></div>
        <div class="asz-case-card"><div class="asz-case-tag asz-tag-related">смежный</div><h3>Noltis — Telegram + 1С/MES</h3><p>ИИ-помощник мастера; заявленный рост OEE <strong>8–15%</strong>. Архитектура близка к офферу Nero.</p></div>
        <div class="asz-case-card"><div class="asz-case-tag asz-tag-related">смежный</div><h3>JIT2 — переплан за 2–5 мин</h3><p>Событие → пересчёт расписания → утверждение → MES. Сценарий «мастер OK».</p></div>
        <div class="asz-case-card"><div class="asz-case-tag asz-tag-intl">международный</div><h3>SkyPlanner Arcturus</h3><p><strong>−23% idle time</strong>, <strong>+18% schedule adherence</strong> за 6 мес. (vendor case).</p></div>
        <div class="asz-case-card"><div class="asz-case-tag asz-tag-model">модель Nero</div><h3>Малый цех: мебель/пищевая</h3><p>Telegram + 1С/Sheets → пилот 6–10 недель → тираж. <em>Проектная модель, не публичный кейс.</em></p></div>
      </div>

      <div class="asz-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Что считать успешным пилотом</h3>
        <ul>
          <li>Простои фиксируются в <strong>минуты</strong>, а не в конце смены</li>
          <li><strong>≥80%</strong> сменных заданий с актуальным приоритетом к полудню</li>
          <li>Handoff между сменами без «устных дыр»</li>
          <li>Директор получает <strong>ежедневный</strong> отчёт потерь</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="asz-section" id="riski">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Экспертиза</span>
        <h2>Риски agentic AI и как Nero Network снижает отмену проектов</h2>
      </div>

      <div class="asz-alert nero-ai-reveal" role="note">
        <p><strong>Gartner (2025):</strong> более <strong>40% agentic AI-проектов</strong> будут отменены к 2027 из-за роста затрат, неясного ROI и слабого risk control. <strong>Agent washing</strong> усиливает разочарование. Полностью автономное scheduling на safety-rated системах — <strong>pilot-stage</strong>.</p>
      </div>

      <div class="asz-table-wrap nero-ai-reveal" style="margin-top:24px;">
        <table class="asz-table">
          <thead><tr><th>Риск</th><th>Мера Nero</th></tr></thead>
          <tbody>
            <tr><td>ИИ изменит план без спроса</td><td>Режим рекомендаций; критичные действия только после OK мастера</td></tr>
            <tr><td>Нет ROI</td><td>Аудит «Карты потерь», KPI в договоре, пилот на одном участке</td></tr>
            <tr><td>Провал интеграции OT</td><td>Старт без SCADA; датчики — фаза 2</td></tr>
            <tr><td>Смена не пользуется</td><td>Telegram вместо нового ПО; мастер вовлечён на аудите</td></tr>
            <tr><td>Данные в облако</td><td>On-premise / Yandex Cloud 152-ФЗ</td></tr>
            <tr><td>«40% отменят»</td><td>Узкий scope: handoff + простои + задания — не «цифровой двойник»</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="asz-section asz-section-alt" id="faq">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">FAQ</span>
        <h2>FAQ — частые вопросы о AI для производства и контроле простоев</h2>
      </div>
      <div class="asz-faq nero-ai-reveal">
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai производство контроль?</div><div class="asz-faq-a">Аудит «Карты потерь» → MVP (Telegram + 1С/Sheets) → agentic-логика с подтверждением мастера → пилот 2 недели → тираж. Срок <strong>6–10 недель</strong>. Начинается с одного участка.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли без штатного программиста?</div><div class="asz-faq-a">Да. Через n8n/Make и готовые коннекторы; интеграцию ведёт Nero. Нужны регламент смены и образец текущего наряда.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Чем отличается от готового MES?</div><div class="asz-faq-a">MES даёт электронные наряды. <strong>AI-агент</strong> пересобирает приоритеты при сбоях, классифицирует простои, генерирует handoff. MES + агент — совместимо.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит и когда окупается?</div><div class="asz-faq-a">Ориентир <strong>500 тыс.–2 млн ₽</strong>; окупаемость — от стоимости часа простоя на вашем аудите.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Как быстро видны первые результаты?</div><div class="asz-faq-a">Метрики реакции на простой — с <strong>2-й недели пилота</strong>. OEE-динамика — после <strong>4–6 недель</strong> накопления базы.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли MES с первого дня?</div><div class="asz-faq-a">Нет. Достаточно Excel/1С + Telegram. MES — следующий уровень зрелости.</div></div>
        <div class="asz-faq-item"><div class="asz-faq-q" role="button" tabindex="0" aria-expanded="false">Безопасность данных?</div><div class="asz-faq-a">On-premise или облако РФ; журнал действий агента; разграничение ролей.</div></div>
      </div>
    </div>
  </section>

  <section class="asz-section" id="zakazat" style="background:linear-gradient(135deg,rgba(245,197,24,.08),rgba(139,92,246,.08));">
    <div class="asz-cnt">
      <div class="asz-sh">
        <span class="asz-eyebrow">Следующий шаг</span>
        <h2>Заказать внедрение AI-агента для сменных заданий и контроля простоев</h2>
        <p><strong>ai производство контроль заказать</strong> — через Nero Network с фиксированным scope пилота и прозрачными этапами.</p>
      </div>

      <div class="asz-grid-2 nero-ai-reveal" style="margin-bottom:32px;">
        <div class="asz-card">
          <h3>Что вы получаете</h3>
          <ul>
            <li>AI-агент: данные по смене, фиксация отклонений, <strong>отчёт руководителю</strong></li>
            <li>Внедрение под ключ: аудит → MVP → пилот → обучение → тираж</li>
            <li>Интеграции: <strong>1С, Telegram, CRM</strong>, опционально датчики</li>
            <li>Режим <strong>human-in-the-loop</strong> — антиотмена проекта</li>
          </ul>
        </div>
        <div class="asz-card nero-ai-delay-1">
          <h3>Ориентир инвестиций</h3>
          <p><strong>500 тыс.–2 млн ₽</strong> — согласуется с чеком темы и рынком. Окупается разницей между «простой узнали через два часа» и «простой зафиксирован в моменте».</p>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-zakazat-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Найти простои на вашей смене</p>
          <p class="ym-cta-block__sub">Оставьте заявку — проведём экспресс-разбор: где теряются минуты, почему простои не видны директору, что даст пилот на одном участке. Или начните с «Карты потерь производства».</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
            <a href="#karta-poter" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Карта потерь производства</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
<!-- /asz-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.asz-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.asz-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.asz-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.asz-faq-q');
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
  var root = document.querySelector('.ai-smennye-zadaniya-kontrol-prostoeev-page') || document.querySelector('.asz-content');
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
