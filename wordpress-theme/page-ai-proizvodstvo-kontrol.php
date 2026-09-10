<?php
/**
 * Template Name: AI производство контроль: сменные задания и простои под ключ
 * Description: AI-агент для сменных заданий и контроля простоев на малом производстве. Внедрение под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'AI производство контроль: сменные задания и простои под ключ';
$page_seo_description = 'AI-агент для сменных заданий и контроля простоев на малом производстве. Внедрение под ключ: фиксация отклонений, отчёт руководителю. Заказать аудит — карта потерь бесплатно.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '';

$apkc_public_base = rtrim((string) (getenv('PUBLIC_SITE_URL') ?: getenv('WP_SITE_URL') ?: home_url('/')), '/');
$apkc_page_url    = $apkc_public_base . '/ai-proizvodstvo-kontrol/';
$apkc_brand_name  = $brand !== '' ? $brand : (get_bloginfo('name') ?: 'Nero Network');

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
/* === APKC page shell === */
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

.apkc-page{
  --ym-primary:#2563eb;
  --ym-accent:#f59e0b;
}

.apkc-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.apkc-intro-text p:last-child{color:var(--apkc-soft);}

.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-2{transition-delay:.24s;}

.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{box-shadow:0 8px 32px rgba(59,130,246,.35);}
.apkc-faq-q{user-select:none;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page apkc-page" role="main" tabindex="-1">

<section class="nero-ai-hero apkc-hero" id="hero" aria-labelledby="hero-apkc-title">
<style>
/* ── Hero ai-proizvodstvo-kontrol: самодостаточные стили (без CSS темы) ── */
.apkc-hero {
  --apkc-accent: #f59e0b;
  --apkc-cyan: #79f2ff;
  --apkc-primary: #2563eb;
  --apkc-green: #22c55e;
  --apkc-text: #e6edf7;
  --apkc-muted: #9aa8bd;
  --apkc-soft: #c7d2e5;
  --apkc-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.apkc-hero::before {
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
.apkc-hero::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 680px;
  height: 680px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(245, 158, 11, .14), transparent 66%);
  filter: blur(8px);
  animation: apkcHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes apkcHeroGlow {
  from { opacity: .35; transform: scale(.95); }
  to { opacity: .78; transform: scale(1.05); }
}
.apkc-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.apkc-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.apkc-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5vw, 64px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.apkc-hero .apkc-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--apkc-accent) 46%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.apkc-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 158, 11, 0.28);
  border-radius: 999px;
  background: rgba(245, 158, 11, 0.1);
  color: var(--apkc-accent) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.apkc-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--apkc-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.apkc-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.apkc-hero .nero-ai-badge {
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
.apkc-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.apkc-hero .nero-ai-btn {
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
  transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
}
.apkc-hero .nero-ai-btn:hover,
.apkc-hero .nero-ai-btn:focus-visible { transform: translateY(-2px); }
.apkc-hero .nero-ai-btn--primary,
.apkc-hero .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--apkc-accent), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 158, 11, 0.24);
}
.apkc-hero .nero-ai-btn--ghost,
.apkc-hero .nero-ai-btn-secondary {
  color: var(--apkc-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.apkc-hero .nero-ai-btn--ghost:hover,
.apkc-hero .nero-ai-btn-secondary:hover {
  border-color: rgba(121, 242, 255, 0.36);
  background: rgba(121, 242, 255, 0.08);
}
.apkc-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--apkc-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.apkc-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.apkc-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.apkc-hero .nero-ai-dots { display: flex; gap: 7px; }
.apkc-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.apkc-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.apkc-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.apkc-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.apkc-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.apkc-hero .nero-ai-window-body { padding: 16px; }
.apkc-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.apkc-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.apkc-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
  white-space: nowrap;
}
.apkc-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--apkc-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: apkcPulse 1.6s infinite;
}
@keyframes apkcPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.apkc-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
}
.apkc-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
  transition: transform .22s ease, border-color .22s ease;
}
.apkc-hero .nero-ai-metric:hover { transform: translateY(-2px); border-color: rgba(121,242,255,.3); }
.apkc-hero .nero-ai-metric--warn { border-color: rgba(245,158,11,.28); background: rgba(245,158,11,.08); }
.apkc-hero .nero-ai-metric span {
  display: block;
  color: var(--apkc-muted);
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
}
.apkc-hero .nero-ai-metric strong {
  display: block;
  margin-top: 6px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.apkc-hero .nero-ai-metric--warn strong { color: var(--apkc-accent); }
.apkc-hero .nero-ai-metric small {
  display: block;
  margin-top: 5px;
  color: #9fb0c9;
  font-size: 11px;
}
.apkc-hero .nero-ai-task-stream {
  margin-top: 14px;
  display: grid;
  gap: 8px;
}
.apkc-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  animation: apkcTaskFloat 5s ease-in-out infinite;
}
.apkc-hero .nero-ai-task:nth-child(2) { animation-delay: .6s; }
.apkc-hero .nero-ai-task:nth-child(3) { animation-delay: 1.2s; }
@keyframes apkcTaskFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-3px); }
}
.apkc-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 8px;
  background: rgba(121,242,255,.12);
  color: var(--apkc-cyan);
  font-size: 10px;
  font-weight: 800;
}
.apkc-hero .nero-ai-task--warn .nero-ai-task-icon {
  background: rgba(245,158,11,.16);
  color: var(--apkc-accent);
}
.apkc-hero .nero-ai-task div strong {
  display: block;
  color: #fff;
  font-size: 13px;
  font-weight: 700;
}
.apkc-hero .nero-ai-task div span {
  display: block;
  color: var(--apkc-muted);
  font-size: 11px;
  margin-top: 2px;
}
.apkc-hero .nero-ai-status {
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #86efac;
}
.apkc-hero .nero-ai-status--pending {
  background: rgba(245,158,11,.14);
  color: #fcd34d;
}
.apkc-hero .nero-ai-status--live {
  background: rgba(121,242,255,.12);
  color: var(--apkc-cyan);
}
@media (max-width: 960px) {
  .apkc-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .apkc-hero .nero-ai-dashboard { transform: none; }
  .apkc-hero .nero-ai-metrics-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 520px) {
  .apkc-hero .nero-ai-metrics-grid { grid-template-columns: 1fr; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai производство контроль</p>
      <h1 id="hero-apkc-title">AI-агент для сменных заданий и <span class="apkc-gradient-text">контроля простоев</span>: внедрение под ключ</h1>
      <p class="nero-ai-hero-lead">Задачи меняются вручную, простои фиксируются поздно — AI собирает данные по смене, фиксирует отклонения и формирует отчёт руководителю</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">ai сменные задания</li>
        <li class="nero-ai-badge">контроль простоев</li>
        <li class="nero-ai-badge">human-in-the-loop</li>
        <li class="nero-ai-badge">пилот 4–8 недель</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn--primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        <a class="nero-ai-btn nero-ai-btn--ghost" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: сменный центр и контроль простоев">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots" aria-hidden="true">
            <span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span>
          </div>
          <span class="nero-ai-window-title">Сменный центр · ai производство контроль</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Сменный центр · live</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--warn">
              <span>Простой смены</span>
              <strong>23 мин</strong>
              <small>фиксация в реальном времени</small>
            </div>
            <div class="nero-ai-metric">
              <span>Задания</span>
              <strong>8/12</strong>
              <small>очередь по РЦ</small>
            </div>
            <div class="nero-ai-metric">
              <span>Статус</span>
              <strong>live</strong>
              <small>события смены</small>
            </div>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task nero-ai-task--warn">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Простой РЦ-3</strong><span>запрос причины у оператора</span></div>
              <span class="nero-ai-status nero-ai-status--live">live</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>План пересобран</strong><span>ожидает ОК мастера</span></div>
              <span class="nero-ai-status nero-ai-status--pending">ожидает</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">OK</span>
              <div><strong>Отчёт смены готов</strong><span>отправлен руководителю</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<style>
/* === APKC: тело лонгрида ai-proizvodstvo-kontrol (не hero) === */
.apkc-content{
  --apkc-bg:#050711;--apkc-bg2:#080b17;
  --apkc-text:#e6edf7;--apkc-muted:#9aa8bd;--apkc-soft:#c7d2e5;--apkc-heading:#fff;
  --apkc-border:rgba(255,255,255,.10);
  --apkc-accent:#f59e0b;--apkc-cyan:#79f2ff;--apkc-green:#22c55e;--apkc-violet:#8b5cf6;
  --apkc-btn-from:#2563eb;--apkc-btn-to:#7c3aed;
  --apkc-r:18px;--apkc-r-lg:24px;--apkc-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--apkc-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.apkc-content *,.apkc-content *::before,.apkc-content *::after{box-sizing:border-box;}
.apkc-content a{color:inherit;text-decoration:none;}
.apkc-content p{color:var(--apkc-muted);line-height:1.72;margin:0 0 1em;}
.apkc-content p:last-child{margin-bottom:0;}
.apkc-content h2,.apkc-content h3,.apkc-content h4{color:var(--apkc-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.apkc-content strong{color:var(--apkc-soft);}
.apkc-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.apkc-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apkc-muted);font-size:14.5px;line-height:1.65;}
.apkc-content ul li::before{content:'›';position:absolute;left:0;color:var(--apkc-accent);font-weight:700;}
.apkc-cnt{width:min(var(--apkc-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.apkc-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.apkc-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.apkc-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.apkc-sh.apkc-left{margin-left:0;text-align:left;}
.apkc-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.apkc-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.apkc-sh.apkc-left p{margin-left:0;}
.apkc-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apkc-accent);margin-bottom:14px;}
.apkc-gt{background:linear-gradient(92deg,#fff 0%,var(--apkc-accent) 44%,var(--apkc-cyan) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.apkc-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.apkc-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.apkc-intro-text{position:relative;padding-left:20px;}
.apkc-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apkc-accent),var(--apkc-cyan));}
.apkc-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.apkc-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;}
.apkc-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--apkc-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.apkc-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apkc-muted);line-height:1.4;}
.apkc-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.apkc-intro-grid{grid-template-columns:1fr;gap:36px;}}
.apkc-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.apkc-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.apkc-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid var(--apkc-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--apkc-muted);transition:border-color .2s,color .2s;}
.apkc-toc a:hover{border-color:rgba(245,158,11,.42);color:var(--apkc-accent);}
.apkc-bento{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-top:28px;}
@media(max-width:640px){.apkc-bento{grid-template-columns:1fr;}}
.apkc-bento-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:var(--apkc-r);padding:22px;}
.apkc-bento-card h3{font-size:16px;margin-bottom:8px;}
.apkc-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apkc-border);border-radius:var(--apkc-r-lg);padding:26px;backdrop-filter:blur(16px);}
.apkc-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.apkc-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.apkc-grid-2,.apkc-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.apkc-grid-3{grid-template-columns:1fr 1fr;}}
.apkc-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--apkc-r);padding:26px;margin-bottom:14px;}
.apkc-scenario:last-child{margin-bottom:0;}
.apkc-scenario h3{font-size:17px;margin-bottom:8px;}
.apkc-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.apkc-table{width:100%;border-collapse:collapse;font-size:14px;}
.apkc-table th{padding:13px 16px;text-align:left;background:rgba(245,158,11,.1);color:var(--apkc-accent);font-weight:700;border-bottom:1px solid rgba(245,158,11,.25);}
.apkc-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apkc-text);vertical-align:top;}
.apkc-table tr:last-child td{border-bottom:none;}
.apkc-timeline{position:relative;padding-left:40px;}
.apkc-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--apkc-accent),var(--apkc-cyan));opacity:.35;}
.apkc-tl-item{position:relative;margin-bottom:32px;}
.apkc-tl-item:last-child{margin-bottom:0;}
.apkc-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--apkc-accent);box-shadow:0 0 0 4px rgba(245,158,11,.2);}
.apkc-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.apkc-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.apkc-case-grid{grid-template-columns:1fr;}}
.apkc-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.apkc-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apkc-green);margin-bottom:10px;}
.apkc-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.apkc-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.apkc-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--apkc-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;}
.apkc-faq-q::after{content:'▾';font-size:13px;color:var(--apkc-accent);transition:transform .25s;}
.apkc-faq-item.open .apkc-faq-q::after{transform:rotate(180deg);}
.apkc-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease;font-size:14.5px;color:var(--apkc-muted);line-height:1.72;}
.apkc-faq-item.open .apkc-faq-a{max-height:800px;padding:0 24px 20px;}
.apkc-callout{border-left:4px solid var(--apkc-accent);padding:20px 24px;background:rgba(245,158,11,.06);border-radius:0 14px 14px 0;margin:24px 0;}
.apkc-callout blockquote{margin:0;font-style:italic;color:var(--apkc-soft);}
.apkc-flow{display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:8px 12px;padding:20px;background:rgba(255,255,255,.04);border-radius:16px;border:1px solid rgba(255,255,255,.08);font-size:13px;font-weight:600;color:var(--apkc-muted);}
.apkc-flow span{color:var(--apkc-cyan);}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,158,11,.12),rgba(121,242,255,.08));border:1px solid rgba(245,158,11,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,158,11,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--apkc-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.ym-btn--accent{background:linear-gradient(135deg,var(--apkc-btn-from),var(--apkc-btn-to));color:#fff!important;}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--apkc-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--apkc-cyan)!important;text-decoration:underline!important;}
</style>

<div class="apkc-content">

  <section class="apkc-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="apkc-cnt">
      <div class="apkc-intro-grid nero-ai-reveal">
        <div class="apkc-intro-text">
          <p class="apkc-eyebrow">Лонгрид · ai производство контроль</p>
          <p><strong>Коротко:</strong> AI-агент для <strong>ai производство контроль</strong> — программный слой поверх 1С, Excel и Telegram, который автоматизирует <strong>сменные задания</strong>, фиксирует <strong>простои в реальном времени</strong> и формирует <strong>отчёт руководителю</strong> без ручной сводки. Nero Network внедряет решение <strong>под ключ</strong> на одном участке за 4–8 недель — с подтверждением мастера на каждом критическом шаге.</p>
          <p>На малом производстве директор часто узнаёт о потере не в смене, а на утреннем совещании. <strong>AI для производства</strong> закрывает разрыв — не заменяя ERP, а автоматизируя то, что в учётной системе всё равно делается вручную.</p>
        </div>
        <div class="apkc-intro-kpi" aria-label="Ориентиры">
          <div class="apkc-kpi-card"><div class="kv">4–8</div><div class="kl">недель пилот</div><div class="ks">один участок</div></div>
          <div class="apkc-kpi-card"><div class="kv">500 тыс.+</div><div class="kl">коридор чека</div><div class="ks">пилот + интеграция</div></div>
          <div class="apkc-kpi-card"><div class="kv">human-in-the-loop</div><div class="kl">мастер подтверждает</div><div class="ks">ответ Gartner</div></div>
          <div class="apkc-kpi-card"><div class="kv">Telegram</div><div class="kl">интерфейс цеха</div><div class="ks">без MES на старте</div></div>
        </div>
      </div>
      <div class="apkc-flow nero-ai-reveal" style="margin-top:28px;" aria-label="Схема потока">
        Excel / WhatsApp → <span>AI-агент смены</span> → Telegram → <span>отчёт директору</span>
      </div>
    </div>
  </section>

  <div class="apkc-cnt apkc-related-wrap nero-ai-reveal" style="margin:24px auto 8px;">
  <p class="apkc-related" style="font-size:15px;line-height:1.7;color:#64748b;margin:0 0 14px;">Слой поверх 1С:ERP и Excel — не отдельный MES, а автоматизация сменных заданий и простоев в учётном контуре. Подробнее о смежном сценарии: <a href="<?php echo esc_url($apkc_public_base . '/ai-1c-erp/'); ?>" style="color:#d97706;text-decoration:underline;text-underline-offset:3px">внедрение AI-агента для 1С и ERP под ключ</a>.</p>
  <p class="apkc-related" style="font-size:15px;line-height:1.7;color:#64748b;margin:0;">Когда заявки и статусы смены уходят в CRM (amoCRM, Битрикс24), полезно сравнить с готовой посадочной: <a href="<?php echo esc_url($apkc_public_base . '/vnedrenie-ai-amocrm/'); ?>" style="color:#d97706;text-decoration:underline;text-underline-offset:3px">AI-агент для amoCRM: внедрение под ключ</a>.</p>
</div>

  <div class="apkc-toc-outer">
    <div class="apkc-cnt">
      <nav class="apkc-toc" aria-label="Оглавление">
        <a href="#problema">Проблема</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Этапы</a>
        <a href="#integracii">Интеграции</a>
        <a href="#otrasli">Отрасли</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Заказать</a>
      </nav>
    </div>
  </div>

  <section class="apkc-section" id="problema">
    <div class="apkc-cnt">
      <div class="apkc-sh apkc-left nero-ai-reveal">
        <span class="apkc-eyebrow">Боль цеха</span>
        <h2>Задачи меняются вручную, простои фиксируются поздно — что теряет малое производство</h2>
        <p><strong>Определение:</strong> когда задачи меняются вручную, а простои фиксируются поздно, руководитель теряет управляемость смены — план устаревает к обеду, отчёт собирают из пяти источников.</p>
      </div>

      <div class="apkc-bento nero-ai-reveal">
        <div class="apkc-bento-card"><h3>📋 Бумага и Excel</h3><p>Сменные задания — наряд, Google Таблица или файл на диске; при срочном заказе мастер звонит или пишет в чат.</p></div>
        <div class="apkc-bento-card"><h3>💬 WhatsApp / Telegram</h3><p>Заявки теряются, нет аудита «кто и когда изменил приоритет».</p></div>
        <div class="apkc-bento-card"><h3>🏭 1С без MES</h3><p>ERP формально есть, но «цех живёт в Excel» — типичная картина без полноценного MES.</p></div>
        <div class="apkc-bento-card"><h3>⏱ Простои постфактум</h3><p>Узнают по итогам смены или при обходе — не в момент события. OEE остаётся «для больших заводов».</p></div>
      </div>

      <div class="apkc-table-wrap nero-ai-reveal">
        <table class="apkc-table">
          <thead><tr><th>Источник</th><th>Показатель</th><th>Комментарий</th></tr></thead>
          <tbody>
            <tr><td>Меридиан / Biz360</td><td>простой = <strong>1–3% оборота</strong></td><td>ориентир для промышленности</td></tr>
            <tr><td>inet-technology.ru, 2024</td><td><strong>−25%</strong> простоев</td><td>металлоконструкции, Челябинск</td></tr>
            <tr><td>Deloitte Insights</td><td><strong>~$50 млрд/год</strong></td><td>незапланированные простои (глобально)</td></tr>
            <tr><td>Меридиан</td><td><strong>15,8%</strong> предприятий</td><td>высокий уровень мониторинга</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="max-width:720px;">Если задачи меняются вручную, а простои фиксируются поздно, вы платите не только за простой станка — вы платите за <strong>невидимые решения</strong>: неправильный приоритет, лишняя переналадка, повторный брак.</p>
    </div>
  </section>

  <div class="apkc-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-problema">
      <div class="ym-cta-block__icon" aria-hidden="true">🏭</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Найти простои на вашем участке</p>
        <p class="ym-cta-block__sub">Бесплатный вход: лид-магнит «Карта потерь производства» — за 3–5 дней покажем, где теряются часы смены (Excel, WhatsApp, 1С). Без обязательств.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
      </div>
    </div>
  </div>

  <section class="apkc-section apkc-section-alt" id="kak-rabotaet">
    <div class="apkc-cnt">
      <div class="apkc-sh nero-ai-reveal">
        <span class="apkc-eyebrow">Решение</span>
        <h2>AI-агент для сменных заданий и контроля простоев: <span class="apkc-gt">как это работает</span></h2>
        <p>Программный слой поверх 1С:ERP, Excel, Telegram — перераспределяет задания, фиксирует отклонения в момент события, собирает сменную сводку. Критические действия — только с подтверждением мастера.</p>
      </div>

      <div class="apkc-scenario nero-ai-reveal" id="sbornik-dannyh">
        <h3>Сбор данных по смене и выдача заданий операторам</h3>
        <p>Утром агент подтягивает план из 1С или Excel → формирует сменные задания по рабочим центрам → отправляет мастеру в Telegram для подтверждения или правки.</p>
        <div class="apkc-table-wrap">
          <table class="apkc-table">
            <thead><tr><th>Было</th><th>Стало с AI-агентом</th></tr></thead>
            <tbody>
              <tr><td>План в Excel, изменения — звонки</td><td><strong>Автоматизация сменных заданий</strong> при смене приоритета</td></tr>
              <tr><td>Оператор не знает очередь</td><td>Мобильный вид: что делать сейчас, что дальше</td></tr>
              <tr><td>Нет связи заказ ↔ РЦ ↔ человек</td><td>Привязка к людям и станкам (operator-aware scheduling)</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="apkc-scenario nero-ai-reveal" id="fiksaciya-prostoev">
        <h3>Фиксация простоев и отклонений в реальном времени</h3>
        <p>Оператор отмечает старт/стоп или срабатывает датчик → агент фиксирует timestamp → запрашивает причину (кнопки + текст) → классифицирует в стандартный код.</p>
        <p>Связка PROTECH / «Башспирт»: датчик → Telegram → причина → аналитика; за 3 мес. эффективность <strong>+7%</strong>, простои <strong>−30 мин/день</strong> на 6 линиях.</p>
      </div>

      <div class="apkc-scenario nero-ai-reveal" id="otchet-rukovoditelyu">
        <h3>Отчёт руководителю без ручной сводки</h3>
        <p>К концу смены: выпуск план/факт, простои по причинам, отклонения от плана, эскалации с подтверждением мастера — в Telegram, email или дашборд <strong>без</strong> «собери из пяти систем к 18:00».</p>
      </div>

      <div class="apkc-card nero-ai-reveal" style="margin-top:24px;text-align:center;">
        <p><strong>Итог:</strong> ai для производства и ai для цеха в одном продукте — сменные задания, контроль простоев, отчёт директору. Не три проекта, а один агент смены.</p>
      </div>
    </div>
  </section>

<!-- === БОРИС: визуальный блок (canvas), вставка после #kak-rabotaet === -->
<section id="ai-proizvodstvo-kontrol-boris-block" class="apkc-boris-root" aria-label="Анимация: фиксация простоя на рабочем центре и подтверждение мастера">
<style>
#ai-proizvodstvo-kontrol-boris-block.apkc-boris-root{padding:56px 0 64px;background:#f8fafc;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:480px;}
@media(max-width:1023px){#ai-proizvodstvo-kontrol-boris-block .apkc-boris-card{grid-template-columns:1fr;min-height:auto;}}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#ai-proizvodstvo-kontrol-boris-block .apkc-boris-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-ey{font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#d97706;margin:0 0 14px;display:flex;align-items:center;gap:8px;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-ey::before{content:'';width:18px;height:2px;background:#d97706;border-radius:1px;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-ul li{display:flex;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(217,119,6,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#b45309;font-style:normal;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-pl-a{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22);}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-pl-c{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#ai-proizvodstvo-kontrol-boris-block .apkc-boris-rgt{position:relative;background:linear-gradient(135deg,#fffbeb 0%,#fef3c7 20%,#f0f9ff 70%,#f8fafc 100%);min-height:420px;overflow:hidden;}
#apkc-shift-monitor-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>
<div class="apkc-boris-cnt">
  <div class="apkc-boris-card">
    <div class="apkc-boris-lft">
      <span class="apkc-boris-ey">Мостик оператора · ai контроль простоев</span>
      <h3 class="apkc-boris-h3">Простой на РЦ — причина в Telegram — «ОК» мастера до эскалации</h3>
      <ul class="apkc-boris-ul">
        <li><span class="apkc-boris-ic">⚡</span>Датчик или кнопка оператора фиксирует остановку с timestamp</li>
        <li><span class="apkc-boris-ic">📱</span>Агент запрашивает код причины — кнопки + текст в Telegram</li>
        <li><span class="apkc-boris-ic">🔄</span>При смене приоритета заказа — пересборка очереди с подтверждением</li>
        <li><span class="apkc-boris-ic">✓</span>Human-in-the-loop: критические шаги только после «ОК» мастера</li>
      </ul>
      <div class="apkc-boris-pills">
        <span class="apkc-boris-pl apkc-boris-pl-a">live фиксация</span>
        <span class="apkc-boris-pl apkc-boris-pl-g">−30 мин/день</span>
        <span class="apkc-boris-pl apkc-boris-pl-c">PROTECH-паттерн</span>
      </div>
      <p class="apkc-boris-foot">Дальше — этапы внедрения ai производство контроль под ключ →</p>
    </div>
    <div class="apkc-boris-rgt">
      <canvas id="apkc-shift-monitor-canvas" role="img" aria-label="Анимация: рабочие центры, лента простоев, Telegram-алерт и подтверждение мастера"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
'use strict';
var cv=document.getElementById('apkc-shift-monitor-canvas');
if(!cv)return;
var ctx=cv.getContext('2d'),W=0,H=0,frame=0;
function resize(){
  var p=cv.parentElement;if(!p)return;
  cv.width=p.clientWidth||640;cv.height=p.clientHeight||420;
  W=cv.width;H=cv.height;
}
window.addEventListener('resize',resize);resize();
var C={ink:'#0f172a',muted:'#64748b',floor:'#e2e8f0',machine:'#94a3b8',machineOn:'#22c55e',alert:'#f59e0b',alertRed:'#ef4444',tg:'#229ED9',tgPanel:'#f0f9ff',ok:'#16a34a',okGlow:'rgba(34,197,94,.35)',line:'rgba(14,165,233,.35)'};
var STATIONS=[{x:.18,label:'РЦ-1'},{x:.38,label:'РЦ-2'},{x:.58,label:'РЦ-3'},{x:.78,label:'РЦ-4'}];
var LOOP=720;
function rr(x,y,w,h,r,fill,stroke,lw){
  ctx.beginPath();
  if(ctx.roundRect)ctx.roundRect(x,y,w,h,r);else ctx.rect(x,y,w,h);
  if(fill){ctx.fillStyle=fill;ctx.fill();}
  if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke();}
}
function drawFloor(){
  var fy=H*.58;
  rr(24,fy,W-48,8,4,C.floor,null,0);
  STATIONS.forEach(function(st,i){
    var sx=st.x*W,sy=fy-72;
    var pulse=(Math.sin(frame*.04+i)*.5+.5);
    var down=(frame%LOOP)>120&&(frame%LOOP)<380&&i===2;
    rr(sx-36,sy,72,56,8,down?'#fecaca':'#f1f5f9',down?C.alertRed:C.machine,2);
    rr(sx-28,sy+8,56,32,4,down?'rgba(239,68,68,.15)':'rgba(34,197,94,.12)',null,0);
    ctx.fillStyle=C.ink;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='center';
    ctx.fillText(st.label,sx,fy-78);
    if(!down){ctx.fillStyle=C.machineOn;ctx.beginPath();ctx.arc(sx+24,sy+10,4,0,Math.PI*2);ctx.fill();}
    else{ctx.fillStyle=C.alertRed;ctx.font='bold 10px Inter,sans-serif';ctx.fillText('STOP',sx,sy+30);}
  });
}
function drawEventPipe(){
  var t=(frame%LOOP)/LOOP;
  var ex=40+t*(W*.42);
  var ey=H*.32;
  rr(ex,ey,88,36,10,'#fff7ed',C.alert,2);
  ctx.fillStyle=C.alert;ctx.font='bold 10px Inter,sans-serif';ctx.textAlign='left';
  ctx.fillText('Простой РЦ-3',ex+10,ey+16);
  ctx.fillStyle=C.muted;ctx.font='10px Inter,sans-serif';
  ctx.fillText('запрос причины…',ex+10,ey+28);
}
function drawTelegram(){
  var tx=W*.52,ty=H*.18,tw=W*.4,th=H*.52;
  rr(tx,ty,tw,th,14,C.tgPanel,C.line,2);
  rr(tx,ty,tw,28,14,C.tg,null,0);
  ctx.fillStyle='#fff';ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='left';
  ctx.fillText('Telegram · мастер смены',tx+12,ty+18);
  var msgs=[
    {y:44,t:'⚠ Простой РЦ-3 · 4 мин',c:'#fef3c7'},
    {y:78,t:'Причина: переналадка?',c:'#fff'},
    {y:112,t:'[OK мастера] Подтвердить',c:'#dcfce7'}
  ];
  msgs.forEach(function(m,i){
    var show=frame%LOOP>200+i*50;
    if(!show)return;
    rr(tx+12,ty+m.y,tw-24,26,8,m.c,'#e2e8f0',1);
    ctx.fillStyle=C.ink;ctx.font='10px Inter,sans-serif';
    ctx.fillText(m.t,tx+20,ty+m.y+17);
  });
  if(frame%LOOP>360){
    var pulse=.5+.5*Math.sin(frame*.12);
    rr(tx+tw-90,ty+th-44,78,28,99,'rgba(22,163,74,'+(0.7+pulse*.3)+')',C.ok,2);
    ctx.fillStyle='#fff';ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='center';
    ctx.fillText('✓ ОК',tx+tw-51,ty+th-26);
  }
}
function loop(){
  frame++;
  ctx.clearRect(0,0,W,H);
  drawFloor();drawEventPipe();drawTelegram();
  requestAnimationFrame(loop);
}
loop();
})();
</script>
</section>

  <section class="apkc-section" id="etapy">
    <div class="apkc-cnt">
      <div class="apkc-sh apkc-left nero-ai-reveal">
        <span class="apkc-eyebrow">Под ключ</span>
        <h2>Внедрение AI на производстве под ключ: этапы и сроки</h2>
        <p><strong>Ai производство контроль под ключ</strong> — один цех / 3–8 рабочих мест за <strong>4–8 недель</strong>. Узкий ROI-сценарий, не «agentic AI на всё предприятие».</p>
      </div>
      <div class="apkc-card nero-ai-reveal">
        <div class="apkc-timeline">
          <div class="apkc-tl-item"><div class="apkc-tl-dot"></div><h3>Аудит простоев и карта потерь (3–5 дней)</h3><p>Разбор as-is: Excel, WhatsApp, 1С; карта РЦ и кодов простоев; ТЗ на пилот. Лид-магнит «Карта потерь производства».</p></div>
          <div class="apkc-tl-item"><div class="apkc-tl-dot"></div><h3>Пилот на одной смене (2–4 нед. + 2 нед. обкатки)</h3><p>1С/Telegram, правила перераспределения, human-in-the-loop, отчёт ROI. Ориентир: <strong>500 тыс.–2 млн ₽</strong>.</p></div>
          <div class="apkc-tl-item"><div class="apkc-tl-dot"></div><h3>Масштабирование и журнал аудита</h3><p>Расширение на участки, датчики (этап 2), OEE-лайт. Человек подтверждает план, классификацию, остановку линии.</p></div>
        </div>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать agentic AI до пилота?</p>
          <p class="ym-cta-block__sub">На этапе human-in-the-loop полезно, когда мастер и директор понимают логику агентов. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение'); ?></a> — ускоряет согласование пилота.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="apkc-section apkc-section-alt" id="integracii">
    <div class="apkc-cnt">
      <div class="apkc-sh nero-ai-reveal">
        <span class="apkc-eyebrow">Интеграции</span>
        <h2>Интеграция с учётными системами и CRM</h2>
        <p>AI-слой поверх ERP — не замена. KRONPRINZ + 1С:ERP: простои <strong>−75%</strong> (данные заказчика).</p>
      </div>
      <div class="apkc-table-wrap nero-ai-reveal">
        <table class="apkc-table">
          <thead><tr><th>Система</th><th>Роль</th></tr></thead>
          <tbody>
            <tr><td>1С:ERP / УНФ</td><td>План заказов, сменные задания</td></tr>
            <tr><td>Excel / Google Sheets</td><td>Fallback — старт без MES</td></tr>
            <tr><td>Telegram / WhatsApp</td><td>Интерфейс мастера и операторов</td></tr>
            <tr><td>PROTECH / «Диспетчер»</td><td>Датчики — опционально, этап 2</td></tr>
            <tr><td>Битрикс24 / DataLens</td><td>CRM заявок, дашборд директора</td></tr>
          </tbody>
        </table>
      </div>
      <div class="apkc-table-wrap nero-ai-reveal">
        <table class="apkc-table">
          <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы для малого цеха</th></tr></thead>
          <tbody>
            <tr><td>1С сменные задания (ручное)</td><td>Уже в ERP</td><td>Нет реакции на простой в смене</td></tr>
            <tr><td>1С:MES</td><td>Полный контур</td><td>Долго, «трансформация на 3 года»</td></tr>
            <tr><td><strong>AI-агент-надстройка</strong></td><td>Пилот 4–8 нед., Telegram</td><td>Дисциплина фиксации на старте</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal"><strong>Ai производство контроль без программиста</strong> на стороне заказчика — интеграции делает Nero Network (n8n, API 1С). Нужны мастер, операторы, директор с дашбордом.</p>
    </div>
  </section>

  <section class="apkc-section" id="otrasli">
    <div class="apkc-cnt">
      <div class="apkc-sh nero-ai-reveal">
        <span class="apkc-eyebrow">Отрасли</span>
        <h2>AI для малого производства: цеха, мебель, пищевая отрасль</h2>
        <p>Не язык «ROI 271% и SCADA» — «мастер в Telegram, директор видит простои в смене».</p>
      </div>
      <div class="apkc-grid-3 nero-ai-reveal">
        <div class="apkc-card"><h3>Металло / малые цеха</h3><p>Кейс Челябинск: −25% простоев, +18% выпуск. AI-агент — тот же контур через Telegram.</p></div>
        <div class="apkc-card"><h3>Мебельное производство</h3><p>Наряды по операциям, срочные заказы дилера — пересборка очереди с подтверждением мастера.</p></div>
        <div class="apkc-card"><h3>Пищевое производство</h3><p>PROTECH / «Башспирт»: Telegram, причины простоев; агент фиксирует события для отчётности.</p></div>
      </div>
    </div>
  </section>

  <section class="apkc-section apkc-section-alt" id="ceny">
    <div class="apkc-cnt">
      <div class="apkc-sh nero-ai-reveal">
        <span class="apkc-eyebrow">Коммерция</span>
        <h2>Стоимость внедрения AI-агента: от аудита до масштабирования</h2>
      </div>
      <div class="apkc-table-wrap nero-ai-reveal">
        <table class="apkc-table">
          <thead><tr><th>Этап</th><th>Срок</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td>Аудит + «Карта потерь»</td><td>3–5 дней</td><td>вход через «Найти простои»</td></tr>
            <tr><td>Пилот 3–8 РМ</td><td>4–8 недель</td><td><strong>500 тыс.–1,2 млн ₽</strong></td></tr>
            <tr><td>Масштаб + датчики</td><td>+4–12 нед.</td><td><strong>1–2 млн ₽</strong></td></tr>
            <tr><td>Поддержка</td><td>ежемес.</td><td>25–80 тыс. ₽/мес. (рынок)</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">Если простой — 1–3% оборота, пилот 500 тыс. ₽ часто окупается быстрее корпоративного MES.</p>
      <div class="ym-cta-block nero-ai-reveal">
        <p class="ym-cta-block__headline">Найти простои — расчёт окупаемости</p>
        <p class="ym-cta-block__sub">После карты потерь покажем коридор пилота на вашем участке.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
      </div>
    </div>
  </section>

  <section class="apkc-section" id="keisy">
    <div class="apkc-cnt">
      <div class="apkc-sh nero-ai-reveal">
        <span class="apkc-eyebrow">Доказательства</span>
        <h2>Кейсы и результаты: снижение простоев и прозрачность смен</h2>
        <p>Прямых кейсов «AI-агент = сменные задания + простои под ключ» в РФ мало — ниже смежные внедрения (честно, с источником).</p>
      </div>
      <div class="apkc-case-grid nero-ai-reveal">
        <div class="apkc-case-card"><div class="apkc-case-tag">Пищевое</div><h3>PROTECH / «Башспирт»</h3><p>+7% эффективность, −30 мин/день простоев за 3 мес.</p></div>
        <div class="apkc-case-card"><div class="apkc-case-tag">1С:ERP</div><h3>KRONPRINZ</h3><p>Мониторинг линий, простои −75% (заказчик).</p></div>
        <div class="apkc-case-card"><div class="apkc-case-tag">Металл</div><h3>Челябинск 2024</h3><p>−25% простоев, +18% выпуск, 8 млн ₽/год.</p></div>
        <div class="apkc-case-card"><div class="apkc-case-tag">Telegram</div><h3>«Норд Пак»</h3><p>−15% простоев за 2 мес., +10% эффективность за 3 мес.</p></div>
        <div class="apkc-case-card"><div class="apkc-case-tag">AI-мастер</div><h3>Noltis</h3><p>Ближайший аналог; пилот 420 тыс.–1,8 млн ₽.</p></div>
        <div class="apkc-case-card"><div class="apkc-case-tag">OEE</div><h3>BRAIN2 / «Камский»</h3><p>−50% простоев на смене материалов; окупаемость 3 мес.</p></div>
      </div>
    </div>
  </section>

  <div class="apkc-cnt apkc-related-wrap nero-ai-reveal" style="margin:8px auto 24px;">
  <p class="apkc-related" style="font-size:15px;line-height:1.7;color:#64748b;margin:0 0 14px;">На корпоративном масштабе те же принципы human-in-the-loop и managed-агентов уже проверены в enterprise: в разборе <a href="<?php echo esc_url($apkc_public_base . '/kpmg-claude-vnedrenie-ai-276-tysyach/'); ?>" style="color:#d97706;text-decoration:underline;text-underline-offset:3px">KPMG и Claude: уроки AI для бизнеса</a> — цифровые шлюзы и контроль рисков, которые переносятся на пилот в цехе.</p>
  <p class="apkc-related" style="font-size:15px;line-height:1.7;color:#64748b;margin:0;">Смежный B2B-паттерн «входящий канал → CRM без ручного ввода» описан на странице <a href="<?php echo esc_url($apkc_public_base . '/vnedrenie-ai-obrabotka-email-crm/'); ?>" style="color:#d97706;text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM</a> — полезно, если производство связано с потоком заявок от клиентов.</p>
