<?php
/**
 * Template Name: AI дебиторская задолженность: агент напоминаний под ключ
 * Description: SEO-лендинг — внедрение AI-агента для дебиторской задолженности. Калькулятор, интеграция CRM и 1С.
 */

$page_seo_title       = 'AI дебиторская задолженность: агент напоминаний под ключ';
$page_seo_description = 'Внедрение AI-агента для дебиторки: отслеживает счета, мягко напоминает клиентам об оплате и эскалирует просрочку. Интеграция с CRM и 1С, расчёт эффекта в калькуляторе.';

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
    ['label' => 'Дебиторка',    'href' => '#pochemu-rastet-debitorka'],
    ['label' => 'AI-агент',     'href' => '#chto-takoe-ai-agent'],
    ['label' => 'Сценарии',     'href' => '#scenarii-platezhnyh-napominanij'],
    ['label' => 'Внедрение',    'href' => '#vnedrenie-pod-klyuch'],
    ['label' => 'Калькулятор',  'href' => '#kalkulyator-debitorki'],
    ['label' => 'Стоимость',    'href' => '#stoimost-i-zakaz'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Сократить дебиторку';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#chto-takoe-ai-agent';

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

.adb-content{
  --adb-bg:#050711;--adb-bg2:#080b17;--adb-bg3:#0a0e1c;
  --adb-surface:rgba(255,255,255,.072);--adb-surface2:rgba(255,255,255,.108);
  --adb-text:#e6edf7;--adb-muted:#9aa8bd;--adb-soft:#c7d2e5;--adb-heading:#fff;
  --adb-border:rgba(255,255,255,.10);--adb-border-s:rgba(255,255,255,.18);
  --adb-accent:#f5c518;--adb-violet:#8b5cf6;--adb-green:#22c55e;--adb-cyan:#79f2ff;
  --adb-btn-from:#2563eb;--adb-btn-to:#7c3aed;
  --adb-shadow:0 24px 72px rgba(0,0,0,.4);
  --adb-r:18px;--adb-r-lg:24px;--adb-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--adb-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.adb-content *,.adb-content *::before,.adb-content *::after{box-sizing:border-box;}
.adb-content a{color:inherit;text-decoration:none;}
.adb-content p{color:var(--adb-muted);line-height:1.72;margin:0 0 1em;}
.adb-content p:last-child{margin-bottom:0;}
.adb-content h2,.adb-content h3,.adb-content h4{color:var(--adb-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.adb-content strong{color:var(--adb-soft);}
.adb-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.adb-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--adb-muted);font-size:14.5px;line-height:1.65;}
.adb-content ul li::before{content:'›';position:absolute;left:0;color:var(--adb-accent);font-weight:700;}
.adb-cnt{width:min(var(--adb-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.adb-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.adb-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.adb-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.adb-sh.adb-left{margin-left:0;text-align:left;}
.adb-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.adb-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.adb-sh.adb-left p{margin-left:0;}
.adb-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--adb-accent);margin-bottom:14px;}
.adb-gt{background:linear-gradient(92deg,#fff 0%,var(--adb-accent) 44%,var(--adb-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.adb-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.adb-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.adb-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.adb-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--adb-accent),var(--adb-violet));}
.adb-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--adb-muted);margin-bottom:1em;}
.adb-intro-text p:last-child{margin-bottom:0;color:var(--adb-soft);}
.adb-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.adb-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.adb-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--adb-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.adb-kpi-card .kl{font-size:11px;font-weight:600;color:var(--adb-muted);line-height:1.4;}
.adb-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.adb-intro-grid{grid-template-columns:1fr;gap:36px;}.adb-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.adb-intro-kpi{grid-template-columns:1fr 1fr;}}
.adb-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.adb-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.adb-toc a{display:inline-block;padding:9px 18px;background:var(--adb-surface);border:1px solid var(--adb-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--adb-muted);transition:border-color .2s,color .2s,background .2s;}
.adb-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--adb-accent);background:rgba(245,197,24,.08);}
.adb-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--adb-border);border-radius:var(--adb-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.adb-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.adb-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.adb-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.adb-grid-2,.adb-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.adb-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.adb-grid-3{grid-template-columns:1fr;}}
.adb-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--adb-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.adb-scenario:last-child{margin-bottom:0;}
.adb-scenario:hover{border-color:rgba(245,197,24,.3);}
.adb-scenario h3{font-size:17px;margin-bottom:8px;}
.adb-scenario p{font-size:14.5px;margin:0 0 .6em;}
.adb-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.adb-table{width:100%;border-collapse:collapse;font-size:14px;}
.adb-table th{padding:13px 16px;text-align:left;background:rgba(245,197,24,.1);color:var(--adb-accent);font-weight:700;border-bottom:1px solid rgba(245,197,24,.25);white-space:nowrap;}
.adb-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--adb-text);vertical-align:top;}
.adb-table tr:last-child td{border-bottom:none;}
.adb-table tr:hover td{background:rgba(255,255,255,.03);}
.adb-timeline{position:relative;padding-left:40px;}
.adb-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--adb-accent),var(--adb-cyan));opacity:.35;border-radius:2px;}
.adb-tl-item{position:relative;margin-bottom:32px;}
.adb-tl-item:last-child{margin-bottom:0;}
.adb-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--adb-accent);box-shadow:0 0 0 4px rgba(245,197,24,.2);}
.adb-tl-item h3{font-size:17px;margin-bottom:8px;}
.adb-tl-item p{font-size:14.5px;margin:0;}
.adb-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.adb-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.adb-case-grid{grid-template-columns:1fr;}}
.adb-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.adb-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.adb-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--adb-green);margin-bottom:10px;}
.adb-case-card h3{font-size:16px;margin-bottom:14px;}
.adb-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.adb-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.adb-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--adb-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.adb-faq-q::after{content:'▾';font-size:13px;color:var(--adb-accent);flex-shrink:0;transition:transform .25s;}
.adb-faq-item.open .adb-faq-q::after{transform:rotate(180deg);}
.adb-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--adb-muted);line-height:1.72;}
.adb-faq-item.open .adb-faq-a{max-height:800px;padding:0 24px 20px;}
.adb-calc-wrap{background:linear-gradient(180deg,rgba(34,197,94,.08),rgba(121,242,255,.06));border:1px solid rgba(34,197,94,.25);border-radius:var(--adb-r-lg);padding:32px;margin-top:24px;}
.adb-calc-grid{display:grid;grid-template-columns:1fr 1fr;gap:28px;align-items:start;}
@media(max-width:768px){.adb-calc-grid{grid-template-columns:1fr;}}
.adb-calc-field{margin-bottom:18px;}
.adb-calc-field label{display:block;font-size:13px;font-weight:700;color:var(--adb-soft);margin-bottom:8px;}
.adb-calc-field input[type=range]{width:100%;accent-color:var(--adb-green);}
.adb-calc-val{font-size:22px;font-weight:900;color:var(--adb-heading);margin-top:4px;}
.adb-calc-out{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:24px;}
.adb-calc-out h3{font-size:18px;margin-bottom:16px;}
.adb-calc-metric{display:flex;justify-content:space-between;gap:12px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.06);font-size:14px;}
.adb-calc-metric:last-child{border-bottom:none;}
.adb-calc-metric strong{color:var(--adb-green);}
.adb-link{color:var(--adb-accent)!important;text-decoration:underline!important;}
.adb-link:hover{color:#fde68a!important;}
.adb-text-cta{margin-top:20px;padding:16px 20px;border-left:3px solid var(--adb-accent);background:rgba(245,197,24,.06);border-radius:0 12px 12px 0;}
.adb-text-cta a{color:var(--adb-accent)!important;font-weight:700;text-decoration:underline!important;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,197,24,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--adb-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--adb-btn-from),var(--adb-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--adb-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--adb-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
.adb-hero-debitorka{min-height:100vh;min-height:100dvh;position:relative;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-debitorskaya-zadolzhennost-page" role="main" tabindex="-1">
<section class="nero-ai-hero adb-hero-debitorka" id="adb-hero-debitorka" aria-labelledby="adb-hero-title">
<style>
/* ── Hero adb-debitorka: самодостаточные стили (без CSS темы) ── */
.adb-hero-debitorka {
  --adb-gold: #f5c518;
  --adb-green: #22c55e;
  --adb-cyan: #79f2ff;
  --adb-amber: #f59e0b;
  --adb-text: #e6edf7;
  --adb-muted: #9aa8bd;
  --adb-soft: #c7d2e5;
  --adb-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  color: var(--adb-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.adb-hero-debitorka::before {
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
  z-index: 0;
}
.adb-hero-debitorka::after {
  content: "";
  position: absolute;
  right: 8%;
  top: 12%;
  width: 640px;
  height: 640px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 197, 24, .11), transparent 66%);
  filter: blur(8px);
  animation: adbHeroGlow 9s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes adbHeroGlow {
  from { opacity: .4; transform: scale(.95); }
  to { opacity: .82; transform: scale(1.05); }
}
.adb-hero-debitorka .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.adb-hero-debitorka .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.adb-hero-debitorka .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.adb-hero-debitorka .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--adb-gold) 42%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.adb-hero-debitorka .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--adb-gold) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.adb-hero-debitorka .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--adb-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.adb-hero-debitorka .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.adb-hero-debitorka .nero-ai-badge {
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
.adb-hero-debitorka .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.adb-hero-debitorka .nero-ai-btn {
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
.adb-hero-debitorka .nero-ai-btn:hover { transform: translateY(-2px); }
.adb-hero-debitorka .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--adb-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.adb-hero-debitorka .nero-ai-btn-secondary {
  color: var(--adb-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.adb-hero-debitorka .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--adb-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.adb-hero-debitorka .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.adb-hero-debitorka .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.adb-hero-debitorka .nero-ai-dots { display: flex; gap: 7px; }
.adb-hero-debitorka .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.adb-hero-debitorka .nero-ai-dot:nth-child(1) { background: #fb7185; }
.adb-hero-debitorka .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.adb-hero-debitorka .nero-ai-dot:nth-child(3) { background: #34d399; }
.adb-hero-debitorka .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.adb-hero-debitorka .nero-ai-window-body { padding: 16px; }
.adb-hero-debitorka .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.adb-hero-debitorka .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.adb-hero-debitorka .nero-ai-live-pill {
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
.adb-hero-debitorka .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: adbPulse 1.6s infinite;
}
@keyframes adbPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.adb-hero-debitorka .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.adb-hero-debitorka .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.adb-hero-debitorka .nero-ai-metric span {
  display: block;
  color: var(--adb-muted);
  font-size: 11px;
  font-weight: 700;
}
.adb-hero-debitorka .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.adb-hero-debitorka .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.adb-hero-debitorka .adb-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(245, 197, 24, 0.16);
  background: radial-gradient(ellipse at 30% 45%, rgba(245,197,24,.07), rgba(6,10,24,.92) 72%);
}
.adb-hero-debitorka #adb-debitorka-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.adb-hero-debitorka .nero-ai-task-stream { display: grid; gap: 8px; }
.adb-hero-debitorka .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.adb-hero-debitorka .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(245,197,24,.12);
  color: var(--adb-gold);
  font-size: 11px;
  font-weight: 800;
}
.adb-hero-debitorka .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.adb-hero-debitorka .nero-ai-task span {
  color: var(--adb-muted);
  font-size: 11px;
}
.adb-hero-debitorka .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.adb-hero-debitorka .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.adb-hero-debitorka .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #a5f3fc;
}
@media (max-width: 1100px) {
  .adb-hero-debitorka .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .adb-hero-debitorka .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .adb-hero-debitorka .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .adb-hero-debitorka .nero-ai-window-body { padding: 12px; }
  .adb-hero-debitorka .nero-ai-task { grid-template-columns: 28px 1fr; }
  .adb-hero-debitorka .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Финансы / дебиторка · внедрение под ключ</p>
      <h1 id="adb-hero-title">AI-агент для напоминаний о неоплаченных счетах: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI отслеживает счета, мягко напоминает клиентам об оплате и эскалирует просрочку — без ручных звонков менеджеров</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Контроль оплат</li>
        <li class="nero-ai-badge">Мягкая эскалация</li>
        <li class="nero-ai-badge">1С / CRM</li>
        <li class="nero-ai-badge">Email + Telegram</li>
        <li class="nero-ai-badge">DSO-метрики</li>
        <li class="nero-ai-badge">Пилот 2–4 нед.</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Сократить дебиторку</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kalkulyator-debitorki">Оценить потери</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-контроля дебиторской задолженности">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Контроль дебиторки · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-агент дебиторки</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>DSO</span>
              <strong>32 дня</strong>
              <small>−15% за 3 мес.</small>
            </div>
            <div class="nero-ai-metric">
              <span>Просрочка</span>
              <strong>11%</strong>
              <small>было 23%</small>
            </div>
            <div class="nero-ai-metric">
              <span>Счетов в работе</span>
              <strong>47</strong>
              <small>авто-напоминания</small>
            </div>
            <div class="nero-ai-metric">
              <span>Конверсия касаний</span>
              <strong>68%</strong>
              <small>без звонка</small>
            </div>
          </div>

          <div class="adb-dash-canvas-wrap" aria-hidden="false">
            <canvas id="adb-debitorka-hero-canvas" role="img" aria-label="Анимация: счета на aging-полосах, мягкие напоминания, эскалация в CRM и закрытие после оплаты из 1С"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий дебиторки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">СЧ</span>
              <div><strong>Счёт №1247 · 186 400 ₽ · напоминание −3 дня</strong><span>Email → мягкий тон</span></div>
              <span class="nero-ai-status">отправлено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Клиент: «оплатим в пятницу»</strong><span>AI классифицировал → перенос</span></div>
              <span class="nero-ai-status nero-ai-status--amber">перенос</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">1С</span>
              <div><strong>Оплата по счёту №1198</strong><span>Цепочка остановлена</span></div>
              <span class="nero-ai-status">закрыто</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>+7 дней просрочки</strong><span>Задача менеджеру с таймлайном</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">эскалация</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
/**
 * adb-debitorka-hero-engine — «Диспетчерская aging-дебиторки»
 * Мир: aging-полосы → маяк напоминаний → классификация ответа → оплата из 1С → DSO падает
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("adb-debitorka-hero-canvas");
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
    laneOk: "rgba(34,197,94,0.12)",
    laneWarn: "rgba(245,158,11,0.14)",
    laneCrit: "rgba(239,68,68,0.14)",
    invoice: "#fef3c7",
    invoicePaid: "#d1fae5",
    invoiceLate: "#fecaca",
    boardBg: "#1e293b",
    gold: "#f5c518",
    green: "#22c55e",
    cyan: "#79f2ff",
    amber: "#f59e0b",
    red: "#ef4444",
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

  function drawInvoiceChip(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    if (label) {
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 2);
    }
  }

  /* Горизонтальные aging-полосы — вместо Conveyor */
  function InvoicePulseStream() {
    this.lanes = [
      { y: -72, label: "0–30", bg: C.laneOk, speed: 0.38 },
      { y: -48, label: "31–60", bg: C.laneWarn, speed: 0.42 },
      { y: -24, label: "61+", bg: C.laneCrit, speed: 0.48 }
    ];
    this.chips = [
      { lane: 0, offset: 0, color: C.invoice, label: "1247" },
      { lane: 1, offset: 55, color: C.invoiceLate, label: "1198" },
      { lane: 2, offset: 110, color: C.invoiceLate, label: "1156" },
      { lane: 0, offset: 170, color: C.invoice, label: "1289" }
    ];
  }
  InvoicePulseStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    this.lanes.forEach(function (ln) {
      drawRR(ctx, -175, ln.y - 8, 350, 16, 4, ln.bg, "rgba(148,163,184,0.35)");
      ctx.fillStyle = "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(ln.label + " дн.", -168, ln.y + 2);
    });
    this.chips.forEach(function (chip) {
      var ln = this.lanes[chip.lane];
      var t = ((frame * ln.speed + chip.offset) % 140) / 140;
      var ix = -165 + t * 330;
      var paid = prg >= 195 && chip.label === "1198";
      var col = paid ? C.invoicePaid : chip.color;
      if (t < 0.95) drawInvoiceChip(ctx, ix, ln.y, 22, 12, col, chip.label);
    }, this);
  };

  /* Центральная панель aging — вместо WebsiteTerminal */
  function AgingCommandBoard() {
    this.flash = 0;
  }
  AgingCommandBoard.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    drawRR(ctx, 45, -58, 115, 118, 10, C.boardBg, C.outline);
    drawRR(ctx, 52, -50, 101, 16, [6, 6, 0, 0], "rgba(245,197,24,0.22)", null);
    ctx.fillStyle = C.gold;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Aging · дебиторка", 58, -40);

    var zones = [
      { y: -38, w: 88, label: "До срока", col: C.green, on: prg >= 8 },
      { y: -18, w: 72, label: "Просрочка", col: C.amber, on: prg >= 55 },
      { y: 2, w: 96, label: "Критическая", col: C.red, on: prg >= 125 }
    ];
    zones.forEach(function (z) {
      var alpha = z.on ? 0.85 : 0.25;
      ctx.globalAlpha = alpha;
      drawRR(ctx, 58, z.y, z.w, 14, 3, "rgba(255,255,255,0.08)", C.outline);
      ctx.fillStyle = z.on ? z.col : "#64748b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(z.label, 62, z.y + 10);
      ctx.globalAlpha = 1;
    });

    if (prg >= 195) {
      this.flash = Math.min(1, (prg - 195) / 12);
      ctx.globalAlpha = this.flash;
      drawRR(ctx, 58, 24, 88, 22, 5, "rgba(34,197,94,0.22)", C.green);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Счёт закрыт · цепочка OFF", 102, 38);
      ctx.globalAlpha = 1;
    }
  };

  /* Маяк мягких напоминаний */
  function ReminderBeacon() {
    this.rings = [0, 0, 0];
  }
  ReminderBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 45 || prg > 130) return;
    var pulse = (prg - 45) / 85;
    drawRR(ctx, -118, 8, 22, 28, 5, "rgba(245,197,24,0.18)", C.gold);
    ctx.fillStyle = C.gold;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TG", -107, 24);

    for (var i = 0; i < 3; i++) {
      var ringPrg = Math.max(0, pulse - i * 0.15);
      if (ringPrg <= 0 || ringPrg > 1) continue;
      ctx.strokeStyle = "rgba(245,197,24," + (0.5 - ringPrg * 0.4) + ")";
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(-107, 22, 8 + ringPrg * 42 + i * 12, 0, Math.PI * 2);
      ctx.stroke();
    }

    if (prg > 60 && prg < 115) {
      var fly = (prg - 60) / 55;
      var ex = -107 + fly * 95;
      var ey = 22 - Math.sin(fly * Math.PI) * 18;
      drawRR(ctx, ex - 8, ey - 5, 16, 10, 2, "#fef3c7", C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("−3д", ex, ey + 2);
    }
  };

  /* Башня эскалации */
  function EscalationTower() {
    this.level = 0;
  }
  EscalationTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    var levels = ["Email", "TG", "CRM", "Рук."];
    for (var i = 0; i < 4; i++) {
      var on = prg > 90 + i * 22;
      drawRR(ctx, 168, -42 + i * 18, 38, 14, 3, on ? "rgba(121,242,255,0.15)" : "rgba(255,255,255,0.05)", C.outline);
      ctx.fillStyle = on ? C.cyan : "#64748b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(levels[i], 186, -30 + i * 18);
    }
    if (prg >= 130 && prg < 190) {
      ctx.strokeStyle = "rgba(121,242,255,0.6)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([3, 3]);
      ctx.beginPath();
      ctx.moveTo(102, 10);
      ctx.lineTo(168, -6);
      ctx.stroke();
      ctx.setLineDash([]);
    }
  };

  /* Классификатор ответа клиента */
  function ClientReplyClassifier() {
    this.show = false;
  }
  ClientReplyClassifier.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 115 || prg > 175) return;
    var pop = Math.min(1, (prg - 115) / 15);
    ctx.globalAlpha = pop;
    drawRR(ctx, -42, 42, 78, 28, 6, "rgba(56,189,248,0.12)", C.cyan);
    ctx.fillStyle = "#a5f3fc";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("«Оплатим в пятницу»", -1, 52);
    ctx.fillStyle = C.amber;
    ctx.fillText("intent: перенос", -1, 64);
    ctx.globalAlpha = 1;
  };

  /* Прибор DSO */
  function CashflowGauge() {
    this.dso = 47;
  }
  CashflowGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    drawRR(ctx, -168, -98, 52, 36, 6, "rgba(255,255,255,0.06)", C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("DSO", -144, -88);

    if (prg >= 200) {
      this.dso = 47 - Math.min(15, (prg - 200) * 0.8);
    } else if (prg < 20) {
      this.dso = 47;
    }

    var needle = -90 + (this.dso / 60) * 70;
    ctx.strokeStyle = C.green;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(-144, -72);
    ctx.lineTo(-144 + Math.cos(needle * Math.PI / 180) * 22, -72 + Math.sin(needle * Math.PI / 180) * 22);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.fillText(Math.round(this.dso) + " дн.", -144, -58);
  };

  /* Синхронизация оплаты из 1С */
  function PaymentSyncPortal() {
    this.beam = 0;
  }
  PaymentSyncPortal.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 188 || prg > 238) return;
    this.beam = (prg - 188) / 50;
    var alpha = prg < 225 ? this.beam : 1 - (prg - 225) / 13;
    ctx.strokeStyle = "rgba(34,197,94," + (alpha * 0.85) + ")";
    ctx.lineWidth = 2.5;
    ctx.setLineDash([4, 4]);
    ctx.beginPath();
    ctx.moveTo(-175, 55);
    ctx.lineTo(58, 15);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = C.green;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("1С · оплата", -60, 48);
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
    var prg = (frame * 0.04) % 240;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: 155, y: -72 },
      "2_seo": { x: -105, y: 18 },
      "3_coder": { x: -8, y: 52 },
      "4_designer": { x: 88, y: -8 },
      "5_deployer": { x: 175, y: 28 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

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

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 240);
    }

    var bob = Math.abs(Math.sin(this.timer * 3)) * 2;
    if (!isMoving) bob = Math.sin(this.timer * 1.5) * 1;

    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";

    var legL = 0, legR = 0;
    if (isMoving) {
      var walkPhase = this.timer * 6;
      legL = Math.sin(walkPhase) * 5;
      legR = Math.sin(walkPhase + Math.PI) * 5;
    }
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
    drawRR(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
    drawRR(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
    drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);

    var hx = 0, hy = -28 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(hx, hy, 12, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 2;
    ctx.strokeStyle = C.outline;
    ctx.stroke();

    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.restore();

    if (carryType) {
      drawRR(ctx, -20 * faceDir, -18 - bob, 16, 16, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new InvoicePulseStream());
  entities.push(new CashflowGauge());
  entities.push(new ReminderBeacon());
  entities.push(new ClientReplyClassifier());
  entities.push(new AgingCommandBoard());
  entities.push(new EscalationTower());
  entities.push(new PaymentSyncPortal());

  entities.push(new Agent(-155, 68, C.agentYellow, "1_architect", 12, [
    "4 уровня эскалации",
    "Политика отсрочки",
    "Схема aging-зон"
  ]));
  entities.push(new Agent(-95, 78, C.agentGreen, "2_seo", 48, [
    "Мягкий тон письма",
    "Без давления в тексте",
    "LSI: ai дебиторка"
  ]));
  entities.push(new Agent(-35, 72, C.agentBlue, "3_coder", 88, [
    "Webhook из 1С",
    "Классифицирую ответ",
    "n8n: триггер +3д"
  ]));
  entities.push(new Agent(25, 78, C.agentPink, "4_designer", 128, [
    "Aging-дашборд",
    "Зелёный = оплачен",
    "Пульс напоминания"
  ]));
  entities.push(new Agent(85, 70, C.agentPurple, "5_deployer", 168, [
    "CRM: задача менеджеру",
    "Цепочка остановлена",
    "DSO в дашборде"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 300, maxLife: customLife || 300 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.04) % 240;
    if (prg >= 10 && prg < 10.05) createBubble(-144, -95, "Счёт в зоне −3 дня");
    if (prg >= 52 && prg < 52.05) createBubble(-107, 8, "Напоминание отправлено");
    if (prg >= 118 && prg < 118.05) createBubble(-1, 38, "«Оплатим в пятницу»");
    if (prg >= 142 && prg < 142.05) createBubble(186, -20, "Задача в CRM");
    if (prg >= 198 && prg < 198.05) createBubble(102, 10, "Оплата из 1С — закрыто");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 30);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(function () { engineloop(); });
  } else {
    engineloop();
  }
});
</script>
</section>
<div class="adb-content">

<section class="adb-intro nero-ai-section" id="intro" aria-label="Введение">
  <div class="adb-cnt">
    <div class="adb-intro-grid nero-ai-reveal">
      <div class="adb-intro-text">
        <p class="adb-eyebrow">Лонгрид · ai дебиторская задолженность</p>
        <p>На фоне рекордной просроченной дебиторской задолженности в российской экономике — <strong>~8,2 трлн ₽</strong> на январь 2026 года (+21% г/г) — ручной контроль оплат перестал масштабироваться. B2B-услуги, опт, производство и агентства теряют оборотный капитал на просроченных счетах.</p>
        <p>AI-агент Nero Network отслеживает выставленные счета, мягко напоминает клиентам об оплате по настраиваемой эскалации и эскалирует риск просрочки в CRM — без ручных звонков менеджеров. Внедрение под ключ за 2–4 недели, интеграция с 1С и CRM.</p>
      </div>
      <div class="adb-intro-kpi" aria-label="Ключевые метрики дебиторки">
        <div class="adb-kpi-card"><div class="kv">8,2 трлн ₽</div><div class="kl">просроченная дебиторка РФ</div><div class="ks">Росстат / РБК 2026</div></div>
        <div class="adb-kpi-card"><div class="kv">42%</div><div class="kl">компаний: неплатежи — барьер</div><div class="ks">РСПП 2025</div></div>
        <div class="adb-kpi-card"><div class="kv">47 дн.</div><div class="kl">DSO до автоматизации</div><div class="ks">кейс производства</div></div>
        <div class="adb-kpi-card"><div class="kv">2–4 нед.</div><div class="kl">до первых касаний</div><div class="ks">пилот Nero Network</div></div>
      </div>
    </div>
    <p class="adb-intro-related nero-ai-reveal" style="margin-top:20px;">Смежные материалы Nero Network: как <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">масштабное внедрение AI-агентов в корпоративные процессы</a> меняет подход к автоматизации, и как <a href="/ai-1c-erp/">AI-агент для 1С и ERP</a> закрывает учётные задачи рядом с контролем оплат.</p>
  </div>
</section>


<div class="adb-toc-outer">
  <div class="adb-cnt">
    <nav class="adb-toc ym-toc" aria-label="Оглавление статьи">
      <a href="#pochemu-rastet-debitorka">Дебиторка</a>
      <a href="#chto-takoe-ai-agent">AI-агент</a>
      <a href="#kak-ai-sokrashchaet-debitorku">Эскалация</a>
      <a href="#scenarii-platezhnyh-napominanij">Сценарии</a>
      <a href="#vnedrenie-pod-klyuch">Внедрение</a>
      <a href="#integraciya-crm-1c">Интеграции</a>
      <a href="#kalkulyator-debitorki">Калькулятор</a>
      <a href="#keisy-i-primery">Кейсы</a>
      <a href="#stoimost-i-zakaz">Стоимость</a>
      <a href="#vnedrenie-ai-v-biznes-processy">AI в процессах</a>
      <a href="#faq">FAQ</a>
    </nav>
  </div>
</div>


<section class="adb-section" id="pochemu-rastet-debitorka">
  <div class="adb-cnt">
    <div class="adb-sh adb-left nero-ai-reveal">
      <span class="adb-eyebrow">Боль клиента</span>
      <h2>Почему растёт дебиторка и счета не оплачивают вовремя</h2>
      <p><strong>Коротко:</strong> большинство просрочек в B2B возникают не из-за злого умысла, а потому что клиент забыл, счёт потерялся в почте или менеджер не успел напомнить вовремя.</p>
    </div>
    <div class="adb-grid-3 nero-ai-reveal">
      <div class="adb-kpi-card"><div class="kv">8,2 трлн ₽</div><div class="kl">просроченная дебиторка РФ</div><div class="ks">январь 2026, +21% г/г</div></div>
      <div class="adb-kpi-card"><div class="kv">42%</div><div class="kl">компаний: неплатежи — главный барьер</div><div class="ks">опрос РСПП 2025</div></div>
      <div class="adb-kpi-card"><div class="kv">47 дней</div><div class="kl">DSO в кейсе производства</div><div class="ks">23% портфеля в просрочке</div></div>
    </div>
    <div class="adb-card nero-ai-reveal" style="margin-top:28px;">
      <h3>Ручные напоминания менеджеров: где теряются деньги</h3>
      <p>Типичная картина: бухгалтерия выставляет счёт в 1С, менеджер обещает «проконтролировать», но между сделками напоминание уходит на второй план. В CRM нет единого aging-отчёта, в Excel — устаревшие контакты, в мессенджерах — хаотичные «напомните, пожалуйста, об оплате».</p>
      <ul>
        <li><strong>нет триггера</strong> — никто не видит счёт за 3 дня до срока;</li>
        <li><strong>нет единого реестра</strong> — просрочка всплывает на планёрке, когда уже поздно;</li>
        <li><strong>нет эскалации</strong> — один менеджер «стесняется» напоминать ключевому клиенту;</li>
        <li><strong>нет остановки</strong> — после оплаты клиент снова получает напоминание.</li>
      </ul>
    </div>
    <div class="adb-grid-3 nero-ai-reveal" style="margin-top:20px;">
      <div class="adb-card"><h3>Агентства и B2B-услуги</h3><p>Счета по проектам и абонентам, разные юрлица плательщика — легко пропустить дедлайн.</p></div>
      <div class="adb-card nero-ai-delay-1"><h3>Опт и производство</h3><p>Отгрузка со отсрочкой 14–30 дней, блокировка поставок включается слишком поздно.</p></div>
      <div class="adb-card nero-ai-delay-2"><h3>Торговля и дистрибуция</h3><p>Высокий оборот при низкой марже — неделя просрочки бьёт по маржинальности сильнее, чем кажется.</p></div>
    </div>
    <p class="adb-text-cta nero-ai-reveal">Оцените, сколько оборотного капитала «заморожено» в просрочке: <a href="#kalkulyator-debitorki">Оценить потери на дебиторке</a> → калькулятор на странице.</p>
  </div>
</section>

<section class="adb-section adb-section-alt" id="chto-takoe-ai-agent">
  <div class="adb-cnt">
    <div class="adb-sh">
      <span class="adb-eyebrow">Agentic AI</span>
      <h2>AI-агент для напоминаний о неоплаченных счетах — что это</h2>
      <p><strong>Определение:</strong> AI-агент для <strong>ai дебиторской задолженности</strong> — система, которая сама инициирует контакт по триггеру из учётной системы, выбирает канал, генерирует персонализированный текст и эскалирует при отсутствии реакции.</p>
    </div>
    <div class="adb-table-wrap nero-ai-reveal">
      <table class="adb-table">
        <thead><tr><th>Решение</th><th>Что делает</th><th>Ограничение</th></tr></thead>
        <tbody>
          <tr><td>Чат-бот на сайте</td><td>Отвечает на вопросы посетителя</td><td>Не видит счета в 1С</td></tr>
          <tr><td>Rule-based робот в CRM</td><td>Шлёт шаблон по расписанию</td><td>Один тон на всех</td></tr>
          <tr><td>Dunning-модуль ERP</td><td>Напоминание до/после срока</td><td>Без персонализации и диалога</td></tr>
          <tr><td><strong>AI-агент дебиторки</strong></td><td>Мониторинг + персонализация + классификация ответов + эскалация</td><td>Требует интеграции</td></tr>
        </tbody>
      </table>
    </div>
    <div class="adb-grid-2 nero-ai-reveal" style="margin-top:24px;">
      <div class="adb-card"><h3>От чат-бота к agentic AI</h3><p>McKinsey 2025: возможность — в трансформации целых процессов за счёт встраивания агентов по всей цепочке создания ценности. Стек: ERP/CRM → оркестратор (n8n, Make) → LLM → каналы → обратная запись в CRM.</p></div>
      <div class="adb-card nero-ai-delay-1"><h3>Чем отличается от CRM и взыскания</h3><p>Модули CRM работают по жёстким правилам (30–250 тыс. ₽). Сервисы взыскания — жёсткий сбор. AI-агент Nero Network: <strong>мягкая эскалация, не коллектор</strong> — забота о cash flow и отношениях с контрагентом.</p></div>
    </div>
  </div>
</section>

<section id="adb-boris-escalation-block" class="adb-b-root" aria-label="Анимация: лестница мягкой эскалации AI-агента по неоплаченным счетам">
<style>
/* === БОРИС: prefix adb-b-, scoped внутри #adb-boris-escalation-block === */
#adb-boris-escalation-block.adb-b-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#adb-boris-escalation-block .adb-b-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#adb-boris-escalation-block .adb-b-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #adb-boris-escalation-block .adb-b-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#adb-boris-escalation-block .adb-b-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #adb-boris-escalation-block .adb-b-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#adb-boris-escalation-block .adb-b-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0891b2;
  margin:0 0 14px;
}
#adb-boris-escalation-block .adb-b-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0891b2;
  border-radius:1px;
}
#adb-boris-escalation-block .adb-b-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#adb-boris-escalation-block .adb-b-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#adb-boris-escalation-block .adb-b-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#adb-boris-escalation-block .adb-b-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(8,145,178,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
}
#adb-boris-escalation-block .adb-b-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#adb-boris-escalation-block .adb-b-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#adb-boris-escalation-block .adb-b-pl-a{
  background:rgba(245,197,24,.12);
  color:#a16207;
  border:1.5px solid rgba(245,197,24,.35);
}
#adb-boris-escalation-block .adb-b-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#adb-boris-escalation-block .adb-b-pl-c{
  background:rgba(121,242,255,.12);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.35);
}
#adb-boris-escalation-block .adb-b-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#adb-boris-escalation-block .adb-b-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfeff 0%,#f0fdf4 35%,#fffbeb 70%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #adb-boris-escalation-block .adb-b-rgt{min-height:380px;}
}
#adb-boris-escalation-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="adb-b-cnt">
  <div class="adb-b-card">

    <div class="adb-b-lft">
      <span class="adb-b-ey">Мягкая эскалация</span>
      <h3 class="adb-b-h3">Счёт №1247 проходит лестницу касаний — от напоминания до задачи в CRM</h3>
      <ul class="adb-b-ul">
        <li><span class="adb-b-ic">−3</span>За три дня до срока — дружелюбное письмо с реквизитами и ссылкой на счёт</li>
        <li><span class="adb-b-ic">0</span>В день оплаты — деловой тон; канал выбирается по истории ответов клиента</li>
        <li><span class="adb-b-ic">+7</span>На седьмой день просрочки — задача менеджеру с полным таймлайном касаний</li>
        <li><span class="adb-b-ic">✓</span>Оплата в 1С — цепочка останавливается мгновенно, без лишних писем</li>
      </ul>
      <div class="adb-b-pills">
        <span class="adb-b-pl adb-b-pl-a">−5 / −3 / −1 день</span>
        <span class="adb-b-pl adb-b-pl-c">Email · Telegram</span>
        <span class="adb-b-pl adb-b-pl-g">Стоп после оплаты</span>
      </div>
      <p class="adb-b-foot">Дальше — как AI сокращает DSO и долю просрочки без ручных звонков →</p>
    </div>

    <div class="adb-b-rgt">
      <canvas
        id="adb-boris-escalation-canvas"
        aria-label="Анимация: счёт проходит этапы мягкой эскалации — напоминания по email и Telegram, эскалация в CRM, остановка после оплаты"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('adb-boris-escalation-canvas');
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
    amber:'#f5c518',
    amberDark:'#d97706',
    green:'#22c55e',
    greenDark:'#15803d',
    cyan:'#79f2ff',
    cyanDark:'#0891b2',
    violet:'#8b5cf6',
    red:'#ef4444',
    line:'rgba(14,165,233,.25)',
    glowA:'rgba(245,197,24,.18)',
    glowG:'rgba(34,197,94,.2)',
    crm:'#1e293b'
  };

  var STAGES = [
    {label:'−3 дня', sub:'мягко', channel:'EM', color:C.cyan, tone:'Дружелюбный'},
    {label:'День 0', sub:'срок', channel:'TG', color:C.amber, tone:'Деловой'},
    {label:'+3 дня', sub:'повтор', channel:'EM', color:C.amberDark, tone:'Нейтральный'},
    {label:'+7 дней', sub:'CRM', channel:'CRM', color:C.violet, tone:'Эскалация'},
    {label:'Оплата', sub:'стоп', channel:'1С', color:C.green, tone:'Закрыто'}
  ];

  var LOOP = 720;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawInvoice(x,y,s,alpha,highlight){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,s,s*1.22,5,C.paper,'#cbd5e1',1.5);
    rr(x+5,y+6,s-10,12,2,highlight?C.amber:C.cyanDark,null,0);
    ctx.fillStyle=C.ink;
    ctx.font='bold 8px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('СЧ',x+s/2,y+15);
    ctx.font='bold 7px Inter,sans-serif';
    ctx.fillStyle=C.muted;
    ctx.fillText('№1247',x+s/2,y+s*1.05);
    ctx.globalAlpha=1;
  }

  function drawStageNode(cx,cy,r,stage,active,pulse){
    var glow = active ? 0.35 + 0.15*Math.sin(pulse*0.08) : 0;
    if(active){
      ctx.beginPath();
      ctx.arc(cx,cy,r+10,0,Math.PI*2);
      ctx.fillStyle = stage.color === C.green ? C.glowG : C.glowA;
      ctx.globalAlpha = glow;
      ctx.fill();
      ctx.globalAlpha = 1;
    }
    rr(cx-r,cy-r,r*2,r*2,r,active?stage.color:'#f1f5f9',active?stage.color:'#cbd5e1',active?2:1);
    ctx.fillStyle = active ? C.ink : C.muted;
    ctx.font = 'bold '+(active?'10':'9')+'px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(stage.label,cx,cy-2);
    ctx.font='8px Inter,sans-serif';
    ctx.fillStyle = active ? C.ink : C.muted;
    ctx.fillText(stage.sub,cx,cy+10);
  }

  function drawMsgBubble(x,y,w,text,channel,alpha){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,w,28,8,C.paper,'#e2e8f0',1);
    var badgeClr = channel==='TG'?C.cyan:channel==='EM'?C.amber:channel==='CRM'?C.violet:C.green;
    rr(x+6,y+6,18,16,4,badgeClr,null,0);
    ctx.fillStyle=C.ink;
    ctx.font='bold 7px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(channel,x+15,y+17);
    ctx.textAlign='left';
    ctx.fillStyle=C.ink;
    ctx.font='8px Inter,sans-serif';
    ctx.fillText(text,x+30,y+18);
    ctx.globalAlpha=1;
  }

  function drawCrmTask(x,y,w,h,alpha,pulse){
    ctx.globalAlpha = alpha || 1;
    rr(x,y,w,h,8,C.crm,'#334155',2);
    ctx.fillStyle=C.cyan;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('CRM · задача менеджеру',x+10,y+16);
    ctx.fillStyle='rgba(226,232,240,.85)';
    ctx.font='8px Inter,sans-serif';
    ctx.fillText('Счёт №1247 · +7 дней · 186 400 ₽',x+10,y+30);
    var prog=(pulse%50)/50;
    rr(x+10,y+h-14,w-20,4,2,'rgba(255,255,255,.1)',null,0);
    rr(x+10,y+h-14,(w-20)*prog,4,2,C.violet,null,0);
    ctx.globalAlpha=1;
  }

  function drawPaymentBurst(cx,cy,r,pulse){
    var n=6;
    for(var i=0;i<n;i++){
      var ang=(i/n)*Math.PI*2+pulse*0.05;
      var dist=r+8+6*Math.sin(pulse*0.1);
      ctx.beginPath();
      ctx.arc(cx+Math.cos(ang)*dist,cy+Math.sin(ang)*dist,3,0,Math.PI*2);
      ctx.fillStyle=C.green;
      ctx.globalAlpha=0.5+0.3*Math.sin(pulse*0.12+i);
      ctx.fill();
    }
    ctx.globalAlpha=1;
    ctx.fillStyle=C.green;
    ctx.font='bold 14px sans-serif';
    ctx.textAlign='center';
    ctx.fillText('✓',cx,cy+5);
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);

    var pad=16;
    var trackY=H*0.38;
    var trackL=pad+20;
    var trackR=W-pad-20;
    var trackW=trackR-trackL;

    ctx.strokeStyle=C.line;
    ctx.lineWidth=2;
    ctx.setLineDash([6,4]);
    ctx.beginPath();
    ctx.moveTo(trackL,trackY);
    ctx.lineTo(trackR,trackY);
    ctx.stroke();
    ctx.setLineDash([]);

    var stageCount=STAGES.length;
    var stageXs=[];
    for(var si=0;si<stageCount;si++){
      var sx=trackL+(trackW/(stageCount-1))*si;
      stageXs.push(sx);
      var prog=t/LOOP;
      var activeStage=Math.floor(prog*4.2);
      if(activeStage>4) activeStage=4;
      drawStageNode(sx,trackY,22,STAGES[si],si<=activeStage,t);
    }

    var invProg=(t%180)/180;
    var fromIdx=Math.floor(t/180)%4;
    var toIdx=fromIdx+1;
    var ix=stageXs[fromIdx]+(stageXs[toIdx]-stageXs[fromIdx])*ease(invProg);
    var iy=trackY-52-8*Math.sin(invProg*Math.PI);
    drawInvoice(ix-14,iy,28,0.95,true);

    var msgAlpha=0;
    if(invProg>0.3 && invProg<0.85) msgAlpha=Math.sin((invProg-0.3)/0.55*Math.PI);
    if(msgAlpha>0.05){
      var ch=STAGES[fromIdx].channel;
      var txt=STAGES[fromIdx].tone;
      drawMsgBubble(ix-40,iy-38,110,txt,ch,msgAlpha*0.9);
    }

    if(t>520 && t<680){
      var crmA=Math.min(1,(t-520)/40)*Math.min(1,(680-t)/40);
      var crmW=Math.min(200,W*0.42);
      drawCrmTask(W/2-crmW/2,trackY+50,crmW,48,crmA,t);
    }

    if(t>600){
      var payA=Math.min(1,(t-600)/60);
      drawStageNode(stageXs[4],trackY,22,STAGES[4],true,t);
      drawPaymentBurst(stageXs[4],trackY,22,t);
      ctx.fillStyle=C.greenDark;
      ctx.font='bold 10px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.globalAlpha=payA;
      ctx.fillText('Цепочка остановлена · оплата в 1С',W/2,trackY+110);
      ctx.globalAlpha=1;
    }

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Счёт №1247 · 186 400 ₽ · ООО «Ромашка»',pad,pad+8);

    ctx.textAlign='right';
    ctx.fillStyle=C.cyanDark;
    ctx.fillText('AI-агент · демо-цикл',W-pad,pad+8);

    requestAnimationFrame(loop);
  }

  function ease(p){ return p<0.5?2*p*p:1-Math.pow(-2*p+2,2)/2; }

  requestAnimationFrame(loop);
})();
</script>
</section>

