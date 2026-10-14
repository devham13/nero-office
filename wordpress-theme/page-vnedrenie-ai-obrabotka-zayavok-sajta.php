<?php
/**
 * Template Name: AI обработка заявок с сайта — внедрение агента под ключ
 * Description: Внедрение AI-агента для первичной обработки заявок с сайта: ответ 5–15 секунд, CRM, под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI обработка заявок с сайта — внедрение агента под ключ';
$page_seo_description = 'Внедрение AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, уточняющие вопросы и передача горячего лида в CRM. Под ключ для услуг, школ и клиник. Аудит потерь заявок.';

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
    ['label' => 'Потери заявок', 'href' => '#poteri-zayavok'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Интеграции', 'href' => '#integracii-crm'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете';
$primary_cta_url   = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);

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

/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.vzaz-content{
  --vzaz-bg:#050711;--vzaz-bg2:#080b17;--vzaz-surface:rgba(255,255,255,.072);
  --vzaz-text:#e6edf7;--vzaz-muted:#9aa8bd;--vzaz-soft:#c7d2e5;--vzaz-heading:#fff;
  --vzaz-border:rgba(255,255,255,.10);--vzaz-accent:#fbbf24;--vzaz-violet:#a78bfa;--vzaz-green:#4ade80;
  --vzaz-btn-from:#f97316;--vzaz-btn-to:#8b5cf6;--vzaz-r:18px;--vzaz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vzaz-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vzaz-content *,.vzaz-content *::before,.vzaz-content *::after{box-sizing:border-box}
.vzaz-content a{color:inherit}
.vzaz-content p{color:var(--vzaz-muted);line-height:1.72;margin:0 0 1em;text-align:left}
.vzaz-content p:last-child{margin-bottom:0}
.vzaz-content h2,.vzaz-content h3,.vzaz-content h4{color:var(--vzaz-heading);letter-spacing:-.045em;margin:0 0 .7em;text-align:left}
.vzaz-content strong{color:var(--vzaz-soft)}
.vzaz-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vzaz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vzaz-muted);font-size:14.5px;line-height:1.65;text-align:left}
.vzaz-content ul li::before{content:'›';position:absolute;left:0;color:var(--vzaz-accent);font-weight:700}
.vzaz-cnt{width:min(var(--vzaz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vzaz-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vzaz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vzaz-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vzaz-sh.vzaz-left{margin-left:0;text-align:left}
.vzaz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;text-align:left}
.vzaz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;text-align:left}
.vzaz-sh.vzaz-left p{margin-left:0}
.vzaz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(251,191,36,.08);border:1px solid rgba(251,191,36,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vzaz-accent);margin-bottom:14px}
.vzaz-gt{background:linear-gradient(92deg,#fff 0%,var(--vzaz-accent) 44%,var(--vzaz-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vzaz-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vzaz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vzaz-intro-text{position:relative;padding-left:20px;text-align:left}
.vzaz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vzaz-accent),var(--vzaz-violet))}
.vzaz-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vzaz-muted);margin-bottom:1em}
.vzaz-intro-text p:last-child{margin-bottom:0;color:var(--vzaz-soft)}
.vzaz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vzaz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vzaz-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vzaz-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vzaz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vzaz-muted);line-height:1.4}
.vzaz-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vzaz-intro-grid{grid-template-columns:1fr;gap:36px}.vzaz-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vzaz-intro-kpi{grid-template-columns:1fr 1fr}}
.vzaz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vzaz-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vzaz-toc a{display:inline-block;padding:9px 18px;background:var(--vzaz-surface);border:1px solid var(--vzaz-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vzaz-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vzaz-toc a:hover{border-color:rgba(251,191,36,.42);color:var(--vzaz-accent);background:rgba(251,191,36,.08)}
.vzaz-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vzaz-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vzaz-card:hover{border-color:rgba(251,191,36,.28);transform:translateY(-2px)}
.vzaz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:768px){.vzaz-grid-2{grid-template-columns:1fr}}
.vzaz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vzaz-table{width:100%;border-collapse:collapse;font-size:14px}
.vzaz-table th{padding:13px 16px;text-align:left;background:rgba(251,191,36,.1);color:var(--vzaz-accent);font-weight:700;border-bottom:1px solid rgba(251,191,36,.25);white-space:nowrap}
.vzaz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vzaz-text);vertical-align:top;text-align:left}
.vzaz-table tr:last-child td{border-bottom:none}
.vzaz-table tr:hover td{background:rgba(255,255,255,.03)}
.vzaz-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vzaz-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(251,191,36,.1);color:var(--vzaz-accent);border:1px solid rgba(251,191,36,.2)}
.vzaz-flow .arr{color:var(--vzaz-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vzaz-timeline{position:relative;padding-left:40px}
.vzaz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vzaz-accent),var(--vzaz-violet));opacity:.35;border-radius:2px}
.vzaz-tl-item{position:relative;margin-bottom:32px}
.vzaz-tl-item:last-child{margin-bottom:0}
.vzaz-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vzaz-accent);box-shadow:0 0 0 4px rgba(251,191,36,.2)}
.vzaz-tl-item h3{font-size:17px;margin-bottom:8px;text-align:left}
.vzaz-tl-item p{font-size:14.5px;margin:0;text-align:left}
.vzaz-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vzaz-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vzaz-case-grid{grid-template-columns:1fr}}
.vzaz-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.vzaz-case-card:hover{border-color:rgba(74,222,128,.35);transform:translateY(-2px)}
.vzaz-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vzaz-green);margin-bottom:10px}
.vzaz-case-card h3{font-size:16px;margin-bottom:14px;text-align:left}
.vzaz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vzaz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vzaz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vzaz-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;text-align:left}
.vzaz-faq-q::after{content:'▾';font-size:13px;color:var(--vzaz-accent);flex-shrink:0;transition:transform .25s}
.vzaz-faq-item.open .vzaz-faq-q::after{transform:rotate(180deg)}
.vzaz-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vzaz-muted);line-height:1.72;text-align:left}
.vzaz-faq-item.open .vzaz-faq-a{max-height:800px;padding:0 24px 20px}
.vzaz-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.vzaz-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vzaz-muted)}
.vzaz-cta-checklist li::before{content:'✓';color:var(--vzaz-green);font-weight:800}
.vzaz-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(251,191,36,.12),rgba(139,92,246,.1));border:1px solid rgba(251,191,36,.3);text-align:center}
.vzaz-content .ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.vzaz-content .ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.vzaz-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;text-align:inherit}
.vzaz-content .ym-cta-block__sub{color:var(--vzaz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;text-align:inherit}
.vzaz-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.vzaz-content .ym-link--accent{color:var(--vzaz-accent)!important;text-decoration:underline!important}
.vzaz-content .ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.vzaz-content .ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vzaz-btn-from),var(--vzaz-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(249,115,22,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-obrabotka-zayavok-sajta-page" role="main" tabindex="-1">

<section class="nero-ai-hero vzaz-hero-zayavok" id="hero" aria-labelledby="hero-zayavki-title">
<style>
/* ── Hero заявки с сайта: самодостаточные стили (Kadence-safe) ── */
.vzaz-hero-zayavok {
  --vzaz-amber: #fbbf24;
  --vzaz-orange: #f97316;
  --vzaz-violet: #a78bfa;
  --vzaz-cyan: #67e8f9;
  --vzaz-green: #4ade80;
  --vzaz-text: #e8eef8;
  --vzaz-muted: #9aa8bd;
  --vzaz-soft: #c9d4e8;
  --vzaz-shadow: 0 28px 90px rgba(0, 0, 0, 0.45);
}
.vzaz-hero-zayavok.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vzaz-hero-zayavok::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 70%);
  opacity: .5;
  pointer-events: none;
  z-index: -2;
}
.vzaz-hero-zayavok::after {
  content: "";
  position: absolute;
  right: -8%;
  top: 8%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(249, 115, 22, .14), transparent 68%);
  filter: blur(8px);
  animation: vzazHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vzazHeroGlow {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .85; transform: scale(1.05); }
}
.vzaz-hero-zayavok .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vzaz-hero-zayavok .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vzaz-hero-zayavok .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.6vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vzaz-hero-zayavok .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vzaz-amber) 38%, var(--vzaz-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vzaz-hero-zayavok .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(251, 191, 36, 0.22);
  border-radius: 999px;
  background: rgba(249, 115, 22, 0.1);
  color: var(--vzaz-amber) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.vzaz-hero-zayavok .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vzaz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vzaz-hero-zayavok .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vzaz-hero-zayavok .nero-ai-badge {
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
.vzaz-hero-zayavok .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vzaz-hero-zayavok .nero-ai-btn {
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
.vzaz-hero-zayavok .nero-ai-btn:hover { transform: translateY(-2px); }
.vzaz-hero-zayavok .nero-ai-btn-primary {
  color: #1a0a02 !important;
  background: linear-gradient(135deg, var(--vzaz-amber), var(--vzaz-orange));
  box-shadow: 0 18px 42px rgba(249, 115, 22, 0.28);
}
.vzaz-hero-zayavok .nero-ai-btn-secondary {
  color: var(--vzaz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vzaz-hero-zayavok .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.44);
  box-shadow: var(--vzaz-shadow);
  transform: perspective(1100px) rotateY(4deg) rotateX(1deg);
}
.vzaz-hero-zayavok .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .96), rgba(6, 10, 24, .97));
}
.vzaz-hero-zayavok .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.vzaz-hero-zayavok .nero-ai-dots { display: flex; gap: 7px; }
.vzaz-hero-zayavok .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vzaz-hero-zayavok .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vzaz-hero-zayavok .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vzaz-hero-zayavok .nero-ai-dot:nth-child(3) { background: #34d399; }
.vzaz-hero-zayavok .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: 0.02em;
  opacity: .85;
}
.vzaz-hero-zayavok .nero-ai-window-body { padding: 16px 16px 14px; }
.vzaz-hero-zayavok .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.vzaz-hero-zayavok .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 17px;
  font-weight: 800;
  color: #f1f5f9;
  letter-spacing: -0.02em;
}
.vzaz-hero-zayavok .nero-ai-live-pill {
  padding: 5px 10px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 800;
  color: #86efac;
  background: rgba(34, 197, 94, 0.15);
  border: 1px solid rgba(34, 197, 94, 0.35);
}
.vzaz-hero-zayavok .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vzaz-hero-zayavok .nero-ai-metric {
  padding: 10px 12px;
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
}
.vzaz-hero-zayavok .nero-ai-metric span {
  display: block;
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--vzaz-muted);
}
.vzaz-hero-zayavok .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  font-size: 20px;
  font-weight: 900;
  color: #fff;
  letter-spacing: -0.03em;
}
.vzaz-hero-zayavok .nero-ai-metric small {
  display: block;
  margin-top: 2px;
  font-size: 10px;
  color: #94a3b8;
}
.vzaz-hero-zayavok .vzaz-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 0 0 12px;
  border-radius: 16px;
  overflow: hidden;
  background: linear-gradient(145deg, rgba(15,23,42,.6), rgba(30,41,59,.35));
  border: 1px solid rgba(255,255,255,.06);
}
.vzaz-hero-zayavok #vzaz-site-lead-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vzaz-hero-zayavok .nero-ai-task-stream {
  display: flex;
  flex-direction: column;
  gap: 8px;
  max-height: 168px;
  overflow: hidden;
}
.vzaz-hero-zayavok .nero-ai-task {
  display: grid;
  grid-template-columns: 32px 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 9px 10px;
  border-radius: 12px;
  background: rgba(255,255,255,.035);
  border: 1px solid rgba(255,255,255,.06);
  font-size: 12px;
}
.vzaz-hero-zayavok .nero-ai-task-icon {
  width: 32px;
  height: 32px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 800;
  background: rgba(249, 115, 22, 0.15);
  color: var(--vzaz-orange);
}
.vzaz-hero-zayavok .nero-ai-task strong {
  display: block;
  color: #e2e8f0;
  font-size: 12px;
}
.vzaz-hero-zayavok .nero-ai-task span {
  display: block;
  color: #94a3b8;
  font-size: 11px;
  margin-top: 2px;
}
.vzaz-hero-zayavok .nero-ai-status {
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  padding: 4px 8px;
  border-radius: 999px;
  color: #86efac;
  background: rgba(34, 197, 94, 0.12);
  border: 1px solid rgba(34, 197, 94, 0.28);
}
.vzaz-hero-zayavok .nero-ai-status--amber {
  color: #fcd34d;
  background: rgba(251, 191, 36, 0.12);
  border-color: rgba(251, 191, 36, 0.28);
}
@media (max-width: 1023px) {
  .vzaz-hero-zayavok .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vzaz-hero-zayavok .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">AI-агент на сайте · внедрение под ключ</p>
      <h1 id="hero-zayavki-title">AI-агент для первичной обработки заявок с сайта: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Ответ за 5–15 секунд, уточняющие вопросы и горячий лид в CRM — пока менеджеры не в сети</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры">
        <li class="nero-ai-badge">Ответ 5–15 сек</li>
        <li class="nero-ai-badge">2–4 вопроса</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
        <li class="nero-ai-badge">24/7</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация обработки заявки с сайта">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Форма → CRM</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid" aria-label="Метрики демо">
            <div class="nero-ai-metric">
              <span>Первый ответ</span>
              <strong>5–15 с</strong>
              <small>виджет на сайте</small>
            </div>
            <div class="nero-ai-metric">
              <span>Уточняющих вопросов</span>
              <strong>2–4</strong>
              <small>по регламенту продаж</small>
            </div>
            <div class="nero-ai-metric">
              <span>До карточки в CRM</span>
              <strong>~12 с</strong>
              <small>webhook → очередь → API</small>
            </div>
            <div class="nero-ai-metric">
              <span>Режим</span>
              <strong>24/7</strong>
              <small>ночные и выходные лиды</small>
            </div>
          </div>

          <div class="vzaz-dash-canvas-wrap">
            <canvas id="vzaz-site-lead-canvas" role="img" aria-label="Анимация: заявка с формы сайта проходит квалификацию AI и превращается в сделку в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий заявки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🌙</span>
              <div><strong>Форма: «Нужен аудит заявок»</strong><span>23:14 · лендинг / utm=yandex</span></div>
              <span class="nero-ai-status">принято</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Вопрос 2/3: бюджет и срок</strong><span>Скоринг: горячий · confidence 0.91</span></div>
              <span class="nero-ai-status">диалог</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Сделка #4021 · amoCRM</strong><span>Тег hot · задача «перезвонить до 10:00»</span></div>
              <span class="nero-ai-status">создано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⊘</span>
              <div><strong>Дубль по телефону отсечён</strong><span>Обновлена существующая карточка</span></div>
              <span class="nero-ai-status nero-ai-status--amber">dedup</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * vzaz-site-lead-engine — Диспетчерская «Ночной приём лидов»
 * Мир: форма на сайте → webhook-пульс → QualificationConsole → CRM handoff
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vzaz-site-lead-canvas");
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
    scale = Math.min(cw / 440, ch / 300) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    widget: "#1e293b",
    widgetGlow: "rgba(251, 191, 36, 0.35)",
    pulse: "rgba(249, 115, 22, 0.45)",
    packet: "#fde68a",
    crm: "#0f172a",
    crmAccent: "#4ade80",
    hot: "#f97316",
    cool: "#67e8f9",
    consent: "#c4b5fd",
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

  /* Пульсирующая дуга webhook — транспорт (не Conveyor) */
  function WebhookPulseLane() {
    this.phase = 0;
  }
  WebhookPulseLane.prototype.draw = function (ctx) {
    this.phase = (frame * 0.032) % 1;
    ctx.save();
    ctx.strokeStyle = C.pulse;
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 7]);
    ctx.lineDashOffset = -frame * 0.55;
    ctx.beginPath();
    ctx.moveTo(-155, 35);
    ctx.quadraticCurveTo(-40, -55, 55, -15);
    ctx.quadraticCurveTo(120, 10, 150, -40);
    ctx.stroke();
    ctx.setLineDash([]);

    for (var i = 0; i < 4; i++) {
      var t = (this.phase + i * 0.22) % 1;
      var px = -155 + t * 305;
      var py = 35 + Math.sin(t * Math.PI) * -75 + (t > 0.45 ? (t - 0.45) * -40 : 0);
      var size = 8 + (i === 0 ? Math.sin(frame * 0.2) * 2 : 0);
      drawRR(ctx, px - size / 2, py - size / 2, size, size, 2, C.packet, C.outline);
      if (i === 0 && t > 0.1 && t < 0.9) {
        ctx.fillStyle = "#78350f";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("{json}", px, py + 3);
      }
    }
    ctx.restore();
  };

  /* Маяк формы на сайте */
  function SiteFormBeacon() {
    this.blink = 0;
  }
  SiteFormBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.blink = 0.5 + Math.sin(frame * 0.12) * 0.5;
    drawRR(ctx, -168, -8, 52, 68, 8, C.widget, C.outline);
    drawRR(ctx, -160, 0, 36, 8, 3, "#334155", null);
    ctx.fillStyle = "#64748b";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Ваш сайт", -158, 7);
    drawRR(ctx, -160, 14, 36, 22, 4, "#fff", C.outline);
    drawRR(ctx, -156, 40, 28, 6, 2, C.hot, null);

    if (prg < 40 || prg > 220) {
      ctx.fillStyle = "rgba(251,191,36," + this.blink + ")";
      ctx.beginPath();
      ctx.arc(-142, 52, 6 + this.blink * 4, 0, Math.PI * 2);
      ctx.fill();
    }
    if (prg > 8 && prg < 35) {
      drawRR(ctx, -150, 18, 24, 10, 2, C.consent, C.outline);
      ctx.fillStyle = "#312e81";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("ПДн ✓", -142, 26);
    }
  };

  /* Консоль квалификации — вместо WebsiteTerminal */
  function QualificationConsole() {
    this.qIndex = 0;
    this.heat = 0.2;
  }
  QualificationConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 35, -72, 118, 148, 10, C.widget, C.outline);
    drawRR(ctx, 43, -64, 102, 18, 4, "#334155", null);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("AI-агент · виджет", 48, -52);

    var bubbles = [];
    if (prg >= 45 && prg < 95) bubbles = ["Здравствуйте!", "Какой срок?"];
    else if (prg >= 95 && prg < 145) bubbles = ["Бюджет?", "Услуга: аудит"];
    else if (prg >= 145 && prg < 195) bubbles = ["Спасибо!", "Готовлю CRM…"];
    else if (prg >= 45) bubbles = ["Онлайн 24/7"];

    bubbles.forEach(function (txt, i) {
      var by = -38 + i * 22;
      var bw = Math.min(90, 14 + txt.length * 5);
      drawRR(ctx, 50, by, bw, 16, 5, i % 2 ? "rgba(103,232,249,0.2)" : "rgba(255,255,255,0.12)", C.outline);
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "7px Inter,sans-serif";
      ctx.fillText(txt, 54, by + 11);
    });

    if (prg >= 120 && prg < 200) {
      this.heat = 0.35 + ((prg - 120) / 80) * 0.6;
    } else if (prg >= 200) {
      this.heat = 0.95;
    } else {
      this.heat = 0.25 + (prg / 120) * 0.15;
    }
  };

  function ScoringThermometer() {
    this.level = 0.2;
  }
  ScoringThermometer.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg >= 100) this.level = Math.min(1, 0.3 + (prg - 100) / 120);
    else this.level = 0.15 + prg / 600;

    drawRR(ctx, 88, 42, 14, 52, 4, "rgba(255,255,255,0.08)", C.outline);
    var h = 46 * this.level;
    drawRR(ctx, 90, 90 - h, 10, h, 3, this.level > 0.75 ? C.hot : C.cool, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(this.level * 100) + "%", 95, 38);
    if (this.level > 0.8) {
      ctx.fillStyle = C.hot;
      ctx.fillText("HOT", 95, 102);
    }
  };

  function CrmHandoffPanel() {
    this.cardY = 80;
    this.ping = 0;
  }
  CrmHandoffPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -28, 48, 56, 70, 8, C.crm, C.outline);
    ctx.fillStyle = C.crmAccent;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM", 0, 62);

    if (prg >= 190) {
      var lift = Math.min(1, (prg - 190) / 22);
      this.cardY = 72 - lift * 38;
      drawRR(ctx, -34, this.cardY, 68, 36, 6, "rgba(74,222,128,0.22)", C.crmAccent);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("Лид #4021", 0, this.cardY + 14);
      ctx.font = "7px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("задача 09:00", 0, this.cardY + 26);

      if (prg > 205 && prg < 245) {
        this.ping = (prg - 205) / 40;
        ctx.strokeStyle = "rgba(74,222,128," + (0.9 - this.ping * 0.8) + ")";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(0, this.cardY + 18, 12 + this.ping * 35, 0, Math.PI * 2);
        ctx.stroke();
      }
    }

    if (prg >= 215 && prg < 255) {
      drawRR(ctx, 42, 58, 44, 18, 5, "rgba(56,189,248,0.2)", C.cool);
      ctx.fillStyle = "#e0f2fe";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("TG → менеджер", 64, 70);
    }
  };

  function DuplicateShield() {
    this.flash = 0;
  }
  DuplicateShield.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -95, 55, 38, 30, 6, "rgba(148,163,184,0.12)", C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("dedup", -76, 74);
    if (prg > 165 && prg < 185) {
      this.flash = Math.sin((prg - 165) * 0.4);
      ctx.strokeStyle = "rgba(251,191,36," + (0.5 + this.flash * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(-76, 70, 22, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  function NightShiftClock() {
    this.hour = 23;
  }
  NightShiftClock.prototype.draw = function (ctx) {
    this.hour = 22 + Math.floor((frame / 600) % 3);
    ctx.fillStyle = "rgba(255,255,255,0.5)";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText(this.hour + ":14", -175, -58);
    ctx.font = "6px Inter,sans-serif";
    ctx.fillStyle = "#94a3b8";
    ctx.fillText("ночная смена AI", -175, -48);
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
    var prg = (frame * 0.038) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -115, y: 28 },
      "2_seo": { x: -55, y: 38 },
      "3_coder": { x: 5, y: 42 },
      "4_designer": { x: 65, y: 38 },
      "5_deployer": { x: 125, y: 28 }
    };
    var tgt = targets[this.role] || { x: 0, y: 35 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 17) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 6 ? this.color : null;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 16, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 210);
    }

    var bob = Math.sin(this.timer * 1.4) * 1.1;
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
  entities.push(new WebhookPulseLane());
  entities.push(new NightShiftClock());
  entities.push(new SiteFormBeacon());
  entities.push(new DuplicateShield());
  entities.push(new QualificationConsole());
  entities.push(new ScoringThermometer());
  entities.push(new CrmHandoffPanel());
  entities.push(new Agent(-150, 92, C.agentYellow, "1_architect", 20, [
    "Сценарий 2–4 вопроса", "Маппинг полей CRM", "Регламент «горячий»"
  ]));
  entities.push(new Agent(-85, 100, C.agentGreen, "2_seo", 58, [
    "UTM с лендинга ок", "Intent: коммерция", "Не спам-форма"
  ]));
  entities.push(new Agent(-20, 104, C.agentBlue, "3_coder", 98, [
    "Webhook 200 OK", "Очередь Redis", "JSON schema лида"
  ]));
  entities.push(new Agent(45, 100, C.agentPink, "4_designer", 138, [
    "Тексты виджета", "Согласие ПДн в чате", "Тон «услуги»"
  ]));
  entities.push(new Agent(110, 92, C.agentPurple, "5_deployer", 178, [
    "POST lead · 201", "Тег hot_lead", "Алерт в Telegram"
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

    var prg = (frame * 0.038) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-140, 10, "1. Заявка с формы");
    if (prg >= 62 && prg < 62.05) createBubble(-50, -20, "2. Webhook в очередь");
    if (prg >= 108 && prg < 108.05) createBubble(70, -30, "3. Диалог AI");
    if (prg >= 158 && prg < 158.05) createBubble(95, 20, "4. Скоринг лида");
    if (prg >= 208 && prg < 208.05) createBubble(0, 55, "5. Сделка в CRM");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 17, 5, C.bubbleBg, C.hot);
      ctx.fillStyle = C.bubbleText;
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



<div class="vzaz-content">

  <section class="vzaz-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vzaz-cnt">
      <div class="vzaz-intro-grid nero-ai-reveal">
        <div class="vzaz-intro-text">
          <p class="vzaz-eyebrow">Лонгрид · AI заявки с сайта</p>
          <p><strong>Коротко:</strong> Nero Network внедряет <strong>AI-агента</strong> на сайт вместо «мёртвой формы»: первый ответ за <strong>5–15 секунд</strong>, <strong>2–4 уточняющих вопроса</strong>, квалификация лида и <strong>создание сделки в CRM</strong> (amoCRM, Битрикс24 и др.). Услуга <strong>под ключ</strong> для услуг, онлайн-школ и клиник. Стартовый чек по проекту — <strong>120–350 тыс. ₽</strong>.</p>
          <p>Заявка с лендинга — это момент максимального интереса. Пока менеджер в дороге, на совещании или спит, клиент уже сравнивает вас с конкурентами. <strong>AI обработка заявок</strong> на первом касании закрывает разрыв между «отправил форму» и «получил живой ответ» — без найма ночной смены.</p>
        </div>
        <div class="vzaz-intro-kpi" aria-label="Ключевые метрики speed-to-lead">
          <div class="vzaz-kpi-card"><div class="kv">~50%</div><div class="kl">уходят без заказа при ответе &gt;10 мин</div><div class="ks">Телфин / OkoCRM</div></div>
          <div class="vzaz-kpi-card"><div class="kv">5–15 с</div><div class="kl">целевой SLA первого ответа</div><div class="ks">виджет на сайте</div></div>
          <div class="vzaz-kpi-card"><div class="kv">2–4</div><div class="kl">уточняющих вопроса</div><div class="ks">по регламенту продаж</div></div>
          <div class="vzaz-kpi-card"><div class="kv">24/7</div><div class="kl">ночные и выходные лиды</div><div class="ks">без смены менеджеров</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vzaz-toc-outer">
    <div class="vzaz-cnt">
      <nav class="vzaz-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#poteri-zayavok">Потери заявок</a>
        <a href="#chto-takoe-agent">Что такое агент</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#integracii-crm">Интеграции</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#kviz">Аудит</a>
      </nav>
    </div>
  </div>

  <div class="vzaz-cnt" style="padding:0 0 12px">
    <p class="nero-ai-reveal" style="font-size:15px;margin:0">Лиды приходят не только с формы: если заметная доля обращений — из почты, сайт и inbox логично связать через <a href="/vnedrenie-ai-obrabotka-email-crm/" class="ym-link--accent">AI-обработку входящей почты в CRM</a> в одной воронке.</p>
  </div>

  <section class="vzaz-section" id="poteri-zayavok">
    <div class="vzaz-cnt">
      <div class="vzaz-sh vzaz-left nero-ai-reveal">
        <span class="vzaz-eyebrow">Боль</span>
        <h2>Сколько заявок с сайта вы теряете до первого ответа менеджера</h2>
        <p><strong>Определение:</strong> <em>потеря заявок с сайта</em> — лид оставил контакт, но не дождался контакта с компанией в комфортное время и ушёл к конкуренту или отложил решение.</p>
      </div>
      <p class="nero-ai-reveal">По исследованию <strong>Телфин и OkoCRM</strong> (более 7 500 представителей бизнеса, сентябрь 2025) <strong>около половины</strong> клиентов уходят без заказа, если ответ занимает <strong>больше 10 минут</strong>. Для услуг, школ и клиник задержка в часы — не редкость.</p>
      <p class="nero-ai-reveal"><strong>Итог:</strong> узкое место — не реклама, а <strong>скорость первого контакта</strong> (speed-to-lead).</p>
      <div class="vzaz-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vzaz-card">
          <h3>Почему форма на сайте не заменяет живой диалог</h3>
          <p>Классическая форма собирает поля, но не уточняет бюджет, срок, город и не пишет в CRM. Скриптовый бот ломается на свободном тексте — менеджер переносит данные вручную.</p>
        </div>
        <div class="vzaz-card">
          <h3>Ночные и выходные заявки</h3>
          <p>Трафик не выключается в 19:00. Без <strong>ai менеджера заявок</strong> первый человеческий ответ появляется в понедельник — часть лидов уже у конкурентов. Среди внедривших AI для inbound <strong>22,7%</strong> отмечают лучшее покрытие вне рабочего времени (Salesforce, 2026).</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vzaz-section vzaz-section-alt" id="chto-takoe-agent">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Продукт</span>
        <h2>Что такое AI-агент для обработки заявок с сайта (не просто чат)</h2>
        <p><strong>AI-агент для сайта</strong> — слой между формой/виджетом и CRM: отвечает и <strong>выполняет действия</strong> — создаёт сделку, ставит теги, назначает задачу.</p>
      </div>
      <div class="vzaz-table-wrap nero-ai-reveal">
        <table class="vzaz-table" aria-label="Сравнение формы, бота и AI-агента">
          <thead><tr><th>Критерий</th><th>Форма + email</th><th>Скриптовый бот</th><th>AI-агент с CRM</th></tr></thead>
          <tbody>
            <tr><td>Скорость ответа</td><td>Часы</td><td>Секунды</td><td><strong>5–15 с</strong></td></tr>
            <tr><td>Уточняющие вопросы</td><td>Нет</td><td>Кнопки</td><td><strong>2–4</strong> по тексту</td></tr>
            <tr><td>Запись в CRM</td><td>Вручную</td><td>Редко</td><td><strong>Автоматически</strong></td></tr>
            <tr><td>Ночь / выходные</td><td>Потери</td><td>Частично</td><td><strong>24/7</strong></td></tr>
          </tbody>
        </table>
      </div>
      <div class="vzaz-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="vzaz-card">
          <h3>От FAQ-бота к агенту с действиями в CRM</h3>
          <p>Тренд 2025–2026 — agentic automation: AI проходит первый этап воронки. Агент видит диалог и данные CRM (кейс Velmi + Bitrix24 на Хабре).</p>
        </div>
        <div class="vzaz-card">
          <h3>Задачи ai менеджера заявок</h3>
          <ul>
            <li>Фиксация UTM и источника</li>
            <li>2–4 вопроса по матрице продаж</li>
            <li>Скоринг: горячий / тёплый / отказ</li>
            <li>Сделка, задача, резюме диалога в CRM</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

<section id="vnedrenie-ai-obrabotka-zayavok-sajta-boris-block" class="bzas-root" aria-label="Анимация: webhook, очередь и квалификация заявки с сайта до карточки CRM">
<style>
/* === БОРИС: prefix bzas-, scoped внутри #vnedrenie-ai-obrabotka-zayavok-sajta-boris-block === */
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block.bzas-root{
  padding:48px 0 56px;
  background:#f8fafc;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:460px;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-lft{
  padding:36px 32px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:28px 22px;
  }
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0ea5e9;
  margin:0 0 12px;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0ea5e9;
  border-radius:1px;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-h3{
  font-size:clamp(19px,2.3vw,25px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 16px;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-ul{
  list-style:none;
  margin:0 0 20px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0284c7;
  margin-top:1px;
  font-style:normal;
  font-weight:700;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:16px;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-rgt{
  position:relative;
  background:linear-gradient(145deg,#f0f9ff 0%,#e0f2fe 40%,#f8fafc 100%);
  min-height:400px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-sajta-boris-block .bzas-rgt{min-height:340px;}
}
#bzas-site-agent-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bzas-cnt">
  <div class="bzas-card">
    <div class="bzas-lft">
      <span class="bzas-ey">Архитектура · не «магический чат»</span>
      <h3 class="bzas-h3">Заявка с лендинга проходит webhook и очередь — агент квалифицирует до записи в CRM</h3>
      <ul class="bzas-ul">
        <li><span class="bzas-ic">1</span>Форма или виджет отдаёт событие за <strong>&lt;1 с</strong> — тяжёлая логика уходит в async (важно для Bitrix24)</li>
        <li><span class="bzas-ic">2</span>Агент отвечает за <strong>5–15 с</strong> и задаёт <strong>2–4</strong> уточняющих вопроса по свободному тексту</li>
        <li><span class="bzas-ic">3</span>Скоринг → ветка: сделка в CRM, мягкий отказ или <code style="font-size:12px">human_review</code></li>
        <li><span class="bzas-ic">✓</span>В карточке — резюме диалога, теги и задача менеджеру, не «сырой телефон»</li>
      </ul>
      <div class="bzas-pills">
        <span class="bzas-pl bzas-pl-b">Webhook 200 OK</span>
        <span class="bzas-pl bzas-pl-g">5–15 с SLA</span>
        <span class="bzas-pl bzas-pl-v">amoCRM / Битрикс24</span>
      </div>
      <p class="bzas-foot">Дальше разберём пошаговый сценарий от клика до горячего лида →</p>
    </div>
    <div class="bzas-rgt">
      <canvas
        id="bzas-site-agent-pipeline-canvas"
        role="img"
        aria-label="Анимация: заявка с сайта проходит webhook и очередь, AI задаёт вопросы и создаёт карточку сделки в CRM"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bzas-site-agent-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    line:'rgba(14,165,233,.4)',
    form:'#ffffff',
    formBdr:'#cbd5e1',
    hook:'#8b5cf6',
    hookGlow:'rgba(139,92,246,.2)',
    queue:'#f1f5f9',
    queueBdr:'#94a3b8',
    agent:'#0ea5e9',
    bubbleUser:'#e0f2fe',
    bubbleAi:'#ffffff',
    crm:'#0284c7',
    hot:'#22c55e',
    packet:'#f59e0b'
  };

  var PHASE = 520;
  var cycle = 0;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){
      ctx.strokeStyle=stroke;
      ctx.lineWidth=lw||1.5;
      ctx.stroke();
    }
  }

  function drawLabel(txt,x,y,size,color,align){
    ctx.fillStyle=color||C.ink;
    ctx.font=(size||11)+'px system-ui,sans-serif';
    ctx.textAlign=align||'center';
    ctx.fillText(txt,x,y);
  }

  function drawForm(x,y,w,h,alpha){
    ctx.globalAlpha=alpha;
    rr(x,y,w,h,10,C.form,C.formBdr);
    rr(x+12,y+14,w-24,8,4,'#e2e8f0',C.formBdr);
    rr(x+12,y+28,w-24,8,4,'#e2e8f0',C.formBdr);
    rr(x+12,y+48,w-24,22,6,C.agent,null);
    drawLabel('Отправить',x+w/2,y+63,10,'#fff');
    drawLabel('Форма сайта',x+w/2,y+h+16,10,C.muted);
    ctx.globalAlpha=1;
  }

  function drawWebhook(x,y,s,pulse){
    var g = 1 + Math.sin(pulse)*0.06;
    ctx.save();
    ctx.translate(x,y);
    ctx.scale(g,g);
    rr(-s/2,-s/2,s,s,8,C.hook,C.ink);
    drawLabel('hook',0,4,9,'#fff');
    ctx.restore();
    drawLabel('Webhook',x,y+s/2+14,10,C.muted);
  }

  function drawQueue(x,y,w,h,spin){
    rr(x,y,w,h,8,C.queue,C.queueBdr);
    drawLabel('Очередь',x+w/2,y+16,10,C.muted);
    var cx = x+w/2, cy = y+h/2+8;
    for(var i=0;i<3;i++){
      var a = spin + i*(Math.PI*2/3);
      var dx = Math.cos(a)*14, dy = Math.sin(a)*10;
      ctx.fillStyle=C.agent;
      ctx.beginPath();
      ctx.arc(cx+dx,cy+dy,5,0,Math.PI*2);
      ctx.fill();
    }
  }

  function drawChat(x,y,w,h,step){
    rr(x,y,w,h,12,C.bubbleAi,C.formBdr);
    drawLabel('AI-агент',x+14,y+18,10,C.agent,'left');
    var by = y+32;
    var msgs = [
      {who:'ai', t:'Здравствуйте! Уточню пару вопросов по заявке.'},
      {who:'u', t:'Нужна консультация, бюджет ~150 тыс.'},
      {who:'ai', t:'Срок — в течение месяца?'},
      {who:'u', t:'Да, на следующей неделе.'}
    ];
    for(var i=0;i<msgs.length;i++){
      if(step < i) break;
      var m = msgs[i];
      var bw = w - 28;
      var bh = 22;
      var bx = x+14;
      if(m.who==='u') bx = x+w-bw-14;
      rr(bx,by,bw,bh,6,m.who==='ai'?C.bubbleAi:C.bubbleUser,C.formBdr);
      ctx.fillStyle=C.ink;
      ctx.font='10px system-ui,sans-serif';
      ctx.textAlign='left';
      var txt = m.t.length>36 ? m.t.slice(0,34)+'…' : m.t;
      ctx.fillText(txt,bx+8,by+14);
      by += 28;
    }
  }

  function drawCrmCard(x,y,w,h,prog){
    rr(x,y,w,h,10,'#fff',C.crm,2);
    drawLabel('CRM · сделка',x+14,y+20,10,C.crm,'left');
    var fields = ['Имя: Анна','Услуга: внедрение AI','Бюджет: 120–150 тыс.','Срок: &lt; 1 мес'];
    var fy = y+32;
    for(var j=0;j<fields.length;j++){
      if(prog < j*0.22) break;
      var fw = w-28;
      var fillW = Math.min(1,(prog-j*0.22)/0.22)*fw;
      rr(x+14,fy,fw,18,4,'#f1f5f9',C.formBdr);
      rr(x+14,fy,fillW,18,4,'#e0f2fe',null);
      ctx.fillStyle=C.ink;
      ctx.font='10px system-ui,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(fields[j].replace('&lt;','<'),x+20,fy+12);
      fy += 24;
    }
    if(prog > 0.85){
      rr(x+14,y+h-32,w-28,22,99,'rgba(34,197,94,.15)',C.hot);
      drawLabel('Горячий лид',x+w/2,y+h-17,10,C.hot);
    }
  }

  function drawPacket(px,py,alpha){
    ctx.globalAlpha=alpha;
    ctx.fillStyle=C.packet;
    ctx.beginPath();
    ctx.arc(px,py,7,0,Math.PI*2);
    ctx.fill();
    ctx.strokeStyle=C.ink;
    ctx.lineWidth=1.2;
    ctx.stroke();
    ctx.globalAlpha=1;
  }

  function drawArrow(x1,y1,x2,y2,alpha){
    ctx.globalAlpha=alpha||0.5;
    ctx.strokeStyle=C.line;
    ctx.lineWidth=2;
    ctx.beginPath();
    ctx.moveTo(x1,y1);
    ctx.lineTo(x2,y2);
    ctx.stroke();
    var ang = Math.atan2(y2-y1,x2-x1);
    ctx.beginPath();
    ctx.moveTo(x2,y2);
    ctx.lineTo(x2-8*Math.cos(ang-0.4),y2-8*Math.sin(ang-0.4));
    ctx.lineTo(x2-8*Math.cos(ang+0.4),y2-8*Math.sin(ang+0.4));
    ctx.closePath();
    ctx.fillStyle=C.line;
    ctx.fill();
    ctx.globalAlpha=1;
  }

  function frame(){
    t++;
    cycle = (t % PHASE) / PHASE;
    ctx.clearRect(0,0,W,H);

    var pad = Math.max(12,W*0.04);
    var midY = H*0.52;
    var formW = Math.min(88,W*0.14);
    var formH = 78;
    var fx = pad + formW/2;
    var fy = midY - formH/2;

    var hookX = W*0.28;
    var qx = W*0.42;
    var qw = W*0.16;
    var qh = 72;
    var chatX = W*0.58;
    var chatW = W*0.22;
    var chatH = Math.min(200,H*0.48);
    var crmX = W - pad - Math.min(120,W*0.18);
    var crmW = Math.min(120,W*0.18);
    var crmH = Math.min(168,H*0.42);

    drawForm(fx-formW/2,fy-formH/2,formW,formH,1);
    drawWebhook(hookX,midY,36,t*0.08);
    drawQueue(qx-qw/2,midY-qh/2,qw,qh,t*0.12);

    var chatStep = 0;
    if(cycle > 0.35) chatStep = Math.min(3,Math.floor((cycle-0.35)/0.12));
    drawChat(chatX-chatW/2,midY-chatH/2-10,chatW,chatH,chatStep);

    var crmProg = 0;
    if(cycle > 0.55) crmProg = Math.min(1,(cycle-0.55)/0.35);
    drawCrmCard(crmX-crmW/2,midY-crmH/2,crmW,crmH,crmProg);

    var pktT = Math.max(0,Math.min(1,(cycle*1.15)));
    var path = [
      {x:fx+formW/2,y:midY},
      {x:hookX,y:midY},
      {x:qx,y:midY},
      {x:chatX-chatW/2+20,y:midY},
      {x:crmX-crmW/2,y:midY}
    ];
    for(var k=0;k<path.length-1;k++){
      drawArrow(path[k].x,path[k].y,path[k+1].x,path[k+1].y,0.35);
    }
    var seg = pktT * (path.length-1);
    var si = Math.floor(seg);
    var st = seg - si;
    if(si < path.length-1){
      var px = path[si].x + (path[si+1].x-path[si].x)*st;
      var py = path[si].y + (path[si+1].y-path[si].y)*st;
      drawPacket(px,py,0.95);
    }

    requestAnimationFrame(frame);
  }
  requestAnimationFrame(frame);
})();
</script>
</section>


  <section class="vzaz-section" id="kak-rabotaet">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Сценарий</span>
        <h2>Как работает сценарий: от клика по форме до горячего лида в CRM</h2>
        <p><strong>Коротко:</strong> форма → webhook → агент за секунды → квалификация → CRM → бриф менеджеру.</p>
      </div>
      <div class="vzaz-flow nero-ai-reveal" aria-label="Шаги обработки заявки">
        <span>Форма / виджет</span><span class="arr">→</span>
        <span>Webhook &lt;1 с</span><span class="arr">→</span>
        <span>AI 5–15 с</span><span class="arr">→</span>
        <span>2–4 вопроса</span><span class="arr">→</span>
        <span>Скоринг</span><span class="arr">→</span>
        <span>Сделка в CRM</span>
      </div>
      <div class="vzaz-timeline nero-ai-reveal">
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Ответ за 5–15 секунд</h3><p>SLA виджета: пользователь не уходит со страницы в «тишину» после формы.</p></div>
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Скоринг и передача менеджеру</h3><p>Спорные кейсы — в очередь модерации с уведомлением в Telegram.</p></div>
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Логи и согласие на ПДн</h3><p>152-ФЗ: явное согласие; guardrails и RAG — без выдуманных цен (RevSure/Ascend2: privacy 54%, accuracy 47% барьеров).</p></div>
      </div>
      
