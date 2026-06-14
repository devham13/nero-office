<?php
/**
 * Template Name: AI-менеджер для онлайн-школы: внедрение под ключ
 * Description: SEO-лендинг — AI-менеджер для онлайн-школы: заявки, консультации, доходимость. Интеграции CRM/LMS, кейсы.
 */

$page_seo_title       = 'AI-менеджер для онлайн-школы: внедрение заявок под ключ';
$page_seo_description = 'Внедряем AI-менеджера для онлайн-школы: заявки с вебинаров, консультации, сопровождение до оплаты и доходимости. Интеграции CRM/LMS, кейсы, карта AI-воронки.';

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
	[ 'label' => 'Заявки',      'href' => '#zayavki' ],
	[ 'label' => 'AI-менеджер', 'href' => '#ai-menedzher' ],
	[ 'label' => 'Внедрение',   'href' => '#vnedrenie' ],
	[ 'label' => 'Интеграции',  'href' => '#integracii' ],
	[ 'label' => 'Кейсы',       'href' => '#keisy' ],
	[ 'label' => 'Стоимость',   'href' => '#stoimost' ],
	[ 'label' => 'FAQ',         'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Собрать AI-воронку';
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label   = getenv( 'SECONDARY_CTA_LABEL' ) ?: '';
$secondary_cta_url     = getenv( 'SECONDARY_CTA_URL' ) ?: '';
$secondary_cta_has_url = $secondary_cta_url && $secondary_cta_url !== '#';

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
.yoast-breadcrumb,.entry-header,.page-title-section { display: none !important; }

#primary,.site-main,.site-content,#content,.content-area {
  padding-top: 0 !important; margin-top: 0 !important;
}

