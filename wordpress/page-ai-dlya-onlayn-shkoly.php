<?php
/**
 * Template Name: AI для онлайн-школ: внедрение под ключ и ассистент 24/7
 * Description: SEO-лендинг — внедрение AI для онлайн-школ под ключ. Разгрузка кураторов, автопроверка ДЗ, RAG, GetCourse, Telegram.
 */

$page_seo_title       = 'AI для онлайн-школ: внедрение под ключ и ассистент 24/7';
$page_seo_description = 'Внедрение AI для онлайн-школ под ключ: разгрузка кураторов, автопроверка заданий, генерация материалов и ответы ученикам 24/7. Цена, кейсы, консультация.';

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
	[ 'label' => 'Зачем AI', 'href' => '#zachem-ai' ],
	[ 'label' => 'Кураторы', 'href' => '#kurator' ],
	[ 'label' => 'Внедрение', 'href' => '#etapy' ],
	[ 'label' => 'Интеграции', 'href' => '#integracii' ],
	[ 'label' => 'Цена', 'href' => '#ceny' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Внедрить AI в обучение';
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'Как это работает';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '#etapy';

add_filter(
	'body_class',
	static function ( array $classes ): array {
		if ( ! in_array( 'osh-edtech-page', $classes, true ) ) {
			$classes[] = 'osh-edtech-page';
		}
		return $classes;
	}
);

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

.osh-edtech-page .ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.osh-edtech-page .ym-btn:hover{transform:translateY(-2px);}
.osh-edtech-page .ym-btn--accent,.osh-edtech-page .nero-ai-btn-primary.ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.osh-edtech-page .ym-btn--ghost{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18);}
.osh-edtech-page .nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.osh-edtech-page .nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.osh-edtech-page .nero-ai-delay-1{transition-delay:.12s;}
.osh-edtech-page .nero-ai-delay-2{transition-delay:.24s;}
</style>

<main id="primary" class="site-main nero-ai-home-page osh-edtech-page" role="main" tabindex="-1">

