<?php
/**
 * Template Name: AI-FAQ для сайта: внедрение динамических ответов из базы знаний
 * Description: SEO-лендинг — внедрение AI-FAQ виджета с RAG и автообновлением FAQ. Пакеты 80–220 тыс. ₽.
 */

$page_seo_title       = 'AI-FAQ для сайта — внедрение динамических ответов из базы знаний';
$page_seo_description = 'Внедрим AI-FAQ для сайта: виджет отвечает из вашей базы знаний и сам обновляет FAQ по реальным вопросам клиентов. Меньше тикетов в поддержку, выше конверсия 24/7. Соберите AI-FAQ от 80 тыс. ₽.';

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
	[ 'label' => 'Что такое', 'href' => '#chto-takoe' ],
	[ 'label' => 'Как работает', 'href' => '#kak-rabotaet' ],
	[ 'label' => 'Внедрение', 'href' => '#vnedrenie' ],
	[ 'label' => 'Результаты', 'href' => '#rezultaty' ],
	[ 'label' => 'Интеграции', 'href' => '#integracii' ],
	[ 'label' => 'Цена', 'href' => '#ceny' ],
	[ 'label' => 'Этапы', 'href' => '#etapy' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Собрать AI-FAQ';
$primary_cta_url   = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs = nero_ai_primary_cta_link_attrs( $primary_cta_url );

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

.faq-hero-rag{
  min-height:100vh;
  min-height:100dvh;
  position:relative;
}

.afq-content{
  --afq-bg:#f8fafc;--afq-surface:#fff;--afq-text:#0f172a;--afq-muted:#64748b;
  --afq-soft:#334155;--afq-border:#e2e8f0;--afq-accent:#6366f1;--afq-accent2:#8b5cf6;
  --afq-teal:#0d9488;--afq-green:#10b981;--afq-amber:#f59e0b;
  --afq-btn-from:#6366f1;--afq-btn-to:#8b5cf6;
  --afq-r:18px;--afq-container:1180px;
  background:linear-gradient(180deg,#fff 0%,#f8fafc 40%,#f1f5f9 100%);
  color:var(--afq-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.afq-content *,.afq-content *::before,.afq-content *::after{box-sizing:border-box;}
.afq-content a{color:inherit;}
.afq-content p{color:var(--afq-muted);line-height:1.72;margin:0 0 1em;text-align:left;}
.afq-content p:last-child{margin-bottom:0;}
.afq-content h2,.afq-content h3,.afq-content h4{color:var(--afq-text);letter-spacing:-.04em;margin:0 0 .65em;}
.afq-content strong{color:var(--afq-soft);}
.afq-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.afq-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--afq-muted);font-size:14.5px;line-height:1.65;text-align:left;}
.afq-content ul li::before{content:'›';position:absolute;left:0;color:var(--afq-accent);font-weight:700;}
.afq-cnt{width:min(var(--afq-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.afq-section{padding:clamp(56px,7vw,96px) 0;position:relative;}
.afq-section-alt{background:rgba(255,255,255,.72);border-top:1px solid var(--afq-border);border-bottom:1px solid var(--afq-border);}
.afq-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.afq-sh.afq-left{margin-left:0;text-align:left;}
.afq-sh h2{font-size:clamp(26px,3.8vw,44px);line-height:1.08;margin-bottom:12px;}
.afq-sh p{font-size:clamp(15px,1.55vw,17px);max-width:680px;margin:0 auto;text-align:center;}
.afq-sh.afq-left p{margin-left:0;text-align:left;}
.afq-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.2);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--afq-accent);margin-bottom:14px;}
.afq-intro{padding:clamp(36px,5vw,64px) 0 clamp(32px,4vw,52px);background:#fff;border-bottom:1px solid var(--afq-border);}
.afq-intro-grid{display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:center;}
.afq-intro-text{position:relative;padding-left:20px;text-align:left;}
.afq-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--afq-accent),var(--afq-teal));}
.afq-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.5vw,16.5px);line-height:1.78;color:var(--afq-muted);}
.afq-intro-text p:last-child{color:var(--afq-soft);}
.afq-intro-deco{display:grid;gap:10px;}
.afq-chip{display:flex;align-items:center;gap:10px;padding:12px 14px;border:1px solid var(--afq-border);border-radius:14px;background:var(--afq-surface);box-shadow:0 4px 16px rgba(15,23,42,.04);}
.afq-chip strong{display:block;font-size:13px;color:var(--afq-text);}
.afq-chip span{font-size:11px;color:var(--afq-muted);}
.afq-chip-dot{width:10px;height:10px;border-radius:50%;background:var(--afq-teal);box-shadow:0 0 0 4px rgba(13,148,136,.15);flex-shrink:0;}
@media(max-width:900px){.afq-intro-grid{grid-template-columns:1fr;gap:28px;}}
.afq-toc-outer{padding:0 0 clamp(32px,4vw,48px);}
.afq-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.afq-toc a{display:inline-block;padding:9px 18px;background:#fff;border:1px solid var(--afq-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--afq-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.afq-toc a:hover{border-color:rgba(99,102,241,.35);color:var(--afq-accent);background:rgba(99,102,241,.06);}
.afq-card{background:#fff;border:1px solid var(--afq-border);border-radius:var(--afq-r);padding:24px;box-shadow:0 8px 28px rgba(15,23,42,.05);transition:border-color .2s,transform .2s;}
.afq-card:hover{border-color:rgba(99,102,241,.25);transform:translateY(-2px);}
.afq-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.afq-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
@media(max-width:768px){.afq-grid-2,.afq-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.afq-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.afq-grid-3{grid-template-columns:1fr;}}
.afq-scenario{background:#fff;border:1px solid var(--afq-border);border-radius:var(--afq-r);padding:22px;margin-bottom:12px;}
.afq-scenario:last-child{margin-bottom:0;}
.afq-scenario h3{font-size:17px;margin-bottom:8px;}
.afq-scenario p{font-size:14.5px;margin:0 0 .55em;}
.afq-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid var(--afq-border);margin:20px 0;background:#fff;}
.afq-table{width:100%;border-collapse:collapse;font-size:14px;}
.afq-table th{padding:12px 16px;text-align:left;background:rgba(99,102,241,.08);color:var(--afq-accent);font-weight:700;border-bottom:1px solid var(--afq-border);white-space:nowrap;}
.afq-table td{padding:11px 16px;border-bottom:1px solid var(--afq-border);color:var(--afq-soft);vertical-align:top;}
.afq-table tr:last-child td{border-bottom:none;}
.afq-table tr:hover td{background:rgba(99,102,241,.03);}
.afq-timeline{position:relative;padding-left:36px;}
.afq-timeline::before{content:'';position:absolute;left:10px;top:6px;bottom:6px;width:2px;background:linear-gradient(180deg,var(--afq-accent),var(--afq-teal));opacity:.35;border-radius:2px;}
.afq-tl-item{position:relative;margin-bottom:28px;}
.afq-tl-item:last-child{margin-bottom:0;}
.afq-tl-dot{position:absolute;left:-30px;top:4px;width:14px;height:14px;border-radius:50%;background:var(--afq-accent);box-shadow:0 0 0 4px rgba(99,102,241,.18);}
.afq-tl-item h3{font-size:17px;margin-bottom:6px;}
.afq-tl-item p{font-size:14.5px;margin:0;}
.afq-faq{display:flex;flex-direction:column;gap:10px;max-width:860px;margin:0 auto;}
.afq-faq-item{background:#fff;border:1px solid var(--afq-border);border-radius:14px;overflow:hidden;}
.afq-faq-q{padding:18px 22px;font-size:15px;font-weight:700;color:var(--afq-text);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:14px;user-select:none;text-align:left;}
.afq-faq-q::after{content:'▾';font-size:12px;color:var(--afq-accent);flex-shrink:0;transition:transform .25s;}
.afq-faq-item.open .afq-faq-q::after{transform:rotate(180deg);}
.afq-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--afq-muted);line-height:1.72;text-align:left;}
.afq-faq-item.open .afq-faq-a{max-height:800px;padding:0 22px 18px;}
.afq-checklist{list-style:none;padding:0;margin:20px 0 0;}
.afq-checklist li{padding-left:28px;position:relative;margin-bottom:10px;color:var(--afq-muted);font-size:14.5px;}
.afq-checklist li::before{content:'☐';position:absolute;left:0;color:var(--afq-accent);font-weight:700;}
.ym-cta-block{border-radius:20px;padding:32px 36px;margin:28px 0;background:linear-gradient(135deg,rgba(99,102,241,.08),rgba(139,92,246,.06));border:1px solid rgba(99,102,241,.22);}
.ym-cta-block--primary{text-align:center;}
.ym-cta-block--secondary{background:#fff;border-color:var(--afq-border);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(13,148,136,.08),rgba(99,102,241,.08));border-color:rgba(13,148,136,.25);}
.ym-cta-block__icon{font-size:32px;margin-bottom:12px;}
.ym-cta-block__headline{font-size:clamp(19px,2.6vw,26px);font-weight:800;color:var(--afq-text);margin:0 0 10px;}
.ym-cta-block__sub{color:var(--afq-muted);font-size:15px;margin:0 auto 20px;max-width:620px;line-height:1.7;text-align:left;}
.ym-cta-block--primary .ym-cta-block__sub{text-align:center;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 26px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--afq-btn-from),var(--afq-btn-to));color:#fff!important;box-shadow:0 8px 28px rgba(99,102,241,.28);}
.ym-btn--ghost{background:#fff;color:var(--afq-text)!important;border:1.5px solid var(--afq-border);}
.ym-link--accent{color:var(--afq-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(20px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:24px 18px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-faq-dlya-saita-page" role="main" tabindex="-1">

<section class="nero-ai-hero faq-hero-rag" id="faq-hero-rag" aria-labelledby="faq-hero-title">
<style>
/* ── Hero ai-faq-dlya-saita: самодостаточные стили (светлая гамма) ── */
.faq-hero-rag {
  --faq-accent: #6366f1;
  --faq-accent2: #8b5cf6;
  --faq-teal: #14b8a6;
  --faq-green: #10b981;
  --faq-amber: #f59e0b;
  --faq-text: #0f172a;
  --faq-muted: #64748b;
  --faq-soft: #334155;
  --faq-border: #e2e8f0;
  --faq-surface: #ffffff;
  --faq-shadow: 0 24px 64px rgba(15, 23, 42, 0.08);
  position: relative;
  min-height: min(960px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 120px) 0 clamp(40px, 6vw, 80px);
  background: linear-gradient(180deg, #ffffff 0%, #f8fafc 55%, #f1f5f9 100%);
  isolation: isolate;
  overflow: hidden;
}
.faq-hero-rag::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(99, 102, 241, 0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(99, 102, 241, 0.04) 1px, transparent 1px);
  background-size: 48px 48px;
  mask-image: radial-gradient(circle at 72% 38%, #000 0%, transparent 68%);
  pointer-events: none;
  z-index: 0;
}
.faq-hero-rag::after {
  content: "";
  position: absolute;
  left: -8%;
  bottom: -12%;
  width: 520px;
  height: 520px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(139, 92, 246, 0.09), transparent 70%);
  pointer-events: none;
  z-index: 0;
}
.faq-hero-rag .nero-ai-container {
  width: min(1180px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.faq-hero-rag .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(340px, 0.98fr);
  gap: clamp(28px, 4vw, 52px);
  align-items: center;
}
.faq-hero-rag .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 14px;
  padding: 7px 12px;
  border: 1px solid rgba(99, 102, 241, 0.22);
  border-radius: 999px;
  background: rgba(99, 102, 241, 0.07);
  color: var(--faq-accent) !important;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: 0.1em;
  text-transform: uppercase;
}
.faq-hero-rag h1 {
  margin: 0;
  max-width: 760px;
  font-size: clamp(34px, 5vw, 62px);
  line-height: 1.02;
  letter-spacing: -0.05em;
  color: var(--faq-text);
  font-weight: 900;
}
.faq-hero-rag .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, var(--faq-accent) 0%, var(--faq-accent2) 48%, var(--faq-teal) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.faq-hero-rag .nero-ai-hero-lead {
  margin: 20px 0 0;
  max-width: 680px;
  color: var(--faq-soft) !important;
  font-size: clamp(16px, 1.85vw, 20px);
  line-height: 1.58;
}
.faq-hero-rag .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 9px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.faq-hero-rag .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 12px;
  border: 1px solid var(--faq-border);
  border-radius: 999px;
  background: var(--faq-surface);
  color: var(--faq-soft);
  font-size: 13px;
  font-weight: 700;
  box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
}
.faq-hero-rag .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 30px;
}
.faq-hero-rag .nero-ai-btn {
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
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.faq-hero-rag .nero-ai-btn:hover { transform: translateY(-2px); }
.faq-hero-rag .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, var(--faq-accent), var(--faq-accent2));
  box-shadow: 0 14px 36px rgba(99, 102, 241, 0.28);
}
.faq-hero-rag .nero-ai-btn-secondary {
  color: var(--faq-text) !important;
  background: var(--faq-surface);
  border-color: var(--faq-border);
}
.faq-hero-rag .faq-hero-steps {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 28px;
  padding: 0;
  list-style: none;
}
.faq-hero-rag .faq-hero-step {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 14px;
  border: 1px solid var(--faq-border);
  border-radius: 14px;
  background: rgba(255, 255, 255, 0.92);
  color: var(--faq-soft);
  font-size: 13px;
  font-weight: 650;
  box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
}
.faq-hero-rag .faq-hero-step span {
  width: 24px;
  height: 24px;
  border-radius: 8px;
  background: linear-gradient(135deg, var(--faq-accent), var(--faq-accent2));
  color: #fff;
  font-size: 11px;
  font-weight: 800;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.faq-hero-rag .nero-ai-dashboard {
  position: relative;
  padding: 16px;
  border-radius: 28px;
  background: var(--faq-surface);
  border: 1px solid var(--faq-border);
  box-shadow: var(--faq-shadow);
}
.faq-hero-rag .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid var(--faq-border);
  border-radius: 20px;
  background: linear-gradient(180deg, #ffffff, #f8fafc);
}
.faq-hero-rag .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 12px 14px;
  border-bottom: 1px solid var(--faq-border);
  background: #f8fafc;
}
.faq-hero-rag .nero-ai-dots { display: flex; gap: 6px; }
.faq-hero-rag .nero-ai-dot { width: 9px; height: 9px; border-radius: 50%; }
.faq-hero-rag .nero-ai-dot:nth-child(1) { background: #f87171; }
.faq-hero-rag .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.faq-hero-rag .nero-ai-dot:nth-child(3) { background: #34d399; }
.faq-hero-rag .nero-ai-window-title {
  color: var(--faq-muted);
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.faq-hero-rag .nero-ai-window-body { padding: 14px; }
.faq-hero-rag .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 10px;
}
.faq-hero-rag .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 17px;
  letter-spacing: -0.03em;
  color: var(--faq-text);
}
.faq-hero-rag .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 9px;
  border-radius: 999px;
  background: rgba(16, 185, 129, 0.1);
  color: #047857;
  font-size: 11px;
  font-weight: 800;
}
.faq-hero-rag .nero-ai-live-pill::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--faq-green);
  box-shadow: 0 0 0 5px rgba(16, 185, 129, 0.15);
  animation: faqHeroPulse 1.5s infinite;
}
@keyframes faqHeroPulse {
  0%, 100% { transform: scale(0.85); opacity: 0.7; }
  50% { transform: scale(1); opacity: 1; }
}
.faq-hero-rag .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 8px;
  margin-bottom: 10px;
}
.faq-hero-rag .nero-ai-metric {
  padding: 10px;
  border: 1px solid var(--faq-border);
  border-radius: 14px;
  background: #fff;
}
.faq-hero-rag .nero-ai-metric span {
  display: block;
  color: var(--faq-muted);
  font-size: 10px;
  font-weight: 700;
}
.faq-hero-rag .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  color: var(--faq-text);
  font-size: 20px;
  line-height: 1;
}
.faq-hero-rag .nero-ai-metric small {
  display: block;
  margin-top: 3px;
  color: #94a3b8;
  font-size: 10px;
}
.faq-hero-rag .faq-dash-canvas-wrap {
  position: relative;
  height: clamp(210px, 30vw, 280px);
  margin: 0 0 10px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(99, 102, 241, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(99, 102, 241, 0.06), #f8fafc 72%);
}
.faq-hero-rag #ai-faq-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.faq-hero-rag .nero-ai-task-stream { display: grid; gap: 7px; }
.faq-hero-rag .nero-ai-task {
  display: grid;
  grid-template-columns: 26px 1fr auto;
  align-items: center;
  gap: 9px;
  padding: 9px;
  border: 1px solid var(--faq-border);
  border-radius: 12px;
  background: #fff;
}
.faq-hero-rag .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 26px;
  height: 26px;
  border-radius: 10px;
  background: rgba(99, 102, 241, 0.1);
  color: var(--faq-accent);
  font-size: 10px;
  font-weight: 800;
}
.faq-hero-rag .nero-ai-task strong {
  display: block;
  color: var(--faq-text);
  font-size: 11px;
}
.faq-hero-rag .nero-ai-task span {
  color: var(--faq-muted);
  font-size: 10px;
}
.faq-hero-rag .nero-ai-status {
  padding: 3px 7px;
  border-radius: 999px;
  background: rgba(16, 185, 129, 0.1);
  color: #047857;
  font-size: 9px;
  font-weight: 800;
  white-space: nowrap;
}
.faq-hero-rag .nero-ai-status--amber {
  background: rgba(245, 158, 11, 0.12);
  color: #b45309;
}
.faq-hero-rag .nero-ai-status--violet {
  background: rgba(99, 102, 241, 0.12);
  color: #4338ca;
}
@media (max-width: 1080px) {
  .faq-hero-rag .nero-ai-hero-grid { grid-template-columns: 1fr; }
}
@media (max-width: 520px) {
  .faq-hero-rag .nero-ai-dashboard { padding: 10px; border-radius: 22px; }
  .faq-hero-rag .nero-ai-window-body { padding: 10px; }
  .faq-hero-rag .nero-ai-task { grid-template-columns: 26px 1fr; }
  .faq-hero-rag .nero-ai-status { grid-column: 2; width: fit-content; }
  .faq-hero-rag .faq-hero-steps { flex-direction: column; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Сайт / FAQ · RAG · виджет под ключ</p>
      <h1 id="faq-hero-title">AI-FAQ для сайта: <span class="nero-ai-gradient-text">внедрение динамических ответов из базы знаний</span></h1>
      <p class="nero-ai-hero-lead">Настроим виджет, который отвечает на вопросы клиентов из вашей базы знаний и сам обновляет FAQ по реальным запросам — без ручного переписывания страниц</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">RAG-поиск</li>
        <li class="nero-ai-badge">Авто-FAQ</li>
        <li class="nero-ai-badge">24/7</li>
        <li class="nero-ai-badge">Эскалация к оператору</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Собрать AI-FAQ'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает RAG</a>
      </div>
      <ol class="faq-hero-steps" aria-label="Этапы внедрения">
        <li class="faq-hero-step"><span>1</span> Аудит KB</li>
        <li class="faq-hero-step"><span>2</span> Индексация</li>
        <li class="faq-hero-step"><span>3</span> Виджет</li>
        <li class="faq-hero-step"><span>4</span> Пилот</li>
        <li class="faq-hero-step"><span>5</span> Публикация FAQ</li>
      </ol>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-FAQ: RAG-поиск и автообновление FAQ">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-FAQ · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>База знаний → виджет → FAQ</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Вопросов сегодня</span>
              <strong>347</strong>
              <small>виджет + inline FAQ</small>
            </div>
            <div class="nero-ai-metric">
              <span>Resolved без оператора</span>
              <strong>78%</strong>
              <small>confidence ≥ 0.85</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время ответа</span>
              <strong>4.2 сек</strong>
              <small>RAG + rerank</small>
            </div>
            <div class="nero-ai-metric">
              <span>Новых пар в FAQ</span>
              <strong>+12</strong>
              <small>за неделю · HITL</small>
            </div>
          </div>

          <div class="faq-dash-canvas-wrap" aria-hidden="false">
            <canvas id="ai-faq-hero-canvas" role="img" aria-label="Анимация: вопросы по орбите идут в RAG-vault, ответ с цитатой появляется в виджете и публикуется в блок FAQ"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий AI-FAQ">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">Q</span>
              <div><strong>«Сколько стоит внедрение?»</strong><span>3 чанка из прайса · citation ✓</span></div>
              <span class="nero-ai-status">resolved</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">KB</span>
              <div><strong>PDF регламента переиндексирован</strong><span>Notion + сайт · 1 240 чанков</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">FAQ</span>
              <div><strong>Новая пара на модерацию</strong><span>«Можно ли WordPress?» → черновик</span></div>
              <span class="nero-ai-status nero-ai-status--violet">HITL</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Медвопрос — эскалация</strong><span>confidence 0.41 → оператор CRM</span></div>
              <span class="nero-ai-status nero-ai-status--amber">escalated</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * ai-faq-hero-engine — «Семантический зал базы знаний»
 * Фазы: ingest → retrieve → generate → publish (не сборка сайта / не проводка ERP)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("ai-faq-hero-canvas");
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
    scale = Math.min(cw / 420, ch / 270) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    doc: "#e0e7ff",
    docEdge: "#6366f1",
    shard: "#c7d2fe",
    shardHot: "#818cf8",
    vault: "#f1f5f9",
    query: "#a5b4fc",
    widget: "#ffffff",
    widgetHeader: "#eef2ff",
    citation: "#ccfbf1",
    gateRed: "#fca5a5",
    gateGreen: "#6ee7b7",
    publish: "#ddd6fe",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#ffffff",
    bubbleText: "#0f172a"
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

  /* Ingest: документы падают в vault слева */
  function KnowledgeIngestPipeline() {
    this.docs = [
      { t: 0, label: "PDF" },
      { t: 55, label: "FAQ" },
      { t: 110, label: "Docs" }
    ];
  }
  KnowledgeIngestPipeline.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -168, -18, 36, 52, 5, C.vault, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Ingest", -150, -24);

    this.docs.forEach(function (d) {
      var t = ((frame * 0.5 + d.t) % 90) / 90;
      if (t > 0.85) return;
      var dx = -195 + t * 55;
      var dy = -55 + t * 70 + Math.sin(t * Math.PI) * 8;
      drawRR(ctx, dx - 10, dy - 12, 20, 24, 3, C.doc, C.docEdge);
      ctx.fillStyle = C.docEdge;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText(d.label, dx, dy + 2);
    });
  };

  /* Центральный vault векторов — шестиугольная сетка */
  function VectorShardVault() {
    this.nodes = [];
    for (var i = 0; i < 12; i++) {
      this.nodes.push({ angle: (i / 12) * Math.PI * 2, r: 28 + (i % 3) * 14 });
    }
  }
  VectorShardVault.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var pulse = 0.5 + Math.sin(frame * 0.08) * 0.25;

    ctx.strokeStyle = "rgba(99,102,241,0.25)";
    ctx.lineWidth = 1;
    for (var i = 0; i < 6; i++) {
      var a = (i / 6) * Math.PI * 2 + frame * 0.004;
      ctx.beginPath();
      ctx.moveTo(-8, -8);
      ctx.lineTo(-8 + Math.cos(a) * 72, -8 + Math.sin(a) * 52);
      ctx.stroke();
    }

    drawRR(ctx, -42, -38, 84, 76, 12, C.vault, C.outline);
    ctx.fillStyle = "#6366f1";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Vector KB", 0, -8);

    this.nodes.forEach(function (n, i) {
      var hot = prg >= 58 && prg < 128 && (i + frame) % 5 === 0;
      var nx = Math.cos(n.angle + frame * 0.006) * n.r * 0.55;
      var ny = Math.sin(n.angle + frame * 0.006) * n.r * 0.4;
      drawRR(ctx, nx - 5, ny - 4, 10, 8, 2, hot ? C.shardHot : C.shard, C.outline);
    });

    if (prg >= 58 && prg < 128) {
      ctx.strokeStyle = "rgba(20,184,166," + (pulse * 0.6) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 0, 38 + pulse * 6, 0, Math.PI * 2);
      ctx.stroke();
    }
  };

  /* Орбитальный поток вопросов — вместо Conveyor */
  function QueryOrbitalStream() {
    this.queries = ["?", "??", "FAQ", "RAG"];
  }
  QueryOrbitalStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 40) return;

    this.queries.forEach(function (q, i) {
      var orbitR = 58 + i * 10;
      var speed = 0.018 + i * 0.004;
      var ang = frame * speed + (i / this.queries.length) * Math.PI * 2;
      var qx = Math.cos(ang) * orbitR;
      var qy = Math.sin(ang) * orbitR * 0.55 - 5;
      var alpha = prg < 128 ? 1 : Math.max(0, 1 - (prg - 128) / 40);

      ctx.globalAlpha = alpha;
      drawRR(ctx, qx - 9, qy - 8, 18, 16, 8, C.query, C.outline);
      ctx.fillStyle = "#312e81";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(q, qx, qy + 3);
      ctx.globalAlpha = 1;

      if (prg >= 58 && prg < 125 && i === 0) {
        ctx.strokeStyle = "rgba(99,102,241,0.35)";
        ctx.setLineDash([3, 3]);
        ctx.beginPath();
        ctx.moveTo(qx, qy);
        ctx.lineTo(0, 0);
        ctx.stroke();
        ctx.setLineDash([]);
      }
    }, this);
  };

  /* Виджет ответа — вместо WebsiteTerminal */
  function AnswerWidgetConsole() {
    this.answerAlpha = 0;
    this.confidence = 0;
  }
  AnswerWidgetConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var wx = 72, wy = -52;

    drawRR(ctx, wx, wy, 118, 108, 10, C.widget, C.outline);
    drawRR(ctx, wx + 6, wy + 6, 106, 22, [6, 6, 0, 0], C.widgetHeader, null);
    ctx.fillStyle = "#4338ca";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("AI-FAQ виджет", wx + 12, wy + 18);

    drawRR(ctx, wx + 8, wy + 34, 102, 16, 6, "#f8fafc", C.outline);
    ctx.fillStyle = "#64748b";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("Сколько стоит внедрение?", wx + 14, wy + 45);

    if (prg >= 118) {
      this.answerAlpha = Math.min(1, (prg - 118) / 20);
      this.confidence = Math.min(0.92, (prg - 118) / 35);

      ctx.globalAlpha = this.answerAlpha;
      drawRR(ctx, wx + 8, wy + 56, 102, 38, 6, "#f0fdf4", C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("От 80 тыс. ₽, пакет Старт", wx + 14, wy + 70);
      drawRR(ctx, wx + 12, wy + 78, 48, 10, 3, C.citation, C.outline);
      ctx.fillStyle = "#0f766e";
      ctx.font = "5px Inter,sans-serif";
      ctx.fillText("прайс.pdf", wx + 18, wy + 85);
      ctx.globalAlpha = 1;

      var barW = 70 * this.confidence;
      drawRR(ctx, wx + 12, wy + 92, 70, 5, 2, "#e2e8f0", null);
      drawRR(ctx, wx + 12, wy + 92, barW, 5, 2, C.gateGreen || "#6ee7b7", null);
    }
  };

  /* Ворота confidence / эскалация */
  function ConfidenceEscalationGate() {
    this.flash = 0;
  }
  ConfidenceEscalationGate.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, 48, 42, 52, 36, 6, "#fff", C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Gate", 74, 50);

    if (prg >= 155 && prg < 175) {
      this.flash = Math.sin(frame * 0.3) * 0.3 + 0.7;
      drawRR(ctx, 52, 56, 44, 14, 4, "rgba(252,165,165," + this.flash + ")", C.gateRed);
      ctx.fillStyle = "#991b1b";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("→ оператор", 74, 66);
    } else if (prg >= 128) {
      drawRR(ctx, 52, 56, 44, 14, 4, "rgba(110,231,183,0.35)", C.gateGreen);
      ctx.fillStyle = "#047857";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("auto ✓", 74, 66);
    }
  };

  /* Публикация в SEO-блок FAQ — финал цикла */
  function FaqPublishBeacon() {
    this.cardY = 90;
  }
  FaqPublishBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, 118, 38, 58, 72, 8, "#faf5ff", C.outline);
    ctx.fillStyle = "#6d28d9";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("FAQ блок", 147, 48);
    drawRR(ctx, 124, 54, 46, 10, 2, "#ede9fe", C.outline);
    drawRR(ctx, 124, 68, 46, 10, 2, "#ede9fe", C.outline);

    if (prg >= 198) {
      var fly = Math.min(1, (prg - 198) / 22);
      var cy = 90 - fly * 42;
      var cxCard = 100 + fly * 47;
      drawRR(ctx, cxCard - 22, cy - 14, 44, 28, 6, C.publish, "#7c3aed");
      ctx.fillStyle = "#4c1d95";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("+ Q&A", cxCard, cy + 2);
      if (fly > 0.85) {
        drawRR(ctx, 124, 82, 46, 12, 3, "rgba(167,139,250,0.45)", "#7c3aed");
        ctx.fillStyle = "#5b21b6";
        ctx.font = "bold 5px Inter,sans-serif";
        ctx.fillText("Schema ✓", 147, 91);
      }
    }
  };

  /* Citation chips — всплывающие источники */
  function SourceCitationChip() {}
  SourceCitationChip.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 125 || prg > 195) return;
    var chips = ["Notion", "PDF", "сайт"];
    chips.forEach(function (c, i) {
      var pop = Math.min(1, (prg - 125 - i * 8) / 10);
      if (pop <= 0) return;
      ctx.globalAlpha = pop;
      drawRR(ctx, -95 + i * 38, 48, 34, 12, 4, C.citation, C.outline);
      ctx.fillStyle = "#0f766e";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(c, -78 + i * 38, 57);
      ctx.globalAlpha = 1;
    });
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
      "1_architect": { x: -120, y: 8 },
      "2_seo": { x: -40, y: 22 },
      "3_coder": { x: 20, y: 22 },
      "4_designer": { x: 90, y: 8 },
      "5_deployer": { x: 130, y: 55 }
    };
    var tgt = targets[this.role] || { x: 0, y: 15 };

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

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.1) {
      createBubble(this.x, this.y - 14, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 220);
    }

    var bob = Math.sin(this.timer * 1.4) * 1;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 5.5;
      legL = Math.sin(wp) * 4;
      legR = Math.sin(wp + Math.PI) * 4;
    }
    drawRR(ctx, -8, -4 + Math.max(0, legL), 7, 11, 2, C.outline, null);
    drawRR(ctx, 0, -4 + Math.max(0, legR), 7, 11, 2, C.outline, null);
    drawRR(ctx, -11, -9 - bob, 22, 14, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -20 - bob, 8, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.3;
    ctx.stroke();
    if (carryType) drawRR(ctx, -14 * faceDir, -14 - bob, 11, 11, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new KnowledgeIngestPipeline());
  entities.push(new VectorShardVault());
  entities.push(new QueryOrbitalStream());
  entities.push(new AnswerWidgetConsole());
  entities.push(new ConfidenceEscalationGate());
  entities.push(new FaqPublishBeacon());
  entities.push(new SourceCitationChip());
  entities.push(new Agent(-145, 72, C.agentYellow, "1_architect", 18, [
    "Chunking 800 токенов", "Карта KB и FAQ", "Аудит белых пятен"
  ]));
  entities.push(new Agent(-75, 78, C.agentGreen, "2_seo", 62, [
    "FAQPage Schema", "Кластер вопросов", "LSI в подсказках"
  ]));
  entities.push(new Agent(0, 82, C.agentBlue, "3_coder", 108, [
    "Hybrid search top-k", "Reranker включён", "Лог no-answer"
  ]));
  entities.push(new Agent(75, 78, C.agentPink, "4_designer", 154, [
    "Drawer UX виджета", "Citation в ответе", "Брендинг клиники"
  ]));
  entities.push(new Agent(145, 72, C.agentPurple, "5_deployer", 200, [
    "WP FAQ-блок sync", "152-ФЗ: LLM в РФ", "Пилот 2 недели"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 230, maxLife: life || 230 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 12 && prg < 12.05) createBubble(-150, -30, "1. Ingest PDF/FAQ");
    if (prg >= 62 && prg < 62.05) createBubble(-20, -50, "2. Retrieve chunks");
    if (prg >= 122 && prg < 122.05) createBubble(90, -40, "3. Ответ + citation");
    if (prg >= 202 && prg < 202.05) createBubble(130, 20, "4. FAQ опубликован");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 8) alpha = (bub.maxLife - bub.life) / 8;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      drawRR(ctx, bub.x - tw / 2, bub.y - 18, tw, 18, 6, C.bubbleBg, C.outline);
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

<div class="afq-content">

  <section class="afq-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="afq-cnt">
      <div class="afq-intro-grid nero-ai-reveal">
        <div class="afq-intro-text">
          <p class="afq-eyebrow">Лонгрид · ai faq для сайта</p>
          <p><strong>Коротко:</strong> AI-FAQ — связка виджета на сайте, RAG-поиска по вашим документам и механики автообновления FAQ по реальным вопросам клиентов. Nero Network внедряет решение под ключ для B2B-услуг, клиник, EdTech и SaaS в коридоре <strong>80–220 тыс. ₽</strong>.</p>
          <p>Статичный FAQ когда-то закрывал базовые интенты. Сегодня он часто устаревает быстрее, чем маркетинг успевает его править: новые тарифы, условия, интеграции — а на сайте остаётся текст двухлетней давности.</p>
        </div>
        <div class="afq-intro-deco" aria-label="Ключевые метрики AI-FAQ">
          <div class="afq-chip"><span class="afq-chip-dot" aria-hidden="true"></span><div><strong>78% resolved</strong><span>типовые вопросы без оператора</span></div></div>
          <div class="afq-chip"><span class="afq-chip-dot" style="background:#6366f1" aria-hidden="true"></span><div><strong>4 сек</strong><span>среднее время ответа RAG</span></div></div>
          <div class="afq-chip"><span class="afq-chip-dot" style="background:#f59e0b" aria-hidden="true"></span><div><strong>+12 FAQ/нед</strong><span>новые пары из логов · HITL</span></div></div>
          <div class="afq-chip"><span class="afq-chip-dot" style="background:#8b5cf6" aria-hidden="true"></span><div><strong>80–220 тыс. ₽</strong><span>пакеты Старт / Бизнес / Pro</span></div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="afq-toc-outer">
    <div class="afq-cnt">
      <nav class="afq-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое AI-FAQ</a>
        <a href="#kak-rabotaet">Как работает RAG</a>
        <a href="#vnedrenie">Внедрение под ключ</a>
        <a href="#rezultaty">Результаты</a>
        <a href="#integracii">Интеграции</a>
        <a href="#riski">Риски</a>
        <a href="#ceny">Стоимость</a>
        <a href="#etapy">Этапы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="afq-section" id="chto-takoe">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">Боль и решение</span>
        <h2>Что такое AI-FAQ и почему статичный FAQ перестаёт работать</h2>
        <p>Динамический FAQ на базе знаний закрывает повторяющиеся вопросы 24/7 и показывает, где в контенте «белые пятна».</p>
      </div>

      <div class="afq-card nero-ai-reveal" style="margin-bottom:24px;">
        <h3 style="font-size:18px;margin-bottom:10px;">Определение</h3>
        <p><strong>AI-FAQ (AI-динамический FAQ)</strong> — не страница с десятком застывших вопросов, а система, которая отвечает посетителю из <strong>базы знаний</strong> через RAG, логирует реальные запросы и <strong>предлагает обновления</strong> для SEO-блока FAQ без ручного переписывания всей страницы.</p>
      </div>

      <div class="afq-grid-3 nero-ai-reveal">
        <div class="afq-card">
          <h3>Почему FAQ устаревает</h3>
          <p>Поддержка отвечает на одни и те же вопросы десятки раз в неделю. FAQ на сайте не отражает реальные запросы из чата и почты. Устаревший FAQ снижает доверие.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Чем отличается от обычного блока</h3>
          <p>Умный FAQ на сайте живёт в базе знаний: видимый блок обновляется по правилам, когда редактор утверждает новые пары из логов.</p>
        </div>
        <div class="afq-card nero-ai-delay-2">
          <h3>Для кого подходит</h3>
          <p>B2B-услуги, клиники, EdTech и SaaS — где FAQ влияет на конверсию и нагрузку на поддержку.</p>
        </div>
      </div>

      <div class="afq-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="afq-table">
          <thead><tr><th>Подход</th><th>Как работает</th><th>Слабое место</th></tr></thead>
          <tbody>
            <tr><td><strong>Статичный FAQ</strong></td><td>Ручное редактирование HTML/блока в CMS</td><td>Быстро устаревает, не видит реальные запросы</td></tr>
            <tr><td><strong>Сценарный чат-бот</strong></td><td>Жёсткие ветки «если X → ответ Y»</td><td>Долго обучать; каждая правка — разработка</td></tr>
            <tr><td><strong>AI-FAQ на RAG</strong></td><td>Поиск по документам + ответ с цитатой источника</td><td>Нужна качественная KB и контроль качества</td></tr>
            <tr><td><strong>AI-FAQ + динамическое обновление</strong></td><td>Виджет + лог вопросов → модерация → публикация в FAQ</td><td>Проектная доработка Nero Network поверх RAG</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;text-align:left;max-width:900px;"><!-- INTERNAL-LINKS:INSERT -->Кейс КНАУФ (Just AI): RAG-ветка вместо ручных Q&A-пар на ~1 000 страниц документов — <strong>89% точности</strong>, экономия до <strong>50% времени</strong> поддержки. Для клиник: V-AI Labs — ответ за 3 сек, <strong>72%</strong> обращений без админов. Для SaaS: СофтВейв — <strong>92% точность</strong>, <strong>−45%</strong> тикетов только с людьми.</p>
    </div>
  </section>

  <section class="afq-section afq-section-alt" id="kak-rabotaet">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">RAG · база знаний</span>
        <h2>Как работает AI-FAQ на базе знаний (RAG)</h2>
        <p>От вопроса посетителя до ответа с цитатой и эскалации к оператору — прозрачный контур качества.</p>
      </div>

      <div class="afq-scenario nero-ai-reveal">
        <h3>Откуда берутся ответы: база знаний, документы, wiki</h3>
        <p><strong>FAQ на основе базы знаний</strong> строится на RAG: модель ищет релевантные фрагменты в документах и формулирует ответ с опорой на контекст.</p>
        <ol style="margin:12px 0 0;padding-left:20px;color:var(--afq-muted);font-size:14.5px;line-height:1.7;">
          <li>Документы → чанки (500–1000 токенов)</li>
          <li>Embeddings → vector store (Qdrant, pgvector)</li>
          <li>Семантический поиск top-k (+ hybrid search, reranker)</li>
          <li>LLM генерирует ответ <strong>строго по контексту</strong> + ссылки на источники</li>
          <li>Confidence score — ниже порога → эскалация к оператору</li>
        </ol>
      </div>

      <div class="afq-scenario nero-ai-reveal">
        <h3>Как система учится на реальных вопросах посетителей</h3>
        <p><strong>Автоматическое обновление FAQ</strong> — цикл с модерацией: лог вопросов → топ без ответа → черновик Q&A → утверждение редактора → публикация в WordPress + Schema FAQPage.</p>
      </div>

      <div class="afq-scenario nero-ai-reveal">
        <h3>Контроль качества: логирование, модерация, эскалация к оператору</h3>
        <p>Citations, confidence threshold, blacklist тем (медицина, юридические формулировки), audit log. ДИТ Москвы × AutoFAQ: до <strong>250 обращений в час</strong> в пик. sk.ru / OSMI: <strong>87,8% accuracy</strong>, ответ до <strong>10 сек</strong>.</p>
      </div>
    </div>
  </section>


<section id="ai-faq-dlya-saita-boris-block" class="bfq-root" aria-label="Анимация: RAG-пайплайн AI-FAQ — от вопроса посетителя до обновления FAQ-блока">
<style>
/* === БОРИС: prefix bfq-, scoped внутри #ai-faq-dlya-saita-boris-block === */
#ai-faq-dlya-saita-boris-block.bfq-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-faq-dlya-saita-boris-block .bfq-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-faq-dlya-saita-boris-block .bfq-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-faq-dlya-saita-boris-block .bfq-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-faq-dlya-saita-boris-block .bfq-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-faq-dlya-saita-boris-block .bfq-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-faq-dlya-saita-boris-block .bfq-ey{
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
#ai-faq-dlya-saita-boris-block .bfq-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0d9488;
  border-radius:1px;
}
#ai-faq-dlya-saita-boris-block .bfq-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-faq-dlya-saita-boris-block .bfq-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-faq-dlya-saita-boris-block .bfq-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-faq-dlya-saita-boris-block .bfq-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(13,148,136,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0f766e;
  margin-top:1px;
  font-style:normal;
}
#ai-faq-dlya-saita-boris-block .bfq-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-faq-dlya-saita-boris-block .bfq-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-faq-dlya-saita-boris-block .bfq-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-faq-dlya-saita-boris-block .bfq-pl-t{
  background:rgba(13,148,136,.08);
  color:#0f766e;
  border:1.5px solid rgba(13,148,136,.22);
}
#ai-faq-dlya-saita-boris-block .bfq-pl-a{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.22);
}
#ai-faq-dlya-saita-boris-block .bfq-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-faq-dlya-saita-boris-block .bfq-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0fdfa 0%,#ecfeff 28%,#f0f9ff 72%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-faq-dlya-saita-boris-block .bfq-rgt{min-height:380px;}
}
#bfq-rag-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bfq-cnt">
  <div class="bfq-card">

    <div class="bfq-lft">
      <span class="bfq-ey">RAG · база знаний</span>
      <h3 class="bfq-h3">Вопрос посетителя — поиск по документам, ответ с цитатой и черновик в FAQ</h3>
      <ul class="bfq-ul">
        <li><span class="bfq-ic">1</span>Семантический поиск по чанкам KB: PDF, Notion, wiki, старый FAQ</li>
        <li><span class="bfq-ic">2</span>LLM формирует ответ <strong>только из контекста</strong> + ссылка на источник</li>
        <li><span class="bfq-ic">3</span>Confidence score: ниже порога — эскалация оператору с транскриптом</li>
        <li><span class="bfq-ic">↻</span>Частые «белые пятна» → черновик Q&amp;A на модерацию → публикация в SEO-блок FAQ</li>
      </ul>
      <div class="bfq-pills">
        <span class="bfq-pl bfq-pl-t">top-k чанков</span>
        <span class="bfq-pl bfq-pl-g">citations</span>
        <span class="bfq-pl bfq-pl-a">HITL-модерация</span>
      </div>
      <p class="bfq-foot">Дальше — что входит во внедрение AI-FAQ под ключ и пакеты 80–220 тыс. ₽ →</p>
    </div>

    <div class="bfq-rgt">
      <canvas
        id="bfq-rag-pipeline-canvas"
        aria-label="Анимация RAG-пайплайна: вопрос посетителя проходит семантический поиск по базе знаний, LLM генерирует ответ с цитатой, новая пара Q&amp;A предлагается в динамический FAQ"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bfq-rag-pipeline-canvas');
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
    soft:'#94a3b8',
    paper:'#ffffff',
    paperBdr:'#cbd5e1',
    teal:'#0d9488',
    tealGlow:'rgba(13,148,136,.18)',
    cyan:'#06b6d4',
    violet:'#7c3aed',
    violetGlow:'rgba(124,58,237,.15)',
    green:'#22c55e',
    amber:'#f59e0b',
    amberBg:'#fef3c7',
    red:'#ef4444',
    chunk:'#e0f2fe',
    chunkHi:'#99f6e4',
    chunkBdr:'#7dd3fc',
    line:'rgba(13,148,136,.35)',
    bubble:'#f1f5f9',
    bubbleBdr:'#cbd5e1'
  };

  var QUESTIONS = [
    {text:'Сколько стоит?', delay:0},
    {text:'Как подключить к WP?', delay:180},
    {text:'Есть ли 152-ФЗ?', delay:360},
    {text:'Срок запуска?', delay:540}
  ];

  var CHUNKS = [
    {label:'Прайс.pdf', x:0.52, y:0.18},
    {label:'Регламент', x:0.68, y:0.28},
    {label:'FAQ v2', x:0.58, y:0.42},
    {label:'Notion KB', x:0.72, y:0.52},
    {label:'Wiki', x:0.50, y:0.58},
    {label:'Договор', x:0.66, y:0.68}
  ];

  var LOOP = 720;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawQuestionBubble(x,y,text,alpha,prog){
    var maxW=Math.min(110,W*0.2);
    ctx.globalAlpha=alpha||1;
    ctx.font='bold 9px Inter,system-ui,sans-serif';
    var lines=[], words=text.split(' '), line='';
    words.forEach(function(w){
      var test=line?line+' '+w:w;
      if(ctx.measureText(test).width>maxW-16){ lines.push(line); line=w; }
      else line=test;
    });
    if(line) lines.push(line);
    var lh=13, ph=10+lines.length*lh, pw=maxW;
    rr(x,y,pw,ph,10,C.bubble,C.bubbleBdr,1.5);
    ctx.fillStyle=C.ink;
    ctx.textAlign='left';
    lines.forEach(function(ln,i){ ctx.fillText(ln,x+10,y+14+i*lh); });
    if(prog!==undefined && prog>0){
      ctx.strokeStyle=C.teal;
      ctx.lineWidth=2;
      ctx.beginPath();
      ctx.arc(x+pw-8,y+8,5,0,Math.PI*2*Math.min(1,prog));
      ctx.stroke();
    }
    ctx.globalAlpha=1;
    return ph;
  }

  function drawVectorStore(cx,cy,w,h,pulse,activeIdx){
    rr(cx,cy,w,h,14,C.paper,'#e2e8f0',1.5);
    ctx.fillStyle=C.teal;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Vector store · KB',cx+12,cy+18);

    CHUNKS.forEach(function(ch,i){
      var px=cx+12+(w-24)*((ch.x-0.48)/0.28);
      var py=cy+28+(h-44)*((ch.y-0.14)/0.58);
      var cw=52, chh=22;
      var hi=activeIdx===i;
      rr(px,py,cw,chh,6,hi?C.chunkHi:C.chunk,hi?C.teal:C.chunkBdr,hi?2:1);
      ctx.fillStyle=hi?C.ink:C.muted;
      ctx.font=(hi?'bold ':'')+'8px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(ch.label,px+cw/2,py+14);
      if(hi){
        ctx.beginPath();
        ctx.arc(px+cw/2,py+chh/2,18+Math.sin(pulse*0.08)*4,0,Math.PI*2);
        ctx.strokeStyle=C.tealGlow;
        ctx.lineWidth=3;
        ctx.stroke();
      }
    });

    for(var j=0;j<3;j++){
      var a=(j/3)*Math.PI*2+pulse*0.04;
      ctx.beginPath();
      ctx.arc(cx+w/2+Math.cos(a)*30,cy+h/2+Math.sin(a)*20,2.5,0,Math.PI*2);
      ctx.fillStyle=C.cyan;
      ctx.fill();
    }
  }

  function drawRetriever(cx,cy,w,h,pulse){
    rr(cx,cy,w,h,12,C.violetGlow,C.violet,2);
    ctx.fillStyle=C.violet;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Retriever',cx+w/2,cy+16);
    ctx.fillStyle=C.muted;
    ctx.font='8px Inter,sans-serif';
    ctx.fillText('hybrid search',cx+w/2,cy+28);

    var scanY=cy+36+(pulse%50);
    ctx.fillStyle='rgba(124,58,237,.12)';
    ctx.fillRect(cx+8,scanY-1,w-16,3);
    ctx.strokeStyle=C.violet;
    ctx.lineWidth=1.5;
    ctx.beginPath();
    ctx.moveTo(cx+8,scanY);ctx.lineTo(cx+w-8,scanY);
    ctx.stroke();
  }

  function drawLlmPanel(x,y,w,h,conf,answerLines,cite,pulse){
    rr(x,y,w,h,10,C.paper,'#e2e8f0',1.5);
    ctx.fillStyle=C.violet;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('LLM · ответ из контекста',x+10,y+16);

    var barW=w-20, barX=x+10, barY=y+24;
    rr(barX,barY,barW,8,4,'#f1f5f9',null,0);
    var col=conf>0.85?C.green:conf>0.7?C.amber:C.red;
    rr(barX,barY,barW*conf,8,4,col,null,0);
    ctx.fillStyle=C.muted;
    ctx.font='8px Inter,sans-serif';
    ctx.textAlign='right';
    ctx.fillText(Math.round(conf*100)+'% conf',x+w-10,y+22);

    answerLines.forEach(function(ln,i){
      ctx.fillStyle=C.ink;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(ln,x+10,y+44+i*12);
    });

    if(cite){
      rr(x+10,y+h-22,w-20,16,6,C.tealGlow,C.teal,1);
      ctx.fillStyle=C.teal;
      ctx.font='bold 8px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText('↗ '+cite,x+16,y+h-10);
    }

    if(pulse%40<20){
      ctx.fillStyle=C.violet;
      ctx.font='bold 14px monospace';
      ctx.textAlign='right';
      ctx.fillText('|',x+w-12,y+44+answerLines.length*12);
    }
  }

  function drawFaqBlock(x,y,w,h,newPairAlpha,modPulse){
    rr(x,y,w,h,10,'#f8fafc','#e2e8f0',1.5);
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Динамический FAQ',x+10,y+16);

    var slots=[
      {q:'Сколько стоит AI-FAQ?',done:true},
      {q:'Как подключить к WordPress?',done:true},
      {q:'Новый вопрос из логов…',done:false}
    ];
    var sy=y+26, sh=28, gap=5;
    slots.forEach(function(s,i){
      var slotY=sy+i*(sh+gap);
      rr(x+8,slotY,w-16,sh,6,s.done?'rgba(34,197,94,.08)':'rgba(245,158,11,.1)',s.done?C.green:C.amber,1);
      ctx.fillStyle=s.done?C.ink:'#b45309';
      ctx.font=(s.done?'':'italic ')+'8px Inter,sans-serif';
      ctx.textAlign='left';
      var qtxt=s.q.length>28?s.q.slice(0,26)+'…':s.q;
      ctx.fillText(qtxt,x+14,slotY+17);
      if(s.done){
        ctx.fillStyle=C.green;
        ctx.font='bold 10px sans-serif';
        ctx.textAlign='right';
        ctx.fillText('✓',x+w-14,slotY+17);
      }
    });

    if(newPairAlpha>0.05){
      var ny=y+h-32;
      ctx.globalAlpha=newPairAlpha;
      rr(x+8,ny,w-16,24,6,C.amberBg,C.amber,1.5);
      ctx.fillStyle='#b45309';
      ctx.font='bold 8px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText('На модерацию'+(modPulse%30<15?'…':''),x+14,ny+15);
      ctx.globalAlpha=1;
    }
  }

  function drawArrow(x1,y1,x2,y2,alpha,dash){
    ctx.globalAlpha=alpha||0.55;
    ctx.strokeStyle=C.line;
    ctx.lineWidth=1.5;
    if(dash) ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);ctx.lineTo(x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    var ang=Math.atan2(y2-y1,x2-x1);
    ctx.beginPath();
    ctx.moveTo(x2,y2);
    ctx.lineTo(x2-6*Math.cos(ang-0.4),y2-6*Math.sin(ang-0.4));
    ctx.lineTo(x2-6*Math.cos(ang+0.4),y2-6*Math.sin(ang+0.4));
    ctx.closePath();
    ctx.fillStyle=C.teal;
    ctx.fill();
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);

    var pad=12;
    var retW=Math.min(88,W*0.15);
    var retH=Math.min(72,H*0.18);
    var retX=W*0.34-retW/2;
    var retY=H*0.36-retH/2;
    var vsW=Math.min(150,W*0.28);
    var vsH=Math.min(200,H*0.52);
    var vsX=W*0.52-vsW/2;
    var vsY=H*0.5-vsH/2;
    var llmW=Math.min(130,W*0.24);
    var llmH=Math.min(110,H*0.28);
    var llmX=pad;
    var llmY=H*0.52-llmH/2;
    var faqW=Math.min(120,W*0.22);
    var faqH=Math.min(130,H*0.32);
    var faqX=W-faqW-pad;
    var faqY=H*0.48-faqH/2;

    var activeChunk=Math.floor(t/90)%CHUNKS.length;
    drawVectorStore(vsX,vsY,vsW,vsH,frame,activeChunk);
    drawRetriever(retX,retY,retW,retH,frame);

    QUESTIONS.forEach(function(q){
      var localT=(t-q.delay+LOOP)%LOOP;
      if(localT>LOOP-60) return;
      var prog=Math.min(1,localT/220);
      var startY=pad+8;
      var endX=retX-6;
      var qx=pad+(endX-pad)*prog;
      var qy=startY+((QUESTIONS.indexOf(q))%2)*36;
      var alpha=prog<0.92?1:Math.max(0,1-(localT-200)/15);

      if(prog<0.55){
        drawQuestionBubble(qx,qy,q.text,alpha,prog);
      } else if(prog<0.82){
        var fp=prog-0.55;
        drawArrow(retX+retW/2,retY+retH,vsX+vsW/2,vsY,fp*0.8,true);
        var ch=CHUNKS[activeChunk];
        var cpx=vsX+12+(vsW-24)*((ch.x-0.48)/0.28)+26;
        var cpy=vsY+28+(vsH-44)*((ch.y-0.14)/0.58)+11;
        ctx.beginPath();
        ctx.arc(cpx,cpy,4+fp*6,0,Math.PI*2);
        ctx.fillStyle=C.tealGlow;
        ctx.fill();
      } else {
        var pp=prog-0.82;
        var conf=0.72+pp*0.22;
        drawArrow(vsX,vsY+vsH/2,llmX+llmW,llmY+llmH/2,pp*0.7,false);
        drawLlmPanel(llmX,llmY,llmW,llmH,conf,[
          'Пакеты от 80 тыс. ₽,',
          'запуск 1–2 недели.'
        ],'Прайс.pdf §2',frame);
        if(pp>0.5){
          drawArrow(llmX+llmW,llmY+llmH/2,faqX,faqY+faqH/2,(pp-0.5)*2,false);
        }
      }
    });

    var modAlpha=Math.max(0,Math.sin(t*0.04)*0.5+0.5);
    var showMod=t>400&&t<650;
    drawFaqBlock(faqX,faqY,faqW,faqH,showMod?modAlpha*0.9:0,frame);

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Вопрос посетителя',pad,H-10);
    ctx.textAlign='center';
    ctx.fillText('Поиск по KB',retX+retW/2,H-10);
    ctx.textAlign='right';
    ctx.fillText('Обновление FAQ',faqX+faqW,H-10);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>


  <aside class="ym-cta-block ym-cta-block--primary afq-cnt" id="cta-kak-rabotaet" style="max-width:1180px;margin-left:auto;margin-right:auto;">
    <div class="ym-cta-block__icon" aria-hidden="true">💬</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Собрать AI-FAQ для вашего сайта</p>
      <p class="ym-cta-block__sub">Проведём аудит FAQ и базы знаний, покажем схему RAG-виджета и оценим сроки внедрения в коридоре 80–220 тыс. ₽. Без обязательств.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </aside>

  <section class="afq-section" id="vnedrenie">
    <div class="afq-cnt">
      <div class="afq-sh afq-left">
        <span class="afq-eyebrow">Под ключ</span>
        <h2>Что входит во внедрение AI-FAQ под ключ</h2>
        <p>Аудит, виджет, тестирование и пилот — от карты вопросов до запуска на части трафика.</p>
      </div>

      <div class="afq-grid-3 nero-ai-reveal">
        <div class="afq-card">
          <h3>Аудит текущего FAQ</h3>
          <p>Сбор источников знаний, 30–50 реальных вопросов, карта чувствительных тем, оценка «белых пятен» (3–5 дней).</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Настройка виджета</h3>
          <p>JS-виджет (чат или FAQ drawer), брендинг, подсказки «люди также спрашивают» по логам. WordPress-native внедрение.</p>
        </div>
        <div class="afq-card nero-ai-delay-2">
          <h3>Тестирование и запуск</h3>
          <p>Eval на 50–100 вопросов, настройка порога confidence, обучение команды, пилот 2–4 недели на части трафика.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="afq-section afq-section-alt" id="rezultaty">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">KPI</span>
        <h2>Результаты для бизнеса: меньше тикетов, больше лидов</h2>
        <p>Ориентиры из кейсов рынка — не гарантия Nero Network; честная методология deflection vs resolution.</p>
      </div>

      <div class="afq-table-wrap nero-ai-reveal">
        <table class="afq-table">
          <thead><tr><th>Кейс</th><th>Метрика</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>СофтВейв (SaaS)</td><td>−45% тикетов только с людьми, −23% тикетов/мес</td><td>flow-masters.ru</td></tr>
            <tr><td>V-AI Labs (клиника)</td><td>72% без админов, −50% нагрузки</td><td>v-ai-labs.ru</td></tr>
            <tr><td>КНАУФ</td><td>до 50% экономии времени поддержки</td><td>generation-ai.ru</td></tr>
            <tr><td>Infomaze (SaaS)</td><td>70% тикетов закрывается автоматически</td><td>infomazeelite.com</td></tr>
          </tbody>
        </table>
      </div>

      <div class="afq-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Какие метрики смотреть до и после внедрения</h3>
        <ul>
          <li>Время первого ответа (секунды vs часа)</li>
          <li>% resolved в виджете без эскалации</li>
          <li>% escalated — высокий на старте нормален</li>
          <li>Deflection vs resolution — не путать «отклонение» и полное self-service</li>
          <li>Топ «белых пятен» в KB — карта контента для маркетинга</li>
          <li>Конверсия с инфо-страниц (Метрика/GA4: widget_open, resolved, lead_from_widget)</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="afq-section" id="integracii">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">CMS · CRM · KB</span>
        <h2>Интеграции: CMS, CRM, чаты и источники знаний</h2>
      </div>
      <div class="afq-grid-2 nero-ai-reveal">
        <div class="afq-card">
          <h3>WordPress и другие CMS</h3>
          <p><strong>AI-FAQ WordPress</strong> — приоритет Nero Network: виджет в тему, блок FAQ в page-{slug}.php, Schema FAQPage без REST API для страниц с script/canvas.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Notion, Google Docs, PDF</h3>
          <p>Ingest pipeline: парсинг сайта, PDF, DOCX, Notion/Google Docs API, Confluence, help center URL.</p>
        </div>
        <div class="afq-card">
          <h3>CRM и аналитика</h3>
          <p>amoCRM, Bitrix24 — лид при эскалации с транскриптом. Яндекс.Метрика, GA4 — цели из виджета. Telegram — уведомление менеджеру.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Автоматизация</h3>
          <p>n8n / Make — webhook при «неотвеченном» вопросе → задача редактору в Notion.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="afq-section afq-section-alt" id="riski">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">Compliance</span>
        <h2>Риски и как их закрываем при внедрении</h2>
      </div>
      <div class="afq-grid-3 nero-ai-reveal">
        <div class="afq-card">
          <h3>Галлюцинации</h3>
          <p>RAG «только из контекста», citations, confidence gate, human-in-the-loop на старте. Индивидуальные скидки и жалобы — у человека.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>152-ФЗ и GDPR</h3>
          <p>LLM и vector store в РФ, согласие в виджете, без трансграничной передачи ПДн без оснований. PII-маскирование в логах.</p>
        </div>
        <div class="afq-card nero-ai-delay-2">
          <h3>Живой оператор</h3>
          <p>Гибрид 24/7: бот на типовое, человек на сложное — с полным контекстом диалога. В медицине — только организационные ответы.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="afq-section" id="ceny">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">Коммерция</span>
        <h2>Стоимость AI-FAQ: из чего складывается чек 80–220 тыс. ₽</h2>
      </div>
      <div class="afq-table-wrap nero-ai-reveal">
        <table class="afq-table">
          <thead><tr><th>Пакет</th><th>Состав</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td><strong>Старт</strong></td><td>Виджет + KB до ~100 стр., WordPress, лог вопросов, ручное обновление FAQ</td><td><strong>80–120 тыс. ₽</strong></td></tr>
            <tr><td><strong>Бизнес</strong></td><td>+ CRM-лид, авто-предложения FAQ, 2 источника, аналитика</td><td><strong>120–180 тыс. ₽</strong></td></tr>
            <tr><td><strong>Pro</strong></td><td>+ reranker, Telegram, SLA на KB 30 дней, eval-отчёт</td><td><strong>180–220 тыс. ₽</strong></td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;text-align:left;">Ежемесячно: хостинг + токены LLM <strong>~3 000–15 000 ₽</strong> (средний трафик). Сравнение с 0,5–1 FTE в поддержке: оператор ~80–150 тыс. ₽/мес + онбординг.</p>
    </div>
  </section>

  <section class="afq-section afq-section-alt" id="etapy">
    <div class="afq-cnt">
      <div class="afq-sh afq-left">
        <span class="afq-eyebrow">Процесс</span>
        <h2>Этапы работы с Nero Network: от брифа до запуска</h2>
      </div>
      <div class="afq-card nero-ai-reveal">
        <div class="afq-timeline">
          <div class="afq-tl-item"><div class="afq-tl-dot"></div><h3>Бриф и сбор базы знаний</h3><p>ЦА, каналы, текущий FAQ, CRM, чувствительные темы. Приоритизация топ-30 вопросов.</p></div>
          <div class="afq-tl-item"><div class="afq-tl-dot"></div><h3>MVP RAG-виджета (1–2 недели)</h3><p>Ingest → vector store → виджет. Логирование и динамический FAQ (3–7 дней): дашборд «топ без ответа».</p></div>
          <div class="afq-tl-item"><div class="afq-tl-dot"></div><h3>Пилот и масштабирование</h3><p>2–4 недели на части трафика, доработка по логам. Админка: PDF/ссылка → переиндексация без программиста на каждую правку.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="afq-section" id="samostoyatelno">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">DIY vs под ключ</span>
        <h2>Как сделать AI-FAQ самостоятельно — и когда лучше заказать под ключ</h2>
      </div>
      <div class="afq-grid-2 nero-ai-reveal">
        <div class="afq-card">
          <h3>Обзор подхода: RAG, промпты, виджет</h3>
          <p>Vector store, ingest, LLM с system prompt «только из контекста», open-source или SaaS-виджет, логирование и eval. Хорошо настроенный RAG — 55–72% tier-1 без человека при качественной KB.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Типичные ошибки DIY</h3>
          <p>Индексация «сырого» KB, нет confidence threshold, игнор 152-ФЗ, обещание «−80% тикетов» без eval, виджет без связки с SEO-FAQ.</p>
        </div>
      </div>
      <div class="afq-card nero-ai-reveal" style="margin-top:18px;">
        <h3>Когда выгоднее передать внедрение команде</h3>
        <p>WordPress-native, динамическое обновление FAQ-блока, CRM, compliance, отраслевые сценарии (клиника, SaaS, B2B), eval с метриками accuracy. Уникальный угол Nero Network: <strong>«не просто чат — живой FAQ на сайте»</strong> + пакеты 80–220 тыс. ₽ с TCO.</p>
      </div>
    </div>
  </section>

  <aside class="ym-cta-block ym-cta-block--secondary afq-cnt" id="cta-obuchenie" style="max-width:1180px;margin-left:auto;margin-right:auto;">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Хотите разобраться в RAG и AI-FAQ до старта проекта?</p>
      <p class="ym-cta-block__sub">Если команде важно понимать chunking, промпты, human-in-the-loop и eval до заказа внедрения — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>. Это ускоряет согласование пилота с IT и поддержкой.</p>
    </div>
  </aside>

  <section class="afq-section afq-section-alt" id="faq">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">FAQ</span>
        <h2>FAQ о AI-FAQ</h2>
      </div>
      <div class="afq-faq nero-ai-reveal">
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли подключить AI-FAQ к WordPress?</div><div class="afq-faq-a">Да. Виджет вставляется скриптом в тему; FAQ-блок синхронизируется с утверждёнными Q&A. Nero Network работает с WordPress-native шаблонами без REST API для страниц с script/canvas.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько времени занимает запуск?</div><div class="afq-faq-a">MVP RAG-виджета — 1–2 недели; полный цикл с пилотом — 2–4 недели. КНАУФ — 2 недели до прод; при готовой платформе — вывод за 1 день.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли готовая база знаний до старта?</div><div class="afq-faq-a">Не обязательно. Достаточно FAQ, типовых писем поддержки, регламентов, прайса. Аудит выявит «белые пятна».</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли AI-FAQ для клиник и образовательных проектов?</div><div class="afq-faq-a">Да. Клиники: организационные FAQ, записи, расписание — не медсоветы. EdTech: программы, оплата, дедлайны.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Как виджет обновляет FAQ без ручного редактирования страниц?</div><div class="afq-faq-a">Лог вопросов → кластеризация → черновик Q&A → модерация редактора → публикация в блок FAQ (WP) + Schema FAQPage.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-FAQ отличается от обычного чат-бота?</div><div class="afq-faq-a">Чат-бот — сценарные ветки; AI-FAQ — семантический поиск по KB + опциональное обновление SEO-блока FAQ.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит AI-FAQ?</div><div class="afq-faq-a">80–220 тыс. ₽ разово (пакеты Старт/Бизнес/Pro) + ~3 000–15 000 ₽/мес на LLM и хостинг.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Бот соврёт?</div><div class="afq-faq-a">RAG только по вашим документам, citations, порог уверенности, эскалация. Качество KB — главный фактор.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Как соблюсти 152-ФЗ?</div><div class="afq-faq-a">LLM и БД в РФ, согласие в виджете, без трансграничной передачи ПДн без оснований.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Какие модели используют?</div><div class="afq-faq-a">YandexGPT, GigaChat, Cotype; embedding — Yandex или open-source на RF-сервере.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли программист для обновления ответов?</div><div class="afq-faq-a">После запуска — админка: PDF/ссылка → переиндексация. Разработчик — для новых интеграций.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Как измерить ROI?</div><div class="afq-faq-a">Сравнить время ответа, % resolved, тикеты/мес, конверсию с инфо-страниц до и после пилота.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли интегрировать с amoCRM и Bitrix24?</div><div class="afq-faq-a">Да — лид при эскалации с транскриптом и тегом «AI-FAQ».</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Поддерживаются ли Notion и Google Docs?</div><div class="afq-faq-a">Да, через ingest API; плюс PDF, сайт, Confluence, help center URL.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Что если клиент хочет только человека?</div><div class="afq-faq-a">Гибрид: бот 24/7 на типовое, оператор с контекстом диалога на сложное.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Есть ли демо на странице?</div><div class="afq-faq-a">На лендинге Nero Network — живой виджет «спросите про AI-FAQ»; CTA «Собрать AI-FAQ».</div></div>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final" style="margin-top:32px;">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы обновить FAQ и снизить нагрузку на поддержку?</p>
          <p class="ym-cta-block__sub">Бесплатная схема внедрения: виджет + RAG + динамическое обновление FAQ-блока. Пакеты Старт / Бизнес / Pro — от 80 тыс. ₽.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
          </div>
        </div>
      </div>

      <div class="afq-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:18px;margin-bottom:12px;">Чеклист подготовки к внедрению</h3>
        <ul class="afq-checklist">
          <li>Текущий FAQ и 30–50 реальных вопросов от поддержки</li>
          <li>Регламенты, прайс, инструкции</li>
          <li>Список запрещённых тем и дисклеймеры</li>
          <li>Доступ к CMS для виджета и FAQ-блока</li>
          <li>Политика ПДн и механизм согласия</li>
        </ul>
        <p style="margin-top:18px;"><strong>Итог:</strong> AI-FAQ для сайта — практичный способ закрыть устаревший FAQ, снизить нагрузку на поддержку и поднять конверсию актуальными ответами 24/7. Nero Network внедряет виджет + RAG + динамическое обновление FAQ-блока под ключ в коридоре <strong>80–220 тыс. ₽</strong>.</p>
      </div>
    </div>
  </section>

</div>

<!-- SCHEMA-MARKUP:INSERT -->
</main>

<script>
(function(){
  document.querySelectorAll('.afq-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.afq-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.afq-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.afq-faq-q');
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
  var root = document.querySelector('.ai-faq-dlya-saita-page');
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
