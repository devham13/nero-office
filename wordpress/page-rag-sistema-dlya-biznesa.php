<?php
/**
 * Template Name: RAG-система для бизнеса: внедрение и настройка под ключ
 * Description: SEO-лендинг — корпоративный RAG, база знаний AI, внедрение под ключ. Кейсы, архитектура, цены.
 */

$page_seo_title       = 'RAG-система для бизнеса: внедрение и настройка под ключ';
$page_seo_description = 'Внедрим RAG-систему для бизнеса: AI отвечает по вашим документам, регламентам и базам знаний. Разработка, интеграция, кейсы и цены. Оценка проекта бесплатно.';

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
	[ 'label' => 'Как работает', 'href' => '#chto-takoe-rag' ],
	[ 'label' => 'Архитектура',  'href' => '#kak-rabotaet' ],
	[ 'label' => 'Источники',    'href' => '#istochniki-dannyh' ],
	[ 'label' => 'Сценарии',     'href' => '#scenarii' ],
	[ 'label' => 'Безопасность', 'href' => '#bezopasnost' ],
	[ 'label' => 'Этапы',        'href' => '#etapy' ],
	[ 'label' => 'Стоимость',    'href' => '#cena' ],
	[ 'label' => 'Кейсы',        'href' => '#keisy' ],
	[ 'label' => 'FAQ',          'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Оценить RAG-систему';
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'Курс по AI-автоматизации';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '#';

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

.rag-sistema-dlya-biznesa-page .nero-ai-hero{
  min-height:100vh;min-height:100dvh;position:relative;
}

.rag-content{
  --rag-bg:#050711;--rag-bg2:#080b17;
  --rag-surface:rgba(255,255,255,.072);
  --rag-text:#e6edf7;--rag-muted:#9aa8bd;--rag-soft:#c7d2e5;--rag-heading:#fff;
  --rag-border:rgba(255,255,255,.10);
  --rag-accent:#79f2ff;--rag-violet:#8b5cf6;--rag-green:#22c55e;
  --rag-btn-from:#2563eb;--rag-btn-to:#7c3aed;
  --rag-r:18px;--rag-r-lg:24px;--rag-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--rag-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.rag-content *,.rag-content *::before,.rag-content *::after{box-sizing:border-box;}
.rag-content a{color:inherit;text-decoration:none;}
.rag-content p{color:var(--rag-muted);line-height:1.72;margin:0 0 1em;}
.rag-content p:last-child{margin-bottom:0;}
.rag-content h2,.rag-content h3,.rag-content h4{color:var(--rag-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.rag-content strong{color:var(--rag-soft);}
.rag-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.rag-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--rag-muted);font-size:14.5px;line-height:1.65;}
.rag-content ul li::before{content:'›';position:absolute;left:0;color:var(--rag-accent);font-weight:700;}
.rag-cnt{width:min(var(--rag-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.rag-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.rag-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.rag-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.rag-sh.rag-left{margin-left:0;text-align:left;}
.rag-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.rag-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.rag-sh.rag-left p{margin-left:0;}
.rag-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--rag-accent);margin-bottom:14px;}
.rag-gt{background:linear-gradient(92deg,#fff 0%,var(--rag-accent) 44%,var(--rag-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.rag-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.rag-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.rag-intro-text{position:relative;padding-left:20px;}
.rag-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--rag-accent),var(--rag-violet));}
.rag-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--rag-muted);margin-bottom:1em;}
.rag-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.rag-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.rag-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--rag-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.rag-kpi-card .kl{font-size:11px;font-weight:600;color:var(--rag-muted);line-height:1.4;}
@media(max-width:900px){.rag-intro-grid{grid-template-columns:1fr;gap:36px;}.rag-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.rag-intro-kpi{grid-template-columns:1fr 1fr;}}
.rag-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.rag-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.rag-toc a{display:inline-block;padding:9px 18px;background:var(--rag-surface);border:1px solid var(--rag-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--rag-muted);transition:border-color .2s,color .2s,background .2s;}
.rag-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--rag-accent);background:rgba(121,242,255,.08);}
.rag-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--rag-border);border-radius:var(--rag-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.rag-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.rag-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.rag-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.rag-grid-2,.rag-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.rag-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.rag-grid-3{grid-template-columns:1fr;}}
.rag-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.rag-table{width:100%;border-collapse:collapse;font-size:14px;}
.rag-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--rag-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.rag-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--rag-text);vertical-align:top;}
.rag-table tr:last-child td{border-bottom:none;}
.rag-table tr:hover td{background:rgba(255,255,255,.03);}
.rag-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--rag-r);padding:26px;display:flex;gap:18px;align-items:flex-start;margin-bottom:14px;transition:border-color .2s;}
.rag-scenario:last-child{margin-bottom:0;}
.rag-scenario:hover{border-color:rgba(121,242,255,.3);}
.rag-sc-icon{flex-shrink:0;width:44px;height:44px;border-radius:12px;background:rgba(121,242,255,.12);border:1px solid rgba(121,242,255,.22);display:flex;align-items:center;justify-content:center;font-size:20px;}
.rag-scenario h3{font-size:17px;margin-bottom:8px;}
.rag-scenario p{font-size:14.5px;margin:0 0 .6em;}
.rag-timeline{position:relative;padding-left:40px;}
.rag-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--rag-accent),var(--rag-violet));opacity:.35;border-radius:2px;}
.rag-tl-item{position:relative;margin-bottom:32px;}
.rag-tl-item:last-child{margin-bottom:0;}
.rag-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--rag-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.rag-tl-item h3{font-size:17px;margin-bottom:8px;}
.rag-tl-item p{font-size:14.5px;margin:0;}
.rag-source-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:16px;padding:22px;transition:border-color .2s,transform .2s;}
.rag-source-card:hover{border-color:rgba(121,242,255,.35);transform:translateY(-2px);}
.rag-source-card h3{font-size:16px;margin-bottom:8px;}
.rag-source-card p{font-size:13.5px;margin:0;}
.rag-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.rag-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.rag-case-grid{grid-template-columns:1fr;}}
.rag-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.rag-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.rag-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--rag-green);margin-bottom:10px;}
.rag-case-card h3{font-size:16px;margin-bottom:14px;}
.rag-metric{display:flex;align-items:baseline;gap:8px;margin-bottom:8px;}
.rag-metric .num{font-size:22px;font-weight:900;color:var(--rag-accent);flex-shrink:0;}
.rag-metric .lbl{font-size:13px;color:var(--rag-muted);}
.rag-pain-card{background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.18);border-radius:16px;padding:20px;margin-bottom:12px;}
.rag-pain-card h3{font-size:16px;color:#fca5a5;margin-bottom:8px;}
.rag-pain-card p{font-size:14px;margin:0;}
.rag-badge-152{display:inline-flex;padding:4px 12px;border-radius:999px;background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.3);font-size:11px;font-weight:700;color:var(--rag-green);margin-bottom:12px;}
.rag-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.rag-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.rag-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--rag-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.rag-faq-q::after{content:'▾';font-size:13px;color:var(--rag-accent);flex-shrink:0;transition:transform .25s;}
.rag-faq-item.open .rag-faq-q::after{transform:rotate(180deg);}
.rag-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--rag-muted);line-height:1.72;}
.rag-faq-item.open .rag-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--rag-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--rag-btn-from),var(--rag-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--rag-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--rag-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page rag-sistema-dlya-biznesa-page" role="main" tabindex="-1">

<section class="nero-ai-hero" id="hero" aria-labelledby="hero-rag-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html( $brand ); ?> · корпоративные базы знаний</p>
      <h1 id="hero-rag-title">RAG-система для бизнеса: <span class="nero-ai-gradient-text">внедрение и настройка под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI отвечает на основе ваших документов, инструкций и баз знаний — без галлюцинаций и устаревших данных</p>
      <ul class="nero-ai-badges" aria-label="Ключевые технологии">
        <li class="nero-ai-badge">RAG</li>
        <li class="nero-ai-badge">Vector DB</li>
        <li class="nero-ai-badge">Confluence</li>
        <li class="nero-ai-badge">152-ФЗ</li>
        <li class="nero-ai-badge">On-prem</li>
        <li class="nero-ai-badge">Hybrid search</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url( $primary_cta_url ); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-takoe-rag">Как это работает</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: RAG-платформа">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">RAG · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <p class="nero-ai-dashboard-note">пример логики retrieval · демонстрационные данные</p>
          <div class="nero-ai-dashboard-title"><h3>RAG-платформа</h3><span class="nero-ai-live-pill">онлайн</span></div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Индекс</span><strong>12 847</strong><small>документов</small></div>
            <div class="nero-ai-metric"><span>Поиск</span><strong>1,8 сек</strong><small>средний</small></div>
            <div class="nero-ai-metric"><span>Цитаты</span><strong>94%</strong><small>ответов</small></div>
            <div class="nero-ai-metric"><span>ACL</span><strong>ok</strong><small>доступ</small></div>
          </div>
          <div class="nero-ai-task-stream">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">Q</span><div><strong>Запрос</strong><span>«политика возврата 2026»</span></div><span class="nero-ai-status">3 чанка</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">R</span><div><strong>Retrieval</strong><span>hybrid search + rerank</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">A</span><div><strong>Ответ</strong><span>регламент v3.2 · цитата</span></div><span class="nero-ai-status">новое</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">↻</span><div><strong>Индекс</strong><span>Confluence обновлён</span></div><span class="nero-ai-status">sync</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="rag-content">

<section class="rag-intro nero-ai-section nero-ai-section-tight" id="intro" aria-label="Введение">
  <div class="rag-cnt nero-ai-container">
    <div class="rag-intro-grid nero-ai-reveal">
      <div class="rag-intro-text">
        <p class="nero-ai-eyebrow">Лонгрид · корпоративный RAG</p>
        <p>ChatGPT не знает ваши регламенты. RAG-система для бизнеса привязывает каждый ответ к актуальным документам — с цитатой, ACL и audit log. <strong>Внедрим RAG: AI отвечает на основе ваших документов, инструкций и баз данных.</strong></p>
        <p>Для IT-директоров, юридических и продуктовых команд это закрывает главную B2B-боль: «голый» чат-бот галлюцинирует без внутреннего контекста компании.</p>
      </div>
      <div class="rag-intro-kpi" aria-label="Ключевые показатели RAG">
        <div class="rag-kpi-card"><div class="kv">×20</div><div class="kl">ускорение поиска (Альфа-Банк: 60→3 сек)</div></div>
        <div class="rag-kpi-card"><div class="kv">94%</div><div class="kl">ответов с цитатой (production)</div></div>
        <div class="rag-kpi-card"><div class="kv">400K–2,5M ₽</div><div class="kl">ориентир проекта под ключ</div></div>
        <div class="rag-kpi-card"><div class="kv">3–6 нед.</div><div class="kl">MVP с измеримыми KPI</div></div>
      </div>
    </div>
  </div>
</section>

<div class="rag-toc-outer">
  <div class="rag-cnt">
    <nav class="rag-toc" aria-label="Оглавление статьи">
      <a href="#chto-takoe-rag">Что такое RAG</a>
      <a href="#kak-rabotaet">Архитектура</a>
      <a href="#istochniki-dannyh">Источники</a>
      <a href="#scenarii">Сценарии</a>
      <a href="#bezopasnost">Безопасность</a>
      <a href="#etapy">Этапы</a>
      <a href="#cena">Стоимость</a>
      <a href="#keisy">Кейсы</a>
      <a href="#faq">FAQ</a>
      <a href="#cta">Оценка</a>
    </nav>
  </div>
</div>

<section class="rag-section" id="chto-takoe-rag">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">Основы · ai rag</span>
      <h2>Что такое RAG-система для бизнеса и зачем она нужна</h2>
      <p>RAG — это когда нейросеть <strong>сначала находит</strong> фрагменты в ваших документах, <strong>потом формулирует</strong> ответ с опорой на источники. Не «из головы модели», а по корпоративному контексту.</p>
    </div>
    <div class="rag-card nero-ai-reveal">
      <h3 style="font-size:19px;margin-bottom:14px;">Типовой пайплайн RAG</h3>
      <p>Индексация документов → chunking → embedding → vector database → hybrid retrieval → rerank → генерация LLM → ответ с цитатами и ссылками на первоисточник.</p>
    </div>
    <div class="rag-card nero-ai-reveal" style="margin-top:20px;">
      <p>В 2026 году организации переходят от экспериментов с ChatGPT к <strong>grounded AI</strong> — ответам с контролем доступа, audit log и compliance. Рынок RAG растёт с ~$1,9–2,1 млрд (2025) до ~$9,9–10,2 млрд к 2030 (CAGR ~38–40%).</p>
    </div>
    <div style="margin-top:32px;" class="rag-sh rag-left">
      <h3>Чем RAG отличается от «обычного» ChatGPT и fine-tuning</h3>
    </div>
    <div class="rag-table-wrap nero-ai-reveal">
      <table class="rag-table">
        <thead><tr><th>Подход</th><th>Как работает</th><th>Плюсы</th><th>Минусы для бизнеса</th></tr></thead>
        <tbody>
          <tr><td><strong>ChatGPT / prompt-only</strong></td><td>Модель отвечает из обученных знаний + промпт</td><td>Быстрый старт</td><td>Не знает регламенты; галлюцинации; риск утечки</td></tr>
          <tr><td><strong>Fine-tuning</strong></td><td>Дообучение модели на ваших данных</td><td>Стабильный «тон»</td><td>Дорого; при смене регламентов — переобучение</td></tr>
          <tr><td><strong>RAG</strong></td><td>Поиск по базе знаний + генерация с цитатами</td><td>Актуальность; прозрачность источников</td><td>Требует качественной подготовки данных</td></tr>
        </tbody>
      </table>
    </div>
    <div class="rag-card nero-ai-reveal" style="margin-top:24px;">
      <h3 style="font-size:17px;margin-bottom:10px;">Когда RAG выгоднее дообучения модели</h3>
      <ul>
        <li>Регламенты, тарифы и инструкции обновляются регулярно</li>
        <li>Нужны цитаты и ссылки на первоисточник (юристы, compliance, поддержка)</li>
        <li>Объём знаний большой — тысячи PDF, wiki, CRM-записей</li>
        <li>Важна скорость внедрения: MVP за <strong>3–6 недель</strong> vs месяцы fine-tuning</li>
        <li>Требуется on-prem или контур 152-ФЗ без передачи данных в зарубежные облака</li>
      </ul>
      <p style="margin-top:12px;"><strong>Итог:</strong> RAG — оптимальный путь для корпоративной базы знаний AI, когда документы меняются, а ответ должен быть проверяемым.</p>
    </div>
  </div>
</section>

<section class="rag-section rag-section-alt" id="bolez-bez-rag">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">Проблема · галлюцинации</span>
      <h2>Почему нейросеть отвечает неточно без ваших документов</h2>
      <p>LLM без корпоративных данных отвечает обобщённо, устаревшими или выдуманными фактами — особенно в юридических, финансовых и технических процессах.</p>
    </div>
    <p class="nero-ai-reveal" style="max-width:820px;margin:0 auto 28px;text-align:center;color:var(--rag-muted);font-size:15px;line-height:1.72;">ChatGPT не «знает» ваши внутренние документы. Сотрудник копирует фрагмент регламента — и получает уверенный ответ, который может противоречить действующей редакции политики, тарифной сетке или SLA.</p>
    <div class="rag-grid-2 nero-ai-reveal">
      <div class="rag-pain-card"><h3>Галлюцинации</h3><p>Модель «додумывает» пункт договора, версию ПО или лимит тарифа.</p></div>
      <div class="rag-pain-card"><h3>Устаревшие данные</h3><p>Обучение модели не включает вчерашнее обновление Confluence или SharePoint.</p></div>
      <div class="rag-pain-card"><h3>Нет ACL</h3><p>Один вопрос для юриста и оператора требует разных регламентов; без ACL выдаётся лишнее.</p></div>
      <div class="rag-pain-card"><h3>Нет трассировки</h3><p>Невозможно проверить, откуда взят ответ; audit log отсутствует.</p></div>
      <div class="rag-pain-card"><h3>Утечка при копировании</h3><p>Конфиденциальные фрагменты уходят в публичные чат-боты вместо закрытого контура.</p></div>
    </div>
    <div class="rag-card nero-ai-reveal" style="margin-top:28px;">
      <p>По опросу S&P Global (1000+ IT/business лидеров, март 2025) <strong>42%</strong> компаний отказались от большинства AI-инициатив; в среднем <strong>46% PoC</strong> не доходят до production. Среди причин — стоимость, privacy, security — факторы, усиливающие спрос на <strong>on-prem RAG</strong>.</p>
    </div>
    <div class="rag-card nero-ai-reveal" style="margin-top:20px;">
      <h3 style="font-size:17px;margin-bottom:10px;">Что теряют IT, юристы и продуктовые команды</h3>
      <ul>
        <li><strong>IT:</strong> часы на поиск runbook'ов и политик ИБ; дублирование ответов в чатах</li>
        <li><strong>Юристы:</strong> риск неверной трактовки шаблона; невозможность быстро найти актуальную редакцию</li>
        <li><strong>Продукт:</strong> расхождение wiki, Jira и CRM; onboarding растягивается на недели</li>
      </ul>
      <p style="margin-top:12px;">RAG переводит поиск из режима «5 минут в Confluence» в «3 секунды с цитатой» — как в кейсе Альфа-Банка (раздел «Кейсы»).</p>
    </div>
  </div>
</section>

<!-- БОРИС: RAG pipeline animation — после секции «боль», внутри архитектуры -->
<section class="rag-section" id="kak-rabotaet">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">Архитектура</span>
      <h2>Как работает корпоративный RAG: архитектура под ключ</h2>
      <p>RAG под ключ — это не «поставили ChatGPT», а конвейер данных: ETL → индексация → vector DB → hybrid search → LLM с политикой «отвечай по документам или скажи "не знаю"».</p>
    </div>

    <section id="rag-sistema-dlya-biznesa-boris-block" class="brg-root" aria-label="Анимация: 5 шагов корпоративного RAG-пайплайна от документов до ответа с цитатой">
<style>
#rag-sistema-dlya-biznesa-boris-block.brg-root{margin:0 0 48px;padding:0;}
#rag-sistema-dlya-biznesa-boris-block .brg-card{
  display:grid;grid-template-columns:44% 56%;
  border-radius:24px;overflow:hidden;
  box-shadow:0 8px 48px rgba(0,0,0,.35),0 0 0 1.5px rgba(121,242,255,.18);
  min-height:520px;
}
@media(max-width:960px){#rag-sistema-dlya-biznesa-boris-block .brg-card{grid-template-columns:1fr;min-height:auto;}}
#rag-sistema-dlya-biznesa-boris-block .brg-lft{
  background:#f8fafc;padding:44px 38px;display:flex;flex-direction:column;justify-content:center;
}
@media(max-width:600px){#rag-sistema-dlya-biznesa-boris-block .brg-lft{padding:28px 22px;}}
#rag-sistema-dlya-biznesa-boris-block .brg-ey{
  display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;
  letter-spacing:.11em;text-transform:uppercase;color:#0891b2;margin:0 0 14px;
}
#rag-sistema-dlya-biznesa-boris-block .brg-ey::before{content:'';display:inline-block;width:20px;height:2px;background:#0891b2;border-radius:1px;}
#rag-sistema-dlya-biznesa-boris-block .brg-h3{font-size:24px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 20px;}
@media(max-width:600px){#rag-sistema-dlya-biznesa-boris-block .brg-h3{font-size:20px;}}
#rag-sistema-dlya-biznesa-boris-block .brg-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;}
#rag-sistema-dlya-biznesa-boris-block .brg-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;}
#rag-sistema-dlya-biznesa-boris-block .brg-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(8,145,178,.1);
  display:flex;align-items:center;justify-content:center;font-size:10px;color:#0891b2;font-style:normal;font-weight:700;
}
#rag-sistema-dlya-biznesa-boris-block .brg-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px;}
#rag-sistema-dlya-biznesa-boris-block .brg-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;}
#rag-sistema-dlya-biznesa-boris-block .brg-pl-c{background:rgba(8,145,178,.08);color:#0e7490;border:1.5px solid rgba(8,145,178,.22);}
#rag-sistema-dlya-biznesa-boris-block .brg-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22);}
#rag-sistema-dlya-biznesa-boris-block .brg-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#rag-sistema-dlya-biznesa-boris-block .brg-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#rag-sistema-dlya-biznesa-boris-block .brg-rgt{
  background:linear-gradient(145deg,#050711 0%,#0a1020 55%,#060a14 100%);
  position:relative;overflow:hidden;min-height:420px;
}
@media(max-width:960px){#rag-sistema-dlya-biznesa-boris-block .brg-rgt{min-height:380px;}}
#brg-rag-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="brg-card">
  <div class="brg-lft">
    <span class="brg-ey">Пайплайн RAG · 5 шагов</span>
    <h3 class="brg-h3">От документов Confluence до ответа с цитатой — за секунды</h3>
    <ul class="brg-ul">
      <li><span class="brg-ic">1</span>Коннекторы забирают wiki, PDF, CRM и ERP-документы</li>
      <li><span class="brg-ic">2</span>Chunking + embedding — каждый фрагмент с метаданными и ACL</li>
      <li><span class="brg-ic">3</span>Hybrid search: vector + BM25 + reranker в Qdrant/pgvector</li>
      <li><span class="brg-ic">4</span>LLM генерирует ответ только по retrieved context</li>
      <li><span class="brg-ic">5</span>Цитата: документ, раздел, дата — audit log для compliance</li>
    </ul>
    <div class="brg-pills">
      <span class="brg-pl brg-pl-c">1,8 сек · поиск</span>
      <span class="brg-pl brg-pl-v">Hybrid RAG</span>
      <span class="brg-pl brg-pl-g">94% с цитатой</span>
    </div>
    <p class="brg-foot">Дальше — источники данных и сценарии для ваших команд →</p>
  </div>
  <div class="brg-rgt">
    <canvas id="brg-rag-pipeline-canvas" role="img" aria-label="Анимация: документы индексируются, векторы ищутся в базе, LLM формирует ответ с цитатой на регламент"></canvas>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('brg-rag-pipeline-canvas');
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
    cyan:'#79f2ff', cyanD:function(a){return 'rgba(121,242,255,'+a+')';},
    viol:'#8b5cf6', violD:function(a){return 'rgba(139,92,246,'+a+')';},
    green:'#22c55e', greenD:function(a){return 'rgba(34,197,94,'+a+')';},
    text:'#e6edf7', muted:'rgba(230,237,247,.45)',
    card:'rgba(255,255,255,.06)', cardBdr:'rgba(255,255,255,.12)',
    line:'rgba(255,255,255,.08)', paper:'#f1f5f9'
  };

  var STAGES = [
    {label:'Индекс', sub:'ETL · chunk', xR:0.08},
    {label:'Embed', sub:'vectors', xR:0.28},
    {label:'Vector DB', sub:'Qdrant', xR:0.48},
    {label:'Retrieve', sub:'hybrid', xR:0.68},
    {label:'Ответ', sub:'+ цитата', xR:0.88}
  ];

  var DOCS = [
    {label:'PDF', delay:0}, {label:'Wiki', delay:80},
    {label:'1С', delay:160}, {label:'CRM', delay:240}
  ];

  var LOOP = 680;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawGrid(){
    ctx.strokeStyle=C.line; ctx.lineWidth=1;
    for(var gx=0;gx<W;gx+=32){
      ctx.beginPath();ctx.moveTo(gx,0);ctx.lineTo(gx,H);ctx.stroke();
    }
    for(var gy=0;gy<H;gy+=32){
      ctx.beginPath();ctx.moveTo(0,gy);ctx.lineTo(W,gy);ctx.stroke();
    }
  }

  function drawStages(pulse){
    var top = H*0.12, stageH = H*0.18;
    STAGES.forEach(function(st,i){
      var cx = W*st.xR;
      var active = ((frame + i*50) % LOOP) < 120;
      rr(cx-42, top, 84, stageH, 10, active?C.cyanD(.12):C.card, active?C.cyan:C.cardBdr, active?2:1);
      ctx.fillStyle=active?C.cyan:C.text;
      ctx.font=(active?'bold ':'')+'10px Inter,system-ui,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(st.label, cx, top+22);
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,sans-serif';
      ctx.fillText(st.sub, cx, top+38);
      if(i<STAGES.length-1){
        var nx = W*STAGES[i+1].xR;
        ctx.strokeStyle=C.cyanD(.25+0.15*Math.sin(pulse*0.08+i));
        ctx.lineWidth=2;
        ctx.setLineDash([4,4]);
        ctx.beginPath();
        ctx.moveTo(cx+44, top+stageH/2);
        ctx.lineTo(nx-44, top+stageH/2);
        ctx.stroke();
        ctx.setLineDash([]);
      }
    });
  }

  function drawDocs(pulse){
    var baseY = H*0.52;
    DOCS.forEach(function(d,i){
      var t = (frame + d.delay) % LOOP;
      var prog = Math.min(1, t / (LOOP*0.75));
      var x = W*0.06 + prog*(W*0.82);
      var y = baseY + Math.sin(pulse*0.05+i)*6;
      var alpha = t < 40 ? t/40 : (t > LOOP-60 ? (LOOP-t)/60 : 1);
      ctx.globalAlpha = alpha;
      rr(x-14,y-18,28,36,4,C.paper,C.cardBdr,1);
      ctx.fillStyle=C.cyan;
      ctx.font='bold 8px Inter,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(d.label, x, y+2);
      if(prog>0.55 && prog<0.72){
        ctx.fillStyle=C.violD(.6);
        for(var v=0;v<5;v++){
          ctx.beginPath();
          ctx.arc(x-8+v*4, y-28, 2.5, 0, Math.PI*2);
          ctx.fill();
        }
      }
      ctx.globalAlpha=1;
    });
  }

  function drawVectorNodes(pulse){
    var cx = W*0.48, cy = H*0.58, r = Math.min(W,H)*0.14;
    for(var n=0;n<12;n++){
      var ang = (n/12)*Math.PI*2 + pulse*0.02;
      var nr = r*(0.5+0.5*Math.sin(pulse*0.04+n));
      var nx = cx + Math.cos(ang)*nr;
      var ny = cy + Math.sin(ang)*nr*0.6;
      ctx.beginPath();
      ctx.arc(nx, ny, 3+Math.sin(pulse*0.06+n)*1.5, 0, Math.PI*2);
      ctx.fillStyle = n%3===0?C.cyan:(n%3===1?C.viol:C.green);
      ctx.fill();
    }
    ctx.strokeStyle=C.cyanD(.3);
    ctx.lineWidth=1;
    for(var a=0;a<6;a++){
      var a1=(a/6)*Math.PI*2+pulse*0.015;
      var a2=a1+Math.PI/3;
      ctx.beginPath();
      ctx.moveTo(cx+Math.cos(a1)*r*0.7, cy+Math.sin(a1)*r*0.4);
      ctx.lineTo(cx+Math.cos(a2)*r*0.7, cy+Math.sin(a2)*r*0.4);
      ctx.stroke();
    }
  }

  function drawAnswerBubble(pulse){
    var t = frame % LOOP;
    if(t < LOOP*0.55) return;
    var alpha = Math.min(1, (t-LOOP*0.55)/(LOOP*0.15));
    ctx.globalAlpha = alpha;
    var bx = W*0.78, by = H*0.68, bw = Math.min(160, W*0.28), bh = 72;
    rr(bx-bw/2, by-bh, bw, bh, 12, C.greenD(.15), C.green, 1.5);
    ctx.fillStyle=C.text;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Ответ с цитатой', bx, by-bh+22);
    ctx.fillStyle=C.muted;
    ctx.font='8px Inter,sans-serif';
    ctx.fillText('регламент v3.2 · §4.2', bx, by-bh+38);
    ctx.fillStyle=C.green;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('ACL ✓ · audit log', bx, by-bh+54);
    ctx.globalAlpha=1;
  }

  function drawQueryBeam(pulse){
    var t = frame % LOOP;
    if(t < LOOP*0.4 || t > LOOP*0.7) return;
    var prog = (t - LOOP*0.4) / (LOOP*0.3);
    var qx = W*0.68, qy = H*0.35;
    var tx = W*0.48, ty = H*0.58;
    ctx.strokeStyle=C.cyanD(.5+0.3*Math.sin(pulse*0.1));
    ctx.lineWidth=2;
    ctx.beginPath();
    ctx.moveTo(qx, qy);
    ctx.lineTo(tx + (qx-tx)*(1-prog), ty + (qy-ty)*(1-prog));
    ctx.stroke();
    ctx.fillStyle=C.cyan;
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Запрос →', qx-10, qy-8);
  }

  function loop(){
    frame++;
    var pulse = frame;
    ctx.clearRect(0,0,W,H);
    drawGrid();
    drawStages(pulse);
    drawVectorNodes(pulse);
    drawDocs(pulse);
    drawQueryBeam(pulse);
    drawAnswerBubble(pulse);
    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('RAG pipeline · демо', 14, H-14);
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
    </section>

    <div class="rag-grid-2 nero-ai-reveal" style="margin-top:32px;">
      <div class="rag-card">
        <h3>Индексация: chunking и embedding</h3>
        <p>Коннекторы забирают документы из Confluence, SharePoint, Google Drive, 1С, CRM. Chunking с метаданными: версия, автор, отдел, дата. Embedding — open-source, YandexGPT или GigaChat.</p>
      </div>
      <div class="rag-card">
        <h3>Vector DB и hybrid search</h3>
        <p>Qdrant, pgvector, Weaviate. Тренд 2026 — hybrid retrieval: vector + BM25 + RRF + cross-encoder rerank. Semantic search + keyword для артикулов и кодов ошибок.</p>
      </div>
    </div>
    <div class="rag-card nero-ai-reveal" style="margin-top:20px;">
      <h3>LLM + retrieval: логика Nero Network</h3>
      <ol style="padding-left:20px;color:var(--rag-muted);line-height:1.8;font-size:14.5px;">
        <li>Пользователь задаёт вопрос в чате (портал / Telegram / Bitrix24 / amoCRM)</li>
        <li>Оркестратор проверяет права доступа (ACL)</li>
        <li>Hybrid retrieval → top-K чанков → rerank</li>
        <li>LLM генерирует ответ только на основе context + «иначе — не знаю»</li>
        <li>Ответ с цитатами; запрос и ответ логируются для QA и compliance</li>
      </ol>
      <p style="margin-top:12px;"><strong>Стек:</strong> Make/n8n + Qdrant/pgvector + YandexGPT/GigaChat + Telegram/Bitrix24/amoCRM + MCP-router.</p>
    </div>
  </div>
</section>

<section class="rag-section rag-section-alt" id="istochniki-dannyh">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">Интеграции</span>
      <h2>Какие источники данных подключаем</h2>
      <p>RAG работает поверх ваших реальных систем — не требует «переноса всего в один Excel».</p>
    </div>
    <div class="rag-grid-3 nero-ai-reveal">
      <div class="rag-source-card"><h3>Confluence / Notion</h3><p>Wiki, runbook'и, product specs — IT, продукт, onboarding</p></div>
      <div class="rag-source-card"><h3>SharePoint / Drive</h3><p>Регламенты, шаблоны, презентации — HR, юристы, compliance</p></div>
      <div class="rag-source-card"><h3>amoCRM / Bitrix24</h3><p>Скрипты продаж, FAQ, история кейсов — продажи, поддержка</p></div>
      <div class="rag-source-card"><h3>1С / ERP</h3><p>Инструкции, договоры (1С:ДО, выгрузки) — финансы, операционка</p></div>
      <div class="rag-source-card"><h3>Jira / GitHub</h3><p>Техдок, ADR, release notes — разработка, DevOps</p></div>
      <div class="rag-source-card"><h3>PDF / Word</h3><p>OCR-пайплайн, версионирование, dedup для legacy-контента</p></div>
    </div>
    <div class="rag-card nero-ai-reveal" style="margin-top:28px;">
      <p>Кейс <strong>ARAG Альфа-Банка</strong>: RAG поверх Confluence и Jira; Qdrant с шардированием по доменам; ACL из Confluence перед выдачей. Для legacy-контента настраиваем автообновление индекса при изменении статьи — обязательный элемент production.</p>
    </div>
  </div>
</section>

<section class="rag-section" id="scenarii">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">Сценарии · ai для бизнеса</span>
      <h2>Сценарии RAG для IT, юридических и продуктовых команд</h2>
    </div>
    <div class="rag-scenario nero-ai-reveal">
      <div class="rag-sc-icon" aria-hidden="true">⚖️</div>
      <div><h3>Поиск по регламентам и compliance</h3><p>Ответы с цитатой на пункт регламента и датой редакции. AI даёт справку, не заменяет юриста — human-in-the-loop для юридически значимых решений.</p></div>
    </div>
    <div class="rag-scenario nero-ai-reveal nero-ai-delay-1">
      <div class="rag-sc-icon" aria-hidden="true">👋</div>
      <div><h3>Поддержка сотрудников и onboarding</h3><p>Новый сотрудник спрашивает бота вместо «пинга» коллег. Кейс Flowwow: AI по <strong>10 000+</strong> документам в «Пачке»; self-hosted; кнопка «Сообщить об ошибке» → алерт для актуализации базы знаний.</p></div>
    </div>
    <div class="rag-scenario nero-ai-reveal nero-ai-delay-2">
      <div class="rag-sc-icon" aria-hidden="true">📦</div>
      <div><h3>Продуктовые и технические базы знаний</h3><p>Поиск по Jira, Confluence и GitHub одним запросом. AI-агенты — следующий шаг: retrieval как модуль внутри agentic-систем.</p></div>
    </div>
  </div>
</section>

<section class="rag-section rag-section-alt" id="bezopasnost">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">Compliance</span>
      <h2>Безопасность, доступы и 152-ФЗ</h2>
      <span class="rag-badge-152">152-ФЗ · on-prem · ACL · audit log</span>
    </div>
    <div class="rag-table-wrap nero-ai-reveal">
      <table class="rag-table">
        <thead><tr><th>Режим</th><th>Когда выбирают</th><th>Стек</th></tr></thead>
        <tbody>
          <tr><td><strong>On-prem</strong></td><td>ПДн, банки, госсектор, строгий ИБ</td><td>Qwen/Llama on-prem GPU, Qdrant, закрытый контур</td></tr>
          <tr><td><strong>РФ-облако</strong></td><td>Баланс скорости и compliance</td><td>YandexGPT, GigaChat в российском контуре</td></tr>
          <tr><td><strong>Hybrid</strong></td><td>Пилот в облаке → production on-prem</td><td>Быстрый time-to-value, затем миграция</td></tr>
        </tbody>
      </table>
    </div>
    <div class="rag-card nero-ai-reveal" style="margin-top:24px;">
      <p>С <strong>1 июля 2025</strong> усилена локализация ПДн: запрет на обработку ПДн граждан РФ через БД за пределами РФ (ч. 5 ст. 18 152-ФЗ). Для RAG с персональными данными: on-prem или YandexGPT/GigaChat в РФ-контуре + ACL + audit log.</p>
      <ul style="margin-top:16px;">
        <li><strong>ACL на уровне документа</strong> — пользователь видит только то, к чему имеет доступ в Confluence/AD/1С</li>
        <li><strong>Audit log</strong> — каждый запрос, retrieved chunks, финальный ответ</li>
        <li><strong>Политика «не знаю»</strong> — лучше честный отказ, чем галлюцинация в compliance-теме</li>
      </ul>
    </div>
  </div>
</section>

<section class="rag-section" id="etapy">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">Внедрение</span>
      <h2>Этапы внедрения RAG под ключ</h2>
      <p>От аудита до production — поэтапно, с измеримыми KPI, без «AI на все документы сразу».</p>
    </div>
    <div class="rag-timeline nero-ai-reveal">
      <div class="rag-tl-item"><div class="rag-tl-dot"></div><h3>Фаза 0 — аудит (3–5 дней)</h3><p>10–15 типовых вопросов; инвентаризация источников; оценка ПДн и режима 152-ФЗ; go/no-go по качеству данных.</p></div>
      <div class="rag-tl-item"><div class="rag-tl-dot"></div><h3>Фаза 1 — MVP (3–6 недель)</h3><p>1–2 источника, до 500–2000 документов; Qdrant/pgvector, hybrid search; web-чат или Telegram; 20–30 тестовых Q&A; baseline метрики.</p></div>
      <div class="rag-tl-item"><div class="rag-tl-dot"></div><h3>Фаза 2 — production (4–8 недель)</h3><p>ACL по ролям; автообновление индекса; audit log, reranker; SLA-мониторинг; обучение команд. Альфа-Банк: пилот 100 операторов → production за <strong>4 месяца</strong>; <strong>85 000+</strong> запросов/сутки.</p></div>
    </div>

    <!-- INTERNAL-LINKS:INSERT -->
    <div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
      <div class="ym-cta-block__icon" aria-hidden="true">📚</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы к пилоту RAG на ваших документах?</p>
        <p class="ym-cta-block__sub">За 3–5 дней проведём аудит источников (Confluence, SharePoint, 1С, CRM), оценим ПДн и 152-ФЗ, подберём контур on-prem или YandexGPT/GigaChat. На выходе — roadmap пилота с KPI и ориентиром бюджета 400 тыс.–2,5 млн ₽.</p>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>

    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понимать RAG до старта пилота?</p>
        <p class="ym-cta-block__sub">Перед внедрением корпоративной базы знаний полезно разобраться в n8n, промптах, vector DB и human-in-the-loop — это ускоряет согласование с IT и юристами. Посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_external_link_attrs( $secondary_cta_url ); ?>><?php echo esc_html( $secondary_cta_label ); ?></a>.</p>
      </div>
    </aside>
  </div>
</section>

<section class="rag-section rag-section-alt" id="cena">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">Бюджет</span>
      <h2>Сколько стоит RAG-система для бизнеса</h2>
      <p>Ориентир проекта Nero Network — <strong>400 тыс.–2,5 млн ₽</strong> в зависимости от объёма данных, интеграций и контура размещения.</p>
    </div>
    <div class="rag-table-wrap nero-ai-reveal">
      <table class="rag-table">
        <thead><tr><th>Компонент</th><th>Что влияет на цену</th></tr></thead>
        <tbody>
          <tr><td>Аудит и проектирование</td><td>Количество источников, ПДн, требования ИБ</td></tr>
          <tr><td>Подготовка данных</td><td>Chunking, OCR, dedup, чистка wiki</td></tr>
          <tr><td>Vector DB и retrieval</td><td>Объём документов, hybrid search, reranker</td></tr>
          <tr><td>LLM-контур</td><td>On-prem GPU vs YandexGPT/GigaChat</td></tr>
          <tr><td>Интеграции</td><td>CRM, мессенджеры, портал, 1С</td></tr>
          <tr><td>Production</td><td>ACL, audit, мониторинг, SLA</td></tr>
        </tbody>
      </table>
    </div>

    <div class="rag-card nero-ai-reveal" style="margin-top:24px;">
      <h3 style="font-size:17px;margin-bottom:10px;">Что входит в типовой проект</h3>
      <ol style="padding-left:20px;color:var(--rag-muted);line-height:1.8;font-size:14.5px;">
        <li>Аудит источников и сценариев (3–5 дней)</li>
        <li>MVP с 1–2 источниками и измеримыми KPI (3–6 недель)</li>
        <li>Production: ACL, автообновление индекса, audit log (4–8 недель)</li>
        <li>Интеграция в чат/CRM/портал и обучение команды</li>
        <li>Документация, runbook, метрики качества (RAGAS/DeepEval)</li>
      </ol>
      <p style="margin-top:12px;">Публичные ориентиры рынка РФ (для сравнения): noviKEY от 240 тыс. ₽; Без Рутин от 350 тыс. ₽; NJ Soft MVP от 990 тыс. ₽.</p>
    </div>

    <div class="ym-cta-block ym-cta-block--dual" id="cta-cena">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте бюджет под ваш объём документов</p>
        <p class="ym-cta-block__sub">Ориентир проекта — 400 тыс.–2,5 млн ₽ в зависимости от источников, интеграций и контура размещения. На бесплатной оценке дадим вилку сроков, стек (Qdrant/pgvector, Make/n8n) и KPI пилота.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="rag-section" id="keisy">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">ROI</span>
      <h2>Кейсы и ROI: что получает компания</h2>
    </div>
    <div class="rag-case-grid nero-ai-reveal">
      <div class="rag-case-card">
        <div class="rag-case-tag">Альфа-Банк · KTS</div>
        <h3>RAG для 12 000 операторов</h3>
        <div class="rag-metric"><span class="num">×20</span><span class="lbl">ускорение поиска (60→3 сек)</span></div>
        <div class="rag-metric"><span class="num">85K+</span><span class="lbl">запросов/сутки</span></div>
        <div class="rag-metric"><span class="num">93%</span><span class="lbl">положительных оценок</span></div>
      </div>
      <div class="rag-case-card">
        <div class="rag-case-tag">Flowwow · Habr</div>
        <h3>Self-hosted RAG на n8n</h3>
        <div class="rag-metric"><span class="num">10K+</span><span class="lbl">документов в контуре</span></div>
        <div class="rag-metric"><span class="num">2,5</span><span class="lbl">мес. разработки</span></div>
        <div class="rag-metric"><span class="num">×5,5</span><span class="lbl">дешевле коробки</span></div>
      </div>
      <div class="rag-case-card">
        <div class="rag-case-tag">Glean · T-Mobile</div>
        <h3>Enterprise search + RAG</h3>
        <div class="rag-metric"><span class="num">−47%</span><span class="lbl">время разрешения звонков</span></div>
        <div class="rag-metric"><span class="num">100+</span><span class="lbl">SaaS-источников</span></div>
        <div class="rag-metric"><span class="num">1 млрд</span><span class="lbl">объектов за 7 недель (Koch)</span></div>
      </div>
    </div>
    <div class="rag-card nero-ai-reveal" style="margin-top:28px;">
      <p><strong>Итог для бизнеса:</strong> быстрее поиск регламентов; меньше «переспрашиваний» коллег; снижение галлюцинаций vs «голый» ChatGPT; прозрачность — каждый ответ со ссылкой на документ; основа для <strong>ai агентов</strong> и <strong>ai автоматизация бизнеса</strong> следующего уровня.</p>
    </div>
  </div>
</section>

<section class="rag-section rag-section-alt" id="faq">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">FAQ</span>
      <h2>FAQ по RAG для бизнеса</h2>
    </div>
    <div class="rag-faq nero-ai-reveal" role="list">
      <?php
      $faq_items = [
        [ 'q' => 'Что такое RAG простыми словами', 'a' => 'RAG — когда нейросеть сначала находит нужные фрагменты в ваших документах, а потом формулирует ответ на их основе. Как сотрудник, который открывает регламент и цитирует пункт — только за секунды.' ],
        [ 'q' => 'RAG или fine-tuning — что выбрать', 'a' => 'Для корпоративной базы знаний с частыми обновлениями — RAG: автоматическое обновление при переиндексации, цитаты источников, MVP за 3–6 недель. Fine-tuning — для узких стабильных доменов.' ],
        [ 'q' => 'Какие vector DB используют в корпоративных проектах', 'a' => 'Чаще всего: Qdrant, pgvector (PostgreSQL), Weaviate, Pinecone. В проектах Nero Network и кейсах Альфа-Банка/Flowwow — Qdrant и pgvector.' ],
        [ 'q' => 'Можно ли развернуть RAG on-prem', 'a' => 'Да. Flowwow и Альфа-Банк работают в закрытом контуре. Для 152-ФЗ и ПДн on-prem или YandexGPT/GigaChat в РФ — стандартный сценарий.' ],
        [ 'q' => 'Сколько документов нужно для старта', 'a' => 'Пилот — 50–200 ключевых документов одного отдела. Production — от 500–2000 и выше. Важнее качество и актуальность, чем «загрузить всё».' ],
        [ 'q' => 'Как обновлять базу знаний', 'a' => 'ETL-пайплайн с расписанием или webhook из Confluence. При изменении статьи индекс обновляется автоматически — как в RAG-платформе Альфа-Банка.' ],
        [ 'q' => 'Что если ответ неверный', 'a' => 'Feedback-кнопка «Сообщить об ошибке» → алерт ответственному → актуализация базы знаний. Плюс audit log и human-in-the-loop для критичных тем.' ],
        [ 'q' => 'Чем RAG лучше «просто ChatGPT для всех»', 'a' => 'ChatGPT не знает ваши документы, не даёт цитат, создаёт риск утечки при копировании регламентов. RAG — ai по внутренним документам с контролем доступа.' ],
        [ 'q' => 'Сколько длится внедрение', 'a' => 'MVP — 3–6 недель; полный production — 2–4 месяца. Кейс Альфа-Банка: 4 месяца от пилота 100 операторов до production.' ],
        [ 'q' => 'Какие модели LLM используют в РФ', 'a' => 'YandexGPT, GigaChat, open-source (Qwen, Llama, Gemma) on-prem. Nero Network подбирает LLM-router под ваш контур и бюджет — без привязки к одному вендору.' ],
      ];
      foreach ( $faq_items as $i => $item ) :
        $fid = 'faq-rag-' . ( $i + 1 );
        ?>
      <div class="rag-faq-item" role="listitem">
        <div class="rag-faq-q" id="<?php echo esc_attr( $fid ); ?>-btn" role="button" tabindex="0" aria-expanded="false" aria-controls="<?php echo esc_attr( $fid ); ?>-panel"><?php echo esc_html( $item['q'] ); ?></div>
        <div class="rag-faq-a" id="<?php echo esc_attr( $fid ); ?>-panel" role="region" aria-labelledby="<?php echo esc_attr( $fid ); ?>-btn"><?php echo esc_html( $item['a'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="rag-section" id="cta">
  <div class="rag-cnt">
    <div class="rag-sh">
      <span class="rag-eyebrow">Следующий шаг</span>
      <h2>Оценить RAG-систему для вашей компании</h2>
      <p>Первый шаг — не «коробка», а аудит источников, сценариев и compliance.</p>
    </div>
    <div class="rag-card nero-ai-reveal" style="margin-bottom:28px;">
      <p>Nero Network предлагает <strong>rag система для бизнеса внедрение под ключ</strong>: аудит → MVP с KPI → production → масштабирование.</p>
      <p style="margin-top:12px;"><strong>На консультации вы получите:</strong></p>
      <ul>
        <li>инвентаризацию источников (Confluence, 1С, CRM, файлы)</li>
        <li>оценку ПДн и рекомендацию контура (on-prem / YandexGPT / GigaChat)</li>
        <li>10–15 тестовых вопросов для пилота</li>
        <li>ориентир бюджета <strong>400 тыс.–2,5 млн ₽</strong></li>
        <li>roadmap: пилот за <strong>3–4 недели</strong> с измеримыми метриками</li>
      </ul>
    </div>
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Внедрим RAG: AI отвечает по вашим документам</p>
        <p class="ym-cta-block__sub">Бесплатный аудит источников, сценариев и compliance. Пилот за 3–4 недели с измеримыми метриками — без «AI на все документы сразу».</p>
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
      </div>
    </div>
  </div>
</section>

</div><!-- .rag-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.rag-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.rag-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.rag-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.rag-faq-q');
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
(function(){
  'use strict';
  var root = document.querySelector('.rag-sistema-dlya-biznesa-page');
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

<?php get_footer(); ?>
