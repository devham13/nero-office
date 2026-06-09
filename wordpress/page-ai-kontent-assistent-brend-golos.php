<?php
/**
 * Template Name: AI-контент-ассистент с бренд-голосом: внедрение под ключ
 * Description: Внедряем AI-контент-ассистента с настройкой голоса бренда: посты, тексты и контент-план в едином тоне компании.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-контент-ассистент с бренд-голосом: внедрение под ключ';
$page_seo_description = 'Внедряем AI-контент-ассистента с настройкой голоса бренда: посты, тексты и контент-план в едином тоне компании. Кейсы, интеграции с CRM. План на 14 дней — бесплатно.';

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
    ['label' => 'Что это', 'href' => '#chto-takoe'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Форматы', 'href' => '#formaty'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Получить контент-план';
$primary_cta_url     = nero_ai_primary_cta_url();
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

<?php nero_ai_echo_theme_styles(); ?>

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

.breadcrumbs, .breadcrumb, .breadcrumb-list, .breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb, .rank-math-breadcrumb, .rank-math-breadcrumbs, .yoast-breadcrumb,
.entry-header, .page-title-section { display: none !important; }

#primary, .site-main, .site-content, #content, .content-area {
  padding-top: 0 !important;
  margin-top: 0 !important;
}

.ai-kontent-assistent-brend-golos-page .nero-ai-hero.aka-hero-brend-golos {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

/* Hero ai-kontent-assistent-brend-golos */