<section class="adb-section" id="kak-ai-sokrashchaet-debitorku">
  <div class="adb-cnt">
    <div class="adb-sh adb-left">
      <span class="adb-eyebrow">Механика</span>
      <h2>Как AI сокращает дебиторскую задолженность без ручной работы</h2>
      <p><strong>Итог:</strong> AI-агент закрывает боль «счета забывают оплачивать, менеджеры вручную напоминают клиентам», масштабируется на сотни контрагентов и даёт измеримый эффект через DSO, долю просрочки и конверсию касаний в оплату.</p>
    </div>
    <div class="adb-table-wrap nero-ai-reveal">
      <table class="adb-table">
        <thead><tr><th>День</th><th>Действие агента</th><th>Тон</th><th>Канал</th></tr></thead>
        <tbody>
          <tr><td>−5 / −3 / −1 до срока</td><td>Мягкое напоминание о предстоящей оплате</td><td>Дружелюбный</td><td>Email или Telegram</td></tr>
          <tr><td>День срока</td><td>Напоминание с реквизитами и ссылкой на счёт</td><td>Деловой</td><td>Канал с историей ответов</td></tr>
          <tr><td>+3 дня просрочки</td><td>Повтор + вопрос о причинах задержки</td><td>Нейтральный</td><td>Email + мессенджер</td></tr>
          <tr><td>+7 дней</td><td>Задача менеджеру с таймлайном всех касаний</td><td>—</td><td>CRM</td></tr>
          <tr><td>+14 и более</td><td>Эскалация руководителю; опционально — блокировка отгрузки в 1С</td><td>Формальный</td><td>По политике</td></tr>
        </tbody>
      </table>
    </div>
    <div class="adb-card nero-ai-reveal" style="margin-top:24px;">
      <h3>Контроль оплат и риск просрочки в одном сценарии</h3>
      <ol style="padding-left:20px;color:var(--adb-muted);line-height:1.8;font-size:14.5px;">
        <li>ERP/CRM отдаёт реестр счетов: контрагент, сумма, срок, статус, контакт, сегмент.</li>
        <li>Планировщик проверяет календарь: −5/−3/−1 день, день просрочки, +3/+7/+14 дней.</li>
        <li>AI выбирает сценарий тона и канал по истории.</li>
        <li>Отправка + лог в CRM; при ответе — классификация intent (оплата / перенос / спор).</li>
        <li>При оплате в 1С — <strong>немедленная остановка</strong> цепочки; при молчании — эскалация человеку.</li>
      </ol>
      <p style="margin-top:14px;">Метрики для CFO: <strong>DSO</strong>, <strong>% просрочки</strong>, <strong>конверсия касаний</strong> в оплату. Кейс Wildbots: снижение DSO на 20–35% за 3 месяца пилота (заявление интегратора).</p>
    </div>
  </div>
