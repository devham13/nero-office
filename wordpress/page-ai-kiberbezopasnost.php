<?php
/**
 * Template Name: AI для кибербезопасности: внедрение и настройка под ключ
 * Description: SEO-лендинг — внедрение AI для кибербезопасности и SOC. Triage, SIEM/SOAR, кейсы, цены.
 */

$page_seo_title       = 'AI для кибербезопасности: внедрение и настройка под ключ';
$page_seo_description = 'Внедряем AI для кибербезопасности и SOC: ускоряем расследование инцидентов, собираем контекст, генерируем гипотезы и отчёты. Интеграция с SIEM/SOAR. Аудит сценариев ИБ.';

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
    ['label' => 'Зачем AI',      'href' => '#chto-takoe'],
    ['label' => 'Внедрение',     'href' => '#kak-rabotaet'],
    ['label' => 'Интеграции',    'href' => '#integracii'],
    ['label' => 'Кейсы',         'href' => '#keisy'],
    ['label' => 'Стоимость',     'href' => '#ceny'],
    ['label' => 'FAQ',           'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Обсудить AI Security';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '';

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

.aib-hero-soc {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.aib-content{
  --aib-bg:#050711;--aib-bg2:#080b17;--aib-bg3:#0a0e1c;
  --aib-surface:rgba(255,255,255,.072);--aib-surface2:rgba(255,255,255,.108);
  --aib-text:#e6edf7;--aib-muted:#9aa8bd;--aib-soft:#c7d2e5;--aib-heading:#fff;
  --aib-border:rgba(255,255,255,.10);--aib-border-s:rgba(255,255,255,.18);
  --aib-accent:#79f2ff;--aib-violet:#8b5cf6;--aib-green:#22c55e;--aib-amber:#f59e0b;
  --aib-btn-from:#2563eb;--aib-btn-to:#7c3aed;
  --aib-shadow:0 24px 72px rgba(0,0,0,.4);
  --aib-r:18px;--aib-r-lg:24px;--aib-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aib-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aib-content *,.aib-content *::before,.aib-content *::after{box-sizing:border-box;}
.aib-content a{color:inherit;text-decoration:none;}
.aib-content p{color:var(--aib-muted);line-height:1.72;margin:0 0 1em;}
.aib-content p:last-child{margin-bottom:0;}
.aib-content h2,.aib-content h3,.aib-content h4{color:var(--aib-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aib-content strong{color:var(--aib-soft);}
.aib-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aib-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aib-muted);font-size:14.5px;line-height:1.65;}
.aib-content ul li::before{content:'›';position:absolute;left:0;color:var(--aib-accent);font-weight:700;}
.aib-cnt{width:min(var(--aib-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aib-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aib-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aib-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aib-sh.aib-left{margin-left:0;text-align:left;}
.aib-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aib-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aib-sh.aib-left p{margin-left:0;}
.aib-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aib-accent);margin-bottom:14px;}
.aib-gt{background:linear-gradient(92deg,#fff 0%,var(--aib-accent) 44%,var(--aib-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.aib-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aib-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aib-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.aib-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aib-accent),var(--aib-violet));}
.aib-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--aib-muted);margin-bottom:1em;}
.aib-intro-text p:last-child{margin-bottom:0;color:var(--aib-soft);}
.aib-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aib-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.aib-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aib-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.aib-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aib-muted);line-height:1.4;}
.aib-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.aib-intro-grid{grid-template-columns:1fr;gap:36px;}.aib-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.aib-intro-kpi{grid-template-columns:1fr 1fr;}}
.aib-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aib-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aib-toc a{display:inline-block;padding:9px 18px;background:var(--aib-surface);border:1px solid var(--aib-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aib-muted);transition:border-color .2s,color .2s,background .2s;}
.aib-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--aib-accent);background:rgba(121,242,255,.08);}
.aib-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aib-border);border-radius:var(--aib-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.aib-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.aib-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aib-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.aib-grid-2,.aib-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.aib-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aib-grid-3{grid-template-columns:1fr;}}
.aib-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--aib-r);padding:26px;margin-bottom:14px;transition:border-color .2s;}
.aib-scenario:last-child{margin-bottom:0;}
.aib-scenario:hover{border-color:rgba(121,242,255,.3);}
.aib-scenario h3{font-size:17px;margin-bottom:8px;}
.aib-scenario p{font-size:14.5px;margin:0 0 .6em;}
.aib-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aib-table{width:100%;border-collapse:collapse;font-size:14px;}
.aib-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--aib-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.aib-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aib-text);vertical-align:top;}
.aib-table tr:last-child td{border-bottom:none;}
.aib-table tr:hover td{background:rgba(255,255,255,.03);}
.aib-timeline{position:relative;padding-left:40px;}
.aib-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aib-accent),var(--aib-violet));opacity:.35;border-radius:2px;}
.aib-tl-item{position:relative;margin-bottom:32px;}
.aib-tl-item:last-child{margin-bottom:0;}
.aib-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aib-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.aib-tl-item h3{font-size:17px;margin-bottom:8px;}
.aib-tl-item p{font-size:14.5px;margin:0;}
.aib-code{background:rgba(0,0,0,.35);border:1px solid rgba(121,242,255,.2);border-radius:12px;padding:16px 20px;font-family:ui-monospace,monospace;font-size:13px;color:var(--aib-accent);margin:20px 0;overflow-x:auto;}
.aib-guard-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
@media(max-width:768px){.aib-guard-grid{grid-template-columns:1fr;}}
.aib-guard-card{background:rgba(245,158,11,.06);border:1px solid rgba(245,158,11,.2);border-radius:14px;padding:20px;}
.aib-guard-card h4{font-size:15px;color:var(--aib-amber);margin-bottom:8px;}
.aib-checklist{display:flex;flex-wrap:wrap;gap:9px;margin:20px 0 0;padding:0;list-style:none;}
.aib-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--aib-muted);}
.aib-checklist li::before{content:'✓';color:var(--aib-green);font-weight:800;}
.aib-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aib-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.aib-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aib-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.aib-faq-q::after{content:'▾';font-size:13px;color:var(--aib-accent);flex-shrink:0;transition:transform .25s;}
.aib-faq-item.open .aib-faq-q::after{transform:rotate(180deg);}
.aib-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--aib-muted);line-height:1.72;}
.aib-faq-item.open .aib-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--aib-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aib-btn-from),var(--aib-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--aib-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--aib-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>
<main id="primary" class="site-main nero-ai-home-page ai-kiberbezopasnost-page" role="main" tabindex="-1">

<style>
.aib-hero-soc {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}
/* === AIB HERO SOC — page-scoped, самодостаточный блок === */
.aib-hero-soc .aib-dash-canvas-wrap {
  position: relative;
  width: 100%;
  height: 220px;
  margin: 14px 0 12px;
  border-radius: 12px;
  overflow: hidden;
  background: linear-gradient(180deg, rgba(5,10,22,.85) 0%, rgba(8,14,28,.95) 100%);
  border: 1px solid rgba(121,242,255,.14);
}
.aib-hero-soc #aib-soc-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aib-hero-soc .nero-ai-status--cyan { color: #79f2ff; }
.aib-hero-soc .nero-ai-status--violet { color: #a78bfa; }
.aib-hero-soc .nero-ai-status--amber { color: #fbbf24; }
.aib-hero-soc .nero-ai-status--green { color: #22c55e; }
@media (max-width: 900px) {
  .aib-hero-soc .aib-dash-canvas-wrap { height: 180px; }
}
</style>
<section class="nero-ai-hero aib-hero-soc" id="hero" aria-labelledby="aib-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow">ИБ / SOC · внедрение под ключ</p>
      <h1 id="aib-hero-title">AI для кибербезопасности: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">Ускоряем расследование инцидентов в SOC: AI собирает контекст, формирует гипотезы и отчёты — меньше ручной рутины для аналитиков</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности AI Security">
        <li class="nero-ai-badge">Triage алертов</li>
        <li class="nero-ai-badge">Enrichment</li>
        <li class="nero-ai-badge">SIEM/SOAR</li>
        <li class="nero-ai-badge">Human-in-the-loop</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-расследование в SOC">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">SOC · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI Investigation Hub</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Алертов сегодня</span><strong>312</strong><small>SIEM + EDR</small></div>
            <div class="nero-ai-metric"><span>MTTR</span><strong>−32%</strong><small>vs baseline</small></div>
            <div class="nero-ai-metric"><span>Auto-triage</span><strong>47%</strong><small>без L2</small></div>
            <div class="nero-ai-metric"><span>В очереди L2</span><strong>8</strong><small>эскалаций</small></div>
          </div>

          <div class="aib-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aib-soc-hero-canvas" role="img" aria-label="Анимация: алерт SIEM проходит triage, enrichment и превращается в пакет расследования для аналитика"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий SOC">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>SIEM: lateral movement</strong><span>MaxPatrol · severity high</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">triage</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>AI summary готов</strong><span>enrichment: 14 источников</span></div>
              <span class="nero-ai-status nero-ai-status--violet">enrichment</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⛓</span>
              <div><strong>Kill chain hypothesis</strong><span>T1078 · T1021 · confidence 0.91</span></div>
              <span class="nero-ai-status nero-ai-status--amber">review</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📋</span>
              <div><strong>Отчёт CISO — черновик</strong><span>human-in-the-loop · L2 approve</span></div>
              <span class="nero-ai-status nero-ai-status--green">готово</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="aib-content">

  <section class="aib-intro nero-ai-section" id="chto-takoe" aria-label="Введение">
    <div class="aib-cnt">
      <div class="aib-intro-grid nero-ai-reveal">
        <div class="aib-intro-text">
          <p class="aib-eyebrow">Лонгрид · ai кибербезопасность</p>
          <p><strong>Коротко:</strong> AI для кибербезопасности — это не замена SOC, а ускоритель расследований: нейросети и AI-агенты берут на себя triage алертов, сбор контекста, гипотезы атаки и черновики отчётов, пока аналитик принимает финальные решения. Nero Network внедряет такой AI-слой поверх вашего SIEM — под ключ, с учётом 152-ФЗ и российского контура.</p>
          <p>Типичная боль 2026 года: SIEM генерирует сотни алертов в сутки, до 40% из них не разбираются из-за alert fatigue. Аналитик вручную собирает контекст из логов, CMDB, threat intel — на один инцидент уходят часы. AI-ассистент готовит пакет для аналитика за секунды вместо часов ручного копания.</p>
        </div>
        <div class="aib-intro-kpi" aria-label="Ключевые метрики SOC">
          <div class="aib-kpi-card"><div class="kv">40%</div><div class="kl">алертов не разбираются</div><div class="ks">alert fatigue</div></div>
          <div class="aib-kpi-card"><div class="kv">48 мин</div><div class="kl">до lateral movement</div><div class="ks">CrowdStrike 2025</div></div>
          <div class="aib-kpi-card"><div class="kv">−32%</div><div class="kl">MTTR после внедрения</div><div class="ks">ориентир кейсов</div></div>
          <div class="aib-kpi-card"><div class="kv">L1–L4</div><div class="kl">уровни автономии AI</div><div class="ks">human-in-the-loop</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aib-toc-outer">
    <div class="aib-cnt">
      <nav class="aib-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Зачем AI</a>
        <a href="#zadachi">Задачи</a>
        <a href="#kak-rabotaet">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ai-agenty-soc">AI-агенты</a>
        <a href="#riski">Риски</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Консультация</a>
      </nav>
    </div>
  </div>

  <section class="aib-section" aria-labelledby="chto-takoe-h2">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">Определение</span>
        <h2 id="chto-takoe-h2">Что такое AI для кибербезопасности и зачем он нужен бизнесу</h2>
        <p><strong>AI для кибербезопасности</strong> (AI Security, AI SOC) — класс решений, где LLM и AI-агенты встраиваются в цикл SOC: от triage алертов до отчётов для CISO.</p>
      </div>

      <div class="aib-table-wrap nero-ai-reveal">
        <table class="aib-table">
          <thead><tr><th>Термин</th><th>Фокус</th></tr></thead>
          <tbody>
            <tr><td><strong>AI для SOC</strong></td><td>Ускорение расследований, triage, enrichment, отчёты</td></tr>
            <tr><td><strong>AI Security</strong></td><td>Защита с помощью AI + защита самих AI-систем</td></tr>
            <tr><td><strong>MLSecOps</strong></td><td>Безопасность ML-моделей, защита пайплайнов обучения</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aib-grid-3 nero-ai-reveal" style="margin-top:28px;">
        <div class="aib-card">
          <h3>От перегруженных аналитиков к AI-assisted SOC</h3>
          <p>SIEM генерирует сотни алертов в сутки. Злоумышленник перемещается по сети за минуты — аналитик собирает контекст часами. AI готовит сводку, severity, гипотезы kill chain за секунды.</p>
        </div>
        <div class="aib-card nero-ai-delay-1">
          <h3>AI-агенты vs правила и сигнатуры</h3>
          <p>Классический SIEM быстр, но плохо объясняет «почему». AI-агенты интерпретируют логи, коррелируют события, предлагают playbooks и ведут многошаговое расследование с tool-calling.</p>
        </div>
        <div class="aib-card nero-ai-delay-2">
          <h3>Кому подходит: CISO, SOC, IT-директор</h3>
          <p>Если есть SOC, инцидентов больше аналитиков, MTTR измеряется в часах и организация работает под 152-ФЗ или 187-ФЗ — AI кибербезопасность для бизнеса актуален.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aib-section aib-section-alt" id="zadachi">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">Задачи AI</span>
        <h2>Какие задачи решает внедрение AI в информационную безопасность</h2>
        <p>Внедрение AI в ИБ закрывает пять блоков — triage, расследование, отчётность, детекции и разгрузку junior-аналитиков.</p>
      </div>

      <div class="aib-grid-3">
        <div class="aib-card nero-ai-reveal">
          <h3>Triage и классификация алертов</h3>
          <p>AI triage сортирует поток: true positive / false positive / эскалация. Google TIN сокращает ручной анализ с ~30 минут до ~60 секунд с verdict и audit log.</p>
        </div>
        <div class="aib-card nero-ai-reveal nero-ai-delay-1">
          <h3>Расследование и сбор контекста</h3>
          <p>Enrichment: логи, CMDB, TI-lookup, корреляция в гипотезу kill chain. В кейсе ИТБ заявлено сокращение времени реагирования на 70%.</p>
        </div>
        <div class="aib-card nero-ai-reveal nero-ai-delay-2">
          <h3>Гипотезы и отчёты для CISO</h3>
          <p>AI генерирует executive summary, хронологию, рекомендации. Microsoft Security Copilot показал <strong>−30,13% MTTR</strong> через 3 месяца после внедрения.</p>
        </div>
      </div>
    </div>
  </section>

<section id="ai-kiberbezopasnost-boris-block" class="aib-root" aria-label="Анимация: enrichment алерта SIEM, корреляция kill chain и пакет для L2-аналитика">
<style>
/* === БОРИС: prefix aib-, scoped внутри #ai-kiberbezopasnost-boris-block === */
#ai-kiberbezopasnost-boris-block.aib-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-kiberbezopasnost-boris-block .aib-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-kiberbezopasnost-boris-block .aib-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-kiberbezopasnost-boris-block .aib-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-kiberbezopasnost-boris-block .aib-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-kiberbezopasnost-boris-block .aib-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-kiberbezopasnost-boris-block .aib-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0891b2;
  margin:0 0 14px;
}
#ai-kiberbezopasnost-boris-block .aib-ey::before{
  content:'';
  width:18px;height:2px;
  background:linear-gradient(90deg,#79f2ff,#8b5cf6);
  border-radius:1px;
}
#ai-kiberbezopasnost-boris-block .aib-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-kiberbezopasnost-boris-block .aib-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-kiberbezopasnost-boris-block .aib-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-kiberbezopasnost-boris-block .aib-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(121,242,255,.15);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
}
#ai-kiberbezopasnost-boris-block .aib-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-kiberbezopasnost-boris-block .aib-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-kiberbezopasnost-boris-block .aib-pl-c{
  background:rgba(121,242,255,.12);
  color:#0e7490;
  border:1.5px solid rgba(121,242,255,.35);
}
#ai-kiberbezopasnost-boris-block .aib-pl-v{
  background:rgba(139,92,246,.08);
  color:#6d28d9;
  border:1.5px solid rgba(139,92,246,.25);
}
#ai-kiberbezopasnost-boris-block .aib-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-kiberbezopasnost-boris-block .aib-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-kiberbezopasnost-boris-block .aib-rgt{
  position:relative;
  background:linear-gradient(135deg,#f0f9ff 0%,#ede9fe 32%,#f8fafc 68%,#fff 100%);
  min-height:440px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-kiberbezopasnost-boris-block .aib-rgt{min-height:380px;}
}
#aib-soc-pipeline-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="aib-cnt">
  <div class="aib-card">

    <div class="aib-lft">
      <span class="aib-ey">SOC · enrichment</span>
      <h3 class="aib-h3">Алерт из SIEM — AI собирает контекст, строит kill chain и готовит пакет для L2</h3>
      <ul class="aib-ul">
        <li><span class="aib-ic">1</span>SIEM/EDR шлёт алерт — AI triage: TP / FP / эскалация</li>
        <li><span class="aib-ic">2</span>Enrichment: логи, CMDB, threat intel, прошлые инциденты</li>
        <li><span class="aib-ic">3</span>Корреляция в гипотезу kill chain и recommended steps</li>
        <li><span class="aib-ic">✓</span>L2 подтверждает — human-in-the-loop, audit log рассуждений</li>
      </ul>
      <div class="aib-pills">
        <span class="aib-pl aib-pl-c">30 мин → ~60 сек</span>
        <span class="aib-pl aib-pl-v">Enrichment + RAG</span>
        <span class="aib-pl aib-pl-g">Audit trail</span>
      </div>
      <p class="aib-foot">Дальше разберём этапы внедрения AI для кибербезопасности под ключ →</p>
    </div>

    <div class="aib-rgt">
      <canvas
        id="aib-soc-pipeline-canvas"
        aria-label="Анимация: алерты SIEM проходят AI enrichment, формируют kill chain и пакет расследования для аналитика"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('aib-soc-pipeline-canvas');
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
    cyan:'#79f2ff',
    cyanDark:'#0891b2',
    violet:'#8b5cf6',
    violetGlow:'rgba(139,92,246,.22)',
    amber:'#f59e0b',
    green:'#22c55e',
    red:'#ef4444',
    panel:'#0f172a',
    panelBdr:'#334155',
    card:'#ffffff',
    cardBdr:'#cbd5e1',
    line:'rgba(121,242,255,.35)',
    kill:'rgba(139,92,246,.15)'
  };

  var KILL = [
    {label:'Initial access', short:'Entry'},
    {label:'Execution', short:'Exec'},
    {label:'C2', short:'C2'},
    {label:'Exfil', short:'Data'}
  ];

  var alerts = [];
  var enrichFields = [];
  var killProgress = 0;
  var analystAlpha = 0;
  var LOOP = 520;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawAlertIcon(x,y,s,severity,alpha){
    ctx.globalAlpha = alpha || 1;
    var clr = severity === 'high' ? C.red : (severity === 'med' ? C.amber : C.cyan);
    rr(x,y,s,s*0.72,6,C.card,C.cardBdr,1.5);
    rr(x+4,y+4,s-8,10,3,clr,null,0);
    ctx.fillStyle = C.ink;
    ctx.font = 'bold 8px Inter,system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('ALERT', x+s/2, y+14);
    ctx.fillStyle = clr;
    ctx.font = 'bold 9px Inter,sans-serif';
    ctx.fillText(severity === 'high' ? 'HIGH' : (severity === 'med' ? 'MED' : 'INFO'), x+s/2, y+s*0.58);
    ctx.globalAlpha = 1;
  }

  function drawSiemPanel(x,y,w,h,pulse){
    rr(x,y,w,h,10,C.panel,C.panelBdr,2);
    rr(x,y,w,26,10,C.cyanDark,'#0e7490',0);
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('SIEM · алерты', x+10, y+17);
    ctx.fillStyle = C.cyan;
    ctx.font = '9px Inter,sans-serif';
    ctx.textAlign = 'right';
    ctx.fillText('312 сегодня', x+w-10, y+17);

    var rows = ['Brute force · srv-db-04','Suspicious PS · host-17','New C2 beacon · net-edge'];
    rows.forEach(function(txt,i){
      var ry = y + 34 + i * 34;
      var lit = (frame % LOOP) > 80 + i * 45 && (frame % LOOP) < 280;
      rr(x+8,ry,w-16,28,5,lit?'rgba(121,242,255,.12)':'rgba(255,255,255,.04)',lit?C.cyan:'rgba(255,255,255,.08)',1);
      ctx.fillStyle = lit ? '#e2e8f0' : 'rgba(226,232,240,.55)';
      ctx.font = (lit?'bold ':'') + '9px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(txt, x+14, ry+18);
    });

    ctx.strokeStyle = C.cyan;
    ctx.globalAlpha = 0.25 + pulse * 0.35;
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(x+w-14, y+h-14, 8+pulse*4, 0, Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;
  }

  function drawAiHub(cx,cy,r,pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2.2);
    g.addColorStop(0, C.violetGlow);
    g.addColorStop(1, 'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx,cy,r*2,0,Math.PI*2);
    ctx.fill();

    rr(cx-r,cy-r,r*2,r*2,r*0.35,'#f5f3ff',C.violet,2);
    ctx.fillStyle = C.violet;
    ctx.font = 'bold ' + Math.max(12,r*0.28) + 'px Inter,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('AI', cx, cy-4);
    ctx.fillStyle = C.muted;
    ctx.font = Math.max(9,r*0.16) + 'px Inter,sans-serif';
    ctx.fillText('enrichment', cx, cy+r*0.35);

    for(var i=0;i<4;i++){
      var ang = (i/4)*Math.PI*2 + frame*0.05;
      ctx.beginPath();
      ctx.arc(cx+Math.cos(ang)*(r+14), cy+Math.sin(ang)*(r+10), 3, 0, Math.PI*2);
      ctx.fillStyle = C.cyan;
      ctx.fill();
    }
  }

  function drawKillChain(x,y,w,h,prog){
    rr(x,y,w,h,8,'rgba(255,255,255,.9)',C.kill,1);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Kill chain · гипотеза', x+10, y+14);

    var stepW = (w - 24) / KILL.length;
    KILL.forEach(function(k,i){
      var sx = x + 12 + i * stepW;
      var sy = y + 22;
      var active = prog > i / KILL.length;
      var pulse = active && prog < (i+1.2)/KILL.length;
      rr(sx,sy,stepW-8,36,6,active?'rgba(139,92,246,.12)':'rgba(148,163,184,.08)',active?C.violet:C.cardBdr,1.5);
      ctx.fillStyle = active ? C.violet : C.muted;
      ctx.font = 'bold 8px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(k.short, sx+(stepW-8)/2, sy+22);
      if(pulse){
        ctx.strokeStyle = C.violet;
        ctx.lineWidth = 2;
        ctx.globalAlpha = 0.4;
        rr(sx-2,sy-2,stepW-4,40,8,null,C.violet,2);
        ctx.globalAlpha = 1;
      }
      if(i < KILL.length-1){
        ctx.strokeStyle = active ? C.violet : C.cardBdr;
        ctx.lineWidth = 1.5;
        ctx.beginPath();
        ctx.moveTo(sx+stepW-6,sy+18);
        ctx.lineTo(sx+stepW+2,sy+18);
        ctx.stroke();
      }
    });
  }

  function drawAnalystPack(x,y,w,h,alpha,reportProg){
    if(alpha < 0.05) return;
    ctx.globalAlpha = alpha;
    rr(x,y,w,h,10,C.card,C.green,2);
    ctx.fillStyle = C.green;
    ctx.font = 'bold 11px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Пакет L2 · review', x+12, y+18);
    ctx.fillStyle = C.muted;
    ctx.font = '9px Inter,sans-serif';
    ctx.fillText('human-in-the-loop', x+12, y+30);

    var lines = [
      {lbl:'Summary', val:'Brute force → lateral risk', done: reportProg > 0.2},
      {lbl:'Severity', val:'HIGH · confidence 0.91', done: reportProg > 0.45},
      {lbl:'Hypothesis', val:'Credential spray → C2', done: reportProg > 0.65},
      {lbl:'Report CISO', val:'Черновик готов', done: reportProg > 0.85}
    ];
    lines.forEach(function(row,i){
      var ly = y + 38 + i * 32;
      rr(x+10,ly,w-20,26,5,row.done?'rgba(34,197,94,.08)':'#f8fafc',row.done?C.green:C.cardBdr,1);
      ctx.fillStyle = row.done ? C.ink : C.muted;
      ctx.font = '9px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(row.lbl + ': ' + row.val, x+16, ly+17);
      if(row.done){
        ctx.fillStyle = C.green;
        ctx.font = 'bold 11px sans-serif';
        ctx.textAlign = 'right';
        ctx.fillText('✓', x+w-16, ly+17);
      }
    });
    ctx.globalAlpha = 1;
  }

  function spawnAlert(){
    var sev = Math.random() > 0.6 ? 'high' : (Math.random() > 0.4 ? 'med' : 'info');
    alerts.push({
      x: -30,
      y: H * 0.22 + Math.random() * H * 0.15,
      sev: sev,
      phase: 0,
      speed: 1.1 + Math.random() * 0.5
    });
  }

  function loop(){
    frame++;
    var t = frame % LOOP;
    var pulse = 0.5 + 0.5 * Math.sin(frame * 0.06);

    if(frame % 110 === 0) spawnAlert();

    killProgress = Math.min(1, t / 320);
    analystAlpha = Math.min(1, Math.max(0, (t - 180) / 120));
    var reportProg = Math.min(1, Math.max(0, (t - 200) / 200));

    ctx.clearRect(0,0,W,H);

    var pad = 12;
    var siemW = Math.min(118, W * 0.2);
    var siemH = Math.min(150, H * 0.42);
    var siemX = pad;
    var siemY = H * 0.48 - siemH / 2;

    var hubR = Math.min(W,H) * 0.085;
    var hubX = W * 0.42;
    var hubY = H * 0.46;

    var packW = Math.min(140, W * 0.24);
    var packH = Math.min(175, H * 0.48);
    var packX = W - packW - pad;
    var packY = H * 0.5 - packH / 2;

    var killW = W * 0.55;
    var killH = 58;
    var killX = W * 0.22;
    var killY = H * 0.78 - killH;

    drawSiemPanel(siemX, siemY, siemW, siemH, pulse);
    drawAiHub(hubX, hubY, hubR, pulse);
    drawKillChain(killX, killY, killW, killH, killProgress);
    drawAnalystPack(packX, packY, packW, packH, analystAlpha, reportProg);

    /* поток: SIEM → AI → пакет */
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([5,4]);
    ctx.beginPath();
    ctx.moveTo(siemX + siemW, siemY + siemH/2);
    ctx.lineTo(hubX - hubR - 6, hubY);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(hubX + hubR + 6, hubY);
    ctx.lineTo(packX - 4, packY + packH/2);
    ctx.stroke();
    ctx.setLineDash([]);

    alerts = alerts.filter(function(a){
      a.phase += a.speed;
      if(a.phase < 140){
        a.x += a.speed * 1.3;
        a.y += Math.sin(frame * 0.07) * 0.25;
        drawAlertIcon(a.x, a.y, 40, a.sev, 1);
        return a.x < hubX - hubR;
      }
      return false;
    });

    /* enrichment chips вокруг hub */
    if(t > 60 && t < 300){
      var chips = ['CMDB','TI','Logs','RAG'];
      chips.forEach(function(ch,i){
        var ang = (i/chips.length)*Math.PI*2 - Math.PI/2 + frame*0.02;
        var cx = hubX + Math.cos(ang)*(hubR+28);
        var cy = hubY + Math.sin(ang)*(hubR+20);
        var ca = Math.min(1, (t-60-i*20)/40);
        ctx.globalAlpha = ca * 0.9;
        rr(cx-22,cy-10,44,20,10,'rgba(121,242,255,.15)',C.cyan,1);
        ctx.fillStyle = C.cyanDark;
        ctx.font = '8px Inter,sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText(ch, cx, cy+4);
        ctx.globalAlpha = 1;
      });
    }

    ctx.fillStyle = C.muted;
    ctx.font = '10px Inter,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('SIEM', pad, H - 10);
    ctx.textAlign = 'center';
    ctx.fillText('AI enrichment', hubX, H - 10);
    ctx.textAlign = 'right';
    ctx.fillText('L2 review', W - pad, H - 10);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
</section>


  <section class="aib-section" id="kak-rabotaet">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">Под ключ</span>
        <h2>Как работает внедрение AI для кибербезопасности под ключ</h2>
        <p>Nero Network строит <strong>кастомный AI-слой поверх существующего SOC-стека</strong> — типовой проект 700 тыс.–5 млн ₽, 8–16 недель.</p>
      </div>

      <div class="aib-code nero-ai-reveal">SIEM/EDR → AI Orchestrator → Context Collector + RAG → LLM-агент → Human Approval → SOAR/тикеты</div>

      <div class="aib-timeline nero-ai-reveal">
        <div class="aib-tl-item">
          <div class="aib-tl-dot"></div>
          <h3>Аудит сценариев AI для ИБ</h3>
          <p>Карта процессов SOC, baseline MTTR, compliance, матрица ROI по 5 приоритетным сценариям — дорожная карта с KPI, не абстрактная консультация.</p>
        </div>
        <div class="aib-tl-item">
          <div class="aib-tl-dot"></div>
          <h3>Проектирование playbooks и enrichment</h3>
          <p>AI Orchestrator, Context Collector, RAG Knowledge Base, Investigation Agent, Report Generator, Guardrails Layer.</p>
        </div>
        <div class="aib-tl-item">
          <div class="aib-tl-dot"></div>
          <h3>Пилот → промышленный запуск</h3>
          <p>MVP за 2–4 недели → agentic triage → отчёты и детекции → SOAR-действия. Обучение аналитиков и KPI-дашборд — обязательная часть.</p>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-audit-ib">
        <div class="ym-cta-block__icon" aria-hidden="true">🛡️</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Аудит сценариев AI для ИБ — бесплатный вход в проект</p>
          <p class="ym-cta-block__sub">За 1–2 недели составим карту процессов SOC, baseline MTTR, матрицу ROI и рисков по 5 приоритетным сценариям. Результат — дорожная карта на 8–16 недель.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aib-section aib-section-alt" id="integracii">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">SIEM / SOAR</span>
        <h2>Интеграция AI с SIEM, SOAR и стеком ИБ</h2>
        <p>Интеграция AI кибербезопасность — через API/webhook вашего SIEM; мы не привязываем к одному вендору.</p>
      </div>

      <div class="aib-grid-2 nero-ai-reveal">
        <div class="aib-card">
          <h3>SIEM: KUMA, MaxPatrol, R-Vision, Splunk, Elastic, QRadar</h3>
          <p>SOAR: R-Vision SOAR, PT NAD, Splunk SOAR, TheHive, custom n8n. EDR/XDR: Kaspersky, PT EDR, CrowdStrike, Defender.</p>
        </div>
        <div class="aib-card">
          <h3>Корреляция и обогащение</h3>
          <p>Context Collector нормализует события, обогащает через MISP, PT ESC, Kaspersky TIP, VirusTotal, CMDB. LLM с RAG формирует объяснение логов на русском.</p>
        </div>
      </div>

      <div class="aib-table-wrap nero-ai-reveal">
        <table class="aib-table">
          <thead><tr><th>Уровень</th><th>Описание</th><th>Пример</th></tr></thead>
          <tbody>
            <tr><td>L0</td><td>Только подсказки в UI</td><td>Подсветка похожих инцидентов</td></tr>
            <tr><td>L1</td><td>Черновик сводки</td><td>Summary + severity</td></tr>
            <tr><td>L2</td><td>Enrichment + гипотезы</td><td>Kill chain, recommended steps</td></tr>
            <tr><td>L3</td><td>Supervised actions</td><td>Блокировка IP после подтверждения L2</td></tr>
            <tr><td>L4</td><td>Автодействия в guardrails</td><td>Изоляция хоста по матрице рисков</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="text-align:center;margin-top:16px;font-size:14px;color:var(--aib-muted);">На старте рекомендуем L1–L2. Критичные решения — всегда за человеком.</p>
      <p class="aib-related nero-ai-reveal" style="margin-top:20px;font-size:15px">Фишинг и BEC часто приходят через почтовый шлюз — до попадания в SIEM полезно сравнить сценарий <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--aib-accent);text-decoration:underline;text-underline-offset:3px">AI-обработки входящей почты в CRM</a>: triage писем, извлечение IOC и маршрутизация подозрительных обращений в SOC без ручного копирования в тикет.</p>
      <p class="aib-related nero-ai-reveal" style="margin-top:14px;font-size:15px">Для enrichment алертов контекстом активов и заказов из учётной системы закрывает <a href="/ai-1c-erp/" style="color:var(--aib-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP</a> — тот же принцип RAG поверх CMDB и ERP, что применяется при корреляции инцидентов с критичными бизнес-процессами.</p>
    </div>
  </section>

  <section class="aib-section" id="ai-agenty-soc">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">2026</span>
        <h2>AI-агенты для SOC: расследование угроз в 2026</h2>
        <p>AI-агенты планируют многошаговое расследование и генерируют черновики правил детектирования.</p>
      </div>

      <div class="aib-table-wrap nero-ai-reveal">
        <table class="aib-table">
          <thead><tr><th>Решение</th><th>Плюсы</th><th>Ограничения</th></tr></thead>
          <tbody>
            <tr><td>Microsoft Security Copilot</td><td>−30% MTTR, интеграция Defender XDR</td><td>Vendor lock-in, облако, ограничения для КИИ в РФ</td></tr>
            <tr><td>CrowdStrike Charlotte AI</td><td>&gt;98% triage, bounded autonomy</td><td>Экосистема Falcon</td></tr>
            <tr><td>KIRA (Kaspersky KUMA)</td><td>Русский контур, GigaChat 2.0</td><td>Только экосистема KUMA</td></tr>
            <tr><td>MaxPatrol O2 (PT)</td><td>Полный цикл расследования</td><td>Продукт PT, не кастом под процессы</td></tr>
            <tr><td><strong>Кастом Nero Network</strong></td><td>Любой SIEM, ваши runbook'и, поэтапная автономия</td><td>Проект 8–16 недель</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aib-section aib-section-alt" id="riski">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">Compliance</span>
        <h2>Риски, compliance и безопасность данных при AI в ИБ</h2>
        <p>AI в SOC без guardrails опаснее, чем без AI. Compliance-first — условие запуска.</p>
      </div>

      <div class="aib-guard-grid nero-ai-reveal">
        <div class="aib-guard-card"><h4>Ложные срабатывания</h4><p>Human-in-the-loop обязателен: AI предлагает, L2 подтверждает, audit log фиксирует рассуждения.</p></div>
        <div class="aib-guard-card"><h4>Утечки в LLM</h4><p>Российский контур: GigaChat, YandexGPT, on-prem LLM. Маскирование ПДн, prompt-injection filter, запрет shadow AI.</p></div>
        <div class="aib-guard-card"><h4>152-ФЗ и AIMS</h4><p>ГОСТ Р ИСО/МЭК 42001-2024 (AIMS). Штрафы по 152-ФЗ: до 15 млн ₽, повторные — до 500 млн ₽ оборотных.</p></div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie-ib">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до запуска в SOC?</p>
          <p class="ym-cta-block__sub">Перед внедрением agentic triage полезно разобраться в промптах, guardrails и human-in-the-loop — это снижает риск shadow AI и утечек в публичные LLM. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a> — материал логично дополняет блок про compliance и 152-ФЗ.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="aib-section" id="keisy">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">ROI</span>
        <h2>Кейсы и ROI: примеры внедрения AI в кибербезопасность</h2>
        <p>Точные цифры для вашей организации фиксируются после аудита baseline.</p>
      </div>

      <div class="aib-table-wrap nero-ai-reveal">
        <table class="aib-table">
          <thead><tr><th>Кейс</th><th>Метрика</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>ИТБ + GigaChat</td><td>−70% время реагирования</td><td>sber.pro</td></tr>
            <tr><td>Microsoft Security Copilot</td><td>−30,13% MTTR</td><td>arxiv 2411.03116</td></tr>
            <tr><td>Т-Банк</td><td>~30% инцидентов без оператора</td><td>TAdviser</td></tr>
            <tr><td>Домклик + R-Vision SIEM</td><td>−80% время реагирования</td><td>rvision.ru</td></tr>
            <tr><td>IBM (отрасль)</td><td>~$1,88 млн экономии на утечке с AI в SOC</td><td>IBM 2025</td></tr>
          </tbody>
        </table>
      </div>

      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-keisy-ib">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите сократить MTTR в вашем SOC?</p>
          <p class="ym-cta-block__sub">−30% MTTR (Microsoft), −70% время реагирования (ИТБ), 30% инцидентов без оператора (Т-Банк) — измеримый эффект после baseline-аудита.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#ceny" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Смотреть ориентиры по цене →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="aib-section aib-section-alt" id="ceny">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">Цена</span>
        <h2>Стоимость внедрения AI для кибербезопасности</h2>
        <p>Ориентир: <strong>700 тыс.–5 млн ₽</strong> за проект под ключ. Полный цикл: 8–16 недель.</p>
      </div>

      <div class="aib-table-wrap nero-ai-reveal">
        <table class="aib-table">
          <thead><tr><th>Критерий</th><th>Под ключ (Nero Network)</th><th>Своими силами</th></tr></thead>
          <tbody>
            <tr><td>Срок до MVP</td><td>2–4 недели</td><td>3–6 месяцев</td></tr>
            <tr><td>Guardrails 152-ФЗ</td><td>Встроены</td><td>Риск shadow AI и утечек</td></tr>
            <tr><td>Интеграция SIEM</td><td>Готовые коннекторы</td><td>Кастомная разработка</td></tr>
            <tr><td>ROI-замер</td><td>Baseline + KPI в договоре</td><td>Сложно измерить</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aib-section" id="dlya-kompanii">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">Для компаний</span>
        <h2>AI кибербезопасность для компании: малый, средний и enterprise</h2>
        <p>Облачный copilot — если весь стек у вендора. Кастом — при нескольких SIEM, КИИ, on-prem и уникальных регламентах.</p>
      </div>
      <ul class="aib-checklist nero-ai-reveal" aria-label="Чек-лист готовности SOC к AI">
        <li>SIEM с API / webhook</li>
        <li>Runbook'и для RAG</li>
        <li>CMDB / asset inventory</li>
        <li>Матрица критичности</li>
        <li>Политика LLM</li>
        <li>2–4 недели истории инцидентов</li>
      </ul>
      <p class="aib-related nero-ai-reveal" style="margin-top:20px;font-size:15px">На enterprise-масштабе guardrails и managed-агенты уже разбирались в кейсе <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--aib-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a>: цифровые шлюзы, политики LLM и поэтапная автономия агентов — те же принципы, что нужны CISO перед запуском AI в SOC.</p>
      <p class="aib-related nero-ai-reveal" style="margin-top:14px;font-size:15px">Для среднего бизнеса, где SOC ещё формируется, а AI-агенты уже работают в продажах, логичный соседний сценарий — <a href="/vnedrenie-ai-amocrm/" style="color:var(--aib-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a>: единые регламенты данных и human-in-the-loop снижают риск shadow AI при расширении автоматизации.</p>
    </div>
  </section>

  <section class="aib-section aib-section-alt" id="faq">
    <div class="aib-cnt">
      <div class="aib-sh nero-ai-reveal">
        <span class="aib-eyebrow">FAQ</span>
        <h2>FAQ по AI и кибербезопасности</h2>
      </div>
      <div class="aib-faq nero-ai-reveal">
        <div class="aib-faq-item"><div class="aib-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai кибербезопасность?</div><div class="aib-faq-a">Закажите аудит сценариев AI для ИБ → выберите пилотный сценарий → интегрируйте SIEM → замерьте baseline MTTR → масштабируйте на agentic triage и отчёты.</div></div>
        <div class="aib-faq-item"><div class="aib-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит и что входит в проект?</div><div class="aib-faq-a">Ориентир 700 тыс.–5 млн ₽: аудит, интеграция, настройка сценариев, обучение, KPI-дашборд. Точная смета — после аудита.</div></div>
        <div class="aib-faq-item"><div class="aib-faq-q" role="button" tabindex="0" aria-expanded="false">Под ключ или своими силами?</div><div class="aib-faq-a">Под ключ быстрее (MVP за 2–4 недели), безопаснее по 152-ФЗ и с измеримым ROI.</div></div>
        <div class="aib-faq-item"><div class="aib-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи закрывает решение?</div><div class="aib-faq-a">Triage, enrichment, расследование, гипотезы kill chain, отчёты для CISO, черновики Sigma/YARA/KQL. Финальные решения по критичным инцидентам — зона человека.</div></div>
        <div class="aib-faq-item"><div class="aib-faq-q" role="button" tabindex="0" aria-expanded="false">Заменит ли AI аналитиков?</div><div class="aib-faq-a">Нет. AI снимает 30–50% рутины; аналитик становится супервизором агентов.</div></div>
        <div class="aib-faq-item"><div class="aib-faq-q" role="button" tabindex="0" aria-expanded="false">AI выдумает ложную угрозу — что делать?</div><div class="aib-faq-a">Human-in-the-loop, audit log рассуждений агента, уровни автономии L1–L2 на старте.</div></div>
      </div>
    </div>
  </section>

  <section class="aib-section" id="cta">
    <div class="aib-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final-ib">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Обсудить AI Security</p>
          <p class="ym-cta-block__sub">Внедряем AI-слой поверх KUMA, MaxPatrol, R-Vision, Splunk — без замены SIEM и без риска утечки логов в публичные LLM. Ориентир чека: 700 тыс.–5 млн ₽.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#kak-rabotaet" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
