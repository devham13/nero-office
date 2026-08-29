<?php
/**
 * Template Name: AI для продавцов Wildberries и Ozon: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI для маркетплейсов WB/Ozon. Карточки, отзывы, цены, остатки.
 */

$page_seo_title       = 'AI для Wildberries и Ozon: внедрение под ключ для селлеров';
$page_seo_description = 'Внедрение AI для маркетплейсов Wildberries и Ozon: карточки, отзывы, цены, остатки и реклама без ручного контроля. AI-агенты для селлеров по тренду продаж 2026. Проверить магазин.';

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
	['label' => 'Зачем AI',  'href' => '#zachem-ai'],
	['label' => '8 модулей', 'href' => '#zadachi'],
	['label' => 'WB и Ozon', 'href' => '#wildberries'],
	['label' => 'Внедрение', 'href' => '#vnedrenie'],
	['label' => 'Кейсы',     'href' => '#keisy'],
	['label' => 'FAQ',       'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
	$nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить магазин';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = '8 модулей AI';
$secondary_cta_url   = '#zadachi';
$secondary_env_url   = getenv('SECONDARY_CTA_URL') ?: ''; // pragma: allowlist secret

$hero_eyebrow          = $brand . ' · маркетплейсы WB/Ozon';
$hero_title_id         = 'mpwb-hero-title';
$hero_lead             = 'Карточки, отзывы, цены и реклама — без 15–20 часов ручного контроля в неделю. AI-агенты для Wildberries и Ozon в одном контуре: тактика роста №1 по Salesforce State of Sales 2026';
$hero_dashboard_title  = 'AI-центр маркетплейса · WB + Ozon';
$hero_dashboard_note   = 'пример логики AI-системы · демонстрационные данные';
$hero_metrics          = [
	['value' => '→ 0', 'label' => 'Отзывы без ответа', 'small' => 'за сегодня'],
	['value' => '47', 'label' => 'Карточки в очереди', 'small' => 'SEO-обновление'],
	['value' => '−34%', 'label' => 'Время на аналитику', 'small' => 'по Salesforce 2026'],
	['value' => '284', 'label' => 'SKU под контролем', 'small' => 'WB + Ozon'],
];
$hero_feed = [
	['dot' => 'green', 'text' => 'Ответ на отзыв WB · 4★ · опубликован за 42 сек'],
	['dot' => 'amber', 'text' => 'Цена SKU-1847 · правило маржи 28% · Ozon'],
	['dot' => 'blue', 'text' => 'Описание Ozon · rich-контент · черновик готов'],
];

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
.yoast-breadcrumb,.entry-header,.page-title-section { display: none !important; }

#primary,.site-main,.site-content,#content,.content-area {
	padding-top: 0 !important; margin-top: 0 !important;
}

