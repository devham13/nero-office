#!/usr/bin/env python3
"""Generate page-ai-obuchenie-prodavcov.php for Natasha pipeline."""
from pathlib import Path

ROOT = Path('/workspace')
alina = (ROOT / '.cursor/nero-network-fragments/alina.md').read_text()
boris = (ROOT / '.cursor/nero-network-fragments/boris.md').read_text()

hero_block = alina.split('```html\n', 1)[1].split('\n```\n', 1)[0]
hi = hero_block.rfind('<script>')
hero_section = hero_block[:hi].rstrip()
hero_js = hero_block[hi:]
boris_html = boris.split('```html\n', 1)[1].split('\n```\n', 1)[0]

AOP_CSS = r'''
/* Скрыть шапку Kadence */
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

.aop-content{
  --aop-bg:#050711;--aop-bg2:#080b17;--aop-bg3:#0a0e1c;
  --aop-surface:rgba(255,255,255,.072);--aop-surface2:rgba(255,255,255,.108);
  --aop-text:#e6edf7;--aop-muted:#9aa8bd;--aop-soft:#c7d2e5;--aop-heading:#fff;
  --aop-border:rgba(255,255,255,.10);--aop-border-s:rgba(255,255,255,.18);
  --aop-accent:#79f2ff;--aop-violet:#8b5cf6;--aop-green:#22c55e;--aop-cyan:#79f2ff;
  --aop-btn-from:#2563eb;--aop-btn-to:#7c3aed;
  --aop-shadow:0 24px 72px rgba(0,0,0,.4);
  --aop-r:18px;--aop-r-lg:24px;--aop-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aop-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aop-content *,.aop-content *::before,.aop-content *::after{box-sizing:border-box;}
.aop-content a{color:inherit;text-decoration:none;}
.aop-content p{color:var(--aop-muted);line-height:1.72;margin:0 0 1em;}
.aop-content p:last-child{margin-bottom:0;}
.aop-content h2,.aop-content h3,.aop-content h4{color:var(--aop-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aop-content strong{color:var(--aop-soft);}
.aop-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.aop-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aop-muted);font-size:14.5px;line-height:1.65;}
.aop-content ul li::before{content:'›';position:absolute;left:0;color:var(--aop-accent);font-weight:700;}
.aop-cnt{width:min(var(--aop-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aop-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aop-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aop-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aop-sh.aop-left{margin-left:0;text-align:left;}
.aop-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aop-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aop-sh.aop-left p{margin-left:0;}
.aop-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aop-accent);margin-bottom:14px;}
.aop-gt{background:linear-gradient(92deg,#fff 0%,var(--aop-accent) 44%,var(--aop-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.aop-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aop-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aop-intro-text{position:relative;padding-left:20px;}
.aop-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aop-accent),var(--aop-violet));}
.aop-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--aop-muted);margin-bottom:1em;}
.aop-intro-text p:last-child{margin-bottom:0;color:var(--aop-soft);}
.aop-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aop-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.aop-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aop-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.aop-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aop-muted);line-height:1.4;}
.aop-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.aop-intro-grid{grid-template-columns:1fr;gap:36px;}.aop-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.aop-intro-kpi{grid-template-columns:1fr 1fr;}}
.aop-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aop-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aop-toc a{display:inline-block;padding:9px 18px;background:var(--aop-surface);border:1px solid var(--aop-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aop-muted);transition:border-color .2s,color .2s,background .2s;}
.aop-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--aop-accent);background:rgba(121,242,255,.08);}
.aop-callout{background:linear-gradient(135deg,rgba(121,242,255,.1),rgba(139,92,246,.08));border:1px solid rgba(121,242,255,.25);border-radius:var(--aop-r-lg);padding:24px 28px;margin:24px 0;}
.aop-callout p{margin:0;color:var(--aop-soft);text-align:left!important;}
.aop-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aop-border);border-radius:var(--aop-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.aop-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px);}
.aop-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aop-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.aop-grid-2,.aop-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.aop-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aop-grid-3{grid-template-columns:1fr;}}
.aop-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aop-table{width:100%;border-collapse:collapse;font-size:14px;}
.aop-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--aop-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.aop-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aop-text);vertical-align:top;}
.aop-table tr:last-child td{border-bottom:none;}
.aop-table tr:hover td{background:rgba(255,255,255,.03);}
.aop-steps{counter-reset:aopstep;display:grid;gap:14px;margin:28px 0;}
.aop-step{display:grid;grid-template-columns:44px 1fr;gap:16px;padding:18px 20px;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:16px;}
.aop-step::before{counter-increment:aopstep;content:counter(aopstep);display:grid;place-items:center;width:44px;height:44px;border-radius:12px;background:rgba(121,242,255,.12);color:var(--aop-accent);font-weight:800;font-size:16px;}
.aop-step h4{margin:0 0 6px;font-size:15px;}
.aop-step p{margin:0;font-size:14px;}
.aop-timeline{position:relative;padding-left:40px;}
.aop-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aop-accent),var(--aop-violet));opacity:.35;border-radius:2px;}
.aop-tl-item{position:relative;margin-bottom:32px;}
.aop-tl-item:last-child{margin-bottom:0;}
.aop-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aop-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.aop-tl-item h3{font-size:17px;margin-bottom:8px;}
.aop-tl-item p{font-size:14.5px;margin:0;}
.aop-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.aop-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.aop-case-grid{grid-template-columns:1fr;}}
.aop-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.aop-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.aop-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aop-green);margin-bottom:10px;}
.aop-case-card h3{font-size:16px;margin-bottom:14px;}
.aop-price-band{display:inline-block;padding:12px 24px;border-radius:999px;background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.35);color:#86efac;font-size:clamp(18px,2.5vw,24px);font-weight:800;margin:16px 0 24px;}
.aop-test-box{border:2px solid rgba(34,197,94,.35);border-radius:var(--aop-r-lg);padding:36px;background:rgba(34,197,94,.06);}
.aop-badge-row{display:flex;flex-wrap:wrap;gap:10px;margin:20px 0;}
.aop-badge{display:inline-flex;padding:8px 14px;border-radius:999px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);font-size:12px;font-weight:700;color:var(--aop-soft);}
.aop-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aop-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.aop-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aop-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.aop-faq-q::after{content:'▾';font-size:13px;color:var(--aop-accent);flex-shrink:0;transition:transform .25s;}
.aop-faq-item.open .aop-faq-q::after{transform:rotate(180deg);}
.aop-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--aop-muted);line-height:1.72;}
.aop-faq-item.open .aop-faq-a{max-height:800px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--aop-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aop-btn-from),var(--aop-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-link--accent{color:var(--aop-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
'''