</section>

<div class="ym-cta-block ym-cta-block--primary" id="cta-sokratit-debitorku">
  <div class="ym-cta-block__icon" aria-hidden="true">💰</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Сократить дебиторку без ручных звонков</p>
    <p class="ym-cta-block__sub">Запустим пилот на 30–50 контрагентах: мягкие напоминания в email и Telegram, эскалация в CRM, дашборд DSO. Аудит процесса — бесплатно, первые касания через 2–4 недели.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?> class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer">Сократить дебиторку</a>
  </div>
</div>

<section class="adb-section adb-section-alt" id="scenarii-platezhnyh-napominanij">
  <div class="adb-cnt">
    <div class="adb-sh">
      <span class="adb-eyebrow">Сценарии</span>
      <h2>Сценарии ai платежных напоминаний для вашего бизнеса</h2>
      <p><strong>Автоматизация напоминаний об оплате</strong> настраивается под отрасль: один движок эскалации, разные правила сегментации и тональности.</p>
    </div>
    <div class="adb-grid-3 nero-ai-reveal">
      <div class="adb-scenario"><h3>Агентства и B2B-услуги</h3><p>Абонентская плата, проектные акты, VIP white-list с approve руководителя.</p></div>
      <div class="adb-scenario"><h3>Опт и производство</h3><p>Отсрочка 14/21/30 дней, связка счёта с накладной, блокировка отгрузки в 1С.</p></div>
      <div class="adb-scenario"><h3>Шаблоны мягких напоминаний</h3><p>Лид-магнит Nero Network: три этапа эскалации, адаптированы под 152-ФЗ.</p></div>
    </div>
    <p class="adb-text-cta nero-ai-reveal"><strong>Получить шаблоны напоминаний</strong> — <a href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>оставьте контакт, вышлем PDF</a> с примерами для email и Telegram.</p>
  </div>
