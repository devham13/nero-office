<?php
/**
 * Template Name: AI-агент для первичной обработки заявок с сайта
 * Description: SEO-лендинг — внедрение AI-агента для обработки заявок с формы и чата. Квалификация, CRM, аудит потерь.
 */

$page_seo_title       = 'AI обработка заявок с сайта под ключ — внедрение агента';
$page_seo_description = 'Внедрим AI-агента для первичной обработки заявок с формы и чата: ответ за 5–15 секунд, квалификация и передача лида в CRM. Аудит потерь заявок — бесплатно по заявке.';

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
    ['label' => 'Проблема', 'href' => '#pochemu-ostyvayut'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Написать в Telegram';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по автоматизации';
$secondary_cta_url_env = getenv('SECONDARY_CTA_URL') ?: '#';
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
.vna-content{
  --vna-bg:#050711;--vna-bg2:#080b17;--vna-bg3:#0a0e1c;
  --vna-surface:rgba(255,255,255,.072);--vna-surface2:rgba(255,255,255,.108);
  --vna-text:#e6edf7;--vna-muted:#9aa8bd;--vna-soft:#c7d2e5;--vna-heading:#fff;
  --vna-border:rgba(255,255,255,.10);--vna-border-s:rgba(255,255,255,.18);
  --vna-accent:#79f2ff;--vna-violet:#8b5cf6;--vna-green:#22c55e;--vna-cyan:#79f2ff;
  --vna-btn-from:#2563eb;--vna-btn-to:#7c3aed;
  --vna-shadow:0 24px 72px rgba(0,0,0,.4);
  --vna-r:18px;--vna-r-lg:24px;
  --vna-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vna-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vna-content *,.vna-content *::before,.vna-content *::after{box-sizing:border-box;}
.vna-content a{color:inherit;text-decoration:none;}
.vna-content p{color:var(--vna-muted);line-height:1.72;margin:0 0 1em;}
.vna-content p:last-child{margin-bottom:0;}
.vna-content h2,.vna-content h3,.vna-content h4{
  color:var(--vna-heading);letter-spacing:-.045em;margin:0 0 .7em;
}
.vna-content strong{color:var(--vna-soft);}
.vna-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vna-content ul li{
  padding-left:20px;position:relative;margin-bottom:.45em;
  color:var(--vna-muted);font-size:14.5px;line-height:1.65;
}
.vna-content ul li::before{
  content:'›';position:absolute;left:0;color:var(--vna-accent);font-weight:700;
}

/* Container */
.vna-cnt{
  width:min(var(--vna-container),calc(100% - 40px));
  margin:0 auto;position:relative;z-index:1;
}

/* Sections */
.vna-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vna-section-alt{
  background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
}

/* Section head */
.vna-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vna-sh.vna-left{margin-left:0;text-align:left;}
.vna-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vna-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vna-sh.vna-left p{margin-left:0;}

/* Eyebrow */
.vna-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;border-radius:999px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-accent);margin-bottom:14px;
}

/* Gradient text */
.vna-gt{
  background:linear-gradient(92deg,#fff 0%,var(--vna-accent) 44%,var(--vna-violet) 100%);
  -webkit-background-clip:text;background-clip:text;color:transparent!important;
}

/* =====================================================
   INTRO SECTION (2-col, left-aligned)
   ===================================================== */
.vna-intro{
  padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom:1px solid rgba(255,255,255,.06);
}
.vna-intro-grid{
  display:grid;grid-template-columns:1fr 340px;
  gap:56px;align-items:center;
}
.vna-intro-text{
  position:relative;padding-left:20px;
}
.vna-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;
  width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));
}
.vna-intro-text p{
  text-align:left!important;
  font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;
  color:var(--vna-muted);margin-bottom:1em;
}
.vna-intro-text p:last-child{margin-bottom:0;color:var(--vna-soft);}
.vna-intro-kpi{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.vna-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;
  box-shadow:0 8px 28px rgba(0,0,0,.25);
  backdrop-filter:blur(12px);
}
.vna-kpi-card .kv{
  font-size:clamp(20px,2.5vw,26px);font-weight:900;
  color:var(--vna-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;
}
.vna-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vna-muted);line-height:1.4;}
.vna-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){
  .vna-intro-grid{grid-template-columns:1fr;gap:36px;}
  .vna-intro-kpi{grid-template-columns:repeat(4,1fr);}
}
@media(max-width:600px){
  .vna-intro-kpi{grid-template-columns:1fr 1fr;}
}

/* =====================================================
   TOC
   ===================================================== */
.vna-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vna-toc{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;
}
.vna-toc a{
  display:inline-block;padding:9px 18px;
  background:var(--vna-surface);border:1px solid var(--vna-border);
  border-radius:999px;font-size:13px;font-weight:600;color:var(--vna-muted);
  transition:border-color .2s,color .2s,background .2s;
}
.vna-toc a:hover{
  border-color:rgba(121,242,255,.42);color:var(--vna-accent);
  background:rgba(121,242,255,.08);
}

/* =====================================================
   CARDS
   ===================================================== */
.vna-card{
  background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border:1px solid var(--vna-border);border-radius:var(--vna-r-lg);
  padding:26px;backdrop-filter:blur(16px);
  box-shadow:0 14px 40px rgba(0,0,0,.22);
  transition:border-color .22s,transform .22s;
}
.vna-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.vna-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vna-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){
  .vna-grid-2{grid-template-columns:1fr;}
  .vna-grid-3{grid-template-columns:1fr;}
}
@media(max-width:960px){
  .vna-grid-3{grid-template-columns:1fr 1fr;}
}
@media(max-width:600px){
  .vna-grid-3{grid-template-columns:1fr;}
}

/* =====================================================
   LEVEL CARDS (tri-urovnya)
   ===================================================== */
.vna-level-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vna-r);padding:26px;position:relative;overflow:hidden;
  transition:border-color .22s,transform .22s;
}
.vna-level-card:hover{transform:translateY(-2px);}
.vna-level-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  border-radius:var(--vna-r) var(--vna-r) 0 0;
}
.vna-level-card.l1::before{background:var(--vna-green);}
.vna-level-card.l2::before{background:var(--vna-accent);}
.vna-level-card.l3::before{background:var(--vna-violet);}
.vna-level-badge{
  display:inline-block;padding:4px 12px;border-radius:999px;
  font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;
  margin-bottom:14px;
}
.vna-level-card.l1 .vna-level-badge{background:rgba(34,197,94,.15);color:var(--vna-green);}
.vna-level-card.l2 .vna-level-badge{background:rgba(121,242,255,.15);color:var(--vna-accent);}
.vna-level-card.l3 .vna-level-badge{background:rgba(139,92,246,.15);color:var(--vna-violet);}
.vna-level-card h3{font-size:17px;margin-bottom:10px;}
.vna-level-card p{font-size:14px;margin:0;}

/* =====================================================
   SCENARIO BLOCKS
   ===================================================== */
.vna-scenario{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:var(--vna-r);padding:26px;
  display:flex;gap:18px;align-items:flex-start;
  margin-bottom:14px;transition:border-color .2s;
}
.vna-scenario:last-child{margin-bottom:0;}
.vna-scenario:hover{border-color:rgba(121,242,255,.3);}
.vna-sc-icon{
  flex-shrink:0;width:44px;height:44px;border-radius:12px;
  background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);
  display:flex;align-items:center;justify-content:center;font-size:20px;
}
.vna-scenario h3{font-size:17px;margin-bottom:8px;}
.vna-scenario p{font-size:14.5px;margin:0;}

/* =====================================================
   TABLES
   ===================================================== */
.vna-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vna-table{width:100%;border-collapse:collapse;font-size:14px;}
.vna-table th{
  padding:13px 16px;text-align:left;
  background:rgba(121,242,255,.1);color:var(--vna-accent);font-weight:700;
  border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;
}
.vna-table td{
  padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);
  color:var(--vna-text);vertical-align:top;
}
.vna-table tr:last-child td{border-bottom:none;}
.vna-table tr:hover td{background:rgba(255,255,255,.03);}
.vna-badge{
  display:inline-block;padding:3px 9px;border-radius:6px;
  font-size:11px;font-weight:700;
  background:rgba(121,242,255,.1);color:#79f2ff;
}

