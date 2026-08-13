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
$primary_cta_attrs = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_url = '#kalkulyator';

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

/* Hero retention */
.apok-hero-retention.nero-ai-hero {
	position: relative;
	min-height: min(980px, calc(100dvh - 1px));
	display: grid;
	align-items: center;
	padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
	isolation: isolate;
}
.apok-hero-retention::before {
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
.apok-hero-retention::after {
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
	animation: apokHeroGlow 8s ease-in-out infinite alternate;
	z-index: -1;
	pointer-events: none;
}
@keyframes apokHeroGlow {
	from { opacity: .45; transform: translateX(-50%) scale(.96); }
	to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.apok-hero-retention .nero-ai-container {
	width: min(1220px, calc(100% - 40px));
	margin: 0 auto;
}
.apok-hero-retention .nero-ai-hero-grid {
	display: grid;
	grid-template-columns: minmax(0, 1.05fr) minmax(0, .95fr);
	gap: clamp(28px, 4vw, 56px);
	align-items: center;
}
.apok-hero-retention .nero-ai-hero-copy h1 {
	font-size: clamp(32px, 4.8vw, 58px);
	line-height: 1.04;
	letter-spacing: -.045em;
	margin: 0 0 18px;
	color: #fff;
}
.apok-hero-retention .nero-ai-hero-lead {
	font-size: clamp(16px, 1.7vw, 19px);
	line-height: 1.65;
	color: #9aa8bd;
	max-width: 560px;
	margin: 0 0 24px;
}
.apok-hero-retention .nero-ai-badges {
	display: flex;
	flex-wrap: wrap;
	gap: 8px;
	margin: 0 0 28px;
	padding: 0;
	list-style: none;
}
.apok-hero-retention .nero-ai-badge {
	padding: 6px 14px;
	border-radius: 999px;
	font-size: 12px;
	font-weight: 700;
	color: #c7d2e5;
	background: rgba(255,255,255,.06);
	border: 1px solid rgba(255,255,255,.12);
}
.apok-hero-dash {
	position: relative;
	border-radius: 22px;
	background: rgba(8, 11, 23, .82);
	border: 1px solid rgba(255,255,255,.1);
	box-shadow: 0 28px 90px rgba(0,0,0,.42);
	overflow: hidden;
	min-height: 420px;
}
.apok-hero-dash-top {
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 12px 16px;
	border-bottom: 1px solid rgba(255,255,255,.08);
	font-size: 12px;
	color: #9aa8bd;
}
.apok-hero-dash-live {
	display: inline-flex;
	align-items: center;
	gap: 6px;
	padding: 4px 10px;
	border-radius: 999px;
	background: rgba(34,197,94,.12);
	color: #4ade80;
	font-weight: 700;
	font-size: 11px;
}
.apok-hero-dash-live::before {
	content: "";
	width: 6px;
	height: 6px;
	border-radius: 50%;
	background: #22c55e;
	animation: apokPulse 1.4s ease-in-out infinite;
}
@keyframes apokPulse {
	0%, 100% { opacity: 1; transform: scale(1); }
	50% { opacity: .5; transform: scale(.85); }
}
.apok-hero-metrics {
	display: grid;
	grid-template-columns: repeat(4, 1fr);
	gap: 8px;
	padding: 12px 16px;
}
.apok-hero-metric {
	padding: 10px;
	border-radius: 12px;
	background: rgba(255,255,255,.04);
	border: 1px solid rgba(255,255,255,.08);
}
.apok-hero-metric span { display: block; font-size: 10px; color: #64748b; margin-bottom: 4px; }
.apok-hero-metric strong { font-size: 15px; color: #e6edf7; }
#apok-hero-retention-canvas {
	display: block;
	width: 100%;
	height: 260px;
}
@media (max-width: 960px) {
	.apok-hero-retention .nero-ai-hero-grid { grid-template-columns: 1fr; }
	.apok-hero-metrics { grid-template-columns: repeat(2, 1fr); }
}

/* Content root */
.apok-content {
	--apok-bg: #050711;
	--apok-bg2: #080b17;
	--apok-text: #e6edf7;
	--apok-muted: #9aa8bd;
	--apok-soft: #c7d2e5;
	--apok-heading: #fff;
	--apok-border: rgba(255,255,255,.10);
	--apok-accent: #79f2ff;
	--apok-violet: #8b5cf6;
	--apok-green: #22c55e;
	--apok-red: #ef4444;
	--apok-btn-from: #2563eb;
	--apok-btn-to: #7c3aed;
	--apok-container: 1220px;
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
.apok-content ul li::before {
	content: '›'; position: absolute; left: 0; color: var(--apok-accent); font-weight: 700;
}
.apok-cnt {
	width: min(var(--apok-container), calc(100% - 40px));
	margin: 0 auto;
	position: relative;
	z-index: 1;
}
.apok-section { padding: clamp(64px, 8vw, 112px) 0; position: relative; }
.apok-section-alt {
	background: linear-gradient(180deg, rgba(255,255,255,.032), rgba(255,255,255,.01));
	border-top: 1px solid rgba(255,255,255,.06);
	border-bottom: 1px solid rgba(255,255,255,.06);
}
.apok-sh { max-width: 820px; margin: 0 auto 48px; text-align: center; }
.apok-sh h2 { font-size: clamp(26px, 4vw, 50px); line-height: 1.06; margin-bottom: 14px; }
.apok-sh p { font-size: clamp(15px, 1.6vw, 18px); max-width: 680px; margin: 0 auto; }
.apok-eyebrow {
	display: inline-flex; align-items: center; gap: 8px;
	padding: 6px 14px; border-radius: 999px;
	background: rgba(121,242,255,.08); border: 1px solid rgba(121,242,255,.22);
	font-size: 11.5px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
	color: var(--apok-accent); margin-bottom: 14px;
}
.apok-kpi-grid {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 14px;
	margin-top: 32px;
}
.apok-kpi-card {
	padding: 20px 16px;
	border-radius: 16px;
	background: rgba(255,255,255,.06);
	border: 1px solid rgba(255,255,255,.1);
	text-align: center;
}
.apok-kpi-card strong { display: block; font-size: 28px; color: #fff; margin-bottom: 6px; }
.apok-kpi-card span { font-size: 13px; color: var(--apok-muted); }
.apok-tier-pills { display: flex; flex-wrap: wrap; gap: 8px; margin: 20px 0; }
.apok-tier {
	padding: 5px 12px; border-radius: 999px; font-size: 12px; font-weight: 700;
}
.apok-tier-low { background: rgba(34,197,94,.12); color: #4ade80; border: 1px solid rgba(34,197,94,.25); }
.apok-tier-med { background: rgba(234,179,8,.12); color: #facc15; border: 1px solid rgba(234,179,8,.25); }
.apok-tier-high { background: rgba(249,115,22,.12); color: #fb923c; border: 1px solid rgba(249,115,22,.25); }
.apok-tier-crit { background: rgba(239,68,68,.12); color: #f87171; border: 1px solid rgba(239,68,68,.25); }
.apok-timeline { display: grid; gap: 20px; }
.apok-tl-item {
	position: relative;
	padding-left: 28px;
	border-left: 2px solid rgba(121,242,255,.25);
}
.apok-tl-item h3 { font-size: 18px; margin-bottom: 8px; }
.apok-card {
	padding: 28px;
	border-radius: 20px;
	background: rgba(255,255,255,.05);
	border: 1px solid rgba(255,255,255,.1);
}
.apok-calc-wrap {
	margin-top: 36px;
	padding: 28px;
	border-radius: 22px;
	background: rgba(255,255,255,.04);
	border: 1px solid rgba(255,255,255,.1);
}
.apok-calc-grid {
	display: grid;
	grid-template-columns: minmax(0, 1fr) minmax(0, 1.1fr);
	gap: 28px;
	align-items: start;
}
.apok-calc-controls label {
	display: block;
	margin-bottom: 18px;
	font-size: 14px;
	color: var(--apok-soft);
}
.apok-calc-controls input[type="range"] { width: 100%; margin: 8px 0 4px; accent-color: var(--apok-accent); }
.apok-calc-controls output {
	display: block;
	font-size: 16px;
	font-weight: 700;
	color: #fff;
}
.apok-calc-disclaimer { font-size: 12px; color: #64748b; margin-top: 8px; }
.apok-calc-kpi {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: 10px;
	margin-top: 16px;
	padding: 0;
	list-style: none;
}
.apok-calc-kpi li {
	padding: 12px 14px;
	border-radius: 12px;
	background: rgba(255,255,255,.05);
	border: 1px solid rgba(255,255,255,.08);
}
.apok-calc-kpi li::before { display: none; }
.apok-calc-kpi span { display: block; font-size: 11px; color: #64748b; margin-bottom: 4px; }
.apok-calc-kpi strong { font-size: 17px; color: #fff; }
#apok-retention-calc-canvas {
	width: 100%;
	height: 220px;
	display: block;
	border-radius: 12px;
	background: rgba(0,0,0,.2);
}
.apok-faq-item { border-bottom: 1px solid rgba(255,255,255,.08); padding: 18px 0; }
.apok-faq-item h3 { font-size: 17px; margin-bottom: 8px; }
.ym-cta-block {
	margin: 40px 0;
	padding: 28px;
	border-radius: 20px;
	background: linear-gradient(135deg, rgba(37,99,235,.15), rgba(124,58,237,.12));
	border: 1px solid rgba(121,242,255,.2);
	text-align: center;
}
.ym-cta-block__headline { font-size: 20px; font-weight: 800; color: #fff; margin: 0 0 10px; }
.ym-cta-block__sub { color: var(--apok-muted); font-size: 15px; margin: 0 auto 22px; max-width: 600px; }
.nero-ai-reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
@media (max-width: 900px) {
	.apok-kpi-grid { grid-template-columns: 1fr; }
	.apok-calc-grid { grid-template-columns: 1fr; }
}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-predotvrashchenie-ottoka-klientov-page" role="main" tabindex="-1">

<section class="nero-ai-hero apok-hero-retention" id="hero" aria-labelledby="apok-hero-title">
	<div class="nero-ai-container nero-ai-hero-grid">
		<div class="nero-ai-hero-copy nero-ai-reveal">
			<p class="nero-ai-eyebrow"><?php echo esc_html( $brand ); ?> · ai retention</p>
			<h1 id="apok-hero-title">AI-агент для предотвращения оттока клиентов: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
			<p class="nero-ai-hero-lead">AI находит признаки оттока и запускает сценарии удержания — пока клиент ещё не ушёл молча</p>
			<ul class="nero-ai-badges" aria-label="Ключевые возможности">
				<li class="nero-ai-badge">Churn ML</li>
				<li class="nero-ai-badge">Agentic AI</li>
				<li class="nero-ai-badge">CRM</li>
				<li class="nero-ai-badge">ROI</li>
			</ul>
			<div class="nero-ai-btn-row">
				<a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url( $primary_cta_url ); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
				<a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_attr( $secondary_cta_url ); ?>">Посчитать потери</a>
			</div>
		</div>
		<div class="apok-hero-dash nero-ai-reveal nero-ai-delay-2" aria-label="Демо: retention risk board">
			<div class="apok-hero-dash-top">
				<span>retention · live</span>
				<span class="apok-hero-dash-live">онлайн</span>
			</div>
			<div class="apok-hero-metrics">
				<div class="apok-hero-metric"><span>Churn score</span><strong>78%</strong></div>
				<div class="apok-hero-metric"><span>Lead time</span><strong>21 дн.</strong></div>
				<div class="apok-hero-metric"><span>Save rate</span><strong>41%</strong></div>
				<div class="apok-hero-metric"><span>MRR at risk</span><strong>−270K</strong></div>
			</div>
			<canvas id="apok-hero-retention-canvas" role="img" aria-label="Анимация: тихий отток — подписчики гаснут, AI подсвечивает at-risk до отмены"></canvas>
		</div>
	</div>
</section>

<div class="apok-content">

<section class="apok-section" id="bol">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Боль подписного бизнеса</span>
			<h2>Клиенты уходят молча — менеджеры узнают об этом слишком поздно</h2>
			<p>Тихий отток: подписка ещё активна, но клиент перестал заходить в продукт, пропускает занятия и не открывает письма. CRM краснеет постфактум.</p>
		</div>
		<div class="apok-kpi-grid nero-ai-reveal">
			<div class="apok-kpi-card"><strong>3,8%</strong><span>B2B SaaS monthly churn</span></div>
			<div class="apok-kpi-card"><strong>6,5%</strong><span>B2C подписки</span></div>
			<div class="apok-kpi-card"><strong>7,8%</strong><span>EdTech</span></div>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="reshenie">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Решение</span>
			<h2>AI предотвращение оттока: от анализа к автоматическим сценариям удержания</h2>
			<p>ML-скоринг риска + LLM-агент выбирает playbook и запускает действие: email, push, задача в CRM, звонок — с human-in-the-loop для VIP.</p>
		</div>
		<div class="apok-tier-pills nero-ai-reveal" aria-label="Зоны риска">
			<span class="apok-tier apok-tier-low">Low</span>
			<span class="apok-tier apok-tier-med">Medium</span>
			<span class="apok-tier apok-tier-high">High</span>
			<span class="apok-tier apok-tier-crit">Critical</span>
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
			<span class="apok-eyebrow">Для кого</span>
			<h2>Внедрение AI-агента для удержания клиентов в подписном бизнесе</h2>
			<p>SaaS, фитнес-клубы, онлайн-школы и любые сервисы с рекуррентной оплатой — playbooks под отрасль.</p>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="etapy">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Этапы</span>
			<h2>Как внедрить AI предотвращение оттока: от диагностики до запуска сценариев</h2>
		</div>
		<div class="apok-card nero-ai-reveal">
			<div class="apok-timeline">
				<div class="apok-tl-item"><h3>Шаг 1 — сбор сигналов</h3><p>CRM, биллинг, продуктовая аналитика, поддержка — коннекторы и feature store.</p></div>
				<div class="apok-tl-item"><h3>Шаг 2 — скоринг риска</h3><p>Daily churn score, SHAP-объяснимость, сегменты «на грани ухода».</p></div>
				<div class="apok-tl-item"><h3>Шаг 3 — сценарии удержания</h3><p>Email, push, задача в CRM, звонок — оркестрация через Make/n8n.</p></div>
				<div class="apok-tl-item"><h3>Шаг 4 — замер retention</h3><p>Save rate, time-to-intervention, ROI пилота vs контроль.</p></div>
			</div>
		</div>
	</div>
</section>

<section class="apok-section" id="kalkulyator">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Лид-магнит</span>
			<h2>Калькулятор риска оттока: посчитайте потери до внедрения AI</h2>
			<p>Оценочный расчёт MRR, потерь и ROI первого года. На аудите уточним по вашей базе.</p>
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
		<div class="ym-cta-block nero-ai-reveal">
			<p class="ym-cta-block__headline">Увидели цифры? Закажите диагностику риска оттока</p>
			<p class="ym-cta-block__sub">Nero Network проверит CRM, биллинг и продуктовую аналитику — покажем реальный churn и план пилота с ROI.</p>
			<a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="integracii">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Интеграции</span>
			<h2>AI предотвращение оттока: интеграция с CRM, биллингом и каналами связи</h2>
			<p>amoCRM, Bitrix24, YCLIENTS, ЮKassa, CloudPayments, Amplitude, SendPulse, Telegram, Make/n8n.</p>
		</div>
	</div>
</section>

<section class="apok-section" id="vnedrenie">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Под ключ</span>
			<h2>Внедрение AI-агентов под ключ: сроки, этапы и результат</h2>
			<p>Диагностика → data layer → churn model → agent layer → пилот 4–8 недель. Ориентир 200–650 тыс. ₽.</p>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="ceny">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Стоимость</span>
			<h2>Сколько стоит AI предотвращение оттока для компании</h2>
			<p>От 200 тыс. ₽ (узкий пилот) до 650 тыс. ₽ (омниканал, Enterprise governance).</p>
		</div>
	</div>
</section>

<section class="apok-section" id="keisy">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">Кейсы</span>
			<h2>Примеры внедрения AI для удержания клиентов и возврата подписчиков</h2>
			<p>Mindra (41% save), «Цезарь Сателлит» (−24%→17% churn), BigBen EdTech, PremiumBonus.</p>
		</div>
	</div>
</section>

<section class="apok-section apok-section-alt" id="faq">
	<div class="apok-cnt">
		<div class="apok-sh nero-ai-reveal">
			<span class="apok-eyebrow">FAQ</span>
			<h2>Частые вопросы об AI-удержании клиентов</h2>
		</div>
		<div class="apok-card nero-ai-reveal">
			<div class="apok-faq-item"><h3>Чем AI-агент отличается от аналитики churn?</h3><p>Агент выполняет действие: задача, письмо, эскалация — не только показывает метрику.</p></div>
			<div class="apok-faq-item"><h3>Можно ли без программиста?</h3><p>Да — Nero Network берёт интеграции и Make/n8n; клиент даёт доступы и бизнес-правила.</p></div>
			<div class="apok-faq-item"><h3>Как быстро окупается?</h3><p>Ориентир 3–12 месяцев в зависимости от базы; калькулятор — первичная оценка.</p></div>
		</div>
	</div>
</section>

<section class="apok-section" id="cta">
	<div class="apok-cnt" style="text-align:center;">
		<span class="apok-eyebrow">Диагностика риска оттока</span>
		<h2>Снизить отток: закажите план внедрения AI-агента</h2>
		<p style="max-width:580px;margin:0 auto 28px;">ML-скоринг + LLM-агент + playbooks. Пилот 4–8 недель, ориентир 200–650 тыс. ₽.</p>
		<a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
	</div>
</section>

</div><!-- .apok-content -->

<script>
(function(){
  'use strict';
  var cv = document.getElementById('apok-hero-retention-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;
  var dots = [];

  function resize(){
    cv.width = cv.clientWidth || 400;
    cv.height = cv.clientHeight || 260;
    W = cv.width; H = cv.height;
    if (!dots.length) {
      for (var i = 0; i < 48; i++) {
        dots.push({
          x: 20 + Math.random() * (W - 40),
          y: 20 + Math.random() * (H - 40),
          life: Math.random(),
          risk: Math.random() < 0.22,
          phase: Math.random() * 200
        });
      }
    }
  }
  window.addEventListener('resize', resize);
  resize();

  function loop(){
    frame++;
    ctx.clearRect(0, 0, W, H);
    var scanX = (frame * 1.8) % (W + 80) - 40;
    ctx.fillStyle = 'rgba(121,242,255,.06)';
    ctx.fillRect(scanX, 0, 60, H);

    dots.forEach(function(d){
      d.phase += 0.4;
      var fade = d.risk ? 0.35 + 0.25 * Math.sin(d.phase * 0.05) : Math.max(0, d.life - d.phase * 0.003);
      if (!d.risk && d.life < 0.15) d.life = 0.15;
      var col = d.risk ? '#f87171' : (fade > 0.4 ? '#4ade80' : '#64748b');
      var r = d.risk ? 5 : 3 + fade * 2;
      ctx.globalAlpha = d.risk ? 0.95 : Math.max(0.08, fade);
      ctx.fillStyle = col;
      ctx.beginPath();
      ctx.arc(d.x, d.y, r, 0, Math.PI * 2);
      ctx.fill();
      if (d.risk && scanX < d.x + 30 && scanX > d.x - 30) {
        ctx.strokeStyle = '#79f2ff';
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(d.x, d.y, 10 + Math.sin(frame * 0.1) * 2, 0, Math.PI * 2);
        ctx.stroke();
      }
    });
    ctx.globalAlpha = 1;
    requestAnimationFrame(loop);
  }
  loop();
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

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