/* ── Hero ai-kontent-assistent-brend-golos: самодостаточные стили ── */
.aka-hero-brend-golos {
  --aka-violet: #c084fc;
  --aka-coral: #fb7185;
  --aka-mint: #6ee7b7;
  --aka-text: #e6edf7;
  --aka-muted: #9aa8bd;
  --aka-soft: #c7d2e5;
  --aka-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aka-hero-brend-golos::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.aka-hero-brend-golos::after {
  content: "";
  position: absolute;
  left: 6%;
  top: 14%;
  width: 560px;
  height: 560px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(192, 132, 252, .14), transparent 66%);
  filter: blur(8px);
  animation: akaHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes akaHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.aka-hero-brend-golos .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aka-hero-brend-golos .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aka-hero-brend-golos .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aka-hero-brend-golos .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aka-coral) 38%, var(--aka-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aka-hero-brend-golos .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(192, 132, 252, 0.24);
  border-radius: 999px;
  background: rgba(192, 132, 252, 0.08);
  color: var(--aka-violet) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aka-hero-brend-golos .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aka-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aka-hero-brend-golos .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aka-hero-brend-golos .nero-ai-badge {
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
.aka-hero-brend-golos .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aka-hero-brend-golos .nero-ai-btn {
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
.aka-hero-brend-golos .nero-ai-btn:hover { transform: translateY(-2px); }
.aka-hero-brend-golos .nero-ai-btn-primary {
  color: #1a0a18 !important;
  background: linear-gradient(135deg, var(--aka-coral), var(--aka-violet));
  box-shadow: 0 18px 42px rgba(192, 132, 252, 0.28);
}
.aka-hero-brend-golos .nero-ai-btn-secondary {
  color: var(--aka-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aka-hero-brend-golos .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aka-shadow);
  transform: perspective(1100px) rotateY(3deg) rotateX(2deg);
}
.aka-hero-brend-golos .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aka-hero-brend-golos .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aka-hero-brend-golos .nero-ai-dots { display: flex; gap: 7px; }
.aka-hero-brend-golos .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aka-hero-brend-golos .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aka-hero-brend-golos .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aka-hero-brend-golos .nero-ai-dot:nth-child(3) { background: #c084fc; }
.aka-hero-brend-golos .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aka-hero-brend-golos .nero-ai-window-body { padding: 16px; }
.aka-hero-brend-golos .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aka-hero-brend-golos .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aka-hero-brend-golos .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(110, 231, 183, .10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.aka-hero-brend-golos .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #6ee7b7;
  box-shadow: 0 0 0 6px rgba(110, 231, 183, .14);
  animation: akaPulse 1.6s infinite;
}
@keyframes akaPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aka-hero-brend-golos .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aka-hero-brend-golos .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aka-hero-brend-golos .nero-ai-metric span {
  display: block;
  color: var(--aka-muted);
  font-size: 11px;
  font-weight: 700;
}
.aka-hero-brend-golos .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aka-hero-brend-golos .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aka-hero-brend-golos .aka-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(192, 132, 252, 0.18);
  background: radial-gradient(ellipse at 45% 42%, rgba(192,132,252,.09), rgba(6,10,24,.92) 72%);
}
.aka-hero-brend-golos #aka-brand-voice-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aka-hero-brend-golos .nero-ai-task-stream { display: grid; gap: 8px; }
.aka-hero-brend-golos .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aka-hero-brend-golos .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(192,132,252,.12);
  color: var(--aka-violet);
  font-size: 11px;
  font-weight: 800;
}
.aka-hero-brend-golos .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aka-hero-brend-golos .nero-ai-task span {
  color: var(--aka-muted);
  font-size: 11px;
}
.aka-hero-brend-golos .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(110,231,183,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aka-hero-brend-golos .nero-ai-status--amber {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .aka-hero-brend-golos .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aka-hero-brend-golos .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aka-hero-brend-golos .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aka-hero-brend-golos .nero-ai-window-body { padding: 12px; }
  .aka-hero-brend-golos .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aka-hero-brend-golos .nero-ai-status { grid-column: 2; width: fit-content; }
}

</style>

<main id="primary" class="site-main nero-ai-home-page ai-kontent-assistent-brend-golos-page" role="main" tabindex="-1">

<section class="nero-ai-hero aka-hero-brend-golos" id="aka-hero-brend-golos" aria-labelledby="aka-hero-title">
<div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow">Маркетинг / контент · brand voice</p>
      <h1 id="aka-hero-title">AI-контент-ассистент с голосом бренда: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Нейросеть пишет посты, тексты и контент-план в стиле вашей компании — регулярно и без потери тона бренда</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Brand Voice</li>
        <li class="nero-ai-badge">RAG-факты</li>
        <li class="nero-ai-badge">Контент-план 14 дн.</li>
        <li class="nero-ai-badge">Human review</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Получить контент-план'); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-контент-ассистент с бренд-голосом">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Студия brand voice</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>ToV Score</span>
              <strong>92</strong>
              <small>соответствие голосу</small>
            </div>
            <div class="nero-ai-metric">
              <span>Черновиков</span>
              <strong>14</strong>
              <small>в контент-плане</small>
            </div>
            <div class="nero-ai-metric">
              <span>Каналов</span>
              <strong>3</strong>
              <small>VK · TG · email</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время на пост</span>
              <strong>−70%</strong>
              <small>черновик + правка</small>
            </div>
          </div>

          <div class="aka-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aka-brand-voice-canvas" role="img" aria-label="Анимация: черновики с разным тоном проходят через микшер brand voice и попадают в контент-календарь"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий контент-студии">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">VK</span>
              <div><strong>Тема «кейс SMM» → черновик</strong><span>Адаптация под VK, единый тон</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>ToV checker: 94/100</strong><span>0 запрещённых формулировок</span></div>
              <span class="nero-ai-status">проверено</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">14</span>
              <div><strong>Контент-план сформирован</strong><span>Рубрики, дедлайны, каналы</span></div>
              <span class="nero-ai-status">календарь</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Утверждено в Telegram</strong><span>Очередь публикации VK + Дзен</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====================================================
     КОНТЕНТНАЯ ЧАСТЬ — БОРИС (без hero)
     ==================================================== -->
<style>
/* === BKA PAGE — article block styles (scoped) === */
.bka-content{
  --bka-bg:#050711;--bka-bg2:#080b17;
  --bka-text:#e6edf7;--bka-muted:#9aa8bd;--bka-soft:#c7d2e5;--bka-heading:#fff;
  --bka-border:rgba(255,255,255,.10);--bka-accent:#79f2ff;--bka-violet:#8b5cf6;--bka-green:#22c55e;
  --bka-btn-from:#2563eb;--bka-btn-to:#7c3aed;
  --bka-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--bka-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.bka-content *,.bka-content *::before,.bka-content *::after{box-sizing:border-box;}
.bka-content a{color:inherit;text-decoration:none;}
.bka-content p{color:var(--bka-muted);line-height:1.72;margin:0 0 1em;}
.bka-content p:last-child{margin-bottom:0;}
.bka-content h2,.bka-content h3,.bka-content h4{color:var(--bka-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.bka-content strong{color:var(--bka-soft);}
.bka-content ul,.bka-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.bka-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--bka-muted);font-size:14.5px;line-height:1.65;}
.bka-content ul li::before{content:'›';position:absolute;left:0;color:var(--bka-accent);font-weight:700;}
.bka-content ol{counter-reset:bka-ol;margin:0 0 1em;padding:0;}
.bka-content ol li{counter-increment:bka-ol;padding-left:28px;position:relative;margin-bottom:.5em;color:var(--bka-muted);font-size:14.5px;line-height:1.65;}
.bka-content ol li::before{content:counter(bka-ol);position:absolute;left:0;top:0;width:20px;height:20px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--bka-accent);font-size:11px;font-weight:800;display:flex;align-items:center;justify-content:center;}
.bka-cnt{width:min(var(--bka-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.bka-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.bka-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.bka-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.bka-sh.bka-left{margin-left:0;text-align:left;}
.bka-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.bka-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.bka-sh.bka-left p{margin-left:0;}
.bka-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--bka-accent);margin-bottom:14px;}
.bka-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.bka-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.bka-intro-text{position:relative;padding-left:20px;}
.bka-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--bka-accent),var(--bka-violet));}
.bka-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;}
.bka-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.bka-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.bka-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--bka-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.bka-kpi-card .kl{font-size:11px;font-weight:600;color:var(--bka-muted);line-height:1.4;}
.bka-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.bka-intro-grid{grid-template-columns:1fr;gap:36px;}.bka-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.bka-intro-kpi{grid-template-columns:1fr 1fr;}}
.bka-toc-outer{padding:20px 0 8px;position:sticky;top:64px;z-index:20;background:rgba(5,7,17,.92);backdrop-filter:blur(12px);border-bottom:1px solid rgba(255,255,255,.06);}
.bka-toc{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;}
.bka-toc a{padding:7px 14px;border-radius:999px;font-size:12.5px;font-weight:600;color:var(--bka-muted);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);transition:background .2s,color .2s;}
.bka-toc a:hover{background:rgba(121,242,255,.1);color:var(--bka-accent);}
.bka-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:28px 32px;margin-bottom:20px;}
.bka-card h3{font-size:19px;margin-bottom:12px;}
.bka-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
@media(max-width:900px){.bka-grid-3{grid-template-columns:1fr;}}
.bka-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0;}
.bka-table{width:100%;border-collapse:collapse;font-size:14px;}
.bka-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--bka-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.bka-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--bka-text);vertical-align:top;}
.bka-table tr:last-child td{border-bottom:none;}
.bka-table tr:hover td{background:rgba(255,255,255,.03);}
.bka-timeline{display:flex;flex-direction:column;gap:0;}
.bka-tl-item{position:relative;padding:0 0 28px 32px;border-left:2px solid rgba(121,242,255,.2);}
.bka-tl-item:last-child{border-left-color:transparent;padding-bottom:0;}
.bka-tl-dot{position:absolute;left:-7px;top:4px;width:12px;height:12px;border-radius:50%;background:var(--bka-accent);box-shadow:0 0 12px rgba(121,242,255,.5);}
.bka-tl-item h3{font-size:17px;margin-bottom:8px;}
.bka-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.bka-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.bka-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--bka-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.bka-faq-q::after{content:'▾';font-size:13px;color:var(--bka-accent);flex-shrink:0;transition:transform .25s;}
.bka-faq-item.open .bka-faq-q::after{transform:rotate(180deg);}
.bka-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--bka-muted);line-height:1.72;}
.bka-faq-item.open .bka-faq-a{max-height:600px;padding:0 24px 20px;}
.bka-content .ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.bka-content .ym-cta-block--secondary{background:linear-gradient(135deg,rgba(255,255,255,.04),rgba(121,242,255,.06));border-color:rgba(255,255,255,.12);text-align:left;}
.bka-content .ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.bka-content .ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.bka-content .ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.bka-content .ym-cta-block__sub{color:var(--bka-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.bka-content .ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none;}
.bka-content .ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.bka-content .ym-link--accent{color:var(--bka-accent);text-decoration:underline;}
.bka-blockquote{border-left:3px solid var(--bka-violet);padding:16px 24px;margin:24px 0;background:rgba(139,92,246,.08);border-radius:0 12px 12px 0;font-style:italic;color:var(--bka-soft);}
.bka-itog{background:linear-gradient(135deg,rgba(121,242,255,.06),rgba(139,92,246,.06));border:1px solid rgba(121,242,255,.15);border-radius:20px;padding:36px 40px;}
@media(max-width:600px){.bka-content .ym-cta-block{padding:28px 20px;}}
</style>

<div class="bka-content">

  <!-- INTRO -->
  <section class="bka-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="bka-cnt">
      <div class="bka-intro-grid nero-ai-reveal">
        <div class="bka-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai контент ассистент</p>
          <p><strong>Коротко:</strong> AI-контент-ассистент для бизнеса — это настроенная система, которая генерирует посты, тексты и контент-план в узнаваемом тоне вашей компании. Не «ещё один чат с ChatGPT», а внедрение под ключ: база знаний бренда, RAG с актуальными фактами, согласование в Telegram и интеграция с CRM.</p>
          <p>Маркетинговые команды, малый бизнес и эксперты сталкиваются с одной проблемой: <strong>контент выходит нерегулярно</strong>, а когда выходит — <strong>разные авторы пишут разным голосом</strong>. Попытки ускориться через «просто ChatGPT» дают шаблонные тексты: на правку уходит больше времени, чем на написание с нуля.</p>
          <p>Первый шаг — <strong>бесплатный AI-контент-план на 14 дней</strong> в тоне вашего бренда. Это не абстрактная демо-генерация, а рабочий календарь с темами и черновиками.</p>
        </div>
        <div class="bka-intro-kpi" aria-label="Ключевые показатели">
          <div class="bka-kpi-card"><div class="kv">93%</div><div class="kl">CMO используют gen AI</div><div class="ks">АКОС / Sostav</div></div>
          <div class="bka-kpi-card"><div class="kv">÷3</div><div class="kl">время на пост после внедрения</div><div class="ks">кейсы Ailean, СберМаркетинг</div></div>
          <div class="bka-kpi-card"><div class="kv">14 дн</div><div class="kl">контент-план бесплатно</div><div class="ks">лид-магнит Nero Network</div></div>
          <div class="bka-kpi-card"><div class="kv">60–180К</div><div class="kl">внедрение под ключ</div><div class="ks">2–4 недели</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="bka-toc-outer">
    <div class="bka-cnt">
      <nav class="bka-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что это</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#formaty">Форматы</a>
        <a href="#komu-podhodit">Кому подходит</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-final">Контент-план</a>
      </nav>
    </div>
  </div>

  <!-- ЧТО ТАКОЕ -->
  <section class="bka-section" id="chto-takoe">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Определение</span>
        <h2>Что такое AI-контент-ассистент с бренд-голосом и чем он отличается от «просто ChatGPT»</h2>
        <p><strong>AI-контент-ассистент</strong> с бренд-голосом — настроенная система на базе LLM, которая генерирует тексты в узнаваемом тоне компании.</p>
      </div>

      <div class="bka-card nero-ai-reveal">
        <p>Ядро решения: <strong>база знаний бренда</strong> (гайдлайны, редполитика, примеры удачных текстов) + <strong>RAG</strong> для актуальных фактов (прайс, акции, продукты) + <strong>human-in-the-loop</strong> — человек утверждает перед публикацией.</p>
        <p>Универсальный ChatGPT не хранит ваш контекст между сессиями, не интегрирован с CRM и не проверяет соответствие tone of voice. Каждый раз маркетолог заново объясняет «как мы пишем» — и всё равно получает «AI slop»: безликий текст, который узнаётся за три абзаца.</p>
      </div>

      <div class="bka-sh bka-left" style="margin-top:40px;">
        <h3 id="brand-voice-def">Определение brand voice в контент-маркетинге</h3>
      </div>
      <div class="bka-card nero-ai-reveal">
        <p><strong>Brand voice (голос бренда)</strong> — устойчивый стиль коммуникации: лексика, длина предложений, допустимый юмор, запретные формулировки, структура сообщений. Это не «дружелюбный» или «профессиональный» переключатель из SaaS-генератора, а набор правил, выведенных из <strong>ваших</strong> реальных текстов.</p>
        <p>По методологии ONLANTA (публикация РБК): fine-tuning учит модель <strong>«как сказать»</strong> — лексику, тон, запреты; RAG подгружает <strong>«что сказать»</strong> — актуальные цены, остатки, FAQ из базы знаний. Для большинства проектов Nero Network достаточно связки <strong>system prompt + few-shot examples + RAG</strong>; fine-tuning — опция для крупных брендов с тысячами эталонных материалов.</p>
      </div>

      <div class="bka-sh bka-left">
        <h3>Почему шаблонные нейросети «ломают» тон бренда</h3>
      </div>
      <div class="bka-card nero-ai-reveal">
        <p>Три причины, почему «голый» ChatGPT и дешёвые SaaS-генераторы не держат голос:</p>
        <ol>
          <li><strong>Нет ваших примеров.</strong> Postmypost, MakeAIK и аналоги предлагают пресеты «дружелюбный / профессиональный / юморной» — это не голос <em>вашей</em> компании, а усреднённый шаблон.</li>
          <li><strong>Нет актуальных фактов.</strong> Без RAG модель «додумывает» цены, условия и характеристики — отсюда галлюцинации и юридические риски.</li>
          <li><strong>Нет workflow.</strong> Текст рождается в изолированном чате, согласование идёт через пересылки в мессенджерах, контекст теряется.</li>
        </ol>
        <p>Кастомный <strong>AI-копирайтер для бизнеса</strong> закрывает все три разрыва: обучение на ваших текстах, RAG с прозрачными источниками фактов, единое окно согласования.</p>
      </div>

      <div class="bka-table-wrap nero-ai-reveal">
        <table class="bka-table">
          <thead><tr><th>Подход</th><th>Brand voice</th><th>Актуальные факты</th><th>Интеграции</th><th>Стоимость</th></tr></thead>
          <tbody>
            <tr><td>ChatGPT «в лоб»</td><td>❌ каждый раз заново</td><td>❌ галлюцинации</td><td>❌</td><td>бесплатно–$20/мес</td></tr>
            <tr><td>SaaS (Postmypost, MakeAIK)</td><td>⚠️ пресеты тона</td><td>⚠️ ограниченно</td><td>⚠️ автопостинг</td><td>0–3 000 ₽/мес</td></tr>
            <tr><td>Jasper / Copy.ai</td><td>✓ Brand Voice</td><td>✓ Infobase</td><td>⚠️ без VK/amoCRM</td><td>$25–60+/user/мес</td></tr>
            <tr><td><strong>Внедрение под ключ</strong></td><td>✓ ваши тексты</td><td>✓ RAG + CRM</td><td>✓ Telegram, amoCRM, VK</td><td>60–180 тыс. ₽ разово</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- КАК РАБОТАЕТ -->
  <section class="bka-section bka-section-alt" id="kak-rabotaet">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Внедрение</span>
        <h2>Как мы внедряем AI-контент-ассистента: этапы и сроки</h2>
        <p><strong>Внедрение AI-контент-ассистента</strong> — проект на <strong>2–4 недели</strong>. Ниже — типовая дорожная карта Nero Network.</p>
      </div>

      <div class="bka-card nero-ai-reveal" id="audit-brenda">
        <h3>Аудит голоса бренда и контент-процесса</h3>
        <p><strong>Срок:</strong> 2–3 рабочих дня.</p>
        <p>Собираем 15–30 лучших текстов бренда: посты, письма, описания услуг. Фиксируем редполитику, список запретов, обязательные формулировки. Картируем каналы (VK, Telegram, Дзен, email, сайт) и частоту публикаций.</p>
        <p><strong>Итог этапа:</strong> документ brand voice + карта контент-процесса + ТЗ на интеграции.</p>
      </div>

      <div class="bka-card nero-ai-reveal nero-ai-delay-1" id="nastroyka">
        <h3>Настройка промптов, базы знаний и правил тона</h3>
        <p><strong>Срок:</strong> 5–7 рабочих дней.</p>
        <ul>
          <li><strong>System prompt</strong> с правилами тона, структуры и запретами;</li>
          <li><strong>Few-shot examples</strong> — 5–10 эталонных пар «запрос → идеальный текст»;</li>
          <li><strong>RAG-база</strong> в Notion, Google Drive или файловом хранилище: прайс, FAQ, каталог, кейсы.</li>
        </ul>
        <p>Добавляем <strong>ToV Quality Checker</strong> — автоматическую проверку: banned words, длина, score соответствия голосу бренда (0–100). Выбор модели — по требованиям клиента: GPT-4o / Claude; <strong>GigaChat / YandexGPT</strong> — при необходимости соответствия 152-ФЗ.</p>
      </div>

      <div class="bka-card nero-ai-reveal nero-ai-delay-2" id="integracii">
        <h3>Интеграция с CRM, Notion, соцсетями и рабочими инструментами</h3>
        <p><strong>Срок:</strong> 5–10 рабочих дней.</p>
        <ul>
          <li><strong>CRM:</strong> amoCRM, Bitrix24 — привязка контента к воронке, сегментам, сделкам;</li>
          <li><strong>Мессенджеры:</strong> Telegram-бот для генерации и согласования кнопками;</li>
          <li><strong>Соцсети:</strong> VK, Telegram-каналы, Дзен — очередь публикаций;</li>
          <li><strong>Автоматизация:</strong> n8n, Make — связка «тема → черновик → score → утверждение → публикация».</li>
        </ul>
        <p><strong>Интеграция AI-контент-ассистента с CRM</strong> позволяет генерировать персонализированные тексты под этап воронки. Подробнее — в материале про <a href="/vnedrenie-ai-amocrm/">внедрение AI в amoCRM</a>.</p>
        <p>Если контент-триггеры приходят из входящей почты, смежный сценарий — <a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработка входящей почты в CRM</a>: классификация писем и черновики ответов в одном контуре с маркетинговыми текстами.</p>
      </div>

      <div class="bka-card nero-ai-reveal" id="obuchenie">
        <h3>Обучение команды и передача в эксплуатацию</h3>
        <p><strong>Срок:</strong> 2–3 рабочих дня. Проводим 1–2 сессии с маркетологом клиента: как задавать темы, читать score ToV, что править обязательно.</p>
        <p><strong>Логика работы системы после запуска:</strong></p>
        <ol>
          <li>Маркетолог задаёт тему, рубрику и канал в Telegram или веб-форме.</li>
          <li>RAG подтягивает актуальные факты из базы знаний.</li>
          <li>LLM генерирует черновик с учётом brand voice prompt и few-shot examples.</li>
          <li>Автопроверка: banned words, длина, тон, score 0–100.</li>
          <li>Человек правит и утверждает → пост уходит в очередь публикации или CRM.</li>
        </ol>
      </div>

      <!-- CTA Артур #2 -->
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите разобраться в AI-контенте до старта проекта?</p>
          <p class="ym-cta-block__sub">Если команда хочет понимать промпты, RAG и human-in-the-loop до внедрения — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'материалы по AI-контенту'); ?></a>. Это ускоряет согласование требований на аудите brand voice.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- ФОРМАТЫ -->
  <section class="bka-section" id="formaty">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Контент-форматы</span>
        <h2>Посты, тексты, рассылки и контент-план в одном тоне</h2>
        <p>Один настроенный ассистент закрывает весь контент-маркетинг — без переключения между инструментами и без потери тона.</p>
      </div>

      <div class="bka-card nero-ai-reveal" id="posty-smm">
        <h3>Нейросеть для постов и AI SMM</h3>
        <p><strong>Нейросеть для постов</strong> генерирует черновики под VK, Telegram, Дзен — с адаптацией под формат канала. Один тезис → три версии: короткий пост для Telegram, развёрнутый для Дзена, визуально ориентированный для VK. Всё в едином brand voice.</p>
        <p>По кейсу Ailean: автоматизация SMM с корпоративным стилем дала <strong>−70% времени на создание контента</strong>, <strong>−50% на согласования</strong>, <strong>90% соответствие стилю</strong> и <strong>85% автоматизацию публикации</strong>.</p>
      </div>

      <div class="bka-card nero-ai-reveal nero-ai-delay-1" id="kontent-plan">
        <h3>AI-контент-план на неделю и месяц</h3>
        <p><strong>AI-контент-план</strong> — не список «тем на месяц из воздуха», а календарь с рубриками, форматами, черновиками и дедлайнами. Типовой шаблон: 14 или 30 дней, привязка к маркетинговым активностям.</p>
        <p>Лид-магнит Nero Network — <strong>контент-план на 14 дней</strong> в тоне вашего бренда. Вы видите реальные темы и черновики до оплаты внедрения.</p>
      </div>

      <!-- CTA Артур #1 -->
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-kontent-plan">
        <div class="ym-cta-block__icon" aria-hidden="true">📅</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Получите AI-контент-план на 14 дней бесплатно</p>
          <p class="ym-cta-block__sub">Реальные темы, рубрики и черновики в тоне вашего бренда — не абстрактная демо-генерация. Увидите, как система звучит до оплаты внедрения.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </aside>

      <div class="bka-card nero-ai-reveal" id="teksty-socseti">
        <h3>AI-тексты для соцсетей, блога и email</h3>
        <p>Ассистент генерирует:</p>
        <ul>
          <li><strong>Посты</strong> для соцсетей (VK, Telegram, Дзен);</li>
          <li><strong>Email-рассылки</strong> — welcome, nurture, промо;</li>
          <li><strong>Статьи для блога</strong> — черновики с SEO-структурой;</li>
          <li><strong>Описания товаров и услуг</strong> — с актуальными ценами из RAG;</li>
          <li><strong>Сценарии для stories</strong> — тезисы и хуки.</li>
        </ul>
        <p>Все форматы проходят единую проверку ToV перед передачей на утверждение.</p>
      </div>
    </div>
  </section>

  <!-- КОМУ ПОДХОДИТ -->
  <section class="bka-section bka-section-alt" id="komu-podhodit">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Целевая аудитория</span>
        <h2>Кому нужен AI-контент-ассистент с бренд-голосом</h2>
      </div>
      <div class="bka-grid-3">
        <div class="bka-card nero-ai-reveal">
          <h3>Маркетинг и SMM-команды</h3>
          <p>Команды из 2–5 человек, которые ведут несколько каналов и тонут в согласованиях. Ассистент берёт на себя черновики и контент-план; маркетолог фокусируется на стратегии. <strong>93%</strong> CMO в России используют gen AI, но <strong>лишь треть — системно</strong> (АКОС / Sostav).</p>
        </div>
        <div class="bka-card nero-ai-reveal nero-ai-delay-1">
          <h3>Малый бизнес и эксперты</h3>
          <p><strong>AI-контент-ассистент для малого бизнеса</strong> — альтернатива найму SMM-щика (80–150 тыс. ₽/мес). Разовое внедрение за 60–180 тыс. ₽ окупается за 1–2 месяца при регулярном контенте в 3+ каналах.</p>
        </div>
        <div class="bka-card nero-ai-reveal nero-ai-delay-2">
          <h3>Бренды с жёсткими гайдлайнами</h3>
          <p>Финансы, медицина, B2B-сервисы, франшизы — где «съехать» с тона = репутационный риск. Автопроверка ToV ловит канцеляризмы и отклонения от редполитики <strong>до</strong> публикации (по аналогии с Cloud.ru, CX WORLD AWARDS 2026).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- КЕЙСЫ -->
  <section class="bka-section" id="keisy">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Доказательства</span>
        <h2>Кейсы: как компании внедрили AI в контент-маркетинг</h2>
      </div>

      <div class="bka-table-wrap nero-ai-reveal">
        <table class="bka-table">
          <thead><tr><th>Компания</th><th>Что внедрили</th><th>Ключевые метрики</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>СберМаркетинг</td><td>AI-агент для Telegram, VK, Дзен</td><td>Цикл поста −70%, публикации ×2, стоимость поста −52%</td><td>ADPASS</td></tr>
            <tr><td>Cloud.ru</td><td>ИИ-ассистент с ToV для поддержки</td><td>Время обработки обращений ÷2</td><td>ComNews</td></tr>
            <tr><td>Ailean (клиент)</td><td>SMM-автоматизация с корп. стилем</td><td>Время −70%, соответствие стилю 90%</td><td>ailean.ru</td></tr>
            <tr><td>Atlassian</td><td>Content Assistant на Rovo</td><td>Release notes −88% времени, 700+ часов команде</td><td>Atlassian blog</td></tr>
            <tr><td>Mills 50 Agency</td><td>Custom GPT + RAG</td><td>Banned words 2,3 → 0,4 за 6 недель</td><td>A.I. Consulting</td></tr>
          </tbody>
        </table>
      </div>

      <div class="bka-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Пример сценария: от хаотичных публикаций к контент-плану на 14 дней</h3>
        <p><strong>Было:</strong> студия дизайна, 2 400 подписчиков в VK и Telegram. Посты выходили 1–2 раза в месяц. Тон плавал, охваты падали.</p>
        <p><strong>Стало (проектная модель Nero Network):</strong></p>
        <ol>
          <li>Аудит: 20 лучших постов + редполитика «экспертно, но без канцелярита».</li>
          <li>Настройка: RAG с прайсом услуг; Telegram-бот для согласования.</li>
          <li>Контент-план на 14 дней: 3 рубрики, 14 черновиков в едином тоне.</li>
          <li>Результат через месяц: публикации 3 раза в неделю, score ToV 85+, время владельца — 40 мин/нед вместо 4 часов.</li>
        </ol>
      </div>
    </div>
  </section>

  <!-- ================================================
       БОРИС: ВИЗУАЛЬНЫЙ БЛОК (анимация контент-календаря)
       ================================================ -->
  <section id="boris-kontent-viz" class="bka-viz-root" aria-label="Визуализация: контент-календарь и поток постов в едином тоне бренда">