/* =====================================================
   STACK TABLE (stek-2026)
   ===================================================== */
.vna-stack-layer{
  display:flex;align-items:flex-start;gap:16px;
  padding:16px 0;border-bottom:1px solid rgba(255,255,255,.06);
}
.vna-stack-layer:last-child{border-bottom:none;}
.vna-stack-label{
  flex-shrink:0;min-width:130px;font-size:12px;font-weight:700;
  letter-spacing:.06em;text-transform:uppercase;color:var(--vna-accent);padding-top:2px;
}
.vna-stack-val{font-size:14.5px;color:var(--vna-text);}
.vna-stack-desc{font-size:13px;color:var(--vna-muted);margin-top:3px;}

/* =====================================================
   CASE CARDS
   ===================================================== */
.vna-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vna-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vna-case-grid{grid-template-columns:1fr;}}
.vna-case-card{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);
  border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;
}
.vna-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.vna-case-tag{
  font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-green);margin-bottom:10px;
}
.vna-case-card h3{font-size:16px;margin-bottom:14px;}
.vna-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.vna-metric{display:flex;align-items:baseline;gap:8px;}
.vna-metric .num{font-size:22px;font-weight:900;color:var(--vna-accent);flex-shrink:0;letter-spacing:-.04em;}
.vna-metric .lbl{font-size:13px;color:var(--vna-muted);}

/* =====================================================
   TIMELINE (etapy)
   ===================================================== */
.vna-timeline{position:relative;padding-left:40px;}
.vna-timeline::before{
  content:'';position:absolute;left:12px;top:8px;bottom:8px;
  width:2px;background:linear-gradient(180deg,var(--vna-accent),var(--vna-violet));
  opacity:.35;border-radius:2px;
}
.vna-tl-item{position:relative;margin-bottom:32px;}
.vna-tl-item:last-child{margin-bottom:0;}
.vna-tl-dot{
  position:absolute;left:-32px;top:4px;
  width:16px;height:16px;border-radius:50%;
  background:var(--vna-accent);
  box-shadow:0 0 0 4px rgba(121,242,255,.2);
}
.vna-tl-item h3{font-size:17px;margin-bottom:8px;}
.vna-tl-item p{font-size:14.5px;margin:0;}

/* =====================================================
   PRICING CARDS
   ===================================================== */
.vna-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
@media(max-width:960px){.vna-pricing-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vna-pricing-grid{grid-template-columns:1fr;}}
.vna-price-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
  border-radius:20px;padding:26px 22px;
  transition:border-color .22s,transform .22s;
}
.vna-price-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-3px);}
.vna-price-card.vna-featured{
  border-color:rgba(121,242,255,.45);background:rgba(121,242,255,.07);
}
.vna-price-card .tier{
  font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--vna-accent);margin-bottom:10px;
}
.vna-price-card .amount{
  font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;
  line-height:1;margin-bottom:8px;
}
.vna-price-card .inc{font-size:13px;color:var(--vna-muted);line-height:1.6;}

/* =====================================================
   COMPARE TABLE
   ===================================================== */
.vna-compare-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);}
.vna-compare{width:100%;border-collapse:collapse;}
.vna-compare th{
  padding:13px 16px;font-size:13px;font-weight:700;text-align:left;
  background:rgba(255,255,255,.06);color:var(--vna-muted);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.vna-compare td{
  padding:13px 16px;font-size:14px;color:var(--vna-text);
  border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top;
}
.vna-compare tr:last-child td{border-bottom:none;}
.vna-good{color:var(--vna-green);}
.vna-neutral{color:var(--vna-muted);}

/* =====================================================
   FAQ
   ===================================================== */
.vna-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vna-faq-item{
  background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);
  border-radius:14px;overflow:hidden;
}
.vna-faq-q{
  padding:19px 24px;font-size:16px;font-weight:700;color:var(--vna-heading);
  cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;
  user-select:none;
}
.vna-faq-q::after{
  content:'▾';font-size:13px;color:var(--vna-accent);
  flex-shrink:0;transition:transform .25s;
}
.vna-faq-item.open .vna-faq-q::after{transform:rotate(180deg);}
.vna-faq-a{
  padding:0 24px;max-height:0;overflow:hidden;
  transition:max-height .38s ease,padding .25s;
  font-size:14.5px;color:var(--vna-muted);line-height:1.72;
}
.vna-faq-item.open .vna-faq-a{max-height:600px;padding:0 24px 20px;}

/* =====================================================
   CTA BLOCKS (Artur's ym-* classes)
   ===================================================== */
.ym-cta-block{
  border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border:1px solid rgba(121,242,255,.3);text-align:center;
}
.ym-cta-block--dual{
  background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));
  border-color:rgba(34,197,94,.3);
}
.ym-cta-block--footer-final{
  background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));
  border-color:rgba(139,92,246,.3);
}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{
  font-size:clamp(20px,2.8vw,28px);font-weight:800;
  color:#fff;margin:0 0 10px;
}
.ym-cta-block__sub{
  color:var(--vna-muted);font-size:15px;
  margin:0 auto 22px;max-width:600px;line-height:1.7;
}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{
  display:inline-flex;align-items:center;justify-content:center;
  padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;
  text-decoration:none!important;transition:transform .2s,box-shadow .2s;
}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,
.nero-ai-home-page .ym-btn--accent{
  background:linear-gradient(135deg,var(--vna-btn-from),var(--vna-btn-to));color:#fff!important;
  box-shadow:0 8px 32px rgba(59,130,246,.35);
}
.ym-btn--accent:hover{box-shadow:0 12px 36px rgba(59,130,246,.45);}
.ym-btn--ghost{
  background:rgba(255,255,255,.08);color:var(--vna-text)!important;
  border:1.5px solid rgba(255,255,255,.18);
}
.ym-btn--ghost:hover{border-color:rgba(121,242,255,.4);background:rgba(59,130,246,.12);}
.ym-cta-block__btn{margin-top:4px;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* =====================================================
   CTA FINAL SECTION
   ===================================================== */
.vna-cta-checklist{
  display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;
  list-style:none;padding:0;
}
.vna-cta-checklist li{
  display:inline-flex;align-items:center;gap:6px;
  padding:8px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;
  font-size:13px;color:var(--vna-muted);
}
.vna-cta-checklist li::before{content:'✓';color:var(--vna-green);font-weight:800;}

/* =====================================================
   REVEAL ANIMATION
   ===================================================== */
.nero-ai-reveal{
  opacity:0;transform:translateY(22px);
  transition:opacity .55s ease,transform .55s ease;
}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
.nero-ai-delay-3{transition-delay:.36s;}

/* Boris block styles in section */

.vna-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vna-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vna-accent);border:1px solid rgba(121,242,255,.2)}
.vna-flow .arr{color:var(--vna-muted);font-size:16px;padding:0 4px;background:none;border:none}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-obrabotka-zayavok-s-sayta-page" role="main" tabindex="-1">

