<?php
/**
 * Template Name: AI-запись в календарь под ключ: бронь и напоминания
 * Description: Внедрение AI-агента для записи на консультацию — календарь, напоминания, CRM. Снижаем no-show. От 120 тыс. ₽.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-запись в календарь под ключ: бронь и напоминания';
$page_seo_description = 'Внедрение AI-записи в календарь под ключ: бронь встречи, напоминания, интеграция CRM. Снижаем no-show и разгружаем администратора. От 120 тыс. ₽.';

add_filter(
    'document_title_parts',
    static function (array $parts) use ($page_seo_title): array {
        $parts['title'] = $page_seo_title;
        return $parts;
    },
    20
);

add_action(
    'wp_head',
    static function () use ($page_seo_title, $page_seo_description): void {
        echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
    },
    1
);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Боль',         'href' => '#bole'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Демо',         'href' => '#demo-kalendar'],
    ['label' => 'Интеграции',   'href' => '#integracii'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Настроить запись';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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
/* Kadence reset — pill-шапка из темы */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header {
  display: none !important;
}
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,
.entry-header,.page-title-section { display: none !important; }

#primary,.site-main,.site-content,#content,.content-area {
  padding-top: 0 !important; margin-top: 0 !important;
}

/* Hero full viewport */
.vnzk-hero-kalendar {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

/* TOC pills */
.vnzk-toc-outer { padding: 0 0 clamp(32px,4vw,48px); }
.vnzk-toc {
  display: flex; flex-wrap: wrap; gap: 8px; justify-content: center;
  max-width: 920px; margin: 0 auto;
}
.vnzk-toc a {
  padding: 8px 16px; border-radius: 999px; font-size: 13px; font-weight: 600;
  background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);
  color: var(--vnzk-muted, #9aa8bd); text-decoration: none !important;
  transition: border-color .2s, color .2s, background .2s;
}
.vnzk-toc a:hover {
  border-color: rgba(121,242,255,.4); color: #fff; background: rgba(121,242,255,.08);
}

/* Reveal */
.nero-ai-reveal {
  opacity: 0; transform: translateY(22px);
  transition: opacity .55s ease, transform .55s ease;
}
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
.nero-ai-delay-1 { transition-delay: .12s; }
.nero-ai-delay-2 { transition-delay: .24s; }
.nero-ai-delay-3 { transition-delay: .36s; }

.ym-cta-block__icon { font-size: 32px; margin-bottom: 8px; }
.ym-cta-block--footer-final {
  margin-bottom: clamp(48px,6vw,80px);
  background: linear-gradient(135deg, rgba(121,242,255,.14), rgba(139,92,246,.12));
}
</style>
<style>
/* === VNZK HERO: scoped .vnzk-hero-kalendar === */
.vnzk-hero-kalendar {
  --vnzk-accent: #79f2ff;
  --vnzk-green: #22c55e;
  --vnzk-violet: #8b5cf6;
  --vnzk-muted: #9aa8bd;
  --vnzk-cyan: #79f2ff;
  position: relative;
  padding: clamp(88px, 12vh, 120px) 0 clamp(56px, 8vh, 88px);
  background:
    radial-gradient(ellipse 80% 60% at 20% 0%, rgba(121,242,255,.09), transparent 55%),
    radial-gradient(ellipse 60% 50% at 90% 20%, rgba(139,92,246,.08), transparent 50%),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  overflow: hidden;
}
.vnzk-hero-kalendar .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
}
.vnzk-hero-kalendar .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(0, .95fr);
  gap: clamp(32px, 5vw, 56px);
  align-items: center;
}
.vnzk-hero-kalendar .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  border-radius: 999px;
  background: rgba(121,242,255,.08);
  border: 1px solid rgba(121,242,255,.22);
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--vnzk-accent);
  margin: 0 0 16px;
}
.vnzk-hero-kalendar .nero-ai-h1,
.vnzk-hero-kalendar h1 {
  margin: 0 0 18px;
  font-size: clamp(32px, 4.8vw, 56px);
  font-weight: 900;
  line-height: 1.06;
  letter-spacing: -.045em;
  color: #fff;
}
.vnzk-hero-kalendar .nero-ai-gradient-text {
  display: block;
  background: linear-gradient(92deg, #fff 0%, var(--vnzk-accent) 44%, var(--vnzk-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnzk-hero-kalendar .nero-ai-hero-lead,
.vnzk-hero-kalendar .nero-ai-lead {
  margin: 0 0 22px;
  max-width: 560px;
  font-size: clamp(15px, 1.7vw, 18px);
  line-height: 1.65;
  color: rgba(230,237,247,.78);
}
.vnzk-hero-kalendar .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 0 0 28px;
  padding: 0;
  list-style: none;
}
.vnzk-hero-kalendar .nero-ai-badge {
  padding: 8px 14px;
  border-radius: 999px;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.12);
  font-size: 12.5px;
  font-weight: 700;
  color: #c7d2e5;
}
.vnzk-hero-kalendar .nero-ai-btn-row,
.vnzk-hero-kalendar .nero-ai-cta-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}
.vnzk-hero-kalendar .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 13px 24px;
  border-radius: 999px;
  font-size: 14.5px;
  font-weight: 700;
  text-decoration: none !important;
  transition: transform .2s, box-shadow .2s;
}
.vnzk-hero-kalendar .nero-ai-btn-primary {
  background: linear-gradient(135deg, #2563eb, #7c3aed);
  color: #fff !important;
  box-shadow: 0 8px 32px rgba(59,130,246,.35);
}
.vnzk-hero-kalendar .nero-ai-btn-primary:hover { transform: translateY(-2px); }
.vnzk-hero-kalendar .nero-ai-btn-secondary {
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.14);
  color: #e6edf7 !important;
}
.vnzk-hero-kalendar .nero-ai-btn-secondary:hover {
  border-color: rgba(121,242,255,.35);
  color: var(--vnzk-accent) !important;
}
.vnzk-hero-kalendar .nero-ai-dashboard {
  padding: 14px;
  border-radius: 28px;
  background: linear-gradient(180deg, rgba(255,255,255,.09), rgba(255,255,255,.04));
  border: 1px solid rgba(255,255,255,.12);
  box-shadow: 0 24px 72px rgba(0,0,0,.45);
  backdrop-filter: blur(18px);
}
.vnzk-hero-kalendar .nero-ai-dashboard-shell {
  border-radius: 20px;
  overflow: hidden;
  background: rgba(6,10,24,.92);
  border: 1px solid rgba(255,255,255,.08);
}
.vnzk-hero-kalendar .nero-ai-window-top {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 14px;
  background: rgba(255,255,255,.04);
  border-bottom: 1px solid rgba(255,255,255,.08);
}
.vnzk-hero-kalendar .nero-ai-dots { display: flex; gap: 6px; }
.vnzk-hero-kalendar .nero-ai-dot {
  width: 9px; height: 9px; border-radius: 50%;
  background: rgba(255,255,255,.18);
}
.vnzk-hero-kalendar .nero-ai-window-title {
  font-size: 11px;
  color: var(--vnzk-muted);
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnzk-hero-kalendar .nero-ai-window-body { padding: 16px; }
.vnzk-hero-kalendar .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnzk-hero-kalendar .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -.03em;
  color: #fff;
}
.vnzk-hero-kalendar .nero-ai-live-pill {
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
.vnzk-hero-kalendar .nero-ai-live-pill::before {
  content: "";
  width: 7px; height: 7px; border-radius: 50%;
  background: var(--vnzk-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnzkPulse 1.6s infinite;
}
@keyframes vnzkPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnzk-hero-kalendar .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnzk-hero-kalendar .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnzk-hero-kalendar .nero-ai-metric span {
  display: block;
  color: var(--vnzk-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnzk-hero-kalendar .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: var(--vnzk-accent);
  font-size: 22px;
  line-height: 1;
}
.vnzk-hero-kalendar .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnzk-hero-kalendar .vnzk-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121,242,255,.14);
  background: radial-gradient(ellipse at 50% 40%, rgba(121,242,255,.08), rgba(6,10,24,.9) 70%);
}
.vnzk-hero-kalendar #vnzk-zapis-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnzk-hero-kalendar .vnzk-dash-pill {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  justify-content: center;
  margin-bottom: 10px;
}
.vnzk-hero-kalendar .vnzk-dash-pill span {
  padding: 5px 12px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 700;
  color: #9aa8bd;
  background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.08);
}
.vnzk-hero-kalendar .nero-ai-task-stream { display: grid; gap: 8px; }
.vnzk-hero-kalendar .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnzk-hero-kalendar .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px; height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vnzk-cyan);
  font-size: 10px;
  font-weight: 800;
}
.vnzk-hero-kalendar .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnzk-hero-kalendar .nero-ai-task span {
  color: var(--vnzk-muted);
  font-size: 11px;
}
.vnzk-hero-kalendar .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnzk-hero-kalendar .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .vnzk-hero-kalendar .nero-ai-hero-grid { grid-template-columns: 1fr; }
}
@media (max-width: 520px) {
  .vnzk-hero-kalendar .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnzk-hero-kalendar .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnzk-hero-kalendar .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<main id="primary" class="site-main nero-ai-home-page vnzk-zapis-kalendar-page" role="main" tabindex="-1">
<section class="nero-ai-hero vnzk-hero-kalendar" id="hero" aria-labelledby="vnzk-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai запись в календарь</p>
      <h1 id="vnzk-hero-title">AI-агент для записи на консультацию: <span class="nero-ai-gradient-text">календарь и напоминания под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI подбирает свободное окно, бронирует встречу и напоминает клиенту — без ручной переписки администратора.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">24/7 запись</li>
        <li class="nero-ai-badge">Напоминания</li>
        <li class="nero-ai-badge">CRM sync</li>
        <li class="nero-ai-badge">No-show ↓</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#demo-kalendar">Смотреть демо календаря</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-запись в календарь">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Запись на консультацию · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Календарный мост · live</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid" aria-label="Метрики демо">
            <div class="nero-ai-metric"><span>Ответ</span><strong>3 сек</strong><small>первичный</small></div>
            <div class="nero-ai-metric"><span>Слоты</span><strong>12</strong><small>свободно</small></div>
            <div class="nero-ai-metric"><span>No-show</span><strong>−32%</strong><small>после T−24</small></div>
            <div class="nero-ai-metric"><span>CRM</span><strong>auto</strong><small>сделка</small></div>
          </div>

          <div class="vnzk-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnzk-zapis-hero-canvas" role="img" aria-label="Анимация: диалог в мессенджере → подбор слота → бронь в календаре → напоминание и CRM"></canvas>
          </div>

          <div class="vnzk-dash-pill" aria-hidden="true">
            <span>Telegram</span><span>Max</span><span>Google Calendar</span><span>amoCRM</span>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий записи">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Клиент</strong><span>«запись в четверг после 15:00»</span></div>
              <span class="nero-ai-status nero-ai-status--amber">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Подбор слота</strong><span>16:45 — свободно</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Сделка + T−24</strong><span>напоминание в Telegram</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* === VNZK PAGE BODY — prefix vnzk-, dark theme === */
.vnzk-content{
  --vnzk-bg:#050711;--vnzk-bg2:#080b17;
  --vnzk-text:#e6edf7;--vnzk-muted:#9aa8bd;--vnzk-soft:#c7d2e5;--vnzk-heading:#fff;
  --vnzk-border:rgba(255,255,255,.10);--vnzk-accent:#79f2ff;--vnzk-violet:#8b5cf6;--vnzk-green:#22c55e;
  --vnzk-btn-from:#2563eb;--vnzk-btn-to:#7c3aed;--vnzk-r:18px;--vnzk-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnzk-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vnzk-content *,.vnzk-content *::before,.vnzk-content *::after{box-sizing:border-box}
.vnzk-content a{color:inherit}
.vnzk-content p{color:var(--vnzk-muted);line-height:1.72;margin:0 0 1em}
.vnzk-content p:last-child{margin-bottom:0}
.vnzk-content h2,.vnzk-content h3,.vnzk-content h4{color:var(--vnzk-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vnzk-content strong{color:var(--vnzk-soft)}
.vnzk-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vnzk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnzk-muted);font-size:14.5px;line-height:1.65}
.vnzk-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnzk-accent);font-weight:700}
.vnzk-cnt{width:min(var(--vnzk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vnzk-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vnzk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vnzk-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vnzk-sh.vnzk-left{margin-left:0;text-align:left}
.vnzk-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vnzk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vnzk-sh.vnzk-left p{margin-left:0}
.vnzk-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnzk-accent);margin-bottom:14px}
.vnzk-gt{background:linear-gradient(92deg,#fff 0%,var(--vnzk-accent) 44%,var(--vnzk-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.vnzk-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vnzk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vnzk-intro-text{position:relative;padding-left:20px}
.vnzk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vnzk-accent),var(--vnzk-violet))}
.vnzk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.vnzk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vnzk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.vnzk-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vnzk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vnzk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnzk-muted);line-height:1.4}
.vnzk-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.vnzk-intro-grid{grid-template-columns:1fr;gap:36px}.vnzk-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vnzk-intro-kpi{grid-template-columns:1fr 1fr}}
.vnzk-callout{border-left:3px solid var(--vnzk-accent);padding:18px 22px;margin:24px 0;background:rgba(121,242,255,.06);border-radius:0 14px 14px 0}
.vnzk-geo{border-left:3px solid var(--vnzk-accent);padding:20px 24px;margin:28px 0;background:rgba(255,255,255,.04);border-radius:0 16px 16px 0;font-size:15px;color:var(--vnzk-soft)}
.vnzk-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vnzk-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px)}
.vnzk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vnzk-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
@media(max-width:900px){.vnzk-grid-4{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnzk-grid-2,.vnzk-grid-4{grid-template-columns:1fr}}
.vnzk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vnzk-table{width:100%;border-collapse:collapse;font-size:14px}
.vnzk-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vnzk-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.vnzk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);vertical-align:top}
.vnzk-table tr:last-child td{border-bottom:none}
.vnzk-badge{display:inline-block;padding:4px 10px;border-radius:999px;font-size:11px;font-weight:700;background:rgba(139,92,246,.15);color:var(--vnzk-violet);border:1px solid rgba(139,92,246,.3);margin:2px}
.vnzk-timeline{position:relative;padding-left:40px}
.vnzk-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnzk-accent),var(--vnzk-violet));opacity:.35}
.vnzk-tl-item{position:relative;margin-bottom:28px}
.vnzk-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnzk-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vnzk-tl-item h3{font-size:17px}
.vnzk-tl-item--green .vnzk-tl-dot{background:var(--vnzk-green);box-shadow:0 0 0 4px rgba(34,197,94,.25)}
.vnzk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vnzk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vnzk-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnzk-heading);cursor:pointer;display:flex;justify-content:space-between;gap:16px}
.vnzk-faq-q::after{content:'▾';color:var(--vnzk-accent);transition:transform .25s}
.vnzk-faq-item.open .vnzk-faq-q::after{transform:rotate(180deg)}
.vnzk-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease}
.vnzk-faq-item.open .vnzk-faq-a{max-height:600px;padding:0 24px 20px}
.vnzk-news-card{padding:28px;border-radius:20px;background:rgba(255,255,255,.05);border:1px solid rgba(121,242,255,.2)}
.vnzk-news-date{font-size:12px;font-weight:700;color:var(--vnzk-accent);letter-spacing:.08em;text-transform:uppercase;margin-bottom:10px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vnzk-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vnzk-accent)!important;text-decoration:underline!important}
</style>
```

---

## HTML/PHP — тело страницы (после hero Алины)

```html
<div class="vnzk-content vna-content">

  <!-- #intro -->
  <section class="vnzk-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vnzk-cnt nero-ai-container">
      <div class="vnzk-intro-grid nero-ai-reveal">
        <div class="vnzk-intro-text">
          <p class="nero-ai-eyebrow">Внедрение AI-записи в календарь под ключ</p>
          <p>Если клиент пишет «хочу на консультацию в четверг», а администратор отвечает через два часа — слот уже занят, а лид ушёл к конкуренту. <strong>AI-запись в календарь</strong> и <strong>AI-бронирование консультации</strong> закрывают этот разрыв: агент отвечает за секунды, подбирает свободное окно, бронирует встречу, шлёт напоминания и передаёт карточку в CRM.</p>
          <p>Мы в Nero Network внедряем <strong>AI-агент для записи на консультацию</strong> как готовый проект: от аудита процесса до пилота на одном специалисте. Без найма разработчика на вашей стороне — <strong>ai запись в календарь без программиста</strong> в рамках пакета «под ключ».</p>
          <p><a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary"<?php echo $primary_cta_attrs; ?>>Настроить запись</a></p>
        </div>
        <div class="vnzk-intro-kpi" aria-label="Ключевые показатели">
          <div class="vnzk-kpi-card"><div class="kv">10–25%</div><div class="kl">типичный no-show в клиниках РФ</div><div class="ks">MedBusiness, 2023</div></div>
          <div class="vnzk-kpi-card"><div class="kv">2–3 ч</div><div class="kl">рутина администратора на согласование</div><div class="ks">BotHelp, 2026</div></div>
          <div class="vnzk-kpi-card"><div class="kv">120–350К</div><div class="kl">коридор внедрения под ключ</div><div class="ks">₽</div></div>
          <div class="vnzk-kpi-card"><div class="kv">24/7</div><div class="kl">запись в Telegram, Max, на сайте</div><div class="ks">без выходных</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="vnzk-toc-outer">
    <div class="vnzk-cnt">
      <nav class="vnzk-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#bole">Боль</a>
        <a href="#chto-takoe">Что такое</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#demo-kalendar">Демо</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- #bole -->
  <section class="vnzk-section" id="bole">
    <div class="vnzk-cnt">
      <div class="vnzk-sh vnzk-left nero-ai-reveal">
        <span class="vnzk-eyebrow">Боль бизнеса</span>
        <h2>Почему ручная запись на консультацию съедает выручку</h2>
        <p><strong>Коротко:</strong> ручное согласование времени в переписке и высокий процент неявок — две скрытые статьи расходов.</p>
      </div>
      <div class="vnzk-grid-2 nero-ai-reveal">
        <div class="vnzk-card" id="soglasovanie-vremeni">
          <h3>Согласование времени в переписке и потерянные слоты</h3>
          <p>Администратор тратит <strong>2–3 часа в день</strong> только на согласование времени (BotHelp, 2026). Ночью и в выходные ручная запись почти не работает — лиды с рекламы не дожидаются ответа.</p>
        </div>
        <div class="vnzk-card" id="no-show">
          <h3>No-show: когда клиент «забыл» о встрече</h3>
          <div class="vnzk-callout"><strong>10–25%</strong> записей срывается в России; в салонах — до <strong>20–30%</strong>. Каскад напоминаний T−24 / T−2 снижает неявки.</div>
          <p>Peer-reviewed исследование (ОАЭ, n=135 393): no-show <strong>20,82% → 10,25%</strong> после AI-напоминаний.</p>
        </div>
      </div>
    </div>
  </section>

  <div class="vnzk-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-bole">
      <div class="ym-cta-block__icon" aria-hidden="true">📅</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Устали терять слоты из‑за медленной переписки?</p>
        <p class="ym-cta-block__sub">Разберём ваш процесс записи: каналы, календарь, CRM и точки no-show. Покажем, как AI-агент подберёт слот и напомнит клиенту.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?? 'Настроить запись'); ?></a>
      </div>
    </div>
  </div>

  <!-- #chto-takoe -->
  <section class="vnzk-section vnzk-section-alt" id="chto-takoe">
    <div class="vnzk-cnt">
      <div class="vnzk-sh nero-ai-reveal">
        <span class="vnzk-eyebrow">Определение</span>
        <h2>Что такое <span class="vnzk-gt">AI-запись в календарь</span> для бизнеса</h2>
      </div>
      <blockquote class="vnzk-geo nero-ai-reveal">
        <strong>AI-запись в календарь</strong> — автономный цифровой администратор на LLM, который ведёт диалог, проверяет свободные слоты в календаре/CRM, бронирует встречу, шлёт напоминания и при отмене освобождает слот или предлагает лист ожидания.
      </blockquote>
      <div class="vnzk-grid-2 nero-ai-reveal">
        <div class="vnzk-card" id="podbor-slota">
          <h3>Как AI-агент подбирает свободное окно и бронирует встречу</h3>
          <p>Через function calling: <code>list_free_slots</code> → выбор клиентом → <code>create_booking</code> + <code>create_lead</code> в amoCRM или Bitrix24. Коллизии слота (HTTP 409) — перепредложение ближайших окон.</p>
        </div>
        <div class="vnzk-card" id="napominaniya">
          <h3>Напоминания в SMS, Telegram и мессенджерах</h3>
          <p>Каскад <strong>T−24 ч</strong> и <strong>T−2 ч</strong> с кнопками «Подтвердить / Перенести / Отменить». В апреле 2026: <strong>47%</strong> доставок — Telegram, <strong>34%</strong> — Max (Wahelp).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #kak-rabotaet -->
  <section class="vnzk-section" id="kak-rabotaet">
    <div class="vnzk-cnt">
      <div class="vnzk-sh nero-ai-reveal">
        <span class="vnzk-eyebrow">Под ключ</span>
        <h2>Как работает внедрение AI-записи в календарь под ключ</h2>
        <p>Сложность <strong>6/10</strong>, типовой пилот — <strong>2–6 недель</strong>.</p>
      </div>
      <div class="vnzk-card nero-ai-reveal">
        <div class="vnzk-timeline">
          <div class="vnzk-tl-item" id="audit-zapisi">
            <div class="vnzk-tl-dot"></div>
            <h3>Аудит текущего процесса записи (1–2 дня)</h3>
            <p>Каналы, календарь, CRM, правила слотов, точки потерь и no-show.</p>
          </div>
          <div class="vnzk-tl-item" id="nastroyka-scenariya">
            <div class="vnzk-tl-dot"></div>
            <h3>Настройка сценария: от заявки до брони (2–3 дня + интеграции 3–7 дней)</h3>
            <p>Ветки запись/перенос/отмена/эскалация; RAG по услугам; OAuth календаря и webhooks CRM.</p>
          </div>
          <div class="vnzk-tl-item vnzk-tl-item--green" id="zapusk-pilot">
            <div class="vnzk-tl-dot"></div>
            <h3>Запуск, тесты и обучение администратора (пилот 1–2 недели)</h3>
            <p>Метрики: время ответа, % self-service, no-show до/после, audit-log действий агента.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="vnzk-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать agentic AI до пилота?</p>
        <p class="ym-cta-block__sub">Перед внедрением AI-записи полезно разобраться в сценариях, function calling и интеграции с CRM. Посмотрите <a href="<?php echo esc_url($secondary_cta_url ?? '#'); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label ?? 'обучение'); ?></a>.</p>
      </div>
    </aside>
  </div>

  <!-- ============================================================
       БОРИС: #demo-kalendar — интерактивное календарное демо
       ============================================================ -->
  <section class="vnzk-section vnzk-section-alt" id="demo-kalendar" aria-labelledby="bzk-demo-title">
