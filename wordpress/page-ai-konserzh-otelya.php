<?php
/**
 * Template Name: AI-консьерж для отеля: внедрение под ключ
 * Description: SEO-лендинг — AI-консьерж для отеля: бронирование, FAQ, upsell в мессенджерах и на сайте.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-консьерж для отеля: внедрение и интеграция под ключ';
$page_seo_description = 'Внедрим AI-консьержа для отеля: ответы гостям 24/7 в мессенджерах и на сайте, бронь номеров и допродажи SPA и трансфера. Демо чата и аудит — бесплатно.';

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
    ['label' => 'Боль', 'href' => '#bole'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
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
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#etapy';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}
?>

<?php nero_ai_echo_theme_styles(); ?>

<style>

body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header{display:none!important;}
body.nero-ai-landing{padding-top:0!important;}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,
.entry-header,.page-title-section{display:none!important;}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important;}

/* VKO HERO — переопределения под AI-консьерж отеля (тёмный nero-ai shell) */
.vko-hero-concierge.nero-ai-hero {
  position: relative;
  overflow: hidden;
}
.vko-hero-concierge .nero-ai-hero-grid {
  align-items: center;
}
.vko-hero-concierge .nero-ai-hero-copy h1 {
  font-size: clamp(32px, 4.8vw, 58px);
  line-height: 1.06;
  letter-spacing: -0.03em;
}
.vko-hero-concierge .nero-ai-hero-lead {
  max-width: 540px;
  font-size: clamp(15px, 1.7vw, 18px);
  line-height: 1.65;
  color: rgba(226, 232, 240, 0.82);
}
.vko-hero-concierge .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 22px 0 28px;
  padding: 0;
  list-style: none;
}
.vko-hero-concierge .nero-ai-badge {
  padding: 7px 14px;
  border-radius: 999px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  background: rgba(121, 242, 255, 0.08);
  color: #c7d9f5;
  font-size: 12px;
  font-weight: 700;
}
.vko-hero-concierge .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}
.vko-hero-concierge .nero-ai-dashboard {
  position: relative;
}
.vko-hero-concierge .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 8px;
  margin-bottom: 12px;
}
.vko-hero-concierge .nero-ai-metric {
  padding: 10px 8px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.055);
  text-align: center;
}
.vko-hero-concierge .nero-ai-metric span {
  display: block;
  color: #9aa8bd;
  font-size: 10px;
  font-weight: 700;
  line-height: 1.3;
}
.vko-hero-concierge .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  color: #fff;
  font-size: 20px;
  line-height: 1;
  letter-spacing: -0.03em;
}
.vko-hero-concierge .nero-ai-metric small {
  display: block;
  margin-top: 3px;
  color: #7c8da8;
  font-size: 10px;
}
.vko-hero-concierge .vko-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 0 0 12px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 50% 35%, rgba(121, 242, 255, 0.1), rgba(6, 10, 24, 0.92) 72%);
}
.vko-hero-concierge #vko-chat-demo-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vko-hero-concierge .nero-ai-task-stream {
  display: grid;
  gap: 8px;
}
.vko-hero-concierge .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.04);
}
.vko-hero-concierge .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121, 242, 255, 0.12);
  color: #79f2ff;
  font-size: 11px;
  font-weight: 800;
}
.vko-hero-concierge .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vko-hero-concierge .nero-ai-task span {
  color: #9aa8bd;
  font-size: 11px;
}
.vko-hero-concierge .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34, 197, 94, 0.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vko-hero-concierge .nero-ai-status--violet {
  background: rgba(139, 92, 246, 0.14);
  color: #ddd6fe;
}
.vko-hero-concierge .nero-ai-status--cyan {
  background: rgba(121, 242, 255, 0.12);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .vko-hero-concierge .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vko-hero-concierge .nero-ai-metrics-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 520px) {
  .vko-hero-concierge .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
}


/* VKO INTRO — второй блок после hero */
.vko-hero-concierge.nero-ai-hero{min-height:100vh;min-height:100dvh;position:relative;}
.vko-intro{padding:clamp(40px,5vw,72px) 0 clamp(36px,4.5vw,56px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vko-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.vko-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.vko-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vko-accent),var(--vko-violet));}
.vko-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vko-muted);margin-bottom:1em;}
.vko-intro-text p:last-child{margin-bottom:0;color:var(--vko-soft);}
.vko-intro-deco{display:flex;flex-direction:column;gap:12px;}
.vko-intro-terminal{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:16px;overflow:hidden;box-shadow:0 16px 48px rgba(0,0,0,.28);}
.vko-intro-terminal-head{padding:10px 14px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--vko-accent);border-bottom:1px solid rgba(255,255,255,.08);background:rgba(0,0,0,.2);}
.vko-intro-terminal-body{padding:16px;display:flex;flex-wrap:wrap;gap:8px;}
.vko-chip{display:inline-flex;align-items:center;gap:6px;padding:8px 12px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);border:1px solid rgba(121,242,255,.22);color:var(--vko-soft);}
.vko-chip strong{color:#fff;font-size:14px;}
.vko-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vko-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.vko-toc a,.ym-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;font-weight:600;color:var(--vko-muted);text-decoration:none!important;transition:border-color .2s,color .2s,background .2s;}
.vko-toc a:hover,.ym-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vko-accent);background:rgba(121,242,255,.08);}
@media(max-width:900px){.vko-intro-grid{grid-template-columns:1fr;gap:36px;}}