</section>

<section class="adb-section" id="vnedrenie-pod-klyuch">
  <div class="adb-cnt">
    <div class="adb-sh adb-left">
      <span class="adb-eyebrow">Под ключ</span>
      <h2>Внедрение AI дебиторской задолженности под ключ</h2>
      <p><strong>Внедрение ai агентов</strong> в контур дебиторки — проект с понятными этапами. Nero Network берёт архитектуру, интеграцию и настройку.</p>
    </div>
    <div class="adb-table-wrap nero-ai-reveal">
      <table class="adb-table">
        <thead><tr><th>Этап</th><th>Срок</th><th>Что делаем</th></tr></thead>
        <tbody>
          <tr><td><strong>1. Аудит</strong></td><td>2–3 дня</td><td>Источники данных, объём счетов, DSO, каналы, юридические ограничения</td></tr>
          <tr><td><strong>2. Пилот</strong></td><td>2 недели</td><td>30–50 контрагентов, email + Telegram, approve before send</td></tr>
          <tr><td><strong>3. Интеграция</strong></td><td>1–2 недели</td><td>Коннектор 1С OData / Битрикс24 / amoCRM</td></tr>
          <tr><td><strong>4. Эскалация</strong></td><td>3–5 дней</td><td>4 уровня: авто → менеджер → руководитель → финдиректор</td></tr>
          <tr><td><strong>5. Запуск + дашборд</strong></td><td>2–3 дня</td><td>DSO, % просрочки, конверсия, aging-отчёт</td></tr>
        </tbody>
      </table>
    </div>
    <div class="adb-grid-2 nero-ai-reveal" style="margin-top:24px;">
      <div class="adb-card"><h3>Без программиста на стороне клиента</h3><p>От клиента: доступ к учётной системе, реестр контрагентов, политика оплаты, шаблоны тональности, согласия на коммуникации.</p></div>
      <div class="adb-card nero-ai-delay-1"><h3>Сроки и роли</h3><p><strong>2–4 недели</strong> до первых касаний. Финдиректор — политика; IT — доступы; Nero Network — вся техническая реализация.</p></div>
    </div>
    <p class="adb-text-cta nero-ai-reveal"><a href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Заказать внедрение</a> — обсудим ваш стек и запустим пилот на одном сегменте контрагентов.</p>
  </div>
