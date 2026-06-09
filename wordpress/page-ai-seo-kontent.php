<?php
/**
 * Template Name: AI SEO-фабрика статей и посадочных страниц: внедрение под ключ
 * Description: SEO-лендинг — внедрение AI SEO-фабрики. Кластеры, статьи, лендинги, FAQ. Разбор 100 ключей Wordstat.
 */

$page_seo_title       = 'AI SEO-фабрика: контент, статьи и лендинги под ключ';
$page_seo_description = 'Внедрение AI SEO-фабрики под ключ: из семантики Wordstat — кластеры, SEO-статьи, посадочные и FAQ. Для агентств и бизнеса. Бесплатный разбор 100 ключей.';

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
	[ 'label' => 'Конвейер', 'href' => '#pipeline-6-steps' ],
	[ 'label' => 'Внедрение', 'href' => '#implementation' ],
	[ 'label' => 'Стек', 'href' => '#stack-2026' ],
	[ 'label' => 'Кейсы', 'href' => '#cases' ],
	[ 'label' => 'Стоимость', 'href' => '#pricing' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Отправить семантику';
$primary_cta_url     = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'Курс по AI-автоматизации';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '';

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
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.aseo-content{
  --aseo-bg:#050711;--aseo-bg2:#080b17;--aseo-surface:rgba(255,255,255,.072);
  --aseo-text:#e6edf7;--aseo-muted:#9aa8bd;--aseo-soft:#c7d2e5;--aseo-heading:#fff;
  --aseo-border:rgba(255,255,255,.10);--aseo-accent:#79f2ff;--aseo-violet:#8b5cf6;--aseo-green:#22c55e;
  --aseo-btn-from:#2563eb;--aseo-btn-to:#7c3aed;--aseo-r:18px;--aseo-r-lg:24px;--aseo-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aseo-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.aseo-content *,.aseo-content *::before,.aseo-content *::after{box-sizing:border-box}
.aseo-content a{color:inherit;text-decoration:none}
.aseo-content a.aseo-ilink{color:var(--aseo-accent);text-decoration:underline;text-underline-offset:3px}
.aseo-content a.aseo-ilink:hover{color:#fff}
.aseo-content p{color:var(--aseo-muted);line-height:1.72;margin:0 0 1em}
.aseo-content p:last-child{margin-bottom:0}
.aseo-content h2,.aseo-content h3,.aseo-content h4{color:var(--aseo-heading);letter-spacing:-.045em;margin:0 0 .7em}
.aseo-content strong{color:var(--aseo-soft)}
.aseo-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.aseo-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aseo-muted);font-size:14.5px;line-height:1.65}
.aseo-content ul li::before{content:'›';position:absolute;left:0;color:var(--aseo-accent);font-weight:700}
.aseo-cnt{width:min(var(--aseo-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.aseo-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.aseo-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.aseo-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.aseo-sh.aseo-left{margin-left:0;text-align:left}
.aseo-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.aseo-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.aseo-sh.aseo-left p{margin-left:0}
.aseo-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aseo-accent);margin-bottom:14px}
.aseo-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.aseo-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.aseo-intro-text{position:relative;padding-left:20px}
.aseo-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aseo-accent),var(--aseo-violet))}
.aseo-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.aseo-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.aseo-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.aseo-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aseo-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.aseo-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aseo-muted);line-height:1.4}
.aseo-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.aseo-intro-grid{grid-template-columns:1fr;gap:36px}.aseo-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.aseo-intro-kpi{grid-template-columns:1fr 1fr}}
.aseo-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.aseo-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.aseo-toc a,.ym-toc a{display:inline-block;padding:9px 18px;background:var(--aseo-surface);border:1px solid var(--aseo-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aseo-muted);transition:border-color .2s,color .2s,background .2s}
.aseo-toc a:hover,.ym-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--aseo-accent);background:rgba(121,242,255,.08)}
.aseo-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aseo-border);border-radius:var(--aseo-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22)}
.aseo-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.aseo-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.aseo-grid-2,.aseo-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.aseo-grid-3{grid-template-columns:1fr 1fr}}
.aseo-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.aseo-table{width:100%;border-collapse:collapse;font-size:14px}
.aseo-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--aseo-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.aseo-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aseo-text);vertical-align:top}
.aseo-table tr:last-child td{border-bottom:none}
.aseo-table tr:hover td{background:rgba(255,255,255,.03)}
.aseo-table .aseo-col-highlight{background:rgba(121,242,255,.06)}
.aseo-compare .aseo-col-highlight{background:rgba(34,197,94,.08);color:var(--aseo-green);font-weight:700}
.aseo-process-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
@media(max-width:900px){.aseo-process-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.aseo-process-grid{grid-template-columns:1fr}}
.aseo-process-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--aseo-r);padding:22px;position:relative;counter-increment:aseoStep}
.aseo-process-grid{counter-reset:aseoStep}
.aseo-process-item::before{content:counter(aseoStep);position:absolute;top:16px;right:16px;width:28px;height:28px;border-radius:50%;background:rgba(121,242,255,.15);color:var(--aseo-accent);font-size:12px;font-weight:800;display:flex;align-items:center;justify-content:center}
.aseo-process-item h3{font-size:16px;margin-bottom:8px;padding-right:36px}
.aseo-process-item p{font-size:14px;margin:0}
.aseo-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.aseo-case-grid{grid-template-columns:1fr}}
.aseo-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.aseo-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aseo-green);margin-bottom:10px}
.aseo-metric-row{display:flex;align-items:baseline;gap:8px;margin-top:10px}
.aseo-metric-row .num{font-size:22px;font-weight:900;color:var(--aseo-accent)}
.aseo-metric-row .lbl{font-size:13px;color:var(--aseo-muted)}
.aseo-risk-check{color:var(--aseo-green);font-weight:700}
.aseo-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.aseo-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.aseo-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aseo-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.aseo-faq-q::after{content:'▾';font-size:13px;color:var(--aseo-accent);transition:transform .25s}
.aseo-faq-item.open .aseo-faq-q::after{transform:rotate(180deg)}
.aseo-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;line-height:1.72}
.aseo-faq-item.open .aseo-faq-a{max-height:600px;padding:0 24px 20px}
.aseo-cta-checklist{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;margin-bottom:32px;list-style:none;padding:0}
.aseo-cta-checklist li{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;color:var(--aseo-muted)}
.aseo-cta-checklist li::before{content:'✓';color:var(--aseo-green);font-weight:800}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--aseo-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--aseo-accent)!important;text-decoration:underline!important}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aseo-btn-from),var(--aseo-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--aseo-text)!important;border:1.5px solid rgba(255,255,255,.18)}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-seo-kontent-page" role="main" tabindex="-1">

