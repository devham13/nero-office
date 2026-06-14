<?php
/**
 * Template Name: AI-ассистент для агентства недвижимости: внедрение под ключ
 * Description: AI для агентства недвижимости — квалификация покупателей, подбор объектов, CRM. Кейсы, этапы, стоимость.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-ассистент для агентства недвижимости: внедрение под ключ';
$page_seo_description = 'AI для агентства недвижимости под ключ: квалификация покупателей, подбор объектов, ведение сделки в CRM. Кейсы, этапы, стоимость. Сценарий AI-риэлтора — бесплатно.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить сценарий';
$primary_cta_url = nero_ai_primary_cta_url();
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

<?php nero_ai_echo_theme_styles(); ?>

<style>

/* === ai-dlya-nedvizhimosti page === */
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

.ai-dlya-nedvizhimosti-page{
  --nad-accent:#22c55e;
  --nad-accent2:#3b82f6;
  --nad-viol:#8b5cf6;
  --nad-cyan:#79f2ff;
  --nad-muted:rgba(226,232,240,.72);
  --nad-card:rgba(255,255,255,.04);
  --nad-bdr:rgba(255,255,255,.1);
  --nad-bg:#050711;
  --nad-bg2:#080b17;
  background:linear-gradient(180deg,var(--nad-bg) 0%,var(--nad-bg2) 52%,var(--nad-bg) 100%);
  color:#e6edf7;
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.ai-dlya-nedvizhimosti-page .nad-content{
  max-width:1160px;
  margin:0 auto;
  padding:0 20px 80px;
}
.ai-dlya-nedvizhimosti-page .nad-section{padding:56px 0;scroll-margin-top:96px;}
.ai-dlya-nedvizhimosti-page .nad-section-alt{
  background:rgba(255,255,255,.02);
  border-radius:24px;
  padding-left:24px;padding-right:24px;margin:0 -24px;
}
.ai-dlya-nedvizhimosti-page .nad-sh{margin-bottom:32px}
.ai-dlya-nedvizhimosti-page .nad-eyebrow{
  display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;
  text-transform:uppercase;color:var(--nad-accent);margin:0 0 12px;
}
.ai-dlya-nedvizhimosti-page .nad-sh h2{
  font-size:clamp(24px,3.2vw,34px);font-weight:800;line-height:1.22;color:#fff;margin:0 0 14px;
}
.ai-dlya-nedvizhimosti-page .nad-sh p{font-size:16px;line-height:1.72;color:var(--nad-muted);margin:0;max-width:720px;}
.ai-dlya-nedvizhimosti-page .nad-h3{font-size:20px;font-weight:700;color:#fff;margin:36px 0 12px;}
.ai-dlya-nedvizhimosti-page .nad-prose{font-size:15px;line-height:1.72;color:var(--nad-muted);}
.ai-dlya-nedvizhimosti-page .nad-prose p{margin:0 0 14px}
.ai-dlya-nedvizhimosti-page .nad-prose strong{color:#c7d2e5;}
.ai-dlya-nedvizhimosti-page .nad-list{margin:0 0 16px;padding:0;list-style:none;}
.ai-dlya-nedvizhimosti-page .nad-list li{padding-left:20px;position:relative;margin-bottom:8px;}
.ai-dlya-nedvizhimosti-page .nad-list li::before{content:'›';position:absolute;left:0;color:var(--nad-accent);font-weight:700;}
.ai-dlya-nedvizhimosti-page .nad-olist{margin:0 0 16px;padding-left:22px;}
.ai-dlya-nedvizhimosti-page .nad-olist li{margin-bottom:8px;}
.ai-dlya-nedvizhimosti-page .nad-link{color:var(--nad-cyan);text-decoration:underline;}
.ai-dlya-nedvizhimosti-page .nad-table-wrap{overflow-x:auto;margin:20px 0;border-radius:14px;border:1px solid var(--nad-bdr);}
.ai-dlya-nedvizhimosti-page .nad-table{width:100%;border-collapse:collapse;font-size:14px;}
.ai-dlya-nedvizhimosti-page .nad-table th,.ai-dlya-nedvizhimosti-page .nad-table td{
  padding:12px 14px;border:1px solid var(--nad-bdr);text-align:left;color:var(--nad-muted);
}
.ai-dlya-nedvizhimosti-page .nad-table th{background:rgba(255,255,255,.04);color:#fff;font-weight:700}
.ai-dlya-nedvizhimosti-page .nad-callout{
  margin:0 0 24px;padding:18px 22px;border-radius:16px;
  background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);
}
.ai-dlya-nedvizhimosti-page .nad-callout p{margin:0;color:#c7d2e5;font-size:14.5px;}
.ai-dlya-nedvizhimosti-page .nad-warn{
  margin-top:24px;padding:18px 22px;border-radius:16px;
  background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.28);
}
.ai-dlya-nedvizhimosti-page .nad-warn p{margin:0;color:#fde68a;font-size:14.5px;}
.ai-dlya-nedvizhimosti-page .nad-case-tag{
  display:inline-block;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  color:var(--nad-accent);margin-bottom:10px;
}
.ai-dlya-nedvizhimosti-page .nad-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:24px;}
@media(max-width:900px){.ai-dlya-nedvizhimosti-page .nad-grid-3{grid-template-columns:1fr}}
.ai-dlya-nedvizhimosti-page .nad-card{
  padding:22px 20px;background:var(--nad-card);border:1px solid var(--nad-bdr);border-radius:18px;
}
.ai-dlya-nedvizhimosti-page .nad-card h3{font-size:17px;color:#fff;margin:0 0 10px}
.ai-dlya-nedvizhimosti-page .nad-card p{font-size:14px;color:var(--nad-muted);margin:0;line-height:1.6}
.ai-dlya-nedvizhimosti-page .nad-pills{display:flex;flex-wrap:wrap;gap:10px;margin-top:20px;}
.ai-dlya-nedvizhimosti-page .nad-pill{
  padding:8px 16px;border-radius:999px;font-size:13px;font-weight:700;
  background:rgba(59,130,246,.1);border:1px solid rgba(59,130,246,.28);color:#93c5fd;
}
.ai-dlya-nedvizhimosti-page .nad-timeline{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:28px;}
@media(max-width:768px){.ai-dlya-nedvizhimosti-page .nad-timeline{grid-template-columns:1fr 1fr}}
@media(max-width:480px){.ai-dlya-nedvizhimosti-page .nad-timeline{grid-template-columns:1fr}}
.ai-dlya-nedvizhimosti-page .nad-tl-step{
  padding:18px 16px;border-radius:16px;background:var(--nad-card);border:1px solid var(--nad-bdr);
}
.ai-dlya-nedvizhimosti-page .nad-tl-step::before{
  content:attr(data-step);display:inline-flex;width:28px;height:28px;align-items:center;justify-content:center;
  border-radius:50%;background:rgba(34,197,94,.15);color:var(--nad-accent);font-size:12px;font-weight:800;margin-bottom:10px;
}
.ai-dlya-nedvizhimosti-page .nad-tl-step h3{font-size:15px;color:#fff;margin:0 0 6px}
.ai-dlya-nedvizhimosti-page .nad-tl-step p{font-size:13px;color:var(--nad-muted);margin:0;line-height:1.5}
.ai-dlya-nedvizhimosti-page .nad-faq{display:flex;flex-direction:column;gap:10px;}
.ai-dlya-nedvizhimosti-page .nad-faq-item{border:1px solid var(--nad-bdr);border-radius:14px;overflow:hidden;background:var(--nad-card);}
.ai-dlya-nedvizhimosti-page .nad-faq-q{
  width:100%;padding:18px 20px;background:transparent;border:none;text-align:left;
  font-size:15px;font-weight:700;color:#fff;cursor:pointer;
  display:flex;justify-content:space-between;align-items:center;gap:12px;
}
.ai-dlya-nedvizhimosti-page .nad-faq-a{
  padding:0 20px;max-height:0;overflow:hidden;transition:max-height .35s ease,padding .25s;
  font-size:14px;line-height:1.68;color:var(--nad-muted);
}
.ai-dlya-nedvizhimosti-page .nad-faq-item.open .nad-faq-a{max-height:800px;padding:0 20px 18px;}
.ai-dlya-nedvizhimosti-page .nad-flow{
  display:flex;flex-wrap:wrap;align-items:center;gap:8px 6px;margin:28px 0 8px;
  padding:18px 20px;background:var(--nad-card);border:1px solid var(--nad-bdr);border-radius:16px;
  font-size:12.5px;font-weight:600;color:#e2e8f0;
}
.ai-dlya-nedvizhimosti-page .nad-flow .arr{color:var(--nad-accent);opacity:.85}
.ai-dlya-nedvizhimosti-page .nad-flow span{
  padding:6px 12px;background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.22);border-radius:999px;white-space:nowrap;
}

/* Intro */
.nad-intro{padding:clamp(40px,5vw,72px) 0 clamp(36px,4vw,56px);border-bottom:1px solid rgba(255,255,255,.06);}
.nad-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:start;}
.nad-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.nad-intro-text::before{
  content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;
  background:linear-gradient(180deg,var(--nad-cyan),var(--nad-viol));
}
.nad-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--nad-muted);margin-bottom:1em;}
.nad-intro-text .nad-lead{color:#c7d2e5;}
.nad-intro-text .nad-def{font-size:14px;color:#9aa8bd;}
.nad-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.nad-kpi-card{
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;
  padding:16px 14px;text-align:center;backdrop-filter:blur(12px);
}
.nad-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:#fff;letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.nad-kpi-card .kl{font-size:11px;font-weight:600;color:var(--nad-muted);line-height:1.4;}
.nad-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.nad-intro-grid{grid-template-columns:1fr;gap:36px;}.nad-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.nad-intro-kpi{grid-template-columns:1fr 1fr;}}

/* TOC */
.nad-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.nad-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.nad-toc a{
  display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;font-weight:600;
  color:var(--nad-muted);text-decoration:none;transition:border-color .2s,color .2s,background .2s;
}
.nad-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--nad-cyan);background:rgba(121,242,255,.08);}

/* CTA */
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;
  background:linear-gradient(135deg,rgba(34,197,94,.12),rgba(139,92,246,.1));border:1px solid rgba(34,197,94,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--nad-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--nad-cyan)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}

