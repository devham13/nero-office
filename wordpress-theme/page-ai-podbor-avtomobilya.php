<?php
/**
 * Template Name: AI-агент для подбора автомобиля: внедрение под ключ
 * Description: SEO-лендинг — ai подбор автомобиля для дилеров. Квиз, CRM, кейсы. Внедрение под ключ.
 */

$page_seo_title       = 'AI подбор автомобиля для дилеров — внедрение под ключ';
$page_seo_description = 'AI-агент подбирает авто по бюджету и задачам, собирает бриф и передаёт менеджеру. Внедрение под ключ для дилеров: квиз, CRM, кейсы. Ориентир 180–600 тыс. ₽.';

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
	[ 'label' => 'Квиз',           'href' => '#kviz' ],
	[ 'label' => 'Внедрение',      'href' => '#vnedrenie' ],
	[ 'label' => 'CRM',            'href' => '#crm' ],
	[ 'label' => 'Кейсы',          'href' => '#keisy' ],
	[ 'label' => 'Стоимость',      'href' => '#ceny' ],
	[ 'label' => 'FAQ',            'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Собрать автоагента';
$primary_cta_url   = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '';

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

.apa-content{
  --apa-bg:#050711;--apa-bg2:#080b17;
  --apa-surface:rgba(255,255,255,.072);--apa-text:#e6edf7;--apa-muted:#9aa8bd;--apa-soft:#c7d2e5;--apa-heading:#fff;
  --apa-border:rgba(255,255,255,.10);
  --apa-accent:#79f2ff;--apa-violet:#8b5cf6;--apa-green:#22c55e;--apa-amber:#f59e0b;
  --apa-btn-from:#2563eb;--apa-btn-to:#7c3aed;
  --apa-r:18px;--apa-r-lg:24px;--apa-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--apa-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.apa-content *,.apa-content *::before,.apa-content *::after{box-sizing:border-box}
.apa-content a{color:inherit;text-decoration:none}
.apa-content p{color:var(--apa-muted);line-height:1.72;margin:0 0 1em}
.apa-content p:last-child{margin-bottom:0}
.apa-content h2,.apa-content h3,.apa-content h4{color:var(--apa-heading);letter-spacing:-.045em;margin:0 0 .7em}
.apa-content strong{color:var(--apa-soft)}
.apa-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.apa-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apa-muted);font-size:14.5px;line-height:1.65}
.apa-content ul li::before{content:'›';position:absolute;left:0;color:var(--apa-accent);font-weight:700}
.apa-cnt{width:min(var(--apa-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.apa-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.apa-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.apa-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.apa-sh.apa-left{margin-left:0;text-align:left}
.apa-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.apa-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.apa-sh.apa-left p{margin-left:0}
.apa-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apa-accent);margin-bottom:14px}
.apa-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.apa-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.apa-intro-text{position:relative;padding-left:20px}
.apa-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apa-accent),var(--apa-violet))}
.apa-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.apa-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.apa-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--apa-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.apa-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apa-muted);line-height:1.4}
.apa-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.apa-intro-grid{grid-template-columns:1fr;gap:36px}.apa-intro-kpi{grid-template-columns:repeat(2,1fr)}}
.apa-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apa-border);border-radius:var(--apa-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.apa-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.apa-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:768px){.apa-grid-2{grid-template-columns:1fr}}
.apa-flow{display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:8px 12px;padding:24px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:var(--apa-r);font-size:13px;font-weight:600;color:var(--apa-soft)}
.apa-flow .arr{color:var(--apa-accent);font-weight:400}
.apa-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09)}
.apa-table{width:100%;border-collapse:collapse;font-size:14px}
.apa-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--apa-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.apa-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apa-text);vertical-align:top}
.apa-table tr:last-child td{border-bottom:none}
.apa-mono{background:#0a0e1c;border:1px solid rgba(34,197,94,.25);border-radius:14px;padding:20px 24px;font-family:'SF Mono',Consolas,monospace;font-size:12.5px;line-height:1.65;color:#a7f3d0;overflow-x:auto;white-space:pre-wrap;margin:24px 0}
.apa-mono .tag{color:var(--apa-green);font-weight:700}
.apa-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-top:28px}
@media(max-width:960px){.apa-steps{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.apa-steps{grid-template-columns:1fr}}
.apa-step{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:20px 18px;position:relative}
.apa-step-num{width:32px;height:32px;border-radius:50%;background:rgba(121,242,255,.15);border:1px solid rgba(121,242,255,.3);display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:800;color:var(--apa-accent);margin-bottom:12px}
.apa-step h4{font-size:15px;margin-bottom:6px}
.apa-step p{font-size:13px;margin:0}
.apa-timeline{position:relative;padding-left:40px}
.apa-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--apa-accent),var(--apa-violet));opacity:.35;border-radius:2px}
.apa-tl-item{position:relative;margin-bottom:32px}
.apa-tl-item:last-child{margin-bottom:0}
.apa-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--apa-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.apa-tl-item h3{font-size:17px;margin-bottom:8px}
.apa-tl-item p{font-size:14.5px;margin:0}
.apa-logos{display:flex;flex-wrap:wrap;gap:12px;margin:24px 0}
.apa-logo{padding:10px 18px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:10px;font-size:13px;font-weight:700;color:var(--apa-soft)}
.apa-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--apa-r);padding:26px;margin-bottom:14px}
.apa-scenario:last-child{margin-bottom:0}
.apa-scenario h3{font-size:17px;margin-bottom:8px}
.apa-scenario p{font-size:14.5px;margin:0}
.apa-trust{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;padding:28px 0}
.apa-trust span{padding:8px 16px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:12px;font-weight:700;color:var(--apa-muted)}
.apa-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.apa-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.apa-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--apa-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.apa-faq-q::after{content:'▾';font-size:13px;color:var(--apa-accent);flex-shrink:0;transition:transform .25s}
.apa-faq-item.open .apa-faq-q::after{transform:rotate(180deg)}
.apa-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--apa-muted);line-height:1.72}
.apa-faq-item.open .apa-faq-a{max-height:800px;padding:0 24px 20px}
.apa-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.apa-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--apa-muted)}
.apa-cta-checklist li::before{content:'✓';color:var(--apa-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--apa-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--apa-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--apa-btn-from),var(--apa-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
/* === БОРИС: prefix apb- === */
#ai-podbor-avtomobilya-boris-block.apb-root{padding:48px 0 56px;background:#f8fafc}
#ai-podbor-avtomobilya-boris-block .apb-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#ai-podbor-avtomobilya-boris-block .apb-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px}
@media(max-width:1023px){#ai-podbor-avtomobilya-boris-block .apb-card{grid-template-columns:1fr;min-height:auto}}
#ai-podbor-avtomobilya-boris-block .apb-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0}
@media(max-width:1023px){#ai-podbor-avtomobilya-boris-block .apb-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}}
#ai-podbor-avtomobilya-boris-block .apb-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#f59e0b;margin:0 0 14px}
#ai-podbor-avtomobilya-boris-block .apb-ey::before{content:'';width:18px;height:2px;background:#f59e0b;border-radius:1px}
#ai-podbor-avtomobilya-boris-block .apb-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px}
#ai-podbor-avtomobilya-boris-block .apb-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px}
#ai-podbor-avtomobilya-boris-block .apb-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155}
#ai-podbor-avtomobilya-boris-block .apb-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(245,158,11,.12);display:flex;align-items:center;justify-content:center;font-size:11px;color:#d97706;margin-top:1px;font-style:normal}
#ai-podbor-avtomobilya-boris-block .apb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px}
#ai-podbor-avtomobilya-boris-block .apb-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#ai-podbor-avtomobilya-boris-block .apb-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#ai-podbor-avtomobilya-boris-block .apb-pl-a{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22)}
#ai-podbor-avtomobilya-boris-block .apb-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22)}
#ai-podbor-avtomobilya-boris-block .apb-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#ai-podbor-avtomobilya-boris-block .apb-rgt{position:relative;background:linear-gradient(135deg,#fffbeb 0%,#fef3c7 18%,#f0f9ff 55%,#f8fafc 100%);min-height:420px;overflow:hidden}
@media(max-width:1023px){#ai-podbor-avtomobilya-boris-block .apb-rgt{min-height:360px}}
#apa-avto-brief-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}

.apa-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--apa-muted);margin-bottom:1em}
.apa-intro-text p:last-child{margin-bottom:0;color:var(--apa-soft)}
.apa-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.apa-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.apa-toc a{display:inline-block;padding:9px 18px;background:var(--apa-surface);border:1px solid var(--apa-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--apa-muted);transition:border-color .2s,color .2s,background .2s}
.apa-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--apa-accent);background:rgba(121,242,255,.08)}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3)}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
</style>