<style>
/* === БОРИС bzk- scoped в #demo-kalendar === */
#demo-kalendar .bzk-root{padding:0}
#demo-kalendar .bzk-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:24px;overflow:hidden;min-height:min(520px,70vh);
  background:linear-gradient(145deg,rgba(255,255,255,.06),rgba(255,255,255,.02));
  border:1px solid rgba(121,242,255,.22);
  box-shadow:0 0 60px rgba(121,242,255,.12),0 24px 64px rgba(0,0,0,.45);
}
@media(max-width:1023px){#demo-kalendar .bzk-card{grid-template-columns:1fr;min-height:auto}}
#demo-kalendar .bzk-lft{padding:clamp(28px,4vw,44px);display:flex;flex-direction:column;justify-content:center;border-right:1px solid rgba(255,255,255,.08)}
@media(max-width:1023px){#demo-kalendar .bzk-lft{border-right:none;border-bottom:1px solid rgba(255,255,255,.08)}}
#demo-kalendar .bzk-ey{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--vnzk-accent);margin:0 0 12px;display:flex;align-items:center;gap:8px}
#demo-kalendar .bzk-ey::before{content:'';width:18px;height:2px;background:var(--vnzk-accent);border-radius:1px}
#demo-kalendar .bzk-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#fff;line-height:1.28;margin:0 0 16px}
#demo-kalendar .bzk-steps{list-style:none;margin:0 0 20px;padding:0;display:flex;flex-direction:column;gap:8px}
#demo-kalendar .bzk-steps li{display:flex;gap:10px;font-size:14px;color:var(--vnzk-muted);line-height:1.5}
#demo-kalendar .bzk-steps .n{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--vnzk-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center}
#demo-kalendar .bzk-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px}
#demo-kalendar .bzk-pl{padding:5px 12px;border-radius:99px;font-size:11.5px;font-weight:700;border:1px solid}
#demo-kalendar .bzk-pl-c{background:rgba(121,242,255,.1);color:var(--vnzk-accent);border-color:rgba(121,242,255,.35)}
#demo-kalendar .bzk-pl-g{background:rgba(34,197,94,.1);color:var(--vnzk-green);border-color:rgba(34,197,94,.35)}
#demo-kalendar .bzk-pl-v{background:rgba(139,92,246,.1);color:var(--vnzk-violet);border-color:rgba(139,92,246,.35)}
#demo-kalendar .bzk-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#demo-kalendar .bzk-rgt{position:relative;min-height:400px;background:linear-gradient(160deg,#070a14 0%,#0c1224 50%,#060912 100%);overflow:hidden}
@media(max-width:1023px){#demo-kalendar .bzk-rgt{min-height:380px}}
#bzk-kalendar-demo-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;pointer-events:none}
#demo-kalendar .bzk-ui{position:relative;z-index:2;padding:24px;height:100%;display:flex;flex-direction:column;gap:14px}
#demo-kalendar .bzk-ui-hdr{display:flex;align-items:center;justify-content:space-between;gap:12px}
#demo-kalendar .bzk-ui-title{font-size:13px;font-weight:700;color:#fff}
#demo-kalendar .bzk-live{font-size:10px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:4px 10px;border-radius:999px;background:rgba(34,197,94,.15);color:var(--vnzk-green);border:1px solid rgba(34,197,94,.35)}
#demo-kalendar .bzk-svc{display:flex;flex-wrap:wrap;gap:8px}
#demo-kalendar .bzk-svc button{
  padding:8px 14px;border-radius:10px;font-size:12px;font-weight:600;cursor:pointer;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:var(--vnzk-muted);
  transition:border-color .2s,background .2s,color .2s;
}
#demo-kalendar .bzk-svc button:hover,#demo-kalendar .bzk-svc button.bzk-on{
  border-color:rgba(121,242,255,.5);background:rgba(121,242,255,.12);color:#fff;
}
#demo-kalendar .bzk-days{display:grid;grid-template-columns:repeat(5,1fr);gap:6px}
#demo-kalendar .bzk-days button{
  padding:10px 4px;border-radius:10px;font-size:11px;font-weight:700;cursor:pointer;text-align:center;
  background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);color:var(--vnzk-muted);
}
#demo-kalendar .bzk-days button span{display:block;font-size:16px;color:#fff;margin-top:2px}
#demo-kalendar .bzk-days button.bzk-on{border-color:var(--vnzk-accent);background:rgba(121,242,255,.15);color:var(--vnzk-accent)}
#demo-kalendar .bzk-slots{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;flex:1;align-content:start}
#demo-kalendar .bzk-slots button{
  padding:14px 8px;border-radius:12px;font-size:13px;font-weight:700;cursor:pointer;
  background:rgba(255,255,255,.05);border:1px solid rgba(121,242,255,.2);color:#fff;
  transition:transform .15s,box-shadow .15s,background .15s;
}
#demo-kalendar .bzk-slots button:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(121,242,255,.2)}
#demo-kalendar .bzk-slots button.bzk-on{background:rgba(121,242,255,.2);border-color:var(--vnzk-accent);box-shadow:0 0 20px rgba(121,242,255,.25)}
#demo-kalendar .bzk-slots button:disabled{opacity:.35;cursor:not-allowed;transform:none}
#demo-kalendar .bzk-confirm{
  display:none;flex-direction:column;align-items:center;justify-content:center;text-align:center;
  gap:12px;padding:20px;flex:1;
}
#demo-kalendar .bzk-confirm.bzk-show{display:flex}
#demo-kalendar .bzk-confirm-ic{width:56px;height:56px;border-radius:50%;background:rgba(34,197,94,.15);border:2px solid var(--vnzk-green);display:flex;align-items:center;justify-content:center;font-size:28px;color:var(--vnzk-green)}
#demo-kalendar .bzk-confirm h4{font-size:18px;color:#fff;margin:0}
#demo-kalendar .bzk-confirm p{font-size:13px;color:var(--vnzk-muted);margin:0}
#demo-kalendar .bzk-reset{margin-top:8px;padding:8px 16px;border-radius:999px;font-size:12px;font-weight:700;cursor:pointer;background:transparent;border:1px solid rgba(255,255,255,.2);color:var(--vnzk-muted)}
#demo-kalendar .bzk-reset:hover{border-color:var(--vnzk-accent);color:var(--vnzk-accent)}
#demo-kalendar .bzk-panel{display:flex;flex-direction:column;gap:14px;flex:1}
#demo-kalendar .bzk-panel.bzk-hide{display:none}
</style>

    <div class="vnzk-cnt">
      <div class="vnzk-sh nero-ai-reveal">
        <span class="vnzk-eyebrow">Лид-магнит</span>
        <h2 id="bzk-demo-title">AI-бронирование консультации: <span class="vnzk-gt">сценарий без администратора</span></h2>
        <p>Попробуйте мини-демо: выберите услугу и слот — как это делает AI-агент в Telegram или на сайте.</p>
      </div>

      <div class="bzk-root nero-ai-reveal" id="vnzk-demo-kalendar-boris">
        <div class="bzk-card">
          <div class="bzk-lft">
            <span class="bzk-ey">Интерактив · демо</span>
            <h3 class="bzk-h3">Запись без переписки: услуга → слот → подтверждение → CRM</h3>
            <ol class="bzk-steps" aria-hidden="true">
              <li><span class="n">1</span>Клиент выбирает услугу и день в свободном тексте или кнопками</li>
              <li><span class="n">2</span>Агент вызывает <code>list_free_slots</code> и показывает 2–3 окна</li>
              <li><span class="n">3</span><code>create_booking</code> + напоминание T−24 / T−2 + сделка в CRM</li>
            </ol>
            <div class="bzk-pills">
              <span class="bzk-pl bzk-pl-c">ответ ~3 сек</span>
              <span class="bzk-pl bzk-pl-g">no-show ↓</span>
              <span class="bzk-pl bzk-pl-v">CRM auto</span>
            </div>
            <p class="bzk-foot">Дальше — интеграции с amoCRM, Bitrix24, YCLIENTS →</p>
          </div>

          <div class="bzk-rgt" id="bzk-demo-stage">
            <canvas id="bzk-kalendar-demo-canvas" aria-hidden="true"></canvas>
            <div class="bzk-ui" id="bzk-demo-ui">
              <div class="bzk-ui-hdr">
                <span class="bzk-ui-title">Запись на консультацию · mock</span>
                <span class="bzk-live">онлайн</span>
              </div>
              <div class="bzk-panel" id="bzk-panel-book">
                <div>
                  <div style="font-size:11px;font-weight:700;color:var(--vnzk-muted);margin-bottom:8px;text-transform:uppercase;letter-spacing:.08em">Услуга</div>
                  <div class="bzk-svc" role="group" aria-label="Выбор услуги">
                    <button type="button" class="bzk-on" data-svc="law">Консультация юриста</button>
                    <button type="button" data-svc="clinic">Приём в клинике</button>
                    <button type="button" data-svc="b2b">B2B-аудит</button>
                  </div>
                </div>
                <div>
                  <div style="font-size:11px;font-weight:700;color:var(--vnzk-muted);margin-bottom:8px;text-transform:uppercase;letter-spacing:.08em">День</div>
                  <div class="bzk-days" role="group" aria-label="Выбор дня">
                    <button type="button" data-day="Чт"><span>Чт</span>17</button>
                    <button type="button" class="bzk-on" data-day="Пт"><span>Пт</span>18</button>
                    <button type="button" data-day="Пн"><span>Пн</span>21</button>
                    <button type="button" data-day="Вт"><span>Вт</span>22</button>
                    <button type="button" data-day="Ср"><span>Ср</span>23</button>
                  </div>
                </div>
                <div>
                  <div style="font-size:11px;font-weight:700;color:var(--vnzk-muted);margin-bottom:8px;text-transform:uppercase;letter-spacing:.08em">Свободные слоты</div>
                  <div class="bzk-slots" role="group" aria-label="Выбор времени">
                    <button type="button" data-time="15:30">15:30</button>
                    <button type="button" data-time="16:45">16:45</button>
                    <button type="button" data-time="17:30">17:30</button>
                  </div>
                </div>
              </div>
              <div class="bzk-confirm" id="bzk-panel-done" aria-live="polite">
                <div class="bzk-confirm-ic" aria-hidden="true">✓</div>
                <h4>Встреча забронирована</h4>
                <p id="bzk-confirm-text">Пт, 18 · 16:45 · Консультация юриста<br>Напоминание T−24 и T−2 · сделка в CRM</p>
                <button type="button" class="bzk-reset" id="bzk-demo-reset">Попробовать снова</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
