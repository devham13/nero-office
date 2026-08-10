<?php
/**
 * Template Name: AI для ритейла: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI для розничной торговли. Прогноз спроса, поддержка, рекомендации, аналитика.
 */

$page_seo_title       = 'AI для ритейла: внедрение и настройка под ключ';
$page_seo_description = 'Внедряем AI для ритейла: прогноз спроса, поддержка покупателей, рекомендации и аналитика продаж. Кейсы, стек, стоимость. Оцените бесплатно.';

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
    ['label' => 'Зачем AI', 'href' => '#zachem-riteylu-ai'],
    ['label' => 'Задачи', 'href' => '#zadachi-ai-riteyl'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie-pod-klyuch'],
    ['label' => 'Кейсы', 'href' => '#keisy-roi'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить AI для ритейла';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '';

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

.vrtl-content{
  --vrtl-bg:#f8fafc;--vrtl-card:#fff;--vrtl-ink:#0f172a;--vrtl-muted:#475569;--vrtl-soft:#334155;
  --vrtl-border:#e2e8f0;--vrtl-accent:#06b6d4;--vrtl-violet:#8b5cf6;--vrtl-green:#22c55e;
  --vrtl-btn-from:#2563eb;--vrtl-btn-to:#7c3aed;--vrtl-r:18px;--vrtl-container:1160px;
  background:var(--vrtl-bg);color:var(--vrtl-ink);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vrtl-content *,.vrtl-content *::before,.vrtl-content *::after{box-sizing:border-box}
.vrtl-content a{color:inherit}
.vrtl-content p{color:var(--vrtl-muted);line-height:1.72;margin:0 0 1em}
.vrtl-content p:last-child{margin-bottom:0}
.vrtl-content h2,.vrtl-content h3,.vrtl-content h4{color:var(--vrtl-ink);letter-spacing:-.03em;margin:0 0 .7em}
.vrtl-content strong{color:var(--vrtl-soft)}
.vrtl-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vrtl-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vrtl-muted);font-size:14.5px;line-height:1.65}
.vrtl-content ul li::before{content:'›';position:absolute;left:0;color:var(--vrtl-accent);font-weight:700}
.vrtl-cnt{width:min(var(--vrtl-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vrtl-section{padding:clamp(56px,7vw,96px) 0}
.vrtl-section-alt{background:#fff;border-top:1px solid var(--vrtl-border);border-bottom:1px solid var(--vrtl-border)}
.vrtl-sh{max-width:820px;margin:0 auto 40px;text-align:center}
.vrtl-sh.vrtl-left{margin-left:0;text-align:left}
.vrtl-sh h2{font-size:clamp(26px,3.6vw,44px);line-height:1.08;margin-bottom:12px}
.vrtl-sh p{font-size:clamp(15px,1.5vw,17px);max-width:680px;margin:0 auto}
.vrtl-sh.vrtl-left p{margin-left:0}
.vrtl-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(6,182,212,.08);border:1px solid rgba(6,182,212,.22);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#0891b2;margin-bottom:12px}
.vrtl-callout{border-left:4px solid var(--vrtl-accent);padding:16px 20px;background:#fff;border-radius:0 var(--vrtl-r) var(--vrtl-r) 0;box-shadow:0 4px 24px rgba(15,23,42,.06);margin:20px 0}
.vrtl-intro{padding:clamp(36px,5vw,64px) 0;border-bottom:1px solid var(--vrtl-border);background:#fff}

.vrtl-intro-text{position:relative;padding-left:20px;text-align:left!important}
.vrtl-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vrtl-accent),var(--vrtl-violet))}
.vrtl-intro-text p{text-align:left!important}
.vrtl-intro-grid{display:grid;grid-template-columns:1fr 300px;gap:40px;align-items:start}
.vrtl-intro-text p{font-size:15px;text-align:left!important}
.vrtl-kpi-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vrtl-kpi{background:var(--vrtl-bg);border:1px solid var(--vrtl-border);border-radius:14px;padding:14px;text-align:center}
.vrtl-kpi .kv{font-size:22px;font-weight:900;color:var(--vrtl-ink)}
.vrtl-kpi .kl{font-size:11px;color:var(--vrtl-muted);line-height:1.4}
@media(max-width:900px){.vrtl-intro-grid{grid-template-columns:1fr}}
.vrtl-toc{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;padding:0 0 40px}
.vrtl-toc a{display:inline-block;padding:8px 16px;background:#fff;border:1px solid var(--vrtl-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vrtl-muted);text-decoration:none!important;transition:.2s}
.vrtl-toc a:hover{border-color:var(--vrtl-accent);color:#0891b2}
.vrtl-card{background:#fff;border:1px solid var(--vrtl-border);border-radius:var(--vrtl-r);padding:24px;box-shadow:0 4px 20px rgba(15,23,42,.05)}
.vrtl-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.vrtl-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
@media(max-width:768px){.vrtl-grid-2,.vrtl-grid-3{grid-template-columns:1fr}}
.vrtl-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid var(--vrtl-border);margin:24px 0;background:#fff}
.vrtl-table{width:100%;border-collapse:collapse;font-size:14px}
.vrtl-table th{padding:12px 16px;text-align:left;background:rgba(6,182,212,.08);color:#0e7490;font-weight:700;border-bottom:1px solid var(--vrtl-border)}
.vrtl-table td{padding:12px 16px;border-bottom:1px solid var(--vrtl-border);color:var(--vrtl-muted);vertical-align:top}
.vrtl-table tr:nth-child(even) td{background:#f8fafc}
.vrtl-table tr:last-child td{border-bottom:none}
.vrtl-mod-icon{display:inline-flex;width:28px;height:28px;border-radius:8px;align-items:center;justify-content:center;font-size:14px;margin-right:8px;vertical-align:middle}
.vrtl-mod-forecast{background:rgba(6,182,212,.12)}
.vrtl-mod-support{background:rgba(139,92,246,.12)}
.vrtl-mod-recs{background:rgba(245,158,11,.12)}
.vrtl-mod-analytics{background:rgba(34,197,94,.12)}
.vrtl-pipeline{display:flex;flex-wrap:wrap;gap:10px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:#fff;border:1px solid var(--vrtl-border);border-radius:16px}
.vrtl-pipeline span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(6,182,212,.1);color:#0e7490;border:1px solid rgba(6,182,212,.2)}
.vrtl-pipeline .arr{color:var(--vrtl-muted);background:none;border:none;padding:0 4px}
.vrtl-timeline{position:relative;padding-left:36px}
.vrtl-timeline::before{content:'';position:absolute;left:10px;top:6px;bottom:6px;width:2px;background:linear-gradient(180deg,var(--vrtl-accent),var(--vrtl-violet));opacity:.35}
.vrtl-tl{position:relative;margin-bottom:28px}
.vrtl-tl-dot{position:absolute;left:-30px;top:4px;width:14px;height:14px;border-radius:50%;background:var(--vrtl-accent);box-shadow:0 0 0 4px rgba(6,182,212,.15)}
.vrtl-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vrtl-faq-item{background:#fff;border:1px solid var(--vrtl-border);border-radius:14px;overflow:hidden}
.vrtl-faq-q{padding:18px 22px;font-size:16px;font-weight:700;color:var(--vrtl-ink);cursor:pointer;display:flex;justify-content:space-between;gap:12px;user-select:none}
.vrtl-faq-q::after{content:'▾';color:var(--vrtl-accent);transition:transform .25s}
.vrtl-faq-item.open .vrtl-faq-q::after{transform:rotate(180deg)}
.vrtl-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .35s ease,padding .25s;font-size:14.5px;color:var(--vrtl-muted)}
.vrtl-faq-item.open .vrtl-faq-a{max-height:800px;padding:0 22px 18px}
.ym-cta-block{border-radius:20px;padding:32px 36px;margin:28px 0;background:linear-gradient(135deg,rgba(6,182,212,.1),rgba(139,92,246,.08));border:1px solid rgba(6,182,212,.25);text-align:center}
.ym-cta-block--secondary{text-align:left;background:#fff;border-color:var(--vrtl-border)}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.1),rgba(6,182,212,.08));border-color:rgba(139,92,246,.25)}
.ym-cta-block__icon{font-size:32px;margin-bottom:12px}
.ym-cta-block__headline{font-size:clamp(20px,2.6vw,26px);font-weight:800;color:var(--vrtl-ink);margin:0 0 10px}
.ym-cta-block__sub{color:var(--vrtl-muted);font-size:15px;margin:0 auto 20px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-btn{display:inline-flex;align-items:center;padding:12px 26px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vrtl-btn-from),var(--vrtl-btn-to));color:#fff!important;box-shadow:0 8px 28px rgba(59,130,246,.3)}
.ym-btn--ghost{background:#fff;color:var(--vrtl-ink)!important;border:1.5px solid var(--vrtl-border)}
.ym-link--accent{color:#0891b2!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(20px);transition:opacity .5s ease,transform .5s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
.vrtl-disclaimer{font-size:13px;color:var(--vrtl-muted);font-style:italic;margin-top:12px}
/* Boris block */
#vnedrenie-ai-dlya-riteyla-boris-block.brt-root{padding:48px 0 56px;background:#f1f5f9}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.2);min-height:480px}
@media(max-width:1023px){#vnedrenie-ai-dlya-riteyla-boris-block .brt-card{grid-template-columns:1fr;min-height:auto}}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0}
@media(max-width:1023px){#vnedrenie-ai-dlya-riteyla-boris-block .brt-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0891b2;margin:0 0 14px}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-ey::before{content:'';width:18px;height:2px;background:#06b6d4;border-radius:1px}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-ul{list-style:none;margin:0 0 20px;padding:0;display:flex;flex-direction:column;gap:9px}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-ul li{display:flex;gap:10px;font-size:14px;line-height:1.5;color:#334155}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(6,182,212,.12);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0891b2;font-style:normal}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-pl-c{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22)}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22)}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#vnedrenie-ai-dlya-riteyla-boris-block .brt-rgt{position:relative;background:linear-gradient(135deg,#f0f9ff,#e0f2fe 45%,#f8fafc);min-height:420px;overflow:hidden}
@media(max-width:1023px){#vnedrenie-ai-dlya-riteyla-boris-block .brt-rgt{min-height:360px}}
#brt-retail-hub-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>


<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-dlya-riteyla-page" role="main" tabindex="-1">

<section class="nero-ai-hero vrai-hero-retail" id="vrai-hero-retail" aria-labelledby="vrai-hero-title">
<style>
.vrai-hero-retail {
  --vrai-cyan: #79f2ff;
  --vrai-violet: #8b5cf6;
  --vrai-green: #22c55e;
  --vrai-bg: #050711;
  position: relative;
  min-height: 100vh;
  min-height: 100dvh;
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: #e6edf7;
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.vrai-hero-retail::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 45% 30%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: 0;
}
.vrai-hero-retail .nero-ai-container { width: min(1220px, calc(100% - 40px)); margin: 0 auto; position: relative; z-index: 1; }
.vrai-hero-retail .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(340px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vrai-hero-retail .nero-ai-eyebrow {
  display: inline-flex; align-items: center; gap: 8px; margin: 0 0 16px; padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2); border-radius: 999px;
  background: rgba(121, 242, 255, 0.08); color: var(--vrai-cyan) !important;
  font-size: 13px; font-weight: 750; text-transform: uppercase; letter-spacing: 0.11em;
}
.vrai-hero-retail h1 {
  margin: 0; max-width: 780px;
  font-size: clamp(40px, 6.8vw, 88px); line-height: .92; letter-spacing: -0.07em; color: #fff;
}
.vrai-hero-retail .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vrai-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text; background-clip: text; color: transparent !important;
}
.vrai-hero-retail .nero-ai-hero-lead {
  margin: 24px 0 0; max-width: 720px; color: #c7d2e5 !important;
  font-size: clamp(17px, 2vw, 22px); line-height: 1.58;
}
.vrai-hero-retail .nero-ai-badges { display: flex; flex-wrap: wrap; gap: 10px; margin: 26px 0 0; padding: 0; list-style: none; }
.vrai-hero-retail .nero-ai-badge {
  display: inline-flex; padding: 8px 11px; border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px; background: rgba(255,255,255,.055); color: #dce8f7;
  font-size: 13px; font-weight: 700; white-space: nowrap;
}
.vrai-hero-retail .nero-ai-btn-row { display: flex; flex-wrap: wrap; gap: 14px; margin-top: 34px; }
.vrai-hero-retail .nero-ai-btn {
  display: inline-flex; align-items: center; justify-content: center; min-height: 48px;
  padding: 14px 20px; border-radius: 999px; font-size: 15px; font-weight: 800;
  text-decoration: none !important; transition: transform .22s ease;
}
.vrai-hero-retail .nero-ai-btn:hover { transform: translateY(-2px); }
.vrai-hero-retail .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vrai-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vrai-hero-retail .nero-ai-btn-secondary {
  color: #e6edf7 !important; background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.14);
}
.vrai-hero-retail .nero-ai-dashboard {
  position: relative; padding: 18px; border-radius: 34px;
  background: rgba(2, 6, 23, 0.42); box-shadow: 0 28px 90px rgba(0,0,0,.42);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vrai-hero-retail .nero-ai-dashboard-shell {
  overflow: hidden; border: 1px solid rgba(255,255,255,.12); border-radius: 26px;
  background: linear-gradient(180deg, rgba(15,23,42,.95), rgba(6,10,24,.96));
}
.vrai-hero-retail .nero-ai-window-top {
  display: flex; align-items: center; justify-content: space-between; gap: 14px;
  padding: 14px 16px; border-bottom: 1px solid rgba(255,255,255,.08); background: rgba(255,255,255,.045);
}
.vrai-hero-retail .nero-ai-dots { display: flex; gap: 7px; }
.vrai-hero-retail .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vrai-hero-retail .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vrai-hero-retail .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vrai-hero-retail .nero-ai-dot:nth-child(3) { background: #34d399; }
.vrai-hero-retail .nero-ai-window-title { color: #cfe3f9; font-size: 12px; font-weight: 750; letter-spacing: .08em; text-transform: uppercase; }
.vrai-hero-retail .nero-ai-window-body { padding: 18px; }
.vrai-hero-retail .nero-ai-dashboard-title { display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; margin-bottom: 16px; }
.vrai-hero-retail .nero-ai-dashboard-title h3 { margin: 0; font-size: 20px; color: #fff; letter-spacing: -0.03em; }
.vrai-hero-retail .nero-ai-live-pill {
  display: inline-flex; align-items: center; gap: 7px; padding: 6px 9px; border-radius: 999px;
  background: rgba(34,197,94,.10); color: #bbf7d0; font-size: 12px; font-weight: 800;
}
.vrai-hero-retail .nero-ai-live-pill::before {
  content: ""; width: 7px; height: 7px; border-radius: 50%; background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
}
.vrai-hero-retail .nero-ai-metrics-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
.vrai-hero-retail .nero-ai-metric {
  padding: 14px; border: 1px solid rgba(255,255,255,.09); border-radius: 18px; background: rgba(255,255,255,.055);
}
.vrai-hero-retail .nero-ai-metric span { display: block; color: #9aa8bd; font-size: 12px; font-weight: 700; }
.vrai-hero-retail .nero-ai-metric strong { display: block; margin-top: 7px; color: #fff; font-size: 22px; line-height: 1; }
.vrai-hero-retail .vrai-dash-canvas-wrap {
  margin-top: 14px; height: 200px; border-radius: 16px; overflow: hidden;
  border: 1px solid rgba(121,242,255,.14); background: rgba(5,7,17,.6);
}
.vrai-hero-retail #retail-ai-hero-canvas { display: block; width: 100%; height: 100%; }
.vrai-hero-retail .nero-ai-task-stream { margin-top: 14px; display: grid; gap: 10px; }
.vrai-hero-retail .nero-ai-task {
  display: grid; grid-template-columns: 28px 1fr auto; align-items: center; gap: 10px;
  padding: 11px; border: 1px solid rgba(255,255,255,.08); border-radius: 16px; background: rgba(255,255,255,.04);
}
.vrai-hero-retail .nero-ai-task-icon {
  display: grid; place-items: center; width: 28px; height: 28px; border-radius: 12px;
  background: rgba(121,242,255,.12); color: var(--vrai-cyan); font-size: 13px;
}
.vrai-hero-retail .nero-ai-task strong { display: block; color: #f8fafc; font-size: 13px; }
.vrai-hero-retail .nero-ai-task span { color: #9aa8bd; font-size: 12px; }
.vrai-hero-retail .nero-ai-status { color: #86efac; font-size: 11px; font-weight: 800; text-transform: uppercase; }
.vrai-hero-retail .nero-ai-status--amber { color: #fcd34d; }
@media (max-width: 960px) {
  .vrai-hero-retail .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vrai-hero-retail .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow">Ритейл · внедрение под ключ</p>
      <h1 id="vrai-hero-title">AI для ритейла: внедрение и настройка <span class="nero-ai-gradient-text">под ключ</span></h1>
      <p class="nero-ai-hero-lead">Прогноз спроса, AI-поддержка покупателей и аналитика продаж для магазинов, сетей и D2C-брендов — без лишнего штата и ручной рутины</p>
      <ul class="nero-ai-badges" aria-label="Ключевые модули">
        <li class="nero-ai-badge">Прогноз спроса</li>
        <li class="nero-ai-badge">AI-поддержка</li>
        <li class="nero-ai-badge">Рекомендации</li>
        <li class="nero-ai-badge">Аналитика</li>
        <li class="nero-ai-badge">1С / CRM</li>
        <li class="nero-ai-badge">Ozon / WB</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#vnedrenie-pod-klyuch">Как внедряем</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демонстрация AI-контура ритейла">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-контур ритейла</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>OOS-алерты</span><strong>−34%</strong></div>
            <div class="nero-ai-metric"><span>Время ответа</span><strong>9 сек</strong></div>
            <div class="nero-ai-metric"><span>Автозакрытие тикетов</span><strong>62%</strong></div>
            <div class="nero-ai-metric"><span>Точность прогноза</span><strong>91%</strong></div>
          </div>
          <div class="vrai-dash-canvas-wrap" aria-hidden="false">
            <canvas id="retail-ai-hero-canvas" role="img" aria-label="Анимация: потоки SKU сходятся в AI-хаб ритейла, агенты обрабатывают заказ и прогноз"></canvas>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента событий ритейла">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Заказ в Telegram</strong><span>«где мой заказ #4821?»</span></div>
              <span class="nero-ai-status">ответ</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Статус из RetailCRM</strong><span>в пути · доставка завтра</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Рекомендация SKU</strong><span>размер M · cross-sell +12%</span></div>
              <span class="nero-ai-status">upsell</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Алерт OOS</strong><span>SKU-8842 · пополнение через 2 дня</span></div>
              <span class="nero-ai-status nero-ai-status--amber">alert</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("retail-ai-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, cx = 0, cy = 0, frame = 0, scale = 1;

  function resize() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 200;
    cw = canvas.width; ch = canvas.height;
    cx = cw * 0.52; cy = ch * 0.48;
    scale = Math.min(cw / 420, ch / 200) * 0.95;
  }
  window.addEventListener("resize", resize);
  resize();

  var C = {
    outline: "#94a3b8", hub: "#1e293b", shelf: "#334155",
    cyan: "#79f2ff", violet: "#8b5cf6", green: "#22c55e", amber: "#f59e0b",
    agentYellow: "#eab308", agentGreen: "#10b981", agentBlue: "#3b82f6",
    agentPink: "#ec4899", agentPurple: "#8b5cf6", bubble: "#0f172a"
  };

  function rr(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r); else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function SkuDataArc(x1, y1, x2, y2, color) {
    this.x1 = x1; this.y1 = y1; this.x2 = x2; this.y2 = y2; this.color = color;
    this.offset = Math.random() * 100;
  }
  SkuDataArc.prototype.draw = function (ctx) {
    var t = (frame * 0.4 + this.offset) % 120;
    ctx.strokeStyle = this.color;
    ctx.lineWidth = 2;
    ctx.globalAlpha = 0.35;
    ctx.beginPath();
    ctx.moveTo(this.x1, this.y1);
    ctx.quadraticCurveTo((this.x1 + this.x2) / 2, (this.y1 + this.y2) / 2 - 40 * scale, this.x2, this.y2);
    ctx.stroke();
    ctx.globalAlpha = 1;
    var p = t / 120;
    var mx = this.x1 + (this.x2 - this.x1) * p;
    var my = this.y1 + (this.y2 - this.y1) * p - Math.sin(p * Math.PI) * 40 * scale;
    rr(ctx, mx - 8, my - 5, 16, 10, 3, this.color, C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 6px sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SKU", mx, my + 2);
  };

  function RetailCommandHub(x, y) {
    this.x = x; this.y = y;
    this.phase = 0;
    this.roiPulse = 0;
  }
  RetailCommandHub.prototype.draw = function (ctx) {
    this.phase = (frame * 0.06) % 220;
    rr(ctx, this.x - 70 * scale, this.y - 55 * scale, 140 * scale, 110 * scale, 10, C.hub, C.outline);
    for (var i = 0; i < 3; i++) {
      rr(ctx, this.x - 55 * scale + i * 38 * scale, this.y - 35 * scale, 28 * scale, 40 * scale, 4, C.shelf, C.outline);
      ctx.fillStyle = C.cyan;
      ctx.globalAlpha = this.phase > 30 + i * 25 ? 0.9 : 0.2;
      ctx.fillRect(this.x - 50 * scale + i * 38 * scale, this.y - 28 * scale + (i % 2) * 8, 18 * scale, 6);
      ctx.globalAlpha = 1;
    }
    if (this.phase > 80) {
      ctx.strokeStyle = C.violet;
      ctx.lineWidth = 2;
      ctx.beginPath();
      for (var j = 0; j < 5; j++) {
        var gx = this.x - 50 * scale + j * 22 * scale;
        var gy = this.y + 18 * scale - Math.sin((frame + j * 12) * 0.08) * 10 * scale;
        if (j === 0) ctx.moveTo(gx, gy); else ctx.lineTo(gx, gy);
      }
      ctx.stroke();
    }
    if (this.phase > 170) {
      this.roiPulse = Math.min(1, this.roiPulse + 0.04);
      ctx.save();
      ctx.globalAlpha = this.roiPulse * (1 - this.roiPulse * 0.3);
      ctx.strokeStyle = C.green;
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.arc(this.x, this.y, 55 * scale * this.roiPulse, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.green;
      ctx.font = "bold " + (10 * scale) + "px sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("ROI +", this.x, this.y - 62 * scale);
      ctx.restore();
    } else {
      this.roiPulse = 0;
    }
  };

  function Agent(x, y, color, role, dialogs) {
    this.x = x; this.y = y; this.color = color; this.role = role;
    this.dialogs = dialogs; this.dir = 1; this.stepTrig = Math.random() * 200;
    this.bubble = 0;
  }
  Agent.prototype.draw = function (ctx) {
    this.stepTrig = (this.stepTrig + 0.35) % 200;
    var tx = cx + (this.role === "1_architect" ? -90 : this.role === "5_deployer" ? 90 : 0) * scale;
    var ty = cy + (this.role === "3_coder" ? 55 : this.role === "4_designer" ? -50 : 70) * scale;
    if (this.stepTrig > 40 && this.stepTrig < 160) {
      this.x += (tx - this.x) * 0.04;
      this.y += (ty - this.y) * 0.04;
    }
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y - 12, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.fillRect(this.x - 5, this.y - 5, 10, 14);
    if (this.stepTrig > 90 && this.stepTrig < 110 && Math.random() < 0.02) {
      this.bubble = 80;
      this.bubbleText = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
    }
    if (this.bubble > 0) {
      this.bubble--;
      ctx.fillStyle = "rgba(255,255,255,0.95)";
      var bw = ctx.measureText(this.bubbleText).width + 14;
      rr(ctx, this.x - bw / 2, this.y - 38, bw, 16, 6, "rgba(255,255,255,0.95)", C.outline);
      ctx.fillStyle = C.bubble;
      ctx.font = "9px sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(this.bubbleText, this.x, this.y - 26);
    }
  };

  var arcs = [
    new SkuDataArc(20, 20, cx, cy, C.cyan),
    new SkuDataArc(cw - 20, 30, cx, cy, C.violet),
    new SkuDataArc(40, ch - 20, cx, cy, C.amber)
  ];
  var hub = new RetailCommandHub(cx, cy - 10 * scale);
  var agents = [
    new Agent(40, ch - 40, C.agentYellow, "1_architect", ["Связал 1С с data layer", "ETL продаж запущен", "Остатки синхронизированы"]),
    new Agent(60, 50, C.agentGreen, "2_seo", ["Каталог для agentic commerce", "Карточки обогащены LLM", "Фиды Ozon актуальны"]),
    new Agent(cw - 50, ch - 35, C.agentBlue, "3_coder", ["RAG на регламентах", "API CRM подключён", "Handoff настроен"]),
    new Agent(cw - 45, 45, C.agentPink, "4_designer", ["Сценарий чата готов", "Рекомендации в корзине", "Визуальный поиск включён"]),
    new Agent(cx, ch - 25, C.agentPurple, "5_deployer", ["Пилот на Telegram", "KPI зафиксированы", "Масштаб на 12 ТЗ"])
  ];
  var bubbles = [];

  function createBubble(text, x, y) {
    bubbles.push({ text: text, x: x, y: y, life: 100 });
  }

  function loop() {
    ctx.clearRect(0, 0, cw, ch);
    ctx.fillStyle = "rgba(5,7,17,0.3)";
    ctx.fillRect(0, 0, cw, ch);
    arcs.forEach(function (a) { a.draw(ctx); });
    hub.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });
    if (frame % 140 === 60) createBubble("Заказ из Telegram", 30, 30);
    if (frame % 140 === 85) createBubble("Прогноз спроса +8%", cx, 20);
    if (frame % 140 === 110) createBubble("OOS: SKU-8842", cw - 60, 40);
    if (frame % 140 === 130) createBubble("Тикет закрыт AI", cx, ch - 30);
    bubbles = bubbles.filter(function (b) {
      b.life--;
      b.y -= 0.3;
      ctx.globalAlpha = b.life / 100;
      ctx.fillStyle = C.cyan;
      ctx.font = "9px sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(b.text, b.x, b.y);
      ctx.globalAlpha = 1;
      return b.life > 0;
    });
    frame++;
    requestAnimationFrame(loop);
  }
  loop();
});
</script>

<div class="vrtl-content">

<section class="vrtl-intro" id="intro" aria-label="Введение">
  <div class="vrtl-cnt">
    <div class="vrtl-intro-grid nero-ai-reveal">
      <div class="vrtl-intro-text">
        <p class="vrtl-eyebrow">Лонгрид · AI для ритейла</p>
        <div class="vrtl-callout"><p><strong>Коротко:</strong> внедрение AI для ритейла — это не «ещё один чат-бот», а связка прогноза спроса, AI-поддержки покупателей, персональных рекомендаций и аналитики продаж в едином контуре с вашей 1С, CRM и маркетплейсами. Nero Network настраивает такие решения под ключ: от аудита и пилота до масштабирования на сеть.</p></div>
        <p>Розничная торговля в 2026 году живёт в режиме постоянного дефицита внимания: покупатель сравнивает цены за секунды, ожидает ответ в мессенджере мгновенно, а собственник одновременно балансирует ассортимент, запасы, персонал и маржу. Искусственный интеллект для ритейла перестал быть экспериментом крупных сетей — он стал рабочим инструментом для магазинов, франшиз и D2C-брендов, которые хотят расти без пропорционального роста штата.</p>
      </div>
      <div class="vrtl-kpi-grid" aria-label="Ключевые метрики ритейла">
        <div class="vrtl-kpi"><div class="kv">58 млрд ₽</div><div class="kl">GenAI в РФ, 2025</div></div>
        <div class="vrtl-kpi"><div class="kv">×1,7</div><div class="kl">рост ИИ-трафика</div></div>
        <div class="vrtl-kpi"><div class="kv">60%</div><div class="kl">тикетов без человека</div></div>
        <div class="vrtl-kpi"><div class="kv">4 мес.</div><div class="kl">окупаемость пилота</div></div>
      </div>
    </div>
  </div>
</section>

<div class="vrtl-cnt">
  <nav class="vrtl-toc" aria-label="Оглавление статьи">
    <a href="#zachem-riteylu-ai">Зачем AI</a>
    <a href="#zadachi-ai-riteyl">Задачи</a>
    <a href="#dlya-kogo">Для кого</a>
    <a href="#vnedrenie-pod-klyuch">Внедрение</a>
    <a href="#stek-integracii">Стек</a>
    <a href="#keisy-roi">Кейсы</a>
    <a href="#stoimost">Стоимость</a>
    <a href="#pochemu-nero">Nero Network</a>
    <a href="#faq">FAQ</a>
    <a href="#ocenit">Оценить</a>
  </nav>
</div>


<section class="vrtl-section" id="zachem-riteylu-ai">
  <div class="vrtl-cnt">
    <div class="vrtl-sh vrtl-left nero-ai-reveal">
      <span class="vrtl-eyebrow">Обоснование</span>
      <h2>Зачем ритейлу AI в 2026 году</h2>
      <div class="vrtl-callout"><p><strong>Определение:</strong> AI для ритейла — применение машинного обучения, больших языковых моделей и AI-агентов к коммерческим и операционным процессам магазина: от прогноза спроса и пополнения до консультации покупателя и динамического ценообразования.</p></div>
    </div>
    <div class="vrtl-card nero-ai-reveal" style="margin-top:28px">
      <h3>Тренд AI-агентов в retail</h3>
      <p>В начале 2026 года Microsoft на NRF представила agentic AI для розничной торговли: шаблоны Store Operations Agent, Catalog Enrichment Agent и Personalized Shopping Agent в Copilot Studio, Brand Agents для Shopify, интеграции с ServiceNow и Dynamics 365. Это сигнал отрасли: enterprise retail переходит от разрозненных ботов к <strong>координированным AI-агентам</strong>, которые работают с каталогом, складом, политиками магазина и клиентским сервисом как единая система.</p>
      <p>Для российского ритейла тренд тот же, но стек другой: 1С, RetailCRM, YandexGPT, Ozon и Wildberries. Важно не копировать западные шаблоны буквально, а понимать архитектуру — <strong>единый слой данных + специализированные агенты под сценарии</strong>.</p>
      <p>По оценке Incomand, рынок GenAI в России в 2025 году достиг ~58 млрд ₽ (рост в 5 раз к 2024), а ритейл — один из ключевых драйверов с инвестициями порядка 6 млрд ₽ в ИИ-решения. Промышленное внедрение подтверждают X5 Group (5 млрд ₽ дополнительной операционной прибыли от ИИ в 2025) и «Магнит» (компьютерное зрение в 430 супермаркетах, собственная F&amp;R-система прогноза спроса).</p>
    </div>
    <div class="vrtl-grid-2 nero-ai-reveal nero-ai-delay-1" style="margin-top:20px">
      <div class="vrtl-card"><h3>Прогноз спроса</h3><p>Ручные Excel-таблицы и «заказ по прошлой неделе» дают OOS на ходовых SKU и излишки на неликвиде. ML-модели с горизонтом до 90 дней учитывают сезонность, промо, погоду и каналы — снижая списания и высвобождая оборотный капитал.</p></div>
      <div class="vrtl-card"><h3>Клиентский сервис</h3><p>Street Beat сократила время ответа с 6 минут до 9 секунд с помощью ИИ-ассистента «Стас»; CaseUp (D2C) закрывает 60% тикетов без человека при CSAT 4,5 из 5. Это не замена людей — это снятие рутины с первой линии.</p></div>
    </div>
    <div class="vrtl-card nero-ai-reveal nero-ai-delay-2" style="margin-top:20px">
      <h3>ИИ-трафик</h3>
      <p>По данным Forbes и StormWall, объём ИИ-трафика на сайты ритейлеров и маркетплейсов в России в январе–апреле 2026 вырос в 1,7 раза год к году; на Ozon — в 4 раза. Глобально Adobe зафиксировала рост AI-driven e-commerce трафика на 693% в holiday 2025. Магазин, который не готовит каталог и контент для agentic commerce, теряет новый канал привлечения.</p>
    </div>
  </div>
</section>


<section class="vrtl-section vrtl-section-alt" id="zadachi-ai-riteyl">
  <div class="vrtl-cnt">
    <div class="vrtl-sh nero-ai-reveal">
      <span class="vrtl-eyebrow">4 модуля оффера</span>
      <h2>Какие задачи ритейла закрывает AI</h2>
      <p><strong>Итог:</strong> четыре столпа внедрения AI для ритейла — прогноз спроса, AI-поддержка, персональные рекомендации и аналитика продаж.</p>
    </div>
    <div class="vrtl-table-wrap nero-ai-reveal">
      <table class="vrtl-table" aria-label="Модули AI для ритейла">
        <thead><tr><th>Модуль</th><th>Что делает AI</th><th>Типичный эффект</th><th>Данные для старта</th></tr></thead>
        <tbody>
          <tr><td><span class="vrtl-mod-icon vrtl-mod-forecast" aria-hidden="true">📈</span>Прогноз спроса</td><td>ML-прогноз по SKU/ТЗ, алерты OOS</td><td>Снижение списаний, меньше дефицита</td><td>12+ мес. продаж, остатки, промо</td></tr>
          <tr><td><span class="vrtl-mod-icon vrtl-mod-support" aria-hidden="true">💬</span>AI-поддержка</td><td>LLM + RAG, статусы заказов, handoff</td><td>50–80% тикетов без оператора</td><td>FAQ, регламенты, API CRM/1С</td></tr>
          <tr><td><span class="vrtl-mod-icon vrtl-mod-recs" aria-hidden="true">★</span>Рекомендации</td><td>Next-best-offer, upsell, визуальный поиск</td><td>Рост среднего чека, конверсии</td><td>Каталог, история покупок</td></tr>
          <tr><td><span class="vrtl-mod-icon vrtl-mod-analytics" aria-hidden="true">📊</span>Аналитика</td><td>BI, аномалии спроса, дашборды</td><td>Прозрачность для собственника</td><td>Продажи, маржа, каналы</td></tr>
        </tbody>
      </table>
    </div>
    <div class="vrtl-grid-2 nero-ai-reveal" style="margin-top:24px">
      <div class="vrtl-card"><h3>Прогноз спроса и ассортимент</h3><p>«Конкор-Оптика» внедрила ИИ «ПРОсковья» с 1С:УТ: +25% годовой выручки и сокращение остатков на 50% (Retail.ru). Для среднего ритейла достаточно качественных данных в учётной системе и грамотной интеграции.</p></div>
      <div class="vrtl-card"><h3>AI-поддержка покупателей</h3><p>RAG-база на регламентах + доступ к CRM даёт контекстные ответы; для входящей почты — <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vrtl-accent);text-decoration:underline;text-underline-offset:3px">автоматизация обработки писем в CRM</a>. CaseUp на YandexGPT 5 + RetailCRM снизил ФОТ саппорта с 280 000 до 145 000 ₽/мес при окупаемости около 4 месяцев.</p></div>
      <div class="vrtl-card"><h3>Персональные рекомендации</h3><p>Walmart Sparky (май 2026): средний чек пользователей агента на ~35% выше. Lowe's Mylow: конверсия онлайн-пользователей ассистента в 3 раза выше при 1 млн+ запросов в месяц.</p></div>
      <div class="vrtl-card"><h3>Аналитика продаж</h3><p>Аномалии спроса, OOS на полке — в Telegram коммерческой команде. Компьютерное зрение «Магнита» в 430 магазинах контролирует выкладку без ручного обхода.</p></div>
    </div>
  </div>
</section>

<section id="vnedrenie-ai-dlya-riteyla-boris-block" class="brt-root" aria-label="Анимация: единый AI-контур ритейла — поток данных в четыре модуля">
<div class="brt-cnt">
  <div class="brt-card">
    <div class="brt-lft">
      <span class="brt-ey">Омниканальный контур</span>
      <h3 class="brt-h3">1С, CRM и маркетплейсы — в одном AI-контуре ритейла</h3>
      <ul class="brt-ul">
        <li><span class="brt-ic">1</span>Прогноз спроса по SKU с алертами OOS на ходовые позиции</li>
        <li><span class="brt-ic">2</span>AI-поддержка в мессенджерах со статусами из CRM</li>
        <li><span class="brt-ic">3</span>Персональные рекомендации и upsell в корзине</li>
        <li><span class="brt-ic">4</span>Аналитика и алерты аномалий для коммерческой команды</li>
      </ul>
      <div class="brt-pills">
        <span class="brt-pl brt-pl-c">6 мин → 9 сек</span>
        <span class="brt-pl brt-pl-v">60% тикетов авто</span>
        <span class="brt-pl brt-pl-g">+25% выручки</span>
      </div>
      <p class="brt-foot">Дальше разберём, для кого подходит внедрение и как стартует пилот →</p>
    </div>
    <div class="brt-rgt">
      <canvas id="brt-retail-hub-canvas" role="img" aria-label="Анимация: поток данных из 1С, CRM и маркетплейсов в четыре модуля AI для ритейла"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('brt-retail-hub-canvas');
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
    cyan:'#06b6d4', violet:'#8b5cf6', green:'#22c55e', amber:'#f59e0b',
    ink:'#0f172a', muted:'#64748b', line:'rgba(15,23,42,.08)',
    card:'#ffffff', cardBdr:'rgba(148,163,184,.35)',
    hub:'#0ea5e9', hubGlow:'rgba(14,165,233,.18)'
  };

  var NODES = [
    {id:'forecast', label:'Прогноз', sub:'ML спрос', color:C.cyan, angle:-Math.PI/2},
    {id:'support',  label:'Поддержка', sub:'RAG + CRM', color:C.violet, angle:-Math.PI/6},
    {id:'recs',     label:'Рекомендации', sub:'upsell', color:C.amber, angle:Math.PI/6},
    {id:'analytics',label:'Аналитика', sub:'BI алерты', color:C.green, angle:Math.PI/2}
  ];

  var SOURCES = [
    {label:'1С', x:0.08, y:0.22},
    {label:'CRM', x:0.08, y:0.5},
    {label:'Ozon', x:0.08, y:0.78}
  ];

  var packets = [];
  var LOOP = 520;

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function hubPos(){
    return {x: W*0.58, y: H*0.5};
  }

  function nodePos(n, r){
    var h = hubPos();
    return {x: h.x + Math.cos(n.angle)*r, y: h.y + Math.sin(n.angle)*r};
  }

  function spawnPacket(){
    var src = SOURCES[Math.floor(Math.random()*SOURCES.length)];
    var tgt = NODES[Math.floor(Math.random()*NODES.length)];
    packets.push({
      sx: src.x*W, sy: src.y*H,
      tx: 0, ty: 0, tgt: tgt,
      t: 0, speed: 0.012 + Math.random()*0.008,
      color: tgt.color, label: src.label
    });
  }

  function drawSources(){
    SOURCES.forEach(function(s){
      var x = s.x*W, y = s.y*H;
      rr(x-28, y-16, 56, 32, 8, C.card, C.cardBdr);
      ctx.fillStyle = C.ink;
      ctx.font = 'bold 11px Inter,system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(s.label, x, y+4);
    });
  }

  function drawHub(pulse){
    var h = hubPos();
    var r = 44 + Math.sin(pulse*0.06)*4;
    ctx.beginPath();
    ctx.arc(h.x, h.y, r+18, 0, Math.PI*2);
    ctx.fillStyle = C.hubGlow;
    ctx.fill();
    ctx.beginPath();
    ctx.arc(h.x, h.y, r, 0, Math.PI*2);
    ctx.fillStyle = C.hub;
    ctx.fill();
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 12px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', h.x, h.y-2);
    ctx.font = '10px Inter,sans-serif';
    ctx.fillText('контур', h.x, h.y+12);
  }

  function drawNodes(rad){
    NODES.forEach(function(n){
      var p = nodePos(n, rad);
      rr(p.x-52, p.y-28, 104, 56, 12, C.card, C.cardBdr);
      ctx.fillStyle = n.color;
      ctx.beginPath();
      ctx.arc(p.x-38, p.y, 6, 0, Math.PI*2);
      ctx.fill();
      ctx.fillStyle = C.ink;
      ctx.font = 'bold 11px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(n.label, p.x-26, p.y-4);
      ctx.fillStyle = C.muted;
      ctx.font = '10px Inter,sans-serif';
      ctx.fillText(n.sub, p.x-26, p.y+12);
    });
  }

  function drawLinks(rad){
    var h = hubPos();
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1.5;
    SOURCES.forEach(function(s){
      ctx.beginPath();
      ctx.moveTo(s.x*W+28, s.y*H);
      ctx.lineTo(h.x-40, h.y);
      ctx.stroke();
    });
    NODES.forEach(function(n){
      var p = nodePos(n, rad);
      ctx.strokeStyle = n.color + '44';
      ctx.beginPath();
      ctx.moveTo(h.x+30, h.y);
      ctx.lineTo(p.x-52, p.y);
      ctx.stroke();
    });
  }

  function drawPackets(){
    packets.forEach(function(pk, i){
      pk.t += pk.speed;
      if(pk.t >= 1){ packets.splice(i,1); return; }
      var h = hubPos();
      var midX = h.x - 60;
      var x, y;
      if(pk.t < 0.45){
        var t = pk.t/0.45;
        x = pk.sx + (midX - pk.sx)*t;
        y = pk.sy + (h.y - pk.sy)*t;
      } else {
        var p = nodePos(pk.tgt, Math.min(W,H)*0.34);
        var t = (pk.t-0.45)/0.55;
        x = midX + (p.x-52 - midX)*t;
        y = h.y + (p.y - h.y)*t;
      }
      ctx.beginPath();
      ctx.arc(x, y, 5, 0, Math.PI*2);
      ctx.fillStyle = pk.color;
      ctx.fill();
    });
  }

  function drawLegend(){
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Данные 1С / CRM / маркетплейсы → единый AI-контур ритейла', 14, H-14);
  }

  function loop(){
    frame++;
    var prg = frame % LOOP;
    if(prg % 38 === 0) spawnPacket();

    ctx.clearRect(0,0,W,H);
    var grad = ctx.createLinearGradient(0,0,W,H);
    grad.addColorStop(0,'#f0f9ff');
    grad.addColorStop(1,'#f8fafc');
    ctx.fillStyle = grad;
    ctx.fillRect(0,0,W,H);

    var rad = Math.min(W,H)*0.34;
    drawLinks(rad);
    drawSources();
    drawHub(frame);
    drawNodes(rad);
    drawPackets();
    drawLegend();
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

<aside class="ym-cta-block ym-cta-block--primary vrtl-cnt" id="cta-zadachi" style="max-width:1160px">
  <div class="ym-cta-block__icon" aria-hidden="true">🛒</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">С чего начать AI в вашем ритейле?</p>
    <p class="ym-cta-block__sub">На бесплатной оценке разберём ассортимент, каналы и данные — и предложим один сценарий пилота: поддержка, прогноз спроса или рекомендации. Без обязательств.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</aside>


<section class="vrtl-section" id="dlya-kogo">
  <div class="vrtl-cnt">
    <div class="vrtl-sh vrtl-left nero-ai-reveal"><span class="vrtl-eyebrow">Сегменты</span><h2>Для кого подходит внедрение AI</h2><p>Внедрение AI для ритейла масштабируется от одной точки до федеральной сети — но приоритеты и бюджет различаются.</p></div>
    <div class="vrtl-grid-3 nero-ai-reveal" style="margin-top:28px">
      <div class="vrtl-card"><h3>Магазины и D2C</h3><p><strong>AI для ритейла для малого бизнеса</strong> — быстрый пилот: AI-поддержка + WhatsApp/Telegram, рекомендации в корзине. Стек: RetailCRM или <a href="/vnedrenie-ai-amocrm/" style="color:var(--vrtl-accent);text-decoration:underline;text-underline-offset:3px">amoCRM с AI-агентом под ключ</a>, YandexGPT. Срок пилота — 4–6 недель.</p></div>
      <div class="vrtl-card"><h3>Сети и франшизы</h3><p><strong>AI для ритейла для среднего бизнеса</strong> — 15–50 магазинов, 3–8 тыс. SKU. Единые регламенты, прогноз по категориям, масштабирование пилота на все ТЗ.</p></div>
      <div class="vrtl-card"><h3>Омниканал</h3><p>Ритейлер с Ozon, Wildberries и Яндекс Маркетом получает AI-агента, который знает остатки и статусы по всем каналам. Каталог как API для внешних и внутренних агентов.</p></div>
    </div>
  </div>
</section>

<section class="vrtl-section vrtl-section-alt" id="vnedrenie-pod-klyuch">
  <div class="vrtl-cnt">
    <div class="vrtl-sh nero-ai-reveal"><span class="vrtl-eyebrow">Под ключ</span><h2>Как мы внедряем AI для ритейла под ключ</h2><p><strong>Внедрение AI для ритейла под ключ</strong> в Nero Network — проектная модель с измеримым пилотом, а не бесконечная «цифровая трансформация».</p></div>
    <div class="vrtl-grid-3 nero-ai-reveal" style="margin-top:28px">
      <div class="vrtl-card"><h3>Аудит и Карта AI</h3><p>5–7 дней аудита: карта данных, 2–3 гипотезы ROI. Результат — <strong>Карта AI для ритейла</strong> (лид-магнит): матрица «модуль × срок × данные × эффект».</p></div>
      <div class="vrtl-card"><h3>Пилот на сценарии</h3><p>4–6 недель на одном модуле. Фиксируем KPI до/после: время ответа, конверсия, OOS, нагрузка на 1-ю линию.</p></div>
      <div class="vrtl-card"><h3>Масштабирование</h3><p>После пилота — второй модуль, единый дашборд эффекта, API к 1С, фиды маркетплейсов, виджет + Telegram/VK.</p></div>
    </div>
    <div class="vrtl-pipeline nero-ai-reveal" aria-label="Логика системы — 5 шагов">
      <span>1. Данные 1С/CRM/МП</span><span class="arr">→</span>
      <span>2. Единый слой ETL</span><span class="arr">→</span>
      <span>3. ML / RAG + каталог</span><span class="arr">→</span>
      <span>4. AI-агент в каналах</span><span class="arr">→</span>
      <span>5. Отчётность KPI</span>
    </div>
    <div class="vrtl-timeline nero-ai-reveal" style="margin-top:32px">
      <div class="vrtl-tl"><div class="vrtl-tl-dot"></div><h3>Данные → единый слой</h3><p>Данные из 1С/CRM/маркетплейсов → ETL, n8n, Make.</p></div>
      <div class="vrtl-tl"><div class="vrtl-tl-dot"></div><h3>ML-прогноз / RAG → агент</h3><p>ML-прогноз / RAG + каталог → AI-агент.</p></div>
      <div class="vrtl-tl"><div class="vrtl-tl-dot"></div><h3>Каналы и эскалация</h3><p>Агент отвечает в каналах; сложные кейсы → оператор с контекстом.</p></div>
      <div class="vrtl-tl"><div class="vrtl-tl-dot"></div><h3>Алерты коммерции</h3><p>Алерты (OOS, аномалии) → коммерческая команда.</p></div>
      <div class="vrtl-tl"><div class="vrtl-tl-dot"></div><h3>Метрики для собственника</h3><p>Отчётность по метрикам для собственника.</p></div>
    </div>
  </div>
</section>

<aside class="ym-cta-block ym-cta-block--secondary vrtl-cnt" id="cta-obuchenie" style="max-width:1160px">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
    <p class="ym-cta-block__sub">Перед внедрением полезно разобраться в n8n, промптах, RAG и human-in-the-loop — это ускоряет согласование сценариев с коммерцией и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
  </div>
</aside>

<section class="vrtl-section" id="stek-integracii">
  <div class="vrtl-cnt">
    <div class="vrtl-sh vrtl-left nero-ai-reveal"><span class="vrtl-eyebrow">Интеграции</span><h2>Стек и интеграции</h2><p><strong>Интеграция AI для ритейла</strong> строится на вашей существующей инфраструктуре — AI как надстройка, не замена 1С — для учётного контура см. <a href="/ai-1c-erp/" style="color:var(--vrtl-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента для 1С и ERP под ключ</a>.</p></div>
    <div class="vrtl-grid-2 nero-ai-reveal" style="margin-top:28px">
      <div class="vrtl-card"><h3>CRM, кассы, ERP, склад</h3><ul><li><strong>Учёт:</strong> 1С:УТ, 1С:Розница, МойСклад</li><li><strong>CRM:</strong> RetailCRM, amoCRM, Bitrix24</li><li><strong>Кассы и офлайн:</strong> выгрузка продаж в единый слой</li><li><strong>Склад:</strong> остатки, партии, сроки годности</li></ul></div>
      <div class="vrtl-card"><h3>AI-агенты и нейросети</h3><ul><li><strong>LLM:</strong> YandexGPT, GigaChat (РФ-контур)</li><li><strong>Оркестрация:</strong> n8n, Make.com</li><li><strong>ML:</strong> прогноз спроса, динамическое ценообразование</li><li><strong>Опционально:</strong> computer vision для полки</li></ul></div>
    </div>
    <div class="vrtl-card nero-ai-reveal nero-ai-delay-1" style="margin-top:20px"><h3>Безопасность данных и SLA</h3><p>Данные клиентов — в контуре, согласованном с 152-ФЗ. On-prem или облако с российским провайдером. SLA на время ответа агента, uptime интеграций, регламент эскалации.</p><p><strong>AI для ритейла с CRM</strong> — базовый сценарий: агент читает историю заказов, сегменты, статусы; пишет в карточку клиента итог диалога.</p></div>
  </div>
</section>

<section class="vrtl-section vrtl-section-alt" id="keisy-roi">
  <div class="vrtl-cnt">
    <div class="vrtl-sh nero-ai-reveal"><span class="vrtl-eyebrow">Кейсы</span><h2>Кейсы и ROI внедрения AI в ритейле</h2><p><strong>AI для ритейла кейсы</strong> с верифицируемыми источниками — основа для расчёта ожиданий.</p></div>
    <div class="vrtl-table-wrap nero-ai-reveal">
      <table class="vrtl-table" aria-label="Российские кейсы AI в ритейле">
        <thead><tr><th>Компания</th><th>Сценарий</th><th>Результат</th></tr></thead>
        <tbody>
          <tr><td>X5 Group</td><td>AI Core: прогноз, цены, рекомендации, CV</td><td>5 млрд ₽ доп. прибыли в 2025 (x5.ru)</td></tr>
          <tr><td>«Магнит»</td><td>CV в 430 магазинах, F&amp;R прогноз</td><td>Контроль выкладки, прогноз до 90 дней</td></tr>
          <tr><td>«Конкор-Оптика»</td><td>ИИ «ПРОсковья» + 1С:УТ</td><td>+25% выручки, остатки −50%</td></tr>
          <tr><td>Street Beat</td><td>ИИ «Стас», 76 магазинов</td><td>Ответ 6 мин → 9 сек</td></tr>
          <tr><td>CaseUp (D2C)</td><td>YandexGPT 5 + RetailCRM</td><td>60% тикетов без человека, окупаемость ~4 мес.</td></tr>
        </tbody>
      </table>
    </div>
    <p class="vrtl-disclaimer nero-ai-reveal">Международные ориентиры (Walmart Sparky ~+35% AOV, Lowe's Mylow ×3 конверсия) — верхний ориентир для зрелого omnichannel. Для региональной сети или D2C реалистичнее смотреть на CaseUp и «Конкор».</p>
    <div class="vrtl-card nero-ai-reveal" style="margin-top:24px"><h3>Метрики до/после пилота</h3><ul><li><strong>Конверсия</strong> и средний чек (рекомендации, агент)</li><li><strong>Время первого ответа</strong> (минуты → секунды)</li><li><strong>Доля автоматизации</strong> 1-й линии (50–80%)</li><li><strong>OOS и списания</strong> (прогноз и автозаказ)</li><li><strong>Оборачиваемость</strong> запасов</li></ul><p>Типовые сроки окупаемости: от 4 месяцев (AI-поддержка) до 12–18 месяцев (прогноз на сеть).</p></div>
  </div>
</section>

<section class="vrtl-section" id="stoimost">
  <div class="vrtl-cnt">
    <div class="vrtl-sh nero-ai-reveal"><span class="vrtl-eyebrow">Цена</span><h2>Сколько стоит AI для ритейла</h2><p>Честный ответ: зависит от точек продаж, числа сценариев и глубины интеграций.</p></div>
    <div class="vrtl-grid-2 nero-ai-reveal" style="margin-top:28px">
      <div class="vrtl-card"><h3>Факторы цены</h3><ol style="padding-left:20px;color:var(--vrtl-muted)"><li>Число модулей — чат, прогноз, рекомендации</li><li>Точки продаж и SKU — 1 магазин vs 50 ТЗ</li><li>Интеграции — 1С, CRM, маркетплейсы, мессенджеры</li><li>Контур данных — облако vs on-prem</li><li>Поддержка и дообучение</li></ol></div>
      <div class="vrtl-card"><h3>Ориентир: 300 тыс.–2,5 млн ₽</h3><p>Типовой проект — от <strong>300 000 ₽</strong> (пилот AI-поддержки + CRM) до <strong>2,5 млн ₽</strong> (платформа на сеть). Аудит и Карта AI — отдельная строка, часто засчитывается при подписании договора.</p></div>
    </div>
    <div class="vrtl-table-wrap nero-ai-reveal" style="margin-top:24px">
      <table class="vrtl-table" aria-label="Под ключ vs самостоятельно">
        <thead><tr><th>Критерий</th><th>Под ключ (Nero Network)</th><th>Самостоятельно</th></tr></thead>
        <tbody>
          <tr><td>Срок до результата</td><td>4–6 недель пилот</td><td>3–6 месяцев найм + разработка</td></tr>
          <tr><td>Риск</td><td>Фиксированный пилот с KPI</td><td>Высокий (интеграции, RAG)</td></tr>
          <tr><td>Нужны программисты</td><td>Нет на стороне клиента</td><td>Да, или сильный IT</td></tr>
          <tr><td>Масштаб</td><td>Готовые коннекторы 1С/CRM</td><td>Каждая интеграция с нуля</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="vrtl-section vrtl-section-alt" id="pochemu-nero">
  <div class="vrtl-cnt">
    <div class="vrtl-sh nero-ai-reveal"><span class="vrtl-eyebrow">Интегратор</span><h2>Почему Nero Network</h2><p>Интегратор внедрения AI в бизнес с фокусом на измеримый результат, а не на «презентацию про ИИ».</p></div>
    <div class="vrtl-grid-2 nero-ai-reveal" style="margin-top:28px">
      <div class="vrtl-card"><h3>Опыт AI-агентов</h3><p>Стек, который работает в России: 1С, RetailCRM, YandexGPT, маркетплейсы, n8n. Архитектура enterprise agentic AI — на вашей инфраструктуре.</p></div>
      <div class="vrtl-card"><h3>Прозрачный пилот</h3><ul><li>Аудит и <strong>Карта AI для ритейла</strong> до старта</li><li>Пилот с KPI, не «вечный POC»</li><li>Честное разделение: AI vs люди</li><li>Документация и обучение команды</li></ul></div>
    </div>
  </div>
</section>

<section class="vrtl-section" id="faq">
  <div class="vrtl-cnt">
    <div class="vrtl-sh nero-ai-reveal"><span class="vrtl-eyebrow">FAQ</span><h2>FAQ по внедрению AI в ритейл</h2></div>
    <div class="vrtl-faq nero-ai-reveal">
      <div class="vrtl-faq-item"><div class="vrtl-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли свои разработчики?</div><div class="vrtl-faq-a"><p>Нет, если вы заказываете <strong>внедрение AI для ритейла под ключ</strong>. Нужен владелец процесса со стороны бизнеса и доступ к 1С/CRM.</p></div></div>
      <div class="vrtl-faq-item"><div class="vrtl-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько длится внедрение?</div><div class="vrtl-faq-a"><p>Аудит: 5–7 дней. Пилот: 4–6 недель. Масштабирование: 2–4 месяца. Полная платформа — 4–6 месяцев поэтапно.</p></div></div>
      <div class="vrtl-faq-item"><div class="vrtl-faq-q" role="button" tabindex="0" aria-expanded="false">Какие данные нужны для старта?</div><div class="vrtl-faq-a"><p>История продаж (12+ месяцев), остатки, номенклатура, FAQ, API-доступ к CRM/1С, каналы связи.</p></div></div>
      <div class="vrtl-faq-item"><div class="vrtl-faq-q" role="button" tabindex="0" aria-expanded="false">Как считать ROI?</div><div class="vrtl-faq-a"><p>(экономия ФОТ + прирост маржи от OOS/списаний + прирост выручки от рекомендаций) − стоимость проекта. Фиксируем базовые метрики до запуска.</p></div></div>
      <div class="vrtl-faq-item"><div class="vrtl-faq-q" role="button" tabindex="0" aria-expanded="false">Под ключ или самостоятельно?</div><div class="vrtl-faq-a"><p>Самостоятельно — при сильном in-house IT. Для магазина или D2C без ML-отдела под ключ быстрее выводит на метрики.</p></div></div>
      <div class="vrtl-faq-item"><div class="vrtl-faq-q" role="button" tabindex="0" aria-expanded="false">С чего начать в первую очередь?</div><div class="vrtl-faq-a"><p>Чаще стартуют с <strong>AI-поддержки</strong> (быстрый ROI) или <strong>прогноза спроса</strong> (если боль — OOS и списания).</p></div></div>
      <div class="vrtl-faq-item"><div class="vrtl-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить без остановки продаж?</div><div class="vrtl-faq-a"><p>Пилот на одном канале или категории, параллельная работа старого процесса, постепенное переключение после проверки качества.</p></div></div>
    </div>
  </div>
</section>

<section class="vrtl-section vrtl-section-alt" id="ocenit">
  <div class="vrtl-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-ocenit-final">
      <div class="ym-cta-block__icon" aria-hidden="true">📋</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Оценить AI для ритейла — бесплатно</p>
        <p class="ym-cta-block__sub">Созвон 30–45 минут: разберём процессы, подскажем сценарий пилота и пришлём <strong>Карту AI для ритейла</strong> — матрицу модулей, сроков и ожидаемого эффекта для вашей сети или D2C.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Сначала FAQ</a>
        </div>
      </div>
    </div>
    <p class="nero-ai-reveal" style="text-align:center;margin-top:24px;font-size:15px;color:var(--vrtl-muted)">Nero Network внедряет <strong>искусственный интеллект для ритейл</strong> под ключ: от нейросетей для прогноза спроса до AI-агентов в мессенджерах. Начните с пилота — и масштабируйте то, что измеримо работает.</p>
  </div>
</section>

</div><!-- .vrtl-content -->

<script>
(function(){
  document.querySelectorAll('.vrtl-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vrtl-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vrtl-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vrtl-faq-q');if(q)q.setAttribute('aria-expanded','false');
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
  var root=document.querySelector('.vrtl-content');
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
  var heroItems=document.querySelectorAll('.nero-ai-hero .nero-ai-reveal, .vrai-hero-retail .nero-ai-reveal');
  heroItems.forEach(function(item){item.classList.add('nero-ai-active');});
})();
</script>



<?php
$vrtl_page_url = trailingslashit( get_permalink() );
$vrtl_site_url = trailingslashit( home_url( '/' ) );
$vrtl_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vrtl_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vrtl_site_url . '#organization',
      'name'  => $vrtl_brand,
      'url'   => $vrtl_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vrtl_site_url . '#website',
      'url'       => $vrtl_site_url,
      'name'      => $vrtl_brand,
      'publisher' => [ '@id' => $vrtl_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vrtl_page_url . '#webpage',
      'url'         => $vrtl_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vrtl_site_url . '#website' ],
      'about'       => [ '@id' => $vrtl_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vrtl_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vrtl_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vrtl_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vrtl_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $vrtl_page_url,
      'provider'    => [ '@id' => $vrtl_site_url . '#organization' ],
      'serviceType' => 'Внедрение AI для ритейла',
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vrtl_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Нужны ли свои разработчики?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет, если вы заказываете внедрение AI для ритейла под ключ. Нужен владелец процесса со стороны бизнеса (коммерция, e-com, поддержка) и доступ к 1С/CRM. Техническую часть закрывает интегратор.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько длится внедрение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит: 5–7 дней. Пилот одного модуля: 4–6 недель. Масштабирование на сеть: 2–4 месяца. Полная платформа (прогноз + поддержка + рекомендации + BI) — 4–6 месяцев поэтапно, не «всё сразу».' ] ],
        [ '@type' => 'Question', 'name' => 'Какие данные нужны для старта?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'История продаж (желательно 12+ месяцев), остатки, номенклатура, цены, FAQ и регламенты доставки/возврата, API-доступ к CRM/1С (read + ограниченный write для статусов), каналы связи (виджет, мессенджеры).' ] ],
        [ '@type' => 'Question', 'name' => 'Как считать ROI?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Формула пилота: (экономия ФОТ 1-й линии + прирост маржи от снижения списаний/OOS + прирост выручки от рекомендаций) − стоимость проекта и поддержки. Фиксируем базовые метрики до запуска и сравниваем через 4–8 недель. Международные ×3 конверсии — ориентир, не гарантия.' ] ],
        [ '@type' => 'Question', 'name' => 'AI для ритейла под ключ или самостоятельно?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Самостоятельно имеет смысл при сильном in-house IT и ML-компетенции (как X5 Tech). Для магазина, сети или D2C без ML-отдела под ключ быстрее выводит на метрики: готовые коннекторы, отработанные регламенты RAG и handoff.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие задачи решает AI для ритейла в первую очередь?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Чаще всего стартуют с AI-поддержки (быстрый эффект, понятный ROI) или прогноза спроса (если боль — OOS и списания). Рекомендации и аналитика — второй этап после единого слоя данных.' ] ],
        [ '@type' => 'Question', 'name' => 'Как внедрить AI для ритейла без остановки продаж?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пилот на одном канале или категории, параллельная работа старого процесса, постепенное переключение трафика после проверки качества ответов агента.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vrtl_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>
</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>