<section class="nero-ai-hero osh-hero-edtech" id="osh-hero-edtech" aria-labelledby="osh-hero-title">
<style>
/* ── Hero ai-dlya-onlayn-shkoly: самодостаточные стили (без CSS темы) ── */
.osh-hero-edtech {
  --osh-cyan: #79f2ff;
  --osh-violet: #8b5cf6;
  --osh-green: #22c55e;
  --osh-text: #e6edf7;
  --osh-muted: #9aa8bd;
  --osh-soft: #c7d2e5;
  --osh-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  --osh-btn-from: #2563eb;
  --osh-btn-to: #7c3aed;
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  color: var(--osh-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
.osh-hero-edtech::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.osh-hero-edtech::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 680px;
  height: 680px;
  border-radius: 999px;
  background:
    radial-gradient(circle, rgba(139, 92, 246, .14), transparent 58%),
    radial-gradient(circle at 70% 40%, rgba(121, 242, 255, .12), transparent 62%);
  filter: blur(8px);
  animation: oshHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes oshHeroGlow {
  from { opacity: .42; transform: scale(.95); }
  to { opacity: .88; transform: scale(1.05); }
}
.osh-hero-edtech .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.osh-hero-edtech .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.osh-hero-edtech .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.osh-hero-edtech .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--osh-cyan) 38%, var(--osh-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.osh-hero-edtech .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--osh-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.osh-hero-edtech .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--osh-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.osh-hero-edtech .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.osh-hero-edtech .nero-ai-badge {
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
.osh-hero-edtech .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.osh-hero-edtech .nero-ai-btn {
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
.osh-hero-edtech .nero-ai-btn:hover { transform: translateY(-2px); }
.osh-hero-edtech .nero-ai-btn-primary {
  color: #fff !important;
  background: linear-gradient(135deg, var(--osh-btn-from), var(--osh-btn-to));
  box-shadow: 0 18px 42px rgba(59, 130, 246, 0.28);
}
.osh-hero-edtech .nero-ai-btn-secondary {
  color: var(--osh-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.osh-hero-edtech .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--osh-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.osh-hero-edtech .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.osh-hero-edtech .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.osh-hero-edtech .nero-ai-dots { display: flex; gap: 7px; }
.osh-hero-edtech .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.osh-hero-edtech .nero-ai-dot:nth-child(1) { background: #fb7185; }
.osh-hero-edtech .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.osh-hero-edtech .nero-ai-dot:nth-child(3) { background: #34d399; }
.osh-hero-edtech .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.osh-hero-edtech .nero-ai-window-body { padding: 16px; }
.osh-hero-edtech .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.osh-hero-edtech .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.osh-hero-edtech .nero-ai-live-pill {
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
.osh-hero-edtech .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: oshPulse 1.6s infinite;
}
@keyframes oshPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.osh-hero-edtech .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.osh-hero-edtech .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease;
}
.osh-hero-edtech .nero-ai-metric:hover {
  transform: translateY(-2px);
  border-color: rgba(121, 242, 255, 0.32);
}
.osh-hero-edtech .nero-ai-metric span {
  display: block;
  color: var(--osh-muted);
  font-size: 11px;
  font-weight: 700;
}
.osh-hero-edtech .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.osh-hero-edtech .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.osh-hero-edtech .osh-dash-canvas-wrap {
  position: relative;
  height: clamp(180px, 26vw, 220px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: radial-gradient(ellipse at 30% 45%, rgba(139,92,246,.10), rgba(6,10,24,.92) 72%);
}
.osh-hero-edtech #osh-edtech-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.osh-hero-edtech .nero-ai-task-stream { display: grid; gap: 8px; }
.osh-hero-edtech .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.osh-hero-edtech .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--osh-cyan);
  font-size: 11px;
  font-weight: 800;
}
.osh-hero-edtech .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.osh-hero-edtech .nero-ai-task span {
  color: var(--osh-muted);
  font-size: 11px;
}
.osh-hero-edtech .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.osh-hero-edtech .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.osh-hero-edtech .nero-ai-automation-map {
  margin-top: 12px;
  padding: 14px;
  border-radius: 18px;
  border: 1px solid rgba(255,255,255,.10);
  background:
    radial-gradient(circle at 50% 50%, rgba(121,242,255,.09), transparent 42%),
    rgba(255,255,255,.035);
}
.osh-hero-edtech .nero-ai-map-title {
  margin: 0 0 10px;
  color: #dce8f7;
  font-size: 12px;
  font-weight: 800;
}
.osh-hero-edtech .nero-ai-map-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  align-items: center;
  gap: 10px;
}
.osh-hero-edtech .nero-ai-people,
.osh-hero-edtech .nero-ai-processes { display: grid; gap: 8px; }
.osh-hero-edtech .nero-ai-person,
.osh-hero-edtech .nero-ai-process-node {
  min-height: 48px;
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 8px;
  border: 1px solid rgba(255,255,255,.10);
  border-radius: 14px;
  background: rgba(255,255,255,.055);
}
.osh-hero-edtech .nero-ai-person-figure {
  flex: 0 0 24px;
  width: 24px;
  height: 28px;
  position: relative;
}
.osh-hero-edtech .nero-ai-person-figure::before {
  content: "";
  position: absolute;
  left: 6px;
  top: 0;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--osh-cyan), #c4b5fd);
}
.osh-hero-edtech .nero-ai-person-figure::after {
  content: "";
  position: absolute;
  left: 3px;
  top: 12px;
  width: 18px;
  height: 14px;
  border-radius: 8px 8px 5px 5px;
  background: rgba(255,255,255,.16);
  border: 1px solid rgba(255,255,255,.14);
}
.osh-hero-edtech .nero-ai-person span,
.osh-hero-edtech .nero-ai-process-node span {
  display: block;
  color: #e7f0fb;
  font-size: 11px;
  font-weight: 800;
  line-height: 1.2;
}
.osh-hero-edtech .nero-ai-person small,
.osh-hero-edtech .nero-ai-process-node small {
  display: block;
  margin-top: 2px;
  color: var(--osh-muted);
  font-size: 10px;
}
.osh-hero-edtech .nero-ai-ai-core {
  position: relative;
  display: grid;
  place-items: center;
  min-height: 140px;
}
.osh-hero-edtech .nero-ai-core-ring {
  position: absolute;
  inset: 12px;
  border-radius: 50%;
  border: 1px dashed rgba(121,242,255,.28);
  animation: oshRotate 16s linear infinite;
}
.osh-hero-edtech .nero-ai-core-ring:nth-child(2) {
  inset: 28px;
  animation-duration: 11s;
  animation-direction: reverse;
  opacity: .75;
}
@keyframes oshRotate { to { transform: rotate(360deg); } }
.osh-hero-edtech .nero-ai-core-chip {
  position: relative;
  z-index: 1;
  width: 72px;
  height: 72px;
  border-radius: 22px;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg, rgba(37,99,235,.35), rgba(124,58,237,.35));
  border: 1px solid rgba(121,242,255,.35);
  box-shadow: 0 0 32px rgba(139,92,246,.25);
}
.osh-hero-edtech .nero-ai-core-chip strong {
  display: block;
  color: #fff;
  font-size: 14px;
  text-align: center;
}
.osh-hero-edtech .nero-ai-core-chip span {
  display: block;
  color: var(--osh-cyan);
  font-size: 9px;
  font-weight: 700;
  text-align: center;
}
@media (max-width: 1100px) {
  .osh-hero-edtech .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .osh-hero-edtech .nero-ai-dashboard { transform: none; }
}
@media (max-width: 820px) {
  .osh-hero-edtech .nero-ai-map-grid { grid-template-columns: 1fr; }
  .osh-hero-edtech .nero-ai-ai-core { min-height: 100px; }
}
@media (max-width: 520px) {
  .osh-hero-edtech .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .osh-hero-edtech .nero-ai-window-body { padding: 12px; }
  .osh-hero-edtech .nero-ai-task { grid-template-columns: 28px 1fr; }
  .osh-hero-edtech .nero-ai-status { grid-column: 2; width: fit-content; }
  .osh-hero-edtech .nero-ai-btn { width: 100%; }
}
@media (prefers-reduced-motion: reduce) {
  .osh-hero-edtech *,
  .osh-hero-edtech *::before,
  .osh-hero-edtech *::after {
    animation: none !important;
    transition: none !important;
  }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · AI для онлайн-школ</p>
      <h1 id="osh-hero-title">AI для онлайн-школ: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Разгрузите кураторов, автоматизируйте проверку заданий и дайте ученикам AI-помощника 24/7 — без расширения штата</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">AI-куратор</li>
        <li class="nero-ai-badge">Автопроверка ДЗ</li>
        <li class="nero-ai-badge">GetCourse</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">RAG</li>
        <li class="nero-ai-badge">LMS</li>
        <li class="nero-ai-badge">152-ФЗ</li>
        <li class="nero-ai-badge">MVP 2–3 нед</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Внедрить AI в обучение'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#etapy">Этапы внедрения</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-центра онлайн-школы">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-центр онлайн-школы</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric" title="Демо: после пилота">
              <span>Вопросы учеников</span>
              <strong>47</strong>
              <small>сегодня</small>
            </div>
            <div class="nero-ai-metric">
              <span>Средний ответ AI</span>
              <strong>12 сек</strong>
              <small>вместо часов</small>
            </div>
            <div class="nero-ai-metric">
              <span>ДЗ на проверке</span>
              <strong>23</strong>
              <small>в очереди</small>
            </div>
            <div class="nero-ai-metric" title="Демонстрационная метрика · после пилота">
              <span>Автозакрытие</span>
              <strong>−58%</strong>
              <small>рутины куратора</small>
            </div>
          </div>

          <div class="osh-dash-canvas-wrap" aria-hidden="false">
            <canvas id="osh-edtech-hero-canvas" role="img" aria-label="Анимация: вопросы учеников по ручьям попадают в AI-консоль, ДЗ проверяется по rubric, спорные кейсы эскалируются куратору"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Живой поток задач EdTech">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Ученик в Telegram</strong><span>«Как сдать ДЗ?»</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">RAG</span>
              <div><strong>Ответ по базе курса</strong><span>FAQ + контекст потока</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">✓</span>
              <div><strong>Тест проверен по rubric</strong><span>Зачёт в LMS</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Спорная работа</strong><span>Эскалация куратору</span></div>
              <span class="nero-ai-status nero-ai-status--amber">куратор</span>
            </div>
          </div>

          <div class="nero-ai-automation-map" aria-label="Схема: люди, AI и процессы EdTech">
            <p class="nero-ai-map-title">Как AI разгружает команду школы</p>
            <div class="nero-ai-map-grid">
              <div class="nero-ai-people">
                <div class="nero-ai-person"><span class="nero-ai-person-figure"></span><div><span>Куратор</span><small>сложные кейсы</small></div></div>
                <div class="nero-ai-person"><span class="nero-ai-person-figure"></span><div><span>Методист</span><small>контент и rubric</small></div></div>
                <div class="nero-ai-person"><span class="nero-ai-person-figure"></span><div><span>Ученик</span><small>24/7 помощь</small></div></div>
              </div>
              <div class="nero-ai-ai-core">
                <span class="nero-ai-core-ring"></span>
                <span class="nero-ai-core-ring"></span>
                <div class="nero-ai-core-chip"><div><strong>AI</strong><span>ядро</span></div></div>
              </div>
              <div class="nero-ai-processes">
                <div class="nero-ai-process-node"><div><span>GetCourse</span><small>LMS и потоки</small></div></div>
                <div class="nero-ai-process-node"><div><span>CRM</span><small>заявки и теги</small></div></div>
                <div class="nero-ai-process-node"><div><span>Проверка ДЗ</span><small>rubric + эскалация</small></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * osh-edtech-hero-engine — «Учебная диспетчерская EdTech»
 * Мир: QuestionRiver (ручьи вопросов) → TutorBrainHub → RubricGrader → EscalationBell
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("osh-edtech-hero-canvas");
  if (!canvas) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 220;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 420, ch / 240) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    cardQ: "#dbeafe",
    cardHw: "#d1fae5",
    cardTg: "#e0e7ff",
    river: "rgba(121,242,255,0.22)",
    hubBase: "#1e293b",
    hubCyan: "#79f2ff",
    hubViolet: "#8b5cf6",
    hubGreen: "#22c55e",
    rubric: "#a7f3d0",
    warn: "#fbbf24",
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

  function drawMiniCard(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, color, C.outline);
    if (label) {
      ctx.fillStyle = C.outline;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, x, y + 2);
    }
  }

  /* Изогнутые ручьи вопросов — вместо Conveyor */
  function QuestionRiver() {
    this.streams = [
      { lane: 0, offset: 0, color: C.cardTg, label: "?" },
      { lane: 1, offset: 70, color: C.cardHw, label: "ДЗ" },
      { lane: 2, offset: 140, color: C.cardQ, label: "FAQ" }
    ];
  }
  QuestionRiver.prototype.draw = function (ctx) {
    var arcs = [
      { x0: -150, y0: -88, cx: -60, cy: -20, x1: 10, y1: 15 },
      { x0: -120, y0: -95, cx: 0, cy: -30, x1: 35, y1: 10 },
      { x0: -90, y0: -82, cx: 40, cy: -15, x1: 55, y1: 18 }
    ];
    arcs.forEach(function (a, idx) {
      ctx.strokeStyle = idx === 1 ? "rgba(139,92,246,0.35)" : C.river;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(a.x0, a.y0);
      ctx.quadraticCurveTo(a.cx, a.cy, a.x1, a.y1);
      ctx.stroke();
    });

    this.streams.forEach(function (s) {
      var a = arcs[s.lane];
      var t = ((frame * 0.42 + s.offset) % 110) / 110;
      var omt = 1 - t;
      var px = omt * omt * a.x0 + 2 * omt * t * a.cx + t * t * a.x1;
      var py = omt * omt * a.y0 + 2 * omt * t * a.cy + t * t * a.y1;
      if (t < 0.9) drawMiniCard(ctx, px, py, 14, 16, s.color, s.label);
    });
  };

  /* Стеллаж уроков потока */
  function LessonPlaylistWall() {
    this.pulse = 0;
  }
  LessonPlaylistWall.prototype.draw = function (ctx) {
    drawRR(ctx, -168, -72, 34, 58, 5, "rgba(30,41,59,0.65)", C.outline);
    var modules = ["М1", "М2", "М3", "М4"];
    modules.forEach(function (m, i) {
      var lit = (frame * 0.04) % 240 > 40 + i * 18;
      drawRR(ctx, -162, -64 + i * 12, 22, 9, 2, lit ? "rgba(121,242,255,0.2)" : "rgba(255,255,255,0.06)", C.outline);
      ctx.fillStyle = lit ? C.hubCyan : "#64748b";
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(m, -158, -57 + i * 12);
    });
    ctx.fillStyle = C.hubViolet;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillText("Поток", -165, -78);
  };

  /* Сканер rubric для ДЗ */
  function RubricGraderPanel() {
    this.beam = 0;
  }
  RubricGraderPanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, 108, -52, 44, 50, 5, "rgba(255,255,255,0.05)", C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Rubric", 130, -42);

    if (prg >= 95 && prg < 155) {
      var scan = (prg - 95) / 60;
      this.beam = scan;
      ctx.fillStyle = "rgba(34,197,94,0.25)";
      ctx.fillRect(112, -48 + scan * 38, 36, 3);
      var crit = ["Тезисы", "Объём", "Термины"];
      crit.forEach(function (c, i) {
        if (prg > 105 + i * 12) {
          drawRR(ctx, 114, -36 + i * 14, 38, 10, 2, C.rubric, C.outline);
          ctx.fillStyle = "#0f172a";
          ctx.font = "bold 5px Inter,sans-serif";
          ctx.textAlign = "left";
          ctx.fillText(c + " ✓", 118, -28 + i * 14);
        }
      });
    }
  };

  /* Радар at-risk учеников */
  function RetentionRadar() {
    this.blip = 0;
  }
  RetentionRadar.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    ctx.strokeStyle = "rgba(121,242,255,0.25)";
    ctx.lineWidth = 1;
    for (var r = 12; r <= 28; r += 8) {
      ctx.beginPath();
      ctx.arc(-155, 42, r, 0, Math.PI * 2);
      ctx.stroke();
    }
    if (prg > 170) {
      this.blip = Math.sin(frame * 0.15) * 4;
      ctx.fillStyle = C.warn;
      ctx.beginPath();
      ctx.arc(-148 + this.blip, 38, 3, 0, Math.PI * 2);
      ctx.fill();
      if (prg === 175) createBubble(-148, 28, "At-risk: нет логина 48ч", 220);
    }
  };

  /* Центральная консоль AI-куратора — вместо WebsiteTerminal */
  function TutorBrainHub() {
    this.ringAngle = 0;
    this.escalate = false;
  }
  TutorBrainHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    drawRR(ctx, 8, -68, 108, 132, 10, C.hubBase, C.outline);

    drawRR(ctx, 14, -62, 96, 16, [6, 6, 0, 0], "rgba(37,99,235,0.35)", null);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("AI-куратор · LMS", 20, -52);

    /* Кольцо прогресса потока */
    this.ringAngle += 0.02;
    ctx.strokeStyle = "rgba(121,242,255,0.35)";
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(62, -18, 22, 0, Math.PI * 2 * (0.55 + Math.sin(frame * 0.03) * 0.15));
    ctx.stroke();

    /* Фаза 1: intake — вопрос в чате */
    if (prg < 70) {
      drawRR(ctx, 20, -38, 84, 22, 4, "rgba(255,255,255,0.08)", C.outline);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("Ученик: как сдать ДЗ?", 26, -24);
      if (prg > 25) {
        ctx.fillStyle = C.hubCyan;
        ctx.fillText("RAG: ищу в базе курса…", 26, -8);
      }
    }

    /* Фаза 2: ответ + зачёт */
    if (prg >= 70 && prg < 155) {
      drawRR(ctx, 20, -38, 84, 36, 4, "rgba(34,197,94,0.12)", C.outline);
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("Ответ 12 сек · FAQ", 26, -22);
      ctx.fillStyle = "#94a3b8";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("Ссылка на урок + дедлайн", 26, -10);
      if (prg > 120) {
        drawRR(ctx, 22, 8, 80, 14, 3, C.hubGreen, C.outline);
        ctx.fillStyle = "#052e16";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("ЗАЧЁТ В GETCOURSE", 62, 18);
        ctx.textAlign = "left";
      }
    }

    /* Фаза 3: эскалация — не ракета */
    if (prg >= 155) {
      var esc = Math.min(1, (prg - 155) / 20);
      ctx.save();
      ctx.globalAlpha = esc;
      drawRR(ctx, 18, 2, 88, 28, 5, "rgba(251,191,36,0.15)", C.warn);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("→ КУРАТОРУ", 62, 20);
      ctx.restore();
      if (prg === 158) createBubble(62, -45, "Спорная работа — human-in-the-loop", 260);
    }
  };

  /* Колокол эскалации */
  function EscalationBell() {
    this.swing = 0;
  }
  EscalationBell.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 155) return;
    this.swing = Math.sin(frame * 0.2) * 0.25;
    ctx.save();
    ctx.translate(118, 28);
    ctx.rotate(this.swing);
    ctx.fillStyle = C.warn;
    ctx.beginPath();
    ctx.moveTo(0, -8);
    ctx.lineTo(6, 4);
    ctx.lineTo(-6, 4);
    ctx.closePath();
    ctx.fill();
    ctx.fillRect(-1, 4, 2, 4);
    ctx.restore();
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.hitAnimation = 0;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var isMoving = false, carryType = null, faceDir = 1;
    var prg = (frame * 0.042) % 240;
    var targetX = 45;
    var targetY = -8 + (this.stepTrig * 0.35);

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 9) {
        isMoving = true; faceDir = 1; carryType = this.color;
        this.x = this.baseX + (targetX - this.baseX) * (local / 9);
        this.y = this.baseY + (targetY - this.baseY) * (local / 9);
      } else if (local < 13) {
        isMoving = false; this.x = targetX; this.y = targetY;
      } else {
        isMoving = true; faceDir = -1;
        this.x = targetX - (targetX - this.baseX) * ((local - 13) / 9);
        this.y = targetY - (targetY - this.baseY) * ((local - 13) / 9);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
    }

    var bob = Math.sin(this.timer * 1.5) * (isMoving ? 2 : 1);
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -10, -4 + bob, 8, 12, 2, C.outline, null);
    drawRR(ctx, 2, -4 + bob, 8, 12, 2, C.outline, null);
    drawRR(ctx, -14, -14 - bob, 28, 18, 6, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath(); ctx.arc(0, -26 - bob, 10, 0, Math.PI * 2); ctx.fill();
    ctx.lineWidth = 1.5; ctx.strokeStyle = C.outline; ctx.stroke();
    if (carryType) drawRR(ctx, -18 * faceDir, -20 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var river = new QuestionRiver();
  var hub = new TutorBrainHub();
  var playlist = new LessonPlaylistWall();
  var rubric = new RubricGraderPanel();
  var radar = new RetentionRadar();
  var bell = new EscalationBell();

  entities.push(river, playlist, rubric, radar, hub, bell);
  entities.push(new Agent(-155, 58, C.agentYellow, "1_methodist", 12, [
    "Обновляю карту модулей…", "Rubric для теста готов", "Поток №3 — FAQ загружен"
  ]));
  entities.push(new Agent(-95, 72, C.agentGreen, "2_curator_bot", 48, [
    "Типовой вопрос — в RAG", "Эскалация с контекстом", "152-ФЗ: ПДн обезличены"
  ]));
  entities.push(new Agent(-35, 62, C.agentBlue, "3_integrator", 88, [
    "Webhook GetCourse OK", "Telegram-бот на потоке", "CRM-тег: at-risk"
  ]));
  entities.push(new Agent(25, 78, C.agentPink, "4_content", 128, [
    "Черновик теста за 9 сек", "Конспект урока v2", "Методист проверит"
  ]));
  entities.push(new Agent(78, 58, C.agentPurple, "5_pilot", 168, [
    "Пилот 10% трафика", "MVP 2–3 недели", "Масштаб на школу"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 260, maxLife: customLife || 260 });
    if (bubbles.length > 4) bubbles.shift();
  }

  if (frame === 0) {
    createBubble(0, -55, "Аудит воронки EdTech", 300);
    createBubble(40, 10, "RAG по материалам курса", 280);
    createBubble(-30, 30, "Пилот на одном потоке", 280);
    createBubble(70, -20, "Human-in-the-loop для спорных ДЗ", 300);
  }

  function engineloop() {
    frame++;
    ctx.save();
    ctx.clearRect(0, 0, cw, ch);
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.forEach(function (e) { e.draw(ctx); });

    bubbles.forEach(function (b) {
      b.life--;
      b.y -= 0.35;
      if (b.life <= 0) return;
      var alpha = Math.min(1, b.life / 40);
      ctx.globalAlpha = alpha;
      var tw = Math.min(120, b.text.length * 5.5);
      drawRR(ctx, b.x - tw / 2, b.y - 14, tw, 16, 4, C.bubbleBg, C.hubCyan);
      ctx.fillStyle = C.bubbleText;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 3);
      ctx.globalAlpha = 1;
    });
    bubbles = bubbles.filter(function (b) { return b.life > 0; });

    ctx.restore();
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>


<style>
/* === OSH: контент страницы (префикс osh-, EdTech cyan/violet) === */
.osh-content{
  --osh-bg:#050711;--osh-bg2:#080b17;
  --osh-surface:rgba(255,255,255,.072);--osh-surface2:rgba(255,255,255,.108);
  --osh-text:#e6edf7;--osh-muted:#9aa8bd;--osh-soft:#c7d2e5;--osh-heading:#fff;
  --osh-border:rgba(255,255,255,.10);--osh-border-s:rgba(255,255,255,.18);
  --osh-cyan:#79f2ff;--osh-violet:#8b5cf6;--osh-green:#22c55e;
  --osh-btn-from:#2563eb;--osh-btn-to:#7c3aed;
  --osh-r:18px;--osh-r-lg:24px;--osh-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--osh-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.osh-content *,.osh-content *::before,.osh-content *::after{box-sizing:border-box;}
.osh-content a{color:inherit;}
.osh-content p{color:var(--osh-muted);line-height:1.72;margin:0 0 1em;}
.osh-content p:last-child{margin-bottom:0;}
.osh-content h2,.osh-content h3,.osh-content h4{color:var(--osh-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.osh-content strong{color:var(--osh-soft);}
.osh-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.osh-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--osh-muted);font-size:14.5px;line-height:1.65;}
.osh-content ul li::before{content:'›';position:absolute;left:0;color:var(--osh-cyan);font-weight:700;}
.osh-cnt{width:min(var(--osh-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.osh-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.osh-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.osh-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.osh-sh.osh-left{margin-left:0;text-align:left;}
.osh-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.osh-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.osh-sh.osh-left p{margin-left:0;}
.osh-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--osh-cyan);margin-bottom:14px;}
.osh-gt{background:linear-gradient(92deg,#fff 0%,var(--osh-cyan) 44%,var(--osh-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
/* intro */
.osh-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.osh-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.osh-intro-text{position:relative;padding-left:20px;}
.osh-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--osh-cyan),var(--osh-violet));}
.osh-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.osh-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.osh-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.osh-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--osh-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.osh-kpi-card .kl{font-size:11px;font-weight:600;color:var(--osh-muted);line-height:1.4;}
@media(max-width:900px){.osh-intro-grid{grid-template-columns:1fr;gap:36px;}.osh-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.osh-intro-kpi{grid-template-columns:1fr 1fr;}}
/* toc */
.osh-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.osh-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.osh-toc a{display:inline-block;padding:9px 18px;background:var(--osh-surface);border:1px solid var(--osh-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--osh-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.osh-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--osh-cyan);background:rgba(121,242,255,.08);}
/* cards & grids */
.osh-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--osh-border);border-radius:var(--osh-r-lg);padding:26px;backdrop-filter:blur(16px);}
.osh-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.osh-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.osh-grid-2,.osh-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.osh-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.osh-grid-3{grid-template-columns:1fr;}}
/* table */
.osh-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.osh-table{width:100%;border-collapse:collapse;font-size:14px;}
.osh-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--osh-cyan);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.osh-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--osh-text);vertical-align:top;}
.osh-table tr:last-child td{border-bottom:none;}
.osh-table tr:hover td{background:rgba(255,255,255,.03);}
/* timeline */
.osh-timeline{position:relative;padding-left:40px;}
.osh-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--osh-cyan),var(--osh-violet));opacity:.35;border-radius:2px;}
.osh-tl-item{position:relative;margin-bottom:32px;}
.osh-tl-item:last-child{margin-bottom:0;}
.osh-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--osh-cyan);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.osh-tl-item h3{font-size:17px;margin-bottom:8px;}
.osh-tl-item p{font-size:14.5px;margin:0;}
/* flow integracii */
.osh-flow{display:flex;flex-wrap:wrap;align-items:center;gap:8px 12px;padding:24px;background:rgba(255,255,255,.04);border:1px solid var(--osh-border);border-radius:var(--osh-r-lg);font-size:13px;font-weight:600;color:var(--osh-soft);margin:24px 0;}
.osh-flow .arr{color:var(--osh-violet);opacity:.7;}
.osh-flow span:not(.arr){padding:8px 14px;background:rgba(255,255,255,.06);border-radius:10px;border:1px solid rgba(255,255,255,.08);}
/* cases */
.osh-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.osh-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.osh-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--osh-green);margin-bottom:10px;}
@media(max-width:900px){.osh-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.osh-case-grid{grid-template-columns:1fr;}}
/* risk callout */
.osh-callout-amber{border-left:4px solid #f59e0b;background:rgba(245,158,11,.08);border-radius:0 14px 14px 0;padding:20px 24px;margin:24px 0;}
.osh-callout-amber h3{color:#fbbf24;font-size:17px;margin-bottom:8px;}
/* faq */
.osh-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.osh-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.osh-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--osh-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.osh-faq-q::after{content:'▾';font-size:13px;color:var(--osh-cyan);flex-shrink:0;transition:transform .25s;}
.osh-faq-item.open .osh-faq-q::after{transform:rotate(180deg);}
.osh-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--osh-muted);line-height:1.72;}
.osh-faq-item.open .osh-faq-a{max-height:800px;padding:0 24px 20px;}
/* checklist final */
.osh-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin:0 0 28px;padding:0;list-style:none;}
.osh-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--osh-muted);}
.osh-checklist li::before{content:'✓';color:var(--osh-green);font-weight:800;}
/* CTA (Artur) */
.osh-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.osh-content .ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.osh-content .ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border:1px solid rgba(139,92,246,.3);}
.osh-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.osh-content .ym-cta-block__sub{color:var(--osh-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.osh-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.osh-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.osh-content .ym-cta-block--secondary .ym-cta-block__actions{justify-content:flex-start;}
.osh-content .ym-link--accent{color:var(--osh-cyan)!important;text-decoration:underline!important;}
@media(max-width:600px){.osh-content .ym-cta-block{padding:28px 20px;}}
</style>

<div class="osh-content">

  <!-- #intro -->
  <section class="osh-intro" id="intro" aria-label="Введение">
    <div class="osh-cnt">
      <div class="osh-intro-grid nero-ai-reveal">
        <div class="osh-intro-text">
          <p class="osh-eyebrow">AI для онлайн-школ</p>
          <p><strong>Коротко:</strong> AI для онлайн-школы — это не «чат-бот с ChatGPT на сайте», а связка базы знаний курса (RAG), сценариев в LMS и CRM, автопроверки заданий и правил эскалации к живому куратору. Nero Network внедряет такие системы под ключ: от аудита процессов до пилота на одном потоке и масштабирования на всю школу.</p>
          <p>Онлайн-школы в 2026 году упираются в перегруз кураторов, однотипные вопросы учеников и медленное обновление контента. <strong>Внедрение AI для онлайн-школы</strong> закрывает эти задачи без расширения штата — если строить систему как корпоративного AI-агента для обучения.</p>
        </div>
        <div class="osh-intro-kpi" aria-label="Ключевые ориентиры">
          <div class="osh-kpi-card"><div class="kv">2–3 нед</div><div class="kl">MVP на одном сценарии</div></div>
          <div class="osh-kpi-card"><div class="kv">200 тыс.–1,5 млн ₽</div><div class="kl">ориентир чека внедрения</div></div>
          <div class="osh-kpi-card"><div class="kv">24/7</div><div class="kl">ответы ученикам</div></div>
          <div class="osh-kpi-card"><div class="kv">152-ФЗ</div><div class="kl">compliance-first стек</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- TOC -->
  <div class="osh-toc-outer">
    <div class="osh-cnt">
      <nav class="osh-toc" aria-label="Оглавление">
        <a href="#zachem-ai">Зачем AI</a>
        <a href="#kurator">Кураторы</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- #zachem-ai -->
  <section class="osh-section" id="zachem-ai" aria-labelledby="osh-h2-zachem">
    <div class="osh-cnt">
      <div class="osh-sh nero-ai-reveal">
        <span class="osh-eyebrow">EdTech 2026</span>
        <h2 id="osh-h2-zachem">Зачем онлайн-школам AI в 2026 году</h2>
        <p><strong>Определение:</strong> AI в образовании — применение нейросетей и AI-агентов для консультаций ученикам, проверки заданий, генерации материалов и аналитики обучения.</p>
      </div>

      <h3 class="nero-ai-reveal" style="font-size:20px;margin:32px 0 16px;text-align:center;color:var(--osh-heading);">Какие процессы в EdTech можно автоматизировать</h3>
      <div class="osh-table-wrap nero-ai-reveal">
        <table class="osh-table">
          <thead><tr><th>Сценарий</th><th>Что делает AI</th><th>Что остаётся человеку</th></tr></thead>
          <tbody>
            <tr><td>Продажи и первичка</td><td>Квалификация заявки, ответы о тарифах, дожим после вебинара</td><td>Сложные возражения, индивидуальные скидки</td></tr>
            <tr><td>FAQ и поддержка</td><td>Ответы 24/7 по базе курса, политике возвратов</td><td>Жалобы, конфликты, возвраты</td></tr>
            <tr><td>Проверка ДЗ</td><td>Тесты, код, структурированные тексты по rubric</td><td>Творческие работы, спорные оценки</td></tr>
            <tr><td>Контент</td><td>Черновики тестов, конспектов, сценариев уроков</td><td>Методический контроль, финальная правка</td></tr>
            <tr><td>Реактивация</td><td>Напоминания о вебинарах, просроченных ДЗ, at-risk</td><td>Личный звонок «на грани оттока»</td></tr>
          </tbody>
        </table>
      </div>

      <div class="osh-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:18px;margin-bottom:10px;">Тренд корпоративных AI-ассистентов (Microsoft Copilot Studio)</h3>
        <p>Глобальный тренд 2026 — <strong>корпоративные AI-агенты для обучения</strong>: Study and Learn Agent, Learning Coach, модуль Teach. Для российской школы это архитектурный референс — оркестрация, guardrails, human-in-the-loop — на стеке GetCourse / amoCRM / Telegram + RAG.</p>
        <p style="margin-top:12px;"><strong>Урок Khan Academy:</strong> AI встроен в момент практики, а не как отдельный чат (+6,1% next-item correctness при structured context). Для GetCourse: AI работает <strong>внутри задания и воронки</strong>.</p>
      </div>
    </div>
  </section>

  <!-- #kurator -->
  <section class="osh-section osh-section-alt" id="kurator" aria-labelledby="osh-h2-kurator">
    <div class="osh-cnt">
      <div class="osh-sh nero-ai-reveal">
        <span class="osh-eyebrow">AI-куратор</span>
        <h2 id="osh-h2-kurator">Как AI разгружает кураторов и ускоряет ответы ученикам</h2>
        <p>Главная боль EdTech: кураторы тонут в однотипных вопросах, ученики ждут ответа часами — падает доходимость и LTV.</p>
      </div>

      <div class="osh-grid-3 nero-ai-reveal">
        <div class="osh-card">
          <h3>Круглосуточные ответы</h3>
          <p>Ученик пишет в Telegram или GetCourse. RAG ищет ответ в базе курса — уроки, FAQ, скрипты кураторов. Отклик <strong>3–5 секунд</strong> (кейс GetCourse + FileBrain).</p>
        </div>
        <div class="osh-card nero-ai-delay-1">
          <h3>Сегментные ответы</h3>
          <p>Цена до/после вебинара, персонализация по полям анкеты. Интегратор Noltis: <strong>67% ДЗ</strong> на первой итерации — данные подрядчика, верификация на пилоте.</p>
        </div>
        <div class="osh-card nero-ai-delay-2">
          <h3>Human-in-the-loop</h3>
          <p>Confidence ниже порога → задача куратору с контекстом. Триггеры: жалоба, возврат, «юрист», «обман». События пишутся в CRM.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== БОРИС: визуальный блок (после #kurator) ===== -->
  <section id="ai-dlya-onlayn-shkoly-boris-block" class="oshb-root" aria-label="Анимация: поток обращений ученика через AI-куратора с эскалацией к живому куратору">
<style>
/* === БОРИС oshb- scoped === */
#ai-dlya-onlayn-shkoly-boris-block.oshb-root{padding:56px 0 64px;background:#f0f4fb;}
#ai-dlya-onlayn-shkoly-boris-block .oshb-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-dlya-onlayn-shkoly-boris-block .oshb-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(121,242,255,.2);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-dlya-onlayn-shkoly-boris-block .oshb-card{grid-template-columns:1fr;min-height:auto;}
}
#ai-dlya-onlayn-shkoly-boris-block .oshb-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-dlya-onlayn-shkoly-boris-block .oshb-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#ai-dlya-onlayn-shkoly-boris-block .oshb-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#0891b2;margin:0 0 14px;
}
#ai-dlya-onlayn-shkoly-boris-block .oshb-ey::before{content:'';width:18px;height:2px;background:#0891b2;border-radius:1px;}
#ai-dlya-onlayn-shkoly-boris-block .oshb-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#ai-dlya-onlayn-shkoly-boris-block .oshb-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-dlya-onlayn-shkoly-boris-block .oshb-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#ai-dlya-onlayn-shkoly-boris-block .oshb-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#0891b2;margin-top:1px;font-style:normal;
}
#ai-dlya-onlayn-shkoly-boris-block .oshb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-dlya-onlayn-shkoly-boris-block .oshb-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#ai-dlya-onlayn-shkoly-boris-block .oshb-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-dlya-onlayn-shkoly-boris-block .oshb-pl-c{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22);}
#ai-dlya-onlayn-shkoly-boris-block .oshb-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#ai-dlya-onlayn-shkoly-boris-block .oshb-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-dlya-onlayn-shkoly-boris-block .oshb-rgt{
  position:relative;background:linear-gradient(135deg,#ecfeff 0%,#f5f3ff 40%,#f0fdf4 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){#ai-dlya-onlayn-shkoly-boris-block .oshb-rgt{min-height:380px;}}
#osh-edtech-flow-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="oshb-cnt">
  <div class="oshb-card">
    <div class="oshb-lft">
      <span class="oshb-ey">Learning flow</span>
      <h3 class="oshb-h3">Вопрос ученика → RAG по курсу → ответ или эскалация куратору</h3>
      <ul class="oshb-ul">
        <li><span class="oshb-ic">1</span>Ученик пишет в Telegram / GetCourse — intent: FAQ, ДЗ, продажа, техвопрос</li>
        <li><span class="oshb-ic">2</span>RAG ищет ответ в материалах курса, FAQ и скриптах кураторов</li>
        <li><span class="oshb-ic">3</span>Высокий confidence — мгновенный ответ; тест/код — автопроверка по rubric</li>
        <li><span class="oshb-ic">?</span>Жалоба, возврат, низкий confidence — задача куратору с полным контекстом</li>
      </ul>
      <div class="oshb-pills">
        <span class="oshb-pl oshb-pl-c">12 сек · средний ответ AI</span>
        <span class="oshb-pl oshb-pl-g">−58% рутины куратора</span>
        <span class="oshb-pl oshb-pl-v">human-in-the-loop</span>
      </div>
      <p class="oshb-foot">Дальше — автопроверка заданий и генерация материалов →</p>
    </div>
    <div class="oshb-rgt">
      <canvas id="osh-edtech-flow-canvas" role="img" aria-label="Анимация EdTech: сообщения учеников проходят через RAG-хаб, часть закрывается AI, спорные уходят куратору"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('osh-edtech-flow-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0, pulse = 0;
  var LOOP = 620;

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
    cyan:'#06b6d4', cyanL:'rgba(6,182,212,.15)',
    viol:'#8b5cf6', violL:'rgba(139,92,246,.18)',
    green:'#22c55e', greenL:'rgba(34,197,94,.12)',
    amber:'#f59e0b',
    ink:'#0f172a', muted:'#64748b', line:'rgba(15,23,42,.08)',
    bubble:'#ffffff', bubbleB:'#cbd5e1'
  };

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  var QUERIES = [
    {text:'Как сдать ДЗ?', lane:'faq', delay:30},
    {text:'Где вебинар?', lane:'faq', delay:110},
    {text:'Вернуть деньги', lane:'esc', delay:200},
    {text:'Тест урок 3', lane:'dz', delay:290},
    {text:'Тариф Pro?', lane:'faq', delay:380},
    {text:'Не работает ЛК', lane:'esc', delay:470}
  ];

  var msgs = [];
  var resolved = 0, escalated = 0;

  function resetCycle(){
    msgs = QUERIES.map(function(q,i){
      return {text:q.text, lane:q.lane, delay:q.delay, t:0, x:-60, y:0, alpha:0, done:false, phase:0};
    });
    resolved = 0; escalated = 0;
  }
  resetCycle();

  function drawHub(cx, cy, r){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0, C.violL); g.addColorStop(1, 'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath(); ctx.arc(cx,cy,r*1.8,0,Math.PI*2); ctx.fill();

    rr(cx-r, cy-r*0.85, r*2, r*1.7, r*0.4, '#f5f3ff', C.viol, 2);
    ctx.fillStyle = C.viol;
    ctx.font = 'bold ' + Math.max(12,r*0.28) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center'; ctx.textBaseline = 'middle';
    ctx.fillText('RAG', cx, cy - 4);
    ctx.font = Math.max(9,r*0.16) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('база курса', cx, cy + r*0.35);

    ctx.strokeStyle = C.viol;
    ctx.lineWidth = 2 + Math.sin(pulse*0.08)*1.5;
    ctx.globalAlpha = 0.25 + Math.sin(pulse*0.08)*0.2;
    ctx.beginPath(); ctx.arc(cx,cy,r+8+Math.sin(pulse*0.06)*4,0,Math.PI*2); ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawLane(x,y,w,h,label,color,count){
    rr(x,y,w,h,10,'rgba(255,255,255,.92)',color,1.5);
    ctx.fillStyle = color;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(label, x+12, y+18);
    ctx.fillStyle = C.muted;
    ctx.font = '10px system-ui,sans-serif';
    ctx.fillText(count + ' обращений', x+12, y+h-10);
  }

  function drawMsgBubble(m){
    if(m.alpha < 0.02) return;
    ctx.globalAlpha = m.alpha;
    var bw = Math.min(120, m.text.length * 7 + 24);
    rr(m.x - bw/2, m.y - 14, bw, 28, 8, C.bubble, C.bubbleB, 1);
    ctx.fillStyle = C.ink;
    ctx.font = '10px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(m.text.length > 16 ? m.text.slice(0,14)+'…' : m.text, m.x, m.y + 4);
    ctx.globalAlpha = 1;
  }

  function tick(){
    frame++;
    pulse = frame % LOOP;
    if(frame % LOOP === 1) resetCycle();

    ctx.clearRect(0,0,W,H);

    var pad = 14, top = 36;
    var hubX = W * 0.48, hubY = H * 0.48, hubR = Math.min(W,H) * 0.11;
    var laneW = (W - pad*2 - 20) / 3, laneH = 52, laneY = H - laneH - pad;

    ctx.fillStyle = C.ink;
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('AI-куратор · поток обращений', pad, 22);
    ctx.fillStyle = C.green;
    ctx.font = '10px system-ui,sans-serif';
    ctx.fillText('● live', W - pad - 36, 22);

    drawHub(hubX, hubY, hubR);

    drawLane(pad, laneY, laneW, laneH, '✓ Автоответ', C.green, resolved);
    drawLane(pad + laneW + 10, laneY, laneW, laneH, '◎ Проверка ДЗ', C.cyan, Math.floor(resolved/2));
    drawLane(pad + (laneW+10)*2, laneY, laneW, laneH, '→ Куратор', C.amber, escalated);

    var inX = pad + 20, outAutoX = pad + laneW/2, outEscX = pad + (laneW+10)*2 + laneW/2;

    msgs.forEach(function(m){
      if(frame < m.delay) return;
      m.t++;
      if(!m.done && m.phase === 0){
        m.alpha = Math.min(1, m.t / 25);
        m.x += (hubX - 80 - m.x) * 0.04;
        m.y = hubY - hubR - 30 + Math.sin(frame*0.05 + m.delay)*4;
        if(m.x > hubX - hubR - 20){ m.phase = 1; m.t = 0; }
      } else if(m.phase === 1){
        m.t++;
        m.x = hubX + Math.sin(m.t*0.08)*6;
        m.y = hubY + Math.cos(m.t*0.06)*6;
        if(m.t > 45){
          m.phase = 2; m.t = 0;
          m.done = true;
          if(m.lane === 'esc'){ escalated++; m.tx = outEscX; }
          else { resolved++; m.tx = m.lane === 'dz' ? pad + laneW + 10 + laneW/2 : outAutoX; }
          m.ty = laneY + laneH/2;
        }
      } else if(m.phase === 2){
        m.x += (m.tx - m.x) * 0.06;
        m.y += (m.ty - m.y) * 0.06;
        m.alpha = Math.max(0, m.alpha - 0.008);
      }
      drawMsgBubble(m);
    });

    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1;
    ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(inX, hubY); ctx.lineTo(hubX - hubR, hubY);
    ctx.stroke();
    ctx.setLineDash([]);

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
  </section>
  <!-- ===== /БОРИС ===== -->

  <!-- #dz-materialy -->
  <section class="osh-section" id="dz-materialy" aria-labelledby="osh-h2-dz">
    <div class="osh-cnt">
      <div class="osh-sh nero-ai-reveal">
        <span class="osh-eyebrow">Автопроверка</span>
        <h2 id="osh-h2-dz">Автопроверка заданий и генерация учебных материалов</h2>
        <p>Методический стандарт важнее «сырого ChatGPT». AI проверяет по вашему rubric — не по шаблону.</p>
      </div>

      <div class="osh-grid-2 nero-ai-reveal">
        <div class="osh-case-card">
          <div class="osh-case-tag">aiПушкин · Yandex Cloud</div>
          <h3>Проверка сочинений и текстов</h3>
          <p>1–2 минуты vs 20 вручную; в 5 раз дешевле экспертной оценки. Спорные — человеку.</p>
        </div>
        <div class="osh-case-card">
          <div class="osh-case-tag">Skyeng · GenAI</div>
          <h3>Генерация уроков и упражнений</h3>
          <p>План урока, ДЗ, интерактив за 2–6 минут. Скорость производства контента ×3.</p>
        </div>
      </div>

      <div class="osh-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Что проверяет AI сам / только человек</h3>
        <ul>
          <li><strong>AI:</strong> тесты с однозначным ответом, код по тест-кейсам, тексты по чек-листу</li>
          <li><strong>Человек:</strong> творческие работы, спорные оценки, финальная аттестация</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- CTA #1 после #dz-materialy -->
  <div class="osh-cnt">
    <div class="ym-cta-block nero-ai-reveal" id="osh-cta-1">
      <h3 class="ym-cta-block__headline">Автопроверка ДЗ и ответы 24/7 — с пилотом на одном потоке</h3>
      <p class="ym-cta-block__sub">Обсудим rubric для ваших заданий и запустим FAQ-бот с RAG по материалам курса. Первый шаг — консультация в Telegram.</p>
      <div class="ym-cta-block__actions">
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a href="#etapy" class="ym-btn ym-btn--ghost">Смотреть этапы</a>
      </div>
    </div>
  </div>

  <!-- #etapy -->
  <section class="osh-section osh-section-alt" id="etapy" aria-labelledby="osh-h2-etapy">
    <div class="osh-cnt">
      <div class="osh-sh nero-ai-reveal">
        <span class="osh-eyebrow">Под ключ</span>
        <h2 id="osh-h2-etapy">Внедрение AI для онлайн-школы под ключ: этапы и сроки</h2>
        <p>MVP за 2–3 недели, полный контур — 1,5–3 месяца в зависимости от интеграций.</p>
      </div>

      <div class="osh-timeline nero-ai-reveal">
        <div class="osh-tl-item">
          <span class="osh-tl-dot" aria-hidden="true"></span>
          <h3>Аудит 90 минут</h3>
          <p>Карта потоков: заявка → оплата → онбординг → уроки → ДЗ → допродажа. На выходе — <strong>карта AI для онлайн-школы</strong> (8–12 модулей).</p>
        </div>
        <div class="osh-tl-item">
          <span class="osh-tl-dot" aria-hidden="true"></span>
          <h3>Пилот на одном потоке (2–3 недели)</h3>
          <p>FAQ-бот в Telegram + RAG по 20–50 FAQ + эскалация в GetCourse/amoCRM. Метрики: время ответа, % автозакрытия, доходимость, NPS кураторов.</p>
        </div>
        <div class="osh-tl-item">
          <span class="osh-tl-dot" aria-hidden="true"></span>
          <h3>Масштабирование</h3>
          <p>Автопроверка ДЗ, генерация контента для методиста, дашборд at-risk учеников. Пилот 10% → 100% с прозрачной аналитикой.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #integracii -->
  <section class="osh-section" id="integracii" aria-labelledby="osh-h2-int">
    <div class="osh-cnt">
      <div class="osh-sh nero-ai-reveal">
        <span class="osh-eyebrow">LMS · CRM</span>
        <h2 id="osh-h2-int">Интеграция AI с LMS, CRM и мессенджерами</h2>
        <p>Custom-решение отличается от «бота на сайт» — сквозная воронка EdTech.</p>
      </div>

      <div class="osh-flow nero-ai-reveal" aria-label="Схема интеграций">
        <span>Ученик</span><span class="arr">→</span>
        <span>Telegram / GetCourse</span><span class="arr">→</span>
        <span>n8n / Make</span><span class="arr">→</span>
        <span>RAG + LLM</span><span class="arr">→</span>
        <span>GetCourse API</span><span class="arr">→</span>
        <span>amoCRM / Bitrix24</span><span class="arr">→</span>
        <span>Эскалация куратору</span>
      </div>

      <div class="osh-table-wrap nero-ai-reveal">
        <table class="osh-table">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th><th>Когда выбирать</th></tr></thead>
          <tbody>
            <tr><td>Встроенный GetCourse AI</td><td>Быстрый старт, тексты/тесты</td><td>Слабая сегментация, нет CRM-логики</td><td>Черновики методисту</td></tr>
            <tr><td>FileBrain + GetCourse</td><td>«Входящие», 3–5 сек</td><td>Ограниченная логика ДЗ</td><td>FAQ, первая линия</td></tr>
            <tr><td>Custom n8n + RAG</td><td>Сегменты, ДЗ, аналитика, compliance</td><td>Нужен подрядчик, 2–4 нед MVP</td><td>500+ учеников, несколько потоков</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- #ceny -->
  <section class="osh-section osh-section-alt" id="ceny" aria-labelledby="osh-h2-ceny">
    <div class="osh-cnt">
      <div class="osh-sh nero-ai-reveal">
        <span class="osh-eyebrow">Коммерция</span>
        <h2 id="osh-h2-ceny">Сколько стоит AI для онлайн-школы и как считать окупаемость</h2>
        <p>Ориентир чека: <strong>200 000–1 500 000 ₽</strong> в зависимости от сценариев и интеграций.</p>
      </div>

      <div class="osh-table-wrap nero-ai-reveal">
        <table class="osh-table">
          <thead><tr><th>Компонент</th><th>Ориентир</th><th>Комментарий</th></tr></thead>
          <tbody>
            <tr><td>Аудит и карта сценариев</td><td>30–80 тыс. ₽</td><td>Часто входит в проект</td></tr>
            <tr><td>MVP (1 сценарий, Telegram + RAG)</td><td>200–400 тыс. ₽</td><td>Запуск за 2–3 недели</td></tr>
            <tr><td>Полный контур (ДЗ + CRM + аналитика)</td><td>500 тыс.–1,5 млн ₽</td><td>Несколько интеграций</td></tr>
            <tr><td>Поддержка</td><td>30–80 тыс. ₽/мес</td><td>Промпты, база знаний, мониторинг</td></tr>
          </tbody>
        </table>
      </div>

      <div class="osh-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Метрики ROI</h3>
        <p>Время первого ответа (часы → секунды), доля рутинных обращений к кураторам, доходимость и LTV, скорость обновления контента. Сравнение: <strong>ФОТ 1–2 кураторов</strong> в год часто сопоставим с внедрением под ключ — но AI масштабируется без линейного роста штата.</p>
      </div>
    </div>
  </section>

  <!-- CTA #2 после #ceny -->
  <div class="osh-cnt">
    <div class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="osh-cta-2">
      <h3 class="ym-cta-block__headline">Считаете окупаемость через ФОТ кураторов?</h3>
      <p class="ym-cta-block__sub">Текст + <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a> — уместно для команд, которые хотят разобраться в n8n, RAG и human-in-the-loop до старта проекта EdTech.</p>
      <div class="ym-cta-block__actions">
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>

  <!-- INTERNAL-LINKS:INSERT -->

  <!-- #keisy -->
  <section class="osh-section" id="keisy" aria-labelledby="osh-h2-keisy">
    <div class="osh-cnt">
      <div class="osh-sh nero-ai-reveal">
        <span class="osh-eyebrow">Кейсы</span>
        <h2 id="osh-h2-keisy">Кейсы и примеры внедрения AI в онлайн-образование</h2>
      </div>
      <div class="osh-case-grid nero-ai-reveal">
        <div class="osh-case-card">
          <div class="osh-case-tag">GetCourse + FileBrain</div>
          <h3>Первая линия вместо кураторов</h3>
          <p>Типовые вопросы, сегментные ответы, отклик 3–5 сек.</p>
        </div>
        <div class="osh-case-card">
          <div class="osh-case-tag">Skyeng / Skillbox</div>
          <h3>AI для методиста</h3>
          <p>Генерация уроков и упражнений; рутина уходит, живое взаимодействие остаётся.</p>
        </div>
        <div class="osh-case-card">
          <div class="osh-case-tag">Microsoft / Khan</div>
          <h3>Агенты для обучения</h3>
          <p>Scaffolding вместо answer engine; AI внутри практики, не отдельный чат.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #riski -->
  <section class="osh-section osh-section-alt" id="riski" aria-labelledby="osh-h2-riski">
    <div class="osh-cnt">
      <div class="osh-sh nero-ai-reveal">
        <span class="osh-eyebrow">E-E-A-T</span>
        <h2 id="osh-h2-riski">Риски и ограничения: данные учеников, качество проверки, галлюцинации</h2>
      </div>

      <div class="osh-callout-amber nero-ai-reveal">
        <h3>152-ФЗ и персональные данные</h3>
        <p>Отдельное согласие на обработку ПДн для AI; уведомление РКН; локализация баз; с IV кв. 2026 — нормы обезличивания для обучения ML. Штрафы за утечки — до 500 млн ₽ (421-ФЗ).</p>
      </div>

      <div class="osh-card nero-ai-reveal">
        <h3>Контроль качества</h3>
        <ul>
          <li>RAG только по утверждённым материалам</li>
          <li>Tutoring mode (подсказки, не готовые ответы)</li>
          <li>Регулярная выборочная проверка ответов и оценок</li>
          <li>Лог эскалаций для дообучения базы знаний</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- #faq -->
  <section class="osh-section" id="faq" aria-labelledby="osh-h2-faq">
    <div class="osh-cnt">
      <div class="osh-sh nero-ai-reveal">
        <span class="osh-eyebrow">FAQ</span>
        <h2 id="osh-h2-faq">FAQ: внедрение AI для онлайн-школы</h2>
      </div>

      <div class="osh-faq nero-ai-reveal" data-osh-faq>
        <div class="osh-faq-item">
          <div class="osh-faq-q" role="button" tabindex="0">Как внедрить AI для онлайн-школы без программиста?</div>
          <div class="osh-faq-a"><p>Подрядчик собирает стек на n8n/Make + API GetCourse. Вам нужны: FAQ, материалы курса, доступы к CRM/LMS, тестовый поток 20–50 учеников.</p></div>
        </div>
        <div class="osh-faq-item">
          <div class="osh-faq-q" role="button" tabindex="0">Под ключ или самостоятельно: что выбрать?</div>
          <div class="osh-faq-a"><p>Самостоятельно — низкий бюджет и один простой сценарий. Под ключ — сквозная воронка EdTech, ДЗ, CRM, compliance 152-ФЗ.</p></div>
        </div>
        <div class="osh-faq-item">
          <div class="osh-faq-q" role="button" tabindex="0">Заменит ли AI куратора?</div>
          <div class="osh-faq-a"><p><strong>Нет.</strong> AI берёт рутину; куратор — эмпатию, конфликты, спорные работы, стратегию сопровождения.</p></div>
        </div>
        <div class="osh-faq-item">
          <div class="osh-faq-q" role="button" tabindex="0">Сколько стоит и как заказать?</div>
          <div class="osh-faq-a"><p>Ориентир 200 тыс.–1,5 млн ₽. Первый шаг — консультация и карта AI для онлайн-школы (лид-магнит).</p></div>
        </div>
        <div class="osh-faq-item">
          <div class="osh-faq-q" role="button" tabindex="0">Какие задачи решает AI в первую очередь?</div>
          <div class="osh-faq-a"><p>Ответы 24/7, автопроверка тестов, черновики контента, реактивация at-risk, квалификация лидов в CRM.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- #vnedrit-ai — CTA #3 финал -->
  <section class="osh-section osh-section-alt" id="vnedrit-ai" aria-labelledby="osh-h2-cta-final">
    <div class="osh-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal">
        <h2 id="osh-h2-cta-final" class="ym-cta-block__headline">Внедрить AI в обучение</h2>
        <p class="ym-cta-block__sub">Аудит, MVP за 2–3 недели, GetCourse · Telegram · amoCRM · Bitrix24, compliance 152-ФЗ. <strong>Лид-магнит:</strong> карта AI для онлайн-школы (8–12 модулей по воронке EdTech).</p>
        <ul class="osh-checklist">
          <li>AI-агент первой линии</li>
          <li>RAG-база знаний</li>
          <li>Автопроверка ДЗ</li>
          <li>Генератор тестов</li>
          <li>Дашборд эскалаций</li>
          <li>Карта AI для школы</li>
        </ul>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Внедрить AI в обучение</a>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Получить карту AI</a>
        </div>
      </div>
    </div>
  </section>

</div><!-- .osh-content -->

<script>
/* FAQ accordion — локальный для osh-faq */
document.querySelectorAll('[data-osh-faq] .osh-faq-q').forEach(function(q){
  function toggle(){
    var item = q.closest('.osh-faq-item');
    if(!item) return;
    var open = item.classList.contains('open');
    item.parentElement.querySelectorAll('.osh-faq-item.open').forEach(function(i){ i.classList.remove('open'); });
    if(!open) item.classList.add('open');
  }
  q.addEventListener('click', toggle);
  q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); toggle(); }});
});
</script>


  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.osh-edtech-page');
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
