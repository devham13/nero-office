<?php
/**
 * Template Name: AI-агент для первичной обработки заявок с сайта: внедрение под ключ
 * Description: Внедрим AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, квалификация и передача горячего лида в CRM.
 */

declare(strict_types=1);

$page_seo_title       = 'AI обработка заявок с сайта: внедрение агента под ключ';
$page_seo_description = 'Внедрим AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, уточняющие вопросы и передача горячего лида в CRM. Аудит потерь заявок за 30 минут.';

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
    ['label' => 'Проблема', 'href' => '#pochemu-ostyvayut'],
    ['label' => 'Сценарий', 'href' => '#kak-rabotaet'],
    ['label' => 'CRM', 'href' => '#integraciya-crm'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
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
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Материалы для команды';
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
/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}


/* Hero заявки с сайта — самодостаточно, префикс vnaz-hero-zayavki */
.vnaz-hero-zayavki {
  --vnaz-cyan: #79f2ff;
  --vnaz-violet: #8b5cf6;
  --vnaz-amber: #fbbf24;
  --vnaz-green: #22c55e;
  --vnaz-text: #e6edf7;
  --vnaz-muted: #9aa8bd;
  --vnaz-soft: #c7d2e5;
  --vnaz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnaz-hero-zayavki.nero-ai-hero {
  position: relative;
  min-height: min(960px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 128px) 0 clamp(44px, 7vw, 80px);
  isolation: isolate;
}
.vnaz-hero-zayavki::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.032) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.032) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 70%);
  opacity: .5;
  pointer-events: none;
  z-index: -2;
}
.vnaz-hero-zayavki::after {
  content: "";
  position: absolute;
  right: -8%;
  top: 8%;
  width: min(720px, 90vw);
  height: min(720px, 90vw);
  border-radius: 50%;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 68%);
  filter: blur(8px);
  animation: vnazHeroViolet 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnazHeroViolet {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .85; transform: scale(1.05); }
}
.vnaz-hero-zayavki .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnaz-hero-zayavki .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(340px, .95fr);
  gap: clamp(28px, 4vw, 52px);
  align-items: center;
}
.vnaz-hero-zayavki .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vnaz-hero-zayavki .nero-ai-gradient-text {
  display: block;
  margin-top: .12em;
  background: linear-gradient(92deg, #fff 0%, var(--vnaz-cyan) 42%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnaz-hero-zayavki .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnaz-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.vnaz-hero-zayavki .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 700px;
  color: var(--vnaz-soft) !important;
  font-size: clamp(17px, 1.85vw, 20px);
  line-height: 1.58;
}
.vnaz-hero-zayavki .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.vnaz-hero-zayavki .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.vnaz-hero-zayavki .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 32px;
}
.vnaz-hero-zayavki .nero-ai-btn {
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
.vnaz-hero-zayavki .nero-ai-btn:hover { transform: translateY(-2px); }
.vnaz-hero-zayavki .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnaz-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnaz-hero-zayavki .nero-ai-btn-secondary {
  color: var(--vnaz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnaz-hero-zayavki .nero-ai-dashboard {
  position: relative;
  padding: 16px;
  border-radius: 32px;
  background: rgba(2, 6, 23, 0.45);
  box-shadow: var(--vnaz-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(1.5deg);
}
.vnaz-hero-zayavki .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 24px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .96), rgba(6, 10, 24, .97));
}
.vnaz-hero-zayavki .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 12px 14px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.vnaz-hero-zayavki .nero-ai-dots { display: flex; gap: 7px; }
.vnaz-hero-zayavki .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnaz-hero-zayavki .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnaz-hero-zayavki .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnaz-hero-zayavki .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnaz-hero-zayavki .nero-ai-window-title {
  color: #b8cce8;
  font-size: 10px;
  font-weight: 750;
  letter-spacing: .09em;
  text-transform: uppercase;
}
.vnaz-hero-zayavki .nero-ai-window-body { padding: 14px; }
.vnaz-hero-zayavki .nero-ai-dashboard-title {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 10px;
}
.vnaz-hero-zayavki .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 17px;
  letter-spacing: -0.02em;
  color: #fff;
  font-weight: 800;
}
.vnaz-hero-zayavki .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 10px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
.vnaz-hero-zayavki .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--vnaz-green);
  box-shadow: 0 0 0 5px rgba(34,197,94,.14);
  animation: vnazPulse 1.5s infinite;
}
@keyframes vnazPulse {
  0%, 100% { transform: scale(.88); opacity: .7; }
  50% { transform: scale(1); opacity: 1; }
}
.vnaz-hero-zayavki .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 8px;
  margin-bottom: 10px;
}
.vnaz-hero-zayavki .nero-ai-metric {
  padding: 10px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 14px;
  background: rgba(255,255,255,.05);
  text-align: left;
}
.vnaz-hero-zayavki .nero-ai-metric span {
  display: block;
  color: var(--vnaz-muted);
  font-size: 10px;
  font-weight: 700;
  line-height: 1.2;
}
.vnaz-hero-zayavki .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  color: #fff;
  font-size: 20px;
  line-height: 1;
}
.vnaz-hero-zayavki .vnaz-dash-canvas-wrap {
  position: relative;
  height: clamp(200px, 28vw, 260px);
  margin: 0 0 10px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 50% 35%, rgba(121,242,255,.07), rgba(6,10,24,.92) 72%);
}
.vnaz-hero-zayavki #vnaz-hero-lead-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnaz-hero-zayavki .nero-ai-task-stream { display: grid; gap: 7px; }
.vnaz-hero-zayavki .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 9px;
  padding: 9px 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 12px;
  background: rgba(255,255,255,.04);
}
.vnaz-hero-zayavki .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 10px;
  background: rgba(121,242,255,.12);
  color: var(--vnaz-cyan);
  font-size: 11px;
  font-weight: 800;
}
.vnaz-hero-zayavki .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnaz-hero-zayavki .nero-ai-task span {
  color: var(--vnaz-muted);
  font-size: 11px;
}
.vnaz-hero-zayavki .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnaz-hero-zayavki .nero-ai-status--hot {
  background: rgba(251, 191, 36, .15);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vnaz-hero-zayavki .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnaz-hero-zayavki .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnaz-hero-zayavki .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .vnaz-hero-zayavki .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnaz-hero-zayavki .nero-ai-status { grid-column: 2; width: fit-content; }
}

/* VNAZ content root */

