<?php
/**
 * Template Name: AI-агент для контент-плана VK, Telegram и Дzen: внедрение под ключ
 * Description: SEO-лендинг — AI-агент для контент-плана VK, Telegram и Дzen. Пример плана на 14 дней, внедрение под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI контент-план для VK, Telegram и Дzen: внедрение под ключ';
$page_seo_description = 'AI-агент собирает темы из Wordstat, конкурентов и CRM и формирует контент-план на 14 дней для VK, Telegram и Дzen. Внедрение под ключ, пример плана, кейсы и цены.';

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
    ['label' => 'Проблема',     'href' => '#bolezny'],
    ['label' => 'Как работает', 'href' => '#chto-takoe'],
    ['label' => 'Площадки',     'href' => '#platformy'],
    ['label' => 'Пример плана', 'href' => '#primer-plana'],
    ['label' => 'Внедрение',    'href' => '#vnedrenie'],
    ['label' => 'Цена',         'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать контент-план';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по AI';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie';

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

.akp-hero{min-height:100vh;min-height:100dvh;position:relative;}

.akp-content{
  --akp-bg:#050711;--akp-bg2:#080b17;
  --akp-text:#e6edf7;--akp-muted:#9aa8bd;--akp-soft:#c7d2e5;--akp-heading:#fff;
  --akp-border:rgba(255,255,255,.10);
  --akp-cyan:#79f2ff;--akp-violet:#8b5cf6;--akp-green:#22c55e;
  --akp-vk:#0077ff;--akp-tg:#29b6f6;--akp-dzen:#ff6600;
  --akp-btn-from:#2563eb;--akp-btn-to:#7c3aed;
  --akp-r:18px;--akp-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--akp-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.akp-content *,.akp-content *::before,.akp-content *::after{box-sizing:border-box;}
.akp-content a{color:inherit;}
.akp-content p{color:var(--akp-muted);line-height:1.72;margin:0 0 1em;text-align:left!important;}
.akp-content p:last-child{margin-bottom:0;}
.akp-content h2,.akp-content h3,.akp-content h4{color:var(--akp-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.akp-content strong{color:var(--akp-soft);}
.akp-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.akp-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--akp-muted);font-size:14.5px;line-height:1.65;text-align:left!important;}
.akp-content ul li::before{content:'›';position:absolute;left:0;color:var(--akp-cyan);font-weight:700;}
.akp-content ol{margin:0 0 1em;padding-left:1.4em;color:var(--akp-muted);}
.akp-cnt{width:min(var(--akp-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.akp-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.akp-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.akp-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.akp-sh.akp-left{margin-left:0;text-align:left;}
.akp-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.akp-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;text-align:left!important;}
.akp-sh.akp-left p{margin-left:0;}
.akp-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--akp-cyan);margin-bottom:14px;}
.akp-gt{background:linear-gradient(92deg,#fff 0%,var(--akp-cyan) 44%,var(--akp-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.akp-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.akp-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.akp-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.akp-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--akp-cyan),var(--akp-violet));}
.akp-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.akp-intro-deco{display:grid;gap:10px;}
.akp-pipe-step{display:flex;align-items:center;gap:10px;padding:12px 14px;border:1px solid rgba(255,255,255,.1);border-radius:14px;background:rgba(255,255,255,.05);font-size:13px;color:var(--akp-soft);}
.akp-pipe-step span{width:28px;height:28px;border-radius:8px;display:grid;place-items:center;font-size:11px;font-weight:800;background:rgba(139,92,246,.2);color:#e9d5ff;flex-shrink:0;}
.akp-pipe-arrow{text-align:center;color:var(--akp-muted);font-size:18px;line-height:1;}
.akp-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.akp-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.akp-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.07);border:1px solid var(--akp-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--akp-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.akp-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--akp-cyan);background:rgba(121,242,255,.08);}
.akp-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--akp-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.akp-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.akp-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.akp-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.akp-bento{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
.akp-bento .akp-card h3{font-size:16px;margin-bottom:8px;}
.akp-bento .akp-card p{font-size:14px;margin:0;}
.akp-kpi-row{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:28px;}
.akp-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px;text-align:center;}
.akp-kpi-card .kv{font-size:clamp(22px,2.8vw,30px);font-weight:900;color:#fff;letter-spacing:-.04em;}
.akp-kpi-card .kl{font-size:12px;color:var(--akp-muted);margin-top:6px;line-height:1.4;}
.akp-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.akp-table{width:100%;border-collapse:collapse;font-size:14px;}
.akp-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--akp-cyan);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.akp-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--akp-text);vertical-align:top;}
.akp-table tr:last-child td{border-bottom:none;}
.akp-table tr:hover td{background:rgba(255,255,255,.03);}
.akp-flow{display:grid;gap:10px;margin:24px 0;}
.akp-flow-step{display:grid;grid-template-columns:36px 1fr;gap:14px;align-items:start;padding:14px 16px;border:1px solid rgba(255,255,255,.09);border-radius:14px;background:rgba(255,255,255,.04);}
.akp-flow-num{width:36px;height:36px;border-radius:10px;display:grid;place-items:center;background:rgba(139,92,246,.2);color:#e9d5ff;font-weight:800;font-size:14px;}
.akp-flow-step p{margin:0;font-size:14px;}
.akp-platform-card{border-radius:20px;padding:26px;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-top:4px solid var(--akp-vk);}
.akp-platform-card--tg{border-top-color:var(--akp-tg);}
.akp-platform-card--dz{border-top-color:var(--akp-dzen);}
.akp-platform-card h3{font-size:18px;margin-bottom:12px;}
.akp-timeline{position:relative;padding-left:40px;}
.akp-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--akp-cyan),var(--akp-violet));opacity:.35;border-radius:2px;}
.akp-tl-item{position:relative;margin-bottom:32px;}
.akp-tl-item:last-child{margin-bottom:0;}
.akp-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--akp-cyan);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.akp-tl-item h3{font-size:17px;margin-bottom:8px;}
.akp-tl-item p{font-size:14.5px;margin:0;}
.akp-price-card{text-align:center;padding:36px;border-radius:24px;background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.08));border:1px solid rgba(121,242,255,.25);margin:28px 0;}
.akp-price-card .price{font-size:clamp(28px,4vw,42px);font-weight:900;color:#fff;letter-spacing:-.04em;}
.akp-stat-row{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin:28px 0;}
.akp-stat{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:20px;text-align:center;}
.akp-stat strong{display:block;font-size:clamp(24px,3vw,34px);color:var(--akp-cyan);font-weight:900;}
.akp-stat span{font-size:12px;color:var(--akp-muted);margin-top:6px;display:block;line-height:1.4;}
.akp-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.akp-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.akp-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--akp-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.akp-faq-q::after{content:'▾';font-size:13px;color:var(--akp-cyan);flex-shrink:0;transition:transform .25s;}
.akp-faq-item.open .akp-faq-q::after{transform:rotate(180deg);}
.akp-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--akp-muted);line-height:1.72;}
.akp-faq-item.open .akp-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--akp-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;text-align:left!important;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--akp-btn-from),var(--akp-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--akp-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--akp-cyan)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:900px){.akp-intro-grid{grid-template-columns:1fr;gap:36px;}.akp-grid-2,.akp-grid-3,.akp-bento,.akp-kpi-row,.akp-stat-row{grid-template-columns:1fr;}}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}.akp-kpi-row{grid-template-columns:1fr 1fr;}}
</style>

<main id="primary" class="site-main nero-ai-home-page akp-page" role="main" tabindex="-1">

<section class="nero-ai-hero akp-hero" id="akp-hero" aria-labelledby="akp-hero-title">
<style>
/* ── Hero akp: самодостаточные стили (без CSS темы) ── */
.akp-hero {
  --akp-cyan: #79f2ff;
  --akp-violet: #8b5cf6;
  --akp-green: #22c55e;
  --akp-vk: #0077ff;
  --akp-tg: #29b6f6;
  --akp-dzen: #ff6600;
  --akp-text: #e6edf7;
  --akp-muted: #9aa8bd;
  --akp-soft: #c7d2e5;
  --akp-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(100dvh, 980px);
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.akp-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 74%);
  opacity: .6;
  pointer-events: none;
  z-index: -2;
}
.akp-hero::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .09), transparent 68%);
  filter: blur(10px);
  animation: akpHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes akpHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.akp-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.akp-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.akp-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.akp-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--akp-cyan) 38%, var(--akp-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.akp-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--akp-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.akp-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--akp-soft) !important;
  font-size: clamp(17px, 1.85vw, 21px);
  line-height: 1.58;
}
.akp-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.akp-hero .nero-ai-badge {
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
.akp-hero .nero-ai-badge--vk { border-color: rgba(0,119,255,.35); color: #b3d4ff; }
.akp-hero .nero-ai-badge--tg { border-color: rgba(41,182,246,.35); color: #b8ecff; }
.akp-hero .nero-ai-badge--dzen { border-color: rgba(255,102,0,.35); color: #ffd0a8; }
.akp-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 30px;
}
.akp-hero .nero-ai-btn {
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
.akp-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.akp-hero .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--akp-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.akp-hero .nero-ai-btn-secondary {
  color: var(--akp-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.akp-hero .akp-stage-row {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 22px;
  padding: 0;
  list-style: none;
}
.akp-hero .akp-stage {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 12px;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,.09);
  background: rgba(255,255,255,.04);
  color: var(--akp-muted);
  font-size: 12px;
  font-weight: 650;
}
.akp-hero .akp-stage span {
  display: grid;
  place-items: center;
  width: 22px;
  height: 22px;
  border-radius: 7px;
  background: rgba(139, 92, 246, 0.22);
  color: #e9d5ff;
  font-size: 11px;
  font-weight: 800;
}
.akp-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--akp-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.akp-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.akp-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.akp-hero .nero-ai-dots { display: flex; gap: 7px; }
.akp-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.akp-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.akp-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.akp-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.akp-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.akp-hero .nero-ai-window-body { padding: 16px; }
.akp-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.akp-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.akp-hero .nero-ai-live-pill {
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
.akp-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: akpPulse 1.6s infinite;
}
@keyframes akpPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.akp-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.akp-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.akp-hero .nero-ai-metric span {
  display: block;
  color: var(--akp-muted);
  font-size: 11px;
  font-weight: 700;
}
.akp-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.akp-hero .akp-dash-canvas-wrap {
  position: relative;
  height: clamp(210px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 40% 42%, rgba(139,92,246,.08), rgba(6,10,24,.94) 72%);
}
.akp-hero #akp-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.akp-hero .nero-ai-dash-feed { display: grid; gap: 8px; }
.akp-hero .nero-ai-dash-row {
  display: grid;
  grid-template-columns: 10px 1fr;
  align-items: start;
  gap: 10px;
  padding: 10px 12px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  color: #dbe7f5;
  font-size: 12px;
  line-height: 1.45;
}
.akp-hero .nero-ai-dash-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  margin-top: 5px;
}
.akp-hero .nero-ai-dash-dot--green { background: #22c55e; box-shadow: 0 0 0 4px rgba(34,197,94,.14); }
.akp-hero .nero-ai-dash-dot--blue { background: #3b82f6; box-shadow: 0 0 0 4px rgba(59,130,246,.14); }
.akp-hero .nero-ai-dash-dot--amber { background: #f59e0b; box-shadow: 0 0 0 4px rgba(245,158,11,.14); }
.akp-hero .akp-source-pill {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 10px;
  padding-top: 10px;
  border-top: 1px solid rgba(255,255,255,.06);
}
.akp-hero .akp-source-pill span {
  padding: 6px 10px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.1);
  background: rgba(255,255,255,.04);
  color: #b8c8de;
  font-size: 11px;
  font-weight: 700;
}
@media (max-width: 1100px) {
  .akp-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .akp-hero .nero-ai-dashboard { transform: none; }
  .akp-hero .nero-ai-metrics-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 600px) {
  .akp-hero .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .akp-hero .akp-stage-row { flex-direction: column; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Контент / соцсети · AI-агент</p>
      <h1 id="akp-hero-title">AI-агент для контент-плана VK, Telegram и Дzen: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI собирает темы из спроса, конкурентов и CRM-вопросов и формирует готовый план публикаций на 14 дней — без хаоса «что постить сегодня».</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры оффера">
        <li class="nero-ai-badge">14 дней</li>
        <li class="nero-ai-badge nero-ai-badge--vk">VK</li>
        <li class="nero-ai-badge nero-ai-badge--tg">Telegram</li>
        <li class="nero-ai-badge nero-ai-badge--dzen">Дzen</li>
        <li class="nero-ai-badge">Wordstat + CRM</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Собрать контент-план'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#primer-plana">Смотреть пример плана</a>
      </div>
      <ol class="akp-stage-row" aria-label="Этапы внедрения контент-агента">
        <li class="akp-stage"><span>1</span>Сбор тем из спроса</li>
        <li class="akp-stage"><span>2</span>Календарь 14 дней</li>
        <li class="akp-stage"><span>3</span>Адаптации VK · TG · Дzen</li>
        <li class="akp-stage"><span>4</span>Модерация и публикация</li>
      </ol>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-контент-календаря">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">демо логики агента · примерные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Контент-календарь AI</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Горизонт плана</span>
              <strong>14</strong>
            </div>
            <div class="nero-ai-metric">
              <span>Каналов</span>
              <strong>3</strong>
            </div>
            <div class="nero-ai-metric">
              <span>Тем из Wordstat</span>
              <strong>12+</strong>
            </div>
          </div>

          <div class="akp-dash-canvas-wrap" aria-hidden="false">
            <canvas id="akp-hero-canvas" role="img" aria-label="Анимация: темы из Wordstat, CRM и конкурентов попадают в календарь VK, Telegram и Дzen"></canvas>
          </div>

          <div class="nero-ai-dash-feed" aria-label="Лента событий контент-агента">
            <div class="nero-ai-dash-row">
              <span class="nero-ai-dash-dot nero-ai-dash-dot--green" aria-hidden="true"></span>
              Wordstat: кластер «ai посты вк» → рубрика
            </div>
            <div class="nero-ai-dash-row">
              <span class="nero-ai-dash-dot nero-ai-dash-dot--blue" aria-hidden="true"></span>
              CRM: новый интент «сколько стоит» → слот Чт
            </div>
            <div class="nero-ai-dash-row">
              <span class="nero-ai-dash-dot nero-ai-dash-dot--amber" aria-hidden="true"></span>
              VK: черновик карусели · статус draft
            </div>
            <div class="nero-ai-dash-row">
              <span class="nero-ai-dash-dot nero-ai-dash-dot--green" aria-hidden="true"></span>
              Telegram: лонгрид 2000 зн. · ожидает approve
            </div>
          </div>

          <div class="akp-source-pill" aria-label="Источники тем">
            <span>Wordstat</span>
            <span>CRM FAQ</span>
            <span>Конкуренты</span>
            <span>Human approve</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="akp-content">

  <section class="akp-intro" id="intro" aria-label="Введение">
    <div class="akp-cnt">
      <div class="akp-intro-grid nero-ai-reveal">
        <div class="akp-intro-text">
          <p class="akp-eyebrow">Лонгрид · ai контент план</p>
          <p><strong>Коротко:</strong> AI-агент для <strong>ai контент план</strong> — это настроенная система, которая собирает темы из Wordstat, конкурентов и CRM, формирует календарь на 14 дней и адаптирует каждую идею под VK, Telegram и Дzen. Человек остаётся на модерации; нейросеть снимает хаос «что постить сегодня».</p>
        </div>
        <div class="akp-intro-deco" aria-label="Схема пайплайна контент-плана">
          <div class="akp-pipe-step"><span>1</span>Wordstat + CRM + конкуренты</div>
          <div class="akp-pipe-arrow" aria-hidden="true">↓</div>
          <div class="akp-pipe-step"><span>2</span>Scoring и календарь 14 дней</div>
          <div class="akp-pipe-arrow" aria-hidden="true">↓</div>
          <div class="akp-pipe-step"><span>3</span>3 адаптации: VK · TG · Дzen</div>
        </div>
      </div>
    </div>
  </section>

  <div class="akp-toc-outer">
    <div class="akp-cnt">
      <nav class="akp-toc" aria-label="Оглавление статьи">
        <a href="#bolezny">Проблема</a>
        <a href="#chto-takoe">Как работает</a>
        <a href="#istochniki-tem">Источники тем</a>
        <a href="#platformy">Площадки</a>
        <a href="#primer-plana">Пример плана</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <aside class="akp-related akp-intro" aria-label="Смежные материалы Nero Network">
    <div class="akp-cnt">
      <div class="nero-ai-reveal" style="max-width:820px;margin:0 auto;">
        <p class="akp-eyebrow" style="margin-bottom:10px;">Смежные материалы</p>
        <p>Вопросы клиентов из CRM — главный источник тем для календаря: если нужна не только контент-рубрика, но и <a href="/vnedrenie-ai-amocrm/" class="ym-link ym-link--accent">автоматизация amoCRM с AI-агентом под ключ</a>, это отдельная посадочная про сделки, задачи и типовые вопросы в воронке.</p>
        <p>Часть интентов приходит из почты до попадания в CRM — сценарий <a href="/vnedrenie-ai-obrabotka-email-crm/" class="ym-link ym-link--accent">AI-обработки входящей почты в CRM</a> показывает, как классифицировать письма и превращать их в лиды, а не в «сырой» текст для SMM.</p>
        <p>Когда контент-план связан с заказами и остатками, полезен смежный контур учёта: <a href="/ai-1c-erp/" class="ym-link ym-link--accent">AI-агент для 1С и ERP под ключ</a> — документооборот и статусы заказов, которые тоже могут стать рубриками в календаре.</p>
      </div>
    </div>
  </aside>

  <section class="akp-section" id="bolezny">
    <div class="akp-cnt">
      <div class="akp-sh akp-left nero-ai-reveal">
        <span class="akp-eyebrow">Боль ЦА</span>
        <h2>Почему контент «сыпется», когда нет системы</h2>
        <p>Типичная картина: утром SMM-менеджер открывает три вкладки — VK, Telegram, Дzen — и задаёт один и тот же вопрос: «Что публиковать сегодня?»</p>
      </div>
      <div class="akp-grid-2 nero-ai-reveal nero-ai-delay-1">
        <div>
          <p>Идеи заканчиваются через неделю, посты выходят рывками, акции не попадают в календарь, а вопросы клиентов из CRM так и не превращаются в рубрики. Это не «лень команды» — это отсутствие <strong>системы контент-планирования</strong>, где темы берутся из спроса, а не из головы.</p>
          <p><strong>Определение боли ЦА:</strong> когда контент выходит хаотично и идеи заканчиваются, бизнес теряет регулярность, доверие аудитории и связь контента с продажами. По данным исследования eLama совместно с Roistat, SMMplanner, SpyWords и WOWBlogger (более 600 респондентов), <strong>78% российских компаний уже используют ИИ для генерации контента</strong>, но без процесса нейросеть лишь ускоряет хаос — не устраняет его.</p>
        </div>
        <div class="akp-kpi-row" style="grid-template-columns:1fr;gap:10px;margin:0;">
          <div class="akp-kpi-card"><div class="kv">78%</div><div class="kl">компаний используют ИИ для контента</div></div>
          <div class="akp-kpi-card"><div class="kv">3</div><div class="kl">канала: VK · Telegram · Дzen</div></div>
          <div class="akp-kpi-card"><div class="kv">14</div><div class="kl">дней — горизонт плана</div></div>
        </div>
      </div>

      <h3 class="nero-ai-reveal" style="margin-top:40px;font-size:22px;">Три канала — три формата: VK, Telegram, Дzen</h3>
      <p class="nero-ai-reveal">В 2026 году фокус российского SMM смещён на <strong>VK, Telegram и Дzen</strong> (Pustovalov, Growmatrix). Это три разные аудитории и три разных алгоритма:</p>
      <div class="akp-table-wrap nero-ai-reveal">
        <table class="akp-table">
          <thead><tr><th>Параметр</th><th>VK</th><th>Telegram</th><th>Дzen</th></tr></thead>
          <tbody>
            <tr><td>Оптимальная длина</td><td>300–800 знаков + медиа</td><td>200–800 знаков; лонг 1500–3000</td><td>3000–7000+ знаков</td></tr>
            <tr><td>Главный формат</td><td>Карусель, клип, пост с опросом</td><td>Короткий экспертный пост + ссылка</td><td>SEO-статья с подзаголовками</td></tr>
            <tr><td>Частота (ориентир)</td><td>3–5 постов/нед</td><td>3–5 постов/нед</td><td>2–4 статьи/мес</td></tr>
            <tr><td>Автопостинг</td><td>VK API / SMMplanner / Make</td><td>Bot API / SMMplanner</td><td>RSS с сайта или ручная публикация</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal"><strong>Итог:</strong> единый календарь возможен на уровне <strong>идеи и рубрики</strong>, но не на уровне одного текста «копипастом». Именно поэтому нужен <strong>ai агент для контента</strong>, который из одной мастер-темы делает три адаптации.</p>

      <h3 class="nero-ai-reveal" style="margin-top:32px;font-size:22px;">Что теряет бизнес без контент-плана на 14 дней</h3>
      <p class="nero-ai-reveal">Без горизонта хотя бы на две недели команда живёт в режиме пожаров: пропускает рубрики «экспертиза / кейс / вовлечение / продажа», не успевает готовить Дzen-статьи, теряет UTM-метки и не видит, какие темы из CRM уже закрыты контентом.</p>
      <p class="nero-ai-reveal"><strong>AI контент план для бизнеса</strong> закрывает этот разрыв: календарь на 14 дней формируется из проверенных источников, а не из случайных промптов.</p>
    </div>
  </section>

  <section class="akp-section akp-section-alt" id="chto-takoe">
    <div class="akp-cnt">
      <div class="akp-sh nero-ai-reveal">
        <span class="akp-eyebrow">AI-агент</span>
        <h2>Что такое AI-агент для <span class="akp-gt">контент-плана</span></h2>
        <p><strong>Определение:</strong> AI-агент для контент-плана — не чат с ChatGPT, а связка модулей: сбор тем → scoring → календарь → адаптации → модерация → публикация.</p>
      </div>
      <div class="akp-bento nero-ai-reveal">
        <div class="akp-card"><h3>ChatGPT / промпт</h3><p>Список тем «из головы модели». Нет Wordstat, CRM, календаря.</p></div>
        <div class="akp-card"><h3>SaaS (SMMplanner и др.)</h3><p>AI-календарь, drag&amp;drop. Слабая CRM-интеграция; Дzen часто вручную.</p></div>
        <div class="akp-card"><h3>AI-агент под ключ</h3><p>Wordstat + CRM + конкуренты → 14 дней → 3 адаптации. Human-in-the-loop.</p></div>
      </div>
      <div class="akp-sh akp-left nero-ai-reveal" style="margin-top:48px;margin-bottom:24px;">
        <h3 style="font-size:22px;">Результат на выходе: календарь, темы, форматы, CTA постов</h3>
      </div>
      <ol class="nero-ai-reveal" style="max-width:720px;margin:0 auto;">
        <li><strong>Календарь на 14 (или 30) дней</strong> в Google Sheets / Notion — единый источник правды.</li>
        <li><strong>Мастер-тезис</strong> по каждой теме + три адаптации (VK / TG / Дzen).</li>
        <li><strong>Колонки формата:</strong> тип контента, обложка, UTM, CTA, статус (<code>draft → approved → published</code>).</li>
        <li><strong>Опционально:</strong> ТЗ на визуал для дизайнера.</li>
      </ol>
    </div>
  </section>

  <section class="akp-section" id="istochniki-tem">
    <div class="akp-cnt">
      <div class="akp-sh akp-left nero-ai-reveal">
        <span class="akp-eyebrow">Источники</span>
        <h2>Откуда AI берёт темы: спрос, конкуренты, CRM</h2>
        <p>Уникальный угол: <strong>контент-план из спроса, а не из галлюцинаций нейросети</strong>. Три входа питают один scoring-модуль.</p>
      </div>
      <div class="akp-grid-3 nero-ai-reveal nero-ai-delay-1">
        <div class="akp-card"><h3>Wordstat</h3><p>Семена кластеризуются в рубрики. LSI-фразы идут в Дzen-статьи для органического охвата.</p></div>
        <div class="akp-card"><h3>Конкуренты</h3><p>Мониторинг 3–5 аккаунтов: какие темы конкурент не закрывает. Идеи, не тексты.</p></div>
        <div class="akp-card"><h3>CRM FAQ</h3><p>amoCRM «Типовые вопросы» → интент = рубрика → пост или статья с CTA на услугу.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:28px;"><strong>Схема «от CRM-вопроса до поста» (7 шагов):</strong></p>
      <div class="akp-flow nero-ai-reveal">
        <div class="akp-flow-step"><span class="akp-flow-num">1</span><p>Вопрос клиента попадает в CRM / мессенджер.</p></div>
        <div class="akp-flow-step"><span class="akp-flow-num">2</span><p>Классификация по интенту (amoCRM dataset или Salesbot).</p></div>
        <div class="akp-flow-step"><span class="akp-flow-num">3</span><p>AI добавляет тему в очередь scoring.</p></div>
        <div class="akp-flow-step"><span class="akp-flow-num">4</span><p>Тема попадает в слот календаря (канал + дата + формат).</p></div>
        <div class="akp-flow-step"><span class="akp-flow-num">5</span><p>Агент генерирует черновики под VK / TG / Дzen.</p></div>
        <div class="akp-flow-step"><span class="akp-flow-num">6</span><p>Модерация в Telegram-боте или email approve.</p></div>
        <div class="akp-flow-step"><span class="akp-flow-num">7</span><p>Публикация через VK API / TG Bot; Дzen — RSS или ручной шаг.</p></div>
      </div>
    </div>
  </section>

<section id="ai-kontent-plan-vk-telegram-dzen-boris-block" class="akp-b-root" aria-label="Анимация: scoring тем и заполнение контент-календаря на 14 дней для VK, Telegram и Дzen">
<style>
/* === БОРИС: prefix akp-b-, scoped внутри #ai-kontent-plan-vk-telegram-dzen-boris-block === */
#ai-kontent-plan-vk-telegram-dzen-boris-block.akp-b-root{
  padding:clamp(48px,6vw,72px) 0;
  background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%);
  border-top:1px solid rgba(148,163,184,.25);
  border-bottom:1px solid rgba(148,163,184,.25);
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 clamp(16px,3vw,24px);
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 12px 48px rgba(15,23,42,.1),0 0 0 1px rgba(148,163,184,.2);
  min-height:min(520px,70vh);
}
@media(max-width:1023px){
  #ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-lft{
  padding:clamp(28px,4vw,44px) clamp(22px,3vw,40px);
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
  }
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-ey{
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
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(139,92,246,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#6d28d9;
  margin-top:1px;
  font-style:normal;
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-pl-vk{
  background:rgba(0,119,255,.08);
  color:#005bbb;
  border:1.5px solid rgba(0,119,255,.22);
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-pl-tg{
  background:rgba(41,182,246,.08);
  color:#0284c7;
  border:1.5px solid rgba(41,182,246,.22);
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-pl-dz{
  background:rgba(255,102,0,.08);
  color:#c2410c;
  border:1.5px solid rgba(255,102,0,.22);
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-rgt{
  position:relative;
  background:linear-gradient(145deg,#f0f9ff 0%,#ede9fe 38%,#fff7ed 72%,#f8fafc 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-kontent-plan-vk-telegram-dzen-boris-block .akp-b-rgt{min-height:380px;}
}
#akp-b-scoring-calendar-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="akp-b-cnt">
  <div class="akp-b-card">

    <div class="akp-b-lft">
      <span class="akp-b-ey">Scoring и календарь</span>
      <h3 class="akp-b-h3">Темы из спроса ранжируются и ложатся в сетку 14 дней — с тремя адаптациями</h3>
      <ul class="akp-b-ul">
        <li><span class="akp-b-ic">1</span>Wordstat-кластер, CRM-интент и пробел конкурента попадают в очередь scoring</li>
        <li><span class="akp-b-ic">2</span>AI ранжирует тему по частоте спроса, уникальности и срочности из CRM</li>
        <li><span class="akp-b-ic">3</span>Слот календаря: день · канал · рубрика · формат · статус <code>draft</code></li>
        <li><span class="akp-b-ic">↗</span>Одна мастер-тема ветвится на VK-пост, TG-лонгрид и Дzen-статью — не кросспост</li>
      </ul>
      <div class="akp-b-pills">
        <span class="akp-b-pl akp-b-pl-g">14 дней · 12+ тем</span>
        <span class="akp-b-pl akp-b-pl-vk">VK</span>
        <span class="akp-b-pl akp-b-pl-tg">Telegram</span>
        <span class="akp-b-pl akp-b-pl-dz">Дzen</span>
      </div>
      <p class="akp-b-foot">Дальше — форматы и ритм публикаций по каждой площадке →</p>
    </div>

    <div class="akp-b-rgt">
      <canvas
        id="akp-b-scoring-calendar-canvas"
        aria-label="Анимация: темы из Wordstat, CRM и мониторинга конкурентов проходят AI-scoring и распределяются по 14-дневному календарю с адаптациями для VK, Telegram и Дzen"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('akp-b-scoring-calendar-canvas');
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
    line:'rgba(100,116,139,.2)',
    ai:'#8b5cf6',
    aiGlow:'rgba(139,92,246,.22)',
    ws:'#22c55e',
    crm:'#0ea5e9',
    comp:'#f59e0b',
    vk:'#0077FF',
    tg:'#29B6F6',
    dz:'#FF6600',
    cell:'#ffffff',
    cellBdr:'#cbd5e1',
    cellFill:'rgba(255,255,255,.85)',
    slotEmpty:'#f1f5f9',
    approved:'#22c55e'
  };

  var SOURCES = [
    {key:'ws',  label:'Wordstat', color:C.ws,  x:0},
    {key:'crm', label:'CRM FAQ',  color:C.crm, x:0},
    {key:'cmp', label:'Конкуренты', color:C.comp, x:0}
  ];

  var CHANNELS = [
    {key:'vk', label:'VK', color:C.vk},
    {key:'tg', label:'TG', color:C.tg},
    {key:'dz', label:'Дzen', color:C.dz}
  ];

  var TOPICS = [
    {src:0, title:'ai посты вк', ch:0, day:2},
    {src:1, title:'сколько стоит', ch:1, day:4},
    {src:2, title:'пробел ниши', ch:2, day:6},
    {src:0, title:'контент-план', ch:1, day:8},
    {src:1, title:'интент CRM', ch:0, day:10},
    {src:2, title:'кейс SMM', ch:2, day:12}
  ];

  var particles = [];
  var slots = [];
  var adaptCards = [];
  var LOOP = 760;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function initLayout(){
    var topY = H * 0.1;
    var srcW = Math.min(88, W * 0.22);
    var gap = (W - srcW * 3) / 4;
    SOURCES.forEach(function(s,i){
      s.x = gap + i * (srcW + gap) + srcW/2;
      s.y = topY;
      s.w = srcW;
    });
  }

  function initSlots(){
    slots = [];
    var cols = 7, rows = 2;
    var gridTop = H * 0.52;
    var gridH = H * 0.28;
    var pad = 12;
    var cellW = (W - pad*2 - 6*(cols-1)) / cols;
    var cellH = (gridH - 6) / rows;
    for(var r=0;r<rows;r++){
      for(var c=0;c<cols;c++){
        slots.push({
          x: pad + c*(cellW+6),
          y: gridTop + r*(cellH+6),
          w: cellW, h: cellH,
          day: r*7+c+1,
          filled:false,
          ch:-1,
          alpha:0
        });
      }
    }
  }

  function spawnParticle(cfg, delay){
    var s = SOURCES[cfg.src];
    particles.push({
      sx:s.x, sy:s.y+28,
      x:s.x, y:s.y+28,
      tx:W*0.5, ty:H*0.34,
      title:cfg.title,
      src:cfg.src,
      ch:cfg.ch,
      day:cfg.day,
      t:0,
      delay:delay||0,
      phase:0,
      speed:0.018+Math.random()*0.008
    });
  }

  function resetCycle(){
    particles = [];
    adaptCards = [];
    initSlots();
    TOPICS.forEach(function(t,i){ spawnParticle(t, i*95); });
  }

  resetCycle();

  function drawSourceNode(s){
    rr(s.x - s.w/2, s.y - 14, s.w, 28, 14, C.cellFill, s.color, 2);
    ctx.fillStyle = s.color;
    ctx.font = 'bold ' + Math.max(9, s.w*0.11) + 'px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(s.label, s.x, s.y);
  }

  function drawScoringHub(pulse){
    var cx = W*0.5, cy = H*0.34, r = Math.min(36, W*0.06);
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2.2);
    g.addColorStop(0, C.aiGlow);
    g.addColorStop(1, 'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx,cy,r*2,0,Math.PI*2);
    ctx.fill();

    rr(cx-r, cy-r, r*2, r*2, r*0.4, '#f5f3ff', C.ai, 2);
    ctx.fillStyle = C.ai;
    ctx.font = 'bold ' + Math.max(12,r*0.35) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('AI', cx, cy-3);
    ctx.font = Math.max(8,r*0.2) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('scoring', cx, cy+r*0.42);

    ctx.strokeStyle = C.ai;
    ctx.lineWidth = 1.5 + pulse*2;
    ctx.globalAlpha = 0.25 + pulse*0.35;
    ctx.beginPath();
    ctx.arc(cx,cy,r+6+pulse*4,0,Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawCalendarGrid(){
    ctx.fillStyle = C.ink;
    ctx.font = 'bold ' + Math.max(10,W*0.018) + 'px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Календарь · 14 дней', 12, H*0.48);

    slots.forEach(function(sl){
      var fill = sl.filled ? 'rgba(255,255,255,.95)' : C.slotEmpty;
      var stroke = sl.filled ? (CHANNELS[sl.ch] ? CHANNELS[sl.ch].color : C.cellBdr) : C.cellBdr;
      ctx.globalAlpha = sl.filled ? 0.55 + sl.alpha*0.45 : 0.7;
      rr(sl.x, sl.y, sl.w, sl.h, 5, fill, stroke, sl.filled?2:1);
      ctx.globalAlpha = 1;
      ctx.fillStyle = C.muted;
      ctx.font = Math.max(7, sl.w*0.22) + 'px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText('Д'+sl.day, sl.x+sl.w/2, sl.y+sl.h*0.38);
      if(sl.filled && CHANNELS[sl.ch]){
        ctx.fillStyle = CHANNELS[sl.ch].color;
        ctx.font = 'bold ' + Math.max(7, sl.w*0.2) + 'px system-ui,sans-serif';
        ctx.fillText(CHANNELS[sl.ch].label, sl.x+sl.w/2, sl.y+sl.h*0.72);
      }
    });
  }

  function drawAdaptLane(){
    var laneY = H*0.86;
    var laneW = (W - 40) / 3;
    CHANNELS.forEach(function(ch,i){
      var x = 20 + i*laneW;
      rr(x, laneY-10, laneW-8, 22, 8, 'rgba(255,255,255,.7)', ch.color, 1.5);
      ctx.fillStyle = ch.color;
      ctx.font = 'bold 9px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(ch.label + ' · адаптация', x+(laneW-8)/2, laneY+2);
    });
  }

  function drawParticle(p){
    if(p.phase < 1){
      var t = Math.min(1, p.t);
      var ease = t<0.5 ? 2*t*t : 1-Math.pow(-2*t+2,2)/2;
      p.x = p.sx + (p.tx - p.sx)*ease;
      p.y = p.sy + (p.ty - p.sy)*ease;
      var col = SOURCES[p.src].color;
      rr(p.x-34, p.y-9, 68, 18, 9, C.cellFill, col, 1.5);
      ctx.fillStyle = col;
      ctx.font = '8px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      var lbl = p.title.length>11 ? p.title.slice(0,10)+'…' : p.title;
      ctx.fillText(lbl, p.x, p.y);
      if(t>=1) p.phase = 1;
      return;
    }
    if(p.phase === 1){
      p.t = 0;
      p.phase = 2;
      p.tx = slots[p.day-1] ? slots[p.day-1].x + slots[p.day-1].w/2 : W*0.5;
      p.ty = slots[p.day-1] ? slots[p.day-1].y + slots[p.day-1].h/2 : H*0.6;
    }
    if(p.phase === 2){
      var t2 = Math.min(1, p.t);
      var e2 = t2*t2*(3-2*t2);
      var ox = W*0.5 + (p.tx - W*0.5)*e2;
      var oy = H*0.34 + (p.ty - H*0.34)*e2;
      var col2 = SOURCES[p.src].color;
      rr(ox-30, oy-8, 60, 16, 8, C.cellFill, col2, 1.2);
      ctx.fillStyle = col2;
      ctx.font = '7px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(p.title.slice(0,9), ox, oy);
      if(t2>=1){
        p.phase = 3;
        p.t = 0;
        var sl = slots[p.day-1];
        if(sl){
          sl.filled = true;
          sl.ch = p.ch;
          sl.alpha = 0;
        }
        adaptCards.push({
          ch:p.ch,
          title:p.title,
          x:20 + p.ch*((W-40)/3) + ((W-40)/3 - 8)/2,
          y:H*0.86-10,
          alpha:0
        });
      }
      return;
    }
    if(p.phase === 3){
      var sl2 = slots[p.day-1];
      if(sl2) sl2.alpha = Math.min(1, sl2.alpha + 0.04);
    }
  }

  function drawAdaptCards(){
    adaptCards.forEach(function(ac){
      ac.alpha = Math.min(1, ac.alpha + 0.03);
      ctx.globalAlpha = ac.alpha;
      var ch = CHANNELS[ac.ch];
      rr(ac.x-28, ac.y-28, 56, 14, 6, ch.color, null, 0);
      ctx.fillStyle = '#fff';
      ctx.font = 'bold 7px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('draft', ac.x, ac.y-19);
      ctx.globalAlpha = 1;
    });
  }

  function drawConnectors(){
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1;
    SOURCES.forEach(function(s){
      ctx.beginPath();
      ctx.moveTo(s.x, s.y+14);
      ctx.quadraticCurveTo(s.x, H*0.24, W*0.5, H*0.28);
      ctx.stroke();
    });
    ctx.beginPath();
    ctx.moveTo(W*0.5, H*0.38);
    ctx.lineTo(W*0.5, H*0.48);
    ctx.stroke();
  }

  function tick(){
    frame++;
    var pulse = 0.5 + 0.5*Math.sin(frame*0.06);
    ctx.clearRect(0,0,W,H);

    if(frame % LOOP === 0) resetCycle();

    initLayout();
    drawConnectors();
    SOURCES.forEach(drawSourceNode);
    drawScoringHub(pulse);
    drawCalendarGrid();
    drawAdaptLane();

    particles.forEach(function(p){
      if(frame > p.delay){
        p.t += p.speed;
        drawParticle(p);
      }
    });

    drawAdaptCards();

    requestAnimationFrame(tick);
  }

  requestAnimationFrame(tick);
})();
</script>
</section>



  <section class="akp-section akp-section-alt" id="platformy">
    <div class="akp-cnt">
      <div class="akp-sh nero-ai-reveal">
        <span class="akp-eyebrow">Площадки</span>
        <h2>Контент-план для VK, Telegram и Дzen</h2>
        <p>Три канала — три тактики. Один календарь идей, разные форматы публикаций.</p>
      </div>

      <div class="akp-platform-card nero-ai-reveal" style="margin-bottom:24px;">
        <h3>Контент-план для VK: посты, клипы, статьи</h3>
        <p>Ключ <strong>ai посты вк</strong> закрывается ритмом и форматами под алгоритм Smart Rank. Ориентир 2026: <strong>3–5 постов в неделю</strong> + <strong>3–7 клипов</strong>. Из мастер-тезиса агент собирает пост (300–800 знаков), клип (15–60 сек) и статью VK.</p>
      </div>

      <div class="akp-platform-card akp-platform-card--tg nero-ai-reveal nero-ai-delay-1" style="margin-bottom:24px;">
        <h3>Контент-план для Telegram</h3>
        <p>Telegram — канал прямого контакта: <strong>ER 8–15%</strong> на качественном контенте. В канале — экспертный тон, 200–800 знаков; раз в неделю — лонгрид 1500–3000 знаков со ссылкой на Дzen-статью. <strong>Контент план вк телеграм</strong> в одном агенте — не кросспост, а общая тема + разные тактики.</p>
      </div>

      <div class="akp-platform-card akp-platform-card--dz nero-ai-reveal nero-ai-delay-2">
        <h3>Контент-план для Дzen</h3>
        <p>Дzen — SEO-площадка: <strong>2–4 статьи в месяц</strong>, 3000–7000+ знаков. У Дzen <strong>нет открытого API автопостинга</strong> — только RSS 2.0 с собственного домена. Честная схема: агент готовит статью → RSS с WordPress или колонка «готово к ручной публикации» в Дzen Studio.</p>
      </div>
    </div>
  </section>

  <section class="akp-section" id="primer-plana">
    <div class="akp-cnt">
      <div class="akp-sh nero-ai-reveal">
        <span class="akp-eyebrow">Лид-магнит</span>
        <h2>Пример контент-плана на 14 дней</h2>
        <p>Ниже — структура таблицы (фрагмент); полный план вы получаете по CTA «Собрать контент-план».</p>
      </div>
      <div class="akp-table-wrap nero-ai-reveal">
        <table class="akp-table">
          <thead><tr><th>День</th><th>Канал</th><th>Рубрика</th><th>Тема (мастер)</th><th>Формат</th><th>CTA</th><th>Статус</th></tr></thead>
          <tbody>
            <tr><td>Пн</td><td>Telegram</td><td>Экспертиза</td><td>«Почему идеи для постов заканчиваются»</td><td>Короткий пост 400 зн.</td><td>Опрос в канале</td><td>draft</td></tr>
            <tr><td>Пн</td><td>VK</td><td>Экспертиза</td><td>та же тема</td><td>Карусель 5 слайдов</td><td>Комментарий + ссылка</td><td>draft</td></tr>
            <tr><td>Ср</td><td>Telegram</td><td>Кейс</td><td>«Как CRM-вопрос стал рубрикой»</td><td>Лонг 2000 зн.</td><td>Ссылка на Дzen</td><td>draft</td></tr>
            <tr><td>Чт</td><td>VK</td><td>Вовлечение</td><td>«3 ошибки контент-плана»</td><td>Клип 30 сек</td><td>Подписка</td><td>draft</td></tr>
            <tr><td>Пт</td><td>Дzen</td><td>SEO</td><td>«AI контент план для малого бизнеса»</td><td>Статья 5000 зн.</td><td>Лид-магнит PDF</td><td>RSS</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">За 14 дней типовой график: <strong>TG 5–7 слотов</strong>, <strong>VK 3–5</strong>, <strong>Дzen 1–2</strong> — без перегруза команды.</p>

      <div class="ym-cta-block ym-cta-block--primary akp-cta-lead" id="cta-plan-14">
        <div class="ym-cta-block__icon" aria-hidden="true">📅</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получите контент-план на 14 дней под вашу нишу</p>
          <p class="ym-cta-block__sub">За 2–3 дня соберём календарь из Wordstat-кластеров, вопросов клиентов и пробелов конкурентов — VK, Telegram и Дzen в одной таблице. PDF + Google Sheets, tone of voice вашего бренда.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="akp-section akp-section-alt" id="vnedrenie">
    <div class="akp-cnt">
      <div class="akp-sh nero-ai-reveal">
        <span class="akp-eyebrow">Внедрение</span>
        <h2>Внедрение AI контент-плана под ключ</h2>
        <p>Срок <strong>2–4 недели</strong>; пакет от аудита каналов до работающего агента с модерацией.</p>
      </div>
      <div class="akp-timeline nero-ai-reveal">
        <div class="akp-tl-item"><span class="akp-tl-dot"></span><h3>Неделя 0 (лид-магнит)</h3><p>Бриф → Wordstat + CRM-вопросы → план 14 дней → CTA на полное внедрение.</p></div>
        <div class="akp-tl-item"><span class="akp-tl-dot"></span><h3>Недели 1–2</h3><p>Аудит VK/TG/Дzen, рубрикатор, RAG brand voice.</p></div>
        <div class="akp-tl-item"><span class="akp-tl-dot"></span><h3>Недели 2–3</h3><p>Make/n8n — сбор тем → адаптации → очередь модерации → автопостинг VK/TG; RSS для Дzen.</p></div>
        <div class="akp-tl-item"><span class="akp-tl-dot"></span><h3>Неделя 4</h3><p>Обучение команды, метрики в Sheets, 1 месяц поддержки.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:32px;"><strong>Модули системы:</strong> сбор тем · календарь · AI-агент адаптаций · модерация · публикация VK+TG · аналитика UTM/ER.</p>

      <aside class="ym-cta-block ym-cta-block--secondary akp-cta-learn" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до запуска агента?</p>
          <p class="ym-cta-block__sub">Перед внедрением контент-агента полезно разобраться в Make/n8n, промптах, human-in-the-loop и связке CRM → календарь. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo (strpos($secondary_cta_url, 'http') === 0) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="akp-section" id="ceny">
    <div class="akp-cnt">
      <div class="akp-sh nero-ai-reveal">
        <span class="akp-eyebrow">ROI</span>
        <h2>Стоимость и ROI</h2>
      </div>
      <div class="akp-price-card nero-ai-reveal">
        <div class="price">60–200 тыс. ₽</div>
        <p style="margin-top:12px;color:var(--akp-muted);">Ориентир под ключ · зависит от каналов, CRM и RSS для Дzen</p>
      </div>
      <div class="akp-table-wrap nero-ai-reveal">
        <table class="akp-table">
          <thead><tr><th>Метрика</th><th>До (ручной процесс)</th><th>После (AI-агент)</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>Время на контент-план</td><td>4–8 ч/нед</td><td>1–2 ч/нед (+ approve)</td><td>Postmypost; Pustovalov</td></tr>
            <tr><td>Поиск тем</td><td>ad hoc</td><td>Еженедельный автосбор</td><td>n8n calendar pattern</td></tr>
            <tr><td>Публикаций/мес</td><td>Нерегулярно</td><td>Стабильный график</td><td>SberMarketing ×2</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">Кейс <strong>СберМаркетинг</strong>: поиск фактуры <strong>−90%+</strong>, тексты <strong>−95%</strong>, публикаций <strong>×2</strong>. <strong>Сколько стоит ai контент план</strong> vs штатный SMM <strong>150–300 тыс. ₽/мес</strong> — разовое внедрение окупается через регулярность.</p>
    </div>
  </section>

  <section class="akp-section akp-section-alt" id="keisy">
    <div class="akp-cnt">
      <div class="akp-sh nero-ai-reveal">
        <span class="akp-eyebrow">Кейсы</span>
        <h2>Кейсы и сценарии внедрения</h2>
      </div>
      <div class="akp-bento nero-ai-reveal">
        <div class="akp-card"><h3>Локальный бизнес</h3><p>Wordstat + 3 конкурента → TG+VK, Дzen 1 статья/мес, CRM на этапе 2.</p></div>
        <div class="akp-card"><h3>Эксперт / личный бренд</h3><p>CRM-вопросы и TG-лонгриды → Дzen SEO → лид-магнит на сайте.</p></div>
        <div class="akp-card"><h3>Агентство</h3><p>Один агент-шаблон на клиента, white-label Sheets, модерация в боте.</p></div>
      </div>
      <div class="akp-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="akp-table">
          <thead><tr><th>Риск</th><th>Mitigation</th></tr></thead>
          <tbody>
            <tr><td>Галлюцинации тем</td><td>Только verified inputs (Wordstat/CRM)</td></tr>
            <tr><td>Шаблонный tone</td><td>RAG на прошлых постах; обязательная редактура</td></tr>
            <tr><td>Модерация Дzen</td><td>Корректный RSS; без дубликатов с сайтом</td></tr>
            <tr><td>Авторские права</td><td>Идеи конкурентов, не тексты</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="akp-section" id="trend-2026">
    <div class="akp-cnt">
      <div class="akp-sh nero-ai-reveal">
        <span class="akp-eyebrow">Тренд 2026</span>
        <h2>AI и продажи в 2026: контекст тренда</h2>
        <p><strong>Salesforce State of Sales 2026</strong> (4 050 sales professionals, 14 стран)</p>
      </div>
      <div class="akp-stat-row nero-ai-reveal">
        <div class="akp-stat"><strong>87%</strong><span>организаций используют AI</span></div>
        <div class="akp-stat"><strong>91%</strong><span>польза AI для sales planning</span></div>
        <div class="akp-stat"><strong>94%</strong><span>лидеры: агенты критичны для роста</span></div>
        <div class="akp-stat"><strong>−36%</strong><span>время на drafting content</span></div>
      </div>
      <p class="nero-ai-reveal"><strong>45%</strong> российских компаний используют ИИ в маркетинге; <strong>78%</strong> — для генерации контента (eLama / Sostav, 2025). Контент отвечает на возражения из CRM <strong>до</strong> звонка менеджера.</p>
    </div>
  </section>

  <section class="akp-section akp-section-alt" id="faq">
    <div class="akp-cnt">
      <div class="akp-sh nero-ai-reveal">
        <span class="akp-eyebrow">FAQ</span>
        <h2>Частые вопросы</h2>
      </div>
      <div class="akp-faq nero-ai-reveal">
        <div class="akp-faq-item"><div class="akp-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai контент план без программиста?</div><div class="akp-faq-a">Настройку делает интегратор Nero (Make/n8n, API, RSS). Ежедневно редактор работает в Google Sheets и Telegram-боте approve — без кода.</div></div>
        <div class="akp-faq-item"><div class="akp-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai контент план?</div><div class="akp-faq-a">Ориентир <strong>60–200 тыс. ₽</strong> под ключ; точная смета после брифа (каналы, CRM, Дzen RSS).</div></div>
        <div class="akp-faq-item"><div class="akp-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли только VK или только Telegram?</div><div class="akp-faq-a">Да. Пакет масштабируется; <strong>ai посты вк</strong> или TG-only — минус адаптации под другие площадки.</div></div>
        <div class="akp-faq-item"><div class="akp-faq-q" role="button" tabindex="0" aria-expanded="false">Как связать план с CRM?</div><div class="akp-faq-a">amoCRM «Типовые вопросы» → интенты в scoring → строки календаря; webhooks для срочных тем.</div></div>
        <div class="akp-faq-item"><div class="akp-faq-q" role="button" tabindex="0" aria-expanded="false">Что если идеи снова закончатся?</div><div class="akp-faq-a">Агент <strong>перезаполняет пустые слоты</strong>, а не переписывает весь месяц. Wordstat + новые CRM-вопросы — бесконечный вход.</div></div>
        <div class="akp-faq-item"><div class="akp-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли программист на поддержке?</div><div class="akp-faq-a">Нет для контент-команды. Технические правки сценариев — по SLA Nero или вашему integrator.</div></div>
      </div>
    </div>
  </section>

  <section class="akp-section" id="cta-final-wrap">
    <div class="akp-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final akp-cta-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Соберите контент-план под ваш бизнес</p>
          <p class="ym-cta-block__sub">Контент-план на 14 дней из Wordstat, конкурентов и вопросов клиентов — три канала, три формата, одна система. Бриф, образец календаря и смета внедрения под ключ.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#primer-plana" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Пример плана →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- .akp-content -->

  <!-- SCHEMA-MARKUP:INSERT -->

</main>



<script>
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("akp-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    if (!canvas.parentElement) return;
    canvas.width = canvas.parentElement.clientWidth || 400;
    canvas.height = canvas.parentElement.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = cw < 420 ? cw / 520 : Math.min(cw / 640, ch / 320) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#cbd5e1",
    vk: "#0077ff",
    tg: "#29b6f6",
    dzen: "#ff6600",
    wordstat: "#22c55e",
    crm: "#8b5cf6",
    comp: "#f59e0b",
    matrixBg: "rgba(15,23,42,0.92)",
    cellIdle: "rgba(255,255,255,0.06)",
    cellHot: "rgba(121,242,255,0.22)",
    bubbleBg: "rgba(15,23,42,0.95)",
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
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Транспорт: дуговые рельсы тем (вместо Conveyor) */
  function TopicOrbitRails() {}
  TopicOrbitRails.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    var rails = [
      { fromX: -150, fromY: -70, color: C.wordstat, label: "Wordstat" },
      { fromX: -155, fromY: 75, color: C.crm, label: "CRM" },
      { fromX: 150, fromY: -55, color: C.comp, label: "Конкуренты" }
    ];
    rails.forEach(function (rail, idx) {
      ctx.strokeStyle = rail.color;
      ctx.globalAlpha = 0.28;
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 5]);
      ctx.beginPath();
      ctx.moveTo(rail.fromX, rail.fromY);
      ctx.quadraticCurveTo(0, rail.fromY * 0.35, 0, 0);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.globalAlpha = 1;

      var tokenPrg = (prg + idx * 38) % 280;
      if (tokenPrg < 95) {
        var t = tokenPrg / 95;
        var tx = rail.fromX + (0 - rail.fromX) * t;
        var ty = rail.fromY + (0 - rail.fromY) * t - Math.sin(t * Math.PI) * 18;
        drawRR(ctx, tx - 7, ty - 7, 14, 14, 3, rail.color, C.outline);
      }
    });
  };

  /* Центральный объект: матрица календаря 14×3 (вместо WebsiteTerminal) */
  function ContentCalendarMatrix() {
    this.syncWave = 0;
  }
  ContentCalendarMatrix.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    drawRR(ctx, -72, -58, 144, 118, 10, C.matrixBg, C.outline);

    ctx.fillStyle = "#f8fafc";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("14 дней · VK / TG / Дzen", 0, -48);

    var cols = 7;
    var rows = 3;
    var cellW = 17;
    var cellH = 11;
    var startX = -60;
    var startY = -38;
    var platforms = [C.vk, C.tg, C.dzen];

    for (var r = 0; r < rows; r++) {
      for (var c = 0; c < cols; c++) {
        var x = startX + c * (cellW + 3);
        var y = startY + r * (cellH + 4);
        var slotIdx = r * cols + c;
        var filled = prg > 72 + slotIdx * 2.2;
        var approved = prg > 210;
        var fill = approved ? "rgba(34,197,94,0.35)" : filled ? C.cellHot : C.cellIdle;
        drawRR(ctx, x, y, cellW, cellH, 2, fill, platforms[r]);
        if (filled && !approved) {
          ctx.fillStyle = platforms[r];
          ctx.fillRect(x + 3, y + 4, cellW - 6, 2);
        }
      }
    }

    if (prg >= 220) {
      this.syncWave = Math.min(1, (prg - 220) / 35);
      ctx.strokeStyle = "rgba(34,197,94," + (0.35 + this.syncWave * 0.45) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, -2, 20 + this.syncWave * 55, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Синхронизация публикаций", 0, 72);
    }
  };

  function WordstatClusterBeacon() {}
  WordstatClusterBeacon.prototype.draw = function (ctx) {
    var pulse = 0.5 + Math.sin(frame * 0.08) * 0.5;
    drawRR(ctx, -118, -88, 34, 22, 6, "rgba(34,197,94,0.15)", C.wordstat);
    ctx.fillStyle = C.wordstat;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Wordstat", -101, -76);
    ctx.globalAlpha = pulse * 0.6;
    ctx.beginPath();
    ctx.arc(-101, -77, 8 + pulse * 4, 0, Math.PI * 2);
    ctx.fillStyle = C.wordstat;
    ctx.fill();
    ctx.globalAlpha = 1;
  };

  function CrmIntentWell() {}
  CrmIntentWell.prototype.draw = function (ctx) {
    drawRR(ctx, -122, 62, 38, 26, 6, "rgba(139,92,246,0.14)", C.crm);
    ctx.fillStyle = "#ddd6fe";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM FAQ", -103, 74);
    var prg = (frame * 0.042) % 280;
    if (prg > 40 && prg < 120) {
      ctx.fillStyle = C.crm;
      ctx.fillRect(-110, 80, 14, 3);
      ctx.fillRect(-92, 80, 18, 3);
    }
  };

  function CompetitorGapRadar() {}
  CompetitorGapRadar.prototype.draw = function (ctx) {
    var rot = frame * 0.02;
    ctx.save();
    ctx.translate(118, -78);
    ctx.rotate(rot);
    ctx.strokeStyle = "rgba(245,158,11,0.45)";
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.arc(0, 0, 16, 0, Math.PI * 2);
    ctx.moveTo(-16, 0);
    ctx.lineTo(16, 0);
    ctx.moveTo(0, -16);
    ctx.lineTo(0, 16);
    ctx.stroke();
    ctx.restore();
    ctx.fillStyle = C.comp;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Пробелы", 118, -58);
  };

  function PlatformFormatRibbon() {}
  PlatformFormatRibbon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 280;
    if (prg < 155 || prg > 215) return;
    var labels = [
      { t: "VK карусель", c: C.vk, x: -48 },
      { t: "TG лонг", c: C.tg, x: 0 },
      { t: "Дzen SEO", c: C.dzen, x: 48 }
    ];
    labels.forEach(function (lb, i) {
      if (prg > 160 + i * 12) {
        drawRR(ctx, lb.x - 22, 48, 44, 14, 4, "rgba(255,255,255,0.08)", lb.c);
        ctx.fillStyle = lb.c;
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(lb.t, lb.x, 58);
      }
    });
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
    var prg = (frame * 0.042) % 280;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -42, y: -18 },
      "2_seo": { x: -14, y: -8 },
      "3_coder": { x: 14, y: -8 },
      "4_designer": { x: 42, y: -18 },
      "5_deployer": { x: 0, y: 28 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

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
      this.x = this.baseX;
      this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 190 === 0 && Math.random() < 0.12) {
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
    if (carryType) drawRR(ctx, -16 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new TopicOrbitRails());
  entities.push(new WordstatClusterBeacon());
  entities.push(new CrmIntentWell());
  entities.push(new CompetitorGapRadar());
  entities.push(new ContentCalendarMatrix());
  entities.push(new PlatformFormatRibbon());
  entities.push(new Agent(-95, 92, C.agentYellow, "1_architect", 24, [
    "Рубрикатор на 14 дней", "Мастер-тема в центр", "Слоты без дыр"
  ]));
  entities.push(new Agent(-48, 98, C.agentGreen, "2_seo", 78, [
    "Кластер «ai посты вк»", "LSI для Дzen-статьи", "Спрос > догадки"
  ]));
  entities.push(new Agent(0, 102, C.agentBlue, "3_coder", 132, [
    "Scoring тем из CRM", "Dedup vs конкуренты", "Пустые ячейки → AI"
  ]));
  entities.push(new Agent(48, 98, C.agentPink, "4_designer", 186, [
    "Карусель VK готова", "TG хук в 1-й строке", "Обложка Дzen 1200×675"
  ]));
  entities.push(new Agent(95, 92, C.agentPurple, "5_deployer", 238, [
    "Approve в Telegram", "VK API в очередь", "RSS-колонка Дzen"
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

    var prg = (frame * 0.042) % 280;
    if (prg >= 22 && prg < 22.05) createBubble(-90, -55, "1. Сбор Wordstat-кластеров");
    if (prg >= 86 && prg < 86.05) createBubble(-20, -62, "2. CRM-интент → слот");
    if (prg >= 152 && prg < 152.05) createBubble(30, -20, "3. Три адаптации формата");
    if (prg >= 214 && prg < 214.05) createBubble(0, 38, "4. Human approve");
    if (prg >= 248 && prg < 248.05) createBubble(0, 64, "5. Синхронизация каналов");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 10);
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
  document.querySelectorAll('.akp-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.akp-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.akp-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.akp-faq-q');
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
  var root = document.querySelector('.akp-page') || document.querySelector('.akp-content');
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
