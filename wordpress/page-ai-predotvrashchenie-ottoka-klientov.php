<?php
/**
 * Template Name: AI-агент для предотвращения оттока клиентов: внедрение под ключ
 * Description: SEO-лендинг — AI retention agent, churn prediction, retention-калькулятор. Внедрение под ключ.
 */

$page_seo_title       = 'AI для предотвращения оттока клиентов — внедрение под ключ';
$page_seo_description = 'AI-агент находит признаки оттока и запускает сценарии удержания в SaaS, фитнесе и онлайн-школах. Диагностика риска, retention-калькулятор и внедрение под ключ от Nero Network.';

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
	[ 'label' => 'Боль',         'href' => '#bol' ],
	[ 'label' => 'Как работает', 'href' => '#etapy' ],
	[ 'label' => 'Калькулятор',  'href' => '#kalkulyator' ],
	[ 'label' => 'Кейсы',        'href' => '#keisy' ],
	[ 'label' => 'Стоимость',    'href' => '#ceny' ],
	[ 'label' => 'FAQ',          'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Снизить отток';
$primary_cta_url   = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'Обучение по внедрению AI';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '';
$secondary_cta_attrs = $secondary_cta_url ? ' target="_blank" rel="noopener noreferrer"' : '';

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
.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs,
.yoast-breadcrumb, .entry-header, .page-title-section { display: none !important; }
#primary, .site-main, .site-content, #content, .content-area {
	padding-top: 0 !important; margin-top: 0 !important;
}

