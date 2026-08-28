<?php
/**
 * Template Name: AI-проверка юридических рисков в переписке: внедрение под ключ
 * Description: SEO-лендинг — pre-send AI compliance для исходящей переписки. Кейсы, интеграции, 152-ФЗ.
 */

$page_seo_title       = 'AI-проверка юридических рисков в переписке — внедрение под ключ';
$page_seo_description = 'Внедряем AI-модуль контроля исходящей переписки: подсвечивает рискованные обещания в письмах и чатах и предлагает безопасную формулировку до отправки клиенту. Интеграция с CRM, почтой и мессенджерами.';

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

$nero_ai_header_links = [
	[ 'label' => 'Как работает', 'href' => '#kak-rabotaet' ],
	[ 'label' => 'Чек-лист', 'href' => '#checklist' ],
	[ 'label' => 'Этапы', 'href' => '#etapy' ],
	[ 'label' => 'Интеграции', 'href' => '#integracii' ],
	[ 'label' => 'Безопасность', 'href' => '#compliance' ],
	[ 'label' => 'Стоимость', 'href' => '#stoimost' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Проверить переписку';
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '#';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if ( ! is_readable( $nero_ai_floating ) ) {
	require dirname( __DIR__ ) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
	require $nero_ai_floating;
}

?>

<?php nero_ai_echo_theme_styles( [ 'nero-ai-longread-ui-compat.css' ] ); ?>

<style>
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

/* ── Hero vyrip-compliance (Алина) ── */
.vyrip-hero-compliance{--vyrip-cyan:#79f2ff;--vyrip-violet:#8b5cf6;--vyrip-risk:#f87171;--vyrip-safe:#22c55e;--vyrip-warn:#fbbf24;--vyrip-text:#e6edf7;--vyrip-muted:#9aa8bd;--vyrip-soft:#c7d2e5;--vyrip-shadow:0 28px 90px rgba(0,0,0,.42)}
.vyrip-hero-compliance.nero-ai-hero{position:relative;min-height:min(980px,calc(100dvh - 1px));display:grid;align-items:center;padding:clamp(72px,9vw,132px) 0 clamp(44px,7vw,86px);isolation:isolate}
.vyrip-hero-compliance::before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.035) 1px,transparent 1px);background-size:64px 64px;mask-image:radial-gradient(circle at 45% 30%,#000 0%,transparent 72%);opacity:.55;pointer-events:none;z-index:-3}
.vyrip-hero-compliance::after{content:"";position:absolute;left:50%;top:16%;width:820px;height:820px;transform:translateX(-50%);border-radius:999px;background:radial-gradient(circle at 30% 40%,rgba(248,113,113,.05),transparent 55%),radial-gradient(circle,rgba(121,242,255,.12),transparent 66%);filter:blur(6px);animation:vyripHeroGlow 8s ease-in-out infinite alternate;z-index:-2;pointer-events:none}
@keyframes vyripHeroGlow{from{opacity:.45;transform:translateX(-50%) scale(.96)}to{opacity:.86;transform:translateX(-50%) scale(1.06)}}
.vyrip-hero-compliance .nero-ai-container{width:min(1220px,calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vyrip-hero-compliance .nero-ai-hero-grid{display:grid;grid-template-columns:minmax(0,1.02fr) minmax(360px,.98fr);gap:clamp(28px,4vw,56px);align-items:center}
.vyrip-hero-compliance .nero-ai-hero-copy h1{margin:0;max-width:780px;font-size:clamp(38px,5.8vw,72px);line-height:.95;letter-spacing:-.065em;color:#fff;font-weight:900}
.vyrip-hero-compliance .nero-ai-gradient-text{background:linear-gradient(92deg,#fff 0%,var(--vyrip-cyan) 44%,#c4b5fd 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vyrip-hero-compliance .nero-ai-eyebrow{display:inline-flex;align-items:center;gap:8px;margin:0 0 16px;padding:8px 12px;border:1px solid rgba(121,242,255,.2);border-radius:999px;background:rgba(121,242,255,.08);color:var(--vyrip-cyan)!important;font-size:13px;font-weight:750;line-height:1;text-transform:uppercase;letter-spacing:.11em}
.vyrip-hero-compliance .nero-ai-hero-lead{margin:24px 0 0;max-width:720px;color:var(--vyrip-soft)!important;font-size:clamp(17px,1.9vw,21px);line-height:1.58}
.vyrip-hero-compliance .nero-ai-badges{display:flex;flex-wrap:wrap;gap:10px;margin:26px 0 0;padding:0;list-style:none}
.vyrip-hero-compliance .nero-ai-badge{display:inline-flex;align-items:center;gap:7px;padding:8px 11px;border:1px solid rgba(255,255,255,.11);border-radius:999px;background:rgba(255,255,255,.055);color:#dce8f7;font-size:13px;font-weight:700}
.vyrip-hero-compliance .nero-ai-btn-row{display:flex;flex-wrap:wrap;gap:14px;align-items:center;margin-top:34px}
.vyrip-hero-compliance .nero-ai-btn{display:inline-flex;align-items:center;justify-content:center;min-height:48px;padding:14px 20px;border-radius:999px;border:1px solid transparent;font-size:15px;font-weight:800;line-height:1;text-decoration:none!important;transition:transform .22s ease,border-color .22s ease,background .22s ease}
.vyrip-hero-compliance .nero-ai-btn:hover{transform:translateY(-2px)}
.vyrip-hero-compliance .nero-ai-btn-primary{color:#031018!important;background:linear-gradient(135deg,var(--vyrip-cyan),#a7f3d0);box-shadow:0 18px 42px rgba(121,242,255,.22)}
.vyrip-hero-compliance .nero-ai-btn-secondary{color:var(--vyrip-text)!important;background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.14)}
.vyrip-hero-compliance .nero-ai-dashboard{position:relative;padding:18px;border-radius:34px;background:rgba(2,6,23,.42);box-shadow:var(--vyrip-shadow);transform:perspective(1100px) rotateY(-3deg) rotateX(2deg)}
.vyrip-hero-compliance .nero-ai-dashboard-shell{overflow:hidden;border:1px solid rgba(255,255,255,.12);border-radius:26px;background:linear-gradient(180deg,rgba(15,23,42,.95),rgba(6,10,24,.96))}
.vyrip-hero-compliance .nero-ai-window-top{display:flex;align-items:center;justify-content:space-between;gap:14px;padding:14px 16px;border-bottom:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.045)}
.vyrip-hero-compliance .nero-ai-dots{display:flex;gap:7px}
.vyrip-hero-compliance .nero-ai-dot{width:10px;height:10px;border-radius:50%}
.vyrip-hero-compliance .nero-ai-dot:nth-child(1){background:#fb7185}
.vyrip-hero-compliance .nero-ai-dot:nth-child(2){background:#fbbf24}
.vyrip-hero-compliance .nero-ai-dot:nth-child(3){background:#34d399}
.vyrip-hero-compliance .nero-ai-window-title{color:#cfe3f9;font-size:11px;font-weight:750;letter-spacing:.08em;text-transform:uppercase}
.vyrip-hero-compliance .nero-ai-window-body{padding:16px}
.vyrip-hero-compliance .nero-ai-dashboard-title{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:12px}
.vyrip-hero-compliance .nero-ai-dashboard-title h3{margin:0;font-size:18px;letter-spacing:-.03em;color:#fff}
.vyrip-hero-compliance .nero-ai-live-pill{display:inline-flex;align-items:center;gap:7px;padding:6px 9px;border-radius:999px;background:rgba(34,197,94,.1);color:#bbf7d0;font-size:12px;font-weight:800}
.vyrip-hero-compliance .nero-ai-live-pill::before{content:"";width:7px;height:7px;border-radius:50%;background:#22c55e;box-shadow:0 0 0 6px rgba(34,197,94,.14);animation:vyripPulse 1.6s infinite}
@keyframes vyripPulse{0%,100%{transform:scale(.86);opacity:.65}50%{transform:scale(1);opacity:1}}
.vyrip-hero-compliance .nero-ai-metrics-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;margin-bottom:12px}
.vyrip-hero-compliance .nero-ai-metric{padding:12px;border:1px solid rgba(255,255,255,.09);border-radius:16px;background:rgba(255,255,255,.055)}
.vyrip-hero-compliance .nero-ai-metric span{display:block;color:var(--vyrip-muted);font-size:11px;font-weight:700}
.vyrip-hero-compliance .nero-ai-metric strong{display:block;margin-top:5px;color:#fff;font-size:22px;line-height:1}
.vyrip-hero-compliance .nero-ai-metric small{display:block;margin-top:4px;color:#9fb0c9;font-size:11px}
.vyrip-hero-compliance .vyrip-dash-canvas-wrap{position:relative;height:clamp(220px,32vw,300px);margin:0 0 12px;border-radius:18px;overflow:hidden;border:1px solid rgba(121,242,255,.14);background:radial-gradient(ellipse at 18% 50%,rgba(248,113,113,.06),transparent 45%),radial-gradient(ellipse at 50% 40%,rgba(121,242,255,.08),rgba(6,10,24,.9) 70%)}
.vyrip-hero-compliance #vyrip-compliance-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
.vyrip-hero-compliance .nero-ai-task-stream{display:grid;gap:8px}
.vyrip-hero-compliance .nero-ai-task{display:grid;grid-template-columns:28px 1fr auto;align-items:center;gap:10px;padding:10px;border:1px solid rgba(255,255,255,.08);border-radius:14px;background:rgba(255,255,255,.04)}
.vyrip-hero-compliance .nero-ai-task-icon{display:grid;place-items:center;width:28px;height:28px;border-radius:12px;background:rgba(121,242,255,.12);color:var(--vyrip-cyan);font-size:13px;font-weight:800}
.vyrip-hero-compliance .nero-ai-task strong{display:block;color:#f8fafc;font-size:12px}
.vyrip-hero-compliance .nero-ai-task span{color:var(--vyrip-muted);font-size:11px}
.vyrip-hero-compliance .nero-ai-status{padding:4px 8px;border-radius:999px;background:rgba(34,197,94,.11);color:#bbf7d0;font-size:10px;font-weight:800;white-space:nowrap}
.vyrip-hero-compliance .nero-ai-status--risk{background:rgba(248,113,113,.14);color:#fecaca}
.vyrip-hero-compliance .nero-ai-status--amber{background:rgba(251,191,36,.12);color:#fde68a}
@media(max-width:1100px){.vyrip-hero-compliance .nero-ai-hero-grid{grid-template-columns:1fr}.vyrip-hero-compliance .nero-ai-dashboard{transform:none}}
@media(max-width:520px){.vyrip-hero-compliance .nero-ai-dashboard{padding:10px;border-radius:24px}.vyrip-hero-compliance .nero-ai-window-body{padding:12px}.vyrip-hero-compliance .nero-ai-task{grid-template-columns:28px 1fr}.vyrip-hero-compliance .nero-ai-status{grid-column:2;width:fit-content}}
@media(prefers-reduced-motion:reduce){.vyrip-hero-compliance::after,.vyrip-hero-compliance .nero-ai-live-pill::before{animation:none}}

.vyrip-content{
  --vyrip-cyan:#79f2ff;--vyrip-violet:#8b5cf6;--vyrip-risk:#f87171;--vyrip-safe:#22c55e;--vyrip-warn:#fbbf24;
  --vyrip-text:#e6edf7;--vyrip-muted:#9aa8bd;--vyrip-soft:#c7d2e5;--vyrip-heading:#fff;
  --vyrip-border:rgba(255,255,255,.10);--vyrip-btn-from:#2563eb;--vyrip-btn-to:#7c3aed;--vyrip-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vyrip-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vyrip-content *,.vyrip-content *::before,.vyrip-content *::after{box-sizing:border-box}
.vyrip-content a{color:inherit}
.vyrip-content p{color:var(--vyrip-muted);line-height:1.72;margin:0 0 1em}
.vyrip-content p:last-child{margin-bottom:0}
.vyrip-content h2,.vyrip-content h3,.vyrip-content h4{color:var(--vyrip-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vyrip-content strong{color:var(--vyrip-soft)}
.vyrip-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vyrip-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vyrip-muted);font-size:14.5px;line-height:1.65}
.vyrip-content ul li::before{content:'›';position:absolute;left:0;color:var(--vyrip-cyan);font-weight:700}
.vyrip-cnt{width:min(var(--vyrip-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vyrip-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vyrip-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vyrip-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vyrip-sh.vyrip-left{margin-left:0;text-align:left}
.vyrip-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vyrip-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vyrip-sh.vyrip-left p{margin-left:0}
.vyrip-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vyrip-cyan);margin-bottom:14px}
.vyrip-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vyrip-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vyrip-intro-text{position:relative;padding-left:20px;max-width:none}
.vyrip-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vyrip-cyan),var(--vyrip-violet))}
.vyrip-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.vyrip-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vyrip-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vyrip-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vyrip-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vyrip-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vyrip-muted);line-height:1.4}
.vyrip-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vyrip-intro-grid{grid-template-columns:1fr;gap:36px}.vyrip-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vyrip-intro-kpi{grid-template-columns:1fr 1fr}}
.vyrip-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vyrip-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vyrip-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid var(--vyrip-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vyrip-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vyrip-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vyrip-cyan);background:rgba(121,242,255,.08)}
.vyrip-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vyrip-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22)}
.vyrip-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vyrip-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vyrip-grid-2,.vyrip-grid-3{grid-template-columns:1fr}}
.vyrip-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vyrip-table{width:100%;border-collapse:collapse;font-size:14px}
.vyrip-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vyrip-cyan);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vyrip-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vyrip-text);vertical-align:top}
.vyrip-table tr:last-child td{border-bottom:none}
.vyrip-table tr:hover td{background:rgba(255,255,255,.03)}
.vyrip-table .vyrip-row-nero td{background:rgba(121,242,255,.1)!important;font-weight:700}
.vyrip-table .vyrip-col-risk{border-left:3px solid var(--vyrip-risk);background:rgba(248,113,113,.08)}
.vyrip-table .vyrip-col-safe{border-left:3px solid var(--vyrip-safe);background:rgba(34,197,94,.08)}
.vyrip-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vyrip-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vyrip-cyan);border:1px solid rgba(121,242,255,.2)}
.vyrip-flow .arr{color:var(--vyrip-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vyrip-timeline{position:relative;padding-left:40px}
.vyrip-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vyrip-cyan),var(--vyrip-violet));opacity:.35;border-radius:2px}
.vyrip-tl-item{position:relative;margin-bottom:32px}
.vyrip-tl-item:last-child{margin-bottom:0}
.vyrip-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vyrip-cyan);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vyrip-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vyrip-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vyrip-case-grid{grid-template-columns:1fr}}
.vyrip-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.vyrip-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vyrip-safe);margin-bottom:10px}
.vyrip-legal-quote{border-left:3px solid var(--vyrip-cyan);padding:18px 24px;margin:28px 0;background:rgba(121,242,255,.06);border-radius:0 14px 14px 0;font-style:italic;color:var(--vyrip-soft)}
.vyrip-stat-card{text-align:center;padding:40px 32px;border-radius:24px;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.12));border:1px solid rgba(121,242,255,.25);margin:32px 0}
.vyrip-stat-card .num{font-size:clamp(48px,8vw,72px);font-weight:900;color:#fff;line-height:1;margin-bottom:8px}
.vyrip-stat-card .lbl{font-size:16px;color:var(--vyrip-muted)}
.vyrip-price-pill{display:inline-flex;padding:8px 18px;border-radius:999px;background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.35);color:var(--vyrip-safe);font-weight:800;font-size:15px;margin-left:12px;vertical-align:middle}
.vyrip-badge-lm{display:inline-flex;margin-left:10px;padding:4px 12px;border-radius:999px;background:rgba(248,113,113,.12);border:1px solid rgba(248,113,113,.3);color:var(--vyrip-risk);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;vertical-align:middle}
.vyrip-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vyrip-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vyrip-faq-item summary{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vyrip-heading);cursor:pointer;list-style:none;display:flex;align-items:center;justify-content:space-between;gap:16px}
.vyrip-faq-item summary::-webkit-details-marker{display:none}
.vyrip-faq-item summary::after{content:'▾';font-size:13px;color:var(--vyrip-cyan);flex-shrink:0;transition:transform .25s}
.vyrip-faq-item[open] summary::after{transform:rotate(180deg)}
.vyrip-faq-a{padding:0 24px 20px;font-size:14.5px;color:var(--vyrip-muted);line-height:1.72}
.vyrip-pre{background:rgba(0,0,0,.35);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;overflow-x:auto;font-size:12px;line-height:1.6;color:var(--vyrip-soft);margin:24px 0}
.vyrip-badge-pre{display:inline-flex;padding:4px 10px;border-radius:6px;background:rgba(34,197,94,.15);color:var(--vyrip-safe);font-size:11px;font-weight:700;margin-left:6px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vyrip-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vyrip-cyan)!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
@media(prefers-reduced-motion:reduce){.nero-ai-reveal{opacity:1;transform:none;transition:none}}