<div class="ym-cta-block ym-cta-block--primary vzas-cta-audit" id="cta-audit-scenario">
  <div class="ym-cta-block__icon" aria-hidden="true">⚡</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Проверить, сколько заявок вы теряете</p>
    <p class="ym-cta-block__sub">За 30 минут разберём формы, ночной трафик и SLA первого ответа — сопоставим с порогом 10 минут из исследования Телфин/OkoCRM и покажем, где AI-агент на сайте даст максимальный эффект.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>

    </div>
  </section>

  <section class="vzaz-section vzaz-section-alt" id="integracii-crm">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">CRM</span>
        <h2>Интеграция AI обработки заявок с CRM</h2>
        <p><strong>Интеграция ai обработка заявок с crm</strong> — ядро услуги: без записи в систему агент остаётся чатом, который игнорируют.</p>
      </div>
      <div class="vzaz-grid-2 nero-ai-reveal">
        <div class="vzaz-card">
          <h3>amoCRM, Битрикс24 и другие</h3>
          <p>Сделка из диалога, дедупликация по телефону. Если amoCRM — основной контур продаж, см. отдельную услугу <a href="/vnedrenie-ai-amocrm/" class="ym-link--accent">внедрение AI-агента в amoCRM под ключ</a>. Кейс MrBoroAI: запуск 2–8 недель. Velmi: ответ 2–3 ч → 30–40 с, квалифицированные лиды +35% (Хабр).</p>
        </div>
        <div class="vzaz-card">
          <h3>Webhook, Make/n8n</h3>
          <p>Виджет на Tilda, WordPress, Bitrix → Make/n8n/FastAPI → LLM structured output → CRM. Когда после квалификации нужен учёт в 1С или ERP, смотрите смежный сценарий — <a href="/ai-1c-erp/" class="ym-link--accent">AI-агент для 1С и ERP: внедрение под ключ</a>. G2: 9 из 10 считают критичным единый customer data перед автономией агента.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vzaz-section" id="etapy">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Под ключ</span>
        <h2>Внедрение AI в бизнес-процессы продаж: этапы под ключ</h2>
      </div>
      <div class="vzaz-timeline nero-ai-reveal">
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Аудит потерь заявок (30 минут)</h3><p>Формы, SLA, ночные пики, дубли в CRM — карта узких мест.</p></div>
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Проектирование сценария</h3><p>Скрипт продаж, критерии «горячего», RAG по FAQ; тест на 50–100 диалогах.</p></div>
        <div class="vzaz-tl-item"><div class="vzaz-tl-dot"></div><h3>Запуск на сайте и сопровождение</h3><p>Пилот 2–3 недели: time-to-first-response, доля автоквалификации, конверсия в созвон.</p></div>
      </div>
      