/* Hero — min-height + theme alignment */
#hero.nero-ai-hero {
	position: relative;
	min-height: 100vh;
	min-height: 100dvh;
	display: grid;
	align-items: center;
	padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
}
#hero .nero-ai-dashboard-shell { position: relative; }
#apok-hero-retention-canvas {
	display: block; width: 100%; height: 140px; margin: 12px 0 0;
	border-radius: 12px;
	background: linear-gradient(180deg, rgba(5,7,17,.6), rgba(8,11,23,.9));
	border: 1px solid rgba(121,242,255,.12);
}
.apok-hero-tier-pills { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px; }
.apok-hero-tier-pills span {
	font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 999px;
	border: 1px solid rgba(255,255,255,.12); color: #9aa8bd;
}
.apok-hero-tier-pills .low { color: #22c55e; border-color: rgba(34,197,94,.35); }
.apok-hero-tier-pills .med { color: #facc15; border-color: rgba(250,204,21,.35); }
.apok-hero-tier-pills .high { color: #f97316; border-color: rgba(249,115,22,.35); }
.apok-hero-tier-pills .crit { color: #ef4444; border-color: rgba(239,68,68,.45); }

/* Content */
.apok-content {
	--apok-bg: #050711; --apok-text: #e6edf7; --apok-muted: #9aa8bd; --apok-soft: #c7d2e5;
	--apok-heading: #fff; --apok-border: rgba(255,255,255,.10);
	--apok-accent: #79f2ff; --apok-violet: #8b5cf6; --apok-green: #22c55e;
	--apok-btn-from: #2563eb; --apok-btn-to: #7c3aed; --apok-container: 1220px;
	background: linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
	color: var(--apok-text);
	font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
	overflow-x: hidden;
}
.apok-content *, .apok-content *::before, .apok-content *::after { box-sizing: border-box; }
.apok-content a { color: inherit; text-decoration: none; }
.apok-content p { color: var(--apok-muted); line-height: 1.72; margin: 0 0 1em; }
.apok-content h2, .apok-content h3 { color: var(--apok-heading); letter-spacing: -.04em; margin: 0 0 .7em; }
.apok-content strong { color: var(--apok-soft); }
.apok-content ul { padding-left: 0; list-style: none; margin: 0 0 1em; }
.apok-content ul li {
	padding-left: 20px; position: relative; margin-bottom: .45em;
	color: var(--apok-muted); font-size: 14.5px; line-height: 1.65;
}
.apok-content ul li::before { content: '›'; position: absolute; left: 0; color: var(--apok-accent); font-weight: 700; }
.apok-cnt { width: min(var(--apok-container), calc(100% - 40px)); margin: 0 auto; position: relative; z-index: 1; }
.apok-section { padding: clamp(64px, 8vw, 112px) 0; position: relative; }
.apok-section-alt {
	background: linear-gradient(180deg, rgba(255,255,255,.032), rgba(255,255,255,.01));
	border-top: 1px solid rgba(255,255,255,.06); border-bottom: 1px solid rgba(255,255,255,.06);
}
.apok-sh { max-width: 820px; margin: 0 auto 48px; text-align: center; }
.apok-sh h2 { font-size: clamp(26px, 4vw, 50px); line-height: 1.06; margin-bottom: 14px; }
.apok-sh p { font-size: clamp(15px, 1.6vw, 18px); max-width: 680px; margin: 0 auto; }
.apok-eyebrow {
	display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; border-radius: 999px;
	background: rgba(121,242,255,.08); border: 1px solid rgba(121,242,255,.22);
	font-size: 11.5px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
	color: var(--apok-accent); margin-bottom: 14px;
}

/* Intro */
.apok-intro {
	padding: clamp(40px, 5vw, 72px) 0 clamp(40px, 5vw, 64px);
	background: linear-gradient(180deg, rgba(255,255,255,.03), transparent);
	border-bottom: 1px solid rgba(255,255,255,.06);
}
.apok-intro-grid { display: grid; grid-template-columns: 1fr 340px; gap: 56px; align-items: center; }
.apok-intro-text { position: relative; padding-left: 20px; }
.apok-intro-text::before {
	content: ''; position: absolute; left: 0; top: 4px; bottom: 4px; width: 3px; border-radius: 2px;
	background: linear-gradient(180deg, var(--apok-accent), var(--apok-violet));
}
.apok-intro-text p { text-align: left !important; font-size: clamp(14.5px, 1.55vw, 16.5px); line-height: 1.8; }
.apok-intro-kpi { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.apok-kpi-card {
	padding: 20px 16px; border-radius: 16px;
	background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);
}
.apok-intro-kpi .apok-kpi-card { padding: 16px 14px; text-align: center; }
.apok-intro-kpi .apok-kpi-card strong { display: block; font-size: clamp(20px, 2.5vw, 26px); color: #fff; margin-bottom: 5px; }
.apok-intro-kpi .apok-kpi-card span { font-size: 11px; color: var(--apok-muted); line-height: 1.4; }
.apok-toc-outer { padding: 0 0 clamp(36px, 4.5vw, 56px); }
.apok-toc, .ym-toc.apok-toc { display: flex; flex-wrap: wrap; gap: 9px; justify-content: center; }
.apok-toc a, .ym-toc.apok-toc a {
	display: inline-block; padding: 9px 18px; background: rgba(255,255,255,.072);
	border: 1px solid var(--apok-border); border-radius: 999px;
	font-size: 13px; font-weight: 600; color: var(--apok-muted); transition: .2s;
}
.apok-toc a:hover, .ym-toc.apok-toc a:hover {
	border-color: rgba(121,242,255,.42); color: var(--apok-accent); background: rgba(121,242,255,.08);
}
@media (max-width: 900px) {
	.apok-intro-grid { grid-template-columns: 1fr; gap: 36px; }
	.apok-intro-kpi { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 600px) { .apok-intro-kpi { grid-template-columns: 1fr 1fr; } }

/* Grids & cards */
.apok-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.apok-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.apok-card {
	padding: 28px; border-radius: 20px; background: rgba(255,255,255,.05);
	border: 1px solid rgba(255,255,255,.1); transition: border-color .22s, transform .22s;
}
.apok-card:hover { border-color: rgba(121,242,255,.28); transform: translateY(-2px); }
.apok-card h3 { font-size: 17px; }
@media (max-width: 768px) { .apok-grid-2, .apok-grid-3 { grid-template-columns: 1fr; } }
@media (max-width: 960px) { .apok-grid-3 { grid-template-columns: 1fr 1fr; } }
@media (max-width: 600px) { .apok-grid-3 { grid-template-columns: 1fr; } }

.apok-kpi-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin: 16px 0; }
.apok-kpi { padding: 14px; border-radius: 14px; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.08); text-align: center; }
.apok-kpi strong { display: block; font-size: 24px; color: #fff; margin-bottom: 4px; }
.apok-kpi span { font-size: 12px; color: var(--apok-muted); }

.apok-table-wrap { overflow-x: auto; margin-top: 12px; }
.apok-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.apok-table th, .apok-table td { padding: 12px 14px; text-align: left; border-bottom: 1px solid rgba(255,255,255,.08); }
.apok-table th { color: var(--apok-soft); font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: .06em; }
.apok-table td { color: var(--apok-muted); }

.apok-tier-demo, .apok-tier-pills { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin: 24px 0; }
.apok-tier { padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; }
.apok-tier.low, .apok-tier-low { background: rgba(34,197,94,.12); color: #4ade80; border: 1px solid rgba(34,197,94,.25); }
.apok-tier.med, .apok-tier-med { background: rgba(234,179,8,.12); color: #facc15; border: 1px solid rgba(234,179,8,.25); }
.apok-tier.high, .apok-tier-high { background: rgba(249,115,22,.12); color: #fb923c; border: 1px solid rgba(249,115,22,.25); }
.apok-tier.crit, .apok-tier-crit { background: rgba(239,68,68,.12); color: #f87171; border: 1px solid rgba(239,68,68,.25); }

.apok-timeline { display: grid; gap: 20px; }
.apok-tl-item { position: relative; padding-left: 28px; border-left: 2px solid rgba(121,242,255,.25); }
.apok-tl-item h3 { font-size: 18px; margin-bottom: 8px; }
.apok-tl-dot { display: none; }

.apok-calc-wrap { margin-top: 36px; padding: 28px; border-radius: 22px; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1); }
.apok-calc-grid { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.1fr); gap: 28px; align-items: start; }
.apok-calc-controls label { display: block; margin-bottom: 18px; font-size: 14px; color: var(--apok-soft); }
.apok-calc-controls input[type="range"] { width: 100%; margin: 8px 0 4px; accent-color: var(--apok-accent); }
.apok-calc-controls output { display: block; font-size: 16px; font-weight: 700; color: #fff; }
.apok-calc-disclaimer { font-size: 12px; color: #64748b; margin-top: 8px; }
.apok-calc-kpi { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 16px; padding: 0; list-style: none; }
.apok-calc-kpi li { padding: 12px 14px; border-radius: 12px; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.08); }
.apok-calc-kpi li::before { display: none; }
.apok-calc-kpi span { display: block; font-size: 11px; color: #64748b; margin-bottom: 4px; }
.apok-calc-kpi strong { font-size: 17px; color: #fff; }
#apok-retention-calc-canvas { width: 100%; height: 220px; display: block; border-radius: 12px; background: rgba(0,0,0,.2); }
@media (max-width: 900px) { .apok-calc-grid { grid-template-columns: 1fr; } .apok-kpi-row { grid-template-columns: 1fr; } }

.apok-pricing-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
.apok-price-card { padding: 28px 22px; border-radius: 20px; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1); text-align: center; }
.apok-price-card.apok-featured { border-color: rgba(121,242,255,.35); background: linear-gradient(180deg, rgba(121,242,255,.08), rgba(255,255,255,.04)); }
.apok-price-card .tier { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--apok-accent); margin-bottom: 10px; }
.apok-price-card .amount { font-size: 28px; font-weight: 900; color: #fff; margin-bottom: 10px; }
.apok-price-card .inc { font-size: 13px; color: var(--apok-muted); }
@media (max-width: 768px) { .apok-pricing-grid { grid-template-columns: 1fr; } }

.apok-case-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.apok-case-card { padding: 24px; border-radius: 18px; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1); }
.apok-case-tag { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; background: rgba(121,242,255,.1); color: var(--apok-accent); margin-bottom: 10px; }
.apok-case-card h3 { font-size: 17px; margin-bottom: 8px; }
@media (max-width: 900px) { .apok-case-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 600px) { .apok-case-grid { grid-template-columns: 1fr; } }

.apok-faq { display: flex; flex-direction: column; gap: 10px; max-width: 820px; margin: 0 auto; }
.apok-faq-item { border-radius: 14px; background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08); overflow: hidden; }
.apok-faq-q {
	padding: 18px 48px 18px 22px; font-size: 16px; font-weight: 700; color: #fff; cursor: pointer; position: relative;
}
.apok-faq-q::after { content: '▼'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 10px; color: var(--apok-muted); transition: transform .2s; }
.apok-faq-item.open .apok-faq-q::after { transform: translateY(-50%) rotate(180deg); }
.apok-faq-a { max-height: 0; overflow: hidden; transition: max-height .3s ease; padding: 0 22px; }
.apok-faq-item.open .apok-faq-a { max-height: 400px; padding: 0 22px 18px; }
.apok-faq-a p { margin: 0; font-size: 14.5px; }

.apok-arch-note { text-align: center; margin-top: 28px; font-size: 14px; color: var(--apok-muted); }

.apok-cta-checklist {
	display: flex; flex-wrap: wrap; gap: 9px; justify-content: center; margin: 0 auto 28px;
	padding: 0; list-style: none; max-width: 720px;
}
.apok-cta-checklist li {
	display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px;
	background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); border-radius: 999px;
	font-size: 13px; color: var(--apok-muted);
}
.apok-cta-checklist li::before { content: '✓'; color: var(--apok-green); font-weight: 800; }

.ym-cta-block {
	border-radius: 20px; padding: 36px 40px; margin: 32px 0;
	background: linear-gradient(135deg, rgba(121,242,255,.12), rgba(139,92,246,.1));
	border: 1px solid rgba(121,242,255,.3); text-align: center;
}
.ym-cta-block--dual { background: linear-gradient(135deg, rgba(34,197,94,.1), rgba(121,242,255,.1)); border-color: rgba(34,197,94,.3); }
.ym-cta-block__icon { font-size: 36px; margin-bottom: 14px; }
.ym-cta-block__headline { font-size: clamp(20px, 2.8vw, 28px); font-weight: 800; color: #fff; margin: 0 0 10px; }
.ym-cta-block__sub { color: var(--apok-muted); font-size: 15px; margin: 0 auto 22px; max-width: 600px; line-height: 1.7; }
.ym-cta-block__actions { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
.ym-btn { display: inline-flex; align-items: center; justify-content: center; padding: 13px 28px; border-radius: 999px; font-size: 15px; font-weight: 700; text-decoration: none !important; transition: transform .2s; }
.ym-btn:hover { transform: translateY(-2px); }
.ym-btn--accent { background: linear-gradient(135deg, var(--apok-btn-from), var(--apok-btn-to)); color: #fff !important; box-shadow: 0 8px 32px rgba(59,130,246,.35); }
.ym-btn--ghost { background: rgba(255,255,255,.08); color: var(--apok-text) !important; border: 1.5px solid rgba(255,255,255,.18); }
.nero-ai-reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
@media (max-width: 600px) { .ym-cta-block { padding: 28px 20px; } }
</style>

<main id="primary" class="site-main nero-ai-home-page ai-predotvrashchenie-ottoka-klientov-page" role="main" tabindex="-1">
<section class="nero-ai-hero" id="hero" aria-labelledby="hero-apok-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html( $brand ); ?> · ai retention</p>
      <h1 id="hero-apok-title">AI-агент для предотвращения оттока клиентов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI находит признаки оттока и запускает сценарии удержания — пока клиент ещё не ушёл молча</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Churn ML</li>
        <li class="nero-ai-badge">Agentic AI</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">ROI</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url( $primary_cta_url ); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kalkulyator">Посчитать потери</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: retention risk board">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">retention · live</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title"><h3>AI risk board</h3><span class="nero-ai-live-pill">онлайн</span></div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Churn score</span><strong>78%</strong><small>High</small></div>
            <div class="nero-ai-metric"><span>Lead time</span><strong>21 дн.</strong><small>до отмены</small></div>
            <div class="nero-ai-metric"><span>Save rate</span><strong>41%</strong><small>at-risk</small></div>
            <div class="nero-ai-metric"><span>MRR risk</span><strong>−270K</strong><small>₽/мес</small></div>
          </div>
          <canvas id="apok-hero-retention-canvas" role="img" aria-label="Анимация: тихий отток — AI подсвечивает at-risk клиентов до отмены"></canvas>
          <div class="apok-hero-tier-pills" aria-hidden="true">
            <span class="low">Low</span><span class="med">Medium</span><span class="high">High</span><span class="crit">Critical</span>
          </div>
          <div class="nero-ai-task-stream">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">↓</span><div><strong>Сигнал</strong><span>логины −40%</span></div><span class="nero-ai-status">риск</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Playbook</strong><span>звонок CSM</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">→</span><div><strong>Действие</strong><span>задача в CRM</span></div><span class="nero-ai-status">запущено</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="apok-content">

<!-- Intro -->
<section class="apok-intro" id="intro" aria-label="Введение">
	<div class="apok-cnt">
		<div class="apok-intro-grid nero-ai-reveal">
			<div class="apok-intro-text">
				<p class="nero-ai-eyebrow"><?php echo esc_html( $brand ); ?> · ai retention</p>
				<p>Подписной бизнес живёт на удержании. Но в большинстве компаний отток становится виден только в момент отмены — когда клиент уже молча «ушёл в голове» задолго до клика «отписаться». <strong>AI предотвращение оттока</strong> в 2026 году — не ещё один отчёт по churn rate, а агент, который запускает сценарии удержания, пока подписка ещё активна.</p>
				<p>Nero Network внедряет такие системы под ключ: ML-скоринг риска, LLM-оркестрация действий и human-in-the-loop для VIP. Пилот — 4–8 недель, ориентир бюджета 200–650 тыс. ₽.</p>
			</div>
			<div class="apok-intro-kpi" aria-label="Ключевые метрики оттока">
				<div class="apok-kpi-card"><strong>3,8%</strong><span>B2B SaaS / мес</span></div>
				<div class="apok-kpi-card"><strong>6,5%</strong><span>B2C подписка</span></div>
				<div class="apok-kpi-card"><strong>7,8%</strong><span>EdTech / мес</span></div>
				<div class="apok-kpi-card"><strong>&lt;48 ч</strong><span>time-to-intervention</span></div>
			</div>
		</div>
	</div>
</section>

<div class="apok-toc-outer">
	<div class="apok-cnt">
		<nav class="ym-toc apok-toc" aria-label="Оглавление статьи">
			<a href="#bol">Боль</a>
			<a href="#reshenie">Решение</a>
			<a href="#dlya-kogo">Ниши</a>
			<a href="#etapy">Этапы</a>
			<a href="#kalkulyator">Калькулятор</a>
			<a href="#integracii">Интеграции</a>
			<a href="#ceny">Стоимость</a>
			<a href="#keisy">Кейсы</a>
			<a href="#faq">FAQ</a>
			<a href="#cta">Заявка</a>
		</nav>
	</div>
</div>

<section class="apok-section" id="bol">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Тихий отток</span>
			<h2>Клиенты уходят молча — менеджеры узнают об этом слишком поздно</h2>
			<p>Churn rate «в норме» по отчёту, а MRR падает. Подписчик перестал заходить в продукт, пропускает занятия, не открывает письма — но формально подписка ещё активна.</p>
		</div>
		<div class="apok-grid-2 nero-ai-reveal">
			<div class="apok-card">
				<h3>Сигналы оттока, которые команда пропускает</h3>
				<div class="apok-table-wrap">
					<table class="apok-table">
						<thead><tr><th>Категория</th><th>Сигнал</th></tr></thead>
						<tbody>
							<tr><td>Продукт</td><td>↓ логинов, ↓ ключевых фич, срыв онбординга</td></tr>
							<tr><td>Биллинг</td><td>Failed payment, downgrade, пауза подписки</td></tr>
							<tr><td>Поддержка</td><td>Рост тикетов, негатив, долгое SLA</td></tr>
							<tr><td>EdTech</td><td>Пропуски, ↓ домашних заданий, пауза модулей</td></tr>
							<tr><td>Фитнес</td><td>Пауза между визитами выше личного цикла</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="apok-card">
				<h3>Сколько стоит каждый потерянный подписчик</h3>
				<div class="apok-kpi-row">
					<div class="apok-kpi"><strong>3,8%</strong><span>B2B SaaS / мес</span></div>
					<div class="apok-kpi"><strong>6,5%</strong><span>B2C подписка</span></div>
					<div class="apok-kpi"><strong>7,8%</strong><span>EdTech / мес</span></div>
				</div>
				<p>Пример: 2 000 подписчиков × 5 000 ₽ ARPU при churn 5% — <strong>500 000 ₽ MRR</strong> теряется каждый месяц. Удержание 1 п.п. churn часто выгоднее сотни новых лидов.</p>
				<p><strong>Involuntary churn:</strong> 20–40% оттока — неуспешные платежи. Нужен dunning, не только «прогрев».</p>
			</div>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="reshenie">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Agentic AI 2026</span>
			<h2>AI предотвращение оттока: от анализа к автоматическим сценариям удержания</h2>
			<p>Не дашборд «на завтра». Трёхслойная система: ML-скоринг → LLM-агент с playbook → оркестрация в CRM и каналах с human-in-the-loop.</p>
		</div>
		<div class="apok-grid-3 nero-ai-reveal">
			<div class="apok-card"><h3>Предиктивный слой</h3><p>Daily churn score, SHAP-объяснения, tier Low / Medium / High / Critical.</p></div>
			<div class="apok-card"><h3>Агентный слой</h3><p>Выбор сценария, персональные тексты, задачи в CRM, эскалация CSM.</p></div>
			<div class="apok-card"><h3>Оркестрация</h3><p>Make/n8n, лимиты скидок, approval VIP, audit log действий агента.</p></div>
		</div>
		<div class="apok-tier-demo nero-ai-reveal" aria-label="Зоны риска">
			<span class="apok-tier low">Low</span><span class="apok-tier med">Medium</span>
			<span class="apok-tier high">High</span><span class="apok-tier crit">Critical</span>
		</div>
		<!-- INTERNAL-LINKS:INSERT -->
		<div class="apok-grid-2 nero-ai-reveal" style="margin-top:24px;">
			<div class="apok-card">
				<h3>Как AI-агент выявляет риск раньше отмены</h3>
				<p>Hourly/nightly пайплайн: last_login, feature_delta, payment_failures, ticket_sentiment, NPS. Горизонт 2–8 недель до отмены — типичный lead time в SaaS-кейсах.</p>
			</div>
			<div class="apok-card">
				<h3>Триггерные действия вместо отчётов</h3>
				<p><strong>Time-to-intervention</strong> — с 12 дней до &lt;48 часов (кейс Agentmelt). Агент приоритизирует очередь, менеджер звонит VIP и утверждает скидки.</p>
			</div>
		</div>
	</div>
</section>

<?php /* === БОРИС: блок вставлен после #reshenie — см. фрагмент boris.md === */ ?>
<section id="boris-retention-viz" class="brk-root" aria-label="Анимация: AI-агент запускает сценарии удержания по зонам риска">
<style>
#boris-retention-viz.brk-root { padding: 0 0 clamp(48px, 6vw, 72px); background: #f8fafc; }
#boris-retention-viz .brk-cnt { max-width: 1160px; margin: 0 auto; padding: 0 24px; }
#boris-retention-viz .brk-card {
	display: grid; grid-template-columns: minmax(0, 44%) minmax(0, 56%);
	border-radius: 22px; overflow: hidden;
	background: #fff;
	box-shadow: 0 10px 40px rgba(15,23,42,.08), 0 0 0 1px rgba(148,163,184,.18);
	min-height: 500px;
}
@media (max-width: 1023px) {
	#boris-retention-viz .brk-card { grid-template-columns: 1fr; min-height: auto; }
}
#boris-retention-viz .brk-lft {
	padding: 40px 36px; display: flex; flex-direction: column; justify-content: center;
	border-right: 1px solid #e2e8f0;
}
@media (max-width: 1023px) {
	#boris-retention-viz .brk-lft { border-right: none; border-bottom: 1px solid #e2e8f0; padding: 32px 24px; }
}
#boris-retention-viz .brk-ey {
	display: inline-flex; align-items: center; gap: 8px;
	font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase;
	color: #7c3aed; margin: 0 0 14px;
}
#boris-retention-viz .brk-ey::before { content: ''; width: 18px; height: 2px; background: #7c3aed; border-radius: 1px; }
#boris-retention-viz .brk-h3 {
	font-size: clamp(20px, 2.4vw, 26px); font-weight: 800; color: #0f172a;
	line-height: 1.28; margin: 0 0 18px;
}
#boris-retention-viz .brk-ul { list-style: none; margin: 0 0 22px; padding: 0; display: flex; flex-direction: column; gap: 9px; }
#boris-retention-viz .brk-ul li {
	display: flex; align-items: flex-start; gap: 10px;
	font-size: 14px; line-height: 1.5; color: #334155;
}
#boris-retention-viz .brk-ic {
	flex-shrink: 0; width: 22px; height: 22px; border-radius: 50%;
	background: rgba(124,58,237,.1); display: flex; align-items: center; justify-content: center;
	font-size: 11px; color: #6d28d9; margin-top: 1px; font-style: normal;
}
#boris-retention-viz .brk-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 18px; }
#boris-retention-viz .brk-pl {
	padding: 5px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; white-space: nowrap;
}
#boris-retention-viz .brk-pl-g { background: rgba(34,197,94,.08); color: #15803d; border: 1.5px solid rgba(34,197,94,.22); }
#boris-retention-viz .brk-pl-v { background: rgba(124,58,237,.08); color: #6d28d9; border: 1.5px solid rgba(124,58,237,.22); }
#boris-retention-viz .brk-pl-r { background: rgba(239,68,68,.08); color: #b91c1c; border: 1.5px solid rgba(239,68,68,.22); }
#boris-retention-viz .brk-foot { font-size: 13px; color: #64748b; font-style: italic; margin: 0; }
#boris-retention-viz .brk-rgt {
	position: relative;
	background: linear-gradient(145deg, #07091a 0%, #0d1224 55%, #090d1f 100%);
	min-height: 440px; overflow: hidden;
}
#boris-retention-playbook-canvas {
	position: absolute; inset: 0; width: 100%; height: 100%; display: block;
}
</style>
<div class="brk-cnt">
<div class="brk-card nero-ai-reveal">
	<div class="brk-lft">
		<span class="brk-ey">Agentic retention</span>
		<h3 class="brk-h3">От сигнала риска до действия за часы — не за двенадцать дней</h3>
		<ul class="brk-ul">
			<li><span class="brk-ic">⚡</span>ML присваивает churn_score и tier: Low → Critical</li>
			<li><span class="brk-ic">◎</span>LLM-агент читает контекст и выбирает playbook по отрасли</li>
			<li><span class="brk-ic">→</span>Запускает email, push, задачу в CRM или эскалацию менеджеру</li>
			<li><span class="brk-ic">✓</span>Human-in-the-loop для VIP, скидок и спорных решений</li>
		</ul>
		<div class="brk-pills">
			<span class="brk-pl brk-pl-r">12 дн. → &lt;48 ч</span>
			<span class="brk-pl brk-pl-g">save rate 41%</span>
			<span class="brk-pl brk-pl-v">audit trail</span>
		</div>
		<p class="brk-foot">Дальше — ниши и playbooks для SaaS, фитнеса и EdTech →</p>
	</div>
	<div class="brk-rgt">
		<canvas id="boris-retention-playbook-canvas" role="img" aria-label="Анимация: сигналы риска оттока превращаются в сценарии удержания через AI-агента"></canvas>
	</div>
</div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('boris-retention-playbook-canvas');
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

  var C = {
    cyan: '#79f2ff', viol: '#8b5cf6', green: '#4ade80', orange: '#fb923c', red: '#f87171',
    text: '#e2e8f0', muted: 'rgba(226,232,240,.45)', line: 'rgba(255,255,255,.08)',
    card: 'rgba(255,255,255,.06)', cardBdr: 'rgba(255,255,255,.12)'
  };

  var TIERS = [
    { label: 'Low', color: C.green, y: 0 },
    { label: 'Med', color: C.orange, y: 0 },
    { label: 'High', color: '#f97316', y: 0 },
    { label: 'Crit', color: C.red, y: 0 }
  ];

  var ACTIONS = [
    { label: 'Email', icon: '✉', x: 0 },
    { label: 'Push', icon: '◉', x: 0 },
    { label: 'CRM', icon: '▣', x: 0 },
    { label: 'Звонок', icon: '☎', x: 0 }
  ];

  var signals = [];
  for (var i = 0; i < 8; i++) {
    signals.push({ tier: Math.floor(Math.random() * 4), t: Math.random() * 200, speed: 0.6 + Math.random() * 0.8, action: Math.floor(Math.random() * 4) });
  }

  function rr(x, y, w, h, r, fill, stroke) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    if (fill) { ctx.fillStyle = fill; ctx.fill(); }
    if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.5; ctx.stroke(); }
  }

  function drawHeader() {
    ctx.fillStyle = C.text;
    ctx.font = 'bold 13px Inter,sans-serif';
    ctx.fillText('retention agent · playbook', 18, 28);
    ctx.fillStyle = C.muted;
    ctx.font = '11px Inter,sans-serif';
    ctx.fillText('скор → сценарий → канал', 18, 44);
  }

  function drawTiers() {
    var top = 64, h = (H - top - 100) / 4;
    TIERS.forEach(function(t, i) {
      t.y = top + i * h + h * 0.5;
      rr(16, top + i * h + 6, W * 0.28, h - 12, 10, C.card, C.cardBdr);
      ctx.fillStyle = t.color;
      ctx.font = 'bold 11px Inter,sans-serif';
      ctx.fillText(t.label, 28, t.y - 4);
      ctx.fillStyle = C.muted;
      ctx.font = '10px Inter,sans-serif';
      var hints = ['логины OK', '↓ активность', 'failed pay', 'тикет + churn'];
      ctx.fillText(hints[i], 28, t.y + 12);
    });
  }

  function drawActions() {
    var ax = W * 0.72, aw = W * 0.22;
    ACTIONS.forEach(function(a, i) {
      a.x = ax + aw * 0.5;
      var ay = 90 + i * ((H - 180) / 4);
      rr(ax, ay - 22, aw, 44, 12, C.card, C.cardBdr);
      ctx.fillStyle = C.cyan;
      ctx.font = '14px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(a.icon, a.x - 20, ay + 5);
      ctx.fillStyle = C.text;
      ctx.font = '11px Inter,sans-serif';
      ctx.fillText(a.label, a.x + 8, ay + 5);
      ctx.textAlign = 'left';
    });
  }

  function drawAgent() {
    var cx = W * 0.52, cy = H * 0.5, pulse = 0.5 + 0.5 * Math.sin(frame * 0.06);
    ctx.strokeStyle = 'rgba(139,92,246,' + (0.2 + pulse * 0.3) + ')';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(cx, cy, 36 + pulse * 6, 0, Math.PI * 2);
    ctx.stroke();
    rr(cx - 40, cy - 28, 80, 56, 14, 'rgba(139,92,246,.18)', 'rgba(139,92,246,.45)');
    ctx.fillStyle = C.viol;
    ctx.font = 'bold 12px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI agent', cx, cy - 4);
    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.fillText('playbook', cx, cy + 12);
    ctx.textAlign = 'left';
    return { x: cx, y: cy };
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, W, H);
    drawHeader();
    drawTiers();
    var agent = drawAgent();
    drawActions();

    signals.forEach(function(s) {
      s.t += s.speed;
      if (s.t > 280) { s.t = 0; s.tier = Math.floor(Math.random() * 4); s.action = Math.floor(Math.random() * 4); }
      var sy = TIERS[s.tier].y;
      var prog = Math.min(1, s.t / 140);
      var sx = 16 + W * 0.28 * prog * 0.9;
      var mx = agent.x - 20 + (ACTIONS[s.action].x - agent.x) * Math.max(0, (s.t - 140) / 140);
      var my = sy + (ACTIONS[s.action].x ? (90 + s.action * ((H - 180) / 4) - sy) * Math.max(0, (s.t - 140) / 140) : 0);
      if (s.t < 140) {
        ctx.strokeStyle = TIERS[s.tier].color + '88';
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(40, sy);
        ctx.lineTo(sx, sy);
        ctx.stroke();
        ctx.fillStyle = TIERS[s.tier].color;
        ctx.beginPath();
        ctx.arc(sx, sy, 5, 0, Math.PI * 2);
        ctx.fill();
      } else {
        ctx.strokeStyle = C.cyan + '66';
        ctx.setLineDash([4, 4]);
        ctx.beginPath();
        ctx.moveTo(agent.x, agent.y);
        ctx.lineTo(mx, my);
        ctx.stroke();
        ctx.setLineDash([]);
      }
    });

    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