<style>
/* === БОРИС VIZ: prefix bka-viz-, scoped внутри #boris-kontent-viz === */
#boris-kontent-viz.bka-viz-root{padding:56px 0 64px;background:#f0f4fb;}
#boris-kontent-viz .bka-viz-cnt{max-width:1160px;margin:0 auto;padding:0 24px;}
#boris-kontent-viz .bka-viz-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:500px;}
@media(max-width:1023px){#boris-kontent-viz .bka-viz-card{grid-template-columns:1fr;min-height:auto;}}
#boris-kontent-viz .bka-viz-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0;}
@media(max-width:1023px){#boris-kontent-viz .bka-viz-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}}
#boris-kontent-viz .bka-viz-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#7c3aed;margin:0 0 14px;}
#boris-kontent-viz .bka-viz-ey::before{content:'';width:18px;height:2px;background:#7c3aed;border-radius:1px;}
#boris-kontent-viz .bka-viz-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;}
#boris-kontent-viz .bka-viz-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#boris-kontent-viz .bka-viz-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#boris-kontent-viz .bka-viz-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(124,58,237,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#7c3aed;margin-top:1px;font-style:normal;}
#boris-kontent-viz .bka-viz-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#boris-kontent-viz .bka-viz-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#boris-kontent-viz .bka-viz-pl-v{background:rgba(124,58,237,.08);color:#6d28d9;border:1.5px solid rgba(124,58,237,.22);}
#boris-kontent-viz .bka-viz-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#boris-kontent-viz .bka-viz-pl-c{background:rgba(6,182,212,.08);color:#0e7490;border:1.5px solid rgba(6,182,212,.22);}
#boris-kontent-viz .bka-viz-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#boris-kontent-viz .bka-viz-rgt{position:relative;background:linear-gradient(135deg,#faf5ff 0%,#ede9fe 28%,#f0f9ff 72%,#f8fafc 100%);min-height:440px;overflow:hidden;}
@media(max-width:1023px){#boris-kontent-viz .bka-viz-rgt{min-height:380px;}}
#bka-kontent-calendar-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bka-viz-cnt">
  <div class="bka-viz-card">
    <div class="bka-viz-lft">
      <span class="bka-viz-ey">Контент-календарь</span>
      <h3 class="bka-viz-h3">14 дней публикаций в едином brand voice — от темы до очереди в VK и Telegram</h3>
      <ul class="bka-viz-ul">
        <li><span class="bka-viz-ic">1</span>AI генерирует темы и черновики по рубрикам бренда</li>
        <li><span class="bka-viz-ic">2</span>ToV Checker оценивает соответствие голосу (score 0–100)</li>
        <li><span class="bka-viz-ic">3</span>Человек утверждает в Telegram — пост уходит в очередь</li>
        <li><span class="bka-viz-ic">✓</span>Один тон во всех каналах: VK, Telegram, Дзен, email</li>
      </ul>
      <div class="bka-viz-pills">
        <span class="bka-viz-pl bka-viz-pl-v">ToV 85+</span>
        <span class="bka-viz-pl bka-viz-pl-g">3–5 постов/нед</span>
        <span class="bka-viz-pl bka-viz-pl-c">14 дней план</span>
      </div>
      <p class="bka-viz-foot">Дальше — сравнение кастомного внедрения с SaaS-генераторами →</p>
    </div>
    <div class="bka-viz-rgt">
      <canvas id="bka-kontent-calendar-canvas" aria-label="Анимация: контент-календарь на 14 дней, посты проходят проверку ToV и попадают в очередь публикаций VK и Telegram" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bka-kontent-calendar-canvas');
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
    ink:'#0f172a', muted:'#64748b', paper:'#ffffff', paperBdr:'#e2e8f0',
    violet:'#7c3aed', violetGlow:'rgba(124,58,237,.18)',
    cyan:'#06b6d4', green:'#22c55e', orange:'#f59e0b',
    vk:'#0077ff', tg:'#229ed9', dzen:'#000000',
    calBg:'#f8fafc', calBdr:'#cbd5e1', slot:'#ede9fe', slotActive:'#ddd6fe'
  };

  var DAYS = ['Пн','Вт','Ср','Чт','Пт','Сб','Вс'];
  var POSTS = [
    {day:0, ch:'VK', color:C.vk, score:92, label:'Кейс'},
    {day:1, ch:'TG', color:C.tg, score:88, label:'Совет'},
    {day:2, ch:'Дзен', color:C.dzen, score:85, label:'Статья'},
    {day:3, ch:'VK', color:C.vk, score:91, label:'Акция'},
    {day:4, ch:'TG', color:C.tg, score:87, label:'Закулисье'},
    {day:6, ch:'VK', color:C.vk, score:94, label:'Кейс'},
    {day:8, ch:'TG', color:C.tg, score:90, label:'FAQ'},
    {day:10, ch:'Дзен', color:C.dzen, score:86, label:'Гайд'},
    {day:12, ch:'VK', color:C.vk, score:93, label:'Отзыв'},
    {day:13, ch:'TG', color:C.tg, score:89, label:'Новость'}
  ];

  var LOOP = 600;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawCalendar(x,y,w,h,t){
    rr(x,y,w,h,12,C.calBg,C.calBdr,1.5);
    ctx.fillStyle=C.violet;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Контент-план · 14 дней',x+14,y+22);

    var cellW=(w-28)/7, cellH=36, top=y+34;
    DAYS.forEach(function(d,i){
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(d,x+14+cellW*i+cellW/2,top+10);
    });

    var activeDay=Math.floor((t%LOOP)/LOOP*14);
    for(var row=0;row<2;row++){
      for(var col=0;col<7;col++){
        var idx=row*7+col;
        if(idx>=14) break;
        var cx=x+14+col*cellW+2, cy=top+16+row*(cellH+4);
        var isActive=idx===activeDay;
        var hasPost=POSTS.some(function(p){return p.day===idx;});
        rr(cx,cy,cellW-4,cellH,6,isActive?C.slotActive:(hasPost?C.slot:C.paper),hasPost?C.violet:C.calBdr,hasPost?1.5:1);
        ctx.fillStyle=isActive?C.violet:(hasPost?C.ink:C.muted);
        ctx.font=(isActive?'bold ':'')+'10px Inter,sans-serif';
        ctx.textAlign='center';
        ctx.fillText(String(idx+1),cx+(cellW-4)/2,cy+cellH/2+4);
        if(hasPost && !isActive){
          ctx.fillStyle=C.violet;
          ctx.beginPath();
          ctx.arc(cx+cellW-10,cy+8,3,0,Math.PI*2);
          ctx.fill();
        }
      }
    }
  }

  function drawPostCard(x,y,w,h,post,alpha,slide){
    ctx.globalAlpha=alpha||1;
    var sy=y+(slide||0);
    rr(x,sy,w,h,8,C.paper,C.paperBdr,1.5);
    rr(x+8,sy+8,36,14,4,post.color,null,0);
    ctx.fillStyle='#fff';
    ctx.font='bold 8px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(post.ch,x+26,sy+18);
    ctx.fillStyle=C.ink;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText(post.label,x+52,sy+18);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('Черновик AI',x+10,sy+32);
    var scoreCol=post.score>=90?C.green:(post.score>=85?C.cyan:C.orange);
    rr(x+w-44,sy+28,36,14,7,scoreCol+'22',scoreCol,1);
    ctx.fillStyle=scoreCol;
    ctx.font='bold 9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('ToV '+post.score,x+w-26,sy+38);
    ctx.globalAlpha=1;
  }

  function drawQueue(x,y,w,h,done,pulse){
    rr(x,y,w,h,10,'rgba(34,197,94,.06)',C.green,1.5);
    ctx.fillStyle=C.green;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Очередь публикаций',x+12,y+18);
    var channels=[{l:'VK',c:C.vk,n:Math.min(done,3)},{l:'Telegram',c:C.tg,n:Math.min(Math.max(done-3,0),4)},{l:'Дзен',c:C.dzen,n:Math.min(Math.max(done-7,0),3)}];
    channels.forEach(function(ch,i){
      var cy=y+28+i*28;
      ctx.fillStyle=ch.c;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText(ch.l,x+12,cy+14);
      for(var j=0;j<3;j++){
        var filled=j<ch.n;
        rr(x+70+j*22,cy,18,18,4,filled?ch.c+'33':'rgba(0,0,0,.04)',filled?ch.c:C.calBdr,1);
        if(filled){
          ctx.fillStyle=ch.c;
          ctx.font='bold 10px sans-serif';
          ctx.textAlign='center';
          ctx.fillText('✓',x+79+j*22,cy+13);
        }
      }
    });
    if(pulse%30<15){
      ctx.fillStyle=C.green;
      ctx.font='9px Inter,sans-serif';
      ctx.textAlign='right';
      ctx.fillText('● live',x+w-12,y+18);
    }
  }

  function drawToVScanner(cx,cy,w,h,pulse){
    rr(cx,cy,w,h,10,C.violetGlow,C.violet,2);
    ctx.fillStyle=C.violet;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('ToV Checker',cx+w/2,cy+16);
    var barY=cy+h/2;
    var prog=(pulse%80)/80;
    rr(cx+12,barY, w-24,8,4,'rgba(124,58,237,.12)',null,0);
    rr(cx+12,barY,(w-24)*prog,8,4,C.violet,null,0);
    ctx.fillStyle=C.violet;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.fillText(Math.round(70+prog*25)+'%',cx+w/2,cy+h-14);
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);

    var pad=16;
    var calW=Math.min(W*0.38,200), calH=130;
    drawCalendar(pad,pad,calW,calH,t);

    var scanX=pad+calW+20, scanY=pad+20, scanW=90, scanH=70;
    drawToVScanner(scanX,scanY,scanW,scanH,frame);

    var postIdx=Math.floor((t/LOOP)*POSTS.length)%POSTS.length;
    var post=POSTS[postIdx];
    var slide=Math.sin(frame*0.08)*4;
    var cardW=Math.min(W*0.42,180), cardH=52;
    var cardX=W*0.5-cardW/2, cardY=H*0.38;
    var cardAlpha=0.7+0.3*Math.sin(frame*0.06);
    drawPostCard(cardX,cardY,cardW,cardH,post,cardAlpha,slide);

    ctx.strokeStyle='rgba(124,58,237,.25)';
    ctx.lineWidth=1.5;
    ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(pad+calW/2,pad+calH);
    ctx.lineTo(cardX+cardW/2,cardY);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(scanX+scanW/2,scanY+scanH);
    ctx.lineTo(cardX,cardY+cardH/2);
    ctx.stroke();
    ctx.setLineDash([]);

    var qW=Math.min(W*0.36,160), qH=110;
    var doneCount=Math.floor((t/LOOP)*10);
    drawQueue(W-pad-qW,H-pad-qH,qW,qH,doneCount,frame);

    ctx.strokeStyle='rgba(34,197,94,.3)';
    ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(cardX+cardW,cardY+cardH/2);
    ctx.lineTo(W-pad-qW,cardY+cardH/2);
    ctx.stroke();
    ctx.setLineDash([]);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>

  <!-- СРАВНЕНИЕ -->
  <section class="bka-section bka-section-alt" id="sravnenie">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Сравнение</span>
        <h2>Jasper, Copy.ai и встроенный AI в SMM-платформах: почему выбирают внедрение под ключ</h2>
      </div>
      <div class="bka-card nero-ai-reveal">
        <h3>SaaS-генераторы: быстро, но поверхностно</h3>
        <p><strong>Jasper</strong> ($36+/seat/мес) и <strong>Copy.ai</strong> ($25–60+/user/мес) — сильные enterprise-решения с Brand Voice. Но: нет интеграций с VK и amoCRM из коробки, подписка растёт с каждым пользователем.</p>
        <p><strong>Postmypost, MakeAIK, Neuronica, TotalSMM</strong> (0–3 000 ₽/мес) — низкий порог входа, но пресеты вместо вашего голоса, нет workflow согласования с CRM.</p>
      </div>
      <div class="bka-table-wrap nero-ai-reveal">
        <table class="bka-table">
          <thead><tr><th>Критерий</th><th>ChatGPT бесплатно</th><th>SaaS-генератор</th><th>Внедрение под ключ</th></tr></thead>
          <tbody>
            <tr><td>Brand voice из ваших текстов</td><td>❌</td><td>⚠️ пресеты</td><td>✓</td></tr>
            <tr><td>RAG с вашими фактами</td><td>❌</td><td>⚠️</td><td>✓</td></tr>
            <tr><td>Telegram + CRM</td><td>❌</td><td>❌</td><td>✓</td></tr>
            <tr><td>152-ФЗ / выбор модели</td><td>❌</td><td>❌</td><td>✓ GigaChat/YandexGPT</td></tr>
            <tr><td>Стоимость для команды 3 чел.</td><td>$0–60/мес</td><td>3–9 тыс. ₽/мес</td><td>60–180 тыс. ₽ разово</td></tr>
          </tbody>
        </table>
      </div>
      <div class="bka-card nero-ai-reveal">
        <p><strong>Уникальный угол Nero Network:</strong> не подписка на генератор, а <strong>ваш голос бренда в системе</strong>. Кастомное внедрение за 60–180 тыс. ₽ для команд, которым SaaS даёт «дружелюбный тон», но не звучит как компания.</p>
      </div>
    </div>
  </section>

  <!-- СТОИМОСТЬ -->
  <section class="bka-section" id="ceny">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Цена</span>
        <h2>Стоимость внедрения AI-контент-ассистента: ориентиры 60–180 тыс. ₽</h2>
      </div>
      <div class="bka-table-wrap nero-ai-reveal">
        <table class="bka-table">
          <thead><tr><th>Пакет</th><th>Что входит</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td>Старт</td><td>Аудит, настройка brand voice, 1–2 канала, Telegram-бот</td><td>60–90 тыс. ₽</td></tr>
            <tr><td>Бизнес</td><td>+ CRM, 3–4 канала, контент-план 30 дней, ToV checker</td><td>90–140 тыс. ₽</td></tr>
            <tr><td>Расширенный</td><td>+ n8n/Make, несколько сценариев, GigaChat/YandexGPT</td><td>140–180 тыс. ₽</td></tr>
          </tbody>
        </table>
      </div>
      <div class="bka-card nero-ai-reveal">
        <h3>Что входит: аудит, настройка, интеграции, обучение</h3>
        <ul>
          <li>Аудит brand voice и контент-процесса;</li>
          <li>Настройка промптов, few-shot, RAG-базы;</li>
          <li>ToV Quality Checker (score, banned words);</li>
          <li>Интеграция с 1–2 каналами и Telegram-бот согласования;</li>
          <li>AI-контент-план на 14 дней;</li>
          <li>Обучение команды (1–2 сессии);</li>
          <li>30 дней поддержки после запуска.</li>
        </ul>
        <h3>От чего зависит цена</h3>
        <p>Число каналов, CRM-интеграция (+15–30 тыс. ₽), кастомные сценарии, требования 152-ФЗ, fine-tuning для крупных брендов (+30–50 тыс. ₽). Для сравнения: dodigital оценивает полное внедрение AI-агентов от <strong>500 000 ₽</strong>.</p>
      </div>
    </div>
  </section>

  <!-- ROI -->
  <section class="bka-section bka-section-alt" id="roi">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Окупаемость</span>
        <h2>Окупаемость: время команды, регулярность публикаций, конверсия лид-магнита</h2>
      </div>
      <div class="bka-table-wrap nero-ai-reveal">
        <table class="bka-table">
          <thead><tr><th>Метрика</th><th>До внедрения</th><th>После (по кейсам)</th></tr></thead>
          <tbody>
            <tr><td>Время на один пост</td><td>2–4 часа</td><td>30–60 минут</td></tr>
            <tr><td>Регулярность публикаций</td><td>1–2/мес</td><td>3–5/нед</td></tr>
            <tr><td>Итерации правки</td><td>3–5 раундов</td><td>1–2 раунда</td></tr>
            <tr><td>Score соответствия ToV</td><td>не измерялся</td><td>85–95%</td></tr>
            <tr><td>Стоимость поста</td><td>100%</td><td>−52% (СберМаркетинг)</td></tr>
          </tbody>
        </table>
      </div>
      <div class="bka-card nero-ai-reveal">
        <p><strong>Конверсия лид-магнита:</strong> бесплатный контент-план на 14 дней демонстрирует ценность до оплаты — типичная конверсия в проект 15–25% для тёплой аудитории.</p>
      </div>
    </div>
  </section>

  <!-- РИСКИ -->
  <section class="bka-section" id="riski">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Риски</span>
        <h2>Галлюцинации, потеря уникальности, юридические ограничения на AI-контент</h2>
      </div>
      <div class="bka-grid-3">
        <div class="bka-card nero-ai-reveal">
          <h3>Контроль качества и фактчекинг</h3>
          <p>Закрываем галлюцинации через RAG, автопроверку фактов, human-in-the-loop и trust tiers (low/medium/high risk по модели Atlassian).</p>
        </div>
        <div class="bka-card nero-ai-reveal nero-ai-delay-1">
          <h3>Сохранение уникальности голоса</h3>
          <p>AI пишет черновик за 15 минут, вы утверждаете за 5. Стратегия, креатив, UGC — остаются за человеком. Brand voice + human review — антидот от AI slop.</p>
        </div>
        <div class="bka-card nero-ai-reveal nero-ai-delay-2">
          <h3>Правовой контекст 2026–2027</h3>
          <p>На июнь 2026 единого закона об обязательной маркировке всего AI-контента в РФ нет. Законопроект 2027 — для аудиовизуального контента. Модуль compliance закладываем в архитектуру.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ТРЕНД 2026 -->
  <section class="bka-section bka-section-alt" id="trend-2026">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">Тренд 2026</span>
        <h2>Почему компании внедряют генеративный AI в 2026</h2>
        <p>Тренд 2026 — переход от «поиграли с ChatGPT» к <strong>системному внедрению</strong>. OpenAI for Business продвигает workspace agents и Custom GPTs.</p>
      </div>
      <div class="bka-card nero-ai-reveal">
        <ul>
          <li>Enterprise-сообщения через Custom GPTs выросли <strong>в 19 раз</strong> YoY;</li>
          <li><strong>20%</strong> enterprise ChatGPT-сообщений идут через custom configurations;</li>
          <li>Организации с custom GPTs — <strong>3,4×</strong> выше weekly active usage vs generic ChatGPT.</li>
        </ul>
        <p>В России: <strong>93%</strong> CMO используют gen AI, но <strong>лишь треть — системно</strong> (АКОС). Подробнее о масштабном корпоративном внедрении — в материале <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/">KPMG и Claude: 276 тысяч сотрудников</a>.</p>
        <p>Тот же принцип системности работает и в учётных системах: <a href="/ai-1c-erp/">AI-агент для 1С и ERP</a> закрывает операционные процессы, а контент-ассистент — голос бренда во всех точках контакта.</p>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="bka-section" id="faq">
    <div class="bka-cnt">
      <div class="bka-sh">
        <span class="bka-eyebrow">FAQ</span>
        <h2>Частые вопросы</h2>
      </div>
      <div class="bka-faq nero-ai-reveal">
        <div class="bka-faq-item" id="faq-vnedrenie">
          <div class="bka-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить AI-контент-ассистент в мою компанию?</div>
          <div class="bka-faq-a"><p>Четыре шага: (1) оставьте заявку и получите <strong>контент-план на 14 дней</strong> бесплатно; (2) аудит brand voice — 2–3 дня; (3) настройка и интеграции — 2–3 недели; (4) обучение и запуск. Срок полного проекта: <strong>2–4 недели</strong>.</p></div>
        </div>
        <div class="bka-faq-item" id="faq-crm">
          <div class="bka-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли интегрировать с amoCRM и другими CRM?</div>
          <div class="bka-faq-a"><p>Да. <strong>Интеграция AI-контент-ассистента с CRM</strong> (amoCRM, Bitrix24) — стандартный модуль. Подробности — в разделе <a href="/vnedrenie-ai-amocrm/">внедрение AI в amoCRM</a>.</p></div>
        </div>
        <div class="bka-faq-item" id="faq-srok">
          <div class="bka-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает настройка бренд-голоса?</div>
          <div class="bka-faq-a"><p>Базовая настройка — <strong>5–7 рабочих дней</strong> после аудита. Включает system prompt, few-shot examples, RAG-базу и ToV checker.</p></div>
        </div>
        <div class="bka-faq-item" id="faq-malyj-biznes">
          <div class="bka-faq-q" tabindex="0" role="button" aria-expanded="false">Подходит ли для малого бизнеса без маркетолога?</div>
          <div class="bka-faq-a"><p>Да. <strong>AI-контент-ассистент для малого бизнеса</strong> рассчитан на владельца или эксперта: Telegram-бот с кнопками «утвердить / править / отклонить». Время на контент — 30–60 минут в неделю.</p></div>
        </div>
        <div class="bka-faq-item" id="faq-chatgpt">
          <div class="bka-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от обычного ChatGPT?</div>
          <div class="bka-faq-a"><p>ChatGPT — универсальный чат без вашего контекста. Наш ассистент: <strong>ваши</strong> тексты в основе, RAG с <strong>вашими</strong> фактами, согласование в Telegram, интеграция с CRM, автопроверка ToV, единый workflow «от темы до публикации».</p></div>
        </div>
        <div class="bka-faq-item" id="faq-markirovka">
          <div class="bka-faq-q" tabindex="0" role="button" aria-expanded="false">Нужно ли маркировать AI-контент?</div>
          <div class="bka-faq-a"><p>На июнь 2026 для текстового SMM — нет единого обязательного закона. Следим за законопроектом 2027 (аудиовизуальный контент).</p></div>
        </div>
        <div class="bka-faq-item" id="faq-soderzhanie">
          <div class="bka-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит содержание после внедрения?</div>
          <div class="bka-faq-a"><p>API-модели: 2 000–10 000 ₽/мес. Поддержка: опционально от 15 000 ₽/мес. Сравните с SMM-щиком (80–150 тыс. ₽/мес) или подпиской Jasper для команды из 3 человек ($100+/мес ≈ 9 000+ ₽/мес бессрочно).</p></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ИТОГ + CTA FINAL -->
  <section class="bka-section bka-section-alt">
    <div class="bka-cnt">
      <div class="bka-itog nero-ai-reveal">
        <h2>Итог</h2>
        <p><strong>AI-контент-ассистент с бренд-голосом</strong> — не подписка на генератор и не «ещё один чат». Это ваша система контент-маркетинга: brand voice из реальных текстов, RAG с актуальными фактами, согласование в Telegram, интеграция с CRM. Внедрение под ключ за <strong>60–180 тыс. ₽</strong> за <strong>2–4 недели</strong>.</p>
        <p>Начните с <strong>бесплатного AI-контент-плана на 14 дней</strong> — увидите, как нейросеть пишет в стиле вашей компании, до принятия решения о проекте.</p>
        <p><strong>Что делает AI:</strong> черновики, контент-план, адаптация под каналы, проверка ToV, подтягивание фактов.</p>
        <p><strong>Что остаётся за вами:</strong> стратегия, финальное утверждение, креатив, юридически значимые формулировки, обновление базы знаний.</p>
        <blockquote class="bka-blockquote">«AI scales the how. Humans still own the why» — Roar Digital, human-in-the-loop marketing 2026.</blockquote>
      </div>

      <!-- CTA Артур #3 -->
      <section class="ym-cta-block ym-cta-block--dual" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Начните с бесплатного контент-плана на 14 дней</p>
          <p class="ym-cta-block__sub">Внедрение под ключ за 60–180 тыс. ₽ и 2–4 недели. Сначала — AI-контент-план в тоне вашей компании: темы, черновики, единый brand voice. Без обязательств.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#kak-rabotaet" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как это работает</a>
          </div>
        </div>
      </section>
    </div>
  </section>

</div><!-- /.bka-content -->

<script>
(function(){
  document.querySelectorAll('.bka-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.bka-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.bka-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.bka-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){
        item.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}
    });
  });
})();
</script>