</section>

<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
    <p class="ym-cta-block__sub">Перед внедрением AI-агента дебиторки полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с 1С/CRM — это ускоряет согласование сценариев с финдиректором и IT. Ссылка: <a href="${SECONDARY_CTA_URL}" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer">${SECONDARY_CTA_LABEL}</a></p>
  </div>
</aside>

<section class="adb-section adb-section-alt" id="integraciya-crm-1c">
  <div class="adb-cnt">
    <div class="adb-sh">
      <span class="adb-eyebrow">Интеграции</span>
      <h2>Интеграция с CRM, 1С и каналами связи</h2>
      <p><strong>Интеграция ai дебиторская задолженность</strong> — обязательное условие работоспособности агента.</p>
    </div>
    <p class="adb-integr-related nero-ai-reveal">Для типовых стеков у нас уже есть отдельные разборы: <a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM</a> и <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработка входящей почты в CRM</a> — их можно комбинировать с агентом дебиторки в единой цепочке касаний.</p>
    <div class="adb-table-wrap nero-ai-reveal">
      <table class="adb-table">
        <thead><tr><th>Система</th><th>Способ связи</th><th>Что синхронизируем</th></tr></thead>
        <tbody>
          <tr><td><strong>1С:Бухгалтерия, УТ, ERP</strong></td><td>OData, HTTP-сервис</td><td>Счета, оплаты, контрагенты, блокировка отгрузок</td></tr>
          <tr><td><strong>Битрикс24</strong></td><td>REST API, бизнес-процессы</td><td>Сделки, задачи эскалации, история касаний</td></tr>
          <tr><td><strong>amoCRM</strong></td><td>API v4, webhooks</td><td>Счета, контакты, примечания по оплате</td></tr>
          <tr><td><strong>МойСклад</strong></td><td>API</td><td>Отгрузки, счета, статусы оплаты</td></tr>
        </tbody>
      </table>
    </div>
    <div class="adb-card nero-ai-reveal" style="margin-top:24px;">
      <h3>Email, SMS, Telegram и human-in-the-loop</h3>
      <p>AI выбирает канал по истории. Решение EFSOL «НейроСотрудник»: агент сводит 1С, банк и договорённости менеджеров, но списания — только после подтверждения человека. <strong>Российский контур:</strong> YandexGPT / GigaChat + on-prem LLM.</p>
    </div>
    <p class="adb-text-cta nero-ai-reveal"><a href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Обсудить интеграцию</a> — пришлите схему ваших систем, предложим архитектуру за 1–2 дня.</p>
  </div>