<section class="apok-section" id="dlya-kogo">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Подписной бизнес</span>
			<h2>Внедрение AI-агента для удержания клиентов в подписном бизнесе</h2>
			<p>Playbooks по отрасли — не абстрактный «бизнес». Сигналы, каналы и офферы различаются.</p>
		</div>
		<div class="apok-grid-2 nero-ai-reveal">
			<div class="apok-card"><h3>SaaS и B2B-сервисы</h3><p>Usage, seats, health score. Amplitude + Stripe + CRM. Save play: exec email, CSM-звонок. Mindra: 41% at-risk удержаны.</p></div>
			<div class="apok-card"><h3>Фитнес-клубы и студии</h3><p>Пауза между визитами vs цикл клиента. YCLIENTS, Telegram. LTV Booster: прогноз 2–4 нед.</p></div>
			<div class="apok-card"><h3>Онлайн-школы и EdTech</h3><p>Посещаемость, ДЗ, модули. BigBen: зоны зелёная / жёлтая / красная, горизонт 30–60 дней.</p></div>
			<div class="apok-card"><h3>Рекуррентные сервисы</h3><p>Контент, доставка, членство — от нескольких сотен подписчиков при дисциплине данных. Пилот от 200 тыс. ₽.</p></div>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="etapy">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Внедрение под ключ</span>
			<h2>Как внедрить AI предотвращение оттока: от диагностики до запуска сценариев</h2>
		</div>
		<div class="apok-card nero-ai-reveal">
			<div class="apok-timeline">
				<div class="apok-tl-item"><h3>Шаг 1 — сбор сигналов</h3><p>CRM, биллинг, продукт, поддержка. Коннекторы 1–2 нед. История 6–12 мес.</p></div>
				<div class="apok-tl-item"><h3>Шаг 2 — скоринг и сегментация</h3><p>ML 2–3 нед., daily score, SHAP в CRM. Сегмент «на грани ухода».</p></div>
				<div class="apok-tl-item"><h3>Шаг 3 — автоматические сценарии</h3><p>LLM-агент, email/push/звонок. Make/n8n, A/B, лимиты скидок.</p></div>
				<div class="apok-tl-item"><h3>Шаг 4 — замер retention</h3><p>Пилот 4–6 нед., save rate vs контроль, переобучение модели.</p></div>
			</div>
		</div>
	</div>