<script>
/**
 * aka-brand-voice-engine — Редакционная студия brand voice
 * Мир: ленты черновиков → микшер тона → RAG-факты → контент-календарь 14 дней
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aka-brand-voice-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var bubbles = [];

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
    chipMuted: "#64748b",
    chipBrand: "#fbcfe8",
    chipAligned: "#a7f3d0",
    mixerBase: "#1e1b2e",
    mixerGlow: "rgba(192,132,252,0.45)",
    ragNode: "#38bdf8",
    calendarCell: "rgba(110,231,183,0.22)",
    calendarLit: "#6ee7b7",
    ribbon: "rgba(251,113,133,0.28)",
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

  function createBubble(x, y, text) {
    bubbles.push({ x: x, y: y, text: text, life: 90, max: 90 });
  }

  /* Ленты черновиков — вместо Conveyor */
  function RibbonDraftStream() {
    this.phase = 0;
  }
  RibbonDraftStream.prototype.draw = function (ctx) {
    this.phase = (frame * 0.035) % 1;
    var ribbons = [
      { y: -72, speed: 1, tint: C.chipMuted },
      { y: -48, speed: 1.25, tint: C.chipBrand },
      { y: 78, speed: 0.9, tint: C.chipMuted }
    ];
    ribbons.forEach(function (rib) {
      ctx.strokeStyle = C.ribbon;
      ctx.lineWidth = 1.5;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.5 * rib.speed;
      ctx.beginPath();
      ctx.moveTo(-cw, rib.y);
      ctx.lineTo(cw, rib.y);
      ctx.stroke();
      ctx.setLineDash([]);
      for (var i = 0; i < 4; i++) {
        var t = (this.phase * rib.speed + i * 0.22) % 1;
        var px = -140 + t * 280;
        var wobble = Math.sin(frame * 0.06 + i) * 3;
        drawDraftChip(ctx, px, rib.y + wobble, 28, 14, rib.tint, i % 2 === 0 ? "…" : "AI");
      }
    }, this);
  };

  function drawDraftChip(ctx, x, y, w, h, color, label) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 3, color, C.outline);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(label, x, y + 2);
  }

  /* Микшер brand voice — вместо WebsiteTerminal */
  function BrandVoiceMixer() {
    this.toneAngle = 0;
    this.harmony = 0;
  }
  BrandVoiceMixer.prototype.draw = function (ctx) {
    var prg = (frame * 0.045) % 220;
    this.toneAngle = (prg / 220) * Math.PI * 1.6 - Math.PI * 0.3;

    drawRR(ctx, -62, -68, 124, 136, 12, C.mixerBase, C.outline);

    /* Дуга ToneSpectrum */
    ctx.strokeStyle = C.mixerGlow;
    ctx.lineWidth = 6;
    ctx.lineCap = "round";
    ctx.beginPath();
    ctx.arc(0, -10, 42, Math.PI * 0.85, Math.PI * 2.15);
    ctx.stroke();

    /* Стрелка score */
    var needle = -10 + Math.sin(this.toneAngle) * 38;
    ctx.strokeStyle = C.calendarLit;
    ctx.lineWidth = 2.5;
    ctx.beginPath();
    ctx.moveTo(0, -10);
    ctx.lineTo(Math.cos(this.toneAngle) * 34, -10 + Math.sin(this.toneAngle) * 34);
    ctx.stroke();

    ctx.fillStyle = "#fff";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ToV", 0, 8);
    ctx.font = "bold 11px Inter,sans-serif";
    ctx.fillStyle = C.calendarLit;
    var score = prg < 80 ? 62 + Math.floor(prg / 4) : 88 + Math.floor((prg - 80) / 8);
    ctx.fillText(String(Math.min(94, score)), 0, 22);

    /* RAG-узлы */
    if (prg >= 50 && prg < 130) {
      var nodes = ["FAQ", "Прайс", "Кейс"];
      nodes.forEach(function (n, i) {
        var nx = -48 + i * 48;
        var ny = 38 + Math.sin(frame * 0.09 + i) * 4;
        drawRR(ctx, nx - 16, ny - 8, 32, 16, 4, "rgba(56,189,248,0.22)", C.ragNode);
        ctx.fillStyle = "#bae6fd";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(n, nx, ny + 2);
      });
    }

    /* Фаза HARMONIZE */
    if (prg >= 80 && prg < 150) {
      this.harmony = Math.min(1, (prg - 80) / 35);
      ctx.strokeStyle = "rgba(192,132,252," + (0.3 + this.harmony * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, -10, 48 + this.harmony * 12, 0, Math.PI * 2);
      ctx.stroke();
    }

    /* Фаза CALENDAR — вместо ракеты/ZIP */
    if (prg >= 140) {
      var calY = 52;
      var cols = 7, rows = 2;
      for (var r = 0; r < rows; r++) {
        for (var c = 0; c < cols; c++) {
          var idx = r * cols + c;
          var lit = prg > 150 + idx * 4;
          var cellX = -52 + c * 16;
          var cellY = calY + r * 14;
          drawRR(ctx, cellX, cellY, 12, 10, 2,
            lit ? C.calendarCell : "rgba(255,255,255,0.06)",
            lit ? C.calendarLit : C.outline);
        }
      }
      if (prg > 185 && prg < 210) {
        ctx.strokeStyle = "rgba(110,231,183,0.75)";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(0, calY + 7, 18 + (prg - 185) * 1.2, 0, Math.PI * 2);
        ctx.stroke();
      }
    }
  };

  function Agent(x, y, color, role, dialogs) {
    this.x = x; this.y = y; this.color = color; this.role = role;
    this.dialogs = dialogs; this.stepTrig = Math.random() * 200;
    this.bubbleTimer = 0;
    this.targetX = 0; this.targetY = 0;
  }
  Agent.prototype.draw = function (ctx) {
    this.stepTrig = (this.stepTrig + 0.6) % 200;
    this.bubbleTimer++;
    var prg = (frame * 0.045) % 220;
    if (this.role === "1_architect") { this.targetX = -95; this.targetY = -55; }
    if (this.role === "2_seo") { this.targetX = 95; this.targetY = -40; }
    if (this.role === "3_coder") { this.targetX = -88; this.targetY = 55; }
    if (this.role === "4_designer") { this.targetX = 88; this.targetY = 50; }
    if (this.role === "5_deployer") { this.targetX = 0; this.targetY = 72; }

    var dx = this.targetX - this.x;
    var dy = this.targetY - this.y;
    this.x += dx * 0.04;
    this.y += dy * 0.04;

    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, 7 * scale / 1.2, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();

    if (this.bubbleTimer > 140 && Math.random() < 0.012) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)]);
      this.bubbleTimer = 0;
    }
  };

  var agents = [
    new Agent(-120, 20, C.agentYellow, "1_architect", ["Собираю эталонные тексты", "Аудит brand voice", "Гайдлайны на стол"]),
    new Agent(120, 30, C.agentGreen, "2_seo", ["RAG: прайс из базы", "Факты без галлюцинаций", "FAQ подтянут"]),
    new Agent(-115, 70, C.agentBlue, "3_coder", ["Few-shot примеры", "Промпт тона настроен", "System rules OK"]),
    new Agent(115, 65, C.agentPink, "4_designer", ["VK vs Telegram версии", "Один тезис — 3 канала", "Стиль бренда держим"]),
    new Agent(0, 95, C.agentPurple, "5_deployer", ["Утверждено в Telegram", "В очередь публикации", "Календарь 14 дней"])
  ];

  var ribbon = new RibbonDraftStream();
  var mixer = new BrandVoiceMixer();

  function drawBubbles(ctx) {
    bubbles = bubbles.filter(function (b) {
      b.life--;
      b.y -= 0.35;
      var alpha = b.life / b.max;
      if (alpha <= 0) return false;
      ctx.font = "bold 7px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 10, tw, 14, 4, C.bubbleBg, null);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y);
      return true;
    });
  }

  function engineloop() {
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    ribbon.draw(ctx);
    mixer.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });

    var prg = (frame * 0.045) % 220;
    if (frame % 95 === 0 && prg < 60) createBubble(0, -55, "Черновики с разным тоном");
    if (frame % 110 === 35 && prg >= 60 && prg < 120) createBubble(0, -30, "Микшер выравнивает голос");
    if (frame % 120 === 60 && prg >= 120 && prg < 170) createBubble(0, 45, "RAG подставляет факты");
    if (frame % 130 === 20 && prg >= 170) createBubble(0, 58, "14 дней в календаре");

    drawBubbles(ctx);
    ctx.restore();
    frame++;
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>