</section>

<section class="adb-section adb-section-alt" id="kalkulyator-debitorki">
  <div class="adb-cnt">
    <div class="adb-sh">
      <span class="adb-eyebrow">Финансовый калькулятор</span>
      <h2>Калькулятор: сколько вы теряете на просроченной дебиторке</h2>
      <p><strong>Сколько стоит ai дебиторская задолженность</strong> в сравнении с потерями от просрочки? Переводим абстрактный DSO в рубли.</p>
    </div>
    <div class="adb-calc-wrap nero-ai-reveal">
      <div class="adb-calc-grid">
        <div>
          <div class="adb-calc-field">
            <label for="adb-calc-volume">Средний объём дебиторской задолженности (млн ₽ в месяц)</label>
            <input type="range" id="adb-calc-volume" min="1" max="50" value="5" step="0.5">
            <div class="adb-calc-val"><span id="adb-calc-volume-val">5</span> млн ₽</div>
          </div>
          <div class="adb-calc-field">
            <label for="adb-calc-dso">Средний срок оплаты (DSO, дней)</label>
            <input type="range" id="adb-calc-dso" min="15" max="90" value="45" step="1">
            <div class="adb-calc-val"><span id="adb-calc-dso-val">45</span> дней</div>
          </div>
          <div class="adb-calc-field">
            <label for="adb-calc-overdue">Доля просроченных счетов (% портфеля)</label>
            <input type="range" id="adb-calc-overdue" min="5" max="50" value="20" step="1">
            <div class="adb-calc-val"><span id="adb-calc-overdue-val">20</span>%</div>
          </div>
        </div>
        <div class="adb-calc-out" aria-live="polite">
          <h3>Результат расчёта</h3>
          <div class="adb-calc-metric"><span>Замороженный капитал (просрочка)</span><strong id="adb-calc-frozen">—</strong></div>
          <div class="adb-calc-metric"><span>Эффект сокращения DSO на 10 дней</span><strong id="adb-calc-effect">—</strong></div>
          <div class="adb-calc-metric"><span>Ориентир окупаемости внедрения</span><strong id="adb-calc-roi">—</strong></div>
          <p style="margin-top:16px;font-size:13px;">Пример: при дебиторке 5 млн ₽, DSO 45 дней и 20% просрочки сокращение срока оплаты на 10 дней высвобождает порядка <strong>1,1 млн ₽</strong> оборотных средств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?> class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="margin-top:18px;display:inline-flex;" target="_blank" rel="noopener noreferrer">Сократить дебиторку</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="adb-section" id="keisy-i-primery">
  <div class="adb-cnt">
    <div class="adb-sh">
      <span class="adb-eyebrow">Кейсы</span>
      <h2>Кейсы и примеры внедрения AI для дебиторки</h2>
      <p>Ниша <strong>ai дебиторская задолженность</strong> в российском поиске пока низконасыщенная — ниже проверенные примеры с пометкой источника.</p>
    </div>
    <div class="adb-case-grid nero-ai-reveal">
      <div class="adb-case-card"><div class="adb-case-tag">Производство</div><h3>Wildbots + 1С:ERP</h3><p>~340 контрагентов, цепочка email → мессенджер → эскалация. Заявленный эффект: DSO −20–35% за 3 месяца. Источник: wildbots.ru.</p></div>
      <div class="adb-case-card"><div class="adb-case-tag">1С</div><h3>Infostart «Директ Маркетинг»</h3><p>4 шага воронки без LLM. По заявлению: 80% платежей вовремя без звонков. Контраст с AI: классическая автоматизация vs персонализация.</p></div>
      <div class="adb-case-card"><div class="adb-case-tag">Скоринг</div><h3>NeuroOffice «Контроль дебиторки»</h3><p>Скоринг 0–100, 4 уровня эскалации, график −3 / день / +3/+7/+14/+30 дней.</p></div>
    </div>
    <div class="adb-card nero-ai-reveal" style="margin-top:28px;">
      <h3>Что измерять после запуска</h3>
      <p>Через 30, 60 и 90 дней: <strong>DSO</strong>, <strong>% просрочки</strong>, <strong>конверсия касаний</strong>, <strong>доля эскалаций</strong>, <strong>NPS контрагентов</strong>. Международный ориентир: HighRadius −20% past due.</p>
    </div>
    <p class="adb-text-cta nero-ai-reveal"><a href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Запросить разбор вашего кейса</a> — разберём портфель счетов и предложим сценарий пилота.</p>
  </div>
