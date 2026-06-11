<?php
/**
 * Template Name: AI-обработка документов: счета, акты и заявки под ключ
 * Description: SEO-лендинг — внедрение AI для обработки счетов, актов и заявок. OCR/IDP, интеграции, кейсы. Тест на 20 документах.
 */

$page_seo_title       = 'AI-обработка документов: счета, акты и заявки под ключ';
$page_seo_description = 'Внедрение AI для обработки счетов, актов и заявок: распознавание, извлечение полей, проверка ошибок, интеграция с CRM и 1С. Протестируйте решение на 20 документах бесплатно.';

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
    ['label' => 'Зачем', 'href' => '#zachem'],
    ['label' => 'Документы', 'href' => '#dokumenty'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Загрузить документы для теста';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

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

.vdoc-content{
  --vdoc-bg:#050711;--vdoc-bg2:#080b17;--vdoc-bg3:#0a0e1c;
  --vdoc-surface:rgba(255,255,255,.072);--vdoc-surface2:rgba(255,255,255,.108);
  --vdoc-text:#e6edf7;--vdoc-muted:#9aa8bd;--vdoc-soft:#c7d2e5;--vdoc-heading:#fff;
  --vdoc-border:rgba(255,255,255,.10);--vdoc-border-s:rgba(255,255,255,.18);
  --vdoc-accent:#f59e0b;--vdoc-violet:#8b5cf6;--vdoc-green:#22c55e;--vdoc-cyan:#38bdf8;
  --vdoc-btn-from:#7c3aed;--vdoc-btn-to:#f59e0b;
  --vdoc-shadow:0 24px 72px rgba(0,0,0,.4);
  --vdoc-r:18px;--vdoc-r-lg:24px;--vdoc-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vdoc-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vdoc-content *,.vdoc-content *::before,.vdoc-content *::after{box-sizing:border-box;}
.vdoc-content a{color:inherit;text-decoration:none;}
.vdoc-content p{color:var(--vdoc-muted);line-height:1.72;margin:0 0 1em;}
.vdoc-content p:last-child{margin-bottom:0;}
.vdoc-content h2,.vdoc-content h3,.vdoc-content h4{color:var(--vdoc-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.vdoc-content strong{color:var(--vdoc-soft);}
.vdoc-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vdoc-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vdoc-muted);font-size:14.5px;line-height:1.65;}
.vdoc-content ul li::before{content:'›';position:absolute;left:0;color:var(--vdoc-accent);font-weight:700;}
.vdoc-cnt{width:min(var(--vdoc-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.vdoc-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vdoc-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.vdoc-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vdoc-sh.vdoc-left{margin-left:0;text-align:left;}
.vdoc-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vdoc-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vdoc-sh.vdoc-left p{margin-left:0;}
.vdoc-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vdoc-accent);margin-bottom:14px;}
.vdoc-gt{background:linear-gradient(92deg,#fff 0%,var(--vdoc-accent) 44%,var(--vdoc-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.vdoc-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vdoc-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.vdoc-intro-text{position:relative;padding-left:20px;}
.vdoc-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vdoc-accent),var(--vdoc-violet));}
.vdoc-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vdoc-muted);margin-bottom:1em;}
.vdoc-intro-text p:last-child{margin-bottom:0;color:var(--vdoc-soft);}
.vdoc-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.vdoc-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.vdoc-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vdoc-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.vdoc-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vdoc-muted);line-height:1.4;}
.vdoc-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.vdoc-intro-grid{grid-template-columns:1fr;gap:36px;}.vdoc-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.vdoc-intro-kpi{grid-template-columns:1fr 1fr;}}
.vdoc-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vdoc-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.vdoc-toc a{display:inline-block;padding:9px 18px;background:var(--vdoc-surface);border:1px solid var(--vdoc-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vdoc-muted);transition:border-color .2s,color .2s,background .2s;}
.vdoc-toc a:hover{border-color:rgba(245,158,11,.42);color:var(--vdoc-accent);background:rgba(245,158,11,.08);}
.vdoc-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vdoc-border);border-radius:var(--vdoc-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.vdoc-card:hover{border-color:rgba(245,158,11,.28);transform:translateY(-2px);}
.vdoc-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vdoc-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.vdoc-grid-2,.vdoc-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.vdoc-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vdoc-grid-3{grid-template-columns:1fr;}}
.vdoc-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--vdoc-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.vdoc-scenario:last-child{margin-bottom:0;}
.vdoc-scenario:hover{border-color:rgba(245,158,11,.3);}
.vdoc-scenario h3{font-size:17px;margin-bottom:8px;}
.vdoc-scenario p{font-size:14.5px;margin:0 0 .6em;}
.vdoc-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.vdoc-table{width:100%;border-collapse:collapse;font-size:14px;}
.vdoc-table th{padding:13px 16px;text-align:left;background:rgba(245,158,11,.1);color:var(--vdoc-accent);font-weight:700;border-bottom:1px solid rgba(245,158,11,.25);white-space:nowrap;}
.vdoc-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vdoc-text);vertical-align:top;}
.vdoc-table tr:last-child td{border-bottom:none;}
.vdoc-table tr:hover td{background:rgba(255,255,255,.03);}
.vdoc-timeline{position:relative;padding-left:40px;}
.vdoc-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vdoc-accent),var(--vdoc-violet));opacity:.35;border-radius:2px;}
.vdoc-tl-item{position:relative;margin-bottom:32px;}
.vdoc-tl-item:last-child{margin-bottom:0;}
.vdoc-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vdoc-accent);box-shadow:0 0 0 4px rgba(245,158,11,.2);}
.vdoc-tl-item h3{font-size:17px;margin-bottom:8px;}
.vdoc-tl-item p{font-size:14.5px;margin:0;}
.vdoc-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vdoc-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vdoc-case-grid{grid-template-columns:1fr;}}
.vdoc-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.vdoc-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vdoc-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vdoc-green);margin-bottom:10px;}
.vdoc-case-card h3{font-size:16px;margin-bottom:14px;}
.vdoc-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vdoc-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.vdoc-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vdoc-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.vdoc-faq-q::after{content:'▾';font-size:13px;color:var(--vdoc-accent);flex-shrink:0;transition:transform .25s;}
.vdoc-faq-item.open .vdoc-faq-q::after{transform:rotate(180deg);}
.vdoc-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vdoc-muted);line-height:1.72;}
.vdoc-faq-item.open .vdoc-faq-a{max-height:600px;padding:0 24px 20px;}
.vdoc-pipeline{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin:28px 0;}
.vdoc-pipe-step{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:18px 14px;text-align:center;}
.vdoc-pipe-step strong{display:block;color:var(--vdoc-heading);font-size:14px;margin-bottom:6px;}
.vdoc-pipe-step span{font-size:12px;color:var(--vdoc-muted);line-height:1.5;}
@media(max-width:768px){.vdoc-pipeline{grid-template-columns:1fr 1fr;}}
.vdoc-demo-box{background:linear-gradient(135deg,rgba(124,58,237,.12),rgba(245,158,11,.08));border:2px dashed rgba(245,158,11,.35);border-radius:20px;padding:40px 32px;text-align:center;margin:28px 0;}
.vdoc-demo-box h3{color:var(--vdoc-heading);font-size:clamp(20px,2.5vw,26px);margin-bottom:12px;}
.vdoc-demo-box p{max-width:560px;margin:0 auto 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,158,11,.12),rgba(139,92,246,.1));border:1px solid rgba(245,158,11,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,158,11,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--vdoc-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vdoc-btn-from),var(--vdoc-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(124,58,237,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--vdoc-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--vdoc-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page vdoc-page" role="main" tabindex="-1">

<section class="nero-ai-hero vdoc-hero" id="hero" aria-labelledby="vdoc-hero-title">
<style>
/* ── Hero IDP документы: самодостаточные стили ── */
.vdoc-hero {
  --vdoc-amber: #f59e0b;
  --vdoc-emerald: #10b981;
  --vdoc-sky: #38bdf8;
  --vdoc-violet: #a78bfa;
  --vdoc-text: #e6edf7;
  --vdoc-muted: #9aa8bd;
  --vdoc-soft: #c7d2e5;
  --vdoc-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vdoc-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 32%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vdoc-hero::after {
  content: "";
  position: absolute;
  left: 58%;
  top: 14%;
  width: 760px;
  height: 760px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 158, 11, .11), transparent 66%);
  filter: blur(8px);
  animation: vdocHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vdocHeroGlow {
  from { opacity: .42; transform: translateX(-50%) scale(.95); }
  to { opacity: .8; transform: translateX(-50%) scale(1.06); }
}
.vdoc-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vdoc-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vdoc-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.6vw, 70px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vdoc-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vdoc-amber) 40%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vdoc-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 158, 11, 0.22);
  border-radius: 999px;
  background: rgba(245, 158, 11, 0.08);
  color: var(--vdoc-amber) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.vdoc-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--vdoc-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vdoc-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vdoc-hero .nero-ai-badge {
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
.vdoc-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vdoc-hero .nero-ai-btn {
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
.vdoc-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.vdoc-hero .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--vdoc-amber), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 158, 11, 0.22);
}
.vdoc-hero .nero-ai-btn-secondary {
  color: var(--vdoc-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vdoc-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vdoc-shadow);
  transform: perspective(1100px) rotateY(-4deg) rotateX(2deg);
}
.vdoc-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vdoc-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vdoc-hero .nero-ai-dots { display: flex; gap: 7px; }
.vdoc-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vdoc-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vdoc-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vdoc-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.vdoc-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vdoc-hero .nero-ai-window-body { padding: 16px; }
.vdoc-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vdoc-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vdoc-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(16,185,129,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.vdoc-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vdocPulse 1.6s infinite;
}
@keyframes vdocPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vdoc-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vdoc-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vdoc-hero .nero-ai-metric span {
  display: block;
  color: var(--vdoc-muted);
  font-size: 11px;
  font-weight: 700;
}
.vdoc-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vdoc-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vdoc-hero .vdoc-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(245, 158, 11, 0.16);
  background: radial-gradient(ellipse at 50% 35%, rgba(245,158,11,.07), rgba(6,10,24,.92) 72%);
}
.vdoc-hero #vdoc-idp-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vdoc-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.vdoc-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vdoc-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(245,158,11,.12);
  color: var(--vdoc-amber);
  font-size: 11px;
  font-weight: 800;
}
.vdoc-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vdoc-hero .nero-ai-task span {
  color: var(--vdoc-muted);
  font-size: 11px;
}
.vdoc-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vdoc-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.vdoc-hero .nero-ai-status--rose {
  background: rgba(251,113,133,.12);
  color: #fecdd3;
}
@media (max-width: 1100px) {
  .vdoc-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vdoc-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vdoc-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vdoc-hero .nero-ai-window-body { padding: 12px; }
  .vdoc-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vdoc-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow">AI · документооборот · IDP</p>
    <h1 id="vdoc-hero-title">AI-обработка документов: <span class="nero-ai-gradient-text">счета, акты и заявки</span> под ключ</h1>
    <p class="nero-ai-hero-lead">Нейросеть распознаёт входящие документы, извлекает поля, проверяет ошибки и передаёт данные в CRM или учёт — без ручного переноса. Протестируйте на 20 документах.</p>
    <ul class="nero-ai-badges" aria-label="Типы документов и технологии">
      <li class="nero-ai-badge">Счета</li>
      <li class="nero-ai-badge">Акты</li>
      <li class="nero-ai-badge">Накладные</li>
      <li class="nero-ai-badge">Заявки</li>
      <li class="nero-ai-badge">OCR/IDP</li>
      <li class="nero-ai-badge">1С/CRM</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="#demo">Загрузить документы для теста</a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация IDP-обработки документов">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>IDP · обработка документов</h3>
          <span class="nero-ai-live-pill">онлайн</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>В очереди</span>
            <strong>12</strong>
            <small>счета + акты</small>
          </div>
          <div class="nero-ai-metric">
            <span>Точность полей</span>
            <strong>91%</strong>
            <small>пилот 20 док.</small>
          </div>
          <div class="nero-ai-metric">
            <span>Время на док.</span>
            <strong>1,8 мин</strong>
            <small>скан → черновик</small>
          </div>
          <div class="nero-ai-metric">
            <span>STP rate</span>
            <strong>68%</strong>
            <small>без правок</small>
          </div>
        </div>

        <div class="vdoc-dash-canvas-wrap" aria-hidden="false">
          <canvas id="vdoc-idp-canvas" role="img" aria-label="Анимация IDP: документы по вертикальному лифту распознаются, поля проверяются и экспортируются в 1С или CRM"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента событий IDP">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">СФ</span>
            <div><strong>Счёт №1847 распознан</strong><span>12 полей · confidence 0.94</span></div>
            <span class="nero-ai-status">готово</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">НДС</span>
            <div><strong>НДС сверен с эталоном</strong><span>арифметика строк = итог</span></div>
            <span class="nero-ai-status">ок</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">ИНН</span>
            <div><strong>Ошибка ИНН → верификатор</strong><span>human-in-the-loop</span></div>
            <span class="nero-ai-status nero-ai-status--amber">review</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">1С</span>
            <div><strong>Черновик в 1С создан</strong><span>проводка без ручного ввода</span></div>
            <span class="nero-ai-status">экспорт</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<script>
/**
 * vdoc-idp-engine — Архив-сканер IDP «Первичка под ключ»
 * Мир: вертикальный лифт документов → VerifierTerminal → штамп → IntegrationPortal
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vdoc-idp-canvas");
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
    scale = Math.min(cw / 440, ch / 290) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    paper: "#f8fafc",
    paperLine: "#cbd5e1",
    scanGlow: "rgba(56,189,248,0.35)",
    fieldChip: "#a7f3d0",
    fieldErr: "#fecaca",
    terminalBg: "#1e293b",
    terminalPanel: "#0f172a",
    amber: "#f59e0b",
    emerald: "#10b981",
    rose: "#fb7185",
    violet: "#a78bfa",
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

  function drawDocSheet(ctx, x, y, w, h, label, accent) {
    ctx.save();
    ctx.translate(x, y);
    drawRR(ctx, -w / 2, -h / 2, w, h, 3, C.paper, C.outline);
    for (var i = 0; i < 3; i++) {
      drawRR(ctx, -w / 2 + 4, -h / 2 + 8 + i * 7, w - 8, 3, 1, C.paperLine, null);
    }
    if (label) {
      drawRR(ctx, -w / 2 + 4, h / 2 - 14, w - 8, 10, 2, accent || "rgba(245,158,11,0.25)", C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, 0, h / 2 - 6);
    }
    ctx.restore();
  }

  /* Вертикальный лифт документов — не конвейер */
  function DocumentCarousel() {
    this.docs = [
      { label: "Счёт", color: "rgba(245,158,11,0.3)" },
      { label: "Акт", color: "rgba(16,185,129,0.28)" },
      { label: "ТОРГ", color: "rgba(56,189,248,0.28)" },
      { label: "Заявка", color: "rgba(167,139,250,0.28)" }
    ];
  }
  DocumentCarousel.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    drawRR(ctx, -175, -95, 28, 190, 6, "rgba(15,23,42,0.6)", C.outline);
    ctx.strokeStyle = "rgba(245,158,11,0.35)";
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 6]);
    ctx.beginPath();
    ctx.moveTo(-161, -80);
    ctx.lineTo(-161, 80);
    ctx.stroke();
    ctx.setLineDash([]);

    for (var i = 0; i < 4; i++) {
      var slot = (prg * 0.55 + i * 48) % 192;
      var dy = -72 + slot;
      if (dy > 85) continue;
      var doc = this.docs[i % 4];
      var wobble = Math.sin(frame * 0.06 + i) * 2;
      drawDocSheet(ctx, -161 + wobble, dy, 18, 24, doc.label, doc.color);
    }

    if (prg > 8 && prg < 45) {
      var intakeY = -72 + ((prg - 8) / 37) * 100;
      ctx.fillStyle = C.scanGlow;
      ctx.beginPath();
      ctx.arc(-161, intakeY, 14 + Math.sin(frame * 0.12) * 3, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  /* Центральный терминал верификатора — не WebsiteTerminal */
  function VerifierTerminal() {
    this.extractPhase = 0;
  }
  VerifierTerminal.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    drawRR(ctx, -70, -88, 140, 176, 10, C.terminalBg, C.outline);

    var lx = -62, ly = -78, lw = 58, lh = 156;
    var rx = 2, ry = -78, rw = 58, rh = 156;

    drawRR(ctx, lx, ly, lw, lh, 6, C.terminalPanel, C.outline);
    drawRR(ctx, rx, ry, rw, rh, 6, "#0b1220", C.outline);

    ctx.fillStyle = "rgba(255,255,255,0.5)";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("СКАН", lx + lw / 2, ly - 6);
    ctx.fillText("ПОЛЯ", rx + rw / 2, ry - 6);

    if (prg >= 25) {
      drawDocSheet(ctx, lx + lw / 2, ly + 40, 36, 48, null, null);
      if (prg >= 25 && prg < 70) {
        var scanLine = ly + 10 + ((prg - 25) / 45) * (lh - 20);
        ctx.strokeStyle = "rgba(56,189,248,0.85)";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(lx + 4, scanLine);
        ctx.lineTo(lx + lw - 4, scanLine);
        ctx.stroke();
      }
    }

    if (prg >= 55 && prg < 115) {
      var fields = ["ИНН", "Сумма", "НДС", "Строки"];
      fields.forEach(function (f, i) {
        var fy = ry + 14 + i * 28;
        var chipColor = i === 2 && prg > 95 && prg < 108 ? C.fieldErr : C.fieldChip;
        drawRR(ctx, rx + 6, fy, rw - 12, 18, 4, chipColor, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(f, rx + 10, fy + 12);
      });
    }

    if (prg >= 115) {
      fields = ["ИНН ✓", "Сумма ✓", "НДС ✓", "12 строк"];
      fields.forEach(function (f, i) {
        var fy2 = ry + 14 + i * 28;
        drawRR(ctx, rx + 6, fy2, rw - 12, 18, 4, C.fieldChip, C.emerald);
        ctx.fillStyle = "#064e3b";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(f, rx + 10, fy2 + 12);
      });
    }
  };

  /* Лампа сверки НДС */
  function NdsChecker() {
    this.alert = false;
  }
  NdsChecker.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    var lampOn = prg >= 95 && prg < 115;
    var lampOk = prg >= 115;
    drawRR(ctx, 88, -70, 34, 22, 6, "rgba(15,23,42,0.7)", C.outline);
    ctx.fillStyle = lampOk ? C.emerald : (lampOn ? C.rose : "#475569");
    ctx.beginPath();
    ctx.arc(105, -59, 6, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("НДС", 105, -42);
    if (lampOn) {
      ctx.strokeStyle = "rgba(251,113,133," + (0.4 + Math.sin(frame * 0.2) * 0.3) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(105, -59, 12 + Math.sin(frame * 0.15) * 4, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Печать «Проверено» */
  function ValidationStamp() {
    this.stampScale = 0;
  }
  ValidationStamp.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    if (prg < 118) return;
    var t = Math.min(1, (prg - 118) / 12);
    this.stampScale = t;
    ctx.save();
    ctx.translate(0, 55);
    ctx.scale(0.6 + t * 0.5, 0.6 + t * 0.5);
    ctx.globalAlpha = 0.55 + t * 0.45;
    ctx.strokeStyle = C.emerald;
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(0, 0, 22, 0, Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = C.emerald;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ПРОВЕРЕНО", 0, 4);
    ctx.restore();
  };

  /* Шлюз 1С / CRM */
  function IntegrationPortal() {
    this.packetY = 0;
  }
  IntegrationPortal.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    drawRR(ctx, 55, 48, 90, 42, 8, "rgba(15,23,42,0.75)", C.outline);
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("1С", 78, 72);
    ctx.fillStyle = C.violet;
    ctx.fillText("CRM", 118, 72);

    if (prg >= 155) {
      var fly = Math.min(1, (prg - 155) / 20);
      var py = 20 - fly * 35;
      drawRR(ctx, -8, py, 16, 12, 3, C.amber, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.fillText("JSON", 0, py + 8);

      ctx.strokeStyle = "rgba(16,185,129," + (0.3 + fly * 0.6) + ")";
      ctx.lineWidth = 2;
      ctx.setLineDash([3, 4]);
      ctx.beginPath();
      ctx.moveTo(0, py + 12);
      ctx.lineTo(78, 48);
      ctx.stroke();
      ctx.beginPath();
      ctx.moveTo(0, py + 12);
      ctx.lineTo(118, 48);
      ctx.stroke();
      ctx.setLineDash([]);
    }

    if (prg >= 185 && prg < 210) {
      var pulse = (prg - 185) / 25;
      ctx.strokeStyle = "rgba(16,185,129," + (0.8 - pulse * 0.7) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(100, 68, 18 + pulse * 30, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Частицы полей — вспомогательная анимация окружения */
  function FieldParticleStream() {
    this.particles = [];
    for (var p = 0; p < 8; p++) {
      this.particles.push({ t: p * 0.12, speed: 0.008 + Math.random() * 0.006 });
    }
  }
  FieldParticleStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    if (prg < 55 || prg > 120) return;
    this.particles.forEach(function (pt) {
      pt.t = (pt.t + pt.speed) % 1;
      var x = -30 + pt.t * 50;
      var y = -20 + Math.sin(pt.t * Math.PI * 2) * 18;
      ctx.fillStyle = "rgba(167,243,208," + (0.35 + Math.sin(frame * 0.1 + pt.t * 10) * 0.2) + ")";
      ctx.beginPath();
      ctx.arc(x, y, 2, 0, Math.PI * 2);
      ctx.fill();
    });
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.hitAnimation = 0;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var isMoving = false;
    var carryType = null;
    var faceDir = 1;
    var prg = (frame * 0.045) % 220;
    var targetX = -20 + (this.stepTrig * 0.15);
    var targetY = -55 + (this.stepTrig * 0.08);

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var localPrg = prg - this.stepTrig;
      if (localPrg < 11) {
        isMoving = true; faceDir = 1; carryType = this.color;
        this.x = this.baseX + (targetX - this.baseX) * (localPrg / 11);
        this.y = this.baseY + (targetY - this.baseY) * (localPrg / 11);
      } else if (localPrg < 14) {
        this.x = targetX; this.y = targetY;
      } else {
        isMoving = true; faceDir = -1;
        this.x = targetX - (targetX - this.baseX) * ((localPrg - 14) / 8);
        this.y = targetY - (targetY - this.baseY) * ((localPrg - 14) / 8);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 12 ? this.color : null;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.5) * (isMoving ? 2 : 1);
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = isMoving ? Math.sin(this.timer * 6) * 5 : 0;
    var legR = isMoving ? Math.sin(this.timer * 6 + Math.PI) * 5 : 0;
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
    drawRR(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
    drawRR(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
    drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);
    var hx = 0, hy = -28 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath(); ctx.arc(hx, hy, 12, 0, Math.PI * 2); ctx.fill();
    ctx.lineWidth = 2; ctx.strokeStyle = C.outline; ctx.stroke();
    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    if (this.role === "1_architect") {
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1;
      ctx.strokeRect(hx + 1, hy - 5, 6, 6); ctx.strokeRect(hx - 7, hy - 5, 6, 6);
    } else if (this.role === "3_coder" && prg > 50 && prg < 110) {
      drawRR(ctx, 12, -18 - bob, 10, 12, 2, C.paper, C.outline);
    }
    ctx.restore();
    if (carryType) drawRR(ctx, -18 * faceDir, -18 - bob, 14, 14, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var carousel = new DocumentCarousel();
  var terminal = new VerifierTerminal();
  var nds = new NdsChecker();
  var stamp = new ValidationStamp();
  var portal = new IntegrationPortal();
  var particles = new FieldParticleStream();

  entities.push(carousel);
  entities.push(particles);
  entities.push(terminal);
  entities.push(nds);
  entities.push(stamp);
  entities.push(portal);
  entities.push(new Agent(-200, 75, C.agentYellow, "1_architect", 18, [
    "Карта бланков клиента", "Счёт или акт?", "20 образцов на пилот"
  ]));
  entities.push(new Agent(-130, 95, C.agentGreen, "2_seo", 48, [
    "Класс: накладная ТОРГ-12", "Тип PDF определён", "Пачка из 3 стр."
  ]));
  entities.push(new Agent(-55, 88, C.agentBlue, "3_coder", 78, [
    "OCR + LLM fallback", "Таблица: 12 строк", "ИНН извлечён"
  ]));
  entities.push(new Agent(15, 92, C.agentPink, "4_designer", 108, [
    "НДС не сходится!", "Сверка с DaData", "Порог confidence 0.85"
  ]));
  entities.push(new Agent(75, 78, C.agentPurple, "5_deployer", 168, [
    "Черновик в 1С", "Webhook в amoCRM", "STP без правок"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 240, maxLife: life || 240 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);
    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.045) % 220;
    if (prg >= 16 && prg < 16.08) createBubble(-161, -40, "1. Скан в очередь");
    if (prg >= 46 && prg < 46.08) createBubble(-130, 55, "2. Классификация");
    if (prg >= 76 && prg < 76.08) createBubble(-55, 50, "3. Извлечение полей");
    if (prg >= 106 && prg < 106.08) createBubble(15, 55, "4. Валидация НДС");
    if (prg >= 166 && prg < 166.08) createBubble(75, 40, "5. Экспорт в учёт");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 12) alpha = (bub.maxLife - bub.life) / 12;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      drawRR(ctx, bub.x - tw / 2, bub.y - 18, tw, 18, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, bub.y - 8);
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


<div class="vdoc-content">

  <section class="vdoc-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vdoc-cnt">
      <div class="vdoc-intro-grid nero-ai-reveal">
        <div class="vdoc-intro-text">
          <p class="vdoc-eyebrow">Лонгрид · IDP · документооборот</p>
          <p><strong>Коротко:</strong> Nero Network внедряет AI-обработку входящих документов — счетов, актов, накладных и заявок. Нейросеть распознаёт PDF и сканы, извлекает поля, проверяет ошибки и передаёт данные в 1С, CRM или документооборот без ручного переноса.</p>
          <p><strong>Определение:</strong> IDP — интеллектуальная обработка документов: классификация → извлечение полей → валидация → маршрутизация → передача в ERP/CRM/СЭД. По McKinsey State of AI 2025, <strong>88%</strong> организаций уже используют AI, но EBIT даёт <strong>перестройка workflow</strong>, а не «ещё один инструмент».</p>
        </div>
        <div class="vdoc-intro-kpi" aria-label="Ключевые метрики IDP">
          <div class="vdoc-kpi-card"><div class="kv">88%</div><div class="kl">организаций используют AI</div><div class="ks">McKinsey 2025</div></div>
          <div class="vdoc-kpi-card"><div class="kv">2 дня→1 ч</div><div class="kl">обработка счёта</div><div class="ks">кейс «Подружка»</div></div>
          <div class="vdoc-kpi-card"><div class="kv">20 мин→2 мин</div><div class="kl">обработка УПД</div><div class="ks">«Альфа-Лизинг»</div></div>
          <div class="vdoc-kpi-card"><div class="kv">20 док.</div><div class="kl">бесплатный пилот</div><div class="ks">лид-магнит</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vdoc-toc-outer">
    <div class="vdoc-cnt">
      <nav class="vdoc-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем</a>
        <a href="#dokumenty">Документы</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#demo">Тест 20 док.</a>
      </nav>
    </div>
  </div>

  <section class="vdoc-section" id="zachem">
    <div class="vdoc-cnt">
      <div class="vdoc-sh">
        <span class="vdoc-eyebrow">Зачем бизнесу</span>
        <h2>Зачем бизнесу AI-обработка документов</h2>
        <p>Каждый день приходят счета, акты, накладные и заявки — сотрудники переносят данные вручную и ошибаются. AI-обработка документов для бизнеса закрывает эту боль системно.</p>
      </div>
      <div class="vdoc-grid-3 nero-ai-reveal">
        <div class="vdoc-card">
          <h3>Ручной перенос и типовые ошибки</h3>
          <p>Ошибка в НДС, опечатка в р/с или неверная позиция оборачивается переплатой, штрафом ФНС или задержкой закрытия периода. Кейс «Подружка»: время обработки счёта <strong>с 2 дней до 1 часа</strong>, точность классификации — <strong>95%</strong>.</p>
        </div>
        <div class="vdoc-card nero-ai-delay-1">
          <h3>Бухгалтерия, опт, логистика</h3>
          <p>«Альфа-Лизинг»: УПД <strong>20 мин → ~2 мин</strong>, ~<strong>13 ₽</strong>/документ. «Дороги и Мосты»: <strong>&gt;5 000 док./мес.</strong>, время <strong>−70%</strong>. «Ренессанс Жизнь»: <strong>5–6 мин → 20–30 сек</strong>.</p>
        </div>
        <div class="vdoc-card nero-ai-delay-2">
          <h3>Не «модный OCR»</h3>
          <p>AI убирает ручной перенос там, где он дороже всего: в первичке, закупках и входящем потоке. Человек подключается при низком confidence или нестандартном бланке.</p>
        </div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="vdoc-section vdoc-section-alt" id="dokumenty">
    <div class="vdoc-cnt">
      <div class="vdoc-sh">
        <span class="vdoc-eyebrow">Типы документов</span>
        <h2>Какие документы автоматизируем: счета, акты, накладные и заявки</h2>
        <p>Nero Network настраивает внедрение AI-обработки документов под ваши типы входящих файлов.</p>
      </div>
      <div class="vdoc-table-wrap nero-ai-reveal">
        <table class="vdoc-table">
          <thead><tr><th>Тип документа</th><th>Ключевые поля</th><th>Валидация</th></tr></thead>
          <tbody>
            <tr><td><strong>Счёт на оплату</strong></td><td>номер, дата, ИНН/КПП, банк, сумма, НДС, строки</td><td>контрагент, арифметика, дубликаты</td></tr>
            <tr><td><strong>Акт / услуги</strong></td><td>дата, стороны, договор, перечень работ, суммы</td><td>связка с договором и платежами</td></tr>
            <tr><td><strong>ТОРГ-12, УПД</strong></td><td>шапка + табличная часть</td><td>комплекты, арифметика НДС</td></tr>
            <tr><td><strong>Заявка</strong></td><td>заявитель, номенклатура, срок, комментарий</td><td>маршрут согласования, остатки</td></tr>
          </tbody>
        </table>
      </div>
      <div class="nero-ai-reveal" style="margin-top:28px;">
        <div class="vdoc-scenario">
          <h3>Счета и счета-фактуры: какие поля извлекаем</h3>
          <p>При <strong>AI-распознавании счетов</strong> извлекаем шапку и табличную часть. <a href="https://portal.1c.ru/applications/1C-Document-Recognition" target="_blank" rel="noopener noreferrer">1С:РПД</a> — 250 страниц бесплатно; Nero Network дополняет: DaData, CRM, заявки. Deliveroo: <strong>15 мин → 45 сек</strong>, точность <strong>97,6%</strong>.</p>
        </div>
        <div class="vdoc-scenario">
          <h3>Акты и накладные: сверка с заказом</h3>
          <p>AI проверяет арифметику и связку с договором. «Альфа-Лизинг»: <strong>30 проверок</strong> по УПД. CORRECT (ПИКТА): трудоёмкость первички <strong>−80%</strong>.</p>
        </div>
        <div class="vdoc-scenario">
          <h3>Заявки и нестандартные формы</h3>
          <p>LLM-слой для свободной вёрстки и рукописи. «Ренессанс Жизнь»: корректность <strong>74%</strong>, MVP за <strong>2 недели</strong>. Цепочка <strong>распознали → проверили → передали</strong> — без копипаста между окнами.</p>
        </div>
      </div>
    </div>
  </section>

<section id="vnedrenie-ai-obrabotka-dokumentov-boris-block" class="vdoc-boris-root" aria-label="Анимация: типы документов проходят OCR, валидацию и передачу в 1С или CRM">
<style>
/* === БОРИС: prefix vdoc-b-, scoped внутри #vnedrenie-ai-obrabotka-dokumentov-boris-block === */
#vnedrenie-ai-obrabotka-dokumentov-boris-block.vdoc-boris-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-ey{
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
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-ey::before{
  content:'';
  width:18px;height:2px;
  background:#7c3aed;
  border-radius:1px;
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-ic{
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
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-pl-o{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.22);
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-pl-v{
  background:rgba(124,58,237,.08);
  color:#6d28d9;
  border:1.5px solid rgba(124,58,237,.22);
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-pl-b{
  background:rgba(14,165,233,.08);
  color:#0369a1;
  border:1.5px solid rgba(14,165,233,.22);
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-rgt{
  position:relative;
  background:linear-gradient(135deg,#faf5ff 0%,#ede9fe 28%,#f0f9ff 68%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-dokumentov-boris-block .vdoc-b-rgt{min-height:380px;}
}
#vdoc-idp-types-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="vdoc-b-cnt">
  <div class="vdoc-b-card">

    <div class="vdoc-b-lft">
      <span class="vdoc-b-ey">IDP · типы документов</span>
      <h3 class="vdoc-b-h3">Счёт, акт, накладная или заявка — одна очередь, разные правила валидации</h3>
      <ul class="vdoc-b-ul">
        <li><span class="vdoc-b-ic">1</span>Классификатор определяет тип: счёт, акт, ТОРГ-12/УПД или заявка</li>
        <li><span class="vdoc-b-ic">2</span>OCR + LLM извлекают ИНН, суммы, НДС и строки табличной части</li>
        <li><span class="vdoc-b-ic">3</span>Правила сверяют арифметику, контрагента и дубликаты с базой</li>
        <li><span class="vdoc-b-ic">?</span>Ошибка ИНН или низкий confidence — панель верификатора, остальное — в 1С/CRM</li>
      </ul>
      <div class="vdoc-b-pills">
        <span class="vdoc-b-pl vdoc-b-pl-o">Счета · Акты</span>
        <span class="vdoc-b-pl vdoc-b-pl-g">74–98% полей</span>
        <span class="vdoc-b-pl vdoc-b-pl-v">human-in-the-loop</span>
        <span class="vdoc-b-pl vdoc-b-pl-b">1С · CRM</span>
      </div>
      <p class="vdoc-b-foot">Дальше разберём, как нейросеть проходит путь от скана до готовых данных →</p>
    </div>

    <div class="vdoc-b-rgt">
      <canvas
        id="vdoc-idp-types-pipeline-canvas"
        aria-label="Анимация: четыре типа документов проходят OCR, валидацию полей и передаются в 1С или CRM"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('vdoc-idp-types-pipeline-canvas');
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
    paperBdr:'#cbd5e1',
    scan:'#8b5cf6',
    scanGlow:'rgba(139,92,246,.22)',
    ai:'#7c3aed',
    green:'#22c55e',
    red:'#ef4444',
    amber:'#f59e0b',
    blue:'#0ea5e9',
    onec:'#ffdd2d',
    onecPanel:'#1a1f2e',
    crm:'#3b82f6',
    field:'#ede9fe',
    fieldBdr:'#c4b5fd',
    line:'rgba(124,58,237,.28)',
    review:'#fef3c7',
    reviewBdr:'#fbbf24'
  };

  var LANES = [
    {type:'Счёт', color:C.amber, checks:['ИНН','Сумма','НДС'], dest:'1С', delay:0},
    {type:'Акт', color:C.green, checks:['Договор','Сумма'], dest:'1С', delay:90},
    {type:'УПД', color:C.blue, checks:['Таблица','НДС'], dest:'1С', delay:180},
    {type:'Заявка', color:C.scan, checks:['Заявитель','Срок'], dest:'CRM', delay:270, failCheck:1}
  ];

  var LOOP = 380;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawDoc(x,y,s,clr,label,alpha){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,s,s*1.3,5,C.paper,C.paperBdr,1.5);
    rr(x+5,y+7,s-10,9,2,clr,null,0);
    ctx.fillStyle=C.ink;
    ctx.font='bold 8px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('PDF',x+s/2,y+14);
    ctx.fillStyle=clr;
    ctx.font='bold 8px Inter,sans-serif';
    ctx.fillText(label,x+s/2,y+s*1.15);
    ctx.globalAlpha=1;
  }

  function drawOcrHub(cx,cy,w,h,pulse){
    rr(cx,cy,w,h,14,'rgba(124,58,237,.07)',C.ai,2);
    ctx.fillStyle=C.ai;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('OCR + извлечение',cx+w/2,cy+16);

    var scanY = cy + 24 + (pulse % (h-40));
    ctx.fillStyle=C.scanGlow;
    ctx.fillRect(cx+10,scanY-3,w-20,6);
    ctx.strokeStyle=C.scan;
    ctx.lineWidth=2;
    ctx.beginPath();
    ctx.moveTo(cx+10,scanY);ctx.lineTo(cx+w-10,scanY);
    ctx.stroke();

    for(var i=0;i<4;i++){
      var ang=(i/4)*Math.PI*2+pulse*0.05;
      ctx.beginPath();
      ctx.arc(cx+w/2+Math.cos(ang)*18,cy+h/2+Math.sin(ang)*12,2.5,0,Math.PI*2);
      ctx.fillStyle=C.scan;ctx.fill();
    }
  }

  function drawValidator(x,y,w,h,active){
    rr(x,y,w,h,10,C.review,C.reviewBdr,active?2:1);
    ctx.fillStyle='#b45309';
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Верификатор',x+10,y+16);
    if(active){
      ctx.fillStyle=C.ink;
      ctx.font='8px Inter,sans-serif';
      ctx.fillText('ИНН ≠ база',x+10,y+32);
      ctx.fillStyle=C.red;
      ctx.font='bold 10px sans-serif';
      ctx.textAlign='right';
      ctx.fillText('!',x+w-12,y+28);
      var blink=0.5+0.5*Math.sin(frame*0.12);
      ctx.globalAlpha=blink;
      rr(x+8,y+h-22,w-16,14,4,'rgba(239,68,68,.15)',C.red,1);
      ctx.fillStyle=C.red;
      ctx.font='8px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('на проверку',x+w/2,y+h-12);
      ctx.globalAlpha=1;
    } else {
      ctx.fillStyle=C.muted;
      ctx.font='8px Inter,sans-serif';
      ctx.fillText('очередь пуста',x+10,y+30);
    }
  }

  function drawCheckRow(x,y,checks,results,w){
    checks.forEach(function(ch,i){
      var cy=y+i*22;
      var ok=results[i];
      rr(x,cy,w,18,5,ok?'rgba(34,197,94,.1)':'rgba(239,68,68,.08)',ok?C.green:C.red,1);
      ctx.fillStyle=ok?C.green:C.red;
      ctx.font='bold 9px sans-serif';
      ctx.textAlign='left';
      ctx.fillText(ok?'✓':'✗',x+8,cy+13);
      ctx.fillStyle=C.ink;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText(ch,x+22,cy+13);
    });
  }

  function drawDestPanel(x,y,w,h,label,bg,clr,count,pulse){
    rr(x,y,w,h,10,bg,'#334155',2);
    rr(x,y,w,24,10,clr,null,0);
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText(label,x+10,y+16);
    for(var i=0;i<3;i++){
      var sy=y+32+i*28;
      var filled=i<count;
      rr(x+8,sy,w-16,22,5,filled?'rgba(34,197,94,.12)':'rgba(255,255,255,.05)',filled?C.green:'rgba(255,255,255,.12)',1);
      if(filled){
        ctx.fillStyle=C.green;
        ctx.font='bold 11px sans-serif';
        ctx.textAlign='right';
        ctx.fillText('✓',x+w-14,sy+15);
      } else if(i===count){
        var prog=(pulse%50)/50;
        rr(x+12,sy+16,w-24,3,2,'rgba(255,255,255,.08)',null,0);
        rr(x+12,sy+16,(w-24)*prog,3,2,clr,null,0);
      }
    }
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);

    var pad=12;
    var hubW=Math.min(118,W*0.2);
    var hubH=Math.min(95,H*0.26);
    var hubX=W*0.34-hubW/2;
    var hubY=H*0.42-hubH/2;
    var valW=Math.min(100,W*0.17);
    var valH=Math.min(78,H*0.22);
    var valX=W*0.58-valW/2;
    var valY=H*0.18;
    var onecW=Math.min(88,W*0.15);
    var onecH=Math.min(118,H*0.32);
    var onecX=W-onecW-pad-4;
    var onecY=H*0.52-onecH/2;
    var crmW=onecW, crmH=onecH;
    var crmX=onecX;
    var crmY=H*0.12;

    drawOcrHub(hubX,hubY,hubW,hubH,frame);

    var onecCount=0, crmCount=0, verifierActive=false;

    LANES.forEach(function(lane,li){
      var localT=(t-lane.delay+LOOP)%LOOP;
      if(localT>LOOP-30) return;
      var laneY=pad+18+li*((H-pad*2-36)/4);
      var prog=Math.min(1,localT/160);
      var startX=pad;
      var endX=hubX-14;
      var docX=startX+(endX-startX)*Math.min(prog,0.42)/0.42;
      var docS=30;

      if(prog<0.42){
        drawDoc(docX,laneY-4,docS,lane.color,lane.type,1);
      } else if(prog<0.68){
        var ep=prog-0.42;
        drawDoc(hubX+hubW/2-docS/2,laneY-4,docS,lane.color,lane.type,1-ep*0.3);
        lane.checks.forEach(function(ch,i){
          var fx=hubX+hubW+10;
          var fy=laneY-8+i*20;
          var chipW=ch.length*6+14;
          rr(fx,fy,chipW,16,8,C.field,C.fieldBdr,1);
          ctx.fillStyle=C.ink;
          ctx.font='8px Inter,sans-serif';
          ctx.textAlign='center';
          ctx.fillText(ch,fx+chipW/2,fy+11);
        });
      } else if(prog<0.88){
        var vp=prog-0.68;
        var checkX=hubX+hubW+8;
        var results=lane.checks.map(function(_,i){
          if(lane.failCheck===i) return vp<0.55 ? true : false;
          return true;
        });
        drawCheckRow(checkX,laneY-10,lane.checks,results,72);

        if(lane.failCheck!==undefined && results[lane.failCheck]===false){
          verifierActive=true;
          ctx.strokeStyle=C.line;
          ctx.lineWidth=1.5;
          ctx.setLineDash([3,3]);
          ctx.beginPath();
          ctx.moveTo(checkX+76,laneY);ctx.lineTo(valX+valW/2,valY+valH);
          ctx.stroke();
          ctx.setLineDash([]);
        } else {
          var destX=lane.dest==='CRM'?crmX+crmW/2:onecX+onecW/2;
          var destY=lane.dest==='CRM'?crmY+crmH/2:onecY+onecH/2;
          ctx.strokeStyle=C.line;
          ctx.lineWidth=1.5;
          ctx.globalAlpha=vp;
          ctx.beginPath();
          ctx.moveTo(checkX+76,laneY);ctx.lineTo(destX,destY);
          ctx.stroke();
          ctx.globalAlpha=1;
          if(vp>0.5){
            if(lane.dest==='CRM') crmCount=Math.min(3,crmCount+1);
            else onecCount=Math.min(3,onecCount+1);
          }
        }
      }
    });

    drawValidator(valX,valY,valW,valH,verifierActive);
    drawDestPanel(onecX,onecY,onecW,onecH,'1С',C.onecPanel,C.onec,onecCount,frame);
    drawDestPanel(crmX,crmY,crmW,crmH,'CRM','#1e3a5f',C.crm,crmCount,frame);

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Входящие PDF',pad,H-10);
    ctx.textAlign='center';
    ctx.fillText('Распознали',hubX+hubW/2,H-10);
    ctx.fillText('Проверили',W*0.55,H-10);
    ctx.textAlign='right';
    ctx.fillText('Передали',W-pad,H-10);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>


  <section class="vdoc-section" id="kak-rabotaet">
    <div class="vdoc-cnt">
      <div class="vdoc-sh">
        <span class="vdoc-eyebrow">Технология</span>
        <h2>Как работает нейросеть: от скана до готовых данных</h2>
        <p><strong>Нейросеть для документов</strong> — пайплайн из нескольких модулей, а не один «магический» OCR.</p>
      </div>
      <div class="vdoc-pipeline nero-ai-reveal">
        <div class="vdoc-pipe-step"><strong>1. Вход</strong><span>PDF, JPG, email, сканер</span></div>
        <div class="vdoc-pipe-step"><strong>2. OCR + LLM</strong><span>классификация и извлечение</span></div>
        <div class="vdoc-pipe-step"><strong>3. Валидация</strong><span>НДС, ИНН, дубликаты</span></div>
        <div class="vdoc-pipe-step"><strong>4. Экспорт</strong><span>1С, CRM, СЭД</span></div>
      </div>
      <div class="vdoc-grid-2 nero-ai-reveal">
        <div class="vdoc-card">
          <h3>Распознавание и структура</h3>
          <p>Классификация типа документа, разбивка пачки страниц. OCR: Yandex Vision, 1С:РПД, Smart Engines, ABBYY — по требованиям 152-ФЗ.</p>
        </div>
        <div class="vdoc-card nero-ai-delay-1">
          <h3>Извлечение и валидация</h3>
          <p>Шаблоны + LLM fallback. Арифметика НДС, сверка ИНН через DaData, дубликаты. При confidence ниже порога — <strong>панель верификатора</strong> side-by-side.</p>
        </div>
      </div>
      <div class="vdoc-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Что делает AI / что остаётся за человеком</h3>
        <p><strong>AI:</strong> тип документа, извлечение полей, сопоставление контрагента, маршрут согласования. <strong>Человек:</strong> утверждение при низком confidence, новая номенклатура, юридические подписи, обучение на 50–200 документах. Ориентир точности: <strong>74–98%</strong> — диапазон для пилота, не гарантия.</p>
      </div>
    </div>
  </section>

  <section class="vdoc-section vdoc-section-alt" id="etapy">
    <div class="vdoc-cnt">
      <div class="vdoc-sh vdoc-left">
        <span class="vdoc-eyebrow">Под ключ</span>
        <h2>Внедрение AI-обработки документов под ключ</h2>
        <p>Ориентир чека: <strong>250 тыс.–1 млн ₽</strong>. Проектная модель с понятными этапами.</p>
      </div>
      <div class="vdoc-card nero-ai-reveal">
        <div class="vdoc-timeline">
          <div class="vdoc-tl-item"><div class="vdoc-tl-dot"></div><h3>Аудит потока (2–3 дня)</h3><p>20–50 образцов, карта полей, приоритетные сценарии. Сверка со смежными решениями: <a href="/ai-1c-erp/">ai-1c-erp</a> и <a href="/vnedrenie-ai-obrabotka-email-crm/">обработка почты в CRM</a>.</p></div>
          <div class="vdoc-tl-item"><div class="vdoc-tl-dot"></div><h3>Пилот на 20 документах</h3><p>Field accuracy, STP rate, время на документ. Лид-магнит страницы — снижаем порог для МСБ.</p></div>
          <div class="vdoc-tl-item"><div class="vdoc-tl-dot"></div><h3>Запуск и обучение</h3><p>Валидация, интеграция webhook/API, промышленная очередь, роль верификатора. Срок пилота: <strong>2–4 недели</strong>.</p></div>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-pilot">
        <div class="ym-cta-block__icon" aria-hidden="true">📄</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Тест на 20 документах — бесплатно</p>
          <p class="ym-cta-block__sub">Загрузите счета, акты, накладные или заявки — получите отчёт: точность по полям, список ошибок, время обработки. Без обязательств по полному внедрению.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>

      <div class="vdoc-demo-box nero-ai-reveal" id="demo" aria-label="Демо загрузки документов">
        <h3>Загрузите 20 документов для теста</h3>
        <p>PDF или JPG — счета, акты, накладные, заявки. На выходе: таблица полей с confidence, список ошибок, ориентир STP rate.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением IDP полезно разобраться в OCR, human-in-the-loop и интеграциях с 1С/CRM — это ускоряет согласование сценариев с бухгалтерией и IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="vdoc-section" id="integracii">
    <div class="vdoc-cnt">
      <div class="vdoc-sh">
        <span class="vdoc-eyebrow">Интеграции</span>
        <h2>Интеграция с CRM, 1С, ERP и документооборотом</h2>
        <p>Без передачи данных в учётную систему OCR остаётся игрушкой.</p>
      </div>
      <div class="vdoc-grid-2 nero-ai-reveal">
        <div class="vdoc-card">
          <h3>CRM: amoCRM, Битрикс24</h3>
          <p><strong>AI-обработка документов с CRM:</strong> поля создают сделку, задачу или карточку контрагента. Угол «счета + акты + заявки + CRM» в одном пайплайне — редкость на рынке.</p>
        </div>
        <div class="vdoc-card nero-ai-delay-1">
          <h3>1С и ERP</h3>
          <p>Черновики, сопоставление контрагентов и номенклатуры. Nero дополняет 1С:РПД: кастомная валидация, заявки, нестандартные формы.</p>
        </div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
      <div class="vdoc-card nero-ai-reveal" style="margin-top:20px;">
        <h3>Почта, сканеры, единый поток</h3>
        <p>Файлы с диска, вложения из почты, фото со сканера. «Автомир»: до <strong>100 000 стр./мес.</strong>, оптимизация бухгалтерии <strong>&gt;20%</strong>. Связка с ЭДО (Диадок) — как в кейсе «Подружка».</p>
      </div>
    </div>
  </section>

  <section class="vdoc-section vdoc-section-alt" id="keisy">
    <div class="vdoc-cnt">
      <div class="vdoc-sh">
        <span class="vdoc-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI в документооборот</h2>
        <p>Цифры зависят от потока и дисциплины пилота — ниже публичные истории с оговоркой об источнике.</p>
      </div>
      <div class="vdoc-case-grid nero-ai-reveal">
        <div class="vdoc-case-card"><div class="vdoc-case-tag">Розница</div><h3>«Подружка»</h3><p>100+ поставщиков. <strong>2 дня → 1 час</strong> на счёт; <strong>90%</strong> полноты реквизитов; до <strong>1,5 млн ₽/год</strong>.</p></div>
        <div class="vdoc-case-card"><div class="vdoc-case-tag">Лизинг</div><h3>«Альфа-Лизинг»</h3><p>УПД <strong>20 мин → ~2 мин</strong>, <strong>~13 ₽</strong>/документ, 30–40 док./день на специалиста.</p></div>
        <div class="vdoc-case-card"><div class="vdoc-case-tag">Строительство</div><h3>«Дороги и Мосты»</h3><p><strong>&gt;5 000 док./мес.</strong>, точность <strong>80%</strong>, время <strong>−70%</strong>.</p></div>
        <div class="vdoc-case-card"><div class="vdoc-case-tag">Страхование</div><h3>«Ренессанс Жизнь»</h3><p>YandexGPT: <strong>5–6 мин → 20–30 сек</strong>; корректность <strong>74%</strong>.</p></div>
        <div class="vdoc-case-card"><div class="vdoc-case-tag">Международный</div><h3>Deliveroo / Wolt</h3><p><strong>15 мин → 45 сек</strong>; <strong>60%</strong> STP; медиана проверки <strong>47 сек</strong>.</p></div>
        <div class="vdoc-case-card"><div class="vdoc-case-tag">Производство</div><h3>ПИКТА + CORRECT</h3><p>Трудоёмкость первички <strong>−80%</strong>, антифрод подделок <strong>−99,8%</strong>.</p></div>
      </div>
    </div>
  </section>

  <section class="vdoc-section" id="ceny">
    <div class="vdoc-cnt">
      <div class="vdoc-sh">
        <span class="vdoc-eyebrow">Коммерция</span>
        <h2>Стоимость, сроки и этапы проекта</h2>
        <p>Ориентир чека Nero Network: <strong>250 тыс.–1 млн ₽</strong>.</p>
      </div>
      <div class="vdoc-table-wrap nero-ai-reveal">
        <table class="vdoc-table">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th><th>Кому подходит</th></tr></thead>
          <tbody>
            <tr><td><strong>1С:РПД</strong></td><td>знакомый интерфейс, 250 стр. бесплатно</td><td>привязка к 1С</td><td>простые счета на 1С</td></tr>
            <tr><td><strong>Кастом IDP (Nero)</strong></td><td>валидация, CRM, пилот 20 док.</td><td>нужен проект</td><td>МСБ, смешанный поток</td></tr>
            <tr><td><strong>СЭД (Directum)</strong></td><td>сильные кейсы, ЭДО+1С</td><td>долгий цикл</td><td>крупный бизнес</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vdoc-card nero-ai-reveal" style="margin-top:20px;">
        <h3>ROI: меньше ручного труда и штрафов</h3>
        <p>Ориентиры: <strong>−60–80%</strong> времени на документ; экономия до <strong>1,5 млн ₽/год</strong>; <strong>~13 ₽</strong> за УПД. Аудит 2–3 дня, пилот 1–2 недели, полный запуск 2–4 недели — 2 месяца.</p>
      </div>
    </div>
  </section>

  <section class="vdoc-section vdoc-section-alt" id="faq">
    <div class="vdoc-cnt">
      <div class="vdoc-sh">
        <span class="vdoc-eyebrow">FAQ</span>
        <h2>FAQ: как внедрить AI-обработку документов</h2>
      </div>
      <div class="vdoc-faq nero-ai-reveal">
        <div class="vdoc-faq-item"><div class="vdoc-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли доработка под наши бланки?</div><div class="vdoc-faq-a">Да, на этапе пилота. Система обучается на <strong>20+ образцах</strong> каждого типа. Нестандартные счета — норма: дообучение повышает точность с <strong>80%</strong> и выше.</div></div>
        <div class="vdoc-faq-item"><div class="vdoc-faq-q" role="button" tabindex="0" aria-expanded="false">Безопасность и хранение коммерческих данных</div><div class="vdoc-faq-a">Облако в РФ по 152-ФЗ или on-premise при жёстких требованиях ИБ. Контур проектируется на аудите.</div></div>
        <div class="vdoc-faq-item"><div class="vdoc-faq-q" role="button" tabindex="0" aria-expanded="false">Что нужно для теста на 20 документах?</div><div class="vdoc-faq-a">20 файлов PDF/JPG, опционально справочник контрагентов, регламент обязательных полей. <a href="#demo">Загрузить документы для теста</a> — без обязательств.</div></div>
        <div class="vdoc-faq-item"><div class="vdoc-faq-q" role="button" tabindex="0" aria-expanded="false">AI-обработка документов для малого бизнеса — реально ли?</div><div class="vdoc-faq-a">Да, при потоке от <strong>50–100 док./мес.</strong> и боли ручного ввода. Пилот на 20 документах и чек от <strong>250 тыс. ₽</strong> доступнее корпоративного СЭД.</div></div>
        <div class="vdoc-faq-item"><div class="vdoc-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить AI-обработку документов пошагово?</div><div class="vdoc-faq-a">1) Аудит. 2) Пилот 20 док. 3) Валидация и интеграция. 4) Очередь и верификаторы. 5) Мониторинг STP и дообучение.</div></div>
        <div class="vdoc-faq-item"><div class="vdoc-faq-q" role="button" tabindex="0" aria-expanded="false">Автоматизация через AI — что получим на выходе?</div><div class="vdoc-faq-a">Структурированные данные в учётной системе, меньше ручного труда, прозрачные метрики, маршруты согласования. Цифровой конвейер первички — от скана до проводки.</div></div>
      </div>
    </div>
  </section>

  <section class="vdoc-section" id="itog">
    <div class="vdoc-cnt">
      <div class="vdoc-sh">
        <h2>Итог</h2>
        <p><strong>Nero Network</strong> внедряет <strong>AI-обработку документов под ключ</strong>: счета, акты, накладные и заявки — распознавание, извлечение полей, проверка ошибок, интеграция с 1С и CRM. Начните с теста на 20 документах.</p>
      </div>
    </div>
  </section>

  <section class="vdoc-section" id="cta" style="background:linear-gradient(135deg,rgba(245,158,11,.08),rgba(139,92,246,.08));">
    <div class="vdoc-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы убрать ручной перенос в первичке?</p>
          <p class="ym-cta-block__sub">Следующий шаг — тест на 20 документах и оценка точности на ваших бланках. Пилот на одном сценарии за 2–4 недели.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

</div>

<!-- SCHEMA-MARKUP:INSERT -->

<script>
(function(){
  document.querySelectorAll('.vdoc-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vdoc-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vdoc-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vdoc-faq-q');
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
  var root = document.querySelector('.vdoc-page') || document.querySelector('.vdoc-content');
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

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