.vnaz-content{
  --vnaz-bg:#050711;--vnaz-bg2:#080b17;--vnaz-surface:rgba(255,255,255,.072);
  --vnaz-text:#e6edf7;--vnaz-muted:#9aa8bd;--vnaz-soft:#c7d2e5;--vnaz-heading:#fff;
  --vnaz-border:rgba(255,255,255,.10);--vnaz-accent:#79f2ff;--vnaz-violet:#8b5cf6;--vnaz-green:#22c55e;
  --vnaz-btn-from:#2563eb;--vnaz-btn-to:#7c3aed;--vnaz-r:18px;--vnaz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnaz-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vnaz-content *,.vnaz-content *::before,.vnaz-content *::after{box-sizing:border-box}
.vnaz-content a{color:inherit}
.vnaz-content p{color:var(--vnaz-muted);line-height:1.72;margin:0 0 1em}
.vnaz-content p:last-child{margin-bottom:0}
.vnaz-content h2,.vnaz-content h3,.vnaz-content h4{color:var(--vnaz-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vnaz-content strong{color:var(--vnaz-soft)}
.vnaz-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vnaz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnaz-muted);font-size:14.5px;line-height:1.65}
.vnaz-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnaz-accent);font-weight:700}
.vnaz-cnt{width:min(var(--vnaz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vnaz-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vnaz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vnaz-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vnaz-sh.vnaz-left{margin-left:0;text-align:left}
.vnaz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vnaz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vnaz-sh.vnaz-left p{margin-left:0}
.vnaz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnaz-accent);margin-bottom:14px}
.vnaz-gt{background:linear-gradient(92deg,#fff 0%,var(--vnaz-accent) 44%,var(--vnaz-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vnaz-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vnaz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vnaz-intro-text{position:relative;padding-left:20px}
.vnaz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vnaz-accent),var(--vnaz-violet))}
.vnaz-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vnaz-muted);margin-bottom:1em}
.vnaz-intro-text p:last-child{margin-bottom:0;color:var(--vnaz-soft)}
.vnaz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vnaz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vnaz-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vnaz-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vnaz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnaz-muted);line-height:1.4}
.vnaz-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vnaz-intro-grid{grid-template-columns:1fr;gap:36px}.vnaz-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vnaz-intro-kpi{grid-template-columns:1fr 1fr}}
.vnaz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vnaz-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vnaz-toc a{display:inline-block;padding:9px 18px;background:var(--vnaz-surface);border:1px solid var(--vnaz-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vnaz-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vnaz-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vnaz-accent);background:rgba(121,242,255,.08)}
.vnaz-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vnaz-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vnaz-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.vnaz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vnaz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vnaz-grid-2,.vnaz-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.vnaz-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnaz-grid-3{grid-template-columns:1fr}}
.vnaz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vnaz-table{width:100%;border-collapse:collapse;font-size:14px}
.vnaz-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vnaz-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vnaz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vnaz-text);vertical-align:top}
.vnaz-table tr:last-child td{border-bottom:none}
.vnaz-table tr:hover td{background:rgba(255,255,255,.03)}
.vnaz-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vnaz-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vnaz-accent);border:1px solid rgba(121,242,255,.2)}
.vnaz-flow .arr{color:var(--vnaz-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vnaz-timeline{position:relative;padding-left:40px}
.vnaz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnaz-accent),var(--vnaz-violet));opacity:.35;border-radius:2px}
.vnaz-tl-item{position:relative;margin-bottom:32px}
.vnaz-tl-item:last-child{margin-bottom:0}
.vnaz-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnaz-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vnaz-tl-item h3{font-size:17px;margin-bottom:8px}
.vnaz-tl-item p{font-size:14.5px;margin:0}
.vnaz-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vnaz-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnaz-case-grid{grid-template-columns:1fr}}
.vnaz-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.vnaz-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.vnaz-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnaz-green);margin-bottom:10px}
.vnaz-case-card h3{font-size:16px;margin-bottom:14px}
.vnaz-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.vnaz-metric .num{font-size:20px;font-weight:900;color:var(--vnaz-accent);flex-shrink:0}
.vnaz-metric .lbl{font-size:13px;color:var(--vnaz-muted)}
.vnaz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vnaz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vnaz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnaz-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vnaz-faq-q::after{content:'▾';font-size:13px;color:var(--vnaz-accent);flex-shrink:0;transition:transform .25s}
.vnaz-faq-item.open .vnaz-faq-q::after{transform:rotate(180deg)}
.vnaz-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vnaz-muted);line-height:1.72}
.vnaz-faq-item.open .vnaz-faq-a{max-height:800px;padding:0 24px 20px}
.vnaz-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.vnaz-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vnaz-muted)}
.vnaz-cta-checklist li::before{content:'✓';color:var(--vnaz-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vnaz-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vnaz-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vnaz-btn-from),var(--vnaz-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
.vnaz-prose{max-width:820px;margin:0 auto}
.vnaz-prose.vnaz-left{margin-left:0;margin-right:auto}
.vnaz-h3{font-size:clamp(18px,2.2vw,22px);margin:28px 0 14px;color:var(--vnaz-heading)}
.vnaz-stat-callout{display:flex;gap:16px;align-items:flex-start;margin:32px 0;padding:22px 24px;border-radius:16px;border:1px solid rgba(121,242,255,.35);background:rgba(121,242,255,.06);text-align:left}
.vnaz-stat-callout__icon{font-size:28px;line-height:1;flex-shrink:0}
.vnaz-stat-callout p{margin:0;color:var(--vnaz-soft);font-size:15px;line-height:1.65}
.vnaz-steps{display:grid;grid-template-columns:repeat(6,1fr);gap:10px;margin:28px 0 36px;list-style:none;padding:0;counter-reset:none}
.vnaz-steps li{display:flex;flex-direction:column;gap:8px;padding:14px 12px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);font-size:12.5px;line-height:1.45;color:var(--vnaz-muted)}
.vnaz-step-num{display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:50%;background:rgba(121,242,255,.15);color:var(--vnaz-accent);font-weight:800;font-size:13px}
@media(max-width:900px){.vnaz-steps{grid-template-columns:1fr 1fr}}
@media(max-width:520px){.vnaz-steps{grid-template-columns:1fr}}
.vnaz-flow-arr{color:var(--vnaz-muted);font-size:16px;padding:0 2px;background:none;border:none}
.vnaz-alert{padding:18px 22px;border-radius:14px;border:1px solid rgba(251,191,36,.45);background:rgba(251,191,36,.08);margin:20px 0 28px;text-align:left}
.vnaz-alert p{margin:0;color:var(--vnaz-soft);font-size:14.5px;line-height:1.65}
.vnaz-table-wrap--glow{box-shadow:0 0 40px rgba(139,92,246,.12)}
.vnaz-row-highlight td{background:rgba(139,92,246,.08)!important}
.vnaz-row-highlight td:first-child{color:var(--vnaz-violet);font-weight:700}
.vnaz-checklist{list-style:none;padding:0;margin:24px 0;max-width:640px}
.vnaz-checklist li{position:relative;padding:12px 16px 12px 44px;margin-bottom:10px;border-radius:12px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);color:var(--vnaz-muted);font-size:14.5px}
.vnaz-checklist li::before{content:'✓';position:absolute;left:16px;top:12px;color:var(--vnaz-green);font-weight:800}
.vnaz-section--cta{background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08))!important}
.vnaz-lead{font-size:clamp(16px,1.8vw,18px);max-width:640px;margin:0 auto 24px;color:var(--vnaz-muted)}
.vnaz-footnote{font-size:13px;color:#64748b;margin-top:24px;max-width:560px;margin-left:auto;margin-right:auto}
.ym-cta-block--footer-final{margin:48px 0 64px;background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.08));border-color:rgba(121,242,255,.25)}
.vnaz-faq details.vnaz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;margin-bottom:10px;overflow:hidden}
.vnaz-faq summary.vnaz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnaz-heading);cursor:pointer;list-style:none}
.vnaz-faq summary.vnaz-faq-q::-webkit-details-marker{display:none}
.vnaz-faq .vnaz-faq-a{padding:0 24px 20px;font-size:14.5px;color:var(--vnaz-muted);line-height:1.72}
.vnaz-cta-audit{text-align:left;display:flex;gap:20px;align-items:flex-start;max-width:var(--vnaz-container);margin:32px auto;padding:32px 36px}
@media(max-width:768px){.vnaz-cta-audit{flex-direction:column;text-align:center}}

