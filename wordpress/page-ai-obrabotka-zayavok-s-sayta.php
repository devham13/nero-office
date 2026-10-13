<?php
/**
 * Template Name: AI-агент для первичной обработки заявок с сайта
 * Description: Внедрение AI-агента для обработки заявок с сайта: ответ 24/7, квалификация, CRM.
 */

declare(strict_types=1);

$page_seo_title       = 'AI обработка заявок с сайта под ключ — агент 24/7 и CRM';
$page_seo_description = 'Внедряем AI-агента для первичной обработки заявок с сайта: ответ за 5–15 сек, уточняющие вопросы и передача горячего лида в CRM. Аудит потерь заявок за 30 минут — бесплатно.';

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
    ['label' => 'Почему остывают', 'href' => '#pochemu-zayavki-ostyvayut'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet-agent'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie-pod-klyuch'],
    ['label' => 'CRM', 'href' => '#integraciya-crm'],
    ['label' => 'Цена', 'href' => '#cena'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'Аудит', 'href' => '#proverit-poteri'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить, сколько заявок вы теряете';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = 'Как работает';
$secondary_cta_url = '#kak-rabotaet-agent';
$secondary_cta_training_url = getenv('SECONDARY_CTA_URL') ?: ''; // pragma: allowlist secret
$secondary_cta_training_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';

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
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

.aoz-content{
  --aoz-bg:#050711;--aoz-bg2:#080b17;
  --aoz-text:#e6edf7;--aoz-muted:#9aa8bd;--aoz-soft:#c7d2e5;--aoz-heading:#fff;
  --aoz-border:rgba(255,255,255,.10);
  --aoz-accent:#79f2ff;--aoz-violet:#8b5cf6;--aoz-green:#22c55e;
  --aoz-btn-from:#2563eb;--aoz-btn-to:#7c3aed;
  --aoz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aoz-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aoz-content *,.aoz-content *::before,.aoz-content *::after{box-sizing:border-box;}
.aoz-content a.aoz-link{color:var(--aoz-accent);text-decoration:underline;}
.aoz-content p{color:var(--aoz-muted);line-height:1.72;margin:0 0 1em;text-align:left!important;}
.aoz-content p:last-child{margin-bottom:0;}
.aoz-content h2,.aoz-content h3,.aoz-content h4{color:var(--aoz-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aoz-content strong{color:var(--aoz-soft);}
.aoz-cnt{width:min(var(--aoz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aoz-section{padding:clamp(56px,7vw,96px) 0;position:relative;}
.aoz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aoz-sh{max-width:820px;margin:0 auto 36px;text-align:left;}
.aoz-sh h2{font-size:clamp(26px,4vw,46px);line-height:1.08;margin-bottom:0;}
.aoz-prose{max-width:820px;margin:0 auto;}
.aoz-h3{font-size:1.15rem;margin-top:1.6em;}
.aoz-intro{padding:clamp(36px,5vw,64px) 0;border-bottom:1px solid rgba(255,255,255,.06);}
.aoz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:center;}
.aoz-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.aoz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aoz-accent),var(--aoz-violet));}
.aoz-intro-text p{text-align:left!important;font-size:clamp(15px,1.55vw,17px);}
.aoz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aoz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:14px;text-align:center;}
.aoz-kpi-card .kv{font-size:22px;font-weight:900;color:#fff;}
.aoz-kpi-card .kl{font-size:11px;color:var(--aoz-muted);}
@media(max-width:900px){.aoz-intro-grid{grid-template-columns:1fr;}}
.aoz-toc-wrap{padding:0 0 40px;}
.aoz-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aoz-toc a,.ym-toc a{display:inline-block;padding:9px 16px;background:rgba(255,255,255,.06);border:1px solid var(--aoz-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aoz-muted);}
.aoz-toc a:hover,.ym-toc a:hover{border-color:rgba(121,242,255,.4);color:var(--aoz-accent);}
.aoz-ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aoz-ul li{padding-left:18px;position:relative;margin-bottom:.45em;color:var(--aoz-muted);text-align:left;}
.aoz-ul li::before{content:'›';position:absolute;left:0;color:var(--aoz-accent);font-weight:700;}
.aoz-ol{margin:0 0 1em;padding-left:1.2em;color:var(--aoz-muted);}
.aoz-lead{color:var(--aoz-soft)!important;}
.aoz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aoz-table{width:100%;border-collapse:collapse;font-size:14px;}
.aoz-table th{padding:12px 14px;text-align:left;background:rgba(121,242,255,.1);color:var(--aoz-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);}
.aoz-table td{padding:11px 14px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aoz-text);vertical-align:top;}
.aoz-table tr:last-child td{border-bottom:none;}
.ym-cta-block{border-radius:20px;padding:32px 36px;margin:28px 0;background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.28);}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);}
.ym-cta-block--dual,.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);text-align:center;}
.ym-cta-block__icon{font-size:32px;margin-bottom:10px;}
.ym-cta-block__headline{font-size:clamp(19px,2.6vw,26px);font-weight:800;color:#fff;margin:0 0 8px;}
.ym-cta-block__sub{color:var(--aoz-muted);font-size:15px;margin:0 0 18px;line-height:1.7;text-align:left;}
.ym-cta-block--dual .ym-cta-block__sub{margin-left:auto;margin-right:auto;max-width:640px;text-align:center;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-link--accent{color:var(--aoz-accent)!important;}
.nero-ai-reveal{opacity:0;transform:translateY(20px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-obrabotka-zayavok-s-sayta-page" role="main" tabindex="-1">

<style>
/* ── Hero ai-obrabotka-zayavok: самодостаточные стили (премиум .nero-ai-home-page) ── */
.znt-hero-leads-site {
  --znt-cyan: #79f2ff;
  --znt-violet: #8b5cf6;
  --znt-green: #22c55e;
  --znt-amber: #fbbf24;
  --znt-text: #e6edf7;
  --znt-muted: #9aa8bd;
  --znt-soft: #c7d2e5;
  --znt-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.znt-hero-leads-site.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.znt-hero-leads-site::before {
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
.znt-hero-leads-site::after {
  content: "";
  position: absolute;
  left: 18%;
  top: 12%;
  width: 720px;
  height: 720px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(8px);
  animation: zntHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes zntHeroGlow {
  from { opacity: .4; transform: scale(.94); }
  to { opacity: .82; transform: scale(1.05); }
}
.znt-hero-leads-site .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.znt-hero-leads-site .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.znt-hero-leads-site .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.062em;
  color: #fff;
  font-weight: 900;
}
.znt-hero-leads-site .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--znt-cyan) 42%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.znt-hero-leads-site .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--znt-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.znt-hero-leads-site .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--znt-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.znt-hero-leads-site .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.znt-hero-leads-site .nero-ai-badge {
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
.znt-hero-leads-site .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.znt-hero-leads-site .nero-ai-btn {
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
.znt-hero-leads-site .nero-ai-btn:hover { transform: translateY(-2px); }
.znt-hero-leads-site .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--znt-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.znt-hero-leads-site .nero-ai-btn-secondary {
  color: var(--znt-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.znt-hero-leads-site .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--znt-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.znt-hero-leads-site .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.znt-hero-leads-site .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.znt-hero-leads-site .nero-ai-dots { display: flex; gap: 7px; }
.znt-hero-leads-site .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.znt-hero-leads-site .nero-ai-dot:nth-child(1) { background: #fb7185; }
.znt-hero-leads-site .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.znt-hero-leads-site .nero-ai-dot:nth-child(3) { background: #34d399; }
.znt-hero-leads-site .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.znt-hero-leads-site .nero-ai-window-body { padding: 16px; }
.znt-hero-leads-site .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.znt-hero-leads-site .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.znt-hero-leads-site .nero-ai-live-pill {
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
.znt-hero-leads-site .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: zntPulse 1.6s infinite;
}
@keyframes zntPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.znt-hero-leads-site .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.znt-hero-leads-site .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.znt-hero-leads-site .nero-ai-metric span {
  display: block;
  color: var(--znt-muted);
  font-size: 11px;
  font-weight: 700;
}
.znt-hero-leads-site .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.znt-hero-leads-site .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.znt-hero-leads-site .znt-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(ellipse at 35% 45%, rgba(121,242,255,.09), rgba(6,10,24,.92) 72%);
}
.znt-hero-leads-site #znt-lead-dispatch-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.znt-hero-leads-site .nero-ai-task-stream {
  display: flex;
  flex-direction: column;
  gap: 8px;
  max-height: 168px;
  overflow: hidden;
}
.znt-hero-leads-site .nero-ai-task {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: 10px;
  align-items: center;
  padding: 10px 12px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.04);
  font-size: 12px;
}
.znt-hero-leads-site .nero-ai-task-icon {
  width: 32px;
  height: 32px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 900;
  background: rgba(121,242,255,.12);
  color: var(--znt-cyan);
}
.znt-hero-leads-site .nero-ai-task strong { display: block; color: #fff; font-size: 12px; }
.znt-hero-leads-site .nero-ai-task span { color: var(--znt-muted); font-size: 11px; }
.znt-hero-leads-site .nero-ai-status {
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 5px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.12);
  color: #86efac;
}
.znt-hero-leads-site .nero-ai-status--amber {
  background: rgba(251,191,36,.12);
  color: #fde68a;
}
@media (max-width: 960px) {
  .znt-hero-leads-site .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .znt-hero-leads-site .nero-ai-dashboard { transform: none; }
}
</style>

<section class="nero-ai-hero znt-hero-leads-site" id="hero" aria-labelledby="znt-hero-leads-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai обработка заявок</p>
      <h1 id="znt-hero-leads-title">AI-агент для первичной обработки заявок с сайта: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Отвечаем на заявки за 5–15 секунд, уточняем потребность и передаём горячий лид в CRM — пока менеджеры офлайн</p>
      <ul class="nero-ai-badges" aria-label="Ключевые параметры">
        <li class="nero-ai-badge">5–15 сек</li>
        <li class="nero-ai-badge">24/7</li>
        <li class="nero-ai-badge">CRM</li>
        <li class="nero-ai-badge">Аудит 30 мин</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet-agent">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демонстрация AI-обработки заявок с сайта">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Диспетчер входящих · сайт → CRM</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Первый ответ</span>
              <strong>8 сек</strong>
              <small>виджет / форма</small>
            </div>
            <div class="nero-ai-metric">
              <span>Ночных заявок</span>
              <strong>12</strong>
              <small>00:00–07:00</small>
            </div>
            <div class="nero-ai-metric">
              <span>Hot-лиды</span>
              <strong>3</strong>
              <small>скоринг AI</small>
            </div>
            <div class="nero-ai-metric">
              <span>В CRM</span>
              <strong>auto</strong>
              <small>поля + задача</small>
            </div>
          </div>

          <div class="znt-dash-canvas-wrap" aria-hidden="false">
            <canvas id="znt-lead-dispatch-canvas" role="img" aria-label="Анимация: ночная заявка с сайта квалифицируется AI и превращается в горячую карточку CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий заявок">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">🌙</span>
              <div><strong>Форма Tilda · 02:14</strong><span>Услуга · бюджет уточнён</span></div>
              <span class="nero-ai-status">hot</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Диалог · 5 вопросов</strong><span>Квалификация · тег ai-qualified</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>amoCRM · сделка</strong><span>Задача: перезвон 10 мин</span></div>
              <span class="nero-ai-status">новое</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Push отделу продаж</strong><span>Менеджер офлайн — лид не остыл</span></div>
              <span class="nero-ai-status nero-ai-status--amber">эскалация</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * znt-lead-dispatch-engine — Диспетчерская ночных заявок
 * Классы: PulseLanes (транспорт), QualificationCore (центр), CrmDealCard (финал)
 * Пять Agent — роли Nero Network вокруг ядра квалификации
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("znt-lead-dispatch-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw * 0.52;
    cy = ch * 0.48;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    lane: "rgba(121,242,255,0.28)",
    laneHot: "rgba(34,197,94,0.45)",
    core: "#79f2ff",
    violet: "#8b5cf6",
    crm: "#1e293b",
    green: "#22c55e",
    amber: "#fbbf24",
    night: "#0b1224",
    text: "#e2e8f0",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6"
  };

  var bubbles = [];
  function sceneBubble(text, x, y, ttl) {
    bubbles.push({ text: text, x: x, y: y, life: ttl || 90, max: ttl || 90 });
  }

  function drawRR(x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.strokeStyle = stroke;
      ctx.lineWidth = 1.2;
      ctx.stroke();
    }
  }

  /* Транспорт: импульсы по дугам с трёх каналов */
  function PulseLanes() {
    this.phase = 0;
    this.lanes = [
      { label: "форма", yOff: -38, hue: C.lane },
      { label: "чат", yOff: 0, hue: C.lane },
      { label: "TG", yOff: 38, hue: "rgba(139,92,246,0.35)" }
    ];
  }
  PulseLanes.prototype.draw = function () {
    this.phase = (frame * 0.022) % 1;
    var self = this;
    this.lanes.forEach(function (lane, idx) {
      ctx.strokeStyle = lane.hue;
      ctx.lineWidth = idx === 1 ? 2 : 1.2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.moveTo(-cw * 0.42, lane.yOff);
      ctx.quadraticCurveTo(cx - 40, lane.yOff - 12, cx - 55, cy + lane.yOff * 0.15);
      ctx.stroke();
      ctx.setLineDash([]);

      var t = (self.phase + idx * 0.28) % 1;
      var px = -cw * 0.42 + t * (cx - 20 + cw * 0.42);
      var py = lane.yOff + Math.sin(t * Math.PI) * -18;
      drawPulse(px, py, t > 0.72 ? C.green : C.core);
    });
  };

  function drawPulse(x, y, color) {
    ctx.save();
    ctx.translate(x, y);
    ctx.fillStyle = color;
    ctx.shadowColor = color;
    ctx.shadowBlur = 12;
    ctx.beginPath();
    ctx.arc(0, 0, 5, 0, Math.PI * 2);
    ctx.fill();
    ctx.shadowBlur = 0;
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter, sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("лид", 0, 14);
    ctx.restore();
  }

  /* Центральный объект: кольцо квалификации */
  function QualificationCore() {
    this.spin = 0;
    this.hotFlash = 0;
  }
  QualificationCore.prototype.draw = function () {
    this.spin += 0.018;
    var cycle = frame % 420;
    if (cycle === 310) sceneBubble("Ответ 8 сек", cx, cy - 58, 70);
    if (cycle === 360) sceneBubble("Скоринг: HOT", cx + 8, cy - 42, 80);
    if (cycle > 370 && cycle < 400) this.hotFlash = (this.hotFlash + 0.08) % 1;

    ctx.save();
    ctx.translate(cx, cy);
    ctx.strokeStyle = "rgba(121,242,255,0.35)";
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.arc(0, 0, 42, 0, Math.PI * 2);
    ctx.stroke();
    ctx.strokeStyle = C.violet;
    ctx.setLineDash([10, 6]);
    ctx.lineDashOffset = -this.spin * 40;
    ctx.beginPath();
    ctx.arc(0, 0, 32, 0, Math.PI * 2);
    ctx.stroke();
    ctx.setLineDash([]);
    ctx.fillStyle = "rgba(15,23,42,0.85)";
    drawRR(-28, -22, 56, 44, 10, "rgba(15,23,42,0.92)", "rgba(121,242,255,0.4)");
    ctx.fillStyle = C.text;
    ctx.font = "bold 9px Inter, sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI", 0, -4);
    ctx.font = "7px Inter, sans-serif";
    ctx.fillStyle = "#94a3b8";
    ctx.fillText("квалификация", 0, 8);
    ctx.restore();
  };

  function CrmDealCard() {
    this.glow = 0;
  }
  CrmDealCard.prototype.draw = function () {
    var cycle = frame % 420;
    var x = cw * 0.78;
    var y = cy + 6;
    if (cycle > 385) this.glow = Math.min(1, this.glow + 0.04);
    else this.glow = Math.max(0, this.glow - 0.02);

    ctx.save();
    ctx.translate(x, y);
    if (this.glow > 0.1) {
      ctx.shadowColor = C.green;
      ctx.shadowBlur = 18 * this.glow;
    }
    drawRR(-46, -34, 92, 68, 12, C.crm, "rgba(34,197,94," + (0.25 + this.glow * 0.5) + ")");
    ctx.shadowBlur = 0;
    ctx.fillStyle = "#fff";
    ctx.font = "bold 10px Inter, sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("Сделка · HOT", -38, -14);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "8px Inter, sans-serif";
    ctx.fillText("Бюджет · срочность", -38, 0);
    ctx.fillStyle = C.green;
    ctx.fillText("Задача менеджеру", -38, 16);
    if (cycle === 400) sceneBubble("В CRM за 12 сек", x, y - 50, 85);
    ctx.restore();
  };

  function NightSiteWidget() {
    this.tick = 0;
  }
  NightSiteWidget.prototype.draw = function () {
    var x = cw * 0.12;
    var y = cy - 10;
    this.tick = frame % 600;
    ctx.save();
    ctx.translate(x, y);
    drawRR(-52, -40, 104, 72, 10, "rgba(30,41,59,0.95)", "rgba(148,163,184,0.35)");
    ctx.fillStyle = C.amber;
    ctx.font = "bold 11px monospace";
    ctx.fillText("02:47", -40, -18);
    ctx.fillStyle = "#94a3b8";
    ctx.font = "8px Inter, sans-serif";
    ctx.fillText("форма отправлена", -40, -2);
    drawRR(-40, 8, 80, 22, 6, "rgba(121,242,255,0.15)", "rgba(121,242,255,0.35)");
    ctx.fillStyle = C.core;
    ctx.font = "bold 8px Inter, sans-serif";
    ctx.fillText("Жду ответ…", -34, 22);
    if (this.tick === 120) sceneBubble("Ночная заявка", x, y - 48, 75);
    ctx.restore();
  }

  function Agent(role, color, homeX, homeY, dialogs) {
    this.role = role;
    this.color = color;
    this.homeX = homeX;
    this.homeY = homeY;
    this.x = homeX;
    this.y = homeY;
    this.dialogs = dialogs;
    this.step = Math.random() * 200;
    this.bubble = "";
    this.bubbleT = 0;
  }
  Agent.prototype.update = function () {
    this.step = (this.step + 0.6) % 200;
    var t = this.step / 200;
    var targetX = cx + Math.cos(t * Math.PI * 2 + this.homeX) * 70;
    var targetY = cy + Math.sin(t * Math.PI * 2 + this.homeY) * 42;
    this.x += (targetX - this.x) * 0.04;
    this.y += (targetY - this.y) * 0.04;
    if (frame % 180 === Math.floor(this.homeX * 17) % 180) {
      this.bubble = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      this.bubbleT = 100;
    }
    if (this.bubbleT > 0) this.bubbleT--;
  };
  Agent.prototype.draw = function () {
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, 0, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillStyle = "#0f172a";
    ctx.beginPath();
    ctx.arc(0, -9, 5, 0, Math.PI * 2);
    ctx.fill();
    if (this.bubbleT > 0 && this.bubble) {
      var w = Math.min(120, 8 + this.bubble.length * 5.2);
      drawRR(-w / 2, -32, w, 18, 6, "#0f172a", "rgba(255,255,255,0.12)");
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "7px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(this.bubble, 0, -20);
    }
    ctx.restore();
  };

  var lanes = new PulseLanes();
  var core = new QualificationCore();
  var crm = new CrmDealCard();
  var site = new NightSiteWidget();
  var agents = [
    new Agent("1_architect", C.agentYellow, 0.2, 0.3, ["Маршрут форма→CRM", "Webhook < 1 с", "Точки входа на карте"]),
    new Agent("2_seo", C.agentGreen, 1.1, 0.8, ["UTM с лендинга", "Страница /price", "Ночной трафик"]),
    new Agent("3_coder", C.agentBlue, 2.2, 0.4, ["Таймер 5–15 сек", "Guardrails цен", "Логи диалога"]),
    new Agent("4_designer", C.agentPink, 3.3, 1.0, ["Карточка лида", "Поля CRM", "Резюме 3 строки"]),
    new Agent("5_deployer", C.agentPurple, 4.4, 0.6, ["Push в Telegram", "Задача менеджеру", "Тег ai-qualified"])
  ];

  function drawBubbles() {
    bubbles = bubbles.filter(function (b) {
      b.life--;
      return b.life > 0;
    });
    bubbles.forEach(function (b) {
      var a = b.life / b.max;
      ctx.globalAlpha = a;
      drawRR(b.x - 44, b.y - 10, 88, 20, 8, "rgba(15,23,42,0.92)", "rgba(121,242,255,0.25)");
      ctx.fillStyle = "#e2e8f0";
      ctx.font = "8px Inter, sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y + 4);
      ctx.globalAlpha = 1;
    });
  }

  function loop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    site.draw();
    ctx.restore();
    lanes.draw();
    core.draw();
    crm.draw();
    agents.forEach(function (a) {
      a.update();
      a.draw();
    });
    drawBubbles();
    requestAnimationFrame(loop);
  }
  loop();
});
</script>

<div class="aoz-content">
<section class="aoz-intro" aria-label="Введение">
  <div class="aoz-cnt">
    <div class="aoz-intro-grid nero-ai-reveal">
      <div class="aoz-intro-text">
        <p><strong>Коротко:</strong> </p>
        <p>Nero Network внедряет AI-агента для первичной обработки заявок: скорость ответа, квалификация и передача лида в CRM без ожидания менеджера.</p>
      </div>
      <div class="aoz-intro-kpi" aria-hidden="false">
        <div class="aoz-kpi-card"><div class="kv">5–15 с</div><div class="kl">первый ответ</div></div>
        <div class="aoz-kpi-card"><div class="kv">24/7</div><div class="kl">ночь и выходные</div></div>
        <div class="aoz-kpi-card"><div class="kv">CRM</div><div class="kl">поля и задачи</div></div>
        <div class="aoz-kpi-card"><div class="kv">30 мин</div><div class="kl">аудит потерь</div></div>
      </div>
    </div>
  </div>
</section>
<section class="aoz-toc-wrap" aria-label="Оглавление">
  <div class="aoz-cnt">
    <nav class="aoz-toc ym-toc nero-ai-reveal" aria-label="Разделы страницы">
      <a href="#pochemu-zayavki-ostyvayut">Почему остывают</a>
      <a href="#chto-takoe-ai-obrabotka">Что такое AI-обработка</a>
      <a href="#kak-rabotaet-agent">Как работает</a>
      <a href="#vnedrenie-pod-klyuch">Внедрение</a>
      <a href="#integraciya-crm">CRM</a>
      <a href="#dlya-kogo">Для кого</a>
      <a href="#cena">Цена</a>
      <a href="#keisy">Кейсы</a>
      <a href="#faq">FAQ</a>
      <a href="#proverit-poteri">Аудит</a>
    </nav>
  </div>
</section>
<section class="aoz-section" id="pochemu-zayavki-ostyvayut">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>Почему заявки с сайта остывают, пока менеджер спит</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<p>Заявка с лендинга — это не «ещё одна строка в таблице». Это человек, который <strong>сейчас</strong> готов обсудить услугу, курс или приём. Пока отдел продаж спит, в пути или занят текущим звонком, конкурент или бездействие забирают внимание. Боль, которую мы слышим от клиентов Nero Network чаще всего, звучит просто: <strong>заявки приходят ночью и в выходные, менеджеры отвечают с задержкой, лиды остывают</strong>.</p>
<p class="aoz-lead"><strong>Определение для справки:</strong> скорость первого ответа — интервал между событием «клиент оставил контакт или написал в чат» и первым <strong>содержательным</strong> ответом (не автоответ «мы перезвоним»). Именно её имеет смысл мерить в p90 — 90-й перцентиль, а не среднее по «героям недели» (<a href="https://excella.ru/blog/skorost-otveta-na-zayavku-p90" class="aoz-link" target="_blank" rel="noopener noreferrer">обзор метрик p90</a>).</p><h3 id="lider-bez-otveta" class="aoz-h3">Что происходит с лидом через 5, 30 и 120 минут без ответа</h3><p>Классическое исследование Lead Response Management (MIT × InsideSales, 2007), которое до сих пор цитируют в B2B, показывает резкий разрыв между контактом в <strong>первые 5 минут</strong> и ответом через <strong>30 минут и позже</strong> — шанс дозвона и квалификации падает кратно (агрегатор с разбором: <a href="https://www.convindex.co/ru/response-time/response-time-and-conversion" class="aoz-link" target="_blank" rel="noopener noreferrer">Convindex</a>). Это не российская выборка и не гарантия «×21 к сделке» для любой ниши, но логика устойчива: <strong>лид живёт в контексте момента</strong>.</p>
<p>Практическая картина для SMB:</p>
<div class="aoz-table-wrap"><table class="aoz-table">
<thead><tr><th>Интервал без ответа</th><th>Типичное поведение клиента</th></tr></thead><tbody>
<tr><td><strong>~5 минут</strong></td><td>Ещё на сайте или в мессенджере; ждёт уточнения по цене, сроку, записи</td></tr>
<tr><td><strong>~30 минут</strong></td><td>Переключился на дела; сравнивает 2–3 конкурентов; часть уходит без второго касания</td></tr>
<tr><td><strong>~120 минут и больше</strong></td><td>Заявка «архивная»; звонок менеджера воспринимается как холодный; растёт no-show</td></tr>
</tbody></table></div>
<p>В России свежий ориентир — опрос <strong>Телфин и OkoCRM</strong> (ноябрь 2025, <strong>7500+</strong> представителей бизнеса): примерно <strong>половина клиентов уходит без заказа</strong>, если ответ приходится ждать <strong>более 10 минут</strong> (<a href="https://www.telphin.ru/about-company/news/issledovanie-telphin-i-okocrm" class="aoz-link" target="_blank" rel="noopener noreferrer">пресс-релиз Телфин</a>, <a href="https://oborot.ru/articles/kommunikacii-opros-72-i259134.html" class="aoz-link" target="_blank" rel="noopener noreferrer">Oborot.ru</a>). В e-commerce формальный ответ часто ожидают в коридоре 30–60 минут; в коммерческой медицине в острых сценариях критичны <strong>15 минут</strong> — это не абстракция, а операционный SLA клиники.</p>
<p class="aoz-lead"><strong>Итог блока:</strong> проблема не в «ленивых менеджерах», а в <strong>несовпадении графика спроса и графика отдела продаж</strong>. Ночная заявка с формы Tilda в воскресенье — нормальный трафик рекламы, а не исключение.</p><h3 id="gde-teryayutsya-zayavki" class="aoz-h3">Где теряются заявки: формы, чат, мессенджеры, коллбек</h3><p>Точки входа разные, механика потери — одна: <strong>клиент не получил диалог вовремя</strong>.</p>
<div class="aoz-table-wrap"><table class="aoz-table">
<thead><tr><th>Точка входа</th><th>Где теряется лид при задержке</th><th>Что даёт AI-агент</th></tr></thead><tbody>
<tr><td>Виджет на сайте</td><td>Закрыл вкладку через 2–3 минуты без ответа</td><td>Мгновенный диалог, удержание вопросом</td></tr>
<tr><td>Форма Tilda / WordPress</td><td>«Спасибо, перезвоним» — ожидание до следующего дня</td><td>Webhook → чат, SMS, Telegram или follow-up в виджете</td></tr>
<tr><td>Telegram / WhatsApp</td><td>Очередь у одного администратора</td><td>Первая линия 24/7, эскалация по скорингу</td></tr>
<tr><td>Коллбек</td><td>Ждёт звонок 15–30 минут, уходит</td><td>Уточнение задачи в чате, приоритет в CRM, меньше no-show</td></tr>
<tr><td>Ночь и выходные</td><td>До понедельника нет первичного контакта</td><td>Ответ за <strong>5–15 секунд</strong> по офферу Nero Network</td></tr>
</tbody></table></div>
<p class="aoz-lead"><strong>Важно не смешивать каналы:</strong> страница про <a href="/vnedrenie-ai-obrabotka-email-crm/" class="aoz-link" target="_blank" rel="noopener noreferrer">AI-обработку email в CRM</a> закрывает <strong>входящую почту</strong>; здесь фокус — <strong>сайт, формы, чат и мессенджеры с лендинга</strong>. Другой webhook, другой SLA, другая воронка.</p>
    </div>
<div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-poteri-rannee">
  <div class="ym-cta-block__icon" aria-hidden="true">⏱️</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Половина клиентов уходит, если ждать ответ дольше 10 минут</p>
    <p class="ym-cta-block__sub">На бесплатном аудите за 30 минут посчитаем, сколько заявок с сайта и мессенджеров у вас «остывает» ночью и в выходные — и где встроить AI-агента с ответом за 5–15 секунд.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>
  </div>
</section>

<section class="aoz-section aoz-section-alt" id="chto-takoe-ai-obrabotka">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>Что такое AI обработка заявок для бизнеса</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<p class="aoz-lead"><strong>AI обработка заявок</strong> — автоматический первичный контакт с лидом с сайта или мессенджера с квалификацией и записью в CRM. Это не «красивая кнопка чата», а <strong>программный слой</strong> между точкой входа (форма, виджет, коллбек) и вашей CRM.</p>
<p class="aoz-lead"><strong>AI агент для сайта</strong> — виджет или встроенный чат, который ведёт диалог по сценарию бизнеса на естественном языке: уточняет поля, отвечает по базе знаний, классифицирует лид и <strong>выполняет действия</strong> — создаёт сделку, ставит задачу, проставляет теги. Тренд 2026 года, который фиксируют и вендоры вроде OpenAI на странице <a href="https://openai.com/business/" class="aoz-link" target="_blank" rel="noopener noreferrer">OpenAI for business</a>, и экосистема CRM: агентность — это API + инструменты, а не только текст в окне чата.</p>
<p>Типовой стек внедрения (по практике интеграторов и research Nero Network):</p>
<ol class="aoz-ol"><li>Событие формы или чата → webhook (< 1 с).</li><li>Оркестратор (n8n, Make, собственный API).</li><li>LLM (OpenAI, YandexGPT, Claude) + RAG по вашим документам.</li><li>Адаптер CRM (amoCRM API v4, Битрикс24 REST, retailCRM).</li><li>Панель метрик: p90 ответа, доля квалифицированных, эскалации.</li></ol><h3 id="otlichie-ot-chatbota" class="aoz-h3">Отличие от обычного чат-бота и от email-автоматизации в CRM</h3><div class="aoz-table-wrap"><table class="aoz-table">
<thead><tr><th>Критерий</th><th>Скриптовый чат-бот</th><th>Email-автоматизация в CRM</th><th>AI-агент Nero Network на сайте</th></tr></thead><tbody>
<tr><td>Канал</td><td>Часто только виджет</td><td>Входящая почта</td><td>Сайт, формы, мессенджеры</td></tr>
<tr><td>Язык</td><td>Кнопки и ветки</td><td>Письма и шаблоны</td><td>Диалог, уточнение полей</td></tr>
<tr><td>Действия в CRM</td><td>Редко</td><td>Классификация писем</td><td>Сделка, поля, задача, резюме диалога</td></tr>
<tr><td>Скорость</td><td>Быстро, но жёстко</td><td>Минуты–часы</td><td><strong>5–15 секунд</strong> первого ответа</td></tr>
<tr><td>Эскалация</td><td>«Позвоните в офис»</td><td>Маршрут на менеджера</td><td>Живой человек по правилам + контекст в карточке</td></tr>
</tbody></table></div>
<p class="aoz-lead"><strong>Нейросеть для обработки лидов</strong> в этом контексте — не замена отделу продаж, а <strong>диспетчер входящих</strong>: принимает обращение, собирает досье, передаёт «горячее» менеджеру. Формулировка из кейса ROC AI по мультиканальному диспетчеру хорошо ложится на коммерческую подачу: не FAQ-бот, а <strong>маршрутизация намерения</strong> (<a href="https://rocai.ru/cases/ai-incoming-request-dispatcher" class="aoz-link" target="_blank" rel="noopener noreferrer">rocai.ru</a>).</p>
    </div>
  </div>
</section>

<section id="ai-obrabotka-zayavok-s-sayta-boris-block" class="aoz-root" aria-label="Сценарий квалификации: диалог на сайте и карточка лида в CRM">
<style>
/* === БОРИС: prefix aoz-, scoped внутри #ai-obrabotka-zayavok-s-sayta-boris-block === */
#aoz-boris-pipeline-canvas{display:block;width:100%;height:100%;}
.aoz-root{padding:56px 0 64px;background:#f8fafc;}
.aoz-cnt{max-width:1160px;margin:0 auto;padding:0 20px;}
.aoz-card{
  display:grid;
  grid-template-columns:41% 59%;
  gap:0;
  border-radius:22px;
  overflow:hidden;
  background:#ffffff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.25);
  min-height:440px;
}
@media(max-width:960px){
  .aoz-card{grid-template-columns:1fr;min-height:auto;}
}
.aoz-lft{
  padding:40px 36px 44px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:960px){
  .aoz-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
.aoz-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:#0ea5e9;
  margin:0 0 12px;
}
.aoz-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0ea5e9;
  border-radius:1px;
}
.aoz-h3{
  font-size:1.35rem;
  font-weight:800;
  line-height:1.32;
  color:#0f172a;
  margin:0 0 18px;
}
@media(max-width:600px){.aoz-h3{font-size:1.15rem;}}
.aoz-ul{
  list-style:none;
  margin:0 0 20px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
.aoz-ul li{
  display:flex;
  gap:10px;
  align-items:flex-start;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
.aoz-step{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:6px;
  background:#e0f2fe;
  color:#0369a1;
  font-size:11px;
  font-weight:800;
  display:flex;
  align-items:center;
  justify-content:center;
}
.aoz-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;}
.aoz-pl{
  font-size:11.5px;
  font-weight:700;
  padding:5px 11px;
  border-radius:999px;
  white-space:nowrap;
}
.aoz-pl-hot{background:rgba(239,68,68,.08);color:#b91c1c;border:1px solid rgba(239,68,68,.2);}
.aoz-pl-time{background:rgba(14,165,233,.08);color:#0369a1;border:1px solid rgba(14,165,233,.22);}
.aoz-pl-tag{background:rgba(34,197,94,.08);color:#15803d;border:1px solid rgba(34,197,94,.22);}
.aoz-bridge{
  margin:0;
  font-size:13px;
  color:#64748b;
  font-style:italic;
}
.aoz-rgt{
  position:relative;
  min-height:400px;
  background:linear-gradient(160deg,#f1f5f9 0%,#e8f4fc 45%,#f8fafc 100%);
}
@media(max-width:960px){.aoz-rgt{min-height:360px;}}
#aoz-boris-pipeline-canvas{
  position:absolute;
  inset:0;
}
</style>

<div class="aoz-cnt">
  <div class="aoz-card">
    <div class="aoz-lft">
      <span class="aoz-ey">Сценарий · ai обработка заявок</span>
      <h3 class="aoz-h3">От ночной заявки до «горячей» карточки в CRM — без ожидания менеджера</h3>
      <ul class="aoz-ul">
        <li><span class="aoz-step">1</span>Webhook формы или чата — событие за доли секунды</li>
        <li><span class="aoz-step">2</span>AI уточняет услугу, бюджет, срочность и город</li>
        <li><span class="aoz-step">3</span>Скоринг hot / warm и тег <code style="font-size:12px;background:#f1f5f9;padding:1px 6px;border-radius:4px;">ai-qualified</code></li>
        <li><span class="aoz-step">4</span>В CRM: поля, резюме диалога и задача «перезвонить»</li>
      </ul>
      <div class="aoz-pills">
        <span class="aoz-pl aoz-pl-time">5–15 сек первый ответ</span>
        <span class="aoz-pl aoz-pl-hot">HOT · приоритет</span>
        <span class="aoz-pl aoz-pl-tag">amoCRM · Битрикс24</span>
      </div>
      <p class="aoz-bridge">Дальше разберём пошаговую логику агента на сайте →</p>
    </div>
    <div class="aoz-rgt" aria-hidden="false">
      <canvas
        id="aoz-boris-pipeline-canvas"
        role="img"
        aria-label="Анимация: ночная заявка с сайта, диалог квалификации и заполнение карточки лида в CRM"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function () {
  var canvas = document.getElementById('aoz-boris-pipeline-canvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  var W = 0, H = 0, frame = 0, t = 0;

  var C = {
    ink: '#0f172a',
    muted: '#64748b',
    line: '#cbd5e1',
    sky: '#e2e8f0',
    card: '#ffffff',
    accent: '#0ea5e9',
    accentSoft: 'rgba(14,165,233,.12)',
    hot: '#ef4444',
    ok: '#22c55e',
    viol: '#8b5cf6',
    night: '#1e293b'
  };

  function resize() {
    var p = canvas.parentElement;
    if (!p) return;
    canvas.width = p.clientWidth || 640;
    canvas.height = p.clientHeight || 400;
    W = canvas.width;
    H = canvas.height;
  }
  window.addEventListener('resize', resize);
  resize();

  function rr(x, y, w, h, r) {
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
  }

  function drawBubble(x, y, w, h, text, alignRight) {
    ctx.fillStyle = alignRight ? C.accentSoft : C.card;
    ctx.strokeStyle = alignRight ? C.accent : C.line;
    ctx.lineWidth = 1.5;
    rr(x, y, w, h, 12);
    ctx.fill();
    ctx.stroke();
    ctx.fillStyle = C.ink;
    ctx.font = (W < 400 ? '10px' : '11px') + ' system-ui,sans-serif';
    var lines = text.split('\n');
    var ly = y + 14;
    lines.forEach(function (ln) {
      ctx.fillText(ln, x + 12, ly);
      ly += 14;
    });
  }

  function drawCrmCard(cx, cy, cw, ch, fillProgress) {
    ctx.fillStyle = C.card;
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 2;
    rr(cx, cy, cw, ch, 14);
    ctx.fill();
    ctx.stroke();

    ctx.fillStyle = C.viol;
    ctx.font = 'bold 12px system-ui,sans-serif';
    ctx.fillText('Сделка · Новый лид', cx + 14, cy + 22);

    var fields = [
      { label: 'Источник', val: 'Форма Tilda · UTM' },
      { label: 'Бюджет', val: 'от 120 000 ₽' },
      { label: 'Срочность', val: 'На этой неделе' },
      { label: 'Резюме AI', val: 'Запись на аудит, клиника…' }
    ];
    var rowH = 28;
    var startY = cy + 36;
    fields.forEach(function (f, i) {
      var show = fillProgress > i * 0.22;
      if (!show) return;
      var alpha = Math.min(1, (fillProgress - i * 0.22) * 4);
      ctx.globalAlpha = alpha;
      ctx.fillStyle = C.muted;
      ctx.font = '9px system-ui,sans-serif';
      ctx.fillText(f.label, cx + 14, startY + i * rowH);
      ctx.fillStyle = C.ink;
      ctx.font = '11px system-ui,sans-serif';
      ctx.fillText(f.val, cx + 14, startY + i * rowH + 14);
      ctx.globalAlpha = 1;
    });

    if (fillProgress > 0.85) {
      ctx.fillStyle = C.ok;
      rr(cx + cw - 72, cy + ch - 32, 58, 22, 8);
      ctx.fill();
      ctx.fillStyle = '#fff';
      ctx.font = 'bold 10px system-ui,sans-serif';
      ctx.fillText('HOT', cx + cw - 58, cy + ch - 17);
    }
  }

  function loop() {
    frame++;
    t = (frame % 480) / 480;
    ctx.clearRect(0, 0, W, H);

    var pad = Math.max(12, W * 0.04);
    var chatW = W - pad * 2;
    var chatH = H * 0.52;
    var chatY = pad;

    /* Ночной индикатор */
    var nightAlpha = t < 0.15 ? 1 : t < 0.35 ? 1 - (t - 0.15) / 0.2 : 0;
    if (nightAlpha > 0.05) {
      ctx.globalAlpha = nightAlpha * 0.35;
      ctx.fillStyle = C.night;
      rr(pad, chatY, chatW, 28, 8);
      ctx.fill();
      ctx.globalAlpha = nightAlpha;
      ctx.fillStyle = '#f8fafc';
      ctx.font = '11px system-ui,sans-serif';
      ctx.fillText('🌙 02:14 · заявка с лендинга', pad + 10, chatY + 18);
      ctx.globalAlpha = 1;
    }

    /* Фаза чата */
    var phase = t;
    var bubblePhase = (phase * 4) % 1;
    var qIdx = Math.floor(phase * 4) % 3;
    var questions = [
      'Здравствуйте! Чем помочь?',
      'Какая услуга и\nориентир по бюджету?',
      'Когда удобно созвониться?'
    ];
    var answers = [
      'Нужна запись на консультацию',
      'Услуга X, бюджет до 150 тыс.',
      'Лучше завтра до обеда'
    ];

    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1;
    rr(pad, chatY + (nightAlpha > 0.1 ? 34 : 0), chatW, chatH - (nightAlpha > 0.1 ? 34 : 0), 16);
    ctx.stroke();

    if (phase > 0.08 && phase < 0.72) {
      var bp = Math.min(1, (phase - 0.08) / 0.55);
      var qShow = Math.min(qIdx, Math.floor(bp * 3));
      for (var qi = 0; qi <= qShow; qi++) {
        drawBubble(pad + 12, chatY + 44 + qi * 52, chatW * 0.55, 40, questions[qi], false);
        if (qi < qShow || bubblePhase > 0.5) {
          drawBubble(pad + chatW * 0.38, chatY + 68 + qi * 52, chatW * 0.52, 40, answers[qi], true);
        }
      }
    }

    /* Поток в CRM */
    var crmY = chatY + chatH + pad * 0.6;
    var crmH = H - crmY - pad;
    if (crmH < 100) crmH = 100;
    var flow = Math.max(0, Math.min(1, (phase - 0.55) / 0.4));

    if (phase > 0.5) {
      ctx.strokeStyle = C.accent;
      ctx.setLineDash([6, 6]);
      ctx.lineWidth = 2;
      ctx.globalAlpha = 0.5 + flow * 0.5;
      ctx.beginPath();
      ctx.moveTo(W / 2, chatY + chatH - 8);
      ctx.lineTo(W / 2, crmY - 4);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.globalAlpha = 1;

      var cardW = Math.min(chatW, 320);
      var cardX = (W - cardW) / 2;
      drawCrmCard(cardX, crmY, cardW, crmH, flow);
    }

    /* Пульс «ответ за секунды» */
    if (phase < 0.72) {
      var pulse = 0.5 + 0.5 * Math.sin(frame * 0.12);
      ctx.fillStyle = C.accent;
      ctx.globalAlpha = 0.15 + pulse * 0.2;
      ctx.beginPath();
      ctx.arc(pad + 14, chatY + 22, 6 + pulse * 3, 0, Math.PI * 2);
      ctx.fill();
      ctx.globalAlpha = 1;
    }

    requestAnimationFrame(loop);
  }

  requestAnimationFrame(loop);
})();
</script>
</section>


<section class="aoz-section" id="kak-rabotaet-agent">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>Как работает AI-агент на сайте: сценарий за 5–15 секунд</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<p>Коммерческий оффер Nero Network для <strong>ai обработка заявок под ключ</strong>: агент отвечает за <strong>5–15 секунд</strong>, задаёт уточняющие вопросы, квалифицирует и передаёт <strong>горячий</strong> лид в CRM — пока менеджеры офлайн.</p>
<p class="aoz-lead"><strong>Логика работы (7 шагов):</strong></p>
<ol class="aoz-ol"><li><strong>Событие:</strong> <code>form_submit</code>, <code>chat_start</code> или <code>callback_request</code> → webhook.</li><li><strong>Приветствие:</strong> фиксация источника (UTM, страница, рекламный кабинет).</li><li><strong>Согласие на ПДн:</strong> отдельный шаг для телефона/email (см. блок про 152-ФЗ в FAQ).</li><li><strong>3–7 вопросов</strong> по скрипту ниши: услуга, бюджет, срочность, город.</li><li><strong>Скоринг:</strong> hot / warm / cold / spam.</li><li><strong>Запись в CRM:</strong> контакт, сделка, кастомные поля, note с транскриптом, тег <code>ai-qualified</code>.</li><li><strong>Эскалация:</strong> негатив, запрос человека, юридический спор — AI прекращает «дожим», задача менеджеру.</li></ol>
<p>Для hot-лидов — push в Telegram отдела продаж или задача «перезвонить в течение X минут».</p><h3 id="kvalifikaciya" class="aoz-h3">Приветствие и уточняющие вопросы (квалификация)</h3><p class="aoz-lead"><strong>AI менеджер заявок</strong> работает по <strong>матрице квалификации</strong>, а не по случайному small talk. Пример полей, которые бизнес закладывает в сценарий (адаптируется под нишу):</p>
<ul class="aoz-ul"><li>Тип запроса (услуга / продукт / запись).</li><li>Бюджет или ценовой сегмент («от» из прайса, без выдуманных скидок).</li><li>Срочность и желаемая дата.</li><li>География (район, филиал клиники, доставка).</li><li>Стоп-факторы: «только наличные», «нет лицензии» — маршрут в отказ или другой отдел.</li></ul>
<p>Международный паттерн <strong>fullscreen после формы</strong> (кейс Fama у Spara): клиент отправил заявку и <strong>не ушёл ждать звонка</strong> — сразу conversational pre-qual (<a href="https://www.spara.com/case-studies/fama" class="aoz-link" target="_blank" rel="noopener noreferrer">spara.com/case-studies/fama</a>). Для Tilda и WordPress это особенно актуально: форма без чата больше не означает «чёрную дыру до понедельника».</p><h3 id="eskalaciya" class="aoz-h3">Когда AI передаёт диалог менеджеру</h3><p>AI <strong>не должен дожимать</strong>, если:</p>
<ul class="aoz-ul"><li>клиент явно просит человека;</li><li>негатив, претензия, угроза юридическими действиями;</li><li>медицинская срочность (клиники);</li><li>запрос удаления персональных данных;</li><li>тема вне базы знаний и политики ценообразования.</li></ul>
<p>Человек остаётся за <strong>закрытием сделки</strong>, переговорами по договору, нестандартными скидками и юридически значимыми обещаниями. AI закрывает <strong>первичку и досье</strong> — менеджер получает не «голый телефон», а резюме на 3–5 предложений и заполненные поля.</p>
    </div>
  </div>
</section>

<section class="aoz-section aoz-section-alt" id="vnedrenie-pod-klyuch">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>Внедрение AI обработки заявок под ключ: этапы и сроки</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<p class="aoz-lead"><strong>Внедрение ai агентов</strong> в точку «заявка с сайта» у Nero Network описывается как проект с понятными этапами. Рынок интеграторов в РФ часто называет MVP <strong>7–14 дней</strong>; мы совмещаем быстрый запуск с пилотом на реальных диалогах.</p>
<p><strong>Как внедрить ai обработка заявок</strong> без хаоса:</p><h3 id="audit-vhoda" class="aoz-h3">Аудит точек входа заявок</h3><p>Лид-магнит страницы — <strong>«Аудит потерь заявок за 30 минут»</strong>. На созвоне фиксируем:</p>
<ul class="aoz-ul"><li>карту каналов: форма, чат, коллбек, Telegram/VK;</li><li>p90 времени первого ответа в рабочие и нерабочие часы;</li><li>долю заявок вне типового графика 10:00–19:00.</li></ul>
<p>Без этой карты бессмысленно спорить «нужен ли AI»: сначала измеряем <strong>сколько лидов остывает</strong> из-за скорости, а не из-за продукта.</p><h3 id="baza-znanij" class="aoz-h3">Настройка сценариев и базы знаний</h3><p>Пакет данных для старта:</p>
<ul class="aoz-ul"><li>скрипт продаж / чек-лист квалификации;</li><li>прайс «от» и границы, что <strong>нельзя</strong> озвучивать агенту;</li><li>FAQ, возражения, запретные темы;</li><li>20–50 реальных диалогов менеджеров (тональность);</li><li>политика ПДн и текст согласия.</li></ul>
<p><strong>Настройка ai обработка заявок</strong> включает guardrails: запрет выдуманных цен, ссылки только из whitelist, логирование спорных ответов для human_review.</p><h3 id="pilot" class="aoz-h3">Тест на реальных диалогах и запуск</h3><p>Пилот <strong>2–3 недели</strong>: разбор логов, донастройка промптов и полей CRM, подключение мессенджеров (этап 2) — тот же агент, единая история в карточке.</p>
<p><strong>Автоматизация через ai обработка заявок</strong> после пилота измеряется не «понравился ли бот», а KPI:</p>
<ul class="aoz-ul"><li>p90 времени первого содержательного ответа;</li><li>доля квалифицированных лидов;</li><li>доля эскалаций;</li><li>конверсия этапа «новый лид → контакт состоялся».</li></ul>
<p>Точные проценты роста выручки — только на данных клиента после пилота; в материалах мы опираемся на бенчмарки исследований, а не на выдуманный ROI.</p>
    </div>
<div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-audit-etapy">
  <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Аудит потерь заявок за 30 минут — бесплатно</p>
    <p class="ym-cta-block__sub">Карта каналов (форма, чат, коллбек, мессенджеры), p90 первого ответа в рабочие и нерабочие часы и план MVP на 7–14 дней. Без обязательств по внедрению.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
  </div>
</div>
<aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal nero-ai-delay-1" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понимать AI до пилота на сайте?</p>
    <p class="ym-cta-block__sub">Перед настройкой сценариев и интеграцией с CRM полезно разобраться в n8n, промптах и human-in-the-loop — так быстрее согласуются скрипт квалификации и guardrails. Посмотрите <a href="<?php echo esc_url($secondary_cta_training_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_training_label); ?></a>.</p>
  </div>
</aside>
  </div>
</section>

<section class="aoz-section" id="integraciya-crm">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>Интеграция AI обработки заявок с CRM</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<p class="aoz-lead"><strong>Интеграция ai обработка заявок с crm</strong> — обязательная часть услуги, а не опция. Карточка лида должна отражать <strong>диалог</strong>, а не только UTM из формы.</p><h3 id="polya-crm" class="aoz-h3">amoCRM, Битрикс24, retailCRM — что попадает в карточку лида</h3><p>Минимальный набор полей для менеджера (практика интеграторов + логика amoAI):</p>
<div class="aoz-table-wrap"><table class="aoz-table">
<thead><tr><th>Поле / артефакт</th><th>Зачем менеджеру</th></tr></thead><tbody>
<tr><td>Имя, телефон, email</td><td>После отдельного согласия</td></tr>
<tr><td>Источник, UTM, страница входа</td><td>Атрибуция рекламы</td></tr>
<tr><td>Тип запроса, бюджет, срочность</td><td>Приоритет звонка</td></tr>
<tr><td>Город / район / филиал</td><td>Маршрутизация</td></tr>
<tr><td>Скоринг AI + резюме 3–5 предложений</td><td>Быстрый вход в разговор</td></tr>
<tr><td>Транскрипт в note</td><td>Аудит и обучение</td></tr>
<tr><td>Тег <code>ai-qualified</code></td><td>Отчёты в CRM</td></tr>
</tbody></table></div>
<p>В <strong>amoCRM</strong> нативный <a href="https://www.amocrm.ru/ai-agent/" class="aoz-link" target="_blank" rel="noopener noreferrer">AI-агент</a> (тариф Профессиональный+) умеет квалификацию и действия в CRM через «Чаты и мессенджеры». <strong>Nero Network</strong> имеет смысл, когда нужны: кастомный виджет на Tilda/WordPress, единая логика для <strong>формы без чата</strong>, RAG по сложному каталогу, retailCRM, очередь доставки в CRM (как в кейсе медоборудования на Workspace.ru), Yandex-only и <strong>аудит потерь</strong> как услуга.</p>
<p>Кейс <strong>«Беспалов Авто»</strong> (Жариков Консалтинг): неполная заявка на сайте → лид в Bitrix24 → AI продолжает диалог в Telegram, уточняет бюджет → карточка обновляется (<a href="https://zharikovconsulting.ru/cases/bespalovavto-ai" class="aoz-link" target="_blank" rel="noopener noreferrer">zharikovconsulting.ru/cases/bespalovavto-ai</a>). Сценарий <strong>«форма не заполнена до конца — AI дожимает в мессенджере»</strong> — один из самых конверсионных для автобизнеса и любых длинных форм.</p><h3 id="statusy-i-zadachi" class="aoz-h3">Статусы, теги и задачи для отдела продаж</h3><p>После квалификации агент может:</p>
<ul class="aoz-ul"><li>создать сделку на этапе «Новый квалифицированный»;</li><li>поставить задачу с дедлайном для hot-лида;</li><li>проставить теги по продукту и гео;</li><li>запустить цепочку прогрева для warm (осторожно с рассылками — отдельное согласие).</li></ul>
<p class="aoz-lead"><strong>AI лидогенерация</strong> в узком смысле страницы — не «лить трафик», а <strong>не терять</strong> уже купленный трафик с сайта и рекламы.</p>
    </div>
  </div>
</section>

<section class="aoz-section aoz-section-alt" id="dlya-kogo">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>Для кого подходит: услуги, школы, клиники</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<p class="aoz-lead"><strong>Ai обработка заявок для малого бизнеса</strong> и среднего сегмента — наш основной фокус. Ниже — типовые ветки без «универсального скрипта на всех».</p>
<p><strong>Услуги и B2B с входящими с сайта:</strong> квалификация по бюджету и сроку, запись на замер/консультацию. Кейс застройщика загородных домов (LLMCase): ответ ~10 секунд, ~50 микро-скриптов, в amoCRM уходят бюджет, площадь, район; заявленная конверсия в сделки <strong>+18%</strong> — цифра из публикации кейса, не независимый аудит (<a href="https://llmcase.ru/cases/country-house-builder-ai-crm" class="aoz-link" target="_blank" rel="noopener noreferrer">llmcase.ru</a>).</p>
<p><strong>Онлайн-школы:</strong> ночные заявки на курс, уточнение формата обучения, отсев нецелевых до звонка куратора. Важен юридически корректный сбор ПДн (см. FAQ).</p>
<p><strong>Клиники:</strong> запись на приём, филиал, первичный скрининг <strong>без</strong> постановки диагноза в чате; медицинская срочность — только эскалация человеку. Кейс медоборудования (Strela Digital): отдельная форма для ПДн, очередь PostgreSQL → Bitrix24 — образец архитектуры, когда нельзя «вытащить телефон из чата» (<a href="https://workspace.ru/cases/ai-sales-assistant-for-medical-equipment-crm-integration/" class="aoz-link" target="_blank" rel="noopener noreferrer">workspace.ru</a>).</p>
<p class="aoz-lead"><strong>Ai бот для сайта</strong> в этих нишах — не игрушка, а способ <strong>выровнять SLA</strong> между рекламой (работает 24/7) и первой линией (исторически 10:00–19:00).</p>
    </div>
  </div>
</section>

<section class="aoz-section" id="cena">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>Сколько стоит AI обработка заявок: из чего складывается цена</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<p>Вопрос <strong>«ai обработка заявок цена»</strong> логичен на этапе сравнения подрядчиков. Ориентир из коммерческого ТЗ Nero Network для типового внедрения сайт + CRM + SLA 5–15 сек:</p>
<ul class="aoz-ul"><li><strong>Старт проекта:</strong> ориентир <strong>120–350 тыс. ₽</strong> (зависит от числа каналов, глубины RAG, кастомных интеграций).</li><li><strong>Поддержка:</strong> мониторинг диалогов, доработка сценариев, обновление базы знаний.</li><li><strong>Переменные:</strong> API LLM (OpenAI / YandexGPT), WhatsApp Business API где применимо.</li></ul>
<p>Конкуренты в выдаче иногда якорят <strong>от 490 тыс. ₽</strong> на широкое «внедрение ИИ» — у нас узкий продукт <strong>первичной обработки заявок с сайта</strong>, без раздувания scope ERP или email-конвейера.</p><h3 id="start-i-podderzhka" class="aoz-h3">Старт, поддержка и доработки сценариев</h3><p><strong>Разработка ai обработка заявок</strong> в модели Nero Network включает MVP на сайте, интеграцию с одной CRM и пилот. <strong>Интеграция ai обработка заявок</strong> с телефонией (Телфин, Mango, UIS) — коллбек после квалификации в чате — часто второй этап.</p>
<p>Сравнение с <strong>стоимостью одной потерянной сделки</strong> обычно сильнее, чем спор «дорого/дёшево»: если ночной лид с чеком 50–150 тыс. ₽ уходит из-за 10-минутной задержки (<a href="https://www.telphin.ru/about-company/news/issledovanie-telphin-i-okocrm" class="aoz-link" target="_blank" rel="noopener noreferrer">Телфин/OkoCRM, 2025</a>), годовая поддержка агента окупается одним сохранённым контрактом — при условии, что продукт и оффер в порядке; это не гарантия, а аргумент для расчёта.</p>
    </div>
  </div>
</section>

<section class="aoz-section aoz-section-alt" id="keisy">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>Кейсы и примеры внедрения AI обработки заявок</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<p>Блок <strong>«ai обработка заявок кейсы»</strong> и <strong>«примеры внедрения ai»</strong> — с публичными источниками, без выдуманных названий.</p>
<p><strong>Россия:</strong></p>
<ol class="aoz-ol"><li><strong>Беспалов Авто</strong> — сайт + Bitrix24 + Telegram, дожим неполных лидов (<a href="https://zharikovconsulting.ru/cases/bespalovavto-ai" class="aoz-link" target="_blank" rel="noopener noreferrer">Жариков Консалтинг</a>).</li><li><strong>Застройщик загородных домов</strong> — мультиканал, amoCRM, ~10 с ответа (<a href="https://llmcase.ru/cases/country-house-builder-ai-crm" class="aoz-link" target="_blank" rel="noopener noreferrer">LLMCase</a>).</li><li><strong>Медоборудование</strong> — ассистент на сайте, форма ПДн, очередь в Bitrix24 (<a href="https://workspace.ru/cases/ai-sales-assistant-for-medical-equipment-crm-integration/" class="aoz-link" target="_blank" rel="noopener noreferrer">Strela Digital / Workspace.ru</a>).</li><li><strong>AI-диспетчер входящих</strong> — сайт, мессенджеры, квалификация (<a href="https://rocai.ru/cases/ai-incoming-request-dispatcher" class="aoz-link" target="_blank" rel="noopener noreferrer">ROC AI</a>).</li><li><strong>ИИ-менеджер</strong> — Tilda, мессенджеры, amoCRM, ~15 с (<a href="https://neuron-group.ru/cases/ii-menedzher/" class="aoz-link" target="_blank" rel="noopener noreferrer">Neuron Group</a>); заявленные +210% обработанных заявок — помечать как <strong>заявление интегратора</strong>, проверять на пилоте.</li></ol>
<p><strong>Международные паттерны</strong> (адаптация для РФ): TinyMCE/Spara — квалификация на high-intent страницах; Iron Mountain/Conversica — re-engage и B2B-цикл (<a href="https://www.conversica.com/customers/iron-mountain" class="aoz-link" target="_blank" rel="noopener noreferrer">conversica.com</a>).</p><h3 id="kpi" class="aoz-h3">KPI: время первого ответа, доля квалифицированных лидов</h3><p>Что измерять после запуска:</p>
<ul class="aoz-ul"><li><strong>p90</strong> времени первого содержательного ответа (рабочие / нерабочие часы отдельно).</li><li>Доля лидов со скорингом hot+warm.</li><li>Доля эскалаций на человека.</li><li>Конверсия «новый лид → контакт состоялся» в CRM.</li></ul>
<p>Классика HBR (2011): среди компаний, ответивших на тестовые заявки, среднее время ответа порядка <strong>42 часов</strong> за 30 дней — референс, почему «мы перезвоним завтра» не работает (<a href="https://hbr.org/2011/03/the-short-life-of-online-sales-leads" class="aoz-link" target="_blank" rel="noopener noreferrer">The Short Life of Online Sales Leads</a> — через цитирование в отраслевых обзорах).</p>
<p>Цитата для доверия к аналитике: «Важно видеть не только конверсию в CRM, но и формат взаимодействия с клиентом, который привёл к продаже» — <strong>Александр Завьялов</strong>, OkoCRM (исследование с Телфин, 2025).</p>
    </div>
  </div>
</section>

<section class="aoz-section" id="faq">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>FAQ по AI менеджеру заявок и нейросети для лидов</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<h3 id="faq-pdn" class="aoz-h3">Безопасность и персональные данные</h3><p><strong>152-ФЗ:</strong> при сборе имени, телефона, email нужны политика ПДн и правовые основания. С <strong>01.09.2025</strong> (изменения в законодательстве о согласии) согласие на обработку ПДн оформляют <strong>отдельным действием</strong>, не одной кнопкой «принять всё» (<a href="https://belinfonalog.ru/company/news/aktualnoe/soglasie-na-obrabotku-personalnykh-dannykh-izmeneniya-s-1-sentyabrya-2025-goda/" class="aoz-link" target="_blank" rel="noopener noreferrer">разъяснения</a>). Для чат-ботов на сайте — отдельный чекбокс или шаг до передачи контакта в CRM.</p>
<p>При API зарубежных LLM оценивают трансграничную передачу; для части клиентов выбирают <strong>YandexGPT</strong> и хранение логов в РФ.</p><h3 id="faq-bez-crm" class="aoz-h3">Можно ли без CRM</h3><p>Технически агент может слать лиды в Telegram-чат отдела продаж или на почту. Для <strong>ai обработка заявок для бизнеса</strong> с рекламным бюджетом CRM почти всегда окупается: без карточки теряются скоринг, этапы и аналитика. Минимум — простая CRM или учёт в amoCRM/Битрикс24.</p><h3 id="faq-email-vs-sayt" class="aoz-h3">Чем страница отличается от автоматизации email в CRM</h3><div class="aoz-table-wrap"><table class="aoz-table">
<thead><tr><th></th><th>Заявка с сайта (эта страница)</th><th>Email в CRM</th></tr></thead><tbody>
<tr><td>Триггер</td><td>Форма, чат, мессенджер</td><td>Входящее письмо</td></tr>
<tr><td>Типичная задержка без AI</td><td>Ночь до понедельника</td><td>Часы–дни</td></tr>
<tr><td>Продукт Nero Network</td><td>Виджет, webhook форм, мессенджеры</td><td>Отдельная услуга email</td></tr>
</tbody></table></div>
<p>Страница <code>vnedrenie-ai-amocrm</code> — про <strong>экосистему amoCRM</strong>; здесь CRM — транспорт, герой — <strong>потеря лида на сайте</strong>.</p><h3 id="faq-menedzhery" class="aoz-h3">«У нас уже есть менеджеры»</h3><p>AI не заменяет закрытие сделки. Он снимает <strong>первичку в 02:00</strong> и собирает поля, чтобы дневной звонок был тёплым.</p><h3 id="faq-chelovek" class="aoz-h3">«Клиенты хотят живого человека»</h3><p>Сценарий: мгновенное «подключаю специалиста» + AI до звонка собирает контекст. Клиент не ждёт в пустоте.</p><h3 id="faq-chatbot" class="aoz-h3">«Чат-бот нас подводил»</h3><p>Отличия: RAG по вашим документам, guardrails, логи, human_review спорных диалогов, эскалация по негативу.</p><h3 id="faq-amoi" class="aoz-h3">«Хватит встроенного amoAI»</h3><div class="aoz-table-wrap"><table class="aoz-table">
<thead><tr><th>Ситуация</th><th>amoAI</th><th>Кастом Nero Network</th></tr></thead><tbody>
<tr><td>Чаты amoCRM, типовая квалификация</td><td>Часто достаточно</td><td>—</td></tr>
<tr><td>Tilda/WP форма без чата</td><td>Не покрывает</td><td>Webhook + агент</td></tr>
<tr><td>Сложный каталог, RAG</td><td>Ограничено</td><td>Кастомная база</td></tr>
<tr><td>retailCRM, очередь доставки</td><td>Зависит от тарифа</td><td>Проектная интеграция</td></tr>
<tr><td>Аудит потерь заявок как услуга</td><td>Нет</td><td>Да</td></tr>
</tbody></table></div>
<p>Документация: <a href="https://www.amocrm.ru/support/amoai/ai_agent" class="aoz-link" target="_blank" rel="noopener noreferrer">amoAI AI-агент</a>.</p><h3 id="faq-sroki" class="aoz-h3">Сроки внедрения</h3><p>MVP на сайте + одна CRM: ориентир <strong>7–14 дней</strong> на рынке; пилот и мессенджеры — +2–3 недели. Точный план — после аудита каналов.</p>
    </div>
  </div>
</section>

<section class="aoz-section aoz-section-alt" id="proverit-poteri">
  <div class="aoz-cnt">
    <header class="aoz-sh nero-ai-reveal">
      <h2>Проверить, сколько заявок вы теряете</h2>
    </header>
    <div class="aoz-prose nero-ai-reveal nero-ai-delay-1">
<p class="aoz-lead"><strong>CTA страницы:</strong> «Проверить, сколько заявок вы теряете».</p>
<p>Лид-магнит: <strong>бесплатный аудит потерь заявок за 30 минут</strong> — карта каналов, оценка p90 ответа, гипотеза, где встраивается <strong>ai агент для сайта</strong> и <strong>интеграция ai обработка заявок</strong> с вашей CRM.</p>
<p class="aoz-lead"><strong>Внедрение ai в бизнес процессы</strong> первой линии продаж — один из самых коротких путей к измеримому эффекту: скорость ответа, полнота карточки лида, меньше «пустых» звонков. <strong>Внедрение нейросетей в бизнес</strong> здесь предметно: не «нейросеть ради нейросети», а агентный слой между рекламой и CRM.</p>
<p>Nero Network проектирует <strong>ai консультант на сайт</strong> и связку форм + мессенджеров под ваш скрипт продаж, с юридически аккуратным сбором ПДн и честным сравнением с amoAI.</p>
<p class="aoz-lead"><strong>Следующий шаг:</strong> оставьте заявку на аудит или пройдите квиз на странице — мы посчитаем, сколько обращений уходит в тишину из-за задержки первого ответа, и предложим план <strong>настройки ai обработка заявок</strong> под ваш стек (Tilda, WordPress, amoCRM, Битрикс24, retailCRM).</p>
    </div>
<div class="ym-cta-block ym-cta-block--dual ym-cta-block--footer-final nero-ai-reveal" id="cta-proverit-poteri">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Проверить, сколько заявок вы теряете</p>
    <p class="ym-cta-block__sub">Пройдите квиз на странице или напишите нам — за 30 минут разберём каналы, задержку первого ответа и стек (Tilda, WordPress, amoCRM, Битрикс24). Ориентир внедрения: 120–350 тыс. ₽ старт + поддержка.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary">Сначала FAQ</a>
    </div>
  </div>
</div>
  </div>
</section>
</div>

  <!-- INTERNAL-LINKS:INSERT -->
  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.ai-obrabotka-zayavok-s-sayta-page');
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
