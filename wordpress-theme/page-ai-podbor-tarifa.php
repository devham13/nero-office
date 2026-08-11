<?php
/**
 * Template Name: AI-агент для подбора тарифа: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI-консультанта для pricing page. Кейсы, интеграции, цены. Подобрать сценарий.
 */

$page_seo_title       = 'AI подбор тарифа под ключ — внедрение AI-консультанта';
$page_seo_description = 'Внедрение AI-агента для подбора тарифа: объясняет разницу пакетов и рекомендует комплектацию под задачу. SaaS, телеком, онлайн-школы. Подобрать сценарий.';

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

$brand = get_bloginfo( 'name' ) ?: ( getenv( 'SITE_BRAND' ) ?: '' ); // pragma: allowlist secret

$nero_ai_header_links = [
	[ 'label' => 'Как работает', 'href' => '#kak-rabotaet' ],
	[ 'label' => 'Для кого',     'href' => '#dlya-kogo' ],
	[ 'label' => 'Внедрение',    'href' => '#sostav' ],
	[ 'label' => 'Кейсы',        'href' => '#keisy' ],
	[ 'label' => 'Стоимость',    'href' => '#ceny' ],
	[ 'label' => 'FAQ',          'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Подобрать сценарий';
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'Курс по AI-автоматизации';
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
/* Kadence reset */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

/* APT content root */
.apt-content{
  --apt-bg:#050711;--apt-bg2:#080b17;--apt-surface:rgba(255,255,255,.072);
  --apt-text:#e6edf7;--apt-muted:#9aa8bd;--apt-soft:#c7d2e5;--apt-heading:#fff;
  --apt-border:rgba(255,255,255,.10);--apt-accent:#79f2ff;--apt-violet:#8b5cf6;--apt-green:#22c55e;
  --apt-btn-from:#2563eb;--apt-btn-to:#7c3aed;--apt-r:18px;--apt-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--apt-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.apt-content *,.apt-content *::before,.apt-content *::after{box-sizing:border-box}
.apt-content a{color:inherit}
.apt-content p{color:var(--apt-muted);line-height:1.72;margin:0 0 1em}
.apt-content p:last-child{margin-bottom:0}
.apt-content h2,.apt-content h3,.apt-content h4{color:var(--apt-heading);letter-spacing:-.045em;margin:0 0 .7em}
.apt-content strong{color:var(--apt-soft)}
.apt-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.apt-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apt-muted);font-size:14.5px;line-height:1.65}
.apt-content ul li::before{content:'›';position:absolute;left:0;color:var(--apt-accent);font-weight:700}
.apt-cnt{width:min(var(--apt-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.apt-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.apt-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.apt-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.apt-sh.apt-left{margin-left:0;text-align:left}
.apt-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.apt-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.apt-sh.apt-left p{margin-left:0}
.apt-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apt-accent);margin-bottom:14px}
.apt-gt{background:linear-gradient(92deg,#fff 0%,var(--apt-accent) 44%,var(--apt-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.apt-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.apt-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.apt-intro-text{position:relative;padding-left:20px}
.apt-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apt-accent),var(--apt-violet))}
.apt-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--apt-muted);margin-bottom:1em}
.apt-intro-text p:last-child{margin-bottom:0;color:var(--apt-soft)}
.apt-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.apt-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.apt-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--apt-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.apt-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apt-muted);line-height:1.4}
@media(max-width:900px){.apt-intro-grid{grid-template-columns:1fr;gap:36px}.apt-intro-kpi{grid-template-columns:repeat(2,1fr)}}
.apt-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.apt-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
@media(max-width:960px){.apt-grid-4{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.apt-grid-2,.apt-grid-4{grid-template-columns:1fr}}
.apt-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apt-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.apt-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.apt-card h3{font-size:17px;margin-bottom:10px}
.apt-card p{font-size:14px;margin:0}
.apt-callout{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin:28px 0}
.apt-callout-item{padding:20px;border-radius:16px;background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.18);text-align:center}
.apt-callout-item strong{display:block;font-size:clamp(24px,3vw,32px);color:var(--apt-accent);margin-bottom:6px}
.apt-callout-item span{font-size:13px;color:var(--apt-muted)}
.apt-steps{counter-reset:aptstep;display:flex;flex-direction:column;gap:14px;margin:24px 0}
.apt-step{display:grid;grid-template-columns:36px 1fr;gap:14px;align-items:start;padding:16px 18px;border-radius:14px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08)}
.apt-step::before{counter-increment:aptstep;content:counter(aptstep);display:grid;place-items:center;width:36px;height:36px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--apt-accent);font-weight:800;font-size:14px}
.apt-step p{margin:0;font-size:14.5px}
.apt-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.apt-table{width:100%;border-collapse:collapse;font-size:14px}
.apt-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--apt-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.apt-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apt-text);vertical-align:top}
.apt-table tr:nth-child(even) td{background:rgba(255,255,255,.02)}
.apt-table .apt-col-highlight{background:rgba(34,197,94,.08)!important;border-left:2px solid var(--apt-green)}
.apt-timeline{position:relative;padding-left:40px}
.apt-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--apt-accent),var(--apt-violet));opacity:.35;border-radius:2px}
.apt-tl-item{position:relative;margin-bottom:32px}
.apt-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--apt-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.apt-tl-item h3{font-size:17px;margin-bottom:8px}
.apt-tl-item p{font-size:14.5px;margin:0}
.apt-warn{padding:24px 28px;border-radius:18px;background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);margin:24px 0}
.apt-warn h3{color:#fca5a5;font-size:17px}
.apt-case-cols{display:grid;grid-template-columns:1fr 1fr;gap:24px}
@media(max-width:768px){.apt-case-cols{grid-template-columns:1fr}}
.apt-price-band{text-align:center;padding:40px 32px;border-radius:24px;background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.08));border:1px solid rgba(121,242,255,.25);margin:28px 0}
.apt-price-band .apt-price{font-size:clamp(32px,5vw,48px);font-weight:900;color:#fff;margin:12px 0}
.apt-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.apt-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.apt-faq-item summary{padding:19px 24px;font-size:16px;font-weight:700;color:var(--apt-heading);cursor:pointer;list-style:none;display:flex;align-items:center;justify-content:space-between;gap:16px}
.apt-faq-item summary::-webkit-details-marker{display:none}
.apt-faq-item summary::after{content:'▾';font-size:13px;color:var(--apt-accent);flex-shrink:0;transition:transform .25s}
.apt-faq-item[open] summary::after{transform:rotate(180deg)}
.apt-faq-body{padding:0 24px 20px;font-size:14.5px;color:var(--apt-muted);line-height:1.72}
.apt-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.apt-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--apt-muted)}
.apt-cta-checklist li::before{content:'✓';color:var(--apt-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--apt-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--apt-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--apt-btn-from),var(--apt-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}.apt-callout{grid-template-columns:1fr}}

