<?php
/**
 * Template Name: AI-агент для Битрикс24: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI-агента в Битрикс24. Кейсы, стек, цены. Аудит CRM бесплатно.
 */

$page_seo_title       = 'AI-агент для Битрикс24: внедрение и настройка под ключ';
$page_seo_description = 'Подключим AI к Битрикс24: заявки, сделки, задачи и чаты без ручной рутины. Кастомный агент под ваши процессы — не только CoPilot. Кейсы, стек, цены. Аудит CRM бесплатно.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Сценарии AI', 'href' => '#scenarii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Подключить AI к Битрикс24';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Курс по AI-автоматизации';
$secondary_cta_url = nero_ai_primary_cta_url(getenv('SECONDARY_CTA_URL') ?: '');

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
/* Kadence header hide — pill-шапка из темы */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header {
  display: none !important;
}
body.nero-ai-landing {
  padding-top: 0 !important;
}

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

</style>

<style>
/* Hero Bitrix24 — самодостаточные стили (scope: .vnb-hero-bitrix24) */
.vnb-hero-bitrix24 {
  --vnb-cyan: #79f2ff;
  --vnb-violet: #8b5cf6;
  --vnb-bitrix: #2fc6f6;
  --vnb-green: #22c55e;
  --vnb-text: #e6edf7;
  --vnb-muted: #9aa8bd;
  --vnb-soft: #c7d2e5;
  --vnb-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnb-hero-bitrix24.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnb-hero-bitrix24::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 28%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vnb-hero-bitrix24::after {
  content: "";
  position: absolute;
  left: 58%;
  top: 12%;
  width: 720px;
  height: 720px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(47, 198, 246, .14), rgba(139, 92, 246, .08) 48%, transparent 66%);
  filter: blur(6px);
  animation: vnbHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnbHeroGlow {
  from { opacity: .42; transform: translateX(-50%) scale(.96); }
  to { opacity: .82; transform: translateX(-50%) scale(1.05); }
}
.vnb-hero-bitrix24 .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnb-hero-bitrix24 .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnb-hero-bitrix24 .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.6vw, 78px);
  line-height: .93;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnb-hero-bitrix24 .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnb-bitrix) 38%, var(--vnb-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnb-hero-bitrix24 .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(47, 198, 246, 0.28);
  border-radius: 999px;
  background: rgba(47, 198, 246, 0.08);
  color: var(--vnb-bitrix) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnb-hero-bitrix24 .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnb-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnb-hero-bitrix24 .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnb-hero-bitrix24 .nero-ai-badge {
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
  white-space: nowrap;
}
.vnb-hero-bitrix24 .nero-ai-badge::before {
  content: "";
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--vnb-bitrix);
  box-shadow: 0 0 10px rgba(47, 198, 246, .45);
}
.vnb-hero-bitrix24 .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 34px;
}
.vnb-hero-bitrix24 .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 14px 26px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none !important;
  transition: transform .2s, box-shadow .2s;
  border: 1px solid transparent;
  min-height: 48px;
}
.vnb-hero-bitrix24 .nero-ai-btn:hover { transform: translateY(-2px); }
.vnb-hero-bitrix24 .nero-ai-btn-primary {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(59, 130, 246, 0.35);
}
.vnb-hero-bitrix24 .nero-ai-btn-secondary {
  background: transparent;
  color: #e2e8f0 !important;
  border-color: rgba(148, 163, 184, 0.22);
}
.vnb-hero-bitrix24 .nero-ai-btn-secondary:hover {
  border-color: rgba(47, 198, 246, 0.38);
  background: rgba(47, 198, 246, 0.08);
}
.vnb-hero-bitrix24 .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnb-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.vnb-hero-bitrix24 .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnb-hero-bitrix24 .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnb-hero-bitrix24 .nero-ai-dots { display: flex; gap: 7px; }
.vnb-hero-bitrix24 .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.22); }
.vnb-hero-bitrix24 .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnb-hero-bitrix24 .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnb-hero-bitrix24 .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnb-hero-bitrix24 .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 12px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnb-hero-bitrix24 .nero-ai-window-body { padding: 18px; }
.vnb-hero-bitrix24 .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 16px;
}
.vnb-hero-bitrix24 .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 20px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnb-hero-bitrix24 .nero-ai-live-pill {
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
.vnb-hero-bitrix24 .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnbPulse 1.6s infinite;
}
@keyframes vnbPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnb-hero-bitrix24 .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.vnb-hero-bitrix24 .nero-ai-metric {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 18px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.vnb-hero-bitrix24 .nero-ai-metric:hover {
  transform: translateY(-3px);
  border-color: rgba(47, 198, 246, .34);
  background: rgba(47, 198, 246, .07);
}
.vnb-hero-bitrix24 .nero-ai-metric span { display: block; color: var(--vnb-muted); font-size: 12px; font-weight: 700; }
.vnb-hero-bitrix24 .nero-ai-metric strong { display: block; margin-top: 7px; color: #fff; font-size: 24px; line-height: 1; }
.vnb-hero-bitrix24 .nero-ai-metric small { display: block; margin-top: 6px; color: #9fb0c9; }
.vnb-hero-bitrix24 .nero-ai-task-stream { margin-top: 16px; display: grid; gap: 10px; }
.vnb-hero-bitrix24 .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.04);
  animation: vnbTaskFloat 5s ease-in-out infinite;
}
.vnb-hero-bitrix24 .nero-ai-task:nth-child(2) { animation-delay: .6s; }
.vnb-hero-bitrix24 .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
@keyframes vnbTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}
.vnb-hero-bitrix24 .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(47, 198, 246, .14);
  color: var(--vnb-bitrix);
  font-size: 11px;
  font-weight: 800;
  letter-spacing: -.02em;
}
.vnb-hero-bitrix24 .nero-ai-task strong { display: block; color: #f8fafc; font-size: 13px; }
.vnb-hero-bitrix24 .nero-ai-task span { color: var(--vnb-muted); font-size: 12px; }
.vnb-hero-bitrix24 .nero-ai-status {
  padding: 5px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
}
.vnb-hero-bitrix24 .nero-ai-status--new {
  background: rgba(47, 198, 246, .12);
  color: #bae6fd;
}
@media (max-width: 960px) {
  .vnb-hero-bitrix24 .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnb-hero-bitrix24 .nero-ai-dashboard { transform: none; }
}
@media (max-width: 600px) {
  .vnb-hero-bitrix24 .nero-ai-metrics-grid { grid-template-columns: 1fr; }
  .vnb-hero-bitrix24 .nero-ai-btn-row { flex-direction: column; align-items: stretch; }
}
/* Hero viewport — agent-pipeline-pitfalls (после scope Алины) */
.vnb-hero-bitrix24.nero-ai-hero {
  min-height: 100vh !important;
  min-height: 100dvh !important;
  position: relative;
}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-bitrix24-page" role="main" tabindex="-1">

<section class="nero-ai-hero vnb-hero-bitrix24" id="hero" aria-labelledby="hero-bitrix24-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai bitrix24</p>
      <h1 id="hero-bitrix24-title">AI-агент для Битрикс24: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Подключим AI к заявкам, сделкам, задачам и чатам в Битрикс24 — меньше ручной работы, выше конверсия и контроль качества</p>
      <ul class="nero-ai-badges" aria-label="Ключевые сценарии">
        <li class="nero-ai-badge">Заявки в CRM</li>
        <li class="nero-ai-badge">Сделки авто</li>
        <li class="nero-ai-badge">Задачи из чата</li>
        <li class="nero-ai-badge">Открытые линии</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI и Битрикс24">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Битрикс24 · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-операционный центр</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Лиды</span><strong>18</strong><small>входящих</small></div>
            <div class="nero-ai-metric"><span>Ответ</span><strong>40 сек</strong><small>первичный</small></div>
            <div class="nero-ai-metric"><span>CRM</span><strong>auto</strong><small>сделки</small></div>
            <div class="nero-ai-metric"><span>Рутина</span><strong>−50%</strong><small>меньше</small></div>
          </div>
          <div class="nero-ai-task-stream" aria-label="Поток обработки заявки">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">IN</span>
              <div><strong>Заявка</strong><span>сайт / мессенджер</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Квалификация</strong><span>скоринг лида</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">B24</span>
              <div><strong>Сделка в CRM</strong><span>задача менеджеру</span></div>
              <span class="nero-ai-status nero-ai-status--new">новое</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====================================================
     БОРИС: КОНТЕНТНАЯ ЧАСТЬ СТАТЬИ (НЕ HERO)
     SLUG: vnedrenie-ai-bitrix24
     Hero — только Алина (#hero)
     ==================================================== -->
<style>
/* === VNB: контент лонгрида Bitrix24 (scoped) === */
.vnb-content{
  --vnb-bg:#050711;--vnb-bg2:#080b17;
  --vnb-surface:rgba(255,255,255,.072);--vnb-text:#e6edf7;--vnb-muted:#9aa8bd;
  --vnb-soft:#c7d2e5;--vnb-heading:#fff;--vnb-border:rgba(255,255,255,.10);
  --vnb-accent:#2fc6f6;--vnb-orange:#ffa900;--vnb-violet:#8b5cf6;--vnb-green:#22c55e;
  --vnb-btn-from:#2563eb;--vnb-btn-to:#7c3aed;
  --vnb-r:18px;--vnb-r-lg:24px;--vnb-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnb-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.vnb-content *,.vnb-content *::before,.vnb-content *::after{box-sizing:border-box;}
.vnb-content a{color:inherit;text-decoration:none;}
.vnb-content p{color:var(--vnb-muted);line-height:1.72;margin:0 0 1em;}
.vnb-content p:last-child{margin-bottom:0;}
.vnb-content h2,.vnb-content h3,.vnb-content h4{color:var(--vnb-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.vnb-content strong{color:var(--vnb-soft);}
.vnb-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.vnb-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnb-muted);font-size:14.5px;line-height:1.65;}
.vnb-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnb-accent);font-weight:700;}
.vnb-content code{background:rgba(255,255,255,.09);padding:2px 7px;border-radius:5px;font-size:13px;color:var(--vnb-soft);}
.vnb-cnt{width:min(var(--vnb-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.vnb-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.vnb-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.vnb-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.vnb-sh.vnb-left{margin-left:0;text-align:left;}
.vnb-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.vnb-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.vnb-sh.vnb-left p{margin-left:0;}
.vnb-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(47,198,246,.08);border:1px solid rgba(47,198,246,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnb-accent);margin-bottom:14px;}
.vnb-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.vnb-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.vnb-intro-text{position:relative;padding-left:20px;}
.vnb-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vnb-accent),var(--vnb-violet));}
.vnb-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.vnb-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.vnb-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.vnb-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vnb-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.vnb-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnb-muted);line-height:1.4;}
.vnb-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.vnb-intro-grid{grid-template-columns:1fr;gap:36px;}.vnb-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.vnb-intro-kpi{grid-template-columns:1fr 1fr;}}
.vnb-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.vnb-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.vnb-toc a{display:inline-block;padding:9px 18px;background:var(--vnb-surface);border:1px solid var(--vnb-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vnb-muted);transition:border-color .2s,color .2s,background .2s;}
.vnb-toc a:hover{border-color:rgba(47,198,246,.42);color:var(--vnb-accent);background:rgba(47,198,246,.08);}
.vnb-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vnb-border);border-radius:var(--vnb-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);}
.vnb-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.vnb-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.vnb-grid-2,.vnb-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.vnb-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnb-grid-3{grid-template-columns:1fr;}}
.vnb-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--vnb-r);padding:26px;display:flex;gap:18px;align-items:flex-start;margin-bottom:14px;}
.vnb-scenario:last-child{margin-bottom:0;}
.vnb-sc-icon{flex-shrink:0;width:44px;height:44px;border-radius:12px;background:rgba(47,198,246,.12);border:1px solid rgba(47,198,246,.22);display:flex;align-items:center;justify-content:center;font-size:20px;}
.vnb-scenario h3{font-size:17px;margin-bottom:8px;}
.vnb-scenario p{font-size:14.5px;margin:0;}
.vnb-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.vnb-table{width:100%;border-collapse:collapse;font-size:14px;}
.vnb-table th{padding:13px 16px;text-align:left;background:rgba(47,198,246,.1);color:var(--vnb-accent);font-weight:700;border-bottom:1px solid rgba(47,198,246,.25);}
.vnb-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vnb-text);vertical-align:top;}
.vnb-table tr:last-child td{border-bottom:none;}
.vnb-level-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:var(--vnb-r);padding:26px;position:relative;overflow:hidden;}
.vnb-level-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;}
.vnb-level-card.l1::before{background:var(--vnb-green);}
.vnb-level-card.l2::before{background:var(--vnb-accent);}
.vnb-level-card.l3::before{background:var(--vnb-violet);}
.vnb-level-badge{display:inline-block;padding:4px 12px;border-radius:999px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;margin-bottom:14px;}
.vnb-level-card.l1 .vnb-level-badge{background:rgba(34,197,94,.15);color:var(--vnb-green);}
.vnb-level-card.l2 .vnb-level-badge{background:rgba(47,198,246,.15);color:var(--vnb-accent);}
.vnb-level-card.l3 .vnb-level-badge{background:rgba(139,92,246,.15);color:var(--vnb-violet);}
.vnb-timeline{position:relative;padding-left:40px;}
.vnb-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnb-accent),var(--vnb-violet));opacity:.35;border-radius:2px;}
.vnb-tl-item{position:relative;margin-bottom:32px;}
.vnb-tl-item:last-child{margin-bottom:0;}
.vnb-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnb-accent);box-shadow:0 0 0 4px rgba(47,198,246,.2);}
.vnb-tl-item h3{font-size:17px;margin-bottom:8px;}
.vnb-tl-item p{font-size:14.5px;margin:0;}
.vnb-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.vnb-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.vnb-case-grid{grid-template-columns:1fr;}}
.vnb-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.vnb-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnb-green);margin-bottom:10px;}
.vnb-metrics{display:flex;flex-direction:column;gap:8px;margin-top:14px;}
.vnb-metric{display:flex;align-items:baseline;gap:8px;}
.vnb-metric .num{font-size:22px;font-weight:900;color:var(--vnb-accent);flex-shrink:0;}
.vnb-metric .lbl{font-size:13px;color:var(--vnb-muted);}
.vnb-pricing-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
@media(max-width:768px){.vnb-pricing-grid{grid-template-columns:1fr;}}
.vnb-price-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:26px 22px;}
.vnb-price-card.vnb-featured{border-color:rgba(47,198,246,.45);background:rgba(47,198,246,.07);}
.vnb-price-card .tier{font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnb-accent);margin-bottom:10px;}
.vnb-price-card .amount{font-size:clamp(20px,2.5vw,28px);font-weight:900;color:#fff;line-height:1;margin-bottom:8px;}
.vnb-price-card .inc{font-size:13px;color:var(--vnb-muted);line-height:1.6;}
.vnb-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.vnb-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.vnb-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnb-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.vnb-faq-q::after{content:'▾';font-size:13px;color:var(--vnb-accent);transition:transform .25s;}
.vnb-faq-item.open .vnb-faq-q::after{transform:rotate(180deg);}
.vnb-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vnb-muted);line-height:1.72;}
.vnb-faq-item.open .vnb-faq-a{max-height:800px;padding:0 24px 20px;}
.vnb-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(47,198,246,.12),rgba(139,92,246,.1));border:1px solid rgba(47,198,246,.3);text-align:center;}
.vnb-content .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(47,198,246,.1));border-color:rgba(34,197,94,.3);}
.vnb-content .ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(47,198,246,.08));border-color:rgba(139,92,246,.3);}
.vnb-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.vnb-content .ym-cta-block__sub{color:var(--vnb-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.vnb-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.vnb-content .ym-btn{display:inline-flex;align-items:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.vnb-content .ym-btn--accent{background:linear-gradient(135deg,var(--vnb-btn-from),var(--vnb-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.vnb-content .ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--vnb-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.vnb-content .ym-link--accent{color:var(--vnb-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:600px){.vnb-content .ym-cta-block{padding:28px 20px;}}
</style>

<div class="vnb-content" id="vnb-article-root">

  <!-- INTRO -->
  <section class="vnb-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="vnb-cnt">
      <div class="vnb-intro-grid nero-ai-reveal">
        <div class="vnb-intro-text">
          <p class="vnb-eyebrow">Лонгрид · ai битрикс24</p>
          <p><strong>Коротко:</strong> AI-агент для Битрикс24 — это программный слой, который подключается к порталу через REST API, вебхуки и бот-платформу и <strong>самостоятельно выполняет действия</strong> в CRM: принимает заявки, квалифицирует лиды, заполняет поля сделок, создаёт задачи, отвечает в чатах открытых линий и передаёт сложные кейсы человеку. Nero Network внедряет таких агентов под ключ — от аудита воронки до пилота с измеримыми KPI.</p>
          <p>По прогнозу Gartner, к концу 2026 года <strong>40% enterprise-приложений</strong> получат task-specific AI-агентов — против менее 5% в 2025 году. Битрикс24 уже в вашем стеке: остаётся превратить CRM из «места, куда вносят данные руками», в систему, где <strong>искусственный интеллект для Битрикс24</strong> ведёт процесс по вашим правилам.</p>
        </div>
        <div class="vnb-intro-kpi" aria-label="Ключевые метрики">
          <div class="vnb-kpi-card"><div class="kv">40%</div><div class="kl">enterprise-приложений с AI-агентами к 2026</div><div class="ks">Gartner, 2025</div></div>
          <div class="vnb-kpi-card"><div class="kv">+35%</div><div class="kl">квалифицированных лидов после внедрения</div><div class="ks">кейс Velmi</div></div>
          <div class="vnb-kpi-card"><div class="kv">40%</div><div class="kl">времени уходило на поиск информации</div><div class="ks">кейс Пеленг</div></div>
          <div class="vnb-kpi-card"><div class="kv">180К–1М ₽</div><div class="kl">ориентир чека внедрения под ключ</div><div class="ks">рынок 2026</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vnb-toc-outer">
    <div class="vnb-cnt">
      <nav class="vnb-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#scenarii">Сценарии AI</a>
        <a href="#tri-urovnya">Три уровня</a>
        <a href="#komu-nuzhno">Кому нужно</a>
        <a href="#stek">Стек</a>
        <a href="#keisy">Кейсы</a>
        <a href="#etapy">Этапы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- H2-1: Что такое -->
  <section class="vnb-section" id="chto-takoe">
    <div class="vnb-cnt">
      <div class="vnb-sh">
        <span class="vnb-eyebrow">Определение</span>
        <h2>Что такое AI-агент для Битрикс24 и зачем он нужен</h2>
        <p>AI-агент — не чат-бот с заготовленными ответами, а связка <strong>событие → анализ → действие в CRM</strong>.</p>
      </div>

      <div class="vnb-card nero-ai-reveal">
        <p><strong>Определение:</strong> агент реагирует на триггеры портала (новый лид, сообщение в открытой линии, смена стадии сделки, завершение звонка), обрабатывает контекст через LLM и <strong>записывает результат обратно</strong> в карточки, задачи и чаты.</p>
        <p>Главная боль: сотрудники работают в Битрикс24 вручную, <strong>заявки и сделки теряются</strong> между каналами. AI-агент закрывает разрыв между «клиент написал» и «в воронке всё заполнено».</p>
        <ul>
          <li>первичный ответ на заявку за секунды, а не часы;</li>
          <li>квалификация лидов по BANT или вашим критериям;</li>
          <li>автозаполнение полей CRM из диалога и звонков;</li>
          <li>постановка задач и напоминаний без участия администратора;</li>
          <li>контроль качества переписок и звонков по скрипту;</li>
          <li>поиск по базе знаний для сотрудников в корпоративном чате.</li>
        </ul>
      </div>

      <div style="margin-top:32px;" class="nero-ai-reveal">
        <div class="vnb-sh vnb-left">
          <span class="vnb-eyebrow">CoPilot vs агент</span>
          <h3 style="font-size:22px;">Чем кастомный AI-агент отличается от CoPilot и BitrixGPT</h3>
        </div>
        <p><strong>BitrixGPT / CoPilot</strong> — встроенный помощник: аугментация работы человека в интерфейсе. <strong>Кастомный AI-агент</strong> инициирует действия <strong>сам по событию</strong> и работает по вашим правилам воронки.</p>
        <div class="vnb-table-wrap">
          <table class="vnb-table">
            <thead><tr><th>Критерий</th><th>BitrixGPT / CoPilot</th><th>Кастомный AI-агент</th></tr></thead>
            <tbody>
              <tr><td>Кто инициирует действие</td><td>Сотрудник в интерфейсе</td><td>Система по событию</td></tr>
              <tr><td>Автономная квалификация лидов</td><td>Нет</td><td>Да</td></tr>
              <tr><td>Свои правила воронки</td><td>Ограниченно</td><td>Полностью</td></tr>
              <tr><td>Открытые линии 24/7 со сложной логикой</td><td>Базово</td><td>Проектируется под клиента</td></tr>
              <tr><td>Лимиты</td><td><strong>600 запросов/час</strong> на портал</td><td>Выбор модели и контура</td></tr>
              <tr><td>Стоимость</td><td>Подписка от <strong>800 ₽/мес</strong></td><td>Пилот <strong>180–500 тыс. ₽</strong>, проект до <strong>1 млн ₽</strong></td></tr>
            </tbody>
          </table>
        </div>
        <p>Позиция Nero Network: <strong>CoPilot помогает сотруднику — агент ведёт процесс</strong>.</p>
      </div>

      <div class="vnb-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:19px;margin-bottom:10px;">Какие процессы в Битрикс24 автоматизирует нейросеть</h3>
        <div class="vnb-grid-2">
          <ul>
            <li><strong>Входящие заявки</strong> — формы, мессенджеры, звонки</li>
            <li><strong>CRM-воронка</strong> — стадии, напоминания, «остывшие» сделки</li>
            <li><strong>Задачи и поручения</strong> — из чата, дедлайны, эскалация</li>
          </ul>
          <ul>
            <li><strong>Сервис и открытые линии</strong> — FAQ, тикеты, передача оператору</li>
            <li><strong>Контроль качества</strong> — сверка со скриптом, оценка звонков</li>
          </ul>
        </div>
        <p style="margin-top:14px;">В кейсе Velmi время ответа сократилось с <strong>2–3 часов до 30–40 секунд</strong>, квалифицированных лидов стало <strong>+35%</strong>, менеджеры сэкономили <strong>~50 часов в месяц</strong>.</p>
      </div>
    </div>
  </section>

  <!-- H2-2: Как работает -->
  <section class="vnb-section vnb-section-alt" id="kak-rabotaet">
    <div class="vnb-cnt">
      <div class="vnb-sh">
        <span class="vnb-eyebrow">Архитектура</span>
        <h2>Как работает интеграция AI с Битрикс24</h2>
        <p><strong>Интеграция ai битрикс24</strong> — цепочка: событие на портале → middleware → LLM → REST API обратно в CRM.</p>
      </div>

      <div class="vnb-card nero-ai-reveal">
        <h3 style="font-size:20px;margin-bottom:16px;">Схема работы (6 шагов)</h3>
        <div class="vnb-timeline">
          <div class="vnb-tl-item"><div class="vnb-tl-dot"></div><h3>1. Событие в Битрикс24</h3><p>Новый лид (<code>ONCRMLEADADD</code>), сообщение в открытой линии, смена стадии сделки, завершение звонка.</p></div>
          <div class="vnb-tl-item"><div class="vnb-tl-dot"></div><h3>2. Webhook → очередь</h3><p>Битрикс24 требует ответ <strong>менее чем за 3 секунды</strong> — middleware отвечает <code>200 OK</code> и кладёт задачу в очередь (Redis, RabbitMQ).</p></div>
          <div class="vnb-tl-item"><div class="vnb-tl-dot"></div><h3>3. Загрузка контекста</h3><p>Карточка CRM, история чата, скрипт продаж, база знаний (RAG).</p></div>
          <div class="vnb-tl-item"><div class="vnb-tl-dot"></div><h3>4. LLM + structured output</h3><p>Ответ клиенту и структурированные данные для полей CRM.</p></div>
          <div class="vnb-tl-item"><div class="vnb-tl-dot"></div><h3>5. Запись в API</h3><p><code>crm.lead.update</code>, <code>crm.deal.update</code>, <code>tasks.task.add</code>.</p></div>
          <div class="vnb-tl-item"><div class="vnb-tl-dot"></div><h3>6. Эскалация</h3><p>Горячий лид, негатив, неизвестный вопрос → оператор + задача с дедлайном.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- H3 сценарии (#scenarii) -->
  <section class="vnb-section" id="scenarii">
    <div class="vnb-cnt">
      <div class="vnb-sh vnb-left">
        <span class="vnb-eyebrow">Сценарии</span>
        <h2>Заявки, сделки, задачи, чаты и контроль качества</h2>
      </div>

      <div class="vnb-scenario nero-ai-reveal">
        <div class="vnb-sc-icon" aria-hidden="true">📥</div>
        <div>
          <h3>Заявки и лиды без потерь</h3>
          <p>Агент за <strong>30–40 секунд</strong> уточняет потребность, заполняет поля лида и ставит задачу только для квалифицированных обращений. Velmi фиксировали <strong>~150 горячих лидов в квартал</strong>, терявшихся на ожидании.</p>
        </div>
      </div>
      <div class="vnb-scenario nero-ai-reveal">
        <div class="vnb-sc-icon" aria-hidden="true">📊</div>
        <div>
          <h3>Сделки и CRM-воронка</h3>
          <p>Агент читает переписку, предлагает смену стадии, заполняет списочные поля, формирует черновик КП. Kili AI показало сценарий автозаполнения полей сделки из переписки менеджеров.</p>
        </div>
      </div>
      <div class="vnb-scenario nero-ai-reveal">
        <div class="vnb-sc-icon" aria-hidden="true">✓</div>
        <div>
          <h3>Задачи и поручения сотрудникам</h3>
          <p>Из чата: «создай задачу Иванову до пятницы» — агент парсит намерение, создаёт <code>tasks.task.add</code>, привязывает к сделке. Кейс «Призма» у Пеленга — доступ к задачам через диалог.</p>
        </div>
      </div>
      <div class="vnb-scenario nero-ai-reveal">
        <div class="vnb-sc-icon" aria-hidden="true">💬</div>
        <div>
          <h3>Чаты и открытые линии</h3>
          <p>Агент работает 24/7 в Telegram, WhatsApp*, VK, виджете сайта. Для RAG по каталогу, очередей и сложной эскалации — кастомная <strong>разработка ai битрикс24</strong>.</p>
        </div>
      </div>
      <div class="vnb-scenario nero-ai-reveal">
        <div class="vnb-sc-icon" aria-hidden="true">🎧</div>
        <div>
          <h3>Контроль качества звонков и переписок</h3>
          <p>Агент сверяет диалог со скриптом, оценивает звонок, заполняет поля CRM после разговора. Кейс <strong>Инвест7</strong>: BitrixGPT расшифровывает звонки, данные остаются в контуре Битрикс24.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================
       БОРИС: ВИЗУАЛЬНЫЙ БЛОК (canvas, НЕ hero)
       ================================================ -->
  <section id="vnedrenie-ai-bitrix24-boris-block" class="bib-root" aria-label="Анимация: событие в Битрикс24 проходит webhook, очередь, LLM и возвращается в CRM через REST API">
<style>
#vnedrenie-ai-bitrix24-boris-block.bib-root{padding:56px 0 64px;background:#f0f4fb;}
#vnedrenie-ai-bitrix24-boris-block .bib-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#vnedrenie-ai-bitrix24-boris-block .bib-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){#vnedrenie-ai-bitrix24-boris-block .bib-card{grid-template-columns:1fr;min-height:auto;}}
#vnedrenie-ai-bitrix24-boris-block .bib-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#vnedrenie-ai-bitrix24-boris-block .bib-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#vnedrenie-ai-bitrix24-boris-block .bib-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0ea5e9;margin:0 0 14px;}
#vnedrenie-ai-bitrix24-boris-block .bib-ey::before{content:'';width:18px;height:2px;background:#0ea5e9;border-radius:1px;}
#vnedrenie-ai-bitrix24-boris-block .bib-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#vnedrenie-ai-bitrix24-boris-block .bib-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#vnedrenie-ai-bitrix24-boris-block .bib-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#vnedrenie-ai-bitrix24-boris-block .bib-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(14,165,233,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0369a1;font-style:normal;}
#vnedrenie-ai-bitrix24-boris-block .bib-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#vnedrenie-ai-bitrix24-boris-block .bib-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#vnedrenie-ai-bitrix24-boris-block .bib-pl-c{background:rgba(47,198,246,.1);color:#0369a1;border:1.5px solid rgba(47,198,246,.28);}
#vnedrenie-ai-bitrix24-boris-block .bib-pl-o{background:rgba(255,169,0,.1);color:#b45309;border:1.5px solid rgba(255,169,0,.28);}
#vnedrenie-ai-bitrix24-boris-block .bib-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#vnedrenie-ai-bitrix24-boris-block .bib-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#vnedrenie-ai-bitrix24-boris-block .bib-rgt{position:relative;background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);min-height:440px;overflow:hidden;}
@media(max-width:1023px){#vnedrenie-ai-bitrix24-boris-block .bib-rgt{min-height:380px;}}
#bib-bitrix24-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bib-cnt">
  <div class="bib-card">
    <div class="bib-lft">
      <span class="bib-ey">Архитектура под капотом</span>
      <h3 class="bib-h3">Событие в портале → webhook за 3 сек → очередь → LLM → поля CRM заполнены</h3>
      <ul class="bib-ul">
        <li><span class="bib-ic">⚡</span>Лид, чат или звонок — триггер <code>ONCRMLEADADD</code> / <code>ONIMESSAGEADD</code></li>
        <li><span class="bib-ic">⏱</span>Middleware отвечает <strong>&lt;3 сек</strong> и ставит задачу в Redis-очередь</li>
        <li><span class="bib-ic">🧠</span>LLM + RAG: диалог клиенту и structured output для CRM</li>
        <li><span class="bib-ic">↩</span><code>crm.lead.update</code> / <code>tasks.task.add</code> — данные в портале</li>
      </ul>
      <div class="bib-pills">
        <span class="bib-pl bib-pl-c">2–3 ч → 40 сек</span>
        <span class="bib-pl bib-pl-o">REST API Битрикс24</span>
        <span class="bib-pl bib-pl-g">+35% квалификация</span>
      </div>
      <p class="bib-foot">Дальше — три уровня AI: CoPilot, маркетплейс или кастомный агент →</p>
    </div>
    <div class="bib-rgt">
      <canvas id="bib-bitrix24-pipeline-canvas" aria-label="Анимация: поток событий Битрикс24 через webhook, очередь Redis, LLM-агент и обновление CRM" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bib-bitrix24-pipeline-canvas');
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
    b24:'#2fc6f6', b24D:function(a){return 'rgba(47,198,246,'+a+')';},
    org:'#ffa900', orgD:function(a){return 'rgba(255,169,0,'+a+')';},
    ai:'#a78bfa',  aiD:function(a){return 'rgba(167,139,250,'+a+')';},
    grn:'#4ade80', grnD:function(a){return 'rgba(74,222,128,'+a+')';},
    text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    card:'rgba(255,255,255,.065)', line:'rgba(255,255,255,.08)'
  };

  var NODES = [
    {id:'portal', label:'Битрикс24', sub:'лид / чат', x:.12, color:C.b24},
    {id:'hook',   label:'Webhook', sub:'<3 сек', x:.32, color:C.org},
    {id:'queue',  label:'Redis', sub:'очередь', x:.52, color:C.ai},
    {id:'llm',    label:'LLM', sub:'RAG + output', x:.72, color:C.ai},
    {id:'crm',    label:'CRM API', sub:'поля ✓', x:.90, color:C.grn}
  ];

  var packets = [];
  var LOOP = 520;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function spawnPacket(){
    packets.push({t:0, from:0, to:1, alpha:0});
  }

  function drawNodes(ny, nh){
    NODES.forEach(function(n, i){
      var x = n.x * W;
      var cy = ny + nh/2;
      var w = Math.min(88, W * 0.14);
      var h = 56;
      rr(x - w/2, cy - h/2, w, h, 10, C.card, n.color, 2);
      ctx.fillStyle = n.color;
      ctx.font = 'bold 11px Inter,system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(n.label, x, cy - 6);
      ctx.fillStyle = C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.fillText(n.sub, x, cy + 10);
      if(i < NODES.length - 1){
        var nx = NODES[i+1].x * W;
        ctx.strokeStyle = C.line;
        ctx.lineWidth = 1.5;
        ctx.setLineDash([4,4]);
        ctx.beginPath();
        ctx.moveTo(x + w/2 + 4, cy);
        ctx.lineTo(nx - w/2 - 4, cy);
        ctx.stroke();
        ctx.setLineDash([]);
      }
    });
  }

  function drawPackets(ny, nh){
    var cy = ny + nh/2;
    packets.forEach(function(p){
      p.t += 0.018;
      p.alpha = Math.min(1, p.alpha + 0.06);
      var fromX = NODES[p.from].x * W;
      var toX = NODES[p.to].x * W;
      var prog = Math.min(1, p.t);
      var x = fromX + (toX - fromX) * prog;
      ctx.globalAlpha = p.alpha * (1 - Math.max(0, prog - 0.92) * 12);
      ctx.beginPath();
      ctx.arc(x, cy, 6 + Math.sin(frame*0.1)*1.5, 0, Math.PI*2);
      ctx.fillStyle = C.b24;
      ctx.fill();
      ctx.globalAlpha = 1;
      if(prog >= 1){
        if(p.to < NODES.length - 1){
          p.from = p.to;
          p.to = p.to + 1;
          p.t = 0;
        } else {
          p.done = true;
        }
      }
    });
    packets = packets.filter(function(p){ return !p.done; });
  }

  function drawTopBar(){
    ctx.fillStyle = C.text;
    ctx.font = 'bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Middleware · event pipeline', 14, 22);
    var pulse = 6 + Math.sin(frame * 0.08) * 2;
    ctx.beginPath();
    ctx.arc(W - 50, 18, pulse, 0, Math.PI*2);
    ctx.fillStyle = C.grnD(0.15 + 0.1*Math.sin(frame*0.08));
    ctx.fill();
    ctx.beginPath();
    ctx.arc(W - 50, 18, 4, 0, Math.PI*2);
    ctx.fillStyle = C.grn;
    ctx.fill();
    ctx.fillStyle = C.grn;
    ctx.font = '10px Inter,sans-serif';
    ctx.fillText('live', W - 38, 22);
    ctx.strokeStyle = C.line;
    ctx.beginPath();
    ctx.moveTo(0, 34);
    ctx.lineTo(W, 34);
    ctx.stroke();
  }

  function loop(){
    frame++;
    var loopFr = frame % LOOP;
    if(loopFr === 30 || loopFr === 180 || loopFr === 330) spawnPacket();
    if(loopFr === 0) packets = [];

    ctx.clearRect(0, 0, W, H);
    drawTopBar();
    var ny = 44, nh = H - ny - 36;
    drawNodes(ny, nh);
    drawPackets(ny, nh);

    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Velmi: ack <3 сек · structured output → crm.lead.update', 14, H - 12);

    requestAnimationFrame(loop);
  }
  document.fonts.ready.then(function(){ loop(); });
})();
</script>
  </section>

  <!-- CTA-INSERT-1 (Артур) -->
  <div class="vnb-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-scenarii">
      <div class="ym-cta-block__icon" aria-hidden="true">🤖</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Нужен AI-агент для вашего Битрикс24?</p>
        <p class="ym-cta-block__sub">Проведём аудит воронки, открытых линий и полей CRM — покажем, что автоматизировать в первую очередь. Бесплатно, 3–5 рабочих дней.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <!-- H2-3: Три уровня -->
  <section class="vnb-section vnb-section-alt" id="tri-urovnya">
    <div class="vnb-cnt">
      <div class="vnb-sh">
        <span class="vnb-eyebrow">Выбор решения</span>
        <h2>Три уровня AI для Битрикс24: нативный, маркетплейс, агентный</h2>
      </div>
      <div class="vnb-grid-3 nero-ai-reveal">
        <div class="vnb-level-card l1">
          <div class="vnb-level-badge">Уровень 1</div>
          <h3>BitrixGPT / CoPilot из коробки</h3>
          <p>Подписка от <strong>800 ₽/мес</strong>, лимит <strong>600 запросов/час</strong>. Тексты, резюме, расшифровка — не автономная воронка.</p>
        </div>
        <div class="vnb-level-card l2">
          <div class="vnb-level-badge">Уровень 2</div>
          <h3>Готовые приложения маркетплейса</h3>
          <p>Низкий порог (от <strong>2000 ₽</strong>), но кастомизация под вашу воронку ограничена.</p>
        </div>
        <div class="vnb-level-card l3">
          <div class="vnb-level-badge">Уровень 3</div>
          <h3>Кастомный AI-агент через REST API</h3>
          <p>Middleware + LLM + вебхуки + RAG. Чек <strong>180 тыс.–1 млн ₽</strong>, полный контроль логики и метрик.</p>
        </div>
      </div>
      <p style="margin-top:24px;text-align:center;" class="nero-ai-reveal"><strong>Итог:</strong> CoPilot — быстро для сотрудника; маркетплейс — типовые боты; <strong>кастомный агент</strong> — когда нужно <strong>внедрение ai битрикс24 под ключ</strong> под ваши процессы.</p>
    </div>
  </section>

  <!-- H2-4: Кому нужна -->
  <section class="vnb-section" id="komu-nuzhno">
    <div class="vnb-cnt">
      <div class="vnb-sh vnb-left">
        <span class="vnb-eyebrow">Целевая аудитория</span>
        <h2>Кому нужна интеграция AI с Битрикс24</h2>
      </div>
      <div class="vnb-grid-3 nero-ai-reveal">
        <div class="vnb-card"><h3>Отдел продаж</h3><p>От <strong>100 лидов/мес</strong> и ответ &gt;15 мин — агент окупается за счёт сохранённых сделок. Пилот с KPI снижает риск попасть в <strong>40% отменённых</strong> agentic-проектов (Gartner).</p></div>
        <div class="vnb-card"><h3>Сервисный отдел</h3><p>FAQ в открытых линиях, тикеты, поиск по регламентам. Кейс <strong>Пеленг</strong>: <strong>40%</strong> времени уходило на поиск информации до «Призмы».</p></div>
        <div class="vnb-card"><h3>Малый и средний бизнес</h3><p>Пилот от <strong>180 тыс. ₽</strong>, 4–6 недель. Средний бизнес: несколько воронок, QA, 1С — проект <strong>500 тыс.–1 млн ₽</strong>.</p></div>
      </div>
      <div class="vnb-card nero-ai-reveal" style="margin-top:24px;">
        <!-- INTERNAL-LINKS:INSERT -->
        <p><strong>Сравнение с amoCRM:</strong> если вы читали наш материал про <a href="/vnedrenie-ai-amocrm/">AI-агент для amoCRM</a>, логика та же. Отличия Битрикс24: глубже <strong>задачи и проекты</strong>, сильнее <strong>корпоративный мессенджер и открытые линии</strong>.</p>
      </div>
    </div>
  </section>

  <!-- H2-5: Стек -->
  <section class="vnb-section vnb-section-alt" id="stek">
    <div class="vnb-cnt">
      <div class="vnb-sh">
        <span class="vnb-eyebrow">Технологии</span>
        <h2>Технический стек: как мы строим AI-агента для Битрикс24</h2>
      </div>
      <div class="vnb-card nero-ai-reveal">
        <h3 style="font-size:19px;margin-bottom:14px;">Архитектура: CRM, задачи, чат-боты, Open Lines</h3>
        <ul>
          <li><strong>CRM:</strong> лиды, сделки, контакты, смарт-процессы — <code>crm.*</code></li>
          <li><strong>Открытые линии + imbot</strong> — чат-боты в мессенджерах</li>
          <li><strong>Задачи и проекты</strong> — <code>tasks.*</code></li>
          <li><strong>RAG-хранилище</strong> — база знаний, регламенты, каталог</li>
          <li><strong>Middleware</strong> — FastAPI / n8n / Make</li>
          <li><strong>Панель метрик</strong> — скорость ответа, конверсия, % эскалаций</li>
        </ul>
      </div>
      <div class="vnb-table-wrap nero-ai-reveal" style="margin-top:24px;">
        <table class="vnb-table">
          <thead><tr><th>Контур</th><th>Когда выбирать</th></tr></thead>
          <tbody>
            <tr><td>BitrixGPT на серверах Битрикс24</td><td>Быстрый старт, типовые сценарии</td></tr>
            <tr><td>YandexGPT / GigaChat через портал</td><td>152-ФЗ, российская юрисдикция</td></tr>
            <tr><td>Коробка Энтерпрайз on-premise</td><td>Максимальный контроль, ФСТЭК 4 ур.</td></tr>
            <tr><td>OpenAI / зарубежные API</td><td>Только по явному согласованию</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vnb-card nero-ai-reveal" style="margin-top:24px;">
        <!-- INTERNAL-LINKS:INSERT-2 -->
        <h3 style="font-size:19px;margin-bottom:10px;">RAG по базе знаний и регламентам</h3>
        <p>Документы, скрипты, FAQ индексируются в векторное хранилище; агент отвечает <strong>со ссылкой на источник</strong> — как «Призма» у Пеленга. <strong>AI:</strong> первичный ответ, квалификация, автозаполнение, QA. <strong>Человек:</strong> крупные сделки, скидки, юридика, финальное КП.</p>
      </div>
    </div>
  </section>

  <!-- H2-6: Кейсы -->
  <section class="vnb-section" id="keisy">
    <div class="vnb-cnt">
      <div class="vnb-sh">
        <span class="vnb-eyebrow">Результаты</span>
        <h2>Кейсы: реальные результаты внедрения AI в Битрикс24</h2>
      </div>
      <div class="vnb-case-grid">
        <div class="vnb-case-card nero-ai-reveal">
          <div class="vnb-case-tag">Velmi · Habr</div>
          <h3>Автоквалификация лидов</h3>
          <p style="font-size:14px;">~400 лидов/мес., FastAPI + Redis + GPT. Webhook → очередь → structured output.</p>
          <div class="vnb-metrics">
            <div class="vnb-metric"><span class="num">40 сек</span><span class="lbl">ответ вместо 2–3 ч</span></div>
            <div class="vnb-metric"><span class="num">+35%</span><span class="lbl">квалифицированных лидов</span></div>
            <div class="vnb-metric"><span class="num">50 ч</span><span class="lbl">экономии / мес</span></div>
          </div>
        </div>
        <div class="vnb-case-card nero-ai-reveal">
          <div class="vnb-case-tag">Пеленг · Битрикс24</div>
          <h3>Постановка задач из чата</h3>
          <p style="font-size:14px;">Ассистент «Призма» — семантический поиск, заявки в техподдержку, задачи и календарь.</p>
          <div class="vnb-metrics">
            <div class="vnb-metric"><span class="num">40%</span><span class="lbl">времени на поиск инфо</span></div>
          </div>
        </div>
        <div class="vnb-case-card nero-ai-reveal">
          <div class="vnb-case-tag">Инвест7 · vc.ru</div>
          <h3>Контроль качества в сервисе</h3>
          <p style="font-size:14px;">BitrixGPT: расшифровка звонков, автозаполнение CRM, резюме в мессенджере.</p>
          <div class="vnb-metrics">
            <div class="vnb-metric"><span class="num">0</span><span class="lbl">ручной расшифровки</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA-INSERT-2 (Артур) -->
  <div class="vnb-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-keisy">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите таких же результатов?</p>
        <p class="ym-cta-block__sub">Ответ за 40 секунд вместо часов, +35% квалифицированных лидов, автозаполнение CRM после звонков — это публичные кейсы Velmi, Пеленг и Инвест7. Следующий может быть ваш.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Получить аудит Битрикс24</a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
        </div>
      </div>
    </div>
  </div>

  <!-- H2-7: Этапы -->
  <section class="vnb-section vnb-section-alt" id="etapy">
    <div class="vnb-cnt">
      <div class="vnb-sh">
        <span class="vnb-eyebrow">Процесс</span>
        <h2>Как проходит внедрение AI в Битрикс24 под ключ: 5 этапов</h2>
      </div>
      <div class="vnb-timeline nero-ai-reveal">
        <div class="vnb-tl-item"><div class="vnb-tl-dot"></div><h3>Аудит Битрикс24 под AI</h3><p>Бесплатный лид-магнит: карта воронки, открытые линии, поля CRM, роботы, объём заявок, политика ПДн. На выходе — приоритизированный список сценариев и ROI.</p></div>
        <div class="vnb-tl-item"><div class="vnb-tl-dot"></div><h3>Пилот на одном сценарии</h3><p><strong>4–6 недель</strong>, один поток — квалификация лидов из формы + чат. Метрики: время ответа, % квалификации, эскалации, заполненность полей.</p></div>
        <div class="vnb-tl-item"><div class="vnb-tl-dot"></div><h3>Интеграция, обучение и масштабирование</h3><p>После пилота: сделки, задачи, QA звонков/чатов, дашборд для РОПа, обучение менеджеров, <strong>3 месяца сопровождения</strong> — донастройка промптов и новые сценарии. Команда, которая хочет понимать n8n, промпты и human-in-the-loop до старта пилота, может заранее пройти <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_primary_cta_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a> — это ускоряет согласование сценариев с IT и отделом продаж.</p></div>
      </div>
    </div>
  </section>

  <!-- H2-8: Стоимость -->
  <section class="vnb-section" id="ceny">
    <div class="vnb-cnt">
      <div class="vnb-sh">
        <span class="vnb-eyebrow">Инвестиции</span>
        <h2>Стоимость внедрения AI в Битрикс24</h2>
        <p>Честный коридор без «AI за 30 000 ₽».</p>
      </div>
      <div class="vnb-pricing-grid nero-ai-reveal">
        <div class="vnb-price-card">
          <div class="tier">Аудит + roadmap</div>
          <div class="amount">от 50–80 тыс. ₽</div>
          <div class="inc">Аудит, карта сценариев, ТЗ, выбор LLM</div>
        </div>
        <div class="vnb-price-card vnb-featured">
          <div class="tier">Пилот ★</div>
          <div class="amount">180–250 тыс. ₽</div>
          <div class="inc">1 сценарий, интеграция, метрики, 4–6 нед.</div>
        </div>
        <div class="vnb-price-card">
          <div class="tier">Проект под ключ</div>
          <div class="amount">500 тыс.–1 млн ₽</div>
          <div class="inc">Несколько модулей, QA, обучение, 2–3 мес.</div>
        </div>
      </div>
      <div class="vnb-card nero-ai-reveal" style="margin-top:28px;">
        <p><strong>ROI без выдуманных гарантий:</strong> экономия часов менеджеров (Velmi: ~50 ч/мес), рост квалифицированных лидов (+35%), отказ от внешней расшифровки (Инвест7). Подписка BitrixGPT — отдельно (от <strong>800 ₽/мес</strong>).</p>
      </div>
    </div>
  </section>

  <!-- H2-9: FAQ -->
  <section class="vnb-section vnb-section-alt" id="faq">
    <div class="vnb-cnt">
      <div class="vnb-sh">
        <span class="vnb-eyebrow">Вопросы</span>
        <h2>FAQ по AI для Битрикс24</h2>
      </div>
      <div class="vnb-faq nero-ai-reveal" id="vnb-faq-accordion">
        <div class="vnb-faq-item">
          <div class="vnb-faq-q" role="button" tabindex="0">Можно ли внедрить без программиста</div>
          <div class="vnb-faq-a"><p><strong>Битрикс24 Вайбкод</strong> и бот-платформа v2 — простые боты без кода. Но очереди, 3-сек лимит webhook, structured output, RAG, QA звонков, 1С — зона интегратора.</p></div>
        </div>
        <div class="vnb-faq-item">
          <div class="vnb-faq-q" role="button" tabindex="0">CoPilot или кастомный агент — что выбрать</div>
          <div class="vnb-faq-a"><p>Тексты и расшифровки — <strong>BitrixGPT достаточно</strong>. Воронка без ручного ввода и ответ за секунды — <strong>кастомный агент</strong>. Можно комбинировать.</p></div>
        </div>
        <div class="vnb-faq-item">
          <div class="vnb-faq-q" role="button" tabindex="0">Сроки, риски и поддержка после запуска</div>
          <div class="vnb-faq-a"><p>Аудит 3–5 дней; пилот 4–6 нед.; проект 2–3 мес. Без KPI-пилота проект могут закрыть. Поддержка: 3 мес. включено; далее — абонент или пакет часов.</p></div>
        </div>
        <div class="vnb-faq-item">
          <div class="vnb-faq-q" role="button" tabindex="0">Как внедрить ai битрикс24 самостоятельно</div>
          <div class="vnb-faq-a"><p>Зарегистрировать приложение, webhook, middleware, LLM, промпты, staging-портал. Для бизнеса без DevOps быстрее — <strong>заказать внедрение</strong> у команды с кейсами на FastAPI/n8n и CRM.</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- H2-10: Подключить AI -->
  <section class="vnb-section" id="cta">
    <div class="vnb-cnt">
      <div class="vnb-sh">
        <span class="vnb-eyebrow">Следующий шаг</span>
        <h2>Подключить AI к Битрикс24</h2>
      </div>
      <div class="vnb-card nero-ai-reveal" style="text-align:center;">
        <p>Nero Network проводит <strong>аудит Битрикс24 под AI</strong>, запускает <strong>пилот за 4–6 недель</strong> с KPI, внедряет <strong>ai битрикс24 под ключ</strong>: заявки, сделки, задачи, чаты, контроль качества. Работаем с <strong>YandexGPT, GigaChat, BitrixGPT</strong> и коробкой on-premise под 152-ФЗ.</p>
        <p><strong>Итог:</strong> <strong>ai битрикс24</strong> в 2026 — способ убрать ручную рутину из CRM. CoPilot помогает людям; <strong>ai агенты для бизнеса</strong> ведут процесс. Выберите пилот с цифрами — и масштабируйте то, что измеримо работает.</p>
      </div>
    </div>
  </section>

  <!-- CTA-INSERT-3 (Артур) -->
  <div class="vnb-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы подключить AI к Битрикс24?</p>
        <p class="ym-cta-block__sub">Бесплатный аудит — первый шаг. Покажем архитектуру на демо-портале и честно скажем, хватит ли CoPilot или нужен кастомный агент под ваши процессы.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Подключить AI к Битрикс24</a>
      </div>
    </div>
  </div>

</div><!-- /.vnb-content -->

<script>
(function(){
  var root = document.getElementById('vnb-faq-accordion');
  if (!root) return;
  root.querySelectorAll('.vnb-faq-q').forEach(function(q){
    function toggle(){
      var item = q.parentElement;
      var open = item.classList.contains('open');
      root.querySelectorAll('.vnb-faq-item').forEach(function(i){ i.classList.remove('open'); });
      if (!open) item.classList.add('open');
    }
    q.addEventListener('click', toggle);
    q.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); toggle(); }});
  });
  var reveals = document.querySelectorAll('.vnb-content .nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(en){ if(en.isIntersecting){ en.target.classList.add('nero-ai-active'); io.unobserve(en.target); }});
    }, {threshold:0.12});
    reveals.forEach(function(el){ io.observe(el); });
  } else {
    reveals.forEach(function(el){ el.classList.add('nero-ai-active'); });
  }
})();
</script>


<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