</section>

<section class="apok-section" id="kalkulyator">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Лид-магнит</span>
			<h2>Калькулятор риска оттока: посчитайте потери до внедрения AI</h2>
			<p>Диагностика риска оттока в ₽ — аргумент сильнее абстрактного «снизим churn».</p>
		</div>
		<div class="apok-grid-2 nero-ai-reveal">
			<div class="apok-card">
				<h3>Какие данные нужны</h3>
				<ul>
					<li>Активных подписчиков (N)</li>
					<li>Средний MRR / ARPU (₽)</li>
					<li>Monthly churn (%)</li>
					<li>Ожидаемое снижение churn после AI (10–20%)</li>
					<li>Бюджет внедрения (200–650 тыс. ₽)</li>
				</ul>
			</div>
			<div class="apok-card">
				<h3>Что покажет диагностика</h3>
				<p>MRR сейчас, потери в месяц, удержано в год, ROI первого года. На аудите уточним involuntary churn и сегменты.</p>
			</div>
		</div>
		<div class="apok-calc-wrap nero-ai-reveal" id="apok-retention-calculator">
			<div class="apok-calc-grid">
				<div class="apok-calc-controls" aria-label="Параметры расчёта">
					<label>Подписчиков (N)<input type="range" id="apok-calc-n" min="500" max="10000" step="100" value="1500"><output id="apok-calc-n-out">1500</output></label>
					<label>ARPU, ₽<input type="range" id="apok-calc-arpu" min="500" max="50000" step="500" value="3000"><output id="apok-calc-arpu-out">3 000</output></label>
					<label>Monthly churn, %<input type="range" id="apok-calc-churn" min="1" max="15" step="0.1" value="6"><output id="apok-calc-churn-out">6%</output></label>
					<label>Снижение churn после AI, %<input type="range" id="apok-calc-effect" min="5" max="30" step="1" value="15"><output id="apok-calc-effect-out">15%</output></label>
					<label>Бюджет внедрения, ₽<input type="range" id="apok-calc-cost" min="200000" max="650000" step="10000" value="400000"><output id="apok-calc-cost-out">400 000</output></label>
					<p class="apok-calc-disclaimer">Расчёт оценочный. На аудите Nero Network уточним по вашей базе, сегментам и involuntary churn.</p>
				</div>
				<div class="apok-calc-results">
					<canvas id="apok-retention-calc-canvas" role="img" aria-label="График: потери MRR до и после внедрения AI-удержания"></canvas>
					<ul class="apok-calc-kpi">
						<li><span>MRR сейчас</span><strong id="apok-kpi-mrr">—</strong></li>
						<li><span>Потери / мес</span><strong id="apok-kpi-loss">—</strong></li>
						<li><span>Удержано / год</span><strong id="apok-kpi-saved">—</strong></li>
						<li><span>ROI 1-й год</span><strong id="apok-kpi-roi">—</strong></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-kalkulyator">
			<div class="ym-cta-block__icon" aria-hidden="true">📊</div>
			<div class="ym-cta-block__body">
				<p class="ym-cta-block__headline">Увидели цифры? Закажите диагностику риска оттока</p>
				<p class="ym-cta-block__sub">Nero Network проверит CRM, биллинг и продуктовую аналитику — покажем реальный churn, «тихий отток» и план пилота с ROI.</p>
				<a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="integracii">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Данные → действие</span>
			<h2>AI предотвращение оттока: интеграция с CRM, биллингом и каналами связи</h2>
			<p>Без CRM, биллинга и продуктовой аналитики агент не видит «тихий отток».</p>
		</div>
		<div class="apok-grid-3 nero-ai-reveal">
			<div class="apok-card"><h3>CRM</h3><p>amoCRM, Bitrix24, RetailCRM, YCLIENTS — risk score, задачи, timeline, audit log.</p></div>
			<div class="apok-card"><h3>Биллинг</h3><p>ЮKassa, CloudPayments, Stripe — failed payments, dunning, downgrade.</p></div>
			<div class="apok-card"><h3>Каналы</h3><p>Email, push, Telegram, Amplitude, Metrika, Make/n8n.</p></div>
		</div>
		<p class="apok-arch-note nero-ai-reveal"><strong>Архитектура:</strong> источники → ML-скоринг → AI-агент → каналы → человек (approval) → замер и переобучение.</p>
	</div>
