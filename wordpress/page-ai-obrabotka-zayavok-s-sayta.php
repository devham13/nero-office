<?php
/**
 * Template Name: AI-агент для первичной обработки заявок с сайта: внедрение под ключ
 * Description: SEO-лендинг — AI-обработка заявок с сайта. Квалификация в чате, CRM, кейсы. Аудит потерь заявок.
 */

$page_seo_title       = 'AI обработка заявок с сайта — внедрение агента под ключ';
$page_seo_description = 'Внедрим AI-агента для первичной обработки заявок с сайта: ответ за 5–15 секунд, квалификация в чате и передача лида в CRM. Кейсы, цена, интеграция. Аудит потерь заявок.';

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
    ['label' => 'Потери заявок', 'href' => '#poteri-zayavok'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'CRM', 'href' => '#crm'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'Аудит заявок', 'href' => '#audit-zayavok'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Записаться на аудит потерь заявок';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);

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

/* Kadence reset + breadcrumbs hide */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

/* ── Hero email→CRM: самодостаточные стили (без CSS темы) ── */
.vnec-hero-email-crm {
  --vnec-cyan: #79f2ff;
  --vnec-violet: #8b5cf6;
  --vnec-green: #22c55e;
  --vnec-text: #e6edf7;
  --vnec-muted: #9aa8bd;
  --vnec-soft: #c7d2e5;
  --vnec-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnec-hero-email-crm.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnec-hero-email-crm::before {
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
.vnec-hero-email-crm::after {
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
  animation: vnecHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnecHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnec-hero-email-crm .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnec-hero-email-crm .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnec-hero-email-crm .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnec-hero-email-crm .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnec-cyan) 44%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnec-hero-email-crm .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnec-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnec-hero-email-crm .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnec-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnec-hero-email-crm .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnec-hero-email-crm .nero-ai-badge {
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
.vnec-hero-email-crm .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnec-hero-email-crm .nero-ai-btn {
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
.vnec-hero-email-crm .nero-ai-btn:hover { transform: translateY(-2px); }
.vnec-hero-email-crm .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnec-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnec-hero-email-crm .nero-ai-btn-secondary {
  color: var(--vnec-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnec-hero-email-crm .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnec-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnec-hero-email-crm .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnec-hero-email-crm .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnec-hero-email-crm .nero-ai-dots { display: flex; gap: 7px; }
.vnec-hero-email-crm .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnec-hero-email-crm .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnec-hero-email-crm .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnec-hero-email-crm .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnec-hero-email-crm .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnec-hero-email-crm .nero-ai-window-body { padding: 16px; }
.vnec-hero-email-crm .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnec-hero-email-crm .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnec-hero-email-crm .nero-ai-live-pill {
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
.vnec-hero-email-crm .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnecPulse 1.6s infinite;
}
@keyframes vnecPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnec-hero-email-crm .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnec-hero-email-crm .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnec-hero-email-crm .nero-ai-metric span {
  display: block;
  color: var(--vnec-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnec-hero-email-crm .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnec-hero-email-crm .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnec-hero-email-crm .vnec-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 50% 40%, rgba(121,242,255,.08), rgba(6,10,24,.9) 70%);
}
.vnec-hero-email-crm #vnec-inbox-crm-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnec-hero-email-crm .nero-ai-task-stream {
  display: grid;
  gap: 8px;
}
.vnec-hero-email-crm .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnec-hero-email-crm .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vnec-cyan);
  font-size: 13px;
  font-weight: 800;
}
.vnec-hero-email-crm .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnec-hero-email-crm .nero-ai-task span {
  color: var(--vnec-muted);
  font-size: 11px;
}
.vnec-hero-email-crm .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnec-hero-email-crm .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vnec-hero-email-crm .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnec-hero-email-crm .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnec-hero-email-crm .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnec-hero-email-crm .nero-ai-window-body { padding: 12px; }
  .vnec-hero-email-crm .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnec-hero-email-crm .nero-ai-status { grid-column: 2; width: fit-content; }
}

/* VNEC content root */

/* ── Hero заявки с сайта: самодостаточные стили (Kadence / .nero-ai-home-page) ── */
.vza-hero-site-leads {
  --vza-cyan: #79f2ff;
  --vza-orange: #f97316;
  --vza-violet: #a78bfa;
  --vza-green: #22c55e;
  --vza-text: #e6edf7;
  --vza-muted: #9aa8bd;
  --vza-soft: #c7d2e5;
  --vza-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vza-hero-site-leads.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vza-hero-site-leads::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 38% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vza-hero-site-leads::after {
  content: "";
  position: absolute;
  right: -8%;
  top: 10%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(249, 115, 22, .14), transparent 66%);
  filter: blur(8px);
  animation: vzaHeroWarmGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vzaHeroWarmGlow {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .82; transform: scale(1.05); }
}
.vza-hero-site-leads .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vza-hero-site-leads .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(340px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vza-hero-site-leads .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.vza-hero-site-leads .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vza-orange) 38%, var(--vza-cyan) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vza-hero-site-leads .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(249, 115, 22, 0.28);
  border-radius: 999px;
  background: rgba(249, 115, 22, 0.1);
  color: #fdba74 !important;
  font-size: 12px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.vza-hero-site-leads .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 700px;
  color: var(--vza-soft) !important;
  font-size: clamp(17px, 1.85vw, 21px);
  line-height: 1.58;
}
.vza-hero-site-leads .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 24px 0 0;
  padding: 0;
  list-style: none;
}
.vza-hero-site-leads .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.vza-hero-site-leads .vza-hero-pipeline {
  display: grid;
  gap: 8px;
  margin: 22px 0 0;
  padding: 0;
  list-style: none;
  max-width: 520px;
}
.vza-hero-site-leads .vza-hero-pipeline li {
  display: grid;
  grid-template-columns: 32px 1fr;
  gap: 12px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
  color: var(--vza-muted);
  font-size: 13px;
  font-weight: 600;
}
.vza-hero-site-leads .vza-hero-pipeline li span {
  display: grid;
  place-items: center;
  width: 32px;
  height: 32px;
  border-radius: 10px;
  background: linear-gradient(135deg, rgba(249,115,22,.25), rgba(121,242,255,.2));
  color: #fff;
  font-size: 12px;
  font-weight: 800;
}
.vza-hero-site-leads .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 28px;
}
.vza-hero-site-leads .nero-ai-btn {
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
.vza-hero-site-leads .nero-ai-btn:hover { transform: translateY(-2px); }
.vza-hero-site-leads .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vza-orange), #fbbf24);
  box-shadow: 0 18px 42px rgba(249, 115, 22, 0.25);
}
.vza-hero-site-leads .nero-ai-btn-secondary {
  color: var(--vza-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vza-hero-site-leads .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vza-shadow);
  transform: perspective(1100px) rotateY(2deg) rotateX(-1deg);
}
.vza-hero-site-leads .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vza-hero-site-leads .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vza-hero-site-leads .nero-ai-dots { display: flex; gap: 7px; }
.vza-hero-site-leads .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vza-hero-site-leads .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vza-hero-site-leads .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vza-hero-site-leads .nero-ai-dot:nth-child(3) { background: #34d399; }
.vza-hero-site-leads .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vza-hero-site-leads .nero-ai-window-body { padding: 16px; }
.vza-hero-site-leads .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vza-hero-site-leads .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vza-hero-site-leads .nero-ai-live-pill {
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
.vza-hero-site-leads .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vzaPulse 1.6s infinite;
}
@keyframes vzaPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vza-hero-site-leads .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vza-hero-site-leads .nero-ai-metric {
  padding: 12px 10px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vza-hero-site-leads .nero-ai-metric span {
  display: block;
  color: var(--vza-muted);
  font-size: 10px;
  font-weight: 700;
}
.vza-hero-site-leads .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 20px;
  line-height: 1;
}
.vza-hero-site-leads .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 10px;
}
.vza-hero-site-leads .vza-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 290px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(249, 115, 22, 0.18);
  background: radial-gradient(ellipse at 50% 35%, rgba(249,115,22,.1), rgba(6,10,24,.92) 72%);
}
.vza-hero-site-leads #vza-site-lead-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vza-hero-site-leads .nero-ai-task-stream { display: grid; gap: 8px; }
.vza-hero-site-leads .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vza-hero-site-leads .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(249,115,22,.14);
  color: #fdba74;
  font-size: 11px;
  font-weight: 800;
}
.vza-hero-site-leads .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vza-hero-site-leads .nero-ai-task span {
  color: var(--vza-muted);
  font-size: 11px;
}
.vza-hero-site-leads .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vza-hero-site-leads .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vza-hero-site-leads .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vza-hero-site-leads .nero-ai-dashboard { transform: none; }
  .vza-hero-site-leads .nero-ai-metrics-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 520px) {
  .vza-hero-site-leads .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
  .vza-hero-site-leads .nero-ai-metric:last-child { grid-column: 1 / -1; }
  .vza-hero-site-leads .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vza-hero-site-leads .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vza-hero-site-leads .nero-ai-status { grid-column: 2; width: fit-content; }
}
.vza-content{
  --vza-bg:#050711;--vza-bg2:#080b17;--vza-surface:rgba(255,255,255,.072);
  --vza-text:#e6edf7;--vza-muted:#9aa8bd;--vza-soft:#c7d2e5;--vza-heading:#fff;
  --vza-border:rgba(255,255,255,.10);--vza-accent:#f97316;--vza-cyan:#79f2ff;--vza-violet:#8b5cf6;--vza-green:#22c55e;
  --vza-btn-from:#2563eb;--vza-btn-to:#7c3aed;--vza-r:18px;--vza-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vza-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vza-content *,.vza-content *::before,.vza-content *::after{box-sizing:border-box}
.vza-content a{color:inherit}
.vza-content p{color:var(--vza-muted);line-height:1.72;margin:0 0 1em}
.vza-content p:last-child{margin-bottom:0}
.vza-content h2,.vza-content h3,.vza-content h4{color:var(--vza-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vza-content strong{color:var(--vza-soft)}
.vza-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vza-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vza-muted);font-size:14.5px;line-height:1.65}
.vza-content ul li::before{content:'›';position:absolute;left:0;color:var(--vza-accent);font-weight:700}
.vza-cnt{width:min(var(--vza-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vza-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vza-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vza-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vza-sh.vza-left{margin-left:0;text-align:left}
.vza-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vza-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vza-sh.vza-left p{margin-left:0}
.vza-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vza-accent);margin-bottom:14px}
.vza-gt{background:linear-gradient(92deg,#fff 0%,var(--vza-accent) 44%,var(--vza-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vza-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vza-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vza-intro-text{position:relative;padding-left:20px}
.vza-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vza-accent),var(--vza-violet))}
.vza-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--vza-muted);margin-bottom:1em}
.vza-intro-text p:last-child{margin-bottom:0;color:var(--vza-soft)}
.vza-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vza-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.vza-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vza-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vza-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vza-muted);line-height:1.4}
.vza-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vza-intro-grid{grid-template-columns:1fr;gap:36px}.vza-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vza-intro-kpi{grid-template-columns:1fr 1fr}}
.vza-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vza-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vza-toc a{display:inline-block;padding:9px 18px;background:var(--vza-surface);border:1px solid var(--vza-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vza-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important}
.vza-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vza-accent);background:rgba(121,242,255,.08)}
.vza-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vza-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.vza-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.vza-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vza-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vza-grid-2,.vza-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.vza-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vza-grid-3{grid-template-columns:1fr}}
.vza-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vza-table{width:100%;border-collapse:collapse;font-size:14px}
.vza-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vza-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.vza-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vza-text);vertical-align:top}
.vza-table tr:last-child td{border-bottom:none}
.vza-table tr:hover td{background:rgba(255,255,255,.03)}
.vza-flow{display:flex;flex-wrap:wrap;gap:8px;align-items:center;justify-content:center;margin:28px 0;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08)}
.vza-flow span{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(121,242,255,.1);color:var(--vza-accent);border:1px solid rgba(121,242,255,.2)}
.vza-flow .arr{color:var(--vza-muted);font-size:16px;padding:0 4px;background:none;border:none}
.vza-timeline{position:relative;padding-left:40px}
.vza-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vza-accent),var(--vza-violet));opacity:.35;border-radius:2px}
.vza-tl-item{position:relative;margin-bottom:32px}
.vza-tl-item:last-child{margin-bottom:0}
.vza-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vza-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vza-tl-item h3{font-size:17px;margin-bottom:8px}
.vza-tl-item p{font-size:14.5px;margin:0}
.vza-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vza-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vza-case-grid{grid-template-columns:1fr}}
.vza-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.vza-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.vza-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vza-green);margin-bottom:10px}
.vza-case-card h3{font-size:16px;margin-bottom:14px}
.vza-metric{display:flex;align-items:baseline;gap:8px;margin-top:8px}
.vza-metric .num{font-size:20px;font-weight:900;color:var(--vza-accent);flex-shrink:0}
.vza-metric .lbl{font-size:13px;color:var(--vza-muted)}
.vza-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vza-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vza-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vza-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vza-faq-q::after{content:'▾';font-size:13px;color:var(--vza-accent);flex-shrink:0;transition:transform .25s}
.vza-faq-item.open .vza-faq-q::after{transform:rotate(180deg)}
.vza-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vza-muted);line-height:1.72}
.vza-faq-item.open .vza-faq-a{max-height:800px;padding:0 24px 20px}
.vza-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.vza-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--vza-muted)}
.vza-cta-checklist li::before{content:'✓';color:var(--vza-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vza-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vza-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vza-btn-from),var(--vza-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
/* === БОРИС: prefix bec-, scoped внутри 

.vza-quiz{margin-top:28px;text-align:left}
.vza-quiz fieldset{border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:22px 24px;margin:0 0 16px;background:rgba(255,255,255,.04)}
.vza-quiz legend{font-size:15px;font-weight:700;color:#fff;margin-bottom:14px}
.vza-quiz label{display:flex;align-items:center;gap:10px;padding:10px 0;font-size:14px;color:var(--vza-muted);cursor:pointer}
.vza-quiz input{margin:0}
.vza-quiz-result{padding:20px 0}

.vza-link{text-decoration:underline;text-underline-offset:3px}
.vza-ol{padding-left:1.2em;color:var(--vza-muted);margin:0 0 1em}
.vza-ol li{margin-bottom:.45em;line-height:1.65}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-obrabotka-zayavok-s-sayta-page" role="main" tabindex="-1">

<section class="nero-ai-hero vza-hero-site-leads" id="vza-hero-site-leads" aria-labelledby="vza-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Nero Network · заявки с сайта · первая линия 24/7</p>
      <h1 id="vza-hero-title">AI-агент для первичной обработки заявок с сайта: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Ответ за 5–15 секунд, уточняющие вопросы и горячий лид в CRM — пока менеджеры не успевают, лиды остывают</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">5–15 сек на ответ</li>
        <li class="nero-ai-badge">Квалификация в чате</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
        <li class="nero-ai-badge">Аудит 30 мин</li>
      </ul>
      <ol class="vza-hero-pipeline" aria-label="Этапы первой линии">
        <li><span>1</span> Заявка с формы, чата или callback</li>
        <li><span>2</span> AI-диалог 24/7 — уточняем запрос</li>
        <li><span>3</span> Квалификация: бюджет, срок, гео</li>
        <li><span>4</span> Горячий лид и резюме в CRM</li>
      </ol>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="#audit-zayavok">Проверить, сколько заявок вы теряете</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает AI на сайте</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-обработки заявок с сайта">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Первая линия на сайте</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>AFRT</span>
              <strong>12 с</strong>
              <small>первый ответ</small>
            </div>
            <div class="nero-ai-metric">
              <span>Квалифицировано</span>
              <strong>+34%</strong>
              <small>демо-период</small>
            </div>
            <div class="nero-ai-metric">
              <span>Смена</span>
              <strong>24/7</strong>
              <small>ночь и выходные</small>
            </div>
          </div>

          <div class="vza-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vza-site-lead-canvas" role="img" aria-label="Анимация: заявки с сайта проходят AI-диалог и превращаются в горячий лид в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий заявок">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">FM</span>
              <div><strong>Новая заявка с формы</strong><span>UTM: yandex / cpc · лендинг услуги</span></div>
              <span class="nero-ai-status nero-ai-status--amber">вход</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI уточнил бюджет</strong><span>3 вопроса · score 0.82</span></div>
              <span class="nero-ai-status">диалог</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Лид в CRM</strong><span>amoCRM · задача менеджеру</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vza-content">
<section class="vza-intro nero-ai-section" id="intro" aria-label="Введение">
  <div class="vza-cnt">
    <div class="vza-intro-grid nero-ai-reveal">
      <div class="vza-intro-text">
        <p class="vza-eyebrow">Лонгрид · заявки с сайта · первая линия</p>
        <p># AI-агент для первичной обработки заявок с сайта: внедрение под ключ</p><p>Заявка с сайта — это не «ещё одна строка в CRM», а момент, когда клиент уже выбрал вас среди конкурентов. Если <strong>ai обработка заявок</strong> настроена как <strong>первая линия на сайте</strong>, ответ приходит за <strong>5–15 секунд</strong> даже ночью и в выходные: агент уточняет запрос, задаёт квалифицирующие вопросы и передаёт <strong>разогретый лид в CRM</strong> с контекстом диалога. Nero Network внедряет таких <strong>ai агентов для сайта</strong> под ключ — от аудита каналов до интеграции с amoCRM или Битрикс24, без подмены отдела продаж и без обещаний «волшебного ROI» без замера у вас.</p>
      </div>
      <div class="vza-intro-kpi" aria-label="Метрики первой линии">
        <div class="vza-kpi-card"><div class="kv">5–15 с</div><div class="kl">цель AFRT на сайте</div><div class="ks">первая линия AI</div></div>
        <div class="vza-kpi-card"><div class="kv">~4 ч</div><div class="kl">средний ответ на форму</div><div class="ks">Usedesk, 2024</div></div>
        <div class="vza-kpi-card"><div class="kv">24/7</div><div class="kl">ночь и выходные</div><div class="ks">без смены операторов</div></div>
        <div class="vza-kpi-card"><div class="kv">120–350k</div><div class="kl">старт внедрения</div><div class="ks">ориентир Nero Network</div></div>
      </div>
    </div>
  </div>
</section>
<div class="vza-toc-outer"><div class="vza-cnt"><nav class="vza-toc ym-toc" aria-label="Оглавление статьи">
<a href="#poteri-zayavok">Потери заявок</a>
<a href="#kak-rabotaet">Как работает</a>
<a href="#crm">CRM</a>
<a href="#etapy">Внедрение</a>
<a href="#ceny">Стоимость</a>
<a href="#keisy">Кейсы</a>
<a href="#faq">FAQ</a>
<a href="#audit-zayavok">Аудит заявок</a>
</nav></div></div>
<!-- INTERNAL-LINKS:INSERT -->
<section class="vza-section" id="poteri-zayavok">
<div class="vza-cnt">
<div class="vza-sh vza-left nero-ai-reveal"><h2>Почему заявки с сайта «остывают» и сколько лидов теряете без первой линии</h2></div>
<p class="nero-ai-reveal"><strong>Определение:</strong> «Остывший лид» — обращение, на которое бизнес ответил слишком поздно: клиент ушёл к конкуренту, передумал или перестал отвечать на звонки.</p>
<p class="nero-ai-reveal">Проблема не в том, что у вас «плохие менеджеры». Чаще виновата <strong>скорость первого контакта</strong> (AFRT — average first response time): заявки приходят в нерабочее время, в пик рекламы или когда все на встречах. CRM фиксирует лид, но диалог не начинается часами.</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Ночные и выходные заявки</h3>
</div>
<p class="nero-ai-reveal">Трафик с контекста и соцсетей не выключается в 18:00. Форма на лендинге, виджет чата и заявка на обратный звонок продолжают собирать контакты. Без <strong>ai бота для сайта</strong> или дежурной смены ответ откладывается до утра понедельника — а клиент к этому моменту уже получил реакцию у другого исполнителя.</p>
<p class="nero-ai-reveal">Для услуг, онлайн-школ и клиник ночной поток особенно заметен: человек сравнивает цены и программы «здесь и сейчас». <strong>Автоматизация заявок с сайта</strong> на первой линии не заменяет врача или методиста, но <strong>принимает обращение</strong>, собирает согласие на ПДн и готовит карточку к утренней смене.</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Время первого ответа и конверсия</h3>
</div>
<p class="nero-ai-reveal">Исследования по скорости ответа на лид давно показывают одно: <strong>чем быстрее первый контакт, тем выше шанс довести диалог до квалификации</strong>. Классический бенчмарк Drift (опрос <strong>433</strong> B2B-компаний, <strong>2017</strong>): только <strong>7%</strong> ответили в первые <strong>5 минут</strong>; <strong>55%</strong> не ответили в течение <strong>5 рабочих дней</strong> (<a href="https://www.salesloft.com/resources/blog/lead-response-survey" class="vza-link ym-link--accent">Salesloft / Drift</a>). Наблюдательные данные по звонкам (Oldroyd / InsideSales, <strong>2007</strong>) связывают контакт в <strong>5 минут</strong> против <strong>30 минут</strong> с существенно большими шансами квалификации — это <strong>не</strong> обещание «роста выручки в 21 раз», а аргумент за скорость (<a href="https://www.getpraktivo.com/blog/speed-to-lead-research-explained/" class="vza-link ym-link--accent">разбор формулировок</a>).</p>
<p class="nero-ai-reveal">В <strong>2024</strong> году по данным Usedesk среднее время <strong>первого ответа</strong> на обращения через <strong>форму на сайте (ФОС)</strong> в России — порядка <strong>4 часов</strong>; почта — около <strong>3 часов</strong>, мессенджеры — около <strong>1,5 часа</strong> (<a href="https://usedesk.ru/research-customer-service-2024" class="vza-link ym-link--accent">исследование клиентского сервиса Usedesk</a>). Пока вы «в норме отрасли», лид уже остыл.</p>
<p class="nero-ai-reveal">Тест <strong>114</strong> B2B-компаний (демо-формы на сайтах): <strong>более 99%</strong> не ответили в первые <strong>5 минут</strong>; среднее время ответа по email — <strong>11 ч 54 мин</strong>, по звонку — <strong>14 ч 29 мин</strong>; за <strong>5 минут</strong> не было <strong>ни одного</strong> звонка (<a href="https://www.workato.com/the-connector/lead-response-time-study/" class="vza-link ym-link--accent">Workato Lead Response Time Study</a>). Именно поэтому коммерческий фокус страницы — не абстрактное «внедрение ai в бизнес», а <strong>первичная обработка заявок</strong> в точке входа на сайте.</p>
<p class="nero-ai-reveal"><strong>Итог блока:</strong> без первой линии вы платите за клики и теряете часть лидов на задержке. Следующий шаг — понять, чем <strong>ai обработка заявок</strong> отличается от скриптового бота и «живого чата только днём».</p>
<div class="nero-ai-reveal"><div class="ym-cta-block ym-cta-block--primary" id="cta-poteri">
  <div class="ym-cta-block__icon" aria-hidden="true">⏱</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Проверить, сколько заявок вы теряете</p>
    <p class="ym-cta-block__sub">За 30 минут разберём каналы (форма, чат, callback), оценим задержку первого ответа по вашим данным и покажем, где обрывается цепочка до CRM. Без выдуманных процентов конверсии.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html(getenv('PRIMARY_CTA_LABEL') ?: 'Записаться на аудит потерь заявок'); ?></a>
    <p class="ym-cta-block__sub" style="margin-top:14px;margin-bottom:0;font-size:13px;"><a href="#audit-zayavok" class="ym-link ym-link--accent">Или пройти короткий квиз на странице →</a></p>
  </div>
</div></div>
</div></section>
<section class="vza-section" id="chto-takoe-ai">
<div class="vza-cnt">
<div class="vza-sh vza-left nero-ai-reveal"><h2>Что такое AI-обработка заявок с сайта (и чем отличается от «просто чат-бота»)</h2></div>
<p class="nero-ai-reveal"><strong>Определение:</strong> <strong>AI-обработка заявок с сайта</strong> — программный слой между точкой входа (форма, виджет чата, callback) и CRM: агент ведёт диалог на естественном языке, удерживает контекст сессии, извлекает поля лида и передаёт структурированные данные в воронку.</p>
<div class="nero-ai-reveal"><div class="vza-table-wrap"><table class="vza-table">
<tr><th>Критерий</th><th>Скриптовый чат-бот</th><th>Live chat (только люди)</th><th>AI-первая линия + человек</th></tr>
<tr><td>Первый ответ ночью</td><td>Часто шаблон или тишина</td><td>Обычно нет</td><td><strong>5–15 с</strong>, 24/7</td></tr>
<tr><td>Гибкость формулировок</td><td>Ветки по кнопкам</td><td>Высокая</td><td>Диалог + правила бизнеса</td></tr>
<tr><td>Квалификация</td><td>Ограничена сценарием</td><td>Зависит от оператора</td><td>3–5 вопросов по рубрике</td></tr>
<tr><td>CRM</td><td>Интеграция бывает слабой</td><td>Ручной ввод</td><td>Карточка + резюме диалога</td></tr>
<tr><td>Эскалация</td><td>Редко осмысленная</td><td>Нативная</td><td>По confidence, жалобе, политике</td></tr>
</table></div></div>
<p class="nero-ai-reveal"><strong>Нейросеть для обработки лидов</strong> в этом смысле — не «замена отдела продаж», а <strong>ai менеджер заявок</strong> на входе: приветствие, уточнение бюджета/срока/типа услуги, гео, запись на слот — и передача <strong>горячего</strong> контекста менеджеру.</p>
<p class="nero-ai-reveal">Тренд <strong>2026</strong> года — <strong>агентные сценарии</strong>: AI не только отвечает, но и <strong>выполняет действия</strong> (обновление CRM, задача, уведомление). У OpenAI для Business описаны <strong>workspace agents</strong>, в том числе сценарии работы с лидами и CRM-коннекторами (<a href="https://openai.com/index/introducing-workspace-agents-in-chatgpt/" class="vza-link ym-link--accent">Introducing workspace agents in ChatGPT</a>); для российского МСБ аналогичную логику собирают на <strong>YandexGPT</strong> + webhook в amoCRM/Битрикс24 (<a href="https://yandex.cloud/ru/blog/posts/2025/02/yandex-gpt-5-0" class="vza-link ym-link--accent">YandexGPT 5 в облаке</a>).</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Первичная обработка: приветствие → квалификация → передача в CRM</h3>
</div>
<p class="nero-ai-reveal">Типовой пайплайн (обобщение открытых кейсов и платформ):</p>
<ol class="vza-ol nero-ai-reveal"></ol>
<p class="nero-ai-reveal">Это и есть <strong>внедрение ai обработка заявок</strong> в прикладном смысле: не «чат ради чата», а <strong>первичная обработка заявок автоматизация</strong> с измеримым AFRT.</p>
<section id="ai-obrabotka-zayavok-s-sayta-boris-block" class="bza-root" aria-label="Анимация: квалификация заявки с сайта в диалоге и передача полей в CRM">
<style>
/* === БОРИС: prefix bza-, scoped внутри #ai-obrabotka-zayavok-s-sayta-boris-block === */
#ai-obrabotka-zayavok-s-sayta-boris-block.bza-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-obrabotka-zayavok-s-sayta-boris-block .bza-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-obrabotka-zayavok-s-sayta-boris-block .bza-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#2563eb;
  margin:0 0 14px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-ey::before{
  content:'';
  width:18px;height:2px;
  background:#2563eb;
  border-radius:1px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(37,99,235,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#1d4ed8;
  margin-top:1px;
  font-style:normal;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-pl-b{
  background:rgba(37,99,235,.08);
  color:#1d4ed8;
  border:1.5px solid rgba(37,99,235,.22);
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-pl-o{
  background:rgba(249,115,22,.08);
  color:#c2410c;
  border:1.5px solid rgba(249,115,22,.22);
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-obrabotka-zayavok-s-sayta-boris-block .bza-rgt{
  position:relative;
  background:linear-gradient(135deg,#eff6ff 0%,#dbeafe 38%,#f0fdf4 72%,#f8fafc 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-obrabotka-zayavok-s-sayta-boris-block .bza-rgt{min-height:380px;}
}
#bza-lead-qualify-canvas{
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
      <span class="bza-ey">Первичная обработка</span>
      <h3 class="bza-h3">Форма или чат на сайте → 3–5 вопросов → разогретый лид в CRM</h3>
      <ul class="bza-ul">
        <li><span class="bza-ic">1</span>Событие с формы, виджета или callback уходит на оркестратор за &lt;1 с</li>
        <li><span class="bza-ic">2</span>AI отвечает за 5–15 с и ведёт квалификацию на естественном языке</li>
        <li><span class="bza-ic">3</span>Structured output: контакт, intent, score и следующий шаг</li>
        <li><span class="bza-ic">↗</span>Спорная цена или жалоба — эскалация менеджеру с историей чата</li>
      </ul>
      <div class="bza-pills">
        <span class="bza-pl bza-pl-o">5–15 с AFRT</span>
        <span class="bza-pl bza-pl-g">24/7 первая линия</span>
        <span class="bza-pl bza-pl-b">amoCRM / Битрикс24</span>
      </div>
      <p class="bza-foot">Дальше — как устроены форма, чат и виджет на сайте →</p>
    </div>

    <div class="bza-rgt">
      <canvas
        id="bza-lead-qualify-canvas"
        aria-label="Анимация: заявка с сайта проходит AI-диалог квалификации и превращается в карточку лида в CRM"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bza-lead-qualify-canvas');
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
    form:'#3b82f6',
    chat:'#8b5cf6',
    call:'#f97316',
    ai:'#2563eb',
    aiGlow:'rgba(37,99,235,.18)',
    userBubble:'#e2e8f0',
    botBubble:'#dbeafe',
    botBorder:'#93c5fd',
    crm:'#0ea5e9',
    crmPanel:'#0f172a',
    green:'#22c55e',
    field:'#f0fdf4',
    fieldBdr:'#86efac',
    line:'rgba(37,99,235,.28)',
    warn:'#fbbf24'
  };

  var LOOP = 720;
  var DIALOG = [
    {who:'bot', text:'Здравствуйте! Чем помочь?'},
    {who:'user', text:'Нужен замер окон'},
    {who:'bot', text:'Город и срок?'},
    {who:'user', text:'Москва, до 2 недель'},
    {who:'bot', text:'Бюджет ориентир?'},
    {who:'user', text:'до 180 тыс.'}
  ];
  var CRM_FIELDS = ['Имя','Телефон','Город','Срок','Бюджет','Score'];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawSourceNode(cx,cy,r,clr,icon,label,pulse){
    rr(cx-r,cy-r,r*2,r*2,r*0.35,'#fff',clr,2);
    ctx.fillStyle=clr;
    ctx.font='bold 14px system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(icon,cx,cy+2);
    ctx.fillStyle=C.ink;
    ctx.font='9px Inter,system-ui,sans-serif';
    ctx.fillText(label,cx,cy+r+14);
    if(pulse>0){
      ctx.strokeStyle=clr;
      ctx.globalAlpha=0.25*(1-pulse);
      ctx.lineWidth=2;
      ctx.beginPath();
      ctx.arc(cx,cy,r+6+pulse*8,0,Math.PI*2);
      ctx.stroke();
      ctx.globalAlpha=1;
    }
  }

  function drawAiHub(cx,cy,w,h,t){
    rr(cx-w/2,cy-h/2,w,h,14,'rgba(37,99,235,.06)',C.ai,2);
    ctx.fillStyle=C.ai;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('AI · квалификация',cx,cy-h/2+20);
    var dots = 3;
    for(var i=0;i<dots;i++){
      var ph = (t*0.08+i*0.33)%1;
      ctx.beginPath();
      ctx.arc(cx-16+i*16, cy+4, 4+ph*3, 0, Math.PI*2);
      ctx.fillStyle=C.ai;
      ctx.globalAlpha=0.35+ph*0.5;
      ctx.fill();
      ctx.globalAlpha=1;
    }
    var sec = Math.max(0, 15 - Math.floor((t%LOOP)/48));
    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.fillText('AFRT ~'+sec+' с',cx,cy+h/2-12);
  }

  function drawBubble(x,y,text,isBot,alpha,maxW){
    ctx.globalAlpha=alpha||1;
    ctx.font='9px Inter,system-ui,sans-serif';
    var words=text.split(' ');
    var lines=[], line='';
    var mw=maxW||110;
    words.forEach(function(w){
      var test=line?line+' '+w:w;
      if(ctx.measureText(test).width>mw){ lines.push(line); line=w; }
      else line=test;
    });
    if(line) lines.push(line);
    var lh=13, pad=8;
    var bh=lines.length*lh+pad*2;
    var bw=mw+pad*2;
    var bx=isBot?x:x-bw;
    rr(bx,y,bw,bh,10,isBot?C.botBubble:C.userBubble,isBot?C.botBorder:C.soft,1);
    ctx.fillStyle=C.ink;
    ctx.textAlign='left';
    lines.forEach(function(ln,i){
      ctx.fillText(ln,bx+pad,y+pad+12+i*lh);
    });
    ctx.globalAlpha=1;
    return {w:bw,h:bh};
  }

  function drawCrmCard(x,y,w,h,filled,notifyAlpha){
    rr(x,y,w,h,12,C.crmPanel,'#334155',2);
    rr(x,y,w,26,12,C.crm,'#0284c7',0);
    ctx.fillStyle='#fff';
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('CRM · новый лид',x+10,y+17);
    ctx.textAlign='right';
    ctx.fillStyle=C.green;
    ctx.fillText('квалифицирован',x+w-10,y+17);

    var fy=y+34, gap=5;
    CRM_FIELDS.forEach(function(f,i){
      var done=i<filled;
      rr(x+8,fy,w-16,22,5,done?C.field:'rgba(255,255,255,.05)',done?C.fieldBdr:'rgba(255,255,255,.12)',1);
      ctx.fillStyle=done?'#166534':'rgba(226,232,240,.55)';
      ctx.font=(done?'bold ':'')+'9px Inter,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(f,x+14,fy+14);
      if(done){
        ctx.fillStyle=C.green;
        ctx.textAlign='right';
        ctx.fillText('✓',x+w-14,fy+14);
      }
      fy+=22+gap;
    });

    if(notifyAlpha>0.05){
      ctx.globalAlpha=notifyAlpha;
      rr(x+w-8,y-28,118,24,8,C.warn,C.ink,1);
      ctx.fillStyle=C.ink;
      ctx.font='bold 9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText('Менеджеру: Telegram',x+w+51,y-12);
      ctx.globalAlpha=1;
    }
  }

  function drawConnector(x1,y1,x2,y2,alpha,dash){
    ctx.globalAlpha=alpha||0.45;
    ctx.strokeStyle=C.line;
    ctx.lineWidth=1.5;
    if(dash) ctx.setLineDash([5,5]);
    ctx.beginPath();
    ctx.moveTo(x1,y1);
    ctx.lineTo(x2,y2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    ctx.clearRect(0,0,W,H);

    var srcY = H*0.2;
    var hubX = W*0.42, hubY = H*0.52;
    var chatX = W*0.58, chatTop = H*0.14;
    var crmX = W*0.78, crmY = H*0.22;
    var crmW = Math.min(140, W*0.22);
    var crmH = CRM_FIELDS.length*27+40;

    var activeSrc = Math.floor(t/180)%3;
    var pulse = (t%40)/40;
    var sources = [
      {x:W*0.12,y:srcY,clr:C.form,icon:'▤',label:'Форма'},
      {x:W*0.12,y:srcY+56,clr:C.chat,icon:'◉',label:'Чат'},
      {x:W*0.12,y:srcY+112,clr:C.call,icon:'☎',label:'Callback'}
    ];
    sources.forEach(function(s,i){
      drawSourceNode(s.x,s.y,22,s.clr,s.icon,s.label,i===activeSrc?pulse:0);
      if(i===activeSrc){
        drawConnector(s.x+28,s.y,hubX-50,hubY,0.5+0.3*Math.sin(t*0.1),true);
      }
    });

    drawAiHub(hubX,hubY,100,72,t);

    var msgPhase = Math.floor(t/55);
    var visible = Math.min(DIALOG.length, msgPhase);
    var by=chatTop;
    for(var m=0;m<visible;m++){
      var d=DIALOG[m];
      var fadeIn = m===visible-1 ? Math.min(1,(t%55)/12) : 1;
      var b=drawBubble(chatX,by,d.text,d.who==='bot',fadeIn);
      by+=b.h+8;
    }

    if(visible>=4){
      drawConnector(hubX+55,hubY,crmX,crmY+crmH/2,0.35+0.2*Math.sin(t*0.08),true);
    }

    var fillCount = 0;
    if(t>380) fillCount=1;
    if(t>440) fillCount=2;
    if(t>500) fillCount=3;
    if(t>540) fillCount=4;
    if(t>580) fillCount=5;
    if(t>620) fillCount=6;

    var cardAlpha = t>360?Math.min(1,(t-360)/40):0;
    if(cardAlpha>0){
      ctx.globalAlpha=cardAlpha;
      var notifyA = t>640?Math.min(1,(t-640)/30):0;
      drawCrmCard(crmX-crmW/2,crmY,crmW,crmH,fillCount,notifyA);
      ctx.globalAlpha=1;
    }

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('демо-сценарий · не реальные данные',W/2,H-10);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>
</div></section>
<section class="vza-section vza-section-alt" id="kak-rabotaet">
<div class="vza-cnt">
<div class="vza-sh vza-left nero-ai-reveal"><h2>Как работает AI-агент на сайте: форма, чат и виджет</h2></div>
<p class="nero-ai-reveal"><strong>Коротко:</strong> один и тот же <strong>ai консультант на сайт</strong> может стартовать из формы («спасибо, уточним детали в чате»), из постоянного виджета или после клика «написать в чат» на карточке услуги.</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Сценарии вопросов и квалификация лида</h3>
</div>
<p class="nero-ai-reveal">Сценарий настраивается под нишу:</p>
<ul class="nero-ai-reveal"><li><strong>Услуги B2C</strong> (ремонт, окна, дизайн): тип объекта, площадь/объём, срок, город, готовность к замеру/встрече.</li><li><strong>Онлайн-школа:</strong> программа, уровень, формат, бюджет, контакт для связи куратора.</li><li><strong>Клиника:</strong> запись, направление, удобное время — <strong>без</strong> диагнозов и обещаний результата лечения; спорное — только эскалация на администратора.</li></ul>
<p class="nero-ai-reveal">В кейсе интегратора Neuron Group (<strong>2023</strong>) для производства пластиковых окон <strong>ai менеджер заявок</strong> на Tilda, Telegram, WhatsApp и amoCRM закрывал приветствие, квалификацию, FAQ и запись на замер; до внедрения в материале указано среднее время реакции <strong>4–6 часов</strong> при <strong>20–30</strong> лидах в день (<a href="https://neuron-group.ru/cases/ii-menedzher/" class="vza-link ym-link--accent">кейс Neuron Group</a>). Цифры — из кейса интегратора, не универсальная гарантия для любого бизнеса.</p>
<p class="nero-ai-reveal">Международный ориентир по квалификации в AI-чате: медиана time-to-qualification порядка <strong>2 мин 47 с</strong> (агрегатор бенчмарков, <strong>январь 2025</strong>, <a href="https://www.thestarrconspiracy.com/insights/benchmarks/ai-chatbot-lead-qualification-benchmarks-2025" class="vza-link ym-link--accent">The Starr Conspiracy</a>).</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Ответ за 5–15 секунд (ночь и выходные)</h3>
</div>
<p class="nero-ai-reveal">Коммерческое обещание Nero Network для первой линии — <strong>предсказуемый SLA на первый ответ в секундах</strong>, а не часы. Для сравнения: в отчёте Comm100 (<strong>2025</strong>) среднее <strong>response time</strong> live chat — <strong>44,8 с</strong>; доля чатов, обработанных ботом, — около <strong>73,8%</strong> (<a href="https://www.comm100.com/wp-content/uploads/2025/03/application/pdf/Comm100-Live-Chat-Benchmark-Report-2025.pdf" class="vza-link ym-link--accent">Comm100 Live Chat Benchmark 2025</a>). AI-агент на сайте стремится уложиться в коридор <strong>5–15 с</strong> на старт диалога после события на сайте — включая ночь и выходные, когда менеджеры недоступны.</p>
<p class="nero-ai-reveal"><strong>Чат для обработки заявок на сайте</strong> полезен, когда:</p>
<ul class="nero-ai-reveal"><li>есть всплески трафика с рекламы;</li><li>нужен единый тон и скрипт квалификации;</li><li>важно не терять лиды из формы, если пользователь не дождался звонка.</li></ul>
</div></section>
<section class="vza-section vza-section-alt" id="crm">
<div class="vza-cnt">
<div class="vza-sh vza-left nero-ai-reveal"><h2>Интеграция с CRM: горячий лид без отдельного «лендинга под CRM»</h2></div>
<p class="nero-ai-reveal">Страница про <strong>ai обработка заявок с crm</strong>, а не про настройку одной конкретной CRM «от и до». Интеграция — этап передачи лида; углубленные материалы по отдельным стекам (только amoCRM, только почта в CRM, 1С/ERP) — соседние посадочные, чтобы не размывать интент «заявка с сайта».</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Какие поля и статусы передаём</h3>
</div>
<p class="nero-ai-reveal">Типовой набор при <strong>интеграции ai обработка заявок</strong>:</p>
<ul class="nero-ai-reveal"><li>контактные поля (телефон, email, имя — после согласия на ПДн);</li><li>источник и UTM;</li><li>суть запроса и теги (intent, продукт, гео);</li><li>стадия («новый», «квалифицирован», «нужен замер», «передан менеджеру»);</li><li><strong>резюме диалога</strong> в примечании — не только «новый лид», а контекст для звонка.</li></ul>
<p class="nero-ai-reveal">В кейсе Strela Digital (медоборудование, Workspace.ru) чат квалифицирует намерение, данные уходят через очередь в Bitrix24 с повторными попытками доставки; ПДн собираются <strong>отдельной формой</strong>, не из свободного текста (<a href="https://workspace.ru/cases/ai-sales-assistant-for-medical-equipment-crm-integration/" class="vza-link ym-link--accent">кейс Strela</a>). Для Nero Network это образец надёжности: <strong>очередь доставки в CRM</strong>, а не «один раз отправили webhook и забыли».</p>
<p class="nero-ai-reveal">Материал Битрикс24 Journal про ИИ-консультанта показывает ту же логику: уточнение параметров заказа, автозаполнение полей сделки, подключение менеджера на финале (<a href="https://www.bitrix24.ru/journal/ai-consultant/" class="vza-link ym-link--accent">ИИ-консультант на ChatGPT</a>). Платформа Битрикс24 развивает <strong>бот-платформу</strong> с API/webhook для AI-агентов внутри портала (<a href="https://www.bitrix24.ru/features/automatization/bot-platform/" class="vza-link ym-link--accent">обзор автоматизации</a>).</p>
<p class="nero-ai-reveal">Поддерживаемые CRM в проектах Nero Network: <strong>amoCRM</strong>, <strong>Битрикс24</strong>, <strong>RetailCRM</strong> — через API (<code>crm.lead.add</code>, amoCRM v4 <code>leads</code> + note с транскриптом).</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Уведомление менеджеру и эскалация на человека</h3>
</div>
<p class="nero-ai-reveal">После записи в CRM:</p>
<ul class="nero-ai-reveal"><li>push в Telegram или уведомление в мобильном приложении CRM;</li><li>задача «перезвонить в течение N минут» с приоритетом по score;</li><li>при <code>escalate</code> или низкой уверенности модели — <strong>human-in-the-loop</strong>: бот не обещает скидку, срок вне политики или медицинский результат.</li></ul>
<p class="nero-ai-reveal">Кейс MMP Group (Авито + Bitrix24 через n8n): <strong>24/7</strong> первичная обработка, диалог, контакт, лид в CRM и <strong>резюме для менеджера</strong> (<a href="https://mmp-group.ru/portfolio/crm/ai-agent-avito-bitrix24/" class="vza-link ym-link--accent">портфолио MMP Group</a>). Логика канала близка к заявке с площадки и к форме на сайте: скорость реакции решает, останется ли клиент в диалоге.</p>
</div></section>
<section class="vza-section vza-section-alt" id="etapy">
<div class="vza-cnt">
<div class="vza-sh vza-left nero-ai-reveal"><h2>Внедрение под ключ: этапы, сроки и что входит в услугу</h2></div>
<p class="nero-ai-reveal"><strong>ai обработка заявок под ключ</strong> в Nero Network — это не «купить виджет», а связка <strong>сайт → AI → CRM → аналитика</strong> с пилотом и донастройкой.</p>
<div class="nero-ai-reveal"><div class="vza-table-wrap"><table class="vza-table">
<tr><th>Этап</th><th>Содержание</th></tr>
<tr><td>1. Аудит</td><td>Каналы заявок (форма, виджет, callback), карта полей CRM, правила «горячего» лида</td></tr>
<tr><td>2. База знаний</td><td>FAQ, диапазоны цен, запретные формулировки, скрипты эскалации</td></tr>
<tr><td>3. Интеграция сайта</td><td>Webhook на оркестратор (n8n / Make / лёгкий backend)</td></tr>
<tr><td>4. AI-слой</td><td>YandexGPT 5 (РФ, персональные данные) или OpenAI/Claude при согласованной политике хранения; system prompt + JSON-schema ответа</td></tr>
<tr><td>5. CRM и уведомления</td><td>Запись лида, задача, события аналитики (<code>ai_first_response_ms</code>, <code>ai_qualified_lead</code>)</td></tr>
<tr><td>6. Пилот 2–4 недели</td><td>Логи, выборочная модерация спорных ответов, правки по feedback менеджеров</td></tr>
<tr><td>7. Сопровождение</td><td>Доработка сценариев, сезонные акции, расширение на мессенджеры</td></tr>
</table></div></div>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Аудит каналов заявок (лид-магнит 30 минут)</h3>
</div>
<p class="nero-ai-reveal">CTA страницы: <strong>«Проверить, сколько заявок вы теряете»</strong>. На <strong>аудит потерь заявок</strong> за <strong>30 минут</strong> (формат лид-магнита из контент-плана) смотрим:</p>
<ul class="nero-ai-reveal"><li>фактический <strong>AFRT</strong> по CRM и коллтрекингу;</li><li>долю лидов без первого контакта за 24 часа;</li><li>ночные и выходные пики;</li><li>где обрывается цепочка «форма → звонок → сделка».</li></ul>
<p class="nero-ai-reveal">Методика честная: без выдуманных процентов конверсии — только ваши данные плюс отраслевые бенчмарки (Usedesk, Workato) для контекста.</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Настройка, обучение на FAQ, тестовый период</h3>
</div>
<p class="nero-ai-reveal"><strong>Настройка ai обработка заявок</strong> включает:</p>
<ul class="nero-ai-reveal"><li>согласование тона (на «вы» / на «ты», отраслевой жаргон);</li><li>eval-loop по аналогии с практикой OpenAI inbound sales assistant: менеджер правит черновики → улучшение качества (в материале OpenAI указан рост точности первых ответов с <strong>60% до 98%+</strong> за недели — <strong>внутренняя метрика вендора</strong>, не обещание Nero Network) (<a href="https://openai.com/index/openai-inbound-sales-assistant/" class="vza-link ym-link--accent">OpenAI inbound sales assistant</a>);</li><li>тестовые диалоги до включения на продакшен-трафик.</li></ul>
<p class="nero-ai-reveal"><strong>Как внедрить ai обработка заявок</strong> на практике: начать с одного канала (например, форма + чат на главной услуги), замерить AFRT «до», включить пилот, сравнить долю квалифицированных лидов и эскалаций.</p>
<p class="nero-ai-reveal">Дополнительно: <strong>ai лидогенерация</strong> на сайте усиливается, когда агент не только отвечает, но и <strong>предлагает следующий шаг</strong> (запись, демо, чек-лист) в рамках политики компании.</p>
<div class="nero-ai-reveal"><aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
    <p class="ym-cta-block__sub">Если собственнику или маркетологу важно разобраться в промптах, webhook и human-in-the-loop до подписания ТЗ — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI'); ?></a>. Это ускоряет согласование сценариев квалификации на сайте.</p>
  </div>
</aside></div>
</div></section>
<section class="vza-section" id="ceny">
<div class="vza-cnt">
<div class="vza-sh vza-left nero-ai-reveal"><h2>Сколько стоит AI-обработка заявок для бизнеса</h2></div>
<p class="nero-ai-reveal"><strong>Ориентир из продуктовой матрицы Nero Network:</strong> старт внедрения <strong>120–350 тыс. ₽</strong> плюс поддержка и доработка сценариев. Итоговая <strong>ai обработка заявок цена</strong> зависит от сложности интеграций и числа каналов, а не от «количества слов в боте».</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Ориентир чека 120–350 тыс. ₽ и факторы цены</h3>
</div>
<p class="nero-ai-reveal">На стоимость влияют:</p>
<ul class="nero-ai-reveal"><li>число точек входа (только сайт или сайт + Telegram + WhatsApp + Авито);</li><li>глубина интеграции CRM (поля, воронки, роботы);</li><li>требования к хранению логов и ПДн в РФ;</li><li>объём базы знаний и ветвлений квалификации;</li><li>необходимость очереди доставки и резервных каналов (SMTP, повтор webhook).</li></ul>
<p class="nero-ai-reveal"><strong>ai обработка заявок для бизнеса</strong> в сегменте МСБ обычно дешевле, чем содержание ночной смены операторов круглый год — но сравнение качественное: считают не только ФОТ, а <strong>стоимость пропущенного лида</strong> при ответе через 4+ часа (контекст Usedesk по ФОС).</p>
<p class="nero-ai-reveal"><strong>ai обработка заявок для малого бизнеса</strong> чаще стартует с одного виджета на Tilda/WordPress и одной CRM — без омниканального зоопарка на первом этапе.</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Поддержка и доработка сценариев</h3>
</div>
<p class="nero-ai-reveal">После запуска:</p>
<ul class="nero-ai-reveal"><li>мониторинг галлюцинаций и ухода от скрипта;</li><li>обновление FAQ при смене прайса или акций;</li><li>отчёты по AFRT, % квалифицированных лидов, доле эскалаций;</li><li>развитие в сторону <strong>внедрение ai агентов</strong> в соседние процессы — только после стабилизации первой линии на сайте, чтобы не размывать эффект.</li></ul>
</div></section>
<section class="vza-section" id="keisy">
<div class="vza-cnt">
<div class="vza-sh vza-left nero-ai-reveal"><h2>Кейсы и примеры внедрения (услуги, онлайн-школы, клиники)</h2></div>
<p class="nero-ai-reveal">Ниже — <strong>публичные</strong> примеры с указанием источника и года. Это не портфолио Nero Network, а доказательство, что <strong>примеры внедрения ai</strong> и <strong>ai кейсы внедрения</strong> в РФ уже описаны интеграторами (независимый аудит редок).</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Типовые метрики до/после (без выдуманного ROI)</h3>
</div>
<div class="nero-ai-reveal"><div class="vza-table-wrap"><table class="vza-table">
<tr><th>Источник</th><th>Что измеряли</th><th>Результат (из материала)</th></tr>
<tr><td>Neuron Group, окна, 2023</td><td>время реакции на лид</td><td>было <strong>4–6 ч</strong> (в кейсе)</td></tr>
<tr><td>Gambit Lab, Workspace.ru</td><td>скорость первичной обработки</td><td><strong>98%</strong> заявок за <strong>1 мин</strong> vs <strong>15 мин</strong> до внедрения (кейс интегратора)</td></tr>
<tr><td>OpenAI inbound assistant</td><td>точность первых ответов</td><td><strong>60% → 98%+</strong> за недели (метрика вендора)</td></tr>
<tr><td>Workato, 114 B2B</td><td>ответ на demo-заявку</td><td><strong>>99%</strong> медленнее <strong>5 мин</strong></td></tr>
</table></div></div>
<p class="nero-ai-reveal"><strong>Пример внедрения ai обработка заявок</strong> для услуг: сценарий «категория → вопросы → рекомендация → эскалация» (Gambit Lab, сайт React + мессенджеры, <a href="https://workspace.ru/cases/avtomatizaciya-prodazh-cherez-messendzhery-i-sayt-ii-menedzher-v-samopisnoy-crm/" class="vza-link ym-link--accent">кейс на Workspace.ru</a>).</p>
<p class="nero-ai-reveal">Для <strong>клиник</strong> релевантен кейс Strela: разделение чата и формы согласия ПДн, доставка в CRM через очередь — модель, которую Nero Network переносит в проекты с записью к врачу <strong>без</strong> постановки диагноза в чате.</p>
<p class="nero-ai-reveal">Для <strong>онлайн-школ</strong> — логика Битрикс24 Journal: сбор параметров обучения, карточка сделки, финальный контакт менеджера.</p>
<p class="nero-ai-reveal">Международный контекст: OpenAI продвигает inbound-обработку заявок на ChatGPT Business/Enterprise с handoff к sales (<a href="https://openai.com/business/" class="vza-link ym-link--accent">OpenAI Business</a>) — тренд <strong>агентов, которые действуют</strong>, а не только генерируют текст.</p>
<p class="nero-ai-reveal"><strong>ai обработка заявок кейсы</strong> на лендинге Nero Network дополняются <strong>вашим</strong> пилотным замером AFRT — это сильнее любого чужого процента.</p>
</div></section>
<section class="vza-section vza-section-alt" id="menedzher-vs-ai">
<div class="vza-cnt">
<div class="vza-sh vza-left nero-ai-reveal"><h2>Менеджер vs AI-первая линия: что оставить людям</h2></div>
<div class="nero-ai-reveal"><div class="vza-table-wrap"><table class="vza-table">
<tr><th>Задача</th><th>AI-первая линия</th><th>Менеджер / эксперт</th></tr>
<tr><td>Мгновенный ответ 24/7</td><td>✅</td><td>❌ без смен</td></tr>
<tr><td>Уточнение типовых параметров</td><td>✅</td><td>✅</td></tr>
<tr><td>Переговоры о скидке вне политики</td><td>❌</td><td>✅</td></tr>
<tr><td>Сложная B2B-сделка</td><td>частично (сбор ТЗ)</td><td>✅</td></tr>
<tr><td>Медицинские рекомендации</td><td>❌</td><td>✅ врач</td></tr>
<tr><td>Юридически значимые обещания</td><td>❌</td><td>✅</td></tr>
<tr><td>Конфликт и нестандарт</td><td>эскалация</td><td>✅</td></tr>
</table></div></div>
<p class="nero-ai-reveal"><strong>ai менеджер заявок</strong> снимает с людей рутину «переспросить телефон в третий раз» и «ответить в 02:00», но <strong>не</strong> снимает ответственность за цену, договор и экспертизу.</p>
<div class="vza-card nero-ai-reveal" style="margin-bottom:20px"><h3>Ограничения: ПДн, медицина, сложные сделки</h3>
</div>
<p class="nero-ai-reveal"><strong>152-ФЗ:</strong> сбор телефона, email, ФИО и текста переписки — обработка персональных данных. Нужно <strong>конкретное, информированное и однозначное согласие</strong> (официальный текст закона на <a href="https://mintrud.gov.ru/docs/laws/130" class="vza-link ym-link--accent">сайте Минтруда</a>), политика конфиденциальности, учёт уведомления РКН; для мессенджеров отдельно оценивают трансграничную передачу (практики на <a href="https://vc.ru/legal/1598826-sbor-personalnyh-dannyh-cherez-chat-bot" class="vza-link ym-link--accent">vc.ru</a> и профильных разборах).</p>
<p class="nero-ai-reveal"><strong>Медицина:</strong> AI годится для записи, режима работы, подготовки к приёму; <strong>нельзя</strong> подменять врача в диагностике и обещаниях результата лечения.</p>
<p class="nero-ai-reveal"><strong>Образование и юристы:</strong> осторожность с гарантиями трудоустройства, «100% выигрыш дела» и автоматическими договорами — только шаблоны после проверки юристом и эскалация.</p>
<p class="nero-ai-reveal">Возражение «бот отпугнёт» закрывается контрастом: молчание <strong>~4 часа</strong> на форме (Usedesk) vs ответ за секунды + кнопка «позвать менеджера». Возражение «ошибётся в цене» — <strong>запрет автообещаний</strong> и модерация.</p>
</div></section>
<section class="vza-section vza-section-alt" id="faq"><div class="vza-cnt">
<div class="vza-sh nero-ai-reveal"><h2>FAQ по AI-обработке заявок с сайта</h2></div>
<div class="vza-faq nero-ai-reveal">
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI отдел продаж?</div><div class="vza-faq-a"><p>Нет. Это <strong>первая линия</strong> и ночной дежурный: квалификация, FAQ, передача в CRM. Закрытие сделки остаётся за людьми.</p></div></div>
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Чем ai агент для сайта лучше скриптового бота?</div><div class="vza-faq-a"><p>Понимает перефразировки, ведёт контекст, извлекает поля в JSON, эскалирует по правилам. Скриптовый бот дешевле, но ломается на «человеческой» формулировке.</p></div></div>
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли отдельная страница про amoCRM?</div><div class="vza-faq-a"><p>Интеграция с amoCRM и Битрикс24 входит в проект; углублённый продуктовый фокус на одной CRM — отдельный материал, чтобы не путать интент «заявка с сайта» и «настройка CRM».</p></div></div>
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько длится внедрение?</div><div class="vza-faq-a"><p>Зависит от каналов; у части интеграторов на рынке заявляют запуск <strong>5–7 дней</strong> для простого бота в CRM — у Nero Network реалистичнее ориентир с аудитом и пилотом <strong>2–4 недели</strong> для устойчивого качества.</p></div></div>
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Где хранятся диалоги?</div><div class="vza-faq-a"><p>По согласованной политике: РФ-контур (Yandex Cloud) или иностранный провайдер при явном согласии и оценке рисков; журнал нужен для разбора спорных кейсов.</p></div></div>
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Что если модель «галлюцинирует»?</div><div class="vza-faq-a"><p>База знаний, ограничение тем, JSON-schema, human_review на низкой confidence, запрет цен вне прайс-диапазона.</p></div></div>
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли для Авито и мессенджеров?</div><div class="vza-faq-a"><p>Да, логика та же, что у формы на сайте (см. кейсы MMP Group, материал Битрикс24). Старт рекомендуем с сайта, затем расширение.</p></div></div>
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Какие метрики успеха смотреть?</div><div class="vza-faq-a"><p>AFRT, % лидов с первым контактом <5 мин, доля квалифицированных, доля эскалаций, качество заметок в CRM (опрос менеджеров).</p></div></div>
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Входит ли внедрение нейросетей в бизнес только в продажи?</div><div class="vza-faq-a"><p>Нет, но эта страница про узкий узел — <strong>заявки с сайта</strong>. Родовые запросы <strong>внедрение ai в бизнес</strong> и <strong>внедрение нейросетей в бизнес</strong> упоминаем только с привязкой к первой линии, без размывания темы.</p></div></div>
<div class="vza-faq-item"><div class="vza-faq-q" tabindex="0" role="button" aria-expanded="false">Безопасно ли для клиник и школ?</div><div class="vza-faq-a"><p>Да, при разграничении ролей AI и специалиста, отдельном согласии ПДн и запрете медицинских/юридических гарантий в автомате.

---</p></div></div>
</div></div></section>
<section class="nero-ai-section nero-ai-section-alt" id="audit-zayavok" aria-labelledby="audit-zayavok-title">
  <div class="nero-ai-container">
    <div class="ym-cta-block ym-cta-block--dual" style="text-align:left;max-width:920px;margin:0 auto;">
      <p class="vza-eyebrow" style="display:inline-flex;padding:6px 14px;border-radius:999px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;background:rgba(121,242,255,.1);border:1px solid rgba(121,242,255,.25);color:#79f2ff;margin:0 0 12px;">Квиз · 4 шага · ~2 минуты</p>
      <h2 id="audit-zayavok-title">Проверьте, сколько заявок вы теряете</h2>
      <p class="ym-cta-block__sub" style="margin-left:0;max-width:none;">Ответьте на четыре вопроса — в конце предложим <strong>аудит потерь заявок за 30 минут</strong>: AFRT, ночные пики и точки обрыва до CRM.</p>

      <form class="vza-quiz" id="vza-loss-quiz" novalidate>
        <fieldset class="vza-quiz-step" data-step="1">
          <legend><strong>Шаг 1.</strong> Откуда чаще приходят заявки?</legend>
          <label><input type="radio" name="vza_channel" value="form" required> Форма на сайте</label>
          <label><input type="radio" name="vza_channel" value="chat"> Виджет чата</label>
          <label><input type="radio" name="vza_channel" value="callback"> Обратный звонок</label>
          <label><input type="radio" name="vza_channel" value="mix"> Несколько каналов</label>
        </fieldset>
        <fieldset class="vza-quiz-step" data-step="2" hidden>
          <legend><strong>Шаг 2.</strong> Есть ли заметный поток ночью и в выходные?</legend>
          <label><input type="radio" name="vza_night" value="yes" required> Да, регулярно</label>
          <label><input type="radio" name="vza_night" value="sometimes"> Иногда</label>
          <label><input type="radio" name="vza_night" value="no"> Почти нет</label>
        </fieldset>
        <fieldset class="vza-quiz-step" data-step="3" hidden>
          <legend><strong>Шаг 3.</strong> Как быстро обычно отвечаете на новую заявку?</legend>
          <label><input type="radio" name="vza_afrt" value="under5" required> До 5 минут</label>
          <label><input type="radio" name="vza_afrt" value="under60"> До 1 часа</label>
          <label><input type="radio" name="vza_afrt" value="hours"> Несколько часов</label>
          <label><input type="radio" name="vza_afrt" value="nextday"> На следующий рабочий день</label>
        </fieldset>
        <fieldset class="vza-quiz-step" data-step="4" hidden>
          <legend><strong>Шаг 4.</strong> Куда попадают лиды после сайта?</legend>
          <label><input type="radio" name="vza_crm" value="amocrm" required> amoCRM</label>
          <label><input type="radio" name="vza_crm" value="bitrix"> Битрикс24</label>
          <label><input type="radio" name="vza_crm" value="other"> Другая CRM / таблица</label>
          <label><input type="radio" name="vza_crm" value="none"> Пока без CRM</label>
        </fieldset>
        <div class="vza-quiz-result" id="vza-quiz-result" hidden>
          <p class="ym-cta-block__headline" id="vza-quiz-result-title">Похоже, вы теряете лиды на скорости ответа</p>
          <p class="ym-cta-block__sub" id="vza-quiz-result-text" style="margin-left:0;max-width:none;">На бесплатном созвоне за 30 минут разберём ваши каналы и предложим пилот: один вход (форма или чат), замер AFRT «до/после», передача в CRM без омниканального зоопарка.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Записаться на аудит потерь заявок</a>
        </div>
        <div class="vza-quiz-actions" style="display:flex;flex-wrap:wrap;gap:12px;margin-top:20px;">
          <button type="button" class="nero-ai-btn nero-ai-btn-secondary vza-quiz-prev" hidden>Назад</button>
          <button type="button" class="nero-ai-btn nero-ai-btn-primary vza-quiz-next">Далее</button>
        </div>
      </form>
    </div>
  </div>
</section>
<script>
(function () {
  var form = document.getElementById('vza-loss-quiz');
  if (!form) return;
  var steps = form.querySelectorAll('.vza-quiz-step');
  var result = document.getElementById('vza-quiz-result');
  var title = document.getElementById('vza-quiz-result-title');
  var text = document.getElementById('vza-quiz-result-text');
  var nextBtn = form.querySelector('.vza-quiz-next');
  var prevBtn = form.querySelector('.vza-quiz-prev');
  var i = 0;
  function showStep(n) {
    steps.forEach(function (el, idx) { el.hidden = idx !== n; });
    prevBtn.hidden = n === 0;
    nextBtn.textContent = n === steps.length - 1 ? 'Показать результат' : 'Далее';
    if (n < steps.length) { result.hidden = true; nextBtn.hidden = false; }
  }
  function currentFieldset() { return steps[i]; }
  function selected(name) {
    var fs = currentFieldset();
    return fs && fs.querySelector('input[name="' + name + '"]:checked');
  }
  nextBtn.addEventListener('click', function () {
    var fs = currentFieldset();
    if (!fs || !fs.querySelector('input:checked')) { fs && fs.reportValidity && fs.reportValidity(); return; }
    if (i < steps.length - 1) { i++; showStep(i); return; }
    var afrt = (form.querySelector('input[name="vza_afrt"]:checked') || {}).value;
    var night = (form.querySelector('input[name="vza_night"]:checked') || {}).value;
    if (afrt === 'under5' && night === 'no') {
      title.textContent = 'Скорость ответа уже сильная — усилим квалификацию';
      text.textContent = 'Обсудим, как AI-первая линия снимет рутину уточнений и обогатит карточку в CRM, не замедляя отдел продаж.';
    } else {
      title.textContent = 'Высокий риск «остывших» лидов';
      text.textContent = 'На аудите за 30 минут посмотрим AFRT, ночные пики и цепочку до CRM — и предложим пилот с ответом за 5–15 секунд на сайте.';
    }
    steps.forEach(function (el) { el.hidden = true; });
    result.hidden = false;
    nextBtn.hidden = true;
    prevBtn.hidden = true;
  });
  prevBtn.addEventListener('click', function () { if (i > 0) { i--; showStep(i); } });
  showStep(0);
})();
</script>

</div><!-- /.vza-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
/**
 * vza-site-lead-engine — «Диспетчерская входящих заявок»
 * Пакеты webhook → LeadChatNexus → CrmHotLeadDock (без Conveyor / WebsiteTerminal)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vza-site-lead-canvas");
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
    nexusBg: "#1e293b",
    nexusAccent: "#79f2ff",
    hot: "#f97316",
    hotSoft: "#fdba74",
    green: "#22c55e",
    lane: "rgba(121,242,255,0.2)",
    laneHot: "rgba(249,115,22,0.35)",
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

  function WebhookPulseLanes() {
    this.phase = 0;
  }
  WebhookPulseLanes.prototype.draw = function (ctx) {
    this.phase = (frame * 0.03) % (Math.PI * 2);
    var lanes = [
      { y: -95, amp: 18, hue: C.lane, label: "форма" },
      { y: -72, amp: 14, hue: C.laneHot, label: "чат" },
      { y: -49, amp: 12, hue: C.lane, label: "callback" }
    ];
    lanes.forEach(function (lane, idx) {
      ctx.strokeStyle = lane.hue;
      ctx.lineWidth = idx === 1 ? 2 : 1;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      for (var x = -160; x <= 160; x += 8) {
        var yy = lane.y + Math.sin(x * 0.04 + this.phase + idx) * lane.amp;
        if (x === -160) ctx.moveTo(x, yy);
        else ctx.lineTo(x, yy);
      }
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText(lane.label, -155, lane.y - 22);
    });

    for (var i = 0; i < 4; i++) {
      var lane = lanes[i % 3];
      var t = (this.phase * (1 + i * 0.15) + i * 1.6) % (Math.PI * 2);
      var px = -140 + ((t / (Math.PI * 2)) * 280);
      var py = lane.y + Math.sin(px * 0.04 + this.phase + (i % 3)) * lane.amp;
      drawTicket(ctx, px, py, i % 3);
    }
  };

  function drawTicket(ctx, x, y, kind) {
    ctx.save();
    ctx.translate(x, y);
    var colors = ["#93c5fd", "#fdba74", "#a7f3d0"];
    drawRR(ctx, -11, -8, 22, 16, 3, colors[kind] || "#e2e8f0", C.outline);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(kind === 0 ? "FM" : kind === 1 ? "CH" : "CB", 0, 2);
    ctx.restore();
  }

  function LeadChatNexus() {
    this.typing = 0;
  }
  LeadChatNexus.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    drawRR(ctx, -62, -58, 124, 118, 12, C.nexusBg, C.outline);
    drawRR(ctx, -54, -50, 108, 72, 8, "rgba(255,255,255,0.06)", C.nexusAccent);

    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Виджет · сайт", 0, -38);

    var lines = [
      "Здравствуйте! Уточним детали?",
      "Какой бюджет и срок?",
      "Передаю менеджеру с контекстом"
    ];
    var lineIdx = prg < 70 ? 0 : prg < 130 ? 1 : 2;
    drawRR(ctx, -48, -22 + lineIdx * 0, 96, 18, 6, "rgba(121,242,255,0.18)", null);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "7px Inter,sans-serif";
    ctx.fillText(lines[lineIdx].slice(0, 22), 0, -10);

    if (prg >= 50 && prg < 140) {
      this.typing = (Math.sin(frame * 0.2) + 1) / 2;
      for (var d = 0; d < 3; d++) {
        ctx.fillStyle = "rgba(255,255,255," + (0.35 + (d === Math.floor(this.typing * 3) ? 0.5 : 0)) + ")";
        ctx.beginPath();
        ctx.arc(-8 + d * 8, 8, 2.5, 0, Math.PI * 2);
        ctx.fill();
      }
    }

    if (prg >= 110 && prg < 175) {
      var q = (prg - 110) / 65;
      drawRR(ctx, -50, 22, 100 * Math.min(1, q), 10, 5, C.hot, null);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Квалификация " + Math.round(q * 100) + "%", 0, 30);
    }
  };

  function AfrtStopwatchRing() {
    this.sec = 12;
  }
  AfrtStopwatchRing.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    var left = Math.max(0, 12 - Math.floor(prg / 18));
    this.sec = left;
    ctx.strokeStyle = "rgba(249,115,22,0.35)";
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(108, -42, 22, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = C.hot;
    ctx.beginPath();
    ctx.arc(108, -42, 22, -Math.PI / 2, -Math.PI / 2 + (left / 12) * Math.PI * 2);
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(left + " с", 108, -39);
    ctx.font = "6px Inter,sans-serif";
    ctx.fillStyle = C.hotSoft;
    ctx.fillText("AFRT", 108, -30);
  };

  function NightShiftIndicator() {
    this.blink = 0;
  }
  NightShiftIndicator.prototype.draw = function (ctx) {
    this.blink = frame % 120 < 60 ? 1 : 0.55;
    drawRR(ctx, -138, -78, 44, 20, 6, "rgba(15,23,42,0.85)", C.outline);
    ctx.fillStyle = "rgba(251,191,36," + this.blink + ")";
    ctx.beginPath();
    ctx.arc(-128, -68, 3, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("ночь 02:14", -120, -65);
  };

  function CrmHotLeadDock() {
    this.slide = 0;
    this.pulse = 0;
  }
  CrmHotLeadDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    drawRR(ctx, 72, 18, 58, 44, 8, "rgba(34,197,94,0.12)", C.green);

    if (prg >= 168) {
      var local = Math.min(1, (prg - 168) / 28);
      this.slide = local;
      var cardX = 30 + local * 42;
      var cardY = 28 - local * 6;
      drawRR(ctx, cardX, cardY, 52, 34, 6, "rgba(34,197,94,0.35)", C.green);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Горячий лид", cardX + 26, cardY + 14);
      ctx.font = "7px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("CRM ✓", cardX + 26, cardY + 26);

      if (prg > 188 && prg < 215) {
        this.pulse = (prg - 188) / 27;
        ctx.strokeStyle = "rgba(34,197,94," + (0.9 - this.pulse * 0.85) + ")";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(cardX + 26, cardY + 17, 8 + this.pulse * 36, 0, Math.PI * 2);
        ctx.stroke();
      }
    }

    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("dock CRM", 101, 58);
  };

  function EscalationHandoffBeam() {
    this.on = false;
  }
  EscalationHandoffBeam.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    if (prg < 175 || prg > 210) return;
    var alpha = prg < 190 ? (prg - 175) / 15 : 1 - (prg - 190) / 20;
    ctx.strokeStyle = "rgba(121,242,255," + alpha * 0.75 + ")";
    ctx.lineWidth = 2;
    ctx.setLineDash([3, 5]);
    ctx.beginPath();
    ctx.moveTo(0, 55);
    ctx.lineTo(95, 35);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = "#79f2ff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("push менеджеру", 48, 48);
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
    var prg = (frame * 0.045) % 220;
    var isMoving = false;
    var faceDir = 1;

    var arcTargets = {
      "1_architect": { x: -105, y: 42 },
      "2_seo": { x: -52, y: 58 },
      "3_coder": { x: 0, y: 62 },
      "4_designer": { x: 52, y: 58 },
      "5_deployer": { x: 105, y: 42 }
    };
    var tgt = arcTargets[this.role] || { x: 0, y: 50 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 20) {
      var local = prg - this.stepTrig;
      if (local < 10) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 10);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 10);
      } else if (local < 14) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 14) / 6);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 14) / 6);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 200 === 0 && Math.random() < 0.14) {
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
  entities.push(new WebhookPulseLanes());
  entities.push(new NightShiftIndicator());
  entities.push(new LeadChatNexus());
  entities.push(new AfrtStopwatchRing());
  entities.push(new CrmHotLeadDock());
  entities.push(new EscalationHandoffBeam());
  entities.push(new Agent(-125, 92, C.agentYellow, "1_architect", 14, [
    "Webhook формы настроен", "Поля CRM согласованы", "Политика ПДн в чате"
  ]));
  entities.push(new Agent(-62, 98, C.agentGreen, "2_seo", 48, [
    "UTM с лендинга услуги", "Источник: виджет чата", "Ночной трафик +18%"
  ]));
  entities.push(new Agent(0, 100, C.agentBlue, "3_coder", 88, [
    "Первый ответ за 12 с", "JSON: intent + score", "Эскалация по confidence"
  ]));
  entities.push(new Agent(62, 98, C.agentPink, "4_designer", 128, [
    "Тон «на вы» для клиники", "3 вопроса квалификации", "Без автообещаний цены"
  ]));
  entities.push(new Agent(125, 92, C.agentPurple, "5_deployer", 168, [
    "Лид в amoCRM создан", "Задача: перезвон 5 мин", "Telegram менеджеру"
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

    var prg = (frame * 0.045) % 220;
    if (prg >= 8 && prg < 8.05) createBubble(-120, -55, "1. Заявка с формы");
    if (prg >= 52 && prg < 52.05) createBubble(-40, -20, "2. AI уточняет бюджет");
    if (prg >= 98 && prg < 98.05) createBubble(10, 5, "3. Score лида растёт");
    if (prg >= 142 && prg < 142.05) createBubble(60, -15, "4. Резюме в карточку");
    if (prg >= 178 && prg < 178.05) createBubble(100, 25, "5. Менеджер получил push");

    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 22);
      ctx.globalAlpha = alpha;
      ctx.font = "bold 9px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 20, tw, 16, 5, C.bubbleBg, C.hot);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 10);
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

<script>
(function(){
  document.querySelectorAll('.vza-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.vza-faq-item');
      var isOpen=item.classList.contains('open');
      document.querySelectorAll('.vza-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q=el.querySelector('.vza-faq-q');if(q)q.setAttribute('aria-expanded','false');
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
  var root=document.querySelector('.vza-content');
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

<?php
$ad_banner_url = getenv('AD_BANNER_URL') ?: '';
$ad_banner_img = getenv('AD_BANNER_IMAGE_URL') ?: '';
if ($ad_banner_url !== '' && $ad_banner_img !== '') :
    $ad_alt = getenv('AD_BANNER_ALT') ?: 'Рекламный баннер партнёра';
?>
<div class="nero-ai-container" style="padding:32px 0 48px;text-align:center;">
<a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
  <img src="<?php echo esc_url($ad_banner_img); ?>" width="970" height="90" alt="<?php echo esc_attr($ad_alt); ?>" loading="lazy" decoding="async" style="max-width:100%; height:auto; border-radius:12px; box-shadow:var(--ym-shadow-sm);">
</a>
</div>
<?php else : ?>
<!-- AD_BANNER_* не настроен: нижний баннер пропущен -->
<?php endif; ?>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