(function(){
  'use strict';
  /* ── Canvas ambient: календарная сетка + pulse ── */
  var cv = document.getElementById('bzk-kalendar-demo-canvas');
  var stage = document.getElementById('bzk-demo-stage');
  if (!cv || !stage) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, t = 0, burst = 0, selPulse = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 420;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var ACC = '#79f2ff', GRN = '#22c55e', MUT = 'rgba(148,163,184,.12)';

  function drawGrid(){
    var cols = 7, rows = 5;
    var pad = 24, gw = (W - pad * 2) / cols, gh = (H - pad * 2) / rows;
    ctx.strokeStyle = MUT;
    ctx.lineWidth = 1;
    for (var c = 0; c <= cols; c++){
      ctx.beginPath();
      ctx.moveTo(pad + c * gw, pad);
      ctx.lineTo(pad + c * gw, H - pad);
      ctx.stroke();
    }
    for (var r = 0; r <= rows; r++){
      ctx.beginPath();
      ctx.moveTo(pad, pad + r * gh);
      ctx.lineTo(W - pad, pad + r * gh);
      ctx.stroke();
    }
    /* подсвеченные «слоты» */
    var slots = [[2,1],[4,2],[5,3],[3,4]];
    slots.forEach(function(s, i){
      var x = pad + s[0] * gw + 4, y = pad + s[1] * gh + 4;
      var w = gw - 8, h = gh - 8;
      var a = 0.08 + 0.06 * Math.sin(t * 0.04 + i);
      ctx.fillStyle = 'rgba(121,242,255,' + a + ')';
      ctx.fillRect(x, y, w, h);
    });
  }

  function drawBurst(){
    if (burst <= 0) return;
    var cx = W * 0.72, cy = H * 0.45;
    for (var i = 0; i < 12; i++){
      var ang = (i / 12) * Math.PI * 2 + t * 0.02;
      var r = burst * (40 + i * 3);
      ctx.beginPath();
      ctx.arc(cx + Math.cos(ang) * r, cy + Math.sin(ang) * r, 3, 0, Math.PI * 2);
      ctx.fillStyle = i % 2 ? GRN : ACC;
      ctx.globalAlpha = Math.max(0, 1 - burst / 60);
      ctx.fill();
    }
    ctx.globalAlpha = 1;
    burst++;
    if (burst > 55) burst = 0;
  }

  function loop(){
    t++;
    ctx.clearRect(0, 0, W, H);
    /* radial glow */
    var g = ctx.createRadialGradient(W * 0.7, H * 0.4, 20, W * 0.7, H * 0.4, W * 0.5);
    g.addColorStop(0, 'rgba(121,242,255,' + (0.06 + selPulse * 0.04) + ')');
    g.addColorStop(1, 'rgba(0,0,0,0)');
    ctx.fillStyle = g;
    ctx.fillRect(0, 0, W, H);
    drawGrid();
    drawBurst();
    requestAnimationFrame(loop);
  }
  loop();

  window.bzkDemoPulse = function(){ selPulse = 1; burst = 1; setTimeout(function(){ selPulse = 0; }, 800); };

  /* ── Interactive UI ── */
  var svcLabels = { law: 'Консультация юриста', clinic: 'Приём в клинике', b2b: 'B2B-аудит' };
  var state = { svc: 'law', day: 'Пт', date: '18', time: '' };

  function pickGroup(root, btn, key, dataAttr){
    root.querySelectorAll('button').forEach(function(b){ b.classList.remove('bzk-on'); });
    btn.classList.add('bzk-on');
    state[key] = btn.getAttribute(dataAttr);
    if (dataAttr === 'data-day'){
      state.date = btn.querySelector('span') ? btn.textContent.replace(state.day, '').trim() : '';
    }
  }

  document.querySelectorAll('#demo-kalendar .bzk-svc button').forEach(function(btn){
    btn.addEventListener('click', function(){
      pickGroup(btn.parentElement, btn, 'svc', 'data-svc');
      window.bzkDemoPulse && window.bzkDemoPulse();
    });
  });
  document.querySelectorAll('#demo-kalendar .bzk-days button').forEach(function(btn){
    btn.addEventListener('click', function(){
      pickGroup(btn.parentElement, btn, 'day', 'data-day');
      state.date = btn.textContent.replace(state.day, '').trim();
      window.bzkDemoPulse && window.bzkDemoPulse();
    });
  });

  var panelBook = document.getElementById('bzk-panel-book');
  var panelDone = document.getElementById('bzk-panel-done');
  var confirmText = document.getElementById('bzk-confirm-text');

  document.querySelectorAll('#demo-kalendar .bzk-slots button').forEach(function(btn){
    btn.addEventListener('click', function(){
      if (btn.disabled) return;
      document.querySelectorAll('#demo-kalendar .bzk-slots button').forEach(function(b){ b.classList.remove('bzk-on'); });
      btn.classList.add('bzk-on');
      state.time = btn.getAttribute('data-time');
      window.bzkDemoPulse && window.bzkDemoPulse();
      setTimeout(function(){
        panelBook.classList.add('bzk-hide');
        panelDone.classList.add('bzk-show');
        confirmText.innerHTML = state.day + ', ' + state.date + ' · ' + state.time + ' · ' + svcLabels[state.svc] + '<br>Напоминание T−24 и T−2 · сделка в CRM';
        burst = 1;
      }, 420);
    });
  });

  document.getElementById('bzk-demo-reset').addEventListener('click', function(){
    panelDone.classList.remove('bzk-show');
    panelBook.classList.remove('bzk-hide');
    document.querySelectorAll('#demo-kalendar .bzk-slots button').forEach(function(b){ b.classList.remove('bzk-on'); });
    state.time = '';
  });
})();
</script>
  </section>

  <!-- #integracii -->
  <section class="vnzk-section" id="integracii">
    <div class="vnzk-cnt">
      <div class="vnzk-sh nero-ai-reveal">
        <span class="vnzk-eyebrow">Стек</span>
        <h2>Интеграция CRM и календарей</h2>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->

      <div class="vnzk-table-wrap nero-ai-reveal">
        <table class="vnzk-table">
          <thead><tr><th>Категория</th><th>Системы</th><th>Синхронизация</th></tr></thead>
          <tbody>
            <tr><td>CRM</td><td><span class="vnzk-badge">amoCRM</span> <span class="vnzk-badge">Bitrix24</span> <span class="vnzk-badge">RetailCRM</span></td><td>Лид, сделка, стадия, UTM, история диалога</td></tr>
            <tr><td>Календарь</td><td><span class="vnzk-badge">Google Calendar</span> <span class="vnzk-badge">YCLIENTS</span> <span class="vnzk-badge">Calendly</span></td><td>Слоты, бронь, отмена, буферы</td></tr>
            <tr><td>Каналы</td><td><span class="vnzk-badge">Telegram</span> <span class="vnzk-badge">Max</span> <span class="vnzk-badge">Сайт</span></td><td>Диалог, напоминания, кнопки</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vnzk-grid-2 nero-ai-reveal" style="margin-top:28px">
        <div class="vnzk-card" id="peredacha-lida"><h3>Передача лида и статуса встречи в CRM</h3><p>При каждой брони — карточка со статусом «Записан → Подтвердил → Пришёл / No-show» и полной историей переписки.</p></div>
        <div class="vnzk-card" id="sinhron-sloty"><h3>Синхронизация слотов и отмен</h3><p>Единое расписание: что записано в мессенджере — видно в YCLIENTS и CRM. Отмена через кнопку в напоминании освобождает слот мгновенно.</p></div>
      </div>
    </div>
  </section>

  <!-- #dlya-kogo -->
  <section class="vnzk-section vnzk-section-alt" id="dlya-kogo">
    <div class="vnzk-cnt">
      <div class="vnzk-sh nero-ai-reveal">
        <span class="vnzk-eyebrow">Вертикали</span>
        <h2>Для кого подходит: клиники, юристы, салоны, B2B</h2>
      </div>
      <div class="vnzk-grid-4 nero-ai-reveal">
        <div class="vnzk-card" id="kliniki"><h3>Клиники</h3><p>Запись 24/7 в МИС, 152-ФЗ, без диагнозов — только маршрутизация.</p></div>
        <div class="vnzk-card" id="yuristy"><h3>Юристы и консалтинг</h3><p>Квалификация лида → календарь эксперта → сделка в CRM.</p></div>
        <div class="vnzk-card" id="salony"><h3>Салоны</h3><p>Слой поверх YCLIENTS для Telegram/Max, снижение no-show 20–30%.</p></div>
        <div class="vnzk-card" id="b2b-konsalting"><h3>B2B-сервис</h3><p>Квалификация и бриф в CRM до встречи с менеджером.</p></div>
      </div>
    </div>
  </section>

  <!-- #keisy -->
  <section class="vnzk-section" id="keisy">
    <div class="vnzk-cnt">
      <div class="vnzk-sh nero-ai-reveal">
        <span class="vnzk-eyebrow">Метрики</span>
        <h2>Кейсы и примеры внедрения AI-записи в календарь</h2>
        <p style="font-size:14px;font-style:italic;color:#64748b">Оговорки к источникам — в таблице; не гарантируем «−60%» без пилота на ваших данных.</p>
      </div>
      <div class="vnzk-table-wrap nero-ai-reveal">
        <table class="vnzk-table">
          <thead><tr><th>Контекст</th><th>Было</th><th>Стало</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>Стоматология, РФ</td><td>24%</td><td>7%</td><td>MedBusiness / SQNS</td></tr>
            <tr><td>Первичная медицина, ОАЭ</td><td>20,82%</td><td>10,25%</td><td>JMIR, n=135 393</td></tr>
            <tr><td>AI scheduling (обзор)</td><td>—</td><td>−20–55% no-show</td><td>Valuestream AI, 2026</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- #ceny -->
  <section class="vnzk-section vnzk-section-alt" id="ceny">
    <div class="vnzk-cnt">
      <div class="vnzk-sh nero-ai-reveal">
        <span class="vnzk-eyebrow">Бюджет</span>
        <h2>Сколько стоит AI-запись в календарь</h2>
        <p>Ориентир <strong style="color:var(--vnzk-accent)">120–350 тыс. ₽</strong> за внедрение под ключ.</p>
      </div>
      <div class="vnzk-table-wrap nero-ai-reveal">
        <table class="vnzk-table">
          <thead><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr></thead>
          <tbody>
            <tr><td>Аудит</td><td>1–2 дня</td><td>Карта процесса, ТЗ</td></tr>
            <tr><td>Проектирование + интеграции</td><td>5–10 дней</td><td>API, webhooks, сценарии</td></tr>
            <tr><td>Пилот</td><td>1–2 недели</td><td>Метрики no-show, доработки</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <div class="vnzk-cnt">
    <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет под ваш календарь и CRM</p>
        <p class="ym-cta-block__sub">Ориентир 120–350 тыс. ₽ за внедрение под ключ, пилот 2–6 недель.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?? 'Настроить запись'); ?></a>
          <a href="#demo-kalendar" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Смотреть демо календаря</a>
        </div>
      </div>
    </div>
  </div>

  <!-- #faq -->
  <section class="vnzk-section" id="faq">
    <div class="vnzk-cnt">
      <div class="vnzk-sh nero-ai-reveal">
        <span class="vnzk-eyebrow">FAQ</span>
        <h2>Как внедрить AI-запись в календарь</h2>
      </div>
      <div class="vnzk-faq nero-ai-reveal" id="vnzk-faq-accordion">
        <div class="vnzk-faq-item"><div class="vnzk-faq-q" tabindex="0" role="button">Нужен ли программист на стороне клиента?</div><div class="vnzk-faq-a"><p>Нет. Мы настраиваем интеграции, сценарии и напоминания; от вас — доступы API, расписание и FAQ.</p></div></div>
        <div class="vnzk-faq-item"><div class="vnzk-faq-q" tabindex="0" role="button">Какие календари и CRM поддерживаются?</div><div class="vnzk-faq-a"><p>amoCRM, Bitrix24, Google Calendar, YCLIENTS, Calendly; каналы Telegram, Max, сайт, голос.</p></div></div>
        <div class="vnzk-faq-item"><div class="vnzk-faq-q" tabindex="0" role="button">Как измерить эффект после запуска?</div><div class="vnzk-faq-a"><p>Время ответа, % записей без администратора, no-show до/после (4–6 недель), конверсия «диалог → визит».</p></div></div>
        <div class="vnzk-faq-item"><div class="vnzk-faq-q" tabindex="0" role="button">Заменит ли AI-агент администратора полностью?</div><div class="vnzk-faq-a"><p>Нет — рутину закрывает агент; человек — нестандартные запросы и эскалации с контекстом.</p></div></div>
        <div class="vnzk-faq-item"><div class="vnzk-faq-q" tabindex="0" role="button">Что если слот заняли одновременно?</div><div class="vnzk-faq-a"><p>Агент получает коллизию от API и перепредлагает ближайшие свободные окна.</p></div></div>
        <div class="vnzk-faq-item"><div class="vnzk-faq-q" tabindex="0" role="button">Как соблюдается 152-ФЗ?</div><div class="vnzk-faq-a"><p>ПДн по вашей политике; согласие в первом сообщении или на сайте.</p></div></div>
        <div class="vnzk-faq-item"><div class="vnzk-faq-q" tabindex="0" role="button">Можно ли начать с одного специалиста?</div><div class="vnzk-faq-a"><p>Да — рекомендуемый пилот на одном враче, юристе или мастере.</p></div></div>
        <div class="vnzk-faq-item"><div class="vnzk-faq-q" tabindex="0" role="button">Сколько длится внедрение?</div><div class="vnzk-faq-a"><p>Типово 2–6 недель от аудита до пилота.</p></div></div>
      </div>
    </div>
  </section>

  <!-- #trend-2026 -->
  <section class="vnzk-section vnzk-section-alt" id="trend-2026">
    <div class="vnzk-cnt">
      <div class="vnzk-sh nero-ai-reveal">
        <span class="vnzk-eyebrow">Тренд 2026</span>
        <h2>Agentic AI и автоматизация записи</h2>
      </div>
      <div class="vnzk-news-card nero-ai-reveal">
        <div class="vnzk-news-date">Июнь 2026 · Meta Business Agent</div>
        <p>Agentic AI переходит от ответов к <strong>действиям</strong>: бронирование, квалификация лидов, закрытие продаж. Gartner: к концу 2026 <strong>40%</strong> enterprise-приложений получат task-specific AI-агентов.</p>
        <blockquote class="vnzk-geo" style="margin-top:16px;margin-bottom:0">
          <strong>AI-запись в календарь</strong> — агент на LLM с API календаря и CRM; отличается от виджета способностью понимать свободный текст и выполнять операции в реальном времени.
        </blockquote>
      </div>
    </div>
  </section>

  <!-- #cta -->
  <div class="vnzk-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы к AI-записи в календарь под ключ?</p>
        <p class="ym-cta-block__sub">Короткая консультация и сценарий записи без администратора для вашей ниши.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?? 'Настроить запись'); ?></a>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost"<?php echo $primary_cta_attrs; ?>>Получить сценарий записи без администратора</a>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.vnzk-content -->