</section>

<section class="apok-section" id="vnedrenie">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Под ключ</span>
			<h2>Внедрение AI-агентов под ключ: сроки, этапы и результат</h2>
		</div>
		<div class="apok-table-wrap nero-ai-reveal">
			<table class="apok-table">
				<thead><tr><th>Этап</th><th>Содержание</th><th>Срок</th></tr></thead>
				<tbody>
					<tr><td>Диагностика</td><td>Аудит данных, baseline churn, карта «сигнал → действие»</td><td>3–5 дней</td></tr>
					<tr><td>Data layer</td><td>Коннекторы CRM, биллинг, аналитика</td><td>1–2 нед.</td></tr>
					<tr><td>Churn model</td><td>Обучение, daily score, SHAP</td><td>2–3 нед.</td></tr>
					<tr><td>Agent layer</td><td>LLM-агент, playbooks, governance</td><td>1–2 нед.</td></tr>
					<tr><td>Пилот</td><td>2–3 сегмента, A/B, ROI</td><td>4–6 нед.</td></tr>
				</tbody>
			</table>
		</div>
		<div class="apok-grid-2 nero-ai-reveal" style="margin-top:24px;">
			<div class="apok-card"><h3>Без программиста на стороне клиента</h3><p>Доступы к CRM/биллингу, бизнес-правила, участие CSM в approval. Интеграции — на Nero Network.</p></div>
			<div class="apok-card"><h3>Заказать разработку</h3><p>Заявка на диагностику риска → архитектура и смета пилота. CTA: <strong>Снизить отток</strong>.</p></div>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="ceny">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Коммерция</span>
			<h2>Сколько стоит AI предотвращение оттока для компании</h2>
		</div>
		<div class="apok-pricing-grid nero-ai-reveal">
			<div class="apok-price-card"><div class="tier">Пилот</div><div class="amount">от 200 тыс. ₽</div><div class="inc">1–2 интеграции, 2 сценария</div></div>
			<div class="apok-price-card apok-featured"><div class="tier">Стандарт</div><div class="amount">350–450 тыс. ₽</div><div class="inc">CRM + биллинг + 3 playbooks</div></div>
			<div class="apok-price-card"><div class="tier">Омниканал</div><div class="amount">до 650 тыс. ₽</div><div class="inc">Несколько сегментов, governance</div></div>
		</div>
		<div class="apok-grid-2 nero-ai-reveal" style="margin-top:24px;">
			<div class="apok-card"><h3>От чего зависит цена</h3><p>Число источников, качество данных, каналы, LLM-контур (YandexGPT vs OpenAI), approval и поддержка после пилота.</p></div>
			<div class="apok-card"><h3>ROI: удержание vs привлечение</h3><p>Save play на базе дешевле нового CAC. Калькулятор + A/B на пилоте. AXI Studio: −41% net revenue churn за 90 дней.</p></div>
		</div>
	</div>