.mpwb-content {
	--mpwb-bg: #050711; --mpwb-bg2: #080b17;
	--mpwb-text: #e6edf7; --mpwb-muted: #9aa8bd; --mpwb-soft: #c7d2e5; --mpwb-heading: #fff;
	--mpwb-border: rgba(255,255,255,.10);
	--mpwb-accent: #79f2ff; --mpwb-violet: #a855f7; --mpwb-wb: #cb11ab; --mpwb-ozon: #005bff;
	--mpwb-green: #22c55e; --mpwb-amber: #f59e0b;
	--mpwb-btn-from: #2563eb; --mpwb-btn-to: #7c3aed;
	--mpwb-r: 18px; --mpwb-r-lg: 24px; --mpwb-container: 1220px;
	background: linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
	color: var(--mpwb-text);
	font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
	overflow-x: hidden;
}
.mpwb-content *, .mpwb-content *::before, .mpwb-content *::after { box-sizing: border-box; }
.mpwb-content a { color: inherit; text-decoration: none; }
.mpwb-content p { color: var(--mpwb-muted); line-height: 1.72; margin: 0 0 1em; }
.mpwb-content p:last-child { margin-bottom: 0; }
.mpwb-content h2, .mpwb-content h3, .mpwb-content h4 { color: var(--mpwb-heading); letter-spacing: -.045em; margin: 0 0 .7em; }
.mpwb-content strong { color: var(--mpwb-soft); }
.mpwb-content ul, .mpwb-content ol { padding-left: 0; list-style: none; margin: 0 0 1em; }
.mpwb-content ul li { padding-left: 20px; position: relative; margin-bottom: .45em; color: var(--mpwb-muted); font-size: 14.5px; line-height: 1.65; }
.mpwb-content ul li::before { content: '›'; position: absolute; left: 0; color: var(--mpwb-accent); font-weight: 700; }
.mpwb-cnt { width: min(var(--mpwb-container), calc(100% - 40px)); margin: 0 auto; position: relative; z-index: 1; }
.mpwb-section { padding: clamp(64px, 8vw, 112px) 0; position: relative; }
.mpwb-section-alt { background: linear-gradient(180deg, rgba(255,255,255,.032), rgba(255,255,255,.01)); border-top: 1px solid rgba(255,255,255,.06); border-bottom: 1px solid rgba(255,255,255,.06); }
.mpwb-sh { max-width: 820px; margin: 0 auto 48px; text-align: center; }
.mpwb-sh.mpwb-left { margin-left: 0; text-align: left; }
.mpwb-sh h2 { font-size: clamp(26px, 4vw, 50px); line-height: 1.06; margin-bottom: 14px; }
.mpwb-sh p { font-size: clamp(15px, 1.6vw, 18px); max-width: 680px; margin: 0 auto; }
.mpwb-sh.mpwb-left p { margin-left: 0; }
.mpwb-eyebrow { display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; border-radius: 999px; background: rgba(121,242,255,.08); border: 1px solid rgba(121,242,255,.22); font-size: 11.5px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--mpwb-accent); margin-bottom: 14px; }
.mpwb-intro { padding: clamp(40px, 5vw, 72px) 0 clamp(40px, 5vw, 64px); background: linear-gradient(180deg, rgba(255,255,255,.03), transparent); border-bottom: 1px solid rgba(255,255,255,.06); }
.mpwb-intro-grid { display: grid; grid-template-columns: 1fr 340px; gap: 56px; align-items: center; }
.mpwb-intro-text { position: relative; padding-left: 20px; }
.mpwb-intro-text::before { content: ''; position: absolute; left: 0; top: 4px; bottom: 4px; width: 3px; border-radius: 2px; background: linear-gradient(180deg, var(--mpwb-accent), var(--mpwb-violet)); }
.mpwb-kpi-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
.mpwb-kpi { background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); border-radius: 14px; padding: 16px 14px; text-align: center; }
.mpwb-kpi .kv { font-size: clamp(20px, 2.5vw, 26px); font-weight: 900; color: var(--mpwb-heading); line-height: 1; margin-bottom: 5px; }
.mpwb-kpi .kl { font-size: 11px; font-weight: 600; color: var(--mpwb-muted); line-height: 1.4; }
.mpwb-metric-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin: 32px 0 0; }
.mpwb-metric-card { background: rgba(121,242,255,.06); border: 1px solid rgba(121,242,255,.22); border-radius: 16px; padding: 20px 16px; text-align: center; }
.mpwb-metric-card strong { display: block; font-size: clamp(22px, 3vw, 32px); color: var(--mpwb-accent); margin-bottom: 6px; }
.mpwb-metric-card span { font-size: 12px; color: var(--mpwb-muted); line-height: 1.4; }
.mpwb-busywork { display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin-top: 28px; }
.mpwb-busy-item { background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.09); border-radius: 14px; padding: 16px 12px; text-align: center; font-size: 12px; color: var(--mpwb-muted); }
.mpwb-busy-item .ico { font-size: 22px; display: block; margin-bottom: 8px; }
.mpwb-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
.mpwb-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.mpwb-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.mpwb-mod-card { background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.1); border-radius: var(--mpwb-r); padding: 22px; transition: border-color .2s, transform .2s; }
.mpwb-mod-card:hover { border-color: rgba(121,242,255,.28); transform: translateY(-2px); }
.mpwb-mod-card .ico { font-size: 24px; margin-bottom: 10px; }
.mpwb-mod-card h3 { font-size: 15px; margin-bottom: 8px; }
.mpwb-mod-card p { font-size: 13px; margin: 0; }
.mpwb-platform { border-radius: var(--mpwb-r-lg); padding: 28px; border: 1px solid rgba(255,255,255,.1); }
.mpwb-platform--wb { border-color: rgba(203,17,171,.35); background: linear-gradient(135deg, rgba(203,17,171,.08), rgba(255,255,255,.02)); }
.mpwb-platform--ozon { border-color: rgba(0,91,255,.35); background: linear-gradient(135deg, rgba(0,91,255,.08), rgba(255,255,255,.02)); }
.mpwb-platform-badge { display: inline-block; padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 14px; }
.mpwb-platform--wb .mpwb-platform-badge { background: rgba(203,17,171,.15); color: #f472b6; }
.mpwb-platform--ozon .mpwb-platform-badge { background: rgba(0,91,255,.15); color: #60a5fa; }
.mpwb-timeline { position: relative; padding-left: 40px; }
.mpwb-timeline::before { content: ''; position: absolute; left: 12px; top: 8px; bottom: 8px; width: 2px; background: linear-gradient(180deg, var(--mpwb-accent), var(--mpwb-violet)); opacity: .35; }
.mpwb-tl-item { position: relative; margin-bottom: 28px; }
.mpwb-tl-dot { position: absolute; left: -32px; top: 4px; width: 16px; height: 16px; border-radius: 50%; background: var(--mpwb-accent); box-shadow: 0 0 0 4px rgba(121,242,255,.2); }
.mpwb-table-wrap { overflow-x: auto; border-radius: 14px; border: 1px solid rgba(255,255,255,.09); margin: 20px 0; }
.mpwb-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.mpwb-table th { padding: 13px 16px; text-align: left; background: rgba(121,242,255,.1); color: var(--mpwb-accent); font-weight: 700; border-bottom: 1px solid rgba(121,242,255,.25); }
.mpwb-table td { padding: 12px 16px; border-bottom: 1px solid rgba(255,255,255,.05); color: var(--mpwb-text); vertical-align: top; }
.mpwb-table tr:last-child td { border-bottom: none; }
.mpwb-table tr:hover td { background: rgba(255,255,255,.03); }
.mpwb-table .hl { background: rgba(34,197,94,.08); }
.mpwb-case-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.mpwb-case-card { background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.09); border-radius: 20px; padding: 26px; }
.mpwb-case-tag { font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--mpwb-green); margin-bottom: 10px; }
.mpwb-callout { border-left: 4px solid var(--mpwb-amber); padding: 16px 20px; background: rgba(245,158,11,.08); border-radius: 0 14px 14px 0; margin: 24px 0; }
.mpwb-checklist { list-style: none; padding: 0; margin: 0; }
.mpwb-checklist li { padding: 10px 0 10px 28px; position: relative; border-bottom: 1px solid rgba(255,255,255,.06); }
.mpwb-checklist li::before { content: '☐'; position: absolute; left: 0; color: var(--mpwb-accent); }
.mpwb-faq { display: flex; flex-direction: column; gap: 10px; max-width: 820px; margin: 0 auto; }
.mpwb-faq-item { background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.1); border-radius: 14px; overflow: hidden; }
.mpwb-faq-q { padding: 19px 24px; font-size: 16px; font-weight: 700; color: var(--mpwb-heading); cursor: pointer; display: flex; justify-content: space-between; gap: 16px; }
.mpwb-faq-q::after { content: '▾'; color: var(--mpwb-accent); transition: transform .25s; }
.mpwb-faq-item.open .mpwb-faq-q::after { transform: rotate(180deg); }
.mpwb-faq-a { padding: 0 24px; max-height: 0; overflow: hidden; transition: max-height .38s ease, padding .25s; font-size: 14.5px; color: var(--mpwb-muted); }
.mpwb-faq-item.open .mpwb-faq-a { max-height: 800px; padding: 0 24px 20px; }
.mpwb-toc { display: flex; flex-wrap: wrap; gap: 9px; justify-content: center; padding: 0 0 40px; }
.mpwb-toc a { padding: 9px 18px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); border-radius: 999px; font-size: 13px; font-weight: 600; color: var(--mpwb-muted); }
.mpwb-toc a:hover { border-color: rgba(121,242,255,.42); color: var(--mpwb-accent); }
.mpwb-hero .nero-ai-metrics-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; margin-bottom: 12px; }
.mpwb-hero .nero-ai-metric { padding: 12px; border: 1px solid rgba(255,255,255,.09); border-radius: 16px; background: rgba(255,255,255,.055); }
.mpwb-hero .nero-ai-metric span { display: block; color: var(--mpwb-muted); font-size: 11px; font-weight: 700; }
.mpwb-hero .nero-ai-metric strong { display: block; margin-top: 5px; color: #fff; font-size: 22px; line-height: 1; }
.mpwb-hero .nero-ai-metric small { display: block; margin-top: 4px; color: #9fb0c9; font-size: 11px; }
.mpwb-hero .mpwb-dash-canvas-wrap {
	position: relative; height: clamp(220px, 32vw, 300px); margin: 0 0 12px;
	border-radius: 18px; overflow: hidden;
	border: 1px solid rgba(203,17,171,.18);
	background: radial-gradient(ellipse at 35% 45%, rgba(203,17,171,.08), rgba(6,10,24,.92) 68%);
}
.mpwb-hero #mpwb-hero-canvas { position: absolute; inset: 0; width: 100%; height: 100%; display: block; }
.mpwb-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.mpwb-hero .nero-ai-task {
	display: grid; grid-template-columns: 12px 1fr; align-items: center; gap: 10px;
	padding: 10px 12px; border: 1px solid rgba(255,255,255,.08); border-radius: 14px; background: rgba(255,255,255,.04);
	font-size: 12px; color: var(--mpwb-soft);
}
.mpwb-hero .nero-ai-dash-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
.mpwb-hero .nero-ai-dash-dot--green { background: #22c55e; box-shadow: 0 0 0 4px rgba(34,197,94,.15); }
.mpwb-hero .nero-ai-dash-dot--amber { background: #f59e0b; box-shadow: 0 0 0 4px rgba(245,158,11,.15); }
.mpwb-hero .nero-ai-dash-dot--blue { background: #79f2ff; box-shadow: 0 0 0 4px rgba(121,242,255,.15); }
.ym-cta-block { border-radius: 20px; padding: 36px 40px; margin: 32px 0; background: linear-gradient(135deg, rgba(121,242,255,.12), rgba(139,92,246,.1)); border: 1px solid rgba(121,242,255,.3); text-align: center; }
.ym-cta-block__headline { font-size: clamp(20px, 2.8vw, 28px); font-weight: 800; color: #fff; margin: 0 0 10px; }
.ym-cta-block__sub { color: var(--mpwb-muted); font-size: 15px; margin: 0 auto 22px; max-width: 600px; line-height: 1.7; }
.nero-ai-reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
@media (max-width: 960px) {
	.mpwb-intro-grid { grid-template-columns: 1fr; }
	.mpwb-kpi-row, .mpwb-metric-strip { grid-template-columns: repeat(2, 1fr); }
	.mpwb-busywork { grid-template-columns: repeat(2, 1fr); }
	.mpwb-grid-4 { grid-template-columns: repeat(2, 1fr); }
	.mpwb-grid-3, .mpwb-case-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
	.mpwb-grid-2, .mpwb-grid-3, .mpwb-grid-4, .mpwb-case-grid { grid-template-columns: 1fr; }
	.mpwb-kpi-row { grid-template-columns: 1fr 1fr; }
}
</style>

<main id="primary" class="site-main nero-ai-home-page mpwb-page" role="main" tabindex="-1">

<!-- HERO: канон .nero-ai-hero + дашборд Алины (mpwb-hero-canvas) -->
<section class="nero-ai-hero mpwb-hero" id="hero" aria-labelledby="<?php echo esc_attr($hero_title_id); ?>">
	<div class="nero-ai-container nero-ai-hero-grid">
		<div class="nero-ai-hero-copy nero-ai-reveal">
			<p class="nero-ai-eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
			<h1 id="<?php echo esc_attr($hero_title_id); ?>">AI для продавцов Wildberries и Ozon: внедрение <span class="nero-ai-gradient-text">под ключ</span></h1>
			<p class="nero-ai-hero-lead"><?php echo esc_html($hero_lead); ?></p>
			<ul class="nero-ai-badges" aria-label="Ключевые теги">
				<li class="nero-ai-badge">Wildberries</li>
				<li class="nero-ai-badge">Ozon</li>
				<li class="nero-ai-badge">AI-агенты</li>
				<li class="nero-ai-badge">Карточки</li>
				<li class="nero-ai-badge">Отзывы</li>
				<li class="nero-ai-badge">Цены</li>
				<li class="nero-ai-badge">n8n</li>
				<li class="nero-ai-badge">Под ключ</li>
			</ul>
			<div class="nero-ai-btn-row">
				<a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
				<a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>"><?php echo esc_html($secondary_cta_label); ?></a>
			</div>
		</div>
		<div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-центр маркетплейса">
			<div class="nero-ai-dashboard-shell">
				<div class="nero-ai-window-top">
					<div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
					<span class="nero-ai-window-title"><?php echo esc_html($hero_dashboard_note); ?></span>
				</div>
				<div class="nero-ai-window-body">
					<div class="nero-ai-dashboard-title">
						<h3><?php echo esc_html($hero_dashboard_title); ?></h3>
						<span class="nero-ai-live-pill">онлайн</span>
					</div>
					<div class="nero-ai-metrics-grid" aria-label="Метрики маркетплейса">
						<?php foreach ($hero_metrics as $metric) : ?>
						<div class="nero-ai-metric">
							<span><?php echo esc_html((string) ($metric['label'] ?? '')); ?></span>
							<strong><?php echo esc_html((string) ($metric['value'] ?? '')); ?></strong>
							<?php if (!empty($metric['small'])) : ?>
							<small><?php echo esc_html((string) $metric['small']); ?></small>
							<?php endif; ?>
						</div>
						<?php endforeach; ?>
					</div>
					<div class="mpwb-dash-canvas-wrap" aria-hidden="false">
						<canvas id="mpwb-hero-canvas" role="img" aria-label="Анимация: склад карточек WB и Ozon, поток отзывов через AI-центр маркетплейса"></canvas>
					</div>
					<div class="nero-ai-task-stream" aria-label="Лента событий">
						<?php foreach ($hero_feed as $row) :
							$dot = preg_replace('/[^a-z]/', '', (string) ($row['dot'] ?? 'blue'));
							$dot_class = in_array($dot, ['blue', 'green', 'amber'], true) ? $dot : 'blue';
						?>
						<div class="nero-ai-task">
							<span class="nero-ai-dash-dot nero-ai-dash-dot--<?php echo esc_attr($dot_class); ?>" aria-hidden="true"></span>
							<?php echo esc_html((string) ($row['text'] ?? '')); ?>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="mpwb-content">


<section class="mpwb-intro" id="intro" aria-label="Введение">
<div class="mpwb-cnt">
<div class="mpwb-intro-grid nero-ai-reveal">
<div class="mpwb-intro-text">
<p class="mpwb-eyebrow">Лонгрид · ai для маркетплейсов</p>
<p>Российский e-commerce живёт в режиме двух скоростей. С одной стороны — <strong>546 тысяч активных селлеров</strong> на Wildberries и Ozon суммарно, рост площадок и встроенный AI в личных кабинетах. С другой — карточки, отзывы, цены, остатки и реклама требуют постоянного контроля. Каталог из 50–500 SKU съедает <strong>15–20 часов в неделю</strong> на рутину.</p>
<p><strong>AI для маркетплейсов</strong> — связка LLM-агентов, API Wildberries и Ozon, оркестрации (n8n, Make), аналитики и CRM. В отчёте Salesforce State of Sales <strong>87% sales-организаций</strong> используют AI, а <strong>AI-агенты</strong> названы тактикой роста №1 на 2026 год.</p>
<p>Когда маркетплейсы связаны с CRM, логично рассматривать <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-amocrm/' ) ); ?>" class="ym-link--accent">внедрение AI-агента для amoCRM</a> — от заявок B2B до задач менеджера после негативного отзыва.</p>
<p>Тренд на агентов подтверждают и корпоративные rollout: <a href="<?php echo esc_url( home_url( '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>" class="ym-link--accent">уроки масштабного внедрения AI для бизнеса</a> на примере KPMG и Claude полезны селлерам, которые выходят за рамки одного кабинета.</p>
</div>
<div class="mpwb-kpi-row" aria-label="Ключевые цифры">
<div class="mpwb-kpi"><div class="kv">546К</div><div class="kl">селлеров WB+Ozon</div></div>
<div class="mpwb-kpi"><div class="kv">87%</div><div class="kl">sales orgs с AI</div></div>
<div class="mpwb-kpi"><div class="kv">15–20 ч</div><div class="kl">рутина / неделя</div></div>
<div class="mpwb-kpi"><div class="kv">8</div><div class="kl">модулей AI</div></div>
</div>
</div>
</div>
</section>

<nav class="mpwb-cnt mpwb-toc" aria-label="Оглавление">
<a href="#zachem-ai">Зачем AI</a>
<a href="#zadachi">8 модулей</a>
<a href="#wildberries">Wildberries</a>
<a href="#ozon">Ozon</a>
<a href="#vnedrenie">Внедрение</a>
<a href="#sravnenie">Сравнение</a>
<a href="#keisy">Кейсы</a>
<a href="#bez-koda">Без кода</a>
<a href="#vybor">Выбор</a>
<a href="#faq">FAQ</a>
</nav>

<section class="mpwb-section" id="zachem-ai">
<div class="mpwb-cnt">
<div class="mpwb-sh nero-ai-reveal">
<span class="mpwb-eyebrow">Тренд 2026</span>
<h2>Почему селлерам WB и Ozon нужен AI в 2026</h2>
<p>Маркетплейсы перестали быть «дополнительным каналом». Выигрывает тот, кто быстрее реагирует на отзывы, цены конкурентов и out-of-stock.</p>
</div>

<div class="mpwb-grid-2 nero-ai-reveal">
<div>
<h3>Административная рутина съедает маржу селлера</h3>
<p>Одно SEO-описание SKU — <strong>30–60 минут</strong> вручную; пакет из 10 отзывов — ещё <strong>30–40 минут</strong>. При 200+ артикулах рутина превращается в зарплату контент-менеджеру <strong>30 000–60 000 ₽/мес</strong> или в ваше личное время.</p>
<p><strong>51% sales-лидеров</strong> называют disconnected systems главным тормозом AI-инициатив. У селлера WB+Ozon картина та же: кабинеты, таблицы, мессенджеры — без сквозной автоматизации.</p>
</div>
<div>
<h3>Тренд Salesforce State of Sales 2026</h3>
<p>В феврале 2026 Salesforce опубликовал отчёт на основе опроса <strong>4 050 sales-профессионалов</strong> из 22 стран:</p>
<ul>
<li><strong>87%</strong> организаций используют AI; <strong>54%</strong> работали с AI-агентами</li>
<li>AI и агенты — <strong>тактика роста №1</strong> на 2026</li>
<li>Ожидается <strong>−34%</strong> на исследования и <strong>−36%</strong> на контент</li>
<li>Топ-перформеры в <strong>1,7×</strong> чаще используют prospecting AI agents</li>
</ul>
</div>
</div>

<div class="mpwb-metric-strip nero-ai-reveal" aria-label="KPI Salesforce">
<div class="mpwb-metric-card"><strong>87%</strong><span>организаций с AI</span></div>
<div class="mpwb-metric-card"><strong>−34%</strong><span>на исследования</span></div>
<div class="mpwb-metric-card"><strong>−36%</strong><span>на контент</span></div>
<div class="mpwb-metric-card"><strong>1,7×</strong><span>топ-перформеры с агентами</span></div>
</div>

<h3 style="margin-top:40px;text-align:center;">Что считают «busywork» на маркетплейсах</h3>
<div class="mpwb-busywork nero-ai-reveal">
<div class="mpwb-busy-item"><span class="ico">📦</span>Карточки и SEO</div>
<div class="mpwb-busy-item"><span class="ico">⭐</span>Отзывы и вопросы</div>
<div class="mpwb-busy-item"><span class="ico">₽</span>Цены конкурентов</div>
<div class="mpwb-busy-item"><span class="ico">📊</span>Остатки и закупки</div>
<div class="mpwb-busy-item"><span class="ico">📣</span>Реклама и ставки</div>
</div>
</div>
</section>

<section class="mpwb-section mpwb-section-alt" id="zadachi">
<div class="mpwb-cnt">
<div class="mpwb-sh nero-ai-reveal">
<span class="mpwb-eyebrow">8 модулей</span>
<h2>Какие задачи маркетплейса закрывает искусственный интеллект</h2>
<p>Восемь типовых задач селлера в одном контуре — от генерации карточек до управления рекламными ставками.</p>
</div>
<div class="mpwb-grid-4 nero-ai-reveal">
<div class="mpwb-mod-card"><div class="ico">📝</div><h3>Карточки товаров</h3><p>SEO, A/B-варианты, rich-контент за 10–15 мин вместо 30–60</p></div>
<div class="mpwb-mod-card"><div class="ico">💬</div><h3>Отзывы и чаты</h3><p>API → тональность → ответ в tone of voice → публикация</p></div>
<div class="mpwb-mod-card"><div class="ico">📈</div><h3>Мониторинг цен</h3><p>Динамическое ценообразование с учётом маржи и акций Ozon</p></div>
<div class="mpwb-mod-card"><div class="ico">📦</div><h3>Прогноз остатков</h3><p>Алерты out-of-stock, расчёт закупки по истории 3–6 мес</p></div>
<div class="mpwb-mod-card"><div class="ico">📣</div><h3>Рекламные ставки</h3><p>Performance API, сезонность, единый дашборд спроса</p></div>
<div class="mpwb-mod-card"><div class="ico">🔍</div><h3>Аналитика ниш</h3><p>Конкуренты, ключи, «спроси данные на русском»</p></div>
<div class="mpwb-mod-card"><div class="ico">🖼️</div><h3>Контент и инфографика</h3><p>Fabula/24AI или LLM+шаблоны под правила площадки</p></div>
<div class="mpwb-mod-card"><div class="ico">⚠️</div><h3>Негатив и эскалация</h3><p>≤3★ → human-in-the-loop, паттерны жалоб</p></div>
</div>
</div>
</section>

<!-- БОРИС: визуальный блок после #zadachi -->
<section id="mpwb-boris-viz" class="bmp-root" aria-label="Оркестрация AI-агентов между Wildberries и Ozon">
<style>
.bmp-root { padding: 0 0 64px; background: #f0f4fb; }
.bmp-cnt { max-width: 1160px; margin: 0 auto; padding: 0 20px; }
.bmp-card { display: grid; grid-template-columns: 44% 56%; border-radius: 24px; overflow: hidden; box-shadow: 0 8px 48px rgba(15,23,42,.13), 0 0 0 1.5px rgba(0,91,255,.12); min-height: 500px; }
@media (max-width: 960px) { .bmp-card { grid-template-columns: 1fr; min-height: auto; } }
.bmp-lft { background: #fff; padding: 44px 36px; display: flex; flex-direction: column; justify-content: center; }
.bmp-ey { font-size: 11px; font-weight: 700; letter-spacing: .11em; text-transform: uppercase; color: #005bff; margin: 0 0 14px; display: flex; align-items: center; gap: 8px; }
.bmp-ey::before { content: ''; width: 20px; height: 2px; background: #005bff; }
.bmp-h3 { font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; margin: 0 0 18px; }
.bmp-ul { list-style: none; margin: 0 0 22px; padding: 0; display: flex; flex-direction: column; gap: 10px; }
.bmp-ul li { display: flex; gap: 10px; font-size: 14px; color: #334155; line-height: 1.5; }
.bmp-ic { flex-shrink: 0; width: 22px; height: 22px; border-radius: 50%; background: rgba(0,91,255,.1); color: #005bff; display: grid; place-items: center; font-size: 11px; font-style: normal; }
.bmp-pills { display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 18px; }
.bmp-pl { padding: 5px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; }
.bmp-pl-wb { background: rgba(203,17,171,.08); color: #9d174d; border: 1.5px solid rgba(203,17,171,.22); }
.bmp-pl-oz { background: rgba(0,91,255,.08); color: #1e40af; border: 1.5px solid rgba(0,91,255,.22); }
.bmp-pl-ai { background: rgba(34,197,94,.08); color: #15803d; border: 1.5px solid rgba(34,197,94,.22); }
.bmp-foot { font-size: 13px; color: #64748b; font-style: italic; margin: 0; }
.bmp-rgt { background: linear-gradient(145deg, #07091a 0%, #0d1224 55%, #090d1f 100%); position: relative; overflow: hidden; min-height: 400px; }
#mpwb-boris-canvas { position: absolute; inset: 0; width: 100%; height: 100%; display: block; }
</style>
<div class="bmp-cnt">
<div class="bmp-card">
	<div class="bmp-lft">
		<span class="bmp-ey">Продолжение сцены hero</span>
		<h3 class="bmp-h3">Один AI-контур вместо двух кабинетов: WB и Ozon синхронно</h3>
		<ul class="bmp-ul">
			<li><span class="bmp-ic">1</span>Отзыв на WB → агент отвечает и логирует в CRM</li>
			<li><span class="bmp-ic">2</span>Цена конкурента на Ozon → правило маржи → обновление</li>
			<li><span class="bmp-ic">3</span>Карточка в очереди → SEO-генерация → публикация API</li>
			<li><span class="bmp-ic">4</span>Негатив ≤3★ → черновик в Telegram, не автопилот</li>
		</ul>
		<div class="bmp-pills">
			<span class="bmp-pl bmp-pl-wb">WB API</span>
			<span class="bmp-pl bmp-pl-oz">Ozon API</span>
			<span class="bmp-pl bmp-pl-ai">n8n + LLM</span>
		</div>
		<p class="bmp-foot">Дальше — сценарии по площадкам Wildberries и Ozon →</p>
	</div>
	<div class="bmp-rgt">
		<canvas id="mpwb-boris-canvas" role="img" aria-label="Анимация: потоки задач с WB и Ozon сходятся в AI-хаб и расходятся обработанными"></canvas>
	</div>
</div>
</div>
<script>
(function(){
	var cv = document.getElementById('mpwb-boris-canvas');
	if (!cv) return;
	var cx = cv.getContext('2d');
	var W = 0, H = 0, fr = 0;
	function resize(){
		var p = cv.parentElement;
		if (!p) return;
		cv.width = p.clientWidth || 640;
		cv.height = p.clientHeight || 500;
		W = cv.width; H = cv.height;
	}
	window.addEventListener('resize', resize);
	resize();
	var WB = '#cb11ab', OZ = '#005bff', AI = '#22c55e', MUTED = 'rgba(226,232,240,.4)';
	var packets = [];
	var LOOP = 600;
	function spawn(){
		var fromWB = Math.random() > .45;
		packets.push({
			side: fromWB ? 'wb' : 'oz',
			x: fromWB ? W * .12 : W * .88,
			y: 60 + Math.random() * (H - 140),
			phase: 0,
			label: fromWB ? ['отзыв','карточка','цена','остаток'][Math.floor(Math.random()*4)] : ['rich','реклама','аналитика','вопрос'][Math.floor(Math.random()*4)],
			done: false
		});
	}
	for (var i = 0; i < 5; i++) spawn();
	function rr(x,y,w,h,r,fill,stroke){
		cx.beginPath();
		if (cx.roundRect) cx.roundRect(x,y,w,h,r); else { cx.rect(x,y,w,h); }
		if (fill) { cx.fillStyle = fill; cx.fill(); }
		if (stroke) { cx.strokeStyle = stroke; cx.stroke(); }
	}
	function drawHub(){
		var hx = W * .5, hy = H * .5, r = 42 + Math.sin(fr * .04) * 4;
		cx.beginPath(); cx.arc(hx, hy, r + 18, 0, Math.PI * 2);
		cx.fillStyle = 'rgba(34,197,94,.08)'; cx.fill();
		rr(hx - r, hy - r, r * 2, r * 2, 16, 'rgba(255,255,255,.08)', 'rgba(34,197,94,.35)');
		cx.fillStyle = AI; cx.font = 'bold 13px Inter,sans-serif'; cx.textAlign = 'center';
		cx.fillText('AI', hx, hy - 4);
		cx.fillStyle = MUTED; cx.font = '10px Inter,sans-serif';
		cx.fillText('оркестратор', hx, hy + 12);
	}
	function drawLanes(){
		cx.strokeStyle = 'rgba(255,255,255,.08)'; cx.lineWidth = 2;
		[{x:W*.15,c:WB,l:'Wildberries'},{x:W*.85,c:OZ,l:'Ozon'}].forEach(function(lane){
			rr(lane.x - 50, 36, 100, 28, 10, lane.c + '22', lane.c + '66');
			cx.fillStyle = lane.c; cx.font = 'bold 11px Inter,sans-serif'; cx.textAlign = 'center';
			cx.fillText(lane.l, lane.x, 54);
		});
	}
	function loop(){
		fr++;
		if (fr % 90 === 0 && packets.length < 12) spawn();
		cx.clearRect(0, 0, W, H);
		drawLanes();
		drawHub();
		packets.forEach(function(p){
			if (!p.done) {
				p.phase += .018;
				var hx = W * .5, hy = H * .5;
				var tx = p.side === 'wb' ? hx - 30 : hx + 30;
				var ty = hy;
				var sx = p.x, sy = p.y;
				var t = Math.min(1, p.phase);
				var cxp = sx + (tx - sx) * t;
				var cyp = sy + (ty - sy) * t;
				var col = p.side === 'wb' ? WB : OZ;
				cx.strokeStyle = col + '44'; cx.lineWidth = 1.5; cx.setLineDash([4,6]);
				cx.beginPath(); cx.moveTo(sx, sy); cx.lineTo(cxp, cyp); cx.stroke(); cx.setLineDash([]);
				rr(cxp - 28, cyp - 10, 56, 20, 8, col + '33', col);
				cx.fillStyle = '#e2e8f0'; cx.font = '9px Inter,sans-serif'; cx.textAlign = 'center';
				cx.fillText(p.label, cxp, cyp + 4);
				if (t >= 1) { p.done = true; p.outPhase = 0; }
			} else {
				p.outPhase = (p.outPhase || 0) + .022;
				var ox = W * .5 + (p.side === 'wb' ? -80 : 80) + p.outPhase * 60 * (p.side === 'wb' ? -1 : 1);
				var oy = H * .5 + Math.sin(p.outPhase * 3) * 20;
				cx.fillStyle = AI; cx.beginPath(); cx.arc(ox, oy, 5, 0, Math.PI * 2); cx.fill();
				if (p.outPhase > 1.2) { p.phase = 0; p.done = false; p.y = 60 + Math.random() * (H - 140); }
			}
		});
		if (fr % LOOP === 0) { packets = []; for (var j = 0; j < 5; j++) spawn(); }
		requestAnimationFrame(loop);
	}
	document.fonts.ready.then(loop);
})();
</script>
</section>


<section class="mpwb-section" id="wildberries">
<div class="mpwb-cnt">
<div class="mpwb-platform mpwb-platform--wb nero-ai-reveal">
<span class="mpwb-platform-badge">Wildberries</span>
<h2>AI для Wildberries: сценарии внедрения для селлеров</h2>
<p><strong>293 тысячи</strong> активных продавцов на площадке. Встроенный ИИ «Помощник» (подписка «Джем») даёт аналитический чат и автоответы — но для каталога 100+ SKU и второй площадки на Ozon встроенного инструмента мало.</p>
<div class="mpwb-grid-3" style="margin-top:24px;">
<div><h3>Оптимизация карточек</h3><p><strong>AI карточки Wildberries</strong> — SEO-заголовки, описания, compliance check по 40+ правилам. Quick win пилота на 2 недели.</p></div>
<div><h3>Ответы на отзывы</h3><p>Polling WB Seller API каждые 30–60 мин, pre-analyzer тональности, ответы ≤3★ — черновик в Telegram.</p></div>
<div><h3>Реклама и позиции</h3><p>Анализ позиций по ключам, связка с остатками — не лить бюджет на SKU в out-of-stock.</p></div>
</div>
</div>
</div>
</section>

<section class="mpwb-section mpwb-section-alt" id="ozon">
<div class="mpwb-cnt">
<div class="mpwb-platform mpwb-platform--ozon nero-ai-reveal">
<span class="mpwb-platform-badge">Ozon</span>
<h2>AI для Ozon: сценарии внедрения для селлеров</h2>
<p>На Ozon — <strong>700 000+</strong> активных продавцов. OzonGenerator даёт <strong>50 бесплатных генераций/мес</strong> — для каталога из 200 SKU недостаточно.</p>
<div class="mpwb-grid-3" style="margin-top:24px;">
<div><h3>Rich-контент карточек</h3><p>Кастомное внедрение масштабирует генерацию без лимита. Human review юридически значимых характеристик.</p></div>
<div><h3>Аналитика спроса</h3><p>Ozon Seller API → AI-дайджест «что изменилось за неделю». Кросс-маркетплейс картина с WB.</p></div>
<div><h3>Реклама и ставки</h3><p>Performance API + правила маржи. Рекомендации с утверждением владельца.</p></div>
</div>
</div>
</div>
</section>

<section class="mpwb-section" id="vnedrenie">
<div class="mpwb-cnt">
<div class="mpwb-sh nero-ai-reveal">
<span class="mpwb-eyebrow">Под ключ</span>
<h2>Внедрение AI для маркетплейсов под ключ</h2>
<p>Ориентир стоимости: <strong>100–800 тысяч рублей</strong> в зависимости от SKU, площадок и глубины интеграций.</p>
</div>
<div class="mpwb-timeline nero-ai-reveal">
<div class="mpwb-tl-item"><div class="mpwb-tl-dot"></div><h3>1. Аудит — «Карта AI для маркетплейса»</h3><p>Read-only API WB/Ozon → инвентаризация SKU, отзывов без ответа, дублей, рисков out-of-stock.</p></div>
<div class="mpwb-tl-item"><div class="mpwb-tl-dot"></div><h3>2. Приоритизация модулей</h3><p>Quick wins (отзывы, топ-20 описаний) → цены, SEO-массовка → прогноз закупок, реклама.</p></div>
<div class="mpwb-tl-item"><div class="mpwb-tl-dot"></div><h3>3. Сборка стека</h3><p>n8n self-hosted или Make → LLM (GigaChat, YandexGPT, OpenAI) → MPStats → CRM/таблицы.</p></div>
<div class="mpwb-tl-item"><div class="mpwb-tl-dot"></div><h3>4. Пилот 2 недели</h3><p>30–50 SKU: метрики до/после — время на рутину, скорость ответа, позиции по 5 ключам.</p></div>
<div class="mpwb-tl-item"><div class="mpwb-tl-dot"></div><h3>5. Масштабирование + SLA</h3><p>Весь каталог, обучение команды, поддержка.</p></div>
</div>
<div class="mpwb-table-wrap nero-ai-reveal">
<table class="mpwb-table" aria-label="Ориентир стоимости">
<thead><tr><th>Сегмент</th><th>SKU</th><th>Площадки</th><th>Ориентир</th><th>Срок</th></tr></thead>
<tbody>
<tr><td>Малый бизнес</td><td>до 50</td><td>1</td><td>от 100 тыс. ₽</td><td>2–4 недели</td></tr>
<tr><td>Средний</td><td>50–300</td><td>WB + Ozon</td><td>250–500 тыс. ₽</td><td>4–8 недель</td></tr>
<tr><td>Крупный каталог</td><td>300+</td><td>WB + Ozon + CRM</td><td>до 800 тыс. ₽</td><td>8–12 недель</td></tr>
</tbody>
</table>
</div>
</div>
</section>

<div class="mpwb-cnt">
<div class="ym-cta-block nero-ai-cta-band nero-ai-reveal" id="cta-vnedrenie">
<p class="ym-cta-block__headline">Получите Карту AI для маркетплейса</p>
<p class="ym-cta-block__sub">8 модулей с приоритетом внедрения под ваш каталог WB/Ozon и бюджет 100–800 тыс. ₽</p>
<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
</div>
</div>

<section class="mpwb-section mpwb-section-alt" id="sravnenie">
<div class="mpwb-cnt">
<div class="mpwb-sh nero-ai-reveal">
<span class="mpwb-eyebrow">Экономия времени</span>
<h2>AI-агенты vs ручной контроль: сравнение по времени</h2>
</div>
<div class="mpwb-table-wrap nero-ai-reveal">
<table class="mpwb-table">
<thead><tr><th>Задача</th><th>Ручной режим</th><th>С AI-агентом</th><th>Экономия</th></tr></thead>
<tbody>
<tr><td>Описание 1 SKU</td><td>30–60 мин</td><td class="hl">10–15 мин</td><td>до 75%</td></tr>
<tr><td>Ответы на 10 отзывов</td><td>30–40 мин</td><td class="hl">10–15 мин</td><td>до 60%</td></tr>
<tr><td>Анализ 10 конкурентов</td><td>2–3 ч</td><td class="hl">30–40 мин</td><td>до 70%</td></tr>
<tr><td>35+ отзывов WB/день</td><td>2–4 ч/день</td><td class="hl">автомат + модерация</td><td>14–19 ч/нед</td></tr>
<tr><td>Ценовой мониторинг Ozon</td><td>3–4 ч/нед</td><td class="hl">по расписанию</td><td>до 90%</td></tr>
</tbody>
</table>
</div>
<div class="mpwb-callout nero-ai-reveal">
<p><strong>Что остаётся за человеком:</strong> финальная проверка карточек с юридически значимыми характеристиками; ответы на критический негатив; стратегия ассортимента; утверждение ценовых правил; выбор ниши и запуск новых SKU.</p>
</div>
</div>
</section>

<section class="mpwb-section" id="keisy">
<div class="mpwb-cnt">
<div class="mpwb-sh nero-ai-reveal">
<span class="mpwb-eyebrow">Россия</span>
<h2>Кейсы и примеры внедрения AI на маркетплейсах в РФ</h2>
</div>
<div class="mpwb-case-grid nero-ai-reveal">
<div class="mpwb-case-card"><div class="mpwb-case-tag">Otveto · Сколково</div><h3>Единое окно для отзывов WB/Ozon/ЯМ/Авито</h3><p>7 ИИ-моделей, двойная проверка, ответ за ~1 сек через официальные API. Закрывает коммуникации, не карточки/цены.</p></div>
<div class="mpwb-case-card"><div class="mpwb-case-tag">Habr · n8n + WB</div><h3>DIY-агент без программиста</h3><p>35+ отзывов/день: 2–4 ч → 1–5 мин на ответ. Экономия <strong>14–19 ч/нед</strong>. Негатив ≤3★ на ручную проверку.</p></div>
<div class="mpwb-case-card"><div class="mpwb-case-tag">Sostav · Ozon price</div><h3>AI-агент ценообразования</h3><p>Анализ эластичности спроса, фильтрация акционных периодов. Снимает <strong>3–4 ч/нед</strong> ручного мониторинга.</p></div>
</div>
<p style="text-align:center;margin-top:24px;color:var(--mpwb-muted);">Глобальный бенчмарк Amazon: <strong>12+ млн</strong> AI-листингов за 2025.</p>
<p style="text-align:center;margin-top:16px;color:var(--mpwb-muted);">Селлерам с каталогом 300+ SKU и учётом в 1С имеет смысл смотреть <a href="<?php echo esc_url( home_url( '/ai-1c-erp/' ) ); ?>" class="ym-link--accent">внедрение AI-агента для 1С и ERP</a> в связке с маркетплейсами — документы, остатки и закупки в одном контуре.</p>
</div>
</section>

<section class="mpwb-section mpwb-section-alt" id="bez-koda">
<div class="mpwb-cnt">
<div class="mpwb-sh nero-ai-reveal">
<span class="mpwb-eyebrow">No-code</span>
<h2>Как внедрить AI без программиста</h2>
</div>
<div class="mpwb-grid-2 nero-ai-reveal">
<div>
<h3>No-code связки и готовые агенты</h3>
<ul>
<li><strong>n8n / Make</strong> — визуальные сценарии: API WB/Ozon → LLM → публикация</li>
<li><strong>SaaS:</strong> Otveto, MPStats, Fabula</li>
<li><strong>Встроенный AI:</strong> OzonGenerator, WB «Помощник» — старт с лимитами</li>
</ul>
<?php if ($secondary_env_url !== '' && $secondary_env_url !== '#' && strpos($secondary_env_url, 'placeholder') === false) : ?>
<p style="margin-top:16px;">Хотите разобраться в автоматизации сами — <a href="<?php echo esc_url($secondary_env_url); ?>" class="ym-link--accent" target="_blank" rel="noopener noreferrer">материалы по обучению</a>.</p>
<?php endif; ?>
</div>
<div>
<h3>Когда нужна кастомная разработка</h3>
<ul>
<li>Каталог 300+ SKU с уникальной логикой ценообразования</li>
<li>Интеграция с 1С, WMS, собственной CRM</li>
<li>Self-hosted контур с SLA и аудитом безопасности (152-ФЗ)</li>
</ul>
</div>
</div>
</div>
</section>

<section class="mpwb-section" id="vybor">
<div class="mpwb-cnt">
<div class="mpwb-sh nero-ai-reveal">
<span class="mpwb-eyebrow">Стратегия</span>
<h2>Под ключ или самостоятельно: что выбрать селлеру</h2>
</div>
<div class="mpwb-table-wrap nero-ai-reveal">
<table class="mpwb-table">
<thead><tr><th>Параметр</th><th>Самостоятельно (DIY)</th><th>Под ключ</th></tr></thead>
<tbody>
<tr><td>До 50 SKU, 1 площадка</td><td>OzonGenerator + ChatGPT + таблицы</td><td>Избыточно, кроме сложной ниши</td></tr>
<tr><td>50–200 SKU, WB + Ozon</td><td>Возможно на n8n, 2–4 недели своего времени</td><td class="hl">Оптимально: пилот за 2 недели</td></tr>
<tr><td>200+ SKU, CRM, 1С</td><td>Риск ошибок, нет SLA</td><td class="hl">Под ключ для среднего бизнеса</td></tr>
</tbody>
</table>
</div>
<h3 style="margin-top:32px;">Чек-лист готовности магазина к AI</h3>
<ul class="mpwb-checklist nero-ai-reveal">
<li>API-токены WB и Ozon выданы</li>
<li>Таблица SKU: артикул, себестоимость, мин. маржа</li>
<li>Brand book / tone of voice (5+ примеров)</li>
<li>История продаж 3–6 мес для прогнозов</li>
<li>Список конкурентов / референс-карточек для SEO</li>
<li>Ответственный за модерацию негатива (≤3★)</li>
</ul>
</div>
</section>

<section class="mpwb-section mpwb-section-alt" id="faq">
<div class="mpwb-cnt">
<div class="mpwb-sh nero-ai-reveal">
<span class="mpwb-eyebrow">FAQ</span>
<h2>FAQ — внедрение AI для маркетплейсов</h2>
</div>
<div class="mpwb-faq nero-ai-reveal">
<div class="mpwb-faq-item"><div class="mpwb-faq-q" tabindex="0" role="button">Сколько стоит внедрение AI для WB и Ozon?</div><div class="mpwb-faq-a"><p>От <strong>100 тыс. ₽</strong> (малый каталог, 1 площадка) до <strong>800 тыс. ₽</strong> (300+ SKU, WB+Ozon+CRM). Точная цена — после аудита магазина.</p></div></div>
<div class="mpwb-faq-item"><div class="mpwb-faq-q" tabindex="0" role="button">Как внедрить AI для маркетплейсов пошагово?</div><div class="mpwb-faq-a"><p>(1) аудит и Карта AI, (2) приоритизация модулей, (3) подключение API, (4) пилот 2 недели на 30–50 SKU, (5) масштабирование. Срок: <strong>2–12 недель</strong>.</p></div></div>
<div class="mpwb-faq-item"><div class="mpwb-faq-q" tabindex="0" role="button">Нужен ли программист и CRM?</div><div class="mpwb-faq-a"><p>Программист не обязателен для пилота на n8n/Make — но нужна техническая грамотность или подрядчик. CRM даёт сквозную картину: отзыв → задача → правка карточки.</p></div></div>
<div class="mpwb-faq-item"><div class="mpwb-faq-q" tabindex="0" role="button">Какие задачи решает AI в первую очередь?</div><div class="mpwb-faq-a"><p>(1) отзывы и вопросы, (2) карточки топ-SKU, (3) мониторинг цен, (4) остатки, (5) реклама.</p></div></div>
<div class="mpwb-faq-item"><div class="mpwb-faq-q" tabindex="0" role="button">Встроенный AI Ozon/WB vs подрядчик: когда что?</div><div class="mpwb-faq-a">
<div class="mpwb-table-wrap"><table class="mpwb-table"><thead><tr><th>Критерий</th><th>Встроенный AI</th><th>Под ключ</th></tr></thead><tbody>
<tr><td>Цена</td><td>Бесплатно / «Джем»</td><td>100–800 тыс. ₽</td></tr>
<tr><td>Площадки</td><td>Одна</td><td class="hl">WB + Ozon + CRM</td></tr>
<tr><td>Лимиты</td><td>50 описаний/мес (Ozon)</td><td>По каталогу</td></tr>
<tr><td>152-ФЗ / self-hosted</td><td>Нет</td><td class="hl">Да (n8n on-premise)</td></tr>
</tbody></table></div>
</div></div>
</div>
<div class="ym-cta-block nero-ai-reveal" style="margin-top:40px;">
<p class="ym-cta-block__headline">Проверить магазин — первый шаг к Карте AI</p>
<p class="ym-cta-block__sub">Аудит read-only API WB/Ozon: отзывы без ответа, дубли карточек, риски out-of-stock</p>
<a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
</div>
<p style="text-align:center;margin-top:32px;color:var(--mpwb-soft);max-width:720px;margin-left:auto;margin-right:auto;">Глобальный тренд Salesforce, <strong>12+ млн AI-листингов</strong> на Amazon и российские кейсы говорят: <strong>ai для маркетплейсов</strong> — инфраструктура роста. Вопрос не «нужен ли AI», а «сколько часов в неделю вы ещё готовы тратить на busywork».</p>
</div>
</section>

</div><!-- /.mpwb-content -->

<script id="mpwb-hero-engine">
/**
 * mpwb-hero-engine — «Склад карточек маркетплейса»
 * WB-стеллажи (фиолетовый) + Ozon (cyan) → центральный хаб → поток отзывов
 */
(function () {
	var canvas = document.getElementById('mpwb-hero-canvas');
	if (!canvas) return;
	var ctx = canvas.getContext('2d');
	var W = 0, H = 0, fr = 0;
	var WB = '#cb11ab', OZ = '#005bff', AI = '#79f2ff', MUTED = 'rgba(226,232,240,.45)';

	function resize() {
		var wrap = canvas.parentElement;
		if (!wrap) return;
		canvas.width = wrap.clientWidth || 400;
		canvas.height = wrap.clientHeight || 260;
		W = canvas.width;
		H = canvas.height;
	}
	window.addEventListener('resize', resize);
	resize();

	var envelopes = [];
	function spawnEnvelope(side) {
		envelopes.push({
			side: side || (Math.random() > 0.5 ? 'wb' : 'oz'),
			t: 0,
			lane: Math.floor(Math.random() * 3),
			stars: 3 + Math.floor(Math.random() * 3)
		});
	}
	for (var i = 0; i < 6; i++) spawnEnvelope();

	function rr(x, y, w, h, r, fill, stroke) {
		ctx.beginPath();
		if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
		else ctx.rect(x, y, w, h);
		if (fill) { ctx.fillStyle = fill; ctx.fill(); }
		if (stroke) { ctx.strokeStyle = stroke; ctx.lineWidth = 1.2; ctx.stroke(); }
	}

	function drawShelves() {
		[{ x: W * 0.14, c: WB, label: 'WB' }, { x: W * 0.86, c: OZ, label: 'Ozon' }].forEach(function (lane) {
			for (var row = 0; row < 3; row++) {
				var sy = H * 0.22 + row * (H * 0.22);
				rr(lane.x - 42, sy, 84, 14, 4, lane.c + '18', lane.c + '55');
				for (var col = 0; col < 3; col++) {
					rr(lane.x - 36 + col * 24, sy - 22, 18, 20, 3, 'rgba(255,255,255,.12)', lane.c + '44');
				}
			}
			ctx.fillStyle = lane.c;
			ctx.font = 'bold 10px Inter,sans-serif';
			ctx.textAlign = 'center';
			ctx.fillText(lane.label, lane.x, H * 0.12);
		});
	}

	function drawHub() {
		var hx = W * 0.5, hy = H * 0.52, pulse = 38 + Math.sin(fr * 0.05) * 3;
		ctx.beginPath();
		ctx.arc(hx, hy, pulse + 14, 0, Math.PI * 2);
		ctx.fillStyle = 'rgba(121,242,255,.07)';
		ctx.fill();
		rr(hx - pulse, hy - 22, pulse * 2, 44, 12, 'rgba(255,255,255,.07)', 'rgba(121,242,255,.35)');
		ctx.fillStyle = AI;
		ctx.font = 'bold 11px Inter,sans-serif';
		ctx.textAlign = 'center';
		ctx.fillText('AI-хаб', hx, hy - 2);
		ctx.fillStyle = MUTED;
		ctx.font = '9px Inter,sans-serif';
		ctx.fillText('WB + Ozon', hx, hy + 12);
	}

	function drawRails() {
		ctx.strokeStyle = 'rgba(255,255,255,.06)';
		ctx.lineWidth = 2;
		ctx.setLineDash([5, 8]);
		[{ y: H * 0.35 }, { y: H * 0.52 }, { y: H * 0.68 }].forEach(function (rail) {
			ctx.beginPath();
			ctx.moveTo(W * 0.18, rail.y);
			ctx.lineTo(W * 0.82, rail.y);
			ctx.stroke();
		});
		ctx.setLineDash([]);
	}

	function loop() {
		fr++;
		if (fr % 70 === 0 && envelopes.length < 10) spawnEnvelope();
		ctx.clearRect(0, 0, W, H);
		drawRails();
		drawShelves();
		drawHub();
		envelopes.forEach(function (env) {
			env.t += 0.012;
			var fromX = env.side === 'wb' ? W * 0.14 : W * 0.86;
			var toX = W * 0.5;
			var y = H * (0.35 + env.lane * 0.17);
			var t = env.t % 1;
			var x = fromX + (toX - fromX) * t;
			var col = env.side === 'wb' ? WB : OZ;
			ctx.strokeStyle = col + '33';
			ctx.lineWidth = 1.5;
			ctx.beginPath();
			ctx.moveTo(fromX, y);
			ctx.lineTo(x, y);
			ctx.stroke();
			rr(x - 14, y - 9, 28, 18, 4, col + '28', col);
			ctx.fillStyle = '#e2e8f0';
			ctx.font = '8px Inter,sans-serif';
			ctx.textAlign = 'center';
			ctx.fillText('★'.repeat(env.stars), x, y + 3);
			if (t > 0.92) {
				ctx.fillStyle = AI;
				ctx.font = 'bold 8px Inter,sans-serif';
				ctx.fillText('−34%', toX + (env.side === 'wb' ? -28 : 28), y - 14);
			}
		});
		requestAnimationFrame(loop);
	}
	if (document.fonts && document.fonts.ready) {
		document.fonts.ready.then(loop);
	} else {
		loop();
	}
})();
</script>

<script>
(function(){
	document.querySelectorAll('.mpwb-faq-q').forEach(function(btn){
		btn.setAttribute('aria-expanded', 'false');
		btn.addEventListener('click', function(){
			var item = btn.closest('.mpwb-faq-item');
			var open = item.classList.contains('open');
			document.querySelectorAll('.mpwb-faq-item.open').forEach(function(el){
				el.classList.remove('open');
				var q = el.querySelector('.mpwb-faq-q');
				if (q) q.setAttribute('aria-expanded', 'false');
			});
			if (!open) { item.classList.add('open'); btn.setAttribute('aria-expanded', 'true'); }
		});
	});
})();
</script>
<script>
(function(){
	var root = document.querySelector('.mpwb-page');
	if (!root) return;
	var items = root.querySelectorAll('.nero-ai-reveal');
	if ('IntersectionObserver' in window) {
		var obs = new IntersectionObserver(function(entries){
			entries.forEach(function(e){ if (e.isIntersecting) { e.target.classList.add('nero-ai-active'); obs.unobserve(e.target); } });
		}, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
		items.forEach(function(i){ obs.observe(i); });
	} else { items.forEach(function(i){ i.classList.add('nero-ai-active'); }); }
})();
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "https://meta-journal.ru//#organization", // pragma: allowlist secret
      "name": "Neurinix", // pragma: allowlist secret
      "url": "https://meta-journal.ru/" // pragma: allowlist secret
    },
    {
      "@type": "WebSite",
      "@id": "https://meta-journal.ru//#website", // pragma: allowlist secret
      "url": "https://meta-journal.ru/", // pragma: allowlist secret
      "name": "Neurinix", // pragma: allowlist secret
      "publisher": {
        "@id": "https://meta-journal.ru//#organization" // pragma: allowlist secret
      }
    },
    {
      "@type": "WebPage",
      "@id": "https://meta-journal.ru/ai-dlya-prodavtsov-wildberries-i-ozon/#webpage", // pragma: allowlist secret
      "url": "https://meta-journal.ru/ai-dlya-prodavtsov-wildberries-i-ozon/", // pragma: allowlist secret
      "name": "AI для продавцов Wildberries и Ozon: внедрение под ключ", // pragma: allowlist secret
      "description": "Внедрение AI для маркетплейсов Wildberries и Ozon: карточки, отзывы, цены, остатки и реклама без ручного контроля. AI-агенты для селлеров по тренду продаж 2026. Проверить магазин.",
      "isPartOf": {
        "@id": "https://meta-journal.ru//#website" // pragma: allowlist secret
      },
      "about": {
        "@id": "https://meta-journal.ru//#organization" // pragma: allowlist secret
      }
    },
    {
      "@type": "BreadcrumbList",
      "@id": "https://meta-journal.ru/ai-dlya-prodavtsov-wildberries-i-ozon/#breadcrumb", // pragma: allowlist secret
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Главная", // pragma: allowlist secret
          "item": "https://meta-journal.ru/" // pragma: allowlist secret
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "AI для продавцов Wildberries и Ozon: внедрение под ключ", // pragma: allowlist secret
          "item": "https://meta-journal.ru/ai-dlya-prodavtsov-wildberries-i-ozon/" // pragma: allowlist secret
        }
      ]
    },
    {
      "@type": "Service",
      "@id": "https://meta-journal.ru/ai-dlya-prodavtsov-wildberries-i-ozon/#service", // pragma: allowlist secret
      "name": "AI для продавцов Wildberries и Ozon: внедрение под ключ", // pragma: allowlist secret
      "description": "Внедрение AI для маркетплейсов Wildberries и Ozon: карточки, отзывы, цены, остатки и реклама без ручного контроля. AI-агенты для селлеров по тренду продаж 2026. Проверить магазин.",
      "url": "https://meta-journal.ru/ai-dlya-prodavtsov-wildberries-i-ozon/", // pragma: allowlist secret
      "provider": {
        "@id": "https://meta-journal.ru//#organization" // pragma: allowlist secret
      }
    },
    {
      "@type": "FAQPage",
      "@id": "https://meta-journal.ru/ai-dlya-prodavtsov-wildberries-i-ozon/#faq", // pragma: allowlist secret
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Сколько стоит внедрение AI для WB и Ozon?", // pragma: allowlist secret
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "От 100 тыс. ₽ (малый каталог, 1 площадка) до 800 тыс. ₽ (300+ SKU, WB+Ozon+CRM). Точная цена — после аудита магазина."
          }
        },
        {
          "@type": "Question",
          "name": "Как внедрить AI для маркетплейсов пошагово?", // pragma: allowlist secret
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "(1) аудит и Карта AI, (2) приоритизация модулей, (3) подключение API, (4) пилот 2 недели на 30–50 SKU, (5) масштабирование. Срок: 2–12 недель."
          }
        },
        {
          "@type": "Question",
          "name": "Нужен ли программист и CRM?", // pragma: allowlist secret
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Программист не обязателен для пилота на n8n/Make — но нужна техническая грамотность или подрядчик. CRM даёт сквозную картину: отзыв → задача → правка карточки."
          }
        },
        {
          "@type": "Question",
          "name": "Какие задачи решает AI в первую очередь?", // pragma: allowlist secret
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "(1) отзывы и вопросы, (2) карточки топ-SKU, (3) мониторинг цен, (4) остатки, (5) реклама."
          }
        },
        {
          "@type": "Question",
          "name": "Встроенный AI Ozon/WB vs подрядчик: когда что?", // pragma: allowlist secret
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Встроенный AI: бесплатно или подписка «Джем», одна площадка, лимит 50 описаний/мес на Ozon, без self-hosted и 152-ФЗ. Под ключ: 100–800 тыс. ₽, WB + Ozon + CRM, без лимитов по каталогу, возможен n8n on-premise."
          }
        }
      ]
    }
  ]
}
</script>

</main>
<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