</section>

<section class="adb-section adb-section-alt" id="stoimost-i-zakaz">
  <div class="adb-cnt">
    <div class="adb-sh">
      <span class="adb-eyebrow">Коммерция</span>
      <h2>Стоимость внедрения и как заказать</h2>
      <p>Ориентир чека <strong>150–400 тыс. ₽</strong> — зависит от интеграций, каналов и объёма кастомных сценариев.</p>
    </div>
    <div class="adb-table-wrap nero-ai-reveal">
      <table class="adb-table">
        <thead><tr><th>Пакет</th><th>Что входит</th><th>Для кого</th></tr></thead>
        <tbody>
          <tr><td><strong>Аудит</strong></td><td>Диагностика, карта интеграций, расчёт эффекта</td><td>Сомневаетесь, нужен ли AI</td></tr>
          <tr><td><strong>Пилот</strong></td><td>30–50 контрагентов, 2 канала, дашборд</td><td>Проверить гипотезу на сегменте</td></tr>
          <tr><td><strong>Полное внедрение</strong></td><td>Все контрагенты, эскалация, CRM/1С, обучение</td><td>Масштабирование на весь портфель</td></tr>
        </tbody>
      </table>
    </div>
    <p style="text-align:center;margin-top:20px;" class="nero-ai-reveal">Бенчмарк: AutoBIT24 100–250 тыс. ₽; AI-MANAGE 150–300 тыс. ₽; Nero Network 150–400 тыс. ₽ с персонализацией и классификацией ответов.</p>
  </div>
</section>

<div class="ym-cta-block ym-cta-block--dual" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы вернуть оборотный капитал из просрочки?</p>
    <p class="ym-cta-block__sub">Ориентир 150–400 тыс. ₽ за AI-агента с персонализацией и классификацией ответов. Сначала — расчёт в калькуляторе, затем план внедрения за 1 рабочий день.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?> class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" target="_blank" rel="noopener noreferrer">Сократить дебиторку</a>
      <a href="#kalkulyator-debitorki" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Рассчитать в калькуляторе</a>
    </div>
  </div>
</div>

<section class="adb-section" id="vnedrenie-ai-v-biznes-processy">
  <div class="adb-cnt">
    <div class="adb-sh">
      <span class="adb-eyebrow">Стратегия</span>
      <h2>Внедрение AI в бизнес-процессы: связка с финансовым контуром</h2>
      <p><strong>Внедрение ai в бизнес процессы</strong> в 2026 смещается от экспериментов к перестройке целых цепочек. McKinsey 2025: редизайн workflow даёт наибольший эффект на EBIT.</p>
    </div>
    <div class="adb-grid-3 nero-ai-reveal">
      <div class="adb-card"><h3>Измеримый ROI</h3><p>DSO и % просрочки считаются в 1С без долгих циклов.</p></div>
      <div class="adb-card nero-ai-delay-1"><h3>Низкий порог входа</h3><p>Достаточно коннектора к счетам и контактам — не нужно менять весь ERP.</p></div>
      <div class="adb-card nero-ai-delay-2"><h3>Быстрый пилот</h3><p>2 недели на 30–50 контрагентов — данные для решения о масштабировании.</p></div>
    </div>
    <div class="adb-card nero-ai-reveal" style="margin-top:24px;">
      <h3>Связка с другими автоматизациями Nero Network</h3>
      <ul>
        <li><strong>Документооборот в 1С/ERP</strong> — заявки и первичка; дебиторка — постоплата по отгруженным счетам.</li>
        <li><strong>AI в amoCRM</strong> — входящие лиды; дебиторка — контроль оплат по закрытым сделкам.</li>
        <li><strong>Обработка email в CRM</strong> — входящая почта; дебиторка — исходящие напоминания по расписанию.</li>
      </ul>
    </div>
    <p class="adb-text-cta nero-ai-reveal">Нужна консультация по <strong>внедрению ai решений</strong>? <a href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Оставьте заявку</a> — соберём roadmap из 2–3 сценариев с приоритетом по ROI.</p>
  </div>
</section>