</section>

<section class="apok-section" id="keisy">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Proof</span>
			<h2>Примеры внедрения AI для удержания клиентов и возврата подписчиков</h2>
		</div>
		<div class="apok-case-grid nero-ai-reveal">
			<div class="apok-case-card"><div class="apok-case-tag">SaaS</div><h3>Mindra · 940 аккаунтов</h3><p>Lead time ~3 нед. до отмены. 41% at-risk удержаны.</p></div>
			<div class="apok-case-card"><div class="apok-case-tag">B2B SaaS</div><h3>AXI Studio</h3><p>Net revenue churn 11% → 6,5% (−41%) за 90 дней.</p></div>
			<div class="apok-case-card"><div class="apok-case-tag">Ритейл</div><h3>Цезарь Сателлит</h3><p>Отток 24% → 17% в A/B. ROC-AUC 0,84.</p></div>
			<div class="apok-case-card"><div class="apok-case-tag">EdTech</div><h3>BigBen CRM</h3><p>400+ школ, зоны риска, горизонт 30–60 дней.</p></div>
			<div class="apok-case-card"><div class="apok-case-tag">Фитнес</div><h3>Раменский деликатес</h3><p>Тихий отток, точность прогноза 81%.</p></div>
			<div class="apok-case-card"><div class="apok-case-tag">Win-back</div><h3>AI возврат подписчиков</h3><p>Uplift: скидка только тем, кому она влияет на удержание.</p></div>
		</div>
		<div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-keisy">
			<div class="ym-cta-block__body">
				<p class="ym-cta-block__headline">Хотите такого же save rate на своей базе?</p>
				<p class="ym-cta-block__sub">Mindra удержала 41% at-risk аккаунтов, «Цезарь Сателлит» снизил отток с 24% до 17%. Следующий шаг — аудит ваших данных и playbooks под SaaS, фитнес или EdTech.</p>
				<div class="ym-cta-block__actions">
					<a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
					<?php if ( $secondary_cta_url ) : ?>
					<a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost"<?php echo $secondary_cta_attrs; ?>><?php echo esc_html( $secondary_cta_label ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="faq">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">FAQ</span>
			<h2>Частые вопросы об AI-удержании клиентов</h2>
		</div>
		<div class="apok-faq nero-ai-reveal">
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">Чем AI-агент отличается от аналитики churn?</div><div class="apok-faq-a"><p>Аналитика показывает метрики. Агент выполняет действие: задача, письмо, эскалация — с audit log.</p></div></div>
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">Можно без своей разработки?</div><div class="apok-faq-a"><p>Да. Nero Network — data layer, модель, агент, Make/n8n. Клиент даёт доступы и правила скидок.</p></div></div>
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">Какие метрики после запуска?</div><div class="apok-faq-a"><p>Churn gross/net, save rate, time-to-intervention, удержанный MRR, involuntary vs voluntary, ROI пилота.</p></div></div>
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">Как быстро окупается?</div><div class="apok-faq-a"><p>Ориентиры: 3–12 месяцев в зависимости от базы. Калькулятор — первичная оценка.</p></div></div>
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">Мало данных — можно начать?</div><div class="apok-faq-a"><p>От нескольких сотен клиентов и 6+ мес. истории. Иначе — этап сбора данных 3–6 мес.</p></div></div>
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">Mindbox уже есть — зачем агент?</div><div class="apok-faq-a"><p>CDP даёт сегмент. Агент — приоритет, канал, текст, эскалация и лимиты автономии.</p></div></div>
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">AI отошлёт скидку всем?</div><div class="apok-faq-a"><p>Нет. Human-in-the-loop, uplift-логика, лимиты для VIP и Enterprise.</p></div></div>
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">amoCRM / Bitrix24?</div><div class="apok-faq-a"><p>Типовые интеграции: виджет риска, автозадачи, timeline.</p></div></div>
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">152-ФЗ и безопасность?</div><div class="apok-faq-a"><p>РФ-контур, YandexGPT при необходимости, audit log, лимиты автономии агента.</p></div></div>
			<div class="apok-faq-item"><div class="apok-faq-q" tabindex="0" role="button" aria-expanded="false">Для малого бизнеса?</div><div class="apok-faq-a"><p>От нескольких сотен подписчиков с CRM и биллингом. Узкий пилот от 200 тыс. ₽.</p></div></div>
		</div>
	</div>