<section class="nero-ai-hero vzay-hero-zayavok" id="hero" aria-labelledby="vzay-hero-title">
<style>
/* === АЛИНА: hero scoped .vzay-hero-zayavok — самодостаточный первый экран === */
.vzay-hero-zayavok {
  --vzay-cyan: #79f2ff;
  --vzay-text: #eef4ff;
  --vzay-soft: rgba(238, 244, 255, 0.82);
  --vzay-muted: rgba(207, 227, 249, 0.72);
  --vzay-shadow: 0 28px 80px rgba(0, 0, 0, 0.45);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--vzay-text);
}
.vzay-hero-zayavok::before {
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
.vzay-hero-zayavok::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(6px);
  animation: vzayHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vzayHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vzay-hero-zayavok .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vzay-hero-zayavok .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
@media (max-width: 960px) {
  .vzay-hero-zayavok .nero-ai-hero-grid { grid-template-columns: 1fr; }
}
.vzay-hero-zayavok .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.6vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vzay-hero-zayavok .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vzay-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vzay-hero-zayavok .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vzay-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vzay-hero-zayavok .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vzay-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vzay-hero-zayavok .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vzay-hero-zayavok .nero-ai-badge {
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
.vzay-hero-zayavok .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vzay-hero-zayavok .nero-ai-btn {
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
.vzay-hero-zayavok .nero-ai-btn:hover { transform: translateY(-2px); }
.vzay-hero-zayavok .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vzay-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vzay-hero-zayavok .nero-ai-btn-secondary {
  color: var(--vzay-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vzay-hero-zayavok .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vzay-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vzay-hero-zayavok .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vzay-hero-zayavok .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vzay-hero-zayavok .nero-ai-dots { display: flex; gap: 7px; }
.vzay-hero-zayavok .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vzay-hero-zayavok .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vzay-hero-zayavok .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vzay-hero-zayavok .nero-ai-dot:nth-child(3) { background: #34d399; }
.vzay-hero-zayavok .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vzay-hero-zayavok .nero-ai-window-body { padding: 16px; }
.vzay-hero-zayavok .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vzay-hero-zayavok .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vzay-hero-zayavok .nero-ai-live-pill {
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
.vzay-hero-zayavok .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vzayPulse 1.6s infinite;
}
@keyframes vzayPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vzay-hero-zayavok .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vzay-hero-zayavok .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vzay-hero-zayavok .nero-ai-metric span {
  display: block;
  color: var(--vzay-muted);
  font-size: 11px;
  font-weight: 700;
}
.vzay-hero-zayavok .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vzay-hero-zayavok .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vzay-hero-zayavok .vzay-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(circle at 50% 40%, rgba(121, 242, 255, 0.06), rgba(2, 6, 23, 0.9));
}
.vzay-hero-zayavok #vzay-lead-intake-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vzay-hero-zayavok .nero-ai-task-stream {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.vzay-hero-zayavok .nero-ai-task {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
}
.vzay-hero-zayavok .nero-ai-task-icon {
  width: 32px;
  height: 32px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 800;
  background: rgba(121, 242, 255, 0.12);
  color: var(--vzay-cyan);
}
.vzay-hero-zayavok .nero-ai-task strong {
  display: block;
  color: #fff;
  font-size: 13px;
}
.vzay-hero-zayavok .nero-ai-task span {
  display: block;
  color: var(--vzay-muted);
  font-size: 11px;
  margin-top: 2px;
}
.vzay-hero-zayavok .nero-ai-status {
  font-size: 11px;
  font-weight: 800;
  color: #86efac;
  text-transform: uppercase;
  letter-spacing: .06em;
}
.vzay-hero-zayavok .nero-ai-status--amber { color: #fcd34d; }
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai обработка заявок</p>
      <h1 id="vzay-hero-title">AI-агент для первичной обработки заявок с сайта: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Ответ за 5–15 секунд, уточняющие вопросы и горячий лид в CRM — без ночных «мёртвых» заявок</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы">
        <li class="nero-ai-badge">Ответ 5–15 сек</li>
        <li class="nero-ai-badge">Квалификация лида</li>
        <li class="nero-ai-badge">amoCRM / Bitrix24</li>
        <li class="nero-ai-badge">24/7</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демонстрация AI-обработки заявок с сайта">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Заявки с сайта · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Ответ</span><strong>12 с</strong><small>первичный</small></div>
            <div class="nero-ai-metric"><span>Лиды</span><strong>18</strong><small>за ночь</small></div>
            <div class="nero-ai-metric"><span>CRM</span><strong>auto</strong><small>без копипаста</small></div>
            <div class="nero-ai-metric"><span>Эскалация</span><strong>12%</strong><small>на человека</small></div>
          </div>
          <div class="vzay-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vzay-lead-intake-canvas" role="img" aria-label="Анимация: заявки с формы, чата и мессенджера квалифицируются AI и уходят в CRM за секунды"></canvas>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента событий заявок">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">IN</span>
              <div><strong>Заявка с формы</strong><span>23:40 · лендинг услуги</span></div>
              <span class="nero-ai-status">принято</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Квалификация</strong><span>срок, город, бюджет</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Сделка + задача</strong><span>менеджеру на 10:00</span></div>
              <span class="nero-ai-status nero-ai-status--amber">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * vzay-lead-intake-engine — Диспетчерская мгновенных заявок с сайта
 * Мир: лучи каналов → пульс квалификации → горячий лид в CRM-док
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vzay-lead-intake-canvas");
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
    hub: "#1e293b",
    hubAccent: "#79f2ff",
    hubHot: "#f97316",
    crmGreen: "#22c55e",
    beam: "rgba(121,242,255,0.45)",
    beamHot: "rgba(249,115,22,0.55)",
    form: "#60a5fa",
    chat: "#a78bfa",
    tg: "#38bdf8",
    night: "#fbbf24",
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

  /* Лучи от трёх каналов входа */
  function ChannelBeamRouter() {
    this.packets = [
      { ch: 0, t: 0 },
      { ch: 1, t: 0.35 },
      { ch: 2, t: 0.7 }
    ];
  }
  ChannelBeamRouter.prototype.draw = function (ctx) {
    var sources = [
      { x: -165, y: -55, label: "Форма", color: C.form, icon: "□" },
      { x: -165, y: 15, label: "Чат", color: C.chat, icon: "…" },
      { x: -165, y: 85, label: "TG", color: C.tg, icon: "@" }
    ];
    sources.forEach(function (s) {
      drawRR(ctx, s.x - 22, s.y - 14, 44, 28, 8, "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = s.color;
      ctx.font = "bold 10px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(s.icon, s.x, s.y - 2);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText(s.label, s.x, s.y + 10);
    });

    this.packets.forEach(function (p) {
      p.t = (p.t + 0.0045) % 1;
      var s = sources[p.ch];
      var tx = -25;
      var ty = 10;
      var bx = s.x + (tx - s.x) * p.t;
      var by = s.y + (ty - s.y) * p.t + Math.sin(p.t * Math.PI) * -18;
      ctx.strokeStyle = p.t > 0.75 ? C.beamHot : C.beam;
      ctx.lineWidth = 2;
      ctx.setLineDash([5, 6]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath();
      ctx.moveTo(s.x + 20, s.y);
      ctx.quadraticCurveTo((s.x + tx) / 2, (s.y + ty) / 2 - 30, tx, ty);
      ctx.stroke();
      ctx.setLineDash([]);
      drawRR(ctx, bx - 8, by - 6, 16, 12, 3, "#f8fafc", C.outline);
    });
  };

  /* Центральная консоль квалификации */
  function QualificationPulseHub() {
    this.ring = 0;
  }
  QualificationPulseHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.ring = (Math.sin(frame * 0.07) + 1) / 2;

    drawRR(ctx, -48, -58, 96, 118, 12, C.hub, C.outline);
    for (var r = 0; r < 3; r++) {
      ctx.strokeStyle = "rgba(121,242,255," + (0.15 + r * 0.08) + ")";
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(0, 0, 28 + r * 14 + this.ring * 6, 0, Math.PI * 2);
      ctx.stroke();
    }

    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("SLA", 0, -38);
    ctx.fillStyle = C.hubAccent;
    ctx.font = "bold 14px Inter,sans-serif";
    var sec = prg < 40 ? Math.floor(prg * 0.3) + 1 : 12;
    ctx.fillText(sec + " с", 0, -22);

    var qs = ["Город?", "Срок?", "Бюджет?"];
    qs.forEach(function (q, i) {
      if (prg > 45 + i * 28 && prg < 130) {
        var alpha = Math.min(1, (prg - 45 - i * 28) / 12);
        ctx.globalAlpha = alpha;
        drawRR(ctx, -34, -8 + i * 22, 68, 16, 4, "rgba(255,255,255,0.1)", C.hubAccent);
        ctx.fillStyle = "#e2e8f0";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.fillText(q, 0, 4 + i * 22);
        ctx.globalAlpha = 1;
      }
    });

    if (prg >= 130 && prg < 200) {
      ctx.fillStyle = C.hubHot;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("горячий", 0, 52);
    }
  };

  function NightGapClock() {}
  NightGapClock.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 108, -78, 54, 22, 6, "rgba(251,191,36,0.12)", C.night);
    ctx.fillStyle = C.night;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("23:40", 135, -64);
    if (prg > 8 && prg < 45) {
      ctx.fillStyle = "rgba(251,191,36,0.7)";
      ctx.font = "7px Inter,sans-serif";
      ctx.fillText("ночь", 135, -52);
    }
  };

  function ConsentFlare152() {}
  ConsentFlare152.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 70 || prg > 120) return;
    var a = prg < 85 ? (prg - 70) / 15 : 1 - (prg - 105) / 15;
    ctx.globalAlpha = Math.max(0, Math.min(1, a));
    drawRR(ctx, 92, 42, 58, 20, 5, "rgba(34,197,94,0.2)", C.crmGreen);
    ctx.fillStyle = "#bbf7d0";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("✓ 152-ФЗ", 121, 55);
    ctx.globalAlpha = 1;
  };

  function CrmDockPanel() {}
  CrmDockPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 118, -18, 72, 88, 10, "rgba(15,23,42,0.85)", C.outline);
    ctx.fillStyle = C.hubAccent;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CRM", 154, -4);

    if (prg >= 200) {
      var lift = Math.min(1, (prg - 200) / 22);
      var cardY = 8 - lift * 28;
      drawRR(ctx, 128, cardY, 52, 34, 6, "rgba(34,197,94,0.28)", C.crmGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("Лид", 154, cardY + 14);
      ctx.font = "7px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("задача 10:00", 154, cardY + 26);

      if (prg > 215 && prg < 248) {
        var pulse = (prg - 215) / 33;
        ctx.strokeStyle = "rgba(34,197,94," + (0.85 - pulse * 0.75) + ")";
        ctx.lineWidth = 2.5;
        ctx.beginPath();
        ctx.arc(154, cardY + 17, 12 + pulse * 36, 0, Math.PI * 2);
        ctx.stroke();
      }
    }
  };

  function EscalationRing() {}
  EscalationRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 155 || prg > 195) return;
    ctx.strokeStyle = "rgba(251,113,133,0.55)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(-95, 72, 16 + Math.sin(frame * 0.12) * 3, 0, Math.PI * 2 * 0.12);
    ctx.stroke();
    ctx.fillStyle = "#fda4af";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("12% HITL", -95, 76);
  };

  function WebhookAckStrip() {}
  WebhookAckStrip.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 20 || prg > 55) return;
    drawRR(ctx, -155, -95, 70, 14, 4, "rgba(255,255,255,0.08)", C.outline);
    ctx.fillStyle = C.hubAccent;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HTTP 200 · &lt;3 с", -120, -85);
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
    var hubTargets = {
      "1_architect": { x: -75, y: 78 },
      "2_seo": { x: -25, y: 88 },
      "3_coder": { x: 25, y: 88 },
      "4_designer": { x: 75, y: 78 },
      "5_deployer": { x: 0, y: 98 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: 85 };

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
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
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
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new ChannelBeamRouter());
  entities.push(new WebhookAckStrip());
  entities.push(new NightGapClock());
  entities.push(new QualificationPulseHub());
  entities.push(new ConsentFlare152());
  entities.push(new EscalationRing());
  entities.push(new CrmDockPanel());
  entities.push(new Agent(-150, 102, C.agentYellow, "1_architect", 14, [
    "Карта форм и чата", "Webhook на middleware", "Один лид — одна карточка"
  ]));
  entities.push(new Agent(-85, 108, C.agentGreen, "2_seo", 52, [
    "Тег: ночная заявка", "Ключ: ai обработка заявок", "Горячий, не сырой телефон"
  ]));
  entities.push(new Agent(-15, 110, C.agentBlue, "3_coder", 96, [
    "Очередь Redis", "JSON лида", "200 OK за 2.8 с"
  ]));
  entities.push(new Agent(55, 108, C.agentPink, "4_designer", 138, [
    "Первый ответ 12 с", "Уточняющие вопросы", "Без обещания скидки"
  ]));
  entities.push(new Agent(125, 102, C.agentPurple, "5_deployer", 182, [
    "amoCRM: сделка", "Задача на 10:00", "Менеджер с контекстом"
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
    if (prg >= 12 && prg < 12.05) createBubble(-130, -30, "1. Форма 23:40");
    if (prg >= 48 && prg < 48.05) createBubble(-60, 0, "2. Диалог AI");
    if (prg >= 98 && prg < 98.05) createBubble(0, -15, "3. Квалификация");
    if (prg >= 148 && prg < 148.05) createBubble(40, 40, "4. Согласие ПДн");
    if (prg >= 205 && prg < 205.05) createBubble(120, 10, "5. CRM + задача");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.hubAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 11);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  engineloop();
});
</script>