php_header = '''<?php
/**
 * Template Name: AI-обучение продавцов: тренажёр знаний продукта под ключ
 * Description: SEO-лендинг — AI-тренажёр знаний продукта для продавцов. Тест, role-play, CRM. Внедрение от 150 тыс. ₽.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-обучение продавцов: тренажёр знаний продукта под ключ';
$page_seo_description = 'AI-тренажёр знаний продукта для продавцов под ключ: обучение менеджеров, разбор возражений, оценка ответов. Тест для отдела продаж. Внедрение от 150 тыс. ₽.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\\n";
    echo '<meta property="og:type" content="article" />' . "\\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Зачем', 'href' => '#zachem'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'CRM', 'href' => '#integracii'],
    ['label' => 'Цена', 'href' => '#ceny'],
    ['label' => 'Тест', 'href' => '#test'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить продавцов';
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
''' + AOP_CSS + '''
</style>

<main id="primary" class="site-main nero-ai-home-page ai-obuchenie-prodavcov-page" role="main" tabindex="-1">

'''

php_footer = '''
  <!-- INTERNAL-LINKS:INSERT -->

  <!-- SCHEMA-MARKUP:INSERT -->

</div>

</main>

''' + hero_js + '''

<script>
(function(){
  document.querySelectorAll('.aop-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aop-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aop-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aop-faq-q');
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
  var root = document.querySelector('.ai-obuchenie-prodavcov-page') || document.querySelector('.aop-content');
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
'''