/* === VKO CONTENT ROOT (тёмные секции) === */
.vko-content{
  --vko-bg:#050711;--vko-bg2:#080b17;
  --vko-text:#e6edf7;--vko-muted:#9aa8bd;--vko-soft:#c7d2e5;--vko-heading:#fff;
  --vko-border:rgba(255,255,255,.10);
  --vko-accent:#79f2ff;--vko-violet:#8b5cf6;--vko-green:#22c55e;
  --vko-btn-from:#2563eb;--vko-btn-to:#7c3aed;
  --vko-r:18px;--vko-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vko-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vko-content *,.vko-content *::before,.vko-content *::after{box-sizing:border-box;}
.vko-content p{color:var(--vko-muted);line-height:1.72;margin:0 0 1em;}
.vko-content p:last-child{margin-bottom:0;}
.vko-content h2,.vko-content h3,.vko-content h4{color:var(--vko-heading);letter-spacing:-.04em;margin:0 0 .65em;}
.vko-content strong{color:var(--vko-soft);}
.vko-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vko-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vko-muted);font-size:14.5px;line-height:1.65;}
.vko-content ul li::before{content:'›';position:absolute;left:0;color:var(--vko-accent);font-weight:700;}
.vko-cnt{width:min(var(--vko-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.vko-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vko-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.vko-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.vko-sh.vko-left{margin-left:0;text-align:left;}
.vko-sh h2{font-size:clamp(26px,4vw,46px);line-height:1.08;margin-bottom:14px;}
.vko-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vko-sh.vko-left p{margin-left:0;}
.vko-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vko-accent);margin-bottom:14px;}
.vko-gt{background:linear-gradient(92deg,#fff 0%,var(--vko-accent) 44%,var(--vko-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.vko-grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:24px;}
@media(max-width:768px){.vko-grid-2{grid-template-columns:1fr;}}
.vko-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--vko-r);padding:28px;}
.vko-card h3{font-size:18px;margin-bottom:12px;}
.vko-kpi-row{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:32px;}
@media(max-width:768px){.vko-kpi-row{grid-template-columns:1fr;}}
.vko-kpi{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:20px;text-align:center;}
.vko-kpi .kv{font-size:clamp(28px,4vw,40px);font-weight:900;color:var(--vko-accent);line-height:1;}
.vko-kpi .kl{font-size:13px;color:var(--vko-muted);margin-top:8px;line-height:1.4;}
.vko-table-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:12px;border:1px solid rgba(255,255,255,.1);}
.vko-table{width:100%;border-collapse:collapse;font-size:14px;}
.vko-table th{padding:12px 16px;text-align:left;background:rgba(255,255,255,.06);color:var(--vko-muted);font-weight:700;border-bottom:1px solid rgba(255,255,255,.1);}
.vko-table td{padding:12px 16px;color:var(--vko-text);border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;}
.vko-table tr:last-child td{border-bottom:none;}
.vko-callout{margin-top:24px;padding:20px 24px;border-radius:14px;background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.2);}
.vko-callout h4{margin:0 0 10px;font-size:16px;color:var(--vko-accent);}
.vko-channels{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:14px;margin-top:28px;}
.vko-channel-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:18px;text-align:center;}
.vko-channel-card .ico{font-size:28px;margin-bottom:8px;}
.vko-channel-card strong{display:block;font-size:14px;color:var(--vko-heading);margin-bottom:4px;}
.vko-channel-card span{font-size:12px;color:var(--vko-muted);}
.vko-dialog-cards{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;margin-top:28px;}
.vko-dialog{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:20px;}
.vko-dialog .who{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--vko-accent);margin-bottom:6px;}
.vko-dialog p{font-size:14px;margin:0;line-height:1.55;}
.vko-timeline{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:32px;}
@media(max-width:768px){.vko-timeline{grid-template-columns:1fr;}}
.vko-step{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:24px;position:relative;}
.vko-step-num{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--vko-btn-from),var(--vko-btn-to));color:#fff;font-weight:800;font-size:14px;margin-bottom:12px;}
.vko-flow{display:flex;flex-wrap:wrap;align-items:center;gap:8px;margin-top:24px;padding:20px;background:rgba(255,255,255,.04);border-radius:14px;border:1px solid rgba(255,255,255,.08);}
.vko-flow span{padding:8px 14px;background:rgba(255,255,255,.06);border-radius:999px;font-size:13px;font-weight:600;color:var(--vko-soft);}
.vko-flow .arr{color:var(--vko-accent);font-weight:700;}
.vko-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vko-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.vko-faq-q{padding:18px 22px;font-size:16px;font-weight:700;color:var(--vko-heading);cursor:pointer;display:flex;justify-content:space-between;gap:12px;user-select:none;}
.vko-faq-q::after{content:'▾';color:var(--vko-accent);transition:transform .25s;}
.vko-faq-item.open .vko-faq-q::after{transform:rotate(180deg);}
.vko-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .35s ease,padding .25s;font-size:14.5px;color:var(--vko-muted);line-height:1.72;}
.vko-faq-item.open .vko-faq-a{max-height:500px;padding:0 22px 18px;}
.vko-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin:24px 0 0;padding:0;list-style:none;}
.vko-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vko-muted);}
.vko-cta-checklist li::before{content:'✓';color:var(--vko-green);font-weight:800;}
/* CTA blocks (Артур) */
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--vko-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vko-btn-from),var(--vko-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--vko-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--vko-accent)!important;text-decoration:underline;text-underline-offset:3px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* === БОРИС: светлый блок #ai-konserzh-otelya-boris-block === */
#ai-konserzh-otelya-boris-block.vkob-root{background:#f8fafc;padding:clamp(48px,6vw,80px) 0;border-top:1px solid #e2e8f0;border-bottom:1px solid #e2e8f0;}
#ai-konserzh-otelya-boris-block .vkob-cnt{width:min(1220px,calc(100% - 40px));margin:0 auto;}
#ai-konserzh-otelya-boris-block .vkob-card{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(320px,.9fr);gap:clamp(24px,4vw,40px);padding:clamp(24px,4vw,36px);background:#fff;border:1px solid #e2e8f0;border-radius:22px;box-shadow:0 20px 60px rgba(15,23,42,.08);}
@media(max-width:1023px){#ai-konserzh-otelya-boris-block .vkob-card{grid-template-columns:1fr;}}
#ai-konserzh-otelya-boris-block .vkob-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0ea5e9;margin-bottom:12px;}
#ai-konserzh-otelya-boris-block .vkob-ey::before{content:'';width:8px;height:8px;border-radius:50%;background:#22c55e;animation:vkobPulse 2s ease-in-out infinite;}
@keyframes vkobPulse{0%,100%{opacity:1;transform:scale(1);}50%{opacity:.5;transform:scale(.85);}}
#ai-konserzh-otelya-boris-block .vkob-h3{font-size:clamp(20px,2.5vw,26px);font-weight:800;color:#0f172a;line-height:1.2;margin:0 0 16px;}
#ai-konserzh-otelya-boris-block .vkob-ul{list-style:none;padding:0;margin:0 0 20px;}
#ai-konserzh-otelya-boris-block .vkob-ul li{display:flex;gap:12px;align-items:flex-start;font-size:14.5px;color:#475569;line-height:1.55;margin-bottom:10px;}
#ai-konserzh-otelya-boris-block .vkob-ic{flex-shrink:0;width:24px;height:24px;border-radius:8px;background:linear-gradient(135deg,#0ea5e9,#8b5cf6);color:#fff;font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center;}
#ai-konserzh-otelya-boris-block .vkob-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;}
#ai-konserzh-otelya-boris-block .vkob-pl{padding:6px 12px;border-radius:999px;font-size:12px;font-weight:700;}
#ai-konserzh-otelya-boris-block .vkob-pl-g{background:#dcfce7;color:#166534;}
#ai-konserzh-otelya-boris-block .vkob-pl-b{background:#e0f2fe;color:#075985;}
#ai-konserzh-otelya-boris-block .vkob-pl-v{background:#ede9fe;color:#5b21b6;}
#ai-konserzh-otelya-boris-block .vkob-foot{font-size:13px;color:#64748b;margin:0;font-style:italic;}
#ai-konserzh-otelya-boris-block .vkob-rgt{min-height:400px;border-radius:16px;background:linear-gradient(145deg,#f1f5f9,#e2e8f0);border:1px solid #cbd5e1;overflow:hidden;position:relative;}
@media(max-width:768px){#ai-konserzh-otelya-boris-block .vkob-rgt{min-height:360px;}}
#vko-inbox-orchestrator-canvas{display:block;width:100%;height:100%;min-height:400px;}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-konserzh-otelya-page" role="main" tabindex="-1">

<section class="nero-ai-hero vko-hero-concierge" id="hero" aria-labelledby="vko-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai консьерж отеля</p>
      <h1 id="vko-hero-title">AI-консьерж для отеля: <span class="nero-ai-gradient-text">бронирование, вопросы и допродажи</span></h1>
      <p class="nero-ai-hero-lead">Единый AI-агент отвечает гостям в мессенджерах и на сайте, помогает забронировать номер и предлагает допуслуги — без очереди у администратора</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">FAQ 24/7</li>
        <li class="nero-ai-badge">Бронь в мессенджере</li>
        <li class="nero-ai-badge">Upsell SPA</li>
        <li class="nero-ai-badge">Единый inbox</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#scenarii">Сценарии для гостя</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-консьерж отеля">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">демо диалога гостя · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-консьерж отеля</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid" aria-label="Ключевые метрики">
            <div class="nero-ai-metric">
              <span>время ответа</span>
              <strong>&lt;5 сек</strong>
              <small>первичный</small>
            </div>
            <div class="nero-ai-metric">
              <span>канала</span>
              <strong>4+</strong>
              <small>TG · MAX · WA · сайт</small>
            </div>
            <div class="nero-ai-metric">
              <span>режим</span>
              <strong>24/7</strong>
              <small>без ночной смены</small>
            </div>
            <div class="nero-ai-metric">
              <span>upsell</span>
              <strong>↑15–25%</strong>
              <small>персонализ.</small>
            </div>
          </div>

          <div class="vko-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vko-chat-demo-canvas" role="img" aria-label="Анимация: сообщения из мессенджеров стекаются в единый inbox, AI отвечает гостю и подтверждает бронь с upsell SPA"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий гостевых диалогов">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>«Есть номер на 15–17 марта?»</strong><span>Стандарт 12 500 ₽/ночь · 2 гостя</span></div>
              <span class="nero-ai-status">бронь</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">MAX</span>
              <div><strong>«Ранний заезд возможен?»</strong><span>Доплата +2 000 ₽ · бронь № 4821</span></div>
              <span class="nero-ai-status nero-ai-status--violet">upsell</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WEB</span>
              <div><strong>«Парковка есть?»</strong><span>FAQ · бесплатно для гостей</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">FAQ</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vko-content">

  <section class="vko-intro" id="intro" aria-label="Введение">
    <div class="vko-cnt">
      <div class="vko-intro-grid nero-ai-reveal">
        <div class="vko-intro-text">
          <span class="vko-eyebrow">AI-консьерж · отель</span>
          <p><strong>Коротко:</strong> AI-консьерж для отеля — виртуальный агент, который круглосуточно отвечает гостям в мессенджерах и на сайте, помогает забронировать номер, предлагает допуслуги и передаёт сложные запросы администратору с готовым контекстом.</p>
          <p>Один агент вместо ручной обработки WhatsApp, Telegram, MAX и виджета на сайте — единый inbox, ответ за секунды, бронь и upsell без очереди у ресепшн.</p>
        </div>
        <div class="vko-intro-deco" aria-label="Ключевые метрики AI-консьержа">
          <div class="vko-intro-terminal">
            <div class="vko-intro-terminal-head">guest-inbox · pipeline</div>
            <div class="vko-intro-terminal-body">
              <span class="vko-chip"><strong>&lt;5 сек</strong> ответ</span>
              <span class="vko-chip"><strong>4+</strong> канала</span>
              <span class="vko-chip"><strong>24/7</strong> режим</span>
              <span class="vko-chip"><strong>↑15–25%</strong> upsell</span>
              <span class="vko-chip">FAQ · бронь · SPA</span>
              <span class="vko-chip">PMS API</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="vko-toc-outer">
    <div class="vko-cnt">
      <nav class="ym-toc vko-toc" aria-label="Оглавление статьи">
        <a href="#bole">Боль</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#integracii">Интеграции</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>


  <!-- #bole -->
  <section class="vko-section vko-section-alt" id="bole" aria-labelledby="bole-title">
    <div class="vko-cnt">
      <div class="vko-sh vko-left nero-ai-reveal">
        <span class="vko-eyebrow">Боль отеля</span>
        <h2 id="bole-title">Почему администратор не успевает отвечать гостям</h2>
        <p>Главная боль отелей, апартаментов и глэмпингов в 2026 году: <strong>гости пишут в разные каналы, администратор не успевает отвечать</strong>. Сообщение «остынет» на 45–90 минут — и вместе с ним остывает бронь.</p>
      </div>

      <div class="vko-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div>
          <p>По бенчмаркам Guestara, отели без единого inbox в среднем отвечают <strong>45–90 минут</strong>. Целевое время в мессенджерах — <strong>до 5 минут</strong> для срочных и <strong>до 10 минут</strong> для стандартных запросов. Пока администратор переключается между вкладками, гость уже забронировал у конкурента через OTA с комиссией 15–25%.</p>

          <h3>WhatsApp, Telegram, сайт и телефон — один гость, четыре канала</h3>
          <p>Современный гость не выбирает «один канал». Россиянин пишет в <strong>Telegram</strong> или <strong>MAX</strong>, иностранный турист — в <strong>WhatsApp</strong>, кто-то оставляет вопрос в виджете на <strong>сайте</strong>. С <strong>1 марта 2026</strong> цифровое заселение через Цифровой ID в MAX закреплено ПП РФ № 1912.</p>
          <p><strong>Определение проблемы:</strong> мультиканальность без единого агента = потерянные диалоги, дублирование ответов, выгорание персонала.</p>
          <!-- INTERNAL-LINKS:INSERT -->
        </div>
        <div class="vko-kpi-row" style="grid-template-columns:1fr;gap:12px;margin-top:0">
          <div class="vko-kpi"><div class="kv">45–90</div><div class="kl">минут средний ответ без inbox</div></div>
          <div class="vko-kpi"><div class="kv">&lt;5</div><div class="kl">минут SLA для срочных в мессенджере</div></div>
          <div class="vko-kpi"><div class="kv">15–25%</div><div class="kl">комиссия OTA при уходе гостя</div></div>
        </div>
      </div>

      <div class="vko-card nero-ai-reveal" style="margin-top:28px">
        <h3>Потерянные брони и недопроданные услуги из-за задержки ответа</h3>
        <p><strong>Прямые брони.</strong> Гость спрашивает: «Есть номер на 15–17 марта?» — и не получает ответ до вечера. Кейс GHT Hotels + HiJiffy: <strong>16% прямых бронирований с сайта</strong> через чат-ассистента, <strong>€733 000</strong> выручки (2024).</p>
        <p><strong>Допродажи.</strong> SPA, трансфер, ранний заезд продаются в момент готовности гостя. Конверсия персонализированных upsell — <strong>15–25%</strong>, против &lt;5% для email.</p>
        <p>Итог: <strong>AI-консьерж отеля</strong> снимает рутину — человек подключается только к сложным кейсам.</p>
      </div>
    </div>
  </section>

  <!-- #chto-takoe -->
  <section class="vko-section" id="chto-takoe" aria-labelledby="chto-takoe-title">
    <div class="vko-cnt">
      <div class="vko-sh vko-left nero-ai-reveal">
        <span class="vko-eyebrow">Определение</span>
        <h2 id="chto-takoe-title">Что такое AI-консьерж для отеля</h2>
        <p><strong>AI-консьерж для отеля</strong> — виртуальный агент на базе LLM, который работает <strong>24/7</strong> в каналах, где гость уже пишет. Это <strong>agentic AI</strong>: понимает свободный текст, обращается к базе знаний и PMS, выполняет действия — показывает наличие, предлагает допуслуги, эскалирует жалобу.</p>
      </div>

      <div class="vko-table-wrap nero-ai-reveal" style="margin-top:28px">
        <table class="vko-table" aria-label="Сравнение чат-бота и AI-консьержа">
          <thead><tr><th>Параметр</th><th>Обычный чат-бот</th><th>AI-консьерж</th></tr></thead>
          <tbody>
            <tr><td>Понимание вопроса</td><td>Жёсткие сценарии и кнопки</td><td>Свободный текст, синонимы, несколько языков</td></tr>
            <tr><td>Данные</td><td>Зашитые ответы</td><td>RAG + API PMS (наличие, цены)</td></tr>
            <tr><td>Действия</td><td>Ссылка на форму</td><td>Бронь, изменение дат, заказ допуслуги</td></tr>
            <tr><td>Эскалация</td><td>«Позвоните нам»</td><td>Передача администратору с summary</td></tr>
          </tbody>
        </table>
      </div>

      <div class="vko-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="vko-card">
          <h3>Три столпа оффера</h3>
          <ul>
            <li><strong>FAQ 24/7</strong> — заезд, парковка, Wi‑Fi, завтрак</li>
            <li><strong>AI-бронирование отеля</strong> — даты, категории, оплата</li>
            <li><strong>Допродажи</strong> — SPA, трансфер, ранний/поздний заезд</li>
          </ul>
        </div>
        <div class="vko-card">
          <h3>TL: Chat или свой AI?</h3>
          <p>TravelLine TL: Chat работает <strong>только на сайте</strong> до 31.12.2026. Кастомный <strong>AI-консьерж отеля под ключ</strong> закрывает мультиканальность — Telegram, MAX, WhatsApp — и кастомную upsell-логику.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- === БОРИС: визуальный блок (светлая полоса) === -->
  <section id="ai-konserzh-otelya-boris-block" class="vkob-root" aria-label="Анимация: единый inbox AI-консьержа отеля">
    <div class="vkob-cnt">
      <div class="vkob-card nero-ai-reveal">
        <div class="vkob-lft">
          <span class="vkob-ey">Единый inbox</span>
          <h3 class="vkob-h3">Четыре канала — один AI-оркестратор: бронь в PMS или эскалация администратору</h3>
          <ul class="vkob-ul">
            <li><span class="vkob-ic">TG</span>Telegram, MAX, WhatsApp и виджет сайта стекаются в единую очередь</li>
            <li><span class="vkob-ic">AI</span>Оркестратор определяет intent: FAQ, бронь, upsell или жалоба</li>
            <li><span class="vkob-ic">PMS</span>Для брони — запрос availability и тарифов по API TravelLine/Bnovo/Shelter</li>
            <li><span class="vkob-ic">!</span>Низкая уверенность — диалог с summary уходит администратору</li>
          </ul>
          <div class="vkob-pills">
            <span class="vkob-pl vkob-pl-g">&lt;5 сек ответ</span>
            <span class="vkob-pl vkob-pl-b">4+ канала</span>
            <span class="vkob-pl vkob-pl-v">human-in-the-loop</span>
          </div>
          <p class="vkob-foot">Дальше разберём типовые диалоги гостя и upsell-сценарии →</p>
        </div>
        <div class="vkob-rgt">
          <canvas id="vko-inbox-orchestrator-canvas" role="img" aria-label="Анимация: сообщения из мессенджеров сходятся в AI-оркестратор и формируют бронь в PMS или эскалацию"></canvas>
        </div>
      </div>
    </div>
    <script>
    (function(){
      'use strict';
      var cv = document.getElementById('vko-inbox-orchestrator-canvas');
      if (!cv) return;
      var ctx = cv.getContext('2d');
      var W = 0, H = 0, frame = 0;

      function resize(){
        var p = cv.parentElement;
        if (!p) return;
        cv.width = p.clientWidth || 640;
        cv.height = p.clientHeight || 400;
        W = cv.width; H = cv.height;
      }
      window.addEventListener('resize', resize);
      resize();

      var C = {
        bg:'#f1f5f9', hub:'#0ea5e9', hubGlow:'rgba(14,165,233,.2)',
        tg:'#229ED9', max:'#7B68EE', wa:'#25D366', web:'#64748b',
        pms:'#22c55e', esc:'#f59e0b', msg:'#fff', msgBdr:'#cbd5e1',
        text:'#1e293b', muted:'#64748b', line:'rgba(14,165,233,.3)'
      };

      var CHANNELS = [
        {id:'tg', label:'Telegram', color:C.tg, angle:-2.4},
        {id:'max', label:'MAX', color:C.max, angle:-0.8},
        {id:'wa', label:'WhatsApp', color:C.wa, angle:0.8},
        {id:'web', label:'Сайт', color:C.web, angle:2.4}
      ];

      var msgs = [];
      var cycle = 0;

      function rr(x,y,w,h,r,fill,stroke){
        ctx.beginPath();
        if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
        else ctx.rect(x,y,w,h);
        if(fill){ ctx.fillStyle=fill; ctx.fill(); }
        if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
      }

      function spawnMsg(ch){
        var a = ch.angle + (Math.random()-.5)*.3;
        var dist = Math.min(W,H)*0.38;
        msgs.push({
          ch: ch.id, color: ch.color,
          x: W*0.5 + Math.cos(a)*dist,
          y: H*0.5 + Math.sin(a)*dist,
          t: 0, type: Math.random()>.6 ? 'book' : 'faq',
          label: ch.label
        });
      }

      function drawHub(cx, cy, r, pulse){
        var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
        g.addColorStop(0, C.hubGlow);
        g.addColorStop(1, 'rgba(14,165,233,0)');
        ctx.fillStyle = g;
        ctx.beginPath();
        ctx.arc(cx,cy,r*1.8,0,Math.PI*2);
        ctx.fill();

        rr(cx-r, cy-r, r*2, r*2, r*0.3, '#fff', C.hub);
        ctx.fillStyle = C.hub;
        ctx.font = 'bold ' + Math.max(12,r*0.28) + 'px system-ui,sans-serif';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('AI', cx, cy-4);
        ctx.font = Math.max(9,r*0.16) + 'px system-ui,sans-serif';
        ctx.fillStyle = C.muted;
        ctx.fillText('оркестратор', cx, cy+r*0.35);

        ctx.strokeStyle = C.hub;
        ctx.lineWidth = 2 + pulse*2;
        ctx.globalAlpha = 0.25 + pulse*0.35;
        ctx.beginPath();
        ctx.arc(cx,cy,r+8+pulse*6,0,Math.PI*2);
        ctx.stroke();
        ctx.globalAlpha = 1;
      }

      function drawChannelNode(cx, cy, ch, active){
        var r = 22;
        rr(cx-r, cy-r, r*2, r*2, 10, ch.color, active ? '#fff' : 'transparent');
        ctx.fillStyle = '#fff';
        ctx.font = 'bold 9px system-ui,sans-serif';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        var abbr = ch.id==='tg'?'TG':ch.id==='max'?'MAX':ch.id==='wa'?'WA':'WEB';
        ctx.fillText(abbr, cx, cy);
        ctx.fillStyle = C.muted;
        ctx.font = '9px system-ui,sans-serif';
        ctx.fillText(ch.label, cx, cy+r+12);
      }

      function drawPmsCard(x,y,w,h,alpha){
        if(alpha<.05) return;
        ctx.globalAlpha = alpha;
        rr(x,y,w,h,10,'#fff',C.pms);
        ctx.fillStyle = C.pms;
        ctx.font = 'bold 11px system-ui,sans-serif';
        ctx.textAlign = 'left';
        ctx.fillText('Бронь в PMS', x+12, y+18);
        ctx.fillStyle = C.text;
        ctx.font = '10px system-ui,sans-serif';
        ctx.fillText('Стандарт 15–17 мар · 12 500 ₽', x+12, y+36);
        ctx.fillText('+ завтрак · + поздний выезд', x+12, y+52);
        ctx.globalAlpha = 1;
      }

      function drawEscBadge(x,y,alpha){
        if(alpha<.05) return;
        ctx.globalAlpha = alpha;
        rr(x,y,90,28,8,C.esc,'#fff');
        ctx.fillStyle = '#fff';
        ctx.font = 'bold 10px system-ui,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('→ Админ', x+45, y+17);
        ctx.globalAlpha = 1;
      }

      function tick(){
        frame++;
        cycle++;
        var cx = W*0.5, cy = H*0.5;
        var hubR = Math.min(W,H)*0.09;
        var pulse = 0.5 + 0.5*Math.sin(frame*0.04);

        ctx.fillStyle = C.bg;
        ctx.fillRect(0,0,W,H);

        var orbit = Math.min(W,H)*0.36;
        CHANNELS.forEach(function(ch){
          var nx = cx + Math.cos(ch.angle)*orbit;
          var ny = cy + Math.sin(ch.angle)*orbit;
          drawChannelNode(nx, ny, ch, frame%120 < 30);
          ctx.strokeStyle = C.line;
          ctx.lineWidth = 1;
          ctx.setLineDash([4,6]);
          ctx.beginPath();
          ctx.moveTo(nx, ny);
          ctx.lineTo(cx, cy);
          ctx.stroke();
          ctx.setLineDash([]);
        });

        if(cycle % 90 === 0){
          spawnMsg(CHANNELS[Math.floor(Math.random()*CHANNELS.length)]);
        }

        var pmsAlpha = 0, escAlpha = 0;
        for(var i=msgs.length-1;i>=0;i--){
          var m = msgs[i];
          m.t += 0.012;
          var prog = m.t;
          var startA = CHANNELS.find(function(c){return c.id===m.ch;});
          if(!startA) continue;
          var sx = cx + Math.cos(startA.angle)*orbit;
          var sy = cy + Math.sin(startA.angle)*orbit;
          var mx = sx + (cx-sx)*Math.min(prog*1.2,1);
          var my = sy + (cy-sy)*Math.min(prog*1.2,1);

          rr(mx-28, my-10, 56, 20, 6, C.msg, m.color);
          ctx.fillStyle = C.text;
          ctx.font = '9px system-ui,sans-serif';
          ctx.textAlign = 'center';
          ctx.fillText(m.type==='book'?'Бронь?':'FAQ', mx, my+4);

          if(prog > 0.85 && prog < 1.1){
            if(m.type==='book') pmsAlpha = Math.min(1, (prog-0.85)*6);
            else escAlpha = Math.min(1, (prog-0.85)*6);
          }
          if(prog > 1.3) msgs.splice(i,1);
        }

        drawHub(cx, cy, hubR, pulse);
        drawPmsCard(W*0.72, H*0.15, W*0.22, 70, pmsAlpha);
        drawEscBadge(W*0.08, H*0.15, escAlpha);

        requestAnimationFrame(tick);
      }
      tick();
    })();
    </script>
  </section>

  <!-- #scenarii -->
  <section class="vko-section vko-section-alt" id="scenarii" aria-labelledby="scenarii-title">
    <div class="vko-cnt">
      <div class="vko-sh nero-ai-reveal">
        <span class="vko-eyebrow">Сценарии</span>
        <h2 id="scenarii-title" class="vko-gt">Как работает AI-консьерж: сценарии для гостя</h2>
        <p>Типовые сценарии, которые закрывает <strong>внедрение AI-консьержа</strong>. На лендинге доступно демо чата с реальными гостевыми вопросами.</p>
      </div>

      <div class="vko-dialog-cards nero-ai-reveal">
        <div class="vko-dialog">
          <div class="who">Гость</div>
          <p>«Во сколько заезд? Можно раньше?»</p>
          <div class="who" style="margin-top:12px;color:var(--vko-green)">AI</div>
          <p>«Стандартный заезд — с 14:00. Ранний заезд +2 000 ₽. Добавить к брони № 4821?»</p>
        </div>
        <div class="vko-dialog">
          <div class="who">Гость</div>
          <p>«Есть номер на 15–17 марта, двое взрослых?»</p>
          <div class="who" style="margin-top:12px;color:var(--vko-green)">AI</div>
          <p>«Стандарт 18 м² — 12 500 ₽/ночь. Завтрак +1 200 ₽/чел., поздний выезд +1 500 ₽. Оформить?»</p>
        </div>
        <div class="vko-dialog">
          <div class="who">Кейс VALO</div>
          <p>ИИ-инструменты освобождают <strong>~20% рабочего времени</strong> команды (РБК, 2026).</p>
        </div>
      </div>

      <div class="vko-table-wrap nero-ai-reveal" style="margin-top:32px">
        <table class="vko-table" aria-label="Upsell по жизненному циклу брони">
          <thead><tr><th>Этап</th><th>Триггер</th><th>Предложение</th></tr></thead>
          <tbody>
            <tr><td>Pre-stay (за 48 ч)</td><td>Подтверждённая бронь</td><td>Ранний заезд, трансфер</td></tr>
            <tr><td>In-stay</td><td>Заселение</td><td>SPA, ужин, экскурсия</td></tr>
            <tr><td>Pre-checkout</td><td>Дата выезда</td><td>Поздний выезд, такси в аэропорт</td></tr>
            <tr><td>Post-stay</td><td>После выезда</td><td>Отзыв, скидка на повторный визит</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center"><strong>Итог:</strong> AI-консьерж закрывает путь гостя от первого вопроса до допродажи — без очереди у администратора.</p>

      <!-- CTA #1 Артур -->
      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-scenarii">
        <div class="ym-cta-block__icon" aria-hidden="true">🏨</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите такой AI-консьерж для своего отеля?</p>
          <p class="ym-cta-block__sub">Покажем демо на типовых гостевых вопросах: бронь, FAQ и upsell SPA — бесплатный аудит каналов за 2–3 дня, без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <!-- #kanaly -->
  <section class="vko-section" id="kanaly" aria-labelledby="kanaly-title">
    <div class="vko-cnt">
      <div class="vko-sh vko-left nero-ai-reveal">
        <span class="vko-eyebrow">Каналы</span>
        <h2 id="kanaly-title">Каналы связи с гостями</h2>
        <p>Один <strong>AI-консьерж</strong> — единая логика во всех точках контакта. Администратор видит <strong>единый inbox</strong>.</p>
      </div>

      <div class="vko-channels nero-ai-reveal">
        <div class="vko-channel-card"><div class="ico">💬</div><strong>Telegram</strong><span>Полный цикл: вопрос → бронь → upsell</span></div>
        <div class="vko-channel-card"><div class="ico">📱</div><strong>MAX</strong><span>Цифровое заселение 2026</span></div>
        <div class="vko-channel-card"><div class="ico">🌐</div><strong>Сайт</strong><span>FAQ, бронь до ухода на OTA</span></div>
        <div class="vko-channel-card"><div class="ico">📞</div><strong>WhatsApp</strong><span>Иностранные гости, трансфер</span></div>
        <div class="vko-channel-card"><div class="ico">👥</div><strong>VK</strong><span>FAQ, заявки, обратная связь</span></div>
      </div>

      <div class="vko-table-wrap nero-ai-reveal" style="margin-top:28px">
        <table class="vko-table" aria-label="Каналы и что закрывает AI">
          <thead><tr><th>Канал</th><th>Кто пишет</th><th>Что закрывает AI</th></tr></thead>
          <tbody>
            <tr><td>Сайт (виджет)</td><td>Гость до брони</td><td>FAQ, бронь, допуслуги</td></tr>
            <tr><td>Telegram</td><td>Россия, СНГ</td><td>Полный цикл</td></tr>
            <tr><td>MAX</td><td>Россия, заселение 2026</td><td>FAQ, уведомления, in-stay</td></tr>
            <tr><td>WhatsApp</td><td>Иностранные гости</td><td>Бронь, трансфер, мультиязычность</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- #integracii -->
  <section class="vko-section vko-section-alt" id="integracii" aria-labelledby="integracii-title">
    <div class="vko-cnt">
      <div class="vko-sh nero-ai-reveal">
        <span class="vko-eyebrow">Интеграции</span>
        <h2 id="integracii-title">Интеграция с PMS, CRM и системами бронирования</h2>
        <p>Без связи с PMS агент отвечает на FAQ, но не видит наличие номеров в реальном времени.</p>
      </div>

      <div class="vko-table-wrap nero-ai-reveal">
        <table class="vko-table" aria-label="PMS и API для AI-консьержа">
          <thead><tr><th>PMS</th><th>AI/чат</th><th>API</th></tr></thead>
          <tbody>
            <tr><td>TravelLine</td><td>TL: Chat, модуль бронирования</td><td>Есть; Hotbot — официальная интеграция</td></tr>
            <tr><td>Bnovo</td><td>Модуль бронирования, мессенджеры</td><td>API, партнёрские интеграции</td></tr>
            <tr><td>Shelter Cloud</td><td>IMOBIS (MAX, TG, VK, WA)</td><td>Shelter Cloud API v2/v3</td></tr>
            <tr><td>1С-Отель</td><td>Через интеграторов</td><td>Зависит от внедрения</td></tr>
          </tbody>
        </table>
      </div>

      <!-- INTERNAL-LINKS:INSERT -->

      <div class="vko-callout nero-ai-reveal">
        <h4>Развилка «TL: Chat или свой AI?»</h4>
        <p><strong>Хватит TL: Chat</strong>, если основной канал — сайт и мессенджеры не критичны. <strong>Нужен AI-консьерж под ключ</strong>, если гости пишут в Telegram/MAX/WhatsApp, нужна кастомная upsell-логика и единый inbox + amoCRM/Bitrix24.</p>
      </div>

      <div class="vko-grid-2 nero-ai-reveal" style="margin-top:24px">
        <div class="vko-card">
          <h3>CRM: от диалога до сделки</h3>
          <p><strong>AI-консьерж отеля в CRM</strong> фиксирует канал, тему, итог и сумму допуслуг. Повторный гость узнаётся по телефону или email.</p>
        </div>
        <div class="vko-card">
          <h3>Без программиста со стороны отеля</h3>
          <p>Интегратор подключает API PMS, настраивает каналы, обучает AI. Ориентир рынка: PapAI от 90 000 ₽; Nero — <strong>150–500 тыс. ₽</strong> под ключ.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #komu-podhodit -->
  <section class="vko-section" id="komu-podhodit" aria-labelledby="komu-title">
    <div class="vko-cnt">
      <div class="vko-sh nero-ai-reveal">
        <span class="vko-eyebrow">Сегменты</span>
        <h2 id="komu-title">Кому подходит внедрение</h2>
      </div>
      <div class="vko-grid-2 nero-ai-reveal">
        <div class="vko-card">
          <h3>Отели и мини-отели</h3>
          <p>Отель на 15–40 номеров без ночной смены теряет заявки с 22:00 до 8:00. AI закрывает ночной фронт: бронь, FAQ, трансфер.</p>
        </div>
        <div class="vko-card">
          <h3>Апартаменты, глэмпинги, базы отдыха</h3>
          <p><strong>AI-консьерж отеля для малого бизнеса</strong> — способ не терять брони при одном администраторе. Локальный контент: маршруты, правила глэмпинга.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #keisy -->
  <section class="vko-section vko-section-alt" id="keisy" aria-labelledby="keisy-title">
    <div class="vko-cnt">
      <div class="vko-sh nero-ai-reveal">
        <span class="vko-eyebrow">Кейсы</span>
        <h2 id="keisy-title">Кейсы и примеры внедрения AI-консьержа</h2>
      </div>

      <div class="vko-card nero-ai-reveal">
        <h3>Сценарии гостевых вопросов (лид-магнит)</h3>
        <p>Таблица 50 типовых запросов с пометкой «закрывает AI / эскалация человеку»:</p>
        <ul>
          <li>«Есть парковка?» → AI (FAQ)</li>
          <li>«Номер на завтра, двое детей» → AI + PMS (бронь)</li>
          <li>«Некорректное списание с карты» → эскалация администратору</li>
        </ul>
      </div>

      <div class="vko-kpi-row nero-ai-reveal" style="margin-top:24px">
        <div class="vko-kpi"><div class="kv">89%</div><div class="kl">автоматизация диалогов · GHT Hotels</div></div>
        <div class="vko-kpi"><div class="kv">+30%</div><div class="kl">прямых броней · Hotel Singular</div></div>
        <div class="vko-kpi"><div class="kv">~20%</div><div class="kl">времени команды · VALO, РФ</div></div>
      </div>

      <!-- CTA #3 Артур -->
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-keisy">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы к таким же результатам на своём объекте?</p>
          <p class="ym-cta-block__sub">89% автоматизации диалогов, +30% прямых броней, −20% нагрузки на ресепшн — международные и российские кейсы подтверждают ROI. Следующий шаг — аудит ваших каналов.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- #etapy -->
  <section class="vko-section" id="etapy" aria-labelledby="etapy-title">
    <div class="vko-cnt">
      <div class="vko-sh nero-ai-reveal">
        <span class="vko-eyebrow">Под ключ</span>
        <h2 id="etapy-title">Этапы внедрения AI-консьержа под ключ</h2>
        <p>Проектная модель на <strong>3–6 недель</strong> (чек 150–500 тыс. ₽).</p>
      </div>

      <div class="vko-timeline nero-ai-reveal">
        <div class="vko-step">
          <span class="vko-step-num">1</span>
          <h3>Аудит (2–3 дня)</h3>
          <p>Каналы гостей, PMS, допуслуги для upsell, FAQ с сайта.</p>
        </div>
        <div class="vko-step">
          <span class="vko-step-num">2</span>
          <h3>Настройка (5–10 дней)</h3>
          <p>База знаний, API PMS, промпт + RAG, каналы: виджет, Telegram, MAX.</p>
        </div>
        <div class="vko-step">
          <span class="vko-step-num">3</span>
          <h3>Пилот + запуск</h3>
          <p>2 недели логирования, доработка FAQ, обучение администратора, SLA.</p>
        </div>
      </div>

      <div class="vko-flow nero-ai-reveal" aria-label="Логика системы">
        <span>Гость пишет</span><span class="arr">→</span>
        <span>Intent: FAQ/бронь/upsell</span><span class="arr">→</span>
        <span>AI + RAG / PMS API</span><span class="arr">→</span>
        <span>Эскалация или CRM</span>
      </div>

      <!-- CTA #2 Артур -->
      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать AI-автоматизацию до старта проекта?</p>
          <p class="ym-cta-block__sub">Если команда отеля хочет разобраться в сценариях, промптах и human-in-the-loop до пилота — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo (strpos($secondary_cta_url, 'http') === 0 ? ' target="_blank" rel="noopener noreferrer"' : ''); ?>><?php echo esc_html($secondary_cta_label); ?></a>. Это ускоряет согласование этапов внедрения и снижает риски на старте.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- #ceny -->
  <section class="vko-section vko-section-alt" id="ceny" aria-labelledby="ceny-title">
    <div class="vko-cnt">
      <div class="vko-sh nero-ai-reveal">
        <span class="vko-eyebrow">Стоимость</span>
        <h2 id="ceny-title">Сколько стоит AI-консьерж для отеля</h2>
      </div>

      <div class="vko-table-wrap nero-ai-reveal">
        <table class="vko-table" aria-label="Из чего складывается стоимость">
          <thead><tr><th>Компонент</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит и проектирование</td><td>Каналы, PMS, сценарии upsell</td></tr>
            <tr><td>База знаний + RAG</td><td>FAQ, тарифы, правила, локация</td></tr>
            <tr><td>AI-агент</td><td>Промпт, LLM, эскалация</td></tr>
            <tr><td>Каналы</td><td>Виджет, Telegram, MAX, WhatsApp</td></tr>
            <tr><td>Интеграция PMS/CRM</td><td>TravelLine, Bnovo, Shelter, amoCRM</td></tr>
            <tr><td>Пилот и обучение</td><td>2 недели, доработка, обучение персонала</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;text-align:center;font-size:18px"><strong>Ориентир чека Nero Network: 150–500 тыс. ₽</strong> за внедрение под ключ (объект 10–80 номеров).</p>

      <div class="vko-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="vko-card">
          <h3>ROI: альтернатива</h3>
          <ul>
            <li>Ночная смена администратора — от ~80–120 тыс. ₽/мес</li>
            <li>Одна упущенная бронь 3 ночи × 10 000 ₽ = 30 000 ₽</li>
            <li>Комиссия OTA 15–25% с каждой брони</li>
          </ul>
        </div>
        <div class="vko-card">
          <h3>Эффект</h3>
          <p>Экономия времени <strong>20–35%</strong>, рост прямых броней, upsell с конверсией <strong>15–25%</strong> на персонализированные предложения.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #faq -->
  <section class="vko-section" id="faq" aria-labelledby="faq-title">
    <div class="vko-cnt">
      <div class="vko-sh nero-ai-reveal">
        <span class="vko-eyebrow">FAQ</span>
        <h2 id="faq-title">FAQ по AI-консьержу для отеля</h2>
      </div>

      <div class="vko-faq nero-ai-reveal" role="list">
        <div class="vko-faq-item" role="listitem">
          <div class="vko-faq-q" tabindex="0">Как внедрить AI-консьерж отеля без программиста?</div>
          <div class="vko-faq-a">Со стороны отеля программист не нужен. Интегратор подключает PMS API, настраивает каналы, загружает базу знаний. Срок — <strong>3–6 недель</strong> под ключ.</div>
        </div>
        <div class="vko-faq-item" role="listitem">
          <div class="vko-faq-q" tabindex="0">Сколько стоит и как долго внедряется?</div>
          <div class="vko-faq-a"><strong>150–500 тыс. ₽</strong> — ориентир для 10–80 номеров. Срок <strong>3–6 недель</strong>: аудит → база знаний → AI-агент → каналы → пилот → запуск.</div>
        </div>
        <div class="vko-faq-item" role="listitem">
          <div class="vko-faq-q" tabindex="0">Безопасность данных гостей (152-ФЗ)</div>
          <div class="vko-faq-a">Для брони и заселения по договору отдельное согласие часто не требуется. Маркетинговые рассылки — отдельное согласие обязательно. Хранение в российском облаке.</div>
        </div>
        <div class="vko-faq-item" role="listitem">
          <div class="vko-faq-q" tabindex="0">Можно ли для малого отеля?</div>
          <div class="vko-faq-a">Да. 10–40 номеров — целевой сегмент: один администратор, ночные заявки, мессенджеры.</div>
        </div>
        <div class="vko-faq-item" role="listitem">
          <div class="vko-faq-q" tabindex="0">Заменяет ли AI администратора?</div>
          <div class="vko-faq-a">Нет. AI закрывает рутину; человек — конфликты, VIP, заселение. Администратор подключается с готовым контекстом.</div>
        </div>
        <div class="vko-faq-item" role="listitem">
          <div class="vko-faq-q" tabindex="0">Что если AI ошибётся?</div>
          <div class="vko-faq-a">RAG по данным отеля, пилот 2 недели, логи, эскалация при низкой уверенности. На старте — модерация спорных ответов.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- #podklyuchit -->
  <section class="vko-section vko-section-alt" id="podklyuchit" aria-labelledby="podklyuchit-title">
    <div class="vko-cnt">
      <div class="vko-sh nero-ai-reveal">
        <span class="vko-eyebrow">Старт</span>
        <h2 id="podklyuchit-title" class="vko-gt">Подключить AI-консьержа</h2>
        <p>Гости пишут в Telegram, на сайте и в MAX. <strong>AI-консьерж отвечает за секунды</strong> — бронирует номер и предлагает SPA, пока вы спите.</p>
      </div>
      <ul class="vko-cta-checklist nero-ai-reveal">
        <li>Единый AI-агент + inbox</li>
        <li>TravelLine, Bnovo, Shelter, amoCRM</li>
        <li>Pre-stay / in-stay / post-stay upsell</li>
        <li>Демо чата и лид-магнит</li>
        <li>Внедрение за 3–6 недель</li>
      </ul>
      <p class="nero-ai-reveal" style="text-align:center;margin-top:20px">
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </p>
    </div>
  </section>

  <!-- CTA #4 финальный (вместо баннера) -->
  <div class="vko-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Подключить AI-консьержа для отеля</p>
        <p class="ym-cta-block__sub">Бесплатный аудит каналов и демо чата на данных вашего объекта. Внедрение под ключ за 3–6 недель — TravelLine, Bnovo, Shelter, Telegram, MAX.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>


</div><!-- .vko-content -->


<script>
/**
 * vko-concierge-hero-engine — Диспетчерская единого гостевого inbox
 * Мир: ChannelMessageRiver → GuestConciergeHub → бронь + upsell SPA
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vko-chat-demo-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 240;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 400, ch / 260) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    hubBg: "#1e293b",
    hubScreen: "#0f172a",
    bubbleGuest: "rgba(59,130,246,0.35)",
    bubbleAi: "rgba(34,197,94,0.28)",
    channelTg: "#38bdf8",
    channelMax: "#a78bfa",
    channelWa: "#4ade80",
    channelWeb: "#fbbf24",
    river: "rgba(121,242,255,0.2)",
    keyGold: "#fcd34d",
    spaPink: "#f472b6",
    bookGreen: "#22c55e",
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

  /* Потоки сообщений из каналов — дуги слева (не конвейер) */
  function ChannelMessageRiver() {
    this.phase = 0;
  }
  ChannelMessageRiver.prototype.draw = function (ctx) {
    this.phase = (frame * 0.028) % (Math.PI * 2);
    var channels = [
      { label: "TG", color: C.channelTg, angle: -2.4, dist: 95 },
      { label: "MAX", color: C.channelMax, angle: -1.6, dist: 88 },
      { label: "WA", color: C.channelWa, angle: -0.9, dist: 82 },
      { label: "WEB", color: C.channelWeb, angle: -0.2, dist: 78 }
    ];
    channels.forEach(function (ch, idx) {
      var sx = -155 + Math.cos(ch.angle) * 20;
      var sy = -35 + Math.sin(ch.angle) * 15;
      var ex = -25;
      var ey = -15;
      ctx.strokeStyle = ch.color;
      ctx.globalAlpha = 0.35;
      ctx.lineWidth = 1.5;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.5 - idx * 8;
      ctx.beginPath();
      ctx.moveTo(sx, sy);
      ctx.quadraticCurveTo(sx + 60, sy + 30, ex, ey);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.globalAlpha = 1;

      drawRR(ctx, sx - 14, sy - 8, 28, 16, 4, ch.color, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(ch.label, sx, sy + 2);

      var t = (this.phase + idx * 0.9) % (Math.PI * 2);
      var prog = (Math.sin(t) + 1) / 2;
      var mx = sx + (ex - sx) * prog;
      var my = sy + (ey - sy) * prog + Math.sin(prog * Math.PI) * 18;
      drawRR(ctx, mx - 8, my - 5, 16, 10, 3, "#f8fafc", C.outline);
    });
  };

  /* Центральный inbox — вместо WebsiteTerminal */
  function GuestConciergeHub() {
    this.intentGlow = 0;
    this.bookingFlash = 0;
  }
  GuestConciergeHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 220;
    drawRR(ctx, -62, -72, 124, 148, 12, C.hubBg, C.outline);
    drawRR(ctx, -52, -58, 104, 88, 8, C.hubScreen, C.outline);

    /* Пузыри диалога */
    var bubbles = [
      { side: "guest", y: -48, w: 52, text: "15–17 мар?" },
      { side: "ai", y: -28, w: 58, text: "Стандарт ✓" },
      { side: "guest", y: -8, w: 44, text: "Ранний?" },
      { side: "ai", y: 12, w: 50, text: "+2 000 ₽" }
    ];
    bubbles.forEach(function (b, i) {
      if (prg < 25 + i * 18) return;
      var bx = b.side === "guest" ? -44 : 8;
      var col = b.side === "guest" ? C.bubbleGuest : C.bubbleAi;
      drawRR(ctx, bx, b.y, b.w, 14, 5, col, C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(b.text, bx + 5, b.y + 10);
    });

    /* Фаза TRIAGE */
    if (prg >= 50 && prg < 95) {
      this.intentGlow = (prg - 50) / 45;
      ctx.fillStyle = "rgba(139,92,246," + (0.15 + Math.sin(frame * 0.12) * 0.1) + ")";
      ctx.beginPath();
      ctx.arc(0, -20, 28 + Math.sin(frame * 0.08) * 4, 0, Math.PI * 2);
      ctx.fill();
      var intents = ["FAQ", "Бронь", "Upsell"];
      intents.forEach(function (label, i) {
        drawRR(ctx, -48 + i * 34, 38, 30, 12, 4, "rgba(121,242,255,0.2)", C.outline);
        ctx.fillStyle = "#a5f3fc";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(label, -33 + i * 34, 47);
      });
    }

    /* Фаза BOOK — ключ-карта */
    if (prg >= 95 && prg < 155) {
      var keyY = 55 - Math.min(1, (prg - 95) / 20) * 30;
      drawRR(ctx, -18, keyY, 36, 22, 4, C.keyGold, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("№4821", 0, keyY + 14);
    }

    /* Фаза CONFIRM — бронь + SPA upsell (финал, не ракета) */
    if (prg >= 155) {
      var confirmPrg = Math.min(1, (prg - 155) / 30);
      this.bookingFlash = confirmPrg;
      drawRR(ctx, -40, 42 - confirmPrg * 8, 80, 36, 8, "rgba(34,197,94,0.22)", C.bookGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Бронь подтверждена", 0, 58 - confirmPrg * 8);
      ctx.font = "7px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("15–17 мар · 12 500 ₽", 0, 68 - confirmPrg * 8);

      if (prg > 175) {
        var spaY = 20 - Math.min(1, (prg - 175) / 15) * 12;
        drawRR(ctx, 48, spaY, 38, 18, 6, "rgba(244,114,182,0.35)", C.spaPink);
        ctx.fillStyle = "#fce7f3";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.fillText("SPA +2k", 67, spaY + 12);
      }

      if (prg > 185 && prg < 215) {
        var pulse = (prg - 185) / 30;
        ctx.strokeStyle = "rgba(34,197,94," + (0.7 - pulse * 0.65) + ")";
        ctx.lineWidth = 2.5;
        ctx.beginPath();
        ctx.arc(0, 58, 18 + pulse * 35, 0, Math.PI * 2);
        ctx.stroke();
      }
    }

    /* Мини-календарь — декор справа */
    drawRR(ctx, 38, -62, 28, 24, 4, "rgba(255,255,255,0.08)", C.outline);
    ctx.fillStyle = "#79f2ff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("МАР", 52, -52);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.fillText("15", 52, -40);
  };

  /* Agent — каркас из hero-engine-example */
  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.035;
    var prg = (frame * 0.042) % 220;
    var isMoving = false;
    var faceDir = 1;
    var targetX = -70 + (this.stepTrig * 0.15);
    var targetY = 55;

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        faceDir = 1;
        this.x = this.baseX + (targetX - this.baseX) * (local / 11);
        this.y = this.baseY + (targetY - this.baseY) * (local / 11);
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = targetX - (targetX - this.baseX) * ((local - 11) / 11);
        this.y = targetY - (targetY - this.baseY) * ((local - 11) / 11);
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 220);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 4)) * 2 : Math.sin(this.timer * 1.4);
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -8, 2, 6, 10, 2, C.outline, null);
    drawRR(ctx, 2, 2, 6, 10, 2, C.outline, null);
    drawRR(ctx, -12, -10 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -22 - bob, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 1.5;
    ctx.strokeStyle = C.outline;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var river = new ChannelMessageRiver();
  var hub = new GuestConciergeHub();
  entities.push(river);
  entities.push(hub);
  entities.push(new Agent(-130, 48, C.agentYellow, "1_architect", 12, [
    "TG + MAX в одном окне",
    "Канал заселён",
    "Inbox синхронизирован"
  ]));
  entities.push(new Agent(-105, 72, C.agentGreen, "2_seo", 48, [
    "Парковка — бесплатно",
    "Заезд с 14:00",
    "Wi‑Fi в номере есть"
  ]));
  entities.push(new Agent(-78, 38, C.agentBlue, "3_coder", 88, [
    "PMS: номер свободен",
    "12 500 ₽/ночь",
    "Бронь № 4821 создана"
  ]));
  entities.push(new Agent(-50, 65, C.agentPink, "4_designer", 128, [
    "Ранний заезд +2 000",
    "SPA со скидкой 10%",
    "Upsell отправлен"
  ]));
  entities.push(new Agent(-22, 42, C.agentPurple, "5_deployer", 168, [
    "Жалоба → админу",
    "Summary диалога готов",
    "Ночной фронт активен"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life, maxLife: life });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 220;
    if (prg >= 10 && prg < 10.05) createBubble(-120, 20, "1. Приём из TG");
    if (prg >= 50 && prg < 50.05) createBubble(-90, 50, "2. Триаж intent");
    if (prg >= 95 && prg < 95.05) createBubble(-60, 10, "3. Запрос PMS");
    if (prg >= 130 && prg < 130.05) createBubble(-35, 55, "4. Upsell SPA");
    if (prg >= 170 && prg < 170.05) createBubble(0, -50, "5. Бронь ✓");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 16, tw, 16, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 7);
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

<script>
(function(){
  document.querySelectorAll('.vko-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      var item = q.parentElement;
      var open = item.classList.contains('open');
      document.querySelectorAll('.vko-faq-item.open').forEach(function(el){ el.classList.remove('open'); });
      if(!open) item.classList.add('open');
    });
    q.addEventListener('keydown',function(e){
      if(e.key==='Enter'||e.key===' '){ e.preventDefault(); q.click(); }
    });
  });
  if('IntersectionObserver' in window){
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(en){
        if(en.isIntersecting){ en.target.classList.add('nero-ai-active'); io.unobserve(en.target); }
      });
    },{threshold:0.12,rootMargin:'0px 0px -40px 0px'});
    document.querySelectorAll('.nero-ai-reveal').forEach(function(el){ io.observe(el); });
  } else {
    document.querySelectorAll('.nero-ai-reveal').forEach(function(el){ el.classList.add('nero-ai-active'); });
  }
})();
</script>

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