<aside class="ym-cta-block ym-cta-block--secondary vzas-cta-obuchenie" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать логику до старта проекта?</p>
    <p class="ym-cta-block__sub">На этапе проектирования сценария и приёмки пилота полезно разобрать webhook, human-in-the-loop и промпты — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>. Это ускоряет согласование регламентов с отделом продаж.</p>
  </div>
</aside>

    </div>
  </section>

  <section class="vzaz-section vzaz-section-alt" id="ceny">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Бюджет</span>
        <h2>Стоимость и сроки: ai обработка заявок для бизнеса</h2>
        <p>Ориентир Nero Network: <strong>120–350 тыс. ₽</strong> за стартовый проект + поддержка.</p>
      </div>
      <div class="vzaz-table-wrap nero-ai-reveal">
        <table class="vzaz-table" aria-label="Из чего складывается чек">
          <thead><tr><th>Компонент</th><th>Содержание</th></tr></thead>
          <tbody>
            <tr><td>Аудит и сценарий</td><td>Воронка, критерии горячего лида</td></tr>
            <tr><td>Backend</td><td>Webhook, очередь, guardrails</td></tr>
            <tr><td>CRM</td><td>Маппинг полей, дедупликация</td></tr>
            <tr><td>RAG и пилот</td><td>Обучение менеджеров, аналитика</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px">Кейс Савви: cost per lead снизился с 116 ₽ до 54 ₽ при +35% заявок (данные заказчика) — не гарантия для каждого проекта.</p>
    </div>
  </section>

  <section class="vzaz-section" id="keisy">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">Доверие</span>
        <h2>Примеры внедрения AI и кейсы (услуги, EdTech, клиники)</h2>
      </div>
      <div class="vzaz-case-grid">
        <div class="vzaz-case-card nero-ai-reveal"><div class="vzaz-case-tag">Velmi</div><h3>Bitrix24</h3><p>Ответ 2–3 ч → 30–40 с, квалифицированные лиды +35%.</p></div>
        <div class="vzaz-case-card nero-ai-reveal nero-ai-delay-1"><div class="vzaz-case-tag">BESTERS</div><h3>Авито + Bitrix24</h3><p>95% первички без менеджера, 6500+ сообщений (workspace.ru).</p></div>
        <div class="vzaz-case-card nero-ai-reveal nero-ai-delay-2"><div class="vzaz-case-tag">MrBoroAI</div><h3>amoCRM</h3><p>Сделка из диалога, запуск 2–8 недель.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px">На корпоративном масштабе те же принципы triage и маршрутизации заявок разбираются в материале <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" class="ym-link--accent">KPMG и Claude: уроки AI для бизнеса</a> — цифровые шлюзы и managed-агенты, которые можно адаптировать к inbound с сайта.</p>
      <p class="nero-ai-reveal" style="margin-top:12px"><strong>Когда агент не нужен:</strong> мало заявок, менеджер отвечает за минуты, нет ночного трафика — честный отказ повышает доверие.</p>
    </div>
  </section>

  <section class="vzaz-section vzaz-section-alt" id="faq">
    <div class="vzaz-cnt">
      <div class="vzaz-sh nero-ai-reveal">
        <span class="vzaz-eyebrow">FAQ</span>
        <h2>FAQ: как внедрить AI обработку заявок на сайт</h2>
      </div>
      <div class="vzaz-faq nero-ai-reveal">
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai обработка заявок без хаоса в CRM?</div><div class="vzaz-faq-a"><p>Одна точка входа, маппинг полей, дедупликация, пилот 2–3 недели. Nero Network ведёт внедрение под ключ.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Чем ai консультант на сайт отличается от колл-центра?</div><div class="vzaz-faq-a"><p>24/7 в момент интереса, стандартизированные вопросы, запись в CRM. Колл-центр — для сложных переговоров.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли без программиста?</div><div class="vzaz-faq-a"><p>Да: подрядчик настраивает виджет и интеграции; с вашей стороны — скрипт продаж и доступ к CRM.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">AI соврёт клиенту?</div><div class="vzaz-faq-a"><p>Guardrails, RAG по утверждённым документам, запрет автообещаний, эскалация спорных диалогов.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Подойдёт ли для малого бизнеса?</div><div class="vzaz-faq-a"><p>Да, при потоке заявок с сайта и заметной задержке ответа. Типовой вход — одна форма.</p></div></div>
        <div class="vzaz-faq-item"><div class="vzaz-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится внедрение?</div><div class="vzaz-faq-a"><p>От 7–21 дня за простой сценарий до 2–8 недель при сложной CRM.</p></div></div>
      </div>
    </div>
  </section>

  <section class="vzaz-section" id="kviz" style="background:linear-gradient(135deg,rgba(251,191,36,.08),rgba(139,92,246,.08));">
    <div class="vzaz-cnt" style="text-align:center">
      <span class="vzaz-eyebrow">Квиз</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px;text-align:center">Проверить, сколько заявок вы теряете</h2>
      <p style="max-width:580px;margin:0 auto 28px;font-size:16px;text-align:center">Аудит потерь заявок за 30 минут: SLA, ночной трафик, симуляция обработки заявки — webhook → очередь → AI → CRM.</p>
      <ul class="vzaz-cta-checklist">
        <li>Сопоставление с порогом 10 минут</li>
        <li>Карта форм и дублей в CRM</li>
        <li>Схема под ваш сайт</li>
        <li>Без обязательств</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </section>