</div>

  <section class="apkc-section apkc-section-alt" id="agentic">
    <div class="apkc-cnt">
      <div class="apkc-sh nero-ai-reveal">
        <span class="apkc-eyebrow">2026</span>
        <h2>Почему agentic AI на производстве требует проверки результата</h2>
        <p>Gartner (25.06.2025): <strong>более 40% проектов agentic AI отменят к 2027</strong> — затраты, неясный ROI, контроль рисков.</p>
      </div>
      <div class="apkc-callout nero-ai-reveal">
        <blockquote>«Most agentic AI projects right now are early stage experiments… driven by hype and often misapplied» — Anushree Verma, Gartner.</blockquote>
      </div>
      <div class="apkc-table-wrap nero-ai-reveal">
        <table class="apkc-table">
          <thead><tr><th>Риск Gartner</th><th>Ответ Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Неясный ROI</td><td>Узкий сценарий: смена + простои + отчёт; пилот на участке</td></tr>
            <tr><td>Hype</td><td>Агент смены + журнал аудита, не «агент на всё»</td></tr>
            <tr><td>Дорогая интеграция</td><td>Старт Telegram + Excel/1С; датчики — этап 2</td></tr>
            <tr><td>Потеря контроля</td><td>Human-in-the-loop на каждом критическом шаге</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apkc-section" id="faq">
    <div class="apkc-cnt">
      <div class="apkc-sh nero-ai-reveal">
        <span class="apkc-eyebrow">FAQ</span>
        <h2>FAQ: как внедрить AI-контроль на производстве</h2>
      </div>
      <div class="apkc-faq nero-ai-reveal">
        <div class="apkc-faq-item"><div class="apkc-faq-q" role="button" tabindex="0">Как внедрить ai производство контроль?</div><div class="apkc-faq-a">1) «Найти простои» → аудит и карта потерь. 2) 1С/Excel + Telegram. 3) Коды простоев и правила. 4) Пилот human-in-the-loop. 5) ROI → масштаб.</div></div>
        <div class="apkc-faq-item"><div class="apkc-faq-q" role="button" tabindex="0">Сколько стоит и сколько длится?</div><div class="apkc-faq-a">Пилот 4–8 нед., 500 тыс.–2 млн ₽. Аудит 3–5 дней. Окупаемость — по карте потерь; смежные кейсы от 3 мес. до &lt;1 мес.</div></div>
        <div class="apkc-faq-item"><div class="apkc-faq-q" role="button" tabindex="0">Нужны ли программисты в цеху?</div><div class="apkc-faq-a">Нет. Нужны мастер (подтверждения) и операторы (фиксация простоев).</div></div>
        <div class="apkc-faq-item"><div class="apkc-faq-q" role="button" tabindex="0">Какие системы подключить?</div><div class="apkc-faq-a">1С:ERP, УНФ, MES, Excel, Telegram, WhatsApp, Битрикс24, DataLens, датчики опционально.</div></div>
        <div class="apkc-faq-item"><div class="apkc-faq-q" role="button" tabindex="0">Нужны ли датчики с первого дня?</div><div class="apkc-faq-a">Нет. Старт — Telegram + ручная фиксация; датчики на этапе 2.</div></div>
        <div class="apkc-faq-item"><div class="apkc-faq-q" role="button" tabindex="0">Чем вы отличаетесь от Noltis, PROTECH, 1С:MES?</div><div class="apkc-faq-a">Noltis — помощник мастера; PROTECH — простои; 1С:MES — полный контур. Мы — сменные задания + простои + отчёт в одном пакете для малого цеха за недели, не годы.</div></div>
        <div class="apkc-faq-item"><div class="apkc-faq-q" role="button" tabindex="0">Это хайп agentic AI?</div><div class="apkc-faq-a">Gartner 40% отмен + наш подход: узкий ROI, пилот, подтверждения, журнал аудита.</div></div>
      </div>
    </div>
  </section>

  <section class="apkc-section" id="cta">
    <div class="apkc-cnt">
      <div class="apkc-sh nero-ai-reveal">
        <h2>Заказать внедрение AI-агента для производства</h2>
        <p>AI-агент сменных заданий и контроля простоев · Telegram · дашборд · human-in-the-loop · интеграция без программиста в цеху.</p>
      </div>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Карта потерь производства — бесплатно при заявке</p>
          <p class="ym-cta-block__sub">Пилот 4–8 недель · 500 тыс.–2 млн ₽ · ai производство контроль внедрение под ключ</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.apkc-content -->