<section class="adb-section adb-section-alt" id="faq">
  <div class="adb-cnt">
    <div class="adb-sh">
      <span class="adb-eyebrow">FAQ</span>
      <h2>FAQ — AI и дебиторская задолженность</h2>
    </div>
    <div class="adb-faq nero-ai-reveal">
        <div class="adb-faq-item"><div class="adb-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai дебиторская задолженность, если у нас нет IT-отдела?</div><div class="adb-faq-a">Nero Network реализует проект под ключ: аудит → интеграция → пилот → запуск. От вас — доступы, политика оплаты и согласование текстов. Программист на вашей стороне не обязателен.</div></div>
        <div class="adb-faq-item"><div class="adb-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai дебиторская задолженность?</div><div class="adb-faq-a">Ориентир 150–400 тыс. ₽ в зависимости от интеграций и каналов. Точную смету даём после аудита. Сравните с калькулятором на странице: часто один месяц просрочки стоит дороже годового внедрения.</div></div>
        <div class="adb-faq-item"><div class="adb-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли ai дебиторская задолженность для малого бизнеса?</div><div class="adb-faq-a">Да, если у вас от 30+ счетов в месяц и хотя бы один менеджер тратит время на напоминания. Для микробизнеса с 5–10 контрагентами может хватить rule-based робота в CRM.</div></div>
        <div class="adb-faq-item"><div class="adb-faq-q" role="button" tabindex="0" aria-expanded="false">Юридические и тональные ограничения мягких напоминаний в РФ</div><div class="adb-faq-a">152-ФЗ: локализация ПДн, отдельное согласие на обработку, штрафы до 700 тыс. ₽. Тон без угроз; отписка в каждом письме; тихие часы 9:00–19:00; автообзвон — только с согласия (230-ФЗ).</div></div>
        <div class="adb-faq-item"><div class="adb-faq-q" role="button" tabindex="0" aria-expanded="false">Безопасность данных и доступы к учётным системам</div><div class="adb-faq-a">Доступы по принципу минимальных прав: чтение счетов и контрагентов, запись касаний. LLM в российском контуре (YandexGPT, GigaChat, on-prem). Договор на обработку ПДн — обязателен перед пилотом.</div></div>
        <div class="adb-faq-item"><div class="adb-faq-q" role="button" tabindex="0" aria-expanded="false">Срок до первых результатов</div><div class="adb-faq-a">Первые автоматические касания — через 2–4 недели после старта. Измеримый эффект по DSO — обычно через 30–90 дней пилота.</div></div>
        <div class="adb-faq-item"><div class="adb-faq-q" role="button" tabindex="0" aria-expanded="false">Клиенты воспримут напоминания как спам?</div><div class="adb-faq-a">Сегментация, мягкий тон, правильное время и остановка после оплаты снижают негатив. VIP-контрагенты — в white-list с ручным approve.</div></div>
        <div class="adb-faq-item"><div class="adb-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-агент лучше напоминаний в 1С?</div><div class="adb-faq-a">1С шлёт шаблон по расписанию. AI персонализирует текст, классифицирует ответ клиента и эскалирует только те счета, где автоматика не сработала.</div></div>
        <div class="adb-faq-item"><div class="adb-faq-q" role="button" tabindex="0" aria-expanded="false">Что AI не делает?</div><div class="adb-faq-a">Юридическое взыскание, подача в суд, принудительное списание — только человек. Реструктуризация долга и переговоры с ключевыми контрагентами — с участием менеджера.</div></div>
    </div>
    <p class="adb-text-cta nero-ai-reveal" style="margin-top:28px;">Остались вопросы? <a href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Сократить дебиторку</a> — оставьте заявку или скачайте шаблоны мягких напоминаний.</p>
  </div>
</section>

<?php
$adb_page_url = trailingslashit( get_permalink() );
$adb_site_url = trailingslashit( home_url( '/' ) );
$adb_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$adb_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $adb_site_url . '#organization',
      'name'  => $adb_brand,
      'url'   => $adb_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $adb_site_url . '#website',
      'url'       => $adb_site_url,
      'name'      => $adb_brand,
      'publisher' => [ '@id' => $adb_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $adb_page_url . '#webpage',
      'url'         => $adb_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $adb_site_url . '#website' ],
      'about'       => [ '@id' => $adb_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $adb_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $adb_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $adb_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $adb_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $adb_page_url,
      'provider'    => [ '@id' => $adb_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $adb_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai дебиторская задолженность, если у нас нет IT-отдела?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Nero Network реализует проект под ключ: аудит → интеграция → пилот → запуск. От вас — доступы, политика оплаты и согласование текстов. Программист на вашей стороне не обязателен.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит ai дебиторская задолженность?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир 150–400 тыс. ₽ в зависимости от интеграций и каналов. Точную смету даём после аудита. Сравните с калькулятором на странице: часто один месяц просрочки стоит дороже годового внедрения.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходит ли ai дебиторская задолженность для малого бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да, если у вас от 30+ счетов в месяц и хотя бы один менеджер тратит время на напоминания. Для микробизнеса с 5–10 контрагентами может хватить rule-based робота в CRM.' ] ],
        [ '@type' => 'Question', 'name' => 'Юридические и тональные ограничения мягких напоминаний в РФ', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '152-ФЗ: локализация ПДн, отдельное согласие на обработку, штрафы до 700 тыс. ₽. Тон без угроз; отписка в каждом письме; тихие часы 9:00–19:00; автообзвон — только с согласия (230-ФЗ).' ] ],
        [ '@type' => 'Question', 'name' => 'Безопасность данных и доступы к учётным системам', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Доступы по принципу минимальных прав: чтение счетов и контрагентов, запись касаний. LLM в российском контуре (YandexGPT, GigaChat, on-prem). Договор на обработку ПДн — обязателен перед пилотом.' ] ],
        [ '@type' => 'Question', 'name' => 'Срок до первых результатов', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Первые автоматические касания — через 2–4 недели после старта. Измеримый эффект по DSO — обычно через 30–90 дней пилота.' ] ],
        [ '@type' => 'Question', 'name' => 'Клиенты воспримут напоминания как спам?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Сегментация, мягкий тон, правильное время и остановка после оплаты снижают негатив. VIP-контрагенты — в white-list с ручным approve.' ] ],
        [ '@type' => 'Question', 'name' => 'Чем AI-агент лучше напоминаний в 1С?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '1С шлёт шаблон по расписанию. AI персонализирует текст, классифицирует ответ клиента и эскалирует только те счета, где автоматика не сработала.' ] ],
        [ '@type' => 'Question', 'name' => 'Что AI не делает?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Юридическое взыскание, подача в суд, принудительное списание — только человек. Реструктуризация долга и переговоры с ключевыми контрагентами — с участием менеджера.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $adb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>
</div>
</main>

<script>
(function(){
  'use strict';
  var vol=document.getElementById('adb-calc-volume');
  var dso=document.getElementById('adb-calc-dso');
  var ovd=document.getElementById('adb-calc-overdue');
  if(!vol||!dso||!ovd) return;
  function fmt(n){return new Intl.NumberFormat('ru-RU',{maximumFractionDigits:1}).format(n);}
  function update(){
    var v=parseFloat(vol.value), d=parseInt(dso.value,10), o=parseInt(ovd.value,10)/100;
    document.getElementById('adb-calc-volume-val').textContent=fmt(v);
    document.getElementById('adb-calc-dso-val').textContent=d;
    document.getElementById('adb-calc-overdue-val').textContent=o*100;
    var frozen=v*1000000*o;
    var effect=v*1000000*(10/d);
    var roiMonths=275000/Math.max(effect/12,1);
    document.getElementById('adb-calc-frozen').textContent=fmt(frozen/1000000)+' млн ₽';
    document.getElementById('adb-calc-effect').textContent='+'+fmt(effect/1000000)+' млн ₽ в оборот';
    document.getElementById('adb-calc-roi').textContent='~'+fmt(roiMonths)+' мес. (при чеке 275 тыс. ₽)';
  }
  ['input','change'].forEach(function(ev){
    vol.addEventListener(ev,update); dso.addEventListener(ev,update); ovd.addEventListener(ev,update);
  });
  update();
})();
</script>


<script>
(function(){
  'use strict';
  document.querySelectorAll('.adb-faq-q').forEach(function(q){
    function toggle(){
      var item=q.closest('.adb-faq-item');
      var open=item.classList.contains('open');
      document.querySelectorAll('.adb-faq-item.open').forEach(function(i){i.classList.remove('open');});
      if(!open) item.classList.add('open');
      q.setAttribute('aria-expanded', String(!open));
    }
    q.addEventListener('click', toggle);
    q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); toggle(); }});
  });
})();
</script>

<script>
(function () {
  'use strict';

  var root = document.querySelector('.nero-ai-home-page');
  if (!root) return;

  var revealItems = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

    revealItems.forEach(function (item) { observer.observe(item); });
  } else {
    revealItems.forEach(function (item) { item.classList.add('nero-ai-active'); });
  }

  var tooltipItems = root.querySelectorAll('[data-nero-tooltip]');
  tooltipItems.forEach(function (item) {
    if (!item.hasAttribute('tabindex')) item.setAttribute('tabindex', '0');

    item.addEventListener('click', function (event) {
      var isActive = item.classList.contains('nero-ai-tooltip-active');
      tooltipItems.forEach(function (other) { other.classList.remove('nero-ai-tooltip-active'); });
      if (!isActive) item.classList.add('nero-ai-tooltip-active');
      event.stopPropagation();
    });
  });

  document.addEventListener('click', function () {
    tooltipItems.forEach(function (item) { item.classList.remove('nero-ai-tooltip-active'); });
  });

  var counters = root.querySelectorAll('[data-nero-count]');
  function animateCounter(el) {
    var target = parseFloat(el.getAttribute('data-nero-count') || '0');
    var suffix = el.getAttribute('data-nero-suffix') || '';
    var prefix = el.getAttribute('data-nero-prefix') || '';
    var duration = 850;
    var start = performance.now();

    function frame(now) {
      var progress = Math.min((now - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      var value = Math.round(target * eased);
      el.textContent = prefix + value + suffix;
      if (progress < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  if ('IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting && !entry.target.dataset.neroDone) {
          entry.target.dataset.neroDone = '1';
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.35 });
    counters.forEach(function (counter) { counterObserver.observe(counter); });
  } else {
    counters.forEach(animateCounter);
  }
})();

</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