<?php
$aka_page_url = trailingslashit(get_permalink());
$aka_site_url = trailingslashit(home_url('/'));
$aka_brand    = get_bloginfo('name') ?: 'Nero Network';
$aka_schema   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => $aka_site_url . '#organization',
            'name'  => $aka_brand,
            'url'   => $aka_site_url,
        ],
        [
            '@type'     => 'WebSite',
            '@id'       => $aka_site_url . '#website',
            'url'       => $aka_site_url,
            'name'      => $aka_brand,
            'publisher' => ['@id' => $aka_site_url . '#organization'],
        ],
        [
            '@type'       => 'WebPage',
            '@id'         => $aka_page_url . '#webpage',
            'url'         => $aka_page_url,
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'isPartOf'    => ['@id' => $aka_site_url . '#website'],
            'about'       => ['@id' => $aka_site_url . '#organization'],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id'   => $aka_page_url . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $aka_site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $aka_page_url],
            ],
        ],
        [
            '@type'       => 'Service',
            '@id'         => $aka_page_url . '#service',
            'name'        => $page_seo_title,
            'description' => $page_seo_description,
            'url'         => $aka_page_url,
            'provider'    => ['@id' => $aka_site_url . '#organization'],
        ],
        [
            '@type' => 'FAQPage',
            '@id'   => $aka_page_url . '#faq',
            'mainEntity' => [
                ['@type' => 'Question', 'name' => 'Как внедрить AI-контент-ассистент в мою компанию?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Четыре шага: (1) оставьте заявку и получите контент-план на 14 дней бесплатно; (2) аудит brand voice — 2–3 дня; (3) настройка и интеграции — 2–3 недели; (4) обучение и запуск. Срок полного проекта: 2–4 недели.']],
                ['@type' => 'Question', 'name' => 'Можно ли интегрировать с amoCRM и другими CRM?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Да. Интеграция AI-контент-ассистента с CRM (amoCRM, Bitrix24) — стандартный модуль. Подробности — в разделе внедрение AI в amoCRM.']],
                ['@type' => 'Question', 'name' => 'Сколько времени занимает настройка бренд-голоса?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Базовая настройка — 5–7 рабочих дней после аудита. Включает system prompt, few-shot examples, RAG-базу и ToV checker.']],
                ['@type' => 'Question', 'name' => 'Подходит ли для малого бизнеса без маркетолога?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Да. AI-контент-ассистент для малого бизнеса рассчитан на владельца или эксперта: Telegram-бот с кнопками «утвердить / править / отклонить». Время на контент — 30–60 минут в неделю.']],
                ['@type' => 'Question', 'name' => 'Чем отличается от обычного ChatGPT?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'ChatGPT — универсальный чат без вашего контекста. Наш ассистент: ваши тексты в основе, RAG с вашими фактами, согласование в Telegram, интеграция с CRM, автопроверка ToV, единый workflow «от темы до публикации».']],
                ['@type' => 'Question', 'name' => 'Нужно ли маркировать AI-контент?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'На июнь 2026 для текстового SMM — нет единого обязательного закона. Следим за законопроектом 2027 (аудиовизуальный контент).']],
                ['@type' => 'Question', 'name' => 'Сколько стоит содержание после внедрения?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'API-модели: 2 000–10 000 ₽/мес. Поддержка: опционально от 15 000 ₽/мес. Сравните с SMM-щиком (80–150 тыс. ₽/мес) или подпиской Jasper для команды из 3 человек ($100+/мес ≈ 9 000+ ₽/мес бессрочно).']],
            ],
        ],
    ],
];
echo '<script type="application/ld+json">' . wp_json_encode($aka_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
?>

</main>


<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