</div><!-- /.vzaz-content -->


<?php
$vzaz_page_url  = trailingslashit( get_permalink() );
$vzaz_site_url  = trailingslashit( home_url( '/' ) );
$vzaz_brand     = $brand ?: 'Nero Network';
$vzaz_page_h1   = 'AI-агент для первичной обработки заявок с сайта: внедрение под ключ';
$vzaz_schema    = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => $vzaz_site_url . '#organization',
            'name'  => $vzaz_brand,
            'url'   => $vzaz_site_url,
        ],
        [
            '@type'     => 'WebSite',
            '@id'       => $vzaz_site_url . '#website',
            'url'       => $vzaz_site_url,
            'name'      => $vzaz_brand,
            'publisher' => [ '@id' => $vzaz_site_url . '#organization' ],
        ],
        [
            '@type'       => 'WebPage',
            '@id'         => $vzaz_page_url . '#webpage',
            'url'         => $vzaz_page_url,
            'name'        => $vzaz_page_h1,
            'description' => $page_seo_description,
            'isPartOf'    => [ '@id' => $vzaz_site_url . '#website' ],
            'about'       => [ '@id' => $vzaz_site_url . '#organization' ],
        ],
        [
            '@type'           => 'BreadcrumbList',
            '@id'             => $vzaz_page_url . '#breadcrumb',
            'itemListElement' => [
                [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vzaz_site_url ],
                [ '@type' => 'ListItem', 'position' => 2, 'name' => $vzaz_page_h1, 'item' => $vzaz_page_url ],
            ],
        ],
        [
            '@type'       => 'Service',
            '@id'         => $vzaz_page_url . '#service',
            'name'        => $vzaz_page_h1,
            'description' => $page_seo_description,
            'url'         => $vzaz_page_url,
            'provider'    => [ '@id' => $vzaz_site_url . '#organization' ],
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => $vzaz_page_url . '#faq',
            'mainEntity' => [
                [ '@type' => 'Question', 'name' => 'Как внедрить ai обработка заявок без хаоса в CRM?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Одна точка входа, маппинг полей, дедупликация, пилот 2–3 недели. Nero Network ведёт внедрение под ключ.' ] ],
                [ '@type' => 'Question', 'name' => 'Чем ai консультант на сайт отличается от колл-центра?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '24/7 в момент интереса, стандартизированные вопросы, запись в CRM. Колл-центр — для сложных переговоров.' ] ],
                [ '@type' => 'Question', 'name' => 'Можно ли без программиста?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да: подрядчик настраивает виджет и интеграции; с вашей стороны — скрипт продаж и доступ к CRM.' ] ],
                [ '@type' => 'Question', 'name' => 'AI соврёт клиенту?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Guardrails, RAG по утверждённым документам, запрет автообещаний, эскалация спорных диалогов.' ] ],
                [ '@type' => 'Question', 'name' => 'Подойдёт ли для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, при потоке заявок с сайта и заметной задержке ответа. Типовой вход — одна форма.' ] ],
                [ '@type' => 'Question', 'name' => 'Сколько длится внедрение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'От 7–21 дня за простой сценарий до 2–8 недель при сложной CRM.' ] ],
            ],
        ],
    ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vzaz_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
?>

</main>

<script>
(function(){
  document.querySelectorAll('.vzaz-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vzaz-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vzaz-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vzaz-faq-q');if(q)q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
    });
    btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root=document.querySelector('.vzaz-content');
  if(!root)return;
  var items=root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver' in window){
    var observer=new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){entry.target.classList.add('nero-ai-active');observer.unobserve(entry.target);}
      });
    },{threshold:0.1,rootMargin:'0px 0px -6% 0px'});
    items.forEach(function(item){observer.observe(item);});
  }else{items.forEach(function(item){item.classList.add('nero-ai-active');});}
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