<script>
/* FAQ accordion — для Наташи, можно объединить с longread-page-reveal.js */
(function(){
  document.querySelectorAll('#vnzk-faq-accordion .vnzk-faq-q').forEach(function(q){
    function toggle(){ q.parentElement.classList.toggle('open'); }
    q.addEventListener('click', toggle);
    q.addEventListener('keydown', function(e){ if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); } });
  });
})();
</script>
<script>
/**
 * vnzk-zapis-hero-engine — «Диспетчерская Календарный мост»
 * Фазы: intake (пузыри) → slotting (подсветка) → confirm (напоминание + CRM)
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnzk-zapis-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width; ch = canvas.height;
    cx = cw / 2; cy = ch / 2 + 6;
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    hubBg: "#0f172a",
    slotFree: "rgba(121,242,255,0.12)",
    slotBooked: "rgba(34,197,94,0.35)",
    slotGlow: "#79f2ff",
    bubbleIn: "#38bdf8",
    bubbleOut: "#a78bfa",
    crmCard: "#1e293b",
    crmAccent: "#22c55e",
    agentYellow: "#eab308", agentGreen: "#10b981", agentBlue: "#3b82f6",
    agentPink: "#ec4899", agentPurple: "#8b5cf6",
    bubbleBg: "#0b1220", bubbleText: "#e2e8f0"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) { ctx.lineWidth = 1.2; ctx.strokeStyle = stroke; ctx.stroke(); }
  }

  function createBubble(x, y, text, tail) {
    ctx.save();
    ctx.font = "bold 7px Inter,sans-serif";
    var tw = ctx.measureText(text).width + 14;
    drawRR(ctx, x - tw / 2, y - 10, tw, 16, 6, C.bubbleBg, C.outline);
    ctx.fillStyle = C.bubbleText;
    ctx.textAlign = "center";
    ctx.fillText(text, x, y + 1);
    if (tail === "left") {
      ctx.beginPath();
      ctx.moveTo(x - tw / 2 - 2, y);
      ctx.lineTo(x - tw / 2 - 8, y + 4);
      ctx.lineTo(x - tw / 2, y + 6);
      ctx.fillStyle = C.bubbleBg;
      ctx.fill();
    }
    ctx.restore();
  }

  /* Центральный календарь — вместо WebsiteTerminal */
  function BookingCalendarHub() {
    this.lockedSlot = -1;
  }
  BookingCalendarHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    var bx = -52, by = -48, bw = 104, bh = 72;
    drawRR(ctx, bx, by, bw, bh, 6, C.hubBg, C.outline);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ЧТ  ·  КОНСУЛЬТАЦИЯ", 0, by + 10);

    var cols = 4, rows = 2;
    for (var r = 0; r < rows; r++) {
      for (var c = 0; c < cols; c++) {
        var sx = bx + 8 + c * 23;
        var sy = by + 18 + r * 22;
        var idx = r * cols + c;
        var isTarget = idx === 5;
        var booked = prg >= 120 && isTarget;
        if (booked) this.lockedSlot = idx;
        var fill = booked ? C.slotBooked : (isTarget && prg >= 70 && prg < 120 ? C.slotGlow : C.slotFree);
        drawRR(ctx, sx, sy, 18, 16, 3, fill, isTarget ? C.slotGlow : C.outline);
        if (isTarget && prg >= 70 && prg < 120) {
          ctx.strokeStyle = C.slotGlow;
          ctx.lineWidth = 1.5;
          ctx.strokeRect(sx - 1, sy - 1, 20, 18);
        }
        if (booked) {
          ctx.fillStyle = "#fff";
          ctx.font = "bold 6px Inter,sans-serif";
          ctx.fillText("16:45", sx + 9, sy + 11);
        }
      }
    }

    if (prg >= 155 && prg < 210) {
      createBubble(0, by - 18, "Бронь подтверждена ✓", "left");
    }
  };

  /* Дуговой поток сообщений — вместо Conveyor */
  function ChatBubbleStream() {
    this.bubbles = [
      { t: 0, label: "чт после 15?", color: C.bubbleIn },
      { t: 40, label: "16:45 ок", color: C.bubbleOut },
      { t: 90, label: "напомню", color: C.bubbleOut }
    ];
  }
  ChatBubbleStream.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    this.bubbles.forEach(function (b, i) {
      var local = (prg + b.t) % 240;
      if (local > 130) return;
      var t = local / 130;
      var angle = Math.PI * 0.85 - t * Math.PI * 0.7;
      var rad = 95 + Math.sin(t * Math.PI) * 12;
      var px = Math.cos(angle) * rad - 95;
      var py = Math.sin(angle) * rad * 0.55 - 10;
      drawRR(ctx, px - 22, py - 8, 44, 14, 5, b.color, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.label, px, py + 2);
    });
  };

  /* Маяк напоминаний T−24 */
  function ReminderPulseTower() {
    this.pulse = 0;
  }
  ReminderPulseTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 155) return;
    var p = (prg - 155) / 55;
    this.pulse = Math.sin(frame * 0.15) * 0.5 + 0.5;
    drawRR(ctx, 118, -42, 28, 48, 5, "rgba(34,197,94,0.15)", C.crmAccent);
    ctx.fillStyle = C.crmAccent;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("T−24", 132, -28);
    ctx.globalAlpha = 0.25 + this.pulse * 0.45;
    ctx.beginPath();
    ctx.arc(132, -8, 8 + this.pulse * 10, 0, Math.PI * 2);
    ctx.fillStyle = C.crmAccent;
    ctx.fill();
    ctx.globalAlpha = 1;
    if (p > 0.35) createBubble(132, 18, "Telegram ✓", "left");
  };

  /* Док CRM — финал цикла */
  function CrmSyncDock() {
    this.slide = 0;
  }
  CrmSyncDock.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 240;
    if (prg < 175) return;
    this.slide = Math.min(1, (prg - 175) / 25);
    var ox = 95 + (1 - this.slide) * 40;
    drawRR(ctx, ox, 8, 52, 38, 5, C.crmCard, C.outline);
    ctx.fillStyle = C.crmAccent;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Сделка", ox + 6, 20);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("Записан · CRM", ox + 6, 32);
    ctx.fillStyle = C.crmAccent;
    ctx.fillText("✓", ox + 40, 32);
  };

  /* Лента ожидания — тематический декор */
  function WaitlistTicker() {
    this.offset = 0;
  }
  WaitlistTicker.prototype.draw = function (ctx) {
    this.offset = (frame * 0.6) % 60;
    drawRR(ctx, -168, 28, 36, 22, 4, "rgba(255,255,255,0.04)", C.outline);
    ctx.fillStyle = "#64748b";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("лист", -150, 38);
    ctx.fillStyle = "rgba(121,242,255,0.5)";
    for (var i = 0; i < 3; i++) {
      ctx.fillRect(-162 + i * 10 - this.offset % 10, 44, 6, 3);
    }
  };

  var hub = new BookingCalendarHub();
  var stream = new ChatBubbleStream();
  var reminder = new ReminderPulseTower();
  var crm = new CrmSyncDock();
  var waitlist = new WaitlistTicker();

  var dialogs = [
    "Слот свободен?", "Буфер 15 мин", "В CRM?", "T−24 шлём", "No-show ↓",
    "Клиент в TG", "16:45 бронь", "Эскалация?", "Max тоже", "Календарь sync"
  ];

  function Agent(role, color, homeX, homeY) {
    this.role = role; this.color = color;
    this.x = homeX; this.y = homeY;
    this.homeX = homeX; this.homeY = homeY;
    this.targetX = homeX; this.targetY = homeY;
    this.dir = 1; this.bubbleTimer = Math.random() * 120;
    this.bubbleText = "";
  }
  Agent.prototype.setTarget = function (tx, ty) {
    this.targetX = tx; this.targetY = ty;
  };
  Agent.prototype.update = function () {
    this.x += (this.targetX - this.x) * 0.04;
    this.y += (this.targetY - this.y) * 0.04;
    if (this.targetX > this.x) this.dir = 1; else if (this.targetX < this.x) this.dir = -1;
    this.bubbleTimer--;
    if (this.bubbleTimer <= 0) {
      this.bubbleText = dialogs[Math.floor(Math.random() * dialogs.length)];
      this.bubbleTimer = 90 + Math.random() * 80;
    }
  };
  Agent.prototype.draw = function (ctx) {
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.scale(this.dir, 1);
    drawRR(ctx, -5, -12, 10, 14, 3, this.color, C.outline);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(0, -16, 5, 0, Math.PI * 2); ctx.fill();
    ctx.strokeStyle = C.outline; ctx.stroke();
    ctx.restore();
    if (this.bubbleTimer > 70 && this.bubbleText) {
      createBubble(this.x, this.y - 28, this.bubbleText, "left");
    }
  };

  var agents = [
    new Agent("1_architect", C.agentYellow, -130, 52),
    new Agent("2_analyst", C.agentGreen, -145, 8),
    new Agent("3_dev", C.agentBlue, -20, 58),
    new Agent("4_designer", C.agentPink, 20, -58),
    new Agent("5_deployer", C.agentPurple, 130, 42)
  ];

  function updateAgentTargets() {
    var prg = (frame * 0.042) % 240;
    if (prg < 60) {
      agents[1].setTarget(-120, 0);
      agents[2].setTarget(-70, 20);
    } else if (prg < 120) {
      agents[2].setTarget(-15, 35);
      agents[0].setTarget(-55, -5);
    } else if (prg < 180) {
      agents[3].setTarget(95, -15);
      agents[4].setTarget(110, 25);
    } else {
      agents.forEach(function (a, i) {
        a.setTarget(a.homeX, a.homeY);
      });
    }
  }

  function engineLoop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    waitlist.draw(ctx);
    stream.draw(ctx);
    hub.draw(ctx);
    reminder.draw(ctx);
    crm.draw(ctx);

    updateAgentTargets();
    agents.forEach(function (a) { a.update(); a.draw(ctx); });

    var prg = (frame * 0.042) % 240;
    if (prg > 25 && prg < 55) createBubble(-125, -25, "запись в чт?", "left");
    if (prg > 85 && prg < 115) createBubble(-40, 5, "16:45 свободно", "left");
    if (prg > 195 && prg < 225) createBubble(0, 42, "CRM + напоминание", "left");

    ctx.restore();
    requestAnimationFrame(engineLoop);
  }
  engineLoop();
});
</script>


<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.vnzk-content') || document.querySelector('.vnzk-zapis-kalendar-page');
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
  /* Hero reveal immediately */
  document.querySelectorAll('#hero .nero-ai-reveal').forEach(function(el){
    el.classList.add('nero-ai-active');
  });
})();
</script>

<?php get_footer(); ?>