/* === БОРИС: prefix nad-boris-, scoped #ai-dlya-nedvizhimosti-boris-block === */
#ai-dlya-nedvizhimosti-boris-block.nad-boris-root{
  margin:32px 0 40px;
  padding:32px 0;
  background:#f8fafc;
  border-radius:22px;
  box-shadow:0 8px 40px rgba(15,23,42,.08);
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-cnt{
  max-width:100%;
  margin:0 auto;
  padding:0 20px;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:20px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 0 0 1px rgba(148,163,184,.2);
  min-height:460px;
}
@media(max-width:1023px){
  #ai-dlya-nedvizhimosti-boris-block .nad-boris-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-lft{
  padding:36px 32px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-nedvizhimosti-boris-block .nad-boris-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:28px 22px;
  }
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#16a34a;
  margin:0 0 12px;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-ey::before{
  content:'';
  width:18px;height:2px;
  background:#16a34a;
  border-radius:1px;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-h3{
  font-size:clamp(19px,2.2vw,24px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 16px;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-ul{
  list-style:none;
  margin:0 0 18px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:8px;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(22,163,74,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:10px;
  color:#15803d;
  font-style:normal;
  font-weight:800;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:14px;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-pl-b{
  background:rgba(59,130,246,.08);
  color:#1d4ed8;
  border:1.5px solid rgba(59,130,246,.22);
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.22);
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-dlya-nedvizhimosti-boris-block .nad-boris-rgt{
  position:relative;
  background:linear-gradient(145deg,#ecfdf5 0%,#f0fdf4 40%,#eff6ff 100%);
  min-height:400px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-dlya-nedvizhimosti-boris-block .nad-boris-rgt{min-height:340px;}
}
#nad-realtor-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-dlya-nedvizhimosti-page" role="main" tabindex="-1">

<style>
/* Hero ai-dlya-nedvizhimosti — самодостаточные стили (без CSS темы) */
.vnre-hero-nedvizhimosti {
  --vnre-cyan: #79f2ff;
  --vnre-violet: #8b5cf6;
  --vnre-green: #22c55e;
  --vnre-amber: #fbbf24;
  --vnre-text: #e6edf7;
  --vnre-muted: #9aa8bd;
  --vnre-soft: #c7d2e5;
  --vnre-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnre-hero-nedvizhimosti.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnre-hero-nedvizhimosti::before {
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
.vnre-hero-nedvizhimosti::after {
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
  animation: vnreHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnreHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnre-hero-nedvizhimosti .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnre-hero-nedvizhimosti .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnre-hero-nedvizhimosti .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnre-hero-nedvizhimosti .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnre-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnre-hero-nedvizhimosti .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnre-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnre-hero-nedvizhimosti .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnre-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnre-hero-nedvizhimosti .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnre-hero-nedvizhimosti .nero-ai-badge {
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
.vnre-hero-nedvizhimosti .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnre-hero-nedvizhimosti .nero-ai-btn {
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
.vnre-hero-nedvizhimosti .nero-ai-btn:hover { transform: translateY(-2px); }
.vnre-hero-nedvizhimosti .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnre-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnre-hero-nedvizhimosti .nero-ai-btn-secondary {
  color: var(--vnre-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnre-hero-nedvizhimosti .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnre-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnre-hero-nedvizhimosti .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnre-hero-nedvizhimosti .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnre-hero-nedvizhimosti .nero-ai-dots { display: flex; gap: 7px; }
.vnre-hero-nedvizhimosti .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnre-hero-nedvizhimosti .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnre-hero-nedvizhimosti .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnre-hero-nedvizhimosti .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnre-hero-nedvizhimosti .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnre-hero-nedvizhimosti .nero-ai-window-body { padding: 16px; }
.vnre-hero-nedvizhimosti .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnre-hero-nedvizhimosti .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnre-hero-nedvizhimosti .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
}
.vnre-hero-nedvizhimosti .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnrePulse 1.6s infinite;
}
@keyframes vnrePulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnre-hero-nedvizhimosti .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnre-hero-nedvizhimosti .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnre-hero-nedvizhimosti .nero-ai-metric span {
  display: block;
  color: var(--vnre-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnre-hero-nedvizhimosti .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnre-hero-nedvizhimosti .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnre-hero-nedvizhimosti .vnre-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 55%, rgba(251,191,36,.06), rgba(6,10,24,.92) 72%);
}
.vnre-hero-nedvizhimosti #vnre-realtor-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnre-hero-nedvizhimosti .nero-ai-task-stream { display: grid; gap: 8px; }
.vnre-hero-nedvizhimosti .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnre-hero-nedvizhimosti .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vnre-cyan);
  font-size: 12px;
  font-weight: 800;
}
.vnre-hero-nedvizhimosti .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnre-hero-nedvizhimosti .nero-ai-task span {
  color: var(--vnre-muted);
  font-size: 11px;
}
.vnre-hero-nedvizhimosti .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnre-hero-nedvizhimosti .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vnre-hero-nedvizhimosti .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnre-hero-nedvizhimosti .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnre-hero-nedvizhimosti .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnre-hero-nedvizhimosti .nero-ai-window-body { padding: 12px; }
  .vnre-hero-nedvizhimosti .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnre-hero-nedvizhimosti .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<section class="nero-ai-hero vnre-hero-nedvizhimosti" id="hero" aria-labelledby="vnre-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai для недвижимости</p>
      <h1 id="vnre-hero-title">AI-ассистент для агентства недвижимости: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI квалифицирует покупателя, подбирает объекты и ведёт сделку — без ручного прогрева и бесконечных подборок</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Квалификация 24/7</li>
        <li class="nero-ai-badge">Подбор из фида</li>
        <li class="nero-ai-badge">CRM sync</li>
        <li class="nero-ai-badge">Авито·ЦИАН</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-риэлтора">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-риэлтор · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Входящих чатов</span><strong>18</strong><small>Авито + ЦИАН</small></div>
            <div class="nero-ai-metric"><span>Время ответа</span><strong>12 сек</strong><small>первичный</small></div>
            <div class="nero-ai-metric"><span>Квалифицировано</span><strong>14</strong><small>бюджет + срок</small></div>
            <div class="nero-ai-metric"><span>Подборок</span><strong>5</strong><small>из фида CRM</small></div>
          </div>

          <div class="vnre-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnre-realtor-canvas" role="img" aria-label="Анимация: чаты классифайдов превращаются в квалифицированные лиды, подбор лотов и задачу риэлтору в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий AI-риэлтора">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AV</span>
              <div><strong>Чат Авито: 2к Одинцово</strong><span>Бюджет 12 млн · ипотека · 2 мес</span></div>
              <span class="nero-ai-status">квалиф.</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI-квалификация</strong><span>Lead score 87 · тёплый</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">5</span>
              <div><strong>Подбор 5 лотов</strong><span>Из XML-фида · без галлюцинаций</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Задача риэлтору</strong><span>Показ сб 14:00 · amoCRM</span></div>
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
 * vnre-realtor-hero-engine — «Шоурум AI-риэлтора»
 * Мир: ChatLeadRiver → DealMatchHub → ShowingCalendar → CRM handoff
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnre-realtor-canvas");
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
    chatBg: "#f8fafc",
    avito: "#00aaff",
    cian: "#7c3aed",
    river: "rgba(121,242,255,0.18)",
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    lotGreen: "#a7f3d0",
    lotBlue: "#93c5fd",
    keyGold: "#fbbf24",
    crmGreen: "#22c55e",
    heatHot: "#fb7185",
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

  /* Волновой поток чатов снизу — вместо Conveyor */
  function ChatLeadRiver() {
    this.wave = 0;
  }
  ChatLeadRiver.prototype.draw = function (ctx) {
    this.wave = (frame * 0.035) % (Math.PI * 2);
    for (var lane = 0; lane < 3; lane++) {
      var laneY = 85 - lane * 28;
      ctx.strokeStyle = lane === 1 ? "rgba(139,92,246,0.35)" : C.river;
      ctx.lineWidth = lane === 1 ? 2 : 1;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath();
      for (var x = -180; x <= 180; x += 6) {
        var y = laneY + Math.sin((x / 40) + this.wave + lane) * 6;
        if (x === -180) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
      }
      ctx.stroke();
      ctx.setLineDash([]);
    }

    var bubbles = [
      { t: (frame * 0.022 + 0) % 1, color: C.avito, label: "AV" },
      { t: (frame * 0.022 + 0.35) % 1, color: C.cian, label: "ЦИ" },
      { t: (frame * 0.022 + 0.7) % 1, color: C.chatBg, label: "TG" }
    ];
    bubbles.forEach(function (b) {
      var px = -150 + b.t * 300;
      var py = 72 + Math.sin(px / 35 + this.wave) * 5;
      drawRR(ctx, px - 11, py - 8, 22, 16, 5, b.color, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.label, px, py + 3);
    }, this);
  };

  /* Причал классифайдов — уникальный объект */
  function ClassifiedDock() {
    this.blink = 0;
  }
  ClassifiedDock.prototype.draw = function (ctx) {
    drawRR(ctx, -165, -55, 48, 34, 8, "rgba(0,170,255,0.12)", C.avito);
    ctx.fillStyle = C.avito;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Авито", -141, -38);
    drawRR(ctx, -165, -12, 48, 34, 8, "rgba(124,58,237,0.12)", C.cian);
    ctx.fillStyle = C.cian;
    ctx.fillText("ЦИАН", -141, 5);

    var prg = (frame * 0.038) % 260;
    if (prg > 8 && prg < 45) {
      this.blink = Math.sin((prg - 8) * 0.2) * 0.5 + 0.5;
      ctx.fillStyle = "rgba(251,191,36," + (0.15 + this.blink * 0.25) + ")";
      ctx.beginPath();
      ctx.arc(-141, -20, 14 + this.blink * 6, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  /* Центральный хаб подбора — вместо WebsiteTerminal */
  function DealMatchHub() {
    this.lotSlide = 0;
    this.keyY = 0;
  }
  DealMatchHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, -58, -78, 116, 156, 10, C.hubBase, C.outline);

    /* Шапка хаба */
    drawRR(ctx, -50, -70, 100, 18, 4, "rgba(121,242,255,0.15)", C.hubAccent);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI-подбор лотов", 0, -58);

    /* Фаза QUALIFY — анкета BANT */
    if (prg >= 40 && prg < 100) {
      var fields = ["Бюджет 12М", "Ипотека", "2 мес", "Одинцово"];
      fields.forEach(function (f, i) {
        var alpha = Math.min(1, (prg - 40 - i * 12) / 10);
        if (alpha <= 0) return;
        ctx.globalAlpha = alpha;
        drawRR(ctx, -42, -38 + i * 16, 84, 12, 3, "rgba(255,255,255,0.12)", C.outline);
        ctx.fillStyle = "#e2e8f0";
        ctx.font = "bold 7px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(f, -36, -28 + i * 16);
        ctx.globalAlpha = 1;
      });
    }

    /* Фаза MATCH — карусель лотов */
    if (prg >= 100 && prg < 190) {
      this.lotSlide = ((prg - 100) / 90) * 36;
      var lots = [C.lotGreen, C.lotBlue, C.lotGreen];
      lots.forEach(function (col, i) {
        var lx = -38 + i * 28 - this.lotSlide % 28;
        drawRR(ctx, lx, 8, 24, 32, 4, col, C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("2к", lx + 12, 22);
        ctx.fillStyle = "#64748b";
        ctx.fillText("12М", lx + 12, 32);
      }, this);
      ctx.fillStyle = C.hubAccent;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("5 лотов из фида", 0, 52);
    }

    /* Фаза HANDOFF — ключ + CRM */
    if (prg >= 190) {
      var handPrg = Math.min(1, (prg - 190) / 30);
      this.keyY = -handPrg * 55;
      ctx.save();
      ctx.translate(0, this.keyY);
      ctx.fillStyle = C.keyGold;
      ctx.font = "22px sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("🔑", 0, 30);
      ctx.restore();

      if (prg > 210 && prg < 245) {
        var pulse = (prg - 210) / 35;
        ctx.strokeStyle = "rgba(34,197,94," + (0.8 - pulse * 0.7) + ")";
        ctx.lineWidth = 2.5;
        ctx.beginPath();
        ctx.arc(0, 20, 18 + pulse * 38, 0, Math.PI * 2);
        ctx.stroke();
      }

      drawRR(ctx, -30, 58, 60, 22, 5, "rgba(34,197,94,0.22)", C.crmGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("CRM + риэлтор", 0, 72);
    }
  };

  /* Календарь показов — уникальный объект */
  function ShowingCalendar() {
    this.slotGlow = 0;
  }
  ShowingCalendar.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    drawRR(ctx, 95, -50, 58, 70, 8, "rgba(255,255,255,0.06)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Показ", 124, -38);

    var days = ["Пн", "Вт", "Сб"];
    days.forEach(function (d, i) {
      var active = prg >= 195 && i === 2;
      drawRR(ctx, 100 + i * 17, -28, 14, 14, 3, active ? "rgba(34,197,94,0.35)" : "rgba(255,255,255,0.08)", C.outline);
      ctx.fillStyle = active ? "#bbf7d0" : "#94a3b8";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText(d, 107 + i * 17, -18);
    });

    if (prg >= 200 && prg < 250) {
      this.slotGlow = Math.sin(frame * 0.12) * 0.3 + 0.7;
      drawRR(ctx, 102, -8, 48, 18, 4, "rgba(251,191,36," + (0.12 + this.slotGlow * 0.15) + ")", C.keyGold);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Сб 14:00", 126, 4);
    }
  };

  /* Lead heat gauge */
  function LeadHeatGauge() {
    this.heat = 0.42;
  }
  LeadHeatGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 60) this.heat = 0.35 + (prg / 60) * 0.25;
    else if (prg < 120) this.heat = 0.6 + ((prg - 60) / 60) * 0.15;
    else if (prg < 180) this.heat = 0.75 + ((prg - 120) / 60) * 0.12;
    else this.heat = 0.87;

    drawRR(ctx, -168, 18, 44, 12, 4, "rgba(255,255,255,0.08)", C.outline);
    var heatCol = this.heat > 0.8 ? C.heatHot : C.crmGreen;
    drawRR(ctx, -166, 20, 40 * this.heat, 8, 3, heatCol, null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Тёплый " + Math.round(this.heat * 100), -166, 42);
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
    var carryType = null;

    /* Агенты идут к хабу по дуге сверху — иная геометрия */
    var hubTargets = {
      "1_architect": { x: -75, y: -95 },
      "2_seo": { x: -25, y: -102 },
      "3_coder": { x: 25, y: -102 },
      "4_designer": { x: 75, y: -95 },
      "5_deployer": { x: 0, y: -88 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: -90 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 18) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 18) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 18) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 10 ? this.color : null;
    }

    if (!isMoving && frame % 240 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
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
  var river = new ChatLeadRiver();
  var dock = new ClassifiedDock();
  var hub = new DealMatchHub();
  var calendar = new ShowingCalendar();
  var heat = new LeadHeatGauge();

  entities.push(river);
  entities.push(dock);
  entities.push(heat);
  entities.push(hub);
  entities.push(calendar);
  entities.push(new Agent(-130, 100, C.agentYellow, "1_architect", 22, [
    "Воронка агентства", "Поля amoCRM готовы", "12 вопросов BANT"
  ]));
  entities.push(new Agent(-65, 108, C.agentGreen, "2_seo", 58, [
    "2к Одинцово — intent", "Ипотека, не наличные", "Новостройка vs вторичка"
  ]));
  entities.push(new Agent(0, 112, C.agentBlue, "3_coder", 104, [
    "XML-фид синхрон", "Только из каталога", "Guardrails включены"
  ]));
  entities.push(new Agent(65, 108, C.agentPink, "4_designer", 148, [
    "Подборка 5 лотов", "Фото + планировка", "Без выдуманных квартир"
  ]));
  entities.push(new Agent(130, 100, C.agentPurple, "5_deployer", 198, [
    "Авито API live", "Задача риэлтору", "Показ Сб 14:00 ✓"
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

    var prg = (frame * 0.038) % 260;
    if (prg >= 14 && prg < 14.05) createBubble(-120, 40, "1. Чат Авито: 2к Одинцово");
    if (prg >= 52 && prg < 52.05) createBubble(-80, -20, "2. Квалификация BANT");
    if (prg >= 108 && prg < 108.05) createBubble(0, -5, "3. Подбор из фида");
    if (prg >= 168 && prg < 168.05) createBubble(60, 10, "4. Слот показа Сб 14:00");
    if (prg >= 218 && prg < 218.05) createBubble(90, -30, "5. CRM → риэлтор");

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

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineloop);
  } else {
    engineloop();
  }
});
</script>


  <section class="nad-intro" id="intro">
    <div class="nad-content">
      <div class="nad-intro-grid nero-ai-reveal">
        <div class="nad-intro-text">
          <p class="nad-lead"><strong>Коротко:</strong>AI для недвижимости — это не чат-бот с FAQ, а связка LLM, каталога объектов, CRM и мессенджеров, которая квалифицирует покупателя, подбирает лоты и ведёт сделку до передачи риэлтору. Nero Network внедряет такой контур под ключ: от аудита воронки до запуска AI-риэлтора на Авито, ЦИАН, Telegram и в amoCRM или Битрикс24.</p><p>Покупатель пишет в чат классифайда вечером в субботу. Менеджер отвечает в понедельник утром — и клиент уже договорился о показе у конкурента. Знакомая картина для агентств недвижимости: лиды долго прогреваются, подбор объектов съедает часы, а CRM заполняется вручную и с опозданием. В 2026 году это уже не «удобство», а прямой убыток: по отчёту Salesforce State of Sales 2026 AI и AI-агенты названы главной тактикой роста продаж, 87% организаций уже используют AI, а 54% — агентов. Топ-команды в 1,7 раза чаще применяют prospecting-агентов, чем аутсайдеры.</p><p class="nad-def"><strong>Определение:</strong>AI-ассистент для агентства недвижимости — программный агент на базе большой языковой модели, подключённый к фиду объектов и CRM, который закрывает первую линию продаж: мгновенный ответ, квалификация по бюджету и сроку, подбор из актуальной базы, запись на показ и передача «тёплого» лида риэлтору с заполненной карточкой.</p><p>Если вам нужен не эксперимент, а рабочий инструмент — <strong>получите сценарий AI-риэлтора</strong>: чеклист квалификации, триггеры эскалации и поля CRM для вашей воронки.</p>
        </div>
        <div class="nad-intro-kpi" aria-label="Ключевые показатели">
          <div class="nad-kpi-card"><div class="kv">87%</div><div class="kl">компаний с AI</div><div class="ks">Salesforce 2026</div></div>
          <div class="nad-kpi-card"><div class="kv">до 33%</div><div class="kl">потерянных чатов</div><div class="ks">до пилота</div></div>
          <div class="nad-kpi-card"><div class="kv">180–600</div><div class="kl">тыс. ₽ чек</div><div class="ks">под ключ</div></div>
          <div class="nad-kpi-card"><div class="kv">2–3 нед.</div><div class="kl">MVP</div><div class="ks">один канал</div></div>
        </div>
      </div>
      <nav class="nad-toc-outer" aria-label="Оглавление">
        <div class="nad-toc">
          <a href="#zachem-ai">Зачем AI</a>
          <a href="#kak-rabotaet">Как работает</a>
          <a href="#vnedrenie">Внедрение</a>
          <a href="#scenarii">Сценарии</a>
          <a href="#integracii">Интеграции</a>
          <a href="#keisy">Кейсы</a>
          <a href="#stoimost">Стоимость</a>
          <a href="#riski">Риски</a>
          <a href="#faq">FAQ</a>
          <a href="#cta">CTA</a>
        </div>
      </nav>
    </div>
  </section>
<div class="nad-content">

  <section class="nad-section nad-section-alt" id="zachem-ai" aria-labelledby="nad-h2-zachem-ai">
    <div class="nad-sh nero-ai-reveal">
      <span class="nad-eyebrow">Зачем AI</span>
      <h2 id="nad-h2-zachem-ai">Зачем агентству недвижимости AI-ассистент</h2>
      <p>Рынок недвижимости входит в топ-5 отраслей по ожидаемому эффекту от ИИ к 2030 году. Конкуренты уже ускоряют прогрев — вопрос не «нужен ли AI», а где он даст максимальный ROI.</p>
    </div>
    
    
    <div class="nad-callout nero-ai-reveal nad-delay-1">
      <p><strong>Salesforce State of Sales 2026:</strong> 87% организаций используют AI, 54% — агентов; топ-команды в 1,7 раза чаще применяют prospecting-агентов.</p>
    </div>
    <div class="nad-prose nero-ai-reveal">
      <p>Рынок недвижимости в России входит в топ-5 отраслей по ожидаемому эффекту от ИИ к 2030 году — таков вывод исследования «Искусственный интеллект в России — 2025» консалтинговой компании «Яков и Партнёры» совместно с Яндексом. При этом 71% компаний уже применяют генеративный ИИ хотя бы в одной функции, а 46% внедрили или тестируют автономных агентов. Для риэлторского бизнеса это означает: конкуренты уже ускоряют прогрев и персонализацию — вопрос не «нужен ли AI», а «где он даст максимальный ROI».</p>
      <h3 class="nad-h3">Где теряются лиды без автоматизации прогрева</h3>
      <p>Типовой путь лида в агентстве: заявка → квалификация → подбор → показ → сделка. Максимальный эффект AI — на этапах <strong>заявка → квалификация → первичный подбор</strong>, до показа, где человек остаётся ключевым.</p>
      <p>Без автоматизации прогрева агентство теряет деньги на трёх участках:</p>
      <ul class="nad-list"><li><strong>Медленный ответ.</strong> Международные данные по speed-to-lead показывают: ответ за 5 минут кратно повышает шанс квалификации по сравнению с ответом через 30 минут. После часа ожидания конверсия падает резко, после суток — почти обнуляется.</li><li><strong>Потерянные чаты.</strong> В пилоте сети «Самолет Плюс» на ComNews зафиксировано: до 33% чатов на классифайдах оставались без ответа до внедрения ИИ-ассистента. Каждый неотвеченный вовремя диалог — потенциальная потеря сделки, как отмечает Ольга Цыганкова, руководитель контакт-центра «Самолет Плюс».</li><li><strong>Холодные лиды в CRM.</strong> Менеджер тратит время на уточнение бюджета и района вместо показов. Salesforce State of Sales 2026: 89% специалистов по продажам говорят, что AI углубляет понимание клиента — потому что данные собираются структурированно, а не из памяти менеджера.</li></ul>
      <p>Внедрение AI в бизнес-процессы агентства закрывает именно этот разрыв: первая линия работает 24/7, а риэлтор подключается к уже квалифицированному обращению.</p>
      <h3 class="nad-h3">Почему ручной подбор объектов тормозит сделки</h3>
      <p>Подбор квартиры или дома — рутинная, но трудоёмкая операция. Менеджер открывает CRM, классифайды, таблицы, сверяет бюджет, этаж, ипотечные ограничения, пересылает скриншоты в мессенджер. На один запрос «ищу двушку в Одинцово до 12 млн, ипотека, через два месяца» уходит от 20 минут до нескольких часов.</p>
      <p>AI-подбор объектов работает иначе: запрос на естественном языке → фильтр по актуальному фиду → 3–7 релевантных вариантов с фото и параметрами за секунды. Именно так устроен ИИ-агент Домклик на GigaChat: две RAG-цепочки, классификатор интентов и сценарный движок разгружают колл-центр и сокращают ручной поиск. 77% российских компаний уже используют рекомендательные системы в продажах и маркетинге — прямой аналог AI-подбора лотов.</p>
      <p>Когда подбор занимает минуты, а не часы, клиент не уходит к агентству, которое ответило быстрее.</p>
      <h3 class="nad-h3">Что меняется после внедрения AI в продажи недвижимости</h3>
      <p>После внедрения AI-решений для недвижимости агентство получает измеримые сдвиги — по данным публичных кейсов, без обещаний «волшебных цифр» для каждого проекта:</p>
      <div class="nad-table-wrap"><table class="nad-table"><tr><th>Показатель</th><th>До</th><th>После (публичные референсы)</th></tr><tr><td>Время первого ответа</td><td>Часы, иногда дни</td><td>Секунды — минуты, 24/7</td></tr><tr><td>Потерянные чаты</td><td>До 33% (Самолет Плюс, до пилота)</td><td>Существенное сокращение за счёт автоответа</td></tr><tr><td>Качество лидов в CRM</td><td>Пустые карточки, ручной ввод</td><td>Предзаполненные поля, lead score, теги</td></tr><tr><td>Нагрузка на менеджеров</td><td>10–20+ часов рутины в неделю</td><td>Высвобождение на показы и сделки</td></tr></table></div>
      <p>Salesforce в своём отчёте фиксирует ожидание экономии: −34% времени на research и −36% на черновики писем. Для риэлтора это означает: меньше переписки «а какой у вас бюджет?», больше времени на объекты и переговоры.</p>
      <p><strong>Итог блока:</strong> AI для недвижимости для бизнеса — это не замена риэлтора, а ускоритель воронки на этапах, где скорость и точность данных решают исход сделки.</p>
    </div>
  </section>
  <!-- INTERNAL-LINKS:INSERT -->
<section class="nad-section nad-section-alt" id="kak-rabotaet" aria-labelledby="nad-h2-kak-rabotaet">
    <div class="nad-sh nero-ai-reveal">
      <span class="nad-eyebrow">AI-риэлтор · пайплайн</span>
      <h2 id="nad-h2-kak-rabotaet">Как работает AI-риэлтор в агентстве</h2>
      <p>AI-агент недвижимости — оркестратор из каналов, RAG, каталога объектов и CRM. Шесть шагов от первого сообщения до записи на показ.</p>
    </div>

    <div class="nad-flow nero-ai-reveal" aria-label="Схема: сообщение → показ">
      <span>Сообщение</span><span class="arr">→</span>
      <span>Квалификация</span><span class="arr">→</span>
      <span>Подбор из фида</span><span class="arr">→</span>
      <span>CRM + lead score</span><span class="arr">→</span>
      <span>Запись на показ</span><span class="arr">→</span>
      <span>Риэлтор</span>
    </div>

    <!-- БОРИС: визуальный блок (canvas) -->
    <section id="ai-dlya-nedvizhimosti-boris-block" class="nad-boris-root" aria-label="Анимация: путь лида от чата классифайда до записи на показ и передачи риэлтору">
      <div class="nad-boris-cnt">
        <div class="nad-boris-card">
          <div class="nad-boris-lft">
            <span class="nad-boris-ey">Операционный центр · ai для недвижимости</span>
            <h3 class="nad-boris-h3">От чата Авито до слота показа — без ручного прогрева</h3>
            <ul class="nad-boris-ul">
              <li><span class="nad-boris-ic">1</span>Лид пишет в мессенджер или чат ЦИАН — AI отвечает за секунды</li>
              <li><span class="nad-boris-ic">2</span>BANT-анкета: бюджет, район, ипотека, срок покупки</li>
              <li><span class="nad-boris-ic">3</span>RAG + фид возвращают 3–7 реальных лотов — без галлюцинаций</li>
              <li><span class="nad-boris-ic">4</span>Карточка в amoCRM/Битрикс24 + уведомление риэлтору</li>
            </ul>
            <div class="nad-boris-pills">
              <span class="nad-boris-pl nad-boris-pl-g">&lt;1 мин ответ 24/7</span>
              <span class="nad-boris-pl nad-boris-pl-b">Авито · ЦИАН · Telegram</span>
              <span class="nad-boris-pl nad-boris-pl-v">human-in-the-loop</span>
            </div>
            <p class="nad-boris-foot">Дальше разберём квалификацию, подбор и сопровождение сделки →</p>
          </div>
          <div class="nad-boris-rgt">
            <canvas
              id="nad-realtor-pipeline-canvas"
              role="img"
              aria-label="Анимация: чат классифайда, AI-квалификация, подбор квартир из фида, синхронизация CRM и запись на показ"
            ></canvas>
          </div>
        </div>
      </div>
      <script>
      (function(){
        'use strict';
        var cv = document.getElementById('nad-realtor-pipeline-canvas');
        if (!cv) return;
        var ctx = cv.getContext('2d');
        var W = 0, H = 0, frame = 0;

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
          green:'#22c55e',
          greenD:'rgba(34,197,94,.2)',
          blue:'#3b82f6',
          blueD:'rgba(59,130,246,.2)',
          viol:'#8b5cf6',
          violD:'rgba(139,92,246,.25)',
          orange:'#f59e0b',
          card:'#ffffff',
          cardBdr:'#cbd5e1',
          line:'rgba(15,23,42,.12)',
          apt:'#e0f2fe'
        };

        var STEPS = [
          {id:0, label:'Чат', x:0},
          {id:1, label:'AI', x:0},
          {id:2, label:'Подбор', x:0},
          {id:3, label:'CRM', x:0},
          {id:4, label:'Показ', x:0},
          {id:5, label:'Риэлтор', x:0}
        ];

        var tokens = [];
        var apts = [];
        var crmAlpha = 0;
        var loopT = 0;

        function rr(x,y,w,h,r,fill,stroke,lw){
          ctx.beginPath();
          if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
          else ctx.rect(x,y,w,h);
          if(fill){ ctx.fillStyle=fill; ctx.fill(); }
          if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
        }

        function layout(){
          var pad = W*0.06;
          var span = (W - pad*2) / (STEPS.length - 1);
          STEPS.forEach(function(s,i){ s.x = pad + i*span; });
          return {pad:pad, span:span, cy:H*0.52};
        }

        function drawChatBubble(x,y,s,label){
          rr(x-s*0.5,y-s*0.35,s,s*0.7,8,C.card,C.cardBdr);
          ctx.fillStyle = C.blue;
          ctx.font = 'bold '+Math.max(9,s*0.18)+'px system-ui,sans-serif';
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          ctx.fillText(label, x, y);
        }

        function drawAiNode(x,y,r,pulse){
          var g = ctx.createRadialGradient(x,y,0,x,y,r*2.2);
          g.addColorStop(0, C.violD);
          g.addColorStop(1, 'rgba(139,92,246,0)');
          ctx.fillStyle = g;
          ctx.beginPath();
          ctx.arc(x,y,r*2,0,Math.PI*2);
          ctx.fill();
          rr(x-r,y-r,r*2,r*2,r*0.4,'#faf5ff',C.viol,2);
          ctx.fillStyle = C.viol;
          ctx.font = 'bold '+Math.max(11,r*0.28)+'px system-ui,sans-serif';
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          ctx.fillText('AI', x, y-2);
          ctx.font = Math.max(8,r*0.16)+'px system-ui,sans-serif';
          ctx.fillStyle = C.muted;
          ctx.fillText('риэлтор', x, y+r*0.35);
          ctx.strokeStyle = C.viol;
          ctx.globalAlpha = 0.25 + pulse*0.35;
          ctx.lineWidth = 2;
          ctx.beginPath();
          ctx.arc(x,y,r+5+pulse*6,0,Math.PI*2);
          ctx.stroke();
          ctx.globalAlpha = 1;
        }

        function drawAptCard(x,y,w,h,rooms,price,alpha){
          if(alpha < 0.05) return;
          ctx.globalAlpha = alpha;
          rr(x,y,w,h,6,C.card,C.cardBdr);
          rr(x+6,y+6,w-12,h*0.45,4,C.apt,C.blue);
          ctx.fillStyle = C.ink;
          ctx.font = 'bold 10px system-ui,sans-serif';
          ctx.textAlign = 'left';
          ctx.fillText(rooms, x+10, y+h*0.72);
          ctx.fillStyle = C.green;
          ctx.font = '9px system-ui,sans-serif';
          ctx.fillText(price, x+10, y+h-8);
          ctx.globalAlpha = 1;
        }

        function drawCrmMini(x,y,w,h,alpha){
          if(alpha < 0.05) return;
          ctx.globalAlpha = alpha;
          rr(x,y,w,h,8,C.card,C.green,2);
          ctx.fillStyle = C.green;
          ctx.font = 'bold 11px system-ui,sans-serif';
          ctx.textAlign = 'left';
          ctx.fillText('Сделка CRM', x+10, y+18);
          ['Бюджет: 12 млн','Район: Одинцово','Ипотека: да'].forEach(function(row,i){
            ctx.fillStyle = C.muted;
            ctx.font = '9px system-ui,sans-serif';
            ctx.fillText(row, x+10, y+32+i*14);
          });
          ctx.globalAlpha = 1;
        }

        function drawCalendar(x,y,s,alpha){
          if(alpha < 0.05) return;
          ctx.globalAlpha = alpha;
          rr(x,y,s,s*0.9,6,C.card,C.orange,2);
          ctx.fillStyle = C.orange;
          ctx.fillRect(x,y,s, s*0.22);
          ctx.fillStyle = '#fff';
          ctx.font = 'bold 9px system-ui,sans-serif';
          ctx.textAlign = 'center';
          ctx.fillText('Показ', x+s*0.5, y+s*0.14);
          ctx.fillStyle = C.ink;
          ctx.font = 'bold 12px system-ui,sans-serif';
          ctx.fillText('Сб 14:00', x+s*0.5, y+s*0.58);
          ctx.globalAlpha = 1;
        }

        function drawRealtor(x,y,r,alpha){
          if(alpha < 0.05) return;
          ctx.globalAlpha = alpha;
          ctx.fillStyle = C.greenD;
          ctx.beginPath();
          ctx.arc(x,y,r+8,0,Math.PI*2);
          ctx.fill();
          ctx.fillStyle = C.green;
          ctx.beginPath();
          ctx.arc(x,y,r,0,Math.PI*2);
          ctx.fill();
          ctx.fillStyle = '#fff';
          ctx.font = 'bold 11px system-ui,sans-serif';
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          ctx.fillText('👤', x, y);
          ctx.fillStyle = C.ink;
          ctx.font = '9px system-ui,sans-serif';
          ctx.fillText('Риэлтор', x, y+r+12);
          ctx.globalAlpha = 1;
        }

        function spawnToken(){
          tokens.push({t:0, phase:0, channel:['Авито','ЦИАН','TG'][Math.floor(Math.random()*3)]});
        }

        function tick(){
          frame++;
          loopT++;
          if(frame % 110 === 0) spawnToken();

          var L = layout();
          var cy = L.cy;
          var pulse = 0.5 + 0.5*Math.sin(frame*0.07);

          ctx.clearRect(0,0,W,H);

          /* дорожка */
          ctx.strokeStyle = C.line;
          ctx.lineWidth = 3;
          ctx.setLineDash([8,6]);
          ctx.beginPath();
          ctx.moveTo(STEPS[0].x, cy);
          ctx.lineTo(STEPS[5].x, cy);
          ctx.stroke();
          ctx.setLineDash([]);

          /* узлы этапов */
          STEPS.forEach(function(s,i){
            var nx = s.x, ny = cy - (i%2===0 ? 8 : -8);
            ctx.fillStyle = C.muted;
            ctx.font = '9px system-ui,sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText(s.label, nx, H*0.82);
            if(i===1) drawAiNode(nx, ny, Math.min(W,H)*0.055, pulse);
            else {
              rr(nx-14, ny-14, 28, 28, 14, '#fff', i===0?C.blue:i===5?C.green:C.cardBdr, 1.5);
            }
          });

          drawChatBubble(STEPS[0].x, cy-42, 36, '💬');

          /* движущийся лид */
          tokens = tokens.filter(function(tok){
            tok.t += 1;
            var prog = Math.min(1, tok.t / 320);
            var px = STEPS[0].x + (STEPS[5].x - STEPS[0].x) * prog;
            var py = cy - 36 + Math.sin(frame*0.1)*3;
            rr(px-18, py-10, 36, 20, 10, C.card, C.blue);
            ctx.fillStyle = C.ink;
            ctx.font = '8px system-ui,sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText(tok.channel, px, py+4);
            if(tok.t > 80 && tok.t < 140 && apts.length < 3){
              apts.push({x:STEPS[2].x, y:cy-50, t:0, rooms:['2к','3к','студия'][apts.length], price:['11.8 млн','14.2 млн','6.1 млн'][apts.length]});
            }
            if(tok.t > 180) crmAlpha = Math.min(1, crmAlpha + 0.02);
            return tok.t < 340;
          });

          apts.forEach(function(a,i){
            a.t += 0.03;
            drawAptCard(a.x - 20 + i*22, a.y, 44, 52, a.rooms, a.price, Math.min(1,a.t*2));
          });

          if(crmAlpha > 0) drawCrmMini(STEPS[3].x - 40, cy - 70, 80, 58, crmAlpha);
          if(loopT > 200) drawCalendar(STEPS[4].x - 22, cy - 75, 44, Math.min(1,(loopT-200)/60));
          if(loopT > 260) drawRealtor(STEPS[5].x, cy - 55, 16, Math.min(1,(loopT-260)/50));

          if(loopT > 420){
            loopT = 0;
            tokens = [];
            apts = [];
            crmAlpha = 0;
          }

          requestAnimationFrame(tick);
        }
        tick();
      })();
      </script>
    </section>

    <div class="nad-prose nero-ai-reveal">
      <p>AI-риэлтор (или AI-агент недвижимости) — центральный модуль внедрения. Это не виджет с тремя кнопками, а оркестратор из нескольких компонентов: канальный шлюз, AI-маршрутизатор интентов, RAG-база, каталог объектов, CRM-модуль, календарь показов и guardrails против галлюцинаций.</p>
      <p>Архитектура, которую используют крупнейшие игроки рынка — от Домклик до международного AGIX blueprint — строится вокруг мультиагентной логики: Qualifier, Knowledge Retrieval, Booking, CRM Sync, Escalation. Nero Network адаптирует эту схему под российские CRM и классифайды.</p>
      <h3 class="nad-h3">Квалификация покупателя за первые минуты диалога</h3>
      <p>AI-квалификация покупателей стартует с первого сообщения. Ассистент уточняет параметры по BANT-подобной анкете:</p>
      <ul class="nad-list"><li>бюджет и способ оплаты (ипотека, наличные, рассрочка);</li><li>срок покупки;</li><li>район, тип жилья (новостройка / вторичка / загород);</li><li>состав семьи, требования к площади и этажу;</li><li>готовность к показу.</li></ul>
      <p>В кейсе «Самолет Плюс» ИИ-ассистент на платформе AI Plus через официальные API Авито, ЦИАН и Домклик уточняет бюджет, площадь и локацию, собирает контакты и формирует карточку клиента в CRM. При неуверенности — бесшовная эскалация на оператора контакт-центра без разрыва диалога.</p>
      <p>Международный референс Structurely (США): AI Inside Sales Agent квалифицирует лиды по SMS, email и голосу, интегрируется с CRM, ведёт долгий nurture и передаёт горячих лидов агенту. За время работы системы проведено 13+ млн AI-диалогов; квалификация — 14–31%, text response rate — 57%. Для российского агентства аналог — мессенджеры и чаты классифайдов вместо SMS.</p>
      <h3 class="nad-h3">AI-подбор объектов по критериям клиента</h3>
      <p>AI-подбор объектов работает только из <strong>проверенного каталога</strong> — XML-фид, CRM-модуль «Риелтор», Google Sheets или выгрузка с ЦИАН/Авито. Модель не «придумывает» квартиры: RAG + фильтр по фиду возвращает реальные лоты с актуальными ценами и статусами.</p>
      <p>Сценарий Artsofte Digital для девелоперов: ассистент в мессенджере отвечает по ЖК из книги продаж, подбирает лоты по площади, этажу, бюджету и видовым характеристикам. Отдельный сценарий — для агентов «в полях»: подборки в чате вместо скриншотов с сайта. Срок внедрения при готовых материалах — до двух недель.</p>
      <p>Демо-сценарий для понимания: клиент пишет «ищу 2к в Одинцово до 12 млн, ипотека, через 2 месяца» → AI уточняет этаж, парковку, школу рядом → возвращает 5 вариантов из фида → предлагает слоты показа из календаря риэлтора.</p>
      <h3 class="nad-h3">Сопровождение сделки от показа до договора</h3>
      <p>После квалификации и подбора AI не исчезает — он ведёт сопровождение по сценарию:</p>
      <ol class="nad-olist"><li>Запись на показ из календаря риэлтора.</li><li>Создание сделки в CRM с тегами и lead score.</li><li>Уведомление риэлтору о горячем лиде.</li><li>Follow-up после показа: напоминания, дополнительные подборки, re-engagement «уснувших» лидов.</li></ol>
      <p>Что остаётся за человеком: показ объекта и эмоциональная продажа, торг, юридическое сопровождение, проверка документов, нестандартные сделки (переуступка, сложная ипотека, коммерция). AI не подменяет переговоры по сделке — он убирает рутину до и после контакта с риэлтором.</p>
      <p>Как отмечает Александр Торичко, CEO Artsofte Digital (РБК, май 2026): «В продажах недвижимости скорость и точность ответа критически важны… инструмент ведёт диалог до заявки прямо в мессенджере».</p>
    </div>
  </section>

  <section class="nad-section" id="vnedrenie" aria-labelledby="nad-h2-vnedrenie">
    <div class="nad-sh nero-ai-reveal">
      <span class="nad-eyebrow">Под ключ</span>
      <h2 id="nad-h2-vnedrenie">Внедрение AI для недвижимости под ключ</h2>
      <p>Внедрение AI для недвижимости под ключ — проектная услуга, а не SaaS-шаблон «за вечер». Nero Network строит контур под воронку конкретного агентства: источники лидов, CRM, фид объектов, скрипты и политику обработки персональных данных. Ориентир чека из брифа: <strong>180–600 тыс. ₽</strong> — коридор среднего внедрения с CRM на рынке интеграторов.</p>
    </div>
    
    
    <div class="nad-timeline nero-ai-reveal" aria-label="Этапы внедрения">
      <div class="nad-tl-step" data-step="1">
        <h3>Аудит</h3>
        <p>2–3 дня: карта лидов, CRM, фид объектов, скрипты</p>
      </div>
      <div class="nad-tl-step" data-step="2">
        <h3>MVP</h3>
        <p>2–3 нед.: Telegram + CRM + квалификация + подбор</p>
      </div>
      <div class="nad-tl-step" data-step="3">
        <h3>Расширение</h3>
        <p>4–6 нед.: Авито, ЦИАН, аналитика, guardrails</p>
      </div>
      <div class="nad-tl-step" data-step="4">
        <h3>Запуск</h3>
        <p>2–4 нед.: мониторинг диалогов, обучение команды</p>
      </div>
    </div>
    <div class="nad-prose nero-ai-reveal" style="margin-top:28px">
      <h3 class="nad-h3">Этапы проекта: аудит → сценарии → интеграция → запуск</h3>
      <p><strong>Этап 1. Аудит (2–3 дня).</strong> Карта источников лидов: сайт, Авито, ЦИАН, Домклик, Telegram, WhatsApp, звонки. Анализ CRM, фида объектов, книги продаж и скриптов. Определение точек максимального ROI.</p>
      <p><strong>Этап 2. MVP (2–3 недели).</strong> Один канал (например, Telegram + форма сайта) + amoCRM или Битрикс24 + квалификация + подбор из XML или Google Sheets.</p>
      <p><strong>Этап 3. Расширение (4–6 недель).</strong> Классифайды через API, голосовой обзвон горячих лидов, автоописания объявлений, дашборд метрик.</p>
      <p><strong>Этап 4. Запуск и дообучение (2–4 недели).</strong> Мониторинг диалогов, правка промптов и guardrails, обучение команды.</p>
      <p>Разработка AI для недвижимости и настройка AI-ассистента на этом пути идут итерациями: сначала рабочий контур на одном канале, затем масштабирование — без риска «большого взрыва», который парализует отдел продаж.</p>
      <h3 class="nad-h3">Что входит в настройку AI-ассистента</h3>
      <p>Настройка AI для недвижимости включает:</p>
      <ul class="nad-list"><li><strong>Канальный шлюз:</strong> Telegram, WhatsApp (WABA), VK, виджет сайта, API Авито/ЦИАН/Домклик.</li><li><strong>AI-оркестратор:</strong> маршрутизация интентов (вопрос по объекту / подбор / запись / жалоба).</li><li><strong>RAG-база:</strong> книга продаж, FAQ по ипотеке и документам, скрипты возражений.</li><li><strong>Каталог объектов:</strong> синхронизация с CRM и классифайдами.</li><li><strong>CRM-модуль:</strong> карточка клиента, стадии воронки, задачи риэлтору.</li><li><strong>Календарь и бронирование показов.</strong></li><li><strong>Аналитика:</strong> время ответа, % квалифицированных, конверсия в показ и сделку.</li><li><strong>Guardrails:</strong> запрет выдумывать объекты; эскалация юридических формулировок.</li></ul>
      <p>Для запуска нужны: XML/CSV-фид или CRM-база объектов с актуальными ценами, книга продаж, карта воронки, доступы к API, политика обработки ПДн по 152-ФЗ, календари риэлторов.</p>
      <h3 class="nad-h3">Сроки и роли команды агентства</h3>
      <div class="nad-table-wrap"><table class="nad-table"><tr><th>Роль в агентстве</th><th>Участие во внедрении</th></tr><tr><td>Владелец / директор</td><td>Утверждение воронки, бюджета, KPI</td></tr><tr><td>РОП</td><td>Скрипты квалификации, критерии «горячего» лида</td></tr><tr><td>Риэлторы</td><td>Тестирование диалогов, feedback по подборкам</td></tr><tr><td>Администратор CRM</td><td>Поля карточки, стадии, интеграции</td></tr><tr><td>IT / подрядчик (если есть)</td><td>Доступы, фиды, API</td></tr></table></div>
      <p>Полный цикл от аудита до стабильного запуска — <strong>6–12 недель</strong> в зависимости от числа каналов и глубины интеграции. MVP на одном канале — от 2–3 недель.</p>
    </div>
    
  <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-vnedrenie">
    <div class="ym-cta-block__icon" aria-hidden="true">🏠</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Получите сценарий AI-риэлтора бесплатно</p>
      <p class="ym-cta-block__sub">Чеклист: 12 вопросов квалификации, триггеры эскалации на живого риэлтора и поля CRM для вашего агентства. Без обязательств — пришлём в Telegram.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </div>
  </section>
  <section class="nad-section nad-section-alt" id="scenarii" aria-labelledby="nad-h2-scenarii">
    <div class="nad-sh nero-ai-reveal">
      <span class="nad-eyebrow">Сценарии</span>
      <h2 id="nad-h2-scenarii">Сценарии автоматизации для риэлторов</h2>
      <p>Автоматизация через AI для недвижимости — набор веток под разные сегменты: новостройка, вторичка, инвестор, агент в полях.</p>
    </div>
    
    
    <div class="nad-prose nero-ai-reveal">
      <p>Автоматизация через AI для недвижимости — не один сценарий, а набор типовых веток под разные сегменты: покупатель новостройки, вторички, инвестор, агент «в полях». Каждая ветка закрывает конкретный подзапрос из семантического ядра и снижает нагрузку на команду.</p>
      <h3 class="nad-h3">Прогрев холодных лидов и ответы 24/7</h3>
      <p>Холодный лид с классифайда или таргета часто не готов к звонку. AI ведёт мягкий прогрев: отвечает на вопросы, уточняет параметры, отправляет подборки, напоминает о себе через 3–7 дней. Structurely показывает, что text response rate в AI-nurture достигает 57% — для чатов в России аналогичный эффект дают Telegram и WhatsApp.</p>
      <p>55% клиентов предпочитают чаты звонкам — данные пилота «Самолет Плюс». AI-риэлтор закрывает этот канал без найма ночной смены операторов.</p>
      <h3 class="nad-h3">Персонализация под тип покупателя</h3>
      <p>AI адаптирует тон и содержание под профиль:</p>
      <ul class="nad-list"><li><strong>Семья с детьми</strong> — акцент на школы, двор, планировку.</li><li><strong>Инвестор</strong> — доходность, ликвидность, срок сдачи.</li><li><strong>Покупатель новостройки</strong> — книга продаж ЖК, ипотечные программы застройщика.</li><li><strong>Вторичка</strong> — история объекта, торг, документы.</li></ul>
      <p>Salesforce State of Sales 2026: 87% специалистов отмечают снижение стресса благодаря AI — потому что система держит контекст клиента, а не менеджер в голове.</p>
      <h3 class="nad-h3">Подготовка к показу и follow-up после встречи</h3>
      <p>Перед показом AI отправляет клиенту карточку объекта, маршрут, чеклист документов. После встречи — follow-up: «Как прошёл просмотр?», предложение альтернатив, напоминание о дедлайне по ипотеке. Риэлтор получает в CRM заметку о реакции клиента и следующий шаг.</p>
      <p>Это закрывает боль «лиды долго прогреваются»: система не теряет контакт между показом и решением.</p>
    </div>
    
  <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Хотите разобраться во внедрении AI сами?</p>
      <p class="ym-cta-block__sub">Перед запуском AI-риэлтора полезно понимать сценарии, промпты и human-in-the-loop — это ускоряет согласование с РОПом и риэлторами. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
    </div>
  </aside>
  </section>
  <section class="nad-section nad-section-alt" id="integracii" aria-labelledby="nad-h2-integracii">
    <div class="nad-sh nero-ai-reveal">
      <span class="nad-eyebrow">CRM · классифайды</span>
      <h2 id="nad-h2-integracii">Интеграция AI с CRM и площадками недвижимости</h2>
      <p>Интеграция AI для недвижимости с CRM — условие, без которого агент остаётся изолированным чат-ботом. Adam Alfano, EVP Sales в Salesforce, предупреждает: «Stand-alone agents without comprehensive customer context tend to fail» — агенты без полного контекста клиента чаще проваливаются. AI CRM недвижимость должна синхронизировать диалог, объекты и стадии воронки в одной системе.</p>
    </div>
    
    
    <div class="nad-pills nero-ai-reveal" aria-label="Интеграции">
      <span class="nad-pill">amoCRM</span>
      <span class="nad-pill">Битрикс24</span>
      <span class="nad-pill">Авито API</span>
      <span class="nad-pill">ЦИАН</span>
      <span class="nad-pill">Домклик</span>
      <span class="nad-pill">Telegram</span>
      <span class="nad-pill">WhatsApp WABA</span>
    </div>
    <div class="nad-prose nero-ai-reveal" style="margin-top:24px">
      <p>Интеграция AI для недвижимости с CRM — условие, без которого агент остаётся изолированным чат-ботом. Adam Alfano, EVP Sales в Salesforce, предупреждает: «Stand-alone agents without comprehensive customer context tend to fail» — агенты без полного контекста клиента чаще проваливаются. AI CRM недвижимость должна синхронизировать диалог, объекты и стадии воронки в одной системе.</p>
      <h3 class="nad-h3">amoCRM, Битрикс24 и воронка агентства</h3>
      <p>Для российских агентств стандарт — <strong>amoCRM</strong> (с модулями ROCKET «Риелтор», Xoms) или <strong>Битрикс24</strong>. AI-ассистент:</p>
      <ul class="nad-list"><li>создаёт и обновляет карточку контакта и сделки;</li><li>проставляет теги (новостройка, ипотека, горячий);</li><li>считает lead score;</li><li>ставит задачи риэлтору с полным контекстом диалога.</li></ul>
      <p>Готовые виджеты вроде Umnico для связки amoCRM + Авито ускоряют интеграцию: не нужно писать коннектор с нуля.</p>
      <h3 class="nad-h3">Выгрузки объектов: ЦИАН, Авито, MLS</h3>
      <p>AI для недвижимости с CRM работает на актуальном каталоге. Источники объектов:</p>
      <ul class="nad-list"><li>XML/CSV-фид агентства;</li><li>выгрузки с ЦИАН, Авито, Домклик, Яндекс Недвижимость через официальные API;</li><li>CRM-модуль «Риелтор»;</li><li>Google Sheets для небольших агентств на старте.</li></ul>
      <p>В кейсе «Самолет Плюс» ИИ подключается к чатам классифайдов через официальные API — именно так обеспечивается единый контур «объявление → диалог → CRM».</p>
      <h3 class="nad-h3">Передача лида живому риэлтору без потери контекста</h3>
      <p>Критический момент воронки — handoff от AI к человеку. Правильная передача включает:</p>
      <ul class="nad-list"><li>полную историю переписки в карточке CRM;</li><li>структурированную анкету квалификации;</li><li>список показанных объектов и реакцию клиента;</li><li>уведомление риэлтору в Telegram или push в CRM;</li><li>возможность подключиться к диалогу в том же чате без «перезапуска» разговора.</li></ul>
      <p>Human-in-the-loop — не опция, а стандарт качества: при неуверенности AI или юридическом вопросе диалог переходит человеку бесшовно.</p>
    </div>
  </section>
  <section class="nad-section" id="keisy" aria-labelledby="nad-h2-keisy">
    <div class="nad-sh nero-ai-reveal">
      <span class="nad-eyebrow">Доказательства</span>
      <h2 id="nad-h2-keisy">Кейсы и примеры внедрения AI для недвижимости</h2>
      <p>AI для недвижимости кейсы в России пока концентрируются у сетевых игроков и девелоперов, но архитектура масштабируется на среднее агентство без собственной IT-команды. Ниже — проверенные публичные референсы с источниками.</p>
    </div>
    
    
    <div class="nad-grid-3 nero-ai-reveal">
      <article class="nad-card">
        <span class="nad-case-tag">Россия · 2025</span>
        <h3>Самолет Плюс</h3>
        <p>ИИ в чатах Авито, ЦИАН, Домклик: конверсия в телефон +~20%, 95% корректных ответов. ComNews.</p>
      </article>
      <article class="nad-card">
        <span class="nad-case-tag">Девелопмент</span>
        <h3>Artsofte Digital</h3>
        <p>RAG по книге продаж, подбор лотов, сценарий для агентов в полях. Срок — до 2 недель. РБК, 2026.</p>
      </article>
      <article class="nad-card">
        <span class="nad-case-tag">Эталон рынка</span>
        <h3>Домклик</h3>
        <p>ИИ-агент на GigaChat: подбор на естественном языке, две RAG-цепочки. Sber Developers / Habr.</p>
      </article>
    </div>
    <div class="nad-prose nero-ai-reveal nad-delay-1" style="margin-top:28px">
      <p>AI для недвижимости кейсы в России пока концентрируются у сетевых игроков и девелоперов, но архитектура масштабируется на среднее агентство без собственной IT-команды. Ниже — проверенные публичные референсы с источниками.</p>
      <h3 class="nad-h3">Малые агентства и частные риэлторы</h3>
      <p>Прямых публичных кейсов именно для малых независимых агентств мало — это пробел рынка, который закрывает проектная модель «под ключ». Ориентир для малого бизнеса:</p>
      <ul class="nad-list"><li>MVP на Telegram + amoCRM + фид из таблицы — от 2–3 недель;</li><li>один риэлтор получает AI-первую линию без отдела операторов;</li><li>окупаемость по рыночным оценкам интеграторов — 1–3 месяца при стабильном потоке лидов.</li></ul>
      <p>Кейс интегратора aibotmanager.ru (Казань, 12 риелторов) заявляет +30% сделок за 2 месяца — <strong>с оговоркой:</strong> публикация без независимой верификации названия агентства. Используем как ориентир типового эффекта, не как подтверждённый публичный кейс.</p>
      <h3 class="nad-h3">Девелоперы и застройщики</h3>
      <p><strong>Artsofte Digital</strong> запустила ИИ-ассистента продаж для девелоперов: ответы по ЖК из книги продаж, подбор лотов, сценарий для агентов в полях. RAG по материалам застройщика + фид планировок → диалог до заявки → интеграция в CRM. Срок — до 2 недель при готовых материалах.</p>
      <p><strong>Домклик (Сбер)</strong> построил ИИ-агента на GigaChat: подбор на естественном языке, две RAG-цепочки, классификатор интентов. Это эталон того, что крупнейшие игроки строят агентов, а не FAQ-ботов.</p>
      <h3 class="nad-h3">Метрики до и после (без выдуманных цифр)</h3>
      <div class="nad-table-wrap"><table class="nad-table"><tr><th>Кейс</th><th>Источник</th><th>Результат</th></tr><tr><td>«Самолет Плюс», пилот ~250 объявлений</td><td>ComNews, дек. 2025</td><td>Конверсия в телефон +~20%; 95% ответов корректны; потенциал выручки для сети — до 199 млн ₽ за 1П 2025</td></tr><tr><td>Structurely (США)</td><td>Press release, 2026</td><td>13+ млн диалогов; квалификация 14–31%; response rate 57%</td></tr><tr><td>Sooldd (Флорида)</td><td>NewAgeSysIT</td><td>94% запросов автономно; trial-to-paid 18% → 27% за 90 дней; матчинг с 2–3 дней до <45 мин</td></tr><tr><td>Salesforce (внутренний)</td><td>State of Sales 2026</td><td>Агенты за 4 месяца: 130 000 лидов → 3 200 opportunities</td></tr></table></div>
      <p>Пример внедрения AI для недвижимости в вашем агентстве будет зависеть от потока лидов, каналов и зрелости CRM — но вектор эффекта подтверждён российскими и международными референсами.</p>
    </div>
  </section>
  <section class="nad-section nad-section-alt" id="stoimost" aria-labelledby="nad-h2-stoimost">
    <div class="nad-sh nero-ai-reveal">
      <span class="nad-eyebrow">Бюджет</span>
      <h2 id="nad-h2-stoimost">Стоимость внедрения AI для недвижимости</h2>
      <p>Честный ответ на «ai для недвижимости цена»: стоимость зависит от числа каналов, глубины интеграции и объёма кастомизации сценариев.</p>
    </div>
    
    
    <div class="nad-prose nero-ai-reveal">
      <p>Вопрос «AI для недвижимости цена» — один из первых у владельца агентства. Честный ответ: стоимость зависит от числа каналов, глубины интеграции и объёма кастомизации сценариев.</p>
      <h3 class="nad-h3">Из чего складывается чек 180–600 тыс. ₽</h3>
      <div class="nad-table-wrap"><table class="nad-table"><tr><th>Компонент</th><th>Ориентир</th><th>Что входит</th></tr><tr><td>Аудит и проектирование</td><td>30–80 тыс. ₽</td><td>Карта воронки, ТЗ, архитектура</td></tr><tr><td>MVP (1 канал + CRM)</td><td>150–250 тыс. ₽</td><td>Квалификация, подбор, CRM-синк</td></tr><tr><td>Полный контур</td><td>300–600 тыс. ₽</td><td>Классифайды, мессенджеры, аналитика, guardrails</td></tr><tr><td>Поддержка и дообучение</td><td>от 15–30 тыс. ₽/мес</td><td>Мониторинг, правка промптов</td></tr></table></div>
      <p>Рыночные якоря конкурентов: Noltis — от 89 тыс. ₽ за стартовый пакет; aibotmanager — «нейросотрудник» 250–400 тыс. ₽; PapAI и аналоги — CRM-интеграция 100–300 тыс. ₽. Чек Nero Network 180–600 тыс. ₽ попадает в коридор <strong>среднего внедрения с CRM</strong> — без скрытых доплат за «каждый канал отдельно», если это согласовано в ТЗ.</p>
      <h3 class="nad-h3">Что влияет на окупаемость для агентства</h3>
      <p>Окупаемость считается не от «модной технологии», а от экономики первой линии:</p>
      <ul class="nad-list"><li><strong>Стоимость 1–2 FTE</strong> операторов или ассистентов на входящих — 80–150 тыс. ₽/мес в регионах, выше в Москве.</li><li><strong>Потерянные чаты</strong> — каждый неотвеченный диалог на классифайде = потенциальная комиссия 50–300 тыс. ₽.</li><li><strong>Скорость квалификации</strong> — риэлтор тратит время на показы, а не на «уточните бюджет».</li></ul>
      <p>При стабильном потоке лидов рынок оценивает окупаемость в <strong>1–3 месяца</strong>. При малом потоке ценность — в нулевых потерянных чатах и качестве CRM, а не в масштабе.</p>
      <h3 class="nad-h3">Когда достаточно пилота, а когда нужен полный контур</h3>
      <p><strong>Пилот (MVP)</strong> подходит, если:</p>
      <ul class="nad-list"><li>1–2 канала лидов (сайт + Telegram);</li><li>до 5 риэлторов;</li><li>фид объектов уже в CRM или таблице;</li><li>нужно проверить гипотезу до масштабирования.</li></ul>
      <p><strong>Полный контур</strong> нужен, если:</p>
      <ul class="nad-list"><li>лиды идут с Авито, ЦИАН, Домклик одновременно;</li><li>сеть филиалов или девелоперский блок;</li><li>требуется голосовой обзвон, автоописания, дашборд ROI;</li><li>compliance 152-ФЗ и локальные LLM обязательны по политике компании.</li></ul>
    </div>
  </section>
  <section class="nad-section nad-section-alt" id="riski" aria-labelledby="nad-h2-riski">
    <div class="nad-sh nero-ai-reveal">
      <span class="nad-eyebrow">Риски</span>
      <h2 id="nad-h2-riski">Риски и ограничения AI в недвижимости</h2>
      <p>Честный блок рисков — отстройка от интеграторов, которые обещают «×2 лидов» без методологии.</p>
    </div>
    
    
    <div class="nad-prose nero-ai-reveal">
      <p>Честный блок рисков — отстройка от интеграторов, которые обещают «×2 лидов» без методологии. AI для недвижимости работает в рамках guardrails и законодательства.</p>
      <h3 class="nad-h3">Галлюцинации по объектам и проверка данных</h3>
      <p>Главный технический риск — AI «придумает» квартиру, которой нет в базе. Решение:</p>
      <ul class="nad-list"><li>ответы о лотах <strong>только из фида</strong> с проверкой статуса;</li><li>запрет генерации несуществующих объектов на уровне промптов и кода;</li><li>confidence threshold: при неуверенности — эскалация человеку;</li><li>регулярная синхронизация цен и статусов с CRM и классифайдами.</li></ul>
      <p>Домклик и «Самолет Плюс» строят архитектуру именно на RAG + каталог, а не на свободной генерации.</p>
      <h3 class="nad-h3">Персональные данные и юридические формулировки</h3>
      <p>152-ФЗ: с 1 июля 2025 года ужесточены требования к хранению и трансграничной передаче ПДн. Штрафы — до миллионов рублей. Для AI-ассистента это означает:</p>
      <ul class="nad-list"><li>хранение и первичный сбор ПДн — в РФ;</li><li>GigaChat, YandexGPT, self-hosted или обезличивание до отправки в зарубежные LLM;</li><li>согласие клиента на AI-обработку в форме и политике;</li><li>AI <strong>не даёт юридических гарантий</strong> по сделке — только справочная информация из RAG + эскалация.</li></ul>
      <p>Источники: buro152.ru, prem.agmind.dev (AI и ПДн).</p>
      <h3 class="nad-h3">Контроль качества диалогов с покупателем</h3>
      <p>Даже с guardrails нужен человеческий контроль:</p>
      <ul class="nad-list"><li>выборочный аудит диалогов (5–10% еженедельно);</li><li>дашборд некорректных ответов и эскалаций;</li><li>обновление RAG при смене ипотечных программ или акций застройщика;</li><li>обучение команды: когда вмешаться в диалог.</li></ul>
      <p>51% лидеров продаж в Salesforce называют tech silos главным барьером для AI — поэтому интеграция с CRM и единая аналитика важнее, чем «умная модель» в изоляции.</p>
    </div>
    <div class="nad-warn nero-ai-reveal nad-delay-1">
      <p><strong>152-ФЗ:</strong> с 1 июля 2025 ужесточены требования к хранению ПДн. AI не даёт юридических гарантий по сделке — только справочная информация из RAG + эскалация.</p>
    </div>
  </section>
  <section class="nad-section" id="faq" aria-labelledby="nad-h2-faq">
    <div class="nad-sh nero-ai-reveal">
      <span class="nad-eyebrow">FAQ</span>
      <h2 id="nad-h2-faq">FAQ — как внедрить AI для недвижимости</h2>
      <p>Ответы для владельцев агентств и РОПов: сроки, CRM, малый бизнес, отличие от чат-бота.</p>
    </div>
    
    
    <div class="nad-faq nero-ai-reveal" itemscope itemtype="https://schema.org/FAQPage">
      <div class="nad-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button type="button" class="nad-faq-q" aria-expanded="false" itemprop="name">Сколько времени занимает запуск?<span aria-hidden="true">+</span></button>
        <div class="nad-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <div itemprop="text"><p>MVP на одном канале — <strong>2–3 недели</strong>. Полный контур с классифайдами и несколькими мессенджерами — <strong>6–12 недель</strong>. Artsofte заявляет до 2 недель при готовой книге продаж и фиде планировок.</p></div>
        </div>
      </div>
      <div class="nad-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button type="button" class="nad-faq-q" aria-expanded="false" itemprop="name">Нужна ли своя CRM?<span aria-hidden="true">+</span></button>
        <div class="nad-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <div itemprop="text"><p>Желательно amoCRM или Битрикс24 — AI синхронизирует карточки и стадии. Без CRM возможен старт на Google Sheets + Telegram, но масштабирование и аналитика ограничены. Интеграция AI для недвижимости с CRM — рекомендуемый минимум.</p></div>
        </div>
      </div>
      <div class="nad-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button type="button" class="nad-faq-q" aria-expanded="false" itemprop="name">Подходит ли AI для малого агентства?<span aria-hidden="true">+</span></button>
        <div class="nad-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <div itemprop="text"><p>Да. AI для недвижимости для малого бизнеса — часто самый быстрый ROI: один риэлтор или владелец получает 24/7 первую линию без найма оператора. MVP дешевле полного контура; ценность — в скорости ответа и нулевых потерянных чатах, даже при небольшом потоке лидов.</p></div>
        </div>
      </div>
      <div class="nad-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button type="button" class="nad-faq-q" aria-expanded="false" itemprop="name">Чем AI-риэлтор отличается от обычного чат-бота?<span aria-hidden="true">+</span></button>
        <div class="nad-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <div itemprop="text"><div class="nad-table-wrap"><table class="nad-table"><tr><th>Параметр</th><th>Чат-бот</th><th>AI-риэлтор</th></tr><tr><td>Логика</td><td>Жёсткие ветки</td><td>LLM + RAG + оркестрация интентов</td></tr><tr><td>Подбор объектов</td><td>Нет или шаблон</td><td>Из актуального фида по критериям</td></tr><tr><td>CRM</td><td>Редко</td><td>Синхронизация карточки, тегов, задач</td></tr><tr><td>Эскалация</td><td>«Позвоните нам»</td><td>Бесшовная передача в том же чате</td></tr><tr><td>Классифайды</td><td>Обычно нет</td><td>API Авито, ЦИАН, Домклик</td></tr></table></div></div>
        </div>
      </div>
      <div class="nad-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button type="button" class="nad-faq-q" aria-expanded="false" itemprop="name">Заменит ли AI живого риэлтора?<span aria-hidden="true">+</span></button>
        <div class="nad-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <div itemprop="text"><p>Нет. AI закрывает первую линию: ответ, квалификация, подбор, запись, follow-up. Показ, торг, юридическое сопровождение и эмоциональная продажа остаются за человеком. Клиент, который хочет живого эксперта, получает его — но уже на этапе показа, а не после трёх дней ожидания ответа.</p></div>
        </div>
      </div>
      <div class="nad-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button type="button" class="nad-faq-q" aria-expanded="false" itemprop="name">Нужна ли своя база объектов?<span aria-hidden="true">+</span></button>
        <div class="nad-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <div itemprop="text"><p>Да, актуальный фид обязателен. Источники: CRM, XML-выгрузка, таблица, API классифайдов. Без базы AI не может честно подбирать лоты.</p></div>
        </div>
      </div>
      <div class="nad-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button type="button" class="nad-faq-q" aria-expanded="false" itemprop="name">Какие модели AI использовать в России?<span aria-hidden="true">+</span></button>
        <div class="nad-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <div itemprop="text"><p>Для работы с ПДн — GigaChat, YandexGPT, self-hosted LLM или обезличивание данных до запроса в зарубежные модели. Выбор зависит от политики компании и требований 152-ФЗ.</p></div>
        </div>
      </div>
      <div class="nad-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button type="button" class="nad-faq-q" aria-expanded="false" itemprop="name">Сколько стоит внедрение?<span aria-hidden="true">+</span></button>
        <div class="nad-faq-a" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <div itemprop="text"><p>Ориентир: <strong>180–600 тыс. ₽</strong> за проект под ключ в зависимости от каналов и интеграций. Точная смета — после аудита воронки.</p></div>
        </div>
      </div>

    <div class="nad-prose nero-ai-reveal nad-summary" style="margin-top:28px">
      <p><strong>Итог:</strong> AI для недвижимости в 2026 году — стратегическая инвестиция в скорость и качество первой линии. Агентства с AI-риэлтором под свою воронку выигрывают у тех, кто отвечает на чаты «когда освободится менеджер».</p>
    </div>
  </section>
  <section class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Готовы внедрить AI-риэлтора в агентство?</p>
      <p class="ym-cta-block__sub">Разберём воронку, каналы (Авито, ЦИАН, Telegram) и CRM — и пришлём сценарий AI-риэлтора с полями карточки и триггерами эскалации. Без обязательств.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </section>
  <!-- SCHEMA-MARKUP:INSERT -->
</div>

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-dlya-nedvizhimosti-page');
  if (!root) return;
  root.querySelectorAll('.nad-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.nad-faq-item');
      var open = item.classList.contains('open');
      root.querySelectorAll('.nad-faq-item').forEach(function(i){ i.classList.remove('open'); i.querySelector('.nad-faq-q').setAttribute('aria-expanded','false'); });
      if (!open) { item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
  });
  var revealItems = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if (entry.isIntersecting) { entry.target.classList.add('nero-ai-active'); observer.unobserve(entry.target); }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
    revealItems.forEach(function(item){ observer.observe(item); });
  } else {
    revealItems.forEach(function(item){ item.classList.add('nero-ai-active'); });
  }
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