<main id="primary" class="site-main nero-ai-home-page apa-page" role="main" tabindex="-1">

<section class="nero-ai-hero apa-hero-avto" id="hero" aria-labelledby="apa-hero-title">
<style>
/* ── Hero ai-podbor-avtomobilya: самодостаточные стили (без CSS темы) ── */
.apa-hero-avto {
  --apa-cyan: #79f2ff;
  --apa-violet: #8b5cf6;
  --apa-green: #22c55e;
  --apa-amber: #f59e0b;
  --apa-text: #e6edf7;
  --apa-muted: #9aa8bd;
  --apa-soft: #c7d2e5;
  --apa-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.apa-hero-avto::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 26%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.apa-hero-avto::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 620px;
  height: 620px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121,242,255,.12), transparent 66%);
  filter: blur(8px);
  animation: apaHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes apaHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.apa-hero-avto .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.apa-hero-avto .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.apa-hero-avto .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.apa-hero-avto .nero-ai-gradient-text {
  display: block;
  margin-top: .08em;
  background: linear-gradient(92deg, #fff 0%, var(--apa-cyan) 44%, var(--apa-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.apa-hero-avto .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121,242,255,.22);
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  color: var(--apa-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.apa-hero-avto .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--apa-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.apa-hero-avto .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.apa-hero-avto .nero-ai-badge {
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
.apa-hero-avto .apa-hero-steps {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 18px 0 0;
  padding: 0;
  list-style: none;
}
.apa-hero-avto .apa-hero-step {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 7px 12px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
  color: var(--apa-muted);
  font-size: 12px;
  font-weight: 700;
}
.apa-hero-avto .apa-hero-step span {
  display: grid;
  place-items: center;
  width: 22px;
  height: 22px;
  border-radius: 8px;
  background: linear-gradient(135deg, rgba(121,242,255,.22), rgba(139,92,246,.22));
  color: var(--apa-cyan);
  font-size: 11px;
  font-weight: 900;
}
.apa-hero-avto .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 30px;
}
.apa-hero-avto .nero-ai-btn {
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
.apa-hero-avto .nero-ai-btn:hover { transform: translateY(-2px); }
.apa-hero-avto .nero-ai-btn-primary {
  color: #050711 !important;
  background: linear-gradient(135deg, var(--apa-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.18);
}
.apa-hero-avto .nero-ai-btn-secondary {
  color: var(--apa-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.apa-hero-avto .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--apa-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.apa-hero-avto .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.apa-hero-avto .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.apa-hero-avto .nero-ai-dots { display: flex; gap: 7px; }
.apa-hero-avto .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.apa-hero-avto .nero-ai-dot:nth-child(1) { background: #fb7185; }
.apa-hero-avto .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.apa-hero-avto .nero-ai-dot:nth-child(3) { background: #34d399; }
.apa-hero-avto .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.apa-hero-avto .nero-ai-window-body { padding: 16px; }
.apa-hero-avto .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.apa-hero-avto .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.apa-hero-avto .nero-ai-live-pill {
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
.apa-hero-avto .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: apaPulse 1.6s infinite;
}
@keyframes apaPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.apa-hero-avto .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.apa-hero-avto .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.apa-hero-avto .nero-ai-metric span {
  display: block;
  color: var(--apa-muted);
  font-size: 11px;
  font-weight: 700;
}
.apa-hero-avto .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.apa-hero-avto .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.apa-hero-avto .apa-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.16);
  background: radial-gradient(ellipse at 28% 42%, rgba(121,242,255,.08), rgba(6,10,24,.92) 72%);
}
.apa-hero-avto #apa-avto-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.apa-hero-avto .nero-ai-task-stream { display: grid; gap: 8px; }
.apa-hero-avto .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.apa-hero-avto .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--apa-cyan);
  font-size: 11px;
  font-weight: 800;
}
.apa-hero-avto .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.apa-hero-avto .nero-ai-task span {
  color: var(--apa-muted);
  font-size: 11px;
}
.apa-hero-avto .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.apa-hero-avto .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.apa-hero-avto .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .apa-hero-avto .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .apa-hero-avto .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .apa-hero-avto .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .apa-hero-avto .nero-ai-window-body { padding: 12px; }
  .apa-hero-avto .nero-ai-task { grid-template-columns: 28px 1fr; }
  .apa-hero-avto .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai автодилер</p>
      <h1 id="apa-hero-title">AI-агент для подбора автомобиля:<span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Квиз по бюджету и задачам клиента — AI собирает бриф и передаёт менеджеру готовую заявку, пока вы не теряете лиды в очереди</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Квиз 24/7</li>
        <li class="nero-ai-badge">RAG по стоку</li>
        <li class="nero-ai-badge">Бриф в CRM</li>
        <li class="nero-ai-badge">Avito / TG</li>
        <li class="nero-ai-badge">Anti-hallucination</li>
        <li class="nero-ai-badge">152-ФЗ</li>
        <li class="nero-ai-badge">amoCRM / Bitrix24</li>
      </ul>
      <ol class="apa-hero-steps" aria-label="Этапы подбора">
        <li class="apa-hero-step"><span>1</span> Канал</li>
        <li class="apa-hero-step"><span>2</span> Квиз</li>
        <li class="apa-hero-step"><span>3</span> Подбор</li>
        <li class="apa-hero-step"><span>4</span> Бриф</li>
        <li class="apa-hero-step"><span>5</span> CRM</li>
      </ol>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Собрать автоагента'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-подбора автомобиля">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>автоагент · демо подбора</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Входящие заявки</span>
              <strong>47</strong>
              <small>Avito · сайт · Telegram</small>
            </div>
            <div class="nero-ai-metric">
              <span>Средний ответ</span>
              <strong>3 сек</strong>
              <small>квиз + уточнение</small>
            </div>
            <div class="nero-ai-metric">
              <span>Брифов сегодня</span>
              <strong>18</strong>
              <small>с транскриптом</small>
            </div>
            <div class="nero-ai-metric">
              <span>Лиды A-приоритет</span>
              <strong>6</strong>
              <small>срок ≤ 2 нед.</small>
            </div>
          </div>

          <div class="apa-dash-canvas-wrap">
            <canvas id="apa-avto-hero-canvas" role="img" aria-label="Анимация: заявки с каналов проходят квиз, AI подбирает авто из стока и передаёт бриф в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий подбора">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AV</span>
              <div><strong>Avito: семейный кроссовер</strong><span>запрос принят · канал Avito</span></div>
              <span class="nero-ai-status nero-ai-status--amber">новый</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI уточняет бюджет</strong><span>до 2,8 млн · дача · trade-in</span></div>
              <span class="nero-ai-status">квиз</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">3×</span>
              <div><strong>3 авто из стока</strong><span>Tiggo 8 · Jolion · Dargo — в наличии</span></div>
              <span class="nero-ai-status">подбор</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Бриф в amoCRM</strong><span>приоритет A · транскрипт диалога</span></div>
              <span class="nero-ai-status nero-ai-status--violet">бриф</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Уведомление менеджеру</strong><span>push · Telegram · дежурный РОП</span></div>
              <span class="nero-ai-status">отправлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="apa-content">

  <section class="apa-intro" id="intro" aria-label="Введение">
    <div class="apa-cnt">
      <div class="apa-intro-grid nero-ai-reveal">
        <div class="apa-intro-text">
          <p class="apa-eyebrow">Лонгрид · ai подбор автомобиля</p>
          <p><strong>Коротко:</strong> AI-агент для подбора автомобиля — виртуальный консультант первой линии, который принимает запрос на естественном языке, уточняет бюджет и задачи клиента, подбирает 2–5 вариантов из актуального стока дилера и передаёт менеджеру готовый бриф в CRM. Это не «чат-бот с кнопками», а инструмент квалификации лидов, который работает 24/7.</p>
          <!-- INTERNAL-LINKS:INSERT -->
          <p>Покупатель уже привык к диалоговому подбору на «Авто.ру AI» и в «СберАвто». Дилеру нужен <strong>свой</strong> автоагент на <strong>своём</strong> складе — с передачей лида в CRM, а не удержанием клиента на маркетплейсе. Nero Network внедряет такие решения под ключ: от квиза на сайте до интеграции с amoCRM, Bitrix24 и отраслевыми DMS.</p>
        </div>
        <div class="apa-intro-kpi" aria-label="Ключевые метрики">
          <div class="apa-kpi-card"><div class="kv">2/3</div><div class="kl">покупателей выбирают 1–3 мес.</div><div class="ks">Авто.ру</div></div>
          <div class="apa-kpi-card"><div class="kv">20–30%</div><div class="kl">лидов без ответа за час</div><div class="ks">BotKraft, 2026</div></div>
          <div class="apa-kpi-card"><div class="kv">15–20</div><div class="kl">минут на первичный опрос</div><div class="ks">без AI-агента</div></div>
          <div class="apa-kpi-card"><div class="kv">24/7</div><div class="kl">диалог и бриф в CRM</div><div class="ks">с AI-агентом</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="apa-toc-outer">
    <div class="apa-cnt">
      <nav class="apa-toc nero-ai-reveal" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#kviz">Квиз</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#crm">CRM</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="apa-section" id="kak-rabotaet">
    <div class="apa-cnt">
      <div class="apa-sh apa-left nero-ai-reveal">
        <span class="apa-eyebrow">Боль дилера</span>
        <h2>Почему дилеру нужен AI-агент подбора автомобиля</h2>
        <p>Автодилерство в 2026 году — это гонка за внимание покупателя, который сравнивает десятки моделей, пишет в мессенджеры ночью и ожидает ответа за секунды, а не «утром перезвоним».</p>
      </div>

      <div class="apa-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="apa-card">
          <h3>Сколько заявок теряется, пока клиент «думает»</h3>
          <p>По данным «Авто.ру», у <strong>двух третей</strong> покупателей выбор марки и модели занимает <strong>от одного до трёх месяцев</strong>. Типичная боль: <strong>клиент долго выбирает, менеджер не успевает обработать все обращения</strong>. Без связки бота с CRM <strong>20–30% лидов</strong> не доходят до менеджера в течение часа.</p>
        </div>
        <div class="apa-card">
          <h3>Чем AI-агент отличается от обычного чат-бота</h3>
          <ul>
            <li>Принимает запрос на естественном языке в чате, Telegram, Avito, VK</li>
            <li>Ищет варианты <strong>только в актуальном каталоге</strong> дилера</li>
            <li>Формирует бриф с приоритетом A/B/C и передаёт в CRM</li>
            <li>Эскалирует на менеджера при нестандартных вопросах</li>
          </ul>
          <p style="margin-top:12px;font-size:14px">«СберАвто» (2025): <strong>«поиск по фильтрам уходит в прошлое»</strong> — покупатель хочет диалог.</p>
        </div>
      </div>

      <div class="apa-sh nero-ai-reveal" style="margin-top:56px">
        <span class="apa-eyebrow">Пайплайн</span>
        <h2>Как работает AI подбор автомобиля по бюджету и задачам</h2>
        <p>Ядро услуги — <strong>ai подбор автомобиля</strong> как управляемый процесс: от первого сообщения клиента до карточки сделки в CRM.</p>
      </div>

      <div class="apa-flow nero-ai-reveal" aria-label="Схема: 6 шагов от запроса до брифа">
        <span>Запрос клиента</span><span class="arr">→</span>
        <span>Уточнение 3–5 параметров</span><span class="arr">→</span>
        <span>RAG по стоку</span><span class="arr">→</span>
        <span>2–3 варианта из наличия</span><span class="arr">→</span>
        <span>Контакт</span><span class="arr">→</span>
        <span>Бриф в CRM</span>
      </div>

      <section id="ai-podbor-avtomobilya-boris-block" class="apb-root" aria-label="Анимация: диалог клиента, подбор из стока и бриф в CRM">
        <div class="apb-cnt">
          <div class="apb-card">
            <div class="apb-lft">
              <span class="apb-ey">Пайплайн подбора</span>
              <h3 class="apb-h3">Диалог → 3 авто из стока → готовый бриф менеджеру</h3>
              <ul class="apb-ul">
                <li><span class="apb-ic">1</span>Клиент пишет «семейный кроссовер до 2,5 млн» — AI уточняет бюджет и задачу</li>
                <li><span class="apb-ic">2</span>RAG ищет только в live-стоке дилера — без галлюцинаций про несуществующие VIN</li>
                <li><span class="apb-ic">3</span>Показывает 2–3 варианта с ценой и статусом «в наличии»</li>
                <li><span class="apb-ic">→</span>Бриф с приоритетом A уходит в amoCRM / Bitrix24 — менеджер звонит с контекстом</li>
              </ul>
              <div class="apb-pills">
                <span class="apb-pl apb-pl-g">Приоритет A</span>
                <span class="apb-pl apb-pl-a">RAG по стоку</span>
                <span class="apb-pl apb-pl-b">24/7 бриф</span>
              </div>
              <p class="apb-foot">Дальше — какие параметры собирает агент в квизе →</p>
            </div>
            <div class="apb-rgt">
              <canvas id="apa-avto-brief-canvas" aria-label="Анимация: клиент описывает задачу, AI подбирает автомобили из стока и формирует бриф в CRM" role="img"></canvas>
            </div>
          </div>
        </div>
      </section>

      <div class="nero-ai-reveal" style="margin-top:48px">
        <h3>Сценарий диалога: от первого вопроса до готового брифа</h3>
        <div class="apa-timeline" style="margin-top:24px">
          <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>1. Запрос</h3><p>Клиент пишет: «Что есть до 2,5 млн для семьи и дачи?» — на сайте, в Avito или Telegram.</p></div>
          <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>2. Уточнение</h3><p>AI уточняет 3–5 параметров: тип кузова, привод, новый или с пробегом, trade-in, срок покупки.</p></div>
          <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>3. RAG-поиск</h3><p>RAG-слой ищет в каталоге дилера; если точной модели нет — предлагает близкие альтернативы <strong>из наличия</strong>.</p></div>
          <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>4. Подбор</h3><p>Агент показывает 2–3 варианта с ценой, комплектацией и фото; предлагает тест-драйв или звонок.</p></div>
          <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>5. Контакт</h3><p>Собирает имя и телефон, создаёт бриф в CRM, уведомляет менеджера (push, Telegram, e-mail).</p></div>
          <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>6. Звонок менеджера</h3><p>Менеджер звонит с готовым контекстом — без 15–20 минут на «а какой у вас бюджет?».</p></div>
        </div>
      </div>

      <div class="nero-ai-reveal" style="margin-top:48px">
        <h3>Какие параметры собирает агент (бюджет, кузов, кредит/лизинг, trade-in)</h3>
        <div class="apa-table-wrap" style="margin-top:20px">
          <table class="apa-table" aria-label="Параметры квиза AI-агента">
            <thead><tr><th>Этап</th><th>Что уточняет агент</th><th>Зачем дилеру</th></tr></thead>
            <tbody>
              <tr><td>Бюджет</td><td>Диапазон цены или ежемесячный платёж</td><td>Сразу отсекает нерелевантный сток</td></tr>
              <tr><td>Сценарий</td><td>Семья, город, дача, работа, такси</td><td>Подбор кузова и комплектации</td></tr>
              <tr><td>Тип кузова</td><td>Седан, кроссовер, минивэн, пикап</td><td>Сужение выдачи из каталога</td></tr>
              <tr><td>Новый / БУ</td><td>Пробег, год, предпочтения</td><td>Маршрутизация по отделам</td></tr>
              <tr><td>Trade-in</td><td>Есть ли авто на обмен, марка/год</td><td>Подключение оценщика</td></tr>
              <tr><td>Финансирование</td><td>Кредит, лизинг, наличные</td><td>Передача в F&amp;I-воронку</td></tr>
              <tr><td>Срок</td><td>Сейчас, в течение месяца, позже</td><td>Приоритет лида A/B/C</td></tr>
              <tr><td>Контакт</td><td>Имя, телефон, удобный канал</td><td>Создание сделки в CRM</td></tr>
            </tbody>
          </table>
        </div>

        <p style="margin-top:28px"><strong>Пример заполненного брифа в CRM:</strong></p>
        <div class="apa-mono" aria-label="Пример брифа в CRM"><span class="tag">Приоритет: A (горячий)</span>
Клиент: Алексей К. · Телефон: +7 (***) ***-**-45
Бюджет: до 2 800 000 ₽ (кредит, взнос ~500 000 ₽)
Задача: семейный кроссовер, поездки на дачу, 2 детских кресла
Trade-in: Kia Sportage 2019, ~1,1 млн ₽
Подобрано AI:
  1. Chery Tiggo 8 Pro Max — 2 649 000 ₽, в наличии
  2. Haval Jolion Premium — 2 390 000 ₽, в наличии
Источник: квиз на сайте / Avito / VK</div>

        <div class="apa-table-wrap" style="margin-top:24px">
          <table class="apa-table" aria-label="Сравнение: холодное обращение vs бриф от AI">
            <thead><tr><th>Параметр</th><th>Холодное обращение</th><th>Бриф от AI-агента</th></tr></thead>
            <tbody>
              <tr><td>Контекст для менеджера</td><td>Только имя и телефон</td><td>Бюджет, задача, 2–3 модели, trade-in, срок</td></tr>
              <tr><td>Время первичной квалификации</td><td>15–20 минут</td><td>0 минут (уже сделано)</td></tr>
              <tr><td>Работа вне часов салона</td><td>«Перезвоним утром»</td><td>Диалог и бриф 24/7</td></tr>
              <tr><td>Риск «галлюцинаций»</td><td>Менеджер может ошибиться в наличии</td><td>RAG только по live-стоку</td></tr>
              <tr><td>Приоритизация</td><td>Все лиды в одной очереди</td><td>Метки A/B/C по срочности</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <section class="apa-section apa-section-alt" id="kviz">
    <div class="apa-cnt">
      <div class="apa-sh nero-ai-reveal">
        <span class="apa-eyebrow">Лид-магнит</span>
        <h2>Квиз подбора автомобиля на сайте дилера</h2>
        <p>Квиз подбора автомобиля — главный лид-магнит нишевого лендинга. Это <strong>интерактивная демонстрация</strong> того, как будет работать ваш AI-агент, ещё до заявки на внедрение.</p>
      </div>

      <div class="apa-sh apa-left nero-ai-reveal" style="margin-bottom:32px">
        <h3>Структура квиза для автоцентра</h3>
      </div>
      <div class="apa-steps nero-ai-reveal">
        <div class="apa-step"><div class="apa-step-num">1</div><h4>Бюджет</h4><p>До 1,5 млн / 1,5–3 млн / 3–5 млн / выше</p></div>
        <div class="apa-step"><div class="apa-step-num">2</div><h4>Сценарий</h4><p>Город, семья, бизнес, дача, бездорожье</p></div>
        <div class="apa-step"><div class="apa-step-num">3</div><h4>Тип кузова</h4><p>Седан, хэтчбек, кроссовер, универсал</p></div>
        <div class="apa-step"><div class="apa-step-num">4</div><h4>Новый / БУ</h4><p>С уточнением допустимого пробега</p></div>
        <div class="apa-step"><div class="apa-step-num">5</div><h4>Trade-in</h4><p>Да/нет, кратко марка и год</p></div>
        <div class="apa-step"><div class="apa-step-num">6</div><h4>Финансирование</h4><p>Наличные, кредит, лизинг</p></div>
        <div class="apa-step"><div class="apa-step-num">7</div><h4>Срок покупки</h4><p>Сейчас, месяц, три месяца</p></div>
        <div class="apa-step"><div class="apa-step-num">8</div><h4>Контакт</h4><p>Имя, телефон, согласие 152-ФЗ</p></div>
      </div>

      <div class="apa-card nero-ai-reveal" style="margin-top:32px">
        <h3>Как квиз сокращает время менеджера на первичную квалификацию</h3>
        <p>Квиз и AI-агент закрывают одну задачу: <strong>квалификация лидов автодилера</strong> без участия человека. Кейс Chery + VK: конверсия подписчиков в заявки около <strong>60%</strong>, стоимость заявки <strong>~1 265 ₽</strong> при чеке автомобиля 2–3 млн ₽. Для сети из 3–5 точек экономия — десятки часов в месяц на закрытие сделок.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-kviz">
        <div class="ym-cta-block__icon" aria-hidden="true">🚗</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Собрать автоагента для вашего дилерского центра</p>
          <p class="ym-cta-block__sub">Запустим квиз подбора на вашем стоке: AI уточняет бюджет и задачи, подбирает 2–3 авто из наличия и передаёт менеджеру готовый бриф в CRM. MVP — от 2–3 недель.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="apa-section" id="vnedrenie">
    <div class="apa-cnt">
      <div class="apa-sh nero-ai-reveal">
        <span class="apa-eyebrow">Под ключ</span>
        <h2>Внедрение AI-агента для автодилера под ключ</h2>
        <p><strong>Внедрение ai подбор автомобиля</strong> — проектная услуга: аудит, сценарии, интеграция, обучение. Nero Network ведёт дилера от первого созвона до работающего автоагента в CRM.</p>
      </div>

      <div class="apa-timeline nero-ai-reveal">
        <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>Этап 1. Аудит (3–5 рабочих дней)</h3><p>Каналы входящих обращений, CRM/DMS, формат выгрузки стока, воронка и SLA ответа.</p></div>
        <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>Этап 2. Сценарии и база знаний (5–10 дней)</h3><p>Диалоговые ветки, FAQ салона, RAG-слой (anti-hallucination), квиз-виджет как лид-магнит.</p></div>
        <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>Этап 3. Интеграция (7–14 дней)</h3><p>CRM-коннектор submit_lead, синхронизация стока, омниканальный роутер, уведомления при «горячем» лиде.</p></div>
        <div class="apa-tl-item"><div class="apa-tl-dot"></div><h3>Этап 4. Запуск и обучение (2–3 дня)</h3><p>Тестовые диалоги, обучение менеджеров, аналитика, модерация ответов в первые 2 недели.</p></div>
      </div>

      <div class="apa-card nero-ai-reveal" style="margin-top:32px">
        <h3>Сроки и состав работ</h3>
        <p><strong>MVP</strong> (квиз + 1 канал + CRM): <strong>2–3 недели</strong>. <strong>Полное внедрение</strong> (омниканал + RAG + аналитика): <strong>4–6 недель</strong>. Данные на серверах в РФ — <strong>152-ФЗ</strong>. YandexGPT или GigaChat; опционально GPT-4o на внутренних стендах.</p>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации до старта проекта?</p>
          <p class="ym-cta-block__sub">Если команда дилера хочет понимать сценарии квиза, интеграции CRM и human-in-the-loop до внедрения автоагента — посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a>. Это ускоряет согласование этапов и снижает риск ошибок на запуске.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="apa-section apa-section-alt" id="crm">
    <div class="apa-cnt">
      <div class="apa-sh nero-ai-reveal">
        <span class="apa-eyebrow">Интеграции</span>
        <h2>Интеграция с CRM: amoCRM, Bitrix24 и отраслевые DMS</h2>
        <p><strong>Ai подбор автомобиля интеграция crm</strong> — не опция, а условие окупаемости. Без передачи брифа в CRM агент превращается в «умный чат на сайте».</p>
      </div>

      <div class="apa-logos nero-ai-reveal" aria-label="Поддерживаемые системы">
        <span class="apa-logo">amoCRM</span>
        <span class="apa-logo">Bitrix24</span>
        <span class="apa-logo">RetailCRM</span>
        <span class="apa-logo">Avito</span>
        <span class="apa-logo">AUTO.ru</span>
        <span class="apa-logo">Telegram</span>
      </div>

      <div class="apa-grid-2 nero-ai-reveal">
        <div class="apa-card">
          <h3>Передача брифа и сделки менеджеру</h3>
          <ul>
            <li>Карточка контакта и сделка «Квалифицирован»</li>
            <li>Поля брифа: бюджет, задача, кузов, trade-in, срок</li>
            <li>Ссылки на 2–3 авто из стока (VIN, цена, статус)</li>
            <li>Полный транскрипт диалога и метка A/B/C</li>
          </ul>
          <p style="margin-top:12px;font-size:14px">Кейс «СКАН-ЮГО-ВОСТОК»: <strong>0% утерянных</strong> обращений, время первого контакта ↓ <strong>в 2 раза</strong>, конверсия лид→сделка ↑ <strong>15%</strong>.</p>
        </div>
        <div class="apa-card">
          <h3>Триггеры и уведомления при «горячем» лиде</h3>
          <ul>
            <li>Срок «в течение недели» → приоритет A, уведомление РОП</li>
            <li>Бюджет выше порога → старший менеджер</li>
            <li>Запрос на тест-драйв → задача с дедлайном 15 минут</li>
            <li>Ночной лид → SMS/Telegram дежурному</li>
            <li>Нестандартный вопрос → эскалация request_human</li>
          </ul>
        </div>
      </div>

      <div class="apa-sh nero-ai-reveal" style="margin-top:56px">
        <h2>AI автомобильный менеджер: сценарии для разных отделов</h2>
      </div>
      <div class="apa-grid-2 nero-ai-reveal">
        <div class="apa-scenario">
          <h3>Новые авто vs подбор с пробегом</h3>
          <p><strong>Новые:</strong> актуальный склад, комплектации, цвета, кредитные программы. <strong>Б/У:</strong> пробег, год, история — агент не смешивает выдачу. RAG учитывает ISOFIX, багажник, клиренс при наличии данных.</p>
        </div>
        <div class="apa-scenario">
          <h3>Лизинг и корпоративные продажи</h3>
          <p>Уточнение: ИП, ООО, парк от N машин. Задача: такси, логистика, представительский класс. Маршрутизация на корпоративного менеджера. Кейс КЛЮЧАВТО: <strong>2 218</strong> продаж из реактивированных лидов (2025).</p>
        </div>
      </div>
    </div>
  </section>

  <section class="apa-section" id="keisy">
    <div class="apa-cnt">
      <div class="apa-sh nero-ai-reveal">
        <span class="apa-eyebrow">Референсы</span>
        <h2>Кейсы и примеры внедрения</h2>
        <!-- INTERNAL-LINKS:INSERT -->
        <p>Публичных кейсов «AI-агент подбора по бюджету у конкретного дилера» пока мало — ниже референсы, на которые опирается Nero Network.</p>
      </div>

      <div class="apa-table-wrap nero-ai-reveal">
        <table class="apa-table" aria-label="Метрики референсных внедрений">
          <thead><tr><th>Референс</th><th>Что измеряли</th><th>Результат</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>«Авто.ру AI»</td><td>Охват, скорость</td><td>~200 тыс. пользователей/мес, ответ 2–5 сек</td><td>Yandex Cloud</td></tr>
            <tr><td>CarGurus Discover</td><td>Трафик, лиды</td><td>Трафик ×3 кв/кв, лиды ×3,3</td><td>Earnings call Q3 2025</td></tr>
            <tr><td>«СКАН-ЮГО-ВОСТОК»</td><td>Первый контакт</td><td>Время ↓ в 2 раза, лид→сделка ↑ 15%</td><td>ENTERSALES</td></tr>
            <tr><td>Chery + VK-бот</td><td>Стоимость заявки</td><td>~1 265 ₽/заявка, конверсия ~60%</td><td>Workspace.ru</td></tr>
          </tbody>
        </table>
      </div>

      <div class="apa-card nero-ai-reveal" style="margin-top:32px">
        <h3>Ошибки при запуске и как их избежать</h3>
        <ul>
          <li><strong>Устаревший сток</strong> — синхронизация каждые 15–60 минут, запрет ответов без RAG</li>
          <li><strong>Нет CRM-интеграции</strong> — submit_lead с первого дня MVP</li>
          <li><strong>Длинный квиз</strong> — максимум 6–8 шагов, один вопрос за экран</li>
          <li><strong>Бот «заменяет» менеджера</strong> — позиционирование «первая линия + эскалация»</li>
          <li><strong>Игнорирование 152-ФЗ</strong> — серверы в РФ, согласие на обработку</li>
          <li><strong>Копирование B2C-маркетплейса</strong> — RAG только по выгрузке дилера</li>
        </ul>
      </div>

      <div class="apa-sh nero-ai-reveal" style="margin-top:56px">
        <h2>Внедрение AI в бизнес автодилера: когда это окупается</h2>
        <p>Salesforce State of Sales 2026: <strong>9 из 10</strong> sales-команд используют или планируют AI-агентов; AI — <strong>#1 тактика роста</strong> в 2026.</p>
      </div>
      <div class="apa-intro-kpi nero-ai-reveal" style="max-width:720px;margin:0 auto">
        <div class="apa-kpi-card"><div class="kv">94%</div><div class="kl">лидеров: агенты критичны для плана</div></div>
        <div class="apa-kpi-card"><div class="kv">−34%</div><div class="kl">время на research</div></div>
        <div class="apa-kpi-card"><div class="kv">1,7×</div><div class="kl">prospecting AI у топ-перформеров</div></div>
        <div class="apa-kpi-card"><div class="kv">1–2 мес.</div><div class="kl">окупаемость при 1 сделке/мес</div></div>
      </div>
    </div>
  </section>

  <section class="apa-section apa-section-alt" id="ceny">
    <div class="apa-cnt">
      <div class="apa-sh nero-ai-reveal">
        <span class="apa-eyebrow">Смета</span>
        <h2>Стоимость внедрения AI подбора автомобиля</h2>
        <p>Ориентир чека Nero Network: <strong>180–600 тыс. ₽</strong> — между «шаблонным ботом за 40 тыс.» и enterprise без прозрачной сметы.</p>
      </div>

      <div class="apa-table-wrap nero-ai-reveal">
        <table class="apa-table" aria-label="Из чего складывается цена">
          <thead><tr><th>Компонент</th><th>Что входит</th><th>Влияние на цену</th></tr></thead>
          <tbody>
            <tr><td>MVP: квиз + 1 канал + CRM</td><td>Базовый сценарий, amoCRM/Bitrix24</td><td>Нижняя часть вилки</td></tr>
            <tr><td>RAG по live-стоку</td><td>API/выгрузка, anti-hallucination</td><td>Средняя часть</td></tr>
            <tr><td>Омниканал</td><td>Avito, AUTO.ru, Telegram, VK</td><td>Верхняя часть</td></tr>
            <tr><td>Кастомные сценарии</td><td>Лизинг, корпоратив, trade-in</td><td>Доп. ветки</td></tr>
          </tbody>
        </table>
      </div>

      <div class="apa-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="apa-card">
          <h3>Малый дилер / один салон</h3>
          <p>MVP за 2–3 недели — квиз на сайте + Telegram или Avito + amoCRM. Достаточно для перехвата ночных лидов и разгрузки 2–3 менеджеров.</p>
        </div>
        <div class="apa-card">
          <h3>Сеть / холдинг</h3>
          <p>Омниканальный роутер, единая воронка, маршрутизация по точкам, разные ветки для новых/БУ/лизинга, корпоративная аналитика по бюджетным диапазонам.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="apa-trust nero-ai-reveal" aria-label="Trust-полоса">
    <span>152-ФЗ</span>
    <span>YandexGPT / GigaChat</span>
    <span>RAG только по стоку</span>
    <span>Anti-hallucination</span>
  </div>

  <section class="apa-section" id="faq">
    <div class="apa-cnt">
      <div class="apa-sh nero-ai-reveal">
        <span class="apa-eyebrow">FAQ</span>
        <h2>FAQ по AI-агенту подбора авто</h2>
      </div>

      <div class="apa-faq nero-ai-reveal">
        <div class="apa-faq-item"><div class="apa-faq-q">Как внедрить ai подбор автомобиля без программиста?</div><div class="apa-faq-a">Внедрение под ключ — задача интегратора. От дилера нужны: доступ к CRM, каталог в Excel/API, FAQ салона и 2–3 часа на согласование сценариев. Программист в штате не обязателен.</div></div>
        <div class="apa-faq-item"><div class="apa-faq-q">Сколько стоит ai подбор автомобиля?</div><div class="apa-faq-a">Ориентир <strong>180–600 тыс. ₽</strong> в зависимости от каналов и глубины интеграции. MVP — нижняя часть вилки. Точная смета — после аудита.</div></div>
        <div class="apa-faq-item"><div class="apa-faq-q">Можно ли запустить только квиз без полной интеграции?</div><div class="apa-faq-a">Да. Квиз как лид-магнит — первый шаг: собирает бриф и отправляет в CRM или на e-mail менеджеру. Полноценный AI-агент в мессенджерах — следующий этап.</div></div>
        <div class="apa-faq-item"><div class="apa-faq-q">Какие CRM поддерживаются?</div><div class="apa-faq-a">amoCRM, Bitrix24, RetailCRM — нативные коннекторы. Отраслевые DMS — через API или Make/n8n/Alboto. Чаты AUTO.ru — через приложение Bitrix24 (pweb.chatautoru).</div></div>
        <div class="apa-faq-item"><div class="apa-faq-q">Что если нужной модели нет в наличии?</div><div class="apa-faq-a">Агент не «придумывает» машину. RAG ищет ближайшие альтернативы из актуального стока. Если подходящего нет — честно сообщает и предлагает связь с менеджером.</div></div>
        <div class="apa-faq-item"><div class="apa-faq-q">Бот будет врать про наличие?</div><div class="apa-faq-a">Нет — при правильной настройке. Anti-hallucination: ответы только по данным выгрузки (VIN, статус, цена). Синхронизация стока каждые 15–60 минут.</div></div>
        <div class="apa-faq-item"><div class="apa-faq-q">Клиенты хотят живого человека — зачем бот?</div><div class="apa-faq-a">AI-агент — <strong>первая линия</strong>, не замена менеджера. Эскалация request_human в любой момент. Бот снимает рутину; человек закрывает сделку, торг, trade-in, F&amp;I.</div></div>
      </div>
    </div>
  </section>

  <section class="apa-section apa-section-alt" id="cta-final">
    <div class="apa-cnt">
      <div class="ym-cta-block ym-cta-block--dual ym-cta-block--footer-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Собрать автоагента — пока клиент «думает», вы уже знаете его бюджет</p>
          <p class="ym-cta-block__sub">Квиз на вашем стоке · RAG без галлюцинаций · бриф в amoCRM / Bitrix24 · омниканал Avito, AUTO.ru, Telegram, VK. Ориентир 180–600 тыс. ₽ — точная смета после аудита.</p>
          <ul class="apa-cta-checklist">
            <li>Квиз-лид-магнит</li>
            <li>RAG по live-стоку</li>
            <li>Бриф в CRM</li>
            <li>152-ФЗ</li>
            <li>MVP 2–3 недели</li>
          </ul>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary">Ответы на вопросы</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.apa-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * apa-avto-hero-engine — «Диспетчерская подбора авто»
 * Мир: OmnichannelInquiryStream → BudgetQuizGate → VehicleMatchConsole → CrmBriefDrawer
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("apa-avto-hero-canvas");
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
    scale = Math.min(cw / 440, ch / 280) * 1.08;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    panel: "#0f172a",
    panelEdge: "#1e293b",
    chatBg: "rgba(255,255,255,0.06)",
    carCard: "rgba(121,242,255,0.12)",
    carAmber: "#f59e0b",
    carCyan: "#79f2ff",
    carViolet: "#8b5cf6",
    crmGreen: "#22c55e",
    crmDrawer: "#111827",
    streamAvito: "#f97316",
    streamSite: "#38bdf8",
    streamTg: "#8b5cf6",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    track: "rgba(121,242,255,0.25)"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.4;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  function drawMiniCar(ctx, x, y, w, color, label) {
    drawRR(ctx, x - w / 2, y - 8, w, 16, 4, color, C.outline);
    ctx.fillStyle = "rgba(15,23,42,0.5)";
    ctx.beginPath();
    ctx.arc(x - w * 0.28, y + 10, 4, 0, Math.PI * 2);
    ctx.arc(x + w * 0.28, y + 10, 4, 0, Math.PI * 2);
    ctx.fill();
    if (label) {
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 1);
    }
  }

  /* Дуговые рельсы заявок — вместо Conveyor */
  function OmnichannelInquiryStream() {
    this.items = [
      { t0: 0, color: C.streamAvito, tag: "AV" },
      { t0: 45, color: C.streamSite, tag: "WEB" },
      { t0: 90, color: C.streamTg, tag: "TG" }
    ];
  }
  OmnichannelInquiryStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    ctx.strokeStyle = C.track;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([4, 5]);
    [-1, 0, 1].forEach(function (lane, i) {
      ctx.beginPath();
      ctx.moveTo(-185 + lane * 18, 55);
      ctx.quadraticCurveTo(-40 + lane * 12, -15 + lane * 8, 35, -35);
      ctx.stroke();
    });
    ctx.setLineDash([]);

    this.items.forEach(function (it) {
      var t = ((frame * 0.55 + it.t0) % 130) / 130;
      if (t > 0.88) return;
      var lane = it.tag === "AV" ? -1 : it.tag === "WEB" ? 0 : 1;
      var x = -185 + lane * 18 + (35 - (-185 + lane * 18)) * t;
      var y = 55 + (-35 - 55) * t + Math.sin(t * Math.PI) * (-18 - lane * 4);
      drawRR(ctx, x - 14, y - 10, 28, 18, 4, it.color, C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(it.tag, x, y + 2);
    });
  };

  /* Ворота квиза бюджета */
  function BudgetQuizGate() {
    this.slider = 0;
  }
  BudgetQuizGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 48 || prg > 165) return;
    drawRR(ctx, -58, -8, 46, 52, 6, "rgba(139,92,246,0.15)", C.outline);
    ctx.fillStyle = "#ddd6fe";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("КВИЗ", -35, 2);
    var fill = Math.min(1, (prg - 55) / 50);
    drawRR(ctx, -52, 14, 34 * fill, 6, 3, C.carCyan, null);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "5px Inter,sans-serif";
    ctx.fillText("≤ 2,8 млн", -35, 28);
  };

  /* Карусель силуэтов стока */
  function ShowroomStockCarousel() {
    this.angle = 0;
  }
  ShowroomStockCarousel.prototype.draw = function (ctx) {
    this.angle += 0.018;
    var colors = [C.carCyan, C.carAmber, C.carViolet];
    for (var i = 0; i < 3; i++) {
      var a = this.angle + (i * Math.PI * 2) / 3;
      var rx = -120 + Math.cos(a) * 22;
      var ry = 18 + Math.sin(a) * 10;
      drawMiniCar(ctx, rx, ry, 22, colors[i], "");
    }
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("STOCK", -132, 8);
  };

  /* Пунктирная дорога к сделке — фоновая анимация */
  function TestDriveTrackArc() {
    this.dot = 0;
  }
  TestDriveTrackArc.prototype.draw = function (ctx) {
    this.dot = (this.dot + 0.008) % 1;
    ctx.strokeStyle = "rgba(245,158,11,0.35)";
    ctx.lineWidth = 1.2;
    ctx.setLineDash([3, 6]);
    ctx.beginPath();
    ctx.arc(0, 30, 95, Math.PI * 0.15, Math.PI * 0.85);
    ctx.stroke();
    ctx.setLineDash([]);
    var ang = Math.PI * 0.15 + (Math.PI * 0.7) * this.dot;
    var dx = Math.cos(ang) * 95;
    var dy = 30 + Math.sin(ang) * 95;
    ctx.fillStyle = C.carAmber;
    ctx.beginPath();
    ctx.arc(dx, dy, 3, 0, Math.PI * 2);
    ctx.fill();
  };

  /* Центральная консоль подбора — вместо WebsiteTerminal */
  function VehicleMatchConsole() {
    this.cards = 0;
  }
  VehicleMatchConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -8, -72, 130, 118, 10, C.panel, C.outline);

    /* Чат */
    drawRR(ctx, 2, -64, 52, 96, 6, C.chatBg, C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.textAlign = "left";
    var lines = [
      prg > 60 ? "Семья + дача?" : "",
      prg > 85 ? "Бюджет до 2,8 млн" : "",
      prg > 110 ? "Trade-in: Sportage" : ""
    ];
    lines.forEach(function (ln, i) {
      if (!ln) return;
      drawRR(ctx, 6, -58 + i * 16, 44, 10, 3, "rgba(121,242,255,0.18)", null);
      ctx.fillText(ln, 8, -51 + i * 16);
    });

    /* Карточки авто */
    if (prg >= 125) {
      var cars = [
        { x: 68, label: "Tiggo 8", price: "2,6 млн", col: C.carCyan },
        { x: 92, label: "Jolion", price: "2,3 млн", col: C.carAmber },
        { x: 116, label: "Dargo", price: "2,9 млн", col: C.carViolet }
      ];
      cars.forEach(function (car, i) {
        var pop = Math.min(1, (prg - 125 - i * 12) / 14);
        if (pop <= 0) return;
        ctx.save();
        ctx.globalAlpha = pop;
        drawRR(ctx, car.x - 14, -58 + i * 28, 28, 24, 4, car.col, C.outline);
        drawMiniCar(ctx, car.x, -46 + i * 28, 18, "rgba(15,23,42,0.35)", "");
        ctx.fillStyle = "#fff";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(car.label, car.x, -36 + i * 28);
        ctx.fillStyle = "#94a3b8";
        ctx.fillText(car.price, car.x, -28 + i * 28);
        drawRR(ctx, car.x - 12, -22 + i * 28, 24, 7, 3, "rgba(34,197,94,0.25)", C.crmGreen);
        ctx.fillStyle = "#bbf7d0";
        ctx.font = "bold 4px Inter,sans-serif";
        ctx.fillText("в наличии", car.x, -17 + i * 28);
        ctx.restore();
      });
    }
  };

  /* Слот CRM — финал: бриф + приоритет A */
  function CrmBriefDrawer() {
    this.slide = 0;
  }
  CrmBriefDrawer.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, 118, -18, 58, 72, 8, C.crmDrawer, C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM", 147, -8);

    if (prg >= 188) {
      this.slide = Math.min(1, (prg - 188) / 22);
      var by = 8 + (1 - this.slide) * 40;
      ctx.save();
      ctx.globalAlpha = this.slide;
      drawRR(ctx, 124, by, 46, 38, 5, "rgba(34,197,94,0.2)", C.crmGreen);
      ctx.fillStyle = "#ecfdf5";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("Бриф · Алексей", 128, by + 10);
      ctx.fillText("A · 2,8 млн", 128, by + 20);
      ctx.fillText("3 модели", 128, by + 30);
      ctx.restore();
    }

    if (prg >= 215) {
      var pulse = (prg - 215) / 45;
      ctx.strokeStyle = "rgba(34,197,94," + (0.8 - pulse * 0.6) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(147, 52, 8 + pulse * 18, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Маяк горячего лида */
  function HotLeadBeacon() {
    this.on = false;
  }
  HotLeadBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.on = prg >= 220;
    if (!this.on) return;
    var blink = 0.6 + Math.sin(frame * 0.2) * 0.4;
    ctx.fillStyle = "rgba(34,197,94," + blink + ")";
    ctx.beginPath();
    ctx.arc(168, -52, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("!", 166, -50);
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
    var prg = (frame * 0.042) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    var targets = {
      "1_architect": { x: -45, y: -20 },
      "2_seo": { x: -35, y: 5 },
      "3_coder": { x: -105, y: 25 },
      "4_designer": { x: 55, y: -15 },
      "5_deployer": { x: 130, y: 15 }
    };
    var tgt = targets[this.role] || { x: 0, y: 0 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 26) {
      var local = prg - this.stepTrig;
      if (local < 13) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 13);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 13);
      } else if (local < 18) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 18) / 8);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 18) / 8);
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
    drawRR(ctx, -10, -8 - bob, 20, 14, 4, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    if (carryType) {
      drawRR(ctx, -16, -16 - bob, 10, 10, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new TestDriveTrackArc());
  entities.push(new OmnichannelInquiryStream());
  entities.push(new ShowroomStockCarousel());
  entities.push(new BudgetQuizGate());
  entities.push(new VehicleMatchConsole());
  entities.push(new CrmBriefDrawer());
  entities.push(new HotLeadBeacon());

  entities.push(new Agent(-155, 42, C.agentYellow, "1_architect", 18, [
    "Avito: кроссовер до 3 млн",
    "Принял запрос с канала",
    "Семья + дача — ок"
  ]));
  entities.push(new Agent(-165, 58, C.agentGreen, "2_seo", 58, [
    "Уточняю бюджет клиента",
    "Trade-in: Sportage 2019",
    "Срок — 2 недели, приоритет A"
  ]));
  entities.push(new Agent(-175, 28, C.agentBlue, "3_coder", 98, [
    "RAG: только live-сток",
    "VIN подтверждён",
    "Без галлюцинаций"
  ]));
  entities.push(new Agent(20, 48, C.agentPink, "4_designer", 132, [
    "3 карточки из наличия",
    "Цвет и комплектация",
    "UI подбора готов"
  ]));
  entities.push(new Agent(95, 38, C.agentPurple, "5_deployer", 172, [
    "submit_lead → amoCRM",
    "Транскрипт в сделке",
    "Менеджер уведомлён"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 220, maxLife: customLife || 220 });
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 22 && prg < 22.05) createBubble(-120, 10, "1. Avito → квиз");
    if (prg >= 62 && prg < 62.05) createBubble(-40, -5, "2. Бюджет 2,8 млн");
    if (prg >= 128 && prg < 128.05) createBubble(70, -40, "3. Tiggo · Jolion · Dargo");
    if (prg >= 192 && prg < 192.05) createBubble(145, 0, "4. Бриф → CRM · A");

    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bub.x - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, by - th / 2);
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
  'use strict';
  var cv = document.getElementById('apa-avto-brief-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;
  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();
  var C = {ink:'#0f172a',muted:'#64748b',chatUser:'#e0f2fe',chatUserBdr:'#7dd3fc',chatAi:'#ffffff',chatAiBdr:'#cbd5e1',car:'#f59e0b',stock:'rgba(14,165,233,.08)',stockBdr:'rgba(14,165,233,.25)',crmPanel:'#0f172a',green:'#22c55e',line:'rgba(14,165,233,.35)',text:'#1e293b'};
  var CARS = [{name:'Tiggo 8',price:'2 649 000 ₽',color:'#f8fafc',delay:0},{name:'Jolion',price:'2 390 000 ₽',color:'#94a3b8',delay:80},{name:'Coolray',price:'2 180 000 ₽',color:'#1e293b',delay:160}];
  var LOOP = 720;
  function rr(x,y,w,h,r,fill,stroke,lw){ctx.beginPath();if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);if(fill){ctx.fillStyle=fill;ctx.fill();}if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}}
  function drawCar(x,y,scale,bodyColor,highlight){var w=56*scale,h=22*scale;ctx.save();ctx.translate(x,y);if(highlight){ctx.shadowColor='rgba(245,158,11,.45)';ctx.shadowBlur=12;}rr(-w/2,-h/2,w,h,6,bodyColor,'#334155',1.2);rr(-w/2+4,-h/2-3,w-8,5,3,C.car,C.car,0);ctx.fillStyle='#334155';ctx.beginPath();ctx.arc(-w/4,h/2+2,5*scale,0,Math.PI*2);ctx.arc(w/4,h/2+2,5*scale,0,Math.PI*2);ctx.fill();ctx.restore();}
  function drawChatBubble(x,y,w,h,text,isUser,alpha){ctx.save();ctx.globalAlpha=alpha;var fill=isUser?C.chatUser:C.chatAi;var bdr=isUser?C.chatUserBdr:C.chatAiBdr;rr(x,y,w,h,10,fill,bdr,1);ctx.fillStyle=C.text;ctx.font=(11*Math.min(W/640,1.2))+'px Inter,system-ui,sans-serif';ctx.textAlign='left';var words=text.split(' '),line='',ly=y+16,maxW=w-16;for(var i=0;i<words.length;i++){var test=line+words[i]+' ';if(ctx.measureText(test).width>maxW&&line){ctx.fillText(line,x+10,ly);line=words[i]+' ';ly+=14;}else line=test;}if(line)ctx.fillText(line.trim(),x+10,ly);ctx.restore();}
  function drawBriefCard(x,y,alpha,progress){ctx.save();ctx.globalAlpha=alpha;var w=130,h=90;rr(x,y,w,h,8,C.crmPanel,'#334155',1);ctx.fillStyle=C.green;ctx.font='bold 9px Inter,system-ui,sans-serif';ctx.fillText('Приоритет: A',x+10,y+16);ctx.fillStyle='#e2e8f0';ctx.font='8px Inter,system-ui,sans-serif';ctx.fillText('Бюджет: до 2,8 млн',x+10,y+32);ctx.fillText('Кроссовер · trade-in',x+10,y+44);ctx.fillText('Tiggo 8 · Jolion',x+10,y+56);if(progress>0.5){ctx.fillStyle='#0ea5e9';ctx.font='bold 8px Inter,system-ui,sans-serif';ctx.fillText('→ amoCRM',x+10,y+76);}ctx.restore();}
  function loop(){frame=(frame+1)%LOOP;ctx.clearRect(0,0,W,H);var chatX=W*0.06,chatW=W*0.38;drawChatBubble(chatX,H*0.08,chatW,36,'Семейный кроссовер до 2,5 млн, полный привод',true,Math.min(1,frame/60));if(frame>90)drawChatBubble(chatX,H*0.20,chatW,40,'Уточню: кредит или наличные? Trade-in есть?',false,Math.min(1,(frame-90)/50));if(frame>180)drawChatBubble(chatX,H*0.34,chatW,32,'Кредит, взнос ~500 тыс. Kia Sportage 2019',true,Math.min(1,(frame-180)/50));var stockX=W*0.52,stockY=H*0.12,stockW=W*0.42,stockH=H*0.42;rr(stockX,stockY,stockW,stockH,12,C.stock,C.stockBdr,1.5);ctx.fillStyle=C.muted;ctx.font='bold 10px Inter,system-ui,sans-serif';ctx.textAlign='center';ctx.fillText('LIVE-СТОК ДИЛЕРА',stockX+stockW/2,stockY+18);CARS.forEach(function(car,i){var appear=Math.max(0,Math.min(1,(frame-220-car.delay)/70));if(appear<=0)return;var cx=stockX+stockW*(0.22+i*0.28),cy=stockY+stockH*0.55;drawCar(cx,cy,0.9+appear*0.1,car.color,i===0&&appear>0.8);ctx.globalAlpha=appear;ctx.fillStyle=C.text;ctx.font='9px Inter,system-ui,sans-serif';ctx.textAlign='center';ctx.fillText(car.name,cx,cy+28);ctx.fillStyle=C.car;ctx.font='bold 8px Inter,system-ui,sans-serif';ctx.fillText(car.price,cx,cy+40);ctx.globalAlpha=1;});var briefProg=Math.max(0,Math.min(1,(frame-480)/120));if(briefProg>0){var bx=stockX+stockW*(0.15+briefProg*0.55),by=H*0.68;drawBriefCard(bx,by,briefProg,briefProg);}if(frame>600){var pulse=0.5+0.5*Math.sin((frame-600)*0.08);ctx.fillStyle='rgba(34,197,94,'+(0.6+pulse*0.4)+')';ctx.font='bold 11px Inter,system-ui,sans-serif';ctx.textAlign='right';ctx.fillText('Бриф в CRM ✓',W-20,H-16);}requestAnimationFrame(loop);}
  loop();
})();
</script>

<script>
(function(){
  document.querySelectorAll('.apa-faq-q').forEach(function(q){
    q.addEventListener('click',function(){
      var item = q.parentElement;
      var open = item.classList.contains('open');
      document.querySelectorAll('.apa-faq-item.open').forEach(function(el){ el.classList.remove('open'); });
      if(!open) item.classList.add('open');
    });
  });
})();
</script>

<?php
$reveal_js = nero_ai_read_theme_asset( 'longread-page-reveal.js' );
if ( $reveal_js !== '' ) {
	echo "<script>\n", $reveal_js, "\n</script>\n";
}
?>

<?php get_footer(); ?>
