<?php
/**
 * Template Name: Голосовой AI-бот для бизнеса
 * Description: SEO-лендинг — внедрение голосового AI для входящих и исходящих звонков. Кейсы, интеграции, цены.
 */

$page_seo_title       = 'Голосовой AI-бот для бизнеса: внедрение и настройка под ключ';
$page_seo_description = 'Запускаем голосового AI-бота для входящих и исходящих звонков: запись, квалификация лидов, напоминания и опросы. Интеграция с CRM и телефонией. Кейсы, цены, аудит.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
	echo '<meta property="og:type" content="article" />' . "\n";
}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Задачи', 'href' => '#chto-takoe'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#vnedrenie'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Стоимость', 'href' => '#cena'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить голосового бота';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '';

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

/* Hero styles: inline in .vgab-hero-voice section (Alina) */

/* VNEC content root */
.vgab-content{
  --vgab-bg:#050711;--vgab-bg2:#080b17;--vgab-surface:rgba(255,255,255,.072);
  --vgab-text:#e6edf7;--vgab-muted:#9aa8bd;--vgab-soft:#c7d2e5;--vgab-heading:#fff;
  --vgab-border:rgba(255,255,255,.10);--vgab-accent:#79f2ff;--vgab-violet:#8b5cf6;--vgab-green:#22c55e;
  --vgab-btn-from:#2563eb;--vgab-btn-to:#7c3aed;--vgab-r:18px;--vgab-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vgab-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vgab-content *,.vgab-content *::before,.vgab-content *::after{box-sizing:border-box}
.vgab-content a{color:inherit}
.vgab-content p{color:var(--vgab-muted);line-height:1.72;margin:0 0 1em}
.vgab-content p:last-child{margin-bottom:0}
.vgab-content h2,.vgab-content h3,.vgab-content h4{color:var(--vgab-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vgab-content strong{color:var(--vgab-soft)}
.vgab-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vgab-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vgab-muted);font-size:14.5px;line-height:1.65}
.vgab-content ul li::before{content:'›';position:absolute;left:0;color:var(--vgab-accent);font-weight:700}
.vgab-cnt{width:min(var(--vgab-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vgab-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vgab-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vgab-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vgab-sh.vgab-left{margin-left:0;text-align:left}
.vgab-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vgab-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vgab-sh.vgab-left p{margin-left:0}
.vgab-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vgab-accent);margin-bottom:14px}
.vgab-gt{background:linear-gradient(92deg,#fff 0%,var(--vgab-accent) 44%,var(--vgab-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vgab-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vgab-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vgab-intro-text{position:relative;padding-left:20px}
.vgab-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vgab-accent),var(--vgab-violet))}
.vgab-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vgab-muted);margin-bottom:1em}
.vgab-intro-text p:last-child{margin-bottom:0;color:var(--vgab-soft)}
.vgab-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vgab-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vgab-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vgab-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vgab-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vgab-muted);line-height:1.4}
.vgab-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vgab-intro-grid{grid-template-columns:1fr;gap:36px}.vgab-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vgab-intro-kpi{grid-template-columns:1fr 1fr}}
.vgab-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vgab-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vgab-toc a{display:inline-block;padding:9px 18px;background:var(--vgab-surface);border:1px solid var(--vgab-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vgab-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vgab-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vgab-accent);background:rgba(121,242,255,.08)}
.vgab-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vgab-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vgab-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.vgab-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vgab-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vgab-grid-2,.vgab-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.vgab-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vgab-grid-3{grid-template-columns:1fr}}
.vgab-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vgab-table{width:100%;border-collapse:collapse;font-size:14px}
.vgab-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vgab-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vgab-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vgab-text);vertical-align:top}
.vgab-table tr:last-child td{border-bottom:none}
.vgab-table tr:hover td{background:rgba(255,255,255,.03)}
.vgab-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vgab-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vgab-accent);border:1px solid rgba(121,242,255,.2)}
.vgab-flow .arr{color:var(--vgab-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vgab-timeline{position:relative;padding-left:40px}
.vgab-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vgab-accent),var(--vgab-violet));opacity:.35;border-radius:2px}
.vgab-tl-item{position:relative;margin-bottom:32px}
.vgab-tl-item:last-child{margin-bottom:0}
.vgab-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vgab-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vgab-tl-item h3{font-size:17px;margin-bottom:8px}
.vgab-tl-item p{font-size:14.5px;margin:0}
.vgab-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vgab-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vgab-case-grid{grid-template-columns:1fr}}
.vgab-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.vgab-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.vgab-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vgab-green);margin-bottom:10px}
.vgab-case-card h3{font-size:16px;margin-bottom:14px}
.vgab-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.vgab-metric .num{font-size:20px;font-weight:900;color:var(--vgab-accent);flex-shrink:0}
.vgab-metric .lbl{font-size:13px;color:var(--vgab-muted)}
.vgab-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vgab-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vgab-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vgab-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vgab-faq-q::after{content:'▾';font-size:13px;color:var(--vgab-accent);flex-shrink:0;transition:transform .25s}
.vgab-faq-item.open .vgab-faq-q::after{transform:rotate(180deg)}
.vgab-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vgab-muted);line-height:1.72}
.vgab-faq-item.open .vgab-faq-a{max-height:800px;padding:0 24px 20px}
.vgab-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.vgab-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vgab-muted)}
.vgab-cta-checklist li::before{content:'✓';color:var(--vgab-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vgab-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vgab-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vgab-btn-from),var(--vgab-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-golosovogo-ai-bota-page" role="main" tabindex="-1">

<section class="nero-ai-hero vgab-hero-voice" id="vgab-hero-voice" aria-labelledby="vgab-hero-title">
<style>
/* ── Hero голосовой AI: самодостаточные стили (шаблон главной) ── */
.vgab-hero-voice {
  --vgab-cyan: #79f2ff;
  --vgab-violet: #8b5cf6;
  --vgab-green: #22c55e;
  --vgab-amber: #fbbf24;
  --vgab-text: #e6edf7;
  --vgab-muted: #9aa8bd;
  --vgab-soft: #c7d2e5;
  --vgab-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vgab-hero-voice {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vgab-hero-voice::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 45% 30%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vgab-hero-voice::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(6px);
  animation: vgabHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vgabHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vgab-hero-voice .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vgab-hero-voice .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vgab-hero-voice .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vgab-hero-voice .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vgab-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vgab-hero-voice .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vgab-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vgab-hero-voice .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vgab-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vgab-hero-voice .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vgab-hero-voice .nero-ai-badge {
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
.vgab-hero-voice .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vgab-hero-voice .nero-ai-btn {
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
.vgab-hero-voice .nero-ai-btn:hover { transform: translateY(-2px); }
.vgab-hero-voice .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vgab-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vgab-hero-voice .nero-ai-btn-secondary {
  color: var(--vgab-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vgab-hero-voice .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vgab-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vgab-hero-voice .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vgab-hero-voice .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vgab-hero-voice .nero-ai-dots { display: flex; gap: 7px; }
.vgab-hero-voice .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vgab-hero-voice .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vgab-hero-voice .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vgab-hero-voice .nero-ai-dot:nth-child(3) { background: #34d399; }
.vgab-hero-voice .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vgab-hero-voice .nero-ai-window-body { padding: 16px; }
.vgab-hero-voice .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vgab-hero-voice .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vgab-hero-voice .nero-ai-live-pill {
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
.vgab-hero-voice .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vgabPulse 1.6s infinite;
}
@keyframes vgabPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vgab-hero-voice .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vgab-hero-voice .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vgab-hero-voice .nero-ai-metric span {
  display: block;
  color: var(--vgab-muted);
  font-size: 11px;
  font-weight: 700;
}
.vgab-hero-voice .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vgab-hero-voice .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vgab-hero-voice .vgab-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.18);
  background: radial-gradient(ellipse at 50% 40%, rgba(139,92,246,.10), rgba(6,10,24,.9) 70%);
}
.vgab-hero-voice #vgab-voice-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vgab-hero-voice .nero-ai-task-stream { display: grid; gap: 8px; }
.vgab-hero-voice .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vgab-hero-voice .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(139,92,246,.14);
  color: var(--vgab-violet);
  font-size: 13px;
  font-weight: 800;
}
.vgab-hero-voice .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vgab-hero-voice .nero-ai-task span {
  display: block;
  color: var(--vgab-muted);
  font-size: 11px;
  margin-top: 2px;
}
.vgab-hero-voice .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
}
.vgab-hero-voice .nero-ai-status--amber {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
.vgab-hero-voice .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
@media (max-width: 1024px) {
  .vgab-hero-voice .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vgab-hero-voice .nero-ai-dashboard { transform: none; }
}
@media (max-width: 640px) {
  .vgab-hero-voice .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vgab-hero-voice .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow">Голосовой AI · внедрение под ключ</p>
    <h1 id="vgab-hero-title">Голосовой AI-бот для бизнеса: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
    <p class="nero-ai-hero-lead">Запускаем голосового AI для звонков, записи и квалификации лидов — без очередей и потерянных заявок</p>
    <ul class="nero-ai-badges" aria-label="Ключевые возможности">
      <li class="nero-ai-badge">Входящие 24/7</li>
      <li class="nero-ai-badge">ASR + LLM + TTS</li>
      <li class="nero-ai-badge">Квалификация BANT</li>
      <li class="nero-ai-badge">CRM + телефония</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Оценить голосового бота</a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация голосового AI для звонков">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>Голосовой операционный центр</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>Звонков сегодня</span>
            <strong>312</strong>
            <small>входящие + исходящие</small>
          </div>
          <div class="nero-ai-metric">
            <span>Без оператора</span>
            <strong>58%</strong>
            <small>containment rate</small>
          </div>
          <div class="nero-ai-metric">
            <span>AHT типовых</span>
            <strong>100 сек</strong>
            <small>vs 4 мин у оператора</small>
          </div>
          <div class="nero-ai-metric">
            <span>Пропущенных</span>
            <strong>0</strong>
            <small>за сегодня</small>
          </div>
        </div>

        <div class="vgab-dash-canvas-wrap" aria-hidden="false">
          <canvas id="vgab-voice-hero-canvas" role="img" aria-label="Анимация: входящие звонки по SIP-дугам обрабатываются голосовым AI, квалифицируются и записываются в CRM"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента событий звонков">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">📞</span>
            <div><strong>Входящий: запись на приём</strong><span>ASR → intent «booking» · confidence 0.94</span></div>
            <span class="nero-ai-status">запись</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">AI</span>
            <div><strong>Квалификация BANT</strong><span>Бюджет · срок · потребность собраны</span></div>
            <span class="nero-ai-status nero-ai-status--cyan">лид</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">↳</span>
            <div><strong>Handoff: «оператор»</strong><span>Transcript + резюме переданы менеджеру</span></div>
            <span class="nero-ai-status nero-ai-status--amber">transfer</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">↗</span>
            <div><strong>Исходящий: NPS-опрос</strong><span>Дозвон 85% · автообработка 92%</span></div>
            <span class="nero-ai-status">NPS</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<div class="vgab-content">

  <section class="vgab-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vgab-cnt">
      <div class="vgab-intro-grid nero-ai-reveal">
        <div class="vgab-intro-text">
          <p class="vgab-eyebrow">Лонгрид · голосовой AI</p>
          <p><strong>Коротко:</strong> голосовой AI-бот — это LLM-агент, который ведёт телефонный диалог: распознаёт речь, понимает намерение, отвечает синтезированным голосом и при необходимости создаёт карточку в CRM, записывает на услугу или передаёт звонок оператору с готовым резюме. В 2026 году это уже не IVR с кнопками «1» и «2», а полноценная автоматизация входящих и исходящих звонков.</p>
          <p>По данным Gartner (через IBM, январь 2026), к 2028 году не менее <strong>70%</strong> клиентов начнут путь взаимодействия с компанией через conversational AI. Для российского бизнеса голосовой AI-бот — рабочий инструмент с чеком проекта <strong>300 тыс.–2 млн ₽</strong> и окупаемостью от <strong>6–12 месяцев</strong> при достаточном объёме звонков; после звонка данные уходят в CRM — тот же принцип, что и при <a href="/vnedrenie-ai-crm/" class="ym-link ym-link--accent">внедрении AI в CRM под ключ</a>.</p>
        </div>
        <div class="vgab-intro-kpi" aria-label="Ключевые метрики voice AI">
          <div class="vgab-kpi-card"><div class="kv">58%</div><div class="kl">звонков без оператора</div><div class="ks">containment (кейсы РФ)</div></div>
          <div class="vgab-kpi-card"><div class="kv">0</div><div class="kl">пропущенных входящих</div><div class="ks">Boostra, 4 мес.</div></div>
          <div class="vgab-kpi-card"><div class="kv">85%</div><div class="kl">дозвон исходящих</div><div class="ks">Technodom</div></div>
          <div class="vgab-kpi-card"><div class="kv">100 сек</div><div class="kl">AHT типовых запросов</div><div class="ks">Ренессанс страхование</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vgab-toc-outer">
    <div class="vgab-cnt">
      <nav class="vgab-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Задачи</a>
        <a href="#komu-nuzhen">Кому нужен</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#vnedrenie">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#kpi-roi">KPI</a>
        <a href="#cena">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="vgab-section" id="chto-takoe">
    <div class="vgab-cnt">
      <div class="vgab-sh vgab-left nero-ai-reveal">
        <span class="vgab-eyebrow">Ядро</span>
        <h2>Что такое голосовой AI-бот и какие задачи решает для бизнеса</h2>
        <p><strong>Определение:</strong> голосовой AI-бот — программный агент, который ведёт телефонный диалог с клиентом: распознаёт речь (ASR), понимает намерение (NLU/LLM), отвечает синтезированным голосом (TTS) и выполняет действия в CRM, календаре или базе знаний.</p>
      </div>
      <div class="vgab-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vgab-card">
          <h3>Входящие звонки: приём, маршрутизация, квалификация без очереди</h3>
          <p>Автоматизация входящих звонков AI закрывает главную боль: операторы не успевают, часть лидов теряется в очереди и после рабочего дня. Бот принимает звонок 24/7, отвечает на типовые вопросы, квалифицирует заявку и создаёт карточку в CRM.</p>
          <p>Кейс Boostra (Fromtech): LLM-голосовой ассистент на <strong>100% входящих</strong> — за 4 месяца <strong>63%</strong> запросов без оператора, <strong>0 пропущенных</strong> звонков.</p>
        </div>
        <div class="vgab-card">
          <h3>Исходящие звонки: напоминания, опросы NPS, реактивация базы</h3>
          <p>Исходящие звонки AI-ботом — напоминания об оплате, подтверждение заказа, NPS-опросы, реактивация «спящей» базы. Кейс «Ювелирочки» (MANGO OFFICE): выкуп онлайн-заказов <strong>+3%</strong>, своевременные оплаты <strong>+7%</strong>.</p>
          <p>Technodom: исходящий голосовой робот — дозвон до <strong>85%</strong>, автоматизация сценария до <strong>92%</strong>.</p>
        </div>
      </div>
      <div class="vgab-card nero-ai-reveal" style="margin-top:20px">
        <h3>Запись на услугу и подтверждение визита голосом</h3>
        <p>Голосовой бот запись на приём — один из самых быстрых пилотных сценариев. Бот проверяет свободные слоты в календаре, записывает клиента, отправляет SMS-подтверждение и ставит задачу администратору. Для медицины, салонов, автосервисов это снимает до 40–60% нагрузки с первой линии.</p>
      </div>
    </div>
  </section>

  <section class="vgab-section vgab-section-alt" id="komu-nuzhen">
    <div class="vgab-cnt">
      <div class="vgab-sh vgab-left nero-ai-reveal">
        <span class="vgab-eyebrow">Целевая аудитория</span>
        <h2>Кому нужен голосовой AI: отделы продаж, сервис, медицина, недвижимость, доставки</h2>
        <p>Голосовой AI-бот для бизнеса актуален там, где много телефонных коммуникаций и высокая цена пропущенного звонка.</p>
      </div>
      <div class="vgab-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vgab-card">
          <h3>Когда операторы не успевают и лиды теряются</h3>
          <p>Типичная картина: 200–500 входящих в день, 3–8 операторов, пиковые часы с очередью 5–15 минут. Клиент не дождался — ушёл к конкуренту. Голосовой AI-бот для малого бизнеса решает это без найма второй смены: бот принимает 100% звонков, а оператор подключается только к «тёплым» или сложным.</p>
        </div>
        <div class="vgab-card">
          <h3>Сервисные компании и call-центры: типовые сценарии</h3>
          <p>AI для call-центра закрывает рутину: статус заказа, изменение адреса доставки, запись на услугу, FAQ по тарифам. Кейс «Ростелекома»: предиктивный голосовой бот — <strong>&gt;80%</strong> вопросов без оператора, <strong>~60%</strong> всех входящих обрабатывает бот.</p>
        </div>
      </div>
      <ul class="nero-ai-reveal" style="margin-top:24px;display:flex;flex-wrap:wrap;gap:10px;list-style:none;padding:0">
        <li class="vgab-card" style="padding:12px 18px;margin:0;font-size:14px">Отделы продаж</li>
        <li class="vgab-card" style="padding:12px 18px;margin:0;font-size:14px">Call-центры</li>
        <li class="vgab-card" style="padding:12px 18px;margin:0;font-size:14px">Медицина</li>
        <li class="vgab-card" style="padding:12px 18px;margin:0;font-size:14px">Недвижимость</li>
        <li class="vgab-card" style="padding:12px 18px;margin:0;font-size:14px">E-commerce</li>
        <li class="vgab-card" style="padding:12px 18px;margin:0;font-size:14px">B2B / финтех</li>
      </ul>
    </div>
  </section>

<section id="vnedrenie-golosovogo-ai-bota-boris-block" class="vab-root" aria-label="Анимация: архитектура голосового AI — от звонка через ASR и LLM до записи в CRM">
<style>
/* === БОРИС: prefix vab-, scoped внутри #vnedrenie-golosovogo-ai-bota-boris-block === */
#vnedrenie-golosovogo-ai-bota-boris-block.vab-root{
  padding:56px 0 64px;
  background:#f0f4fb;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-golosovogo-ai-bota-boris-block .vab-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-golosovogo-ai-bota-boris-block .vab-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0d9488;
  margin:0 0 14px;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0d9488;
  border-radius:1px;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(13,148,136,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0d9488;
  margin-top:1px;
  font-style:normal;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-pl-b{
  background:rgba(13,148,136,.08);
  color:#0f766e;
  border:1.5px solid rgba(13,148,136,.22);
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-pl-v{
  background:rgba(99,102,241,.08);
  color:#4338ca;
  border:1.5px solid rgba(99,102,241,.22);
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-golosovogo-ai-bota-boris-block .vab-rgt{
  position:relative;
  background:linear-gradient(145deg,#f8fafc 0%,#ecfdf5 42%,#eef2ff 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-golosovogo-ai-bota-boris-block .vab-rgt{min-height:380px;}
}
#vab-voice-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="vab-cnt">
  <div class="vab-card">

    <div class="vab-lft">
      <span class="vab-ey">Архитектура звонка</span>
      <h3 class="vab-h3">Один звонок изнутри: SIP → ASR → LLM-агент → CRM → ответ клиенту или handoff оператору</h3>
      <ul class="vab-ul">
        <li><span class="vab-ic">☎</span>Клиент звонит или получает исходящий — SIP-транк Mango, UIS или Asterisk</li>
        <li><span class="vab-ic">◎</span>ASR распознаёт речь; LLM + RAG держит контекст и intent (запись, статус, квалификация)</li>
        <li><span class="vab-ic">✓</span>Action: слот в календаре, карточка в amoCRM/Б24, задача менеджеру</li>
        <li><span class="vab-ic">→</span>При низкой уверенности — transfer с transcript summary, без «чёрного ящика»</li>
      </ul>
      <div class="vab-pills">
        <span class="vab-pl vab-pl-g">50–63% без оператора</span>
        <span class="vab-pl vab-pl-b">&lt;500 ms latency</span>
        <span class="vab-pl vab-pl-v">human-in-the-loop</span>
      </div>
      <p class="vab-foot">Дальше разберём ASR, LLM и handoff к оператору →</p>
    </div>

    <div class="vab-rgt">
      <canvas
        id="vab-voice-pipeline-canvas"
        aria-label="Анимация: голосовой AI pipeline — звонок проходит через ASR, LLM-агент, запись в CRM и синтез ответа или эскалацию оператору"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vab-voice-pipeline-canvas');
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
    line:'#e2e8f0',
    card:'#ffffff',
    cardBdr:'#cbd5e1',
    teal:'#0d9488',
    tealGlow:'rgba(13,148,136,.2)',
    indigo:'#6366f1',
    green:'#22c55e',
    amber:'#f59e0b',
    red:'#ef4444',
    wave:'#14b8a6'
  };

  var NODES = [
    {id:'sip',  label:'SIP',   sub:'Mango · UIS',  color:'#64748b', icon:'☎'},
    {id:'asr',  label:'ASR',   sub:'SpeechKit',    color:'#0ea5e9', icon:'◎'},
    {id:'llm',  label:'LLM',   sub:'Agent + RAG',  color:'#6366f1', icon:'◆'},
    {id:'crm',  label:'CRM',   sub:'amo · Б24',    color:'#8b5cf6', icon:'▣'},
    {id:'tts',  label:'TTS',   sub:'Ответ',        color:'#0d9488', icon:'♪'}
  ];

  var LOOP = 720;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function nodePositions(){
    var pad = 24;
    var topY = H * 0.38;
    var nw = Math.min(72, (W - pad * 2) / NODES.length - 10);
    var gap = (W - pad * 2 - nw * NODES.length) / (NODES.length - 1);
    var xs = [];
    for(var i = 0; i < NODES.length; i++){
      xs.push(pad + i * (nw + gap));
    }
    return {topY: topY, nw: nw, nh: 64, xs: xs, pad: pad};
  }

  function drawHeader(loopFr){
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    var phase = loopFr < 120 ? 'Входящий · запись на услугу' :
                loopFr < 360 ? 'Квалификация BANT · intent: запись' :
                loopFr < 540 ? 'CRM: лид создан · задача менеджеру' :
                'TTS: подтверждение слота · SMS webhook';
    ctx.fillText(phase, 16, 22);

    var lat = loopFr < 200 ? 420 : loopFr < 400 ? 280 : 190;
    ctx.textAlign = 'right';
    ctx.fillStyle = lat < 300 ? C.green : C.amber;
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.fillText('latency ~' + lat + ' ms', W - 16, 22);
  }

  function drawWaveform(cy, loopFr){
    var wx = 16, ww = W - 32, wh = 36;
    rr(wx, cy, ww, wh, 10, 'rgba(255,255,255,.85)', C.line, 1);
    ctx.save();
    ctx.beginPath();
    ctx.rect(wx + 4, cy + 4, ww - 8, wh - 8);
    ctx.clip();
    var mid = cy + wh / 2;
    ctx.strokeStyle = C.wave;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for(var x = 0; x < ww - 8; x++){
      var t = (frame * 0.12 + x * 0.08);
      var amp = (loopFr > 40 && loopFr < 580) ? 8 + 6 * Math.sin(t * 0.5) : 2;
      var y = mid + Math.sin(t) * amp * Math.sin(x * 0.04);
      if(x === 0) ctx.moveTo(wx + 4 + x, y);
      else ctx.lineTo(wx + 4 + x, y);
    }
    ctx.stroke();
    ctx.restore();

    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Голос клиента · VAD', wx + 10, cy + 14);
    if(loopFr >= 50 && loopFr < 130){
      ctx.fillStyle = C.teal;
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.fillText('«Хочу записаться на пятницу после 15:00»', wx + 10, cy + 28);
    }
  }

  function drawNodes(pos, loopFr){
    var activeIdx = loopFr < 100 ? 0 :
                    loopFr < 220 ? 1 :
                    loopFr < 380 ? 2 :
                    loopFr < 520 ? 3 : 4;

    NODES.forEach(function(n, i){
      var x = pos.xs[i];
      var y = pos.topY;
      var active = i === activeIdx;
      var done = i < activeIdx;

      if(active){
        ctx.globalAlpha = 0.35 + 0.25 * Math.sin(frame * 0.1);
        rr(x - 4, y - 4, pos.nw + 8, pos.nh + 8, 14, C.tealGlow, null, 0);
        ctx.globalAlpha = 1;
      }

      rr(x, y, pos.nw, pos.nh, 12, done ? 'rgba(34,197,94,.08)' : C.card, done ? 'rgba(34,197,94,.35)' : (active ? n.color : C.cardBdr), active ? 2 : 1.5);

      ctx.fillStyle = done ? C.green : (active ? n.color : C.muted);
      ctx.font = 'bold 14px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(n.icon, x + pos.nw/2, y + 22);

      ctx.fillStyle = active ? C.ink : C.muted;
      ctx.font = (active ? 'bold ' : '') + '10px Inter,sans-serif';
      ctx.fillText(n.label, x + pos.nw/2, y + 40);

      ctx.fillStyle = C.muted;
      ctx.font = '8px Inter,sans-serif';
      ctx.fillText(n.sub, x + pos.nw/2, y + 54);

      if(i < NODES.length - 1){
        var x1 = x + pos.nw;
        var x2 = pos.xs[i + 1];
        var ly = y + pos.nh / 2;
        ctx.strokeStyle = done ? C.green : C.line;
        ctx.lineWidth = done ? 2 : 1.5;
        ctx.setLineDash(done ? [] : [4, 4]);
        ctx.beginPath();
        ctx.moveTo(x1 + 2, ly);
        ctx.lineTo(x2 - 2, ly);
        ctx.stroke();
        ctx.setLineDash([]);
      }
    });
  }

  function drawPacket(pos, loopFr){
    if(loopFr < 30 || loopFr > 600) return;
    var prog = (loopFr - 30) / 570;
    var totalW = pos.xs[NODES.length - 1] + pos.nw - pos.xs[0];
    var px = pos.xs[0] + totalW * prog;
    var py = pos.topY + pos.nh / 2;
    var pulse = 0.6 + 0.4 * Math.sin(frame * 0.15);

    ctx.globalAlpha = pulse;
    rr(px - 6, py - 6, 12, 12, 6, C.teal, null, 0);
    ctx.globalAlpha = 1;

    ctx.fillStyle = '#fff';
    ctx.font = 'bold 8px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('●', px, py + 3);
  }

  function drawCrmCard(loopFr){
    if(loopFr < 400) return;
    var alpha = Math.min(1, (loopFr - 400) / 50);
    var bob = Math.sin(frame * 0.05) * 2;
    var cx = 16, cy = H - 118 + bob, cw = W * 0.48, ch = 88;
    ctx.globalAlpha = alpha;
    rr(cx, cy, cw, ch, 12, C.card, C.cardBdr, 1.5);

    ctx.fillStyle = C.ink;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Лид #2841 · amoCRM', cx + 14, cy + 22);

    var fields = [
      {l:'Intent', v:'Запись на услугу', ok: loopFr >= 430},
      {l:'Слот', v:'Пт 15:30', ok: loopFr >= 480},
      {l:'BANT', v:'Бюджет ✓ · Срок ✓', ok: loopFr >= 520}
    ];
    var fx = cx + 14, fy = cy + 34;
    fields.forEach(function(f){
      ctx.fillStyle = f.ok ? C.teal : C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText(f.l + ': ' + (f.ok ? f.v : '…'), fx, fy);
      fx += cw / 3.2;
    });

    if(loopFr >= 540){
      rr(cx + cw - 78, cy + ch - 32, 64, 22, 8, C.indigo, null, 0);
      ctx.fillStyle = '#fff';
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('Задача →', cx + cw - 46, cy + ch - 17);
    }
    ctx.globalAlpha = 1;
  }

  function drawHandoff(loopFr){
    if(loopFr < 620) return;
    var alpha = Math.min(1, (loopFr - 620) / 40);
    var hx = W - 168, hy = H - 108;
    ctx.globalAlpha = alpha;
    rr(hx, hy, 152, 52, 12, 'rgba(245,158,11,.12)', C.amber, 1.5);
    ctx.fillStyle = C.amber;
    ctx.font = 'bold 9px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Эскалация (10–20%)', hx + 12, hy + 18);
    ctx.fillStyle = C.ink;
    ctx.font = '10px Inter,sans-serif';
    ctx.fillText('Transfer + transcript', hx + 12, hy + 34);
    ctx.font = '9px Inter,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('Оператор видит резюме', hx + 12, hy + 46);
    ctx.globalAlpha = 1;
  }

  function drawContainment(loopFr){
    var pct = loopFr < 200 ? 0 :
              loopFr < 500 ? Math.min(58, (loopFr - 200) * 0.19) : 58;
    var qy = posSafeBottom();
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Containment', 16, qy);
    var barX = 100, barW = Math.min(180, W * 0.35);
    rr(barX, qy - 10, barW, 10, 5, '#f1f5f9', C.line, 1);
    if(pct > 0){
      rr(barX, qy - 10, barW * (pct / 100), 10, 5, C.green, null, 0);
    }
    ctx.fillStyle = C.green;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.fillText(Math.round(pct) + '%', barX + barW + 10, qy);
  }

  function posSafeBottom(){
    return H - 28;
  }

  function loop(){
    frame++;
    var loopFr = frame % LOOP;
    ctx.clearRect(0, 0, W, H);

    var pos = nodePositions();
    drawHeader(loopFr);
    drawWaveform(pos.topY - 52, loopFr);
    drawNodes(pos, loopFr);
    drawPacket(pos, loopFr);
    drawCrmCard(loopFr);
    drawHandoff(loopFr);
    drawContainment(loopFr);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>

  <section class="vgab-section" id="kak-rabotaet">
    <div class="vgab-cnt">
      <div class="vgab-sh nero-ai-reveal">
        <span class="vgab-eyebrow">Архитектура</span>
        <h2>Как работает голосовой AI-бот: архитектура и сценарии диалога</h2>
        <p><strong>Коротко:</strong> звонок → SIP-транк → ASR → LLM-агент + база знаний → действие в CRM/API → TTS → ответ клиенту. При низкой уверенности или запросе «оператор» — transfer с готовым резюме разговора.</p>
      </div>
      <div class="vgab-flow nero-ai-reveal" aria-label="Схема voice pipeline">
        <span>Звонок SIP</span><span class="arr">→</span>
        <span>ASR</span><span class="arr">→</span>
        <span>LLM + RAG</span><span class="arr">→</span>
        <span>CRM / API</span><span class="arr">→</span>
        <span>TTS / Handoff</span>
      </div>
      <div class="vgab-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vgab-card">
          <h3>ASR, LLM и синтез речи: что важно для русского языка</h3>
          <p>Зрелые стеки 2026: <strong>Yandex SpeechKit</strong> (~0,18 ₽/сек STT), <strong>SaluteSpeech</strong>, on-prem <strong>Whisper</strong>. Кейс Газпромбанка (бот «Тома»): <strong>91%</strong> точность распознавания тематики.</p>
          <p>Архитектурный сдвиг: переход к <strong>speech-to-speech</strong> — latency с 800–1400 ms до ~<strong>100 ms</strong> TTFA.</p>
        </div>
        <div class="vgab-card">
          <h3>Скрипты, ветвления и handoff к оператору</h3>
          <p>Сценарий — дерево ветвлений с fallback: приветствие + compliance → intent → BANT → action → transfer с transcript при низкой confidence.</p>
          <p>Гибридная модель 2026: AI обрабатывает <strong>80–90%</strong> объёма, <strong>10–20%</strong> — эскалация с полным контекстом.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vgab-section vgab-section-alt" id="vnedrenie">
    <div class="vgab-cnt">
      <div class="vgab-sh nero-ai-reveal">
        <span class="vgab-eyebrow">Под ключ</span>
        <h2>Внедрение голосового AI-бота под ключ: этапы, сроки, роли</h2>
        <p>Внедрение голосовой AI-бот — проект на <strong>2–8 недель</strong> для пилота и <strong>до 3 месяцев</strong> для нескольких сценариев с интеграциями.</p>
      </div>
      <div class="vgab-timeline nero-ai-reveal">
        <div class="vgab-tl-item">
          <div class="vgab-tl-dot"></div>
          <h3>Аудит звонков и проектирование сценариев</h3>
          <p><strong>Этап 0 — Бриф (1–2 дня):</strong> объём звонков/мес, % типовых, телефония, CRM, записи звонков. <strong>Этап 1 — Аудит:</strong> 30–100 записей, выделение 1–3 пилотных сценариев с максимальным ROI.</p>
        </div>
        <div class="vgab-tl-item">
          <div class="vgab-tl-dot"></div>
          <h3>Пилот, A/B и масштабирование на все линии</h3>
          <p><strong>Этап 2 — Пилот (2–3 недели):</strong> один сценарий в параллельном режиме (бот + оператор). Разбор первых 200 звонков. <strong>Этап 3 — Масштабирование:</strong> A/B-тест маршрутизации, исходящие линии, новые сценарии.</p>
        </div>
      </div>
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-golosovoj-bot">
  <div class="ym-cta-block__icon" aria-hidden="true">📞</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Оценить голосового бота — бесплатно</p>
    <p class="ym-cta-block__sub">Прослушаем записи звонков, выберем 1–3 пилотных сценария и оценим интеграцию с телефонией и CRM. Пришлём «Сценарий голосового AI» с полями квалификации — без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Оценить голосового бота'); ?></a>
  </div>
</aside>
    </div>
  </section>

  <p class="vgab-related nero-ai-reveal" style="margin:0 auto clamp(28px,4vw,40px);max-width:820px;font-size:15px;color:var(--vgab-muted);line-height:1.72;text-align:center;">Когда входящий поток идёт не только звонком, но и письмом, полезно сравнить сценарий <a href="/vnedrenie-ai-obrabotka-email-crm/" class="ym-link ym-link--accent">AI-обработки входящей почты в CRM</a> — triage и маршрутизация до handoff оператору работают по тем же правилам, что и containment на голосовой линии.</p>

  <section class="vgab-section" id="integracii">
    <div class="vgab-cnt">
      <div class="vgab-sh nero-ai-reveal">
        <span class="vgab-eyebrow">Стек</span>
        <h2>Интеграция голосового AI с CRM и телефонией</h2>
        <p>Интеграция голосовой AI-бот — то, что отличает «игрушку» от бизнес-инструмента. Голосовой AI-бот с CRM создаёт карточку, заполняет поля квалификации и ставит задачу менеджеру.</p>
      </div>
      <div class="vgab-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vgab-card">
          <h3>amoCRM, Битрикс24: карточки, сделки, задачи после звонка</h3>
          <p>После звонка в CRM: имя, телефон, intent, BANT-поля, transcript, задача менеджеру. Для amoCRM есть отдельный разбор сценариев — <a href="/vnedrenie-ai-amocrm/" class="ym-link ym-link--accent">AI-агент для amoCRM под ключ</a>. Post-call через Make/n8n: SMS, email, Telegram-уведомление.</p>
        </div>
        <div class="vgab-card">
          <h3>Asterisk, Mango Office, UIS: маршрутизация и запись разговоров</h3>
          <p>Mango Office, UIS, Voximplant, Asterisk — SIP-транк, маршрутизация, запись. Логика: звонок → ASR → LLM → action → TTS → post-call webhook.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vgab-section vgab-section-alt" id="scenarii">
    <div class="vgab-cnt">
      <div class="vgab-sh nero-ai-reveal">
        <span class="vgab-eyebrow">Сценарии</span>
        <h2>Сценарии без потери лидов: квалификация, запись, опросы, напоминания</h2>
      </div>
      <div class="vgab-grid-2 nero-ai-reveal">
        <div class="vgab-card">
          <h3>Квалификация по BANT/scoring и передача «тёплого» лида</h3>
          <p>Scoring: «горячий» → transfer менеджеру с контекстом; «тёплый» → задача в CRM; «холодный» → nurture-цепочка. Кейс B2B-дистрибуции: окупаемость <strong>6–10 месяцев</strong>, высвобождение <strong>40–60%</strong> загрузки первой линии.</p>
        </div>
        <div class="vgab-card">
          <h3>Опросы и сбор обратной связи после обслуживания</h3>
          <p>Голосовой бот напоминания и NPS-опросы — исходящие кампании с KPI «% дозвона». Technodom: сбор feedback за <strong>3 часа</strong> вместо нескольких суток.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vgab-section" id="kpi-roi">
    <div class="vgab-cnt">
      <div class="vgab-sh nero-ai-reveal">
        <span class="vgab-eyebrow">Метрики</span>
        <h2>KPI и ROI голосового AI: нагрузка на операторов, дозвон, конверсия</h2>
      </div>
      <div class="vgab-table-wrap nero-ai-reveal">
        <table class="vgab-table" aria-label="KPI голосового AI из кейсов">
          <thead><tr><th>KPI</th><th>Что измеряет</th><th>Ориентиры из кейсов</th></tr></thead>
          <tbody>
            <tr><td>Containment rate</td><td>% звонков без оператора</td><td>50–63% (Росконгресс, Boostra, Ренессанс)</td></tr>
            <tr><td>AHT</td><td>Среднее время обработки</td><td>100 сек (Ренессанс страхование)</td></tr>
            <tr><td>% дозвона</td><td>Исходящие кампании</td><td>до 85% (Technodom)</td></tr>
            <tr><td>Пропущенные</td><td>Входящая линия</td><td>0 при 100% покрытии (Boostra)</td></tr>
            <tr><td>Конверсия</td><td>Запись / оплата</td><td>+3% выкуп, +7% оплаты (Ювелирочка)</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vgab-card nero-ai-reveal" style="margin-top:24px">
        <h3>Как считать окупаемость за 3–6 месяцев</h3>
        <p>Break-even: стоимость проекта (300–900 тыс. ₽ пилот) + переменные (~30 ₽/звонок 3 мин SpeechKit) vs экономия ФОТ. Ориентир: break-even от <strong>~1500 зв/мес</strong>; окупаемость <strong>6–12 месяцев</strong>.</p>
      </div>
    </div>
  </section>

  <section class="vgab-section vgab-section-alt" id="platformy">
    <div class="vgab-cnt">
      <div class="vgab-sh nero-ai-reveal">
        <span class="vgab-eyebrow">Платформы</span>
        <h2>Платформы и стек: Vapi, ElevenLabs, Yandex SpeechKit, SaluteSpeech, Twilio</h2>
      </div>
      <div class="vgab-table-wrap nero-ai-reveal">
        <table class="vgab-table" aria-label="Сравнение платформ voice AI">
          <thead><tr><th>Платформа</th><th>Когда выбирать</th><th>Особенности</th></tr></thead>
          <tbody>
            <tr><td><strong>Yandex SpeechKit + YandexGPT</strong></td><td>РФ, русский язык</td><td>~0,18 ₽/сек STT; Yandex Cloud</td></tr>
            <tr><td><strong>SaluteSpeech + GigaChat</strong></td><td>РФ, enterprise</td><td>Compliance, экосистема Сбер</td></tr>
            <tr><td><strong>MANGO OFFICE AI Robot</strong></td><td>Быстрый SaaS-старт</td><td>No-code, amoCRM/Б24 из коробки</td></tr>
            <tr><td><strong>Just AI (JAICP)</strong></td><td>Enterprise</td><td>Кейсы ПМЭФ, банки</td></tr>
            <tr><td><strong>Vapi / ElevenLabs</strong></td><td>Международные</td><td>Speech-to-speech, low-latency</td></tr>
            <tr><td><strong>Custom (Asterisk + Whisper)</strong></td><td>On-prem, 152-ФЗ</td><td>от 350 000 ₽ (рынок РФ)</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vgab-section" id="cena">
    <div class="vgab-cnt">
      <div class="vgab-sh nero-ai-reveal">
        <span class="vgab-eyebrow">Бюджет</span>
        <h2>Сколько стоит голосовой AI-бот: цены, факторы стоимости, чек проекта</h2>
        <p>Вилка проекта: <strong>300 тыс.–2 млн ₽</strong>.</p>
      </div>
      <div class="vgab-table-wrap nero-ai-reveal">
        <table class="vgab-table" aria-label="Сегменты стоимости voice AI">
          <thead><tr><th>Сегмент</th><th>Чек</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Пилот 1–2 сценария</td><td>300–900 тыс. ₽</td><td>Аудит, 1 интеграция CRM, 2–4 недели</td></tr>
            <tr><td>Несколько сценариев + on-prem</td><td>900 тыс.–2 млн ₽</td><td>Asterisk, Whisper, SLA, compliance</td></tr>
            <tr><td>SaaS (Mango и аналоги)</td><td>от абонплаты</td><td>Быстрый старт, ограниченная кастомизация</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vgab-card nero-ai-reveal" style="margin-top:24px">
        <h3>Скрытые расходы</h3>
        <p>Минуты STT/TTS (~30 ₽/звонок 3 мин), телефония исходящих, доработка сценариев после первых 200 звонков, дополнительные интеграции (1С, ERP), compliance-аудит (152-ФЗ, on-prem).</p>
      </div>
    </div>
  </section>

  <p class="vgab-related nero-ai-reveal" style="margin:0 auto clamp(28px,4vw,40px);max-width:820px;font-size:15px;color:var(--vgab-muted);line-height:1.72;text-align:center;">Если после квалификации звонком сделка уходит в учётный контур — заказ, отгрузка, оплата — смотрите смежный сценарий: <a href="/ai-1c-erp/" class="ym-link ym-link--accent">AI-агент для 1С и ERP</a>. Здесь фокус на голосовом канале и CRM; ERP-контур — отдельная посадочная.</p>

  <section class="vgab-section vgab-section-alt" id="keisy">
    <div class="vgab-cnt">
      <div class="vgab-sh nero-ai-reveal">
        <span class="vgab-eyebrow">Кейсы</span>
        <h2>Кейсы внедрения голосового AI-бота</h2>
      </div>
      <div class="vgab-case-grid">
        <div class="vgab-case-card nero-ai-reveal">
          <div class="vgab-case-tag">Медицина</div>
          <h3>Запись на приём</h3>
          <p>Входящая запись, подтверждение визита, напоминание за 24 ч. Бот проверяет слоты, создаёт запись в CRM/МИС, отправляет SMS.</p>
        </div>
        <div class="vgab-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vgab-case-tag">Недвижимость</div>
          <h3>Квалификация заявок</h3>
          <p>Звонок с рекламы → бот уточняет бюджет, район, срок → карточка в amoCRM → задача брокеру «тёплый лид».</p>
        </div>
        <div class="vgab-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vgab-case-tag">Росконгресс / ПМЭФ</div>
          <h3>Just AI</h3>
          <p><strong>~50%</strong> звонков без оператора; типовые запросы <strong>в 10 раз быстрее</strong>; нагрузка на КЦ <strong>в 2 раза</strong> ниже.</p>
          <div class="vgab-metric"><span class="num">537</span><span class="lbl">звонков агентом за день пика</span></div>
        </div>
        <div class="vgab-case-card nero-ai-reveal">
          <div class="vgab-case-tag">Страхование</div>
          <h3>Ренессанс / TargetAI</h3>
          <p>За 2 месяца: <strong>52%</strong> автоматизации, AHT <strong>100 секунд</strong>, доля звонков агентом выросла с 5% до 100% за 3 недели.</p>
        </div>
        <div class="vgab-case-card nero-ai-reveal nero-ai-delay-1">
          <div class="vgab-case-tag">Финтех</div>
          <h3>Boostra / Fromtech</h3>
          <p><strong>63%</strong> запросов без оператора, <strong>0 пропущенных</strong> на 100% входящих за 4 месяца.</p>
        </div>
        <div class="vgab-case-card nero-ai-reveal nero-ai-delay-2">
          <div class="vgab-case-tag">Retail</div>
          <h3>Ювелирочка / Mango</h3>
          <p>6 сценариев робота: выкуп <strong>+3%</strong>, своевременные оплаты <strong>+7%</strong>.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vgab-section" id="riski">
    <div class="vgab-cnt">
      <div class="vgab-sh vgab-left nero-ai-reveal">
        <span class="vgab-eyebrow">Compliance</span>
        <h2>Риски и compliance: качество распознавания, задержки, запись разговоров</h2>
      </div>
      <div class="vgab-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vgab-card">
          <h3>152-ФЗ, уведомление о записи, хранение данных</h3>
          <ul>
            <li>Запись разговоров — с согласия (уведомление в начале)</li>
            <li>Персональные данные — 152-ФЗ; on-prem для чувствительных отраслей</li>
            <li>С 01.09.2025 — маркировка звонков в РФ</li>
            <li>Законопроект № 1125581-8: в первые <strong>5 секунд</strong> сообщать об автоматизации</li>
          </ul>
        </div>
        <div class="vgab-card">
          <h3>Когда голосовой бот не подходит</h3>
          <ul>
            <li>Сложные переговоры, VIP, юридические споры</li>
            <li>Нестандартные скидки, крупные B2B-сделки</li>
            <li>Холодные обзвоны без согласия (<strong>38-ФЗ</strong>)</li>
          </ul>
          <p style="margin-top:14px">Митигация: RAG + guardrails + QA первых 200 звонков + быстрая эскалация.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vgab-section vgab-section-alt" id="faq">
    <div class="vgab-cnt">
      <div class="vgab-sh nero-ai-reveal">
        <span class="vgab-eyebrow">Вопрос — ответ</span>
        <h2>FAQ — частые вопросы о голосовом AI-боте</h2>
      </div>
      <div class="vgab-faq nero-ai-reveal">
        <div class="vgab-faq-item open"><div class="vgab-faq-q" tabindex="0" role="button" aria-expanded="true">Как внедрить голосовой AI-бот без своей команды разработки?</div><div class="vgab-faq-a"><p>Закажите внедрение голосовой AI-бот под ключ: интегратор проводит аудит, настраивает сценарии, подключает телефонию и CRM. Срок пилота — 2–4 недели. Вам нужны: записи звонков, FAQ, доступ к CRM и телефонии.</p></div></div>
        <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Хотите понимать голосовой AI до старта пилота?</p>
    <p class="ym-cta-block__sub">Если команда хочет разобраться в промптах, интеграциях телефонии и human-in-the-loop до аудита звонков — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>. Это ускоряет согласование сценариев с РОПом и IT.</p>
  </div>
</aside>
        <div class="vgab-faq-item"><div class="vgab-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит голосовой AI-бот для малого бизнеса?</div><div class="vgab-faq-a"><p>От <strong>300 000 ₽</strong> за пилот с 1–2 сценариями + переменные (минуты). SaaS-вариант (Mango AI Robot) — быстрее на старте, но меньше кастомизации. Break-even — от ~1500 звонков/мес.</p></div></div>
        <div class="vgab-faq-item"><div class="vgab-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли подключить к существующей телефонии?</div><div class="vgab-faq-a"><p>Да. Mango, UIS, Asterisk, Voximplant — стандартные интеграции. Бот подключается через SIP-транк или API оператора связи.</p></div></div>
        <div class="vgab-faq-item"><div class="vgab-faq-q" tabindex="0" role="button" aria-expanded="false">Какие задачи решает голосовой AI-бот в первую очередь?</div><div class="vgab-faq-a"><p>1. Приём входящих 24/7 без очереди. 2. Запись на услугу / подтверждение заказа. 3. Квалификация лидов с передачей в CRM. 4. Исходящие напоминания и NPS. 5. Статус заказа / FAQ.</p></div></div>
        <div class="vgab-faq-item"><div class="vgab-faq-q" tabindex="0" role="button" aria-expanded="false">Как измерить результат после запуска?</div><div class="vgab-faq-a"><p>KPI через 30/60/90 дней: containment rate, AHT, % дозвона, пропущенные, конверсия в запись/сделку, причины эскалации. Сравнение «до/после» на одном сценарии.</p></div></div>
      </div>
    </div>
  </section>

  <section class="vgab-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="vgab-cnt" style="text-align:center">
      <span class="vgab-eyebrow">Первый шаг</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px">Оценить голосового бота:<br>«Сценарий голосового AI»</h2>
      <p style="max-width:580px;margin:0 auto 28px;font-size:16px">Прослушаем записи звонков, выберем 1–3 пилотных сценария и оценим интеграцию с телефонией и CRM. Чек проекта — 300 тыс.–2 млн ₽, окупаемость 6–12 месяцев.</p>
      <ul class="vgab-cta-checklist">
        <li>Аудит звонков за 1–2 дня</li>
        <li>Сценарий голосового AI (лид-магнит)</li>
        <li>Оценка интеграции CRM + телефония</li>
        <li>Без обязательств</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px"<?php echo $primary_cta_attrs; ?>>Оценить голосового бота</a>
    </div>
  </section>

</div><!-- /.vgab-content -->

<?php
$vgab_slug = 'vnedrenie-golosovogo-ai-bota';
$vgab_canonical_origin = trailingslashit(
	getenv( 'PUBLIC_SITE_CANONICAL_URL' )
		?: getenv( 'PUBLIC_SITE_URL' )
		?: home_url( '/' )
);
$vgab_page_url = $vgab_canonical_origin . $vgab_slug . '/';
$vgab_schema   = [
	'@context' => 'https://schema.org',
	'@graph'   => [
		[
			'@type' => 'Organization',
			'@id'   => $vgab_canonical_origin . '#organization',
			'name'  => $brand,
			'url'   => $vgab_canonical_origin,
		],
		[
			'@type'     => 'WebSite',
			'@id'       => $vgab_canonical_origin . '#website',
			'url'       => $vgab_canonical_origin,
			'name'      => $brand,
			'publisher' => [ '@id' => $vgab_canonical_origin . '#organization' ],
		],
		[
			'@type'       => 'WebPage',
			'@id'         => $vgab_page_url . '#webpage',
			'url'         => $vgab_page_url,
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'isPartOf'    => [ '@id' => $vgab_canonical_origin . '#website' ],
			'about'       => [ '@id' => $vgab_canonical_origin . '#organization' ],
		],
		[
			'@type'           => 'BreadcrumbList',
			'@id'             => $vgab_page_url . '#breadcrumb',
			'itemListElement' => [
				[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vgab_canonical_origin ],
				[ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vgab_page_url ],
			],
		],
		[
			'@type'       => 'Service',
			'@id'         => $vgab_page_url . '#service',
			'name'        => $page_seo_title,
			'description' => $page_seo_description,
			'url'         => $vgab_page_url,
			'provider'    => [ '@id' => $vgab_canonical_origin . '#organization' ],
		],
		[
			'@type'      => 'FAQPage',
			'@id'        => $vgab_page_url . '#faq',
			'mainEntity' => [
				[
					'@type'          => 'Question',
					'name'           => 'Как внедрить голосовой AI-бот без своей команды разработки?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Закажите внедрение голосовой AI-бот под ключ: интегратор проводит аудит, настраивает сценарии, подключает телефонию и CRM. Срок пилота — 2–4 недели. Вам нужны: записи звонков, FAQ, доступ к CRM и телефонии.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Сколько стоит голосовой AI-бот для малого бизнеса?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'От 300 000 ₽ за пилот с 1–2 сценариями + переменные (минуты). SaaS-вариант (Mango AI Robot) — быстрее на старте, но меньше кастомизации. Break-even — от ~1500 звонков/мес.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Можно ли подключить к существующей телефонии?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'Да. Mango, UIS, Asterisk, Voximplant — стандартные интеграции. Бот подключается через SIP-транк или API оператора связи.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Какие задачи решает голосовой AI-бот в первую очередь?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => '1. Приём входящих 24/7 без очереди. 2. Запись на услугу / подтверждение заказа. 3. Квалификация лидов с передачей в CRM. 4. Исходящие напоминания и NPS. 5. Статус заказа / FAQ.',
					],
				],
				[
					'@type'          => 'Question',
					'name'           => 'Как измерить результат после запуска?',
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text'  => 'KPI через 30/60/90 дней: containment rate, AHT, % дозвона, пропущенные, конверсия в запись/сделку, причины эскалации. Сравнение «до/после» на одном сценарии.',
					],
				],
			],
		],
	],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vgab_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<script>
/**
 * vgab-voice-hero-engine — Диспетчерская голосового AI
 * Мир: SIP-дуги звонков → VoiceDialogConsole → CRM → handoff оператору
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vgab-voice-hero-canvas");
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
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    phoneBg: "#1e293b",
    phoneAccent: "#79f2ff",
    arcIn: "rgba(121,242,255,0.24)",
    arcOut: "rgba(251,191,36,0.22)",
    consoleBg: "#0f172a",
    waveBar: "#8b5cf6",
    waveActive: "#79f2ff",
    crmGreen: "#22c55e",
    handoff: "#fbbf24",
    compliance: "#fb7185",
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

  function drawPhoneIcon(ctx, x, y, size, color, ring) {
    ctx.save();
    ctx.translate(x, y);
    if (ring) {
      ctx.strokeStyle = "rgba(121,242,255," + (0.35 + Math.sin(frame * 0.12) * 0.25) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 0, size + 6 + Math.sin(frame * 0.15) * 3, 0, Math.PI * 2);
      ctx.stroke();
    }
    drawRR(ctx, -size * 0.35, -size * 0.55, size * 0.7, size, 4, color, C.outline);
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.beginPath();
    ctx.moveTo(-size * 0.15, -size * 0.35);
    ctx.lineTo(size * 0.1, -size * 0.05);
    ctx.lineTo(-size * 0.05, size * 0.15);
    ctx.stroke();
    ctx.restore();
  }

  /* Транспорт: дуги входящих/исходящих SIP-звонков */
  function InboundCallArc() {
    this.phase = 0;
  }
  InboundCallArc.prototype.draw = function (ctx) {
    this.phase = (frame * 0.028) % (Math.PI * 2);
    var arcs = [
      { rx: 125, ry: 48, color: C.arcIn, dash: [5, 7], label: "IN" },
      { rx: 95, ry: 36, color: C.arcOut, dash: [4, 6], label: "OUT" }
    ];
    arcs.forEach(function (arc, idx) {
      ctx.save();
      ctx.strokeStyle = arc.color;
      ctx.lineWidth = idx === 0 ? 2 : 1.5;
      ctx.setLineDash(arc.dash);
      ctx.lineDashOffset = -frame * (idx ? 0.55 : 0.35);
      ctx.beginPath();
      ctx.ellipse(0, -15, arc.rx, arc.ry, 0, Math.PI * 0.15, Math.PI * 0.85);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = arc.color;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(arc.label, arc.rx - 18, -15 - arc.ry + 8);
      ctx.restore();
    });

    for (var i = 0; i < 4; i++) {
      var isOut = i % 2 === 1;
      var orb = isOut ? arcs[1] : arcs[0];
      var t = (this.phase * (isOut ? 1.2 : 1) + i * 1.6) % (Math.PI * 0.7);
      var angle = Math.PI * 0.15 + t;
      var px = Math.cos(angle) * orb.rx;
      var py = -15 + Math.sin(angle) * orb.ry;
      drawPhoneIcon(ctx, px, py, 10, isOut ? "#fde68a" : C.phoneAccent, !isOut && i === 0);
    }
  };

  /* Центральная консоль диалога — вместо WebsiteTerminal */
  function VoiceDialogConsole() {
    this.waveSeed = Math.random() * 100;
  }
  VoiceDialogConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 240;
    drawRR(ctx, -58, -78, 116, 148, 10, C.consoleBg, C.outline);

    /* Экран консоли */
    drawRR(ctx, -48, -68, 96, 88, 6, "#111827", C.phoneAccent);

    /* Compliance badge — первые 5 сек (фаза RING) */
    if (prg < 45) {
      drawRR(ctx, -42, -62, 84, 12, 3, "rgba(251,113,133,0.2)", C.compliance);
      ctx.fillStyle = "#fecdd3";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Голосовой помощник · запись", 0, -54);
    }

    /* Волна речи ASR/TTS */
    var barCount = 12;
    for (var b = 0; b < barCount; b++) {
      var bx = -40 + b * 7;
      var bh = 8 + Math.abs(Math.sin(frame * 0.08 + b * 0.5 + this.waveSeed)) * (prg > 45 && prg < 165 ? 22 : 6);
      var barColor = prg > 45 && prg < 120 ? C.waveActive : C.waveBar;
      drawRR(ctx, bx, -20 - bh, 5, bh, 2, barColor, null);
    }

    /* ASR-текст по фазам */
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    if (prg >= 50 && prg < 95) ctx.fillText("«Хочу записаться на приём…»", -42, -28);
    if (prg >= 95 && prg < 140) ctx.fillText("Intent: booking · slot check", -42, -28);
    if (prg >= 140 && prg < 185) ctx.fillText("BANT: бюджет ✓ срок ✓", -42, -28);
    if (prg >= 185) ctx.fillText("CRM: лид #2841 создан", -42, -28);

    /* Поля квалификации — фаза QUALIFY */
    if (prg >= 120 && prg < 190) {
      var fields = ["Имя", "Тел.", "Срок"];
      fields.forEach(function (f, i) {
        var fy = 8 + i * 16;
        var alpha = Math.min(1, (prg - 120 - i * 12) / 15);
        if (alpha > 0) {
          ctx.globalAlpha = alpha;
          drawRR(ctx, -44, fy, 38, 12, 3, "rgba(34,197,94,0.2)", C.crmGreen);
          ctx.fillStyle = "#bbf7d0";
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.textAlign = "center";
          ctx.fillText(f, -25, fy + 8);
          ctx.globalAlpha = 1;
        }
      });
    }

    /* Финал: CRM sync или handoff */
    if (prg >= 190) {
      var fin = Math.min(1, (prg - 190) / 20);
      var cardY = 52 - fin * 28;
      drawRR(ctx, -30, cardY, 60, 28, 5, "rgba(34,197,94,0.22)", C.crmGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Лид #2841", 0, cardY + 11);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("amoCRM · 201", 0, cardY + 20);

      if (prg > 205 && prg < 235) {
        var pulse = (prg - 205) / 30;
        ctx.strokeStyle = "rgba(34,197,94," + (0.85 - pulse * 0.75) + ")";
        ctx.lineWidth = 2.5;
        ctx.beginPath();
        ctx.arc(0, cardY + 14, 18 + pulse * 38, 0, Math.PI * 2);
        ctx.stroke();
      }
    }

    /* Счётчик */
    ctx.fillStyle = C.crmGreen;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "right";
    ctx.fillText("+" + (Math.floor(prg / 240) + (prg > 210 ? 1 : 0)) + " сегодня", 52, -66);
  };

  /* Latency meter — TTFA speech-to-speech */
  function LatencyMeter() {
    this.ms = 420;
  }
  LatencyMeter.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 240;
    if (prg < 60) this.ms = 420 - (prg / 60) * 280;
    else if (prg < 120) this.ms = 140 - ((prg - 60) / 60) * 40;
    else this.ms = 95 + Math.sin(frame * 0.05) * 8;

    drawRR(ctx, 88, -68, 48, 14, 4, "rgba(255,255,255,0.06)", C.outline);
    var norm = Math.max(0, Math.min(1, 1 - (this.ms - 80) / 400));
    drawRR(ctx, 90, -66, 44 * norm, 10, 3, C.waveActive, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText(Math.round(this.ms) + " ms", 92, -57);
  };

  /* Мост handoff к оператору */
  function OperatorHandoffBridge() {
    this.active = false;
  }
  OperatorHandoffBridge.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 240;
    drawRR(ctx, -158, 8, 40, 30, 6, "rgba(251,191,36,0.12)", C.handoff);
    ctx.fillStyle = C.handoff;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("OP", -138, 26);

    if (prg > 175 && prg < 220) {
      this.active = true;
      var hx = -130 + ((prg - 175) / 45) * 55;
      ctx.strokeStyle = "rgba(251,191,36,0.6)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(hx, 18);
      ctx.lineTo(-55, 55);
      ctx.stroke();
      ctx.setLineDash([]);
      drawPhoneIcon(ctx, hx, 18, 8, C.handoff, true);
      if (prg > 210 && prg < 215) {
        ctx.fillStyle = "#fde68a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.fillText("transcript →", hx + 20, 12);
      }
    } else {
      this.active = false;
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
    var prg = (frame * 0.038) % 240;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var switchTargets = {
      "1_architect": { x: -85, y: 58 },
      "2_seo": { x: -28, y: 68 },
      "3_coder": { x: 28, y: 68 },
      "4_designer": { x: 85, y: 58 },
      "5_deployer": { x: 0, y: 78 }
    };
    var tgt = switchTargets[this.role] || { x: 0, y: 62 };

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
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 210 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 210);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.2;
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
  var callArc = new InboundCallArc();
  var console = new VoiceDialogConsole();
  var latency = new LatencyMeter();
  var handoff = new OperatorHandoffBridge();

  entities.push(callArc);
  entities.push(handoff);
  entities.push(console);
  entities.push(latency);
  entities.push(new Agent(-135, 98, C.agentYellow, "1_architect", 20, [
    "Сценарий «запись» готов", "SIP-маршрут настроен", "Аудит 30 звонков"
  ]));
  entities.push(new Agent(-68, 108, C.agentGreen, "2_seo", 58, [
    "Intent = booking", "BANT-поля в скрипте", "Квалификация без очереди"
  ]));
  entities.push(new Agent(0, 112, C.agentBlue, "3_coder", 102, [
    "ASR → YandexGPT", "Guardrails включены", "TTS latency 95 ms"
  ]));
  entities.push(new Agent(68, 108, C.agentPink, "4_designer", 148, [
    "Barge-in настроен", "Голос: дружелюбный", "Handoff UX готов"
  ]));
  entities.push(new Agent(135, 98, C.agentPurple, "5_deployer", 188, [
    "Mango SIP ✓", "POST amoCRM 201", "SMS после звонка"
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

    var prg = (frame * 0.038) % 240;
    if (prg >= 18 && prg < 18.05) createBubble(-110, -35, "1. Входящий звонок");
    if (prg >= 62 && prg < 62.05) createBubble(-65, 15, "2. ASR + intent");
    if (prg >= 108 && prg < 108.05) createBubble(0, -5, "3. Квалификация BANT");
    if (prg >= 158 && prg < 158.05) createBubble(55, 25, "4. Лид в CRM");
    if (prg >= 198 && prg < 198.05) createBubble(105, -15, "5. Handoff / SMS");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.phoneAccent);
      ctx.fillStyle = C.bubbleText;
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
  document.querySelectorAll('.vgab-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vgab-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vgab-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vgab-faq-q');if(q)q.setAttribute('aria-expanded','false');
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
  var root=document.querySelector('.vgab-content');
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