<?php
// === АЛИНА HERO — canvas #aseo-factory-canvas + inline CSS (не удалять) ===
require __DIR__ . '/partials/ai-seo-kontent-alina-hero.inc.php';
?>

<div class="aseo-content">

  <section class="aseo-intro" id="intro" aria-label="Введение">
    <div class="aseo-cnt">
      <div class="aseo-intro-grid nero-ai-reveal">
        <div class="aseo-intro-text">
          <p class="aseo-eyebrow">Лонгрид · AI SEO-фабрика</p>
          <p>Семантика Wordstat собрана, кластеры размечены — но между «ключ в таблице» и «опубликованная страница» проходит неделя. <strong>AI SEO-фабрика</strong> Nero Network превращает готовую семантику в кластеры, статьи, лендинги и FAQ с контролем качества и публикацией в CMS.</p>
          <p><strong>Коротко:</strong> внедрение под ключ за <strong>80–300 тыс. ₽</strong>. Первый шаг — <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="ym-link ym-link--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a> и бесплатный <strong>разбор 100 ключей Wordstat</strong>: покажем карту кластеров и приоритеты публикации.</p>
        </div>
        <div class="aseo-intro-kpi" aria-label="KPI AI SEO">
          <div class="aseo-kpi-card"><div class="kv">×9–15</div><div class="kl">ускорение семантики</div><div class="ks">Keys.so кейс</div></div>
          <div class="aseo-kpi-card"><div class="kv">~30 мин</div><div class="kl">на SEO-статью</div><div class="ks">Kokoc / MBS</div></div>
          <div class="aseo-kpi-card"><div class="kv">247</div><div class="kl">страниц за 7 дней</div><div class="ks">Radyant / PlanEco</div></div>
          <div class="aseo-kpi-card"><div class="kv">80–300K</div><div class="kl">ориентир внедрения</div><div class="ks">под ключ</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aseo-toc-outer">
    <div class="aseo-cnt">
      <nav class="aseo-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#problem">Проблема</a>
        <a href="#what-is-ai-seo-factory">Фабрика</a>
        <a href="#pipeline-6-steps">Конвейер</a>
        <a href="#implementation">Внедрение</a>
        <a href="#stack-2026">Стек</a>
        <a href="#pricing">Стоимость</a>
        <a href="#cases">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Разбор ключей</a>
      </nav>
    </div>
  </div>

  <section class="aseo-section" id="problem">
    <div class="aseo-cnt">
      <div class="aseo-sh aseo-left nero-ai-reveal">
        <span class="aseo-eyebrow">Боль рынка</span>
        <h2>Проблема: семантика есть, а статьи и лендинги не успевают</h2>
        <p><strong>Коротко:</strong> у вас уже есть семантика Wordstat, но производство SEO-контента не успевает за амбициями по органике.</p>
        <!-- INTERNAL-LINKS:INSERT -->
      </div>
      <div class="aseo-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="aseo-card">
          <h3>Почему ручное производство тормозит рост</h3>
          <ul>
            <li><strong>Скорость:</strong> SEO-статья вручную — часы и дни; лендинг с FAQ — ещё дольше</li>
            <li><strong>Стоимость:</strong> ФОТ копирайтеров растёт линейно с объёмом страниц</li>
            <li><strong>Непредсказуемость:</strong> кластеры простаивают, конкуренты закрывают запросы раньше</li>
          </ul>
        </div>
        <div class="aseo-card">
          <h3>Где теряются деньги</h3>
          <div class="aseo-table-wrap">
            <table class="aseo-table" aria-label="Цепочка Wordstat → публикация">
              <thead><tr><th>Этап</th><th>Где теряется время</th></tr></thead>
              <tbody>
                <tr><td>Wordstat / Keys.so</td><td>Ручная классификация интентов</td></tr>
                <tr><td>Excel / Sheets</td><td>Дубли, спорные кластеры</td></tr>
                <tr><td>Копирайтер + редактор</td><td>Очередь, правки, переспам</td></tr>
                <tr><td>CMS</td><td>Ручной ввод meta и Schema</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="aseo-section aseo-section-alt" id="what-is-ai-seo-factory">
    <div class="aseo-cnt">
      <div class="aseo-sh nero-ai-reveal">
        <span class="aseo-eyebrow">Определение</span>
        <h2>AI SEO-фабрика: что это и что вы получаете</h2>
        <p><strong>AI SEO-фабрика</strong> — конвейер на базе AI-агентов: семантика Wordstat → кластеры → структура сайта → статьи, лендинги, FAQ → QA → публикация в CMS.</p>
      </div>
      <div class="aseo-table-wrap nero-ai-reveal">
        <table class="aseo-table" aria-label="Типы контента на выходе">
          <thead><tr><th>Тип</th><th>Назначение</th><th>Примеры</th></tr></thead>
          <tbody>
            <tr><td><strong>AI seo статьи</strong></td><td>Информационные кластеры</td><td>Гайды, «как выбрать…»</td></tr>
            <tr><td><strong>AI посадочные</strong></td><td>Коммерческие кластеры</td><td>Услуга + оффер + CTA</td></tr>
            <tr><td><strong>FAQ-блоки</strong></td><td>НЧ, GEO/AEO</td><td>Вопросы из Wordstat</td></tr>
            <tr><td><strong>Хабы</strong></td><td>Перелинковка</td><td>Hub-and-spoke</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