</style>

<main id="primary" class="site-main nero-ai-home-page vnaz-page vnedrenie-ai-obrabotka-zayavok-s-sayta-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnaz-hero-zayavki" id="hero" aria-labelledby="hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai обработка заявок</p>
      <h1 id="hero-title">AI-агент для первичной обработки заявок с сайта:<span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Отвечаем на заявки за 5–15 секунд, квалифицируем лид и передаём в CRM — пока конкуренты молчат ночью и в выходные</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры внедрения">
        <li class="nero-ai-badge">5–15 секунд</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
        <li class="nero-ai-badge">24/7</li>
        <li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает сценарий</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-обработка заявок с сайта">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>заявки · ai agent</h3>
            <span class="nero-ai-live-pill">онлайн 24/7</span>
          </div>
          <div class="nero-ai-metrics-grid" aria-label="Метрики демо-сценария">
            <div class="nero-ai-metric"><span>первый ответ</span><strong>8 сек</strong></div>
            <div class="nero-ai-metric"><span>диалог</span><strong>3</strong><span style="font-size:10px;margin-top:2px">уточняющих вопроса</span></div>
            <div class="nero-ai-metric"><span>скоринг</span><strong>hot</strong><span style="font-size:10px;margin-top:2px">в CRM</span></div>
          </div>
          <div class="vnaz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnaz-hero-lead-canvas" role="img" aria-label="Анимация: ночная заявка с формы сайта квалифицируется AI и уходит в CRM"></canvas>
          </div>
          <div class="nero-ai-task-stream" aria-label="Мини-чат обработки заявки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🌙</span>
              <div><strong>Форма с сайта · 23:14</strong><span>Webhook · страница услуги</span></div>
              <span class="nero-ai-status">вход</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Агент: уточняю срок и бюджет</strong><span>Ответ за 8 сек · квалификация</span></div>
              <span class="nero-ai-status">диалог</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Сделка создана · amoCRM</strong><span>Тег hot · задача менеджеру</span></div>
              <span class="nero-ai-status nero-ai-status--hot">hot</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  'use strict';
  var cv = document.getElementById('vnaz-hero-lead-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var cw = 0, ch = 0, frame = 0, cx = 0, cy = 0;
  var phase = 0;
  var phaseTick = 0;

  function resize() {
    var p = cv.parentElement;
    if (!p) return;
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    cw = p.clientWidth;
    ch = p.clientHeight;
    cv.width = Math.floor(cw * dpr);
    cv.height = Math.floor(ch * dpr);
    cv.style.width = cw + 'px';
    cv.style.height = ch + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    cx = cw * 0.5;
    cy = ch * 0.52;
  }
  window.addEventListener('resize', resize);
  resize();

  var COL = {
    line: 'rgba(121,242,255,.35)',
    panel: '#0f172a',
    panelEdge: 'rgba(255,255,255,.12)',
    hot: '#fbbf24',
    green: '#22c55e',
    violet: '#a78bfa'
  };

  var dialogs = [
    'Ночная заявка — не ждём утра',
    'Три вопроса до скоринга',
    'Webhook уже в очереди',
    'Поле «срочность» заполнено',
    'Эскалация только при сомнении',
    'CRM получит summary диалога'
  ];

  function bubble(x, y, text) {
    ctx.font = '600 10px system-ui,sans-serif';
    var tw = ctx.measureText(text).width;
    var w = tw + 16;
    var h = 22;
    ctx.fillStyle = 'rgba(15,23,42,.92)';
    ctx.strokeStyle = COL.line;
    ctx.lineWidth = 1;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x - w / 2, y - h, w, h, 8);
    else ctx.rect(x - w / 2, y - h, w, h);
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = '#e2e8f0';
    ctx.fillText(text, x - tw / 2, y - h + 14);
  }

  function Agent(x, y, color, role) {
    this.x = x; this.y = y; this.color = color; this.role = role;
    this.tx = x; this.ty = y;
    this.bubbleT = Math.random() * 400 | 0;
    this.dir = 1;
  }
  Agent.prototype.step = function () {
    this.x += (this.tx - this.x) * 0.04;
    this.y += (this.ty - this.y) * 0.04;
    this.bubbleT++;
    if (this.bubbleT > 220) {
      this.bubbleT = 0;
      if (Math.random() < 0.35) bubble(this.x, this.y - 18, dialogs[(frame + this.role) % dialogs.length]);
    }
    ctx.fillStyle = this.color;
    ctx.strokeStyle = '#0f172a';
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = '#0f172a';
    ctx.fillRect(this.x - 4, this.y + 5, 8, 9);
  };

  function LeadIntakeConsole(x, y) {
    this.x = x; this.y = y;
    this.glow = 0;
  }
  LeadIntakeConsole.prototype.draw = function () {
    this.glow = 0.5 + 0.5 * Math.sin(frame * 0.04);
    var w = 88, h = 64;
    ctx.fillStyle = COL.panel;
    ctx.strokeStyle = COL.panelEdge;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(this.x - w / 2, this.y - h / 2, w, h, 10);
    else ctx.rect(this.x - w / 2, this.y - h / 2, w, h);
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = 'rgba(121,242,255,' + (0.15 + this.glow * 0.2) + ')';
    ctx.fillRect(this.x - w / 2 + 8, this.y - h / 2 + 10, w - 16, 14);
    ctx.fillStyle = '#94a3b8';
    ctx.font = '700 9px monospace';
    ctx.fillText('FORM · 23:14', this.x - 32, this.y - h / 2 + 20);
    for (var i = 0; i < 3; i++) {
      ctx.fillStyle = 'rgba(148,163,184,.5)';
      ctx.fillRect(this.x - 30 + i * 22, this.y - 4, 18, 4);
    }
    if (phase >= 2) {
      ctx.fillStyle = COL.hot;
      ctx.font = '800 10px system-ui';
      ctx.fillText('HOT', this.x - 14, this.y + 18);
    }
  };

  function ChannelPulseRing(x, y, r) {
    this.x = x; this.y = y; this.r = r;
    this.t = 0;
  }
  ChannelPulseRing.prototype.draw = function () {
    this.t = (frame * 0.018 + phase * 0.4) % 1;
    ctx.strokeStyle = COL.line;
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.r, Math.PI * 0.85, Math.PI * 2.15);
    ctx.stroke();
    var ang = Math.PI * 0.85 + this.t * Math.PI * 1.3;
    var px = this.x + Math.cos(ang) * this.r;
    var py = this.y + Math.sin(ang) * this.r;
    ctx.fillStyle = COL.violet;
    ctx.beginPath();
    ctx.arc(px, py, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = '#fff';
    ctx.font = '700 8px system-ui';
    ctx.fillText('lead', px - 10, py - 8);
  };

  function CrmGatewayArc(x, y) {
    this.x = x; this.y = y;
    this.flash = 0;
  }
  CrmGatewayArc.prototype.draw = function () {
    if (phase === 3) this.flash = Math.min(1, this.flash + 0.06);
    else this.flash *= 0.92;
    ctx.strokeStyle = 'rgba(34,197,94,' + (0.35 + this.flash * 0.5) + ')';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 28, -Math.PI / 2, Math.PI / 2);
    ctx.stroke();
    ctx.fillStyle = '#bbf7d0';
    ctx.font = '700 9px system-ui';
    ctx.fillText('amo', this.x - 10, this.y + 4);
  };

  function MoonShiftClock(x, y) {
    this.x = x; this.y = y;
  }
  MoonShiftClock.prototype.draw = function () {
    ctx.fillStyle = 'rgba(251,191,36,.25)';
    ctx.beginPath();
    ctx.arc(this.x, this.y, 10, 0.2, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = '#fde68a';
    ctx.font = '700 9px monospace';
    ctx.fillText('23h', this.x - 12, this.y + 22);
  };

  var ring = new ChannelPulseRing(cx, cy, Math.min(cw, ch) * 0.32);
  var consoleHub = new LeadIntakeConsole(cx, cy);
  var gateway = new CrmGatewayArc(cx + Math.min(cw, ch) * 0.34, cy);
  var moon = new MoonShiftClock(cx - Math.min(cw, ch) * 0.36, cy - 40);
  var agents = [
    new Agent(cx - 70, cy + 50, '#eab308', 1),
    new Agent(cx - 20, cy + 58, '#10b981', 2),
    new Agent(cx + 30, cy + 52, '#3b82f6', 3),
    new Agent(cx + 75, cy + 48, '#ec4899', 4),
    new Agent(cx, cy + 70, '#8b5cf6', 5)
  ];

  function setPhaseTargets() {
    var targets = [
      [{ x: cx - 55, y: cy + 42 }, { x: cx - 10, y: cy + 48 }, { x: cx + 35, y: cy + 44 }, { x: cx + 60, y: cy + 38 }, { x: cx - 5, y: cy + 62 }],
      [{ x: cx - 40, y: cy + 28 }, { x: cx - 5, y: cy + 32 }, { x: cx + 20, y: cy + 30 }, { x: cx + 45, y: cy + 26 }, { x: cx + 5, y: cy + 38 }],
      [{ x: cx - 25, y: cy + 18 }, { x: cx, y: cy + 20 }, { x: cx + 22, y: cy + 18 }, { x: cx + 48, y: cy + 14 }, { x: cx + 12, y: cy + 28 }],
      [{ x: cx + 55, y: cy + 10 }, { x: cx + 70, y: cy + 6 }, { x: cx + 85, y: cy + 8 }, { x: cx + 95, y: cy + 4 }, { x: cx + 78, y: cy + 16 }]
    ];
    var t = targets[phase] || targets[3];
    for (var i = 0; i < agents.length; i++) {
      agents[i].tx = t[i].x;
      agents[i].ty = t[i].y;
    }
  }

  function tickPhase() {
    phaseTick++;
    if (phaseTick > 280) {
      phaseTick = 0;
      phase = (phase + 1) % 4;
      setPhaseTargets();
      if (phase === 1) bubble(cx, cy - 50, 'Уточняю срок и бюджет');
      if (phase === 2) bubble(cx - 20, cy - 40, 'Скоринг: hot');
      if (phase === 3) bubble(gateway.x, gateway.y - 30, 'Сделка в amoCRM');
    }
  }

  setPhaseTargets();

  function loop() {
    frame++;
    tickPhase();
    ctx.clearRect(0, 0, cw, ch);
    moon.draw();
    ring.draw();
    consoleHub.draw();
    gateway.draw();
    for (var j = 0; j < agents.length; j++) agents[j].step();
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>

<div class="vnaz-content">

  <section class="vnaz-intro" id="vnaz-intro">
    <div class="vnaz-cnt">
      <div class="vnaz-intro-grid nero-ai-reveal">
        <div class="vnaz-intro-text">
          <p><strong>Коротко:</strong> AI-агент — программный слой между формой, чатом или мессенджером и вашей CRM. Он отвечает за <strong>5–15 секунд</strong>, уточняет запрос, квалифицирует лид и передаёт <strong>горячую</strong> карточку менеджеру — без ручного копирования и без «молчания» ночью и в выходные.</p>
          <p>Заявка с сайта — деньги, которые вы уже оплатили рекламой или SEO. Если первый ответ приходит через час или только в понедельник, клиент часто уходит к конкуренту. <strong>Внедрение AI обработки заявок</strong> закрывает разрыв между ожиданиями рынка (минуты) и реальностью малого бизнеса (ночь и выходные без ответа).</p>
        </div>
        <div class="vnaz-intro-kpi" aria-hidden="false">
          <div class="vnaz-kpi-card"><div class="kv">5–15 сек</div><div class="kl">первый ответ AI</div></div>
          <div class="vnaz-kpi-card"><div class="kv">24/7</div><div class="kl">без выходных</div></div>
          <div class="vnaz-kpi-card"><div class="kv">hot</div><div class="kl">лид в CRM</div></div>
          <div class="vnaz-kpi-card"><div class="kv">30 мин</div><div class="kl">аудит потерь</div></div>
        </div>
      </div>
      <nav class="vnaz-toc ym-toc nero-ai-reveal" aria-label="Оглавление статьи">
        <a href="#pochemu-ostyvayut">Проблема</a>
        <a href="#chto-takoe-agent">AI-агент</a>
        <a href="#kak-rabotaet">Сценарий</a>
        <a href="#integraciya-crm">CRM</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#audit-potery">Аудит</a>
      </nav>
    </div>
  </section>

  <section class="vnaz-section" id="pochemu-ostyvayut">
    <div class="vnaz-cnt">
      <div class="vnaz-sh vnaz-left nero-ai-reveal">
        <span class="vnaz-eyebrow">Боль · SLA</span>
        <h2>Почему заявки с сайта «остывают» ночью и в выходные</h2>
        <p><strong>Определение:</strong> «Остывший лид» — обращение, по которому первый осмысленный контакт задержался настолько, что клиент перестал ждать или ушёл к конкуренту.</p>
      </div>
      <div class="vnaz-prose nero-ai-reveal">
        <ul>
          <li>форма уходит в почту или CRM «как есть», менеджер видит её утром;</li>
          <li>чат активен только в рабочие часы;</li>
          <li>мессенджер отвечает «перезвоним завтра»;</li>
          <li>ночные и выходные обращения копятся без SLA.</li>
        </ul>
        <p>Исследование <strong>Телфин</strong> и <strong>OkoCRM</strong> (CNews, ноябрь 2025): <strong>примерно половина клиентов уходит без заказа, если ответ дольше 10 минут</strong>. Callibri (2025) рекомендует для чата SLA первого ответа <strong>не более одной минуты</strong>; в B2B <strong>15–20% звонков</strong> и <strong>10–15% чатов</strong> остаются без своевременной реакции.</p>
      </div>
      <blockquote class="vnaz-stat-callout nero-ai-reveal" cite="https://www.cnews.ru/news/line/2025-11-24_issledovanie_telfin_i">
        <span class="vnaz-stat-callout__icon" aria-hidden="true">⏱</span>
        <p>Порог рынка: <strong>~10 минут</strong> ожидания — и до половины клиентов уходит без заказа (Телфин + OkoCRM, 2025). Оффер «5–15 секунд» попадает в разрыв между нормой и реальностью SMB вне графика.</p>
      </blockquote>
      <div class="vnaz-prose nero-ai-reveal" id="skolko-lidov-teryaetsya">
        <h3>Сколько лидов теряется из‑за медленного ответа</h3>
        <p>Универсальных цифр «X% заявок гибнет ночью» для всех ниш нет — мы не выдумываем их. Логика аудита:</p>
        <ol>
          <li>доля обращений <strong>вне рабочих часов</strong>;</li>
          <li>среднее время первого ответа по CRM или почте;</li>
          <li>сравнение с порогом <strong>10 минут</strong> для вашего сегмента.</li>
        </ol>
        <p><strong>Проверить, сколько заявок вы теряете</strong> — первый шаг перед внедрением: экспресс-<strong>аудит потерь заявок за 30 минут</strong> (Nero Network).</p>
      </div>
    </div>
  </section>

  <aside class="ym-cta-block ym-cta-block--primary vnaz-cta-audit" id="cta-pochemu">
    <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Проверить, сколько заявок вы теряете</p>
      <p class="ym-cta-block__sub">Экспресс-аудит за 30 минут: доля обращений ночью и в выходные, ваш SLA против порога 10 минут на рынке и точки, где лид зависает между формой и CRM.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </aside>

  <section class="vnaz-section vnaz-section-alt" id="chto-takoe-agent">
    <div class="vnaz-cnt">
      <div class="vnaz-sh vnaz-left nero-ai-reveal">
        <span class="vnaz-eyebrow">Ядро услуги</span>
        <h2>Что такое AI-агент для первичной обработки заявок</h2>
        <p><strong>AI-агент для сайта</strong> понимает свободный текст, ведёт диалог по правилам бизнеса, извлекает поля лида и <strong>выполняет действия</strong> в CRM: сделка, задача, теги, summary для менеджера.</p>
      </div>
      <h3 class="vnaz-h3 nero-ai-reveal">Чем отличается от обычного чат-бота</h3>
      <div class="vnaz-table-wrap nero-ai-reveal">
        <table class="vnaz-table" aria-label="Сравнение скриптового чат-бота и AI-агента для заявок">
          <thead>
            <tr><th>Критерий</th><th>Скриптовый чат-бот</th><th>AI-агент для заявок</th></tr>
          </thead>
          <tbody>
            <tr><td>Понимание</td><td>Кнопки и ветки</td><td>Свободный текст, уточнения</td></tr>
            <tr><td>Квалификация</td><td>Пункт меню</td><td>Скоринг hot/warm/cold</td></tr>
            <tr><td>CRM</td><td>Часто вручную</td><td>Structured output → API</td></tr>
            <tr><td>Ночь и выходные</td><td>«Оставьте заявку»</td><td>Диалог и передача лида</td></tr>
            <tr><td>Ошибки</td><td>«Нажмите 1»</td><td>Эскалация при низкой уверенности</td></tr>
          </tbody>
        </table>
      </div>
      <h3 class="vnaz-h3 nero-ai-reveal" id="kanaly-zayavok">Какие каналы закрывает: форма, виджет, мессенджер</h3>
      <div class="vnaz-prose nero-ai-reveal">
        <p>Один агент обслуживает <strong>три входа</strong> с единой логикой: форма (webhook), виджет чата, мессенджер (с учётом 152-ФЗ). Угол Nero Network — не разрозненные боты, а <strong>единая квалификация</strong> и одна карточка в CRM.</p>
      </div>
    </div>
  </section>



<section id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block" class="vbz-root" aria-label="Анимация: три канала заявок сходятся в AI-агент и передают hot-лид в CRM">
<style>
/* === БОРИС: prefix vbz-, scoped внутри #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block === */
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block.vbz-root{padding:56px 0 64px;background:#f8fafc;}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-card{
  display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:460px;
}
@media(max-width:1023px){#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-card{grid-template-columns:1fr;min-height:auto;}}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0ea5e9;margin:0 0 14px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-ey::before{content:'';width:18px;height:2px;background:#0ea5e9;border-radius:1px;}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#0284c7;margin-top:1px;font-style:normal;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-rgt{
  position:relative;background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 45%,#f8fafc 100%);min-height:400px;overflow:hidden;
}
@media(max-width:1023px){#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .vbz-rgt{min-height:340px;}}
#vbz-lead-triad-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="vbz-cnt">
  <div class="vbz-card">
    <div class="vbz-lft">
      <span class="vbz-ey">Три канала · один агент</span>
      <h3 class="vbz-h3">Форма, чат и мессенджер сходятся в единую квалификацию — без трёх разных ботов</h3>
      <ul class="vbz-ul">
        <li><span class="vbz-ic">1</span>Webhook с формы открывает диалог за секунды, а не «утром в CRM»</li>
        <li><span class="vbz-ic">2</span>Виджет чата и мессенджер делят одну базу знаний и скоринг hot/warm/cold</li>
        <li><span class="vbz-ic">3</span>Structured output создаёт карточку в amoCRM или Битрикс24 с summary</li>
        <li><span class="vbz-ic">?</span>Спорный кейс уходит в human_review — менеджер видит флаг, не сырой чат</li>
      </ul>
      <div class="vbz-pills">
        <span class="vbz-pl vbz-pl-b">5–15 сек</span>
        <span class="vbz-pl vbz-pl-g">24/7</span>
        <span class="vbz-pl vbz-pl-v">единый score</span>
      </div>
      <p class="vbz-foot">Дальше разберём пошаговый сценарий за 5–15 секунд →</p>
    </div>
    <div class="vbz-rgt">
      <canvas id="vbz-lead-triad-canvas" role="img" aria-label="Анимация: заявки из формы, чата и мессенджера проходят через AI-агент и попадают в CRM как hot-лид"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('vbz-lead-triad-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, t = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a', muted:'#64748b', line:'rgba(14,165,233,.35)',
    form:'#3b82f6', chat:'#8b5cf6', msg:'#22c55e', ai:'#0ea5e9',
    crm:'#0369a1', hot:'#ef4444', card:'#ffffff', cardB:'#cbd5e1'
  };

  var hubs = { aiX: 0, aiY: 0, crmX: 0, crmY: 0 };
  function layout(){
    hubs.aiX = W * 0.52; hubs.aiY = H * 0.48;
    hubs.crmX = W * 0.82; hubs.crmY = H * 0.48;
  }

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.2; ctx.stroke(); }
  }

  var sources = [
    { key:'form', label:'Форма', color:C.form, sx:W*0.08, sy:H*0.22 },
    { key:'chat', label:'Чат', color:C.chat, sx:W*0.08, sy:H*0.48 },
    { key:'msg',  label:'Мессенджер', color:C.msg, sx:W*0.08, sy:H*0.74 }
  ];

  var packets = [];
  var sla = { phase:0, sec:15, label:'SLA' };

  function spawn(){
    var s = sources[Math.floor(Math.random()*sources.length)];
    packets.push({
      x:s.sx, y:s.sy, sx:s.sx, sy:s.sy, color:s.color, label:s.label,
      stage:0, prog:0, speed:0.008+Math.random()*0.006
    });
  }

  function drawSource(s, pulse){
    var r = 26 + pulse*4;
    ctx.font = '600 11px Inter, system-ui, sans-serif';
    ctx.textAlign = 'center';
    rr(s.sx-r, s.sy-r, r*2, r*2, 12, s.color+'22', s.color);
    ctx.fillStyle = C.ink;
    ctx.fillText(s.label, s.sx, s.sy+4);
    ctx.beginPath();
    ctx.arc(s.sx, s.sy, 6, 0, Math.PI*2);
    ctx.fillStyle = s.color;
    ctx.fill();
  }

  function drawAiHub(pulse){
    var x=hubs.aiX, y=hubs.aiY, r=34+pulse*6;
    var g=ctx.createRadialGradient(x,y,0,x,y,r*2.2);
    g.addColorStop(0,'rgba(14,165,233,.28)');
    g.addColorStop(1,'rgba(14,165,233,0)');
    ctx.fillStyle=g;
    ctx.beginPath(); ctx.arc(x,y,r*2,0,Math.PI*2); ctx.fill();
    rr(x-r,y-r,r*2,r*2,16,C.ai,'#0284c7');
    ctx.fillStyle='#fff';
    ctx.font='700 12px Inter, system-ui';
    ctx.textAlign='center';
    ctx.fillText('AI', x, y+4);
    ctx.font='500 10px Inter, system-ui';
    ctx.fillStyle='#e0f2fe';
    ctx.fillText('5–15 сек', x, y+18);
  }

  function drawCrmCard(alpha){
    var x=hubs.crmX-52, y=hubs.crmY-38, w=104, h=76;
    ctx.globalAlpha = alpha;
    rr(x,y,w,h,10,C.card,C.cardB);
    ctx.fillStyle=C.ink; ctx.font='700 11px Inter'; ctx.textAlign='left';
    ctx.fillText('amoCRM · hot', x+10, y+22);
    ctx.fillStyle=C.muted; ctx.font='10px Inter';
    ctx.fillText('summary диалога', x+10, y+38);
    rr(x+10,y+48,36,14,4,C.hot+'33',C.hot);
    ctx.fillStyle=C.hot; ctx.font='700 9px Inter'; ctx.textAlign='center';
    ctx.fillText('HOT', x+28, y+58);
    ctx.globalAlpha=1;
  }

  function drawSla(){
    var x=W*0.52, y=H*0.12;
    var sec = Math.max(5, Math.round(15 - (t*0.02)%11));
    rr(x-48,y-16,96,32,99,'#fff','#bae6fd');
    ctx.fillStyle=C.ink; ctx.font='700 13px Inter'; ctx.textAlign='center';
    ctx.fillText(sec+' сек', x, y+4);
  }

  function tick(){
    t++;
    layout();
    ctx.clearRect(0,0,W,H);

    // grid
    ctx.strokeStyle='rgba(148,163,184,.15)';
    ctx.lineWidth=1;
    for(var i=0;i<6;i++){
      var gy=H*0.15+i*(H*0.7/5);
      ctx.beginPath(); ctx.moveTo(W*0.05,gy); ctx.lineTo(W*0.95,gy); ctx.stroke();
    }

    var pulse = 0.5+0.5*Math.sin(t*0.06);
    sources.forEach(function(s,i){
      s.sx=W*0.1; s.sy=H*(0.22+0.26*i);
      drawSource(s, pulse);
    });

    if (t % 45 === 0) spawn();

    packets.forEach(function(p){
      p.prog += p.speed;
      if (p.stage===0){
        var tx=hubs.aiX, ty=hubs.aiY;
        p.x = p.sx + (tx-p.sx)*Math.min(1,p.prog);
        p.y = p.sy + (ty-p.sy)*Math.min(1,p.prog);
        if (p.prog>=1){ p.stage=1; p.prog=0; }
      } else {
        var tx=hubs.crmX, ty=hubs.crmY;
        p.x = hubs.aiX + (tx-hubs.aiX)*Math.min(1,p.prog);
        p.y = hubs.aiY + (ty-hubs.aiY)*Math.min(1,p.prog);
        if (p.prog>=1) p.dead=true;
      }
      ctx.beginPath(); ctx.arc(p.x,p.y,7,0,Math.PI*2);
      ctx.fillStyle=p.color; ctx.fill();
    });
    packets = packets.filter(function(p){ return !p.dead; });

    // connector lines
    ctx.setLineDash([4,6]);
    sources.forEach(function(s){
      ctx.strokeStyle=C.line; ctx.lineWidth=1.5;
      ctx.beginPath(); ctx.moveTo(s.sx+20,s.sy); ctx.lineTo(hubs.aiX-30,hubs.aiY); ctx.stroke();
    });
    ctx.setLineDash([]);
    ctx.strokeStyle=C.line;
    ctx.beginPath(); ctx.moveTo(hubs.aiX+30,hubs.aiY); ctx.lineTo(hubs.crmX-55,hubs.crmY); ctx.stroke();

    drawAiHub(pulse);
    drawCrmCard(0.85+0.15*pulse);
    drawSla();
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
</section>



  <section class="vnaz-section" id="kak-rabotaet">
    <div class="vnaz-cnt">
      <div class="vnaz-sh nero-ai-reveal">
        <span class="vnaz-eyebrow">Оффер</span>
        <h2>Как работает сценарий за 5–15 секунд</h2>
        <p>Типовая логика <strong>автоматизации через ai обработку заявок</strong> (проектная модель Nero Network).</p>
      </div>
      <ol class="vnaz-steps nero-ai-reveal" aria-label="Шесть шагов сценария">
        <li><span class="vnaz-step-num">1</span><span>Событие: форма или чат → webhook (&lt;1 с)</span></li>
        <li><span class="vnaz-step-num">2</span><span>Контекст: UTM, страница, contact_id</span></li>
        <li><span class="vnaz-step-num">3</span><span>Ответ + 1–3 уточняющих вопроса</span></li>
        <li><span class="vnaz-step-num">4</span><span>JSON: имя, телефон, score, summary</span></li>
        <li><span class="vnaz-step-num">5</span><span>Запись в amoCRM / Битрикс24, задача менеджеру</span></li>
        <li><span class="vnaz-step-num">6</span><span>Спорный кейс → human_review</span></li>
      </ol>
      <div class="vnaz-prose nero-ai-reveal">
        <h3 id="privetstvie-kontekst">Приветствие и сбор контекста</h3>
        <p>Агент подтверждает запрос, не дублирует поля формы; тон зависит от ниши (клиника, школа, услуги B2C).</p>
        <h3 id="skoring-lida">Уточняющие вопросы и скоринг лида</h3>
        <p><strong>Квалификация лидов ai</strong> по вашему скрипту: обязательные поля, запретные обещания, порог hot/warm/cold.</p>
        <h3 id="eskalaciya">Эскалация на менеджера, когда AI не уверен</h3>
        <p>При низкой уверенности, жалобе или вопросе вне whitelist — стоп-бот, карточка «требует менеджера», уведомление без лишних ПДн.</p>
      </div>
    </div>
  </section>

  <section class="vnaz-section vnaz-section-alt" id="integraciya-crm">
    <div class="vnaz-cnt">
      <div class="vnaz-sh vnaz-left nero-ai-reveal">
        <span class="vnaz-eyebrow">Интеграции</span>
        <h2>Интеграция с CRM: горячий лид без ручного копирования</h2>
        <p><strong>Ai обработка заявок с crm</strong> — обязательный блок внедрения под ключ.</p>
      </div>
      <div class="vnaz-flow nero-ai-reveal" aria-label="Схема данных webhook LLM CRM">
        <span>Сайт / чат / мессенджер</span><span class="vnaz-flow-arr">→</span>
        <span>webhook</span><span class="vnaz-flow-arr">→</span>
        <span>LLM + JSON</span><span class="vnaz-flow-arr">→</span>
        <span>CRM API</span><span class="vnaz-flow-arr">→</span>
        <span>задача · уведомление</span>
      </div>
      <div class="vnaz-prose nero-ai-reveal">
        <h3>amoCRM и Битрикс24 — типовые поля и сделки</h3>
        <p>Штатный AI-агент amoCRM закрывает чаты внутри CRM; <strong>кастомный слой</strong> нужен для формы на WordPress/Tilda, нескольких каналов и жёстких политик ПДн. BitrixGPT чаще обрабатывает уже поступившие обращения — не заменяет первый контакт на сайте за секунды.</p>
        <h3>Что передаём в карточку лида</h3>
        <p>Контакты (с согласием), UTM, услуга, score, <strong>summary</strong> диалога, next_action, флаг эскалации.</p>
      </div>
    </div>
  </section>

  <section class="vnaz-section" id="etapy">
    <div class="vnaz-cnt">
      <div class="vnaz-sh vnaz-left nero-ai-reveal">
        <span class="vnaz-eyebrow">Под ключ</span>
        <h2>Внедрение AI обработки заявок под ключ: этапы и сроки</h2>
        <p>Пилот <strong>2–4 недели</strong>, затем продакшен и сопровождение.</p>
      </div>
      <div class="vnaz-timeline nero-ai-reveal">
        <div class="vnaz-tl-item">
          <span class="vnaz-tl-dot" aria-hidden="true"></span>
          <h3>Аудит текущей воронки и точек входа заявок</h3>
          <p>Каналы, SLA, поля CRM, база знаний, политика ПДн — на выходе ТЗ на сценарии.</p>
        </div>
        <div class="vnaz-tl-item">
          <span class="vnaz-tl-dot" aria-hidden="true"></span>
          <h3>Настройка сценариев и тест на реальных обращениях</h3>
          <p>RAG, guardrails, пилот на одном канале, еженедельный разбор эскалаций.</p>
        </div>
        <div class="vnaz-tl-item">
          <span class="vnaz-tl-dot" aria-hidden="true"></span>
          <h3>Запуск 24/7 и сопровождение</h3>
          <p>Дашборд SLA, idempotency по lead_id, обновление whitelist без дрейфа модели.</p>
        </div>
      </div>
    </div>
  </section>

  <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Команда хочет понимать процесс до старта?</p>
      <p class="ym-cta-block__sub">На этапе пилота полезно, когда продажи и маркетинг говорят на одном языке с интегратором. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a> — это не замена внедрения под ключ, а способ быстрее принимать решения по сценариям и guardrails.</p>
    </div>
  </aside>

  <section class="vnaz-section vnaz-section-alt" id="ceny">
    <div class="vnaz-cnt">
      <div class="vnaz-sh nero-ai-reveal">
        <span class="vnaz-eyebrow">Коммерция</span>
        <h2>Сколько стоит и когда окупается</h2>
        <p>Запрос <strong>ai обработка заявок цена</strong> — один из самых частых в коммерческом сегменте.</p>
      </div>
      <h3 class="vnaz-h3 nero-ai-reveal">Из чего складывается стоимость (120–350 тыс. ₽ — ориентир)</h3>
      <div class="vnaz-table-wrap nero-ai-reveal">
        <table class="vnaz-table" aria-label="Состав стоимости внедрения">
          <thead><tr><th>Компонент</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит и ТЗ</td><td>Воронка, SLA, поля CRM</td></tr>
            <tr><td>Сценарии</td><td>Квалификация, эскалация, whitelist</td></tr>
            <tr><td>Интеграции</td><td>Сайт, webhook, amoCRM / Битрикс24</td></tr>
            <tr><td>Пилот</td><td>2–4 недели, метрики SLA</td></tr>
            <tr><td>Сопровождение</td><td>FAQ, мониторинг качества</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vnaz-prose nero-ai-reveal">
        <h3>ROI через скорость ответа и сохранённые лиды</h3>
        <p>Без фиксированного ROI для всех: CPL B2B (Callibri) порядка <strong>3,2–3,6 тыс. ₽</strong>, порог <strong>10 минут</strong>, ночные заявки перестают «зависать до понедельника».</p>
      </div>
    </div>
  </section>

  <section class="vnaz-section" id="riski">
    <div class="vnaz-cnt">
      <div class="vnaz-sh vnaz-left nero-ai-reveal">
        <span class="vnaz-eyebrow">E-E-A-T</span>
        <h2>Риски и требования: персональные данные и качество ответов</h2>
      </div>
      <div class="vnaz-alert nero-ai-reveal" role="note">
        <p><strong>152-ФЗ:</strong> отдельное согласие, уведомление РКН, первичное хранение в РФ; осторожность с Telegram и трансграничной передачей.</p>
      </div>
      <div class="vnaz-prose nero-ai-reveal">
        <h3>Ограничения нейросети и контроль качества</h3>
        <p>RAG + whitelist; при сомнении — эскалация; human-in-the-loop на пилоте.</p>
        <h3>Согласия и хранение данных заявок</h3>
        <p>Комплаенс — часть продукта, не приложение к договору.</p>
      </div>
    </div>
  </section>

  <section class="vnaz-section vnaz-section-alt" id="faq">
    <div class="vnaz-cnt">
      <div class="vnaz-sh nero-ai-reveal">
        <span class="vnaz-eyebrow">FAQ</span>
        <h2>FAQ по внедрению AI обработки заявок</h2>
      </div>
      <div class="vnaz-faq nero-ai-reveal">
        <details class="vnaz-faq-item"><summary class="vnaz-faq-q">Как внедрить ai обработку заявок в действующий сайт?</summary><div class="vnaz-faq-a"><p>Webhook с формы, виджет чата или мессенджер без полной переделки сайта. Пилот обычно 2–4 недели после аудита.</p></div></details>
        <details class="vnaz-faq-item"><summary class="vnaz-faq-q">Подходит ли для клиник, онлайн-школ и услуг?</summary><div class="vnaz-faq-a"><p>Да, с разными тонами и guardrails: без диагнозов в клинике, фокус на программе в школе, гео и срочность в услугах.</p></div></details>
        <details class="vnaz-faq-item"><summary class="vnaz-faq-q">Нужен ли свой разработчик?</summary><div class="vnaz-faq-a"><p>Для внедрения под ключ — нет; нужны доступы к CRM и ответственный со стороны продаж на пилоте.</p></div></details>
        <details class="vnaz-faq-item"><summary class="vnaz-faq-q">Чем отличается от штатного AI amoCRM?</summary><div class="vnaz-faq-a"><p>Критерии: внешний сайт, несколько каналов, кастомные поля, политики ПДн. Если весь поток в amoCRM-чатах — начните с нативного агента.</p></div></details>
        <details class="vnaz-faq-item"><summary class="vnaz-faq-q">Сколько длится внедрение?</summary><div class="vnaz-faq-a"><p>Аудит 30 минут → проектирование → пилот 2–4 недели → продакшен.</p></div></details>
      </div>
    </div>
  </section>

  <section class="vnaz-section vnaz-section--cta" id="audit-potery">
    <div class="vnaz-cnt" style="text-align:center;">
      <span class="vnaz-eyebrow">Лид-магнит · 30 минут</span>
      <h2 class="nero-ai-reveal">Проверьте, сколько заявок вы теряете</h2>
      <p class="vnaz-lead nero-ai-reveal">Экспресс-<strong>аудит потерь заявок за 30 минут</strong> — без обязательств.</p>
      <ul class="vnaz-cta-checklist nero-ai-reveal">
        <li>Доля заявок вне рабочих часов</li>
        <li>SLA vs рынок (10 мин / 1 мин в чате)</li>
        <li>Карта форма → чат → CRM</li>
        <li>Рекомендация: штатный CRM AI или кастомный слой</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent nero-ai-reveal" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <p class="vnaz-footnote nero-ai-reveal">Оплаченный трафик не должен остывать, пока менеджеры спят — утром в CRM лежат горячие карточки с контекстом диалога.</p>
    </div>
  </section>

  <section class="vnaz-section" id="sravnenie">
    <div class="vnaz-cnt">
      <div class="vnaz-sh nero-ai-reveal">
        <h2>Сравнение: чат-бот, нативный CRM AI и кастомный агент</h2>
      </div>
      <div class="vnaz-table-wrap vnaz-table-wrap--glow nero-ai-reveal">
        <table class="vnaz-table vnaz-table--compare" aria-label="Сравнение решений для заявок с сайта">
          <thead><tr><th>Решение</th><th>Плюсы</th><th>Минусы для «заявки с сайта»</th></tr></thead>
          <tbody>
            <tr><td>Скриптовый бот</td><td>Дёшево, предсказуемо</td><td>Слабая квалификация, ночь без диалога</td></tr>
            <tr><td>AI amoCRM / BitrixGPT</td><td>Внутри CRM</td><td>Не всегда webhook за секунды с сайта</td></tr>
            <tr class="vnaz-row-highlight"><td>Кастомный AI-агент Nero Network</td><td>5–15 сек, все каналы, guardrails, ПДн</td><td>Проект и пилот, нужна база знаний</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vnaz-section vnaz-section-alt" id="chek-list">
    <div class="vnaz-cnt">
      <div class="vnaz-sh vnaz-left nero-ai-reveal">
        <h2>Чек-лист готовности к запуску</h2>
      </div>
      <ul class="vnaz-checklist nero-ai-reveal" aria-label="Чек-лист готовности">
        <li>Скрипт квалификации и «красные линии» для бота</li>
        <li>FAQ, прайс/пакеты, расписание менеджеров</li>
        <li>Карта полей CRM и этапов воронки</li>
        <li>Политика ПДн, текст согласия</li>
        <li>Анонимизированные примеры переписок</li>
      </ul>
    </div>
  </section>

  <div class="vnaz-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы перестать терять ночные заявки?</p>
        <p class="ym-cta-block__sub">Аудит потерь за 30 минут — без обязательств. Покажем разрыв между вашим ответом и ожиданиями рынка в 2026 году.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

</div>


  <!-- INTERNAL-LINKS:INSERT -->
  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  'use strict';
  var root=document.querySelector('.vnaz-content');
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
  var heroReveals=document.querySelectorAll('.vnaz-hero-zayavki .nero-ai-reveal');
  heroReveals.forEach(function(el){el.classList.add('nero-ai-active');});
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