<script>
/**
 * aib-soc-hero-engine — Мост расследования SOC
 * Мир: телеметрия алертов → ThreatIntelConsole → печать досье аналитику
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aib-soc-hero-canvas");
  if (!canvas) return;
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
    cy = ch / 2 + 8;
    scale = Math.min(cw / 440, ch / 240) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    radar: "rgba(121,242,255,0.14)",
    radarGlow: "rgba(121,242,255,0.35)",
    alertRed: "#f87171",
    alertAmber: "#fbbf24",
    consoleBase: "#0f172a",
    consoleAccent: "#79f2ff",
    violet: "#8b5cf6",
    green: "#22c55e",
    shield: "rgba(34,197,94,0.22)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0b1224",
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

  /* Радарная сетка — фоновая анимация окружения */
  function HexRadarGrid() {
    this.scanY = 0;
  }
  HexRadarGrid.prototype.draw = function (ctx) {
    this.scanY = (frame * 0.6) % 200;
    for (var i = -2; i <= 2; i++) {
      ctx.strokeStyle = C.radar;
      ctx.lineWidth = 1;
      ctx.beginPath();
      ctx.ellipse(0, -15, 140 + i * 22, 50 + i * 8, 0, 0, Math.PI * 2);
      ctx.stroke();
    }
    ctx.strokeStyle = "rgba(121,242,255,0.25)";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(-160, -15 + this.scanY - 100);
    ctx.lineTo(160, -15 + this.scanY - 100);
    ctx.stroke();
  };

  /* Телеметрические дуги алертов — вместо Conveyor */
  function AlertTelemetryStream() {
    this.pulse = 0;
  }
  AlertTelemetryStream.prototype.draw = function (ctx) {
    var paths = [
      { sx: -165, sy: -55, cx1: -80, cy1: -90, ex: -35, ey: -25, color: C.alertRed },
      { sx: -170, sy: 15, cx1: -60, cy1: 40, ex: -35, ey: -5, color: C.alertAmber },
      { sx: -160, sy: 70, cx1: -70, cy1: 55, ex: -35, ey: 20, color: C.consoleAccent }
    ];
    paths.forEach(function (p, idx) {
      ctx.strokeStyle = "rgba(121,242,255,0.18)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.5;
      ctx.beginPath();
      ctx.moveTo(p.sx, p.sy);
      ctx.quadraticCurveTo(p.cx1, p.cy1, p.ex, p.ey);
      ctx.stroke();
      ctx.setLineDash([]);

      var t = ((frame * 0.035 + idx * 0.33) % 1);
      var ax = (1 - t) * (1 - t) * p.sx + 2 * (1 - t) * t * p.cx1 + t * t * p.ex;
      var ay = (1 - t) * (1 - t) * p.sy + 2 * (1 - t) * t * p.cy1 + t * t * p.ey;
      drawRR(ctx, ax - 7, ay - 5, 14, 10, 3, p.color, C.outline);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("!", ax, ay + 2);
    });

    /* Узлы SIEM */
    [{ x: -165, y: -55, label: "SIEM" }, { x: -170, y: 15, label: "SOAR" }, { x: -160, y: 70, label: "EDR" }].forEach(function (n, i) {
      var glow = 0.4 + Math.sin(frame * 0.08 + i) * 0.3;
      ctx.fillStyle = "rgba(121,242,255," + glow + ")";
      ctx.beginPath();
      ctx.arc(n.x, n.y, 10 + Math.sin(frame * 0.1 + i) * 2, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = "#cbd5e1";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(n.label, n.x, n.y + 22);
    });
  };

  /* Центральная консоль — вместо WebsiteTerminal */
  function ThreatIntelConsole() {
    this.sealPulse = 0;
  }
  ThreatIntelConsole.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, -58, -72, 116, 148, 10, C.consoleBase, C.outline);

    /* Заголовок консоли */
    drawRR(ctx, -52, -66, 104, 18, [6, 6, 0, 0], "rgba(121,242,255,0.12)", C.consoleAccent);
    ctx.fillStyle = C.consoleAccent;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("THREAT INTEL CONSOLE", 0, -54);

    /* Фаза INGEST */
    if (prg < 65) {
      ctx.fillStyle = "rgba(248,113,113,0.2)";
      drawRR(ctx, -44, -40, 88, 22, 4, "rgba(248,113,113,0.15)", C.alertRed);
      ctx.fillStyle = "#fecaca";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("INGEST · alert #88421", 0, -26);
    }

    /* Фаза ENRICH */
    if (prg >= 65 && prg < 130) {
      var enrich = (prg - 65) / 65;
      ["Logs", "CMDB", "TI"].forEach(function (lbl, i) {
        var ox = -38 + i * 32;
        var oy = -38 + Math.sin(frame * 0.12 + i) * 3;
        drawRR(ctx, ox, oy, 28, 14, 3, "rgba(139,92,246,0.25)", C.violet);
        ctx.fillStyle = "#ddd6fe";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.fillText(lbl, ox + 14, oy + 10);
      });
      ctx.fillStyle = C.violet;
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("ENRICH · " + Math.round(enrich * 14) + " sources", 0, -8);
    }

    /* Фаза HYPOTHESIZE — kill chain */
    if (prg >= 130 && prg < 195) {
      var nodes = [{ x: -40, y: 10 }, { x: -10, y: 22 }, { x: 20, y: 8 }, { x: 42, y: 28 }];
      ctx.strokeStyle = C.alertAmber;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      nodes.forEach(function (n, i) {
        if (i === 0) ctx.moveTo(n.x, n.y);
        else ctx.lineTo(n.x, n.y);
      });
      ctx.stroke();
      nodes.forEach(function (n, i) {
        ctx.fillStyle = i === nodes.length - 1 ? C.alertAmber : C.consoleAccent;
        ctx.beginPath();
        ctx.arc(n.x, n.y, 5, 0, Math.PI * 2);
        ctx.fill();
      });
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("HYPOTHESIS · T1078→T1021", 0, -8);
    }

    /* Фаза REPORT — печать досье */
    if (prg >= 195) {
      var sealPrg = Math.min(1, (prg - 195) / 30);
      var cardY = 18 - sealPrg * 12;
      drawRR(ctx, -34, cardY, 68, 36, 6, "rgba(34,197,94,0.2)", C.green);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.fillText("Досье L2", 0, cardY + 14);
      ctx.font = "6px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("CISO report draft", 0, cardY + 24);

      if (prg > 215 && prg < 250) {
        this.sealPulse = (prg - 215) / 35;
        ctx.strokeStyle = "rgba(34,197,94," + (0.9 - this.sealPulse * 0.75) + ")";
        ctx.lineWidth = 2.5;
        ctx.beginPath();
        ctx.arc(0, cardY + 18, 18 + this.sealPulse * 38, 0, Math.PI * 2);
        ctx.stroke();
        ctx.fillStyle = C.green;
        ctx.font = "bold 8px Inter,sans-serif";
        ctx.fillText("MTTR −32%", 0, cardY - 8);
      }
    }
  };

  /* Щит guardrails — уникальный объект */
  function GuardrailShield() {
    this.blink = 0;
  }
  GuardrailShield.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    drawRR(ctx, 108, -58, 42, 50, 8, C.shield, C.green);
    ctx.fillStyle = C.green;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HITL", 129, -38);
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("152-ФЗ", 129, -28);
    if (prg > 190 && prg < 230) {
      this.blink = Math.sin(frame * 0.2) * 0.3 + 0.7;
      ctx.strokeStyle = "rgba(34,197,94," + this.blink + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(118, -20);
      ctx.lineTo(125, -12);
      ctx.lineTo(140, -28);
      ctx.stroke();
    }
  };

  /* Шкала confidence triage */
  function ConfidenceMeter() {
    this.val = 0.62;
  }
  ConfidenceMeter.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 65) this.val = 0.55 + prg / 65 * 0.15;
    else if (prg < 130) this.val = 0.7 + (prg - 65) / 65 * 0.12;
    else if (prg < 195) this.val = 0.82 + (prg - 130) / 65 * 0.09;
    else this.val = 0.91;
    drawRR(ctx, 95, 8, 54, 14, 4, "rgba(255,255,255,0.06)", C.outline);
    drawRR(ctx, 97, 10, 50 * this.val, 10, 3, C.green, null);
    ctx.fillStyle = "#e2e8f0";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText(Math.round(this.val * 100) + "% triage", 97, 19);
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
    var prg = (frame * 0.042) % 260;
    var isMoving = false;
    var faceDir = 1;
    var hubTargets = {
      "1_architect": { x: -95, y: 58 },
      "2_seo": { x: -45, y: 68 },
      "3_coder": { x: 5, y: 72 },
      "4_designer": { x: 55, y: 68 },
      "5_deployer": { x: 100, y: 58 }
    };
    var tgt = hubTargets[this.role] || { x: 0, y: 65 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 17) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 240);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.2;
    ctx.save();
    ctx.translate(this.x, this.y);
    drawRR(ctx, -12, -8 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -18 - bob, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 1.5;
    ctx.strokeStyle = C.outline;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new HexRadarGrid());
  entities.push(new AlertTelemetryStream());
  entities.push(new ThreatIntelConsole());
  entities.push(new GuardrailShield());
  entities.push(new ConfidenceMeter());

  entities.push(new Agent(-120, 95, C.agentYellow, "1_architect", 18, [
    "Playbook SOC готов", "Сценарий triage №7", "Матрица рисков OK"
  ]));
  entities.push(new Agent(-70, 105, C.agentGreen, "2_seo", 58, [
    "Triage: high risk", "FP отсечён", "Severity ↑ critical"
  ]));
  entities.push(new Agent(-15, 98, C.agentBlue, "3_coder", 98, [
    "Enrichment: 14 src", "CMDB match found", "TI lookup done"
  ]));
  entities.push(new Agent(40, 105, C.agentPink, "4_designer", 138, [
    "Kill chain v3", "T1078 подтверждён", "Гипотеза атаки"
  ]));
  entities.push(new Agent(95, 95, C.agentPurple, "5_deployer", 178, [
    "Отчёт CISO черновик", "Досье для L2", "Human approve"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife, maxLife: customLife });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.042) % 260;
    if (prg >= 16 && prg < 16.05) createBubble(-100, 20, "1. Ingest alert");
    if (prg >= 68 && prg < 68.05) createBubble(-50, 30, "2. Enrichment");
    if (prg >= 135 && prg < 135.05) createBubble(10, 25, "3. Kill chain");
    if (prg >= 200 && prg < 200.05) createBubble(60, 15, "4. Досье L2");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      drawRR(ctx, bub.x - tw / 2, bub.y - 18, tw, 18, 5, C.bubbleBg, C.consoleAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bub.x, bub.y - 8);
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
  document.querySelectorAll('.aib-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aib-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aib-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aib-faq-q');
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
  var root = document.querySelector('.ai-kiberbezopasnost-page') || document.querySelector('.aib-content');
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