content = r'''
<div class="aop-content">

  <section class="aop-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aop-cnt">
      <div class="aop-intro-grid nero-ai-reveal">
        <div class="aop-intro-text">
          <p class="aop-eyebrow">Лонгрид · ai обучение продавцов</p>
          <p><strong>Коротко:</strong> AI-тренажёр знаний продукта загружает каталог, скрипты и FAQ компании и тренирует менеджеров в диалоге с «цифровым клиентом». Каждый ответ оценивается автоматически — факты, структура, работа с возражениями. Внедрение под ключ: тест знаний, интеграция в amoCRM или Битрикс24, допуск к клиентам только после порога.</p>
          <p>Новый менеджер быстро путает комплектации и устаревшие цены — клиенты получают противоречивые консультации. В 2026 году sales-команды решают это не разовым тренингом, а <strong>внедрением AI в обучение продавцов</strong>: ежедневная практика, объективная оценка, результат в CRM.</p>
        </div>
        <div class="aop-intro-kpi" aria-label="Метрики Salesforce State of Sales 2026">
          <div class="aop-kpi-card"><div class="kv">47%</div><div class="kl">без roleplay перед звонком</div><div class="ks">Salesforce 2026</div></div>
          <div class="aop-kpi-card"><div class="kv">46%</div><div class="kl">редко получают обратную связь</div><div class="ks">Salesforce 2026</div></div>
          <div class="aop-kpi-card"><div class="kv">3–9 мес</div><div class="kl">ramp time без онбординга</div><div class="ks">Careertrainer 2026</div></div>
          <div class="aop-kpi-card"><div class="kv">−34%</div><div class="kl">ускорение с программой</div><div class="ks">формальный онбординг</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="aop-toc-outer">
    <div class="aop-cnt">
      <nav class="aop-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">CRM</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#test">Тест</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="aop-section" id="zachem">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Боль отдела продаж</span>
        <h2>Зачем отделу продаж AI-тренажёр знаний продукта</h2>
        <p><strong>AI-тренажёр знаний продукта</strong> — нейросеть для обучения продажам, которая проверяет готовность консультировать: знает ли продавец каталог, отличия от конкурентов, условия и типовые возражения.</p>
      </div>

      <div class="aop-callout nero-ai-reveal">
        <p>Главная боль: новые продавцы долго изучают продукт и ошибаются в консультациях. Живой role-play с РОПом не масштабируется — у одного руководителя десяток менеджеров, у сети сотни точек.</p>
      </div>

      <div class="aop-grid-2 nero-ai-reveal">
        <div class="aop-card">
          <h3>Сколько теряет бизнес на долгом обучении менеджеров</h3>
          <p>Ramp time без структурированного онбординга — <strong>3–9 месяцев</strong>. До 33% новых сотрудников уходят в первые 90 дней при плохой адаптации. Пока менеджер «набирает руку» — зарплата без плана, испорченные лиды, нагрузка на РОПа до 10 часов в неделю на наставничество.</p>
        </div>
        <div class="aop-card nero-ai-delay-1">
          <h3>Почему классические курсы не закрывают знание продукта</h3>
          <p>87% навыков из разового занятия теряется за 30 дней без закрепления. LMS фиксирует просмотр, а не умение ответить «чем ваша модель отличается от конкурента?». Нужен <strong>ai тренажер продаж</strong> с проверкой открытых ответов.</p>
        </div>
      </div>

      <div class="aop-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aop-table">
          <thead><tr><th>Формат</th><th>Что измеряет</th><th>Слабое место</th></tr></thead>
          <tbody>
            <tr><td>Разовый тренинг</td><td>Вовлечённость в зале</td><td>Нет ежедневной практики</td></tr>
            <tr><td>LMS (видео + тест)</td><td>Факт просмотра</td><td>Можно угадать ответ</td></tr>
            <tr><td>Речевая аналитика</td><td>Ошибки после факта</td><td>Не обучает до выхода в поле</td></tr>
            <tr><td>AI-тренажёр знаний продукта</td><td>Применение в диалоге</td><td>Требует настройки под каталог</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aop-section aop-section-alt" id="kak-rabotaet">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Механика тренажёра</span>
        <h2>Что такое AI-обучение продавцов и как работает тренажёр</h2>
        <p><strong>AI обучение продавцов</strong> — не «нейропродавец» в переписке с клиентом, а <strong>нейротренер</strong>: готовит живого менеджера, проверяет знание продукта и допускает к работе после порога.</p>
      </div>

      <p class="nero-ai-reveal" style="max-width:820px;margin:0 auto 24px;text-align:center;">Система на RAG: каталог, прайс, FAQ, battlecards, скрипты. AI индексирует материалы, генерирует сценарии и оценивает ответы строго по вашим документам.</p>

      <div class="aop-steps nero-ai-reveal">
        <div class="aop-step"><div><h4>Загрузка базы</h4><p>РОП загружает продуктовую базу → AI индексирует знания.</p></div></div>
        <div class="aop-step"><div><h4>Тест и сценарии</h4><p>Система генерирует тест → методолог утверждает сценарии.</p></div></div>
        <div class="aop-step"><div><h4>Входной контроль</h4><p>Продавец проходит тест знаний продукта.</p></div></div>
        <div class="aop-step"><div><h4>Role-play</h4><p>Тренировка в диалоге с AI-клиентом по слабым темам.</p></div></div>
        <div class="aop-step"><div><h4>AI-оценка</h4><p>Каждый ответ оценивается → дашборд РОПу → персональный план.</p></div></div>
        <div class="aop-step"><div><h4>Допуск в CRM</h4><p>Порог 80/100 → статус «допущен» в amoCRM / Битрикс24.</p></div></div>
      </div>

      <div class="aop-card nero-ai-reveal" style="margin-top:28px;">
        <h3 id="simulyaciya">Симуляция диалогов и разбор возражений</h3>
        <p><strong>Нейросеть для обучения продажам</strong> играет роль клиента: уточняющие вопросы, возражения «дорого», «нет бюджета», «не срочно». Сценарии по этапам сделки: контакт → потребности → оффер → возражения → закрытие.</p>
        <ul>
          <li>консультация по характеристикам и комплектациям;</li>
          <li>сравнение с конкурентом по battlecards;</li>
          <li>возражение по цене с аргументами из скрипта;</li>
          <li>upsell, кросс-продажа, эскалация нестандартного запроса.</li>
        </ul>
      </div>

      <div class="aop-card nero-ai-reveal nero-ai-delay-1" style="margin-top:20px;">
        <h3 id="ocenka">Автоматическая оценка ответов менеджера</h3>
        <p>AI-оценщик проверяет открытый ответ по чек-листу: факты о продукте, структура, работа с возражением, тон бренда. Шкала 0–100 плюс текстовый разбор — что верно, где ошибка, какой фрагмент базы перечитать.</p>
      </div>

      <div class="aop-card nero-ai-reveal nero-ai-delay-2" style="margin-top:20px;">
        <h3 id="skripty">Обучение по скриптам и актуальной базе продукта</h3>
        <p>Тренажёр подтягивает актуальную линейку: при обновлении каталога база переиндексируется. Форматы: веб-тренажёр для глубокой отработки, Telegram-бот для сессий 3–5 минут между сменами, голосовой режим через Yandex SpeechKit.</p>
      </div>

''' + boris_html + r'''

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-kak-rabotaet">
        <div class="ym-cta-block__icon" aria-hidden="true">🎯</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверьте, насколько ваши продавцы знают продукт</p>
          <p class="ym-cta-block__sub">Демо-тест на 10–15 вопросов из вашей базы знаний: AI оценит открытые ответы, покажет пробелы и предложит сценарии тренировки. Без обязательств — первый шаг к внедрению тренажёра под ключ.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="aop-section" id="dlya-kogo">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит внедрение AI в обучение продаж</h2>
        <p>Окупается там, где ошибка в консультации стоит денег, а масштабировать живое наставничество сложно: отделы продаж, розница, дилеры, франшизы.</p>
      </div>
      <div class="aop-grid-3 nero-ai-reveal">
        <div class="aop-card">
          <div style="font-size:28px;margin-bottom:12px;" aria-hidden="true">🏪</div>
          <h3>Розница и сети с высокой текучкой</h3>
          <p>Единый стандарт знаний в каждом магазине. Кейс «Пятёрочка»: время обучения с 1,5 ч до 25 мин, экономия 8 500 человеко-часов в год.</p>
        </div>
        <div class="aop-card nero-ai-delay-1">
          <div style="font-size:28px;margin-bottom:12px;" aria-hidden="true">🤝</div>
          <h3>Дилерские сети и франшизы</h3>
          <p>Путь «тест → тренажёр → допуск в CRM». Партнёр не получает горячие лиды, пока не наберёт порог по знанию продукта — статус в amoCRM или Битрикс24.</p>
        </div>
        <div class="aop-card nero-ai-delay-2">
          <div style="font-size:28px;margin-bottom:12px;" aria-hidden="true">🏢</div>
          <h3>AI обучение продавцов для малого бизнеса</h3>
          <p>Кастомный тренажёр под каталог с пилотом на 5–15 человек. Ориентир <strong>150–450 тыс. ₽</strong> — часто дешевле трёх месяцев непродуктивного новичка.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aop-section aop-section-alt" id="etapy">
    <div class="aop-cnt">
      <div class="aop-sh aop-left nero-ai-reveal">
        <span class="aop-eyebrow">Под ключ</span>
        <h2>Внедрение AI-обучения продавцов под ключ</h2>
        <p>От аудита материалов до пилота и интеграции с CRM. Срок типового проекта — <strong>2–4 недели</strong> на пилот.</p>
      </div>
      <div class="aop-card nero-ai-reveal">
        <div class="aop-timeline">
          <div class="aop-tl-item"><div class="aop-tl-dot"></div><h3>Аудит продукта, скриптов и типовых ошибок</h3><p>3–5 дней: каталог, прайс, FAQ, топ-10 возражений, чек-лист оценки РОПа.</p></div>
          <div class="aop-tl-item"><div class="aop-tl-dot"></div><h3>Настройка тренажёра и сценариев</h3><p>1–2 недели: RAG-база, 5–10 сценариев, AI-оценщик. Параллельно — лид-магнит: тест на 10–15 вопросов.</p></div>
          <div class="aop-tl-item"><div class="aop-tl-dot"></div><h3>Запуск пилота и обучение РОПа</h3><p>2–4 недели на 5–15 продавцах: дашборд, корректировка сценариев, масштабирование на отдел.</p></div>
        </div>
      </div>
      <div class="aop-card nero-ai-reveal" style="margin-top:24px;">
        <h3>AI обучение продавцов без программиста — что входит в услугу</h3>
        <p>Команда клиента предоставляет документы и утверждает сценарии; интегратор настраивает техническую часть: RAG, тренажёр, тест, веб или Telegram, CRM, документация, поддержка пилота.</p>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">РОП хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед заказом тренажёра полезно разобраться в промптах, RAG-базе и human-in-the-loop — так быстрее согласуются сценарии и чек-листы оценки. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="aop-section" id="integracii">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Сквозной онбординг</span>
        <h2>Интеграция с CRM и контроль результатов</h2>
        <p><strong>AI обучение продавцов интеграция crm</strong> — часть процесса: статусы обучения, задачи РОПу, привязка к карточке менеджера.</p>
      </div>
      <div class="aop-badge-row nero-ai-reveal" style="justify-content:center;">
        <span class="aop-badge">тест → тренажёр → CRM</span>
        <span class="aop-badge">amoCRM</span>
        <span class="aop-badge">Битрикс24</span>
        <span class="aop-badge">Make / n8n</span>
      </div>
      <div class="aop-table-wrap nero-ai-reveal">
        <table class="aop-table">
          <thead><tr><th>Метрика</th><th>Что показывает</th></tr></thead>
          <tbody>
            <tr><td>Time to productivity</td><td>Дней до выхода на план / порога сертификации</td></tr>
            <tr><td>Оценка по продукту</td><td>Средний балл AI-оценщика по фактам о товаре</td></tr>
            <tr><td>Пробелы в знаниях</td><td>Топ тем с провалами — куда направить повтор</td></tr>
            <tr><td>Доля сертифицированных</td><td>% команды, допущенной к консультациям</td></tr>
            <tr><td>Нагрузка на РОПа</td><td>Сокращение часов на рутинную прослушку</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="aop-section aop-section-alt" id="ceny">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI-обучение продавцов</h2>
        <p>Прозрачность по составу работ отличает кастомное внедрение от SaaS с непонятным «от».</p>
      </div>
      <div class="aop-sh nero-ai-reveal">
        <div class="aop-price-band">150–450 тыс. ₽ · кастомное внедрение</div>
      </div>
      <div class="aop-grid-2 nero-ai-reveal">
        <div class="aop-card">
          <h3>От чего зависит стоимость</h3>
          <ul>
            <li>объём базы знаний — SKU, комплектации, языки;</li>
            <li>число сценариев и формат (текст, голос);</li>
            <li>интеграции — CRM, телефония, Telegram, 1С;</li>
            <li>число пользователей — пилот или сеть.</li>
          </ul>
        </div>
        <div class="aop-card">
          <h3>Что входит в пакет «под ключ»</h3>
          <ul>
            <li>аудит базы и RAG;</li>
            <li>тест + диалоговый тренажёр + AI-оценщик;</li>
            <li>дашборд РОПа + интеграция CRM;</li>
            <li>пилот 2–4 недели + обучение команды.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="aop-section" id="keisy">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Референсы рынка</span>
        <h2>Кейсы и примеры внедрения AI-тренажёра продаж</h2>
        <p>Публичные кейсы подтверждают эффективность формата role-play и ассессмента — не обязательно под ваш продукт, но по механике сопоставимо.</p>
      </div>
      <div class="aop-case-grid nero-ai-reveal">
        <div class="aop-case-card">
          <div class="aop-case-tag">Фарма · EGIS</div>
          <h3>Сокращение онбординга</h3>
          <p>AI-тренажёр для торговых представителей; масштаб с 20 до 200 сотрудников; NPS 85%, корреляция AI-оценки с экспертом 0,84.</p>
        </div>
        <div class="aop-case-card">
          <div class="aop-case-tag">Ритейл · X5</div>
          <h3>«Пятёрочка»</h3>
          <p>Время обучения с 1,5 ч до 25 мин; конфликты −6%, товарооборот +2,62% после внедрения тренажёра на SpeechKit.</p>
        </div>
        <div class="aop-case-card">
          <div class="aop-case-tag">B2B · Skorozvon</div>
          <h3>Без потери заявок</h3>
          <p>Новичок отрабатывает скрипт в AI-симуляторе до выхода на линию — не «учится на реальных клиентах».</p>
        </div>
      </div>
    </div>
  </section>

  <section class="aop-section aop-section-alt" id="test">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">Лид-магнит</span>
        <h2>Тест знаний продукта для отдела продаж</h2>
        <p>Демонстрация механики, которую внедряем клиентам: AI генерирует вопросы и проверяет открытые ответы — плюс диалоговый тренажёр, а не только викторина.</p>
      </div>
      <div class="aop-test-box nero-ai-reveal">
        <h3>Как пройти тест и получить разбор</h3>
        <ol style="padding-left:20px;color:var(--aop-muted);line-height:1.8;margin:0 0 24px;">
          <li>Нажмите «<?php echo esc_html($primary_cta_label); ?>» на странице.</li>
          <li>Ответьте на вопросы о продукте — как на реальной консультации.</li>
          <li>Получите AI-разбор: что верно, где пробел.</li>
          <li>Оставьте заявку — подготовим тест и тренажёр под ваш каталог.</li>
        </ol>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </section>

  <section class="aop-section" id="faq">
    <div class="aop-cnt">
      <div class="aop-sh nero-ai-reveal">
        <span class="aop-eyebrow">FAQ</span>
        <h2>FAQ — как заказать и внедрить AI-обучение продавцов</h2>
      </div>
      <div class="aop-faq nero-ai-reveal">
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai обучение продавцов в компании?</div><div class="aop-faq-a">Собрать каталог и скрипты → аудит → RAG и 5–10 сценариев → пилот на 5–15 продавцах → интеграция CRM → масштабирование. Срок пилота обычно 2–4 недели. Проект ведётся под ключ — внутренняя AI-команда не обязательна.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai обучение продавцов?</div><div class="aop-faq-a">Ориентир 150–450 тыс. ₽ за кастомное внедрение с тестом, тренажёром, AI-оценщиком, дашбордом и CRM. Точная смета — после аудита объёма базы знаний.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли интегрировать тренажёр с нашей CRM?</div><div class="aop-faq-a">Да. Стандарт — amoCRM и Битрикс24: статусы обучения, задачи РОПу, привязка к сотруднику. Опционально — телефония, Telegram, 1С-каталог.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-тренажёр отличается от LMS и курсов?</div><div class="aop-faq-a">LMS фиксирует просмотр и тест с вариантами. AI-тренажёр проверяет открытый ответ в диалоге — умеет ли продавец консультировать. Оптимально: LMS для регламентов, AI для ежедневных повторений и допуска к клиентам.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">Чем отличается от «нейропродавца»?</div><div class="aop-faq-a">Нейропродавец ведёт переписку с клиентом вместо менеджера. Тренажёр готовит менеджера — другая задача и результат.</div></div>
        <div class="aop-faq-item"><div class="aop-faq-q" role="button" tabindex="0" aria-expanded="false">AI не будет врать про наш продукт?</div><div class="aop-faq-a">База на RAG по вашим документам; сценарии утверждает методолог. Без актуального каталога любой AI ошибётся — процесс это блокирует.</div></div>
      </div>
    </div>
  </section>

  <div class="aop-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы сократить онбординг и убрать ошибки в консультациях?</p>
        <p class="ym-cta-block__sub">AI-тренажёр знаний продукта под ваш каталог: тест, role-play, AI-оценка и статус в CRM. Ориентир внедрения — 150–450 тыс. ₽, пилот 2–4 недели.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

'''

full = php_header + hero_section + '\n\n' + content + php_footer

out = ROOT / 'wordpress-theme' / 'page-ai-obuchenie-prodavcov.php'
out.parent.mkdir(parents=True, exist_ok=True)
out.write_text(full, encoding='utf-8')
# mirror to wordpress/ for repo convention
(ROOT / 'wordpress' / out.name).write_text(full, encoding='utf-8')
print(f'Written {out} ({out.stat().st_size} bytes)')
print(f'Mirror wordpress/{out.name} ({(ROOT / "wordpress" / out.name).stat().st_size} bytes)')

# verify anchors
import re
ids = set(re.findall(r'id="([^"]+)"', full))
menu = ['zachem','kak-rabotaet','etapy','integracii','ceny','test','faq','hero']
for a in menu:
    ok = a in ids
    print(f'anchor #{a}:', 'OK' if ok else 'MISSING')