/* === БОРИС: prefix bvr-, scoped #vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block === */
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block.bvr-root{padding:48px 0 56px;background:#f8fafc}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-card{display:grid;grid-template-columns:minmax(0,44%) minmax(0,56%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:500px}
@media(max-width:1023px){#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-card{grid-template-columns:1fr;min-height:auto}}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0}
@media(max-width:1023px){#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#dc2626;margin:0 0 14px}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-ey::before{content:'';width:18px;height:2px;background:#dc2626;border-radius:1px}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-style:normal;font-weight:700}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-ic-r{background:rgba(248,113,113,.12);color:#dc2626}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-ic-s{background:rgba(34,197,94,.12);color:#15803d}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-ic-w{background:rgba(251,191,36,.15);color:#b45309}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-pl-r{background:rgba(248,113,113,.1);color:#b91c1c;border:1.5px solid rgba(248,113,113,.25)}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-pl-s{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-pl-w{background:rgba(251,191,36,.1);color:#b45309;border:1.5px solid rgba(251,191,36,.28)}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-rgt{position:relative;background:linear-gradient(145deg,#fef2f2 0%,#f0fdf4 55%,#f8fafc 100%);min-height:440px;overflow:hidden}
@media(max-width:1023px){#vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block .bvr-rgt{min-height:360px}}
#bvr-risk-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-yuridicheskie-riski-perepiski-page" role="main" tabindex="-1">

<section class="nero-ai-hero vyrip-hero-compliance" id="vyrip-hero" aria-labelledby="vyrip-hero-title">
<div class="nero-ai-container nero-ai-hero-grid">
  <div class="nero-ai-hero-copy">
    <p class="nero-ai-eyebrow">Право / compliance · внедрение под ключ</p>
    <h1 id="vyrip-hero-title">AI-проверка юридических рисков в переписке: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
    <p class="nero-ai-hero-lead">Нейросеть подсвечивает рискованные обещания в письмах и чатах и предлагает безопасную формулировку — до отправки клиенту</p>
    <ul class="nero-ai-badges" aria-label="Ключевые возможности">
      <li class="nero-ai-badge">Pre-send</li>
      <li class="nero-ai-badge">Юристы</li>
      <li class="nero-ai-badge">Продажи</li>
      <li class="nero-ai-badge">Поддержка</li>
      <li class="nero-ai-badge">152-ФЗ</li>
      <li class="nero-ai-badge">Human-in-the-loop</li>
    </ul>
    <div class="nero-ai-btn-row">
      <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url( $primary_cta_url ); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ?: ( getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Проверить переписку' ) ); ?></a>
      <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
    </div>
  </div>

  <div class="nero-ai-dashboard" aria-label="Демонстрация pre-send compliance">
    <div class="nero-ai-dashboard-shell">
      <div class="nero-ai-window-top">
        <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
        <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
      </div>
      <div class="nero-ai-window-body">
        <div class="nero-ai-dashboard-title">
          <h3>Compliance pre-send · демо</h3>
          <span class="nero-ai-live-pill">live</span>
        </div>
        <div class="nero-ai-metrics-grid">
          <div class="nero-ai-metric">
            <span>Рисков сегодня</span>
            <strong>12</strong>
            <small>исходящие письма/чаты</small>
          </div>
          <div class="nero-ai-metric">
            <span>Перехвачено до отправки</span>
            <strong>9</strong>
            <small>pre-send warn</small>
          </div>
          <div class="nero-ai-metric">
            <span>Safe rewrite принято</span>
            <strong>7</strong>
            <small>менеджером</small>
          </div>
          <div class="nero-ai-metric">
            <span>Эскалаций юристу</span>
            <strong>2</strong>
            <small>high-risk</small>
          </div>
        </div>

        <div class="vyrip-dash-canvas-wrap" aria-hidden="false">
          <canvas id="vyrip-compliance-canvas" role="img" aria-label="Анимация: исходящее письмо проверяется на юридические риски, AI предлагает безопасную формулировку до отправки"></canvas>
        </div>

        <div class="nero-ai-task-stream" aria-label="Лента событий compliance">
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">✉</span>
            <div><strong>«Гарантируем результат»</strong><span>Категория: заверение</span></div>
            <span class="nero-ai-status nero-ai-status--risk">risk</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">↻</span>
            <div><strong>Safe rewrite предложен</strong><span>«в рамках договора №…»</span></div>
            <span class="nero-ai-status">готово</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">⚠</span>
            <div><strong>CRM-чат: «компенсируем убытки»</strong><span>Эскалация юристу</span></div>
            <span class="nero-ai-status nero-ai-status--amber">review</span>
          </div>
          <div class="nero-ai-task">
            <span class="nero-ai-task-icon">✓</span>
            <div><strong>Письмо отправлено</strong><span>Рисков нет</span></div>
            <span class="nero-ai-status">готово</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<div class="vyrip-content">

  <section class="vyrip-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vyrip-cnt">
      <div class="vyrip-intro-grid nero-ai-reveal">
        <div class="vyrip-intro-text">
          <p class="vyrip-eyebrow">Лонгрид · pre-send compliance</p>
          <p><strong>Коротко:</strong> AI-проверка юридических рисков в переписке — модуль, который анализирует исходящие письма и чаты сотрудников <strong>до отправки</strong> клиенту, подсвечивает обещания, гарантии и рискованные формулировки и предлагает безопасную замену. Nero Network внедряет такой контур под ключ: от аудита каналов до интеграции с CRM, почтой и мессенджерами.</p>
          <p><strong>Итог:</strong> ai проверка переписки снижает вероятность того, что обещание уйдёт клиенту без осознанного решения бизнеса — human-in-the-loop и эскалация юристу для high-risk.</p>
        </div>
        <div class="vyrip-intro-kpi" aria-label="Ключевые метрики pre-send compliance">
          <div class="vyrip-kpi-card">
            <div class="kv">Pre-send</div>
            <div class="kl">контроль до отправки</div>
            <div class="ks">не post-hoc DLP</div>
          </div>
          <div class="vyrip-kpi-card">
            <div class="kv">12</div>
            <div class="kl">рисков в день</div>
            <div class="ks">демо-данные</div>
          </div>
          <div class="vyrip-kpi-card">
            <div class="kv">9/12</div>
            <div class="kl">перехвачено</div>
            <div class="ks">warn до клика</div>
          </div>
          <div class="vyrip-kpi-card">
            <div class="kv">152-ФЗ</div>
            <div class="kl">контур данных</div>
            <div class="ks">on-prem опция</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="vyrip-toc-outer">
    <div class="vyrip-cnt">
      <nav class="vyrip-toc" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#checklist">Чек-лист</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#compliance">Безопасность</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-final">Проверить переписку</a>
      </nav>
    </div>
  </div>

  <section class="vyrip-section" id="problema">
    <div class="vyrip-cnt">
      <div class="vyrip-sh vyrip-left nero-ai-reveal">
        <span class="vyrip-eyebrow">Боль бизнеса</span>
        <h2>Проблема: сотрудники создают юридические риски в переписке</h2>
        <p>Менеджер пишет «гарантируем», «точно будет завтра», «компенсируем» — клиент фиксирует обещание. Юротдел узнаёт <strong>после</strong> претензии или суда.</p>
      </div>
      <blockquote class="vyrip-legal-quote nero-ai-reveal">
        Арбитражный суд Московского округа в деле № А40-93872/2019 признал переписку в Telegram доказательством условий сделки. В деле А35-10124/2023 ненадлежащее оказание услуг доказано перепиской в мессенджере — возврат 1,8 млн ₽.
      </blockquote>
      <div class="vyrip-grid-3 nero-ai-reveal">
        <div class="vyrip-card">
          <h3>Гарантии и сроки в письмах</h3>
          <p>«Гарантируем результат», «100% одобрение», «завтра точно» без отсылки к договору — заверения об обстоятельствах (ст. 431.2 ГК РФ) или акцепт условий.</p>
        </div>
        <div class="vyrip-card">
          <h3>Компенсации и off-label обещания</h3>
          <p>«Компенсируем убытки», «скидка 20%» без полномочий, обещание функций вне ТЗ — финансовый и договорный риск.</p>
        </div>
        <div class="vyrip-card">
          <h3>Персональные данные в чатах</h3>
          <p>Пересылка ПДн, «передали партнёру» — зона 152-ФЗ. С 30.05.2025 оборотные штрафы до 500 млн ₽ при повторной утечке.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vyrip-section vyrip-section-alt" id="kak-rabotaet">
    <div class="vyrip-cnt">
      <div class="vyrip-sh nero-ai-reveal">
        <span class="vyrip-eyebrow">Продукт</span>
        <h2>Что такое AI-проверка и как работает модуль</h2>
        <p><strong>Preventive compliance layer</strong> — слой контроля в момент написания исходящего сообщения. Не post-hoc DLP и не «чат-бот для юристов».</p>
      </div>
      <div class="vyrip-flow nero-ai-reveal" aria-label="Схема pre-send compliance">
        <span>Письмо / чат</span><span class="arr">→</span>
        <span>Policy Engine</span><span class="arr">→</span>
        <span>LLM-анализ</span><span class="arr">→</span>
        <span>Safe rewrite / эскалация</span><span class="arr">→</span>
        <span>Отправка + аудит</span>
      </div>
      <div class="vyrip-pre nero-ai-reveal" aria-label="Архитектура модуля">[Почта / CRM-чат / мессенджер]
        ↓
[Middleware: текст + метаданные]
        ↓
[Policy Engine + чек-лист рисков]
        ↓
[LLM: YandexGPT / GigaChat / on-prem]
        ↓
[Результат: risk_score, safe_rewrite, allow / warn / block / escalate]</div>
      <div class="vyrip-grid-3 nero-ai-reveal" style="margin-top:32px">
        <div class="vyrip-card"><h3>Подсветка рисков</h3><p>Гарантии, сроки, компенсации, ПДн, акцепты в мессенджере — категории с warn или block.</p></div>
        <div class="vyrip-card"><h3>Safe Rewrite</h3><p>Формулировка с отсылкой к договору, регламенту или SLA вместо безусловного обещания.</p></div>
        <div class="vyrip-card"><h3>Human-in-the-loop</h3><p>High-risk → эскалация юристу. Финальное решение за человеком (ст. 16 152-ФЗ).</p></div>
      </div>
    </div>

    <section id="vnedrenie-ai-yuridicheskie-riski-perepiski-boris-block" class="bvr-root" aria-label="Анимация: путь рискованной формулировки через pre-send compliance к safe rewrite или юристу">
      <div class="bvr-cnt">
        <div class="bvr-card">
          <div class="bvr-lft">
            <span class="bvr-ey">Мост эскалации · pre-send</span>
            <h3 class="bvr-h3">От «гарантируем» до безопасной отправки — до клика «Отправить»</h3>
            <ul class="bvr-ul">
              <li><span class="bvr-ic bvr-ic-r">!</span>AI подсвечивает заверение об обстоятельствах в черновике письма</li>
              <li><span class="bvr-ic bvr-ic-s">✓</span>Safe Rewrite предлагает формулировку по договору № …</li>
              <li><span class="bvr-ic bvr-ic-w">⚖</span>High-risk «компенсируем» — маршрут в очередь юриста</li>
              <li><span class="bvr-ic bvr-ic-s">📋</span>Событие логируется для аудита и governance AI</li>
            </ul>
            <div class="bvr-pills">
              <span class="bvr-pl bvr-pl-r">заверение · risk</span>
              <span class="bvr-pl bvr-pl-s">safe rewrite</span>
              <span class="bvr-pl bvr-pl-w">эскалация юристу</span>
            </div>
            <p class="bvr-foot">Дальше — чек-лист опасных формулировок и этапы внедрения →</p>
          </div>
          <div class="bvr-rgt">
            <canvas id="bvr-risk-pipeline-canvas" role="img" aria-label="Анимация: рискованная фраза в черновике проходит policy-сканер, ветвится на safe rewrite или эскалацию юристу"></canvas>
          </div>
        </div>
      </div>
      <script>
      (function(){
        'use strict';
        var cv = document.getElementById('bvr-risk-pipeline-canvas');
        if (!cv) return;
        var ctx = cv.getContext('2d');
        var W = 0, H = 0, frame = 0, phase = 0;

        function resize(){
          var p = cv.parentElement;
          if (!p) return;
          cv.width = p.clientWidth || 640;
          cv.height = p.clientHeight || 480;
          W = cv.width; H = cv.height;
        }
        window.addEventListener('resize', resize);
        resize();

        var C = {
          ink:'#0f172a', muted:'#64748b', risk:'#ef4444', riskBg:'rgba(239,68,68,.12)',
          safe:'#16a34a', safeBg:'rgba(22,163,74,.12)', warn:'#d97706', warnBg:'rgba(217,119,6,.12)',
          scan:'#8b5cf6', line:'rgba(139,92,246,.35)', bubble:'#fff', bubbleBdr:'#cbd5e1'
        };

        function rr(x,y,w,h,r,fill,stroke){
          ctx.beginPath();
          if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
          else ctx.rect(x,y,w,h);
          if (fill){ ctx.fillStyle=fill; ctx.fill(); }
          if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
        }

        function drawDraft(x,y,w,h,highlightAlpha){
          rr(x,y,w,h,12,C.bubble,C.bubbleBdr);
          ctx.fillStyle = C.muted;
          ctx.font = '10px system-ui,sans-serif';
          ctx.textAlign = 'left';
          ctx.fillText('Кому: client@company.ru', x+14, y+22);
          ctx.fillStyle = C.ink;
          ctx.font = '11px system-ui,sans-serif';
          ctx.fillText('Добрый день! ', x+14, y+44);
          var riskX = x+14 + ctx.measureText('Добрый день! ').width;
          var riskW = ctx.measureText('гарантируем результат').width + 8;
          ctx.fillStyle = 'rgba(239,68,68,' + (0.15 + highlightAlpha*0.25) + ')';
          rr(riskX-4, y+32, riskW, 18, 4, 'rgba(239,68,68,' + (0.12+highlightAlpha*0.2) + ')', C.risk);
          ctx.fillStyle = C.risk;
          ctx.font = 'bold 11px system-ui,sans-serif';
          ctx.fillText('гарантируем результат', riskX, y+44);
          ctx.fillStyle = C.muted;
          ctx.font = '11px system-ui,sans-serif';
          ctx.fillText('к сроку поставки.', x+14, y+62);
        }

        function drawScanner(cx, cy, r, pulse){
          var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
          g.addColorStop(0,'rgba(139,92,246,.2)');
          g.addColorStop(1,'rgba(139,92,246,0)');
          ctx.fillStyle = g;
          ctx.beginPath();
          ctx.arc(cx,cy,r*1.8,0,Math.PI*2);
          ctx.fill();
          rr(cx-r,cy-r,r*2,r*2,r*0.4,'#f5f3ff',C.scan);
          ctx.fillStyle = C.scan;
          ctx.font = 'bold ' + Math.max(10,r*0.28) + 'px system-ui,sans-serif';
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          ctx.fillText('Policy', cx, cy-4);
          ctx.font = Math.max(8,r*0.18) + 'px system-ui,sans-serif';
          ctx.fillStyle = C.muted;
          ctx.fillText('сканер', cx, cy+r*0.35);
          ctx.strokeStyle = C.scan;
          ctx.lineWidth = 2 + pulse*2;
          ctx.globalAlpha = 0.25 + pulse*0.35;
          ctx.beginPath();
          ctx.arc(cx,cy,r+8+pulse*6,0,Math.PI*2);
          ctx.stroke();
          ctx.globalAlpha = 1;
        }

        function drawSafeBubble(x,y,alpha){
          if (alpha < 0.05) return;
          ctx.globalAlpha = alpha;
          rr(x,y, W*0.28, H*0.14, 10, C.safeBg, C.safe);
          ctx.fillStyle = C.safe;
          ctx.font = 'bold 10px system-ui,sans-serif';
          ctx.textAlign = 'left';
          ctx.fillText('Safe rewrite', x+12, y+18);
          ctx.fillStyle = C.ink;
          ctx.font = '9px system-ui,sans-serif';
          ctx.fillText('в рамках договора №…', x+12, y+34);
          ctx.fillText('раздел условий поставки', x+12, y+48);
          ctx.globalAlpha = 1;
        }

        function drawLawyerQueue(x,y,alpha){
          if (alpha < 0.05) return;
          ctx.globalAlpha = alpha;
          rr(x,y, W*0.24, H*0.12, 10, C.warnBg, C.warn);
          ctx.fillStyle = C.warn;
          ctx.font = 'bold 10px system-ui,sans-serif';
          ctx.textAlign = 'left';
          ctx.fillText('⚖ Юрист', x+12, y+20);
          ctx.fillStyle = C.ink;
          ctx.font = '9px system-ui,sans-serif';
          ctx.fillText('компенсация · review', x+12, y+36);
          ctx.globalAlpha = 1;
        }

        function tick(){
          frame++;
          phase = (frame % 480) / 480;
          ctx.clearRect(0,0,W,H);

          var draftX = W*0.06, draftY = H*0.18, draftW = W*0.34, draftH = H*0.28;
          var scanX = W*0.48, scanY = H*0.42, scanR = Math.min(W,H)*0.08;
          var pulse = 0.5 + 0.5*Math.sin(frame*0.07);
          var hi = phase < 0.35 ? Math.sin(frame*0.12)*0.5+0.5 : 0.3;

          drawDraft(draftX, draftY, draftW, draftH, hi);
          drawScanner(scanX, scanY, scanR, pulse);

          ctx.strokeStyle = C.line;
          ctx.lineWidth = 2;
          ctx.setLineDash([5,4]);
          ctx.beginPath();
          ctx.moveTo(draftX + draftW, draftY + draftH*0.5);
          ctx.lineTo(scanX - scanR - 6, scanY);
          ctx.stroke();
          ctx.setLineDash([]);

          var safeA = 0, lawA = 0;
          if (phase > 0.28 && phase < 0.72){
            safeA = Math.min(1, (phase-0.28)*4);
            var sx = W*0.62 + Math.sin(frame*0.04)*4;
            var sy = H*0.12;
            drawSafeBubble(sx, sy, safeA);
            ctx.strokeStyle = 'rgba(22,163,74,.4)';
            ctx.lineWidth = 1.5;
            ctx.beginPath();
            ctx.moveTo(scanX, scanY - scanR);
            ctx.lineTo(sx + W*0.14, sy + H*0.14);
            ctx.stroke();
          }
          if (phase > 0.55){
            lawA = Math.min(1, (phase-0.55)*3);
            drawLawyerQueue(W*0.62, H*0.62, lawA);
            ctx.strokeStyle = 'rgba(217,119,6,.4)';
            ctx.beginPath();
            ctx.moveTo(scanX + scanR*0.5, scanY + scanR*0.5);
            ctx.lineTo(W*0.62, H*0.66);
            ctx.stroke();
          }

          if (phase > 0.82){
            ctx.fillStyle = C.safe;
            ctx.font = 'bold 11px system-ui,sans-serif';
            ctx.textAlign = 'center';
            ctx.globalAlpha = Math.min(1,(phase-0.82)*5);
            ctx.fillText('✓ Отправлено · риск снят', W*0.5, H*0.9);
            ctx.globalAlpha = 1;
          }

          requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
      })();
      </script>
    </section>

    <div class="vyrip-cnt">
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-demo">
        <div class="ym-cta-block__icon" aria-hidden="true">🛡️</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить переписку на демо</p>
          <p class="ym-cta-block__sub">Пришлите обезличенный фрагмент исходящего письма или чата — покажем подсветку рисков, safe rewrite и маршрут эскалации юристу. Без обязательств.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </aside>
    </div>
  </section>

  <section class="vyrip-section" id="checklist">
    <div class="vyrip-cnt">
      <div class="vyrip-sh nero-ai-reveal">
        <span class="vyrip-eyebrow">Лид-магнит</span>
        <h2>Типовые рискованные формулировки <span class="vyrip-badge-lm">чек-лист</span></h2>
        <p>Фрагмент регламента; полный чек-лист — при заявке «Проверить переписку».</p>
      </div>
      <div class="vyrip-table-wrap nero-ai-reveal">
        <table class="vyrip-table" aria-label="Опасные формулировки и безопасные замены">
          <thead><tr><th>Опасная формулировка</th><th>Почему риск</th><th>Безопасная замена</th></tr></thead>
          <tbody>
            <tr><td class="vyrip-col-risk">«Гарантируем результат»</td><td>Заверение (ст. 431.2 ГК)</td><td class="vyrip-col-safe">«Работаем по условиям договора № …»</td></tr>
            <tr><td class="vyrip-col-risk">«Точно будет завтра»</td><td>Обязательство вне SLA</td><td class="vyrip-col-safe">«Срок по регламенту — … рабочих дней»</td></tr>
            <tr><td class="vyrip-col-risk">«Компенсируем убытки»</td><td>Без полномочий</td><td class="vyrip-col-safe">«Вопрос компенсации — претензионный порядок»</td></tr>
            <tr><td class="vyrip-col-risk">«Скидка 20%»</td><td>Договорный риск</td><td class="vyrip-col-safe">«Скидки согласуются с руководителем»</td></tr>
            <tr><td class="vyrip-col-risk">«Передали данные партнёру»</td><td>152-ФЗ</td><td class="vyrip-col-safe">«Передача ПДн — по договору и с согласия»</td></tr>
            <tr><td class="vyrip-col-risk">«Хорошо, приступим»</td><td>Акцепт в мессенджере</td><td class="vyrip-col-safe">«Подтверждение после согласования с …»</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vyrip-section vyrip-section-alt" id="etapy">
    <div class="vyrip-cnt">
      <div class="vyrip-sh nero-ai-reveal">
        <span class="vyrip-eyebrow">Под ключ</span>
        <h2>Внедрение AI для контроля переписки: этапы</h2>
        <p>Ориентир <strong>200–700 тыс. ₽</strong>. Старт с одного канала и отдела — сначала warn, затем ужесточение.</p>
      </div>
      <div class="vyrip-table-wrap nero-ai-reveal">
        <table class="vyrip-table" aria-label="Этапы внедрения">
          <thead><tr><th>Этап</th><th>Срок</th><th>Содержание</th></tr></thead>
          <tbody>
            <tr><td>1. Аудит</td><td>~1 нед.</td><td>Каналы исходящих, типовые риски, policy gaps</td></tr>
            <tr><td>2. Policy pack</td><td>1–2 нед.</td><td>Чек-лист, категории, safe templates, матрица полномочий</td></tr>
            <tr><td>3. Пилот</td><td>2–3 нед.</td><td>Один канал + отдел; YandexGPT/GigaChat; режим warn</td></tr>
            <tr><td>4. Интеграция</td><td>2–4 нед.</td><td>CRM + почта; логи; эскалация юристу</td></tr>
            <tr><td>5. Обучение</td><td>1 нед.</td><td>Регламент, ст. 74 ТК РФ, политика ИИ</td></tr>
            <tr><td>6. Масштабирование</td><td>по плану</td><td>Поддержка, мессенджеры, hard-block high-risk</td></tr>
          </tbody>
        </table>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта проекта?</p>
          <p class="ym-cta-block__sub">Перед внедрением pre-send compliance полезно разобраться в промптах, human-in-the-loop и интеграции с CRM — это ускоряет согласование policy с юротделом. Посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="vyrip-section" id="integracii">
    <div class="vyrip-cnt">
      <div class="vyrip-sh nero-ai-reveal">
        <span class="vyrip-eyebrow">Стек</span>
        <h2>Интеграция с CRM, почтой и мессенджерами</h2>
        <p>Коннекторы: webhook, API, browser extension, SMTP relay — подсказка в момент написания.</p>
      </div>
      <div class="vyrip-grid-3 nero-ai-reveal">
        <div class="vyrip-card"><h3>Exchange / Gmail</h3><p>Microsoft Graph, Google Workspace API. Паттерн Epiq Prevent — coaching в Outlook/Gmail.</p></div>
        <div class="vyrip-card"><h3>amoCRM / Битрикс24</h3><p>Make, n8n, PHP-активити. Референс Off Group: YandexGPT в Битрикс24 — тот же стек с policy юридических рисков.</p></div>
        <div class="vyrip-card"><h3>Telegram / WhatsApp</h3><p>Business API через провайдера. После запуска policy настраивают юротдел и админы CRM.</p></div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="vyrip-section vyrip-section-alt" id="compliance">
    <div class="vyrip-cnt">
      <div class="vyrip-sh vyrip-left nero-ai-reveal">
        <span class="vyrip-eyebrow">Policy · 152-ФЗ</span>
        <h2>AI compliance, 152-ФЗ и безопасность данных</h2>
        <p>Мониторинг законен при корпоративных каналах, уведомлении (ст. 74 ТК РФ), соразмерности. Данные не для произвольных увольнений.</p>
      </div>
      <div class="vyrip-grid-3 nero-ai-reveal">
        <div class="vyrip-card"><h3>Российские LLM</h3><p>YandexGPT, GigaChat — облако с DPA. Claude/OpenAI — только enterprise-контур при допустимости политики.</p></div>
        <div class="vyrip-card"><h3>On-premise</h3><p>Локальный LLM для жёсткого ИБ. Референс SearchInform — ИИ в DLP локально.</p></div>
        <div class="vyrip-card"><h3>Логирование и аудит</h3><p>Журнал проверок, топ категорий, каналы. СёрчИнформ КИБ — дополнение post-send, не замена pre-send.</p></div>
      </div>
    </div>
  </section>

  <section class="vyrip-section" id="stoimost">
    <div class="vyrip-cnt">
      <div class="vyrip-sh nero-ai-reveal">
        <span class="vyrip-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения AI-проверки переписки <span class="vyrip-price-pill">200–700 тыс. ₽</span></h2>
        <p>Точная смета — после аудита каналов.</p>
      </div>
      <div class="vyrip-card nero-ai-reveal">
        <h3>Факторы цены</h3>
        <ul>
          <li>Число каналов: email vs email + CRM + мессенджеры</li>
          <li>Объём исходящих и число пользователей</li>
          <li>Глубина интеграции и эскалация в Service Desk</li>
          <li>Контур данных: облачные LLM vs on-prem</li>
          <li>Отраслевые требования (финансы, медицина, госсектор)</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="vyrip-section vyrip-section-alt" id="keisy">
    <div class="vyrip-cnt">
      <div class="vyrip-sh nero-ai-reveal">
        <span class="vyrip-eyebrow">Кейсы</span>
        <h2>Кейсы и примеры внедрения</h2>
        <p>Прямых российских кейсов pre-send legal coaching не найдено — смежные внедрения и проектная модель Nero Network.</p>
      </div>
      <div class="vyrip-case-grid nero-ai-reveal">
        <div class="vyrip-case-card"><div class="vyrip-case-tag">Продажи</div><h3>Off Group</h3><p>YandexGPT в Битрикс24, анализ обещаний менеджеров. Nero добавляет юридические риски <strong>до отправки</strong>.</p></div>
        <div class="vyrip-case-card"><div class="vyrip-case-tag">Поддержка</div><h3>Pre-send в чате</h3><p>Саппорт обещает сроки и компенсации — AI перехватывает до отправки по SLA.</p></div>
        <div class="vyrip-case-card"><div class="vyrip-case-tag">Юрдепартамент</div><h3>PravoTech</h3><p>Договорный контур + операционная переписка: модуль Nero закрывает чат менеджера.</p></div>
      </div>
    </div>
  </section>

  <section class="vyrip-section" id="sravnenie">
    <div class="vyrip-cnt">
      <div class="vyrip-sh nero-ai-reveal">
        <span class="vyrip-eyebrow">Дифференциация</span>
        <h2>Отличие от DLP, legal tech и «просто ChatGPT»</h2>
      </div>
      <div class="vyrip-table-wrap nero-ai-reveal">
        <table class="vyrip-table" aria-label="Сравнение подходов">
          <thead><tr><th>Подход</th><th>Когда</th><th>Фокус</th><th>Пробел</th></tr></thead>
          <tbody>
            <tr><td>DLP (SearchInform)</td><td>post-hoc</td><td>Утечки, ИБ</td><td>Не coaching <strong>до отправки</strong> клиенту</td></tr>
            <tr><td>Legal tech</td><td>Договоры</td><td>Документы</td><td>Не real-time переписка</td></tr>
            <tr><td>CRM-аналитика</td><td>После накопления</td><td>KPI продаж</td><td>Не legal pre-send</td></tr>
            <tr><td>ChatGPT вручную</td><td>Когда вспомнили</td><td>Нет policy</td><td>Нет 152-ФЗ-контура</td></tr>
            <tr class="vyrip-row-nero"><td><strong>Nero Network</strong> <span class="vyrip-badge-pre">Pre-send</span></td><td><strong>До отправки</strong></td><td><strong>Юридические риски исходящих</strong></td><td>Внедрение под ключ</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="vyrip-section vyrip-section-alt" id="governance">
    <div class="vyrip-cnt">
      <div class="vyrip-sh nero-ai-reveal">
        <span class="vyrip-eyebrow">2026 · Governance</span>
        <h2>Governance AI: почему контроль переписки критичен</h2>
      </div>
      <div class="vyrip-stat-card nero-ai-reveal">
        <div class="num">40%</div>
        <div class="lbl">agentic AI-проектов отменят к 2027 — не из-за моделей, а из-за governance (Gartner, 25.06.2025)</div>
        <p style="margin-top:16px;font-size:14px"><a href="https://www.gartner.com/en/newsroom/press-releases/2025-06-25-gartner-predicts-over-40-percent-of-agentic-ai-projects-will-be-canceled-by-end-of-2027" target="_blank" rel="noopener noreferrer" style="color:var(--vyrip-cyan);text-decoration:underline">Источник Gartner</a></p>
      </div>
      <p class="nero-ai-reveal" style="text-align:center;max-width:720px;margin:0 auto">Pre-send контроль рисков — нижний эшелон лестницы Observe → Advise → Act with Approval → Act Autonomously. Без него внедрение ai в бизнес процессы ускоряет ошибки, а не только работу.</p>
    </div>
  </section>

  <section class="vyrip-section" id="faq">
    <div class="vyrip-cnt">
      <div class="vyrip-sh nero-ai-reveal">
        <span class="vyrip-eyebrow">FAQ</span>
        <h2>Частые вопросы</h2>
      </div>
      <div class="vyrip-faq nero-ai-reveal">
        <details class="vyrip-faq-item"><summary>Как внедрить ai юридические риски переписки?</summary><div class="vyrip-faq-a"><p>Аудит → policy pack → пилот на одном отделе → интеграция CRM/почты → обучение → масштабирование. Старт — заявка «Проверить переписку».</p></div></details>
        <details class="vyrip-faq-item"><summary>Сколько стоит?</summary><div class="vyrip-faq-a"><p>Ориентир 200–700 тыс. ₽ в зависимости от каналов и контура данных. Точная смета после аудита.</p></div></details>
        <details class="vyrip-faq-item"><summary>Нужны ли программисты после запуска?</summary><div class="vyrip-faq-a"><p>Первичное внедрение — интегратор. Policy и промпты — юротдел и админы CRM (паттерн Off Group / SearchInform).</p></div></details>
        <details class="vyrip-faq-item"><summary>Подходит ли для малого бизнеса?</summary><div class="vyrip-faq-a"><p>Да, пилот на email продаж или одном CRM-чате — не обязательно все каналы сразу.</p></div></details>
        <details class="vyrip-faq-item"><summary>Законно ли проверять переписку?</summary><div class="vyrip-faq-a"><p>Да, при корпоративных каналах, уведомлении (ст. 74 ТК РФ), соразмерности и запрете использовать данные для произвольных увольнений.</p></div></details>
        <details class="vyrip-faq-item"><summary>Что если ИИ ошибётся?</summary><div class="vyrip-faq-a"><p>Human-in-the-loop: AI советует, человек решает; high-risk — эскалация юристу; логи для разбора.</p></div></details>
        <details class="vyrip-faq-item"><summary>Можно ли on-prem и российские LLM?</summary><div class="vyrip-faq-a"><p>Да: YandexGPT, GigaChat, on-prem LLM — стандартный ответ на 152-ФЗ и NDA банков.</p></div></details>
        <details class="vyrip-faq-item"><summary>Чем отличается от DLP?</summary><div class="vyrip-faq-a"><p>DLP — утечки часто после отправки; Nero — обещания клиенту до отправки.</p></div></details>
        <details class="vyrip-faq-item"><summary>Работает ли с amoCRM и Битрикс24?</summary><div class="vyrip-faq-a"><p>Да, типовой стек; также Exchange, Gmail, Telegram/WhatsApp Business API.</p></div></details>
        <details class="vyrip-faq-item"><summary>Есть ли примеры внедрения?</summary><div class="vyrip-faq-a"><p>Прямых публичных кейсов pre-send legal coaching нет; смежные — Off Group, SearchInform, PravoTech; Nero — проектная модель под ваши каналы.</p></div></details>
      </div>
    </div>
  </section>

  <section class="vyrip-section vyrip-section-alt" id="cta-final">
    <div class="vyrip-cnt">
      <div class="ym-cta-block ym-cta-block--dual" id="cta-final-block">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Один рискованный абзац может стоить дороже внедрения</p>
          <p class="ym-cta-block__sub">Ориентир <strong>200–700 тыс. ₽</strong> за внедрение под ключ: аудит каналов, policy pack, пилот, интеграция CRM/почты. На демо дадим чек-лист опасных формулировок и оценку сроков.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
            <a href="#checklist" class="nero-ai-btn nero-ai-btn-secondary">Получить чек-лист</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.vyrip-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php
$nero_ai_reveal = get_stylesheet_directory() . '/../shared/longread-page-reveal.js';
if ( ! is_readable( $nero_ai_reveal ) ) {
	$nero_ai_reveal = dirname( __DIR__ ) . '/shared/longread-page-reveal.js';
}
?>
<script>
/**
 * vyrip-compliance-engine — Диспетчерская «Предотправной compliance»
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vyrip-compliance-canvas");
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
    outline: "#94a3b8", panel: "#1e293b", panelLight: "#334155", composeBg: "#f8fafc",
    risk: "#f87171", riskGlow: "rgba(248,113,113,0.45)", safe: "#22c55e", safeGlow: "rgba(34,197,94,0.35)",
    warn: "#fbbf24", cyan: "#79f2ff", violet: "rgba(139,92,246,0.4)", orbit: "rgba(121,242,255,0.2)",
    agentYellow: "#eab308", agentGreen: "#10b981", agentBlue: "#3b82f6", agentPink: "#ec4899", agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a", bubbleText: "#e2e8f0"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.lineWidth = 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  function ChannelOrbitRelay() { this.phase = 0; this.channels = [{ label: "Outlook", angle: 0, color: C.cyan }, { label: "CRM", angle: 2.09, color: C.violet }, { label: "TG", angle: 4.18, color: C.safe }]; }
  ChannelOrbitRelay.prototype.draw = function (ctx) {
    this.phase = (frame * 0.022) % (Math.PI * 2);
    var rx = 125, ry = 48;
    ctx.save();
    ctx.strokeStyle = C.orbit; ctx.lineWidth = 1.5; ctx.setLineDash([5, 7]); ctx.lineDashOffset = -frame * 0.35;
    ctx.beginPath(); ctx.ellipse(0, -15, rx, ry, 0, 0, Math.PI * 2); ctx.stroke(); ctx.setLineDash([]);
    this.channels.forEach(function (ch, i) {
      var t = this.phase + ch.angle;
      var px = Math.cos(t) * rx, py = -15 + Math.sin(t) * ry;
      drawRR(ctx, px - 16, py - 9, 32, 18, 5, "rgba(15,23,42,0.85)", ch.color);
      ctx.fillStyle = "#fff"; ctx.font = "bold 7px Inter,sans-serif"; ctx.textAlign = "center"; ctx.fillText(ch.label, px, py + 3);
      var dotT = (this.phase * 1.4 + i * 2.1) % (Math.PI * 2);
      var dx = Math.cos(dotT) * (rx - 20), dy = -15 + Math.sin(dotT) * (ry - 12);
      ctx.fillStyle = i === 0 ? C.risk : C.cyan; ctx.beginPath(); ctx.arc(dx, dy, 3, 0, Math.PI * 2); ctx.fill();
    }, this);
    ctx.restore();
  };

  function OutboundComposeTerminal() { this.riskPulse = 0; }
  OutboundComposeTerminal.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -62, -72, 124, 148, 10, C.panel, C.outline);
    drawRR(ctx, -54, -64, 108, 108, 8, C.composeBg, C.outline);
    drawRR(ctx, -54, -64, 108, 18, [8, 8, 0, 0], "#e2e8f0", C.outline);
    ctx.fillStyle = C.risk; ctx.beginPath(); ctx.arc(-44, -55, 3, 0, Math.PI * 2); ctx.fill();
    var lines = [{ text: "Добрый день,", risk: false }, { text: "гарантируем результат", risk: true }, { text: "к пятнице.", risk: false }];
    lines.forEach(function (ln, i) {
      var ly = -38 + i * 16, lw = ln.risk ? 78 : 52 + (i % 2) * 12;
      if (ln.risk && prg >= 20 && prg < 200) {
        this.riskPulse = 0.5 + Math.sin(frame * 0.12) * 0.5;
        ctx.fillStyle = "rgba(248,113,113," + (0.15 + this.riskPulse * 0.25) + ")";
        drawRR(ctx, -48, ly - 6, lw + 8, 14, 3, ctx.fillStyle, C.risk);
      }
      ctx.fillStyle = ln.risk ? C.risk : "#64748b";
      ctx.font = (ln.risk ? "bold " : "") + "8px Inter,sans-serif";
      ctx.textAlign = "left"; ctx.fillText(ln.text, -44, ly + 4);
    }, this);
    if (prg >= 55 && prg < 130) {
      var scanY = -38 + ((prg - 55) / 75) * 48;
      ctx.strokeStyle = "rgba(121,242,255,0.7)"; ctx.lineWidth = 2;
      ctx.beginPath(); ctx.moveTo(-50, scanY); ctx.lineTo(50, scanY); ctx.stroke();
    }
    if (prg >= 75 && prg < 95) {
      drawRR(ctx, 38, -58, 42, 16, 4, "rgba(248,113,113,0.2)", C.risk);
      ctx.fillStyle = C.risk; ctx.font = "bold 7px Inter,sans-serif"; ctx.textAlign = "center"; ctx.fillText("заверение", 59, -47);
    }
  };

  function SafeRewritePanel() { this.slide = 0; }
  SafeRewritePanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 120) { this.slide = 0; return; }
    this.slide = Math.min(1, (prg - 120) / 35);
    var sx = 70 - (1 - this.slide) * 90;
    drawRR(ctx, sx, -20, 88, 52, 8, "rgba(34,197,94,0.18)", C.safe);
    ctx.fillStyle = C.safe; ctx.font = "bold 7px Inter,sans-serif"; ctx.textAlign = "left"; ctx.fillText("Safe rewrite", sx + 8, -6);
    ctx.fillStyle = "#bbf7d0"; ctx.font = "7px Inter,sans-serif";
    ctx.fillText("в рамках договора", sx + 8, 8); ctx.fillText("№ … раздел …", sx + 8, 20);
    if (this.slide > 0.8) { ctx.strokeStyle = C.safeGlow; ctx.lineWidth = 2; ctx.beginPath(); ctx.moveTo(sx - 8, 6); ctx.lineTo(-20, -10); ctx.stroke(); }
  };

  function RiskPulseScanner() { this.alpha = 0; }
  RiskPulseScanner.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 30 || prg > 125) return;
    this.alpha = 0.25 + Math.sin(frame * 0.15) * 0.15;
    ctx.strokeStyle = "rgba(248,113,113," + this.alpha + ")"; ctx.lineWidth = 3;
    ctx.beginPath(); ctx.arc(-8, -18, 28 + Math.sin(frame * 0.08) * 6, 0, Math.PI * 2); ctx.stroke();
  };

  function PolicyShieldBadge() { this.glow = 0; }
  PolicyShieldBadge.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -155, -55, 38, 44, 6, "rgba(121,242,255,0.1)", C.cyan);
    ctx.fillStyle = C.cyan; ctx.font = "bold 7px Inter,sans-serif"; ctx.textAlign = "center";
    ctx.fillText("152-ФЗ", -136, -38); ctx.fillText("policy", -136, -28);
    if (prg > 100 && prg < 180) {
      this.glow = Math.sin((prg - 100) * 0.08) * 0.4 + 0.6;
      ctx.globalAlpha = this.glow; ctx.strokeStyle = C.cyan; ctx.lineWidth = 2;
      ctx.beginPath(); ctx.moveTo(-136, -48); ctx.lineTo(-95, -25); ctx.stroke(); ctx.globalAlpha = 1;
    }
  };

  function LegalEscalationBeacon() { this.pulse = 0; }
  LegalEscalationBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 118, 35, 40, 36, 6, "rgba(251,191,36,0.12)", C.warn);
    ctx.fillStyle = C.warn; ctx.font = "bold 7px Inter,sans-serif"; ctx.textAlign = "center";
    ctx.fillText("юрист", 138, 52); ctx.fillText("review", 138, 62);
    if (prg > 210 && prg < 250) {
      this.pulse = (prg - 210) / 40;
      ctx.strokeStyle = "rgba(251,191,36," + (0.8 - this.pulse * 0.6) + ")"; ctx.lineWidth = 2; ctx.setLineDash([3, 3]);
      ctx.beginPath(); ctx.moveTo(0, 10); ctx.lineTo(118, 50); ctx.stroke(); ctx.setLineDash([]);
    }
  };

  function PreSendApprovalSeal() { this.stamp = 0; }
  PreSendApprovalSeal.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 195) { this.stamp = 0; return; }
    this.stamp = Math.min(1, (prg - 195) / 18);
    var scaleStamp = 0.6 + this.stamp * 0.4;
    ctx.save(); ctx.translate(0, 42); ctx.scale(scaleStamp, scaleStamp);
    ctx.strokeStyle = "rgba(34,197,94," + (0.5 + this.stamp * 0.5) + ")"; ctx.lineWidth = 3;
    ctx.beginPath(); ctx.arc(0, 0, 22, 0, Math.PI * 2); ctx.stroke();
    ctx.fillStyle = C.safe; ctx.font = "bold 8px Inter,sans-serif"; ctx.textAlign = "center";
    ctx.fillText("PRE-SEND", 0, -4); ctx.font = "7px Inter,sans-serif"; ctx.fillText("OK", 0, 8);
    if (this.stamp > 0.7) {
      ctx.strokeStyle = "rgba(34,197,94," + (1 - (prg - 215) / 45) + ")"; ctx.lineWidth = 4;
      ctx.beginPath(); ctx.arc(0, 0, 28 + (prg - 215) * 0.8, 0, Math.PI * 2); ctx.stroke();
    }
    ctx.restore();
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y; this.color = color; this.role = role;
    this.timer = Math.random() * 100; this.stepTrig = stepTrig; this.dialogs = dialogs;
  }
  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.038) % 260, isMoving = false, faceDir = 1, carryType = null;
    var corners = { "1_architect": { x: -95, y: 58 }, "2_seo": { x: -35, y: 72 }, "3_coder": { x: 35, y: 72 }, "4_designer": { x: 95, y: 58 }, "5_deployer": { x: 0, y: 82 } };
    var tgt = corners[this.role] || { x: 0, y: 70 };
    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) { isMoving = true; this.x = this.baseX + (tgt.x - this.baseX) * (local / 12); this.y = this.baseY + (tgt.y - this.baseY) * (local / 12); }
      else if (local < 17) { this.x = tgt.x; this.y = tgt.y; }
      else { isMoving = true; faceDir = -1; this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7); this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7); }
    } else { this.x = this.baseX; this.y = this.baseY; carryType = prg >= this.stepTrig - 10 ? this.color : null; }
    if (!isMoving && frame % 240 === 0 && Math.random() < 0.14) createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
    var bob = Math.sin(this.timer * 1.5) * 1.2;
    ctx.save(); ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) { var wp = this.timer * 6; legL = Math.sin(wp) * 4; legR = Math.sin(wp + Math.PI) * 4; }
    drawRR(ctx, -8, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
    drawRR(ctx, 0, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
    drawRR(ctx, -12, -10 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color; ctx.beginPath(); ctx.arc(0, -22 - bob, 9, 0, Math.PI * 2); ctx.fill();
    ctx.strokeStyle = C.outline; ctx.lineWidth = 1.5; ctx.stroke();
    if (carryType) drawRR(ctx, -16 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [], bubbles = [];
  var orbit = new ChannelOrbitRelay(), compose = new OutboundComposeTerminal(), scanner = new RiskPulseScanner();
  var rewrite = new SafeRewritePanel(), shield = new PolicyShieldBadge(), beacon = new LegalEscalationBeacon(), seal = new PreSendApprovalSeal();
  entities.push(orbit, shield, scanner, compose, rewrite, beacon, seal);
  entities.push(new Agent(-130, 98, C.agentYellow, "1_architect", 20, ["Policy pack готов", "Матрица полномочий", "Категории риска YAML"]));
  entities.push(new Agent(-65, 108, C.agentGreen, "2_seo", 58, ["Ст. 431.2 ГК — заверение", "High-risk: гарантии", "Категория: обещание"]));
  entities.push(new Agent(0, 112, C.agentBlue, "3_coder", 102, ["NLP: не keyword-only", "Контекст SLA vs продажа", "risk_score 0.87"]));
  entities.push(new Agent(65, 108, C.agentPink, "4_designer", 148, ["Панель rewrite", "Отсылка к договору", "UI в Outlook"]));
  entities.push(new Agent(130, 98, C.agentPurple, "5_deployer", 198, ["Human-in-the-loop", "Эскалация юристу", "Лог в CRM"]));

  function createBubble(x, y, text, life) { bubbles.push({ x: x, y: y, text: text, life: life || 250, maxLife: life || 250 }); }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save(); ctx.translate(cx, cy); ctx.scale(scale, scale);
    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });
    var prg = (frame * 0.038) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-70, -50, "1. Черновик исходящего");
    if (prg >= 62 && prg < 62.05) createBubble(-40, -5, "2. Риск: заверение");
    if (prg >= 128 && prg < 128.05) createBubble(30, 0, "3. Safe rewrite");
    if (prg >= 175 && prg < 175.05) createBubble(0, -30, "4. Policy OK");
    if (prg >= 218 && prg < 218.05) createBubble(90, 20, "5. Pre-send разрешён");
    ctx.font = "bold 10px Inter,sans-serif"; ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i]; b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.cyan);
      ctx.fillStyle = C.bubbleText; ctx.fillText(b.text, b.x, b.y - 11);
      ctx.globalAlpha = 1;
    }
    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(engineloop);
  else engineloop();
});
</script>

<script>
(function(){
  'use strict';
  var root=document.querySelector('.vyrip-content');
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