.vna-content {
  --vna-bg: #050711; --vna-bg2: #080b17; --vna-bg3: #0a0e1c;
  --vna-surface: rgba(255,255,255,.072); --vna-surface2: rgba(255,255,255,.108);
  --vna-text: #e6edf7; --vna-muted: #9aa8bd; --vna-soft: #c7d2e5; --vna-heading: #fff;
  --vna-border: rgba(255,255,255,.10); --vna-border-s: rgba(255,255,255,.18);
  --vna-accent: #79f2ff; --vna-violet: #8b5cf6; --vna-green: #22c55e;
  --vna-btn-from: #2563eb; --vna-btn-to: #7c3aed;
  --vna-shadow: 0 24px 72px rgba(0,0,0,.4);
  --vna-r: 18px; --vna-r-lg: 24px; --vna-container: 1220px;
  background: linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color: var(--vna-text);
  font-family: Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x: hidden;
}
.vna-content *,.vna-content *::before,.vna-content *::after { box-sizing: border-box; }
.vna-content a { color: inherit; text-decoration: none; }
.vna-content p { color: var(--vna-muted); line-height: 1.72; margin: 0 0 1em; }
.vna-content p:last-child { margin-bottom: 0; }
.vna-content h2,.vna-content h3,.vna-content h4 {
  color: var(--vna-heading); letter-spacing: -.045em; margin: 0 0 .7em;
}
.vna-content strong { color: var(--vna-soft); }
.vna-content ul { padding-left: 0; list-style: none; margin: 0 0 1em; }
.vna-content ul li {
  padding-left: 20px; position: relative; margin-bottom: .45em;
  color: var(--vna-muted); font-size: 14.5px; line-height: 1.65;
}
.vna-content ul li::before {
  content: '›'; position: absolute; left: 0; color: var(--vna-accent); font-weight: 700;
}
.vna-cnt { width: min(var(--vna-container),calc(100% - 40px)); margin: 0 auto; position: relative; z-index: 1; }
.vna-section { padding: clamp(64px,8vw,112px) 0; position: relative; }
.vna-section-alt {
  background: linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));
  border-top: 1px solid rgba(255,255,255,.06);
  border-bottom: 1px solid rgba(255,255,255,.06);
}
.vna-sh { max-width: 820px; margin: 0 auto 48px; text-align: center; }
.vna-sh.vna-left { margin-left: 0; text-align: left; }
.vna-sh h2 { font-size: clamp(26px,4vw,50px); line-height: 1.06; margin-bottom: 14px; }
.vna-sh p { font-size: clamp(15px,1.6vw,18px); max-width: 680px; margin: 0 auto; }
.vna-sh.vna-left p { margin-left: 0; }
.vna-eyebrow {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 6px 14px; border-radius: 999px;
  background: rgba(121,242,255,.08); border: 1px solid rgba(121,242,255,.22);
  font-size: 11.5px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
  color: var(--vna-accent); margin-bottom: 14px;
}
.vna-gt {
  background: linear-gradient(92deg,#fff 0%,var(--vna-accent) 44%,var(--vna-violet) 100%);
  -webkit-background-clip: text; background-clip: text; color: transparent !important;
}
.vna-intro {
  padding: clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);
  background: linear-gradient(180deg,rgba(255,255,255,.03),transparent);
  border-bottom: 1px solid rgba(255,255,255,.06);
}
.vna-intro-grid { display: grid; grid-template-columns: 1fr 340px; gap: 56px; align-items: center; }
.vna-intro-text { position: relative; padding-left: 20px; text-align: left; }
.vna-intro-text p { text-align: left !important; }
.vna-h3 { font-size: clamp(18px,2.2vw,22px); margin: 32px 0 12px; color: var(--vna-heading); }
.vna-logos {
  display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin: 28px 0;
}
.vna-logos span {
  padding: 8px 16px; border-radius: 999px; font-size: 12px; font-weight: 700;
  background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.12); color: var(--vna-soft);
}
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-foot a { color: #0891b2; text-decoration: none; font-weight: 600; }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-foot a:hover { text-decoration: underline; }
.nero-ai-hero.vaos-hero-edtech {
  min-height: 100vh; min-height: 100dvh; position: relative;
}
.vaos-hero-edtech .vaos-dash-canvas-wrap {
  position: relative; width: 100%; height: clamp(200px, 28vw, 280px);
  margin: 12px 0 14px; border-radius: 12px; overflow: hidden;
  background: linear-gradient(165deg, rgba(5,7,17,.92) 0%, rgba(8,11,23,.88) 100%);
  border: 1px solid rgba(121,242,255,.14);
  box-shadow: inset 0 0 40px rgba(121,242,255,.04);
}
.vaos-hero-edtech #vaos-edtech-funnel-canvas {
  position: absolute; inset: 0; width: 100%; height: 100%; display: block;
}
.vna-intro-text::before {
  content: ''; position: absolute; left: 0; top: 4px; bottom: 4px; width: 3px; border-radius: 2px;
  background: linear-gradient(180deg,var(--vna-accent),var(--vna-violet));
}
.vna-intro-kpi { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.vna-kpi-card {
  background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); border-radius: 14px;
  padding: 16px 14px; text-align: center; backdrop-filter: blur(12px);
}
.vna-kpi-card .kv { font-size: clamp(20px,2.5vw,26px); font-weight: 900; color: var(--vna-heading); margin-bottom: 5px; }
.vna-kpi-card .kl { font-size: 11px; font-weight: 600; color: var(--vna-muted); line-height: 1.4; }
@media(max-width:900px){ .vna-intro-grid{ grid-template-columns:1fr; gap:36px; } }
.vna-toc-outer { padding: 0 0 clamp(36px,4.5vw,56px); }
.vna-toc { display: flex; flex-wrap: wrap; gap: 9px; justify-content: center; }
.vna-toc a {
  display: inline-block; padding: 9px 18px;
  background: var(--vna-surface); border: 1px solid var(--vna-border); border-radius: 999px;
  font-size: 13px; font-weight: 600; color: var(--vna-muted);
  transition: border-color .2s,color .2s,background .2s;
}
.vna-toc a:hover { border-color: rgba(121,242,255,.42); color: var(--vna-accent); background: rgba(121,242,255,.08); }
.vna-card {
  background: linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));
  border: 1px solid var(--vna-border); border-radius: var(--vna-r-lg);
  padding: 26px; backdrop-filter: blur(16px);
}
.vna-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.vna-grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; }
@media(max-width:768px){ .vna-grid-2,.vna-grid-3{ grid-template-columns:1fr; } }
.vna-table-wrap { overflow-x: auto; border-radius: 14px; border: 1px solid rgba(255,255,255,.09); margin: 24px 0; }
.vna-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.vna-table th {
  padding: 13px 16px; text-align: left;
  background: rgba(121,242,255,.1); color: var(--vna-accent); font-weight: 700;
  border-bottom: 1px solid rgba(121,242,255,.25);
}
.vna-table td {
  padding: 12px 16px; border-bottom: 1px solid rgba(255,255,255,.05);
  color: var(--vna-text); vertical-align: top;
}
.vna-table tr:last-child td { border-bottom: none; }
.vna-role-card {
  background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.1);
  border-radius: var(--vna-r); padding: 26px;
}
.vna-role-card h3 { font-size: 17px; }
.vna-timeline { position: relative; padding-left: 40px; }
.vna-timeline::before {
  content: ''; position: absolute; left: 12px; top: 8px; bottom: 8px; width: 2px;
  background: linear-gradient(180deg,var(--vna-accent),var(--vna-violet)); opacity: .35;
}
.vna-tl-item { position: relative; margin-bottom: 32px; }
.vna-tl-dot {
  position: absolute; left: -32px; top: 4px; width: 16px; height: 16px; border-radius: 50%;
  background: var(--vna-accent); box-shadow: 0 0 0 4px rgba(121,242,255,.2);
}
.vna-faq { display: flex; flex-direction: column; gap: 10px; max-width: 820px; margin: 0 auto; }
.vna-faq details {
  background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.1);
  border-radius: 14px; overflow: hidden;
}
.vna-faq summary {
  padding: 19px 24px; font-size: 16px; font-weight: 700; color: var(--vna-heading);
  cursor: pointer; list-style: none;
}
.vna-faq summary::-webkit-details-marker { display: none; }
.vna-faq details p { padding: 0 24px 20px; margin: 0; }
.vna-cta-checklist {
  display: flex; flex-wrap: wrap; gap: 9px; justify-content: center; margin-bottom: 32px;
  list-style: none; padding: 0;
}
.vna-cta-checklist li {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 8px 16px; background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.1); border-radius: 999px;
  font-size: 13px; color: var(--vna-muted);
}
.vna-cta-checklist li::before { content: '✓'; color: var(--vna-green); font-weight: 800; }
.vna-callout {
  border-left: 3px solid #f59e0b; padding: 16px 20px; margin: 24px 0;
  background: rgba(245,158,11,.08); border-radius: 0 12px 12px 0;
}
.vna-callout strong { color: #fbbf24; }
.vna-pre {
  background: rgba(0,0,0,.35); border: 1px solid rgba(255,255,255,.08);
  border-radius: 12px; padding: 20px; font-size: 13px; line-height: 1.6;
  color: var(--vna-soft); overflow-x: auto; white-space: pre-wrap;
}
.ym-cta-block {
  border-radius: 20px; padding: 36px 40px; margin: 32px 0;
  background: linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));
  border: 1px solid rgba(121,242,255,.3); text-align: center;
}
.ym-cta-block--secondary {
  background: linear-gradient(135deg,rgba(34,197,94,.08),rgba(121,242,255,.08));
  border-color: rgba(34,197,94,.25);
}
.ym-cta-block--footer-final {
  background: linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));
  border-color: rgba(139,92,246,.3);
}
.ym-cta-block__icon { font-size: 36px; margin-bottom: 14px; }
.ym-cta-block__headline {
  font-size: clamp(20px,2.8vw,28px); font-weight: 800; color: #fff; margin: 0 0 10px;
}
.ym-cta-block__sub {
  color: var(--vna-muted); font-size: 15px; margin: 0 auto 22px; max-width: 600px; line-height: 1.7;
}
.ym-cta-block__actions { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
.ym-link--accent { color: var(--vna-accent); text-decoration: underline; }
.nero-ai-reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease,transform .55s ease; }
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
.nero-ai-delay-1 { transition-delay: .12s; }
.nero-ai-delay-2 { transition-delay: .24s; }