</section>

<section class="apok-section" id="cta">
	<div class="apok-cnt" style="text-align:center;">
		<span class="apok-eyebrow">Диагностика риска оттока</span>
		<h2>Снизить отток: закажите план внедрения AI-агента</h2>
		<p style="max-width:580px;margin:0 auto 28px;">ML-скоринг + LLM-агент + playbooks по отрасли. Пилот 4–8 недель, ориентир 200–650 тыс. ₽. Не дашборд — действие за час, не за двенадцать дней.</p>
		<ul class="apok-cta-checklist">
			<li>Аудит CRM и биллинга</li>
			<li>Retention-калькулятор по вашим данным</li>
			<li>Governance и human-in-the-loop</li>
			<li>Без программиста на стороне клиента</li>
		</ul>
		<a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
	</div>
</section>

</div><!-- .apok-content -->

<!-- INTERNAL-LINKS:INSERT -->

<!-- SCHEMA-MARKUP:INSERT -->

<script>
(function(){
'use strict';
document.addEventListener('DOMContentLoaded', function(){
  var canvas = document.getElementById('apok-hero-retention-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var cw, ch, cx, cy, scale, frame = 0;

  function resize(){
    if (!canvas.parentElement) return;
    cw = canvas.parentElement.clientWidth || 400;
    ch = 140;
    canvas.width = cw; canvas.height = ch;
    cx = cw * 0.52; cy = ch * 0.55;
    scale = Math.min(cw / 420, ch / 140) * 1.1;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    outline: '#e2e8f0',
    consoleBg: '#0f172a', consoleAccent: '#79f2ff', consoleViolet: '#8b5cf6',
    nodeActive: '#22c55e', nodeDim: '#475569', nodeRisk: '#ef4444', nodeWarn: '#f97316',
    beam: '#79f2ff', pulse: '#22c55e',
    agentYellow: '#eab308', agentGreen: '#10b981', agentBlue: '#3b82f6',
    agentPink: '#ec4899', agentPurple: '#8b5cf6',
    bubbleBg: '#1e293b', bubbleText: '#e6edf7'
  };

  function rr(ctx, x, y, w, h, r, fill, stroke){
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke){ ctx.lineWidth = 1.5; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  /* Центральный объект — пульт риска (не WebsiteTerminal) */
  class ChurnRiskConsole {
    constructor(x, y){ this.x = x; this.y = y; this.pulse = 0; this.score = 0; }
    draw(ctx){
      var cycle = (frame * 0.04) % 240;
      this.score = cycle < 80 ? 42 : (cycle < 140 ? 68 : (cycle < 200 ? 78 : 52));
      this.pulse = Math.sin(frame * 0.08) * 3;
      var w = 88, h = 56;
      rr(ctx, this.x - w/2, this.y - h/2, w, h, 8, C.consoleBg, C.consoleAccent);
      rr(ctx, this.x - w/2 + 6, this.y - h/2 + 6, w - 12, 14, 4, '#1e293b', null);
      ctx.fillStyle = C.consoleAccent;
      ctx.font = 'bold 9px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText('CHURN ' + this.score + '%', this.x, this.y - 4);
      var barW = (w - 20) * (this.score / 100);
      rr(ctx, this.x - (w-20)/2, this.y + 8, barW, 6, 3,
        this.score > 70 ? C.nodeRisk : (this.score > 55 ? C.nodeWarn : C.nodeActive), null);
      if (cycle > 140 && cycle < 210){
        ctx.strokeStyle = C.pulse;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(this.x, this.y, 34 + this.pulse, 0, Math.PI * 2);
        ctx.globalAlpha = 0.35;
        ctx.stroke();
        ctx.globalAlpha = 1;
      }
    }
  }

  /* Поток сигналов по кривым (не Conveyor) */
  class SignalRiver {
    constructor(){ this.paths = []; }
    init(nodes, console){
      this.paths = nodes.map(function(n, i){
        return { from: n, t: i * 0.33, speed: 0.015 + i * 0.004 };
      });
      this.console = console;
    }
    draw(ctx){
      var cycle = (frame * 0.04) % 240;
      this.paths.forEach(function(p){
        p.t = (p.t + p.speed) % 1;
        if (cycle < 60) return;
        var fx = p.from.x, fy = p.from.y;
        var tx = this.console.x, ty = this.console.y;
        var mx = (fx + tx) / 2 + Math.sin(frame * 0.05 + p.t * 6) * 12;
        var my = (fy + ty) / 2 - 18;
        var px = fx + (tx - fx) * p.t + (mx - fx) * Math.sin(p.t * Math.PI) * 0.3;
        var py = fy + (ty - fy) * p.t + (my - fy) * Math.sin(p.t * Math.PI) * 0.3;
        ctx.fillStyle = p.from.dim > 0.5 ? C.nodeWarn : C.beam;
        ctx.globalAlpha = 0.7;
        ctx.beginPath(); ctx.arc(px, py, 3, 0, Math.PI * 2); ctx.fill();
        ctx.globalAlpha = 1;
      }, this);
    }
  }

  class ClientOrbitNode {
    constructor(angle, radius, id){
      this.angle = angle; this.radius = radius; this.id = id;
      this.dim = id === 2 || id === 4 ? 0.85 : 0.15;
      this.saved = false;
    }
    update(cycle){
      this.angle += 0.008 + this.id * 0.002;
      if (cycle > 140 && cycle < 220 && (this.id === 2 || this.id === 4)){
        this.dim = Math.max(0, this.dim - 0.02);
        if (cycle > 200) this.saved = true;
      } else if (cycle < 80) { this.dim = this.id === 2 || this.id === 4 ? 0.85 : 0.15; this.saved = false; }
    }
    draw(ctx, cx, cy){
      var x = cx + Math.cos(this.angle) * this.radius;
      var y = cy + Math.sin(this.angle) * this.radius * 0.55;
      this.x = x; this.y = y;
      var col = this.saved ? C.nodeActive : (this.dim > 0.6 ? C.nodeRisk : C.nodeActive);
      ctx.globalAlpha = 1 - this.dim * 0.65;
      ctx.fillStyle = col;
      ctx.beginPath(); ctx.arc(x, y, 7, 0, Math.PI * 2); ctx.fill();
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1; ctx.stroke();
      ctx.globalAlpha = 1;
    }
  }

  class RetentionBeam {
    draw(ctx, fromX, fromY, toX, toY, alpha){
      ctx.save();
      ctx.globalAlpha = alpha;
      ctx.strokeStyle = C.pulse;
      ctx.lineWidth = 2;
      ctx.setLineDash([4, 4]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath(); ctx.moveTo(fromX, fromY); ctx.lineTo(toX, toY); ctx.stroke();
      ctx.restore();
    }
  }

  var console = new ChurnRiskConsole(0, 0);
  var nodes = [
    new ClientOrbitNode(0.2, 70, 0),
    new ClientOrbitNode(1.4, 85, 1),
    new ClientOrbitNode(2.8, 72, 2),
    new ClientOrbitNode(4.1, 90, 3),
    new ClientOrbitNode(5.5, 68, 4)
  ];
  var river = new SignalRiver();
  river.init(nodes, console);
  var beam = new RetentionBeam();
  var bubbles = [];

  function createBubble(x, y, text, life){
    bubbles.push({ x: x, y: y, text: text, life: life || 180, max: life || 180 });
  }

  function drawAgent(ctx, ax, ay, color, bob){
    rr(ctx, ax - 8, ay - 6 + bob, 16, 12, 4, color, C.outline);
    ctx.fillStyle = color;
    ctx.beginPath(); ctx.arc(ax, ay - 10 + bob, 7, 0, Math.PI * 2); ctx.fill();
    ctx.strokeStyle = C.outline; ctx.stroke();
  }

  var agents = [
    { baseX: -95, baseY: 28, color: C.agentYellow, trig: 90, dx: [ 'Сигнал: логины', 'Собираю фичи', 'Данные в модель' ] },
    { baseX: -70, baseY: -22, color: C.agentGreen, trig: 110, dx: [ 'Score 78%', 'SHAP: платёж', 'Tier: High' ] },
    { baseX: 95, baseY: 30, color: C.agentBlue, trig: 130, dx: [ 'Playbook CSM', 'Письмо готово', 'Push в очередь' ] },
    { baseX: 75, baseY: -25, color: C.agentPink, trig: 150, dx: [ 'Задача CRM', 'Make запущен', 'SLA 2 ч' ] },
    { baseX: -40, baseY: 38, color: C.agentPurple, trig: 170, dx: [ 'VIP approve', 'Лимит скидки', 'Save pulse!' ] }
  ];

  function loop(){
    frame++;
    var cycle = (frame * 0.04) % 240;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    nodes.forEach(function(n){ n.update(cycle); n.draw(ctx, 0, 0); });
    console.draw(ctx);
    river.draw(ctx);

    if (cycle > 155 && cycle < 215){
      nodes.forEach(function(n){
        if (n.id === 2 || n.id === 4) beam.draw(ctx, n.x, n.y, 0, 0, 0.5 + Math.sin(frame * 0.1) * 0.3);
      });
    }

    agents.forEach(function(a){
      var prg = cycle;
      var active = prg >= a.trig && prg < a.trig + 35;
      var ax = a.baseX, ay = a.baseY;
      if (active){
        var local = prg - a.trig;
        var tx = 0, ty = -8;
        if (local < 12) { ax = a.baseX + (tx - a.baseX) * (local / 12); ay = a.baseY + (ty - a.baseY) * (local / 12); }
        else if (local < 22) { ax = tx; ay = ty; }
        else { ax = tx - (tx - a.baseX) * ((local - 22) / 10); ay = ty - (ty - a.baseY) * ((local - 22) / 10); }
      }
      var bob = Math.sin(frame * 0.06 + a.baseX) * 1.5;
      drawAgent(ctx, ax, ay, a.color, bob);
      if (frame % 220 === 0 && Math.random() < 0.15){
        createBubble(ax, ay - 18, a.dx[Math.floor(Math.random() * a.dx.length)]);
      }
    });

    if (cycle >= 92 && cycle < 92.5) createBubble(-95, 10, '1. Скан орбиты');
    if (cycle >= 112 && cycle < 112.5) createBubble(-70, -30, '2. Churn score');
    if (cycle >= 132 && cycle < 132.5) createBubble(95, 12, '3. Playbook');
    if (cycle >= 152 && cycle < 152.5) createBubble(75, -32, '4. CRM задача');
    if (cycle >= 205 && cycle < 205.5) createBubble(0, -45, '5. Клиент удержан!');

    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'center';
    for (var i = bubbles.length - 1; i >= 0; i--){
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0){ bubbles.splice(i, 1); continue; }
      var al = Math.min(1, b.life / 25);
      ctx.globalAlpha = al;
      var tw = ctx.measureText(b.text).width + 14;
      rr(ctx, b.x - tw/2, b.y - 16, tw, 18, 6, C.bubbleBg, C.consoleAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 7);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(loop);
  }
  if (document.fonts && document.fonts.ready) document.fonts.ready.then(loop);
  else loop();
});
})();
</script>

<script>
(function(){
  'use strict';
  var nEl = document.getElementById('apok-calc-n'), aEl = document.getElementById('apok-calc-arpu'),
      cEl = document.getElementById('apok-calc-churn'), eEl = document.getElementById('apok-calc-effect'),
      costEl = document.getElementById('apok-calc-cost'), cv = document.getElementById('apok-retention-calc-canvas');
  if (!nEl || !cv) return;
  var ctx = cv.getContext('2d');
  function fmt(n){ return new Intl.NumberFormat('ru-RU').format(Math.round(n)); }
  function read(){
    return { n: +nEl.value, arpu: +aEl.value, churn: +cEl.value / 100, effect: +eEl.value / 100, cost: +costEl.value };
  }
  function resize(){
    var w = cv.parentElement ? cv.parentElement.clientWidth : 400;
    cv.width = w; cv.height = Math.min(220, w * 0.55);
  }
  function draw(bars, labels){
    resize();
    var w = cv.width, h = cv.height, p = 24, g = (w - p * 2) / bars.length, max = Math.max.apply(null, bars) * 1.15 || 1;
    ctx.clearRect(0, 0, w, h);
    bars.forEach(function(v, i){
      var bh = (v / max) * (h - p * 2), x = p + i * g + g * 0.15, bw = g * 0.7;
      var grd = ctx.createLinearGradient(0, h - bh, 0, h);
      grd.addColorStop(0, i === 2 ? '#22c55e' : '#79f2ff');
      grd.addColorStop(1, '#8b5cf6');
      ctx.fillStyle = grd;
      ctx.fillRect(x, h - p - bh, bw, bh);
      ctx.fillStyle = '#9aa8bd';
      ctx.font = '11px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(labels[i], x + bw / 2, h - 6);
    });
  }
  function recalc(){
    var d = read();
    document.getElementById('apok-calc-n-out').textContent = fmt(d.n);
    document.getElementById('apok-calc-arpu-out').textContent = fmt(d.arpu);
    document.getElementById('apok-calc-churn-out').textContent = (d.churn * 100).toFixed(1) + '%';
    document.getElementById('apok-calc-effect-out').textContent = Math.round(d.effect * 100) + '%';
    document.getElementById('apok-calc-cost-out').textContent = fmt(d.cost);
    var mrr = d.n * d.arpu, loss = mrr * d.churn, churnAfter = d.churn * (1 - d.effect), lossAfter = mrr * churnAfter;
    var savedYear = (loss - lossAfter) * 12, roi = d.cost > 0 ? ((savedYear - d.cost) / d.cost * 100) : 0;
    document.getElementById('apok-kpi-mrr').textContent = fmt(mrr) + ' ₽';
    document.getElementById('apok-kpi-loss').textContent = fmt(loss) + ' ₽';
    document.getElementById('apok-kpi-saved').textContent = fmt(savedYear) + ' ₽';
    document.getElementById('apok-kpi-roi').textContent = (roi >= 0 ? '+' : '') + Math.round(roi) + '%';
    draw([loss, lossAfter, savedYear / 12], ['Потери', 'После AI', 'Удерж./мес']);
  }
  [nEl, aEl, cEl, eEl, costEl].forEach(function(el){ el.addEventListener('input', recalc); });
  window.addEventListener('resize', recalc);
  recalc();
})();
</script>

<script>
(function(){
  document.querySelectorAll('.apok-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.apok-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.apok-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.apok-faq-q');
        if (q) q.setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) { item.classList.add('open'); btn.setAttribute('aria-expanded', 'true'); }
    });
    btn.addEventListener('keydown', function(e){
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
    });
  });
})();
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.apok-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if (entry.isIntersecting) {
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function(item){ observer.observe(item); });
  } else {
    items.forEach(function(item){ item.classList.add('nero-ai-active'); });
  }
  var heroItems = document.querySelectorAll('#hero .nero-ai-reveal');
  heroItems.forEach(function(item){ item.classList.add('nero-ai-active'); });
})();
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
