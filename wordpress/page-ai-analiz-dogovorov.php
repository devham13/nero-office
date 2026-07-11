<?php
/**
 * Template Name: AI для анализа договоров: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI-анализа договоров под ключ для юротделов, закупок и финансов.
 */

$page_seo_title       = 'AI для анализа договоров под ключ — внедрение и настройка';
$page_seo_description = 'Внедряем AI для анализа договоров под ключ: риски, сроки, штрафы и отклонения от шаблона. Для юротделов, закупок и финансов. Бесплатная проверка 3 договоров.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Проблема', 'href' => '#pochemu-yuristy'],
    ['label' => 'Как работает', 'href' => '#chto-delaet-ai'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Для кого', 'href' => '#dlya-kogo'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить договоры';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#chto-delaet-ai';

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
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.aad-content{--aad-bg:#050711;--aad-bg2:#080b17;--aad-surface:rgba(255,255,255,.072);--aad-text:#e6edf7;--aad-muted:#9aa8bd;--aad-soft:#c7d2e5;--aad-heading:#fff;--aad-border:rgba(255,255,255,.10);--aad-indigo:#6366f1;--aad-violet:#8b5cf6;--aad-accent:#79f2ff;--aad-green:#22c55e;--aad-btn-from:#6366f1;--aad-btn-to:#8b5cf6;--aad-container:1220px;background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);color:var(--aad-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden}
.aad-content *,.aad-content *::before,.aad-content *::after{box-sizing:border-box}
.aad-content a{color:inherit}
.aad-content p{color:var(--aad-muted);line-height:1.72;margin:0 0 1em}
.aad-content p:last-child{margin-bottom:0}
.aad-content h2,.aad-content h3,.aad-content h4{color:var(--aad-heading);letter-spacing:-.045em;margin:0 0 .7em}
.aad-content strong{color:var(--aad-soft)}
.aad-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.aad-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aad-muted);font-size:14.5px;line-height:1.65}
.aad-content ul li::before{content:'›';position:absolute;left:0;color:var(--aad-indigo);font-weight:700}
.aad-cnt,.aad-content .ym-container{width:min(var(--aad-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.aad-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.aad-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.aad-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.aad-sh.aad-left{margin-left:0;text-align:left}
.aad-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.aad-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.aad-sh.aad-left p{margin-left:0}
.aad-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#a5b4fc;margin-bottom:14px}
.aad-gt{background:linear-gradient(92deg,#fff 0%,var(--aad-indigo) 44%,var(--aad-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.aad-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.aad-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.aad-intro-text{position:relative;padding-left:20px;text-align:left!important}
.aad-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aad-indigo),var(--aad-violet))}
.aad-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--aad-muted);margin-bottom:1em}
.aad-intro-text p:last-child{margin-bottom:0;color:var(--aad-soft)}
.aad-intro-term{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:18px;font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:12px;line-height:1.55;color:#cbd5e1}
.aad-intro-term .aad-term-line{display:flex;gap:8px;margin-bottom:6px}
.aad-intro-term .aad-term-prompt{color:var(--aad-indigo);font-weight:700}
.aad-intro-chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:14px}
.aad-intro-chip{padding:6px 11px;border-radius:999px;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.25);font-size:11px;font-weight:700;color:#c7d2fe}
@media(max-width:900px){.aad-intro-grid{grid-template-columns:1fr;gap:36px}}
.aad-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.aad-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.aad-toc a{display:inline-block;padding:9px 18px;background:var(--aad-surface);border:1px solid var(--aad-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aad-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.aad-toc a:hover{border-color:rgba(99,102,241,.42);color:#a5b4fc;background:rgba(99,102,241,.08)}
.aad-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aad-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.aad-card:hover{border-color:rgba(99,102,241,.28);transform:translateY(-2px)}
.aad-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.aad-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.aad-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
@media(max-width:900px){.aad-grid-2,.aad-grid-3,.aad-grid-4{grid-template-columns:1fr}}
@media(max-width:960px) and (min-width:601px){.aad-grid-3,.aad-grid-4{grid-template-columns:1fr 1fr}}
.aad-prose{max-width:820px;margin:0 auto}
.aad-prose.aad-left{margin-left:0}
.aad-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.aad-table{width:100%;border-collapse:collapse;font-size:14px}
.aad-table th{padding:13px 16px;text-align:left;background:rgba(99,102,241,.1);color:#a5b4fc;font-weight:700;border-bottom:1px solid rgba(99,102,241,.25);white-space:nowrap}
.aad-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aad-text);vertical-align:top}
.aad-table tr:last-child td{border-bottom:none}
.aad-table tr:hover td{background:rgba(255,255,255,.03)}
.aad-timeline{position:relative;padding-left:40px}
.aad-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aad-indigo),var(--aad-violet));opacity:.35;border-radius:2px}
.aad-tl-item{position:relative;margin-bottom:32px}
.aad-tl-item:last-child{margin-bottom:0}
.aad-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aad-indigo);box-shadow:0 0 0 4px rgba(99,102,241,.2)}
.aad-tl-item h3{font-size:17px;margin-bottom:8px}
.aad-tl-item p{font-size:14.5px;margin:0}
.aad-steps{counter-reset:aadstep;display:grid;gap:10px;margin:24px 0}
.aad-step{display:grid;grid-template-columns:36px 1fr;gap:14px;align-items:start;padding:16px 18px;border-radius:16px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08)}
.aad-step::before{counter-increment:aadstep;content:counter(aadstep);display:grid;place-items:center;width:36px;height:36px;border-radius:12px;background:rgba(99,102,241,.15);color:#c7d2fe;font-weight:800;font-size:14px}
.aad-step strong{color:var(--aad-soft);display:block;margin-bottom:4px}
.aad-step span{font-size:14px;color:var(--aad-muted)}
.aad-callout{padding:18px 22px;border-left:3px solid var(--aad-indigo);background:rgba(99,102,241,.08);border-radius:0 14px 14px 0;margin:24px 0}
.aad-callout p{margin:0;color:var(--aad-soft)!important}
.aad-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.aad-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.aad-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aad-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.aad-faq-q::after{content:'▾';font-size:13px;color:#a5b4fc;flex-shrink:0;transition:transform .25s}
.aad-faq-item.open .aad-faq-q::after{transform:rotate(180deg)}
.aad-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--aad-muted);line-height:1.72}
.aad-faq-item.open .aad-faq-a{max-height:600px;padding:0 24px 20px}
.aad-boris-wrap{padding:8px 0 0;background:linear-gradient(180deg,rgba(255,255,255,.02),rgba(248,250,252,.04))}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(99,102,241,.12),rgba(139,92,246,.1));border:1px solid rgba(99,102,241,.3);text-align:center}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(99,102,241,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--aad-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn:hover{transform:translateY(-2px)}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aad-btn-from),var(--aad-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(99,102,241,.35)}
.ym-link--accent{color:#a5b4fc!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-analiz-dogovorov-page" role="main" tabindex="-1">

<section class="nero-ai-hero aad-hero-contracts" id="aad-hero-contracts" aria-labelledby="aad-hero-title">
<style>
/* ── Hero ai-analiz-dogovorov: самодостаточные стили .nero-ai-home-page ── */
.aad-hero-contracts {
  --aad-indigo: #6366f1;
  --aad-violet: #8b5cf6;
  --aad-gold: #f59e0b;
  --aad-risk: #ef4444;
  --aad-ok: #22c55e;
  --aad-text: #e6edf7;
  --aad-muted: #94a3b8;
  --aad-soft: #c7d2e5;
  --aad-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.aad-hero-contracts::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 30%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.aad-hero-contracts::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(99, 102, 241, .14), transparent 66%);
  filter: blur(10px);
  animation: aadHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aadHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.aad-hero-contracts .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aad-hero-contracts .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aad-hero-contracts .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aad-hero-contracts .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aad-indigo) 38%, var(--aad-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aad-hero-contracts .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(99, 102, 241, 0.28);
  border-radius: 999px;
  background: rgba(99, 102, 241, 0.1);
  color: #a5b4fc !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aad-hero-contracts .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aad-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aad-hero-contracts .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aad-hero-contracts .nero-ai-badge {
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
.aad-hero-contracts .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aad-hero-contracts .nero-ai-btn {
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
.aad-hero-contracts .nero-ai-btn:hover { transform: translateY(-2px); }
.aad-hero-contracts .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, var(--aad-indigo), var(--aad-violet));
  box-shadow: 0 18px 42px rgba(99, 102, 241, 0.28);
}
.aad-hero-contracts .nero-ai-btn-secondary {
  color: var(--aad-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aad-hero-contracts .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aad-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.aad-hero-contracts .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aad-hero-contracts .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aad-hero-contracts .nero-ai-dots { display: flex; gap: 7px; }
.aad-hero-contracts .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aad-hero-contracts .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aad-hero-contracts .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aad-hero-contracts .nero-ai-dot:nth-child(3) { background: #34d399; }
.aad-hero-contracts .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aad-hero-contracts .nero-ai-window-body { padding: 16px; }
.aad-hero-contracts .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aad-hero-contracts .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aad-hero-contracts .nero-ai-live-pill {
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
.aad-hero-contracts .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aadPulse 1.6s infinite;
}
@keyframes aadPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aad-hero-contracts .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aad-hero-contracts .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aad-hero-contracts .nero-ai-metric span {
  display: block;
  color: var(--aad-muted);
  font-size: 11px;
  font-weight: 700;
}
.aad-hero-contracts .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aad-hero-contracts .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aad-hero-contracts .aad-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(99, 102, 241, 0.22);
  background: radial-gradient(ellipse at 40% 40%, rgba(99,102,241,.09), rgba(6,10,24,.94) 72%);
}
.aad-hero-contracts #aad-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aad-hero-contracts .nero-ai-task-stream { display: grid; gap: 8px; }
.aad-hero-contracts .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aad-hero-contracts .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(99,102,241,.14);
  color: #a5b4fc;
  font-size: 11px;
  font-weight: 800;
}
.aad-hero-contracts .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aad-hero-contracts .nero-ai-task span {
  color: var(--aad-muted);
  font-size: 11px;
}
.aad-hero-contracts .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aad-hero-contracts .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.aad-hero-contracts .nero-ai-status--risk {
  background: rgba(239,68,68,.14);
  color: #fecaca;
}
@media (max-width: 1100px) {
  .aad-hero-contracts .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aad-hero-contracts .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aad-hero-contracts .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aad-hero-contracts .nero-ai-window-body { padding: 12px; }
  .aad-hero-contracts .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aad-hero-contracts .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Legal AI · договоры · внедрение под ключ</p>
      <h1 id="aad-hero-title">AI для анализа договоров: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть подсвечивает риски, сроки, штрафы и отклонения от вашего шаблона — юристы тратят меньше времени на первичный разбор типовых договоров</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы внедрения">
        <li class="nero-ai-badge">Аудит шаблонов</li>
        <li class="nero-ai-badge">RAG-риски</li>
        <li class="nero-ai-badge">Diff с контрагентом</li>
        <li class="nero-ai-badge">Отчёт юристу</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?><?php echo $primary_cta_attrs; ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-delaet-ai">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-анализа договоров">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Legal review · договоры</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Договоров сегодня</span>
              <strong>47</strong>
              <small>поставка, аренда, NDA</small>
            </div>
            <div class="nero-ai-metric">
              <span>Рисков найдено</span>
              <strong>12</strong>
              <small>штрафы, сроки, юрисдикция</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время review</span>
              <strong>4 мин</strong>
              <small>вместо ~92 мин вручную</small>
            </div>
            <div class="nero-ai-metric">
              <span>Отклонений от шаблона</span>
              <strong>8</strong>
              <small>diff по разделам</small>
            </div>
          </div>

          <div class="aad-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aad-hero-canvas" role="img" aria-label="Анимация: страницы договора по орбите попадают на стол сравнения, AI подсвечивает риски и юрист ставит печать одобрения"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий анализа договоров">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">§</span>
              <div><strong>NDA контрагента</strong><span>Автопролонгация без уведомления</span></div>
              <span class="nero-ai-status nero-ai-status--risk">риск</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⚖</span>
              <div><strong>Договор поставки</strong><span>Асимметричные штрафы vs шаблон</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📋</span>
              <div><strong>Аренда офиса</strong><span>Протокол разногласий — черновик</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Юрист одобрил</strong><span>HITL · финальное решение за человеком</span></div>
              <span class="nero-ai-status">одобрено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="aad-content">

  <section class="aad-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aad-cnt">
      <div class="aad-intro-grid nero-ai-reveal">
        <div class="aad-intro-text">
          <p class="aad-eyebrow">Лонгрид · ai анализ договоров</p>
          <p><strong>Определение.</strong> AI для анализа договоров — это внедрённый контур на базе LLM, RAG и правил, который автоматизирует первичный review: извлекает ключевые условия, сравнивает текст с корпоративным шаблоном, подсвечивает риски и формирует отчёт для юриста. Это не замена CLM или СЭД, а слой интеллекта поверх вашего документооборота.</p>
          <p><strong>Коротко.</strong> Nero Network настраивает AI-анализ договоров под ключ: риски, сроки, штрафы и отклонения от вашего шаблона — за минуты вместо часов. Финальное решение остаётся за юристом.</p>
        </div>
        <div class="aad-intro-term" aria-label="Пайплайн анализа договора">
          <div class="aad-term-line"><span class="aad-term-prompt">$</span><span>ocr → chunk → rag diff</span></div>
          <div class="aad-term-line"><span class="aad-term-prompt">→</span><span>risk-score · HITL</span></div>
          <div class="aad-term-line"><span class="aad-term-prompt">→</span><span>отчёт юристу · СЭД</span></div>
          <div class="aad-intro-chips">
            <span class="aad-intro-chip">92 мин → 4 мин</span>
            <span class="aad-intro-chip">RAG-шаблоны</span>
            <span class="aad-intro-chip">3 договора бесплатно</span>
            <span class="aad-intro-chip">200 тыс.–1,5 млн ₽</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="aad-toc-outer">
    <div class="aad-cnt">
      <nav class="aad-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-yuristy">Проблема</a>
        <a href="#chto-delaet-ai">Как работает AI</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#kak-vnedrit">Под ключ vs SaaS</a>
        <a href="#faq">FAQ</a>
        <a href="#besplatnaya-proverka">Проверка 3 договоров</a>
      </nav>
    </div>
  </div>

  <section class="aad-section" id="pochemu-yuristy">
    <div class="aad-cnt">
      <div class="aad-sh aad-left">
        <span class="aad-eyebrow">Боль юротдела</span>
        <h2>Почему юристы тратят часы на первичный разбор типовых договоров</h2>
        <p>Типовой договор кажется «стандартным» — до тех пор, пока контрагент не принесёт версию с другими штрафами, скрытой автопролонгацией или односторонним правом расторжения.</p>
      </div>
      <div class="aad-prose aad-left nero-ai-reveal">
        <p>Юрист открывает документ на 15–40 страниц и вручную проходит предмет, цену, сроки, ответственность, конфиденциальность, форс-мажор. На один первичный разбор уходит от 40 минут до нескольких часов — по отраслевым обзорам Bloomberg Law среднее время ручного review составляет около 92 минут.</p>
        <p>При потоке 20–200 договоров в месяц эта рутина съедает недели рабочего времени. Юристы перегружены, а менеджеры закупок и продаж подписывают «чужие» шаблоны без глубокой проверки. Версии сравнивают в Word вручную — и риски всплывают уже после подписания.</p>
        <p>Российский рынок LegalTech растёт: по оценкам CNews и Moscow Digital School, объём достигнет 20 млрд ₽ в 2026 году. Договорная работа — лидирующее направление роста.</p>
      </div>
      <div class="aad-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="aad-card">
          <h3>Где прячутся риски, штрафы и невыгодные сроки</h3>
          <ul>
            <li><strong>Штрафы и неустойки</strong> — асимметричные санкции, каскадные пени</li>
            <li><strong>Сроки</strong> — короткая приёмка, автопролонгация без уведомления</li>
            <li><strong>Расторжение</strong> — право контрагента выйти без компенсации</li>
            <li><strong>Юрисдикция</strong> — неудобный арбитраж, чужое право</li>
            <li><strong>NDA и IP</strong> — размытые формулировки, переход прав без компенсации</li>
          </ul>
          <p style="font-size:14px;margin-top:12px;">В кейсе Fplus (Doczilla) после AI-review ошибки в типовых договорах снизились на 50–60%.</p>
        </div>
        <div class="aad-card nero-ai-delay-1">
          <h3>Почему ручная проверка не масштабируется</h3>
          <p>При росте бизнеса юридический отдел становится узким горлышком. SLA согласования растягиваются, сделки тормозятся, стандарт проверки «плывёт» между менеджерами.</p>
          <p>По данным РБК, более 60% игроков LegalTech увеличили инвестиции в технологии сильнее, чем за предыдущие пять лет. Прогноз к 2030 году — до 90% типовых юридических документов получат первичную автоматическую обработку.</p>
        </div>
      </div>
      <div class="aad-callout nero-ai-reveal nero-ai-delay-2"><p><strong>Итог блока:</strong> AI не заменяет юриста, но снимает с него часы рутинного первичного анализа — и освобождает время для переговоров и сложных сделок.</p></div>
    </div>
  </section>

  <section class="aad-section aad-section-alt" id="chto-delaet-ai">
    <div class="aad-cnt">
      <div class="aad-sh">
        <span class="aad-eyebrow">Функции AI</span>
        <h2>Что делает AI при анализе договоров: риски, условия и отклонения от шаблона</h2>
        <p>Автоматизированный первичный review: система читает документ, извлекает условия, сравнивает с эталоном и формирует риск-отчёт.</p>
      </div>
      <div class="aad-table-wrap nero-ai-reveal">
        <table class="aad-table">
          <thead><tr><th>Что автоматизирует AI</th><th>Что остаётся за юристом</th></tr></thead>
          <tbody>
            <tr><td>Извлечение сроков, штрафов, условий оплаты</td><td>Интерпретация норм в контексте сделки</td></tr>
            <tr><td>Сравнение с корпоративным шаблоном</td><td>Переговоры с контрагентом</td></tr>
            <tr><td>Подсветка «красных флагов» и отклонений</td><td>Финальное решение о подписании</td></tr>
            <tr><td>Черновик протокола разногласий</td><td>Работа с уникальными условиями</td></tr>
            <tr><td>Сводка для закупок/продаж простым языком</td><td>Ответственность за подпись</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aad-grid-3 nero-ai-reveal" style="margin-top:28px;">
        <div class="aad-card">
          <h3>Подсветка рисков и несоответствий шаблону</h3>
          <p>Чек-лист рисков под вашу роль — закупки, продажи, юротдел. Отклонения с указанием: что изменено, какой риск несёт, какая формулировка в вашем стандарте. Doczilla AI — ~1 минута на нетиповой договор.</p>
        </div>
        <div class="aad-card nero-ai-delay-1">
          <h3>Сравнение версии контрагента с эталоном</h3>
          <p>Diff по разделам, комментарии к каждому изменению, приоритет по уровню риска. Черновик протокола разногласий формируется автоматически. Kira и Luminance — 60–90% ускорение на стандартных клаузах.</p>
        </div>
        <div class="aad-card nero-ai-delay-2">
          <h3>Human-in-the-loop</h3>
          <p>Исследование arxiv:2605.14675 (2026): главный барьер — разрыв между возможностями модели и доверием к выводу. AI готовит риск-карту, юрист принимает решение. 68% юристов перепроверяют выводы AI — мы закладываем это в процесс.</p>
        </div>
      </div>

      <div class="aad-boris-wrap nero-ai-reveal">
<section class="boris-contract-viz" id="ai-analiz-dogovorov-boris-block" aria-labelledby="boris-contract-viz-title">
<style>
#ai-analiz-dogovorov-boris-block {
  --boris-bg: #f8fafc;
  --boris-card: #ffffff;
  --boris-border: rgba(15, 23, 42, 0.08);
  --boris-text: #0f172a;
  --boris-muted: #64748b;
  --boris-accent: #2563eb;
  --boris-risk: #ef4444;
  --boris-ok: #22c55e;
  --boris-warn: #f59e0b;
  margin: 48px 0;
  font-family: Inter, system-ui, -apple-system, sans-serif;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__card {
  background: var(--boris-card);
  border: 1px solid var(--boris-border);
  border-radius: 22px;
  box-shadow: 0 18px 48px rgba(15, 23, 42, 0.06);
  padding: 28px 32px;
  background-image: radial-gradient(ellipse 80% 60% at 100% 0%, rgba(37, 99, 235, 0.05), transparent 55%);
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__grid {
  display: grid;
  grid-template-columns: 1fr 1.1fr;
  gap: 32px;
  align-items: center;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__eyebrow {
  display: inline-block;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--boris-accent);
  margin-bottom: 10px;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__title {
  font-size: clamp(1.15rem, 2vw, 1.45rem);
  font-weight: 700;
  line-height: 1.25;
  color: var(--boris-text);
  margin: 0 0 12px;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__lead {
  font-size: 0.95rem;
  line-height: 1.55;
  color: var(--boris-muted);
  margin: 0 0 20px;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__stats {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 18px;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__stat {
  flex: 1 1 90px;
  min-width: 88px;
  padding: 10px 12px;
  border-radius: 12px;
  background: var(--boris-bg);
  border: 1px solid var(--boris-border);
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__stat-val {
  display: block;
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--boris-text);
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__stat-lbl {
  font-size: 0.7rem;
  color: var(--boris-muted);
  line-height: 1.3;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 16px;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__pill {
  font-size: 0.75rem;
  font-weight: 600;
  padding: 5px 11px;
  border-radius: 999px;
  background: #eff6ff;
  color: #1d4ed8;
  border: 1px solid rgba(37, 99, 235, 0.15);
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__pill--risk {
  background: #fef2f2;
  color: #b91c1c;
  border-color: rgba(239, 68, 68, 0.2);
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__bridge {
  font-size: 0.85rem;
  color: var(--boris-muted);
  margin: 0;
  padding-top: 4px;
  border-top: 1px dashed var(--boris-border);
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__canvas-wrap {
  position: relative;
  min-height: 420px;
  border-radius: 18px;
  overflow: hidden;
  background: linear-gradient(145deg, #f1f5f9 0%, #e2e8f0 100%);
  border: 1px solid var(--boris-border);
}
#ai-analiz-dogovorov-boris-block #contract-clause-diff-canvas {
  display: block;
  width: 100%;
  height: 100%;
  min-height: 420px;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__live {
  position: absolute;
  top: 12px;
  right: 12px;
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 0.7rem;
  font-weight: 600;
  color: var(--boris-muted);
  background: rgba(255, 255, 255, 0.92);
  padding: 4px 10px;
  border-radius: 999px;
  border: 1px solid var(--boris-border);
  pointer-events: none;
}
#ai-analiz-dogovorov-boris-block .boris-contract-viz__live-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--boris-ok);
  animation: boris-contract-pulse 1.6s ease-in-out infinite;
}
@keyframes boris-contract-pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.5; transform: scale(0.85); }
}
@media (max-width: 900px) {
  #ai-analiz-dogovorov-boris-block .boris-contract-viz__grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }
  #ai-analiz-dogovorov-boris-block .boris-contract-viz__card {
    padding: 22px 20px;
  }
  #ai-analiz-dogovorov-boris-block .boris-contract-viz__canvas-wrap,
  #ai-analiz-dogovorov-boris-block #contract-clause-diff-canvas {
    min-height: 340px;
  }
}
</style>

<div class="ym-container">
  <div class="boris-contract-viz__card">
    <div class="boris-contract-viz__grid">
      <div class="boris-contract-viz__copy">
        <span class="boris-contract-viz__eyebrow">Сравнение версий</span>
        <h3 class="boris-contract-viz__title" id="boris-contract-viz-title">AI находит отклонения от вашего шаблона — пункт за пунктом</h3>
        <p class="boris-contract-viz__lead">Контрагент прислал «свою» редакцию? Система сопоставляет клаузы с корпоративным эталоном, подсвечивает риски и формирует приоритет для юриста.</p>
        <div class="boris-contract-viz__stats">
          <div class="boris-contract-viz__stat">
            <span class="boris-contract-viz__stat-val">~1 мин</span>
            <span class="boris-contract-viz__stat-lbl">первичный diff</span>
          </div>
          <div class="boris-contract-viz__stat">
            <span class="boris-contract-viz__stat-val">6+</span>
            <span class="boris-contract-viz__stat-lbl">типов красных флагов</span>
          </div>
          <div class="boris-contract-viz__stat">
            <span class="boris-contract-viz__stat-val">HITL</span>
            <span class="boris-contract-viz__stat-lbl">решение за юристом</span>
          </div>
        </div>
        <div class="boris-contract-viz__pills">
          <span class="boris-contract-viz__pill">Штрафы</span>
          <span class="boris-contract-viz__pill">Сроки</span>
          <span class="boris-contract-viz__pill boris-contract-viz__pill--risk">Автопролонгация</span>
          <span class="boris-contract-viz__pill">Лимит ответственности</span>
        </div>
        <p class="boris-contract-viz__bridge">Дальше разберём этапы внедрения — от аудита шаблонов до пилота на ваших договорах.</p>
      </div>
      <div class="boris-contract-viz__canvas-wrap" aria-hidden="true">
        <span class="boris-contract-viz__live"><span class="boris-contract-viz__live-dot"></span> Сканирование</span>
        <canvas id="contract-clause-diff-canvas" role="img" aria-label="Анимация: сравнение договора контрагента с корпоративным шаблоном, подсветка рисков"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
(function contractClauseDiffEngine() {
  const canvas = document.getElementById('contract-clause-diff-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let cw = 0, ch = 0, frame = 0;
  let scanY = 0, scanDir = 1;
  const C = {
    outline: '#0f172a',
    paper: '#ffffff',
    paperShadow: '#e2e8f0',
    line: '#cbd5e1',
    lineOk: '#bbf7d0',
    lineRisk: '#fecaca',
    scan: 'rgba(37, 99, 235, 0.35)',
    scanGlow: 'rgba(37, 99, 235, 0.12)',
    accent: '#2563eb',
    risk: '#ef4444',
    ok: '#22c55e',
    warn: '#f59e0b',
    label: '#64748b',
    badgeBg: '#ffffff'
  };

  const clauses = [
    { y: 0.14, w: 0.72, risk: false, label: 'Предмет договора' },
    { y: 0.24, w: 0.85, risk: false, label: 'Срок поставки' },
    { y: 0.34, w: 0.68, risk: true, label: 'Штрафы ×3' },
    { y: 0.44, w: 0.78, risk: false, label: 'Оплата 30 дней' },
    { y: 0.54, w: 0.62, risk: true, label: 'Автопролонгация' },
    { y: 0.64, w: 0.8, risk: false, label: 'Конфиденциальность' },
    { y: 0.74, w: 0.55, risk: true, label: 'Лимит ответств.' },
    { y: 0.84, w: 0.7, risk: false, label: 'Форс-мажор' }
  ];

  const riskBadges = [
    { text: 'Штраф ×3', x: 0.5, y: 0.32, delay: 90, color: C.risk },
    { text: 'Автопролонгация', x: 0.52, y: 0.52, delay: 130, color: C.warn },
    { text: 'Нет лимита', x: 0.48, y: 0.72, delay: 170, color: C.risk }
  ];

  function resize() {
    const wrap = canvas.parentElement;
    if (!wrap) return;
    const dpr = Math.min(window.devicePixelRatio || 1, 2);
    cw = wrap.clientWidth;
    ch = wrap.clientHeight || 420;
    canvas.width = cw * dpr;
    canvas.height = ch * dpr;
    canvas.style.width = cw + 'px';
    canvas.style.height = ch + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function roundRect(x, y, w, h, r) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else { ctx.moveTo(x + r, y); ctx.arcTo(x + w, y, x + w, y + h, r); ctx.arcTo(x + w, y + h, x, y + h, r); ctx.arcTo(x, y + h, x, y, r); ctx.arcTo(x, y, x + w, y, r); }
    ctx.closePath();
  }

  function drawDoc(x, y, w, h, title, isTemplate) {
    ctx.save();
    roundRect(x, y, w, h, 10);
    ctx.fillStyle = C.paper;
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();

    ctx.fillStyle = isTemplate ? '#dcfce7' : '#fee2e2';
    roundRect(x + 10, y + 10, w - 20, 22, 6);
    ctx.fill();
    ctx.fillStyle = isTemplate ? '#166534' : '#991b1b';
    ctx.font = '600 11px Inter, system-ui, sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(title, x + 16, y + 25);

    clauses.forEach((cl, i) => {
      const ly = y + 42 + (h - 52) * cl.y;
      const lw = (w - 28) * cl.w;
      const scanned = scanY > ly - y - 8;
      const highlight = scanned && !isTemplate && cl.risk;
      const match = scanned && isTemplate;

      ctx.fillStyle = highlight ? C.lineRisk : (match ? C.lineOk : C.line);
      roundRect(x + 14, ly, lw, 8, 3);
      ctx.fill();

      if (highlight && frame > 60) {
        ctx.strokeStyle = C.risk;
        ctx.lineWidth = 1.2;
        ctx.stroke();
      }
    });
    ctx.restore();
  }

  function drawScanBeam(docX, docY, docW, docH) {
    const beamH = 28;
    const relY = docY + scanY * (docH - beamH);
    const grad = ctx.createLinearGradient(0, relY - beamH, 0, relY + beamH);
    grad.addColorStop(0, 'transparent');
    grad.addColorStop(0.45, C.scanGlow);
    grad.addColorStop(0.5, C.scan);
    grad.addColorStop(0.55, C.scanGlow);
    grad.addColorStop(1, 'transparent');
    ctx.fillStyle = grad;
    ctx.fillRect(docX, relY - beamH, docW * 2 + 40, beamH * 2);

    ctx.strokeStyle = C.accent;
    ctx.lineWidth = 2;
    ctx.setLineDash([6, 4]);
    ctx.beginPath();
    ctx.moveTo(docX + docW + 20, relY);
    ctx.lineTo(docX + docW * 2 + 30, relY);
    ctx.stroke();
    ctx.setLineDash([]);
  }

  function drawConnector(x1, y1, x2, y2, alpha) {
    if (alpha <= 0) return;
    ctx.save();
    ctx.globalAlpha = alpha;
    ctx.strokeStyle = C.risk;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([4, 3]);
    ctx.beginPath();
    ctx.moveTo(x1, y1);
    ctx.bezierCurveTo(x1 + 30, y1, x2 - 30, y2, x2, y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.restore();
  }

  function drawBadge(badge, docX, docY, docW, docH) {
    const age = frame - badge.delay;
    if (age < 0) return;
    const pop = Math.min(1, age / 20);
    const float = Math.sin(frame * 0.04 + badge.delay) * 3;
    const bx = docX + docW * badge.x;
    const by = docY + docH * badge.y + float;

    ctx.save();
    ctx.globalAlpha = pop;
    const tw = ctx.measureText(badge.text).width + 20;
    roundRect(bx - tw / 2, by - 12, tw, 24, 12);
    ctx.fillStyle = C.badgeBg;
    ctx.fill();
    ctx.strokeStyle = badge.color;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.fillStyle = badge.color;
    ctx.font = '600 10px Inter, system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(badge.text, bx, by + 4);
    ctx.restore();
  }

  function drawAiLens(cx, cy) {
    const pulse = 1 + Math.sin(frame * 0.06) * 0.06;
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(pulse, pulse);
    ctx.strokeStyle = C.accent;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(0, 0, 16, 0, Math.PI * 2);
    ctx.stroke();
    ctx.beginPath();
    ctx.arc(0, 0, 10, 0, Math.PI * 2);
    ctx.fillStyle = 'rgba(37, 99, 235, 0.15)';
    ctx.fill();
    ctx.beginPath();
    ctx.moveTo(11, 11);
    ctx.lineTo(20, 20);
    ctx.strokeStyle = C.accent;
    ctx.lineWidth = 3;
    ctx.stroke();
    ctx.fillStyle = C.accent;
    ctx.font = '700 8px Inter, system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', 0, 3);
    ctx.restore();
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);

    const pad = Math.max(12, cw * 0.04);
    const docW = (cw - pad * 3) / 2;
    const docH = ch - pad * 2;
    const doc1X = pad;
    const doc2X = pad * 2 + docW;
    const docY = pad;

    scanY += 0.004 * scanDir;
    if (scanY >= 1) { scanY = 1; scanDir = -1; }
    if (scanY <= 0) { scanY = 0; scanDir = 1; frame = 0; }

    drawDoc(doc1X, docY, docW, docH, 'Эталон (шаблон)', true);
    drawDoc(doc2X, docY, docW, docH, 'Версия контрагента', false);
    drawScanBeam(doc1X, docY, docW, docH);

    if (frame > 80) {
      const riskClauses = clauses.filter(c => c.risk);
      riskClauses.forEach((cl, i) => {
        const y1 = docY + 42 + (docH - 52) * cl.y + 4;
        const y2 = y1;
        const alpha = Math.min(1, (frame - 80 - i * 15) / 25);
        drawConnector(doc1X + docW - 10, y1, doc2X + 14, y2, alpha);
      });
    }

    riskBadges.forEach(b => drawBadge(b, doc2X, docY, docW, docH));

    const lensX = doc1X + docW + 20;
    const lensY = docY + scanY * (docH - 28) + 14;
    drawAiLens(lensX, lensY);

    ctx.fillStyle = C.label;
    ctx.font = '500 10px Inter, system-ui, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('diff по разделам · приоритет риска', cw / 2, ch - 8);

    requestAnimationFrame(loop);
  }

  window.addEventListener('resize', resize);
  resize();
  requestAnimationFrame(loop);
})();
</script>
</section>
      </div>


<div class="ym-cta-block ym-cta-block--primary" id="cta-proverka">
  <div class="ym-cta-block__icon" aria-hidden="true">📄</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Бесплатная проверка 3 договоров</p>
    <p class="ym-cta-block__sub">Загрузите анонимизированные контракты — за 48 часов получите риск-отчёт: отклонения от шаблона, штрафы, сроки и рекомендации. Без обязательств по внедрению.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>

    </div>
  </section>

  <section class="aad-section" id="vnedrenie">
    <div class="aad-cnt">
      <div class="aad-sh aad-left">
        <span class="aad-eyebrow">Проект под ключ</span>
        <h2>Внедрение AI-анализа договоров под ключ: этапы от аудита до запуска</h2>
        <p>Nero Network — интегратор, а не вендор коробочного SaaS. Типовой срок: пилот — 2–6 недель, production — 1–2 месяца.</p>
      </div>
      <div class="aad-timeline nero-ai-reveal">
        <div class="aad-tl-item">
          <div class="aad-tl-dot"></div>
          <h3>Этап 1 — диагностика (2–3 дня)</h3>
          <p>Карта типов договоров, источники документов, 3–5 корпоративных шаблонов, чек-лист рисков, требования ИБ. На выходе — ТЗ и смета в коридоре 200 тыс.–1,5 млн ₽.</p>
        </div>
        <div class="aad-tl-item">
          <div class="aad-tl-dot"></div>
          <h3>Этап 2 — база знаний (3–5 дней)</h3>
          <p>Загрузка шаблонов, регламентов, «красных флагов» в RAG-индекс. Правила извлечения: сроки, штрафы, автопролонгация, юрисдикция, лимит ответственности.</p>
        </div>
        <div class="aad-tl-item">
          <div class="aad-tl-dot"></div>
          <h3>Этап 3 — AI-движок (5–10 дней)</h3>
          <p>OCR → чанкинг → анализ LLM (YandexGPT / GigaChat / Claude в разрешённом контуре) + детерминированные проверки по ГК РФ. Гибрид правил и LLM точнее «голого GPT».</p>
        </div>
        <div class="aad-tl-item">
          <div class="aad-tl-dot"></div>
          <h3>Этап 4 — интеграции (5–15 дней)</h3>
          <p>Вход из email, формы, Telegram-бота; выход в Bitrix24, amoCRM, 1С:Документооборот, Directum. Уведомления в мессенджеры.</p>
        </div>
        <div class="aad-tl-item">
          <div class="aad-tl-dot"></div>
          <h3>Этап 5 — обучение и HITL (3–5 дней)</h3>
          <p>Юристы проверяют 10–20 договоров параллельно с AI, калибруют чек-лист, настраивают SLA на финальное решение.</p>
        </div>
      </div>

<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понять AI до старта пилота?</p>
    <p class="ym-cta-block__sub">Перед внедрением AI-анализа договоров полезно разобраться в RAG, промптах и human-in-the-loop — это ускоряет согласование чек-листов с юристами и закупками. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
  </div>
</aside>

      <div class="aad-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Запуск в прод: SLA, мониторинг качества и доработки</h3>
        <p>После пилота — дашборд: среднее время review, топ-риски, узкие места в согласовании. Чек-листы обновляются при изменении законодательства.</p>
        <p style="margin-top:16px;"><strong>Коротко: 7 шагов пайплайна Nero Network</strong></p>
        <div class="aad-steps">
          <div class="aad-step"><div><strong>Загрузка договора</strong><span>из СЭД/CRM или вручную</span></div></div>
          <div class="aad-step"><div><strong>Классификация типа</strong><span>поставка, аренда, NDA и др.</span></div></div>
          <div class="aad-step"><div><strong>OCR и парсинг</strong><span>разбиение на разделы</span></div></div>
          <div class="aad-step"><div><strong>AI-анализ + diff</strong><span>сравнение с шаблоном</span></div></div>
          <div class="aad-step"><div><strong>Риск-отчёт</strong><span>пункт / риск / рекомендация</span></div></div>
          <div class="aad-step"><div><strong>Задача юристу</strong><span>приоритет по уровню риска</span></div></div>
          <div class="aad-step"><div><strong>Финальное решение</strong><span>правки и подпись — за человеком</span></div></div>
        </div>
      </div>
    </div>
  </section>

  <section class="aad-section aad-section-alt" id="dlya-kogo">
    <div class="aad-cnt">
      <div class="aad-sh">
        <span class="aad-eyebrow">Аудитория</span>
        <h2>Для кого подходит AI-анализ договоров</h2>
      </div>
      <div class="aad-grid-4 nero-ai-reveal">
        <div class="aad-card"><h3>In-house legal</h3><p>Единый стандарт проверки между филиалами. Fplus: до 2000 человеко-дней в год при ~8000 договоров.</p></div>
        <div class="aad-card nero-ai-delay-1"><h3>Закупки и продажи</h3><p>Сводка рисков простым языком до передачи юристу — меньше «сюрпризов» на согласовании.</p></div>
        <div class="aad-card nero-ai-delay-2"><h3>Девелопмент и проекты</h3><p>Портфельный review: сравнение условий между объектами, контроль штрафов по портфелю.</p></div>
        <div class="aad-card"><h3>МСБ: когда окупается</h3><p>Порог — от 20 договоров в месяц. При 50–200 договорах кастомная настройка окупается за 3–6 месяцев.</p></div>
      </div>
    </div>
  </section>

  <section class="aad-section" id="integracii">
    <div class="aad-cnt">
      <div class="aad-sh aad-left">
        <span class="aad-eyebrow">Инфраструктура</span>
        <h2>Интеграции: CRM, ЭДО, корпоративное хранилище и 1С</h2>
        <p>AI-анализ договоров работает в связке с вашей инфраструктурой — не как изолированный инструмент.</p>
      </div>
      <div class="aad-grid-2 nero-ai-reveal">
        <div class="aad-card">
          <h3>Загрузка из ЭДО и общих папок</h3>
          <p>Directum RX, 1С:Документооборот, Тензор, корпоративный диск, email. Directum RX Intelligence встраивает ИИ-проверку в маршрут согласования.</p>
        </div>
        <div class="aad-card nero-ai-delay-1">
          <h3>Связка с CRM и ERP</h3>
          <p>Bitrix24, amoCRM: карточка сделки, статус review, SLA. Точечная связка с 1С — реквизиты и сумма в карточку договора.</p>
          <!-- INTERNAL-LINKS:INSERT -->
        </div>
      </div>
      <div class="aad-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aad-table">
          <thead><tr><th>Контур</th><th>Когда подходит</th><th>Примеры</th></tr></thead>
          <tbody>
            <tr><td>Облако РФ</td><td>Стандартный B2B, 152-ФЗ</td><td>YandexGPT, GigaChat</td></tr>
            <tr><td>Гибрид</td><td>Чувствительные данные + облачный AI</td><td>Анонимайзер (кейс Fplus)</td></tr>
            <tr><td>On-premise</td><td>Запрет внешних API</td><td>Qwen-class LLM, ContractGuard, Рег.облако/Raft</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="max-width:820px;margin:20px auto 0;font-size:14.5px;">В кейсе Рег.облако и Raft: open-source LLM (Qwen3-30B) в закрытом контуре — precision 99,7%, recall 93,1%.</p>
    </div>
  </section>

  <section class="aad-section aad-section-alt" id="ceny">
    <div class="aad-cnt">
      <div class="aad-sh">
        <span class="aad-eyebrow">Бюджет и ROI</span>
        <h2>Сколько стоит внедрение AI для анализа договоров</h2>
      </div>
      <div class="aad-grid-2 nero-ai-reveal">
        <div class="aad-card">
          <h3>От чего зависит стоимость</h3>
          <ol style="padding-left:20px;color:var(--aad-muted);font-size:14.5px;line-height:1.7;">
            <li>Диагностика и ТЗ</li>
            <li>RAG-база знаний</li>
            <li>AI-движок и детекторы рисков</li>
            <li>Интеграции CRM, СЭД, 1С</li>
            <li>ИБ-контур: on-premise, анонимизация</li>
          </ol>
        </div>
        <div class="aad-card nero-ai-delay-1">
          <h3>Ориентиры по срокам и бюджету</h3>
          <div class="aad-table-wrap" style="margin:0;border:none;">
            <table class="aad-table">
              <tbody>
                <tr><td>Бюджет под ключ</td><td><strong>200 тыс.–1,5 млн ₽</strong></td></tr>
                <tr><td>Пилот</td><td>2–6 недель</td></tr>
                <tr><td>Production</td><td>1–2 месяца</td></tr>
                <tr><td>Лид-магнит «3 договора»</td><td>Бесплатно, 48 часов</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="aad-card nero-ai-reveal" style="margin-top:28px;">
        <h3>ROI: экономия часов юристов</h3>
        <ul>
          <li>Fplus: подготовка типовых договоров — с 15 мин до 2,5 мин</li>
          <li>Яндекс Нейроюрист: работа с договорами быстрее в 1,5×</li>
          <li>Ironclad: первичный review — с 40 мин до ~2 мин</li>
          <li>Bloomberg Law: ~22 мин с AI вместо ~92 мин вручную</li>
        </ul>
        <p style="margin-top:12px;">При ставке in-house юриста 5 000–15 000 ₽/час экономия 10–20 часов в месяц уже окупает пилот.</p>
      </div>
    </div>
  </section>

  <section class="aad-section" id="keisy">
    <div class="aad-cnt">
      <div class="aad-sh">
        <span class="aad-eyebrow">Практика</span>
        <h2>Кейсы и примеры внедрения AI-анализа договоров</h2>
      </div>
      <div class="aad-grid-2 nero-ai-reveal">
        <div class="aad-card">
          <h3>Закупки и поставщики</h3>
          <p>30–50 договоров поставки в месяц. AI сравнивает с эталоном, подсвечивает отклонения, формирует протокол разногласий. Review: с 2–4 часов до 15–30 минут.</p>
        </div>
        <div class="aad-card nero-ai-delay-1">
          <h3>Продажи и клиентские договоры</h3>
          <p>AI проверяет оплату, сроки, ограничение ответственности, IP. Юрист получает только договоры с риск-скором выше порога.</p>
        </div>
      </div>
      <div class="aad-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aad-table">
          <thead><tr><th>Кейс</th><th>Метрика</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>Fplus + Doczilla</td><td>Время подготовки</td><td>15 мин → 2,5 мин</td></tr>
            <tr><td>Fplus + Doczilla</td><td>Ошибки</td><td>−50–60%</td></tr>
            <tr><td>Яндекс Нейроюрист</td><td>Скорость</td><td>×1,5</td></tr>
            <tr><td>Рег.облако/Raft</td><td>Точность полей</td><td>precision 99,7%</td></tr>
            <tr><td>Ironclad</td><td>Первичный review</td><td>40 мин → ~2 мин</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aad-section aad-section-alt" id="kak-vnedrit">
    <div class="aad-cnt">
      <div class="aad-sh aad-left">
        <span class="aad-eyebrow">Выбор подхода</span>
        <h2>Как внедрить AI-анализ договоров: под ключ или своими силами</h2>
      </div>
      <div class="aad-table-wrap nero-ai-reveal">
        <table class="aad-table">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th><th>Кому подходит</th></tr></thead>
          <tbody>
            <tr><td>SaaS (Нейроюрист, noroots)</td><td>Быстрый старт</td><td>Не ваши шаблоны</td><td>5–20 договоров/мес</td></tr>
            <tr><td>Коробка (от 70 000 ₽)</td><td>Дешёвый вход</td><td>Без настройки</td><td>Пилот, микробизнес</td></tr>
            <tr><td>Внедрение под ключ (Nero)</td><td>Ваши шаблоны, CRM/СЭД, HITL</td><td>Бюджет 200 тыс.+</td><td>20+ договоров/мес</td></tr>
          </tbody>
        </table>
      </div>
      <div class="aad-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="aad-card">
          <h3>Можно ли без программиста</h3>
          <p>Да — при внедрении под ключ. Nero Network настраивает интеграции, чек-листы и интерфейс. Команда работает через email, Telegram-бот, CRM.</p>
        </div>
        <div class="aad-card nero-ai-delay-1">
          <h3>RAG и корпоративный контекст в 2026</h3>
          <p>RAG — стандарт для enterprise legal AI. Рынок RAG: $2,33 млрд (2025) → $9,86 млрд к 2030. Nero строит надёжный инженерный контур с HITL, а не «волшебную модель».</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aad-section" id="faq">
    <div class="aad-cnt">
      <div class="aad-sh">
        <span class="aad-eyebrow">FAQ</span>
        <h2>Частые вопросы об AI-анализе договоров</h2>
      </div>
      <div class="aad-faq nero-ai-reveal">
        <div class="aad-faq-item" id="faq-zadachi">
          <div class="aad-faq-q" tabindex="0" role="button" aria-expanded="false">Какие задачи решает AI-анализ договоров?</div>
          <div class="aad-faq-a"><p>Первичный review, извлечение условий, сравнение с шаблоном, подсветка рисков, черновик протокола разногласий, сводка для не-юристов. Не заменяет переговоры и финальное решение.</p></div>
        </div>
        <div class="aad-faq-item" id="faq-stoimost">
          <div class="aad-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит внедрение?</div>
          <div class="aad-faq-a"><p>Ориентир: 200 тыс.–1,5 млн ₽ в зависимости от числа типов договоров, интеграций и контура размещения. Бесплатная проверка 3 договоров — без обязательств.</p></div>
        </div>
        <div class="aad-faq-item" id="faq-tochnost">
          <div class="aad-faq-q" tabindex="0" role="button" aria-expanded="false">Как обеспечивается точность и ответственность за ошибки AI?</div>
          <div class="aad-faq-a"><p>Гибрид LLM + детерминированных правил. Human-in-the-loop на каждом договоре. Ответственность за подпись — за юристом.</p></div>
        </div>
        <div class="aad-faq-item" id="faq-msb">
          <div class="aad-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли решение для малого бизнеса?</div>
          <div class="aad-faq-a"><p>При потоке от 20 договоров в месяц — да. При меньшем объёме — начните с бесплатной проверки 3 договоров или готового SaaS.</p></div>
        </div>
        <div class="aad-faq-item" id="faq-crm">
          <div class="aad-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли интеграция с CRM?</div>
          <div class="aad-faq-a"><p>Не обязательна для старта, но критична для масштабирования. Nero Network интегрирует с Bitrix24, amoCRM, 1С, Directum.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="aad-section aad-section-alt" id="besplatnaya-proverka">
    <div class="aad-cnt">
      <div class="aad-sh aad-left">
        <span class="aad-eyebrow">Лид-магнит</span>
        <h2>Бесплатная проверка 3 договоров — оцените риски до внедрения</h2>
        <p>Не демо-звонок, а конкретный deliverable: риск-отчёт по вашим документам.</p>
      </div>
      <div class="aad-grid-2 nero-ai-reveal">
        <div class="aad-card">
          <h3>Что входит в бесплатную проверку</h3>
          <ol style="padding-left:20px;color:var(--aad-muted);font-size:14.5px;line-height:1.75;">
            <li>Вы загружаете 3 анонимизированных договора</li>
            <li>AI-анализ по типовому чек-листу</li>
            <li>За 48 часов — отчёт: отклонения, риски, рекомендации</li>
            <li>На созвоне показываем, что автоматизируется при полном внедрении</li>
          </ol>
        </div>
        <div class="aad-card nero-ai-delay-1">
          <h3>Как перейти к полному внедрению</h3>
          <p>После проверки — диагностика (2–3 дня), смета, пилот на 2–6 недель. CTA: <strong>Оценить договоры</strong> — начнём с трёх ваших контрактов.</p>
          <p style="margin-top:16px;"><strong>Итог.</strong> AI для анализа договоров — измеримая экономия времени юристов на первичном review. Nero Network внедряет проверяемый контур с human-in-the-loop: ваши шаблоны, ваши интеграции, ваши правила. Первый шаг — бесплатно.</p>
        </div>
      </div>

<div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы внедрить AI-анализ договоров под ключ?</p>
    <p class="ym-cta-block__sub">Первый шаг — бесплатная проверка 3 договоров. Покажем риски на ваших контрактах, ориентир сметы пилота и ROI на потоке 20+ договоров в месяц.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>

    </div>
  </section>

</div>

<!-- SCHEMA-MARKUP:INSERT -->

</main>
<script>
/**
 * aad-hero-engine — «Юридическая диспетчерская clause-review»
 * Мир: орбита страниц договора → diff-стол → risk-score → печать юриста (HITL)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aad-hero-canvas");
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
    pageWhite: "#f8fafc",
    pageAmber: "#fef3c7",
    pageRose: "#ffe4e6",
    vault: "#1e293b",
    indigo: "#6366f1",
    violet: "#8b5cf6",
    risk: "#ef4444",
    warn: "#f59e0b",
    ok: "#22c55e",
    diffLeft: "rgba(99,102,241,0.12)",
    diffRight: "rgba(239,68,68,0.10)",
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

  function drawPage(ctx, x, y, w, h, color, lines) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    ctx.strokeStyle = "rgba(148,163,184,0.45)";
    ctx.lineWidth = 0.7;
    for (var i = 0; i < (lines || 3); i++) {
      ctx.beginPath();
      ctx.moveTo(x - w / 2 + 3, y - h / 2 + 5 + i * 4);
      ctx.lineTo(x + w / 2 - 3, y - h / 2 + 5 + i * 4);
      ctx.stroke();
    }
  }

  /* Полка корпоративных шаблонов (RAG) */
  function TemplateRagVault() {}
  TemplateRagVault.prototype.draw = function (ctx) {
    drawRR(ctx, -168, -72, 34, 78, 5, "rgba(30,41,59,0.65)", C.outline);
    var labels = ["NDA", "Пост", "Арен"];
    for (var i = 0; i < 3; i++) {
      drawPage(ctx, -151, -58 + i * 6, 14, 18, i === 1 ? C.pageAmber : C.pageWhite, 2);
    }
    ctx.fillStyle = C.indigo;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("RAG шаблоны", -166, -78);
  };

  /* Орбита входящих страниц — вместо Conveyor */
  function ContractPageOrbit() {
    this.pages = [
      { phase: 0, color: C.pageWhite, label: "§1" },
      { phase: 80, color: C.pageAmber, label: "§4" },
      { phase: 160, color: C.pageRose, label: "§7" }
    ];
  }
  ContractPageOrbit.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    ctx.strokeStyle = "rgba(99,102,241,0.22)";
    ctx.lineWidth = 1;
    ctx.setLineDash([4, 6]);
    ctx.beginPath();
    ctx.ellipse(0, -38, 95, 42, 0, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);

    this.pages.forEach(function (pg) {
      var t = ((frame * 0.55 + pg.phase) % 140) / 140;
      var ang = -Math.PI * 0.85 + t * Math.PI * 1.1;
      var ox = Math.cos(ang) * 95;
      var oy = -38 + Math.sin(ang) * 42;
      if (t < 0.88) {
        drawPage(ctx, ox, oy, 14, 18, pg.color, 3);
        if (t > 0.55) {
          ctx.fillStyle = C.outline;
          ctx.font = "bold 5px Inter,sans-serif";
          ctx.textAlign = "center";
          ctx.fillText(pg.label, ox, oy + 2);
        }
      }
    });
  };

  /* Центральный стол сравнения версий — вместо WebsiteTerminal */
  function ClauseDiffWorkbench() {
    this.highlightRow = 0;
  }
  ClauseDiffWorkbench.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, -55, -62, 130, 118, 10, C.vault, C.outline);

    /* Шапка diff */
    drawRR(ctx, -48, -55, 58, 14, [5, 0, 0, 0], "rgba(99,102,241,0.35)", null);
    drawRR(ctx, 12, -55, 58, 14, [0, 5, 0, 0], "rgba(239,68,68,0.28)", null);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Ваш шаблон", -19, -46);
    ctx.fillText("Контрагент", 41, -46);

    /* Строки договора */
    for (var r = 0; r < 5; r++) {
      var ly = -38 + r * 14;
      drawRR(ctx, -46, ly, 52, 10, 2, "rgba(255,255,255,0.07)", null);
      drawRR(ctx, 14, ly, 52, 10, 2, "rgba(255,255,255,0.07)", null);

      if (prg > 55 + r * 8) {
        ctx.fillStyle = "#cbd5e1";
        ctx.fillRect(-42, ly + 3, 30 + r * 4, 3);
        ctx.fillRect(18, ly + 3, 26 + (r % 2) * 8, 3);
      }

      /* Подсветка отклонений фаза 2 */
      if (prg >= 70 && prg < 165 && (r === 1 || r === 3)) {
        var pulse = 0.5 + Math.sin(frame * 0.15 + r) * 0.3;
        ctx.globalAlpha = pulse;
        drawRR(ctx, 12, ly - 1, 56, 12, 2, C.diffRight, C.risk);
        ctx.globalAlpha = 1;
        if (r === 1 && prg > 85) {
          ctx.fillStyle = C.risk;
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.textAlign = "left";
          ctx.fillText("штрафы ↑", 16, ly + 8);
        }
        if (r === 3 && prg > 105) {
          ctx.fillStyle = C.warn;
          ctx.fillText("автопролонгация", 16, ly + 8);
        }
      }
    }

    /* Risk-score панель фаза 3 */
    if (prg >= 155) {
      var scorePrg = Math.min(1, (prg - 155) / 25);
      drawRR(ctx, -20, 38, 70, 22, 5, "rgba(239,68,68,0.18)", C.risk);
      ctx.fillStyle = "#fecaca";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.globalAlpha = scorePrg;
      ctx.fillText("Risk-score: 78", 15, 52);
      ctx.globalAlpha = 1;
    }
  };

  /* Красные флажки на клаузах */
  function RiskFlagPin() {}
  RiskFlagPin.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 80 || prg > 175) return;
    var flags = [{ x: 72, y: -24 }, { x: 72, y: 2 }];
    flags.forEach(function (f, i) {
      if (prg > 88 + i * 18) {
        ctx.fillStyle = C.risk;
        ctx.beginPath();
        ctx.moveTo(f.x, f.y);
        ctx.lineTo(f.x + 10, f.y - 4);
        ctx.lineTo(f.x, f.y - 8);
        ctx.closePath();
        ctx.fill();
        ctx.strokeStyle = C.outline;
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(f.x, f.y);
        ctx.lineTo(f.x, f.y + 10);
        ctx.stroke();
      }
    });
  };

  /* Лоток протокола разногласий */
  function ProtocolDraftTray() {
    this.slideX = 120;
  }
  ProtocolDraftTray.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, 108, 8, 42, 52, 5, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Протокол", 129, 18);

    if (prg >= 195) {
      this.slideX = 120 - Math.min(1, (prg - 195) / 20) * 55;
      drawPage(ctx, this.slideX, 32, 18, 22, C.pageAmber, 4);
      ctx.fillStyle = C.warn;
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.fillText("diff", this.slideX, 34);
    }
  };

  /* Печать юриста HITL — финал цикла */
  function HitlApprovalStamp() {}
  HitlApprovalStamp.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 210) return;
    var stampPrg = Math.min(1, (prg - 210) / 18);
    ctx.save();
    ctx.translate(8, 12);
    ctx.rotate(-0.12 * stampPrg);
    ctx.globalAlpha = stampPrg;
    ctx.strokeStyle = "rgba(34,197,94,0.9)";
    ctx.lineWidth = 2;
    ctx.strokeRect(-32, -14, 64, 28);
    ctx.fillStyle = "rgba(34,197,94,0.85)";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ОДОБРЕНО ЮРИСТОМ", 0, 4);
    ctx.restore();
  };

  /* Волна сканирования по diff-столу */
  function ClauseScanWave() {
    this.x = -50;
  }
  ClauseScanWave.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 58 || prg > 148) return;
    var scanT = (prg - 58) / 90;
    this.x = -48 + scanT * 108;
    ctx.save();
    ctx.globalAlpha = 0.25 + Math.sin(frame * 0.2) * 0.12;
    ctx.fillStyle = "rgba(99,102,241,0.55)";
    ctx.fillRect(this.x, -56, 3, 108);
    ctx.strokeStyle = C.indigo;
    ctx.lineWidth = 1.2;
    ctx.strokeRect(this.x - 8, -50, 20, 96);
    ctx.restore();
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

    /* Агенты подходят к diff-столу снизу по дуге */
    var targets = {
      "1_architect": { x: -90, y: 52 },
      "2_seo": { x: -45, y: 58 },
      "3_coder": { x: 0, y: 60 },
      "4_designer": { x: 45, y: 58 },
      "5_deployer": { x: 90, y: 52 }
    };
    var tgt = targets[this.role] || { x: 0, y: 55 };

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
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new TemplateRagVault());
  entities.push(new ContractPageOrbit());
  entities.push(new ClauseDiffWorkbench());
  entities.push(new ClauseScanWave());
  entities.push(new RiskFlagPin());
  entities.push(new ProtocolDraftTray());
  entities.push(new HitlApprovalStamp());
  entities.push(new Agent(-120, 82, C.agentYellow, "1_architect", 18, [
    "Чек-лист рисков готов", "RAG из 5 шаблонов", "Правила извлечения §"
  ]));
  entities.push(new Agent(-60, 88, C.agentGreen, "2_seo", 62, [
    "Клауза «штрафы» ≠ эталон", "Автопролонгация 30 дн.", "Подсудность: не Москва"
  ]));
  entities.push(new Agent(0, 90, C.agentBlue, "3_coder", 108, [
    "Chunking по разделам", "LLM + regex ГК РФ", "Diff построчно готов"
  ]));
  entities.push(new Agent(60, 88, C.agentPink, "4_designer", 154, [
    "Risk-score UI", "Сводка для закупок", "Красная подсветка клауз"
  ]));
  entities.push(new Agent(120, 82, C.agentPurple, "5_deployer", 200, [
    "Задача юристу в СЭД", "HITL на production", "Интеграция Directum"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 230, maxLife: life || 230 });
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
    if (prg >= 16 && prg < 16.05) createBubble(-100, -30, "1. Страница на орбиту");
    if (prg >= 64 && prg < 64.05) createBubble(-20, -50, "2. Diff с шаблоном");
    if (prg >= 112 && prg < 112.05) createBubble(30, -10, "3. Флаг: штрафы");
    if (prg >= 162 && prg < 162.05) createBubble(10, 45, "4. Risk-score 78");
    if (prg >= 215 && prg < 215.05) createBubble(0, 65, "5. Печать юриста");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      drawRR(ctx, b.x - (ctx.measureText(b.text).width + 14) / 2, b.y - 22, ctx.measureText(b.text).width + 14, 18, 5, C.bubbleBg, C.indigo);
      ctx.fillStyle = C.bubbleText;
      ctx.globalAlpha = alpha;
      ctx.fillText(b.text, b.x, b.y - 11);
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
  document.querySelectorAll('.aad-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aad-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aad-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aad-faq-q');
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