</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-onlayn-shkoly-page" role="main" tabindex="-1">

<section class="nero-ai-hero vaos-hero-edtech" id="hero" aria-labelledby="vaos-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html( $brand ); ?> · AI для онлайн-школ</p>
      <h1 id="vaos-hero-title">AI-менеджер для онлайн-школы: <span class="nero-ai-gradient-text">внедрение заявок, консультаций и сопровождения под ключ</span></h1>
      <p class="nero-ai-hero-lead">Заявки с вебинаров и рекламы обрабатываются без очереди: AI отвечает на вопросы, квалифицирует лида и сопровождает ученика до оплаты и доходимости курса</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Заявки 24/7</li>
        <li class="nero-ai-badge">Post-webinar</li>
        <li class="nero-ai-badge">GetCourse</li>
        <li class="nero-ai-badge">amoCRM</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">AI-куратор</li>
        <li class="nero-ai-badge">Доходимость</li>
        <li class="nero-ai-badge">152-ФЗ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url( $primary_cta_url ); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#vnedrenie">Как внедряем</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-воронка онлайн-школы">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-воронка онлайн-школы</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Первый ответ</span><strong>&lt;15 сек</strong><small>SLA</small></div>
            <div class="nero-ai-metric"><span>Лидов после эфира</span><strong>847</strong><small>обработано за ночь</small></div>
            <div class="nero-ai-metric"><span>Вебинар → оплата</span><strong>+22%</strong><small>потенциал пилота</small></div>
            <div class="nero-ai-metric"><span>Обращений куратору</span><strong>−68%</strong><small>автозакрытие FAQ</small></div>
          </div>
          <div class="vaos-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vaos-edtech-funnel-canvas" role="img" aria-label="Анимация: лиды с вебинара проходят AI-квалификацию, оплату в GetCourse и сопровождение куратором"></canvas>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента событий post-webinar">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">🟢</span><div><strong>Webhook Bizon365</strong><span>1100 регистраций после эфира</span></div><span class="nero-ai-status">live</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Квалификация</strong><span>тариф «Поток», бюджет 120к</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">CRM</span><div><strong>Сделка amoCRM</strong><span>саммари диалога прикреплено</span></div><span class="nero-ai-status">новое</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">GC</span><div><strong>Оплата GetCourse</strong><span>AI-куратор запустил онбординг</span></div><span class="nero-ai-status nero-ai-status--amber">куратор</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$vaos_engine = __DIR__ . '/partials/vaos-edtech-funnel-engine.inc.php';
if ( is_readable( $vaos_engine ) ) {
	require $vaos_engine;
}
?>