<?php
// === БОРИС BLOCK START — вставка после секции #what-is-ai-seo-factory ===
require __DIR__ . '/partials/ai-seo-kontent-boris-block.inc.php';
// === БОРИС BLOCK END ===
?>

  <section class="aseo-section" id="pipeline-6-steps">
    <div class="aseo-cnt">
      <div class="aseo-sh nero-ai-reveal">
        <span class="aseo-eyebrow">6 шагов</span>
        <h2>Как работает конвейер: 6 шагов от семантики до публикации</h2>
        <p><strong>Коротко:</strong> семантика → кластеры → структура → генерация → QA → публикация в CMS.</p>
      </div>
      <div class="aseo-process-grid nero-ai-reveal">
        <article class="aseo-process-item nero-ai-process-item"><h3>Импорт и кластеризация</h3><p>Эмбеддинги, TF-IDF, LLM-валидация. Дедупликация мусорных фраз.</p></article>
        <article class="aseo-process-item nero-ai-process-item"><h3>Карта сайта и ТЗ</h3><p>Тип страницы, H1, meta, схема перелинковки hub-and-spoke.</p></article>
        <article class="aseo-process-item nero-ai-process-item"><h3>Генерация + QA</h3><p>Агент-автор и редактор: антипереспам, фактчек, brand voice.</p></article>
        <article class="aseo-process-item nero-ai-process-item"><h3>FAQ и Schema</h3><p>FAQPage, Article, перелинковка под GEO/AEO.</p></article>
        <article class="aseo-process-item nero-ai-process-item"><h3>Интеграция CMS/CRM</h3><p>WordPress, Tilda, Bitrix; лиды в amoCRM / Bitrix24. Заявки из почты маршрутизируются через <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-obrabotka-email-crm/' ) ); ?>" class="aseo-ilink">AI-обработку входящей почты в CRM</a>.</p></article>
        <article class="aseo-process-item nero-ai-process-item"><h3>Публикация и мониторинг</h3><p>Расписание, Метрика, Topvisor, индексация.</p></article>
      </div>
    </div>
  </section>

  <div class="ym-cta-block ym-cta-block--primary" id="cta-pipeline">
    <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Разберём вашу семантику — бесплатно</p>
      <p class="ym-cta-block__sub">Отправьте выгрузку Wordstat или таблицу с ключами: покажем, как из 100 фраз собираются кластеры, типы страниц и приоритеты публикации. Без обязательств.</p>
      <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
    </div>
  </div>

  <section class="aseo-section aseo-section-alt" id="implementation">
    <div class="aseo-cnt">
      <div class="aseo-sh aseo-left nero-ai-reveal">
        <span class="aseo-eyebrow">Под ключ</span>
        <h2>Внедрение AI SEO-контента под ключ: сроки, этапы, результат</h2>
        <p>Старт — лид-магнит «Разбор 100 ключей Wordstat». Пилот 50–100 кластеров, калибровка агентов, обучение команды human-in-the-loop. Контент-конвейер часто идёт параллельно с автоматизацией учёта — например, <a href="<?php echo esc_url( home_url( '/ai-1c-erp/' ) ); ?>" class="aseo-ilink">AI-агент для 1С и ERP</a>.</p>
      </div>
      <div class="aseo-grid-3 nero-ai-reveal" style="margin-top:32px">
        <div class="aseo-card"><h3>Аудит семантики</h3><p>Карта кластеров, пробелы CMS, приоритеты публикации — 3–5 рабочих дней.</p></div>
        <div class="aseo-card"><h3>Настройка агентов</h3><p>Кластеризатор → архитектор → автор → редактор. Эталонная страница + масштаб.</p></div>
        <div class="aseo-card"><h3>Передача конвейера</h3><p>Регламент модерации, дашборд статусов, поддержка при масштабировании.</p></div>
      </div>
      <?php if ( $secondary_cta_url !== '' ) : ?>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie" style="margin-top:32px">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите понимать AI SEO-конвейер до старта проекта?</p>
          <p class="ym-cta-block__sub">Если команда хочет разобраться в n8n, промптах агентов и human-in-the-loop до внедрения фабрики — посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_primary_cta_link_attrs( $secondary_cta_url ); ?>><?php echo esc_html( $secondary_cta_label ); ?></a>. Это ускоряет пилот и снижает риск переделок workflow.</p>
        </div>
      </aside>
      <?php endif; ?>
    </div>
  </section>

  <section class="aseo-section" id="stack-2026">
    <div class="aseo-cnt">
      <div class="aseo-sh nero-ai-reveal">
        <span class="aseo-eyebrow">Стек 2026</span>
        <h2>Нейросеть для SEO: инструменты и стек 2026</h2>
        <p>OpenAI Agents SDK, n8n/Make, Wordstat API, мульти-модельный пайплайн с guardrails и human-in-the-loop. На корпоративном масштабе многошаговые AI-агенты уже проверены в enterprise — в разборе <a href="<?php echo esc_url( home_url( '/kpmg-claude-vnedrenie-ai-276-tysyach/' ) ); ?>" class="aseo-ilink">KPMG и Claude: уроки AI для бизнеса</a> показаны managed-агенты и цифровые шлюзы.</p>
      </div>
      <div class="aseo-table-wrap nero-ai-reveal">
        <table class="aseo-table" aria-label="Стек AI SEO-фабрики">
          <thead><tr><th>Компонент</th><th>Роль</th><th>Примеры</th></tr></thead>
          <tbody>
            <tr><td>LLM</td><td>Генерация, классификация</td><td>GPT, Claude, Gemini Flash</td></tr>
            <tr><td>Оркестрация</td><td>Связка шагов</td><td>Agents SDK, n8n, Make</td></tr>
            <tr><td>Семантика</td><td>Источник ключей</td><td>Wordstat, Keys.so, Sheets</td></tr>
            <tr><td>CMS / CRM</td><td>Публикация и лиды</td><td>WordPress, amoCRM, Bitrix24</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aseo-section aseo-section-alt" id="integrations">
    <div class="aseo-cnt">
      <div class="aseo-sh aseo-left nero-ai-reveal">
        <span class="aseo-eyebrow">Интеграции</span>
        <h2>Интеграции: CRM, CMS и таблицы с семантикой</h2>
        <p>Google Sheets — хаб статусов кластеров. Публикация через API в WordPress / Tilda. Лиды с лендингов — в CRM с меткой кластера; для amoCRM см. отдельный сценарий <a href="<?php echo esc_url( home_url( '/vnedrenie-ai-amocrm/' ) ); ?>" class="aseo-ilink">внедрения AI-агента в amoCRM под ключ</a>.</p>
      </div>
      <div class="aseo-grid-2 nero-ai-reveal" style="margin-top:32px">
        <div class="aseo-card">
          <h3>Wordstat / Sheets → фабрика → CMS</h3>
          <p>Семантика импортируется в таблицу, агенты пишут статусы кластеров, готовые страницы уходят в WordPress или Tilda через API.</p>
        </div>
        <div class="aseo-card">
          <h3>CRM и планировщики</h3>
          <p>Заявки с новых лендингов попадают в amoCRM или Bitrix24. Расписание публикаций — 3–5 материалов в день без роста штата.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aseo-section" id="for-whom">
    <div class="aseo-cnt">
      <div class="aseo-sh nero-ai-reveal">
        <span class="aseo-eyebrow">Аудитория</span>
        <h2>Для кого услуга: SEO-агентства, владельцы сайтов, контент-проекты</h2>
      </div>
      <div class="aseo-grid-3 nero-ai-reveal">
        <div class="aseo-card"><h3>SEO-агентства</h3><p>Тендеры на тысячи страниц без раздувания штата. Keys.so: 450K кластеров за 3 месяца.</p></div>
        <div class="aseo-card"><h3>Малый бизнес</h3><p><strong>AI seo контент для малого бизнеса</strong> — ниша есть, отдела контента нет. Окупаемость от ~1 000 кластеров.</p></div>
        <div class="aseo-card"><h3>Контентные медиа</h3><p>Programmatic SEO под Wordstat и WordPress: справочники, гайды, коммерческие лендинги.</p></div>
      </div>
    </div>
  </section>

  <section class="aseo-section aseo-section-alt" id="pricing">
    <div class="aseo-cnt">
      <div class="aseo-sh nero-ai-reveal">
        <span class="aseo-eyebrow">Бюджет</span>
        <h2>Стоимость и ориентиры: ai seo контент цена</h2>
        <p>Разовое внедрение <strong>80–300 тыс. ₽</strong> — аудит, конвейер, пилот, интеграции, обучение.</p>
      </div>
      <div class="aseo-table-wrap nero-ai-reveal">
        <table class="aseo-table aseo-compare" aria-label="ROI ручной процесс vs AI SEO-фабрика">
          <thead><tr><th>Метрика</th><th>Вручную</th><th class="aseo-col-highlight">AI SEO-фабрика</th></tr></thead>
          <tbody>
            <tr><td>Время на кластер (семантика)</td><td>~10 мин</td><td class="aseo-col-highlight">~1 мин</td></tr>
            <tr><td>Время на статью</td><td>4–8 часов</td><td class="aseo-col-highlight">~30 мин + модерация</td></tr>
            <tr><td>Масштаб без роста штата</td><td>Нет</td><td class="aseo-col-highlight">Да</td></tr>
            <tr><td>Предсказуемость календаря</td><td>Низкая</td><td class="aseo-col-highlight">Высокая</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <div class="ym-cta-block ym-cta-block--dual" id="cta-pricing">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Узнайте бюджет под ваш объём семантики</p>
      <p class="ym-cta-block__sub">На бесплатном разборе 100 ключей Wordstat вернём карту кластеров и коммерческое предложение с вилкой 80–300 тыс. ₽ под ваш масштаб.</p>
      <div class="ym-cta-block__actions">
        <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы по внедрению</a>
      </div>
    </div>
  </div>

  <section class="aseo-section" id="cases">
    <div class="aseo-cnt">
      <div class="aseo-sh nero-ai-reveal">
        <span class="aseo-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI SEO-контента</h2>
      </div>
      <div class="aseo-case-grid nero-ai-reveal">
        <div class="aseo-case-card">
          <div class="aseo-case-tag">Keys.so + LLM</div>
          <h3>«Умный маркетинг»</h3>
          <p>450 000 кластеров, 690 000 страниц за 3 месяца. ~1 мин/кластер vs ~10 мин вручную.</p>
          <div class="aseo-metric-row"><span class="num">450K</span><span class="lbl">кластеров</span></div>
        </div>
        <div class="aseo-case-card">
          <div class="aseo-case-tag">Kokoc / MBS</div>
          <h3>Онлайн-школа</h3>
          <p>Визиты ×11,4; ~60% нового ядра в топ-10; статья за ~30 минут.</p>
          <div class="aseo-metric-row"><span class="num">×11,4</span><span class="lbl">трафик</span></div>
        </div>
        <div class="aseo-case-card">
          <div class="aseo-case-tag">Radyant / AirOps</div>
          <h3>PlanEco</h3>
          <p>247 AI-страниц за 7 дней; 141 в топ-3 через 3 дня после публикации.</p>
          <div class="aseo-metric-row"><span class="num">247</span><span class="lbl">страниц / 7 дней</span></div>
        </div>
      </div>
    </div>
  </section>

  <section class="aseo-section aseo-section-alt" id="risks">
    <div class="aseo-cnt">
      <div class="aseo-sh nero-ai-reveal">
        <span class="aseo-eyebrow">Честно о рисках</span>
        <h2>Риски и как мы их закрываем</h2>
      </div>
      <div class="aseo-table-wrap nero-ai-reveal">
        <table class="aseo-table" aria-label="Риски и митигация">
          <thead><tr><th>Риск</th><th>Как закрываем</th></tr></thead>
          <tbody>
            <tr><td>Дубли контента</td><td><span class="aseo-risk-check">✓</span> Дедупликация, уникальная структура URL</td></tr>
            <tr><td>Переспам ключей</td><td><span class="aseo-risk-check">✓</span> Агент-редактор с guardrails</td></tr>
            <tr><td>Галлюцинации</td><td><span class="aseo-risk-check">✓</span> Фактчек, WebSearchTool, human gate 5–10%</td></tr>
            <tr><td>Scaled content abuse</td><td><span class="aseo-risk-check">✓</span> 100% модерация ВЧ-кластеров</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aseo-section" id="faq">
    <div class="aseo-cnt">
      <div class="aseo-sh nero-ai-reveal">
        <span class="aseo-eyebrow">FAQ</span>
        <h2>FAQ: как внедрить AI SEO-контент</h2>
      </div>
      <div class="aseo-faq nero-ai-reveal">
        <div class="aseo-faq-item"><div class="aseo-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai seo контент в существующий сайт?</div><div class="aseo-faq-a"><p>Передаёте семантику и доступ к CMS. Пилот 50–100 страниц, обучение команды. Существующие URL не затрагиваются — фабрика закрывает новые кластеры.</p></div></div>
        <div class="aseo-faq-item"><div class="aseo-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли своя семантика?</div><div class="aseo-faq-a"><p>Работаем с вашей семантикой — фокус на производстве контента, не на замене SEO-аудита.</p></div></div>
        <div class="aseo-faq-item"><div class="aseo-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько до первых публикаций?</div><div class="aseo-faq-a"><p>Разбор 100 ключей — 3–5 дней. Пилот — 2–4 недели. Полное внедрение — 4–8 недель.</p></div></div>
        <div class="aseo-faq-item"><div class="aseo-faq-q" tabindex="0" role="button" aria-expanded="false">Только статьи или только лендинги?</div><div class="aseo-faq-a"><p>Конвейер модульный: можно запустить только статьи или только посадочные страницы.</p></div></div>
        <div class="aseo-faq-item"><div class="aseo-faq-q" tabindex="0" role="button" aria-expanded="false">Работаете ли с Яндексом и Google одновременно?</div><div class="aseo-faq-a"><p>Да. Структура контента, E-E-A-T, Schema.org и FAQ закрывают требования обеих систем. GEO/AEO-блоки для Алисы и AI Overview дополняют, а не заменяют SEO-фабрику.</p></div></div>
        <div class="aseo-faq-item"><div class="aseo-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от GEO-услуг?</div><div class="aseo-faq-a"><p>GEO — видимость в ответах нейросетей. AI SEO-фабрика — производство страниц из Wordstat: кластеры → публикация.</p></div></div>
        <div class="aseo-faq-item"><div class="aseo-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от SaaS «контентзавода»?</div><div class="aseo-faq-a"><p>SaaS мониторит новости и генерирует шаблонные статьи. Nero строит кастомную фабрику под вашу семантику Wordstat и типы страниц — не новостной поток.</p></div></div>
        <div class="aseo-faq-item"><div class="aseo-faq-q" tabindex="0" role="button" aria-expanded="false">ChatGPT и так напишет — зачем платить?</div><div class="aseo-faq-a"><p>Фабрика даёт систему: кластеризация, карта сайта, QA, CMS, CRM, аналитика по кластерам — не разовый черновик.</p></div></div>
      </div>
    </div>
  </section>

  <section class="aseo-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="aseo-cnt" style="text-align:center">
      <span class="aseo-eyebrow">Лид-магнит</span>
      <h2 style="font-size:clamp(28px,4.2vw,52px);margin:14px auto 16px;max-width:720px">Разбор 100 ключей Wordstat — бесплатно</h2>
      <p style="max-width:580px;margin:0 auto 28px;font-size:16px">Покажем карту кластеров, типы страниц и вилку 80–300 тыс. ₽ под ваш объём семантики.</p>
      <ul class="aseo-cta-checklist">
        <li>Карта кластеров за 3–5 дней</li>
        <li>Типы страниц и приоритеты</li>
        <li>Оценка сроков пилота</li>
        <li>Без обязательств</li>
      </ul>
      <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent" style="font-size:16px;padding:16px 36px"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
    </div>
  </section>

</div><!-- /.aseo-content -->

<!-- SCHEMA-MARKUP:INSERT -->

</main>

<?php nero_ai_echo_theme_scripts(); ?>

<?php require __DIR__ . '/partials/ai-seo-kontent-alina-hero-script.inc.php'; ?>

<script>
document.addEventListener('DOMContentLoaded',function(){
  document.querySelectorAll('.aseo-faq-q').forEach(function(q){
    q.addEventListener('click',function(){q.parentElement.classList.toggle('open');});
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();q.parentElement.classList.toggle('open');}});
  });
});
</script>

<?php get_footer(); ?>