/* Hero Алины — apt-hero-tariff (самодостаточный блок) */
.apt-hero-tariff{
  --apt-hero-cyan:#79f2ff;--apt-hero-violet:#a78bfa;--apt-hero-green:#22c55e;
  --apt-hero-text:#e6edf7;--apt-hero-muted:#9aa8bd;--apt-hero-soft:#c7d2e5;
  --apt-hero-shadow:0 28px 90px rgba(0,0,0,.42);
}
.apt-hero-tariff.nero-ai-hero{
  position:relative;min-height:min(980px,calc(100dvh - 1px));display:grid;align-items:center;
  padding:clamp(72px,9vw,132px) 0 clamp(44px,7vw,86px);isolation:isolate;
  background:linear-gradient(180deg,#050711 0%,#080b17 100%);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.apt-hero-tariff::before{
  content:"";position:absolute;inset:0;
  background-image:linear-gradient(rgba(255,255,255,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.035) 1px,transparent 1px);
  background-size:64px 64px;mask-image:radial-gradient(circle at 45% 30%,#000 0%,transparent 72%);
  opacity:.55;pointer-events:none;z-index:-2;
}
.apt-hero-tariff::after{
  content:"";position:absolute;left:50%;top:16%;width:820px;height:820px;transform:translateX(-50%);
  border-radius:999px;background:radial-gradient(circle,rgba(121,242,255,.12),transparent 66%);
  filter:blur(6px);animation:aptHeroGlow 8s ease-in-out infinite alternate;z-index:-1;pointer-events:none;
}
@keyframes aptHeroGlow{from{opacity:.45;transform:translateX(-50%) scale(.96)}to{opacity:.86;transform:translateX(-50%) scale(1.06)}}
.apt-hero-tariff .nero-ai-container{width:min(1220px,calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.apt-hero-tariff .nero-ai-hero-grid{display:grid;grid-template-columns:minmax(0,1.02fr) minmax(360px,.98fr);gap:clamp(28px,4vw,56px);align-items:center}
.apt-hero-tariff .nero-ai-hero-copy h1{margin:0;max-width:780px;font-size:clamp(38px,5.8vw,72px);line-height:.95;letter-spacing:-.065em;color:#fff;font-weight:900}
.apt-hero-tariff .nero-ai-gradient-text{background:linear-gradient(92deg,#fff 0%,var(--apt-hero-cyan) 44%,var(--apt-hero-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.apt-hero-tariff .nero-ai-eyebrow{display:inline-flex;align-items:center;gap:8px;margin:0 0 16px;padding:8px 12px;border:1px solid rgba(121,242,255,.2);border-radius:999px;background:rgba(121,242,255,.08);color:var(--apt-hero-cyan)!important;font-size:13px;font-weight:750;line-height:1;text-transform:uppercase;letter-spacing:.11em}
.apt-hero-tariff .nero-ai-hero-lead{margin:24px 0 0;max-width:720px;color:var(--apt-hero-soft)!important;font-size:clamp(17px,1.9vw,21px);line-height:1.58}
.apt-hero-tariff .nero-ai-badges{display:flex;flex-wrap:wrap;gap:10px;margin:26px 0 0;padding:0;list-style:none}
.apt-hero-tariff .nero-ai-badge{display:inline-flex;align-items:center;gap:7px;padding:8px 11px;border:1px solid rgba(255,255,255,.11);border-radius:999px;background:rgba(255,255,255,.055);color:#dce8f7;font-size:13px;font-weight:700}
.apt-hero-tariff .nero-ai-btn-row{display:flex;flex-wrap:wrap;gap:14px;align-items:center;margin-top:34px}
.apt-hero-tariff .nero-ai-btn{display:inline-flex;align-items:center;justify-content:center;min-height:48px;padding:14px 20px;border-radius:999px;border:1px solid transparent;font-size:15px;font-weight:800;line-height:1;text-decoration:none!important;transition:transform .22s ease,border-color .22s ease,background .22s ease}
.apt-hero-tariff .nero-ai-btn:hover{transform:translateY(-2px)}
.apt-hero-tariff .nero-ai-btn-primary{color:#031018!important;background:linear-gradient(135deg,var(--apt-hero-cyan),#a7f3d0);box-shadow:0 18px 42px rgba(121,242,255,.22)}
.apt-hero-tariff .nero-ai-btn-ghost{color:var(--apt-hero-text)!important;background:rgba(255,255,255,.07);border-color:rgba(255,255,255,.14)}
.apt-hero-tariff .nero-ai-dashboard{position:relative;padding:18px;border-radius:34px;background:rgba(2,6,23,.42);box-shadow:var(--apt-hero-shadow);transform:perspective(1100px) rotateY(-3deg) rotateX(2deg)}
.apt-hero-tariff .nero-ai-dashboard-shell{overflow:hidden;border:1px solid rgba(255,255,255,.12);border-radius:26px;background:linear-gradient(180deg,rgba(15,23,42,.95),rgba(6,10,24,.96))}
.apt-hero-tariff .nero-ai-window-top{display:flex;align-items:center;justify-content:space-between;gap:14px;padding:14px 16px;border-bottom:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.045)}
.apt-hero-tariff .nero-ai-dots{display:flex;gap:7px}
.apt-hero-tariff .nero-ai-dot{width:10px;height:10px;border-radius:50%}
.apt-hero-tariff .nero-ai-dot:nth-child(1){background:#fb7185}
.apt-hero-tariff .nero-ai-dot:nth-child(2){background:#fbbf24}
.apt-hero-tariff .nero-ai-dot:nth-child(3){background:#34d399}
.apt-hero-tariff .nero-ai-window-title{color:#cfe3f9;font-size:11px;font-weight:750;letter-spacing:.08em;text-transform:uppercase}
.apt-hero-tariff .nero-ai-window-body{padding:16px}
.apt-hero-tariff .nero-ai-dashboard-title{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;margin-bottom:12px}
.apt-hero-tariff .nero-ai-dashboard-title h3{margin:0;font-size:18px;letter-spacing:-.03em;color:#fff}
.apt-hero-tariff .nero-ai-live-pill{display:inline-flex;align-items:center;gap:7px;padding:6px 9px;border-radius:999px;background:rgba(34,197,94,.1);color:#bbf7d0;font-size:12px;font-weight:800}
.apt-hero-tariff .nero-ai-live-pill::before{content:"";width:7px;height:7px;border-radius:50%;background:#22c55e;box-shadow:0 0 0 6px rgba(34,197,94,.14);animation:aptPulse 1.6s infinite}
@keyframes aptPulse{0%,100%{transform:scale(.86);opacity:.65}50%{transform:scale(1);opacity:1}}
.apt-hero-tariff .nero-ai-metrics-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;margin-bottom:12px}
.apt-hero-tariff .nero-ai-metric{padding:12px;border:1px solid rgba(255,255,255,.09);border-radius:16px;background:rgba(255,255,255,.055)}
.apt-hero-tariff .nero-ai-metric span{display:block;color:var(--apt-hero-muted);font-size:11px;font-weight:700}
.apt-hero-tariff .nero-ai-metric strong{display:block;margin-top:5px;color:#fff;font-size:22px;line-height:1}
.apt-hero-tariff .nero-ai-metric small{display:block;margin-top:4px;color:#9fb0c9;font-size:11px}
.apt-hero-tariff .nero-ai-task-stream{display:grid;gap:8px}
.apt-hero-tariff .nero-ai-task{display:grid;grid-template-columns:28px 1fr auto;align-items:center;gap:10px;padding:10px;border:1px solid rgba(255,255,255,.08);border-radius:14px;background:rgba(255,255,255,.04)}
.apt-hero-tariff .nero-ai-task-icon{display:grid;place-items:center;width:28px;height:28px;border-radius:12px;background:rgba(121,242,255,.12);color:var(--apt-hero-cyan);font-size:13px;font-weight:800}
.apt-hero-tariff .nero-ai-task strong{display:block;color:#f8fafc;font-size:12px}
.apt-hero-tariff .nero-ai-task span{color:var(--apt-hero-muted);font-size:11px}
.apt-hero-tariff .nero-ai-status{padding:4px 8px;border-radius:999px;background:rgba(34,197,94,.11);color:#bbf7d0;font-size:10px;font-weight:800;white-space:nowrap}
@media(max-width:1100px){.apt-hero-tariff .nero-ai-hero-grid{grid-template-columns:1fr}.apt-hero-tariff .nero-ai-dashboard{transform:none}}
@media(max-width:520px){.apt-hero-tariff .nero-ai-dashboard{padding:10px;border-radius:24px}.apt-hero-tariff .nero-ai-window-body{padding:12px}.apt-hero-tariff .nero-ai-task{grid-template-columns:28px 1fr}.apt-hero-tariff .nero-ai-status{grid-column:2;width:fit-content}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-podbor-tarifa-page" role="main" tabindex="-1">

<!-- HERO: Алина -->
<section class="nero-ai-hero apt-hero-tariff" id="hero" aria-labelledby="apt-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow">Pricing page · RAG + rules</p>
      <h1 id="apt-hero-title">AI-агент для подбора тарифа: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Внедрим AI-консультанта на pricing page: объясняет разницу пакетов, рекомендует комплектацию под задачу клиента и ведёт к оплате или заявке в CRM — без путаницы и галлюцинаций в ценах.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры внедрения">
        <li class="nero-ai-badge">SaaS</li>
        <li class="nero-ai-badge">Телеком</li>
        <li class="nero-ai-badge">EdTech</li>
        <li class="nero-ai-badge">3–4 недели MVP</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url( $primary_cta_url ); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a class="nero-ai-btn nero-ai-btn-ghost" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-консультант на pricing page">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">pricing · tariff advisor · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-консультант на pricing page</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Конверсия</span><strong>+8–12%</strong><small>pricing page</small></div>
            <div class="nero-ai-metric"><span>Рекомендация</span><strong>Pro</strong><small>под задачу</small></div>
            <div class="nero-ai-metric"><span>Диалог</span><strong>5/6</strong><small>вопросов</small></div>
            <div class="nero-ai-metric"><span>CRM</span><strong>лид</strong><small>создан</small></div>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента диалога подбора тарифа">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">Q1</span><div><strong>Команда</strong><span>12 пользователей</span></div><span class="nero-ai-status">ответ</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">Q2</span><div><strong>Интеграции</strong><span>API + webhooks</span></div><span class="nero-ai-status">ответ</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Рекомендуем Pro</strong><span>лимиты и поддержка</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">CRM</span><div><strong>Лид в amoCRM</strong><span>тариф Pro · transcript</span></div><span class="nero-ai-status">новое</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="apt-content">

  <!-- Intro / коротко -->
  <section class="apt-intro" aria-label="Введение">
    <div class="apt-cnt">
      <div class="apt-intro-grid nero-ai-reveal">
        <div class="apt-intro-text">
          <p>Клиент открывает страницу тарифов, сравнивает три колонки с десятками фич и закрывает вкладку. <strong>AI подбор тарифа</strong> — способ перевести pricing page из режима «сам разберись» в режим «консультант объяснил и подсказал пакет под задачу».</p>
          <p><strong>Коротко:</strong> AI-консультант задаёт 3–7 вопросов, сравняет тарифы по утверждённой матрице (RAG + правила), рекомендует 1–2 пакета с обоснованием и ведёт к оплате или заявке в CRM.</p>
        </div>
        <div class="apt-intro-kpi">
          <div class="apt-kpi-card"><div class="kv">3–8%</div><div class="kl">типичная конверсия pricing</div></div>
          <div class="apt-kpi-card"><div class="kv">8–12%</div><div class="kl">best-in-class с AI</div></div>
          <div class="apt-kpi-card"><div class="kv">3–4 нед</div><div class="kl">MVP под ключ</div></div>
          <div class="apt-kpi-card"><div class="kv">RAG+rules</div><div class="kl">без галлюцинаций цен</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- #pochemu -->
  <section class="apt-section" id="pochemu" aria-labelledby="apt-h-pochemu">
    <div class="apt-cnt">
      <div class="apt-sh apt-left nero-ai-reveal">
        <h2 id="apt-h-pochemu">Почему клиенты путаются в тарифах и уходят без покупки</h2>
        <p>Боль: клиент путается в тарифах и покупает не то или не покупает вообще.</p>
      </div>
      <div class="apt-callout nero-ai-reveal nero-ai-delay-1">
        <div class="apt-callout-item"><strong>25–40%</strong><span>bounce на слабых pricing pages</span></div>
        <div class="apt-callout-item"><strong>3–8%</strong><span>конверсия visitor → purchase (SaaS)</span></div>
      </div>
      <p class="nero-ai-reveal nero-ai-delay-2">Статичная таблица сравнения не снимает когнитивную нагрузку — она переносит работу на клиента. Здесь помогает <strong>внедрение AI-консультанта</strong>: объясняет разницу пакетов и рекомендует комплектацию под задачу.</p>
    </div>
  </section>

  <!-- #kak-rabotaet -->
  <section class="apt-section apt-section-alt" id="kak-rabotaet" aria-labelledby="apt-h-kak">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-kak">Что такое AI-агент для подбора тарифа и как он работает</h2>
        <p>LLM объясняет человеческим языком, rule engine и RAG держат факты.</p>
      </div>
      <div class="apt-steps nero-ai-reveal nero-ai-delay-1">
        <div class="apt-step"><p>Посетитель открывает /pricing → CTA «Подобрать тариф за 2 минуты»</p></div>
        <div class="apt-step"><p>Агент задаёт 4–6 вопросов (команда, объём, интеграции, бюджет)</p></div>
        <div class="apt-step"><p>Rule engine фильтрует допустимые тарифы</p></div>
        <div class="apt-step"><p>LLM сравняет 2–3 пакета на основе retrieved chunks</p></div>
        <div class="apt-step"><p>CTA: «Оформить Pro» / «Оставить заявку»</p></div>
        <div class="apt-step"><p>Событие в CRM + UTM + transcript диалога</p></div>
        <div class="apt-step"><p>Эскалация при низком confidence — handoff человеку</p></div>
      </div>
    </div>
  </section>

  <!-- CTA #cta-kak-rabotaet -->
  <div class="apt-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-kak-rabotaet">
      <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Подобрать сценарий под вашу матрицу тарифов</p>
        <p class="ym-cta-block__sub">Разберём ветки SaaS, телеком, онлайн-школы или сервисных пакетов: от discovery до виджета на pricing page. Лид-магнит — «Матрица тарифов под AI-консультанта».</p>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>

  <!-- #dlya-kogo -->
  <section class="apt-section" id="dlya-kogo" aria-labelledby="apt-h-dlya">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-dlya">Для кого подходит внедрение AI-консультанта на странице тарифов</h2>
        <p>SaaS, телеком, онлайн-школы, сервисные компании.</p>
      </div>
      <div class="apt-grid-4 nero-ai-reveal nero-ai-delay-1">
        <div class="apt-card"><h3>SaaS</h3><p>Per-seat, tiered pricing, usage-based add-ons. Клиент не понимает Pro vs Enterprise.</p></div>
        <div class="apt-card"><h3>Телеком</h3><p>Пакеты минут, ГБ, семейные тарифы. Воспроизводимость рекомендаций критична.</p></div>
        <div class="apt-card"><h3>Онлайн-школы</h3><p>Сравнение пакетов: самостоятельный / с куратором / VIP. Ночные заходы без менеджера.</p></div>
        <div class="apt-card"><h3>Сервисы</h3><p>Юристы, клиники, агентства: пакеты «базовый / полный / сопровождение».</p></div>
      </div>
    </div>
  </section>

  <!-- ================================================
       БОРИС: блок после #dlya-kogo
       ================================================ -->
  <section id="boris-tariff-viz" class="aptb-root" aria-label="Анимация: AI-агент на pricing page рекомендует тариф Pro">
<style>
/* === БОРИС: prefix aptb-, scoped внутри #boris-tariff-viz === */
#boris-tariff-viz.aptb-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#boris-tariff-viz .aptb-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#boris-tariff-viz .aptb-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #boris-tariff-viz .aptb-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#boris-tariff-viz .aptb-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #boris-tariff-viz .aptb-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#boris-tariff-viz .aptb-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#6366f1;
  margin:0 0 14px;
}
#boris-tariff-viz .aptb-ey::before{
  content:'';
  width:18px;height:2px;
  background:#6366f1;
  border-radius:1px;
}
#boris-tariff-viz .aptb-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#boris-tariff-viz .aptb-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#boris-tariff-viz .aptb-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#boris-tariff-viz .aptb-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(99,102,241,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#6366f1;
  margin-top:1px;
  font-style:normal;
}
#boris-tariff-viz .aptb-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#boris-tariff-viz .aptb-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#boris-tariff-viz .aptb-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#boris-tariff-viz .aptb-pl-b{
  background:rgba(99,102,241,.08);
  color:#4338ca;
  border:1.5px solid rgba(99,102,241,.22);
}
#boris-tariff-viz .aptb-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#boris-tariff-viz .aptb-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#boris-tariff-viz .aptb-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0f4ff 0%,#e8f0fe 35%,#f5f3ff 70%,#fafafa 100%);
  min-height:440px;
  max-height:70vh;
  overflow:hidden;
}
@media(max-width:1023px){
  #boris-tariff-viz .aptb-rgt{min-height:380px;}
}
#aptb-tariff-pick-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="aptb-cnt">
  <div class="aptb-card">

    <div class="aptb-lft">
      <span class="aptb-ey">Pricing page · рекомендация</span>
      <h3 class="aptb-h3">Три колонки тарифов → AI задаёт вопросы → подсвечивает Pro и создаёт лид</h3>
      <ul class="aptb-ul">
        <li><span class="aptb-ic">?</span>Агент уточняет команду, объём и интеграции — не перечисляет всю таблицу</li>
        <li><span class="aptb-ic">⚡</span>Rule engine отсекает Basic (нет API) и Enterprise (избыточен)</li>
        <li><span class="aptb-ic">★</span>Динамический highlight «Рекомендуем Pro» — эффект Von Restorff +5–15%</li>
        <li><span class="aptb-ic">✓</span>CTA ведёт на checkout или заявку в CRM с transcript диалога</li>
      </ul>
      <div class="aptb-pills">
        <span class="aptb-pl aptb-pl-g">+8–12% конверсия</span>
        <span class="aptb-pl aptb-pl-b">5/6 вопросов</span>
        <span class="aptb-pl aptb-pl-v">CRM: лид создан</span>
      </div>
      <p class="aptb-foot">Дальше — чем AI-конфигуратор отличается от «простого чата» →</p>
    </div>

    <div class="aptb-rgt">
      <canvas
        id="aptb-tariff-pick-canvas"
        aria-label="Анимация: три колонки тарифов на pricing page, AI-агент рекомендует план Pro и передаёт лид в CRM"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('aptb-tariff-pick-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = Math.min(p.clientHeight || 480, window.innerHeight * 0.7);
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a', muted:'#64748b', line:'#e2e8f0',
    basic:'#94a3b8', basicBg:'#f1f5f9',
    pro:'#6366f1', proBg:'#eef2ff', proGlow:'rgba(99,102,241,.25)',
    ent:'#8b5cf6', entBg:'#f5f3ff',
    green:'#22c55e', greenBg:'rgba(34,197,94,.12)',
    ai:'#0ea5e9', aiBg:'rgba(14,165,233,.1)',
    crm:'#f59e0b', white:'#ffffff'
  };

  var PLANS = [
    { id:'basic', label:'Basic', price:'990 ₽', feats:['5 users','Email'], xOff:-1 },
    { id:'pro',   label:'Pro',   price:'2 490 ₽', feats:['25 users','API','CRM'], xOff:0, rec:true },
    { id:'ent',   label:'Enterprise', price:'9 900 ₽', feats:['∞ users','SLA'], xOff:1 }
  ];

  var QUESTIONS = [
    'Сколько человек в команде?',
    'Нужен API?',
    'Какой бюджет?'
  ];

  var LOOP = 480;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawPlan(col, prg, cx, top, colW, colH){
    var isPro = col.id === 'pro';
    var dim = false;
    var glow = 0;

    if(prg > 180 && prg < 320){
      if(col.id === 'basic' || col.id === 'ent') dim = true;
      if(isPro){
        var t = (prg - 180) / 140;
        glow = Math.min(1, t * 1.4);
      }
    }
    if(prg >= 320) dim = !isPro;

    var alpha = dim ? 0.35 : 1;
    var bg = col.id === 'basic' ? C.basicBg : (isPro ? C.proBg : C.entBg);
    var accent = col.id === 'basic' ? C.basic : (isPro ? C.pro : C.ent);

    ctx.globalAlpha = alpha;

    if(isPro && glow > 0){
      ctx.shadowColor = C.proGlow;
      ctx.shadowBlur = 18 * glow;
    } else {
      ctx.shadowBlur = 0;
    }

    rr(cx - colW/2, top, colW, colH, 12, bg, isPro && glow > 0.5 ? C.pro : C.line, isPro && glow > 0.5 ? 2.5 : 1);

    ctx.shadowBlur = 0;

    /* Recommended badge */
    if(isPro && prg > 200){
      var badgeA = Math.min(1, (prg - 200) / 40);
      ctx.globalAlpha = alpha * badgeA;
      rr(cx - 52, top - 14, 104, 22, 11, C.green, null, 0);
      ctx.fillStyle = '#fff';
      ctx.font = 'bold 10px Inter,system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('Рекомендуем', cx, top - 1);
    }

    ctx.globalAlpha = alpha;
    ctx.fillStyle = accent;
    ctx.font = 'bold 13px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(col.label, cx, top + 22);

    ctx.fillStyle = C.ink;
    ctx.font = 'bold 16px Inter,sans-serif';
    ctx.fillText(col.price, cx, top + 44);

    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    col.feats.forEach(function(f, i){
      ctx.fillText('• ' + f, cx, top + 64 + i * 16);
    });

    ctx.globalAlpha = 1;
  }

  function drawAgent(prg){
    if(prg < 40 || prg > 175) return;
    var t = (prg - 40) / 135;
    var ax = W * 0.5;
    var ay = H * 0.12 + Math.sin(frame * 0.04) * 3;

    /* Bubble */
    var qIdx = Math.floor(t * QUESTIONS.length) % QUESTIONS.length;
    var qText = QUESTIONS[qIdx];

    ctx.fillStyle = C.aiBg;
    rr(ax - 110, ay - 28, 220, 36, 14, C.aiBg, 'rgba(14,165,233,.3)', 1.5);
    ctx.fillStyle = C.ink;
    ctx.font = '11px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(qText, ax, ay - 6);

    /* AI avatar */
    ctx.beginPath();
    ctx.arc(ax, ay + 30, 14, 0, Math.PI * 2);
    ctx.fillStyle = C.ai;
    ctx.fill();
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.fillText('AI', ax, ay + 34);

    /* Connector lines to columns */
    if(prg > 80){
      var la = Math.min(1, (prg - 80) / 50);
      ctx.globalAlpha = la * 0.4;
      ctx.strokeStyle = C.ai;
      ctx.lineWidth = 1;
      ctx.setLineDash([4,4]);
      PLANS.forEach(function(pl){
        var px = W * (0.5 + pl.xOff * 0.28);
        ctx.beginPath();
        ctx.moveTo(ax, ay + 44);
        ctx.lineTo(px, H * 0.32);
        ctx.stroke();
      });
      ctx.setLineDash([]);
      ctx.globalAlpha = 1;
    }
  }

  function drawCrm(prg){
    if(prg < 340) return;
    var t = Math.min(1, (prg - 340) / 60);
    var bx = W * 0.72;
    var by = H * 0.78;

    ctx.globalAlpha = t;
    rr(bx - 70, by - 22, 140, 44, 10, C.white, C.crm, 2);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('✓ Лид в CRM', bx, by - 4);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText('Тариф: Pro · UTM сохранён', bx, by + 10);

    /* Arrow from Pro column */
    if(t > 0.3){
      var proX = W * 0.5;
      var proY = H * 0.32 + 130;
      ctx.strokeStyle = C.green;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(proX + 20, proY);
      ctx.quadraticCurveTo(proX + 60, proY + 40, bx - 30, by - 24);
      ctx.stroke();
    }
    ctx.globalAlpha = 1;
  }

  function draw(){
    ctx.clearRect(0, 0, W, H);

    /* Page chrome */
    rr(16, 12, W - 32, 28, 8, C.white, C.line, 1);
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('your-saas.com/pricing', 28, 30);

    var prg = frame % LOOP;
    var colW = Math.min(100, W * 0.22);
    var colH = 130;
    var top = H * 0.32;

    PLANS.forEach(function(pl){
      var cx = W * (0.5 + pl.xOff * 0.28);
      drawPlan(pl, prg, cx, top, colW, colH);
    });

    drawAgent(prg);
    drawCrm(prg);

    frame++;
    requestAnimationFrame(draw);
  }

  draw();
})();
</script>
  </section>
  <!-- /БОРИС -->

  <!-- #konfigurator -->
  <section class="apt-section apt-section-alt" id="konfigurator" aria-labelledby="apt-h-konf">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-konf">AI-конфигуратор услуг и подбор комплектации — в чём разница с «простым чатом»</h2>
      </div>
      <div class="apt-table-wrap nero-ai-reveal nero-ai-delay-1">
        <table class="apt-table">
          <thead>
            <tr><th>Подход</th><th>Что делает</th><th>Риск</th><th class="apt-col-highlight">AI конфигуратор</th></tr>
          </thead>
          <tbody>
            <tr><td>FAQ-чат</td><td>Шаблонные ответы</td><td>Не рекомендует пакет</td><td class="apt-col-highlight">—</td></tr>
            <tr><td>Pure LLM</td><td>«Умный» диалог</td><td>Галлюцинации цен</td><td class="apt-col-highlight">—</td></tr>
            <tr><td>CPQ без AI</td><td>Rule-based расчёт</td><td>Сухой UX</td><td class="apt-col-highlight">—</td></tr>
            <tr><td><strong>AI конфигуратор</strong></td><td>Диалог + RAG + rules</td><td>Контролируемый</td><td class="apt-col-highlight"><strong>Объясняет, рекомендует, CRM</strong></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- #sostav -->
  <section class="apt-section" id="sostav" aria-labelledby="apt-h-sostav">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-sostav">Что входит во внедрение AI подбора тарифа под ключ</h2>
      </div>
      <div class="apt-timeline nero-ai-reveal nero-ai-delay-1">
        <div class="apt-tl-item"><span class="apt-tl-dot"></span><h3>Аудит матрицы тарифов</h3><p>Discovery 3–5 дней: таблица «вопрос → ветка → пакет».</p></div>
        <div class="apt-tl-item"><span class="apt-tl-dot"></span><h3>Логика рекомендаций</h3><p>Rule engine: жёсткие if/then поверх LLM.</p></div>
        <div class="apt-tl-item"><span class="apt-tl-dot"></span><h3>RAG на ваших тарифах</h3><p>Тарифы, FAQ, типовые возражения.</p></div>
        <div class="apt-tl-item"><span class="apt-tl-dot"></span><h3>Запуск на pricing page</h3><p>MVP виджета 1–2 недели, QA + disclaimer.</p></div>
      </div>
    </div>
  </section>

  <!-- #integracii -->
  <section class="apt-section apt-section-alt" id="integracii" aria-labelledby="apt-h-int">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-int">Интеграции: CRM, биллинг и заявка после рекомендации</h2>
      </div>
      <div class="apt-grid-2 nero-ai-reveal nero-ai-delay-1" style="grid-template-columns:repeat(3,1fr)">
        <div class="apt-card"><h3>amoCRM</h3><p>Сделка с полями: рекомендованный тариф, transcript, UTM.</p></div>
        <div class="apt-card"><h3>Stripe · ЮKassa</h3><p>Deep link на checkout выбранного плана после рекомендации.</p></div>
        <div class="apt-card"><h3>Аналитика</h3><p>События: started, recommended_plan, converted, escalated.</p></div>
      </div>
    </div>
  </section>

  <!-- #riski -->
  <section class="apt-section" id="riski" aria-labelledby="apt-h-riski">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-riski">Риски и ограничения: как не навредить конверсии</h2>
      </div>
      <div class="apt-warn nero-ai-reveal nero-ai-delay-1">
        <h3>Pricing hallucination — отдельный класс риска</h3>
        <p>Неверная цена или несуществующая скидка. Прецедент Air Canada (2024): компания обязана выполнить обещание чатбота. RAG снижает, но не устраняет риск — нужны rule engine, disclaimer и human handoff.</p>
      </div>
    </div>
  </section>

  <!-- #keisy -->
  <section class="apt-section apt-section-alt" id="keisy" aria-labelledby="apt-h-keisy">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-keisy">Примеры внедрения и кейсы AI-конфигураторов</h2>
      </div>
      <div class="apt-case-cols nero-ai-reveal nero-ai-delay-1">
        <div>
          <h3 style="color:var(--apt-accent);font-size:14px;margin-bottom:16px">Россия</h3>
          <div class="apt-card" style="margin-bottom:12px"><h3>Configo</h3><p>Три пакета с обоснованием из ТЗ.</p></div>
          <div class="apt-card" style="margin-bottom:12px"><h3>MWS AI</h3><p>Бенчмарк «консультант по тарифам».</p></div>
          <div class="apt-card"><h3>BotHelp</h3><p>Онлайн-школы, тарифы и оплата.</p></div>
        </div>
        <div>
          <h3 style="color:var(--apt-green);font-size:14px;margin-bottom:16px">Международные</h3>
          <div class="apt-card" style="margin-bottom:12px"><h3>xpay</h3><p>AI Pricing Page Widget.</p></div>
          <div class="apt-card" style="margin-bottom:12px"><h3>Zoovu</h3><p>AI-Guided Selling.</p></div>
          <div class="apt-card"><h3>ChatNexus</h3><p><span style="font-size:11px;opacity:.7">кейс вендора</span> +22% self-serve conversions.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- #ceny -->
  <section class="apt-section" id="ceny" aria-labelledby="apt-h-ceny">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-ceny">Сколько стоит внедрение AI для подбора тарифа</h2>
      </div>
      <div class="apt-price-band nero-ai-reveal nero-ai-delay-1">
        <p style="margin:0;color:var(--apt-muted)">MVP под ключ · 3–4 недели</p>
        <div class="apt-price">100–280 тыс. ₽</div>
        <p style="margin:0;color:var(--apt-muted);font-size:14px">Матрица, виджет, RAG + rules, CRM, запуск на pricing page</p>
      </div>
    </div>
  </section>

  <!-- CTA #cta-ceny -->
  <div class="apt-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет внедрения AI подбора тарифа</p>
        <p class="ym-cta-block__sub">Ориентир 100–280 тыс. ₽ за MVP под ключ (3–4 недели). На созвоне оценим сложность матрицы, интеграции с CRM и billing — без обязательств.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
          <a href="#faq" class="nero-ai-btn nero-ai-btn-ghost">Вопросы и сроки</a>
        </div>
      </div>
    </div>
  </div>

  <!-- #faq -->
  <section class="apt-section apt-section-alt" id="faq" aria-labelledby="apt-h-faq">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-faq">FAQ: частые вопросы о внедрении AI-агента для тарифов</h2>
      </div>
      <div class="apt-faq nero-ai-reveal nero-ai-delay-1">
        <details class="apt-faq-item" open>
          <summary>Можно ли внедрить без программиста?</summary>
          <div class="apt-faq-body"><p>Make.com, n8n, готовый виджет, матрица в Sheets — без кода на старте. Программист нужен для глубоких интеграций (billing, on-prem). Основной блокер — готовая матрица тарифов.</p></div>
        </details>
        <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
          <div class="ym-cta-block__body">
            <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации сами?</p>
            <p class="ym-cta-block__sub">Для MVP без программиста достаточно матрицы в Sheets и готового виджета — но глубокие интеграции с billing и on-prem проще согласовать, когда команда понимает n8n, промпты и human-in-the-loop. Посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a>.</p>
          </div>
        </aside>
        <details class="apt-faq-item">
          <summary>Сколько занимает запуск?</summary>
          <div class="apt-faq-body"><p>Discovery 3–5 дней → MVP 1–2 недели → RAG + rules 1 неделя → CRM 3–5 дней → QA 2–3 дня. Итого 3–4 недели.</p></div>
        </details>
        <details class="apt-faq-item">
          <summary>Нужна ли доработка pricing page?</summary>
          <div class="apt-faq-body"><p>Минимально: embed виджета, CTA «Подобрать тариф». Полный редизайн не обязателен.</p></div>
        </details>
        <details class="apt-faq-item">
          <summary>Как измерить рост конверсии?</summary>
          <div class="apt-faq-body"><p>A/B: pricing с агентом vs без. Метрики: bounce, conversion, доля «не тех» тарифов в поддержке.</p></div>
        </details>
      </div>
    </div>
  </section>

  <!-- #scenario -->
  <section class="apt-section" id="scenario" aria-labelledby="apt-h-scenario">
    <div class="apt-cnt">
      <div class="apt-sh nero-ai-reveal">
        <h2 id="apt-h-scenario">Подобрать сценарий внедрения под вашу матрицу тарифов</h2>
        <p>Salesforce State of Sales 2026: AI-агенты — тактика роста №1 для sales-команд.</p>
      </div>
      <ul class="apt-cta-checklist nero-ai-reveal nero-ai-delay-1">
        <li>Актуальная таблица тарифов</li>
        <li>FAQ и возражения</li>
        <li>Правила эскалации</li>
        <li>Ссылки checkout / заявок</li>
        <li>Бренд-тон</li>
        <li>Доступ к CRM API</li>
        <li>Юридический disclaimer</li>
      </ul>
      <div style="text-align:center" class="nero-ai-reveal nero-ai-delay-2">
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </section>

  <!-- AD_BANNER: not configured -->

</div><!-- /.apt-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>

<script>
(function(){
  var els = document.querySelectorAll('.nero-ai-reveal');
  if (!els.length || !('IntersectionObserver' in window)) {
    els.forEach(function(el){ el.classList.add('nero-ai-active'); });
    return;
  }
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if (e.isIntersecting) { e.target.classList.add('nero-ai-active'); io.unobserve(e.target); }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
  els.forEach(function(el){ io.observe(el); });
})();
</script>

<?php get_footer(); ?>