<div class="vna-content">

  <section class="vna-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
    <div class="vna-cnt nero-ai-container">
      <div class="vna-intro-grid nero-ai-reveal">
        <div class="vna-intro-text">
          <p class="nero-ai-eyebrow">Лонгрид · ai для онлайн школы</p>
          <p>Онлайн-школы в 2026 году тратят всё больше на привлечение трафика — и всё чаще проигрывают на этапе, который редко попадает в рекламные креативы: <strong>обработка заявок и сопровождение ученика</strong>. Лид пришёл с вебинара в 22:00, написал в Telegram, остался без ответа до утра — и купил у конкурента.</p>
          <p>Nero Network внедряет <strong>AI-менеджера для онлайн-школы под ключ</strong>: систему, которая закрывает воронку от первой заявки до доходимости курса — с интеграцией CRM, LMS и мессенджеров.</p>
          <p><strong>Коротко:</strong> AI-менеджер — не чат-бот с FAQ, а связка AI-агента, автоматизации и интеграций. Ориентир проекта: <strong>180–600 тыс. ₽</strong>, срок <strong>3–6 недель</strong>.</p>
        </div>
        <div class="vna-intro-kpi" aria-label="Ключевые метрики EdTech">
          <div class="vna-kpi-card"><div class="kv">154 млрд ₽</div><div class="kl">рынок EdTech РФ, 2025</div></div>
          <div class="vna-kpi-card"><div class="kv">50%</div><div class="kl">уходят при ответе &gt;10 мин</div></div>
          <div class="vna-kpi-card"><div class="kv">60–90%</div><div class="kl">недозвоны горячих лидов</div></div>
          <div class="vna-kpi-card"><div class="kv">&lt;15 сек</div><div class="kl">целевой SLA AI-менеджера</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vna-toc-outer">
    <div class="vna-cnt">
      <nav class="vna-toc" aria-label="Оглавление статьи">
        <a href="#zayavki">Заявки</a>
        <a href="#ai-menedzher">AI-менеджер</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#keisy">Кейсы</a>
        <a href="#stoimost">Стоимость</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Собрать воронку</a>
      </nav>
    </div>
  </div>

  <section class="vna-section" id="zayavki">
    <div class="vna-cnt">
      <div class="vna-sh vna-left nero-ai-reveal">
        <span class="vna-eyebrow">Боль воронки</span>
        <h2>Почему онлайн-школам не хватает скорости на заявках</h2>
        <p>Рынок EdTech в России вырос до ~154 млрд ₽ в 2025 году, но конкуренция сместилась в низ воронки. Заявки с вебинаров и рекламы <strong>не успевают обрабатывать</strong> — типовая боль онлайн-школы.</p>
      </div>
      <div class="vna-callout nero-ai-reveal">
        <strong>~50% клиентов уходят</strong>, если ждать ответ дольше 10 минут — исследование «Телфин» + OkoCRM, CNews, ноябрь 2025. Недозвоны до горячих лидов достигают <strong>60–90%</strong> (Carrot quest, 2026).
      </div>
      <h3 class="vna-h3 nero-ai-reveal">Где теряются лиды между вебинаром и оплатой</h3>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Этап</th><th>Что ломается</th><th>Последствие</th></tr></thead>
          <tbody>
            <tr><td>После вебинара</td><td>500–1100 заявок за ночь, 3 менеджера</td><td>Очередь, холодные лиды к утру</td></tr>
            <tr><td>Между CRM и LMS</td><td>Баги самописной интеграции</td><td>Заказы не попадают в учёт (до 1000+ в дни мероприятий)</td></tr>
            <tr><td>Консультация</td><td>Нет ответа по тарифам вне смены</td><td>Уход к школе с мгновенным чатом</td></tr>
            <tr><td>После оплаты</td><td>Куратор не успевает</td><td>Доходимость 38–45% вместо нормы 55–70%</td></tr>
          </tbody>
        </table>
      </div>
      <h3 class="vna-h3 nero-ai-reveal">Почему ручной отдел продаж не масштабируется</h3>
      <p class="nero-ai-reveal">Нанять ещё двух менеджеров на пик вебинара — дорого и медленно. Ручная обработка ломается на всплесках: запуск потока, чёрная пятница, совместный эфир с блогером.</p>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Критерий</th><th>Ручной отдел</th><th>Простой чат-бот</th><th>AI-менеджер с CRM</th></tr></thead>
          <tbody>
            <tr><td>Скорость ответа</td><td>Часы / смены</td><td>Секунды</td><td><strong>&lt;15 сек</strong>, 24/7</td></tr>
            <tr><td>Квалификация лида</td><td>Да, но узко</td><td>Шаблонные ветки</td><td>Скоринг + диалог из KB</td></tr>
            <tr><td>Контекст в CRM</td><td>Ручной ввод</td><td>Часто нет</td><td>Автосоздание сделки, саммари</td></tr>
            <tr><td>Сопровождение ученика</td><td>Только кураторы</td><td>Не закрыто</td><td>AI-куратор + эскалация</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal"><strong>AI обработка заявок курсов</strong> — не замена отдела продаж, а первый контур, который снимает пиковую нагрузку и не даёт лидам остывать.</p>
      <p class="vna-related nero-ai-reveal" style="margin-top:24px;font-size:15px">Разрыв между CRM и LMS часто усиливается без сквозной автоматизации сделок: для школ на amoCRM полезно сравнить <a href="/vnedrenie-ai-amocrm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> — соседний сценарий квалификации лидов, задач менеджеру и human handoff после вебинара.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="ai-menedzher">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Функции</span>
        <h2>Что такое AI-менеджер для онлайн-школы</h2>
        <p>Связка AI-агента, автоматизации и интеграций с LMS/CRM — три зоны воронки: продажи, консультации и сопровождение до доходимости. Это не «образовательный бот с тремя кнопками», а система с базой знаний, эскалацией и сквозной аналитикой.</p>
      </div>
      <div class="vna-grid-3 nero-ai-reveal">
        <div class="vna-role-card"><h3>AI Sales Manager</h3><p>Заявки с вебинаров и сайта, возражения, дожим до оплаты, передача горячих лидов менеджеру с саммари.</p></div>
        <div class="vna-role-card"><h3>AI Curator</h3><p>Онбординг после оплаты, напоминания о ДЗ и эфирах, ответы по урокам из RAG, сигнал «риск отвала».</p></div>
        <div class="vna-role-card"><h3>Event Engine</h3><p>Триггеры post-webinar, неоплата, брошенная корзина, lead scoring по поведению на эфире.</p></div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:24px;max-width:820px;margin-left:auto;margin-right:auto;text-align:center;">Лид попадает в CRM и за <strong>менее 15 секунд</strong> получает первый ответ AI-менеджера. Горячий контакт уходит человеку с готовым контекстом диалога.</p>
      <div class="vna-table-wrap nero-ai-reveal" style="margin-top:32px;">
        <table class="vna-table">
          <thead><tr><th>Боль</th><th>Модуль</th><th>Метрика</th></tr></thead>
          <tbody>
            <tr><td>Заявки сгорают ночью</td><td>AI Sales Manager</td><td>SLA первого ответа</td></tr>
            <tr><td>Низкая CR вебинар → оплата</td><td>Event Engine</td><td>CR вебинар → оплата</td></tr>
            <tr><td>Кураторы тонут в FAQ</td><td>AI Curator</td><td>% автозакрытых обращений</td></tr>
            <tr><td>Менеджеры теряют контекст</td><td>Human Handoff</td><td>Время до контакта с горячим</td></tr>
            <tr><td>Нет прозрачности ROI</td><td>Analytics Dashboard</td><td>Воронка по этапам, эскалации</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ================================================
       БОРИС: визуальный блок после #ai-menedzher
       ================================================ -->
  <section id="vnedrenie-ai-onlayn-shkoly-boris-block" class="bas-root" aria-label="Анимация: AI-куратор сопровождает ученика после оплаты в GetCourse">