<?php
$apkc_schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => $apkc_public_base . '/#organization',
            'name' => $apkc_brand_name,
            'url' => $apkc_public_base . '/',
        ],
        [
            '@type' => 'WebSite',
            '@id' => $apkc_public_base . '/#website',
            'url' => $apkc_public_base . '/',
            'name' => $apkc_brand_name,
            'publisher' => ['@id' => $apkc_public_base . '/#organization'],
        ],
        [
            '@type' => 'WebPage',
            '@id' => $apkc_page_url . '#webpage',
            'url' => $apkc_page_url,
            'name' => 'AI-агент для сменных заданий и контроля простоев: внедрение под ключ',
            'description' => $page_seo_description,
            'isPartOf' => ['@id' => $apkc_public_base . '/#website'],
            'about' => ['@id' => $apkc_public_base . '/#organization'],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $apkc_page_url . '#breadcrumb',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Главная',
                    'item' => $apkc_public_base . '/',
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'AI-агент для сменных заданий и контроля простоев: внедрение под ключ',
                    'item' => $apkc_page_url,
                ],
            ],
        ],
        [
            '@type' => 'Service',
            '@id' => $apkc_page_url . '#service',
            'name' => 'AI-агент для сменных заданий и контроля простоев: внедрение под ключ',
            'description' => $page_seo_description,
            'url' => $apkc_page_url,
            'provider' => ['@id' => $apkc_public_base . '/#organization'],
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $apkc_page_url . '#faq',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Как внедрить ai производство контроль?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => '1) «Найти простои» → аудит и карта потерь. 2) 1С/Excel + Telegram. 3) Коды простоев и правила. 4) Пилот human-in-the-loop. 5) ROI → масштаб.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Сколько стоит и сколько длится?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Пилот 4–8 нед., 500 тыс.–2 млн ₽. Аудит 3–5 дней. Окупаемость — по карте потерь; смежные кейсы от 3 мес. до <1 мес.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Нужны ли программисты в цеху?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Нет. Нужны мастер (подтверждения) и операторы (фиксация простоев).',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Какие системы подключить?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => '1С:ERP, УНФ, MES, Excel, Telegram, WhatsApp, Битрикс24, DataLens, датчики опционально.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Нужны ли датчики с первого дня?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Нет. Старт — Telegram + ручная фиксация; датчики на этапе 2.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Чем вы отличаетесь от Noltis, PROTECH, 1С:MES?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Noltis — помощник мастера; PROTECH — простои; 1С:MES — полный контур. Мы — сменные задания + простои + отчёт в одном пакете для малого цеха за недели, не годы.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Это хайп agentic AI?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Gartner 40% отмен + наш подход: узкий ROI, пилот, подтверждения, журнал аудита.',
                    ],
                ],
            ],
        ],
    ],
];
?>
  <script type="application/ld+json"><?php echo wp_json_encode($apkc_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>

</main>

<script>
(function(){
  document.querySelectorAll('.apkc-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.apkc-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.apkc-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.apkc-faq-q');
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
  var root = document.querySelector('.apkc-page') || document.querySelector('.nero-ai-home-page');
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