<?php
$aib_page_url = trailingslashit( get_permalink() );
$aib_site_url = trailingslashit( home_url( '/' ) );
$aib_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$aib_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $aib_site_url . '#organization',
      'name'  => $aib_brand,
      'url'   => $aib_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $aib_site_url . '#website',
      'url'       => $aib_site_url,
      'name'      => $aib_brand,
      'publisher' => [ '@id' => $aib_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $aib_page_url . '#webpage',
      'url'         => $aib_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $aib_site_url . '#website' ],
      'about'       => [ '@id' => $aib_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $aib_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $aib_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $aib_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $aib_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $aib_page_url,
      'provider'    => [ '@id' => $aib_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $aib_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Как внедрить ai кибербезопасность?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Закажите аудит сценариев AI для ИБ → выберите пилотный сценарий → интегрируйте SIEM → замерьте baseline MTTR → масштабируйте на agentic triage и отчёты.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько стоит и что входит в проект?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Ориентир 700 тыс.–5 млн ₽: аудит, интеграция, настройка сценариев, обучение, KPI-дашборд. Точная смета — после аудита.' ] ],
        [ '@type' => 'Question', 'name' => 'Под ключ или своими силами?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Под ключ быстрее (MVP за 2–4 недели), безопаснее по 152-ФЗ и с измеримым ROI.' ] ],
        [ '@type' => 'Question', 'name' => 'Какие задачи закрывает решение?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Triage, enrichment, расследование, гипотезы kill chain, отчёты для CISO, черновики Sigma/YARA/KQL. Финальные решения по критичным инцидентам — зона человека.' ] ],
        [ '@type' => 'Question', 'name' => 'Заменит ли AI аналитиков?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет. AI снимает 30–50% рутины; аналитик становится супервизором агентов.' ] ],
        [ '@type' => 'Question', 'name' => 'AI выдумает ложную угрозу — что делать?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Human-in-the-loop, audit log рассуждений агента, уровни автономии L1–L2 на старте.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $aib_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