<style>
/* === БОРИС: prefix bas-, scoped внутри #vnedrenie-ai-onlayn-shkoly-boris-block === */
#vnedrenie-ai-onlayn-shkoly-boris-block.bas-root { padding: 56px 0 64px; }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-cnt { max-width: 1160px; margin: 0 auto; padding: 0 20px; }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-card {
  display: grid; grid-template-columns: 44% 56%;
  border-radius: 24px; overflow: hidden; min-height: 500px;
  box-shadow: 0 8px 48px rgba(0,0,0,.35), 0 0 0 1.5px rgba(121,242,255,.18);
}
@media(max-width:960px){ #vnedrenie-ai-onlayn-shkoly-boris-block .bas-card{ grid-template-columns:1fr; min-height:auto; } }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-lft {
  background: #f8fafc; padding: 44px 36px;
  display: flex; flex-direction: column; justify-content: center;
}
@media(max-width:600px){ #vnedrenie-ai-onlayn-shkoly-boris-block .bas-lft{ padding: 28px 22px; } }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-ey {
  display: inline-flex; align-items: center; gap: 7px;
  font-size: 11px; font-weight: 700; letter-spacing: .11em; text-transform: uppercase;
  color: #0e7490; margin: 0 0 14px;
}
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-ey::before {
  content: ''; display: inline-block; width: 20px; height: 2px; background: #06b6d4; border-radius: 1px;
}
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-h3 {
  font-size: 24px; font-weight: 800; color: #0f172a; line-height: 1.3; margin: 0 0 20px;
}
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-ul {
  list-style: none; margin: 0 0 22px; padding: 0;
  display: flex; flex-direction: column; gap: 10px;
}
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-ul li {
  display: flex; align-items: flex-start; gap: 10px;
  font-size: 14.5px; line-height: 1.5; color: #334155; padding-left: 0;
}
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-ul li::before { content: none; }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-ic {
  flex-shrink: 0; width: 22px; height: 22px; border-radius: 50%;
  background: rgba(6,182,212,.12); display: flex; align-items: center; justify-content: center;
  font-size: 11px; color: #0891b2; font-style: normal;
}
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-pills { display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 18px; }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-pl {
  padding: 5px 12px; border-radius: 99px; font-size: 12px; font-weight: 700; white-space: nowrap;
}
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-pl-g { background: rgba(34,197,94,.1); color: #15803d; border: 1.5px solid rgba(34,197,94,.25); }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-pl-c { background: rgba(6,182,212,.1); color: #0e7490; border: 1.5px solid rgba(6,182,212,.25); }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-pl-v { background: rgba(139,92,246,.1); color: #6d28d9; border: 1.5px solid rgba(139,92,246,.25); }
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-foot {
  font-size: 13.5px; color: #64748b; font-style: italic; margin: 0;
}
#vnedrenie-ai-onlayn-shkoly-boris-block .bas-rgt {
  background: linear-gradient(145deg,#060a14 0%,#0c1220 55%,#080d18 100%);
  position: relative; overflow: hidden; min-height: 420px;
}
@media(max-width:960px){ #vnedrenie-ai-onlayn-shkoly-boris-block .bas-rgt{ min-height: 380px; } }
#bas-curator-canvas { position: absolute; inset: 0; width: 100%; height: 100%; display: block; }
</style>

<div class="bas-cnt">
  <div class="bas-card">
    <div class="bas-lft">
      <span class="bas-ey">После оплаты · доходимость</span>
      <h3 class="bas-h3">AI-куратор ведёт ученика по модулям — пока менеджеры закрывают новых лидов</h3>
      <ul class="bas-ul">
        <li><span class="bas-ic">📚</span>Онбординг в GetCourse: доступ, расписание, первое ДЗ</li>
        <li><span class="bas-ic">🔔</span>Напоминания об эфирах и дедлайнах — ответ из базы знаний курса</li>
        <li><span class="bas-ic">📈</span>Прогресс по модулям 1→2→3 с сигналом «риск отвала» живому куратору</li>
        <li><span class="bas-ic">↗</span>Реактивация: ученик не заходил 5 дней — цепочка в Telegram</li>
      </ul>
      <div class="bas-pills">
        <span class="bas-pl bas-pl-g">до 98% FAQ в пике</span>
        <span class="bas-pl bas-pl-c">RAG по урокам</span>
        <span class="bas-pl bas-pl-v">human handoff</span>
      </div>
      <p class="bas-foot"><a href="#vnedrenie">Дальше разберём этапы внедрения AI под ключ →</a></p>
    </div>
    <div class="bas-rgt">
      <canvas id="bas-curator-canvas" aria-label="Анимация: путь ученика через модули курса с AI-куратором в GetCourse" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bas-curator-canvas');
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
    cyan: '#79f2ff', violet: '#8b5cf6', green: '#22c55e', amber: '#f59e0b',
    text: '#e2e8f0', muted: 'rgba(226,232,240,.45)',
    card: 'rgba(255,255,255,.07)', cardBdr: 'rgba(255,255,255,.14)',
    modDone: 'rgba(34,197,94,.15)', modActive: 'rgba(121,242,255,.12)', modLock: 'rgba(255,255,255,.04)'
  };

  var MODULES = [
    { label: 'Оплата', sub: 'GetCourse', color: C.violet },
    { label: 'Модуль 1', sub: 'онбординг', color: C.cyan },
    { label: 'Модуль 2', sub: 'практика', color: C.cyan },
    { label: 'Модуль 3', sub: 'экзамен', color: C.green }
  ];

  var students = [
    { t: 0, speed: 0.0032, mod: 0, name: 'Анна' },
    { t: 0.15, speed: 0.0026, mod: 1, name: 'Игорь' },
    { t: 0.35, speed: 0.0020, mod: 2, name: 'Мария' }
  ];

  var pings = [];
  var LOOP = 900;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if (fill){ ctx.fillStyle = fill; ctx.fill(); }
    if (stroke){ ctx.strokeStyle = stroke; ctx.lineWidth = lw || 1.5; ctx.stroke(); }
  }

  function drawTopBar(){
    ctx.fillStyle = C.text;
    ctx.font = 'bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('GetCourse · AI-куратор', 14, 22);
    ctx.fillStyle = C.green;
    ctx.font = '10px Inter,sans-serif';
    ctx.fillText('● live', W - 48, 22);
    ctx.strokeStyle = 'rgba(255,255,255,.08)';
    ctx.beginPath(); ctx.moveTo(0, 32); ctx.lineTo(W, 32); ctx.stroke();
  }

  function drawModules(yBase, modW, gap){
    var totalW = MODULES.length * modW + (MODULES.length - 1) * gap;
    var startX = (W - totalW) / 2;
    MODULES.forEach(function(m, i){
      var x = startX + i * (modW + gap);
      var prog = Math.min(1, Math.max(0, (frame - i * 80) / 120));
      var fill = i === 0 ? C.modDone : prog > 0.8 ? C.modActive : C.modLock;
      rr(x, yBase, modW, 72, 10, fill, C.cardBdr, 1.2);
      ctx.fillStyle = m.color;
      ctx.font = 'bold 11px system-ui,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(m.label, x + modW/2, yBase + 28);
      ctx.fillStyle = C.muted;
      ctx.font = '9px system-ui,sans-serif';
      ctx.fillText(m.sub, x + modW/2, yBase + 48);
      if (i < MODULES.length - 1){
        ctx.strokeStyle = 'rgba(121,242,255,.25)';
        ctx.setLineDash([4,4]);
        ctx.beginPath();
        ctx.moveTo(x + modW + 4, yBase + 36);
        ctx.lineTo(x + modW + gap - 4, yBase + 36);
        ctx.stroke();
        ctx.setLineDash([]);
      }
    });
    return { startX: startX, modW: modW, gap: gap, yBase: yBase };
  }

  function drawCuratorHub(cx, cy, pulse){
    var r = 28 + pulse * 4;
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2);
    g.addColorStop(0, 'rgba(139,92,246,.35)');
    g.addColorStop(1, 'rgba(139,92,246,0)');
    ctx.fillStyle = g;
    ctx.beginPath(); ctx.arc(cx,cy,r*1.5,0,Math.PI*2); ctx.fill();
    rr(cx - r, cy - r, r*2, r*2, r*0.4, 'rgba(139,92,246,.2)', C.violet, 2);
    ctx.fillStyle = C.text;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('AI', cx, cy - 2);
    ctx.font = '8px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('куратор', cx, cy + 12);
  }

  function drawStudent(s, layout, idx){
    var phase = (frame * s.speed + s.t) % 1;
    var modIdx = Math.floor(phase * MODULES.length);
    if (modIdx >= MODULES.length) modIdx = MODULES.length - 1;
    var local = (phase * MODULES.length) % 1;
    var x = layout.startX + modIdx * (layout.modW + layout.gap) + layout.modW * local;
    var y = layout.yBase + 90 + idx * 22 + Math.sin(frame * 0.04 + idx) * 3;
    ctx.fillStyle = [C.cyan, C.violet, C.green][idx % 3];
    ctx.beginPath(); ctx.arc(x, y, 7, 0, Math.PI*2); ctx.fill();
    ctx.strokeStyle = 'rgba(255,255,255,.5)'; ctx.lineWidth = 1.5; ctx.stroke();
  }

  function spawnPing(){
    var msgs = ['Напоминание о ДЗ','Ответ из KB','Эфир через 2 ч','Риск отвала → куратор'];
    pings.push({ text: msgs[pings.length % msgs.length], t: 0, y: 52 + Math.random() * 40 });
    if (pings.length > 4) pings.shift();
  }

  function drawPings(){
    pings.forEach(function(p){
      p.t += 0.02;
      var alpha = p.t < 0.15 ? p.t / 0.15 : p.t > 0.85 ? (1 - p.t) / 0.15 : 1;
      if (alpha <= 0) return;
      ctx.globalAlpha = alpha * 0.95;
      var tw = Math.min(180, ctx.measureText(p.text).width + 24);
      rr(W - tw - 16, p.y, tw, 22, 8, 'rgba(34,197,94,.15)', 'rgba(34,197,94,.35)', 1);
      ctx.fillStyle = C.green;
      ctx.font = '9px system-ui,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(p.text, W - tw - 8, p.y + 14);
      ctx.globalAlpha = 1;
    });
  }

  function drawProgressBar(y){
    var w = W - 48, x = 24;
    rr(x, y, w, 8, 4, 'rgba(255,255,255,.06)', null, 0);
    var prog = 0.35 + 0.25 * Math.sin(frame * 0.008);
    rr(x, y, w * prog, 8, 4, C.green, null, 0);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText('Доходимость потока: ' + Math.round(prog * 100) + '%', x, y - 6);
  }

  function tick(){
    frame++;
    if (frame % 140 === 0) spawnPing();
    ctx.clearRect(0, 0, W, H);
    drawTopBar();
    var modW = Math.min(88, (W - 80) / MODULES.length - 8);
    var layout = drawModules(H * 0.38, modW, 12);
    drawCuratorHub(W * 0.5, H * 0.22, 0.5 + 0.5 * Math.sin(frame * 0.06));
    students.forEach(function(s, i){ drawStudent(s, layout, i); });
    drawPings();
    drawProgressBar(H - 36);
    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
  </section>

  <aside class="ym-cta-block ym-cta-block--primary" id="cta-ai-menedzher">
    <div class="ym-cta-block__icon" aria-hidden="true">🎓</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Соберите AI-воронку под вашу онлайн-школу</p>
      <p class="ym-cta-block__sub">Покажем, где теряются лиды после вебинара и как AI-менеджер закроет заявки, консультации и сопровождение до доходимости. На старте — <strong>Карта AI-воронки онлайн-школы</strong> и baseline-метрики.</p>
      <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
    </div>
  </aside>

  <section class="vna-section" id="vnedrenie">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Под ключ</span>
        <h2>Как внедрить AI для онлайн-школы под ключ</h2>
        <p>Проектная модель Nero Network на 3–6 недель: аудит → интеграции → AI-менеджер → пилот 10–30% трафика.</p>
      </div>
      <div class="vna-card nero-ai-reveal">
        <div class="vna-timeline">
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Аудит воронки (3–5 дней)</h3><p>Карта касаний, baseline SLA/CR/доходимость, выбор пилотных сценариев post-webinar. Результат — <strong>Карта AI-воронки онлайн-школы</strong>.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Интеграционный контур (5–10 дней)</h3><p>Webhooks GetCourse, Bizon365, формы → CRM; единый ID ученика, антидубли, Event Engine.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>AI-менеджер и KB (7–14 дней)</h3><p>Скрипты, тарифы, FAQ кураторов, промпты Sales/Curator, RAG по урокам, стоп-зоны на цены и юридические темы.</p></div>
          <div class="vna-tl-item"><div class="vna-tl-dot"></div><h3>Пилот и масштабирование (7–14 дней)</h3><p>10–30% трафика, QA диалогов, дашборд метрик, обучение команды. Гибрид: AI — рутина 24/7, человек — дорогие чеки и эскалации.</p></div>
        </div>
      </div>
      <div class="vna-card nero-ai-reveal" style="margin-top:24px;">
        <p class="vna-h3" style="margin-top:0;">Логика работы системы (6 шагов)</p>
        <ol style="padding-left:20px;color:var(--vna-muted);line-height:1.8;font-size:14.5px;">
          <li>Лид оставляет заявку, регистрируется на вебинар или пишет в Telegram.</li>
          <li>Webhook → CRM → триггер AI-менеджера (&lt;15 сек).</li>
          <li>Квалификация + ответ из KB + предложение оплаты или созвона.</li>
          <li>Горячий лид (скоринг) → задача менеджеру с саммари диалога.</li>
          <li>После оплаты → AI-куратор: онбординг, напоминания, риск отвала.</li>
          <li>Аналитика → корректировка сценариев по SLA, CR и доходимости.</li>
        </ol>
      </div>
    </div>
  </section>

  <?php if ( $secondary_cta_has_url ) : ?>
  <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Хотите понимать AI-автоматизацию до старта проекта?</p>
      <p class="ym-cta-block__sub">Если команда школы хочет разобраться в n8n, промптах, RAG и human-in-the-loop до пилота — посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a>. Это ускоряет согласование сценариев post-webinar и эскалации на менеджера.</p>
    </div>
  </aside>
  <?php endif; ?>

  <section class="vna-section vna-section-alt" id="integracii">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Стек EdTech</span>
        <h2>Интеграции AI с CRM, LMS и каналами</h2>
        <p>Без <strong>интеграции AI для онлайн-школы с CRM</strong> менеджер слепой: диалог есть, сделки нет. Типовой стек EdTech в РФ:</p>
      </div>
      <div class="vna-logos nero-ai-reveal" aria-label="Интеграции">
        <span>GetCourse</span><span>amoCRM</span><span>Bitrix24</span><span>Bizon365</span><span>Telegram</span><span>Make / n8n</span>
      </div>
      <h3 class="vna-h3 nero-ai-reveal">GetCourse, amoCRM, Bitrix24</h3>
      <p class="nero-ai-reveal">Единый ID ученика от первого клика до модуля N: события GetCourse создают и обновляют сделки в CRM, контроль дублей, логи интеграции.</p>
      <h3 class="vna-h3 nero-ai-reveal">Telegram, мессенджеры, email</h3>
      <p class="nero-ai-reveal">В 2026 фокус EdTech смещается в мессенджеры — AI-менеджер отвечает в Telegram 24/7; email-цепочки дополняют nurture для «тёплых» лидов.</p>
      <h3 class="vna-h3 nero-ai-reveal">Post-webinar playbook</h3>
      <p class="nero-ai-reveal">Webhook из Bizon365 → параллельная обработка заявок AI за ночь → скоринг partial / no-show / high-intent → квалифицированные лиды с саммари менеджерам днём.</p>
      <div class="vna-pre nero-ai-reveal">Реклама → Лендинг/вебинар → [AI: мгновенный ответ]
    → CRM (сделка + скоринг) → [AI: дожим / консультация]
    → Оплата в GetCourse → [AI-куратор: онбординг, ДЗ, риск отвала]
    → Доходимость → Analytics Dashboard</div>
      <p class="vna-related nero-ai-reveal" style="margin-top:24px;font-size:15px">Email-цепочки в nurture-воронке школы дополняют мессенджеры: когда поток заявок идёт через почту в CRM, смотрите <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-обработку входящей почты в CRM</a> — типовой контур классификации, извлечения полей и маршрутизации без ручного копипаста.</p>
    </div>
  </section>

  <section class="vna-section" id="keisy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">ROI</span>
        <h2>Кейсы и примеры внедрения AI в образовательные воронки</h2>
        <p>Цифры ниже — ориентиры из публичных источников, не гарантия. Nero Network строит пилот с <strong>вашими</strong> метриками до/после.</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Кейс</th><th>Что сделали</th><th>Результат (источник)</th></tr></thead>
          <tbody>
            <tr><td>Skysmart</td><td>ИИ-бот вместо 3 менеджеров, CRM</td><td>CR контакт→лид <strong>72%</strong> (было 11–16%), CPL −54% (Sostav)</td></tr>
            <tr><td>Мед. ДПО-центр</td><td>AI на сайте, 36 курсов, GetCourse</td><td>Ответ <strong>15 сек</strong>, CR диалог→заявка 19% (NextBot)</td></tr>
            <tr><td>«Нейробурашка»</td><td>Salebot + ИИ, GetCourse</td><td><strong>+33%</strong> конверсии с первого месяца (ALIOT)</td></tr>
            <tr><td>Ozerova School</td><td>AI-поддержка по KB школы</td><td>до <strong>98%</strong> обращений в пике, ~9 чел.-часов/день экономии (GetTech)</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal">AI-куратор влияет на completion rate: напоминания, ответы по урокам, сигнал «ученик не заходил N дней». Тренд 2026 — <strong>цифровые кураторы</strong> (СберБизнес Live / Zenclass).</p>
      <p class="vna-related nero-ai-reveal" style="margin-top:24px;font-size:15px">На уровне крупных организаций те же принципы managed AI-агентов и цифровых шлюзов уже масштабируются на сотни тысяч пользователей: в материале про <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a> — ориентиры governance, которые адаптируются к edtech-воронке с compliance 152-ФЗ.</p>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="stoimost">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Коммерция</span>
        <h2>Стоимость внедрения AI для онлайн-школы и окупаемость</h2>
        <p>Диапазон <strong>180–600 тыс. ₽</strong> зависит от числа курсов, каналов и глубины интеграций. Окупаемость считаем от потерь на post-webinar, а не от «магических +300%».</p>
      </div>
      <div class="vna-table-wrap nero-ai-reveal">
        <table class="vna-table">
          <thead><tr><th>Компонент</th><th>Содержание</th></tr></thead>
          <tbody>
            <tr><td>Аудит воронки</td><td>Карта касаний, baseline-метрики, пилотные сценарии</td></tr>
            <tr><td>Интеграционный контур</td><td>Webhooks, CRM, LMS, антидубли, Event Engine</td></tr>
            <tr><td>AI-менеджер</td><td>KB, промпты, RAG, Sales + Curator, стоп-зоны</td></tr>
            <tr><td>Compliance</td><td>152-ФЗ: согласие в боте, политика ПДн, хранение в РФ</td></tr>
            <tr><td>Пилот и обучение</td><td>10–30% трафика, QA, дашборд, передача команде</td></tr>
          </tbody>
        </table>
      </div>
      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal">
        <p class="ym-cta-block__headline">Рассчитать окупаемость под вашу воронку</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
          <a href="#vnedrenie" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
        </div>
      </div>
    </div>
  </section>

  <section class="vna-section" id="rodovoy">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">Родовой кластер</span>
        <h2>Внедрение AI и нейросетей в бизнес-процессы</h2>
        <p>Мост к экспертизе Nero Network: агенты с инструментами, RAG, гибрид AI + человек, compliance. Для B2B-контуров с документооборотом и ERP смежный опыт описан в разделе <a href="/ai-1c-erp/" style="color:var(--vna-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP: внедрение под ключ</a> — тот же подход human-in-the-loop, но фокус на учётных процессах, а не на edtech-воронке.</p>
      </div>
    </div>
  </section>

  <section class="vna-section vna-section-alt" id="faq">
    <div class="vna-cnt">
      <div class="vna-sh nero-ai-reveal">
        <span class="vna-eyebrow">FAQ</span>
        <h2>FAQ по AI для онлайн-школы</h2>
      </div>
      <div class="vna-faq nero-ai-reveal">
        <details><summary>Подойдёт ли малой онлайн-школе?</summary><p>Да, через узкий пилот: один канал (Telegram или виджет), один сценарий (заявка + FAQ). Масштабирование — после метрик.</p></details>
        <details><summary>Как внедрить ai для онлайн школы без риска для репутации?</summary><p>RAG только по утверждённой KB; стоп-зоны на цены и юридические темы; 2 недели режима «ассистент с утверждением»; эскалация при низкой уверенности.</p></details>
        <details><summary>Как избежать галлюцинаций в консультациях?</summary><p>База знаний из скриптов школы; запрет отвечать вне KB → handoff куратору; регулярный QA выборки диалогов.</p></details>
        <details><summary>Нужен ли отдельный AI под каждый курс?</summary><p>Не обязательно: одна платформа с разными KB и промптами по продуктам. Для 10+ курсов — сегментация по веткам и тегам в CRM.</p></details>
        <details><summary>Заменит ли AI менеджеров и кураторов?</summary><p>Нет. AI снимает рутину и пики; человек закрывает дорогие чеки, конфликты и нестандартные кейсы.</p></details>
        <details><summary>GetCourse и так всё умеет — зачем внешний AI?</summary><p>Мало публичных кейсов AI внутри LMS с влиянием на метрики. Типовой паттерн: бот в Telegram/на сайте + интеграция в GetCourse и CRM.</p></details>
        <details><summary>⚖️ Как с 152-ФЗ и персональными данными?</summary><p>Политика ПДн, явное согласие в боте, хранение в РФ где требуется — проектируем на этапе аудита (EdLegal, LEGAS).</p></details>
        <details><summary>Сколько длится внедрение?</summary><p><strong>3–6 недель:</strong> аудит (3–5 дней) → интеграции (5–10) → AI-менеджер (7–14) → пилот (7–14).</p></details>
        <details><summary>Какой ROI реалистично ждать?</summary><p>Зависит от baseline. Ориентиры из кейсов: CR +30–33%, время ответа часы → секунды. Фиксируем ваши цифры до пилота и сравниваем после.</p></details>
      </div>
    </div>
  </section>

  <section class="vna-section" id="cta">
    <div class="vna-cnt">
      <ul class="vna-cta-checklist nero-ai-reveal">
        <li>Аудит воронки и baseline-метрики</li>
        <li>Карта AI-воронки онлайн-школы</li>
        <li>Архитектура CRM, LMS, Telegram</li>
        <li>Пилот 10–30% трафика с дашбордом ROI</li>
      </ul>
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы закрыть разрыв между трафиком и выручкой?</p>
          <p class="ym-cta-block__sub">Оставьте заявку на «<?php echo esc_html( $primary_cta_label ); ?>» — спроектируем AI-менеджера под ваши курсы, CRM и сценарии post-webinar. На старте — <strong>Карта AI-воронки онлайн-школы</strong> и baseline-метрики. Пилот на 10–30% трафика с дашбордом ROI.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
            <a href="#stoimost" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Смотреть стоимость →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTERNAL-LINKS:INSERT -->

</div><!-- .vna-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