<div class="vna-content">

  <section class="vna-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vna-cnt">
      <div class="vna-intro-grid nero-ai-reveal">
        <div class="vna-intro-text">
          <p class="vna-eyebrow">Лонгрид · ai обработка заявок</p>
          <p><strong>Коротко:</strong> Nero Network внедряет AI-агента между формой, чатом или мессенджером и вашей CRM: первый ответ за 5–15 секунд, уточняющие вопросы по скрипту продаж, квалификация лида и передача «горячей» заявки менеджеру — без ночных «мёртвых» обращений.</p>
          <p>Заявка с сайта — это человек, который <strong>сейчас</strong> готов обсудить услугу. Пока менеджер спит или в совещании, лид остывает. <strong>AI обработка заявок</strong> закрывает разрыв между отправкой формы и осмысленной карточкой в amoCRM или Битрикс24.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ориентиры скорости ответа">
          <div class="vna-kpi-card"><div class="kv">13 мин</div><div class="kl">медиана ответа на lead form</div><div class="ks">Hennessey Digital, 2025</div></div>
          <div class="vna-kpi-card"><div class="kv">5–15 с</div><div class="kl">целевой SLA Nero Network</div><div class="ks">первичный ответ AI</div></div>
          <div class="vna-kpi-card"><div class="kv">24/7</div><div class="kl">ночные и выходные заявки</div><div class="ks">без очереди «позже»</div></div>
          <div class="vna-kpi-card"><div class="kv">120–350К</div><div class="kl">ориентир проекта под ключ</div><div class="ks">+ поддержка</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-ostyvayut">Проблема</a>
        <a href="#chto-takoe-ai">Что такое AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#audit-zayavok">Аудит заявок</a>
      </nav>
    </div>
  </div>


  <section class="vna-section" id="pochemu-ostyvayut">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Потери лидов</span>
        <h2>Почему заявки с сайта «остывают» и сколько лидов теряется без мгновенного ответа</h2>
        <p>Заявка с сайта — это не «ещё одна строка в таблице». Это человек, который <strong>сейчас</strong> готов обсудить услугу, курс или приём у врача.</p>
      </div>
      <p class="nero-ai-reveal"><strong>Определение:</strong> «Мёртвая» заявка — обращение, на которое бизнес не ответил в разумный срок или ответил шаблоном без уточнения потребности; лид перестаёт ждать и уходит к другому поставщику или откладывает покупку.</p>
      <h3 class="nero-ai-reveal" style="margin-top:28px;color:var(--vna-heading)">Типичные задержки в услугах, клиниках и онлайн-школах</h3>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table" aria-label="Каналы заявок и типичные проблемы">
          <thead><tr><th>Канал входа</th><th>Что видит клиент</th><th>Типичная проблема</th></tr></thead>
          <tbody>
            <tr><td>Форма на сайте</td><td>«Спасибо, мы перезвоним»</td><td>Нет диалога, непонятно, когда ждать звонка</td></tr>
            <tr><td>Виджет чата</td><td>«Оператор ответит позже»</td><td>Ночью и в выходные очередь пустая</td></tr>
            <tr><td>Telegram / WhatsApp / VK</td><td>Сообщение «висит»</td><td>Несколько менеджеров, нет единого SLA</td></tr>
            <tr><td>Звонок с сайта</td><td>Пропущенный вызов</td><td>Обратный звонок на следующий день</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">В сегменте услуг и B2B задержка в <strong>часы</strong> — норма, если нет выделенного отдела продаж. В клиниках и онлайн-школах пик заявок часто приходится на вечер; без <strong>автоматического ответа на заявку с сайта</strong> вы платите за трафик, но не за разговор.</p>
      <p class="nero-ai-reveal">Внешний ориентир по скорости ответа: в исследовании Hennessey Digital (Q1 2025) по lead form у юридических фирм США <strong>медиана времени ответа — 13 минут</strong>; 25% компаний отвечают быстрее 5 минут, а 39% — позже двух часов или не отвечают вовсе (<a href="https://hennessey.com/2025-lead-form-response-time-study/" target="_blank" rel="noopener noreferrer" style="color:var(--vna-accent);text-decoration:underline">hennessey.com</a>). Классический разбор Harvard Business Review (2011) показывает: контакт в <strong>первый час</strong> сильно повышает шанс квалификации лида по сравнению с ответом на следующий день.</p>
      <div class="vna-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="vna-card">
          <h3>Горячий, тёплый и нецелевой лид</h3>
          <p><strong>Горячий лид</strong> — сформулированная потребность, срок, бюджет или готовность к следующему шагу. <strong>Тёплый</strong> — интерес есть, но нужны уточнения. <strong>Нецелевой</strong> — запрос вне вашего предложения; его важно отсечь <strong>до</strong> звонка менеджера.</p>
        </div>
        <div class="vna-card">
          <h3>Итог блока</h3>
          <p>Скорость первого ответа и структура диалога напрямую влияют на конверсию. <strong>AI обработка заявок</strong> закрывает разрыв между моментом отправки формы и появлением осмысленной карточки в CRM.</p>
        </div>
      </div>
      <div class="vna-related nero-ai-reveal" style="margin-top:28px" aria-label="Смежные материалы Nero Network">
        <p style="margin:0 0 14px;font-size:15px;line-height:1.65;color:var(--vna-muted);">Заявки часто дублируются письмами на общий ящик — тогда имеет смысл сопоставить с <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-обработкой входящей почты в CRM под ключ</a>: тот же принцип triage и маршрутизации, но для email-потока.</p>
        <p style="margin:0;font-size:15px;line-height:1.65;color:var(--vna-muted);">Если основная CRM — amoCRM, полезно заранее понять стык сделок и задач: отдельный разбор — <a href="/vnedrenie-ai-amocrm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> без ручного переноса полей из чата.</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="chto-takoe-ai">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Определение 2026</span>
        <h2>Что такое AI-обработка заявок с сайта в 2026 году</h2>
        <p><strong>AI-обработка заявок</strong> — автоматизированная первичная обработка обращений: приём сообщения, диалог, извлечение данных, классификация и <strong>действия в CRM</strong>, а не только вывод текста в чат.</p>
      </div>
      <p class="nero-ai-reveal">В 2026 году рынок смещается от скриптового «чат-бота» к <strong>агентным сценариям</strong>: модель не только отвечает, но и <strong>выполняет шаги</strong> в подключённых системах — тренд workspace agents (<a href="https://openai.com/index/introducing-workspace-agents-in-chatgpt/" target="_blank" rel="noopener noreferrer" style="color:var(--vna-accent)">openai.com</a>) и развитие AI-агента внутри amoCRM (<a href="https://new.amocrm.ru/changelog" target="_blank" rel="noopener noreferrer" style="color:var(--vna-accent)">changelog 2026</a>).</p>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table" aria-label="Чат-бот vs AI-агент">
          <thead><tr><th>Критерий</th><th>Классический чат-бот</th><th>AI-агент первичной обработки</th></tr></thead>
          <tbody>
            <tr><td>Диалог</td><td>Кнопки и жёсткие ветки</td><td>Свободный текст + уточняющие вопросы</td></tr>
            <tr><td>CRM</td><td>Часто вручную или не связан</td><td>Создание/обновление сделки, поля, задачи</td></tr>
            <tr><td>Эскалация</td><td>«Позовите оператора» без контекста</td><td>Резюме диалога, категория, human-in-the-loop</td></tr>
            <tr><td>Ограничения</td><td>Ломается вне сценария</td><td>Правила запрещённых обещаний и эскалация</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">Кейс Velmi на Habr (Bitrix24): из-за лимита <strong>ответа webhook за 3 секунды</strong> команда строила <strong>асинхронную</strong> схему (FastAPI, Redis, GPT) — иначе портал повторяет запросы (<a href="https://habr.com/ru/articles/1045026/" target="_blank" rel="noopener noreferrer" style="color:var(--vna-accent)">habr.com</a>).</p>
      <h3 class="nero-ai-reveal" style="margin-top:24px;color:var(--vna-heading)">Каналы: форма, виджет, Telegram, WhatsApp</h3>
      <ol class="nero-ai-reveal" style="padding-left:20px;color:var(--vna-muted);line-height:1.7">
        <li><strong>Форма</strong> (Tilda, WordPress, кастом) — webhook при отправке.</li>
        <li><strong>Виджет на сайт</strong> — сообщения через API.</li>
        <li><strong>Telegram</strong> — Bot API; для ПДн нужны согласия и учёт 152-ФЗ.</li>
        <li><strong>WhatsApp Business</strong> — с учётом политик для РФ.</li>
        <li><strong>VK</strong> и «Открытые линии» Битрикс24 — единая очередь с CRM.</li>
      </ol>
      <p class="nero-ai-reveal"><strong>Коротко:</strong> <strong>ai менеджер заявок</strong> в 2026 году — это слой между всеми точками входа и вашей воронкой, а не замена отдела продаж.</p>
    </div>
  </section>


<section id="vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block" class="bza-root" aria-label="Анимация: диалог квалификации заявки и сборка карточки CRM">
<style>
/* === БОРИС: prefix bza-, scoped внутри #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block === */
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block.bza-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-ey{
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
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-ey::before{
  content:'';
  width:18px;height:2px;
  background:#6366f1;
  border-radius:1px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(99,102,241,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#4f46e5;
  margin-top:1px;
  font-style:normal;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-pl-b{
  background:rgba(99,102,241,.08);
  color:#4338ca;
  border:1.5px solid rgba(99,102,241,.22);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-pl-c{
  background:rgba(6,182,212,.08);
  color:#0e7490;
  border:1.5px solid rgba(6,182,212,.22);
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-rgt{
  position:relative;
  background:linear-gradient(145deg,#f5f3ff 0%,#eef2ff 42%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #vnedrenie-ai-obrabotka-zayavok-s-sayta-boris-block .bza-rgt{min-height:380px;}
}
#bza-script-lane-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bza-cnt">
  <div class="bza-card">

    <div class="bza-lft">
      <span class="bza-ey">Квалификация в диалоге</span>
      <h3 class="bza-h3">Из «спасибо, перезвоним» — в карточку CRM с контекстом за один цикл</h3>
      <ul class="bza-ul">
        <li><span class="bza-ic">⚡</span>Мгновенное подтверждение и старт диалога — в пределах SLA 5–15 секунд</li>
        <li><span class="bza-ic">?</span>Уточняющие вопросы по скрипту: срок, бюджет, формат услуги</li>
        <li><span class="bza-ic">◆</span>Тег лида: горячий / тёплый / нецелевой — до звонка менеджера</li>
        <li><span class="bza-ic">☑</span>Согласие 152-ФЗ и structured JSON → поля сделки без копипаста</li>
      </ul>
      <div class="bza-pills">
        <span class="bza-pl bza-pl-g">Ответ ~12 с</span>
        <span class="bza-pl bza-pl-b">Скрипт + свободный текст</span>
        <span class="bza-pl bza-pl-c">Задача менеджеру 10:00</span>
      </div>
      <p class="bza-foot">Дальше — пошаговый сценарий первичной обработки за 5–15 секунд →</p>
    </div>

    <div class="bza-rgt">
      <canvas
        id="bza-script-lane-canvas"
        aria-label="Анимация: диалог AI с посетителем, классификация лида и заполнение полей CRM"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bza-script-lane-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, fr = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 440;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a',
    muted:'#64748b',
    lane:'rgba(99,102,241,.22)',
    laneAct:'#6366f1',
    dot:'#22c55e',
    dotGlow:'rgba(34,197,94,.35)',
    bubbleV:'#ffffff',
    bubbleVb:'#cbd5e1',
    bubbleA:'#eef2ff',
    bubbleAb:'#a5b4fc',
    hot:'#dc2626',
    warm:'#d97706',
    crm:'#0ea5e9',
    field:'#e0f2fe',
    fieldB:'#7dd3fc',
    task:'#8b5cf6'
  };

  var STATIONS = [
    {label:'ACK 12 с', sub:'заявка принята'},
    {label:'Вопросы', sub:'скрипт продаж'},
    {label:'Класс', sub:'горячий лид'},
    {label:'CRM', sub:'поля сделки'},
    {label:'Задача', sub:'менеджеру'}
  ];

  var LOOP = 640;
  var pathPts = [];

  function buildPath(){
    pathPts = [];
    var padX = W * 0.08;
    var y0 = H * 0.22;
    var y1 = H * 0.78;
    var xL = padX + 24;
    var xR = W - padX - 24;
    var midY = (y0 + y1) * 0.5;
    for (var i = 0; i <= 120; i++){
      var t = i / 120;
      var x = xL + (xR - xL) * t;
      var wave = Math.sin(t * Math.PI * 2) * (H * 0.08);
      var y = midY + wave + (t < 0.5 ? (y0 - midY) * (1 - t * 2) : (y1 - midY) * ((t - 0.5) * 2));
      pathPts.push({x:x, y:y});
    }
  }

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else {
      ctx.moveTo(x+r,y); ctx.arcTo(x+w,y,x+w,y+h,r);
      ctx.arcTo(x+w,y+h,x,y+h,r); ctx.arcTo(x,y+h,x,y,r);
      ctx.arcTo(x,y,x+w,y,r); ctx.closePath();
    }
    if (fill){ ctx.fillStyle=fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawPath(){
    if (pathPts.length < 2) return;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    ctx.beginPath();
    ctx.moveTo(pathPts[0].x, pathPts[0].y);
    for (var i = 1; i < pathPts.length; i++) ctx.lineTo(pathPts[i].x, pathPts[i].y);
    ctx.strokeStyle = C.lane;
    ctx.lineWidth = 10;
    ctx.stroke();
    ctx.strokeStyle = 'rgba(99,102,241,.55)';
    ctx.lineWidth = 2;
    ctx.setLineDash([6, 10]);
    ctx.stroke();
    ctx.setLineDash([]);
  }

  function stationPos(i){
    var t = i / (STATIONS.length - 1);
    var idx = Math.round(t * (pathPts.length - 1));
    return pathPts[idx] || {x:W*0.5,y:H*0.5};
  }

  function drawStations(progress){
    STATIONS.forEach(function(st, i){
      var p = stationPos(i);
      var lit = progress >= i / (STATIONS.length - 1) - 0.02;
      var r = lit ? 26 : 22;
      rr(p.x - r, p.y - r, r*2, r*2, 12, lit ? '#fff' : 'rgba(255,255,255,.85)', lit ? C.laneAct : '#cbd5e1', lit ? 2.5 : 1.5);
      ctx.fillStyle = lit ? C.ink : C.muted;
      ctx.font = 'bold 11px Inter,system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(st.label, p.x, p.y + 4);
      ctx.font = '10px Inter,system-ui,sans-serif';
      ctx.fillStyle = C.muted;
      ctx.fillText(st.sub, p.x, p.y + r + 14);
    });
  }

  function drawChat(phase){
    if (phase < 0.12 || phase > 0.72) return;
    var alpha = phase < 0.2 ? (phase - 0.12) / 0.08 : phase > 0.65 ? (0.72 - phase) / 0.07 : 1;
    var bx = W * 0.12;
    var by = H * 0.08;
    ctx.globalAlpha = Math.max(0, Math.min(1, alpha));
    rr(bx, by, W*0.36, 52, 10, C.bubbleV, C.bubbleVb, 1);
    ctx.fillStyle = C.ink;
    ctx.font = '12px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Нужен аудит заявок с сайта', bx + 12, by + 22);
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,system-ui,sans-serif';
    ctx.fillText('посетитель · форма 23:41', bx + 12, by + 40);

    rr(bx + 8, by + 62, W*0.4, 48, 10, C.bubbleA, C.bubbleAb, 1);
    ctx.fillStyle = '#312e81';
    ctx.font = '12px Inter,system-ui,sans-serif';
    ctx.fillText('Когда удобен звонок? Какой бюджет?', bx + 20, by + 82);
    ctx.fillText('и из какого города заявка?', bx + 20, by + 98);
    ctx.globalAlpha = 1;
  }

  function drawCrmCard(phase){
    if (phase < 0.55) return;
    var a = Math.min(1, (phase - 0.55) / 0.12);
    var cx = W * 0.58;
    var cy = H * 0.52;
    var cw = Math.min(200, W * 0.34);
    var ch = 130;
    ctx.globalAlpha = a;
    rr(cx, cy, cw, ch, 12, '#fff', C.crm, 2);
    ctx.fillStyle = C.crm;
    ctx.font = 'bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Сделка · горячий', cx + 12, cy + 22);
    var fields = ['Телефон', 'Город', 'Бюджет', 'Срок'];
    fields.forEach(function(f, i){
      var fy = cy + 38 + i * 22;
      rr(cx + 12, fy, cw - 24, 16, 4, C.field, C.fieldB, 1);
      ctx.fillStyle = C.muted;
      ctx.font = '10px Inter,system-ui,sans-serif';
      ctx.fillText(f + ': заполнено AI', cx + 18, fy + 12);
    });
    if (phase > 0.78){
      rr(cx + 12, cy + ch - 28, cw - 24, 20, 6, 'rgba(139,92,246,.12)', C.task, 1.5);
      ctx.fillStyle = '#5b21b6';
      ctx.font = 'bold 10px Inter,system-ui,sans-serif';
      ctx.fillText('Задача: перезвон 10:00', cx + 18, cy + ch - 14);
    }
    ctx.globalAlpha = 1;
  }

  function drawHotTag(phase){
    if (phase < 0.38 || phase > 0.9) return;
    var p = stationPos(2);
    var pulse = 0.85 + 0.15 * Math.sin(fr * 0.12);
    ctx.beginPath();
    ctx.arc(p.x, p.y - 36, 28 * pulse, 0, Math.PI * 2);
    ctx.fillStyle = 'rgba(220,38,38,.12)';
    ctx.fill();
    rr(p.x - 34, p.y - 50, 68, 22, 99, 'rgba(220,38,38,.1)', C.hot, 1.5);
    ctx.fillStyle = C.hot;
    ctx.font = 'bold 10px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('ГОРЯЧИЙ', p.x, p.y - 36);
  }

  function drawDot(tPath){
    if (!pathPts.length) return;
    var idx = Math.floor(tPath * (pathPts.length - 1));
    var p = pathPts[idx];
    ctx.beginPath();
    ctx.arc(p.x, p.y, 14, 0, Math.PI * 2);
    ctx.fillStyle = C.dotGlow;
    ctx.fill();
    ctx.beginPath();
    ctx.arc(p.x, p.y, 7, 0, Math.PI * 2);
    ctx.fillStyle = C.dot;
    ctx.fill();
  }

  function tick(){
    fr++;
    var phase = (fr % LOOP) / LOOP;
    buildPath();
    ctx.clearRect(0, 0, W, H);

    ctx.fillStyle = C.ink;
    ctx.font = 'bold 13px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('ScriptDialogueAssembler · демо', 16, 22);
    ctx.fillStyle = C.muted;
    ctx.font = '11px Inter,system-ui,sans-serif';
    ctx.fillText('продолжение ночной диспетчерской hero', 16, 38);

    drawPath();
    drawStations(phase);
    drawChat(phase);
    drawHotTag(phase);
    drawCrmCard(phase);
    drawDot(phase);

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
</section>

  <section class="vna-section" id="kak-rabotaet">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Сценарий 5–15 секунд</span>
        <h2>Как работает первичная обработка: сценарий за 5–15 секунд</h2>
        <p>Коммерческий оффер Nero Network: <strong>ответ за 5–15 секунд</strong>, уточняющие вопросы и передача квалифицированного лида в CRM.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>Уточняющие вопросы и квалификация</h3>
          <ul>
            <li><strong>Потребность:</strong> услуга, курс, специализация врача</li>
            <li><strong>Срок:</strong> когда планируют старт / визит</li>
            <li><strong>Бюджет:</strong> вилка без обещания скидки агентом</li>
            <li><strong>География:</strong> город, филиал, доставка</li>
            <li><strong>Контакт:</strong> телефон или email — после согласия на ПДн</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3>Что делает AI vs человек</h3>
          <p><strong>AI:</strong> первый ответ, извлечение полей, классификация, заполнение CRM, уведомление менеджера.</p>
          <p><strong>Человек:</strong> переговоры по цене, жалобы, договор, проверка аномалий.</p>
          <p>Агент <strong>не</strong> должен обещать юридически значимые формулировки, фиксированные цены вне прайса и медицинские рекомендации.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="etapy">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Внедрение AI-агентов под ключ: этапы и сроки</h2>
        <p><strong>AI обработка заявок под ключ</strong> — проектная модель: ориентир бюджета <strong>120–350 тыс. ₽</strong> старт + поддержка.</p>
      </div>
      <div class="vna-timeline nero-ai-reveal">
        <div class="vna-tl-item"><span class="vna-tl-dot"></span><h3>Аудит (1–3 дня)</h3><p>Карта каналов, SLA, поля CRM, объём заявок. Фиксируем, <strong>сколько заявок вы теряете</strong> ночью и в выходные.</p></div>
        <div class="vna-tl-item"><span class="vna-tl-dot"></span><h3>Проектирование (3–5 дней)</h3><p>Сценарии диалога, матрица эскалации, JSON-схема лида, тексты согласия ПДн.</p></div>
        <div class="vna-tl-item"><span class="vna-tl-dot"></span><h3>MVP (7–14 дней)</h3><p>Один канал + amoCRM или Bitrix24; контур human_review для спорных ответов.</p></div>
        <div class="vna-tl-item"><span class="vna-tl-dot"></span><h3>Пилот (2–4 недели)</h3><p>Замер времени первого ответа, доли квалифицированных лидов и эскалаций; rollout на <strong>части трафика</strong>, не на всём сайте сразу.</p></div>
        <div class="vna-tl-item"><span class="vna-tl-dot"></span><h3>Масштабирование</h3><p>Второй канал, дедупликация, отчёты. Стек Make, n8n self-hosted, FastAPI — под политику ПДн.</p></div>
      </div>
      <div class="vna-cnt" style="margin:48px auto;">
        <div class="ym-cta-block nero-ai-reveal" id="cta-audit-mid">
          <div class="ym-cta-block__body">
            <p class="ym-cta-block__headline">Проверить, сколько заявок вы теряете</p>
            <p class="ym-cta-block__sub">За 30 минут разберём каналы (форма, чат, мессенджеры), ночной SLA и стык с amoCRM или Bitrix24 — без обязательства сразу подписывать внедрение.</p>
            <div class="ym-cta-block__actions">
              <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
              <a href="#stoimost" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Ориентир по бюджету</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">CRM и middleware</span>
        <h2>Интеграция с CRM: amoCRM, Bitrix24, Make и n8n</h2>
        <p><strong>Интеграция ai обработка заявок</strong> — ядро услуги: без записи в CRM агент остаётся «умным чатом». Когда нужна связка с учётом и ERP, а не только сделки в amoCRM, смотрите сценарий <a href="/ai-1c-erp/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-агента для 1С и ERP</a>.</p>
      </div>
      <div class="vna-flow nero-ai-reveal" aria-label="Схема webhook">
        <span>Событие формы/чата</span><span class="arr">→</span>
        <span>Middleware &lt;3 с 200 OK</span><span class="arr">→</span>
        <span>Очередь</span><span class="arr">→</span>
        <span>Диалог AI</span><span class="arr">→</span>
        <span>API CRM</span>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table" aria-label="Матрица Jivo / amoAI / кастом">
          <thead><tr><th>Ситуация</th><th>Jivo ИИ-оператор</th><th>amoAI</th><th>Кастом Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Быстрый старт, чат на сайте</td><td>Да</td><td>Частично</td><td>Пилот на одном канале</td></tr>
            <tr><td>Жёсткая форма + webhook</td><td>Ограничено</td><td>Нужна доработка</td><td>Да</td></tr>
            <tr><td>Две CRM / ERP</td><td>Нет</td><td>Нет</td><td>Да</td></tr>
            <tr><td>152-ФЗ, n8n в РФ</td><td>Заявление вендора</td><td>Политика amo + LLM</td><td>Проектная настройка</td></tr>
            <tr><td>Асинхронный Bitrix24 webhook</td><td>Зависит</td><td>—</td><td>Да (опыт Velmi)</td></tr>
          </tbody>
        </table>
      </div>
      <aside class="vna-card nero-ai-reveal" style="margin-top:28px;border-color:rgba(121,242,255,.22);" aria-label="Дополнительно про обучение">
        <p style="margin:0;font-size:15px;line-height:1.65;color:var(--vna-muted);">Если команда хочет понять логику агентов и интеграций до старта проекта — можно начать с материалов по автоматизации: <a href="<?php echo esc_url($secondary_cta_url_env); ?>" target="_blank" rel="noopener noreferrer" style="color:var(--vna-accent);text-decoration:underline;"><?php echo esc_html($secondary_cta_label); ?></a>. Внедрение под ключ Nero Network остаётся отдельным треком с аудитом и пилотом на одном канале.</p>
      </aside>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="stoimost">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Бюджет</span>
        <h2>Стоимость внедрения AI-обработки заявок</h2>
        <p>Запрос <strong>ai обработка заявок цена</strong> — один из главных коммерческих. Стоимость складывается из каналов, CRM, требований к ПДн и глубины сценариев.</p>
      </div>
      <div class="vna-grid-2 nero-ai-reveal">
        <div class="vna-card">
          <h3>Из чего складывается чек 120–350 тыс. ₽</h3>
          <ul>
            <li>аудит и проектирование сценариев;</li>
            <li>middleware и интеграция CRM;</li>
            <li>база знаний (FAQ, прайс, RAG);</li>
            <li>тестовый контур и пилот;</li>
            <li>обучение менеджеров.</li>
          </ul>
        </div>
        <div class="vna-card">
          <h3>Поддержка после запуска</h3>
          <p>Мониторинг SLA, правки промптов, разбор эскалаций, защита от повтор webhook, «галлюцинаций» цен, отсутствия перевода на человека при жалобе.</p>
          <p><strong>Итог:</strong> <strong>внедрение ai</strong> в обработку заявок сопоставимо по бюджету с частью ставки менеджера, но масштабируется на ночные и пиковые часы.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="dlya-kogo">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">ЦА</span>
        <h2>Для кого подходит: малый и средний бизнес</h2>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-card"><h3>Услуги B2B</h3><p>Квалификация по бюджету и ЛПР до звонка; стабильный поток заявок с сайта.</p></div>
        <div class="vna-card"><h3>Онлайн-школы</h3><p>Пики после вебинаров; агент фиксирует интерес к потоку и срок старта.</p></div>
        <div class="vna-card"><h3>Клиники</h3><p>Запись на приём и уточнение услуги; медицинские назначения — только человек.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px">Когда агент <strong>не</strong> нужен: мало заявок и менеджер стабильно отвечает за минуты. Сначала — <strong>аудит потерь</strong>.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="primer-vnedreniya">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Процесс</span>
        <h2>Пример внедрения: от заявки на сайте до сделки в CRM</h2>
        <p>Процессный сценарий без выдуманных метрик клиента Nero Network. На корпоративном масштабе те же шлюзы квалификации и managed-агенты уже разбирались в материале <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a> — идеи можно адаптировать к ночному потоку заявок с сайта.</p>
      </div>
      <ol class="nero-ai-reveal" style="padding-left:20px;color:var(--vna-muted);line-height:1.75;max-width:820px">
        <li>Посетитель пишет в чат на лендинге в 23:40.</li>
        <li>Middleware отвечает 200 OK, клиент видит: «Приняли запрос, уточню пару вопросов».</li>
        <li>Агент спрашивает город, срок и формат (очно/онлайн).</li>
        <li>Клиент оставляет телефон после галочки согласия ПДн.</li>
        <li>В amoCRM создаётся сделка «Квалифицирован», тег «ночная заявка», задача на 10:00.</li>
        <li>Утром менеджер звонит с готовым контекстом.</li>
      </ol>
    </div>
  </section>

  <section class="vna-section" id="riski-pdn">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Compliance</span>
        <h2>Риски, персональные данные и согласия</h2>
        <p>Внедрение затрагивает телефоны, имена и переписку — персональные данные по 152-ФЗ.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <h3>Чеклист для виджета и формы</h3>
        <ul>
          <li>информированное согласие до сбора телефона (ст. 9 152-ФЗ);</li>
          <li>ссылка на политику обработки ПДн;</li>
          <li>для Telegram-ботов — учёт уведомления РКН;</li>
          <li>договор с оператором LLM и контур обработки (YandexGPT / GigaChat vs OpenAI);</li>
          <li>маскирование чувствительных данных в логах;</li>
          <li>регламент хранения и удаления диалогов.</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">FAQ</span>
        <h2>Частые вопросы</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить AI-обработку заявок на существующий сайт?</div><div class="vna-faq-a">Обычно не нужно переписывать сайт: webhook формы или API виджета, middleware, интеграция с CRM. Начинается с одного канала и пилота.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли отдельный разработчик?</div><div class="vna-faq-a">Для типового стека (форма + amoCRM + Make/n8n) достаточно команды интегратора Nero Network. Свой разработчик — при нестандартной ERP или жёстком ИБ-аудите.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли оставить менеджеров только на «горячих» лидах?</div><div class="vna-faq-a">Да: агент обрабатывает первичку и нецелевых, человек — переговоры и закрытие. Доля эскалаций измеряется на пилоте.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai обработка заявок?</div><div class="vna-faq-a">Ориентир проекта <strong>120–350 тыс. ₽</strong> + поддержка; точная смета после аудита каналов и CRM.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Что если уже подключён amoAI или Jivo?</div><div class="vna-faq-a">amoAI закрывает сценарии внутри amoCRM; Jivo — быстрый чат. Кастом нужен при форме вне экосистемы, двух CRM, ERP, self-hosted n8n в РФ и асинхронных webhook Bitrix24.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Как доказать эффект?</div><div class="vna-faq-a">Пилот 2–4 недели: время первого ответа, доля квалифицированных лидов, доля эскалаций, сравнение с периодом «до» на том же канале.</div></div>
        <div class="vna-faq-item"><div class="vna-faq-q" role="button" tabindex="0" aria-expanded="false">Чем отличается от корпоративного ChatGPT?</div><div class="vna-faq-a">Workspace agents автоматизируют процессы <strong>сотрудников</strong> внутри компании. <strong>AI агент для сайта</strong> работает с <strong>клиентами</strong> на вашем домене и в вашей CRM.</div></div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="audit-zayavok">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Лид-магнит</span>
        <h2>Проверить, сколько заявок вы теряете</h2>
        <p>Nero Network предлагает <strong>аудит потерь заявок за 30 минут</strong> и дорожную карту: один канал → пилот → масштабирование <strong>ai обработка заявок под ключ</strong>.</p>
        <p><strong>Действие:</strong> оставьте заявку на аудит — разберём каналы, SLA и стык с amoCRM или Bitrix24 без обязательства сразу подписывать внедрение.</p>
      </div>
    </div>
  </section>

  <section class="vna-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="vna-cnt" style="text-align:center;">
      <span class="vna-eyebrow">Аудит потерь заявок</span>
      <h2 style="font-size:clamp(28px,4.2vw,48px);margin:14px auto 16px;max-width:720px;">Начните с диагностики каналов — не с «включить бота на всём сайте»</h2>
      <p style="max-width:600px;margin:0 auto 24px;font-size:16px;">Один канал → пилот 2–4 недели → масштабирование. Ориентир проекта 120–350 тыс. ₽ — после карты заявок и CRM.</p>
      <ul class="vna-cta-checklist">
        <li>Ответ 5–15 секунд</li>
        <li>Квалификация по скрипту</li>
        <li>CRM без ручного копирования</li>
        <li>152-ФЗ в проекте</li>
      </ul>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px;"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "https://www.meta-journal.ru/#organization",
      "name": "Nero Network",
      "url": "https://www.meta-journal.ru/"
    },
    {
      "@type": "WebSite",
      "@id": "https://www.meta-journal.ru/#website",
      "url": "https://www.meta-journal.ru/",
      "name": "Nero Network",
      "publisher": {
        "@id": "https://www.meta-journal.ru/#organization"
      }
    },
    {
      "@type": "WebPage",
      "@id": "https://www.meta-journal.ru/vnedrenie-ai-obrabotka-zayavok-s-sayta/#webpage",
      "url": "https://www.meta-journal.ru/vnedrenie-ai-obrabotka-zayavok-s-sayta/",
      "name": "AI-агент для первичной обработки заявок с сайта: внедрение под ключ",
      "description": "Внедрим AI-агента для первичной обработки заявок с формы и чата: ответ за 5–15 секунд, квалификация и передача лида в CRM. Аудит потерь заявок — бесплатно по заявке.",
      "isPartOf": {
        "@id": "https://www.meta-journal.ru/#website"
      },
      "about": {
        "@id": "https://www.meta-journal.ru/#organization"
      }
    },
    {
      "@type": "BreadcrumbList",
      "@id": "https://www.meta-journal.ru/vnedrenie-ai-obrabotka-zayavok-s-sayta/#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Главная",
          "item": "https://www.meta-journal.ru/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "AI-агент для первичной обработки заявок с сайта: внедрение под ключ",
          "item": "https://www.meta-journal.ru/vnedrenie-ai-obrabotka-zayavok-s-sayta/"
        }
      ]
    },
    {
      "@type": "Service",
      "@id": "https://www.meta-journal.ru/vnedrenie-ai-obrabotka-zayavok-s-sayta/#service",
      "name": "AI-агент для первичной обработки заявок с сайта: внедрение под ключ",
      "description": "Внедрим AI-агента для первичной обработки заявок с формы и чата: ответ за 5–15 секунд, квалификация и передача лида в CRM. Аудит потерь заявок — бесплатно по заявке.",
      "url": "https://www.meta-journal.ru/vnedrenie-ai-obrabotka-zayavok-s-sayta/",
      "provider": {
        "@id": "https://www.meta-journal.ru/#organization"
      }
    },
    {
      "@type": "FAQPage",
      "@id": "https://www.meta-journal.ru/vnedrenie-ai-obrabotka-zayavok-s-sayta/#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Как внедрить AI-обработку заявок на существующий сайт?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Обычно не нужно переписывать сайт: webhook формы или API виджета, middleware, интеграция с CRM. Начинается с одного канала и пилота."
          }
        },
        {
          "@type": "Question",
          "name": "Нужен ли отдельный разработчик?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Для типового стека (форма + amoCRM + Make/n8n) достаточно команды интегратора Nero Network. Свой разработчик — при нестандартной ERP или жёстком ИБ-аудите."
          }
        },
        {
          "@type": "Question",
          "name": "Можно ли оставить менеджеров только на «горячих» лидах?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да: агент обрабатывает первичку и нецелевых, человек — переговоры и закрытие. Доля эскалаций измеряется на пилоте."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько стоит ai обработка заявок?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Ориентир проекта 120–350 тыс. ₽ + поддержка; точная смета после аудита каналов и CRM."
          }
        },
        {
          "@type": "Question",
          "name": "Что если уже подключён amoAI или Jivo?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "amoAI закрывает сценарии внутри amoCRM; Jivo — быстрый чат. Кастом нужен при форме вне экосистемы, двух CRM, ERP, self-hosted n8n в РФ и асинхронных webhook Bitrix24."
          }
        },
        {
          "@type": "Question",
          "name": "Как доказать эффект?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Пилот 2–4 недели: время первого ответа, доля квалифицированных лидов, доля эскалаций, сравнение с периодом «до» на том же канале."
          }
        },
        {
          "@type": "Question",
          "name": "Чем отличается от корпоративного ChatGPT?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Workspace agents автоматизируют процессы сотрудников внутри компании. AI агент для сайта работает с клиентами на вашем домене и в вашей CRM."
          }
        }
      ]
    }
  ]
}
</script>

</div><!-- /.vna-content -->

</main>


<script>
(function(){
  document.querySelectorAll('.vna-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vna-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vna-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vna-faq-q');if(q)q.setAttribute('aria-expanded','false');
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
  var root=document.querySelector('.vna-content');
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
  var heroReveals=document.querySelectorAll('.nero-ai-hero .nero-ai-reveal');
  heroReveals.forEach(function(el){el.classList.add('nero-ai-active');});
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
